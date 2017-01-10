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


/*
debugger;
var place_id = $(this).data('place_id');
var current = el.target.parentNode;
console.log(current);
var element = $($(current).find('.commentMain'));
console.log(element)
var notes = ['note1 bla bloa bla bla', 'note2, bla bla bla bla','note3 bla bloa bla bla', 'note4, bla bla bla bla', 'note5 bla bloa bla bla', 'note6, bla bla bla bla',
    'note1 bla bloa bla bla', 'note2, bla bla bla bla','note3 bla bloa bla bla', 'note4, bla bla bla bla', 'note5 bla bloa bla bla', 'note6, bla bla bla bla',
    'note1 bla bloa bla bla', 'note2, bla bla bla bla','note3 bla bloa bla bla', 'note4, bla bla bla bla', 'note5 bla bloa bla bla', 'note6, bla bla bla bla',
    'note1 bla bloa bla bla', 'note2, bla bla bla bla','note3 bla bloa bla bla', 'note4, bla bla bla bla', 'note5 bla bloa bla bla', 'note6, bla bla bla bla',
    'note1 bla bloa bla bla', 'note2, bla bla bla bla','note3 bla bloa bla bla', 'note4, bla bla bla bla', 'note5 bla bloa bla bla', 'note6, bla bla bla bla'];
element.empty();
for(var i=0; i<notes.length; i++){
    var newElement = $( "<div class='comment'><i class='fa fa-pencil' aria-hidden='true'></i>"+notes[i]+"</div>" );
    $(element).append(newElement)
}*/
