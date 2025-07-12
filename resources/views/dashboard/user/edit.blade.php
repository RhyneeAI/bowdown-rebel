@extends('dashboard.partials.main')


@push('css')
<style>
    .preview-container {
        display: none;
        width: 21rem;
        height: 14rem;
        margin: auto;
        border: 1px dashed #999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        overflow: hidden; /* supaya gambar nggak keluar dari lingkaran */
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    small {
        margin-left: 3rem !important;
    }
</style>
@endpush

@section('title')
    Edit Pengguna
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body">
            <form id="createForm" method="POST" enctype="multipart/form-data" action="{{ route($role.'.user.update', $user->id) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Pengguna *</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">NIK *</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $user->nik) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="id_role" class="form-label">Role *</label>
                        <select class="form-select" id="id_role" name="id_role">
                            <option disabled selected>Pilih</option>
                            @foreach ($roles as $rowRole)
                                <option value="{{ $rowRole->id }}" {{ old('id_role', $user->id_role) == $rowRole->id ? 'selected' : '' }}>{{ $rowRole->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username *</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="password" class="form-label">Password Baru (Opsional)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="no_hp" class="form-label">No HP (Opsional)</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat (Opsional)</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $user->address ? $user->address->alamat : '-') }}</textarea>
                    </div>
                    <div class="col-md-6 mt-5">
                        <label for="foto" class="form-label">Foto (Opsional)</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>
    
                    <div class="col-md-6 mb-3 text-center">
                        <small>Pratinjau Foto</small>
                        <div class="preview-container">
                            <img id="preview-image"
                                src="{{ $user->foto ? asset('storage/categories/' . $user->foto) : '#' }}"
                                alt="Preview"
                                class="img-fluid rounded mt-2 preview-image"
                                style="{{ $user->foto ? '' : 'display:none' }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4 text-end">
                    <a href="{{ route($role.'.user.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).ready(function () {
    $('#foto').on('change', function(event) {
        const file = event.target.files[0];
        const $previewImage = $('#preview-image');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $previewImage.attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            $previewImage.hide();
        }
    });
});
</script>
@endpush

