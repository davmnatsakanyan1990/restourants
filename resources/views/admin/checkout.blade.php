@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- Pick PAGE CONTENT-->
            <div class="wholePage">
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
                <div class="checkout-page">
                    <form action="{{ url('admin/payment/place_order') }}" method="post">
                        <div class="row">
                            <div class="cont col-md-8">
                                <div class="top-block">
                                    <div class="top-line"></div>
                                    <div class="block-content">
                                        <h2>Billing Frequency</h2>
                                        <span>
                                        {{--<input type="checkbox" id="option" name="" value="" class="top-check">--}}
                                        {{--<label for="option"></label>--}}
                                        <span>$ {{ $plan->price }} USD yearly</span>
                                    </span>
                                    </div>
                                </div>

                                <div class="billing-contact-details">
                                    @if(count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="top-line"></div>
                                    <div class="block-content">
                                        <h2>Billing Contact Details</h2>
                                        <div class="row">
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Name" value="{{ $billing_details && $billing_details->first_name ? $billing_details->first_name : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Last Name" value="{{ $billing_details && $billing_details->last_name ? $billing_details->last_name : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-12">
                                                <input type="text" id="option" placeholder="Address line 1" value="{{ $billing_details && $billing_details->address_1 ? $billing_details->address_1 : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-12">
                                                <input type="text" id="option" placeholder="Address line 2" value="{{ $billing_details && $billing_details->address_2 ? $billing_details->address_2 : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                </label>
                                            </li>


                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="City" value="{{ $billing_details && $billing_details->city ? $billing_details->city : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Zip/Postcode" value="{{ $billing_details && $billing_details->postal_code ? $billing_details->postal_code : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-6">
                                                {{--<input type="text" id="option" placeholder="State">--}}
                                                <select name="" id="option" placeholder="State">
                                                      <option value="" disabled selected>State</option>
                                                </select>
                                                <label for="option">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-6">
                                                {{--<input type="text" id="option" placeholder="Country">--}}
                                                <select name="country" id="option" placeholder="Country">
                                                    <option value="" {{ !$billing_details || !$billing_details->country ? 'selected' : '' }}>Select country</option>
                                                    @foreach($countries as $index => $country)
                                                        <option  value="{{ $index }}" {{ $billing_details && $billing_details->country && $billing_details->country==$index ? 'selected' : ''  }} >{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="option">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Phone" value="{{ $billing_details && $billing_details->phone ? $billing_details->phone : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="E-mail" value="{{ $billing_details && $billing_details->email ? $billing_details->email : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-method">
                                    <div class="top-line"></div>
                                    <div class="block-content">
                                        <h2>Payment Method</h2>

                                        <div class="row">
                                            <span class="col-md-6">
                                                <input type="radio" checked="checked" id="option" name="payment_method" value="ACH" class="pay-check pay-check-1 active">
                                                <label class="last-lab" for="option">
                                                    <label class="first-lab" for="option"></label>
                                                    ACH (E-Check)
                                                </label>
                                            </span>

                                            <span class="col-md-6">
                                                <input type="radio" id="option" name="payment_method" value="credit_card" class="pay-check pay-check-2">
                                                <label class="last-lab" for="option">
                                                    <label class="first-lab" for="option"></label>
                                                    Credit Card
                                                </label>
                                            </span>
                                        </div>

                                        <div class="credit-card">
                                            <div class="block credit-card-1 active">
                                                <div class="top-line"></div>
                                                <div class="block-content"></div>
                                            </div>
                                            <div class="block credit-card-2">
                                                <div class="top-line"></div>
                                                <div class="block-content">
                                                    <h2>Credit Card</h2>
                                                    <ul>
                                                        <li>

                                                            <img src="../img/visa-card-icon.png" alt="">

                                                        </li>
                                                        <li>

                                                            <img src="../img/mastercard-icon.png" alt="">

                                                        </li>
                                                        <li>

                                                            <img src="../img/american-express-icon.png" alt="">

                                                        </li>
                                                        <li>

                                                            <img src="../img/Diners-club-icon.png" alt="">

                                                        </li>
                                                        <li>

                                                            <img src="../img/discover-icon.png" alt="">
                                                        </li>

                                                    </ul>
                                                    <div class="row">
                                                        <li class="col-md-6">
                                                            <input type="text" id="option" placeholder="Credit Card Number">
                                                            <label for="option">
                                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                            </label>
                                                        </li>

                                                        <li class="col-md-6 expires-row">
                                                            <span>
                                                                <input type="text" id="option" size="2" placeholder="Expires (MM)">
                                                                <label for="option">
                                                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                </label>
                                                            </span>

                                                            <span>
                                                                <input type="text" id="option" size="4" placeholder="Expires (YYYY)">
                                                                <label for="option">
                                                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                </label>
                                                            </span>
                                                        </li>

                                                        <li class="col-md-6">
                                                            <input type="text" id="option" placeholder="Name on Card">
                                                            <label for="option">
                                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                            </label>
                                                        </li>

                                                        <li class="col-md-6">
                                                            <input type="text" id="option" placeholder="CVV">
                                                            <label for="option">
                                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                            </label>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="right-sitebar col-md-4">
                                <div class="top-line"></div>
                                <div class="block-content">
                                    <div class="row">
                                        <h2>Order Summary</h2>
                                        {{--<button>Chenge plan</button>--}}
                                    </div>
                                    <ul>
                                        <li>
                                            <span>Plus</span>
                                            <span>$ {{ $plan->price }}</span>
                                        </li>
                                        <li>
                                            <span>Taxes</span>
                                            <span>$ 0.00</span>
                                        </li>
                                        <li>
                                            <span>Due taday</span>
                                            <span>$ {{ $plan->price }}</span>
                                        </li>
                                    </ul>
                                    <div class="order-block">
                                        <p>Lorem Ipsum is simply dummy text of
                                            the printing and typesetting industry.</p>

                                        <label>
                                            <input type="checkbox" class="checkbox" id="checkbox">
                                            <label for="checkbox"></label>
                                            <span>I have read and agree to the Teams of Service</span>
                                        </label>
                                        <div class="butt-block">
                                            <button id="submit" type="submit">Place Order</button>
                                        </div>
                                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">


                                        <h2> Call us at </h2>
                                        <h3><i class="fa fa-phone" aria-hidden="true"></i> 1-8885-556-894</h3>
                                    </div>
                                </div>
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
    <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    <script src="{{ url('js/payment.js') }}" type="text/javascript"></script>
    <script src="{{ url('admin/scripts/custom/checkout.js') }}" type="text/javascript"></script>
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