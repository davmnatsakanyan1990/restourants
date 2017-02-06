<div id="contacts" class="organizationContent">
    <div class="contacts">
        <div class="topImage">
            <div class="contactText">
                <div class="contactTitle"><h1>Contact Us</h1></div>
                <div class="contactContent">We are here to answer the questions you may have and provide you
                    with the information you may need. We are extremely responsive to your requests and questions,
                    and value your opinion. Let’s create an effective solution in any situation together. </div>
            </div>
        </div>
        <div class="infoPart">
            <div class="container-fluid" style="max-width: 1000px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="subTitle">Send us message<div class="line"></div></div>
                        <div class="inputs">
                            <div class="row">
                                <form name="contactUs">
                                    <div class="col-md-4">
                                        <div class="relativeElement">
                                            <input type="text" placeholder="Name" ng-model="contactName"/>
                                            <validation validate-for="name" validate-form="contactUs" required ng-model="contactName"></validation>
                                        </div>
                                    </div>
                                    <div class="col-md-4 relativeElement">
                                        <div class="relativeElement">
                                            <input type="text" placeholder="Email" ng-model="contactEmail"/>
                                            <validation validate-for="email" validate-form="contactUs" required ng-model="contactEmail"></validation>
                                        </div>
                                    </div>
                                    <div class="col-md-4 relativeElement">
                                        <div class="relativeElement">
                                            <input type="text" placeholder="Subject" ng-model="contactSubject"/>
                                            <validation validate-for="subject" validate-form="contactUs" required ng-model="contactSubject"></validation>
                                        </div>
                                    </div>
                                    <div class="col-md-12 relativeElement">
                                        <textarea placeholder="Message" ng-model="contactMessage"></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <button ng-click="sendMessage([contactName, contactEmail, contactSubject, contactMessage], ['contactName', 'contactEmail', 'contactSubject', 'contactMessage'])">Send message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-md-5">
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
                    </div>--}}
                </div>
            </div>
        </div>
    </div>

</div>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="footerText" data-toggle="modal" data-target="#myModalLocation">Add location
                </div>
                <div class="footerText" data-toggle="modal" data-target="#myModalMaster">Register owner</div>
                <div class="footerText"><a href="forOrganization">For restaurant</a></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="footerText"><a href="contacts">Contacts</a></div>
                <div class="footerText"><a href="aboutProject">About us</a></div>
                <div class="footerText" data-toggle="modal" data-target="#myModalLet">Noticed a mistake - let us know</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 floating">
                <div class="footerText"><a href="privacyPolicy">Privacy policy</a></div>
                <div class="footerText"><a href="termsOfUse">Terms of use</a></div>
                <div class="footerSocial">
                    <a socialshare
                       socialshare-provider="facebook"
                       socialshare-type="share"
                       socialshare-text="Restadviser"
                       socialshare-title="Restadviser"
                       socialshare-media="http://restadviser.com/images/coverImages/cover1.png"
                       socialshare-url="http://restadviser.com/contacts"
                       socialshare-via="129554920871527">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a
                            socialshare
                            socialshare-provider="twitter"
                            socialshare-text="Restadviser"
                            {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                            socialshare-url="http://restadviser.com/contacts">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a
                            socialshare
                            socialshare-provider="linkedin"
                            socialshare-text="Restadviser"
                            {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                            socialshare-url="http://restadviser.com/contacts">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a
                            socialshare
                            socialshare-provider="google"
                            socialshare-text="Restadviser"
                            {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                            socialshare-url="http://restadviser.com/contacts">
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 floating">
                <div class="line"></div>
                <span class="copyRight">&copy; RestAdviser.com | All rights reserved.</span>
            </div>
        </div>
    </div>
</footer>