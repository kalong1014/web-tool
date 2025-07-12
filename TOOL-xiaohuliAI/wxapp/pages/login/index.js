var e = getApp();

Page({
    data: {
        sitecode: "",
        login_phone: 1,
        login_wechat: 1,
        loginType: "wechat",
        phone: "",
        password: "",
        is_agree: !1,
        pwdShow: !1,
        backurl: "/pages/index/index",
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function(t) {
        var a = this, i = wx.getStorageSync("phone");
        i && this.setData({
            phone: i
        }), t.backurl && this.setData({
            backurl: decodeURIComponent(t.backurl)
        });
        var o = wx.getStorageSync("sitecode");
        this.setData({
            sitecode: o || "",
            navBarHeight: e.globalData.navBarHeight,
            safeAreaHeight: e.globalData.safeAreaHeight
        }), e.util.checkWxappLogin().then(function() {
            a.setData({
                openid: e.globalData.openid
            });
        }), e.util.getWxappSetting().then(function(e) {
            a.setData({
                login_phone: e.login_phone,
                login_wechat: e.login_wechat
            }), e.login_phone && !e.login_wechat && a.setData({
                loginType: "phone"
            });
        });
    },
    onShow: function() {
        var e = wx.getStorageSync("loginAgree");
        this.setData({
            is_agree: !!e
        });
    },
    switchToPhone: function() {
        this.setData({
            loginType: "phone"
        });
    },
    agreeChange: function(e) {
        var t = e.detail.value.length > 0;
        t ? wx.setStorageSync("loginAgree", t) : wx.removeStorageSync("loginAgree"), this.setData({
            is_agree: t
        });
    },
    doLogin: function() {
        var t = this, a = this.data.sitecode, i = this.data.phone, o = this.data.password, n = this.data.openid, s = this.data.is_agree;
        if (i) {
            if (o) return s ? void e.util.request({
                url: "/login/login",
                data: {
                    phone: i,
                    password: o,
                    sitecode: a,
                    openid: n
                }
            }).then(function(a) {
                wx.setStorageSync("phone", i), wx.setStorageSync("token", a.data.token), e.globalData.user_id = a.data.user_id, 
                e.globalData.avatar = a.data.avatar, wx.removeStorageSync("notAutoLogin", 0);
                var o = t.data.backurl;
                e.util.message(a.message, "success", function() {
                    wx.redirectTo({
                        url: o,
                        fail: function() {
                            wx.reLaunch({
                                url: "/pages/user/index"
                            });
                        }
                    });
                });
            }) : (e.util.message("请阅读并同意《服务协议》"), void this.setData({
                is_agree: !0
            }));
            e.util.message("请输入登录密码");
        } else e.util.message("请输入手机号");
    },
    wxLogin: function() {
        var t = this.data.is_agree, a = e.globalData.site_id, i = wx.getStorageSync("tuid"), o = e.globalData.siteroot + "/wxapp/wechatLogin?site_id=" + a + "&tuid=" + i + "&openid=" + this.data.openid;
        t ? wx.navigateTo({
            url: "/pages/login/wechat?url=" + encodeURIComponent(o)
        }) : e.util.message("请阅读并同意《服务协议》");
    },
    toReg: function() {
        wx.navigateTo({
            url: "/pages/login/reg"
        });
    },
    toReset: function() {
        wx.navigateTo({
            url: "/pages/login/reset"
        });
    },
    toDoc: function(e) {
        var t = e.currentTarget.dataset.type;
        wx.navigateTo({
            url: "/pages/article/article?type=" + t
        });
    },
    showPwd: function() {
        this.setData({
            pwdShow: !0
        });
    },
    hidePwd: function() {
        this.setData({
            pwdShow: !1
        });
    },
    goHome: function() {
        wx.switchTab({
            url: "/pages/index/index"
        });
    }
});