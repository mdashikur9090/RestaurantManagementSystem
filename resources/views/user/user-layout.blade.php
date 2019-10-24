<!DOCTYPE html>
<html>
<head>
	
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasty bite</title>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link rel="icon" href="favicon.ico" type="images/user/ico" sizes="16x16">
    <!-- Place favicon.ico in the root directory -->
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
	<!-- ====== scroll to top ====== -->
    <a id="toTopBtn" title="Go to top" href="javascript:void(0)">
        <i class="fa fa-chevron-up"></i>
    </a>

    <!-- loader -->
	<div class="loader">
	    <h1>Loadings..</h1>
	    <div id="cooking">
	        <div class="bubble"></div>
	        <div class="bubble"></div>
	        <div class="bubble"></div>
	        <div class="bubble"></div>
	        <div class="bubble"></div>
	        <div id="area">
	            <div id="sides">
	                <div id="pan"></div>
	                <div id="handle"></div>
	            </div>
	            <div id="pancake">
	                <div id="pastry"></div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- end loader -->

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

		                        	<ul class="nav navbar-nav navbar-right">
		                        		@if(Auth::user())
			                                <li class="dropdown">
			                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			                                        {{ Auth::user()->name }}
			                                        <span class="caret"></span>
			                                    </a>
			                                    <ul class="dropdown-menu">

			                                    	<li>
					                                    <a href="{{url('/cart')}}" class="book-btn">Cart</a>
					                                </li>

			                                    	<li>
					                                	<a href="#">
					                                		Profile
					                                	</a>
					                                </li>
					                                <li>
					                                	<a href="{{url('/order-history')}}">
					                                		Order History
					                                	</a>
					                                </li> 

			                                        <li>
			                                        	<a class="dropdown-item" href="{{ route('logout') }}"
					                                       onclick="event.preventDefault();
					                                                     document.getElementById('logout-form').submit();">
					                                        {{ __('Logout') }}
					                                    </a>

					                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					                                        @csrf
					                                    </form>
					                                </li>

			                                    </ul>
			                                </li>
			                                @endif
		                                
		                            </ul>
		                            
		                            <ul class="nav navbar-nav navbar-right" id="main-menu">
		                                <li class="active">
		                                    <a href="/">
		                                        Home
		                                    </a>
		                                </li>
		                                <li >
		                                    <a href="{{url("/food-menu")}}">Food menu</a>
		                                </li>
		                                <li>
		                                    <a href="gallery">Gallery</a>
		                                </li>
		                                @if(!Auth::user())
                                        	<li>
			                                    <a href="{{url("/login")}}">Login</a>
			                                </li>
                                        @endif
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
		            <div class="col-md-4 col-sm-6">
		                <div class="footer-widget">
		                    <div class="row">
		                        <div class="col-xs-11 col-sm-10 col-md-9">
		                            <h3 class="main-title footer-title text-left">
		                                <span>
		                                    Contact Us
		                                </span>
		                            </h3>
		                        </div>
		                    </div>

		                    <div class="content">
		                        <p>
		                            <i class="fa fa-map-marker"> </i>
		                            <span>ADDRESS :</span>123, Street Name, City, Your Country
		                        </p>
		                        <p>
		                            <i class="fa fa-phone"> </i>
		                            <span>CALL US :</span>+123-456-7890, +987-654-3210
		                        </p>
		                        <p>
		                            <i class="fa fa-envelope-o"> </i>
		                            <span>EMAIL US :</span>support@ tastybite.com
		                        </p>
		                        <h5>Follow us on :</h5>
		                        <ul class="mini-social">
		                            <li>
		                                <a href="#">
		                                    <i class="fa fa-facebook"></i>
		                                </a>
		                            </li>
		                            <li>
		                                <a href="#">
		                                    <i class="fa fa-google-plus"></i>
		                                </a>
		                            </li>
		                            <li>
		                                <a href="#">
		                                    <i class="fa fa-instagram"></i>
		                                </a>
		                            </li>
		                            <li>
		                                <a href="#">
		                                    <i class="fa fa-twitter"></i>
		                                </a>
		                            </li>
		                            <li>
		                                <a href="#">
		                                    <i class="fa fa-linkedin"></i>
		                                </a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-4 col-sm-6">
		                <div class="footer-widget">
		                    <div class="row">
		                        <div class="col-xs-11 col-sm-10 col-md-9">
		                            <h3 class="main-title footer-title text-left">
		                                <span>
		                                    Latest News
		                                </span>
		                            </h3>
		                        </div>
		                    </div>

		                    <ul class="posts clearfix">
		                        <li>
		                            <a href="blog-detail-page.html">
		                                <img src="{{ asset('images/user/post.jpg') }}" alt="" class="featured">
		                            </a>
		                            <h5>
		                                <a href="blog-detail-page.html">
		                                    Lorem ipsum dolor sit amet, consectetu era adipiscing ligula.
		                                </a>
		                            </h5>
		                            <p>December 14, 2017</p>
		                        </li>
		                        <li>
		                            <a href="blog-detail-page.html">
		                                <img src="{{ asset('images/user/post2.jpg') }}" alt="" class="featured">
		                            </a>
		                            <h5>
		                                <a href="blog-detail-page.html">
		                                    Lorem ipsum dolor sit amet, consectetu era adipiscing ligula.
		                                </a>
		                            </h5>
		                            <p>December 14, 2017</p>
		                        </li>
		                    </ul>
		                </div>


		            </div>
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
		        © Copyright | RMS 2019. All Right Reserved Developed By
		        <a href="#">Company Name</a>
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