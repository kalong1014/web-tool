Component({
    properties: {},
    data: {
        defaultOptions: {
            size: "1024x1024",
            quality: "standard",
            style: "natural"
        },
        options: {}
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
            console.log("e", t);
            var s = t.detail.name, e = t.detail.value, i = this.data.options;
            i[s] = e, this.setData({
                options: i
            });
        },
        getDrawOptions: function() {
            var t = JSON.parse(JSON.stringify(this.data.options));
            return t.words = this.selectComponent("#prompt").getWordsPicked(), t;
        },
        clearDrawOptions: function() {
            this.selectComponent("#prompt").clearPicked();
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