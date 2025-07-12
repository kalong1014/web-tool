require("../../@babel/runtime/helpers/Arrayincludes");

var t = require("../../utils/tabbar.js"), e = getApp(), a = null;

Page({
    data: {
        userAvatar: "",
        aiAvatar: "",
        isLogin: !1,
        message: "",
        page_title: "",
        chatSetting: {},
        userinfo: {},
        activeAiIndex: 0,
        model4Name: "",
        is_check: !1,
        navBarHeight: 0,
        safeAreaHeight: 0,
        welcome: {
            title: "",
            desc: "",
            tips: ""
        },
        aiList: [],
        isGpt4: !1,
        notice: null,
        inputModel: "text",
        speechIsOpen: !1,
        playingTextList: [],
        playingAudioList: [],
        playingAiIndex: 0,
        playingMsgIndex: 0,
        playingRowIndex: 0,
        playingSi: 0,
        audioContext: null
    },
    onLoad: function(a) {
        var i = this;
        if (this.setData({
            safeAreaHeight: e.globalData.safeAreaHeight,
            navBarHeight: e.globalData.navBarHeight,
            userAvatar: e.siteinfo.host + "/static/img/ic_user.png",
            aiAvatar: e.siteinfo.host + "/static/img/ic_ai.png"
        }), a.tuid) wx.setStorageSync("tuid", a.tuid); else if (a.scene) {
            var n = e.util.queryToArr(decodeURIComponent(a.scene));
            n.tuid && wx.setStorageSync("tuid", n.tuid);
        }
        e.util.getWxappSetting().then(function(e) {
            t.init(i, e.tabbar), i.setData({
                page_title: e.page_title,
                share_title: e.share_title,
                share_image: e.share_image,
                model4Name: e.model4Name,
                aiList: e.aiList,
                speechIsOpen: !!e.speechIsOpen
            }), i.switchDefaultAi();
            var a = wx.getStorageSync("inputModel");
            i.setData({
                inputModel: "audio" === a && e.speechIsOpen ? "audio" : "text"
            }), i.getChatSetting();
        }), this.getIndexAd(), setTimeout(function() {
            i.getNotice();
        }, 3e3);
    },
    onShow: function() {
        var t = this;
        "function" == typeof this.getTabBar && this.getTabBar() && this.getTabBar().setData({
            selected: "chat"
        }), e.globalData.avatar && this.setData({
            userAvatar: e.globalData.avatar
        });
        var a = wx.getStorageSync("chatPrompt");
        a && this.setData({
            message: a
        }), e.util.checkLogin().then(function(e) {
            e.avatar && t.setData({
                userAvatar: e.avatar
            });
        });
    },
    sendText: function() {
        this.stopPlay(), this.selectComponent("#msgList" + this.data.activeAiIndex).sendText(this.data.message), 
        wx.removeStorageSync("chatPrompt");
    },
    sendAudio: function(t) {
        var a = this;
        if (t.detail) {
            this.stopPlay();
            var i = t.detail.audioFile, n = t.detail.audioLength;
            e.util.upload({
                url: "/speech/audio2text",
                name: "file",
                filePath: i
            }).then(function(t) {
                t.data.text ? a.selectComponent("#msgList" + a.data.activeAiIndex).sendText(t.data.text, t.data.audio, n) : e.util.message("语音解析失败");
            });
        }
    },
    sendConfirm: function() {
        var t = this;
        setTimeout(function() {
            t.sendText();
        }, 50);
    },
    onTabChange: function(t) {
        this.switchAi(t.detail.index);
    },
    onSwiperChange: function(t) {
        var e = t.detail.current;
        this.switchAi(e);
    },
    switchAi: function(t) {
        var a = this.data.aiList[t].name, i = this.isGpt4(a);
        this.setData({
            activeAiIndex: t,
            isGpt4: i
        }), wx.setStorageSync("ai", a), i && e.util.message("您已进入【" + this.data.model4Name + "】");
    },
    switchDefaultAi: function() {
        var t = this, e = wx.getStorageSync("ai");
        e && this.data.aiList.forEach(function(a, i) {
            a.name == e && (a.index = i, t.switchAi(i));
        });
    },
    switchInputModel: function() {
        var t = "audio" === this.data.inputModel ? "text" : "audio";
        wx.setStorageSync("inputModel", t), this.setData({
            inputModel: t
        });
    },
    startPlay: function(t) {
        var e = this;
        this.stopPlay();
        var a = t.detail.aiIndex, i = t.detail.msgIndex, n = this.selectComponent("#player"), s = this.selectComponent("#msgList" + a), o = s.data.lists[i].message;
        o && (s.setPlayStart(i), o.split("\n").forEach(function(t) {
            n.addToList(e.trim(t));
        }), n.addToList("[end]"), this.setData({
            playingAiIndex: a,
            playingMsgIndex: i
        }));
    },
    stopPlay: function() {
        this.selectComponent("#player").stopPlay();
    },
    onPlayerEnd: function() {
        var t = this.data.playingAiIndex, e = this.data.playingMsgIndex;
        this.selectComponent("#msgList" + t).setPlayStop(e), this.setData({
            playingAiIndex: 0,
            playingMsgIndex: 0
        });
    },
    addToPlay: function(t) {
        var e = this.trim(t.detail.text), a = t.detail.aiIndex, i = t.detail.msgIndex;
        e && (this.setData({
            playingAiIndex: a,
            playingMsgIndex: i
        }), this.selectComponent("#player").addToList(e));
    },
    playAudio: function(t) {
        var e = t.detail.audio, a = t.detail.aiIndex, i = t.detail.msgIndex, n = this.selectComponent("#player"), s = this.selectComponent("#msgList" + a);
        e && (n.playAudio(e), s.setPlayStart(i), this.setData({
            playingAiIndex: a,
            playingMsgIndex: i
        }));
    },
    inputChange: function(t) {
        var e = t.detail.value;
        this.setData({
            message: e
        }), wx.setStorageSync("chatPrompt", e);
    },
    setMessage: function(t) {
        this.setData({
            message: t.detail
        });
    },
    isGpt4: function(t) {
        return [ "openai4", "diy42", "diy43", "azure_openai4", "wenxin4", "claude2", "zhipu4", "hunyuan4" ].includes(t);
    },
    trim: function(t) {
        return t && (t = t.replace(/(^\s*)|(\s*$)/g, "")), t;
    },
    getChatSetting: function() {
        var t = this;
        e.util.request({
            url: "/chat/getChatSetting"
        }).then(function(e) {
            var a = t.data.page_title, i = e.data.welcome ? e.data.welcome : "请输入你的问题", n = e.data.tips;
            t.setData({
                welcome: {
                    title: a,
                    desc: i || "",
                    tips: n || ""
                }
            });
        });
    },
    getNotice: function() {
        var t = this;
        e.util.request({
            url: "/login/getNotice",
            data: {
                platform: "h5"
            },
            loading: !1
        }).then(function(e) {
            t.setData({
                notice: e.data
            });
        });
    },
    getIndexAd: function() {
        var t = this;
        e.util.request({
            url: "/wxapp/getIndexAd",
            loading: !1
        }).then(function(e) {
            t.setData({
                ad: e.data
            }), t.initInterAd();
        });
    },
    initInterAd: function() {
        var t = this.data.ad;
        if (!a && t.inter_is_open && t.inter_unit_id) {
            var e = new Date().getTime(), i = wx.getStorageSync("insertAdLastShow");
            i && e - i < 18e5 || wx.createInterstitialAd && (a = wx.createInterstitialAd({
                adUnitId: t.inter_unit_id
            })).onLoad(function() {
                wx.setStorageSync("insertAdLastShow", e), a.show();
            });
        }
    },
    onShareAppMessage: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image,
            path: "/pages/index/index?tuid=" + e.globalData.user_id
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