$( document ).ready(function() {
    function toggleCheckbox() {
        if ($(".order-block > label > input").prop("checked")) {
            $(".checkout-page .right-sitebar .block-content .order-block > button").css("pointer-events", "all");
        }else{
            $(".checkout-page .right-sitebar .block-content .order-block > button").css("pointer-events", "none");
        }
    }

  /*  function creditCardTab() {
        $( ".pay-check" ).each(function() {
            var itemIndex = $(this).parent().index();
            if ($(this).prop("checked")) {
                $(".checkout-page .cont .credit-card > .block").eq(itemIndex).css("display", "block")
            }else{
                $(".checkout-page .cont .credit-card > .block").eq(itemIndex).css("display", "none")
            }
        });
    }*/

   /* creditCardTab();*/

    toggleCheckbox();

    $(".order-block > label > input").on("click", function () {
        toggleCheckbox();
    });

    /*$(".pay-check").on("click", function () {
        creditCardTab();
    });*/


});