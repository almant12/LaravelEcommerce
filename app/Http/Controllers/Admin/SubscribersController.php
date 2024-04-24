<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SubscribersDataTable;
use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribersController extends Controller{


    public function index(SubscribersDataTable $dataTable){
        return $dataTable->render('admin.subscriber.index');
    }


    public function sendEmail(Request $request){

        $request->validate([
            'subject'=>['required'],
            'message'=>['required']
        ]);

        MailHelper::setMailConfig();
        $emails = NewsletterSubscriber::where('is_verified',1)->pluck('email')->toArray();

        Mail::to($emails)->send(new Newsletter($request->subject,$request->message));

        toastr('Mail has been send', 'success', 'success');

        return redirect()->back();
    }

    public function destory(string $id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id)->delete();
        return response(['status' => 'success', 'message' => 'deleted successfully']);
    }
}
