<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use App\Models\ProductVariant;
use App\Models\ProductLiked;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
// use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


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
            return redirect()->back()->withErrors($validator)->with('error', $validator->errors()->first())->withInput($request->all());
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
                $result = $this->upsertProductPhotos($request, $product, 'insert');
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
            return redirect()->back()->withErrors($validator)->with('error', $validator->errors()->first())->withInput($request->all());
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
        $product = Product::with('photo')->select(['id', 'nama_produk', 'id_kategori', 'slug', 'deskripsi', 'unggulan', 'status']);

        if(isset($filters['id_kategori'])) {
            $product->where('id_kategori', $filters['id_kategori']);
        }

        if(isset($filters['status'])) {
            $product->where('status', $filters['status']);
        }

        return $product->orderBy('id', 'DESC')->get();
    }

    public function getOne(String $slug = '')
    {
        $product = Product::select(['id', 'nama_produk', 'id_kategori', 'slug', 'deskripsi', 'unggulan', 'status'])->where('slug', $slug)->first();
        return $product;
    }

    public function getHotProducts()
    {
        $hotProducts = Product::select(['id', 'nama_produk', 'slug', 'status', 'unggulan'])
            ->with(['variants' => fn($q) => $q->select('id_produk', 'harga')->orderBy('harga')])
            ->where('unggulan', 1)
            ->where('status', StatusEnum::AKTIF)
            ->limit(6)
            ->get()
            ->map(function($product) {
                if ($product->variants->isEmpty()) {
                    $product->harga_min = 0;
                    $product->harga_max = 0;
                } else {
                    $prices = $product->variants->pluck('harga');
                    $product->harga_min = $prices->min();
                    $product->harga_max = $prices->max();
                }
                $product->from = 'Hot Product';
                unset($product->variants);
                return $product;
            });

        if ($hotProducts->count() < 6) {
            $remaining = 6 - $hotProducts->count();
            
            $existingProductIds = $hotProducts->pluck('id')->toArray();
            
            $popularProducts = ProductLiked::selectRaw('id_produk, COUNT(id) as like_count')
                ->with(['product' => function($q) {
                    $q->select('id', 'nama_produk', 'slug', 'status', 'unggulan')
                    ->with(['variants' => fn($q) => $q->select('id_produk', 'harga')->orderBy('harga')]);
                }])
                ->whereHas('product', function($q) {
                    $q->where('status', StatusEnum::AKTIF);
                })
                ->whereNotIn('id_produk', $existingProductIds)
                ->groupBy('id_produk')
                ->orderByDesc('like_count')
                ->limit($remaining)
                ->get()
                ->map(function($item) {
                    $product = $item->product;
                    if ($product->variants->isEmpty()) {
                        $product->harga_min = 0;
                        $product->harga_max = 0;
                    } else {
                        $product->harga_min = $product->variants->min('harga');
                        $product->harga_max = $product->variants->max('harga');
                    }
                    $product->from = 'Popular Product';
                    unset($product->variants);
                    return $product;
                });
                
            $hotProducts = $hotProducts->merge($popularProducts);
        }

        return $hotProducts;
    }

    public function getShopProducts(Object $filters)
    {
        $filters->min_price = (int) str_replace(['Rp.', '.', ','], '', $filters->min_price);
        $filters->max_price = (int) str_replace(['Rp.', '.', ','], '', $filters->max_price);
        
        $products = Product::select(['id', 'nama_produk', 'slug', 'status', 'unggulan', 'id_kategori'])
            ->with([
                'photo',
                'variants' => function ($q) {
                    $q->select('id', 'id_produk', 'harga', 'ukuran')->orderBy('harga');
                }
            ])
            ->where('status', StatusEnum::AKTIF);


        // Sortir
        $sort_map = [
            'Newest'     => ['id', 'DESC'],
            'Oldest'     => ['id', 'ASC'],
            'Popular'    => ['like_count', 'DESC'],
        ];

        if ($filters->sort_by === 'Popular') {
            $products = Product::select([
                'produk.id',
                'produk.nama_produk',
                'produk.slug',
                'produk.status',
                'produk.unggulan',
                'produk.id_kategori',
                DB::raw('COUNT(produk_disukai.id) as like_count')
            ])
            ->leftJoin('produk_disukai', 'produk.id', '=', 'produk_disukai.id_produk')
            ->with([
                'photo',
                'variants' => fn($q) => $q->select('id', 'id_produk', 'harga', 'ukuran')->orderBy('harga')
            ])
            ->where('produk.status', StatusEnum::AKTIF)
            ->groupBy('produk.id', 'produk.nama_produk', 'produk.slug', 'produk.status', 'produk.unggulan', 'produk.id_kategori')
            ->orderByDesc('like_count');
        } else {
            [$sort_column, $sort_direction] = $sort_map[$filters->sort_by] ?? ['id', 'DESC'];
            $products->orderBy($sort_column, $sort_direction);
        }

        // Filter harga
        if ($filters->min_price && $filters->max_price) {
            $products->whereHas('variants', function ($q) use ($filters) {
                $q->whereBetween('harga', [$filters->min_price, $filters->max_price]);
            });
        }

        // Filter ukuran
        if (!empty($filters->size)                                                                                                          ) {
            $products->whereHas('variants', function ($q) use ($filters) {
                $q->whereIn('ukuran', $filters->size);
            });
        }

        // Filter kategori
        if (!empty($filters->category) && $filters->category !== 'All') {
            $products->where('id_kategori', $filters->category);
        }

        if (!empty($filters->search)) {
            $products->where('nama_produk', 'LIKE', '%'.$filters->search.'%');
        }

        return $products->paginate(6);
    }


    public function delete(String $slug) 
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return $product->delete();
    }
}