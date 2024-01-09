<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserdashboardController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login');

Route::get('/send-email',[\App\Http\Controllers\EmailController::class,'sendEmail']);

Route::group(['middleware'=>['auth','verified'],'prefix'=>'user','as'=>'user.'],function (){
    Route::get('dashboard',[UserdashboardController::class,'index'])->name('dashboard');
    Route::get('profile',[UserProfileController::class,'index'])->name('profile');
    Route::put('profile',[UserProfileController::class,'updateProfile'])->name('profile.update');
    Route::post('profile',[UserProfileController::class,'updatePassword'])->name('profile.update.password');
});
