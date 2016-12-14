app.factory('validationService', function() {
    return {
        validate: function(validateName, validateValue) {
            var value = false;
            var pattern;
            debugger;
            switch (validateName){
                case 'name':
                    if(validateValue){
                        value = /^[a-zA-Z]*$/.test(validateValue);
                        pattern = 'Type only letters'
                    }
                    break;
                case 'email':
                    if(validateValue){
                        value = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(validateValue);
                        pattern = 'Invalid email'
                    }
                    break ;
                case 'number':
                    if(validateValue){
                        value = /^[0-9]*$/.test(validateValue);
                        pattern = 'Type only numbers'
                    }
                    break;
                case 'website':
                    if(validateValue){
                        value = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/.test(validateValue);
                        pattern = 'Invalid web page'
                    }
                    break;
            }
            return {value: value, pattern: pattern};
        }
    };
});



