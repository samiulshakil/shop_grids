<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\LoginController as AdminLoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MenuBuilderController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PasswordController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\ZilaController;
use App\Http\Controllers\Backend\UpazilaController;
use App\Http\Controllers\Backend\UnionController;
use App\Http\Controllers\Backend\WardController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ContactUsController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\StripeController;
use App\Http\Controllers\Frontend\NormalUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Frontend Routes Start
Route::get('/', [WebsiteController::class, 'index'])->name('website.home');
Route::get('/product/{slug}', [WebsiteController::class, 'productDetails'])->name('website.product.details');
Route::get('/shop', [WebsiteController::class, 'shop'])->name('website.shop');
Route::get('/blog/details/{id}', [WebsiteController::class, 'blogDetails'])->name('blog.details');

//shop page search
Route::post('/shop/search', [WebsiteController::class, 'shopSearch'])->name('website.shop.search');
Route::get('/product/category/{id}', [WebsiteController::class, 'categoryProduct'])->name('website.product.category');
Route::get('/product/subcategory/{id}', [WebsiteController::class, 'subCategoryProduct'])->name('website.product.subcategory');
Route::get('/product/brand/{id}', [WebsiteController::class, 'brandProduct'])->name('website.product.brand');

//price range product show
Route::post('/price/range', [WebsiteController::class, 'priceRange'])->name('website.price.range');
Route::post('/product/sorting', [WebsiteController::class, 'productSorting'])->name('website.product.sorting');
//track order
Route::post('/track/order', [WebsiteController::class, 'trackOrders'])->name('track.orders');

//profile route 
Route::get('user/profile', [NormalUserController::class, 'editProfile'])->name('user.profile.edit');
Route::put('user/profile', [NormalUserController::class, 'updateProfile'])->name('user.profile.update');

//user dashboard
Route::get('user/dashboard', [NormalUserController::class, 'dashboard'])->name('user.dashboard');

//profile change Password 
Route::get('user/password/edit', [NormalUserController::class, 'editPassword'])->name('user.password.edit');
Route::put('user/password/update', [NormalUserController::class, 'updatePassword'])->name('user.password.update');

//Contact us or message
Route::get('contact/us', [ContactUsController::class, 'contactUs'])->name('contact.us');
Route::post('/message/store', [ContactUsController::class, 'messageStore'])->name('message.store');

//carts
Route::post('/add/cart', [CartController::class, 'AddCart'])->name('cart.add');
Route::get('/show/cart', [CartController::class, 'index'])->name('cart.show');
Route::post('/update/cart', [CartController::class, 'update'])->name('cart.update');
Route::post('/delete/cart', [CartController::class, 'destroy'])->name('cart.delete');
Route::post('/product/info', [CartController::class, 'ProductInfo'])->name('product.info');

//payment
Route::post('/payment/process', [PaymentController::class, 'paymentProcess'])->name('payment.process');

//checkout
Route::post('upazila/list', [CheckoutController::class, 'upazilaList'])->name('upazila.list');
Route::get('/user/checkout', [CheckoutController::class, 'checkout'])->name('user.checkout');

//stripe payment
route::post('stripe/order/complete',[StripeController::class,'store'])->name('stripe.order');

//orders
Route::get('/orders/show', [NormalUserController::class, 'userOrder'])->name('user.order.show');

//Return orders
Route::get('/orders/return', [NormalUserController::class, 'returnOrder'])->name('user.return.order');
Route::post('/orders/return/request/{id}', [NormalUserController::class, 'returnOrderRequest'])->name('order.return.request');

//coupon
route::post('/coupon/apply',[CartController::class,'couponApply'])->name('coupon.apply');
route::get('/coupon/calculation',[CartController::class,'couponCalcaultion'])->name('coupon.calculation');
route::get('/coupon/remove',[CartController::class,'removeCoupon'])->name('removeCoupon');

//wishlists
Route::post('/add/wish', [WishlistController::class, 'addToWishlist'])->name('wish.add');
Route::get('/show/wish', [WishlistController::class, 'index'])->name('wish.show');
Route::delete('/destory/wish/{id}', [WishlistController::class, 'destroy'])->name('wish.destory');


//email verified route start
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/admin/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//laravel socialite route
Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider'])->name('login.provider');
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('login.callback');


// Backend Routes Start

    Route::get('admin/login', [AdminLoginController::class, 'custom_login_page'])->name('admin.login');
    Route::post('admin/store-login', [AdminLoginController::class, 'store_login'])->name('admin.store-login');
    Route::post('admin/logout', [AdminLoginController::class, 'admin_logout'])->name('admin.logout');


Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::get('/dashboard', DashboardController::class)->name('dashboard');

                //roles and users
                Route::resource('roles', RoleController::class);
                Route::resource('users', UserController::class);

                //profile route 
                Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

                //profile change Password 
                Route::get('password/edit', [PasswordController::class, 'editPassword'])->name('password.edit');
                Route::put('password/update', [PasswordController::class, 'updatePassword'])->name('password.update');
                
                //backups route
                Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
                
                //Pages route
                Route::resource('pages', PageController::class);

                //Menus route
                Route::resource('menus', MenuController::class)->except(['show']);
                                
        });
    });
});

//Menu Route Group
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('admin/menus/{id}')->group(function () {
            Route::name('admin.menus.')->group(function () {
                 Route::get('builder', [MenuBuilderController::class, 'index'])->name('builder');
                 Route::post('order', [MenuBuilderController::class, 'order'])->name('order');

                //Menu Items Group
                Route::prefix('item')->group(function (){
                    Route::name('item.')->group(function (){
                        //Menus Items route
                        Route::get('create', [MenuBuilderController::class, 'itemCreate'])->name('create');
                        Route::post('store', [MenuBuilderController::class, 'itemStore'])->name('store');
                        Route::get('{itemId}/edit', [MenuBuilderController::class, 'itemEdit'])->name('edit');
                        Route::post('{itemId}/update', [MenuBuilderController::class, 'itemUpdate'])->name('update');
                        Route::delete('{itemId}/delete', [MenuBuilderController::class, 'itemDestroy'])->name('destroy');
                    });
                });
                                
        });
    });
});

//Route for Settings
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('admin/settings')->group(function () {
            Route::name('admin.settings.')->group(function () {
                 Route::get('general', [SettingController::class, 'general'])->name('general');
                 Route::put('general', [SettingController::class, 'generalUpdate'])->name('general.update');

                 Route::get('appearance', [SettingController::class, 'appearance'])->name('appearance');
                 Route::put('appearance', [SettingController::class, 'appearanceUpdate'])->name('appearance.update');

                 Route::get('mail', [SettingController::class, 'mail'])->name('mail');
                 Route::put('mail', [SettingController::class, 'mailUpdate'])->name('mail.update');

                 //website setting start
                 Route::get('website', [SettingController::class, 'website'])->name('website');
                 Route::put('website', [SettingController::class, 'websiteUpdate'])->name('website.update');

                //website social media
                Route::get('socialmedias', [SocialMediaController::class, 'index'])->name('socialmedias.index');
                Route::get('socialmedias/create', [SocialMediaController::class, 'create'])->name('socialmedias.create');
                Route::post('socialmedias/store', [SocialMediaController::class, 'store'])->name('socialmedias.store');
                Route::get('socialmedias/edit/{id}', [SocialMediaController::class, 'edit'])->name('socialmedias.edit');
                Route::post('socialmedias/update/{id}', [SocialMediaController::class, 'update'])->name('socialmedias.update');
                Route::get('socialmedias/active/{id}', [SocialMediaController::class, 'active'])->name('socialmedias.active');
                Route::get('socialmedias/inactive/{id}', [SocialMediaController::class, 'inactive'])->name('socialmedias.inactive');   
                
                //website Banner or hero are all routes
                Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
                Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
                Route::post('banners/store', [BannerController::class, 'store'])->name('banners.store');
                Route::get('banners/edit/{id}', [BannerController::class, 'edit'])->name('banners.edit');
                Route::post('banners/update/{id}', [BannerController::class, 'update'])->name('banners.update');
                Route::get('banners/active/{id}', [BannerController::class, 'active'])->name('banners.active');
                Route::get('banners/inactive/{id}', [BannerController::class, 'inactive'])->name('banners.inactive');   

                 //others website setting start
                 Route::get('otherbanner', [SettingController::class, 'otherBanner'])->name('otherbanner');
                 Route::put('otherbanner', [SettingController::class, 'otherBannerUpdate'])->name('otherbanner.update');

        });
    });
});


//Backend Route Group
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::get('/dashboard', DashboardController::class)->name('dashboard');

                //Backend route start
                Route::resource('brands', BrandController::class);
                Route::resource('categories', CategoryController::class);
                Route::resource('subcategories', SubCategoryController::class);
                Route::resource('blogs', BlogController::class);
                Route::resource('divisions', DivisionController::class);
                Route::resource('zilas', ZilaController::class);
                Route::resource('upazilas', UpazilaController::class);
                Route::resource('unions', UnionController::class);
                Route::resource('wards', WardController::class);

                Route::post('zila/list', [ZilaController::class, 'zilaList'])->name('zila.list');
                Route::post('upazila/list', [UpazilaController::class, 'upazilaList'])->name('upazila.list');
                Route::post('union/list', [UnionController::class, 'unionList'])->name('union.list');



                //message route
                Route::get('/messages', [ContactUsController::class, 'showMessage'])->name('message.show');
                Route::delete('messages/destroy/{id}', [ContactUsController::class, 'destroy'])->name('message.destroy');

                //Products Route
                Route::get('products', [ProductController::class, 'index'])->name('products.index');
                Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
                Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
                Route::get('products/show/{slug}', [ProductController::class, 'show'])->name('products.show');
                Route::get('products/{slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
                Route::post('products/update', [ProductController::class, 'update'])->name('products.update');
                Route::delete('products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
                Route::post('products/subcategory/list', [ProductController::class, 'subCategoryList'])->name('subcategory.list');
                Route::get('products/active/{slug}', [ProductController::class, 'active'])->name('products.active');
                Route::get('products/inactive/{slug}', [ProductController::class, 'inactive'])->name('products.inactive');

                //Coupons Route
                Route::get('coupons', [CouponController::class, 'index'])->name('coupons.index');
                Route::get('coupons/create', [CouponController::class, 'create'])->name('coupons.create');
                Route::post('coupons/store', [CouponController::class, 'store'])->name('coupons.store');
                Route::get('coupons/show/{slug}', [CouponController::class, 'show'])->name('coupons.show');
                Route::get('coupons/{slug}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
                Route::post('coupons/update', [CouponController::class, 'update'])->name('coupons.update');
                Route::delete('coupons/destroy/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');

                //orders
                Route::get('/orders', [OrderController::class, 'order'])->name('all.orders');
                Route::get('/orders/payment/accept', [OrderController::class, 'payment'])->name('payment.orders');
                Route::get('/orders/progress', [OrderController::class, 'progress'])->name('progress.orders');
                Route::get('/orders/delivered', [OrderController::class, 'delivered'])->name('delivered.orders');
                Route::get('/orders/cancel', [OrderController::class, 'cancel'])->name('cancel.orders');

                //return order
                Route::get('/orders/return', [ReturnController::class, 'returnOrder'])->name('return.orders');
                Route::get('/orders/return/approved', [ReturnController::class, 'approvedOrder'])->name('return.orders.approved');
                Route::get('/orders/return/{id}', [ReturnController::class, 'returnOrderApprove'])->name('return.orders.approve');

                //Reports 
                Route::get('/reports', [ReportController::class, 'report'])->name('reports');
                Route::get('/reports/today/delivered', [ReportController::class, 'todayDelivered'])->name('today.delivered');
                Route::get('/reports/this/month', [ReportController::class, 'thisMonth'])->name('this.month');
                Route::get('/search/reports', [ReportController::class, 'searchReport'])->name('search.reports');
                Route::post('/search/date/reports', [ReportController::class, 'reportByDate'])->name('search.date.reports');
                Route::post('/search/month/reports', [ReportController::class, 'reportByMonth'])->name('search.month.reports');
                Route::post('/search/year/reports', [ReportController::class, 'reportByYear'])->name('search.year.reports');

                //update order status
                Route::get('/pending/order/{id}', [OrderController::class, 'pendingOrder'])->name('pendingorders');
                Route::get('/payment/order/{id}', [OrderController::class, 'paymentOrder'])->name('paymentorders');
                Route::get('/progress/order/{id}', [OrderController::class, 'progressOrder'])->name('progressorders');
                Route::get('/delivered/order/{id}', [OrderController::class, 'deliveredOrder'])->name('deliveredorders');
                Route::get('/cancel/order/{id}', [OrderController::class, 'cancelOrder'])->name('cancelorders');

                Route::get('/view/order/{id}', [OrderController::class, 'viewOrder'])->name('view.orders');
                                
        });
    });
});

// Pages route e.g. [about,contact,etc]
Route::get('/{slug}', [PagesController::class, 'index'])->name('page');
