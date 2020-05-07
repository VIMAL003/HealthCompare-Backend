
var SetCalendarDate = function (source) {
    var inputField = $(source).closest('.input-date-holder').find('.input-date input');
    var field = $(source).hasClass("today") ? "todays-date" : "tomorrows-date";
    var data = $(source).data(field);
    $(inputField).val(data);
    
    commonExt.unobstrusiveVal.validateQ($(inputField));
};

$('.input-date-holder .answer-radio-list label').on('click', function () {
    $('.input-date-holder .answer-radio-list li').removeClass('checked');
    var radioDate = $(this).siblings().data('date');
    $(this).closest('.input-date-holder').children('.input-date').children('.input-text').val(radioDate);

    if ($('.input-date .input-text').val() == radioDate) {
        $(this).parent().addClass('checked');
    };
    ValidatorValidate(Page_Validators[0]);
});

$(document).ready(function () {
    $('.startdate').datepicker('option', 'maxDate', '+3m');
});