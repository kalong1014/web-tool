Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var n = {
        className: "symbol",
        begin: "&[a-z]+;|&#[0-9]+;|&#x[a-f0-9]+;"
    }, a = {
        begin: "\\s",
        contains: [ {
            className: "meta-keyword",
            begin: "#?[a-z_][a-z1-9_-]+",
            illegal: "\\n"
        } ]
    }, s = e.inherit(a, {
        begin: "\\(",
        end: "\\)"
    }), t = e.inherit(e.APOS_STRING_MODE, {
        className: "meta-string"
    }), i = e.inherit(e.QUOTE_STRING_MODE, {
        className: "meta-string"
    }), c = {
        endsWithParent: !0,
        illegal: /</,
        relevance: 0,
        contains: [ {
            className: "attr",
            begin: "[A-Za-z0-9\\._:-]+",
            relevance: 0
        }, {
            begin: /=\s*/,
            relevance: 0,
            contains: [ {
                className: "string",
                endsParent: !0,
                variants: [ {
                    begin: /"/,
                    end: /"/,
                    contains: [ n ]
                }, {
                    begin: /'/,
                    end: /'/,
                    contains: [ n ]
                }, {
                    begin: /[^\s"'=<>`]+/
                } ]
            } ]
        } ]
    };
    return {
        name: "HTML, XML",
        aliases: [ "html", "xhtml", "rss", "atom", "xjb", "xsd", "xsl", "plist", "wsf", "svg" ],
        case_insensitive: !0,
        contains: [ {
            className: "meta",
            begin: "<![a-z]",
            end: ">",
            relevance: 10,
            contains: [ a, i, t, s, {
                begin: "\\[",
                end: "\\]",
                contains: [ {
                    className: "meta",
                    begin: "<![a-z]",
                    end: ">",
                    contains: [ a, s, i, t ]
                } ]
            } ]
        }, e.COMMENT("\x3c!--", "--\x3e", {
            relevance: 10
        }), {
            begin: "<\\!\\[CDATA\\[",
            end: "\\]\\]>",
            relevance: 10
        }, n, {
            className: "meta",
            begin: /<\?xml/,
            end: /\?>/,
            relevance: 10
        }, {
            className: "tag",
            begin: "<style(?=\\s|>)",
            end: ">",
            keywords: {
                name: "style"
            },
            contains: [ c ],
            starts: {
                end: "</style>",
                returnEnd: !0,
                subLanguage: [ "css", "xml" ]
            }
        }, {
            className: "tag",
            begin: "<script(?=\\s|>)",
            end: ">",
            keywords: {
                name: "script"
            },
            contains: [ c ],
            starts: {
                end: "<\/script>",
                returnEnd: !0,
                subLanguage: [ "javascript", "handlebars", "xml" ]
            }
        }, {
            className: "tag",
            begin: "</?",
            end: "/?>",
            contains: [ {
                className: "name",
                begin: /[^\/><\s]+/,
                relevance: 0
            }, c ]
        } ]
    };
};