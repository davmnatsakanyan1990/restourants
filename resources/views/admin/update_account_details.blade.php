@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE CONTENT-->
            <div class="row centered-form">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Update Info</h3>
                        </div>
                        <div class="panel-body">
                            @if(session('message'))
                                <div class="alert alert-success fade-in">
                                    <i class="close" data-dismiss="alert" aria-label="close">&times;</i>
                                    <p>{{ session('message') }}</p>
                                </div>
                            @endif
                            <h5 style="color: red;">*Personal info</h5>
                            <form role="form" method="post" action="{{ url('admin/profile/update/pers_info') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Name" value="{{ $admin['name'] }}">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="{{ $admin['email'] }}">
                                </div>
                                <input type="submit" value="Update" class="btn btn-info btn-block" style="margin-bottom: 10px;">
                            </form>
                                @if(count($errors)>0)
                                    <div class="alert alert-danger fade-in">
                                        <i class="close" data-dismiss="alert" aria-label="close">&times;</i>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <h5 style="color: red;">*Secure info</h5>
                            <form role="form" method="post" action="{{ url('admin/profile/update/sec_info') }}">
                                {{ csrf_field() }}
                                {{--<div class="form-group">--}}
                                    {{--<input type="password" name="old_password" id="old_password" class="form-control input-sm" placeholder="Your Password">--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-sm" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation "  class="form-control input-sm" placeholder="Confirm New Password">
                                </div>
                                <input type="submit" value="Update" class="btn btn-info btn-block">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection