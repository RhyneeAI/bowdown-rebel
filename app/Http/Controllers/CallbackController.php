<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use App\Enums\MidtransStatus;
use App\Enums\StatusCheckout;
use App\Enums\TransactionStatus;
use App\Exceptions\ResponseApiException;
use App\Models\Checkout;
use App\Models\CheckoutManagement;
use App\Models\Payment;
use App\Models\Transaction;
use App\Services\CallbackService;
use App\Traits\LoggingTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\RC2;

class CallbackController extends Controller
{
    public function __construct(
        protected CallbackService $callbackService,
    ) {}

    public function callbackMidtrans(Request $request) {
        try {
            return $this->callbackService->callbackMidtrans($request);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => env('APP_DEBUG') == true ? $th->getMessage() : 'Terjadi Kesalahan Pada Server',
            ], 500);
        }
    }
}
