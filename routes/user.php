<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\FE\ShopController;
use App\Http\Controllers\FE\CartController;
use App\Http\Controllers\AuthController;

Route::middleware(['auth:User'])->prefix('User')->name('User.')->group(function () {
    Route::post('/product/add-to-wishlist', [ShopController::class, 'addToWishlist'])->name('shop.add-to-wishlist');
    Route::post('/product/add-review', [ShopController::class, 'addReviewProduct'])->name('shop.add-review');
    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCartItem'])->name('cart.update-cart-item');
    Route::get('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
    Route::post('/cart/{item}/remove', [CartController::class, 'removeCartItem'])->name('cart.remove');
});