
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
        //console.log(event.target.parentNode.parentNode.parentNode);
        var addingElement= event.target.parentNode.parentNode.parentNode;
        var currentElementName = $(addingElement).find('label');
        var currentName = currentElementName[0].innerHTML;
        var elemName = currentName.split(":")[0].toLocaleLowerCase();
        console.log(elemName);
        var adding = '<div class="addingElement" style = "margin: 10px 0 0 74px;">' +
            '<div class="counters">' +
            '<div class="elementsBlock">' +
            '<input type="text" name=elemName"_from1" class="form-control" value="00"/>' +
            '<div class="upDown">' +
            '<i class="fa fa-angle-up hours" aria-hidden="true"></i>' +
            '<i class="fa fa-angle-down" aria-hidden="true"></i>' +
            '</div>' +
            '</div>' +
            '<div class="margin5">:</div> ' +
            '<div class="elementsBlock"> ' +
            '<input type="text" name=elemName"_from2" class="form-control" value="00"/> ' +
            '<div class="upDown"> ' +
            '<i class="fa fa-angle-up minute" aria-hidden="true"></i> ' +
            '<i class="fa fa-angle-down" aria-hidden="true"></i> ' +
            '</div> ' +
            '</div> ' +
            '<label for="" style="width: auto">to</label> ' +
            '<div class="elementsBlock"> ' +
            '<input type="text" name=elemName"_to1" class="form-control" value="00"/> ' +
            '<div class="upDown">' +
            '<i class="fa fa-angle-up hours" aria-hidden="true"></i>' +
            '<i class="fa fa-angle-down" aria-hidden="true"></i>' +
            '</div>' +
            '</div>' +
            '<div class="margin5">:</div>' +
            '<div class="elementsBlock">' +
            '<input type="text" name=elemName"_to2" class="form-control" value="00"/>' +
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
    /*function addPeriod(element, inputName) {

        var elem = element.parentNode.parentNode;
        var parent = element.parentNode;
        var clon = parent.cloneNode(true);
        //var clon = '<div class="addingElement"><div class="counters"><div class="elementsBlock"><input type="text" name="sat_from1" class="form-control" value="00"/></div></div></div>';
        clon.style = 'margin: 10px 0 0 74px;';
        //var child = clon.childNodes[0];
        var icon = document.createElement("I");
        icon.className = "fa fa-minus";
        var replacementNode = clon.lastElementChild;
        replacementNode.replaceChild(icon, replacementNode.childNodes[1]);
        //replacementNode.onclick = null;
        replacementNode.addEventListener("onclick", removePeriod());
        replacementNode.style = 'color: red;';
        var elementName = clon.getElementsByClassName('elementsBlock');
        elem.insertBefore(clon, elem.appendChild.nextSibling);
    };*/


});

$( window ).load(function() {


});