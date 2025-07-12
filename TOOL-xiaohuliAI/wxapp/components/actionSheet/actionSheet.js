Component({
    properties: {
        actions: {
            type: Array,
            value: function() {
                return [];
            }
        },
        data: {
            type: String / Number,
            value: ""
        },
        bottom: {
            type: Number,
            value: 110
        }
    },
    data: {
        isOpen: !1,
        maskShow: !1,
        listShow: !1,
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
                    listShow: !0
                });
            }, 10);
        },
        close: function() {
            var t = this;
            this.setData({
                maskShow: !1,
                listShow: !1
            }), setTimeout(function() {
                t.setData({
                    isOpen: !1
                });
            }, 200);
        },
        onSelect: function(t) {
            var e = t.currentTarget.dataset.action, a = t.currentTarget.dataset.index, s = this.data.data;
            this.triggerEvent("select", {
                action: e,
                index: a,
                data: s
            }), this.close();
        }
    }
});