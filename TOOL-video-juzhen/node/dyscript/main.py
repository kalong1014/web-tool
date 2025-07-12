from flask import Flask, request
from concurrent.futures import ThreadPoolExecutor
from selenium import webdriver
import pathlib
import os
from main_script import do_ui
from shipinhao import publish_shipinhao
from xhs import publish_xhs
from urllib.parse import unquote
import time
app = Flask(__name__)
executor = ThreadPoolExecutor(5)
import sys
import json
import socket
import ast


# 技术qq：1204702520
# 技术qq：1204702520
# 技术qq：1204702520
# 技术qq：1204702520
# 技术qq：1204702520
# 技术qq：1204702520

@app.route('/get_cookie', methods=['POST','GET'])
def get_cookie():
    proxy = request.form.get('proxy')
    port = request.form.get('port')
    option = webdriver.ChromeOptions()
    option.add_argument(
        '--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36')
    # 为Chrome配置无头模式
    option.add_argument("--headless")
    option.add_argument('--no-sandbox')
    option.add_argument('--disable-gpu')
    option.add_argument('--disable-dev-shm-usage')
    if proxy!="":
        option.add_argument('--proxy-server=http://'+proxy+':'+port)

    option.add_experimental_option('excludeSwitches',['enable-automation'])  
    option.add_experimental_option('useAutomationExtension', False)  

    option.add_argument('--disable-blink-features')
    option.add_argument('--disable-blink-features=AutomationControlled')
    driver = webdriver.Chrome(options=option, executable_path=r'/usr/bin/chromedriver')
    # 记得写完整的url 包括http和https
    driver.get('https://creator.douyin.com/')
    # 延迟20秒
    # time.sleep(1)
    # driver.get('https://www.douyin.com/discover')
    time.sleep(3)
    cookies = driver.get_cookies()
    driver.close()#关闭浏览器
    return json.dumps(cookies)
    

@app.route('/index', methods=['POST','GET'])
def index():
    """
    catalog_mp4 视频路径
    text_extra 抖音号
    poi_name 小程序地址
    discript 描述文件
    stime1 视频间隔开始
    stime2 视频间隔结束
    :return:
    """
    catalog_mp4 = request.form.get('catalog_mp4')
    discript = request.form.get('discript')
    stime1 = request.form.get('stime1') or 3
    stime2 = request.form.get('stime1') or 4
    type = request.form.get('type') or 2
    requestid = request.form.get('requestid')
    ip = request.form.get('ip')
    cookies = request.form.get('cookies')
    proxy = request.form.get('proxy')

    text_extra = request.form.get('text_extra')
    poi_name = request.form.get('poi_name')
    poi_id = request.form.get('poi_id')
    anchor = request.form.get('anchor')
    shop_draft_id = request.form.get('shop_draft_id')

    mix_id = request.form.get('mix_id')

    # poi_id = ['北京二手车','二手车']
    cookies = unquote(cookies)
    text_extra = unquote(text_extra)
    anchor = unquote(anchor)

    cookies = cookies.replace(':+',': ');
    cookies = cookies.replace(',+',', ');
    # print(cookies)
    if cookies:
        if not isinstance(cookies,list):
            cookies = ast.literal_eval(cookies)

    if poi_id:
        if not isinstance(poi_id,list):
            poi_id = ast.literal_eval(poi_id)

    if not catalog_mp4:
        return {"code":1,"message":"视频地址不能为空"}
    else:
        mp4t = catalog_mp4[-3:]
        print(mp4t)
        if mp4t != 'mp4' and mp4t != 'MP4':
            return {"code": 1, "message": "视频格式不正确"}

        if not os.path.exists(catalog_mp4):
            return {"code": 1, "message": "视频文件不存在"}

    if not poi_name:
        pass
        # return {"code": 1, "message": "小程序不能为空"}
    if not discript:
        return {"code": 1, "message": "视频描述不能为空"}

    if not ip:
        return {"code": 1, "message": "服务器ip为空"}

    if not cookies:
        return {"code": 1, "message": "cookies不能为空"}
    else:
        if not isinstance(cookies,list):
            return {"code": 1, "message": "cookies格式不正确"}
        time_list = []
        for cookie in cookies:
            if 'expiry' in cookie.keys():
                if int(cookie['expiry'])>0:
                    time_list.append(int(cookie['expiry']))
        if (min(time_list)) < int(time.time()):
            pass
            # return {"code": 1, "message": "cookies已过期，请重新获取"}


    executor.submit(do_ui,text_extra ,catalog_mp4,poi_name,discript,cookies,stime1,stime2,type,requestid,ip,proxy,poi_id,anchor,shop_draft_id,mix_id)

    return {"code": 0, "message": "脚本已执行"}

@app.route('/shipinhao', methods=['POST','GET'])
def shipinhao():
    catalog_mp4 = request.form.get('catalog_mp4')
    discript = request.form.get('discript')
    requestid = request.form.get('requestid')
    ip = request.form.get('ip')
    cookies = request.form.get('cookies')
    proxy = request.form.get('proxy')
    cookies = unquote(cookies)
    cookies = cookies.replace(':+',': ');
    cookies = cookies.replace(',+',', ');
    # print(cookies)
    if cookies:
        if not isinstance(cookies,list):
            cookies = ast.literal_eval(cookies)

    if not catalog_mp4:
        return {"code":1,"message":"视频地址不能为空"}
    else:
        mp4t = catalog_mp4[-3:]
        print(mp4t)
        if mp4t != 'mp4' and mp4t != 'MP4':
            return {"code": 1, "message": "视频格式不正确"}

        if not os.path.exists(catalog_mp4):
            return {"code": 1, "message": "视频文件不存在"}

    if not discript:
        return {"code": 1, "message": "视频描述不能为空"}

    if not ip:
        return {"code": 1, "message": "服务器ip为空"}

    if not cookies:
        return {"code": 1, "message": "cookies不能为空"}
    else:
        pass
    executor.submit(publish_shipinhao ,catalog_mp4,discript,cookies,requestid,ip,proxy)

    return {"code": 0, "message": "视频号脚本已执行"}

@app.route('/xhs', methods=['POST','GET'])
def xhs():
    catalog_mp4 = request.form.get('catalog_mp4')
    discript = request.form.get('discript')
    title = request.form.get('title')
    requestid = request.form.get('requestid')
    ip = request.form.get('ip')
    cookies = request.form.get('cookies')
    proxy = request.form.get('proxy')
    cookies = unquote(cookies)
    cookies = cookies.replace(':+',': ');
    cookies = cookies.replace(',+',', ');
    # print(cookies)
    if cookies:
        if not isinstance(cookies,list):
            cookies = ast.literal_eval(cookies)

    if not catalog_mp4:
        return {"code":1,"message":"视频地址不能为空"}
    else:
        mp4t = catalog_mp4[-3:]
        print(mp4t)
        if mp4t != 'mp4' and mp4t != 'MP4':
            return {"code": 1, "message": "视频格式不正确"}

        if not os.path.exists(catalog_mp4):
            return {"code": 1, "message": "视频文件不存在"}

    if not discript:
        return {"code": 1, "message": "视频描述不能为空"}

    if not ip:
        return {"code": 1, "message": "服务器ip为空"}

    if not cookies:
        return {"code": 1, "message": "cookies不能为空"}
    else:
        pass
    executor.submit(publish_xhs,catalog_mp4,title,discript,cookies,requestid,ip,proxy)

    return {"code": 0, "message": "小红书脚本已执行"}

def typeof(variate):
    type=None
    if isinstance(variate,int):
        type = "int"
    elif isinstance(variate,str):
        type = "str"
    elif isinstance(variate,float):
        type = "float"
    elif isinstance(variate,list):
        type = "list"
    elif isinstance(variate,tuple):
        type = "tuple"
    elif isinstance(variate,dict):
        type = "dict"
    elif isinstance(variate,set):
        type = "set"
    return type

if __name__ == '__main__':
    app.config['JSON_AS_ASCII'] = False
    app.run(debug=True,port=9000)