@extends('tab.layout')

@section('content')


        <!-- food details section -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                	<form action="{{ URL('tab/cart/confirm-order') }}" method="POST">
	                  	<table class="table">
	                      <thead>
	                        <tr>
	                          <th>Food Name</th>
	                          <th class="text-right">Price</th>
	                          <th class="text-right">Qty</th>
	                          <th class="text-right">Amount</th>
	                          <th>Action</th>
	                        </tr>
	                      </thead>
	                      <tbody>
	                      	 	@csrf
	                      		@php ($total=0)

	                      		@if(Session::has('stock_check_message'))
	                      			<tr><td colspan="5" class="text-center alert-danger">{{ Session::get('stock_check_message') }}</td></tr>
	                      		@endif

	                      		{{-- session('cartItems.'.$eachfood->id) means qty for this id form seasion --}}
	                      		@if(!empty($foodCart))
	                      			@foreach($foodCart as $eachfood)
					                    <tr>

					                    	@php( $total+= ($eachfood->price*$eachfood->qty) )
					                    	
											<td class="">
												<a href="{{URL('tab/food')}}/{{$eachfood->id}}">{{$eachfood->name}}</a>
											</td>
											<td class=" text-right">
												<small></small>{{$eachfood->price}}
											</td>
											<td class="text-right">
												{{$eachfood->qty}}
												<span>&nbsp&nbsp </span>
												<button onclick="qtyAdd($(this), {{$eachfood->id}})" type="button" class="btn btn-round btn-info"> <i class="material-icons">add</i> </button>
												<button onclick="qtyMinus($(this), {{$eachfood->id}})" type="button" class="btn btn-round btn-info"> <i class="material-icons">remove</i> </button>
												
											</td>
											<td class="text-right">
												<small></small>{{ $eachfood->price*$eachfood->qty }}
											</td>
											<td class="">
												<button onclick="removeFromCart($(this), {{$eachfood->id}})" type="button" class="btn btn-round btn-info"> <i class="material-icons">close</i> </button>
												
											</td>
					                    </tr>
			                        @endforeach
	                      		@endif
	                       
		                        <tr class="text-right">
		                          <td colspan="2"></td>
		                          <td class="td-total">
		                            Total
		                          </td>
		                          <td class="td-price">
		                            <small>&euro;</small>{{ $total }}
		                          </td>
		                          <td></td>
		                        </tr>
		                        <tr>
		                          <td colspan="3"></td>
		                          <td colspan="2" class="text-right">
		                          	@if(empty($foodCart[0]->id))
		                          		<button id="confrim_order" type="submit" class="btn btn-info btn-round" disabled > Confirm Order </button>
		                          	@else
		                          		<button id="confrim_order" type="submit" class="btn btn-info btn-round" > Confirm Order </button>
		                          	@endif
		                          </td>
		                        </tr>

	                      </tbody>
	                    </table>
                    </form>
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
	                url: '{{ url('/tab/cart/remove-qty') }}',
	                type: 'POST',
	                data: {foodId: foodId}
	               })
	               .done(function(response){
	               	console.log(response)

					var inputQty = parseInt(thisRow.closest('tr').find(":input:first").val());
					var price 	= parseInt(thisRow.closest('tr').find('td')[1].childNodes[2].nodeValue);
					var amount 	= parseInt(thisRow.closest('tr').find('td')[3].childNodes[2].nodeValue);
					var total 	= parseInt(thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue);

					thisRow.closest('td')[0].childNodes[0].nodeValue = (qty-1);
					thisRow.closest('tr').find('td')[3].childNodes[2].nodeValue  = (amount-price);
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
                url: '{{ url('/tab/cart/add-qty') }}',
                type: 'POST',
                data: {foodId: foodId}
               })
               .done(function(data){
               	console.log(data)
               	//var response = JSON.parse(data);

               	//get the value
				var inputQty = parseInt(thisRow.closest('tr').find(":input:first").val());
				var qty 	= parseInt(thisRow.closest('td')[0].childNodes[0].nodeValue);
				var price 	= parseInt(thisRow.closest('tr').find('td')[1].childNodes[2].nodeValue);
				var amount 	= parseInt(thisRow.closest('tr').find('td')[3].childNodes[2].nodeValue);
				var total 	= parseInt(thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue);

				//set the value
				thisRow.closest('tr').find(":input:first").val(inputQty+1);
				thisRow.closest('td')[0].childNodes[0].nodeValue = (parseInt(qty)+1);
				thisRow.closest('tr').find('td')[3].childNodes[2].nodeValue  = (amount+price);
				thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue  = (total+price);

				//show successfull message
				swal({
	                  type: 'success',
	                  position: 'top-end',
	                  title: 'Sucessfully',
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

		function removeFromCart(thisRow, foodId){

			$.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('/tab/cart/remove-item') }}',
                type: 'POST',
                data: {foodId: foodId}
               })
               .done(function(data){
               	console.log(data)

               	var amount 	= parseInt(thisRow.closest('tr').find('td')[3].childNodes[2].nodeValue);
				var total 	= parseInt(thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue);

				thisRow.closest('tbody').find("tr:nth-last-child(2)").find("td")[2].childNodes[2].nodeValue  = (total-amount);

				thisRow.closest('tr').remove();

				//show successfull message
				swal({
	                  type: 'success',
	                  position: 'top-end',
	                  title: 'Item has been remove Sucessfully',
	                  showConfirmButton: false,
	                  timer: 1000
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

        

	</script>




@endsection