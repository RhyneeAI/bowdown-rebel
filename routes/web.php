<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FE\AuthController;
use App\Http\Controllers\FE\CartController;
use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\FE\ShopController;
use App\Http\Controllers\FE\AboutController;
use App\Http\Controllers\BE\UserController;
// use App\Http\Controllers\FE\PageController;
use App\Http\Controllers\BE\ProductController;
use App\Http\Controllers\BE\CategoryController;
use App\Http\Controllers\BE\DashboardController;
use App\Http\Controllers\BE\PromotionController;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop-detail', [ShopController::class, 'detail'])->name('shop.detail');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

//auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');

    // Login
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'loginProcess'])->name('auth.login.process');
});

Route::middleware(['web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route Admin
include __DIR__ . '/admin.php';

