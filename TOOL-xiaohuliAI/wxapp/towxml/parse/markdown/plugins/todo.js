var e = require("../../../../@babel/runtime/helpers/typeof");

!function(t) {
    if ("object" === ("undefined" == typeof exports ? "undefined" : e(exports)) && "undefined" != typeof module) module.exports = t(); else if ("function" == typeof define && define.amd) define([], t); else {
        ("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).markdownitTaskLists = t();
    }
}(function() {
    return function e(t, n, i) {
        function o(l, c) {
            if (!n[l]) {
                if (!t[l]) {
                    var f = "function" == typeof require && require;
                    if (!c && f) return f(l, !0);
                    if (r) return r(l, !0);
                    var u = new Error("Cannot find module '" + l + "'");
                    throw u.code = "MODULE_NOT_FOUND", u;
                }
                var a = n[l] = {
                    exports: {}
                };
                t[l][0].call(a.exports, function(e) {
                    var n = t[l][1][e];
                    return o(n || e);
                }, a, a.exports, e, t, n, i);
            }
            return n[l].exports;
        }
        for (var r = "function" == typeof require && require, l = 0; l < i.length; l++) o(i[l]);
        return o;
    }({
        1: [ function(e, t, n) {
            var i = !0, o = !1, r = !1;
            function l(e, t, n) {
                var i = e.attrIndex(t), o = [ t, n ];
                i < 0 ? e.attrPush(o) : e.attrs[i] = o;
            }
            function c(e, t) {
                for (var n = e[t].level - 1, i = t - 1; i >= 0; i--) if (e[i].level === n) return i;
                return -1;
            }
            function f(e, t) {
                return "inline" === e[t].type && function(e) {
                    return "paragraph_open" === e.type;
                }(e[t - 1]) && function(e) {
                    return "list_item_open" === e.type;
                }(e[t - 2]) && function(e) {
                    return 0 === e.content.indexOf("[ ] ") || 0 === e.content.indexOf("[x] ") || 0 === e.content.indexOf("[X] ");
                }(e[t]);
            }
            function u(e, t) {
                if (e.children.unshift(function(e, t) {
                    var n = new t("html_inline", "", 0), o = i ? ' disabled="" ' : "", r = ' value="' + e.content + '" ';
                    0 === e.content.indexOf("[ ] ") ? n.content = '<checkbox class="h2w__todoCheckbox task-list-item-checkbox"' + o + r + "/>" : 0 !== e.content.indexOf("[x] ") && 0 !== e.content.indexOf("[X] ") || (n.content = '<checkbox class="h2w__todoCheckbox task-list-item-checkbox" checked="true"' + o + r + "/>");
                    return n;
                }(e, t)), e.children[1].content = e.children[1].content.slice(3), e.content = e.content.slice(3), 
                o) if (r) {
                    e.children.pop();
                    var n = "task-item-" + Math.ceil(1e7 * Math.random() - 1e3);
                    e.children[0].content = e.children[0].content.slice(0, -1) + ' id="' + n + '">', 
                    e.children.push(function(e, t, n) {
                        var i = new n("html_inline", "", 0);
                        return i.content = '<label class="task-list-item-label" for="' + t + '">' + e + "</label>", 
                        i.attrs = [ {
                            for: t
                        } ], i;
                    }(e.content, n, t));
                } else e.children.unshift(function(e) {
                    var t = new e("html_inline", "", 0);
                    return t.content = "<label>", t;
                }(t)), e.children.push(function(e) {
                    var t = new e("html_inline", "", 0);
                    return t.content = "</label>", t;
                }(t));
            }
            t.exports = function(e, t) {
                t && (i = !t.enabled, o = !!t.label, r = !!t.labelAfter), e.core.ruler.after("inline", "github-task-lists", function(e) {
                    for (var t = e.tokens, n = function(e) {
                        for (var n, i = t[e], o = i.tag, r = i.level, l = "list_item_open" === i.type ? "list_item_close" : "bullet_list_close", c = e, f = t.length; c < f; c++) {
                            var u = t[c];
                            if (u.tag === o && r === u.level && u.type === l) {
                                n = u;
                                break;
                            }
                        }
                        return n;
                    }, o = 2; o < t.length; o++) f(t, o) && (u(t[o], e.Token), l(t[o - 2], "class", "task-list-item" + (i ? "" : " enabled")), 
                    l(t[c(t, o - 2)], "class", "contains-task-list"), n(c(t, o - 2)).tag = "todogroup", 
                    t[c(t, o - 2)].tag = "todogroup", n(o - 2).tag = "todolist", t[o - 2].tag = "todolist");
                });
            };
        }, {} ]
    }, {}, [ 1 ])(1);
});