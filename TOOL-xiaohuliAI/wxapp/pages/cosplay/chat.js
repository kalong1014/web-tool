require("../../@babel/runtime/helpers/Arrayincludes");

var t = getApp();

Page({
    data: {
        page_title: "",
        userAvatar: "",
        aiAvatar: "",
        lists: [],
        role: {},
        role_id: 0,
        navBarHeight: 0,
        safeAreaHeight: 0,
        activeAiIndex: 0,
        welcome: {},
        aiList: [],
        model4Name: "",
        isGpt4: !1,
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
    onLoad: function(e) {
        var a = this;
        e.role_id && this.setData({
            role_id: e.role_id
        }), this.setData({
            safeAreaHeight: t.globalData.safeAreaHeight,
            navBarHeight: t.globalData.navBarHeight,
            userAvatar: t.siteinfo.host + "/static/img/ic_user.png",
            aiAvatar: t.siteinfo.host + "/static/img/ic_ai.png"
        }), t.util.getWxappSetting().then(function(t) {
            a.setData({
                share_title: t.share_title,
                share_image: t.share_image,
                aiList: t.aiList,
                model4Name: t.model4Name,
                speechIsOpen: !!t.speechIsOpen
            }), a.switchDefaultAi();
        }), this.getRole();
    },
    onShow: function() {
        t.globalData.avatar && this.setData({
            userAvatar: t.globalData.avatar
        });
    },
    sendText: function() {
        this.selectComponent("#msgList" + this.data.activeAiIndex).sendText(this.data.message);
    },
    sendAudio: function(e) {
        var a = this;
        if (e.detail) {
            this.stopPlay();
            var i = e.detail.audioFile, s = e.detail.audioLength;
            t.util.upload({
                url: "/speech/audio2text",
                name: "file",
                filePath: i
            }).then(function(e) {
                e.data.text ? a.selectComponent("#msgList" + a.data.activeAiIndex).sendText(e.data.text, e.data.audio, s) : t.util.message("语音解析失败");
            });
        }
    },
    sendConfirm: function() {
        var t = this;
        setTimeout(function() {
            t.sendText();
        }, 50);
    },
    onTabChange: function(e) {
        var a = e.detail, i = this.isGpt4(a.name);
        this.setData({
            activeAiIndex: a.index,
            isGpt4: i
        }), i && t.util.message("您已进入【" + this.data.model4Name + "】");
    },
    onSwiperChange: function(e) {
        var a = e.detail.current, i = this.isGpt4(this.data.aiList[a].name);
        this.setData({
            activeAiIndex: a,
            isGpt4: i
        }), i && t.util.message("您已进入【" + this.data.model4Name + "】");
    },
    switchDefaultAi: function() {
        var t = this, e = wx.getStorageSync("ai");
        e && this.data.aiList.forEach(function(a, i) {
            a.name == e && (a.index = i, t.onTabChange({
                detail: a
            }));
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
        var a = t.detail.aiIndex, i = t.detail.msgIndex, s = this.selectComponent("#player"), n = this.selectComponent("#msgList" + a), l = n.data.lists[i].message;
        l && (n.setPlayStart(i), l.split("\n").forEach(function(t) {
            s.addToList(e.trim(t));
        }), s.addToList("[end]"), this.setData({
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
        var e = t.detail.audio, a = t.detail.aiIndex, i = t.detail.msgIndex, s = this.selectComponent("#player"), n = this.selectComponent("#msgList" + a);
        e && (s.playAudio(e), n.setPlayStart(i), this.setData({
            playingAiIndex: a,
            playingMsgIndex: i
        }));
    },
    inputChange: function(t) {
        var e = t.detail.value;
        this.setData({
            message: e
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
    trim: function(t) {
        return t && (t = t.replace(/(^\s*)|(\s*$)/g, "")), t;
    },
    getRole: function() {
        var e = this;
        t.util.request({
            url: "/cosplay/getRole",
            data: {
                role_id: this.data.role_id
            }
        }).then(function(t) {
            var a = t.data;
            e.setData({
                role: a
            }), e.setData({
                page_title: a.title,
                welcome: {
                    title: a.title,
                    desc: a.welcome ? a.welcome : a.hint,
                    tips: a.tips
                }
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