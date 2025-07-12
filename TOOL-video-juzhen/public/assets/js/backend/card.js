define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'card/index' + location.search,
                    add_url: 'card/add?mode='+$('#mode').val(),
                    edit_url: 'card/edit',    
                    del_url: 'card/del',
                    multi_url: 'card/multi',
                    import_url: 'card/import',
                    table: 'card',
                }
            });

            var table = $("#table");

            //改为类型一
            $(document).on("click", ".btn-type1", function () {
                var data = table.bootstrapTable('getSelections');
                var ids = [];
                if (data.length === 0) {
                    Toastr.error("请选择操作信息");
                    return;
                }
                for (var i = 0; i < data.length; i++) {
                    ids[i] = data[i]['id']
                }

                Layer.confirm(
                    '确认选中的' + ids.length + '条批量更新吗?', {
                        icon: 3,
                        title: __('Warning'),
                        offset: '40%',
                        shadeClose: true
                    },
                    function (index) {
                        Layer.close(index);
                        Backend.api.ajax({
                            //url: "lgwy/attrchg/approve?ids=" + JSON.stringify(ids),
                            //方法一：传参方式，后台需要转换变成数组
                            url: "card/update_data?ids=" + (ids),
                            data: {}
                            //方法二：传参方式，直接是数组传递给后台
                            // url: "card/update_data",
                            // data: {
                            //     ids: ids
                            // }
                        }, function (data, ret) { //成功的回调
                            if (ret.code === 1) {

                                table.bootstrapTable('refresh');
                                Layer.close(index);
                            } else {
                                Layer.close(index);
                                Toastr.error(ret.msg);
                            }
                        }, function (data, ret) { //失败的回调
                            console.log(ret);
                            // Toastr.error(ret.msg);
                            Layer.close(index);
                        });
                    }
                );
            });

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
                        {field: 'store.store_name', title: '商户名'},
                        {field: 'title', title: '卡片名'},
                        {field: 'type', title: '类型', searchList: {"1":'微信名片',"2":'h5链接'},formatter: function(value,row,index){
                            if(row.type==1){
                                return "微信名片";
                            }else{
                                return "h5链接";
                            }
                        }},
                        {field: 'h5_url', title: 'h5链接', operate: false},
                        // {field: 'name', title: '姓名/昵称', operate: false},
                        {field: 'head_url', title: '名片', operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},

                        {field: 'use_count', title: '剩余次数',operate:false},
                        {field: 'url', title: '链接',operate:false,width:300},
    
                        {field: 'status', title: __('Status'), searchList: {"1":'正常',"0":'关闭'}, formatter: Table.api.formatter.status},
                        {field: 'out_date', title: '到期时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        // {field: 'operate', title: __('Operate'), width:300,table: table, formatter: function(value,row,index){
                        //     return '<a  class="btn  btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="删除">删除</a>';
                        // },width:120}
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
            url:'/storeadmin/card/del?ids='+id,
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
