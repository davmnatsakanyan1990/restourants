app.controller("myCtrl", function($scope,$rootScope, $http, $document, $window, $location, $timeout, RestaurantService) {
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

        RestaurantService.GoogleApiGeolocation({lat:lat, lon:lon})
            .then(function successCallback(response) {
                var address_components = response.data.results[0].address_components;

                RestaurantService.detectUserCity(address_components)
                    .then(function successCallback(response) {

                        if(response.data.status == 1){
                            $location.path('/'+response.data.city.name+'/restaurants');
                            $rootScope.city = response.data.city.name;
                            var dataFor = JSON.stringify($rootScope.city);
                            localStorage.setItem('cityName', dataFor);
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
