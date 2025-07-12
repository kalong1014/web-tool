var a = getApp();

Page({
    data: {},
    onLoad: function(a) {
        var t = a.url;
        t = decodeURIComponent(t), this.setData({
            url: t
        });
    },
    onMessage: function(a) {
        var t = a.detail.data[0];
        "setToken" == t.action && (wx.setStorageSync("token", t.data), this.getUserInfo());
    },
    getUserInfo: function() {
        a.util.request({
            url: "/user/info"
        }).then(function(t) {
            a.globalData.user_id = t.data.user_id, a.globalData.avatar = t.data.avatar;
        });
    }
});