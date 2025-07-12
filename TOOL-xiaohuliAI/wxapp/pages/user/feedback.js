var t = getApp();

Page({
    data: {
        type: "故障",
        content: "",
        phone: ""
    },
    onLoad: function() {},
    typeChange: function(t) {
        this.setData({
            type: t.detail.value
        });
    },
    doSubmit: function() {
        var e = this.data.type, a = this.data.content, n = this.data.phone;
        "" !== a ? t.util.request({
            url: "/user/feedback",
            data: {
                type: e,
                content: a,
                phone: n
            }
        }).then(function(e) {
            t.util.message(e.message, "error", function() {
                wx.navigateBack();
            });
        }) : t.util.message("请输入反馈内容", "error");
    }
});