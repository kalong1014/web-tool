# coding:utf-8
from selenium import webdriver
import time
import json
import sys
import codecs

sys.stdout = codecs.getwriter("utf-8")(sys.stdout.detach())

option = webdriver.ChromeOptions()

option.add_argument(
    '--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36')
# 为Chrome配置无头模式
option.add_argument("--headless")
option.add_argument('--no-sandbox')
option.add_argument('--disable-gpu')
option.add_argument('--disable-dev-shm-usage')
if sys.argv[1]!="":
    option.add_argument('--proxy-server=http://'+sys.argv[1]+':'+sys.argv[2])

option.add_experimental_option('excludeSwitches',['enable-automation'])  
option.add_experimental_option('useAutomationExtension', False)  

option.add_argument('--disable-blink-features')
option.add_argument('--disable-blink-features=AutomationControlled')
driver = webdriver.Chrome(options=option, executable_path=r'/usr/bin/chromedriver')
# 记得写完整的url 包括http和https
driver.get('https://sso.douyin.com/')
# 延迟20秒
# time.sleep(1)
# driver.get('https://www.douyin.com/discover')
time.sleep(2)
print(json.dumps(driver.get_cookies()))
driver.close()#关闭浏览器