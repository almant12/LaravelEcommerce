<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\Vendor\VendorOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{

    public function index(VendorOrderDataTable $dataTable){
        return $dataTable->render('vendor.order.index');
    }

    public function show($id){

        $order = Order::findOrFail($id);
        return view('vendor.order.show',compact('order'));
    }

    public function updateStatus(Request $request,$id){

        $order = Order::findOrFail($id);
        $order->order_status = $request->status;
        $order->save();

        toastr('Updated Successfully','success');
        return redirect()->back();
    }
}
