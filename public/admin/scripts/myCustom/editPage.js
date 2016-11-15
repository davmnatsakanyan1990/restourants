
var increment = function (inputName, time) {
    var x = document.getElementsByName(inputName)[0];
    if(time == "minute" && x.value <60){
        x.value ++;
    }else if(time == "hours" && x.value <24){
        x.value ++;
    }
};
var decrement = function (inputValue) {
    var x = document.getElementsByName(inputValue)[0];
    if(x.value>0){
        x.value --;
    }
};




$( document ).ready(function() {

});