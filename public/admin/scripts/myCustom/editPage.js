
var increment = function (inputName, time) {
    var x = document.getElementsByName(inputName)[0];
    if(time == "minute" && x.value <60){
        x.value ++;
        if(x.value<10){
            x.value = '0'+x.value
        }
    }else if(time == "hours" && x.value <24){
        x.value ++;
        if(x.value<10){
            x.value = '0'+x.value
        }
    }
};
var decrement = function (inputName) {
    var x = document.getElementsByName(inputName)[0];
    if(x.value>0){
        x.value --;
        if(x.value<10){
            x.value = '0'+x.value
        }
    }
};

function removePeriod(element) {
    element.parentNode.remove();
};


$( document ).ready(function() {
    $(".addMore").click(function(event){
        var addingElement= event.target.parentNode.parentNode.parentNode;
        var currentElementName = $(addingElement).find('label');
        var currentName = currentElementName[0].innerHTML;
        var elemName = currentName.split(":")[0].toLocaleLowerCase();
        console.log(elemName);

        var el_count = $(addingElement).find('.addingElement').length;

        var adding = '<div class="addingElement" style = "margin: 10px 0 0 74px;">' +
            '<div class="counters">' +
            '<div class="elementsBlock">' +
            '<input type="text" name="'+elemName+'[data]['+(el_count+1)+'][from][hr]" class="form-control" value="00"/>' +
            '<div class="upDown">' +
            '<i class="fa fa-angle-up hours" aria-hidden="true"></i>' +
            '<i class="fa fa-angle-down" aria-hidden="true"></i>' +
            '</div>' +
            '</div>' +
            '<div class="margin5">:</div> ' +
            '<div class="elementsBlock"> ' +
            '<input type="text" name="'+elemName+'[data]['+(el_count+1)+'][from][min]" class="form-control" value="00"/> ' +
            '<div class="upDown"> ' +
            '<i class="fa fa-angle-up minute" aria-hidden="true"></i> ' +
            '<i class="fa fa-angle-down" aria-hidden="true"></i> ' +
            '</div> ' +
            '</div> ' +
            '<label for="" style="width: auto">to</label> ' +
            '<div class="elementsBlock"> ' +
            '<input type="text" name="'+elemName+'[data]['+(el_count+1)+'][to][hr]" class="form-control" value="00"/> ' +
            '<div class="upDown">' +
            '<i class="fa fa-angle-up hours" aria-hidden="true"></i>' +
            '<i class="fa fa-angle-down" aria-hidden="true"></i>' +
            '</div>' +
            '</div>' +
            '<div class="margin5">:</div>' +
            '<div class="elementsBlock">' +
            '<input type="text" name="'+elemName+'[data]['+(el_count+1)+'][to][min]" class="form-control" value="00"/>' +
            '<div class="upDown">' +
            '<i class="fa fa-angle-up minute" aria-hidden="true"></i>' +
            '<i class="fa fa-angle-down" aria-hidden="true"></i>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="addMore" title="add more time period" style="color: red;" onclick = "removePeriod(this)">' +
            '<i class="fa fa-minus" aria-hidden="true"></i>' +
            '</div>' +
            '</div>';
        $(addingElement).append(adding);
        $(".addingElement").find('.fa-angle-up').on('click', function (event) {
            var CurrentBlock = event.target.parentNode.parentNode;
            var currentInput = $(CurrentBlock).find('input');
            var formName = currentInput[0].name;
            var timeElement = event.target;
            var hour = $(timeElement).hasClass('hours');
            var minute = $(timeElement).hasClass('minute');
            var time = '';
            if(hour){
                time = 'hours'
            }else if(minute){
                time = 'minute'
            }
            console.log(hour, time);
            increment(formName, time);
        })
    });
});

$( window ).load(function() {


});


$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span>" +
                        "</span>").insertAfter("#files");
                    $(".remove").click(function(){
                        $(this).parent(".pip").remove();
                    });

                    // Old code here
                    /*$("<img></img>", {
                     class: "imageThumb",
                     src: e.target.result,
                     title: file.name + " | Click to remove"
                     }).insertAfter("#files").click(function(){$(this).remove();});*/

                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});
function startUpload(){
    /*document.getElementById('f1_upload_process').style.visibility = 'visible';*/
    return true;
}

/*
$.ajax({
    url: "script.php",
    type: "POST",
    data: {id : menuId},
    dataType: "html"
});
*/
