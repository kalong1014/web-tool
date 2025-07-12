require("../../../config");

function e(e, r) {
    var n, t, c = e.posMax, i = !0, o = !0;
    return n = r > 0 ? e.src.charCodeAt(r - 1) : -1, t = r + 1 <= c ? e.src.charCodeAt(r + 1) : -1, 
    (32 === n || 9 === n || t >= 48 && t <= 57) && (o = !1), 32 !== t && 9 !== t || (i = !1), 
    {
        can_open: i,
        can_close: o
    };
}

function r(r, n) {
    var t, c, i, o;
    if ("$" !== r.src[r.pos]) return !1;
    if (!e(r, r.pos).can_open) return n || (r.pending += "$"), r.pos += 1, !0;
    for (c = t = r.pos + 1; -1 !== (c = r.src.indexOf("$", c)); ) {
        for (o = c - 1; "\\" === r.src[o]; ) o -= 1;
        if ((c - o) % 2 == 1) break;
        c += 1;
    }
    return -1 === c ? (n || (r.pending += "$"), r.pos = t, !0) : c - t == 0 ? (n || (r.pending += "$$"), 
    r.pos = t + 1, !0) : e(r, c).can_close ? (n || ((i = r.push("math_inline", "math", 0)).markup = "$", 
    i.content = r.src.slice(t, c)), r.pos = c + 1, !0) : (n || (r.pending += "$"), r.pos = t, 
    !0);
}

function n(e, r, n, t) {
    var c, i, o, s, a, l = !1, u = e.bMarks[r] + e.tShift[r], p = e.eMarks[r];
    if (u + 2 > p) return !1;
    if ("$$" !== e.src.slice(u, u + 2)) return !1;
    if (u += 2, c = e.src.slice(u, p), t) return !0;
    for ("$$" === c.trim().slice(-2) && (c = c.trim().slice(0, -2), l = !0), o = r; !l && !(++o >= n) && !((u = e.bMarks[o] + e.tShift[o]) < (p = e.eMarks[o]) && e.tShift[o] < e.blkIndent); ) "$$" === e.src.slice(u, p).trim().slice(-2) && (s = e.src.slice(0, p).lastIndexOf("$$"), 
    i = e.src.slice(u, s), l = !0);
    return e.line = o + 1, (a = e.push("math_block", "math", 0)).block = !0, a.content = (c && c.trim() ? c + "\n" : "") + e.getLines(r + 1, o, e.tShift[r], !0) + (i && i.trim() ? i : ""), 
    a.map = [ r, e.line ], a.markup = "$$", !0;
}

module.exports = function(e) {
    e.inline.ruler.after("escape", "math_inline", r), e.block.ruler.after("blockquote", "math_block", n, {
        alt: [ "paragraph", "reference", "blockquote", "list" ]
    }), e.renderer.rules.math_inline = function(e, r) {
        return '<latex value="'.concat(encodeURIComponent(e[r].content).replace(/'/g, "%27"), '" type="line"></latex>');
    }, e.renderer.rules.math_block = function(e, r) {
        return '<latex value="'.concat(encodeURIComponent(e[r].content).replace(/'/g, "%27"), '" type="block"></latex>');
    };
};