function successCallback(e){var a=$("#payment_form");$('#payment_form input[name="token"]').val(e.response.token.token),a.submit()}function errorCallback(e){$(".billing-contact-details").prepend('<div class="alert alert-danger">'+e.errorMsg+"</div>")}$("#pay").on("click",function(){var e={sellerId:"103079542",publishableKey:"CCFF05E5-DF12-4830-BA0C-65B671D335A8",ccNo:$("#ccNo").val(),cvv:$("#cvv").val(),expMonth:$("#expMonth").val(),expYear:$("#expYear").val()};TCO.loadPubKey("production",function(){TCO.requestToken(successCallback,errorCallback,e)})});