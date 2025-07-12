define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'activity_user/index' + location.search,
                    add_url: 'activity_user/add?mode=',
                    // edit_url: 'activity_user/edit',    
                    del_url: 'activity_user/del',
                    multi_url: 'activity_user/multi',
                    import_url: 'activity_user/import',
                    table: 'activity_user',
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
                        {field: 'id', title: 'ID',operate:false},
                        {field: 'activity.activity_name', title: '活动名',operate:'like'},
                        {field: 'share_url', title: '视频链接',operate:false,formatter: function(value,row,index){
                            if(row.share_url!='' && row.share_url!=null && row.share_url!="null"){
                                return '<a   target="_blank" href="'+row.share_url+'"   data-original-title="查看视频">'+row.share_url+'</a>';
                            }else{
                                return '--';
                            }
                        }},
                        {field: 'view_count', title: '播 / 赞 / 评',operate:false, sortable: true,width:120,formatter: function(value,row,index){
                            return row.view_count+' / '+row.like_count+' / '+row.comment_count;
                        }},
                        {field: 'phone', title: '用户手机号'},

                        {field: 'status', title: '任务状态', searchList: {"1":'未发送',"2":'已发送',"3":'发送失败',"4":'视频删除',"5":'暂停'},formatter: function(value,row,index){
                            if(row.status==2){
                                return "<span style='color:green;    font-weight: bold;    font-size: 16px;'>已发送</span>";
                            }else if(row.status==1){
                                return "<span style='color:#666'>未发送 / 临时调用</span>";
                            }else if(row.status==5){
                                return "<span style='color:red' title='有可能是余额不足或者视频发布上限'>暂停</span>";
                            }else if(row.status==4){
                                return "<span style='color:#ff6767' title='视频删除'>视频删除</span>";
                            }else{
                                return "<span style='color:red;' title='"+row.error_text+"'>失败:"+row.error_text+"</span>";
                            }
                        }},
                        {field: 'send_time', title: '发布时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'addtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}

                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
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
        }
    };
    return Controller;

    

});

function delCheck(id)
{
    var flag = window.confirm("消耗金额不退回，确认是否删除活动？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/activity_user/del?ids='+id,
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