app.factory('Helper', function() {
    return {
        error: function (data) {
            var animate = function (element) {
                element.animate({ opacity: '0.4', height: '100px'}, "slow");
                element.animate({ opacity: '1'}, "slow");
                element.animate({ opacity: '0.4'}, "slow");
                element.animate({ opacity: '0', height: '0'}, "slow");
            };
            $('.error').remove();
            var el = '<div class="confirmation error '+data[1]+'"> <i class="fa fa-times" aria-hidden="true"></i><div class="text">'+data[0]+'</div> </div>';
            $('body').append(el);
            animate($('.error'));
        },
        success: function (data) {
            var animate = function (element) {
                element.animate({ opacity: '0.4', height: '100px'}, "slow");
                element.animate({ opacity: '1'}, "slow");
                element.animate({ opacity: '0.4'}, "slow");
                element.animate({ opacity: '0', height: '0'}, "slow");
            };
            $('.confirm').remove();
           var el = '<div class="confirmation confirm '+data[1]+'"> <i class="fa fa-check" aria-hidden="true"></i><div class="text">'+data[0]+'</div> </div>';
            $('body').append(el);
            animate($('.confirm'));
        }
    };
});
