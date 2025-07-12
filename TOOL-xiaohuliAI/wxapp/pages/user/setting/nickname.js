var a = getApp();

Page({
    data: {
        nickname: ""
    },
    onLoad: function(a) {
        a.nickname && this.setData({
            nickname: a.nickname
        });
    },
    doSubmit: function() {
        var e = this.data.nickname;
        e ? a.util.request({
            url: "/user/setUserNickname",
            data: {
                nickname: e
            }
        }).then(function(e) {
            a.util.message(e.message), wx.navigateBack();
        }) : a.util.message("请输入昵称");
    }
});