<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use ImageUploadTrait;
    public function index(){
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name'=>['required','max:100'],
            'lastname'=>['required','max:100'],
            'email'=>['required','email','unique:users,email,'.Auth::user()->id],
            'image'=>['image','max:2048']
        ]);
        $user=Auth::user();

        $pathImage = $this->updateImage($request,'image',$user->image);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->image = empty(!$pathImage) ? $pathImage : $user->image;
        $user->save();

        toastr()->success('Profile Updated Successfully!');
        return redirect()->back();
    }

    public function updatePassword(Request $request){
       $request->validate([
           'current_password'=>['required','current_password'],
           'password'=>['required','confirmed','min:8']
       ]);

       $request->user()->update([
           'password'=>bcrypt($request->password)
       ]);

       toastr()->success('Password Updated Successfully!');
       return redirect()->back();
    }
}
