Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var n = {
        keyword: "and elif is global as in if from raise for except finally print import pass return exec else break not with class assert yield try while continue del or def lambda async await nonlocal|10",
        built_in: "Ellipsis NotImplemented",
        literal: "False None True"
    }, a = {
        className: "meta",
        begin: /^(>>>|\.\.\.) /
    }, i = {
        className: "subst",
        begin: /\{/,
        end: /\}/,
        keywords: n,
        illegal: /#/
    }, s = {
        begin: /\{\{/,
        relevance: 0
    }, r = {
        className: "string",
        contains: [ e.BACKSLASH_ESCAPE ],
        variants: [ {
            begin: /(u|b)?r?'''/,
            end: /'''/,
            contains: [ e.BACKSLASH_ESCAPE, a ],
            relevance: 10
        }, {
            begin: /(u|b)?r?"""/,
            end: /"""/,
            contains: [ e.BACKSLASH_ESCAPE, a ],
            relevance: 10
        }, {
            begin: /(fr|rf|f)'''/,
            end: /'''/,
            contains: [ e.BACKSLASH_ESCAPE, a, s, i ]
        }, {
            begin: /(fr|rf|f)"""/,
            end: /"""/,
            contains: [ e.BACKSLASH_ESCAPE, a, s, i ]
        }, {
            begin: /(u|r|ur)'/,
            end: /'/,
            relevance: 10
        }, {
            begin: /(u|r|ur)"/,
            end: /"/,
            relevance: 10
        }, {
            begin: /(b|br)'/,
            end: /'/
        }, {
            begin: /(b|br)"/,
            end: /"/
        }, {
            begin: /(fr|rf|f)'/,
            end: /'/,
            contains: [ e.BACKSLASH_ESCAPE, s, i ]
        }, {
            begin: /(fr|rf|f)"/,
            end: /"/,
            contains: [ e.BACKSLASH_ESCAPE, s, i ]
        }, e.APOS_STRING_MODE, e.QUOTE_STRING_MODE ]
    }, l = {
        className: "number",
        relevance: 0,
        variants: [ {
            begin: e.BINARY_NUMBER_RE + "[lLjJ]?"
        }, {
            begin: "\\b(0o[0-7]+)[lLjJ]?"
        }, {
            begin: e.C_NUMBER_RE + "[lLjJ]?"
        } ]
    }, t = {
        className: "params",
        begin: /\(/,
        end: /\)/,
        contains: [ "self", a, l, r, e.HASH_COMMENT_MODE ]
    };
    return i.contains = [ r, l, a ], {
        name: "Python",
        aliases: [ "py", "gyp", "ipython" ],
        keywords: n,
        illegal: /(<\/|->|\?)|=>/,
        contains: [ a, l, {
            beginKeywords: "if",
            relevance: 0
        }, r, e.HASH_COMMENT_MODE, {
            variants: [ {
                className: "function",
                beginKeywords: "def"
            }, {
                className: "class",
                beginKeywords: "class"
            } ],
            end: /:/,
            illegal: /[${=;\n,]/,
            contains: [ e.UNDERSCORE_TITLE_MODE, t, {
                begin: /->/,
                endsWithParent: !0,
                keywords: "None"
            } ]
        }, {
            className: "meta",
            begin: /^[\t ]*@/,
            end: /$/
        }, {
            begin: /\b(print|exec)\(/
        } ]
    };
};