var t = getApp();

Page({
    data: {
        share: {},
        currentHaibao: 0,
        currentText: "",
        navBarHeight: 0,
        safeAreaHeight: 0,
        tabList: [],
        activeTab: "",
        activeTabIndex: 0
    },
    onLoad: function() {
        this.setData({
            navBarHeight: t.globalData.navBarHeight,
            safeAreaHeight: t.globalData.safeAreaHeight
        }), this.getShare();
    },
    getShare: function() {
        var a = this;
        t.util.request({
            url: "/commission/getShare",
            data: {
                platform: "wxapp"
            }
        }).then(function(t) {
            a.setData({
                share: t.data,
                currentText: t.data.defaultText,
                currentHaibao: t.data.defaultHaibao
            });
            var e = t.data, i = [];
            e.haibaoArr && e.haibaoArr.length > 0 && (i.push({
                id: "haibao",
                title: "分享海报"
            }), a.setData({
                tabList: i,
                activeTab: "haibao"
            })), e.textArr && e.textArr.length > 0 && (i.push({
                id: "text",
                title: "分享文案"
            }), a.setData({
                tabList: i,
                activeTab: "haibao" == a.data.activeTab ? "haibao" : "text"
            }));
        });
    },
    copyText: function() {
        var a = this.data.currentText;
        if (!a) return !1;
        a = a.replaceAll("<br>", "\n"), wx.setClipboardData({
            data: a,
            success: function() {
                t.util.message("复制成功");
            }
        });
    },
    nextText: function() {
        var a = this, e = this.data.currentText, i = this.data.share.textArr;
        if (!i || i.length <= 1) return t.util.message("没有更多了"), !1;
        i.forEach(function(t, n) {
            t.content == e && (n === i.length - 1 ? a.setData({
                currentText: i[0].content
            }) : a.setData({
                currentText: i[n + 1].content
            }));
        });
    },
    onTabChange: function(t) {
        this.setData({
            activeTab: t.detail.id,
            activeTabIndex: t.detail.index
        });
    },
    swiperChange: function(t) {
        this.setData({
            currentHaibao: t.detail.current
        });
    },
    saveToAlbum: function() {
        var a = wx.createCanvasContext("poster"), e = this.data.share.haibaoArr[this.data.currentHaibao], i = this.data.share.qrcode, n = !1, r = !1;
        wx.showLoading({
            title: "保存中"
        }), wx.downloadFile({
            url: e.bg,
            success: function(s) {
                a.drawImage(s.tempFilePath, 0, 0, e.bg_w, e.bg_h), n = !0, wx.downloadFile({
                    url: i,
                    success: function(t) {
                        a.drawImage(t.tempFilePath, e.hole_x, e.hole_y, e.hole_w, e.hole_h), r = !0;
                    },
                    fail: function() {
                        t.util.message("二维码下载失败"), wx.hideLoading();
                    }
                });
            },
            fail: function() {
                t.util.message("海报图下载失败"), wx.hideLoading();
            }
        });
        var s = setInterval(function() {
            n && r && (clearInterval(s), a.draw(), wx.hideLoading(), setTimeout(function() {
                wx.canvasToTempFilePath({
                    canvasId: "poster",
                    width: e.bg_w,
                    height: e.bg_h,
                    destWidth: e.bg_w,
                    destHeight: e.bg_h,
                    quality: 1,
                    fileType: "jpg",
                    success: function(a) {
                        wx.saveImageToPhotosAlbum({
                            filePath: a.tempFilePath,
                            success: function() {
                                t.util.message("已保存到相册", "success");
                            },
                            fail: function(a) {
                                t.util.message("保存失败：" + JSON.stringify(a), "error");
                            }
                        });
                    }
                });
            }, 300));
        }, 500);
    }
});