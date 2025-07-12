var i = getApp();

Page({
    data: {
        member: {},
        commission: {}
    },
    onShow: function() {
        this.getData();
    },
    getData: function() {
        var e = this;
        i.util.request({
            url: "/commission/index"
        }).then(function(i) {
            i.data ? e.setData({
                member: i.data.member,
                commission: i.data.commission
            }) : wx.redirectTo({
                url: "/pages/commission/apply"
            });
        });
    },
    toWithdraw: function() {
        var e = this.data.commission;
        e && e.money ? wx.navigateTo({
            url: "/pages/commission/withdraw/index?money=" + e.money
        }) : i.util.message("暂无可提现佣金");
    },
    onPullDownRefresh: function() {
        this.getData(), setTimeout(function() {
            wx.hideNavigationBarLoading(), wx.stopPullDownRefresh();
        }, 500);
    },
    toShare: function() {
        i.util.message("请回到首页，点右上角“...”，转发给朋友", "error", function() {
            wx.switchTab({
                url: "/pages/index/index",
                fail: function() {
                    wx.reLaunch({
                        url: "/pages/index/index"
                    });
                }
            });
        });
    }
});