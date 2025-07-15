@extends('dashboard.partials.main')

@push('css')
    <!-- Tambahkan custom style jika diperlukan -->
@endpush

@section('title')
Buat Promosi Baru
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <form id="createForm" method="POST" enctype="multipart/form-data"
                action="{{ route('Admin.promotion.update', $promotion->slug) }}">
                @csrf
                @method('PATCH')
                <div class="row">

                    <!-- Kolom Kiri: Upload + Preview -->
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Gambar Promosi</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">Format yang didukung: JPG, PNG, JPEG, WEBP.</small>
                        </div>

                        <div class="text-center mt-3">
                            <img id="preview-image" src="{{ $promotion->foto ? asset('storage/promotions/' . $promotion->foto) : '#' }}" alt="Preview" class="img-fluid rounded border"
                                style="{{ $promotion->foto ? '' : 'display:none' }}; max-height: 300px; object-fit: cover;">
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Detail -->
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label for="nama_promosi" class="form-label">Nama Promosi/Voucher</label>
                            <input type="text" class="form-control" id="nama_promosi" name="nama_promosi" value="{{ $promotion->nama_promosi }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kode_promosi" class="form-label">Kode Promosi/Voucher</label>
                            <input type="text" class="form-control" id="kode_promosi" name="kode_promosi" value="{{ $promotion->kode_promosi }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok / Kuota</label>
                            <input type="number" class="form-control" id="stok" name="stok" value="{{ $promotion->stok }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ $promotion->tanggal_mulai }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                                <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir"
                                    value="{{ $promotion->tanggal_berakhir }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="diskon_harga" class="form-label">Diskon Harga</label>
                            <input type="text" class="form-control" id="diskon_harga" name="diskon_harga" value="{{ FormatRupiah((int) $promotion->diskon_harga) }}" autocomplete="off">

                        </div>

                        <div class="text-end">
                            <a href="{{ route($role.'.promotion.index') }}"
                                class="btn btn-secondary">Kembali</a>
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
document.getElementById('foto').addEventListener('change', function(event) {
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
<script>
        $(document).on('keyup', '#diskon_harga', function () {
            let raw = $(this).val().replace(/\D/g, ''); 
            let limited = raw.substring(0, 8);
            let formatted = FormatRupiah(limited);
            $(this).val(formatted);
        });
</script>
@endpush