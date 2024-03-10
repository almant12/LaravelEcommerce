<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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

       $generalSetting = GeneralSetting::first();
       Config::set('app.timezone',$generalSetting->time_zone);

       //share variable to all views
        \Illuminate\Support\Facades\View::composer('*',function ($view) use ($generalSetting){
            $view->with('settings',$generalSetting);
        });
    }
}
