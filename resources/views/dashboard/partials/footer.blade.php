<footer>
    <div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
        class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com/" target="_blank"
        class="pe-1 text-primary text-decoration-underline">ThemeWagon</a></p>
    </div>
</footer>
<script src="{{ asset('assets') }}/dashboard/libs/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('assets') }}/dashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets') }}/dashboard/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="{{ asset('assets') }}/dashboard/libs/simplebar/dist/simplebar.js"></script>
<script src="{{ asset('assets') }}/dashboard/js/sidebarmenu.js"></script>
<script src="{{ asset('assets') }}/dashboard/js/app.min.js"></script>
<script src="{{ asset('assets') }}/dashboard/js/dashboard.js"></script>
<script src="{{ asset('assets') }}/js/ultility.js"></script>
<script src="{{ asset('assets') }}/js/format-rupiah.js"></script>
<script src="{{ asset('assets') }}/js/flatpickr.min.js"></script>
<script src="{{ asset('assets') }}/js/slimselect.min.js"></script>
<script src="{{ asset('assets') }}/js/quill.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.logout-button').forEach(el => {
        el.addEventListener('click', event => {
            event.preventDefault();
            Swal.fire({
                title: 'Keluar dari sistem?',
                text: "Anda akan keluar dari sistem, pastikan Anda telah menyimpan perubahan sebelumnya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, keluar!',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    document.querySelector('#logoutForm').submit();
                }
            })
        })
    })
</script>
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

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}", "Gagal!");
        @endforeach
    @endif
</script>
@stack('script')