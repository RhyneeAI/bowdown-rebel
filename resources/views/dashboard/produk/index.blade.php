@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
    Produk
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
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                            Tambah Produk
                        </button>
                    </div>
                </div>

                {{-- @include('schedule.modal_add_schedule') --}}
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