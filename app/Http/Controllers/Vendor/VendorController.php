<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard(){

        $todaysOrders = Order::whereDate('created_at',Carbon::today())->whereHas('orderProducts',function($query){
            $query->where('vendor_id',Auth::user()->vendor->id);
        })->count();
        $todaysPendingOrders = Order::whereDate('created_at',Carbon::today())->where('order_status','pending')->whereHas('orderProducts',function($query){
            $query->where('vendor_id',Auth::user()->vendor->id);
        })->count();
        $totalOrders = Order::whereHas('orderProducts',function($query){
            $query->where('vendor_id',Auth::user()->vendor->id);
        })->count();
        $totalPendingOrders = Order::where('order_status','pending')->whereHas('orderProducts',function($query){
            $query->where('vendor_id',Auth::user()->vendor->id);
        })->count();
        $totalCompletedOrders = Order::where('order_status','delivered')->whereHas('orderProducts',function($query){
            $query->where('vendor_id',Auth::user()->vendor->id);
        })->count();
        $totalProducts = Product::where('vendor_id',Auth::user()->vendor->id)->count();


        return view('vendor.dashboard.dashboard',compact(
            'todaysOrders',
            'todaysPendingOrders',
            'totalOrders',
            'totalPendingOrders',
            'totalCompletedOrders',
            'totalProducts'
        ));
    }
}
