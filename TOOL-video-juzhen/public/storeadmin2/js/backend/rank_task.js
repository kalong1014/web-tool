define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'rank_task/index' + location.search,
                    add_url: 'rank_task/add',
                    edit_url: 'rank_task/edit',
                    del_url: 'rank_task/del',
                    multi_url: 'rank_task/multi',
                    import_url: 'rank_task/import',
                    table: 'rank_task',
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
                        {field: 'rank_id', title: '任务id'},
                        {field: 'rank.title', title:'任务名', operate: 'LIKE'},
                        {field: 'douyin_url', title:'查询源', operate: 'LIKE'},
                        {field: 'nickname', title:'昵称', operate: 'LIKE'},
                        {field: 'keyword', title:'长尾词', operate: 'LIKE'},
                        {field: 'rank_num', title:'排名', sortable: true,operate: 'BETWEEN',formatter: function(value,row,index){
                            if(value > 0){
                                return "<span style='color:#69ef69;font-size:16px;'>第 " + value + " 位</span>";
                            }else{
                                return "<span >--</span>";
                            }
                            
                        }},
                        {field: 'status', title: '任务状态', searchList: {"1":'查询中',"2":'已完成',"3":'已暂停'},formatter: function(value,row,index){
                            if(row.status==1){
                                return "<span style='color:#f39c12;      font-size: 16px;'>查询中</span>";
                            }else if(row.status==2){
                                return "<span style='color:#ccc'>已完成</span>";
                            }else if(row.status==3){
                                return "<span style='color:red'>已暂停</span>";
                            }
                        }},

                        

                        // {field: 'type_id', title: '任务状态', searchList: {"1":'视频排名',"2":'账号排名'},formatter: function(value,row,index){
                        //     if(row.status==1){
                        //         return "<span >视频排名</span>";
                        //     }else if(row.status==2){
                        //         return "<span >账号排名</span>";
                        //     }
                        // }},
                        {field: 'uptime', title: '最后查询时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
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