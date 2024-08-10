<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    

    public function index(WithdrawRequestDataTable $datatable){
        return $datatable->render('admin.withdraw-request.index');
    }

    public function show($id){
        $withdrawRequest = WithdrawRequest::findOrFail($id);
        return view('admin.withdraw-request.show',compact('withdrawRequest'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'status' => ['required', 'in:pending,paid,declined']
        ]);

        
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->status = $request->status;
        $withdraw->save();

        toastr('Updated successfully!');

        return redirect()->route('admin.withdraw.index');
    }
}
