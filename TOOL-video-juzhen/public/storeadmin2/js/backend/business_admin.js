define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'business_admin/index' + location.search,
                    add_url: 'business_admin/add?mode=',
                    // edit_url: 'business_admin/edit',    
                    del_url: 'business_admin/del',
                    multi_url: 'business_admin/multi',
                    import_url: 'business_admin/import',
                    table: 'business_admin',
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
                        {field: 'nickname', title: '抖音昵称',operate:'like'},
                        {field: 'head', title: '头像',operate:false,formatter : function (value, row, index) {
                            return "<img style='width: 50px;height: 50px;border-radius:50%;' src='"+value+"' alt=''>"
                        }},
                        {field: 'status', title: '启用状态',custom: {success: 'success', failure: 'danger'},searchList: {1: '正常', 0: '关闭'},formatter: function (value, row, index) {
                            // $.toggle = Table.api.formatter.toggle;
                            return Table.api.formatter.toggle.call(this, value, row, index);
                        }},
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
            url:'/storeadmin/business_admin/del?ids='+id,
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