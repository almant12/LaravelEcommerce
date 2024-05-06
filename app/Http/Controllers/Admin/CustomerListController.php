<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CustomerListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{


    public function index(CustomerListDataTable $dataTable){
        return $dataTable->render('admin.customer-list.index');
    }

    public function changeStatus(Request $request){

        $customer = User::findOrFail($request->id);
        $customer->status = $request->status == 'true' ? 'active' : 'inactive';
        $customer->save();

        return response(['message' => 'Status has been updated!']);
    }
}
