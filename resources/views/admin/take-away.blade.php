@extends('admin.admin-layout')

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-rose card-header-icon">
              <div class="card-icon">
                <i class="material-icons">assignment</i>
              </div>
              <h4 class="card-title">Simple Table</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Order ID</th>
                      <th>Date</th>
                      <th class="text-right">Status</th>
                      <th class="text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($order_lists as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td class="text-right">Running</td>
                            <td class="td-actions text-right">
                              <button type="button" onclick="view_order_details('{{ $order->id }}')" class="btn btn-info">
                                <i class="material-icons">details</i>
                              </button>
                            </td>
                          </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
@endsection

@section('modal-and-js')


  <!-- start order details  -->
        <div class="modal right fade" id="right_side_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
            <div class="modal-dialog" role="document">
                <div class=" modal-content card card-wizard" data-color="rose" id="wizardProfile">
                  <form action="#" method="">
                    <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                    <div class="card-header text-center">
                      <h3 class="card-title">
                        Orders Items.
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
                                <table id="update_rsm_tbl_data" class="table">
                                  <thead class="thead-light">
                                    <th> No</th>
                                    <th> Name</th>
                                    <th> Price</th>
                                    <th> Qty</th>
                                    <th class="text-right"> NetP</th>
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
                        <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                      </div>
                      <div class="ml-auto">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        {{-- <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next">
                        <input type="button" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish" style="display: none;"> --}}
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </form>
                </div>

            </div>
          </div>
      <!-- order details  -->




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



      //view order details
      function view_order_details(id){

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

          $.ajax({
            url: '{{ url('/admin/order-details') }}',
            type: 'POST',
            data: {orderId:id},
           })
           .done(function(data){

              //console.log(data);
              var response = JSON.parse(data);

                //set empty all table row
                $("#update_rsm_tbl_data").find("tr:gt(0)").remove();

                if (response.length>0) {

                    var totalPrice = 0;

                    for (var i=0; i<response.length; i++) {
                          totalPrice  += response[i].price*response[i].qty
                          var markup  = "<tr class=''><td>"  + (i+1) 
                                  + "</td><td>" + response[i].food_name
                                  + "</td><td>" + response[i].price    
                                  + "</td><td>" + response[i].qty 
                                  + "</td><td class='text-right'>" + (response[i].price*response[i].qty)
                                  + "</td></tr>";

                          $("#update_rsm_tbl_data tbody").append(markup);

                    }

                    //var vat = (totalPrice*.05);
                    //var serviceCharge = (totalPrice*.05);
                    //totalPrice  += (vat+serviceCharge);

                    //var addVatRow  = "<tr class='table-danger'><td colspan='2'> Vat </td><td colspan='2'> percentage(5%) </td><td>"+vat+"</td></tr>";
                    //var addServiceChargerow  = "<tr class='table-danger'><td colspan='2'> Service Charge </td><td colspan='2'> percentage(5%) </td><td>"+serviceCharge+"</td></tr>";
                    var addTotaltblRow  = "<tr class='thead-light text-right'><th colspan='4'> Total</th><th>"+totalPrice+"</th></tr>";

                    //$("#update_rsm_tbl_data tbody").append(addVatRow);
                    //$("#update_rsm_tbl_data tbody").append(addServiceChargerow);
                    $("#update_rsm_tbl_data tbody").append(addTotaltblRow);

                }
            
            $('#right_side_modal').modal("show");// this triggers your modal to display
            
           })
           .fail(function(){
                //set empty all table row
                $("update_rsm_tbl_data").find("tr:gt(0)").remove();
            
           });
        }





  </script>


    
@endsection


