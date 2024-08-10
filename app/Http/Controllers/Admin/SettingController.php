<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\PusherSetting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function index(){
        $generalSetting = GeneralSetting::first();
        $emailSettings = EmailConfiguration::first();
        $pusherSetting = PusherSetting::first();
        $logoSetting = LogoSetting::first();
        return view('admin.setting.index',compact('generalSetting','emailSettings',
        'pusherSetting','logoSetting'));
    }

    public function generalSettingUpdate(Request $request){

       $request->validate([
            'site_name'=>['required','max:200'],
            'layout'=>['required','max:200'],
            'contact_email'=>['required','email'],
            'currency_name'=>['required'],
            'phone_number'=>['required'],
            'address'=>['required'],
            'map_url'=>['required'],
            'currency_icon'=>['required'],
            'timezone'=>['required']
        ]);

        GeneralSetting::updateOrInsert(
            ['id'=>1],
            [
            'site_name'=>$request->site_name,
            'layout'=>$request->layout,
            'contact_email'=>$request->contact_email,
            'currency_name'=>$request->currency_name,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'map_url'=>$request->map_url,
            'currency_icon'=>$request->currency_icon,
            'time_zone'=>$request->timezone
            ]
        );

        toastr('Updated Successfully','success');
        return redirect()->back();
    }

    public function emailConfigSettingUpdate(Request $request){

        $request->validate([
            'email' => ['required', 'email'],
            'host' => ['required', 'max:200'],
            'username' => ['required', 'max:200'],
            'password' => ['required', 'max:200'],
            'port' => ['required', 'max:200'],
            'encryption' => ['required', 'max:200'],
        ]);

        EmailConfiguration::updateOrCreate(
            ['id'=>1],
            [
                'email' => $request->email,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
                'encryption' => $request->encryption,
            ]
        );

        toastr('Updates successfully!', 'success', 'success');
        return redirect()->back();
    }

    public function pusherSettingUpdate(Request $request){

       $validatedData = $request->validate([
            'pusher_app_id'=>['required'],
            'pusher_key'=>['required'],
            'pusher_secret'=>['required'],
            'pusher_cluster'=>['required']
        ]);

        PusherSetting::updateOrCreate(
            ['id'=>1],
            $validatedData
        );

        toastr('Updates successfully!', 'success', 'success');
        return redirect()->back();
    }


    public function logoSetting(Request $request){
        $request->validate([
            'logo'=>['image','max:3000'],
            'footer_logo'=>['image','max:3000'],
            'favicon'=>['image','max:3000']
        ]);

        $logoPath = $this->updateImage($request,'logo',$request->old_logo);
        $footerLogoPath = $this->updateImage($request,'footer_logo',$request->old_footer_logo);
        $faviconPath = $this->updateImage($request,'favicon',$request->old_favicon_logo);


        LogoSetting::updateOrCreate(
            ['id'=>1],
            [
                'logo'=> !empty($logoPath) ? $logoPath : $request->old_logo,
                'footer_logo'=> !empty($footerLogoPath) ? $footerLogoPath : $request->old_footer_logo,
                'favicon'=> !empty($faviconPath) ? $faviconPath : $request->old_favicon_logo
            ]
        );

        toastr('Updated Successfully','success','success');
        return redirect()->back();
    }
}
