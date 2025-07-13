<?php

namespace App\Http\Controllers\FE;

use App\Enums\StatusEnum;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected ProductService $productService,
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
        $product = $this->productService->getOne($slug)->load(['photos', 'variants', 'category']);
        return view('web.shop_detail')->with([
            'product' => $product
        ]);
    }
}
