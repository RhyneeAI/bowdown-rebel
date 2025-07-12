<!DOCTYPE HTML>
<html>

<head>
    @include('web.partials.header')
</head>

<body>
    <div class="fh5co-loader"></div>
    <div id="page">
        <!-- navbar -->
        @include('web.partials.navbar')
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
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid"
                                style="background-image:url({{ asset('assets') }}/web/images/pict_bowdown/shirt1.png);">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('shop.detail') }}" class="icon"><i class="icon-eye"></i></a>

                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="single.html">White Retro Power Tees</a></h3>
                                <span class="price">Rp. 150.000</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid"
                                style="background-image:url({{ asset('assets') }}/web/images/pict_bowdown/outer.png);">
                                {{-- <span class="sale">Sale</span> --}}
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('shop.detail') }}" class="icon"><i class="icon-eye"></i></a>

                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="single.html"></a>P&COF Trucker Jacket</h3>
                                <span class="price">Rp. 600.000</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid"
                                style="background-image:url({{ asset('assets') }}/web/images/pict_bowdown/helm.png);">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('shop.detail') }}" class="icon"><i class="icon-eye"></i></a>

                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Retro Green Helmet</a></h3>
                                <span class="price">Rp. 780.000</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid"
                                style="background-image:url({{ asset('assets') }}/web/images/pict_bowdown/worktshirt2.png);">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('shop.detail') }}" class="icon"><i class="icon-eye"></i></a>

                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Blue Plain Workshirt</a></h3>
                                <span class="price">Rp. 200.000</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid"
                                style="background-image:url({{ asset('assets') }}/web/images/pict_bowdown/hoodie.png);">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('shop.detail') }}" class="icon"><i class="icon-eye"></i></a>

                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="single.html">High Spirit Hoodie</a></h3>
                                <span class="price">Rp. 150.000</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid"
                                style="background-image:url({{ asset('assets') }}/web/images/pict_bowdown/scarf.png);">
                                <div class="inner">
                                    <p>
                                        <a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('shop.detail') }}" class="icon"><i class="icon-eye"></i></a>

                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="single.html">Soul Stripper Classic</a></h3>
                                <span class="price">Rp. 99.000</span>
                            </div>
                        </div>
                    </div>
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

        <!-- footer and script -->
        @include('web.partials.footer')


</body>

</html>
