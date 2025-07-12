from selenium import webdriver
from common import BasePage
from selenium.webdriver.chrome.service import Service
import time
import pathlib
from log import Log
import random
from webdriver_manager.chrome import ChromeDriverManager
from ast import literal_eval

gl_log = ''
log = Log()

#数组分割
def list_split(items, n):
    return [items[i:i+n] for i in range(0, len(items), n)]


def get_cookie():
    """获取抖音cookie"""
    try:
        with open('dycookie.txt', 'r') as myFile:
            lines = myFile.read()
            if lines:
                return literal_eval(lines)
            return None
    except:
        return None


class CreateTask(BasePage):
    mv_list = []
    def do_func(self,catalog_mp4,num,alias,address,discript,stime1,stime2,driver):
        global gl_log
        try:
            path = pathlib.Path(catalog_mp4)
            # 视频地址获取
            path_mp4 = ""
            for i in path.iterdir():
                if (".mp4" in str(i) or '.MP4' in str(i)):
                    path_mp4 = str(i)
                    break

            for i in path.iterdir():
                if (".mp4" in str(i) or '.MP4' in str(i)):
                    path_mp4 = str(i)
                    self.mv_list.append(path_mp4)

            if (path_mp4 != ""):
                print("检查到视频路径：" + path_mp4)
                gl_log = gl_log + "检查到视频路径：" + path_mp4 + "\n"
                log.info(gl_log)
            else:
                print("未检查到视频路径，程序终止！")
                gl_log = gl_log + "未检查到视频路径，程序终止！" + "\n"
                log.error(gl_log)
                exit()

            if driver.current_url == "https://creator.douyin.com/":
                # 点击登录按钮
                self.click_element(locator='//span[@class="login"]')
                #点击登录账号选择弹窗
                self.click_element(locator='//span[@class="semi-button-content"]')
                time.sleep(2)
                while True:
                    try:
                        text = self.find_element(locator='//span[text()="发布视频"]').text
                        if text=='发布视频':
                            break
                    except:
                        time.sleep(3)
                        gl_log = gl_log + "等待登录中" + "\n"
                        log.info(gl_log)

            time.sleep(3)
            cookie = driver.get_cookies()
            try:
                with open('dycookie.txt', 'w', encoding='UTF-8') as f:

                    f.write(str(cookie))
            except:
                with open('dycookie.txt', 'w', encoding='UTF-8') as f:
                    f.write(str(cookie))

            mvs = list_split(alias,int(num))
            for index,mv in enumerate(mvs):
                gl_log = gl_log + "进入发布页面" + "\n"
                log.info(gl_log)
                #进入发布页面
                driver.get("https://creator.douyin.com/creator-micro/content/publish")

                #上传视频
                self.find_element_wait_and_focus('//input[@class="upload-btn-input--1NeEX"]',wait_ele=None).send_keys(random.choice(self.mv_list))

                # 等待视频上传完成
                while True:
                    time.sleep(3)
                    try:
                        self.find_element('//*[text()="重新上传"]')
                        el = self.find_element(locator='//div[@class="text--7Ii7o"]')
                        if el:
                            break
                        else:
                            gl_log = gl_log + "视频还在上传中···" + "\n"
                            log.info(gl_log)

                    except Exception as e:
                        gl_log = gl_log + "视频还在上传中···" + "\n"
                        log.info(gl_log)

                gl_log = gl_log + "视频已上传完成！" + "\n"
                log.info(gl_log)

                time.sleep(2)
                #输入视频描述
                self.find_element_wait_and_focus('//div[@aria-autocomplete="list"]//br', wait_ele=None).send_keys(random.choice(discript))

                #@人， 输入视频描述后定位改变为：//span[@data-text="true"]
                print("============sssssssss",mv)
                for j,v in enumerate(mv):
                    #@一个人等2秒
                    time.sleep(2)
                    self.find_elements(locator='//span[@data-text="true"]')[j].send_keys("@" + str(v))

                    driver.execute_script("window.scrollTo(0,0)")
                    try:
                        self.wait_eleVisible(locator='//div[@class="mentionSuggestionsUserInfo--3s7Ic"]', wait=10)
                        eld = self.find_element_wait_and_focus(
                            locator='//div[@class="mentionSuggestions--Df7JJ"]//*[text()="%s"]'%(v), wait_ele=30,wait=5)

                        driver.execute_script("window.scrollTo(0,0)")
                        eld.click()
                    except:
                        try:
                            self.find_element(locator='//div[@class="at-container--2KKB2"]//div[@class="mentionSuggestionsUserInfo--3s7Ic"]').click()

                        except:
                            gl_log = gl_log + "抖音号查找不到，跳过" + "\n"
                            log.info(gl_log)
                            pass
                time.sleep(1)

                try:
                    #待机位置
                    self.find_element('//span[text()="位置"]').click()
                    time.sleep(2)
                    self.find_element('//div[text()="小程序"]').click()
                    self.find_element('//*[@class="semi-select-selection"]//span[contains(text(),"抖音小程序")]',).click()
                    self.find_element('//*[@class="semi-select-selection"]//input',).send_keys(address + "")
                    time.sleep(3)
                    self.wait_eleVisible(locator='//div[@class="detail--2OB5i"]', wait=30)
                    self.find_element('//div[@class="detail--2OB5i"]').click()
                except:
                    gl_log = gl_log + "找不到地址，请选择正确地址输入" + "\n"
                    log.info(gl_log)
                time.sleep(3)
                #点击发布按钮
                self.find_element_wait_and_focus('//button[@class="button--1SZwR primary--1AMXd fixed--3rEwh"]', wait_ele=None).click()
                gl_log = gl_log + "视频发布完成！" + "\n"
                log.info(gl_log)

                try:
                    gl_log = gl_log + "出现同步视频弹窗，点击不同步！" + "\n"
                    log.info(gl_log)
                    self.find_element_wait_and_focus('//span[@class="semi-button-content" and text()="暂不同步"]',wait_ele=None,wait=5).click()
                except:
                    pass
                #发布完成后等待10秒再发布另外
                gl_log = gl_log + "第%s个视频发布成功！"%(index+1) + "\n"
                log.info(gl_log)

                sp = random.randint(int(stime1), int(stime2))
                time.sleep(sp)

        except Exception as e:
            gl_log = gl_log + "脚本意外终止，发布失败，请重新点击执行开始任务！" + "\n"
            print("=======系统崩溃了发布失败，请重新点击执行开始任务！" +  str(e))
            log.info(gl_log)


def do_ui(catalog_mp4,alias,address,discript,stime1,stime2):
    print("开始执行")
    catalog_mp4 = catalog_mp4 #'/Users/chenhaizhen/Desktop/33'  # 视频地址
    num = 1  # 一次艾特人数
    alias = [alias]  # 用户账号
    address = address  # 地址
    discript = [discript]  # 描述
    stime1 = stime1
    stime2 = stime2

    option = webdriver.ChromeOptions()
    # 设置发布完成后不关闭浏览器
    option.add_experimental_option("detach", True)
    # 模拟浏览器
    option.add_argument(
        '--user-agent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36')
    # 指定chromedriver
    service = Service(executable_path=ChromeDriverManager().install())
    driver = webdriver.Chrome(service=service, options=option)
    # 如果有cookie则添加cookie
    cookies = get_cookie()

    if cookies:
        driver.get("https://creator.douyin.com")
        for cookie in cookies:
            for k in {'name', 'value', 'domain', 'path', 'expiry'}:
                if k not in list(cookie.keys()):
                    if k == 'expiry':
                        t = time.time()
                        cookie[k] = int(t)  # 时间戳s
            driver.add_cookie({k: cookie[k] for k in {'name', 'value', 'domain', 'path', 'expiry'}})
    driver.get("https://creator.douyin.com")
    driver.maximize_window()
    CreateTask(driver).do_func(catalog_mp4, num, alias, address, discript, stime1, stime2, driver)

