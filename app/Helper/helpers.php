<?php
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
    return $discountPercent;

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
