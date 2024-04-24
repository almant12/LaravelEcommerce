<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FooterGridTwoDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridTwo;
use App\Models\FooterTitle;
use Illuminate\Http\Request;
use function Termwind\render;

class FooterGridTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridTwoDataTable $dataTable){
        $footerTitle = FooterTitle::first();
        return $dataTable->render('admin.footer.footer-grid-two.index',compact('footerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('admin.footer.footer-grid-two.create');
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

        $footer = new FooterGridTwo();
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();


        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.footer-grid-two.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){

        $footer = FooterGridTwo::findOrFail($id);
        return view('admin.footer.footer-grid-two.edit',compact('footer'));
    }

    /**
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
    public function destroy(string $id)
    {
        $footer = FooterGridTwo::findOrFail($id);
        $footer->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeTitle(Request $request){

        $request->validate([
            'title'=>['required']
        ]);

        FooterTitle::updateOrCreate(
            ['id'=>1],
            ['footer_grid_two_title'=>$request->title]
        );

        toastr('Updated Successfully','success');

        return redirect()->back();
    }

    public function changeStatus(Request $request){

        $footer = FooterGridTwo::findOrFail($request->id);
        $footer->status = $request->status == 'true' ? 1 : 0;
        $footer->save();

        return response(['status'=>'success','message' => 'Status has been updated!',]);
    }
}
