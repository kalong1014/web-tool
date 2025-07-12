var t = getApp();

Page({
    data: {
        list: [],
        noMore: 0,
        page: 1
    },
    onLoad: function(t) {
        this.getList();
    },
    onReachBottom: function() {
        this.getList();
    },
    onPullDownRefresh: function() {
        this.setData({
            page: 1,
            list: []
        }), this.getList(), setTimeout(function() {
            wx.hideNavigationBarLoading(), wx.stopPullDownRefresh();
        }, 500);
    },
    getList: function() {
        var a = this, i = this.data.page;
        t.util.request({
            url: "/commission/withdrawList",
            data: {
                page: i
            }
        }).then(function(t) {
            t.data.length > 0 ? a.setData({
                list: a.data.list.concat(t.data),
                noMore: 0,
                page: i + 1
            }) : a.setData({
                noMore: 1
            });
        });
    }
});