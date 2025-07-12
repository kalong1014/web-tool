var t;

Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.Doctype = exports.CDATA = exports.Tag = exports.Style = exports.Script = exports.Comment = exports.Directive = exports.Text = exports.Root = exports.isTag = exports.ElementType = void 0, 
function(t) {
    t.Root = "root", t.Text = "text", t.Directive = "directive", t.Comment = "comment", 
    t.Script = "script", t.Style = "style", t.Tag = "tag", t.CDATA = "cdata", t.Doctype = "doctype";
}(t = exports.ElementType || (exports.ElementType = {})), exports.isTag = function(e) {
    return e.type === t.Tag || e.type === t.Script || e.type === t.Style;
}, exports.Root = t.Root, exports.Text = t.Text, exports.Directive = t.Directive, 
exports.Comment = t.Comment, exports.Script = t.Script, exports.Style = t.Style, 
exports.Tag = t.Tag, exports.CDATA = t.CDATA, exports.Doctype = t.Doctype;