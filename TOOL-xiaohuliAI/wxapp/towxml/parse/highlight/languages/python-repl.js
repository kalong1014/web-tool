Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    return {
        aliases: [ "pycon" ],
        contains: [ {
            className: "meta",
            starts: {
                end: / |$/,
                starts: {
                    end: "$",
                    subLanguage: "python"
                }
            },
            variants: [ {
                begin: /^>>>(?=[ ]|$)/
            }, {
                begin: /^\.\.\.(?=[ ]|$)/
            } ]
        } ]
    };
};