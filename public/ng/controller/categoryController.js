app.controller('CategoryCtr', function ($scope, $http, $document, $window, $timeout,$route, RestaurantService) {
    var request = $route.current.params;
    $scope.custom = false;
    $scope.openDropMenu = false;
    $scope.animateTopMenuVar = false;
    $scope.animateSecondMenuVar = false;
    $scope.activePage = 'page1';
    $scope.FixedRestMenu = false;
    $scope.noMoreInfoToShow = false;
    $scope.id =request.id;
    /*var name = request.name;*/
    $scope.checkboxModel = {
        checkboxModelF1: [],
        checkboxModelF2: [],
        checkboxModelF3: [],
        checkboxModelF4: [],
        checkboxModelF5: [],
        checkboxModelF6: []
    };
    $scope.checkboxModel.checkboxModelF1[0] = {};
    $scope.checkboxModel.checkboxModelF1[0][request.name] = true;

    $scope.filters = {};
    $scope.callData = {
        page: 1,
        city: request.city,
        filters: {'Mode': [request.id] }
    };

    $scope.modeLoad = false;
    // if(request.page)
    //     var slidePage = request.page;
    // else
    //     var slidePage = 1;

    //console.log(slidePage);
    //slidePage += 1;
    $scope.city = request.city;
    var myCallData = {page: $scope.callData.page, filters:{ Mode: [request.name]}};
    RestaurantService.getMode(myCallData, $scope.city)
        .then(function (response) {
            $scope.showFilters = response.data.filters;

            $scope.restaurants = response.data.restaurants;

            //top sider
            $scope.category = [];

            if(window.innerWidth > 600){
                $scope.modeLoad = true;
                for(var a=0; a< response.data.filters.Mode.length; a++){
                    $scope.category.push({
                        'name' : response.data.filters.Mode[a].name,
                        'id' : response.data.filters.Mode[a].id,
                        'image' : '../images/foodImages/'+(a+1)+'.png',
                        'image2': '../images/foodImages/'+(a+1)+'1.png'})
                }
            }else{
                $scope.modeLoad = false;
            }

            $scope.drowCuisine = [];
            for(var p = 0; p < $scope.showFilters.Cuisine.length; p++){
                $scope.drowCuisine.push({"display": $scope.showFilters.Cuisine[p], "pass" : $scope.showFilters.Cuisine[p]})
            }
            $scope.drowMode = [];
            for(var m = 0; m < $scope.showFilters.Mode.length; m++){
                $scope.drowMode.push({"display": $scope.showFilters.Mode[m], "pass" : $scope.showFilters.Mode[m]})
            }
            $scope.drowSort = [];
            for(var n = 0; n < $scope.showFilters['Sort By'].length; n++){
                $scope.drowSort.push({"display": $scope.showFilters['Sort By'][n], "pass" : $scope.showFilters['Sort By'][n]})
            }
            $scope.drowType = [];
            for(var q = 0; q < $scope.showFilters['Type Of Restaurants'].length; q++){
                $scope.drowType.push({"display": $scope.showFilters['Type Of Restaurants'][q], "pass" : $scope.showFilters['Type Of Restaurants'][q]})
            }
            $scope.drowCLocation = [];
            for(var r = 0; r < $scope.showFilters['Location'].length; r++){
                $scope.drowCLocation.push({"display": $scope.showFilters['Location'][r], "pass" : $scope.showFilters['Location'][r]})
            }

            if(response.data.restaurants.length > 0) {
                $scope.initMap({
                    zoom: 12,
                    center: new google.maps.LatLng($scope.restaurants[0].lat * 1, $scope.restaurants[0].long * 1 - 0.3),
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.TERRAIN
                });

                for (i = 0; i < $scope.restaurants.length; i++) {
                    createMarker($scope.restaurants[i]);
                }
            }
            else{
                $scope.markers = [];
            }

            $scope.$parent.docLoader = false;

        });

    $scope.addMorePoints = function(){
        $scope.loading = true;
        $scope.callData.page++;
        RestaurantService.getMoreRestaurant($scope.callData.page, $scope.callData.city, $scope.callData.filters)
            .then(function (response) {
                if(response.data.status && response.data.status == 'ended'){
                    $scope.noMoreInfoToShow = true;
                }
                var sum = 0;
                $scope.markers = [];
                angular.forEach(response.data.restaurants, function(value, key){
                    createMarker(value);
                    /*$scope.restaurants = [];*/
                    /*$scope.restaurants.push(value);*/
                });
                $scope.restaurants = response.data.restaurants;
                $scope.loading = false;

            });
    };

    $scope.initMap = function(mapOptions){

        var mapOptions = mapOptions || {
                zoom: 12,
                center: new google.maps.LatLng(40.0000, -98.0000),
                mapTypeId: google.maps.MapTypeId.TERRAIN
            };

        $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);

        $scope.markers = [];

        var bounds = new google.maps.LatLngBounds();
        for (var i in $scope.markers) // your marker list here
            bounds.extend($scope.markers[i].position) // your marker position, must be a LatLng instance

        $scope.map.fitBounds(bounds); // map should be your map class
        $scope.map.setCenter(mapOptions.center); //set after fitBounds

        var listener = google.maps.event.addListener($scope.map, "idle", function() {
            $scope.map.setZoom(mapOptions['zoom']);
            google.maps.event.removeListener(listener);
        });
    };

    var infoWindow = new google.maps.InfoWindow();


    $scope.openInfoWindow = function(e, selectedMarker){
        e.preventDefault();
        google.maps.event.trigger( selectedMarker, 'click');
        $scope.map.setCenter(selectedMarker['hoverPosition']); //set after fitBounds
    };

    var createMarker = function (info){
        /*var pinIcon;
         switch (info.id) {
         case 1:
         pinIcon = 'images/1(1).png';
         break;
         case 2:
         pinIcon = 'images/2(2).png';
         break;
         case 3:
         pinIcon = 'images/3(3).png';
         break;
         case 4:
         pinIcon = 'images/4(4).png';
         break;
         }*/
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.long),
            icon: 'images/1(1).png',
            title: info.title,
            id: info.id,
            image: info.image,
            last_comment: info.last_comment,
            explane: info.explane,
            rating: info.rating,
            hoverPosition: new google.maps.LatLng(info.lat*1+0.043, info.long*1-0.106),

        });

        marker.content = '<div class="infoWindowContent">' + info.explane + '</div>';

        google.maps.event.addListener(marker, 'click', function(){
            infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
            infoWindow.open($scope.map, marker);
            $scope.clichedElementId = marker.id;

            $scope.$watch('clichedElementId', function() {

                var element = document.getElementsByClassName('active');
                for (var i = 0; i < element.length; i++) {
                    var el = element[i];
                    var pos = el.offsetTop
                };
                /* window.scrollTo(0, pos);*/

            });
            $scope.safeApply = function(fn) {
                var phase = this.$root.$$phase;
                if(phase == '$apply' || phase == '$digest') {
                    if(fn && (typeof(fn) === 'function')) {
                        fn();
                    }
                } else {
                    this.$apply(fn);
                }
            };
            $scope.safeApply(
                $scope.clichedElementId
            );
        });


        $scope.markers.push(marker);
    };

    //end processes for map

    // open top dropdown menu section
    $scope.openDrop = function(){
        $scope.openDropMenu = $scope.openDropMenu === false ? true: false;
    };

    $scope.$watch(function () {
        return $window.scrollY;
    }, function (scrollY) {
        if(scrollY >= 330){
            $scope.visibleLittleMenu = true;

        }else{
            $scope.visibleLittleMenu = false;
        }
    });

    //toggling second menu
    $scope.toggleSecondMenu = function(){
        $scope.animateSecondMenuVar = $scope.animateSecondMenuVar === false ? true: false;
    };

    //display second menu elements
    $scope.displayElement = function (id) {
        var element1 = document.getElementById('f1');
        var element2 = document.getElementById('f2');
        var element3 = document.getElementById('f3');
        var element4 = document.getElementById('f4');
        var element5 = document.getElementById('f5');
        var element6 = document.getElementById('f6');
        var element = document.getElementById(id);
        if(element1!=element){
            element1.classList.remove('displayBlock');
            element1.classList.add('displayNone');
        }
        if(element2!=element){
            element2.classList.remove('displayBlock');
            element2.classList.add('displayNone');
        }
        if(element3!=element){
            element3.classList.remove('displayBlock');
            element3.classList.add('displayNone');
        }
        if(element4!=element){
            element4.classList.remove('displayBlock');
            element4.classList.add('displayNone');
        }
        if(element5!=element){
            element5.classList.remove('displayBlock');
            element5.classList.add('displayNone');
        }
        if(element6!=element){
            element6.classList.remove('displayBlock');
            element6.classList.add('displayNone');
        }
        if(element.classList.contains('displayBlock')){
            element.classList.remove('displayBlock');
            element.classList.add('displayNone');
        }else if(element.classList.contains('displayNone')){
            element.classList.remove('displayNone');
            element.classList.add('displayBlock');
        }
    };

    var elementAlreadyExist = false;

    //when add a filter from second menu
    $scope.pushElementInFilter = function (index, type) {
        if(index.length > 0) {
            $scope.callData.filters[type] = [];
            $scope.filters[type] = [];

            for (var k in index) {
                for (var key in index[k]) {
                    if (key) {
                        if (index[k][key] == false) {
                            var elementDeleted = true;
                        } else {
                            elementDeleted = false;
                        }

                        if ($scope.filters[type].length == 0) {
                            if(!elementDeleted){
                                $scope.filters[type].push({'id' : k, 'name' :  key });
                            }
                        } else {
                            for (var t = 0; t < $scope.filters[type].length; t++) {

                                if (key == $scope.filters[type][t]) {
                                    elementAlreadyExist = true;
                                    if (elementDeleted) {
                                        $scope.filters[type].splice(t, 1);
                                        delete index[k][key];
                                    }
                                    break;
                                } else {
                                    elementAlreadyExist = false;
                                }
                            }
                            if (!elementDeleted) {
                                $scope.filters[type].push({'id' : k, 'name' :  key });
                            }
                        }
                    }
                }

                $scope.callData.filters[type].push(k);
            }

            $scope.callData.page = 1;
            $scope.callData.city = request.city;

            RestaurantService.filterRestaurant($scope.callData)
                .then(function (response) {

                    if(response.data.restaurants) {
                        if(response.data.status && response.data.status == 'ended'){
                            $scope.noMoreInfoToShow = true;
                        }

                        $scope.restaurants = response.data.restaurants;
                        if(response.data.restaurants.length > 0) {
                            $scope.initMap({
                                zoom: 12,
                                center: new google.maps.LatLng($scope.restaurants[0].lat * 1 + 0.003, $scope.restaurants[0].long * 1 - 0.016),
                                scrollwheel: false,
                                mapTypeId: google.maps.MapTypeId.TERRAIN
                            });


                            for (i = 0; i < $scope.restaurants.length; i++) {
                                createMarker($scope.restaurants[i]);
                            }
                        }
                        else{
                            $scope.markers = [];
                        }
                    }
                    else {
                        $scope.markers = [];
                        $scope.noMoreInfoToShow = true;

                    }
                });
        }
    }
    ;

    //when delete a filter after click in it
    $scope.deleteElementFromFilter = function (filter, type) {
        if(type == 'Mode')
            $scope.checkboxModel.checkboxModelF1[filter.id] = false;

        if(type == 'Cost')
            $scope.checkboxModel.checkboxModelF2[filter.id] = false;

        if(type == 'Sort By')
            $scope.checkboxModel.checkboxModelF3[filter.id] = false;

        if(type == 'Cuisine')
            $scope.checkboxModel.checkboxModelF4[filter.id] = false;

        if(type == 'Type')
            $scope.checkboxModel.checkboxModelF5[filter.id] = false;

        if(type == 'Location')
            $scope.checkboxModel.checkboxModelF6[filter.id] = false;


        for(var m=0; m < $scope.filters[type].length; m++){
            if(filter.id == $scope.filters[type][m].id){
                $scope.filters[type].splice(m, 1);
                $scope.callData.filters[type].splice(m,1);
            }
        }

        RestaurantService.filterRestaurant($scope.callData)
            .then(function (response) {

                if(response.data.restaurants) {
                    if(response.data.status && response.data.status == 'ended'){
                        $scope.noMoreInfoToShow = true;
                    }
                    else{
                        $scope.noMoreInfoToShow = false;
                    }

                    $scope.restaurants = response.data.restaurants;

                    $scope.initMap({
                        zoom: 16,
                        center: new google.maps.LatLng($scope.restaurants[0].lat*1, $scope.restaurants[0].long*1 -0.3),
                        scrollwheel: false,
                        mapTypeId: google.maps.MapTypeId.TERRAIN
                    });

                    for (i = 0; i < $scope.restaurants.length; i++) {
                        createMarker($scope.restaurants[i]);
                    }
                }
                else {
                    $scope.markers = [];
                    $scope.noMoreInfoToShow = true;

                }
            });
    };



  setTimeout(function() {
        console.log(document.readyState );
        if(document.readyState === 'complete') {

            /*window.scroll(0, 320);*/


            $('html, body').animate({
                scrollTop: 320
            }, 'slow');


            /*var element1 = document.getElementById('f1');
            console.log(element1);
            element1.classList.remove('displayNone');
            element1.classList.add('displayBlock');*/
        }
    }, 2000);






});