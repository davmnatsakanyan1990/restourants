$( document ).ready(function() {
    function toggleCheckbox() {
        if ($(".order-block > label > input").prop("checked")) {
            $(".checkout-page .right-sitebar .block-content .order-block .butt-block > button").css({"background-color": "#ff7e00", "pointer-events": "all"});
        }else{
            $(".checkout-page .right-sitebar .block-content .order-block .butt-block > button").css({"background-color": "#e9eaea", "pointer-events": "none"});
        }
    }

   /* function creditCardTab() {
        debugger;
        $( ".pay-check" ).each(function() {
            var itemIndex = $(this).parent().index();
            if ($(this).prop("checked")) {
                $(".checkout-page .cont .credit-card > .block").eq(itemIndex).css("display", "block")
            }else{
                $(".checkout-page .cont .credit-card > .block").eq(itemIndex).css("display", "none")
            }
        });
    }

    creditCardTab();*/

    toggleCheckbox();

    $(".order-block > label > input").on("click", function () {
        toggleCheckbox();
    });

    $(".pay-check").on("click", function () {
        creditCardTab();
    });

    var checkoutOffTop = $(".checkout-page").offset().top;


    $(window).scroll(function () {
        if ($(window).scrollTop() >= $(".checkout-page .cont > div.top-block").offset().top) {
            $(".checkout-page .right-sitebar").css("top", $(window).scrollTop() - checkoutOffTop + 50);
            $(".checkout-page .right-sitebar").addClass("position-fixed");
        } else if ($(window).scrollTop() <= $(".checkout-page .cont > div.top-block").offset().top) {
            $(".checkout-page .right-sitebar").removeClass("position-fixed");
        }
    });
});