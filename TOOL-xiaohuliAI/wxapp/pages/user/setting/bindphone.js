var t = getApp();

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
    onLoad: function(e) {
        this.setData({
            navBarHeight: t.globalData.navBarHeight,
            safeAreaHeight: t.globalData.safeAreaHeight
        }), e.phone && this.setData({
            phone: e.phone
        });
        var s = wx.getStorageSync("sitecode");
        this.setData({
            sitecode: s || ""
        });
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
    doSubmit: function() {
        var e = this, s = this.data.sitecode, a = this.data.phone, n = this.data.code, o = this.data.password;
        a ? 11 === a.length ? n ? o ? t.util.request({
            url: "/user/bindPhone",
            data: {
                phone: a,
                password: o,
                code: n,
                sitecode: s
            }
        }).then(function(s) {
            var a = e;
            t.util.message(s.message, "error", function() {
                a.toBack();
            });
        }) : t.util.message("请输入登录密码") : t.util.message("请输入短信验证码") : t.util.message("手机号码格式不正确") : t.util.message("请输入手机号");
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