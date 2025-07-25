<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FE\PageController;
use App\Http\Controllers\BE\DashboardController;
use App\Http\Controllers\BE\CategoryController;
use App\Http\Controllers\BE\ExpeditionController;
use App\Http\Controllers\BE\ProductController;
use App\Http\Controllers\BE\PromotionController;
use App\Http\Controllers\BE\TransactionController;
use App\Http\Controllers\BE\UserController;

Route::middleware(['auth:Admin'])->prefix('Admin')->name('Admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Kategori
    Route::get('category/datatable', [CategoryController::class, 'datatable'])->name('category.datatable');
    Route::resource('category', CategoryController::class);

    // Ekspedisi
    Route::get('expedition/datatable', [ExpeditionController::class, 'datatable'])->name('expedition.datatable');
    Route::resource('expedition', ExpeditionController::class);

    // Produk
    Route::get('product/list', [ProductController::class, 'list'])->name('product.list');
    Route::resource('product', ProductController::class);

    // Promosi
    Route::get('promotion/datatable', [PromotionController::class, 'datatable'])->name('promotion.datatable');
    Route::resource('promotion', PromotionController::class);

    // Transaction
    Route::get('transaction/datatable', [TransactionController::class, 'datatable'])->name('transaction.datatable');
    Route::get('transaction/export-pdf', [TransactionController::class, 'exportToPDF'])->name('transaction.export-to-pdf');
    Route::put('transaction-receipt-update/{id}', [TransactionController::class, 'receiptUpdate'])->name('transaction.receipt-update');
    Route::resource('transaction', TransactionController::class)->only(['index', 'show']);

    // User
    Route::get('user/datatable', [UserController::class, 'datatable'])->name('user.datatable');
    Route::resource('user', UserController::class);
});

