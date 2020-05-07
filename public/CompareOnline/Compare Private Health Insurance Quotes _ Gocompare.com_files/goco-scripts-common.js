var GC, GCModal,  GCHeader, GCCar;

GC = GC || function () {
    function s() {
        //(function (n) {
        //    n.each(["show", "hide"], function (t, i) {
        //        var r = n.fn[i];
        //        n.fn[i] = function () {
        //            this.trigger(i);
        //            r.apply(this, arguments)
        //        }
        //    })
        //})(jQuery);
        //h()
    }
    function h() {
        window.addEventListener && window.addEventListener("DOMContentLoaded", function () {
            document.documentElement.clientWidth >= 768 && (viewport = document.querySelector("meta[name=viewport]"),
            viewport.setAttribute("content", "width=1024"))
        }, !1)
    }
    function c() {
        $("body").on("click", "a.back-to-top", function () {
            return i(),
            $("#modalBackground").focus(),
            !1
        })
    }
    function l() {
        $substantation = $("footer .substantation");
        var n = $("footer").outerHeight();
        $substantation.length > 0 && (n = n + $substantation.outerHeight());
        $("body").css("margin-bottom", n + "px");
        $substantation.css("bottom", $("footer").outerHeight() - 7 + "px");
        $(window).resize(function () {
            var n = $("footer").outerHeight();
            $substantation.length > 0 && (n = n + $substantation.outerHeight());
            $("body").css("margin-bottom", n + "px");
            $substantation.css("bottom", $("footer").outerHeight() - 7 + "px")
        })
    }
    function a() {
        $(".continue-button").on("click", function (n) {
            n.preventDefault();
            $("#form0").submit()
        })
    }
    function v(n) {
        return n.replace(/\w\S*/g, function (n) {
            return n.charAt(0).toUpperCase() + n.substr(1).toLowerCase()
        })
    }
    function y(n) {
        var i = n.value, r, t;
        i = i.replace(/^\s+|\s+$/g, "");
        r = i.split("'");
        t = "";
        $.each(r, function (n, i) {
            t += v(i) + "'"
        });
        n.value = t.substr(0, t.length - 1)
    }
    function p(n) {
        n === undefined && (n = {});
        var i = t();
        return n.__RequestVerificationToken = i,
        n.__RequestVerificationToken === undefined && (n += "&__RequestVerificationToken=" + i),
        n
    }
    function t() {
        return $("#form0 input[name=__RequestVerificationToken]").val()
    }
    function w(n) {
        return n === "True"
    }
    function b(n) {
        var u = parseInt(.5 * screen.height)
          , f = parseInt(.8 * screen.height)
          , e = screen.width - 460
          , o = screen.height - 220
          , t = Math.min(1e3, Math.max(700, e))
          , i = Math.min(f, Math.max(u, o))
          , c = window.screenLeft != undefined ? window.screenLeft : screen.left
          , l = window.screenTop != undefined ? window.screenTop : screen.top
          , s = screen.width / 2 - t / 2
          , h = screen.height / 2 - i / 2
          , r = window.open(n, null, "location=0,menubar=0,resizable=1,scrollbars=1,titlebar=1,toolbar=0,copyhistory=no,width=" + (t - 10) + ", height=" + (i - 65) + ", top=" + h + ", left=" + s);
        setTimeout(function () {
            try {
                r.blur();
                r.focus()
            } catch (n) { }
        }, 100)
    }
    function i() {
        n(0, 800)
    }
    function n(n, t, i) {
        $(i || "body,html").animate({
            scrollTop: n || 0
        }, t || 500)
    }
    function k(t, i, u) {
        var e = $(t), o;
        if (e.length) {
            o = $(i || "body,html");
            u = u || 0;
            var l = f(e)
              , c = f(o)
              , h = d(o)
              , s = r(e.get(0)) + u;
            (s < h || s > h + c.Height - u) && n(s, 500, i)
        }
    }
    function r(n) {
        for (var t = 0; n;)
            t += parseInt(n.offsetTop),
            n = n.offsetParent;
        return t
    }
    function u() {
        if (typeof pageYOffset != "undefined")
            return pageYOffset;
        var t = document.body
          , n = document.documentElement;
        return n = n.clientHeight ? n : t,
        n.scrollTop
    }
    function f(n) {
        var t = $(n);
        return t.is("html") || t.is("body") ? {
            Width: $(window).width(),
            Height: $(window).height()
        } : {
            Width: t.width(),
            Height: t.height()
        }
    }
    function d(n) {
        var t = $(n);
        return t.is("html") || t.is("body") ? u() : t.scrollTop()
    }
    function g(n) {
        n = n || window.location.href;
        var t = n.indexOf("?");
        return t > 0 && (n = n.substr(0, t)),
        t = n.indexOf("#"),
        t > 0 && (n = n.substr(0, t)),
        n
    }
    function e() {
        return "gc__" + o++
    }
    function nt(n, t) {
        var u = $(n), r, i;
        return u.length ? (r = $(u[0]),
        i = r.attr("id"),
        i || (i = e(),
        r.attr("id", i)),
        (t === !0 ? "" : "#") + i) : null
    }
    var o = 1;
    return Number.prototype.toPounds = function (n) {
        return "&pound;" + this.toFixed(n)
    }
    ,
    String.prototype.format = function () {
        var n = arguments;
        return this.replace(/{(\d+)}/g, function (t, i) {
            return typeof n[i] != "undefined" ? n[i] : t
        })
    }
    ,
    window.jQuery && window.jQuery.fn.extend({
        visible: function (n, t, i, r) {
            return n = !!n,
            this.each(function () {
                n ? $(this).show(t, i, r) : $(this).hide(t, i, r)
            }),
            this
        }
    }),
    {
        Init: s,
        InitialiseBackToTopButton: c,
        InitialiseFooterSubstantation: l,
        BindContinueButtonFormSubmit: a,
        ToTitleCaseApos: y,
        AddAntiForgeryToken: p,
        GetAntiForgeryToken: t,
        OpenReviewsPopup: b,
        ParseBoolean: w,
        ScrollToTop: i,
        CleanUrl: g,
        GetNextElementId: e,
        GetElementId: nt,
        ScrollTo: n,
        EnsureVisible: k,
        GetOffsetTop: r,
        GetDocumentScrollTop: u
    }
}();
$(function () {
    GC.Init()
});
GC.DeviceChecker = GC.DeviceChecker || function () {
    function i() {
        return navigator.userAgent.indexOf("MSIE ") > -1 || navigator.userAgent.indexOf("Trident/") > -1
    }
    var n = function () {
        var n = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        return n <= 640 ? !0 : !1
    }
      , t = function () {
          return i()
      }
    ;
    return {
        IsMobile: n,
        SelectiveRender: t
    }
 }();