var t = getApp();

Page({
    data: {
        pageIsLoad: !1,
        shareTitle: "",
        shareImage: "",
        timeline_share_id: 0,
        siteroot: "",
        index_type: "chat",
        content: null
    },
    onLoad: function(e) {
        var a = this;
        if (e.tuid) wx.setStorageSync("tuid", e.tuid); else if (e.scene) {
            var i = t.util.queryToArr(decodeURIComponent(e.scene));
            i.tuid && wx.setStorageSync("tuid", i.tuid);
        }
        this.setData({
            siteroot: t.globalData.siteroot
        }), t.util.getWxappSetting().then(function(t) {
            a.setData({
                share_title: t.share_title,
                share_image: t.share_image
            });
        });
    },
    onShareAppMessage: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image,
            path: "/pages/write/index?tuid=" + t.globalData.user_id
        };
    },
    onShareTimeline: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image,
            query: "tuid=" + t.globalData.user_id
        };
    },
    onAddToFavorites: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image
        };
    }
});