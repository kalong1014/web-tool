define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_task_auto/index' + location.search,
                    add_url: 'tuiguang_task_auto/add',
                    edit_url: 'tuiguang_task_auto/edit',    
                    del_url: 'tuiguang_task_auto/del',
                    multi_url: 'tuiguang_task_auto/multi',
                    import_url: 'tuiguang_task_auto/import',
                    table: 'tuiguang_task_auto',
                }
            });

            var table = $("#table");


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
                        {field: 'title', title: '任务名',operate:'like'},
                        {field: '', title: '发送方案',operate:false,formatter: function(value,row,index){
                            return '每隔<span style="font-size:18px;color:orange;font-weight:bold"> '+row.day_count+' </span>天，'+row.start_time+'点至'+row.end_time+'点，发送<span style="font-size:18px;color:#56dac0;font-weight:bold"> '+row.interval+' </span>条视频';
                        }, width:300},
                        {field: '', title: '今日已发送',operate:false,formatter: function(value,row,index){
                            return '<span style="font-size:18px;color:#56dac0;font-weight:bold"> '+row.sended+'</span>';
                        }, width:100},
                        {field: '', title: '当前等待发送',operate:false,formatter: function(value,row,index){
                            return '<span style="font-size:18px;color:#999;font-weight:bold"> '+row.no_send_today+'</span>';
                        }, width:100},
                        {field: '', title: '今日发送失败',operate:false,formatter: function(value,row,index){
                            return '<span style="font-size:18px;color:red;font-weight:bold">'+row.fail_send_today+'</span>';
                        }, width:100},
                        {field: '', title: '选中用户',operate:false,formatter: function(value,row,index){
                            return '<span style="font-size:18px;color:#56dac0;font-weight:bold">'+row.user_count+'</span>';
                        }, width:100},
                        {field: 'sended_all', title: '总发送成功',operate:false, width:100},
                        {field: 'status', title: '任务状态', searchList: {"1":'运行中',"2":'已完成',"3":'任务中断'},formatter: function(value,row,index){
                            if(row.status==2){
                                return "<span style='color:orange;    font-weight: bold;    font-size: 16px;' >已完成</span>";
                            }else if(row.status==1){
                                return "<span style='color:#fff'  title='正在持续发送中'>运行中</span>";
                            }else if(row.status==3){
                                return "<span style='color:red' title='运行停止:"+row.error_text+"'>运行停止:"+row.error_text+"</span>";
                            }else{
                                return "<span style='color:red;'>失败</span>";
                            }
                        }},
                        {field: 'next_date', title: '预计下次发布', operate:false, formatter:Table.api.formatter.datetime, autocomplete:false},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
                    index_url: 'tuiguang_task_auto/index_select' + location.search,
                    add_url: 'tuiguang_task_auto/add?mode='+$('#mode').val(),
                    edit_url: 'tuiguang_task_auto/edit',    
                    del_url: 'tuiguang_task_auto/del',
                    multi_url: 'tuiguang_task_auto/multi',
                    import_url: 'tuiguang_task_auto/import',
                    table: 'tuiguang_task_auto',
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
                        {field: 'operate', title: __('Operate'),table: table , formatter: select_formatter}
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
    var flag = window.confirm("会同步删除抖音的视频，导致视频数据丢失,确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_task_auto/del?ids='+id,
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
