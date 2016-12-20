app.controller("footerController", function($scope, $http, $window, $location) {
    window.scrollTo(0, 0);
    setTimeout(function(){ $scope.lnk = window.location.href;}, 0)
});
