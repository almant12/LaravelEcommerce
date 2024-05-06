<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller{
    

    public function index(){

        $content = About::first();
        return view('admin.about.index',compact('content'));
    }

    public function update(Request $request){

        $request->validate([
            'content'=>['required']
        ]);


        $collect = collect($request);

        About::updateOrInsert(
            ['id'=>1],
            ['content'=> $collect['content']]
        );

        toastr('Updated Successfully','success');

        return redirect()->back();
    }
}
