Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.decodeXMLStrict = exports.decodeHTML5Strict = exports.decodeHTML4Strict = exports.decodeHTML5 = exports.decodeHTML4 = exports.decodeHTMLStrict = exports.decodeHTML = exports.decodeXML = exports.encodeHTML5 = exports.encodeHTML4 = exports.encodeNonAsciiHTML = exports.encodeHTML = exports.escapeText = exports.escapeAttribute = exports.escapeUTF8 = exports.escape = exports.encodeXML = exports.encode = exports.decodeStrict = exports.decode = exports.EncodingMode = exports.DecodingMode = exports.EntityLevel = void 0;

var e, t, r, o = require("./decode.js"), c = require("./encode.js"), n = require("./escape.js");

!function(e) {
    e[e.XML = 0] = "XML", e[e.HTML = 1] = "HTML";
}(e = exports.EntityLevel || (exports.EntityLevel = {})), function(e) {
    e[e.Legacy = 0] = "Legacy", e[e.Strict = 1] = "Strict";
}(t = exports.DecodingMode || (exports.DecodingMode = {})), function(e) {
    e[e.UTF8 = 0] = "UTF8", e[e.ASCII = 1] = "ASCII", e[e.Extensive = 2] = "Extensive", 
    e[e.Attribute = 3] = "Attribute", e[e.Text = 4] = "Text";
}(r = exports.EncodingMode || (exports.EncodingMode = {})), exports.decode = function(r, c) {
    void 0 === c && (c = e.XML);
    var n = "number" == typeof c ? {
        level: c
    } : c;
    return n.level === e.HTML ? n.mode === t.Strict ? (0, o.decodeHTMLStrict)(r) : (0, 
    o.decodeHTML)(r) : (0, o.decodeXML)(r);
}, exports.decodeStrict = function(r, c) {
    void 0 === c && (c = e.XML);
    var n = "number" == typeof c ? {
        level: c
    } : c;
    return n.level === e.HTML ? n.mode === t.Legacy ? (0, o.decodeHTML)(r) : (0, o.decodeHTMLStrict)(r) : (0, 
    o.decodeXML)(r);
}, exports.encode = function(t, o) {
    void 0 === o && (o = e.XML);
    var d = "number" == typeof o ? {
        level: o
    } : o;
    return d.mode === r.UTF8 ? (0, n.escapeUTF8)(t) : d.mode === r.Attribute ? (0, n.escapeAttribute)(t) : d.mode === r.Text ? (0, 
    n.escapeText)(t) : d.level === e.HTML ? d.mode === r.ASCII ? (0, c.encodeNonAsciiHTML)(t) : (0, 
    c.encodeHTML)(t) : (0, n.encodeXML)(t);
};

var d = require("./escape.js");

Object.defineProperty(exports, "encodeXML", {
    enumerable: !0,
    get: function() {
        return d.encodeXML;
    }
}), Object.defineProperty(exports, "escape", {
    enumerable: !0,
    get: function() {
        return d.escape;
    }
}), Object.defineProperty(exports, "escapeUTF8", {
    enumerable: !0,
    get: function() {
        return d.escapeUTF8;
    }
}), Object.defineProperty(exports, "escapeAttribute", {
    enumerable: !0,
    get: function() {
        return d.escapeAttribute;
    }
}), Object.defineProperty(exports, "escapeText", {
    enumerable: !0,
    get: function() {
        return d.escapeText;
    }
});

var i = require("./encode.js");

Object.defineProperty(exports, "encodeHTML", {
    enumerable: !0,
    get: function() {
        return i.encodeHTML;
    }
}), Object.defineProperty(exports, "encodeNonAsciiHTML", {
    enumerable: !0,
    get: function() {
        return i.encodeNonAsciiHTML;
    }
}), Object.defineProperty(exports, "encodeHTML4", {
    enumerable: !0,
    get: function() {
        return i.encodeHTML;
    }
}), Object.defineProperty(exports, "encodeHTML5", {
    enumerable: !0,
    get: function() {
        return i.encodeHTML;
    }
});

var p = require("./decode.js");

Object.defineProperty(exports, "decodeXML", {
    enumerable: !0,
    get: function() {
        return p.decodeXML;
    }
}), Object.defineProperty(exports, "decodeHTML", {
    enumerable: !0,
    get: function() {
        return p.decodeHTML;
    }
}), Object.defineProperty(exports, "decodeHTMLStrict", {
    enumerable: !0,
    get: function() {
        return p.decodeHTMLStrict;
    }
}), Object.defineProperty(exports, "decodeHTML4", {
    enumerable: !0,
    get: function() {
        return p.decodeHTML;
    }
}), Object.defineProperty(exports, "decodeHTML5", {
    enumerable: !0,
    get: function() {
        return p.decodeHTML;
    }
}), Object.defineProperty(exports, "decodeHTML4Strict", {
    enumerable: !0,
    get: function() {
        return p.decodeHTMLStrict;
    }
}), Object.defineProperty(exports, "decodeHTML5Strict", {
    enumerable: !0,
    get: function() {
        return p.decodeHTMLStrict;
    }
}), Object.defineProperty(exports, "decodeXMLStrict", {
    enumerable: !0,
    get: function() {
        return p.decodeXML;
    }
});