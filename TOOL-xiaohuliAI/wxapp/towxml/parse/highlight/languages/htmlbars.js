Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var a = "action collection component concat debugger each each-in else get hash if input link-to loc log mut outlet partial query-params render textarea unbound unless with yield view", n = (e.QUOTE_STRING_MODE, 
    {
        endsWithParent: !0,
        relevance: 0,
        keywords: {
            keyword: "as",
            built_in: a
        },
        contains: [ e.QUOTE_STRING_MODE, {
            illegal: /\}\}/,
            begin: /[a-zA-Z0-9_]+=/,
            returnBegin: !0,
            relevance: 0,
            contains: [ {
                className: "attr",
                begin: /[a-zA-Z0-9_]+/
            } ]
        }, e.NUMBER_MODE ]
    });
    return {
        name: "HTMLBars",
        case_insensitive: !0,
        subLanguage: "xml",
        contains: [ e.COMMENT("{{!(--)?", "(--)?}}"), {
            className: "template-tag",
            begin: /\{\{[#\/]/,
            end: /\}\}/,
            contains: [ {
                className: "name",
                begin: /[a-zA-Z\.\-]+/,
                keywords: {
                    "builtin-name": a
                },
                starts: n
            } ]
        }, {
            className: "template-variable",
            begin: /\{\{[a-zA-Z][a-zA-Z\-]+/,
            end: /\}\}/,
            keywords: {
                keyword: "as",
                built_in: a
            },
            contains: [ e.QUOTE_STRING_MODE ]
        } ]
    };
};