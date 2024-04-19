<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FooterGridOneDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridOne;
use App\Models\FooterTitle;
use Illuminate\Http\Request;

class FooterGridOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridOneDataTable $dataTable){

        $footerTitle = FooterTitle::first();

        return $dataTable->render('admin.footer.footer-grid-one.index',compact('footerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('admin.footer.footer-grid-one.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $request->validate([
            'name'=>['required','max:200'],
            'url'=>['required','url'],
            'status'=>['required']
        ]);

        $footer = new FooterGridOne();
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();


        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.footer-grid-one.index');
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

        $footer = FooterGridOne::findOrFail($id);
        return view('admin.footer.footer-grid-one.edit', compact('footer'));
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){

        $request->validate([
            'name'=>['required','max:200'],
            'url'=>['required','url'],
            'status'=>['required']
        ]);

        $footer = FooterGridTwo::findOrFail($id);
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toastr('Update Successfully!', 'success', 'success');

        return redirect()->route('admin.footer-grid-one.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $footer = FooterGridOne::findOrFail($id);
        $footer->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }
    public function changeStatus(Request $request)
    {
        $footer = FooterGridOne::findOrFail($request->id);
        $footer->status = $request->status == 'true' ? 1 : 0;
        $footer->save();


        return response(['status'=>'success','message' => 'Status has been updated!',]);
    }

    public function changeTitle(Request $request){

        $request->validate([
            'title'=>['required']
        ]);

       FooterTitle::updateOrCreate(
            ['id' => 1],
            ['footer_grid_one_title' => $request->title]
        );


        toastr('Updated Successfully','success');

        return redirect()->back();
    }
}
