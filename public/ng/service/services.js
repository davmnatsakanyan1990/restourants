app.factory('RestaurantService', function($http) {
    return {
        getRestaurantData: function(data) {
            return $http({
                method : "GET",
                url : "home/index"
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
