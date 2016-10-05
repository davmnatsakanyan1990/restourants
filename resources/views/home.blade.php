<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <title>Project</title>
    <link rel="stylesheet" href="/styles/ui.css" type="text/css" />
    <link rel="stylesheet" href="/styles/styleL.css" type="text/css" />
    <link rel="stylesheet" href="/styles/slider.css" type="text/css" />
    <link rel="stylesheet" type="/text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/icons/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/c/ss" href="/styles/customChackbox.css">

    <script src="/lib/jquery-3.1.0.min.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="/lib/angular.min.js"></script>
    <script src="/ng/app.js"></script>
    <script src="/ng/controller/RootCtrl.js"></script>
    <script src="/ng/directive/scroll.js"></script>

</head>
<body ng-app="myApp" ng-controller="rootController">

<div class="navig/ation" ng-class="{'close': !animateTopMenuVar && !search}">
    <div class="navIco">
        <img src="/images/logo.png">
    </div>
    <div class="mobile-menu-icon" ng-click="toggleTopMenu()" ng-class="{'animate': animateTopMenuVar}">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="menuLeft">
        <div class="nav capitalize" ng-click="toggleMenu('home')"><a href="#">Home <i class="fa fa-angle-down" aria-hidden="true"></i> </a></div>
        <div class="nav capitalize" ng-click="toggleMenu('place')"><a href="#">Place <i class="fa fa-angle-down" aria-hidden="true"></i></a></div>
        <!--<div class="nav capitalize" ng-click="showSearch()" ng-if="search"><a href="#"><i class="fa fa-search" aria-hidden="true"></i> Search</a></div>-->
        <div class="nav capitalize">
            <div class="searchIcon">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="capitalize" type="text" placeholder="search"/>
            </div>
        </div>
    </div>
    <div class="nav capitalize menuRight" data-toggle="modal" data-target="#myModal"><a href="#">Log In</a></div>

    <div class="dropdownMenu" ng-show="custom" ng-class="{'secondPart': !first}">
        <div class="dropdownInner" ng-class="first ? 'first' : 'second'">
            <div class="dropdownInnerText" ng-if="first" ng-repeat="category in categories">
                <div class="dropdownTitle" ng-bind="category.title"></div>
                <div class="dropdownText" ng-bind="category.text"></div>
            </div>
            <div class="topButtons" ng-if="!first">
                <button class="filterButtons mergedButtons">Country1</button>
                <button class="filterButtons mergedButtons">Country1</button>
                <button class="filterButtons mergedButtons">Country1</button>
                <button class="filterButtons mergedButtons">Country1</button>

            </div>
            <div class="dropdownInnerText2" ng-if="!first">
                <div class="dropdownText" ng-if="places.length>0">
                    <div  ng-repeat="place in places[0] track by $index" ng-bind="place">
                    </div>
                </div>
                <div class="dropdownText" ng-if="places.length>1">
                    <div ng-repeat="place in places[1] track by $index" ng-bind="place"></div>
                </div>
                <div class="dropdownText" ng-if="places.length>2">
                    <div ng-repeat="place in places[2] track by $index" ng-bind="place"></div>
                </div>
                <div class="dropdownText" ng-if="places.length>3">
                    <div ng-repeat="place in places[3] track by $index" ng-bind="place"></div>
                </div>
                <div class="dropdownText" ng-if="places.length>4">
                    <div ng-repeat="place in places[4] track by $index" ng-bind="place"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="content" ng-controller="MapCtrl">
    <div class="sliderSection">
        <h1 class="headTitle">
            <span class="titleFirstPart">Choose your favorite</span>
            <span class="titleSecondPart">- all in same place</span>
        </h1>
        <p class="headBody">
            We have found for you more than 1,000 restaurants in your city. All restaurants with user reviews, ratings and photos.
        </p>
        <div class="slider">
            <!-- Start cssSlider.com -->
            <div class='csslider1 autoplay '>
                <input name="cs_anchor1" id='cs_slide1_0' type="radio" class='cs_anchor slide' >
                <input name="cs_anchor1" id='cs_slide1_1' type="radio" class='cs_anchor slide' >
                <input name="cs_anchor1" id='cs_slide1_2' type="radio" class='cs_anchor slide' >
                <input name="cs_anchor1" id='cs_play1' type="radio" class='cs_anchor' checked>
                <input name="cs_anchor1" id='cs_pause1' type="radio" class='cs_anchor' >
                <ul>
                    <div style="width: 100%; visibility: hidden; font-size: 0px; line-height: 0;">
                        <img src="http://cssslider.com/sliders/pen/images/buns.jpg" style="width: 100%;">
                    </div>
                    <li class='num0 img'>
                        <a href="http://cssslider.com" target=""><img src='/images/sliderImages/slider1.jpg' alt='Buns' title='Buns' /> </a>
                    </li>
                    <li class='num1 img'>
                        <a href="http://cssslider.com" target=""><img src='/images/sliderImages/slider2.jpg' alt='Croissant' title='Croissant' /> </a>
                    </li>
                    <li class='num2 img'>
                        <a href="http://cssslider.com" target=""><img src='/images/sliderImages/slider3.jpg' alt='Lemon pie' title='Lemon pie' /> </a>
                    </li>

                </ul>
                <!--<div class='cs_description'>
                    <label class='num0'>
                        <span class="cs_title"><span class="cs_wrapper">Buns</span></span>
                    </label>
                    <label class='num1'>
                        <span class="cs_title"><span class="cs_wrapper">Croissant</span></span>
                    </label>
                    <label class='num2'>
                        <span class="cs_title"><span class="cs_wrapper">Lemon pie</span></span>
                    </label>
                </div>-->

                <!--<div class='cs_arrowprev'>
                    <label class='num0' for='cs_slide1_0'></label>
                    <label class='num1' for='cs_slide1_1'></label>
                    <label class='num2' for='cs_slide1_2'></label>
                </div>
                <div class='cs_arrownext'>
                    <label class='num0' for='cs_slide1_0'></label>
                    <label class='num1' for='cs_slide1_1'></label>
                    <label class='num2' for='cs_slide1_2'></label>
                </div>

                <div class='cs_bullets'>
                    <label class='num0' for='cs_slide1_0'>
                        <span class='cs_point'></span>
                        <span class='cs_thumb'><img src='http://cssslider.com/sliders/pen/tooltips/buns.jpg' alt='Buns' title='Buns' /></span>
                    </label>
                    <label class='num1' for='cs_slide1_1'>
                        <span class='cs_point'></span>
                        <span class='cs_thumb'><img src='http://cssslider.com/sliders/pen/tooltips/croissant.jpg' alt='Croissant' title='Croissant' /></span>
                    </label>
                    <label class='num2' for='cs_slide1_2'>
                        <span class='cs_point'></span>
                        <span class='cs_thumb'><img src='http://cssslider.com/sliders/pen/tooltips/lemonpie.jpg' alt='Lemon pie' title='Lemon pie' /></span>
                    </label>
                </div>-->
            </div>
            <!-- End cssSlider.com -->
        </div>
        <div class="secondNav" id="secondNav" scroll ng-class="{'closeSecondNav': !animateSecondMenuVar && visibleLittleMenu, 'fixedNavigation': visibleLittleMenu}">
            <div class="mobile-menu-icon" ng-click="toggleSecondMenu()" ng-class="{'animate': animateSecondMenuVar}" ng-if="visibleLittleMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="NavButtons clear ">
                <li class="navSecond capitalize" ng-click="displayElement('f1')">mode
                    <div id="f1" class="filters displayNone">
                        <span class="triangle"></span>
                        <p>
                            <input type="checkbox" id="test1" />
                            <label for="test1">Day and night</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test2"  />
                            <label for="test2">Now open</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test3" />
                            <label for="test3">Will be open yet 2 hours</label>
                        </p>
                        <button class=" filterButtons capitalize">cancel</button>
                        <button class="filterButtons capitalize">ok</button>
                    </div>
                </li>
                <li class="navSecond capitalize" ng-click="displayElement('f2')">cost
                    <div id="f2" class="filters displayNone">
                        <span class="triangle"></span>
                        <p>
                            <input type="checkbox" id="test12" />
                            <label for="test12">Up to 1000</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test22"  />
                            <label for="test22">1000 - 1500</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test32" />
                            <label for="test32">1500-2000</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test42" />
                            <label for="test42">more then 2000</label>
                        </p>
                        <button class=" filterButtons capitalize">cancel</button>
                        <button class="filterButtons capitalize">ok</button>
                    </div>
                </li>
                <li class="navSecond capitalize" ng-click="displayElement('f3')">rating
                    <div id="f3" class="filters displayNone">
                        <span class="triangle"></span>
                        <p>
                            <input type="checkbox" id="test13" />
                            <label for="test13">Red</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test23"  />
                            <label for="test23">Yellow</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test33" />
                            <label for="test33">Green</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test43" />
                            <label for="test43">Brown</label>
                        </p>
                        <button class=" filterButtons capitalize">cancel</button>
                        <button class="filterButtons capitalize">ok</button>
                    </div>
                </li>
                <li class="navSecond capitalize" ng-click="displayElement('f4')">cuisine
                    <div id="f4" class="filters displayNone">
                        <span class="triangle"></span>
                        <p>
                            <input type="checkbox" id="test14" />
                            <label for="test14">Red</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test24"  />
                            <label for="test24">Yellow</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test34" />
                            <label for="test34">Green</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test44" />
                            <label for="test44">Brown</label>
                        </p>
                        <button class=" filterButtons capitalize">cancel</button>
                        <button class="filterButtons capitalize">ok</button>
                    </div>
                </li>
                <li class="navSecond capitalize" ng-click="displayElement('f5')">type of restaurants
                    <div id="f5" class="filters displayNone">
                        <span class="triangle"></span>
                        <p>
                            <input type="checkbox" id="test15" />
                            <label for="test15">Red</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test25"  />
                            <label for="test25">Yellow</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test35" />
                            <label for="test35">Green</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test45" />
                            <label for="test45">Brown</label>
                        </p>
                        <button class=" filterButtons capitalize">cancel</button>
                        <button class="filterButtons capitalize">ok</button>
                    </div>
                </li>
                <li class="navSecond capitalize" ng-click="displayElement('f6')">services
                    <div id="f6" class="filters displayNone">
                        <span class="triangle"></span>
                        <p>
                            <input type="checkbox" id="test16" />
                            <label for="test16">Red</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test26"  />
                            <label for="test26">Yellow</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test36" />
                            <label for="test36">Green</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test46" />
                            <label for="test46">Brown</label>
                        </p>
                        <button class=" filterButtons capitalize">cancel</button>
                        <button class="filterButtons capitalize">ok</button>
                    </div>
                </li>

                <div class="toTop" ng-if="visibleLittleMenu" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                    <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                </div>

            </ul>
        </div>

        <!--second nav fixed-->

        <!--end fixed nav-->
    </div>
    <div class="pageSection">
        <div class="headSection">
            <ul>
                <li class="capitalize" data-toggle="modal" data-target="#myModal2">area</li>
                <li class="capitalize" data-toggle="modal" data-target="#myModal3">metro</li>
                <li class="capitalize" data-toggle="modal" data-target="#myModal4" ng-click="openDrop()">sorting
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                    <div class="dropdown2" ng-if="openDropMenu">
                        <div class="options"><i class="fa fa-check" aria-hidden="true"></i>
                            for default
                        </div>
                        <div class="options"><i class="fa fa-check" aria-hidden="true"></i>
                            for rating
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="cont" >
            <div class="infoContent">
                <div class="info" ng-repeat="info in markers" ng-class="{'active': clichedElementId == info.id}" ng-click="openInfoWindow($event, info)">
                    <div class="imageSection">
                        <img src="<% info.image %>">
                    </div>
                    <div class="textSection">
                        <div class="title" ng-bind="info.title"></div>
                        <div class="text" ng-bind="info.service"></div>
                        <div class="rate" ng-if="info.rating ==1">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="rate" ng-if="info.rating ==2">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="rate" ng-if="info.rating ==3">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="rate" ng-if="info.rating ==4">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="rate" ng-if="info.rating ==5">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="explanation" ng-bind="info.explane"></div>
                    </div>
                </div>
                <button class="showMoreButton" ng-click="addMorePoints()" id="active">show more</button>
                <div class="additionalInfo">
                    <div class="additionalTitle">Restaurants in nearby towns</div>
                    <div class="imageAndInfo" ng-repeat="adInfo in additionalInfo">
                        <img src="<% adInfo.image %>"/>
                        <div class="info">
                            <div class="infoTitle" ng-bind="adInfo.title"></div>
                            <div class="moreInfo" ng-bind="adInfo.more"></div>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <div class="footerText">
                    <div class="footerSec">
                        <div class="footerText" data-toggle="modal" data-target="#myModalLocation">add location</div>
                        <div class="footerText" data-toggle="modal" data-target="#myModalMaster">add master</div>
                        <div class="footerText">for organization</div>
                    </div>
                    <div class="footerSec">
                        <div class="footerText">contacts</div>
                        <div class="footerText">about project</div>
                        <div class="footerText">Noticed a Mistake - let us</div>
                    </div>
                </div>
                <div class="socialIco">
                    <div class="fb">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </div>
                    <div class="twit">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </div>
                    <div class="google">
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </div>

                </div>
            </footer>
        </div>

    </div>
</div>

<!-- popups-->
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

<!--choose area popup-->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content fixedPopupContent">
            <div class="modal-header popupHeader">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title capitalize">choose area</h4>
            </div>
            <div class="modal-body popupBody leftContent">
                <p>Some text in the modal.</p>
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

<!--choose metro station popup-->
<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header popupHeader">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title capitalize">metro stations</h4>
            </div>
            <div class="modal-body popupBody leftContent">
                <p>Some text in the modal.</p>
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
<div class="maps" >
    <div id="map" style="width:100%;height:100%"></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkB3G-qzliKWCg-x_LYj_BlP5wNRvg2BA&libraries=places" async defer></script>
<script src="/ng/controller/MapController.js" ></script>






</body>
</html>


<!--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkB3G-qzliKWCg-x_LYj_BlP5wNRvg2BA&libraries=places&callback=initMap" async defer></script>-->
