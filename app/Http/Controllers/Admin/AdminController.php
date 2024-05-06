<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(){
        $todayOrders = Order::whereDate('created_at',Carbon::today())->count();
        $todayPendingOrders = Order::whereDate('created_at',Carbon::today())
            ->where('order_status','pending')->count();
        $totalOrders = Order::count();
        $totalPendingOrders = Order::where('order_status','pending')->count();
        $totalCanceledOrders = Order::where('order_status','canceled')->count();
        $totalDeliveredOrders = Order::where('order_status','delivered')->count();

        $todayEarnings = Order::where('order_status','!=','canceled')
            ->where('payment_status',1)
            ->whereDate('created_at',Carbon::today())
            ->sum('sub_total');

        $monthEarnings = Order::where('order_status','!=','canceled')
            ->where('payment_status',1)
            ->whereDate('created_at',Carbon::today()->month)
            ->sum('sub_total');

        $yearEarnings = Order::where('order_status','!=','canceled')
            ->where('payment_status',1)
            ->whereDate('created_at',Carbon::today()->year)
            ->sum('sub_total');

        return view('admin.dashboard',compact(
            'todayOrders',
            'todayPendingOrders',
            'totalOrders',
            'totalPendingOrders',
            'totalCanceledOrders',
            'totalDeliveredOrders',
            'todayEarnings',
            'monthEarnings',
            'yearEarnings'
        ));
    }

    public function login(){
        return view('admin.auth.login');
    }
}
