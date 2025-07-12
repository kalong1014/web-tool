var t = getApp();

Page({
    data: {
        list: [],
        noMore: 0,
        page: 1,
        type: "all"
    },
    onLoad: function(t) {
        t.type && this.setData({
            type: t.type
        }), this.getList();
    },
    onReachBottom: function() {
        this.getList();
    },
    onPullDownRefresh: function() {
        this.refreshList(), setTimeout(function() {
            wx.hideNavigationBarLoading(), wx.stopPullDownRefresh();
        }, 500);
    },
    getList: function() {
        var e = this, a = this.data.page;
        t.util.request({
            url: "/commission/billList",
            data: {
                type: this.data.type,
                page: a
            }
        }).then(function(t) {
            t.data.length > 0 ? e.setData({
                list: e.data.list.concat(t.data),
                noMore: 0,
                page: a + 1
            }) : e.setData({
                noMore: 1
            });
        });
    },
    switchTab: function(t) {
        var e = t.currentTarget.dataset.type;
        this.setData({
            type: e
        }), this.refreshList();
    },
    refreshList: function() {
        this.setData({
            page: 1,
            list: []
        }), this.getList();
    }
});