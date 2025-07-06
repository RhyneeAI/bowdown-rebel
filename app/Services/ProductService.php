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
    public function create($request)
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

    protected function upsertProductPhotos(Array $files, Product $product, String $type = 'insert')
    {
        try {
            if ($type === 'update') {
                $existingPhotos = ProductPhoto::where('id_produk', $product->id)->get();
                foreach ($existingPhotos as $photo) {
                    DeleteFile('products', $photo->nama_hash);
                    $photo->delete();
                }
            }
    
            foreach ($files as $file) {
                $filename = UploadFile('products', $file);
                ProductPhoto::create([
                    'id_produk' => $product->id,
                    'nama_asli' => $file->getClientOriginalName(),
                    'nama_hash' => $filename,
                    'path' => $filename
                ]);
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
}