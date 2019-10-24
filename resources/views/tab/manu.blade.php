@extends('tab.layout')

@section('content')

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

            {{-- @php ( Session::put('message', 'Thanks you so much.. Come again sir...'))
            @if( Session::has('message') )
                <script>
                  swal({
                      position: 'top-end',
                      type: 'success',
                      title: 'Thanks you so much.. Come again sir...',
                      showConfirmButton: false,
                      timer: 5000
                    })
                </script>
            @endif --}}


            <div class="row food-items">
                <!-- menu box  -->
                @if($foods)
                    @foreach($foods as $food)
                         <!-- menu box  -->
                        <div class="col-md-12 col-sm-12 grid-item {{$food->food_type->name}}">
                            <div class="menu-box">

                                <a href="{{URL('tab/food/'.$food->id)}}">
                                    <img src="{{url("/images/foods/")}}/{{$food->food_image->first()->img_name}}" alt="menu pic" class="featured-pic">
                                </a>
                                <div class="menu-title">
                                    <h5 class="title bg-main">
                                        <a href="{{URL('tab/food/'.$food->id)}}">{{$food->name}}</a>
                                    </h5>
                                    <span>
                                        {{$food->price}}
                                    </span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, sectetuera con adipiscing elitan.</p>
                                <div id="btnAddOrRemoveCart_{{$food->id}}">
                                    @if( Session::has('cartItems.'.$food->id) )
                                        <button onclick="removeItemToCart({{$food->id}})" type="button" class="btn btn-round btn-info"><i class="material-icons">remove_shopping_cart</i></button>
                                    @else
                                        <button onclick="addItemToCart({{$food->id}})" type="button" class="btn btn-round btn-info"><i class="material-icons">add_shopping_cart</i></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- menu box ends  -->
                    @endforeach
                @endif
            </div>
        </div>

    </section>


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
                //var response = JSON.parse(data);

                var markup = "<button onclick='removeItemToCart("+foodId+")' type='button' class='btn btn-round btn-info'><i class='material-icons'>remove_shopping_cart</i></button>";

                $("#btnAddOrRemoveCart_"+foodId).html(markup);

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

                var markup = "<button onclick='addItemToCart("+foodId+")' type='button' class='btn btn-round btn-info'><i class='material-icons'>add_shopping_cart</i></button>";

                $("#btnAddOrRemoveCart_"+foodId).html(markup);

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
