define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'qiye_intention/index' + location.search,
                    add_url: 'qiye_intention/add?mode='+$('#mode').val(),
                    // edit_url: 'qiye_intention/edit',    
                    del_url: 'qiye_intention/del',
                    multi_url: 'qiye_intention/multi',
                    import_url: 'qiye_intention/import',
                    table: 'qiye_intention',
                }
            });

            var table = $("#table");

            $('.shoudong_update_btn').click(function(){
                var data = table.bootstrapTable('getSelections');
                var ids = [];
                if (data.length === 0) {
                    Toastr.error("请选择操作信息");
                    return;
                }
                for (var i = 0; i < data.length; i++) {
                    ids[i] = data[i]['id']
                }
                Layer.open({
                    title: '批量发私信',
                    content:'<div id="mydiv" style="margin-left:10px;margin-top:10px;color:#333">\
                                <textarea id="txtReason" style="width:280px;height:100px;resize:none;border-radius:3px;border-color:#333;" ></textarea>\
                                <p style="color:#999;font-size:12px;">请输入需要发私信内容，不可包含违法违规词，否则将发送失败</p>\
                            </div>',
                    btn: ['发送',__('Cancel')],
                    yes: function (index,layero) {
                        var txtReason = $('#txtReason').val();
                        Fast.api.ajax({
                            url: "qiye_message/send_message_all",
                            type: "post",
                            data: {content: txtReason,ids:ids},
                        }, function (data) {
                            console.log(data);
                            Layer.close(index);
                        });
                    },success: function (layero, index) {
                    }
                });
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
                        {field: 'id', title: 'ID',visible:false,operate:false},
                        {field: 'qiyeuser.nickname', title: '所属企业号',operate:'like'},
                        {field: 'nickname', title: '客户昵称',operate:'like'},
                        {field: 'avatar', title: '头像',operate:false,formatter : function (value, row, index) {
                            return "<img style='width: 50px;height: 50px;' src='"+value+"' alt=''>"
                        }},
                        // {field: 'open_id', title: 'openid',operate:false},
                        // {field: 'age', title: '年龄',operate: 'BETWEEN',width:70,sortable:'true'},
                        // {field: 'city', title: '城市',operate:'like',width:100},
                        // {field: 'gender', title: '性别',searchList: {"1":'男',"2":'女'},formatter : function (value, row, index) {
                        //     if(row.gender==1){
                        //         return "<span style='color:green; '>男</span>";
                        //     }else if(row.gender==2){
                        //         return "<span style='color:#ff7800'>女</span>";
                        //     }else{
                        //         return '未知';
                        //     }
                        // },width:70},
                        // {field: 'leads_level', title: '意向度',searchList: {"-1":'没兴趣',"0":'了解',"1":'有兴趣',"2":'有意愿',"10":'已转化'},formatter : function (value, row, index) {
                        //     if(value==1){
                        //         return "有兴趣";
                        //     }else if(value==2){
                        //         return "有意愿";
                        //     }else if(value==-1){
                        //         return "没兴趣";
                        //     }else if(value==0){
                        //         return "了解";
                        //     }else if(value==10){
                        //         return "已转化";
                        //     }else{
                        //         return '未知';
                        //     }
                        // },width:90},
                        // {field: 'telephone', title: '手机 / 微信',operate:false,formatter : function (value, row, index) {
                        //     return row.telephone + ' ' + row.wechat
                        // },width:150},
                        
                        // {field: 'is_follow', title: '是否关注',searchList: {"0":'未关注账号',"1":'已关注账号'},formatter : function (value, row, index) {
                        //     if(value==1){
                        //         return "<span style='color:green; '>已关注</span>";
                        //     }else{
                        //         return '未关注';
                        //     }
                        // },width:70},
                        // {field: 'status', title: '状态',searchList: {"1":'未跟进',"2":'已跟进'},formatter : function (value, row, index) {
                        //     if(value==2){
                        //         return "<span style='color:green; '>已跟进</span>";
                        //     }else{
                        //         return '未跟进';
                        //     }
                        // },width:70},
                        
                        {field: 'addtime', title: '首次互动', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'), width:300,table: table, formatter: function(value,row,index){
                            return '<a  class="btn btn-xs btn-primary " onclick="hudong('+row.id+')">互动记录</a><a  class="btn  btn-xs btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="删除">删除</a>';
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

function hudong(qiye_intention_id){
        layer.open({
            type: 2, //1:自定义内容 2:iframe
            title: '互动记录', //不显示标题
            closeBtn: 1, //不显示关闭按钮
            shadeClose: true, //点击外部遮罩自动关闭提示框
            skin: 'yourclass', //弹出框样式
            area: ['800px', '600px'],
            content: '/storeadmin/qiye_message/hudong?qiye_intention_id='+qiye_intention_id
        });
    }

function delCheck(id)
{
    var flag = window.confirm("确认删除该条记录？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/qiye_intention/del?ids='+id,
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