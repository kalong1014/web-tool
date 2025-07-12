Component({
    properties: {},
    data: {
        showPrivacy: !1,
        privacyName: "《小程序隐私保护指引》",
        safeAreaHeight: 0
    },
    lifetimes: {
        attached: function() {
            var t = this;
            wx.getPrivacySetting && wx.getPrivacySetting({
                success: function(a) {
                    a.needAuthorization && (t.setData({
                        safeAreaHeight: getApp().globalData.safeAreaHeight
                    }), t.setData({
                        showPrivacy: !0,
                        privacyName: a.privacyContractName
                    }));
                }
            });
        }
    },
    methods: {
        doAgree: function() {
            this.setData({
                showPrivacy: !1
            });
        },
        doRefuse: function() {
            var t = this;
            wx.showModal({
                title: "提示",
                content: "此操作将会影响部分功能正常使用，确定拒绝吗？",
                success: function(a) {
                    a.confirm && t.setData({
                        showPrivacy: !1
                    });
                }
            });
        },
        openPrivacy: function() {
            wx.openPrivacyContract();
        }
    }
});