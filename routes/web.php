<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckOutController;
use App\Http\Controllers\User\FlashSaleController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserAddressController;
use App\Http\Controllers\User\UserDashboardController;
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
Route::get('flash-sale',[FlashSaleController::class,'index'])->name('flash-sale.index');
Route::get('product-detail/{slug}',[\App\Http\Controllers\User\UserProductController::class,'showProduct'])->name('product-detail');

Route::get('/send-email',[\App\Http\Controllers\EmailController::class,'sendEmail']);

//Cart Routes
Route::post('add-to-cart',[CartController::class,'addToCart'])->name('add-to-cart');
Route::get('cart-detail',[CartController::class,'cartDetails'])->name('cart-detail');
Route::put('cart/update-quantity',[CartController::class,'updateProductQyt'])->name('cart.update-quantity');
Route::get('cart/clear',[CartController::class,'cartClear'])->name('cart.clear');
Route::get('cart/remove-product/{rowId}',[CartController::class,'cartRemoveProduct'])->name('cart.remove');
Route::get('cart-count',[CartController::class,'getCartCount'])->name('cart.count');
Route::get('cart/content',[CartController::class,'getCartProducts'])->name('cart.products');
Route::get('cart/sidebar-product-total',[CartController::class,'cartTotal'])->name('cart.sidebar-product-total');
Route::post('cart/sidebar-remove-product',[CartController::class,'removeSidebarProduct'])->name('cart.sidebar-remove-product');

Route::get('apply-coupon',[CartController::class,'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation',[CartController::class,'couponCalculation'])->name('coupon-calculation');

Route::group(['middleware'=>['auth','verified'],'prefix'=>'user','as'=>'user.'],function (){
    Route::get('dashboard',[UserDashboardController::class,'index'])->name('dashboard');
    Route::get('profile',[UserProfileController::class,'index'])->name('profile');
    Route::put('profile',[UserProfileController::class,'updateProfile'])->name('profile.update');
    Route::post('profile',[UserProfileController::class,'updatePassword'])->name('profile.update.password');

    //UserAddress
    Route::resource('address',UserAddressController::class);

    //UserCheckout
    Route::get('checkout',[CheckOutController::class,'index'])->name('checkout');
    Route::post('checkout',[CheckOutController::class,'addAddress'])->name('checkout.address.create');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkOutFormSubmit'])->name('checkout.form-submit');

    //Payment
    Route::get('payment',[PaymentController::class,'index'])->name('payment');

    //PayPal
    Route::get('paypal/payment',[PaymentController::class,'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success',[PaymentController::class,'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel',[PaymentController::class,'paypalCancel'])->name('paypal.cancel');
});
