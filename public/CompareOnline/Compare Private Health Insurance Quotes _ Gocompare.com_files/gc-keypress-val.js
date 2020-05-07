var GCValidation = GCValidation || function () {

    function Init() {

        // Call the KeypressValidation method on all inputs to filter specific keys if
        // the permitted length is less than the current length
        $("body").on("keypress", "input", function (e) {
            var ctrl = $(this);
            return keypressValidation(ctrl, e);
        });

        //Validate field data when text pasted into field
        $("body").on("paste", "input", function () {
            fieldId = $(this);
            setTimeout(function () {
                validateFieldData(fieldId);
            }, 0);
        });
    }

    // Keypress filtering will stop non-permitted characters being typed into certain fields. If the key pressed is allowed then return true
    function keypressValidation(ctrl, e) {

        // Allow any non printable key first
        if (typeof e.which == "undefined" || e.which == 0) {
            return true;
        }

        var code = e.charCode ? e.charCode : e.keyCode;

        var commonKeys = [8, 9, 13]; // 8-backspace, 9-tab, 13-enter/return
        if ($.inArray(code, commonKeys) > -1) { // return true if key appears in common list
            return true;
        }

        // Get the filter data property
        var filter = ctrl.data("filter");

        // If it is a printable key check it's keycode to see if it's allowed
        try {
            switch (filter) {
                case "numeric":
                    return ((code >= 48 && code <= 57)); // 0-9
                case "telephone":
                    return ((code >= 48 && code <= 57) || (code === 32)); // 0-9 and spacebar
                case "alphanumeric":
                    if ((code >= 97 && code <= 122) || (code >= 65 && code <= 90) || (code === 32)) // A-Z, a-z, spacebar
                        return true;
                    if (code >= 48 && code <= 57) // 0-9
                        return true;
                    return false;
                case "name":
                    return ((code >= 97 && code <= 122) || (code >= 65 && code <= 90) || (code === 32) || (code === 45) || (code === 39)); // A-Z, a-z, spacebar, -, '
                case "password-login-only":
                    if (code === 188 || code === 190 || code === 60 || code === 62 || code == 59 || code == 58) // Do not allow < > : ;
                        return false;
                    return true;
                case "password":
                    if (code === 188 || code === 190 || code === 60 || code === 62 || code == 59 || code == 58) // Do not allow < > : ;
                        return false;
                    if (code === 47 || code === 38 || code === 34 || code === 39 || code === 44) // Do not allow: /&"',
                        return false;
                    return true;
                case "password_clue":
                    return ((code >= 48 && code <= 57) || (code >= 97 && code <= 122) || (code >= 65 && code <= 90) || (code === 32)); //0-9,  A-Z, a-z, spacebar
                case "itemdescription":
                    if ((code >= 97 && code <= 122) || (code >= 65 && code <= 90) || (code === 32)) { // A-Z, a-z, spacebar
                        return true;
                    }
                    if (code >= 48 && code <= 57) { // 0-9
                        return true;
                    }
                    if (code === 33 || (code >= 35 && code <= 39) || code === 42 || code === 43 || code === 45 || code === 47 || code === 61 || code === 63 || code === 64 || (code >= 94 && code <= 96) || (code >= 123 && code <= 126)) {
                        return true;
                    }
                    return false;
                case "email":
                    // Email characters @.!#$%&\'*+-/=?^_`{|}~ 
                    if ((code >= 97 && code <= 122) || (code >= 65 && code <= 90) || (code === 13)) // A-Z, a-z and enter/return
                        return true;
                    if (code >= 48 && code <= 57) // 0-9
                        return true;
                    if (code === 64) // '@' symbol
                        return true;
                    if (code === 190 || code === 46) // '.' symbol
                        return true;
                    if (code === 33) // '!' symbol
                        return true;
                    if (code === 35) // '#' symbol
                        return true;
                    if (code === 36) // '$' symbol
                        return true;
                    if (code === 37) // '%' symbol
                        return true;
                    if (code === 38) // '&' symbol
                        return true;
                    if (code === 39) // ''' symbol
                        return true;
                    if (code === 42) // '*' symbol
                        return true;
                    if (code === 43) // '+' symbol
                        return true;
                    if (code === 45) // '-' symbol
                        return true;
                    if (code === 47) // '/' symbol
                        return true;
                    if (code === 61) // '=' symbol
                        return true;
                    if (code === 63) // '?' symbol
                        return true;
                    if (code === 94) // '^' symbol
                        return true;
                    if (code === 95) // '_' symbol
                        return true;
                    if (code === 96) // '`' symbol
                        return true;
                    if (code === 123) // '{' symbol
                        return true;
                    if (code === 124) // '|' symbol
                        return true;
                    if (code === 125) // '}' symbol
                        return true;
                    if (code === 126) // '~' symbol
                        return true;
                    return false;
                default:
                    return true;
            }
        }
        catch (error) { // If it encounters any problems then return true
            return true;
        }
    };

    //Validates the contents of an entire field, rather than an individual character
    function validateFieldData(controlToValidate) {
        var curVal = controlToValidate.val();
        var newVal = "";
        for (var i = 0; i < curVal.length; i++) {
            var keycode = curVal[i].charCodeAt(0);
            var keyObj = {};
            keyObj.charCode = keycode;
            keyObj.which = keycode;
            if (keypressValidation(controlToValidate, keyObj)) {
                newVal += curVal[i];
            }
        }
        controlToValidate.val(newVal);
    }

    // removes the validation error message and styling for a particular question
    function removeValidationForQuestion(question) {
        question.removeClass('validation-error');
        question.children().removeClass('validation-error');
        question.find('.editor-validation').children().remove();
    }

    function focusFirstErrorField() {
        var error = $(".validation-error:first");
        if (error.length > 0) {
            var top = error.offset().top;
            $('html, body').animate({
                scrollTop: top - 5
            }, 1);
        }
    }

    return {
        Init: Init,
        RemoveValidationForQuestion: removeValidationForQuestion,
        FocusFirstErrorField: focusFirstErrorField
    };
}();
