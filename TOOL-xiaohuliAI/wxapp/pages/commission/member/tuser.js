var t = getApp();

Page({
    data: {
        list: [],
        page: 1,
        noMore: 0,
        curTab: 1
    },
    onLoad: function() {
        this.getList();
    },
    switchTab: function(t) {
        var a = t.currentTarget.dataset.index;
        this.setData({
            curTab: a,
            page: 1,
            list: [],
            noMore: 0
        }), this.getList();
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
        var a = this, e = this.data.page, s = this.data.curTab;
        t.util.request({
            url: "/commission/tuserList",
            data: {
                type: s,
                page: e
            }
        }).then(function(t) {
            t.data.length > 0 ? a.setData({
                list: a.data.list.concat(t.data),
                noMore: 0,
                page: e + 1
            }) : a.setData({
                noMore: 1
            });
        });
    }
});