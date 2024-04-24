<?php

namespace App\Http\Controllers\User;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Psy\Util\Str;

class NewsletterController extends Controller{



    public function newsletterSignup(Request $request){

        $request->validate([
            'email'=>['required','email']
        ]);

        $existSubscriber = NewsletterSubscriber::where('email',$request->email)->first();
        if (!empty($existSubscriber)){
            if ($existSubscriber->is_verified == 0){
                $existSubscriber->verified_token = \Illuminate\Support\Str::random(25);
                $existSubscriber->expired_time = Carbon::now()->addMinutes(5);
                $existSubscriber->save();

                //set mail config
                MailHelper::setMailConfig();
                //send Email
                Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));

                return response(['status' => 'success', 'message' => 'A verification link has been sent to your email please check']);
            }elseif($existSubscriber->is_verified == 1){
                return response(['status' => 'error', 'message' => 'You already subscribed with this email!']);
            }
        }else{

            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = \Illuminate\Support\Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->expired_time = Carbon::now()->addMinutes(5);
            $subscriber->save();

            //set mail config
            MailHelper::setMailConfig();
            //send Email
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));

            return response(['status' => 'success', 'message' => 'A verification link has been sent to your email please check']);
        }
    }


    public function newsletterEmailVerify($token){


        $verify = NewsletterSubscriber::where('verified_token',$token)->first();

        if (is_null($verify)){
            toastr('Token not found','error');
            return redirect()->route('home');
        }
        if ($verify->is_verified == 1){
            toastr('Email has been verified','warning');
            return redirect()->route('home');
        }

        $expiredAt = Carbon::parse($verify->expired_time);
        if ($expiredAt->isPast()){
            toastr('Token has expired','error');
            return redirect()->route('home');
        }else{
            $verify->is_verified = 1;
            $verify->save();

            toastr('Email verification successfully','success');
            return redirect()->route('home');
        }
    }
}
