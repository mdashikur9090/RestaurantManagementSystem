@extends('user.user-layout')

@section('content')


    <section class="page-title">
        <div class="container">
            <h2 class="title">
                Our Gallery
            </h2>
            <ul class="brdcrumb clearfix">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="#">Pages</a>
                </li>
                <li class="current">
                    Gallery Three Column
                </li>
            </ul>
        </div>
    </section>

    
    <section class="page-section gallery-measonary  gallery-bg section-padding">
            <div class="container">
                <div class="row gal-items" style="position: relative; height: 1179.7px;">

                    @if($galleryImage)
                        @foreach($galleryImage as $image)
                           <div class="col-md-4 col-sm-6 grid-item" style="position: absolute; left: 0%; top: 0px;">
                                <div class="grid-gal">
                                    <div class="gal-content">
                                        <div class="gal-pic">
                                            <img src="{{url("/images/foods/")}}/{{$image->img_name}}" alt="gallery pic">

                                        </div>
                                        <div class="gal-details">
                                            <h4 class="gal-title">
                                                <a href="#">  Your Title Here</a>
                                            </h4>
                                            <p>
                                                Dolor sit amet consectetuer adipiscn elita
                                                <br> commo ligul et.
                                            </p>
                                            <a href="{{url("/images/foods/")}}/{{$image->img_name}}" class="expand gallery-popup">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                </div>
                {{-- <div class="pagi m-top20">
                    <ul>
                        <li>
                            <a href="#"><i class="fa fa-angle-left"></i>Prev</a>
                        </li>
                        <li>
                            <a href="#" class="active">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">...</a>
                        </li>
                        <li>
                            <a href="#">Next<i class="fa fa-angle-right"></i></a>
                        </li>
                    </ul>
                </div> --}}
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

