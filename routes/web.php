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

