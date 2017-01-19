@extends('super_admin.layouts.index')

@section('content')
    <div class="main">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <h1 class="page-header">Result</h1>
                <div class="result_section">
                    <h3>Name: {{ $place['name'] }}</h3>
                    <p>Phone: {{ $place['mobile'] }}</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit</button>
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
                           <input name="name" type="text" class="form-control" placeholder="Restaurant name">
                       </div>
                       <div class="form-group">
                           <input name="name" type="text" class="form-control" placeholder="Phone number">
                       </div>
                       <div class="form-group">
                           <input name="name" type="text" class="form-control" placeholder="Name, surename">
                       </div>
                       <div class="form-group">
                           <input name="email" type="email" class="form-control" placeholder="Email">
                       </div>
                       <input type="hidden" name="place_id" value="{{ $place['id'] }}">
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" name="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('button[name="submit"]').on('click', function(){

            var data = {};
            data.name = $('#modal_form input[name="name"]').val();
            data.email = $('#modal_form input[name="email"]').val();
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