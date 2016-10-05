var app = angular.module("myApp", []);

app.config(['$interpolateProvider',
    function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }]);
