define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'activity/index' + location.search,
                    add_url: 'activity/add?mode=',
                    edit_url: 'activity/edit',    
                    del_url: 'activity/del',
                    multi_url: 'activity/multi',
                    import_url: 'activity/import',
                    table: 'activity',
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
                        {field: 'id', title: '活动id',operate:false},
                        {field: 'activity_name', title: '活动名',operate:'like'},
                        {field: 'type', title: "类型",searchList: {1: '探店', 0: '抖音外卖'},formatter: function (value, row, index) {
                            if(value==1){
                                return '<span style="width:70px;line-height:25px;color:#fff;background:orange;font-size:12px;border-radius:5px;display:inline-block;">探店</span>';
                            }else{
                                return '<span style="width:70px;line-height:25px;color:#fff;background:#0292fe;font-size:12px;border-radius:5px;display:inline-block;">抖音外卖</span>';
                            }
                        }},
                        {field: 'limit', title: "总发放", operate: false},
                        {field: 'surplus_num', title: "剩余", operate: false},
                        
                        {field: 'status', title: '启用状态',custom: {success: 'success', failure: 'danger'},searchList: {1: '正常', 0: '关闭'},formatter: function (value, row, index) {
                            // $.toggle = Table.api.formatter.toggle;
                            return Table.api.formatter.toggle.call(this, value, row, index);
                        }},
                        {field: 'addtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'activity_user', title: '推广', width:300,table: table, formatter: function(value,row,index){
                            html = '<a href="/storeadmin/index?jump_url=activity_user&menu_url=activity_user&activity_id='+row.id+'" class="btn btn-success btn-xs" style="margin-left:5px;"  target="_blank">发送记录</a>\
                            <a href="/storeadmin/activity/qrcode?activity_id='+row.id+'" class="btn btn-success btn-xs btn-dialog" style="margin-left:5px;background-color: #24c1b9;" title="活动码下载">活动码</a>';
                            if(row.type!=1){
                                html += '<a onclick="copy_url(\''+row.short_url+'\')" class="btn btn-success btn-xs " style="margin-left:5px;background-color: #3f99dc;" >复制推广链接</a>';
                            }
                            return html;
                        }, operate: false},
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

$(document.body).append('<script type="text/javascript" src="/storeadmin2/js/jquery.qrcode.min.js"></script>');


function get_qrcode(url){
    // 生成二维码
    $('#qrcode').html('');
    $('#qrcode').qrcode(url);
    $('.qrcode-popul').show();
    
}