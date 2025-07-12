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
        roleId: {
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
            default: "/static/img/ic_ai.png"
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
        _textStacks: [],
        _textOutputSi: 0,
        _requestTask: null
    },
    observers: {
        activeAiIndex: function() {
            var t = this.data.aiIndex, e = this.data.activeAiIndex, a = this.data.lists;
            t >= e - 1 && t <= e + 1 && null === a && this.getHistoryMsg();
        }
    },
    methods: {
        sendText: function(e, a) {
            var i = this;
            if (!this.data.writing) if (e = this.trim(e)) {
                this.data._textOutputSi && (clearInterval(this.data._textOutputSi), this.setData({
                    _textOutputSi: 0,
                    _textStacks: []
                }));
                var s = this.data.lists;
                s.push({
                    user: "我",
                    message: e
                }), this.setMessage(""), this.setData({
                    writing: !0,
                    lists: s
                }), this.scrollToBottom();
                var n = setInterval(function() {
                    i.data._textStacks.length > 0 ? (i.setData({
                        writingText: i.data.writingText + i.data._textStacks.shift()
                    }), i.scrollToBottom()) : i.data.writing || (clearInterval(i.data._textOutputSi), 
                    i.setData({
                        _textOutputSi: 0
                    }), i.data.writingText && (s.push({
                        user: "AI",
                        message: i.data.writingText
                    }), i.setData({
                        lists: s
                    })), i.setData({
                        writingText: ""
                    }), i.scrollToBottom());
                }, 30);
                this.setData({
                    _textOutputSi: n
                });
                var r = this, o = wx.request({
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
                        role_id: this.data.roleId,
                        message: e,
                        ai: r.data.aiName
                    },
                    success: function(t) {
                        r.setData({
                            writing: !1
                        });
                    },
                    fail: function(t) {
                        r.setData({
                            writing: !1
                        });
                    }
                });
                o.onChunkReceived(function(a) {
                    var i = new Uint8Array(a.data), n = String.fromCharCode.apply(null, i);
                    if (-1 === (n = decodeURIComponent(escape(n))).indexOf("[error]")) {
                        r.setData({
                            writing: !0
                        });
                        for (var o = r.data._textStacks, d = 0; d < n.length; d++) o.push(n[d]), r.setData({
                            _textStacks: o
                        });
                    } else {
                        s.pop(), r.setData({
                            writing: !1,
                            writingText: "",
                            lists: s
                        }), r.setMessage(e), clearInterval(r.data._textOutputSi), r.setData({
                            _textOutputSi: 0
                        });
                        var u = n.replace("[error]", "");
                        if (-1 !== u.indexOf("请登录")) t.util.toLogin(u); else if (-1 !== u.indexOf("请充值")) {
                            var l = r.isGpt4(r.data.aiName) ? "point" : "vip";
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
                _textStacks: []
            });
            var e = this.data.lists, a = this.data.writingText;
            setTimeout(function() {
                a || (e.pop(), t.setData({
                    lists: e
                }));
            }, 60);
        },
        retry: function(t) {
            var e = this, a = t.currentTarget.dataset.index;
            e.data.lists[a - 1] && wx.showModal({
                title: "提示",
                content: "确定重新回答吗？",
                success: function(t) {
                    t.confirm && e.sendText(e.data.lists[a - 1].message);
                }
            });
        },
        sendConfirm: function() {
            var t = this;
            setTimeout(function() {
                t.sendText();
            }, 50);
        },
        getHistoryMsg: function() {
            var e = this;
            t.util.request({
                url: "/chat/getHistoryMsg",
                data: {
                    ai: this.data.aiName,
                    role_id: this.data.roleId,
                    page: this.data.page,
                    pagesize: this.data.pagesize
                }
            }).then(function(t) {
                e.setData({
                    lists: t.data.list
                }), setTimeout(function() {
                    e.scrollToBottom();
                }, 300);
            });
        },
        switchPlay: function(t) {
            var e = t.currentTarget.dataset.index;
            this.data.lists[e].playing ? this.triggerEvent("stopPlay") : this.triggerEvent("startPlay", {
                msgIndex: e,
                aiIndex: this.data.aiIndex
            });
        },
        setPlayStart: function(t) {
            var e = this.data.lists;
            e[t] && (e[t].playing = !0, this.setData({
                lists: e
            }));
        },
        setPlayStop: function(t) {
            var e = this.data.lists;
            e[t] && (e[t].playing = !1, this.setData({
                lists: e
            }));
        },
        switchPlayAudio: function(e) {
            var a = e.currentTarget.dataset.index, i = this.data.lists[a];
            this.data.writing ? t.util.message("AI输出中，请稍候") : i.playing ? this.triggerEvent("stopPlay") : i.audio && this.triggerEvent("playAudio", {
                msgIndex: a,
                aiIndex: this.data.aiIndex,
                audio: i.audio
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
            var e = t.currentTarget.dataset.index, a = this.trim(this.data.lists[e].message);
            wx.setClipboardData({
                data: a
            });
        },
        trim: function(t) {
            return t && (t = t.replace(/(^\s*)|(\s*$)/g, "")), t;
        },
        setMessage: function(t) {
            var e = t.detail ? t.detail : t;
            this.triggerEvent("setMessage", e);
        },
        isGpt4: function(t) {
            return [ "openai4", "diy42", "diy43", "azure_openai4", "wenxin4", "claude2", "zhipu4", "hunyuan4" ].includes(t);
        }
    }
});