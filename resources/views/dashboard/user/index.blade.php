@extends('dashboard.partials.main')

@push('css')
@endpush

@section('title')
    User Dashboard
@endsection

@section('content')
    <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar User</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" id="searchBar" class="form-control" placeholder="Cari User...">
                    </div>
                </div>
                {{-- @include('schedule.modal_add_schedule') --}}
            </div>
            <table id="teacherTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No hp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <th>Jajang gunawan</th>
                        <td>jajang@example.com</td>
                        <td>Jl. Contoh Alamat No. 1</td>
                        <td>08123456789</td>
                        <th>
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
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