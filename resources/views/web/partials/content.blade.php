<header id="header" class="site-header text-black">
    {{-- <div class="header-top border-bottom py-2">
        <div class="container-lg">
            <div class="row justify-content-evenly">
                <div class="col">
                    <ul class="social-links list-unstyled d-flex m-0">
                        <li class="pe-2">
                            <a href="#">
                                <svg class="facebook" width="20" height="20">
                                    <use xlink:href="#facebook"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="pe-2">
                            <a href="#">
                                <svg class="instagram" width="20" height="20">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="pe-2">
                            <a href="#">
                                <svg class="youtube" width="20" height="20">
                                    <use xlink:href="#youtube"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg class="pinterest" width="20" height="20">
                                    <use xlink:href="#pinterest"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col d-none d-md-block">
                    <p class="text-center text-black m-0"><strong>Special Offer</strong>: Free Shipping on all the
                        orders above $100
                    </p>
                </div>
                <div class="col">
                    <ul class="d-flex justify-content-end gap-3 list-unstyled m-0">
                        <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="#">Cart</a>
                        </li>
                        <li>
                            <a href="#">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
    <nav id="header-nav" class="navbar navbar-expand-lg">
        <div class="container-lg">
            <a class="navbar-brand" href="index.html">
                <img src="{{ asset() }}/assets/web/images/main-logo.png" class="logo" alt="logo">
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 border-0 p-1 ms-2" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg class="navbar-icon">
                    <use xlink:href="#navbar-icon"></use>
                </svg>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand ps-3" href="index.html">
                        <img src="{{ asset() }}/assets/web/images/main-logo.png" class="logo" alt="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black p-5" data-bs-dismiss="offcanvas"
                        aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar" class="navbar-nav fw-bold justify-content-end align-items-center flex-grow-1">
                        <li class="nav-item dropdown">
                            <a class="nav-link me-5 active dropdown-toggle border-0" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">Home</a>
                            <ul class="dropdown-menu fw-bold">
                                <li>
                                    <a href="index.html" class="dropdown-item">Home V1</a>
                                </li>
                                <li>
                                    <a href="index.html" class="dropdown-item">Home V2 </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-5" href="#">Men</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-5" href="#">Women</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link me-5 active dropdown-toggle border-0" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">Page</a>
                            <ul class="dropdown-menu fw-bold">
                                <li>
                                    <a href="index.html" class="dropdown-item">About Us </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.html">Shop </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.html">Blog </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.html">Single Product </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.html">Single Post </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.html">Styles </a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modallong"
                                        class="dropdown-item">cart</a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modallogin"
                                        class="dropdown-item">Login</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-5" href="index.html">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-5" href="#">Sale</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="user-items ps-0 ps-md-5">
                <ul class="d-flex justify-content-end list-unstyled align-item-center m-0">
                    <li class="pe-3">
                        <a href="login" data-bs-toggle="modal" data-bs-target="#modallogin" class="border-0">
                            <svg class="user" width="24" height="24">
                                <use xlink:href="#user"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="pe-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modallong" class="border-0">
                            <svg class="shopping-cart" width="24" height="24">
                                <use xlink:href="#shopping-cart"></use>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="search-item border-0" data-bs-toggle="collapse" data-bs-target="#search-box"
                            aria-label="Toggle navigation">
                            <svg class="search" width="24" height="24">
                                <use xlink:href="#search"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<section id="intro" class="position-relative mt-4">
    <div class="container-lg">
        <div class="swiper main-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card d-flex flex-row align-items-end border-0 large jarallax-keep-img">
                        <img src="{{ asset() }}/assets/web/images/card-image1.jpg" alt="shoes" class="img-fluid jarallax-img">
                        <div class="cart-concern p-3 m-3 p-lg-5 m-lg-5">
                            <h2 class="card-title display-3 light">Stylish shoes for Women</h2>
                            <a href="index.html"
                                class="text-uppercase light mt-3 d-inline-block text-hover fw-bold light-border">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row g-4">
                        <div class="col-lg-12 mb-4">
                            <div class="card d-flex flex-row align-items-end border-0 jarallax-keep-img">
                                <img src="{{ asset() }}/assets/web/images/card-image2.jpg" alt="shoes" class="img-fluid jarallax-img">
                                <div class="cart-concern p-3 m-3 p-lg-5 m-lg-5">
                                    <h2 class="card-title style-2 display-4 light">Sports Wear</h2>
                                    <a href="index.html"
                                        class="text-uppercase light mt-3 d-inline-block text-hover fw-bold light-border">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card d-flex flex-row align-items-end border-0 jarallax-keep-img">
                                <img src="{{ asset() }}/assets/web/images/card-image3.jpg" alt="shoes" class="img-fluid jarallax-img">
                                <div class="cart-concern p-3 m-3 p-lg-5 m-lg-5">
                                    <h2 class="card-title style-2 display-4 light">Fashion Shoes</h2>
                                    <a href="index.html"
                                        class="text-uppercase light mt-3 d-inline-block text-hover fw-bold light-border">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card d-flex flex-row align-items-end border-0 large jarallax-keep-img">
                        <img src="{{ asset() }}/assets/web/images/card-image4.jpg" alt="shoes" class="img-fluid jarallax-img">
                        <div class="cart-concern p-3 m-3 p-lg-5 m-lg-5">
                            <h2 class="card-title display-3 light">Stylish shoes for men</h2>
                            <a href="index.html"
                                class="text-uppercase light mt-3 d-inline-block text-hover fw-bold light-border">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row g-4">
                        <div class="col-lg-12 mb-4">
                            <div class="card d-flex flex-row align-items-end border-0 jarallax-keep-img">
                                <img src="{{ asset() }}/assets/web/images/card-image5.jpg" alt="shoes" class="img-fluid jarallax-img">
                                <div class="cart-concern p-3 m-3 p-lg-5 m-lg-5">
                                    <h2 class="card-title style-2 display-4 light">Men Shoes</h2>
                                    <a href="index.html"
                                        class="text-uppercase light mt-3 d-inline-block text-hover fw-bold light-border">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card d-flex flex-row align-items-end border-0 jarallax-keep-img">
                                <img src="{{ asset() }}/assets/web/images/card-image6.jpg" alt="shoes" class="img-fluid jarallax-img">
                                <div class="cart-concern p-3 m-3 p-lg-5 m-lg-5">
                                    <h2 class="card-title style-2 display-4 light">Women Shoes</h2>
                                    <a href="index.html"
                                        class="text-uppercase light mt-3 d-inline-block text-hover fw-bold light-border">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="discount-coupon py-2 my-2 py-md-5 my-md-5">
    <div class="container">
        <div class="bg-gray coupon position-relative p-5">
            <div class="bold-text position-absolute">10% OFF</div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-7 col-md-12 mb-3">
                    <div class="coupon-header">
                        <h2 class="display-7">10% OFF Discount Coupons</h2>
                        <p class="m-0">Subscribe us to get 10% OFF on all the purchases</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="btn-wrap">
                        <a href="#" class="btn btn-black btn-medium text-uppercase hvr-sweep-to-right">Email me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="featured-products" class="product-store">
    <div class="container-md">
        <div class="display-header d-flex align-items-center justify-content-between">
            <h2 class="section-title text-uppercase">Featured Products</h2>
            <div class="btn-right">
                <a href="index.html" class="d-inline-block text-uppercase text-hover fw-bold">View all</a>
            </div>
        </div>
        <div class="product-content padding-small">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                <div class="col mb-4">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item1.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item2.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item3.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item4.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item5.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="collection-products" class="py-2 my-2 py-md-5 my-md-5">
    <div class="container-md">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="collection-card card border-0 d-flex flex-row align-items-end jarallax-keep-img">
                    <img src="{{ asset() }}/assets/web/images/collection-item1.jpg" alt="product-item"
                        class="border-rounded-10 img-fluid jarallax-img">
                    <div class="card-detail p-3 m-3 p-lg-5 m-lg-5">
                        <h3 class="card-title display-3">
                            <a href="#">Minimal Collection</a>
                        </h3>
                        <a href="index.html" class="text-uppercase mt-3 d-inline-block text-hover fw-bold">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="collection-card card border-0 d-flex flex-row jarallax-keep-img">
                    <img src="{{ asset() }}/assets/web/images/collection-item2.jpg" alt="product-item"
                        class="border-rounded-10 img-fluid jarallax-img">
                    <div class="card-detail p-3 m-3 p-lg-5 m-lg-5">
                        <h3 class="card-title display-3">
                            <a href="#">Sneakers Collection</a>
                        </h3>
                        <a href="index.html" class="text-uppercase mt-3 d-inline-block text-hover fw-bold">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="latest-products" class="product-store py-2 my-2 py-md-5 my-md-5 pt-0">
    <div class="container-md">
        <div class="display-header d-flex align-items-center justify-content-between">
            <h2 class="section-title text-uppercase">Latest Products</h2>
            <div class="btn-right">
                <a href="index.html" class="d-inline-block text-uppercase text-hover fw-bold">View all</a>
            </div>
        </div>
    
        <div class="product-content padding-small">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                <div class="col mb-4 mb-3">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item6.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 mb-3">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item7.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 mb-3">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item8.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 mb-3">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item9.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 mb-3">
                    <div class="product-card position-relative">
                        <div class="card-img">
                            <img src="{{ asset() }}/assets/web/images/card-item10.jpg" alt="product-item" class="product-image img-fluid">
                            <div class="cart-concern position-absolute d-flex justify-content-center">
                                <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#modallong">
                                        <svg class="shopping-carriage">
                                            <use xlink:href="#shopping-carriage"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-target="#modaltoggle"
                                        data-bs-toggle="modal">
                                        <svg class="quick-view">
                                            <use xlink:href="#quick-view"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- cart-concern -->
                        </div>
                        <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                            <h3 class="card-title fs-6 fw-normal m-0">
                                <a href="index.html">Running shoes for men</a>
                            </h3>
                            <span class="card-price fw-bold">$99</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>