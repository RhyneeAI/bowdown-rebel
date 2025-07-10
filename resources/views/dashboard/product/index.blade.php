@extends('dashboard.partials.main')

@push('css')
<style>
    img {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    img:hover {
        transform: scale(1.035);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .carousel-arrows {
        color: rgb(255, 255, 255); 
        font-size: 48px; 
        font-weight: 800;
        background-color: rgb(0, 0, 0);
        opacity: 0.35;
        max-height: 90%;
    }
</style>

@endpush

@section('title')
Daftar Produk
@endsection

@section('content')
<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-body">
            {{-- <h5 class="card-title fw-semibold mb-4">Daftar Produk</h5> --}}
            <div class="row">
                <div class="col-md-6 d-flex">
                    {{-- <div class="mb-3"> --}}
                        {{-- <input type="text" id="searchBar" class="form-control" placeholder="Cari product..."> --}}
                    {{-- </div> --}}
                    <div class="col-md-4 mx-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select class="form-control" name="id_kategori" id="id_kategori">
                            <option value="">Semua</option>
                            @foreach ($categories as $item) 
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mx-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Semua</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="col-md-2 mt-4">
                        <button class="btn btn-warning" id="btn-filter" onclick="loadCard()">Filter</button>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="mb-4">
                        <a href="{{ route($role.'.product.create') }}" class="btn btn-primary float-end">
                            Tambah Produk
                        </a>
                    </div>
                </div>

                <div class=" mt-5" id="product-cards"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('dashboard.product.modal-image')
@endsection

@push('script')
<script>
    async function loadCard() {
        let url = "{{ route($role.'.product.list') }}";
        let sortData = {
            id_kategori: $('#id_kategori').val(), 
            status: $('#status').val()
        };

        ShowLoading('Memuat Produk...');

        try {
            const res = await $.get(url, sortData);
            $('#product-cards').html(res.cards);

            Swal.close();
        } catch (error) {
            console.error("Gagal memuat data produk:", error);
            Swal.fire('Gagal', 'Gagal memuat produk', 'error');
        }
    }
    loadCard();

    $(document).ready(function() {
        $(document).on('click', '.btn-preview', function () {
            const photos = $(this).data('photos'); 
            const $carouselInner = $('#carousel-inner-preview');
            $carouselInner.empty();

            if (Array.isArray(photos) && photos.length > 0) {
                photos.forEach((url, index) => {
                    const item = `<div class="carousel-item ${index === 0 ? 'active' : ''}">
                                    <div class="d-flex align-middle" style="height: 500px;">
                                        <img src="${url}" class="img-fluid rounded" style="max-height: 90%; max-width: 100%; object-fit: contain;">
                                    </div>
                                 </div>`;

                    $carouselInner.append(item);
                });

                const carousel = bootstrap.Carousel.getInstance(document.getElementById('previewCarousel'));
                if (carousel) {
                    carousel.to(0);
                }
            }
        });

        $(document).on('click', '.btn-delete', function () {
            const route = $(this).data('route');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route, 
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            toastr.success(response.message, 'Berhasil!');
                            loadCard();
                        },
                        error: function (xhr) {
                            toastr.error(xhr.responseJSON?.message, 'Kesalahan!');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush