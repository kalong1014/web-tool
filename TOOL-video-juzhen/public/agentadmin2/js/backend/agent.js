define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'agent/index' + location.search,
                    add_url: 'agent/add',
                    edit_url: 'agent/edit',
                    // del_url: 'agent/del',
                    multi_url: 'agent/multi',
                    import_url: 'agent/import',
                    table: 'agent_name',
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
                        {field: 'id', title: '代理id',operate:false},
                        {field: 'agent_name', title: "代理名称"},
                        {field: 'commission', title: '佣金余额',operate:false},
                        {field: 'dianshu', title: '剩余点数',operate:false},
                        {field: 'ip_count', title: '剩余共享ip',operate:false},
                        {field: 'rate', title: '分红比例(%)',operate:false},
                        {field: 'store_count', title: '可开商家数',operate:false},
                        {field: 'agent_store_count', title: '已开商家数',operate:false},
                        {field: 'username', title: '登录账号', operate: 'LIKE'},
                        {field: 'out_date', title: '过期时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'addtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate1', title: '商家', width:150,table: table, formatter: function(value,row,index){
                            return '<a target="_blank" href="/agentadmin/index?jump_url=store&menu_url=store&agent_id='+row.id+'" class="btn btn-success btn-edit" style="margin-left:5px;" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="1" data-original-title="商家">商家</a>';
                        }} , 
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
    var flag = window.confirm("将删除代理所有数据无法恢复，请确认要删除吗？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/agentadmin/agent/del?ids='+id,
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