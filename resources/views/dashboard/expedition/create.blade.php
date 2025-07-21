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
    Buat Ekspedisi Baru
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route($role.'.expedition.store') }}">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nama_ekspedisi" class="form-label">Nama Ekspedisi</label>
                        <input type="text" class="form-control" id="nama_ekspedisi" name="nama_ekspedisi" placeholder="Contoh: JNE" value="{{ old('nama_ekspedisi') }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="biaya" class="form-label">Biaya Ekspedisi</label>
                        <input type="text" class="form-control" id="biaya" name="biaya" placeholder="Contoh: 10.000" value="{{ old('biaya') }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="link_ekspedisi" class="form-label">Link Ekspedisi</label>
                        <input type="text" class="form-control" id="link_ekspedisi" name="link_ekspedisi" placeholder="Contoh: https://jne.co.id" value="{{ old('link_ekspedisi') }}" required>
                    </div>
                </div>

                <div class="col-md-12 mt-4 text-end">
                    <a href="{{ route($role.'.expedition.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('assets/js/format-rupiah.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on('keyup', '#biaya', function(){
            formatRupiah($(this));
        })
    });
</script>
@endpush
