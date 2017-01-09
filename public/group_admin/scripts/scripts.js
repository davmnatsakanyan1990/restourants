$( document ).ready(function() {
    $( ".more" ).click(function(e) {
        var element = e.target.parentNode.parentNode;
        var currentElement = $(element).find('.comments');
        if($( currentElement ).hasClass('hide')){
            $( currentElement ).removeClass('hide');
            $( currentElement ).addClass('show');
        }else if($( ".comments" ).hasClass('show')){
            $( currentElement ).addClass('hide');
            $( currentElement).removeClass('show');
        }
    });
});