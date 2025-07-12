var t = require("../../@babel/runtime/helpers/defineProperty"), a = require("../../utils/tabbar.js"), e = getApp();

Page({
    data: t({
        userAvatar: "",
        aiAvatar: "",
        siteroot: "",
        lists: [],
        message: "",
        page: 1,
        pagesize: 10,
        lastViewId: "lastViewId",
        inputShow: !0,
        share_title: "",
        share_image: "",
        safeAreaHeight: 0,
        scrollTop: 0,
        createButtonType: "big",
        setting: {},
        drawCates: [],
        drawCatePickArr: [],
        activeDrawCate: {},
        is_share: !0,
        options: {},
        settingScrollTop: 0,
        navBarHeight: 0
    }, "safeAreaHeight", 0),
    onLoad: function(t) {
        var i = this;
        if (t.tuid) wx.setStorageSync("tuid", t.tuid); else if (t.scene) {
            var s = e.util.queryToArr(decodeURIComponent(t.scene));
            s.tuid && wx.setStorageSync("tuid", s.tuid);
        }
        this.setData({
            siteroot: e.siteinfo.host,
            safeAreaHeight: e.globalData.safeAreaHeight,
            navBarHeight: e.globalData.navBarHeight,
            userAvatar: e.siteinfo.host + "/static/img/ic_user.png",
            aiAvatar: e.siteinfo.host + "/static/img/ic_ai.png"
        }), e.util.checkWxappLogin().then(function() {
            i.getDrawSetting(), i.getHistoryMsg();
        }).catch(function(t) {
            i.getDrawSetting();
        }), e.util.getWxappSetting().then(function(t) {
            a.init(i, t.tabbar), i.setData({
                share_title: t.share_title,
                share_image: t.share_image
            });
        }), this.getDrawCate();
    },
    onShow: function() {
        "function" == typeof this.getTabBar && this.getTabBar() && this.getTabBar().setData({
            selected: "draw"
        }), e.globalData.avatar && this.setData({
            userAvatar: e.globalData.avatar
        });
    },
    inputChange: function(t) {
        var a = t.detail.value;
        this.setData({
            message: a
        });
    },
    submitDraw: function() {
        var t = this, a = this.data.setting, i = this.getDrawOptions();
        if (!i.words || i.words.length <= 0) return e.util.message("请添加画面描述"), void this.setData({
            settingScrollTop: Math.random()
        });
        this.data.drawCates.length > 0 && !this.data.activeDrawCate.id ? e.util.message("请选择图片分类") : e.util.request({
            url: "/draw/draw",
            data: {
                platform: a.platform,
                channel: a.channel,
                cate_id: this.data.activeDrawCate.id,
                is_share: this.data.is_share ? 1 : 0,
                options: JSON.stringify(i)
            }
        }).then(function(e) {
            t.closeDrawSetting();
            var i = t.data.lists;
            i.push({
                state: "mj" === a.platform ? 0 : 3,
                draw_id: e.data.draw_id,
                message: e.data.message,
                create_time: e.data.create_time,
                platform: a.platform
            }), t.setData({
                lists: i
            }), t.clearDrawOptions(), t.startLoopResult(e.data.draw_id), t.scrollToBottom();
        }).catch(function(t) {
            -1 !== t.message.indexOf("请充值") && e.util.toPay("point", t.message);
        });
    },
    sendConfirm: function() {
        var t = this;
        setTimeout(function() {
            t.submitDraw();
        }, 50);
    },
    startLoopResult: function(t) {
        var a = this, i = setInterval(function() {
            e.util.request({
                url: "/draw/getDrawResult",
                data: {
                    draw_id: t
                },
                loading: !1
            }).then(function(e) {
                var s = e.data.state;
                if (-1 != s) {
                    if (0 != s) {
                        var r = a.data.lists;
                        r.forEach(function(n, o) {
                            n.draw_id == t && (r[o].state = s, 1 == s ? (r[o].response = e.data.images, clearInterval(i)) : 2 == s ? (r[o].errmsg = e.data.message, 
                            clearInterval(i)) : 3 == s && (r[o].response = [ e.data.image ]), a.setData({
                                lists: r
                            }), setTimeout(function() {
                                a.scrollToBottom();
                            }, 300));
                        });
                    }
                } else clearInterval(i);
            });
        }, 5e3);
    },
    retryDraw: function(t) {
        var a = this, i = t.detail;
        e.util.request({
            url: "/draw/draw",
            data: {
                draw_id: i
            }
        }).then(function(t) {
            var e = a.data.lists;
            e.forEach(function(t, s) {
                t.draw_id == i && (e[s].state = 0, e[s].errmsg = "", e[s].response = "", a.startLoopResult(i));
            }), a.setData({
                lists: e
            });
        });
    },
    getDrawSetting: function() {
        var t = this;
        e.util.request({
            url: "/draw/getDrawSetting"
        }).then(function(a) {
            t.setData({
                setting: a.data
            });
        });
    },
    getHistoryMsg: function() {
        var t = this;
        e.util.request({
            url: "/draw/getHistoryMsg",
            data: {
                page: this.data.page,
                pagesize: this.data.pagesize
            }
        }).then(function(a) {
            if (a.data.length > 0) {
                var e = a.data;
                t.setData({
                    lists: e
                }), e.forEach(function(a, e) {
                    0 != a.state && 3 != a.state || t.startLoopResult(a.draw_id);
                });
            }
            setTimeout(function() {
                t.scrollToBottom();
            }, 500);
        });
    },
    scrollToBottom: function() {
        this.setData({
            lastViewId: "lastViewId"
        });
    },
    copyText: function(t) {
        var a = t.currentTarget.dataset.text;
        wx.setClipboardData({
            data: a
        });
    },
    previewImage: function(t) {
        var a = t.detail, e = [];
        this.data.lists.forEach(function(t, a) {
            1 == t.state && t.response.forEach(function(t, a) {
                e.push(t);
            });
        }), wx.previewImage({
            urls: e,
            current: a
        });
    },
    trim: function(t) {
        return t ? t.replace(/(^\s*)|(\s*$)/g, "") : "";
    },
    toEdit: function(t) {
        var a = t.currentTarget.dataset.index;
        this.setData({
            message: this.data.lists[a].message
        });
    },
    getDrawOptions: function() {
        var t = {};
        return this.selectComponent("#drawSetting") && (t = this.selectComponent("#drawSetting").getDrawOptions()), 
        t;
    },
    clearDrawOptions: function() {
        this.selectComponent("#drawSetting") && this.selectComponent("#drawSetting").clearDrawOptions();
    },
    getDrawCate: function() {
        var t = this;
        e.util.request({
            url: "/draw/getDrawCate"
        }).then(function(a) {
            var e = a.data, i = [];
            e.forEach(function(t) {
                i.push(t.title);
            }), t.setData({
                drawCatePickArr: i,
                drawCates: e
            });
        });
    },
    showDrawSetting: function() {
        this.selectComponent("#drawPopup").open();
    },
    closeDrawSetting: function() {
        this.selectComponent("#drawPopup").close();
    },
    isShareChange: function(t) {
        this.setData({
            is_share: t.detail.value.length > 0
        });
    },
    drawCatePick: function(t) {
        var a = t.detail.value, e = this.data.drawCates[a];
        e.index = a, this.setData({
            activeDrawCate: e
        });
    },
    replayOptions: function(t) {
        var a = this, i = t.currentTarget.dataset.id;
        e.util.request({
            url: "/draw/getDrawOptions",
            data: {
                draw_id: i
            }
        }).then(function(t) {
            a.showDrawSetting(), t.data.cate_id && a.data.drawCates.length > 0 && a.data.drawCates.forEach(function(e) {
                e.id === t.data.cate_id && a.setData({
                    activeDrawCate: e
                });
            }), a.setData({
                is_share: !0
            }), setTimeout(function() {
                a.selectComponent("#drawSetting").setDrawOptions(t.data.options);
            }, 100);
        });
    },
    onListScroll: function(t) {
        var a = parseInt(t.detail.scrollTop);
        this.data.scrollTop - a > 100 ? this.setData({
            scrollTop: a
        }) : a < this.data.scrollTop ? a < this.data.scrollTop - 50 && this.setData({
            createButtonType: "mini",
            scrollTop: a
        }) : a > this.data.scrollTop + 50 && this.setData({
            createButtonType: "big",
            scrollTop: a
        });
    },
    onShareAppMessage: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image,
            path: "/pages/draw/chat?tuid=" + e.globalData.user_id
        };
    },
    onAddToFavorites: function() {
        return {
            title: this.data.share_title,
            imageUrl: this.data.share_image
        };
    }
});