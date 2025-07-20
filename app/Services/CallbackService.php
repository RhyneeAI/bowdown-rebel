<?php 
namespace App\Services;

use App\Enums\MidtransStatus;
use App\Enums\StatusCheckout;
use App\Models\Checkout;
use App\Models\CheckoutManagement;
use App\Traits\LoggingTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CallbackService
{
    use LoggingTraits;

    public function callbackMidtrans(Request $request)
    {
        DB::beginTransaction();
        try {
            $gross_amount = $request['gross_amount'];
            $order_id = $request['order_id'];
            $status_code = $request['status_code'];
            $server_key = env('MIDTRANS_SERVER_KEY');

            $reqSignature = $request['signature_key'];
            $signature = hash('sha512', $order_id . $status_code . $gross_amount . $server_key);

            if ($reqSignature != $signature) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Signature',
                ], 400);
            }

            $transaction = Checkout::where('no_faktur', $order_id)->first();
            if(!$transaction){
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaksi Tidak Ditemukan',
                ], 404);
            }

            if($transaction->latestStatus()->status != StatusCheckout::MENUNGGU->value){
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaksi Tidak Dapat Di Proses',
                ], 400);
            }

            $currentTimestamp = now();
            $total_bayar_current = (float) $gross_amount ?? 0;
            $total_dibayar = (float) $transaction->dibayar;
            $dibayar =  $total_bayar_current + $total_dibayar;

            $transaction_status = $request['transaction_status'];
            if(in_array($transaction_status, MidtransStatus::success())){
                $status = StatusCheckout::DIPROSES->value;
            } else if(in_array($transaction_status, MidtransStatus::failed())) {
                $status = StatusCheckout::DIBATALKAN->value;
            } else if(in_array($transaction_status, MidtransStatus::refund())) {
                $status = StatusCheckout::DIBATALKAN->value;
            } else if($transaction_status == MidtransStatus::EXPIRE->value) {
                $status = StatusCheckout::DIBATALKAN->value;
            } else {
                $status = StatusCheckout::MENUNGGU->value;
            }

            if($status == StatusCheckout::MENUNGGU->value){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaksi Tidak Dapat Di Proses',
                ], 400);
            }

            $payloadUpdate = [
                'updated_at' => now(),
            ];

            if($status == 1)
            {
                $payloadUpdate['dibayar'] = $dibayar;
            }
            
            CheckoutManagement::create([
                'id_checkout' => $transaction->id,
                'status' => $status
            ]);
            
            $transaction->update($payloadUpdate);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Pembayaran Berhasil',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
