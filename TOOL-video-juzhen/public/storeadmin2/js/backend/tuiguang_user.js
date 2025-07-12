define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tuiguang_user/index' + location.search,
                    add_url: 'tuiguang_user/add?mode='+$('#mode').val(),
                    edit_url: 'tuiguang_user/edit',    
                    del_url: 'tuiguang_user/del',
                    multi_url: 'tuiguang_user/multi',
                    import_url: 'tuiguang_user/import',
                    table: 'tuiguang_user',
                }
            });

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
                        $.get("tuiguang_user/change_group?id_data="+id_data+'&group_id='+$('.user_group').val(),'',function(data){
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

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'addtime',
                searchFormVisible:true,
                search:false,
                showExport: true,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: 'ID',operate:false,width:50},
                        {field: 'group.name', title: '分组名',width:100},
                        {field: 'type', title: '类型', searchList: {"1":'D音',"2":'X瓜','3':'T条','4':'K手','5':'哔哩哔哩','6':'视频号','7':'小红薯','8':'D音开放接口'},formatter: function(value,row,index){
                            if(row.type==2){
                                return "<span style='font-size:14px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>X瓜账号</span>";
                            }else if(row.type==3){
                                return "<span style='font-size:14px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>T条账号</span>";
                            }else if(row.type==4){
                                return "<span style='font-size:14px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>K手账号</span>";
                            }else if(row.type==5){
                                return "<span style='font-size:14px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>哔哩哔哩</span>";
                            }else if(row.type==6){
                                return "<span style='font-size:14px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>视频号</span>";
                            }else if(row.type==7){
                                return "<span style='font-size:14px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>小红薯</span>";
                            }else if(row.type==8){
                                return "<span style='font-size:14px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>D音开放</span>";
                            }else{
                                return "<span style='font-size:14px;font-weight:bold;letter-spacing: 2px;border:1px solid #ccc;padding:3px 10px;display:inline-block;border-radius:5px;'>D音账号</span>";
                            }
                        },width:100},
                        {field: 'nickname', title: '昵称',operate:'like',formatter : function (value, row, index) {
                            return '<span title="'+row.nickname+'">'+row.nickname+'</span>';
                        }},
                        
                        {field: 'head', title: '头像',operate:false,formatter : function (value, row, index) {
                            return "<img style='width: 40px;height: 40px;' src='"+value+"' alt=''>"
                        },width:70},
                        {field: 'fan', title: '粉 / 赞 / 视频',operate:false, sortable: true,formatter: function(value,row,index){
                            if(row['type']==8){
                                return '--';
                            }
                            return row.fan+' / '+row.like_count + ' / '+row['aweme_count'];
                        },operate:false,width:110},
                        {field: 'blog_url', title: 'openid / 账号',operate:'like',formatter : function (value, row, index) {
                            return '<span onclick="copy_huashu(\''+value+'\')" title="'+value+'" style="cursor: pointer;">'+value+'</span>';
                        },width:120},
                        {field: 'status', title: '状态',formatter: function(value,row,index){
                            if(row.status==1){
                                return "<span style='color:#0fff0f; font-size: 16px;font-weight:bold'>正常</span>";
                            }else{
                                return "<span style='color:red'>到期</span>";
                            }
                        }, searchList: {"1":'正常',"0":'到期'},width:80},
                        {field: 'poi_name', title: '绑定POI',operate:false},
                        {field: 'token_out_time', title: '授权到期',operate:false, sortable: true},
                        {field: 'refresh_out_time', title: '下次自动续期',operate:false},
                        {field: 'sms_uptime', title: 'sms验证时间',operate:false},
                        {field: 'addtime', title: '添加时间', operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'operate', title: __('Operate'),table: table, formatter: function(value,row,index){
                            html = '';
                            if(row['status']==1 && row['type']==1){
                                html += '<a  class="btn btn-xs btn-primary btn-delone" onclick="sms('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="验证sms">验证sms</a>';
                            }
                            if(row['status']==1 && (row['type']==1 || row['type']==8)){
                                html += '<a  class="btn btn-xs btn-primary btn-delone" onclick="poi('+row.id+',\''+row.poi_address+'\',\''+row.poi_name+'\')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;background:#24ab7d"  data-original-title="绑定poi地址">绑定POI</a>';
                            }
                            if(row['status']==1 && row['type']==1){
                                if(row['mix_id']==''){
                                    html += '<a  class="btn btn-xs btn-primary btn-delone" onclick="heji('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15"  data-row-index="0" data-button-index="2" style="margin-left:5px;background: #66BB6A;"  data-original-title="合集授权">授权合集</a>';
                                }else{
                                    html += '<a  class="btn btn-xs btn-primary btn-delone" onclick="heji('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15"  data-row-index="0" data-button-index="2" style="margin-left:5px;background: #66BB6A;"  data-original-title="合集授权">已有合集</a>';
                                }
                                
                            }
                            if(row['type']==1 && row['openid']==''){
                                // html += '<a  class="btn btn-xs btn-danger btn-dialog" href="/storeadmin/tuiguang_user/edit/ids/'+row.id+'"  title="编辑" style="margin-left:5px;"  data-original-title="编辑">编辑</a>';
                            }
                            html += '<a  class="btn btn-xs btn-danger btn-delone" onclick="delCheck('+row.id+')" data-toggle="tooltip" title="" data-table-id="table" data-field-index="15" data-row-index="0" data-button-index="2" style="margin-left:5px;"  data-original-title="删除">删除</a>';
                            return html;
                        },width:260}
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
    var flag = window.confirm("删除账号会导致之前的数据都丢失，确认是否删除账号？");
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

function sms(id)
{
    var flag = window.confirm("有验证出现sms的才需要验证，确定发送验证码么？");
    if(flag == true){
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'/storeadmin/tuiguang_user/sms?ids='+id,
            success:function(data){
                if(data.code!=0){
                    $('.qrcode-popul').show();
                    $('.sms_input').val(id);
                }
                
                alert(data.msg);
            },
            error:function(){
                alert("发送验证码失败！");
            }
        });
    }else{ 
        return false;
    }
}



function heji(id)
{
    // 请求合集列表
    $.ajax({
        type:"POST",
        dataType:"json",
        url:'/storeadmin/tuiguang_user/heji?ids='+id,
        success:function(data){
            if(data.code!=0){
                $('.qrcode-popul-heji').show();
                $('.heji_input').val(id);

                html = '<option value="">不选合集</option>';
                mix_list = data.data.mix_list;
                mix_id = data.data.mix_id;
                for (var i = 0;  i < mix_list.length; i++) {
                    checked_html = '';
                    if(mix_list[i].mix_id == mix_id){
                        checked_html = 'selected';
                    }
                    html += '<option value="'+mix_list[i].mix_id+'" '+checked_html+'>'+mix_list[i].mix_name+'</option>';
                }
                
                $('.heji_select').html(html);
            }else{
                alert(data.msg);
            }            
        },
        error:function(){
            alert("网络请求失败！");
        }
    });
    
}

function copy_huashu(text){
    $('#copy_text').html(text);
    var dcopy = document.getElementById("copy_text");
    dcopy.select();
    try {
        var flag = document.execCommand("copy");//执行复制
    } catch(eo) {
        var flag = false;
    }
    layer.msg(flag ? "<span style='color:#fff'>复制成功！</span>" : "复制失败！");
}

$('.heji_btn').click(function(){
    $.ajax({
        type:"POST",
        dataType:"json",
        url:'/storeadmin/tuiguang_user/mix_edit?ids='+$('.heji_input').val()+'&mix_id='+$('.heji_select').val(),
        success:function(data){            
            if(data.code!=0){
                $('.qrcode-popul-heji').hide();
            }
            alert(data.msg);
        },
        error:function(){
            alert("授权失败！");
        }
    });
});

$('.verify_btn').click(function(){
    $.ajax({
        type:"POST",
        dataType:"json",
        url:'/storeadmin/tuiguang_user/sms_check?ids='+$('.sms_input').val()+'&code='+$('.verify_code').val(),
        success:function(data){            
            if(data.code!=0){
                $('.qrcode-popul').hide();
            }
            alert(data.msg);
        },
        error:function(){
            alert("验证失败！");
        }
    });
});
