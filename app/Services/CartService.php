<?php 
namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\ProductUsed;
use App\Models\CartItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CartService
{
    public function create(Request $request)
    {
        try {
            $user = Auth::guard('User')->user();

            $request->validate([
                'slug' => 'required|exists:produk,slug',
                'id_varian' => 'nullable|integer',
                'qty' => 'required|integer|min:1',
            ]);

            $product = Product::select('id')->where('slug', $request->slug)->firstOrFail();
            $cart = Cart::firstOrCreate(['id_user' => $user->id]);
            Log::info($request->qty);

            $cartItem = CartItems::where('id_keranjang', $cart->id)
                                ->where('id_produk', $product->id)
                                ->where('id_varian_produk', $request->id_varian)
                                ->first();

            if ($cartItem) {
                $cartItem->qty += $request->qty;
                $cartItem->save();
            } else {
                CartItems::create([
                    'id_keranjang' => $cart->id,
                    'id_produk' => $product->id,
                    'id_varian_produk' => $request->id_varian,
                    'qty' => $request->qty
                ]);
            }

            return true;
        } catch (\Throwable $e) {
            logger()->error('AddToCart Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getOne(String $userId)
    {
        $cart = Cart::where('id_user', $userId)->first();
        if (!$cart) {
            $cart = Cart::create(['id_user' => $userId]);
        }
        return $cart;
    }

    public function update(Request $request)
    {
        $updates = [];
        foreach ($request->all() as $itemId => $data) {
            CartItems::where('id', $data['id_keranjang_item'])->update(['qty' => $data['qty']]);
        }

        return true;
    }

    public function applyCoupon(Request $request)
    {
        $user = Auth::guard('User')->user();
        $promotion = Promotion::select(['id', 'diskon_harga', 'stok'])
                              ->where('kode_promosi', $request->coupon_code)
                              ->where('stok', '>=', 1)
                              ->whereDate('tanggal_mulai', '<=', now()->toDateString())
                              ->whereDate('tanggal_berakhir', '>=', now()->toDateString())
                              ->first();
        if (!$promotion) {
            return false; 
        }

        $usedPromotion = $promotion->promotionUsed()->where('id_user', $user->id)->exists();
        if ($usedPromotion) {
            return false;
        }

        return $promotion; 
    }

    public function remove($userId, $itemId)
    {
        $cart = Cart::where('id_user', $userId)->first();

        if (!$cart) {
            throw new \Exception('Keranjang tidak ditemukan.');
        }

        $deleted = CartItems::where('id', $itemId)
            ->where('id_keranjang', $cart->id)
            ->delete();

        if (!$deleted) {
            throw new \Exception('Item tidak ditemukan di keranjang.');
        }

        return true;
    }


}
