app.controller('MapCtrl', function ($scope, $http, $document, $window, $timeout, RestaurantService) {


    $scope.custom = false;
    $scope.openDropMenu = false;
    $scope.animateTopMenuVar = false;
    $scope.animateSecondMenuVar = false;
    $scope.activePage = 'page1';
    $scope.FixedRestMenu = false;
    $scope.checkboxModel = {
        checkboxModelF1: [],
        checkboxModelF2: [],
        checkboxModelF3: [],
        checkboxModelF4: {},
        checkboxModelF5: [],
        checkboxModelF6: []
    };

    $scope.callData = {
        page: 1,
        city: 'Salt%20Lake%20City'
    };
    RestaurantService.getRestaurantsList($scope.callData)
        .then(function (response) {
            $scope.restaurants = response.data.restaurants;
            $scope.city = response.data.city;
            for (i = 0; i < $scope.restaurants.length; i++){
                createMarker($scope.restaurants[i]);
            }
         });


    // add more restaurant in list
    $scope.addMorePoints = function(){
        $scope.callData.page++;
		console.log($scope.callData.page);
        RestaurantService.getRestaurantsList($scope.callData)
            .then(function (response) {
                $scope.restaurants.push(response.data.restaurants);
                $scope.city = response.data.city;
                for (i = 0; i < $scope.restaurants.length; i++){
                    createMarker($scope.restaurants[i]);
                }
            });
    };

    var mapOptions = {
            zoom: 10,
            center: new google.maps.LatLng(40.0000, -98.0000),
            mapTypeId: google.maps.MapTypeId.TERRAIN
    };

    $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);
    $scope.markers = [];
    var infoWindow = new google.maps.InfoWindow();
    var createMarker = function (info){

        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.long),
            icon: 'images/ball.png',
            title: info.title,
            id: info.id,
            image: info.image,
            service: info.service,
            explane: info.explane,
            rating: info.rating
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

    var bounds = new google.maps.LatLngBounds();
    for (var i in $scope.markers) // your marker list here
        bounds.extend($scope.markers[i].position) // your marker position, must be a LatLng instance

    $scope.map.fitBounds(bounds); // map should be your map class
    $scope.openInfoWindow = function(e, selectedMarker){
        e.preventDefault();
        google.maps.event.trigger(selectedMarker, 'click');
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

    //top sider

    $scope.myNewArr = [];
    $scope.images = [

        '../images/foodImages/1.jpg',
        '../images/foodImages/2.jpg',
        '../images/foodImages/3.jpg',
        '../images/foodImages/4.jpg',
        '../images/foodImages/5.jpg',
        '../images/foodImages/6.jpg',
        '../images/foodImages/7.jpg',
        '../images/foodImages/1.jpg',
        '../images/foodImages/2.jpg',
        '../images/foodImages/3.jpg',
        '../images/foodImages/4.jpg',
        '../images/foodImages/5.jpg',
        '../images/foodImages/6.jpg',
        '../images/foodImages/7.jpg',
        '../images/foodImages/1.jpg',
        '../images/foodImages/2.jpg',
        '../images/foodImages/3.jpg',
        '../images/foodImages/4.jpg',
        '../images/foodImages/5.jpg',
        '../images/foodImages/6.jpg',
        '../images/foodImages/7.jpg'
    ];
    if(window.innerWidth < 380){
        $scope.cal = 6;
        for(var i =0; i<$scope.images.length; i++){
            if (i % 2 == 0 && i!=0){
                $scope.myNewArr.push([$scope.images[i], $scope.images[i-1]]);
            }
        }
    }else if(window.innerWidth < 470 && window.innerWidth > 380){
        $scope.cal = 4;
        for(var i =0; i<$scope.images.length; i++){
            if (i % 3 == 0 && i!=0){
                $scope.myNewArr.push([$scope.images[i], $scope.images[i-1], $scope.images[i-2]]);
            }
        }
    }else if(window.innerWidth < 649 && window.innerWidth > 470){
        $scope.cal = 3;
        for(var i =0; i<$scope.images.length; i++){
            if (i % 4 == 0 && i!=0){
                $scope.myNewArr.push([$scope.images[i], $scope.images[i-1], $scope.images[i-2], $scope.images[i-3]]);
            }
        }
    }else if(window.innerWidth > 649 && window.innerWidth <=1178) {
        $scope.cal = 2;
        for(var i =0; i<$scope.images.length; i++){
            if (i % 6 == 0 && i!=0){
                $scope.myNewArr.push([$scope.images[i], $scope.images[i-1], $scope.images[i-2], $scope.images[i-3], $scope.images[i-4], $scope.images[i-5]]);
            }
        }
    }else if(window.innerWidth >1178){
        $scope.cal = 1;
        for(var i =0; i<$scope.images.length; i++){
            if (i % 11 == 0 && i!=0){
                $scope.myNewArr.push([$scope.images[i], $scope.images[i-1], $scope.images[i-2], $scope.images[i-3], $scope.images[i-4], $scope.images[i-5], $scope.images[i-6], $scope.images[i-7],
                    $scope.images[i-8],  $scope.images[i-9], $scope.images[i-10], $scope.images[i-11]]);
            }
        }
    };



    $scope.cuisins = [
        'Afghani',
        'African',
        'American',
        'Argentine',
        'Asian',
        'BBQ',
        'Bagels',
        'Bakery',
        'Bar',
        'Food',
        'Belgian',
        'Beverages',
        'Brazilian',
        'Breakfast',
        'British',
        'Burger',
        'Cafe',
        'Cajun',
        'California',
        'Canadian',
        'Caribbean',
        'Chilean',
        'Chinese',
        'Coffee and Tea',
        'Crepes',
        'Deli',
        'Desserts',
        'Dim',
        'Sum',
        'Diner',
        'Donuts',
        'Eastern',
        'European',
        'Ethiopian',
        'European', 'Filipino', 'French', 'Frozen', 'Yogurt', 'Fusion', 'German', 'Greek', 'Hawaiian', 'Healthy',
        'Food', 'Ice Cream', 'Indian', 'International', 'Irish', 'Italian',
        'Japanese', 'Kebab', 'Korean', 'Latin', 'American', 'Mediterranean', 'Mexican',
        'Middle', 'Eastern', 'Mongolian', 'Moroccan', 'Nepalese', 'New', 'American', 'New', 'Mexican', 'Pacific',
        'Pakistani', 'Persian', 'Peruvian', 'Pizza', 'Ramen', 'Russian', 'Salad', 'Salvadorean', 'Sandwich', 'Seafood', 'Somali', 'Soul',
        'Food', 'South', 'American', 'Southern', 'Southwestern', 'Spanish', 'Steak', 'Sushi',
        'Taco', 'Taiwanese', 'Tapas', 'Tea', 'Teriyaki', 'Tex-Mex',
        'Thai', 'Tibetan', 'Turkish', 'Vegetarian', 'Vietnamese'
    ];

    $scope.drowCuisine = [];
    for(var p = 0; p < $scope.cuisins.length; p++){
        $scope.drowCuisine.push({"display": $scope.cuisins[p], "pass" : $scope.cuisins[p]})
    }



    //filters section
    $scope.filters = [];
    var elementAlreadyExist = false;
    
    //whent add a filter from second menu
    $scope.pushElementInFilter = function (index, data) {
        console.log(index);
        if(Object.prototype.toString.call( data ) === '[object Array]' ){
            for(var i=0; i<index.length; i++){
                if(index[i]){
                    if($scope.filters.length ==0){
                        $scope.filters.push(data[i]);
                    }else{
                        for(var j=0; j<$scope.filters.length; j++){
                            if( data[i]==$scope.filters[j]){
                                elementAlreadyExist = true;
                                break;
                            }else{
                                elementAlreadyExist = false;
                            }
                        }
                        if(!elementAlreadyExist){
                            $scope.filters.push(data[i]);
                        }
                    }
                }
                else if(!index[i]){
                    for(var k=0; k<$scope.filters.length; k++){
                        if(data[i] == $scope.filters[k]){
                            $scope.filters.splice(k, 1)
                        }
                    }
                }
            }
        }else if(typeof index == 'object'){
            for(var key in index){
                if(key){

                    if($scope.filters.length ==0){
                        $scope.filters.push(key);
                    }else{
                        for(var t=0; t<$scope.filters.length; t++){
                            if( key==$scope.filters[t]){
                                elementAlreadyExist = true;
                                break;
                            }else{
                                elementAlreadyExist = false;
                            }
                        }
                        if(!elementAlreadyExist){
                            $scope.filters.push(key);
                        }
                    }
                }
            }
        }


    };
    
    //when delete a filter after click in it
    $scope.deleteElementFromFilter = function (data) {
        for(var m=0; m < $scope.filters.length; m++){
            if(data == $scope.filters[m]){
                $scope.filters.splice(m, 1);
            }
        }
    }

});