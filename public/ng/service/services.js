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
                url : data.city+"/restaurants?page="+ data.page
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
        },
        writeComment: function(data) {
            return $http({
                method : "POST",
                url : "comment/add",
                data: data
            })
        },
        getMoreRestaurant: function(page, city, filters) {
            return $http({
                method : "GET",
                url : city+"/restaurants/more/?page="+page+"&filters=" + JSON.stringify(filters)
            })
        },
        filterRestaurant: function(data) {
            return $http({
                method : "GET",
                url : data.city+"/restaurants/filter/?page="+data.page+"&filters=" + JSON.stringify(data.filters)
            })
        },

        getMoreComments: function(data){
            return $http ({
                method : "GET",
                url : 'comments?place_id='+data.place_id+'&page='+data.page
            })
        },

        sendRegistrationMail: function(email){
            return $http ({
                method: "GET",
                url: 'sendmail/'+email
            })
        },

        getMode: function(data, city){
            return $http ({
                method: "GET",
                url : "restaurants/category/" + JSON.stringify(data)+"?city="+city
            })
        },
        SearchRestaurant: function(data){
            return $http ({
                method: "GET",
                url : "search?id=" + data.id + "?value=" + data.restaurant
            })
        },
        rootData: function(){
            return $http ({
                method: "GET",
                url : "root/data"
            })
        }


    };
});



