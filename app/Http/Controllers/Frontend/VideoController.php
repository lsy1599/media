<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 */

namespace App\Http\Controllers\Frontend;

use App\Meedu\Cache\Inc\Inc;
use Illuminate\Http\Request;
use App\Businesses\BusinessState;
use App\Constant\FrontendConstant;
use App\Meedu\Cache\Inc\VideoViewIncItem;
use App\Services\Member\Services\UserService;
use App\Services\Order\Services\OrderService;
use App\Services\Course\Services\VideoService;
use App\Services\Course\Services\CourseService;
use App\Services\Course\Services\VideoCommentService;
use App\Services\Member\Interfaces\UserServiceInterface;
use App\Services\Order\Interfaces\OrderServiceInterface;
use App\Services\Course\Interfaces\VideoServiceInterface;
use App\Services\Course\Interfaces\CourseServiceInterface;
use App\Services\Course\Interfaces\VideoCommentServiceInterface;

class VideoController extends FrontendController
{
    /**
     * @var VideoService
     */
    protected $videoService;
    /**
     * @var VideoCommentService
     */
    protected $videoCommentService;
    /**
     * @var UserService
     */
    protected $userService;
    /**
     * @var CourseService
     */
    protected $courseService;
    /**
     * @var BusinessState
     */
    protected $businessState;
    /**
     * @var OrderService
     */
    protected $orderService;

    public function __construct(
        VideoServiceInterface $videoService,
        VideoCommentServiceInterface $videoCommentService,
        UserServiceInterface $userService,
        CourseServiceInterface $courseService,
        BusinessState $businessState,
        OrderServiceInterface $orderService
    ) {
        parent::__construct();

        $this->videoService = $videoService;
        $this->videoCommentService = $videoCommentService;
        $this->userService = $userService;
        $this->courseService = $courseService;
        $this->businessState = $businessState;
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $pageSize = $this->configService->getVideoListPageSize();
        [
            'list' => $list,
            'total' => $total
        ] = $this->videoService->simplePage($page, $pageSize);
        $videos = $this->paginator($list, $total, $page, $pageSize);
        $title = __('all videos');

        return v('frontend.video.index', compact('videos', 'title'));
    }

    public function show(Request $request, $courseId, $id, $slug)
    {
        $scene = $request->input('scene');
        $course = $this->courseService->find($courseId);
        $video = $this->videoService->find($id);

        // ??????????????????
        Inc::record(new VideoViewIncItem($video['id']));

        // ????????????
        $comments = $this->videoCommentService->videoComments($video['id']);
        $commentUsers = $this->userService->getList(array_column($comments, 'user_id'), ['role']);
        $commentUsers = array_column($commentUsers, null, 'id');

        // ????????????
        $chapters = $this->courseService->chapters($video['course_id']);
        $videos = $this->videoService->courseVideos($video['course_id']);

        // ????????????????????????
        $canSeeVideo = false;
        // ??????
        $trySee = false;
        // ????????????????????????
        $videoWatchedProgress = [];
        // ??????????????????
        $canComment = $this->businessState->videoCanComment($this->user(), $video);

        if ($this->check()) {
            $canSeeVideo = $this->businessState->canSeeVideo($this->user(), $video['course'], $video);
            $canSeeVideo && $this->courseService->createCourseUserRecord($this->id(), $course['id']);

            $userVideoWatchRecords = $this->userService->getUserVideoWatchRecords($this->id(), $course['id']);
            $videoWatchedProgress = array_column($userVideoWatchRecords, null, 'video_id');

            $trySee = $canSeeVideo === false && $video['free_seconds'] > 0;
        }

        // ???????????????
        $nextVideo = call_user_func(function () use ($chapters, $videos, $video) {
            $nextVideo = null;
            $index = false;
            $lock = false;
            foreach ($chapters ?: [['id' => 0]] as $chapter) {
                $chapterId = $chapter['id'];
                $items = $videos[$chapterId] ?? [];
                if (!$items) {
                    continue;
                }
                if ($index === false && $chapterId !== $video['chapter_id']) {
                    continue;
                }
                $index = true;
                foreach ($items as $item) {
                    if ($lock === false && $item['id'] !== $video['id']) {
                        continue;
                    }
                    if ($lock === true) {
                        $nextVideo = $item;
                        break 2;
                    }
                    $lock = true;
                }
            }
            return $nextVideo;
        });

        // ????????????
        $playUrls = collect([]);
        if (!($video['aliyun_video_id'] && $this->configService->getAliyunPrivatePlayStatus())) {
            $playUrls = get_play_url($video, $trySee);
            if ($playUrls->isEmpty()) {
                flash('??????????????????');
                return back();
            }
        }

        $title = $video['title'];
        $keywords = $video['seo_keywords'];
        $description = $video['seo_description'];

        return v('frontend.video.show', compact(
            'course',
            'video',
            'title',
            'keywords',
            'description',
            'comments',
            'commentUsers',
            'videos',
            'chapters',
            'canSeeVideo',
            'scene',
            'playUrls',
            'nextVideo',
            'videoWatchedProgress',
            'trySee',
            'canComment'
        ));
    }

    // ?????????
    public function showBuyPage($id)
    {
        $video = $this->videoService->find($id);

        if ($this->userService->hasVideo($this->id(), $video['id'])) {
            flash(__('You have already purchased this course'), 'success');
            return back();
        }

        if ($video['is_ban_sell'] === FrontendConstant::YES) {
            flash(__('this video cannot be sold'));
            return back();
        }

        $course = $this->courseService->find($video['course_id']);

        // ????????????
        $title = __('buy video', ['video' => $video['title']]);

        $goods = [
            'id' => $video['id'],
            'title' => $video['title'],
            'thumb' => $course['thumb'],
            'charge' => $video['charge'],
            'label' => __('??????'),
        ];

        $total = $video['charge'];

        $scene = get_payment_scene();
        $payments = get_payments($scene);

        return v('frontend.order.create', compact('goods', 'title', 'total', 'scene', 'payments'));
    }

    // ????????????
    public function buyHandler(Request $request)
    {
        $id = $request->input('goods_id');
        $promoCodeId = abs((int)$request->input('promo_code_id', 0));
        $video = $this->videoService->find($id);

        // ??????????????????
        if ($video['is_ban_sell'] === FrontendConstant::YES) {
            flash(__('this video cannot be sold'));
            return back();
        }

        // ?????????0????????????
        if ($video['charge'] <= 0) {
            flash(__('video cant buy'));
            return back();
        }

        // ????????????
        $order = $this->orderService->createVideoOrder($this->id(), $video, $promoCodeId);

        $videoUrl = route('video.show', [$video['course_id'], $video['id'], $video['slug']]);

        // ???????????????????????????????????????
        if ($order['status'] === FrontendConstant::ORDER_PAID) {
            flash(__('success'), 'success');
            return redirect($videoUrl);
        }

        $paymentScene = $request->input('payment_scene');
        $payment = $request->input('payment_sign');

        return redirect(
            route(
                'order.pay',
                [
                    'scene' => $paymentScene,
                    'payment' => $payment,
                    'order_id' => $order['order_id'],
                    's_url' => $videoUrl,
                ]
            )
        );
    }
}
