<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','role:admin'],'prefix'=>'admin','as'=>'admin.'],function (){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');

    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('/profile/update',[ProfileController::class,'updateProfile'])->name('profile.update');
    Route::post('/profile/update/password',[ProfileController::class,'updatePassword'])->name('password.update');

    Route::resource('slider',SliderController::class);
});


