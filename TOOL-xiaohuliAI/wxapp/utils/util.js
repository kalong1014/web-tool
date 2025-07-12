require("../siteinfo").version;

var t = {
    request: function(e) {
        var a = getApp(), n = (e = e || {}).url;
        if (-1 == n.indexOf("http://") && -1 == n.indexOf("https://") && (n = a.globalData.siteroot + e.url), 
        !n) return !1;
        e.loading = void 0 === e.loading || e.loading, e.loading && (wx.showNavigationBarLoading(), 
        wx.showLoading({
            title: "加载中"
        }));
        var o = e.data ? e.data : {};
        return a.globalData.site_id && (o.site_id = a.globalData.site_id), new Promise(function(a, i) {
            wx.request({
                url: n,
                data: o,
                method: e.method ? e.method : "POST",
                dataType: "json",
                header: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-Token": wx.getStorageSync("token")
                },
                timeout: e.timeout ? e.timeout : 6e4,
                success: function(n) {
                    if (200 == n.statusCode) if (n.data.errno > 0) {
                        if (403 === n.data.errno) return "/user/info" !== e.url && t.toLogin(n.data.message), 
                        void i(n.data);
                        n.data.message && "/wxapp/login" !== e.url && t.message(n.data.message, "error"), 
                        i(n.data);
                    } else a(n.data); else i(n);
                },
                fail: function(e) {
                    t.message("网络错误", "error"), i(e);
                },
                complete: function(t) {
                    e.loading && (wx.hideLoading(), wx.hideNavigationBarLoading());
                }
            });
        });
    },
    upload: function() {
        var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null;
        return function(e) {
            var a = getApp(), n = (e = e || {}).url;
            if (-1 == n.indexOf("http://") && -1 == n.indexOf("https://") && (n = a.globalData.siteroot + e.url), 
            !n) return !1;
            e.loading = void 0 === e.loading || e.loading, e.loading && (wx.showNavigationBarLoading(), 
            wx.showLoading({
                title: "请稍候"
            }));
            var o = e.data ? e.data : {};
            return a.globalData.site_id && (o.site_id = a.globalData.site_id), new Promise(function(a, o) {
                wx.uploadFile({
                    url: n,
                    data: e.data ? e.data : {},
                    filePath: e.filePath,
                    name: e.name ? e.name : "image",
                    header: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "X-Token": wx.getStorageSync("token")
                    },
                    dataType: "json",
                    success: function(e) {
                        var n = JSON.parse(e.data);
                        if (n.errno > 0) {
                            if (403 === n.errno) return t.toLogin(n.message), void o(n);
                            n.message && t.message(n.message, "error"), o(n);
                        } else a(n);
                    },
                    fail: function(e) {
                        t.message("网络错误", "error"), o(e);
                    },
                    complete: function(t) {
                        e.loading && (wx.hideLoading(), wx.hideNavigationBarLoading());
                    }
                });
            });
        }(e);
    },
    checkWxappLogin: function() {
        var e = getApp();
        return new Promise(function(a, n) {
            e.globalData.openid ? a() : t.wxappLogin().then(function(t) {
                a(t);
            }).catch(function(t) {
                n(t);
            });
        });
    },
    wxappLogin: function() {
        var e = getApp();
        return new Promise(function(a, n) {
            wx.login({
                success: function(n) {
                    var o = n.code;
                    t.request({
                        url: "/wxapp/login",
                        data: {
                            site_id: e.globalData.site_id,
                            code: o
                        }
                    }).then(function(t) {
                        e.globalData.openid = t.data.openid, e.globalData.sitecode = t.data.sitecode, a();
                    }).catch(function(e) {
                        t.message(e.message, "error", function() {
                            setTimeout(function() {
                                t.wxappLogin();
                            }, 300);
                        });
                    });
                },
                fail: function(t) {
                    n(t);
                }
            });
        });
    },
    checkLogin: function() {
        var e = getApp();
        return new Promise(function(a, n) {
            e.globalData.user_id || t.request({
                url: "/user/info"
            }).then(function(t) {
                e.globalData.user_id = t.data.user_id, e.globalData.avatar = t.data.avatar, a(t.data);
            }).catch(function(t) {
                n();
            });
        });
    },
    toLogin: function() {
        var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "";
        e ? t.confirm(e, "去登录", function() {
            wx.navigateTo({
                url: "/pages/login/index"
            });
        }) : wx.navigateTo({
            url: "/pages/login/index"
        });
    },
    toPay: function() {
        var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "vip", a = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "";
        a ? t.confirm(a, "去充值", function() {
            wx.navigateTo({
                url: "/pages/pay/pay?type=" + e
            });
        }) : wx.navigateTo({
            url: "/pages/pay/pay?type=" + e
        });
    },
    confirm: function(t) {
        var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "", a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null;
        wx.showModal({
            title: "提示",
            content: t,
            confirmText: e || "确定",
            success: function(t) {
                t.confirm && a && "function" == typeof a && a();
            }
        });
    },
    getWxappSetting: function() {
        var e = getApp();
        return new Promise(function(a, n) {
            e.globalData.wxapp ? a(e.globalData.wxapp) : t.request({
                url: "/wxapp/getSetting",
                data: {
                    version: e.siteinfo.version
                },
                loading: !1
            }).then(function(t) {
                e.globalData.wxapp = t.data, a(t.data);
            });
        });
    },
    message: function(t) {
        var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "none", a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null;
        if (!t) return !0;
        "success" == e ? wx.showToast({
            title: t,
            icon: "success",
            duration: 2e3,
            mask: !1,
            complete: function() {
                a && "function" == typeof a && setTimeout(function() {
                    a();
                }, 1800);
            }
        }) : "none" == e ? wx.showToast({
            title: t,
            icon: "none",
            duration: 2e3,
            mask: !1,
            complete: function() {
                a && "function" == typeof a && setTimeout(function() {
                    a();
                }, 1800);
            }
        }) : "error" == e && wx.showModal({
            title: "系统提示",
            content: t,
            showCancel: !1,
            complete: function() {
                a && "function" == typeof a && a();
            }
        });
    },
    queryToArr: function(t) {
        var e = [], a = [], n = t.split("&");
        for (var o in n) e[(a = n[o].split("="))[0]] = a[1];
        return e;
    }
};

module.exports = t;