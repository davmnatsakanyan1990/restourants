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
                ng-init="city.name"
                ng-options="item.name as item.name for item in cities"
                ng-change = "selectCity()">

        </select>
    </div>
    <div class="capitalize elementLeft searchMenuPart" style="width: calc(100% - 512px);">
        <div class="searchIcon">
            <form ng-submit="SearchRestaurantInfo(searchInfo)">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="capitalize" type="text" ng-change="SearchRestaurantInfo(searchInfo)" ng-trim="false" ng-model="searchInfo" placeholder="search" />
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
            <i class="fa fa-times" aria-hidden="true" ng-click="shearchRestaurants = false; searchInfo = ''"></i>
            <div class="companyElement clearElement">
                <div class="companies" ng-repeat="company in searcheInfo">
                    <a href="#/<% city %>/<% company.name %>/<% company.id %>">
                        <div class="companyTitle" ng-bind="company.name"></div>
                        <div class="companyAddress" ng-bind="company.address"></div>
                    </a>
                </div>
                <div class="noElementFound" ng-if="searcheInfo.length == 0">Nothing was found</div>
            </div>

        </div>
    </div>
</div>

</div>

