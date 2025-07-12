# coding:utf-8
import selenium
from selenium import webdriver
import pathlib
import time
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from log import Log
import requests
gl_log = ''
log = Log()


def request_url(requestid,data,code,ip):
    param = {'requestid': requestid,'data':data,'code':code,'ip':ip}
    r = requests.post("http://1.zhansiwl.com/api/index/send_call", params=param)
    return r


def publish_xhs(catalog_mp4,title,discript,cookies,requestid,ip,proxy):
    describe = discript
    # time.sleep(2)
    option = webdriver.ChromeOptions()
    option.add_argument(
            '--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36')

    # 为Chrome配置无头模式
    option.add_argument("--headless")
    option.add_argument('--no-sandbox')
    option.add_argument('--disable-gpu')
    option.add_argument('--disable-dev-shm-usage')

    option.add_experimental_option('excludeSwitches',['enable-automation'])  
    option.add_experimental_option('useAutomationExtension', False)  
    # option.add_argument('--proxy-server=http://'+proxy)
    # option.add_argument('--disable-blink-features')
    option.add_argument('--disable-blink-features=AutomationControlled')
    driver = webdriver.Chrome(chrome_options=option, executable_path=r'/usr/bin/chromedriver')
    # driver = webdriver.Chrome(options = options)
    driver.maximize_window()
    # path = pathlib.Path(catalog_mp4)

    # 视频地址获取
    path_mp4 = catalog_mp4

    if(path_mp4 != ""):
        gl_log = "检查到视频路径：" +path_mp4+ "\n"
        log.info(gl_log)
    else:
        gl_log = "未检查到视频路径，程序终止！" + "\n"
        log.info(gl_log)
        driver.quit()
        driver.close()
        request_url(requestid,'未检查到视频路径，程序终止！',5,ip)
        return ""
    
    try:
        driver.get("https://www.xiaohongshu.com/")
        # driver.add_cookie({'domain': '.xiaohongshu.com','name': 'customerBeakerSessionId', 'path': '/', 'value': '53b152f60a8198e9320c4cd4310363da52c63d9bgAJ9cQAoWBAAAABjdXN0b21lclVzZXJUeXBlcQFLAVgOAAAAX2NyZWF0aW9uX3RpbWVxAkdB2QuHMFcrAlgJAAAAYXV0aFRva2VucQNYQQAAADYyZGE3M2Q4YmY5ZDRlYmI5MDA3YTE0NzQ4YWJhZWI4LWYzMmRkY2Y2NmQyMTRhYzQ4ZjZmNmExNWI5NmYwOGExcQRYAwAAAF9pZHEFWCAAAABlNWI3NjMyNzRmZjE0MmU0YmExOGJmZGIyOWE4ZGViYnEGWA4AAABfYWNjZXNzZWRfdGltZXEHR0HZC4cwVysCWAYAAAB1c2VySWRxCFgYAAAANjFhNzliYjAwMDAwMDAwMDEwMDBlNmFicQl1Lg=='})
        # driver.add_cookie({'domain': '.xiaohongshu.com','name': 'customerClientId', 'path': '/', 'value': '071188253777485'})
        # driver.add_cookie({'domain': '.xiaohongshu.com','name': 'x-user-id-creator.xiaohongshu.com', 'path': '/', 'value': '61a79bb0000000001000e6ab'})
        # driver.add_cookie({'domain': '.xiaohongshu.com','name': 'access-token-creator.xiaohongshu.com', 'path': '/', 'value': 'customer.ares.AT-d59a7d7dd2614584b0fbc03bed48dba6-4e5c3f4da75a4f61901be32d04ac2c03'})

        # driver.add_cookie({'domain': '.xiaohongshu.com','name': 'galaxy.creator.beaker.session.id', 'path': '/', 'value': '1680743617499087887893'})
        for cookie in cookies:
            driver.add_cookie({k: cookie[k] for k in {'name', 'value', 'domain'}})
    except  Exception as e:
        gl_log = "脚本意外终止，发布失败！"+  str(e) + "\n"
        log.info(gl_log)
        driver.quit()
        driver.close()
        return ""
    # if cookies:
    #     driver.get("https://channels.weixin.qq.com/")
    #     for cookie in cookies:
    #         driver.add_cookie({k: cookie[k] for k in {'name', 'value', 'domain', 'expiry'}}) 

    # 进入微信视频号创作者页面，并上传视频
    driver.get("https://creator.xiaohongshu.com/publish/publish")
    
    time.sleep(2)

    gl_log = "正在上传视频。。" + "\n"
    log.info(gl_log)
    # source = driver.page_source
    # print(source)
    try:

        driver.find_element(By.CSS_SELECTOR,'#publish-container > div > div.video-uploader-container.upload-area > div.upload-wrapper > div > input').send_keys(path_mp4)
    except:
        gl_log = "找不到上传按钮,重试" + "\n"
        log.info(gl_log)
        driver.get("https://creator.xiaohongshu.com/publish/publish")
        time.sleep(3)
        try:
            driver.find_element(By.CSS_SELECTOR,'#publish-container > div > div.video-uploader-container.upload-area > div.upload-wrapper > div > input').send_keys(path_mp4)
        except:
            gl_log = "找不到上传按钮，结束发布" + "\n"
            log.info(gl_log)
            request_url(requestid,'找不到上传按钮，结束发布',5,ip)
            driver.quit()
            driver.close()
            return ''
    # 等待视频上传完成
    # 检查一：等待正在处理文件的提示显示
    upload_count = 0
    while True:
        upload_count = upload_count + 1
        time.sleep(5)
        if upload_count > 20:
            gl_log = "上传视频失败30次" + "\n"
            log.info(gl_log)
            driver.quit()
            driver.close()
            request_url(requestid,'上传视频超过30次',5,ip)
            return "";

        gl_log = "视频还在上传中···"+ str(upload_count) + "\n"
        log.info(gl_log)
        try:
            del_div = driver.find_element(By.XPATH,'//div[@class="reUpload"]')
            if del_div:
                break                
        except Exception as e:
            pass

    gl_log = "小红书视频已上传完成！" + "\n"
    log.info(gl_log)
    
    # source = driver.page_source
    # print(source)

    # 再确定一次
    # try:
    #     del_div = driver.find_element(By.XPATH,'//*[text()="文件上传中"]')
    #     if del_div:
    #         gl_log = "上传文件失败:" +str(requestid)+ "\n"
    #         log.info(gl_log)
    #         r = request_url(requestid,"上传文件失败:" +str(requestid),5,ip)
    #         return ''          
    # except Exception as e:
    #     pass
    time.sleep(10)

    # 输入视频描述
    try:
        driver.find_element(By.CSS_SELECTOR,'div.c-input.titleInput > input').send_keys(title)
        gl_log = "添加标题成功！" + "\n"
        log.info(gl_log)
    except Exception as e:
        gl_log = "添加标题错误：" +str(e)+ "\n"
        log.info(gl_log)
        pass
    
    time.sleep(1)
    
    try:
        driver.find_element(By.CSS_SELECTOR,'#post-textarea').send_keys(describe)
        gl_log = "添加描述成功！" + "\n"
        log.info(gl_log)
    except Exception as e:
        gl_log = "添加描述错误：" +str(e)+ "\n"
        log.info(gl_log)
        pass
    
    try:
        list_windows = driver.window_handles 
        driver.switch_to.window(list_windows[1]) #list_windows 存储了上一步中获取的窗口
    except Exception as e:
        gl_log = "获取窗口错误：" +str(e)+ "\n"
        log.info(gl_log)
        pass
    time.sleep(2)
    
    try:
        driver.execute_script("window.scrollTo(0,500);")
    except Exception as e:
        gl_log = "滚动错误：" +str(e)+ "\n"
        log.info(gl_log)
        pass
    time.sleep(1)
    # # 点击发布
    try:
        send_btn = driver.find_element(By.XPATH,'//button[@class="css-k3hpu2 css-osq2ks dyn publishBtn red"]').click()
    except Exception as e:
        gl_log = "点击1错误：" +str(e)+ "\n"
        log.info(gl_log)
        time.sleep(1)
        try:
            driver.execute_script("window.scrollTo(0,1000);")
        except Exception as e:
            gl_log = "滚动2错误：" +str(e)+ "\n"
            log.info(gl_log)
            pass
    
    try:
        # send_btn = driver.find_element(By.XPATH,'//*[text()="发布"]').click()
        js = 'document.getElementsByClassName("css-k3hpu2 css-osq2ks dyn publishBtn red")[0].click()'
        driver.execute_script(js)
    except Exception as e:
        gl_log = "点击2错误：" +str(e)+ "\n"
        log.info(gl_log)
        pass
    time.sleep(1)
    # source = driver.page_source
    # log.info(source)

    gl_log = "已完成小红薯发布" + "\n"
    log.info(gl_log)

    is_send = 0
    for i in range(0,10):
        gl_log = "检测发表中。。" + "\n"
        log.info(gl_log)
        try:
            del_div = driver.find_element(By.XPATH,'//p[text()="发布成功"]')
            if del_div:
                is_send = 1
                gl_log = "发布成功" + "\n"
                log.info(gl_log)
                break
        except Exception as e:
            pass
        time.sleep(1)

    if is_send == 0:
        gl_log = "发布失败:" +str(requestid)+ "\n"
        # source = driver.page_source
        # log.info(source)
        del_div = driver.find_element(By.XPATH,'//div[text()="向右滑动滑块填充拼图"]')
        if del_div:
            gl_log = "遇到图片滑块错误:" +str(requestid)+ "\n"
        log.info(gl_log)
        r = request_url(requestid,gl_log,5,ip)
        return '' 
    # 再确定一次
    # source = driver.page_source
    # log.info(source)
    
    for i in range(0,2):
        gl_log = "小红薯回调中！" + "\n"
        log.info(gl_log)
        r = request_url(requestid,discript,1,ip)
        if int(r.text) == 1:
            gl_log = "小红薯成功回调！--" + str(discript) + "\n"
            log.info(gl_log)
            break
        time.sleep(2)

    # source = driver.page_source
    # log.info(source)
    # driver.quit()
    driver.close()

# catalog_mp4 = '/www/wwwroot/weike/public/video/1.mp4'
# discript = '小红薯推荐'
# cookies = ''
# requestid = '1'
# ip = ''
# proxy = ''
# publish_shipinhao(catalog_mp4,title,discript,cookies,requestid,ip,proxy)
