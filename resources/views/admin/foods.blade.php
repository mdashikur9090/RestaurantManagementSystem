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
                    <h4 class="card-title">All Foods</h4>
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-primary" >Add Foods</button>
                  </div>
                </div>
            </div>
                  
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Food ID</th>
                      <th>Name</th>
                      <th>Food Type</th>
                      <th>Price</th>
                      <th>Visible Status</th>
                      <th class="text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($foods as $food)
                        <tr>
                            <td class="text-center">{{ $food->id }}</td>
                            <td>{{ $food->name }}</td>
                            <td>{{ $food->food_type->name }}</td>
                            <td>{{ $food->price }}</td>
                            <td>

                              <div class='togglebutton'>
                                <label>
                                  <input onclick="changeVisibleStatus({{$food->id}})" type='checkbox'
                                      @if($food->visible_status == 1 )
                                        checked
                                      @endif
                                    >
                                  <span class='toggle'></span>
                                </label>
                              </div>
                              

                            </td>
                            <td class="td-actions text-right">
                              <a href="{{URL('/food').'/'.$food->id.'/edit'}}"><button type="button"class="btn btn-info">
                                  <i class="material-icons">edit</i>
                                </button>
                              </a>
                              <button type="button" onclick="viewFoodDetaiils('{{ $food->id }}')" class="btn btn-info">
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
                    <h4 class="card-title">Food Details</h4>
                  </div>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="foodDetails_tbl">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Measure As</th>
                      <th colspan="4">Amount</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div class="row" id="foodImg">
                  <div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
@endsection

@section('modal-and-js')

  <script>

    function viewFoodDetaiils(id){

      //console.log('{{ url('/admin/food/details') }}'+'/'+id);

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
                url: '{{ url('/admin/food/details') }}'+'/'+id,
                type: 'GET',
               })
               .done(function(response){
                console.log(response[0].foodImage);
                console.log(response[1].foodIngridient);

                
                //set empty all table row
                $("#foodDetails_tbl").find("tr:gt(0)").remove();
                $("#foodImg div").remove();

                if (response[1].foodIngridient.length>0) {
                    for (var i=0; i<response[1].foodIngridient.length; i++) {
                          var markup  = "<tr><td>" + i
                                  + "</td><td>" + response[1].foodIngridient[i].name
                                  + "</td><td>" + response[1].foodIngridient[i].measure_as    
                                  + "</td><td class='text-right'>" + response[1].foodIngridient[i].qty 
                                  + "</td></tr>";

                      $("#foodDetails_tbl tbody").append(markup);

                    }

                }


                if (response[1].foodIngridient.length>0) {

                  var imageMarkup="";

                    for (var i=0; i<response[0].foodImage.length; i++) {
                         imageMarkup += "<div class='col-md-6'>"
                                          +"<img width ='200px' height='200px' src='{{ asset('images/foods') }}/"+response[0].foodImage[i].img_name+"'>"
                                        +"</div>";
                    }

                    $("#foodImg").append(imageMarkup);
                }

                

              
              
               })
               .fail(function(){
                
            });
      }

  

    function changeVisibleStatus(id) {

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
                url: '{{ url('/food/chnage-visible-status') }}'+'/'+id,
                type: 'GET',
               })
               .done(function(response){

                console.log(response);
                
            
              
              
               })
               .fail(function(){
                
            });

    }


  </script>


    
@endsection


