<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FE\PageController;
use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\FE\ShopController;

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
Route::get('/test', function () {
    return view('test');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/hot-products', [HomeController::class, 'getHotProducts'])->name('home.hot-products');

Route::get('/about', [PageController::class, 'about'])->name('about');

//auth
Route::middleware('guest:Admin,User')->group(function () {
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
include __DIR__ . '/user.php';
include __DIR__ . '/callback.php';

