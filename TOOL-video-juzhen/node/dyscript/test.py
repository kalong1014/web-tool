import requests
catalog_mp4 = '/Users/lx/Desktop/1639990961730795.mp4'
#catalog_mp4 = '/Users/chenhaizhen/Desktop/33/1640273913850996.mp4'
#address = 'https://m.zjbyte.net/share/douyin/?token=32c62c4f3949c6e67ecd86b41d1e8257&share_channel=copy'
address = '深圳'
#type = 1 位置  2 小程序
user_info = {'catalog_mp4': catalog_mp4, 'alias': '222',
             'address':address,'discript':'34243243234','cookies':'32222','type':1}
r = requests.post("http://127.0.0.1:9000/index", data=user_info)

print(r.text)


