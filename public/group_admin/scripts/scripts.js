$( document ).ready(function() {
    $( ".more" ).click(function(e) {
        var myElement = e.target
        if($(myElement).hasClass('fa-chevron-down')){
            $(myElement).removeClass('fa-chevron-down');
            $(myElement).addClass('fa-chevron-up');
        }else if($(myElement).hasClass('fa-chevron-up')){
            $(myElement).removeClass('fa-chevron-up');
            $(myElement).addClass('fa-chevron-down');
        }
        var element = e.target.parentNode.parentNode;
        var currentElement = $(element).find('.comments');
        if($( currentElement ).hasClass('hide')){
            $( currentElement ).removeClass('hide');
            $( currentElement ).addClass('show');
        }else if($( ".comments" ).hasClass('show')){
            $( currentElement ).addClass('hide');
            $( currentElement).removeClass('show');
        }
    });
});
$('.loadingDiv').hide();
$('.place_status').on('change', function(){
    var place_id = $(this).data('id');
    var status = $(this).val();
    var load= $(this).closest('.restaurant').find('.loadingDiv');
    $.ajax({
        url: BASE_URL+'/group_admin/place/update_status',
        type: 'post',
        data: {
            place_id: place_id,
            status: status
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





