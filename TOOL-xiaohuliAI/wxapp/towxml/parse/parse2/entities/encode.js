var e = require("../../../../@babel/runtime/helpers/typeof"), r = function(e) {
    return e && e.__esModule ? e : {
        default: e
    };
};

Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.encodeNonAsciiHTML = exports.encodeHTML = void 0;

var t = r(require("./generated/encode-html.js")), n = require("./escape.js"), o = /[\t\n!-,./:-@[-`\f{-}$\x80-\uFFFF]/g;

function i(r, o) {
    for (var i, u = "", c = 0; null !== (i = r.exec(o)); ) {
        var s = i.index;
        u += o.substring(c, s);
        var d = o.charCodeAt(s), a = t.default.get(d);
        if ("object" === e(a)) {
            if (s + 1 < o.length) {
                var l = o.charCodeAt(s + 1), f = "number" == typeof a.n ? a.n === l ? a.o : void 0 : a.n.get(l);
                if (void 0 !== f) {
                    u += f, c = r.lastIndex += 1;
                    continue;
                }
            }
            a = a.v;
        }
        if (void 0 !== a) u += a, c = s + 1; else {
            var v = (0, n.getCodePoint)(o, s);
            u += "&#x".concat(v.toString(16), ";"), c = r.lastIndex += Number(v !== d);
        }
    }
    return u + o.substr(c);
}

exports.encodeHTML = function(e) {
    return i(o, e);
}, exports.encodeNonAsciiHTML = function(e) {
    return i(n.xmlReplacer, e);
};