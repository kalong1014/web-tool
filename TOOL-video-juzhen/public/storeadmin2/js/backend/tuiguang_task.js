define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_task/index' + location.search,
                    add_url: 'tuiguang_task/add?mode='+$('#mode').val(),
                    edit_url: 'tuiguang_task/edit',    
                    del_url: 'tuiguang_task/del',
                    multi_url: 'tuiguang_task/multi',
                    import_url: 'tuiguang_task/import',
                    table: 'tuiguang_task',
                }
            });

            var table = $("#table");

            //改为类型一
            $(document).on("click", ".btn-type1", function () {
                var data = table.bootstrapTable('getSelections');
                var ids = [];
                if (data.length === 0) {
                    Toastr.error("请选择操作信息");
                    return;
                }
                for (var i = 0; i < data.length; i++) {
                    ids[i] = data[i]['id']
                }

                Layer.confirm(
                    '确认选中的' + ids.length + '条批量更新吗?', {
                        icon: 3,
                        title: __('Warning'),
                        offset: '40%',
                        shadeClose: true
                    },
                    function (index) {
                        Layer.close(index);
                        Backend.api.ajax({
                            //url: "lgwy/attrchg/approve?ids=" + JSON.stringify(ids),
                            //方法一：传参方式，后台需要转换变成数组
                            url: "tuiguang_task/update_data?ids=" + (ids),
                            data: {}
                            //方法二：传参方式，直接是数组传递给后台
                            // url: "tuiguang_task/update_data",
                            // data: {
                            //     ids: ids
                            // }
                        }, function (data, ret) { //成功的回调
                            if (ret.code === 1) {

                                table.bootstrapTable('refresh');
                                Layer.close(index);
                            } else {
                                Layer.close(index);
                                Toastr.error(ret.msg);
                            }
                        }, function (data, ret) { //失败的回调
                            console.log(ret);
                            // Toastr.error(ret.msg);
                            Layer.close(index);
                        });
                    }
                );
            });

            //改为类型一
            $(document).on("click", ".btn-type3", function () {
                var data = table.bootstrapTable('getSelections');
                var ids = [];
                if (data.length === 0) {
                    Toastr.error("请选择操作信息");
                    return;
                }
                for (var i = 0; i < data.length; i++) {
                    ids[i] = data[i]['id']
                }

                Layer.confirm(
                    '确认选中的' + ids.length + '条批量重新发送吗?', {
                        icon: 3,
                        title: __('Warning'),
                        offset: '40%',
                        shadeClose: true
                    },
                    function (index) {
                        Layer.close(index);
                        Backend.api.ajax({
                            //url: "lgwy/attrchg/approve?ids=" + JSON.stringify(ids),
                            //方法一：传参方式，后台需要转换变成数组
                            url: "tuiguang_task/update_send?ids=" + (ids),
                            data: {}
                            //方法二：传参方式，直接是数组传递给后台
                            // url: "tuiguang_task/update_data",
                            // data: {
                            //     ids: ids
                            // }
                        }, function (data, ret) { //成功的回调
                            if (ret.code === 1) {

                                table.bootstrapTable('refresh');
                                Layer.close(index);
                            } else {
                                Layer.close(index);
                                Toastr.error(ret.msg);
                            }
                        }, function (data, ret) { //失败的回调
                            console.log(ret);
                            // Toastr.error(ret.msg);
                            Layer.close(index);
                        });
                    }
                );
            });

            $(document).on("click", ".btn-type2", function () {

                layer.open({
                    type: 1, //1:自定义内容 2:iframe
                    title: '发布矩阵平台规则', //不显示标题
                    closeBtn: 1, //不显示关闭按钮
                    shadeClose: true, //点击外部遮罩自动关闭提示框
                    skin: 'yourclass', //弹出框样式
                    area: ['800px', '600px'],
                    content: '<div style="padding:0px 20px;color:#333;line-height:25px;font-size:14px;">\
                                <h1 style="color:#000;font-size:18px;font-weight:bold">抖音规则</h1>\
                                <p>1、视频文件大小不超过128M，时长在15分钟以内。<p>\
                                <p>2、带品牌logo或品牌水印的视频，会命中抖音的审核逻辑，有比较大的概率导致分享视频推荐降权处理/分享视频下架处理/分享账号被封禁处理。强烈建议第三方应用自行处理好分享内容中的不合规水印。<p>\
                                <p>3、视频过短或视频内容低俗，会导致分享视频推荐降权处理/分享视频下架处理/分享账号被封禁处理。<p>\
                                \
                                <h1 style="color:#000;font-size:18px;font-weight:bold">西瓜规则</h1>\
                                <p>1、视频文件大小不超过128M，时长在1分钟以内。<p>\
                                <p>2、标题+话题不超过30个中英文字符。<p>\
                                <p>3、带品牌logo或品牌水印的视频，会命中抖音的审核逻辑，有比较大的概率导致分享视频推荐降权处理/分享视频下架处理/分享账号被封禁处理。强烈建议第三方应用自行处理好分享内容中的不合规水印。<p>\
                                \
                                <h1 style="color:#000;font-size:18px;font-weight:bold">头条规则</h1>\
                                <p>1、视频文件大小不超过128M，时长在1分钟以内。<p>\
                                <p>2、标题+话题不超过30个中英文字符。<p>\
                                <p>3、带品牌logo或品牌水印的视频，会命中抖音的审核逻辑，有比较大的概率导致分享视频推荐降权处理/分享视频下架处理/分享账号被封禁处理。强烈建议第三方应用自行处理好分享内容中的不合规水印。<p>\
                                \
                                <h1 style="color:#000;font-size:18px;font-weight:bold">快手规则</h1>\
                                <p>1、视频文件大小不超过10M。<p>\
                                <p>2、标题+话题不超过30个中英文字符。<p>\
                                <p>3、带品牌logo或品牌水印的视频，会命中抖音的审核逻辑，有比较大的概率导致分享视频推荐降权处理/分享视频下架处理/分享账号被封禁处理。强烈建议第三方应用自行处理好分享内容中的不合规水印。<p>\
                                \
                                <h1 style="color:#000;font-size:18px;font-weight:bold">哔哩哔哩规则</h1>\
                                <p>1、视频封面会影响B站推广效果，请上传清晰的封面图。<p>\
                                <p>2、标题+话题不超过80个中英文字符。<p>\
                                <p>3、发送的视频为原创类型，请勿转载他人视频，转载他人视频多次审核不通过平台会封停账号，B站要求视频比例为横屏。<p>\
                            </div>'
                });
            });

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                searchFormVisible:true,
                search:false,
                showExport: true,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: 'ID',visible:false},
                        {field: 'title', title: '任务名',width:100},
                        {field: 'tuiguangvideo.title', title: '视频名',operate:false,formatter: function(value,row,index){
                            if(row.share_url!='' && row.share_url!=null){
                                return '<a   target="_blank" href="'+row.share_url+'"   data-original-title="查看视频">'+row.tuiguangvideo.title+'</a>';
                            }else{
                                return '<a   target="_blank" href="'+row.tuiguangvideo.video_url+'"   data-original-title="查看视频">'+row.tuiguangvideo.title+'</a>';
                            }
                        }},
                        {field: 'share_url', title: '视频链接',operate:false,formatter: function(value,row,index){
                            if(row.share_url!='' && row.share_url!=null && row.share_url!="null"){
                                return '<a   target="_blank" href="'+row.share_url+'"   data-original-title="查看视频">'+row.share_url+'</a>';
                            }else{
                                return '--';
                            }
                        }},
                        {field: 'tuiguanguser.type', title: '类型', searchList: {"1":'抖音','4':'快手','5':'哔哩哔哩','6':'视频号','7':'小红书','8':'抖音开放'},formatter: function(value,row,index){
                            if(row.tuiguanguser.type==2){
                                return "<span style='font-size:18px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>X瓜账号</span>";
                            }else if(row.tuiguanguser.type==3){
                                return "<span style='font-size:18px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>T条账号</span>";
                            }else if(row.tuiguanguser.type==4){
                                return "<span style='font-size:18px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>K手账号</span>";
                            }else if(row.tuiguanguser.type==5){
                                return "<span style='font-size:18px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>哔哩哔哩</span>";
                            }else if(row.tuiguanguser.type==6){
                                return "<span style='font-size:18px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>视频号</span>";
                            }else if(row.tuiguanguser.type==7){
                                return "<span style='font-size:18px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>小红书</span>";
                            }else if(row.tuiguanguser.type==8){
                                return "<span style='font-size:18px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>D音开放</span>";
                            }else{
                                return "<span style='font-size:18px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>D音账号</span>";
                            }
                        },width:120},
                        {field: 'group.name', title: '账号分组',width:80},
                        {field: 'tuiguanguser.nickname', title: '发送人',width:120},
                        {field: 'view_count', title: '播 / 赞 / 评 / 享',operate:false, sortable: true,width:120,formatter: function(value,row,index){
                            return row.view_count+' / '+row.like_count+' / '+row.comment_count+' / '+row.total_share;
                        }},

                        {field: 'status', title: '任务状态', searchList: {"1":'未发送',"2":'已发送',"3":'发送失败',"4":'视频删除',"5":'暂停',"6":'待确定'},formatter: function(value,row,index){
                            if(row.status==2){
                                return "<span style='color:green;    font-weight: bold;    font-size: 16px;'>已发送</span>";
                            }else if(row.status==1){
                                return "<span style='color:#666'>未发送</span>";
                            }else if(row.status==5){
                                return "<span style='color:red' title='有可能是余额不足或者视频发布上限'>暂停</span>";
                            }else if(row.status==6){
                                return "<span style='color:orange' title='待确定是否发送'>待确定是否发送</span>";
                            }else if(row.status==4){
                                return "<span style='color:#ff6767' title='视频删除'>视频删除</span>";
                            }else{
                                return "<span style='color:red;' title='"+row.error_text+"'>失败:"+row.error_text+"</span>";
                            }
                        },width:100},
                        {field: 'send_time', title: '预计发布时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false,width:135},
                        {field: 'data_update', title: '数据更新', operate:'RANGE', addclass:'datetimerange', autocomplete:false,width:135},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false,width:135},
                        {field: 'operate', title: __('Operate'), width:160,table: table, formatter: function(value,row,index){
                            html = '';
                            if(row.tuiguanguser.type==1){
                                html += '<a  class="btn btn-xs btn-primary btn-delone" onclick="update_video_url('+row.id+',\''+row.share_url+'\')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="修改视频链接">修改链接</a>';
                            }
                            html += '<a  class="btn btn-xs btn-danger btn-dialog" href="/storeadmin/tuiguang_task/edit/ids/'+row.id+'"  title="编辑" style="margin-left:5px;margin-right:5px;background:#32bb37"  data-original-title="编辑">查看</a>';
                            if(row.tuiguanguser.type==8){
                                html +=  '<a  class="btn btn-xs btn-success btn-delone" target="_blank" href="/storeadmin/index?jump_url=tuiguang_comment&menu_url=tuiguang_comment&tuiguang_task_id='+row.id+'"   data-original-title="查看评论">查看评论</a>';
                            }
                            html +=  '<a  class="btn btn-xs  btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="删除">删除</a>';
                            return html;
                        },width:200}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        index_select: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_task/index_select' + location.search,
                    add_url: 'tuiguang_task/add?mode='+$('#mode').val(),
                    edit_url: 'tuiguang_task/edit',    
                    del_url: 'tuiguang_task/del',
                    multi_url: 'tuiguang_task/multi',
                    import_url: 'tuiguang_task/import',
                    table: 'tuiguang_task',
                }
            });

            var table = $("#table");

            
            
            function select_formatter(){
                return [
                    '<button type="button" class="btn btn-xs btn-primary btn-select">选择</button>'
                ].join("");
            }


            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                searchFormVisible:false,
                search:false,
                showExport: false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'title', title: '任务名'},
                        {field: 'tuiguangvideo.title', title: '视频名',operate:false,formatter: function(value,row,index){
                            if(row.share_url!='' && row.share_url!=null){
                                return '<a   target="_blank" href="'+row.share_url+'"   data-original-title="查看视频">'+row.video_text+'</a>';
                            }else{
                                return '<a   target="_blank" href="'+row.tuiguangvideo.video_url+'"   data-original-title="查看视频">'+row.video_text+'</a>';
                            }
                        }},
                        {field: 'tuiguanguser.nickname', title: '发送人'},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'),table: table, formatter: function(value,row,index){
                            html = '';
                            html += '<a  class="btn btn-xs btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="删除">删除</a>';
                            return html;
                        }}
                    ]
                ]
            });

            // 为表格绑定事件
            // Table.api.bindevent(table);

            $(document).on('click', '#table .btn-select', function () {
                var ids = Table.api.selecteddata(table);   //获取选中的id，获取到的是个数组
                console.log(ids);
                Fast.api.close(ids);//这里是重点，将这个ids 传至父页面
            });

        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        },



    };
    return Controller;

    

});

function delCheck(id)
{
    var flag = window.confirm("不会同步删除APP的任务，确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_task/del?ids='+id,
            success:function(data){
                window.location.reload();//自动刷新
            },
            error:function(){
                alert("删除失败！");
            }
        });
    }else{ 
        return false;
    }
}

function update_video_url(id,share_url)
{
    $('.qrcode-popul').show();
    $('.video_url_input').val(id);
    $('.video_url').val(share_url);
}

$('.verify_btn').click(function(){
    $.ajax({
        type:"POST",
        dataType:"json",
        url:'/storeadmin/tuiguang_task/update_video_url?ids='+$('.video_url_input').val()+'&video_url='+$('.video_url').val(),
        success:function(data){
            alert(data.msg);            
            if(data.code!=0){
                $('.qrcode-popul').hide();
                location.reload();
            }else{
                
            }            
        },
        error:function(){
            alert("修改失败！");
        }
    });
});
