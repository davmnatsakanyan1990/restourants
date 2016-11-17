@extends('admin.layouts.index')
@section('styles')

    @endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

                <div class="row">
                    <div class="main_content">
                        @if($is_blocked)
                            <div class="alert alert-danger">
                                Your restaurant was blocked and removed from list. <a href="{{ url('admin/payment/subscribe') }}">Subscribe</a>
                            </div>
                        @endif

                        <div class="col-md-9">
                            <div class="panel custom_panel panel1">
                                <div class="panel-body">
                                    <h3>Account : {{ Auth::guard('admin')->user()->name }}</h3>
                                    <h4>Your restaurants</h4>
                                    <table>
                                        <tr>
                                            <td><span class="rest_name">{{ $place->name }}</span></td>
                                            <td></td>
                                            <td><a href="{{ url('admin/place/edit') }}">Edit</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel custom_panel panel2">
                                <div class="panel-body">
                                    <h3>Primary Contact</h3>
                                    <p><a href="{{ url('admin/profile/edit') }}">Update account details</a></p>
                                    <p><a href="#">Update billing details</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection

@section('scripts')

    @endsection