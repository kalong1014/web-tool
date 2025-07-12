define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'video_rank/index' + location.search,
                    add_url: 'video_rank/add',
                    edit_url: 'video_rank/edit',
                    del_url: 'video_rank/del',
                    multi_url: 'video_rank/multi',
                    import_url: 'video_rank/import',
                    table: 'video_rank',
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
                        // {field: 'id', title: '排名id', operate:false},
                        {field: 'merge_keyword', title:'长尾词', operate: 'LIKE'},
                        {field: 'keyword_type', title: '长尾词类型', operate:false,formatter: function(value,row,index){
                            return "<span style='background:#dc8e0e;color:#fff;padding:3px 5px;border-radius: 3px;'>"+value+"</span>";
                        }},
                        {field: 'tuiguangvideo.title', title: '视频描述',operate:false,formatter: function(value,row,index){
                            return '<a   target="_blank" href="'+row.tuiguangtask.share_url+'"   data-original-title="查看视频">'+row.tuiguangtask.video_text+'</a>';
                        },width:300},
                        
                        {field: 'nickname', title:'发布人', operate: false},
                        {field: 'rank_num', title:'排名', sortable: true,operate: 'BETWEEN',formatter: function(value,row,index){
                            if(value > 0){
                                return "<span style='color:#69ef69;font-size:16px;'>第 " + value + " 位</span>";
                            }else{
                                return "<span >-</span>";
                            }
                            
                        }},
                        {field: 'price', title:'价格(天)', operate: false},
                        {field: 'paiming_day', title:'达标天数', operate: false},
                        {field: 'new_time', title: '最后达标时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false, sortable: true},
                        {field: 'uptime', title: '最后查询时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false, sortable: true},
                        {field: 'operate', title: __('Operate'),table: table, formatter: function(value,row,index){
                            return '<a  class="btn btn-xs btn-primary btn-delone" href="https://www.douyin.com/search/'+row.merge_keyword+'" target="_blank" >视频搜索</a>';
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