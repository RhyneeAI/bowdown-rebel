<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService 
{
    public function create($request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('foto')) {
            $filename = UploadFile($request->file('foto'), 'categories');
        }

        return Category::create([
            'nama_kategori' => $validated['nama_kategori'],
            'foto' => $filename,
        ]);
    }

    public function read()
    {
        $category = Category::select(['id', 'nama_kategori', 'foto'])->get();
        return $category;
    }
}