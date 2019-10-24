@extends('admin.admin-layout')

@section('content')
  <div class="content">
    <div class="container-fluid">

      @if ($errors->any())
              <div class="alert alert-danger col-md-12">{{ implode('', $errors->all(':message')) }}</div>
      @endif
      
      @php( $porturl = URL('food/'.$food->id) )
      {!! Form::open(['url' => $porturl, 'method' =>'put', 'id'=>'fmr-addtable', 'enctype'=>'multipart/form-data']) !!}
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
                </div>
              </div>
              <div class="card-body ">
                <div class="form-horizontal">
                  <div class="row">
                    <label class="col-md-3 col-form-label">Food Name</label>
                    <div class="col-md-9">
                      <div class="form-group has-default">
                        <input type="text" class="form-control" name="food_name" value="{{$food->name}}" required >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Description</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <textarea class="form-control" rows="8"  name="description" required>{{$food->description}}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Price</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="number" min="1" class="form-control" name="price" value="{{$food->price}}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Cooking Hours</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="number" min="1" class="form-control" name="cooking_hours" value="{{$food->cooking_hours}}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Serve</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="number" min="1" class="form-control" name="serve" value="{{$food->serve}}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Calories</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="number" min="1" class="form-control" name="calories" value="{{$food->calories}}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Chef</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="chef" value="{{$food->chef}}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">Type</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select name="food_type_id" required>
                          
                                  @foreach($food_types as $type)
                                    <option value="{{ $type->id }}"  
                                                  @if($type->id == $food->food_type_id)
                                                    selected 
                                                  @endif>
                                      {{ $type->name }}
                                    </option>
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
                        @foreach($food_ingridients as $food_ingridient)

                            <tr>
                              <td>
                                <select name='ingridient_id[]' required>
                                  @foreach($ingridients as $ingridient)
                                    <option value="{{$ingridient->id}}" 
                                                                         @if($ingridient->id == $food_ingridient->ingridient_id)
                                                                          selected 
                                                                         @endif
                                       >
                                        {{$ingridient->name}}
                                    </option> 
                                    
                                  @endforeach
                                </select>
                              </td>
                              <td> <input name='amount[]' type='number' value="{{$food_ingridient->qty}}" required > </td>
                              <td class='td-actions text-right'>
                                <button type='button' onclick='delete_row($(this))' class='btn btn-info'>
                                  <i class='material-icons'>close</i>
                                </button>
                              </td>
                            </tr>

                        @endforeach
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

<script>
  
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
                              "<td> <input name='amount[]' type='number' required > </td>"+
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


