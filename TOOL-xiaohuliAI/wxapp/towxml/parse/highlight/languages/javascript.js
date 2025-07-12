Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var n = {
        begin: "<>",
        end: "</>"
    }, a = {
        begin: /<[A-Za-z0-9\\._:-]+/,
        end: /\/[A-Za-z0-9\\._:-]+>|\/>/
    }, s = "[A-Za-z$_][0-9A-Za-z$_]*", r = {
        keyword: "in of if for while finally var new function do return void else break catch instanceof with throw case default try this switch continue typeof delete let yield const export super debugger as async await static import from as",
        literal: "true false null undefined NaN Infinity",
        built_in: "eval isFinite isNaN parseFloat parseInt decodeURI decodeURIComponent encodeURI encodeURIComponent escape unescape Object Function Boolean Error EvalError InternalError RangeError ReferenceError StopIteration SyntaxError TypeError URIError Number Math Date String RegExp Array Float32Array Float64Array Int16Array Int32Array Int8Array Uint16Array Uint32Array Uint8Array Uint8ClampedArray ArrayBuffer DataView JSON Intl arguments require module console window document Symbol Set Map WeakSet WeakMap Proxy Reflect Promise"
    }, t = {
        className: "number",
        variants: [ {
            begin: "\\b(0[bB][01]+)n?"
        }, {
            begin: "\\b(0[oO][0-7]+)n?"
        }, {
            begin: e.C_NUMBER_RE + "n?"
        } ],
        relevance: 0
    }, i = {
        className: "subst",
        begin: "\\$\\{",
        end: "\\}",
        keywords: r,
        contains: []
    }, c = {
        begin: "html`",
        end: "",
        starts: {
            end: "`",
            returnEnd: !1,
            contains: [ e.BACKSLASH_ESCAPE, i ],
            subLanguage: "xml"
        }
    }, o = {
        begin: "css`",
        end: "",
        starts: {
            end: "`",
            returnEnd: !1,
            contains: [ e.BACKSLASH_ESCAPE, i ],
            subLanguage: "css"
        }
    }, l = {
        className: "string",
        begin: "`",
        end: "`",
        contains: [ e.BACKSLASH_ESCAPE, i ]
    };
    i.contains = [ e.APOS_STRING_MODE, e.QUOTE_STRING_MODE, c, o, l, t, e.REGEXP_MODE ];
    var d = i.contains.concat([ e.C_BLOCK_COMMENT_MODE, e.C_LINE_COMMENT_MODE ]), E = {
        className: "params",
        begin: /\(/,
        end: /\)/,
        excludeBegin: !0,
        excludeEnd: !0,
        contains: d
    };
    return {
        name: "JavaScript",
        aliases: [ "js", "jsx", "mjs", "cjs" ],
        keywords: r,
        contains: [ {
            className: "meta",
            relevance: 10,
            begin: /^\s*['"]use (strict|asm)['"]/
        }, {
            className: "meta",
            begin: /^#!/,
            end: /$/
        }, e.APOS_STRING_MODE, e.QUOTE_STRING_MODE, c, o, l, e.C_LINE_COMMENT_MODE, e.COMMENT("/\\*\\*", "\\*/", {
            relevance: 0,
            contains: [ {
                className: "doctag",
                begin: "@[A-Za-z]+",
                contains: [ {
                    className: "type",
                    begin: "\\{",
                    end: "\\}",
                    relevance: 0
                }, {
                    className: "variable",
                    begin: s + "(?=\\s*(-)|$)",
                    endsParent: !0,
                    relevance: 0
                }, {
                    begin: /(?=[^\n])\s/,
                    relevance: 0
                } ]
            } ]
        }), e.C_BLOCK_COMMENT_MODE, t, {
            begin: /[{,\n]\s*/,
            relevance: 0,
            contains: [ {
                begin: s + "\\s*:",
                returnBegin: !0,
                relevance: 0,
                contains: [ {
                    className: "attr",
                    begin: s,
                    relevance: 0
                } ]
            } ]
        }, {
            begin: "(" + e.RE_STARTERS_RE + "|\\b(case|return|throw)\\b)\\s*",
            keywords: "return throw case",
            contains: [ e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, e.REGEXP_MODE, {
                className: "function",
                begin: "(\\(.*?\\)|" + s + ")\\s*=>",
                returnBegin: !0,
                end: "\\s*=>",
                contains: [ {
                    className: "params",
                    variants: [ {
                        begin: s
                    }, {
                        begin: /\(\s*\)/
                    }, {
                        begin: /\(/,
                        end: /\)/,
                        excludeBegin: !0,
                        excludeEnd: !0,
                        keywords: r,
                        contains: d
                    } ]
                } ]
            }, {
                begin: /,/,
                relevance: 0
            }, {
                className: "",
                begin: /\s/,
                end: /\s*/,
                skip: !0
            }, {
                variants: [ {
                    begin: n.begin,
                    end: n.end
                }, {
                    begin: a.begin,
                    end: a.end
                } ],
                subLanguage: "xml",
                contains: [ {
                    begin: a.begin,
                    end: a.end,
                    skip: !0,
                    contains: [ "self" ]
                } ]
            } ],
            relevance: 0
        }, {
            className: "function",
            beginKeywords: "function",
            end: /\{/,
            excludeEnd: !0,
            contains: [ e.inherit(e.TITLE_MODE, {
                begin: s
            }), E ],
            illegal: /\[|%/
        }, {
            begin: /\$[(.]/
        }, e.METHOD_GUARD, {
            className: "class",
            beginKeywords: "class",
            end: /[{;=]/,
            excludeEnd: !0,
            illegal: /[:"\[\]]/,
            contains: [ {
                beginKeywords: "extends"
            }, e.UNDERSCORE_TITLE_MODE ]
        }, {
            beginKeywords: "constructor",
            end: /\{/,
            excludeEnd: !0
        }, {
            begin: "(get|set)\\s*(?=" + s + "\\()",
            end: /{/,
            keywords: "get set",
            contains: [ e.inherit(e.TITLE_MODE, {
                begin: s
            }), {
                begin: /\(\)/
            }, E ]
        } ],
        illegal: /#(?!!)/
    };
};