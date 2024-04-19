<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\FooterInfo;
use App\Models\FooterSocial;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categoryProductSectionThree = HomePageSetting::where('key','product_slider_section_three')->first();
        $categoryProductSectionTwo = HomePageSetting::where('key','product_slider_section_two')->first();
        $categoryProductSectionOne = HomePageSetting::where('key','product_slider_section_one')->first();
        $popularCategory = HomePageSetting::where('key','popular_category_section')->first();
        $sliders = Slider::where('status',1)->orderBy('serial','asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home',1)->where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $typeBaseProducts = $this->getProductsByType();
        return view('frontend.home.home',compact([
            'sliders',
            'flashSaleDate',
            'flashSaleItems'
            ,'brands',
            'popularCategory',
            'typeBaseProducts',
            'categoryProductSectionOne',
            'categoryProductSectionTwo',
            'categoryProductSectionThree',
        ]));
    }

    public function getProductsByType(){

        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = Product::where(['product_type'=>'new_arrival','is_approved'=>1])->orderBy('id','DESC')->take(8)->get();
        $typeBaseProducts['featured_product'] = Product::where(['product_type'=>'featured_product','is_approved'=>1])->orderBy('id','DESC')->take(8)->get();
        $typeBaseProducts['top_product'] = Product::where(['product_type'=>'top_product','is_approved'=>1])->orderBy('id','DESC')->take(8)->get();
        $typeBaseProducts['best_product'] = Product::where(['product_type'=>'best_product','is_approved'=>1])->orderBy('id','DESC')->take(8)->get();

        return $typeBaseProducts;
    }
}
