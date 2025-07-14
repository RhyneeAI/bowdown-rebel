<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Bowdown Rebbel &mdash; Shop</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="rock band, otomotive, car, motorcycle, cool, bowdown rebbel" />
<meta name="author" content="Trident.startup" />

<!-- 
//////////////////////////////////////////////////////

FREE HTML5 TEMPLATE 
DESIGNED & DEVELOPED by FreeHTML5.co
	
Website: 		http://freehtml5.co/
Email: 			info@freehtml5.co
Twitter: 		http://twitter.com/fh5co
Facebook: 		https://www.facebook.com/fh5co

//////////////////////////////////////////////////////
	-->

<!-- Facebook and Twitter integration -->
<meta property="og:title" content=""/>
<meta property="og:image" content=""/>
<meta property="og:url" content=""/>
<meta property="og:site_name" content=""/>
<meta property="og:description" content=""/>
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />
<meta name="twitter:url" content="" />
<meta name="twitter:card" content="" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> -->
<!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<!-- Animate.css -->
<link rel="stylesheet" href="{{ asset('assets') }}/web/css/animate.css">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="{{ asset('assets') }}/web/css/icomoon.css">
<!-- Bootstrap  -->
<link rel="stylesheet" href="{{ asset('assets') }}/web/css/bootstrap.css">

<!-- Flexslider  -->
<link rel="stylesheet" href="{{ asset('assets') }}/web/css/flexslider.css">

<!-- Owl Carousel  -->
<link rel="stylesheet" href="{{ asset('assets') }}/web/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/web/css/owl.theme.default.min.css">

<!-- Theme style  -->
<link rel="stylesheet" href="{{ asset('assets') }}/web/css/style.css">
<style>
	.loading-skeleton {
		background: #f0f0f0;
		border-radius: 4px;
		margin-bottom: 10px;
		position: relative;
		overflow: hidden;
	}

	.loading-skeleton::after {
		content: '';
		display: block;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
		animation: shimmer 1.5s infinite;
	}

	@keyframes shimmer {
		0% { transform: translateX(-100%); }
		100% { transform: translateX(100%); }
	}

	.skeleton-image {
		width: 100%;
		height: 200px;
		background: #e0e0e0;
	}

	.skeleton-text {
		height: 20px;
		width: 80%;
		margin: 10px auto;
	}

	textarea {
		width: 100%;
		height: 150px;
		padding: 12px 20px;
		box-sizing: border-box;
		border: 2px solid #ccc;
		border-radius: 4px;
		background-color: #f8f8f8;
		font-size: 16px;
		color: #302d2d;
		resize: none;
	}

	input[type="radio"] {
		width: 20px;
		height: 20px;
		padding-top: 20px;
	}
</style>

@stack('css')