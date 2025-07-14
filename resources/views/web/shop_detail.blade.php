@extends('web.partials.main')

@push('css')
    <style>
        .owl-carousel.product-carousel {
            width: 100%;
            max-width: 450px;
            height: 450px;
            margin: 0 auto;
        }

        .owl-carousel .item {
            padding: 0 15px; 
        }

        @media (max-width: 768px) {
            .owl-carousel.product-carousel {
                max-width: 100%;
                padding: 0 20px;
            }
        }

        .rating {
            margin-top: -0.75rem !important;
            margin-left: -1.5rem !important;
            font-weight: bold;
        }

        .review-form {
            margin-bottom: -12rem;
        }
    </style>
@endpush

@section('content')
    <div id="fh5co-product">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5 animate-box d-flex flex-column align-items-center">
                    <div class="owl-carousel owl-carousel-fullwidth product-carousel owl-theme">
                        @foreach ($product->photos as $key => $value)
                            <div class="item">
                                <div class="active text-center">
                                    <figure>
                                        <img src="{{ GetFile('products', $value->nama_hash) }}" alt="user" height="400" width="auto" style="border-radius: 20px;">
                                    </figure>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row animate-box w-100 mt-5">
                        <div class="col-12 text-center fh5co-heading">
                            {{-- <h2>{{ $product->nama_produk }}</h2> --}}
                            <h3 class="rating">⭐ {{ $product->rating }} / 5 </h3>
                            <p>
                                <button class="btn btn-primary btn-outline btn-md">
                                    <i class="fa fa-shopping-cart"></i> Keranjang
                                </button>
                                <button class="btn btn-primary btn-outline btn-md {{ $product->likedProduct ? 'active' : '' }}" id="wishlist" data-slug="{{ $product->slug }}">
                                    <i class="fa fa-heart"></i> Wishlist
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="fh5co-tabs animate-box">
                        <ul class="fh5co-tab-nav">
                            <li class="active">
                                <a href="#" data-tab="1">
                                    <span class="icon visible-xs">
                                        <i class="icon-file"></i>
                                    </span>
                                    <span class="hidden-xs">Detail Produk</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-tab="2">
                                    <span class="icon visible-xs">
                                        <i class="icon-star"></i>
                                    </span>
                                    <span class="hidden-xs">Ulasan</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tabs -->
                        <div class="fh5co-tab-content-wrap">
                            <div class="fh5co-tab-content tab-content active" data-tab-content="1">
                                <div class="col-md-12" style="margin-top: -8rem;">
                                    <h1 id="nama-produk">{{ $product->nama_produk }}</h1>
                                    <h3 class="price">
                                        <span id="harga-produk">Rp {{ number_format($product->variants->first()->harga, 0, ',', '.') }}</span> 
                                        (<span id="stok-produk" class="{{ $product->variants->first()->stok == 0 ? 'text-danger' : '' }}">Stok : {{ $product->variants->first()->stok }}</span>)
                                    </h3>

                                    <div class="row mx-1">
                                        @foreach ($product->variants as $key => $value)
                                        <span class="size {{ $key === 0 ? 'active' : '' }} {{ $value->stok == 0 ? 'out-of-stock' : '' }}" 
                                                data-harga="{{ $value->harga }}" 
                                                data-stok="{{ $value->stok }}">
                                            {{ $value->ukuran }}
                                        </span>
                                        @endforeach
                                    </div>

                                    <h2 class="mt-5">Deskripsi Produk</h2> 
                                    {!! $product->deskripsi !!} 
                                </div>
                            </div>

                            <div class="fh5co-tab-content tab-content" data-tab-content="2">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -8rem;">
                                        <h3>Happy Buyers</h3>
                                        <div class="feed">
                                            <div>
                                                <blockquote>
                                                    <p>Paragraph placeat quis fugiat provident veritatis quia iure a
                                                        debitis adipisci dignissimos consectetur magni quas eius nobis
                                                        reprehenderit soluta eligendi quo reiciendis fugit? Veritatis
                                                        tenetur odio delectus quibusdam officiis est.</p>
                                                </blockquote>
                                                <h3>&mdash; Louie Knight</h3>
                                                <span class="rate">
                                                    <i class="icon-star2"></i>
                                                    <i class="icon-star2"></i>
                                                    <i class="icon-star2"></i>
                                                    <i class="icon-star2"></i>
                                                    <i class="icon-star2"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <blockquote>
                                                    <p>Paragraph placeat quis fugiat provident veritatis quia iure a
                                                        debitis adipisci dignissimos consectetur magni quas eius nobis
                                                        reprehenderit soluta eligendi quo reiciendis fugit? Veritatis
                                                        tenetur odio delectus quibusdam officiis est.</p>
                                                </blockquote>
                                                <h3>&mdash; Joefrey Gwapo</h3>
                                                <span class="rate">
                                                    <i class="icon-star2"></i>
                                                    <i class="icon-star2"></i>
                                                    <i class="icon-star2"></i>
                                                    <i class="icon-star2"></i>
                                                    <i class="icon-star2"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 review-form text-center" >
                                        <h4 class="review-title">Berikan Ulasan Anda</h4>
                                        <form id="submit-review" class="review-form-container">
                                            <div class="form-group review-text-group">
                                                <blockquote>
                                                    <textarea name="review_text" class="review-textarea" placeholder="Tulis ulasan..." rows="4" required></textarea>
                                                </blockquote>
                                            </div>
                                            
                                            <div class="form-group rating-group">
                                                <label class="rating-label">Rating Anda</label><br>
                                                <div class="rating-options">
                                                    <label class="rating-option">
                                                        <input type="radio" name="rating" value="1">
                                                        <span class="rate">
                                                            <i class="icon-star2"></i>
                                                        </span>
                                                    </label>
                                                    <label class="rating-option">
                                                        <input type="radio" name="rating" value="2">
                                                        <span class="rate">
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                        </span>
                                                    </label>
                                                    <label class="rating-option">
                                                        <input type="radio" name="rating" value="3">
                                                        <span class="rate">
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                        </span>
                                                    </label>
                                                    <label class="rating-option">
                                                        <input type="radio" name="rating" value="4">
                                                        <span class="rate">
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                        </span>
                                                    </label>
                                                    <label class="rating-option">
                                                        <input type="radio" name="rating" value="5">
                                                        <span class="rate">
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                            <i class="icon-star2"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary submit-review-btn">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function addToWishlist(slug) {
                if (!slug) {
                    toastr.error('Terjadi kesalahan');
                    return;
                }

                const url = '{{ route('shop.add-to-wishlist') }}';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post(url, { slug })
                    .done(response => {
                        if (response.success) {
                            toastr.success(response.success);
                        } else if (response.warning) {
                            toastr.warning(response.warning);
                        } else if (response.error) {
                            toastr.error(response.error);
                        } else {
                            toastr.error('!!!', 'Terjadi kesalahan tak terduga.');
                        }
                    })
                    .fail(error => {
                        toastr.error('Gagal terhubung ke server');
                        console.error(error);
                    });
            }

            $('#wishlist').click(function(e) {
                e.preventDefault()

                let slug = $(this).data('slug');
                addToWishlist(slug);
            })
        })

        $(document).ready(function() {
            $('.size:first').addClass('active');

            $('.size').click(function() {
                if($(this).hasClass('out-of-stock')); 
                
                // Animasi tombol active
                $('.size').removeClass('active');
                $(this).addClass('active').css({
                    'transform': 'scale(1.05)',
                    'transition': 'all 0.3s ease'
                }).delay(300).queue(function() {
                    $(this).css('transform', 'scale(1)').dequeue();
                });
                
                const harga = $(this).data('harga');
                const stok = $(this).data('stok');
                const $hargaElement = $('#harga-produk');
                const $stokElement = $('#stok-produk');
                
                $hargaElement.fadeOut(200, function() {
                    $(this).text('Rp ' + toRupiahFormat(harga)).fadeIn(200);
                });
                
                $stokElement.fadeOut(200, function() {
                    $(this).text(`Stok : ${stok}`);
                    if(stok == 0) {
                        $(this).addClass('text-danger');
                    } else {
                        $(this).removeClass('text-danger');
                    }
                    $(this).fadeIn(200);
                });
            });
        });
    </script>
@endpush