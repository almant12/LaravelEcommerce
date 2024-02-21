<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantItemController extends Controller{


    public function index(VendorProductVariantItemDataTable $dataTable,$productId,$variantId){
        $product = Product::findOrFail($productId);
        if ($product->vendor_id !== Auth::user()->vendor->id){
            return abort('404');
        }
        $productVariant = ProductVariant::findOrFail($variantId);
        return $dataTable->render('vendor.product.variant-item.index',compact('product','productVariant'));
    }

    public function create(string $productId, string $variantId){
        $product = Product::findOrFail($productId);
        $productVariant = ProductVariant::findOrFail($variantId);
        return view('vendor.product.variant-item.create',compact('product','productVariant'));
    }

    public function store(Request $request){

        $request->validate([
            'product_variant'=>['required','integer'],
            'name'=>['required','max:200'],
            'price'=>['required'],
            'is_default'=>['required'],
            'status'=>['required']
        ]);

        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->product_variant;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr('Created Successfully','success');
        return redirect()->route('vendor.product-variant-item.index',['productId'=>$request->product,'variantId'=>$variantItem->id]);
    }

    public function edit(string $variantItemId){
        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        if ($variantItem->productVariant->product->vendor_id !== Auth::user()->vendor->id){
            return abort('404');
        }
        return view('vendor.product.variant-item.edit',compact('variantItem'));
    }

    public function update(Request $request,string $id){

        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $variantItem = ProductVariantItem::findOrFail($id);
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr('Updated Successfully','success');

        return redirect()->route('vendor.product-variant-item.index',['productId'=>$variantItem->productVariant->product_id,
            'variantId'=>$variantItem->product_variant_id]);
    }

    public function updateStatus(Request $request){

    }

    public function destroy(string $id){

    }
}
