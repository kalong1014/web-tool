require("../../@babel/runtime/helpers/Arrayincludes");

var t = getApp();

Page({
    data: {
        userAvatar: "",
        aiAvatar: "",
        page_title: "",
        lists: [],
        prompt_id: 0,
        prompt: {},
        lang: "简体中文",
        inputHeight: 40,
        activeAiIndex: 0,
        welcome: {},
        aiList: [],
        model4Name: "",
        isGpt4: !1,
        navBarHeight: 0,
        safeAreaHeight: 0
    },
    onLoad: function(a) {
        var e = this;
        a.prompt_id && this.setData({
            prompt_id: a.prompt_id
        }), this.setData({
            safeAreaHeight: t.globalData.safeAreaHeight,
            navBarHeight: t.globalData.navBarHeight,
            userAvatar: t.siteinfo.host + "/static/img/ic_user.png",
            aiAvatar: t.siteinfo.host + "/static/img/ic_ai.png"
        }), t.util.getWxappSetting().then(function(t) {
            e.setData({
                share_title: t.share_title,
                share_image: t.share_image,
                aiList: t.aiList,
                model4Name: t.model4Name
            }), e.switchDefaultAi();
        }), this.getPrompt();
    },
    onShow: function() {
        t.globalData.avatar && this.setData({
            userAvatar: t.globalData.avatar
        });
    },
    sendText: function() {
        this.selectComponent("#msgList" + this.data.activeAiIndex).sendText(this.data.message, this.data.lang);
    },
    sendConfirm: function() {
        var t = this;
        setTimeout(function() {
            t.sendText();
        }, 50);
    },
    onTabChange: function(a) {
        var e = a.detail, i = this.isGpt4(e.name);
        this.setData({
            activeAiIndex: e.index,
            isGpt4: i
        }), i && t.util.message("您已进入【" + this.data.model4Name + "】");
    },
    onSwiperChange: function(a) {
        var e = a.detail.current, i = this.isGpt4(this.data.aiList[e].name);
        this.setData({
            activeAiIndex: e,
            isGpt4: i
        }), i && t.util.message("您已进入【" + this.data.model4Name + "】");
    },
    switchDefaultAi: function() {
        var t = this, a = wx.getStorageSync("ai");
        a && this.data.aiList.forEach(function(e, i) {
            e.name == a && (e.index = i, t.onTabChange({
                detail: e
            }));
        });
    },
    inputChange: function(t) {
        var a = t.detail.value;
        this.setData({
            message: a
        });
    },
    setMessage: function(t) {
        this.setData({
            message: t.detail
        });
    },
    isGpt4: function(t) {
        return [ "openai4", "diy42", "diy43", "azure_openai4", "wenxin4", "claude2", "zhipu4", "hunyuan4" ].includes(t);
    },
    getPrompt: function() {
        var a = this;
        t.util.request({
            url: "/write/getPrompt",
            data: {
                prompt_id: this.data.prompt_id
            }
        }).then(function(t) {
            var e = t.data;
            a.setData({
                prompt: e
            }), a.setData({
                page_title: e.title,
                welcome: {
                    title: e.title,
                    desc: e.welcome ? e.welcome : e.hint,
                    tips: e.tips
                }
            });
            var i = 36;
            e.hint && (e.hint.length > 19 ? i = 72 : e.hint.length > 38 && (i = 108)), a.setData({
                inputHeight: i
            });
        });
    },
    onShareAppMessage: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image,
            path: "/pages/index/index?tuid=" + t.globalData.user_id
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