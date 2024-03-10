<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{


    public function index(FlashSaleItemDataTable $dataTable){

        $flashSaleDate = FlashSale::first();
        $products = Product::where('is_approved',1)->where('status',1)->orderBy('id','DESC')->get();
        return $dataTable->render('admin.flash-sale.index',compact('flashSaleDate','products'));
    }

    public function update(Request $request){
        $request->validate([
            'end_date'=>['required']
        ]);

        FlashSale::updateOrCreate(
            ['id'=>1],
            ['end_date'=>$request->end_date]
        );
        toastr('Updated Successfully','success');
        return redirect()->back();
    }

    public function addProduct(Request $request){

        $request->validate([
            'product'=>['required','integer'],
            'show_at_home'=>['required'],
            'status'=>['required']
        ]);

        $flashSale = FlashSale::first();
        $flashSaleItem = new FlashSaleItem();
        $flashSaleItem->product_id = $request->product;
        $flashSaleItem->flash_sale_id = $flashSale->id;
        $flashSaleItem->show_at_home = $request->show_at_home;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();

        toastr('Product Added Successfully','success');

        return redirect()->back();
    }

    public function updateStatus(Request $request){

        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->status = $request->status == 'true' ? 1 : 0;
        $flashSaleItem->save();

        return response(['status'=>'success','message'=>'Status Updated Successfully']);
    }

    public function updateShowAtHome(Request $request){

        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->show_at_home = $request->show_at_home == 'true' ? 1 : 0;
        $flashSaleItem->save();

        return response(['status'=>'success','message'=>'Status Updated Successfully']);
    }

    public function destroy(string $id){

        $flashSaleItem = FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();
        return response(['status'=>'success','message'=>'Deleted Successfully']);
    }
}
