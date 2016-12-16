app.directive('validation', ['$rootScope', 'validationService',function ($rootScope,validationService) {
    return {
        restrict: 'EA',
        scope: {
            validateFor: '=validateFor',
            validateForm: '=validateForm',
            validateValue: '=ngModel',
            required: '=required'
        },
        replace:true,
        template: '<div class="tooltips"  ng-show="!error.value && error.pattern"  style="top: 23px; " ng-bind="error.pattern"></div>',
        link: function ($scope, element, attr) {

            $scope.$watch('validateValue', function(newValue, oldValue) {
                /*debugger;*/
                /*$rootScope.error= {};
                $rootScope.error.value = true;*/
                /*if($('.tooltips ').hasClass('displayNone')){
                    $('.tooltips ').removeClass('displayNone');
                }*/
                if($rootScope.itIsReset){
                    $scope.error = $rootScope.error;
                }else{
                    if (newValue) {
                        if(attr.validateFor && attr.validateForm){
                            var form =attr.validateForm;
                            var forElement = attr.validateFor;
                            $rootScope.error = validationService.validate(attr.validateFor, $scope.validateValue, attr.required?true:false);
                        }
                    }else if(newValue =='' && oldValue){
                        $rootScope.error = validationService.validate(attr.validateFor, $scope.validateValue, attr.required?true:false);
                    }
                    $scope.error = $rootScope.error;
                }


            });

        }
    }
}]);
