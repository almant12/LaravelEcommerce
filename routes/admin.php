<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminVendorProfileController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PaypalSettingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageGalleryController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductVariantItemController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingRuleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\VendorProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','role:admin'],'prefix'=>'admin','as'=>'admin.'],function (){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');

    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('/profile/update',[ProfileController::class,'updateProfile'])->name('profile.update');
    Route::post('/profile/update/password',[ProfileController::class,'updatePassword'])->name('password.update');

    //Slider
    Route::put('slider/change-status',[SliderController::class,'updateStatus'])->name('slider.update-status');
    Route::resource('slider',SliderController::class);

    //Category
    Route::put('category/change-status',[CategoryController::class,'updateStatus'])->name('category.update-status');
    Route::resource('category',CategoryController::class);

    //SubCategory
    Route::put('sub-category/change-status',[SubCategoryController::class,'updateStatus'])->name('sub-category.update-status');
    Route::resource('sub-category',SubCategoryController::class);

    //ChildCategory
    Route::put('child-category/change-status',[ChildCategoryController::class,'updateStatus'])->name('child-category.update-status');
    Route::get('get-subcategories',[ChildCategoryController::class,'getSubCategories'])->name('get-subcategories');
    Route::resource('child-category',ChildCategoryController::class);

    //Brand
    Route::put('brand/change-status',[BrandController::class,'updateStatus'])->name('brand.update-status');
    Route::resource('brand',BrandController::class);

    //VendorProfile
    Route::resource('vendor-profile',AdminVendorProfileController::class);

    //Products
    Route::get('product/get-subCategories',[ProductController::class,'getSubCategories'])->name('product.get-subCategories');
    Route::get('product/get-childCategories',[ProductController::class,'getChildCategories'])->name('product.get-childCategories');
    Route::put('product/change-status',[ProductController::class,'updateStatus'])->name('product.update-status');
    Route::resource('product',ProductController::class);

    //Products-images
    Route::resource('product-image-gallery',ProductImageGalleryController::class);

    //Products-variant
    Route::put('product-variant/change-status',[ProductVariantController::class,'updateStatus'])->name('product-variant.update-status');
    Route::resource('product-variant',ProductVariantController::class);

    //Product-variant-item
    Route::get('product-variant-item/{productId}/{variantId}',[ProductVariantItemController::class,'index'])->name('product-variant-item.index');
    Route::get('product-variant-item/create/{productId}/{variantId}',[ProductVariantItemController::class,'create'])->name('product-variant-item.create');
    Route::post('product-variant-item',[ProductVariantItemController::class,'store'])->name('product-variant-item.store');
    Route::get('product-variant-item-edit/{variantItemId}',[ProductVariantItemController::class,'edit'])->name('product-variant-item.edit');
    Route::put('product-variant-item-update/{variantItemId}',[ProductVariantItemController::class,'update'])->name('product-variant-item.update');
    Route::delete('product-variant-item/{variantItemId}',[ProductVariantItemController::class,'destroy'])->name('product-variant-item.destroy');
    Route::put('product-variant-item/update-status',[ProductVariantItemController::class,'updateStatus'])->name('product-variant-item.update-status');

    //Vendor-products
    Route::get('vendor-products',[VendorProductController::class,'index'])->name('vendor-products.index');
    Route::get('vendor-pending-products',[VendorProductController::class,'pendingProducts'])->name('vendor-pending-products.index');
    Route::put('vendor-change-approve-status',[VendorProductController::class,'changeApproveStatus'])->name('vendor-change-approve-status');

    //Flash-sale
    Route::get('flash-sale',[FlashSaleController::class,'index'])->name('flash-sale.index');
    Route::put('flash-sale',[FlashSaleController::class,'update'])->name('flash-sale.update');
    Route::post('flash-sale-item/add-product',[FlashSaleController::class,'addProduct'])->name('flash-sale.add-product');
    Route::put('flash-sale-item/update-show-at-home',[FlashSaleController::class,'updateShowAtHome'])->name('flash-sale.update-show-at-home');
    Route::put('flash-sale-item/update-status',[FlashSaleController::class,'updateStatus'])->name('flash-sale.update-status');
    Route::delete('flash-sale-item/delete/{flashId}',[FlashSaleController::class,'destroy'])->name('flash-sale.destroy');


    //Settings-routes
    Route::get('settings',[SettingController::class,'index'])->name('settings.index');
    Route::put('general-setting-update',[SettingController::class,'generalSettingUpdate'])->name('general-setting.update');

    //Coupons
    Route::put('coupon/change-status',[CouponController::class,'updateStatus'])->name('coupon.update-status');
    Route::resource('coupon',CouponController::class);

    //Shipping-rule
    Route::put('shipping-rule/change-status',[ShippingRuleController::class,'updateStatus'])->name('shipping-rule.update-status');
    Route::resource('shipping-rule',ShippingRuleController::class);

    //Payment-settings
    Route::get('payment-setting',[PaymentSettingController::class,'index'])->name('payment-setting.index');
    Route::put('paypal-setting/{id}',[PaypalSettingController::class,'update'])->name('paypal-setting.update');
});
