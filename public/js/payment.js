$('#pay').on('click',function(){

    var args = {
        sellerId: "103079542",
        publishableKey: "CCFF05E5-DF12-4830-BA0C-65B671D335A8",
        ccNo: $("#ccNo").val(),
        cvv: $("#cvv").val(),
        expMonth: $("#expMonth").val(),
        expYear: $("#expYear").val()
    };

    
    TCO.loadPubKey('production', function() {
        TCO.requestToken(successCallback, errorCallback, args);
    })
});


function successCallback(response){
    var form = $('#payment_form');
    $('#payment_form input[name="token"]').val(response.response.token.token);
    form.submit();
};


function errorCallback(responce){
    $('.billing-contact-details').prepend('' +
        '<div class="alert alert-danger">'+responce.errorMsg+'</div>')
}
