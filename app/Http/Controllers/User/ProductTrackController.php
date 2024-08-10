<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductTrackController extends Controller
{


    public function index(Request $request){
        if($request->has('invoice_id')){
            $order = Order::where('invoice_id',$request->invoice_id)->first();
            return view('frontend.pages.product-track',compact('order'));
        }else{
        return view('frontend.pages.product-track');
        }
    }
}
