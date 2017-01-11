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
                var news = section.closest('.comments').find('.commentMain');
                section.closest('.comments').find('textarea').val('');
                var viewElement = section.closest('.comments').find('.viewAll');
                var newElement = $( "<div class='comment'><i class='fa fa-pencil' aria-hidden='true'></i>"+text+"</div>" );
                if(viewElement[0].innerHTML == '<a>View All</a>'){
                    news.empty();
                    $(news).prepend(newElement)
                }else if(viewElement[0].innerHTML == '<a>View Less</a>'){
                    $(news).prepend(newElement)
                }
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
        $(element).prepend(el);
        /*var current = element.closest('.comments').find('.commentMain');
        current.empty();*/
        var current = element.closest('.comments').find('.commentMain :first-child');

        current.nextAll().remove();

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
                    $(current).prepend(newElement)
                }
                element.empty();
                var el = $( "<a>View Less</a>" );
                $(element).prepend(el);
            }
        })
    }

});
$('.addingEmail').hide();
$('.addEmail').on('click', function(){
    $(this).hide();
    $(this).closest('.addressGroup').find('.addingEmail').show();
});
$('.cancel').on('click', function(){
    $(this).closest('.addressGroup').find('.addingEmail').hide();
    $(this).closest('.addressGroup').find('.addEmail').show();
});
$('.save').on('click', function(){
    var email = $(this).closest('.addressGroup').find('input').val();
    var place_id = $(this).data('place_id');
    var t = $(this)
    if(email){
        $.ajax({
            url: BASE_URL+'/group_admin/place/add_email',
            type: 'post',
            data: {
                email: email,
                place_id: place_id
            },
            success: function(){
                t.closest('.addressGroup').find('.addingEmail').hide();
                t.closest('.addressGroup').find('.addEmail').hide();
                t.closest('.addressGroup').append(email);
            }
        })
    }
});