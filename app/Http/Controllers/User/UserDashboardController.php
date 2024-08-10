<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(){

        $totalOrder = Order::where('user_id',auth()->user()->id)->count();
        $pendingOrder = Order::where('user_id',auth()->user()->id)->where('order_status','pending')->count();
        $completeOrder = Order::where('user_id',auth()->user()->id)->where('order_status','delivered')->count();
        $productReview = ProductReview::where('user_id',auth()->user()->id)->count();
        $wishList = Wishlist::where('user_id',auth()->user()->id)->count();

        return view('frontend.dashboard.dashboard',compact(
            'totalOrder',
            'pendingOrder',
            'completeOrder',
            'productReview',
            'wishList'
        ));
    }
}
