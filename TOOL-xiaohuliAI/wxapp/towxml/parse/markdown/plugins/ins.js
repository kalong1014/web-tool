var e = require("../../../../@babel/runtime/helpers/typeof");

!function(n) {
    if ("object" == ("undefined" == typeof exports ? "undefined" : e(exports)) && "undefined" != typeof module) module.exports = n(); else if ("function" == typeof define && define.amd) define([], n); else {
        ("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).markdownitIns = n();
    }
}(function() {
    return function e(n, t, o) {
        function r(s, f) {
            if (!t[s]) {
                if (!n[s]) {
                    var u = "function" == typeof require && require;
                    if (!f && u) return u(s, !0);
                    if (i) return i(s, !0);
                    var p = new Error("Cannot find module '" + s + "'");
                    throw p.code = "MODULE_NOT_FOUND", p;
                }
                var l = t[s] = {
                    exports: {}
                };
                n[s][0].call(l.exports, function(e) {
                    var t = n[s][1][e];
                    return r(t || e);
                }, l, l.exports, e, n, t, o);
            }
            return t[s].exports;
        }
        for (var i = "function" == typeof require && require, s = 0; s < o.length; s++) r(o[s]);
        return r;
    }({
        1: [ function(e, n, t) {
            n.exports = function(e) {
                e.inline.ruler.before("emphasis", "ins", function(e, n) {
                    var t, o, r, i, s = e.pos, f = e.src.charCodeAt(s);
                    if (n) return !1;
                    if (43 !== f) return !1;
                    if (r = (o = e.scanDelims(e.pos, !0)).length, i = String.fromCharCode(f), 2 > r) return !1;
                    for (r % 2 && (e.push("text", "", 0).content = i, r--), t = 0; r > t; t += 2) e.push("text", "", 0).content = i + i, 
                    e.delimiters.push({
                        marker: f,
                        jump: t,
                        token: e.tokens.length - 1,
                        level: e.level,
                        end: -1,
                        open: o.can_open,
                        close: o.can_close
                    });
                    return e.pos += o.length, !0;
                }), e.inline.ruler2.before("emphasis", "ins", function(e) {
                    var n, t, o, r, i, s = [], f = e.delimiters, u = e.delimiters.length;
                    for (n = 0; u > n; n++) 43 === (o = f[n]).marker && -1 !== o.end && (r = f[o.end], 
                    (i = e.tokens[o.token]).type = "ins_open", i.tag = "ins", i.nesting = 1, i.markup = "++", 
                    i.content = "", (i = e.tokens[r.token]).type = "ins_close", i.tag = "ins", i.nesting = -1, 
                    i.markup = "++", i.content = "", "text" === e.tokens[r.token - 1].type && "+" === e.tokens[r.token - 1].content && s.push(r.token - 1));
                    for (;s.length; ) {
                        for (t = (n = s.pop()) + 1; t < e.tokens.length && "ins_close" === e.tokens[t].type; ) t++;
                        n !== --t && (i = e.tokens[t], e.tokens[t] = e.tokens[n], e.tokens[n] = i);
                    }
                });
            };
        }, {} ]
    }, {}, [ 1 ])(1);
});