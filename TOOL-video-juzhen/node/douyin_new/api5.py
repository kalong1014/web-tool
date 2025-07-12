# coding:utf-8

import random
import base64
import requests
import sys
import json
from urllib.parse import unquote

import codecs

sys.stdout = codecs.getwriter("utf-8")(sys.stdout.detach())

def search_video_ios(url,proxies,data,headers,querystring):

    headers = json.loads(headers)
    querystring = json.loads(querystring)
    
    try:
        response = requests.request("POST", url, data=data, headers=headers, params=querystring,proxies=proxies)
        return response.text
    except Exception as e:
        return {'error': str(e)}

if __name__ == '__main__':
    if sys.argv[2]=="":
        proxies = {}
    else:
        proxies = {
            "http"  : 'http://'+sys.argv[2]+':'+sys.argv[3],
            "https"  : 'http://'+sys.argv[2]+':'+sys.argv[3],
        }
    # device = 'version_code=21.5.0&js_sdk_version=2.19.0.2&tma_jssdk_version=2.19.0.2&app_name=aweme&app_version=21.5.0&vid=484D3E4D-A3F2-4372-8E30-5F9A06DE72D1&device_id=1007630643636712&channel=App%20Store&mcc_mnc=&aid=1128&screen_width=750&openudid=efd37094900e4e21198da103dccf912a53c6b734&cdid=F298C8A8-867E-4D99-9F13-5B541446463F&os_api=29&ac=WIFI&os_version=13.4.1&device_platform=iphone&build_number=215013&is_vcd=1&device_type=iPhone9%2C1&iid=409496318655373&idfa=4CAF1395-D499-476F-A7A4-E1BABA5916BC'

    # kw,page,count,sort_type,publish_time, ip,port, device
    connect = search_video_ios(unquote(sys.argv[1]),proxies,unquote(sys.argv[4]),unquote(sys.argv[5]),unquote(sys.argv[6]))
    print(connect)