<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CustomerOrderHistroyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\AdminOrdersController;
use App\Http\Controllers\AdminReviewsController;
use App\Http\Controllers\HomeCategoriesController;
use App\Http\Controllers\UserProfilePasswordController;
use App\Http\Controllers\AdminProfilePasswordController;

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

// root to app routes
Route::get('/', function () {
    return redirect('/login');
});

//routes admin dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('admin');

// routes login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// routes register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// routes buku
Route::resource('buku', BukuController::class)->middleware('admin');
// Categories routes from admin
Route::resource('categories', CategoryController::class)->middleware('admin');
Route::get('/admin/dashboard/categories/checkSlug', [CategoryController::class, 'checkSlug'])->middleware('admin');
// Author routes from admin
Route::resource('author', AuthorController::class)->middleware('admin');
Route::get('/admin/dashboard/author/checkSlug', [AuthorController::class, 'checkSlug'])->middleware('admin');
Route::get('/admin/dashboard/author/{author:slug}', [AuthorController::class, 'show'])->middleware('admin');
// Penerbit routes from admin
Route::resource('penerbit', PenerbitController::class)->middleware('admin');
Route::get('/admin/dashboard/penerbit/checkSlug', [PenerbitController::class, 'checkSlug'])->middleware('admin');
Route::get('/admin/dashboard/penerbit/{penerbit:slug}', [PenerbitController::class, 'show'])->middleware('admin');
//Customer routes from admin
Route::resource('customer', CustomerController::class)->middleware('admin');
//Comments routes from admin
Route::resource('admin-reviews', AdminReviewsController::class)->middleware('admin');
Route::resource('admin-orders', AdminOrdersController::class)->middleware('admin');

// profile & change password routes from admin
Route::group([
    'prefix' => 'change',
    'middleware' => 'admin'
], function () {
    // change admin profile & password
    Route::get('profile/{id}', [AdminProfilePasswordController::class, 'index'])->name('profile-admin');
    Route::put('profile/{id}', [AdminProfilePasswordController::class, 'update'])->name('profile-admin.update');
    Route::get('profile/password/{id}', [AdminProfilePasswordController::class, 'password'])->name('password-admin');
    Route::put('profile/password/{id}', [AdminProfilePasswordController::class, 'changePassword'])->name('password-admin.change');
});

// profile & change password routes from customer
Route::group([
    'prefix' => 'user-change',
    'middleware' => 'auth'
], function () {
    // change customer profile & password
    Route::get('profile/{id}', [UserProfilePasswordController::class, 'index'])->name('profile-user');
    Route::put('profile/{id}', [UserProfilePasswordController::class, 'update'])->name('profile-user.update');
    Route::get('profile/password/{id}', [UserProfilePasswordController::class, 'password'])->name('password-user');
    Route::put('profile/password/{id}', [UserProfilePasswordController::class, 'changePassword'])->name('password-user.change');
});

// routes home 
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/home/info/{id}', [HomeController::class, 'info'])->name('home.info')->middleware('auth');
Route::get('/home/rating/{id}', [HomeController::class, 'reviewRating'])->name('home.rating')->middleware('auth');

// Review Rating 
Route::post('/review', [HomeController::class, 'reviewRating'])->name('review')->middleware('auth');

// Best-Seller
Route::any('/best-seller', [BestSellerController::class, 'bestSellerBooks'])->name('best-seller.books')->middleware('auth');

// routes about
Route::get('/about', function() {
    return view('pages.about');
})->middleware('auth');

// routes categories in client
Route::get('/home-categories', [HomeCategoriesController::class, 'index'])->middleware('auth');

// routes Cart in client
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cart-store', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
Route::post('/cart-update/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::post('/cart-remove/{id}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');

// routes checkout in client
Route::get('/city/{id}', [CheckoutController::class, 'getCity'])->name('city')->middleware('auth');
Route::get('/destination={city_destination}&weight={weight}&courier={courier}', [CheckoutController::class, 'getOngkir'])->middleware('auth');
Route::any('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::get('/checkout/create', [CheckoutController::class, 'create'])->name('checkout.create')->middleware('auth');
Route::get('/checkout/pembayaran', [CheckoutController::class, 'pembayaran'])->name('checkout.pembayaran')->middleware('auth');
Route::post('/checkout/pembayaran', [CheckoutController::class, 'konfirmasiPembayaran'])->name('checkout.konfirmasi_pembayaran')->middleware('auth');

// History route in customer
Route::resource('customer_order_history', CustomerOrderHistroyController::class)->middleware('auth');

// Route generate PDF
Route::get('/history/{orders:id}', [CustomerOrderHistroyController::class, 'detailExport'])->name('history.detailExport')->middleware('auth');
Route::get('/export_data/pdf', [AdminOrdersController::class, 'createPDF'])->name('export.data.pdf')->middleware('admin');