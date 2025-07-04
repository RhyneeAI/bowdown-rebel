@extends('dashboard.partials.main')

@push('css')
<!-- Tambahkan custom style jika diperlukan -->
@endpush

@section('title')
    Edit Promosi
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form edit Promosi</h5>
        </div>
        <div class="card-body">
            <form id="promotionForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <!-- Preview Gambar -->
                    <div class="col-md-5 text-center">
                        <label for="image" class="form-label">Preview Banner</label>
                        <div class="border rounded p-2 mb-3">
                            <img id="preview-image" src="#" alt="Preview Banner" class="img-fluid rounded" style="max-height: 300px; object-fit: cover; display: none;">
                        </div>
                        <input type="file" class="form-control" id="image" name="image"
                            accept="image/png, image/jpeg, image/jpg, image/webp" required>
                        <small class="form-text text-muted">Hanya file PNG, JPG, JPEG, dan WEBP yang diizinkan.</small>
                    </div>

                    <!-- Input Detail -->
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label for="promotion_kode" class="form-label">Kode Promosi/Voucher</label>
                            <input type="text" class="form-control" id="promotion_kode" name="promotion_kode" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok / Kuota</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>

                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Tanggal Berakhir</label>
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="promotion_type" class="form-label">Jenis Promosi</label>
                            <select class="form-select" name="promotion_type" id="promotion_type" required>
                                <option value="percent">Diskon Persen</option>
                                <option value="price">Diskon Harga</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="percent_discount" class="form-label">Diskon dalam %</label>
                            <input type="number" class="form-control" id="percent_discount" name="percent_discount" placeholder="Contoh: 10">
                        </div>

                        <div class="mb-3">
                            <label for="price_discount" class="form-label">Diskon dalam pengurangan harga</label>
                            <input type="number" class="form-control" id="price_discount" name="price_discount" placeholder="Contoh: 50000">
                        </div>

                        <div class="text-end">
                            <a href="{{ route('promotion.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewImage = document.getElementById('preview-image');

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        previewImage.style.display = 'none';
    }
});
</script>
@endpush
