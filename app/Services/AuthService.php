<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use App\Traits\GuardTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService 
{
    use GuardTraits;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password harus setidaknya 6 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with('error', $validator->errors()->first());
        }

        try {
            $validated = $validator->validated();
        
            $validationUser = User::where('email', $validated['email'])->with('role')->first();
            if ($validationUser) {
                $role = $validationUser->role->role;

                $remember = $validated['remember_me'] ?? null;
                if (Hash::check($validated['password'], $validationUser->password)) {
                    Auth::guard($role)->login($validationUser, $remember);
                    $request->session()->regenerate();

                    if ($role === 'Admin') {
                        return redirect()->intended('dashboard')->with('success', "Login Berhasil");
                    } elseif ($role === 'User') {
                        return redirect()->intended('/')->with([
                            'success' => "Login Berhasil",
                            'user' => $validationUser
                        ]);
                    }
                } else {
                    return back()->with('error', 'Email atau password salah')->withInput($request->all());
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        return back()->with('error', 'Email atau password salah')->withInput($request->all());
    }

    public function logout(Request $request)
    {
        try {
            $guard = $this->getGuardName();

            Auth::guard($guard)->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect("/login")->with('success', 'Logout Berhasil!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}