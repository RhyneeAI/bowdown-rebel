<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService,
    ) {}

    public function checkout(Request $request) {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput($request->all());
        }
    }
}
