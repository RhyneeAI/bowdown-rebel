@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
    Daftar Pengguna
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            {{-- <h5 class="card-title fw-semibold mb-4">Daftar Pengguna</h5> --}}
            <div class="row">
                <div class="col-md-6">
                    {{-- <div class="mb-3">
                        <input type="text" id="searchBar" class="form-control" placeholder="Cari Pengguna...">
                    </div> --}}
                </div>
                <div class="col-md-6 mb-4">
                    <div class="mb-3">
                        <a href="{{ route($role.'.user.create') }}" class="btn btn-primary float-end">
                            Tambah Pengguna
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="user_table" class="table table-striped table-bordered" style="width: 100% !important">
                    <thead>
                        <tr>
                            <th width="15%" class="text-center">No</th>
                            <th width="15%" class="text-center">Aksi</th>
                            <th width="70%" class="text-center">Nama Pengguna</th>
                            <th width="70%" class="text-center">NIK</th>
                            <th width="70%" class="text-center">Role</th>
                            <th width="70%" class="text-center">Email</th>
                            <th width="70%" class="text-center">Tanggal Lahir</th>
                            <th width="70%" class="text-center">No Hp</th>
                            <th width="70%" class="text-center">Username</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('dashboard.user.modal-image')
@endsection

@push('script')
<script>
    $(document).ready(function() {
        let table = $('#user_table').DataTable({
                        processing: true,
                        serverSide: true,
                        orderable: true,
                        searchable: true,
                        ajax: "{{ route($role.'.user.datatable') }}",
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
                            { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'},
                            { data: 'nama', name: 'nama' },
                            { data: 'nik', name: 'nik' },
                            { data: 'role', name: 'role' },
                            { data: 'email', name: 'email' },
                            { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                            { data: 'no_hp', name: 'no_hp' },
                            { data: 'username', name: 'username' },
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
            
            if(imageUrl == 'no-image'){
                $('#previewModal .modal-body').html('<p style="text-align: center;">Foto tidak tersedia</p>');
            } else {
                $('#modal-preview-image').attr('src', imageUrl);
            }
        });
    });
</script>
@endpush