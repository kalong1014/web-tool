getApp();

Component({
    properties: {
        name: {
            type: String,
            value: "image"
        },
        max: {
            type: Number,
            value: 1
        },
        width: {
            type: String,
            value: "120rpx"
        },
        height: {
            type: String,
            value: "120rpx"
        },
        imageList: {
            type: Array,
            value: []
        }
    },
    methods: {
        chooseImage: function() {
            var e = this;
            wx.chooseImage({
                count: 1,
                success: function(t) {
                    e.triggerEvent("afterRead", t);
                }
            });
        },
        previewImage: function(e) {
            var t = e.currentTarget.dataset.url, r = this.data.imageList, a = [];
            r.forEach(function(e) {
                a.push(e.url);
            }), wx.previewImage({
                urls: a,
                showmenu: !0,
                current: t
            });
        },
        deleteImage: function(e) {
            var t = this;
            wx.showModal({
                title: "提示",
                content: "确定移除此图片吗？",
                complete: function(r) {
                    if (r.confirm) {
                        var a = e.currentTarget.dataset.index;
                        t.triggerEvent("delete", a);
                    }
                }
            });
        }
    }
});