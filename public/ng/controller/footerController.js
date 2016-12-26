app.controller("footerController", function($scope, $rootScope, RestaurantService, Helper, validationService) {
    window.scrollTo(0, 0);
    setTimeout(function(){ $scope.lnk = window.location.href;}, 0);
    $scope.sendMessage = function (data1, data2) {
        if(data1[0] && data1[1] && data1[2] && data1[3]){
            var dataSent = {
                name: data1[0],
                email: data1[1],
                subject: data1[2],
                message: data1[3]
            };
            RestaurantService.contact(dataSent)
                .then(function(response){
                    debugger;
                    Helper.success(['Email was sent successfully', 'email']);
                    var arr = data2;
                    for(var d=0; d<arr.length; d++){
                        $scope[data2[d]] = ' ';
                    }
                    validationService.reset();
                    setTimeout(function(){
                        $rootScope.itIsReset = false;
                    }, 0);
                }, function (error) {
                    Helper.error(['Email was not sent', 'email']);
                })
        }
    }
});
