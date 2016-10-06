<div class="navigation" ng-class="{'close': !animateTopMenuVar && !search}">
    <div class="navIco">
        <img src="/images/logo.png">
    </div>
    <div class="mobile-menu-icon" ng-click="toggleTopMenu()" ng-class="{'animate': animateTopMenuVar}">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="menuLeft">
        <div class="nav capitalize pointer"><a class="pointer" href="#home">Home {{--<i class="fa fa-angle-down" aria-hidden="true"></i>--}} </a></div>
        <div class="nav capitalize pointer" ng-click="toggleMenu('place')"><a class="pointer">Place <i class="fa fa-angle-down" aria-hidden="true"></i></a></div>
        <div class="nav capitalize">
            <div class="searchIcon">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="capitalize" type="text" placeholder="search"/>
            </div>
        </div>
    </div>
    <div class="nav capitalize menuRight" data-toggle="modal" data-target="#myModal"><a class="pointer">Log In</a></div>

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