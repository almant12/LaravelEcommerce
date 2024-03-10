<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::where('status',1)->orderBy('serial','asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home',1)->where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        return view('frontend.home.home',compact([
            'sliders',
            'flashSaleDate',
            'flashSaleItems'
            ,'brands'
        ]));
    }
}
