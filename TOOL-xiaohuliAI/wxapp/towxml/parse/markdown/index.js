var e;

e = require("../highlight/index");

var r, n = require("../../config"), i = (r = {
    html: !0,
    xhtmlOut: !0,
    typographer: !0,
    breaks: !0
}, n.highlight.length && e && (r.highlight = function(r, i, u) {
    var t = r.split(/\r|\n/gi).length, l = e.highlightAuto(r).value;
    return l = (l = (l = l.replace(/(\r|\n){2,}/g, function(e) {
        return new Array(e.length).join("<p>&nbsp;</p>");
    })).replace(/\r|\n/g, function(e) {
        return "<br/>";
    })).replace(/>[^<]+</g, function(e) {
        return e.replace(/\s/g, "&nbsp;");
    }).replace(/\t/g, new Array(4).join("&nbsp;")), n.showLineNumber ? function() {
        for (var e = '<ul class="h2w__lineNum">', r = 0; r < t - 1; r++) e += '<li class="h2w__lineNumLine">'.concat(r + 1, "</li>");
        return e += "</ul>";
    }() + l : l;
}), r), u = require("./markdown")(i);

u.use(require("./plugins/sub")), u.use(require("./plugins/sup")), u.use(require("./plugins/ins")), 
u.use(require("./plugins/mark")), u.use(require("./plugins/emoji")), u.use(require("./plugins/todo")), 
u.use(require("./plugins/latex")), u.renderer.rules.emoji = function(e, r) {
    var n = e[r];
    return '<g-emoji class="h2w__emoji h2w__emoji--'.concat(n.markup, '">').concat(n.content, "</g-emoji>");
}, module.exports = function(e) {
    return u.render(e);
};