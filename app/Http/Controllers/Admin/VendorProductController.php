<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\VendorPendingProductDataTable;
use App\DataTables\Admin\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use function Termwind\render;

class VendorProductController extends Controller{


    public function index(VendorProductDataTable $dataTable){
        return $dataTable->render('admin.product.vendor-product.index');
    }

    public function pendingProducts(VendorPendingProductDataTable $dataTable){
        return $dataTable->render('admin.product.vendor-pending-product.index');
    }

    public function changeApproveStatus(Request $request){


        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();

        return response(['status'=>'success','message'=>'Product Approve Status Has Been Changed']);
    }
}
