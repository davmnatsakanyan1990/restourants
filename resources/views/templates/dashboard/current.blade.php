
    <div>
        <div class="restPageContainer">
            <div class="pageTop clearElement">
                <div class="topLeft elementLeft" id="lightgallery">
                    <a ng-repeat="img in coverImages" href="../images/coverImages/<%img%>">
                        <img src="../images/coverImages/<%img%>" style="display: none"/>
                        <div class="leftPart" style="background-image: url('../images/coverImages/<%img%>')" id="lightgallery">
                            <div class="viewImage">
                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                {{--<div id="lightgallery">
                    <a href="../images/coverImages/<%coverImages[0]%>">
                        <img src="../images/coverImages/<%coverImages[0]%>" />
                    </a>
                    <a href="../images/coverImages/<%coverImages[1]%>">
                        <img src="../images/coverImages/<%coverImages[1]%>" />
                    </a>
                    ...
                </div>--}}
                <div class="rightPart elementRight">
                    <div class="mapPartMap">
                        <div class="map" id="map"></div>
                    </div>
                </div>
            </div>
        <div class="pageContainer" style=" width: calc(100% - 60px);">
            <div class="containerTop" id="description">
                <nav class="navbar navbar-default restNav" scroll ng-class="{'fixedNav': FixedRestMenu}">
                    <div class="container-fluid animateSecond" ng-if="!FixedRestMenu || search">
                        <ul class="nav navbar-nav">
                            <li class="menuItem1 menuItem" ><a class="pointer">Description</a></li>
                            {{--<li ng-class="{'active': activePage=='page5'}" ng-click="activePage='page5'"><a class="pointer">Shares</a></li>--}}
                            <li class="menuItem2 menuItem"><a class="pointer">Menu</a></li>
                            {{--<li ng-class="{'active': activePage=='page4'}" ng-click="activePage='page4'"><a class="pointer">Specialists</a></li>--}}
                            <li class="menuItem3 menuItem"><a class="pointer">Reviews</a></li>
                            <!--<li ng-class="{'active': activePage=='page6'}" ng-click="activePage='page6'"><a href="#3dTour">3D-tour</a></li>-->
                            <li class="menuItem4 menuItem"><a class="pointer">Photos</a></li>
                        </ul>
                    </div>
                    <div class="container-fluid animateSecond"  ng-if="FixedRestMenu && animateSecMenuVar">
                        <ul class="nav navbar-nav">
                            <li class="menuItem1 menuItem"><a class="pointer">Description</a></li>
                            {{--<li ng-class="{'active': activePage=='page5'}" ng-click="activePage='page5'"><a class="pointer">Shares</a></li>--}}
                            <li class="menuItem2 menuItem"><a class="pointer">Menu</a></li>
                            {{--<li ng-class="{'active': activePage=='page4'}" ng-click="activePage='page4'"><a class="pointer">Specialists</a></li>--}}
                            <li class="menuItem3 menuItem"><a class="pointer">Reviews</a></li>
                            <!--<li ng-class="{'active': activePage=='page6'}" ng-click="activePage='page6'"><a href="#3dTour">3D-tour</a></li>-->
                            <li class="menuItem4 menuItem"><a class="pointer">Photos</a></li>
                        </ul>
                    </div>
                    <div class="mobile-menu-icon" ng-click="toggleSecondMenu()" ng-class="{'animate': animateSecMenuVar}" ng-if="!search && FixedRestMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </nav>
                <button data-toggle="modal" data-target="#myModalMaster" class="ownerButton elementRight">Are you the owner?</button>
                {{--<div class="positioningCall">
                    <div class="numberInputPart" ng-click="togglePhoneNumber()">call me</div>
                    <div class="dropMenu" ng-if="openPhoneInput">
                        <input type="text" placeholder="write phone number">
                    </div>
                </div>
                <div class="textToday">Today at</div>
                <select class="hours">
                    <option value="t12">12:00</option>
                    <option value="t13">13:00</option>
                    <option value="t14">14:00</option>
                    <option value="t15">15:00</option>
                    <option value="t16">16:00</option>
                    <option value="t17">17:00</option>
                    <option value="t18">18:00</option>
                    <option value="t19">19:00</option>
                    <option value="t12">20:00</option>
                    <option value="t13">21:00</option>
                    <option value="t14">22:00</option>
                    <option value="t15">23:00</option>
                    <option value="t16">24:00</option>
                </select>--}}

                {{--<div class='rating' style="margin-left: 0; " ng-if="haveData">

                    <div class="lead">
                        --}}{{--<div class="starrr" ></div>--}}{{--
                        <div id="some" star-rating ng-model="rating1" max="5" on-rating-select="rateFunction(rating)" ></div>

                    </div>
                </div>--}}
               {{-- <div class="rating">
                    <span  ng-bind="currentRestaurant.comment"></span>
                    <span>comments</span>
                </div>--}}
            </div>

            <div class="containerContent">
                <div class="ban parallax"></div>
                <div class="container1 clearElement">
                    <div class="containerPart elementLeft">
                        <div class="titlePart" ng-bind="currentRestaurant.name"></div>
                        <div class="intro" ng-bind="currentRestaurant.intro"></div>
                        <div class="moreInfo" style="margin-top: 50px">
                            <div class="introTitle capitalize"><span class="doubleBorder">cuisine</span></div>
                            <div class="introContent" ng-bind="currentRestaurant.cuisins"></div>
                        </div>
                        <div class="moreInfo">
                            <div class="introTitle capitalize"><span class="doubleBorder">Type of place</span></div>
                            <div class="introContent" ng-repeat="type in currentRestaurant.types" ng-bind="type"></div>
                        </div>
                        <div class="moreInfo">
                            <div class="introTitle capitalize"><span class="doubleBorder">services</span></div>
                            <div class="introContent" ng-bind="currentRestaurant.services"></div>
                        </div>
                        <div class="mapPartContent">
                            <div class="moreInfoAddress clearElement">
                                <div class="introTitle capitalize elementLeft">address:</div>
                                <div class="introContent elementLeft" ng-bind="currentRestaurant.address"></div>
                            </div>
                            <div class="moreInfoAddress clearElement">
                                <div class="introTitle capitalize elementLeft">Site:</div>
                                <div class="introContent elementLeft" ng-bind="currentRestaurant.site"></div>
                            </div>
                            <div class="moreInfoAddress clearElement">
                                <div class="introTitle capitalize elementLeft">Price:</div>
                                <div class="introContent elementLeft" ng-bind="currentRestaurant.price"></div>
                            </div>
                        </div>

                    </div>
                    <div class="containerPart elementLeft">
                        <div class="mapPartTitle" ng-bind="currentRestaurant.mobileNumber"></div>
                        <div class="marginTop10 moreInfoAddress working">
                            <div class="introTitle capitalize elementLeft floatNone" style="width: 45%;">
                                <span class="doubleBorder">Working hours:</span>
                            </div>
                            <div class="clearElement hourBlock">
                                <div class="introContent hourContent clearElement" ng-repeat="(day,hourr) in hoursPart">
                                    <div class="capitalize infoTitle" ng-bind="day"></div>
                                    <div class="infoHour" ng-repeat="hour in hourr" ng-bind="hour"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{--<div class="container2 pages parallax" >
                    <div class="containerTitle capitalize">shares</div>
                    <div class="containerContent" ng-repeat="shareItem in currentRestaurant.shares">
                        <div class="shareItem" ng-bind="shareItem.title" data-toggle="modal" data-target="#myModalPop" ng-click="getSharesData(shareItem)"></div>
                    </div>
                    <div class="shareItem" ng-if="!currentRestaurant.shareItems || currentRestaurant.shareItems.length<1">
                        No Items found
                    </div>
                </div>--}}
                <div class="container3 pages parallax" >
                    <div class="containerTitle capitalize">menu</div>
                    <div class="clearElement">
                        <div class="containerContent elementLeft" ng-repeat="item in currentRestaurant.menuItems">
                            <button class="chooseRestMenu capitalize" ng-bind="item.name" ng-click="chooseCurrentMenu(item)"></button>
                        </div>
                    </div>
                    <div class="fillRestMenu clearElement" ng-if="CurrentMenu && currentRestaurant.menuItems">
                        <div class="testyFood elementLeft style-3" ng-repeat="menu in CurrentMenu">
                            <div class="foodTitle" ng-bind="menu.title"></div>
                            <div class="foodDescription" ng-bind="menu.description"></div>
                            <div class="foodPrice" ng-if="menu.price" ng-bind="menu.price + '$'"></div>
                        </div>
                    </div>
                </div>
                {{--<div class="container4 pages parallax" id="specialist">
                    <div class="containerTitle capitalize">specialists</div>
                    <div class="containerContent clearElement">
                        <div class="elementLeft specAllInfo" ng-repeat="spec in currentRestaurant.specialists">
                            <img class="elementLeft" src="<% spec.photo %>">
                            <div class="elementLeft SpecInfo">
                                <div class="specialistName" ng-bind="spec.name"></div>
                                <div class="specialistStar">
                                    <div class="rate" ng-if="spec.star == 1">
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                    </div>
                                    <div class="rate" ng-if="spec.star == 2">
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                    </div>
                                    <div class="rate" ng-if="spec.star == 3">
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                    </div>
                                    <div class="rate" ng-if="spec.star == 4">
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                    </div>
                                    <div class="rate" ng-if="spec.star == 5">
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        <i class="fa fa-star starColor" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="specialistProf" ng-bind="spec.prof"></div>
                                <div class="specialistInfo" ng-bind="spec.moreInfo"></div>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="container5 pages parallax" id="review">
                    <div class="containerTitle capitalize clearElement">
                        <div class="revText elementLeft">reviews</div>
                        <button class="writeComment elementRight"   ng-click="hideWrite()">Write</button>
                    </div>
                    <div class="containerContent with100">
                        <div class="writeContent" ng-class="{'hideWriteContent': writeComment}">
                            <textarea placeholder="Write your comment" ng-model="comment"></textarea>
                            <div class="doubleButtons clearElement">
                                {{--<button class="writeComment capitalize elementLeft" ng-click="ClearInner()">clear</button>--}}
                                <button class="writeComment capitalize elementLeft" ng-click="writeCommentNow(1)">send</button>
                            </div>
                        </div>
                        <div class="commentContent" ng-repeat="com in currentRestaurant.comments">
                            <div class="clearElement commentTopPart">
                                <div class="photo elementLeft marginR10" ng-bind="com.name.substring(0,1)">
                                    <img ng-src="images/users/<%com.img%>" ng-if="com.img"/>
                                </div>
                                <div class="elementLeft">
                                    <div class="clearElement">
                                        <div class="name elementLeft marginR10" ng-bind="com.name"></div>
                                        <div class="time elementLeft" ng-bind="com.date"></div>
                                    </div>
                                    <div class="rate ">
                                        <div class="rate" ng-if="com.rate == 1">
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        </div>
                                        <div class="rate" ng-if="com.rate == 2">
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        </div>
                                        <div class="rate" ng-if="com.rate == 3">
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        </div>
                                        <div class="rate" ng-if="com.rate == 4">
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                        </div>
                                        <div class="rate" ng-if="com.rate == 5">
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                            <i class="fa fa-star starColor" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment" ng-bind="com.comment"></div>
                            <span class="replyOpen" ng-click="openReply($event)" ng-if="logedUser">reply</span>
                            <div class="writeSubComment clearElement" ng-if="logedUser">
                                <input type="text" class="elementLeft replyInput" placeholder="Reply to this comment" ng-model="com.commentReply"/>
                                <button class="replyButton elementLeft" ng-click="writeCommentNow(com)">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="subComment" ng-if="com.subComment">
                                <div class="commentContent" ng-repeat="sub in com.subComment">
                                    <div class="clearElement commentTopPart">
                                        <div class="photo elementLeft marginR10" ng-bind="sub.name.substring(0,1)">
                                            <img ng-src="images/users/<%sub.img%>" ng-if="sub.img"/>
                                        </div>
                                        <div class="elementLeft">
                                            <div class="clearElement">
                                                <div class="name elementLeft marginR10" ng-bind="sub.name"></div>
                                                <div class="time elementLeft" ng-bind="sub.date"></div>
                                            </div>
                                            <div class="rate ">
                                                <div class="rate" ng-if="sub.rate == 1">
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                </div>
                                                <div class="rate" ng-if="sub.rate == 2">
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                </div>
                                                <div class="rate" ng-if="sub.rate == 3">
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                </div>
                                                <div class="rate" ng-if="sub.rate == 4">
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starGrey" aria-hidden="true"></i>
                                                </div>
                                                <div class="rate" ng-if="sub.rate == 5">
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                    <i class="fa fa-star starColor" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment" ng-bind="sub.comment"></div>
                                </div>
                            </div>

                        </div>
                        <div class="bottomPart">
                            <button class="capitalize writeComment " ng-click="moreComments()" ng-if="moreCommentsToShow">show more</button>
                        </div>
                    </div>
                </div>
                <div class="container6 pages parallax" id="photos">
                    <div class="containerTitle capitalize">visitor photos</div>
                    <div class="containerContent with100 owl-cont">
                        <data-owl-carousel class="owl-carousel" data-options="{nav: true, loop: true, center: true, pagination: false, rewindNav : false, autoplay: true, responsiveClass:true, margin:10, merge:true, responsive: { 0: {items:1}, 538: {items:2}, 756: {items:3}, 980: {items:4}, 1200: {items:5}, 1480: {items:6}, 1670: {items:7} }}">
                            <div ng-if="arr.length>0" owl-carousel-item="" ng-repeat="img in arr" class="item">
                                <img ng-src="<%img%>" alt="">
                            </div>
                        </data-owl-carousel>

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
                                   socialshare-type="share"
                                   socialshare-provider="facebook"
                                   socialshare-text="Restadviser"
                                   socialshare-title="<% currentRestaurant.name %>"
                                   socialshare-media="http://restadviser.com/images/coverImages/<% coverImages[0] %>"
                                   socialshare-description = "<%currentRestaurant.address%>"
                                   socialshare-url="<% lnk %>"
                                   socialshare-via="129554920871527">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a
                                   socialshare
                                   socialshare-provider="twitter"
                                   socialshare-text="<% currentRestaurant.name %>"
                                   {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                                   socialshare-url="<% lnk %>">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a
                                        socialshare
                                        socialshare-provider="linkedin"
                                        socialshare-text="Restadviser"
                                        socialshare-description="<% currentRestaurant.name %>"
                                        {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                                        socialshare-url="<%lnk%>">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                                <a
                                        socialshare
                                        socialshare-provider="google"
                                        socialshare-text="Restadviser"
                                        {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                                        socialshare-url="<%lnk%>">
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
        </div>
    </div>

    <!--show shares popup-->
    <div class="modal fade" id="myModalPop" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header popupHeader">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title capitalize" ng-bind="SharesPopupData.title"></h4>
                </div>
                <div class="modal-body popupBody leftContent sharesPopup">
                    <p ng-bind="SharesPopupData.content"></p>
                    <img src="../images/sharesImages/<% SharesPopupData.photo %>">
                    <div class="clearElement margin15 font16">
                        <i class="fa fa-map-marker elementLeft" aria-hidden="true"></i><% SharesPopupData.location %>
                    </div>
                    <div class="clearElement margin15 font16">
                        <i class="fa fa-clock-o elementLeft" aria-hidden="true"></i><% SharesPopupData.workingHours %>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!---->

    <!--logIn popup-->
    <div class="modal fade" id="myModalLogin" role="dialog">
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
    <!---->

</div>

