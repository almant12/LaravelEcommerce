<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ProductVariantDataTable $dataTable){
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.variant.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('admin.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $request->validate([
            'product'=>['required','integer'],
            'name'=>['required','max:200'],
            'status'=>['required']
        ]);

        $variant = new ProductVariant();
        $variant->product_id = $request->product;
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr('Created Successfully','success');
        return redirect()->route('admin.product-variant.index',['product'=> $variant->product_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){

        $product = ProductVariant::findOrFail($id);
        return view('admin.product.variant.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){

        $request->validate([
            'name'=>['required','max:200'],
            'status'=>['required']
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Updated Successfully','success');
        return redirect()->route('admin.product-variant.index',['product'=>$productVariant->product_id]);
     }

     public function updateStatus(Request $request){

        $productVariant = ProductVariant::findOrFail($request->id);
        $productVariant->status = $request->status == 'true' ? 1 : 0;
        $productVariant->save();

        return response(['status'=>'success','message'=>'Status Updated Successfully']);
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){

        $productVariant = ProductVariant::findOrFail($id);
        $variantItem = ProductVariantItem::where('product_variant_id',$productVariant->id)->count();
        if ($variantItem > 0){
            return response(['status'=>'error',
                'message'=>'This variant contain variant items for delete this you have to delete the variant items first!']);
        }
        $productVariant->delete();

        return response(['status'=>'success','message'=>'Deleted Successfully']);
    }
}
