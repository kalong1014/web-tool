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
            class: ""
        },
        size: {
            w: 0,
            h: 0
        }
    },
    lifetimes: {
        attached: function() {
            var a = this.data.data.attrs;
            this.setData({
                attrs: {
                    src: "".concat(t.latex.api, "=").concat(a.value, "&theme=").concat(global._theme),
                    class: "".concat(a.class, " ").concat(a.class, "--").concat(a.type)
                }
            });
        }
    },
    methods: {
        load: function(t) {
            var a = t.detail.width / 20, e = t.detail.height / 20;
            this.setData({
                size: {
                    w: a,
                    h: e
                }
            });
        }
    }
});