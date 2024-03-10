<?php


use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Vendor\VendorProductImageGalleryController;
use App\Http\Controllers\Vendor\VendorProductVariantController;
use App\Http\Controllers\Vendor\VendorProductVariantItemController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','role:vendor'],'prefix'=>'vendor','as'=>'vendor.'],function (){
    Route::get('/dashboard',[VendorController::class,'dashboard'])->name('dashboard');
    Route::get('profile',[VendorProfileController::class,'index'])->name('profile');
    Route::put('profile',[VendorProfileController::class,'updateProfile'])->name('profile.update');
    Route::post('profile',[VendorProfileController::class,'updatePassword'])->name('profile.update.password');

    //Shop-profile-vendor
    Route::resource('shop-profile',VendorShopProfileController::class);

    //Vendor-product
    Route::get('product/get-subCategories',[VendorProductController::class,'getSubCategories'])->name('product.get-subCategories');
    Route::get('product/get-childCategories',[VendorProductController::class,'getChildCategories'])->name('product.get-childCategories');
    Route::put('product/change-status',[VendorProductController::class,'updateStatus'])->name('product.update-status');
    Route::resource('product',VendorProductController::class);

    //Vendor-product-gallery
    Route::resource('product-image-gallery',VendorProductImageGalleryController::class);

    //Vendor-product-variant
    Route::put('product-variant/change-status',[VendorProductVariantController::class,'updateStatus'])->name('product-variant.update-status');
    Route::resource('product-variant',VendorProductVariantController::class);

    //Vendor-product-variant-item
    Route::get('product-variant-item/edit/{variantItemId}',[VendorProductVariantItemController::class,'edit'])->name('product-variant-item.edit');
    Route::get('product-variant-item/{productId}/{variantId}',[VendorProductVariantItemController::class,'index'])->name('product-variant-item.index');
    Route::get('product-variant-item/create/{productId}/{variantId}',[VendorProductVariantItemController::class,'create'])->name('product-variant-item.create');
    Route::post('product-variant-item/store',[VendorProductVariantItemController::class,'store'])->name('product-variant-item.store');
    Route::put('product-variant-item/update/{variantItemId}',[VendorProductVariantItemController::class,'update'])->name('product-variant-item.update');
    Route::delete('product-variant-item/delete/{variantItemId}',[VendorProductVariantItemController::class,'destroy'])->name('product-variant-item.destroy');
    Route::put('product-variant-item/update-status/{variantItemId}',[VendorProductVariantItemController::class,'updateStatus'])->name('product-variant-item.update-status');
});

