<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Faker\Generator as Faker;

$factory->define(\App\Services\Other\Models\Slider::class, function (Faker $faker) {
    return [
        'sort' => $faker->randomDigit,
        'url' => $faker->url,
        'thumb' => $faker->imageUrl(),
    ];
});
