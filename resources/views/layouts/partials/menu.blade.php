<div class="navigation" ng-class="{'close': !animateTopMenuVar && !search}">
    <div class="navIco">
        <a href="#home"><img src="../images/logo.png"></a>
    </div>
    <div class="mobile-menu-icon" ng-click="toggleTopMenu()" ng-class="{'animate': animateTopMenuVar}">
        <span></span>
        <span></span>
        <span></span>
    </div>
    {{--<div class="menuLeft">
        <div class="nav capitalize pointer"><a class="pointer" href="#home">Home --}}{{--<i class="fa fa-angle-down" aria-hidden="true"></i>--}}{{-- </a></div>
        --}}{{--<div class="nav capitalize pointer" ng-click="toggleMenu('place')"><a class="pointer">Place <i class="fa fa-angle-down" aria-hidden="true"></i></a></div>--}}{{--

    </div>--}}
    <div class="elementLeft chosenStyles">
        <select chosen
                data-placeholder-text-single="'Select some city'"
                ng-model="city"
                ng-init="city"
                ng-options="item as item.name for item in cities">
        </select>
    </div>
    <div class="capitalize elementLeft searchMenuPart" style="width: calc(100% - 512px);">
        <div class="searchIcon">
            <form ng-submit="SearchRestaurantInfo(searchInfo)">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="capitalize" type="text" ng-model="searchInfo" placeholder="search" />
            </form>

        </div>
    </div>
    <div class="nav capitalize menuRight" data-toggle="modal" data-target="#myModal" ng-if="!logedUser"><a class="pointer">Log In</a></div>
    <div class="loginLogout" ng-if="logedUser">
        <div class="user menuRight" ng-bind="userFirstLetter" ng-if="logedUser" ng-click="toggleLogOut()"></div>
        <div class="logout" ng-if="openLogOut" ng-click = "logout()">log out</div>
    </div>



    <div class="dropdownMenu" ng-show="shearchRestaurants" ng-class="{'secondPart': !first}">
        <div class="dropdownInner" ng-class="first ? 'first' : 'second'">
            <i class="fa fa-times" aria-hidden="true" ng-click="shearchRestaurants = false"></i>
            <div class="companyElement clearElement">
                <div class="companies" ng-repeat="company in searcheInfo">
                    <a href="#/<% city %>/<% company.name %>/<% company.id %>">
                        <div class="companyTitle" ng-bind="company.title">Name name anem name</div>
                        <div class="companyAddress" ng-bind="company.address">address address address address</div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>



    {{--<div class="dropdownMenu" ng-show="custom" ng-class="{'secondPart': !first}">
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
    </div>--}}

</div>

