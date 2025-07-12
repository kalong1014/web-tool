define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_user_group/index' + location.search,
                    add_url: 'tuiguang_user_group/add?mode=',
                    edit_url: 'tuiguang_user_group/edit',    
                    del_url: 'tuiguang_user_group/del',
                    multi_url: 'tuiguang_user_group/multi',
                    import_url: 'tuiguang_user_group/import',
                    table: 'tuiguang_user_group',
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
                        {field: 'user_count', title: '绑定账号数', operate: false},
                        {field: 'poi_name', title: 'POI地址',operate:false},
                        {field: 'addtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'view', title: '查看',table: table, formatter: function(value,row,index){
                            if(row.user_count > 0){
                                return '<a href="/storeadmin/index?jump_url=tuiguang_user&menu_url=tuiguang_user&group_ids='+row.id+'" class="btn btn-xs btn-success" target="_blank" title="查看列表" > 查看列表</a>';
                            }
                        }},
                        {field: 'poi', title: '绑定poi',table: table, formatter: function(value,row,index){
                            return  '<a  class="btn btn-xs btn-primary btn-delone" onclick="poi('+row.id+',\''+row.poi_address+'\',\''+row.poi_name+'\')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;background:#24ab7d"  data-original-title="绑定poi地址">绑定POI</a>';
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
            url:'/storeadmin/tuiguang_user_group/del?ids='+id,
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
