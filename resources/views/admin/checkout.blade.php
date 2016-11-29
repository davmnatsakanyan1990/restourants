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
                                        <input type="checkbox" id="option" name="" value="" class="top-check">
                                        <label for="option"></label>
                                        <span>Pay $ 80.20 USD monthly</span>
                                    </span>
                                    </div>
                                </div>

                                <div class="billing-contact-details">
                                    <div class="top-line"></div>
                                    <div class="block-content">
                                        <h2>Billing Contact Details</h2>
                                        <div class="row">
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Name">
                                                <label for="option">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Last Name">
                                                <label for="option">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-12">
                                                <input type="text" id="option" placeholder="Address line 1">
                                                <label for="option">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i
                                                </label>
                                            </li>

                                            <li class="col-md-12">
                                                <input type="text" id="option" placeholder="Address line 2">
                                                <label for="option">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i
                                                </label>
                                            </li>


                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="City">
                                                <label for="option">
                                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Zip/Postcode">
                                                <label for="option">
                                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="State">
                                                <label for="option">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                </label>
                                            </li>
                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Country">
                                                <label for="option">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="Phone">
                                                <label for="option">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </label>
                                            </li>

                                            <li class="col-md-6">
                                                <input type="text" id="option" placeholder="E-mail">
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
                                            <span>
                                                <input type="radio" checked="checked" id="option" name="pay" value="" class="pay-check">
                                                <label for="option"></label>
                                                <span>ACH (E-Check)</span>
                                            </span>

                                            <span>
                                                <input type="radio" id="option" name="pay" value="" class="pay-check">
                                                <label for="option"></label>
                                                <span>Credit Card</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right-sitebar col-md-4"></div>
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