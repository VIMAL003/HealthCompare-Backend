// Submitting and validating the private hospital enquiry form

// $.extend($.datepicker, {
//     _checkOffset: function (inst, offset, isFixed) {
//         // If the container is pos fixed, alter the coordinates accordingly
//         if(isFixed) {
//             // Find out how much window has scrolled
//             var scrolled = window.scrollY;
//             // get the position of the top of the input
//             var posY = offset.top;
//             offset.top = posY - scrolled;
//         }
//
//         return offset;
//     }
// });

// Create jquery datepicker from DOB input
// $("#dateOfBirth").datepicker({
//     changeMonth: true,
//     changeYear: true,
//     yearRange: "-100:-0",
//     dateFormat: "dd/mm/yy",
//     altField: "#actualDate",
//     altFormat: "yy/mm/dd",
//     setDate: "-0d"
// }).on('change', function() {
//     $(this).valid();  // triggers the validation test
// });

// Matches UK postcode. Does not match to UK Channel Islands that have their own postcodes (non standard UK)
$.validator.addMethod("postcodeUK", function (value, element) {
    return this.optional(element) || /^((([A-PR-UWYZ][0-9])|([A-PR-UWYZ][0-9][0-9])|([A-PR-UWYZ][A-HK-Y][0-9])|([A-PR-UWYZ][A-HK-Y][0-9][0-9])|([A-PR-UWYZ][0-9][A-HJKSTUW])|([A-PR-UWYZ][A-HK-Y][0-9][ABEHMNPRVWXY]))\s?([0-9][ABD-HJLNP-UW-Z]{2})|(GIR)\s?(0AA))$/i.test(value);
}, "Please specify a valid UK postcode");

// Add a custom validation to the jquery validate object - validate phone number field as UK format
$.validator.addMethod('phoneUK', function (phone_number, element) {
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^(\(?(0|\+44)[1-9]{1}\d{1,4}?\)?\s?\d{3,4}\s?\d{3,4})$/);
    }, 'Please specify a valid phone number'
);

// regex for date format
$.validator.addMethod("dateFormat", function (date) {
        // Match the basic structure required
        return date.match(/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/);
    },
    "Please enter a date in the format dd/mm/yyyy."
);

$.validator.addMethod("alpha", function (value, element) {
        return value.match(/^[a-zA-Z\s]*$/);
    },
    "Please enter only alphabetical characters"
);

// Get form
var $form = $('#enquiry_form');

// Only run if the page contains the enquiry form
if ($form.length > 0) {

    // jquery validate options
    $form.validate({
        ignore: ".ignore",
        rules: {
            hospital_id: {
                required: true
            },
            spam_test: {
                maxlength: 0
            },
            hiddenRecaptcha: {
                required: function () {
                    return grecaptcha.getResponse() === '';
                }
            },
            title: "required",
            firstName: {
                required: true,
                alpha: true
            },
            lastName: {
                required: true,
                alpha: true
            },
            email: {
                required: true,
                email: true
            },
            confirm_email: {
                required: true,
                equalTo: "#email",
                email: true
            },
            phone_number: {
                required: true,
                phoneUK: true
            },
            postcode: {
                required: true,
                postcodeUK: true
            },
            procedure_id: "required",
            gdpr: "required"
        },
        messages: {
            hospital_id: "There is no hospital id specified",
            title: "Please select your title",
            firstName: "Please enter your first name",
            lastName: "Please enter your surname",
            email: "Please enter a valid email address",
            confirm_email: "The emails entered do not match",
            phone_number: "Please enter your contact number",
            postcode: "Please enter a valid UK postcode",
            procedure_id: "Please select the treatment required",
            gdpr: "Please confirm you agree to our terms of use",
            hiddenRecaptcha: "Please check the captcha checkbox"
        },
        errorPlacement: function (error, element) {
            //console.dir(error, element);
            var customError =
                $(`<span class="invalid-feedback d-block">
                    <span class="mb-0 d-block">
                    </span>
                </span>`);

            // Add `form-error-message` class to the error element
            error.addClass("form-error-message");

            // Insert it inside the span that has `mb-0` class
            error.appendTo(customError.find("span.mb-0"));

            // Select the parent wrapper - either input-wrapper or select-wrapper
            var wrapper = element.parents("[class*='wrapper']");
            // Insert your custom error
            customError.insertBefore(wrapper).slideDown();
        },
        // Submit handler - what happens when form submitted
        submitHandler: function () {
            // Create an FormData object
            var data = new FormData($form[0]);

            // If you want to add an extra field for the FormData
            // data.append("CustomField", "This is some extra data, testing);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "/api/enquiry",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                headers: {
                    'Authorization': 'Bearer mBu7IB6nuxh8RVzJ61f4',
                },
                success: function (data) {
                    $('#hc_modal_enquire_private').modal('hide');
                    showAlert('Thank you ' + data.data[0].first_name + ', your enquiry has been successfully sent!', true, true);
                    handleFormReset();
                },
                error: function (e) {
                    var errorMsg = JSON.parse(e.responseText).errors.error;
                    showAlert(errorMsg, false, true);
                }
            });
        }
    })
}

// Send the form on click of the button
$('#btn_submit').on('click', function (e) {
    e.preventDefault();
    $(this)
        .parents('form')
        .submit();
});

// Dismiss bootstrap alert
$("[data-hide]").on("click", function () {
    $(this).closest("." + $(this).attr("data-hide")).slideUp();
});

