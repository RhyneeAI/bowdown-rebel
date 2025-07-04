<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $service;
    public function __construct() 
    {
        $this->service = new CategoryService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This method should return a view with a list of categories
        // For example, you might return a view like this:
        return view('dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method should return a view with a form to create a new category
        // For example, you might return a view like this:
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $category = $this->service->create($request);

            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil disimpan');
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan kategori.'], 500);
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
        // This method should return a view with a form to edit an existing category
        // For example, you might return a view like this:
        return view('dashboard.category.edit');
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
