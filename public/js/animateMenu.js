$( document ).ready(function() {
    $('.navbar-nav li a').on('click', function (e) {

        var elIndex = $(this).parent().index();
        var offTop = $('.parallax').eq(elIndex).offset().top - $('html body .restNav').height();
        
        $('html,body').stop(true, true).animate({
            scrollTop: offTop
        }, 1000);

        e.preventDefault();

    });
});

