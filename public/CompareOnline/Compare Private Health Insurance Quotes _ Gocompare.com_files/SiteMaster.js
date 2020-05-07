// AsyncPostbackCounter - This semaphore counter counts how deep we are in an async postback.
// when its zero there is no current async postback in progress
var apc = 0;

// set if we have added an ASP.NET ajax postback complete handler 
var TryAddHandler = true;

var InPortal = false;
var HideHeaderFooter = false;
var HeaderPanelClientId;
var FooterPanelClientId;
var CompanyNoticeClientId;

var show_js_debug = false;

/*
    If the site is loaded within an iFrame e.g. from Portal
    we must call setWindow to pass a reference to the actual
    window and not the iframe window.
*/
var $mywindow;
function getWindow() {
    if ($mywindow == null) $mywindow = $(window);
    return $mywindow;
}
function setWindow(win) {
    $mywindow = win;
}

/* The following block supports the Live Advice popup */
var LiveAdviceTimer;    // the js id of the current timer (if any) which will be calling LiveAdviceTick() soon
var LiveAdvicePostback = false;     // set true when the client issues an async timer postback for the LiveAdvice control
var trig;           // the client ID of the hidden TimerEventTrigger button used to postback a timer tick event to the server
var prefix;
var NoMinimise;
var pwtype = 0;

// show or hide the 'please wait...' message in the top left of the screen
function PleaseWait(x) {
    if (x > 0) pwtype = x;
    var pw = document.getElementById(pwtype == 1 ? 'pleasewait' : 'pleasewait_popup');
    // for some reason we sometimes can't find the DIV so we have to test that it exists
    if (pw) pw.className = (x == 0 ? 'hide' : '');
    if (x == 2) reposition_grayoutpopup();
    // if (x == 0 && pwtype == 2) window.onscroll = null;
};

function CancelPleaseWait_Popup() {
    var x = window.location;
    window.location = x;
};

function reposition_grayoutpopup() {
    var el = document.getElementById('grayoutpopup_content');
    if (el != null) {
        var s;
        // scrolling offset calculation via www.quirksmode.org
        if (self.pageYOffset) {
            s = self.pageYOffset;
        } else if (document.documentElement && document.documentElement.scrollTop) {
            s = document.documentElement.scrollTop;
        } else if (document.body) {
            s = document.body.scrollTop;
        }
        var y = parseInt(s);
        el.style.top = y + 250 + "px";
    }
}

// This timeout is called to postback to the current page to update LiveAdvice.
// This can be to update a connected LiveAdvice session or to just pop-up the LiveAdvice box
// unconnected as a way to offer it to the user as an option
function LiveAdviceTick() {
    DebugWrite("LiveAdviceTick");
    
    // This detects whether we are in the middle of a FULL or ASYNC postback and delays the tick if so
    var InPostback = false;
    if (Sys.WebForms.PageRequestManager) {
        var prm = Sys.WebForms.PageRequestManager.getInstance();
        if (prm) {
            if (prm.get_isInAsyncPostBack()) InPostback = true;
        }
    }


    var ComparePopupsOpen = false;
    /* we removed this because we decided not to block the postback if other popups are present 
       ### TODO - we should block the postback if other popups are open if its just to popup an unconnected liveadvice box to offer live advice
    try {
    ComparePopupsOpen = AnyPopupsOpen();
    } catch (Error) { }
    */

    if (apc == 0 && !ComparePopupsOpen && !InPostback) {
        LiveAdviceTimer = null;
        StartAsyncAction(1);
        LiveAdvicePostback = true;
        __doPostBack(trig);
    } else {
        // can't postback for LiveAdvice now, so re-schedule for later
        LiveAdviceTimer = setTimeout('LiveAdviceTick();', 5000);
    }
};

// clear the LiveAdvice Timer if its running
function ClearLaTimer() {
    if (LiveAdviceTimer) { 
        clearTimeout(LiveAdviceTimer); 
        LiveAdviceTimer = null; 
    }
};

// the minimised LiveAdvice button has been clicked - validate this action
function LiveAdviceButton(connected) {
    if (apc > 0) return false;
    $get(prefix + 'la_max').style.display = '';    // immediately show the popup
    StartAsyncAction(1);
    LiveAdvicePostback = true;
    return true;
};

// the close button has been clicked in the top right of the maximised live advice popup - validate this action
function LaClose() {
    if (NoMinimise || apc > 0) return false;
    $get(prefix + 'la_max').style.display = 'none';    // immediately hide the popup
    StartAsyncAction(1);
    LiveAdvicePostback = true;
    return true;
};

// user has clicked the Cancel, minimise or finish on the Advisor popup
function LaClick() {
    if (apc > 0) return false;
    StartAsyncAction(1);
    LiveAdvicePostback = true;
    return true;
};

// user has clicked the "Call Me" Button on the Advisor popup
function LaCall() {
    var invalid = false;

    var pn = $get(prefix + 'PhoneNumber');
    if (pn.value.length < 10) {
        pn.style.borderColor = 'red';
        invalid = true;
    } else pn.style.borderColor = '';

    if (invalid) return false;

    if (apc > 0) return false;

    StartAsyncAction(1);
    LiveAdvicePostback = true;
    return true;
};

// when in an IFRAME in the portal, we strip the normal site header and footer
function StripHeaderFooter() {
    // we only strip headers and footers here if we are in a frame
    // for renderpdf we strip headers and footers server side
    if (parent != window) {
        var header = document.getElementById(HeaderPanelClientId);
        var footer = document.getElementById(FooterPanelClientId);
        var companynotice = document.getElementById(CompanyNoticeClientId);
        if (header) header.style.display = 'none';
        if (footer) footer.style.display = 'none';
        if (companynotice) companynotice.style.display = 'none';
        document.body.style.backgroundPosition = '0px -65px';
   };
};

// when in an IFRAME in the portal, we call this whenever the size of the site page changes so that the
// portal can adjust the IFRAME size
function PortalAdjust() {
    if (parent != window) {
        /* tell the portal js the height of our page */
        var h = parseInt(document.getElementById('outer').offsetHeight);
        try {
            parent.resizeFrame(h);
        } catch (er) { }
    }
};

// this function always called on first load of a page with LiveAdvicePopup control
function InitLiveAdvice() {
    // if the postback was in relation to the LiveAdvice popup
    // we must now decide whether to enable the timer for another liveadvice postback
    LiveAdvicePostback = false;
    var tmo = 0;
    try {
        tmo = parseInt($get(prefix + 'timeout').value);
    } catch (exc) { }
    ClearLaTimer();
    if (tmo > 0) LiveAdviceTimer = setTimeout('LiveAdviceTick();', tmo);
};

// This handler is called when the ASP.NET Ajax has completed its update (if we are on a page with ASP.NET ajax)
function AjaxOnEndRequest(sender, args) {
    AsyncActionComplete();

    if (LiveAdvicePostback) InitLiveAdvice();
    
    PortalAdjust();
};

// This is called whenever the client side JS complete any asynchronous changes such as panel animation
// Any such sequence must first have called StartAsyncAction() to preset APC with the number of complete calls
// that need to be made to complete the action.
function AsyncActionComplete() {
    if (apc > 0) apc -= 1;
    if (apc == 0) PleaseWait(0);
    DebugWrite('AsyncActionComplete apc=' + apc);
};

// Client side JS is about to post
function StartAsyncAction(count) {
    apc += count;
    PleaseWait(1);
    DebugWrite('StartAsyncAction apc=' + apc);
};

// Client side JS is about to post - this version shows modal popup that grays everything out
function StartAsyncAction2(count) {
    apc += count;
    PleaseWait(2);
    DebugWrite('StartAsyncAction2 apc=' + apc);
};


// This function is used to write debug information to the debug panel on the left of the screen
function DebugWrite(str) {
    if (show_js_debug) {
        var jdp = document.getElementById('jdp_inner');
        jdp.innerHTML = str + '<br>' + jdp.innerHTML;
    } 
};

// This is called on first page load and also on full page postback (not async postback)
function SiteMasterOnLoad() {

    if (TryAddHandler) {
        if (typeof (Sys) != 'undefined') {
            if (Sys.WebForms) {
                // this page has an ASP.NET Ajax ScriptManager
                // add our own handler for the completion of partial page updates
                var prm = Sys.WebForms.PageRequestManager.getInstance()
                if (prm) {
                    prm.add_endRequest(AjaxOnEndRequest);
                }
            }
        }
        TryAddHandler = false;
    }

    if (HideHeaderFooter) {
        StripHeaderFooter();
    }
    if (InPortal) {
        PortalAdjust();
    }
};

// this general function can be called as the onclick (onclientclick) event of image buttons which will
// redirect to a new page. Be careful when the page has client side validation
// because the button can get grayed even though the validation blocks the postback meaning that
// it remains gray on the page !
function gogray(me) {
    $(me).addClass('GrayButton');
    StartAsyncAction(1);
};

// GO - with BLOCK. This function is used to validate all link clicks and denies the action if we are currently waiting
// This should only be used on async postback links and buttons and not on others because if people click to open a
// link in a new window (by holding CTRL) then this would leave the first page locked out.
function gob() {
    if (apc > 0) return false;
    StartAsyncAction(1);
};
// GO - no BLOCK. This functio is used to inform JS that an action click has been made on the page.
// as opposed to GOB(), this version does not block the action if we are currently waiting for completion of a previous action
function go() {
    StartAsyncAction(1);
};

// we are leaving the site
function goleave(site) {
    ac('leave='+site);
    StartAsyncAction(1);
};




// See JS readme Note 1
function createAjaxObj() {
    var httprequest = false
    if (window.XMLHttpRequest) {
        httprequest = new XMLHttpRequest()
        if (httprequest.overrideMimeType)
            httprequest.overrideMimeType('text/xml')
        try {
            httprequest.withCredentials = true;
        } catch (e) { }
    }
    else if (window.ActiveXObject) {
        try {
            httprequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httprequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) { }
        }
    }
    return httprequest
}

var ajaxpack = new Object()
ajaxpack.basedomain = "http://" + window.location.hostname
ajaxpack.ajaxobj = createAjaxObj()
ajaxpack.filetype = "txt"
ajaxpack.addrandomnumber = 0

ajaxpack.getAjaxRequest = function(url, parameters, callbackfunc, filetype) {
    ajaxpack.ajaxobj = createAjaxObj()
    if (ajaxpack.addrandomnumber == 1)
        var parameters = parameters + "&ajaxcachebust=" + new Date().getTime()
    if (this.ajaxobj) {
        this.filetype = filetype
        this.ajaxobj.onreadystatechange = callbackfunc
        this.ajaxobj.open('GET', url + "?" + parameters, true)
        try { 
            this.ajaxobj.send(null); 
        } catch(ex) {};
    }
}

ajaxpack.postAjaxRequest = function(url, parameters, callbackfunc, filetype) {
    ajaxpack.ajaxobj = createAjaxObj()
    if (this.ajaxobj) {
        this.filetype = filetype
        this.ajaxobj.onreadystatechange = callbackfunc;
        this.ajaxobj.open('POST', url, true);
        this.ajaxobj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        this.ajaxobj.setRequestHeader("Content-length", parameters.length);
        this.ajaxobj.setRequestHeader("Connection", "close");
        this.ajaxobj.send(parameters);
    }
}


/* this function is called once the ajax control channel (ACC.aspx) access has returned */
function ac_done() {
    var myajax = ajaxpack.ajaxobj;
    var myfiletype = ajaxpack.filetype;
    if (myajax.readyState == 4) { //if request of file completed
        if (myajax.status == 200 || window.location.href.indexOf("http") == -1) {
            //if request was successful or running script locally
            PleaseWait(0);
            if (myfiletype == "txt")
                var x = myajax.responseText;
            else
                var x = myajax.responseXML;
        }
    }
};

/* send an Ajax Control Channel (ACC.aspx) message to the server */
function ac(params) {
    DebugWrite('ac(' + params + ')');
    PleaseWait(1);
    ajaxpack.getAjaxRequest("../../ACC.aspx", params, ac_done, "txt");
};



window.onbeforeunload = function() {
    DebugWrite('bye');
    //PleaseWait(1);
};


function showHoverMenu(id){
    hideHoverMenus();
    $('div#' + id).each(function () { $(this).removeClass('hidden'); });
};

function hideHoverMenus(){
    $('div.hover_nav').each(function () { $(this).addClass('hidden'); });
};

// expand the screen
var limit1 = -280;
var limit2 = -5;
var projtop = limit1;
var projstep = 0;
var scexpanding = true;
var FirstScreen = true;

function ExpandScreen() {
    var x = document.getElementById('projscreen');
    if (scexpanding && projtop < limit2) {
        // expanding
        projstep += (projtop < -150 ? 1 : -1);
        if (projstep < 1) projstep = 1;
        projtop += projstep;
        if (projtop > limit2) projtop = limit2;
        x.style.top = projtop + 'px';
        setTimeout('ExpandScreen();', 40);
    } else if (!scexpanding && projtop > limit1) {
        projstep += (projtop > -150 ? 1 : -1);
        if (projstep < 1) projstep = 1;
        projtop -= projstep;
        if (projtop < limit1) projtop = limit1;
        x.style.top = projtop + 'px';
        setTimeout('ExpandScreen();', 50);
    } else if ( projtop == limit2 ) {
        document.getElementById('screen-close-hint').style.display = 'block';
    }
};
function ChangeScreen(auto) {
    FirstScreen = false;
    if (apc > 0) {
        // busy
        if (auto) setTimeout('ChangeScreen();', 2000);
        return false;
    };
    if (projtop == limit2) {
        // collapse
        document.getElementById('screen-close-hint').style.display = 'none';
        scexpanding = false;
        ExpandScreen();
    } else if (projtop == limit1) {
        // expand
        scexpanding = true;
        ExpandScreen();
    }
};

function ajaxSliderChanged(slider) {
    try {
        var left = $(slider).children(0).position().left;
        var pos = left - 155;
        $(slider).css('backgroundPosition', pos + 'px 5px');
    } catch (e) { }
}

function changeTab(sender, tabname) {
    var $contentTabButtons = $('#content-tab-buttons');
    $('.tab-button', $contentTabButtons).each(function () { $(this).removeClass('tab-button-active'); });
    $(sender).addClass('tab-button-active');

    var $contentTabs = $('#content-tabs');
    $('.content-tab', $contentTabs).each(function () { $(this).hide(); });
    $('#' + tabname, $contentTabs).show();
}

function loadRecentDeals() { 
    //placeholder function
}

function signout() {
    __doPostBack('ctl00$ctl00$ButtonSignoutHidden');
}

function centerScreen(el) {
    el.css("position", "absolute");
    el.css('top', '0px');
    var top = getWindow().scrollTop() - el.offset().top;
    top = top + (getWindow().height() / 2) - (el.height() / 2);
    if (top < 50) top = 50;
    el.css('top',  top + 'px')
    el.css("left", "50%");
	el.css("margin-left", (-1 * (el.outerWidth() / 2)) + "px");
	//el.css("transform", "translateX(-50%)");
    return el;
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
    $('.question_error').removeClass('question_error');
};

function IsChecked(chk) {
    return $(chk).is(':checked');
}

// Function to convert short date string (MMddyy)
// or (MMddyyyy) to a date string (mm/dd/yyyy).
// txtBox is the actual textbox control
// with the value to be processed.
function FixShortDate(txtBox) {
    try {
        if (txtBox == null) {
            return false;
        }

        var oldVal = txtBox.value;
        var re = new RegExp(/(\d{6})(\d{2})?/);

        if (re.test(txtBox.value)) {
            if (txtBox.value.length == 8) {
                txtBox.value = txtBox.value.substring(0, 2) + '/' + txtBox.value.substring(2, 4) + '/' + txtBox.value.substring(4, 8)
            }
        }
        return oldVal != txtBox.value;
    } catch (e) {
        return false;
    }
}

function watermarkFocus(control, hasfocus, watermarktext) {
    if (hasfocus) {
        if (control.value == watermarktext) control.value = '';
    } else {
        if (control.value == '') {
            control.value = watermarktext;
        } else {
            control.value = (control.value == watermarktext) ? '' : control.value;
        }
    }
    if (control.value == watermarktext) {
        $(control).addClass('watermarkText');
    } else {
        $(control).removeClass('watermarkText');
    }
}

function SetWatermark(ctrl, watermarkText) {
    if ($(ctrl).val() == '') {
        $(ctrl).val(watermarkText);
        $(ctrl).addClass('watermarkText');
    }
    $(ctrl).focus(function () { watermarkFocus(this, true, watermarkText); });
    $(ctrl).blur(function () { watermarkFocus(this, false, watermarkText); });
}

function AutoDate() {
    /* Add Watermark text to input and auto-fix date slashes onkeyup */
    $('input.autodate').each(function () {
        if ($(this).val() == '') { $(this).val('DD/MM/YYYY'); $(this).addClass('watermarkText'); }
        $(this).focus(function () { watermarkFocus(this, true, 'DD/MM/YYYY'); });
        $(this).blur(function () { watermarkFocus(this, false, 'DD/MM/YYYY'); });
        $(this).keyup(function () {
            if ($(this).val().length > 7) {
                if (FixShortDate(this)) $(this).change();
            }
        });
    });
};

function ValidateSingleValidator(id) {
    var valCntl = document.getElementById(id);
    if (valCntl != undefined && valCntl != null) {
        ValidatorEnable(valCntl);
        return valCntl.isvalid;
    }
    return true;
};

function attributeIsSupported(type, attr) {
    var test = document.createElement(type);
    return (attr in test);
}

