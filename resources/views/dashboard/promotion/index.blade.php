@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
    Daftar Promosi
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            {{-- <h5 class="card-title fw-semibold mb-4">Daftar Kategori</h5> --}}
            <div class="row">
                <div class="col-md-6">
                    {{-- <div class="mb-3">
                        <input type="text" id="searchBar" class="form-control" placeholder="Cari Promosi...">
                    </div> --}}
                </div> 
                <div class="col-md-6 mb-4">
                    <div class="mb-3">
                        <a href="{{ route($role.'.promotion.create') }}" class="btn btn-primary float-end">
                            Tambah Promosi
                        </a>
                    </div>
                </div>
            </div>
            <table id="promotion_table" class="table table-responsive table-striped table-bordered" style="width: 100% !important">
                <thead>
                    <tr>
                        <th width="3%" class="text-center">No</th>
                        <th width="10%" class="text-center">Nama promosi</th>
                        <th width="10%" class="text-center">Kode Promosi</th>
                        <th width="10%" class="text-center">Stok</th>
                        <th width="17%" class="text-center">Tanggal Mulai</th>
                        <th width="18%" class="text-center">Tanggal Berakhir</th>
                        <th width="15%" class="text-center">Diskon</th>
                        <th width="32%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('dashboard.promotion.modal-image-promotion')
@endsection

@push('script')
<script>
    $(document).ready(function() {
        let table = $('#promotion_table').DataTable({
                        processing: true,
                        serverSide: true,
                        orderable: true,
                        searchable: true,
                        ajax: "{{ route($role.'.promotion.datatable') }}",
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
                            { data: 'nama_promosi', name: 'nama_promosi' },
                            { data: 'kode_promosi', name: 'kode_promosi', class: 'text-center' },
                            { data: 'stok', name: 'stok', class: 'text-center' },
                            { data: 'tanggal_mulai', name: 'tanggal_mulai', class: 'text-center' },
                            { data: 'tanggal_berakhir', name: 'tanggal_berakhir', class: 'text-center' },
                            { data: 'diskon_harga', name: 'diskon_harga', class: 'text-center' },
                            { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'}
                        ]
                    });

        table.on('preXhr.dt', function () {
            ShowLoading('Memuat data...');
        });

        table.on('xhr.dt', function () {
            Swal.close();
        });

        $(document).on('click', '.delete-btn', function () {
            const route = $(this).data('route');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route, 
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            toastr.success(response.message, 'Berhasil!');
                            table.ajax.reload();
                        },
                        error: function (xhr) {
                            toastr.error(xhr.responseJSON?.message, 'Kesalahan!');
                        }
                    });
                }
            });
        });

        $(document).on('click', '.preview-btn', function () {
            const imageUrl = $(this).data('image');
            $('#modal-preview-image-promotion').attr('src', imageUrl);
        });
    });
</script>
@endpush