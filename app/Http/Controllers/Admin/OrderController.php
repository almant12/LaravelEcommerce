<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CanceledOrderDataTable;
use App\DataTables\Admin\DeliveredOrderDataTable;
use App\DataTables\Admin\DroppedOfOrderDataTable;
use App\DataTables\Admin\OrderDataTable;
use App\DataTables\Admin\OutForDeliveryOrderDataTable;
use App\DataTables\Admin\PendingOrderDataTable;
use App\DataTables\Admin\ProcessedOrderDataTable;
use App\DataTables\Admin\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable){
        return $dataTable->render('admin.orders.index');
    }

    public function pendingOrder(PendingOrderDataTable $dataTable){
        return $dataTable->render('admin.orders.pending-order');
    }

    public function processedOrder(ProcessedOrderDataTable $dataTable){
        return $dataTable->render('admin.orders.processed');
    }

    public function droppedOff(DroppedOfOrderDataTable $dataTable){
        return $dataTable->render('admin.orders.dropped-off');
    }

    public function shipped(ShippedOrderDataTable $dataTable){
        return $dataTable->render('admin.orders.shipped');
    }
    public function outForDelivery(OutForDeliveryOrderDataTable $dataTable){
        return $dataTable->render('admin.orders.out-for-delivery');
    }

    public function delivered(DeliveredOrderDataTable $dataTable){
        return $dataTable->render('admin.orders.delivered');
    }

    public function canceled(CanceledOrderDataTable $dataTable){
        return $dataTable->render('admin.orders.canceled');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $order = Order::findOrFail($id);
        return view('admin.orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $order = Order::findOrFail($id);
        $order->delete();

        return response(['status'=>'success','message'=>'Deleted Successfully']);
    }

    public function updateOrderStatus(Request $request){

        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => 'Updated Order Status']);
    }

    public function updatePaymentStatus(Request $request)
    {
        $paymentStatus = Order::findOrFail($request->id);
        $paymentStatus->payment_status = $request->status;
        $paymentStatus->save();

        return response(['status' => 'success', 'message' => 'Updated Payment Status Successfully']);
    }
}
