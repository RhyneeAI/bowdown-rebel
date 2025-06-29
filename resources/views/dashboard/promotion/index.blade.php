@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
    Promosi
@endsection

@section('content')
    <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Promosi</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" id="searchBar" class="form-control" placeholder="Cari Promosi...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                            Tambah Promosi
                        </button>
                    </div>
                </div>

                {{-- @include('schedule.modal_add_schedule') --}}
            </div>
            <table id="teacherTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th>Nama Promosi</th>
                        <th>Stok</th>
                        <th>Expired</th>
                        <th>Diskon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <th>BOWDOWNWAW</th>
                        <td>210</td>
                        <td>2023-01-01</td>
                        <td>10%</td>
                        <th>
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            <a href="#" class="btn btn-info btn-sm">Detail</a>
                        </th>
                        
                    </tr>
                    {{-- @foreach($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->address }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
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