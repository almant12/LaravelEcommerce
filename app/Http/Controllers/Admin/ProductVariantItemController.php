<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{


    public function index(ProductVariantItemDataTable $dataTable,$productId,$variantId){
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return $dataTable->render('admin.product.variant-item.index',compact('product','variant'));
    }

    public function create(string $productId, string $variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return view('admin.product.variant-item.create', compact('variant', 'product'));
    }


    public function store(Request $request){

        $request->validate([
            'variant'=>['required','integer'],
            'name'=>['required','max:200'],
            'price'=>['required'],
            'is_default'=>['required'],
            'status'=>['required']
        ]);

        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->variant;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr('Created Successfully','success');

        return redirect()->route('admin.product-variant-item.index',
            ['productId'=>$request->product,'variantId'=>$request->variant]);
    }

    public function edit(string $variantItemId){
        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        return view('admin.product.variant-item.edit',compact('variantItem'));
    }

    public function update(Request $request,string $variantItemId){

        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr('Updated Successfully','success');

        return redirect()->route('admin.product-variant-item.index',['productId'=>$variantItem->productVariant->product_id,
            'variantId'=>$variantItem->product_variant_id]);
    }

    public function updateStatus(Request $request){

        $variantItem = ProductVariantItem::findOrFail($request->id);
        $variantItem->status = $request->status == 'true' ? 1 : 0;
        $variantItem->save();

        return redirect(['status'=>'success','message'=>'Status Updated Successfully']);
    }

    public function destroy(string $variantItemId){

        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        $variantItem->delete();

        return response(['status'=>'success','message'=>'Deleted Successfully']);
    }
}
