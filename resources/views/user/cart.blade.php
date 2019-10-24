@extends('user.user-layout')

@section('content')

	<section class="page-title">
		    <div class="container">
		        <h2 class="title">
		            My Cart
		        </h2>
		        <ul class="brdcrumb clearfix">
		            <li>
		                <a href="index.html">Home</a>
		            </li>
		            <li class="current">
		                My Cart
		            </li>
		        </ul>
		    </div>
		</section>


        <!-- food details section -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <table class="table">
                      <thead>
                        <tr>
                          <th class="">Image</th>
                          <th>Food Name</th>
                          <th class="text-right">Price</th>
                          <th class="text-right">Qty</th>
                          <th class="text-right">Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      	 <form action="{{ URL('cart/confirm-order') }}" method="POST">
                      	 	@csrf
                      		@php ($total=0)

                      		@if(Session::has('stock_check_message'))
                      			<tr><td colspan="6" class="text-center alert-danger">{{ Session::get('stock_check_message') }}</td></tr>
                      		@endif

	                      	@foreach($cart as $foodInCart)
			                    <tr>
			                    	<input type="hidden" name="qty[]" value="{{$foodInCart->qty}}">
			                    	<input type="hidden" name="food_id[]" value="{{$foodInCart->food_id}}">

			                    	@php( $total+= ($foodInCart->food->price*$foodInCart->qty) )
			                    	
									<td>
										<div class="img-container">
											<img style="width:30%" src="{{ asset('/images/foods/img5c496d49744b5.jpg')}}" alt="...">
										</div>
									</td>
									<td class="">
										<a href="{{URL('food')}}/{{$foodInCart->food_id}}">{{$foodInCart->food->name}}</a>
									</td>
									<td class=" text-right">
										<small></small>{{$foodInCart->food->price}}
									</td>
									<td class="text-right">
										{{$foodInCart->qty}}
										<span>&nbsp&nbsp </span>
										<button onclick="qtyAdd($(this), {{$foodInCart->food_id}})" type="button" class="btn btn-round btn-info"> <i class="material-icons">add</i> </button>
										<button onclick="qtyMinus($(this), {{$foodInCart->food_id}})" type="button" class="btn btn-round btn-info"> <i class="material-icons">remove</i> </button>
										
									</td>
									<td class="text-right">
										<small></small>{{$foodInCart->qty*$foodInCart->food->price}}
									</td>
									<td class="">
										<button onclick="removeFromCart({{$foodInCart->id}},$(this))" type="button" class="btn btn-round btn-info"> <i class="material-icons">close</i> </button>
										
									</td>
			                    </tr>
	                        @endforeach

	                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        

	                        <tr>
	                          <td colspan="4"></td>
	                          <td class="td-total">
	                            Total
	                          </td>
	                          <td class="td-price">
	                            <small>&euro;</small>{{ $total }}
	                          </td>
	                        </tr>
	                        <tr>
	                          <td colspan="4"></td>
	                          <td colspan="2" class="text-right">
	                          	@if(empty($cart[0]->id))
	                          		<button id="confrim_order" type="submit" class="btn btn-info btn-round" disabled > Complete Purchase </button>
	                          	@else
	                          		<button id="confrim_order" type="submit" class="btn btn-info btn-round" > Complete Purchase </button>
	                          	@endif
	                          	
	                          </td>
	                        </tr>
	                    </form>

                      </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- food details section ends -->


    
@endsection



@section('modal-and-js')

	<script>
		function qtyMinus(thisRow, foodId){

			var qty 	= parseInt(thisRow.closest('td')[0].childNodes[0].nodeValue);

			if (qty>1) {

				$.ajaxSetup({
	                headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });

	            $.ajax({
	                url: '{{ url('cart/item/qtyminus') }}',
	                type: 'POST',
	                data: {food_id: foodId}
	               })
	               .done(function(data){
	               	console.log(data)
	               	var response = JSON.parse(data);

					var inputQty = parseInt(thisRow.closest('tr').find(":input:first").val());
					var price 	= parseInt(thisRow.closest('tr').find('td')[2].childNodes[2].nodeValue);
					var amount 	= parseInt(thisRow.closest('tr').find('td')[4].childNodes[2].nodeValue);
					var total 	= parseInt(thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue);

					thisRow.closest('td')[0].childNodes[0].nodeValue = (qty-1);
					thisRow.closest('tr').find('td')[4].childNodes[2].nodeValue  = (amount-price);
					thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue  = (total-price);
					//set input value
					thisRow.closest('tr').find(":input:first").val(inputQty-1);

					//show successfull message
					swal({
		                  type: 'success',
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
	                  title: 'fail to cancel item form order.',
	                  showConfirmButton: false,
	                  timer: 200
	                })
	            });

			}
			
		}

		function qtyAdd(thisRow, foodId){
			
			$.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('/cart/item/qtyplus') }}',
                type: 'POST',
                data: {food_id: foodId}
               })
               .done(function(data){
               	console.log(data)
               	var response = JSON.parse(data);

               	//get the value
				var inputQty = parseInt(thisRow.closest('tr').find(":input:first").val());
				var qty 	= parseInt(thisRow.closest('td')[0].childNodes[0].nodeValue);
				var price 	= parseInt(thisRow.closest('tr').find('td')[2].childNodes[2].nodeValue);
				var amount 	= parseInt(thisRow.closest('tr').find('td')[4].childNodes[2].nodeValue);
				var total 	= parseInt(thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue);

				//set the value
				thisRow.closest('tr').find(":input:first").val(inputQty+1);
				thisRow.closest('td')[0].childNodes[0].nodeValue = (parseInt(qty)+1);
				thisRow.closest('tr').find('td')[4].childNodes[2].nodeValue  = (amount+price);
				thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue  = (total+price);

				//show successfull message
				swal({
	                  type: 'success',
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
                  title: 'fail to cancel item form order.',
                  showConfirmButton: false,
                  timer: 200
                })
            });
		}

		function removeFromCart(cart_id, thisRow){

			var amount 	= parseInt(thisRow.closest('tr').find('td')[4].childNodes[2].nodeValue);
			var total 	= parseInt(thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue);

			thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue  = (total-amount);

			thisRow.closest('tr').remove();

			//disbale confirm button and enable save changes button
			$('#confrim_order').prop("disabled",true);
			$('#save_changes').prop("disabled",false);


			//show successfull message
			swal({
                  type: 'success',
                  position: 'top-end',
                  title: 'Item has been remove Sucessfully',
                  showConfirmButton: false,
                  timer: 1000
                })


        }

        

	</script>




@endsection