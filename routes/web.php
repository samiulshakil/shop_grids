<?php

use App\Http\Controllers\Auth\LoginController;
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
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Frontend\WebsiteController;

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
Route::middleware(['auth', 'verified'])->group(function () {
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
Route::middleware(['auth'])->group(function () {
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
Route::middleware(['auth'])->group(function () {
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

        });
    });
});


//Backend Route Group
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::get('/dashboard', DashboardController::class)->name('dashboard');

                //Backend route
                Route::resource('brands', BrandController::class);
                Route::resource('categories', CategoryController::class);
                Route::resource('subcategories', SubCategoryController::class);

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
                                
        });
    });
});

// Pages route e.g. [about,contact,etc]
Route::get('/{slug}', [PagesController::class, 'index'])->name('page');
