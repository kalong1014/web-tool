Page({
    data: {},
    onLoad: function(t) {
        var a = t.url;
        a = decodeURIComponent(a), this.setData({
            url: a
        });
    }
});