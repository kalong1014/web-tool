var t = getApp();

Component({
    options: {
        styleIsolation: "shared"
    },
    properties: {
        type: {
            type: String,
            value: "markdown"
        },
        content: {
            type: String,
            value: {},
            observer: function(e) {
                var a = this.data.type ? this.data.type : "markdown", i = t.towxml(e, a, {
                    theme: "light"
                });
                if (this.data.writing) {
                    i.children && i.children.push({
                        tag: "image",
                        attrs: {
                            src: "/images/cursor.gif",
                            style: "width: 8rpx; height: 32rpx; position: relative; top: -2rpx;"
                        }
                    });
                }
                this.setData({
                    nodes: i
                });
            }
        },
        writing: {
            type: Boolean,
            value: !1
        }
    },
    data: {
        nodes: {},
        someData: {}
    }
});