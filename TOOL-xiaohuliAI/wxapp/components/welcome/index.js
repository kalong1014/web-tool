Component({
    properties: {
        pageTitle: {
            type: String,
            value: ""
        }
    },
    data: {
        list1: [ "写一首赞美祖国的诗", "写一篇科幻小说", "安排一场发布会流程" ],
        list2: [ "有哪些有趣的科学实验", "问一个AI也答不出的问题", "AI会替代人类工作吗" ],
        list3: [ "用简单的术语来解释人工智能", "红烧牛肉的做法", "请介绍一下百度文心" ]
    },
    methods: {
        quickMessage: function(t) {
            var e = t.currentTarget.dataset.text;
            this.triggerEvent("use", e);
        }
    }
});