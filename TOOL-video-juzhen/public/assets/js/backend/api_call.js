define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_user/index' + location.search,
                    add_url: 'tuiguang_user/add?mode='+$('#mode').val(),
                    // edit_url: 'tuiguang_user/edit',    
                    del_url: 'tuiguang_user/del',
                    multi_url: 'tuiguang_user/multi',
                    import_url: 'tuiguang_user/import',
                    table: 'tuiguang_user',
                }
            });

            // $('.btn-douyin').click(function(){
            //     Backend.api.open('tuiguang_user/add?type=1','添加抖音账号');
            // });
            // $('.btn-xigua').click(function(){
            //     Backend.api.open('tuiguang_user/add?type=2','添加西瓜账号');
            // });
            // $('.btn-toutiao').click(function(){
            //     Backend.api.open('tuiguang_user/add?type=3','添加头条账号');
            // });

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
                        {field: 'id', title: 'ID',operate:false},
                        {field: 'store.store_name', title: '商户名'},
                        {field: 'type', title: '类型', searchList: {"1":'抖音',"2":'西瓜','3':'头条'},formatter: function(value,row,index){
                            if(row.type==2){
                                return "西瓜";
                            }else if(row.type==3){
                                return "头条";
                            }else{
                                return "抖音";
                            }
                        }},
                        {field: 'nickname', title: '昵称'},
                        {field: 'head', title: '头像',operate:false,formatter : function (value, row, index) {
                            return "<img style='width: 50px;height: 50px;' src='"+value+"' alt=''>"
                        }},
                        {field: 'openid', title: 'openid',operate:false,width:300},
                        {field: 'status', title: '任务状态',formatter: function(value,row,index){
                            if(row.status==1){
                                return "<span style='color:#ff7800;     font-size: 16px;'>正常</span>";
                            }else if(row.status==2){
                                return "<span style='color:#fff'>待扫码授权</span>";
                            }
                        },operate:false},
                        {field: 'token_out_time', title: '授权到期',operate:false},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
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
    var flag = window.confirm("消耗金额不退回，确认是否删除任务？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_user/del?ids='+id,
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