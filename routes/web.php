<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FE\PageController;
use App\Http\Controllers\BE\DashboardController;
use App\Http\Controllers\BE\CategoryController;
use App\Http\Controllers\BE\ProductController;
use App\Http\Controllers\BE\PromotionController;
use App\Http\Controllers\BE\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/shop-detail', [PageController::class, 'detail'])->name('shop_detail');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//auth
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'index'])->name('auth.login');

// Dashboard
Route::prefix('dashboard')->group(function () {
    // Kategori
    Route::get('kategori/datatable', [CategoryController::class, 'datatable'])->name('kategori.datatable');
    Route::resource('kategori', CategoryController::class);

    // Produk
    Route::get('product/list', [ProductController::class, 'list'])->name('product.list');
    Route::resource('product', ProductController::class);

    // Promosi
    Route::get('promotion-detail', [PromotionController::class, 'promotionDetail'])->name('promotion.detail');
    Route::resource('promotion', PromotionController::class);

    // User
    Route::resource('user', UserController::class);
});

