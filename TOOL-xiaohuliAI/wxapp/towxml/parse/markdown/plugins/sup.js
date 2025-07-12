var e = require("../../../../@babel/runtime/helpers/typeof");

!function(r) {
    if ("object" == ("undefined" == typeof exports ? "undefined" : e(exports)) && "undefined" != typeof module) module.exports = r(); else if ("function" == typeof define && define.amd) define([], r); else {
        ("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).markdownitSup = r();
    }
}(function() {
    return function e(r, n, o) {
        function t(u, p) {
            if (!n[u]) {
                if (!r[u]) {
                    var s = "function" == typeof require && require;
                    if (!p && s) return s(u, !0);
                    if (i) return i(u, !0);
                    var f = new Error("Cannot find module '" + u + "'");
                    throw f.code = "MODULE_NOT_FOUND", f;
                }
                var a = n[u] = {
                    exports: {}
                };
                r[u][0].call(a.exports, function(e) {
                    var n = r[u][1][e];
                    return t(n || e);
                }, a, a.exports, e, r, n, o);
            }
            return n[u].exports;
        }
        for (var i = "function" == typeof require && require, u = 0; u < o.length; u++) t(o[u]);
        return t;
    }({
        1: [ function(e, r) {
            function n(e, r) {
                var n, t, i = e.posMax, u = e.pos;
                if (94 !== e.src.charCodeAt(u)) return !1;
                if (r) return !1;
                if (u + 2 >= i) return !1;
                for (e.pos = u + 1; e.pos < i; ) {
                    if (94 === e.src.charCodeAt(e.pos)) {
                        n = !0;
                        break;
                    }
                    e.md.inline.skipToken(e);
                }
                return n && u + 1 !== e.pos ? (t = e.src.slice(u + 1, e.pos)).match(/(^|[^\\])(\\\\)*\s/) ? (e.pos = u, 
                !1) : (e.posMax = e.pos, e.pos = u + 1, e.push("sup_open", "sup", 1).markup = "^", 
                e.push("text", "", 0).content = t.replace(o, "$1"), e.push("sup_close", "sup", -1).markup = "^", 
                e.pos = e.posMax + 1, e.posMax = i, !0) : (e.pos = u, !1);
            }
            var o = /\\([ \\!"#$%&'()*+,.\/:;<=>?@[\]^_`{|}~-])/g;
            r.exports = function(e) {
                e.inline.ruler.after("emphasis", "sup", n);
            };
        }, {} ]
    }, {}, [ 1 ])(1);
});