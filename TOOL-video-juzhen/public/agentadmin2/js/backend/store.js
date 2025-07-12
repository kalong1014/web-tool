define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'store/index' + location.search,
                    add_url: 'store/add',
                    edit_url: 'store/edit',
                    // del_url: 'store/del',
                    multi_url: 'store/multi',
                    import_url: 'store/import',
                    table: 'store',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: '商户id',operate:false},
                        {field: 'store_name', title: '商户名', operate: 'LIKE'},
                        {field: 'agent.agent_name', title: "所属代理", operate: 'LIKE'},
                        {field: 'price', title: "点数",operate:false},
                        {field: 'ip_count', title: '剩余共享ip',operate:false},
                        {field: 'username', title: '登录账号', operate: 'LIKE'},
                        // {field: 'status', title: __('Status')},
                        {field: 'out_date', title: '到期时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'addtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'addtime', title: '访问权限', table: table, events: Table.api.events.operate, formatter: function(value,row,index){
                            return '<a href="store/open/id/'+row.id+'" class="btn btn-xs btn-success btn-editone" data-toggle="tooltip" title="进入商户" target="_blank" data-table-id="table" data-field-index="13" data-row-index="0" data-button-index="1">进入商户</a> ';
                            
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
    var flag = window.confirm("将删除商户所有数据无法恢复，请确认要删除吗？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/agentadmin/store/del?ids='+id,
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