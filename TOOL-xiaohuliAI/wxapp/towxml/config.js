module.exports = {
    latex: {
        api: "http://towxml.vvadd.com/?tex"
    },
    yuml: {
        api: "http://towxml.vvadd.com/?yuml"
    },
    markdown: [ "sub", "sup", "ins", "mark", "emoji", "todo" ],
    highlight: [ "c-like", "c", "bash", "css", "dart", "go", "java", "javascript", "json", "less", "scss", "shell", "xml", "htmlbars", "nginx", "php", "python", "python-repl", "typescript" ],
    wxml: [ "view", "video", "text", "image", "navigator", "swiper", "swiper-item", "block", "form", "input", "textarea", "button", "checkbox-group", "checkbox", "radio-group", "radio", "rich-text" ],
    components: [ "latex", "table", "img" ],
    attrs: [ "class", "data", "id", "style" ],
    bindType: "catch",
    events: [ "tap", "change" ],
    dpr: 1,
    showLineNumber: !1
};