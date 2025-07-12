define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_comment/index' + location.search,
                    add_url: 'tuiguang_comment/add?mode=',
                    // edit_url: 'tuiguang_comment/edit',    
                    del_url: 'tuiguang_comment/del',
                    multi_url: 'tuiguang_comment/multi',
                    import_url: 'tuiguang_comment/import',
                    table: 'tuiguang_comment',
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
                        {field: 'tuiguangtask.title', title: '矩阵任务',formatter: function(value,row,index){
                            return "<a target='_blank' href='/storeadmin/index?jump_url=tuiguang_task&menu_url=tuiguang_task&id="+row.tuiguangtask.id+"'>"+row.tuiguangtask.title+"</a>";
                        }},
                        {field: 'tuiguangtask.video_text', title: '视频简介',formatter: function(value,row,index){
                            return "<a target='_blank' href='"+row.share_url+"'>"+value+"</a>";
                        }},
                        {field: 'nickname', title: '发布人',operate:false},
                        {field: 'content', title: '评论内容', operate: 'like'},
                        {field: 'create_time', title: '评论时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'digg_count', title: '点赞数',operate:'BETWEEN'},
                        {field: 'reply_comment_total', title: '评论数',operate:'BETWEEN'},
    
                        {field: 'status', title: __('Status'), searchList: {"1":'未回复',"2":'已回复',"3":'自动回复失败'},formatter: function(value,row,index){
                            if(value==1){
                                return "<span style='color:#999'>未回复</span>";
                            }else if(value==3){
                                return "<span style='color:red'>自动回复失败</span>";
                            }else{
                                return "<span style='color:orange'>已回复</span>";
                            }
                        }},
                        
                        {field: 'keyword', title: '命中词', operate: 'like'},
                        {field: 'reply_content', title: '回复', operate: 'like'},
       
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate,buttons: [
                            {
                                name: 'video',
                                text: __('回复'),
                                icon: 'fa fa-paper-plane',
                                classname: 'btn btn-xs btn-primary  btn-dialog',
                                url: 'tuiguang_comment/edit/ids/{ids}',
                                visible: function (row) {
                                     // 自定义按钮 动态是否显示
                                     if (row.status != 1 && row.status != 3) {
                                         return false;
                                     }
                                     return true;
                                 }
                            }], formatter: Table.api.formatter.operate}
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
    var flag = window.confirm("确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_comment/del?ids='+id,
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
