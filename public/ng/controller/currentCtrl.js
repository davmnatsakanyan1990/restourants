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


    /*$scope.currentRestaurant = {
        mobileNumber: '+(222) 1212145454',
        name: 'The best restaurant in the world',
        rating: '3',
        //comment: '121',
        intro: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
        'Aliquid aperiam aspernatur debitis deserunt dicta earum error hic illum in ' +
        'labore nostrum officiis reprehenderit sed, similique tenetur totam unde veniam voluptate.' +
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam aspernatur debitis ' +
        'deserunt dicta earum error hic illum in labore nostrum officiis reprehenderit sed,',
        address: 'Lorem ipsum dolor sit amet, consectetur',
        site: 'http://www.Loremipsum.com',
        price: '$$',
        workingHours: {Mon: '12:00- 24:00', Tue: '12:00- 24:00', Wed: '12:00- 24:00', Thu: '12:00- 24:00', Fri: '', Sat: '12:00- 24:00', Sun: '12:00- 24:00'},
        shareItems: [
            {
                title: '20% of the whole menu',
                content: 'Every day, in the period from 12-00 to 17-00 when ordering dishes on the main menu, you get a 20% discount automatically',
                photo: '../images/restaurantSlider/sliderImg1.jpg',
                location: 'England, United Kingdom, London 51.51 latitude and -0.13 longitude',
                workingHours: {Mon: '12:00- 24:00', Tue: '12:00- 24:00', Wed: '12:00- 24:00', Thu: '12:00- 24:00', Fri: '', Sat: '12:00- 24:00', Sun: '12:00- 24:00'},
            },
            {
                title: 'Birthdays our favorite guest',
                content: 'Every day, in the period from 12-00 to 17-00 when ordering dishes on the main menu, you get a 20% discount automatically',
                photo: '../images/restaurantSlider/sliderImg2.jpg',
                location: 'England, United Kingdom, London 51.51 latitude and -0.13 longitude',
                workingHours: {Mon: '12:00- 24:00', Tue: '12:00- 24:00', Wed: '12:00- 24:00', Thu: '12:00- 24:00', Fri: '', Sat: '12:00- 24:00', Sun: '12:00- 24:00'},
            },
            {
                title: 'something -30%',
                content: 'Every day, in the period from 12-00 to 17-00 when ordering dishes on the main menu, you get a 20% discount automatically',
                photo: '../images/restaurantSlider/sliderImg3.jpg',
                location: 'England, United Kingdom, London 51.51 latitude and -0.13 longitude',
                workingHours: {Mon: '12:00- 24:00', Tue: '12:00- 24:00', Wed: '12:00- 24:00', Thu: '12:00- 24:00', Fri: '', Sat: '12:00- 24:00', Sun: '12:00- 24:00'},
            },
            {
                title: 'something -80%',
                content: 'Every day, in the period from 12-00 to 17-00 when ordering dishes on the main menu, you get a 20% discount automatically',
                photo: '../images/restaurantSlider/sliderImg1.jpg',
                location: 'England, United Kingdom, London 51.51 latitude and -0.13 longitude',
                workingHours: {Mon: '12:00- 24:00', Tue: '12:00- 24:00', Wed: '12:00- 24:00', Thu: '12:00- 24:00', Fri: '', Sat: '12:00- 24:00', Sun: '12:00- 24:00'},
            }
        ],
        menuItems: ['all', 'main menu', 'collection steam fruit cocktails', 'tea', 'bar menu', 'banquet menu'],
        comments: [
            {
                name: 'lorem',
                rate: '5',
                comment: 'Ad aliquid amet consectetur cumque deleniti in maiores nesciunt praesentium rerum voluptas.',
                date: '12/02/2013'
            },
            {
                name: 'Ipsum',
                rate: '4',
                comment: 'Lorem ipsum dolor sit amet.',
                date: '3/10/2015'
            },
            {
                name: 'Dolor',
                rate: '3',
                comment: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquid amet consectetur cumque deleniti in maiores nesciunt praesentium rerum voluptas.',
                date: '12/02/2016'
            },
            {
                name: 'lorem',
                rate: '1',
                comment: 'Lorem ipsum dolor sit amet, in maiores nesciunt praesentium rerum voluptas.',
                date: '20/12/2014'
            },
            {
                name: 'Amet',
                rate: '5',
                comment: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquid amet consectetur cumque deleniti in maiores nesciunt praesentium rerum voluptas.',
                date: '22/05/2016'
            }
        ],
        images: [

            '../images/restaurantImages/rest1.jpg',
            '../images/restaurantImages/rest2.jpg',
            '../images/restaurantImages/rest3.jpg',
            '../images/restaurantImages/rest4.jpg',
            '../images/restaurantImages/rest5.jpg',
            '../images/restaurantImages/rest1.jpg',
            '../images/restaurantImages/rest2.jpg',
            '../images/restaurantImages/rest3.jpg',
            '../images/restaurantImages/rest4.jpg',
            '../images/restaurantImages/rest5.jpg',
            '../images/restaurantImages/rest1.jpg',
            '../images/restaurantImages/rest2.jpg',
            '../images/restaurantImages/rest3.jpg',
            '../images/restaurantImages/rest4.jpg',
            '../images/restaurantImages/rest5.jpg',
            '../images/restaurantImages/rest1.jpg',
            '../images/restaurantImages/rest2.jpg',
            '../images/restaurantImages/rest3.jpg',
            '../images/restaurantImages/rest4.jpg',
            '../images/restaurantImages/rest5.jpg',
            '../images/restaurantImages/rest1.jpg'
        ]

    };*/


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

