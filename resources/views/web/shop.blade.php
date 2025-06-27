<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    @include('web.partials.header')
</head>
<body>
    <div class="fh5co-loader"></div>
    <div id="page">
    @include('web.partials.navbar')

    <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner"
        style="background-image:url(assets/web/images/news.png);">
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
    </header>

    <div id="fh5co-product">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-sm-12">
                    <div class="sidebar-box" style="padding: 20px; border: 1px solid #ddd; margin-bottom: 20px;">
                        <h4>Search</h4>
                        <div class="input-group" style="margin-bottom: 15px;">
                            <input type="text" class="form-control" placeholder="Search products..." style="height: 40px;">
                            <span class="input-group-btn" style="height: 40px;">
                                <button class="btn btn-default search-btn" type="button" style="height: 40px; padding-top: 8px; padding-bottom: 8px; background-color: #222;">
                                    <i class="icon-search" style="color: #fff;"></i>
                                </button>
                            </span>
                        </div>

                        <h4>Filter by Price</h4>
                        <input type="range" min="0" max="7200000" class="form-control" style="margin-bottom: 10px;" id="price-range">
                        <div class="form-group" style="display: flex; justify-content: space-between;">
                            <input type="number" class="form-control" placeholder="Rp0" style="width: 48% !important; margin-right: 4%;">
                            <input type="number" class="form-control" placeholder="Rp7.200.000" style="width: 48% !important;">
                        </div>

                        <h4 style="margin-top: 20px;">Filter by Size</h4>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="checkbox"><label><input type="checkbox"> XS</label></div>
                                <div class="checkbox"><label><input type="checkbox"> S</label></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="checkbox"><label><input type="checkbox"> M</label></div>
                                <div class="checkbox"><label><input type="checkbox"> L</label></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="checkbox"><label><input type="checkbox"> XL</label></div>
                                <div class="checkbox"><label><input type="checkbox"> XXL</label></div>
                            </div>
                        </div>
                        <button class="btn btn-default search-btn" type="button" style="height: 30px; padding-top: 2px; padding-bottom: 4px; background-color: #222;">
                            <span style="color: white; font-size: 12px">Apply</span>
                        </button>

                        <h4 style="margin-top: 20px;">Category</h4>
                        <div class="input-group">
                            <select class="form-control">
                                <option>All</option>
                                <option>Shirts</option>
                                <option>Jackets</option>
                                <option>Accessories</option>
                                <option>Pants</option>
                            </select>
                            <span class="input-group-btn" style="height: 54px;">
                                <button class="btn btn-default search-btn" type="button" style="height: 54px; padding-top: 8px; padding-bottom: 8px; background-color: #222;">
                                    <i class="icon-arrow-right" style="color: #fff;"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="col-md-9 col-sm-12">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-sm-6 col-xs-12">
                            <p>Showing 1–3 of 100 results</p>
                        </div>
                        <div class="col-sm-6 col-xs-12 text-right">
                            <select class="form-control" style="width: auto; display: inline-block;">
                                <option>Default sorting</option>
                                <option>Sort by popularity</option>
                                <option>Sort by average rating</option>
                                <option>Sort by latest</option>
                                <option>Sort by price: low to high</option>
                                <option>Sort by price: high to low</option>
                            </select>
                            {{-- <span style="margin-left: 10px;">
                                <a href="#" class="btn btn-default btn-sm"><i class="icon-th-large"></i></a>
                                <a href="#" class="btn btn-default btn-sm"><i class="icon-th-list"></i></a>
                            </span> --}}
                        </div>
                    </div>

                    <div class="row">
                        <!-- Dummy Products -->
                        <div class="col-md-4 col-sm-6 col-xs-12 text-center animate-box">
                            <div class="product">
                                <div class="product-grid" style="background-image:url(../assets/web/images/pict_bowdown/workshirt.png);">
                                    <div class="inner">
                                        <p>
                                            <a href="#" class="icon"><i class="icon-shopping-cart"></i></a>
                                            <a href="{{ route('shop_detail') }}" class="icon"><i class="icon-eye"></i></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h4><a href="#">Black Cartel Workshirt Boxy</a></h4>
                                    <span class="price">Rp435.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 text-center animate-box">
                            <div class="product">
                                <div class="product-grid" style="background-image:url(../assets/web/images/pict_bowdown/worktshirt2.png);">
                                    <div class="inner">
                                        <p>
                                            <a href="#" class="icon"><i class="icon-shopping-cart"></i></a>
                                            <a href="{{ route('shop_detail') }}" class="icon"><i class="icon-eye"></i></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h4><a href="#">Blue Lines Workshirt Boxy</a></h4>
                                    <span class="price">Rp419.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 text-center animate-box">
                            <div class="product">
                                <div class="product-grid" style="background-image:url(../assets/web/images/pict_bowdown/shirt1.png);">
                                    <div class="inner">
                                        <p>
                                            <a href="#" class="icon"><i class="icon-shopping-cart"></i></a>
                                            <a href="{{ route('shop_detail') }}" class="icon"><i class="icon-eye"></i></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h4><a href="#">Sherman Workshirt</a></h4>
                                    <span class="price">Rp389.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Dummy Products -->
                        <div class="col-md-4 col-sm-6 col-xs-12 text-center animate-box">
                            <div class="product">
                                <div class="product-grid" style="background-image:url(../assets/web/images/pict_bowdown/longsleeve.png);">
                                    <div class="inner">
                                        <p>
                                            <a href="#" class="icon"><i class="icon-shopping-cart"></i></a>
                                            <a href="{{ route('shop_detail') }}" class="icon"><i class="icon-eye"></i></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h4><a href="#">Black Cartel Workshirt Boxy</a></h4>
                                    <span class="price">Rp435.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 text-center animate-box">
                            <div class="product">
                                <div class="product-grid" style="background-image:url(../assets/web/images/pict_bowdown/topi.png);">
                                    <div class="inner">
                                        <p>
                                            <a href="#" class="icon"><i class="icon-shopping-cart"></i></a>
                                            <a href="{{ route('shop_detail') }}" class="icon"><i class="icon-eye"></i></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h4><a href="#">Blue Lines Workshirt Boxy</a></h4>
                                    <span class="price">Rp419.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 text-center animate-box">
                            <div class="product">
                                <div class="product-grid" style="background-image:url(../assets/web/images/pict_bowdown/helm.png);">
                                    <div class="inner">
                                        <p>
                                            <a href="#" class="icon"><i class="icon-shopping-cart"></i></a>
                                            <a href="{{ route('shop_detail') }}" class="icon"><i class="icon-eye"></i></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h4><a href="#">Sherman Workshirt</a></h4>
                                    <span class="price">Rp389.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <ul class="pagination" style="--bs-pagination-active-bg: #222; --bs-pagination-active-border-color: #222;">
                                <li class="disabled"><span style="color: #222;">«</span></li>
                                <li class="active"><span style="background-color: #222; border-color: #222; color: #fff;">1</span></li>
                                <li><a href="#" style="color: #222;">2</a></li>
                                <li><a href="#" style="color: #222;">3</a></li>
                                <li><span style="color: #222;">...</span></li>
                                <li><a href="#" style="color: #222;">25</a></li>
                                <li><a href="#" style="color: #222;">Next »</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('web.partials.footer')
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

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
    .search-btn:hover {
        background-color: #444 !important;
        transition: background 0.2s;
    }
    .search-btn:hover .icon-search {
        color: #ffd700 !important;
        transition: color 0.2s;
    }
    #price-range::-webkit-slider-thumb {
        background: #222;
    }
    #price-range::-moz-range-thumb {
        background: #222;
    }
    #price-range::-ms-thumb {
        background: #222;
    }
    #price-range {
         accent-color: #222;
    }
</style>

</body>
</html>