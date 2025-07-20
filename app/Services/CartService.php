<?php 
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService
{
    public function addToCart(string $slug, ?int $variantIndex, int $qty)
    {
        try {
            $user = Auth::guard('User')->user();

            $product = Product::with('variants')->where('slug', $slug)->firstOrFail();

            $variantId = null;
            if ($variantIndex !== null && isset($product->variants[$variantIndex])) {
                $variantId = $product->variants[$variantIndex]->id;
            }

            // Cek cart milik user
            $cart = Cart::firstOrCreate(['id_user' => $user->id]);
            Log::info($qty);

            // Tambahkan item ke keranjang (update jika sudah ada)
            $cartItem = CartItems::where('id_keranjang', $cart->id)
                ->where('id_produk', $product->id)
                ->where('id_varian_produk', $variantId)
                ->first();

            if ($cartItem) {
                $cartItem->qty += $qty;
                $cartItem->save();
            } else {
                // Jika item belum ada, buat item baru
                CartItems::create([
                    'id_keranjang' => $cart->id,
                    'id_produk' => $product->id,
                    'id_varian_produk' => $variantId,
                    'qty' => $qty
                ]);
            }

            return true;
        } catch (\Exception $e) {
            // Untuk debug jika perlu
            logger()->error('AddToCart Error: ' . $e->getMessage());
            return false;
        }
    }
    public function removeItemFromCart($userId, $itemId)
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
