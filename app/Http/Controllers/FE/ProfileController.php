<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Models\UserAddress;
use App\Models\Checkout;
use App\Enums\StatusCheckout;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user()->load('addresses');
        $userId = Auth::user()->id;
        $myorder = Checkout::where('id_user',$userId)
        ->whereHas('latestStatus', function($query){
            $query->where('status',StatusCheckout::DIKIRIM->value);
        })
        ->with(['checkoutDetail','latestStatus'])
        ->get();

        $myhistory = Checkout::where('id_user',$userId)
        ->whereHas('latestStatus',function($query){
            $query->where('status', StatusCheckout::SELESAI->value);
        })
        ->with(['checkoutDetail','latestStatus'])
        ->get();
        return view('web.profile.index', compact('user','myorder','myhistory'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'email' => 'required|email|max:255|unique:user,email,' . $user->id,
            'alamat.*' => 'required|string|max:255',
            'address_id.*' => 'nullable|integer',
            'is_main' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        try {
            $validated = $validator->validated();

            // Update user
            $user->fill([
                'nama' => $validated['nama'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'no_hp' => $validated['no_hp'],
                'email' => $validated['email'],
            ]);

            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }

            $user->save();

            // Update alamat
            $alamatIdsSebelumnya = $user->addresses->pluck('id')->toArray();
            $alamatIdsForm = $request->input('address_id', []);
            $alamatTexts = $request->input('alamat', []);
            $mainId = $request->input('is_main');

            $alamatBaruMapping = [];

            foreach ($alamatTexts as $i => $alamatText) {
                $id = $alamatIdsForm[$i] ?? null;

                if ($id) {
                    // Update alamat lama
                    UserAddress::where('id', $id)->update([
                        'alamat' => $alamatText,
                        'is_main' => 0,
                    ]);
                } else {
                    // Tambah alamat baru
                    $new = UserAddress::create([
                        'id_user' => $user->id,
                        'alamat' => $alamatText,
                        'is_main' => 0,
                    ]);
                    $alamatBaruMapping["new_$i"] = $new->id;
                }
            }

            // Tetapkan alamat utama
            if ($mainId) {
                if (str_starts_with($mainId, 'new_')) {
                    $mainNewId = $alamatBaruMapping[$mainId] ?? null;
                    if ($mainNewId) {
                        UserAddress::where('id', $mainNewId)->update(['is_main' => 1]);
                    }
                } else {
                    UserAddress::where('id', $mainId)->update(['is_main' => 1]);
                }
            }

            // Hapus alamat yang tidak dikirim lagi (alamat lama yang tidak masuk form)
            $filteredIds = array_filter($alamatIdsForm);
            $deletedIds = array_diff($alamatIdsSebelumnya, $filteredIds);
            UserAddress::whereIn('id', $deletedIds)->delete();

            return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }


    public function deleteAlamat($id)
    {
        $alamat = UserAddress::findOrFail($id);

        // Pastikan user yang login punya alamat ini
        if ($alamat->id_user !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan');
        }

        $alamat->delete();
        return redirect()->back()->with('success', 'Alamat berhasil dihapus.');
    }


    //my order
    public function markAsSelesai(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Selesai',
        ]);

        $checkout = Checkout::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // Update the latest CheckoutManagement record
        $latestStatus = $checkout->checkoutManagement()->latest('tanggal_status')->first();
        if ($latestStatus) {
            $latestStatus->update([
                'status' => $request->status,
                'tanggal_status' => now(),
            ]);
        } else {
            // Fallback: Create a new record if none exists
            $checkout->checkoutManagement()->create([
                'id_checkout' => $checkout->id,
                'status' => $request->status,
                'tanggal_status' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Pesanan ditandai sebagai selesai.');
    }


}
