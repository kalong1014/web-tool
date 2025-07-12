var t = getApp();

Page({
    data: {
        openid: "",
        phone: "",
        password: "",
        code: "",
        pwdShow: !1,
        sendSmsShow: !1,
        sendSmsCountdown: 0,
        is_agree: !1,
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function(e) {
        var a = this;
        this.setData({
            navBarHeight: t.globalData.navBarHeight,
            safeAreaHeight: t.globalData.safeAreaHeight
        });
        var s = wx.getStorageSync("phone");
        s && this.setData({
            phone: s
        }), e.url && this.setData({
            backurl: e.url
        }), t.util.checkWxappLogin().then(function() {
            a.setData({
                openid: t.globalData.openid
            });
        });
        var n = wx.getStorageSync("loginAgree");
        this.setData({
            is_agree: !!n
        });
    },
    switchLoginType: function(t) {
        this.loginType = t;
    },
    doSendSms: function() {
        var e = this.data.phone;
        e && 11 === e.length ? this.setData({
            sendSmsShow: !0
        }) : t.util.message("请输入正确的手机号");
    },
    sendSmsClose: function() {
        this.setData({
            sendSmsShow: !1
        });
    },
    sendSmsSuccess: function() {
        this.sendSmsClose(), this.setData({
            sendSmsCountdown: 60
        }), this.doCountdown();
    },
    doCountdown: function() {
        var t = this, e = this.data.sendSmsCountdown;
        e > 0 && (this.setData({
            sendSmsCountdown: e - 1
        }), setTimeout(function() {
            t.doCountdown();
        }, 1e3));
    },
    doReg: function() {
        var e = this, a = this.data.phone, s = this.data.code, n = this.data.password, o = this.data.openid, i = this.data.is_agree, d = wx.getStorageSync("tuid");
        a ? 11 === a.length ? s ? n ? i ? t.util.request({
            url: "/login/reg",
            data: {
                phone: a,
                password: n,
                code: s,
                tuid: d || 0,
                openid: o
            }
        }).then(function(a) {
            var s = e;
            t.util.message(a.message, "error", function() {
                s.toBack();
            });
        }) : t.util.message("请阅读并同意《服务协议》") : t.util.message("请输入登录密码") : t.util.message("请输入短信验证码") : t.util.message("手机号码格式不正确") : t.util.message("请输入手机号");
    },
    agreeChange: function(t) {
        var e = t.detail.value.length > 0;
        e ? wx.setStorageSync("loginAgree", e) : wx.removeStorageSync("loginAgree"), this.setData({
            is_agree: e
        });
    },
    toBack: function() {
        wx.navigateBack({
            fail: function() {
                wx.reLaunch({
                    url: "/pages/index/index"
                });
            }
        });
    },
    toDoc: function(t) {
        var e = t.currentTarget.dataset.type;
        wx.navigateTo({
            url: "/pages/article/article?type=" + e
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
    }
});