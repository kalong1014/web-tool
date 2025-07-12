# coding:utf-8
from time import time
from hashlib import md5
from copy import deepcopy
from urllib.parse import urlparse
from urllib.parse import parse_qs
from urllib.parse import urlencode
from urllib.parse import unquote
from urllib.parse import quote
import requests
import json
import sys
import codecs
import random

sys.stdout = codecs.getwriter("utf-8")(sys.stdout.detach())

class XGorgon0404:
    def encryption(self):
        tmp = ''
        hex_zu = []
        for i in range(0, 256):
            hex_zu.append(i)
        for i in range(0, 256):
            if i == 0:
                A = 0
            elif tmp:
                A = tmp
            else:
                A = hex_zu[i - 1]
            B = self.hex_str[i % 8]
            if A == 85:
                if i != 1:
                    if tmp != 85:
                        A = 0
            C = A + i + B
            while C >= 256:
                C = C - 256
            if C < i:
                tmp = C
            else:
                tmp = ''
            D = hex_zu[C]
            hex_zu[i] = D
        return hex_zu

    def initialize(self, debug, hex_zu):
        tmp_add = []
        tmp_hex = deepcopy(hex_zu)
        for i in range(self.length):
            A = debug[i]
            if not tmp_add:
                B = 0
            else:
                B = tmp_add[-1]
            C = hex_zu[i + 1] + B
            while C >= 256:
                C = C - 256
            tmp_add.append(C)
            D = tmp_hex[C]
            tmp_hex[i + 1] = D
            E = D + D
            while E >= 256:
                E = E - 256
            F = tmp_hex[E]
            G = A ^ F
            debug[i] = G
        return debug

    def handle(self, debug):
        for i in range(self.length):
            A = debug[i]
            B = choice(A)
            C = debug[(i + 1) % self.length]
            D = B ^ C
            E = rbpt(D)
            F = E ^ self.length
            G = ~F
            while G < 0:
                G += 4294967296
            H = int(hex(G)[-2:], 16)
            debug[i] = H
        return debug

    def main(self):
        result = ''
        for item in self.handle(self.initialize(self.debug, self.encryption())):
            result = result + hex2string(item)

        a = hex2string(self.hex_str[7])
        b = hex2string(self.hex_str[3])
        return '0404{}{}0001{}'.format(a, b, result)

    def __init__(self, debug):
        self.length = 20
        self.debug = debug
        self.hex_str = [30 ,0, 224,  228,  147,  69,  1,  208]

def choice(num):
    tmp_string = hex(num)[2:]
    if len(tmp_string) < 2:
        tmp_string = '0' + tmp_string
    return int(tmp_string[1:] + tmp_string[:1], 16)


def rbpt(num):
    result = ''
    tmp_string = bin(num)[2:]
    while len(tmp_string) < 8:
        tmp_string = '0' + tmp_string
    for i in range(0, 8):
        result = result + tmp_string[7 - i]
    return int(result, 2)


def hex2string(num):
    tmp_string = hex(num)[2:]
    if len(tmp_string) < 2:
        tmp_string = '0' + tmp_string
    return tmp_string

def X_Gorgon0404(url, data, cookie, model='utf-8'):
    gorgon = []
    _rticket = str(int(time() * 1000))
    Khronos = hex(int(time()))[2:]
    url_md5 = md5(bytearray(url, 'utf-8')).hexdigest()
    for i in range(0, 4):
        gorgon.append(int(url_md5[2 * i: 2 * i + 2], 16))
    if data:
        if model == 'utf-8':
            data_md5 = md5(bytearray(data, 'utf-8')).hexdigest()
            for i in range(0, 4):
                gorgon.append(int(data_md5[2 * i: 2 * i + 2], 16))
        elif model == 'octet':
            data_md5 = md5(data).hexdigest()
            for i in range(0, 4):
                gorgon.append(int(data_md5[2 * i: 2 * i + 2], 16))
    else:
        for i in range(0, 4):
            gorgon.append(0)
    if cookie:
        cookie_md5 = md5(bytearray(cookie, 'utf-8')).hexdigest()
        for i in range(0, 4):
            gorgon.append(int(cookie_md5[2 * i: 2 * i + 2], 16))
    else:
        for i in range(0, 4):
            gorgon.append(0)
    for i in range(0, 4):
        gorgon.append(0)
    for i in range(0, 4):
        gorgon.append(int(Khronos[2 * i: 2 * i + 2], 16))
    return {'X-Gorgon': XGorgon0404(gorgon).main(), 'X-Khronos': str(int(Khronos, 16)), "_rticket": _rticket}

#从url中截取参数
def splitParams(url):
    params = url.split('?')[1]
    return params

#替换url中的某些参数的值
def replaceParams(url, parms):
    parseResult = urlparse(url)
    #print(parseResult)
    param_dict = parse_qs(parseResult.query)
    #print(param_dict)
    for k in parms:
        if param_dict.get(k):
            param_dict[k][0] = str(parms[k])
    #print(param_dict)
    _RES = {}
    for k in param_dict:
        _RES[k] = param_dict[k][0]
    return '%s://%s%s?%s' % (parseResult.scheme, parseResult.netloc, parseResult.path, urlencode(_RES))

def get_xg0404(url, data="", cookie=""):
    return X_Gorgon0404(url.split("?")[1], data, cookie)

# GET https://aweme.snssdk.com/aweme/v1/aweme/post/?source=0&user_avatar_shrink=96_96&video_cover_shrink=248_330&publish_video_strategy_type=2&max_cursor=0&sec_user_id=MS4wLjABAAAA06y3Ctu8QmuefqvUSU7vr0c_ZQnCqB0eaglgkelLTek&count=20&is_order_flow=0&os_api=22&device_type=WLZ-AN00&ssmix=a&manifest_version_code=130700&dpi=280&uuid=865166026419690&app_name=aweme&version_name=13.7.0&ts=1610866168&cpu_support64=false&app_type=normal&appTheme=dark&ac=wifi&host_abi=armeabi-v7a&update_version_code=13700500&channel=gray_13700500&_rticket=1610866168530&device_platform=android&iid=2779204286424685&version_code=130700&cdid=a0af4eaf-c5d7-4483-a8b3-20654545aafc&openudid=4a3712541f6ed9b3&device_id=1160722321537128&resolution=1920*1080&os_version=5.1.1&language=zh&device_brand=HUAWEI&aid=1128&mcc_mnc=46000 HTTP/1.1
# Accept-Encoding: gzip
# passport-sdk-version: 18
# X-Tt-Token: 00eabcfa073e107a434d0bc03b7ab6e271004f5c2a693460cd01d42a1bad8c1c75ae6e65d985ae2ef4203aa8d6ad654ca3f7f0e2dfef488a063c0f07a5d50dbf67328b09d48811665a6818066dc305d4b8032-1.0.0
# sdk-version: 2
# X-SS-REQ-TICKET: 1610866168533
# Cookie: odin_tt=43d658880d007729a96c3cbc68350656044e2ea6b67852b11fb8ed2998dbc1d7c6f2f6b38055732591a0e16868472863eda1bcbecdb6aabea86f4fb33f31c548; install_id=2779204286424685; ttreq=1$9c461c68d51a97b17fd171a65e7733afee0a43b1
# X-Khronos: 1610866168
# X-Gorgon: 0404a0430000c264ef1e761638489bef0d0915a4b3e98b44ceef
# Host: aweme.snssdk.com
# Connection: Keep-Alive
# User-Agent: okhttp/3.10.0.1



#用户个人中心
def user_post(user_id):
    # 直接粘贴fiddler抓包的地址  会自动替换url中的ts和_rticket
    url = 'https://aweme.snssdk.com/aweme/v1/aweme/post/?source=0&user_avatar_shrink=96_96&video_cover_shrink=248_330&publish_video_strategy_type=2&max_cursor=0&' \
          'sec_user_id='+ user_id +\
          '&count=20&is_order_flow=0&os_api=22&' \
          'device_type=WLZ-AN00&ssmix=a&manifest_version_code=130700&dpi=280&' \
          'uuid=865166026419690&app_name=aweme&version_name=13.7.0&ts=1610866168&cpu_support64=false&app_type=normal&appTheme=dark&ac=wifi&host_abi=armeabi-v7a&update_version_code=13700500&channel=gray_13700500&_rticket=1610866168530&device_platform=android&' \
          'iid=2779204286424685&version_code=130700&' \
          'cdid=a0af4eaf-c5d7-4483-a8b3-20654545aafc&' \
          'openudid=4a3712541f6ed9b3&device_id=1160722321537128&resolution=1920*1080&os_version=5.1.1&language=zh&' \
          'device_brand=HUAWEI&aid=1128&mcc_mnc=46000'

    cookies = 'odin_tt=43d658880d007729a96c3cbc68350656044e2ea6b67852b11fb8ed2998dbc1d7c6f2f6b38055732591a0e16868472863eda1bcbecdb6aabea86f4fb33f31c548; install_id=2779204286424685; ttreq=1$9c461c68d51a97b17fd171a65e7733afee0a43b1'
    params_str = splitParams(url)
    xgorgon = X_Gorgon0404(params_str, '',cookies)
    print(xgorgon)
    HEADERS = {
        'X-Gorgon': xgorgon.get('X-Gorgon'),
        'X-Khronos': xgorgon.get('X-Khronos'),
        'sdk-version': '1',
        'Accept-Encoding': 'gzip',
        'User-Agent': "okhttp/3.10.0.1",
        'Cookie': cookies,
        'Host': 'api.amemv.com',
        'Connection': 'Keep-Alive',
        'X-Pods': ''
    }
    res = requests.get(url, headers=HEADERS, allow_redirects=False)
    print(res.text)
    contentJson = json.loads(res.content.decode('utf-8'))
    aweme_list = contentJson.get('aweme_list', [])
    print(aweme_list)
    return aweme_list


#搜索视频
def search_item(kw,iid,device_id,offset,count,sort_type,publish_time,url,proxy_ip,proxy_port):
    # 直接粘贴fiddler抓包的地址  会自动替换url中的ts和_rticket
    rand = str(random.randint(1,99))
    time1 = str(int(time()))
    # device_id = '180776072655559'
    # iid = '4314939793085501'
    if url=="":
        url = 'https://aweme.snssdk.com/aweme/v1/search/item/?os_api=22&device_type=MI+9&ssmix=a&manifest_version_code=150101&dpi=160&uuid=863254807422711&app_name=aweme&version_name=15.1.0&ts=1654933055&cpu_support64=false&app_type=normal&appTheme=dark&ac=wifi&host_abi=armeabi-v7a&update_version_code=14109900&channel=tengxun_1128_1220&_rticket=1654933056182&device_platform=android&iid='+iid+'&version_code=140100&cdid=613129e1-243c-4778-acd4-5c57a71f98ae&openudid=4e2d3194a9d97ac2&device_id='+device_id+'&resolution=540*960&os_version=5.1.1&language=zh&device_brand=Xiaomi&aid=1128&mcc_mnc=46007'

    cookies = ''
    params_str = splitParams(url)
    xgorgon = X_Gorgon0404(url, '',cookies)
    # print(xgorgon)
    kw = unquote(kw)
    params = {'keyword': kw,'offset':offset,'count':count,'sort_type':sort_type,'publish_time':publish_time,'query_correct_type':1,'is_pull_refresh':1,'video_cover_shrink':'372_496','source':'video_search','search_source':'switch_tab','hot_search':0,'is_filter_search':1}
    HEADERS = {
        'X-Gorgon': xgorgon.get('X-Gorgon'),
        'X-Khronos': xgorgon.get('X-Khronos'),
        'X-SS-REQ-TICKET':xgorgon.get('_rticket'),
        'User-Agent': "okhttp/3.10.0.1",
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'Cookie': cookies,
        'Host': 'aweme.snssdk.com',

        'Connection': 'Keep-Alive',
    }
    proxies = {
        "http"  : 'http://'+proxy_ip+':'+proxy_port,
        "https"  : 'http://'+proxy_ip+':'+proxy_port,
    }
    if proxy_ip=="":
        proxies = {}
    res = requests.post(url,data=params, headers=HEADERS,proxies=proxies).text
    return res


#信息
def user_info(url,cookies,iid,proxy_ip,proxy_port):
    url = unquote(url)
    params_str = splitParams(url)
    xgorgon = X_Gorgon0404(params_str, '', cookies)

    HEADERS = {
        'X-Gorgon': xgorgon.get("X-Gorgon"),
        'X-Khronos': str(xgorgon.get("X-Khronos")),
        'X-SS-REQ-TICKET':xgorgon.get('_rticket'),
        'x-vc-bdturing-sdk-version':'2.1.0.cn',
        'passport-sdk-version': '19',
        'sdk-version': '2',
        'Accept-Encoding': 'gzip',
        'User-Agent': "okhttp/3.10.0.1",
        'Cookie': 'odin_tt='+cookies+'; install_id='+iid,
        'Host': 'aweme.snssdk.com',
    }
    # return HEADERS
    # print(HEADERS)
    proxies = {
        "http"  : 'http://'+proxy_ip+':'+proxy_port,
        "https"  : 'http://'+proxy_ip+':'+proxy_port,
    }
    if proxy_ip=="":
        proxies = {}
    res = requests.get(url, headers=HEADERS,proxies=proxies).json()
    # if not res.text:
    #     print('ERROR')
    #     exit(0)
        
    # return res.text
    return json.dumps(res['user'])

#信息
def comment(url,cookies,iid,proxy_ip,proxy_port,host):
    url = unquote(url)
    params_str = splitParams(url)
    xgorgon = X_Gorgon0404(url, '', cookies)
    HEADERS = {
        'X-Gorgon': str(xgorgon.get("X-Gorgon")),
        # 'X-Khronos': str(xgorgon.get("X-Khronos")),
        'X-SS-REQ-TICKET':xgorgon.get('_rticket'),
        'passport-sdk-version': '19',
        'sdk-version': '2',
        'Accept-Encoding': 'gzip',
        'User-Agent': "okhttp/3.10.0.1",
        'Cookie': 'odin_tt='+cookies+'; install_id='+iid,
        'Host': host,
    }
    # return HEADERS
    # print(HEADERS)
    proxies = {
        "http"  : 'http://'+proxy_ip+':'+proxy_port,
        "https"  : 'http://'+proxy_ip+':'+proxy_port,
    }
    if proxy_ip=="":
        proxies = {}


    res = requests.get(url, headers=HEADERS,proxies=proxies).json()
    # if not res.text:
    #     print('ERROR')
    #     exit(0)
        
    # return res.text
    return json.dumps(res)

#搜索用户
def search_discover(kw,iid,device_id,proxy_ip,proxy_port):
    url = 'https://hotsoon.snssdk.com/hotsoon/general_search/?query='+unquote(kw)+'&count=10&search_id&user_action=Initiative&click_rectify_bar=0&offset=0&search_type=1&live_sdk_version=110700&disable_recommend_strategy=0&iid='+iid+'&device_id='+device_id+'&ac=wifi&mac_address=94%3AE2%3A3C%3ACA%3A27%3AB3&channel=tengxun_1112_0531&aid=1112&app_name=live_stream&version_code=110700&version_name=12.8.0&device_platform=android&ssmix=a&device_type=OPPO+R11+Plus&device_brand=OPPO&language=zh&os_api=22&os_version=5.1.1&uuid=866174385422718&openudid=fd408aff605df773&manifest_version_code=110700&resolution=720*1280&dpi=240&update_version_code=11070004&_rticket=1653616182666&tab_mode=3&client_version_code=110700&jssdk_version=1.63.0.0&js_sdk_version=1.63.0.0&mcc_mnc=46007&hs_location_permission=1&cpu_support64=false&host_abi=armeabi-v7a&rom_version=OPPO_unknown&cdid=8f3e09a0-8b34-4d56-9826-eb8ad6f94697&new_nav=0&screen_width=480&ws_status=ConnectionState%7BState%3D16%7D&settings_version=24&last_update_time=1653616096679&cpu_model=placeholder&ts=1653616182'

    cookies = 'install_id='+iid+'; ttreq=1$2ef26adc03451a08420e8a0d1c13e3757dddca6a; odin_tt=14ef0b9fcc48a06f03b42d05f28820bdf065f33e8f0cd93c5cbf5249d907589758b98422ccec5576e8b97b2251155e0a5d0f654d6fcacb06743028d64f71c3495922d3ae9852b12d0c72843db5b62f06'

    params_str = splitParams(url)
    xgorgon = X_Gorgon0404(url, '',cookies)
    # print(xgorgon)
    kw = unquote(kw)
    params = {'keyword': kw,'cursor':0,'count':10,'query_correct_type':1,'is_pull_refresh':1,'video_cover_shrink':'372_496','search_source':'switch_tab','hot_search':0,'is_filter_search':1,'search_id':'','switch_tab_from':'general','enter_from':'homepage_hot'}
    HEADERS = {
        'X-Gorgon': xgorgon.get('X-Gorgon'),
        'X-Khronos': xgorgon.get('X-Khronos'),
        'X-SS-REQ-TICKET':xgorgon.get('_rticket'),
        'passport-sdk-version': '21',
        'sdk-version': '2',
        'Accept-Encoding': 'gzip',
        'User-Agent': "okhttp/3.10.0.1",
        'Cookie': cookies,
        'Host': 'hotsoon.snssdk.com',
        'Connection': 'Keep-Alive',
    }
    proxies = {
        "http"  : 'http://'+proxy_ip+':'+proxy_port,
    }
    if proxy_ip=="":
        proxies = {}

    res = requests.get(url, headers=HEADERS, proxies=proxies).text
    return res

#粉丝列表
def search_followers(kw,iid,device_id,proxy_ip,proxy_port):
    url = 'https://hotsoon.snssdk.com/hotsoon/interact/relation/_followers/?count=30&from_db=false&current_user_id=MS4wLjABAAAAGTWxNJmHWbPGPriV4PJKBfEnd25Timx9-q1nu_fqPak&max_time=4294967296&sort_type=time&aweme_not_auth_field=0&is_dy_domain=false&flt_pkg_name=host&flt_pkg_version=-1&live_sdk_version=120800&need_personal_recommend=1&iid='+iid+'&device_id='+device_id+'&ac=wifi&channel=360_1112_0322&aid=1112&app_name=live_stream&version_code=120800&version_name=12.8.0&device_platform=android&os=android&ssmix=a&device_type=OPPO+R11+Plus&device_brand=OPPO&language=zh&os_api=22&os_version=5.1.1&manifest_version_code=120800&resolution=720*1280&dpi=240&update_version_code=12080004&_rticket=1653701806900&tab_mode=3&client_version_code=120800&mcc_mnc=46007&hs_location_permission=1&cpu_support64=false&host_abi=armeabi-v7a&rom_version=OPPO_unknown&cdid=2b1612d8-cd16-49f1-af06-529738702ae9&new_nav=0&screen_width=480&ws_status=ConnectionState%7BState%3D16%7D&settings_version=24&last_update_time=1653701745904&cpu_model=placeholder&ts=1653701806'

    cookies = 'install_id='+iid+'; ttreq=1$2ef26adc03451a08420e8a0d1c13e3757dddca6a; odin_tt=14ef0b9fcc48a06f03b42d05f28820bdf065f33e8f0cd93c5cbf5249d907589758b98422ccec5576e8b97b2251155e0a5d0f654d6fcacb06743028d64f71c3495922d3ae9852b12d0c72843db5b62f06'
    params_str = splitParams(url)
    xgorgon = X_Gorgon0404(url, '',cookies)
    # print(url)
    HEADERS = {
        'X-Gorgon': xgorgon.get('X-Gorgon'),
        'X-Khronos': xgorgon.get('X-Khronos'),
        'X-SS-REQ-TICKET':xgorgon.get('_rticket'),
        'passport-sdk-version': '21',
        'sdk-version': '1',
        'Accept-Encoding': 'gzip',
        'User-Agent': "okhttp/3.10.0.1",        
        'Cookie': cookies,
        'Host': 'hotsoon.snssdk.com',
        'Connection': 'Keep-Alive',
    }
    proxies = {
        "http"  : 'http://'+proxy_ip+':'+proxy_port,
        # "https"  : 'http://'+proxy_ip+':'+proxy_port,
    }
    if proxy_ip=="":
        proxies = {}

    res = requests.get(url, headers=HEADERS, proxies=proxies).text
    return res

if __name__ == '__main__':
    if sys.argv[1] == 'search_item':
        res = search_item(sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6],sys.argv[7],sys.argv[8],unquote(sys.argv[9]),sys.argv[10],sys.argv[11])
    if sys.argv[1] == 'user_info':
        res = user_info(sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6])
    if sys.argv[1] == 'comment':
        res = comment(sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6],sys.argv[7])
    if sys.argv[1] == 'search_discover':
        res = search_discover(sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6])
    if sys.argv[1] == 'search_followers':
        res = search_followers(sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6])

    print(res)