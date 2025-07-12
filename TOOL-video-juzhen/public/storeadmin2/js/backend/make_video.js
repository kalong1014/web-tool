define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'make_video/index' + location.search,
                    add_url: 'make_video/add?type='+$('.make_type').val(),
                    edit_url: 'make_video/edit',    
                    del_url: 'make_video/del',
                    multi_url: 'make_video/multi',
                    import_url: 'make_video/import',
                    table: 'make_video',
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
                        // {checkbox: true},
                        {field: 'title', title: '视频名'},
                        {field: 'video_count', title: '预计剪辑数',operate:false},
                        {field: 'video_count_real', title: '已完成剪辑',operate:false},
                        {field: 'video_time', title: '预估时长(秒)',operate:false},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'status', title: '状态',searchList: {"1":'待剪辑',"2":'剪辑中',"3":'剪辑成功',"4":'剪辑失败'},formatter: function(value,row,index){
                            if(row.status==1){
                                return "<span style='color:#999;'>待剪辑</span>";
                            }else if(row.status==2){
                                return "<span style='color:green;'>剪辑中</span>";
                            }else if(row.status==3){
                                return "<span style='color:orange'>剪辑成功</span>";
                            }else if(row.status==4){
                                return "<span style='color:red'>剪辑失败</span>";
                            }
                        }},
                        {field: 'operate', title: __('Operate'),table: table, formatter: function(value,row,index){
                            area = '';
                            if(row.type==4){
                                area  = 'data-area=["90%","100%"]';
                            }
                            return '<a href="/storeadmin/make_video/add/make_video_id/'+row.id+'/" '+area+' class="btn btn-xs btn-primary btn-dialog"  title="复制" ><i class="fa fa-cloud-download"></i> 复制</a>\
                            <a href="/storeadmin/index?jump_url=tuiguang_video&menu_url=tuiguang_video&make_video_id='+row.id+'" class="btn btn-xs btn-success" target="_blank" title="剪辑结果" ><i class="fa fa-toggle-right"></i> 剪辑结果</a>\
                            <a  class="btn btn-xs btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2"  data-original-title="删除">删除</a>';
                        }}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
            $('.add_scene').click(function(){
                // Controller.api.bindevent();
                Form.events.faselect($(".scene_block_add"));
                require(['upload'], function(Upload){
                   Upload.api.plupload();
                });
                
            });
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
            url:'/storeadmin/make_video/del?ids='+id,
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