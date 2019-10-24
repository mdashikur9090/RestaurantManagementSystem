@extends('admin.admin-layout')

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header card-header-rose card-header-icon">
              <div class="card-icon">
                <i class="material-icons">assignment</i>
              </div>
              <div class="row">
                  <div class="col-md-6">
                    <h4 class="card-title">All Ingridients</h4>
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addIngridientsModal">Add Ingridients</button>
                  </div>
                </div>
            </div>
                  
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Ingridient ID</th>
                      <th>Name</th>
                      <th>Measure As</th>
                      <th>Stock</th>
                      <th class="text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($ingridients as $ingridient)
                        <tr>
                            <td class="text-center">{{ $ingridient->id }}</td>
                            <td>{{ $ingridient->name }}</td>
                            <td>{{ $ingridient->measure_as }}</td>
                            <td>{{ $ingridient->stock }}</td>
                            <td class="td-actions text-right">
                              <button type="button" onclick="editIngridient('{{ $ingridient->id }}')" class="btn btn-info">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" onclick="view_log('{{ $ingridient->id }}')" class="btn btn-info">
                                <i class="material-icons">arrow_right_alt</i>
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
        <div class="col-md-6">
          <div class="card">
            <div class="card-header card-header-rose card-header-icon">
              <div class="card-icon">
                <i class="material-icons">assignment</i>
              </div>
                <div class="row">
                  <div class="col-md-4">
                    <h4 class="card-title">Ingridients Log</h4>
                  </div>
                  <div class="col-md-4">
                    <button type="button" id="btnload" class="btn btn-primary" value="" ="" disabled data-toggle="modal" data-target="#loadModal" >Load</button>
                  </div>
                  <div class="col-md-4">
                    <button type="button" id="btnUnload" class="btn btn-primary" value="" ="" disabled data-toggle="modal" data-target="#unloadModal" >Unload</button>
                  </div>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="log_tbl">
                  <thead>
                    <tr>
                      <th>Date & Time</th>
                      <th>Reason</th>
                      <th>Type</th>
                      <th class="text-right">Amount</th>
                      <th class="text-right">Net Amount</th>
                    </tr>
                  </thead>
                  <tbody>

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

<!-- start edit ingdidients modal -->
  <div class="modal fade" id="editIngridientsModal" tabindex="-1" role="dialog" aria-labelledby="addIngridientsModalsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Ingridients</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{URL('ingridient/update')}}" method="POST">
          @csrf
          <div class="modal-body">            
              <div class="form-group">
                <label for="" class="">Ingridients Name</label>
                <input type="text" class="form-control" id="ingridient_name" name="ingridient_name" required="true" >
                <input type="hidden" class="form-control" id="ingridient_id" name="ingridient_id" required="true" >
              </div>
              <div class="form-group">
                <select class="form-control" id="measure_as" id="measure_as">
                  <option class="form-control" value="Gram">Gram</option>
                  <option class="form-control" value="Piece">Piece</option>
                  <option class="form-control" value="Cups">Cups</option>
                  <option class="form-control" value="Teaspoons">Teaspoons</option>
                  <option class="form-control" value="Tablespoons">Tablespoons</option>
                </select>
              </div>     
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="save_changes" >Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end edit ingdidients modal -->

  <!-- add ingdidients start modal -->
  <div class="modal fade" id="addIngridientsModal" tabindex="-1" role="dialog" aria-labelledby="addIngridientsModalsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Ingridients</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">            
              <div class="form-group">
                <label for="exampleEmail" class="bmd-label-floating">Ingridients Name</label>
                <input type="text" class="form-control" id="addIngridient_name" required="true" >
              </div>
              <div class="form-group">
                <select class="form-control" id="addMeasure_as">
                  <option class="form-control" value="Gram">Gram</option>
                  <option class="form-control" value="Piece">Piece</option>
                  <option class="form-control" value="Cups">Cups</option>
                  <option class="form-control" value="Teaspoons">Teaspoons</option>
                  <option class="form-control" value="Tablespoons">Tablespoons</option>
                </select>
              </div>     
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="save_changes" onclick="addIngridients()" >Save changes</button>
          </div>
      </div>
    </div>
  </div>
  <!-- add ingdidients end modal -->


  <!-- start modal -->
  <div class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="addIngridientsModalsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Load Ingridient Amount</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form>
            <div class="modal-body">            
                <div class="form-group">
                  <label for="name" class="bmd-label-floating">Reason</label>
                  <input type="text" class="form-control" id="name" required >
                </div>  
                <div class="form-group">
                  <label for="amount" class="bmd-label-floating">Amount</label>
                  <input type="number" class="form-control" id="amount" required >
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_changes" onclick="storeLoad($(this))" >Save changes</button>
            </div>
          </form>
      </div>
    </div>
  </div>
  <!-- end modal -->

  <!-- start modal -->
  <div class="modal fade" id="unloadModal" tabindex="-1" role="dialog" aria-labelledby="addIngridientsModalsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">UnLoad Ingridient Amount</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form>
            <div class="modal-body">            
              <div class="form-group">
                <label for="name" class="bmd-label-floating">Reason</label>
                <input type="text" class="form-control" id="name" required >
              </div>  
              <div class="form-group">
                <label for="amount" class="bmd-label-floating">Amount</label>
                <input type="number" class="form-control" id="amount" required >
              </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_changes" onclick="storeWaste($(this))" >Save changes</button>
            </div>
          </form>
      </div>
    </div>
  </div>
  <!-- end modal -->






  <script>

      function addIngridients(){
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
              url: '{{ url('/ingridient') }}',
              type: 'POST',
              data: {ingridient_name: $('#addIngridient_name').val(), measure_as: $("#addMeasure_as option:selected").text()}
             })
             .done(function(data){
                  console.log(data);
                  var response = JSON.parse(data);

                  $('#addIngridient_name').val("");
                  $('#addIngridientsModal').modal("hide");// this triggers your modal to display

                  swal({
                    type: response.status,
                    position: 'top-end',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 500
                  })

                  //location.reload():


               })
               .fail(function(){
                  swal({
                    position: 'top-end',
                    type: 'error',
                    title: 'Request fail..',
                    showConfirmButton: false,
                    timer: 500
                  })
            });
        }

      function editIngridient(id){

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
                url: '{{ url('/ingridient/') }}'+'/'+id,
                type: 'GET',
               })
               .done(function(response){
                //console.log(response);

                document.getElementById('ingridient_id').value = response.id;
                document.getElementById('ingridient_name').value = response.name;
                document.getElementById('measure_as').value = response.measure_as;

                $('#editIngridientsModal').modal("show");

              
              
               })
               .fail(function(){
                
            });
      }


      //view order details
      function view_log(id){

        //enable load and unloadbutton
        $('#btnload').prop("disabled",false);
        $('#btnUnload').prop("disabled",false);
        //set ingridient value for each buton
        $('#btnload').attr('value', id);
        $('#btnUnload').attr('value', id);

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

          $.ajax({
            url: '{{ url('/admin/ingridient_log') }}',
            type: 'POST',
            data: {ingridientId:id},
           })
           .done(function(response){

              //console.log(data);

                //set empty all table row
                $("#log_tbl").find("tr:gt(0)").remove();

                if (response.length>0) {
                    for (var i=0; i<response.length; i++) {
                          var markup  = "<tr><td>" + response[i].created_at
                                  + "</td><td>" + response[i].name
                                  + "</td><td>" + response[i].type    
                                  + "</td><td class='text-right'>" + response[i].amount 
                                  + "</td><td class='text-right'>" + response[i].net_amount
                                  + "</td></tr>";

                      $("#log_tbl tbody").append(markup);

                    }

                    

                }

            
           })
           .fail(function(){
                //set empty all table row
                $("log_tbl").find("tr:gt(0)").remove();
            
           });
        }


      function storeLoad(frm){

        var ingridientId = $('#btnload').val();
        var name = frm.closest('form').find(":input#name").val();
        var amount = parseInt(frm.closest('form').find(":input#amount").val());


        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        $.ajax({
          url: '{{ url('/admin/add_ingridient_stock') }}',
          type: 'POST',
          data: {ingridientId:ingridientId, name:name, amount:amount},
         })
         .done(function(response){
            console.log(response);
            // empty all filed
            frm.closest('form').find(":input").val('');
            //hide modal
            $('#loadModal').modal('hide');
            swal({
                  type: 'success',
                  position: 'top-end',
                  title: 'Successfull',
                  showConfirmButton: false,
                  timer: 500
                })

          
         })
         .fail(function(){
              swal({
                  type: 'error',
                  position: 'top-end',
                  title: 'Failed',
                  showConfirmButton: false,
                  timer: 500
                })
          
         });
      }

      function storeWaste(frm){

        var ingridientId = $('#btnUnload').val();
        var name = frm.closest('form').find(":input#name").val();
        var amount = parseInt(frm.closest('form').find(":input#amount").val());


        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        $.ajax({
          url: '{{ url('/admin/remove_ingridient_stock') }}',
          type: 'POST',
          data: {ingridientId:ingridientId, name:name, amount:amount},
         })
         .done(function(response){
            console.log(response);
            // empty all filed
            frm.closest('form').find(":input").val('');
            //hide modal
            $('#unloadModal').modal('hide');
            swal({
                  type: 'success',
                  position: 'top-end',
                  title: 'Successfull',
                  showConfirmButton: false,
                  timer: 500
                })

          
         })
         .fail(function(){
              swal({
                  type: 'error',
                  position: 'top-end',
                  title: 'Failed',
                  showConfirmButton: false,
                  timer: 500
                })
          
         });
      }





  </script>


    
@endsection


