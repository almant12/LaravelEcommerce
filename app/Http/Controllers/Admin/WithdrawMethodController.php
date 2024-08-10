<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WithdrawMethodDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{


    public function index(WithdrawMethodDataTable $datatable){
        return $datatable->render('admin.withdraw-method.index');
    }

    public function create(){
        return view('admin.withdraw-method.create');
    }

    public function store(Request $request){

        $request->validate([
            'name'=>['required','max:255'],
            'minimum_amount'=>['required','numeric','lt:maximum_amount'],
            'maximum_amount'=>['required','numeric','gt:minimum_amount'],
            'withdraw_charge'=>['required','numeric'],
            'description'=>['required']
        ]);

        $method = new WithdrawMethod();
        $method->name = $request->name;
        $method->minimum_amount = $request->minimum_amount;
        $method->maximum_amount = $request->maximum_amount;
        $method->withdraw_charge = $request->withdraw_charge;
        $method->description = $request->description;
        $method->save();

        toastr('Created successfully', 'success');

        return redirect()->route('admin.withdraw-method.index');
    }

    public function edit($id){
        $method = WithdrawMethod::findOrFail($id);
        return view('admin.withdraw-method.edit',compact('method'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'minimum_amount' => ['required', 'numeric', 'lt:maximum_amount'],
            'maximum_amount' => ['required', 'numeric', 'gt:minimum_amount'],
            'withdraw_charge' => ['required', 'numeric'],
            'description' => ['required'],
        ]);

        $method = WithdrawMethod::findOrFail($id);
        $method->name = $request->name;
        $method->minimum_amount = $request->minimum_amount;
        $method->maximum_amount = $request->maximum_amount;
        $method->withdraw_charge = $request->withdraw_charge;
        $method->description = $request->description;
        $method->save();

        toastr('Update successfully', 'success');

        return redirect()->route('admin.withdraw-method.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $method = WithdrawMethod::findOrFail($id);
        $method->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
