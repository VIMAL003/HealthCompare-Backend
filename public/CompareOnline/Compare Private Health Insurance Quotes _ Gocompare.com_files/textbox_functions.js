function upperCase(x) {
    try {
        var y = document.getElementById(x).value;
        document.getElementById(x).value = y.toUpperCase();
        return true;
    } catch (e) { }
};

function stripSpaces(x) {
    try {
        var y = document.getElementById(x).value;
        document.getElementById(x).value = y.replace(/ /g, '');
        return true;
    } catch (e) { }
};

function lowerCase(x) {
    try {
        var y = document.getElementById(x).value;
        document.getElementById(x).value = y.toLowerCase();
        return true;
    } catch (e) { }

};

function titleCase(x) {
    var y = document.getElementById(x).value;
    if (y.length == 0) return true;
    document.getElementById(x).value = y.toLowerCase().replace(/^(.)|\s(.)/g, function ($1) { return $1.toUpperCase(); });
    return true;
};


function numbersOnly(x) {
    try {
        var y = document.getElementById(x).value;
        if (y.length == 0) return true;
        document.getElementById(x).value = y.replace(/[^0-9 \.]+/g, '');
        return true;
    } catch (e) { }
};

function stripBadChars(x) {
    try {
        var y = document.getElementById(x).value;
        document.getElementById(x).value = y.replace(/[^a-zA-Z 0-9 \- \.]+/g, '');
        return true;
    } catch (e) { }
};

function capLength(x,m) {
    try {
        var y = document.getElementById(x);
        var max = parseInt(m);

        if (y.value.length > max) {
            y.value = y.value.substring(0, max);
        }
 
    } catch (e) { }
};