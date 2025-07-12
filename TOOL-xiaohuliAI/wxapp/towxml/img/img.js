var t = require("../config");

Component({
    options: {
        styleIsolation: "shared"
    },
    properties: {
        data: {
            type: Object,
            value: {}
        }
    },
    data: {
        attr: {
            src: "",
            class: "",
            style: ""
        },
        size: {
            w: 0,
            h: 0
        },
        styleObj: {}
    },
    lifetimes: {
        attached: function() {
            var e = this, a = this.data.data.attrs;
            if (a.width && (e.data.size.w = +a.width / t.dpr), a.height && (e.data.size.h = +a.height / t.dpr), 
            a.style) {
                a.style = a.style.replace(/;\s{0,}/gi, ";"), a.style.split(";").forEach(function(a) {
                    var s = a.split(":");
                    if (/^(width|height)$/i.test(s[0])) {
                        var i = parseInt(s[1]) || 0, r = "";
                        switch (s[0].toLocaleLowerCase()) {
                          case "width":
                            r = "w";
                            break;

                          case "height":
                            r = "h";
                        }
                        e.data.size[r] = i / t.dpr;
                    } else e.data.styleObj[s[0]] = s[1];
                });
            }
            e.setData({
                attrs: {
                    src: a.src,
                    class: a.class,
                    style: e.setStyle(e.data.styleObj)
                },
                size: e.data.size
            });
        }
    },
    methods: {
        setStyle: function(t) {
            var e = "";
            for (var a in t) e += "".concat(a, ":").concat(t[a], ";");
            return e;
        },
        load: function(e) {
            this.data.size.w && this.data.size.h || this.setData({
                size: {
                    w: e.detail.width / t.dpr,
                    h: e.detail.height / t.dpr
                }
            });
        }
    }
});