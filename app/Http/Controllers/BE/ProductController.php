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
        $category = $this->service->getCategories();
        return view('dashboard.product.index')->with('categories', $category);
    }

    public function list(Request $request) 
    {
        $filters = [
            'id_kategori' => $request->input('id_kategori'),
            'status'      => $request->input('status')
        ];
        $products = $this->service->getAll($filters)->load(['category', 'photos']);
        $cards = [];

        if ($products->isEmpty()) {
            $cards[] = '
                <div class="col-12 text-center my-5">
                    <h5 class="text-muted">Tidak ada produk yang ditemukan.</h5>
                </div>';
        } else {
            foreach ($products as $row) {
                $photoPaths = $row->photos->map(function ($p) {
                    return asset('storage/products/' . $p->nama_hash);
                })->toArray();

                $photoUrl = count($photoPaths) > 0 ? $photoPaths[0] : '-';
                $encodedPhotos = htmlspecialchars(json_encode($photoPaths), ENT_QUOTES, 'UTF-8');

                $activeStatus = ($row->status == 'Aktif') ? 'border-active' : 'border-nonactive';

                $cards[] = '
                <div class="col-md-4 px-2 mb-4">
                    <div class="card shadow-sm h-60 '. $activeStatus .'">
                        <img src="' . $photoUrl . '" class="card-img-top" alt="' . e($row->nama_produk) . '" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">' . e($row->nama_produk) . '</h6>
                            <p class="mb-1 text-primary">' . e($row->category->nama_kategori ?? '-') . '</p>
                        </div>
                        <div class="card-footer bg-white border-top-0 text-center">
                            <span class="btn btn-sm btn-info btn-preview" data-bs-toggle="modal" data-bs-target="#previewModal" data-photos="' . $encodedPhotos . '" style="cursor: pointer;">
                                <iconify-icon icon="mdi:eye" style="font-size: 18px; padding-top: 3px"></iconify-icon>
                            </span>

                            <a href="' . route('product.edit', $row->slug) . '" class="btn btn-sm btn-warning btn-edit" style="cursor: pointer;">
                                <iconify-icon icon="mdi:pencil" style="font-size: 18px; padding-top: 3px"></iconify-icon>
                            </a>

                            <span class="btn-delete btn btn-sm btn-danger" data-bs-toggle="modal" data-route="' . route('product.destroy', $row->slug) . '" style="cursor: pointer;">
                                <iconify-icon icon="mdi:trash-can-outline" style="font-size: 18px; padding-top: 3px"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>';
            }
        }

        return response()->json([
            'cards' => implode('', $cards)
        ]);
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
                'redirect' => route('product.index') 
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
