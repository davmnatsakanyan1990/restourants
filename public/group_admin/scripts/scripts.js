$( document ).ready(function() {
    $( ".more" ).click(function() {
        if($( ".comments" ).hasClass('hide')){
            $( ".comments" ).removeClass('hide');
            $( ".comments" ).addClass('show');
        }else if($( ".comments" ).hasClass('show')){
            $( ".comments" ).addClass('hide');
            $( ".comments" ).removeClass('show');
        }
    });
});