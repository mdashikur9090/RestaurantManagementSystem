<!DOCTYPE html>
<html lang="en">

<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<title> RMS </title>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
	<!-- CSS Files -->
	<link href="{{ asset('assets/css/material-dashboard.minf066.css?v=2.1.0') }}" rel="stylesheet" />

</head>

<body class="sidebar-mini">
	<div class="wrapper ">

		<!-- start sidebar -->
		<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">
	      <div class="logo">
	        <a href="#" class="simple-text logo-mini">
	          TB
	        </a>
	        <a href="#" class="simple-text logo-normal">
	          Tasty Bite
	        </a>
	      </div>
	      <div class="sidebar-wrapper">
	        <div class="user">
	          <div class="photo">
	            <img src="{{ asset('assets/img/faces/avatar.jpg') }}" />
	          </div>
	          <div class="user-info">
	            <a data-toggle="collapse" href="#collapseExample" class="username">
	              <span>
	                Admin
	              </span>
	            </a>
	            
	          </div>
	        </div>
	        @if(Auth::user()->user_type=="Admin")
	        	<ul class="nav">
		          <li class="nav-item active ">
		            <a class="nav-link" href="{{ url('/admin') }}">
		              <i class="material-icons">D</i>
		              <p> Dine In </p>
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="{{ url('/take-away') }}">
		              <i class="material-icons">T</i>
		              <p> Take Away </p>
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="{{ url('/report') }}">
		              <i class="material-icons">R</i>
		              <p> Report </p>
		            </a>
		          </li>
		          <li class="nav-item ">
		            <a class="nav-link" data-toggle="collapse" href="#foodsPages">
		              <i class="material-icons">image</i>
		              <p> Foods
		                <b class="caret"></b>
		              </p>
		            </a>
		            <div class="collapse" id="foodsPages">
		              <ul class="nav">
		                <li class="nav-item ">
		                  <a class="nav-link" href="{{ url('/admin/foods') }}">
		                    <span class="sidebar-mini"> F </span>
		                    <span class="sidebar-normal"> Foods </span>
		                  </a> 
		                </li>
		                <li class="nav-item ">
		                  <a class="nav-link"  href="{{ url('/food/create') }}" >
		                    <span class="sidebar-mini"> AD </span>
		                    <span class="sidebar-normal"> Add Food </span>
		                  </a>
		                </li>
		              </ul>
		            </div>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="{{ url('/ingridient') }}">
		              <i class="material-icons">I</i>
		              <p> Ingridients </p>
		            </a>
		          </li>
		        </ul>
	        @elseif(Auth::user()->user_type=="Kitchen")
	        	<ul class="nav">
		          <li class="nav-item active">
		            <a class="nav-link" href="{{ url('/kot') }}">
		              <i class="material-icons">K</i>
		              <p> KOT </p>
		            </a>
		          </li>
		        </ul>
	        @endif
	      </div>
	    </div>
		<!-- end sidebar -->

		<div class="main-panel">
	      	<!-- Navbar -->
			<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
				<div class="container-fluid">
				  <div class="navbar-wrapper">
				    <div class="navbar-minimize">
				      <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
				        <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
				        <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
				      </button>
				    </div>
				    <a class="navbar-brand" href="#pablo">Dashboard</a>
				  </div>
				  <div class="collapse navbar-collapse justify-content-end">
				    <ul class="navbar-nav">
				      <li class="nav-item dropdown">
				        <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          <i class="material-icons">person</i>
				          <p class="d-lg-none d-md-block">
				            Account
				          </p>
				        </a>
				        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
				          <a class="dropdown-item" href="#">Profile</a>
				          <a class="dropdown-item" href="#">Settings</a>
				          <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="{{ route('logout') }}"
	                           onclick="event.preventDefault();
	                                         document.getElementById('logout-form').submit();">
	                            {{ __('Logout') }}
	                        </a>
	                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                            @csrf
	                        </form>
				          <a id="log_out" class="dropdown-item"></a>
				        </div>
				      </li>
				    </ul>
				  </div>
				</div>
			</nav>
	      	<!-- End Navbar -->


	      	@yield('content')


	     </div>

	</div>


	<!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('assets/js/plugins/nouislider.min.js') }}"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js') }}"></script>
    <!--  Plugin for timer/ -->
    <script src="{{ asset('assets/js/plugins/easytimer.min.js') }}"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('assets/js/plugins/sweetalert2.js') }}"></script>
    <!-- Chartist JS -->
  	<script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>
    <!-- custom plagin -->
    <script src="{{ asset('assets/js/custom/my_function.js') }}"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  	<script src="../assets/js/material-dashboard.minf066.js?v=2.1.0" type="text/javascript"></script>
 	<!-- Material Dashboard DEMO methods, don't include it in your project! -->

    



    @yield('modal-and-js')

  

</body>

	

</html>

