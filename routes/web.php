<?php

use App\Models\ReviewRating;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\AdminReviewsController;
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
Route::get('/home/rating/{id}', [HomeController::class, 'review'])->name('home.rating')->middleware('auth');

// Review Rating 
Route::post('/review-store', [HomeController::class, 'reviewStore'])->name('review.store')->middleware('auth');

// Best-Seller
Route::any('/best-seller', [BestSellerController::class, 'bestSellerBooks'])->name('best-seller.books')->middleware('auth');

// routes about
Route::get('/about', function() {
    return view('pages.about');
})->middleware('auth');



// buat pembelajaran
// Route::get('/review', [HomeController::class, 'readReview'])->name('review')->middleware('auth');
// Route::fallback(function() {
//     return "Page Not Foud";
// });
// Route::get('/review', function() {
//     $review = ReviewRating::all();
//     dd($review);
// });