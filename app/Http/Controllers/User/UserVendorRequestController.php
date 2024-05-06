<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorCondition;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVendorRequestController extends Controller{

    use ImageUploadTrait;

    public function index(){
        $content = VendorCondition::first();
        return view('frontend.dashboard.vendor-request.index',compact('content'));
    }


    public function create(Request $request){

        $request->validate([
            'shop_image'=>['required','image','max:3000'],
            'shop_name'=>['required','max:200'],
            'shop_email'=>['required','email'],
            'shop_phone'=>['required','max:200'],
            'shop_address'=>['required'],
            'about'=>['required']
        ]);


        $imagePath = $this->uploadImage($request,'shop_image');


        $vendor = new Vendor();
        $vendor->banner = $imagePath;
        $vendor->shop_name = $request->shop_name;
        $vendor->email = $request->shop_email;
        $vendor->phone = $request->shop_phone;
        $vendor->address = $request->shop_address;
        $vendor->description = $request->about;
        $vendor->user_id = Auth::user()->id;
        $vendor->status = 0;
        $vendor->save();

        toastr('Submitted successfully please wait for approve!', 'success', 'success');

        return redirect()->back();
    }

}
