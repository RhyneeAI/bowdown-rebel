<?php

namespace App\Http\Controllers\BE;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\PromotionService;
use App\Http\Controllers\Controller;
use App\Traits\GuardTraits;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PromotionController extends Controller
{
    use GuardTraits;
    private $service;
    public function __construct() 
    {
        $this->service = new PromotionService();
    }
    public function index()
    {
        return view('dashboard.promotion.index');
    }
    /**
     * Display the promotion detail.
     */
    public function datatable()
    {
        $promotion = $this->service->getAll(); 

        $guard = $this->getGuardName();
        $role = Auth::guard($guard)->user()->role->role;

        return DataTables::of($promotion)
            ->addIndexColumn()
            ->addColumn('action', function($row) use ($role){
                $previewBtn =  '<span class="btn btn-sm btn-info preview-btn" data-bs-toggle="modal" data-bs-target="#previewModalPromotion" data-image="'. asset('storage/promotions/' . $row->foto) .'" style="cursor: pointer;">
                                    <iconify-icon icon="mdi:eye" style="font-size: 18px;"></iconify-icon>
                                </span> ';

                $editBtn = '<a href="'. route($role.'.promotion.edit', $row->slug) .'" class="btn btn-sm btn-warning" style="cursor: pointer;">
                                <iconify-icon icon="mdi:pencil" style="font-size: 18px;"></iconify-icon>
                            </a> ';

                $deleteBtn = '<span class="delete-btn btn btn-sm btn-danger" data-bs-toggle="modal" data-route="'. route($role.'.promotion.destroy', $row->slug) .'" style="cursor: pointer;">
                                <iconify-icon icon="mdi:trash-can-outline" style="font-size: 18px;"></iconify-icon>
                            </span>';

                return "<div class='btn-group'>$previewBtn . $editBtn . $deleteBtn</div>";
            })
            ->editColumn('tanggal_mulai', function ($row) {
                return FormatDMY($row->tanggal_mulai);
            })
            ->editColumn('tanggal_berakhir', function ($row) {
                return FormatDMY($row->tanggal_berakhir);
            })
            ->editColumn('diskon_harga', function ($row) {
                return number_format($row->diskon_harga, 2, ',', '.');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method should return a view with a form to create a new promotion
        // For example, you might return a view like this:
        return view('dashboard.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $promotion = $this->service->create($request);

            if ($promotion instanceof RedirectResponse) {
                return $promotion;
            }

            $guard = $this->getGuardName();
            $role = Auth::guard($guard)->user()->role->role;

            return redirect()->route($role.'.promotion.index')->with('success', 'Promosi berhasil disimpan');
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
        $promotion = $this->service->getOne($slug);
        return view('dashboard.promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        try {
            $promotion = $this->service->update($request, $slug);

            if ($promotion instanceof RedirectResponse) {
                return $promotion;
            }

            $guard = $this->getGuardName();
            $role = Auth::guard($guard)->user()->role->role;

            return redirect()->route($role.'.promotion.index')->with('success', 'Promosi berhasil diperbarui');
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui promosi.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try {
            $promotion = $this->service->delete($slug);

            return response()->json(['message' => 'promosi berhasil dihapus.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan promosi.'], 500);
        } 
    }
}
