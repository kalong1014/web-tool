require("../../@babel/runtime/helpers/Arrayincludes");

var t = getApp();

Component({
    properties: {
        aiName: {
            type: String,
            default: ""
        },
        aiIndex: {
            type: Number,
            default: 0
        },
        activeAiIndex: {
            type: Number,
            default: 0
        },
        welcome: {
            type: Object,
            default: {}
        },
        userAvatar: {
            type: String,
            default: "/images/ic_user.png"
        },
        aiAvatar: {
            type: String,
            default: "/images/ic_ai.png"
        },
        speechIsOpen: {
            type: Boolean,
            default: !1
        }
    },
    options: {
        pureDataPattern: /^_/
    },
    data: {
        group_id: 0,
        lists: null,
        message: "",
        writingText: "",
        writing: !1,
        page: 1,
        pagesize: 10,
        lastViewId: "lastViewId",
        _audioTemp: "",
        _textStacks: [],
        _textOutputSi: 0,
        _requestTask: null
    },
    observers: {
        activeAiIndex: function() {
            var t = this.data.aiIndex, a = this.data.activeAiIndex, e = this.data.lists;
            t >= a - 1 && t <= a + 1 && null === e && this.getHistoryMsg();
        }
    },
    methods: {
        sendText: function(a) {
            var e = this, i = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "", s = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 0;
            if (!this.data.writing) if (a = this.trim(a)) {
                this.data._textOutputSi && (clearInterval(this.data._textOutputSi), this.setData({
                    _textOutputSi: 0,
                    _textStacks: []
                }));
                var n = this.data.lists;
                n.push({
                    user: "我",
                    message: a,
                    audio: i,
                    audio_length: Math.ceil(s / 1e3)
                }), this.setMessage(""), this.setData({
                    writing: !0,
                    lists: n
                }), this.scrollToBottom();
                var r = setInterval(function() {
                    if (e.data._textStacks.length > 0) {
                        var t = e.data._textStacks.shift();
                        e.setData({
                            writingText: e.data.writingText + t
                        }), i && (e.setData({
                            audioTemp: e.data.audioTemp + t
                        }), "\n" == t ? (e.triggerEvent("addToPlay", {
                            text: e.data._audioTemp,
                            aiIndex: e.data.aiIndex,
                            msgIndex: e.data.lists.length
                        }), e.setData({
                            _audioTemp: ""
                        })) : e.setData({
                            _audioTemp: e.data._audioTemp + t
                        })), e.scrollToBottom();
                    } else e.data.writing || (clearInterval(e.data._textOutputSi), e.setData({
                        _textOutputSi: 0
                    }), i && (e.triggerEvent("addToPlay", {
                        text: e.data._audioTemp,
                        aiIndex: e.data.aiIndex,
                        msgIndex: e.data.lists.length
                    }), e.triggerEvent("addToPlay", {
                        text: "[end]",
                        aiIndex: e.data.aiIndex,
                        msgIndex: e.data.lists.length
                    }), e.setData({
                        _audioTemp: ""
                    })), e.data.writingText && (n.push({
                        user: "AI",
                        message: e.data.writingText,
                        playing: !!i
                    }), e.setData({
                        lists: n
                    })), e.setData({
                        writingText: ""
                    }), e.scrollToBottom());
                }, 30);
                this.setData({
                    _textOutputSi: r
                });
                var d = this, o = wx.request({
                    url: t.siteinfo.host + "/web.php/chat/sendText",
                    timeout: 3e5,
                    responseType: "text",
                    method: "POST",
                    enableChunked: !0,
                    header: {
                        "Content-Type": "application/json",
                        "X-Site": wx.getStorageSync("sitecode"),
                        "X-Token": wx.getStorageSync("token")
                    },
                    data: {
                        ai: d.data.aiName,
                        message: a,
                        audio: i,
                        audio_length: s
                    },
                    success: function(t) {
                        d.setData({
                            writing: !1
                        });
                    },
                    fail: function(t) {
                        d.setData({
                            writing: !1
                        });
                    }
                });
                o.onChunkReceived(function(e) {
                    var i = new Uint8Array(e.data), s = String.fromCharCode.apply(null, i);
                    if (-1 === (s = decodeURIComponent(escape(s))).indexOf("[error]")) {
                        d.setData({
                            writing: !0
                        });
                        for (var r = d.data._textStacks, o = 0; o < s.length; o++) r.push(s[o]), d.setData({
                            _textStacks: r
                        });
                    } else {
                        n.pop(), d.setData({
                            writing: !1,
                            writingText: "",
                            lists: n
                        }), d.setMessage(a), clearInterval(d.data._textOutputSi), d.setData({
                            _textOutputSi: 0
                        });
                        var u = s.replace("[error]", "");
                        if (-1 !== u.indexOf("请登录")) t.util.toLogin(u); else if (-1 !== u.indexOf("请充值")) {
                            var l = d.isGpt4(d.data.aiName) ? "point" : "vip";
                            t.util.toPay(l, u);
                        } else t.util.message(u, "error");
                    }
                }), this.setData({
                    _requestTask: o
                });
            } else t.util.message("请输入你的问题");
        },
        stopFetch: function() {
            var t = this;
            this.data._requestTask.abort(), this.setData({
                writing: !1,
                _textStacks: [],
                _audioTemp: ""
            });
            var a = this.data.lists, e = this.data.writingText;
            this.triggerEvent("stopPlay"), setTimeout(function() {
                e || (a.pop(), t.setData({
                    lists: a
                }));
            }, 60);
        },
        retry: function(t) {
            var a = this, e = t.currentTarget.dataset.index;
            a.data.lists[e - 1] && wx.showModal({
                title: "提示",
                content: "确定重新回答吗？",
                success: function(t) {
                    if (t.confirm) {
                        var i = a.data.lists[e - 1], s = i.message, n = i.audio, r = parseInt(i.audio_length);
                        a.sendText(s, n || "", r ? 1e3 * r : 0);
                    }
                }
            });
        },
        sendConfirm: function() {
            var t = this;
            setTimeout(function() {
                t.sendText();
            }, 50);
        },
        switchPlay: function(t) {
            var a = t.currentTarget.dataset.index;
            this.data.lists[a].playing ? this.triggerEvent("stopPlay") : this.triggerEvent("startPlay", {
                msgIndex: a,
                aiIndex: this.data.aiIndex
            });
        },
        setPlayStart: function(t) {
            var a = this.data.lists;
            a[t] && (a[t].playing = !0, this.setData({
                lists: a
            }));
        },
        setPlayStop: function(t) {
            var a = this.data.lists;
            a[t] && (a[t].playing = !1, this.setData({
                lists: a
            }));
        },
        switchPlayAudio: function(a) {
            var e = a.currentTarget.dataset.index, i = this.data.lists[e];
            this.data.writing ? t.util.message("AI输出中，请稍候") : i.playing ? this.triggerEvent("stopPlay") : i.audio && this.triggerEvent("playAudio", {
                msgIndex: e,
                aiIndex: this.data.aiIndex,
                audio: i.audio
            });
        },
        getHistoryMsg: function() {
            var a = this;
            t.util.request({
                url: "/chat/getHistoryMsg",
                data: {
                    ai: this.data.aiName,
                    page: this.data.page,
                    pagesize: this.data.pagesize
                }
            }).then(function(t) {
                a.setData({
                    lists: t.data.list
                }), setTimeout(function() {
                    a.scrollToBottom();
                }, 300);
            });
        },
        scrollToBottom: function() {
            var t = this;
            setTimeout(function() {
                t.setData({
                    lastViewId: "lastViewId"
                });
            }, 300);
        },
        copyText: function(t) {
            var a = t.currentTarget.dataset.index, e = this.trim(this.data.lists[a].message);
            wx.setClipboardData({
                data: e
            });
        },
        trim: function(t) {
            return t && (t = t.replace(/(^\s*)|(\s*$)/g, "")), t;
        },
        setMessage: function(t) {
            var a = t.detail ? t.detail : t;
            this.triggerEvent("setMessage", a);
        },
        isGpt4: function(t) {
            return [ "openai4", "diy42", "diy43", "azure_openai4", "wenxin4", "claude2", "zhipu4", "hunyuan4" ].includes(t);
        }
    }
});