<?php

namespace App\Http\Controllers\BE;

use Carbon\Carbon;
use App\Traits\GuardTraits;
use App\Enums\StatusCheckout;
use App\Services\TransactionService;
use App\Services\CheckoutService;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    use GuardTraits;
    
    public function __construct(protected TransactionService $service) {}

    public function index()
    {
        return view('dashboard.transaction.index');
    }
    /**
     * Display the promotion detail.
     */
    public function datatable(Request $request)
    {
        $data = $this->service->getAll($request); 

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
            ->addColumn('nama_ekspedisi', function($model){
                return $model->expedition->nama_ekspedisi;
            })
            ->addColumn('nama', function($model){
                return $model->user->nama;
            })
            ->addColumn('status_terbaru', function($model){
                $status = $model->latestStatus->status;
                $bg = StatusCheckout::getBadgeColor($status);
                return '<span class="badge text-white bg-'. $bg .'">'. $status .'</span>';
            })
            ->editColumn('resi', function($model){
                return $model->resi ?? '-';
            })
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
            ->rawColumns(['action', 'status_terbaru', 'no_faktur'])
            ->toJson();
    }

    public function show($id)
    {
        $transaction = $this->service->getOne($id);
        
        return view('dashboard.transaction.show', compact('transaction'));
    }

    public function receiptUpdate(Request $request, $id)
    {
        try {
            return $this->service->updateReceipt($request, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput($request->all());
        }
    }

    public function exportToPDF(Request $request)
    {
        $transactions = $this->service->getAll($request); 
        
        $start_date = FormatDMY($request->start_date);
        $end_date = FormatDMY($request->end_date);
        
        $pdf = Pdf::loadView('dashboard.transaction.pdf', compact('transactions', 'start_date', 'end_date'));
        $pdf->setPaper('A4', 'landscape'); 

        return $pdf->download('Laporan transaksi ' . $start_date . ' sd ' . $end_date . '.pdf');
    }
}
