<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 */

use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    public function run()
    {
        $config = [
            // 系统配置
            [
                'group' => '系统',
                'name' => '网站名',
                'field_type' => 'text',
                'sort' => 0,
                'default_value' => 'MeEdu',
                'key' => 'app.name',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => 'DEBUG',
                'field_type' => 'switch',
                'sort' => 0,
                'default_value' => 0,
                'key' => 'app.debug',
                'value' => 0,
            ],
            [
                'group' => '系统',
                'name' => '网站地址',
                'field_type' => 'text',
                'sort' => 1,
                'default_value' => '',
                'key' => 'app.url',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => '网站Logo',
                'field_type' => 'image',
                'sort' => 2,
                'default_value' => asset('/images/logo.png'),
                'key' => 'meedu.system.logo',
                'value' => asset('/images/logo.png'),
            ],
            [
                'group' => '系统',
                'name' => '白色logo',
                'field_type' => 'image',
                'sort' => 4,
                'default_value' => asset('/images/white-logo.png'),
                'key' => 'meedu.system.white_logo',
                'value' => asset('/images/white-logo.png'),
            ],
            [
                'group' => '系统',
                'name' => 'ICP备案号',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'meedu.system.icp',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => 'ICP备案号点击链接',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'meedu.system.icp_link',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => '公安网备案号',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'meedu.system.icp2',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => '公安网备案号点击链接',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'meedu.system.icp2_link',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => '全局JS',
                'field_type' => 'textarea',
                'sort' => 7,
                'default_value' => '',
                'key' => 'meedu.system.js',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => '关于我们',
                'field_type' => 'longtext',
                'sort' => 8,
                'default_value' => '',
                'key' => 'meedu.aboutus',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => 'PC自定义css',
                'field_type' => 'textarea',
                'sort' => 9,
                'key' => 'meedu.system.css.pc',
                'value' => '',
            ],
            [
                'group' => '系统',
                'name' => 'H5自定义css',
                'field_type' => 'textarea',
                'sort' => 10,
                'key' => 'meedu.system.css.h5',
                'value' => '',
            ],

            // 登录
            [
                'group' => '登录',
                'name' => '登录限制',
                'field_type' => 'select',
                'sort' => -1,
                'key' => 'meedu.system.login.limit.rule',
                'option_value' => json_encode([
                    [
                        'title' => '不限制',
                        'key' => \App\Constant\FrontendConstant::LOGIN_LIMIT_RULE_DEFAULT,
                    ],
                    [
                        'title' => '单平台限制',
                        'key' => \App\Constant\FrontendConstant::LOGIN_LIMIT_RULE_PLATFORM,
                    ],
                    [
                        'title' => '全平台限制',
                        'key' => \App\Constant\FrontendConstant::LOGIN_LIMIT_RULE_ALL,
                    ],
                ]),
                'value' => \App\Constant\FrontendConstant::LOGIN_LIMIT_RULE_DEFAULT,
                'help' => '单平台限制=每一个平台仅允许一台设备登录.全平台限制=所有平台仅允许一台设备登录',
            ],

            // QQ登录
            [
                'group' => '登录',
                'name' => 'QQ登录',
                'field_type' => 'switch',
                'sort' => 4,
                'default_value' => 0,
                'key' => 'meedu.member.socialite.qq.enabled',
                'value' => 0,
            ],
            [
                'group' => '登录',
                'name' => 'QQ ClientId',
                'field_type' => 'text',
                'sort' => 5,
                'default_value' => '',
                'key' => 'services.qq.client_id',
                'value' => '',
            ],
            [
                'group' => '登录',
                'name' => 'QQ ClientSecret',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'services.qq.client_secret',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '登录',
                'name' => 'QQ Redirect',
                'field_type' => 'text',
                'sort' => 7,
                'default_value' => url('login/qq/callback'),
                'key' => 'services.qq.redirect',
                'value' => url('login/qq/callback'),
            ],

            // 微信扫码登录
            [
                'group' => '登录',
                'name' => '微信开放平台扫码登录',
                'field_type' => 'switch',
                'sort' => 8,
                'default_value' => 0,
                'key' => 'meedu.member.socialite.weixinweb.enabled',
                'value' => 0,
                'help' => '申请地址：https://open.weixin.qq.com',
            ],
            [
                'group' => '登录',
                'name' => '微信开放平台 ClientId',
                'field_type' => 'text',
                'sort' => 9,
                'default_value' => '',
                'key' => 'services.weixinweb.client_id',
                'value' => '',
            ],
            [
                'group' => '登录',
                'name' => '微信开放平台 ClientSecret',
                'field_type' => 'text',
                'sort' => 10,
                'default_value' => '',
                'key' => 'services.weixinweb.client_secret',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '登录',
                'name' => '微信开放平台 Redirect',
                'field_type' => 'text',
                'sort' => 11,
                'default_value' => url('login/weixinweb/callback'),
                'key' => 'services.weixinweb.redirect',
                'value' => url('login/weixinweb/callback'),
            ],

            // 短信配置
            [
                'group' => '短信',
                'name' => '短信服务商',
                'field_type' => 'select',
                'sort' => 0,
                'default_value' => 'aliyun',
                'key' => 'meedu.system.sms',
                'option_value' => json_encode([
                    [
                        'title' => '阿里云',
                        'key' => 'aliyun',
                    ],
                    [
                        'title' => '云片',
                        'key' => 'yunpian',
                    ],
                ]),
                'value' => 'aliyun',
            ],
            [
                'group' => '短信',
                'name' => '阿里云 AccessKeyId',
                'field_type' => 'text',
                'sort' => 1,
                'default_value' => '',
                'key' => 'sms.gateways.aliyun.access_key_id',
                'value' => '',
            ],
            [
                'group' => '短信',
                'name' => '阿里云 AccessKeySecret',
                'field_type' => 'text',
                'sort' => 2,
                'default_value' => '',
                'key' => 'sms.gateways.aliyun.access_key_secret',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '短信',
                'name' => '阿里云 短信签名',
                'field_type' => 'text',
                'sort' => 3,
                'default_value' => '',
                'key' => 'sms.gateways.aliyun.sign_name',
                'value' => '',
            ],
            [
                'group' => '短信',
                'name' => '阿里云 密码重置模板ID',
                'field_type' => 'text',
                'sort' => 4,
                'default_value' => '',
                'key' => 'sms.gateways.aliyun.template.password_reset',
                'value' => '',
            ],
            [
                'group' => '短信',
                'name' => '阿里云 注册模板ID',
                'field_type' => 'text',
                'sort' => 5,
                'default_value' => '',
                'key' => 'sms.gateways.aliyun.template.register',
                'value' => '',
            ],
            [
                'group' => '短信',
                'name' => '阿里云 手机号绑定模板ID',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'sms.gateways.aliyun.template.mobile_bind',
                'value' => '',
            ],
            [
                'group' => '短信',
                'name' => '阿里云 手机号登录模板ID',
                'field_type' => 'text',
                'sort' => 7,
                'default_value' => '',
                'key' => 'sms.gateways.aliyun.template.login',
                'value' => '',
            ],

            [
                'group' => '短信',
                'name' => '云片ApiKey',
                'field_type' => 'text',
                'sort' => 8,
                'default_value' => '',
                'key' => 'sms.gateways.yunpian.api_key',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '短信',
                'name' => '云片密码重置模板',
                'field_type' => 'textarea',
                'sort' => 9,
                'default_value' => '',
                'key' => 'sms.gateways.yunpian.template.password_reset',
                'value' => '',
                'help' => '注意：云片短信不是填写模板ID，而是填写模板内容',
            ],
            [
                'group' => '短信',
                'name' => '云片注册模板',
                'field_type' => 'textarea',
                'sort' => 10,
                'default_value' => '',
                'key' => 'sms.gateways.yunpian.template.register',
                'value' => '',
            ],
            [
                'group' => '短信',
                'name' => '云片手机号绑定模板',
                'field_type' => 'textarea',
                'sort' => 11,
                'default_value' => '',
                'key' => 'sms.gateways.yunpian.template.mobile_bind',
                'value' => '',
            ],
            [
                'group' => '短信',
                'name' => '云片手机号登陆模板',
                'field_type' => 'textarea',
                'sort' => 12,
                'default_value' => '',
                'key' => 'sms.gateways.yunpian.template.login',
                'value' => '',
            ],

            // 图片配置
            [
                'group' => '图片存储',
                'name' => '图片存储驱动',
                'field_type' => 'select',
                'sort' => 0,
                'default_value' => 'public',
                'key' => 'meedu.upload.image.disk',
                'option_value' => json_encode([
                    [
                        'title' => '本地',
                        'key' => 'public',
                    ],
                    [
                        'title' => '阿里云oss',
                        'key' => 'oss',
                    ],
                    [
                        'title' => '七牛',
                        'key' => 'qiniu',
                    ],
                ]),
                'value' => 'public',
            ],

            // 七牛配置
            [
                'group' => '图片存储',
                'name' => '七牛访问域名',
                'field_type' => 'text',
                'sort' => 1,
                'default_value' => '',
                'key' => 'filesystems.disks.qiniu.domains.default',
                'value' => '',
            ],
            [
                'group' => '图片存储',
                'name' => '七牛访问域名(https)',
                'field_type' => 'text',
                'sort' => 2,
                'default_value' => '',
                'key' => 'filesystems.disks.qiniu.domains.https',
                'value' => '',
            ],
            [
                'group' => '图片存储',
                'name' => '七牛AccessKey',
                'field_type' => 'text',
                'sort' => 3,
                'default_value' => '',
                'key' => 'filesystems.disks.qiniu.access_key',
                'value' => '',
            ],
            [
                'group' => '图片存储',
                'name' => '七牛SecretKey',
                'field_type' => 'text',
                'sort' => 4,
                'default_value' => '',
                'key' => 'filesystems.disks.qiniu.secret_key',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '图片存储',
                'name' => '七牛Bucket',
                'field_type' => 'text',
                'sort' => 5,
                'default_value' => '',
                'key' => 'filesystems.disks.qiniu.bucket',
                'value' => '',
            ],

            // 阿里云图片存储
            [
                'group' => '图片存储',
                'name' => '阿里云OSS AccessKeyId',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'filesystems.disks.oss.access_id',
                'value' => '',
            ],
            [
                'group' => '图片存储',
                'name' => '阿里云OSS AccessKeySecret',
                'field_type' => 'text',
                'sort' => 7,
                'default_value' => '',
                'key' => 'filesystems.disks.oss.access_key',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '图片存储',
                'name' => '阿里云OSS Bucket',
                'field_type' => 'text',
                'sort' => 8,
                'default_value' => '',
                'key' => 'filesystems.disks.oss.bucket',
                'value' => '',
            ],
            [
                'group' => '图片存储',
                'name' => '阿里云OSS Endpoint',
                'field_type' => 'text',
                'sort' => 9,
                'default_value' => '',
                'key' => 'filesystems.disks.oss.endpoint',
                'value' => '',
                'help' => '必须配置，否则无法上传图片',
            ],
            [
                'group' => '图片存储',
                'name' => '阿里云OSS CDN加速域名',
                'field_type' => 'text',
                'sort' => 10,
                'default_value' => '',
                'key' => 'filesystems.disks.oss.cdnDomain',
                'value' => '',
                'help' => '必须配置，否则无法上传图片',
            ],

            // 支付宝支付
            [
                'group' => '支付',
                'name' => '支付宝支付',
                'field_type' => 'switch',
                'sort' => 0,
                'default_value' => 0,
                'key' => 'meedu.payment.alipay.enabled',
                'value' => 0,
            ],
            [
                'group' => '支付',
                'name' => '支付宝AppId',
                'field_type' => 'text',
                'sort' => 1,
                'default_value' => '',
                'key' => 'pay.alipay.app_id',
                'value' => '',
            ],
            [
                'group' => '支付',
                'name' => '支付宝公钥',
                'field_type' => 'text',
                'sort' => 2,
                'default_value' => '',
                'key' => 'pay.alipay.ali_public_key',
                'value' => '',
                'is_private' => 1,
                'help' => 'RSA2加密方式',
            ],
            [
                'group' => '支付',
                'name' => '支付宝私钥',
                'field_type' => 'text',
                'sort' => 3,
                'default_value' => '',
                'key' => 'pay.alipay.private_key',
                'value' => '',
                'is_private' => 1,
                'help' => 'RSA2加密方式',
            ],
            [
                'group' => '支付',
                'name' => '支付宝返回地址',
                'field_type' => 'text',
                'sort' => 4,
                'default_value' => url('member/order/pay/success'),
                'key' => 'pay.alipay.return_url',
                'value' => url('member/order/pay/success'),
            ],
            [
                'group' => '支付',
                'name' => '支付宝回调地址',
                'field_type' => 'text',
                'sort' => 5,
                'default_value' => url('payment/callback/alipay'),
                'key' => 'pay.alipay.notify_url',
                'value' => url('payment/callback/alipay'),
            ],

            // 微信支付
            [
                'group' => '支付',
                'name' => '微信支付',
                'field_type' => 'switch',
                'sort' => 7,
                'default_value' => 0,
                'key' => 'meedu.payment.wechat.enabled',
                'value' => 0,
            ],
            [
                'group' => '支付',
                'name' => '微信支付公众号AppId',
                'field_type' => 'text',
                'sort' => 8,
                'default_value' => '',
                'key' => 'pay.wechat.app_id',
                'value' => '',
            ],
            [
                'group' => '支付',
                'name' => '微信支付小程序AppId',
                'field_type' => 'text',
                'sort' => 9,
                'default_value' => '',
                'key' => 'pay.wechat.miniapp_id',
                'value' => '',
            ],
            [
                'group' => '支付',
                'name' => '微信支付MchId',
                'field_type' => 'text',
                'sort' => 10,
                'default_value' => '',
                'key' => 'pay.wechat.mch_id',
                'value' => '',
            ],
            [
                'group' => '支付',
                'name' => '微信支付Key',
                'field_type' => 'text',
                'sort' => 11,
                'default_value' => '',
                'key' => 'pay.wechat.key',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '支付',
                'name' => '微信支付回调地址',
                'field_type' => 'text',
                'sort' => 12,
                'default_value' => url('payment/callback/wechat'),
                'key' => 'pay.wechat.notify_url',
                'value' => url('payment/callback/wechat'),
            ],

            // 手动打款
            [
                'group' => '支付',
                'name' => '手动打款',
                'field_type' => 'switch',
                'sort' => 13,
                'default_value' => 0,
                'key' => 'meedu.payment.handPay.enabled',
                'value' => 0,
            ],
            [
                'group' => '支付',
                'name' => '手动打款说明',
                'field_type' => 'longtext',
                'sort' => 14,
                'default_value' => '',
                'key' => 'meedu.payment.handPay.introduction',
                'value' => '',
            ],

            // 阿里云视频配置
            [
                'group' => '视频',
                'name' => '阿里云视频Region',
                'field_type' => 'text',
                'sort' => 0,
                'default_value' => '',
                'key' => 'meedu.upload.video.aliyun.region',
                'value' => '',
            ],
            [
                'group' => '视频',
                'name' => '阿里云视频AccessKeyId',
                'field_type' => 'text',
                'sort' => 1,
                'default_value' => '',
                'key' => 'meedu.upload.video.aliyun.access_key_id',
                'value' => '',
            ],
            [
                'group' => '视频',
                'name' => '阿里云视频AccessKeySecret',
                'field_type' => 'text',
                'sort' => 2,
                'default_value' => '',
                'key' => 'meedu.upload.video.aliyun.access_key_secret',
                'value' => '',
                'is_private' => 1,
            ],

            // 腾讯云视频
            [
                'group' => '视频',
                'name' => '腾讯云视频AppId',
                'field_type' => 'text',
                'sort' => 3,
                'default_value' => '',
                'key' => 'tencent.vod.app_id',
                'value' => '',
            ],
            [
                'group' => '视频',
                'name' => '腾讯云视频SecretId',
                'field_type' => 'text',
                'sort' => 4,
                'default_value' => '',
                'key' => 'tencent.vod.secret_id',
                'value' => '',
            ],
            [
                'group' => '视频',
                'name' => '腾讯云视频SecretKey',
                'field_type' => 'text',
                'sort' => 5,
                'default_value' => '',
                'key' => 'tencent.vod.secret_key',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '视频',
                'name' => '腾讯云播放key',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'meedu.system.player.tencent_play_key',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '视频',
                'name' => '腾讯云超级播放器配置',
                'field_type' => 'text',
                'sort' => 7,
                'default_value' => 'default',
                'key' => 'meedu.system.player.tencent_pcfg',
                'value' => 'default',
            ],

            // 会员配置
            [
                'group' => '会员',
                'name' => '手机号强制绑定',
                'field_type' => 'switch',
                'sort' => 0,
                'default_value' => 0,
                'key' => 'meedu.member.enabled_mobile_bind_alert',
                'value' => 0,
            ],
            [
                'group' => '会员',
                'name' => '会员注册默认激活',
                'field_type' => 'switch',
                'sort' => 1,
                'default_value' => 0,
                'key' => 'meedu.member.is_active_default',
                'value' => 0,
            ],
            [
                'group' => '会员',
                'name' => '会员注册默认锁定',
                'field_type' => 'switch',
                'sort' => 2,
                'default_value' => 0,
                'key' => 'meedu.member.is_lock_default',
                'value' => 0,
            ],
            [
                'group' => '会员',
                'name' => '默认头像',
                'field_type' => 'image',
                'sort' => 3,
                'default_value' => asset('/images/default_avatar.jpg'),
                'key' => 'meedu.member.default_avatar',
                'value' => asset('/images/default_avatar.jpg'),
            ],
            [
                'group' => '会员',
                'name' => '会员协议',
                'field_type' => 'longtext',
                'sort' => 4,
                'default_value' => '',
                'key' => 'meedu.member.protocol',
                'value' => '',
            ],
            [
                'group' => '会员',
                'name' => '会员隐私协议',
                'field_type' => 'longtext',
                'sort' => 5,
                'default_value' => '',
                'key' => 'meedu.member.private_protocol',
                'value' => '',
            ],

            // SEO配置
            [
                'group' => 'SEO优化',
                'name' => '首页标题',
                'field_type' => 'text',
                'sort' => 0,
                'default_value' => '',
                'key' => 'meedu.seo.index.title',
                'value' => '',
            ],
            [
                'group' => 'SEO优化',
                'name' => '首页关键字',
                'field_type' => 'text',
                'sort' => 1,
                'default_value' => '',
                'key' => 'meedu.seo.index.keywords',
                'value' => '',
            ],
            [
                'group' => 'SEO优化',
                'name' => '首页描述',
                'field_type' => 'textarea',
                'sort' => 2,
                'default_value' => '',
                'key' => 'meedu.seo.index.description',
                'value' => '',
            ],

            [
                'group' => 'SEO优化',
                'name' => '课程列表页标题',
                'field_type' => 'text',
                'sort' => 3,
                'default_value' => '',
                'key' => 'meedu.seo.course_list.title',
                'value' => '',
            ],
            [
                'group' => 'SEO优化',
                'name' => '课程列表页关键字',
                'field_type' => 'text',
                'sort' => 4,
                'default_value' => '',
                'key' => 'meedu.seo.course_list.keywords',
                'value' => '',
            ],
            [
                'group' => 'SEO优化',
                'name' => '课程列表页描述',
                'field_type' => 'textarea',
                'sort' => 5,
                'default_value' => '',
                'key' => 'meedu.seo.course_list.description',
                'value' => '',
            ],

            [
                'group' => 'SEO优化',
                'name' => '订阅页标题',
                'field_type' => 'text',
                'sort' => 6,
                'default_value' => '',
                'key' => 'meedu.seo.role_list.title',
                'value' => '',
            ],
            [
                'group' => 'SEO优化',
                'name' => '订阅页标题关键字',
                'field_type' => 'text',
                'sort' => 7,
                'default_value' => '',
                'key' => 'meedu.seo.role_list.keywords',
                'value' => '',
            ],
            [
                'group' => 'SEO优化',
                'name' => '订阅页标题描述',
                'field_type' => 'textarea',
                'sort' => 8,
                'default_value' => '',
                'key' => 'meedu.seo.role_list.description',
                'value' => '',
            ],

            // 邀请
            [
                'group' => '邀请',
                'name' => '免费会员是否可以生成邀请码',
                'field_type' => 'switch',
                'sort' => 0,
                'default_value' => 0,
                'key' => 'meedu.member.invite.free_user_enabled',
                'value' => 0,
            ],
            [
                'group' => '邀请',
                'name' => '邀请人奖励(元)',
                'field_type' => 'number',
                'sort' => 1,
                'default_value' => 0,
                'key' => 'meedu.member.invite.invite_user_reward',
                'value' => 0,
            ],
            [
                'group' => '邀请',
                'name' => '被邀请人奖励(元)',
                'field_type' => 'number',
                'sort' => 2,
                'default_value' => 0,
                'key' => 'meedu.member.invite.invited_user_reward',
                'value' => 0,
            ],
            [
                'group' => '邀请',
                'name' => '邀请关系维系时间(天)',
                'field_type' => 'number',
                'sort' => 3,
                'default_value' => 0,
                'key' => 'meedu.member.invite.effective_days',
                'value' => 0,
            ],
            [
                'group' => '邀请',
                'name' => '订单抽成',
                'field_type' => 'text',
                'sort' => 4,
                'default_value' => 0,
                'key' => 'meedu.member.invite.per_order_draw',
                'value' => 0,
                'help' => '1=100% 0.5=50%'
            ],

            // 积分
            [
                'group' => '积分',
                'name' => '注册奖励',
                'field_type' => 'number',
                'sort' => 0,
                'default_value' => 0,
                'key' => 'meedu.member.credit1.register',
                'value' => 0,
            ],
            [
                'group' => '积分',
                'name' => '邀请奖励',
                'field_type' => 'number',
                'sort' => 1,
                'default_value' => 0,
                'key' => 'meedu.member.credit1.invite',
                'value' => 0,
            ],
            [
                'group' => '积分',
                'name' => '看完课程',
                'field_type' => 'number',
                'sort' => 2,
                'default_value' => 0,
                'key' => 'meedu.member.credit1.watched_course',
                'value' => 0,
            ],
            [
                'group' => '积分',
                'name' => '看完视频',
                'field_type' => 'number',
                'sort' => 3,
                'default_value' => 0,
                'key' => 'meedu.member.credit1.watched_video',
                'value' => 0,
            ],
            [
                'group' => '积分',
                'name' => '支付订单',
                'field_type' => 'text',
                'sort' => 4,
                'default_value' => 0,
                'key' => 'meedu.member.credit1.paid_order',
                'value' => 0,
                'help' => '注意，支付订单的积分奖励与上面不同，它是根据订单金额*百分比奖励的，所以这里应该填写百分比。举个例子：订单支付金额100元，这里填写0.1，则用户奖励10积分。',
            ],

            // 微信小程序
            [
                'group' => '微信小程序',
                'name' => 'AppId',
                'field_type' => 'text',
                'sort' => 0,
                'default_value' => '',
                'key' => 'tencent.wechat.mini.app_id',
                'value' => '',
            ],
            [
                'group' => '微信小程序',
                'name' => 'AppSecret',
                'field_type' => 'text',
                'sort' => 1,
                'default_value' => '',
                'key' => 'tencent.wechat.mini.secret',
                'value' => '',
                'is_private' => 1,
            ],

            // 插件配置
            [
                'group' => '插件配置',
                'name' => '服务地址',
                'field_type' => 'text',
                'sort' => 0,
                'default_value' => '',
                'key' => 'meedu.meeducloud.domain',
                'value' => '',
            ],
            [
                'group' => '插件配置',
                'name' => 'UserID',
                'field_type' => 'text',
                'sort' => 1,
                'default_value' => '',
                'key' => 'meedu.meeducloud.user_id',
                'value' => '',
            ],
            [
                'group' => '插件配置',
                'name' => '密码',
                'field_type' => 'text',
                'sort' => 2,
                'default_value' => '',
                'key' => 'meedu.meeducloud.password',
                'value' => '',
                'is_private' => 1,
            ],

            // 播放器配置
            [
                'group' => '播放器配置',
                'name' => '播放器封面',
                'field_type' => 'image',
                'sort' => 0,
                'default_value' => asset('/images/player-thumb.png'),
                'key' => 'meedu.system.player_thumb',
                'value' => asset('/images/player-thumb.png'),
            ],
            [
                'group' => '播放器配置',
                'name' => '跑马灯（防止录屏）',
                'field_type' => 'switch',
                'sort' => 1,
                'default_value' => 0,
                'key' => 'meedu.system.player.enabled_bullet_secret',
                'value' => 0,
            ],
            [
                'group' => '播放器配置',
                'name' => '阿里云私密播放',
                'field_type' => 'switch',
                'sort' => 2,
                'default_value' => 0,
                'key' => 'meedu.system.player.enabled_aliyun_private',
                'value' => 0,
            ],

            // 其它
            [
                'group' => '其它配置',
                'name' => '课程列表页每页数',
                'field_type' => 'number',
                'sort' => 0,
                'key' => 'meedu.other.course_list_page_size',
                'value' => 16,
            ],
            [
                'group' => '其它配置',
                'name' => '视频列表页每页数',
                'field_type' => 'number',
                'sort' => 1,
                'key' => 'meedu.other.video_list_page_size',
                'value' => 16,
            ],

            // 微信公众号
            [
                'group' => '微信公众号',
                'name' => 'AppId',
                'field_type' => 'text',
                'sort' => 0,
                'key' => 'meedu.mp_wechat.app_id',
                'value' => '',
                'help' => '微信公众号URL：' . url('api/wechat/serve'),
            ],
            [
                'group' => '微信公众号',
                'name' => 'AppSecret',
                'field_type' => 'text',
                'sort' => 1,
                'key' => 'meedu.mp_wechat.app_secret',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '微信公众号',
                'name' => 'Token',
                'field_type' => 'text',
                'sort' => 2,
                'key' => 'meedu.mp_wechat.token',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '微信公众号',
                'name' => 'AesKey',
                'field_type' => 'text',
                'sort' => 3,
                'key' => 'meedu.mp_wechat.aes_key',
                'value' => '',
                'is_private' => 1,
            ],
            [
                'group' => '微信公众号',
                'name' => '启用授权登录',
                'field_type' => 'switch',
                'sort' => 6,
                'key' => 'meedu.mp_wechat.enabled_oauth_login',
                'value' => 0,
            ],

            // 注册送VIP
            [
                'group' => '注册送VIP',
                'name' => '开启',
                'field_type' => 'switch',
                'sort' => 0,
                'key' => 'meedu.member.register.vip.enabled',
                'value' => 0
            ],
            [
                'group' => '注册送VIP',
                'name' => 'VipID',
                'field_type' => 'number',
                'sort' => 1,
                'key' => 'meedu.member.register.vip.role_id',
                'value' => 0
            ],
            [
                'group' => '注册送VIP',
                'name' => '赠送天数',
                'field_type' => 'number',
                'sort' => 2,
                'key' => 'meedu.member.register.vip.days',
                'value' => 0,
            ],

            // 高德地图配置
            [
                'group' => '高德地图',
                'name' => '应用Key',
                'field_type' => 'text',
                'sort' => 1,
                'key' => 'meedu.services.imap.key',
                'value' => '',
                'is_private' => 1,
            ],
        ];

        $localConfig = [];
        if (file_exists(storage_path('meedu_config.json'))) {
            $localConfig = json_decode(file_get_contents(storage_path('meedu_config.json')), true);
        }

        foreach ($config as $item) {
            if (\App\Services\Base\Model\AppConfig::query()->where('key', $item['key'])->exists()) {
                continue;
            }
            $val = \Illuminate\Support\Arr::get($localConfig, $item['key']);
            $item['value'] = $val ?: ($item['value'] ?? '');
            \App\Services\Base\Model\AppConfig::create($item);
        }
    }
}
