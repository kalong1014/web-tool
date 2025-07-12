var t = getApp();

Page({
    data: {
        avatar: "",
        nickname: "",
        phone: "",
        phoneFull: "",
        openid: "",
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function() {
        this.setData({
            navBarHeight: t.globalData.navBarHeight,
            safeAreaHeight: t.globalData.safeAreaHeight
        });
    },
    onShow: function() {
        this.getUserInfo(), this.getAccounts();
    },
    getUserInfo: function() {
        var a = this;
        t.util.request({
            url: "/user/info"
        }).then(function(t) {
            a.setData({
                avatar: t.data.avatar,
                nickname: t.data.nickname
            });
        });
    },
    getAccounts: function() {
        var a = this;
        t.util.request({
            url: "/user/getAccounts"
        }).then(function(t) {
            var e = t.data.phone;
            a.setData({
                phone: e ? e.substr(0, 3) + "****" + e.substr(7) : "",
                phoneFull: e,
                openid: t.data.openid
            });
        });
    },
    uploadAvatar: function() {
        var a = this;
        wx.chooseImage({
            count: 1,
            success: function(e) {
                wx.showLoading({
                    title: "正在上传"
                }), t.util.upload({
                    url: "/upload/image",
                    filePath: e.tempFilePaths[0]
                }).then(function(t) {
                    var e = t.data.path;
                    wx.hideLoading(), a.setData({
                        avatar: e
                    }), a.setAvatar();
                });
            }
        });
    },
    setAvatar: function() {
        var a = this;
        t.util.request({
            url: "/user/setUserAvatar",
            data: {
                avatar: this.data.avatar
            }
        }).then(function(e) {
            t.util.message("设置成功"), a.getUserInfo();
        });
    },
    toEditNickname: function() {
        wx.navigateTo({
            url: "/pages/user/setting/nickname?nickname=" + this.data.nickname
        });
    },
    toBindPhone: function() {
        wx.navigateTo({
            url: "/pages/user/setting/bindphone?phone=" + this.data.phoneFull
        });
    },
    toBindWechat: function() {
        wx.navigateTo({
            url: "/pages/user/setting/bindwechat"
        });
    },
    doLogout: function() {
        t.util.request({
            url: "/user/logout"
        }).then(function(a) {
            t.globalData.user_id = 0, t.globalData.avatar = "", wx.removeStorageSync("token"), 
            t.util.message(a.message, "error", function() {
                wx.reLaunch({
                    url: "/pages/index/index"
                });
            });
        });
    }
});