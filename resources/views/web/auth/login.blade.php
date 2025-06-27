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
	</head>

	<body>

		<div class="wrapper" style="background-image: url('{{ asset('assets') }}/auth/login/images/news.png');">
			<div class="inner">
				<div class="image-holder">
					<img src="{{ asset('assets') }}/auth/login/images/registration-form-1.png" alt="">
				</div>
				<form action="">
					<h3>Login</h3>
					<div class="form-wrapper">
						<input type="text" placeholder="Email Address" class="form-control">
					</div>
					<div class="form-wrapper">
						<input type="password" placeholder="Password" class="form-control">
						<i class="zmdi zmdi-lock"></i>
					</div>
					<button>Login
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
                    <br>
                    <p>Don't have an account? <a href="{{ route('auth.register') }}">Register</a></p>

				</form>
			</div>
		</div>
		
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>