@extends('tab.layout')

@section('content')

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
                    
                    
                </div>
                <div class="col-md-4">
                    <!-- food Cart  -->
                    <div class="food-card">
                        <h3 class="title">{{$food->name}}</h3>

                        <h3 class="title">
                            @if(!empty($isInCart) && $isInCart ==1 )
                                <div id="btnAddOrRemoveCart">
                                    <button  onclick="removeItemToCart({{$food->id}})" class="btn-primary">Remove From Cart</button>
                                </div>
                            @else
                                <div id="btnAddOrRemoveCart">
                                    <button id="btnAddOrRemoveCart" onclick="addItemToCart({{$food->id}})" class="btn-primary">Add To Cart</button>
                                </div>
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
	                    		@foreach($food->food_ingridients as $ingridient)
	                        		<li> {{$ingridient->ingridient->name}} </li>
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

            <!--  post comments section -->

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



        </section>
    </div>
    <!-- end food review -->

@endsection

@section('modal-and-js')
    <script>

        function addItemToCart(foodId){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('/tab/cart/add-item') }}',
                type: 'POST',
                data: {foodId: foodId, qty: 1}
               })
               .done(function(data){
                console.log(data);

                var markup = "<button onclick='removeItemToCart("+foodId+")' class='btn-primary'>Remove From Cart</button>";

                $("#btnAddOrRemoveCart").html(markup);

                swal({
                  type: 'success',
                  position: 'top-end',
                  title: 'This food added in cart Successfully ...',
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

        function removeItemToCart(foodId){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('tab/cart/remove-item') }}',
                type: 'POST',
                data: {foodId: foodId, qty: 1}
               })
               .done(function(data){
                console.log(data);

                var markup = "<button onclick='addItemToCart("+foodId+")' class='btn-primary'>Add To Cart</button>";
                $("#btnAddOrRemoveCart").html(markup);

                swal({
                  type: 'success',
                  position: 'top-end',
                  title: 'This food added in cart Successfully ...',
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

    </script>
@endsection

