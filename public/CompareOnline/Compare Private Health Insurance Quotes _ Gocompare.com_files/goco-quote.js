/* 
    goco-quote.js
    Gocompare.com / Quote scripts
    ---
    Julien Decaudin @ Gocompare Web Team
    06/2015
*/
    var gocoquote = gocoquote || {};

    //Globals
    gocoquote.debug = false;
    gocoquote.mobileBreakpoint = 640;

    //Main
    gocoquote.main = (function () {
        //init method
        var init = function () {            
            gocoquote.forms.init();
            gocoquote.results.init();
        };

        //track responsive status for current interacted element
        var isMobile = (function () {
            if ($(window).width() <= gocoquote.mobileBreakpoint ) {
                return true;
            } else {
                return false;
            }
        });

        //Return public methods
        return {
            init: init,
            isMobile: isMobile
        };
    })();

    //Forms    
    // -- Form elements interactions and rendering
    gocoquote.forms = (function () {
        var init = function () {
            initDropdowns();
            initRadioChecks();
            initSortTabs();
            initQuestions();
            initVehicleModWidget();
            initCalendar();
        };

        //dropdown replacement            
        var initDropdowns = function () {
            //standard dropdown
            if ($('select.select-standard').length > 0) {
                $('select.select-standard').selectBox({
                    mobile: true
                })
                .bind('change', function () {
                    //update question status
                    $question = $(this).parents('.question')
                    if ($question.length > 0) {
                        var val = $(this).find(':selected').val();
                        if (val != 0 && !$question.hasClass('complete')) {
                            $question.removeClass('error');
                            //$question.addClass('complete');
                        } else if (val == 0 && $question.hasClass('complete')) {
                            $question.removeClass('complete');
                            $question.addClass('error');
                        }
                    }

                    //reveal extended question (if any)
                    if ($question.attr('data-question-extended') != '') {
                        $questionExtended = $('#' + $question.attr('data-question-extended'));
                        if (!$questionExtended.hasClass('open')) {
                            $questionExtended.addClass('open');
                        }                        
                    }
                });
            }

            //sort tab dropdown
            if ($('select.select-sort-tab').length > 0) {
                $('select.select-sort-tab').selectBox({
                    mobile: true,
                    keepInViewport: false,
                    bottomPositionCorrelation: -7
                })
                .bind('change', function () {
                    var val = $(this).find(':selected').text();
                    $(this).parent().find('.summary-text').text(val);
                })
                .bind('close', function () {
                    $(this).parent().removeClass('focus');
                });
            }
        };

        //radio buttons & checkbox replacement
        var initRadioChecks = function () {
            $('.answer-radio-list li input, .yesno-radio-list input, .number-picker-list input, .checkbox input')
                .on('focusin', function () {
                    $(this).parent().addClass('focus');
                })
                .on('focusout', function () {
                    $(this).parent().removeClass('focus');
                })
                .on('click', function () {
                    if( $(this).is(':radio') ){
                        $(this).parents('ul').find('li').removeClass('checked');
                    }

                    if ($(this).is(':checked')) {
                        $(this).parent().addClass('checked');
                    } else {
                        $(this).parent().removeClass('checked');
                    }                    
                });

            $('.number-picker-list input')
                .change(function () {
                    $(this).parents('.number-picker-list').find('.active').removeClass('active');
                    if ($(this).val() != '') {
                        $(this).parent().addClass('active');
                    }
                });

            $('.number-picker-list label')
                .on('mousedown', function () {
                    $(this).parent().addClass('mousedown');
                })
                .bind('mouseup mouseout blur', function () {
                    $(this).parent().removeClass('mousedown');
                });
        };

        //sort tabs event handlers
        var initSortTabs = function () {
            $('.sort-tab-list li')
                .on('focusin', function () {
                    $(this).addClass('focus');
                })
                .on('focusout', function () {
                    $(this).removeClass('focus');
                });

            $('.sort-tab-list a.tab')
                .on('mousedown', function () {
                    $(this).parent().addClass('mousedown');
                })
                .bind('mouseup mouseout blur', function () {
                    $(this).parent().removeClass('mousedown');
                });

            //sort tab dropdown
            $('.sort-tab-list a.tab').click(function (e) {
                e.preventDefault();

                var tabId = $(this).attr('id');
                $selectBox = $(this).parent().find('select[data-trigger=' + tabId + ']');

                if (!$(this).hasClass('current')) {
                    //remove active/current state on other tabs
                    $(this).parents('.sort-tab-list').find('.active').removeClass('active');
                    $(this).parents('.sort-tab-list').find('a.tab[id!=' + tabId + ']').removeClass('current');

                    //set active/current state
                    $(this).addClass('current');
                    $(this).parent().addClass('active');
                }

                //open selectbox
                if ($selectBox.length > 0) {
                    //$(this).blur();

                    $selectBox.selectBox('instance').showMenu();

                    //set focus 
                    setTimeout(function () {
                        $selectBox.selectBox('control').focus();
                    }, 0);

                    /*  
                    $input = $(this);                                      
                    setTimeout(function () {
                    $input.parent().addClass('focus');
                    }, 1);
                    */
                }
            });
        };

        //questions focus
        var initQuestions = function () {
            $('.question')
                .on('mouseenter focusin', function () {
                    setQuestionFocus($(this), true);
                })
                .on('mouseleave blur', function () {
                    setQuestionFocus($(this), false);
                });

            $('label.question-label', '.question')
				.on('click', function () {
				    $(this).parent().find('.answer-radio-list li input:checked, .yesno-radio-list input:checked, .number-picker-list input:checked, .checkbox input:checked').focus();
				});

            $('.answer-radio-list li input, .yesno-radio-list input, .number-picker-list input, .checkbox input', '.question').on('click', function () {
                $question = $(this).parents('.question');
                if (!$question.hasClass('complete')) {
                    $question.addClass('complete');
                }
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

        //vehicle modifications widget
        var initVehicleModWidget = function () {
            $('.checkbox input', '.vehicle-mod-widget').click(function () {
                $checkboxList = $(this).parents('.checkbox-list');
                $li = $checkboxList.parent();
                $tag = $checkboxList.prev().find('.tag');
                $count = $checkboxList.find('input:checked').length;

                //update tag count and tab active status
                $tag.text($count);

                if ($count > 0) {
                    if (!$li.hasClass('active')) {
                        $li.addClass('active');
                    }
                } else {
                    $li.removeClass('active');
                }
            });
        };

        //vehicle modifications widget sticky header
        var stickyTitles = function ($stickies) {

            this.load = function () {
                $stickies.each(function () {
                    var thisSticky = $(this).wrap('<div class="followWrap" />');
                    //var thisSticky = $(this);
                    thisSticky.parent().height(thisSticky.outerHeight());
                    $.data(thisSticky[0], 'pos', thisSticky.position().top);
                    $.data(thisSticky[0], 'sublist', thisSticky.parents('li').find('ul.checkbox-list'));
                });
            }

            this.scroll = function () {
                //$('.vehicle-mod-widget .listing .top-holder', '.mobile').css('top', $('.vehicle-mod-widget .listing', '.mobile').scrollTop());

                $stickies.each(function (i) {
                    var thisSticky = $(this),
                        nextSticky = $stickies.eq(i + 1),
                        prevSticky = $stickies.eq(i - 1),
                        pos = $.data(thisSticky[0], 'pos'),
                        sublist = $.data(thisSticky[0], 'sublist'),
                        isSelected = $(this).parents('li').hasClass('selected'),
                        isOpening = $(this).parents('li').hasClass('opening');

                    if (!isOpening && isSelected && pos <= $('.vehicle-mod-widget .listing', '.mobile').scrollTop()) {
                        thisSticky.addClass('fixed');

                        /*
                        console.log('pos: ' + pos);
                        console.log('sublist: ' + sublist.outerHeight());
                        console.log('scrollTop: ' + $('.vehicle-mod-widget .listing', '.mobile').scrollTop());
                        console.log('*****************************');
                        console.log('thisSticky top: ' + thisSticky.position().top);
                        console.log('nextSticky top: ' + nextSticky.position().top);
                        console.log('thisSticky height: ' + thisSticky.outerHeight());
                        console.log('');
                        */

                        if (nextSticky.length > 0 && thisSticky.outerHeight() >= nextSticky.position().top) {
                            thisSticky.addClass('absolute').css('top', sublist.outerHeight());
                        } else {
                            thisSticky.removeClass('absolute').removeAttr('style');
                        }

                    } else {
                        thisSticky.removeClass('fixed').removeClass('absolute').removeAttr('style');
                        if (prevSticky.length > 0 && $('.vehicle-mod-widget .listing', '.mobile').scrollTop() <= $.data(thisSticky[0], 'pos') - prevSticky.outerHeight()) {
                            //prevSticky.removeClass('absolute').removeAttr('style');
                        }
                    }
                });
            }
        }

        //init calendar
        var initCalendar = function ($q, focus) {
            if ($('.input-date input').length > 0) {
                $.each($('.input-date input'), function (key, val) {
                    if (gocoquote.main.isMobile()) {
                        //mobile 
                        $(val).datepicker({
                            onSelect: function (date) {
                                $(this).closest('.question').find('input[name=answer-date-radio]').prop('checked', false);
                                $(this).closest('.input-date-holder').find('li').removeClass('checked')
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
                                $(this).closest('.input-date-holder').find('li').removeClass('checked')
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
            }
        };

        //Return public methods
        return {
            init: init
        };
    })();

    //Results    
    // -- Results interactions
    gocoquote.results = (function () {
        var init = function () {
            //Results More info panel
            $('.result .button.result-more').click(function (e) {
                e.preventDefault();
                if (!$(this).hasClass('disabled')) {
                    $result = $(this).parents('.result');
                    $result.toggleClass('more-open');                    
                }
            });
        };       

        //Return public methods
        return {
            init: init
        };
    })();    

    //Start
    $(function () {
        //Init 
        gocoquote.main.init();
    });
