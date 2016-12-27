
app.controller("rootController", function($scope, $rootScope, $location, $route, $window, RestaurantService, validationService, Helper) {

    $rootScope.$on('$routeChangeSuccess', function () {

        console.log('Route Change: ' + $location.url());
        $window.ga('send', {
            'hitType': 'screenview',
            'appName' : 'restadviser.com',
            'screenName' : $location.url(),
            'hitCallback': function() {
                console.log('GA hitCallback sent!');
            }
        });
    });
    $scope.$watch('city', function(newValue, oldValue) {
        if(newValue && oldValue){
            $rootScope.cityChanged = true;
            console.log($rootScope.cityChanged);
        }else{
            $rootScope.cityChanged = false;
        }
    });

    var request = $route.current;
    $scope.showModal = false;
    $scope.search = true;
   /* $scope.custom = false;*/
    $scope.shearchRestaurants = false;
    $scope.docLoader = true;
    $scope.animateTopMenuVar = false;
    $scope.openLogOut = false;
    var userNameFull = localStorage.getItem("userName");
    var userName = JSON.parse(userNameFull);
    if(userName){
        $scope.userFirstLetter = userName.substring(0,1);
    }
    /*$scope.toggleMenu = function(menu) {
        if(menu == 'home'){
            //$scope.first = true;
            if($scope.custom && $scope.first){
                $scope.first = true;
                $scope.custom = false;
            }else if($scope.custom && $scope.first == false){
                $scope.custom = true;
                $scope.first = true;
            }else if($scope.custom == false){
                $scope.custom = true;
                $scope.first = true;
            }
            //$scope.custom = $scope.custom === false ? true: false;
        }else if(menu == 'place'){
            //$scope.first = false;
            if($scope.custom && $scope.first){
                $scope.first = false;
                $scope.custom = true;
            }else if($scope.custom && $scope.first == false){
                $scope.custom = false;
                $scope.first = false;
            }else if($scope.custom == false){
                $scope.custom = true;
                $scope.first = false;
            }
            //$scope.custom = $scope.custom === false ? true: false;
        }

        console.log($scope.first)
    };*/
   /* var path = window.location.pathname;*/

   //capitalize in worlds
    function capitalize_Words(str)
    {
        return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    }


    //get cities
    RestaurantService.rootData()
        .then(function (response) {
            if(localStorage.cityName){
                $rootScope.city =JSON.parse(localStorage.cityName);
            }else{
                $rootScope.city = response.data.current_city.name;
            }
            $scope.cities = response.data.cities;

        });

    //search restaurant in system
    $scope.SearchRestaurantInfo = function (value) {
        if(value.charAt(value.length-1) == " "){
            for(var i=0; i<$scope.cities.length; i++){
                if($scope.cities[i].name == $scope.city){
                    $scope.cityID = $scope.cities[i].id;
                    break;
                }
            }
            var data = {
                id: $scope.cityID,
                restaurant: value
            };
            $scope.shearchRestaurants = true;
            RestaurantService.SearchRestaurant(data)
                .then(function (response) {
                    $scope.searcheInfo = response.data;
                });
        }

    };
        $rootScope.$on('$routeChangeSuccess', function () {
            var uu = $location.url();
            var url = uu.split('/');
            if(url[2] == 'restaurants'){
                $scope.selectCity = function () {
                    $location.path('/'+ $scope.city +'/restaurants');
                };
            }else{
                $scope.selectCity = function () {

                };
            }
        });

    $scope.$watch(
        function(){
            return $location.absUrl();
        },
        function(newValue, oldValue){
            setCookie('pageUrl', newValue, 3600);
            $scope.searchInfo = "";
            $scope.shearchRestaurants = false
        });


    $scope.showSearch = function(){
        $scope.search = false
    };

    if(window.innerWidth <=767)
    {
        $scope.search = false
    };

    $scope.toggleTopMenu = function() {
        $scope.animateTopMenuVar = $scope.animateTopMenuVar === false ? true: false;
    };

    $scope.places = [
        ['Abanda',  'Abbeville', 'Abbotsford', 'Abbott', 'Abbottstown', 'Abbyville', 'Abercrombie', 'Aberdeen', 'Aberdeen', 'Gardens'],
        ['Abanda',  'Abbeville', 'Abbotsford', 'Abbott', 'Abbottstown', 'Abbyville', 'Abercrombie', 'Aberdeen', 'Aberdeen', 'Gardens'],
        ['Abanda',  'Abbeville', 'Abbotsford', 'Abbott', 'Abbottstown', 'Abbyville', 'Abercrombie', 'Aberdeen', 'Aberdeen', 'Gardens'],
        ['Abanda',  'Abbeville', 'Abbotsford', 'Abbott', 'Abbottstown', 'Abbyville', 'Abercrombie', 'Aberdeen', 'Aberdeen', 'Gardens'],
        ['Abanda',  'Abbeville', 'Abbotsford', 'Abbott', 'Abbottstown', 'Abbyville', 'Abercrombie', 'Aberdeen', 'Aberdeen', 'Gardens'],
        ['Abanda',  'Abbeville', 'Abbotsford', 'Abbott', 'Abbottstown', 'Abbyville', 'Abercrombie', 'Aberdeen', 'Aberdeen', 'Gardens'],
    ];

    $scope.toggleLogOut = function () {
        $scope.openLogOut = $scope.openLogOut === false ? true: false;
    };

    //$scope.currentRest = function(id){
    //    $rootScope.currentId = id;
    //    var restId = localStorage.getItem("restId");
    //    //var restaurantId = JSON.parse(restId);
    //    if(restId){
    //        localStorage.removeItem("restId");
    //    }
    //    var currentRest = JSON.stringify(id);
    //    localStorage.setItem('restId',currentRest);
    //};

    RestaurantService.getLogedUser()
        .then(function (response) {
            if(response.data.status == 1){
                $rootScope.logedUser = true;

                //set user name to local storage for social login
                if(!localStorage.getItem('userName')) {
                    var user = response.data.user;
                    var un = user.name;
                    $scope.userFirstLetter = un.substring(0, 1);
                    var userName = JSON.stringify(un);
                    localStorage.setItem('userName', userName);
                }

            }
        });
	
	//login and register part
    var confirm = document.getElementsByClassName('confirm');
	$scope.loginUser = function(data){
	    if(data && data.password && data.email){
            RestaurantService.userLogin(data)
                .then(function (response) {
                    if(response.data.status == "ok") {
                        var user = response.data.user;
                        $scope.successLogin = true;
                        var un = user.email;
                        $scope.userFirstLetter = un.substring(0,1);
                        $scope.user = {};
                        var userName = JSON.stringify(un);
                        localStorage.setItem('userName',userName);
                        $scope.reset();
                        Helper.success(['You are loged in', 'login'])
                    }else if(response.data.status == "error"){
                        Helper.error(['Something went wrong', 'login'])
                    }
                    RestaurantService.getLogedUser()
                        .then(function (response) {
                            if(response.data.status == 1){
                                $rootScope.logedUser = true;
                            }
                        });
                }, function(error){
                    console.log(error.data);
                    Helper.error(['Something went wrong', 'login'])
                });
        }else{
            $scope.reset();
        }
	};
	$scope.register = function(user){
	    if(user && user.name && user.email && user.password && user.confirmPassword){
            RestaurantService.userRegistration(user)
                .then(function (response) {
                    if(response.data.status == "ok") {
                        $scope.successRegister = true;
                        var un = user.email;
                        $scope.userFirstLetter = un.substring(0,1);
                        var userName = JSON.stringify(un);
                        localStorage.setItem('userName',userName);
                        $scope.currentUser = {};
                        $scope.reset();
                        Helper.success(['Your registration is success', 'registration']);
                        RestaurantService.sendRegistrationMail(user.email)
                            .then(function(response){

                            });
                    }
                    RestaurantService.getLogedUser()
                        .then(function (response) {
                            if(response.data.status == 1){
                                $rootScope.logedUser = true;
                            }
                        });
                }, function(error){
                    console.log(error.data);
                    Helper.error(['Something went wrong', 'registration']);
                });
        }else{
            $scope.reset();
        }
	};
	$scope.logout = function () {
        RestaurantService.logout()
            .then(function (response) {
                if(response.data.status == "ok"){
                    $rootScope.logedUser = false;
                    localStorage.removeItem("userName");
                    Helper.success(['You are loged out', 'log']);
                }else{
                    $scope.successLogin = false;
                }
            });
    };
    $scope.reset = function() {
        $scope.loginForm.$setPristine();
        $scope.loginForm.$setUntouched();

        $scope.registerForm.$setPristine();
        $scope.registerForm.$setUntouched();

        //$scope.user = angular.copy($scope.master);
    };

    //$scope.reset();

    $scope.loginFacebook = function () {
       // RestaurantService.loginUsingFacebook();
        window.location = BASE_URL+'/user/auth/facebook';
    };

    $scope.loginGoogle = function () {
        // RestaurantService.loginUsingFacebook();
        window.location = BASE_URL+'/user/auth/google';
    };

    function setCookie(index, value, expires) {
        var now = new Date();
        var time = now.getTime();
        time += 1000 * expires;
        now.setTime(time);
        document.cookie =
            index+'=' + value +
            '; expires=' + now.toUTCString() +
            '; path=/';
    }
    $scope.resetPopup = function(data){

        for(var d=0; d<data.length; d++){
            $scope[data[d]] = ' ';
        }
        validationService.reset();
        setTimeout(function(){
            $rootScope.itIsReset = false;
        }, 0);
    };
    $scope.addLocation = function (data) {
        if(data[0]&&data[1]&&data[2]&&data[3]&&data[4]&&data[5]){
            var sendingData = {
                name:data[0],
                address: data[1],
                phoneNumber: data[2],
                description: data[3],
                website: data[4],
                email: data[5]
            };
            RestaurantService.addLocation(sendingData)
                .then(function (response) {
                    Helper.success(['Message was send successfully', 'message'])
                })
        }
    };
    $scope.gender = 'female';
    $scope.registerOwner = function (data) {
        if(data[0]&&data[1]&&data[2]&&data[3]&&data[4]&&data[5]&&data[6]){
            var sendingData = {
                name:data[0],
                sureName: data[1],
                gender: data[2],
                phoneNumber: data[3],
                description: data[4],
                website: data[5],
                email: data[6]
            };
            RestaurantService.registerOwner(sendingData)
                .then(function (response) {
                    Helper.success(['Message was send successfully', 'message'])
                })
        }
    };
    $scope.noticedMistake = function (data) {
        if(data[0]&&data[1]){
            var sendingData = {
                email: data[0],
                description: data[1]
            };
            RestaurantService.noticedMistake(sendingData)
                .then(function (response) {
                    Helper.success(['Message was send successfully', 'message'])
                })
        }
    }

});