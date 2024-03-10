<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\Vendor\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable){
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'image'=>['required','image','max:3000'],
            'name'=>['required','max:200'],
            'category'=>['required'],
            'brand'=>['required'],
            'price'=>['required'],
            'qty'=>['required'],
            'short_description'=>['required','max:600'],
            'long_description'=>['required'],
            'product_type'=>['required'],
            'status'=>['required'],
            'seo_title'=>['nullable','max:250'],
            'seo_description'=>['nullable','max:250']
        ]);

        $imagePath = $this->uploadImage($request,'image');

        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = \Illuminate\Support\Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 0;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Created Successfully','success');
        return redirect()->route('vendor.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){

        $product = Product::findOrFail($id);

        if ($product->vendor_id !== Auth::user()->vendor->id){
            return abort('404');
        }

        $subCategories = SubCategory::where('category_id',$product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id',$product->sub_category_id)->get();
        $brands = Brand::all();
        $categories = Category::all();

        return view('vendor.product.edit',
            compact('product','subCategories','childCategories','brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){

        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'product_type' => ['required'],
            'status' => ['required'],
            'seo_title' => ['nullable', 'max:250'],
            'seo_description' => ['nullable', 'max:250']
        ]);


        $product = Product::findOrFail($id);

        if ($product->vendor_id !== Auth::user()->vendor->id){
            return abort('404');
        }
        $imagePath = $this->updateImage($request,'image',$product->thumb_image);

        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = \Illuminate\Support\Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = $product->is_approved;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Updated Successfully','success');

        return redirect()->route('vendor.product.index');
    }

    public function updateStatus(Request $request){

        $product = Product::findOrFail($request->id);
        if ($product->vendor_id !== Auth::user()->vendor->id){
            return abort('404');
        }
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['status'=>'success','message'=>'Status Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSubCategories(Request $request){
        $id = $request->input('id');
        $subCategories = SubCategory::where('category_id',$id)->get();
        return $subCategories;
    }

    public function getChildCategories(Request $request){
        $id = $request->input('id');
        $childCategories = ChildCategory::where('sub_category_id',$id)->get();
        return $childCategories;
    }
}
