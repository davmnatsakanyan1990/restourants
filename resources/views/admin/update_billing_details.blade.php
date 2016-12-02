@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- Pick PAGE CONTENT-->
            <div class="wholePage">

                <div class="update-billing-page">
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
                    <form action="">
                        <div class="row">
                            <li class="col-md-12">
                                <input type="text" id="option" placeholder="E-mail">
                                <label for="option">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="option" placeholder="Name">
                                <label for="option">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="option" placeholder="Last Name">
                                <label for="option">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="option" placeholder="Phone">
                                <label for="option">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="option" placeholder="Address line 1">
                                <label for="option">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </label>
                            </li>

                            <li class="col-md-12">
                                <input type="text" id="option" placeholder="Address line 2">
                                <label for="option">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </label>
                            </li>


                            <li class="col-md-12">
                                <input type="text" id="option" placeholder="City">
                                <label for="option">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <select name="" id="option" placeholder="Country">
                                    <option value="" disabled selected>Country</option>
                                </select>
                                <label for="option">
                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <select name="" id="option" placeholder="State/Province">
                                    <option value="" disabled selected>State/Province</option>
                                </select>
                                <label for="option">
                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <select name="" id="option" placeholder="Time Zone">
                                    <option value="" disabled selected>Time Zone</option>
                                </select>
                                <label for="option">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="option" placeholder="Postal code">
                                <label for="option">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                </label>
                            </li>
                        </div>
                        <div class="row">
                            <div class="butt-block pull-right">
                                <a href="{{ url('admin/dashboard') }}"> <button type="button">Cancel</button></a>
                                <button type="submit">Update contact</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection

@section('scripts')

@endsection