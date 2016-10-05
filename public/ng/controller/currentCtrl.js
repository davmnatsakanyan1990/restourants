app.controller("currentController", function($scope, $http, $document, $window, $timeout) {

    $scope.openPhoneInput = false;
    $scope.CurrentMenu = '';
    $scope.writeComment = true;
    
    $scope.$watch(function () {
        return $window.scrollY;
    }, function (scrollY) {
        //console.log(scrollY);
        if(scrollY >= 45){
            $scope.FixedRestMenu = true;

        }else{
            $scope.FixedRestMenu = false;
        }

    });

    $scope.currentRestaurant = {
        mobileNumber: '+(222) 1212145454',
        name: 'The best restaurant in the world',
        rating: '3',
        comment: '121',
        intro: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
        'Aliquid aperiam aspernatur debitis deserunt dicta earum error hic illum in ' +
        'labore nostrum officiis reprehenderit sed, similique tenetur totam unde veniam voluptate.' +
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam aspernatur debitis ' +
        'deserunt dicta earum error hic illum in labore nostrum officiis reprehenderit sed,',
        address: 'Lorem ipsum dolor sit amet, consectetur',
        site: 'http://www.Loremipsum.com',
        price: '100$-4000$',
        workingHours: '12:00- 24:00',
        shareItems: [
            {
                title: '20% of the whole menu',
                content: 'Every day, in the period from 12-00 to 17-00 when ordering dishes on the main menu, you get a 20% discount automatically',
                photo: '../images/restaurantSlider/sliderImg1.jpg',
                location: 'England, United Kingdom, London 51.51 latitude and -0.13 longitude',
                workingHours: 'Working hours: 12:00- 24:00'
            },
            {
                title: 'Birthdays our favorite guest',
                content: 'Every day, in the period from 12-00 to 17-00 when ordering dishes on the main menu, you get a 20% discount automatically',
                photo: '../images/restaurantSlider/sliderImg2.jpg',
                location: 'England, United Kingdom, London 51.51 latitude and -0.13 longitude',
                workingHours: 'Working hours: 12:00- 24:00'
            },
            {
                title: 'something -30%',
                content: 'Every day, in the period from 12-00 to 17-00 when ordering dishes on the main menu, you get a 20% discount automatically',
                photo: '../images/restaurantSlider/sliderImg3.jpg',
                location: 'England, United Kingdom, London 51.51 latitude and -0.13 longitude',
                workingHours: 'Working hours: 12:00- 24:00'
            },
            {
                title: 'something -80%',
                content: 'Every day, in the period from 12-00 to 17-00 when ordering dishes on the main menu, you get a 20% discount automatically',
                photo: '../images/restaurantSlider/sliderImg1.jpg',
                location: 'England, United Kingdom, London 51.51 latitude and -0.13 longitude',
                workingHours: 'Working hours: 12:00- 24:00'
            }
        ],
        menuItems: ['all', 'main menu', 'collection steam fruit cocktails', 'tea', 'bar menu', 'banquet menu'],
        specialists: [
            {
                photo: '../images/spec/p1.jpg',
                name: 'Paul Now',
                star: '5',
                prof: 'Cook',
                moreInfo: 'Comments and additional information'
            },
            {
                photo: '../images/spec/p2.jpg',
                name: 'Lorem Now',
                star: '3',
                prof: 'Cook',
                moreInfo: 'Comments and additional information'
            },
            {
                photo: '../images/spec/p3.jpg',
                name: 'Paul Lorem',
                star: '4',
                prof: 'Cook',
                moreInfo: 'Comments and additional information'
            }
        ],
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
        ]
        
    };

    $scope.togglePhoneNumber = function(){
        $scope.openPhoneInput = $scope.openPhoneInput === false ? true: false;
    };
    $scope.getSharesData = function (data) {
        $scope.SharesPopupData = data;
    };
    $scope.hideWrite = function () {
        $scope.writeComment = $scope.writeComment === false ? true: false;
    };
    $scope.ClearInner = function (data) {
        $scope.comment = '';
    };
    $scope.chooseCurrentMenu = function (data) {
        //there will be call backend
        $scope.CurrentMenu = [
            {
                title:'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '220$ / 200g'
            },
            {
                title:'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '120$ / 100g'
            },
            {
                title:'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '430$'
            },
            {
                title:'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '130$'
            },
            {
                title:'Lorem ipsum dolor',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ' +
                'Aliquid debitis deserunt eaque eligendi exercitationem facilis maiores ' +
                'officia possimus quibusdam tempore?',
                price: '5530$'
            },
            {
                title:'Lorem ipsum dolor',
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
            id:6,
            image: 'images/restaurantImages/rest4.jpg',
            title : 'Title6',
            service : 'banket, restaurant',
            explane: 'in this bar  you can finde many testy foods and',
            rating: '2',
            lat : 37.1800,
            long : -115.6522
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

    var createMarker = function (info){

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

        google.maps.event.addListener(marker, 'click', function(){
            infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
            infoWindow.open($scope.map, marker);
        });

        $scope.markers.push(marker);
    };
    for (i = 0; i < $scope.restaurants.length; i++){
        createMarker($scope.restaurants[i]);
    };



});

