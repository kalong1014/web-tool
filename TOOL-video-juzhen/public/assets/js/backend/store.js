define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'store/index' + location.search,
                    add_url: 'store/add',
                    edit_url: 'store/edit',
                    del_url: 'store/del',
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
                        {field: 'id', title: __('Id')},
                        {field: 'store_name', title: __('Store_name'), operate: 'LIKE'},
                        {field: 'agent_id', title: "代理id"},
                        {field: 'agent.agent_name', title: "所属代理"},
                        {field: 'price', title: "点数"},
                        {field: 'send_sort', title: "发布优先级", sortable: true},
                        {field: 'is_realname', title: '实名',searchList: {"0":'未实名',"1":'已实名'},formatter: function(value,row,index){
                            if(row.is_realname==1){
                                return "<span style='color:green;'>已实名</span>";
                            }{
                                return "<span style='color:#ccc'>未实名</span>";
                            }
                        }},
                        {field: 'username', title: __('Username'), operate: 'LIKE'},
                        // {field: 'status', title: __('Status')},
                        {field: 'out_date', title: __('Out_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'addtime', title: __('Addtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
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