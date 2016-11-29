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
                                                        <a href="#">
                                                            <img src="../img/visa-card-icon.png" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="../img/mastercard-icon.png" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="../img/american-express-icon.png" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="../img/Diners-club-icon.png" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="../img/discover-icon.png" alt="">
                                                        </a>
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