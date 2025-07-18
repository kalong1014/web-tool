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
def search_item(kw,iid,device_id,offset,count,sort_type,publish_time,proxy_ip,proxy_port,url):
    # 直接粘贴fiddler抓包的地址  会自动替换url中的ts和_rticket
    rand = str(random.randint(1,99))
    time1 = str(int(time()))
    # device_id = '1310257671052151'
    # iid = '2942749524113992'
    if url=="":
        url = 'https://aweme.snssdk.com/aweme/v1/search/item/?os_api=22&device_type=MI+9&ssmix=a&manifest_version_code=150101&dpi=160&uuid=863254807422711&app_name=aweme&version_name=15.1.0&ts=1654933055&cpu_support64=false&app_type=normal&appTheme=dark&ac=wifi&host_abi=armeabi-v7a&update_version_code=14109900&channel=tengxun_1128_1220&_rticket=1654933056182&device_platform=android&iid='+iid+'&version_code=140100&cdid=613129e1-243c-4778-acd4-5c57a71f98ae&openudid=4e2d3194a9d97ac2&device_id='+device_id+'&resolution=540*960&os_version=7.7.1&language=zh&device_brand=Xiaomi&aid=1128&mcc_mnc=46007'

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
        'passport-sdk-version': '18',
        'sdk-version':'2',
        'Accept-Encoding': 'gzip',
        'User-Agent': "okhttp/3.10.0.1",
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

    res = requests.post(url,data=params, headers=HEADERS, proxies=proxies).text
    return res

    # contentJson = json.loads(res.content.decode('utf-8'))
    # aweme_list = contentJson.get('aweme_list', [])
    # print(aweme_list)
    # return aweme_list

# GET https://aweme.snssdk.com/aweme/v1/user/profile/other/?sec_user_id=MS4wLjABAAAA0UIMed-lwl5kBuR8dQqIY2iKTvci4wSW8N8tC5hnZxU&address_book_access=2&from=0&publish_video_strategy_type=2&user_avatar_shrink=188_188&user_cover_shrink=750_422&os_api=22&device_type=WLZ-AN00&ssmix=a&manifest_version_code=130700&dpi=280&uuid=865166026419690&app_name=aweme&version_name=13.7.0&ts=1610866250&cpu_support64=false&app_type=normal&appTheme=dark&ac=wifi&host_abi=armeabi-v7a&update_version_code=13700500&channel=gray_13700500&_rticket=1610866251143&device_platform=android&iid=2779204286424685&version_code=130700&cdid=a0af4eaf-c5d7-4483-a8b3-20654545aafc&openudid=4a3712541f6ed9b3&device_id=1160722321537128&resolution=1920*1080&os_version=5.1.1&language=zh&device_brand=HUAWEI&aid=1128&mcc_mnc=46000 HTTP/1.1
# Accept-Encoding: gzip
# passport-sdk-version: 18
# X-Tt-Token: 00eabcfa073e107a434d0bc03b7ab6e271004f5c2a693460cd01d42a1bad8c1c75ae6e65d985ae2ef4203aa8d6ad654ca3f7f0e2dfef488a063c0f07a5d50dbf67328b09d48811665a6818066dc305d4b8032-1.0.0
# sdk-version: 2
# X-SS-REQ-TICKET: 1610866251145
# Cookie: odin_tt=43d658880d007729a96c3cbc68350656044e2ea6b67852b11fb8ed2998dbc1d7c6f2f6b38055732591a0e16868472863eda1bcbecdb6aabea86f4fb33f31c548; install_id=2779204286424685; ttreq=1$9c461c68d51a97b17fd171a65e7733afee0a43b1
# X-Khronos: 1610866251
# X-Gorgon: 0404a0d100001e6ef75a5d1054802b95bbdd6eafe1edd0b5f28a
# Host: aweme.snssdk.com
# Connection: Keep-Alive
# User-Agent: okhttp/3.10.0.1


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
        # "https"  : 'http://'+proxy_ip+':'+proxy_port,
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
def comment(cookies,url,proxy_ip,proxy_port):
    url = unquote(url)
    params_str = splitParams(url)
    # print(params_str)
    xgorgon = X_Gorgon0404(params_str, '', '')

    UA = "com.ss.android.ugc.sicily/10200 (Linux; U; Android 10; zh_CN; MI 8 Lite; Build/QKQ1.190910.002;tt-ok/3.10.0.2)"
    HEADERS = {
        'X-Gorgon': str(xgorgon.get("X-Gorgon")),
        'X-Khronos': str(xgorgon.get("X-Khronos")),
        # 'X-SS-REQ-TICKET':xgorgon.get('_rticket'),
        "Accept-Encoding": "gzip",
        # "X-SS-REQ-TICKET": "1668492193781",
        "sdk-version": "2",
        # "X-Tt-Token": "00cfd50409a02c76e1347ac45f2fcbb90b0569056139eb3aece5f3a65002a60be76218c5ec3acda6a4caba0b7e6d38f01ecdda8fcbfa1b4fcb611c90e06cc2fb147bae1e55d9ea0693167e295b7542f5f0d054f2d4608ecd3849efff7b8330b5de616-1.0.1",
        "passport-sdk-version": "30726",
        "x-vc-bdturing-sdk-version": "2.2.1.cn",
        "User-Agent": "com.ss.android.ugc.sicily/10200 (Linux; U; Android 10; zh_CN; MI 8 Lite; Build/QKQ1.190910.002;tt-ok/3.10.0.2)",
        # "x-argus":"A364BJbrQboicNKik2FOoY9lmpqQM0YzbzNtVehQmZo4HikiCzNHhir3pzcb/Kg/k0EJ6RAR08aesctYyRil1HdSfRY1Lq123P+Epx8kTHppH16N29+FK34xhgVcdvCFTdRDVVQBkJwfBJCQRNFg2ncnrX3ktDj6lz214a93E1LBCsDN76hboG4dSkYxQ9WJu/0KYgrIBjpek3jfWdfSdgekDgwRsLZXYTOFmzfBIBeZ7WaIyvQYRjUP1U8iMQyfy4GDEAzxOmmD9bEbywB3Fds7ixY"
        # 'Host': host,
    }
    # return HEADERS
    # print(HEADERS)
    proxies = {
        "http"  : 'http://'+proxy_ip+':'+proxy_port,
        "https"  : 'http://'+proxy_ip+':'+proxy_port,
    }
    if proxy_ip=="":
        proxies = {}


    res = requests.get(url, headers=HEADERS,proxies=proxies,timeout=3).json()
    # if not res.text:
    #     print('ERROR')
    #     exit(0)
        
    # return res.text
    return json.dumps(res)


if __name__ == '__main__':
    # param = 'aweme_id=6914244536889871624&cursor=0&count=20&address_book_access=2&gps_access=1&forward_page_type=1&channel_id=0&city=310000&hotsoon_filtered_count=0&hotsoon_has_more=0&follower_count=0&is_familiar=0&page_source=0&os_api=23&device_type=JDN-W09&ssmix=a&manifest_version_code=110501&dpi=320&uuid=7YRBBDB751907688&app_name=aweme&oaid=d7fffffb-b0b9-eec8-c5c5-abdfdcd745e2&version_name=11.5.0&ts=1609897354&cpu_support64=true&app_type=normal&ac=wifi&host_abi=armeabi-v7a&update_version_code=11509900&channel=gdt_growth14_big_yybwz&_rticket=1609897355854&device_platform=android&iid=2269021426157783&version_code=110500&mac_address=88%3A44%3A77%3A50%3A14%3A17&cdid=343213bb-9f8d-498a-96a6-8546186674d4&openudid=2dbc8429fe6673a6&device_id=37919093879&resolution=1200*1836&os_version=6.0.1&language=zh&device_brand=Huawei&aid=1128'
    # cookie = 'odin_tt=001d30f6b836b88e1b883be9e400c6952a7d884c376f6904f0810f9bc4cb2031b1e4103fbfe8adb7a9c39b19c5a2bd17b9ee9be9535e6bce2d5f6ee4864db13e; install_id=2269021426157783; ttreq=1$176f658a40b525c843275b2fda44c38b05520022'
    # body = ''#没有传递空
    #
    # xg = X_Gorgon0404(param, body, cookie)
    # print(xg)
    #user_post('MS4wLjABAAAA06y3Ctu8QmuefqvUSU7vr0c_ZQnCqB0eaglgkelLTek')
    # user_info('MS4wLjABAAAAFyqG2SlJh1qwVMK_12VUmqlUsxB8tbJgS2A59SH9sNesZ8PhkZ3tgSD_jzCWE1Xy')
    if sys.argv[1] == 'search_item':
        res = search_item(sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6],sys.argv[7],sys.argv[8],sys.argv[9],sys.argv[10], unquote(sys.argv[11]) )
    if sys.argv[1] == 'user_info':
        res = user_info(sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6])
    if sys.argv[1] == 'comment':
        res = comment(unquote(sys.argv[2]),sys.argv[3],sys.argv[4],sys.argv[5])
    

    print(res)