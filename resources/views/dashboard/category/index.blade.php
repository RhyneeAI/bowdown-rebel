@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
    Daftar Kategori
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            {{-- <h5 class="card-title fw-semibold mb-4">Daftar Kategori</h5> --}}
            <div class="row">
                <div class="col-md-6">
                    {{-- <div class="mb-3">
                        <input type="text" id="searchBar" class="form-control" placeholder="Cari Kategori...">
                    </div> --}}
                </div>
                <div class="col-md-6 mb-4">
                    <div class="mb-3">
                        <a href="{{ route('category.create') }}" class="btn btn-primary float-end">
                            Tambah Kategori
                        </a>
                    </div>
                </div>
            </div>
            <table id="category_table" class="table table-responsive table-striped table-bordered" style="width: 100% !important">
                <thead>
                    <tr>
                        <th width="15%" class="text-center">No</th>
                        <th width="70%" class="text-center">Nama Kategori</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('dashboard.category.modal-image')
@endsection

@push('script')
<script>
    $(document).ready(function() {
        let table = $('#category_table').DataTable({
                        processing: true,
                        serverSide: true,
                        orderable: true,
                        searchable: true,
                        ajax: "{{ route('category.datatable') }}",
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
                            { data: 'nama_kategori', name: 'nama_kategori' },
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
            $('#modal-preview-image').attr('src', imageUrl);
        });
    });
</script>
@endpush