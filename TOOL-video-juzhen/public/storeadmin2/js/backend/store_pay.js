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
                searchFormVisible:true,
                search:false,
                showExport: true,
                columns: [
                    [
                        // {checkbox: true},
                        {field: 'type', title: '类型', searchList: {"1":'项目退款',"0":'充值'},formatter: function(value,row,index){
                            if(row.type==1){
                                return "<span style='color:#999'>项目退款</span>";
                            }else{
                                return "<span style='color:orange'>充值</span>";
                            }
                        }},
                        {field: 'dianshu', title: '充值点数'},
                        {field: 'addtime', title: __('Addtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'remark', title: '备注',formatter: function(value,row,index){
                            if(row.type==1){
                                return value;
                            }else{
                                return "---";
                            }
                        }},
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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