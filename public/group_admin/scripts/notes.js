$('.addComment').on('click', function(){
    var text = $(this).closest('.comments').find('textarea').val();
    var place_id = $(this).data('place_id');
    var section = $(this);
    $.ajax({
        url: BASE_URL+'/group_admin/notes/new',
        type: 'post',
        data: {
            text: text,
            place_id: place_id
        },
        success: function(data){
            if(data.success){
                section.closest('.comments').find('.commentMain').text(text);
                section.closest('.comments').find('textarea').val('');
            }
        }
    })
});

$('.viewAll').on('click', function(){
    var place_id = $(this).data('place_id');

    $.ajax({
        url: BASE_URL+'/group_admin/notes/all/'+place_id,
        type: 'get',
        success: function(data){
            
        }
    })
});
