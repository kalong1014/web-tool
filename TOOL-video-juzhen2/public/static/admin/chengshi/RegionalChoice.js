/*模拟数据省市*/
var datas=[{children:[{name:"北京市"}],name:"北京市"},{children:[{name:"天津市"}],name:"天津市"},{children:[{name:"上海市"}],name:"上海市"},{children:[{name:"重庆市"}],name:"重庆市"},{children:[{name:"石家庄市"},{name:"邯郸市"},{name:"唐山市"},{name:"保定市"},{name:"秦皇岛市"},{name:"邢台市"},{name:"张家口市"},{name:"承德市"},{name:"沧州市"},{name:"廊坊市"},{name:"衡水市"},{name:"辛集市"},{name:"晋州市"},{name:"新乐市"},{name:"遵化市"},{name:"迁安市"},{name:"霸州市"},{name:"三河市"},{name:"定州市"},{name:"涿州市"},{name:"安国市"},{name:"高碑店市"},{name:"泊头市"},{name:"任丘市"},{name:"黄骅市"},{name:"河间市"},{name:"冀州市"},{name:"深州市"},{name:"南宫市"},{name:"沙河市"},{name:"武安市"}],name:"河北省"},{children:[{name:"太原市"},{name:"大同市"},{name:"朔州市"},{name:"阳泉市"},{name:"长治市"},{name:"晋城市"},{name:"忻州市"},{name:"吕梁市"},{name:"晋中市"},{name:"临汾市"},{name:"运城市"},{name:"古交市"},{name:"潞城市"},{name:"高平市"},{name:"原平市"},{name:"孝义市"},{name:"汾阳市"},{name:"介休市"},{name:"侯马市"},{name:"霍州市"},{name:"永济市"},{name:"河津市"}],name:"山西省"},{children:[{name:"沈阳市"},{name:"大连市"},{name:"朝阳市"},{name:"阜新市"},{name:"铁岭市"},{name:"抚顺市"},{name:"本溪市"},{name:"辽阳市"},{name:"鞍山市"},{name:"丹东市"},{name:"营口市"},{name:"盘锦市"},{name:"锦州市"},{name:"葫芦岛市"},{name:"新民市"},{name:"瓦房店市"},{name:"庄河市"},{name:"北票市"},{name:"凌源市"},{name:"调兵山市"},{name:"开原市"},{name:"灯塔市"},{name:"海城市"},{name:"凤城市"},{name:"东港市"},{name:"大石桥市"},{name:"盖州市"},{name:"凌海市"},{name:"北镇市"},{name:"兴城市"}],name:"辽宁省"},{children:[{name:"长春市"},{name:"吉林市"},{name:"白城市"},{name:"松原市"},{name:"四平市"},{name:"辽源市"},{name:"通化市"},{name:"白山市"},{name:"德惠市"},{name:"榆树市"},{name:"磐石市"},{name:"蛟河市"},{name:"桦甸市"},{name:"舒兰市"},{name:"洮南市"},{name:"大安市"},{name:"双辽市"},{name:"公主岭市"},{name:"梅河口市"},{name:"集安市"},{name:"临江市"},{name:"延吉市"},{name:"图们市"},{name:"敦化市"},{name:"珲春市"},{name:"龙井市"},{name:"和龙市"},{name:"扶余市"}],name:"吉林省"},{children:[{name:"哈尔滨市"},{name:"齐齐哈尔市"},{name:"黑河市"},{name:"大庆市"},{name:"伊春市"},{name:"鹤岗市"},{name:"佳木斯市"},{name:"双鸭山市"},{name:"七台河市"},{name:"鸡西市"},{name:"牡丹江市"},{name:"绥化市"},{name:"尚志市"},{name:"五常市"},{name:"讷河市"},{name:"北安市"},{name:"五大连池市"},{name:"铁力市"},{name:"同江市"},{name:"富锦市"},{name:"虎林市"},{name:"密山市"},{name:"绥芬河市"},{name:"海林市"},{name:"宁安市"},{name:"安达市"},{name:"肇东市"},{name:"海伦市"},{name:"穆棱市"},{name:"东宁市"},{name:"抚远市"}],name:"黑龙江省"},{children:[{name:"南京市"},{name:"徐州市"},{name:"连云港市"},{name:"宿迁市"},{name:"淮安市"},{name:"盐城市"},{name:"扬州市"},{name:"泰州市"},{name:"南通市"},{name:"镇江市"},{name:"常州市"},{name:"无锡市"},{name:"苏州市"},{name:"常熟市"},{name:"张家港市"},{name:"太仓市"},{name:"昆山市"},{name:"江阴市"},{name:"宜兴市"},{name:"溧阳市"},{name:"扬中市"},{name:"句容市"},{name:"丹阳市"},{name:"如皋市"},{name:"海门市"},{name:"启东市"},{name:"高邮市"},{name:"仪征市"},{name:"兴化市"},{name:"泰兴市"},{name:"靖江市"},{name:"东台市"},{name:"邳州市"},{name:"新沂市"}],name:"江苏省"},{children:[{name:"杭州市"},{name:"宁波市"},{name:"湖州市"},{name:"嘉兴市"},{name:"舟山市"},{name:"绍兴市"},{name:"衢州市"},{name:"金华市"},{name:"台州市"},{name:"温州市"},{name:"丽水市"},{name:"临安市"},{name:"建德市"},{name:"慈溪市"},{name:"余姚市"},{name:"平湖市"},{name:"海宁市"},{name:"桐乡市"},{name:"诸暨市"},{name:"嵊州市"},{name:"江山市"},{name:"兰溪市"},{name:"永康市"},{name:"义乌市"},{name:"东阳市"},{name:"临海市"},{name:"温岭市"},{name:"瑞安市"},{name:"乐清市"},{name:"龙泉市"}],name:"浙江省"},{children:[{name:"合肥市"},{name:"芜湖市"},{name:"蚌埠市"},{name:"淮南市"},{name:"马鞍山市"},{name:"淮北市"},{name:"铜陵市"},{name:"安庆市"},{name:"黄山市"},{name:"滁州市"},{name:"阜阳市"},{name:"宿州市"},{name:"六安市"},{name:"亳州市"},{name:"池州市"},{name:"宣城市"},{name:"巢湖市"},{name:"桐城市"},{name:"天长市"},{name:"明光市"},{name:"界首市"},{name:"宁国市"}],name:"安徽省"},{children:[{name:"厦门市"},{name:"福州市"},{name:"南平市"},{name:"三明市"},{name:"莆田市"},{name:"泉州市"},{name:"漳州市"},{name:"龙岩市"},{name:"宁德市"},{name:"福清市"},{name:"长乐市"},{name:"邵武市"},{name:"武夷山市"},{name:"建瓯市"},{name:"永安市"},{name:"石狮市"},{name:"晋江市"},{name:"南安市"},{name:"龙海市"},{name:"漳平市"},{name:"福安市"},{name:"福鼎市"}],name:"福建省"},{children:[{name:"南昌市"},{name:"九江市"},{name:"景德镇市"},{name:"鹰潭市"},{name:"新余市"},{name:"萍乡市"},{name:"赣州市"},{name:"上饶市"},{name:"抚州市"},{name:"宜春市"},{name:"吉安市"},{name:"瑞昌市"},{name:"共青城市"},{name:"乐平市"},{name:"瑞金市"},{name:"德兴市"},{name:"丰城市"},{name:"樟树市"},{name:"高安市"},{name:"井冈山市"},{name:"贵溪市"}],name:"江西省"},{children:[{name:"济南市"},{name:"青岛市"},{name:"聊城市"},{name:"德州市"},{name:"东营市"},{name:"淄博市"},{name:"潍坊市"},{name:"烟台市"},{name:"威海市"},{name:"日照市"},{name:"临沂市"},{name:"枣庄市"},{name:"济宁市"},{name:"泰安市"},{name:"莱芜市"},{name:"滨州市"},{name:"菏泽市"},{name:"胶州市"},{name:"即墨市"},{name:"平度市"},{name:"莱西市"},{name:"临清市"},{name:"乐陵市"},{name:"禹城市"},{name:"安丘市"},{name:"昌邑市"},{name:"高密市"},{name:"青州市"},{name:"诸城市"},{name:"寿光市"},{name:"栖霞市"},{name:"海阳市"},{name:"龙口市"},{name:"莱阳市"},{name:"莱州市"},{name:"蓬莱市"},{name:"招远市"},{name:"荣成市"},{name:"乳山市"},{name:"滕州市"},{name:"曲阜市"},{name:"邹城市"},{name:"新泰市"},{name:"肥城市"}],name:"山东省"},{children:[{name:"郑州市"},{name:"开封市"},{name:"洛阳市"},{name:"平顶山市"},{name:"安阳市"},{name:"鹤壁市"},{name:"新乡市"},{name:"焦作市"},{name:"濮阳市"},{name:"许昌市"},{name:"漯河市"},{name:"三门峡市"},{name:"南阳市"},{name:"商丘市"},{name:"周口市"},{name:"驻马店市"},{name:"信阳市"},{name:"荥阳市"},{name:"新郑市"},{name:"登封市"},{name:"新密市"},{name:"偃师市"},{name:"孟州市"},{name:"沁阳市"},{name:"卫辉市"},{name:"辉县市"},{name:"林州市"},{name:"禹州市"},{name:"长葛市"},{name:"舞钢市"},{name:"义马市"},{name:"灵宝市"},{name:"项城市"},{name:"巩义市"},{name:"邓州市"},{name:"永城市"},{name:"汝州市"},{name:"济源市"}],name:"河南省"},{children:[{name:"武汉市"},{name:"十堰市"},{name:"襄阳市"},{name:"荆门市"},{name:"孝感市"},{name:"黄冈市"},{name:"鄂州市"},{name:"黄石市"},{name:"咸宁市"},{name:"荆州市"},{name:"宜昌市"},{name:"随州市"},{name:"丹江口市"},{name:"老河口市"},{name:"枣阳市"},{name:"宜城市"},{name:"钟祥市"},{name:"汉川市"},{name:"应城市"},{name:"安陆市"},{name:"广水市"},{name:"麻城市"},{name:"武穴市"},{name:"大冶市"},{name:"赤壁市"},{name:"石首市"},{name:"洪湖市"},{name:"松滋市"},{name:"宜都市"},{name:"枝江市"},{name:"当阳市"},{name:"恩施市"},{name:"利川市"},{name:"仙桃市"},{name:"天门市"},{name:"潜江市"}],name:"湖北省"},{children:[{name:"长沙市"},{name:"衡阳市"},{name:"张家界市"},{name:"常德市"},{name:"益阳市"},{name:"岳阳市"},{name:"株洲市"},{name:"湘潭市"},{name:"郴州市"},{name:"永州市"},{name:"邵阳市"},{name:"怀化市"},{name:"娄底市"},{name:"耒阳市"},{name:"常宁市"},{name:"浏阳市"},{name:"津市市"},{name:"沅江市"},{name:"汨罗市"},{name:"临湘市"},{name:"醴陵市"},{name:"湘乡市"},{name:"韶山市"},{name:"资兴市"},{name:"武冈市"},{name:"洪江市"},{name:"冷水江市"},{name:"涟源市"},{name:"吉首市"}],name:"湖南省"},{children:[{name:"广州市"},{name:"深圳市"},{name:"清远市"},{name:"韶关市"},{name:"河源市"},{name:"梅州市"},{name:"潮州市"},{name:"汕头市"},{name:"揭阳市"},{name:"汕尾市"},{name:"惠州市"},{name:"东莞市"},{name:"珠海市"},{name:"中山市"},{name:"江门市"},{name:"佛山市"},{name:"肇庆市"},{name:"云浮市"},{name:"阳江市"},{name:"茂名市"},{name:"湛江市"},{name:"英德市"},{name:"连州市"},{name:"乐昌市"},{name:"南雄市"},{name:"兴宁市"},{name:"普宁市"},{name:"陆丰市"},{name:"恩平市"},{name:"台山市"},{name:"开平市"},{name:"鹤山市"},{name:"四会市"},{name:"罗定市"},{name:"阳春市"},{name:"化州市"},{name:"信宜市"},{name:"高州市"},{name:"吴川市"},{name:"廉江市"},{name:"雷州市"}],name:"广东省"},{children:[{name:"海口市"},{name:"三亚市"},{name:"三沙市"},{name:"儋州市"},{name:"文昌市"},{name:"琼海市"},{name:"万宁市"},{name:"东方市"},{name:"五指山市"}],name:"海南省"},{children:[{name:"成都市"},{name:"广元市"},{name:"绵阳市"},{name:"德阳市"},{name:"南充市"},{name:"广安市"},{name:"遂宁市"},{name:"内江市"},{name:"乐山市"},{name:"自贡市"},{name:"泸州市"},{name:"宜宾市"},{name:"攀枝花市"},{name:"巴中市"},{name:"达州市"},{name:"资阳市"},{name:"眉山市"},{name:"雅安市"},{name:"崇州市"},{name:"邛崃市"},{name:"都江堰市"},{name:"彭州市"},{name:"江油市"},{name:"什邡市"},{name:"广汉市"},{name:"绵竹市"},{name:"阆中市"},{name:"华蓥市"},{name:"峨眉山市"},{name:"万源市"},{name:"简阳市"},{name:"西昌市"},{name:"康定市"},{name:"马尔康市"}],name:"四川省"},{children:[{name:"贵阳市"},{name:"六盘水市"},{name:"遵义市"},{name:"安顺市"},{name:"毕节市"},{name:"铜仁市"},{name:"清镇市"},{name:"赤水市"},{name:"仁怀市"},{name:"凯里市"},{name:"都匀市"},{name:"兴义市"},{name:"福泉市"}],name:"贵州省"},{children:[{name:"昆明市"},{name:"曲靖市"},{name:"玉溪市"},{name:"丽江市"},{name:"昭通市"},{name:"普洱市"},{name:"临沧市"},{name:"保山市"},{name:"安宁市"},{name:"宣威市"},{name:"芒市"},{name:"瑞丽市"},{name:"大理市"},{name:"楚雄市"},{name:"个旧市"},{name:"开远市"},{name:"蒙自市"},{name:"弥勒市"},{name:"景洪市"},{name:"文山市"},{name:"香格里拉市"},{name:"腾冲市"}],name:"云南省"},{children:[{name:"西安市"},{name:"延安市"},{name:"铜川市"},{name:"渭南市"},{name:"咸阳市"},{name:"宝鸡市"},{name:"汉中市"},{name:"榆林市"},{name:"商洛市"},{name:"安康市"},{name:"韩城"},{name:"华阴"},{name:"兴平"}],name:"陕西省"},{children:[{name:"兰州市"},{name:"嘉峪关市"},{name:"金昌市"},{name:"白银市"},{name:"天水市"},{name:"酒泉市"},{name:"张掖市"},{name:"武威市"},{name:"庆阳市"},{name:"平凉市"},{name:"定西市"},{name:"陇南市"},{name:"玉门市"},{name:"敦煌市"},{name:"临夏市"},{name:"合作市"}],name:"甘肃省"},{children:[{name:"西宁市"},{name:"海东市"},{name:"格尔木市"},{name:"德令哈市"},{name:"玉树市"}],name:"青海省"},{children:[{name:"南宁市"},{name:"桂林市"},{name:"柳州市"},{name:"梧州市"},{name:"贵港市"},{name:"玉林市"},{name:"钦州市"},{name:"北海市"},{name:"防城港市"},{name:"崇左市"},{name:"百色市"},{name:"河池市"},{name:"来宾市"},{name:"贺州市"},{name:"岑溪市"},{name:"桂平市"},{name:"北流市"},{name:"东兴市"},{name:"凭祥市"},{name:"宜州市"},{name:"合山市"},{name:"靖西市"}],name:"广西壮族自治区"},{children:[{name:"拉萨市"},{name:"日喀则市"},{name:"昌都市"},{name:"林芝市"},{name:"山南市"}],name:"西藏自治区"},{children:[{name:"银川市"},{name:"石嘴山市"},{name:"吴忠市"},{name:"中卫市"},{name:"固原市"},{name:"灵武市"},{name:"青铜峡市"}],name:"宁夏回族自治区"},{children:[{name:"乌鲁木齐市"},{name:"克拉玛依市"},{name:"吐鲁番市"},{name:"哈密市"},{name:"喀什市"},{name:"阿克苏市"},{name:"和田市"},{name:"阿图什市"},{name:"阿拉山口市"},{name:"博乐市"},{name:"昌吉市"},{name:"阜康市"},{name:"库尔勒市"},{name:"伊宁市"},{name:"奎屯市"},{name:"塔城市"},{name:"乌苏市"},{name:"阿勒泰市"},{name:"霍尔果斯市"},{name:"石河子市"},{name:"阿拉尔市"},{name:"图木舒克市"},{name:"五家渠市"},{name:"北屯市"},{name:"铁门关市"},{name:"双河市"},{name:"可克达拉市"},{name:"昆玉市"}],name:"新疆维吾尔自治区"},{children:[{name:"呼和浩特市"},{name:"包头市"},{name:"乌海市"},{name:"赤峰市"},{name:"呼伦贝尔市"},{name:"通辽市"},{name:"乌兰察布市"},{name:"鄂尔多斯市"},{name:"巴彦淖尔市"},{name:"满洲里市"},{name:"扎兰屯市"},{name:"牙克石市"},{name:"根河市"},{name:"额尔古纳市"},{name:"乌兰浩特市"},{name:"阿尔山市"},{name:"霍林郭勒市"},{name:"锡林浩特市"},{name:"二连浩特市"},{name:"丰镇市"}],name:"内蒙古自治区"},{children:[{name:"台北市"},{name:"新北市"},{name:"桃园市"},{name:"台中市"},{name:"台南市"},{name:"高雄市"},{name:"基隆市"},{name:"新竹市"},{name:"嘉义市"}],name:"台湾省"},{children:[{name:"香港特别行政区"}],name:"香港特区"},{children:[{name:"澳门特别行政区"}],name:"澳门特区"},{children:[{name:"境外地区"}],name:"境外"}]
// JS执行

function GetRegionPlug() {
   
    $(".test-div").append(
        $("<div/>", {
            "class": "place-div"
        }).append(
            $("<div/>", {}).append(
                $("<div/>", {
                    "class": "checkbtn"
                }).append(
                    $("<a/>", {
                        "class": "allcheck",
                        "text": "全选",
                        "click": function () {
                            $(".place").find("input").prop("checked", true);
                            ShowTipNum();
                        }
                    })
                ).append(
                    $("<a/>", {
                        "class": "clearCheck",
                        "text": "清空",
                        "click": function () {
                            $(".place").find("input").prop("checked", false);
                            $(".ratio").html("");
                        }
                    })
                )
            ).append(
                $("<div/>", {
                    "class": "placegroup"
                }).append(
                    GetPlace(datas)
                )
            )
        )
    )
}

function GetPlace(datas) {
    // console.log(datas);
    return datas.map(function (item) {
        // console.log(item);
        return $("<div/>", {
            "class": "place clearfloat"
        }).append(
            $("<div/>", {
                "class": "bigplace"
            }).append(
                $("<div/>", {}).append(
                    $("<label/>", {
                        "text": item.name
                    }).append(
                        $("<input/>", {
                            // "id":item.id,
                            "type": "checkbox",
                            "class": "bigarea",
                            "data-name": item.name,
                            "click": function () {
                                var bool = $(this).prop("checked");
                                var single = $(this).parents(".bigplace").next().find("input");
                                var ee = $(this).parents(".bigplace").next().find(".place-tooltips");
                                single.prop("checked", bool);
                                if (single.prop("checked")) {
                                    ee.each(function (index, a) {
                                        var num = $(this).find(".citys").find("input").length;
                                        $(this).find(".ratio").html("(" + num + "/" + num + ")");
                                    })
                                } else {
                                    ee.each(function (index, a) {
                                        var num = $(this).find(".citys").find("input").length;
                                        $(this).find(".ratio").html("");
                                    })
                                }
                            }
                        })
                    )
                )
            )
        ).append(
            function () {
                if (item.children) {
                    return GetSmallPlace(item.children)
                }
            }()
        )
    })
}
function GetSmallPlace(datas) {
    return $("<div/>", {
        "class": "smallplace clearfloat"
    }).append(
        datas.map(function (item) {
            return $("<div/>", {
                "class": "place-tooltips"
            }).append(
                $("<label/>", {
                    "text": item.name
                }).append(
                    $("<input/>", {
                        // "id":item.id,
                        "type": "checkbox",
                        "class": "bigcity",
                        "data-name": item.name,
                        "click": function () {
                            var small = $(this).parent().next(".citys").find("input");
                            var smalllength = small.length;
                            var ee = $(this).parents(".smallplace").find(".ratio");
                            if ($(this).prop("checked")) {
                                small.prop("checked", true);
                                $(this).parents(".place-tooltips").find(".ratio").html("(" + smalllength + "/" + smalllength + ")");
                                $(this).parents(".smallplace").prev().find(".bigarea").prop("checked", true);
                            } else {
                                small.prop("checked", false);
                                $(this).parents(".place-tooltips").find(".ratio").html("");
                                ClearArea($(this).parents(".smallplace"), $(this).parents(".smallplace").prev().find(".bigarea"));
                            };
                        }
                    })
                ).append(
                    function () {
                        if (item.children) {
                            return $("<span/>", {
                                "class": "ratio"
                            })
                        }
                    }
                )
            ).append(
                function () {
                    if (item.children) {
                        return $("<div/>", {
                            "class": "citys"
                        }).append(
                            $("<i/>", {
                                "class": "jt"
                            }).append($("<i/>", {}))
                        ).append(
                            GetSmallCitys(item.children)
                        )
                    }
                }

            )
        })
    )
}

function GetSmallCitys(datas) {
    return $("<div/>", {
        "class": "row-div clearfloat"
    }).append(
        datas.map(function (item) {
            return $("<p/>", {}).append(
                $("<label/>", {}).append(
                    $("<input/>", {
                        // "id":item.id,
                        "type": "checkbox",
                        "class": "city",
                        "click": function () {
                            var tf = $(this).parents(".citys").find("input:checked").length;
                            var alltf = $(this).parents(".citys").find("input").length;
                            if (tf > 0) {
                                $(this).parents(".place-tooltips").find(".bigcity").prop("checked", true);
                                $(this).parents(".place-tooltips").find(".ratio").html("(" + tf + "/" + alltf + ")");
                                $(this).parents(".smallplace").prev().find(".bigarea").prop("checked", true);
                            } else if (tf == 0) {
                                $(this).parents(".place-tooltips").find(".bigcity").prop("checked", false);
                                $(this).parents(".place-tooltips").find(".ratio").html("");
                                ClearArea($(this).parents(".smallplace"), $(this).parents(".smallplace").prev().find(".bigarea"));
                            }
                        }
                    })
                ).append(
                    $("<span/>", {
                        "text": item.name
                    })
                )
            )
        })
    )
}


//控制提示个数的显示
function ShowTipNum() {
    var n = $(".place-div").find(".place");
    n.each(function (index, a) {
        var m = $(this).find(".place-tooltips");
        m.each(function (index, a) {
            var u = $(this).find(".citys").find(".city").length;
            var uu = $(this).find(".citys").find(".city:checked").length;
            if (uu != 0) {
                $(this).find(".ratio").html("(" + uu + "/" + u + ")");
                $(this).find(".bigcity").prop("checked", true);
            } else {
                $(this).find(".ratio").html("");
            }

        })

    })
}
//省市区全部取消选择时华北东北等取消选择
function ClearArea(place, area) {//参数area为包含省级input的父级div
    var checked = place.find("input:checked").length;
    if (checked == 0) {
        area.prop("checked", false);
    }
}
//获取已选中的数据

function GetChecked() {
    var Checked = [];//先清空数组
    var n = $(".place-div").find(".place");
    n.each(function (index, a) {
        var m = $(this).find(".smallplace");
        m.each(function (index, a) {
            var p = $(this).find(".bigcity");
            p.each(function (index, a) {
                if ($(this).prop("checked")) {
                    if ($(this).parents(".place-tooltips").find(".citys").length == 0) {
                        //判断它没有下级地区的时候，将id放入数组
                        //console.log($(this).attr("id"));此时能获取到已选中的省市级id
                        Checked.push($(this).attr("data-name"));
                    }
                }
                var s = $(this).parents(".place-tooltips").find(".city");
                s.each(function (index, a) {
                    if ($(this).prop("checked")) {
                        Checked.push($(this).attr("data-name"));
                        //console.log($(this).attr("id"));//此时能获取到已选中的县区级id
                    }
                })
            })
        })
    })
    return Checked;
}

//根据从后台获取的已选中的id来显示
function SetChecked(param) {
    $.each(param, function (index, value) {
        $("#" + value).trigger("click");
    })
}

// 自定义JS
$(".test-div").on('mouseover', '.place', function () {
    // console.log($(this).children(".bigplace").find(".bigarea").attr("data-name"));
    $(this).addClass("place-active");
    $(this).children(".smallplace").show();
})
$(".test-div").on('mouseout', '.place', function () {
    $(this).removeClass("place-active");
    $(".smallplace").hide();
})


