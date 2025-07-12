define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_task/index' + location.search,
                    add_url: 'tuiguang_task/add?mode='+$('#mode').val(),
                    edit_url: 'tuiguang_task/edit',    
                    del_url: 'tuiguang_task/del',
                    multi_url: 'tuiguang_task/multi',
                    import_url: 'tuiguang_task/import',
                    table: 'tuiguang_task',
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
                            url: "tuiguang_task/update_data?ids=" + (ids),
                            data: {}
                            //方法二：传参方式，直接是数组传递给后台
                            // url: "tuiguang_task/update_data",
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
                        {field: 'title', title: '任务名'},
                        {field: 'store.store_name', title: '发送商户',operate:'like',formatter: function(value,row,index){
                            return '<a   target="" href="store?id='+row.store_id+'"   data-original-title="查看商户">'+row.store.store_name+'</a>';
                        }},
                        {field: 'tuiguangvideo.title', title: '视频名',operate:false,formatter: function(value,row,index){
                            if(row.share_url!='' && row.share_url!=null){
                                return '<a   target="_blank" href="'+row.share_url+'"   data-original-title="查看视频">'+row.tuiguangvideo.title+'</a>';
                            }else{
                                return '<a   target="_blank" href="'+row.tuiguangvideo.video_url+'"   data-original-title="查看视频">'+row.tuiguangvideo.title+'</a>';
                            }
                        }},
                        {field: 'tuiguanguser.nickname', title: '发送人'},
                        {field: 'view_count', title: '播放数',operate:false, sortable: true,width:80},
                        {field: 'like_count', title: '点赞数',operate:false, sortable: true,width:80},
                        {field: 'comment_count', title: '评论数',operate:false, sortable: true,width:80},
                        // {field: 'avg_play_duration', title: '平均播放时长',operate:false, sortable: true,width:120},
                        {field: 'total_share', title: '分享数',operate:false, sortable: true,width:80},
                        {field: 'status', title: '任务状态', searchList: {"1":'未发送',"2":'已发送',"3":'发送失败或已删除'},formatter: function(value,row,index){
                            if(row.status==2){
                                return "<span style='color:green;    font-weight: bold;    font-size: 16px;'>已发送</span>";
                            }else if(row.status==1){
                                return "<span style='color:#666'>未发送</span>";
                            }else{
                                return "<span style='color:red;'>error："+row.error_text+"</span>";
                            }
                        }},
                        {field: 'send_time', title: '预计发布时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'data_update', title: '数据更新', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'), width:300,table: table, formatter: function(value,row,index){
                            html = '';
                            
                            html +=  '<a  class="btn btn-xs  btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="删除">删除</a>';
                            return html;
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
    var flag = window.confirm("删除会同步删除客户的视频，确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_task/del?ids='+id,
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
