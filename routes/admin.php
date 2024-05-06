<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminVendorProfileController;
use App\Http\Controllers\Admin\AdminVendorRequestController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerListController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\FooterGridOneController;
use App\Http\Controllers\Admin\FooterGridTwoController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\FooterSocialController;
use App\Http\Controllers\Admin\HomePageSettingController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
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
use App\Http\Controllers\Admin\StripeSettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\VendorConditionController;
use App\Http\Controllers\Admin\VendorListController;
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


    //Coupons
    Route::put('coupon/change-status',[CouponController::class,'updateStatus'])->name('coupon.update-status');
    Route::resource('coupon',CouponController::class);

    //Shipping-rule
    Route::put('shipping-rule/change-status',[ShippingRuleController::class,'updateStatus'])->name('shipping-rule.update-status');
    Route::resource('shipping-rule',ShippingRuleController::class);

    //Order-routes
    Route::put('order/update-status',[OrderController::class,'updateOrderStatus'])->name('order.status');
    Route::get('order/update-payment-status',[OrderController::class,'updatePaymentStatus'])->name('payment.status');
    Route::get('order/pending',[OrderController::class,'pendingOrder'])->name('pending-orders');
    Route::get('order/processed',[OrderController::class,'processedOrder'])->name('processed-orders');
    Route::get('order/dropped-off-orders',[OrderController::class,'droppedOff'])->name('dropped-off-orders');
    Route::get('order/shipped',[OrderController::class,'shipped'])->name('shipped-orders');
    Route::get('order/out-for-delivery',[OrderController::class,'outForDelivery'])->name('out-for-delivery-orders');
    Route::get('order/delivered',[OrderController::class,'delivered'])->name('delivered-orders');
    Route::get('order/canceled',[OrderController::class,'canceled'])->name('canceled-orders');
    Route::resource('order',OrderController::class);

    //Transaction
    Route::get('transaction',[TransactionController::class,'index'])->name('transaction');

    //Settings-routes
    Route::get('settings',[SettingController::class,'index'])->name('settings.index');
    Route::put('general-setting-update',[SettingController::class,'generalSettingUpdate'])->name('general-setting.update');
    Route::put('email-config/update',[SettingController::class,'emailConfigSettingUpdate'])->name('email-setting-update');
    Route::put('pusher-setting/update',[SettingController::class,'pusherSettingUpdate'])->name('pusher-setting.update');

    //HomePageSetting
    Route::get('home-page-setting',[HomePageSettingController::class,'index'])->name('home-page-setting.index');
    Route::put('popular-category-sections',[HomePageSettingController::class,'updatePopularCategorySection'])->name('update.popular-category-section');
    Route::put('product-slider-section-one',[HomePageSettingController::class,'updateProductSliderSectionOne'])->name('update.product-slider-section-one');
    Route::put('product-slider-section-two',[HomePageSettingController::class,'updateProductSliderSectionTwo'])->name('update.product-slider-section-two');
    Route::put('product-slider-section-three',[HomePageSettingController::class,'updateProductSliderSectionThree'])->name('update.product-slider-section-three');

    //Payment-settings
    Route::get('payment-setting',[PaymentSettingController::class,'index'])->name('payment-setting.index');
    Route::put('paypal-setting/{id}',[PaypalSettingController::class,'update'])->name('paypal-setting.update');
    Route::put('stripe-setting/{id}',[StripeSettingController::class,'update'])->name('stripe-setting.update');

    //FooterInfo
    Route::resource('footer-info',FooterInfoController::class);
    Route::put('footer-socials/update-status',[FooterSocialController::class,'updateStatus'])->name('footer-socials.update-status');
    Route::resource('footer-socials',FooterSocialController::class);

    Route::put('footer-grid-one/change-status',[FooterGridOneController::class,'changeStatus'])->name('footer-grid-one.change-status');
    Route::put('footer-grid-one/change-title',[FooterGridOneController::class,'changeTitle'])->name('footer-grid-one.change-title');
    Route::resource('footer-grid-one',FooterGridOneController::class);

    Route::put('footer-grid-two/change-status',[FooterGridTwoController::class,'changeStatus'])->name('footer-grid-two.change-status');
    Route::put('footer-grid-two/change-title',[FooterGridTwoController::class,'changeTitle'])->name('footer-grid-two.change-title');
    Route::resource('footer-grid-two',FooterGridTwoController::class);

    //Subscriber
    Route::get('subscribers',[SubscribersController::class,'index'])->name('subscriber.index');
    Route::post('subscriber/send-email',[SubscribersController::class,'sendEmail'])->name('subscriber.send-email');
    Route::delete('subscribers/{id}', [SubscribersController::class, 'destory'])->name('subscriber.destory');

    //Advertisement
    Route::get('advertisement',[AdvertisementController::class,'index'])->name('advertisement.index');
    Route::put('advertisement/homepage-section-banner-one',[AdvertisementController::class,'homepageBannerSectionOne'])->name('homepage-banner-section-one');
    Route::put('advertisement/homepage-section-banner-two',[AdvertisementController::class,'homepageSectionBannerTwo'])->name('homepage-banner-section-two');
    Route::put('advertisement/homepage-section-banner-three',[AdvertisementController::class,'homepageBannerSectionThree'])->name('homepage-banner-section-three');
    Route::put('advertisement/homepage-section-banner-four',[AdvertisementController::class,'homepageBannerSectionFour'])->name('homepage-banner-section-four');
    Route::put('advertisement/productpage-banner', [AdvertisementController::class, 'productPageBanner'])->name('productpage-banner');
    Route::put('advertisement/cartpage-banner', [AdvertisementController::class, 'cartPageBanner'])->name('cartpage-banner');

    //VendorRequest
    Route::get('vendor-request',[AdminVendorRequestController::class,'index'])->name('vendor-request.index');
    Route::get('vendor-request/show/{id}',[AdminVendorRequestController::class,'show'])->name('vendor-request.show');
    Route::put('vendor-request/change-status/{id}',[AdminVendorRequestController::class,'changeStatus'])->name('vendor-request.change-status');

    //CustomersList
    Route::get('customer', [CustomerListController::class, 'index'])->name('customer.index');
    Route::put('customer/status-change', [CustomerListController::class, 'changeStatus'])->name('customer.status-change');

    //VendorsList
    Route::get('vendor-list', [VendorListController::class, 'index'])->name('vendor-list.index');
    Route::put('vendor-list/status-change', [VendorListController::class, 'changeStatus'])->name('vendor-list.status-change');

    //ManageUser
    Route::get('manage-user',[ManageUserController::class,'index'])->name('manage-user.index');
    Route::post('manage-user',[ManageUserController::class,'create'])->name('manage-user.create');

    //VendorCondition
    Route::get('vendor-condition', [VendorConditionController::class, 'index'])->name('vendor-condition.index');
    Route::put('vendor-condition/update', [VendorConditionController::class, 'update'])->name('vendor-condition.update');

    //About
    Route::get('about',[AboutController::class,'index'])->name('about.index');
    Route::put('about',[AboutController::class,'update'])->name('about.update');

    //TermsAndCondition
    Route::get('terms-and-condition',[TermsAndConditionController::class,'index'])->name('terms-and-condition.index');
    Route::put('terms-and-condition',[TermsAndConditionController::class,'update'])->name('terms-and-condition.update');

    //Messengers
    Route::get('messages',[MessageController::class,'index'])->name('messages.index');
    Route::post('send-message',[MessageController::class,'sendMessage'])->name('send-message');
    Route::get('get-messages',[MessageController::class,'getMessages'])->name('get-messages');

});
