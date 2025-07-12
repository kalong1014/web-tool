var t = getApp();

Page({
    data: {
        code: "",
        card: null,
        hasModel4: !1,
        model4Name: "高级版",
        point_title: "积分"
    },
    onLoad: function() {
        var e = this;
        t.util.getWxappSetting().then(function(t) {
            e.setData({
                hasModel4: t.hasModel4,
                model4Name: t.model4Name,
                point_title: t.priceSetting.title || "积分"
            });
        });
    },
    getCardInfo: function() {
        var e = this;
        t.util.request({
            url: "/user/getCardInfo",
            data: {
                code: this.data.code
            }
        }).then(function(t) {
            e.setData({
                card: t.data
            });
        });
    },
    doInput: function() {
        this.setData({
            card: null
        });
    },
    bindCard: function() {
        t.util.request({
            url: "/user/bindCard",
            data: {
                code: this.data.code
            }
        }).then(function(e) {
            t.util.message(e.message, "error", function() {
                wx.navigateBack();
            });
        });
    }
});