<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    

    public function index(){
        $content = TermsAndCondition::first();
        return view('admin.terms.index',compact('content'));
    }

    public function update(Request $request){

        $request->validate([
            'content'=>['required']
        ]);

        $content = collect($request);

        TermsAndCondition::updateOrInsert(
            ['id'=>1],
            ['content'=>$content['content']]
        );

        toastr('Updated Successfully','success');
        return redirect()->back();
    }
}
