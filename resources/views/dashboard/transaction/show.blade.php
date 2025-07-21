@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
    Detil Penjualan {{ $transaction->no_faktur }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <table>
                                <tr>
                                    <td class="pb-2">Pengguna</td>
                                    <td class="pb-2" width="5%" style="text-align: center;">:</td>
                                    <td class="pb-2">{{ $transaction->user->nama }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-2">Tanggal</td>
                                    <td class="pb-2" width="5%" style="text-align: center;">:</td>
                                    <td class="pb-2">{{ date('d-m-Y H:i', strtotime($transaction->created_at)) }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-2">Status</td>
                                    <td class="pb-2" width="5%" style="text-align: center;">:</td>
                                    <td class="pb-2"><span class="badge bg-{{ \App\Enums\StatusCheckout::getBadgeColor($transaction->latestStatus->status) }}">{{ $transaction->latestStatus->status }}</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-2">No Faktur</td>
                                    <td class="pb-2" width="5%" style="text-align: center;">:</td>
                                    <td class="pb-2"><span class="badge bg-info">{{ $transaction->no_faktur }}</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-2">Ekspedisi</td>
                                    <td class="pb-2" width="5%" style="text-align: center;">:</td>
                                    <td class="pb-2">{{ $transaction->expedition->nama_ekspedisi }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-2">No Resi</td>
                                    <td class="pb-2" width="5%" style="text-align: center;">:</td>
                                    <td class="pb-2">{{ $transaction->resi ?? '-' }}</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <table>
                                <tr>
                                    <td class="pb-2">Total Harga</td>
                                    <td class="pb-2" width="5%" style="text-align: center;">:</td>
                                    <td class="pb-2">Rp. {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-2">Total Diskon</td>
                                    <td class="pb-2" width="5%" style="text-align: center;">:</td>
                                    <td class="pb-2">Rp. {{ number_format($transaction->diskon, 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h5>Rincian Produk</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="checkout_details" class="table table-striped table-bordered" style="width: 100% !important">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->checkoutDetail as $value)
                                    @php
                                        $ukuran = $value->variant->ukuran;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->product->nama_produk . " ($ukuran)" }}</td>
                                        <td>{{ number_format($value->qty, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($value->harga_satuan, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($value->harga_subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h5>Riwayat Status</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="status_histories" class="table table-striped table-bordered" style="width: 100% !important">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->checkoutManagement as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->tanggal_status)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        let table = $('#status_histories').DataTable({
            processing: true,
        });

        let table2 = $('#checkout_details').DataTable({
            processing: true,
        });

        table.on('preXhr.dt', function () {
            ShowLoading('Memuat data...');
        });

        table.on('xhr.dt', function () {
            Swal.close();
        });
    });
</script>
@endpush