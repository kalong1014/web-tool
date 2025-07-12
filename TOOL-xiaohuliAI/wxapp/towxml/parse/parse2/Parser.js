var t = require("./Tokenizer.js"), e = require("./entities/decode.js"), i = new Set([ "input", "option", "optgroup", "select", "button", "datalist", "textarea" ]), s = new Set([ "p" ]), n = new Set([ "thead", "tbody" ]), o = new Set([ "dd", "dt" ]), r = new Set([ "rt", "rp" ]), a = new Map([ [ "tr", new Set([ "tr", "th", "td" ]) ], [ "th", new Set([ "th" ]) ], [ "td", new Set([ "thead", "th", "td" ]) ], [ "body", new Set([ "head", "link", "script" ]) ], [ "li", new Set([ "li" ]) ], [ "p", s ], [ "h1", s ], [ "h2", s ], [ "h3", s ], [ "h4", s ], [ "h5", s ], [ "h6", s ], [ "select", i ], [ "input", i ], [ "output", i ], [ "button", i ], [ "datalist", i ], [ "textarea", i ], [ "option", new Set([ "option" ]) ], [ "optgroup", new Set([ "optgroup", "option" ]) ], [ "dd", o ], [ "dt", o ], [ "address", s ], [ "article", s ], [ "aside", s ], [ "blockquote", s ], [ "details", s ], [ "div", s ], [ "dl", s ], [ "fieldset", s ], [ "figcaption", s ], [ "figure", s ], [ "footer", s ], [ "form", s ], [ "header", s ], [ "hr", s ], [ "main", s ], [ "nav", s ], [ "ol", s ], [ "pre", s ], [ "section", s ], [ "table", s ], [ "ul", s ], [ "rt", r ], [ "rp", r ], [ "tbody", n ], [ "tfoot", n ] ]), h = new Set([ "area", "base", "basefont", "br", "col", "command", "embed", "frame", "hr", "img", "input", "isindex", "keygen", "link", "meta", "param", "source", "track", "wbr" ]), l = new Set([ "math", "svg" ]), c = new Set([ "mi", "mo", "mn", "ms", "mtext", "annotation-xml", "foreignobject", "desc", "title" ]), d = /\s|\//, u = function() {
    function i(e, i) {
        var s, n, o, r, a;
        void 0 === i && (i = {}), this.options = i, this.startIndex = 0, this.endIndex = 0, 
        this.openTagStart = 0, this.tagname = "", this.attribname = "", this.attribvalue = "", 
        this.attribs = null, this.stack = [], this.foreignContext = [], this.buffers = [], 
        this.bufferOffset = 0, this.writeIndex = 0, this.ended = !1, this.cbs = null != e ? e : {}, 
        this.lowerCaseTagNames = null !== (s = i.lowerCaseTags) && void 0 !== s ? s : !i.xmlMode, 
        this.lowerCaseAttributeNames = null !== (n = i.lowerCaseAttributeNames) && void 0 !== n ? n : !i.xmlMode, 
        this.tokenizer = new (null !== (o = i.Tokenizer) && void 0 !== o ? o : t.default)(this.options, this), 
        null === (a = (r = this.cbs).onparserinit) || void 0 === a || a.call(r, this);
    }
    return i.prototype.ontext = function(t, e) {
        var i, s, n = this.getSlice(t, e);
        this.endIndex = e - 1, null === (s = (i = this.cbs).ontext) || void 0 === s || s.call(i, n), 
        this.startIndex = e;
    }, i.prototype.ontextentity = function(t) {
        var i, s, n = this.tokenizer.getSectionStart();
        this.endIndex = n - 1, null === (s = (i = this.cbs).ontext) || void 0 === s || s.call(i, (0, 
        e.fromCodePoint)(t)), this.startIndex = n;
    }, i.prototype.isVoidElement = function(t) {
        return !this.options.xmlMode && h.has(t);
    }, i.prototype.onopentagname = function(t, e) {
        this.endIndex = e;
        var i = this.getSlice(t, e);
        this.lowerCaseTagNames && (i = i.toLowerCase()), this.emitOpenTag(i);
    }, i.prototype.emitOpenTag = function(t) {
        var e, i, s, n;
        this.openTagStart = this.startIndex, this.tagname = t;
        var o = !this.options.xmlMode && a.get(t);
        if (o) for (;this.stack.length > 0 && o.has(this.stack[this.stack.length - 1]); ) {
            var r = this.stack.pop();
            null === (i = (e = this.cbs).onclosetag) || void 0 === i || i.call(e, r, !0);
        }
        this.isVoidElement(t) || (this.stack.push(t), l.has(t) ? this.foreignContext.push(!0) : c.has(t) && this.foreignContext.push(!1)), 
        null === (n = (s = this.cbs).onopentagname) || void 0 === n || n.call(s, t), this.cbs.onopentag && (this.attribs = {});
    }, i.prototype.endOpenTag = function(t) {
        var e, i;
        this.startIndex = this.openTagStart, this.attribs && (null === (i = (e = this.cbs).onopentag) || void 0 === i || i.call(e, this.tagname, this.attribs, t), 
        this.attribs = null), this.cbs.onclosetag && this.isVoidElement(this.tagname) && this.cbs.onclosetag(this.tagname, !0), 
        this.tagname = "";
    }, i.prototype.onopentagend = function(t) {
        this.endIndex = t, this.endOpenTag(!1), this.startIndex = t + 1;
    }, i.prototype.onclosetag = function(t, e) {
        var i, s, n, o, r, a;
        this.endIndex = e;
        var h = this.getSlice(t, e);
        if (this.lowerCaseTagNames && (h = h.toLowerCase()), (l.has(h) || c.has(h)) && this.foreignContext.pop(), 
        this.isVoidElement(h)) this.options.xmlMode || "br" !== h || (null === (s = (i = this.cbs).onopentagname) || void 0 === s || s.call(i, "br"), 
        null === (o = (n = this.cbs).onopentag) || void 0 === o || o.call(n, "br", {}, !0), 
        null === (a = (r = this.cbs).onclosetag) || void 0 === a || a.call(r, "br", !1)); else {
            var d = this.stack.lastIndexOf(h);
            if (-1 !== d) if (this.cbs.onclosetag) for (var u = this.stack.length - d; u--; ) this.cbs.onclosetag(this.stack.pop(), 0 !== u); else this.stack.length = d; else this.options.xmlMode || "p" !== h || (this.emitOpenTag("p"), 
            this.closeCurrentTag(!0));
        }
        this.startIndex = e + 1;
    }, i.prototype.onselfclosingtag = function(t) {
        this.endIndex = t, this.options.xmlMode || this.options.recognizeSelfClosing || this.foreignContext[this.foreignContext.length - 1] ? (this.closeCurrentTag(!1), 
        this.startIndex = t + 1) : this.onopentagend(t);
    }, i.prototype.closeCurrentTag = function(t) {
        var e, i, s = this.tagname;
        this.endOpenTag(t), this.stack[this.stack.length - 1] === s && (null === (i = (e = this.cbs).onclosetag) || void 0 === i || i.call(e, s, !t), 
        this.stack.pop());
    }, i.prototype.onattribname = function(t, e) {
        this.startIndex = t;
        var i = this.getSlice(t, e);
        this.attribname = this.lowerCaseAttributeNames ? i.toLowerCase() : i;
    }, i.prototype.onattribdata = function(t, e) {
        this.attribvalue += this.getSlice(t, e);
    }, i.prototype.onattribentity = function(t) {
        this.attribvalue += (0, e.fromCodePoint)(t);
    }, i.prototype.onattribend = function(e, i) {
        var s, n;
        this.endIndex = i, null === (n = (s = this.cbs).onattribute) || void 0 === n || n.call(s, this.attribname, this.attribvalue, e === t.QuoteType.Double ? '"' : e === t.QuoteType.Single ? "'" : e === t.QuoteType.NoValue ? void 0 : null), 
        this.attribs && !Object.prototype.hasOwnProperty.call(this.attribs, this.attribname) && (this.attribs[this.attribname] = this.attribvalue), 
        this.attribvalue = "";
    }, i.prototype.getInstructionName = function(t) {
        var e = t.search(d), i = e < 0 ? t : t.substr(0, e);
        return this.lowerCaseTagNames && (i = i.toLowerCase()), i;
    }, i.prototype.ondeclaration = function(t, e) {
        this.endIndex = e;
        var i = this.getSlice(t, e);
        if (this.cbs.onprocessinginstruction) {
            var s = this.getInstructionName(i);
            this.cbs.onprocessinginstruction("!".concat(s), "!".concat(i));
        }
        this.startIndex = e + 1;
    }, i.prototype.onprocessinginstruction = function(t, e) {
        this.endIndex = e;
        var i = this.getSlice(t, e);
        if (this.cbs.onprocessinginstruction) {
            var s = this.getInstructionName(i);
            this.cbs.onprocessinginstruction("?".concat(s), "?".concat(i));
        }
        this.startIndex = e + 1;
    }, i.prototype.oncomment = function(t, e, i) {
        var s, n, o, r;
        this.endIndex = e, null === (n = (s = this.cbs).oncomment) || void 0 === n || n.call(s, this.getSlice(t, e - i)), 
        null === (r = (o = this.cbs).oncommentend) || void 0 === r || r.call(o), this.startIndex = e + 1;
    }, i.prototype.oncdata = function(t, e, i) {
        var s, n, o, r, a, h, l, c, d, u;
        this.endIndex = e;
        var p = this.getSlice(t, e - i);
        this.options.xmlMode || this.options.recognizeCDATA ? (null === (n = (s = this.cbs).oncdatastart) || void 0 === n || n.call(s), 
        null === (r = (o = this.cbs).ontext) || void 0 === r || r.call(o, p), null === (h = (a = this.cbs).oncdataend) || void 0 === h || h.call(a)) : (null === (c = (l = this.cbs).oncomment) || void 0 === c || c.call(l, "[CDATA[".concat(p, "]]")), 
        null === (u = (d = this.cbs).oncommentend) || void 0 === u || u.call(d)), this.startIndex = e + 1;
    }, i.prototype.onend = function() {
        var t, e;
        if (this.cbs.onclosetag) {
            this.endIndex = this.startIndex;
            for (var i = this.stack.length; i > 0; this.cbs.onclosetag(this.stack[--i], !0)) ;
        }
        null === (e = (t = this.cbs).onend) || void 0 === e || e.call(t);
    }, i.prototype.reset = function() {
        var t, e, i, s;
        null === (e = (t = this.cbs).onreset) || void 0 === e || e.call(t), this.tokenizer.reset(), 
        this.tagname = "", this.attribname = "", this.attribs = null, this.stack.length = 0, 
        this.startIndex = 0, this.endIndex = 0, null === (s = (i = this.cbs).onparserinit) || void 0 === s || s.call(i, this), 
        this.buffers.length = 0, this.bufferOffset = 0, this.writeIndex = 0, this.ended = !1;
    }, i.prototype.parseComplete = function(t) {
        this.reset(), this.end(t);
    }, i.prototype.getSlice = function(t, e) {
        for (;t - this.bufferOffset >= this.buffers[0].length; ) this.shiftBuffer();
        for (var i = this.buffers[0].slice(t - this.bufferOffset, e - this.bufferOffset); e - this.bufferOffset > this.buffers[0].length; ) this.shiftBuffer(), 
        i += this.buffers[0].slice(0, e - this.bufferOffset);
        return i;
    }, i.prototype.shiftBuffer = function() {
        this.bufferOffset += this.buffers[0].length, this.writeIndex--, this.buffers.shift();
    }, i.prototype.write = function(t) {
        var e, i;
        this.ended ? null === (i = (e = this.cbs).onerror) || void 0 === i || i.call(e, new Error(".write() after done!")) : (this.buffers.push(t), 
        this.tokenizer.running && (this.tokenizer.write(t), this.writeIndex++));
    }, i.prototype.end = function(t) {
        var e, i;
        this.ended ? null === (i = (e = this.cbs).onerror) || void 0 === i || i.call(e, Error(".end() after done!")) : (t && this.write(t), 
        this.ended = !0, this.tokenizer.end());
    }, i.prototype.pause = function() {
        this.tokenizer.pause();
    }, i.prototype.resume = function() {
        for (this.tokenizer.resume(); this.tokenizer.running && this.writeIndex < this.buffers.length; ) this.tokenizer.write(this.buffers[this.writeIndex++]);
        this.ended && this.tokenizer.end();
    }, i.prototype.parseChunk = function(t) {
        this.write(t);
    }, i.prototype.done = function(t) {
        this.end(t);
    }, i;
}();

module.exports = u;