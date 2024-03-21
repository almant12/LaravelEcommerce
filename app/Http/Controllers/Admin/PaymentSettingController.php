<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{

    public function index(){

        $paypalSetting = PaypalSetting::first();
        $stripeSetting = StripeSetting::first();
        return view('admin.payment-settings.index',compact('paypalSetting','stripeSetting'));
    }
}
