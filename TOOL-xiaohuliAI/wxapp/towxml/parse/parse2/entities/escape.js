Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.escapeText = exports.escapeAttribute = exports.escapeUTF8 = exports.escape = exports.encodeXML = exports.getCodePoint = exports.xmlReplacer = void 0, 
exports.xmlReplacer = /["&'<>$\x80-\uFFFF]/g;

var e = new Map([ [ 34, "&quot;" ], [ 38, "&amp;" ], [ 39, "&apos;" ], [ 60, "&lt;" ], [ 62, "&gt;" ] ]);

function t(t) {
    for (var r, o = "", n = 0; null !== (r = exports.xmlReplacer.exec(t)); ) {
        var s = r.index, p = t.charCodeAt(s), c = e.get(p);
        void 0 !== c ? (o += t.substring(n, s) + c, n = s + 1) : (o += "".concat(t.substring(n, s), "&#x").concat((0, 
        exports.getCodePoint)(t, s).toString(16), ";"), n = exports.xmlReplacer.lastIndex += Number(55296 == (64512 & p)));
    }
    return o + t.substr(n);
}

function r(e, t) {
    return function(r) {
        for (var o, n = 0, s = ""; o = e.exec(r); ) n !== o.index && (s += r.substring(n, o.index)), 
        s += t.get(o[0].charCodeAt(0)), n = o.index + 1;
        return s + r.substring(n);
    };
}

exports.getCodePoint = null != String.prototype.codePointAt ? function(e, t) {
    return e.codePointAt(t);
} : function(e, t) {
    return 55296 == (64512 & e.charCodeAt(t)) ? 1024 * (e.charCodeAt(t) - 55296) + e.charCodeAt(t + 1) - 56320 + 65536 : e.charCodeAt(t);
}, exports.encodeXML = t, exports.escape = t, exports.escapeUTF8 = r(/[&<>'"]/g, e), 
exports.escapeAttribute = r(/["&\u00A0]/g, new Map([ [ 34, "&quot;" ], [ 38, "&amp;" ], [ 160, "&nbsp;" ] ])), 
exports.escapeText = r(/[&<>\u00A0]/g, new Map([ [ 38, "&amp;" ], [ 60, "&lt;" ], [ 62, "&gt;" ], [ 160, "&nbsp;" ] ]));