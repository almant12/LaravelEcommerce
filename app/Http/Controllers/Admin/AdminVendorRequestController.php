<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminVendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;

class AdminVendorRequestController extends Controller
{


    public function index(AdminVendorRequestDataTable $dataTable){

        return $dataTable->render('admin.vendor-request.index');
    }

    public function show(string $id){
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor-request.show',compact('vendor'));
    }

    public function changeStatus(Request $request,string $id){

        $vendor = Vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        $user = User::findOrFail($vendor->user_id);
        $user->role = 'vendor';
        $user->save();

        toastr('Updated successfully!', 'success', 'success');
        return redirect()->route('admin.vendor-request.index');
    }
}
