var t = require("../../utils/tabbar.js"), e = getApp();

Page({
    data: {
        userinfo: {
            user_id: 0,
            balance_point: 0
        },
        isLogin: !1,
        is_check: 1,
        showPay: !1,
        drawIsOpen: !1,
        hasModel4: !1,
        model4Name: "高级版",
        point_title: "积分",
        walletItemCount: 1,
        version: "",
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function(a) {
        var i = this;
        this.setData({
            version: e.siteinfo.version,
            navBarHeight: e.globalData.navBarHeight,
            safeAreaHeight: e.globalData.safeAreaHeight
        }), e.util.getWxappSetting().then(function(a) {
            t.init(i, a.tabbar);
            var n = !0;
            (a.is_check || !a.is_ios_pay && "ios" == e.globalData.system) && (n = !1);
            var s = a.tabbar[3], r = 3;
            s || r--, a.hasModel4 || r--, i.setData({
                is_check: a.is_check,
                showPay: n,
                drawIsOpen: s,
                hasModel4: a.hasModel4,
                model4Name: a.model4Name,
                walletItemCount: r,
                point_title: a.priceSetting.title || "积分"
            });
        });
    },
    onShow: function() {
        var t = this;
        "function" == typeof this.getTabBar && this.getTabBar() && this.getTabBar().setData({
            selected: "user"
        }), e.util.checkWxappLogin().then(function() {
            t.getUserInfo();
        });
    },
    getUserInfo: function() {
        var t = this;
        e.util.request({
            url: "/user/info"
        }).then(function(a) {
            e.globalData.user_id = a.data.user_id, e.globalData.avatar = a.data.avatar, t.setData({
                userinfo: a.data,
                isLogin: !0
            });
        }).catch(function(t) {
            e.util.toLogin(t.message);
        });
    },
    getUserProfile: function() {
        var t = this;
        wx.getUserProfile({
            desc: "使用微信登录"
        }).then(function(a) {
            a.errMsg.indexOf("fail") > 0 ? e.util.message("授权失败", "error") : e.util.request({
                url: "/user/setUserAvatar",
                data: {
                    encryptedData: a.encryptedData,
                    iv: a.iv
                }
            }).then(function(e) {
                t.getUserInfo();
            });
        }).catch(function() {});
    },
    getUserPhone: function(t) {
        var a = this;
        if ("getPhoneNumber:ok" != t.detail.errMsg) {
            var i = t.detail.errMsg;
            return -1 !== i.indexOf("user deny") && (i = "已取消授权"), void e.util.message(i, "error");
        }
        e.util.request({
            url: "/user/setUserPhone",
            data: {
                encryptedData: t.detail.encryptedData,
                iv: t.detail.iv
            }
        }).then(function(t) {
            a.getUserInfo();
        });
    },
    linkto: function(t) {
        if (this.data.isLogin) {
            var a = t.currentTarget.dataset.url;
            wx.navigateTo({
                url: a
            });
        } else e.util.toLogin("请登录");
    },
    toPay: function(t) {
        if (this.data.isLogin) {
            var a = t.currentTarget.dataset.type;
            e.util.toPay(a);
        } else e.util.toLogin("请登录");
    },
    toTask: function() {
        this.data.isLogin ? wx.switchTab({
            url: "/pages/task/index"
        }) : e.util.toLogin("请登录");
    },
    toSetting: function() {
        this.data.isLogin ? wx.navigateTo({
            url: "/pages/user/setting/index"
        }) : e.util.toLogin("请登录");
    }
});