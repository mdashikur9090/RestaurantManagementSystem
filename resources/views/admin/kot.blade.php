@extends('admin.admin-layout')

@section('content')

	<div class="content">
          <div class="container-fluid">

            <div class="row">
              <div class="col-lg-6 fixed">
                <h2 class="text-center">Dining Orders</h1>
                <div id="kot_dining_card" class="row">      
                    <div>
                      
                    </div>
                </div>
              </div>
              <div class="col-lg-6 fixed">
                <h2 class="text-center">Take Away Orders</h1>
                <div id="kot_takeaway_card" class="row">
                  <div>
                    
                  </div>      
                </div>
                
              </div>
              
            </div>

          </div>
      </div>

@endsection



@section('modal-and-js')

  <script>


    // update data on every 10 seconds
      $(document).ready(function() {
           diningOrders();
           takeAwayOrders();

           setInterval(diningOrders, 10000);
           setInterval(takeAwayOrders, 10000);
      });

    
  </script>

	
	<script>
 
      function diningOrders(){

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        $.ajax({
          url: '{{ url('/kot/dinning-orders') }}',
          type: 'GET'
         })
         .done(function(data){
          //console.log(data);
          var updateKotCard = JSON.parse(data);

            if (updateKotCard.length>0) {

              $("#kot_dining_card div").remove();

                for (var i =0; i < updateKotCard.length; i++) {
                  var markup = "<div style='width: 100%;'>"+
                                  "<div class='card card-stats'>"+
                                    "<div class='card-header card-header-warning card-header-icon'>"+
                                      "<h3 class='card-title'>"+updateKotCard[i].orderID+"</h3>"+
                                      "</div>"+
                                    "<div class='card-body'>"+
                                      "<table class='table'>"+
                                          "<thead>"+
                                            "<tr>"+
                                              "<th>No</th>"+
                                              "<th>Food Name</th>"+
                                              "<th>QTY</th>"+
                                              "<th>Cooking</th>"+
                                              "<th>Serve</th>"+
                                            "</tr>"+
                                          "</thead>"+
                                          "<tbody>"
                                    for (var j = 0; j < updateKotCard[i].orderItem.length; j++) {

                                    markup+= "<tr class='text-center'>"+
                                                  "<td>"+updateKotCard[i].orderItem[j].food_id+"</td>"+
                                                  "<td>"+updateKotCard[i].orderItem[j].food_name+"</td>"+
                                                  "<td>"+updateKotCard[i].orderItem[j].qty+"</td>"+
                                                  "<td class='td-actions'>"+
                                                    "<div class='togglebutton'>"+
                                                      "<label>"+
                                                        "<input onclick=toggleCookStatusUpdate("+updateKotCard[i].orderID+","+updateKotCard[i].orderItem[j].food_id+") type='checkbox'"

                                                            if (updateKotCard[i].orderItem[j].cook_status==1) {
                                                              markup+=" checked >"
                                                            }else{
                                                              markup+=">"
                                                            }
                                                        
                                    markup+=            "<span class='toggle'></span>"+
                                                      "</label>"+
                                                    "</div>"+
                                                  "</td>"+
                                                  "<td class='td-actions'>"+
                                                    "<div class='togglebutton'>"+
                                                      "<label>"+
                                                        "<input onclick=toggleServeStatusUpdate("+updateKotCard[i].orderID+","+updateKotCard[i].orderItem[j].food_id+") type='checkbox'"
                                                              if (updateKotCard[i].orderItem[j].serve_status==1) {
                                                              markup+=" checked >"
                                                            }else{
                                                              markup+=">"
                                                            }
                                    markup+=            "<span class='toggle'></span>"+
                                                      "</label>"+
                                                    "</div>"+
                                                  "</td>"+
                                              "</tr>"

                                      }

                                markup+= "</tbody>"+
                                      "</table>"+
                                    "</div>"+
                                    "<div class='card-footer'>"+
                                      "<div class='stats'>"+
                                        "<button onclick='foodServeComplete("+updateKotCard[i].orderID+")' type='button' class='btn btn-primary'>Complete</button>"+
                                      "</div>"+
                                    "</div>"+
                                  "</div>"+
                                "</div>"

                      
                      $("#kot_dining_card").append(markup);
                }

            }
          
          
         })
         .fail(function(){
          
         });

        
      }

      function takeAwayOrders(){

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        $.ajax({
          url: '{{ url('/kot/takeAway-orders') }}',
          type: 'GET'
         })
         .done(function(data){
          //console.log(data);
          var updateKotCard = JSON.parse(data);

            if (updateKotCard.length>0) {

              $("#kot_takeaway_card div").remove();
              
                for (var i =0; i < updateKotCard.length; i++) {
                  var markup = "<div id="+updateKotCard[i].orderID+" style='width: 100%; margin-left: 20px;' >"+
                                  "<div class='card card-stats'>"+
                                    "<div class='card-header card-header-warning card-header-icon'>"+
                                      "<h3 class='card-title'>"+updateKotCard[i].orderID+"</h3>"+
                                      "</div>"+
                                    "<div class='card-body'>"+
                                      "<table class='table'>"+
                                          "<thead>"+
                                            "<tr>"+
                                              "<th>No</th>"+
                                              "<th>Food Name</th>"+
                                              "<th>QTY</th>"+
                                              "<th>Cooking</th>"+
                                              "<th>Serve</th>"+
                                            "</tr>"+
                                          "</thead>"+
                                          "<tbody>"
                                    for (var j = 0; j < updateKotCard[i].orderItem.length; j++) {

                                    markup+= "<tr class='text-center'>"+
                                                  "<td>"+updateKotCard[i].orderItem[j].food_id+"</td>"+
                                                  "<td>"+updateKotCard[i].orderItem[j].food_name+"</td>"+
                                                  "<td>"+updateKotCard[i].orderItem[j].qty+"</td>"+
                                                  "<td class='td-actions'>"+
                                                    "<div class='togglebutton'>"+
                                                      "<label>"+
                                                        "<input onclick=toggleCookStatusUpdate("+updateKotCard[i].orderID+","+updateKotCard[i].orderItem[j].food_id+") type='checkbox'"

                                                            if (updateKotCard[i].orderItem[j].cook_status==1) {
                                                              markup+=" checked >"
                                                            }else{
                                                              markup+=">"
                                                            }
                                                        
                                    markup+=            "<span class='toggle'></span>"+
                                                      "</label>"+
                                                    "</div>"+
                                                  "</td>"+
                                                  "<td class='td-actions'>"+
                                                    "<div class='togglebutton'>"+
                                                      "<label>"+
                                                        "<input onclick=toggleServeStatusUpdate("+updateKotCard[i].orderID+","+updateKotCard[i].orderItem[j].food_id+") type='checkbox'"
                                                              if (updateKotCard[i].orderItem[j].serve_status==1) {
                                                              markup+=" checked >"
                                                            }else{
                                                              markup+=">"
                                                            }
                                    markup+=            "<span class='toggle'></span>"+
                                                      "</label>"+
                                                    "</div>"+
                                                  "</td>"+
                                              "</tr>"

                                      }

                                markup+= "</tbody>"+
                                      "</table>"+
                                    "</div>"+
                                    "<div class='card-footer'>"+
                                      "<div class='stats'>"+
                                        "<button onclick='foodServeComplete("+updateKotCard[i].orderID+")' type='button' class='btn btn-primary'>Complete</button>"+
                                      "</div>"+
                                    "</div>"+
                                  "</div>"+
                                "</div>"

                      
                      $("#kot_takeaway_card").append(markup);
                }

            }
          
          
         })
         .fail(function(){
          
         });


      }

		
  </script>

    <script>
        
        function toggleCookStatusUpdate(odrID, foodID){

    			$.ajaxSetup({
    		    	headers: {
    		      	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		    	}
              	});

          	$.ajax({
                url: '{{ url('/kot/update-cook-and-serve-status') }}',
                type: 'POST',
                data: {cook_or_serve: 'cook', order_id: odrID, food_id: foodID}
               })
               .done(function(data){
               	console.log(data);
         		var response = JSON.parse(data);

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
                  type: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 500
                })
            });


        }

        function toggleServeStatusUpdate(odrID, foodID){

        	$.ajaxSetup({
		    	headers: {
		      	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    	}
          	});

          $.ajax({
                url: '{{ url('/kot/update-cook-and-serve-status') }}',
                type: 'POST',
                data: {cook_or_serve: 'serve', order_id: odrID, food_id: foodID}
               })
               .done(function(data){
               	console.log(data);
         		var response = JSON.parse(data);

                swal({
                  position: 'top-end',
                  type: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 500
                })
               })
               .fail(function(){
                swal({
                  position: 'top-end',
                  type: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 500
                })
            });

 
        }

        function foodServeComplete(odrID){

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
                });

            $.ajax({
                url: '{{ url('/kot/update-cook-and-serve-status') }}',
                type: 'POST',
                data: {orderId: odrID, cStatus: "cStatus"}
               })
               .done(function(data){
                console.log(data);
                var response = JSON.parse(data);

                if (response.taskStatus) {
                  
                  $("#"+odrID).remove();
                }

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
                  type: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 500
                })
            });

        }
    
    </script>


@endsection
