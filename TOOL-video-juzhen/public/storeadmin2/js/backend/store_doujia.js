define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'store_doujia/index' + location.search,
                    add_url: 'store_doujia/add?mode='+$('#mode').val(),
                    edit_url: 'store_doujia/edit',    
                    del_url: 'store_doujia/del',
                    multi_url: 'store_doujia/multi',
                    import_url: 'store_doujia/import',
                    table: 'store_doujia',
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
                        {field: 'id', title: 'ID', operate: false},
                        {field: 'video_url', title: '视频',formatter: function(value,row,index){
                            return '<video src="'+value+'" style="width:150px;height:100px;" controls="controls">您的浏览器不支持 video 标签。</video>';
                        },operate:false},
                        {field: 'tuiguangtask.video_text', title: '视频描述', operate: false},
                        // {field: 'type', title: '类型', searchList: {"1":'微信名片',"2":'h5链接'},formatter: function(value,row,index){
                        //     if(row.type==1){
                        //         return "微信名片";
                        //     }else{
                        //         return "h5链接";
                        //     }
                        // }},
                        {field: 'price', title: '投放金额',operate:false},
    
                        {field: 'status', title: '投放状态', searchList: {"1":'正常',"0":'关闭'}, formatter: Table.api.formatter.status},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            $(document).on('focus','#select_video', function (event) {
                var url = '/storeadmin/tuiguang_task/index_select';
                var area = ['90%', '90%'];
                var options = {
                    shadeClose: false,
                    shade: [0.3, '#393D49'],
                    area: area,
                    callback:function(value){
            　　　　　　　//这个value就是传上来的值
                        $('#c-title').val(value[0]['video_text']);
                        $('#c-tuiguang_task_id').val(value[0]['id']);
                    }
                };
                Fast.api.open(url,'视频选择',options);
            });
            // $('#c-title').on('focus',function(event){
            //     area = ['90%', '90%']
            //     Fast.api.layer.open({
            //         type:2,
            //         title: '选择视频',
            //         area: area ,
            //         content:'/storeadmin/tuiguang_task/index_select',
            //         callback:function(value){
            // 　　　　　　　//这个value就是传上来的值
            //             alert(value);
            //         }
            //     });
            // });
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
            url:'/storeadmin/store_doujia/del?ids='+id,
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
