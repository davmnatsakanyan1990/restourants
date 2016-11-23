app.controller("currentController", function ($scope, $rootScope, $http, $document, $window, $timeout, $route, RestaurantService) {
    var request = $route.current.params;
    $scope.openPhoneInput = false;
    $scope.CurrentMenu = '';
    $scope.writeComment = true;
    $scope.animateSecMenuVar = false;
    $scope.haveData = false;
    $scope.editedRating = false;
	// $rootScope.logedUser = false;
    $scope.$watch(function () {
        return $window.scrollY;
    }, function (scrollY) {
        if (scrollY >= 45) {
            $scope.FixedRestMenu = true;

        } else {
            $scope.FixedRestMenu = false;
        }

    });

	RestaurantService.getLogedUser()
		.then(function (response) {
			if(response.data.status == 1){
				$rootScope.logedUser = true;
			}
         });

    var restaurantId = request.id;

    $scope.commentsCallData = {
        page: 1,
        place_id: restaurantId
    };
    
    RestaurantService.getRestaurantData(restaurantId)
        .then(function (response) {
            $scope.currentRestaurant = response.data;
            $scope.moreCommentsToShow = $scope.currentRestaurant.more_comments;
            console.log(response.data);
            //make map point
            $scope.initMap({
                zoom: 16,
                center: new google.maps.LatLng($scope.currentRestaurant.lat, $scope.currentRestaurant.long),
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.TERRAIN
            });
            createMarker(response.data.lat, response.data.long);


            //rating part
            $scope.rating1 = $scope.currentRestaurant.rating != 0 ?$scope.currentRestaurant.rating : 1;

            $scope.isReadonly = true;
            $scope.rateFunction = function (rating) {
                var rateData = rating;
                $scope.editedRating = true;
            };
            //

            $scope.hoursPart = $scope.currentRestaurant.workingHours;
            console.log($scope.hoursPart);


            for(var a in $scope.hoursPart){
                var hoursString= $scope.hoursPart[a];
                var hoursArray = hoursString.split(',');
                $scope.hoursPart[a] = hoursArray;


            }
            console.log($scope.hoursPart);


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
            $scope.$parent.docLoader = false;

        }.bind($scope));


    //
    $scope.togglePhoneNumber = function () {
        $scope.openPhoneInput = $scope.openPhoneInput === false ? true : false;
    };
    $scope.getSharesData = function (data) {
        $scope.SharesPopupData = data;
    };
    $scope.hideWrite = function () {
        if($rootScope.logedUser){
            $scope.writeComment = $scope.writeComment === false ? true : false;
        }else{
            $('#myModal').modal()
        }
    };
    $scope.ClearInner = function (data) {
        $scope.comment = '';
    };
    $scope.toggleSecondMenu = function () {
        $scope.animateSecMenuVar = $scope.animateSecMenuVar === false ? true : false;
    };
    $scope.chooseCurrentMenu = function (data) {
        //there will be call backend

		RestaurantService.getMenu(data.id)
			.then(function (response) {
				$scope.CurrentMenu = response.data
         });
    };
    $scope.writeCommentNow = function (type) {

        var data;
         if(type == 1){
             if($scope.comment){
                 data = {
                     text: $scope.comment,
                     user_type: 'user',
                     place_id: $scope.currentRestaurant.id,
                     parent_id: 0
                 };
             }
         }else if(typeof type == 'object'){
             if(type.commentReply){
                 data = {
                     text: type.commentReply,
                     user_type: 'user',
                     place_id: $scope.currentRestaurant.id,
                     parent_id: type.id
                 };
                 type.commentReply = ''
             }

         }
         if(data){
             RestaurantService.writeComment(data)
                 .then(function (response) {
                     if(response.data.status == "ok"){
                         if(type == 1){
                             if($scope.currentRestaurant.comments){
                                 $scope.currentRestaurant.comments.unshift(response.data.comment);
                             }else{
                                 $scope.currentRestaurant.comments = [];
                                 $scope.currentRestaurant.comments.unshift(response.data.comment);
                             }

                             $scope.ClearInner();
                         }else if(typeof type == 'object'){
                             for(var i = 0; i<$scope.currentRestaurant.comments.length; i++){
                                 if($scope.currentRestaurant.comments[i].id == type.id){
                                     if($scope.currentRestaurant.comments[i].subComment){
                                         $scope.currentRestaurant.comments[i].subComment.push(response.data.comment);
                                     }else{
                                         $scope.currentRestaurant.comments[i].subComment = [response.data.comment];
                                     }
                                     break;
                                 }
                             }
                         }
                     }
                 });
         }
    };

    //map section
    var infoWindow = new google.maps.InfoWindow();

    var createMarker = function (lat, long) {

        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(lat, long),
            icon: '../images/1(1).png',

        });
    };
    $scope.initMap = function(mapOptions){
        var mapOptions = mapOptions || {
                zoom: 16,
                center: new google.maps.LatLng(40.0000, -98.0000),
                mapTypeId: google.maps.MapTypeId.TERRAIN
            };
        $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);

    };
    //end of map section

    $scope.moreComments = function(){
        $scope.commentsCallData.page++;
        RestaurantService.getMoreComments($scope.commentsCallData)
            .then(function(response){

                $scope.moreCommentsToShow = response.data.more_data;

                angular.forEach(response.data.comments, function(value, key){

                    $scope.currentRestaurant.comments.push(value);
                });
            })
    }
});

