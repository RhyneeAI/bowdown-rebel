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
                            <th>Status</th>
                            <th>No Faktur</th>
                            <th nowrap>No Resi</th>
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



<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditLabel">Input Resi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="receipt" class="form-label">Nomor Resi</label>
                        <input type="text" class="form-control" id="receipt" name="receipt" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
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
                    data: 'status_terbaru', 
                    name: 'status_terbaru',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
                },
                { 
                    data: 'no_faktur', 
                    name: 'no_faktur',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
                },
                { 
                    data: 'resi', 
                    name: 'resi',
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

        $(document).on('click', '.btn-receipt-update', function() {
            let id = $(this).data('id');
            
            $('#modalEdit').find('form').attr('action', "{{ route($role.'.transaction.receipt-update', ':id') }}".replace(':id', id));
        });
    });
</script>
@endpush