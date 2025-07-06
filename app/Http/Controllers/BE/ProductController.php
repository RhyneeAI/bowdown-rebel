<?php

namespace App\Http\Controllers\BE;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    private $service;
    public function __construct() 
    {
        $this->service = new ProductService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = $this->service->getCategories();
        return view('dashboard.product.create')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $product = $this->service->create($request);

            if ($product instanceof RedirectResponse) {
                return $product;
            }

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil disimpan',
                'system_message' => $product,
                'redirect' => route('produk.index') 
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan produk',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard.product.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
