@extends('user.user-layout')

@section('content')

	<section class="page-title">
                <div class="container">
                    <h2 class="title">
                        Food Detail
                    </h2>
                    <ul class="brdcrumb clearfix">
                        <li>
                            <a href="index">Home</a>
                        </li>
                        <li>
                            <a href="#">Pages</a>
                        </li>
                        <li class="current">
                            Food Details
                        </li>
                    </ul>
                </div>
    </section>

    <!-- food details section -->
    <section class="page-section foods-details-bg food-details  section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- food mega slider  -->
                    <div class="food-slider owl-carousel">
                        @foreach($food->food_image as $img)
                            <div class="item">
                                <img src="{{ asset('images/foods') }}/{{$img->img_name}}" alt="food pic">
                            </div>
                        @endforeach
                    </div>
                    <!-- food mega slider ends  -->
                    <!-- food thumb slider sync -->
                    <div class="food-thumb-slider-container">
                        <div class="thumb-slider-inner">
                            <div class="food-thumb-slider owl-carousel">

                                {{-- get food images --}}

                                @foreach($food->food_image as $img)
                                    <div class="item">
                                        <img src="{{ asset('images/foods') }}/{{$img->img_name}}" alt="food pic">
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- food thumb slider ends -->
                    <!-- description -->
                    <div class="row">
                        <div class="col-xs-11 col-sm-8 col-md-5">
                            <h3 class="main-title text-left">
                                <span>
                                    Description
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="description">
                        <p>{{$food->description}}</p>
                    </div>
                    <!-- description ends -->

                    <div class="row">
                        <div class="col-xs-11 col-sm-8 col-md-6">
                            <h3 class="main-title text-left">
                                <span>
                                    You May Also Like
                                </span>
                            </h3>
                        </div>
                    </div>
                    <!-- dish slider  -->
                    <div class="dish-slider testy-slider   owl-carousel" data-items="2" data-margin="20" data-loop="true" data-smart-speed="400"
                         data-dots="true" data-nav="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true"
                         data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false"
                         data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="4"
                         data-r-large-nav="false" data-r-large-dots="true">

                         @foreach( $similarFoods as $similarFood)
                            <div class="item">
                                <a href="/food/{{$similarFood->id}}">
                                    <img src="{{ asset('images/foods') }}/{{$similarFood->food_image[0]->img_name}}" alt="special dish">

                                    <span>{{$similarFood->name}}</span>
                                </a>
                            </div>
                        @endforeach

                        
                    </div>
                    <!-- dish slider ends -->
                </div>
                <div class="col-md-4">
                    <!-- food Cart  -->
                    <div class="food-card">
                        <h3 class="title">{{$food->name}}</h3>

                        <h3 class="title">
                            @if(Auth::user())
                                @if(!empty($foodInUserCart[0]->food_id) && $foodInUserCart[0]->food_id == $food->id )
                                    <div id="btnAddOrRemoveCart">
                                        <button  onclick="removeFromCart({{Auth::user()->id}},{{$food->id}})" class="btn-primary">Remove From Cart</button>
                                    </div>
                                @else
                                    <div id="btnAddOrRemoveCart">
                                        <button id="btnAddOrRemoveCart" onclick="addToCart({{Auth::user()->id}},{{$food->id}})" class="btn-primary">Add To Cart</button>
                                    </div>
                                @endif
                            @endif
                            
                        </h3>
    
                        <ul class="details clearfix">
                            <li>
                                CHEF :
                                <span>{{$food->chef}}</span>
                            </li>
                            <li>
                                Serve :
                                <span>{{$food->serve}}  People</span>
                            </li>
                            <li>
                                Review :
                                @if($food->total_vote > 0)
                                    @php($rating = round($food->total_rating_point/$food->total_vote))
                                    <span>
                                    @for($i = 0; $i<$rating; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </span>
                                @endif
                            </li>

                            <li>
                                Calories :
                                <span>{{$food->calories}} : kcal</span>
                            </li>
                            <li>
                                Cooking hours :
                                <span>{{$food->cooking_hours}} min</span>
                            </li>
                        </ul>


                        <p class="text-hard">Ingridients</p>
                        <ul class="food-list">

	                    	@if($food->food_ingridients)
	                    		@foreach($food->food_ingridients as $food_ingridient)
                                    <li> {{$food_ingridient->ingridient->name}} </li>
	                        		
	                        	@endforeach
	                    	@endif

                     	</ul>
                    </div>
                    <!-- food cart ends -->
                </div>
            </div>
        </div>
    </section>
    <!-- food details section ends -->

    <!-- food review section -->
    <div class="container">
        <section class="comment-section">
            <div class="row">
                <div class="col-xs-11 col-sm-6">
                    <h4 class="main-title text-left">
                        <span>
                            Recent Comments
                        </span>
                    </h4>


                </div>
            </div>

            <div class="comments">

                <!-- load all Commets -->
                <ul>
                    @if($food->comment)
                        @foreach($food->comment as $comment)
                            <li>
                                <div class="comment">
                                    <img src="{{ asset('images/user/comment-avatar.jpg') }}" alt="comment avatar" class="comment-avatar">
                                    <div class="com-info">
                                        <h5 class="c-name">{{$comment->user->user_name}}</h5>
                                        <span>{{$comment->created_at}}</span>
                                    </div>
                                    <p>{{$comment->comment}}</p>
                                    <a href="#" class="reply">
                                        <i class="fa fa-mail-reply"> </i>Reply
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    @endif

                </ul>


                
            </div>


           <!--  post comments section -->

           @guest

                <div class="row">
                    <div class="col-xs-11 col-sm-6">
                        <h4 class="main-title text-left">
                            <span>
                                Please sign in to post comment.
                            </span>
                        </h4>
                    </div>
                </div>


           @else
                <div class="row">
                    <div class="col-xs-11 col-sm-6">
                        <h4 class="main-title text-left">
                            <span>
                                Leave Comment
                            </span>
                        </h4>
                    </div>
                </div>
                <form action="{{ url('/comment')}}" method="POST" class="cmnt-form">
                    @csrf


                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="input-box">
                                <textarea class="form-control" name="comment" placeholder="your comment" required></textarea>
                                <input type="hidden" name="food_id" value="{{$food->id}}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>


                            <button type="submit" class="btn-secondry" value="Send Message">Post Comment</button>
                        </div>
                    </div>
                </form>
            @endguest

        </section>
    </div>
    <!-- end food review -->

@endsection

@section('modal-and-js')
    <script>

        function addToCart(userID, foodID){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('/cart/add') }}',
                type: 'POST',
                data: {user_id: userID, food_id: foodID, qty: 1}
               })
               .done(function(data){
                console.log(data);
                var response = JSON.parse(data);

                var markup = "<button onclick='removeFromCart("+userID+","+foodID+")'class='btn-primary'>Remove From Cart</button>";

                $("#btnAddOrRemoveCart").html(markup);

                swal({
                  type: response.status,
                  position: 'top-end',
                  title: response.message,
                  showConfirmButton: false,
                  timer: 500
                })
               })
               .fail(function(){
                swal({
                  position: 'top-end',
                  type: 'error',
                  title: 'fail to add into Cart.',
                  showConfirmButton: false,
                  timer: 500
                })
            });


        }

        function removeFromCart(userID, foodID){

                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                url: '{{ url('/cart/remove') }}',
                type: 'POST',
                data: {user_id: userID, food_id: foodID}
               })
               .done(function(data){
                console.log(data);
                var response = JSON.parse(data);

                var markup = "<button onclick='addToCart("+userID+","+foodID+")'class='btn-primary'>Add To Cart</button>";

                $("#btnAddOrRemoveCart").html(markup);

                swal({
                  type: response.status,
                  position: 'top-end',
                  title: response.message,
                  showConfirmButton: false,
                  timer: 1000
                })
               })
               .fail(function(){
                swal({
                  position: 'top-end',
                  type: 'error',
                  title: 'fail to add into Cart.',
                  showConfirmButton: false,
                  timer: 1000
                })
            });


        }
    </script>
@endsection

