var e = function(e) {
    return e && e.__esModule ? e : {
        default: e
    };
};

Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.decodeXML = exports.decodeHTMLStrict = exports.decodeHTML = exports.determineBranch = exports.BinTrieFlags = exports.fromCodePoint = exports.replaceCodePoint = exports.decodeCodePoint = exports.xmlDecodeTree = exports.htmlDecodeTree = void 0;

var r = e(require("./generated/decode-data-html.js"));

exports.htmlDecodeTree = r.default;

var o = e(require("./generated/decode-data-xml.js"));

exports.xmlDecodeTree = o.default;

var t = e(require("./decode_codepoint.js"));

exports.decodeCodePoint = t.default;

var d, n, i = require("./decode_codepoint.js");

function a(e) {
    return function(r, o) {
        for (var i = "", a = 0, f = 0; (f = r.indexOf("&", f)) >= 0; ) if (i += r.slice(a, f), 
        a = f, f += 1, r.charCodeAt(f) !== d.NUM) {
            for (var u = 0, s = 1, E = 0, L = e[E]; f < r.length && !((E = c(e, L, E + 1, r.charCodeAt(f))) < 0); f++, 
            s++) {
                var _ = (L = e[E]) & n.VALUE_LENGTH;
                if (_) {
                    var T;
                    if (o && r.charCodeAt(f) !== d.SEMI || (u = E, s = 0), 0 === (T = (_ >> 14) - 1)) break;
                    E += T;
                }
            }
            if (0 !== u) i += 1 === (T = (e[u] & n.VALUE_LENGTH) >> 14) ? String.fromCharCode(e[u] & ~n.VALUE_LENGTH) : 2 === T ? String.fromCharCode(e[u + 1]) : String.fromCharCode(e[u + 1], e[u + 2]), 
            a = f - s + 1;
        } else {
            var l = f + 1, p = 10, x = r.charCodeAt(l);
            (x | d.To_LOWER_BIT) === d.LOWER_X && (p = 16, f += 1, l += 1);
            do {
                x = r.charCodeAt(++f);
            } while (x >= d.ZERO && x <= d.NINE || 16 === p && (x | d.To_LOWER_BIT) >= d.LOWER_A && (x | d.To_LOWER_BIT) <= d.LOWER_F);
            if (l !== f) {
                var C = r.substring(l, f), O = parseInt(C, p);
                if (r.charCodeAt(f) === d.SEMI) f += 1; else if (o) continue;
                i += (0, t.default)(O), a = f;
            }
        }
        return i + r.slice(a);
    };
}

function c(e, r, o, t) {
    var d = (r & n.BRANCH_LENGTH) >> 7, i = r & n.JUMP_TABLE;
    if (0 === d) return 0 !== i && t === i ? o : -1;
    if (i) {
        var a = t - i;
        return a < 0 || a >= d ? -1 : e[o + a] - 1;
    }
    for (var c = o, f = c + d - 1; c <= f; ) {
        var u = c + f >>> 1, s = e[u];
        if (s < t) c = u + 1; else {
            if (!(s > t)) return e[u + d];
            f = u - 1;
        }
    }
    return -1;
}

Object.defineProperty(exports, "replaceCodePoint", {
    enumerable: !0,
    get: function() {
        return i.replaceCodePoint;
    }
}), Object.defineProperty(exports, "fromCodePoint", {
    enumerable: !0,
    get: function() {
        return i.fromCodePoint;
    }
}), function(e) {
    e[e.NUM = 35] = "NUM", e[e.SEMI = 59] = "SEMI", e[e.ZERO = 48] = "ZERO", e[e.NINE = 57] = "NINE", 
    e[e.LOWER_A = 97] = "LOWER_A", e[e.LOWER_F = 102] = "LOWER_F", e[e.LOWER_X = 120] = "LOWER_X", 
    e[e.To_LOWER_BIT = 32] = "To_LOWER_BIT";
}(d || (d = {})), function(e) {
    e[e.VALUE_LENGTH = 49152] = "VALUE_LENGTH", e[e.BRANCH_LENGTH = 16256] = "BRANCH_LENGTH", 
    e[e.JUMP_TABLE = 127] = "JUMP_TABLE";
}(n = exports.BinTrieFlags || (exports.BinTrieFlags = {})), exports.determineBranch = c;

var f = a(r.default), u = a(o.default);

exports.decodeHTML = function(e) {
    return f(e, !1);
}, exports.decodeHTMLStrict = function(e) {
    return f(e, !0);
}, exports.decodeXML = function(e) {
    return u(e, !0);
};