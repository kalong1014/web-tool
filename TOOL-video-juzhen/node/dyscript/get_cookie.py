from selenium import webdriver
import time
import json

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

option.add_argument('--disable-blink-features')
option.add_argument('--disable-blink-features=AutomationControlled')
driver = webdriver.Chrome(chrome_options=option, executable_path=r'/usr/bin/chromedriver')
# 记得写完整的url 包括http和https
driver.get('https://www.douyin.com')
# 延迟20秒
time.sleep(2)
print(json.dumps(driver.get_cookies()))
driver.close()#关闭浏览器