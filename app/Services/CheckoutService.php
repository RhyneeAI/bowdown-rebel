<?php

namespace App\Services;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutService 
{
    public function getAllJoin(Request $request)
    {
        $query = DB::table('checkout')
                ->join('ekspedisi', 'ekspedisi.id', 'checkout.id_ekspedisi')
                ->join('user', 'user.id', 'checkout.id_user')
                ->select(['checkout.*', 'ekspedisi.nama_ekspedisi', 'user.nama'])
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
        $transaction = Checkout::where('id', $id)->first();
        
        return $transaction;
    }
}