@extends('dashboard.partials.main')

@push('css')
<style>
    .btn-purple {
        background-color: #0b23de;
        color: white;
    }

    .btn-purple:hover {
        background-color: #2f4de7;
        color: white;
    }
</style>

@endpush

@section('title')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Produk</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" id="searchBar" class="form-control" placeholder="Cari Produk...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <a href="{{ route('product.create') }}" class="btn btn-primary float-end">
                            Tambah Produk
                        </a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-60">
                        <a href="#" class="text-decoration-none text-dark">
                            <img src="{{ asset('assets/web/images/pict_bowdown/hoodie.png') }}"
                                class="card-img-top" alt="Bumi" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h6 class="fw-bold">P&COF Trucker Jacket</h6>
                                <p class="mb-1 text-primary">Outer</p>
                            </div>
                        </a>
                        <div class="card-footer bg-white border-top-0 text-center">
                            <a href="{{ route('dashboard.product.detail') }}" class="btn btn-sm btn-purple mb-2">Lihat detail</a>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-60">
                        <a href="#" class="text-decoration-none text-dark">
                            <img src="{{ asset('assets/web/images/pict_bowdown/hoodie.png') }}"
                                class="card-img-top" alt="Bulan" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h6 class="fw-bold">Retro Green Helmet</h6>
                                <p class="mb-1 text-primary">Accessories</p>
                            </div>
                        </a>
                        <div class="card-footer bg-white border-top-0 text-center">
                            <a href="{{ route('dashboard.product.detail') }}" class="btn btn-sm btn-purple mb-2">Lihat detail</a>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-60">
                        <a href="#" class="text-decoration-none text-dark">
                            <img src="{{ asset('assets/web/images/pict_bowdown/hoodie.png') }}"
                                class="card-img-top" alt="Matahari" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h6 class="fw-bold">Blue Plain Workshirt</h6>
                                <p class="mb-1 text-primary">Workshirt</p>
                            </div>
                        </a>
                        <div class="card-footer bg-white border-top-0 text-center">
                            <a href="{{ route('dashboard.product.detail') }}" class="btn btn-sm btn-purple mb-2">Lihat detail</a>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-60">
                        <a href="#" class="text-decoration-none text-dark">
                            <img src="{{ asset('assets/web/images/pict_bowdown/hoodie.png') }}"
                                class="card-img-top" alt="Matahari" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h6 class="fw-bold">Blue Plain Workshirt</h6>
                                <p class="mb-1 text-primary">Workshirt</p>
                            </div>
                        </a>
                        <div class="card-footer bg-white border-top-0 text-center">
                            <a href="{{ route('dashboard.product.detail') }}" class="btn btn-sm btn-purple mb-2">Lihat detail</a>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>

    {{-- @push('scripts') --}}
    {{-- <script>
        $(document).ready(function() {
            $('#teacherTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('teachers.data') }}',
    columns: [
    { data: 'name', name: 'name' },
    { data: 'email', name: 'email' },
    { data: 'phone', name: 'phone' },
    { data: 'address', name: 'address' }
    ]
    });
    });
    </script> --}}
</div>
@endsection

@section('modal')

@endsection

@push('script')
@endpush
