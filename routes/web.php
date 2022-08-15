<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PropertyController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\PaypalController;
use App\Http\Controllers\User\OrderController;



use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminDashboardController;



use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ConditionPrivacyController;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\PaymentAccountController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Controllers\Admin\ValidationTextController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\ContactInformationController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ListingReviewController;
use App\Http\Controllers\Admin\BlogCommentController;



use App\Http\Controllers\Admin\SeoTextController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\BannerImageController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\CustomPageController;
use App\Http\Controllers\Admin\PaginatorController;
use App\Http\Controllers\Admin\EmailConfigurationController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CountryStateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\PropertyPurposeController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\AminityController;
use App\Http\Controllers\Admin\NearestLocationController;
use App\Http\Controllers\Admin\AdminPropertyController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\UserController;


use App\Http\Controllers\Staff\Auth\StaffLoginController;
use App\Http\Controllers\Staff\Auth\StaffForgotPasswordController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffPropertyController;
use App\Http\Controllers\Staff\StaffProfileController;











use Illuminate\Support\Facades\Route;

// Route::get('/',function(){
//     return view('layouts.user.index');
// });

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/about-us',[HomeController::class,'aboutUs'])->name('about.us');
Route::get('/blog',[HomeController::class,'blog'])->name('blog');
Route::get('/blog-details/{slug}',[HomeController::class,'blogDetails'])->name('blog.details');
Route::get('/blog-category/{slug}',[HomeController::class,'blogCategory'])->name('blog.category');
Route::get('/blog-search',[HomeController::class,'blogSearch'])->name('blog.search');
Route::post('/blog-comment/{id}',[HomeController::class,'blogComment'])->name('blog.comment');
Route::get('/faq',[HomeController::class,'faq'])->name('faq');
Route::get('/contact-us',[HomeController::class,'contactUs'])->name('contact.us');
Route::post('contact-message',[ContactController::class,'sendMessage'])->name('contact.message');
Route::get('terms-and-conditions',[HomeController::class,'termsCondition'])->name('terms-and-conditions');
Route::get('privacy-policy',[HomeController::class,'privacyPolicy'])->name('privacy-policy');
Route::get('subscribe-us',[HomeController::class,'subscribeUs'])->name('subscribe-us');
Route::get('subscription-verify/{token}',[HomeController::class,'subscriptionVerify'])->name('subscription.verify');
Route::get('page/{slug}',[HomeController::class,'customPage'])->name('custom.page');
Route::get('agents',[HomeController::class,'agent'])->name('agents');
Route::get('agent',[HomeController::class,'agentDetails'])->name('agent.show');


Route::get('/pricing-plan',[HomeController::class,'pricingPlan'])->name('pricing.plan');
Route::get('/properties',[HomeController::class,'properties'])->name('properties');
Route::get('/property/{slug}',[HomeController::class,'propertDetails'])->name('property.details');
Route::get('search-property',[HomeController::class,'searchPropertyPage'])->name('search-property');





Route::post('user-contact-message',[ContactController::class,'messageForUser'])->name('user.contact.message');

Route::get('/download-listing-file/{file}',[HomeController::class,'downloadListingFile'])->name('download-listing-file');





//user profile section
Route::group(['as'=> 'user.', 'prefix' => 'user'],function (){
    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('my-properties',[PropertyController::class,'index'])->name('my.properties');
    Route::get('create-property',[PropertyController::class,'create'])->name('create.property');
    Route::post('store-property',[PropertyController::class,'store'])->name('property.store');
    Route::get('edit-property/{id}',[PropertyController::class,'edit'])->name('property.edit');
    Route::get('property-slider-img/{id}',[PropertyController::class,'propertySliderImage'])->name('property-slider-img');
    Route::get('property-delete-pdf/{id}',[PropertyController::class,'deletePdfFile'])->name('property-delete-pdf');
    Route::get('exist-nearest-location/{id}',[PropertyController::class,'existNearestLocation'])->name('exist-nearest-location');
    Route::post('update-property/{id}',[PropertyController::class,'update'])->name('property.update');
    Route::get('delete-property/{id}',[PropertyController::class,'destroy'])->name('property.delete');
    Route::get('exist-property-slider-img/{id}',[PropertyController::class,'existSliderImage'])->name('exist-property-slider-img');
    Route::get('find-exist-nearest-location/{id}',[PropertyController::class,'findExistNearestLocation'])->name('find-exist-nearest-location');

    Route::get('/pricing-plan',[UserHomeController::class,'pricingPlan'])->name('pricing.plan');


    Route::get('my-review',[UserHomeController::class,'myReview'])->name('my-review');
    Route::get('delete-review',[UserHomeController::class,'deleteReview'])->name('delete-review');

    Route::get('client-review',[UserHomeController::class,'clientReview'])->name('client-review');
    Route::post('store-review',[UserHomeController::class,'storeReview'])->name('store-review');
    Route::get('edit-review/{id}',[UserHomeController::class,'editReview'])->name('edit-review');
    Route::post('update-review/{id}',[UserHomeController::class,'updateReview'])->name('update-review');
    Route::get('delete-review/{id}',[UserHomeController::class,'deleteReview'])->name('delete-review');
    Route::get('my-profile',[UserHomeController::class,'profile'])->name('my-profile');
    Route::post('update-profile',[UserHomeController::class,'updateProfile'])->name('update.profile');
    Route::post('update-password',[UserHomeController::class,'updatePassword'])->name('update.password');
    Route::post('update-profile-banner',[UserHomeController::class,'updateProfileBanner'])->name('update.profile.banner');

    Route::get('my-wishlist',[WishlistController::class,'wishlist'])->name('my-wishlist');
    Route::get('add-to-wishlist/{id}',[WishlistController::class,'create'])->name('add.to.wishlist');
    Route::get('delete-wishlist/{id}',[WishlistController::class,'delete'])->name('delete.wishlist');

    Route::get('purchase-package/{id}',[PaymentController::class,'purchase'])->name('purchase.package');

    Route::post('bank-payment',[PaymentController::class,'bankPayment'])->name('bank-payment');


    Route::get('paypal/{id}',[PaypalController::class,'store'])->name('paypal');
    Route::get('paypal-payment-success',[PaypalController::class,'paymentSuccess']);
    Route::get('paypal-payment-cancled',[PaypalController::class,'paymentCancled']);
    Route::post('stripe-payment/{id}',[PaymentController::class,'stripePayment'])->name('stripe.payment');
    Route::get('my-order',[OrderController::class,'index'])->name('my-order');
    Route::get('order-details/{id}',[OrderController::class,'show'])->name('order.details');
    Route::get('package',[UserHomeController::class,'ListingPackage'])->name('package');
    Route::post('razorpay-payment/{id}',[PaymentController::class,'razorPay'])->name('razorpay-payment');
    Route::post('flutterwave-payment',[PaymentController::class,'flutterWavePayment'])->name('flutterwave-payment');

    Route::post('paystack-payment',[PaymentController::class,'paystackPayment'])->name('paystack-payment');
    Route::get('mollie-payment/{id}',[PaymentController::class,'molliePayment'])->name('mollie-payment');
    Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
    Route::get('/pay-with-instamojo/{id}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
    Route::get('/instamojo-response', [PaymentController::class, 'instamojoResponse'])->name('instamojo-response');

    Route::post('/pay-with-paymongo/{id}', [PaymentController::class, 'payWithPaymongo'])->name('pay-with-paymongo');
    Route::get('/pay-with-grab-pay/{id}', [PaymentController::class, 'payWithPaymongoGrabPay'])->name('pay-with-grab-pay');
    Route::get('/pay-with-gcash/{id}', [PaymentController::class, 'payWithPaymongoGcash'])->name('pay-with-gcash');
    Route::get('/paymongo-payment-success', [PaymentController::class, 'paymongoPaymentSuccess'])->name('paymongo-payment-success');
    Route::get('/paymongo-payment-cancled', [PaymentController::class, 'paymongoPaymentCancled'])->name('paymongo-payment-cancled');


});



// user custom auth route
Route::get('register',[RegisterController::class,'userRegisterPage'])->name('register');
Route::post('register',[RegisterController::class,'storeRegister'])->name('register');
Route::get('user-verify/{token}',[RegisterController::class,'userVerify'])->name('user.verify');
Route::get('login',[LoginController::class,'userLoginPage'])->name('login');
Route::post('login',[LoginController::class,'storeLogin'])->name('login');
Route::get('logout',[LoginController::class,'userLogout'])->name('logout');
Route::get('forget-password',[ForgotPasswordController::class,'forgetPassForm'])->name('forget.password');
Route::post('send-forget-password',[ForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
Route::get('reset-password/{token}',[ForgotPasswordController::class,'resetPassword'])->name('reset.password');
Route::post('store-reset-password/{token}',[ForgotPasswordController::class,'storeResetData'])->name('store.reset.password');




// admin routes

Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){
    // login route
    Route::get('/',[AdminLoginController::class,'adminLoginForm'])->name('login');
    Route::get('login',[AdminLoginController::class,'adminLoginForm'])->name('login');
    Route::post('login',[AdminLoginController::class,'storeLoginInfo'])->name('login');
    Route::get('/logout',[AdminLoginController::class,'adminLogout'])->name('logout');
    Route::get('forget-password',[AdminForgotPasswordController::class,'forgetPassword'])->name('forget.password');
    Route::post('send-forget-password',[AdminForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
    Route::get('reset-password/{token}',[AdminForgotPasswordController::class,'resetPassword'])->name('reset.password');
    Route::post('store-reset-password/{token}',[AdminForgotPasswordController::class,'storeResetData'])->name('store.reset.password');

    // manage admin profile
    Route::get('profile',[ProfileController::class,'profile'])->name('profile');
    Route::post('update-profile',[ProfileController::class,'updateProfile'])->name('update.profile');

    //  admin
    Route::resource('admin-list',AdminController::class);
    Route::get('admin-status/{id}', [AdminController::class,'changeStatus'])->name('admin.status');




    // Terms-condition and privacy-policy
    Route::resource('terms-privacy', ConditionPrivacyController::class);

    // manage day
    Route::resource('day',DayController::class);

    // payment Account information
    Route::resource('payment-account',PaymentAccountController::class);
    Route::post('razorpay-update/{id}',[PaymentAccountController::class,'razorpayUpdate'])->name('razorpay-update');
    Route::post('stripe-update/{id}',[PaymentAccountController::class,'stripeUpdate'])->name('stripe-update');
    Route::post('bank-update/{id}',[PaymentAccountController::class,'bankUpdate'])->name('bank-update');
    Route::post('flutterwave-update/{id}',[PaymentAccountController::class,'flutterwaveUpdate'])->name('flutterwave-update');

    Route::post('paystack-update/{id}',[PaymentAccountController::class,'paystackUpdate'])->name('paystack-update');
    Route::post('mollie-update/{id}',[PaymentAccountController::class,'updateMollie'])->name('mollie-update');
    Route::post('instamojo-update/{id}',[PaymentAccountController::class,'updateInstamojo'])->name('instamojo-update');
    Route::post('paymongo-update/{id}',[PaymentAccountController::class,'updatePaymongo'])->name('paymongo-update');



    // setting start
    Route::resource('settings',SettingsController::class);
    Route::get('comment-setting',[SettingsController::class,'blogCommentSetting'])->name('comment.setting');
    Route::post('update-comment-setting',[SettingsController::class,'updateCommentSetting'])->name('update.comment.setting');
    Route::get('cookie-consent-setting',[SettingsController::class,'cookieConsentSetting'])->name('cookie.consent.setting');
    Route::post('update-cookie-consent',[SettingsController::class,'updateCookieConsentSetting'])->name('update.cookie.consent.setting');
    Route::get('captcha-setting',[SettingsController::class,'captchaSetting'])->name('captcha.setting');
    Route::post('update-captcha-setting',[SettingsController::class,'updateCaptchaSetting'])->name('update.captcha.setting');

    Route::get('livechat-setting',[SettingsController::class,'livechatSetting'])->name('livechat.setting');
    Route::post('update-livechat-setting',[SettingsController::class,'updateLivechatSetting'])->name('update.livechat.setting');

    Route::get('preloader-setting',[SettingsController::class,'preloaderSetting'])->name('preloader.setting');
    Route::post('preloader-update/{id}',[SettingsController::class,'preloaderUpdate'])->name('preloader.update');

    Route::get('google-analytic-setting',[SettingsController::class,'googleAnalytic'])->name('google.analytic.setting');
    Route::post('google-analytic-update',[SettingsController::class,'googleAnalyticUpdate'])->name('google.analytic.update');



    Route::get('email-template',[SettingsController::class,'emailTemplate'])->name('email.template');
    Route::get('email-template-edit/{id}',[SettingsController::class,'editEmail'])->name('email-edit');
    Route::post('email-template-update/{id}',[SettingsController::class,'updateEmail'])->name('email.update');

    // clear database
    Route::get('clear-database',[SettingsController::class,'clearDatabase'])->name('clear.database');
    Route::get('clear-all',[SettingsController::class,'destroyDatabase'])->name('clear.all.data');


    Route::get('theme-color',[SettingsController::class,'themeColor'])->name('theme-color');
    Route::post('theme-color.update',[SettingsController::class,'themeColorUpdate'])->name('theme-color.update');


     // setting end


    // subscriber
    Route::get('subscriber',[SubscriberController::class,'index'])->name('subscriber');
    Route::get('subscriber-delete/{id}',[SubscriberController::class,'delete'])->name('subscriber.delete');
    Route::get('subscriber-email',[SubscriberController::class,'emailTemplate'])->name('subscriber.email');
    Route::post('send-subscriber-email',[SubscriberController::class,'sendMail'])->name('send.subscriber.mail');






    // check notification
    Route::get('view-order-notify',[AdminOrderController::class,'viewOrderNotify'])->name('view.order.notify');
    Route::get('view-message-notify',[AdminOrderController::class,'viewMessageNotify'])->name('view.message.notify');



    Route::get('setup-text',[TextController::class,'index'])->name('setup.text');
    Route::post('update-text',[TextController::class,'update'])->name('update.text');




    Route::get('validation-errors',[ValidationTextController::class,'index'])->name('validation.errors');
    Route::post('update-validation-text',[ValidationTextController::class,'update'])->name('update.validation.text');

    Route::get('notification-text',[ValidationTextController::class,'notification'])->name('notification.text');
    Route::post('update-notification-text',[ValidationTextController::class,'updateNotification'])->name('update.notification.text');

     //admin Dashboard
     Route::get('dashboard',[AdminDashboardController::class,'index'])->name('dashboard');

     // manage blog category
    Route::resource('blog-category', BlogCategoryController::class);
    Route::get('blog-category-status/{id}',[BlogCategoryController::class,'changeStatus'])->name('blog.category.status');

    // blog
    Route::resource('blog', BlogController::class);
    Route::get('blog-status/{id}',[BlogController::class,'changeStatus'])->name('blog.status');

    // Blog comment
    Route::get('blog-comment',[BlogCommentController::class,'allComments'])->name('blog-comment');
    Route::get('delete-blog-comment/{id}',[BlogCommentController::class,'deleteComment'])->name('delete.blog.comment');
    Route::get('blog-comment-status/{id}',[BlogCommentController::class,'changeStatus'])->name('blog.comment.status');

    // about
    Route::resource('about', AboutController::class);
    Route::resource('about-section', AboutSectionController::class);
    Route::post('section-about.update/{id}', [AboutSectionController::class,'sectionAboutUpdate'])->name('section-about.update');
    Route::post('section-feature.update/{id}', [AboutSectionController::class,'sectionFeatureUpdate'])->name('section-feature.update');


    // contact info
    Route::resource('contact-information',ContactInformationController::class);
    Route::post('topbar-contact/{id}',[ContactInformationController::class,'topbarContact'])->name('topbar.contact');
    Route::post('footer-contact/{id}',[ContactInformationController::class,'footerContact'])->name('footer.contact');
    Route::post('social-link/{id}',[ContactInformationController::class,'socialLink'])->name('social.link');
    Route::get('contact-message',[ContactUsController::class,'message'])->name('contact.message');
    Route::get('delete-contact-message/{id}',[ContactUsController::class,'destroyMessage'])->name('delete-contact-message');

    // home section
    Route::resource('home-section', HomeSectionController::class);
    Route::post('banner-in-homepage/{id}', [HomeSectionController::class,'updateBannerSection'])->name('banner-in-homepage');
    Route::post('feature-in-homepage/{id}', [HomeSectionController::class,'updateFeatureSection'])->name('feature-in-homepage');
    Route::post('overview-in-homepage/{id}', [HomeSectionController::class,'updateOverviewSection'])->name('overview-in-homepage');
    Route::post('banner-award-in-homepage/{id}', [HomeSectionController::class,'updateBannerCategorySection'])->name('banner-award-in-homepage');


    Route::get('home-section-status/{id}',[HomeSectionController::class,'changeStatus'])->name('home.section.status');

    Route::resource('banner', SliderController::class);
    Route::resource('feature', FeatureController::class);
    Route::post('feature-image', [FeatureController::class,'featureImage'])->name('feature-image');

    Route::get('feature-status/{id}',[FeatureController::class,'changeStatus'])->name('feature.status');



    // manage testimonial and status
    Route::resource('testimonial', TestimonialController::class);
    Route::get('testimonial-status/{id}',[TestimonialController::class,'changeStatus'])->name('testimonial.status');

    // manage partner
    Route::resource('partner', PartnerController::class);
    Route::get('partner-status/{id}', [PartnerController::class,'changeStatus'])->name('partner.status');



    Route::get('property-review',[ListingReviewController::class,'index'])->name('listing-review');
    Route::get('review-delete/{id}',[ListingReviewController::class,'destroy'])->name('review.delete');
    Route::get('review-status/{id}',[ListingReviewController::class,'changeStatus'])->name('review-status');




    // manage seo
    Route::get('home-page-seo/{id}',[SeoTextController::class,'index'])->name('home-seo-setup');
    Route::get('property-seo-setup/{id}',[SeoTextController::class,'index'])->name('property-seo-setup');
    Route::get('about-us-seo-setup/{id}',[SeoTextController::class,'index'])->name('about-us-seo-setup');
    Route::get('pricing-seo-setup/{id}',[SeoTextController::class,'index'])->name('pricing-seo-setup');
    Route::get('our-agent-seo-setup/{id}',[SeoTextController::class,'index'])->name('our-agent-seo-setup');
    Route::get('blog-seo-setup/{id}',[SeoTextController::class,'index'])->name('blog-seo-setup');
    Route::get('contact-us-seo-setup/{id}',[SeoTextController::class,'index'])->name('contact-us-seo-setup');
    Route::get('faq-seo-setup/{id}',[SeoTextController::class,'index'])->name('faq-seo-setup');
    Route::post('update-seo/{id}',[SeoTextController::class,'update'])->name('update-seo');



    // manage mene section
    Route::get('menu-section',[MenuController::class,'index'])->name('menu-section');
    Route::post('menu-update',[MenuController::class,'update'])->name('menu-update');
    Route::get('menu-status/{id}',[MenuController::class,'changeStatus'])->name('menu-status');


     // manage banner image
    Route::get('banner-image',[BannerImageController::class,'bannerImage'])->name('banner.image');
    Route::post('update-image/{id}',[BannerImageController::class,'BannerUpdate'])->name('update-image');
    Route::get('login-image',[BannerImageController::class,'LoginImage'])->name('login.image');
    Route::post('update-login-image/{id}',[BannerImageController::class,'updateLogin'])->name('update-login-image');
    Route::get('profile-image',[BannerImageController::class,'profileImageIndex'])->name('profile.image');
    Route::post('update-profile-image/{id}',[BannerImageController::class,'updateProfileImage'])->name('update-profile-image');
    Route::get('bg-image',[BannerImageController::class,'bgIndex'])->name('bg.image');
    Route::post('update-bg-image/{id}',[BannerImageController::class,'updateBg'])->name('update-bg-image');

    Route::get('staff',[StaffController::class,'index'])->name('staff');
    Route::get('create-staff/',[StaffController::class,'create'])->name('create-staff');
    Route::post('store-staff/',[StaffController::class,'store'])->name('store-staff');
    Route::get('delete-staff/{id}',[StaffController::class,'destroy'])->name('delete-staff');
    Route::get('staff-status/{id}',[StaffController::class,'changeStatus'])->name('staff.status');


    // custome page
    Route::resource('custom-page',CustomPageController::class);
    Route::get('custom-page-status/{id}', [CustomPageController::class,'changeStatus'])->name('custom.page.status');

    Route::get('paginator',[PaginatorController::class,'index'])->name('paginator');
    Route::post('paginator-update',[PaginatorController::class,'update'])->name('paginator.update');


    Route::get('email-configuration',[EmailConfigurationController::class,'index'])->name('email-configuration');
    Route::post('update-email-configuraion',[EmailConfigurationController::class,'update'])->name('update-email-configuraion');



    // country , state, city route
    Route::resource('country',CountryController::class);
    Route::get('country-status/{id}',[CountryController::class,'changeStatus'])->name('country.status');
    Route::resource('country-state',CountryStateController::class);
    Route::get('country-state-status/{id}',[CountryStateController::class,'changeStatus'])->name('city.status');
    Route::resource('city',CityController::class);
    Route::get('city-status/{id}',[CityController::class,'changeStatus'])->name('city.status');

    // Real estate property purpose, aminities,type
    Route::resource('property-purpose',PropertyPurposeController::class);
    Route::get('property-purpose-status/{id}',[PropertyPurposeController::class,'changeStatus'])->name('property-purpose.status');
    Route::resource('property-type',PropertyTypeController::class);
    Route::get('property-type-status/{id}', [PropertyTypeController::class,'changeStatus'])->name('property.type.status');
    Route::resource('nearest-location',NearestLocationController::class);
    Route::get('nearest-location-status/{id}', [NearestLocationController::class,'changeStatus'])->name('nearest-location.status');

    Route::resource('package',PackageController::class);
    Route::get('package-status/{id}',[PackageController::class,'changeStatus'])->name('package.status');

    Route::resource('aminity', AminityController::class);
    Route::get('aminity-status/{id}',[AminityController::class,'changeStatus'])->name('aminity.status');
    Route::resource('property',AdminPropertyController::class);
    Route::get('agent-property',[AdminPropertyController::class,'agentProperty'])->name('agent-property');

    Route::get('property-status/{id}', [AdminPropertyController::class,'changeStatus'])->name('property.status');
    Route::get('property-slider-img/{id}',[AdminPropertyController::class,'propertySliderImage'])->name('property-slider-img');
    Route::get('property-delete-pdf/{id}',[AdminPropertyController::class,'deletePdfFile'])->name('property-delete-pdf');
    Route::get('exist-nearest-location/{id}',[AdminPropertyController::class,'existNearestLocation'])->name('exist-nearest-location');

    Route::resource('faq',FaqController::class);
    Route::get('faq-status/{id}', [FaqController::class,'changeStatus'])->name('faq.status');
    Route::post('faq-image', [FaqController::class,'faqImage'])->name('faq-image');
    Route::resource('service',ServiceController::class);
    Route::get('service-status/{id}', [ServiceController::class,'changeStatus'])->name('service.status');
    Route::resource('award',AwardController::class);
    Route::get('award-status/{id}', [AwardController::class,'changeStatus'])->name('award.status');



    Route::get('agents',[UserController::class,'index'])->name('agents');
    Route::get('agents-show/{id}',[UserController::class,'show'])->name('agents.show');
    Route::get('agents-status/{id}',[UserController::class,'changeStatus'])->name('agents.status');
    Route::get('agents-delete/{id}',[UserController::class,'destroy'])->name('agents.delete');

    Route::get('order',[AdminOrderController::class,'index'])->name('order');
    Route::get('pending-order',[AdminOrderController::class,'pendingOrder'])->name('pending-order');
    Route::get('pending-payment/{id}',[AdminOrderController::class,'pendingPayment'])->name('pending-payment');
    Route::get('payment-accept/{id}',[AdminOrderController::class,'paymentAccept'])->name('payment-accept');
    Route::get('order-show/{id}',[AdminOrderController::class,'show'])->name('order-show');
    Route::get('order-delete/{id}',[AdminOrderController::class,'destroy'])->name('order-delete');



});




//user profile section
Route::group(['as'=> 'staff.', 'prefix' => 'staff'],function (){
    // login route
    Route::get('/',[StaffLoginController::class,'staffLoginForm'])->name('login');
    Route::get('login',[StaffLoginController::class,'staffLoginForm'])->name('login');
    Route::post('login',[StaffLoginController::class,'storeLoginInfo'])->name('login');
    Route::post('register',[StaffLoginController::class,'register'])->name('register');
    Route::get('/logout',[StaffLoginController::class,'staffLogout'])->name('logout');
    Route::get('forget-password',[StaffForgotPasswordController::class,'forgetPassword'])->name('forget.password');
    Route::post('send-forget-password',[StaffForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
    Route::get('reset-password/{token}',[StaffForgotPasswordController::class,'resetPassword'])->name('reset.password');
    Route::post('store-reset-password/{token}',[StaffForgotPasswordController::class,'storeResetData'])->name('store.reset.password');

    // manage admin profile
    Route::get('profile',[StaffProfileController::class,'profile'])->name('profile');
    Route::post('update-profile',[StaffProfileController::class,'updateProfile'])->name('update.profile');


    Route::get('dashboard',[StaffDashboardController::class,'dashboard'])->name('dashboard');

    Route::resource('property',StaffPropertyController::class);
    Route::get('property-status/{id}', [StaffPropertyController::class,'changeStatus'])->name('property.status');
    Route::get('property-slider-img/{id}',[StaffPropertyController::class,'propertySliderImage'])->name('property-slider-img');
    Route::get('property-delete-pdf/{id}',[StaffPropertyController::class,'deletePdfFile'])->name('property-delete-pdf');
    Route::get('exist-nearest-location/{id}',[StaffPropertyController::class,'existNearestLocation'])->name('exist-nearest-location');



});
