define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'commission/index' + location.search,
                    del_url: 'commission/del',
                    multi_url: 'commission/multi',
                    import_url: 'commission/import',
                    table: 'commission',
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
                        // {field: 'agent.agent_name', title:'代理名'},
                        {field: 'commission', title: '佣金', operate:'BETWEEN'},
                        {field: 'storepay.price', title: "充值金额", operate:'BETWEEN'},
                        {field: 'rate', title:'佣金比例(%)'},
                        {field: 'addtime', title: '分佣时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
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