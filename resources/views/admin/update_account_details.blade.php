@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE CONTENT-->
            <div class="row centered-form">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Personal info</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form">
                                {{--<div class="row">--}}
                                    {{--<div class="col-xs-6 col-sm-6 col-md-6">--}}
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Name" value="{{ $admin['name'] }}">
                                        </div>
                                    {{--</div>--}}
                                    {{--<div class="col-xs-6 col-sm-6 col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="{{ $admin['email'] }}">
                                </div>

                                {{--<div class="row">--}}
                                    {{--<div class="col-xs-6 col-sm-6 col-md-6">--}}
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Your Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="new_password" id="new_password" class="form-control input-sm" placeholder="New Password">
                                        </div>
                                    {{--</div>--}}
                                    {{--<div class="col-xs-6 col-sm-6 col-md-6">--}}
                                        <div class="form-group">
                                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control input-sm" placeholder="Confirm New Password">
                                        </div>
                                    {{--</div>--}}
                                {{--</div>--}}

                                <input type="submit" value="Register" class="btn btn-info btn-block">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection