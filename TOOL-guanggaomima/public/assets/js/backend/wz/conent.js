define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'wz/conent/index' + location.search,
                    add_url: 'wz/conent/add',
                    edit_url: 'wz/conent/edit',
                    del_url: 'wz/conent/del',
                    multi_url: 'wz/conent/multi',
                    import_url: 'wz/conent/import',
                    table: 'wz_conent',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'title', title: __('Title'), operate: 'LIKE'},

                        {field: 'wz_url', title: '文章地址', operate: 'LIKE', formatter: Table.api.formatter.url},
                        {field: 'pwd', title: __('Pwd')},
                        {field: 'sort', title: __('Sort')},
                        {field: 'addtime', title: '创建时间', operate: 'LIKE'},
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
