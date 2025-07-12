var e = getApp();

Page({
    data: {
        priceSetting: {},
        drawIsOpen: !1,
        videoIsOpen: !1,
        musicIsOpen: !1
    },
    onLoad: function(t) {
        var n = this;
        e.util.getWxappSetting().then(function(e) {
            n.setData({
                priceSetting: e.priceSetting,
                drawIsOpen: e.drawIsOpen,
                videoIsOpen: e.videoIsOpen,
                musicIsOpen: e.musicIsOpen
            });
        });
    }
});