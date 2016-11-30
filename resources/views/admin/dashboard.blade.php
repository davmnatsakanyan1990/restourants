@extends('admin.layouts.index')
@section('styles')

@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
<<<<<<< HEAD

            <div class="wholePage">
                <div class="curent-plan-block">
                    <div class="block">
                        <h2>Your current plan:Free Trial</h2>
                        <div class="caunter">
                            <div>
                                <span class="num-block first-num">0</span>
                                <span>:</span>
                                <span class="num-block last-num">0</span>
                                <span>Days remaing</span>
                            </div>
                        </div>
                    </div>

                </div>
                        @if($is_blocked)
                            <div class="alert alert-danger">
                                Your restaurant was blocked and removed from list. <a href="{{ url('admin/payment/subscribe') }}">Subscribe</a>
                            </div>
                        @endif



                        <div class="row">
                            <div class="col-md-9">
                                <div class="top-line"></div>
                                <div class="panel custom_panel panel1">
                                    <div class="panel-body">
                                        <div class="user-block">
                                            <div class="image-block">
                                                <img src="img/user-image-1.png" alt="">
                                            </div>
                                            <div class="text-block">
                                                <h3>Account : {{ Auth::guard('admin')->user()->name }}</h3>
                                                <a href="">
                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                    Account Setting
                                                </a>
                                            </div>
=======
            @if($admin->place->plan->id == 1)
            <div class="curent-plan-block">
                <div class="block">
                    @if($days_remaining)
                        <h2>Your current plan:Free Trial</h2>
                    @else
                        <h2>Your plan is expired</h2>
                    @endif
                    <div class="caunter">
                       <div>
                           <span class="num-block first-num {{ $days_remaining ? 'color-1' : 'color-2' }}">{{ $days_remaining }}</span>
                           {{--<span>:</span>--}}
                           {{--<span class="num-block last-num">0</span>--}}
                           <span>Days remaing</span>
                       </div>
                    </div>
                </div>

            </div>
            @endif

                <div class="row">
                    <div class="main_content">
                        <div class="col-md-9">
                            <div class="top-line"></div>
                            <div class="panel custom_panel panel1">
                                <div class="panel-body">
                                    <div class="user-block">
                                        <div class="image-block">
                                            <img src="img/user-image-1.png" alt="">
                                        </div>
                                        <div class="text-block">
                                            <h3>Account : {{ Auth::guard('admin')->user()->name }}</h3>
                                            <a href="">
                                                <i class="fa fa-cog" aria-hidden="true"></i>
                                                Account Setting
                                            </a>
>>>>>>> d1919de93ed4d332521e77b12e0404fca0df67a0
                                        </div>
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
                                <div class="top-line"></div>
                                <div class="panel custom_panel panel2 right-panel">
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