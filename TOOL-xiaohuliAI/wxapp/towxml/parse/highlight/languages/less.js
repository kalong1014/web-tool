Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var n = [], a = [], t = function(e) {
        return {
            className: "string",
            begin: "~?" + e + ".*?" + e
        };
    }, s = function(e, n, a) {
        return {
            className: e,
            begin: n,
            relevance: a
        };
    }, r = {
        begin: "\\(",
        end: "\\)",
        contains: a,
        relevance: 0
    };
    a.push(e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, t("'"), t('"'), e.CSS_NUMBER_MODE, {
        begin: "(url|data-uri)\\(",
        starts: {
            className: "string",
            end: "[\\)\\n]",
            excludeEnd: !0
        }
    }, s("number", "#[0-9A-Fa-f]+\\b"), r, s("variable", "@@?[\\w-]+", 10), s("variable", "@{[\\w-]+}"), s("built_in", "~?`[^`]*?`"), {
        className: "attribute",
        begin: "[\\w-]+\\s*:",
        end: ":",
        returnBegin: !0,
        excludeEnd: !0
    }, {
        className: "meta",
        begin: "!important"
    });
    var i = a.concat({
        begin: "{",
        end: "}",
        contains: n
    }), c = {
        beginKeywords: "when",
        endsWithParent: !0,
        contains: [ {
            beginKeywords: "and not"
        } ].concat(a)
    }, l = {
        begin: "([\\w-]+|@{[\\w-]+})\\s*:",
        returnBegin: !0,
        end: "[;}]",
        relevance: 0,
        contains: [ {
            className: "attribute",
            begin: "([\\w-]+|@{[\\w-]+})",
            end: ":",
            excludeEnd: !0,
            starts: {
                endsWithParent: !0,
                illegal: "[<=$]",
                relevance: 0,
                contains: a
            }
        } ]
    }, o = {
        className: "keyword",
        begin: "@(import|media|charset|font-face|(-[a-z]+-)?keyframes|supports|document|namespace|page|viewport|host)\\b",
        starts: {
            end: "[;{}]",
            returnEnd: !0,
            contains: a,
            relevance: 0
        }
    }, d = {
        className: "variable",
        variants: [ {
            begin: "@[\\w-]+\\s*:",
            relevance: 15
        }, {
            begin: "@[\\w-]+"
        } ],
        starts: {
            end: "[;}]",
            returnEnd: !0,
            contains: i
        }
    }, b = {
        variants: [ {
            begin: "[\\.#:&\\[>]",
            end: "[;{}]"
        }, {
            begin: "([\\w-]+|@{[\\w-]+})",
            end: "{"
        } ],
        returnBegin: !0,
        returnEnd: !0,
        illegal: "[<='$\"]",
        relevance: 0,
        contains: [ e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, c, s("keyword", "all\\b"), s("variable", "@{[\\w-]+}"), s("selector-tag", "([\\w-]+|@{[\\w-]+})%?", 0), s("selector-id", "#([\\w-]+|@{[\\w-]+})"), s("selector-class", "\\.([\\w-]+|@{[\\w-]+})", 0), s("selector-tag", "&", 0), {
            className: "selector-attr",
            begin: "\\[",
            end: "\\]"
        }, {
            className: "selector-pseudo",
            begin: /:(:)?[a-zA-Z0-9\_\-\+\(\)"'.]+/
        }, {
            begin: "\\(",
            end: "\\)",
            contains: i
        }, {
            begin: "!important"
        } ]
    };
    return n.push(e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, o, d, l, b), {
        name: "Less",
        case_insensitive: !0,
        illegal: "[=>'/<($\"]",
        contains: n
    };
};