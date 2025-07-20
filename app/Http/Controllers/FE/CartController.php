<?php

namespace App\Http\Controllers\FE;

use App\Models\Cart;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected ProductService $productService,
        protected CartService $cartService
    ) {}

    public function index()
    {
        $userId = Auth::user()->id;
        $cart = $this->cartService->getOne($userId)->load('user', 'cartItems.product', 'cartItems.variantProduct');
            
        return view('web.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        try {
            if (!Auth::guard('User')->check()) {
                return response()->json(['error' => 'Silakan login terlebih dahulu.'], 401);
            }

            $result = $this->cartService->create($request);

            if (!$result) {
                return response()->json(['error' => 'Gagal menambahkan ke keranjang'], 500);
            }

            return response()->json(['success' => 'Berhasil dimasukkan ke dalam keranjang'], 200);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removeFromCart($itemId)
    {
        try {
            $user = Auth::guard('User')->user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $this->cartService->remove($user->id, $itemId);

            return response()->json(['success' => 'Item berhasil dihapus dari keranjang.']);
        } catch (\Exception $e) {
            \Log::error('RemoveFromCart Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal menghapus item.'], 500);
        }
    }
}
