define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_video_group/index' + location.search,
                    add_url: 'tuiguang_video_group/add?mode=',
                    edit_url: 'tuiguang_video_group/edit',    
                    del_url: 'tuiguang_video_group/del',
                    multi_url: 'tuiguang_video_group/multi',
                    import_url: 'tuiguang_video_group/import',
                    table: 'tuiguang_video_group',
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
                        {field: 'name', title: '分组名'},
                        {field: 'video_count', title: '绑定视频数', operate: false},
                        {field: 'addtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'view', title: '查看',table: table, formatter: function(value,row,index){
                            if(row.video_count > 0){
                                return '<a href="/storeadmin/index?jump_url=tuiguang_video&menu_url=tuiguang_video&group_ids='+row.id+'" class="btn btn-xs btn-success" target="_blank" title="查看列表" > 查看列表</a>';
                            }
                        }},
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
    var flag = window.confirm("确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_video_group/del?ids='+id,
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
