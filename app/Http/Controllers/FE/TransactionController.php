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
            $transaction = $this->transactionService->checkout($request);

            if ($transaction instanceof RedirectResponse) {
                return $transaction;
            }

            if($request->ajax()){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Checkout berhasil, silahkan lakukan pembayaran',
                    'data' => $transaction
                ]);
            }
            return redirect()->route('home.index')->with('success', 'Checkout berhasil, silahkan lakukan pembayaran');
        } catch (\Throwable $th) {
            if($request->ajax()){
                return response()->json([
                    'status' => 'error',
                    'message' => $th->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', $th->getMessage())->withInput($request->all());
        }
    }
}
