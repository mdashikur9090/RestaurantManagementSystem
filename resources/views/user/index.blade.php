@extends('user.user-layout')

@section('content')
	<section class="sliders">
                <div class="testy-slider owl-carousel" data-items="1" data-loop="true" data-smart-speed="400" data-dots="true" data-nav="true"
                     data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="true" data-r-x-medium="1" data-r-x-medium-nav="false"
                     data-r-x-medium-dots="true" data-r-small="1" data-r-small-nav="true" data-r-small-dots="true" data-r-medium="1"
                     data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="1" data-r-large-nav="true" data-r-large-dots="false">

                    <div class="item">
                        <img src="images/user/slider.jpg" alt="slider image">
                        <div class="container">
                            <div class="slider-text">

                                <h2>
                                    Welcome To
                                    <span>Tasty Bite</span>
                                </h2>
                                <p class="slide-desc">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semp libero, sit amet adipiscing sem.</p>
                                {{-- <a href="reservation.html" class="btn-custom">Reserve now</a> --}}

                                <div class="hours-box">
                                    <h3>Restaurant Hours</h3>

                                    <div class="row">
                                        <!-- hours  -->
                                        <div class="col-xs-6">
                                            <div class="hours">
                                                <div class="icon">
                                                    <i class="flaticon-coffee"></i>
                                                </div>
                                                <h4 class="hours-title">Breakfast</h4>
                                                <p class="hours-text">9:00AM - 11:30AM</p>
                                            </div>
                                        </div>
                                        <!-- hours ends  -->
                                        <!-- hours  -->
                                        <div class="col-xs-6">
                                            <div class="hours">
                                                <div class="icon">
                                                    <i class="flaticon-chicken"></i>
                                                </div>
                                                <h4 class="hours-title">Lunch</h4>
                                                <p class="hours-text">11:30AM - 2:00PM</p>
                                            </div>
                                        </div>
                                        <!-- hours ends  -->
                                        <!-- hours  -->
                                        <div class="col-xs-6">
                                            <div class="hours">
                                                <div class="icon">
                                                    <i class="flaticon-restaurant-4"></i>
                                                </div>
                                                <h4 class="hours-title">Dinner</h4>
                                                <p class="hours-text">5:30PM - 11:00PM</p>
                                            </div>
                                        </div>
                                        <!-- hours ends  -->
                                        <!-- hours  -->
                                        <div class="col-xs-6">
                                            <div class="hours">
                                                <div class="icon">
                                                    <i class="flaticon-ice-cream"></i>
                                                </div>
                                                <h4 class="hours-title">Dessert</h4>
                                                <p class="hours-text">9:00AM - 11:00PM</p>
                                            </div>
                                        </div>
                                        <!-- hours ends  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="images/user/slider.jpg" alt="slider image">
                        <div class="container">
                            <div class="slider-text">
                                <h2>
                                    Welcome To
                                    <span>Tasty Bite</span>
                                </h2>
                                <p class="slide-desc">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semp libero, sit amet adipiscing sem.</p>
                                <a href="reservation.html" class="btn-custom">Reserve now</a>
                                <div class="hours-box">
                                    <h3>Restaurant Hours</h3>

                                    <div class="row">
                                        <!-- hours  -->
                                        <div class="col-xs-6">
                                            <div class="hours">
                                                <div class="icon">
                                                    <i class="flaticon-coffee"></i>
                                                </div>
                                                <h4 class="hours-title">Breakfast</h4>
                                                <p class="hours-text">9:00AM - 11:30AM</p>
                                            </div>
                                        </div>
                                        <!-- hours ends  -->
                                        <!-- hours  -->
                                        <div class="col-xs-6">
                                            <div class="hours">
                                                <div class="icon">
                                                    <i class="flaticon-chicken"></i>
                                                </div>
                                                <h4 class="hours-title">Lunch</h4>
                                                <p class="hours-text">11:30AM - 2:00PM</p>
                                            </div>
                                        </div>
                                        <!-- hours ends  -->
                                        <!-- hours  -->
                                        <div class="col-xs-6">
                                            <div class="hours">
                                                <div class="icon">
                                                    <i class="flaticon-restaurant-4"></i>
                                                </div>
                                                <h4 class="hours-title">Dinner</h4>
                                                <p class="hours-text">5:30PM - 11:00PM</p>
                                            </div>
                                        </div>
                                        <!-- hours ends  -->
                                        <!-- hours  -->
                                        <div class="col-xs-6">
                                            <div class="hours">
                                                <div class="icon">
                                                    <i class="flaticon-ice-cream"></i>
                                                </div>
                                                <h4 class="hours-title">Dessert</h4>
                                                <p class="hours-text">9:00AM - 11:00PM</p>
                                            </div>
                                        </div>
                                        <!-- hours ends  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <!-- service section  -->
    <section class="service-section service-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xs-11">
                    <h2 class="main-title text-left">
                        <span>Services</span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-sm-6 col-md-12">
                            <div class="service">
                                <div class="icon">
                                    <i class="flaticon-cake"></i>
                                </div>
                                <h4 class="service-title">Birthday Party</h4>
                                <p>
                                    Dolor sit amet consectetuer adipiscn elit commodo ligula eget dolor. Aenean etsa massa Cum sociis natoque.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <div class="service">
                                <div class="icon">
                                    <i class="flaticon-catering"></i>
                                </div>
                                <h4 class="service-title">Charity Events</h4>
                                <p>
                                    Dolor sit amet consectetuer adipiscn elit commodo ligula eget dolor. Aenean etsa massa Cum sociis natoque.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="service-chef-figure">
                        <img src="images/user/service-chef.png" class="img-responsive" alt="service chef">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-sm-6 col-md-12">
                            <div class="service">
                                <div class="icon">
                                    <i class="flaticon-fast-food"></i>
                                </div>
                                <h4 class="service-title">Events Party</h4>
                                <p>
                                    Dolor sit amet consectetuer adipiscn elit commodo ligula eget dolor. Aenean etsa massa Cum sociis natoque.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <div class="service">
                                <div class="icon">
                                    <i class="flaticon-table"></i>
                                </div>
                                <h4 class="service-title">Private Dinning</h4>
                                <p>
                                    Dolor sit amet consectetuer adipiscn elit commodo ligula eget dolor. Aenean etsa massa Cum sociis natoque.
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- service section  -->
    <!-- menu section  -->
    <section class="food-menu-section food-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="main-title text-left">
                        <span class="bg-reverse">Our Menu</span>
                    </h2>
                </div>
            </div>

            <ul class="menus sort-foods">
                <li class="filter-button active" data-filter="*">
                    <i class="flaticon-tray-1"></i>

                    All
                </li>
                <!-- load all food type -->

                @if($food_type)
                    @foreach($food_type as $type)
                        <li class="filter-button" data-filter=".{{$type->name}}">
                            <i class="flaticon-coffee"></i>
                            {{$type->name}}
                        </li>
                    @endforeach
                @endif

            </ul>

            <div class="row food-items">
                <!-- menu box  -->
                @if($foods)
                    @foreach($foods as $food)
                         <!-- menu box  -->
                        <div class="col-md-4 col-sm-6 col-xs-12 grid-item {{$food->food_type->name}}">
                            <div class="menu-box">

                                <a href="food/{{$food->id}}">
                                    <img src="{{url("/images/foods/")}}/{{$food->food_image->first()->img_name}}" alt="menu pic" class="featured-pic">
                                </a>
                                <div class="menu-title">
                                    <h5 class="title bg-main">
                                        <a href="food/{{$food->id}}">{{$food->name}}</a>
                                    </h5>
                                    <span>
                                        {{$food->price}}
                                    </span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, sectetuera con adipiscing elitan.</p>
                            </div>
                        </div>
                        <!-- menu box ends  -->
                    @endforeach
                @endif
            </div>
        </div>

    </section>
    <!-- menu section ends -->

    <!-- call out section  -->
    <section class="call-out-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Experience the real taste of our food.</h2>
                </div>
                <div class="col-md-2">
                    <div class="call-out-btn">
                        <a href="contact.html" class="btn-custom">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- call out section ends -->

@endsection

