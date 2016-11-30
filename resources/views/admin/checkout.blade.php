@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- Pick PAGE CONTENT-->
            <div class="wholePage">
                <div class="checkout-page">
                    <form action="">
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
                                    <div class="top-line"></div>
                                    <div class="block-content">
                                        <h2>Billing Contact Details</h2>
                                        <div class="row">
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Name" value="{{ $billing_details->first_name ? $billing_details->first_name : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Last Name" value="{{ $billing_details->last_name ? $billing_details->last_name : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-12">
                                                <input type="text" id="option" placeholder="Address line 1" value="{{ $billing_details->address_1 ? $billing_details->address_1 : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-12">
                                                <input type="text" id="option" placeholder="Address line 2" value="{{ $billing_details->address_2 ? $billing_details->address_2 : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                </label>
                                            </li>


                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="City" value="{{ $billing_details->city ? $billing_details->city : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Zip/Postcode" value="{{ $billing_details->postal_code ? $billing_details->postal_code : '' }}">
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
                                                <select name="" id="option" placeholder="Country">
                                                      <option value="" disabled selected>Country</option>
                                                </select>
                                                <label for="option">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Phone" value="{{ $billing_details->phone ? $billing_details->phone : '' }}">
                                                <label for="option">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="E-mail" value="{{ $billing_details->email ? $billing_details->email : '' }}">
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
                                                <input type="radio" checked="checked" id="option" name="pay" value="" class="pay-check">
                                                <label class="last-lab" for="option">
                                                    <label class="first-lab" for="option"></label>
                                                    ACH (E-Check)
                                                </label>
                                            </span>

                                            <span class="col-md-6">
                                                <input type="radio" id="option" name="pay" value="" class="pay-check">
                                                <label class="last-lab" for="option">
                                                    <label class="first-lab" for="option"></label>
                                                    Credit Card
                                                </label>
                                            </span>
                                        </div>

                                        <div class="credit-card">
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
                                                    <li class="col-md-6">
                                                        <input type="text" id="option" placeholder="Expires (MM/YY)">
                                                        <label for="option">
                                                            <i class="fa fa-user" aria-hidden="true"></i>
                                                        </label>
                                                    </li>
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
                                        <button>Chenge plan</button>
                                    </div>
                                    <ul>
                                        <li>
                                            <span>Plus</span>
                                            <span>$ 20.55</span>
                                        </li>
                                        <li>
                                            <span>Taxes</span>
                                            <span>$ 0.00</span>
                                        </li>
                                        <li>
                                            <span>Due taday</span>
                                            <span>$ 0.00</span>
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

                                        <button>Place Order</button>

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
@endsection