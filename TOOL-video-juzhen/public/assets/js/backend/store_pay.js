define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'store_pay/index' + location.search,
                    del_url: 'store_pay/del',
                    multi_url: 'store_pay/multi',
                    import_url: 'store_pay/import',
                    table: 'store_pay',
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
                        {field: 'store_id', title: __('Store_id'),operate: false},
                        {field: 'store.store_name', title: __('Store.store_name'), operate: 'LIKE'},
                        {field: 'agent.agent_name', title: '手动充值代理',operate: 'LIKE'},
                        {field: 'price', title: '充值金额',operate: false},
                        {field: 'dianshu', title: '充值点数',operate: false},
                        {field: 'addtime', title: '充值时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'pay_id', title: '支付订单号', operate: false},
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