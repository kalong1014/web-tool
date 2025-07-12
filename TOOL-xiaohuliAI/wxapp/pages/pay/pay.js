var t = getApp();

Page({
    data: {
        type: "vip",
        is_check: -1,
        is_ios_pay: 0,
        system: "",
        goodsList: [],
        activeIndex: -1,
        userinfo: {
            user_id: 0,
            nickname: "",
            avatar: "",
            balance_point: 0,
            vip_expire_time: ""
        },
        point_title: "积分",
        paying: !1,
        is_agree: !1,
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function(e) {
        var a = this;
        this.setData({
            type: e.type ? e.type : "vip",
            system: t.globalData.system,
            navBarHeight: t.globalData.navBarHeight,
            safeAreaHeight: t.globalData.safeAreaHeight
        }), t.util.getWxappSetting().then(function(t) {
            a.setData({
                is_check: t.is_check,
                is_ios_pay: t.is_ios_pay,
                point_title: t.priceSetting.title || "积分"
            });
        });
        var i = wx.getStorageSync("payAgree");
        this.setData({
            is_agree: !!i
        }), this.getGoodsList();
    },
    onShow: function() {
        this.getUserInfo();
    },
    getGoodsList: function() {
        var e = this;
        t.util.request({
            url: "/order/getGoodsList",
            data: {
                type: this.data.type
            }
        }).then(function(t) {
            var a = t.data;
            a.forEach(function(t, a) {
                t.is_default && e.setData({
                    activeIndex: a
                });
            }), e.setData({
                goodsList: a
            });
        });
    },
    getUserInfo: function() {
        var e = this;
        t.util.request({
            url: "/user/info"
        }).then(function(a) {
            t.globalData.user_id = a.data.user_id, t.globalData.avatar = a.data.avatar, e.setData({
                userinfo: a.data
            });
        });
    },
    chooseGoods: function(t) {
        var e = t.currentTarget.dataset.index;
        this.setData({
            activeIndex: e
        });
    },
    changeType: function(t) {
        var e = t.currentTarget.dataset.type;
        this.setData({
            type: e
        }), this.getGoodsList();
    },
    doPay: function() {
        var e = this;
        if (this.data.paying) return !1;
        var a = this.data.activeIndex;
        if (-1 == a) return t.util.message("请选择套餐"), !1;
        var i = this.data.goodsList[a].id;
        return i ? this.data.is_agree ? (this.setData({
            paying: !0
        }), setTimeout(function() {
            e.setData({
                paying: !1
            }, 2e3);
        }), void t.util.request({
            url: "/order/createOrder",
            data: {
                platform: "wxapp",
                type: this.data.type,
                goods_id: i
            }
        }).then(function(e) {
            wx.requestPayment({
                timeStamp: e.data.timestamp,
                nonceStr: e.data.nonceStr,
                package: e.data.package,
                signType: "MD5",
                paySign: e.data.paySign,
                success: function(e) {
                    t.util.message("支付成功", "error", function() {
                        wx.switchTab({
                            url: "/pages/user/index"
                        });
                    });
                },
                fail: function(e) {
                    console.log("fail", e), t.util.message("支付失败，请重试", "error");
                }
            });
        })) : (t.util.message("请先阅读并同意《服务协议》"), !1) : (t.util.message("请选择套餐"), !1);
    },
    agreeChange: function(t) {
        var e = t.detail.value.length > 0;
        e ? wx.setStorageSync("payAgree", e) : wx.removeStorageSync("payAgree"), this.setData({
            is_agree: e
        });
    },
    toDoc: function(t) {
        var e = t.currentTarget.dataset.type;
        wx.navigateTo({
            url: "/pages/article/article?type=" + e
        });
    },
    toPrice: function() {
        wx.navigateTo({
            url: "/pages/price/price"
        });
    },
    toKefu: function() {
        wx.redirectTo({
            url: "/pages/article/article?type=kefu"
        });
    }
});