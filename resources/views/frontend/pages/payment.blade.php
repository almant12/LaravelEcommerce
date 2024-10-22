@extends('frontend.layout.master')
@section('title')
    {{$settings->site_name}} || Payment
@endsection
@section('content')
    @php
        $stripeSetting = \App\Models\StripeSetting::first();
    @endphp
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li><a href="javascript:;">payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-paypal" type="button" role="tab" aria-controls="v-pills-paypal"
                                        aria-selected="true">Paypal</button>

                                @if($stripeSetting->status === 1)
                                    <button class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-stripe" type="button" role="tab"
                                            aria-controls="v-pills-stripe" aria-selected="false">Stripe</button>
                                @endif

{{--                                <button class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"--}}
{{--                                        data-bs-target="#v-pills-razorpay" type="button" role="tab"--}}
{{--                                        aria-controls="v-pills-stripe" aria-selected="false">RazorPay</button>--}}

{{--                                <button class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"--}}
{{--                                        data-bs-target="#v-pills-cod" type="button" role="tab"--}}
{{--                                        aria-controls="v-pills-stripe" aria-selected="false">COD</button>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">


                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                 aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <a class="nav-link common_btn text-center" href="{{route('user.paypal.payment')}}">Pay with Paypal</a>
                                        </div>
                                        <div class="wsus__payment_area" style="margin-top: 10px;">
                                            <a class="nav-link common_btn text-center" href="{{route('user.payment.pay-by-deliver')}}">Pay By Deliver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($stripeSetting->status === 1)
                                @include('frontend.pages.payment-gateway.stripe')
                            @endif

{{--                            @include('frontend.pages.payment-gateway.razorpay')--}}

{{--                            @include('frontend.pages.payment-gateway.cod')--}}



                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Booking Summary</h5>
                            <p>subtotal: <span>{{priceFormat(getCartTotal())}}{{$settings->currency_icon}}</span></p>
                            <p>shipping fee(+): <span>{{priceFormat(getShppingFee())}}{{$settings->currency_icon}}</span></p>
                            @if(getCouponType() === 'percent')
                                <p>coupon(-): <span>{{priceFormat(getCartDiscount())}}%</span></p>
                            @else
                                <p>coupon(-): <span>{{priceFormat(getCartDiscount())}}{{$settings->currency_icon}}</span></p>
                            @endif
                            <h6>total <span>{{priceFormat(getFinalPayableAmount())}}{{$settings->currency_icon}}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->

@endsection
