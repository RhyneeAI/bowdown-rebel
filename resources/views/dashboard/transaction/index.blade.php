@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
    Daftar Penjualan
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            {{-- <h5 class="card-title fw-semibold mb-4">Daftar Penjualan</h5> --}}
            <div class="row">
                <div class="col-md-6">
                    {{-- <div class="mb-3">
                        <input type="text" id="searchBar" class="form-control" placeholder="Cari Penjualan...">
                    </div> --}}
                </div>
                <div class="col-md-6 mb-4">
                    <div class="mb-3">
                        <a href="{{ route($role.'.expedition.create') }}" class="btn btn-primary float-end">
                            Tambah Penjualan
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="transaction_table" class="table table-striped table-bordered" style="width: 100% !important">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>No Faktur</th>
                            <th>Pengguna</th>
                            <th>Ekspedisi</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Dibayar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        let table = $('#transaction_table').DataTable({
            processing: true,
            serverSide: true,
            orderable: true,
            searchable: true,
            ajax: "{{ route($role.'.transaction.datatable') }}",
            columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    class: 'text-center'
                },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false, 
                    class: 'text-center'
                },
                { 
                    data: 'no_faktur', 
                    name: 'no_faktur',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
                },
                { 
                    data: 'nama', 
                    name: 'nama',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
                },
                { 
                    data: 'nama_ekspedisi', 
                    name: 'nama_ekspedisi',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
                },
                { 
                    data: 'total_harga', 
                    name: 'total_harga',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
                },
                { 
                    data: 'diskon', 
                    name: 'diskon',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
                },
                { 
                    data: 'dibayar', 
                    name: 'dibayar',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
                }
            ]
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