$('#submit').on('click',function(){
    var args = {
        sellerId: "901332804",
        publishableKey: "5325EC5F-466D-4DF2-9C97-5F3B45937583",
        ccNo: $("#ccNo").val(),
        cvv: $("#cvv").val(),
        expMonth: $("#expMonth").val(),
        expYear: $("#expYear").val()
    };

    console.log(args);

    TCO.loadPubKey('sandbox', function() {
        TCO.requestToken(successCallback, errorCallback, args);
    })
});


function successCallback(response){
    var token = response.response.token.token;
    $.ajax({
        url:"pay",
        data: {'token': token},
        method:'post',
        success:function (response) {
            if(response.success) {
                var div = '<div class="alert alert-success">' + response.message + "</div>";
                $('.pick-page').hide()
            }
            else {
                var div = '<div class="alert alert-danger">' + response.message + "</div>";
            }
            $('.messages').append(div);
        }
    });

};


function errorCallback(responce){
    console.log(responce)
}
