<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $generalSetting = GeneralSetting::first();
        return view('admin.setting.index',compact('generalSetting'));
    }

    public function generalSettingUpdate(Request $request){

        $request->validate([
            'site_name'=>['required','max:200'],
            'layout'=>['required','max:200'],
            'contact_email'=>['required','email'],
            'currency_name'=>['required'],
            'currency_icon'=>['required'],
            'timezone'=>['required']
        ]);

        GeneralSetting::updateOrCreate(
            ['id'=>1],
            [
            'site_name'=>$request->site_name,
            'layout'=>$request->layout,
            'contact_email'=>$request->contact_email,
            'currency_name'=>$request->currency_name,
            'currency_icon'=>$request->currency_icon,
            'time_zone'=>$request->timezone
            ]
        );

        toastr('Updated Successfully','success');
        return redirect()->back();
    }
}
