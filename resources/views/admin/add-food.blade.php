@extends('admin.admin-layout')

@section('content')
  <div class="content">
    <div class="container-fluid">

       
      @if ($errors->any())
              <div class="alert alert-danger col-md-12">{{ implode('', $errors->all(':message')) }}</div>
      @endif

      {!! Form::open(['url' => 'food', 'id'=>'fmr-addtable', 'enctype'=>'multipart/form-data']) !!}
        <div class="row">
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">contacts</i>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <h4 class="card-title">Food Informatio</h4>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFoodTypeModal">Add Food Type</button>
                  </div>
                </div>
              </div>
              <div class="card-body ">
                <div class="form-horizontal">
                  <div class="row">
                    <label class="col-md-3 col-form-label">Food Name *</label>
                    <div class="col-md-9">
                      <div class="form-group has-default">
                        <input type="text" class="form-control" name="food_name" required >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Description *</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <textarea class="form-control" rows="8"  name="description" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Price *</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="number" min="1" class="form-control" name="price" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Cooking Time (mins) *</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="number" min="1" class="form-control" name="cooking_hours" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Serve Person *</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="number" min="1" class="form-control" name="serve" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Calories *</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="number" min="1" class="form-control" name="calories" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Chef *</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="chef" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Type *</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select name="food_type_id" required>
                          
                                  @foreach($food_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                  @endforeach

                          
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">mail_outline</i>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <h4 class="card-title">Food Ingridients</h4>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addIngridientsModal">Add Ingridients</button>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-primary" onclick="addIngridientsRow()" >Add Row</button>
                  </div>
                </div>
              </div>
              <div class="card-body ">
                  <table class="table" id="ingridients_table">
                    <thead>
                      <tr>
                        <th>Name(Count As)</th>
                        <th>Amount</th>
                        <th class="text-right">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">mail_outline</i>
                </div>
                <h4 class="card-title">Food Images</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-3 col-sm-6">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail">
                        <img src="{{ asset('assets/img/image_placeholder.jpg') }}" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div>
                        <span class="btn btn-rose btn-round btn-file">
                          <span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="food_img[]" required/>
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="{{ asset('assets/img/image_placeholder.jpg') }}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="food_img[]" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail">
                        <img src="{{ asset('assets/img/image_placeholder.jpg') }}" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div>
                        <span class="btn btn-rose btn-round btn-file">
                          <span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="food_img[]" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="{{ asset('assets/img/image_placeholder.jpg') }}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="food_img[]" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                {{ Form::submit('Save Food',  ['class' => 'btn btn-fill btn-rose', 'name' => 'submit']) }}
              </div>
            </div>
          </div>       
        </div>
      {!! Form::close() !!}

    </div>
  </div>

@endsection

@section('modal-and-js')


  <!-- start modal -->
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
                <input type="text" class="form-control" id="ingridient_name" required="true" >
              </div>
              <div class="form-group">
                <select class="form-control" id="measure_as">
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
  <!-- end modal -->

  <!-- start modal -->
  <div class="modal fade" id="addFoodTypeModal" tabindex="-1" role="dialog" aria-labelledby="addIngridientsModalsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Food Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">            
              <div class="form-group">
                <label for="exampleEmail" class="bmd-label-floating">Food Type Name</label>
                <input type="text" class="form-control" id="food_type_name" required="true" >
              </div>    
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="addFoodType()" >Save changes</button>
          </div>
      </div>
    </div>
  </div>
  <!-- end modal -->




  <script>

      //add first row
      $(document).ready(function(){
        addIngridientsRow();
      });

      function logOut(){
        window.location.href = "login.php";

      }

      function addIngridients(){
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
              url: '{{ url('/ingridient') }}',
              type: 'POST',
              data: {ingridient_name: $('#ingridient_name').val(), measure_as: $("#measure_as option:selected").text()}
             })
             .done(function(data){
                  console.log(data);
                  var response = JSON.parse(data);

                  $('#ingridient_name').val("");
                  $('#addIngridientsModal').modal("hide");// this triggers your modal to display

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
                    type: 'error',
                    title: 'Request fail..',
                    showConfirmButton: false,
                    timer: 500
                  })
            });
        }

      function addFoodType(){
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
                url: '{{ url('/add-food-type') }}',
                type: 'POST',
                data: {food_type_name: $('#food_type_name').val()}
               })
               .done(function(data){

                console.log(data);
                var response = JSON.parse(data);

                $('#food_type_name').val("");
                $('#addFoodTypeModal').modal("hide");// this triggers your modal to display

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
                  type: 'error',
                  title: 'response.message',
                  showConfirmButton: false,
                  timer: 500
                })
            });
        }

      function addIngridientsRow(){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        $.ajax({
              url: '{{ url('/all_ingridient') }}',
              type: 'GET',
             })
             .done(function(response){
              console.log(response);

              var markup = "<tr>"+
                              "<td>"+
                                "<select name='ingridient_id[]' required>";
                                for (var i = 0; i < response.length; i++) {
                  markup+=        "<option value='"+response[i].id+"'>"+response[i].name+"("+response[i].measure_as+")"+
                                  "</option>"
                                }
                  markup+=      "</select>"+
                              "</td>"+
                              "<td> <input min='1' name='amount[]' type='number' required > </td>"+
                              "<td class='td-actions text-right'>"+
                                "<button type='button' onclick='delete_row($(this))' class='btn btn-info'>"+
                                  "<i class='material-icons'>close</i>"+
                                "</button>"+
                              "</td>"+
                            "</tr>";


                $("#ingridients_table tbody").append(markup);

            
            
             })
             .fail(function(){
              
          });

      }

      function delete_row(row){
        var x = document.getElementById("ingridients_table").rows.length;

        if (x > 2) {

          row.closest('tr').remove();

          }
      }

  </script>


    
@endsection


