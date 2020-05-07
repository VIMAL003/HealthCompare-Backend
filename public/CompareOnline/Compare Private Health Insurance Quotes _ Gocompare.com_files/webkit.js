// Create the new Sys.Browser.WebKit 'type'
try {
    if (typeof (Sys.Browser.WebKit) == 'undefined') { Sys.Browser.WebKit = {}; }

    // Test the userAgent string to see if we're working with Safari 3
    if (navigator.userAgent.indexOf('WebKit/') > -1) {
        Sys.Browser.agent = Sys.Browser.WebKit;
        Sys.Browser.version = parseFloat(navigator.userAgent.match(/WebKit\/(\d+(\.\d+)?)/)[1]);
        Sys.Browser.name = 'WebKit';
    }
}
catch (e) {
}