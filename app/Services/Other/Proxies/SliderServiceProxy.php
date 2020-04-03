<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Other\Proxies;

use App\Meedu\ServiceProxy\ServiceProxy;
use App\Meedu\ServiceProxy\Cache\CacheInfo;
use App\Services\Other\Services\SliderService;
use App\Services\Other\Interfaces\SliderServiceInterface;

class SliderServiceProxy extends ServiceProxy implements SliderServiceInterface
{
    public function __construct(SliderService $service)
    {
        parent::__construct($service);
        $this->cache['all'] = function () {
            return new CacheInfo('os:sss', $this->configService->getCacheExpire());
        };
    }
}
