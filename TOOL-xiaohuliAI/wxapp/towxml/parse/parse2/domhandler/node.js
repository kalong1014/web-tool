var e, t = (e = function(t, n) {
    return (e = Object.setPrototypeOf || {
        __proto__: []
    } instanceof Array && function(e, t) {
        e.__proto__ = t;
    } || function(e, t) {
        for (var n in t) Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
    })(t, n);
}, function(t, n) {
    if ("function" != typeof n && null !== n) throw new TypeError("Class extends value " + String(n) + " is not a constructor or null");
    function r() {
        this.constructor = t;
    }
    e(t, n), t.prototype = null === n ? Object.create(n) : (r.prototype = n.prototype, 
    new r());
}), n = function() {
    return (n = Object.assign || function(e) {
        for (var t, n = 1, r = arguments.length; n < r; n++) for (var o in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, o) && (e[o] = t[o]);
        return e;
    }).apply(this, arguments);
};

Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.cloneNode = exports.hasChildren = exports.isDocument = exports.isDirective = exports.isComment = exports.isText = exports.isCDATA = exports.isTag = exports.Element = exports.Document = exports.CDATA = exports.NodeWithChildren = exports.ProcessingInstruction = exports.Comment = exports.Text = exports.DataNode = exports.Node = void 0;

var r = require("../domelementtype/index.js"), o = function() {
    function e() {
        this.parent = null, this.prev = null, this.next = null, this.startIndex = null, 
        this.endIndex = null;
    }
    return Object.defineProperty(e.prototype, "parentNode", {
        get: function() {
            return this.parent;
        },
        set: function(e) {
            this.parent = e;
        },
        enumerable: !1,
        configurable: !0
    }), Object.defineProperty(e.prototype, "previousSibling", {
        get: function() {
            return this.prev;
        },
        set: function(e) {
            this.prev = e;
        },
        enumerable: !1,
        configurable: !0
    }), Object.defineProperty(e.prototype, "nextSibling", {
        get: function() {
            return this.next;
        },
        set: function(e) {
            this.next = e;
        },
        enumerable: !1,
        configurable: !0
    }), e.prototype.cloneNode = function(e) {
        return void 0 === e && (e = !1), v(this, e);
    }, e;
}();

exports.Node = o;

var i = function(e) {
    function n(t) {
        var n = e.call(this) || this;
        return n.data = t, n;
    }
    return t(n, e), Object.defineProperty(n.prototype, "nodeValue", {
        get: function() {
            return this.data;
        },
        set: function(e) {
            this.data = e;
        },
        enumerable: !1,
        configurable: !0
    }), n;
}(o);

exports.DataNode = i;

var u = function(e) {
    function n() {
        var t = null !== e && e.apply(this, arguments) || this;
        return t.type = r.ElementType.Text, t;
    }
    return t(n, e), Object.defineProperty(n.prototype, "nodeType", {
        get: function() {
            return 3;
        },
        enumerable: !1,
        configurable: !0
    }), n;
}(i);

exports.Text = u;

var p = function(e) {
    function n() {
        var t = null !== e && e.apply(this, arguments) || this;
        return t.type = r.ElementType.Comment, t;
    }
    return t(n, e), Object.defineProperty(n.prototype, "nodeType", {
        get: function() {
            return 8;
        },
        enumerable: !1,
        configurable: !0
    }), n;
}(i);

exports.Comment = p;

var a = function(e) {
    function n(t, n) {
        var o = e.call(this, n) || this;
        return o.name = t, o.type = r.ElementType.Directive, o;
    }
    return t(n, e), Object.defineProperty(n.prototype, "nodeType", {
        get: function() {
            return 1;
        },
        enumerable: !1,
        configurable: !0
    }), n;
}(i);

exports.ProcessingInstruction = a;

var c = function(e) {
    function n(t) {
        var n = e.call(this) || this;
        return n.children = t, n;
    }
    return t(n, e), Object.defineProperty(n.prototype, "firstChild", {
        get: function() {
            var e;
            return null !== (e = this.children[0]) && void 0 !== e ? e : null;
        },
        enumerable: !1,
        configurable: !0
    }), Object.defineProperty(n.prototype, "lastChild", {
        get: function() {
            return this.children.length > 0 ? this.children[this.children.length - 1] : null;
        },
        enumerable: !1,
        configurable: !0
    }), Object.defineProperty(n.prototype, "childNodes", {
        get: function() {
            return this.children;
        },
        set: function(e) {
            this.children = e;
        },
        enumerable: !1,
        configurable: !0
    }), n;
}(o);

exports.NodeWithChildren = c;

var s = function(e) {
    function n() {
        var t = null !== e && e.apply(this, arguments) || this;
        return t.type = r.ElementType.CDATA, t;
    }
    return t(n, e), Object.defineProperty(n.prototype, "nodeType", {
        get: function() {
            return 4;
        },
        enumerable: !1,
        configurable: !0
    }), n;
}(c);

exports.CDATA = s;

var l = function(e) {
    function n() {
        var t = null !== e && e.apply(this, arguments) || this;
        return t.type = r.ElementType.Root, t;
    }
    return t(n, e), Object.defineProperty(n.prototype, "nodeType", {
        get: function() {
            return 9;
        },
        enumerable: !1,
        configurable: !0
    }), n;
}(c);

exports.Document = l;

var f = function(e) {
    function n(t, n, o, i) {
        void 0 === o && (o = []), void 0 === i && (i = "script" === t ? r.ElementType.Script : "style" === t ? r.ElementType.Style : r.ElementType.Tag);
        var u = e.call(this, o) || this;
        return u.name = t, u.attribs = n, u.type = i, u;
    }
    return t(n, e), Object.defineProperty(n.prototype, "nodeType", {
        get: function() {
            return 1;
        },
        enumerable: !1,
        configurable: !0
    }), Object.defineProperty(n.prototype, "tagName", {
        get: function() {
            return this.name;
        },
        set: function(e) {
            this.name = e;
        },
        enumerable: !1,
        configurable: !0
    }), Object.defineProperty(n.prototype, "attributes", {
        get: function() {
            var e = this;
            return Object.keys(this.attribs).map(function(t) {
                var n, r;
                return {
                    name: t,
                    value: e.attribs[t],
                    namespace: null === (n = e["x-attribsNamespace"]) || void 0 === n ? void 0 : n[t],
                    prefix: null === (r = e["x-attribsPrefix"]) || void 0 === r ? void 0 : r[t]
                };
            });
        },
        enumerable: !1,
        configurable: !0
    }), n;
}(c);

function d(e) {
    return (0, r.isTag)(e);
}

function y(e) {
    return e.type === r.ElementType.CDATA;
}

function x(e) {
    return e.type === r.ElementType.Text;
}

function h(e) {
    return e.type === r.ElementType.Comment;
}

function m(e) {
    return e.type === r.ElementType.Directive;
}

function b(e) {
    return e.type === r.ElementType.Root;
}

function v(e, t) {
    var r;
    if (void 0 === t && (t = !1), x(e)) r = new u(e.data); else if (h(e)) r = new p(e.data); else if (d(e)) {
        var o = t ? g(e.children) : [], i = new f(e.name, n({}, e.attribs), o);
        o.forEach(function(e) {
            return e.parent = i;
        }), null != e.namespace && (i.namespace = e.namespace), e["x-attribsNamespace"] && (i["x-attribsNamespace"] = n({}, e["x-attribsNamespace"])), 
        e["x-attribsPrefix"] && (i["x-attribsPrefix"] = n({}, e["x-attribsPrefix"])), r = i;
    } else if (y(e)) {
        o = t ? g(e.children) : [];
        var c = new s(o);
        o.forEach(function(e) {
            return e.parent = c;
        }), r = c;
    } else if (b(e)) {
        o = t ? g(e.children) : [];
        var v = new l(o);
        o.forEach(function(e) {
            return e.parent = v;
        }), e["x-mode"] && (v["x-mode"] = e["x-mode"]), r = v;
    } else {
        if (!m(e)) throw new Error("Not implemented yet: ".concat(e.type));
        var T = new a(e.name, e.data);
        null != e["x-name"] && (T["x-name"] = e["x-name"], T["x-publicId"] = e["x-publicId"], 
        T["x-systemId"] = e["x-systemId"]), r = T;
    }
    return r.startIndex = e.startIndex, r.endIndex = e.endIndex, null != e.sourceCodeLocation && (r.sourceCodeLocation = e.sourceCodeLocation), 
    r;
}

function g(e) {
    for (var t = e.map(function(e) {
        return v(e, !0);
    }), n = 1; n < t.length; n++) t[n].prev = t[n - 1], t[n - 1].next = t[n];
    return t;
}

exports.Element = f, exports.isTag = d, exports.isCDATA = y, exports.isText = x, 
exports.isComment = h, exports.isDirective = m, exports.isDocument = b, exports.hasChildren = function(e) {
    return Object.prototype.hasOwnProperty.call(e, "children");
}, exports.cloneNode = v;