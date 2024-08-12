<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class UserProductController extends Controller{


    public function showProduct(string $slug){

        $product = Product::with(['vendor','productVariants','imageGalleries','category','brand'])
            ->where('slug',$slug)->where('status',1)->first();
        $reviews = ProductReview::where('product_id', $product->id)->where('status', 1)->paginate(10);
        $relatedProducts = Product::where('category_id',$product->category->id)
        ->where('status',1)->where('id','!=',$product->id)->get();
        return view('frontend.pages.product-detail',compact('product','reviews','relatedProducts'));
    }
}
