app.controller("currentController", function ($scope, $rootScope, $http, $document, $window, $timeout, RestaurantService) {

    $scope.openPhoneInput = false;
    $scope.CurrentMenu = '';
    $scope.writeComment = true;
    $scope.animateSecMenuVar = false;
    $scope.haveData = false;
    $scope.editedRating = false;

    $scope.$watch(function () {
        return $window.scrollY;
    }, function (scrollY) {
        if (scrollY >= 45) {
            $scope.FixedRestMenu = true;

        } else {
            $scope.FixedRestMenu = false;
        }

    });

    RestaurantService.getRestaurantData($rootScope.currentId)
        .then(function (response) {
            $scope.currentRestaurant = response.data;

            //rating part
            $scope.rating1 = $scope.currentRestaurant.rating;

            $scope.isReadonly = true;
            $scope.rateFunction = function (rating) {
                var rateData = rating
                $scope.editedRating = true;
            };
            //
            $scope.haveData = true;
            //restaurants images part
            var arr = $scope.currentRestaurant.images;
            $scope.myNewArr = [];

            if (window.innerWidth < 570) {
                $scope.cal = 12;
                for (var i = 0; i < arr.length; i++) {
                    if (i % 1 == 0 && i != 0) {
                        $scope.myNewArr.push([arr[i]]);
                    }
                }
            } else if (window.innerWidth < 776 && window.innerWidth > 570) {
                $scope.cal = 6;
                for (var i = 0; i < arr.length; i++) {
                    if (i % 2 == 0 && i != 0) {
                        $scope.myNewArr.push([arr[i], arr[i - 1]]);
                    }
                }
            } else if (window.innerWidth <= 995 && window.innerWidth >= 776) {
                $scope.cal = 4;
                for (var i = 0; i < arr.length; i++) {
                    if (i % 3 == 0 && i != 0) {
                        $scope.myNewArr.push([arr[i], arr[i - 1], arr[i - 2]]);
                    }
                }
            } else if (window.innerWidth > 995 && window.innerWidth <= 1420) {
                $scope.cal = 3;
                for (var i = 0; i < arr.length; i++) {
                    if (i % 4 == 0 && i != 0) {
                        $scope.myNewArr.push([arr[i], arr[i - 1], arr[i - 2], arr[i - 3]]);
                    }
                }
            } else if (window.innerWidth > 1420) {
                $scope.cal = 2;
                for (var i = 0; i < arr.length; i++) {
                    if (i % 6 == 0 && i != 0) {
                        $scope.myNewArr.push([arr[i], arr[i - 1], arr[i - 2], arr[i - 3], arr[i - 4], arr[i - 5]]);
                    }
                }
            }
            ;

        }.bind($scope));





    //
    $scope.togglePhoneNumber = function () {
        $scope.openPhoneInput = $scope.openPhoneInput === false ? true : false;
    };
    $scope.getSharesData = function (data) {
        $scope.SharesPopupData = data;
    };
    $scope.hideWrite = function () {
        $scope.writeComment = $scope.writeComment === false ? true : false;
    };
    $scope.ClearInner = function (data) {
        $scope.comment = '';
    };
    $scope.toggleSecondMenu = function () {
        $scope.animateSecMenuVar = $scope.animateSecMenuVar === false ? true : false;
    };
    $scope.chooseCurrentMenu = function (data) {
        //there will be call backend
        $scope.CurrentMenu = [
            {
                title: 'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '220$ / 200g'
            },
            {
                title: 'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '120$ / 100g'
            },
            {
                title: 'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '430$'
            },
            {
                title: 'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '130$'
            },
            {
                title: 'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '5530$'
            },
            {
                title: 'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '23$'
            }
        ]
    };


    //map section

    $scope.restaurants = [

        {
            id: 6,
            image: 'images/restaurantImages/rest4.jpg',
            title: 'Title6',
            service: 'banket, restaurant',
            explane: 'in this bar  you can finde many testy foods and',
            rating: '2',
            lat: 37.1800,
            long: -115.6522
        }
    ];
    var mapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(40.0000, -98.0000),
        mapTypeId: google.maps.MapTypeId.TERRAIN
    };


    $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);

    $scope.markers = [];

    var infoWindow = new google.maps.InfoWindow();

    var createMarker = function (info) {

        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.long),
            icon: '../images/ball.png',
            title: info.title,
            id: info.id,
            image: info.image,
            service: info.service,
            explane: info.explane,
            rating: info.rating
        });
        marker.content = '<div class="infoWindowContent">' + info.explane + '</div>';

        google.maps.event.addListener(marker, 'click', function () {
            infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
            infoWindow.open($scope.map, marker);
        });

        $scope.markers.push(marker);
    };
    for (i = 0; i < $scope.restaurants.length; i++) {
        createMarker($scope.restaurants[i]);
    }
    ;

});

