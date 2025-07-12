# coding:utf-8
from selenium import webdriver
from common import BasePage
from selenium.webdriver.chrome.service import Service
import time
import json
import pathlib
from log import Log
import random
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from ast import literal_eval
import requests
import zipfile
import string
from urllib import parse
gl_log = ''
log = Log()

# 技术qq：1204702520
# 技术qq：1204702520
# 技术qq：1204702520
# 技术qq：1204702520
# 技术qq：1204702520
# 技术qq：1204702520

#数组分割
def list_split(items, n):
    return [items[i:i+n] for i in range(0, len(items), n)]


def get_cookie():
    return None
    """获取抖音cookie"""
    try:
        with open('dycookie.txt', 'r') as myFile:
            lines = myFile.read()
            if lines:
                return literal_eval(lines)
            return None
    except:
        return None

def request_url(requestid,data,code,ip,x_secsdk_csrf_token='',csrf_session_id='',video_id=''):
    param = {'requestid': requestid,'data':data,'code':code,'ip':ip,'x_secsdk_csrf_token':x_secsdk_csrf_token,'csrf_session_id':csrf_session_id,'video_id':video_id}
    r = requests.post("http://zhansiwl.com/api/index/send_call", params=param)
    return r

class CreateTask(BasePage):
    def do_func(self,catalog_mp4,text_extra,poi_name,discript,stime1,stime2,driver,type,requestid,ip,poi_id,anchor,proxy,x_secsdk_csrf_token,shop_draft_id,mix_id):
        global gl_log
        try:
            gl_log = "开始发布:"+ requestid + "\n"
            log.info(gl_log)
            if driver.current_url == "https://creator.douyin.com/":
                time.sleep(2)
                # 点击登录按钮
                self.click_element(locator='//span[@class="login"]')
                #点击登录账号选择弹窗
                self.click_element(locator='//span[@class="semi-button-content"]')
                n=0
                start_count = 0
                while True:
                    start_count = start_count + 1
                    if start_count > 5:
                        driver.quit()
                        driver.close()
                        return ''
                    try:
                        text = self.find_element(locator='//span[text()="发布视频"]').text
                        if text=='发布视频':
                            break
                    except:
                        time.sleep(3)
                        gl_log = "等待初始化cookies:"+ requestid + "\n"
                        log.info(gl_log)
                        # r = request_url(requestid, 'cookie到期', 0,ip)
                        # return ''

            time.sleep(1)
            try:
                dia = self.find_element_wait_and_focus('//div[@class="modal-button--1xVIQ"]', wait_ele=None,wait=1).click()
            except:
                gl_log = "找不到我知道的弹窗，跳过" + "\n"
                log.info(gl_log)
                pass

            gl_log = "进入发布页面" + "\n"
            log.info(gl_log)
            #进入发布页面
            driver.get("https://creator.douyin.com/creator-micro/content/publish")
            time.sleep(2)

            try:
                dia = self.find_element_wait_and_focus('//div[@class="modal-button--1xVIQ"]', wait_ele=None,wait=1).click()
            except:
                gl_log = "找不到我知道的弹窗，跳过" + "\n"
                log.info(gl_log)
                pass

            try:
                #上传视频
                self.find_element_wait_and_focus('//*[@id="root"]/div/div/div[2]/div[2]/div/div/div/div/div/div/div/input',wait_ele=None).send_keys(catalog_mp4)
            except:
                gl_log = "找不到上传按钮，重试。。。" + "\n"
                log.info(gl_log)
                driver.get("https://creator.douyin.com/creator-micro/content/publish")
                time.sleep(3)
                self.find_element_wait_and_focus('//input[@class="upload-btn-input--1NeEX"]',wait_ele=None).send_keys(catalog_mp4)
            # 等待视频上传完成
            upload_count = 0
            while True:
                upload_count = upload_count + 1
                if upload_count > 30:
                    request_url(requestid,'上传视频超过30次',5,ip)
                    driver.quit()
                    driver.close()
                    return ''
                time.sleep(5)
                try:
                    self.find_element('//*[text()="重新上传"]')
                    el = self.find_element(locator='//div[@class="text--7Ii7o"]')
                    if el:
                        break
                    else:
                        gl_log = "视频还在上传中···"+ str(upload_count) + "\n"
                        log.info(gl_log)

                except Exception as e:
                    try:
                        el = self.find_element(locator='//div[@class="preview-button--2QRRr"]')
                        if el:
                            break
                        else:
                            gl_log = "视频还在上传中···" + "\n"
                            log.info(gl_log)
                    except Exception as e:
                        gl_log = "视频还在上传中···" + "\n"
                        log.info(gl_log)
                

            gl_log = "视频已上传完成！" + "\n"
            log.info(gl_log)

            time.sleep(1)

            # 测试
            video_id = None

            request_log = driver.get_log('performance')             
            for i in range(0,len(request_log)):
                try :
                    messages = json.loads(request_log[i]['message'])
                    message = messages['message']['params']
                    # .get() 方式获取是了避免字段不存在时报错
                    request = message.get('request')
                    if(request is None):
                        continue

                    url = request.get('url')
                    if(url is None):
                        continue

                    if('video_id=' in url):
                        # gl_log = "video_id:"+ str(url) + "\n"
                        # log.info(gl_log)
                        result = parse.urlparse(url)
                        query_dict = parse.parse_qs(result.query)
                        video_id = query_dict.get('video_id', '')

                except Exception as e:
                    print('----video_id错误：'+str(e))
                    continue

            gl_log = "代理ip:" +str(proxy)+'---'+str(x_secsdk_csrf_token)+ "\n"
            log.info(gl_log)

            if(video_id is None):
                gl_log = "视频video获取失败" + "\n"
                request_url(requestid,'视频video获取失败',5,ip)
                log.info(gl_log)
                driver.quit()
                driver.close()
                return ""
            try :
                if x_secsdk_csrf_token != "":
                    dy_url = 'https://creator.douyin.com/web/api/media/aweme/create/?cookie_enabled=true&screen_width=1536&screen_height=864&browser_language=zh-CN&browser_platform=Win32&browser_name=Mozilla&browser_version=5.0+(Windows+NT+10.0%3B+WOW64)+AppleWebKit%2F537.36+(KHTML,+like+Gecko)+Chrome%2F107.0.0.0+Safari%2F537.36&browser_online=true&timezone_name=Asia%2FShanghai&aid=1128'
                    params = {'video_id': video_id[0],'text':discript,'upload_source':1,'visibility_type':0,"is_preview":0,'ifLongTitle':True,'timing':0,'download':1,'anchor':anchor,'text_extra':text_extra,"poi_name":poi_name,"poi_id":poi_id,"shop_draft_id":shop_draft_id,"mix_id":mix_id} 
                    cookies = driver.get_cookies()
                    cookie = [item["name"] + "=" + item["value"] for item in cookies ]
                    cookiestr = ';'.join(item for item in cookie)
                    HEADERS = {
                        'User-Agent': "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36", 
                        'Cookie': cookiestr,
                        'Host': 'creator.douyin.com',
                        'origin':'https://creator.douyin.com',
                        'content-type':'application/x-www-form-urlencoded;charset=UTF-8',
                        'referer':'https://creator.douyin.com/creator-micro/content/publish',
                        'x-secsdk-csrf-token':x_secsdk_csrf_token,
                    }
                    proxies = {
                        "http"  : 'http://'+proxy,
                        "https"  : 'http://'+proxy,
                    }
                    if proxy=="":
                        proxies = {}
                    
                    s = requests.session()
                    s.keep_alive = False
                    res = s.post(dy_url,data=params, headers=HEADERS, proxies=proxies, verify=False)
                    res.encoding = 'utf-8'
                    response = res.json()
                    status_code = response.get('status_code')
                    if status_code==0:
                        aweme = response.get('aweme')
                        url = aweme.get('aweme_id')
                        for i in range(0,10):
                            r = request_url(requestid,url,1,ip)
                            if int(r.text) == 1:
                                gl_log = "视频地址成功回调！" + str(url) + "\n"
                                log.info(gl_log)
                                break
                            time.sleep(5)
                    else:
                        status_msg = response.get('status_msg')
                        for i in range(0,3):
                            r = request_url(requestid,status_msg,4,ip)
                            if int(r.text) == 1:
                                gl_log = "发送失败！" + str(status_msg) + "\n"
                                log.info(gl_log)
                                break
                            time.sleep(2)
                else:
                    gl_log = "x_secsdk_csrf_token为空" + "\n"
                    request_url(requestid,'x_secsdk_csrf_token为空',0,ip)
                    log.info(gl_log)
            except Exception as e:
                # print('----post请求失败：'+str(e))
                log.info('----post请求失败：'+str(e))
            
            driver.close()  
            driver.quit()
            
            return ""
 
            

            time.sleep(1)
            try:
                dia = self.find_element_wait_and_focus('//div[@class="modal-button--1xVIQ"]', wait_ele=None,wait=1).click()
            except:
                gl_log = "找不到我知道的弹窗，跳过" + "\n"
                log.info(gl_log)
                pass

            time.sleep(1)
            #输入视频描述
            self.find_element_wait_and_focus('//div[@aria-autocomplete="list"]//br', wait_ele=None).send_keys(discript)
            gl_log = "复制描述："+ discript + "\n"
            log.info(gl_log)
            time.sleep(1)

            poi_id_len = 0
            if poi_id:
                poi_id_len = len(poi_id)
                for i, v in enumerate(poi_id):
                    self.find_elements(locator='//span[@data-text="true"]')[i].send_keys("#"+str(v))

                    driver.execute_script("window.scrollTo(0,0)")
                    try:
                        self.wait_eleVisible(locator='//div[@class="hash-tag--JV0jS"]', wait=5)
                        eld = self.find_element_wait_and_focus(
                            locator='//div[@class="hash-tag--JV0jS"]//*[text()="%s"]' % (v), wait_ele=30,
                            wait=5)

                        driver.execute_script("window.scrollTo(0,0)")
                        eld.click()
                    except:
                        try:
                            self.find_element(
                                locator='//div[@class="mentionSuggestionsEntry--3lw7t hash--OKIEi"]//span[@class="mentionSuggestionsEntryText--3Dig8"]').click()
                        except:
                            gl_log = gl_log + "找不到话题，跳过" + "\n"
                            log.info(gl_log)
                            pass
                    time.sleep(1)
            if text_extra:
                self.find_elements(locator='//span[@data-text="true"]')[poi_id_len].send_keys("@" + str(text_extra))

                driver.execute_script("window.scrollTo(0,0)")
                try:
                    self.wait_eleVisible(locator='//div[@class="mentionSuggestionsUserInfo--3s7Ic"]', wait=10)
                    eld = self.find_element_wait_and_focus(
                        locator='//div[@class="mentionSuggestions--Df7JJ"]//*[text()="%s"]'%(text_extra), wait_ele=30,wait=5)

                    driver.execute_script("window.scrollTo(0,0)")
                    eld.click()
                except:
                    try:
                        self.find_element(locator='//div[@class="at-container--2KKB2"]//div[@class="mentionSuggestionsUserInfo--3s7Ic"]').click()

                    except:
                        gl_log = "抖音号查找不到，跳过" + "\n"
                        log.info(gl_log)
                        pass
                time.sleep(1)
            if poi_name:
                try:
                    gl_log = "查找小程序/地址："+ type + " ----- " + poi_name + "\n"
                    log.info(gl_log)
                    #点击位置
                    if type == 1:

                        self.find_element('//span[text()="输入相关位置，让更多人看到你的作品"]').click()
                        self.find_element('//*[@class="semi-select-selection"]//input').send_keys(poi_name + "")
                        time.sleep(2)
                        self.find_element('//div[@class="semi-select-option option--3NOv4"][1]').click()
                    else:
                        self.find_element('//span[text()="位置"]').click()
                        time.sleep(2)
                        self.find_element('//div[text()="小程序"]').click()
                        self.find_element('//*[@class="semi-select-selection"]//span[contains(text(),"抖音小程序")]',).click()
                        self.find_element('//*[@class="semi-select-selection"]//input',).send_keys(poi_name + "")
                        time.sleep(3)
                        self.wait_eleVisible(locator='//div[@class="detail--2OB5i"]', wait=30)
                        self.find_element('//div[@class="detail--2OB5i"]').click()
                        
                except:
                    gl_log = "找不到地址/小程序，请选择正确输入" + "\n"
                    log.info(gl_log)
                time.sleep(1)

            time.sleep(1)
            try:
                dia = self.find_element_wait_and_focus('//div[@class="modal-button--1xVIQ"]', wait_ele=None,wait=1).click()
            except:
                gl_log = "找不到我知道的弹窗，跳过" + "\n"
                log.info(gl_log)
                pass

            

            #点击发布按钮
            self.find_element_wait_and_focus('//button[@class="button--1SZwR primary--1AMXd fixed--3rEwh"]', wait_ele=None,wait=2).click()
            gl_log = "视频发布完成！" + "\n"
            log.info(gl_log)

            try:
                gl_log = "出现同步视频弹窗，点击不同步！" + "\n"
                log.info(gl_log)
                self.find_element_wait_and_focus('//span[@class="semi-button-content" and text()="暂不同步"]',wait_ele=None,wait=5).click()
            except:
                pass
            #发布完成后等待10秒再发布另外
            gl_log = "视频发布成功！" + "\n"
            log.info(gl_log)

            time.sleep(1)
            try:
                el = self.find_element(locator='//div[@class="input-container"]')
                if el:
                    gl_log = "遇到手机验证码验证" + "\n"
                    request_url(requestid, '遇到手机验证码验证', 3,ip)
                    log.info(gl_log)
                    return ""
            except:
                pass
            
            try:
                #进入作品页面
                time.sleep(2)
                driver.get("https://creator.douyin.com/creator-micro/content/manage")
                #点击第一个视频播放，获取视频播放链接
                time.sleep(3)
                self.wait_eleVisible(locator='//div[@class="video-card-cover--2Y2HT"][1]', wait=30)
                self.find_element('//div[@class="video-card-cover--2Y2HT"][1]').click()

                url = self.get_element_attribube('src','//video[@playsinline="true"]')
                #推送视频链接
                for i in range(0,3):
                    r = request_url(requestid,url,1,ip)
                    if int(r.text) == 1:
                        gl_log = "视频地址成功回调！" + str(url) + "\n"
                        log.info(gl_log)
                        break
                    time.sleep(2)
            except:
                gl_log = "获取视频地址失败！" + "\n"
                log.info(gl_log)
                data = "获取视频地址失败,待确定是否发送"
                for i in range(0, 3):
                    r = request_url(requestid, data, 2,ip)
                    if int(r.text) == 1:
                        # time.sleep(2)
                        break

            request_log = driver.get_log('performance')

            x_secsdk_csrf_token = ''
            csrf_session_id = ''
             
            for i in range(0,len(request_log)):
                try :
                    messages = json.loads(request_log[i]['message'])
                    message = messages['message']['params']
                    # .get() 方式获取是了避免字段不存在时报错
                    request = message.get('request')
                    if(request is None):
                        continue
                    url = request.get('url')
                    if(url is None):
                        continue
                    if('creator.douyin.com/web/api/media/aweme/create' in url):
                        headers = request.get('headers')
                        x_secsdk_csrf_token = headers.get('x-secsdk-csrf-token')
                        cookie_list = driver.get_cookies()
                        for cookie in cookie_list:
                            if cookie['name'] == 'csrf_session_id':
                                csrf_session_id = cookie['value']
                except Exception as e:
                    print("=======获取错误" +  str(e))
                    continue

            #推送cookie
            for i in range(0,3):
                r = request_url(requestid,'x_secsdk_csrf_token反馈',4,ip,x_secsdk_csrf_token,csrf_session_id)
                if int(r.text) == 1:
                    gl_log = "x_secsdk_csrf_token反馈成功！" + "\n"
                    log.info(gl_log)
                    break
                time.sleep(2)
            # sp = random.randint(int(stime1), int(stime2))
            # time.sleep(sp)

        except Exception as e:
            gl_log = "脚本意外终止，发布失败，请重新点击执行开始任务！"+  str(e) + "\n"
            # request_url(requestid,gl_log,1)
            print("=======系统崩溃了发布失败，请重新点击执行开始任务！" +  str(e))
            log.info(gl_log)
            data = '脚本意外终止：' + str(e)
            for i in range(0,3):
                r = request_url(requestid,data,0,ip)
                if int(r.text) == 1:
                    time.sleep(2)
                    break


def do_ui(text_extra,catalog_mp4,poi_name,discript,cookies,stime1,stime2,type,requestid,ip,proxy,poi_id,anchor,shop_draft_id,mix_id):
    print("开始执行")
    catalog_mp4 = catalog_mp4 #'/Users/chenhaizhen/Desktop/33'  # 视频地址
    text_extra = text_extra  # 用户账号
    poi_name = poi_name  # 地址
    discript = discript  # 描述
    poi_id = poi_id
    proxy = proxy
    option = webdriver.ChromeOptions()
    # 设置发布完成后不关闭浏览器
    # option.add_experimental_option("detach", True)
    # 模拟浏览器
    option.add_argument(
        '--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36')
    # 指定chromedriver
    f12 = DesiredCapabilities.CHROME
    f12["goog:loggingPrefs"] = {"performance": "ALL"}

    # 为Chrome配置无头模式
    option.add_argument("--headless")
    option.add_argument('--no-sandbox')
    option.add_argument('--disable-gpu')
    option.add_argument('--disable-dev-shm-usage')

    option.add_experimental_option('excludeSwitches',['enable-automation'])  
    option.add_experimental_option('useAutomationExtension', False)  

    # option.add_argument('--disable-blink-features')
    option.add_argument('--disable-blink-features=AutomationControlled')
    # if proxy:
    #     #添加IP代理
    #     print('--proxy-server=http://'+proxy)
    #     option.add_argument('--proxy-server=http://'+proxy)
    try:
        driver = webdriver.Chrome(chrome_options=option, executable_path=r'/usr/bin/chromedriver',desired_capabilities=f12)
    except Exception as e:
        print("结果："+str(e))
    driver.execute_cdp_cmd("Page.addScriptToEvaluateOnNewDocument", {
      "source": """
        Object.defineProperty(navigator, 'webdriver', {
          get: () => undefined
        })
      """
    })
    # 如果有cookie则添加cookie
    if cookies:
        driver.get("https://creator.douyin.com")
        for cookie in cookies:
            if cookie['name']!='msToken':
                driver.add_cookie({k: cookie[k] for k in {'name', 'value', 'domain', 'expiry'}})
    driver.get("https://creator.douyin.com/creator-micro/home")
    time.sleep(4)
    driver.maximize_window()

    x_secsdk_csrf_token  = ''
    request_log = driver.get_log('performance')             
    for i in range(0,len(request_log)):
        try :
            messages = json.loads(request_log[i]['message'])
            message = messages['message']['params']
            # .get() 方式获取是了避免字段不存在时报错
            request = message.get('request')
            if(request is None):
                continue
            headers = request.get('headers')
            if(headers is None):
                continue
            csrf_token = headers.get('x-secsdk-csrf-token')
            if(csrf_token is None):
                continue
            else: 
                x_secsdk_csrf_token = csrf_token

        except Exception as e:
            gl_log = "---token错误---："+ str(e) + "\n"
            log.info(gl_log)
            continue
    if x_secsdk_csrf_token == "":
        gl_log = "---x_secsdk_csrf_token错误---："+ "\n"
        request_url(requestid,'x_secsdk_csrf_token为空',0,ip)
        log.info(gl_log)
        driver.quit()
        driver.close()
        return ""

    CreateTask(driver).do_func(catalog_mp4,text_extra, poi_name, discript, stime1, stime2, driver,type,requestid,ip,poi_id,anchor,proxy,x_secsdk_csrf_token,shop_draft_id,mix_id)


if __name__ == '__main__':
    pass
    # print(get_cookie())