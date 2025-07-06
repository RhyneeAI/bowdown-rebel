<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryService 
{
    public function create($request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:30',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $filename = null;
        if ($request->hasFile('foto')) {
            $filename = UploadFile($request->file('foto'), 'categories');
        }

        return Category::create([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => MakeSlug($validated['nama_kategori']),
            'foto' => $filename,
        ]);
    }

    public function getAll()
    {
        $category = Category::select(['id', 'slug', 'nama_kategori', 'foto'])->get();
        return $category;
    }

    public function getOne(string $slug = '')
    {
        $category = Category::select(['id', 'slug', 'nama_kategori', 'foto'])->where('slug', $slug)->first();
        return $category;
    }

    public function update($request, string $slug)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:30',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $category = Category::where('slug', $slug)->firstOrFail();
        $filename = $category->foto; 
        if ($request->hasFile('foto')) {
            DeleteFile('categories', $category->foto);

            $filename = UploadFile($request->file('foto'), 'categories');
        }

        $category->update([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => MakeSlug($validated['nama_kategori']),
            'foto' => $filename,
        ]);

        return $category;
    }

    public function delete(string $slug) 
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        if ($category->foto) {
            DeleteFile('categories', $category->foto);
        }

        return $category->delete();
    }

}