var a, t = require("../../@babel/runtime/helpers/defineProperty"), e = "https://mmbiz.qpic.cn/mmbiz/icTdbqWNOwNRna42FI242Lcia07jQodd2FJGIYQfG0LAJGFxM4FbnQP6yfMxBgJ0F3YRqJCJ1aPAK2dQagdusBZg/0", r = getApp();

Page((t(a = {
    data: {
        avatar: e,
        nickname: ""
    },
    onChooseAvatar: function(a) {
        this.setData({
            avatar: a.detail.avatarUrl
        });
    }
}, "onChooseAvatar", function(a) {
    this.setData({
        avatar: a.detail.avatarUrl
    });
}), t(a, "saveUserInfo", function() {
    var a = this.data.avatar, t = this.data.nickname;
    t && "微信用户" != t ? a && a != e ? r.util.upload({
        url: "/upload/image",
        filePath: a
    }).then(function(e) {
        a = e.data.path, r.util.request({
            url: "/user/setUserInfo",
            data: {
                avatar: a,
                nickname: t
            }
        }).then(function(a) {
            wx.navigateBack();
        });
    }) : r.util.message("请设置头像", "error") : r.util.message("请设置昵称", "error");
}), a));