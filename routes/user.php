<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\FE\ShopController;
use App\Http\Controllers\FE\CartController;
use App\Http\Controllers\FE\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FE\ProfileController;

Route::middleware(['auth:User'])->prefix('User')->name('User.')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home.index'); 
    });

    Route::get('/products', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/get-products', [ShopController::class, 'getProducts'])->name('shop.get-products');
    Route::get('/product/detail/{slug}', [ShopController::class, 'detailProducts'])->name('shop.detail');
    Route::post('/product/add-to-wishlist', [ShopController::class, 'addToWishlist'])->name('shop.add-to-wishlist');
    Route::post('/product/add-review', [ShopController::class, 'addReviewProduct'])->name('shop.add-review');
    Route::get('/product/show-review', [ShopController::class, 'showReviewProduct'])->name('shop.show-review');
    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCartItem'])->name('cart.update-cart-item');
    Route::get('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
    Route::post('/cart/{item}/remove', [CartController::class, 'removeCartItem'])->name('cart.remove');

    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');

    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/delete-alamat/{id}', [ProfileController::class, 'deleteAlamat'])->name('profile.deleteAlamat');
    Route::post('/profile/{id}/selesai', [ProfileController::class, 'markAsSelesai'])->name('checkout.selesai');


});
