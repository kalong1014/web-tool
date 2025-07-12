var t = require("../../../../@babel/runtime/helpers/typeof"), e = require("../domelementtype/index.js"), n = require("./node.js"), o = {
    withStartIndices: !1,
    withEndIndices: !1,
    xmlMode: !1
}, i = function() {
    function i(e, i, s) {
        this.dom = [], this.root = new n.Document(this.dom), this.done = !1, this.tagStack = [ this.root ], 
        this.lastNode = null, this.parser = null, "function" == typeof i && (s = i, i = o), 
        "object" === t(e) && (i = e, e = void 0), this.callback = null != e ? e : null, 
        this.options = null != i ? i : o, this.elementCB = null != s ? s : null;
    }
    return i.prototype.onparserinit = function(t) {
        this.parser = t;
    }, i.prototype.onreset = function() {
        this.dom = [], this.root = new n.Document(this.dom), this.done = !1, this.tagStack = [ this.root ], 
        this.lastNode = null, this.parser = null;
    }, i.prototype.onend = function() {
        this.done || (this.done = !0, this.parser = null, this.handleCallback(null));
    }, i.prototype.onerror = function(t) {
        this.handleCallback(t);
    }, i.prototype.onclosetag = function() {
        this.lastNode = null;
        var t = this.tagStack.pop();
        this.options.withEndIndices && (t.endIndex = this.parser.endIndex), this.elementCB && this.elementCB(t);
    }, i.prototype.onopentag = function(t, o) {
        var i = this.options.xmlMode ? e.ElementType.Tag : void 0, s = new n.Element(t, o, void 0, i);
        this.addNode(s), this.tagStack.push(s);
    }, i.prototype.ontext = function(t) {
        var o = this.lastNode;
        if (o && o.type === e.ElementType.Text) o.data += t, this.options.withEndIndices && (o.endIndex = this.parser.endIndex); else {
            var i = new n.Text(t);
            this.addNode(i), this.lastNode = i;
        }
    }, i.prototype.oncomment = function(t) {
        if (this.lastNode && this.lastNode.type === e.ElementType.Comment) this.lastNode.data += t; else {
            var o = new n.Comment(t);
            this.addNode(o), this.lastNode = o;
        }
    }, i.prototype.oncommentend = function() {
        this.lastNode = null;
    }, i.prototype.oncdatastart = function() {
        var t = new n.Text(""), e = new n.CDATA([ t ]);
        this.addNode(e), t.parent = e, this.lastNode = t;
    }, i.prototype.oncdataend = function() {
        this.lastNode = null;
    }, i.prototype.onprocessinginstruction = function(t, e) {
        var o = new n.ProcessingInstruction(t, e);
        this.addNode(o);
    }, i.prototype.handleCallback = function(t) {
        if ("function" == typeof this.callback) this.callback(t, this.dom); else if (t) throw t;
    }, i.prototype.addNode = function(t) {
        var e = this.tagStack[this.tagStack.length - 1], n = e.children[e.children.length - 1];
        this.options.withStartIndices && (t.startIndex = this.parser.startIndex), this.options.withEndIndices && (t.endIndex = this.parser.endIndex), 
        e.children.push(t), n && (t.prev = n, n.next = t), t.parent = e, this.lastNode = null;
    }, i;
}();

module.exports = i;