Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var n = {
        literal: "true false null"
    }, t = [ e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE ], i = [ e.QUOTE_STRING_MODE, e.C_NUMBER_MODE ], l = {
        end: ",",
        endsWithParent: !0,
        excludeEnd: !0,
        contains: i,
        keywords: n
    }, a = {
        begin: "{",
        end: "}",
        contains: [ {
            className: "attr",
            begin: /"/,
            end: /"/,
            contains: [ e.BACKSLASH_ESCAPE ],
            illegal: "\\n"
        }, e.inherit(l, {
            begin: /:/
        }) ].concat(t),
        illegal: "\\S"
    }, s = {
        begin: "\\[",
        end: "\\]",
        contains: [ e.inherit(l) ],
        illegal: "\\S"
    };
    return i.push(a, s), t.forEach(function(e) {
        i.push(e);
    }), {
        name: "JSON",
        contains: i,
        keywords: n,
        illegal: "\\S"
    };
};