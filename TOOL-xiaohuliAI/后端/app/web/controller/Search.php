<?php

namespace app\web\controller;

use think\facade\Db;

class Search extends Base
{
    protected static $ai = '';
    protected static $model = '';
    protected static $type = '';
    protected static $ask = '';
    protected static $askClear = '';
    protected static $results = [];
    protected static $price = 0;

    public function search()
    {
        ignore_user_abort(true);
        set_time_limit(300);
        session_write_close();
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        header('X-Accel-Buffering: no');
        ob_implicit_flush(1);

        try {
            self::$model = input('model', 'search', 'trim');
            self::$type = input('type', 'all', 'trim');
            self::$ask = input('ask', '', 'trim');
            self::$askClear = $this->inputFilter(self::$ask);

            # 1.获取AI通道
            $setting = getSystemSetting(self::$site_id, 'search');
            if (empty($setting['ai'])) {
                $this->outError('请先配置搜索参数');
            }
            self::$ai = $setting['ai'];

            # 2.检查用户信息
            $user = Db::name('user')
                ->where('id', self::$user['id'])
                ->find();
            if (!$user) {
                $_SESSION['user'] = null;
                $this->outError('请登录');
            }
            if ($user['is_freeze']) {
                // 禁言用户
                $this->outError('系统繁忙，请稍后再试');
            }
            self::$user = $user;

            # 3.获取功能价格并检查用户余额
            $price = getFuncPrice(self::$site_id, $user, 'search_' . self::$model);
            if ($price && $user['balance_point'] < $price) {
                $this->outError('余额不足，请充值！');
            }
            self::$price = $price;

            # 4.定义长连接回调方法
            $replyCallback = function ($ch, $result) {
                if ($result['type'] == 'done') {
                    $this->replyFinish();
                    exit;
                }

                self::$results[] = $result;
                $this->outJson($result);

                // 检测客户端是否已经中止了连接
                if (connection_aborted()) {
                    if (!empty(self::$results)) {
                        // 输出完成
                        $this->replyFinish();
                    }
                    @curl_close($ch);
                    exit;
                }
            };
            $errorCallback = function ($error) {
                $this->outError($error['message']);
            };

            # 5.发起请求
            $SDK = new \FoxAI\hub(self::$site_id, self::$ai);
            $SDK->setCallback($replyCallback, $errorCallback);
            $SDK->search(self::$model, self::$type, self::$askClear);
        } catch (\Exception $e) {
            $this->outError($e->getMessage());
        }
    }

    /**
     * 流式输出完毕，保存数据到数据库
     */
    private function replyFinish()
    {
        // 扣积分
        if (self::$price) {
            changeUserBalance(self::$user['id'], -self::$price, 'AI搜索');
        }
        // 存数据库
        $userIp = get_client_ip();
        $resultId = self::$user['id'] . uniqid();
        Db::name('msg_search')
            ->insert([
                'site_id' => self::$user['site_id'],
                'user_id' => self::$user['id'],
                'ai' => self::$ai,
                'model' => self::$model,
                'type' => self::$type,
                'ask' => self::$askClear,
                'ask_input' => self::$ask == self::$askClear ? '' : self::$ask,
                'results' => json_encode(self::$results, JSON_UNESCAPED_UNICODE),
                'result_id' => $resultId,
                'user_ip' => $userIp,
                'create_time' => time()
            ]);
        $this->outJson([
            'type' => 'result_id',
            'data' => $resultId,
        ]);
    }

    /**
     * 对输入的内容进行关键词过滤
     */
    private function inputFilter($message)
    {
        // 系统敏感词过滤
        $messageClear = wordFilter($message);
        if ($messageClear != $message) {
            $setting = getSystemSetting(0, 'filter');
            $handle_type = empty($setting['handle_type']) ? 1 : intval($setting['handle_type']);
            if ($handle_type == 2) {
                $this->outError('内容包含敏感信息');
            }
        }

        return $messageClear;
    }

    private function outError($msg)
    {
        $msg = wordFilter($msg);
        echo '[error]' . $msg;
        ob_flush();
        flush();
        exit;
    }

    /**
     * 输出json格式的内容
     */
    private function outJson($data = [])
    {
        if (empty($data)) {
            return false;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        ob_flush();
        flush();
    }

    /**
     * AI搜索的配置
     */
    public function getSetting()
    {
        $setting = getSystemSetting(self::$site_id, 'search');
        // 推荐关键词
        $hots = [];
        if (!empty($setting['hots'])) {
            $arr = explode("\n", $setting['hots']);
            foreach ($arr as $v) {
                $v = trim($v);
                if (!empty($v)) {
                    $hots[] = $v;
                }
            }
        }
        return successJson([
            'hots' => $hots
        ]);
    }

    public function getResults()
    {
        $result_id = input('result_id', '', 'trim');
        $result = Db::name('msg_search')
            ->where([
                ['site_id', '=', self::$site_id],
                ['is_delete', '=', 0],
                ['result_id', '=', $result_id]
            ])
            ->field('model,type,ask,results')
            ->find();
        if (!$result) {
            return successJson('');
        }
        $results = @json_decode($result['results'], true);
        return successJson([
            'model' => $result['model'],
            'type' => $result['type'],
            'ask' => $result['ask'],
            'results' => $results
        ]);
    }
}
