$( document ).ready(function() {
    $('.loadingDiv').hide();

    $('.changeCover').on('click', function(){
        var text = $(this).closest('.restaurant').find('select').val();
        var place_id = $(this).data('place_id');
        var load= $(this).closest('.restaurant').find('.loadingDiv');
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
    });

});