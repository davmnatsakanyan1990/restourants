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

        $http({
            method : "GET",
            url : 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+Math.round(lat * 100) / 100+','+Math.round(lon * 100) / 100+'&key=AIzaSyAkB3G-qzliKWCg-x_LYj_BlP5wNRvg2BA' //TODO google api key
        }).then(function successCallback(response) {
            var address_components = response.data.results[0].address_components;
            $http({
                method : 'POST',
                url : 'detect_user_city',
                data : {
                    addresses: address_components
                }
            }).then(function successCallback(response) {
                if(response.data.status == 1){
                    $location.path('/'+response.data.city.name+'/restaurants');
                }
                else{
                    $location.path('/'+default_city+'/restaurants');
                }
            }, function errorCallback(response) {
                $location.path('/'+default_city+'/restaurants');
            });
        }, function errorCallback(response) {

        });
    }

    function showError(error) {
        $location.path('/'+default_city+'/restaurants');
    }
    
});
