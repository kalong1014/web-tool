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


def publish_shipinhao(catalog_mp4,discript,cookies,requestid,ip,proxy):
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
    
    print(cookies)
    try:
        driver.get("https://channels.weixin.qq.com/platform/login")
        # sessionid=AATVfYAEAAABAAAAAAApllxJqACC9TgPtJsmZCAAAADzrBEppsryM1QLZ%2BdDmBLm9XwcA0exd%2BeEMM5e%2BlsrR0kyfxBynk2ioNR5mh9DT5Eh%2FyLExKm2x8g%2BXVYJuUpQdV7iuS97bMYaOl%2B%2BoBrwznq5h%2Fwv2k7X4QAMeH3lNqA%3D; wxuin=1362728372
        # driver.add_cookie({'domain': 'channels.weixin.qq.com','name': 'sessionid', 'path': '/', 'value': 'AATVfYAEAAABAAAAAADoPbpSU3CsEeoxuy4lZCAAAADzrBEppsryM1QLZ%2BdDmBLm9XwcA0exd%2BeEMM5e%2BlsrRwo2STfX1v9KIxN6e6cq8SzRc0vO2LbU0bhyf%2FbXW2j1xvri%2FBCvW2Ix3Q0qLYbPg%2B25kUhlHaBLt1OxLp4hvE4%3D'})
        # driver.add_cookie({'domain': 'channels.weixin.qq.com','name': 'wxuin', 'path': '/', 'value': '3020392550'})
        for cookie in cookies:
            driver.add_cookie({k: cookie[k] for k in {'name', 'value', 'domain'}})
    except  Exception as e:
        gl_log = "脚本意外终止，发布失败！"+  str(e) + "\n"
        log.info(gl_log)
        request_url(requestid,"脚本意外终止，发布失败！"+  str(e),5,ip)
        driver.quit()
        driver.close()
        return ""
    # if cookies:
    #     driver.get("https://channels.weixin.qq.com/")
    #     for cookie in cookies:
    #         driver.add_cookie({k: cookie[k] for k in {'name', 'value', 'domain', 'expiry'}}) 

    # 进入微信视频号创作者页面，并上传视频
    driver.get("https://channels.weixin.qq.com/platform/post/create")
    driver.maximize_window()
    time.sleep(4)

    # 再确定一次
    try:
        del_div = driver.find_element(By.XPATH,'//*[text()="为保障账号安全"]')
        if del_div:
            gl_log = "发布遇实名验证:" +str(requestid)+ "\n"
            log.info(gl_log)
            r = request_url(requestid,"发布遇实名验证:" +str(requestid),5,ip)
            return ''          
    except Exception as e:
        pass

    gl_log = "正在上传视频。。" + "\n"
    log.info(gl_log)
    # source = driver.page_source
    # print(source)
    try:
        driver.find_element(By.XPATH,'//input[@type="file"]').send_keys(path_mp4)
    except:
        gl_log = "找不到上传按钮,重试" + "\n"
        log.info(gl_log)
        driver.get("https://channels.weixin.qq.com/platform/post/create")
        time.sleep(6)
        try:
            driver.find_element(By.XPATH,'//input[@type="file"]').send_keys(path_mp4)
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
        if upload_count > 30:
            gl_log = "上传视频失败30次" + "\n"
            log.info(gl_log)
            driver.quit()
            driver.close()
            request_url(requestid,'上传视频超过30次',5,ip)
            return "";

        gl_log = "视频还在上传中···"+ str(upload_count) + "\n"
        log.info(gl_log)
        try:
            del_div = driver.find_element(By.XPATH,'//*[@id="fullScreenVideo"]')
            if del_div:
                break                
        except Exception as e:
            pass

    gl_log = "视频已上传完成！" + "\n"
    log.info(gl_log)

    # 再确定一次
    try:
        del_div = driver.find_element(By.XPATH,'//*[text()="文件上传中"]')
        if del_div:
            gl_log = "上传文件失败:" +str(requestid)+ "\n"
            log.info(gl_log)
            r = request_url(requestid,"上传文件失败:" +str(requestid),5,ip)
            return ''          
    except Exception as e:
        pass

    # 输入视频描述
    driver.find_element(By.XPATH,'//*[@data-placeholder="添加描述"]').send_keys(describe)
    gl_log = "添加描述成功！" + "\n"
    log.info(gl_log)
    try:
        # 添加位置
        driver.find_element(By.XPATH,'//*[@class="position-display-wrap"]').click()
        gl_log = "点击位置" + "\n"
        log.info(gl_log)
        time.sleep(2)
        driver.find_element(By.XPATH,'//*[text()="不显示位置"]').click()
        gl_log = "不显示位置" + "\n"
        log.info(gl_log)
    except Exception as e:
        pass

    # # 点击发布
    driver.find_element(By.XPATH,'//*[text()="发表"]').click()
    gl_log = "已完成视频号发布" + "\n"
    log.info(gl_log)

    # 再确定一次
    try:
        del_div = driver.find_element(By.XPATH,'//*[text()="为保障账号安全"]')
        if del_div:
            gl_log = "发布遇实名验证:" +str(requestid)+ "\n"
            log.info(gl_log)
            r = request_url(requestid,"发布遇实名验证:" +str(requestid),5,ip)
            return ''          
    except Exception as e:
        pass

    is_send = 0
    for i in range(0,15):
        gl_log = "检测发表中。。" + "\n"
        log.info(gl_log)
        try:
            del_div = driver.find_element(By.XPATH,'//*[text()="已发表"]')
            if del_div:
                is_send = 1
                gl_log = "已发表" + "\n"
                log.info(gl_log)
                break
        except Exception as e:
            pass
        time.sleep(1)

    if is_send == 0:
        gl_log = "发布失败:" +str(requestid)+ "\n"
        log.info(gl_log)
        r = request_url(requestid,"发布失败:" +str(requestid),5,ip)
        return '' 
    # 再确定一次
    # source = driver.page_source
    # log.info(source)
    
    for i in range(0,3):
        gl_log = "视频号回调中！" + "\n"
        log.info(gl_log)
        r = request_url(requestid,discript,1,ip)
        if int(r.text) == 1:
            gl_log = "视频号成功回调！--" + str(discript) + "\n"
            log.info(gl_log)
            break
        time.sleep(2)

    driver.quit()
    driver.close()