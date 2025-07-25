<?php

namespace App\Services;

use App\Enums\StatusCheckout;
use App\Enums\StatusEnum;
use App\Exceptions\ResponseApiException;
use App\Helpers\MidtransHelper;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\CheckoutDetail;
use App\Models\CheckoutManagement;
use App\Models\Expedition;
use App\Models\ProductVariant;
use App\Models\Promotion;
use App\Models\PromotionUsed;
use App\Traits\GuardTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TransactionService 
{
    use GuardTraits;

    public function __construct(
        protected MidtransHelper $midtransHelper,
    ) {}

    public function checkout(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'variant_product_ids' => 'nullable|array',
                'variant_product_ids.*' => 'nullable|exists:varian_produk,id',
                'qty' => 'nullable|array',
                'qty.*' => 'nullable|integer',
                'promotion_ids' => 'nullable|array',
                'promotion_ids.*' => 'nullable|exists:promosi,id',
                'expedition_id' => 'required|exists:ekspedisi,id',
                'total_payment' => 'required|integer'
            ], [
                'variant_product_ids.array'         => 'The selected products must be in a valid list.',
                'variant_product_ids.*.exists'      => 'One or more selected products are invalid.',
                'promotion_ids.array'         => 'The selected promotions must be in a valid list.',
                'promotion_ids.*.exists'      => 'One or more selected promotions are invalid.',
                'expedition_id.required'   => 'Please select an expedition method.',
                'expedition_id.exists'     => 'The selected expedition is invalid.',
                'total_payment.required'   => 'Total payment amount is required.',
                'total_payment.integer'    => 'Total payment must be a valid number.',
            ]);

            if ($validator->fails()) {
                DB::rollBack();
                throw new ResponseApiException($validator->errors()->first(), 400);
            }

            $validated = $validator->validated();
            
            $expedition = Expedition::where('id', $validated['expedition_id'])->first();
            if(!$expedition){
                DB::rollBack();
                throw new ResponseApiException('Expedition Not Found', 400);
            }

            if(!isset($validated['promotion_ids'])){
                $validated['promotion_ids'] = [];
            }

            $checkPromotion = count($validated['promotion_ids']);
            if($checkPromotion > 1){
                DB::rollBack();
                throw new ResponseApiException('Please select only one promotion.', 400);
            }
            
            $variant_product_ids = $validated['variant_product_ids'];
            $qty = $validated['qty'];

            $lengths = [
                count($variant_product_ids),
                count($qty),
            ];

            if (count(array_unique($lengths)) !== 1) {
                DB::rollBack();
                throw new ResponseApiException('The selected products must be in a valid list.', 400);
            }

            $products = DB::table('varian_produk')
                        ->join('produk', 'varian_produk.id_produk', '=', 'produk.id')
                        ->join('kategori', 'produk.id_kategori', '=', 'kategori.id')
                        ->whereIn('varian_produk.id', $variant_product_ids)
                        ->select([
                            'kategori.nama_kategori',
                            'produk.nama_produk',
                            'produk.status',
                            'varian_produk.id as id_variant_produk',
                            'varian_produk.id_produk',
                            'varian_produk.harga',
                            'varian_produk.stok'
                        ])->get();

            $total_payment = 0;
            $item_detail_payload = [];
            $checkout_detail_payload = [];
            $now = date('Y-m-d H:i:s');
            $product_ids = [];

            foreach ($variant_product_ids as $key => $variant_product_id) {
                $product = $products->where('id_variant_produk', $variant_product_id)->first();

                if(!$product){
                    DB::rollBack();
                    throw new ResponseApiException('Product Not Found', 400);
                }

                $product_ids[] = $product->id_produk;

                if($product->status != StatusEnum::AKTIF->value){
                    DB::rollBack();
                    throw new ResponseApiException('Product Not Active', 422);
                }

                $productStok = (int) $product->stok;
                if($productStok < $qty[$key]){
                    DB::rollBack();
                    throw new ResponseApiException('Product Stock Not Enough', 422);
                }

                $productHarga = (int) $product->harga;
                $item_detail_payload[] = [
                    "id" => 'product' . $product->id_produk,
                    "price" => $productHarga,
                    "quantity" => $qty[$key],
                    "name" => $product->nama_produk,
                    "brand" => "Bowndown Rebel",
                    "category" => $product->nama_kategori,
                    "merchant_name" => "Bowndown Rebel",
                ];

                $checkout_detail_payload[] = [
                    "id_produk" => $product->id_produk,
                    "id_variant_produk" => $product->id_variant_produk,
                    "id_checkout" => null,
                    "qty" => $qty[$key],
                    "harga_satuan" => $productHarga,
                    "harga_subtotal" => $productHarga * $qty[$key],
                    "created_at" => $now,
                    "updated_at" => $now,
                ];

                ProductVariant::where('id', $variant_product_id)->update(['stok' => $productStok - $qty[$key]]);

                $total_payment += $productHarga * $qty[$key];
            }

            $item_detail_payload[] = [
                "id" => 'Ongkos Kirim' . $expedition->nama_ekspedisi,
                "price" => (int) $expedition->biaya,
                "quantity" => 1,
                "name" => $expedition->nama_ekspedisi,
                "brand" => "Bowndown Rebel",
                "category" => 'Ongkir',
                "merchant_name" => "Bowndown Rebel",
            ];

            $total_payment += (int) $expedition->biaya;

            $now = date('Y-m-d');
            $promotions = Promotion::whereIn('id', $validated['promotion_ids'])
                    ->whereDate('tanggal_mulai', '<=', $now)
                    ->whereDate('tanggal_berakhir', '>=', $now)
                    ->get();

            $total_discount = 0;
            $promotion_used = [];
            $guard = $this->getGuardName();
            $user = Auth::guard($guard)->user();
            foreach ($promotions as $key2 => $promotion) {
                $checkPromotionUsed = PromotionUsed::where('id_promosi', $promotion->id)->where('id_user', $user->id)->exists();
                if($promotion->stok <= 0 || $checkPromotionUsed){
                    continue;
                }

                $total_discount += (int) $promotion->diskon_harga;

                if($promotion->stok > 0){
                    $promotion->stok -= 1;
                }

                $promotion_used[] = [
                    'id_promosi' => $promotion->id,
                    'id_user' => $user->id,
                    "created_at" => $now,
                    "updated_at" => $now,
                ];

                $item_detail_payload[] = [
                    "id" => 'voucher' . $promotion->id,
                    "price" => (int) $promotion->diskon_harga * -1,
                    "quantity" => 1,
                    "name" => $promotion->nama_promosi ? $promotion->nama_promosi : $promotion->kode_promosi,
                    "brand" => "Bowndown Rebel",
                    "category" => 'Diskon',
                    "merchant_name" => "Bowndown Rebel",
                ];

                $promotion->save();
            }

            $total_payment -= $total_discount;
            
            if($total_payment != $validated['total_payment']){
                DB::rollBack();
                throw new ResponseApiException('Total Payment Not Match', 400);
            }

            $transaction = Checkout::create([
                'id_user' => $user->id,
                'id_ekspedisi' => $expedition->id,
                'no_faktur' => $this->midtransHelper->generateOrderId(),
                'total_harga' => $total_payment,
                'diskon' => $total_discount,
                'dibayar' => 0,
            ]);

            foreach ($checkout_detail_payload as &$item) {
                $item['id_checkout'] = $transaction->id;
            }
            unset($item);

            CheckoutDetail::insert($checkout_detail_payload);
            PromotionUsed::insert($promotion_used);

            CartItem::whereIn('id_produk', $product_ids)
                ->whereIn('id_varian_produk', $validated['variant_product_ids'])
                ->delete();     

            $payload = [
                'transaction_details' => [
                    'gross_amount' => $total_payment,
                    'order_id' => $transaction->no_faktur
                ],
                "enabled_payments" => [
                    "credit_card", "cimb_clicks", "bca_klikbca", "bca_klikpay", "bri_epay",
                    "echannel", "permata_va", "bca_va", "bni_va", "bri_va", "cimb_va",
                    "other_va", "gopay", "indomaret", "danamon_online", "akulaku", 
                    "shopeepay", "kredivo", "uob_ezpay", "other_qris"
                ],
                "credit_card" => [
                    "secure" => true
                ],
                "item_details" => $item_detail_payload,
                "customer_details" => [
                    "first_name" => $user->nama,
                    "email" => $user->email,
                ],
                "page_expiry" => [
                    "duration" => 24,
                    "unit" => "hours"
                ],
            ];

            CheckoutManagement::create([
                'id_checkout' => $transaction->id,
                'status' => StatusCheckout::MENUNGGU->value,
            ]);

            $response = $this->midtransHelper->send($payload, '/snap/v1/transactions');

            if (isset($response['error_messages'])) {
                DB::rollBack();
                throw new ResponseApiException($response['error_messages'][0], 422);
            }

            $transaction->update([
                'token' => $response['token'],
                'url_payment' => $response['redirect_url']
            ]);

            DB::commit();
            return $response;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function getAll(Request $request)
    {
        $query = Checkout::with([
                    'expedition:id,nama_ekspedisi', 
                    'user:id,nama',
                    'latestStatus:id,id_checkout,status'
                ])
                ->orderBy('id', 'DESC');
                
        if ($request->start_date) {
            $query->where('checkout.created_at', '>=', $request->start_date . ' 00:00:00');
        }

        if($request->end_date){
            $query->where('checkout.created_at', '<=', $request->end_date . ' 23:59:59');
        }
                
        $transaction = $query->get();

        return $transaction;
    }

    public function getOne($id)
    {
        try {
            $transaction = Checkout::where('id', $id)->first();
        
            return $transaction;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateReceipt(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'receipt' => 'required|string',
            ]);

            if ($validator->fails()) {
                DB::rollBack();
                return redirect()->back()->withErrors($validator)->withInput($request->all())->with('error', $validator->errors()->first());
            }

            $transaction = $this->getOne($id);
            if (!$transaction) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Transaksi tidak ditemukan')->withInput($request->all());
            }

            $transaction->update([
                'resi' => $request->receipt
            ]);

            CheckoutManagement::create([
                'id_checkout' => $transaction->id,
                'status' => StatusCheckout::DIKIRIM->value
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Resi berhasil diinputkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}