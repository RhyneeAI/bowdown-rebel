<?php

namespace App\Http\Controllers\BE;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

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
        return view('dashboard.category.index');
    }

    public function datatable()
    {
        $category = $this->service->getAll(); 

        return DataTables::of($category)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $previewBtn = '<span class="btn btn-sm btn-info preview-btn" data-bs-toggle="modal" data-bs-target="#previewModal" data-image="'. asset('storage/categories/' . $row->foto) .'" style="cursor: pointer;">
                    <iconify-icon icon="mdi:eye" style="font-size: 18px;"></iconify-icon>
                </span> ';

                $editBtn = '<a href="'. route('kategori.edit', $row->slug) .'" class="btn btn-sm btn-warning" style="cursor: pointer;">
                    <iconify-icon icon="mdi:pencil" style="font-size: 18px;"></iconify-icon>
                </a> ';

                $deleteBtn = '<span class="delete-btn btn btn-sm btn-danger" data-bs-toggle="modal" data-route="'. route('kategori.destroy', $row->slug) .'" style="cursor: pointer;">
                    <iconify-icon icon="mdi:trash-can-outline" style="font-size: 18px;"></iconify-icon>
                </span>';

                return $previewBtn . $editBtn . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        try {
            $category = $this->service->create($request);

            if ($category instanceof RedirectResponse) {
                return $category;
            }

            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil disimpan');
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan kategori.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id = "")
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $category = $this->service->getOne($slug);
        
        return view('dashboard.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        try {
            $category = $this->service->update($request, $slug);

            if ($category instanceof RedirectResponse) {
                return $category;
            }

            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan kategori.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $slug)
    {
        try {
            $category = $this->service->delete($slug);

            return response()->json(['message' => 'Kategori berhasil dihapus.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan kategori.'], 500);
        }   
    }
}
