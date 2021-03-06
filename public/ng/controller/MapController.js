app.controller('MapCtrl', function ($scope, $rootScope, $http, $document, $window, $timeout,$route, RestaurantService) {
    var request = $route.current.params;
   /* $scope.custom = false;
    $scope.openDropMenu = false;*/
    /*$scope.animateTopMenuVar = false;*/
    $scope.animateSecondMenuVar = false;
    /*$scope.activePage = 'page1';*/
    /*$scope.FixedRestMenu = false;*/
    $scope.noMoreInfoToShow = false;

    $scope.checkboxModel = {
        checkboxModelF1: [],
        checkboxModelF2: [],
        checkboxModelF3: [],
        checkboxModelF4: [],
        checkboxModelF5: [],
        checkboxModelF6: []
    };
    $scope.filters = {};
    $scope.callData = {
        page: 1,
        city: request.city,
        filters: {}
    };
    $scope.modeLoad = false;
    var slidePage = 0;
    RestaurantService.getRestaurantsList($scope.callData)
        .then(function (response) {
            $scope.restaurants = response.data.restaurants;
            $scope.city = response.data.city;
            var showFilters = response.data.filters;

            $scope.noMoreInfoToShow = response.data.noMoreData;


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
            for(var p = 0; p < showFilters.Cuisine.length; p++){
                $scope.drowCuisine.push({"display": showFilters.Cuisine[p], "pass" : showFilters.Cuisine[p]})
            }
            $scope.drowMode = [];
            for(var m = 0; m < showFilters.Mode.length; m++){
                $scope.drowMode.push({"display": showFilters.Mode[m], "pass" : showFilters.Mode[m]})
            }
            $scope.drowSort = [];
            for(var n = 0; n < showFilters['Sort By'].length; n++){
                $scope.drowSort.push({"display": showFilters['Sort By'][n], "pass" : showFilters['Sort By'][n]})
            }
            $scope.drowType = [];
            for(var q = 0; q < showFilters['Type Of Restaurants'].length; q++){
                $scope.drowType.push({"display": showFilters['Type Of Restaurants'][q], "pass" : showFilters['Type Of Restaurants'][q]})
            }
            $scope.drowCLocation = [];
            for(var r = 0; r < showFilters['Location'].length; r++){
                $scope.drowCLocation.push({"display": showFilters['Location'][r], "pass" : showFilters['Location'][r]})
            }
            if(response.data.restaurants.length > 0) {
                initMap({
                    zoom: 12,
                    center:[$scope.restaurants[0].lat * 1 + 0.003, $scope.restaurants[0].long * 1 - 0.116],
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


    // add more restaurant in list
    $scope.addMorePoints = function(){
        $scope.loading = true;
        $scope.callData.page++;
        var city = $scope.callData.city;
        var filters = $scope.callData.filters;
        RestaurantService.getMoreRestaurant($scope.callData.page, city, filters)
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

    // $scope.clickTopSlider = function () {
    //     slidePage += 1;
    //     var currentCity = $scope.callData.city;
    //     var myCallData = {page: slidePage, city_name: currentCity, filters:{ Mode: [categoryName]}};
    //     RestaurantService.getMode(myCallData)
    //         .then(function (response) {
    //             $scope.restaurants = response.data.restaurants;
    //
    //             initMap({
    //                 zoom: 12,
    //                 center: new google.maps.LatLng($scope.restaurants[0].lat*1, $scope.restaurants[0].long*1 -0.3),
    //                 scrollwheel: false,
    //                 mapTypeId: google.maps.MapTypeId.TERRAIN
    //             });
    //
    //             for (i = 0; i < $scope.restaurants.length; i++) {
    //                 createMarker($scope.restaurants[i]);
    //             }
    //         });
    //    
    // };

    initMap = function(mapOption){
        var mapOptions = {
            zoom: mapOption.zoom,
                center: new google.maps.LatLng(mapOption.center[0], mapOption.center[1]),
                scrollwheel: mapOption.scrollwheel,
                mapTypeId: mapOption.mapTypeId
        } || {
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
        $scope.map.setCenter(new google.maps.LatLng(mapOption.center[0],mapOption.center[1])); //set after fitBounds

        var listener = google.maps.event.addListener($scope.map, "idle", function() {
            $scope.map.setZoom(mapOptions['zoom']);
            $scope.map.setCenter(new google.maps.LatLng(mapOption.center[0],mapOption.center[1])); //set after fitBounds
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
            hoverPosition: new google.maps.LatLng(info.lat*1+0.033, info.long*1-0.106)

        });

        marker.content = '<div class="infoWindowContent">' + info.explane + '</div>';

        google.maps.event.addListener(marker, 'click', function(){
            infoWindow.setContent('<h4 style="color: #3d3f52">' + marker.title + '</h4>' + marker.content);
            infoWindow.open($scope.map, marker);
            $scope.clichedElementId = marker.id;
            /*var elementCollection = $('.info');
            if($('.info').hasClass('active')){
                $('.info').removeClass('active')
            }
            if($('.info').hasClass($scope.clichedElementId)){
                var el = document.getElementsByClassName($scope.clichedElementId);
               var pos = $( "div."+ $scope.clichedElementId).offset();
                window.scrollTo(0, pos.top-100)
            }*/
        });

        google.maps.event.addListener(marker, 'mouseover', function(){
            marker.setIcon('images/bullets/hover1.png');
        });
        google.maps.event.addListener(marker, 'mouseout', function() {
            marker.setIcon('images/bullets/1.png');
        });


        $scope.markers.push(marker);
    };

    //end processes for map

    // open top dropdown menu section
   /* $scope.openDrop = function(){
        $scope.openDropMenu = $scope.openDropMenu === false ? true: false;
    };*/

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
    $scope.displayElement = function (event) {
        var element =event.currentTarget.parentNode.lastElementChild;
        if(element.classList.contains('displayNone')){
            $('.forBefore').addClass('displayNone');
            element.classList.remove('displayNone');
        }else{
            $('.forBefore').addClass('displayNone');
            element.classList.add('displayNone');
        }
    };
    $scope.cancelDisplay = function () {
        var element = event.currentTarget.parentNode.parentNode.parentNode;
        element.classList.add('displayNone');
    };

    //in feature it will be call
    /* $scope.additionalInfo = {
     restaurant1:{
     image: 'images/restaurantImages/rest1.jpg',
     title: 'Title1',
     more: '420 places'
     },
     restaurant2:{
     image: 'images/restaurantImages/rest2.jpg',
     title: 'Title2',
     more: '420 places'
     },
     restaurant3:{
     image: 'images/restaurantImages/rest3.jpg',
     title: 'Title3',
     more: '420 places'
     }
     };*/

    //filters section
    var elementAlreadyExist = false;

    //when add a filter from second menu
    $scope.pushElementInFilter = function (index, type) {
        $scope.loading = true;
        if(index.length > 0) {
            $scope.callData.filters[type] = [];
            $scope.filters[type] = [];

            for (var k in index) {
                for (var key in index[k]) {
                    if (key) {
                        if (index[k][key] == false || index[k] == false) {
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


                    if(typeof index[k]!=="object" && index[k]!==false){
                        $scope.callData.filters[type].push(k);
                    }else if(typeof index[k]=="object" && index[k][key]!==false){
                        $scope.callData.filters[type].push(k);
                    }

                }
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
                            initMap({
                                zoom: 12,
                                center:[$scope.restaurants[0].lat * 1 + 0.003, $scope.restaurants[0].long * 1 - 0.116],
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
                    $scope.loading = false;
                });
        }
    };

    //when delete a filter after click in it
    $scope.deleteElementFromFilter = function (filter, type) {
        $scope.loading = true;
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
                $scope.loading = false;
                if(response.data.restaurants) {
                    if(response.data.status && response.data.status == 'ended'){
                        $scope.noMoreInfoToShow = true;
                    }
                    else{
                        $scope.noMoreInfoToShow = false;
                    }

                    $scope.restaurants = response.data.restaurants;

                    initMap({
                        zoom: 12,
                        center:[$scope.restaurants[0].lat * 1 + 0.003, $scope.restaurants[0].long * 1 - 0.116],
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
    }

});