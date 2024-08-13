<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller{


    public function index(){

        $wishlistProducts = Wishlist::with('product')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('frontend.pages.wishlist',compact('wishlistProducts'));
    }

    public function addToWishlist(Request $request){

        if(!Auth::check()){
            dd('here');
            return response()->json(['status'=>'error','message'=>'Login before add a product into wishlist'],401);
        }
        $wishlistCount = Wishlist::where(['product_id'=>$request->id,'user_id'=>Auth::user()->id])->count();
        if ($wishlistCount > 0){
            return response(['status'=>'error','message'=>'The product is already at wishlist']);
        }

        $wishlist = new Wishlist();
        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();

        $count = Wishlist::where('user_id',Auth::user()->id)->count();

        return  response(['status'=>'success','message'=>'product added to wishlist','count'=>$count]);
    }

    public function destroy(string $id){

        $wishlist = Wishlist::where('id',$id)->firstOrFail();

        if ($wishlist->user_id != Auth::user()->id){
            return redirect()->back();
        }

        $wishlist->delete();
        toastr('Product removed Successfully','success');

        return redirect()->back();
    }
}
