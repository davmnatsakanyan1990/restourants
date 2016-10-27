app.factory('RestaurantService', function($http) {
    return {
        getRestaurantData: function(data) {
            return $http({
                method : "GET",
                url : "show/" + data
            })
        },
        getRestaurantsList: function(data) {
           return $http({
                method : "GET",
                url : "restaurants?city=" + data.city+"&page="+ data.page
            })
        },
		getLogedUser: function(data) {
            return $http({
                method : "GET",
                url : "user/is_auth"
            })
        },
		getMenu: function(data) {
            return $http({
                method : "GET",
                url : "products/" + data
            })
        },
        userLogin: function(data) {
            return $http({
                method : "POST",
                url : "user/login",
                data: data
            })
        },
        userRegistration: function(data) {
            return $http({
                method : "POST",
                url : "user/register",
                data: data
            })
        },
        logout: function(data) {
            return $http({
                method : "GET",
                url : "user/logout"
            })
        }

    };
});
