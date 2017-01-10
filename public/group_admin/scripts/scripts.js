$( document ).ready(function() {
    $( ".more" ).click(function(e) {
        var myElement = e.target
        if($(myElement).hasClass('fa-chevron-down')){
            $(myElement).removeClass('fa-chevron-down');
            $(myElement).addClass('fa-chevron-up');
        }else if($(myElement).hasClass('fa-chevron-up')){
            $(myElement).removeClass('fa-chevron-up');
            $(myElement).addClass('fa-chevron-down');
        }
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



