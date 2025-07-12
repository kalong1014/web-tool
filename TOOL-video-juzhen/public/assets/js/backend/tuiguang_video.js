define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_video/index' + location.search,
                    add_url: 'tuiguang_video/add?mode='+$('#mode').val(),
                    edit_url: 'tuiguang_video/edit',    
                    del_url: 'tuiguang_video/del',
                    multi_url: 'tuiguang_video/multi',
                    import_url: 'tuiguang_video/import',
                    table: 'tuiguang_video',
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
                        {field: 'store.store_name', title: '商户名'},
                        {field: 'title', title: '视频名'},
                        // {field: 'head_url', title: '视频封面',operate:false},
                        {field: 'video_url', title: '视频',formatter: function(value,row,index){
                            return '<video src="'+value+'" style="width:150px;height:100px;" controls="controls">您的浏览器不支持 video 标签。</video>';
                        },operate:false},
                        {field: 'type', title: '类型',searchList: {"1":'普通视频',"2":'混剪视频'},formatter: function(value,row,index){
                            if(row.type==1){
                                return "<span style='color:888;  '>普通视频</span>";
                            }else if(row.type==2){
                                return "<span >混剪视频</span>";
                            }
                        }},
                        {field: 'use_count', title: '使用次数',sortable: true,operate:'BETWEEN'},
                        {field: 'addtime', title: '生成时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'),table: table, formatter: function(value,row,index){
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
    var flag = window.confirm("确认是否删除视频？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_video/del?ids='+id,
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