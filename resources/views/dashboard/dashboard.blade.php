@extends('dashboard.partials.main')

@push('css')
    <style>
        .dashboard-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
        }

        .dashboard-card .card-body {
            padding: 1.5rem;
        }

        .dashboard-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .dashboard-value {
            font-size: 1.5rem;
            color: #0d6efd;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .dashboard-desc {
            color: #6c757d;
            font-size: 0.95rem;
        }

    </style>
@endpush

@section('dashboard')
<div class="row g-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="dashboard-title">Pengguna</div>
                <div class="dashboard-value">{{ $userCount }}</div>
                <div class="dashboard-desc">Jumlah akun yang terdaftar</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="dashboard-title">Jumlah Produk</div>
                <div class="dashboard-value">{{ $productCount }}</div>
                <div class="dashboard-desc">Jumlah produk yang terdaftar</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="dashboard-title">Order masuk</div>
                <div class="dashboard-value">{{ $orderCount }}</div>
                <div class="dashboard-desc">Jumlah order yang masuk</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="dashboard-title">Pendapatan</div>
                <div class="dashboard-value">
                    Rp.
                    {{ number_format($totalRevenue, 0, ',', '.') }}
                   
                </div>
                <div class="dashboard-desc">Seluruh pendapatan produk</div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                    Traffic Overview
                    <span>
                        <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                            data-bs-title="Traffic Overview"></iconify-icon>
                    </span>
                </h5>
                <div id="traffic-overview">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const monthlyRevenue = @json($monthlyRevenue);
</script>

@endpush
