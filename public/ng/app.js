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
            .when("/", {
                templateUrl : "templates/dashboard/home",
                controller : "myCtrl"
            })
            .when("/home", {
                templateUrl : "templates/dashboard/home",
                controller : "myCtrl"
            })
            .when("/:city/category/:name/:id", {
               templateUrl : "templates/dashboard/home",
               controller : "CategoryCtr"
            })
            .when("/:city/restaurants", {
                templateUrl : "templates/dashboard/home",
                controller : "MapCtrl"
            })
            .when("/activation", {
                templateUrl : "templates/dashboard/activation",
                controller : "MapCtrl"
            })
            .when("/forOrganization", {
                templateUrl : "templates/dashboard/forOrganization",
                controller : ""
            })
            .when("/aboutProject", {
                templateUrl : "templates/dashboard/aboutProject",
                controller : ""
            })
            .when("/contacts", {
                templateUrl : "templates/dashboard/contacts",
                controller : ""
            })
            .when("/:city/:name/:id", {
                templateUrl : "templates/dashboard/current",
                controller : "currentController"
            });


    }]);

