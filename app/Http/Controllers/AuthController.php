<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $loginService
    ) {}
    
    public function index()
    {
        return view('web.auth.login');
    }

    public function register(){
        return view('web.auth.register');
    }

    public function loginProcess(Request $request){
        try {
            return $this->loginService->login($request);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput($request->all());
        }
    }

    public function logout(Request $request){
        try {
            return $this->loginService->logout($request);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput($request->all());
        }
    }
}
