@extends('admin.admin-layout')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">weekend</i>
                </div>
                <h3 class="card-title">Available</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <div class="btn btn-primary" id="basicUsage" >00:00:00</div>
                </div>
              </div>
            </div>
        </div> --}}
        

          @foreach($tables as $tbl)
            <div id="tbl{{$tbl->id}}" class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                  <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">weekend</i>
                    </div>
                    @if($tbl->order_id > 0 )
                      <h3 id="order_status_{{$tbl->id}}" class="card-title">{{$tbl->order_id}}</h3>
                    @else
                      <h3 id="order_status_{{$tbl->id}}" class="card-title">Available</h3>
                    @endif

                    @if($tbl->checkout_status == 1)
                      <h3 id="checkout_status_{{$tbl->id}}" class="card-title text-success">Want To Checkout</h3>
                    @else
                      <h3 id="checkout_status_{{$tbl->id}}" class="card-title text-success"></h3>
                    @endif
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <button type="button" class="modal-click btn btn-primary"  onclick="launch_side_modal({{$tbl->id}})" > {{$tbl->name}} </button>
                    </div>
                  </div>
                </div>
            </div>
          @endforeach
           
      </div>
    </div>
  </div>
@endsection

@section('modal-and-js')
	<!-- start modal -->
  <div class="modal fade" id="addTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Table</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
           <form id="frm_add_table">
              <div class="modal-body">            
                  <div class="form-group">
                    <label for="exampleEmail" class="bmd-label-floating">Table Name</label>
                    <input type="text" class="form-control" id="tbl_name" required="true" >
                  </div>
                  <div class="form-group">
                    <label for="examplePass" class="bmd-label-floating">Person Number</label>
                    <input type="number" min="1" class="form-control" id="person_number" required="true" >
                  </div>     
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="save_changes" onclick="addTable()" >Save changes</button>
              </div>
          </form>  
        </div>
      </div>
  </div>
  <!-- end modal -->


	<!-- start biling modal  -->
	<div class="modal right fade" id="right_side_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
	    <div class="modal-dialog" role="document">
	        <div class=" modal-content card card-wizard" data-color="rose" id="wizardProfile">
	          <form action="#" method="">
	            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
	            <div class="card-header text-center">
	              <h3 class="card-title">
	                Orders Items and Payment.
	              </h3>
	            </div>
	            <div class="wizard-navigation">
	              <ul class="nav nav-pills">
	                <li class="nav-item">
	                  <a class="nav-link active" href="#about" data-toggle="tab" role="tab">
	                    Order Items
	                  </a>
	                </li>
	                {{-- <li class="nav-item">
	                  <a class="nav-link" href="#account" data-toggle="tab" role="tab">
	                    Payments
	                  </a>
	                </li> --}}
	              </ul>
	            </div>
	            <div class="card-body">
	              <div class="tab-content">
	                <div class="tab-pane active" id="about">
	                  <div class="card">
	                    <div class="card-header card-header-icon card-header-rose">
	                      <div class="card-icon">
	                        <i class="material-icons">assignment</i>
	                      </div>
	                      <h4 class="card-title "> Item List</h4>
	                    </div>
	                    <div class="card-body table-full-width table-hover">
	                      <div class="table-responsive">
	                        <table id="update_rsm_tbl_data" class="table table-hover">
	                          <thead class="thead-light">
	                            <th> No</th>
	                            <th> Name</th>
	                            <th> Price</th>
	                            <th> Qty</th>
	                            <th> NetP</th>
	                          </thead>
	                          <tbody>
	                          </tbody>
	                        </table>
	                      </div>
	                    </div>
	                  </div>

	                </div>
	                <div class="tab-pane" id="account">

	                </div>
	              </div>
	            </div>
	            <div class="card-footer">
	              <div class="mr-auto">
	                {{-- <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous"> --}}
	              </div>
	              <div id="buttonSection" class="ml-auto">
	                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
	                <div>
                    {{-- <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" onclick="checkoutAndPrint()" name="chechhhkout" value="Checkout and Print Invoice"> --}}
                    {{-- <input type="button" class="btn btn-finish btn-fill btn-rose btn-wd" o value="Finish" style="display: none;">  --}}
                  </div>
	              </div>
	              <div class="clearfix"></div>
	            </div>
	          </form>
	        </div>

	    </div>
	</div>
	<!-- end biling modal  -->



  <!-- make a timer and change background color after a specific time -->
{{--     <script>
        var timer = new Timer();
        timer.start();
        timer.addEventListener('secondsUpdated', function (e) {
          if (timer.getTimeValues().seconds > 5) {
            document.getElementById("basicUsage").style.backgroundColor = "red";
            document.get
          }
            $('#basicUsage').html(timer.getTimeValues().toString());
        });
           
    </script --}}>


  <script>

    //logu out script
    document.getElementById("log_out").onclick = function() {
        window.location.href = "login.php";
      };

      $(document).ready(function() {
        // Initialise the wizard
        getFunction.initMaterialWizard();
        setTimeout(function() {
          $('.card.card-wizard').addClass('active');
        }, 600);
      });


      function addTable(){
        var name = document.getElementById('tbl_name').value;
        var person = document.getElementById('person_number').value;

        $.ajaxSetup({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
              type: "post",
              url: "{{ url('/admin/table') }}",
              data: {name: name, person: person}
            })
            .done(function(data){
                console.log(data);
                //var response = JSON.parse(data);
                document.getElementById('frm_add_table').reset();
                $("#addTable").modal('hide');
                swal({
                  type: response.status,
                  title: response.message,
                  showConfirmButton: false,
                  timer: 1000
                })
             })
             .fail(function(){
                swal({
                  type: 'error',
                  title: 'Something went wrong....!',
                  showConfirmButton: false,
                  timer: 1000
                })
              });
      }


      //billing modal section
      //$('#right_side_modal').modal({ show: false});
      function launch_side_modal(id){
          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

          $.ajax({
            type: "post",
            url: "{{ url('/admin/order-details') }}",
            data: {tableID: id}
           })
         .done(function(data){

            //console.log(data);
            var response = JSON.parse(data);

              //set empty all table row
              $("#update_rsm_tbl_data").find("tr:gt(0)").remove();
              $("#buttonSection div").remove();

              if (response.length>0) {

                  var totalPrice = 0;

                  for (var i=0; i<response.length; i++) {
                        totalPrice  += response[i].price*response[i].qty
                        var markup  = "<tr><td>"  + (i+1) 
                                + "</td><td>" + response[i].food_name
                                + "</td><td>" + response[i].price    
                                + "</td><td class='text-right'>" + response[i].qty 
                                + "</td><td class='text-right'>" + (response[i].price*response[i].qty)
                                + "</td></tr>";

                        $("#update_rsm_tbl_data tbody").append(markup);

                  }

                  //var vat = (totalPrice*.05);
                  //var serviceCharge = (totalPrice*.05);
                  //totalPrice  += (vat+serviceCharge);

                  //var addVatRow  = "<tr class='text-right'><td colspan='4'> Vat(5%) </td><td>"+vat+"</td></tr>";
                  //var addServiceChargerow  = "<tr class='text-right'><td colspan='4'> Service Charge(5%) </td><td>"+serviceCharge+"</td></tr>";
                  var addTotaltblRow  = "<tr class='thead-light text-right'><th colspan='4'> Total</th><th>"+totalPrice+"</th></tr>";

                  //$("#update_rsm_tbl_data tbody").append(addVatRow);
                  //$("#update_rsm_tbl_data tbody").append(addServiceChargerow);
                  $("#update_rsm_tbl_data tbody").append(addTotaltblRow);

                  var bntSection = "<div>"
                                      +"<input type='button' class='btn btn-next btn-fill btn-rose btn-wd' onclick='checkoutAndPrint("+id+")' name='checkout' value='Checkout And Print Invoice'>"
                                      // +"<input type='button' class='btn btn-finish btn-fill btn-rose btn-wd' onclick='checkoutAndPrint("+id+")' value='Finish'>" 
                                    +"</div>"

                  $("#buttonSection").append(bntSection);

              }
          
          $('#right_side_modal').modal("show");// this triggers your modal to display
          
         })
         .fail(function(){
              //set empty all table row
              $("update_rsm_tbl_data").find("tr:gt(0)").remove();
          
         });
      }


      // update order table data on every 10 seconds
      $(document).ready(function() {
         setInterval(updateTable, 10000);
      });
     
      function updateTable(){
        $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

        $.ajax({
            url: "{{ url('/admin/table-orders') }}",
            type: 'POST'
           })
           .done(function(data){
              console.log(data);
              var updateTblResponse = JSON.parse(data);

              if (updateTblResponse.length>0) {
                for (var i =0; i < updateTblResponse.length; i++) {
                  if (updateTblResponse[i].order_id > 0) {
                     document.getElementById("order_status_"+updateTblResponse[i].table_id).innerHTML = updateTblResponse[i].order_id;
                  }

                  if (updateTblResponse[i].checkout_status == 1) {
                    document.getElementById("checkout_status_"+updateTblResponse[i].table_id).innerHTML = "Want To Checkout";
                  }
                }

              }
            
            // $("#tbl").empty();
            
           })
           .fail(function(){
            
           });
      }
      // end updatetable


      function checkoutAndPrint(id){

        $.ajaxSetup({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
              type: "post",
              url: '{{ url('/admin/checkout/table') }}'+'/'+id,
              data: {name: ""}
            })
            .done(function(data){
                console.log(data);

                if (data.payment ==1 ) {
                  $("#right_side_modal").modal('hide');
                  window.open('{{ url('admin/invoice/order') }}'+'/'+id, '_blank');

                  
                  document.getElementById("order_status_"+id).innerHTML = "Available";
                  document.getElementById("checkout_status_"+id).innerHTML = "";
                }
                
                // swal({
                //   type: response.status,
                //   title: response.message,
                //   showConfirmButton: false,
                //   timer: 1000
                // })
            })
           .fail(function(){
              swal({
                type: 'error',
                title: 'Something went wrong....!',
                showConfirmButton: false,
                timer: 1000
              })
            });

      }



  </script>


    
@endsection


