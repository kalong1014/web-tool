准备：

1、安装谷歌浏览器：yum install https://dl.google.com/linux/direct/google-chrome-stable_current_x86_64.rpm
2、安装python环境

安装依赖：
安装依赖：pip3 install -r requirements.txt

部署flask项目

1、pip install gunicorn
#进入根目录
gunicorn main:app


# cookie 数据较大，无法通过http传参数 目前是放在根目录到 dycooie文件下


2、测试

import requests

user_info = {'catalog_mp4': '/Users/chenhaizhen/Desktop/33/1640273913850996.mp4', 'alias': '222',
             'address':'https://m.zjbyte.net/share/douyin/?token=32c62c4f3949c6e67ecd86b41d1e8257&share_channel=copy','discript':'34243243234'}
r = requests.post("xxx", data=user_info)

print(r.text)











