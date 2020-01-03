<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Meedu\Payment\Alipay;

use Exception;
use App\Models\Order;
use Yansongda\Pay\Pay;
use App\Events\PaymentSuccessEvent;
use Illuminate\Support\Facades\Log;
use App\Meedu\Payment\Contract\Payment;
use App\Meedu\Payment\Contract\PaymentStatus;
use App\Services\Base\Services\ConfigService;
use App\Services\Order\Services\OrderService;
use App\Services\Base\Interfaces\ConfigServiceInterface;
use App\Services\Order\Interfaces\OrderServiceInterface;

class Alipay implements Payment
{
    /**
     * @var ConfigService
     */
    protected $configService;
    /**
     * @var OrderService
     */
    protected $orderService;

    public function __construct(
        ConfigServiceInterface $configService,
        OrderServiceInterface $orderService
    ) {
        $this->configService = $configService;
        $this->orderService = $orderService;
    }

    /**
     * 创建支付宝订单.
     *
     * @param Order $order
     *
     * @return PaymentStatus
     */
    public function create(array $order): PaymentStatus
    {
        $payOrderData = [
            'out_trade_no' => $order['order_id'],
            'total_amount' => $order['charge'],
            'subject' => $order['order_id'],
        ];
        $createResult = Pay::alipay($this->configService->getAlipayPay())->{$order['payment_method']}($payOrderData);

        return new PaymentStatus(true, $createResult);
    }

    /**
     * @param array $order
     *
     * @return PaymentStatus
     */
    public function query(array $order): PaymentStatus
    {
    }

    public function callback()
    {
        $pay = Pay::alipay($this->configService->getAlipayPay());

        try {
            $data = $pay->verify();
            Log::info($data);

            $order = $this->orderService->find($data['out_trade_no']);

            event(new PaymentSuccessEvent($order));

            return $pay->success();
        } catch (Exception $e) {
            exception_record($e);

            return $e->getMessage();
        }
    }

    /**
     * @param array $order
     *
     * @return string
     */
    public static function payUrl(array $order): string
    {
        return route('order.pay', [$order['order_id']]);
    }
}
