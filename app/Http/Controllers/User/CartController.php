<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Adverisement;
use App\Models\Advertisement;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller{

    public function addToCart(Request $request){

        $product = Product::findOrFail($request->product_id);

        if ($product->qty === 0){
            return response(['status'=>'error','message'=>'Product stock out']);
        }elseif ($product->qty < $request->qty){
            return response(['status'=>'error','message'=>'Quantity not available in our stock']);
        }

        $variants = [];
        $variantsTotal = 0;
        $productPrice = 0;
        if ($request->has('variants_items'))
        foreach ($request->variants_items as $itemId) {
            $variantItem = ProductVariantItem::find($itemId);
            $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
            $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
            $variantsTotal += $variantItem->price;
        }

        if (chackDiscount($product)){
            $productPrice = $product->offer_price;
        }else{
            $productPrice = $product->price;
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantsTotal;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug_name'] = $product->slug;
        Cart::add($cartData);

        return response(['status'=>'success','message'=>'Added to Cart Successfully']);
    }


    public function cartDetails(){
        $cartItems = Cart::content();
        if (count($cartItems) === 0){
            Session::forget('coupon');
        }

        $cartpage_banner_section = Advertisement::where('key', 'cartpage_banner_section')->first();
        $cartpage_banner_section = json_decode($cartpage_banner_section?->value);
        return view('frontend.pages.cart-detail',compact('cartItems','cartpage_banner_section'));
    }

    public function updateProductQyt(Request $request){

        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);
        if ($product->qty === 0){
            return response(['status'=>'error','message'=>'Product stock out']);
        }elseif ($product->qty < $request->quantity){
            return response(['status'=>'error','message'=>'Quantity not available in our stock']);
        }

        Cart::update($request->rowId,$request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status'=>'success','message'=>'Product Quantity Updated!','product_total'=>priceFormat($productTotal)]);
    }

    public function getProductTotal($rowid){

        $product = Cart::get($rowid);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    public function cartClear(){
        Cart::destroy();
        return response(['status'=>'success','message'=>'Cart Has Cleared Successfully']);
    }

    public function cartRemoveProduct($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function getCartCount(){
        return Cart::content()->count();
    }

    public function getCartProducts(){
        return Cart::content();
    }

    public function cartTotal(){
        $total = 0;
        foreach (Cart::content() as $product){
            $total += $this->getProductTotal($product->rowId);
        }
        return priceFormat($total);
    }

    public function removeSidebarProduct(Request $request){
        $rowId = $request->rowId;
        Cart::remove($rowId);
        return response(['status'=>'success','message'=>'Product removed Successfully']);
    }

    public function applyCoupon(Request $request){
        if ($request->coupon_code === null){
            return response(['status' => 'error','message'=>'Coupon filed is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if ($coupon === null){
            return response(['status'=>'error','message'=>'Coupon not exist!']);
        }elseif ($coupon->start_date > date('Y-m-d')){
            return response(['status'=>'error','message'=>'Coupon is expired']);
        }elseif ($coupon->end_date < date('Y-m-d')){
            return response(['status'=>'error','message'=>'Coupon is expired']);
        }

        if($coupon->discount_type === 'amount'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
        }elseif($coupon->discount_type === 'percent'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }


    public function couponCalculation(){

        if (Session::has('coupon')){
            $coupon = Session::get('coupon');
            $subTotal = getCartTotal();
            if ($coupon['discount_type'] === 'amount'){
                $total = $subTotal - $coupon['discount'];
                return response(['status'=>'success','cart_total'=>priceFormat($total),
                    'discount'=>priceFormat($coupon['discount']),'coupon_type'=>getCouponType()]);
            }elseif ($coupon['discount_type'] === 'percent'){
                $discount = $subTotal * $coupon['discount'] / 100;
                $total = $subTotal - $discount;
                return response(['status'=>'success','cart_total'=>priceFormat($total),
                    'discount'=>priceFormat($coupon['discount']),'coupon_type'=>getCouponType()]);
            }
        }else{
            $total = getCartTotal();
            return response(['status'=>'success','cart_total'=>priceFormat($total),'discount'=>0]);
        }
    }
}
