var app = angular.module("myApp", ["ngRoute", 'localytics.directives', '720kb.socialshare']);

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
            .when("/forOrganization", {
                templateUrl : "templates/dashboard/forOrganization",
                controller : "footerController"
            })
            .when("/aboutProject", {
                templateUrl : "templates/dashboard/aboutProject",
                controller : "footerController"
            })
            .when("/contacts", {
                templateUrl : "templates/dashboard/contacts",
                controller : "footerController"
            })
            .when("/termsOfUse", {
             templateUrl : "templates/dashboard/termsOfUse",
             controller : "footerController"
             })
            .when("/privacyPolicy", {
                templateUrl : "templates/dashboard/privacyPolicy",
                controller : "footerController"
            })
            .when("/:city/:name/:id", {
                templateUrl : "templates/dashboard/current",
                controller : "currentController"
            });

    }]);