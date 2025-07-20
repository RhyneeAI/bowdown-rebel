<?php

namespace App\Services;

use App\Models\Review;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewService 
{
    public function __construct(
        protected ProductService $productService,
    ) {}

    public function create(Request $request)
    {
        $product = $this->productService->getOne($request->slug);
        Review::create([
            'id_user' => auth()->id(),
            'id_produk' => $product->id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        $result = $this->productService->updateRating($product->id);
        return $result;
    }

    public function getAll($slug) 
    {
        $reviews = Review::select('id', 'id_user', 'id_produk', 'komentar', 'rating', 'created_at')
                        ->whereHas('product', function($q) use ($slug) {
                            $q->where('slug', $slug); 
                        })
                        ->with(['product' => function($query) { 
                            $query->select('id', 'nama_produk', 'slug'); 
                        }])
                        ->with(['user' => function($query) {
                            $query->select('id', 'nama');
                        }])
                        ->orderBy('created_at', 'DESC') 
                        ->get();
        
        return $reviews;
    }
}