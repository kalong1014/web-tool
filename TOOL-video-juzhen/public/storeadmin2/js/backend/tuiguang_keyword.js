define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_keyword/index' + location.search,
                    add_url: 'tuiguang_keyword/add?mode=',
                    edit_url: 'tuiguang_keyword/edit',    
                    del_url: 'tuiguang_keyword/del',
                    multi_url: 'tuiguang_keyword/multi',
                    import_url: 'tuiguang_keyword/import',
                    table: 'tuiguang_keyword',
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
                        {field: 'mode', title: '类型', searchList: {"1":'评论回复',"2":'私信回复'},formatter: function(value,row,index){
                            if(value==1){
                                return "<span style='color:#fff'>评论回复</span>";
                            }else{
                                return "<span style='color:orange'>私信回复</span>";
                            }
                        }},
                        {field: 'keyword', title: '命中关键词'},
                        {field: 'reply', title: '回复话术', operate: false},
                        {field: 'type', title: '匹配类型', searchList: {"1":'匹配关键词',"2":'默认回复'},formatter: function(value,row,index){
                            if(value==1){
                                return "<span style='color:#999'>匹配关键词</span>";
                            }else{
                                return "<span style='color:orange'>默认回复</span>";
                            }
                        }},
                        {field: 'addtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
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
    var flag = window.confirm("确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_keyword/del?ids='+id,
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
