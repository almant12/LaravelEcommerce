<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use App\Models\User;
use App\Helper\MailHelper;
use Illuminate\Http\Request;
use App\Mail\AccountCreatedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class ManageUserController extends Controller{
    


    public function index(){
    
        return view('admin.manage-user.index');
    }


    public function create(Request $request){

        
        $request->validate([
            'name' => ['required', 'max:200'],
            'lastname'=>['required','max:200'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        $user = new User();

        if($request->role === 'user'){
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'user';
            $user->status = 'active';
            $user->save();

            MailHelper::setMailConfig();
            Mail::to($user->email)->send(new AccountCreatedMail($user->name,$user->email,$request->password));
            toastr('Created Successfully!', 'success', 'success');
            return redirect()->back();
        }
        else if($request->role === 'vendor'){
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'vendor';
            $user->status = 'active';
            $user->save();

            $vendor = new Vendor();
            $vendor->shop_name = $request->name.'shop';
            $vendor->banner = 'uploads/1343.jpg';
            $vendor->email = 'test@gmail.com';
            $vendor->address = 'address';
            $vendor->desscription = 'desscription';
            $vendor->user_id = $user->id;
            $vendor->status = '1';
            $vendor->save();

            MailHelper::setMailConfig();
            Mail::to($user->email)->send(new AccountCreatedMail($user->name,$user->email,$request->password));
            toastr('Created Successfully!', 'success', 'success');
            return redirect()->back();
        }
        else if($request->role === 'admin'){
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'admin';
            $user->status = 'active';
            $user->save();

            $vendor = new Vendor();
            $vendor->banner = 'uploads/1343.jpg';
            $vendor->shop_name = $request->name.' Shop';
            $vendor->phone = '12321312';
            $vendor->email = 'test@gmail.com';
            $vendor->address = 'Usa';
            $vendor->description = 'shop description';
            $vendor->user_id = $user->id;
            $vendor->status = 1;
            $vendor->save();

            MailHelper::setMailConfig();
            Mail::to($user->email)->send(new AccountCreatedMail($user->name,$user->email,$request->password));
            toastr('Created Successfully!', 'success', 'success');
            return redirect()->back();
        }
    }
}
