DROP TABLE IF EXISTS `shua_shequ`;
CREATE TABLE `shua_shequ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `shua_points`
ADD COLUMN `orderid` int(11) DEFAULT NULL;

ALTER TABLE `shua_tools`
MODIFY COLUMN `input` varchar(80) NOT NULL,
MODIFY COLUMN `inputs` varchar(120) DEFAULT NULL,
MODIFY COLUMN `curl` varchar(255) DEFAULT NULL,
ADD COLUMN `multi` tinyint(1) NOT NULL DEFAULT '0',
ADD COLUMN `shequ` tinyint(3) NOT NULL DEFAULT '0';

ALTER TABLE `shua_pay`
ADD COLUMN `num` int(11) NOT NULL DEFAULT '1';

ALTER TABLE `shua_orders`
ADD COLUMN `result` text DEFAULT NULL;

INSERT INTO `shua_config` VALUES ('gg_search', '�������ȴ���������<br/>
���ڴ���/����ɣ��������������µ���������ֱ���µ���ɣ������Ƕ�����ˢ�꣬�����Ѿ��ύ���������ڡ�');
INSERT INTO `shua_config` VALUES ('chatframe', '<!-- UY BEGIN -->
<div id="uyan_frame"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js"></script>
<!-- UY END -->');