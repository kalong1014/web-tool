var t = getApp();

Component({
    properties: {},
    data: {
        defaultOptions: {
            ar: "1:1",
            iw: 10,
            s: 100,
            q: 10,
            c: 0,
            no: "",
            seed: "",
            niji: "",
            style: "",
            v: "",
            tile: 0,
            image: "",
            words: []
        },
        options: {},
        imageList: []
    },
    lifetimes: {
        attached: function() {
            this.setData({
                options: JSON.parse(JSON.stringify(this.data.defaultOptions))
            });
        }
    },
    methods: {
        onRadioChange: function(t) {
            var a = t.detail.name, i = t.detail.value, e = this.data.options;
            e[a] = i, this.setData({
                options: e
            });
        },
        onSlideChange: function(t) {
            var a = t.currentTarget.dataset.name, i = t.detail.value, e = this.data.options;
            e[a] = i, this.setData({
                options: e
            });
        },
        showHelp: function(a) {
            var i = a.currentTarget.dataset.text;
            i && t.util.message(i);
        },
        changeSize: function(t) {
            var a = t.currentTarget.dataset.value;
            this.setData({
                "options.ar": a
            });
        },
        uploadDelete: function(t) {
            this.setData({
                imageList: [],
                "options.image": ""
            });
        },
        uploadAfterRead: function(a) {
            var i = this, e = a.detail;
            wx.showLoading({
                title: "正在上传"
            }), t.util.upload({
                url: "/upload/image",
                filePath: e.tempFilePaths[0]
            }).then(function(t) {
                i.setData({
                    imageList: [ {
                        url: t.data.path
                    } ],
                    "options.image": t.data.path
                }), wx.hideLoading();
            }).catch(function(a) {
                t.util.message("上传失败"), i.setData({
                    imageList: [],
                    "options.image": ""
                });
            });
        },
        getDrawOptions: function() {
            var t = JSON.parse(JSON.stringify(this.data.options));
            return t.words = this.selectComponent("#prompt").getWordsPicked(), t.iw && (t.iw = t.iw / 10), 
            t.q && (t.q = t.q / 10), t;
        },
        clearDrawOptions: function() {
            this.setData({
                "options.image": "",
                "options.no": "",
                "options.seed": ""
            }), this.selectComponent("#prompt").clearPicked();
        },
        setDrawOptions: function(t) {
            t.iw && (t.iw = 10 * t.iw), t.q && (t.q = 10 * t.q), t = Object.assign(this.data.defaultOptions, t), 
            this.setData({
                options: JSON.parse(JSON.stringify(t))
            }), t.image && this.setData({
                imageList: [ {
                    url: t.image
                } ]
            }), t.words && this.selectComponent("#prompt").setWords({
                detail: t.words
            });
        }
    }
});