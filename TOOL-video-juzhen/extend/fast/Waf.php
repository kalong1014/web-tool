<?php

namespace fast;

class Waf
{
    private $rules = [];

    public function __construct($rules = null)
    {
        if (is_null($rules)) {
            $this->rules = [
                '\.\./', //禁用包含 ../ 的参数
                '\<\?', //禁止php脚本出现
                '\s*or\s+.*=.*', //匹配' or 1=1 ,防止sql注入
                'select([\s\S]*?)(from|limit)', //防止sql注入
                '(?:(union([\s\S]*?)select))', //防止sql注入
                'having|updatexml|extractvalue', //防止sql注入
                'sleep\((\s*)(\d*)(\s*)\)', //防止sql盲注
                'benchmark\((.*)\,(.*)\)', //防止sql盲注
                'base64_decode\(', //防止sql变种注入
                '(?:from\W+information_schema\W)', //防止sql注入
                '(?:(?:current_)user|database|schema|connection_id)\s*\(', //防止sql注入
                '(?:etc\/\W*passwd)', //防止窥探linux用户信息
                'into(\s+)+(?:dump|out)file\s*', //禁用mysql导出函数
                'group\s+by.+\(', //防止sql注入
                '(?:define|eval|file_get_contents|include|require|require_once|shell_exec|phpinfo|system|passthru|preg_\w+|execute|echo|print|print_r|var_dump|(fp)open|alert|showmodaldialog)\(', //禁用webshell相关某些函数
                '(gopher|doc|php|glob|file|phar|zlib|ftp|ldap|dict|ogg|data)\:\/', //防止一些协议攻击
                '\$_(GET|post|cookie|files|session|env|phplib|GLOBALS|SERVER)\[', //禁用一些内置变量,建议自行修改
                '\<(iframe|script|body|img|layer|div|meta|style|base|object|input)', //防止xss标签植入
                '(onmouseover|onerror|onload|onclick)\=', //防止xss事件植入
                '\|\|.*(?:ls|pwd|whoami|ll|ifconfog|ipconfig|&&|chmod|cd|mkdir|rmdir|cp|mv)', //防止执行shell
                '\s*and\s+.*=.*', //匹配 and 1=1
                '\.\./\.\./',
                    // '/\*',
                // (invokefunction|call_user_func_array|\\think\\)
                '(?:etc\/\W*passwd)',
                '(gopher|doc|php|glob|file|phar|zlib|ftp|ldap|dict|ogg|data)\:\/',
                'base64_decode\(',
                '(?:define|eval|file_get_contents|include|require|require_once|shell_exec|phpinfo|system|passthru|char|chr|preg_\w+|execute|echo|print|print_r|var_dump|(fp)open|alert|showmodaldialog)\(',
                '\$_(GET|post|cookie|files|session|env|phplib|GLOBALS|SERVER)\[',
                'select.+(from|limit)',
                '(?:(union(.*?)select))',
                'sleep\((\s*)(\d*)(\s*)\)',
                'benchmark\((.*)\,(.*)\)',
                '(?:from\W+information_schema\W)',
                '(?:(?:current_)user|database|concat|extractvalue|polygon|updatexml|geometrycollection|schema|multipoint|multipolygon|connection_id|linestring|multilinestring|exp|right|sleep|group_concat|load_file|benchmark|file_put_contents|urldecode|system|file_get_contents|select|substring|substr|fopen|popen|phpinfo|user|alert|scandir|shell_exec|eval|execute|concat_ws|strcmp|right)\s*\(',
                'into(\s+)+(?:dump|out)file\s*',
                'group\s+by.+\(',
                '\<(iframe|script|body|img|layer|div|meta|style|base|object|input)',
                '(invokefunction|call_user_func_array|wget)',
                'call_user_func_array',
                '(/tmp|/root|/wwwroot|wget|md5|upload.php)',
                    // '^url_array\[.*\]$',
                '(extractvalue\(|concat\(0x|user\(\)|substring\(|count\(\*\)|substring\(hex\(|updatexml\()',
                '(@@version|load_file\(|NAME_CONST\(|exp\(\~|floor\(rand\(|geometrycollection\(|multipoint\(|polygon\(|multipolygon\(|linestring\(|multilinestring\()',
                '(substr\()',
                '(ORD\(|MID\(|IFNULL\(|CAST\(|CHAR\()',
                '(EXISTS\(|SELECT\#|\(SELECT)',
                '(bin\(|ascii\(|benchmark\(|concat_ws\(|group_concat\(|strcmp\(|left\(|datadir\(|greatest\()',
                '(?:from.+?information_schema.+?)',
                '(array_map\("ass)',
                "'$",
                '\s+(or|xor|and)\s+.*(=|<|>|\'|")',
                '\${jndi:',
            ];
        } elseif (is_array($rules)) {
            $this->rules = $rules;
        }
    }

    public function run()
    {
        if (!$this->check()) {
            echo $this->getAlert();
            die;
        }
    }

    public function check()
    {
        $str = urldecode(@$_SERVER['REQUEST_URI']) .
            urldecode(@$_SERVER['HTTP_COOKIE']) .
            urldecode(file_get_contents('php://input')) .
            implode('', getallheaders());
        foreach ($this->rules as $rule) {
            if (preg_match('^' . $rule . '^i', $str)) {
                return false;
            }
        }
        return true;
    }

    private function getClientIP()
    {
        static $realip;
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }

    public function getAlert()
    {
        $html = <<<str
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,width=device-width">
    <title>安全拦截</title>
    <style>
        body {
            font-size: 100%;
            background-color: #550000;
            color: #fff;
            margin: 15px;
        }

        h1 {
            font-size: 3em;
            line-height: 1.5em;
            margin-bottom: 26px;
            font-weight: bolder;
        }

        .wrapper {
            border: 10px solid #ee4444;
            background:yellow;
            color:red;
            margin: 20vh auto 0;
            padding: 20px 5px 40px 5px;
            max-width: 500px;
            text-align:center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>网站防火墙</h1>
        <p>系统已拦截本次请求</p>
        <p>可能的原因是本次请求带有不合法数据</p>
        <p>您的IP:<b>【{ip}】</b>已被记录</p>
    </div>
</body>

</html>
str;
        return str_ireplace(['{ip}'], [$this->getClientIP()], $html);
    }
}
