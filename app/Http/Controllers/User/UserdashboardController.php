<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserdashboardController extends Controller
{
    public function index(){
        return view('frontend.dashboard.dashboard');
    }
}
