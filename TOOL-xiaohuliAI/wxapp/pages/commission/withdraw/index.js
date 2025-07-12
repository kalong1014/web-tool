var a = require("../../../@babel/runtime/helpers/defineProperty"), t = getApp();

Page({
    data: {
        is_check: 1,
        money: 0,
        bank_name: "",
        account_name: "",
        account_number: "",
        imgList: [],
        word_zfb: "",
        word_weixin: "",
        word_lingqian: ""
    },
    onLoad: function(a) {
        var e = this;
        this.setData({
            money: a.money,
            bank_name: decodeURIComponent("%E5%BE%AE%E4%BF%A1%E9%9B%B6%E9%92%B1"),
            word_zfb: decodeURIComponent("%E6%94%AF%E4%BB%98%E5%AE%9D"),
            word_lingqian: decodeURIComponent("%E5%BE%AE%E4%BF%A1%E9%9B%B6%E9%92%B1"),
            word_weixin: decodeURIComponent("%E5%BE%AE%E4%BF%A1"),
            word_skm: decodeURIComponent("%E6%94%B6%E6%AC%BE%E7%A0%81")
        }), t.util.getWxappSetting().then(function(a) {
            e.setData({
                is_check: a.is_check
            }), 0 === a.is_check && (wx.setNavigationBarTitle({
                title: "佣金提现"
            }), e.geLastWithdraw());
        });
    },
    geLastWithdraw: function() {
        var a = this;
        t.util.request({
            url: "/commission/lastWithdraw"
        }).then(function(t) {
            t.data.bank_name && a.setData({
                bank_name: t.data.bank_name
            }), t.data.account_name && a.setData({
                account_name: t.data.account_name
            }), t.data.account_number && a.setData({
                account_number: t.data.account_number
            });
        });
    },
    bankChange: function(a) {
        var t = a.currentTarget.dataset.type;
        t != this.data.word_lingqian && t != this.data.word_zfb && (t = ""), this.setData({
            bank_name: t
        });
    },
    inputChange: function(t) {
        var e = t.currentTarget.dataset.name;
        this.setData(a({}, e, t.detail.value));
    },
    withdraw: function() {
        var a = this.data.money, e = this.data.bank_name, n = this.data.account_name, i = this.data.account_number, o = this.data.imgList, s = {};
        if (e == this.data.word_lingqian) {
            if (!n) return void t.util.message("请输入户名", "error");
            if (!o || 0 == o.length) return void t.util.message("请上传" + this.data.word_skm, "error");
            s = {
                money: a,
                bank_name: e,
                account_name: n,
                qrcode: o[0]
            };
        } else if (e == this.data.word_zfb) {
            if (!n) return void t.util.message("请输入户名", "error");
            if (!i) return void t.util.message("请输入" + this.data.word_zfb + "账号", "error");
            s = {
                money: a,
                bank_name: e,
                account_name: n,
                account_number: i
            };
        }
        t.util.request({
            url: "/commission/withdraw",
            data: s
        }).then(function(a) {
            wx.showModal({
                title: "系统提示",
                content: a.message,
                showCancel: !1,
                success: function() {
                    wx.navigateBack({
                        fail: function() {
                            wx.redirectTo({
                                url: "/pages/commission/index"
                            });
                        }
                    });
                }
            });
        });
    },
    chooseImage: function() {
        var a = this;
        wx.chooseMedia({
            count: 1,
            mediaType: [ "image" ],
            sourceType: [ "album", "camera" ],
            sizeType: [ "original", "compressed" ],
            success: function(e) {
                var n = e.tempFiles;
                t.util.upload({
                    url: "/upload/image",
                    filePath: n[0].tempFilePath,
                    name: "image"
                }).then(function(t) {
                    var e = a.data.imgList;
                    e.push(t.data.path), a.setData({
                        imgList: e
                    });
                });
            }
        });
    },
    viewImage: function(a) {
        wx.previewImage({
            urls: this.data.imgList,
            current: a.currentTarget.dataset.url
        });
    },
    delImg: function(a) {
        var t = this;
        wx.showModal({
            title: "请确认",
            content: "确定要删除这张图片吗？",
            cancelText: "取消",
            confirmText: "确定删除",
            success: function(e) {
                e.confirm && (t.data.imgList.splice(a.currentTarget.dataset.index, 1), t.setData({
                    imgList: t.data.imgList
                }));
            }
        });
    }
});