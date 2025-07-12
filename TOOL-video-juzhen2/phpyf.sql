-- MySQL dump 10.13  Distrib 5.6.50, for Linux (x86_64)
--
-- Host: localhost    Database: ceshi1
-- ------------------------------------------------------
-- Server version	5.6.50-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `think_account`
--

DROP TABLE IF EXISTS `think_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '会员状态 1 正常 2 禁用 3.待审核',
  `member_id` int(11) NOT NULL DEFAULT '0',
  `open_id` varchar(255) DEFAULT '0',
  `union_id` varchar(255) DEFAULT '0',
  `video_count` int(11) NOT NULL DEFAULT '0' COMMENT '视频数量',
  `play_count` int(11) NOT NULL DEFAULT '0' COMMENT '曝光数量/播放数量',
  `comment_count` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `digg_count` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `download_count` int(11) NOT NULL DEFAULT '0' COMMENT '下载数量',
  `forward_count` int(11) NOT NULL DEFAULT '0' COMMENT '转发数量',
  `share_count` int(11) NOT NULL DEFAULT '0' COMMENT '分享数量',
  `chat_count` int(11) NOT NULL DEFAULT '0' COMMENT '私信数量',
  `e_account_role` varchar(255) DEFAULT '' COMMENT '`EAccountM` - 普通企业号 * `EAccountS` - 认证企业号 * `EAccountK` - 品牌企业号 ',
  `access_token` varchar(255) DEFAULT '' COMMENT 'access_token',
  `access_token_time` int(11) NOT NULL DEFAULT '0' COMMENT 'access_token的过期时间',
  `refresh_token` varchar(255) DEFAULT NULL COMMENT 'refresh_token',
  `refresh_token_time` int(11) NOT NULL DEFAULT '0' COMMENT 'refresh_token的过期时间',
  `user_refresh_count` int(11) NOT NULL DEFAULT '0' COMMENT '刷新数据次数',
  `user_refresh_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次刷新次数时间',
  `reply_refresh_count` int(11) NOT NULL DEFAULT '0' COMMENT '刷新评论次数',
  `reply_refresh_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次刷新评论时间',
  `customer_refresh_count` int(11) NOT NULL DEFAULT '0' COMMENT '刷新客户次数',
  `customer_refresh_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次刷新客户时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_account`
--

LOCK TABLES `think_account` WRITE;
/*!40000 ALTER TABLE `think_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_account_chat`
--

DROP TABLE IF EXISTS `think_account_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_account_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL DEFAULT '0' COMMENT '企业号id',
  `text` text COMMENT '消息内容',
  `to_user_id` varchar(255) DEFAULT '' COMMENT '接受的open_id',
  `to_cust_id` int(11) NOT NULL DEFAULT '0' COMMENT '接受人的关联客户id',
  `from_user_id` varchar(255) DEFAULT '' COMMENT '发送的open_id',
  `from_cust_id` int(11) NOT NULL DEFAULT '0' COMMENT '发送人的关联客户id',
  `message_id` varchar(255) DEFAULT '' COMMENT '消息id',
  `message_type` varchar(255) DEFAULT '' COMMENT '消息类型',
  `log_id` varchar(255) DEFAULT '' COMMENT '记录id',
  `to_type` int(11) NOT NULL DEFAULT '0' COMMENT '1:平台发送 2:平台接收',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `delete_time` int(11) DEFAULT '0',
  `work_status` int(11) NOT NULL DEFAULT '0' COMMENT '0:待通知 1:已通知',
  `look_status` int(11) NOT NULL DEFAULT '0' COMMENT '0:待查看 1:已查看',
  `chat_auto` int(11) NOT NULL DEFAULT '0' COMMENT '0:待匹配自动回复 1:已匹配',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_account_chat`
--

LOCK TABLES `think_account_chat` WRITE;
/*!40000 ALTER TABLE `think_account_chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_account_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_account_cust`
--

DROP TABLE IF EXISTS `think_account_cust`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_account_cust` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `age` int(11) NOT NULL DEFAULT '0' COMMENT '年龄',
  `city` char(50) DEFAULT NULL COMMENT '城市',
  `gender` int(11) NOT NULL DEFAULT '0' COMMENT '性别 * `0` - 未知 * `1` - 男 * `2` - 女	',
  `is_follow` char(50) DEFAULT '0',
  `leads_level` int(11) DEFAULT '0' COMMENT '用户状态 * `-1` - 没兴趣 * `0` - 了解 * `1` - 有兴趣 * `2` - 有意愿 * `10` - 已转化',
  `telephone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '会员状态 1 正常 2 禁用 3.待审核',
  `account_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属企业号',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户',
  `open_id` varchar(255) DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  `last_chat_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后聊天时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_account_cust`
--

LOCK TABLES `think_account_cust` WRITE;
/*!40000 ALTER TABLE `think_account_cust` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_account_cust` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_account_reply`
--

DROP TABLE IF EXISTS `think_account_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_account_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` varchar(255) DEFAULT '' COMMENT '评论id',
  `comment_user_id` varchar(255) DEFAULT '' COMMENT '该条评论发布者的user_id	',
  `content` text COMMENT '评论的具体内容',
  `digg_count` int(11) NOT NULL DEFAULT '0' COMMENT '该评论的点赞数',
  `reply_comment_total` int(11) NOT NULL DEFAULT '0' COMMENT '该评论的回复数量',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户',
  `account_id` int(11) NOT NULL DEFAULT '0' COMMENT '抖音账号id',
  `account_title` varchar(255) DEFAULT NULL COMMENT '抖音账号昵称',
  `video_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频id',
  `video_title` varchar(255) DEFAULT NULL COMMENT '视频标题',
  `top` char(50) DEFAULT '' COMMENT '该评论是否被置顶',
  `reply_content` text COMMENT '回复评论内容',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0:未回复 1:已回复',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '插入/修改时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_account_reply`
--

LOCK TABLES `think_account_reply` WRITE;
/*!40000 ALTER TABLE `think_account_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_account_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_account_reply_auto`
--

DROP TABLE IF EXISTS `think_account_reply_auto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_account_reply_auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` varchar(255) DEFAULT '' COMMENT '评论id',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1:评论回复 2:私信回复',
  `content` text COMMENT '评论的具体内容',
  `keyword` varchar(255) DEFAULT NULL COMMENT '触发的关键词',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户',
  `account_id` int(11) NOT NULL DEFAULT '0' COMMENT '抖音账号id',
  `account_title` varchar(255) DEFAULT NULL COMMENT '抖音账号昵称',
  `video_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频id',
  `video_title` varchar(255) DEFAULT NULL COMMENT '视频标题',
  `reply_content` text COMMENT '回复评论内容',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0:未回复 1:已回复',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '回复时间',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_account_reply_auto`
--

LOCK TABLES `think_account_reply_auto` WRITE;
/*!40000 ALTER TABLE `think_account_reply_auto` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_account_reply_auto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_account_video`
--

DROP TABLE IF EXISTS `think_account_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_account_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `cover` text,
  `share_url` text,
  `is_reviewed` char(50) DEFAULT '',
  `video_status` int(11) NOT NULL DEFAULT '0',
  `video_id` char(50) DEFAULT '',
  `media_type` int(11) NOT NULL DEFAULT '0',
  `is_top` char(50) DEFAULT '',
  `item_id` varchar(255) DEFAULT NULL,
  `account_id` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) NOT NULL DEFAULT '0',
  `digg_count` int(11) NOT NULL DEFAULT '0',
  `download_count` int(11) NOT NULL DEFAULT '0',
  `forward_count` int(11) NOT NULL DEFAULT '0',
  `play_count` int(11) NOT NULL DEFAULT '0',
  `share_count` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `oem_id` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_account_video`
--

LOCK TABLES `think_account_video` WRITE;
/*!40000 ALTER TABLE `think_account_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_account_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_admin`
--

DROP TABLE IF EXISTS `think_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hunjiancoun` int(11) NOT NULL DEFAULT '0' COMMENT '混剪数量',
  `yunday` int(11) NOT NULL DEFAULT '0' COMMENT '运维天数',
  `pinglun` int(11) NOT NULL DEFAULT '0' COMMENT '评论扣除',
  `yunwei` int(11) NOT NULL DEFAULT '0' COMMENT '运维扣除',
  `hunjian` int(11) NOT NULL DEFAULT '0' COMMENT '混剪扣除',
  `paiming` int(11) NOT NULL DEFAULT '0' COMMENT '排名扣除',
  `fpspkc` int(11) NOT NULL DEFAULT '0' COMMENT '发布视频扣除',
  `fbsp` int(11) NOT NULL DEFAULT '0' COMMENT '发布视频数',
  `bangdingzh` int(11) NOT NULL DEFAULT '0' COMMENT '绑定账号数',
  `spnumber` int(11) NOT NULL DEFAULT '0' COMMENT '视频数量',
  `zhnumber` int(11) NOT NULL DEFAULT '0' COMMENT '账号数量',
  `username` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '密码',
  `loginnum` int(11) DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '最后登录IP',
  `last_login_time` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '真实姓名',
  `status` int(1) DEFAULT '0' COMMENT '状态',
  `groupid` int(11) DEFAULT '1' COMMENT '用户角色id',
  `susername` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '上级',
  `level` int(11) DEFAULT NULL COMMENT '用户组会员组id',
  `vechat` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `vqq` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `emal` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `addtime` int(11) NOT NULL,
  `money` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT NULL COMMENT '上级id',
  `qx` int(11) NOT NULL DEFAULT '0' COMMENT '权限',
  `v1` int(11) NOT NULL DEFAULT '0',
  `v2` int(11) DEFAULT '0',
  `v3` int(11) DEFAULT '0',
  `v4` int(11) NOT NULL DEFAULT '0',
  `edittime` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '编辑时间',
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '贴牌logo',
  `domain` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '贴牌域名',
  `jibie` int(11) DEFAULT NULL COMMENT '1贴牌代理2二级代理3会员',
  `shang` int(11) DEFAULT NULL COMMENT '可开商家数量',
  `dai` int(11) DEFAULT NULL COMMENT '可开代理数量',
  `fabu` int(11) DEFAULT NULL COMMENT '会员可发布视频数量',
  `painame` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '贴牌名称',
  `user_id` text COLLATE utf8_bin COMMENT '所有用户id',
  `user_time` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '到期时间',
  `hyz` int(11) DEFAULT NULL COMMENT '会员组id',
  `jifen` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `apistatus` int(11) NOT NULL DEFAULT '0' COMMENT '是否开启接口',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=284 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_admin`
--

LOCK TABLES `think_admin` WRITE;
/*!40000 ALTER TABLE `think_admin` DISABLE KEYS */;
INSERT INTO `think_admin` VALUES (1,0,0,0,0,0,0,0,1,0,0,0,'admin','218dbb225911693af03a713581a7227f',443,'106.116.176.153',1667886441,'admin',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,2147483347,NULL,0,0,0,0,0,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,',283','2538-06-06',NULL,'0',0),(283,0,0,0,0,0,0,0,0,1,11,11,'ceshi','218dbb225911693af03a713581a7227f',1,'106.116.176.153',1667887221,'测试',1,19,NULL,NULL,NULL,NULL,'',NULL,NULL,1667887174,0,1,0,0,0,0,0,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,'2022-12-11',50,'1000',0);
/*!40000 ALTER TABLE `think_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_adminkey`
--

DROP TABLE IF EXISTS `think_adminkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_adminkey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyname` varchar(255) NOT NULL COMMENT 'key值',
  `status` int(11) NOT NULL COMMENT '状态,1启用-1停止',
  `type` int(1) NOT NULL COMMENT 'key类型',
  `name` varchar(255) NOT NULL COMMENT 'key名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_adminkey`
--

LOCK TABLES `think_adminkey` WRITE;
/*!40000 ALTER TABLE `think_adminkey` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_adminkey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_api`
--

DROP TABLE IF EXISTS `think_api`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientkey` varchar(255) DEFAULT NULL COMMENT '抖音Key',
  `clientsecret` varchar(255) DEFAULT NULL COMMENT '抖音secret',
  `addtime` varchar(255) DEFAULT NULL,
  `alykeyId` varchar(255) DEFAULT NULL COMMENT '阿里云keyid',
  `alykeysecret` varchar(255) DEFAULT NULL COMMENT '阿里云keysecret',
  `appid` varchar(255) DEFAULT NULL COMMENT '快手id',
  `appsecret` varchar(255) DEFAULT NULL COMMENT '快手',
  `alybuket` varchar(255) DEFAULT NULL COMMENT '阿里云Buket地址',
  `alybuketname` varchar(155) DEFAULT NULL COMMENT '阿里云Buket名称',
  `biaoshi` varchar(255) DEFAULT NULL COMMENT '混剪接入区域标识',
  `endpoint` varchar(255) DEFAULT NULL COMMENT '混剪Endpoint',
  `uid` int(11) DEFAULT NULL COMMENT '账户id',
  `url` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT '0',
  `api` int(11) DEFAULT '1',
  `gjckey` varchar(255) DEFAULT NULL,
  `gjcappid` varchar(255) DEFAULT NULL,
  `wx_appid` varchar(255) DEFAULT NULL,
  `wx_appsecret` varchar(255) DEFAULT NULL,
  `qykey` varchar(255) DEFAULT NULL COMMENT '企业号key',
  `qysecret` varchar(255) DEFAULT NULL COMMENT '企业号secret',
  `qyurl` varchar(255) DEFAULT NULL COMMENT '企业号接口地址',
  `key_api` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_api`
--

LOCK TABLES `think_api` WRITE;
/*!40000 ALTER TABLE `think_api` DISABLE KEYS */;
INSERT INTO `think_api` VALUES (1,NULL,NULL,'1667886526',NULL,NULL,NULL,NULL,'oss-cn-shanghai.aliyuncs.com',NULL,'cn-shanghai','ice.cn-shanghai.aliyuncs.com',1,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `think_api` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_audio`
--

DROP TABLE IF EXISTS `think_audio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_audio` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `uid` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_audio`
--

LOCK TABLES `think_audio` WRITE;
/*!40000 ALTER TABLE `think_audio` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_audio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_audio_s`
--

DROP TABLE IF EXISTS `think_audio_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_audio_s` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `url` varchar(255) DEFAULT NULL COMMENT '声音id或链接',
  `audio_id` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_audio_s`
--

LOCK TABLES `think_audio_s` WRITE;
/*!40000 ALTER TABLE `think_audio_s` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_audio_s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_auth_group`
--

DROP TABLE IF EXISTS `think_auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_auth_group`
--

LOCK TABLES `think_auth_group` WRITE;
/*!40000 ALTER TABLE `think_auth_group` DISABLE KEYS */;
INSERT INTO `think_auth_group` VALUES (1,'超级管理员',1,'1,2,9,10,11,12,3,4,13,14,116,117,118,119,122,171,67,115,140,141,142,143,175,71,144,145,72,146,147,186,101,103,150,151,152,153,154,155,156,157,158,174,176,177,178,126,148,149,207,228,73,74,75,99,173,100,108,120,121,110,111,109,84,85,165,166,167,168,169,87,164,114,90,170,188,220,223,261,265,274,112,124,179,180,181,182,183,125,184,185,127,129,130,131,132,104,106,159,163,107,160,161,162,105,172,214,215,221,229,230,231,232,128,133,134,135,137,187,267,268,269,189,200,201,213,208,210,211,212,196,202,203,209,216,217,197,204,205,206,222,224,225,226,227,233,239,235,236,237,238,266,240,241,242,243,244,246,247,248,249,250,251,273,252,254',1446535750,1667546068),(19,'会员',1,'122,101,103,150,151,152,153,154,155,156,157,158,174,176,177,178,126,148,149,207,228,73,74,75,100,108,120,121,110,111,109,112,124,179,180,181,182,183,125,184,185,104,106,159,163,107,160,161,162,105,172,214,215,221,229,230,231,232,135,137,187,267,268,269,189,200,201,213,208,210,211,212,196,202,203,209,216,217,197,204,205,206,222,218,219,224,225,226,227,233,239,235,255,256,257,258,259,260,236,237,238,240,241,242,243,244,246,247,248,249,250,251,273,252,254,263,270,271,272',1650688460,1667872788),(18,'二级代理',1,'122,67,71,144,145,72,146,147,101,103,150,151,152,153,154,155,156,157,158,174,176,177,178,126,148,149,207,228,73,74,75,99,173,100,108,120,121,110,111,109,84,220,274,112,124,179,180,181,182,183,125,184,185,104,106,159,163,107,160,161,162,105,172,214,215,221,229,230,231,232,135,137,187,198,199,267,268,269,189,200,201,213,208,210,211,212,196,202,203,209,216,217,218,219,224,225,226,227,233,239,235,255,256,257,258,259,260,262,236,237,238,266,240,241,242,243,244,246,247,248,249,250,251,273,252,254,263,270,271',1650634865,1667875713),(17,'一级代理',1,'122,67,115,140,141,142,143,71,144,145,72,146,147,101,103,150,151,152,153,154,155,156,157,158,174,176,177,178,126,148,149,207,228,73,74,75,99,173,100,108,120,121,110,111,109,84,85,165,166,167,168,169,87,164,114,220,223,274,112,124,179,180,182,183,125,184,185,104,106,159,163,107,160,161,162,105,172,214,215,221,229,230,231,232,135,267,268,269,189,200,201,213,208,210,211,212,196,202,203,209,216,217,218,219,224,225,226,227,233,239,235,255,256,257,258,259,260,262,236,237,238,266,240,241,242,243,244,246,247,248,249,250,251,273,252,254,263,270,271',1650634681,1667875659);
/*!40000 ALTER TABLE `think_auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_auth_group_access`
--

DROP TABLE IF EXISTS `think_auth_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_auth_group_access`
--

LOCK TABLES `think_auth_group_access` WRITE;
/*!40000 ALTER TABLE `think_auth_group_access` DISABLE KEYS */;
INSERT INTO `think_auth_group_access` VALUES (1,1),(186,17),(187,18),(188,19),(189,19),(190,17),(191,17),(192,19),(193,18),(194,19),(195,19),(196,17),(197,18),(198,19),(199,17),(200,17),(201,18),(202,19),(203,18),(204,19),(205,19),(206,19),(207,19),(208,17),(209,17),(210,19),(211,18),(212,19),(213,19),(214,17),(215,18),(216,17),(217,18),(218,19),(219,18),(220,17),(221,17),(222,18),(223,19),(224,17),(225,19),(226,18),(227,19),(228,19),(229,17),(230,19),(231,19),(232,19),(233,19),(234,19),(235,19),(236,19),(237,17),(238,18),(239,17),(240,19),(241,19),(242,19),(243,19),(244,19),(245,18),(246,19),(247,19),(248,17),(249,19),(250,17),(251,17),(252,17),(253,19),(254,18),(255,19),(256,19),(257,19),(258,18),(259,18),(260,19),(261,19),(262,18),(263,19),(264,19),(265,19),(266,19),(267,17),(268,17),(269,18),(270,17),(271,19),(272,18),(273,19),(274,19),(275,18),(276,18),(277,19),(278,19),(279,18),(280,17),(281,19),(282,19),(283,19);
/*!40000 ALTER TABLE `think_auth_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_auth_rule`
--

DROP TABLE IF EXISTS `think_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `css` varchar(20) NOT NULL COMMENT '样式',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=275 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_auth_rule`
--

LOCK TABLES `think_auth_rule` WRITE;
/*!40000 ALTER TABLE `think_auth_rule` DISABLE KEYS */;
INSERT INTO `think_auth_rule` VALUES (1,'#','总控管理',1,0,'fa fa-gear','',0,1,1446535750,1653385840),(2,'admin/user/index','用户数据',1,1,'','',1,2,1446535750,1653374667),(3,'admin/role/index','角色管理',1,1,'','',1,3,1446535750,0),(4,'admin/menu/index','菜单管理',1,1,'','',1,0,1446535750,0),(5,'#','优化维护',1,0,'icon-youlideSEO','',0,4,1446535750,1642211014),(6,'admin/data/index','数据库备份',1,1,'','',5,5,1446535750,1477639754),(7,'admin/data/optimize','优化表',1,1,'','',6,0,0,1477639789),(8,'admin/data/repair','修复表',1,1,'','',6,0,0,1477639800),(9,'admin/user/useradd','添加用户',1,1,'','',2,0,0,0),(10,'admin/user/useredit','编辑用户',1,1,'','',2,0,0,0),(11,'admin/user/userdel','删除用户',1,1,'','',2,0,0,0),(12,'admin/user/user_state','用户状态更改',1,1,'','',2,0,0,0),(13,'#','日志管理',1,1,'icon-rizhi1','',0,82,0,0),(14,'admin/log/operate_log','操作日志',1,1,'','',13,0,0,0),(27,'admin/data/import','数据库还原',1,1,'','',5,50,1477639870,1477639870),(28,'admin/data/revert','还原',1,1,'','',27,50,1477639972,1477639972),(29,'admin/data/del','删除',1,1,'','',27,50,1477640011,1477640011),(124,'admin/video/renwu','群发任务',1,1,'','',112,48,1646381944,1653803604),(116,'#','用户组管理',1,0,'fa fa-align-center','',0,97,1645783655,1646370220),(117,'admin/member/user_hyz','会员组',1,1,'','',116,50,1645783731,1645783731),(118,'admin/member/user_zjdl','二级代理组',1,1,'','',116,50,1645783765,1646292018),(119,'admin/member/user_gjdl','一级代理组',1,1,'','',116,51,1645783789,1646292007),(120,'admin/video/体育','体育热门榜',1,0,'','',108,50,1646043928,1646043928),(121,'admin/video/redianci','热点话题',1,1,'','',108,50,1646046841,1646750835),(122,'#','首页',1,1,'fa fa-bullseye','',0,100,1646290647,1646369820),(106,'admin/video/addindex','创建混剪',1,1,'','',104,85,1645667839,1658451945),(107,'admin/video/videolist','混剪库列表',1,1,'','',104,80,1645667898,1653373081),(67,'#','用户中心',1,1,'icon-guanliyuan','',0,98,1642210177,1646370051),(115,'admin/member/vip_daili','代理列表',1,1,'','',67,54,1645783540,1650694244),(101,'#','矩阵号运营',1,1,'icon-yonghuzhongxin','',0,97,1645516605,1664506411),(103,'admin/Userinfo/index','添加账号',1,1,'','',101,100,1645517049,1664506870),(71,'admin/member/member_index','会员列表',1,1,'','',67,52,1642210461,1650694267),(72,'admin/member/member_list','会员组管理',1,1,'','',67,51,1642210513,1651043282),(73,'#','财务中心',1,1,'icon-caiwuguanli','',0,84,1642210575,1653373361),(74,'admin/finance/index','消费记录',1,0,'','',73,50,1642210639,1642210639),(75,'admin/finance/recharge','财务记录',1,1,'','',73,50,1642210702,1651559372),(110,'admin/video/topic','热门视频',1,1,'','',108,50,1645668094,1646750674),(111,'admin/video/words','热门标题',1,0,'','',108,50,1645668176,1645668176),(108,'#','上热门推荐',1,1,'icon-fenlei-remen','',0,85,1645667953,1646370252),(109,'admin/video/popularvideo','创作热词',1,1,'','',108,50,1645668054,1646750975),(84,'#','系统设置',1,1,'icon-xitongshezhi1','',0,83,1642225347,1654563878),(85,'admin/usersite/menu','顶部菜单',1,1,'','',84,50,1642225381,1653373227),(87,'admin/usersite/index','版权设置',1,1,'','',84,50,1642225478,1653373262),(112,'#','矩阵发布',1,1,'icon-zhutushipin','',0,92,1645668251,1653372550),(114,'admin/video/xitong','接口设置',1,1,'','',84,50,1645783247,1653373295),(90,'admin/log/operate_log','日志管理',1,0,'','',84,50,1642225636,1642225636),(125,'admin/video/qunfa','添加群发任务',1,0,'','',112,49,1646381974,1653803659),(126,'admin/Userinfo/fenzu','账号分组',1,1,'','',101,99,1646382073,1646382073),(127,'#','获客计划',1,0,'fa fa-align-justify','',0,94,1646443334,1646443469),(104,'#','素材-创作中心',1,1,'icon-shipin1','',0,93,1645667690,1653372954),(105,'admin/video/index','素材管理',1,0,'','',104,86,1645667732,1645667732),(99,'admin/user/upload','收款设置',1,1,'','',73,50,1644308308,1653373380),(100,'admin/user/money','官方充值',1,1,'','',73,50,1644316403,1651559407),(128,'#','线索管理',1,0,'fa fa-area-chart','',0,93,1646443439,1646633301),(129,'admin/huoke/index','关键词管理',1,1,'','',127,50,1646443570,1646443592),(130,'admin/huoke/xscgl','线索词管理',1,1,'','',127,50,1646443626,1646443626),(131,'admin/huoke/jhgl','计划管理',1,1,'','',127,50,1646443652,1646443652),(132,'admin/huoke/jkzh','监控账号',1,1,'','',127,50,1646443683,1646443683),(133,'admin/shangji/index','商机线索',1,1,'','',128,50,1646443714,1646443714),(134,'admin/shangji/zzxs','作者线索',1,1,'','',128,50,1646443759,1646443759),(135,'#','SEO优化',1,1,'icon-youlideSEO','',0,91,1646621143,1653373864),(137,'admin/video/cizu_list','智能标题',1,0,'','',135,95,1646621672,1653373889),(140,'admin/member/moneyadd','代理充值',1,1,'','',115,50,1652280352,1652280352),(141,'admin/member/cha','查询余额',1,1,'','',115,50,1652280732,1652280732),(142,'admin/member/edit_vipdali','编辑代理',1,1,'','',115,50,1652280914,1652281155),(143,'admin/member/add_vipdali','添加代理',1,1,'','',115,50,1652281278,1652281278),(144,'admin/member/member_add','添加会员',1,1,'','',71,50,1652281453,1652281453),(145,'admin/member/member_agent_edit','编辑会员',1,1,'','',71,50,1652281694,1652281694),(146,'admin/member/member_agent_add','添加会员组',1,1,'','',72,50,1652281817,1652281817),(147,'admin/member/edit_hyfz','编辑会员分组',1,1,'','',72,50,1652281922,1652281922),(148,'admin/userinfo/quanxian','添加分组判断权限',1,1,'','',126,50,1652282249,1652282249),(149,'admin/userinfo/edit_id','编辑账号分组查id',1,1,'','',126,50,1652282714,1652282714),(150,'admin/userinfo/fabu','添加账号',1,1,'','',103,50,1652319598,1658307100),(151,'admin/userinfo/poihuoqu','获取poi',1,1,'','',103,50,1652319782,1652319782),(152,'admin/userinfo/fabu_post','发布视频',1,1,'','',103,50,1652319924,1652319924),(153,'admin/userinfo/ksfb_uinfo','执行发布视频',1,1,'','',103,50,1652320084,1652320084),(154,'admin/userinfo/shipinku','视频库',1,1,'','',103,50,1652320158,1652320158),(155,'admin/userinfo/shipin_up','上传素材',1,1,'','',103,50,1652320269,1652320269),(156,'admin/userinfo/shipin_videoid','删除素材',1,1,'','',103,50,1652320371,1652320371),(157,'admin/userinfo/jilu','任务日志',1,1,'','',103,50,1652321421,1652321421),(158,'admin/userinfo/quanxian_del','删除账号',1,1,'','',103,50,1652321508,1652321508),(159,'admin/video/jianji','生成视频',1,1,'','',106,50,1652321835,1652321835),(160,'admin/video/guanli','素材管理',1,1,'','',107,50,1652321971,1652321971),(161,'admin/video/peizhi','配置管理',1,1,'','',107,50,1652322022,1652322022),(162,'admin/video/quanxian','删除列队',1,1,'','',107,50,1652322105,1652322105),(163,'admin/video/yun_lie','创建列队',1,1,'','',106,50,1652322220,1652322220),(164,'admin/usersite/usersit_add','保存数据',1,1,'','',87,50,1652322400,1652322400),(165,'admin/usersite/usersite_add','添加自定义菜单',1,1,'','',85,50,1652322484,1652322484),(166,'admin/usersite/usert_add_l','保存自定义菜单',1,1,'','',85,50,1652323174,1652323174),(167,'admin/usersite/delete','删除自定义菜单',1,1,'','',85,50,1652323223,1652323223),(168,'admin/usersite/usersite_edit','编辑自定义菜单',1,1,'','',85,50,1652323284,1652323284),(169,'admin/usersite/usersite_edit_l','保存编辑',1,1,'','',85,50,1652323333,1652323333),(170,'admin/log/del_log','删除日志',1,1,'','',90,50,1652323617,1652323617),(171,'admin/user/upgrade_log','查看升级日志',1,0,'','',122,50,1652323770,1652323770),(172,'admin/video/duo','上传素材',1,1,'','',105,50,1652325676,1652325676),(173,'admin/user/upload_add','上传',1,1,'','',99,50,1652325831,1652325831),(174,'admin/userinfo/shouquan','授权账号',1,1,'','',103,50,1652326462,1652326462),(175,'admin/member/kaiqi','开启api',1,1,'','',115,50,1652326914,1652326914),(176,'admin/Userinfo/huidiao','授权回调',1,1,'','',103,50,1652327802,1652327802),(177,'admin/userinfo/shipin_up_img','图片上传',1,1,'','',103,50,1652328044,1652328044),(178,'admin/userinfo/quanxian_del','删除账号',1,1,'','',103,50,1652332758,1652332758),(179,'admin/video/jilu','任务记录',1,1,'','',124,50,1652333270,1652333270),(180,'admin/video/wanshan','任务完善',1,1,'','',124,50,1652333406,1652333406),(181,'admin/video/shujubaocun','任务保存1',1,1,'','',124,50,1652333822,1652335214),(182,'admin/video/diyibu','获取第一步数据',1,1,'','',124,50,1652337155,1652337155),(183,'admin/video/shuju','获取数据',1,1,'','',124,2,1652337477,1652337477),(184,'admin/video/single','单发任务',1,1,'','',112,50,1653372705,1653372705),(185,'admin/video/loop','SOP任务',1,1,'','',112,45,1653372847,1653372847),(186,'admin/user/index','全部用户',1,1,'','',67,50,1653373540,1653373672),(187,'admin/video/excellent','新增标题',1,0,'','',135,96,1653374043,1653374043),(188,'admin/usersite/sjxt_index','升级系统',1,1,'','',84,50,1653719830,1653719830),(189,'#','企业号运营',1,0,'fa fa-gear','',0,96,1654510194,1654513596),(196,'#','客户线索询盘',1,1,'icon-xiansuochi','',0,95,1654510901,1654513629),(197,'#','私域运营',1,0,'fa fa-gear','',0,91,1654510929,1654513641),(198,'admin/Huoke/chaxun','SEO查询',1,0,'','',135,94,1654511072,1654511072),(200,'admin/Huoke/add_qiye','增加企业号',1,1,'','',189,50,1654513078,1654513078),(199,'admin/Huoke/liebiao','查询列表',1,0,'','',135,93,1654511140,1654511140),(207,'admin/userinfo/addzh','添加账号',1,0,'','',101,97,1654524456,1654524456),(201,'admin/Huoke/qylbiao','添加企业号',1,1,'','',189,48,1654513117,1664506621),(202,'admin/Huoke/fenlei','客户等级设置',1,1,'','',196,50,1654513212,1656296582),(203,'admin/Huoke/xsliebiao','精准询盘',1,1,'','',196,50,1654513257,1654513257),(204,'admin/Huoke/znhuifu','AI智能助手',1,1,'','',197,50,1654513292,1656485626),(205,'admin/Huoke/sxliebiao','聚合聊天',1,1,'','',197,50,1654513317,1656485507),(206,'admin/Huoke/sxhuifu','私信回复',1,0,'','',197,50,1654513349,1654513349),(208,'admin/Huoke/qyhfz','企业号分组',1,1,'','',189,49,1654524828,1654524828),(209,'admin/Huoke/hfliebiao','评论列表',1,1,'','',196,30,1654566834,1654566834),(210,'admin/Huoke/edit_qyid','获取id编辑企业号分组',1,1,'','',208,50,1654595983,1654595983),(211,'admin/Huoke/edit_updata','分组编辑保存',1,1,'','',208,50,1654597820,1654597820),(212,'admin/Huoke/qydel','删除企业号分组',1,1,'','',208,50,1654598431,1654598764),(213,'admin/Huoke/qyqx','添加企业号权限',1,1,'','',201,50,1654655166,1654655166),(214,'admin/video/yuprw','添加素材',1,0,'','',104,87,1654785050,1655274934),(215,'admin/video/scfl','预剪素材',1,1,'','',104,90,1655430815,1658451930),(216,'admin/huoke/znhf','智能回评',1,1,'','',196,50,1656296619,1656297113),(217,'admin/huoke/znhflb','智能回评列表',1,1,'','',196,50,1656296638,1656296638),(218,'#','本地素材',1,0,'fa fa-user','',0,50,1656381137,1656381137),(219,'admin/Bdsucai/addsucai','素材管理',1,1,'','',218,50,1656381160,1656381160),(220,'admin/usersite/notice','公告管理',1,1,'','',84,50,1656465474,1656465474),(221,'admin/Bdsucai/addsucai','本地素材',1,1,'','',104,50,1656483700,1658452000),(222,'admin/Huoke/khlb','客户列表',1,1,'','',197,50,1656485602,1656485602),(228,'admin/Userinfo/refresh','更新数据',1,1,'','',101,50,1659582688,1659582721),(223,'admin/usersite/pzxi','配置信息',1,1,'','',84,50,1656510368,1656510368),(224,'#','智能标题',1,1,'icon-duojibiaoti','',0,94,1658307392,1658307859),(225,'admin/video/excellent','新增标题',1,1,'','',224,51,1658307549,1658307549),(226,'admin/video/cizu_list','标题列表',1,1,'','',224,50,1658307628,1658307628),(227,'#','数据大屏',1,1,'fa-area-chart','',0,99,1658367511,1658369114),(229,'admin/bdsucai/credits','片头片尾',1,1,'','',104,50,1659763992,1659763992),(230,'admin/bdsucai/writing','字幕管理',1,1,'','',104,50,1661763867,1661763867),(231,'admin/bdsucai/audio','音乐素材库',1,1,'','',104,50,1661781669,1661781669),(232,'admin/bdsucai/stickers','贴纸素材库',1,1,'','',104,50,1663056854,1663056854),(233,'#','企业号运营',1,1,'icon-yonghuzhongxin','',0,99,1664344966,1664344966),(239,'admin/account/index','增加企业号',1,1,'','',233,50,1664345129,1664506683),(235,'admin/account/cust','客户线索',1,1,'','',233,50,1664345038,1664345038),(236,'admin/account/chat','私信互动',1,1,'','',233,50,1664345065,1664345065),(237,'admin/account/reply','评论回复',1,1,'','',233,50,1664345078,1664345078),(238,'admin/account/auto','智能回复',1,1,'','',233,50,1664345099,1664505007),(240,'#','同城裂变',1,1,'icon-biangengguanli','',0,89,1664345392,1664345392),(241,'admin/cityfission/actlist','活动列表',1,1,'','',240,50,1664345408,1664345408),(242,'admin/Cityfission/publish','发布记录',1,1,'','',240,50,1664345421,1664345421),(243,'admin/cityfission/ticket','营销设置',1,1,'','',240,50,1664345433,1664345433),(244,'#','推广偏好',1,1,'icon-tuiguangzhushou','',0,88,1664345585,1664345876),(246,'admin/tool/help','视频加热',1,1,'','',244,50,1664345614,1664345614),(247,'#','实用工具',1,1,'iconfont icon-gongju','',0,86,1664345629,1664345629),(248,'admin/tool/chain','普通外链',1,0,'','',247,50,1664345644,1664345644),(249,'admin/tool/douchain','抖音外链',1,0,'','',247,50,1664345658,1664345658),(250,'admin/tool/watermark','去水印',1,1,'','',247,50,1664345673,1664345673),(251,'admin/tool/violation','违规词检测',1,1,'','',247,50,1664345685,1664345685),(252,'#','认证服务',1,1,'icon-renzheng','',0,87,1664345700,1664345700),(254,'admin/tool/index','服务管理',1,1,'','',252,50,1664345940,1664345940),(261,'admin/tool/vconfig','违规词配置',1,1,'','',84,50,1664436135,1664436135),(263,'admin/tool/tool?id=16','抖音认证',1,1,'','',252,16,1664447835,1664447835),(265,'admin/video/qiye','企业号配置',1,1,'','',84,50,1665196230,1665196230),(266,'admin/account/config','回复配置',1,1,'','',233,50,1665281676,1665281676),(267,'admin/huoke/set_keyword','关键词设置',1,1,'','',135,50,1665471501,1665471501),(268,'admin/Huoke/stock_keyword','关键词词库',1,1,'','',135,50,1665471513,1665471513),(269,'admin/Huoke/form_keyword','优化报表',1,1,'','',135,50,1665471526,1665471526),(270,'admin/tool/tool?id=17','快手认证',1,1,'','',252,17,1665558631,1665558631),(271,'admin/tool/tool?id=18','抖音认证',1,1,'','',252,18,1667203543,1667203543),(273,'admin/tool/videolist','视频列表',1,1,'','',247,50,1667526080,1667526080),(274,'admin/usersite/deduction','扣费配置',1,1,'','',84,50,1667546047,1667546047);
/*!40000 ALTER TABLE `think_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_bat_b`
--

DROP TABLE IF EXISTS `think_bat_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_bat_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL COMMENT '版本名称',
  `addtime` varchar(255) DEFAULT NULL COMMENT '版本更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_bat_b`
--

LOCK TABLES `think_bat_b` WRITE;
/*!40000 ALTER TABLE `think_bat_b` DISABLE KEYS */;
INSERT INTO `think_bat_b` VALUES (4,'zhida_20220505.zip','1651743877'),(5,'zhida_20220507.zip','1651743878'),(6,'zhida_20220509.zip','1111111111'),(7,'zhida_20220510.zip','1111'),(10,'zhida_20220620.zip','1656925689'),(11,'zhida_20220709.zip','1657157957'),(12,'zhida_20220730.zip','1659407247'),(13,'zhida_20220803.zip','1660116535'),(15,'zhida_20221031.zip','1660125680');
/*!40000 ALTER TABLE `think_bat_b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_bdfl`
--

DROP TABLE IF EXISTS `think_bdfl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_bdfl` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `addtime` varchar(255) DEFAULT NULL,
  `uid` int(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1正常2删除',
  `url` varchar(255) DEFAULT NULL COMMENT '备用',
  `uname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_bdfl`
--

LOCK TABLES `think_bdfl` WRITE;
/*!40000 ALTER TABLE `think_bdfl` DISABLE KEYS */;
INSERT INTO `think_bdfl` VALUES (1,'1667887389',283,1,NULL,'1-1');
/*!40000 ALTER TABLE `think_bdfl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_bdld`
--

DROP TABLE IF EXISTS `think_bdld`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_bdld` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `test` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `addtime` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `fid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_bdld`
--

LOCK TABLES `think_bdld` WRITE;
/*!40000 ALTER TABLE `think_bdld` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_bdld` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_bdsp`
--

DROP TABLE IF EXISTS `think_bdsp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_bdsp` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `addtime` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `sj2` varchar(255) DEFAULT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1上传中,2成功3失败 ',
  `mediaIds` text,
  `fid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_bdsp`
--

LOCK TABLES `think_bdsp` WRITE;
/*!40000 ALTER TABLE `think_bdsp` DISABLE KEYS */;
INSERT INTO `think_bdsp` VALUES (1,'1667887401',NULL,'视频',NULL,283,1,'https://liuge-video.oss-cn-shanghai.aliyuncs.com/J34rFtG8Ya.mp4',1,'J34rFtG8Ya.mp4');
/*!40000 ALTER TABLE `think_bdsp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_bdspk`
--

DROP TABLE IF EXISTS `think_bdspk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_bdspk` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `uid` int(255) NOT NULL DEFAULT '0' COMMENT '用户',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1上传中2已完成3上传失败',
  `addtime` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '文件名称',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '文件类型',
  `text` varchar(255) DEFAULT NULL COMMENT '记录信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_bdspk`
--

LOCK TABLES `think_bdspk` WRITE;
/*!40000 ALTER TABLE `think_bdspk` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_bdspk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_cilist`
--

DROP TABLE IF EXISTS `think_cilist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_cilist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci_name` varchar(255) NOT NULL,
  `ci_zc` text,
  `ci_citou` text,
  `ci_diqu` text,
  `ci_cwc` text,
  `ci_cycw` text,
  `ci_zuhe` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2' COMMENT '是否开启，1未开启，2开启',
  `addtime` int(11) DEFAULT NULL,
  `text` text COMMENT '备用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_cilist`
--

LOCK TABLES `think_cilist` WRITE;
/*!40000 ALTER TABLE `think_cilist` DISABLE KEYS */;
INSERT INTO `think_cilist` VALUES (1,'1','制,厂商定制,厂商销售,生产厂商,生产厂商定制,生产厂商销售,供应商,制造厂家,设计,设计方案,生产,供应,定做,定制,来图加工制作,专业定制,可定制','专业的,正规的,靠谱的,放心的,知名的,老牌的,有实力的,大型的,规模大的,口碑好的,好口碑的,性价比高的,平价的,服务好的,服务专业的,有名气的,名气大的,实惠的,好的,质量好的,价格低的,很好的,优质的,优良的,优惠的,省心的,齐全的,技术好的,应用多的,效果好的,稳定的,耐用的,好用的',',石家庄市,邯郸市,唐山市,保定市,秦皇岛市,邢台市,张家口市,承德市,沧州市,廊坊市,衡水市,辛集市,晋州市,新乐市,遵化市,迁安市,霸州市,三河市,定州市,涿州市,安国市,高碑店市,泊头市,任丘市,黄骅市,河间市,冀州市,深州市,南宫市,沙河市,武安市','公司,企业,厂,厂家,厂商,生产厂,生产厂家,公司推荐,工厂,工厂店,公司有哪些,收费标准,厂家报价,厂家定制,厂商定制,厂商销售,生产厂商,生产厂商定制,生产厂商销售,供应商,制造厂家,设计,设计方案,生产,供应,定做,定制,来图加工制作,专业定制,可定制加工,订做,订制,加工,加盟,有哪些,哪家好,哪家不错,哪家有名,哪家服务好,哪家质量好,哪家值得信赖,哪家专业,哪家靠谱,哪家合适,哪里好,哪里不错,哪里有名,哪里专业,哪里靠谱,哪里实惠,哪家正规,哪家实惠,哪个品牌好,哪好','#生产厂商','5',283,2,1667887381,NULL);
/*!40000 ALTER TABLE `think_cilist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_consum`
--

DROP TABLE IF EXISTS `think_consum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_consum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '用户',
  `money` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `text` varchar(255) DEFAULT NULL COMMENT '备注',
  `time` varchar(255) DEFAULT NULL COMMENT '时间',
  `susername` varchar(255) DEFAULT NULL COMMENT '充值公司',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  `count` varchar(255) DEFAULT NULL COMMENT '信息',
  `pai` int(11) NOT NULL DEFAULT '0' COMMENT '排名',
  `ci` varchar(255) DEFAULT NULL COMMENT '关键词',
  `url` varchar(255) DEFAULT NULL COMMENT '域名',
  `url_pc` varchar(255) DEFAULT NULL COMMENT '搜索引擎',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT '平台id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户消费记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_consum`
--

LOCK TABLES `think_consum` WRITE;
/*!40000 ALTER TABLE `think_consum` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_consum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_consumption`
--

DROP TABLE IF EXISTS `think_consumption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_consumption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `engine` varchar(255) DEFAULT NULL COMMENT '搜索引擎',
  `second` varchar(255) DEFAULT NULL COMMENT '关键词',
  `money` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `pai` int(11) NOT NULL DEFAULT '0' COMMENT '排名',
  `time` varchar(255) NOT NULL COMMENT '排名时间',
  `url` varchar(255) NOT NULL DEFAULT '0' COMMENT '网站域名',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户',
  `count` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_consumption`
--

LOCK TABLES `think_consumption` WRITE;
/*!40000 ALTER TABLE `think_consumption` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_consumption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_copy`
--

DROP TABLE IF EXISTS `think_copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xtmc` varchar(255) DEFAULT NULL COMMENT '系统名称',
  `bat` varchar(255) DEFAULT NULL COMMENT '当前版本',
  `jstd` varchar(255) DEFAULT NULL COMMENT '技术团队',
  `qq` varchar(255) DEFAULT NULL COMMENT 'QQ',
  `phone` varchar(255) DEFAULT NULL COMMENT '电话',
  `addtime` varchar(11) DEFAULT NULL,
  `xtgg` varchar(255) DEFAULT NULL COMMENT '系统公告',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_copy`
--

LOCK TABLES `think_copy` WRITE;
/*!40000 ALTER TABLE `think_copy` DISABLE KEYS */;
INSERT INTO `think_copy` VALUES (1,' 中网智达短视频矩阵营销系统','矩阵营销系统V2.2.1',' 短视频矩阵营销系统开发团队','192129979','18518753561','1651823467','系统公告');
/*!40000 ALTER TABLE `think_copy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_coupon`
--

DROP TABLE IF EXISTS `think_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '归属终端用户',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1:满减券 2:折扣券',
  `full` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'type=1时 满多少',
  `cut` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'type=1时 减多少',
  `dis` int(11) NOT NULL DEFAULT '0' COMMENT 'type=2时 折扣',
  `time_type` int(11) NOT NULL DEFAULT '1' COMMENT '1:指定日期 2:过期天数',
  `time_between` varchar(255) DEFAULT NULL COMMENT 'time_type=1 json 0起1尾',
  `time_day` int(11) NOT NULL DEFAULT '0' COMMENT '过期天数',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '发券数',
  `desc` varchar(255) DEFAULT NULL COMMENT '优惠券介绍',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:正常 0:下架',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_coupon`
--

LOCK TABLES `think_coupon` WRITE;
/*!40000 ALTER TABLE `think_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_coupon_user`
--

DROP TABLE IF EXISTS `think_coupon_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_coupon_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '商家id',
  `coupon_id` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券id',
  `phone` varchar(255) DEFAULT NULL COMMENT '领取手机号',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `desc` varchar(255) DEFAULT NULL COMMENT '优惠券介绍',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:正常 2:已核销',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `over_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_coupon_user`
--

LOCK TABLES `think_coupon_user` WRITE;
/*!40000 ALTER TABLE `think_coupon_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_coupon_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_credits`
--

DROP TABLE IF EXISTS `think_credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1片头2片尾 ',
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `url` varchar(255) NOT NULL COMMENT '地址',
  `uname` varchar(255) NOT NULL COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_credits`
--

LOCK TABLES `think_credits` WRITE;
/*!40000 ALTER TABLE `think_credits` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_credits_s`
--

DROP TABLE IF EXISTS `think_credits_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_credits_s` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `credits_id` varchar(255) DEFAULT NULL COMMENT '素材id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT '素材分类id',
  `addtime` varchar(255) DEFAULT NULL,
  `mediaId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_credits_s`
--

LOCK TABLES `think_credits_s` WRITE;
/*!40000 ALTER TABLE `think_credits_s` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_credits_s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_deduction`
--

DROP TABLE IF EXISTS `think_deduction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_deduction` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT '0' COMMENT '主词+头词',
  `headword` varchar(255) DEFAULT '0' COMMENT '头词+尾词',
  `coda` varchar(255) DEFAULT '0' COMMENT '主词+头词+尾词',
  `shear` varchar(255) NOT NULL DEFAULT '0' COMMENT '混剪',
  `discount` varchar(255) NOT NULL DEFAULT '0' COMMENT '优惠券',
  `watermark` varchar(255) NOT NULL DEFAULT '0' COMMENT '去水印',
  `addtime` varchar(255) DEFAULT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `initial` int(255) NOT NULL DEFAULT '0' COMMENT '头词扣费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_deduction`
--

LOCK TABLES `think_deduction` WRITE;
/*!40000 ALTER TABLE `think_deduction` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_deduction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_dengji`
--

DROP TABLE IF EXISTS `think_dengji`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_dengji` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL COMMENT '命中关键词',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '客户等级',
  `huifu` varchar(255) DEFAULT NULL COMMENT '回复话术',
  `addtime` text,
  `uid` int(255) NOT NULL DEFAULT '0',
  `pid` int(255) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '匹配类型',
  `huifutime` varchar(255) DEFAULT NULL COMMENT '回复时间',
  `ci` varchar(255) DEFAULT NULL,
  `comment_id` varchar(255) DEFAULT NULL COMMENT '评论id',
  `comment_user_id` varchar(255) DEFAULT NULL COMMENT '该条评论发布者的user_id',
  `create_time` varchar(255) DEFAULT NULL COMMENT '创建时间',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1未回复2回复',
  `url` varchar(255) NOT NULL COMMENT '视频链接',
  `uname` varchar(255) NOT NULL COMMENT '视频账号昵称',
  `title` varchar(255) DEFAULT NULL COMMENT '视频标题',
  `item_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_dengji`
--

LOCK TABLES `think_dengji` WRITE;
/*!40000 ALTER TABLE `think_dengji` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_dengji` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_dypai`
--

DROP TABLE IF EXISTS `think_dypai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_dypai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '账号id',
  `addtime` varchar(255) NOT NULL COMMENT '添加时间',
  `search_ngines` int(11) NOT NULL COMMENT '类型',
  `token` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL COMMENT '时间',
  `paiming` int(11) DEFAULT '0' COMMENT '排名',
  `pmid` varchar(255) NOT NULL COMMENT '视频id',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `web_url` varchar(255) DEFAULT NULL COMMENT '抖音昵称',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `dy_nickname` varchar(255) DEFAULT NULL,
  `paitime` varchar(255) DEFAULT NULL COMMENT '排名查询时间',
  `username` varchar(255) DEFAULT NULL COMMENT '账号名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_dypai`
--

LOCK TABLES `think_dypai` WRITE;
/*!40000 ALTER TABLE `think_dypai` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_dypai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_extension`
--

DROP TABLE IF EXISTS `think_extension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_extension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT 'adminid',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1:点赞评论量 2:粉丝量 3:主页浏览量 4:评论链接点击获取用户 5:抖音私信获取用户',
  `dy_code` varchar(255) DEFAULT NULL COMMENT '抖音号',
  `video_link` varchar(255) DEFAULT NULL COMMENT '视频链接',
  `time` char(50) DEFAULT NULL COMMENT '投放时长',
  `sex` int(11) NOT NULL DEFAULT '0' COMMENT '1:男 2:女',
  `age` char(50) NOT NULL DEFAULT '0' COMMENT '年龄',
  `place` char(50) DEFAULT NULL COMMENT '1:全国 2:按省市 3:按区县 4:按商圈',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '投放金额',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:正常 2:停止',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_extension`
--

LOCK TABLES `think_extension` WRITE;
/*!40000 ALTER TABLE `think_extension` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_extension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_frames`
--

DROP TABLE IF EXISTS `think_frames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_frames` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) DEFAULT NULL,
  `addtime` varchar(255) NOT NULL DEFAULT '0',
  `uid` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_frames`
--

LOCK TABLES `think_frames` WRITE;
/*!40000 ALTER TABLE `think_frames` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_frames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_frames_s`
--

DROP TABLE IF EXISTS `think_frames_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_frames_s` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `addtime` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `frames_id` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_frames_s`
--

LOCK TABLES `think_frames_s` WRITE;
/*!40000 ALTER TABLE `think_frames_s` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_frames_s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_group`
--

DROP TABLE IF EXISTS `think_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '名称',
  `test` varchar(255) DEFAULT NULL COMMENT '描述',
  `money` varchar(255) DEFAULT NULL COMMENT '金币',
  `uid` int(11) NOT NULL COMMENT '用户id归属',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '级别1高级代理组2中级代理组3会员组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_group`
--

LOCK TABLES `think_group` WRITE;
/*!40000 ALTER TABLE `think_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_haosou`
--

DROP TABLE IF EXISTS `think_haosou`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_haosou` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `errcode` int(11) DEFAULT NULL COMMENT '状态',
  `taskid` int(11) DEFAULT NULL COMMENT '返回id',
  `url` varchar(255) DEFAULT NULL COMMENT '域名',
  `ci` varchar(255) DEFAULT NULL COMMENT '关键词',
  `pc` varchar(255) DEFAULT NULL COMMENT '搜索引擎',
  `appkey` varchar(255) DEFAULT NULL COMMENT 'key',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `money` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_haosou`
--

LOCK TABLES `think_haosou` WRITE;
/*!40000 ALTER TABLE `think_haosou` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_haosou` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_hotsearch`
--

DROP TABLE IF EXISTS `think_hotsearch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_hotsearch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) DEFAULT NULL COMMENT '标签',
  `hot_level` varchar(255) DEFAULT NULL COMMENT '热度',
  `sentence` varchar(255) DEFAULT NULL COMMENT '热点词',
  `addtime` varchar(255) DEFAULT NULL COMMENT '查询时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_hotsearch`
--

LOCK TABLES `think_hotsearch` WRITE;
/*!40000 ALTER TABLE `think_hotsearch` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_hotsearch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_hyfz`
--

DROP TABLE IF EXISTS `think_hyfz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_hyfz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinglun` int(11) NOT NULL DEFAULT '0' COMMENT '运维扣除',
  `yunwei` int(11) NOT NULL DEFAULT '0' COMMENT '运维扣除',
  `hunjian` int(11) NOT NULL DEFAULT '0' COMMENT '混剪扣除',
  `paiming` int(11) NOT NULL DEFAULT '0' COMMENT '排名扣除',
  `fpspkc` int(11) NOT NULL DEFAULT '0' COMMENT '发布视频扣除',
  `username` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `fbnum` varchar(255) DEFAULT NULL COMMENT '发布数量',
  `user_num` varchar(255) DEFAULT NULL COMMENT '绑定账号数量',
  `status` int(11) DEFAULT NULL COMMENT '状态1启用0禁用',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `uid` int(11) DEFAULT NULL COMMENT '添加账号id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_hyfz`
--

LOCK TABLES `think_hyfz` WRITE;
/*!40000 ALTER TABLE `think_hyfz` DISABLE KEYS */;
INSERT INTO `think_hyfz` VALUES (50,0,0,0,0,0,'测试组','1111','1111',1,'1667886906',1);
/*!40000 ALTER TABLE `think_hyfz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_img`
--

DROP TABLE IF EXISTS `think_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `text` varchar(255) DEFAULT NULL COMMENT '备注信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_img`
--

LOCK TABLES `think_img` WRITE;
/*!40000 ALTER TABLE `think_img` DISABLE KEYS */;
INSERT INTO `think_img` VALUES (6,'20221024/bc80410e511cdd1f930dee2059b40d80.php',1,NULL),(7,'20220721/80d3e6e6b52d02559be25599018481f7.jpg',237,NULL),(8,'20220722/a3327d1ac0dc7dd01f2de59466b4307a.jpg',239,NULL);
/*!40000 ALTER TABLE `think_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_inter`
--

DROP TABLE IF EXISTS `think_inter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_inter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '接口名称',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '接口状态',
  `type` int(11) DEFAULT NULL COMMENT '接口类型',
  `name_key` varchar(255) DEFAULT NULL COMMENT '接口id',
  `bd_pc` varchar(255) DEFAULT NULL COMMENT '百度-PC key',
  `bd_pc_s` int(11) DEFAULT '0' COMMENT '百度_pc 状态',
  `bd_yd` varchar(255) NOT NULL COMMENT '百度移动',
  `bd_yd_s` int(11) NOT NULL DEFAULT '0' COMMENT '百度移动状态',
  `360_pc` varchar(255) DEFAULT NULL COMMENT '360_pc',
  `360_pc_s` int(11) NOT NULL DEFAULT '0' COMMENT '360_pc 状态',
  `360_yd` varchar(255) DEFAULT NULL COMMENT '360移动',
  `360_yd_s` int(11) NOT NULL DEFAULT '0' COMMENT '360移动状态',
  `sg_pc` varchar(255) DEFAULT NULL COMMENT '搜狗pc',
  `sg_pc_s` int(11) NOT NULL DEFAULT '0' COMMENT '搜狗pc状态',
  `sg_yd` varchar(255) DEFAULT NULL COMMENT '搜狗移动',
  `sg_yd_s` int(11) NOT NULL DEFAULT '0' COMMENT '搜狗移动状态',
  `sm_pc` varchar(255) DEFAULT NULL COMMENT '神马',
  `sm_pc_s` int(11) NOT NULL DEFAULT '0' COMMENT '神马状态',
  `qz` varchar(255) DEFAULT NULL COMMENT '权重',
  `qz_s` int(11) NOT NULL DEFAULT '0' COMMENT '权重状态',
  `cwc` varchar(255) DEFAULT NULL COMMENT '长尾词',
  `cwc_s` int(11) NOT NULL DEFAULT '0' COMMENT '长尾词状态',
  `fx` varchar(255) DEFAULT NULL COMMENT '分析',
  `fx_s` int(11) NOT NULL DEFAULT '0' COMMENT '分析状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_inter`
--

LOCK TABLES `think_inter` WRITE;
/*!40000 ALTER TABLE `think_inter` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_inter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_log`
--

DROP TABLE IF EXISTS `think_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `admin_name` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `description` varchar(300) DEFAULT NULL COMMENT '描述',
  `ip` char(60) DEFAULT NULL COMMENT 'IP地址',
  `status` tinyint(1) DEFAULT NULL COMMENT '1 成功 2 失败',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_log`
--

LOCK TABLES `think_log` WRITE;
/*!40000 ALTER TABLE `think_log` DISABLE KEYS */;
INSERT INTO `think_log` VALUES (1,1,'admin','用户【admin】登录成功','106.116.176.153',1,1667885607),(2,1,'admin','用户【admin】登录成功','106.116.176.153',1,1667886441),(3,1,'admin','用户【admin】删除管理员成功(ID=281)','106.116.176.153',1,1667886985),(4,1,'admin','用户【admin】删除管理员成功(ID=282)','106.116.176.153',1,1667887097),(5,283,'ceshi','用户【ceshi】登录失败：密码错误','106.116.176.153',2,1667887212),(6,283,'ceshi','用户【ceshi】登录成功','106.116.176.153',1,1667887221);
/*!40000 ALTER TABLE `think_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_management`
--

DROP TABLE IF EXISTS `think_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h5_msg` text,
  `pc` int(11) NOT NULL DEFAULT '0' COMMENT '开启',
  `biaoti` varchar(255) DEFAULT NULL COMMENT '网站标题',
  `ci` varchar(255) DEFAULT NULL COMMENT '网站关键词',
  `miaoshu` varchar(255) DEFAULT NULL COMMENT '网站描述',
  `beian` varchar(255) DEFAULT NULL COMMENT 'ICP备案信息',
  `phone` varchar(255) DEFAULT NULL COMMENT '电话',
  `qq` varchar(255) DEFAULT NULL COMMENT 'qq',
  `xtmc` varchar(255) DEFAULT NULL COMMENT '                            <label class="col-sm-2 control-label">系统名称 :</label>\r\n',
  `dqbb` varchar(255) DEFAULT NULL COMMENT '当前版本',
  `td` varchar(255) DEFAULT NULL COMMENT '技术团队',
  `uid` int(11) NOT NULL COMMENT '谁添加的',
  `spjj` varchar(255) DEFAULT NULL COMMENT '视频扣除',
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `imgnum` varchar(255) DEFAULT NULL COMMENT '图片素材最少张数',
  `dibu` varchar(255) DEFAULT NULL COMMENT '底部信息',
  `fubiaoti` varchar(255) DEFAULT NULL COMMENT '网站副标题',
  `wenjian` int(11) DEFAULT NULL COMMENT '文件最多上传数量',
  `img` varchar(255) DEFAULT NULL COMMENT '背景图片',
  `logo` varchar(255) DEFAULT NULL COMMENT 'logo图片地址备用',
  `count` varchar(255) DEFAULT NULL COMMENT '备用',
  `text` varchar(255) DEFAULT NULL COMMENT '备用',
  `htname` varchar(255) DEFAULT NULL,
  `nylogo` varchar(255) DEFAULT NULL,
  `gzh` varchar(255) DEFAULT NULL,
  `ewm` varchar(255) DEFAULT NULL,
  `jifen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_management`
--

LOCK TABLES `think_management` WRITE;
/*!40000 ALTER TABLE `think_management` DISABLE KEYS */;
INSERT INTO `think_management` VALUES (1,NULL,1,'短视频矩阵营销系统','短视频矩阵，抖音SEO','短视频矩阵分发，智能运营，SEO优化，关键词排名',NULL,NULL,'192129',' 短视频矩阵','V1.0.4beta','短视频矩阵',1,'1','1664535224','1','111','短视频矩阵',NULL,'20220529/07def7126fa7b8adca1aae9fcbfe09ff.jpg',NULL,NULL,NULL,'短视频助手','LOGO.jpg',NULL,NULL,'1');
/*!40000 ALTER TABLE `think_management` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_member_keywords`
--

DROP TABLE IF EXISTS `think_member_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_member_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `keyword_id` varchar(255) DEFAULT '' COMMENT '第三方关键词id',
  `member_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户Id',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1:b 2:ab 3:bc 4:abc',
  `video_link` varchar(255) DEFAULT NULL COMMENT '主页链接',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '单词金额',
  `status` int(11) DEFAULT '1',
  `up_day` int(11) NOT NULL DEFAULT '0' COMMENT '达标天数',
  `up_last_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后达标时间',
  `search_count` int(11) NOT NULL DEFAULT '0' COMMENT '总查询次数',
  `create_time` varchar(255) DEFAULT '0',
  `update_time` varchar(255) DEFAULT '0',
  `delete_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_member_keywords`
--

LOCK TABLES `think_member_keywords` WRITE;
/*!40000 ALTER TABLE `think_member_keywords` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_member_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_member_keywords_log`
--

DROP TABLE IF EXISTS `think_member_keywords_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_member_keywords_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `keyword_id` varchar(255) DEFAULT '' COMMENT '第三方关键词id',
  `member_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户Id',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1:b 2:ab 3:bc 4:abc',
  `video_link` varchar(255) DEFAULT NULL COMMENT '主页链接',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '单词金额',
  `first_rank` int(11) NOT NULL DEFAULT '999' COMMENT '初排',
  `rank` int(11) NOT NULL DEFAULT '999' COMMENT '排名',
  `up_day` int(11) NOT NULL DEFAULT '0' COMMENT '达标天数',
  `up_last_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后达标时间',
  `status` int(11) DEFAULT '1',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `delete_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_member_keywords_log`
--

LOCK TABLES `think_member_keywords_log` WRITE;
/*!40000 ALTER TABLE `think_member_keywords_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_member_keywords_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_menu`
--

DROP TABLE IF EXISTS `think_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) DEFAULT NULL COMMENT '菜单名称',
  `url` varchar(255) DEFAULT NULL COMMENT 'url',
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `uid` int(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_menu`
--

LOCK TABLES `think_menu` WRITE;
/*!40000 ALTER TABLE `think_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_moneyuser`
--

DROP TABLE IF EXISTS `think_moneyuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_moneyuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1混剪2水印3排名4优惠券5积分充值',
  `username` varchar(255) DEFAULT NULL COMMENT '用户',
  `money` int(11) DEFAULT NULL COMMENT '数量',
  `text` varchar(255) DEFAULT NULL COMMENT '备注',
  `time` int(11) DEFAULT NULL COMMENT '时间',
  `susername` varchar(255) DEFAULT NULL COMMENT '充值公司',
  `number` int(11) DEFAULT NULL COMMENT '订单编号',
  `status` int(11) DEFAULT NULL COMMENT '支付状态',
  `uid` int(11) DEFAULT NULL COMMENT '当前用户id',
  `pid` int(11) DEFAULT NULL COMMENT '谁充值的id',
  `count` varchar(255) DEFAULT NULL COMMENT '充值备注',
  `ip` varchar(255) DEFAULT NULL COMMENT 'ip地址',
  `st` int(11) NOT NULL DEFAULT '0' COMMENT '1充值2扣除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_moneyuser`
--

LOCK TABLES `think_moneyuser` WRITE;
/*!40000 ALTER TABLE `think_moneyuser` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_moneyuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_notice`
--

DROP TABLE IF EXISTS `think_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_notice` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL COMMENT '外链地址',
  `text` text,
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1系统公告2常见问题',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_notice`
--

LOCK TABLES `think_notice` WRITE;
/*!40000 ALTER TABLE `think_notice` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_optimization`
--

DROP TABLE IF EXISTS `think_optimization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_optimization` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `username` varchar(255) DEFAULT NULL COMMENT '发布人',
  `url` varchar(255) DEFAULT NULL COMMENT '抖音链接',
  `ranking` int(255) NOT NULL DEFAULT '0' COMMENT '排名',
  `money` int(255) NOT NULL DEFAULT '0' COMMENT '价格',
  `upto` int(255) NOT NULL DEFAULT '0' COMMENT '达标天数',
  `type` varchar(255) DEFAULT NULL COMMENT '类型组合',
  `lasttime` varchar(255) DEFAULT NULL COMMENT '最后查询时间',
  `lastuptime` varchar(255) DEFAULT NULL COMMENT '最后达标时间',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `uid` int(255) NOT NULL DEFAULT '0' COMMENT '用户id',
  `ranking_id` varchar(255) NOT NULL DEFAULT '0' COMMENT '排名查询id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_optimization`
--

LOCK TABLES `think_optimization` WRITE;
/*!40000 ALTER TABLE `think_optimization` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_optimization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_plhf`
--

DROP TABLE IF EXISTS `think_plhf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_plhf` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `comment_id` varchar(255) DEFAULT NULL COMMENT '评论id',
  `comment_user_id` varchar(255) DEFAULT NULL COMMENT '该条评论发布者的user_id',
  `content` varchar(255) DEFAULT NULL COMMENT '评论的具体内容',
  `create_time` varchar(255) DEFAULT NULL COMMENT '创建时间',
  `digg_count` int(255) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `reply_comment_total` int(255) NOT NULL DEFAULT '0' COMMENT '回复数量',
  `status` int(11) NOT NULL DEFAULT '1',
  `huifu` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `uname` varchar(255) DEFAULT NULL COMMENT '用户名称',
  `uid` int(255) DEFAULT NULL COMMENT '账号id',
  `pid` int(255) DEFAULT NULL COMMENT '用户id',
  `item_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_plhf`
--

LOCK TABLES `think_plhf` WRITE;
/*!40000 ALTER TABLE `think_plhf` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_plhf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_pllevle`
--

DROP TABLE IF EXISTS `think_pllevle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_pllevle` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '等级',
  `content` varchar(255) DEFAULT NULL COMMENT '命中关键词',
  `addtime` varchar(255) NOT NULL COMMENT '时间',
  `uid` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_pllevle`
--

LOCK TABLES `think_pllevle` WRITE;
/*!40000 ALTER TABLE `think_pllevle` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_pllevle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_proportion`
--

DROP TABLE IF EXISTS `think_proportion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_proportion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rtion` int(11) DEFAULT NULL COMMENT '价格',
  `level` int(11) DEFAULT NULL COMMENT '会员还是代理',
  `usernameid` int(11) DEFAULT NULL COMMENT '上级id 谁添加的组',
  `zuname` varchar(255) DEFAULT NULL COMMENT '会员组名称',
  `text` varchar(255) DEFAULT NULL COMMENT '会员组备注信息',
  `ctime` int(11) DEFAULT NULL COMMENT '添加或修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_proportion`
--

LOCK TABLES `think_proportion` WRITE;
/*!40000 ALTER TABLE `think_proportion` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_proportion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_pzxi`
--

DROP TABLE IF EXISTS `think_pzxi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_pzxi` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL COMMENT 'URL',
  `img` varchar(255) DEFAULT NULL COMMENT '图片',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `ftitle` varchar(255) DEFAULT NULL COMMENT '副标题',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `xtmc` varchar(255) DEFAULT NULL COMMENT '系统名称',
  `type` int(11) NOT NULL DEFAULT '0',
  `uid` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_pzxi`
--

LOCK TABLES `think_pzxi` WRITE;
/*!40000 ALTER TABLE `think_pzxi` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_pzxi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_quan`
--

DROP TABLE IF EXISTS `think_quan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_quan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `re_comment_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次刷新评论时间',
  `re_video_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次刷新视频时间',
  `refresh_time` varchar(255) DEFAULT NULL,
  `refresh_number` int(11) NOT NULL DEFAULT '0' COMMENT '授权动态次数',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1正常2禁用',
  `access_token` longtext,
  `log_id` varchar(255) DEFAULT NULL,
  `open_id` varchar(255) DEFAULT NULL,
  `refresh_token` longtext,
  `scope` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL COMMENT '用户地址',
  `avatar` varchar(255) DEFAULT NULL COMMENT '小头像地址',
  `avatar_larger` varchar(255) DEFAULT NULL COMMENT '大头像地址',
  `country` varchar(255) DEFAULT NULL COMMENT '国家',
  `client_key` varchar(255) DEFAULT NULL COMMENT 'client_key',
  `nickname` varchar(255) DEFAULT NULL COMMENT '用户抖音名称',
  `province` varchar(255) DEFAULT NULL COMMENT '省',
  `union_id` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL COMMENT '粉丝总数',
  `gender` int(11) DEFAULT NULL COMMENT '性别0未知1那2女',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1抖音2西瓜3头条4快手',
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `shouquan` int(11) NOT NULL DEFAULT '2' COMMENT '授权状态2正常 1过期',
  `fenzuid` int(11) NOT NULL DEFAULT '0' COMMENT '分组id',
  `follow` varchar(255) DEFAULT NULL COMMENT '关注数量',
  `all_count` varchar(255) DEFAULT NULL COMMENT '视频总数',
  `private_count` varchar(255) DEFAULT NULL COMMENT '私自己看',
  `view_count` varchar(255) DEFAULT NULL COMMENT '作品观看人数',
  `like_count` varchar(255) DEFAULT NULL COMMENT '作品点赞人数',
  `comment_count` varchar(255) DEFAULT NULL COMMENT '作品评论数',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `new_share` int(11) DEFAULT NULL COMMENT '分享',
  `forward_count` int(11) DEFAULT NULL COMMENT '转发次数',
  `openid` varchar(255) DEFAULT '0',
  `wx_nickname` varchar(255) DEFAULT NULL,
  `headimgurl` varchar(255) DEFAULT NULL,
  `notice_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_quan`
--

LOCK TABLES `think_quan` WRITE;
/*!40000 ALTER TABLE `think_quan` DISABLE KEYS */;
INSERT INTO `think_quan` VALUES (1,0,0,'2022-11-13',0,1,'act.3._ZMaA8Q5O4DJKT9HlwkZYOE2xzXIIBN6tbNOm6WAPINCrdEUkjkz5ohyRATNfOXyBVbTQQPEScDYdN2F30QPumAQDChqtKqcWJgQrw211ooBgZz8KqxwuiTwO2uLBwU8DYSj81HDX8ivI6YhR9Iu5r690Wx1M0JiJvC4h9l-tXgbXojiSWI3LKrqpcQ=','20221108140233010158162029170FB1B7','_0002zsRtGLUgUy-MGwwTvlTxhTPGhip0-SB','rft.2a0592edea0b48000ea9545f16865386tv9wGjhqXB7zHQNKZUUKQLOSVwHR',NULL,'','https://p3.douyinpic.com/aweme/100x100/aweme-avatar/tos-cn-i-0813_0baac1b61050418c987df3d148157cda.jpeg?from=4010531038','https://p3.douyinpic.com/aweme/1080x1080/aweme-avatar/tos-cn-i-0813_0baac1b61050418c987df3d148157cda.jpeg?from=4010531038','','awyvxpzitab07ouh','步步高空','','c7c9172c-3f7e-42f5-8574-78fa28885113','42c752732868dfe9SFRIgjUpfr7774sVPW8k','',NULL,1,'2022-11-08',2,103,NULL,'',NULL,'','','',283,0,NULL,'0',NULL,NULL,0);
/*!40000 ALTER TABLE `think_quan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_query`
--

DROP TABLE IF EXISTS `think_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_query` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL COMMENT '关键词',
  `search_engine` varchar(255) NOT NULL COMMENT '搜索引擎',
  `area` varchar(255) NOT NULL COMMENT '所在地区',
  `network` varchar(255) NOT NULL COMMENT '所在網絡',
  `site_url` varchar(255) NOT NULL COMMENT '网站域名',
  `rank` int(11) NOT NULL COMMENT '网站排名',
  `page_title` varchar(255) NOT NULL COMMENT '网站标题',
  `site_weight` int(10) NOT NULL COMMENT '权重',
  `ctime` varchar(255) NOT NULL COMMENT '查询时间',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_query`
--

LOCK TABLES `think_query` WRITE;
/*!40000 ALTER TABLE `think_query` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_query` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_ranking`
--

DROP TABLE IF EXISTS `think_ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_ranking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL COMMENT '关键词',
  `name` varchar(255) NOT NULL DEFAULT '0' COMMENT '域名',
  `search` varchar(255) NOT NULL DEFAULT '0' COMMENT '搜索引擎',
  `username` varchar(255) NOT NULL DEFAULT '0' COMMENT '所属用户',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '客户价格',
  `profit` int(11) NOT NULL DEFAULT '0' COMMENT '代理利润',
  `platform` int(11) NOT NULL DEFAULT '0' COMMENT '平台利润',
  `updatetime` datetime NOT NULL COMMENT '排名时间',
  `standard` int(11) NOT NULL DEFAULT '0' COMMENT '达标天数',
  `img` varchar(255) NOT NULL DEFAULT '0' COMMENT '排名截图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_ranking`
--

LOCK TABLES `think_ranking` WRITE;
/*!40000 ALTER TABLE `think_ranking` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_ranking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_redianci`
--

DROP TABLE IF EXISTS `think_redianci`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_redianci` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `hot_level` varchar(255) DEFAULT NULL COMMENT '指数',
  `sentence` varchar(255) DEFAULT NULL COMMENT '标题',
  `addtime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_redianci`
--

LOCK TABLES `think_redianci` WRITE;
/*!40000 ALTER TABLE `think_redianci` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_redianci` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_renwu`
--

DROP TABLE IF EXISTS `think_renwu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_renwu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typ` int(11) NOT NULL DEFAULT '1' COMMENT '用户',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '中间状态',
  `sucai` int(11) DEFAULT '1' COMMENT '视频来源1本地视频库2云素材',
  `chongfu` int(11) DEFAULT NULL COMMENT '重复使用 1禁止2允许',
  `number` int(11) DEFAULT '0' COMMENT '发布数量',
  `jiange` varchar(255) DEFAULT '1800' COMMENT '间隔时间',
  `poiadd` varchar(255) DEFAULT NULL COMMENT '挂载地址',
  `poigz` varchar(255) DEFAULT NULL COMMENT '挂载POI',
  `uid` int(11) DEFAULT NULL COMMENT '账号id',
  `type` int(11) DEFAULT NULL COMMENT '1抖音2西瓜3头条4快手5群发',
  `status` int(11) DEFAULT '1' COMMENT '发布状态 1发布中 2成功',
  `count` int(11) DEFAULT '0' COMMENT '成功数量',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `liedui` int(11) DEFAULT NULL COMMENT '云剪辑列队列表',
  `rwname` varchar(255) DEFAULT NULL COMMENT '任务名称或账号名称',
  `ceshi` int(11) NOT NULL DEFAULT '1',
  `fabutime` varchar(255) DEFAULT NULL COMMENT '发布任务时间',
  `kaishitime` varchar(255) DEFAULT NULL COMMENT '群发开始时间',
  `jieshutime` varchar(255) DEFAULT NULL COMMENT '群发结束时间',
  `jindu` int(11) NOT NULL DEFAULT '0' COMMENT '任务进度',
  `yunid` text COMMENT '素材选择云混剪',
  `user_id` text COMMENT '记录id',
  `delsu` int(11) NOT NULL DEFAULT '1' COMMENT '用户删除，1正常2隐藏',
  `dayrep` int(11) NOT NULL DEFAULT '0' COMMENT '0不重复发送1每天发送',
  `daynum` int(11) NOT NULL DEFAULT '0' COMMENT '每天发送视频数量选中账号的单个数量',
  `daycount` varchar(255) DEFAULT NULL COMMENT '备用1',
  `daytext` varchar(255) DEFAULT NULL COMMENT '备用2',
  `daystatus` int(11) NOT NULL DEFAULT '0' COMMENT '备用3',
  `biaotid` int(11) NOT NULL COMMENT '标题id',
  `types` int(11) NOT NULL COMMENT '判断类型1单个任务2群发任务3循环任务4指定日期发送',
  `zhidingtime` varchar(255) DEFAULT NULL COMMENT '指定日期发送',
  `unlink` varchar(255) DEFAULT NULL COMMENT '备注',
  `stop` int(11) NOT NULL DEFAULT '0',
  `suid` text COMMENT '选中素材id',
  `text` text,
  `task_type` int(11) NOT NULL DEFAULT '0',
  `coupon_id` int(11) NOT NULL DEFAULT '0',
  `coupon_num` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_renwu`
--

LOCK TABLES `think_renwu` WRITE;
/*!40000 ALTER TABLE `think_renwu` DISABLE KEYS */;
INSERT INTO `think_renwu` VALUES (8,2,1,1,2,1,'60',NULL,'6601124128973916164',NULL,3,1,1,'1667887422',NULL,'1-1',1,NULL,'','',1,NULL,'283',1,0,0,NULL,NULL,0,1,1,'',NULL,0,'1',NULL,0,0,0);
/*!40000 ALTER TABLE `think_renwu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_renwu_jour`
--

DROP TABLE IF EXISTS `think_renwu_jour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_renwu_jour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `share_id` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL COMMENT '当前任务id',
  `count` varchar(255) DEFAULT NULL COMMENT '标题或备注',
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `url` varchar(255) DEFAULT NULL COMMENT '视频播放地址',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '发布状态1失败的2成功',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `username` varchar(255) DEFAULT NULL COMMENT '账号',
  `quanid` int(11) DEFAULT NULL COMMENT '授权账号抖音等账号id',
  `item_id` text,
  `types` int(11) NOT NULL DEFAULT '5' COMMENT '1抖音2西瓜3头条4快手5无',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_renwu_jour`
--

LOCK TABLES `think_renwu_jour` WRITE;
/*!40000 ALTER TABLE `think_renwu_jour` DISABLE KEYS */;
INSERT INTO `think_renwu_jour` VALUES (3,'1748906621102084',8,'河间市设计方案哪里专业#生产厂商','1667887435','',2,NULL,'步步高空',1,'@9VwdwOuCRsAkPnXxN9coSM791GPqOPqDMp14qQOvJlkRbvj/60zdRmYqig357zEBrKxE9BxmrT0aPOqTWLg4YQ==',1);
/*!40000 ALTER TABLE `think_renwu_jour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_renwu_usersj`
--

DROP TABLE IF EXISTS `think_renwu_usersj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_renwu_usersj` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(255) DEFAULT NULL COMMENT '视频id',
  `share_url` text COMMENT '视频链接',
  `share_count` int(255) NOT NULL DEFAULT '0' COMMENT '分享数',
  `forward_count` int(255) NOT NULL DEFAULT '0' COMMENT '转发数',
  `comment_count` int(255) NOT NULL DEFAULT '0' COMMENT '评论数',
  `digg_count` int(255) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `download_count` int(255) NOT NULL DEFAULT '0' COMMENT '下载数',
  `play_count` int(255) NOT NULL DEFAULT '0' COMMENT '播放数',
  `quanid` int(255) NOT NULL DEFAULT '0' COMMENT '账号id',
  `addtime` varchar(255) DEFAULT NULL COMMENT '刷新时间',
  `rid` int(255) NOT NULL DEFAULT '0' COMMENT '任务id',
  `cover` text COMMENT '视频封面',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `create_time` varchar(255) DEFAULT NULL COMMENT '创建时间',
  `user_name` varchar(255) DEFAULT NULL COMMENT '账号名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_renwu_usersj`
--

LOCK TABLES `think_renwu_usersj` WRITE;
/*!40000 ALTER TABLE `think_renwu_usersj` DISABLE KEYS */;
INSERT INTO `think_renwu_usersj` VALUES (1,'@9VwdwOuCRsAkPnXxN9coSM791GPqOPqDMp14qQOvJlkRbvj/60zdRmYqig357zEBrKxE9BxmrT0aPOqTWLg4YQ==','https://www.iesdouyin.com/share/video/7163521989099982093/?region=CN&mid=7163522015436622628&u_code=cc8d659de44&did=MS4wLjABAAAANwkJuWIRFOzg5uCpDRpMj4OX-QryoDgn-yYlXQnRwQQ&iid=MS4wLjABAAAANwkJuWIRFOzg5uCpDRpMj4OX-QryoDgn-yYlXQnRwQQ&with_sec_did=1&titleType=title',0,0,0,0,0,0,1,'1667887531',8,'https://p26-sign.douyinpic.com/tos-cn-p-0015/4cce16e4e4c540f88f288cecee09dd5a~c5_300x400.jpeg?x-expires=1669096800&x-signature=3xWmndZQSaAhvmEm%2F11Y9sMuQ6Q%3D&from=3213915784_large&s=PackSourceEnum_PUBLISH&se=false&sc=cover&l=202211081405300101511830510A111C5B','河间市设计方案哪里专业#生产厂商 ','1667887443','步步高空');
/*!40000 ALTER TABLE `think_renwu_usersj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_reply_config`
--

DROP TABLE IF EXISTS `think_reply_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_reply_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT '' COMMENT '命中词',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户Id',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1:回复评论 2:回复私信',
  `content` varchar(255) DEFAULT '' COMMENT '回复话术',
  `status` int(11) DEFAULT '1',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `delete_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=789 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_reply_config`
--

LOCK TABLES `think_reply_config` WRITE;
/*!40000 ALTER TABLE `think_reply_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_reply_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_rmht`
--

DROP TABLE IF EXISTS `think_rmht`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_rmht` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(11) DEFAULT NULL COMMENT '排名',
  `effect_value` varchar(255) DEFAULT NULL COMMENT '影响力指数',
  `title` varchar(255) DEFAULT NULL COMMENT '话题标题',
  `addtime` varchar(255) DEFAULT NULL COMMENT '查询时间',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_rmht`
--

LOCK TABLES `think_rmht` WRITE;
/*!40000 ALTER TABLE `think_rmht` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_rmht` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_rmsp`
--

DROP TABLE IF EXISTS `think_rmsp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_rmsp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) DEFAULT NULL COMMENT '视频发布者昵称',
  `digg_count` varchar(255) DEFAULT NULL COMMENT '点赞数，离线数据',
  `item_cover` varchar(255) DEFAULT NULL COMMENT '视频封面图',
  `play_count` varchar(255) DEFAULT NULL COMMENT '播放数，离线数据',
  `comment_count` varchar(255) DEFAULT NULL COMMENT '评论数，离线数据',
  `hot_words` varchar(255) DEFAULT NULL COMMENT '视频热词',
  `hot_value` varchar(255) DEFAULT NULL COMMENT '热度指数',
  `rank` varchar(255) DEFAULT NULL COMMENT '排名',
  `share_url` varchar(255) DEFAULT NULL COMMENT '视频播放页面',
  `title` varchar(255) DEFAULT NULL COMMENT '视频标题',
  `addtime` varchar(255) DEFAULT NULL COMMENT '查询时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_rmsp`
--

LOCK TABLES `think_rmsp` WRITE;
/*!40000 ALTER TABLE `think_rmsp` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_rmsp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_rw_userid`
--

DROP TABLE IF EXISTS `think_rw_userid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_rw_userid` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `poigz` varchar(255) DEFAULT NULL,
  `ht` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` longtext,
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `user_id` int(255) NOT NULL DEFAULT '0' COMMENT '账号id',
  `rw_id` int(255) NOT NULL DEFAULT '0' COMMENT '任务id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_rw_userid`
--

LOCK TABLES `think_rw_userid` WRITE;
/*!40000 ALTER TABLE `think_rw_userid` DISABLE KEYS */;
INSERT INTO `think_rw_userid` VALUES (3,'6601124128973916164','#生产厂商','河间市设计方案哪里专业','https://liuge-video.oss-cn-shanghai.aliyuncs.com/J34rFtG8Ya.mp4','1667887422',1,8);
/*!40000 ALTER TABLE `think_rw_userid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_rw_userid_s`
--

DROP TABLE IF EXISTS `think_rw_userid_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_rw_userid_s` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `addtime` varchar(255) DEFAULT NULL,
  `user_id` int(255) NOT NULL DEFAULT '0',
  `rw_id` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_rw_userid_s`
--

LOCK TABLES `think_rw_userid_s` WRITE;
/*!40000 ALTER TABLE `think_rw_userid_s` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_rw_userid_s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_scfl`
--

DROP TABLE IF EXISTS `think_scfl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_scfl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `uname` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `status` int(11) DEFAULT '1' COMMENT '启用,或删除',
  `text` varchar(255) DEFAULT NULL COMMENT '备用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_scfl`
--

LOCK TABLES `think_scfl` WRITE;
/*!40000 ALTER TABLE `think_scfl` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_scfl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_splb`
--

DROP TABLE IF EXISTS `think_splb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_splb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `digg_count` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `download_count` int(11) NOT NULL DEFAULT '0' COMMENT '下载数量',
  `play_count` int(11) NOT NULL DEFAULT '0' COMMENT '播放数量',
  `share_count` int(11) NOT NULL DEFAULT '0' COMMENT '分享数量',
  `forward_count` int(11) NOT NULL DEFAULT '0' COMMENT '转发数量',
  `comment_count` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `cover` text COMMENT '封面地址',
  `video_status` int(11) NOT NULL DEFAULT '0' COMMENT '视频状态',
  `share_url` text COMMENT '视频播放地址',
  `uid` int(11) NOT NULL COMMENT '查询账号id',
  `create_time` varchar(255) DEFAULT NULL COMMENT '创建视频时间',
  `count` varchar(255) DEFAULT NULL COMMENT '备用1',
  `text` varchar(255) DEFAULT NULL COMMENT '备用2',
  `counttext` varchar(255) DEFAULT NULL COMMENT '备用3',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1抖音2西瓜3头条4快手',
  `item_id` varchar(255) DEFAULT NULL COMMENT '视频id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_splb`
--

LOCK TABLES `think_splb` WRITE;
/*!40000 ALTER TABLE `think_splb` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_splb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_stickers`
--

DROP TABLE IF EXISTS `think_stickers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_stickers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) DEFAULT NULL COMMENT '名称',
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `uid` varchar(255) DEFAULT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_stickers`
--

LOCK TABLES `think_stickers` WRITE;
/*!40000 ALTER TABLE `think_stickers` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_stickers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_stickers_s`
--

DROP TABLE IF EXISTS `think_stickers_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_stickers_s` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL COMMENT '路径',
  `stickers_id` int(255) DEFAULT NULL,
  `addtime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_stickers_s`
--

LOCK TABLES `think_stickers_s` WRITE;
/*!40000 ALTER TABLE `think_stickers_s` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_stickers_s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_sucai`
--

DROP TABLE IF EXISTS `think_sucai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_sucai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '素材后缀名称',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '素材类型1图片2视频3音乐0未知',
  `url` varchar(255) DEFAULT NULL COMMENT '素材路径',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_sucai`
--

LOCK TABLES `think_sucai` WRITE;
/*!40000 ALTER TABLE `think_sucai` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_sucai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_sucai_user`
--

DROP TABLE IF EXISTS `think_sucai_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_sucai_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video` text COMMENT '视频素材',
  `img` text COMMENT '图片素材',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `uid` int(11) NOT NULL,
  `video_id` text COMMENT '视频id',
  `img_id` varchar(255) DEFAULT NULL COMMENT '图片id',
  `pid` int(11) DEFAULT NULL COMMENT '群发任务id',
  `zc` varchar(255) DEFAULT NULL COMMENT '主词',
  `citou` varchar(255) DEFAULT NULL COMMENT '词头',
  `cwc` varchar(255) DEFAULT NULL COMMENT '长尾词',
  `diqu` varchar(255) DEFAULT NULL COMMENT '地区',
  `cycw` varchar(255) DEFAULT NULL COMMENT '创意词尾',
  `zuhe` varchar(255) DEFAULT NULL COMMENT '组合',
  `user_id` longtext COMMENT '选中用户的id',
  `user_name_id` longtext COMMENT '选中用户的id',
  `sended` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_sucai_user`
--

LOCK TABLES `think_sucai_user` WRITE;
/*!40000 ALTER TABLE `think_sucai_user` DISABLE KEYS */;
INSERT INTO `think_sucai_user` VALUES (1,NULL,NULL,NULL,0,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `think_sucai_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_task`
--

DROP TABLE IF EXISTS `think_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sucai` int(11) NOT NULL DEFAULT '1' COMMENT '素材来源 1本地2云',
  `chongfu` int(11) NOT NULL DEFAULT '2' COMMENT '是否重复1禁止2允许',
  `number` int(11) NOT NULL DEFAULT '1' COMMENT '发布视频数量',
  `jiange` varchar(255) DEFAULT NULL COMMENT '间隔时间',
  `poiadd` varchar(255) DEFAULT NULL COMMENT '挂载地址',
  `poi` int(11) NOT NULL DEFAULT '0' COMMENT '挂载poi 0不挂载1挂载',
  `uid` int(11) DEFAULT NULL COMMENT '发布任务账号id',
  `type` int(11) NOT NULL COMMENT '任务类型1抖音2西瓜3头条4快手5群发',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1发送2成功,3待完善',
  `count` int(11) NOT NULL COMMENT '成功数量',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `liedui` int(11) DEFAULT NULL COMMENT '云列队id',
  `rwname` varchar(255) DEFAULT NULL COMMENT '任务名称',
  `fabutime` varchar(255) DEFAULT NULL COMMENT '发布时间判断时间间隔',
  `kaishitime` varchar(255) DEFAULT NULL COMMENT '开始时间',
  `jieshuttime` varchar(255) DEFAULT NULL COMMENT '结束时间',
  `jindu` int(11) DEFAULT '0' COMMENT '任务进度',
  `yunid` int(11) DEFAULT NULL COMMENT '素材选择混剪id',
  `user_id` int(11) DEFAULT NULL COMMENT '记录id',
  `delsu` int(11) NOT NULL DEFAULT '2' COMMENT '删除1隐藏2正常',
  `video` text COMMENT '视频素材',
  `img` text COMMENT '图片素材',
  `title` text COMMENT '标题',
  `video_id` text COMMENT '发布过的视频id',
  `img_id` text COMMENT '发布过的图片id',
  `zc` text COMMENT '主词',
  `citou` text COMMENT '词头',
  `cwc` text COMMENT '长尾词',
  `diqu` text COMMENT '地区',
  `cycw` text COMMENT '创意词尾',
  `zuhe` text COMMENT '组合模式',
  `userid` text COMMENT '选中账号id',
  `successid` text COMMENT '发布过的账号id',
  `ctext` varchar(255) DEFAULT NULL COMMENT '备用1',
  `url` varchar(255) DEFAULT NULL COMMENT '备用2',
  `sbtext` text COMMENT '备用3',
  `masg` text COMMENT '备用4',
  `zhid` int(11) DEFAULT NULL COMMENT '账号id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='整理任务';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_task`
--

LOCK TABLES `think_task` WRITE;
/*!40000 ALTER TABLE `think_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_tool`
--

DROP TABLE IF EXISTS `think_tool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_tool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT 'tool_cate的id 用来区分是认证的什么项目',
  `param_text` text COMMENT 'json 问题:答案',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0:待审核 1:已返佣 2:不通过',
  `examine_time` int(11) NOT NULL DEFAULT '0' COMMENT '审核时间',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_tool`
--

LOCK TABLES `think_tool` WRITE;
/*!40000 ALTER TABLE `think_tool` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_tool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_tool_cate`
--

DROP TABLE IF EXISTS `think_tool_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_tool_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '添加用户',
  `title` varchar(255) DEFAULT NULL COMMENT '服务名称',
  `desc` varchar(255) DEFAULT NULL COMMENT '注意事项',
  `code` char(50) DEFAULT NULL COMMENT '邀请码',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:正常 2:关闭',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_tool_cate`
--

LOCK TABLES `think_tool_cate` WRITE;
/*!40000 ALTER TABLE `think_tool_cate` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_tool_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_tool_param`
--

DROP TABLE IF EXISTS `think_tool_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_tool_param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '添加人',
  `tool_id` int(11) NOT NULL DEFAULT '0' COMMENT 'tool_cate的id',
  `title` varchar(255) DEFAULT NULL COMMENT '字段名',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1:文本 2文件 3:时间',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序 从小到大',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_tool_param`
--

LOCK TABLES `think_tool_param` WRITE;
/*!40000 ALTER TABLE `think_tool_param` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_tool_param` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_up_log`
--

DROP TABLE IF EXISTS `think_up_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_up_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banbenhao` varchar(255) DEFAULT NULL COMMENT '版本号',
  `banbentime` varchar(255) DEFAULT NULL COMMENT '版本日期',
  `banbencount` text COMMENT '版本内容',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_up_log`
--

LOCK TABLES `think_up_log` WRITE;
/*!40000 ALTER TABLE `think_up_log` DISABLE KEYS */;
INSERT INTO `think_up_log` VALUES (6,'V1.0','2021-11-23','抖音矩阵系统发布','1651224541'),(11,'矩阵营销系统V1.0','2021-11-24','1、优化站点管理逻辑；\n2、增加了接口的稳定性；\n3、增加了日志管理与记录；\n4、修复了发布视频偶尔失效的BUG。','1651281757'),(12,'矩阵营销系统V1.0','2021-11-29','1、增加了创作灵感；\n2、优化了抖音开放平台接口，使之提高了稳定性；\n3、修复视频队列卡顿的问题；\n4、调整了后台配色UI；\n5、增加了代理的权限','1651282936'),(23,'矩阵营销系统V1.0','2021-12-23','1、修复了部分bug，提升了系统的稳定性；\n2、增加了站点管理功能；\n3、自定义菜单功能完善并优化。','1651731442'),(24,'矩阵营销系统V1.0','2022-01-12','1、账号管理页面直接添加账号授权；\n2、修复西瓜视频未能读取相关的参数或者错误；\n3、修复抖音计划任务定时发送失败的问题','1651731542'),(25,'矩阵营销系统V1.01','2022-03-05','1、新增队列管理模式；\n2、视频关键词支持关键词库，提升搜索优化效果；\n3、修复了OSS云存储缓存效率低的问题；\n4、增加了本地存储模式','1651731654'),(26,'矩阵营销系统V1.01','2022-04-01','1、增加热门视频、热点话题的接口，并且进行数据分析，协助做好话题等；\n2、充值接口增加财务记录\n3、优化了部分bug，提升系统的稳定性。','1651731762'),(27,'矩阵营销系统V1.1','2022-05-03','本次更新：重要！重要！一定要更新！\n1、增加了二级代理权限，用于OEM账户开通下级代理；\n2、增加多种算法，为代理收费增多方式；\n3、增加了视频发布数量限制，增加了用户套餐级别；\n4、增加了金币模式，采用计数方式；\n5、增加了批量上传视频模式；\n6、优化了部分BUG。','1651731823'),(28,'矩阵营销系统V1.1','2022-05-05','1、修复会员、代理屏蔽官方信息；\n2、验证了加密通道的数据安全；\n3、修复版本更新时弹窗失灵无取消按钮的BUG','1651758521');
/*!40000 ALTER TABLE `think_up_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_uploadrw`
--

DROP TABLE IF EXISTS `think_uploadrw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_uploadrw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL COMMENT '路径',
  `test` varchar(255) NOT NULL COMMENT '文件备注',
  `type` varchar(255) NOT NULL COMMENT '文件类型',
  `name` varchar(255) NOT NULL COMMENT '文件名称',
  `uid` int(11) NOT NULL COMMENT '任务账号id',
  `addtime` varchar(255) NOT NULL COMMENT '时间',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1上传中2失败',
  `fid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_uploadrw`
--

LOCK TABLES `think_uploadrw` WRITE;
/*!40000 ALTER TABLE `think_uploadrw` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_uploadrw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_user_yun`
--

DROP TABLE IF EXISTS `think_user_yun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_user_yun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mediaIds` text COMMENT '媒体库id',
  `hunjian` text COMMENT '混剪id',
  `uid` int(11) DEFAULT NULL COMMENT '账号id',
  `addtime` varchar(255) DEFAULT NULL COMMENT '时间',
  `count` int(11) NOT NULL DEFAULT '0' COMMENT '备用1',
  `number` varchar(255) DEFAULT NULL COMMENT '备用2',
  `data` varchar(255) DEFAULT NULL COMMENT '备用3',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '备用4',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_user_yun`
--

LOCK TABLES `think_user_yun` WRITE;
/*!40000 ALTER TABLE `think_user_yun` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_user_yun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_violation`
--

DROP TABLE IF EXISTS `think_violation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_violation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keywords` text COMMENT '关键词',
  `create_time` varchar(255) DEFAULT '0',
  `update_time` varchar(255) DEFAULT '0',
  `delete_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_violation`
--

LOCK TABLES `think_violation` WRITE;
/*!40000 ALTER TABLE `think_violation` DISABLE KEYS */;
INSERT INTO `think_violation` VALUES (1,'[\"1\",\"2\",\"3\",\"4\",\"5\"]','1667875115','1667875115',0);
/*!40000 ALTER TABLE `think_violation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_watermark_url`
--

DROP TABLE IF EXISTS `think_watermark_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_watermark_url` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `url` longtext,
  `video` longtext,
  `title` varchar(255) DEFAULT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `addtime` varchar(255) DEFAULT NULL,
  `money` varchar(255) DEFAULT NULL,
  `image` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_watermark_url`
--

LOCK TABLES `think_watermark_url` WRITE;
/*!40000 ALTER TABLE `think_watermark_url` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_watermark_url` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_website`
--

DROP TABLE IF EXISTS `think_website`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL COMMENT '网站名称',
  `website_url` varchar(255) DEFAULT NULL COMMENT '网站url',
  `website_admin` varchar(255) DEFAULT NULL COMMENT '网站后台地址',
  `website_pass` varchar(255) DEFAULT NULL COMMENT '网站后台密码',
  `website_ftpadd` varchar(255) DEFAULT NULL COMMENT '网站ftp地址',
  `website_ftp` varchar(255) DEFAULT NULL COMMENT '网站ftp账号',
  `website_ftppass` varchar(255) DEFAULT NULL COMMENT '网站ftp密码',
  `website_text` varchar(255) DEFAULT NULL COMMENT '网站备注信息',
  `website_time` int(11) NOT NULL COMMENT '添加时间',
  `website_status` int(11) NOT NULL DEFAULT '1' COMMENT '状态1审核中2管理员已审核3平台审核成功0审核不通过',
  `website_uname` varchar(255) DEFAULT NULL COMMENT '后台账号',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `susernameid` int(11) DEFAULT NULL COMMENT '上级id',
  `url_jin` int(11) NOT NULL DEFAULT '0' COMMENT '今日达标',
  `xf_jin` int(11) NOT NULL DEFAULT '0' COMMENT '今日消费',
  `money_zong` int(11) NOT NULL DEFAULT '0' COMMENT '累计消费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_website`
--

LOCK TABLES `think_website` WRITE;
/*!40000 ALTER TABLE `think_website` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_website` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_word`
--

DROP TABLE IF EXISTS `think_word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_word` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '所属用户',
  `website_url` varchar(255) DEFAULT NULL COMMENT '所属域名',
  `website_ci` varchar(255) DEFAULT NULL COMMENT '关键词',
  `website_money` varchar(255) DEFAULT NULL COMMENT '客户价格',
  `website_money_c` varchar(255) DEFAULT NULL COMMENT '代理利润',
  `website_pc` varchar(255) DEFAULT NULL COMMENT '搜索引擎',
  `website_status` int(11) NOT NULL COMMENT '审核状态',
  `website_she` int(11) NOT NULL COMMENT '优化状态',
  `website_time` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '网站url id',
  `website_pai` int(11) DEFAULT '0' COMMENT '排名',
  `website_num` int(11) DEFAULT NULL COMMENT '达标天数',
  `website_img` varchar(255) DEFAULT NULL COMMENT '排名截图',
  `website_bao` int(11) DEFAULT NULL COMMENT '申请报错',
  `website_text` varchar(255) DEFAULT NULL COMMENT '申请原因',
  `website_t` varchar(255) DEFAULT NULL COMMENT '审核不通过原因',
  `website_sto` varchar(255) DEFAULT NULL COMMENT '申请停止优化',
  `website_stat` int(11) DEFAULT NULL COMMENT '状态默认为空',
  `unm` int(11) DEFAULT '0' COMMENT '达标天数',
  `add_time` varchar(255) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_word`
--

LOCK TABLES `think_word` WRITE;
/*!40000 ALTER TABLE `think_word` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_word` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_words`
--

DROP TABLE IF EXISTS `think_words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_words` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `subject` longtext COMMENT '主词',
  `headword` longtext COMMENT '头词',
  `coda` longtext COMMENT '尾词',
  `type` varchar(255) DEFAULT NULL COMMENT '组合模式',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `uid` int(255) NOT NULL COMMENT '用户id',
  `keyword` longtext COMMENT '词',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_words`
--

LOCK TABLES `think_words` WRITE;
/*!40000 ALTER TABLE `think_words` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_writing`
--

DROP TABLE IF EXISTS `think_writing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_writing` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `content` int(11) DEFAULT NULL,
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `uid` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_writing`
--

LOCK TABLES `think_writing` WRITE;
/*!40000 ALTER TABLE `think_writing` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_writing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_writing_content`
--

DROP TABLE IF EXISTS `think_writing_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_writing_content` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `writing_id` int(255) NOT NULL COMMENT '字幕id',
  `addtime` varchar(255) NOT NULL COMMENT '添加时间',
  `content` text COMMENT '字幕',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_writing_content`
--

LOCK TABLES `think_writing_content` WRITE;
/*!40000 ALTER TABLE `think_writing_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_writing_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_xfjl`
--

DROP TABLE IF EXISTS `think_xfjl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_xfjl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `num` int(11) DEFAULT NULL COMMENT '生成数量',
  `addtime` varchar(255) DEFAULT NULL COMMENT '记录时间',
  `text` varchar(255) DEFAULT NULL COMMENT '记录信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_xfjl`
--

LOCK TABLES `think_xfjl` WRITE;
/*!40000 ALTER TABLE `think_xfjl` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_xfjl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_yun_renwu`
--

DROP TABLE IF EXISTS `think_yun_renwu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_yun_renwu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pianwei` int(11) NOT NULL DEFAULT '0' COMMENT '片尾id',
  `piantou` int(11) NOT NULL DEFAULT '0' COMMENT '片头id',
  `yun_spsy` int(11) NOT NULL DEFAULT '0' COMMENT '视频原声',
  `yun_zimugain` int(11) NOT NULL DEFAULT '1' COMMENT '字幕声音大小',
  `yun_zimuvideo` varchar(255) NOT NULL DEFAULT 'xiaoyun' COMMENT '字幕人声',
  `yun_zimucolor` varchar(255) NOT NULL DEFAULT '#000000' COMMENT '字幕颜色',
  `yun_zimusize` int(11) NOT NULL DEFAULT '1' COMMENT '字幕大小',
  `yun_ftitlecolor` varchar(255) NOT NULL DEFAULT '#000000' COMMENT '副标题颜色',
  `yun_ftitlesize` int(11) NOT NULL DEFAULT '1' COMMENT '副标题大小',
  `yun_titlecolor` varchar(255) NOT NULL DEFAULT '#000000' COMMENT '标题颜色',
  `yun_titlesize` int(11) NOT NULL DEFAULT '15' COMMENT '标题字体大小',
  `yun_zimu` text,
  `yun_ftitle` text,
  `yun_title` text,
  `yun_img` text COMMENT '图片数量',
  `yun_video` text COMMENT '视频数量',
  `yun_voice` text COMMENT '音乐数量',
  `yun_shengcheng` varchar(255) DEFAULT NULL COMMENT '生成数量',
  `yun_fabu` varchar(255) DEFAULT NULL COMMENT '发布数量',
  `yun_status` int(11) NOT NULL DEFAULT '1' COMMENT '发布状态 1待完善 2可生成3生成中',
  `yun_addtime` varchar(255) DEFAULT NULL COMMENT '创建时间',
  `yun_name` varchar(255) DEFAULT NULL COMMENT '队列名称',
  `yun_uid` int(11) DEFAULT NULL COMMENT '绑定账号id',
  `yun_num` int(11) DEFAULT NULL COMMENT '单次生成数量',
  `yu_min` varchar(255) DEFAULT NULL COMMENT '生成时长最短',
  `yun_max` varchar(255) DEFAULT NULL COMMENT '生成时长最长',
  `yun_bili` int(11) DEFAULT NULL COMMENT '视频比例,1[9:16],2[4:3],3[16:9],4[1:1]',
  `yun_width` varchar(255) DEFAULT NULL COMMENT '视频尺寸宽度',
  `yun_height` varchar(255) DEFAULT NULL COMMENT '视频尺寸高度',
  `yun_pintu` int(11) DEFAULT NULL COMMENT '动态拼图特效 1开启 0关闭',
  `yun_dong` int(11) DEFAULT NULL COMMENT '声音输出 1开启 0关闭',
  `yun_jie` int(11) DEFAULT NULL COMMENT '视频节奏 1正常 2快节奏 3慢节奏',
  `yun_type` int(11) DEFAULT NULL COMMENT '类型',
  `yunid` text COMMENT 'sucaiid',
  `jianjiid` text COMMENT '合成id',
  `fb_id` text COMMENT '发布id',
  `uid` int(11) DEFAULT NULL COMMENT '添加任务账号id',
  `audio` int(255) NOT NULL DEFAULT '0' COMMENT '背景音乐id',
  `yun_hyzt` int(255) NOT NULL DEFAULT '0' COMMENT '字体',
  `frames_id` int(255) NOT NULL DEFAULT '0',
  `stickers` int(255) NOT NULL DEFAULT '0' COMMENT '贴纸库id',
  `titlePosition` int(11) NOT NULL DEFAULT '1' COMMENT '标题1顶部2居中',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_yun_renwu`
--

LOCK TABLES `think_yun_renwu` WRITE;
/*!40000 ALTER TABLE `think_yun_renwu` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_yun_renwu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_yusid`
--

DROP TABLE IF EXISTS `think_yusid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_yusid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL COMMENT '内容库id',
  `uid` int(11) NOT NULL COMMENT '任务id',
  `sended` int(11) DEFAULT '0' COMMENT '是否已发',
  `addtime` varchar(255) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_yusid`
--

LOCK TABLES `think_yusid` WRITE;
/*!40000 ALTER TABLE `think_yusid` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_yusid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_zhfz`
--

DROP TABLE IF EXISTS `think_zhfz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_zhfz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count` varchar(255) NOT NULL DEFAULT '0' COMMENT '分组备注 ',
  `stat` int(11) NOT NULL DEFAULT '0' COMMENT '1开启0关闭 ',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型1个人账号2企业账号   ',
  `fzname` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `fzpai` varchar(255) NOT NULL DEFAULT '50' COMMENT '分组排序',
  `sattus` int(11) NOT NULL DEFAULT '2' COMMENT '状态2显示1隐藏',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `uid` int(111) NOT NULL COMMENT '账号id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_zhfz`
--

LOCK TABLES `think_zhfz` WRITE;
/*!40000 ALTER TABLE `think_zhfz` DISABLE KEYS */;
INSERT INTO `think_zhfz` VALUES (103,'0',0,1,'1','1',2,'1667887318',283);
/*!40000 ALTER TABLE `think_zhfz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_zhineng`
--

DROP TABLE IF EXISTS `think_zhineng`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_zhineng` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL DEFAULT '0',
  `addtime` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT '匹配词',
  `hcontent` varchar(255) NOT NULL COMMENT '回复词',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_zhineng`
--

LOCK TABLES `think_zhineng` WRITE;
/*!40000 ALTER TABLE `think_zhineng` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_zhineng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `think_znhflb`
--

DROP TABLE IF EXISTS `think_znhflb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `think_znhflb` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL COMMENT '命中关键词',
  `huifu` varchar(255) DEFAULT NULL COMMENT '回复话术',
  `addtime` varchar(255) DEFAULT NULL COMMENT '评论时间',
  `htime` varchar(255) DEFAULT NULL COMMENT '回复时间',
  `uid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `hcontent` varchar(255) NOT NULL COMMENT '回复词',
  `uname` varchar(255) DEFAULT NULL COMMENT '账号昵称',
  `url` varchar(255) DEFAULT NULL COMMENT '视频链接',
  `title` varchar(255) NOT NULL COMMENT '视频标题',
  `type` int(11) NOT NULL DEFAULT '0',
  `ci` varchar(255) DEFAULT NULL COMMENT '命中词',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `think_znhflb`
--

LOCK TABLES `think_znhflb` WRITE;
/*!40000 ALTER TABLE `think_znhflb` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_znhflb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ceshi1'
--

--
-- Dumping routines for database 'ceshi1'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-08 14:19:03
