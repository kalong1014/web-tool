define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'qiye_user/index' + location.search,
                    add_url: 'qiye_user/add?mode='+$('#mode').val(),
                    // edit_url: 'qiye_user/edit',    
                    del_url: 'qiye_user/del',
                    multi_url: 'qiye_user/multi',
                    import_url: 'qiye_user/import',
                    table: 'qiye_user',
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
                        {field: 'id', title: 'ID'},
                        {field: 'store.store_name', title: '商户名'},
                        {field: 'nickname', title: '昵称'},
                        {field: 'head', title: '头像',operate:false,formatter : function (value, row, index) {
                            return "<img style='width: 50px;height: 50px;' src='"+value+"' alt=''>"
                        }},
                        {field: 'openid', title: 'openid',operate:false,width:300},
                        {field: 'status', title: '启用状态',custom: {success: 'success', failure: 'danger'},searchList: {1: '正常', 0: '关闭'},formatter: function (value, row, index) {
                            // $.toggle = Table.api.formatter.toggle;
                            return Table.api.formatter.toggle.call(this, value, row, index);
                        }},
                        {field: 'token_out_time', title: '授权到期',operate:false},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'), width:300,table: table, formatter: function(value,row,index){
                            return '<a  class="btn btn-xs btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="删除">删除</a>';
                        },width:200}
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
    var flag = window.confirm("确认是否删除？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/qiye_user/del?ids='+id,
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