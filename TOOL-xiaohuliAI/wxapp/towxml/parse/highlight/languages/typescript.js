Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var n = {
        keyword: "in if for while finally var new function do return void else break catch instanceof with throw case default try this switch continue typeof delete let yield const class public private protected get set super static implements enum export import declare type namespace abstract as from extends async await",
        literal: "true false null undefined NaN Infinity",
        built_in: "eval isFinite isNaN parseFloat parseInt decodeURI decodeURIComponent encodeURI encodeURIComponent escape unescape Object Function Boolean Error EvalError InternalError RangeError ReferenceError StopIteration SyntaxError TypeError URIError Number Math Date String RegExp Array Float32Array Float64Array Int16Array Int32Array Int8Array Uint16Array Uint32Array Uint8Array Uint8ClampedArray ArrayBuffer DataView JSON Intl arguments require module console window document any number boolean string void Promise"
    }, r = {
        className: "meta",
        begin: "@[A-Za-z$_][0-9A-Za-z$_]*"
    }, a = {
        begin: "\\(",
        end: /\)/,
        keywords: n,
        contains: [ "self", e.QUOTE_STRING_MODE, e.APOS_STRING_MODE, e.NUMBER_MODE ]
    }, t = {
        className: "params",
        begin: /\(/,
        end: /\)/,
        excludeBegin: !0,
        excludeEnd: !0,
        keywords: n,
        contains: [ e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, r, a ]
    }, s = {
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
        keywords: n,
        contains: []
    }, o = {
        begin: "html`",
        end: "",
        starts: {
            end: "`",
            returnEnd: !1,
            contains: [ e.BACKSLASH_ESCAPE, i ],
            subLanguage: "xml"
        }
    }, c = {
        begin: "css`",
        end: "",
        starts: {
            end: "`",
            returnEnd: !1,
            contains: [ e.BACKSLASH_ESCAPE, i ],
            subLanguage: "css"
        }
    }, E = {
        className: "string",
        begin: "`",
        end: "`",
        contains: [ e.BACKSLASH_ESCAPE, i ]
    };
    return i.contains = [ e.APOS_STRING_MODE, e.QUOTE_STRING_MODE, o, c, E, s, e.REGEXP_MODE ], 
    {
        name: "TypeScript",
        aliases: [ "ts" ],
        keywords: n,
        contains: [ {
            className: "meta",
            begin: /^\s*['"]use strict['"]/
        }, e.APOS_STRING_MODE, e.QUOTE_STRING_MODE, o, c, E, e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, s, {
            begin: "(" + e.RE_STARTERS_RE + "|\\b(case|return|throw)\\b)\\s*",
            keywords: "return throw case",
            contains: [ e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, e.REGEXP_MODE, {
                className: "function",
                begin: "(\\(.*?\\)|" + e.IDENT_RE + ")\\s*=>",
                returnBegin: !0,
                end: "\\s*=>",
                contains: [ {
                    className: "params",
                    variants: [ {
                        begin: e.IDENT_RE
                    }, {
                        begin: /\(\s*\)/
                    }, {
                        begin: /\(/,
                        end: /\)/,
                        excludeBegin: !0,
                        excludeEnd: !0,
                        keywords: n,
                        contains: [ "self", e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE ]
                    } ]
                } ]
            } ],
            relevance: 0
        }, {
            className: "function",
            beginKeywords: "function",
            end: /[\{;]/,
            excludeEnd: !0,
            keywords: n,
            contains: [ "self", e.inherit(e.TITLE_MODE, {
                begin: "[A-Za-z$_][0-9A-Za-z$_]*"
            }), t ],
            illegal: /%/,
            relevance: 0
        }, {
            beginKeywords: "constructor",
            end: /[\{;]/,
            excludeEnd: !0,
            contains: [ "self", t ]
        }, {
            begin: /module\./,
            keywords: {
                built_in: "module"
            },
            relevance: 0
        }, {
            beginKeywords: "module",
            end: /\{/,
            excludeEnd: !0
        }, {
            beginKeywords: "interface",
            end: /\{/,
            excludeEnd: !0,
            keywords: "interface extends"
        }, {
            begin: /\$[(.]/
        }, {
            begin: "\\." + e.IDENT_RE,
            relevance: 0
        }, r, a ]
    };
};