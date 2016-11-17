@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- Pick PAGE CONTENT-->
            <div class="messages"></div>
            @if($is_subscribed)
                <div class="text-center">
                    <h3>You have already subscribed</h3>
                </div>
            @else
            <div class="pick-page">
                <h2>Pick a plan</h2>

                <div class="columns plan-card-column">
                    <div class="plan-card-container">
                        <article class="card">
                            <div class="card-body">
                                <h1 class="plan-name">Standard</h1>
                                <br class="plan-card-price-starting-at">
                                <div class="plan-price">
                                    <span class="plan-price-currency">$</span>
                                    <span class="plan-price-integer-part">29</span>
                                    <span class="plan-price-fractional-part">.95</span>
                                    <span class="plan-price-separator">/</span>
                                    <span class="plan-price-frequency">mo</span>
                                </div>
                                <p class="plan-card-description">A full-featured online store</p>
                            </div>
                            <footer class="card-footer">
                                <form>
                                    <button type="button" name="commit"
                                            class="button button card-button button-primary" data-toggle="modal"
                                            data-target="#myModal">Select plan
                                    </button>
                                </form>

                            </footer>
                        </article>
                    </div>

                </div>
            </div>
            @endif
            <!-- Button trigger modal -->
        {{--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">--}}
        {{--Provide Card Information--}}
        {{--</button>--}}

        <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Card Details</h4>
                        </div>
                        <div class="modal-body">
                            <div style="padding:0 20px">
                                <form method="post" action="{{ url('admin/payment/pay') }}" id="form"
                                      class="form-horizontal">
                                    <div class="form-group">
                                        <label for="ccNo">Card Number</label>
                                        <input name="ccNo" id="ccNo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="cvv">Cvv</label>
                                        <input id="cvv" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="expMonth">Expair Month</label>
                                        <input id="expMonth" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="expYear">Expair Year</label>
                                        <input id="expYear" class="form-control">
                                    </div>
                                    <input type="submit" id="submit" class="hidden">
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="submit1">OK</button>
                        </div>
                    </div>
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