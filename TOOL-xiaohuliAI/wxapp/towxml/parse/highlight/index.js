require("../../config");

var e = require("./highlight");

e.registerLanguage("c-like", require("./languages/c-like").default), e.registerLanguage("c", require("./languages/c").default), 
e.registerLanguage("bash", require("./languages/bash").default), e.registerLanguage("css", require("./languages/css").default), 
e.registerLanguage("dart", require("./languages/dart").default), e.registerLanguage("go", require("./languages/go").default), 
e.registerLanguage("java", require("./languages/java").default), e.registerLanguage("javascript", require("./languages/javascript").default), 
e.registerLanguage("json", require("./languages/json").default), e.registerLanguage("less", require("./languages/less").default), 
e.registerLanguage("scss", require("./languages/scss").default), e.registerLanguage("shell", require("./languages/shell").default), 
e.registerLanguage("xml", require("./languages/xml").default), e.registerLanguage("htmlbars", require("./languages/htmlbars").default), 
e.registerLanguage("nginx", require("./languages/nginx").default), e.registerLanguage("php", require("./languages/php").default), 
e.registerLanguage("python", require("./languages/python").default), e.registerLanguage("python-repl", require("./languages/python-repl").default), 
e.registerLanguage("typescript", require("./languages/typescript").default), module.exports = e;