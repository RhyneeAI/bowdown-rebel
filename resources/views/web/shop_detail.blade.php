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

        .no-reviews, .error-loading {
            text-align: center;
            padding: 20px;
            color: #666;
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

                                    <input type="hidden" name="id_varian">

                                    <div class="row mx-1">
                                        @foreach ($product->variants as $key => $value)
                                        <span class="size {{ $key === 0 ? 'active' : '' }} {{ $value->stok == 0 ? 'out-of-stock' : '' }}" 
                                                data-harga="{{ $value->harga }}" 
                                                data-stok="{{ $value->stok }}"
                                                data-id="{{ $value->id }}">
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
                                        <h3>Semua Ulasan</h3>
                                        <div class="feed" id="feed">
                                        </div>
                                    </div>
                                    <div class="col-md-12 review-form text-center">
                                        <h4 class="review-title">Berikan Ulasan Anda</h4>
                                        <form id="submit-review" class="review-form-container">
                                            <div class="form-group review-text-group">
                                                <blockquote>
                                                    <textarea name="komentar" class="review-textarea" placeholder="Tulis ulasan..." rows="4" required></textarea>
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

                                            <button type="button" class="btn btn-primary submit-review-btn" id="ulasan" data-slug="{{ $product->slug }}">Kirim</button>
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

                const url = "{{ route('shop.add-to-wishlist') }}";

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
                const id = $(this).data('id');
                const $hargaElement = $('#harga-produk');
                const $stokElement = $('#stok-produk');
                const $idElement = $('input[name="id_varian"]');

                $idElement.val(id);
                
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

        $(document).ready(function() {
            function addReview(data) {
                if (!data) {
                    toastr.error('Terjadi kesalahan');
                    return;
                }

                const url = "{{ route('shop.add-review') }}";

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post(url, { slug: data.slug, komentar: data.komentar, rating: data.rating })
                    .done(response => {
                        showResponse(response);
                        loadReview();
                    })
                    .fail(error => {
                        toastr.error('Gagal terhubung ke server');
                        console.error(error);
                    });
            }

            $('#ulasan').click(function(e) {
                e.preventDefault()

                let slug = $(this).data('slug');
                let komentar = $('textarea[name="komentar"]').val();
                let rating = $('input[name="rating"]:checked').val();

                let data = { slug, komentar, rating }

                addReview(data);
            })

            function loadReview() {
                let url = "{{ route('shop.show-review') }}";
                let slug = "{{ $product->slug }}";

                $.get(url, { slug: slug }) 
                    .done(response => {
                        if(response.status === 'success' && response.data) {
                            $('#feed').empty();
                            
                            $('#feed').hide().fadeIn(300);
                            
                            response.data.forEach((item, index) => {
                                setTimeout(() => {
                                    let stars = Array(parseInt(item.rating)).fill('<i class="icon-star2"></i>').join('');
                                    let userName = item.user?.nama || 'Pengguna';
                                    
                                    let html = `
                                        <div class="feed-item" style="display:none;">
                                            <h3>&mdash; ${userName}</h3>
                                            <span>${new Date(item.created_at).toLocaleDateString()}</span>
                                            <div class="rate">
                                                ${stars}
                                            </div>
                                            <blockquote>
                                                <p>${item.komentar || 'No review text'}</p>
                                            </blockquote>
                                        </div>
                                    `;

                                    $(html).appendTo('#feed').fadeIn(400);
                                    
                                    $('.feed-item:last-child .icon-star2').each(function(i) {
                                        $(this).delay(i * 100).css({opacity:0}).animate({opacity:1}, 200);
                                    });
                                    
                                }, index * 200);
                            });
                            
                            if(response.data.length === 0) {
                                $('#feed').html('<p class="no-reviews">Tidak ada review</p>').fadeIn(300);
                            }
                        } else {
                            $('#feed').html('<p class="no-reviews">Tidak ada review</p>').fadeIn(300);
                        }
                    })
                    .fail(error => {
                        toastr.error('Failed to load reviews');
                        console.error('Review load error:', error);
                        $('#feed').html('<p class="error-loading">Error loading reviews</p>').fadeIn(300);
                    });
            }

            loadReview();
            
            setInterval(() => {
                loadReview();
            }, 20000);
        })
    </script>
@endpush