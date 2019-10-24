<!DOCTYPE html>
<html>
<head>
	
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/lity.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/style.css') }}">
</head>
<body>
	<div class="wrapper">

		<!-- header -->
		<header class="header">
		    <div class="container">
		        <div class="menubar">
		            <div class="row">
		                <div class="col-md-12">
		                    <nav class="navbar navbar-static-top">
		                        <!-- Brand and toggle get grouped for better mobile display -->
		                        <div class="navbar-header">
		                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" aria-expanded="false">
		                                <span class="sr-only">Toggle navigation</span>
		                                <span class="icon-bar"></span>
		                                <span class="icon-bar"></span>
		                                <span class="icon-bar"></span>
		                            </button>
		                            <a class="navbar-brand" href="index.html">
		                                <img src="{{ asset('images/user/logo.png') }}" class="img-responsive" alt="logo">
		                            </a>
		                        </div>

		                        <!-- Collect the nav links, forms, and other content for toggling -->
		                        <div class="collapse navbar-collapse ">
		                            <ul class="nav navbar-nav navbar-right" id="main-menu">
		                                <li class="active">
		                                    <a href="{{url("tab/".session('tableid'))}}">Food menu</a>
		                                </li>
		                                <li>
		                                    <a href="{{url("/tab/dining/cart")}}">Cart</a>
		                                </li>
		                                <li>
		                                    <a href="{{url("/tab/order/".session('tableid'))}}">Order</a>
		                                </li>
		                            </ul>
		                        </div>
		                        <!-- /.navbar-collapse -->
		                    </nav>
		                </div>
		            </div>
		        </div>

		    </div>
		    <div class="mobile-menu" data-logo="{{ asset('images/user/logo.png') }}">

		    </div>
		</header>
		<!-- end header -->

		

		@yield('content')


		<!-- footer  -->
		<footer class="footer section-padding">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-4 col-sm-12">
		                <div class="footer-widget">
		                    <div class="row">
		                        <div class="col-xs-11 col-sm-10 col-md-9">
		                            <h3 class="main-title footer-title text-left">
		                                <span>
		                                    Gallery Pics
		                                </span>
		                            </h3>
		                        </div>
		                    </div>

		                    <div class="content">
		                        <ul class="gallery clearfix">
		                            <li>
		                                <div>
		                                    <a href="{{ asset('images/user/gal-big.jpg') }}" class="magni-link">
		                                        <img src="{{ asset('images/user/gal.jpg') }}" alt="gallery pic">
		                                    </a>
		                                </div>
		                            </li>
		                            <li>
		                                <div>
		                                    <a href="{{ asset('images/user/gal-big2.jpg') }}" class="magni-link">
		                                        <img src="{{ asset('images/user/gal2.jpg') }}" alt="gallery pic">
		                                    </a>
		                                </div>
		                            </li>
		                            <li>
		                                <div>
		                                    <a href="{{ asset('images/user/gal-big3.jpg') }}" class="magni-link">
		                                        <img src="{{ asset('images/user/gal3.jpg') }}" alt="gallery pic">
		                                    </a>
		                                </div>
		                            </li>
		                            <li>
		                                <div>
		                                    <a href="{{ asset('images/user/gal-big4.jpg') }}" class="magni-link">
		                                        <img src="{{ asset('images/user/gal4.jpg') }}" alt="gallery pic">
		                                    </a>
		                                </div>
		                            </li>
		                            <li>
		                                <div>
		                                    <a href="{{ asset('images/user/gal-big5.jpg') }}" class="magni-link">
		                                        <img src="{{ asset('images/user/gal5.jpg') }}" alt="gallery pic">
		                                    </a>
		                                </div>
		                            </li>
		                            <li>
		                                <div>
		                                    <a href="{{ asset('images/user/gal-big6.jpg') }}" class="magni-link">
		                                        <img src="{{ asset('images/user/gal6.jpg') }}" alt="gallery pic">
		                                    </a>
		                                </div>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</footer>
		<!-- footer ends -->

		<div class="copyright">
		    <p>
		        © Copyright | All Right Reserved Tasty Bites
		    </p>
		</div>

	</div>


	<!-- script -->
	<script src="{{ asset('js/jquery.1.12.4.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/user/plugins.js') }}"></script>
    <script src="{{ asset('js/user/main.js') }}"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('assets/js/plugins/sweetalert2.js') }}"></script>


    @yield('modal-and-js')


</body>
</html>