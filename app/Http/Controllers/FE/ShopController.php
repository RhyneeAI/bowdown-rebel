<?php

namespace App\Http\Controllers\FE;

use App\Enums\StatusEnum;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ReviewService;
use App\Services\CartService;
use App\Models\Cart;
use App\Models\CartItems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\GuardTraits;
use Throwable;

class ShopController extends Controller
{
    use GuardTraits;
 
    public function __construct(
        protected CategoryService $categoryService,
        protected ProductService $productService,
        protected ReviewService $reviewService,
        protected CartService $cartService
    ) {}

    public function index() 
    {
        $categories = $this->categoryService->getAll();
        return view('web.shop')->with([
            'categories' => $categories
        ]);
    }

    public function getProducts(Request $request) 
    {
        $products = $this->productService->getShopProducts($request);

        $mapped = $products->getCollection()->map(function($product) {
            if ($product->variants->isEmpty()) {
                $harga_min = $harga_max = 0;
            } else {
                $prices = $product->variants->pluck('harga');
                $harga_min = $prices->min();
                $harga_max = $prices->max();
            }

            return [
                'id' => $product->id,
                'nama_produk' => $product->nama_produk,
                'slug' => $product->slug,
                'harga_min' => $harga_min,
                'harga_max' => $harga_max,
                'image_url' => $product->photo ? GetFile('products', $product->photo->nama_hash) : null
            ];
        });

        $products->setCollection($mapped);

        $start = ($products->currentPage() - 1) * $products->perPage() + 1;
        $end   = $start + $products->count() - 1;

        return response()->json([
            'start' => $start,
            'end' => $end,
            'total' => $products->total(),
            'data' => $products->items(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
        ]);
    }

    public function detailProducts(String $slug) 
    {
        $product = $this->productService->getOne($slug)->load(['photos', 'variants', 'category', 'reviews', 'likedProduct']);
        return view('web.shop_detail')->with([
            'product' => $product
        ]);
    }

    public function addToWishlist(Request $request) 
    {
        try {
            if (!auth()->check()) {
                return response()->json(['warning' => 'Silahkan login terlebih dahulu!'], 203);
            }

            $result = $this->productService->addToWishlist($request->slug);

            if (is_string($result)) {
                return response()->json(['warning' => $result], 200);
            }

            return response()->json(['success' => 'Berhasil dimasukkan ke dalam wishlist'], 200);

        } catch (Throwable $t) {
            return response()->json(['error' => $t->getMessage()], 500);
        }
    }

    public function addReviewProduct(Request $request) 
    {
        try {
            if (!auth()->check()) {
                return response()->json(['warning' => 'Silahkan login terlebih dahulu!'], 203);
            }

            $result = $this->reviewService->create($request);

            return response()->json(['success' => 'Ulasan anda berhasil ditambahkan!', 'data' => $result], 200);
        } catch (Throwable $t) {
            return response()->json(['error' => $t->getMessage()], 500);
        }
    }

    public function showReviewProduct(Request $request) 
    {
        $result = $this->reviewService->getAll($request->slug);

        return response()->json([
            'data' => $result,
            'status' => 'success'
        ]);
    }
}

