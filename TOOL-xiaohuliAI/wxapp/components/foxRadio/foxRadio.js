Component({
    properties: {
        name: {
            type: String,
            value: ""
        },
        lists: {
            type: Array,
            value: function() {
                return [];
            }
        },
        checked: {
            type: String / Number,
            value: ""
        }
    },
    data: {},
    methods: {
        onChange: function(e) {
            var t = e.currentTarget.dataset.value;
            this.triggerEvent("change", {
                name: this.data.name,
                value: t
            });
        }
    }
});