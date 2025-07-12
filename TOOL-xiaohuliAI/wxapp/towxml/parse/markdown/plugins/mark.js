var e = require("../../../../@babel/runtime/helpers/typeof");

!function(n) {
    if ("object" == ("undefined" == typeof exports ? "undefined" : e(exports)) && "undefined" != typeof module) module.exports = n(); else if ("function" == typeof define && define.amd) define([], n); else {
        ("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).markdownitMark = n();
    }
}(function() {
    return function e(n, t, r) {
        function o(f, s) {
            if (!t[f]) {
                if (!n[f]) {
                    var u = "function" == typeof require && require;
                    if (!s && u) return u(f, !0);
                    if (i) return i(f, !0);
                    var p = new Error("Cannot find module '" + f + "'");
                    throw p.code = "MODULE_NOT_FOUND", p;
                }
                var l = t[f] = {
                    exports: {}
                };
                n[f][0].call(l.exports, function(e) {
                    var t = n[f][1][e];
                    return o(t || e);
                }, l, l.exports, e, n, t, r);
            }
            return t[f].exports;
        }
        for (var i = "function" == typeof require && require, f = 0; f < r.length; f++) o(r[f]);
        return o;
    }({
        1: [ function(e, n, t) {
            n.exports = function(e) {
                e.inline.ruler.before("emphasis", "mark", function(e, n) {
                    var t, r, o, i, f = e.pos, s = e.src.charCodeAt(f);
                    if (n) return !1;
                    if (61 !== s) return !1;
                    if (o = (r = e.scanDelims(e.pos, !0)).length, i = String.fromCharCode(s), 2 > o) return !1;
                    for (o % 2 && (e.push("text", "", 0).content = i, o--), t = 0; o > t; t += 2) e.push("text", "", 0).content = i + i, 
                    e.delimiters.push({
                        marker: s,
                        jump: t,
                        token: e.tokens.length - 1,
                        level: e.level,
                        end: -1,
                        open: r.can_open,
                        close: r.can_close
                    });
                    return e.pos += r.length, !0;
                }), e.inline.ruler2.before("emphasis", "mark", function(e) {
                    var n, t, r, o, i, f = [], s = e.delimiters, u = e.delimiters.length;
                    for (n = 0; u > n; n++) 61 === (r = s[n]).marker && -1 !== r.end && (o = s[r.end], 
                    (i = e.tokens[r.token]).type = "mark_open", i.tag = "mark", i.nesting = 1, i.markup = "==", 
                    i.content = "", (i = e.tokens[o.token]).type = "mark_close", i.tag = "mark", i.nesting = -1, 
                    i.markup = "==", i.content = "", "text" === e.tokens[o.token - 1].type && "=" === e.tokens[o.token - 1].content && f.push(o.token - 1));
                    for (;f.length; ) {
                        for (t = (n = f.pop()) + 1; t < e.tokens.length && "mark_close" === e.tokens[t].type; ) t++;
                        n !== --t && (i = e.tokens[t], e.tokens[t] = e.tokens[n], e.tokens[n] = i);
                    }
                });
            };
        }, {} ]
    }, {}, [ 1 ])(1);
});