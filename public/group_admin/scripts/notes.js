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
    var element = $(this);
    $.ajax({
        url: BASE_URL+'/group_admin/notes/all/'+place_id,
        type: 'get',
        success: function(data){
            var notes = data;
            var current = element.closest('.comments').find('.commentMain');
            current.empty();
            for(var i=0; i<notes.length; i++){
                var newElement = $( "<div class='comment'><i class='fa fa-pencil' aria-hidden='true'></i>"+notes[i].text+"</div>" );
                $(current).append(newElement)
            }
        }
    })
});
