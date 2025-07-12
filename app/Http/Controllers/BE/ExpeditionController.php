<?php

namespace App\Http\Controllers\BE;

use App\Enums\StatusEnum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Services\ExpeditionService;
use App\Traits\GuardTraits;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ExpeditionController extends Controller
{
    use GuardTraits;

    public function __construct(protected ExpeditionService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.expedition.index');
    }

    public function datatable()
    {
        $expedition = $this->service->getAll(); 

        $guard = $this->getGuardName();
        $role = Auth::guard($guard)->user()->role->role;

        return DataTables::of($expedition)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($role) {
                return view('dashboard.expedition.datatables.options', [
                    'row' => $row,
                    'role' => $role,
                ])->render();
            })
            ->editColumn('status', function ($model) {
                $bgColor = $model->status == StatusEnum::AKTIF->value ? 'success' : 'danger';

                return '<span class="badge bg-' . $bgColor . '">' . StatusEnum::AKTIF->value . '</span>';
            })
            ->editColumn('biaya', function ($model) {
                return 'Rp. '. number_format($model->biaya, 0, ',', '.');
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.expedition.create');
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        try {
            $expedition = $this->service->create($request);

            if ($expedition instanceof RedirectResponse) {
                return $expedition;
            }

            $guard = $this->getGuardName();
            $role = Auth::guard($guard)->user()->role->role;

            return redirect()->route($role.'.expedition.index')->with('success', 'Ekspedisi berhasil disimpan');
        } catch (\Throwable $e) {
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
    public function edit(string $id)
    {
        $expedition = $this->service->getOne($id);
        
        return view('dashboard.expedition.edit')->with('expedition', $expedition);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $expedition = $this->service->update($request, $id);

            if ($expedition instanceof RedirectResponse) {
                return $expedition;
            }

            $guard = $this->getGuardName();
            $role = Auth::guard($guard)->user()->role->role;

            return redirect()->route($role.'.expedition.index')->with('success', 'Ekspedisi berhasil diperbarui');
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui kategori.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $expedition = $this->service->delete($id);

            return response()->json(['message' => 'Ekspedisi berhasil dihapus.'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan kategori.'], 500);
        }   
    }
}
