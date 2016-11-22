var app = angular.module("myApp", ["ngRoute"]);

app.config(['$interpolateProvider', '$routeProvider','$locationProvider',
    function ($interpolateProvider, $routeProvider,$locationProvider) {
        /*$locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });*/
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

        $routeProvider
            //.when("/:city/home", {
            //    templateUrl : "templates/dashboard/home",
            //    controller : "MapCtrl"
            //})
            .when("/:city/restaurants", {
                templateUrl : "templates/dashboard/home",
                controller : "MapCtrl"
            })
            .when("/activation", {
                templateUrl : "templates/dashboard/activation",
                controller : "MapCtrl"
            })
            .when("/:city/:name/:id", {
                templateUrl : "templates/dashboard/current",
                controller : "currentController"
            });


    }]);

