<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FE\PageController;
use App\Http\Controllers\BE\DashboardController;
use App\Http\Controllers\BE\CategoryController;
use App\Http\Controllers\BE\ProductController;
use App\Http\Controllers\BE\PromotionController;
use App\Http\Controllers\BE\UserController;

Route::middleware(['auth:Admin'])->prefix('Admin')->name('Admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Kategori
    Route::get('category/datatable', [CategoryController::class, 'datatable'])->name('category.datatable');
    Route::resource('category', CategoryController::class);

    // Produk
    Route::get('product/list', [ProductController::class, 'list'])->name('product.list');
    Route::resource('product', ProductController::class);

    // Promosi
    Route::get('promotion-detail', [PromotionController::class, 'promotionDetail'])->name('promotion.detail');
    Route::resource('promotion', PromotionController::class);

    // User
    Route::resource('user', UserController::class);
});

