<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Models\User;
use App\Models\UserAddress;
use App\Traits\GuardTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService 
{
    use GuardTraits;

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|string|digits:16|unique:user,nik',
                'nama' => 'required|string|max:150',
                'tanggal_lahir' => 'required|date',
                'no_hp' => 'nullable|string|max:15',
                'email' => 'required|string|email|max:100',
                'id_role' => 'required|integer|exists:role,id',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:6',
                'alamat' => 'required|string',
            ], [
                'nik.required' => 'NIK wajib diisi',
                'nik.string' => 'NIK harus berupa string',
                'nik.digits' => 'NIK harus berupa 16 digit',
                'nik.unique' => 'NIK sudah terdaftar',
                'nama.required' => 'Nama wajib diisi',
                'nama.string' => 'Nama harus berupa string',
                'nama.max' => 'Nama maksimal 150 karakter',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
                'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
                'no_hp.string' => 'No HP harus berupa string',
                'no_hp.max' => 'No HP maksimal 15 karakter',
                'email.required' => 'Email wajib diisi',
                'email.string' => 'Email harus berupa string',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email maksimal 100 karakter',
                'id_role.required' => 'Role wajib diisi',
                'id_role.integer' => 'Role harus berupa integer',
                'id_role.exists' => 'Role tidak ditemukan',
                'foto.image' => 'Foto harus berupa gambar',
                'foto.mimes' => 'Foto harus berupa file dengan tipe jpg, jpeg, atau png',
                'foto.max' => 'Foto maksimal 5120 KB',
                'username.required' => 'Username wajib diisi',
                'username.string' => 'Username harus berupa string',
                'username.max' => 'Username maksimal 255 karakter',
                'password.required' => 'Password wajib diisi',
                'password.string' => 'Password harus berupa string',
                'password.min' => 'Password minimal 6 karakter',
                'alamat.required' => 'Alamat wajib diisi',
                'alamat.string' => 'Alamat harus berupa string',
            ]);

            if ($validator->fails()) {
                DB::rollBack();
                return redirect()->back()->withErrors($validator)->with('error', $validator->errors()->first())->withInput($request->all());
            }

            $validated = $validator->validated();

            $filename = null;
            if ($request->hasFile('foto')) {
                $filename = UploadFile('users', $request->file('foto'));
            }

            $user = User::create([
                'nik' => $validated['nik'],
                'nama' => $validated['nama'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'no_hp' => $validated['no_hp'],
                'email' => $validated['email'],
                'id_role' => $validated['id_role'],
                'foto' => $filename,
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
            ]);

            UserAddress::create([
                'id_user' => $user->id,
                'alamat' => $validated['alamat'],
                'is_main' => 1
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getAll()
    {
        $guard = $this->getGuardName();
        $user = Auth::guard($guard)->user();

        $user = DB::table('user')
            ->join('role', 'role.id', '=', 'user.id_role')
            ->select(['user.id', 'user.nik', 'user.nama', 'user.tanggal_lahir', 'user.no_hp', 'user.email', 'user.foto', 'role.role', 'user.foto', 'user.username'])
            ->where('user.id', '!=', $user->id)
            ->where('user.deleted_at', null)
            ->orderBy('user.id', 'DESC')->get();
        
        return $user;
    }

    public function getOne(String $id = '')
    {
        $user = User::where('id', $id)->first();
        
        return $user;
    }

    public function update(Request $request, String $id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->firstOrFail();

            $validator = Validator::make($request->all(), [
                'nik' => 'required|string|digits:16|unique:user,nik,'.$user->id,
                'nama' => 'required|string|max:150',
                'tanggal_lahir' => 'required|date',
                'no_hp' => 'nullable|string|max:15',
                'email' => 'required|string|email|max:100',
                'id_role' => 'required|integer|exists:role,id',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'username' => 'required|string|max:255',
                'password' => 'nullable|string|min:6',
                'alamat' => 'required|string',
            ], [
                'nik.required' => 'NIK wajib diisi',
                'nik.string' => 'NIK harus berupa string',
                'nik.digits' => 'NIK harus berupa 16 digit',
                'nik.unique' => 'NIK sudah terdaftar',
                'nama.required' => 'Nama wajib diisi',
                'nama.string' => 'Nama harus berupa string',
                'nama.max' => 'Nama maksimal 150 karakter',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
                'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
                'no_hp.string' => 'No HP harus berupa string',
                'no_hp.max' => 'No HP maksimal 15 karakter',
                'email.required' => 'Email wajib diisi',
                'email.string' => 'Email harus berupa string',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email maksimal 100 karakter',
                'id_role.required' => 'Role wajib diisi',
                'id_role.integer' => 'Role harus berupa integer',
                'id_role.exists' => 'Role tidak ditemukan',
                'foto.image' => 'Foto harus berupa gambar',
                'foto.mimes' => 'Foto harus berupa file dengan tipe jpg, jpeg, atau png',
                'foto.max' => 'Foto maksimal 5120 KB',
                'username.required' => 'Username wajib diisi',
                'username.string' => 'Username harus berupa string',
                'username.max' => 'Username maksimal 255 karakter',
                'password.required' => 'Password wajib diisi',
                'password.string' => 'Password harus berupa string',
                'password.min' => 'Password minimal 6 karakter',
                'alamat.required' => 'Alamat wajib diisi',
                'alamat.string' => 'Alamat harus berupa string',
            ]);

            if ($validator->fails()) {
                DB::rollBack();
                return redirect()->back()->withErrors($validator)->with('error', $validator->errors()->first())->withInput($request->all());
            }

            $validated = $validator->validated();

            $payload = [
                'nik' => $validated['nik'],
                'nama' => $validated['nama'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'email' => $validated['email'],
                'id_role' => $validated['id_role'],
                'username' => $validated['username'],
            ];

            if ($request->hasFile('foto')) {
                $filename = UploadFile('users', $request->file('foto'));

                $payload['foto'] = $filename;
            }

            if($validated['password']){
                $payload['password'] = Hash::make($validated['password']);
            }
            
            if($validated['no_hp']){
                $payload['no_hp'] = $validated['no_hp'];
            }

            $user->update($payload);

            $user->address()->updateOrCreate(
                [
                    'id_user' => $user->id
                ],
                [
                    'alamat' => $validated['alamat'],
                    'is_main' => 1
                ]
            );

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(String $id) 
    {
        $user = User::where('id', $id)->firstOrFail();

        return $user->delete();
    }

}