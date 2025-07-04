@extends('dashboard.partials.main')


@section('title', 'Tambah Produk')

@section('content')
<div class="card-body">
    <div class="row">
        <!-- KIRI: Gambar Produk -->
        <div class="col-md-4 text-center">
            <div class="mt-3">
                <label for="image" class="form-label">Tambah Gambar (bisa lebih dari satu)</label>
                <input type="file" class="form-control" id="image" name="image[]" multiple>
            </div>
            <!-- Preview Area -->
            <div id="preview-images" class="row mt-3 gx-2 gy-2"></div>

        </div>

        <!-- KANAN: Informasi Produk -->
        <div class="col-md-8">
            <form>
                <div class="mb-2">
                    <label class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-2">
                    <label class="form-label fw-bold fs-4">Kategori Produk</label>
                    <select class="form-select fs-4 fw-bold" name="category">
                        <option value="novel" selected>Outer</option>
                        <option value="komik">Shirt</option>
                        <option value="majalah">Workshirt</option>
                        <option value="lainnya">accessories</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold">Harga</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" rows="5"></textarea>
                </div>

                <h5 class="fw-bold mt-4 mb-2">Detail Produk</h5>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Ukuran</label>
                        <select class="form-select" name="size">
                            <option value="S" selected>S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Stok</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label text-muted">Min stock</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
document.getElementById('image').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('preview-images');
    previewContainer.innerHTML = ''; // Kosongkan preview sebelumnya

    const files = event.target.files;

    Array.from(files).forEach(file => {
        if (!file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-4';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-fluid rounded';
            img.style.maxHeight = '150px';
            img.style.objectFit = 'cover';

            col.appendChild(img);
            previewContainer.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
});
</script>

@endpush
