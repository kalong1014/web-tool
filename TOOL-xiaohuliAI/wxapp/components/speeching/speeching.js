var t = getApp();

Component({
    properties: {},
    data: {
        action: "send",
        speeching: !1,
        windowHeight: 0,
        safeAreaHeight: 0,
        timeStr: "00:00",
        timeCount: 0,
        timeSi: 0,
        recorderManager: null,
        audioFile: "",
        audioLength: 0
    },
    lifetimes: {
        attached: function() {
            var e = wx.getSystemInfoSync();
            this.setData({
                windowHeight: e.windowHeight,
                safeAreaHeight: t.globalData.safeAreaHeight
            });
        }
    },
    methods: {
        doSend: function() {
            this.data.audioFile ? (console.log("send"), this.triggerEvent("send", {
                audioFile: this.data.audioFile,
                audioLength: this.data.audioLength
            })) : t.util.message("录音失败");
        },
        doCancel: function() {
            console.log("cancel"), clearInterval(this.data.timeSi);
        },
        onTouchMove: function(t) {
            this.data.windowHeight - t.touches[0].clientY > 190 ? this.setData({
                action: "cancel"
            }) : this.setData({
                action: "send"
            });
        },
        onTouchEnd: function() {
            var t = this;
            setTimeout(function() {
                var e = t.data.recorderManager;
                e && e.stop(), console.log("onTouchEnd"), setTimeout(function() {
                    "send" == t.data.action ? t.doSend() : t.doCancel(), t.stopSpeech();
                }, 300);
            }, 200);
        },
        onTouchStart: function() {
            this.setData({
                speeching: !0
            }), this.triggerEvent("stopPlay"), this.startSpeech();
        },
        stopSpeech: function() {
            clearInterval(this.data.timeSi), this.data.recorderManager && this.data.recorderManager.stop(), 
            console.log("stopSpeech"), this.setData({
                timeSi: 0,
                timeCount: 0,
                timeStr: "00:00",
                speeching: !1,
                action: "send",
                recorderManager: null,
                audioFile: "",
                audioLength: 0
            });
        },
        startSpeech: function() {
            var t = this;
            wx.authorize({
                scope: "scope.record",
                success: function() {
                    t.startRecord();
                },
                fail: function() {
                    t.stopSpeech(), wx.showModal({
                        title: "提示",
                        content: "请授权麦克风权限",
                        confirmText: "去授权",
                        success: function(t) {
                            t.confirm && wx.openSetting();
                        }
                    });
                }
            });
        },
        startRecord: function() {
            var e = this, a = wx.getRecorderManager();
            a.onStart(function() {
                var t = setInterval(function() {
                    var t = "", a = e.data.timeCount + 1;
                    if (a >= 60) return e.triggerEvent("send"), void e.stopSpeech();
                    t = a < 10 ? "00:0" + a : "00:" + a, e.setData({
                        timeCount: a,
                        timeStr: t
                    });
                }, 1e3);
                e.setData({
                    timeSi: t
                });
            }), a.onStop(function(a) {
                console.log("onStop"), (!a.duration || a.duration < 1e3) && (t.util.message("时间太短了"), 
                e.setData({
                    action: "cancel"
                })), e.setData({
                    audioFile: a.tempFilePath,
                    audioLength: a.duration
                });
            }), a.onError(function(e) {
                console.log("onError", e);
                var a = "录音启动失败";
                if (-1 != e.errMsg.indexOf("NotFoundError")) a = "没找到麦克风"; else if (-1 != e.errMsg.indexOf("recorder not start")) return;
                t.util.message(a);
            }), a.start({
                sampleRate: 16e3,
                duration: 6e4,
                format: "wav",
                numberOfChannels: 1
            }), this.setData({
                recorderManager: a
            });
        }
    }
});