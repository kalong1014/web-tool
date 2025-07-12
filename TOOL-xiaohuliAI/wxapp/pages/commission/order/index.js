var t = getApp();

Page({
    data: {
        orderList: [],
        noMore: 0,
        page: 1,
        showStatus: "all"
    },
    onLoad: function(t) {
        t.status && this.setData({
            showStatus: t.status
        }), this.getOrderList();
    },
    getOrderList: function() {
        var s = this, e = this.data.page, a = this.data.orderList;
        t.util.request({
            url: "/commission/orderList",
            data: {
                page: e
            }
        }).then(function(t) {
            t.data.length > 0 ? s.setData({
                orderList: a.concat(t.data),
                noMore: 0,
                page: e + 1
            }) : s.setData({
                noMore: 1
            });
        });
    },
    switchTab: function(t) {
        var s = t.currentTarget.dataset.status;
        this.setData({
            showStatus: s
        }), this.refreshList();
    },
    refreshList: function() {
        this.setData({
            page: 1,
            orderList: []
        }), this.getOrderList();
    },
    onPullDownRefresh: function() {
        this.refreshList(), setTimeout(function() {
            uni.hideNavigationBarLoading(), uni.stopPullDownRefresh();
        }, 500);
    },
    onReachBottom: function() {
        this.getOrderList();
    }
});