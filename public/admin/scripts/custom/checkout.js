$( document ).ready(function() {
    function toggleCheckbox() {
        if ($(".order-block > label > input").prop("checked")) {
            $(".checkout-page .right-sitebar .block-content .order-block > button").css("pointer-events", "all");
        }else{
            $(".checkout-page .right-sitebar .block-content .order-block > button").css("pointer-events", "none");
        }
    }

    toggleCheckbox();

    $(".order-block > label > input").on("click", function () {
        toggleCheckbox();
    });

   /* $(".pay-check").on("click", function () {
        var itemIndex = $(this).parent().index();
        alert(itemIndex);
    });*/


});