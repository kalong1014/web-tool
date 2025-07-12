<?php

namespace app\web\controller;

use think\facade\Db;
use think\facade\Filesystem;

class Doc extends Base
{
    protected static $ai = '';
    protected static $file_id = '';
    protected static $message = '';
    protected static $messageClear = '';
    protected static $response = '';
    protected static $price = 0;

    public function chat()
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
            self::$message = input('message', '', 'trim');
            self::$messageClear = $this->inputFilter(self::$message);
            self::$file_id = input('file_id', '', 'trim');
            $file = Db::name('doc')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['user_id', '=', self::$user['id']],
                    ['file_id', '=', self::$file_id]
                ])
                ->find();
            if (!$file) {
                return errorJson('没找到文件，读取失败');
            }
            if (empty($file['ai_file_id'])) {
                return errorJson('文档正在排队分析，请稍候再试');
            }

            # 1.获取AI通道
            $setting = getSystemSetting(self::$site_id, 'doc');
            if (empty($setting['ai'])) {
                $this->outError('请先配置后台参数');
            }
            self::$ai = $setting['ai'];


            # 2.检查用户信息
            $this->checkUser();

            # 3.获取功能价格并检查用户余额
            $price = getFuncPrice(self::$site_id, self::$user, 'text35');
            if ($price && self::$user['balance_point'] < $price) {
                $this->outError('余额不足，请充值！');
            }
            self::$price = $price;

            # 4.定义长连接回调方法
            $replyCallback = function ($ch, $word) {

                if ($word == 'data: [DONE]' || $word == 'data: [CONTINUE]') {
                    if (!empty(self::$response)) {
                        // 输出完成
                        $this->replyFinish();
                        exit;
                    }
                } else {
                    self::$response .= $word;
                    $this->outText($word);
                    // 检测客户端是否已经中止了连接
                    if (connection_aborted()) {
                        if (!empty(self::$response)) {
                            // 输出完成
                            $this->replyFinish();
                            self::$response = '';
                        }
                        @curl_close($ch);
                        exit;
                    }
                }
            };
            $errorCallback = function ($error) {
                $this->outError($error['message']);
            };

            # 5.发起请求

            $SDK = new \FoxAI\hub(self::$site_id, self::$ai);
            $SDK->setCallback($replyCallback, $errorCallback);
            $result = $SDK->doc('chat', [
                'messages' => $this->makeMessages('chat', $file['ai_file_id'], self::$messageClear)
            ]);
            if (!empty($result) && !empty($result['errno'])) {
                $this->outError($result['message']);
            }
        } catch (\Exception $e) {
            $this->outError($e->getMessage());
        }
    }

    /**
     * 文档摘录、思维导图等
     */
    public function extract()
    {
        ignore_user_abort(true);
        set_time_limit(120);
        $type = input('type', '', 'trim');
        if (!in_array($type, ['mind', 'abstract', 'questions'])) {
            return errorJson('参数错误');
        }
        $file_id = input('file_id', '', 'trim');
        $file = Db::name('doc')
            ->where([
                ['site_id', '=', self::$site_id],
                ['user_id', '=', self::$user['id']],
                ['file_id', '=', $file_id]
            ])
            ->find();
        if (!$file) {
            return errorJson('没找到文件，读取失败');
        }
        # 1.获取AI通道
        $setting = getSystemSetting(self::$site_id, 'doc');
        if (empty($setting['ai'])) {
            return errorJson('请先配置后台参数');
        }
        self::$ai = $setting['ai'];
        # 2.检查用户信息
        $this->checkUser();

        // 生成摘要、脑图、提取快捷问题
        try {
            $SDK = new \FoxAI\hub(self::$site_id, self::$ai);
            $result = $SDK->doc('extract', [
                'file_id' => $file['ai_file_id'],
                'messages' => $this->makeMessages($type, $file['ai_file_id'])
            ]);
            if (!empty($result) && !empty($result['errno'])) {
                return errorJson($result['message']);
            }
            $content = $result['choices'][0]['message']['content'];
            if ($content) {
                Db::name('doc')
                    ->where([
                        ['site_id', '=', self::$site_id],
                        ['id', '=', $file['id']]
                    ])
                    ->update([
                        $type => $content
                    ]);
            }

            return successJson($content);
        } catch (\Exception $e) {
            return successJson($e->getMessage());
        }
    }

    /**
     * 生成最终提交的messasges
     */
    private function makeMessages($type, $ai_file_id, $message = '')
    {
        $messages = [
            [
                'role' => 'system',
                'content' => 'You are a helpful assistant.'
            ],
            [
                'role' => 'system',
                'content' => 'fileid://' . $ai_file_id
            ]
        ];
        if ($type == 'mind') {
            $messages[] = [
                'role' => 'user',
                'content' => '请你深度分析文件全文内容，帮我创建一个可以概括全文要点的树状层次接口的思维导图，不需要做任何解释说明，仅以下面的格式输出：' . "\n# {title}\n## {content}\n### {content}\n### {content}\n## {content}\n### {content}\n### {content}\n"
            ];
        } elseif ($type == 'abstract') {
            $messages[] = [
                'role' => 'user',
                'content' => '请你深度分析文件全文内容，帮我写一份文档全文概述和关键要点，用markdown语法输出：### 全文概述\n内容\n ### 关键要点\n内容'
            ];
        } elseif ($type == 'questions') {
            $messages[] = [
                'role' => 'user',
                'content' => '请你深度分析文件全文内容，帮我提取10条关键问题，不需要做任何解释说明，仅以下面的格式输出：["问题1", "问题2", "问题3"]'
            ];
        } elseif ($type == 'chat') {
            $relations = Db::name('msg_doc')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['user_id', '=', self::$user['id']],
                    ['file_id', '=', self::$file_id],
                    ['is_delete', '=', 0]
                ])
                ->order('id desc')
                ->field('message,response')
                ->limit(3)
                ->select()->toArray();
            $relations = array_reverse($relations);
            foreach ($relations as $v) {
                $messages[] = [
                    'role' => 'user',
                    'content' => $v['message']
                ];
                $messages[] = [
                    'role' => 'assistant',
                    'content' => $v['response']
                ];
            }
            $messages[] = [
                'role' => 'user',
                'content' => $message
            ];
        }
        return $messages;
    }

    private function checkUser()
    {
        $user = Db::name('user')
            ->where('id', self::$user['id'])
            ->find();
        if (!$user) {
            $_SESSION['user'] = null;
            return errorJson('请登录');
        }
        if ($user['is_freeze']) {
            // 禁言用户
            return errorJson('系统繁忙，请稍后再试');
        }
        self::$user = $user;
        return true;
    }

    /**
     * 流式输出完毕，保存数据到数据库
     */
    private function replyFinish()
    {
        $userIp = get_client_ip();
        Db::name('msg_doc')
            ->insert([
                'site_id' => self::$user['site_id'],
                'user_id' => self::$user['id'],
                'file_id' => self::$file_id,
                'ai' => self::$ai,
                'message' => self::$messageClear,
                'message_input' => self::$message == self::$messageClear ? '' : self::$message,
                'response' => self::$response,
                'user_ip' => $userIp,
                'create_time' => time()
            ]);
        // 扣积分
        if (self::$price) {
            changeUserBalance(self::$user['id'], -self::$price, '文档提问消费');
        }
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

    private function outText($text)
    {
        if (empty($text)) {
            return false;
        }
        $text = mb_str_split($text);
        foreach ($text as $char) {
            echo $char;
            ob_flush();
            flush();
            usleep(20000);
        }
    }

    private function outError($msg)
    {
        $msg = wordFilter($msg);
        echo '[error]' . $msg;
        ob_flush();
        flush();
        exit;
    }

    public function getDocList()
    {
        $page = input('page', 1, 'intval');
        $pagesize = input('pagesize', 30, 'intval');
        $where = [
            ['site_id', '=', self::$site_id],
            ['user_id', '=', self::$user['id']],
            ['is_delete', '=', 0]
        ];

        try {
            $list = Db::name('doc')
                ->where($where)
                ->field('title,file_id,file_hash,file_size,ext,pdf_url as url,mind,abstract,questions,create_time')
                ->order('id desc')
                ->page($page, $pagesize)
                ->select()->each(function ($item) {
                    $item['create_time'] = date('Y/m/d H:i', $item['create_time']);
                    return $item;
                });
            $count = Db::name('doc')
                ->where($where)
                ->count();

            return successJson([
                'list' => $list,
                'count' => $count
            ]);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }
    }

    public function setDocTitle()
    {
        $file_id = input('file_id', '', 'trim');
        $title = input('title', '', 'trim');

        try {
            Db::name('doc')
                ->where([
                    ['user_id', '=', self::$user['id']],
                    ['is_delete', '=', 0],
                    ['file_id', '=', $file_id]
                ])
                ->update([
                    'title' => $title
                ]);

            return successJson('', '保存成功');
        } catch (\Exception $e) {
            return errorJson(text('保存失败') . ': ' . $e->getMessage());
        }
    }

    public function uploadDoc()
    {
        ignore_user_abort(true);
        $setting = getSystemSetting(self::$site_id, 'doc');
        if (empty($setting['ai'])) {
            return errorJson('请先配置后台参数');
        }
        $ai = $setting['ai'];

        // 检查用户
        $user = Db::name('user')
            ->where('id', self::$user['id'])
            ->find();
        if (!$user) {
            $_SESSION['user'] = null;
            return errorJson('请登录');
        }
        if ($user['is_freeze']) {
            // 禁言用户
            return errorJson('系统繁忙，请稍后再试');
        }

        // 检查余额
        $price = getFuncPrice(self::$site_id, $user, 'doc');
        if ($price && $user['balance_point'] < $price) {
            return errorJson('余额不足，请充值！');
        }

        // 上传文件
        $file = request()->file('file');
        if (!$file) {
            return errorJson('参数错误');
        }
        $ext = strtolower($file->extension());
        if (!in_array($ext, ['pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'pptx'])) {
            return errorJson('不支持的文件格式');
        }
        $mime = $file->getOriginalMime();
        if (!in_array($mime, ['application/pdf', 'text/plain', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'text/csv', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'])) {
            return errorJson('不支持的文件格式2');
        }

        $title = $file->getOriginalName();
        $arr = explode('.', $title);
        array_pop($arr);
        $title = implode('.', $arr);
        $path = Filesystem::disk('public')->putFile('doc/' . date('Ymd'), $file, 'uniqid');
        $oriPath = './upload/' . $path;
        $fileHash = hash_file('md5', $oriPath);
        $fileSize = filesize($oriPath);

        $Converter = new \FoxOffice\Converter();
        // 转成PDF
        if ($ext == 'pdf') {
            $pdfPath = $oriPath;
        } else {
            try {
                $pdfPath = $Converter->doc2pdf($oriPath);
            } catch (\Exception $e) {
                @unlink($oriPath);
                return errorJson($e->getMessage());
            }
        }
        // pdf再转成txt
        if ($ext == 'txt') {
            $txtPath = $oriPath;
        } else {
            try {
                $txtPath = $Converter->pdf2txt($pdfPath);
            } catch (\Exception $e) {
                @unlink($pdfPath);
                @unlink($oriPath);
                return errorJson($e->getMessage());
            }
        }
        $oriUrl = mediaUrl($oriPath, true);
        $pdfUrl = mediaUrl($pdfPath, true);

        // 上传文件到AI平台
        try {
            $aiFileId = $this->uploadToAi($ai, $txtPath);
        } catch (\Exception $e) {
            @unlink($pdfPath);
            @unlink($oriPath);
            @unlink($txtPath);
            return errorJson($e->getMessage());
        }

        // 存入数据库
        $data = [
            'site_id' => self::$site_id,
            'user_id' => self::$user['id'],
            'ai' => $ai,
            'title' => $title,
            'file_id' => uniqid(self::$user['id']),
            'file_hash' => $fileHash,
            'file_size' => $fileSize,
            'ext' => $ext,
            'ori_url' => $oriUrl,
            'pdf_url' => $pdfUrl,
            'txt_path' => $txtPath,
            'ai_file_id' => $aiFileId,
            'user_ip' => get_client_ip(),
            'create_time' => time()
        ];
        Db::name('doc')
            ->insert($data);

        // 扣积分
        if ($price) {
            changeUserBalance(self::$user['id'], -$price, '上传文档扣费');
        }

        return successJson([
            'title' => $data['title'],
            'file_id' => $data['file_id'],
            'file_hash' => $data['file_hash'],
            'file_size' => $data['file_size'],
            'ext' => $data['ext'],
            'url' => $data['pdf_url'],
            'create_time' => date('Y/m/d H:i', $data['create_time'])
        ]);
    }

    private function uploadToAi($ai, $filePath)
    {
        $SDK = new \FoxAI\hub(self::$site_id, $ai);
        $result = $SDK->doc('upload', [
            'filePath' => $filePath
        ]);
        if (!empty($result) && $result['errno']) {
            return errorJson($result['message']);
        }
        return $result['file_id'];
    }

    public function delDoc()
    {
        $file_id = input('file_id', '', 'trim');
        try {
            Db::name('doc')
                ->where([
                    ['site_id', '=', self::$site_id],
                    ['user_id', '=', self::$user['id']],
                    ['file_id', '=', $file_id]
                ])
                ->update([
                    'is_delete' => 1
                ]);
            return successJson('', '删除成功');
        } catch (\Exception $e) {
            return errorJson(text('删除失败') . ': ' . $e->getMessage());
        }
    }

    /**
     * 文档对话历史记录
     */
    public function getHistoryMsg()
    {
        $file_id = input('file_id', '', 'trim');
        $list = Db::name('msg_doc')
            ->where([
                ['site_id', '=', self::$site_id],
                ['user_id', '=', self::$user['id']],
                ['file_id', '=', $file_id],
                ['is_delete', '=', 0]
            ])
            ->field('id,message,response')
            ->order('id desc')
            ->limit(10)
            ->select()->toArray();
        $msgList = [];
        $list = array_reverse($list);
        foreach ($list as $v) {
            $msgList[] = [
                'user' => '我',
                'id' => $v['id'],
                'message' => $v['message']
            ];
            $msgList[] = [
                'user' => 'AI',
                'id' => $v['id'],
                'message' => $v['response']
            ];
        }

        return successJson([
            'list' => $msgList
        ]);
    }

}
