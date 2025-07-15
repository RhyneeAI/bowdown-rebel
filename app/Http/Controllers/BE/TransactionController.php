<?php

namespace App\Http\Controllers\BE;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Services\CheckoutService;
use App\Traits\GuardTraits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    use GuardTraits;
    
    public function __construct(protected CheckoutService $service) {}

    public function index()
    {
        return view('dashboard.transaction.index');
    }
    /**
     * Display the promotion detail.
     */
    public function datatable(Request $request)
    {
        $data = $this->service->getAllJoin($request); 

        return DataTables::of($data)
            ->addColumn('total_harga', function ($model) {
                return 'Rp. '. number_format((float) $model->total_harga, 0, ',', '.');
            })
            ->addColumn('diskon', function ($model) {
                return 'Rp. '. number_format((float) $model->diskon, 0, ',', '.');
            })
            ->addColumn('dibayar', function ($model) {
                return 'Rp. '. number_format((float) $model->dibayar, 0, ',', '.');
            })
            ->editColumn('no_faktur', function($model){
                return '<span class="badge bg-info  ">'. $model->no_faktur .'</span>';
            })
            // ->editColumn('status', function ($model) {
            //     if($model->status == TransactionStatus::WAITING_PAYMENT->value){
            //         $bg = 'bg-warning';
            //     } else if($model->status == TransactionStatus::PAID->value){
            //         $bg = 'bg-success';
            //     } else if($model->status == TransactionStatus::FAILED->value){
            //         $bg = 'bg-danger';
            //     } else if($model->status == TransactionStatus::CLAIMED->value){
            //         $bg = 'bg-info';
            //     }

            //     $status = TransactionHelper::translateStatusToIndonesia($model->status);
            //     return '<span class="badge '. $bg .'">'. $status .'</span>';
            // })
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->format('d-m-Y H:i');
            })
            ->addColumn('action', 'dashboard.transaction.datatables.options')
            ->setRowAttr([
                'data-model-id' => function ($model) {
                    return $model->id;
                }
            ])
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'no_faktur'])
            ->toJson();
    }

    public function show($id)
    {
        $transaction = $this->service->getOne($id);

        return $transaction;
    }
}
