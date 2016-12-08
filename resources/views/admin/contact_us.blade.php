@extends('admin.layouts.index')

@section('styles')
    <link rel="stylesheet" type="text/css" href="/admin/css/contact-us.css"/>
@endsection

@section('content')
    <div class="organizationContent">
        <div class="contacts">
            <div class="topImage">
                <div class="contactText">
                    <div class="contactTitle">Contact Us</div>
                    <div class="contactContent">We are here to answer the questions you may have and provide you
                        with the information you may need. We are extremely responsive to your requests and questions,
                        and value your opinion. Let’s create an effective solution in any situation together. </div>
                </div>
            </div>
            <div class="infoPart">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="subTitle">Send us message<div class="line"></div></div>
                            <div class="inputs">
                                <div class="row">
                                    <form name="contactUs">
                                        <div class="col-md-4">
                                            <input type="text" placeholder="Name"/>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="Email"/>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="Subject"/>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea placeholder="Message"></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <button>Send message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="subTitle">Contact Info<div class="line"></div></div>
                            <div class="inputs">
                                <div class="row">
                                    <div class="col-md-12 contactText">
                                        You can contact or visit in our office from
                                        Monday to Friday from 8:00-17:00
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="contactInfo clearElement">
                                            <i class="fa fa-map-marker elementLeft" aria-hidden="true"></i>
                                            <div class="elementLeft">555 N Balashixa street, Khamovniki District, Moscow</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="contactInfo clearElement">
                                            <i class="fa fa-phone elementLeft" aria-hidden="true"></i>
                                            <div class="elementLeft">+7 703-654-4454</br>
                                                +7 703-654-2568
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="contactInfo clearElement">
                                            <i class="fa fa-envelope elementLeft" aria-hidden="true"></i>
                                            <div class="elementLeft">restdviser.com</div>
                                        </div>
                                    </div>
                                </div>
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