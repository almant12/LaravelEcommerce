<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller{


    public function index(){
        if(getCartTotal() <= 0){
            toastr('You Should Pick Up A Product First','error');
            return redirect()->route('home');
        }
        $addresses = UserAddress::where('user_id',Auth::user()->id)->get();
        $shippings = ShippingRule::all();
        return view('frontend.pages.checkout',compact('addresses','shippings'));
    }

    public function addAddress(Request $request){

        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'phone' => ['required', 'max:200'],
            'country' => ['required', 'max:200'],
            'state' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip' => ['required', 'max:200'],
            'address' => ['required'],
        ]);

        $userAddress = new UserAddress();
        $userAddress->user_id = Auth::user()->id;
        $userAddress->name = $request->name;
        $userAddress->email = $request->email;
        $userAddress->phone = $request->phone;
        $userAddress->country = $request->country;
        $userAddress->state = $request->state;
        $userAddress->city = $request->city;
        $userAddress->zip = $request->zip;
        $userAddress->address = $request->address;
        $userAddress->save();

        toastr('Created Successfully');
        return redirect()->back();
    }


    public function checkOutFormSubmit(Request $request){

        $request->validate([
            'shipping_method_id'=>['required','integer'],
            'shipping_address_id'=>['required','integer']
        ]);

        $shippingMethod = ShippingRule::findOrFail($request->shipping_method_id);
        if ($shippingMethod){
            Session::put('shipping_method',[
                'id'=>$shippingMethod->id,
                'name'=>$shippingMethod->name,
                'type'=>$shippingMethod->type,
                'cost'=>$shippingMethod->cost
            ]);
        }
        $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        if ($address){
            Session::put('address',$address);
        }

        return response(['status'=>'success','redirect_url'=>route('user.payment')]);
    }
}
