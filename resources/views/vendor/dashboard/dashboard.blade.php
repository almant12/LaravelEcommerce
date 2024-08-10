@extends('vendor.layouts.master')
@section('title')
    {{$settings->site_name}} || Dashboard
@endsection
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-10 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">

                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="dsahboard_order.html">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Today's Orders</p>
                                        <h4 style="color: white">{{ $todaysOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="dsahboard_order.html">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Today's Pending Orders</p>
                                        <h4 style="color: white">{{ $todaysPendingOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="dsahboard_order.html">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Orders</p>
                                        <h4 style="color: white">{{ $totalOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="dsahboard_order.html">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Pending Orders</p>
                                        <h4 style="color: white">{{ $totalPendingOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="dsahboard_order.html">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Completed Orders</p>
                                        <h4 style="color: white">{{ $totalCompletedOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="dsahboard_order.html">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Products</p>
                                        <h4 style="color: white">{{ $totalProducts }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="dsahboard_download.html">
                                        <i class="fal fa-cloud-download"></i>
                                        <p>download</p>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
                                        <i class="fas fa-star"></i>
                                        <p>review</p>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="dsahboard_wishlist.html">
                                        <i class="far fa-heart"></i>
                                        <p>wishlist</p>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item orange" href="dsahboard_profile.html">
                                        <i class="fas fa-user-shield"></i>
                                        <p>profile</p>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="dsahboard_address.html">
                                        <i class="fal fa-map-marker-alt"></i>
                                        <p>address</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
