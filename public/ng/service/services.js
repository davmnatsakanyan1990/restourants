app.factory('RestaurantService', function($http) {
    return {
        getRestaurantData: function(data) {
            return $http({
                method : "GET",
                url : "show/1"
            })
        },
        getRestaurantsList: function(data) {
           return $http({
                method : "GET",
                url : "home/index"
            })
        }

    };
});
