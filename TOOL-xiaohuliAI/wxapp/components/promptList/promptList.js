var t = getApp();

Component({
    properties: {
        topic_id: {
            type: Number / String,
            default: ""
        },
        topicIndex: {
            type: Number,
            default: 0
        },
        activeTopicIndex: {
            type: Number,
            default: 0
        }
    },
    data: {
        promptList: null,
        promptCount: 0,
        page: 1,
        pagesize: 20,
        scrollTop: 0
    },
    observers: {
        activeTopicIndex: function() {
            var t = this.data.activeTopicIndex, e = this.data.topicIndex, a = this.data.topic_id, i = this.data.promptList;
            "vote" == a ? t == e && this.getVotePrompts() : e >= t - 1 && e <= t + 1 && null === i && this.getPrompts();
        }
    },
    methods: {
        getPrompts: function() {
            var e = this, a = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "", i = this.data.topic_id, o = this.data.page, s = this.data.pagesize;
            a && wx.showLoading({
                title: "搜索中"
            }), t.util.request({
                url: "/write/getPrompts",
                data: {
                    topic_id: i,
                    keyword: a,
                    page: o,
                    pagesize: s
                },
                loading: 1 !== o
            }).then(function(t) {
                e.setData({
                    promptList: t.data.list,
                    promptCount: t.data.count
                }), e.scrollToTop(), wx.hideLoading();
            }).catch(function() {
                wx.hideLoading();
            });
        },
        clearList: function() {
            this.setData({
                promptList: null,
                promptCount: 0,
                page: 1,
                scrollTop: 0
            });
        },
        getVotePrompts: function() {
            var e = this, a = this.data.page, i = this.data.pagesize;
            t.util.request({
                url: "/write/getVotePrompts",
                data: {
                    page: a,
                    pagesize: i
                }
            }).then(function(t) {
                e.setData({
                    promptList: t.data.list,
                    promptCount: t.data.count
                }), e.scrollToTop();
            });
        },
        pageChange: function(t) {
            var e = t.detail;
            this.setData({
                page: e
            }), "vote" == this.data.topic_id ? this.getVotePrompts() : this.getPrompts();
        },
        doVote: function(e) {
            var a = this, i = e.currentTarget.dataset.id;
            t.util.request({
                url: "/write/votePrompt",
                data: {
                    prompt_id: i
                }
            }).then(function(e) {
                t.util.message(e.message);
                var o = a.data.promptList;
                for (var s in o) o[s].id == i && (o[s].isVote = o[s].isVote ? 0 : 1);
                a.setData({
                    promptList: o
                });
            });
        },
        scrollToTop: function() {
            var t = this;
            setTimeout(function() {
                t.setData({
                    scrollTop: 0
                });
            }, 100);
        },
        toWriteChat: function(t) {
            var e = t.currentTarget.dataset.id;
            wx.navigateTo({
                url: "/pages/write/chat?prompt_id=" + e
            });
        }
    }
});