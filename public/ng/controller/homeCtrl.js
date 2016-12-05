app.controller("myCtrl", function($scope, $http, $document, $window, $location, $timeout, RestaurantService) {
    $location.path('/salt lake city/restaurants');
    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(showPosition, showError);
    // } else {
    //     $location.path('/salt lake city/restaurants');
    // }
    //
    // function showPosition(position) {
    //     var lat = position.coords.latitude;
    //     var lon = position.coords.longitude;
    //
    //     $http({
    //         method : "GET",
    //         url : 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+Math.round(lat * 100) / 100+','+Math.round(lon * 100) / 100+'&key=AIzaSyAkB3G-qzliKWCg-x_LYj_BlP5wNRvg2BA' //TODO google api key
    //     }).then(function successCallback(response) {
    //         console.log(response.data);
    //     }, function errorCallback(response) {
    //
    //     });
    //
    // }
    //
    // function showError(error) {
    //     $location.path('/salt lake city/restaurants');
    // }
    
});
