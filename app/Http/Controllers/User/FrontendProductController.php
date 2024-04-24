<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Adverisement;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{

    public function productIndex(Request $request){
        if ($request->has('category')){
            $category = Category::where('slug',$request->category)->firstOrFail();
            $products = Product::where(['category_id'=>$category->id,'status'=>1,'is_approved'=>1])
                ->when($request->has('range'),function ($query) use ($request){
                    $price = explode(';',$request->range);
                    $from = $price[0];
                    $to = $price[1];
                    return $query->where('price','>=',$from)->where('price','<=',$to);
                })->paginate(12);
        }elseif ($request->has('sub_category')){
            $subCategory = SubCategory::where('slug',$request->sub_category)->firstOrFail();
            $products = Product::where(['sub_category_id'=>$subCategory->id,'status'=>1,'is_approved'=>1])
                ->when($request->has('range'),function ($query) use ($request){
                $price = explode(';',$request->range);
                $from = $price[0];
                $to = $price[1];
                return $query->where('price','>=',$from)->where('price','<=',$to);
            })->paginate(12);
        }elseif ($request->has('child_category')){
            $childCategory = ChildCategory::where('slug',$request->child_category)->firstOrFail();
            $products = Product::where(['child_category_id'=>$childCategory->id,'status'=>1,'is_approved'=>1])
                ->when($request->has('range'),function ($query) use ($request){
                $price = explode(';',$request->range);
                $from = $price[0];
                $to = $price[1];
                return $query->where('price','>=',$from)->where('price','<=',$to);
            })->paginate(12);
        }elseif ($request->has('brand')){
            $brand = Brand::where('slug',$request->brand)->firstOrFail();
            $products = Product::where(['brand_id'=>$brand->id,'status'=>1,'is_approved'=>1])
                ->when($request->has('range'),function ($query) use ($request){
                    $price = explode(';',$request->range);
                    $from = $price[0];
                    $to = $price[1];
                    return $query->where('price','>=',$from)->where('price','<=',$to);
                })->paginate(12);
        }elseif ($request->has('search')){
            $products = Product::where(['status'=>1,'is_approved'=>1])
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('long_description', 'like', '%' . $request->search . '%')
                        ->orWhereHas('category', function ($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('long_description', 'like', '%' . $request->search . '%');
                        });
                    })
                ->paginate(12);
        }else{
            $products = Product::where(['status'=>1,'is_approved'=>1])->orderBy('id','DESC')->paginate(12);
        }
        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->get();

        // banner ad
        $productpage_banner_section = Advertisement::where('key', 'productpage_banner_section')->first();
        $productpage_banner_section = json_decode($productpage_banner_section?->value);

        return view('frontend.pages.products',compact(
            'products',
            'categories',
                       'brands',
        'productpage_banner_section'));
    }


    public function changeListView(Request $request){

        Session::put('product_list_style',$request->style);
    }
}
