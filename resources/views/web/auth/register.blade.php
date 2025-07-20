<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bowdown | Register</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/auth/register/css/montserrat-font.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/auth/register/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/auth/register/css/style.css"/>
</head>
<body class="form-v10">
	<div class="page-content">
		<div class="form-v10-content">
			<form class="form-detail" action="#" method="post" id="myform">
				<div class="form-left">
					<h2>Personal Information</h2>
					<div class="form-row">
						<input type="text" name="nama" class="nama" id="nama" placeholder="nama" required>
					</div>
					<div class="form-row">
						<input type="text" name="email" class="email" id="email" placeholder="email" required>
					</div>
					<div class="form-row" style="position: relative;">
						<input type="password" name="password" class="password" id="password" placeholder="password" required>
						<span style="position: absolute; right: 50px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword()">
							<i class="zmdi zmdi-eye" id="togglePasswordIcon"></i>
						</span>
					</div>
					

				</div>
				<div class="form-right">
					<h2>Details Information</h2>
					<div class="form-row">
						<input type="text" name="no_hp" class="no_hp" id="no_hp" placeholder="Phone Number" required>
					</div>
					<div class="form-row">
						<input type="text" name="additional" class="additional" id="additional" placeholder="Additional Information" required>
					</div>
					<div class="form-row">
						<input type="text" name="additional" class="additional" id="additional" placeholder="Additional Information" required>
					</div>
                    <div class="form-checkbox">
                        <p>Sudah punya akun? <a href="{{ route('auth.login') }}" class="text">Login</a></p>
                    </div>
					<div class="form-row-last">
						<input type="submit" name="register" class="register" value="Register">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
<script>
	function togglePassword() {
		const passwordInput = document.getElementById('password');
		const icon = document.getElementById('togglePasswordIcon');
		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			icon.classList.remove('zmdi-eye');
			icon.classList.add('zmdi-eye-off');
		} else {
			passwordInput.type = 'password';
			icon.classList.remove('zmdi-eye-off');
			icon.classList.add('zmdi-eye');
		}
	}
</script>