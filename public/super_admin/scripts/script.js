$( document ).ready(function() {
    $('.loadingDiv').hide();
    $('.changeCover').prop('disabled', true);
    $( "select" ).change(function() {
        var currentButton = $(this).closest('.restaurant').find('.changeCover');
        if($(this).val()){
            $(this).closest('.restaurant').find('.changeCover').prop('disabled', false);
            if($(currentButton).hasClass('disable')){
                $(currentButton).removeClass('disable')
            }
        }else{
            $(currentButton).addClass('disable')
        }
    });
    $('.changeCover').on('click', function(){
        var text = $(this).closest('.restaurant').find('select').val();
        var place_id = $(this).data('place_id');
        var load= $(this).closest('.restaurant').find('.loadingDiv');

        if(text){
            $.ajax({
                url: BASE_URL+'/super_admin/places/update/'+place_id,
                type: 'post',
                data: {
                    admin_id: text
                },
                success: function(data){
                    load.show();
                },
                complete: function(){
                    setTimeout(function(){
                        load.hide();
                    }, 1000);
                }
            })
        }
    });


});