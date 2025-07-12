var e = require("./config");

Component({
    options: {
        styleIsolation: "apply-shared"
    },
    properties: {
        nodes: {
            type: Object,
            value: {}
        },
        writing: {
            type: Boolean,
            value: !1
        }
    },
    lifetimes: {
        attached: function() {
            var t = this;
            e.events.forEach(function(e) {
                t["_" + e] = function() {
                    var t;
                    global._events && "function" == typeof global._events[e] && (t = global._events)[e].apply(t, arguments);
                };
            });
        }
    },
    methods: {
        linkto: function(e) {
            var t = e.currentTarget.dataset.data.attrs.href;
            -1 !== t.indexOf("//") ? wx.showModal({
                title: "链接地址",
                content: t,
                cancelText: "直接打开",
                confirmText: "复制链接",
                complete: function(e) {
                    e.cancel ? wx.navigateTo({
                        url: "/pages/webview/webview?url=" + encodeURIComponent(t)
                    }) : e.confirm && wx.setClipboardData({
                        data: t
                    });
                }
            }) : wx.navigateTo({
                url: t
            });
        }
    }
});