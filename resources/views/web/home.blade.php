@extends('web.partials.main')

@push('css')
    <style>
        .loading-skeleton {
            background: #f0f0f0;
            border-radius: 4px;
            margin-bottom: 10px;
            position: relative;
            overflow: hidden;
        }

        .loading-skeleton::after {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .skeleton-image {
            width: 100%;
            height: 200px;
            background: #e0e0e0;
        }

        .skeleton-text {
            height: 20px;
            width: 80%;
            margin: 10px auto;
        }
    </style>
@endpush

@section('content')
    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
                <li style="background-image: url({{ asset('assets') }}/web/images/img_bg_1.png);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h2>Gear Up in Style, Rule the Road</h2>
                                    <p>Far beyond traffic lights and city noise, true riders know—performance is
                                        nothing without presence.</p>
                                    <p><a href="single.html" class="btn btn-primary btn-outline btn-lg">See More
                                        </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ asset('assets') }}/web/images/img_bg_2.png);">
                    <div class="container">
                        <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h2>Built for Speed, Designed for You</h2>
                                    <p>From the curves of the highway to the corners of your garage, our moves with your passion.</p>
                                    <p><a href="single.html" class="btn btn-primary btn-outline btn-lg">See More    </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ asset('assets') }}/web/images/img_bg_3.png);">
                    <div class="container">
                        <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h2>Ride Hard, Wear Bold</h2>
                                    <p>Not just clothing—it’s a statement for those who chase torque, thrill, and
                                        timeless style.</p>
                                    <p><a href="single.html" class="btn btn-primary btn-outline btn-lg">See More
                                        </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>

    <div id="fh5co-services" class="fh5co-bg-section">
        <div class="row animate-box">
            <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                <span>Cool Stuff</span>
                <h2>CATEGORIES</h2>
            </div>
        </div>
        <div class="container">
            @foreach ($categories->chunk(3) as $chunk)
                <div class="row mb-4">
                    @foreach ($chunk as $item)
                        @php
                            $colClass = match(count($chunk)) {
                                1 => 'col-md-12',
                                2 => 'col-md-6',
                                default => 'col-md-4'
                            };
                        @endphp

                        <div class="{{ $colClass }} col-sm-6 mb-4">
                            <div class="category-card text-center h-100">
                                <a href="#">
                                    <div class="image-container">
                                        <img src="{{ GetFile('categories', $item->foto) }}" alt="{{ $item->nama_kategori }}" class="img-fluid rounded" loading="lazy">
                                        <h3 class="category-title mt-3">{{ $item->nama_kategori }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <br><br>
            @endforeach
        </div>
    </div>

    <div id="fh5co-product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <span>Bowdown</span>
                    <h2>HOT Products.</h2>
                    <p>Inspired by motorcycle, Bowdown Rebbel is a lifestyle brand that embodies the spirit of freedom and adventure.</p>
                </div>
            </div>
            <div class="row">
                <div id="hot-products-container">
                    <!-- Tempat untuk menampilkan products yang di-load via AJAX -->
                    <div class="text-center py-5 loading-indicator">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p>Loading products...</p>
                    </div>
                </div>
                {{-- @include('web.section-parts.hot-products') --}}
            </div>
        </div>
    </div>

    <div id="fh5co-started">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Stay Up to Date with All News
                        and Exclusive Offers</h2>
                    <p>Just stay tune for our latest Product. Now you can subscribe</p>
                </div>
            </div>
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2">
                    <form class="form-inline">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-default btn-block">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function loadHotProducts() {
                $('#hot-products-container').html(`
                    <div class="row mb-4">
                        ${Array(3).fill().map(() => `
                        <div class="col-md-4 text-center">
                            <div class="product">
                                <div class="product-grid loading-skeleton">
                                    <div class="skeleton-image"></div>
                                </div>
                                <div class="desc">
                                    <div class="skeleton-text"></div>
                                    <div class="skeleton-text" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                        `).join('')}
                    </div>
                `);

                $.ajax({
                    url: "{{ route('home.hot-products') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        renderHotProducts(data);
                        
                        setTimeout(loadHotProducts, 60000);
                    },
                    error: function(xhr) {
                        console.error('Error loading products');
                        $('#hot-products-container').html('<p class="text-danger">Error loading products. Retrying...</p>');
                        
                        setTimeout(loadHotProducts, 5000);
                    }
                });
            }

            function renderHotProducts(products) {
                let html = '';
                
                const chunks = [];
                for (let i = 0; i < products.length; i += 3) {
                    chunks.push(products.slice(i, i + 3));
                }
                
                chunks.forEach(chunk => {
                    const colClasses = {
                        1: 'col-md-12',
                        2: 'col-md-6',
                        3: 'col-md-4'
                    };
                    const colClass = colClasses[chunk.length] || 'col-md-4';
                    
                    html += `<div class="row mb-4 fade-in">`;
                    chunk.forEach(item => {
                        let harga_min = FormatRupiah(item.harga_min);
                        let harga_max = FormatRupiah(item.harga_max);
                        let price = (harga_min == harga_max) ? harga_min : `${harga_min} - ${harga_max}`;
                        html += `
                        <div class="${colClass} text-center animate-box">
                            <div class="product">
                                <div class="product-grid" style="background-image:url(${item.image_url || '{{ asset('assets') }}/web/images/default.png'});">
                                    <div class="inner">
                                        <p>
                                            <a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
                                            <a href="{{ route('shop.detail') }}?id=${item.id}" class="icon"><i class="icon-eye"></i></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h3><a href="single.html">${item.nama_produk}</a></h3>
                                    <span class="price">Rp. ${price}</span>
                                </div>
                            </div>
                        </div>`;
                    });
                    html += `</div><br><br>`;
                });
                
                $('#hot-products-container').html(html);
                
                $('.animate-box').each(function(i) {
                    $(this).delay(i * 200).queue(function() {
                        $(this).addClass('fadeInUp animated').dequeue();
                    });
                });
            }
            
            loadHotProducts();
        });
    </script>
@endpush