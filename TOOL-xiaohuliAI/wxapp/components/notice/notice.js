Component({
    properties: {
        notice: {
            type: Object,
            default: {}
        }
    },
    data: {
        showNotice: !1,
        safeAreaHeight: 0
    },
    lifetimes: {
        attached: function() {
            var t = this.getTime(), e = wx.getStorageSync("lastNotice");
            (!e || t - e > 43200) && this.setData({
                safeAreaHeight: getApp().globalData.safeAreaHeight,
                showNotice: !0
            });
        }
    },
    methods: {
        doClose: function() {
            this.setData({
                showNotice: !1
            });
            var t = this.getTime();
            wx.setStorageSync("lastNotice", t);
        },
        toNotice: function() {
            wx.navigateTo({
                url: "/pages/article/article?type=notice"
            });
        },
        getTime: function() {
            return parseInt(new Date().getTime() / 1e3);
        }
    }
});