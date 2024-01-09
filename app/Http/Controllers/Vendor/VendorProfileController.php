<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProfileController extends Controller
{

    public function index(){
        return view('vendor.dashboard.profile');
    }

    public function updateProfile(Request $request){

        $request->validate([
            'username'=>['required','max:100'],
            'lastname'=>['required','max:100'],
            'email'=>['required','email','unique:users,email,'.Auth::user()->id],
            'image'=>['image','max:2048']
        ]);


        $user = Auth::user();

        if ($request->hasFile('image')){
            if (\Illuminate\Support\Facades\File::exists(public_path($user->image))){
                \Illuminate\Support\Facades\File::delete(public_path($user->image));
            }
            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('upload'),$imageName);
            $path = $imageName;

            $user->image = $path;
        }

        $user->username = $request->username;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
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
