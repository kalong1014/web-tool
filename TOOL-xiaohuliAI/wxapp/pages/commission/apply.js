var t = require("../../@babel/runtime/helpers/defineProperty"), e = getApp();

Page({
    data: {
        name: "",
        phone: "",
        is_agree: !1,
        pid: 0,
        focus: "",
        lastApply: null,
        isEdit: !1,
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function(t) {
        if (this.setData({
            navBarHeight: e.globalData.navBarHeight,
            safeAreaHeight: e.globalData.safeAreaHeight
        }), t.scene) {
            var a = decodeURIComponent(t.scene), i = e.util.queryToArr(a);
            i.pid && this.setData({
                pid: i.pid
            });
        }
        var s = wx.getStorageSync("phone");
        s && this.setData({
            phone: s
        }), this.getLastApply();
    },
    doSubmit: function() {
        var t = this, a = this.data.name, i = this.data.phone, s = this.data.pid, n = this.data.is_agree;
        if (a) {
            if (i) return n ? void e.util.request({
                url: "/commission/apply",
                data: {
                    name: a,
                    phone: i,
                    pid: s
                }
            }).then(function(e) {
                wx.showModal({
                    title: "系统提示",
                    content: e.message,
                    showCancel: !1,
                    success: function() {
                        t.setData({
                            lastApply: null,
                            isEdit: !1
                        }), t.getLastApply();
                    }
                });
            }) : (e.util.message("请阅读并同意《用户推广协议》", "error"), void this.setData({
                is_agree: !0
            }));
            e.util.message("请输入手机号", "error");
        } else e.util.message("请输入姓名", "error");
    },
    toAgreement: function() {
        wx.navigateTo({
            url: "/pages/article/article?type=commission"
        });
    },
    toCommission: function() {
        wx.redirectTo({
            url: "/pages/commission/index"
        });
    },
    toEdit: function() {
        this.setData({
            isEdit: !0
        });
    },
    getLastApply: function() {
        var t = this;
        e.util.request({
            url: "/commission/getLastApply"
        }).then(function(e) {
            e.data && t.setData({
                lastApply: e.data,
                name: e.data.name,
                phone: e.data.phone
            });
        });
    },
    inputChange: function(e) {
        var a = e.currentTarget.dataset.name, i = e.detail.value;
        this.setData(t({}, a, i));
    },
    inputFocus: function(t) {
        var e = t.currentTarget.dataset.name;
        this.setData({
            focus: e
        });
    },
    inputBlur: function(t) {
        var e = t.currentTarget.dataset.name;
        this.focus == e && this.setData({
            focus: ""
        });
    },
    checkboxChange: function(t) {
        var e = t.detail.value;
        this.setData({
            is_agree: e.length > 0
        });
    }
});