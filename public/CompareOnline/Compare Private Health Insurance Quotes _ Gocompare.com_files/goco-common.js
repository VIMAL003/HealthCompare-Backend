/* 
    goco-common.js
    Gocompare.com / Common scripts
    ---
    Julien Decaudin @ Gocompare Web Team
    06/2015
*/

(function () {
    var gococom = gococom || {};

    //Globals
    gococom.debug = false;
    gococom.mobileBreakpoint = 640; //Mobile breakpoint width in pixels
    gococom.isMobile = false;

    //Main
    gococom.main = (function () {
        //init method
        var init = function () {
            gococom.layout.init();
            gococom.navigation.init();
            gococom.tooltips.init();
            gococom.modals.init();
            gococom.misc.init();
        };

        //Return public methods
        return {
            init: init
        };
    })();

    //Layout
    // -- Layout control
    gococom.layout = (function () {
        var init = function () {
            initBreakpoints();
            initFooter();
        };

        //init responsive breakpoints
        var initBreakpoints = function () {
            //check if mobile styles are used
            isMobile();

            $(window).resize(function () {
                isMobile();
            });
        };

        var isMobile = function () {
            if ($(document).width() <= gococom.mobileBreakpoint) {
                gococom.isMobile = true;
            } else {
                gococom.isMobile = false;
            }
            //console.log(gococom.isMobile);
        };

        //track responsive status for current interacted element (styleguide simulated responsive styles only)
        var isMobileSimulated = (function ($el) {
            if ($el.parents('.mobile').length > 0) {
                return true;
            } else {
                return false;
            }
        });

        //control responsive sticky footer
        var initFooter = function () {
            var heightAdjustment = 0;
            var bodyBottomMarginAdjustment = 12;

            //match the body bottom margin to the footer height
            $substantation = $('footer .substantation');
            var bodyBottomMargin = $('footer').outerHeight();

            if ($substantation.length > 0) {
                bodyBottomMargin = bodyBottomMargin + $substantation.outerHeight() - bodyBottomMarginAdjustment;
            }

            $('body').css('margin-bottom', bodyBottomMargin + 'px');
            $substantation.css('bottom', $('footer').outerHeight() - heightAdjustment + 'px');

            $(window).resize(function () {
                var bodyBottomMargin = $('footer').outerHeight();

                if ($substantation.length > 0) {
                    bodyBottomMargin = bodyBottomMargin + $substantation.outerHeight();
                }

                $('body').css('margin-bottom', bodyBottomMargin + 'px');
                $substantation.css('bottom', $('footer').outerHeight() - heightAdjustment + 'px');
            });
        };

        //Return public methods
        return {
            init: init,
            isMobileSimulated: isMobileSimulated
        };
    })();

    //Navigation
    // -- Navigation elements interactions
    gococom.navigation = (function () {

        var init = function () {
            initMainNav();
            initTabNav();

            if ($('body').hasClass('quote') || $('.sg-content-container').hasClass('quote')) {
                //burger link opens toolbar on mobile
                initToolbarMobile();
            } else {
                //burger link opens main nav on mobile
                initMainNavMobile();
            }
        };

        //main navigation interactions
        var initMainNav = function () {
            $stickyItem = $('nav.main li.sticky');

            $('nav.main li.sticky > a').click(function (e) {
                e.preventDefault();
                $(this).parent().toggleClass('active');

                //search box focus
                if ($(this).parent().hasClass('search')) {
                    $form = $(this).parent().find('form');
                    $textInput = $(this).parent().find('.input-text');
                    $textInput.focus();
                }
            });

            //close opened sticky dropdown when opening another dropdown
            $('nav.main > ul > li > a').hover(function () {
                if (!$(this).parent().hasClass('sticky') && $stickyItem.hasClass('active')) {
                    $stickyItem.removeClass('active');
                }
            }, function () {

            });

            //close opened sticky dropdown when clicking outside
            $(document).click(function (e) {
                $dropdown = $stickyItem.find('.dropdown');
                $stickyItemLink = $stickyItem.find('> a');

                if (!$dropdown.is(e.target) && $dropdown.has(e.target).length === 0 && !$stickyItemLink.is(e.target) && $stickyItemLink.has(e.target).length === 0) {
                    if ($stickyItem.hasClass('active')) {
                        $stickyItem.removeClass('active');
                    }
                }
            });

            //init extra menu for small tablet screen size
            var $extraLi = $('nav.main > ul').find('> li:eq(5), > li:eq(6), > li:eq(7)');
            var $extraLiContainer = $('nav.main > ul > li.extra-menu .dropdown').prepend('<ul></ul>');

            $extraLi.each(function (index) {
                $(this).addClass('extra');

                if ($(this).hasClass('coveredmag')) {
                    $extraLiContainer.find('ul').append('<li class="coveredmag"></li>');
                } else {
                    $extraLiContainer.find('ul').append('<li></li>');
                }

                $(this).find('> a').clone().appendTo($extraLiContainer.find('ul li:last-child'));
            });
        };

        //mobile main nav open/close
        var initMainNavMobile = function () {
            var openSpeed = 250;
            var openEasing = "easeOutCubic";

            $('a.nav-switch').click(function (e) {
                e.preventDefault();
                $nav = $('nav.main');

                $(this).toggleClass('open');

                if ($nav.is(':hidden')) {
                    $nav.fadeIn(openSpeed);
                } else {
                    $nav.fadeOut(openSpeed, function () {
                        $nav.attr('style', '');
                    });
                }
            });
        };

        //mobile toolbar open/close (quote only)
        var initToolbarMobile = function () {
            var openSpeed = 400;
            var openEasing = "easeOutCubic";

            $('a.nav-switch').click(function (e) {
                e.preventDefault();
                $(this).toggleClass('open');

                $(this).parent().find('.header-toolbar').slideToggle(openSpeed, openEasing, function () {
                    $(this).toggleClass('open');
                    $(this).attr('style', '');
                });
            });
        };

        //tabs navigation (TODO: move most of it to Quote but keep sg only mobile scripts)
        var initTabNav = function () {
            var openTabSpeed = 450;
            var closeTabSpeed = 450;
            var tabEasing = "easeOutQuart";

            //tabs focus and click handlers
            $('.tabs-nav li a')
                .on('mousedown', function () {
                    $(this).parent().prev().addClass('mousedown');
                })
                .bind('mouseup mouseout blur', function () {
                    $(this).parent().prev().removeClass('mousedown');
                })
                .click(function (e) {
                    $link = $(this);
                    $tabsNav = $(this).parents('.tabs-nav');
                    $li = $(this).parents('li');
                    $mobileTab = $tabsNav.find('a.mobile-tab');
                    var isWidget = false;

                    if ($tabsNav.hasClass('no-script')) {
                        return;
                    }

                    e.preventDefault();

                    if ($tabsNav.hasClass('widget')) {
                        isWidget = true;
                    }

                    //mobile only: update label and close tabs
                    if ($mobileTab.length > 0) {
                        $mobileTab.text($(this).text());
                        $tabsNav.toggleClass('open');
                    }

                    //update selected tab
                    if (!$li.hasClass('selected')) {
                        //slide tabs (widget & mobile only)
                        if (isWidget && (gococom.isMobile || gococom.layout.isMobileSimulated($(this)))) {

                            $tabsNav.find('li.selected, li.default').removeClass('selected default').find('.checkbox-list').slideUp(closeTabSpeed, tabEasing);

                            $li.addClass('selected').find('.checkbox-list').slideDown(openTabSpeed, tabEasing, function () {
                                $link.scrollIntoView();
                            });

                        } else {
                            $tabsNav.find('li.selected, li.default').removeClass('selected default').find('ul').attr('style', '');

                            $li.addClass('selected');
                            $li.find('ul').css('display', 'block');
                        }
                    } else {
                        //allow tab to be unselected (widget & mobile only)
                        if (isWidget && (gococom.isMobile || gococom.layout.isMobileSimulated($(this)))) {
                            $li.find('.checkbox-list').slideUp(closeTabSpeed, tabEasing, function () {
                                $li.removeClass('selected default');
                            });
                        } else {
                            $li.find('ul').attr('style', '');
                        }
                    }
                });

            //mobile only: tabs open/close
            $('.tabs-nav a.mobile-tab').click(function (e) {
                e.preventDefault();
                $(this).parent().toggleClass('open');
            });
        };

        //Return public methods
        return {
            init: init
        };
    })();

    //Tooltips
    // -- Tooltips interactions
    gococom.tooltips = (function () {
        var init = function () {
            initTooltips();
            initHelpTooltips();
            initInfoTooltips();
        };

        //global tooltip interactions
        var initTooltips = function () {
            //close opened info tooltips when clicking outside
            $(document).click(function (e) {
                $tooltip = $('.tooltip:visible');
                $tooltipButton = $('.mobile-tooltip-button, .tooltip-button, .tooltip-link');

                if (!$tooltip.is(e.target) && $tooltip.has(e.target).length === 0 && !$tooltipButton.is(e.target) && $tooltipButton.has(e.target).length === 0) {
                    if ($tooltip.hasClass('help')) {
                        closeHelpTooltip($tooltip);
                    } else {
                        $tooltip.hide();
                    }
                }
            });
        };

        //help tooltip interactions
        var initHelpTooltips = function () {
            //opening            
            //$('.question .tooltip-link').click(function (e) {
            $('form').on('click', '.question .tooltip-link', function (e) {
                e.preventDefault();
                $tooltip = $(this).parent().find('.tooltip.help');

                //if kickstarter question
                if ($(this).parent().hasClass('ks')) {
                    $tooltip = $(this).parents('form').find('.tooltip.help');
                }

                //close any other opened tooltip
                $('.tooltip.help.opened').each(function (index) {
                    closeHelpTooltip($(this));
                });

                //open tooltip
                $tooltip.removeClass('closed').addClass('opened');

                //hide tooltip link
                $(this).addClass('hide');
            });

            //closing
            $('.tooltip.help .close').click(function (e) {
                e.preventDefault();
                closeHelpTooltip($(this).parent());
            });
        };

        //close help tooltip (mobile)
        var closeHelpTooltip = function ($t) {
            $tooltipLink = $t.find('+ .tooltip-link')

            //if kickstarter tooltip
            if ($t.hasClass('ks')) {
                $tooltipLink = $('.question.ks .tooltip-link');
            }

            //hide tooltip
            $t.removeClass('opened').addClass('closed');

            //show tooltip link
            $tooltipLink.removeClass('hide');
        };

        //info tooltip interactions
        var initInfoTooltips = function () {
            //show on hover (desktop)          
            $('.tooltip-button').hover(function () {
                $tooltip = $(this).parents('.tooltip-container').find('.tooltip.info');
                if ($(this).hasClass('tooltip-container')) {
                    $tooltip = $(this).find('.tooltip.info');
                }
                $tooltip.show();

            }, function () {
                $tooltip = $(this).parents('.tooltip-container').find('.tooltip.info');
                if ($(this).hasClass('tooltip-container')) {
                    $tooltip = $(this).find('.tooltip.info');
                }
                $tooltip.hide();
            });

            $('a.tooltip-button').click(function (e) {
                e.preventDefault();
            });

            //show on click (button)
            $('.mobile-tooltip-button').click(function (e) {
                e.preventDefault();
                $tooltip = $(this).parents('.tooltip-container').find('.tooltip.info');

                if ($tooltip.is(':visible')) {
                    $tooltip.hide();
                } else {
                    //close any other opened tooltip
                    $('.tooltip.info:visible').hide();
                    $tooltip.show();
                }
            });

            //closing
            $('.tooltip.info .close').click(function (e) {
                e.preventDefault();
                $(this).parent().hide();
            });
        };

        //Return public methods
        return {
            init: init
        };
    })();

    //Modals    
    // -- Modals interactions
    gococom.modals = (function () {
        var init = function () {

            //modal close button
            $('.modal .close, .modal .button.cancel').on('click', function (e) {
                e.preventDefault();
                $modal = $(this).parents('.modal');

                closeModal($modal);
            });

            //close opened modal when clicking outside                        
            $('.modal-container').click(function (e) {
                $openModal = $(this).find('.modal.show');

                if (($openModal.length > 0 && !$openModal.hasClass('opening')) && !$openModal.is(e.target) && $openModal.has(e.target).length === 0) {
                    closeModal($openModal);
                }
            });
        };

        //open modal
        var openModal = function ($modal) {
            var speed = 500;
            var shift = 8;
            var easing = "easeOutExpo";

            $overlay = $modal.parents('.modal-container').find('.modal-overlay');

            var modalTop = $modal.css('top');

            $modal.css('top', parseInt(modalTop) + shift + 'px');
            $modal.addClass('opening');
            $modal.addClass('show').css('opacity', 0);

            //if sticky modal scroll page to the top
            if ($modal.hasClass('sticky')) {
                $(window).scrollTo({ top: 0, left: 0 }, speed);
            }

            $modal.animate({
                top: modalTop,
                opacity: 1
            }, speed, easing, function () {
                $modal.attr('style', '');
            });

            $overlay.css('display', 'block').animate({
                opacity: 1
            }, speed, easing, function () {
                $(this).addClass('show');
                $modal.removeClass('opening');
                $modal.attr('style', '');
            });
        };

        //close modal
        var closeModal = function ($modal) {
            var speed = 250;
            var easing = "easeOutExpo";

            $overlay = $modal.parents('.modal-container').find('.modal-overlay');

            $modal.animate({
                opacity: 0
            }, speed, easing, function () {
                $modal.removeClass('show').attr('style', '');
            });

            $overlay.removeAttr('style').removeClass('show');
        };

        //Return public methods
        return {
            init: init,
            openModal: openModal,
            closeModal: closeModal
        };
    })();

    //Misc    
    // -- Various interactions
    gococom.misc = (function () {
        var init = function () {
            initButtons();
            initCookieBanner();
            initCollapsible();
        };

        //init buttons
        var initButtons = function () {
            //deactivate click on disabled buttons
            $('.button.disabled, .small-button.disabled').on('click', function (e) {
                e.preventDefault();
            });

            //modal trigger
            //$('.button.open-modal, .small-button.open-modal').on('click', function (e) {
            $('.button.open-modal, .small-button.open-modal, a.open-modal').on('click', function (e) {
                e.preventDefault();
                $modal = $('#' + $(this).attr('data-modal'));
                gococom.modals.openModal($modal);
            });

            //Read more expand module button
            $('.button.readmore', '.readmore-holder').on('click', function (e) {
                e.preventDefault();
                $module = $(this).parents('.module');
                $module.addClass('open');
                $(this).parent().removeClass('mobile-only').hide();
            });
        };

        //init cookie policy banner
        var initCookieBanner = function () {
            //close banner when clicking the agree button
            $('.cookie-policy-banner a.confirm').on('click', function (e) {
                e.preventDefault();
                $('.cookie-policy-banner').addClass('hide');
            });
        };

        //init collapsibles
        var initCollapsible = function () {

            var openItemSpeed = 450;
            var closeItemSpeed = 450;
            var itemEasing = "easeOutQuart";


            $(".collapsible-item > a").click(function (e) {
                $collapsible = $(this).parents('.collapsible-holder');
                $item = $(this).parent();

                e.preventDefault();

                if (!$item.hasClass('opened')) {
                    //open item            
                    //$collapsible.find('.collapsible-item.opened').removeClass('opened').find('.collapsible-content').slideUp(closeItemSpeed, itemEasing);
                    $item.addClass('opening').find('.collapsible-content').slideDown(openItemSpeed, itemEasing, function () {
                        $item.removeClass('opening').addClass('opened');
                    });

                } else {
                    //close accordion
                    $item.addClass('closing').find('.collapsible-content').slideUp(closeItemSpeed, itemEasing, function () {
                        $item.removeClass('closing').removeClass('opened');
                    });
                }

            });
        };

        //Return public methods
        return {
            init: init
        };
    })();

    //Utils        
    gococom.utils = (function () {
        var init = function () {

        };

        //Return public methods
        return {
            init: init
        };
    })();

    //Start
    $(function () {
        //Init 
        gococom.main.init();
    });

})();