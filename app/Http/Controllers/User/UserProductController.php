<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller{


    public function showProduct(string $slug){

        $product = Product::with(['vendor','productVariants','imageGalleries','category','brand'])
            ->where('slug',$slug)->where('status',1)->first();
        return view('frontend.pages.product-detail',compact('product'));
    }
}
