<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/www/wwwroot/juzhen.huizhenjiang.com/public/../application/admin/view/index/console.html";i:1661917032;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo !empty($biaoti)?$biaoti:'短视频矩阵'; ?></title>
    <link rel="stylesheet" href="/static/admin/sjdp/css/index.css">
    <link rel="stylesheet" href="/static/admin/sjdp/css/reset.css">
</head>
<body>
<div id="particles-js" class="main">
    <div class="main_con">
        <div class="main_top">
            <div class="main_top_left">
                <div class="main_top_left_top">
                    <img src="/static/admin/sjdp/images/main_top_left.png"/>
                    <div class="main_top_left_top_title">核心数据展示</div>
                    <div class="main_top_left_top_con">
                        <div class="main_top_left_top_con_list">
                            <span class="main_top_left_c_l_n main_top_left_c_l_n1"><?php echo !empty($fpcoun)?$fpcoun:'0'; ?></span>
                            <p>发布数量</p>
                        </div>
                        <div class="main_top_left_top_con_list">
                            <span class="main_top_left_c_l_n main_top_left_c_l_n2"><?php echo !empty($zhcoun)?$zhcoun:'0'; ?></span>
                            <p>账号数量</p>
                        </div>
                        <div class="main_top_left_top_con_list">
                            <span class="main_top_left_c_l_n main_top_left_c_l_n3"><?php echo $arr['ci']; ?></span>
                            <p>关键词数</p>
                        </div>
                        <div class="main_top_left_top_con_left">
                            <div class="main_top_left_t_c_l_left">
                                <span class="main_top_left_c_l_n main_top_left_c_l_n4"><?php echo $arr['zuori']; ?></span>
                                <p>昨日达标</p>
                            </div>
                            <div class="main_top_left_t_c_l_right">
                                <span class="main_top_left_c_l_n main_top_left_c_l_n5"><?php echo $arr['jinri']; ?></span>
                                <p>今日达标</p>
                            </div>
                        </div>
                        <div class="main_top_left_top_con_right main_top_left_top_con_right2">
                            <div class="main_top_left_t_c_r_left">
                                <span class="main_top_left_c_l_n"><?php echo $arr['benzhou']; ?></span>
                                <p>本周达标</p>
                            </div>
                            <div class="main_top_left_t_c_r_right">
                                <span class="main_top_left_c_l_n"><?php echo $arr['benyue']; ?></span>
                                <p>本月达标</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main_top_left_top main_top_left_bottom">
                    <img src="/static/admin/sjdp/images/main_top_left.png"/>
                    <div class="main_top_left_top_title">SEO优化数据</div>
                    <div id="baseId" class="main_top_left_top_con" ></div>
                </div>
            </div>
            <div class="main_top_middle">
                <div class="main_top_middle_top_title">
                    <img class="title_bg" src="/static/admin/sjdp/images/title_bg.png">
                   <?php echo !empty($biaoti)?$biaoti:'短视频矩阵'; ?>
                   
                    <!--<a class="title_web" href="" target="blank">管理系统</a>-->
                    <!--<a class="title_admin" href="" target="blank">web网页</a>-->
                </div>
                <div class="main_top_middle_num_title">总曝光</div>
                <div class="main_top_middle_num">
                    <!-- <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list6">0</p>
                    </div> -->
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list9">0</p>
                    </div>
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list8">0</p>
                    </div>
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list7">0</p>
                    </div>
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list6">0</p>
                    </div>
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list5">0</p>
                    </div>
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list4">0</p>
                    </div>
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list3">0</p>
                    </div>
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list2">0</p>
                    </div>
                    <div class="main_top_middle_num_list">
                        <img src="/static/admin/sjdp/images/center_num.png">
                        <p class="main_top_middle_num_list1">0</p>
                    </div>

                    <div class="main_top_middle_num_list">
                        <p style="color: #0EFCFF;font-size: 1.5vw;">次</p>
                    </div>
                </div>
                <div class="main_top_middle_bottom">
                    <div class="main_top_middle_bottom_echarts">
                        <img src="/static/admin/sjdp/images/main_top_bottom.png">
                        <div class="main_top_echarts_con">
                            <div class="main_top_echarts_con_title">任务占比</div>
                            <div id="threeTasksId" class="main_top_echarts_pie"></div>
                        </div>
                    </div>
                    <div class="main_top_middle_bottom_echarts main_top_middle_bottom_echarts_right">
                        <img src="/static/admin/sjdp/images/main_top_bottom.png">
                        <div class="main_top_echarts_con">
                            <div class="main_top_echarts_con_title">素材占比</div>
                            <div id="publicityId" class="main_top_echarts_pie"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_top_left main_top_right">
                <div class="main_top_left_top">
                    <img src="/static/admin/sjdp/images/main_top_left.png"/>
                    <div class="main_top_left_top_title">客户数据展示</div>
                    <div class="main_top_left_top_con">
                        <div class="main_top_left_top_con_left">
                            <span class="daysData"><?php echo (isset($zhineng) && ($zhineng !== '')?$zhineng:'0'); ?></span>
                            <p>智能回复</p>
                        </div>
                        <div class="main_top_left_top_con_right">
                            <span class="weekData"><?php echo (isset($jingzhun) && ($jingzhun !== '')?$jingzhun:'0'); ?></span>
                            <p>精准询盘</p>
                        </div>
                        <div class="main_top_left_top_con_list">
                            <span class="monthData"><?php echo !empty($levela)?$levela:'0'; ?></span>
                            <p>A类客户</p>
                        </div>
                        <div class="main_top_left_top_con_list">
                            <span class="someThing"><?php echo !empty($levelb)?$levelb:'0'; ?></span>
                            <p>B类客户</p>
                        </div>
                        <div class="main_top_left_top_con_list">
                            <span class="policyData"><?php echo !empty($levelc)?$levelc:'0'; ?></span>
                            <p>C类客户</p>
                        </div>
                    </div>
                </div>
                <div class="main_top_left_top main_top_left_bottom">
                    <img src="/static/admin/sjdp/images/main_top_left.png"/>
                    <div class="main_top_left_top_title">客户占比</div>
                    <div id="questionId" class="main_top_left_top_con">
                    </div>
                </div>
            </div>
        </div>
        <div class="main_middle">
            <div class="main_middle_list">
                <img src="/static/admin/sjdp/images/main_middle.png">
                <div class="main_list_title main_list_title1">本地素材</div>
                <span class="main_list_title_num main_list_title_num1"><?php echo $yuzs; ?></span>
            </div>
            <div class="main_middle_list">
                <img src="/static/admin/sjdp/images/main_middle.png">
                <div class="main_list_title main_list_title2">混剪素材</div>
                <span class="main_list_title_num main_list_title_num2"><?php echo $yuhjzs; ?></span>
            </div>
            <div class="main_middle_list">
                <img src="/static/admin/sjdp/images/main_middle.png">
                <div class="main_list_title main_list_title3">单发任务</div>
                <span class="main_list_title_num main_list_title_num3"><?php echo $dfzs; ?></span>
            </div>
            <div class="main_middle_list">
                <img src="/static/admin/sjdp/images/main_middle.png">
                <div class="main_list_title main_list_title4">群发任务</div>
                <span class="main_list_title_num main_list_title_num4"><?php echo (isset($qfzs) && ($qfzs !== '')?$qfzs:'0'); ?></span>
            </div>
            <div class="main_middle_list">
                <img src="/static/admin/sjdp/images/main_middle.png">
                <div class="main_list_title main_list_title5">SOP任务</div>
                <span class="main_list_title_num main_list_title_num5"><?php echo $xhzs; ?></span>
            </div>
        </div>
        <div class="main_bottom">
            <div class="main_bottom_top">
                <div class="main_bottom_top_list">
                    <img src="/static/admin/sjdp/images/main_bottopm_top1.png">
                    <div class="main_bottom_t_l_title">精准询盘</div>
                    <div class="main_bottom_t_l_con">
                        <div class="main_bottom_t_l_main">
                            <ul>
                                 <?php if(is_array($jingzhun1) || $jingzhun1 instanceof \think\Collection): if( count($jingzhun1)==0 ) : echo "" ;else: foreach($jingzhun1 as $key=>$vo): ?>
                                <li>
                                    <div class="main_bottom_t_l_main_list">
                                        <div class="main_bottom_t_list_title "><?php if($vo['type']==1): ?>A类客户<?php elseif($vo['type']==2): ?>B类客户<?php else: ?>C类客户<?php endif; ?></div>
                                        <div class="main_bottom_t_list_con "><?php echo $vo['content']; ?></div>
                                        <div class="main_bottom_t_list_time "><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></div>
                                    </div>
                                </li>
                                 <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="main_bottom_top_list">
                    <img src="/static/admin/sjdp/images/main_bottopm_top2.png">
                    <div class="main_bottom_t_l_title">四大平台占比发布数量</div>
                    <div id="departmentId" class="main_bottom_t_l_chart"></div>
                </div>
                <div class="main_bottom_top_list">
                    <img src="/static/admin/sjdp/images/main_bottopm_top1.png">
                    <div class="main_bottom_t_l_title">智能回复</div>
                    <div class="main_bottom_t_l_con">
                        <div class="main_bottom_t_l_main2">
                            <ul>
                                 <?php if(is_array($jingzhun2) || $jingzhun2 instanceof \think\Collection): if( count($jingzhun2)==0 ) : echo "" ;else: foreach($jingzhun2 as $key=>$vo): ?>
                                <li>
                                    <div class="main_bottom_t_l_main_list">
                                        <div class="main_bottom_t_list_title_4 "><?php if($vo['type']==1): ?>A类客户<?php elseif($vo['type']==2): ?>B类客户<?php else: ?>C类客户<?php endif; ?></div>
                                        <div class="main_bottom_t_list_con_4 "><?php echo $vo['content']; ?></div>
                                        <div class="main_bottom_t_list_hf_4 "><?php echo $vo['hcontent']; ?></div>
                                        <div class="main_bottom_t_list_time_4 "><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></div>
                                    </div>
                                </li>
                                 <?php endforeach; endif; else: echo "" ;endif; ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_bottom_bottom">
                <div class="main_bottom_b_left">
                    <img src="/static/admin/sjdp/images/main_bottom_bottom.png">
                    <div class="main_bottom_b_title">四大平台占比发布数量</div>
                    <div id="coverageId" class="main_bottom_b_con"></div>
                </div>
                <div class="main_bottom_b_middle1">
                    <img src="/static/admin/sjdp/images/main_bootm_middle.png">
                    <div class="main_bottom_b_title">核心数据占比</div>
                    <div id="contentId" class="main_bottom_b_con main_bottom_b_con2"></div>
                </div>
                <div class="main_bottom_b_middle2">
                    <img src="/static/admin/sjdp/images/main_bootm_middle.png">
                    <div class="main_bottom_b_title">线索数据展示</div>
                    <div id="publicNumId" class="main_bottom_b_con main_bottom_b_con2"></div>
                </div>
                <div class="main_bottom_b_right">
                    <img src="/static/admin/sjdp/images/main_bottom_bottom.png">
                    <div class="main_bottom_b_title">核心数据占比</div>
                    <div id="yearsNumId" class="main_bottom_b_con"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
<script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="https://www.jq22.com/jquery/echarts-4.2.1.min.js"></script>
<script type="text/javascript" src="/static/admin/sjdp/js/dataScoll.js"></script>
<script type="text/javascript" src="/static/admin/sjdp/js/digitalScroll.js"></script>
<script type="text/javascript" src="/static/admin/sjdp/js/jcarousellite.js"></script>
<script type="text/javascript" src="/static/admin/sjdp/js/particles.min.js"></script>
<script type="text/javascript" src="/static/admin/sjdp/js/app.js"></script>
<script>
    $(function() {
        function apiFn() {
            this.hostname = ""
        }
        apiFn.prototype = {
            Init:function() {
                this.findCount()
                this.otherDataFn()
                this.baseInfo()
                this.questionFn()
                this.publicityFn()
                this.threeTasksFn()
                this.departmentFn()
                this.guideFn()
                this.policyFn()
                this.coverageFn()
                this.yearsNumFn()
                this.contentFn()
                this.publicNumFn()
                setInterval(function() {
                    numInit()
                },6000)
            },
            findCount:function() {

            },
            // 其他数据展示
            otherDataFn:function() {
                // $(".daysData").addClass("counter-value").text("304")
                // $(".weekData").addClass("counter-value").text("2044")
                // $(".monthData").addClass("counter-value").text("909")
                // $(".someThing").addClass("counter-value").text("980")
                // $(".policyData").addClass("counter-value").text("200")
            },
            // 基础信息
            baseInfo:function() {


                var baseChart = echarts.init(document.getElementById('baseId'));
                var charts = [
                    {name: "关键词数", num: "<?php echo $arr['ci']; ?>",},
                    {name: "昨日达标", num: "<?php echo $arr['ci']; ?>"},
                    {name: "今日达标", num: "<?php echo $arr['jinri']; ?>"},
                    {name: "本周达标", num: "<?php echo $arr['benzhou']; ?>"},
                    {name: "本月达标", num: "<?php echo $arr['benyue']; ?>"},
                ]
                var color = ['rgba(100,255,249', 'rgba(100,255,249', 'rgba(100,255,249', 'rgba(100,255,249', 'rgba(100,255,249']

                let lineY = []
                for (var i = 0; i < charts.length; i++) {
                var x = i
                if (x > color.length - 1) {
                    x = color.length - 1
                }
                var data = {
                    name: charts[i].name,
                    color: color[x] + ')',
                    value: charts[i].num,
                    fontSize: 12,
                    
                    itemStyle: {
                    normal: {
                        show: true,
                        color: new echarts.graphic.LinearGradient(0, 0, 1, 0, [{
                        offset: 0,
                        color: color[x] + ', 0.3)'
                        }, {
                        offset: 1,
                        color: color[x] + ', 1)'
                        }], false),
                        barBorderRadius: 10,
                       
                          
                            

                        
                    },
                    emphasis: {
                        shadowBlur: 15,
                        shadowColor: 'rgba(0, 0, 0, 0.1)'
                    }
                    }
                }
                lineY.push(data)
                }
                var option= {
                title: {
                    show: false
                },
                grid: {
                    // borderWidth: 1,
                    top: '10%',
                    left: '30%',
                    right: '20%',
                    bottom: '3%',
                  
                },
                color: color,
                yAxis: [{
                    type: 'category',
                    inverse: true,
                    axisTick: {
                    show: false
                    },
                    axisLine: {
                    show: false
                    },
                    axisLabel: {
                    show: false,
                    inside: false
                    },
                    data: charts.name
                }, {
                    type: 'category',
                    inverse: true,
                    axisLine: {
                    show: false
                    },
                    axisTick: {
                    show: false
                    },
                    axisLabel: {
                    show: true,
                    inside: false,
                    textStyle: {
                        color: '#38E1E1',
                        fontSize: '8',
                    },
                    formatter: function (val,index) {
                        return `${charts[index].num}`
                    }
                    },
                    splitArea: {
                    show: false
                    },
                    splitLine: {
                    show: false
                    },
                    data: charts
                }],
                xAxis: {
                    // type: 'value',
                    axisTick: {
                    show: false
                    },
                    axisLine: {
                    show: false
                    },
                    splitLine: {
                    show: false
                    },
                    axisLabel: {
                    show: false
                    }
                },
                series: [{
                    name: '',
                    type: 'bar',
                    zlevel: 2,
                    barWidth: '5px',
                    data: lineY,
                    animationDuration: 1500,
                    label: {
                    normal: {
                        color: 'white',
                        show: true,
                        position: [-65, -2],
                        textStyle: {
                        fontSize: 8
                        },
                        formatter: function (a, b) {
                            return a.name
                        }
                    }
                    }
                }],
                animationEasing: 'cubicOut'
                }
                baseChart.setOption(option)
                setInterval(function() {
                    baseChart.clear()
                    baseChart.setOption(option)
                },40000)
            },
            // 问题反馈类型占比
            questionFn:function() {
                var numArr = [
                    {name: 'A类客户', value: "<?php echo !empty($levela)?$levela:'0'; ?>"},
                    {name: 'B类客户', value: "<?php echo !empty($levelb)?$levelb:'0'; ?>"},
                    {name: 'C类客户', value: "<?php echo !empty($levelc)?$levelc:'0'; ?>"},
                    {name: '精准询盘', value: "<?php echo !empty($jingzhun)?$jingzhun:'0'; ?>"},
                ]
                // for(var i = 0; i < data.list.length; i++) {
                //     numArr.push({name: data.list[i].name,value: data.list[i].num})
                // }
                var datas = numArr
                var questionChart = echarts.init(document.getElementById('questionId'));
                var option = {
                    title: {
                        left: 'center'
                    },
                    tooltip: {
                        trigger: 'item',
                        formatter: '{a} <br/>{b} : {c} ({d}%)'
                    },
                    color:['#2E8CFF', '#FD9133','#37D2D4','#19CA88','#858FF8'],
                    legend: {
                        itemWidth: 11,// 标志图形的长度
                        itemHeight: 11,// 标志图形的宽度
                        orient: 'vertical',
                        // left: 'right',
                        top: '15%',
                        x: '50%',
                        data: datas,
                        textStyle: { //图例文字的样式
                            color: '#fff',
                            fontSize: 8
                        },
                    },
                    series: [
                        {
                            name: '客户占比',
                            type: 'pie',
                            radius: '75%',
                            center: ['20%', '50%'],
                            animationDuration: 2500,
                            data: datas,
                            label: {
                                normal: {
                                    position: 'inner',
                                    show : false
                                }
                            }
                        }
                    ]
                };
                questionChart.setOption(option)
                setInterval(function() {
                    questionChart.clear()
                    questionChart.setOption(option)
                },8000)
            },
            // 党务公开
            publicityFn:function() {
                var dataArr = [
                    {name: '本地', value: "<?php echo $yuzs; ?>"},
                    {name: '混剪', value: "<?php echo $yuhjzs; ?>"},
                ]
                // for(var i = 0; i < res.list.length; i++) {
                //     dataArr.push({name: res.list[i].name, value: res.list[i].num})
                // }

                var publicitChart = echarts.init(document.getElementById('publicityId'));
                var data = dataArr
                var option = {
                    color: ['#38EB70', '#F7E16C', '#0EFCFF', '#FD9133', '#4D92F2'],
                    tooltip: {
                        trigger: 'item',
                        formatter: '{a} <br/>{b} : {c} ({d}%)'
                    },
                    legend: {
                        itemWidth: 12,// 标志图形的长度
                        itemHeight: 12,// 标志图形的宽度
                        orient: 'vertical',
                        // left: 'right',
                        top: '5%',
                        bottom: '50%',
                        x: '45%',
                        textStyle: {
                            color: '#fff',
                            fontSize: 8,

                        },
                        data: data,
                    },
                    series: [
                        // 主要展示层的
                        {
                            radius: ['70%', '90%'],
                            center: ['25%', '50%'],
                            type: 'pie',
                            label: {
                                normal: {
                                    position: 'inner',
                                    show : false
                                }
                            },
                            name: "素材占比",
                            data: data,
                        },
                        // 边框的设置
                        {
                            radius: ['50%', '55%'],
                            center: ['25%', '50%'],
                            type: 'pie',
                            label: {
                                normal: {
                                    show: false
                                },
                                emphasis: {
                                    show: false
                                }
                            },
                            labelLine: {
                                normal: {
                                    show: false
                                },
                                emphasis: {
                                    show: false
                                }
                            },
                            animation: false,
                            tooltip: {
                                show: false
                            },
                            data: [{
                                value: 1,
                                itemStyle: {
                                    color: "rgba(250,250,250,0.3)",
                                },
                            }],
                        }
                    ]
                };
                publicitChart.setOption(option)
                setInterval(function() {
                    publicitChart.clear()
                    publicitChart.setOption(option)
                },6000)
            },
            // 三务公开数量
            threeTasksFn:function() {
                let names = "<?php echo $view_count; ?>";
                if(6 - names.length > 0) {
                    for(g = 0; g < 6 - names.length; g++) {
                        $(".main_top_middle_num_list"+(6 - g)).text('0')
                    }
                }
                for(var j = 0; j < names.length; j++) {
                    $(".main_top_middle_num_list"+(names.length - j)).text(names.substr(j,1))
                }
                var dataArr = [
                    {name: '单发', value: "<?php echo $dfzs; ?>"},
                    {name: '群发', value: "<?php echo $qfzs; ?>"},
                    {name: 'SOP发', value: "<?php echo $xhzs; ?>"},
                ]
                for(var i = 1; i < dataArr.length; i++) {
                    console.log(dataArr[i].name)

                   // $(".main_top_left_c_l_n"+i).addClass("counter-value").text(dataArr[i].value)
                }
                var threeTasksChart = echarts.init(document.getElementById('threeTasksId'));
                var data = dataArr
                var option = {
                    color: ['#38EB70', '#2E8CFF', '#0EFCFF', '#858FF8', '#FD9133','#F7E270'],
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
                        itemWidth: 15,// 标志图形的长度
                        itemHeight: 15,// 标志图形的宽度
                        orient: 'vertical',
                        // left: 'right',
                        top: '10%',
                        bottom: '50%',
                        x: '50%',
                        textStyle: {
                            color: '#fff',
                            fontSize: 12,

                        },
                        data: data
                    },
                    series :
                        {
                            name:'任务占比',
                            type:'pie',
                            animationDuration: 1500,
                            radius: ['70%', '90%'],
                            center: ['25%', '50%'],
                            roseType : 'radius',
                            label: {
                                normal: {
                                    position: 'inner',
                                    show : false
                                }
                            },
                            data:data
                        }
                };
                threeTasksChart.setOption(option)
                setInterval(function() {
                    threeTasksChart.clear()
                    threeTasksChart.setOption(option)
                },4000)
            },
            // 各部门苏木镇嘎查村公开占比
            departmentFn:function() {
                var dataArr = [
                    {name: '抖音', value: "<?php echo (isset($carr['dy']) && ($carr['dy'] !== '')?$carr['dy']:'0'); ?>"},
                    {name: '快手', value: "<?php echo (isset($carr['ks']) && ($carr['ks'] !== '')?$carr['ks']:'0'); ?>"},
                    {name: '西瓜视频', value: "<?php echo (isset($carr['xg']) && ($carr['xg'] !== '')?$carr['xg']:'0'); ?>"},
                    {name: '今日头条', value: "<?php echo (isset($carr['tt']) && ($carr['tt'] !== '')?$carr['tt']:'0'); ?>"},
                ]
                var departmentChart = echarts.init(document.getElementById('departmentId'));
                var data = dataArr
                var option = {
                    color: ['#FD9133', '#47F6A2', '#37D2D4', '#3493FF'],
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
                        itemWidth: 15,// 标志图形的长度
                        itemHeight: 15,// 标志图形的宽度
                        orient: 'vertical',
                        // left: 'right',
                        top: '30%',
                        bottom: '50%',
                        x: '5%',
                        textStyle: {
                            color: '#fff',
                            fontSize: 12,

                        },
                        data: data,
                    },
                    series: [
                        {
                            name: '四大平台占比发布数量',
                            type: 'pie',
                            radius: ['50%', '70%'],
                            center: ['78%', '52%'],
                            labelLine: {
                                normal: {
                                    length: 12,
                                    lineStyle: {
                                        type: 'solid',
                                        color: '#0EFCFF'
                                    }
                                }

                            },
                            label: {
                                normal: {
                                    formatter: (params)=>{
                                        return params.name
                                    },
                                    borderWidth: 0,
                                    borderRadius: 4,
                                    padding: [0,0],
                                    height: 20,
                                    fontSize: 8,
                                    align: 'center',
                                    color: '#0EFCFF',
                                }
                            },
                            data: data
                        },
                        {
                            color: '#0EFCFF',
                            type: 'pie',
                            radius: ['55', '56'],
                            center: ['78%', '52%'],
                            data: [100],
                            label: {
                                show: false
                            }
                        },
                        {
                            type: 'pie',
                            radius: ['25', '26'],
                            center: ['78%', '52%'],
                            data: [100],
                            label: {
                                show: false
                            }
                        }
                    ]
                };
                departmentChart.setOption(option)
                setInterval(function() {
                    departmentChart.clear()
                    departmentChart.setOption(option)
                },12000)
            },
            // 办事指南
            guideFn:function() {
                $(".main_bottom_t_l_main").jCarouselLite({
                    vertical: true,
                    hoverPause:true,
                    visible: 4,
                    auto: 1000,
                    speed: 500
                });
            },
            // 政策解读
            policyFn:function() {
                $(".main_bottom_t_l_main2").jCarouselLite({
                    vertical: true,
                    hoverPause:true,
                    visible: 4,
                    auto: 1000,
                    speed: 500
                });
            },
            // 主要关注内容区域占比
            coverageFn:function() {
                var resArr = [
                    {name: '抖音', value: "<?php echo (isset($carr['dy']) && ($carr['dy'] !== '')?$carr['dy']:'0'); ?>"},
                    {name: '快手', value: "<?php echo (isset($carr['ks']) && ($carr['ks'] !== '')?$carr['ks']:'0'); ?>"},
                    {name: '西瓜视频', value: "<?php echo (isset($carr['xg']) && ($carr['xg'] !== '')?$carr['xg']:'0'); ?>"},
                    {name: '今日头条', value: "<?php echo (isset($carr['tt']) && ($carr['tt'] !== '')?$carr['tt']:'0'); ?>"},
                ]
                var indicatorArr = []
                var numArr = []
                for(var i = 0; i < resArr.length; i++) {
                    indicatorArr.push({name: resArr[i].name,max: 900})
                    numArr.push(resArr[i].value)
                }
                var data = [
                    {
                        value: numArr,
                    }
                ]
                var coverageChart = echarts.init(document.getElementById('coverageId'));
                var option = {
                    legend: {
                        show: true,
                        icon: "circle",
                        bottom: 30,
                        center: 0,
                        itemWidth: 14,
                        itemHeight: 14,
                        itemGap: 21,
                        orient: "horizontal",
                        data: ['a', 'b'],
                        textStyle: {
                            fontSize: '70%',
                            color: '#0EFCFF'
                        },
                    },

                    radar: {
                        // shape: 'circle',
                        radius: '70%',
                        triggerEvent: true,
                        // type: 'default',
                        name: {
                            textStyle: {
                                color: '#39DCF4',
                                fontSize: '10',
                                // borderRadius: 3,
                                padding: [10, 10]
                            }
                        },
                        nameGap: '2',
                        indicator: indicatorArr,
                        splitArea: {
                            areaStyle: {
                                color: 'rgba(255,255,255,0)'
                            }
                        },
                        axisLine: { //指向外圈文本的分隔线样式
                            lineStyle: {
                                color: 'rgba(255,255,255,.2)'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                width: 1,
                                color: 'rgba(255,255,255,.2)'
                            }
                        },

                    },
                    series: [{
                        name: 'XXX区域占比',
                        type: 'radar',
                        animationDuration: 2000,
                        areaStyle: {
                            normal: {
                                color: {
                                    type: 'linear',
                                    opacity: 1,
                                    x: 0,
                                    y: 0,
                                    x2: 0,
                                    y2: 1,
                                    color: '#2EEFAD'
                                }
                            }
                        },
                        symbolSize: 0,
                        lineStyle: {
                            normal: {
                                // color: 'rgba(252,211,3, 1)',
                                width: 0
                            }
                        },
                        data: data
                    }]
                };
                coverageChart.setOption(option)
                setInterval(function() {
                    coverageChart.clear()
                    coverageChart.setOption(option)
                },10000)
            },
            // 本年公开数量
            yearsNumFn:function() {
                var resArr = [
                    {name: '评论', value: "<?php echo $comment_count; ?>"},
                    {name: '点赞', value: "<?php echo $like_count; ?>"},
                    {name: '播放', value: "<?php echo $view_count; ?>"},
                    {name: '发布', value: "<?php echo !empty($fpcoun)?$fpcoun:'0'; ?>"},
                ]
                var nameArr = []
                var caiArr = []
                var cunArr = []
                var danArr = []
                var junArr = []
                var zhenArr = []
                for(var i = 0; i < resArr.length; i++) {
                    nameArr.push(resArr[i].name)
                    caiArr.push(resArr[i].value)
                    cunArr.push(resArr[i].value)
                    danArr.push(resArr[i].value)
                    junArr.push(resArr[i].value)
                    zhenArr.push(resArr[i].value)
                }
                var yearsNumChart = echarts.init(document.getElementById('yearsNumId'));
                var spNum = 5,_max=100;
                var y_data = nameArr.reverse();
                var _datamax = [100,100,100,100,100,100,100,100,100,100,100,100],
                    _data1 = caiArr.reverse(),
                    _data2 = cunArr.reverse(),
                    _data3 = danArr.reverse();
                    _data4 = junArr.reverse();
                    _data5 = zhenArr.reverse();
                var fomatter_fn = function(v) {
                    return (v.value / _max * 100).toFixed(0)
                }
                var _label = {
                    normal: {
                        show: true,
                        position: 'inside',
                        formatter: fomatter_fn,
                        textStyle: {
                            color: '#fff',
                            fontSize: 8
                        }
                    }
                };
                var option = {
                    grid: {
                        containLabel: true,
                        left: 0,
                        top: 0,
                        right: 0,
                        bottom: 0
                    },
                    tooltip: {
                        show: true,
                        backgroundColor: '#fff',
                        borderColor: '#ddd',
                        borderWidth: 1,
                        textStyle: {
                            color: '#3c3c3c',
                            fontSize: 16
                        },
                        extraCssText: 'box-shadow: 0 0 5px rgba(0, 0, 0, 0.1)'
                    },
                    xAxis: {
                        splitNumber: spNum,
                        interval: _max / spNum,
                        axisLabel: {
                            show: false,
                            formatter: function(v) {
                                var _v = (v / _max * 100).toFixed(0);
                                return _v == 0 ? _v : _v + '%';
                            }
                        },
                        axisLine: {
                            show: false
                        },
                        axisTick: {
                            show: false
                        },
                        splitLine: {
                            show: false
                        }

                    },
                    yAxis: [{
                        data: y_data,
                        axisLabel: {
                            fontSize: 8,
                            color: 'rgba(255,255,255,.7)'

                        },
                        axisLine: {
                            show: false
                        },
                        axisTick: {
                            show: false
                        },
                        splitLine: {
                            show: false
                        }
                    }, {
                        show: false,
                        data: y_data,
                        axisLine: {
                            show: false
                        }
                    }],
                    series: [{
                        type: 'bar',
                        name: '总数',
                        stack: '2',
                        label: _label,
                        legendHoverLink: false,
                        barWidth: 7,
                        itemStyle: {
                            normal: {
                                color: '#FD9133'
                            },
                            emphasis: {
                                color: '#FD9133'
                            }
                        },
                        data: _data1
                    }]
                };
                yearsNumChart.setOption(option)
                setInterval(function() {
                    yearsNumChart.clear()
                    yearsNumChart.setOption(option)
                },120000)
            },
            // 关注内容区域占比
            contentFn:function() {
                var resArr = [
                    {name: '评论', value: "<?php echo $comment_count; ?>"},
                    {name: '点赞', value: "<?php echo $like_count; ?>"},
                    {name: '播放', value: "<?php echo $view_count; ?>"},
                    {name: '发布', value: "<?php echo !empty($fpcoun)?$fpcoun:'0'; ?>"},
                ]
                var nameArr = []
                var caiArr = []
                var cunArr = []
                var danArr = []
                var junArr = []
                var zhenArr = []
                for(var i = 0; i < resArr.length; i++) {
                    nameArr.push(resArr[i].name)
                    caiArr.push(resArr[i].value)
                    cunArr.push(resArr[i].value)
                    danArr.push(resArr[i].value)
                    junArr.push(resArr[i].value)
                    zhenArr.push(resArr[i].value)
                }

                var contentChart = echarts.init(document.getElementById('contentId'));
                var option = {
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        x: '35%',
                        y: '0%',
                        data: [],
                        textStyle: {
                            color: "#fff",
                            fontSize: 8
                        },
                        itemWidth: 10,
                        itemHeight: 10,
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: 'category',
                            data: nameArr,
                            axisLabel: {
                                interval: 0,
                                textStyle: {
                                    fontSize: 8,
                                    color: 'rgba(255,255,255,.7)',
                                }
                            },
                            "axisTick": {       //y轴刻度线
                                "show": false
                            },
                            "axisLine": {       //y轴
                                "show": false,
                            },
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            scale: true,
                            name: '单位：次',
                            nameTextStyle: {
                                color: 'rgba(255,255,255,.7)',
                                fontSize: 8
                            },
                            min: 0,
                            boundaryGap: [0.2, 0.2],
                            "axisTick": {       //y轴刻度线
                                "show": false
                            },
                            "axisLine": {       //y轴
                                "show": false,
                            },
                            axisLabel: {
                                textStyle: {
                                    color: 'rgba(255,255,255,.8)',
                                    fontSize: 8
                                    // opacity: 0.1,
                                }
                            },
                            splitLine: {  //决定是否显示坐标中网格
                                show: true,
                                lineStyle: {
                                    color: ['#fff'],
                                    opacity: 0.2
                                }
                            },
                        },
                        {
                            type: 'value',
                            scale: true,
                            show: false,
                            // name: "销量额(万元)",
                            nameTextStyle: {
                                color: 'rgba(255,255,255,.2)',
                            },
                            max: 1,
                            min: 0,
                            boundaryGap: [0.2, 0.2],
                            "axisTick": {       //y轴刻度线
                                "show": false
                            },
                            "axisLine": {       //y轴
                                "show": false,
                            },
                            axisLabel: {
                                textStyle: {
                                    color: 'rgba(255,255,255,.2)',
                                    // opacity: 0.1,
                                }
                            },
                            splitLine: {  //决定是否显示坐标中网格
                                show: true,
                                lineStyle: {
                                    color: ['#fff'],
                                    opacity: 0.2
                                }
                            },

                        }
                    ],
                    color: ['#0EFCFF', '#FD9133'],
                    grid: {
                        left: '5%',
                        right: '1%',
                        top: '25%',
                        bottom: '15%'
                        // containLabel: true
                    },
                    series: [
                        {
                            barWidth: '50%',
                            name: '总数',
                            type: 'bar',
                            data: caiArr,
                        }
                    ]
                };
                contentChart.setOption(option)
                setInterval(function() {
                    contentChart.clear()
                    contentChart.setOption(option)
                },90000)
            },
            // 巡察
            publicNumFn:function() {
                var resArr = [
                    {name: '评论数量', value: "<?php echo $comment_count; ?>"},
                    {name: '客户总数', value: "<?php echo $levela+$levelb+$levelc; ?>"},
                ]
                var xunArr = []
                var jingArr = []
                var dateArr = []
                for(var i = 0; i < resArr.length; i++) {
                    xunArr.push(resArr[i].value)
                    jingArr.push(resArr[i].value)
                    dateArr.push(resArr[i].name)
                }
                var publicNumChart = echarts.init(document.getElementById('publicNumId'));
                var option = {
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        x: '35%',
                        y: '0%',
                        data: [],
                        textStyle: {
                            color: "#fff",
                            fontSize: 8
                        },
                        itemWidth: 10,
                        itemHeight: 10,
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: 'category',
                            data: dateArr,
                            axisLabel: {
                                interval: 0,
                                textStyle: {
                                    fontSize: 8,
                                    color: 'rgba(255,255,255,.7)',
                                }
                            },
                            "axisTick": {       //y轴刻度线
                                "show": false
                            },
                            "axisLine": {       //y轴
                                "show": false,
                            },
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            scale: true,
                            name: '单位：个',
                            nameTextStyle: {
                                color: 'rgba(255,255,255,.7)',
                                fontSize: 8
                            },
                            min: 0,
                            boundaryGap: [0.2, 0.2],
                            "axisTick": {       //y轴刻度线
                                "show": false
                            },
                            "axisLine": {       //y轴
                                "show": false,
                            },
                            axisLabel: {
                                textStyle: {
                                    color: 'rgba(255,255,255,.8)',
                                    fontSize: 8
                                    // opacity: 0.1,
                                }
                            },
                            splitLine: {  //决定是否显示坐标中网格
                                show: true,
                                lineStyle: {
                                    color: ['#fff'],
                                    opacity: 0.2
                                }
                            },
                        },
                        {
                            type: 'value',
                            scale: true,
                            show: false,
                            // name: "销量额(万元)",
                            nameTextStyle: {
                                color: 'rgba(255,255,255,.2)',
                            },
                            max: 1,
                            min: 0,
                            boundaryGap: [0.2, 0.2],
                            "axisTick": {       //y轴刻度线
                                "show": false
                            },
                            "axisLine": {       //y轴
                                "show": false,
                            },
                            axisLabel: {
                                textStyle: {
                                    color: 'rgba(255,255,255,.2)',
                                    // opacity: 0.1,
                                }
                            },
                            splitLine: {  //决定是否显示坐标中网格
                                show: true,
                                lineStyle: {
                                    color: ['#fff'],
                                    opacity: 0.2
                                }
                            },

                        }
                    ],
                    color: ['#2E8CFF', '#38EB70'],
                    grid: {
                        left: '5%',
                        right: '1%',
                        top: '25%',
                        bottom: '15%'
                        // containLabel: true
                    },
                    series: [
                        {
                            animationDuration: 2500,
                            barWidth: '60%',
                            name: '总数',
                            type: 'bar',
                            data: xunArr,
                        }
                    ],
                    animationEasing: 'cubicOut'
                };
                publicNumChart.setOption(option)
                setInterval(function() {
                    publicNumChart.clear()
                    publicNumChart.setOption(option)
                },60000)
            }

        }
        var start = new apiFn()
        start.Init()
    })
</script>
