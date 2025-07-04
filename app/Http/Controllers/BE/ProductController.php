<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This method should return a view with a list of products
        // For example, you might return a view like this:
        return view('dashboard.product.index');
    }

    public function detail()
    {
        // This method should return a view with the details of a specific product
        // For example, you might return a view like this:
        return view('dashboard.product.edit');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method should return a view with a form to create a new product
        // For example, you might return a view like this:
        return view('dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        // This method should return a view with a form to edit the product
        // For example, you might return a view like this:
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
