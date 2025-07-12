var e = getApp();

Page({
    data: {
        qrcode: ""
    },
    onLoad: function() {
        this.getInviteQrcode();
    },
    getInviteQrcode: function() {
        var t = this;
        e.util.request({
            url: "/commission/memberInviteQrcode"
        }).then(function(e) {
            t.setData({
                qrcode: e.data.qrcode
            });
        });
    },
    saveImage: function() {
        this.data.qrcode ? wx.downloadFile({
            url: this.data.qrcode,
            success: function(t) {
                wx.saveImageToPhotosAlbum({
                    filePath: t.tempFilePath,
                    success: function() {
                        e.util.message("已保存到相册");
                    },
                    fail: function(t) {
                        e.util.message("保存失败，请检查是否有保存到相册权限", "error");
                    }
                });
            },
            fail: function() {
                e.util.message("图片下载失败", "error");
            }
        }) : e.util.message("获取二维码失败", "error");
    }
});