define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'agent_pay/index' + location.search,
                    del_url: 'agent_pay/del',
                    multi_url: 'agent_pay/multi',
                    import_url: 'agent_pay/import',
                    table: 'agent_pay',
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
                        {field: 'id', title: __('Id'),operate: false},
                        {field: 'agent_id', title: '代理id',operate: false},
                        {field: 'agent.agent_name', title: '代理名',operate: false},
                        {field: 'pagent.agent_name', title: '手动充值代理',operate: 'LIKE'},
                        {field: 'dianshu', title: '充值点数',operate: false},
                        {field: 'addtime', title: '充值时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'remark', title: '备注', operate: false},
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