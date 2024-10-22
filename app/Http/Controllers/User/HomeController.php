<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\FooterInfo;
use App\Models\FooterSocial;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index(){
        $categoryProductSectionThree = HomePageSetting::where('key','product_slider_section_three')->first();
        $categoryProductSectionTwo = HomePageSetting::where('key','product_slider_section_two')->first();
        $categoryProductSectionOne = HomePageSetting::where('key','product_slider_section_one')->first();
        $popularCategory = HomePageSetting::where('key','popular_category_section')->first();
        $sliders = Slider::where('status',1)->orderBy('serial','asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home',1)->where('status',1)->pluck('product_id')->toArray();
        $brands = Brand::where('status',1)->get();
        $typeBaseProducts = $this->getProductsByType();

        //banners
        $homepage_section_banner_one = Advertisement::where('key','homepage_section_banner_one')->first();
        $homepage_section_banner_one = json_decode($homepage_section_banner_one?->value);

        $homepage_section_banner_two = Advertisement::where('key','homepage_section_banner_two')->first();
        $homepage_section_banner_two = json_decode($homepage_section_banner_two?->value);

        $homepage_section_banner_three = Advertisement::where('key','homepage_section_banner_three')->first();
        $homepage_section_banner_three = json_decode($homepage_section_banner_three?->value);

        $homepage_section_banner_four = Advertisement::where('key','homepage_section_banner_four')->first();
        $homepage_section_banner_four = json_decode($homepage_section_banner_four?->value);

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
            'homepage_section_banner_one',
            'homepage_section_banner_two',
            'homepage_section_banner_three',
            'homepage_section_banner_four'
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


    public function vendorPage(){
        $vendors = Vendor::where('status',1)->paginate(20);
        return view('frontend.pages.vendor',compact('vendors'));
    }

    public function vendorProductPage(string $id){

        $vendor = Vendor::findOrFail($id);

        $products = Product::where(['status'=>1,'is_approved'=>1,'vendor_id'=>$vendor->id])->orderBy('id','DESC')->paginate(12);
        $categories = Category::where('status',1)->get();
        $brands = Brand::where('status',1)->get();

        return view('frontend.pages.vendor-product',compact('products','categories','brands','vendor'));
    }

    function ShowProductModal(string $id) {
        $product = Product::findOrFail($id);
 
        $content = view('frontend.layout.modal', compact('product'))->render();

        return Response::make($content, 200, ['Content-Type' => 'text/html']);
     }
}
