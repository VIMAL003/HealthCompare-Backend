
//questions focus
function initQuestions() {
    $('.question')
        .on('mouseenter focusin', function () {
            setQuestionFocus($(this), true);
        })
        .on('mouseleave blur', function () {
            setQuestionFocus($(this), false);
        });

    $('label.question-label', '.question')
        .on('focusout', function () {
            $(this).parent().find('.answer-radio-list li input:checked, .yesno-radio-list input:checked, .number-picker-list input:checked, .checkbox input:checked').focus();
        });
};

//set question focus
var setQuestionFocus = function ($q, focus) {
    var $questionNext;

    if (focus) {
        //focus in
        $('.question.active').removeClass('active');
        $q.addClass('active');
        $('.question.question-next').removeClass('question-next');

        if ($q.next().hasClass('question-extended') && !$q.next().hasClass('open')) {
            //pick next visible question
            $questionNext = $q.next().next();
        } else {
            //pick next question
            $questionNext = $q.next();
        }
        $questionNext.addClass('question-next');
    } else {
        //focus out
        $q.removeClass('active');

        if ($q.next().hasClass('question-extended') && !$q.next().hasClass('open')) {
            //pick next visible question
            $questionNext = $q.next().next();
        } else {
            //pick next question
            $questionNext = $q.next();
        }
        $questionNext.removeClass('question-next');

        $('.question.question-next').removeClass('question-next');
    }
};



//Calendar controls
function initCalendar() {

    if ($('.input-date input').length > 0) {
        $.each($('.input-date input'), function (key, val) {
            if (gocoquote.main.isMobile()) {
                //mobile 
                $(val).datepicker({
                    onSelect: function (date) {
                        $(this).closest('.question').find('input[name=answer-date-radio]').prop('checked', false);
                        $(this).closest('.input-date-holder').find('li').removeClass('checked');
                        $(this).change();
                    },
                    dateFormat: "dd/mm/yy",
                    numberOfMonths: [1, 1],
                    maxDate: "+29d",
                    minDate: "0d",
                    dayNamesMin: ["S", "M", "T", "W", "T", "F", "S"],
                    showButtonPanel: false,
                    showAnim: ""
                });
            } else {
                //desktop
                $(val).datepicker({
                    onSelect: function (date) {
                        $(this).closest('.question').find('input[name=answer-date-radio]').prop('checked', false);
                        $(this).closest('.input-date-holder').find('li').removeClass('checked');
                        $(this).change();
                    },
                    dateFormat: "dd/mm/yy",
                    numberOfMonths: [1, 2],
                    maxDate: "+29d",
                    minDate: "0d",
                    dayNamesMin: ["S", "M", "T", "W", "T", "F", "S"],
                    showButtonPanel: true,
                    showAnim: ""
                });
            }

            $(val).parent().find('a').on('click', function (e) {
                e.preventDefault();
                $(val).datepicker('show');
            });

        });
        $('.startdate').datepicker('option', 'maxDate', '+3m');
    }

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
};

function initTooltipClose() {
    //closing
    $('.tooltip.help .close').click(function (e) {
        $t = $(this).parent();

        $tooltipLink = $t.find('+ .tooltip-link')

        //if kickstarter tooltip
        if ($t.hasClass('ks')) {
            $tooltipLink = $('.question.ks .tooltip-link');
        }

        //hide tooltip
        $t.removeClass('opened').addClass('closed');

        //show tooltip link
        $tooltipLink.removeClass('hide');
        e.preventDefault();
        e.stopPropagation();
    });
};

