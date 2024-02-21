<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Translation\t;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,VendorProductVariantDataTable $dataTable){

        $product = Product::findOrFail($request->product);
        if ($product->vendor_id !== Auth::user()->vendor->id){
            return  abort('404');
        }
        return $dataTable->render('vendor.product.variant.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('vendor.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $request->validate([
            'name'=>['required','max:200'],
            'status'=>['required'],
            'product'=>['required','integer']
        ]);

        $productVariant = new ProductVariant();
        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Created Successfully','success');

        return redirect()->route('vendor.product-variant.index',['product'=>$productVariant->product_id]);
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

        $productVariant = ProductVariant::findOrFail($id);
        if ($productVariant->product->vendor_id !== Auth::user()->vendor->id){
            return abort('404');
        }
        return view('vendor.product.variant.edit',compact('productVariant'));
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
        return redirect()->route('vendor.product-variant.index',['product'=>$productVariant->product_id]);
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
        $variantItems = ProductVariantItem::where('product_variant_id',$productVariant->id)->count();
        if ($variantItems > 0){
            return response(['status'=>'error',
                'message'=>'This variant contain variant items for delete this you have to delete the variant items first!']);
        }
        $productVariant->delete();
        return response(['status'=>'success','message'=>'Deleted Successfully']);
    }
}
