var e = require("./domhandler/index.js"), r = require("./Parser.js");

module.exports = function(n, d) {
    var i = new e(void 0, d);
    return new r(i, d).end(n), i.root.children;
};