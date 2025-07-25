<footer id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-4 fh5co-widget">
                <h3>Bowdown Rebel</h3>
                <p>Bowdown Rebbel bukan sekadar tempat jual beli. Kami adalah rumah bagi para rebel jalanan — tempat
                    rider sejati menemukan apparel yang sesuai gaya hidupnya.
                    Bergabunglah dengan ribuan pengendara lain yang memilih gaya hidup bebas, brutal, dan otentik.
                    Karena di jalanan, yang membedakan kita bukan sekadar motor tapi sikap.
                    Ride Loud. Dress Bold. Bowdown to None.</p>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                <ul class="fh5co-footer-links">
                    <li><a href="#">Shop All</a></li>
                    <li><a href="#">Jacket & Outer</a></li>
                    <li><a href="#">Shirt & T-Shirt </a></li>
                    <li><a href="#">Helmet & Accessories</a></li>
                    <li><a href="#">More</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                <ul class="fh5co-footer-links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">How to Shop</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                <ul class="fh5co-footer-links">
                    <li><a href="#">Join our Community</a></li>
                    <li><a href="#">Brand Partners</a></li>
                    <li><a href="#">Become an Affiliate</a></li>
                    <li><a href="#">Event Sponsorship</a></li>
                    <li><a href="#">Newsletter Subscription</a></li>
                </ul>
            </div>
        </div>

        <div class="row copyright">
            <div class="col-md-12 text-center">
                <p>
                    <small class="block">&copy; 2025 Bowdown Rebbel. Ride free, stay wild.</small>
					<small>Follow our Social Media</small>
                    {{-- <small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a>
                        Demo Images: <a href="http://blog.gessato.com/" target="_blank">Gessato</a> &amp; <a
                            href="http://unsplash.co/" target="_blank">Unsplash</a></small> --}}
                </p>
                <p>
                    <ul class="fh5co-social-icons">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                        <li><a href="#"><i class="icon-instagram"></i></a></li>
                    </ul>
                </p>
            </div>
        </div>

    </div>
</footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- Modernizr JS -->
<script src="{{ asset('assets') }}/web/js/modernizr-2.6.2.min.js"></script>
<!-- jQuery -->
<script src="{{ asset('assets') }}/web/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="{{ asset('assets') }}/web/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets') }}/web/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="{{ asset('assets') }}/web/js/jquery.waypoints.min.js"></script>
<!-- Carousel -->
<script src="{{ asset('assets') }}/web/js/owl.carousel.min.js"></script>
<!-- countTo -->
<script src="{{ asset('assets') }}/web/js/jquery.countTo.js"></script>
<!-- Flexslider -->
<script src="{{ asset('assets') }}/web/js/jquery.flexslider-min.js"></script>
<!-- Main -->
<script src="{{ asset('assets') }}/web/js/main.js"></script>
<script src="{{ asset('assets') }}/js/format-rupiah.js"></script>
<script src="{{ asset('assets') }}/js/ultility.js"></script>
<script src="{{ asset('assets') }}/js/slimselect.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "className": "custom-larger-toast"
    };

    toastr.options.onShown = function() {
        $('.toast').css({
            'width': '360px',
            'font-size': '18px',
            'min-height': '60px'
        });
        $('.toast .toast-title').css('font-size', '21px');
        $('.toast .toast-message').css('font-size', '17px');
    };

    function showResponse(response) {
        if (response.success) {
            toastr.success(response.success);
        } else if (response.warning) {
            toastr.warning(response.warning);
        } else if (response.error) {
            toastr.error(response.error);
        } else {
            toastr.error('Terjadi kesalahan tak terduga.', '!!!');
        }
    }

    @if (session('success'))
        toastr.success("{{ session('success') }}", "Berhasil!");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}", "Gagal!");
    @endif

    @if (session('warning'))
        toastr.warning("{{ session('warning') }}", "Perhatian!");
    @endif

    @if (session('info'))
        toastr.info("{{ session('info') }}", "Informasi");
    @endif
</script>

@stack('scripts')
