Component({
    properties: {
        list: {
            type: Array,
            default: []
        },
        current: {
            type: Number,
            default: 0
        },
        center: {
            type: Boolean,
            default: !1
        },
        keyName: {
            type: String,
            default: "title"
        },
        backgroundColor: {
            type: String,
            default: "none"
        }
    },
    data: {
        tabs: [],
        tabsWidth: 750,
        lineLeft: 0,
        scrollLeft: 0
    },
    observers: {
        list: function() {
            var t = this, e = this.data.list, a = 0, r = 0;
            e.forEach(function(e) {
                e.left = a;
                var n = parseInt(15 * t.strLen(e[t.data.keyName]) + 32);
                e.badge && e.badge > 0 && (n += 32), e.width = n, a += n, r += n;
            }), r < 750 && (r = this.data.center ? r : 750), this.setData({
                tabs: e,
                tabsWidth: r
            }), this.calcLeft(this.data.current);
        },
        current: function(t) {
            this.calcLeft(t);
        }
    },
    methods: {
        calcLeft: function(t) {
            if (!(0 == this.data.tabs.length || t < 0)) {
                var e = this.data.tabs[t], a = parseInt(e.left - 375 + e.width / 2), r = parseInt(e.left + (e.width - 60) / 2), n = wx.getSystemInfoSync();
                a = parseInt(n.screenWidth / 750 * a), this.setData({
                    scrollLeft: a,
                    lineLeft: r
                });
            }
        },
        switchTab: function(t) {
            var e = this.data.tabs, a = t.currentTarget.dataset.index, r = e[a];
            r.index = a, this.triggerEvent("switch", r);
        },
        strLen: function(t) {
            for (var e = 0, a = 0; a < t.length; a++) {
                var r = t.charCodeAt(a);
                r > 63 && r < 91 ? e += 1.5 : t.charCodeAt(a) >= 0 && t.charCodeAt(a) <= 128 ? e += 1 : e += 2;
            }
            return e;
        }
    }
});