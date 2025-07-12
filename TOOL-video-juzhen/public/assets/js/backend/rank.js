define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'rank/index' + location.search,
                    add_url: 'rank/add?mode='+$('#mode').val(),
                    edit_url: 'rank/edit',    
                    del_url: 'rank/del',
                    multi_url: 'rank/multi',
                    import_url: 'rank/import',
                    table: 'rank',
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
                        {field: 'id', title: '任务id',operate:false},
                        {field: 'store.store_name', title: '商户名'},
                        {field: 'title', title: '任务名'},
                        {field: 'url', title: "查询源", operate: 'LIKE'},
                        {field: 'keywords', title: "关键词"},
                        {field: 'status', title: '任务状态',searchList: {1: '查询中', 2: '已完成', 3: '已暂停'},formatter: function(value,row,index){
                            if(row.status==1){
                                return "<span style='color:#f39c12;     font-size: 16px;'>查询中</span>";
                            }else if(row.status==2){
                                return "<span style='color:#ccc'>已完成</span>";
                            }else if(row.status==3){
                                return "<span style='color:red'>已暂停</span>";
                            }
                        }},
                        {field: 'addtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'), width:300,table: table, formatter: function(value,row,index){
                            return '<a  class="btn btn-xs btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="删除">删除</a>';
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

function delCheck(id)
{
    var flag = window.confirm("消耗金额不退回，确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/rank/del?ids='+id,
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