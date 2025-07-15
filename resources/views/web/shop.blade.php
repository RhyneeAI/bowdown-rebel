@extends('web.partials.main')

@push('css')
    <style>
        @media screen and (max-width: 768px) {
            .sidebar-box {
                margin-bottom: 30px !important;
            }
        }

        .product-grid {
            height: 350px !important;
            background-size: cover !important;
            background-position: center center !important;
            position: relative !important;
        }
        .search-btn, .apply-btn {
            height: 4rem; 
            padding-top: 8px; 
            padding-bottom: 8px; 
            background-color: #222;
        }
        .search-btn:hover, .apply-btn:hover  {
            background-color: #444 !important;
            transition: background 0.2s;
        }

        .search-btn:hover .icon-search {
            color: #ffd700 !important;
            transition: color 0.2s;
        }

        .price-input-container {
            width: 100%;
        }

        .price-input .price-field {
            display: flex;
            margin-bottom: 22px;
        }

        .price-field span {
            margin-right: 10px;
            margin-top: 6px;
            font-size: 17px;
        }

        .price-field input {
            flex: 1;
            height: 4rem;
            font-size: 15px;
            font-family: "DM Sans", sans-serif;
            border-radius: 9px;
            text-align: center;
            border: 0px;
            background: #e4e4e4;
        }

        .price-input {
            width: 100%;
            font-size: 19px;
            color: #555;
        }

        .price-field input {
            width: 100% !important;
        }

        /* Remove Arrows/Spinners */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .slider {
            width: 100%;
        }

        .slider {
            height: 6px;
            position: relative;
            background: #e4e4e4;
            border-radius: 5px;
        }

        .slider .price-slider {
            height: 100%;
            left: 0%;
            right: 0%;
            position: absolute;
            border-radius: 5px;
            background: #01940b;
        }

        .range-input {
            position: relative;
        }

        .range-input input {
            position: absolute;
            width: 100%;
            height: 5px;
            background: none;
            top: -5px;
            pointer-events: none;
            cursor: pointer;
            -webkit-appearance: none;
        }

        /* Styles for the range thumb in WebKit browsers */
        input[type="range"]::-webkit-slider-thumb {
            height: 2rem;
            width: 2rem;
            border-radius: 70%;
            background: #555;
            pointer-events: auto;
            -webkit-appearance: none;
        }

        input[type="checkbox"] {
            transform: scale(1.5);
            margin-right: 8px;
        }

        .checkbox label {
            display: flex;
            align-items: center;
            margin-left: 0.5rem !important;
            font-size: 16px;
            padding-bottom: 0.75rem;
            margin-top: -1.5rem;
        }

        .min-input:hover, .max-input:hover {
            cursor: cell;
        }

        .rating {
            color: white;
            font-size: 2.2rem;
            font-weight: bold;
        }

        li a.active {
            background-color: #222; border-color: #222; color: #fff;
        }
        li a.unactive {
            background-color: #ffffff; border-color: #222; color: #222;
        }
    </style>
@endpush

@section('content')
    <aside id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(assets/web/images/news.png);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>Product</h1>
                            <h2>Find Your Ride Style</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <div id="fh5co-product">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-sm-1"
                    style="border: 1px solid rgb(182, 181, 181); box-sizing: border-box; padding: 15px;">
                    <div class="sidebar-box p-2 mb-3">
                        <!-- Cari Produk -->
                        <h4>Pencarian</h4>
                        <div class="input-group pb-3">
                            <input type="text" class="form-control" name="search" placeholder="Cari Produk..." style="height: 4rem;">
                            <span class="input-group-btn" style="height: 40px;">
                                <button class="btn btn-default search-btn" id="search-btn" type="button">
                                    <i class="icon-search" style="color: #fff;"></i>
                                </button>
                            </span>
                        </div>

                        <!-- Filter Harga -->
                        <h4 class="mt-3">Filter Harga</h4>
                        <div class="price-input-container">
                            <div class="price-input">
                                <div class="price-field">
                                    <input type="text" name="min_input" class="min-input mr-3" value="Rp.0" readonly>
                                    <input type="text" name="max_input" class="max-input" value="Rp.5.000.000" readonly>
                                </div>
                            </div>
                            <div class="slider">
                                <div class="price-slider"></div>
                            </div>
                        </div>

                        <div class="range-input">
                            <input type="range" class="min-range" min="0" max="5000000" step="500" value="0">
                            <input type="range" class="max-range" min="0" max="5000000" step="500" value="5000000">
                        </div>

                        <!-- Filter Ukuran -->
                        <h4 class="mt-5">Filter Ukuran</h4>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="checkbox"><label><input type="checkbox" name="size[]" value="S"> S</label></div>
                                <div class="checkbox"><label><input type="checkbox" name="size[]" value="M"> M</label></div>
                            </div>
                            <div class="col-xs-3">
                                <div class="checkbox"><label><input type="checkbox" name="size[]" value="L"> L</label></div>
                                <div class="checkbox"><label><input type="checkbox" name="size[]" value="XL"> XL</label></div>
                            </div>
                            <div class="col-xs-5">
                                <div class="checkbox"><label><input type="checkbox" name="size[]" value="XXL"> XXL</label></div>
                                <div class="checkbox"><label><input type="checkbox" name="size[]" value="Pcs"> Lain-Lain</label></div>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <h4 class="mt-4 mb-3">Kategori</h4>
                        <div class="d-flex w-100 mt-2 mb-1">
                            <select class="custom-select me-2" name="category">
                                <option value="All" selected>Semua</option>
                                @foreach ($categories as $key => $value)
                                    <option value="{{ $value->id }}">{{ ucfirst($value->nama_kategori) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Terapkan -->
                        <button class="btn btn-default search-btn mt-4 w-100" id="apply-btn" type="button">
                            <span style="color: #fff;">Terapkan</span>
                        </button>

                    </div>
                </div>


                <!-- Product Grid -->
                <div class="col-md-9 col-sm-12">
                    <div class="ml-3 mr-3">
                        <div class="row mb-2">
                            <div class="col-sm-6 col-xs-12">
                                <p>Menampilkan <span id="start">1</span> - <span id="end">10</span> dari <span id="total">100</span> Hasil</p>
                            </div>
                            <div class="col-sm-6 col-xs-12 text-right">
                                <select class="custom-select d-inline-block" name="sort_by" id="sort-by" style="width: auto;">
                                    <option value="Popular">Populer</option>
                                    <option value="Newest">Terbaru</option>
                                    <option value="Oldest">Terlama</option>
                                    <option value="Low Price">Harga Terendah</option>
                                    <option value="High Price">Harga Tertinggi</option>
                                </select>
                            </div>
                        </div>
    
                        <div id="list-products-container"></div>
    
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <ul class="pagination" style="--bs-pagination-active-bg: #222; --bs-pagination-active-border-color: #222;">
                                   
                                </ul>
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
        $(document).ready(function () {
            const priceGap = 500;
            const $minRange = $(".min-range");
            const $maxRange = $(".max-range");
            const $minInput = $(".min-input");
            const $maxInput = $(".max-input");
            const $priceSlider = $(".price-slider");

            function updateSliderUI(min, max) {
                const maxVal = parseInt($maxRange.attr("max"));
                $priceSlider.css({
                    "left": `${(min / maxVal) * 100}%`,
                    "right": `${100 - (max / maxVal) * 100}%`
                });
            }

            function toRupiah(val) {
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function clampValues(min, max) {
                min = Math.max(0, min);
                max = Math.min(10000, max);

                if (min > max - priceGap) min = max - priceGap;
                return { min, max };
            }

            $minInput.on("input", function () {
                let min = parseInt($(this).val()) || 0;
                let max = parseInt($maxInput.val()) || 0;
                ({ min, max } = clampValues(min, max));

                $minInput.val(min);
                $minRange.val(min);
                updateSliderUI(min, max);
            });

            $maxInput.on("input", function () {
                let min = parseInt($minInput.val()) || 0;
                let max = parseInt($(this).val()) || 0;
                ({ min, max } = clampValues(min, max));

                $maxInput.val(max);
                $maxRange.val(max);
                updateSliderUI(min, max);
            });

            $minRange.on("input", function () {
                let min = parseInt($(this).val());
                let max = parseInt($maxRange.val());
                if (max - min < priceGap) min = max - priceGap;

                $minRange.val(min);
                $minInput.val("Rp." + toRupiahFormat(min));
                updateSliderUI(min, max);
            });

            $maxRange.on("input", function () {
                let min = parseInt($minRange.val());
                let max = parseInt($(this).val());
                if (max - min < priceGap) max = min + priceGap;

                $maxRange.val(max);
                $maxInput.val("Rp." + toRupiahFormat(max));
                updateSliderUI(min, max);
            });
        });

        $(document).ready(function () {
            let products;

            function loadProducts(page = 1) {
                LoadSkeletonProducts(6);

                let selectedSizes = $("input[name='size[]']:checked").map(function() {
                    return $(this).val();
                }).get();

                let filters = {
                    search: $('input[name="search"]').val(),
                    min_price: $('input[name="min_input"]').val(),
                    max_price: $('input[name="max_input"]').val(),
                    size: selectedSizes,
                    category: $('select[name="category"]').val(),
                    sort_by: $('select[name="sort_by"]').val(),
                    page: page
                }

                $.ajax({
                    url: "{{ route('shop.get-products') }}",
                    type: 'GET',
                    data: filters,
                    dataType: 'json',
                    success: function(data) {
                        renderProducts(data);
                    },
                    error: function(xhr) {
                        console.error('Error loading products');
                        $('#list-products-container').html('<p class="text-danger text-center">Error loading products. Retrying...</p>');
                        
                        setTimeout(loadProducts, 10000);
                    }
                });
            }

            function renderProducts(response) {
                products = response.data; 

                const sortBy = $('select[name="sort_by"]').val();

                if (sortBy === 'Low Price') {
                    products = products.sort((a, b) => parseFloat(a.harga_min) - parseFloat(b.harga_min));
                } else if (sortBy === 'High Price') {
                    products = products.sort((a, b) => parseFloat(b.harga_max) - parseFloat(a.harga_max));
                }

                $('#start').text(response.start);
                $('#end').text(response.end);
                $('#total').text(response.total);

                let html = '';
                if(products.length > 0) {
                    products.forEach(item => {
                        const harga_min = toRupiahFormatWithDecimal(item.harga_min);
                        const harga_max = toRupiahFormatWithDecimal(item.harga_max);
                        const price = (harga_min === harga_max) ? harga_min : `${harga_min} - ${harga_max}`;
    
                        html += `
                            <div class="col-md-4 col-sm-6 col-xs-12 text-center animate-box fade-in mb-2">
                                <div class="product">
                                    <div class="product-grid" style="background-image:url('${item.image_url || '/assets/web/images/default.jpeg'}');">
                                        <div class="inner">
                                            <p>
                                                <span class="rating"> ⭐ 4.5 / 5 </span><br>
                                                <br>
                                                <a href="{{ url('product/detail') }}/${item.slug}" class="icon"><i class="icon-eye"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="desc">
                                        <h4><a href="{{ url('product/detail') }}/${item.slug}">${item.nama_produk}</a></h4>
                                        <span class="price">Rp. ${price}</span>
                                    </div>
                                </div>
                            </div>`;
                    });
    
                    $('#list-products-container').html(`<div class="row">${html}</div>`);
                } else {
                    $('#list-products-container').html('<p class="text-danger text-center">Tidak ada Produk untuk hasil Filter ini...</p>');
                    $('#start').text(0);
                }

                $('.animate-box').each(function(i) {
                    $(this).delay(i * 200).queue(function() {
                        $(this).addClass('fadeInUp animated').dequeue();
                    });
                });

                renderPagination(response);
            }

            function renderPagination(response) {
                let html = '';
                const current = response.current_page;
                const last = response.last_page;

                // Previous
                html += `<li ${current === 1 ? 'class="disabled"' : ''}>
                            <a href="#" class="unactive" data-page="${current - 1}">«</a></li>`;

                // First few pages
                for (let i = 1; i <= Math.min(3, last); i++) {
                    html += `<li><a href="#" class="${i === current ? 'active' : 'unactive'}" data-page="${i}">${i}</a></li>`;
                }

                // Ellipsis
                if (last > 5) {
                    html += `<li><a href="#" class="unactive">...</a></li>
                            <li><a href="#" data-page="${last}" class="${current === last ? 'active' : 'unactive'}">${last}</a></li>`;
                }

                // Next
                html += `<li ${current === last ? 'class="disabled"' : ''}>
                            <a href="#" class="unactive" data-page="${current + 1}">Next »</a></li>`;

                $('.pagination').html(html);
            }

            $(document).on('click', '.pagination a[data-page]', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                loadProducts(page);
            });

            loadProducts()

            $('#apply-btn, #search-btn').click(function() {
                loadProducts();
            })

            $('#sort-by').change(function() {
                loadProducts();
            })
        })
    </script>
@endpush