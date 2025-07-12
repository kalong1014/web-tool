var t = getApp();

Page({
    data: {
        contents: ""
    },
    onLoad: function(e) {
        var a = this, i = e.type, c = "文章内容";
        switch (e.type) {
          case "about":
            c = "关于我们";
            break;

          case "kefu":
            c = "联系客服";
            break;

          case "privacy":
            c = "隐私政策";
            break;

          case "service":
            c = "服务协议";
            break;

          case "notice":
            c = "通知公告";
            break;

          case "legal":
            c = "免责声明";
            break;

          case "commission":
            c = "推广协议";
        }
        wx.setNavigationBarTitle({
            title: c
        });
        var s = {
            type: i
        };
        "help" == i && e.id && (s.id = e.id), t.util.request({
            url: "/article/getArticle",
            data: s
        }).then(function(t) {
            a.setData({
                content: t.data.content
            }), t.data.title && wx.setNavigationBarTitle({
                title: t.data.title
            });
        });
    }
});