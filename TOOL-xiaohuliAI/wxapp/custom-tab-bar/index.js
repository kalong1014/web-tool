Component({
    data: {
        selected: "chat",
        color: "#666666",
        selectedColor: "#04BABE",
        fontSize: 24,
        borderColor: "#f6f6f6",
        backgroundColor: "#fff",
        list: []
    },
    methods: {
        switchTab: function(t) {
            var e = t.currentTarget.dataset, a = e.name, o = e.path;
            a !== this.data.selected && (wx.switchTab({
                url: o,
                fail: function() {
                    wx.navigateTo({
                        url: o,
                        fail: function(t) {
                            console.log("跳转失败：", t);
                        }
                    });
                }
            }), this.getTabBar().setData({
                selected: a
            }));
        }
    }
});