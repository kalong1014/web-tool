define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'merge_keyword/index' + location.search,
                    add_url: 'merge_keyword/add?mode=',
                    // edit_url: 'merge_keyword/edit',    
                    del_url: 'merge_keyword/del',
                    multi_url: 'merge_keyword/multi',
                    import_url: 'merge_keyword/import',
                    table: 'merge_keyword',
                }
            });

            var table = $("#table");

             // 自定义导出按钮
            $(document).on("click", ".btn_group", function () {
                var page = $("#table").bootstrapTable('getSelections');; // 获取页面数据
                let ids = [];
                let id_data = '';
                // 取出当前页面的id
                $.each(page,function(i,v){
                    ids.push(v.id)
                    if(i == 0){
                        id_data = v.id;
                    }else{
                        id_data += ','+v.id;
                    }
                });

                if(id_data == ''){
                    alert('请选择操作的数据');return;
                }
                if($('.user_group').val() == ''){
                    alert('请选择分组');return;
                }

                layer.confirm("请选择要移动分组的数据", {
                    title: '移动分组',
                    btn: ['当前选中数据(' + ids.length + '条)','取消'],
                    yes: function (index, layero) {
                        // 全部数据
                        $.get("merge_keyword/change_group?id_data="+id_data+'&group_id='+$('.user_group').val(),'',function(data){
                            alert(data.msg);
                            Layer.close(index);
                            table.bootstrapTable('refresh', {});

                        },'json');
                    },
                    btn2: function (index, layero) {
                        // 当前页面数据
                        Layer.close(index);
                    }
                })
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
                        {field: 'merge_keyword', title: '长尾关键词', operate: 'like'},
                        {field: 'group.name', title: '分组', operate: 'like'},
                        {field: 'keyword_type', title: '类型', operate:false,formatter: function(value,row,index){
                            return "<span style='background:#dc8e0e;color:#fff;padding:3px 5px;border-radius: 3px;'>"+value+"</span>";
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

function delCheck(id)
{
    var flag = window.confirm("确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/merge_keyword/del?ids='+id,
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
