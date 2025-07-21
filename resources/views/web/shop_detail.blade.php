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
            <div id="cart-message" style="margin-top:10px;"></div>
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
                            <h3 class="rating" id="rating">⭐ {{ $product->rating }} / 5 </h3>
                            <h4 class="rating" id="reviewers">&nbsp;&nbsp; ({{ $product->reviews->count() }} reviews)</h4>
                            <div class="d-flex justify-content-center align-items-center flex-column gap-2 mt-3">
                                <form id="add-to-cart-form" class="d-flex flex-column align-items-center w-100">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{ $product->slug }}">
                                    <input type="hidden" name="id_varian">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <button id="submitCart" type="submit" class="btn btn-primary btn-outline btn-md">
                                            <i class="fa fa-shopping-cart"></i> Keranjang
                                        </button>
                                        <button type="button" class="btn btn-primary btn-outline btn-md {{ $product->likedProduct ? 'active' : '' }}" id="wishlist" data-slug="{{ $product->slug }}">
                                            <i class="fa fa-heart"></i> Wishlist
                                        </button>
                                    </div>
                                    <div class="quantity-control mt-2 d-flex justify-content-center align-items-center">
                                        <button type="button" class="qty-btn" id="btn-minus">-</button>
                                        <input type="text" name="qty" id="qty-input" class="mx-1" value="1" min="1" style="width: 60px; text-align: center;">
                                        <button type="button" class="qty-btn" id="btn-plus">+</button>
                                    </div>
                                </form>
                            </div>
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
                                        <span id="harga-produk">Rp {{ number_format(optional($product->variants->first())->harga ?? 0, 0, ',', '.') }}</span> 
                                        (<span id="stok-produk" class="{{ optional($product->variants->first())->stok == 0 ? 'text-danger' : '' }}">Stok : {{ optional($product->variants->first())->stok ?? 0 }}</span>)
                                    </h3>

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
                                        <div class="feed" id="feed" style="height: 500px; overflow-y: auto;">
                                        </div>
                                    </div>
                                    <div class="col-md-12 review-form text-center" style="margin-top: -5rem;">
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
                                                        <input type="radio" name="rating" value="5" checked>
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
    <!-- JS -->
    <script>
        $(document).ready(function () {
            const $form = $("#add-to-cart-form");
            const $submitBtn = $("#submitCart");
            const $minusBtn = $('#btn-minus')
            const $plusBtn = $('#btn-plus')
            const $qtyInput = $('#qty-input')

            $minusBtn.on("click", function (e) {
                e.preventDefault();
                let val = parseInt($qtyInput.val()) || 1;
                if (val > 1) {
                    $qtyInput.val(val - 1);
                }
            });

            $plusBtn.on("click", function (e) {
                e.preventDefault();
                let val = parseInt($qtyInput.val()) || 1;
                $qtyInput.val(val + 1);
            });

            // console.log("Qty:", $qtyInput.val());

            $form.on("submit", function (e) {
                e.preventDefault();

                let formData = new FormData($form[0]);

                const url = "{{ $role == 'User' ? route($role.'.cart.add') : '' }}";
                if (!url) {
                    toastr.error('Perlu login terlebih dahulu untuk menambahkan produk Keranjang!');
                    return;
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    processData: false, // Penting untuk FormData
                    contentType: false, // Penting untuk FormData
                    dataType: 'json',
                    success: function (data) {
                        toastr.success(data.success || 'Berhasil menambahkan ke keranjang!');
                    },
                    error: function (xhr, status, error) {
                        toastr.error('Terjadi kesalahan saat menambahkan ke keranjang.');
                        console.error('Error:', error);
                    }
                });
            });
        });
    
        // Toggle wishlist
        $(document).ready(function() {
            function addToWishlist(slug) {
                if (!slug) {
                    toastr.error('Terjadi kesalahan');
                    return;
                }

                const url = "{{ $role == 'User' ? route($role.'.shop.add-to-wishlist') : null }}";

                if (!url) {
                    toastr.error('Perlu login terlebih dahulu untuk menambahkan ke Wishlist!');
                    return;
                }

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

        // Toggle Size
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

                $('input[name="id_varian"]').val(id);
                
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

            $('.size').first().trigger('click');

        });

        // Toggle Review
        $(document).ready(function() {
            function addReview(data) {
                if (!data) {
                    toastr.error('Terjadi kesalahan');
                    return;
                }

                const url = "{{ $role == 'User' ? route($role.'.shop.add-review') : null }}";

                if (!url) {
                    toastr.error('Perlu login terlebih dahulu untuk menambahkan Review produk!');
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let payload = {
                    slug: data.slug, 
                    komentar: data.komentar, 
                    rating: data.rating
                }

                $.post(url, payload)
                    .done(response => {
                        console.log(response);
                        
                        showResponse(response);
                        loadReview();
                        $('#rating').text(`⭐ ${parseFloat(response.data.rating).toFixed(2)} / 5`);
                        $('#reviewers').html(`&nbsp;&nbsp; (${response.data.reviewers} reviews)`);
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

                if(!komentar) {
                    toastr.warning('Isi kolom komentar nya!');
                    return;
                }

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