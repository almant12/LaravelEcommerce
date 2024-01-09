<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(){
        $title = 'Welcome to the laracoding.com example email';
        $body = 'Thank you for participating!';

        Mail::to('dokoalmant123@gmail.com')->send(new WelcomeMail($title,$body));

        return "Email send successfully";
    }
}
