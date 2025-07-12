var a = [ {
    pagePath: "/pages/index/index",
    text: "对话",
    iconPath: "/images/tabbar/ic_chat.png",
    selectedIconPath: "/images/tabbar/ic_chat_active.png",
    name: "chat"
}, {
    pagePath: "/pages/write/index",
    text: "创作",
    iconPath: "/images/tabbar/ic_write.png",
    selectedIconPath: "/images/tabbar/ic_write_active.png",
    name: "write"
}, {
    pagePath: "/pages/cosplay/index",
    text: "模拟",
    iconPath: "/images/tabbar/ic_cosplay.png",
    selectedIconPath: "/images/tabbar/ic_cosplay_active.png",
    name: "cosplay"
}, {
    pagePath: "/pages/draw/chat",
    text: "绘画",
    iconPath: "/images/tabbar/ic_draw.png",
    selectedIconPath: "/images/tabbar/ic_draw_active.png",
    name: "draw"
}, {
    pagePath: "/pages/user/index",
    text: "我的",
    iconPath: "/images/tabbar/ic_user.png",
    selectedIconPath: "/images/tabbar/ic_user_active.png",
    name: "user"
} ];

module.exports = {
    init: function(e, t) {
        getApp().globalData.wxapp.is_check && (a[0].text = "首页", a[0].iconPath = "/images/tabbar/ic_index.png", 
        a[0].selectedIconPath = "/images/tabbar/ic_index_active.png");
        var i = [];
        for (var c in t) t[c] && i.push(a[c]);
        "function" == typeof e.getTabBar && e.getTabBar() && e.getTabBar().setData({
            list: i
        });
    }
};