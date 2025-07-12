Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    return {
        name: "Shell Session",
        aliases: [ "console" ],
        contains: [ {
            className: "meta",
            begin: "^\\s{0,3}[/\\w\\d\\[\\]()@-]*[>%$#]",
            starts: {
                end: "$",
                subLanguage: "bash"
            }
        } ]
    };
};