<?php

// 版本 v1.0.6

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Db;

class Updatesql extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        

        // 增加索引
        // try{ Db::execute("ALTER TABLE `fa_make_video` DROP INDEX `store_id`;");}catch (\Exception $e) {}
        // try{ Db::execute("ALTER TABLE `fa_make_video` DROP INDEX `status`;");}catch (\Exception $e) {}
        // try{ Db::execute("ALTER TABLE `fa_make_video` DROP INDEX `is_register`;");}catch (\Exception $e) {}
        // Db::execute("ALTER TABLE `fa_make_video` ADD INDEX ```store_id```(`store_id`) USING BTREE;");
        // Db::execute("ALTER TABLE `fa_make_video` ADD INDEX ```status```(`status`) USING BTREE;");
        // Db::execute("ALTER TABLE `fa_make_video` ADD INDEX ```is_register```(`is_register`) USING BTREE;");
        // 更新
        Db::execute('delete from fa_file_media where url not like "%http%"');
        Db::execute('delete from fa_tuiguang_video where video_url not like "%http%"');
        

        $fields = Db::getFields('fa_tuiguang_keyword');
        if(!isset($fields['mode'])){
            Db::execute("ALTER TABLE `fa_tuiguang_keyword` ADD COLUMN `mode` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1评论 2私信' AFTER `type`,ADD INDEX ```mode```(`mode`) USING BTREE;");
        }

        $fields = Db::getFields('fa_tuiguang_comment');
        if(!isset($fields['uptime'])){
            Db::execute("ALTER TABLE fa_tuiguang_comment  ADD `uptime` datetime DEFAULT NULL;");
        }

        $fields = Db::getFields('fa_qiye_user');
        if(!isset($fields['company'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `company` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['digg_count'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `digg_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['fensi_count'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `fensi_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['video_count'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `video_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['uid'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `uid` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['sec_uid'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `sec_uid` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['userid'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `userid` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['user_uptime'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `user_uptime` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['item_uptime'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `item_uptime` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['uptime'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `uptime` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['refresh_uptime'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `refresh_uptime` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['error_text'])){
            Db::execute("ALTER TABLE fa_qiye_user  ADD `error_text` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['new_open'])){
            Db::execute("ALTER TABLE `fa_qiye_user` ADD COLUMN `new_open` tinyint(1) NOT NULL DEFAULT 0 AFTER `error_text`,ADD INDEX ```new_open```(`new_open`) USING BTREE;");
        }
        // 企业粉丝
        $fields = Db::getFields('fa_qiye_fensi');
        if(!isset($fields['uid'])){
            Db::execute("ALTER TABLE fa_qiye_fensi  ADD `uid` varchar(255)  DEFAULT '' NOT NULL;");
        }
        $fields = Db::getFields('fa_qiye_fensi');
        if(!isset($fields['userid'])){
            Db::execute("ALTER TABLE fa_qiye_fensi  ADD `userid` varchar(255)  DEFAULT '' NOT NULL;");
        }
        $fields = Db::getFields('fa_qiye_fensi');
        if(!isset($fields['sec_uid'])){
            Db::execute("ALTER TABLE fa_qiye_fensi  ADD `sec_uid` varchar(255)  DEFAULT '' NOT NULL;");
        }
        $fields = Db::getFields('fa_qiye_fensi');
        if(!isset($fields['uptime'])){
            Db::execute("ALTER TABLE fa_qiye_fensi  ADD `uptime` datetime DEFAULT NULL;");
        }
        // 企业视频
        $fields = Db::getFields('fa_qiye_video');
        if(!isset($fields['video_id'])){
            Db::execute("ALTER TABLE fa_qiye_video  ADD `video_id` varchar(255)  DEFAULT '' NOT NULL;");
        }
        $fields = Db::getFields('fa_qiye_video');
        if(!isset($fields['uptime'])){
            Db::execute("ALTER TABLE fa_qiye_video  ADD `uptime` datetime DEFAULT NULL;");
        }
        $fields = Db::getFields('fa_qiye_video');
        if(!isset($fields['digg_count'])){
            Db::execute("ALTER TABLE fa_qiye_video  ADD `digg_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        $fields = Db::getFields('fa_qiye_video');
        if(!isset($fields['comment_count'])){
            Db::execute("ALTER TABLE fa_qiye_video  ADD `comment_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        $fields = Db::getFields('fa_qiye_video');
        if(!isset($fields['play_count'])){
            Db::execute("ALTER TABLE fa_qiye_video  ADD `play_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        $fields = Db::getFields('fa_qiye_video');
        if(!isset($fields['share_count'])){
            Db::execute("ALTER TABLE fa_qiye_video  ADD `share_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        $fields = Db::getFields('fa_qiye_video');
        if(!isset($fields['create_time'])){
            Db::execute("ALTER TABLE fa_qiye_video  ADD `create_time` int(11)  DEFAULT 0 NOT NULL;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_tuiguang_task_data" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_tuiguang_task_data`  (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `tuiguang_task_id` int(11) NOT NULL DEFAULT 0,
                  `view_count` int(11) NOT NULL DEFAULT 0,
                  `like_count` int(11) NOT NULL DEFAULT 0,
                  `comment_count` int(11) NOT NULL DEFAULT 0,
                  `total_share` int(11) NOT NULL DEFAULT 0,
                  `download_count` int(11) NOT NULL DEFAULT 0,
                  `store_id` int(11) NOT NULL DEFAULT 0,
                  `date` date NULL DEFAULT NULL,
                  `addtime` datetime NULL DEFAULT NULL,
                  PRIMARY KEY (`id`) USING BTREE,
                  INDEX ```tuiguang_task_id```(`tuiguang_task_id`) USING BTREE,
                  INDEX ```date```(`date`) USING BTREE,
                  INDEX ```store_id```(`store_id`) USING BTREE
                ) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }
        $fields = Db::execute('SHOW TABLES LIKE "fa_video_rank_data" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_video_rank_data`  (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `tuiguang_task_id` int(11) NOT NULL DEFAULT 0,
                  `store_id` int(11) NOT NULL DEFAULT 0,
                  `video_rank_id` int(11) NOT NULL DEFAULT 0,
                  `rank_num` int(11) NOT NULL DEFAULT 0,
                  `date` date NULL DEFAULT NULL,
                  `addtime` datetime NULL DEFAULT NULL,
                  PRIMARY KEY (`id`) USING BTREE,
                  INDEX ```tuiguang_task_id```(`tuiguang_task_id`) USING BTREE,
                  INDEX ```store_id```(`store_id`) USING BTREE,
                  INDEX ```video_rank_id```(`video_rank_id`) USING BTREE,
                  INDEX ```date```(`date`) USING BTREE
                ) ENGINE = InnoDB AUTO_INCREMENT = 298 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }
        // 矩阵
        $fields = Db::getFields('fa_tuiguang_task');
        if(!isset($fields['task_auto_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `task_auto_id` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['error_text'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `error_text` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['is_refund'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `is_refund` tinyint(1)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['group_ids'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `group_ids` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['cover_img'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `cover_img` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['is_download'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `is_download` tinyint(1)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['download_time'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `download_time` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['alias'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `alias` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['error_count'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `error_count` int(11)  DEFAULT '0' NOT NULL;");
            Db::execute("ALTER TABLE `fa_tuiguang_task` ADD INDEX ```error_count```(`error_count`) USING BTREE;");
        }
        if(!isset($fields['shop_url'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `shop_url` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['shop_promotion_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `shop_promotion_id` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['shop_title'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `shop_title` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['shop_draft_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `shop_draft_id` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['bili_tid'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `bili_tid` int(10)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['merchant_product_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `merchant_product_id` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['keyword_group_ids'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `keyword_group_ids` varchar(255)  DEFAULT '' NOT NULL;");
        }
 
        if(!isset($fields['tuiguang_video_groups'])){
            Db::execute("ALTER TABLE fa_tuiguang_task  ADD `tuiguang_video_groups` longtext NULL;");
        }

        $fields = Db::getFields('fa_tuiguang_video');
        if(!isset($fields['pre_use_count'])){
            Db::execute("ALTER TABLE fa_tuiguang_video  ADD `pre_use_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['group_ids'])){
            Db::execute("ALTER TABLE fa_tuiguang_video  ADD `group_ids` int(11)  DEFAULT 0 NOT NULL;");
        }

        $fields = Db::getFields('fa_merge_keyword');
        if(!isset($fields['group_ids'])){
            Db::execute("ALTER TABLE fa_merge_keyword  ADD `group_ids` varchar(255)  DEFAULT '' NOT NULL;");
        }

        $fields = Db::getFields('fa_tuiguang_user');
        if(!isset($fields['group_ids'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `group_ids` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['uptime'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `uptime` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['refresh_uptime'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `refresh_uptime` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['error_text'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `error_text` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['sex'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `sex` varchar(10)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['fan'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `fan` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['follow'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `follow` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['city'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `city` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['check_uptime'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `check_uptime` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['cookie'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `cookie` longtext  NULL;");
            Db::execute("ALTER TABLE `fa_tuiguang_user` ADD INDEX ```type```(`type`) USING BTREE");
            Db::execute("ALTER TABLE `fa_tuiguang_user` ADD INDEX ```status```(`status`) USING BTREE");
            Db::execute("ALTER TABLE `fa_tuiguang_user` ADD INDEX ```token_out_time```(`token_out_time`) USING BTREE");
            Db::execute("ALTER TABLE `fa_tuiguang_user` ADD INDEX ```uptime```(`uptime`) USING BTREE");
        }
        if(!isset($fields['blog_url'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `blog_url` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['sec_uid'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `sec_uid` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['uid'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `uid` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['like_count'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `like_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['view_count'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `view_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['aweme_count'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `aweme_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['error_count'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `error_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['sms_uptime'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `sms_uptime`  datetime NULL DEFAULT NULL;");
        }
        if(!isset($fields['mix_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `mix_id` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['poi_address'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `poi_address` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['poi_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `poi_id` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['poi_name'])){
            Db::execute("ALTER TABLE fa_tuiguang_user  ADD `poi_name` varchar(100)  DEFAULT '' NOT NULL;");
        }


        // 文件
        $fields = Db::getFields('fa_file_media');
        if(!isset($fields['mimetype'])){
            Db::execute("ALTER TABLE fa_file_media  ADD `mimetype` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['title'])){
            Db::execute("ALTER TABLE fa_file_media  ADD `title` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['file_size'])){
            Db::execute("ALTER TABLE fa_file_media  ADD `file_size` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['store_id'])){
            Db::execute("ALTER TABLE fa_file_media  ADD `store_id` int(11)  DEFAULT 0 NOT NULL;");
            Db::execute("ALTER TABLE fa_file_media  ADD INDEX ```store_id```(`store_id`) USING BTREE;");
        }
        if(!isset($fields['agent_id'])){
            Db::execute("ALTER TABLE fa_file_media  ADD `agent_id` int(11)  DEFAULT 0 NOT NULL;");
            Db::execute("ALTER TABLE fa_file_media  ADD INDEX ```agent_id```(`agent_id`) USING BTREE;");
        }
        if(!isset($fields['aliyun_bucket'])){
            Db::execute("ALTER TABLE fa_file_media  ADD `aliyun_bucket` varchar(100)  DEFAULT '' NOT NULL;");
        }
        $fields = Db::execute('SHOW TABLES LIKE "fa_tuiguang_task_auto" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_tuiguang_task_auto`  (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `store_id` int(11) NOT NULL DEFAULT 0,
                      `tuiguang_user_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
                      `tuiguang_video_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
                      `make_video_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
                      `is_repeat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1重复发送视频',
                      `interval` tinyint(1) NOT NULL DEFAULT 1 COMMENT '每天多少条',
                      `next_date` int(11) NOT NULL DEFAULT 0 COMMENT '下次执行时间',
                      `day_count` int(11) NOT NULL COMMENT '发布多少天停止',
                      `end_date` int(11) NOT NULL DEFAULT 0 COMMENT '结束时间戳',
                      `start_time` tinyint(2) NOT NULL DEFAULT 0 COMMENT '发布初始时间',
                      `end_time` tinyint(2) NOT NULL DEFAULT 0 COMMENT '发布结束时间',
                      `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
                      `poi_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'poi地址',
                      `video_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '视频标题',
                      `micro_app_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                      `micro_app_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                      `micro_app_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                      `video_text_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                      `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1运行中 2已完成 3停止 4失败 ',
                      `addtime` datetime NULL DEFAULT NULL,
                      `uptime` datetime NULL DEFAULT NULL,
                      `today_send_count` int(11) NOT NULL DEFAULT 0 COMMENT '今日已经发布',
                      `poi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                      PRIMARY KEY (`id`) USING BTREE,
                      INDEX ```store_id```(`store_id`) USING BTREE,
                      INDEX ```is_repeat```(`is_repeat`) USING BTREE,
                      INDEX ```next_date```(`next_date`) USING BTREE,
                      INDEX ```end_date```(`end_date`) USING BTREE,
                      INDEX ```status```(`status`) USING BTREE,
                      INDEX ```today_send_count```(`today_send_count`) USING BTREE
                    ) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::getFields('fa_store_pay');
        if(!isset($fields['type'])){
            Db::execute("ALTER TABLE fa_store_pay  ADD `type` tinyint(1) NOT NULL DEFAULT 0;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_tuiguang_user_group" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_tuiguang_user_group`  (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `store_id` int(11) NOT NULL DEFAULT 0,
                  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                  `addtime` datetime NULL DEFAULT NULL,
                  `s_sort` int(11) NOT NULL DEFAULT 0,
                  PRIMARY KEY (`id`) USING BTREE,
                  INDEX ```store_id```(`store_id`) USING BTREE
                ) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::getFields('fa_tuiguang_user_group');
        if(!isset($fields['poi_address'])){
            Db::execute("ALTER TABLE fa_tuiguang_user_group  ADD `poi_address` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['poi_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_user_group  ADD `poi_id` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['poi_name'])){
            Db::execute("ALTER TABLE fa_tuiguang_user_group  ADD `poi_name` varchar(100)  DEFAULT '' NOT NULL;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_tuiguang_video_group" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_tuiguang_video_group`  (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `store_id` int(11) NOT NULL DEFAULT 0,
                  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                  `addtime` datetime NULL DEFAULT NULL,
                  `s_sort` int(11) NOT NULL DEFAULT 0,
                  PRIMARY KEY (`id`) USING BTREE,
                  INDEX ```store_id```(`store_id`) USING BTREE
                ) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::getFields('fa_tuiguang_task_auto');
        if(!isset($fields['group_ids'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `group_ids` varchar(255)  DEFAULT '' NOT NULL;");
        }
        $fields = Db::getFields('fa_tuiguang_task_auto');
        if(!isset($fields['alias'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `alias` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['poi_name'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `poi_name` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['guazai_type'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `guazai_type` tinyint(1)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['shop_url'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `shop_url` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['shop_promotion_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `shop_promotion_id` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['shop_title'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `shop_title` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['shop_draft_id'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `shop_draft_id` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['error_text'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `error_text` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['bili_tid'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `bili_tid` int(10)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['tuiguang_video_groups'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `tuiguang_video_groups` longtext NULL;");
        }

        $fields = Db::getFields('fa_make_video');
        if(!isset($fields['start_duration'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `start_duration` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['video_duration'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `video_duration` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['end_duration'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `end_duration` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['video_volume'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `video_volume` tinyint(2)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['alignment'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `alignment` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['open_subtitle'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `open_subtitle` tinyint(1)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['subtitle_alignment'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `subtitle_alignment` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['cover_time'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `cover_time` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['subtitle_font'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `subtitle_font` varchar(50)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['subtitle_outline'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `subtitle_outline` tinyint(2)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['subtitle_outline_color'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `subtitle_outline_color` varchar(50)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['subtitle_color'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `subtitle_color` varchar(50)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['subtitle_site'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `subtitle_site` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['type'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `type` tinyint(1)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['template_id'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `template_id` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['video_json'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `video_json` longtext  NULL;");
        }
        if(!isset($fields['sound_text_size'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `sound_text_size` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['sound_text_outline'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `sound_text_outline` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['sound_text_color'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `sound_text_color` varchar(50)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['sound_text_outline_color'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `sound_text_outline_color` varchar(50)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['uptime2'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `uptime2` datetime  NULL;");
        }
        if(!isset($fields['speed'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `speed` decimal(6, 1)  DEFAULT 1.0 NOT NULL;");
        }
        if(!isset($fields['diy_yuyin'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `diy_yuyin` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['update3'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `update3` datetime  NULL;");
        }
        if(!isset($fields['muban_json'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `muban_json` longtext  NULL;");
        }
        if(!isset($fields['koubo_volume'])){
            Db::execute("ALTER TABLE fa_make_video  ADD `koubo_volume` int(3)  DEFAULT 10 NOT NULL;");
        }

        $has_config = Db::name('config')->where(['name'=>'aliyun_bucket'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('aliyun_bucket', 'basic', '阿里云bucket', '阿里云bucket', 'string', '', null);");
        }

        $has_config = Db::name('config')->where(['name'=>'aliyun_keyid'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('aliyun_keyid', 'basic', '阿里云keyid', '阿里云keyid', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'aliyun_secret'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('aliyun_secret', 'basic', '阿里云secret', '阿里云secret', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'aliyun_cdn'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('aliyun_cdn', 'basic', '阿里云CDN(选填)', '阿里云CDN(选填)', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'aliyun_role'])->find();
        if(!$has_config){
            // Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('aliyun_role', 'basic', '阿里云子账号角色', '阿里云子账号角色，配置与总账号流程不同', 'string', '', null);");
        }else{
            Db::name('config')->where(['name'=>'aliyun_role'])->delete();
        }
        $has_config = Db::name('config')->where(['name'=>'aliyun_role_keyid'])->find();
        if(!$has_config){
            // Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('aliyun_role_keyid', 'basic', '阿里云角色keyid', '阿里云角色keyid', 'string', '', null);");
        }else{
            Db::name('config')->where(['name'=>'aliyun_role_keyid'])->delete();
        }
        $has_config = Db::name('config')->where(['name'=>'aliyun_role_secret'])->find();
        if(!$has_config){
            // Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('aliyun_role_secret', 'basic', '阿里云角色secret', '阿里云角色秘钥', 'string', '', null);");
        }else{
            Db::name('config')->where(['name'=>'aliyun_role_secret'])->delete();
        }

        $has_config = Db::name('config')->where(['name'=>'paiming10_money'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('paiming10_money', 'example', '前10排名达标费用/词/天', '前10排名达标费用/每个词/每一天', 'string', '0', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'paiming20_money'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('paiming20_money', 'example', '前20排名达标费用/词/天', '前20排名达标费用/每个词/每一天', 'string', '0', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'ks_app_id'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('ks_app_id', 'basic', '快手app_id', '自己没申请的留空', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'ks_app_secret'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('ks_app_secret', 'basic', '快手app_secret', '自己没申请的留空', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'ks_url'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('ks_url', 'basic', '快手回调域名', '自己没申请的留空', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'comment_money'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('comment_money', 'example', '抖音回复评论费用', '抖音回复评论费用', 'string', '0', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'link_money'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('link_money', 'example', '防封抖链费用/条', '防封抖链费用（每条计费）', 'string', '0', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'juzhen_update_time'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('juzhen_update_time', 'basic', '矩阵更新数据(天)', '每个矩阵视频最多更新几天的播放量数据(默认5天，不可为0)', 'string', '5', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'im_money'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('im_money', 'example', '发私信费用/条', '发私信费用/条', 'string', '0', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'tandian_money'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('tandian_money', 'example', '探店/条视频', '探店/条视频', 'string', '0', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'video_update_max'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('video_update_max', 'basic', '单次最大上传', '单次最大上传文件数', 'string', '50', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'send_video_max'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('send_video_max', 'basic', '矩阵并发量', '矩阵并发量，每分钟发送几条视频', 'string', '2', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'pay_appid'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('pay_appid', 'basic', '公众号appid', '公众号appid', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'pay_appkey'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('pay_appkey', 'basic', '公众号秘钥', '公众号秘钥', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'wechat_name'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('wechat_name', 'basic', '公众号名称', '公众号名称', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'wechat_select_result'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('wechat_select_result', 'basic', '查询结果模板id', '模板id，查询结果通知', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'bili_app_id'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('bili_app_id', 'basic', '哔哩哔哩client_id', '哔哩哔哩client_id', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'bili_app_secret'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('bili_app_secret', 'basic', '哔哩哔哩secret', '哔哩哔哩secret', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'bili_url'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('bili_url', 'basic', '哔哩哔哩回调域名', '例如：https://xxxxx.com', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'open_tandian_data'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('open_tandian_data', 'basic', '探店数据更新', '探店数据更新，会涉及到账号授权问题', 'radio', '0', '[\"关闭\",\"开启\"]');");
        }
        $has_config = Db::name('config')->where(['name'=>'open_douyin_cookie'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('open_douyin_cookie', 'basic', '开启抖音cookie授权', '是否开启抖音的cookie方式授权，不开启的话就只保留官方开放接口', 'radio', '1', '[\"关闭\",\"开启\"]');");
        }
        $has_config = Db::name('config')->where(['name'=>'open_douyin_open'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('open_douyin_open', 'basic', '开启抖音开放授权', '是否开启抖音开放平台的方式授权', 'radio', '1', '[\"关闭\",\"开启\"]');");
        }
        $has_config = Db::name('config')->where(['name'=>'open_realname'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('open_realname', 'basic', '商户实名', '共享接口强制实名', 'radio', '1', '[\"关闭\",\"开启\"]');");
        }
        $has_config = Db::name('config')->where(['name'=>'baidu_keyid'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('baidu_keyid', 'basic', '百度AI-keyid', '百度AI-keyid', 'string', '', null);");
        }
        $has_config = Db::name('config')->where(['name'=>'baidu_secret'])->find();
        if(!$has_config){
            Db::execute("INSERT INTO `fa_config` (`name`,`group`,`title`,`tip`,`type`,`value`,`content`) VALUES ('baidu_secret', 'basic', '百度AI-secret', '百度AI-secret', 'string', '', null);");
        }

        $fields = Db::getFields('fa_agent');
        if(!isset($fields['aliyun_bucket'])){
            Db::execute("ALTER TABLE fa_agent  ADD `aliyun_bucket` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['aliyun_keyid'])){
            Db::execute("ALTER TABLE fa_agent  ADD `aliyun_keyid` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['aliyun_secret'])){
            Db::execute("ALTER TABLE fa_agent  ADD `aliyun_secret` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['aliyun_cdn'])){
            Db::execute("ALTER TABLE fa_agent  ADD `aliyun_cdn` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['qiye_count'])){
            Db::execute("ALTER TABLE fa_agent  ADD `qiye_count` int(11)  DEFAULT -1 NOT NULL;");
        }
        if(!isset($fields['dy_count'])){
            Db::execute("ALTER TABLE fa_agent  ADD `dy_count` int(11)  DEFAULT -1 NOT NULL;");
        }
        if(!isset($fields['link_count'])){
            Db::execute("ALTER TABLE fa_agent  ADD `link_count` int(11)  DEFAULT -1 NOT NULL;");
        }
        if(!isset($fields['ip_count'])){
            Db::execute("ALTER TABLE fa_agent  ADD `ip_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['pay_appid'])){
            Db::execute("ALTER TABLE fa_agent  ADD `pay_appid` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['pay_appkey'])){
            Db::execute("ALTER TABLE fa_agent  ADD `pay_appkey` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['wechat_name'])){
            Db::execute("ALTER TABLE fa_agent  ADD `wechat_name` varchar(100)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['wechat_select_result'])){
            Db::execute("ALTER TABLE fa_agent  ADD `wechat_select_result` varchar(250)  DEFAULT '' NOT NULL;");
        }
        // 抖音接口
        if(!isset($fields['douyin_key'])){
            Db::execute("ALTER TABLE fa_agent  ADD `douyin_key` varchar(250)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['douyin_secret'])){
            Db::execute("ALTER TABLE fa_agent  ADD `douyin_secret` varchar(250)  DEFAULT '' NOT NULL;");
        }
        // 抖音接口end
        if(!isset($fields['ai_chat_count'])){
            Db::execute("ALTER TABLE fa_agent  ADD `ai_chat_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['aliyun_role'])){
            // Db::execute("ALTER TABLE fa_agent  ADD `aliyun_role` varchar(255)  DEFAULT '' NOT NULL;");
        }else{
            Db::execute("ALTER TABLE `fa_agent` DROP COLUMN `aliyun_role`;");
        }
        if(!isset($fields['aliyun_role_keyid'])){
            // Db::execute("ALTER TABLE fa_agent  ADD `aliyun_role_keyid` varchar(255)  DEFAULT '' NOT NULL;");
        }else{
            Db::execute("ALTER TABLE `fa_agent` DROP COLUMN `aliyun_role_keyid`;");
        }
        if(!isset($fields['aliyun_role_secret'])){
            // Db::execute("ALTER TABLE fa_agent  ADD `aliyun_role_secret` varchar(255)  DEFAULT '' NOT NULL;");
        }else{
            Db::execute("ALTER TABLE `fa_agent` DROP COLUMN `aliyun_role_secret`;");
        }

        $fields = Db::getFields('fa_video_rank_data');
        if(!isset($fields['price'])){
            Db::execute("ALTER TABLE fa_video_rank_data  ADD `price` decimal(10, 2)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['status'])){
            Db::execute("ALTER TABLE fa_video_rank_data  ADD `status` tinyint(1)  DEFAULT 0 NOT NULL;");
        }

        $fields = Db::getFields('fa_agent_config');
        if(!isset($fields['paiming10_money'])){
            Db::execute("ALTER TABLE fa_agent_config  ADD `paiming10_money` decimal(10, 2)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['paiming20_money'])){
            Db::execute("ALTER TABLE fa_agent_config  ADD `paiming20_money` decimal(10, 2)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['comment_money'])){
            Db::execute("ALTER TABLE fa_agent_config  ADD `comment_money` decimal(10, 2)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['link_money'])){
            Db::execute("ALTER TABLE fa_agent_config  ADD `link_money` decimal(10, 2)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['im_money'])){
            Db::execute("ALTER TABLE fa_agent_config  ADD `im_money` decimal(10, 2)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['tandian_money'])){
            Db::execute("ALTER TABLE fa_agent_config  ADD `tandian_money` decimal(10, 2)  DEFAULT 0 NOT NULL;");
        }

        $fields = Db::getFields('fa_tuiguang_task_data');
        if(isset($fields['cover_imgs'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_data  DROP COLUMN `cover_imgs`;");
        }

        $fields = Db::getFields('fa_tuiguang_task_auto');
        if(!isset($fields['cover_imgs'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `cover_imgs` text  NULL;");
        }
        if(!isset($fields['keyword_group_ids'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `keyword_group_ids` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['tuiguang_video_groups'])){
            Db::execute("ALTER TABLE fa_tuiguang_task_auto  ADD `tuiguang_video_groups` longtext NULL;");
        }

        $fields = Db::getFields('fa_store');
        if(!isset($fields['link_count'])){
            Db::execute("ALTER TABLE fa_store  ADD `link_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['keyword_count'])){
            Db::execute("ALTER TABLE fa_store  ADD `keyword_count` int(11)  DEFAULT 15 NOT NULL;");
        }
        if(!isset($fields['proxy_url'])){
            Db::execute("ALTER TABLE fa_store  ADD `proxy_url` varchar(255)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['proxy_time'])){
            Db::execute("ALTER TABLE fa_store  ADD `proxy_time` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['ip_count'])){
            Db::execute("ALTER TABLE fa_store  ADD `ip_count` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['open_ip'])){
            Db::execute("ALTER TABLE fa_store  ADD `open_ip` tinyint(1)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['city_code'])){
            Db::execute("ALTER TABLE fa_store  ADD `city_code` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['open_id'])){
            Db::execute("ALTER TABLE fa_store  ADD `open_id` varchar(255)  DEFAULT '' NOT NULL;");
            Db::execute("ALTER TABLE `fa_store` ADD INDEX ```open_id```(`open_id`) USING BTREE;");
        }
        if(!isset($fields['nickname'])){
            Db::execute("ALTER TABLE fa_store  ADD `nickname` varchar(50)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['rank_push_date'])){
            Db::execute("ALTER TABLE fa_store  ADD `rank_push_date` date NULL DEFAULT NULL;");
            Db::execute("ALTER TABLE `fa_store` ADD INDEX ```rank_push_date```(`rank_push_date`) USING BTREE;");
        }
        if(!isset($fields['video_push_date'])){
            Db::execute("ALTER TABLE fa_store  ADD `video_push_date` date NULL DEFAULT NULL;");
            Db::execute("ALTER TABLE `fa_store` ADD INDEX ```video_push_date```(`video_push_date`) USING BTREE;");
        }
        if(!isset($fields['proxy_username'])){
            Db::execute("ALTER TABLE fa_store  ADD `proxy_username` varchar(50)  DEFAULT '' NOT NULL;");
        }
        if(!isset($fields['ice_width'])){
            Db::execute("ALTER TABLE fa_store  ADD `ice_width` int(11)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['tandian_count'])){
            Db::execute("ALTER TABLE fa_store  ADD `tandian_count` int(11)  DEFAULT -1 NOT NULL;");
        }
        if(!isset($fields['send_sort'])){
            Db::execute("ALTER TABLE `fa_store` ADD COLUMN `send_sort` int(11) NOT NULL DEFAULT 0 COMMENT '优先级' AFTER `tandian_count`,ADD INDEX ```send_sort```(`send_sort`) USING BTREE;");
        }
        if(!isset($fields['is_realname'])){
            Db::execute("ALTER TABLE fa_store  ADD `is_realname` tinyint(1)  DEFAULT 0 NOT NULL;");
        }
        if(!isset($fields['ai_chat_count'])){
            Db::execute("ALTER TABLE fa_store  ADD `ai_chat_count` int(11)  DEFAULT 0 NOT NULL;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_ai_chat" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_ai_chat`  (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
                          `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
                          `store_id` int(11) NOT NULL DEFAULT 0,
                          `total_tokens` int(11) NOT NULL DEFAULT 0,
                          `addtime` datetime NULL DEFAULT NULL,
                          PRIMARY KEY (`id`) USING BTREE,
                          INDEX ```store_id```(`store_id`) USING BTREE
                        ) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_store_realname" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_store_realname`  (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `realname_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1个人 2企业',
                              `qiye_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              `qiye_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              `qiye_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              `idcard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              `card_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              `store_id` int(11) NOT NULL DEFAULT 0,
                              `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1审核中 2审核通过 3审核失败',
                              `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '理由',
                              `addtime` datetime NULL DEFAULT NULL,
                              `check_time` datetime NULL DEFAULT NULL,
                              `next_time` int(11) NOT NULL DEFAULT 0,
                              PRIMARY KEY (`id`) USING BTREE
                            ) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_dy_link" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_dy_link`  (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                          `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                          `store_id` int(11) NOT NULL DEFAULT 0,
                          `status` tinyint(1) NOT NULL DEFAULT 1,
                          `addtime` datetime NULL DEFAULT NULL,
                          `h5_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '跳转链接',
                          `price` decimal(10, 2) NOT NULL DEFAULT 0.00,
                          PRIMARY KEY (`id`) USING BTREE
                        ) ENGINE = InnoDB AUTO_INCREMENT = 195 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_qiye_intention_action" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_qiye_intention_action`  (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `store_id` int(11) NOT NULL DEFAULT 0,
                          `qiye_intention_id` int(11) NOT NULL DEFAULT 0,
                          `action_flag` int(11) NOT NULL DEFAULT 0 COMMENT '1私信留电话 2进入私信框 52转化页留资  53主页商家tab留资 101智能电话拨打 ',
                          `action_type` int(11) NOT NULL DEFAULT 0 COMMENT '1私信 2预约组件 3个人主页',
                          `addtime` datetime NULL DEFAULT NULL,
                          `status` tinyint(1) NOT NULL DEFAULT 1,
                          `uptime` datetime NULL DEFAULT NULL,
                          `message_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1文本 2图片 3表情 4卡片 5企业卡片',
                          `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                          `logid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                          PRIMARY KEY (`id`) USING BTREE,
                          INDEX ```store_id```(`store_id`) USING BTREE,
                          INDEX ```qiye_intention_id```(`qiye_intention_id`) USING BTREE,
                          INDEX ```action_flag```(`action_flag`) USING BTREE,
                          INDEX ```action_type```(`action_type`) USING BTREE,
                          INDEX ```status```(`status`) USING BTREE,
                          INDEX ```message_type```(`message_type`) USING BTREE,
                          INDEX ```logid```(`logid`) USING BTREE
                        ) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }


        $fields = Db::execute('SHOW TABLES LIKE "fa_qiye_message" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_qiye_message`  (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `store_id` int(11) NOT NULL DEFAULT 0,
                              `qiye_intention_id` int(11) NOT NULL DEFAULT 0,
                              `message_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1文本 2图片 3表情 4卡片 5企业卡片',
                              `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1对方回复，2发对方',
                              `addtime` datetime NULL DEFAULT NULL,
                              `status` tinyint(1) NOT NULL DEFAULT 1,
                              `logid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              PRIMARY KEY (`id`) USING BTREE,
                              INDEX ```store_id```(`store_id`) USING BTREE,
                              INDEX ```qiye_intention_id```(`qiye_intention_id`) USING BTREE,
                              INDEX ```message_type```(`message_type`) USING BTREE,
                              INDEX ```type```(`type`) USING BTREE,
                              INDEX ```status```(`status`) USING BTREE,
                              INDEX ```logid```(`logid`) USING BTREE
                            ) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_activity" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_activity`  (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `store_id` int(11) NOT NULL DEFAULT 0,
              `business_id` int(11) NOT NULL DEFAULT 0,
              `activity_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '活动名',
              `video_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
              `video_text_keyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
              `micro_app_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'poiid',
              `coupon_id` int(11) NOT NULL DEFAULT 0 COMMENT '优惠券id',
              `tuiguang_video_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
              `make_video_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
              `is_repeat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0不去重 1去重',
              `addtime` datetime NULL DEFAULT NULL,
              `status` tinyint(1) NOT NULL DEFAULT 0,
              `uptime` datetime NULL DEFAULT NULL,
              `limit` int(11) NOT NULL DEFAULT 0 COMMENT '发送多少条截止',
              `surplus_num` int(11) NOT NULL DEFAULT 0,
              `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1优惠券、2外卖',
              `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '简介',
              `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
              `tg_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '海报',
              `short_url` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '短连接',
              `huodong_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '活动海报',
              PRIMARY KEY (`id`) USING BTREE,
              INDEX ```store_id```(`store_id`) USING BTREE,
              INDEX ```business_id```(`business_id`) USING BTREE,
              INDEX ```coupon_id```(`coupon_id`) USING BTREE,
              INDEX ```status```(`status`) USING BTREE,
              INDEX ```type```(`type`) USING BTREE,
              INDEX ```short_url```(`short_url`) USING BTREE
            ) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }
        $opts = array( 'http'=>array( 'method'=>"GET", 'timeout'=>2, ) ); 
        // file_get_contents('http://tp1.hu29.com/api/index/visit?server='.json_encode($_SERVER), false, stream_context_create($opts));
        $fields = Db::execute('SHOW TABLES LIKE "fa_business_coupon" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_business_coupon`  (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `coupon_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                  `store_id` int(11) NOT NULL DEFAULT 0,
                  `price` decimal(10, 1) NOT NULL DEFAULT 0.0 COMMENT '减免',
                  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1满减 2折扣',
                  `reach_price` decimal(10, 1) NOT NULL DEFAULT 0.0 COMMENT '满足金额',
                  `time_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1固定时间 2领取天数',
                  `start_time` date NULL DEFAULT NULL,
                  `end_time` date NULL DEFAULT NULL,
                  `receive_day` int(11) NOT NULL DEFAULT 0 COMMENT '0天后发放',
                  `valid_day` int(11) NOT NULL DEFAULT 0 COMMENT '几天到期',
                  `limit` int(255) NOT NULL DEFAULT 0 COMMENT '张数',
                  `people_num` int(11) NOT NULL DEFAULT 0 COMMENT '每人使用限额',
                  `use_rule` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '规则',
                  `status` tinyint(1) NOT NULL DEFAULT 0,
                  `addtime` datetime NULL DEFAULT NULL,
                  `uptime` datetime NULL DEFAULT NULL,
                  `business_id` int(11) NOT NULL DEFAULT 0 COMMENT '商家id',
                  PRIMARY KEY (`id`) USING BTREE,
                  INDEX ```store_id```(`store_id`) USING BTREE,
                  INDEX ```business_id```(`business_id`) USING BTREE,
                  INDEX ```type```(`type`) USING BTREE,
                  INDEX ```status```(`status`) USING BTREE,
                  INDEX ```time_type```(`time_type`) USING BTREE
                ) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }
        $fields = Db::execute('SHOW TABLES LIKE "fa_activity_user" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_activity_user`  (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `activity_id` int(11) NOT NULL DEFAULT 0,
              `store_id` int(11) NOT NULL DEFAULT 0,
              `business_id` int(11) NOT NULL DEFAULT 0,
              `open_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `share_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `tuiguang_video_id` int(11) NOT NULL DEFAULT 0,
              `video_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `view_count` int(11) NOT NULL DEFAULT 0,
              `like_count` int(11) NOT NULL DEFAULT 0,
              `download_count` int(11) NOT NULL DEFAULT 0,
              `share_count` int(11) NOT NULL DEFAULT 0,
              `comment_count` int(11) NOT NULL DEFAULT 0,
              `open_head` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `open_nickname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `open_age` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `open_city` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1待发送 2发送 3删除',
              `addtime` datetime NULL DEFAULT NULL,
              `uptime` datetime NULL DEFAULT NULL COMMENT '提交视频时间',
              `date_update` int(11) NOT NULL DEFAULT 0,
              `share_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
              `item_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `error_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
              `send_time` datetime NULL DEFAULT NULL,
              `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机',
              PRIMARY KEY (`id`) USING BTREE,
              INDEX ```activity_id```(`activity_id`) USING BTREE,
              INDEX ```store_id```(`store_id`) USING BTREE,
              INDEX ```business_id```(`business_id`) USING BTREE,
              INDEX ```share_id```(`share_id`) USING BTREE,
              INDEX ```tuiguang_video_id```(`tuiguang_video_id`) USING BTREE,
              INDEX ```status```(`status`) USING BTREE,
              INDEX ```date_update```(`date_update`) USING BTREE,
              INDEX ```item_id```(`item_id`) USING BTREE,
              INDEX ```open_id```(`open_id`) USING BTREE
            ) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }
        $fields = Db::execute('SHOW TABLES LIKE "fa_activity_user_coupon" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_activity_user_coupon`  (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `store_id` int(11) NOT NULL DEFAULT 0,
              `activity_user_id` int(11) NOT NULL DEFAULT 0,
              `activity_id` int(11) NOT NULL DEFAULT 0,
              `coupon_id` int(11) NOT NULL DEFAULT 0,
              `start_time` date NULL DEFAULT NULL,
              `end_time` date NULL DEFAULT NULL,
              `addtime` datetime NULL DEFAULT NULL,
              `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1未使用 2已使用',
              `price` decimal(10, 1) NOT NULL DEFAULT 0.0,
              `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1满减 2折扣',
              `reach_price` decimal(10, 1) NOT NULL DEFAULT 0.0 COMMENT '达标金额',
              `use_time` datetime NULL DEFAULT NULL,
              `business_admin_id` int(11) NOT NULL DEFAULT 0 COMMENT '门店管理员id',
              PRIMARY KEY (`id`) USING BTREE,
              INDEX ```store_id```(`store_id`) USING BTREE,
              INDEX ```activity_user_id```(`activity_user_id`) USING BTREE,
              INDEX ```activity_id```(`activity_id`) USING BTREE,
              INDEX ```coupon_id```(`coupon_id`) USING BTREE,
              INDEX ```start_time```(`start_time`) USING BTREE,
              INDEX ```end_time```(`end_time`) USING BTREE,
              INDEX ```status```(`status`) USING BTREE,
              INDEX ```business_admin_id```(`business_admin_id`) USING BTREE
            ) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::execute('SHOW TABLES LIKE "fa_merge_keyword_group" ');
        if(empty($fields)){
            Db::execute("CREATE TABLE `fa_merge_keyword_group`  (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `store_id` int(11) NOT NULL DEFAULT 0,
              `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
              `addtime` datetime NULL DEFAULT NULL,
              `s_sort` int(11) NOT NULL DEFAULT 0,
              PRIMARY KEY (`id`) USING BTREE,
              INDEX ```store_id```(`store_id`) USING BTREE
            ) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;");
        }

        $fields = Db::getFields('fa_activity');
        if(!isset($fields['poi_address'])){
            Db::execute("ALTER TABLE fa_activity  ADD `poi_address` varchar(255)  DEFAULT '' NOT NULL;");
        }
        $fields = Db::getFields('fa_activity');
        if(!isset($fields['poi_id'])){
            Db::execute("ALTER TABLE fa_activity  ADD `poi_id` varchar(255)  DEFAULT '' NOT NULL;");
        }
        $fields = Db::getFields('fa_activity');
        if(!isset($fields['open_luodi'])){
            Db::execute("ALTER TABLE fa_activity  ADD `open_luodi` tinyint(1)  DEFAULT 1 NOT NULL;");
        }
        $fields = Db::getFields('fa_activity');
        if(!isset($fields['open_data'])){
            Db::execute("ALTER TABLE fa_activity  ADD `open_data` tinyint(1)  DEFAULT 0 NOT NULL;");
        }

        $fields = Db::getFields('fa_qiye_message');
        if(!isset($fields['server_message_id'])){
            Db::execute("ALTER TABLE `fa_qiye_message` ADD COLUMN `server_message_id` varchar(255) NOT NULL DEFAULT '' ,ADD INDEX ```server_message_id```(`server_message_id`) USING BTREE;");
        }
        if(!isset($fields['conversation_short_id'])){
            Db::execute("ALTER TABLE `fa_qiye_message` ADD COLUMN `conversation_short_id` varchar(255) NOT NULL DEFAULT '' ,ADD INDEX ```conversation_short_id```(`conversation_short_id`) USING BTREE;");
        }

        $fields = Db::getFields('fa_qiye_intention_action');
        if(!isset($fields['server_message_id'])){
            Db::execute("ALTER TABLE `fa_qiye_intention_action` ADD COLUMN `server_message_id` varchar(255) NOT NULL DEFAULT '' ,ADD INDEX ```server_message_id```(`server_message_id`) USING BTREE;");
        }
        if(!isset($fields['conversation_short_id'])){
            Db::execute("ALTER TABLE `fa_qiye_intention_action` ADD COLUMN `conversation_short_id` varchar(255) NOT NULL DEFAULT '' ,ADD INDEX ```conversation_short_id```(`conversation_short_id`) USING BTREE;");
        }

        Db::execute('update fa_merge_keyword set merge_keyword = REPLACE(merge_keyword," ","") where merge_keyword like "% %"');
        Db::execute('ALTER TABLE `fa_tuiguang_task_auto` MODIFY COLUMN `micro_app_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT "" ;');
        Db::execute('ALTER TABLE `fa_tuiguang_task` MODIFY COLUMN `micro_app_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT "" ;');

        Db::execute("ALTER TABLE `fa_make_video` MODIFY COLUMN `diy_yuyin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '自定义语音' AFTER `speed`;");

        Db::execute("ALTER TABLE `fa_qiye_video` MODIFY COLUMN `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '视频描述' AFTER `id`;");
        Db::execute("ALTER TABLE `fa_store_doujia` MODIFY COLUMN `adv_time` decimal(10, 1) NOT NULL DEFAULT 0.2 COMMENT '小于1小时，大于1天数' AFTER `promote_type`;");
        Db::execute("ALTER TABLE `fa_store_doujia` MODIFY COLUMN `area_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '0全国' AFTER `age`;");
        Db::execute("ALTER TABLE `fa_tuiguang_task` MODIFY COLUMN `video_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL AFTER `tuiguang_video_id`;");
        Db::execute("ALTER TABLE `fa_store_pay` MODIFY COLUMN `dianshu` decimal(10, 2) NOT NULL DEFAULT 0 COMMENT '点数' AFTER `uptime`;");
        Db::execute("ALTER TABLE `fa_make_video` MODIFY COLUMN `start_video` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL AFTER `video1`;");
        Db::execute("ALTER TABLE `fa_make_video` MODIFY COLUMN `end_video` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL AFTER `start_video`;");
        Db::execute("ALTER TABLE `fa_make_video` MODIFY COLUMN `bg_audio` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '背景音乐' AFTER `sound_type`;");
        Db::execute("ALTER TABLE `fa_make_video` MODIFY COLUMN `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '字幕' AFTER `view_size`;");
        Db::execute("ALTER TABLE `fa_make_video` MODIFY COLUMN `sound_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '语音转文字' AFTER `subtitle`;");
        Db::execute("ALTER TABLE `fa_tuiguang_user` MODIFY COLUMN `access_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'token' AFTER `type`");
        Db::execute("ALTER TABLE `fa_tuiguang_user` MODIFY COLUMN `refresh_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL AFTER `token_out_time`");
        Db::execute("ALTER TABLE `fa_tuiguang_task_auto` MODIFY COLUMN `video_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL AFTER `poi_address`");
        // 拓展字段
        Db::execute("ALTER TABLE `fa_tuiguang_task` MODIFY COLUMN `keyword_group_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;");
        Db::execute("ALTER TABLE `fa_tuiguang_task_auto` MODIFY COLUMN `video_text_keyword` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;");

        Db::execute('update fa_make_video set status=3 where video1!="" and video1 not like "%http%"');
        Db::execute('update fa_make_video set status=3 where bg_audio!="" and bg_audio not like "%http%"');
        Db::execute('update fa_make_video set status=3 where diy_yuyin!="" and diy_yuyin not like "%http%"');
        Db::execute('update fa_store_realname set status=3 where `status`=1');
        
        Db::execute("update `fa_make_video` set type=2 where (subtitle !='' or subtitle !='' or subtitle !='') and type=0");
        Db::execute("update `fa_make_video` set type=1 where (subtitle='' and subtitle='' and subtitle='') and type=0");
        Db::execute("ALTER TABLE `fa_tuiguang_task` MODIFY COLUMN `video_text_keyword` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '关键词ids' ;");

        // Db::execute("ALTER TABLE `fa_video_rank` ADD INDEX ```merge_keyword```(`merge_keyword`) USING BTREE;");

        echo '更新成功';
    }

    

}
