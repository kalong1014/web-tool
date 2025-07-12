var t = require("../../@babel/runtime/helpers/defineProperty"), e = getApp();

Page({
    data: {
        sitecode: "",
        phone: "",
        password: "",
        code: "",
        pwdShow: !1,
        sendSmsShow: !1,
        sendSmsCountdown: 0,
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function(t) {
        this.setData({
            navBarHeight: e.globalData.navBarHeight,
            safeAreaHeight: e.globalData.safeAreaHeight
        });
        var s = wx.getStorageSync("phone");
        s && this.setData({
            phone: s
        }), t.url && this.setData({
            backurl: t.url
        });
        var a = wx.getStorageSync("sitecode");
        this.setData({
            sitecode: a || ""
        });
    },
    switchLoginType: function(t) {
        this.loginType = t;
    },
    doSendSms: function() {
        var t = this.data.phone;
        t && 11 === t.length ? this.setData({
            sendSmsShow: !0
        }) : e.util.message("请输入正确的手机号");
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
    doReset: function() {
        var t = this, s = this.data.sitecode, a = this.data.phone, n = this.data.code, o = this.data.password;
        a ? 11 === a.length ? n ? o ? e.util.request({
            url: "/login/reset",
            data: {
                phone: a,
                password: o,
                code: n,
                sitecode: s
            }
        }).then(function(s) {
            e.util.message(s.message, "success"), t.toBack();
        }) : e.util.message("请输入登录密码") : e.util.message("请输入短信验证码") : e.util.message("手机号码格式不正确") : e.util.message("请输入手机号");
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
    inputChange: function(e) {
        var s = e.currentTarget.dataset.name, a = e.detail.value;
        this.setData(t({}, s, a));
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