<?php

namespace App\Http\Controllers\User;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\About;
use App\Models\EmailConfiguration;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{


    public function contact(){
        return view('frontend.pages.contact');
    }

    public function handleContactForm(Request $request){

        $request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'subject'=>['required'],
            'message'=>['required','max:1000']
        ]);

        $settings = EmailConfiguration::first();

        MailHelper::setMailConfig();
        Mail::to($settings->email)->send(new Contact($request->subject,$request->message,$request->email));

        return response(['status' => 'success', 'message' => 'Mail sent successfully!']);
    }

    public function about(){
        $about = About::first();
        return view('frontend.pages.about-page',compact('about'));
    }

    public function termsAndCondition(){
        $termsAndCondition = TermsAndCondition::first();
        return view('frontend.pages.terms-and-condition',compact('termsAndCondition'));
    }
}
