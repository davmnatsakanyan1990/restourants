app.directive('validation', [ 'validationService',function (validationService) {
    return {
        restrict: 'EA',
        scope: {
            validateFor: '=validateFor',
            validateForm: '=validateForm',
            validateValue: '=ngModel',
            required: '=required'
        },
        replace:true,
        template: '<div class="tooltips" ng-class="{'+'displayNone'+': error.value && !error.pattern}"  style="top: 23px; " ng-bind="error.pattern"></div>',
        link: function ($scope, element, attr) {
            $scope.$watch('validateValue', function(newValue, oldValue) {
                $scope.error= {};
                $scope.error.value = true;
                if (newValue) {
                    if(attr.validateFor && attr.validateForm){
                        var form =attr.validateForm;
                        var forElement = attr.validateFor;
                        $scope.error = validationService.validate(attr.validateFor, $scope.validateValue, attr.required?true:false);
                        if($('.tooltips').hasClass('displayNone')){
                            $('.tooltips').removeClass('displayNone')
                        }
                    }
                }else if(newValue ==''){
                    $scope.error = validationService.validate(attr.validateFor, $scope.validateValue, attr.required?true:false);
                }
            });

        }
    }
}]);
