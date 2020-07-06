<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Backend\Api\V1;

use Illuminate\Http\Request;
use App\Services\Course\Models\Video;
use App\Services\Course\Models\Course;
use App\Http\Requests\Backend\CourseVideoRequest;

class CourseVideoController extends BaseController
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords', '');
        $courseId = $request->input('course_id');
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        $videos = Video::with(['course'], ['chapter'])
            ->when($keywords, function ($query) use ($keywords) {
                return $query->where('title', 'like', "{$keywords}%");
            })
            ->when($courseId, function ($query) use ($courseId) {
                $query->whereCourseId($courseId);
            })
            ->orderBy($sort, $order)
            ->paginate($request->input('size', 20));

        $videos->appends($request->input());

        $courses = \App\Services\Course\Models\Course::select(['id', 'title'])->get();

        return $this->successData(compact('videos', 'courses'));
    }

    public function create()
    {
        $courses = Course::select(['id', 'title'])->orderByDesc('published_at')->get();

        return $this->successData(compact('courses'));
    }

    public function store(CourseVideoRequest $request, Video $video)
    {
        $video->fill($request->filldata())->save();

        $this->hook($video->course_id);

        return $this->success();
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);

        $courses = Course::all();

        return $this->successData(compact('video', 'courses'));
    }

    public function update(CourseVideoRequest $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->fill($request->filldata())->save();

        $this->hook($video->course_id);

        return $this->success();
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $courseId = $video->course_id;
        $video->delete();

        $this->hook($courseId);

        return $this->success();
    }

    protected function hook($courseId)
    {
        $count = Video::query()->where('course_id', $courseId)->where('charge', '>', 0)->count();
        $isFree = $count === 0;
        Course::query()->where('id', $courseId)->update(['is_free' => $isFree]);
    }

    public function multiDestroy(Request $request)
    {
        $ids = $request->input('ids');
        $videos = Video::query()->whereIn('id', $ids)->get();
        foreach ($videos as $video) {
            $courseId = $video['course_id'];
            $video->delete();
            $this->hook($courseId);
        }

        return $this->success();
    }
}
