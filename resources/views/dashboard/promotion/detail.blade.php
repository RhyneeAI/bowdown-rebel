@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
Promosi Detail
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Gambar di kiri -->
                <div class="col-md-5">
                    <div class="mb-3 text-center">
                        <img src="{{ asset('assets/web/images/news.png') }}"
                            alt="Gambar Promosi" class="img-fluid rounded">
                    </div>
                </div>
                <!-- Detail di kanan -->
                <div class="col-md-7">
                    <div class="mb-3">
                        <h5 class="card-title">Nama Promosi</h5>
                        <p><strong>Kode Promosi:</strong> BOWDOWNWAW</p>
                        <p><strong>Stok:</strong> 210</p>
                        <p><strong>Expired:</strong> 2023-01-01</p>
                        <p><strong>Jenis Promosi:</strong> Diskon Persen</p>
                        <p><strong>Diskon:</strong> 10%</p>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary float-end" onclick="window.history.back()">
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('modal')

@endsection

@push('script')
@endpush
