# coding:utf-8

import random
import base64
import requests
import warnings
from XG84 import ios_xg
import sys
from urllib.parse import unquote
warnings.filterwarnings('ignore')

import codecs

sys.stdout = codecs.getwriter("utf-8")(sys.stdout.detach())

def search_video_ios(query, page,count,sort_type,publish_time, proxies, device):


    # device = base64.b64decode(device.encode()).decode()
    ua = 'AwemeLite 13.4.0 rv:134006 (iPhone; iOS 13.4.1; zh_CN) Cronet'

    # 视频搜索
    url = f'https://search100-search-quic-lq.amemv.com/aweme/v1/search/item/?' + device

    # params = {'keyword': kw,'offset':offset,'count':count,'sort_type':sort_type,'publish_time':publish_time,'query_correct_type':1,'is_pull_refresh':1,'video_cover_shrink':'372_496','source':'video_search','search_source':'switch_tab','hot_search':0,'is_filter_search':1}

    data = {
        # "cursor": page,
        # "query": query,
        # "count": count,
        # 'sort_type':sort_type,
        # 'publish_time':publish_time,
        
        # "from_group_id": "7109729413192748321",
        "cursor": page,
        "keyword": query,
        "count": count,
        "type": "1",
        "is_pull_refresh": "1",
        "hot_search": "0",
        "search_source": "switch_tab",
        "query_correct_type": "1",
        "enter_from": "homepage_hot",
        "is_filter_search": "1",
        "sort_type": sort_type,  # 点赞
        "publish_time": publish_time,  # 发布时间
        # "filter_duration": filter_duration  # 分钟
    }
    # headers = {
    #     'passpors-sdk-version': '18',
    #     'sdk-version': '2',
    #     'x-ss-dp': '1128',
    #     'content-type': 'application/x-www-form-urlencoded',
    #     'user-agent': 'okhttp/3.10.0.1',
    # }

    headers = {
        'passpors-sdk-version': '19',
        'sdk-version': '2',
        'x-ss-dp': '1128',
        'content-type': 'application/x-www-form-urlencoded',
        'user-agent': 'okhttp/3.10.0.1',
    }
    dy_url, head = ios_xg(url)
    headers['x-khronos'] = head['X-Khronos']
    headers['x-gorgon'] = head['X-Gorgon']

    try:
        response = requests.post(dy_url, headers=headers, data=data, proxies=proxies)
        return response.text
    except Exception as e:
        return {'error': str(e)}


if __name__ == '__main__':
    if sys.argv[6]=="":
        proxies = {}
    else:
        proxies = {
            "http"  : 'http://'+sys.argv[6]+':'+sys.argv[7],
            "https"  : 'http://'+sys.argv[6]+':'+sys.argv[7],
        }
    # device = 'version_code=21.5.0&js_sdk_version=2.19.0.2&tma_jssdk_version=2.19.0.2&app_name=aweme&app_version=21.5.0&vid=484D3E4D-A3F2-4372-8E30-5F9A06DE72D1&device_id=1007630643636712&channel=App%20Store&mcc_mnc=&aid=1128&screen_width=750&openudid=efd37094900e4e21198da103dccf912a53c6b734&cdid=F298C8A8-867E-4D99-9F13-5B541446463F&os_api=29&ac=WIFI&os_version=13.4.1&device_platform=iphone&build_number=215013&is_vcd=1&device_type=iPhone9%2C1&iid=409496318655373&idfa=4CAF1395-D499-476F-A7A4-E1BABA5916BC'

    # kw,page,count,sort_type,publish_time, ip,port, device
    connect = search_video_ios(unquote(sys.argv[1]),sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],proxies,unquote(sys.argv[8]))
    print(connect)


