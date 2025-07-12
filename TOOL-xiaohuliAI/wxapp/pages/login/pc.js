var e = getApp();

Page({
    data: {
        code: "",
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function(t) {
        if (t.scene) {
            var a = decodeURIComponent(t.scene), o = e.util.queryToArr(a);
            o.code && this.setData({
                code: o.code
            });
        }
        e.util.wxappLogin();
    },
    doLogin: function() {
        this.data.code ? e.util.request({
            url: "/wxapp/pclogin",
            data: {
                code: this.data.code
            }
        }).then(function(t) {
            e.util.message(t.message), setTimeout(function() {
                wx.switchTab({
                    url: "/pages/user/index"
                });
            }, 800);
        }) : e.util.message("参数错误", "error");
    }
});