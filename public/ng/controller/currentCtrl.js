app.controller("currentController", function ($scope, $rootScope, $http, $document, $window, $timeout, $route, RestaurantService) {
    window.scrollTo(0, 0);
    var request = $route.current.params;
    /*$scope.openPhoneInput = false;*/
    /*$scope.CurrentMenu = '';*/
    $scope.writeComment = true;
    $scope.animateSecMenuVar = false;
    /*$scope.haveData = false;*/
    /*$scope.editedRating = false;*/
	// $rootScope.logedUser = false;
    $scope.$watch(function () {
        return $window.scrollY;
    }, function (scrollY) {
        if (scrollY >= 485) {
            $scope.FixedRestMenu = true;

        } else {
            $scope.FixedRestMenu = false;
        }

    });


    setTimeout(function(){ $scope.lnk = window.location.href;}, 0);
	RestaurantService.getLogedUser()
		.then(function (response) {
			if(response.data.status == 1){
				$rootScope.logedUser = true;
			}
         });

    var restaurantId = request.id;

    var commentsCallData = {
        page: 1,
        place_id: restaurantId
    };
    
    RestaurantService.getRestaurantData(restaurantId)
        .then(function (response) {
            $scope.currentRestaurant = response.data;

            //rating part
            /*$scope.rating1 = $scope.currentRestaurant.rating != 0 ?$scope.currentRestaurant.rating : 1;

            $scope.isReadonly = true;
            $scope.rateFunction = function (rating) {
                var rateData = rating;
                var rateData = rating;
                $scope.editedRating = true;
            };*/
            //

            $scope.hoursPart = $scope.currentRestaurant.workingHours;
            for(var a in $scope.hoursPart){
                var hoursString= $scope.hoursPart[a];
                var hoursArray = hoursString.split(',');
                $scope.hoursPart[a] = hoursArray;
            }
            $scope.moreCommentsToShow = $scope.currentRestaurant.more_comments;
            $scope.aboutPhoto = $scope.currentRestaurant.coverImages;
            $scope.coverImages =[];
            for(var k=1; k< $scope.aboutPhoto.length; k++){
                $scope.coverImages.push($scope.aboutPhoto[k]);
            }
            /*$scope.haveData = true;*/

            //restaurants images part
            $(document).ready(function(){
                $('.owl-carousel').owlCarousel();
            });
            $(document).ready(function() {
                $("#lightgallery").lightGallery();
            });
            $scope.arr = $scope.currentRestaurant.images;

            $scope.$parent.docLoader = false;
            //make map point
            initMap({
                zoom: 16,
                center: new google.maps.LatLng($scope.currentRestaurant.lat, $scope.currentRestaurant.long),
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.TERRAIN
            });
            createMarker(response.data.lat, response.data.long);

        }.bind($scope));


    //
    /*$scope.togglePhoneNumber = function () {
        $scope.openPhoneInput = $scope.openPhoneInput === false ? true : false;
    };*/
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
			/*.then(function (response) {
				$scope.CurrentMenu = response.data
         });*/
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

    //open write comment part
    $scope.openReply = function (event) {
        var elementParent = event.target.parentNode;
        var elementToShow = $(elementParent).find('.writeSubComment');
        var classes = elementToShow[0].classList;

        var dontHave = true;
        for(var clas=0; clas<classes.length; clas++){
            if(classes[clas] == 'openToWrite'){
                dontHave = false;
                break;
            }
        }
        if(!dontHave){
            classes.remove('openToWrite')
        }else{
            classes.add('openToWrite')
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
    var initMap = function(mapOptions){
        var mapOptions = mapOptions || {
                zoom: 16,
                center: new google.maps.LatLng(40.0000, -98.0000),
                mapTypeId: google.maps.MapTypeId.TERRAIN
            };
        $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);

    };
    //end of map section

    $scope.moreComments = function(){
        commentsCallData.page++;
        RestaurantService.getMoreComments(commentsCallData)
            .then(function(response){

                $scope.moreCommentsToShow = response.data.more_data;

                angular.forEach(response.data.comments, function(value, key){

                    $scope.currentRestaurant.comments.push(value);
                });
            })
    }
});

