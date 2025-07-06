<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductService 
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:30',
            'id_kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            // 1. Simpan produk
            $product = Product::create([
                'nama_produk' => $validated['nama_produk'],
                'id_kategori' => $validated['id_kategori'],
                'slug' => MakeSlug($validated['nama_produk']),
                'deskripsi' => $validated['deskripsi'],
                'unggulan' => 0,
                'status' => GetStatusProduk($validated['status']),
            ]);

            // 2. Simpan foto (jika ada)
            if ($request->hasFile('foto')) {
                $result = $this->upsertProductPhotos($request->file('foto'), $product, 'insert');
                if(is_string($result)) {
                    return $result;
                }
            }

            // 3. Simpan varian (jika ada)
            if ($request->has('varian')) {
                $variants = json_decode($request->input('varian'), true);
                $result = $this->upsertProductVariants($variants, $product);

                if(is_string($result)) {
                    return $result;
                }
            }

            return $product;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request, String $slug)
    {
        $product = Product::where('slug', $slug)->first();

        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:30',
            'id_kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            // 1. Simpan produk
            $result = Product::where('slug', $slug)->update([
                'nama_produk' => $validated['nama_produk'],
                'id_kategori' => $validated['id_kategori'],
                'slug' => MakeSlug($validated['nama_produk']),
                'deskripsi' => $validated['deskripsi'],
                'unggulan' => 0,
                'status' => GetStatusProduk($validated['status']),
            ]);

            // 2. Simpan foto (jika ada)
            if ($request->hasFile('foto')) {
                $result = $this->upsertProductPhotos($request, $product, 'update');
                if(is_string($result)) {
                    return $result;
                }
            }

            // 3. Simpan varian (jika ada)
            if ($request->has('varian')) {
                $variants = json_decode($request->input('varian'), true);
                $result = $this->upsertProductVariants($variants, $product, 'update');

                if(is_string($result)) {
                    return $result;
                }
            }

            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    protected function upsertProductPhotos(Request $request, Product $product, String $type = 'insert')
    {
        try {
            if ($type === 'update') {
                // Ambil semua foto lama dari database
                $existingPhotos = ProductPhoto::where('id_produk', $product->id)->get();
                $fotoLama = $request->foto_lama ?? [];

                foreach ($existingPhotos as $photo) {
                    // Jika foto di database TIDAK ADA di foto_lama yang dikirim, hapus
                    if (!in_array($photo->nama_hash, $fotoLama)) {
                        DeleteFile('products', $photo->nama_hash);
                        $photo->delete();
                    }
                }
            }

            // Simpan foto baru (jika ada)
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $filename = UploadFile('products', $file);
                    ProductPhoto::create([
                        'id_produk' => $product->id,
                        'nama_asli' => $file->getClientOriginalName(),
                        'nama_hash' => $filename,
                        'path' => $filename
                    ]);
                }
            }

            return true;
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    protected function upsertProductVariants(Array $variants, Product $product, String $type = 'insert')
    {
        try {
            if ($type === 'update') {
                ProductVariant::where('id_produk', $product->id)->delete();
            }

            foreach ($variants as $varian) {
                ProductVariant::create([
                    'id_produk' => $product->id,
                    'ukuran' => $varian['ukuran'],
                    'harga' => ParseRupiah($varian['harga']),
                    'stok' => $varian['stok'],
                    'min_stok' => $varian['min_stok'],
                ]);
            }

            return true;
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getCategories() {
        $category = Category::select(['id', 'nama_kategori'])->get();
        return $category;
    }

    public function getAll($filters)
    {
        $product = Product::select(['id', 'nama_produk', 'id_kategori', 'slug', 'deskripsi', 'unggulan', 'status']);

        if($filters['id_kategori']) {
            $product->where('id_kategori', $filters['id_kategori']);
        }

        if($filters['status']) {
            $product->where('status', $filters['status']);
        }

        return $product->get();
    }

    public function getOne(String $slug = '')
    {
        $product = Product::select(['id', 'nama_produk', 'id_kategori', 'slug', 'deskripsi', 'unggulan', 'status'])->where('slug', $slug)->first();
        return $product;
    }

    public function delete(String $slug) 
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return $product->delete();
    }
}