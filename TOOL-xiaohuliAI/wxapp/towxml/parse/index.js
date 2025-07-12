var e, t = require("../../@babel/runtime/helpers/toConsumableArray"), a = require("./parse2/index"), r = require("../config"), n = (e = {
    a: "navigator",
    todogroup: "checkbox-group",
    audio: "audio-player"
}, [].concat(t(r.wxml), t(r.components)).forEach(function(t) {
    e[t] = t;
}), e), c = [ "li" ], i = function(e, t) {
    var a, r = {
        theme: t.theme || "light",
        _e: {}
    }, i = global._events = {}, s = t.base;
    if (global._theme = r.theme, t.events) for (var o in t.events) i[o] = t.events[o];
    return (a = function(e, t, r, i) {
        t.children = t.children || [], r.child = r.child || [];
        var o = t.children, l = r.child;
        e.forEach(function(e) {
            if ("comment" !== e.type) {
                var t, r = {
                    type: "text" === e.type ? "text" : i ? "node" : e.type
                }, h = {}, d = r.attrs = e.attribs || {};
                if ("text" === e.type) r.text = h.text = e.data; else if (i ? r.name = e.name : (r.tag = (t = e.name) ? n[t] || "view" : void 0, 
                h.tag = e.name, r.attrs = e.attribs, h.attrs = JSON.parse(JSON.stringify(d))), d.class = d.class ? "h2w__".concat(e.name, " ").concat(d.class) : "h2w__".concat(e.name), 
                s && d.src) {
                    var u = d.src;
                    switch (u.indexOf("//")) {
                      case 0:
                        d.src = "https:".concat(u);
                        break;

                      case -1:
                        d.src = "".concat(s).concat(u);
                    }
                }
                r.rely = c.indexOf(h.tag) > -1, e.children && a(e.children, r, h, i || "rich-text" === e.name), 
                o.push(r), l.push(h);
            }
        });
    })(e, r, r._e, !1), r;
};

module.exports = function(e, t) {
    var r;
    return e = (r = /<body[^>]*>([\s\S]*)<\/body>/i).test(e) && r.exec(e)[1] || e, i(a(e, {
        decodeEntities: !0
    }), t);
};