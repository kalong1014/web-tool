var t, e, i, s = require("./entities/decode.js");

function n(e) {
    return e === t.Space || e === t.NewLine || e === t.Tab || e === t.FormFeed || e === t.CarriageReturn;
}

function a(e) {
    return e === t.Slash || e === t.Gt || n(e);
}

function r(e) {
    return e >= t.Zero && e <= t.Nine;
}

!function(t) {
    t[t.Tab = 9] = "Tab", t[t.NewLine = 10] = "NewLine", t[t.FormFeed = 12] = "FormFeed", 
    t[t.CarriageReturn = 13] = "CarriageReturn", t[t.Space = 32] = "Space", t[t.ExclamationMark = 33] = "ExclamationMark", 
    t[t.Num = 35] = "Num", t[t.Amp = 38] = "Amp", t[t.SingleQuote = 39] = "SingleQuote", 
    t[t.DoubleQuote = 34] = "DoubleQuote", t[t.Dash = 45] = "Dash", t[t.Slash = 47] = "Slash", 
    t[t.Zero = 48] = "Zero", t[t.Nine = 57] = "Nine", t[t.Semi = 59] = "Semi", t[t.Lt = 60] = "Lt", 
    t[t.Eq = 61] = "Eq", t[t.Gt = 62] = "Gt", t[t.Questionmark = 63] = "Questionmark", 
    t[t.UpperA = 65] = "UpperA", t[t.LowerA = 97] = "LowerA", t[t.UpperF = 70] = "UpperF", 
    t[t.LowerF = 102] = "LowerF", t[t.UpperZ = 90] = "UpperZ", t[t.LowerZ = 122] = "LowerZ", 
    t[t.LowerX = 120] = "LowerX", t[t.OpeningSquareBracket = 91] = "OpeningSquareBracket";
}(t || (t = {})), function(t) {
    t[t.Text = 1] = "Text", t[t.BeforeTagName = 2] = "BeforeTagName", t[t.InTagName = 3] = "InTagName", 
    t[t.InSelfClosingTag = 4] = "InSelfClosingTag", t[t.BeforeClosingTagName = 5] = "BeforeClosingTagName", 
    t[t.InClosingTagName = 6] = "InClosingTagName", t[t.AfterClosingTagName = 7] = "AfterClosingTagName", 
    t[t.BeforeAttributeName = 8] = "BeforeAttributeName", t[t.InAttributeName = 9] = "InAttributeName", 
    t[t.AfterAttributeName = 10] = "AfterAttributeName", t[t.BeforeAttributeValue = 11] = "BeforeAttributeValue", 
    t[t.InAttributeValueDq = 12] = "InAttributeValueDq", t[t.InAttributeValueSq = 13] = "InAttributeValueSq", 
    t[t.InAttributeValueNq = 14] = "InAttributeValueNq", t[t.BeforeDeclaration = 15] = "BeforeDeclaration", 
    t[t.InDeclaration = 16] = "InDeclaration", t[t.InProcessingInstruction = 17] = "InProcessingInstruction", 
    t[t.BeforeComment = 18] = "BeforeComment", t[t.CDATASequence = 19] = "CDATASequence", 
    t[t.InSpecialComment = 20] = "InSpecialComment", t[t.InCommentLike = 21] = "InCommentLike", 
    t[t.BeforeSpecialS = 22] = "BeforeSpecialS", t[t.SpecialStartSequence = 23] = "SpecialStartSequence", 
    t[t.InSpecialTag = 24] = "InSpecialTag", t[t.BeforeEntity = 25] = "BeforeEntity", 
    t[t.BeforeNumericEntity = 26] = "BeforeNumericEntity", t[t.InNamedEntity = 27] = "InNamedEntity", 
    t[t.InNumericEntity = 28] = "InNumericEntity", t[t.InHexEntity = 29] = "InHexEntity";
}(e || (e = {})), function(t) {
    t[t.NoValue = 0] = "NoValue", t[t.Unquoted = 1] = "Unquoted", t[t.Single = 2] = "Single", 
    t[t.Double = 3] = "Double";
}(i = exports.QuoteType || (exports.QuoteType = {}));

var o = {
    Cdata: new Uint8Array([ 67, 68, 65, 84, 65, 91 ]),
    CdataEnd: new Uint8Array([ 93, 93, 62 ]),
    CommentEnd: new Uint8Array([ 45, 45, 62 ]),
    ScriptEnd: new Uint8Array([ 60, 47, 115, 99, 114, 105, 112, 116 ]),
    StyleEnd: new Uint8Array([ 60, 47, 115, 116, 121, 108, 101 ]),
    TitleEnd: new Uint8Array([ 60, 47, 116, 105, 116, 108, 101 ])
}, h = function() {
    function h(t, i) {
        var n = t.xmlMode, a = void 0 !== n && n, r = t.decodeEntities, o = void 0 === r || r;
        this.cbs = i, this.state = e.Text, this.buffer = "", this.sectionStart = 0, this.index = 0, 
        this.baseState = e.Text, this.isSpecial = !1, this.running = !0, this.offset = 0, 
        this.sequenceIndex = 0, this.trieIndex = 0, this.trieCurrent = 0, this.entityResult = 0, 
        this.entityExcess = 0, this.xmlMode = a, this.decodeEntities = o, this.entityTrie = a ? s.xmlDecodeTree : s.htmlDecodeTree;
    }
    return h.prototype.reset = function() {
        this.state = e.Text, this.buffer = "", this.sectionStart = 0, this.index = 0, this.baseState = e.Text, 
        this.currentSequence = void 0, this.running = !0, this.offset = 0;
    }, h.prototype.write = function(t) {
        this.offset += this.buffer.length, this.buffer = t, this.parse();
    }, h.prototype.end = function() {
        this.running && this.finish();
    }, h.prototype.pause = function() {
        this.running = !1;
    }, h.prototype.resume = function() {
        this.running = !0, this.index < this.buffer.length + this.offset && this.parse();
    }, h.prototype.getIndex = function() {
        return this.index;
    }, h.prototype.getSectionStart = function() {
        return this.sectionStart;
    }, h.prototype.stateText = function(i) {
        i === t.Lt || !this.decodeEntities && this.fastForwardTo(t.Lt) ? (this.index > this.sectionStart && this.cbs.ontext(this.sectionStart, this.index), 
        this.state = e.BeforeTagName, this.sectionStart = this.index) : this.decodeEntities && i === t.Amp && (this.state = e.BeforeEntity);
    }, h.prototype.stateSpecialStartSequence = function(t) {
        var i = this.sequenceIndex === this.currentSequence.length;
        if (i ? a(t) : (32 | t) === this.currentSequence[this.sequenceIndex]) {
            if (!i) return void this.sequenceIndex++;
        } else this.isSpecial = !1;
        this.sequenceIndex = 0, this.state = e.InTagName, this.stateInTagName(t);
    }, h.prototype.stateInSpecialTag = function(i) {
        if (this.sequenceIndex === this.currentSequence.length) {
            if (i === t.Gt || n(i)) {
                var s = this.index - this.currentSequence.length;
                if (this.sectionStart < s) {
                    var a = this.index;
                    this.index = s, this.cbs.ontext(this.sectionStart, s), this.index = a;
                }
                return this.isSpecial = !1, this.sectionStart = s + 2, void this.stateInClosingTagName(i);
            }
            this.sequenceIndex = 0;
        }
        (32 | i) === this.currentSequence[this.sequenceIndex] ? this.sequenceIndex += 1 : 0 === this.sequenceIndex ? this.currentSequence === o.TitleEnd ? this.decodeEntities && i === t.Amp && (this.state = e.BeforeEntity) : this.fastForwardTo(t.Lt) && (this.sequenceIndex = 1) : this.sequenceIndex = Number(i === t.Lt);
    }, h.prototype.stateCDATASequence = function(t) {
        t === o.Cdata[this.sequenceIndex] ? ++this.sequenceIndex === o.Cdata.length && (this.state = e.InCommentLike, 
        this.currentSequence = o.CdataEnd, this.sequenceIndex = 0, this.sectionStart = this.index + 1) : (this.sequenceIndex = 0, 
        this.state = e.InDeclaration, this.stateInDeclaration(t));
    }, h.prototype.fastForwardTo = function(t) {
        for (;++this.index < this.buffer.length + this.offset; ) if (this.buffer.charCodeAt(this.index - this.offset) === t) return !0;
        return this.index = this.buffer.length + this.offset - 1, !1;
    }, h.prototype.stateInCommentLike = function(t) {
        t === this.currentSequence[this.sequenceIndex] ? ++this.sequenceIndex === this.currentSequence.length && (this.currentSequence === o.CdataEnd ? this.cbs.oncdata(this.sectionStart, this.index, 2) : this.cbs.oncomment(this.sectionStart, this.index, 2), 
        this.sequenceIndex = 0, this.sectionStart = this.index + 1, this.state = e.Text) : 0 === this.sequenceIndex ? this.fastForwardTo(this.currentSequence[0]) && (this.sequenceIndex = 1) : t !== this.currentSequence[this.sequenceIndex - 1] && (this.sequenceIndex = 0);
    }, h.prototype.isTagStartChar = function(e) {
        return this.xmlMode ? !a(e) : function(e) {
            return e >= t.LowerA && e <= t.LowerZ || e >= t.UpperA && e <= t.UpperZ;
        }(e);
    }, h.prototype.startSpecial = function(t, i) {
        this.isSpecial = !0, this.currentSequence = t, this.sequenceIndex = i, this.state = e.SpecialStartSequence;
    }, h.prototype.stateBeforeTagName = function(i) {
        if (i === t.ExclamationMark) this.state = e.BeforeDeclaration, this.sectionStart = this.index + 1; else if (i === t.Questionmark) this.state = e.InProcessingInstruction, 
        this.sectionStart = this.index + 1; else if (this.isTagStartChar(i)) {
            var s = 32 | i;
            this.sectionStart = this.index, this.xmlMode || s !== o.TitleEnd[2] ? this.state = this.xmlMode || s !== o.ScriptEnd[2] ? e.InTagName : e.BeforeSpecialS : this.startSpecial(o.TitleEnd, 3);
        } else i === t.Slash ? this.state = e.BeforeClosingTagName : (this.state = e.Text, 
        this.stateText(i));
    }, h.prototype.stateInTagName = function(t) {
        a(t) && (this.cbs.onopentagname(this.sectionStart, this.index), this.sectionStart = -1, 
        this.state = e.BeforeAttributeName, this.stateBeforeAttributeName(t));
    }, h.prototype.stateBeforeClosingTagName = function(i) {
        n(i) || (i === t.Gt ? this.state = e.Text : (this.state = this.isTagStartChar(i) ? e.InClosingTagName : e.InSpecialComment, 
        this.sectionStart = this.index));
    }, h.prototype.stateInClosingTagName = function(i) {
        (i === t.Gt || n(i)) && (this.cbs.onclosetag(this.sectionStart, this.index), this.sectionStart = -1, 
        this.state = e.AfterClosingTagName, this.stateAfterClosingTagName(i));
    }, h.prototype.stateAfterClosingTagName = function(i) {
        (i === t.Gt || this.fastForwardTo(t.Gt)) && (this.state = e.Text, this.sectionStart = this.index + 1);
    }, h.prototype.stateBeforeAttributeName = function(i) {
        i === t.Gt ? (this.cbs.onopentagend(this.index), this.isSpecial ? (this.state = e.InSpecialTag, 
        this.sequenceIndex = 0) : this.state = e.Text, this.baseState = this.state, this.sectionStart = this.index + 1) : i === t.Slash ? this.state = e.InSelfClosingTag : n(i) || (this.state = e.InAttributeName, 
        this.sectionStart = this.index);
    }, h.prototype.stateInSelfClosingTag = function(i) {
        i === t.Gt ? (this.cbs.onselfclosingtag(this.index), this.state = e.Text, this.baseState = e.Text, 
        this.sectionStart = this.index + 1, this.isSpecial = !1) : n(i) || (this.state = e.BeforeAttributeName, 
        this.stateBeforeAttributeName(i));
    }, h.prototype.stateInAttributeName = function(i) {
        (i === t.Eq || a(i)) && (this.cbs.onattribname(this.sectionStart, this.index), this.sectionStart = -1, 
        this.state = e.AfterAttributeName, this.stateAfterAttributeName(i));
    }, h.prototype.stateAfterAttributeName = function(s) {
        s === t.Eq ? this.state = e.BeforeAttributeValue : s === t.Slash || s === t.Gt ? (this.cbs.onattribend(i.NoValue, this.index), 
        this.state = e.BeforeAttributeName, this.stateBeforeAttributeName(s)) : n(s) || (this.cbs.onattribend(i.NoValue, this.index), 
        this.state = e.InAttributeName, this.sectionStart = this.index);
    }, h.prototype.stateBeforeAttributeValue = function(i) {
        i === t.DoubleQuote ? (this.state = e.InAttributeValueDq, this.sectionStart = this.index + 1) : i === t.SingleQuote ? (this.state = e.InAttributeValueSq, 
        this.sectionStart = this.index + 1) : n(i) || (this.sectionStart = this.index, this.state = e.InAttributeValueNq, 
        this.stateInAttributeValueNoQuotes(i));
    }, h.prototype.handleInAttributeValue = function(s, n) {
        s === n || !this.decodeEntities && this.fastForwardTo(n) ? (this.cbs.onattribdata(this.sectionStart, this.index), 
        this.sectionStart = -1, this.cbs.onattribend(n === t.DoubleQuote ? i.Double : i.Single, this.index), 
        this.state = e.BeforeAttributeName) : this.decodeEntities && s === t.Amp && (this.baseState = this.state, 
        this.state = e.BeforeEntity);
    }, h.prototype.stateInAttributeValueDoubleQuotes = function(e) {
        this.handleInAttributeValue(e, t.DoubleQuote);
    }, h.prototype.stateInAttributeValueSingleQuotes = function(e) {
        this.handleInAttributeValue(e, t.SingleQuote);
    }, h.prototype.stateInAttributeValueNoQuotes = function(s) {
        n(s) || s === t.Gt ? (this.cbs.onattribdata(this.sectionStart, this.index), this.sectionStart = -1, 
        this.cbs.onattribend(i.Unquoted, this.index), this.state = e.BeforeAttributeName, 
        this.stateBeforeAttributeName(s)) : this.decodeEntities && s === t.Amp && (this.baseState = this.state, 
        this.state = e.BeforeEntity);
    }, h.prototype.stateBeforeDeclaration = function(i) {
        i === t.OpeningSquareBracket ? (this.state = e.CDATASequence, this.sequenceIndex = 0) : this.state = i === t.Dash ? e.BeforeComment : e.InDeclaration;
    }, h.prototype.stateInDeclaration = function(i) {
        (i === t.Gt || this.fastForwardTo(t.Gt)) && (this.cbs.ondeclaration(this.sectionStart, this.index), 
        this.state = e.Text, this.sectionStart = this.index + 1);
    }, h.prototype.stateInProcessingInstruction = function(i) {
        (i === t.Gt || this.fastForwardTo(t.Gt)) && (this.cbs.onprocessinginstruction(this.sectionStart, this.index), 
        this.state = e.Text, this.sectionStart = this.index + 1);
    }, h.prototype.stateBeforeComment = function(i) {
        i === t.Dash ? (this.state = e.InCommentLike, this.currentSequence = o.CommentEnd, 
        this.sequenceIndex = 2, this.sectionStart = this.index + 1) : this.state = e.InDeclaration;
    }, h.prototype.stateInSpecialComment = function(i) {
        (i === t.Gt || this.fastForwardTo(t.Gt)) && (this.cbs.oncomment(this.sectionStart, this.index, 0), 
        this.state = e.Text, this.sectionStart = this.index + 1);
    }, h.prototype.stateBeforeSpecialS = function(t) {
        var i = 32 | t;
        i === o.ScriptEnd[3] ? this.startSpecial(o.ScriptEnd, 4) : i === o.StyleEnd[3] ? this.startSpecial(o.StyleEnd, 4) : (this.state = e.InTagName, 
        this.stateInTagName(t));
    }, h.prototype.stateBeforeEntity = function(i) {
        this.entityExcess = 1, this.entityResult = 0, i === t.Num ? this.state = e.BeforeNumericEntity : i === t.Amp || (this.trieIndex = 0, 
        this.trieCurrent = this.entityTrie[0], this.state = e.InNamedEntity, this.stateInNamedEntity(i));
    }, h.prototype.stateInNamedEntity = function(e) {
        if (this.entityExcess += 1, this.trieIndex = (0, s.determineBranch)(this.entityTrie, this.trieCurrent, this.trieIndex + 1, e), 
        this.trieIndex < 0) return this.emitNamedEntity(), void this.index--;
        this.trieCurrent = this.entityTrie[this.trieIndex];
        var i = this.trieCurrent & s.BinTrieFlags.VALUE_LENGTH;
        if (i) {
            var n = (i >> 14) - 1;
            if (this.allowLegacyEntity() || e === t.Semi) {
                var a = this.index - this.entityExcess + 1;
                a > this.sectionStart && this.emitPartial(this.sectionStart, a), this.entityResult = this.trieIndex, 
                this.trieIndex += n, this.entityExcess = 0, this.sectionStart = this.index + 1, 
                0 === n && this.emitNamedEntity();
            } else this.trieIndex += n;
        }
    }, h.prototype.emitNamedEntity = function() {
        if (this.state = this.baseState, 0 !== this.entityResult) switch ((this.entityTrie[this.entityResult] & s.BinTrieFlags.VALUE_LENGTH) >> 14) {
          case 1:
            this.emitCodePoint(this.entityTrie[this.entityResult] & ~s.BinTrieFlags.VALUE_LENGTH);
            break;

          case 2:
            this.emitCodePoint(this.entityTrie[this.entityResult + 1]);
            break;

          case 3:
            this.emitCodePoint(this.entityTrie[this.entityResult + 1]), this.emitCodePoint(this.entityTrie[this.entityResult + 2]);
        }
    }, h.prototype.stateBeforeNumericEntity = function(i) {
        (32 | i) === t.LowerX ? (this.entityExcess++, this.state = e.InHexEntity) : (this.state = e.InNumericEntity, 
        this.stateInNumericEntity(i));
    }, h.prototype.emitNumericEntity = function(t) {
        var i = this.index - this.entityExcess - 1;
        i + 2 + Number(this.state === e.InHexEntity) !== this.index && (i > this.sectionStart && this.emitPartial(this.sectionStart, i), 
        this.sectionStart = this.index + Number(t), this.emitCodePoint((0, s.replaceCodePoint)(this.entityResult))), 
        this.state = this.baseState;
    }, h.prototype.stateInNumericEntity = function(e) {
        e === t.Semi ? this.emitNumericEntity(!0) : r(e) ? (this.entityResult = 10 * this.entityResult + (e - t.Zero), 
        this.entityExcess++) : (this.allowLegacyEntity() ? this.emitNumericEntity(!1) : this.state = this.baseState, 
        this.index--);
    }, h.prototype.stateInHexEntity = function(e) {
        e === t.Semi ? this.emitNumericEntity(!0) : r(e) ? (this.entityResult = 16 * this.entityResult + (e - t.Zero), 
        this.entityExcess++) : !function(e) {
            return e >= t.UpperA && e <= t.UpperF || e >= t.LowerA && e <= t.LowerF;
        }(e) ? (this.allowLegacyEntity() ? this.emitNumericEntity(!1) : this.state = this.baseState, 
        this.index--) : (this.entityResult = 16 * this.entityResult + ((32 | e) - t.LowerA + 10), 
        this.entityExcess++);
    }, h.prototype.allowLegacyEntity = function() {
        return !this.xmlMode && (this.baseState === e.Text || this.baseState === e.InSpecialTag);
    }, h.prototype.cleanup = function() {
        this.running && this.sectionStart !== this.index && (this.state === e.Text || this.state === e.InSpecialTag && 0 === this.sequenceIndex ? (this.cbs.ontext(this.sectionStart, this.index), 
        this.sectionStart = this.index) : this.state !== e.InAttributeValueDq && this.state !== e.InAttributeValueSq && this.state !== e.InAttributeValueNq || (this.cbs.onattribdata(this.sectionStart, this.index), 
        this.sectionStart = this.index));
    }, h.prototype.shouldContinue = function() {
        return this.index < this.buffer.length + this.offset && this.running;
    }, h.prototype.parse = function() {
        for (;this.shouldContinue(); ) {
            var t = this.buffer.charCodeAt(this.index - this.offset);
            this.state === e.Text ? this.stateText(t) : this.state === e.SpecialStartSequence ? this.stateSpecialStartSequence(t) : this.state === e.InSpecialTag ? this.stateInSpecialTag(t) : this.state === e.CDATASequence ? this.stateCDATASequence(t) : this.state === e.InAttributeValueDq ? this.stateInAttributeValueDoubleQuotes(t) : this.state === e.InAttributeName ? this.stateInAttributeName(t) : this.state === e.InCommentLike ? this.stateInCommentLike(t) : this.state === e.InSpecialComment ? this.stateInSpecialComment(t) : this.state === e.BeforeAttributeName ? this.stateBeforeAttributeName(t) : this.state === e.InTagName ? this.stateInTagName(t) : this.state === e.InClosingTagName ? this.stateInClosingTagName(t) : this.state === e.BeforeTagName ? this.stateBeforeTagName(t) : this.state === e.AfterAttributeName ? this.stateAfterAttributeName(t) : this.state === e.InAttributeValueSq ? this.stateInAttributeValueSingleQuotes(t) : this.state === e.BeforeAttributeValue ? this.stateBeforeAttributeValue(t) : this.state === e.BeforeClosingTagName ? this.stateBeforeClosingTagName(t) : this.state === e.AfterClosingTagName ? this.stateAfterClosingTagName(t) : this.state === e.BeforeSpecialS ? this.stateBeforeSpecialS(t) : this.state === e.InAttributeValueNq ? this.stateInAttributeValueNoQuotes(t) : this.state === e.InSelfClosingTag ? this.stateInSelfClosingTag(t) : this.state === e.InDeclaration ? this.stateInDeclaration(t) : this.state === e.BeforeDeclaration ? this.stateBeforeDeclaration(t) : this.state === e.BeforeComment ? this.stateBeforeComment(t) : this.state === e.InProcessingInstruction ? this.stateInProcessingInstruction(t) : this.state === e.InNamedEntity ? this.stateInNamedEntity(t) : this.state === e.BeforeEntity ? this.stateBeforeEntity(t) : this.state === e.InHexEntity ? this.stateInHexEntity(t) : this.state === e.InNumericEntity ? this.stateInNumericEntity(t) : this.stateBeforeNumericEntity(t), 
            this.index++;
        }
        this.cleanup();
    }, h.prototype.finish = function() {
        this.state === e.InNamedEntity && this.emitNamedEntity(), this.sectionStart < this.index && this.handleTrailingData(), 
        this.cbs.onend();
    }, h.prototype.handleTrailingData = function() {
        var t = this.buffer.length + this.offset;
        this.state === e.InCommentLike ? this.currentSequence === o.CdataEnd ? this.cbs.oncdata(this.sectionStart, t, 0) : this.cbs.oncomment(this.sectionStart, t, 0) : this.state === e.InNumericEntity && this.allowLegacyEntity() || this.state === e.InHexEntity && this.allowLegacyEntity() ? this.emitNumericEntity(!1) : this.state === e.InTagName || this.state === e.BeforeAttributeName || this.state === e.BeforeAttributeValue || this.state === e.AfterAttributeName || this.state === e.InAttributeName || this.state === e.InAttributeValueSq || this.state === e.InAttributeValueDq || this.state === e.InAttributeValueNq || this.state === e.InClosingTagName || this.cbs.ontext(this.sectionStart, t);
    }, h.prototype.emitPartial = function(t, i) {
        this.baseState !== e.Text && this.baseState !== e.InSpecialTag ? this.cbs.onattribdata(t, i) : this.cbs.ontext(t, i);
    }, h.prototype.emitCodePoint = function(t) {
        this.baseState !== e.Text && this.baseState !== e.InSpecialTag ? this.cbs.onattribentity(t) : this.cbs.ontextentity(t);
    }, h;
}();

module.exports = {
    default: h,
    QuoteType: i
};