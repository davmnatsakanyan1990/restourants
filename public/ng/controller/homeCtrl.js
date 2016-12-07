app.controller("myCtrl", function($scope, $http, $document, $window, $location, $timeout, RestaurantService) {
    // $location.path('/salt lake city/restaurants');

    var default_city = 'salt lake city';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        $location.path('/'+default_city+'/restaurants');
    }

    function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;

        RestaurantService.GoogleApiGeolocation()
            .then(function successCallback(response) {

            var address_components = response.data.results[0].address_components;

                RestaurantService.detectUserCity(address_components)
                    .then(function successCallback(response) {

                if(response.data.status == 1){
                    $location.path('/'+response.data.city.name+'/restaurants');
                }
                else{
                    $location.path('/'+default_city+'/restaurants');
                }
            }, function error(response) {
                $location.path('/'+default_city+'/restaurants');
            });
        }, function error(response) {

        });
    }

    function showError(error) {
        $location.path('/'+default_city+'/restaurants');
    }
    
});
