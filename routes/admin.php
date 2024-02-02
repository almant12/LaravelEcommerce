<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','role:admin'],'prefix'=>'admin','as'=>'admin.'],function (){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');

    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('/profile/update',[ProfileController::class,'updateProfile'])->name('profile.update');
    Route::post('/profile/update/password',[ProfileController::class,'updatePassword'])->name('password.update');

    //slider
    Route::resource('slider',SliderController::class);

    //category
    Route::put('category/change-status',[CategoryController::class,'updateStatus'])->name('category.update-status');
    Route::resource('category',CategoryController::class);

    //subCategory
    Route::put('sub-category/change-status',[SubCategoryController::class,'updateStatus'])->name('sub-category.update-status');
    Route::resource('sub-category',SubCategoryController::class);

    //childCategory
    Route::put('child-category/change-status',[ChildCategoryController::class,'updateStatus'])->name('child-category.update-status');
    Route::get('get-subcategories',[ChildCategoryController::class,'getSubCategories'])->name('get-subcategories');
    Route::resource('child-category',ChildCategoryController::class);
});
