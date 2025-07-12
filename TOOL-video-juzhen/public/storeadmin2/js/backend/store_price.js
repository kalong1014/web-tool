define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'store_price/index' + location.search,
                    del_url: 'store_price/del',
                    multi_url: 'store_price/multi',
                    import_url: 'store_price/import',
                    table: 'store_price',
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
                        {field: 'desc', title: '扣费项目',operate:'like'},
                        {field: 'price', title: '消费金额',operate:false},
                        {field: 'addtime', title: '扣费时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        // {field: 'pay_id', title: __('Pay_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'),formatter: function(value,row,index){
                            if(row.url){
                                return "<a style='color:orange;' target='_blank' href='"+row.url+"'>查看</a>";
                            }else{
                                return "<span>--</span>";
                            }
                        }}
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