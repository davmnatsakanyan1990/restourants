app.directive('homeloader', function () {
    return {
        restrict: 'E',
        replace:true,
        template: '<div class="home-loader"><img src="/images/loader2.gif" width="100" height="100" /></div>',
        link: function (scope, element, attr) {
            scope.$watch('docLoader', function (val) {
                if (val)
                    $(element).show();
                else
                    $(element).hide();
            });
        }
    }
});
