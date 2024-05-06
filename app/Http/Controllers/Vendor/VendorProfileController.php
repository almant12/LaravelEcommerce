<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProfileController extends Controller
{

    use ImageUploadTrait;
    public function index(){
        return view('vendor.dashboard.profile');
    }

    public function updateProfile(Request $request){

        $request->validate([
            'name'=>['required','max:100'],
            'lastname'=>['required','max:100'],
            'email'=>['required','email','unique:users,email,'.Auth::user()->id],
            'image'=>['image','max:2048']
        ]);


        $user = Auth::user();

        $pathImage = $this->updateImage($request,'image',$user->image);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->image = empty(!$pathImage) ? $pathImage : $user->image;
        $user->save();

        toastr()->success('Profile updated successfully');
        return redirect()->back();
    }

    public function updatePassword(Request $request){

        $request->validate([
            'current_password'=>['required','current_password'],
            'password'=>['required','confirmed','min:8']
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        toastr()->success('Profile Password Updated Successfully');
        return redirect()->back();
    }
}
