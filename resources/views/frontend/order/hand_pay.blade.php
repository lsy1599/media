@extends('layouts.app')

@section('css')
    <style>
        body {
            background-color: #f6f6f6;
        }
    </style>
@endsection

@section('content')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12 bg-fff br-8 px-5 py-4">
                <div class="w-100 float-left">
                    <div class="row">
                        <div class="col-12">
                            <h2>手动打款</h2>
                        </div>
                        <div class="col-12">
                            <p class="mt-4 text-right">订单号 <span class="ml-3">{{$order['order_id']}}</span></p>
                            <p class="text-right">支付总额 <span class="ml-3">￥{{$needPaidTotal}}</span></p>
                        </div>
                        <div class="col-12 py-3">
                            {!! $intro !!}
                        </div>
                        <div class="col-12 text-right">
                            <a href="{{route('member.orders')}}" class="btn btn-primary">订单中心</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.components.recom_courses')

@endsection