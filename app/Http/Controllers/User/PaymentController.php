<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Cart;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller{


    public function index(){
        if (!Session::has('address')){
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess(){
        return view('frontend.pages.payment-success');
    }

    public function paypalCancel(){
        toastr('Someting went wrong try agin later!', 'error', 'Error');
        return redirect()->route('user.payment');
    }

    public function clearSession(){
        Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }

    public function orderByDeliver($paymentMethod,$paymentStatus)
    {
        $setting = GeneralSetting::first();

        $order = new Order();
        $order->invoice_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->sub_total = getCartTotal();
        $order->amount = getFinalPayableAmount();
        $order->currency_name = $setting->currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->product_qty = Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 'pending';
        $order->save();

        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->product_name = $product->name;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variants_total;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->save();

            //update product qty
            $updateQty = ($product->qty - $item->qty);
            $product->qty = $updateQty;
            $product->save();
        }
    }
    public function storeOrder($paymentMethod,$paymentStatus,$transactionId,$paidAmount,$paidCurrencyName){
        $setting = GeneralSetting::first();

        $order = new Order();
        $order->invoice_id = rand(1,999999);
        $order->user_id = Auth::user()->id;
        $order->sub_total = getCartTotal();
        $order->amount = getFinalPayableAmount();
        $order->currency_name = $setting->currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->product_qty = Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 'pending';
        $order->save();

        //store Order Product
        foreach (Cart::content() as $item){
            $product = Product::find($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->product_name = $product->name;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variants_total;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->save();

            //update product qty
            $updateQty = ($product->qty - $item->qty);
            $product->qty = $updateQty;
            $product->save();

            //store transaction details
            $transaction = new Transaction();
            $transaction->transaction_id = $transactionId;
            $transaction->payment_method = $paymentMethod;
            $transaction->amount = getFinalPayableAmount();
            $transaction->amount_real_currency = $paidAmount;
            $transaction->amount_real_currency_name = $paidCurrencyName;
            $transaction->order_id = $order->id;
            $transaction->save();
        }
    }


    private function paypalConfig(){
        $paypalSetting = PaypalSetting::first();

        $config = [
            'mode'    => $paypalSetting->mode === 1 ? 'live' : 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_ley,
                'app_id'            => '',
            ],
            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => $paypalSetting->currency_name,
            'notify_url'     => '' ,// Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true, // Validate SSL when creating api client.
        ];
        return $config;
    }

    public function payWithPaypal(){

        $config = $this->paypalConfig();
        $paypalSetting = PaypalSetting::first();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();


        //calculate paypal amount depending on currency rate
        $total = getFinalPayableAmount();
        $paypalAmount = round($total * $paypalSetting->currency_rate,2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],

            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $paypalAmount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null){
            foreach ($response['links'] as $link){
                if ($link['rel'] === 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        }else{
            return redirect()->route('user.paypal.cancel');
        }
    }

    public function paypalSuccess(Request $request){
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] === 'COMPLETED'){

            //calculate the amount depending on currency rate
            $paypalSetting = PaypalSetting::first();
            $total = getFinalPayableAmount();
            $paidAmount = round( $total * $paypalSetting->currency_rate,2);

            $this->storeOrder('paypal',1,$response['id'],$paidAmount,$paypalSetting->currency_name);

            //clear the session after the payment
            $this->clearSession();

            return redirect()->route('user.payment.success');
        }else{
            return redirect()->route('user.paypal.cancel');
        }
    }

    public function payByDeliver(){
        $this->orderByDeliver('payByDeliver',0);
        $this->clearSession();
        return redirect()->route('user.payment.success');
    }

    public function payWithStripe(Request $request){

        $stripeSetting = StripeSetting::first();
        $total = getFinalPayableAmount();
        $paidAmount = round($total * $stripeSetting->currency_rate,2);

        Stripe::setApiKey($stripeSetting->secret_key);
        $response = Charge::create([
            'amount'=>$paidAmount * 100,
            'currency'=>$stripeSetting->currency_name,
            'source'=>$request->stripe_token,
            'description'=>'bobe'
        ]);

        dd($response);

        if ($response->status === 'succeeded'){
            $this->storeOrder('stripe','1',$response->id,$paidAmount,$stripeSetting->currency_name);
            $this->clearSession();
            return redirect()->route('user.payment.success');
        }else{
            toastr('Something went wrong try aging later!', 'error', 'Error');
            return redirect()->route('user.payment');
        }
    }



}
