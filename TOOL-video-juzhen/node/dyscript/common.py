import datetime
import time
from selenium import webdriver
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.webdriver.remote import webdriver

import logging
import re

class BasePage:
    def __init__(self, driver):
        self.driver = driver

    def wait_eleVisible(self, locator, by=By.XPATH, model='model', wait=30, requence=0.5):
        # 等待元素可见 - 等待的时间 起始时间/结束时间
        try:
            start = datetime.datetime.now()
            WebDriverWait(self.driver, wait, requence).until(EC.visibility_of_element_located((by, locator)))
            end = datetime.datetime.now()
            wait_times = (end - start).seconds
            print("等待时间长，wait_times",wait_times)
            logging.info("等待元素可见：{0},起始时间：{1},等待时长：{2}".format(locator, start, wait_times))
        except:
            # 日志
            logging.exception("等待元素可见异常")

    # 等待元素存在
    def wait_elePrences(self, locator, by=By.XPATH, model='model', wait=30, requence=0.5):
        # 等待元素存在- 等待的时间 起始时间/结束时间
        try:
            start = datetime.datetime.now()
            WebDriverWait(self.driver, wait, requence).until(EC.presence_of_element_located((by, locator)))
            end = datetime.datetime.now()
            wait_times = (end - start).seconds
            logging.info("等待元素存在：{0},起始时间：{1},等待时长：{2}".format(locator, start, wait_times))
        except:
            logging.exception("等待元素存在异常")

    # 等待元素存在
    def implicitly_wait(self, wait, model='model'):
        # 等待元素存在- 等待的时间 起始时间/结束时间
        try:
            return self.driver.implicitly_wait(wait)
        except:
            # 日志
            logging.exception("等待元素存在异常")

    def find_element(self, locator, by=By.XPATH, model='model'):
        # 查找元素
        logging.info("开始查找元素：{0}={1}".format(by, locator))
        try:
            return self.driver.find_element(by, locator)
        except:
            # logging.exception("等待元素存在异常")
            pass


    def find_element_wait_and_focus(self, locator, wait_ele, by=By.XPATH, model='model', wait=30,
                                    requence=0.5, index=None):
        # 查找元素
        logging.info("开始查找元素：{0}={1}".format(by, locator))
        # 等待元素
        if wait_ele == 'visibility':
            self.wait_eleVisible(locator, by, model, wait,requence)
        else:
            self.wait_elePrences(locator, by, model, wait,requence)

        # 滚到元素到可视区域
        el = self.focus(locator, by, model,index)

        try:
            return self.driver.find_element(by, locator)
        except:
            logging.exception("查找元素失败。")

    # 查的多个元素
    def find_elements(self, locator, by=By.XPATH, model='model'):
        # 查找元素
        logging.info("开始查找符合表达式的所有元素：{0}={1}".format(by, locator))
        try:
            return self.driver.find_elements(by, locator)
        except:
            logging.exception("查找元素失败。")

    # 元素的点击操作。
    def click_element(self, locator, wait_ele='visibility', by=By.XPATH, model='model', wait=30, requence=0.5,
                       index=None):
        '''
        :param locator:元素定位的表达式
        :param by:元素定位的类型
        :param model:模块或者用例名称。主要用在截图文件命名中，方便查找和定位。
        :param index: 是否要在多个元素中选择一个元素来操作。应用于查找多个元素的基础。
           index=None表示查找一个元素。
           index=-1 表示查找多个元素，并在多个元素中随机选一个；
           index > -1 表示查找多个元素，并且根据index的值取对应下标的元素。
        :return:无
        '''
        logging.info("执行点击操作！")
        ele = self.find_element_wait_and_focus(locator, wait_ele, by, model, wait,
                                               requence, index)
        try:
            ele.click()
        except:
            logging.exception("{0}下的元素执行点击操作失败。".format(model))
            raise

        # 元素的输入操作
    def input_text(self, value, locator, by=By.XPATH, model='model',wait=30,requence=0.5,
                   wait_ele='visibility',index=None):
        """
        :param value: 要输入的文本值
        :param locator:元素定位的表达式
        :param by:元素定位的类型
        :param model:模块或者用例名称。主要用在截图文件命名中，方便查找和定位。
        :param index: 是否要在多个元素中选择一个元素来操作。应用于查找多个元素的基础。
              index=None表示查找一个元素。
              index=-1 表示查找多个元素，并在多个元素中随机选一个；
              index > -1 表示查找多个元素，并且根据index的值取对应下标的元素。
        :return:无
        """
        ele = self.find_element_wait_and_focus(locator, wait_ele, by, model, wait,
                                               requence, index)
        try:
            ele.clear()
            ele.send_keys(value)
        except:
            logging.exception("{0}下的元素执行输入操作失败。".format(model))


    # 获取元素的属性值。

    def get_element_attribube(self, attr_name, locator, by=By.XPATH,model='model',wait=30,requence=0.5,
                   wait_ele='visibility',index=None):
        """
        :param attr_name: 元素的属性名称
        :param locator:元素定位的表达式
        :param by:元素定位的类型
        :param model:模块或者用例名称。主要用在截图文件命名中，方便查找和定位。
        :param index: 是否要在多个元素中选择一个元素来操作。应用于查找多个元素的基础。
              index=None表示查找一个元素。
              index=-1 表示查找多个元素，并在多个元素中随机选一个；
              index > -1 表示查找多个元素，并且根据index的值取对应下标的元素。
        :return:元素的属性值。
        """
        logging.info("{0}：获取元素{1}={2} 的属性值：{3}。".format(model, by, locator, attr_name))
        ele = self.find_element_wait_and_focus(locator, wait_ele, by, model, wait,
                                               requence, index)
        try:
            return ele.get_attribute(attr_name)
        except:
            logging.exception("获取元素的属性：{0} 失败。".format(attr_name))


     # 元素滚动操作
    def focus(self, locator, by=By.XPATH, model='model', index=None):
        """
        :param index: 是否要在多个元素中选择一个元素来操作。应用于查找多个元素的基础。
              index=None表示查找一个元素。
              index=-1 表示查找多个元素，并在多个元素中随机选一个；
              index > -1 表示查找多个元素，并且根据index的值取对应下标的元素。
        :return: 无
        """
        logging.info("{0}：滚动元素{1}={2} 到可见区域".format(model, by, locator))
        ele = self._get_element(locator, by, model, index)
        try:
            self.driver.execute_script("arguments[0].scrollIntoView();", ele)
            return ele
        except:
            logging.exception("滚动失败")


     # 确定要操作的元素 - 查找多个和查找单个。确定元素操作对象。
    def _get_element(self, locator, by, model="model", index=None):
        # index为None表示查找单个元素。不为None表示查找多个元素，并在多个元素中选一个。
        if index is not None:
            # 在查找到多个元素的基础之上，选择其中的一个。
            return self._select_ele_from_elements(locator, by, model, index)
        else:
            return self.find_element(locator, by, model)

    # 在查找到的多个元素中，选择一个元素。
    def _select_ele_from_elements(self, locator, by, model="model", index=-1):
        """
        :param index: -1 表示随机选；0及0以上的值表示按下标选值。
        :return:返回选中的元素
        """
        import random
        eles = self.find_elements(locator, by, model)
        if index == -1 or index < 0:
            pos = random.randint(0, len(eles) - 1)
            return eles[pos]
        else:
            return eles[index]

    def execute_script_click(self,locator, by=By.XPATH):
        ele = self.driver.find_element(by, locator)
        print("diaji",ele)
        self.driver.execute_script("arguments[0].click();", ele)


    def find_element_wait_and_focus_2(self, locator, wait_ele, by=By.XPATH, model='model', wait=30,
                                    requence=0.5, index=None):
        # 查找元素
        logging.info("开始查找元素：{0}={1}".format(by, locator))
        # 等待元素
        if wait_ele == 'visibility':
            self.wait_eleVisible(locator, by, model, wait,requence)
        else:
            self.wait_elePrences(locator, by, model, wait,requence)

        # 滚到元素到可视区域
        el = self.focus(locator, by, model,index)

        try:
            return self.driver.find_elements(by, locator)
        except:
            logging.exception("查找元素失败。")
