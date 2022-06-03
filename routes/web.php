<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TransactionDetailController;
use App\Http\Controllers\Admin\CustomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthCheckController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardStoreSettingController;
use App\Http\Controllers\DashboardTransactionController;

use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderCustomController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/detail/{id}', [DetailController::class, 'create'])->name('add-to-cart');

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/{id}', [CategoryController::class, 'detail'])->name('category-detail');

Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');
Route::get('/success', [CartController::class, 'success'])->name('success');

Route::get('/auth/google', [AuthCheckController::class, 'google'])->name('auth-google');
Route::get('/auth/google/signup', [AuthCheckController::class, 'googleRegister'])->name('auth-google-signup');
Route::get('/auth/google/callback', [AuthCheckController::class, 'handleProviderCallback'])->name('auth-google-login');

Route::get('/forgot-password', [AuthCheckController::class, 'indexForgot'])->name('forgot-password');






Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-home');
    Route::get('/dashboard-product', [DashboardProductController::class, 'index'])->name('dashboard-product');
    Route::get('/dashboard-product-create', [DashboardProductController::class, 'create'])->name('dashboard-product-create');
    Route::post('/dashboard-product-store', [DashboardProductController::class, 'store'])->name('dashboard-product-store');
    Route::get('/dashboard-product-detail/{id}', [DashboardProductController::class, 'show'])->name('dashboard-product-detail');
    Route::post('/dashboard-product-detail/{id}', [DashboardProductController::class, 'update'])->name('dashboard-product-update');
    Route::post('/dashboard-product-detail/gallery/upload', [DashboardProductController::class, 'uploadGallery'])->name('dashboard-product-gallery-upload');
    Route::get('/dashboard-product-detail/gallery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])->name('dashboard-product-gallery-delete');


    Route::get('/dashboard-transaction', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::get('/dashboard-transaction-detail/{id}', [DashboardTransactionController::class, 'show'])->name('dashboard-transaction-detail');
    Route::post('/dashboard-transaction-detail/{id}', [DashboardTransactionController::class, 'update'])->name('dashboard-transaction-update');


    Route::get('/dashboard-account-setting', [DashboardSettingController::class, 'account'])->name('dashboard-account-setting');
    Route::get('/dashboard-store-setting', [DashboardSettingController::class, 'store'])->name('dashboard-store-setting');
    Route::post('/dashboard-redirect-setting/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-redirect-setting');

    Route::get('/order-custom', [OrderCustomController::class, 'index'])->name('order-custom');
    Route::post('/order-custom-store', [OrderCustomController::class, 'store'])->name('order-custom-store');
    Route::get('/dashboard-custom-detail/{id}', [OrderCustomController::class, 'show'])->name('order-custom-detail');
    Route::get('/dashboard-custom-confirm/{id}', [OrderCustomController::class, 'confirm'])->name('order-custom-confirm');
    Route::post('/dashboard-custom-confirm-upload/{id}', [OrderCustomController::class, 'confirmUpload'])->name('order-custom-confirm-upload');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::resource('category', AdminCategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('product-galleries', ProductGalleryController::class);
    Route::resource('banner-homepage', BannerController::class);
    Route::resource('custom', CustomController::class);
    Route::post('/transaction-detail-update/{id}', [TransactionDetailController::class, 'update'])->name('transaction-detail-update');
});
