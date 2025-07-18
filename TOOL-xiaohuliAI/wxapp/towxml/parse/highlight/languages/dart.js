Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var n = {
        className: "subst",
        variants: [ {
            begin: "\\$[A-Za-z0-9_]+"
        } ]
    }, t = {
        className: "subst",
        variants: [ {
            begin: "\\${",
            end: "}"
        } ],
        keywords: "true false null this is new super"
    }, a = {
        className: "string",
        variants: [ {
            begin: "r'''",
            end: "'''"
        }, {
            begin: 'r"""',
            end: '"""'
        }, {
            begin: "r'",
            end: "'",
            illegal: "\\n"
        }, {
            begin: 'r"',
            end: '"',
            illegal: "\\n"
        }, {
            begin: "'''",
            end: "'''",
            contains: [ e.BACKSLASH_ESCAPE, n, t ]
        }, {
            begin: '"""',
            end: '"""',
            contains: [ e.BACKSLASH_ESCAPE, n, t ]
        }, {
            begin: "'",
            end: "'",
            illegal: "\\n",
            contains: [ e.BACKSLASH_ESCAPE, n, t ]
        }, {
            begin: '"',
            end: '"',
            illegal: "\\n",
            contains: [ e.BACKSLASH_ESCAPE, n, t ]
        } ]
    };
    return t.contains = [ e.C_NUMBER_MODE, a ], {
        name: "Dart",
        keywords: {
            keyword: "abstract as assert async await break case catch class const continue covariant default deferred do dynamic else enum export extends extension external factory false final finally for Function get hide if implements import in inferface is library mixin new null on operator part rethrow return set show static super switch sync this throw true try typedef var void while with yield",
            built_in: "Comparable DateTime Duration Function Iterable Iterator List Map Match Null Object Pattern RegExp Set Stopwatch String StringBuffer StringSink Symbol Type Uri bool double dynamic int num print Element ElementList document querySelector querySelectorAll window"
        },
        contains: [ a, e.COMMENT("/\\*\\*", "\\*/", {
            subLanguage: "markdown",
            relevance: 0
        }), e.COMMENT("///+\\s*", "$", {
            contains: [ {
                subLanguage: "markdown",
                begin: ".",
                end: "$",
                relevance: 0
            } ]
        }), e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, {
            className: "class",
            beginKeywords: "class interface",
            end: "{",
            excludeEnd: !0,
            contains: [ {
                beginKeywords: "extends implements"
            }, e.UNDERSCORE_TITLE_MODE ]
        }, e.C_NUMBER_MODE, {
            className: "meta",
            begin: "@[A-Za-z]+"
        }, {
            begin: "=>"
        } ]
    };
};