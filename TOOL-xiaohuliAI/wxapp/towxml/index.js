var r = require("./parse/markdown/index"), e = require("./parse/index");

module.exports = function(a, n, t) {
    var d;
    switch (t = t || {}, n) {
      case "markdown":
        d = e(r(a), t);
        break;

      case "html":
        d = e(a, t);
        break;

      default:
        throw new Error("Invalid type, only markdown and html are supported");
    }
    return d;
};