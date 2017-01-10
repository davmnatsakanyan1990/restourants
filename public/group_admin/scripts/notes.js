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
    console.log(element[0].innerHTML);
    if(element[0].innerHTML == '<a>View Less</a>'){
        element.empty();
        var el = $( "<a>View All</a>" );
        $(element).append(el);
        /*var current = element.closest('.comments').find('.commentMain');
        current.empty();*/
        var current = element.closest('.comments').find('.commentMain :first-child');

        current.nextAll().remove();
        current.after(data);
    }else if(element[0].innerHTML == '<a>View All</a>'){
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
                element.empty();
                var el = $( "<a>View Less</a>" );
                $(element).append(el);
            }
        })
    }

});
