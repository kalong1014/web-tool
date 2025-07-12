<?php

namespace app\admin\controller;

use think\facade\Db;
use think\facade\Config;

class Ai extends Base
{
    public function getAiList()
    {
        $show_gpt = Config::get('app.show_gpt');
        $aiList = [
            ['name' => 'wenxin', 'title' => '文心一言'],
            ['name' => 'azure_openai3', 'title' => 'Azure GPT-3.5'],
            ['name' => 'xunfei', 'title' => '讯飞星火'],
            ['name' => 'tongyi', 'title' => '通义千问'],
            ['name' => 'hunyuan', 'title' => '腾讯混元'],
            ['name' => 'zhipu', 'title' => '智普AI'],
            ['name' => 'lxai', 'title' => '灵犀AI'],
            ['name' => 'minimax', 'title' => 'MiniMax'],
            ['name' => 'skychat', 'title' => '天工AI'],
            ['name' => 'kimi', 'title' => 'Kimi'],
            ['name' => 'baichuan', 'title' => '百川AI'],
            ['name' => 'deepseek', 'title' => 'DeepSeek'],
            ['name' => 'shangtang', 'title' => '商汤日日新'],
            ['name' => 'doubao', 'title' => '豆包AI']
        ];
        $gaojiList = [
            ['name' => 'wenxin4', 'title' => '文心一言4.0'],
            ['name' => 'hunyuan4', 'title' => '腾讯混元'],
            ['name' => 'zhipu4', 'title' => '智普AI'],
            ['name' => 'azure_openai4', 'title' => 'Azure GPT-4'],
            ['name' => 'deepseek4', 'title' => 'DeepSeek']
        ];
        if ($show_gpt) {
            $aiList = array_merge($aiList, [
                ['name' => 'gemini', 'title' => 'Gemini'],
                ['name' => 'chatglm', 'title' => 'ChatGLM'],
                ['name' => 'openllm', 'title' => 'OpenLLM'],
                ['name' => 'localai', 'title' => 'LocalAI'],
                ['name' => 'openai3', 'title' => '自定义1'],
                ['name' => 'diy32', 'title' => '自定义2'],
                ['name' => 'diy33', 'title' => '自定义3']
            ]);
            $gaojiList = array_merge($gaojiList, [
                ['name' => 'claude2', 'title' => 'Claude3'],
                ['name' => 'openai4', 'title' => '自定义1'],
                ['name' => 'diy42', 'title' => '自定义2'],
                ['name' => 'diy43', 'title' => '自定义3']
            ]);
        }

        $aiSetting = Db::name('ai')
            ->where('site_id', self::$site_id)
            ->find();
        foreach ($aiList as &$v) {
            $v['status'] = empty($aiSetting[$v['name']]) ? 0 : 1;
        }
        foreach ($gaojiList as &$v) {
            $v['status'] = empty($aiSetting[$v['name']]) ? 0 : 1;
        }

        return successJson([
            'aiList' => $aiList,
            'gaojiList' => $gaojiList
        ]);
    }

    /**
     * 取单个AI设置
     */
    public function getAiSetting()
    {
        try {
            $name = input('name', '', 'trim');
            $setting = getAiSetting(self::$site_id, $name);
            // 获取模型
            if ($name == 'diy32' || $name == 'diy33') {
                $name = 'openai3';
            } elseif ($name == 'diy42' || $name == 'diy43') {
                $name = 'openai4';
            }
            $engines = Db::name('engine')
                ->where([
                    ['type', '=', $name],
                    ['state', '=', 1]
                ])
                ->field('title,name')
                ->select()->toArray();

            return successJson([
                'setting' => $setting,
                'engines' => $engines
            ]);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }
    }

    public function saveAiSetting()
    {
        try {
            $name = input('name', '', 'trim');
            $data = input('data', '', 'trim');
            if (!in_array($name, ['wenxin', 'wenxin4', 'azure_openai3', 'azure_openai4', 'xunfei', 'tongyi', 'hunyuan', 'hunyuan4', 'zhipu', 'zhipu4', 'lxai', 'chatglm', 'minimax', 'skychat', 'openai3', 'diy32', 'diy33', 'openai4', 'diy42', 'diy43', 'claude2', 'gemini', 'openllm', 'localai', 'kimi', 'baichuan', 'deepseek', 'deepseek4', 'shangtang', 'doubao'])) {
                return errorJson('参数错误');
            }
            $aiSetting = Db::name('ai')
                ->where('site_id', self::$site_id)
                ->find();
            if (!$aiSetting) {
                Db::name('ai')
                    ->insert([
                        'site_id' => self::$site_id
                    ]);
            }
            Db::name('ai')
                ->where('site_id', self::$site_id)
                ->update([
                    $name => $data
                ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return successJson('', '保存成功');
    }

    /**
     * 清除AI设置
     */
    public function clearAiSetting()
    {
        $name = input('name', '', 'trim');

        Db::name('ai')
            ->where([
                ['site_id', '=', self::$site_id]
            ])
            ->update([
                $name => ''
            ]);
        return successJson('', '清除成功');
    }
}
