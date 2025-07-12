var t = getApp();

Component({
    properties: {
        settings: {
            type: Object,
            value: function() {
                return {};
            }
        }
    },
    data: {
        defaultOptions: {
            engine: "default_dreamer_diffusion",
            style: "",
            sub_style: "",
            size: 0,
            image: "",
            words: []
        },
        groups: [],
        styles: [],
        subStyles: [],
        options: {},
        group_name: "",
        imageList: []
    },
    observers: {
        group_name: function() {
            var t = this, e = this.data.options;
            this.data.settings.styleDetails.forEach(function(s) {
                t.data.group_name === s.GroupName && (s.Styles.length > 0 ? (e.engine = s.Styles[0].engine, 
                e.style = s.Styles[0].value) : (e.engine = "", e.style = ""), t.setData({
                    styles: s.Styles,
                    options: e
                }));
            });
        }
    },
    lifetimes: {
        attached: function() {
            var t = this, e = [];
            this.data.settings.styleDetails.forEach(function(s, a) {
                e.push({
                    title: s.GroupName,
                    poster: s.ShowImage
                }), 0 === a && t.setData({
                    group_name: s.GroupName
                });
            }), this.setData({
                groups: e,
                options: JSON.parse(JSON.stringify(this.data.defaultOptions))
            }), this.makeSubStyles();
        }
    },
    methods: {
        makeSubStyles: function() {
            var t = [], e = this.data.options;
            this.data.styles.forEach(function(s) {
                e.engine === s.engine && e.style === s.value && (s.sub_styles.length > 0 ? e.sub_style = s.sub_styles[0].value : e.sub_style = "", 
                t = s.sub_styles);
            }), this.setData({
                options: e,
                subStyles: t
            });
        },
        showHelp: function(e) {
            var s = e.currentTarget.dataset.text;
            s && t.util.message(s);
        },
        switchGroup: function(t) {
            this.setData({
                group_name: t.currentTarget.dataset.name
            });
        },
        switchEngine: function(t) {
            var e = t.currentTarget.dataset.engine, s = t.currentTarget.dataset.value;
            this.setData({
                "options.engine": e,
                "options.style": s
            }), this.makeSubStyles();
        },
        switchSubStyle: function(t) {
            var e = t.currentTarget.dataset.value;
            this.setData({
                "options.sub_style": e
            });
        },
        switchSize: function(t) {
            var e = t.currentTarget.dataset.value;
            this.setData({
                "options.size": e
            });
        },
        uploadDelete: function(t) {
            this.setData({
                imageList: [],
                "options.image": ""
            });
        },
        uploadAfterRead: function(e) {
            var s = this, a = e.detail;
            wx.showLoading({
                title: "正在上传"
            }), t.util.upload({
                url: "/upload/image",
                filePath: a.tempFilePaths[0]
            }).then(function(t) {
                s.setData({
                    imageList: [ {
                        url: t.data.path
                    } ],
                    "options.image": t.data.path
                }), wx.hideLoading();
            }).catch(function(e) {
                t.util.message("上传失败"), s.setData({
                    imageList: [],
                    "options.image": ""
                });
            });
        },
        getDrawOptions: function() {
            var t = JSON.parse(JSON.stringify(this.data.options));
            return t.words = this.selectComponent("#prompt").getWordsPicked(), t;
        },
        clearDrawOptions: function() {
            this.setData({
                "options.image": ""
            }), this.selectComponent("#prompt").clearPicked();
        },
        setDrawOptions: function(t) {
            t = Object.assign(this.data.defaultOptions, t), this.setData({
                options: JSON.parse(JSON.stringify(t))
            }), t.words && this.selectComponent("#prompt").setWords({
                detail: t.words
            });
        }
    }
});