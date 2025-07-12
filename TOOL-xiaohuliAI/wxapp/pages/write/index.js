var t = require("../../utils/tabbar.js"), e = getApp();

Page({
    data: {
        topicList: [ {
            id: "vote",
            title: "收藏"
        }, {
            id: "all",
            title: "全部"
        } ],
        tabWidth: 160,
        promptList: [],
        promptCount: 0,
        page: 1,
        pagesize: 10,
        scrollTop: 0,
        topic_id: "all",
        keyword: "",
        share_title: "",
        share_image: "",
        isLogin: !1,
        activeTopicIndex: 1,
        navBarHeight: 0,
        safeAreaHeight: 0,
        isSearch: !1,
        searchTabs: [ {
            id: "search",
            title: "搜索结果"
        } ]
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
            i.getTopicList(), i.setData({
                isLogin: !!e.globalData.user_id
            });
        }).catch(function(t) {
            i.getTopicList();
        }), e.util.getWxappSetting().then(function(e) {
            t.init(i, e.tabbar), i.setData({
                share_title: e.share_title,
                share_image: e.share_image
            });
        });
    },
    onShow: function() {
        "function" == typeof this.getTabBar && this.getTabBar() && this.getTabBar().setData({
            selected: "write"
        }), this.setData({
            isLogin: !!e.globalData.user_id
        });
    },
    onTabChange: function(t) {
        var e = t.detail;
        this.setData({
            activeTopicIndex: e.index
        });
    },
    onSwiperChange: function(t) {
        var e = t.detail.current;
        this.setData({
            activeTopicIndex: e
        });
    },
    getTopicList: function() {
        var t = this;
        e.util.request({
            url: "/write/getTopicList"
        }).then(function(e) {
            t.setData({
                topicList: t.data.topicList.concat(e.data)
            });
        });
    },
    clearKeyword: function() {
        this.selectComponent("#search") && this.selectComponent("#search").clearList(), 
        this.setData({
            keyword: "",
            isSearch: !1
        });
    },
    doSearch: function() {
        var t = this, e = this.data.keyword;
        e ? (this.setData({
            isSearch: !0
        }), setTimeout(function() {
            t.selectComponent("#search").getPrompts(e);
        }, 100)) : this.clearKeyword();
    },
    onShareAppMessage: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image,
            path: "/pages/write/index?tuid=" + e.globalData.user_id
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