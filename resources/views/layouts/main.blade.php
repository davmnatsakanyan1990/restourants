<!DOCTYPE html>
<html lang="en">
<head>
    @include("layouts.partials.htmlheader")
    @include("layouts.partials.scripts")
</head>
<body ng-app="myApp" ng-controller="rootController">
    @include("layouts.partials.menu")
    <ng-view></ng-view>

    <!--logIn popup-->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header popupHeader">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title capitalize">log in</h4>
                </div>
                <div class="modal-body popupBody">
                    <input class="capitalize lightInput" type="text" placeholder="name"/>
                    <input class="capitalize lightInput" type="text" placeholder="E-mail"/>
                    <input class="capitalize lightInput" type="password" placeholder="password"/>
                </div>
                <div class="modal-footer popupFooter">
                    <button type="button" class="filterButtons popupButton capitalize" data-dismiss="modal">Close</button>
                    <button type="button" class="filterButtons popupButton capitalize">log in</button>
                </div>
            </div>
        </div>
    </div>
    <!---->

    <!--add location popup-->
    <div class="modal fade" id="myModalLocation" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header popupHeader">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title capitalize">add location</h4>
                </div>
                <div class="modal-body popupBody leftContent littleInputs">
                    <div class="inputsBlocks">
                        <div class="inputBlock">
                            <div class="titleInput">Name</div>
                            <input class="capitalize lightInput" type="text" placeholder="name"/>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">address</div>
                            <input class="capitalize lightInput" type="text" placeholder="address"/>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">phone number</div>
                            <input class="capitalize lightInput" type="text" placeholder="phone number"/>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">description</div>
                            <textarea placeholder="description"></textarea>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">website</div>
                            <input class="capitalize lightInput" type="text" placeholder="website"/>
                        </div>
                        <div class="inputBlock">
                            <div class="titleInput">e-mail</div>
                            <input class="capitalize lightInput" type="text" placeholder="e-mail"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer popupFooter">
                    <div class="leftButtonsArea">
                        <button type="button" class="capitalize greyButton" data-dismiss="modal">cancel</button>
                        <button type="button" class="capitalize greyButton">ok</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!---->

    <!--add master popup-->
    <div class="modal fade" id="myModalMaster" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header popupHeader">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title capitalize">add master</h4>
                </div>
                <form>
                    <div class="modal-body popupBody leftContent littleInputs">
                        <div class="inputsBlocks">
                            <div class="inputBlock">
                                <div class="titleInput">Name</div>
                                <input class="capitalize lightInput" type="text" placeholder="name"/>
                            </div>
                            <div class="inputBlock">
                                <div class="titleInput">sureName</div>
                                <input class="capitalize lightInput" type="text" placeholder="sureName"/>
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
                            <div class="inputBlock">
                                <div class="titleInput">phone number</div>
                                <input class="capitalize lightInput" type="text" placeholder="phoneNumber"/>
                            </div>
                            <div class="inputBlock">
                                <div class="titleInput">description</div>
                                <textarea placeholder="description"></textarea>
                            </div>
                            <div class="inputBlock">
                                <div class="titleInput">website</div>
                                <input class="capitalize lightInput" type="text" placeholder="website"/>
                            </div>
                            <div class="inputBlock">
                                <div class="titleInput">e-mail</div>
                                <input class="capitalize lightInput" type="text" placeholder="e-mail"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer popupFooter">
                        <div class="leftButtonsArea">
                            <button type="button" class="capitalize greyButton" data-dismiss="modal">cancel</button>
                            <button type="button" class="capitalize greyButton">ok</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!---->
</body>
</html>