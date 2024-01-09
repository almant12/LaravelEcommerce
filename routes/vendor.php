<?php


use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','role:vendor'],'prefix'=>'vendor','as'=>'vendor.'],function (){
    Route::get('/dashboard',[VendorController::class,'dashboard'])->name('dashboard');
    Route::get('profile',[VendorProfileController::class,'index'])->name('profile');
    Route::put('profile',[VendorProfileController::class,'updateProfile'])->name('profile.update');
    Route::post('profile',[VendorProfileController::class,'updatePassword'])->name('profile.update.password');
});

