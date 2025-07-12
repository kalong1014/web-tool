Component({
    options: {
        multipleSlots: !0
    },
    properties: {
        title: {
            type: String,
            value: ""
        },
        showClose: {
            type: Boolean,
            value: !0
        },
        top: {
            type: String,
            value: "200rpx"
        },
        bottom: {
            type: Number,
            value: 110
        },
        height: {
            type: String,
            value: "75%"
        }
    },
    data: {
        isOpen: !1,
        maskShow: !1,
        mainShow: !1,
        safeAreaHeight: 0
    },
    lifetimes: {
        attached: function() {
            var t = getApp();
            this.setData({
                safeAreaHeight: t.globalData.safeAreaHeight
            });
        }
    },
    methods: {
        open: function() {
            var t = this;
            this.setData({
                isOpen: !0
            }), setTimeout(function() {
                t.setData({
                    maskShow: !0,
                    mainShow: !0
                });
            }, 10);
        },
        close: function() {
            var t = this;
            this.setData({
                maskShow: !1,
                mainShow: !1
            }), setTimeout(function() {
                t.setData({
                    isOpen: !1
                });
            }, 200);
        }
    }
});