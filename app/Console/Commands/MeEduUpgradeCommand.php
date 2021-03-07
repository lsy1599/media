<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Console\Commands;

use App\Meedu\Upgrade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MeEduUpgradeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meedu:upgrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'meedu升级命令';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 数据库迁移命令
        Artisan::call('migrate', ['--force' => true]);

        // 同步meedu最新配置
        Artisan::call('install', ['action' => 'config']);

        // 同步管理角色和权限
        Artisan::call('install', ['action' => 'role']);

        // 执行升级业务逻辑
        (new Upgrade)->run();
    }
}
