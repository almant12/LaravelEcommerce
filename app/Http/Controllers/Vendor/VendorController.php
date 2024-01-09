<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;

class VendorController extends Controller
{
    public function dashboard(){
        return view('vendor.dashboard.dashboard');
    }
}
