var t = getApp();

Page({
    data: {
        list: [],
        page: 1,
        noMore: 0
    },
    onLoad: function() {
        this.getList();
    },
    onReachBottom: function() {
        this.getList();
    },
    onPullDownRefresh: function() {
        this.setData({
            page: 1,
            list: [],
            noMore: 0
        }), this.getList();
    },
    getList: function() {
        var e = this, a = this.data.page;
        t.util.request({
            url: "/commission/memberList",
            page: a
        }).then(function(t) {
            t.data.length > 0 ? e.setData({
                list: e.data.list.concat(t.data),
                noMore: 0,
                page: a + 1
            }) : e.setData({
                noMore: 1
            });
        });
    }
});