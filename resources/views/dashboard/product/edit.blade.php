@extends('dashboard.partials.main')


@section('title', 'Detail Produk')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- KIRI: Gambar Produk -->
                <div class="col-md-4 text-center">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/web/images/pict_bowdown/hoodie.png') }}"
                                    class="d-block w-100 img-fluid rounded" style="max-height: 450px; object-fit: cover;"
                                    alt="Image 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/web/images/pict_bowdown/outer.png') }}"
                                    class="d-block w-100 img-fluid rounded" style="max-height: 450px; object-fit: cover;"
                                    alt="Image 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/web/images/pict_bowdown/baklava.png') }}"
                                    class="d-block w-100 img-fluid rounded" style="max-height: 450px; object-fit: cover;"
                                    alt="Image 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <div class="mt-3">
                        <label for="image" class="form-label">Ganti Gambar (bisa lebih dari satu)</label>
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
                            <input type="text" class="form-control" value="Workshirt blue well">
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
                            <input type="text" class="form-control" value="65000">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" rows="5">
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
                                <input type="text" class="form-control" value="9786239726263">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-label text-muted">Min stock</label>
                                <input type="text" class="form-control" value="Indonesia">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="#" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
