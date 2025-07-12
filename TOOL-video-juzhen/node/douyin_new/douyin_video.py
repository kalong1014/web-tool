# -*- coding: utf-8 -*-
import requests
import sys
import re
from urllib import parse
import codecs
sys.stdout = codecs.getwriter("utf-8")(sys.stdout.detach()) 


headers = {
    'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36'
}

def video_info(url):
    response = requests.post(url, headers=headers)
    video_results = re.findall(r'id="RENDER_DATA" type="application/json">(.*?)</script>', response.text)
    # print(response.text)
    if not video_results:
        return
    video_result = parse.unquote(video_results[0])
    print(video_result)


if __name__ == '__main__':
    url = "https://www.douyin.com/user/"+sys.argv[1]
    video_info(url)
