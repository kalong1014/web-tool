<?php

namespace app\api\controller;

use think\facade\Db;

class Task
{
    public function song50()
    {
        $rs = Db::name('user')
            ->where([
                ['balance', '<', 50]
            ])
            ->update([
                'balance' => 50
            ]);
        if ($rs !== false) {
            echo "success";
        } else {
            echo "fail";
        }
    }
}
