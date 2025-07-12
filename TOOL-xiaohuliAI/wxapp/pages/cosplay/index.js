var t = require("../../utils/tabbar.js"), e = getApp();

Page({
    data: {
        allRoles: [],
        share_title: "",
        share_image: "",
        navBarHeight: 0,
        safeAreaHeight: 0,
        refreshing: !1
    },
    onLoad: function(a) {
        var i = this;
        if (a.tuid) wx.setStorageSync("tuid", a.tuid); else if (a.scene) {
            var s = e.util.queryToArr(decodeURIComponent(a.scene));
            s.tuid && wx.setStorageSync("tuid", s.tuid);
        }
        this.setData({
            navBarHeight: e.globalData.navBarHeight,
            safeAreaHeight: e.globalData.safeAreaHeight
        }), e.util.checkWxappLogin().then(function() {
            i.getAllRoles();
        }).catch(function(t) {
            i.getAllRoles();
        }), e.util.getWxappSetting().then(function(e) {
            t.init(i, e.tabbar), i.setData({
                share_title: e.share_title,
                share_image: e.share_image
            });
        });
    },
    onShow: function() {
        "function" == typeof this.getTabBar && this.getTabBar() && this.getTabBar().setData({
            selected: "cosplay"
        });
    },
    getAllRoles: function() {
        var t = this;
        setTimeout(function() {
            t.setData({
                refreshing: !1
            });
        }, 1e3), e.util.request({
            url: "/cosplay/getAllRoles"
        }).then(function(e) {
            t.setData({
                allRoles: e.data
            });
        });
    },
    toCosplayChat: function(t) {
        var e = t.currentTarget.dataset.id;
        wx.navigateTo({
            url: "/pages/cosplay/chat?role_id=" + e
        });
    },
    onShareAppMessage: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image,
            path: "/pages/cosplay/index?tuid=" + e.globalData.user_id
        };
    },
    onShareTimeline: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image,
            query: "tuid=" + e.globalData.user_id
        };
    },
    onAddToFavorites: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image
        };
    }
});