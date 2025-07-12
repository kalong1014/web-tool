Component({
    properties: {
        page: {
            type: Number,
            value: 0
        },
        pagesize: {
            type: Number
        },
        count: {
            type: Number
        }
    },
    observers: {
        "count, pagesize": function(t, a) {
            this.setData({
                pageMax: Math.ceil(this.data.count / this.data.pagesize)
            });
        }
    },
    data: {
        pageMax: 1,
        pageInput: "",
        showPageInput: !1
    },
    methods: {
        doPageChange: function() {
            this.triggerEvent("change", this.data.pageInput), this.closePageInput();
        },
        doPrev: function() {
            this.data.page > 1 && this.triggerEvent("change", this.data.page - 1);
        },
        doNext: function() {
            this.data.page < this.data.pageMax && this.triggerEvent("change", this.data.page + 1);
        },
        showPageInput: function() {
            this.setData({
                pageInput: this.data.page,
                showPageInput: !0
            });
        },
        closePageInput: function() {
            this.setData({
                showPageInput: !1
            });
        }
    }
});