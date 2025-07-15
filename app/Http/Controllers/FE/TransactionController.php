<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService,
    ) {}

    public function checkout(Request $request) {
        try {
            return $transaction = $this->transactionService->checkout($request);

            if ($transaction instanceof RedirectResponse) {
                return $transaction;
            }

            return redirect()->route('home.index')->with('success', 'Checkout berhasil, silahkan lakukan pembayaran');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput($request->all());
        }
    }
}
