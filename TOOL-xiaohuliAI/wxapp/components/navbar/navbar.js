require("../../@babel/runtime/helpers/Arrayincludes"), Component({
    properties: {
        text: {
            type: String,
            value: ""
        },
        navbar: {
            type: String,
            value: "navbar"
        },
        showbg: {
            type: Boolean,
            value: !0
        },
        fixed: {
            type: Boolean,
            value: !0
        }
    },
    data: {
        back: !1,
        home: !1,
        statusBarHeight: 0,
        navigationBarHeight: 0
    },
    lifetimes: {
        attached: function() {
            var e = getCurrentPages();
            (e.length > 1 || ![ "pages/index/index", "pages/write/index", "pages/cosplay/index", "pages/draw/chat", "pages/user/index" ].includes(e[0].route)) && this.setData({
                back: !0
            });
            var a = getApp();
            this.setData({
                statusBarHeight: a.globalData.statusBarHeight + "px",
                navBarHeight: a.globalData.navBarHeight + "px"
            });
        }
    },
    methods: {
        toHome: function() {
            wx.reLaunch({
                url: "/pages/index/index"
            });
        },
        toBack: function() {
            wx.navigateBack({
                delta: 1,
                fail: function() {
                    wx.reLaunch({
                        url: "/pages/index/index"
                    });
                }
            });
        }
    }
});