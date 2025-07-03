@extends('dashboard.partials.main')


@push('css')
<!-- Custom style jika diperlukan -->
@endpush

@section('title')
    Edit Kategori
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form id="createForm" method="POST" enctype="multipart/form-data" action="">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="category_name" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required>
                </div>

                <div class="mb-3">
                    <label for="category_image" class="form-label">Gambar Kategori</label>
                    <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*">
                </div>

                <div class="mb-3 text-center" id="preview-container" style="display: none;">
                    <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded mt-2" style="max-height: 300px; object-fit: cover;">
                </div>

                <div class="text-end">
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.getElementById('category_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewImage = document.getElementById('preview-image');
    const previewContainer = document.getElementById('preview-container');

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
});
</script>
@endpush
