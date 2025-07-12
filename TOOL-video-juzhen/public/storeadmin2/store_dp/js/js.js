 $(window).load(function(){  
             $(".loading").fadeOut()
            })  
			
/****/
$(document).ready(function(){
	var whei=$(window).width()
	$("html").css({fontSize:whei/20})
	$(window).resize(function(){
		var whei=$(window).width()
	 $("html").css({fontSize:whei/20})
});
	});


 $(window).load(function(){$(".loading").fadeOut()})  
$(function () {
    echarts_1()
    echarts_2()
    echarts_3()
    echarts_4()
    echarts_5()
    echarts_6()
    pe01()
    pe02()
    pe03()

function echarts_1() {
 var myChart = echarts.init(document.getElementById('echarts1'));

 option = {
  tooltip: {
 trigger: 'axis',
 axisPointer: {type: 'shadow'},
},"grid": {
  "top": "20%",
"right":"50",
"bottom":"20",
"left":"30",
},
legend: {
  data: ['发布', '播放', '点赞','评论','分享','下载'],
  right: 'center', width:'100%',
  textStyle: {
      color: "#fff"
  },
  itemWidth: 12,
  itemHeight: 10,
},



 "xAxis": [
   {
     "type": "category",
     data: task_data_key,
     axisLine: { lineStyle: {color: "rgba(255,255,255,.1)"}},
     axisLabel:  { textStyle: {color: "rgba(255,255,255,.7)", fontSize: '14', },
         },
 
     },
],
 "yAxis": [
   {
     "type": "value",
     "name": "单位万",
     axisTick: {show: false},
     splitLine: {
      show: false,
     
  },
     "axisLabel": {
       "show": true,
       fontSize:14,
       color: "rgba(255,255,255,.6)"
      
     },
     axisLine: {
      min:0,
      max:10,
       lineStyle: {color: 'rgba(255,255,255,.1)'}
      },//左线色
     
   },
   {
     "type": "value",
     "name": "增速",
     "show": true,
     "axisLabel": {
       "show": true,
       fontSize:14,
       formatter: "{value} %",
       color: "rgba(255,255,255,.6)"
     },
     axisTick: {show: false},
   axisLine: {lineStyle: {color: 'rgba(255,255,255,.1)'}},//右线色
    splitLine: {show:true,lineStyle: {color:'rgba(255,255,255,.1)'}},//x轴线
   },
 ],
 "series": [
  
   {
     "name": "发布",
     "type": "bar",
     "data": send_data,
     "barWidth": "15%",
     "itemStyle": {
       "normal": {
        barBorderRadius: 15,
        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
          offset: 0,
          color: '#8bd46e'
      }, {
          offset: 1,
          color: '#09bcb7'
      }]),
       }
     },
     "barGap": "0.2"
   },
   {
    "name": "播放",
    "type": "bar",
    "data":view_data,
    "barWidth": "15%",
    "itemStyle": {
      "normal": {
       barBorderRadius: 15,
       color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
        offset: 0,
        color: '#248ff7'
    }, {
        offset: 1,
        color: '#6851f1'
    }]),
      }
    },
    "barGap": "0.2"
  },
  {
    "name": "点赞",
    "type": "bar",
    "data":like_data,
    "barWidth": "15%",
    "itemStyle": {
      "normal": {
       barBorderRadius: 15,
       color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
         offset: 0,
         color: '#fccb05'
     }, {
         offset: 1,
         color: '#f5804d'
     }]),
      }
    },
    "barGap": "0.2"
  },
   {
     "name": "评论",
     "type": "line",
        smooth: true,
     "yAxisIndex": 1,
     "data": comment_data,
   lineStyle: {
        normal: {
          width: 2
        },
      },
     "itemStyle": {
       "normal": {
         "color": "#86d370",
    
       }
     },
   
   }
   ,
   {
     "name": "分享",
     "type": "line",
     "yAxisIndex": 1,
 
     "data": share_data,
   lineStyle: {
   normal: {
     width: 2
   },
 },
     "itemStyle": {
       "normal": {
         "color": "#3496f8",
    
       }
     },
     "smooth": true
   } ,
   {
     "name": "下载",
     "type": "line",
     "yAxisIndex": 1,
 
     "data":download_data,
   lineStyle: {
   normal: {
     width: 2
   },
 },
     "itemStyle": {
       "normal": {
         "color": "#fbc30d",
    
       }
     },
     "smooth": true
   }
 ]
};

        myChart.setOption(option);
        window.addEventListener("resize",function(){
            myChart.resize();
        });

	
    }
function echarts_2() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('echarts2'));

       option = {
	    tooltip: {
        trigger: 'axis',
        axisPointer: {type: 'shadow'},
       // formatter:'{c}' ,
    },
    grid: {
        left: '0',
	  	top: '30',
        right: '10',
        bottom: '-20',
        containLabel: true
    },
    legend: {
        data: ['分享', '下载'],
        right: 'center',
        top:0,
        textStyle: {
            color: "#fff"
        },
        itemWidth: 12,
        itemHeight: 10,
        // itemGap: 35
    },

    xAxis: [{
        type: 'category',
        boundaryGap: false,
axisLabel:  {
  rotate: -90,
                textStyle: {
 					color: "rgba(255,255,255,.6)",
          fontSize:14,
         
                },
            },
        axisLine: {
			lineStyle: { 
				color: 'rgba(255,255,255,.1)'
			}

        },

   data: task_data_key

    }, {

        axisPointer: {show: false},
        axisLine: {  show: false},
        position: 'bottom',
        offset: 20,

       

    }],

    yAxis: [{
        type: 'value',
        axisTick: {show: false},
       // splitNumber: 6,
        axisLine: {
            lineStyle: {
                color: 'rgba(255,255,255,.1)'
            }
        },
       axisLabel:  {
        formatter: "{value} %",
                textStyle: {
 					color: "rgba(255,255,255,.6)",
					fontSize:14,
                },
            },

        splitLine: {
            lineStyle: {
                 color: 'rgba(255,255,255,.1)'
            }
        }
    }],
    series: [
		{
        name: '分享',
        type: 'line',
        smooth: true,
        symbol: 'circle',
        symbolSize: 5,
        showSymbol: false,
        lineStyle: {
            normal: {
				color: 'rgba(228, 228, 126, 1)',
                width: 2
            }
        },
        areaStyle: {
            normal: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    offset: 0,
                    color: 'rgba(228, 228, 126, .2)'
                }, {
                    offset: 1,
                    color: 'rgba(228, 228, 126, 0)'
                }], false),
                shadowColor: 'rgba(0, 0, 0, 0.1)',
            }
        },
			itemStyle: {
			normal: {
        color: 'rgba(228, 228, 126, 1)',
				borderColor: 'rgba(228, 228, 126, .1)',
				borderWidth: 12
			}
		},
        data: share_data

    }, {
        name: '下载',
        type: 'line',
        smooth: true,
        symbol: 'circle',
        symbolSize: 5,
        showSymbol: false,
        lineStyle: {
			
            normal: {
				color: 'rgba(255, 128, 128, 1)',
                width: 2
            }
        },
        areaStyle: {
            normal: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    offset: 0,
                    color: 'rgba(255, 128, 128,.2)'
                }, {
                    offset:1,
                    color: 'rgba(255, 128, 128, 0)'
                }], false),
                shadowColor: 'rgba(0, 0, 0, 0.1)',
            }
        },
			itemStyle: {
			normal: {
				color: 'rgba(255, 128, 128, 1)',
				borderColor: 'rgba(255, 128, 128, .1)',
				borderWidth: 12
			}
		},
        data: download_data
    }, 
		 ]
};
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        window.addEventListener("resize",function(){
            myChart.resize();
        });
    }
    function echarts_3() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('echarts3'));

        option = {

          tooltip: {
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
              type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
            }
          },
          legend: {
            data: ['点赞', '评论'],
            right: 'center',
            top:0,
            textStyle: {
                color: "#fff"
            },
            itemWidth: 12,
            itemHeight: 10,
            // itemGap: 35
        },
          grid: {
            left: '0',
            right: '20',
            bottom: '0',
            top:'15%',
            containLabel: true
          },
          xAxis: {
            type: 'category',
            data: task_data_key,
            axisLine: {
              lineStyle: {
                color: 'white'
   
              }
            },
            axisLabel: {
              //rotate:-90,
              formatter:function(value){return value.split("").join("\n");},
         textStyle: {
              color: "rgba(255,255,255,.6)",
             fontSize:14,
                   }
        },
            axisLine: {
               lineStyle: {
                   color: 'rgba(255,255,255,0.3)'
               }
           },
          },
   
          yAxis: {
            type: 'value',
            splitNumber: 4,
            axisTick: {show: false},
            splitLine: {
              show: true,
              lineStyle: {
                color: 'rgba(255,255,255,0.1)'
              }
            },
            axisLabel: {textStyle: {
              color: "rgba(255,255,255,.6)",
             fontSize:14,
                   }},
            axisLine: {show:false},
          },
     
          series: [{
            name: '点赞',
            type: 'bar',
            stack: 'a',
            barWidth: '30',barGap: 0,
            itemStyle: {
               normal: {
                color: '#8bd46e', }
            },
            data: like_data
          },
          {
            name: '评论',
            type: 'bar',
            stack: 'a',
            barWidth: '30',barGap: 0,
            itemStyle: {
               normal: {
                color: '#f5804d',
               barBorderRadius:0, }
            },
            data: comment_data
          },
        ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        window.addEventListener("resize",function(){
            myChart.resize();
        });
    }
    function echarts_5() {
      // 基于准备好的dom，初始化echarts实例
      var myChart = echarts.init(document.getElementById('echarts5'));

      option = {
        tooltip: {
       trigger: 'axis',
       axisPointer: {type: 'shadow'},
      },"grid": {
        "top": "15%",
      "right":"10%",
      "bottom":"20",
      "left":"10%",
      },
       legend: {
        data: ['排名', '排名'],
        right: 'center',
        top:0,
        textStyle: {
            color: "#fff"
        },
        itemWidth: 12,
        itemHeight: 10,
      },
       "xAxis": [
         {
           "type": "category",
       
           data: task_data_key,
           axisLine: { lineStyle: {color: "rgba(255,255,255,.1)"}},
           axisLabel:  { textStyle: {color: "rgba(255,255,255,.7)", fontSize: '14', },
               },
       
           },
     ],
       "yAxis": [
         {
           "type": "value",
           "name": "个数",
           splitLine: {show: false},
           axisTick: {show: false},
           "axisLabel": {
             "show": true,
             color: "rgba(255,255,255,.6)"
            
           },
           axisLine: {lineStyle: {color: 'rgba(255,255,255,.1)'}},//左线色
           
         },
         {
           "type": "value",
           "name": "单位2",
           "show": true,
           axisTick: {show: false},
           "axisLabel": {
             "show": true,
             formatter: "{value} %",
             color: "rgba(255,255,255,.6)"
           },
         axisLine: {lineStyle: {color: 'rgba(255,255,255,.1)'}},//右线色
          splitLine: {show:true,lineStyle: {color:'rgba(255,255,255,.1)'}},//x轴线
         },
       ],
       "series": [
        
         {
           "name": "排名",
           "type": "bar",
           "data": rank_data,
           "barWidth": "20%",

           "itemStyle": {
             "normal": {
              barBorderRadius: 15,
              color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                offset: 0,
                color: '#fccb05'
            }, {
                offset: 1,
                color: '#f5804d'
            }]),
             }
           },
           "barGap": "0"
         },
         {
           "name": "排名",
           "type": "line",
           "yAxisIndex": 1,
       
           "data": rank_data,
         lineStyle: {
         normal: {
           width: 2
         },
       },
           "itemStyle": {
             "normal": {
               "color": "#ff3300",
          
             }
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
  }
    function echarts_4() {
      // 基于准备好的dom，初始化echarts实例
      var myChart = echarts.init(document.getElementById('echarts4'));
      var myColor=[];
      option = {
           
              grid: {
                  left: '2%',
                  top:'1%',
                  right: '5%',
                  bottom: '0%',
                  containLabel: true
              },
              xAxis: [{
                  show: false,
              }],
              yAxis: [{
                      axisTick:'none',
                      axisLine:'none',
                      offset:'7',
                      triggerEvent:true,
                      axisLabel: {
                              textStyle: {
                                  color: 'rgba(255,255,255,.6)',
                                  fontSize:'14',
                              },
                              formatter: function(params) {
                                //标签输出形式
                                let val = params + '';
                                let newVal = '';
                                if (val.length > 5) {
                                  newVal = val.substring(0, 8) + '...';
                                } else {
                                  newVal = val + '';
                                }
                                return newVal;
                              }
                          },
                      data: video_hot_key,

                  },{
                      name:'单位：件',
                          nameGap:'50',
                          nameTextStyle:{
                            color: 'rgba(255,255,255,.6)',
                              fontSize:'16',
                          },
                      axisLine:{    
                        lineStyle:{
                          color:'rgba(0,0,0,0)'
                        }
                      },
                      data: [],
              }],
              series: [{
                  name: '条',
                  type: 'bar',
                  yAxisIndex: 0,
                  data: video_hot_rate,
                  label:{
                        normal:{
                          show:true,
                          position:'right',
                          formatter:function(param){
                            return param.value;
                          },
                          textStyle:{
                            color: 'rgba(255,255,255,.8)',
                             fontSize:'12',
                          }
                        }
                  },
                  barWidth: 15,
                  itemStyle: {
                      normal: {
                          color: new echarts.graphic.LinearGradient(1, 0, 0, 0, [{
                                  offset: 0,
                                  color: '#03c893'
                              },
                              {
                                  offset: 1,
                                  color: '#0091ff'
                              }
                          ]),
                          barBorderRadius: 15,
                      }
                  },
                  z: 2
              }, {
                  name: '白框',
                  type: 'bar',
                  yAxisIndex: 1,
                  barGap: '-100%',
                  data: [],
                  barWidth: 15,
                  itemStyle: {
                      normal: {
                        color:'rgba(0,0,0,.2)',
                          barBorderRadius:15,
                      }
                  },
                  z: 1
              }]
          };
   

      myChart.setOption(option);

      domid  = 'echarts4';
      var elementDiv = document.getElementById('extension')
        if (!elementDiv) {
          var div = document.createElement('div')
          div.setAttribute('id', 'extension')
          div.style.display = 'block'
          document.querySelector('html').appendChild(div)
        }
        myChart.on('mouseover', function (params) {
          if (params.componentType == 'yAxis') {
            var elementDiv = document.querySelector('#extension')
            //设置悬浮文本的位置以及样式
            var elementStyle =
              'position: absolute;z-index: 99999;color: #fff;font-size: 12px;padding: 5px;display: inline;border-radius: 4px;background-color: #303133;box-shadow: rgba(0, 0, 0, 0.3) 2px 2px 8px'
            elementDiv.style.cssText = elementStyle
            elementDiv.innerHTML = params.value
            document.querySelector('html').onmousemove = function (event) {
              var elementDiv = document.querySelector('#extension')
              var xx = event.pageX - 10
              var yy = event.pageY + 15
              elementDiv.style.top = yy + 'px'
              elementDiv.style.left = xx + 'px'
            }
          }
        })
        myChart.on('mouseout', function (params) {
          //注意这里，我是以X轴显示内容过长为例，如果是y轴的话，需要改为yAxis
          if (params.componentType == 'yAxis') {
            var elementDiv = document.querySelector('#extension')

            elementDiv.style.cssText = 'display:none'
          }
        })
      

      window.addEventListener("resize",function(){
          myChart.resize();
      });
  }
  function echarts_6() {
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('echarts6'));
   

  option = {
    title:{
      text:fenbu_count,
      subtext:'总体',
      x:'center',
      y:'40%',
      textStyle:{
          color:'#fff',
          fontSize:22,
          lineHeight:10,
      },
      subtextStyle: {
          color:'#90979c',
          fontSize:20,
          lineHeight:10,

      },
  },
    tooltip: {
        trigger: 'item',
        formatter: "{b} : {c} ({d}%)"
    },

    visualMap: {
        show: false,
        min: 500,
        max: 600,
        inRange: {
            //colorLightness: [0, 1]
        }
    },
    series: [{
        name: '访问来源',
        type: 'pie',
        radius: ['50%', '70%'],
        center: ['50%', '50%'],
        color: ['rgb(131,249,103)', '#FBFE27', '#FE5050', '#1DB7E5'], //'#FBFE27','rgb(11,228,96)','#FE5050'
        data: [{
          "value": douyin_count,
          "name": "抖音"
      }, {
          "value": ks_count,
          "name": "快手"
      }, {
          "value": bili_count,
          "name": "哔哩"}
        ].sort(function(a, b) {
            return a.value - b.value
        }),
        roseType: 'radius',

        label: {
            normal: {
                formatter: ['{c|{c}}', '{b|{b}}'].join('\n'),
                rich: {
                    c: {
                        color: 'rgb(241,246,104)',
                        fontSize: 20,
                        fontWeight:'bold',
                        lineHeight: 5
                    },
                    b: {
                        color: 'rgb(98,137,169)',
                        fontSize: 14,
                        height: 44
                    },
                },
            }
        },
        labelLine: {
            normal: {
                lineStyle: {
                    color: 'rgb(98,137,169)',
                },
                smooth: 0.2,
                length: 10,
                length2: 20,

            }
        }
    }]
};
 

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    window.addEventListener("resize",function(){
        myChart.resize();
    });
}


    function pe01() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('pe01'));
        var txt=like_count
        option = {
            title: {
              text: txt,
              x: 'center',
             y: 'center',
              textStyle: {
                fontWeight: 'normal',
                color: '#fff',
                fontSize: '16'
              }
            },
            color:'rgba(255,255,255,.3)',
         
            series: [{
              name: 'Line 1',
              type: 'pie',
              clockWise: true,
              radius: ['60%', '80%'],
              itemStyle: {
                normal: {
                  label: {
                    show: false
                  },
                  labelLine: {
                    show: false
                  }
                }
              },
              hoverAnimation: false,
              data: [{
                value: 99,
                name: '已使用',
                itemStyle: {
                  normal: {
                    color:'#eaff00',
                    label: {
                      show: false
                    },
                    labelLine: {
                      show: false
                    }
                  }
                }
              }]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        window.addEventListener("resize",function(){
            myChart.resize();
        });
    }

    function pe02() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('pe02'));
        var txt=comment_count
        option = {
            title: {
              text: txt,
              x: 'center',
             y: 'center',
              textStyle: {
                fontWeight: 'normal',
                color: '#fff',
                fontSize: '18'
              }
            },
            color:'rgba(255,255,255,.3)',
         
            series: [{
              name: 'Line 1',
              type: 'pie',
              clockWise: true,
              radius: ['65%', '80%'],
              itemStyle: {
                normal: {
                  label: {
                    show: false
                  },
                  labelLine: {
                    show: false
                  }
                }
              },
              hoverAnimation: false,
              data: [{
                value: 100,
                name: '已使用',
                itemStyle: {
                  normal: {
                    color:'#ea4d4d',
                    label: {
                      show: false
                    },
                    labelLine: {
                      show: false
                    }
                  }
                }
              }, {
                name: '未使用',
                value: 0
              }]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        window.addEventListener("resize",function(){
            myChart.resize();
        });
    }
    function pe03() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('pe03'));
        var txt=total_share
        option = {
            title: {
              text: txt,
              x: 'center',
             y: 'center',
              textStyle: {
                fontWeight: 'normal',
                color: '#fff',
                fontSize: '18'
              }
            },
            color:'rgba(255,255,255,.3)',
         
            series: [{
              name: 'Line 1',
              type: 'pie',
              clockWise: true,
              radius: ['65%', '80%'],
              itemStyle: {
                normal: {
                  label: {
                    show: false
                  },
                  labelLine: {
                    show: false
                  }
                }
              },
              hoverAnimation: false,
              data: [{
                value: 99,
                name: '已使用',
                itemStyle: {
                  normal: {
                    color:'#395ee6',
                    label: {
                      show: false
                    },
                    labelLine: {
                      show: false
                    }
                  }
                }
              }, {
                name: '未使用',
                value: 1
              }
            ]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        window.addEventListener("resize",function(){
            myChart.resize();
        });
    }
})



		
		
		


		



















