Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var n = {
        className: "attribute",
        begin: /\S/,
        end: ":",
        excludeEnd: !0,
        starts: {
            endsWithParent: !0,
            excludeEnd: !0,
            contains: [ {
                begin: /[\w-]+\(/,
                returnBegin: !0,
                contains: [ {
                    className: "built_in",
                    begin: /[\w-]+/
                }, {
                    begin: /\(/,
                    end: /\)/,
                    contains: [ e.APOS_STRING_MODE, e.QUOTE_STRING_MODE, e.CSS_NUMBER_MODE ]
                } ]
            }, e.CSS_NUMBER_MODE, e.QUOTE_STRING_MODE, e.APOS_STRING_MODE, e.C_BLOCK_COMMENT_MODE, {
                className: "number",
                begin: "#[0-9A-Fa-f]+"
            }, {
                className: "meta",
                begin: "!important"
            } ]
        }
    }, a = {
        begin: /(?:[A-Z\_\.\-]+|--[a-zA-Z0-9_-]+)\s*:/,
        returnBegin: !0,
        end: ";",
        endsWithParent: !0,
        contains: [ n ]
    };
    return {
        name: "CSS",
        case_insensitive: !0,
        illegal: /[=\/|'\$]/,
        contains: [ e.C_BLOCK_COMMENT_MODE, {
            className: "selector-id",
            begin: /#[A-Za-z0-9_-]+/
        }, {
            className: "selector-class",
            begin: /\.[A-Za-z0-9_-]+/
        }, {
            className: "selector-attr",
            begin: /\[/,
            end: /\]/,
            illegal: "$",
            contains: [ e.APOS_STRING_MODE, e.QUOTE_STRING_MODE ]
        }, {
            className: "selector-pseudo",
            begin: /:(:)?[a-zA-Z0-9\_\-\+\(\)"'.]+/
        }, {
            begin: "@(page|font-face)",
            lexemes: "@[a-z-]+",
            keywords: "@page @font-face"
        }, {
            begin: "@",
            end: "[{;]",
            illegal: /:/,
            returnBegin: !0,
            contains: [ {
                className: "keyword",
                begin: /@\-?\w[\w]*(\-\w+)*/
            }, {
                begin: /\s/,
                endsWithParent: !0,
                excludeEnd: !0,
                relevance: 0,
                keywords: "and or not only",
                contains: [ {
                    begin: /[a-z-]+:/,
                    className: "attribute"
                }, e.APOS_STRING_MODE, e.QUOTE_STRING_MODE, e.CSS_NUMBER_MODE ]
            } ]
        }, {
            className: "selector-tag",
            begin: "[a-zA-Z-][a-zA-Z0-9_-]*",
            relevance: 0
        }, {
            begin: "{",
            end: "}",
            illegal: /\S/,
            contains: [ e.C_BLOCK_COMMENT_MODE, a ]
        } ]
    };
};