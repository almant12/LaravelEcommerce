<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Cart;
use Illuminate\Http\Request;

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
        return view('frontend.pages.cart-detail',compact('cartItems'));
    }

    public function updateProductQyt(Request $request){

        Cart::update($request->rowId,$request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status'=>'success','message'=>'Product Quantity Updated!','product_total'=>$productTotal]);
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
        return $total;
    }

    public function removeSidebarProduct(Request $request){
        $rowId = $request->rowId;
        Cart::remove($rowId);
        return response(['status'=>'success','message'=>'Product removed Successfully']);
    }
}
