$(function () {
    var timer = setInterval(function(){
        doItPerSeconds();
    },600000)

    function doItPerSeconds(){
        echart_2();
        dyuser();
        echart_3();
        /*echart_4();*/

        /*echart_map();*/
        echarts_4();
        echarts_2();
        char4();
        titledata();
    }
    /*echart_1();*/
    echart_2();
    dyuser();
    echart_3();
    /*echart_4();*/

    /*echart_map();*/
    echarts_4();
    echarts_2();
    char4();
    titledata();
    //抖音线索用户
    function dyuser(){
        $.ajax({
            type: "post",
            async: true,     //异步执行
            // cache:false,
            // contentType:"application/json;charset=utf-8",
            url: "/storeadmin/api/dyuser",   //SQL数据库文件
            data:{},         //发送给数据库的数据
            dataType: "json", //json类型
            error: function() { },
            success: function (result) {
                if (result) {
                    let htmllet='';
                    var data= JSON.parse(result);
                    data.forEach(function(data) {
                        htmllet += "<li> <div class='fontInner clearfix'> <span >"+data.title+"</span> <span>"+data.userid+"</span><span>"+data.addtime+"</span></div></li>";
                    });

                    document.getElementById("userinfo").innerHTML = htmllet;
                }
            }
        })
    }
    function titledata(){
        $.ajax({
            type: "post",
            async: true,     //异步执行
            // cache:false,
            // contentType:"application/json;charset=utf-8",
            url: "/storeadmin/api/index",   //SQL数据库文件
            data:{},         //发送给数据库的数据
            dataType: "json", //json类型
            error: function() { },
            success: function (result) {
                if (result) {
                    var abc= JSON.parse(result);
                    document.getElementById("run_task").innerHTML =abc.run_task;
                    document.getElementById("all_comment").innerHTML =abc.all_comment;
                    document.getElementById("all_task").innerHTML =abc.all_task;
                    document.getElementById("all_video").innerHTML =abc.all_video;
                    document.getElementById("price").innerHTML =abc.store_info['price'];
                    document.getElementById("use_price").innerHTML =abc.use_price;
                    document.getElementById("all_price").innerHTML =abc.all_price;

                    document.getElementById("data1").innerHTML =abc.zong;
                    document.getElementById("data2").innerHTML =abc.zongy;
                    document.getElementById("data3").innerHTML =abc.zongm;
                    document.getElementById("data4").innerHTML =abc.zongd;
                    document.getElementById("days").innerHTML =abc.days;
                    document.getElementById("jin").innerHTML =abc.jin;
                    document.getElementById("wan").innerHTML =abc.wan;
                    document.getElementById("zan").innerHTML =abc.zan;
                    document.getElementById("lv").innerHTML =abc.lv;
                }
            }
        })
    }
    //echart_1
    function echart_1() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('chart_1'));



        var data = [
            {value: 335,name: '客运车'},
            {value: 335,name: '危险品运输车'},
            {value: 315,name: '网约车'},
            {value: 200,name: '学生班车'}
        ];

        option = {
            backgroundColor: 'transparent',
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            color: ['#0035f9', '#f36f8a', '#ffff43', '#25f3e6'],
            legend: { //图例组件，颜色和名字
                left: '65%',
                top: '95',
                orient: 'vertical',
                itemGap: 12, //图例每项之间的间隔
                itemWidth: 16,
                itemHeight: 12,

                icon: 'rect',
                data: ['客运车', '危险品运输车', '网约车', '学生班车'],
                textStyle: {
                    color: [],
                    fontStyle: 'normal',
                    fontFamily: '微软雅黑',
                    fontSize: 12,
                }
            },
            series: [{
                name: '车辆类型',
                type: 'pie',
                clockwise: false, //饼图的扇区是否是顺时针排布
                minAngle: 20, //最小的扇区角度（0 ~ 360）
                center: ['35%', '50%'], //饼图的中心（圆心）坐标
                radius: [50, 80], //饼图的半径
                avoidLabelOverlap: true, ////是否启用防止标签重叠
                itemStyle: { //图形样式
                    normal: {
                        borderColor: '#1e2239',
                        borderWidth: 1.5,
                    },
                },

                label: { //标签的位置
                    normal: {
                        show: false,
                        position: 'inside', //标签的位置
                        formatter: "{d}%",
                        textStyle: {
                            color: '#fff',
                            fontSize: 12
                        }
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontWeight: 'bold'
                        }
                    }
                },
                data: data
            }, {
                name: '',
                type: 'pie',
                clockwise: false,
                silent: true,
                minAngle: 20, //最小的扇区角度（0 ~ 360）
                center: ['35%', '50%'], //饼图的中心（圆心）坐标
                radius: [0, 45], //饼图的半径
                itemStyle: { //图形样式
                    normal: {
                        borderColor: '#1e2239',
                        borderWidth: 1.5,
                        opacity: 0.21,
                    }
                },
                label: { //标签的位置
                    normal: {
                        show: false,
                        textStyle: {
                            fontSize: 12
                        }
                    }
                },
                data: data
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        window.addEventListener("resize",function(){
            myChart.resize();
        });
        tools.loopShowTooltip(myChart, option, {loopSeries: true}); // 使用本插件
    }


    function echarts_1() {

    }

    //echart_2
    function echart_2() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('chart_2'));
        $.ajax({
            type: "post",
            async: true,     //异步执行
            // cache:false,
            // contentType:"application/json;charset=utf-8",
            url: "/storeadmin/api/echart_2",   //SQL数据库文件
            data:{},         //发送给数据库的数据
            dataType: "json", //json类型
            error: function() { },
            success: function (result) {
                if (result) {
                    var arr= JSON.parse(result);
                    console.log(arr.data1);
                    option = {
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },

                        legend: {
                            // align: 'center',
                            // left: '65%',
                            top: '28',
                            data: arr.datas,
                            itemWidth:16,
                            itemHeight:12,
                            // borderRadius: 0, // 统一设置四个角的圆角大小
                            icon: 'rect',
                            textStyle: {
                                itemGap: 12, //图例每项之间的间隔
                                color: [],
                                fontStyle: 'normal',
                                fontFamily: '微软雅黑',
                                fontSize: 12,
                            }
                        },
                        grid: {
                            left: '5%',
                            right: '5%',
                            bottom: '5%',
                            containLabel: true
                        },

                        xAxis: {
                            axisLabel: { //调整x轴的lable
                                textStyle: {
                                    color: '#fff',
                                    fontSize: 12,
                                }
                            },
                            splitLine: {
                                show: false
                            }
                        },
                        yAxis: {
                            type: 'category',
                            data: arr.data,
                            axisTick : {show: true},
                            axisLabel: { //调整x轴的lable
                                textStyle: {
                                    color: '#fff',
                                    fontSize: 12,
                                }
                            },
                            splitLine: {
                                show: false
                            }
                        },
                        series: [{
                            name: '视频资料数',
                            type: 'bar',
                            stack: '总量',
                            color:'#f08080',
                            barWidth : 18,
                            label: {
                                normal: {
                                    show: false,
                                    position: 'insideRight',
                                    textStyle: {
                                        fontSize: 12
                                    }
                                }
                            },
                            data: arr.datas1
                        }
                        ]

                    };

                    // 使用刚指定的配置项和数据显示图表。
                    myChart.setOption(option);
                    window.addEventListener("resize",function(){
                        myChart.resize();
                    });
                    tools.loopShowTooltip(myChart, option, {loopSeries: true}); // 使用本插件

                }
            }
        })

    }
    //echart_3
    function echart_3() {
        // 基于准备好的dom，初始化echarts实例
        $.ajax({
            type: "post",
            async: true,     //异步执行
            // cache:false,
            // contentType:"application/json;charset=utf-8",
            url: "/storeadmin/api/echart_3",   //SQL数据库文件
            data:{},         //发送给数据库的数据
            dataType: "json", //json类型
            error: function() { },
            success: function (result) {
                if (result) {
                    var data= JSON.parse(result);

                    var myChart = echarts.init(document.getElementById('chart_3'));
                    var xAxisData = data.dataDay;
                    var legendData= ['','',''];
                    var title = "";
                    var serieData = [];
                    var metaDate = data.data;
                    var colors = ["#ffff43"];
                    var option = {
                        backgroundColor: 'transparent',
                        title : {text: title,textAlign:'left',textStyle:{color:"#fff",fontSize:"12",fontWeight:"normal"}},

                        color:colors,
                        grid: {left: '4%',top:"30%",bottom: "5%",right:"4%",containLabel: true},
                        tooltip : { trigger: 'axis',axisPointer : { type : 'shadow'}},
                        xAxis: [
                            {
                                type: 'category',
                                axisLine: { show: true,lineStyle:{ color:'#2c3459' }},
                                axisLabel:{interval:0,textStyle:{color:'#fff',fontSize:12} },
                                axisTick : {show: false},
                                data:xAxisData,
                            },
                        ],
                        yAxis: [
                            {
                                axisTick : {show: false},
                                splitLine: {show:false},
                                axisLabel:{textStyle:{color:'#fff',fontSize:12} },
                                axisLine: { show: true,lineStyle:{ color:'#2c3459'}},
                            },
                        ],
                        series: [
                            {
                                data: metaDate,
                                type: 'line',
                                symbol:"circle",
                                symbolSize:8,
                            }
                        ]
                    };
                    // 使用刚指定的配置项和数据显示图表。
                    myChart.setOption(option);
                    window.addEventListener("resize",function(){
                        myChart.resize();
                    });
                    tools.loopShowTooltip(myChart, option, {loopSeries: true}); // 使用本插件

                }
            }
        })


    }

    function echart_4() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('chart_4'));

        /*中间显示的数据*/
        /*中间显示的数据*/
        var myData = ['超速', 'SOS', '偏移', '其他']
        var databeast = {
            1: [38, 25, 26, 32]
        }
        var databeauty = {
            1: [11, 38, 23, 30]
        }
        var timeLineData = [1]

        var option = {
            baseOption: {
                backgroundColor: 'transparent',
                timeline: {
                    show: false,
                    top: 0,
                    data: []
                },
                legend: {
                    show:true,
                    // align: 'center',
                    left: '30%',
                    top: 30,
                    // data: ['行驶', '停车'],
                    // itemWidth:16,
                    // itemHeight:12,
                    // // borderRadius: 0, // 统一设置四个角的圆角大小
                    icon: 'rect',
                    textStyle: {
                        itemGap: 12, //图例每项之间的间隔
                        color: [],
                        fontStyle: 'normal',
                        fontFamily: '微软雅黑',
                        fontSize: 12,
                    }
                },
                tooltip: {
                    show: true,
                    trigger: 'axis',
                    formatter: '{b}<br/>{a}: {c}',
                    axisPointer: {
                        type: 'shadow'
                    }
                },

                grid: [{
                    show: false,
                    left: '8%',
                    top: 60,
                    bottom: 0,
                    containLabel: true,
                    width: '30%'
                }, {
                    show: false,
                    left: '57%',
                    top: 60,
                    bottom: 0,
                    width: '0%'
                }, {
                    show: false,
                    right: '8%',
                    top: 60,
                    bottom: 0,
                    containLabel: true,
                    width: '30%'
                }],

                xAxis: [{
                    type: 'value',
                    inverse: true,
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    position: 'top',
                    axisLabel: {
                        show: false,
                        extStyle: {
                            fontSize: 12
                        }
                    },
                    splitLine: {
                        show: false
                    }
                }, {
                    gridIndex: 1,
                    show: false
                }, {
                    gridIndex: 2,
                    nameTextStyle: {
                        color: '#50afff',
                        fontSize: 12
                    },
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    position: 'top',
                    axisLabel: {
                        show: false
                    },
                    splitLine: {
                        show: false
                    }
                }],
                yAxis: [{
                    type: 'category',
                    inverse: true,
                    position: 'right',
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    axisLabel: {
                        show: false,
                        extStyle: {
                            fontSize: 12
                        }
                    },
                    data: myData
                }, {
                    gridIndex: 1,
                    type: 'category',
                    inverse: true,
                    position: 'left',
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    axisLabel: {
                        show: true,
                        textStyle: {
                            color: '#fff',
                            fontSize: 12
                        }

                    },
                    data: myData.map(function(value) {
                        return {
                            value: value,
                            textStyle: {
                                align: 'center'
                            }
                        }
                    })
                }, {
                    gridIndex: 2,
                    type: 'category',
                    inverse: true,
                    position: 'left',
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    axisLabel: {
                        show: false,
                        extStyle: {
                            fontSize: 12
                        }

                    },
                    data: myData
                }],
                series: [

                ]

            },
            options: []
        }

        option.baseOption.timeline.data.push(timeLineData[0])
        option.options.push({
            tooltip: {
                trigger: 'axis',
                formatter: '{b}<br/>{c} {a}'
            },
            series: [{
                name: '昨天',
                type: 'bar',
                barWidth: 17,
                label: {
                    normal: {
                        show: true,
                        position: 'left',
                        offset: [0, 0],
                        textStyle: {
                            color: '#fff',
                            fontSize: 12
                        }
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#0035f9',
                        // barBorderRadius: 50
                    }
                },

                data: databeast[timeLineData[0]]
            }, {
                name: '今天',
                type: 'bar',
                barWidth: 18,
                xAxisIndex: 2,
                yAxisIndex: 2,
                label: {
                    normal: {
                        show: true,
                        position: 'right',
                        offset: [0, 0],
                        textStyle: {
                            color: '#fff',
                            fontSize: 122
                        }
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#25f3e6',
                        // barBorderRadius: 50
                    }
                },
                data: databeauty[timeLineData[0]]
            }]
        })

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        window.addEventListener("resize",function(){
            myChart.resize();
        });
        tools.loopShowTooltip(myChart, option, {loopSeries: true}); // 使用本插件

    }


    function echarts_4() {
        // 基于准备好的dom，初始化echarts实例
        $.ajax({
            type: "post",
            async: true,     //异步执行
            // cache:false,
            // contentType:"application/json;charset=utf-8",
            url: "/storeadmin/api/echarts_4",   //SQL数据库文件
            data:{},         //发送给数据库的数据
            dataType: "json", //json类型
            error: function() { },
            success: function (result) {
                if (result) {
                    var data= JSON.parse(result);
                    var myChart = echarts.init(document.getElementById('echart4'));
                    option = {
                        color: ['#FF0087', '#FFBF00', '#80FFA5','#FSBF50','#EFDF65','#FFA500'],
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                lineStyle: {
                                    color: '#57617B'
                                }
                            }
                        },
                        "legend": {
                            "data": [
                                {"name": "抖音"},
                                {"name": "快手"},
                                {"name": "小红薯"},
                                {"name": "地图"},
                                {"name": "B站"},
                                {"name": "总量"},
                            ],
                            "top": "0%",
                            "textStyle": {
                                "color": "rgba(255,255,255,0.9)",//图例文字
                                fontSize: 12
                            }
                        },

                        "xAxis": [
                            {
                                "type": "category",
                                data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                                axisLine: { lineStyle: {color: "rgba(255,255,255,.1)"}},
                                axisLabel:  { textStyle: {color: "rgba(255,255,255,1)", fontSize: '10', },
                                },

                            },
                        ],
                        "yAxis": [
                            {
                                "type": "value",
                                "name": "数量",

                                "axisLabel": {
                                    "show": true,
                                    textStyle: {
                                        fontSize: 12
                                    }

                                },
                                axisLine: {lineStyle: {color: 'rgba(255,255,255,1)'}},//左线色
                                splitLine: {show:false,lineStyle: {color:"#ffffff"}},//x轴线

                            },
                            {
                                "type": "value",
                                "name": "总量",
                                "show": true,
                                "axisLabel": {
                                    "show": true,
                                    textStyle: {
                                        fontSize: 12
                                    }
                                },
                                axisLine: {lineStyle: {color: 'rgba(255,255,255,1)'}},//右线色
                                splitLine: {show:false,lineStyle: {color:"#ffffff"}},//x轴线
                            },
                        ],
                        "grid": {
                            "top": "40",
                            "right":"40",
                            "bottom":"30",
                            "left":"35",
                        },
                        "series": [
                            {
                                "name": "抖音",

                                "type": "bar",
                                "data": data.dy,
                                "barWidth": 10,
                                "itemStyle": {
                                    "normal": {
                                        "borderRadius": [10,10,0,0]
                                    }
                                }
                            },
                            {
                                "name": "快手",

                                "type": "bar",
                                "data": data.ks,
                                "barWidth": 10,
                                "itemStyle": {
                                    "normal": {
                                        "borderRadius": [10,10,0,0]
                                    }
                                }
                            },
                            {
                                "name": "小红薯",

                                "type": "bar",
                                "data": data.xhs,
                                "barWidth": 10,
                                "itemStyle": {
                                    "normal": {
                                        "borderRadius": [10,10,0,0]
                                    }
                                }
                            },
                            {
                                "name": "地图",

                                "type": "bar",
                                "data": data.map,
                                "barWidth": 10,
                                "itemStyle": {
                                    "normal": {
                                        "borderRadius": [10,10,0,0]
                                    }
                                }
                            },
                            {
                                "name": "B站",
                                "type": "bar",
                                "data": data.bz,
                                "barWidth": 10,
                                itemStyle: {
                                    normal: {
                                        borderRadius: 50,
                                    }
                                },
                                "barGap": "0"
                            },
                            {
                                "name": "总量",
                                "type": "line",
                                "yAxisIndex": 1,

                                "data": data.zongNum,
                                lineStyle: {
                                    normal: {
                                        width: 2
                                    },
                                },
                                "smooth": true
                            }
                        ]
                    };


                    // 使用刚指定的配置项和数据显示图表。
                    myChart.setOption(option);
                    window.addEventListener("resize",function(){
                        myChart.resize();
                    });
                    tools.loopShowTooltip(myChart, option, {loopSeries: true}); // 使用本插件

                }
            }
        })

    }




})


function echarts_2() {
    // 基于准备好的dom，初始化echarts实例


    $.ajax({
        type: "post",
        async: true,     //异步执行
        // cache:false,
        // contentType:"application/json;charset=utf-8",
        url: "/storeadmin/api/echarts_2",   //SQL数据库文件
        data:{},         //发送给数据库的数据
        dataType: "json", //json类型
        error: function() { },
        success: function (result) {
            if (result) {
                var data= JSON.parse(result);

                var myChart = echarts.init(document.getElementById('echarts_2'));
                option = {
                    legend: {
                        x: 'center',
                        y: '10%',
                        type: 'scroll',
                        data: ['抖音', '快手', '小红薯', '地图', 'B站'],
                        icon: 'circle',
                        textStyle: {
                            color: '#fff',
                            fontSize: 12
                        }
                    },

                    series: [
                        {
                            name: 'Nightingale Chart',
                            type: 'pie',
                            // radius: [50, 250],
                            center: ['50%', '80%'],
                            roseType: 'area',
                            itemStyle: {
                                borderRadius: 8
                            },
                            label: {
                                normal: {
                                    show: false,
                                    formatter: '{c}',
                                    textStyle: {
                                        fontSize: 12
                                    }
                                },
                                emphasis: {
                                    show: true
                                }
                            },
                            data: data
                        }
                    ]
                };

                // 使用刚指定的配置项和数据显示图表。
                myChart.setOption(option);
                window.addEventListener("resize",function(){
                    myChart.resize();
                });
                tools.loopShowTooltip(myChart, option, {loopSeries: true}); // 使用本插件
            }
        }
    })



}


function char4() {

    var myChart = echarts.init($("#char4")[0]);
    $.ajax({
        type: "post",
        async: true,     //异步执行
        // cache:false,
        // contentType:"application/json;charset=utf-8",
        url: "/storeadmin/api/char4",   //SQL数据库文件
        data:{},         //发送给数据库的数据
        dataType: "json", //json类型
        error: function() { },
        success: function (result) {
            if (result) {
                var arr= JSON.parse(result);
                option = {
                    grid: {
                        top: 30,
                        bottom: 30,
                        left: 50,
                        right:20
                    },
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                        },

                        formatter: function (params) {
                            var tar = params[0];
                            return tar.name + '<br/>' + tar.seriesName + ' : ' + tar.value;
                        }
                    },

                    xAxis : [
                        {
                            type : 'category',
                            splitLine: {show:false},
                            data :arr.num,
                            axisLabel: {
                                show: true,
                                textStyle: {
                                    color: '#fff',
                                    fontSize: 12
                                }
                            }

                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            splitLine: {show:false},
                            axisLabel: {
                                show: true,
                                textStyle: {
                                    color: '#fff',
                                    fontSize: 12
                                }
                            }
                        }
                    ],
                    series : [

                        {
                            name:'获客总数',
                            type:'bar',
                            stack: '总量',
                            barWidth:'20px',
                            itemStyle: {
                                normal: {
                                    show: true,
                                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                        offset: 0,
                                        color: '#00d891'
                                    }, {
                                        offset: 1,
                                        color: '#00579a'
                                    }]),
                                    barBorderRadius: 50,
                                    borderWidth: 0,
                                    borderColor: '#333',
                                }
                            },
                            data:arr.data
                        }
                    ]
                };

                myChart.setOption(option);
                window.addEventListener('resize', function () {myChart.resize();})
                tools.loopShowTooltip(myChart, option, {loopSeries: true}); // 使用本插件



//eacharts_1
                // 基于准备好的dom，初始化echarts实例
                var myChart1 = echarts.init(document.getElementById('echarts_1'));

                var data = [
                    {value: 12,name: '行业一'},
                    {value: 13,name: '行业二'},
                    {value: 70,name: '行业三'},
                    {value: 52,name: '行业四'},
                    {value: 35,name: '行业五'}
                ];

                option1 = {
                    backgroundColor: 'rgba(0,0,0,0)',
                    tooltip: {
                        trigger: 'item',
                        formatter: "{b}: <br/>{c} ({d}%)"
                    },
                    color: ['#af89d6', '#4ac7f5', '#0089ff', '#f36f8a', '#f5c847'],
                    legend: { //图例组件，颜色和名字
                        x: '70%',
                        y: 'center',
                        orient: 'vertical',
                        itemGap: 12, //图例每项之间的间隔
                        itemWidth: 10,
                        itemHeight: 10,
                        icon: 'rect',
                        data: arr.num,
                        textStyle: {
                            color: [],
                            fontStyle: 'normal',
                            fontFamily: '微软雅黑',
                            fontSize: 12,
                        }
                    },
                    series: [{
                        name: '行业占比',
                        type: 'pie',
                        clockwise: false, //饼图的扇区是否是顺时针排布
                        minAngle: 1, //最小的扇区角度（0 ~ 360）
                        center: ['35%', '53%'], //饼图的中心（圆心）坐标
                        radius: [25, 50], //饼图的半径
                        avoidLabelOverlap: true, ////是否启用防止标签重叠
                        itemStyle: { //图形样式
                            normal: {
                                borderColor: '#1e2239',
                                borderWidth: 2,
                            },
                        },
                        label: { //标签的位置
                            normal: {
                                show: false,
                                position: 'outside', //标签的位置
                                formatter: "{d}%",
                                textStyle: {
                                    color: '#fff',
                                    fontSize: 12
                                }
                            },
                            emphasis: {
                                show: true,
                                textStyle: {
                                    fontWeight: 'bold'
                                }
                            }
                        },
                        data: arr.data2
                    }, {
                        name: '',
                        type: 'pie',
                        clockwise: false,
                        silent: true,
                        minAngle: 1, //最小的扇区角度（0 ~ 360）
                        center: ['35%', '50%'], //饼图的中心（圆心）坐标
                        radius: [0, 40], //饼图的半径
                        itemStyle: { //图形样式
                            normal: {
                                borderColor: '#1e2239',
                                borderWidth: 1.5,
                                opacity: 0.21,
                            }
                        },
                        label: { //标签的位置
                            normal: {
                                show: false,
                                textStyle: {
                                    fontSize: 12
                                }
                            }
                        },
                        data: arr.data1
                    }]
                };

                // 使用刚指定的配置项和数据显示图表。
                myChart1.setOption(option1);
                window.addEventListener("resize",function(){
                    myChart1.resize();
                });
                tools.loopShowTooltip(myChart1, option1, {loopSeries: true}); // 使用本插件



            }
        }
    })


}
