;(function ($, window, document, undefined) {
    'use strict';

    var pluginName = "jackWeiSlider";

    var defaults = {
        width: '800px',
        handleSrc: '../Images/slider_handle.png',
        progress: 0.3,
        isCustomText: false
    };

    //构造函数
    function JackWeiSlider(element, options) {
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;

        this.isEnable = true;
        this.dcX = 0;
        this.barW = 0;
        this.currW = 0;
        this.haPaddingL = -12;
        this.txPaddingL = -40;
        this.isDrag = false;
        this.progress = 0;
        this.onStartDragCallback;
        this.onDragCallback;
        this.onStopDragCallback;
        this.maxW = parseInt(this.settings.width.split('px')[0]);
        this.isCustomText = this.settings.isCustomText;

        this.init();
    }

    JackWeiSlider.prototype = {
        init: function () {
            var that = this;//避免与内部对象的this重名
            var settings = that.settings;
            var $element = $(this.element);

            //添加slider元素
            // $element.append('<div style="width:' + settings.width + ';">\n' +
            $element.append('<div style="width:800px;">\n' +
                '        <div class="jws-outside-bar">\n' +
                '            <div class="jws-inside-bar" style="background-color: ' + settings.color + '"></div>\n' +
                '            <img class="jws-handle" src=' + settings.handleSrc + '>\n' +
                '            <span style="color: #999;height: 46px;line-height: 46px;vertical-align: text-bottom;">向右滑动增加音量，最高播放量为10！</span>\n' +
                '            <div><span style="color:#fff">当前播放量：</span>\n' +
                '            <span class="jws-text"></span></div>\n' +
                '        </div>\n' +
                '    </div>'
            );

            //设置默认进度
            this.setProgress(settings.progress);

            $(document).on('mousedown', '.jws-handle', function (e) {
                if (!that.isEnable) return;

                that.isDrag = true;
                that.dcX = e.clientX;
                if (typeof that.onStartDragCallback === 'function')
                    that.onStartDragCallback();
                e.preventDefault();
            });

            $(document).mousemove(function (e) {
                if (!that.isDrag) return;

                //阻止默认事件
                e.preventDefault();

                //计算偏移量并开始移动滑块
                that.move(e.clientX - that.dcX);

                //拖动事件回掉
                if (typeof that.onDragCallback === 'function')
                    that.onDragCallback(that.progress);
            });

            $(document).mouseup(function (e) {
                if (!that.isDrag) return;

                that.isDrag = false;

                //获取当前控件的位置数据
                that.updateData(that);

                //停止拖拽回调
                if (typeof that.onStopDragCallback === 'function')
                    that.onStopDragCallback();
            });
        },
        enable: function () {
            this.isEnable = true;
            return this;
        },
        disEnable: function () {
            this.isEnable = false;
            return this;
        },
        setText: function (text) {
            $(this.element).find('.jws-text').text(text);
            this.isCustomText = true;
            return this;
        },
        updateData: function () {
            var $element = $(this.element);
            this.currW = this.barW = parseInt($element.find('.jws-inside-bar').css('width').split("px")[0]);
            this.haPaddingL = parseInt($element.find('.jws-handle').css('padding-left').split("px")[0]);
            this.txPaddingL = parseInt($element.find('.jws-text').css('padding-left').split("px")[0]);
        },
        move: function (offset) {
            //计算控件现在的位置
            var w = Math.round(this.barW + offset);
            var hml = Math.round(this.haPaddingL + offset);
            var tml = Math.round(this.txPaddingL + offset);
            console.log('w:' + w + ' hml:' + hml + ' tml:' + tml);

            //往左限制
            if (w < 0 || hml < -12 || tml < -40) return;

            //往右限制
            if (w > this.maxW || hml > -12 + this.maxW || tml > -40 + this.maxW) return;

            //更新progress
            this.progress = w / this.maxW;

            //更新UI
            var $element = $(this.element);
            $element.find('.jws-inside-bar').css('width', w);
            $element.find('.jws-handle').css('padding-left', hml);
            $element.find('.jws-text').css('padding-left', tml);
            if (!this.isCustomText)
               // $element.find('.jws-text').text(Math.round(this.progress * 100) + "%");
            $element.find('.jws-text').text(Math.round(this.progress * 10) );
        },
        setProgress: function (progress) {
            var offset = progress * this.maxW - this.currW;//减去当前位置回到原点
            this.move(offset, this);
            this.updateData(this);
            return this;
        },
        setOnStartDragCallback: function (callback) {
            this.onStartDragCallback = callback;
            return this;
        },
        setOnDragCallback: function (callback) {
            this.onDragCallback = callback;
            return this;
        },
        setOnStopDragCallback: function (callback) {
            this.onStopDragCallback = callback;
            return this;
        }
    }

    $.fn.jackWeiSlider = function (options) {
        return new JackWeiSlider(this, options);
    }

})(jQuery, window, document);