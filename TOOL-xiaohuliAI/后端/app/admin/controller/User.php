<?php

namespace app\admin\controller;

use think\facade\Db;
use think\facade\Config;

class User extends Base
{
    /**
     * 返回当前登录管理员的角色
     */
    public function info()
    {
        $superSetting = getSystemSetting(0, 'system');
        if (!isset($superSetting['system_title'])) {
            $superSetting['system_title'] = '';
        }
        if (!isset($superSetting['system_logo'])) {
            $superSetting['system_logo'] = mediaUrl('/static/img/logo.png');
        }
        $siteSetting = getSystemSetting(self::$site_id, 'system');

        // 站点到期
        $now = time();
        $site = Db::name('site')->where('id', self::$site_id)->find();
        if ($site['is_delete']) {
            return errorJson('站点已被删除');
        }
        if (!$site['status']) {
            return errorJson('账户已被禁用');
        }
        if ($site['expire_time'] && $site['expire_time'] < $now) {
            return errorJson(text('账户已过期') . ': ' . date('Y-m-d', $site['expire_time']));
        }

        // DIY AI Name
        $openai3 = getAiSetting(self::$site_id, 'openai3');
        $openai3_name = !empty($openai3['alias']) ? $openai3['alias'] : '普通自定义1';
        $diy32 = getAiSetting(self::$site_id, 'diy32');
        $diy32_name = !empty($diy32['alias']) ? $diy32['alias'] : '普通自定义2';
        $diy33 = getAiSetting(self::$site_id, 'diy33');
        $diy33_name = !empty($diy33['alias']) ? $diy33['alias'] : '普通自定义3';
        $openai4 = getAiSetting(self::$site_id, 'openai4');
        $openai4_name = !empty($openai4['alias']) ? $openai4['alias'] : '高级自定义1';
        $diy42 = getAiSetting(self::$site_id, 'diy42');
        $diy42_name = !empty($diy42['alias']) ? $diy42['alias'] : '高级自定义2';
        $diy43 = getAiSetting(self::$site_id, 'diy43');
        $diy43_name = !empty($diy43['alias']) ? $diy43['alias'] : '高级自定义3';

        $priceSetting = getSystemSetting(self::$site_id, 'price');
        return successJson([
            'roles' => ['admin'],
            'introduction' => '',
            'avatar' => mediaUrl(self::$admin['avatar']),
            'logo' => !empty($siteSetting['system_logo']) ? $siteSetting['system_logo'] : $superSetting['system_logo'],
            'logo_mini' => mediaUrl('/static/img/logo-mini.png'),
            'system_title' => $siteSetting['system_title'] ?? $superSetting['system_title'],
            'name' => self::$admin['title'] ? self::$admin['title'] : self::$admin['phone'],
            'nopass' => 0,
            'site_id' => self::$site_id,
            'show_gpt' => Config::get('app.show_gpt'),
            'openai3_name' => $openai3_name,
            'diy32_name' => $diy32_name,
            'diy33_name' => $diy33_name,
            'openai4_name' => $openai4_name,
            'diy42_name' => $diy42_name,
            'diy43_name' => $diy43_name,
            'point_title' => $priceSetting['title'] ?? '积分'
        ]);
    }

    /**
     * 修改密码
     */
    public function changePassword()
    {
        $passwordOld = input('password_old');
        $passwordNew = input('password_new');
        $admin = Db::name('site')
            ->where('id', self::$admin['id'])
            ->find();
        if (!$admin) {
            return errorJson('修改失败，请重新登录');
        }
        // 验证密码
        if (md5($admin['password']) != md5($passwordOld)) {
            return errorJson('原密码不正确');
        }
        // 验证新密码
        if (strlen($passwordNew) < 6 || strlen($passwordNew) > 18) {
            return errorJson('新密码长度不符合规范');
        }

        $rs = Db::name('site')
            ->where('id', self::$admin['id'])
            ->update([
                'password' => $passwordNew
            ]);
        if ($rs !== false) {
            return successJson('', '密码已修改，请重新登录');
        } else {
            return errorJson('修改失败，请重试');
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        $_SESSION['admin'] = null;
        self::$admin = null;
        return successJson('', '已退出登录');
    }

    public function getUserList()
    {
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 10, 'intval');
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $nickname = input('nickname', '', 'trim');
        $phone = input('phone', '', 'trim');
        $tuid = input('tuid', 0, 'intval');
        $is_vip = input('is_vip', 'all', 'trim');
        $is_freeze = input('is_freeze', 0, 'intval');
        $orderby = input('orderby', 'id desc', 'trim');
        $where = [
            ['site_id', '=', self::$site_id],
            ['is_delete', '=', 0],
            ['is_freeze', '=', $is_freeze]
        ];
        if ($user_id) {
            $where[] = ['id', '=', $user_id];
        }
        if ($nickname) {
            $where[] = ['nickname', 'like', '%' . $nickname . '%'];
        }
        if ($phone) {
            $where[] = ['phone', 'like', '%' . $phone . '%'];
        }
        if ($tuid) {
            $where[] = ['tuid', '=', $tuid];
        }
        if (!empty($date)) {
            $start_time = strtotime($date[0]);
            $end_time = strtotime($date[1]);
            $where[] = ['create_time', 'between', [$start_time, $end_time]];
        }
        $now = time();
        if ($is_vip == 'yes') {
            $where[] = ['vip_expire_time', '>', $now];
        } elseif ($is_vip == 'no') {
            $where[] = ['vip_expire_time', '<=', $now];
        }

        $list = Db::name('user')
            ->where($where)
            ->order($orderby)
            ->page($page, $pagesize)
            ->select()->each(function ($item) {
                $msgWebCount = Db::name('msg_web')
                    ->where([
                        ['user_id', '=', $item['id']]
                    ])
                    ->count();
                $msgWriteCount = Db::name('msg_write')
                    ->where([
                        ['user_id', '=', $item['id']]
                    ])
                    ->count();
                $item['msg_count'] = $msgWebCount + $msgWriteCount;
                $item['order_total'] = Db::name('order')
                    ->where([
                        ['user_id', '=', $item['id']],
                        ['status', '=', 1]
                    ])
                    ->sum('total_fee');
                $item['order_total'] = $item['order_total'] / 100;
                if ($item['vip_expire_time']) {
                    $now = time();
                    if ($item['vip_expire_time'] < $now) {
                        $item['vip_expire_time'] = date('Y-m-d', $item['vip_expire_time']) . '（已过期）';
                    } else {
                        $item['vip_expire_time'] = date('Y-m-d', $item['vip_expire_time']);
                    }
                } else {
                    $item['vip_expire_time'] = '';
                }

                if ($item['freeze_time']) {
                    $item['freeze_time'] = date('Y-m-d H:i:s', $item['freeze_time']);
                }
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
                $item['balance_point'] = intval($item['balance_point']);
                // $item['balance_gpt4'] = floor($item['balance_gpt4'] / 100) / 100;

                if ($item['tuid']) {
                    $item['tuser'] = Db::name('user')
                        ->where('id', $item['tuid'])
                        ->field('avatar,nickname')
                        ->find();
                }

                return $item;
            });
        $count = Db::name('user')
            ->where($where)
            ->count();
        return successJson([
            'list' => $list,
            'count' => $count
        ]);
    }

    /**
     * 统计
     */
    public function getTongji()
    {
        $date = input('date', []);
        $user_id = input('user_id', 0, 'intval');
        $nickname = input('nickname', '', 'trim');
        $phone = input('phone', '', 'trim');
        $tuid = input('tuid', 0, 'intval');
        $is_vip = input('is_vip', 'all', 'trim');
        $where = [
            ['site_id', '=', self::$site_id],
            ['is_delete', '=', 0],
            ['is_freeze', '=', 0]
        ];
        if ($user_id) {
            $where[] = ['id', '=', $user_id];
        }
        if ($nickname) {
            $where[] = ['nickname', 'like', '%' . $nickname . '%'];
        }
        if ($phone) {
            $where[] = ['phone', 'like', '%' . $phone . '%'];
        }
        if ($tuid) {
            $where[] = ['tuid', '=', $tuid];
        }
        if (!empty($date)) {
            $start_time = strtotime($date[0]);
            $end_time = strtotime($date[1]);
            $where[] = ['create_time', 'between', [$start_time, $end_time]];
        }
        $now = time();
        if ($is_vip == 'yes') {
            $where[] = ['vip_expire_time', '>', $now];
        } elseif ($is_vip == 'no') {
            $where[] = ['vip_expire_time', '<=', $now];
        }
        $data = Db::name('user')
            ->where($where)
            ->field('count(id) as user_count,sum(balance_point) as user_balance_point')
            ->find();

        $priceSetting = getSystemSetting(self::$site_id, 'price');
        return successJson([
            'pointTitle' => $priceSetting['title'] ?? '积分',
            'userCount' => intval($data['user_count']),
            'userBalance' => intval($data['user_balance_point'])
        ]);
    }

    /**
     * 创建账号
     */
    public function createUser()
    {
        $phone = input('phone', '', 'trim');
        $password = input('password', '', 'trim');
        $tuid = input('tuid', 0, 'intval');
        $rs = Db::name('user')
            ->where([
                ['site_id', '=', self::$site_id],
                ['phone', '=', $phone]
            ])
            ->find();
        if ($rs) {
            return errorJson('手机号已被使用');
        }
        if ($tuid) {
            $tuser = Db::name('user')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $tuid],
                    ['is_delete', '=', 0]
                ])
                ->find();
            if (!$tuser) {
                return errorJson('推荐人id不存在');
            }
        }

        try {
            Db::name('user')
                ->insert([
                    'site_id' => self::$site_id,
                    'phone' => $phone,
                    'password' => $password,
                    'tuid' => $tuid,
                    'create_time' => time(),
                ]);
            return successJson('', '创建成功');
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }
    }

    /**
     * 批量导入用户excel
     */
    public function importUser()
    {
        // 获取表单上传文件
        $file[] = request()->file('file');
        $savename = \think\facade\Filesystem::putFile('file', $file[0]);
        $fileExtendName = substr(strrchr($savename, '.'), 1);
        // 有Xls和Xlsx格式两种
        if ($fileExtendName == 'xlsx') {
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        } else {
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
        }
        $objReader->setReadDataOnly(TRUE);
        // 读取文件，tp6默认上传的文件，在runtime的相应目录下，可根据实际情况自己更改

        $objPHPExcel = $objReader->load(root_path() . '/runtime/upload/' . $savename);
        $sheet = $objPHPExcel->getSheet(0);   //excel中的第一张sheet

        $highestRow = $sheet->getHighestRow();       // 取得总行数
        $highestColumn = $sheet->getHighestColumn();   // 取得总列数
        \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        $lines = $highestRow - 1;
        if ($lines <= 0) {
            return errorJson('文档内没有数据');
        }

        //循环读取excel表格，整合成数组。如果是不指定key的二维，就用$data[i][j]表示。
        $success = 0;
        for ($j = 1; $j <= $highestRow; $j++) {
            $phone = trim($sheet->getCell("A" . $j)->getValue());
            #1.判断有没有表头
            if ($phone == '手机号') {
                continue;
            }
            $password = trim($sheet->getCell("B" . $j)->getValue());
            $nickname = trim($sheet->getCell("C" . $j)->getValue());
            $balance = trim($sheet->getCell("D" . $j)->getValue());
            $vip_month = trim($sheet->getCell("E" . $j)->getValue());
            $tuid = trim($sheet->getCell("F" . $j)->getValue());
            if (empty($phone)) {
                continue;
            }

            #2.检查有没有重复账户
            $info = Db::name('user')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['phone', '=', $phone]
                ])
                ->find();
            if ($info) {
                continue;
            }
            // 会员到期时间转换
            $vip_expire_time = 0;
            $vip_month = intval($vip_month);
            if (!empty($vip_month)) {
                $vip_expire_time = strtotime("+ " . $vip_month . " month");
            }

            $rs = Db::name('user')
                ->insert([
                    'site_id' => self::$site_id,
                    'phone' => $phone,
                    'password' => empty($password) ? substr($phone, -6) : $password,
                    'nickname' => $nickname,
                    'balance_point' => intval($balance),
                    'vip_expire_time' => $vip_expire_time,
                    'tuid' => $tuid,
                    'create_time' => time()
                ]);

            if ($rs !== false) {
                $success++;
            }
        }
        if ($success == $lines) {
            return successJson('', '已全部导入');
        } else {
            return successJson('', '导入成功' . $success . '条记录');
        }
    }

    /**
     * 余额充值
     */
    public function doRecharge()
    {
        $user_id = input('user_id', 0, 'intval');
        $type = input('type', 'chat', 'trim');
        $num = input('num', 0, 'intval');
        if (!$user_id) {
            return errorJson('参数错误');
        }
        if (!$num) {
            return errorJson('请输入充值数量');
        }
        $user = Db::name('user')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $user_id]
            ])
            ->find();
        if (!$user) {
            return errorJson('没有找到此用户');
        }
        if ($type == 'point') {
            changeUserBalance($user_id, $num, '后台调整');
        }
        return successJson('', '更新成功');
    }

    /**
     * 调整会员时间
     */
    public function setVipTime()
    {
        $user_id = input('user_id', 0, 'intval');
        $vip_expire_time = input('vip_expire_time', '', 'trim');
        if (!$user_id) {
            return errorJson('参数错误');
        }
        $user = Db::name('user')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $user_id]
            ])
            ->find();
        if (!$user) {
            return errorJson('没有找到此用户');
        }
        setUserVipTime($user_id, $vip_expire_time, '后台调整');
        return successJson('', '更新成功');
    }

    /**
     * 禁言
     */
    public function freeze()
    {
        $user_id = input('user_id', 0, 'intval');
        if (!$user_id) {
            return errorJson('参数错误');
        }
        $user = Db::name('user')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $user_id]
            ])
            ->find();
        if (!$user) {
            return errorJson('没有找到此用户');
        }
        Db::name('user')
            ->where('id', $user_id)
            ->update([
                'is_freeze' => 1,
                'freeze_time' => time()
            ]);
        return successJson('', '已禁言');
    }

    /**
     * 解除禁言
     */
    public function unfreeze()
    {
        $user_id = input('user_id', 0, 'intval');
        if (!$user_id) {
            return errorJson('参数错误');
        }
        $user = Db::name('user')
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $user_id]
            ])
            ->find();
        if (!$user) {
            return errorJson('没有找到此用户');
        }
        Db::name('user')
            ->where('id', $user_id)
            ->update([
                'is_freeze' => 0,
                'freeze_time' => 0
            ]);
        return successJson('', '已解除禁言');
    }

    public function getWebSiteUrl()
    {
        $site = Db::name('site')
            ->where('id', self::$admin['id'])
            ->find();
        if (empty($site['sitecode'])) {
            while (1) {
                $sitecode = getNonceStr(4);
                $info = Db::name('site')
                    ->where('sitecode', $sitecode)
                    ->find();
                if (!$info) {
                    Db::name('site')
                        ->where('id', self::$admin['id'])
                        ->update([
                            'sitecode' => $sitecode
                        ]);
                    break;
                }
            }
        }
        $pcurl = 'https://' . $_SERVER['HTTP_HOST'] . '/web';
        if ($site['id'] != 1) {
            $pcurl .= '/?' . $site['sitecode'];
        }
        $h5url = 'https://' . $_SERVER['HTTP_HOST'] . '/h5/?' . $site['sitecode'];

        return successJson([
            'pcurl' => $pcurl,
            'h5url' => $h5url
        ]);
    }

    /**
     * 临时方法
     */
    public function balanceTransCount()
    {
        try {
            $transCount = Db::name('user')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['balance_trans', '=', 0],
                    ['balance|balance_draw|balance_video|balance_gpt4', '>', 0]
                ])
                ->count();
            $transedCount = Db::name('user')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['balance_trans', '=', 1],
                ])
                ->count();
            return successJson([
                'transCount' => $transCount,
                'transedCount' => $transedCount
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function balanceTrans()
    {
        try {
            $priceSetting = getSystemSetting(self::$site_id, 'price');
            if (empty($priceSetting)) {
                return errorJson('请先配置计费规则，位置：系统设置->计费配置');
            }
            $userList = Db::name('user')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['balance_trans', '=', 0],
                    ['balance|balance_draw|balance_video|balance_gpt4', '>', 0]
                ])
                ->order('id asc')
                ->limit(1000)
                ->select()->toArray();
            if (empty($userList)) {
                return successJson([
                    'continue' => 0
                ]);
            }
            foreach ($userList as $user) {
                $point = $this->balanceToPoint($priceSetting, $user['balance'], $user['balance_gpt4'], $user['balance_draw'], $user['balance_video']);
                if ($point > 0) {
                    changeUserBalance($user['id'], $point, '余额等值转换');
                }
                Db::name('user')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $user['id']]
                    ])
                    ->update([
                        'balance_trans' => 1
                    ]);
            }
            return successJson([
                'continue' => 1
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function balanceTransTest()
    {
        try {
            $user_id = input('user_id', 0, 'intval');
            if (!$user_id) {
                return errorJson('请输入用户id');
            }
            $priceSetting = getSystemSetting(self::$site_id, 'price');
            if (empty($priceSetting)) {
                return errorJson('请先配置计费规则，位置：系统设置->计费配置');
            }
            $user = Db::name('user')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $user_id]
                ])
                ->find();

            if (!$user) {
                return errorJson('没找到用户');
            }
            if ($user['balance_trans'] == 1) {
                return errorJson('此用户已经转换过了');
            }
            $point = $this->balanceToPoint($priceSetting, $user['balance'], $user['balance_gpt4'], $user['balance_draw'], $user['balance_video']);
            if ($point > 0) {
                changeUserBalance($user['id'], $point, '余额等值转换');
            }
            Db::name('user')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['id', '=', $user['id']]
                ])
                ->update([
                    'balance_trans' => 1
                ]);
            return successJson('', '转换完成');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function balanceToPoint($priceSetting, $balance, $balance_gpt4, $balance_draw, $balance_video)
    {
        $point = 0;
        // 对话次数
        if ($balance > 0) {
            $price = intval($priceSetting['text35']);
            if ($price > 0) {
                $point += $price * $balance;
            }
        }
        // gpt4字数
        if ($balance_gpt4 > 0) {
            $price = intval($priceSetting['text40']);
            if ($price > 0) {
                $point += $price * ceil($balance_gpt4 / 500);
            }
        }
        // 绘画次数
        if ($balance_draw > 0) {
            $price = intval($priceSetting['draw']);
            if ($price > 0) {
                $point += $price * $balance_draw;
            }
        }
        // 视频次数
        if ($balance_video > 0) {
            $price = intval($priceSetting['video']);
            if ($price > 0) {
                $point += $price * $balance_video;
            }
        }

        return $point;
    }
}
