# coding:utf-8


import time
import random
from copy import deepcopy
from hashlib import md5
from random import choice
from urllib import parse
from urllib.parse import urlparse, parse_qs


length = 0x14
hex_CE0 = [0x05, 0x00, 0x50, choice(range(0, 0xFF)), 0x47, 0x1e, 0x00, 8 * choice(range(0, 0x1F))]

def hex_string(num):
    tmp_string = hex(num)[2:]
    if len(tmp_string) < 2:
        tmp_string = '0' + tmp_string
    return tmp_string

def toHexString(n):
    return hex(n)[2:]

def addr_BA8():
        tmp = ''
        hex_BA8 = []
        for i in range(0x0, 0x100):
            hex_BA8.append(i)
        for index in range(0x100):
            if index == 0:
                A = 0
            else:
                if tmp !="":
                   A = tmp
                else:
                   A = hex_BA8[index-1]

            B = hex_CE0[index % 0x8]
            if A==0x05:
                if index !=1:
                    if tmp!=0x05:
                        A = 0

            C =  A + index + B
            while C >= 0x100:
                C =  C - 0x100

            if (C < index):
                tmp = C
            else:
                tmp = ''

            D = hex_BA8[C]
            hex_BA8[index] =  D

        return hex_BA8


def initial_(debug, hex_3F4):
        tmp_add = []
        tmp_hex = deepcopy(hex_3F4)
        for i in range(length):
            A = debug[i]
            if not tmp_add:
                B = 0
            else:
                B = tmp_add[-1]
            C = hex_3F4[i + 1] + B
            while C >= 0x100:
                C = C - 0x100
            tmp_add.append(C)
            D = tmp_hex[C]
            tmp_hex[i + 1] = D
            E = D + D
            while E >= 0x100:
                E = E - 0x100
            F = tmp_hex[E]
            G = A ^ F
            debug[i] = G
        return debug


def leftPad(a,b,c):
    if len(a)>=b:
        return a
    else:
        return "0"+a


def reverse(num):
    tmp_string = hex(num)[2:]
    if len(tmp_string) < 2:
        tmp_string = '0' + tmp_string
    return int(tmp_string[1:] + tmp_string[:1], 16)

def RBIT(num):
    result = ''
    tmp_string = bin(num)[2:]
    while len(tmp_string) < 8:
        tmp_string = '0' + tmp_string
    for i in range(0, 8):
        result = result + tmp_string[7 - i]
    return int(result, 2)

def calculate_(debug):
        for i in range(length):
            A = debug[i]
            B = reverse(A)
            C = debug[(i + 1) % length]
            D = B ^ C
            E = RBIT(D)
            F = E ^ length
            G = ~F
            if G < 0:
                G += 0x100000000
            H = int(hex(G)[-2:], 16)
            debug[i] = H
        return debug


def main(debug):
    result = ""

    initial = initial_(debug, addr_BA8())

    calculate = calculate_(initial)
    for index in range(len(calculate)):
        item = calculate[index]
        itemStr = leftPad(toHexString(item), 2, "0")
        result = result + itemStr
    a = leftPad(toHexString(hex_CE0[7]), 2, "0")

    b = leftPad(toHexString(hex_CE0[3]), 2, "0")

    c = leftPad(toHexString(hex_CE0[1]), 2, "0")

    d =leftPad(toHexString(hex_CE0[6]), 2, "0")
    result = "8402%s%s%s%s%s"%(a, b, c, d, result)
    return result


def xg84(url, data='', cookie='', model='utf8'):
   gorgon=[]
   t=int(time.time())
   Khronos=toHexString(t)
   url_md5 = md5(bytearray(url, 'utf-8')).hexdigest()
   for i in range(4):
       gorgon.append(int(url_md5[2 * i: 2 * i + 2], 16))
   if data:
       if model == 'utf-8':
           data_md5 = md5(bytearray(data, 'utf-8')).hexdigest()
           for i in range(0, 4):
               gorgon.append(int(data_md5[2 * i: 2 * i + 2], 16))
       elif model == 'octet':
           data_md5 = md5(data).hexdigest()
           for i in range(0, 4):
               gorgon.append(int(data_md5[2 * i: 2 * i + 2], 16))
   else:
       for i in range(0, 4):
           gorgon.append(0x0)
   if cookie:
       cookie_md5 = md5(bytearray(cookie, 'utf-8')).hexdigest()
       for i in range(0, 4):
           gorgon.append(int(cookie_md5[2 * i: 2 * i + 2], 16))
   else:
       for i in range(0, 4):
           gorgon.append(0x0)
   gorgon.append(0x0)
   gorgon.append(0x8)
   gorgon.append(0x10)
   gorgon.append(0x9)
   for i in range(0, 4):
       gorgon.append(int(Khronos[2 * i: 2 * i + 2], 16))
   xg=main(gorgon)
   return {"X-Gorgon": xg,"X-Khronos":str(int(Khronos, 16))}



def ios_xg(url):
    url_path = url.split('?')[0] + '?'
    query = urlparse(url).query  # wd=python&ie=utf-8
    # 将字符串转换为字典
    params = parse_qs(query)
    query = {key: params[key][0] for key in params}
    other_args = {}
    param = {**query, **other_args}
    param = parse.urlencode(param)
    param = param.replace("+", "%20")
    p = param.replace("%2A", "*")
    dy_url = url_path + p
    xgorgon = xg84(p, '', '')

    headers = {
        'User-Agent': 'AwemeLite 13.4.0 rv:134006 (iPhone; iOS 13.4.1; zh_CN) Cronet',
        'X-Khronos': xgorgon['X-Khronos'],
        'X-Gorgon': xgorgon['X-Gorgon'],
        # "cookie": '',
    }
    return dy_url, headers

