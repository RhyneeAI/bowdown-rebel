<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FE\PageController;
use App\Http\Controllers\BE\DashboardController;
use App\Http\Controllers\BE\CategoryController;
use App\Http\Controllers\BE\ExpeditionController;
use App\Http\Controllers\BE\ProductController;
use App\Http\Controllers\BE\PromotionController;
use App\Http\Controllers\BE\UserController;
use App\Http\Controllers\FE\ShopController;
use App\Http\Controllers\FE\TransactionController;

Route::middleware(['auth:User'])->prefix('User')->name('User.')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('User.cart'); 
    });

    Route::get('/products', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/get-products', [ShopController::class, 'getProducts'])->name('shop.get-products');
    Route::get('/product/detail/{slug}', [ShopController::class, 'detailProducts'])->name('shop.detail');
    Route::post('/product/add-to-wishlist', [ShopController::class, 'addToWishlist'])->name('shop.add-to-wishlist');
    Route::post('/product/add-review', [ShopController::class, 'addReviewProduct'])->name('shop.add-review');
    Route::get('/product/show-review', [ShopController::class, 'showReviewProduct'])->name('shop.show-review');

    Route::get('/cart', [PageController::class, 'cart'])->name('cart');

    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');
});

