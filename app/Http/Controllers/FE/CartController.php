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
use App\Services\ExpeditionService;

class CartController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected ProductService $productService,
        protected CartService $cartService,
        protected ExpeditionService $expeditionService
    ) {}

    public function index()
    {
        if (!Auth::guard('User')->check()) {
            return redirect()->route('auth.login')->with(['error' => 'Silakan login terlebih dahulu.'], 401);
        }
        $userId = Auth::user()->id;
        $cart = $this->cartService->getOne($userId)->load('user', 'cartItems.product', 'cartItems.variantProduct');
        $expeditions = $this->expeditionService->getAll();
        return view('web.cart', compact('cart', 'expeditions'));
    }

    public function addToCart(Request $request)
    {
        try {
            if (!Auth::guard('User')->check()) {
                return response()->json(['error' => 'Silakan login terlebih dahulu.'], 401);
            }

            $result = $this->cartService->create($request);

            if (!$result) {
                return response()->json(['error' => 'Gagal menambahkan ke keranjang'], 201);
            }

            return response()->json(['success' => 'Berhasil dimasukkan ke dalam keranjang'], 200);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateCartItem(Request $request)
    {
        try {
            if (!Auth::guard('User')->check()) {
                return response()->json(['error' => 'Silakan login terlebih dahulu.'], 401);
            }

            $result = $this->cartService->update($request); 

            if (!$result) {
                return response()->json(['error' => 'Gagal menambahkan ke keranjang'], 201);
            }

            return response()->json(['status' => 'success', 'message' => 'Keranjang berhasil diperbarui'], 200);
        } catch (Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function applyCoupon(Request $request)
    {
        try {
            if (!Auth::guard('User')->check()) {
                return response()->json(['status' => 'error', 'message' => 'Silakan login terlebih dahulu.'], 401);
            }

            $result = $this->cartService->applyCoupon($request);

            if (!$result) {
                return response()->json(['status' => 'error', 'message' => 'Kupon tidak tersedia atau sudah digunakan'], 201);
            }

            return response()->json(['status' => 'success', 'message' => 'Kupon tersedia', 'data' => ['diskon_harga' => $result->diskon_harga, 'id' => $result->id]], 200);
        } catch (Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function removeCartItem($itemId)
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
