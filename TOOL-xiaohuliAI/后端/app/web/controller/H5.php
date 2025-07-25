<?php

namespace app\web\controller;

use think\facade\Config;
use think\facade\Db;
use think\facade\Request;
use Wxpay\v2\JsApiPay;
use Wxpay\v2\lib\WxPayApi;
use Wxpay\v2\lib\WxPayUnifiedOrder;
use Wxpay\v2\WxPayConfig;

class H5 extends Base
{
    public function checkLogin()
    {
        return successJson();
    }

    public function getSetting()
    {
        // 系统配置
        $show_gpt = Config::get('app.show_gpt');

        $setting = Db::name('setting')
            ->where('site_id', self::$site_id)
            ->find();
        $h5Setting = empty($setting['h5']) ? [] : json_decode($setting['h5'], true);
        $drawSetting = empty($setting['draw']) ? [] : json_decode($setting['draw'], true);
        $videoSetting = empty($setting['video']) ? [] : json_decode($setting['video'], true);
        $musicSetting = empty($setting['music']) ? [] : json_decode($setting['music'], true);
        $speechSetting = empty($setting['speech']) ? [] : json_decode($setting['speech'], true);
        $loginSetting = empty($setting['login']) ? [] : json_decode($setting['login'], true);
        $aiSetting = empty($setting['chatgpt']) ? [] : json_decode($setting['chatgpt'], true);
        $ai4Setting = empty($setting['gpt4']) ? [] : json_decode($setting['gpt4'], true);
        $priceSetting = empty($setting['price']) ? ['title' => '积分'] : json_decode($setting['price'], true);

        $page_title = $h5Setting['page_title'] ?? 'AI创作助手';
        // 绘画 - 功能开关
        $drawIsOpen = isset($drawSetting['is_open']) ? intval($drawSetting['is_open']) : 0;
        // 视频 - 功能开关
        $videoIsOpen = 0;
        if ((!empty($videoSetting['pika']) && $videoSetting['pika']['is_open']) || (!empty($videoSetting['runway']) && $videoSetting['runway']['is_open']) || (!empty($videoSetting['stable']) && $videoSetting['stable']['is_open']) || (!empty($videoSetting['sora']) && $videoSetting['sora']['is_open'])) {
            $videoIsOpen = 1;
        }
        // 音乐 - 功能开关
        $musicIsOpen = 0;
        if (!empty($musicSetting['suno']) && $musicSetting['suno']['is_open']) {
            $musicIsOpen = 1;
        }
        // 语音开关
        $speechIsOpen = isset($speechSetting['is_open']) ? intval($speechSetting['is_open']) : 0;
        // 登录开关
        $login_wechat = isset($loginSetting['login_wechat']) ? $loginSetting['login_wechat'] : 0;
        $login_phone = isset($loginSetting['login_phone']) ? $loginSetting['login_phone'] : 0;
        if (!$login_wechat && !$login_phone) {
            $login_wechat = 1;
        }

        $chatIsOpen = 1;
        $writeIsOpen = 1;
        $cosplayIsOpen = 1;
        $userIsOpen = 1;

        // gpt4配置
        $ai4Channel = [];
        $hasModel4 = 0;
        $model4Name = '';
        if (!empty($ai4Setting['is_open'])) {
            $hasModel4 = 1;
            $model4Name = '高级版';
            $ai4Channel = isset($ai4Setting['channel']) ? $ai4Setting['channel'] : [];
        }
        // 普通ai配置
        $aiChannel = isset($aiSetting['channel']) ? $aiSetting['channel'] : [];
        // 汇总成最终AI列表，显示到前端
        $aiChannel = array_merge($aiChannel, $ai4Channel);
        $aiList = [];
        $allAI = Db::name('ai')
            ->where('site_id', self::$site_id)
            ->find();
        if (empty($allAI)) {
            $allAI = [];
        }
        foreach ($aiChannel as $aiName) {
            if (!$show_gpt && isForeign($aiName)) {
                continue;
            }
            if (!empty($allAI[$aiName])) {
                $ai = @json_decode($allAI[$aiName], true);
                $aiList[] = [
                    'name' => $aiName,
                    'alias' => $ai['alias'] ?? $aiName
                ];
            }
        }

        return successJson([
            'page_title' => $page_title,
            'hasModel4' => $hasModel4,
            'model4Name' => $model4Name,
            'login_wechat' => $login_wechat,
            'login_phone' => $login_phone,
            'tabbar' => [$chatIsOpen, $writeIsOpen, $cosplayIsOpen, $drawIsOpen, $userIsOpen],
            'drawIsOpen' => $drawIsOpen,
            'videoIsOpen' => $videoIsOpen,
            'musicIsOpen' => $musicIsOpen,
            'aiList' => $aiList,
            'speechIsOpen' => $speechIsOpen,
            'priceSetting' => $priceSetting
        ]);
    }

    /**
     * 获取账户余额
     */
    public function getBalance()
    {
        $user = Db::name('user')
            ->where('id', self::$user['id'])
            ->find();
        $now = time();
        if ($user['vip_expire_time'] > $now) {
            $vip_expire_time = date('Y-m-d', $user['vip_expire_time']);
        } else {
            $vip_expire_time = '';
        }
        return successJson([
            'balance' => $user['balance'] ?? 0,
            'balance_draw' => $user['balance_draw'] ?? 0,
            'balance_model4' => floor($user['balance_gpt4'] / 100) / 100,
            'vip_expire_time' => $vip_expire_time
        ]);
    }

    /**
     * H5获取用户头像昵称
     */
    public function getProfile()
    {
        $code = input('code', '', 'trim');
        $wxmpConfig = getSystemSetting(self::$site_id, 'wxmp');
        $config = [
            'app_id' => $wxmpConfig['appid'] ?? '',
            'secret' => $wxmpConfig['appsecret'] ?? '',
            'response_type' => 'array',
            'debug' => false
        ];
        $app = \EasyWeChat\Factory::officialAccount($config);
        $oauth = $app->oauth;
        if (!$code) {
            $callback = Request::url(true);
            $response = $oauth->scopes(['snsapi_userinfo'])
                ->redirect($callback);
            $response->send();
            exit;
        } else {
            try {
                $user = $oauth->user()->toArray();
                Db::name('user')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', self::$user['id']]
                    ])
                    ->update([
                        'avatar' => $user['avatar'],
                        'nickname' => $user['nickname']
                    ]);
                header('location:/h5/#/pages/user/index');
                exit;
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * 获取h5分享参数
     */
    public function getShareInfo()
    {
        // 系统配置
        $h5Config = getSystemSetting(self::$site_id, 'h5');
        $loginSetting = getSystemSetting(self::$site_id, 'login');
        $page_title = $h5Config['page_title'] ?? 'AI创作助手';
        // 绘画 - 功能开关
        $drawSetting = getSystemSetting(self::$site_id, 'draw');
        $drawIsOpen = isset($drawSetting['is_open']) ? intval($drawSetting['is_open']) : 1;
        $chatIsOpen = 1;
        $writeIsOpen = 1;
        $cosplayIsOpen = 1;
        $userIsOpen = 1;
        $systemInfo = [
            'page_title' => $page_title,
            'login_wechat' => isset($loginSetting['login_wechat']) ? $loginSetting['login_wechat'] : 1,
            'login_phone' => isset($loginSetting['login_phone']) ? $loginSetting['login_phone'] : 0,
            'tabbar' => [$chatIsOpen, $writeIsOpen, $cosplayIsOpen, $drawIsOpen, $userIsOpen]
        ];
        // 分享配置
        $shareInfo = [];
        try {
            $url = input('url', '', 'trim');
            $wxmpSetting = getSystemSetting(self::$site_id, 'wxmp');
            $config = [
                'app_id' => $wxmpSetting['appid'] ?? '',
                'secret' => $wxmpSetting['appsecret'] ?? '',
                'response_type' => 'array'
            ];
            $app = \EasyWeChat\Factory::officialAccount($config);
            $apis = [
                'checkJsApi',
                'updateAppMessageShareData',
                'updateTimelineShareData',
                'chooseWXPay'
            ];
            if (strpos($url, '#') !== false) {
                $url = explode('#', $url)[0];
            }
            $app->jssdk->setUrl($url);
            $jssdkConfig = $app->jssdk->buildConfig($apis, false, false, false);
            $share_title = $h5Config['share_title'] ?? $page_title;
            $share_desc = $h5Config['share_desc'] ?? '';
            $share_image = $h5Config['share_image'] ?? '';
            $sitecode = Db::name('site')
                ->where('id', self::$site_id)
                ->value('sitecode');
            $share_link = 'https://' . $_SERVER['HTTP_HOST'] . '/h5/?' . $sitecode . '&tuid=' . self::$user['id'];

            $shareInfo = [
                'share_title' => $share_title,
                'share_link' => $share_link,
                'share_image' => $share_image,
                'share_desc' => $share_desc,
                'jssdk_config' => $jssdkConfig
            ];
        } catch (\Exception $e) {
            // 不用返回任何值
        }

        return successJson(array_merge($systemInfo, $shareInfo));
    }

    /**
     * 是否打开GPT4开关
     */
    public function hasModel4()
    {
        $hasModel4 = 0;
        $model4Name = '';
        $ai4Setting = getSystemSetting(self::$site_id, 'gpt4');
        if (!empty($ai4Setting['is_open'])) {
            $hasModel4 = 1;
            $aiName = is_string($ai4Setting['channel']) ? $ai4Setting['channel'] : $ai4Setting['channel'][0];
            $ai = getAiSetting(self::$site_id, $aiName);
            $model4Name = $ai['alias'] ?? '高级版';
        }

        return successJson([
            'hasModel4' => $hasModel4,
            'model4Name' => $model4Name
        ]);
    }

    /**
     * 获取任务配置
     */
    public function getTasks()
    {
        $share = getSystemSetting(self::$site_id, 'reward_share');
        $invite = getSystemSetting(self::$site_id, 'reward_invite');

        $tasks = [];
        $today = strtotime(date('Y-m-d'));
        if (!empty($share['is_open']) && !empty($share['max']) && !empty($share['num'])) {
            // 获取今日已分享次数
            $count = Db::name('reward_share')
                ->where([
                    ['user_id', '=', self::$user['id']],
                    ['create_time', '>', $today]
                ])
                ->count();
            $share['count'] = intval($count);
            $tasks['share'] = $share;
        }
        if (!empty($invite['is_open']) && !empty($invite['max']) && !empty($invite['num'])) {
            // 获取今日已邀请人数
            $count = Db::name('user')
                ->where([
                    ['tuid', '=', self::$user['id']],
                    ['create_time', '>', $today]
                ])
                ->count();
            $invite['count'] = intval($count);
            $tasks['invite'] = $invite;
        }

        $tasks = count($tasks) > 0 ? $tasks : null;

        return successJson($tasks);
    }

    public function createOrder()
    {
        $type = input('type', 'goods', 'trim');
        $goods_id = input('goods_id', 0, 'intval');
        if (!in_array($type, ['vip', 'goods', 'draw', 'gpt4', 'model4'])) {
            return errorJson('参数错误');
        }
        if ($type == 'model4') {
            $type = 'gpt4';
        }
        $dbName = $type;

        $goods = Db::name($dbName)
            ->where([
                ['site_id', '=', self::$site_id],
                ['id', '=', $goods_id]
            ])
            ->find();
        if ($goods['status'] != 1) {
            return errorJson('该套餐已下架，请刷新页面重新提交');
        }
        $total_fee = $goods['price'];
        $num = $goods['num'];

        $payConfig = getSystemSetting(self::$site_id, 'pay');
        $wxmp = getSystemSetting(self::$site_id, 'wxmp');
        $out_trade_no = $this->createOrderNo();
        $openid = self::$user['openid_mp'];

        // 推荐人信息
        $commission1 = 0;
        $commission1_fee = 0;
        $commission2 = 0;
        $commission2_fee = 0;
        $commissionSetting = getSystemSetting(self::$site_id, 'commission');
        if (!empty($commissionSetting['is_open'])) {
            $bili_1 = floatval($commissionSetting['bili_1']);
            $bili_2 = floatval($commissionSetting['bili_2']);

            $tuid = Db::name('user')
                ->where('id', self::$user['id'])
                ->value('tuid');
            if (!empty($tuid)) {
                $tuser = Db::name('user')
                    ->where('id', $tuid)
                    ->find();
                if ($tuser && $tuser['commission_level'] > 0) {
                    $commission1 = $tuid;
                    $commission1_fee = intval($total_fee * $bili_1 / 100);
                    if ($tuser['commission_pid']) {
                        $commission2 = $tuser['commission_pid'];
                        $commission2_fee = intval($total_fee * $bili_2 / 100);
                    }
                }
            }
        }

        Db::name('order')->insertGetId([
            'site_id' => self::$site_id,
            'goods_id' => $type == 'goods' ? $goods_id : 0,
            'draw_id' => $type == 'draw' ? $goods_id : 0,
            'gpt4_id' => $type == 'gpt4' ? $goods_id : 0,
            'vip_id' => $type == 'vip' ? $goods_id : 0,
            'user_id' => self::$user['id'],
            'openid' => $openid,
            'out_trade_no' => $out_trade_no,
            'transaction_id' => '',
            'total_fee' => $total_fee,
            'pay_type' => 'wxpay',
            'status' => 0, // 0-待付款；1-成功；2-失败
            'num' => $num,
            'commission1' => $commission1,
            'commission2' => $commission2,
            'commission1_fee' => $commission1_fee,
            'commission2_fee' => $commission2_fee,
            'create_time' => time()
        ]);

        try {
            $notifyUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/api.php/notify/wxpay';
            $input = new WxPayUnifiedOrder();
            $input->SetBody('订购商品');
            $input->SetOut_trade_no($out_trade_no);
            $input->SetTotal_fee($total_fee);
            $input->SetTime_start(date('YmdHis'));
            $input->SetTime_expire(date('YmdHis', time() + 600));
            $input->SetNotify_url($notifyUrl);
            $input->SetTrade_type('JSAPI');
            $input->SetMch_id($payConfig['mch_id']);
            $input->SetAppid($wxmp['appid']);
            $input->SetOpenid($openid);

            $WxPayApi = new WxPayApi();
            $config = new WxPayConfig();
            $config->SetAppId($wxmp['appid']);
            $config->SetMerchantId($payConfig['mch_id']);
            $config->SetKey($payConfig['key']);
            $config->SetSignType('MD5');
            $config->SetNotifyUrl($notifyUrl);

            $unifiedOrder = $WxPayApi->unifiedOrder($config, $input);
            if (isset($unifiedOrder['return_code']) && $unifiedOrder['return_code'] == 'FAIL') {
                return errorJson($unifiedOrder['return_msg']);
            } elseif (isset($unifiedOrder['err_code']) && !empty($unifiedOrder['err_code_des'])) {
                return errorJson($unifiedOrder['err_code_des']);
            }
        } catch (\Exception $e) {
            return errorJson(text('发起支付失败') . ': ' . $e->getMessage());
        }

        // 生成调起jsapi-pay的js参数
        $JsApiPay = new JsApiPay();
        if (isset($unifiedOrder['sub_appid'])) {
            $unifiedOrder['appid'] = $unifiedOrder['sub_appid'];
        }
        $jsApiParameters = $JsApiPay->GetJsApiParameters($config, $unifiedOrder);

        $jsApiParameters = json_decode($jsApiParameters, true);
        $jsApiParameters['out_trade_no'] = $out_trade_no;

        return successJson($jsApiParameters);
    }

    /**
     * 创建订单号
     */
    private function createOrderNo()
    {
        return 'Ch' . date('YmdHis') . rand(1000, 9999);
    }

    /**
     * 分享动作
     */
    public function doShare()
    {
        $way = input('way', 'wechat', 'trim');
        $today = strtotime(date('Y-m-d'));
        $count = Db::name('reward_share')
            ->where([
                ['user_id', '=', self::$user['id']],
                ['create_time', '>', $today]
            ])
            ->count();

        Db::startTrans();
        try {
            $setting = getSystemSetting(self::$site_id, 'reward_share');
            if (!empty($setting['is_open']) && !empty($setting['max']) && $count <= intval($setting['max']) && !empty($setting['num'])) {
                $reward_num = intval($setting['num']);
                changeUserBalance(self::$user['id'], $reward_num, '分享奖励');
            } else {
                $reward_num = 0;
            }
            $share_id = Db::name('reward_share')
                ->insertGetId([
                    'site_id' => self::$site_id,
                    'user_id' => self::$user['id'],
                    'way' => $way,
                    'reward_num' => $reward_num,
                    'create_time' => time()
                ]);
            Db::commit();
            return successJson([
                'share_id' => $share_id
            ]);
        } catch (\Exception $e) {
            Db::rollback();
            return errorJson(text('获取分享参数失败') . ': ' . $e->getMessage());
        }
    }
}
