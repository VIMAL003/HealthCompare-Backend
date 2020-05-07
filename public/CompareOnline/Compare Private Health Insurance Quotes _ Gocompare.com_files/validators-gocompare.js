/*
Contains functions that override default asp.net validator functions for enhanced UI experience.
*/
window.lastcontrol = "";

ValidatorUpdateIsValid = function () {
    var i;
    for (i = 0; i < Page_Validators.length; i++) {
        if (!Page_Validators[i].isvalid) {
            Page_IsValid = false;
            SetValidatorCallouts();
            return;
        }
    }
    Page_IsValid = true;
    ClearValidatorCallouts();
    SetValidatorCallouts();
}

ValidatorValidate = function (val, validationGroup, event) {
    val.isvalid = true;
    if ((typeof (val.enabled) == 'undefined' || val.enabled != false) && IsValidationGroupMatch(val, validationGroup)) {
        if (typeof (val.evaluationfunction) == 'function') {
            val.isvalid = val.evaluationfunction(val);
            if (!val.isvalid && Page_InvalidControlToBeFocused == null &&
                typeof (val.focusOnError) == 'string' && val.focusOnError == 't') {
                ValidatorSetFocus(val, event);
            }
        }
    }

    ValidatorUpdateDisplay(val);
}

SetValidatorCallouts = function () {
    var i;
    var pageValid = true;
    for (i = 0; i < Page_Validators.length; i++) {

        var inputControl = document.getElementById(Page_Validators[i].controltovalidate);

        if (inputControl != window.lastcontrol)
        {
            window.lastcontrol = document.getElementById(Page_Validators[i].controltovalidate);

            if (!Page_Validators[i].isvalid) {
                try {
                    WebForm_AppendToClassName(inputControl, 'error');

                    if ($(inputControl).parents('.form-newstyle-horizontal').length) {
                        var container = $(inputControl).parents('.question_outer');
                        if (container.length > 0) {
                            container.removeClass('complete').addClass('error');
                            if (Page_Validators[i]) {
                                var errorMessage = $(Page_Validators[i]).html();
                                if (errorMessage.replace(/ /g, '').length > 5) {
                                    var gcValid = $('.gcValid', container);
                                    if (gcValid.length == 0) {
                                        container.prepend('<div class="gcValid"></div>');
                                        gcValid = $('.gcValid', container);
                                    }
                                    $(Page_Validators[i]).prependTo(gcValid);
                                    $('.gcValid .field-validation', container).not('error').addClass('error');
                                }
                            }
                        }

                    } else {
                        var container = $(inputControl).parents('.question');
                        if (container.length > 0) {
                            container.removeClass('complete').addClass('error');
                            if (Page_Validators[i]) {
                                var errorMessage = $(Page_Validators[i]).html();
                                if (errorMessage.replace(/ /g, '').length > 5) {
                                    var gcValid = $('.gcValid', container);
                                    if (gcValid.length == 0) {
                                        container.append('<div class="gcValid"></div>');
                                        gcValid = $('.gcValid', container);
                                    }
                                    $(Page_Validators[i]).prependTo(gcValid);
                                    $('.gcValid .field-validation', container).not('error').addClass('error');
                                }
                            }
                        }
                    }

                } catch (e) { }
                pageValid = false;
            }
        }
    }
    window.lastcontrol == "";
    return pageValid;
}

ClearValidatorCallouts = function () {
    $('.question').removeClass('error');
    var i;
    for (i = 0; i < Page_Validators.length; i++) {
        var $inputControl = $('#' + Page_Validators[i].controltovalidate);
        try {
            $inputControl.removeClass('error');
            $inputControl.parents('.question').removeClass('error');
        } catch (e) { }
    }
}

ValidatorOnChange = function (event) {
    if (!event) {
        event = window.event;
    }
    Page_InvalidControlToBeFocused = null;
    var targetedControl;
    if ((typeof (event.srcElement) != "undefined") && (event.srcElement != null)) {
        targetedControl = event.srcElement;
    }
    else {
        targetedControl = event.target;
    }
    var vals;

    if (typeof (targetedControl.Validators) != "undefined") {
        vals = targetedControl.Validators;
    }
    else {
        if (targetedControl.tagName.toLowerCase() == "label") {
            targetedControl = document.getElementById(targetedControl.htmlFor);
            vals = targetedControl.Validators;
        }
    }
    var i;

    if (vals != null) {
        for (i = 0; i < vals.length; i++) {
            ValidatorValidate(vals[i], null, event);
        }
    }

    ValidatorUpdateIsValid();
}

ValidatorUpdateDisplay = function (val) {
    if (typeof (val.display) == "string") {
        if (val.display == "none") {
            return;
        }
        if (val.display == "Dynamic") {
            if (val.isvalid) {
                val.style.display = "none";
                if ($(val).parents('.form-newstyle-horizontal').length) {
                    var container = $(val).parents('.question_outer');
                    if (container.length > 0) {
                        container.removeClass('error');
                    }
                }
                else {
                    var container = $(val).parents('.question');
                    if (container.length > 0) {
                        container.removeClass('error');
                    }
                    return;
                }
            }
            else
                val.style.display = "block";
                var q = $(val).closest('.question');
                var divs = $(q).find('div').not('.gcValid').find('.field-validation.error');
                $(divs).parents().closest('.question').addClass('error');
            return;
        }
    }
    if ((navigator.userAgent.indexOf("Mac") > -1) && (navigator.userAgent.indexOf("MSIE") > -1)) {
        val.style.display = "inline";
    }
    val.style.visibility = val.isvalid ? "hidden" : "visible";

    //console.log('ValidatorUpdateDisplay');
}

function HideValidationErrors() {
    //Hide all validation errors  
    if (window.Page_Validators)
        for (var vI = 0; vI < window.Page_Validators.length; vI++) {
            var vValidator = window.Page_Validators[vI];
            vValidator.isvalid = true;
            ValidatorUpdateDisplay(vValidator);
        }
    $('input.error').removeClass('error');
    $('select.error').removeClass('error');
    $('.question.error').removeClass('error');
    $('.radio2 span.error').removeClass('error');
};