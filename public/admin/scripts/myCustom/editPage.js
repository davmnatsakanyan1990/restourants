
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

var addPeriod = function (element, inputName) {

    var elem = element.parentNode.parentNode;
    var parent = element.parentNode;
    var clon = parent.cloneNode(true);
    clon.style = 'margin: 10px 0 0 74px;';
    //var child = clon.childNodes[0];
    var icon = document.createElement("I");
    icon.className = "fa fa-minus";
    var replacementNode = clon.lastElementChild;
    replacementNode.replaceChild(icon, replacementNode.childNodes[1]);
    replacementNode.onclick = null;
    replacementNode.addEventListener("onclick", removePeriod());
    replacementNode.style = 'color: red;';
    var elementName = clon.getElementsByClassName('elementsBlock');
    elem.insertBefore(clon, elem.appendChild.nextSibling);
};

var removePeriod = function (parent, element) {
    console.log('will be removed')

};




$( document ).ready(function() {

});