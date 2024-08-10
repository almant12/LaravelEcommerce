<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\PusherSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Yajra\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Paginator::useBootstrap();
       Builder::useVite();

       $generalSetting = GeneralSetting::first();
       $pusherSetting = PusherSetting::first();
       $logoSetting = LogoSetting::first();

//       $mailSetting = EmailConfiguration::first();

        /** set time zone */
        Config::set('app.timezone', $generalSetting->time_zone ?? 'UTC');

        /** Set Broadcasting Config */
        Config::set('broadcasting.connections.pusher.key', $pusherSetting->pusher_key);
        Config::set('broadcasting.connections.pusher.secret', $pusherSetting->pusher_secret);
        Config::set('broadcasting.connections.pusher.app_id', $pusherSetting->pusher_app_id);
        Config::set('broadcasting.connections.pusher.options.host', "api-".$pusherSetting->pusher_cluster.".pusher.com");


//        /** Set Mail Config */
//        Config::set('mail.mailers.smtp.host', $mailSetting->host);
//        Config::set('mail.mailers.smtp.port', $mailSetting->port);
//        Config::set('mail.mailers.smtp.encryption', $mailSetting->encryption);
//        Config::set('mail.mailers.smtp.username', $mailSetting->username);
//        Config::set('mail.mailers.smtp.password', $mailSetting->password);

       //share variable to all views
        \Illuminate\Support\Facades\View::composer('*',function ($view) use ($generalSetting,$pusherSetting,$logoSetting){
            $view->with(['settings'=>$generalSetting,'pusherSetting'=>$pusherSetting,'logoSetting'=>$logoSetting]);
        });
    }
}
