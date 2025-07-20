<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FE\PageController;
use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\FE\ShopController;
use App\Http\Controllers\AuthController;


Route::middleware(['auth:User'])->prefix('User')->name('User.')->group(function () {
    Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
    Route::post('/product/add-to-wishlist', [ShopController::class, 'addToWishlist'])->name('shop.add-to-wishlist');
    Route::post('/product/add-review', [ShopController::class, 'addReviewProduct'])->name('shop.add-review');
    Route::get('/cart', [PageController::class, 'cart'])->name('cart');
    Route::post('/cart/{item}/remove', [ShopController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/{item}/update', [ShopController::class, 'updateCartItem'])->name('cart.update');

});