<?php

namespace App\Providers;

use Illuminate\View\View;
use App\Models\LogoSetting;
use App\Models\PusherSetting;
use App\Models\GeneralSetting;
use App\Models\EmailConfiguration;
use Yajra\DataTables\Html\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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

        if (Schema::hasTable('general_settings') && Schema::hasTable('pusher_settings') && Schema::hasTable('logo_settings')) {
        $generalSetting = GeneralSetting::first();
        $pusherSetting = PusherSetting::first();
        $logoSetting = LogoSetting::first();

        /** Set time zone */
        Config::set('app.timezone', $generalSetting->time_zone ?? 'Europe/Tirane');

        /** Set Broadcasting Config */
        Config::set('broadcasting.connections.pusher.key', $pusherSetting->pusher_key ?? '');
        Config::set('broadcasting.connections.pusher.secret', $pusherSetting->pusher_secret ?? '');
        Config::set('broadcasting.connections.pusher.app_id', $pusherSetting->pusher_app_id ?? '');
        Config::set('broadcasting.connections.pusher.options.host', "api-" . ($pusherSetting->pusher_cluster ?? 'default_cluster') . ".pusher.com");

        // Share variable to all views
        \Illuminate\Support\Facades\View::composer('*', function ($view) use ($generalSetting, $pusherSetting, $logoSetting) {
         $view->with(['settings' => $generalSetting, 'pusherSetting' => $pusherSetting, 'logoSetting' => $logoSetting]);
        });
   }
}
}