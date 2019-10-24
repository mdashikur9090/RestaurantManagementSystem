@extends('tab.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- start running orders list-->
                @if(empty($order))
                	<h1>Orders List is empty</h1>
                @else
                	<h1>Orders</h1>
                  	<div style="background: #f7f7f9">
                      	<table style="background: #e9ecef" class="table ">
	                      <thead class="thead-light">
	                        <tr>
	                        	<th colspan="3">Date : {{$order->created_at}} </th>
	                          	<th colspan="2" class="">Invoie NO : {{$order->id}} </th>
	                        </tr>
	                      </thead>
	                    </table>

                        <table class="table">
	                       <thead>
		                        <tr>
		                          <th>Food Name</th>
		                          <th class="text-right">Price</th>
		                          <th class="text-right">Qty</th>
		                          <th class="text-right">Amount</th>
		                          <th class="text-right">Status</th>
		                          <th class="text-left">Order Cancel</th>
		                        </tr>
	                      	</thead>
	                        <tbody>

		                      		@php ( $total = 0)
                      			@foreach($order->orderItem as $orderItem)
                      				@php ( $total+= $orderItem->qty*$orderItem->food->price )

	                      			<tr>
										<td class="">
											<a href="{{URL('food')}}/{{$orderItem->food_id}}">{{$orderItem->food->name}}</a>
										</td>
										<td class=" text-right">
											<small></small>{{$orderItem->food->price}}
										</td>
										<td class="text-right">
											{{$orderItem->qty}}
											
										</td>
										<td class="text-right">
											<small></small>{{$orderItem->qty*$orderItem->food->price}}
										</td>
										<td class="text-right">
											@if($orderItem->cook_status == 1 && $orderItem->serve_status ==0)
												Cooking
											@elseif($orderItem->cook_status == 0 && $orderItem->serve_status ==0)
												Order Placed
											@else
												Deliveried
											@endif
											
										</td>
										<td class="text-left">
											@if($orderItem->cook_status == 0)
												<button onclick="cancelItemFormOrder($(this), {{$orderItem->id}} )" type="button" class="btn btn-round btn-danger"> <i class="material-icons">close</i> </button>
											@endif
											
										</td>
				                    </tr>

                      			@endforeach

		                      		<tr>
			                          <td colspan="2"></td>
			                          <td class="text-right">
			                            Total
			                          </td>
			                          <td class="text-right">
			                            <small>&euro;</small>{{$total}}
			                          </td>
			                          <td colspan="2"></td>
			                        </tr>
	                        </tbody>
                		</table>
            		<!-- for spacing for each order table -->
            		</div>
            		<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#checkoutModal" >Checkout</button>   
                @endif
                <!-- end running order list-->
            </div>
        </div>
    </div>

    
@endsection



@section('modal-and-js')

	@if(empty($order))
	@else
		<!-- start modal -->
		<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="checkoutModalCenterTitle">Rating</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form action="{{URL('/tab/checkout-with-ratting')}}" method="POST">
		      	@csrf
			      <div class="modal-body">
			      	@foreach($order->orderItem as $orderItem)
				      	<div class="row">
					      	<div class="col-sm-6">
					      		<h3>{{$orderItem->food->name}}</h3>
					      	</div>
					      	<div class="col-sm-6">
					      		<div class="rating">
					      			<input type="hidden" name="food_id[]" value="{{$orderItem->food_id}}">
									<label>
										<input type="radio" name="{{$orderItem->food_id}}" value="1" />
										<span class="icon">★</span>
									</label>
									<label>
										<input type="radio" name="{{$orderItem->food_id}}" value="2" />
										<span class="icon">★</span>
										<span class="icon">★</span>
									</label>
									<label>
										<input type="radio" name="{{$orderItem->food_id}}" value="3" />
										<span class="icon">★</span>
										<span class="icon">★</span>
										<span class="icon">★</span>   
									</label>
									<label>
										<input type="radio" name="{{$orderItem->food_id}}" value="4" />
										<span class="icon">★</span>
										<span class="icon">★</span>
										<span class="icon">★</span>
										<span class="icon">★</span>
									</label>
									<label>
										<input type="radio" name="{{$orderItem->food_id}}" value="5" />
										<span class="icon">★</span>
										<span class="icon">★</span>
										<span class="icon">★</span>
										<span class="icon">★</span>
										<span class="icon">★</span>
									</label>
					      		</div>
					      	</div>
				        </div> 
			      	@endforeach
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Rate and Checkout</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
	  <!-- end modal -->
	 @endif



	<script>

		function cancelItemFormOrder(thisRow, itemId){

			$.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('tab/order/item/cancel') }}',
                type: 'POST',
                data: {itemId: itemId}
               })
               .done(function(data){
               	console.log(data)
               	var response = JSON.parse(data);
               	thisRow.closest('tr').remove();
				//show successfull message
				swal({
	                  type: 'success',
	                  position: 'top-end',
	                  title: 'successfull',
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
                  timer: 1000
                })
            });

        }

        

	</script>




@endsection