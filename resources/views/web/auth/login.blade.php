<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login | Bowdown</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{ asset('assets') }}/auth/login/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{ asset('assets') }}/auth/login/css/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('{{ asset('assets') }}/auth/login/images/news.png');">
			<div class="inner">
				<div class="image-holder">
					<img src="{{ asset('assets') }}/auth/login/images/registration-form-1.png" alt="">
				</div>
				<form action="{{ route('auth.login.process') }}" method="POST">
					@csrf
					<h3>Login</h3>
					<div class="form-wrapper">
						<input type="text" placeholder="Email Address" class="form-control" name="email" required>
					</div>
					<div class="form-wrapper">
						<input type="password" placeholder="Password" class="form-control" name="password" required>
						<i class="zmdi zmdi-lock"></i>
					</div>
					<button type="submit">Login
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
                    <br>
                    <p>Don't have an account? <a href="{{ route('auth.register') }}">Register</a></p>
				</form>
			</div>
		</div>
		
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

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
</html>