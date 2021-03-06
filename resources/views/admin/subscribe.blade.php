@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <!-- Pick PAGE CONTENT-->
            <div class="wholePage">
                @if($admin->place->plan->id == 1)
                    <div class="curent-plan-block">
                        <a href="{{ url('admin/payment/subscribe') }}">
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
                        </a>
                    </div>
                @endif
            <div class="topTitle">Pick a plan for your Restaurant</div>
            <p class="littleIext">Grow sales and increase efficiency with powerful features that fit your business</p>

                <div class="plansPart clearElement">
                    <div class="plan elementLeft">
                        <div class="planTitle">{{ $plans[1]['name'] }}</div>
                        <div class="planContent" style="min-height: 260px;">
                            <div class="textPart clearElement">
                                <div class="pricePlace clearElement">
                                    <div class="text elementLeft">Fully detailed presentation of Your Restaurant</div>
                                    <div class="price elementRight">
                                        <div class="priceSign"><i class="fa fa-usd" aria-hidden="true"></i></div>
                                        <div class="priceMore">
                                            <span class="bigPrice">{{ explode('.', $plans[1]['price']/12)[0] }}</span>
                                            <span style="font-size: 30px;">.</span>
                                            <span class="smallPrice">{{ explode('.', number_format($plans[1]['price']/12, 2))[1] }}</span>
                                            <span class="smallPrice">/Monthly</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ url('admin/payment/checkout?plan=2') }}" class="choseButton elementRight">Select plan</a>
                            </div>
                        </div>
                    </div>

                    <div class="plan elementRight">
                        <div class="planTitle">Enterprise</div>
                        <div class="planContent" style="min-height: 260px;">
                            <div class="textPart clearElement">
                                <div class="callText">
                                    <span> Contact US </span>for pricing
                                    tailored to your business
                                </div>
                                <div class="callText2">The ultimate selling solution</div>

                                <button class="choseButton elementRight" data-toggle="modal" data-target="#myModalEnterprise">Select plan</button>
                            </div>
                        </div>
                    </div>


                </div>
                {{--<div class="customTable">
                    <div class="tablePart">
                        <div class="tableTitle">
                            <div class="titleTh">Get access to these features</div>
                            <div class="titleTh">Standard</div>
                            <div class="titleTh">Enterprise</div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Transaction Fees</div>
                            <div class="tableTr">0 %</div>
                            <div class="tableTr">0 %</div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Products, file storage, and bandwidth</div>
                            <div class="tableTr">Unlimited</div>
                            <div class="tableTr">Unlimited</div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Staff accounts</div>
                            <div class="tableTr">Unlimited</div>
                            <div class="tableTr">Unlimited</div>
                        </div>
                    </div>
                    <div class="tablePart">
                        <div class="tableTitle">
                            <div class="titleTh">Sales Channels</div>
                            <div class="titleTh"></div>
                            <div class="titleTh"></div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Branded Online Store</div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Point of sale (Square)</div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Facebook</div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Pinterest</div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Google Trusted Stores</div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                    </div>
                    <div class="tablePart">
                        <div class="tableTitle">
                            <div class="titleTh">Get access to these features</div>
                            <div class="titleTh"></div>
                            <div class="titleTh"></div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Transaction Fees</div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Products, file storage, and bandwidth</div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                        <div class="tableContent">
                            <div class="tableTr">Staff accounts</div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                            <div class="tableTr"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>--}}

            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    <script src="{{ url('js/payment.js') }}" type="text/javascript"></script>
    <script>
        $('form[name="enterprise"] button[type="submit"]').on('click', function(e){
            e.preventDefault();
            var first_name = $('form[name="enterprise"] input[name="first_name"]').val();
            var last_name = $('form[name="enterprise"] input[name="last_name"]').val();
            var email = $('form[name="enterprise"] input[name="email"]').val();
            var phone = $('form[name="enterprise"] input[name="phone"]').val();
            var description = $('form[name="enterprise"] textarea[name="description"]').val();

            $.ajax({
                url: BASE_URL+'/admin/payment/enterprise/sendmail',
                type: 'post',
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    phone: phone,
                    description: description
                },
                success: function(response){
                    if(response.success){
                        $('#myModalEnterprise').modal('close');
                    }
                },
                error: function(error){
                    var errors = error.responseJSON;
                    $('#errors').append('<div class="alert alert-danger "><ul id="errors_list"></ul></div>');
                    $.each(errors, function(index, value){
                        $('#errors_list').append('<li>'+value[0]+'</li>');
                    })
                }
            })
        })
    </script>
@endsection


<!--add location popup-->
<div class="modal fade" id="myModalEnterprise" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form name="enterprise" method="post" action="{{ url('admin/payment/enterprise/sendmail') }}">
            <div class="modal-content">
                <div class="modal-header popupHeader">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title capitalize">Enterprise</h4>
                </div>
                <div class="modal-body popupBody leftContent littleInputs">
                    <div id="errors"></div>
                    <div class="inputsBlocks">
                        <div class="inputBlock">
                            <div class="titleInput">first name</div>
                            <input class="capitalize lightInput" type="text" name="first_name"/>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">last name</div>
                            <input class="capitalize lightInput" type="text" name="last_name"/>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">e-mail</div>
                            <input class="capitalize lightInput" type="text" name="email"/>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">phone number</div>
                            <input class="capitalize lightInput" type="text" name="phone"/>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">description</div>
                            <textarea name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer popupFooter">
                    <div class="leftButtonsArea">
                        <button type="button" class="capitalize greyButton" data-dismiss="modal">cancel</button>
                        <button type="submit" class="capitalize greyButton greenButton">ok</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!---->