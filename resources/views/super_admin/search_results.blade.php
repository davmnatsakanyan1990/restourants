@extends('super_admin.layouts.index')

@section('content')
    <div class="main">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <h1 class="page-header">Result</h1>
                <div class="result_section" style="padding: 20px; background-color: white;">
                    <h3 style="margin: 0; margin-bottom: 10px;">Name: {{ $place['name'] }}</h3>
                    <p>Phone: {{ $place['mobile'] }}</p>
                    <button type="button" class="btn btn-primary" style="border-radius: 0; border: 1px solid #ff7e00; background-color: #ff7e00; width: 100px;" data-toggle="modal" data-target="#myModal">Edit</button>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Restaurant's details</h4>
                </div>
                <div class="modal-body">
                   <form action="{{ url('super_admin/update') }}" method="post" id="modal_form">
                       <div class="form-group">
                           <input style="border-radius: 0; border: 1px solid #9e9e9e;" name="rest_name" value="{{ $place->name }}" type="text" class="form-control" placeholder="Restaurant name">
                       </div>
                       <div class="form-group">
                           <input style="border-radius: 0; border: 1px solid #9e9e9e;" name="rest_phone" value="{{ $place->mobile }}" type="text" class="form-control" placeholder="(###)###-####">
                       </div>
                       <div class="form-group">
                           <input style="border-radius: 0; border: 1px solid #9e9e9e;" name="admin_name" value="{{ $place->admin->name }}" type="text" class="form-control" placeholder="Name, surename">
                       </div>
                       <div class="form-group">
                           <input style="border-radius: 0; border: 1px solid #9e9e9e;" name="admin_email" value="{{ $place->admin->email }}" type="email" class="form-control" placeholder="Email">
                       </div>
                       <input type="hidden" name="place_id" value="{{ $place->id }}">
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" style="border-radius: 0;" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" style="background-color: #ff7e00; border: 1px solid #ff7e00; border-radius: 0;" name="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('button[name="submit"]').on('click', function(){

            var data = {};
            data.rest_name = $('#modal_form input[name="rest_name"]').val();
            data.rest_phone = $('#modal_form input[name="rest_phone"]').val();
            data.admin_name = $('#modal_form input[name="admin_name"]').val();
            data.admin_email = $('#modal_form input[name="admin_email"]').val();
            data.place_id = $('#modal_form input[name="place_id"]').val();

            $.ajax({
                url: BASE_URL+'/super_admin/update',
                type: 'get',
                data: data,
                success: function(response){
                    if(response.status == 1){
                        $('#myModal').modal('hide');
                    }
                },
                error: function(response){
var data = JSON.parse(response.responseText);
//                    debugger;
                    console.log(data);
                    var text = '';
                    for(var key in data){
                        text+='<li>'+data[key][0]+'</li>';
//                        console.log(data[key][0]);
                    };

                    $('#modal_form').prepend('<div class="alert alert-danger">'+text+'</div>')
                }
            })
        })
    </script>
@endsection