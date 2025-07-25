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
           <div class="row align-items-center my-4">
                <div class="col-md-6 d-flex align-items-center gap-3">
                    <h4 class="mb-0">Filter</h4>
                    <input type="text" name="start_date" id="start_date" class="form-control" readonly>
                    <input type="text" name="end_date" id="end_date" class="form-control" readonly>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a class="btn btn-danger" id="export-to-pdf">Export PDF</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="transaction_table" class="table table-striped table-bordered" style="width: 100% !important">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Tanggal</th>
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
        const firstDayOfMonth = new Date();
        firstDayOfMonth.setDate(1);
        const today = new Date();

        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            altFormat: "j M Y",
            altInput: true,
            maxDate: "today",
            defaultDate: firstDayOfMonth.toISOString().split('T')[0] 
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            altFormat: "j M Y",
            altInput: true,
            maxDate: "today",
            defaultDate: today.toISOString().split('T')[0] 
        });

        let table = $('#transaction_table').DataTable({
            processing: true,
            serverSide: true,
            orderable: true,
            searchable: true,
            ajax: {
                url: "{{ route($role.'.transaction.datatable') }}",
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
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
                    data: 'created_at', 
                    name: 'created_at',
                    render: function(data, type, row) {
                        return '<span style="white-space: nowrap;">' + data + '</span>';
                    }
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

        $('#start_date, #end_date').on('change', function() {
            table.draw();
        });

        table.on('preXhr.dt', function () {
            ShowLoading('Memuat data...');
        });

        table.on('xhr.dt', function () {
            Swal.close();
        });

        $('#export-to-pdf').on('click', function(e) {
            e.preventDefault();
            const start_date = $('#start_date').val();
            const end_date = $('#end_date').val();
            window.location.href = "{{ route($role.'.transaction.export-to-pdf') }}?start_date=" + start_date + "&end_date=" + end_date;
        });

        $(document).on('click', '.btn-receipt-update', function() {
            let id = $(this).data('id');
            
            $('#modalEdit').find('form').attr('action', "{{ route($role.'.transaction.receipt-update', ':id') }}".replace(':id', id));
        });
    });
</script>
@endpush