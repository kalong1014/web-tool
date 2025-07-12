App({
    onLaunch: function() {
        this.checkUpdate(), this.globalData.siteroot = this.siteinfo.host + "/web.php", 
        this.siteinfo.site_id && (this.globalData.site_id = this.siteinfo.site_id);
        var t = wx.getSystemInfoSync(), a = t.system.toLowerCase();
        if (t.safeArea) {
            var e = t.screenHeight - t.safeArea.bottom;
            this.globalData.safeAreaHeight = parseInt(750 * e / t.screenWidth);
        }
        this.globalData.statusBarHeight = t.statusBarHeight, this.globalData.navBarHeight = t.statusBarHeight + 44, 
        t.screenWidth > 960 && (this.globalData.navBarHeight = t.statusBarHeight + 66), 
        a.indexOf("android") > -1 ? this.globalData.system = "android" : a.indexOf("ios") > -1 ? this.globalData.system = "ios" : this.globalData.system = "other";
    },
    checkUpdate: function() {
        var t = wx.getUpdateManager();
        t.onCheckForUpdate(function(a) {
            a.hasUpdate && t.onUpdateReady(function() {
                t.applyUpdate();
            });
        });
    },
    globalData: {
        siteroot: "",
        site_id: 0,
        sitecode: "",
        system: "",
        safeAreaHeight: 0,
        statusBarHeight: 0,
        navBarHeight: 0,
        wxapp: null,
        user_id: 0,
        openid: "",
        avatar: ""
    },
    util: require("./utils/util.js"),
    siteinfo: require("./siteinfo.js"),
    towxml: require("/towxml/index")
});