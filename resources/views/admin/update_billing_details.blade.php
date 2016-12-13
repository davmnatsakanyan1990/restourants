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
                    <form action="{{ url('admin/billing_details/update') }}" method="post">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('message'))
                            <div class="alert alert-success">
                                <p>{{ session('message') }}</p>
                            </div>
                        @endif

                        <div class="row">
                            <li class="col-md-12">
                                <input type="text" name="email" id="email" placeholder="E-mail" value="{{ $billing_details ? $billing_details->email : old('email') }}">
                                <label for="email">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="first_name" name="first_name" placeholder="First Name" value="{{ $billing_details ? $billing_details->first_name : old('first_name') }}">
                                <label for="first_name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="{{ $billing_details ? $billing_details->last_name : old('last_name') }}">
                                <label for="last_name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="phone" name="phone" placeholder="Phone" value="{{ $billing_details ? $billing_details->phone : old('phone') }}">
                                <label for="phone">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="address_1" name="address_1" placeholder="Address line 1" value="{{ $billing_details ? $billing_details->address_1 : old('address_1') }}">
                                <label for="address_1">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </label>
                            </li>

                            <li class="col-md-12">
                                <input type="text" id="address_2" name="address_2" placeholder="Address line 2" value="{{ $billing_details ? $billing_details->address_ : old('address_2') }}">
                                <label for="address_2">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </label>
                            </li>


                            <li class="col-md-12">
                                <input type="text" id="city" name="city" placeholder="City" value="{{ $billing_details ? $billing_details->city : old('city') }}">
                                <label for="city">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <select name="country" id="country" placeholder="Country">
                                    <option value="" {{ $billing_details ? '' : 'selected'}}>Country</option>
                                    @foreach($countries as $index => $country)
                                        <option value="{{ $index }}" {{ $billing_details && $billing_details->country == $index ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                                <label for="country">
                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <select name="state" id="state" placeholder="State/Province">
                                    <option value="" disabled selected>State/Province</option>
                                    @if(count($states) > 0)
                                        @foreach($states as $index => $state)
                                            <option value="{{ $index }}" {{ $billing_details->state == $index ? 'selected' : '' }}>{{ $state }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label for="state">
                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                {{--<select name="time_zone" id="time_zone" placeholder="Time Zone">--}}
                                    {{--<option value=""></option>--}}
                                {{--</select>--}}
                                {!!   $timezone_form !!}
                                <label for="time_zone">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </label>
                            </li>
                            <li class="col-md-12">
                                <input type="text" id="postal_code" name="postal_code" placeholder="Postal code" value="{{ $billing_details ? $billing_details->postal_code : old('postal_code') }}">
                                <label for="postal_code">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                </label>
                            </li>
                        </div>
                        <div class="row">
                            <div class="butt-block pull-right">
                              {{--  <a href="{{ url('admin/dashboard') }}"> <button type="button">Cancel</button></a>--}}
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
    <script>
        $(document).find('select[name="country"]').change(function(){

            $('select[name="country"] option:selected').each(function() {
                var country = $( this ).val();
                if(country === '') {
                    $('select[name="state"]').html('');
                }
                $.ajax({
                    url: BASE_URL+'/admin/payment/'+country+'/states',
                    type: 'get',
                    success: function(response){
                        $('select[name="state"]').html('');
                        $.each(response, function(index, value){
                            $('select[name="state"]').append('' +
                                    '<option value="'+index+'">'+value+'</option>')
                        });
                    }
                })
            });
        });
    </script>
@endsection