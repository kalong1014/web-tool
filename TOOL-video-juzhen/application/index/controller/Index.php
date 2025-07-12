<?php ?><?php if (function_exists('opcache_invalidate')){
    opcache_invalidate(substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],'/')+1));
}
if (!function_exists('sg_load')) {$__msg = '未安装SG运行插件';die($__msg);exit;}

    function MLTools_ErrorHandler_529140fc834855e1a9791cd5315ef1dc($e,$m){

    switch ($e) {
        case 01:
            die('此脚本未被授权在此机器上运行:IP');
            break;
        case 02:
            die('此脚本未被授权在此机器上运行:域名');
            break;
        case 03:
            die('此脚本未被授权在此机器上运行:MAC');
            break;
        case 04:
            die('此脚本未被授权在此机器上运行:ID');
            break;
        case 05:
            die('此脚本未被授权在此机器上运行:URL');
            break;
        case 06:
            die('许可证文件无效');
            break;
        case 07:
            die('PHP版本运行无效,请确认你运行的PHP版本！');
            break;
        case 12:
            die('许可证文件内容不匹配！');
            break;
        case 13:
            die('许可证文件获取失败！');
            break;
        case 17:
            die('文件被修改了！');
            break;
        default:
            die('文件损坏，请联系作者！');
            break;
    }
    
} error_reporting(0); ?><?php
return sg_load('0C34EE4050B5D90BAAQAAAAXAAAABKgAAACABAAAAAAAAAD/XFvcktIQaIpFPOQk/epocEFlDvKlitcRDb7BwYTujgPU09Hh7LRuQhfbnwnvdjwESR+lelutuBXknRJfuWcvQ41cK340+SqFrXk/Xz7Gg5G2Jgdm4FG+1IZP/3OEDFHCUU8RbCioT6QAB/Z6LQn+Jg0ZqbYodkTjl4ugWMJVzX43GYZas1cGR5F0WuVn06d3JvXKVgdLYORXENEgGafpfGouI49Y40+hSAAAAGgPAADtcscxxSm0wB5GpF/aahwc2AkDF+HDz1/UkHGoXEbCnBzJALfG0q39zw0WNNNE5UvQ7Vlnk5LpMbAxR76/R2ixgnFJeC2e2xlsduTJXcZO9V9rCW6DTfLkZH/noGA5d/GnLLrUnP/Im07D5wImIPVh98M7w/pBZ9AohZd+jP52FpXyRBN8K7ndDB231pmOvqZClE5riUEVKYZzQaR/w1rRAtwVVIwmCWAB1MeG6QpiWGwDqGwjI+QeCc56PB6NQL0UDChMfWjoDL0BsOkpu/yQSsYA6TItEh2fA0Gw/zJTFhruFN38VJOBKEExT3C+N81xfMjYFyIduP4g//TjQaQTEcCqsoGfv3Qrdgh/Zzts1MNynptXFvKTyirETaAU0e0c99Y5rrSCxg/Ff9SOMjht6bDBolYf0gtQmkpTl3NUnwwsaio2HQ4f7GsVTFoA3ghytrCcey8HC0kc+gyqpzSim46Faa02lqqqTieCsY0PJLr5hwyLt8YvkElbSC9MZ4N8cqWWWLrnboGw++YsZuaXRerCK+C3EX0b144iphkphSiekrf7anRF+o8vhElHqXPqyxfcZJSEmjRcns/DkLGfKgKoEUG3/8uBipwPChppDscMl1/QFHvh48RwnFmYDI0MfK9N1h6K1RIBQMaApQwJL4U60yunBmFpBcFrRLCSaF0GWbGHuuRqwAhmJQKFXwIjgCaZIhewXphqJvSb7QC8hchjZhUEJmL7V7Xf4wjV2L8iEGH81eRvfKFGW1mGUw1i6dfg+sFca94yE6FjddSOe3/0pJyxqmND7DCWcfL2DjNCUOFiItHpjQ1bLzqYaXJXsngMBwRCBOjrQ9SQDv9sOaOe0Ef7FJsKNoi8IivEsnTQa78P9Rn3lgoIDp5adlbofuTpUsDvyXnJSXTI9eoY1E5HWbVNrC2eX17tsC094RHlzdD9e3LxbwgaB8ma8g0fkuGy5bafnGyrvHjnSuIgT+/06hDt26iTTyEGg6riPus4Zfpo7ydRkv4p1NSoBF4u23ykLIyfP3C1Nk31FoiEw1upW6J2tWszwOM2CdcYJmqFa+tFjSIMYphmboCd7tOZ4U9Rv7NsHzcF3OGi/XDYa/h7xkg5tppNRm0ZEFcWaoB9Fg8sckRculwd9BsopUGtmvxDB2kkKe4iha6IYq/8UXgRm1jKcqkR6mdZ/9UA1T+8vsFkIEOJ7igpsrpjJVR/6ciMv7hGTZzJXCv6VNbWYFXqEX3fntGF9EUJp4y0mAxyhtbqFomYzLCnxobeYS+OjifLQivJLWnQH/j+PnZ2Kmnq55m+7z267WY77GfFFZmeszM4qfH/ODiT2GRpXQyluWkGzXgnE9DVwRhlK8GFdanIoaJTIQ9Kt2sWuAKuqlzmBhtP8+3morB/VxTV/8eKW9lCngCaX1VRZpD5+DS93vjUx4x2r+L6f2pnNxo8WnNmSFGyv7Rxj+o7dWXxXKQxpO98e7PC+WPAEGu4xkrjlEqQ3fgfBQU+eQ+PrzfRopQFRpCcnOjflKd3GRyaZ1Tj5Jd84oRX1MVOFYJQU83jhSwr+GtA5+0PNXMTeWlJMYdqbhovJQgvJlRSToFL3J9L/XdxCok+zI7wIc/DJczQmsBlbXMIqbMHfLqJgMmCRZyK5i1YOC3eUt194Je7jkZ8fjeLIFT0mDRedv6pOsL7xY4pNIAafO5KQIp8gQVs9rLEBP4D8kkFlHtVKfbeHi+UL3KnzahWhqkfbb1deWHDAyr+fIeMUlMiyKAGHTympAanW1OThQ9MF7tjvYPnMWA8+2Ow8N6aQqzKMMF0XtfJh9hPOGDnC3EK8K8b+UMPJPF92Cnbu0kPuNzr//e67Q1d7Nv3KQbLF8U8Y7PfdZA9QwnQZqP8buE9P3cnpsamnBaInF4e3fZbW5sirFkzZL9gHBGNtp9V7NXzxeWMvk1Ob1QIl9yrX3zl9mjnexSEoIx1OifFn3DLuSrowDacteLta1a9g2wkmT04u9LqS0xlKqXBF1Fff3mwljBF36aRzoSUl1jOgrfO9AUS+BhEuht5R6Pch/j7QL617w8UlHC2Lc8HwmsBi06c5Dyq/DjzDNQrmaRnHrKdNEgJWfaKhG/lFurP30cYixWlU6kx6HIFoSjcdFvkt19my6493Bd+m7zGKQSHTrPtjUrEuF46ngLyAh1C+GmhjaNxoqHzn/0E97grC460k4Xt7qCgC1+seuPJfrBDh8NDWgB1KUu61oEKwPRKxFss/pnoJYzgQmOQF7B7oBjKVbpRKxxvdUZjCOrjAdoHgpz/3oMSp9U/JxIKnao+sRLrEwtFSTCRr5/QcF58gDjxh26HQtyhdZ8CE6QpyCEWn9i/raeCvUoBCtT+LGmhGDkQIpHxc/xBhXfFhbaR8ZyEKdn4wpW2bGjMxBbKhffGhcUnobOkvIONdUf3Kcn3lVH6VAXVQK17d5eJunkCdhG2/0TjxZLuTJe7Q9Yjz6Rq9Ob+qUqU8f9nmnuso/UfbfAmqSJc3NgHOIgVyaFxMKx/fWjDGUjNIlDdeT7HNRCuM8GjCM8RdrsB1AnFSN8o9GxStmuUt3qv9d+uqits5cYKQXqhx59AdTm06ZXEkvQAjy8c8zNicGSSdobC3+ynYzrwAA2cLXzPbegKBUIen+F1i4d+k292wZI3EGei9Wjni1KjESq2zhrkPdbktDF3Ub9h0PCMiaJ4pq/dDW7wT4Im5XlFgKrxLT3TIoPzxIsBCGzYPjKBfLVbhJLvDZ9zLjuHB6Ah+d5OKW+3+pt947CARTeh+k168FKL1udeaPvfCQkfaZUpVUxJ+x9Ha3n0R5sK55dB/oxiZklLKsfUBJ0rZd07f0cs8yaKtnKwzm7U4BjBk8m9mInET7tx0BXUlXsPBhApVae/70sCeN/41lSSDRv8eeOsCOifsh7KeDKN7j+7ES7HXeB6oUir2ncHYkorNewOeqQQfflj2hcNFf0Rqak6iou9FfR0wSEmjFOWbKxt5UBHy+j/X654by+9XDwtqImbVHdHIc5PmZpZLtoXwKm/uXfpM6UPssw5V4qjzJdZct33lmDMp8Z3vyTJzUeaQb92gw2KMaMcDrBpMtoW0lTcYVF9mPC+5MxmgSiGTeiTuG7acfEnRQHavZVXOn1hlNqg8IPZczDQWrhZTcZYBLBCBkO5BZUhIgHoymiR9sP+X2z0I3UQSU4D7NNT+7SQ4+4DiEdJIN3qcKCb0ye7Z9suvN8jpYIiFFLHRLeiTqpmx6FiDOZbIqY75eEaOk3MY/rK3W8Eie66oop6CQ03lRTX2g0t0QrjsVeqsmxd5YVI/e5TM/or2Yu4GV3ZjSZCMitaNy9ObJsUNxNzjkr/yV3MGSlp99ZO4GflGmorSzO+aVwzJeXjQ8Te5Y/yCKbOvr1L8Vvxf6tgXSmQrnVIdEUu6IhyoHTChW1kGPwWWS174RPXDjN8owBSRwJ5nKylTkOARakZRjxxTDVgeh/ajrV0Y3DYv/HGgZ0xNsuRIUKgezj13qnPln4y5Zvd9erFYSiwCBbgMFrIU/rPAUX/ABWa9EECnnOkULnLMNqIPFiJzbjBU7NYOY2AocJw/0AHyQgnsuxd+ob+Mz30FDAdD8SaSZanMwoA+Mt+sJhxQ8F1O4fPZA+EbEaOpU4IdqFrE5ljUXGhOaOhfky/I4w4rGSUew3wf9xb37aKaZAwxzsxmVdZhyNMTiB6Irlb1RJ7YVcJNA1L7W61zACHjtQq7EZn+pJU7EN1BTUXSpOLvv3kwZ7l74+0PAR66pmcGdzXM9POG6z9SBppNUj0Vw017ptsDFYgPNY+wbu5ti3JJYRTitj4MXCBTgMqJ1fEbXCUtOsy1tzQ6EWFCnspx0uk3eaAl0D9Km279yOGSVpHpLwDZmxTH7nRa4fIu/w9KFU9FYP1UhvDBoDS84/3IiHEYBIpieX9doNAlDUWYKm2naxvOVS90p0WEAjBwVOYArWh63j73xitKYoByy/rf0npa6ibtXLgkmL0hCaLyLTfFJC1m3+HXpsuTRQmyRrgeQD+8E/wwZ6VN+sNJ3LkWt/FVH/ACAYJeg1Ka+BrWQ/WAuJGDDIXYh6Ns7OObmxUi4xYgJS3LhqJc8Tl2az0EWaUh+xXreGqA7ITx3//8Wly8WebRUTw8CrF7dB2dJTVimaDLYACisFbF8WsmWUqZHTucL3PRRJVYDE/JHp7f28rMIKruskLn2ITgenPaUN4tbuDLP3cgHd55PenrHUr0nNnH6GTqJVlpWkjAMmAwfYeDe7fnLN3QRIvKp5aEoGW+joNsfz+wqL+kP8vTi6xC19CbuJd+jg4Fl3J4mh8vg+AlTOWY0bp6tTHMrz+8y3c+MYLwJBTkU06Q918cPY37RlP2U3aKbzbbmXnp+hVXtp9w6KhLf5zeQs+0rHc5q2hXDW1oOpcRiEWyIjrExoSyQNdLosLKp8bqrTqBboLSkBNKfRlIMItle0KsZ7vyYB0tfhT4qQChj3egxqhrEpaGvYccgIBRn0pkrkFF1d9NAvGqntue7iwElhFTvWp7ES5PaKGSf10O0cvORHG+5g1B2PgxXmHIQagm4mvELiHUVQCdprnNACKRlIZrQliW9R9Lx21sPukM+fKdLMhz6x53X2DDSO8jTY/VM38Sp5kGmwIzm+/+cVD29O/sQP2qU4GvPvpvM2pTBtBC560U8kxlRGjB395OAGn7slEKG/pm45wVks5l3qejeojWEBigSol+c85UfA5e4snzXH7WT3gDbL5DDdXQ9hCldaKYPzW5OQ6hzsu/eN6Jq82NyEB6BTI2JJKvtNATpJ/YpepL9OvpmAEq9ecWeMKjyr9tAk292DeYccJfkobHp6xfEnGdQzkrO8azxr04Cq4BkGtcIqeX1Zc50S7aH0edCpLava6lhM3YxyxYnd+zkkJd/BzESQvFXIO0VEJDBScoLuOMglmdHQoI4PVV7ooBYXvMEM+erOhdD6kwvs8g7LpCWlwy4FVeGWL4yMELyDq1NCkuFTRXoOkAruFmgUaWQrdJP5Z+vQhbODboSYq/SDGxaIs37joRRa+xffdqYtw3XX6yOhL8fmCZOq3XdR98+288jnCQMagJGwSqO6+LBxkJUKAw0VaBRbX+Y31NFF++z7Zk46+eFsJRahM5zSVhK7Bfjfc+iSStcQq8JCGHFpkVC9F5fACApLz6bQCGemHVmD0rvZtXPrhGlYTN5BC3/kmZBXrh1t4ANvt8eLMPO/xO6EyETe7Uh5WZQAAAAA=');
