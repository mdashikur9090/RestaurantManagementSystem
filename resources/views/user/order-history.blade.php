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
		                Order History
		            </li>
		        </ul>
		    </div>
		</section>


        <!-- food details section -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- start running orders list-->
                    <h1>Running Orders</h1>
                    @if(empty($runningOrder))

                    @else
	                  	@foreach($runningOrder as $Order)

		                  	<div style="background: #f7f7f9">

		                      	<table style="background: #e9ecef" class="table ">
			                      <thead class="thead-light">
			                        <tr>
			                        	<th colspan="3">Date : {{$Order->created_at}} </th>
			                          	<th colspan="2" class="">Invoie NO : {{$Order->id}} </th>
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
				                          <th class="text-left">Cancel Order</th>
				                        </tr>
			                      	</thead>
			                        <tbody>

				                      		@php ( $total = 0)
		                      			@foreach($Order->orderItem as $orderItem)
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
	                		        
	                    @endforeach
                    @endif

                    <!-- end running order list-->


                    <!-- start Comple order list-->
                    <h1>Completed Orders</h1>
                    @if(empty($completedOrder))
                    	<!-- empty completedOrder-->
                    @else
                    	<!-- start running orders list-->
	                  	@foreach($completedOrder as $Order)

		                  	<div style="background: #f7f7f9">

		                      	<table style="background: #e9ecef" class="table ">
			                      <thead class="thead-light">
			                        <tr>
			                        	<th colspan="3">Date : {{$Order->created_at}} </th>
			                          	<th colspan="2" class="">Invoie NO : {{$Order->id}} </th>
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
				                        </tr>
			                      	</thead>
			                        <tbody>

				                      		@php ( $total = 0)
		                      			@foreach($Order->orderItem as $orderItem)
		                      				@php ( $total+= $orderItem->qty*$orderItem->food->price)

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
													Delivered
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
					                          <td></td>
					                        </tr>
			                        </tbody>
		                		</table>

		            		<!-- for spacing for each order table -->
		            		</div>
	                		        
	                    @endforeach
                    @endif


                    <!-- end Comple order list-->

	                        
	                        
	                        
	                  
                      
                </div>
            </div>
        </div>
        <!-- food details section ends -->


    
@endsection



@section('modal-and-js')

	<script>
		
		function cancelItemFormOrder(thisRow, itemId){

			$.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('/cancel-order-item') }}',
                type: 'POST',
                data: {itemId: itemId }
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
	                  timer: 2000
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