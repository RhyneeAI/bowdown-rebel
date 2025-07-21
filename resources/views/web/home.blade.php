@extends('web.partials.main')

@push('css')
    <style>
        .rating {
            color: white;
            font-size: 2.2rem;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
                @foreach ($promotions as $promo)
                <li style="background-image: url('{{ asset('storage/promotions/' . $promo->foto) }}')">

                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h2>Promo Code: {{ $promo->kode_promosi }}</h2>
                                    <p>Save up to <strong>Rp{{ number_format($promo->diskon_harga, 0, ',', '.') }}</strong> with this special offer! Don’t miss out!</p>
                                    <p><a href="{{ route('shop.index') }}" class="btn btn-primary btn-outline btn-lg">
                                            Shop Now</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
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
                LoadSkeletonProducts(3);

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
                        let harga_min = toRupiahFormatWithDecimal(item.harga_min);
                        let harga_max = toRupiahFormatWithDecimal(item.harga_max);
                        let price = (harga_min == harga_max) ? harga_min : `${harga_min} - ${harga_max}`;
                        html += `
                        <div class="${colClass} text-center animate-box">
                            <div class="product">
                                <div class="product-grid" style="background-image:url(${item.image_url || '{{ asset('assets') }}/web/images/default.jpeg'});">
                                    <div class="inner">
                                        <p>
                                            <span class="rating"> ⭐ 4.5 / 5 </span><br>
                                            <br>
                                            <a href="" class="icon"><i class="icon-eye"></i></a>
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