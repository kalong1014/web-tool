require("../../@babel/runtime/helpers/Arrayincludes");

var t = getApp();

Component({
    properties: {
        cates: {
            type: Array,
            value: function() {
                return [];
            }
        },
        picked: {
            type: Array,
            value: function() {
                return [];
            }
        },
        pcateIndex: {
            type: Number,
            value: 0
        }
    },
    data: {
        pcateList: [],
        scateList: [],
        wordsList: null,
        wordsCount: 0,
        wordsPicked: [],
        pickedIds: [],
        activePcateIndex: -1,
        activePcateId: 0,
        activeScateIndex: -1,
        activeScateId: 0
    },
    observers: {
        cates: function() {
            this.setData({
                pcateList: this.data.cates
            }), this.makeWordsList();
        },
        pcateIndex: function() {
            this.data.pcateIndex >= 0 ? this.changePcate(this.data.pcateIndex) : this.setData({
                activePcateIndex: -1,
                activePcateId: 0,
                wordsList: [],
                wordsCount: 0
            }), this.setData({
                wordsPicked: JSON.parse(JSON.stringify(this.data.picked))
            }), this.calcPickedIds();
        }
    },
    lifetimes: {
        attached: function() {
            var t = this;
            setTimeout(function() {
                t.setData({
                    pcateList: t.data.cates
                }), t.makeWordsList(), t.data.pcateIndex >= 0 ? t.changePcate(t.data.pcateIndex) : t.setData({
                    activePcateIndex: -1,
                    activePcateId: 0,
                    wordsList: [],
                    wordsCount: 0
                }), t.makeScateList(), t.setData({
                    wordsPicked: JSON.parse(JSON.stringify(t.data.picked))
                }), t.calcPickedIds();
            }, 100);
        }
    },
    methods: {
        makeScateList: function() {
            var t = [];
            this.data.activePcateIndex >= 0 && (t = this.data.cates[this.data.activePcateIndex].children), 
            this.setData({
                scateList: t
            });
        },
        onTabChange: function(t) {
            var a = t.detail.index;
            this.changePcate(a);
        },
        onSwiperChange: function(t) {
            var a = t.target.current || t.detail.current;
            this.changePcate(a);
        },
        changePcate: function(t) {
            var a = this.data.cates[t];
            this.setData({
                activePcateId: a.id,
                activePcateIndex: t,
                activeScateIndex: 0,
                activeScateId: a.children ? a.children[0].id : 0
            }), this.makeWordsList();
        },
        getWordsList: function() {
            var a = this;
            t.util.request({
                url: "/draw/getWordsList",
                data: {
                    pcate: this.data.activePcateId
                }
            }).then(function(t) {
                a.data.scates && a.data.scates.length > 0 && a.setData({
                    activeScateId: a.scates[0].id,
                    activeScateIndex: 0
                });
                var e = a.data.pcateList;
                e[a.data.activePcateIndex].wordsList = t.data.list, a.setData({
                    pcateList: e
                }), a.makeWordsList();
            });
        },
        makeWordsList: function() {
            var t = this;
            if (!(this.data.activePcateIndex < 0)) {
                var a = [], e = this.data.pcateList[this.data.activePcateIndex].wordsList;
                e ? (this.data.activeScateId ? e.forEach(function(e, i) {
                    e.scate === t.data.activeScateId && a.push(e);
                }) : a = e, this.setData({
                    wordsList: a,
                    wordsCount: a.length
                })) : this.getWordsList();
            }
        },
        changeScate: function(t) {
            var a = t.currentTarget.dataset.index, e = t.currentTarget.dataset.id;
            this.setData({
                activeScateIndex: a,
                activeScateId: e
            }), this.makeWordsList();
        },
        closeWordsPicker: function() {
            this.triggerEvent("close");
        },
        setWords: function() {
            this.triggerEvent("setWords", this.data.wordsPicked);
        },
        pickWord: function(t) {
            var a = t.currentTarget.dataset.index, e = this.data.wordsList[a], i = this.data.pickedIds, s = this.data.wordsPicked;
            if (e) {
                if (i.includes(e.id)) {
                    for (var c = 0; c < s.length; c++) if (s[c].id === e.id) {
                        s.splice(c, 1);
                        break;
                    }
                } else s.push({
                    id: e.id,
                    pcate: e.pcate,
                    scate: e.scate,
                    text: e.title,
                    weight: 1
                });
                this.setData({
                    wordsPicked: s
                }), this.calcPickedIds(), this.makePcateBadge();
            }
        },
        delWord: function(t) {
            var a = this.data.wordsPicked;
            a.splice(t, 1), this.setData({
                wordsPicked: a
            }), this.calcPickedIds();
        },
        makePcateBadge: function(t) {
            var a = this.data.wordsPicked, e = this.data.pcateList;
            e.forEach(function(t, i) {
                var s = 0;
                a.forEach(function(a) {
                    a.pcate === t.id && s++;
                }), e[i].badge = s;
            }), this.setData({
                pcateList: e
            });
        },
        calcPickedIds: function() {
            var t = this.data.wordsPicked, a = [];
            t.forEach(function(t) {
                t.id && a.push(t.id);
            }), this.setData({
                pickedIds: a
            });
        }
    }
});