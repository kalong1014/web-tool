var t = getApp();

Component({
    properties: {
        text: {
            type: String,
            default: ""
        }
    },
    data: {
        text2: ""
    },
    methods: {
        onLoad: function() {
            var e = t.towxml("#Markdown", "markdown", {
                base: t.globalData.siteroot,
                theme: "light",
                events: {
                    tap: function(t) {}
                }
            });
            this.setData({
                text2: e
            });
        },
        onCopySuccess: function() {
            t.util.message("已复制");
        },
        onCopyError: function() {
            t.util.message("已复制", "error");
        },
        trim: function(t) {
            return t.replace(/(^\s*)|(\s*$)/g, "");
        }
    }
});