var t = getApp();

Component({
    properties: {
        type: {
            type: String,
            value: ""
        }
    },
    data: {
        lists: [],
        wordInput: "",
        page: 1,
        pagesize: 10,
        drawSetting: {},
        wordsCate: [],
        activeWordIndex: null,
        activeWord: {},
        wordsPickerActivePcateIndex: -1,
        wordsPickerActivePcateId: 0,
        wordsPicked: [],
        wordWeightShow: !1,
        actions: []
    },
    lifetimes: {
        attached: function() {
            this.getWordsCate();
        }
    },
    methods: {
        getWordsCate: function() {
            var e = this;
            t.util.request({
                url: "/draw/getWordsCate",
                loading: !1
            }).then(function(t) {
                e.setData({
                    wordsCate: t.data
                });
            });
        },
        getWordsList: function(e, i) {
            var a = this;
            t.util.request({
                url: "/draw/getWordsList",
                data: {
                    pcate: i
                }
            }).then(function(t) {
                var i = JSON.parse(JSON.stringify(a.data.wordsCate));
                i[e].wordsList = t.data.list, i[e].wordsCount = t.data.count, a.setData({
                    wordsCate: i
                });
            });
        },
        addToPicked: function() {
            var t = this.trim(this.data.wordInput);
            if (t) {
                var e = this.data.wordsPicked;
                e.push({
                    text: t,
                    weight: 1
                }), this.setData({
                    wordsPicked: e,
                    wordInput: ""
                });
            }
        },
        removePicked: function(t) {
            var e = this.data.wordsPicked;
            e.splice(t, 1), this.setData({
                wordsPicked: e
            });
        },
        clearPicked: function() {
            this.setData({
                wordsPicked: []
            });
        },
        showWordsPicker: function(t) {
            var e = t.currentTarget.dataset.index, i = t.currentTarget.dataset.id;
            this.setData({
                wordsPickerActivePcateIndex: e,
                wordsPickerActivePcateId: i
            }), this.selectComponent("#wordsPickerPopup").open();
        },
        closeWordsPicker: function() {
            this.setData({
                wordsPickerActivePcateIndex: -1,
                wordsPickerActivePcateId: 0
            }), this.selectComponent("#wordsPickerPopup").close();
        },
        setWords: function(t) {
            this.setData({
                wordsPicked: t.detail
            }), this.closeWordsPicker();
        },
        getWordsPicked: function() {
            return this.data.wordsPicked;
        },
        showWordWeight: function(t) {
            this.setData({
                activeWordIndex: t,
                activeWord: JSON.parse(JSON.stringify(this.data.wordsPicked[t]))
            }), this.selectComponent("#wordWeightPopup").open();
        },
        closeWordWeight: function() {
            this.setData({
                activeWordIndex: null,
                activeWord: {}
            }), this.selectComponent("#wordWeightPopup").close();
        },
        onWeightChange: function(t) {
            this.setData({
                "activeWord.weight": t.detail.value
            });
        },
        setWordWeight: function() {
            var t = this.data.wordsPicked, e = this.data.activeWordIndex, i = this.data.activeWord;
            t[e] = i, this.setData({
                wordsPicked: t
            }), this.closeWordWeight();
        },
        onWordsClick: function(t) {
            var e = t.currentTarget.dataset.index;
            this.setData({
                activeWordIndex: e,
                activeWord: JSON.parse(JSON.stringify(this.data.wordsPicked[e]))
            }), "mj" == this.data.type ? this.setData({
                actions: [ {
                    title: "调整权重",
                    action: "weight"
                }, {
                    title: "移除",
                    action: "remove"
                } ]
            }) : this.setData({
                actions: [ {
                    title: "移除",
                    action: "remove"
                } ]
            }), this.selectComponent("#actionSheet").open();
        },
        actionSelect: function(t) {
            var e = t.detail.action, i = t.detail.data;
            "weight" == e ? this.showWordWeight(i) : "remove" == e && this.removePicked(i);
        },
        pickedCount: function(t) {
            var e = this.data.wordsPicked, i = 0;
            return e && e.forEach(function(e) {
                e.pcate === t && i++;
            }), i;
        },
        trim: function(t) {
            return t && (t = t.replace(/(^\s*)|(\s*$)/g, "")), t;
        },
        showLogin: function() {
            this.triggerEvent("showLogin");
        },
        showPay: function() {
            this.user_id ? this.triggerEvent("showPay", "draw") : this.triggerEvent("showLogin");
        }
    }
});