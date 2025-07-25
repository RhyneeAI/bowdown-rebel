<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        .filter-info { margin-bottom: 20px; }
        .text-center { text-align: 'center'; }
        .status-selesai { background-color: #d4edda; } 
        .status-dibatalkan { background-color: #f8d7da; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi Penjualan</h2>
    <div class="filter-info">
        <p>Periode: {{ \Carbon\Carbon::parse($start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d M Y') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Faktur</th>
                <th>Status</th>
                <th>No Resi</th>
                <th>Pembeli</th>
                <th>Ekspedisi</th>
                <th>Total Harga</th>
                <th>Diskon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $transaction)
                <tr class="{{ $transaction->latestStatus->status == 'Selesai' ? 'status-selesai' : ($transaction->latestStatus->status == 'Dibatalkan' ? 'status-dibatalkan' : '') }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}</td>
                    <td>{{ $transaction->no_faktur }}</td>
                    <td>{{ $transaction->latestStatus->status }}</td>
                    <td>{{ $transaction->resi }}</td>
                    <td>{{ $transaction->user->nama }}</td>
                    <td>{{ $transaction->expedition->nama_ekspedisi }}</td>
                    <td>{{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                    <td>{{ number_format($transaction->diskon, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>