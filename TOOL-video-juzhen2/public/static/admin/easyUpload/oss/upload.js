// var video_lists = [];
var video_total = 0;
var video_success = 0;
var video_error = 0;
accessid= $("#accessKeyId").val();

accesskey= $("#accessKeySecret").val();
host = $("#oss_host").val();

g_dirname = ''
g_object_name = ''
g_object_name_type = ''
now = timestamp = Date.parse(new Date()) / 1000;
var policyText = {
    "expiration": "2040-12-01T12:00:00.000Z", //设置该Policy的失效时间,超过这个失效时间之后,就没有办法通过这个policy上传文件了
    "conditions": [
    ["content-length-range", 0, 30485760000] // 设置上传文件的大小限制
    ]
};

var policyBase64 = Base64.encode(JSON.stringify(policyText))
message = policyBase64
var bytes = Crypto.HMAC(Crypto.SHA1, message, accesskey, { asBytes: true }) ;
var signature = Crypto.util.bytesToBase64(bytes);
//设置成随机文件名
function check_object_radio() {
    // var tt = document.getElementsByName('myradio');
    // for (var i = 0; i < tt.length ; i++ )
    // {
    //     if(tt[i].checked)
    //     {
    //         g_object_name_type = tt[i].value;
    //         break;
    //     }
    // }
    g_object_name_type = 'random_name';//随机文件名
    // g_object_name_type = 'local_name';//本地文件名

}

//设置上传目录
function get_dirname()
{
    //开启则选择存储位置
    // dir = document.getElementById("dirname").value;
    // if (dir != '' && dir.indexOf('/') != dir.length - 1)
    // {
    //     dir = dir + '/'
    // }
    // //alert(dir)
    // g_dirname = dir
    //关闭则选择固定根目录
    g_dirname = ''


}

function random_string(len) {
	// console.log("len:");
	// console.log(len);
　　len = len || 32;
　　var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
　　var maxPos = chars.length;
　　var pwd = '';
　　for (i = 0; i < len; i++) {
    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}

function get_suffix(filename) {
    pos = filename.lastIndexOf('.')
    suffix = ''
    if (pos != -1) {
        suffix = filename.substring(pos)
    }
    return suffix;
}

function calculate_object_name(filename)
{
    if (g_object_name_type == 'local_name')
    {
        g_object_name += "${filename}"
    }
    else if (g_object_name_type == 'random_name')
    {
        suffix = get_suffix(filename)
        g_object_name = g_dirname + random_string(10) + suffix
    }
    return g_object_name
}

function get_uploaded_object_name(filename)
{
    if (g_object_name_type == 'local_name')
    {
        tmp_name = g_object_name
        tmp_name = tmp_name.replace("${filename}", filename);
        return tmp_name
    }
    else if(g_object_name_type == 'random_name')
    {
        return g_object_name
    }
}

function set_upload_param(up, filename, ret)
{   
	// console.log(ret);
    g_object_name = g_dirname;
    if (filename != '') {
        suffix = get_suffix(filename)
        filename = calculate_object_name(filename)
    }
    new_multipart_params = {
        'key' : g_object_name,//
        'policy': policyBase64,
        'OSSAccessKeyId': accessid,
        'success_action_status' : '200', //让服务端返回200,不然,默认会返回204
        'signature': signature,
    };
    up.setOption({
        'url': host,
        'filename': filename,
        'multipart_params': new_multipart_params
    });
    // console.log(111111)
    up.start();
}

//验证是否是图片
function img_reg(str){
    var sear1=new RegExp('.jpg');
    var sear2=new RegExp('.png');
    var sear3=new RegExp('.JPG');
    var sear4=new RegExp('.PNG');
    var sear5=new RegExp('.jpeg');
    var sear6=new RegExp('.JPEG');
    if(sear1.test(str) || sear2.test(str) || sear3.test(str) || sear4.test(str) || sear5.test(str) || sear6.test(str)){
        return true;   //是图片
    }
    return false; // 不是图片
}

//验证是否是视频
function video_reg(str){
    var sear1=new RegExp('.mp4');
    var sear2=new RegExp('.webm');
    var sear3=new RegExp('.MP4');
    var sear4=new RegExp('.WEBM');
    if(sear1.test(str) || sear2.test(str) || sear3.test(str) || sear4.test(str)){
        return true;   //是图片
    }
    return false; // 不是图片
}
console.log(22222)
var timer,tryTime,maxTry=5,delay=5000,num=0;

var uploader = new plupload.Uploader({
   
    filters: {
        mime_types: [
            {title: "video", extensions: "mp4,webm"},
            // {title: "image", extensions: "jpg,png,jpeg"}
        ],
        // max_file_size: '400kb', // 最大只能上传400kb的文件
        prevent_duplicates: true // 不允许选取重复文件
    },
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'selectfiles',
	
	container: document.getElementById('container'),
	flash_swf_url : '/static/admin/easyUpload/oss/lib/plupload-2.1.2/js/Moxie.swf',
	silverlight_xap_url : '/static/admin/easyUpload/oss/lib/plupload-2.1.2/js/Moxie.xap',
    url : 'http://oss.aliyuncs.com',
	init: {
		PostInit: function() {
		   
			document.getElementById('ossfile').innerHTML = '';
			document.getElementById('postfiles').onclick = function() {
            set_upload_param(uploader, '', false);
            // console.log(uploader);
            return false;
			};
		},

		FilesAdded: function(up, files) {
			   
			plupload.each(files, function(file) {
			  
                if(img_reg(file.name)) {
                    if(file.size > 5*1024*1024) {
                        Dreamer.error('文件'+file.name+'超出图片限制大小',2000);
                        return true;
                    }
                }else if(video_reg(file.name)) {
                   
                    if(file.size > 128*1024*1024) {
                   
                        //自动关闭
                        Dreamer.error('文件'+file.name+'超出视频限制大小',2000);
                        return true;
                    }
                } else {
                    Dreamer.error('文件'+file.name+'格式不正确',2000);
                    // layer.msg('文件'+file.name+'格式不正确',{icon:1,time:1500,shade: 0.1});
                    return true;
                }
                video_total += 1;
                if(video_total == 1) {
                   
                    document.getElementById('ossfile').innerHTML += ' <span class="yue_div1 yue_div_ban1">'
                        + '<span class="yue_name1">素材名称</span>'
                        + '<span class="yue_bit1">素材大小</span>'
                        + '<div class="progress1">进度</div>'
                    + '</div>';
                }
				 if(num==0){
					 document.getElementById('ossfile').innerHTML += '<div class="yue_div" id="' + file.id + '">' + '<span class="yue_name">' +file.name + '</span>' + '<span class="yue_bit">' + plupload.formatSize(file.size) + '</span>' + '<dt>'
						+'<div class="progress"><div class="progress-bar" style="width: 0%"></div></div><b>0%</b></dt>'
						+'</div>'; 
				 }else{
					 return false;
				 }
				
			});
		},

		BeforeUpload: function(up, file) {
            check_object_radio();
            get_dirname();
            set_upload_param(up, file.name, true);
        },

		UploadProgress: function(up, file) {
			var d = document.getElementById(file.id);
            if(d) {
                d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                var prog = d.getElementsByTagName('div')[0];
                var progBar = prog.getElementsByTagName('div')[0]
                // progBar.style.width= 2*file.percent+'px';
                progBar.style.width = file.percent + '%';
                progBar.setAttribute('aria-valuenow', file.percent);
            }
		},

		FileUploaded: function(up, file, info) {
            if (info.status == 200)
            {
                var fid = $("#fid").val()
                // console.log(info)
                console.log(file)
                // console.log(up)
                //此为上传成功的返回
            	tryTime = 0;
            	// timer = setInterval(getDuration, delay);
            	// videoElem = document.getElementById("v");
            	// videoElem.innerHTML = '<source class="source" src="'+host+'/'+file.name+'" type="video/mp4">';
            	// videoElem.play();
                var video_url = host+"/"+up.getOption('filename');
                var video_data = {fid:fid,name:up.getOption('filename'),mediaIds:video_url};
                // video_lists.push(video_data);
                console.log(video_data);
                $.ajax({
                    type: "POST",
                    url: "/admin/bdsucai/ajax_uploadfile",
                    data: video_data,
                    dataType: "json",
                    success: function(data){
                        if(data.code == 1) {
                            video_success += 1;
                        } else {
                            video_error += 1;
                        }
                        if(video_total == video_success+video_error) {
                            Dreamer.success('共上传'+video_total+'个文件,成功'+video_success+'个,失败'+video_error+'个',3000);
                            // layer.msg('共上传'+video_total+'个文件,成功'+video_success+'个,失败'+video_error+'个',{icon:1,time:1500,shade: 0.1});
                        }
                    }
                });

            	// $("#videoUrl").val(host+"/"+up.getOption('filename')+"");
                // document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = 'upload to oss success, object name:' + get_uploaded_object_name(file.name);
            }
            else
            {
                //此为上传失败的返回
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
            }
		},

		Error: function(up, err) {
            // Dreamer.error("网络不稳定,请稍后上传~",function () {
            //     location.reload();
            // });
            console.log(err)
            layer.msg('上传的文件有误，请检查文件',{icon:2,time:1500,shade: 0.1});
            setTimeout(function(){
                location.reload();
            }, 1500);
            // document.getElementById('console').appendChild(document.createTextNode("\nError xml:" + err.response));
		}
	}
});

// function getDuration() {
//        clearInterval(timer);
//        var hour = parseInt((v.duration)/3600);
// 	   var minute = parseInt((v.duration%3600)/60);
// 	   var second = Math.ceil(v.duration%60);
// 	   $("#showByNone").show();
//        $("#showByNone1").show();
//        $("#lengthTime").val(hour+":"+minute+":"+second);
//        $("#audition").val(hour+":"+minute+":"+second);
//  }
uploader.init();
