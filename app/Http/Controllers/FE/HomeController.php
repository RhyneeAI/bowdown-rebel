<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Models\Promotion;
use App\Services\ProductService;

class HomeController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected ProductService $productService,
    ) {}

    public function index() 
    {
        $categories = $this->categoryService->getAll();
        $promotions = Promotion::select('foto', 'kode_promosi', 'diskon_harga')->get();
        return view('web.home')->with([
            'categories' => $categories,
            'promotions' => $promotions
        ]);
    }

    public function getHotProducts() {
        $hot_products = $this->productService->getHotProducts();
        
        $formatted_products = $hot_products->map(function($product) {
            return [
                'id' => $product->id,
                'nama_produk' => $product->nama_produk,
                'slug' => $product->slug,
                'harga_min' => $product->harga_min,
                'harga_max' => $product->harga_max,
                'image_url' => $product->photo ? GetFile('products', $product->photo->nama_hash) : null
            ];
        });
        
        return response()->json($formatted_products);
    }
}
