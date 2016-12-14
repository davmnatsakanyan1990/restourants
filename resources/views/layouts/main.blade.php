<!DOCTYPE html>
<html lang="en">
<head>
    @include("layouts.partials.htmlheader")
    @include("layouts.partials.scripts")
</head>
<body ng-app="myApp" ng-controller="rootController">
{{--<div class="home-loader" ng-show="docLoader"><img src="/images/loader2.gif" width="100" height="100"></div>--}}
    @include("layouts.partials.menu")
    <ng-view></ng-view>
{{--registeration tooltips--}}
    <div class="confirmation confirm">
        <i class="fa fa-check" aria-hidden="true"></i>
        <div class="text">Your registration is success</div>
    </div>
    <div class="confirmation error" id="error">
        <i class="fa fa-times" aria-hidden="true"></i>
        <div class="text">Something went wrong</div>
    </div>
{{--login tooltips--}}
    <div class="confirmation confirmLogin ">
        <i class="fa fa-check" aria-hidden="true"></i>
        <div class="text">You are loged in</div>
    </div>
    <div class="confirmation errorLogin" id="error">
        <i class="fa fa-times" aria-hidden="true"></i>
        <div class="text">Something went wrong</div>
    </div>
    <!--logIn popup-->
    <div class="modal fade"  id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header popupHeader">
                    <button type="button" class="close" data-dismiss="modal" ng-click="reset()">&times;</button>
                    <h4 class="modal-title">Log in or Sign up</h4>
                </div>
                <div class="modal-body popupBody registerPopup littleInputs">
                    <div class="clearElement">
                        <div class="loginPart elementLeft">
							<form name="loginForm" class="css-form" novalidate>

								<div class="loginRegister">
                                    Log in
								</div>
                                <div class="loginUsing facebook" ng-click="loginFacebook()">
                                    <div class="elementLeft"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                                    <div class="elementLeft">facebook</div>
                                </div>
                                <div class="loginUsing googlePlus" ng-click="loginGoogle()">
                                    <div class="elementLeft"><i class="fa fa-google" aria-hidden="true"></i></div>
                                    <div class="elementLeft">google</div>
                                </div>
								<div class="restLogin">
                                    <div class="relativeElement">
                                        <input class="capitalize lightInput blockElement" type="text" placeholder="E-mail" name = "uName" ng-model="user.email" required/>
                                       <div ng-show="loginForm.$submitted || loginForm.uName.$touched">
                                           <div class="tooltips" ng-show="loginForm.uName.$error.email || loginForm.uName.$error.required">
                                               wrong email
                                           </div>
                                       </div>
                                    </div>
									<div class="marginTop10 relativeElement">
                                        <input class="capitalize lightInput blockElement" type="password" name ="pass" placeholder="password" ng-model="user.password" required/>
                                        <div ng-show="loginForm.$submitted || loginForm.pass.$touched">
                                            <div class="tooltips" ng-show="loginForm.pass.$error.required">
                                                wrong password
                                            </div>
                                        </div>
                                    </div>

								</div>

								<button class="loginUsingBut" ng-click="loginUser(user)" data-dismiss="modal">Log in</button>

                                {{--<div class="loginusingSistem capitalize">
                                    log in
                                </div>--}}

                                {{--<button class="loginUsing twitter">
                                    <div class="elementLeft"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                                    <div class="elementLeft">twitter</div>
                                </button>--}}
                                {{--<div class="moreSoc">
                                    <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                                    <i class="fa fa-vk" aria-hidden="true"></i>
                                    <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                                </div>--}}
							</form>
                        </div>
                        <div class="registerPart elementRight">
							<form name="registerForm" class="css-form" novalidate>
								<div class="loginRegister capitalize">
                                registration
								</div>
                                <div class="relativeElement">
                                    <input class="capitalize lightInput blockElement" type="text" name="name" placeholder="name" ng-model = "currentUser.name" required/>
                                    <div ng-show="registerForm.$submitted || registerForm.name.$touched">
                                        <div class="rightTooltips" ng-show="registerForm.name.$error.required">
                                            type your name
                                        </div>
                                    </div>
                                </div>
                                <div class="relativeElement marginTop10">
                                    <input class="capitalize lightInput blockElement" type="text" name="email" placeholder="E-mail" ng-model = "currentUser.email" required/>
                                    <div ng-show="registerForm.$submitted || registerForm.email.$touched">
                                        <div class="rightTooltips" ng-show="registerForm.email.$error.required">
                                            type your email
                                        </div>
                                    </div>
                                </div>
                                <div class="relativeElement marginTop10">
                                    <input class="capitalize lightInput blockElement" type="password" name="password" placeholder="password" ng-model = "currentUser.password" required/>
                                    <div ng-show="registerForm.$submitted || registerForm.password.$touched">
                                        <div class="rightTooltips" ng-show="registerForm.password.$error.required">
                                            type your password
                                        </div>
                                    </div>
                                </div>
								<div class="relativeElement marginTop10">
                                    <input class="capitalize lightInput blockElement" type="password" name="confirm" placeholder="confirm password" ng-model = "currentUser.confirmPassword" required/>
                                    <div ng-show="registerForm.$submitted || registerForm.confirm.$touched">
                                        <div class="rightTooltips" ng-show="registerForm.confirm.$error.required">
                                            retype your password
                                        </div>
                                    </div>
                                </div>

								<button class="loginUsing googlePlus marginTop10" ng-click = "register(currentUser)" data-dismiss="modal">Sign up</button>
							</form>
                           
                        </div>
                    </div>
                </div>
                {{--<div class="modal-footer popupFooter">
                    <div class="leftButtonsArea">
                        <button type="button" class="capitalize greyButton" data-dismiss="modal">cancel</button>
                        <button type="button" class="capitalize greyButton">ok</button>
                    </div>
                </div>--}}
            </div>

        </div>
    </div>
    <!---->

    <!--add location popup-->
    <div class="modal fade" id="myModalLocation" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form name="form1" novalidate>
                    <div class="modal-header popupHeader">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title capitalize">add location</h4>
                    </div>
                    <div class="modal-body popupBody leftContent littleInputs">
                        <div class="inputsBlocks">
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">Name</div>
                                <input class="capitalize lightInput" type="text" name="name" ng-model="name" placeholder="name"/>
                                <validation validate-for="name" validate-form="form1" ng-model="name"></validation>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">address</div>
                                <input class="capitalize lightInput" type="text" name="address" ng-model="address" placeholder="address"/>
                                <validation validate-for="number" validate-form="form1" ng-model="address"></validation>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">phone number</div>
                                <input class="capitalize lightInput" type="text" name="phone" ng-model="phone" placeholder="phone number"/>
                                <validation validate-for="number" validate-form="form1" ng-model="phone"></validation>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">description</div>
                                <textarea placeholder="description"></textarea>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">website</div>
                                <input class="capitalize lightInput" type="text" name="website" ng-model="website" placeholder="website"/>
                                <validation validate-for="website" validate-form="form1" ng-model="website"></validation>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">e-mail</div>
                                <input class="capitalize lightInput" type="text" name="email" ng-model="email" placeholder="e-mail"/>
                                <validation validate-for="email" validate-form="form1" ng-model="email"></validation>
                            </div>
                            <div class="leftButtonsArea clearElement">
                                <button type="button" class="capitalize greyButton elementRight">ok</button>
                                <button type="button" class="capitalize greyButton elementRight" data-dismiss="modal">cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!---->

    <!--register owner popup-->
    <div class="modal fade" id="myModalMaster" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header popupHeader">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title capitalize">register owner</h4>
                </div>
                <form name="form2">
                    <div class="modal-body popupBody leftContent littleInputs">
                        <div class="inputsBlocks">
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">Name</div>
                                <input class="capitalize lightInput" type="text" name="name" ng-model="name1" placeholder="name"/>
                                <validation validate-for="name" validate-form="form2" ng-model="name1"></validation>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">sureName</div>
                                <input class="capitalize lightInput" type="text" name="sureName" ng-model="sureName1" placeholder="sureName"/>
                                <validation validate-for="name" validate-form="form2" ng-model="sureName1"></validation>
                            </div>
                            <div class="inputBlock">
                                <div class="titleInput">gender</div>
                                <div class="genderInputs">
                                    <div class="genderSection">
                                        <span class="male">male</span>
                                        <input class="capitalize lightInput" type="radio" name="gender" value="male"/>
                                    </div>
                                    <div class="genderSection">
                                        <span class="female">female</span>
                                        <input class="capitalize lightInput" type="radio" name="gender" value="female"/>
                                    </div>
                                </div>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">phone number</div>
                                <input class="capitalize lightInput" type="text" name="phoneNumber" ng-model="phoneNumber" placeholder="phoneNumber"/>
                                <validation validate-for="number" validate-form="form2" ng-model="phoneNumber"></validation>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">description</div>
                                <textarea placeholder="description"></textarea>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">website</div>
                                <input class="capitalize lightInput" type="text" name="website" ng-model="websiteAd" placeholder="website"/>
                                <validation validate-for="website" validate-form="form2" ng-model="websiteAd"></validation>
                            </div>
                            <div class="relativeElement marginTop10">
                                <div class="titleInput">e-mail</div>
                                <input class="capitalize lightInput" type="text" name="email" ng-model="emailAd" placeholder="e-mail"/>
                                <validation validate-for="email" validate-form="form2" ng-model="emailAd"></validation>
                            </div>
                            <div class="leftButtonsArea clearElement">
                                <button type="button" class="capitalize greyButton elementRight">ok</button>
                                <button type="button" class="capitalize greyButton elementRight" data-dismiss="modal">cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
<!---->


<!--let us popup-->
<div class="modal fade" id="myModalLet" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header popupHeader">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title capitalize">Let us</h4>
            </div>
            <form name="form3">
                <div class="modal-body popupBody leftContent littleInputs">
                    <div class="inputsBlocks">
                        <div class="relativeElement marginTop10">
                            <div class="titleInput">e-mail</div>
                            <input class="capitalize lightInput" name="email" ng-model="emailAdd" type="text"/>
                            <validation validate-for="email" validate-form="form3" ng-model="emailAdd"></validation>
                        </div>
                        <div class="relativeElement marginTop10">
                            <div class="titleInput">description</div>
                            <textarea></textarea>
                        </div>
                        <div class="leftButtonsArea clearElement">
                            <button type="button" class="capitalize greyButton elementRight">ok</button>
                            <button type="button" class="capitalize greyButton elementRight" data-dismiss="modal">cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!---->
    <script type="text/javascript">
        $(document).ready(function() {

            $(".fancybox").fancybox();
        });
    </script>
    <!---->
</body>
</html>