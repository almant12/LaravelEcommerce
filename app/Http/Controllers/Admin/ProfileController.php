<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'username'=>['required','max:100'],
            'lastname'=>['required','max:100'],
            'email'=>['required','email','unique:users,email,'.Auth::user()->id],
            'image'=>['image','max:2048']
        ]);

        $user=Auth::user();
        if ($request->hasFile('image')){
            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('upload'),$imageName);
            $path = $imageName;

            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
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
