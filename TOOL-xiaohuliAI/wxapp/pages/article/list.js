var t = getApp();

Page({
    data: {
        type: "",
        list: []
    },
    onLoad: function(a) {
        var e = this, i = a.type;
        this.setData({
            type: i
        }), "help" == i && wx.setNavigationBarTitle({
            title: "使用教程"
        }), t.util.request({
            url: "/article/getList",
            data: {
                type: i
            }
        }).then(function(t) {
            e.setData({
                list: t.data.list
            });
        });
    },
    toArticle: function(t) {
        var a = t.currentTarget.dataset.id;
        wx.navigateTo({
            url: "/pages/article/article?type=" + this.data.type + "&id=" + a
        });
    }
});