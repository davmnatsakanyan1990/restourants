$('#pay').on('click',function(){

    var args = {
        sellerId: "901334016",
        publishableKey: "8ED1BCB0-5417-4D5E-806D-BD517442933F",
        ccNo: $("#ccNo").val(),
        cvv: $("#cvv").val(),
        expMonth: $("#expMonth").val(),
        expYear: $("#expYear").val()
    };

    
    TCO.loadPubKey('sandbox', function() {
        TCO.requestToken(successCallback, errorCallback, args);
    })
});


function successCallback(response){
    var form = $('#payment_form');
    $('#payment_form input[name="token"]').val(response.response.token.token);
    form.submit();
    // $.ajax({
    //     url:"place_order",
    //     data: {'token': token},
    //     method:'post',
    //     success:function (response) {
    //         if(response.success) {
    //             var div = '<div class="alert alert-success">' + response.message + "</div>";
    //             $('.pick-page').hide()
    //         }
    //         else {
    //             var div = '<div class="alert alert-danger">' + response.message + "</div>";
    //         }
    //         $('.messages').append(div);
    //     }
    // });

};


function errorCallback(responce){
    $('.billing-contact-details').prepend('' +
        '<div class="alert alert-danger">'+responce.errorMsg+'</div>')
}
