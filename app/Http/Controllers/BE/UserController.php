<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Traits\GuardTraits;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use GuardTraits;

    public function __construct(protected UserService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user.index');
    }

    public function datatable()
    {
        $user = $this->service->getAll(); 

        $guard = $this->getGuardName();
        $role = Auth::guard($guard)->user()->role->role;

        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($role) {
                return view('dashboard.user.datatables.options', [
                    'row' => $row,
                    'role' => $role,
                ])->render();
            })
            ->editColumn('tanggal_lahir', function ($model) {
                return Carbon::parse($model->tanggal_lahir)->format('d-m-Y');
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = DB::table('role')->select('id', 'role')->orderBy('role', 'ASC')->get();
        return view('dashboard.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        try {
            $user = $this->service->create($request);

            if ($user instanceof RedirectResponse) {
                return $user;
            }

            $guard = $this->getGuardName();
            $role = Auth::guard($guard)->user()->role->role;

            return redirect()->route($role.'.user.index')->with('success', 'Pengguna berhasil disimpan');
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui pengguna.'], 500);
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
        $data['roles'] = DB::table('role')->select('id', 'role')->orderBy('role', 'ASC')->get();
        $data['user'] = $this->service->getOne($id);
        
        return view('dashboard.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = $this->service->update($request, $id);

            if ($user instanceof RedirectResponse) {
                return $user;
            }

            $guard = $this->getGuardName();
            $role = Auth::guard($guard)->user()->role->role;

            return redirect()->route($role.'.user.index')->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui pengguna.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = $this->service->delete($id);

            return response()->json(['message' => 'Pengguna berhasil dihapus.'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus pengguna.'], 500);
        }   
    }
}