<?php
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Session;


function priceFormat(float $price){
    $formatted_price = number_format($price, 0, '.', ' '); // Adds thousand separators
    return $formatted_price;
}
function setActive(array $route){
    if (array($route)){
        foreach ($route as $r){
            if (request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

function chackDiscount($product){
    $currentDate = date('Y-m-d');
    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date){
        return true;
    }else{
        return false;
    }
}

function calculateDiscountPercent($originalPrice,$discountPrice){
    $discountAmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice) * 100;
    return round($discountPercent,0);

}

function productType(string $type){

    switch ($type) {
        case 'new_arrival';
            return 'New';
            break;
        case 'featured_product';
            return 'Featured';
            break;
        case 'top_product';
            return 'Top';
            break;
        case 'best_product';
            return 'Best';
            break;

        default:
            return '';
            break;
    }
}

function getCartTotal(){
    $total = 0;
    foreach(\Cart::content() as $product){
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}

function getMainCartTotal(){
    if (Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if ($coupon['discount_type'] === 'amount'){
            $total = $subTotal - $coupon['discount'];
            return $total;
        }elseif ($coupon['discount_type'] === 'percent'){
            $discount = $subTotal * $coupon['discount'] / 100;
            $total = $subTotal - $discount;
            return $total;
        }
    }else{
        return getCartTotal();
    }
}

function getCartDiscount(){
    if (Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if ($coupon['discount_type'] === 'amount'){
            return $coupon['discount'];
        }elseif ($coupon['discount_type'] === 'percent'){
            return $coupon['discount'];
        }
    }else{
        return 0;
    }
}
function getCouponType(){
    if (Session::has('coupon')){
        $coupon = Session::get('coupon');
        if ($coupon['discount_type'] === 'percent'){
            return 'percent';
        }elseif ($coupon['discount_type'] === 'amount'){
            return 'amount';
        }
    }else{
        return null;
    }
}

function getShppingFee(){
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else {
        return 0;
    }
}

function getFinalPayableAmount(){
    return  getMainCartTotal() + getShppingFee();
}

function limitText($text, $limit = 30)
{
    return \Str::limit($text, $limit);
}


function getCurrencyIcon()
{
    $icon = GeneralSetting::first();

    return $icon->currency_icon;
}
