Component({
    properties: {
        module: {
            type: String,
            value: "chat"
        },
        aiAvatar: {
            type: String,
            value: "/images/ic_ai.png"
        },
        title: {
            type: String,
            value: ""
        },
        desc: {
            type: String,
            value: ""
        },
        tips: {
            type: String,
            value: ""
        }
    },
    data: {
        siteroot: "",
        welcomeTitle: "",
        welcomeDesc: "",
        welcomeTips: ""
    },
    observers: {
        title: function() {
            var t = this.data.title;
            "chat" === this.data.module ? t = "你好！我是" + this.data.title : "cosplay" === this.data.module && (t = "我是" + this.data.title), 
            this.setData({
                welcomeTitle: t
            });
        },
        desc: function() {
            var t = this.data.desc;
            t ? t = t.replaceAll("\n", "<br>") : "cosplay" === this.data.module && (t = "请输入你的问题"), 
            t = t.replaceAll("<br>", "\n"), this.setData({
                welcomeDesc: t
            });
        },
        tips: function() {
            var t = this.data.tips;
            t = t ? t.split("\n") : [], this.setData({
                welcomeTips: t
            });
        }
    },
    methods: {
        setMessage: function(t) {
            var e = t.currentTarget.dataset.text;
            this.triggerEvent("setMessage", e);
        }
    }
});