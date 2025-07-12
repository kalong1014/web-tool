var t = getApp();

Component({
    properties: {},
    data: {
        playingList: [],
        playing: !1,
        playingIndex: -1
    },
    lifetimes: {
        attached: function() {
            this.initAudioPlayer(), this.startListener();
        }
    },
    methods: {
        initAudioPlayer: function() {
            var a = this, i = wx.createInnerAudioContext({
                useWebAudioImplement: !0
            });
            i.onPlay(function() {
                wx.hideLoading();
            }), i.onEnded(function() {
                a.setData({
                    playing: !1
                });
            }), i.onError(function(i) {
                a.setData({
                    playing: !1
                }), t.util.message("播放失败");
            }), this.setData({
                audioContext: i
            });
        },
        addToList: function(t) {
            t && this.data.playingList.push({
                text: t,
                audio: "",
                state: 0
            });
        },
        startListener: function() {
            var t = this, a = setInterval(function() {
                var a = t.data.playingList, i = t.data.playingIndex;
                a[i + 1] && (a[i + 1].audio ? t.data.playing || (t.setData({
                    playingIndex: i + 1
                }), t.startPlay()) : 0 == a[i + 1].state && ("[end]" != a[i + 1].text ? t.text2Audio(i + 1) : t.data.playing || t.stopPlay()));
            }, 200);
            this.setData({
                listener: a
            });
        },
        stopListener: function() {
            clearInterval(this.data.listener);
        },
        startPlay: function() {
            this.setData({
                playing: !0
            });
            var t = this.data.playingList, a = this.data.playingIndex, i = this.data.audioContext;
            i.src = t[a].audio, i.play();
        },
        stopPlay: function() {
            var t = this.data.audioContext, a = this.data.audioContext2;
            t && t.stop(), a && a.stop(), this.setData({
                playingList: [],
                playing: !1,
                playingIndex: -1
            }), this.triggerEvent("end");
        },
        text2Audio: function(a) {
            var i = this, n = this.data.playingList;
            if (n[a]) {
                var e = n[a].text;
                this.setListState(a, 1), t.util.request({
                    url: "/speech/text2Audio",
                    data: {
                        text: e
                    },
                    loading: !1
                }).then(function(t) {
                    var n = i.data.playingList;
                    n[a] && (n[a].audio = t.data, n[a].state = 1, i.setData({
                        playingList: n
                    }));
                }).catch(function(t) {
                    i.stopPlay();
                });
            }
        },
        setListState: function(t, a) {
            var i = this.data.playingList;
            i[t] && (i[t].state = a, this.setData({
                playingList: i
            }));
        },
        playAudio: function(a) {
            var i = this;
            this.stopPlay();
            var n = wx.createInnerAudioContext({
                useWebAudioImplement: !0
            });
            wx.setInnerAudioOption({
                obeyMuteSwitch: !1
            }), n.src = a, n.onEnded(function() {
                i.stopPlay(), n = null;
            }), n.onError(function(a) {
                i.stopPlay(), n = null, t.util.message("播放失败");
            }), n.play(), this.setData({
                audioContext2: n
            });
        }
    }
});