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
        display: none;
    }

    small {
        margin-left: 3rem !important;
    }
</style>

@endpush

@section('title')
    Buat Kategori Baru
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('category.store') }}">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
    
                    <div class="col-md-6 mt-5">
                        <label for="foto" class="form-label">Gambar Kategori</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>
    
                    <div class="col-md-4 mb-3 text-center">
                        <small>Gambar</small>
                        <div class="preview-container">
                            <img id="preview-image" class="preview-image" src="#" alt="Preview" class="img-fluid rounded mt-2">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4 text-end">
                    <a href="{{ route('category.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
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
</script>
@endpush
