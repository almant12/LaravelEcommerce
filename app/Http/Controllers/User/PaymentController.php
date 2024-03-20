<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller{


    public function index(){
        return view('frontend.pages.payment');
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
            'intent'=>'CAPTURE',
            'application_context'=>[
                'return_url' => route('user.paypal.success'),
                'cancel_url'=> route('user.paypal.cancel')
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
        dd($request->all());
    }
}
