var t = getApp();

Component({
    properties: {
        type: {
            type: String,
            value: ""
        },
        phone: {
            type: String,
            value: ""
        },
        sitecode: {
            type: String,
            value: ""
        }
    },
    data: {
        captcha: "",
        token: "",
        code: ""
    },
    attached: function() {
        this.getCaptcha();
    },
    methods: {
        getCaptcha: function() {
            var e = this;
            t.util.request({
                url: "/login/getCaptcha",
                loading: !1
            }).then(function(t) {
                e.setData({
                    captcha: t.data.image,
                    token: t.data.token
                });
            });
        },
        doSubmit: function() {
            var e = this;
            this.data.code ? t.util.request({
                url: "/login/sendSms",
                data: {
                    type: this.data.type,
                    phone: this.data.phone,
                    code: this.data.code,
                    token: this.data.token,
                    sitecode: this.data.sitecode
                }
            }).then(function(a) {
                t.util.message(a.message), e.triggerEvent("success");
            }) : t.util.message("请输入图片验证码");
        },
        doCancel: function() {
            this.triggerEvent("close");
        }
    }
});