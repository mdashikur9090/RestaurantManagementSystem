@extends('user.user-layout')

@section('content')
    <section class="page-title">
        <div class="container">
            <h2 class="title">
                Food Menu
            </h2>
            <ul class="brdcrumb clearfix">
                <li>
                    <a href="index">Home</a>
                </li>
                <li>
                    <a href="#">Pages</a>
                </li>
                <li class="current">
                    Food Menu
                </li>
            </ul>
        </div>
    </section>

    <!-- menu section  -->
    <section class="food-menu-section food-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="main-title text-left">
                        <span class="bg-reverse">Food Dishes</span>
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

