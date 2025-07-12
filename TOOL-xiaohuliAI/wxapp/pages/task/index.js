var a = getApp(), t = null;

Page({
    data: {
        balance: 0,
        vip_expire_time: "",
        tasks: null,
        safeAreaHeight: 0,
        activeAiIndex: 0,
        point_title: "积分"
    },
    onLoad: function(t) {
        var e = this;
        this.setData({
            navBarHeight: a.globalData.navBarHeight,
            safeAreaHeight: a.globalData.safeAreaHeight
        }), a.util.getWxappSetting().then(function(a) {
            e.setData({
                point_title: a.priceSetting.title || "积分"
            });
        });
    },
    onShow: function() {
        a.globalData.user_id ? this.getTasks() : a.util.toLogin();
    },
    getTasks: function() {
        var e = this;
        a.util.request({
            url: "/task/getTasks",
            data: {
                platform: "wxapp"
            }
        }).then(function(a) {
            e.setData({
                tasks: a.data
            }), a.data && a.data.ad && !t && e.initRewardAd();
        });
    },
    getBalance: function() {
        var t = this;
        a.util.request({
            url: "/user/getBalance",
            loading: !1
        }).then(function(a) {
            t.setData({
                balance: a.data.balance,
                vip_expire_time: a.data.vip_expire_time
            });
        });
    },
    toShare: function() {
        wx.navigateTo({
            url: "/pages/commission/share"
        });
    },
    initRewardAd: function() {
        var e = this;
        t = null;
        var i = this.data.tasks.ad.ad_unit_id;
        wx.createRewardedVideoAd && !t && ((t = wx.createRewardedVideoAd({
            adUnitId: i
        })).onLoad(function() {
            console.log("reward ad onload");
        }), t.onError(function(a) {
            console.log("reward ad error"), e.initRewardAd();
        }), t.onClose(function(t) {
            console.log("reward ad onclose", t), t && t.isEnded && a.util.request({
                url: "/task/doPlayAd",
                data: {
                    ad_unit_id: i
                },
                loading: !1
            }).then(function(t) {
                a.util.message(t.message), e.getTasks();
            });
        }));
    },
    showTaskAd: function() {
        if (wx.showLoading({
            title: "加载中"
        }), t || this.initRewardAd(), !t) return wx.hideLoading(), void a.util.message("广告加载失败，请重试", "error");
        t.load().then(function() {
            t.show(), setTimeout(function() {
                wx.hideLoading();
            }, 1500);
        }).catch(function() {
            wx.hideLoading(), a.util.message("广告加载失败，请重试", "error");
        });
    }
});