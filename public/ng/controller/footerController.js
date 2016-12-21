app.controller("footerController", function($scope, RestaurantService, Helper) {
    window.scrollTo(0, 0);
    setTimeout(function(){ $scope.lnk = window.location.href;}, 0);
    $scope.sendMessage = function (data) {
        if(data[0] && data[1] && data[2] && data[3]){
            var dataSent = {
                name: data[0],
                email: data[1],
                subject: data[2],
                message: data[3]
            };
            RestaurantService.contact(dataSent)
                .then(function(response){
                    Helper.success(['Email was sent successfully', 'email']);
                }, function (error) {
                    Helper.error(['Email was not sent', 'email']);
                })
        }
    }
});
