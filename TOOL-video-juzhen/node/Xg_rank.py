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


#kw,iid,device_id
def rank_search(kw,iid,device_id,offset,url,proxy_ip,proxy_port):
    # 直接粘贴fiddler抓包的地址  会自动替换url中的ts和_rticket
    # url = 'https://aweme.snssdk.com/aweme/v1/search/item/?os_api=22&device_type=SM-G973N&ssmix=a&manifest_version_code=140501&dpi=240&uuid=351564344122718&app_name=aweme&version_name=14.5.0&ts=1644998825&cpu_support64=false&storage_type=0&app_type=normal&appTheme=dark&ac=wifi&host_abi=armeabi-v7a&update_version_code=12509900&channel=tengxun_new&_rticket=1644998826231&device_platform=android&iid='+iid+'&version_code=120500&mac_address=94%3AE2%3A3C%3ACA%3A27%3AB3&cdid=8361d9f1-a6ac-44b7-a75d-ffa32ebd6c53&openudid=7f9866979fecb7ce&device_id='+device_id+'&resolution=720*1280&os_version=7.1.1&language=zh&device_brand=samsung&aid=1128&mcc_mnc=46007'

    if url=="":
        url = 'https://aweme.snssdk.com/aweme/v1/search/item/?os_api=22&device_type=MI+9&ssmix=a&manifest_version_code=150101&dpi=160&uuid=863254807422711&app_name=aweme&version_name=15.1.0&ts=1654933055&cpu_support64=false&app_type=normal&appTheme=dark&ac=wifi&host_abi=armeabi-v7a&update_version_code=14109900&channel=tengxun_1128_1220&_rticket=1654933056182&device_platform=android&iid='+iid+'&version_code=140100&cdid=613129e1-243c-4778-acd4-5c57a71f98ae&openudid=4e2d3194a9d97ac2&device_id='+device_id+'&resolution=540*960&os_version=5.1.1&language=zh&device_brand=Xiaomi&aid=1128&mcc_mnc=46007'


    cookies = ''
    params_str = splitParams(url)
    xgorgon = X_Gorgon0404(url, '',cookies)
    # print(xgorgon)
    kw = unquote(kw)
    params = {'keyword': kw,'offset':offset,'count':20,'query_correct_type':1,'is_pull_refresh':1,'video_cover_shrink':'372_496','source':'video_search','search_source':'search_sug','hot_search':0,'is_filter_search':1,'search_id':'','enter_from':'homepage_hot','user_avatar_shrink':'64_64'}
    HEADERS = {
        'X-Gorgon': xgorgon.get('X-Gorgon'),
        'X-Khronos': xgorgon.get('X-Khronos'),
        'X-SS-REQ-TICKET':xgorgon.get('_rticket'),
        'passport-sdk-version': '18',
        'sdk-version': '2',
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

if __name__ == '__main__':
    if sys.argv[1] == 'rank_search':
        res = rank_search(sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5], unquote(sys.argv[6]),sys.argv[7],sys.argv[8] )
    print(res)