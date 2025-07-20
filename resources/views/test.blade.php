<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <form action="{{ route('User.transaction.checkout') }}" method="post">
        @csrf
        <input type="hidden" name="variant_product_ids[]" value="20">
        <input type="hidden" name="variant_product_ids[]" value="22">
        <input type="hidden" name="qty[]" value="1">
        <input type="hidden" name="qty[]" value="2">
        <input type="hidden" name="promotion_ids[]" value="2">
        <input type="hidden" name="expedition_id" value="1">
        <input type="hidden" name="total_payment" value="0">
        <button type="submit">Submit</button>
    </form>
    
    <script src="{{ asset('assets') }}/dashboard/libs/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

    toastr.success("test", "Berhasil!");
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
</body>
</html>