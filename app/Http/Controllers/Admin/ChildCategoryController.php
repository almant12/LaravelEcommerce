<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable){
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.child-category.create',compact('categories'));
    }

    public function getSubCategories(Request $request){
        $subCategories = SubCategory::where('category_id',$request->id)->where('status',1)->get();
        return $subCategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $request->validate([
            'name'=>['required','max:200','unique:child_categories,name'],
            'category'=>['required'],
            'sub-category'=>['required'],
            'status'=>['required']
        ]);

        $childCategory = new ChildCategory();
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request['sub-category'];
        $childCategory->save();

        toastr('Created Successfully','success');

        return redirect()->route('admin.child-category.index');
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
    public function edit(string $id)
    {
        $categories = Category::all();
        $childCategory = ChildCategory::findOrFail($id);
        $subCategories = SubCategory::where('category_id',$childCategory->category->id)->get();
        return view('admin.child-category.edit',compact('categories','childCategory','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>['required','max:200','unique:child_categories,name,'.$id],
            'status'=>['required'],
            'category'=>['required'],
            'subCategory'=>['required']
        ]);


        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->name = $request->name;
        $childCategory->status = $request->status;
        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->subCategory;
        $childCategory->save();

        toastr('Updated Successfully','success');

        return redirect()->route('admin.child-category.index');
    }

    public function updateStatus(Request $request){

        $childCategory = ChildCategory::findOrFail($request->id);
        $childCategory->status = $request->status == 'true' ? 1 : 0;
        $childCategory->save();

        return response(['status'=>'success','message'=>'Status updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response(['status'=>'success','message'=>'Deleted Successfully']);
    }
}
