$( document ).ready(function() {
    $('.changeCover').on('click', function(){
        var text = $(this).closest('.restaurant').find('select').val();
        var place_id = $(this).data('place_id');
        console.log(text, place_id);
        $.ajax({
            url: BASE_URL+'/super_admin/places/update/'+place_id,
            type: 'post',
            data: {
                admin_id: text
            },
            success: function(data){
                if(data.success){

                }
            }
        })
    });

});