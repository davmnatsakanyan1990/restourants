
$( document ).ready(function() {
    $(document).on('click','.navbar-nav li a', function (e) {
        var elIndex = $(this).parent().index();
        var offTop = $('.parallax').eq(elIndex).offset().top - $('html body .restNav').height();

        $('html,body').stop(true, true).animate({
            scrollTop: offTop
        }, 1000);

        e.preventDefault();

    });

    $( window ).scroll(function() {
        var scroll = $(window).scrollTop();
        var items1 = $('.menuItem1')[0];
        var items2 = $('.menuItem2')[0];
        var items3 = $('.menuItem3')[0];
        var items4 = $('.menuItem4')[0];
        var items = $('.parallax');
        var menuItem = $('.menuItem');
        for(var i=0; i<menuItem.length; i++){
            if($(menuItem[i]).hasClass('active')){
                $(menuItem[i]).removeClass('active')
            }
        }
        if(scroll>=0 && scroll<$(items[1]).offset().top-$('html body .restNav').height()){
            $(items1).addClass('active')
        }else if(scroll>=$(items[1]).offset().top-$('html body .restNav').height() && scroll<$(items[2]).offset().top-$('html body .restNav').height()){
            $(items2).addClass('active')
        }else if(scroll>=$(items[2]).offset().top-$('html body .restNav').height() && scroll<$(items[3]).offset().top-$('html body .restNav').height()){
            $(items3).addClass('active')
        }
        else if(scroll>=$(items[3]).offset().top-$('html body .restNav').height()){
            $(items4).addClass('active')
        }


    });
});

