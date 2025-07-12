<?php

namespace app\api\controller;

use Wxpay\v2\WxPayConfig;
use Wxpay\v2\lib\WxPayNotifyResults;
use think\facade\Db;

class Notify
{
    public function wxpay()
    {
        $xml = file_get_contents("php://input");
        // file_put_contents('./payResultWxpay.txt', "$xml\n\n", 8);
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        $result_code = $data['result_code'];
        $out_trade_no = $data['out_trade_no'];      // 商户订单号
        $transaction_id = $data['transaction_id'];  // 微信流水单号
        $time_end = $data['time_end'];              // 支付时间
        // $total_fee = $data['total_fee'];         // 交易金额

        // 验签
        $order = Db::name('order')
            ->where('out_trade_no', $out_trade_no)
            ->find();
        if (!$order || $order['status'] != 0) {
            self::wxpayAnswer('FAIL', '订单错误');
        }
        $payConfig = getSystemSetting($order['site_id'], 'pay');
        $config = new WxPayConfig();
        $config->SetKey($payConfig['key']);
        $Notify = new WxPayNotifyResults();
        $checkSign = $Notify->Init($config, $xml);

        if (!$checkSign) {
            self::wxpayAnswer('FAIL', '签名错误');
        }

        if ($result_code == 'SUCCESS') {
            Db::startTrans();
            try {
                // 改订单状态
                Db::name('order')
                    ->where('out_trade_no', $out_trade_no)
                    ->update([
                        'status' => 1,
                        'transaction_id' => $transaction_id,
                        'pay_time' => strtotime($time_end)
                    ]);
                if ($order['point_id']) {
                    // 加积分余额
                    changeUserBalance($order['user_id'], $order['num'], '充值');
                    // 加已售数
                    Db::name('point')
                        ->where('id', $order['point_id'])
                        ->inc('sales', 1)
                        ->update();
                } elseif ($order['vip_id']) {
                    // 加用户会员时长
                    $today = strtotime(date('Y-m-d 23:59:59', time()));
                    $user = Db::name('user')
                        ->where('id', $order['user_id'])
                        ->find();
                    $vip_expire_time = max($today, $user['vip_expire_time']);
                    $vip_expire_time = strtotime('+' . $order['num'] . ' month', $vip_expire_time);
                    Db::name('user')
                        ->where('id', $order['user_id'])
                        ->update([
                            'vip_expire_time' => $vip_expire_time
                        ]);
                    Db::name('user_vip_logs')
                        ->insert([
                            'site_id' => $order['site_id'],
                            'user_id' => $order['user_id'],
                            'vip_expire_time' => $vip_expire_time,
                            'desc' => '充值会员',
                            'create_time' => time()
                        ]);
                    // 加已售数
                    Db::name('vip')
                        ->where('id', $order['vip_id'])
                        ->inc('sales', 1)
                        ->update();
                }

                // 加分销余额
                if ($order['commission1'] && $order['commission1_fee'] > 0) {
                    $user = Db::name('user')
                        ->where('id', $order['commission1'])
                        ->find();
                    if($user && $user['commission_level'] > 0) {
                        Db::name('user')
                            ->where('id', $user['id'])
                            ->update([
                                'commission_money' => $user['commission_money'] + $order['commission1_fee'],
                                'commission_total' => $user['commission_total'] + $order['commission1_fee'],
                            ]);
                        Db::name('commission_bill')
                            ->insert([
                                'site_id' => $user['site_id'],
                                'user_id' => $user['id'],
                                'order_id' => $order['id'],
                                'title' => '用户下单佣金（直推）',
                                'type' => 1,
                                'money' => $order['commission1_fee'],
                                'create_time' => time()
                            ]);
                    }
                }
                if ($order['commission2'] && $order['commission2_fee'] > 0) {
                    $user = Db::name('user')
                        ->where('id', $order['commission2'])
                        ->find();
                    if($user && $user['commission_level'] > 0) {
                        Db::name('user')
                            ->where('id', $user['id'])
                            ->update([
                                'commission_money' => $user['commission_money'] + $order['commission2_fee'],
                                'commission_total' => $user['commission_total'] + $order['commission2_fee'],
                            ]);
                        Db::name('commission_bill')
                            ->insert([
                                'site_id' => $user['site_id'],
                                'user_id' => $user['id'],
                                'order_id' => $order['id'],
                                'title' => '用户下单佣金（间推）',
                                'type' => 1,
                                'money' => $order['commission2_fee'],
                                'create_time' => time()
                            ]);
                    }
                }


                Db::commit();
            } catch (\Exception $e) {
                Db::rollback();
                saveLog($order['site_id'], $e->getMessage() . ' | ' . $xml);
                self::wxpayAnswer('FAIL', '支付失败');
            }

            self::wxpayAnswer('SUCCESS', 'OK');
        } else {
            self::wxpayAnswer('FAIL', '支付失败');
        }
    }

    private static function wxpayAnswer($code = 'SUCCESS', $msg = 'OK')
    {
        echo '<xml><return_code><![CDATA[' . $code . ']]></return_code><return_msg><![CDATA[' . $msg . ']]></return_msg></xml>';
        exit;
    }

    public function lxai()
    {
        $data = file_get_contents("php://input");
        // file_put_contents('./lxai.txt', $data);
        $data = json_decode($data, true);
        if ($data['action'] == 'IMAGINE' || $data['action'] == 'UPSCALE' || $data['action'] == 'VARIATION') {
            $task_id = $data['id'];
            $draw = Db::name('msg_draw')
                ->where('task_id', $task_id)
                ->order('id desc')
                ->find();
            if (!$draw || $draw['state'] == 1) {
                exit;
            }

            if ($data['status'] == 'SUCCESS') {
                Db::name('msg_draw')
                    ->where('id', $draw['id'])
                    ->update([
                        'state' => 1,
                        'images' => '',
                        'finish_time' => time()
                    ]);
				$data['imageUrl'] = str_replace('https://cdn.discordapp.com', 'https://mjcdn.lxai.cc', $data['imageUrl']);
                $lxaiSDK = new \ChatGPT\lxai();
                $images = $lxaiSDK->splitMjImage($data['imageUrl']);
                Db::name('msg_draw')
                    ->where('id', $draw['id'])
                    ->update([
                        'images' => implode('|', $images)
                    ]);
            } elseif ($data['status'] == 'IN_PROGRESS') {
                Db::name('msg_draw')
                    ->where('id', $draw['id'])
                    ->update([
                        'state' => 3,
                        'images' => $data['imageUrl'] ?? ''
                    ]);
            } elseif ($data['status'] == 'FAILURE' || $data['status'] == 'BANNED') {
                if ($data['status'] == 'BANNED') {
                    $errMsg = '图片含有敏感内容，生成中断';
                } elseif (!empty($data['failReason'])) {
                    $errMsg = $data['failReason'];
                } else {
                    $errMsg = '';
                }
                Db::name('msg_draw')
                    ->where('id', $draw['id'])
                    ->update([
                        'state' => 2,
                        'errmsg' => $errMsg,
                        'is_refund' => 1
                    ]);
                // 失败退费
                if (!$draw['is_refund']) {
                    $price = getFuncPrice($draw['site_id'], $draw['user_id'], 'draw');
                    if ($price) {
                        changeUserBalance($draw['user_id'], $price, '绘画失败退费');
                    }
                }
            }
        }

    }

    public function yijian()
    {
        $task = input('task', '', 'trim');
        $task = json_decode($task, true);
        $task_id = $task['Uuid'];
        $draw = Db::name('msg_draw')
            ->where([
                ['task_id', '=', $task_id]
            ])
            ->find();
        if (!$draw) {
            exit;
        }
        if (!empty($task['ImagePath'])) {
            $url = $this->saveToFile($task['ImagePath'], 'draw');
            Db::name('msg_draw')
                ->where('id', $draw['id'])
                ->update([
                    'images' => $url,
                    'state' => 1,
                    'finish_time' => time()
                ]);
        }
    }

    /**
     * 多米mj
     */
    public function duomi_mj()
    {
        $data = input('post.');
        // file_put_contents('./duomi_callback.txt', json_encode($data) . "\n", 8);
        if (empty($data['task_id'])) {
            exit;
        }
        $task_id = $data['task_id'];
        $draw = Db::name('msg_draw')
            ->where('task_id', $task_id)
            ->order('id desc')
            ->find();
        // state 1成功 2失败 3生成中
        if (!$draw || $draw['state'] == 1 || $draw['state'] == 2) {
            exit;
        }

        // status 1执行任务中; 2失败; 3成功
        if ($data['status'] == 3) {
            Db::name('msg_draw')
                ->where('id', $draw['id'])
                ->update([
                    'state' => 1,
                    'image_id' => $data['image_id'] ?? '',
                    'images' => '',
                    'finish_time' => time()
                ]);
            $duomiSDK = new \ChatGPT\duomi();
            $images = $duomiSDK->splitMjImage($data['image_url']);
            Db::name('msg_draw')
                ->where('id', $draw['id'])
                ->update([
                    'images' => implode('|', $images)
                ]);
        } elseif ($data['status'] == 1) {
            Db::name('msg_draw')
                ->where('id', $draw['id'])
                ->update([
                    'state' => 3,
                    'images' => $data['raw_image_url'] ?? ''
                ]);
        } elseif ($data['status'] == 2) {
            Db::name('msg_draw')
                ->where('id', $draw['id'])
                ->update([
                    'state' => 2,
                    'errmsg' => $data['msg'] ?? '',
                    'is_refund' => 1
                ]);
            // 失败退费
            if (!$draw['is_refund']) {
                $price = getFuncPrice($draw['site_id'], $draw['user_id'], 'draw');
                if ($price) {
                    changeUserBalance($draw['user_id'], $price, '绘画失败退费');
                }
            }
        }

    }

    /**
     * 多米suno
     */
    public function duomi_suno()
    {
        $data = input('post.');
        $task_code = @explode('/task/', $_SERVER['REQUEST_URI'])[1];
        // file_put_contents('./duomi_callback.txt', json_encode($data) . "\n", 8);
        if (empty($task_code) || empty($data)) {
            exit;
        }
        $music = Db::name('msg_music')
            ->where('task_code', $task_code)
            ->order('id desc')
            ->find();
        if (!$music || $music['state'] == 1) {
            exit;
        }

        // status 1执行任务中; 2失败; 3成功
        if ($data['status'] == 3) {
            if (empty($music['result1'])) {
                $field = 'result1';
                $state = 0; // state 0生成中 1完成 2失败
                $finish_time = 0;
            } elseif (empty($music['result2'])) {
                $field = 'result2';
                $state = 1;
                $finish_time = time();
            } else {
                exit;
            }

            Db::name('msg_music')
                ->where('id', $music['id'])
                ->update([
                    'state' => $state,
                    $field => json_encode($data),
                    'errmsg' => '',
                    'is_refund' => 0,
                    'finish_time' => $finish_time
                ]);

            // 保存到本地
            try {
                $data['audio_url'] = $this->saveToFile($data['audio_url'], 'music');
                $data['image_url'] = $this->saveToFile($data['image_url'], 'music');
                $data['video_url'] = $this->saveToFile($data['video_url'], 'music');
                $data['image_large_url'] = $this->saveToFile($data['image_large_url'], 'music');
                Db::name('msg_music')
                    ->where('id', $music['id'])
                    ->update([
                        $field => json_encode($data)
                    ]);
            } catch (\Exception $e) {
                exit;
            }

        } elseif ($data['status'] == 2) {
            Db::name('msg_music')
                ->where('id', $music['id'])
                ->update([
                    'state' => 2,
                    'errmsg' => $data['msg'] ?? '',
                    'is_refund' => 1
                ]);
            // 失败退费
            if (!$music['is_refund']) {
                $price = getFuncPrice($music['site_id'], $music['user_id'], 'music');
                if ($price) {
                    changeUserBalance($music['user_id'], $price, '音乐失败退费');
                }
            }
        }

    }

    /**
     * 多米生成视频
     */
    public function duomi_video()
    {
        $data = input('post.');
        // file_put_contents('./duomi_video_callback.txt', json_encode($data) . "\n", 8);
        if (empty($data['task_id'])) {
            exit;
        }
        $task_id = $data['task_id'];
        $video = Db::name('msg_video')
            ->where('job_id', $task_id)
            ->order('id desc')
            ->find();
        // state 1成功 2失败 3生成中
        if (!$video || $video['state'] == 1 || $video['state'] == 2) {
            exit;
        }

        // status 1执行任务中; 2失败; 3成功
        if ($data['status'] == 3) {
            Db::name('msg_video')
                ->where('id', $video['id'])
                ->update([
                    'state' => 1,
                    'video_url' => $data['video_url'],
                    'video_poster' => $data['poster'],
                    'finish_time' => time()
                ]);

            // 保存到本地
            try {
                $video_url = $this->saveToFile($data['video_url'], 'video');
                $video_poster = $this->saveToFile($data['poster'], 'video');
                Db::name('msg_video')
                    ->where('id', $video['id'])
                    ->update([
                        'video_url' => $video_url,
                        'video_poster' => $video_poster
                    ]);
            } catch (\Exception $e) {
                exit;
            }
        } elseif ($data['status'] == 2) {
            Db::name('msg_video')
                ->where('id', $video['id'])
                ->update([
                    'state' => 2,
                    'errmsg' => $data['msg'] ?? '',
                    'is_refund' => 1
                ]);
            // 失败退费
            if (!$video['is_refund']) {
                $price = getFuncPrice($video['site_id'], $video['user_id'], 'video');
                if ($price) {
                    changeUserBalance($video['user_id'], $price, '视频失败退费');
                }
            }
        }

    }

    /**
     * pika video hook
     */
    public function pikapikapika()
    {
        // file_put_contents('./pikaPost.txt', json_encode($_POST) . "\n", 8);
        // file_put_contents('./pikaInput.txt', file_get_contents('php://input') . "\n", 8);
    }

    private function saveToFile($oriUrl, $folder)
    {
        $context = stream_context_create([
            'http' => ['method' => 'GET', 'timeout' => 30],
            'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
        ]);
        $content = file_get_contents($oriUrl, false, $context);
        $pathinfo =  pathinfo($oriUrl);
        $ext = $pathinfo['extension'];

        if (empty($content)) {
            return '';
        }
        // 保存到本地
        $date = date('Ymd');
        $dir = './upload/' . $folder . '/' . $date . '/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $filepath = $dir . uniqid() . '.' . $ext;
        file_put_contents($filepath, $content);
        if (!file_exists($filepath)) {
            return '';
        }
        $url = saveToOss($filepath);

        return $url;
    }
}
