app.controller("rootController", function($scope, $rootScope, $http, $document, $window, $timeout, RestaurantService) {
    
    $scope.search = true;
    $scope.custom = false;
    $scope.animateTopMenuVar = false;
    $scope.openLogOut = false;
    
    $scope.toggleMenu = function(menu) {
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
    };

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


    $scope.categories = {
        f1: {
            title: 'The place where be the restaurant',
            text: 'text text text text text text text text text text text text'
        },
        f2: {
            title: 'The place where be the restaurant',
            text: 'text text text text text text text text text text text text'
        },
        f3: {
            title: 'The place where be the restaurant',
            text: 'text text text text text text text text text text text text'
        },
        f4: {
            title: 'The place where be the restaurant',
            text: 'text text text text text text text text text text text text'
        },
        f5: {
            title: 'The place where be the restaurant',
            text: 'text text text text text text text text text text text text'
        },
        f6: {
            title: 'The place where be the restaurant',
            text: 'text text text text text text text text text text text text'
        },
        f7: {
            title: 'The place where be the restaurant',
            text: 'text text text text text text text text text text text text'
        }
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

    $scope.currentRest = function(id){
        $rootScope.currentId = id
    };

    RestaurantService.getLogedUser()
        .then(function (response) {
            if(response.data.status == 1){
                $scope.logedUser = true;
            }
        });
	
	//login and reister part
	$scope.loginUser = function(user){
	    if(user.password && user.email){
            RestaurantService.userLogin(user)
                .then(function (response) {
                    if(response.data.status == "ok") {
                        var un = user.email;
                        $scope.userFirstLetter = un.substring(0,1);
                        $scope.user = {};
                    }
                    RestaurantService.getLogedUser()
                        .then(function (response) {
                            if(response.data.status == 1){
                                $scope.logedUser = true;
                            }
                        });
                });
        }
	};
	$scope.register = function(user){
	    if(user.name && user.email && user.password && user.confirmPassword){
            RestaurantService.userRegistration(user)
                .then(function (response) {
                    if(response.data.status == "ok") {
                        $scope.currentUser = {};
                    }
                });
        }
	};
	$scope.logout = function () {
        RestaurantService.logout()
            .then(function (response) {
                if(response.data.status == "ok"){
                    $scope.logedUser = false;
                }
            });
    }


});