<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Frontend;

use App\Events\UserRegisterEvent;
use App\Http\Controllers\BaseController;
use App\Services\Member\Services\UserService;
use App\Http\Requests\Frontend\RegisterPasswordRequest;
use App\Services\Member\Interfaces\UserServiceInterface;

class RegisterController extends BaseController
{

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterPage()
    {
        return v('auth.register');
    }

    /**
     * @param RegisterPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function passwordRegisterHandler(RegisterPasswordRequest $request)
    {
        [
            'mobile' => $mobile,
            'password' => $password,
            'nick_name' => $nickname,
        ] = $request->filldata();
        $user = $this->userService->findNickname($nickname);
        if ($user) {
            flash(__('nickname.unique'));
            return back();
        }
        $user = $this->userService->findMobile($mobile);
        if ($user) {
            flash(__('mobile.unique'));
            return back();
        }
        $this->userService->createWithMobile($mobile, $password, $nickname);
        flash(__('register success'), 'success');
        return redirect(route('login'));
    }
}
