/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : btc9

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-06-22 22:28:48
*/

drop database if exists `bitcoin`;

create database `bitcoin`;

use `bitcoin`;

SET FOREIGN_KEY_CHECKS=0;
SET character_set_server = utf8 ;


-- ----------------------------
-- Table structure for `qq3479015851_admin`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_admin`;
CREATE TABLE `qq3479015851_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `username` char(16) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `moble` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `last_login_time` int(11) unsigned NOT NULL,
  `last_login_ip` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员表';

-- ----------------------------
-- Records of qq3479015851_admin
-- ----------------------------
INSERT INTO `qq3479015851_admin` VALUES ('1', '', 'admin', '币创网', '', '21232f297a57a5a743894a0e4a801fc3', '0', '0', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_adver`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_adver`;
CREATE TABLE `qq3479015851_adver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `img` varchar(250) NOT NULL,
  `type` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告图片表';

-- ----------------------------
-- Records of qq3479015851_adver
-- ----------------------------
INSERT INTO `qq3479015851_adver` VALUES ('1', '', 'https://www.thbtc.com/Issue/index', '5902d48101985.jpg', '', '0', '1475466480', '1475466480', '1');
INSERT INTO `qq3479015851_adver` VALUES ('2', '', 'https://www.thbtc.com/award/index.html', '58b6aab40791e.jpg', '', '0', '1475466565', '1475466565', '1');

-- ----------------------------
-- Table structure for `qq3479015851_appads`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_appads`;
CREATE TABLE `qq3479015851_appads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `content` varchar(256) NOT NULL,
  `url` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `block_id` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告图片表';

-- ----------------------------
-- Records of qq3479015851_appads
-- ----------------------------
INSERT INTO `qq3479015851_appads` VALUES ('1', '1', '222', 'http://www.ylthfj.com/Upload/ad/58b6aab40791e.jpg', '/Upload/app/594bc02265f7c.png', '', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_appadsblock`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_appadsblock`;
CREATE TABLE `qq3479015851_appadsblock` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `content` varchar(256) NOT NULL,
  `rank` varchar(256) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `remain` varchar(255) DEFAULT '3',
  `type` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告图片表';

-- ----------------------------
-- Records of qq3479015851_appadsblock
-- ----------------------------
INSERT INTO `qq3479015851_appadsblock` VALUES ('1', 'wap广告', 'wap广告', '1', '/Upload/app/58eb489aa0fe6.jpg', '', '', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_appc`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_appc`;
CREATE TABLE `qq3479015851_appc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_name` varchar(64) DEFAULT NULL,
  `web_title` varchar(64) DEFAULT NULL,
  `web_icp` varchar(64) DEFAULT NULL,
  `index_img` varchar(256) DEFAULT NULL,
  `pay` varchar(256) DEFAULT NULL,
  `withdraw_notice` varchar(256) DEFAULT NULL,
  `charge_notice` varchar(256) DEFAULT NULL,
  `show_coin` varchar(255) DEFAULT NULL,
  `show_market` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_appc
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_app_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_app_log`;
CREATE TABLE `qq3479015851_app_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `content` varchar(255) NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_app_log
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_app_vip`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_app_vip`;
CREATE TABLE `qq3479015851_app_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `rule` text,
  `times` int(11) DEFAULT NULL,
  `price_num` varchar(255) DEFAULT NULL,
  `price_coin` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `addtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_app_vip
-- ----------------------------
INSERT INTO `qq3479015851_app_vip` VALUES ('1', '1', 'VIP会员卡', '[{\"id\":\"1\",\"num\":1000}]', '100', '100', '3', '1', '1476004810');

-- ----------------------------
-- Table structure for `qq3479015851_app_vipuser`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_app_vipuser`;
CREATE TABLE `qq3479015851_app_vipuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `vip_id` int(11) NOT NULL,
  `addtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_app_vipuser
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_article`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_article`;
CREATE TABLE `qq3479015851_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `adminid` int(10) unsigned NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `hits` int(11) unsigned NOT NULL,
  `footer` int(11) unsigned NOT NULL,
  `index` int(11) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `type` (`type`),
  KEY `adminid` (`adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of qq3479015851_article
-- ----------------------------
INSERT INTO `qq3479015851_article` VALUES ('5', '币创币每日分红说明', '<h4 class=\"dividend-hd\" style=\"font-family:\'Microsoft YaHei\';font-size:36px;\">\r\n	<span style=\"font-size:16px;\">分红规则</span> \r\n</h4>\r\n<div class=\"dividend-rule\" style=\"margin:10px 0px;font-size:24px;color:#333333;font-family:\'Microsoft YaHei\';\">\r\n	<p>\r\n		<span style=\"font-size:14px;\">1:每天10：50发放分红</span> \r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:14px;\">2:(每天的总利润/总持币量)*你的持币量(THC)，即是你的分红金额。</span> \r\n	</p>\r\n</div>', '1', 'aaa', '0', '1', '1', '0', '1480324940', '1480324942', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('6', '币创网网企业备案查询', '<p>\r\n	<span style=\"font-size:18px;\"><a href=\"http://www.miitbeian.gov.cn\" target=\"_blank\"><span style=\"color:#337FE5;\">http://www.miitbeian.gov.cn</span></a></span><img src=\"/Upload/article/583a73b4cfdae.png\" alt=\"\" /> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style=\"font-size:18px;color:#4C33E5;\"><a href=\"http://icp.chinaz.com/info?q=thbtc.com\" target=\"_blank\">http://icp.chinaz.com/info?q=thbtc.com</a></span>\r\n</p>\r\n<p>\r\n	<img src=\"/Upload/article/583b07fec7588.png\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '1', 'aaa', '0', '1', '1', '0', '1480225733', '1480225734', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('7', '币创币众筹', '<p class=\"MsoNormal\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	币创币众筹时间：12月6日10:00至12月09日22:00共四天\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	币创币众筹机制：核心理论上促进机会均等，扩展性强的二代加密货币平台\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	认购数量：每天认购200万、四天共800万，每人每天限购100—3<a name=\"_GoBack\"></a>000元，剩余200万，平台会根据市场流通量，分期发放，当THC涨至1元停盘下调百分之10认购第二期。\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	还有剩余的200W币创团队用作以后的应用开发推广。最终解释权归币创网官方所有。\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	认购价格：0.1元\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	认购条件：邀请3位用户实名注册币创网并充值（至少一人充值）（从12月1号新邀请的用户开始计算）\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	支付方式：支持人民币\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	开盘时间：认筹结束后第二天开盘\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	交易时间：9点-22点\r\n</p>\r\n<p class=\"MsoNormal\" align=\"left\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;font-size:14px;background-color:#FFFFFF;\">\r\n	4、币创币官方团队承诺：自开盘0.1永久性护盘，THC如破发，官方将回收全部\r\n</p>', '1', 'aaa', '0', '1', '1', '0', '1480333865', '1480333868', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('12', '精简教程：一张图读懂比特币', '<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:26px;background-color:#F9F9F9;\">\r\n	精简教程：一张图读懂比特币\r\n</div>\r\n<div style=\"margin:5px 0px 0px;padding:0px;border:0px;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;color:#999999;background-color:#F9F9F9;\">\r\n	<br />\r\n</div>\r\n<div class=\"bk30 hr\" style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;background:url(http://rs.btc38.com/statics/images/uline.gif) 50% 50% repeat-x #F9F9F9;\">\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	该图由新浪科技制作，转载过来，希望对新人有所帮助，让大家更快了解比特币。<br />\r\n<span style=\"color:#FF0000;\">由于图片尺寸非常大，建议右击将图片保存到电脑本地进行阅读，或者点击图片获得更大的尺寸。</span><br />\r\n<a href=\"http://www.btc38.com/uploadfile/2013/0824/20130824093459273.jpg\" target=\"_blank\"><img alt=\"一张图快速入门了解比特币\" height=\"4140/\" src=\"http://www.btc38.com/uploadfile/2013/0824/20130824093459273.jpg\" width=\"440\" /></a><br />\r\n<br />\r\n	<div style=\"margin:0px;padding:0px;border:0px;color:#990000;font-size:13px;\">\r\n		声明：部分文章转自互联网，如该转载不符合您的意愿或侵犯您的版权，请您与我们联系，我们会尽快删除。\r\n	</div>\r\n</div>', '1', 'bbb', '0', '1', '1', '0', '1480225114', '1480225116', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('14', '有问题可联系客服', '有问题请联系客服QQ:56703338', '1', '币友说币', '0', '1', '1', '1', '1480224182', '1480224192', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('15', '央行：数字货币开发应用有利于精准扶贫', '<p style=\"color:#333333;font-family:微软雅黑;font-size:14px;background-color:#FFFFFF;\">\r\n	中国人民银行研究局局长徐忠日前表示，数字货币的开发和应用有利于更好地精准扶贫。他还表示，我国采用科技金融去扶贫的“硬件”条件已经具备，但是在“软件”方面，还需从有效的监管框架、保护好消费者权益和缩小农民和农村金融机构的数字鸿沟三方面进行完善。\r\n</p>\r\n<p style=\"color:#333333;font-family:微软雅黑;font-size:14px;background-color:#FFFFFF;\">\r\n	　　徐忠是26日在由浙江省农村信用社联合社、浙江省金融学会和浙江省金融业发展促进会主办的普惠金融创新发展（浙江）峰会上做出如上表述的。徐忠说，包括中国央行在内的不少国家都在研发数字货币。数字货币是基于密码学，采用集中分布相对均衡的系统，应用大数据分析。用户身份认证采用前台自愿、后台实名，本身设计密集高效。“由于它是基于密码的，所以有可追踪性。如果使用数字货币，将有助于解决贫困地区假币问题。”他说。徐忠还举例说，现在我国政府有大量财政补贴通过各种渠道发放，但按照现在的方式，核实这些资金流向的成本非常高，如果使用数字货币，就能够很容易地知道资金有没有真正发放到要补贴的农民手里。另外，通过数字货币发放扶贫贷款就能够跟踪到贷款是否真正发放到符合条件的农民手里，此外，还可以通过数字货币来跟踪农民是如何使用扶贫资金的，从而帮助监管部门更好地设计出扶贫政策。\r\n</p>\r\n<p style=\"color:#333333;font-family:微软雅黑;font-size:14px;background-color:#FFFFFF;\">\r\n	　　徐忠称，我国采用科技金融去扶贫的“硬件”条件已经具备，但是在“软件”方面，当前还需要进行完善。一是需要有效的监管框架，监管框架对推动科技金融发展，保护消费者利益至关重要；二是在推动科技金融发展过程中要保护好消费者权益。比如，监管者可以要求在进行数据收集的时候，要明确获得客户的授权，针对授权要明确规定搜集到的不准确数据要根据客户实际进行调整；三是要缩小农民和农村金融机构的数字鸿沟。\r\n</p>\r\n<p style=\"color:#333333;font-family:微软雅黑;font-size:14px;background-color:#FFFFFF;\">\r\n	转自：http://jjckb.xinhuanet.com/2016-11/27/c_135861993.htm\r\n</p>', '1', '币友说币', '0', '1', '1', '2', '1480326159', '1480326168', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('16', '中国版数字货币来袭 和纸币说再见？', '<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	数字货币要来了。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	近日有媒体报道称，央行数字货币研究所有望于今年年底挂牌成立。据悉，该研究所将在央行印制科学技术研究所的基础上成立。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	记者梳理了央行官网上公布的其直属单位2017年度工作人员招聘公告，并从中发现，从事数字货币研究与开发工作的招聘人员信息赫然在列，“计划招聘6名具有硕士或博士学历的专业人士进行数字货币研发工作”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	显然，国家正在加紧对于数字货币的研发。而据记者了解，目前世界多地都在不约而同地进行数字货币方面的部署。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	数字货币为何会成为一块“香饽饽”？未来随着数字货币的面世和普及，人们会和纸币说再见吗？\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:700;\">央行数字货币 中心化为最大特点</span>\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	数字货币，是以算法保证其币值，以去中心分布式区块链算法形成的电子货币。比如：比特币、莱特币。目前全世界发行的数字货币达到有数千种。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	独立投资人王昌盛认为，自布雷顿森林体系之后，货币从锚定货币更多的转向信用货币，即央行与国家信用发行货币，而数字货币也是信用货币的一种。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	但据央行数字货币研究所筹备组组长姚前表示，央行要发行的数字货币“主要是为了替代实物现金。降低传统纸币发行、流通的成本，提升经济交易活动的便利性和透明度”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	当然一提到数字货币，很多人都会想到其典型比特币。诚然，数字货币的底层技术均为区块链技术。但值得关注的是，不少受访的业内人士表示，央行意欲发行的数字货币和比特币其实有着很多区别和特点。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	在sosobtc联合创始人李雄看来，“央行数字货币底层技术是区块链，但是它的‘链’跟比特币的‘链’是不一样的”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	从服务对象上看，央行数字货币是为国家服务的，是法币的数字化；而比特币是服务于市场的，将货币本质还给了市场。从核心特征上看，央行数字货币绝对是中心化的，“结果可能是四大行联合起来，利用区块链的记账结算功能搞一条联盟链。”李雄对《中国产经新闻》记者称，反观比特币则是去中心化的，不可篡改的。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	巴比特网站数字货币专栏作家李健也表示认同。李健对《中国产经新闻》记者表示，央行发行的数字货币必然是在央行的控制下，从代码到发行形式，绝对是中心化的数字货币。“比特币是去中心化的，谁都可以挖矿，买卖”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	另外，从政治上看，央行数字货币是绝对权威，不允许包括比特币在内的其他货币挑战。“但比特币是通过达成共识来运作的，完全的市场行为，比特币面前任何人都是平等的”。李雄对记者补充说道。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:700;\">全球“跟风” 抢占先机</span>\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	早在今年年初，中国人民银行行长周小川曾公开宣称，央行正在研究发行“数字货币”。而近一年来，各地召开的关于区块链的会议接连不断。每次都有政府相关人员出席，民间的探讨一直没脱离国家层面的参与，前些天央行招聘数字货币研究员的信息，更能证明国家对区块链和数字货币的重视。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	因此，在李雄看来，“央行要成立数字货币研究所，这是必然”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	与此同时，值得注意的是，不仅仅是我国央行正在紧锣密鼓地筹备数字货币的事宜。记者发现，实际上世界各国都在对数字货币进行不同程度的部署。数字货币为何会如此重要？\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	据李雄介绍，国内方面，银行、券商等金融机构正在组织数字货币的技术攻关。而国外荷兰、法国、英国等国也都在研发数字货币。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	“金融的基础是货币，国家控制货币就等于控制金融。”李雄对记者强调道，对于以比特币为首的数字货币来说，其天生就具有金融属性。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	同时，王昌盛还向《中国产经新闻》记者介绍，数字货币的出现，使支付在线上变得可以追述。“而支付的大数据一旦可以记录整理，将会是一笔巨大的数据金矿。”\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	一个在反恐领域颇为著名的故事是，英美曾雇佣银行一线数据人员帮助制定大数据规则来筛选出恐怖分子。即，追踪英国青年是否购买保险来筛查是否为恐怖分子。一般西方国家福利水平很高，年轻人很少不买保险，但恐怖分子怎么会浪费钱给自己购买享受不到的保险呢？\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	由此，王昌盛认为，如果人们大量使用数字货币，那么消费习惯将更多地泄露更多的信息。“数据不会说谎，未来这些数据可以在反恐、反腐领域展开应用。而数据追述功能也能极大地杜绝洗钱。”\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	“至于未来数字货币会不会颠覆现有的金融体系，在全球货币（数字货币）面前，谁也说不准。都需要提前布局，避免在货币战争中失去主动权。”李雄对记者补充道。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:700;\">纸币消亡 言之尚早</span>\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	显然在业内人士看来，数字货币和区块链是一块“兵家必争之地”，甚至已经成为了一种金融趋势。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	比如，2015年5月丹麦政府就公布了一系列方案，其中就包括废除法律要求商店接受物理现金的一项计划。2016年1月起，服装零售店、餐馆以及加油站都将进入无现金时代。随着西方丹麦、瑞典、以色列以及美国都在推行无现金社会，“这使得全球线上支付与数字货币的趋势越发强烈”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	同时，王昌盛表示，2015年末人民币广义货币M2的余额为139.23万亿元，而流通中的现金仅为6.32万亿。“需要由央行印制发行的现金数量已经降到货币总量的不到5%”。由此，现金比重的下降和记账式货币的上升也是全世界的共同潮流和大势。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	那么在此趋势之下，如果每个国家都潜心研制和发展自己国家版本的数字货币，未来如比特币、莱特币等的数字货币会不会成为类似当今美元一样的存在呢？\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	对此，有业内人士预测，数字货币将会对纸币带来较大冲击。李健就对记者表示，央行发行的数字货币最后会加速纸币的消亡，促进比特币的普及。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	中央财经大学金融法研究所所长黄震则表示，人们在实践中已越发倾向使用电子银行和电子支付，而不愿携带纸币，因此以后市面上流通的纸币可能会因此趋势而越来越少。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	不过，李雄却持保守观点。他对记者说：“最近我跟货币专家刘昌用曾谈到数字货币，如比特币对法币冲击的事。比特币的流通对M0（流通中现金）的基础货币发行上会有影响，比如在交易所卖币提现，这个过程可以理解成‘货币发行’，增加货币的流通量。”\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	但李雄强调，目前来看其实影响不大。因为比特币目前还处于被管制的状态，比如央行曾联合五部委发布的《关于防范比特币风险的通知》。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:700;\">何时推出 暂无时间表</span>\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	除了管制问题，数字货币在世界当前的发展其实也还不尽成熟。要完全面世和流通其实还需要一定的时间。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	在王昌盛看来，“数字货币有利也有弊。数字货币遵循的是算法规则，想把它流通领域限定在特定的某一国范围的技术难度很大，数字货币可能在资本管制方面给央行带来麻烦。“但既然是趋势总要有吃螃蟹的勇气”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	李雄也对记者坦言，目前数字货币还处于萌芽阶段，以比特币为例，比特币的总量为2100万，到2140年才能全部挖完。从时间维度来看，我们目前在数字货币的发展还很稚嫩，“冰冻三尺非一日之寒”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	同时，据央行内部人士透露，央行在设计数字货币时会充分考虑，现有的货币政策调控、货币的供给与创造机制、货币政策的传导渠道等。但目前央行对数字货币的研究更多是在理论研究和实践探索阶段。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	姚前此前在接受《金融时报》采访时就回应：“目前关于法定数字货币的原型系统，正在研发过程中。至于何时能推出中国央行的法定数字货币暂无时间表”。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	不过值得一提的是，他也表示，法定数字货币的推出会遵照循序渐进的原则一步步推进。可以选择少数的封闭的应用场景，比如票据市场，先开展实验并观察其使用效果。逐步积累经验之后，再进行改进和完善，发展成熟后再大范围地推广。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:\'Microsoft YaHei\';background-color:#FFFFFF;\">\r\n	因此，在未来在较长时期内，数字货币和纸币可能会并存流通。数字货币对于纸币的冲击，也不必过早担心。“对于普通百姓来说，未来到银行取钱时，既可以选择兑换实物现金，也可以选择兑换数字货币”。姚前补充道。\r\n</p>', '1', 'bbb', '0', '1', '1', '1', '1480326934', '1480326941', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('17', '领导人推广佣金说明', '<span style=\"color:#FF9900;font-size:24px;\">为了表示对领导人的辛苦付出网站特设置推广佣金：</span><span style=\"font-size:24px;\">一次推广，终身拿佣金</span><span style=\"font-size:24px;\">&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=\"font-size:24px;\">奖励下线充值金额的</span><span style=\"font-size:24px;\">0.6%（</span><span style=\"font-size:24px;\">三级分红）</span><span style=\"font-size:24px;\">&nbsp; &nbsp;&nbsp;</span><span style=\"font-size:24px;\">一代</span><span style=\"font-size:24px;\">0.3%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=\"font-size:24px;\">二代</span><span style=\"font-size:24px;\">0.2%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=\"font-size:24px;\">三代</span><span><span style=\"font-size:24px;\">0.1%</span><br />\r\n<!--[if !supportLineBreakNewLine]--><br />\r\n<!--[endif]--></span>', '1', 'aaa', '0', '1', '1', '0', '1480395191', '1480395023', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('18', '11月30日正式上线', '新平台。新机遇！！！币创币官方团队承诺：自开盘永久性护盘，THC如破发，官方将回收全部https://www.thbtc.com奖励下线金额三级分红:一代0.3% 二代0.2% 三代0.1。12月6号开始认购。12月5号开放充值。11月30日晚19点开始推广，每天拿出（币创币）交易金额收益的百分之50每天分红。注册帮助说明https://www.thbtc.com/Article/type/id/10.html', '1', 'aaa', '0', '1', '1', '0', '1480502670', '1480502681', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('19', 'THC认购推迟至12月12日', '<div>\r\n	&nbsp;币创币认购在即，出于对广大会员的安全利益考虑，我们将对充值系统进行为期8天的加固和完善，原定12月5日开放充值，现推迟至12月10日；币创币认购时间由原定12月6日，推迟至12月12日20：00开放认购，尽请期待！&nbsp;\r\n</div>', '1', 'aaa', '0', '1', '1', '0', '1480675595', '1480675608', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('20', 'OKCoin币行网比特币迎来强势突破 上涨底气在哪', '<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">11月的最后一天，横盘4天的比特币迎来一波强势突破。据OKCoin币行数据显示，今日开盘价5169.38元，下午15时41分，币价强势摸高5259.1元，涨幅89.72元，占比1.7%。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　</span><a href=\"http://c.cnfolimg.com/20161201/70/9563784466935766598.jpg\" target=\"_blank\"><img src=\"http://c.cnfolimg.com/20161201/70/9563784466935766598.jpg\" border=\"0\" align=\"center\" alt=\"0.jpg\" /></a><br />\r\n<br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　来源：比特币交易平台OKCoin币行</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　明天就要进入2016年的最后一个月，我们一边理性回顾，一边展望未来。同时作为比特币玩家，更要关注比特币的涨跌。是放手一搏，还是捂紧钱包？OKCoin币行分析师整理了以下几个消息面分析值得你看完。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　炒房资金大搬家，热钱流入比特币</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　国庆期间的楼市密集调控政策，引发了多地房地产市场的政策变动。不过，在密集调控影响之下，结合随后的系列配套措施的出炉，也加大了此次房地产调控的压力，对前期高杠杆投机的炒房客而言，也是一次致命性的打击。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　不可否认，在过去十余年内，房地产，尤其是一线房地产的保值增值效果是相当显著的，并由此引发了一线房地产市场“只涨不跌”的论调。但在这个世界上，却很难长期存在“只涨不跌”的产物，而当价格远远超过其价值的本身，终究还是离不开价格回归的过程。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　房地产市场乌云密布，或急剧降温</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　时下，房地产市场稍显降温，但仍不足以确立为真正的拐点，而在具有杀伤性的重磅政策还没有正式落地之际，房地产市场的保值增值预期还是受到了不少投资者的青睐。但，对于近期房地产市场的降温表现，也或多或少引导部分流动性移师至其余的投资渠道，而作为最佳避险资产的比特币，也无疑成为这笔热钱关注的对象。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　从本质上来看，资金是逐利的，即哪里具有持续性的赚钱效应，资金就会往哪里去跑。由此可见，一旦沉寂多时的比特币逐渐活跃起来，并形成了持续性的赚钱效应，则各路资金也有望加速跑步进场，进入比特币寻求更好的增值效果。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　还记得今年6月份英国脱欧公投吗？这次事件给国际金融史带来近年来最大的一次黑天鹅事件：国际油价暴跌6％，全球股价跌幅不一，英镑当天跌幅达10.47％，美国10年期国债收益率暴跌12.5%，几乎全部暴跌无一辛免，唯独比特币暴涨50%。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　而英国脱欧的影响尚未褪去，本周日意大利将举行修宪公投，结果将左右意大利脱欧公投与否。本次意大利修宪公投，被视为下半年欧洲政治版图最大的单一风险，因为意大利中间派总理伦齐的政治命运可能系于公投的结果。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　意大利总理马泰奥伦齐</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　如果本次公投五星运动党取胜，我们将目睹历史上最大规模的金融危机，意大利公投脱欧或将成为今年欧洲政坛的最大风险点，在蝴蝶作用的影响下其杀伤力将远超英国公投。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　但此次金融动荡，必将使更多人进入比特币市场以寻求资产避难，因此随着消息逐渐放出和公投的临近，再对比英国脱欧导致的比特币大涨，相信伴随意大利脱欧事态的发展，比特币的行情初步估计比较乐观。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　目前，市场普遍预计美联储将于12月再次加息。市场猜测特朗普的通货再膨胀政策将意味着加快货币紧缩速度。彭博依据联邦基金期货合约的计算显示，市场暗示美联储在12月13-14日的会议上升息几率首度达到100%。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　当然，正如此前所说，12月份加息还取决于另外两个因素：一是美国经济各项指标强劲，支撑美联储加息政策，二是美联储货币政策必须预留空间与余地。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　美联储主席珍妮特 耶伦</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　近期，美元持续走高，进入强势区间。这必将导致其它国家货币贬值加剧，特别是SDR里的欧元、英镑、日元、人民币。一旦美联储12月份加息的话，那么从现在开始到12月12日的美联储议息会议期间，美元继续走强，其他国家法币汇率将持续走低。比特币价格或将被动上涨。</span><br />\r\n<br />\r\n<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　去年12月17日美联储加息，将联邦基金利率提高0.25个百分点，这是自2006年6月以来美联储的第一次加息。受其影响，比特币价格两个月内从1500水平涨至2800元，几乎翻倍。</span><br />\r\n<br />\r\n<p>\r\n	<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">　　总的来说，随着楼市降温、意大利公投、美联储加息，比特币或在年底前再迎一波高潮。</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#333333;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:14px;line-height:22px;background-color:#FFFFFF;\">转自：http://news.cnfol.com/it/20161201/23912787.shtml</span>\r\n</p>', '1', 'bbb', '0', '1', '1', '0', '1480676578', '1480676592', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('21', '德勤秦谊：区块链将呈非线性的爆发式发展', '<p>\r\n	<span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:32px;background-color:#F9F9F9;\">德勤秦谊：区块链将呈非线性的爆发式发展</span> \r\n</p>\r\n<p>\r\n	<span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:32px;background-color:#F9F9F9;\"><br />\r\n</span> \r\n</p>\r\n<p>\r\n	<span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:26px;line-height:32px;background-color:#F9F9F9;\"><span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:30px;background-color:#F9F9F9;\">“区块链可能不是呈线性发展，而是爆发式的发展。但它的历程应该是这样的，通过发现一个有效的商业运行场景进行尝试，再进行大规模的开发，进入下一个领域。”</span> </span>\r\n</p>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	12月4日，德勤亚太区投资管理行业领导合伙人秦谊在第七届财新峰会“财新-云峰海外投资论坛”作出以上表述。她分享了全球区块链的发展情况，同时介绍了德勤在区块链领域的尝试，包括在商业中的运用。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	“比特币绝对是区块链在当今世界上最成功的商业运用案例。”秦谊从比特币出发介绍了区块链的意义。她认为，区块链是一种开放架构下的强安全技术机制，通过特定的数据架构和共识算法，设计实现了多方参与的自治系统。因此，区块链可以实现点对点的实时交易，会令交易流程减少信用风险和中间环节。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	与以往的新技术不同的是，面对区块链技术，很多传统金融机构非常积极地介入研究、探索应用。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	据秦谊介绍，全世界有超过90家央行参与区块链研究。过去的三年中，区块链领域获得了超过14亿美元的投资，这个数字的关键在于，14亿美元有一半来自风险投资资本，另一半则来自传统的金融机构。另外，过去三年中有超过2500项有关区块链技术的专利申请，这些申请的主流不是大专院校或者创业机构，而是传统金融机构。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	秦谊表示，区块链作为金融科技的底层架构，具备以下特征：非中介化、高效率、跟踪审计。她解释道，公司基于区块链技术可以做成财务软件，该软件会真实地记录每一笔数据且数据不可被篡改，这将去中介化；同时，去中介化能够提高效率；当区块链技术产生时，每一个改变都会留下痕迹，这也是众多监管机构从早期非常关注区块链技术的原因之一。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	那么在未来的路程里，区块链技术会呈现怎样的发展趋势呢？秦谊表示，现在仍处于探索数字货币到数字公证的阶段，未来还有数字资产、去中心化交易和数字身份等多个领域尚待开发。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	但她承认，区块链技术不是呈线性发展，可能是爆发式的发展。但它的历程应该是这样的：通过发现一个有效的商业运行场景进行尝试，然后再进行大规模的开发，进入下一个领域。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	现在也已经有很多的成功应用案例，跨境支付则是其中较为广泛的应用领域。秦谊表示，跨境支付其实面临着很大的问题，包括比特币面临的合规问题，以及如何知晓客户、达到反洗钱的效果，这些都很敏感。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	传统的支付架构都要通过一个中央节点，这不仅增加了交易时间，也增加收费，也为交易加大风险。秦谊介绍了德勤设计研制的基于区块链的手机跨境支付运用，这个运用能够减少45%的交易费用，并保证交易在5秒钟内完成。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	此外，秦谊还介绍了数字身份在金融服务中的巨大影响。她表示，区块链能够把一个用户所有的行为和他的身份作为一长串数字，在区块链中保存下来，使得用户接受实体服务的时候，其身份得到实时有效的验证。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	【来源】http://topics.caixin.com/2016-12-04/101023064.html\r\n</div>\r\n<br />\r\n<p>\r\n	<br />\r\n</p>', '1', 'bbb', '0', '1', '1', '0', '1481024825', '1481024841', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('22', '特别通知', '<p>\r\n	<span><span style=\"color:#CC33E5;\">1：</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">币创币众筹时间：</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">12</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">月</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">12</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">日</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">20:00</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">至</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">12</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">月</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">15</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">日</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">22:00</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\"><span style=\"color:#CC33E5;\">共四天，</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">认购价格：</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">0.1</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;color:#CC33E5;background-color:#FFFFFF;\">元</span><span style=\"color:#CC33E5;\"></span></span><span style=\"color:#CC33E5;\"></span></span> \r\n</p>\r\n<p>\r\n	<span style=\"color:#CC33E5;\">2：开盘时间：认筹结束后第二天开盘,为了后期对接商城</span><span style=\"font-family:Arial, 微软雅黑;line-height:24px;color:#CC33E5;background-color:#FAF9F8;\">实行每日</span><span style=\"font-family:Arial, 微软雅黑;line-height:24px;color:#CC33E5;background-color:#FAF9F8;\">涨跌幅10%自由交易</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:Arial, 微软雅黑;line-height:24px;color:#CC33E5;background-color:#FAF9F8;\">3:交易时间：每天09:00--22:00节假日另行通知</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:Arial, 微软雅黑;line-height:24px;background-color:#FAF9F8;\"><span style=\"color:#CC33E5;\">4：</span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">豪币官方团队承诺：自开盘0.1元永久性护盘，</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#CC33E5;line-height:30px;background-color:#FFFFFF;\">THC</span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">如破发，官方将回收全部</span></span> \r\n</p>', '1', 'aaa', '0', '1', '1', '0', '1481254148', '1481254160', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('23', '基于区块链的全球支付系统Stellar让支付变得更容易', '<h2 class=\"align-center\" style=\"font-family:\'Microsoft YaHei\', Arial, sans-serif;font-weight:normal;color:#333333;font-size:30px;text-align:center;\">\r\n	<span style=\"font-size:14px;\">基于区块链的全球支付系统Stellar让支付变得更容易</span> \r\n</h2>\r\n<p style=\"text-align:center;\">\r\n	<span style=\"font-family:\'Microsoft YaHei\';\"><img src=\"https://img1.chbtc.com/up/23/313A313A3233_83835.png\" width=\"720\" height=\"514\" alt=\"\" style=\"height:auto;\" /><br />\r\n</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:\'Microsoft YaHei\';\"><span style=\"font-size:14px;\">&nbsp; &nbsp; &nbsp; 基于</span><a target=\"_blank\" href=\"https://www.chbtc.com/\"><span style=\"font-size:14px;\">区块链</span></a><span style=\"font-size:14px;\">的全球支付系统Stellar将与四家行业领先的金融机构Coins.ph, Flutterwave, ICICI Bank和Tempo Money Transfer展开合作，致力于为印度、菲律宾、欧洲创建全球支付网络，同时实现在非洲用M-PESA进行跨境付款。</span></span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:\'Microsoft YaHei\';font-size:14px;\">&nbsp; &nbsp; &nbsp; 此次合作可以把低成本全球资金转账服务以及来自肯尼亚、加纳和尼日利亚的跨境M-PESA支付服务带到印度、菲律宾和欧洲。通过这一次技术集成，这些公司可以为他们的客户扩展访问通道，并大幅度降低成本。</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:\'Microsoft YaHei\';font-size:14px;\">&nbsp; &nbsp; &nbsp; 很快这些金融机构可以在3-5秒内相互进行交易，并且不会遇到导致更高费用的摩擦和障碍。Stellar的一个主要优势是，通过单一集成，金融机构可立即访问Stellar上的所有其他机构。例如，Stellar上的所有金融机构都能够通过Coins.ph无缝地向菲律宾汇款，通过ICICI向印度汇款，通过Tempo从欧洲汇款。</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:\'Microsoft YaHei\';font-size:14px;\">&nbsp; &nbsp; &nbsp; 尤其值得注意的是和Coins.ph的集成，在海外的菲律宾工人在2015年向菲律宾发送了269.2亿美元，这让菲律宾成为世界第三大汇款市场。在发展中国家中，大多数人口是未享受银行服务，或没有银行账户的。到目前为止，向这些国家汇款的服务只限于传统的汇款服务，例如西联汇款或MoneyGram，这些汇款服务会收取高昂的费用。</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:\'Microsoft YaHei\';font-size:14px;\">&nbsp; &nbsp; &nbsp; 但从现在开始，任何人都可以通过Stellar汇款到菲律宾。货币可以通过两种方式转移：访问和Stellar连接的本地汇款服务，或通过Stellar钱包用数字化的方式汇款。如果推出了这项服务，汇款到菲律宾的Coins.ph钱包中的服务将是免费的。</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:\'Microsoft YaHei\';font-size:14px;\">&nbsp; &nbsp; &nbsp; 在欧洲，人们可以去Tempo的网站（www.tempo.eu.com），或通过线下的方式，去欧洲数百个授权Tempo代理商中，通过使用收件人的姓名和手机，可以向菲律宾的任何人汇款。</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:\'Microsoft YaHei\';\"><span style=\"font-size:14px;\">&nbsp; &nbsp; &nbsp; 北京时间12月8日15:00，</span></span><a href=\"https://www.thbtc.com/\" target=\"_blank\">比特币/</a><span style=\"font-family:\'Microsoft YaHei\';\"><span style=\"font-size:14px;\">人民币报5323.39，莱特币/人民币报25.81，</span></span><span id=\"__kindeditor_bookmark_end_31__\"></span><a href=\"https://www.thbtc.com/\" target=\"_blank\">ETH/</a><span style=\"font-family:\'Microsoft YaHei\';\"><span style=\"font-size:14px;\">CNY报59.5，</span></span><span id=\"__kindeditor_bookmark_end_17__\"></span><a href=\"https://www.thbtc.com/\">ETC/</a><span style=\"font-family:\'Microsoft YaHei\';\"><span style=\"font-size:14px;\">CNY报5.68。</span></span> <span id=\"__kindeditor_bookmark_end_3__\"></span>\r\n</p>', '1', 'bbb', '0', '1', '1', '0', '1481255112', '1481255131', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('24', '区块链里程碑事件', '<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://www.jubi.com/images/jubi/upload/news/2016-12-06/2261481005733.jpg\" title=\"20161206101102259.jpg\" />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\"></span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    R3的Corda分布式账本代码发布之后就掀起了一阵热潮，因此另一个里程碑式的事件就几乎没有被人注意到，参与超级账本Hyperledger项目的成员已经超过了100位！</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    当然，就其事件本身而言，这个消息并没有那么重要，毕竟100只是一个数字。但是，结合两个报告，你会发现这一发展几乎可以定义区块链的未来。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    超级账本项目创建于一年之前，参与其中的包括了区块链公司（包括R3区块链联盟）、金融机构和技术巨头。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    到目前为止，在经历了数次的融合与分裂后，区块链结构（TheblockchainFabric）由创始成员IBM和数字资产公司所提交的方案混合而成，创建了一套灵活的企业解决方案。超级账本的探索者工具（explorertool）结合了DTCC（美国证券托管结算公司）、IBM和英特尔的项目代码。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    在Corda开放资源的同时，它被提交给了超级账本，并加入了Fabric和英特尔的Sawtooth项目，以及其他的协议。虽然，每家公司的运行方式不同，但是所有的设计都是为了协助金融交易，所以每家公司的创建标准也大不相同。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    因此，有理由怀疑超级账本项目是否会将统一或着分段的方法应用其中。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    Corda会被并入Fabric或者Sawtooth吗？又或者将其“组件”剥离与其他的解决方案交互？</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    R3是一个以盈利为目的的联盟（目前正在进行新一轮融资），但是却开放了一项其主要技术资产的资源。为什么呢？这是为了扩展其生态系统，并鼓励开发人员改进其功能。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    R3无疑会对相关服务收费，比如安全防护和咨询，而且可能还会开发能够向客户出售的专有应用程序。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    因此，它需要非常熟悉底层协议，以便在其上构建并将结果商业化。R3不太可能会同意为了更广泛的应用将Corda分段或者并入另一个技术的协议。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    而超级账本项目则是一个非营利的组织，由Linux基金会设立和运行。他们的作用是类似的：促进其社区的发展，鼓励标准化，并且增加一层组织管理。Linux基金会拥有超过200个成员，大家不仅一起管理Linux，还确定了一个很长的“协作项目”列表。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    超级账本项目已经走上了这条路。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    没有什么能比得上区块链</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    但是随着参与超级账本项目的成员继续增长，其成员的利益可能会出现分散和变化。对于这些公司集体而言区块链的想法变得不太可行，必要的投资变得不太实用。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    与互联网不同，我们最终可能不会在区块链空间中使用同一种技术标准，而是模块化。但是，这也不是一件坏事。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    最初的混乱可能会更有利于鼓励创新，并开辟几乎无限的灵活性，而不是为了竞争人才和用户创造一个蜂巢生态系统。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    我们已经开始看到一个新部门的崛起，不同的解决方案开始考虑如何相互交流。</span>\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:微软雅黑, \'Microsoft YaHei\';color:#595959;font-size:14px;\">    我们将看到区块链未来的样子。</span>\r\n</p>\r\n<br />', '1', '币友说币', '0', '1', '1', '0', '1481260781', '1481260801', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('25', '币创币(THC)白皮书传媒中国报道', '<span style=\"color:#333333;font-family:微软雅黑, 宋体, 宋体, sans-serif;font-size:14px;line-height:26px;background-color:#FFFFFF;\"><span style=\"color:#333333;font-family:微软雅黑, 宋体, 宋体, sans-serif;font-size:14px;line-height:26px;background-color:#FFFFFF;\">币创币简介：是一种先进的开源应用平台基础上，提高创业加密货币的第一次浪潮的基本功能,近乎零成本的支付，以世界上任何人,是一个开源的，全球支付网络，这是没有任何中央机关充分分散。DC的平台包括许多先进的功能，包括数字THC货币。THC给它的用户完全的自由在很多方面：比如使用TH货币作为支付系统，或创建使用DC API和工具先进blockchain应用。THC是一个强大的，开放的，完全分散的应用平台，领先的加密货币演变为blockchain技术。TH拥有更快的交易确认时间，比领先的基于数学的货币提高存储效率。随着大量的产业支撑，交易量和流动性，THC币是比特币互补商业的成熟的虚拟货币。</span></span><a href=\"http://s.cm86.cn/sy/1612/17207.html\" target=\"_blank\"><span style=\"color:#FF9900;font-size:16px;\">http://s.cm86.cn/sy/1612/17207.html</span></a>', '1', '币友说币', '0', '1', '1', '0', '1481361856', '1481361876', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('26', '南非银行报告称：区块链能够创造货币政策的新纪元', '<span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:30px;background-color:#F9F9F9;\">南非FirstRand Bank就世界上各大央行及其区块链研究进程发布了一篇报告（</span><a href=\"http://8btc.com/doc-view-1067.html\" target=\"_blank\">币文库全文下载</a><span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:30px;background-color:#F9F9F9;\">）。报告显示，区块链技术能够创造货币政策的“新纪元”。</span>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	<img alt=\"\" src=\"http://www.btc38.com/uploadfile/2016/1211/20161211102151226.jpg\" style=\"width:500px;height:300px;\" />\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	该篇报告名为《密码学银行的到来》（The Advent of Crypto Banking），详细研究了央行发行的数字货币。本周，欧洲央行宣布与日本央行合作研究数字货币的概念，并有望在明年发表相关的研究报告。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	目前，英国央行在这方面的进展比较突出。英国央行正在积极探索一种基于区块链技术的新型数字货币。另外，今年6月，加拿大央行公布了其数字货币原型“CAD-Coin”。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	FirstRand Bank的研究报告深入分析了央行的数字货币结构，并赋予这种系统一个全新的名字——“主权区块链”（sovereign blockchain）。因为这种系统一旦生效就能成为官方认可的管理模式。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	报告中写道：\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	一旦主权区块链系统创造出了央行加密货币，那么其他金融机构的证券、股票、衍生品，甚至是房产和车辆登记信息都会转移到这个主权区块链系统中。这样央行就能对商业银行创造的资产进行实时监管。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	报告表示，这种主权区块链的另一个优势就是利用系统的透明性推动税务合规。也就是说，智能合约可以用来实时征收税款。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	智能合约在区块链中的应用可以彻底改革征税模式。这种系统可以在交易发生的同时进行征税，从传统的‘交易后征税’切换到‘实时征税’。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	虽然本篇报告仍停留在概念阶段，但报告指出，如果区块链技术的部署方式能够完全与央行的功能吻合，那么这种系统绝对会产生更加深远的影响。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	（有了区块链系统之后）各类服务模式的改革是毫无疑问的。我们正处于金融服务改革的新纪元。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	原文：http://www.coindesk.com/sovereign-blockchains-will-change-monetary-policy-bank-paper-argues/\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	作者：Stan Higgins\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	编译：Wendy\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	文章：http://www.8btc.com/blockchains-monetary-policy\r\n</div>\r\n<h3 style=\"font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;color:red;background-color:#F9F9F9;\">\r\n	免责声明：本文为转载，仅为传播消息之用，不代表币创网建议，炒币有风险，投资需谨慎！\r\n</h3>', '1', 'bbb', '0', '1', '1', '0', '1481460660', '1481460678', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('27', '丹麦印钞工作将外包，央行转而研究数字货币E-Krone', '<p>\r\n	<span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:30px;background-color:#F9F9F9;\">丹麦印钞工作将外包，央行转而研究数字货币E-Krone</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:30px;background-color:#F9F9F9;\"><br />\r\n</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:30px;background-color:#F9F9F9;\">越来越多的央行开始质疑印刷纸钞的意义。</span>\r\n</p>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	<img alt=\"\" src=\"http://www.btc38.com/uploadfile/2016/1212/20161212041116368.jpg\" style=\"width:500px;height:300px;\" />\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	在丹麦，货币管理者（丹麦央行）正在研究虚拟货币的发行问题，他们认为虚拟货币能够降低犯罪率，给监管部门提供更高的透明度。在数字货币的发行计划中，丹麦并不是孤军奋战。英国和瑞典成为了欧洲数字货币的领军人物；而新加坡和加拿大已经完成区块链货币系统的网络支付试验。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	丹麦央行行长拉尔斯？罗德（Lars Rohde）2017年的工作重点不再是监管纸钞印刷，而是数字货币。他期望央行发行的数字货币能够降低交易成本。但其中存在的风险相当大。因为对于央行来说，这是一个未知的领域，任何意外都足以颠覆一国经济。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	2017年，丹麦央行的货币印制工作将实现外包。芬兰负责其硬币铸造，至于纸币的印刷工作尚未确定合适的对象。虽然现金不会完全消失，但丹麦已经开始探索成本更低、效率更高的选择。据丹麦央行统计，纸币的使用成本超出信用卡和借记卡至少两倍。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	<strong>安全网</strong>\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	目前，研发电子货币的挑战并不在于技术的限制。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	Rohde在接受采访时表示：\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	我们的工作重心不再是纸钞的发行，因为我们深知其中存在的问题。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	目前，丹麦的现金交易仅仅占到国内交易的20%，甚至未达货币供应量的三分之一。因此，假设线上支付系统瘫痪，现金不可能是一个可供选择的安全网络。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	Rohde说：\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	很多年前我们就已经明白，现金和纸币不可能成为电子支付的替代品。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	<strong>区块链</strong>\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	丹麦央行认为，区块链等技术可能是虚拟货币的最佳运作模式。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	Rohde说，央行正在考虑是否匿名化其电子货币。他们计划给每个E-krone添加相应的编号，这样就能保证其可追踪性。而区块链这种能够记录所有电子货币交易的账簿则是实现这一功能的最佳选择。区块链的概念因比特币而兴起，这一技术存在的初始目的就是免除央行在其中扮演的角色。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	区块链初创公司Coinify的联合创始人拉塞？比尔克？奥勒森（Lasse Birk Olesen）认为，央行最终是否能采用区块链系统取决于该国民众和这一货币机构的信任程度。也就是说，这一系统必须适合透明的发达社会。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	在丹麦以及其它欧洲国家，民众对央行的信任程度较高。而在委内瑞拉则完全相反。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	他认为在区块链系统中，小额交易获益最大。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	小额交易和微交易占了极大的优势。届时，电子支付将变得更加便宜、快捷，并且方便。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	<strong>社会转型</strong>\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	Rohde说，对于区块链系统带来的社会影响，央行仍然留有很多疑问。比如说，央行是否有必要监控交易？\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	这种监控方式很容易给人造成不快，特别是在当今社会，消费者的各项记录通常都遭到大型企业的监视，他们通过这种方式进行广告宣传和产品兜售。对于这种行为，消费者的不满情绪几乎已经到达顶点。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	对于虚拟货币的发行，令央行犹豫不决的原因不止这一个。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	（央行数字货币发行之后）丹麦民众的所有资金都到了央行手中。然而，在如今经济危机的形势下，我们却无法进行紧急救助，因为到时候我们就成了所有银行的债权人。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	或许这个问题最终是可以解决的，但首先我们仍需面对大量的现实问题。\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	&nbsp;\r\n</div>\r\n<p style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	原文：https://www.bloomberg.com/news/articles/2016-12-11/blockchain-lures-central-banks-as-danes-consider-minting-e-krone\r\n</p>\r\n<p style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	<h3 style=\"font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;color:red;background-color:#F9F9F9;\">\r\n		免责声明：本文为转载，仅为传播消息之用，不代表币创网建议，炒币有风险，投资需谨慎！\r\n	</h3>\r\n</p>', '1', 'bbb', '0', '1', '1', '0', '1481549480', '1481549501', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('28', 'THC分红说明', '<span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#E55600;line-height:21.6px;\"><span style=\"font-size:14px;color:#9933E5;\"><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#E55600;line-height:21.6px;\"><span style=\"font-size:14px;color:#9933E5;\">持有</span><span style=\"color:#9933E5;font-size:14px;\">分红币</span><span style=\"font-size:14px;color:#9933E5;\">（</span><span style=\"font-size:14px;color:#9933E5;\">THC</span><span style=\"font-size:14px;color:#9933E5;\">）每周六分红为：平台交易</span><span style=\"font-size:14px;color:#9933E5;\">THC</span><span style=\"font-size:14px;color:#9933E5;\">币成交额收入的</span><span style=\"font-size:14px;color:#9933E5;\">0.5%.</span><span style=\"font-size:14px;color:#9933E5;\">每天分红时间10：00至14：00官方会发放到个人</span></span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#E55600;line-height:21.6px;\"><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;color:#9933E5;\">账户</span></span></span></span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#E55600;line-height:21.6px;\"><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;color:#9933E5;\">请在——认购中心——分红记录查看</span></span>', '1', '币友说币', '0', '1', '1', '0', '1481551491', '1481551512', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('29', 'THC众筹完成公告', '感谢大家一直以来对币创网网的支持，经过多天的THC众筹现已认购2388043枚THC，剩下的币全部销毁处理。2016-12-16日09：00开盘，请互相转告；祝大家玩的愉快。', '1', 'aaa', '0', '1', '1', '0', '1481817782', '1481817653', '1', '592d295a0cb20.png');
INSERT INTO `qq3479015851_article` VALUES ('30', '徐州市破获“虚拟货币”特大传销案 涉及50万人109亿', '<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:26px;background-color:#F9F9F9;\">\r\n	徐州市破获“虚拟货币”特大传销案 涉及50万人109亿ceshi\r\n</div>\r\n<div style=\"margin:5px 0px 0px;padding:0px;border:0px;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;color:#999999;background-color:#F9F9F9;\">\r\n	<br />\r\n</div>\r\n<div class=\"bk30 hr\" style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;background:url(http://www.btc38.com/statics/images/uline.gif) 50% 50% repeat-x #F9F9F9;\">\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	<img alt=\"\" src=\"http://www.btc38.com/uploadfile/2016/1218/20161218103854739.jpg\" style=\"width:500px;height:281px;\" /><br />\r\n“虚拟数字货币已挟雷霆之势来临！”“网络黄金积分（以下简称‘EGD’），它不会让你一夜暴富但会让你一生巨富！”短短两年时间，国内就有50余万人被类似宣传吸引。<br />\r\n如今，这些极具煽动性的语言仍在一些网站、公众号中以彩色大号字体显示，而很多投资者已深陷传销泥潭，难以维权。今年3月以来，江苏徐州市公安机关破获一起“网络黄金积分”特大网络传销案，抓获犯罪嫌疑人49人，经检察机关批准逮捕16人，冻结、暂扣涉案资金3.8亿元。\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		警方表示，利用虚拟货币进行传销已成为当前网络传销新特点，投资者应高度警惕。\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		<strong>虚拟货币+兑换物品，后续投资有去无回</strong> \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		今年3月，徐州市公安局鼓楼分局在工作中发现，市民魏某涉嫌参与传销活动，系王某花发展的下线会员。后者以购买“全球兑”购物券（以下简称“FV”）赠送“网络黄金超级积分”（以下简称“ES”）为幌子，在“全球共赢商业积分控股集团”会员发展平台上发展会员300余人，注册账号1659个。<br />\r\n \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		徐州市公安局鼓楼分局经过循线追踪，以“未来世界国际集团”有限公司负责人裴某、王某芳为首的特大网络传销犯罪团伙逐渐浮出水面。“他们在国内以广东无界等公司为掩护，通过组建12个会员发展平台、网络交易平台和全球兑网购平台，组织开展传销活动。王某花所处的会员平台就是这12个之一。”<br />\r\n \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		“EGD并不是实物黄金，而是一种加密数字资产， 全球流通 中的总量固定为4200万块。2015年11月，裴某宣布将每个EGD切分为1000份，网络小黄金由此诞生。”犯罪嫌疑人、裴某助理姚某博在接受讯问时供述，投资者以1万的倍数起投，最低1万元。每投资1万元，赠送价值1万元的兑换券，相当于2000元的购买力，可以在“全球兑”里购物。此外配送1万ES积分，前期ES积分是1元1个。\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		随着会员的增多，需求量增大，ES就会升值，投资人可以将手里的ES出售赚钱。裴某等人同时规定，只有上涨5%，才可以解冻相应上涨的部分并予以出售。“这样的结果是，前期1元等于1个ES，投入7000元可以买7000个ES，当ES升值成5元，后期的投资人再投资7000元，实际只买到了1400个ES，后期加入的投资人所投资金就被前期投资人赚走。”姚某博说。\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		<br />\r\n这样下去，ES价格越高，项目吸引力就会下降，交易流动性也会减弱，ES的涨幅就减缓。根据“上涨5%才可解冻提现”的规定，后期投的钱就被套死了。犯罪嫌疑人董某交代，“很少有人能够从中获利，基本都是钱一进来就出不去了”。\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		<strong>半年发展50万会员，大量资金转移海外</strong> \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		为了刺激投资者源源不断地投钱，涉案公司在ES平台上开辟了“动态返利”的另一种受益办法，即“有偿加入、组成层级，发展下线、按人提成”的传销经营模式。“根据会员发展的多少分为1至5星、1至5钻、1至5冠、1至5金的4阶20级。每个级别对应不同的奖金回报，发展了下线就能获得提成，并可层层提成。”姚某博说。\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		“由此，犯罪分子让你听到的是可望而不可即的永远升值的 网络黄金 ，因为该组织的高级领导层内部可以根据吸纳人头交纳的费用实时在后台控制每天涨幅，实现通过底层会员缴纳资金给高级会员和整个网站返款的传销实质。”徐州市公安局鼓楼分局网络安全保卫大队大队长吴强说。\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		同时，为尽快获取会员申购积分所缴纳的资金，该组织还建立了“当天交款，当天兑现返利提成”的“秒返”激励机制，吸引社会上更多的投资人加入，进而通过相关培训和宣传，用此传销手段引诱参加者继续发展下线。据统计，从2015年10月三大类平台上线至2016年4月7日案发，短短半年时间，共发展会员50余万人，涉及资金109亿元。\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		深谙ES只是一个泡沫、一个圈钱工具的裴某、王某芳等人为逃避打击，又利用在香港开设的公司以及将服务器架设在美国等手段在境外对12个会员发展平台、网络交易平台和“全球兑”网购平台进行操控管理，并通过虚构贸易等手段向海外转移违法所得约15亿元。\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		 \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		<strong>网络传销变种多，投资者应仔细甄别</strong><br />\r\n \r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;\">\r\n		徐州市公安局有关负责人表示，“网络黄金积分”反映了当前传销的新特点。一是假借虚拟货币这一新生事物进行传销，同时打着电子商务、个人理财、远程教育的旗号吸引人，一般群众不了解，容易上当受骗。二是发展会员都是在网络上进行，会员必须通过网站才能加入传销，并且使用的用户名都是假名或者代号，都有各自的登录密码，彼此之间主要通过微信等即时聊天。这改变了传统网络传销设工作室、报单中心进行传销组织活动的模式，增加了传销的隐蔽性。三是互联网使传销突破了地域和国界的限制，传销骨干人员经常把总部设在境外，躲在境外发号施令，资金转移境外，抓捕难，追赃难，除根难。<br />\r\n转自：http://news.cctv.com/2016/12/15/ARTIodRNWKwy7SKkrzTUmIqM161215.shtml\r\n	</div>\r\n	<h3 style=\"color:red;\">\r\n		免责声明：本文为转载，仅为传播消息之用，不代表币创网建议，炒币有风险，投资需谨慎！！！\r\n	</h3>\r\n<br />\r\n</div>', '1', 'bbb', '0', '1', '1', '1', '1482122370', '1482122396', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('31', '外媒：印度斥资5000万美元鼓励民众使用数字货币', '<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:26px;background-color:#F9F9F9;\">\r\n	<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:26px;background-color:#F9F9F9;\">\r\n		外媒：印度斥资5000万美元鼓励民众使用数字货币\r\n	</div>\r\n	<div style=\"margin:5px 0px 0px;padding:0px;border:0px;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;color:#999999;background-color:#F9F9F9;\">\r\n		<br />\r\n	</div>\r\n	<div class=\"bk30 hr\" style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;background:url(http://www.btc38.com/statics/images/uline.gif) 50% 50% repeat-x #F9F9F9;\">\r\n	</div>\r\n	<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n		<img alt=\"\" src=\"http://www.btc38.com/uploadfile/2016/1221/20161221110042997.png\" style=\"width:500px;height:246px;\" /><br />\r\n北京时间12月16日晚间消息，据CNNMoney网站报道，印度正陷入自己制造的现金危机。在此背景下印度政府计划拿出5000万美元鼓励人们使用数字货币的表态再次引发关注。\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			200万名印度人将从这一新的临时彩票活动中获益，而参与的条件是将自己的ID与政府的电子支付系统联接起来。\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			使用该系统的人将获得一个数字，而该数字将会被输入抽奖系统，每天会抽取1.5万名幸运者，他们每人将获得1000卢比（约合15美元）。每周还会抽取7000多名幸运者，他们将获得5000至10万卢比。\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			使用该电子支付系统的零售商也也有机会获得奖励，每周将抽取7000名零售商，他们将获得2500卢比到5万卢比的奖励。\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			该彩票活动是印度政府给予民众的一份圣诞节礼物，将于12月25日起开始举行，持续至2017年4月14日。 在活动的最后一天，印度政府还将抽取6份大奖，奖金从1.7万美元至头奖150万美元。\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			印度总理莫迪11月8日突然废除了印度当前面额最大的两种货币，设法解决腐败和逃税问题。\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			但废除现有500卢比和1000卢比，并将其替换为新的500卢比和2000卢比的举措，已经使印度86%的货币（按金额计）突然变得没有价值，并引发了经济混乱。\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			现金在印度的经济运行中发挥着重要作用，新纸币的分放工作并不顺利，印度百姓因此在日常采购中面临着诸多麻烦。汽车和钻石等使用大额纸币的交易规模大幅下降。\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			负责管理印度政府智库的Amitabh Kant表示：“目前在印度只有5%的个人消费支出使用数字货币。我们的目标是数字支付在印度得到迅速普及。”\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			&nbsp;\r\n		</div>\r\n		<div style=\"margin:0px;padding:0px;border:0px;\">\r\n			自从印度宣布废除大额货币以来，无现金支付公司和手机钱包获得了蓬勃发展，印度政府也正试图鼓励人们使用自己的电子支付系统。（翊海）<br />\r\n文章：http://finance.qq.com/a/20161220/023397.htm\r\n		</div>\r\n		<h3 style=\"color:red;\">\r\n			免责声明：本文为转载，仅为传播消息之用，不代表币创网建议，炒币有风险，投资需谨慎！！！\r\n		</h3>\r\n	</div>\r\n<br />\r\n</div>', '1', 'bbb', '0', '1', '1', '0', '1482718234', '1482718268', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('32', '比特币破1000美元大关在即，市值创新高超150亿美元', '<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:26px;background-color:#F9F9F9;\">\r\n	比特币破1000美元大关在即，市值创新高超150亿美元\r\n</div>\r\n<div style=\"margin:5px 0px 0px;padding:0px;border:0px;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;color:#999999;background-color:#F9F9F9;\">\r\n	<br />\r\n</div>\r\n<div class=\"bk30 hr\" style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;background:url(http://www.btc38.com/statics/images/uline.gif) 50% 50% repeat-x #F9F9F9;\">\r\n</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;background-color:#F9F9F9;\">\r\n	<p>\r\n		2016年12月27日，根据各大交易所的每日平均价格计算，流通的比特币供应美元市值再创新高，已经突破150亿美元，比特币单价已经接近1000美元。截止发稿时，中国各大交易所已经普遍突破6800人民币，约合990美元。\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		<img src=\"http://www.btc38.com/ueditor/php/upload/image/20161228/1482892305782707.jpg\" title=\"1482892305782707.jpg\" alt=\"725_Ly9jb2ludGVsZWdyYXBoLmNvbS9zdG9yYWdlL3VwbG9hZHMvdmlldy80ZGM4ODQwMTg3ODIxMmRiNDZmYTQ3YWIyMzA1ZDdmMS5qcGc.jpg\" width=\"401\" height=\"264\" style=\"width:401px;height:264px;\" />\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		根据CoinMarketCap数据显示，在过去24小时内，比特币交易量达到1.297亿美元。这一数字比前几日有所降低。例如，圣诞节平安夜，比特币以920美元交易的交易量达到2.24亿美元。\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		因此，随着比特币价格持续升高，迈向1000美元，交易量可能会在未来24小时上升。\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		在此之前，CivicKey CEO 文尼·林厄姆（Vinny Lingham）和F-Secure首席研究官米科·海坡能（Mikko Hypponen）都表示，比特币会在2017年到来之前达到1000美元。尽管几位市场观察人士仍在观望价格上涨的局面，不过如今距离1000美元大关只差临门一脚。\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		<strong>中国‘不为比特币的上涨负有责任’？</strong>\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		Lingham之前表示中国方面可能并不是比特币价格暴涨的原因，真正的原因是由于‘比特币供给曲线中的供应间隔出现真空状态’。\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		来自印度的一名早期比特币人Vivekomon在与Cointelegraph的对话中表示，比特币市值创新高并不出乎意料。他说：“不，对于像我这样的早期比特币采用者来说，比特币市值创新高并不出乎意料。我强烈认为比特币市值还会进一步上涨！！这才刚刚开始！’\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		“对于我来说，看到比特币实际价值能够回归以及用户群和比特币区块链生态系统应用增加，这实在太棒了！全球民众已经开始使用比特币用于汇款或者作为一种价值存储的替代性投资。越来越多的人们与互联网相连并且拥有更多意识形态，人们正在全球市场探索更多的机遇。”\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<p>\r\n		原文：https://cointelegraph.com/news/bitcoin-now-15-bln-market-going-to-1000-mark\r\n	</p>\r\n	<p>\r\n		作者：Olusegun Ogundeji\r\n	</p>\r\n	<p>\r\n		编译：Kyle\r\n	</p>\r\n	<p>\r\n		文章：http://www.8btc.com/bitcoin-close-to-1000\r\n	</p>\r\n	<p>\r\n		<span>免责声明：本文为转载，仅为传播消息之用，不代表币创网建议，炒币有风险，投资需谨慎！！！</span>\r\n	</p>\r\n	<div>\r\n		<span><br />\r\n</span>\r\n	</div>\r\n</div>', '1', 'bbb', '0', '1', '1', '0', '1482928838', '1482928873', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('33', '币创网加强反洗钱措施的公告', '<span style=\"color:#CC33E5;font-size:14px;\">币创网加强反洗钱措施的公告</span><br />\r\n<br />\r\n<br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">为了响应央行等国家五部委《关于防范比特币风险的通知》，以及落实《中华人民共和国反洗钱法》的规定，维护正常的交易秩序，从即日起，币创网将执行以下反洗钱措施：</span><br />\r\n<br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">实名认证</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">1. 用户注册时，必须提供真实姓名，真实姓名经实名认证后将不能够更改，请务必如实填写；</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">2.	币创网只接受实名充值、提现，充值及提现银行卡信息必须与您的实名认证信息一致；</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">3.	注册币创网账户需同意：我承认提交的信息属于本人所有，不存在冒用、盗用他人证件的行为。因冒用、盗用他人证件造成的一切后果，由本人承担；</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">4. 用户更改交易密码后，应当提供清晰的手持身份证明照片，币创网将对用户提供的身份信息进行识别和比对；</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">5. 币创网有合理的理由怀疑用户提供虚假身份信息时，有权拒绝注册或者冻结、注销已经注册的账户及资产。</span><br />\r\n<br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">资金进出审核</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">1. 根据国家反洗钱政策及保障客户资产安全，汇款人姓名必须和币创网实名认证姓名一致，提现账户的姓名也必须与币创网实名认证姓名一致；</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">2 .对于超过5万以上的人民币提现及大额的提币，我们将对用户身份通过客服电话（400-655-1686）进行人工核实；</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">3.	币创网将参照《金融机构大额交易和可疑交易报告管理办法》的规定，保存大额交易和有洗钱嫌疑的交易记录，在监管机构要求提供大额交易和可疑交易的记录时，向监管机构提供；</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">4.	币创网将对用户身份信息以及大额交易、可疑交易记录进行保存，依法协助、配合司法机关和行政执法机关打击洗钱活动，依照法律法规的规定协助司法机关、海关、税务等部门查询、冻结和扣划客户存款。</span><br />\r\n<br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">犯罪线索举报</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">币创网已成立专门风险控制部门，对各类违法犯罪活动进行监控。如果您有违法犯罪的线索，请通过以下联系方式联系我们或者有关国家机关：</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">1. 币创网反洗钱举报电话：400-655-1686转3号联系人: 秦志</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">2. 中国反洗钱监测分析中心举报电话：	010－88092000 &nbsp;电子邮箱：fiureport@pbc.gov.cn</span><br />\r\n<span style=\"color:#CC33E5;font-size:14px;\">3. 网络110报警网址：http://www.cyberpolice.cn</span><br />', '1', 'aaa', '0', '1', '1', '0', '1482929483', '1482929518', '0', '');
INSERT INTO `qq3479015851_article` VALUES ('34', '国务院印发 “十三五”国家信息化规划', '<p style=\"color:#333333;font-family:宋体;font-size:16px;text-align:center;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bold;\"><span style=\"font-size:18pt;\">国务院关于印发</span><br />\r\n<span style=\"font-size:18pt;\">“十三五”国家信息化规划的通知</span></span>\r\n</p>\r\n<p style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:center;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">国发〔2016〕73号</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-align:justify;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-align:justify;background-color:#FFFFFF;\">\r\n	各省、自治区、直辖市人民政府，国务院各部委、各直属机构：\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	现将《“十三五”国家信息化规划》印发给你们，请认真贯彻执行。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-align:justify;background-color:#FFFFFF;\">\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 国务院\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-align:justify;background-color:#FFFFFF;\">\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2016年12月15日\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	（此件公开发布）\r\n</p>\r\n<p style=\"color:#333333;font-family:宋体;font-size:16px;text-align:center;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bold;font-size:18pt;\"><br />\r\n</span>\r\n</p>\r\n<p style=\"color:#333333;font-family:宋体;font-size:16px;text-align:center;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bold;font-size:18pt;\">“十三五”国家信息化规划</span>\r\n</p>\r\n<p style=\"color:#333333;font-family:宋体;font-size:16px;text-align:center;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bold;font-size:18pt;\"><br />\r\n</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	“十三五”时期是全面建成小康社会的决胜阶段，是信息通信技术变革实现新突破的发轫阶段，是数字红利充分释放的扩展阶段。信息化代表新的生产力和新的发展方向，已经成为引领创新和驱动转型的先导力量。围绕贯彻落实“五位一体”总体布局和“四个全面”战略布局，加快信息化发展，直面“后金融危机”时代全球产业链重组，深度参与全球经济治理体系变革；加快信息化发展，适应把握引领经济发展新常态，着力深化供给侧结构性改革，重塑持续转型升级的产业生态；加快信息化发展，构建统一开放的数字市场体系，满足人民生活新需求；加快信息化发展，增强国家文化软实力和国际竞争力，推动社会和谐稳定与文明进步；加快信息化发展，统筹网上网下两个空间，拓展国家治理新领域，让互联网更好造福国家和人民，已成为我国“十三五”时期践行新发展理念、破解发展难题、增强发展动力、厚植发展优势的战略举措和必然选择。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	本规划旨在贯彻落实“十三五”规划纲要和《国家信息化发展战略纲要》，是“十三五”国家规划体系的重要组成部分，是指导“十三五”期间各地区、各部门信息化工作的行动指南。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bold;\">一、发展现状与形势</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">（一）发展成就。</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	党中央、国务院高度重视信息化工作。“十二五”时期特别是党的十八大之后，成立中央网络安全和信息化领导小组，通过完善顶层设计和决策体系，加强统筹协调，作出实施网络强国战略、大数据战略、“互联网+”行动等一系列重大决策，开启了信息化发展新征程。各地区、各部门扎实工作、开拓创新，我国信息化取得显著进步和成就。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">信息基础设施建设实现跨越式发展，宽带网络建设明显加速。</span>截至2015年底，我国网民数达到6.88亿，互联网普及率达到50.3%，互联网用户、宽带接入用户规模位居全球第一。第三代移动通信网络（3G）覆盖全国所有乡镇，第四代移动通信网络（4G）商用全面铺开，第五代移动通信网络（5G）研发步入全球领先梯队，网络提速降费行动加快推进。三网融合在更大范围推广，宽带广播电视和有线无线卫星融合一体化建设稳步推进。北斗卫星导航系统覆盖亚太地区。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">信息产业生态体系初步形成，重点领域核心技术取得突破。</span>集成电路实现28纳米（nm）工艺规模量产，设计水平迈向16/14nm。“神威•太湖之光”超级计算机继“天河二号”后蝉联世界超级计算机500强榜首。高世代液晶面板生产线建设取得重大进展，迈向10.5代线。2015年，信息产业收入规模达到17.1万亿元，智能终端、通信设备等多个领域的电子信息产品产量居全球第一，涌现出一批世界级的网信企业。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">网络经济异军突起，基于互联网的新业态新模式竞相涌现。</span>2015年，电子商务交易额达到21.79万亿元，跃居全球第一。“互联网+”蓬勃发展，信息消费大幅增长，产业互联网快速兴起，从零售、物流等领域逐步向一二三产业全面渗透。网络预约出租汽车、大规模在线开放课程（慕课）等新业态新商业模式层出不穷。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">电子政务应用进一步深化，网络互联、信息互通、业务协同稳步推进。</span>统一完整的国家电子政务网络基本形成，基础信息资源共享体系初步建立，电子政务服务不断向基层政府延伸，政务公开、网上办事和政民互动水平显著提高，有效促进政府管理创新。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">社会信息化水平持续提升，网络富民、信息惠民、服务便民深入发展。</span>信息进村入户工程取得积极成效，互联网助推脱贫攻坚作用明显。大中小学各级教育机构初步实现网络覆盖。国家、省、市、县四级人口健康信息平台建设加快推进，电子病历普及率大幅提升，远程会诊系统初具规模。医保、社保即时结算和跨区统筹取得新进展，截至2015年底，社会保障卡持卡人数达到8.84亿人。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">网络安全保障能力显著增强，网上生态持续向好。</span>网络安全审查制度初步建立，信息安全等级保护制度基本落实，网络安全体制机制逐步完善。国家关键信息基础设施安全防护水平明显提升，国民网络安全意识显著提高。发展了中国特色社会主义治网之道，网络文化建设持续加强，互联网成为弘扬社会主义核心价值观和中华优秀传统文化的重要阵地，网络空间日益清朗。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">网信军民融合体系初步建立，技术融合、产业融合、信息融合不断深化。</span>网信军民融合顶层设计、战略统筹和宏观指导得到加强，实现了集中统一领导和决策，一批重大任务和重大工程落地实施。军民融合式网信产业基础进一步夯实，初步实现网络安全联防联控、网络舆情军地联合管控，信息基础设施共建合用步伐加快。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">网络空间国际交流合作不断深化，网信企业走出去步伐明显加快。</span>成功举办世界互联网大会、中美互联网论坛、中英互联网圆桌会议、中国—东盟信息港论坛、中国—阿拉伯国家网上丝绸之路论坛、中国—新加坡互联网论坛。数字经济合作成为多边、双边合作新亮点。一批网信企业加快走出去，积极参与“一带一路”沿线国家信息基础设施建设。跨境电子商务蓬勃发展，年增速持续保持在30%以上。\r\n</p>\r\n<p style=\"color:#333333;font-family:宋体;font-size:16px;text-align:center;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bold;\">“十二五”信息化发展基本情况</span>\r\n</p>\r\n<div align=\"center\" style=\"margin:0px auto;padding:0px;color:#333333;font-family:宋体;font-size:16px;background-color:#FFFFFF;\">\r\n	<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" width=\"605\" style=\"margin:0px;padding:0px;border:none;\">\r\n		<tbody>\r\n			<tr>\r\n				<td width=\"246\" rowspan=\"2\" style=\"border:1pt solid black;\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">指　标</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"170\" colspan=\"2\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">规划目标</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"170\" colspan=\"2\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">实现情况</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">2015</span><span style=\"font-size:10pt;font-family:宋体;\">年</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">年均增长</span>\r\n					</p>\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">（%）</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">2015</span><span style=\"font-size:10pt;font-family:宋体;\">年</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">年均增长</span>\r\n					</p>\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">（%）</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"586\" colspan=\"5\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;font-weight:bold;\">总体发展水平</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">1.</span><span style=\"font-size:10pt;font-family:宋体;\">信息化发展指数</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;79</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">—</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">72.45</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">—</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"586\" colspan=\"5\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;font-weight:bold;\">信息技术与产业</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">2.</span><span style=\"font-size:10pt;font-family:宋体;\">集成电路芯片规模生产工艺<span>（</span>纳米<span>）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">32/28</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">—</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">28</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">—</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">3.</span><span style=\"font-size:10pt;font-family:宋体;\">信息产业收入规模<span>（</span>万亿元<span>）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">16</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">10</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">17.1</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">13</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"586\" colspan=\"5\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;font-weight:bold;\">信息基础设施</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">4.</span><span style=\"font-size:10pt;font-family:宋体;\">网民数量<span>（</span>亿<span>）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">8.5</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">13.2</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">6.88</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">8.5</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">5.</span><span style=\"font-size:10pt;font-family:宋体;\">固定互联网宽带接入用户<span>（</span>亿户<span>）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;2.7</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;15.7</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">2.1</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">10.1</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">6.</span><span style=\"font-size:10pt;font-family:宋体;\">光纤入户用户数<span>（</span>亿户<span>）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;0.77</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;103.6</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">1.2</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">126.8</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">7.</span><span style=\"font-size:10pt;font-family:宋体;\">城市家庭宽带接入能力<span>（Mbps）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">20</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">38.0</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">20</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">38.0</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">8.</span><span style=\"font-size:10pt;font-family:宋体;\">农村家庭宽带接入能力<span>（Mbps）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">4</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">14.9</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">4</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">14.9</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">9.</span><span style=\"font-size:10pt;font-family:宋体;\">县级以上城市有线广播电视网络实现双向化率<span>（%）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">80</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>55</span>〕</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">53</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>28</span>〕</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">10.</span><span style=\"font-size:10pt;font-family:宋体;\">互联网国际出口带宽<span>（Tbps）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">6.5</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">42.7</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">3.8</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">37.5</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"586\" colspan=\"5\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;font-weight:bold;\">信息经济</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">11.</span><span style=\"font-size:10pt;font-family:宋体;\">制造业主要行业大中型企业关键工序数<span>（</span>自<span>）</span>控化率<span>（%）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;70</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;6.08</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">70</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">6.08</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">12.</span><span style=\"font-size:10pt;font-family:宋体;\">电子商务交易规模<span>（</span>万亿元<span>）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;18</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;31.7</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">21.79</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">35.5</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"586\" colspan=\"5\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;font-weight:bold;\">信息服务</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">13.</span><span style=\"font-size:10pt;font-family:宋体;\">中央部委和省级政务部门主要业务信息化覆盖率<span>（%）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;85</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>&gt;15</span>〕</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">90.8</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>20.8</span>〕</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">14.</span><span style=\"font-size:10pt;font-family:宋体;\">地市级政务部门主要业务信息化覆盖率<span>（%）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">70</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>30</span>〕</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">76.8</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>36.8</span>〕</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">15.</span><span style=\"font-size:10pt;font-family:宋体;\">县级政务部门主要业务信息化覆盖率<span>（%）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">50</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>25</span>〕</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">52.5</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>27.5</span>〕</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">16.</span><span style=\"font-size:10pt;font-family:宋体;\">电子健康档案城乡居民覆盖率（<span>%）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">&gt;70</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>&gt;30</span>〕</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">75</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">〔<span>35</span>〕</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"246\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">17.</span><span style=\"font-size:10pt;font-family:宋体;\">社会保障卡持卡人数<span>（</span>亿<span>）</span></span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">8</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">50.7</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">8.84</span>\r\n					</p>\r\n				</td>\r\n				<td width=\"85\">\r\n					<p align=\"center\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;text-align:center;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">53.7</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"586\" colspan=\"5\">\r\n					<p align=\"left\" style=\"font-size:10.5pt;font-family:Calibri, sans-serif;\">\r\n						<span style=\"font-size:10pt;font-family:宋体;\">注<span>：</span>〔 〕表示五年累计数<span>，</span>单位为百分点。</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</div>\r\n<p style=\"color:#333333;font-family:宋体;text-align:justify;font-size:10.5pt;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Calibri, sans-serif;\">&nbsp;　　</span><span style=\"font-size:16px;font-family:楷体, 楷体_GB2312;\">（二）发展形势。</span>\r\n</p>\r\n<p style=\"color:#333333;font-family:宋体;text-align:justify;font-size:10.5pt;background-color:#FFFFFF;\">\r\n	<span style=\"font-size:16px;\"><span style=\"font-family:楷体, 楷体_GB2312;\">　　</span>“十三五”时期，全球信息化发展面临的环境、条件和内涵正发生深刻变化。从国际看，世界经济在深度调整中曲折复苏、增长乏力，全球贸易持续低迷，劳动人口数量增长放缓，资源环境约束日益趋紧，局部地区地缘博弈更加激烈，全球性问题和挑战不断增加，人类社会对信息化发展的迫切需求达到前所未有的程度。同时，全球信息化进入全面渗透、跨界融合、加速创新、引领发展的新阶段。信息技术创新代际周期大幅缩短，创新活力、集聚效应和应用潜能裂变式释放，更快速度、更广范围、更深程度地引发新一轮科技革命和产业变革。物联网、云计算、大数据、人工智能、机器深度学习、<span style=\"color:#CC33E5;\">区块链</span>、生物基因工程等新技术驱动网络空间从人人互联向万物互联演进，数字化、网络化、智能化服务将无处不在。现实世界和数字世界日益交汇融合，全球治理体系面临深刻变革。全球经济体普遍把加快信息技术创新、最大程度释放数字红利，作为应对“后金融危机”时代增长不稳定性和不确定性、深化结构性改革和推动可持续发展的关键引擎。</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	从国内看，我国经济发展进入新常态，正处于速度换挡、结构优化、动力转换的关键节点，面临传统要素优势减弱和国际竞争加剧双重压力，面临稳增长、促改革、调结构、惠民生、防风险等多重挑战，面临全球新一轮科技产业革命与我国经济转型、产业升级的历史交汇，亟需发挥信息化覆盖面广、渗透性强、带动作用明显的优势，推进供给侧结构性改革，培育发展新动能，构筑国际竞争新优势。从供给侧看，推动信息化与实体经济深度融合，有利于提高全要素生产率，提高供给质量和效率，更好地满足人民群众日益增长、不断升级和个性化的需求；从需求侧看，推动互联网与经济社会深度融合，创新数据驱动型的生产和消费模式，有利于促进消费者深度参与，不断激发新的需求。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	同时，我国信息化发展还存在一些突出短板，主要是：技术产业生态系统不完善，自主创新能力不强，核心技术受制于人成为最大软肋和隐患；互联网普及速度放缓，贫困地区和农村地区信息基础设施建设滞后，针对留守儿童、残障人士等特殊人群的信息服务供给薄弱，数字鸿沟有扩大风险；信息资源开发利用和公共数据开放共享水平不高，政务服务创新不能满足国家治理体系和治理能力现代化的需求；制约数字红利释放的体制机制障碍仍然存在，与先进信息生产力相适应的法律法规和监管制度还不健全；网络安全技术、产业发展滞后，网络安全制度有待进一步完善，一些地方和部门网络安全风险意识淡薄，网络空间安全面临严峻挑战。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	综合研判，“十三五”时期是信息化引领全面创新、构筑国家竞争新优势的重要战略机遇期，是我国从网络大国迈向网络强国、成长为全球互联网引领者的关键窗口期，是信息技术从跟跑并跑到并跑领跑、抢占战略制高点的激烈竞逐期，也是信息化与经济社会深度融合、新旧动能充分释放的协同迸发期。必须认清形势，树立全球视野，保持战略定力，增强忧患意识，加强统筹谋划，着力补齐短板，主动顺应和引领新一轮信息革命浪潮，务求在未来五到十年取得重大突破、重大进展和重大成果，在新的历史起点上开创信息化发展新局面。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bold;\">二、总体要求</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">（一）指导思想。</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	全面贯彻党的十八大和十八届三中、四中、五中、六中全会精神，深入贯彻习近平总书记系列重要讲话精神，认真落实党中央、国务院决策部署，按照“五位一体”总体布局和“四个全面”战略布局，牢固树立创新、协调、绿色、开放、共享的发展理念，着力补齐核心技术短板，全面增强信息化发展能力；着力发挥信息化对经济社会发展的驱动引领作用，培育发展新动能，拓展网络经济空间，壮大网络信息等新兴消费，全面提升信息化应用水平；着力满足广大人民群众普遍期待和经济社会发展关键需要，重点突破，推动信息技术更好服务经济升级和民生改善；着力深化改革，激发创新活力，主动防范和化解风险，全面优化信息化发展环境。坚定不移走中国特色信息化发展道路，实施网络强国战略，让信息化更好造福国家和人民，为如期全面建成小康社会提供强大动力。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">（二）主要原则。</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">坚持以惠民为宗旨。</span>把增进人民福祉、促进人的全面发展作为信息化发展的出发点和落脚点，着力发挥信息化促进公共资源优化配置的作用，以信息化提升公共治理和服务水平，促进人民生活水平和质量普遍提高。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">坚持全面深化改革。</span>正确处理政府和市场关系，坚持发挥市场在资源配置中的决定性作用，更好发挥政府作用，破除不利于信息化创新发展的体制机制障碍，激发创新活力，加强法治保障，释放数字红利，为经济社会发展提供持续动力。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">坚持服务国家战略</span>。围绕推进“一带一路”建设、京津冀协同发展、长江经济带发展等国家战略和经济、政治、文化、社会、生态、国防等重大需求，发挥信息化引领和支撑作用，做到国家利益在哪里、信息化就覆盖到哪里。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">坚持全球视野发展。</span>把握全球信息技术创新发展趋势和前沿动态，增强我国在全球范围配置人才、资金、技术、信息的能力，超前布局、加速赶超，积极推动全球互联网治理体系变革，提高我国国际话语权。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">坚持安全与发展并重。</span>树立科学的网络安全观，正确处理安全和发展的关系，坚持安全和发展双轮驱动，以安全保发展，以发展促安全，推动网络安全与信息化发展良性互动、互为支撑、协调共进。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">（三）发展目标。</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	到2020年，“数字中国”建设取得显著成效，信息化发展水平大幅跃升，信息化能力跻身国际前列，具有国际竞争力、安全可控的信息产业生态体系基本建立。信息技术和经济社会发展深度融合，数字鸿沟明显缩小，数字红利充分释放。信息化全面支撑党和国家事业发展，促进经济社会均衡、包容和可持续发展，为国家治理体系和治理能力现代化提供坚实支撑。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">核心技术自主创新实现系统性突破。</span>信息领域核心技术设备自主创新能力全面增强，新一代网络技术体系、云计算技术体系、端计算技术体系和安全技术体系基本建立。集成电路、基础软件、核心元器件等关键薄弱环节实现系统性突破。5G技术研发和标准制定取得突破性进展并启动商用。云计算、大数据、物联网、移动互联网等核心技术接近国际先进水平。部分前沿技术、颠覆性技术在全球率先取得突破，成为全球网信产业重要领导者。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">信息基础设施达到全球领先水平。</span>“宽带中国”战略目标全面实现，建成高速、移动、安全、泛在的新一代信息基础设施。固定宽带家庭普及率达到中等发达国家水平，城镇地区提供1000兆比特/秒（Mbps）以上接入服务能力，大中城市家庭用户带宽实现100Mbps以上灵活选择；98%的行政村实现光纤通达，有条件的地区提供100Mbps以上接入服务能力，半数以上农村家庭用户带宽实现50Mbps以上灵活选择；4G网络覆盖城乡，网络提速降费取得显著成效。云计算数据中心和内容分发网络实现优化布局。国际网络布局能力显著增强，互联网国际出口带宽达到20太比特/秒（Tbps），通达全球主要国家和地区的高速信息网络基本建成，建成中国—东盟信息港、中国—阿拉伯国家等网上丝绸之路。北斗导航系统覆盖全球。有线、无线、卫星广播电视传输覆盖能力进一步增强，基本实现广播电视户户通。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">信息经济全面发展。</span>信息经济新产业、新业态不断成长，信息消费规模达到6万亿元，电子商务交易规模超过38万亿元，信息化和工业化融合发展水平进一步提高，重点行业数字化、网络化、智能化取得明显进展，网络化协同创新体系全面形成。打破信息壁垒和孤岛，实现各部门业务系统互联互通和信息跨部门跨层级共享共用，公共数据资源开放共享体系基本建立，面向企业和公民的一体化公共服务体系基本建成，电子政务推动公共服务更加便捷均等。电信普遍服务补偿机制进一步完善，网络扶贫成效明显，宽带网络覆盖90%以上的贫困村。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-family:宋体;font-size:16px;text-indent:2em;text-align:justify;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:楷体, 楷体_GB2312;\">信息化发展环境日趋优化。</span>网络空间法治化进程全面推进，网络空间法律法规体系日趋完善，与信息社会相适应的制度体系基本建成，网信领域军民深度融合迈上新台阶。信息通信技术、产品和互联网服务的国际竞争力明显增强，网络空间国际话语权大幅提升。网络内容建设工程取得积极进展，媒体数字化建设成效明显。网络违法犯罪行为得到有力打击，网络空间持续清朗。信息安全等级保护制度得到全面落实。关键信息基础设施得到有效防护，网络安全保障能力显著提升。\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-size:16px;text-indent:2em;text-align:justify;\">\r\n	<span><span style=\"line-height:30px;background-color:#F9F9F9;\">原文：</span></span><span style=\"font-family:宋体;background-color:#FFFFFF;\">http://www.gov.cn/zhengce/content/2016-12/27/content_5153411.htm<br />\r\n</span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-size:16px;text-indent:2em;text-align:justify;\">\r\n	<span style=\"font-family:宋体;background-color:#FFFFFF;\"><span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:30px;background-color:#F9F9F9;\">原文发布机关： 国务院</span></span>\r\n</p>\r\n<p align=\"\" style=\"color:#333333;font-size:16px;text-indent:2em;text-align:justify;\">\r\n	<span style=\"font-family:宋体;background-color:#FFFFFF;\"><span style=\"color:#333333;font-family:\'Microsoft YaHei\', Arial, Verdana, sans-serif, \'Segoe UI\', Tahoma;font-size:16px;line-height:30px;background-color:#F9F9F9;\">免责声明：本文为转载，仅为传播消息之用，不代表币创网建议，炒币有风险，投资需谨慎！！！</span><br />\r\n</span>\r\n</p>', '1', 'bbb', '0', '1', '1', '0', '1483012531', '1483012494', '1', '');
INSERT INTO `qq3479015851_article` VALUES ('35', 'THC币分红150元人民币', '<span><span style=\"font-size:14px;color:#9933E5;\"><span style=\"color:#9933E5;font-size:16px;\">THC币分红150元人民币请在认购中心--分红记录中查看:</span>\r\n<table class=\"f_table\" id=\"investLog_content\" style=\"margin:0px;padding:0px;width:917px;color:#333333;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:14px;background-color:#FFFFFF;\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#707070;text-align:center;\">\r\n				<span style=\"color:#9933E5;font-size:24px;\"><span style=\"color:#9933E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:16px;line-height:36px;background-color:#EDEDED;\">分红名称</span><span style=\"color:#9933E5;font-size:16px;\"></span><span style=\"color:#9933E5;font-size:16px;\">thbtc</span></span>\r\n			</td>\r\n			<td style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#707070;text-align:center;\">\r\n				<span style=\"color:#9933E5;font-size:24px;\"><span style=\"color:#9933E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:16px;line-height:36px;background-color:#EDEDED;\">分红币种</span><span style=\"color:#9933E5;font-size:16px;\"></span><span style=\"color:#9933E5;font-size:16px;\">thc</span></span>\r\n			</td>\r\n			<td style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#707070;text-align:center;\">\r\n				<span style=\"color:#9933E5;font-size:24px;\"><span style=\"color:#9933E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:16px;line-height:36px;background-color:#EDEDED;\">奖励</span><span style=\"color:#9933E5;font-size:16px;\"></span><span style=\"color:#9933E5;font-size:16px;\">cny</span></span>\r\n			</td>\r\n			<td style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#707070;text-align:center;\">\r\n				<span style=\"color:#9933E5;font-size:24px;\"><span style=\"color:#9933E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:16px;line-height:36px;background-color:#EDEDED;\">分红总额</span><span style=\"color:#9933E5;font-size:16px;\"></span><span style=\"color:#9933E5;font-size:16px;\">150</span></span>\r\n			</td>\r\n			<td style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#707070;text-align:center;\">\r\n				<span style=\"color:#9933E5;font-size:24px;\"><span style=\"color:#9933E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:16px;line-height:36px;background-color:#EDEDED;\">每个分红</span><span style=\"color:#9933E5;font-size:16px;\"></span><span style=\"color:#9933E5;font-size:16px;\">0.00006281</span></span>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<span style=\"color:#9933E5;font-size:16px;\"></span></span></span><span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;color:#9933E5;\"></span></span>', '1', '币友说币', '0', '1', '1', '0', '1483163440', '1483163476', '1', '');

-- ----------------------------
-- Table structure for `qq3479015851_article_type`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_article_type`;
CREATE TABLE `qq3479015851_article_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `remark` varchar(50) CHARACTER SET utf8 NOT NULL,
  `index` varchar(50) CHARACTER SET utf8 NOT NULL,
  `footer` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `shang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of qq3479015851_article_type
-- ----------------------------
INSERT INTO `qq3479015851_article_type` VALUES ('1', '公司简介', '公司简介', '行业资讯', '0', '1', 'aboutus', '<br />\r\n<span style=\"color:#CC33E5;\"> 币创网网(www.thbtc.com)由深圳区链网络科技有限公司于2016年10月创办，</span><span style=\"font-family:微软雅黑, sans-serif;line-height:27px;color:#CC33E5;\">公司注册资本500万，</span><span style=\"color:#CC33E5;\">2016年11月正式上线。上线之初即获得天使资金投资，投资的60%用于平台推广和宣传,</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:normal;color:#CC33E5;\">其核心团队由多个关注虚拟货币多年的技术人员组成.</span><span></span><br />\r\n<span style=\"color:#CC33E5;\"> &nbsp;币创网网是面向中国的虚拟货币交易平台，我们致力于为您提供安全、快捷、稳定的虚拟货币交易，秉承谷歌“不作恶”的原则，</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:normal;color:#CC33E5;\">让大家都能在这里获取安全交易。</span><br />\r\n<span style=\"color:#CC33E5;\"> 币创网网在行业内率先实现了 100% 的数字币和法币的数量均为公开透明的。及时的展示和公布平台的会员数。</span><br />\r\n<span style=\"color:#CC33E5;\"> 在发展过程中，我们不仅成了一个团队。我们成了对这项事业有着共同热爱的好朋友！我们所有的员工都具备顶尖资质，能够为每一位客户提供最高水平的服务和个性化方案。我们的团队提供7X12小时的服务，因此让每个客户快乐</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:normal;color:#CC33E5;\">稳定和优质的交易体验</span><span style=\"color:#CC33E5;\">。</span><br />\r\n<div>\r\n	<br />\r\n</div>', '1', '1480224496', '1480224497', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('2', 'xiazai', '下载中心', '最新公告', '0', '1', '', '', '3', '0', '0', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('3', 'help', '帮助中心', '帮助中心', '0', '1', '', '', '2', '0', '0', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('4', 'aboutus', '关于我们', '关于我们', '0', '1', '', '', '1', '0', '0', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('5', '联系我们', '联系我们', '', '0', '1', 'aboutus', '请发送邮箱至56703338@qq.com', '2', '1480224546', '1480224548', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('6', '加入我们', '加入我们', '', '0', '1', 'aboutus', '<span style=\"color:#CC33E5;font-size:14px;\">请发邮件至:56703338@qq.com</span>', '4', '1480865835', '1480865836', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('7', '法律声明', '法律声明', '', '0', '1', 'aboutus', '《虚拟币交易平台--币创网网用户服务协议》<br />\r\n一、总则<br />\r\n1.1、 用户在使用虚拟币交易平台服务前，应当仔细阅读《币创网网用户服务协议》（以下<br />\r\n简称“本协议”）的全部内容，对于本协议中的加重字体、斜体、下划线、颜色标记等条款<br />\r\n需重点阅读、理解。<br />\r\n1.2、 币创网网（http://thbtc.com）所提供的各项服务的所有权和运作权均归深圳市区链网络<br />\r\n科技有限公司（以下简称“币创网”）所有。<br />\r\n1.3、 用户应当同意本协议的全部条款并按照页面上的提示完成全部的注册程序。用户在进<br />\r\n行注册程序过程中点击\"注册\"按钮即表示用户与币创网达成以下协议，完全接受本协议项下<br />\r\n的全部条款，本协议即在用户与币创网之间产生法律效力，对双方均具有法律约束力。<br />\r\n1.4、 用户注册成功后，币创网将给予每个用户一个用户帐号及相应的密码，该用户帐号和<br />\r\n密码由用户负责保管；用户应当对以其用户帐号进行的所有活动和事件负法律责任。<br />\r\n1.5、 《币创网网用户服务协议》、单项服务条款、全部活动条款及公告可由币创网随时更<br />\r\n新，且无需另行通知。币创网有权对上述条款进行修改，修改后的协议一旦公布即有效替代<br />\r\n原有协议。用户可随时查询最新协议。用户在使用币创网提供的各项服务之前，应仔细阅读<br />\r\n本协议及本协议不可分割的各项服务协议。用户在使用相关服务时,应关注并遵守其所适用<br />\r\n的相关条款。用户如不同意本服务协议及/或随时对其的修改，不得访问或使用本网站相关<br />\r\n服务；用户一旦使用币创网服务，即视为用户已了解并完全同意本协议及其他服务条款中的<br />\r\n各项内容，包括币创网对本协议及其他服务条款随时所做的任何修改，并成为币创网用户。<br />\r\n二、用户资格及注册<br />\r\n2.1、 用户应为具有完全民事权利能力和民事行为能力的自然人、法人，或是能够独立承担<br />\r\n民事责任能力的其他组织。用户若不具有前述规定的法律能力资格，须经法定代理人同意或<br />\r\n由法定代理人代理，或是得到有权主体授权后进行注册、交易。或虽不具有完全民事权利能<br />\r\n力和行为能力,但点击同意注册按钮， 币创网即视为经其法定代理人同意并由其法定代理人<br />\r\n代理注册及完成交易等服务内容的操作。<br />\r\n2.2、 用户使用币创网提供的网络平台服务前，应自行准备如下设备并承担如下开支：<br />\r\n2.2.1、 自行配备上网的所需设备，包括个人电脑、调制解调器或其他必备上网装置；<br />\r\n2.2.2、 自行负担个人上网所支付的与此服务有关的电话费用、网络费用等。<br />\r\n2.3、 用户点击“同意以下协议并注册”按钮，则视为用户同意本协议的所有条款，且具有<br />\r\n浏览币创网平台相关信息、提交买单、合理交易等使用币创网提供的全部服务的权利能力和<br />\r\n行为能力，同意承担由此带来的全部法律责任。<br />\r\n<br />\r\n2.4、 用户注册、使用币创网不得出于非法或破坏币创网交易秩序的目的，用户保证向比特<br />\r\n儿提交的全部信息真实、准确和完整，不存在盗用、借用、买入非本人手机号码、电子邮箱<br />\r\n等进行注册、虚假交易和作弊交易的行为，用户若存在上述违规行为，币创网有权取消其交<br />\r\n易资格及因参加交易活动所获权益，并停止服务、封停帐号。如该违规行为给币创网造成损<br />\r\n失的，币创网保留追究赔偿及诉至法律解决的权利。<br />\r\n2.5、 用户注册成功后，应妥善保管其币创网平台帐户及密码，定期或不定期修改密码，在<br />\r\n每次使用币创网服务完毕后及时退出帐户，以确保帐户安全。用户不得将币创网平台帐户出<br />\r\n借、转让或用作其他非法用途，否则因帐户未妥善保管而造成损失的，用户应承担相应法律<br />\r\n责任。<br />\r\n三、用户个人信息保护<br />\r\n3.1、本协议所称之币创网用户信息是指符合法律、法规及相关规定，并符合下述范围的信<br />\r\n息：<br />\r\n3.1.1、用户注册币创网或申请币创网会员卡时，向币创网提供的个人信息；<br />\r\n3.1.2、用户在使用币创网服务、参加网站活动或访问网站网页时，币创网自动接收并记录的<br />\r\n用户浏览器端或手机客户端数据，包括但不限于 IP 地址、网站 Cookie 中的资料及用户要求<br />\r\n取用的网页记录；<br />\r\n3.1.3、币创网从商业伙伴处合法获取的用户个人信息；<br />\r\n3.1.4、其它币创网通过合法途径获取的用户个人信息。<br />\r\n3.2、币创网承诺：非经法定原因或用户事先许可，币创网不会向任何第三方透露用户的密<br />\r\n码、姓名、身份证，手机号码等非公开信息。并对用户信息中涉及识别用户个人身份和用户个人隐私<br />\r\n的信息进行保护，承诺在未获得用户许可的情况下，不会将用户的上述信息对外公开或提供<br />\r\n给任何第三方，但以下情况除外：<br />\r\n3.2.1、经用户同意向用户本人或其他第三方披露；<br />\r\n3.2.2、经用户同意公开其个人资料，享受为其提供的产品和服务；<br />\r\n3.2.3、根据法律、法规等相关规定，或行政机构要求，向行政、司法机构或其他法律规定的<br />\r\n第三方披露；<br />\r\n3.2.4、其它币创网根据法律、法规等相关规定进行的披露。<br />\r\n四、服务的提供、修改及终止<br />\r\n<br />\r\n4.1、用户可根据本协议及币创网公布的相关使用规则，查阅在币创网平台上发布的交易及<br />\r\n相关资料，通过币创网平台交易具体的金融服务产品等有关活动，及币创网现有及将来可能<br />\r\n提供的其他服务。<br />\r\n4.2、用户在使用币创网提供的上述服务时，应遵守本协议及币创网的相关使用规则，遵守<br />\r\n自愿、平等、公平及诚实信用原则，不利用币创网平台侵犯他人合法权益及谋取不正当利益，<br />\r\n不扰乱网上交易的正常秩序。<br />\r\n4.3、用户在接受币创网各项服务的同时，同意接受币创网网提供的各类信息服务。用户在<br />\r\n此授权币创网可以向其电子邮件、手机、通信地址等发送商业信息。用户有权选择不接受比<br />\r\n特儿提供的各类信息服务，并进入币创网相关页面进行更改。<br />\r\n4.4、币创网会尽全力维护平台的正常运行，以向用户提供持续、稳定、安全、顺畅的服务。<br />\r\n但用户理解并同意：币创网对服务页面进行改版、升级网站系统、增加服务功能等须中断服<br />\r\n务的操作时，有权暂时中断服务。<br />\r\n4.5、币创网保留随时修改或中断服务而不需通知用户的权利。币创网有权行使修改或中断<br />\r\n服务的权利，不需对用户或任何无直接关系的第三方负责。<br />\r\n4.6、用户对本协议的修改有异议，或对币创网的服务不满，可以行使如下权利：<br />\r\n4.6.1、停止使用币创网的网络服务；<br />\r\n4.6.2、通过客服等渠道告知币创网停止对其服务。结束服务后，用户使用币创网网络服务的<br />\r\n权利立即终止。在此情况下，币创网没有义务传送任何未处理的信息或未完成的服务给用户<br />\r\n或任何无直接关系的第三方。<br />\r\n五、用户权利<br />\r\n5.1、用户的用户名、密码和安全性<br />\r\n5.1.1、用户有权选择是否成为币创网会员，用户选择成为币创网注册用户的，可自行创建、<br />\r\n修改昵称。用户名和昵称的命名及使用应遵守相关法律法规并符合网络道德。用户名和昵称<br />\r\n中不能含有任何侮辱、威胁、淫秽、谩骂等侵害他人合法权益的文字。<br />\r\n5.1.2、用户一旦注册成功，成为币创网的会员，将得到用户名（用户邮箱）和密码，并对以<br />\r\n此组用户名和密码登入系统后所发生的所有活动和事件负责，自行承担一切使用该用户名的<br />\r\n言语、行为等而直接或者间接导致的法律责任。<br />\r\n5.1.3、用户有义务妥善保管币创网网账号、用户名和密码、短信验证码、谷哥验证码，用户<br />\r\n将对用户名和密码、和谷哥密钥安全负全部责任。因用户原因导致用户名或密码、谷哥密钥<br />\r\n泄露而造成的任何法律后果由用户本人负责，由于用户自身原因泄露这些信息导致的财产损<br />\r\n失，本站不负相关责任。由于本站是交易网站，登录密码、提现密码、交易密码、短信密码、<br />\r\n谷哥密码等不得使用相同密码，否则会有安全隐患，相关责任由用户自身承担。<br />\r\n5.1.4、用户密码遗失的，可以通过注册电子邮箱发送的链接重置密码，以手机号码注册的用<br />\r\n户可以凭借手机号码找回原密码。用户若发现任何非法使用用户名或存在其他安全漏洞的情<br />\r\n况，应立即告知币创网。<br />\r\n5.1.5、币创网不会向任何用户索取密码，不会让用户往任何非本站交易中心里提供的帐户、<br />\r\nbtc/ltc 充值地址打款，请大家不要相信任何币创网打折、优惠等诈骗信息，往非 btc/ltc 交易<br />\r\n中心提供的账户、地址里打款或币造成的损失本站不负责任。<br />\r\n5.2、用户有权根据网站相关规定，在发布信息等贡献后，取得币创网给予的奖励；<br />\r\n5.3、用户有权修改其个人账户中各项可修改信息，自行选择昵称和录入介绍性文字，自行<br />\r\n决定是否提供非必填项的内容；<br />\r\n5.4、用户有权参加币创网社区，并发表符合国家法律规定，并符合币创网社区规则的文章<br />\r\n及观点；<br />\r\n5.5、用户有权根据网站相关规定，获得币创网给与的奖励（如社区学分、徽章等）；<br />\r\n5.6、用户有权参加币创网组织提供的各项线上、线下活动；<br />\r\n5.7、用户有权根据币创网网站规定，享受币创网提供的其它各类服务。<br />\r\n六、用户义务<br />\r\n6.1 用户可以在币创网平台发布对商品或交易服务的评价信息，并可对其进行适当的修<br />\r\n改、删除，但不得不得利用本站危害国家安全、泄露国家秘密，不得侵犯国家社会集体的和<br />\r\n公民的合法权益，不得利用本站制作、复制和传播下列信息：<br />\r\n6.1.1、 反对宪法所确定的基本原则，煽动、抗拒、破坏宪法和法律、行政法规实施的；<br />\r\n6.1.2、 煽动颠覆国家政权，推翻社会主义制度，煽动、分裂国家，破坏国家统一的；<br />\r\n6.1.3、 损害国家荣誉和利益的；<br />\r\n6.1.4、 煽动民族仇恨、民族歧视，破坏民族团结的；<br />\r\n6.1.5、 任何包含对种族、性别、宗教、地域内容等歧视的；<br />\r\n6.1.6、 捏造或者歪曲事实，散布谣言，扰乱社会秩序的；<br />\r\n6.1.7、 宣扬封建迷信、邪教、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；<br />\r\n<br />\r\n6.1.8、 公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；<br />\r\n6.1.9、 损害国家机关信誉的；<br />\r\n6.1.10、其他违反宪法和法律行政法规的。<br />\r\n6.1.11、进行商业广告行为的<br />\r\n6.2、用户不得通过任何手段恶意注册币创网网站帐号，包括但不限于以牟利、炒作、套现、<br />\r\n获奖等为目的多个账号注册。用户亦不得盗用其他用户帐号。如用户违反上述规定，则比特<br />\r\n儿网有权直接采取一切必要的措施，包括但不限于删除用户发布的内容、取消用户在网站获<br />\r\n得的星级、荣誉以及虚拟财富，暂停或查封用户帐号，取消因违规所获利益，乃至通过诉讼<br />\r\n形式追究用户法律责任等。<br />\r\n6.3、禁止用户将币创网网任何形式作为从事各种非法活动的场所、平台或媒介。未经比特<br />\r\n儿的授权或许可，用户不得借用本站的名义从事任何商业活动，也不得以任何形式将币创网<br />\r\n作为从事商业活动的场所、平台或媒介。如用户违反上述规定，则币创网有权直接采取一切<br />\r\n必要的措施，包括但不限于删除用户发布的内容、取消用户在网站获得的星级、荣誉以及虚<br />\r\n拟财富，暂停或查封用户帐号，取消因违规所获利益，乃至通过诉讼形式追究用户法律责任<br />\r\n等。<br />\r\n6.4、用户在币创网以各种形式发布的一切信息，均应符合国家法律法规等相关规定及网站<br />\r\n相关规定，符合社会公序良俗，并不侵犯任何第三方主体的合法权益，否则用户自行承担因<br />\r\n此产生的一切法律后果，且币创网因此受到的损失，有权向用户追偿。<br />\r\n七、责任限制与免责<br />\r\n7.1、不论在任何情况下，币创网对由于互联网正常的设备维护，互联网络连接故障，电脑、<br />\r\n通讯或其他系统的故障，网络攻击，电力故障，罢工，暴乱，骚乱，灾难性天气（如火灾、<br />\r\n洪水、风暴等），爆炸，战争，政府行为，司法行政机关的命令或第三方的不作为而造成的<br />\r\n不能履行或延迟履行服务不承担责任。<br />\r\n7.2、币创网作为“网络服务提供者”的第三方平台，不担保网站平台上的信息及服务能充<br />\r\n分满足用户的需求。对于用户在接受币创网的服务过程中可能遇到的错误、侮辱、诽谤、不<br />\r\n作为、淫秽、色情或亵渎事件，币创网不承担法律责任。<br />\r\n7.3、基于互联网的特殊性，币创网也不担保服务不会受中断，对服务的及时性、安全性都<br />\r\n不作担保，不承担非因币创网导致的责任。<br />\r\n7.4、币创网力图使用户能对本网站进行安全访问和使用，但币创网不声明也不保证本网站<br />\r\n或其服务器是不含病毒或其它潜在有害因素的；因此用户应使用业界公认的软件查杀任何自<br />\r\n币创网下载文件中的病毒。用户须自行辨别真伪，谨慎预防风险。<br />\r\n<br />\r\n7.5、币创网不对用户所发布信息的保存、修改、删除或储存失败负责。对网站上的非因比<br />\r\n特儿故意所导致的排字错误、疏忽等不承担责任。用户须自行辨别真伪，谨慎预防风险。<br />\r\n7.6、币创网有权但无义务，改善或更正本网站任何部分之疏漏、错误。<br />\r\n7.7、除非币创网以书面形式明确约定，币创网对于用户以任何方式（包括但不限于包含、<br />\r\n经由、连接或下载）从本网站所获得的任何内容信息，包括但不限于广告等，不保证其准确<br />\r\n性、完整性、可靠性；对于用户因本网站上的内容信息而购买、获取的任何产品、服务、信<br />\r\n息或资料，币创网不承担责任。用户自行承担使用本网站信息内容所导致的风险。<br />\r\n7.8、币创网内所有用户所发表的用户评论，仅代表用户个人观点，并不表示本网站赞同其<br />\r\n观点或证实其描述，本网站不承担用户评论引发的任何法律责任。<br />\r\n7.9、币创网有权删除币创网网内各类不符合法律或协议规定的信息，而保留不通知用户的<br />\r\n权利。<br />\r\n7.10、所有发给用户的通告，币创网都将通过正式的页面公告、站内信、电子邮件、客服电<br />\r\n话、手机短信或常规的信件送达。任何非经币创网正规渠道获得的中奖、优惠等活动或信息，<br />\r\n币创网不承担法律责任。<br />\r\n7.11、币创网有权根据市场情况调整充值、提现、交易等手续费费率，有权决定免费推广期<br />\r\n的终止。<br />\r\n八、法律管辖和适用<br />\r\n8.1、 本协议的订立、执行和解释及争议的解决均应适用中华人民共和国大陆地区的法律管<br />\r\n辖。<br />\r\n8.2、如发生本协议条款与上述法律相抵触时，则这些条款将完全按上述法律规定重新解释，<br />\r\n但不影响其它合法条款对用户产生的法律效力和影响。<br />\r\n8.3、 本协议的规定是可分割的，如本协议任何规定被裁定为无效或不可执行，则该规定可<br />\r\n被删除，不影响其余条款的继续执行。<br />\r\n8.4、 如双方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，<br />\r\n任何一方均可向币创网所在地人民法院提起诉讼。<br />\r\n8.5、本协议是币创网与用户注册成为币创网用户，使用币创网服务之间的重要法律文件，<br />\r\n币创网或者用户的任何其他书面或者口头意思表示与本协议不一致的，均应当以本协议为<br />\r\n准。<br />\r\n币创网平台深圳区链网络科技有限公司保留最终解释权。<br />\r\n<br />\r\n九、附则<br />\r\n本协议除以上正文部分外，还包括币创网平台发布的各项服务规则、产品使用规则、页面提<br />\r\n示提醒等，各项服务规则与本协议具有同等法律效力，为本协议不可分割的重要组成部分。<br />\r\n服务规则包括但不限 《币创网用户协议》、 《网络交易服务规则》、 《币创网平台使用规<br />\r\n则》、 《隐私声明》、 《反作弊声明》、 《用户交易体验承诺》、 《网购服务》等。其他<br />\r\n交易服务规则。<br />', '4', '1480224641', '1480224643', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('8', '免责声明', '免责声明', '', '0', '1', 'aboutus', '根椐人民银行等有关部委的相关规定，比特币等数字货币系特殊的虚拟商品，作为互联网上的商品买卖行为，普通民众在自担风险的前提下拥有参与的自由。数字货币行业目前存在很多不确定，不可控的风险因素（如预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），导致交易具有极高的风险。币创网网仅为数字货币等虚拟商品的爱好者提供一个自由的网上交换平台，对在币创网网平台交换的数字货币等虚拟商品的来源、价值，网站运营方不承担任何审查、担保、赔偿的法律责任。', '5', '1480224678', '1480224679', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('9', '注册协议', '注册协议', '', '0', '1', 'aboutus', '根椐人民银行等有关部委的相关规定，比特币等数字货币系特殊的虚拟商品，作为互联网上的商品买卖行为，普通民众在自担风险的前提下拥有参与的自由。数字货币行业目前存在很多不确定，不可控的风险因素（如预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），导致交易具有极高的风险。币创网网仅为数字货币等虚拟商品的爱好者提供一个自由的网上交换平台，对在币创网网平台交换的数字货币等虚拟商品的来源、价值，网站运营方不承担任何审查、担保、赔偿的法律责任。<br />\r\n<br />\r\n<br />\r\n<br />\r\n请您务必注意以下几点：<br />\r\n<br />\r\n<br />\r\n<br />\r\n1.警惕虚假宣传，不要听信任何币值会永远上涨的宣传，数字货币作为一种虚拟商品，具有极高的风险，很可能出现价值归零的情况。<br />\r\n<br />\r\n2.对于推广和运营方的市场承诺，需要谨慎判别，目前并没有相关法律能保证其兑现承诺，投币网不会对任何数字货币进行背书和承诺。<br />\r\n<br />\r\n3.坚决拒绝多层次传销组织，在我国参与该类组织是违法行为，造成的一切后果自负，平台将配合相关执法部门的要求进行调查、取证。<br />\r\n<br />\r\n4.根据《中华人民共和国反洗钱法》等有关法律规定，严格禁止利用平台进行洗钱等违法犯罪活动，平台将配合相关执法部门的要求进行调查、取证。<br />\r\n<br />\r\n5.数字货币和数字积分等虚拟商品所对应的实物财产和持有者享有的权利存在因发行方等义务相关方破产，关闭或违法犯罪等其他经营风险导致无法兑现的风险。<br />\r\n<br />\r\n6.在投币网注册参与交换的用户，应保证注册身份信息的真实、准确，保证拟交换的数字货币等虚拟商品的来源合法。因信息不真实造成的任何问题，平台概不负责。<br />\r\n<br />\r\n7.因国家法律，法规及政策性文件的制定和修改，导致数字货币等虚拟商品的交易被暂停或者禁止的，由此导致的全部损失由用户自行承担。<br />\r\n<br />\r\n8.请控制风险，不要投入超过您风险承受能力的资金，不要购买您所不了解的数字货币，数字积分等虚拟商品。<br />', '6', '1480224705', '1480224707', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('10', '注册指南', '注册指南', '', '0', '1', 'help', '<img src=\"/Upload/article/583a700024ba4.png\" alt=\"\" />', '1', '1480224781', '1480224782', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('11', '交易指南', '交易指南', '', '0', '1', 'help', '<img src=\"/Upload/article/583a6fe68794d.png\" alt=\"\" />', '2', '1480224756', '1480224757', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('12', '充值指南', '充值指南', '', '0', '1', 'help', '<img src=\"/Upload/article/58480f93daf68.jpg\" alt=\"\" />', '3', '1481117610', '1481117612', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('13', '充值限额', '充值限额', '', '0', '1', 'help', '<span style=\"color:#CC33E5;font-size:14px;\"><span style=\"font-size:14px;line-height:normal;color:#CC33E5;\">最小充值100最大充值10</span></span><span><span style=\"font-size:14px;line-height:normal;\"><span style=\"color:#CC33E5;font-size:14px;\"></span><span style=\"color:#CC33E5;font-size:14px;\">0000 请通过本人支付宝充值</span></span></span><span style=\"color:#CC33E5;font-size:14px;\"></span>', '4', '1481177606', '1481177607', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('14', '提现指南', '提现指南', '', '0', '1', 'help', '<h3 style=\"font-family:\'Microsoft YaHei\';font-weight:500;font-size:24px;background-color:#FFFFFF;\">\r\n	提现须知\r\n</h3>\r\n<p style=\"color:#999999;font-family:\'Microsoft YaHei\';font-size:14px;background-color:#FFFFFF;\">\r\n	1. 提现手续费率1％，每笔提现最低收费2元 。\r\n</p>\r\n<p style=\"color:#999999;font-family:\'Microsoft YaHei\';font-size:14px;background-color:#FFFFFF;\">\r\n	2. 单笔提现限额100元——50000元。\r\n</p>\r\n<p style=\"color:#999999;font-family:\'Microsoft YaHei\';font-size:14px;background-color:#FFFFFF;\">\r\n	3. 银行卡提现24小时内到帐，在已汇出24小时后 仍未收到款项，请联系客服。\r\n</p>', '5', '1480501522', '1480501524', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('15', 'aa', '虚拟币钱包下载', '', '0', '1', 'xiazai', '测试数据', '1', '0', '0', '0');
INSERT INTO `qq3479015851_article_type` VALUES ('16', '浏览器下载', '浏览器下载', '', '0', '1', 'xiazai', '<img src=\"/Upload/article/583a7016bd67f.png\" alt=\"\" />', '2', '1480224804', '1480224805', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('17', '新币上线申请', '新币上线申请', '', '0', '1', 'xiazai', '<img src=\"/Upload/article/583a70a9d79ff.png\" alt=\"\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span style=\"color:#CC33E5;\">请发邮件联系工作人员，合作愉快！！！</span>', '3', '1480224952', '1480224955', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('18', 'dd', '工具下载', '', '0', '1', 'xiazai', '测试数据', '4', '0', '0', '0');
INSERT INTO `qq3479015851_article_type` VALUES ('19', 'aaa', '官方公告', '', '1', '0', '', '', '1', '0', '0', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('20', 'bbb', '行业资讯', '', '1', '0', '', '', '2', '0', '0', '1');
INSERT INTO `qq3479015851_article_type` VALUES ('21', '币友说币', '币友说币', '', '1', '0', '', '', '3', '1480224089', '1480224091', '1');

-- ----------------------------
-- Table structure for `qq3479015851_auth_extend`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_auth_extend`;
CREATE TABLE `qq3479015851_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_auth_extend
-- ----------------------------
INSERT INTO `qq3479015851_auth_extend` VALUES ('1', '1', '1');
INSERT INTO `qq3479015851_auth_extend` VALUES ('1', '1', '2');
INSERT INTO `qq3479015851_auth_extend` VALUES ('1', '2', '1');
INSERT INTO `qq3479015851_auth_extend` VALUES ('1', '2', '2');
INSERT INTO `qq3479015851_auth_extend` VALUES ('1', '3', '1');
INSERT INTO `qq3479015851_auth_extend` VALUES ('1', '3', '2');
INSERT INTO `qq3479015851_auth_extend` VALUES ('1', '4', '1');
INSERT INTO `qq3479015851_auth_extend` VALUES ('1', '37', '1');

-- ----------------------------
-- Table structure for `qq3479015851_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_auth_group`;
CREATE TABLE `qq3479015851_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_auth_group
-- ----------------------------
INSERT INTO `qq3479015851_auth_group` VALUES ('2', 'admin', '1', '财务管理组', '拥有网站资金相关的权限', '-1', '431');
INSERT INTO `qq3479015851_auth_group` VALUES ('3', 'admin', '1', '超级管理员', '超级管理员组,拥有系统所有权限', '1', '424,426,431,433,434,435,436,437,438,439,440,441,443,444,445,446,447,448,449,450,451,452,453,454,455,456,458,459,460,461,462,463,465,466,467,469,470,471,473,474,475,476,477,479,480,481,482,484,485,486,487,488,489,490,491,492,493,494,495,496,497,498,499,500,501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517,518,519,520,521,522,523,525,526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,541,542,543,544,545,546,547,548,549');
INSERT INTO `qq3479015851_auth_group` VALUES ('4', 'admin', '1', '资讯管理员', '拥有网站文章资讯相关权限11', '-1', '');
INSERT INTO `qq3479015851_auth_group` VALUES ('5', 'admin', '1', '资讯管理员', '拥有网站文章资讯相关权限', '1', '');
INSERT INTO `qq3479015851_auth_group` VALUES ('6', 'admin', '1', '财务管理组', '拥有网站资金相关的权限333', '1', '1671,1686,1687,1740,1741,1742,1743,1763,1765,1779,1780,1805,1806,1826,1827,1828,1832,1840,1841');
INSERT INTO `qq3479015851_auth_group` VALUES ('10', 'admin', '1', '财务管理组', '拥有网站资金相关的权限333', '1', '');
INSERT INTO `qq3479015851_auth_group` VALUES ('11', 'admin', '1', 'ceshi', '', '1', '');

-- ----------------------------
-- Table structure for `qq3479015851_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_auth_group_access`;
CREATE TABLE `qq3479015851_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_auth_group_access
-- ----------------------------
INSERT INTO `qq3479015851_auth_group_access` VALUES ('1', '11');
INSERT INTO `qq3479015851_auth_group_access` VALUES ('2', '3');
INSERT INTO `qq3479015851_auth_group_access` VALUES ('3', '2');

-- ----------------------------
-- Table structure for `qq3479015851_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_auth_rule`;
CREATE TABLE `qq3479015851_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=2044 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_auth_rule
-- ----------------------------
INSERT INTO `qq3479015851_auth_rule` VALUES ('425', 'admin', '1', 'Admin/article/add', '新增', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('427', 'admin', '1', 'Admin/article/setStatus', '改变状态', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('428', 'admin', '1', 'Admin/article/update', '保存', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('429', 'admin', '1', 'Admin/article/autoSave', '保存草稿', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('430', 'admin', '1', 'Admin/article/move', '移动', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('432', 'admin', '2', 'Admin/Article/mydocument', '内容', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('437', 'admin', '1', 'Admin/Trade/config', '交易配置', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('449', 'admin', '1', 'Admin/Index/operate', '市场统计', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('455', 'admin', '1', 'Admin/Issue/config', '认购配置', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('457', 'admin', '1', 'Admin/Index/database/type/export', '数据备份', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('461', 'admin', '1', 'Admin/Article/chat', '聊天列表', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('464', 'admin', '1', 'Admin/Index/database/type/import', '数据还原', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('471', 'admin', '1', 'Admin/Mytx/config', '提现配置', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('472', 'admin', '2', 'Admin/Mytx/index', '提现', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('473', 'admin', '1', 'Admin/Config/market', '市场配置', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('477', 'admin', '1', 'Admin/User/myzr', '转入虚拟币', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('479', 'admin', '1', 'Admin/User/myzc', '转出虚拟币', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('482', 'admin', '2', 'Admin/ExtA/index', '扩展', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('488', 'admin', '1', 'Admin/Auth_manager/createGroup', '新增用户组', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('499', 'admin', '1', 'Admin/ExtA/index', '扩展管理', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('509', 'admin', '1', 'Admin/Article/adver_edit', '编辑', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('510', 'admin', '1', 'Admin/Article/adver_status', '修改', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('513', 'admin', '1', 'Admin/Issue/index_edit', '认购编辑', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('514', 'admin', '1', 'Admin/Issue/index_status', '认购修改', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('515', 'admin', '1', 'Admin/Article/chat_edit', '编辑', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('516', 'admin', '1', 'Admin/Article/chat_status', '修改', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('517', 'admin', '1', 'Admin/User/coin_edit', 'coin修改', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('519', 'admin', '1', 'Admin/Mycz/type_status', '状态修改', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('520', 'admin', '1', 'Admin/Issue/log_status', '认购状态', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('521', 'admin', '1', 'Admin/Issue/log_jiedong', '认购解冻', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('522', 'admin', '1', 'Admin/Tools/database/type/export', '数据备份', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('525', 'admin', '1', 'Admin/Config/coin_edit', '编辑', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('526', 'admin', '1', 'Admin/Config/coin_add', '编辑币种', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('527', 'admin', '1', 'Admin/Config/coin_status', '状态修改', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('528', 'admin', '1', 'Admin/Config/market_edit', '编辑', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('530', 'admin', '1', 'Admin/Tools/database/type/import', '数据还原', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('541', 'admin', '2', 'Admin/Trade/config', '交易', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('569', 'admin', '1', 'Admin/ADVERstatus', '修改', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('570', 'admin', '1', 'Admin/Tradelog/index', '交易记录', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('585', 'admin', '1', 'Admin/Config/mycz', '充值配置', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('590', 'admin', '1', 'Admin/Mycztype/index', '充值类型', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('600', 'admin', '1', 'Admin/Usergoods/index', '用户联系地址', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1379', 'admin', '1', 'Admin/Bazaar/index', '集市管理', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1405', 'admin', '1', 'Admin/Bazaar/config', '集市配置', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1425', 'admin', '1', 'Admin/Bazaar/log', '集市记录', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1451', 'admin', '1', 'Admin/Bazaar/invit', '集市推广', '-1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1846', 'admin', '1', 'Admin/AuthManager/createGroup', '新增用户组', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1847', 'admin', '1', 'Admin/AuthManager/editgroup', '编辑用户组', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1848', 'admin', '1', 'Admin/AuthManager/writeGroup', '更新用户组', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1849', 'admin', '1', 'Admin/AuthManager/changeStatus', '改变状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1850', 'admin', '1', 'Admin/AuthManager/access', '访问授权', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1851', 'admin', '1', 'Admin/AuthManager/category', '分类授权', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1852', 'admin', '1', 'Admin/AuthManager/user', '成员授权', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1853', 'admin', '1', 'Admin/AuthManager/tree', '成员列表授权', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1854', 'admin', '1', 'Admin/AuthManager/group', '用户组', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1855', 'admin', '1', 'Admin/AuthManager/addToGroup', '添加到用户组', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1856', 'admin', '1', 'Admin/AuthManager/removeFromGroup', '用户组移除', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1857', 'admin', '1', 'Admin/AuthManager/addToCategory', '分类添加到用户组', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1858', 'admin', '1', 'Admin/AuthManager/addToModel', '模型添加到用户组', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1859', 'admin', '1', 'Admin/Trade/status', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1860', 'admin', '1', 'Admin/Trade/chexiao', '撤销挂单', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1861', 'admin', '1', 'Admin/Shop/images', '图片', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1862', 'admin', '1', 'Admin/Login/index', '用户登录', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1863', 'admin', '1', 'Admin/Login/loginout', '用户退出', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1864', 'admin', '1', 'Admin/User/setpwd', '修改管理员密码', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1865', 'admin', '2', 'Admin/Index/index', '系统', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1866', 'admin', '2', 'Admin/Article/index', '内容', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1867', 'admin', '2', 'Admin/User/index', '用户', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1868', 'admin', '2', 'Admin/Finance/index', '财务', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1869', 'admin', '2', 'Admin/Trade/index', '交易', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1870', 'admin', '2', 'Admin/Game/index', '应用', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1871', 'admin', '2', 'Admin/Config/index', '设置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1872', 'admin', '2', 'Admin/Operate/index', '运营', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1873', 'admin', '2', 'Admin/Tools/index', '工具', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1874', 'admin', '2', 'Admin/Cloud/index', '扩展', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1875', 'admin', '1', 'Admin/Index/index', '系统概览', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1876', 'admin', '1', 'Admin/Article/index', '文章管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1877', 'admin', '1', 'Admin/Article/edit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1878', 'admin', '1', 'Admin/Text/index', '提示文字', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1879', 'admin', '1', 'Admin/Text/edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1880', 'admin', '1', 'Admin/Text/status', '修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1881', 'admin', '1', 'Admin/User/index', '用户管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1882', 'admin', '1', 'Admin/User/config', '用户配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1883', 'admin', '1', 'Admin/Finance/index', '财务明细', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1884', 'admin', '1', 'Admin/Finance/myczTypeEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1885', 'admin', '1', 'Admin/Finance/config', '配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1886', 'admin', '1', 'Admin/Tools/index', '清理缓存', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1887', 'admin', '1', 'Admin/Finance/type', '类型', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1888', 'admin', '1', 'Admin/Finance/type_status', '状态修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1889', 'admin', '1', 'Admin/User/edit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1890', 'admin', '1', 'Admin/User/status', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1891', 'admin', '1', 'Admin/User/adminEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1892', 'admin', '1', 'Admin/User/adminStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1893', 'admin', '1', 'Admin/User/authEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1894', 'admin', '1', 'Admin/User/authStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1895', 'admin', '1', 'Admin/User/authStart', '重新初始化权限', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1896', 'admin', '1', 'Admin/User/logEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1897', 'admin', '1', 'Admin/User/logStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1898', 'admin', '1', 'Admin/User/qianbaoEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1899', 'admin', '1', 'Admin/Trade/index', '委托管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1900', 'admin', '1', 'Admin/User/qianbaoStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1901', 'admin', '1', 'Admin/User/bankEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1902', 'admin', '1', 'Admin/User/bankStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1903', 'admin', '1', 'Admin/User/coinEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1904', 'admin', '1', 'Admin/User/coinLog', '财产统计', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1905', 'admin', '1', 'Admin/User/goodsEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1906', 'admin', '1', 'Admin/User/goodsStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1907', 'admin', '1', 'Admin/Article/typeEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1908', 'admin', '1', 'Admin/Article/linkEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1909', 'admin', '1', 'Admin/Config/index', '基本配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1910', 'admin', '1', 'Admin/Article/adverEdit', '编辑添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1911', 'admin', '1', 'Admin/User/authAccess', '访问授权', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1912', 'admin', '1', 'Admin/User/authAccessUp', '访问授权修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1913', 'admin', '1', 'Admin/User/authUser', '成员授权', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1914', 'admin', '1', 'Admin/User/authUserAdd', '成员授权增加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1915', 'admin', '1', 'Admin/User/authUserRemove', '成员授权解除', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1916', 'admin', '1', 'Admin/Operate/index', '推广奖励', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1917', 'admin', '1', 'Admin/App/config', 'APP配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1918', 'admin', '1', 'AdminUser/detail', '后台用户详情', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1919', 'admin', '1', 'AdminUser/status', '后台用户状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1920', 'admin', '1', 'AdminUser/add', '后台用户新增', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1921', 'admin', '1', 'AdminUser/edit', '后台用户编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1922', 'admin', '1', 'Admin/Articletype/edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1923', 'admin', '1', 'Admin/Shop/index', '商品管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1924', 'admin', '1', 'Admin/Huafei/index', '充值记录', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1925', 'admin', '1', 'Admin/Huafei/config', '充值配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1926', 'admin', '1', 'Admin/Vote/index', '投票记录', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1927', 'admin', '1', 'Admin/Vote/type', '投票类型', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1928', 'admin', '1', 'Admin/Money/index', '理财管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1929', 'admin', '1', 'Admin/Issue/index', '认购管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1930', 'admin', '1', 'Admin/Issue/log', '认购记录', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1931', 'admin', '1', 'Admin/Article/images', '上传图片', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1932', 'admin', '1', 'Admin/Adver/edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1933', 'admin', '1', 'Admin/Adver/status', '修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1934', 'admin', '1', 'Admin/Article/type', '文章类型', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1935', 'admin', '1', 'Admin/User/index_edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1936', 'admin', '1', 'Admin/User/index_status', '修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1937', 'admin', '1', 'Admin/Finance/mycz', '人民币充值', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1938', 'admin', '1', 'Admin/Finance/myczTypeStatus', '状态修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1939', 'admin', '1', 'Admin/Finance/myczTypeImage', '上传图片', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1940', 'admin', '1', 'Admin/Finance/mytxStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1941', 'admin', '1', 'Admin/Tools/dataExport', '备份数据库', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1942', 'admin', '1', 'Admin/Tools/dataImport', '还原数据库', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1943', 'admin', '1', 'Admin/User/admin', '管理员管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1944', 'admin', '1', 'Admin/Trade/log', '成交记录', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1945', 'admin', '1', 'Admin/Issue/edit', '认购编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1946', 'admin', '1', 'Admin/Issue/status', '认购修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1947', 'admin', '1', 'Admin/Config/moble', '短信配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1948', 'admin', '1', 'Admin/Invit/config', '推广配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1949', 'admin', '1', 'Admin/App/vip_config_list', 'APP等级', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1950', 'admin', '1', 'Admin/Link/edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1951', 'admin', '1', 'Admin/Link/status', '修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1952', 'admin', '1', 'Admin/Index/coin', '币种统计', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1953', 'admin', '1', 'Admin/Shop/config', '商城配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1954', 'admin', '1', 'Admin/Money/log', '理财日志', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1955', 'admin', '1', 'Admin/Index/market', '市场统计', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1956', 'admin', '1', 'Admin/Chat/edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1957', 'admin', '1', 'Admin/Chat/status', '修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1958', 'admin', '1', 'Admin/Article/adver', '广告管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1959', 'admin', '1', 'Admin/Trade/chat', '交易聊天', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1960', 'admin', '1', 'Admin/Finance/myczType', '人民币充值方式', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1961', 'admin', '1', 'Admin/Usercoin/edit', '财产修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1962', 'admin', '1', 'Admin/Finance/mytxExcel', '导出选中', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1963', 'admin', '1', 'Admin/User/auth', '权限列表', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1964', 'admin', '1', 'Admin/Mycz/status', '修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1965', 'admin', '1', 'Admin/Mycztype/status', '状态修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1966', 'admin', '1', 'Admin/Config/contact', '客服配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1967', 'admin', '1', 'Admin/App/adsblock_list', 'APP广告板块', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1968', 'admin', '1', 'Admin/Tools/queue', '服务器队列', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1969', 'admin', '1', 'Admin/Tools/qianbao', '钱包检查', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1970', 'admin', '1', 'Admin/Shop/type', '商品类型', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1971', 'admin', '1', 'Admin/Fenhong/index', '分红管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1972', 'admin', '1', 'Admin/Huafei/type', '充值金额', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1973', 'admin', '1', 'Admin/Money/fee', '理财明细', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1974', 'admin', '1', 'Admin/Article/link', '友情链接', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1975', 'admin', '1', 'Admin/User/log', '登陆日志', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1976', 'admin', '1', 'Admin/Finance/mytx', '人民币提现', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1977', 'admin', '1', 'Admin/Finance/mytxChuli', '正在处理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1978', 'admin', '1', 'Admin/Config/bank', '银行配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1979', 'admin', '1', 'Admin/Config/bank_edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1980', 'admin', '1', 'Admin/Coin/edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1981', 'admin', '1', 'Admin/Coin/status', '状态修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1982', 'admin', '1', 'Admin/Market/edit', '编辑市场', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1983', 'admin', '1', 'Admin/Config/market_add', '状态修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1984', 'admin', '1', 'Admin/Tools/invoke', '其他模块调用', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1985', 'admin', '1', 'Admin/Tools/optimize', '优化表', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1986', 'admin', '1', 'Admin/Tools/repair', '修复表', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1987', 'admin', '1', 'Admin/Tools/del', '删除备份文件', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1988', 'admin', '1', 'Admin/Tools/export', '备份数据库', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1989', 'admin', '1', 'Admin/Tools/import', '还原数据库', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1990', 'admin', '1', 'Admin/Tools/excel', '导出数据库', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1991', 'admin', '1', 'Admin/Tools/exportExcel', '导出Excel', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1992', 'admin', '1', 'Admin/Tools/importExecl', '导入Excel', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1993', 'admin', '1', 'Admin/Config/coin', '币种配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1994', 'admin', '1', 'Admin/User/detail', '用户详情', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1995', 'admin', '1', 'Admin/App/ads_user', 'APP广告用户', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1996', 'admin', '1', 'Admin/Cloud/theme', '主题模板', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1997', 'admin', '1', 'Admin/Shop/coin', '付款方式', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1998', 'admin', '1', 'Admin/Huafei/coin', '付款方式', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('1999', 'admin', '1', 'Admin/Trade/comment', '币种评论', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2000', 'admin', '1', 'Admin/User/qianbao', '用户钱包', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2001', 'admin', '1', 'Admin/Trade/market', '交易市场', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2002', 'admin', '1', 'Admin/Finance/mytxConfig', '人民币提现配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2003', 'admin', '1', 'Admin/Finance/mytxChexiao', '撤销提现', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2004', 'admin', '1', 'Admin/Mytx/status', '状态修改', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2005', 'admin', '1', 'Admin/Mytx/excel', '取消', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2006', 'admin', '1', 'Admin/Mytx/exportExcel', '导入excel', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2007', 'admin', '1', 'Admin/Menu/index', '菜单管理', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2008', 'admin', '1', 'Admin/Menu/sort', '排序', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2009', 'admin', '1', 'Admin/Menu/add', '添加', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2010', 'admin', '1', 'Admin/Menu/edit', '编辑', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2011', 'admin', '1', 'Admin/Cloud/kefu', '客服代码', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2012', 'admin', '1', 'Admin/Menu/del', '删除', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2013', 'admin', '1', 'Admin/Cloud/kefuUp', '使用', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2014', 'admin', '1', 'Admin/Menu/toogleHide', '是否隐藏', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2015', 'admin', '1', 'Admin/Menu/toogleDev', '是否开发', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2016', 'admin', '1', 'Admin/Menu/importFile', '导入文件', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2017', 'admin', '1', 'Admin/Menu/import', '导入', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2018', 'admin', '1', 'Admin/Config/text', '提示文字', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2019', 'admin', '1', 'Admin/Shop/log', '购物记录', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2020', 'admin', '1', 'Admin/Fenhong/log', '分红记录', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2021', 'admin', '1', 'Admin/User/bank', '提现地址', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2022', 'admin', '1', 'Admin/Trade/invit', '交易推荐', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2023', 'admin', '1', 'Admin/Finance/myzr', '虚拟币转入', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2024', 'admin', '1', 'Admin/Finance/mytxQueren', '确认提现', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2025', 'admin', '1', 'Admin/Finance/myzcQueren', '确认转出', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2026', 'admin', '1', 'Admin/Config/qita', '其他配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2027', 'admin', '1', 'Admin/Shop/goods', '收货地址', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2028', 'admin', '1', 'Admin/User/coin', '用户财产', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2029', 'admin', '1', 'Admin/Finance/myzc', '虚拟币转出', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2030', 'admin', '1', 'Admin/Verify/code', '图形验证码', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2031', 'admin', '1', 'Admin/Verify/mobile', '手机验证码', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2032', 'admin', '1', 'Admin/Verify/email', '邮件验证码', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2033', 'admin', '1', 'Admin/Config/daohang', '导航配置', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2034', 'admin', '1', 'Admin/User/goods', '联系地址', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2035', 'admin', '1', 'Admin/User/myzc_qr', '确认转出', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2036', 'admin', '1', 'Admin/Article/status', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2037', 'admin', '1', 'Admin/Finance/myczStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2038', 'admin', '1', 'Admin/Finance/myczQueren', '确认到账', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2039', 'admin', '1', 'Admin/Article/typeStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2040', 'admin', '1', 'Admin/Article/linkStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2041', 'admin', '1', 'Admin/Article/adverStatus', '修改状态', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2042', 'admin', '1', 'Admin/Article/adverImage', '上传图片', '1', '');
INSERT INTO `qq3479015851_auth_rule` VALUES ('2043', 'admin', '1', 'Admin/User/award', '中奖管理', '1', '');

-- ----------------------------
-- Table structure for `qq3479015851_bazaar`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_bazaar`;
CREATE TABLE `qq3479015851_bazaar` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `coin` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `deal` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `fee` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='集市交易表';

-- ----------------------------
-- Records of qq3479015851_bazaar
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_bazaar_config`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_bazaar_config`;
CREATE TABLE `qq3479015851_bazaar_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `market` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '市场名称',
  `price_min` decimal(20,8) unsigned NOT NULL COMMENT '最小交易价格',
  `price_max` decimal(20,8) unsigned NOT NULL COMMENT '最大交易价格',
  `num_mix` decimal(20,8) unsigned NOT NULL COMMENT '最小交易数量',
  `num_max` decimal(20,8) unsigned NOT NULL COMMENT '最大交易数量',
  `invit_coin` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '上家赠送币种',
  `invit_1` decimal(20,8) unsigned NOT NULL COMMENT '一代赠送比例',
  `invit_2` decimal(20,8) unsigned NOT NULL COMMENT '二代赠送比例',
  `invit_3` decimal(20,8) unsigned NOT NULL COMMENT '三代赠送比例',
  `fee` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '手续费',
  `default` tinyint(2) unsigned NOT NULL COMMENT '默认',
  `sort` int(11) unsigned NOT NULL COMMENT '排序',
  `addtime` int(11) unsigned NOT NULL COMMENT '添加时间',
  `endtime` int(11) unsigned NOT NULL COMMENT '编辑时间',
  `status` tinyint(2) unsigned NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `coinname` (`market`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of qq3479015851_bazaar_config
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_bazaar_invit`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_bazaar_invit`;
CREATE TABLE `qq3479015851_bazaar_invit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `invit` int(11) unsigned NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `fee` decimal(20,8) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of qq3479015851_bazaar_invit
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_bazaar_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_bazaar_log`;
CREATE TABLE `qq3479015851_bazaar_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `peerid` int(11) unsigned NOT NULL,
  `coin` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `fee` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`),
  KEY `peerid` (`peerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='集市交易记录表';

-- ----------------------------
-- Records of qq3479015851_bazaar_log
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_category`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_category`;
CREATE TABLE `qq3479015851_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(30) NOT NULL COMMENT '标志',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL COMMENT '详情页模板',
  `template_edit` varchar(100) NOT NULL COMMENT '编辑页模板',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '关联模型',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `reply_model` varchar(100) NOT NULL DEFAULT '',
  `extend` text NOT NULL COMMENT '扩展设置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='分类表';

-- ----------------------------
-- Records of qq3479015851_category
-- ----------------------------
INSERT INTO `qq3479015851_category` VALUES ('1', 'blog', '博客', '0', '0', '10', '', '', '', '', '', '', '', '2', '2,1', '0', '0', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');
INSERT INTO `qq3479015851_category` VALUES ('2', 'default_blog', '默认分类', '1', '1', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');

-- ----------------------------
-- Table structure for `qq3479015851_chat`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_chat`;
CREATE TABLE `qq3479015851_chat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文字聊天表';

-- ----------------------------
-- Records of qq3479015851_chat
-- ----------------------------
INSERT INTO `qq3479015851_chat` VALUES ('1', '7', 'qq123556', '给个', '0', '1498138403', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_coin`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_coin`;
CREATE TABLE `qq3479015851_coin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `fee_bili` varchar(50) NOT NULL,
  `endtime` int(11) unsigned NOT NULL COMMENT '',
  `addtime` int(11) unsigned NOT NULL,
  `status` int(4) unsigned NOT NULL,
  `fee_meitian` varchar(200) NOT NULL COMMENT '每天限制',
  `dj_zj` varchar(200) NOT NULL,
  `dj_dk` varchar(200) NOT NULL,
  `dj_yh` varchar(200) NOT NULL,
  `dj_mm` varchar(200) NOT NULL,
  `zr_zs` varchar(50) NOT NULL,
  `zr_jz` varchar(50) NOT NULL,
  `zr_dz` varchar(50) NOT NULL,
  `zr_sm` varchar(50) NOT NULL,
  `zc_sm` varchar(50) NOT NULL,
  `zc_fee` varchar(50) NOT NULL,
  `zc_user` varchar(50) NOT NULL,
  `zc_min` varchar(50) NOT NULL,
  `zc_max` varchar(50) NOT NULL,
  `zc_jz` varchar(50) NOT NULL,
  `zc_zd` varchar(50) NOT NULL,
  `js_yw` varchar(50) NOT NULL,
  `js_sm` text NOT NULL,
  `js_qb` varchar(50) NOT NULL,
  `js_ym` varchar(50) NOT NULL,
  `js_gw` varchar(50) NOT NULL,
  `js_lt` varchar(50) NOT NULL,
  `js_wk` varchar(50) NOT NULL,
  `cs_yf` varchar(50) NOT NULL,
  `cs_sf` varchar(50) NOT NULL,
  `cs_fb` varchar(50) NOT NULL,
  `cs_qk` varchar(50) NOT NULL,
  `cs_zl` varchar(50) NOT NULL,
  `cs_cl` varchar(50) NOT NULL,
  `cs_zm` varchar(50) NOT NULL,
  `cs_nd` varchar(50) NOT NULL,
  `cs_jl` varchar(50) NOT NULL,
  `cs_ts` varchar(50) NOT NULL,
  `cs_bz` varchar(50) NOT NULL,
  `tp_zs` varchar(50) NOT NULL,
  `tp_js` varchar(50) NOT NULL,
  `tp_yy` varchar(50) NOT NULL,
  `tp_qj` varchar(50) NOT NULL,
  `qq3479015851_coinaddress` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='币种配置表';

-- ----------------------------
-- Records of qq3479015851_coin
-- ----------------------------
INSERT INTO `qq3479015851_coin` VALUES ('1', 'cny', 'rmb', '人民币', 'cny.png', '0', '', '0', '0', '1', '', '182.254.134.191', '0', '0', '0', '0', '1', '0', '0', '0', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `qq3479015851_coin` VALUES ('2', 'ltc', 'rgb', '莱特币', '594ba4b2bf25e.png', '0', '0', '0', '0', '1', '', '', '', '', '', '0', '0', '1', '', '', '0', '', '0', '10000', '0', '10', 'LTC', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `qq3479015851_coin` VALUES ('3', 'btc', 'qbb', '比特币', '594bbc0866622.jpg', '0', '0', '0', '0', '1', '', '120.76.163.59', '38399', 'user', 'passwd', '0', '1', '1', '', '', '0', '', '0', '10000', '1', '10', 'bitcoin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for `qq3479015851_coin_comment`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_coin_comment`;
CREATE TABLE `qq3479015851_coin_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `cjz` int(11) unsigned NOT NULL,
  `tzy` int(11) unsigned NOT NULL,
  `xcd` int(11) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_coin_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_coin_json`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_coin_json`;
CREATE TABLE `qq3479015851_coin_json` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of qq3479015851_coin_json
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_config`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_config`;
CREATE TABLE `qq3479015851_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `footer_logo` varchar(200) NOT NULL COMMENT ' ',
  `huafei_zidong` varchar(200) NOT NULL COMMENT '名称',
  `kefu` varchar(200) NOT NULL,
  `huafei_openid` varchar(200) NOT NULL COMMENT '名称',
  `huafei_appkey` varchar(200) NOT NULL COMMENT '名称',
  `index_lejimum` varchar(200) NOT NULL COMMENT '设置',
  `login_verify` varchar(200) NOT NULL COMMENT '设置',
  `fee_meitian` varchar(200) NOT NULL COMMENT '设置',
  `top_name` varchar(200) NOT NULL COMMENT '设置',
  `web_name` varchar(200) NOT NULL,
  `web_title` varchar(200) NOT NULL,
  `web_logo` varchar(200) NOT NULL,
  `web_llogo_small` varchar(200) NOT NULL,
  `web_keywords` text NOT NULL,
  `web_description` text NOT NULL,
  `web_close` text NOT NULL,
  `web_close_cause` text NOT NULL,
  `web_icp` text NOT NULL,
  `web_cnzz` text NOT NULL,
  `web_ren` text NOT NULL,
  `web_reg` text NOT NULL,
  `market_mr` text NOT NULL,
  `xnb_mr` text NOT NULL,
  `rmb_mr` text NOT NULL,
  `web_waring` text NOT NULL,
  `qq_3479015851_issue_waring` text NOT NULL,
  `moble_type` text NOT NULL,
  `moble_url` text NOT NULL,
  `moble_user` text NOT NULL,
  `moble_pwd` text NOT NULL,
  `contact_moble` text NOT NULL,
  `contact_weibo` text NOT NULL,
  `contact_tqq` text NOT NULL,
  `contact_qq` text NOT NULL,
  `contact_qqun` text NOT NULL,
  `contact_weixin` text NOT NULL,
  `contact_weixin_img` text NOT NULL,
  `contact_app_img` text NOT NULL,
  `contact_email` text NOT NULL,
  `contact_alipay` text NOT NULL,
  `contact_alipay_img` text NOT NULL,
  `contact_bank` text NOT NULL,
  `user_truename` text NOT NULL,
  `user_moble` text NOT NULL,
  `user_alipay` text NOT NULL,
  `user_bank` text NOT NULL,
  `user_text_truename` text NOT NULL,
  `user_text_moble` text NOT NULL,
  `user_text_alipay` text NOT NULL,
  `user_text_bank` text NOT NULL,
  `user_text_log` text NOT NULL,
  `user_text_password` text NOT NULL,
  `user_text_paypassword` text NOT NULL,
  `mytx_min` text NOT NULL,
  `mytx_max` text NOT NULL,
  `mytx_bei` text NOT NULL,
  `mytx_coin` text NOT NULL,
  `mytx_fee` text NOT NULL,
  `trade_min` text NOT NULL,
  `trade_max` text NOT NULL,
  `trade_limit` text NOT NULL,
  `trade_text_log` text NOT NULL,
  `issue_ci` text NOT NULL,
  `issue_jian` text NOT NULL,
  `issue_min` text NOT NULL,
  `issue_max` text NOT NULL,
  `money_min` text NOT NULL,
  `money_max` text NOT NULL,
  `money_bei` text NOT NULL,
  `money_text_index` text NOT NULL,
  `money_text_log` text NOT NULL,
  `money_text_type` text NOT NULL,
  `invit_type` text NOT NULL,
  `invit_fee1` text NOT NULL,
  `invit_fee2` text NOT NULL,
  `invit_fee3` text NOT NULL,
  `invit_text_txt` text NOT NULL,
  `invit_text_log` text NOT NULL,
  `index_notice_1` text NOT NULL,
  `index_notice_11` text NOT NULL,
  `index_notice_2` text NOT NULL,
  `index_notice_22` text NOT NULL,
  `index_notice_3` text NOT NULL,
  `index_notice_33` text NOT NULL,
  `index_notice_4` text NOT NULL,
  `index_notice_44` text NOT NULL,
  `text_footer` text NOT NULL,
  `shop_text_index` text NOT NULL,
  `shop_text_log` text NOT NULL,
  `shop_text_addr` text NOT NULL,
  `shop_text_view` text NOT NULL,
  `huafei_text_index` text NOT NULL,
  `huafei_text_log` text NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  `shop_coin` varchar(200) NOT NULL COMMENT '计算方式',
  `shop_logo` varchar(200) NOT NULL COMMENT '商城LOGO',
  `shop_login` varchar(200) NOT NULL COMMENT '是否要登陆',
  `index_html` varchar(50) DEFAULT NULL,
  `trade_hangqing` varchar(50) DEFAULT NULL,
  `trade_moshi` varchar(50) DEFAULT NULL,
  `reg_award` varchar(10) DEFAULT NULL,
  `reg_award_coin` varchar(50) DEFAULT NULL,
  `reg_award_num` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统配置表';

-- ----------------------------
-- Records of qq3479015851_config
-- ----------------------------
INSERT INTO `qq3479015851_config` VALUES ('1', '594bac49e2702.png', '1', 'c', '', '', '1', '1', '', '您好，欢迎来到币创网网-专业数字资产交易平台', '聚币网官方', '聚币网官方', '594bac7c3808b.png', '594bac4796161.png', '聚币网官方', '聚币网官方是专业的虚拟货币交易网，数字资产交易平台，币创网专注虚拟货币分发和维持数字资产撮合数字虚拟货币交易为核心，构建安全便捷的虚拟数字货币交易平台.', '1', '升级中...', '粤ICP备16111021号-11', '', '100', '<div style=\"text-align:center;\">\r\n	<div style=\"text-align:left;\">\r\n		根椐人民银行等有关部委的相关规定，比特币等数字货币系特殊的虚拟商品，作为互联网上的商品买卖行为，普通民众在自担风险的前提下拥有参与的自由。数字货币行业目前存在很多不确定，不可控的风险因素（如预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），导致交易具有极高的风险。币创网网仅为数字货币等虚拟商品的爱好者提供一个自由的网上交换平台，对在币创网网平台交换的数字货币等虚拟商品的来源、价值，网站运营方不承担任何审查、担保、赔偿的法律责任。<br />\r\n<br />\r\n<br />\r\n<br />\r\n请您务必注意以下几点：<br />\r\n<br />\r\n<br />\r\n<br />\r\n1.警惕虚假宣传，不要听信任何币值会永远上涨的宣传，数字货币作为一种虚拟商品，具有极高的风险，很可能出现价值归零的情况。<br />\r\n<br />\r\n2.对于推广和运营方的市场承诺，需要谨慎判别，目前并没有相关法律能保证其兑现承诺，币创网网不会对任何数字货币进行背书和承诺。<br />\r\n<br />\r\n3.坚决拒绝多层次传销组织，在我国参与该类组织是违法行为，造成的一切后果自负，平台将配合相关执法部门的要求进行调查、取证。<br />\r\n<br />\r\n4.根据《中华人民共和国反洗钱法》等有关法律规定，严格禁止利用平台进行洗钱等违法犯罪活动，平台将配合相关执法部门的要求进行调查、取证。<br />\r\n<br />\r\n5.数字货币和数字积分等虚拟商品所对应的实物财产和持有者享有的权利存在因发行方等义务相关方破产，关闭或违法犯罪等其他经营风险导致无法兑现的风险。<br />\r\n<br />\r\n6.在币创网网注册参与交换的用户，应保证注册身份信息的真实、准确，保证拟交换的数字货币等虚拟商品的来源合法。因信息不真实造成的任何问题，平台概不负责。<br />\r\n<br />\r\n7.因国家法律，法规及政策性文件的制定和修改，导致数字货币等虚拟商品的交易被暂停或者禁止的，由此导致的全部损失由用户自行承担。<br />\r\n<br />\r\n8.请控制风险，不要投入超过您风险承受能力的资金，不要购买您所不了解的数字货币，数字积分等虚拟商品。<br />\r\n<br />\r\n	</div>\r\n	<div style=\"text-align:left;\">\r\n		<span style=\"color:#337FE5;\"></span> \r\n	</div>\r\n</div>\r\n<p>\r\n	<span style=\"font-size:10px;color:#E56600;\"></span> \r\n</p>', 'btc_cny', 'gsc', 'cny', '<p>\r\n	风险警告：根椐人民银行等有关部委的相关规定，比特币等数字货币系特殊的虚拟商品，作为互联网上的商品买卖行为，普通民众在自担风险的前提下拥有参与的自由。数字货币行业目前存在很多不确定，不可控的风险因素（如预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），导致交易具有极高的风险。币创网网仅为数字货币等虚拟商品的爱好者提供一个自由的网上交换平台，对在币创网网平台交换的数字货币等虚拟商品的来源、价值，网站运营方不承担任何审查、担保、赔偿的法律责任，如果您不能接受，请不要进行交易！\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '新认购风险提示不投入超过风险承受能力的资金，不投资不了解的数字资产，不听信任何以币创网名义推荐买币投资的宣传，坚决抵制传销、电信诈骗和洗钱套汇等违法行为。', '1', '', '', '', '4006551686', 'http://weibo.com/qq3479015851', '', '5888888', '3479015851', 'QQ3479015851', '59282b1874c15.png', '59282b1ab71cd.png', '83839140@qq.com', '83839140@qq.com', '56f98e6d7245d.jpg', '中国银行|动说科技|0000 0000 0000 0000', '2', '2', '2', '2', '&lt;span&gt;&lt;span&gt;会员您好,务必正确填写好自己的真实姓名和真实身份证号码.&lt;/span&gt;&lt;/span&gt;', '&lt;span&gt;会员您好,务必用自己的手机号码进行手机认证,认证以后可以用来接收验证码.&lt;/span&gt;', '&lt;span&gt;会员您好,务必正确填写支付宝 &amp;nbsp;真实姓名（与实名认证姓名相同）和支付宝账号,后期提现唯一依据.&lt;/span&gt;', '&lt;span&gt;会员您好,&lt;/span&gt;&lt;span&gt;&lt;span&gt;务必正确填写银行卡信息 提现唯一依据.&lt;/span&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;', '&lt;span&gt;自己以往操作和登录及登录地点的相关记录.&lt;/span&gt;', '&lt;span&gt;会员您好,修改登录密码以后请不要忘记.若不记得旧登录密码,请点击--&lt;/span&gt;&lt;span style=&quot;color:#EE33EE;&quot;&gt;忘记密码&lt;/span&gt;', '&lt;span&gt;会员您好,修改交易密码以后请不要忘记.若不记得旧交易密码,请点击--&lt;/span&gt;&lt;span style=&quot;color:#EE33EE;&quot;&gt;忘记密码&lt;/span&gt;', '100', '50000', '100', 'cny', '1', '1', '10000000', '10', '&lt;span&gt;&lt;span&gt;你委托买入或者卖出成功交易后的记录.&lt;/span&gt;&lt;/span&gt;', '5', '24', '1', '100000', '100', '100000', '100', '理财首页', '理财记录', '理财类型', '1', '5', '3', '2', '中国人自己的币创币', '&lt;span&gt;&lt;span&gt;查看自己推广的好友,请点击&lt;/span&gt;&lt;span style=&quot;color:#EE33EE;&quot;&gt;“+”&lt;/span&gt;&lt;span&gt;,同时正确引导好友实名认证以及买卖,赚取推广收益和交易手续费.&lt;/span&gt;&lt;/span&gt;', '系统可靠', '银行级用户数据加密、动态身份验证多级风险识别控制，保障交易安全', '系统可靠', '账户多层加密，分布式服务器离线存储，即时隔离备份数据，确保安全', '快捷方便', '充值即时、提现迅速，每秒万单的高性能交易引擎，保证一切快捷方便', '服务专业', '热忱的客服工作人员和24小时的技术团队随时为您的账户安全保驾护航', '&lt;p&gt;\r\n	&lt;a href=&quot;/Article/index/type/aboutus.html&quot; target=&quot;_blank&quot;&gt;/Article/index/type/aboutus.html&lt;/a&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;lt;a href=&quot;&lt;a href=&quot;/Article/index/type/aboutus.html&quot; target=&quot;_blank&quot;&gt;/Article/index/type/aboutus.html&lt;/a&gt;&quot;&amp;gt;关于我们&amp;lt;/a&amp;gt;\r\n&lt;/p&gt;\r\n|&lt;br /&gt;\r\n&amp;lt;a href=&quot;/Article/index/type/aboutus.html&quot;&amp;gt;联系我们&amp;lt;/a&amp;gt;&lt;br /&gt;\r\n|&lt;br /&gt;\r\n&amp;lt;a href=&quot;/Article/index/type/aboutus.html&quot;&amp;gt;资质证明&amp;lt;/a&amp;gt;&lt;br /&gt;\r\n|&lt;br /&gt;\r\n&amp;lt;a href=&quot;/Article/index/type/aboutus.html&quot;&amp;gt;用户协议&amp;lt;/a&amp;gt;&lt;br /&gt;\r\n|&lt;br /&gt;\r\n&amp;lt;a href=&quot;/Article/index/type/aboutus.html&quot;&amp;gt;法律声明&amp;lt;/a&amp;gt;&lt;br /&gt;\r\n&amp;lt;p style=&quot;margin-top: 5px;text-align: center;&quot;&amp;gt;&lt;br /&gt;\r\nCopyright &amp;copy; 2016&lt;br /&gt;\r\n&amp;lt;a href=&quot;/&quot;&amp;gt;{$C[\'web_name\']}交易平台 &amp;lt;/a&amp;gt;&lt;br /&gt;\r\nAll Rights Reserved.&lt;br /&gt;\r\n&amp;lt;a href=&quot;http://www.miibeian.gov.cn/&quot;&amp;gt;{$C[\'web_icp\']}&amp;lt;/a&amp;gt;{$C[\'web_cnzz\']|htmlspecialchars_decode}&lt;br /&gt;\r\n&lt;br /&gt;\r\n&amp;lt;/p&amp;gt;&lt;br /&gt;\r\n&amp;lt;p class=&quot;clear1&quot; id=&quot;ut646&quot; style=&quot;margin-top: 10px;text-align: center;&quot;&amp;gt;&lt;br /&gt;\r\n&amp;lt;a href=&quot;http://webscan.360.cn/index/checkwebsite/url/www.zuocoin.com&quot; target=&quot;_blank&quot;&amp;gt;&amp;lt;img border=&quot;0&quot; width=&quot;83&quot; height=&quot;31&quot; src=&quot;http://img.webscan.360.cn/status/pai/hash/a272bae5f02b1df25be2c1d9d0b251f7&quot;/&amp;gt;&amp;lt;/a&amp;gt;&lt;br /&gt;\r\n&amp;lt;a href=&quot;http://www.szfw.org/&quot; target=&quot;_blank&quot; id=&quot;ut118&quot; class=&quot;margin10&quot;&amp;gt;&lt;br /&gt;\r\n&amp;lt;img src=&quot;__UPLOAD__/footer/footer_2.png&quot;&amp;gt;&lt;br /&gt;\r\n&amp;lt;/a&amp;gt;&lt;br /&gt;\r\n&amp;lt;a href=&quot;http://www.miibeian.gov.cn/&quot; target=&quot;_blank&quot; id=&quot;ut119&quot; class=&quot;margin10&quot;&amp;gt;&lt;br /&gt;\r\n&amp;lt;img src=&quot;__UPLOAD__/footer/footer_3.png&quot;&amp;gt;&lt;br /&gt;\r\n&amp;lt;/a&amp;gt;&lt;br /&gt;\r\n&amp;lt;a href=&quot;http://www.cyberpolice.cn/&quot; target=&quot;_blank&quot; id=&quot;ut120&quot; class=&quot;margin10&quot;&amp;gt;&lt;br /&gt;\r\n&amp;lt;img src=&quot;__UPLOAD__/footer/footer_4.png&quot;&amp;gt;&lt;br /&gt;\r\n&amp;lt;/a&amp;gt;&lt;br /&gt;\r\n&amp;lt;/p&amp;gt;&lt;br /&gt;', '', '', '', '', '', '', '1467383018', '0', '', '/Upload/shop/591d36d289371.png', '0', 'b', '1', '1', '1', 'gsc', '10');

-- ----------------------------
-- Table structure for `qq3479015851_daohang`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_daohang`;
CREATE TABLE `qq3479015851_daohang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `title` varchar(255) NOT NULL COMMENT '名称',
  `url` varchar(255) NOT NULL COMMENT 'url',
  `sort` int(11) unsigned NOT NULL COMMENT '排序',
  `addtime` int(11) unsigned NOT NULL COMMENT '添加时间',
  `endtime` int(11) unsigned NOT NULL COMMENT '编辑时间',
  `status` tinyint(4) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_daohang
-- ----------------------------
INSERT INTO `qq3479015851_daohang` VALUES ('1', 'finance', '财务中心', 'Finance/index', '1', '0', '0', '1');
INSERT INTO `qq3479015851_daohang` VALUES ('2', 'user', '安全中心', 'User/index', '2', '0', '0', '1');
INSERT INTO `qq3479015851_daohang` VALUES ('3', 'Issue', '应用中心', 'Issue/index', '3', '0', '0', '0');
INSERT INTO `qq3479015851_daohang` VALUES ('4', 'article', '公告中心', 'Article/index', '7', '0', '0', '1');
INSERT INTO `qq3479015851_daohang` VALUES ('6', 'shop', '购物中心', 'Shop/index', '5', '0', '0', '1');
INSERT INTO `qq3479015851_daohang` VALUES ('7', 'vote', '新币投票', 'Vote/index', '6', '0', '0', '1');
INSERT INTO `qq3479015851_daohang` VALUES ('8', 'Issue', '认购中心', 'Issue/index', '4', '1474183878', '0', '1');
INSERT INTO `qq3479015851_daohang` VALUES ('9', '推广返佣', '推广返佣', 'promote/index.html', '4', '1480423054', '0', '-1');
INSERT INTO `qq3479015851_daohang` VALUES ('10', 'article', '公告中心', 'Article/index', '0', '1480823236', '0', '-1');
INSERT INTO `qq3479015851_daohang` VALUES ('11', 'THC夺宝岛', 'THC夺宝岛', 'Duobao\\index.html', '5', '1481470482', '0', '-1');
INSERT INTO `qq3479015851_daohang` VALUES ('12', '欢乐抽奖', '欢乐抽奖', 'award/index.html', '5', '1482891983', '0', '-1');

-- ----------------------------
-- Table structure for `qq3479015851_fenhong`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_fenhong`;
CREATE TABLE `qq3479015851_fenhong` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `coinjian` varchar(50) NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_fenhong
-- ----------------------------
INSERT INTO `qq3479015851_fenhong` VALUES ('1', 'ltc', 'cny', 'cny', '1.00000000', '1', '1498060800', '1498665600', '0');

-- ----------------------------
-- Table structure for `qq3479015851_fenhong_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_fenhong_log`;
CREATE TABLE `qq3479015851_fenhong_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `coinjian` varchar(50) NOT NULL,
  `fenzong` varchar(50) NOT NULL,
  `fenchi` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `userid` int(11) unsigned NOT NULL COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_fenhong_log
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_finance`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_finance`;
CREATE TABLE `qq3479015851_finance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) unsigned NOT NULL COMMENT '用户id',
  `coinname` varchar(50) NOT NULL COMMENT '币种',
  `num_a` decimal(20,8) unsigned NOT NULL COMMENT '之前正常',
  `num_b` decimal(20,8) unsigned NOT NULL COMMENT '之前冻结',
  `num` decimal(20,8) unsigned NOT NULL COMMENT '之前总计',
  `fee` decimal(20,8) unsigned NOT NULL COMMENT '操作数量',
  `type` varchar(50) NOT NULL COMMENT '操作类型',
  `name` varchar(50) NOT NULL COMMENT '操作名称',
  `nameid` int(11) NOT NULL COMMENT '操作详细',
  `remark` varchar(50) NOT NULL COMMENT '操作备注',
  `mum_a` decimal(20,8) unsigned NOT NULL COMMENT '剩余正常',
  `mum_b` decimal(20,8) unsigned NOT NULL COMMENT '剩余冻结',
  `mum` decimal(20,8) unsigned NOT NULL COMMENT '剩余总计',
  `move` varchar(50) NOT NULL COMMENT '附加',
  `addtime` int(11) unsigned NOT NULL COMMENT '添加时间',
  `status` tinyint(4) unsigned NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `coinname` (`coinname`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='财务记录表';

-- ----------------------------
-- Records of qq3479015851_finance
-- ----------------------------
INSERT INTO `qq3479015851_finance` VALUES ('1', '1', 'cny', '0.00000000', '0.00000000', '0.00000000', '100.00000000', '1', 'mycz', '1', '人民币充值-人工到账', '100.00000000', '0.00000000', '100.00000000', 'a51bb2bbd29f3479ecfe39767d939794', '1497986977', '1');
INSERT INTO `qq3479015851_finance` VALUES ('2', '1', 'cny', '100.00000000', '0.00000000', '100.00000000', '10000.00000000', '1', 'mycz', '2', '人民币充值-人工到账', '10100.00000000', '0.00000000', '10100.00000000', '382320468ba1dcb4a033fb398c832aa7', '1497987033', '1');
INSERT INTO `qq3479015851_finance` VALUES ('3', '1', 'cny', '10100.00000000', '0.00000000', '10100.00000000', '1008.71730000', '2', 'trade', '38', '交易中心-委托买入-市场ltc_cny', '9091.28270000', '1008.71730000', '10100.00000000', '611883e01aea79077e0cca650c24bbf0', '1498133378', '1');
INSERT INTO `qq3479015851_finance` VALUES ('4', '1', 'cny', '9091.28270000', '1008.71730000', '10100.00000000', '909.69060000', '2', 'trade', '40', '交易中心-委托买入-市场ltc_cny', '8181.59210000', '1918.40790000', '10100.00000000', '73d145af6abba5562b06c92bc591581e', '1498133416', '1');
INSERT INTO `qq3479015851_finance` VALUES ('5', '3', 'cny', '10000.00000000', '0.00000000', '10000.00000000', '333.24500000', '2', 'trade', '59', '交易中心-委托买入-市场ltc_cny', '9666.75500000', '333.24500000', '10000.00000000', '8d5fb97454b62883503b1f0b0d2eae19', '1498135127', '0');
INSERT INTO `qq3479015851_finance` VALUES ('6', '7', 'cny', '0.00000000', '0.00000000', '0.00000000', '100.00000000', '1', 'mycz', '5', '人民币充值-人工到账', '100.00000000', '0.00000000', '100.00000000', '51b9d6fb9a2cc3173aca68d2ec957cd8', '1498137624', '1');
INSERT INTO `qq3479015851_finance` VALUES ('7', '7', 'cny', '100.00000000', '0.00000000', '100.00000000', '200.00000000', '1', 'mycz', '6', '人民币充值-人工到账', '300.00000000', '0.00000000', '300.00000000', 'd672f0bf451e40c72a1f83978a03b1f6', '1498137629', '1');
INSERT INTO `qq3479015851_finance` VALUES ('8', '7', 'cny', '300.00000000', '0.00000000', '300.00000000', '1.00000000', '2', 'trade', '91', '交易中心-委托买入-市场ltc_cny', '299.00000000', '1.00000000', '300.00000000', 'b3779e30d9dd7d870f1b3e4c3c28264b', '1498137901', '1');
INSERT INTO `qq3479015851_finance` VALUES ('9', '7', 'cny', '299.00000000', '1.00000000', '300.00000000', '1.00000000', '1', 'trade', '91', '交易中心-交易撤销ltc_cny', '300.00000000', '0.00000000', '300.00000000', '50c54ca8a924f1fbdef0c8cdebc42723', '1498137934', '1');
INSERT INTO `qq3479015851_finance` VALUES ('10', '7', 'cny', '300.00000000', '0.00000000', '300.00000000', '33.37570000', '2', 'trade', '92', '交易中心-委托买入-市场ltc_cny', '266.62430000', '33.37570000', '300.00000000', 'afca85e7decfaf26e42de7b02a2001e6', '1498137959', '1');
INSERT INTO `qq3479015851_finance` VALUES ('11', '7', 'cny', '266.62430000', '33.37570000', '300.00000000', '4.00000000', '2', 'trade', '94', '交易中心-委托买入-市场ltc_cny', '262.62430000', '37.37570000', '300.00000000', 'b853422322a52605eae7de5d6aa48279', '1498137984', '1');
INSERT INTO `qq3479015851_finance` VALUES ('12', '7', 'cny', '262.62430000', '37.37570000', '300.00000000', '100.12710000', '2', 'trade', '96', '交易中心-委托买入-市场ltc_cny', '162.49720000', '137.50280000', '300.00000000', 'e8479b74109fe507a87028fe0eaa0db4', '1498138101', '1');
INSERT INTO `qq3479015851_finance` VALUES ('13', '7', 'cny', '161.49720000', '137.50280000', '299.00000000', '33.70945700', '1', 'trade', '92', '交易中心-交易撤销ltc_cny', '195.20665700', '103.79334300', '299.00000000', '8521c2d1d23d36bd70074b9b47107fbe', '1498138660', '1');
INSERT INTO `qq3479015851_finance` VALUES ('14', '7', 'cny', '195.20665700', '103.79334300', '299.00000000', '4.04000000', '1', 'trade', '94', '交易中心-交易撤销ltc_cny', '199.24665700', '99.75334300', '299.00000000', '9049e444303a777de497fc6e69254495', '1498138664', '1');
INSERT INTO `qq3479015851_finance` VALUES ('15', '7', 'cny', '199.24665700', '99.75334300', '299.00000000', '1.20000000', '2', 'trade', '104', '交易中心-委托买入-市场ltc_cny', '198.04665700', '100.95334300', '299.00000000', '85c905f8bc6d118d1d7b291a7bf7a08c', '1498138741', '1');
INSERT INTO `qq3479015851_finance` VALUES ('16', '7', 'cny', '198.04665700', '100.95334300', '299.00000000', '0.20200000', '1', 'trade', '104', '交易中心-交易撤销ltc_cny', '198.24865700', '100.75134300', '299.00000000', '9f5020b770983260c33bc72f2b1b5ed1', '1498138755', '1');
INSERT INTO `qq3479015851_finance` VALUES ('17', '7', 'cny', '198.24865700', '0.00000000', '198.24865700', '67.54600000', '2', 'trade', '105', '交易中心-委托买入-市场ltc_cny', '130.70265700', '67.54600000', '198.24865700', 'b1fe301aaefd76a30e7cc50b94bf46f6', '1498138800', '0');
INSERT INTO `qq3479015851_finance` VALUES ('18', '7', 'cny', '130.70265700', '67.54600000', '198.24865700', '100.81900000', '2', 'trade', '107', '交易中心-委托买入-市场ltc_cny', '29.88365700', '168.36500000', '198.24865700', '27f5705a4733e9bf88e738fa3b567842', '1498138810', '1');
INSERT INTO `qq3479015851_finance` VALUES ('19', '7', 'cny', '29.88365700', '168.36500000', '198.24865700', '100.81719000', '1', 'trade', '107', '交易中心-交易撤销ltc_cny', '130.70084700', '67.54781000', '198.24865700', '53391b6647fa50640f7933789147ff09', '1498138828', '1');
INSERT INTO `qq3479015851_finance` VALUES ('20', '7', 'cny', '130.70084700', '67.54781000', '198.24865700', '67.21146000', '1', 'trade', '105', '交易中心-交易撤销ltc_cny', '197.91230700', '0.33635000', '198.24865700', '8384ebaec2201aa2661ade7d3d12e175', '1498138831', '1');
INSERT INTO `qq3479015851_finance` VALUES ('21', '7', 'cny', '197.91230700', '0.00000000', '197.91230700', '134.42292000', '2', 'trade', '108', '交易中心-委托买入-市场ltc_cny', '63.48938700', '134.42292000', '197.91230700', '3f60244d4a1f9b04757dd8471a024820', '1498138878', '1');
INSERT INTO `qq3479015851_finance` VALUES ('22', '7', 'cny', '63.48938700', '134.42292000', '197.91230700', '134.42292000', '1', 'trade', '108', '交易中心-交易撤销ltc_cny', '197.91230700', '0.00000000', '197.91230700', '2cfc0f8b213bd351da2f62b3b83da96a', '1498138958', '1');
INSERT INTO `qq3479015851_finance` VALUES ('23', '7', 'cny', '197.91230700', '0.00000000', '197.91230700', '34.29050000', '2', 'trade', '110', '交易中心-委托买入-市场ltc_cny', '163.62180700', '34.29050000', '197.91230700', 'b31112d7eced17144d2533581aa5569f', '1498138982', '1');
INSERT INTO `qq3479015851_finance` VALUES ('24', '7', 'cny', '163.62180700', '34.29050000', '197.91230700', '67.58100000', '2', 'trade', '112', '交易中心-委托买入-市场ltc_cny', '96.04080700', '101.87150000', '197.91230700', 'ff83ee6ee23e6ce4cc3dcee6e96f3f09', '1498138990', '1');
INSERT INTO `qq3479015851_finance` VALUES ('25', '7', 'cny', '96.04080700', '101.87150000', '197.91230700', '33.62340500', '1', 'trade', '110', '交易中心-交易撤销ltc_cny', '129.66421200', '68.24809500', '197.91230700', '884c37c0f879b466eb5044bd46e4aec1', '1498139017', '1');
INSERT INTO `qq3479015851_finance` VALUES ('26', '7', 'cny', '129.66421200', '68.24809500', '197.91230700', '67.24681000', '1', 'trade', '112', '交易中心-交易撤销ltc_cny', '196.91102200', '1.00128500', '197.91230700', '2ab2bfd54df32a16c72c77a6cb8b63e4', '1498139018', '1');
INSERT INTO `qq3479015851_finance` VALUES ('27', '7', 'cny', '196.91102200', '0.00000000', '196.91102200', '34.29050000', '2', 'trade', '113', '交易中心-委托买入-市场ltc_cny', '162.62052200', '34.29050000', '196.91102200', '0086760749e49632a0052a4c9dd7e3ab', '1498139072', '0');
INSERT INTO `qq3479015851_finance` VALUES ('28', '7', 'cny', '162.62052200', '34.29050000', '196.91102200', '67.58100000', '2', 'trade', '114', '交易中心-委托买入-市场ltc_cny', '95.03952200', '101.87150000', '196.91102200', '31675ddad399786ab1bfbf35b8dea50a', '1498139077', '1');
INSERT INTO `qq3479015851_finance` VALUES ('29', '7', 'cny', '95.03952200', '101.87150000', '196.91102200', '33.62340500', '1', 'trade', '113', '交易中心-交易撤销ltc_cny', '128.66292700', '68.24809500', '196.91102200', '0da1f25ea6882f8c8cf90a9c104c0cdf', '1498139084', '1');
INSERT INTO `qq3479015851_finance` VALUES ('30', '7', 'cny', '128.66292700', '68.24809500', '196.91102200', '67.24681000', '1', 'trade', '114', '交易中心-交易撤销ltc_cny', '195.90973700', '1.00128500', '196.91102200', '0232c0d021bc3e377235a0df17225157', '1498139087', '1');
INSERT INTO `qq3479015851_finance` VALUES ('31', '7', 'cny', '195.90973700', '0.00000000', '195.90973700', '34.29050000', '2', 'trade', '116', '交易中心-委托买入-市场ltc_cny', '161.61923700', '34.29050000', '195.90973700', '8092315de8137c7fc4c2f6fe93a3646d', '1498139110', '0');
INSERT INTO `qq3479015851_finance` VALUES ('32', '7', 'cny', '161.61923700', '34.29050000', '195.90973700', '67.58100000', '2', 'trade', '117', '交易中心-委托买入-市场ltc_cny', '94.03823700', '101.87150000', '195.90973700', '3fb873bd4e852442b0b289451736866c', '1498139119', '1');
INSERT INTO `qq3479015851_finance` VALUES ('33', '7', 'cny', '94.03823700', '101.87150000', '195.90973700', '33.62340500', '1', 'trade', '116', '交易中心-交易撤销ltc_cny', '127.66164200', '68.24809500', '195.90973700', 'c9e6c65b590a681ed95fce9e4026cd34', '1498139132', '1');
INSERT INTO `qq3479015851_finance` VALUES ('34', '7', 'cny', '127.66164200', '68.24809500', '195.90973700', '67.24681000', '1', 'trade', '117', '交易中心-交易撤销ltc_cny', '194.90845200', '1.00128500', '195.90973700', '692fd168b0c2da0de3b11262f8704bbc', '1498139136', '1');
INSERT INTO `qq3479015851_finance` VALUES ('35', '7', 'cny', '194.90845200', '0.00000000', '194.90845200', '1.00000000', '2', 'issue', '1', '认购中心-立即认购', '193.90845200', '0.00000000', '193.90845200', '30242d099768d9ff3f7d8c59d7dfe238', '1498139383', '0');
INSERT INTO `qq3479015851_finance` VALUES ('36', '3', 'cny', '1000000.00000000', '333.24500000', '1000333.24500000', '2.00000000', '2', 'trade', '122', '交易中心-委托买入-市场btc_cny', '999998.00000000', '335.24500000', '1000333.24500000', '129d3d96c3ada17ac505c19bd7cbaf49', '1498139436', '0');
INSERT INTO `qq3479015851_finance` VALUES ('37', '7', 'cny', '193.90845200', '0.00000000', '193.90845200', '34.32450000', '2', 'trade', '123', '交易中心-委托买入-市场ltc_cny', '159.58395200', '34.32450000', '193.90845200', 'ecf0f60b1baeeacfb4b656e4bcc1c41d', '1498139436', '1');
INSERT INTO `qq3479015851_finance` VALUES ('38', '7', 'cny', '159.58395200', '34.32450000', '193.90845200', '34.32450000', '2', 'tradelog', '51', '交易中心-成功买入-市场ltc_cny', '159.58395200', '0.00000000', '159.58395200', '8321f0f195d37cc768d4045877b251fb', '1498139436', '1');
INSERT INTO `qq3479015851_finance` VALUES ('39', '7', 'cny', '159.58395200', '0.00000000', '159.58395200', '34.32450000', '1', 'tradelog', '51', '交易中心-成功卖出-市场ltc_cny', '191.90845200', '0.00000000', '191.90845200', '6ef960ba7f6131560de842fb8a257ff7', '1498139436', '1');
INSERT INTO `qq3479015851_finance` VALUES ('40', '7', 'cny', '191.90845200', '0.00000000', '191.90845200', '34.38880000', '2', 'trade', '126', '交易中心-委托买入-市场ltc_cny', '157.51965200', '34.38880000', '191.90845200', '3fce4a94e4ac6ac49ece585794a4eb0a', '1498139523', '1');
INSERT INTO `qq3479015851_finance` VALUES ('41', '7', 'cny', '157.51965200', '34.38880000', '191.90845200', '34.38880000', '2', 'tradelog', '52', '交易中心-成功买入-市场ltc_cny', '157.51965200', '0.00000000', '157.51965200', 'b0b2651d4d1226e639b20cbd5a3d8743', '1498139523', '1');
INSERT INTO `qq3479015851_finance` VALUES ('42', '7', 'cny', '157.51965200', '0.00000000', '157.51965200', '34.38880000', '1', 'tradelog', '52', '交易中心-成功卖出-市场ltc_cny', '189.90845200', '0.00000000', '189.90845200', '02080ac7c4fb52fa072b3c915b385eda', '1498139523', '1');
INSERT INTO `qq3479015851_finance` VALUES ('43', '3', 'cny', '999998.00000000', '335.24500000', '1000333.24500000', '9090.00000000', '2', 'trade', '132', '交易中心-委托买入-市场btc_cny', '990908.00000000', '9425.24500000', '1000333.24500000', '5ed78672760e7c1227c92aac8c36c35f', '1498139755', '1');
INSERT INTO `qq3479015851_finance` VALUES ('44', '3', 'cny', '990908.00000000', '9425.24500000', '1000333.24500000', '8080.00000000', '2', 'tradelog', '54', '交易中心-成功买入-市场btc_cny', '990908.00000000', '1345.24500000', '992253.24500000', '16b3cc5f6f680c14926552f18bdb2d5b', '1498139756', '1');
INSERT INTO `qq3479015851_finance` VALUES ('45', '3', 'cny', '990908.00000000', '1345.24500000', '992253.24500000', '8080.00000000', '1', 'tradelog', '54', '交易中心-成功卖出-市场btc_cny', '998828.00000000', '1345.24500000', '1000173.24500000', 'd1110db6f17b45f311ee187c1c802f21', '1498139756', '1');
INSERT INTO `qq3479015851_finance` VALUES ('46', '3', 'cny', '999838.00000000', '335.24500000', '1000173.24500000', '4040.00000000', '2', 'trade', '135', '交易中心-委托买入-市场btc_cny', '995798.00000000', '4375.24500000', '1000173.24500000', '81fac53f987d15f41db7bcfbb86f7236', '1498139814', '1');
INSERT INTO `qq3479015851_finance` VALUES ('47', '3', 'cny', '995798.00000000', '4375.24500000', '1000173.24500000', '2020.00000000', '2', 'tradelog', '56', '交易中心-成功买入-市场btc_cny', '995798.00000000', '2355.24500000', '998153.24500000', 'feacb12b2fe40c394eeed89cba015bb8', '1498139815', '1');
INSERT INTO `qq3479015851_finance` VALUES ('48', '3', 'cny', '995798.00000000', '2355.24500000', '998153.24500000', '2020.00000000', '1', 'tradelog', '56', '交易中心-成功卖出-市场btc_cny', '997778.00000000', '2355.24500000', '1000133.24500000', '7e22d72648d233d9b99342998eac3971', '1498139815', '1');
INSERT INTO `qq3479015851_finance` VALUES ('49', '3', 'cny', '999798.00000000', '335.24500000', '1000133.24500000', '5050.00000000', '2', 'trade', '136', '交易中心-委托买入-市场btc_cny', '994748.00000000', '5385.24500000', '1000133.24500000', 'e62ad0bfa3db19b51dd5ee4abf6c07b4', '1498139846', '1');
INSERT INTO `qq3479015851_finance` VALUES ('50', '3', 'cny', '994748.00000000', '5385.24500000', '1000133.24500000', '7070.00000000', '2', 'trade', '137', '交易中心-委托买入-市场btc_cny', '987678.00000000', '12455.24500000', '1000133.24500000', '3bf5e095378360b395c75046ccb57b1e', '1498139870', '1');
INSERT INTO `qq3479015851_finance` VALUES ('51', '3', 'cny', '987678.00000000', '12455.24500000', '1000133.24500000', '7070.00000000', '2', 'tradelog', '58', '交易中心-成功买入-市场btc_cny', '987678.00000000', '5385.24500000', '993063.24500000', '2c834b58152f7951755b9d47187d8ceb', '1498139916', '1');
INSERT INTO `qq3479015851_finance` VALUES ('52', '3', 'cny', '987678.00000000', '5385.24500000', '993063.24500000', '7070.00000000', '1', 'tradelog', '58', '交易中心-成功卖出-市场btc_cny', '994608.00000000', '5385.24500000', '999993.24500000', '83000de0780f95936db2e6a32bd19557', '1498139916', '1');
INSERT INTO `qq3479015851_finance` VALUES ('53', '3', 'cny', '994608.00000000', '5385.24500000', '999993.24500000', '1010.00000000', '2', 'tradelog', '59', '交易中心-成功买入-市场btc_cny', '994608.00000000', '4375.24500000', '998983.24500000', '2231efe0d934ad16050a4e4b984cda7e', '1498139916', '1');
INSERT INTO `qq3479015851_finance` VALUES ('54', '3', 'cny', '994608.00000000', '4375.24500000', '998983.24500000', '1010.00000000', '1', 'tradelog', '59', '交易中心-成功卖出-市场btc_cny', '995598.00000000', '4375.24500000', '999973.24500000', 'e5e2e6d22dd290406f2b91c4ef73a421', '1498139916', '1');

-- ----------------------------
-- Table structure for `qq3479015851_footer`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_footer`;
CREATE TABLE `qq3479015851_footer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_footer
-- ----------------------------
INSERT INTO `qq3479015851_footer` VALUES ('1', '1', '关于我们', '/Article/index/type/aboutus.html', '', '1', '', '1', '111', '0', '1');
INSERT INTO `qq3479015851_footer` VALUES ('2', '1', '联系我们', '/Article/index/type/aboutus.html', '', '1', '', '1', '111', '0', '1');
INSERT INTO `qq3479015851_footer` VALUES ('3', '1', '资质证明', '/Article/index/type/aboutus.html', '', '1', '', '1', '111', '0', '1');
INSERT INTO `qq3479015851_footer` VALUES ('4', '1', '用户协议', '/Article/index/type/aboutus.html', '', '1', '', '1', '111', '0', '1');
INSERT INTO `qq3479015851_footer` VALUES ('5', '1', '法律声明', '/Article/index/type/aboutus.html', '', '1', '', '1', '111', '0', '1');
INSERT INTO `qq3479015851_footer` VALUES ('6', '1', '1', '/', 'footer_1.png', '2', '', '1', '111', '0', '1');
INSERT INTO `qq3479015851_footer` VALUES ('7', '1', '1', 'http://www.szfw.org/', 'footer_2.png', '2', '', '1', '111', '0', '1');
INSERT INTO `qq3479015851_footer` VALUES ('8', '1', '1', 'http://www.miibeian.gov.cn/', 'footer_3.png', '2', '', '1', '111', '0', '1');
INSERT INTO `qq3479015851_footer` VALUES ('9', '1', '1', 'http://www.cyberpolice.cn/', 'footer_4.png', '2', '', '1', '111', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_huafei`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_huafei`;
CREATE TABLE `qq3479015851_huafei` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) unsigned NOT NULL,
  `moble` varchar(255) NOT NULL,
  `num` int(11) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `mum` decimal(20,8) NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_huafei
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_huafei_coin`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_huafei_coin`;
CREATE TABLE `qq3479015851_huafei_coin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `coinname` varchar(50) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_huafei_coin
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_huafei_type`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_huafei_type`;
CREATE TABLE `qq3479015851_huafei_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_huafei_type
-- ----------------------------
INSERT INTO `qq3479015851_huafei_type` VALUES ('1', '10', '10元话费充值', '1');
INSERT INTO `qq3479015851_huafei_type` VALUES ('2', '20', '20元话费充值', '1');
INSERT INTO `qq3479015851_huafei_type` VALUES ('3', '30', '30元话费充值', '1');
INSERT INTO `qq3479015851_huafei_type` VALUES ('4', '50', '50元话费充值', '1');
INSERT INTO `qq3479015851_huafei_type` VALUES ('5', '100', '100元话费充值', '1');
INSERT INTO `qq3479015851_huafei_type` VALUES ('6', '300', '300元话费充值', '1');

-- ----------------------------
-- Table structure for `qq3479015851_invit`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_invit`;
CREATE TABLE `qq3479015851_invit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `invit` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `fee` decimal(20,8) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `invit` (`invit`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='推广奖励表';

-- ----------------------------
-- Records of qq3479015851_invit
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_issue`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_issue`;
CREATE TABLE `qq3479015851_issue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `buycoin` varchar(50) NOT NULL,
  `num` bigint(20) unsigned NOT NULL,
  `deal` int(11) unsigned NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `limit` int(11) unsigned NOT NULL,
  `time` varchar(255) NOT NULL,
  `tian` varchar(255) NOT NULL,
  `ci` varchar(255) NOT NULL,
  `jian` varchar(255) NOT NULL,
  `min` varchar(255) NOT NULL,
  `max` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `invit_coin` varchar(50) NOT NULL,
  `invit_1` varchar(50) NOT NULL,
  `invit_2` varchar(50) NOT NULL,
  `invit_3` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `image` varchar(100) NOT NULL,
  `tuijian` tinyint(1) NOT NULL DEFAULT '2',
  `paixu` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`),
  KEY `coinname` (`coinname`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='认购发行表';

-- ----------------------------
-- Records of qq3479015851_issue
-- ----------------------------
INSERT INTO `qq3479015851_issue` VALUES ('1', '莱特币众筹', 'ltc', 'cny', '100000', '1', '1.00000000', '10', '2017-06-22 00:00:00', '10', '', '', '1', '100', '22323', 'cny', '', '', '', '0', '1498139370', '0', '1', '594bca8a27ed4.jpg', '1', '0');

-- ----------------------------
-- Table structure for `qq3479015851_issue_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_issue_log`;
CREATE TABLE `qq3479015851_issue_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `buycoin` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `num` int(20) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `ci` int(11) unsigned NOT NULL,
  `jian` varchar(255) NOT NULL,
  `unlock` int(11) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='认购记录表';

-- ----------------------------
-- Records of qq3479015851_issue_log
-- ----------------------------
INSERT INTO `qq3479015851_issue_log` VALUES ('1', '7', '莱特币众筹', 'ltc', 'cny', '1.00000000', '1', '1.00000000', '0', '', '1', '0', '1498139383', '1498139383', '0');

-- ----------------------------
-- Table structure for `qq3479015851_link`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_link`;
CREATE TABLE `qq3479015851_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `mytx` varchar(200) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='常用银行地址';

-- ----------------------------
-- Records of qq3479015851_link
-- ----------------------------
INSERT INTO `qq3479015851_link` VALUES ('1', 'boc', '中国银行', 'http://www.boc.cn/', 'img_56937003683ce.jpg', '', '', '0', '1452503043', '0', '-1');
INSERT INTO `qq3479015851_link` VALUES ('2', 'abc', '农业银行', 'http://www.abchina.com/cn/', '59257ab09e7f5.gif', '', '', '0', '1452503109', '1493740800', '1');
INSERT INTO `qq3479015851_link` VALUES ('3', 'bccb', '北京银行', 'http://www.bankofbeijing.com.cn/', '59257ac0294f5.gif', '', '', '0', '1452503128', '1493740800', '1');
INSERT INTO `qq3479015851_link` VALUES ('4', 'ccb', '建设银行', 'http://www.ccb.com/', '59257acc3739d.gif', '', '', '0', '1452503195', '1493740800', '1');
INSERT INTO `qq3479015851_link` VALUES ('5', 'ceb', '光大银行', 'http://www.bankofbeijing.com.cn/', '59257ada72cbd.jpg', '', '', '0', '1452503218', '1493654400', '1');
INSERT INTO `qq3479015851_link` VALUES ('6', 'cib', '兴业银行', 'http://www.cib.com.cn/cn/index.html', '59257ae87f00d.gif', '', '', '0', '1452503250', '1493654400', '1');
INSERT INTO `qq3479015851_link` VALUES ('7', 'citic', '中信银行', 'http://www.ecitic.com/', '59257af60cfd5.gif', '', '', '0', '1452503291', '1493827200', '1');
INSERT INTO `qq3479015851_link` VALUES ('8', 'cmb', '招商银行', 'http://www.cmbchina.com/', '59257aa19ebdd.jpg', '', '', '0', '1452503306', '1493740800', '1');
INSERT INTO `qq3479015851_link` VALUES ('9', '币创网', '币创网网', 'https://www.thbtc.com', '59257b03bdfdd.gif', '', '', '0', '1481608045', '1481608026', '1');
INSERT INTO `qq3479015851_link` VALUES ('10', '虚拟币信息中文网', '虚拟币信息中文网', 'http://www.chinabtcltc.com/', '59257b0cea2e5.gif', '', '', '0', '1452503344', '1480225439', '1');
INSERT INTO `qq3479015851_link` VALUES ('11', '巴比特论坛', '巴比特论坛', 'http://www.8btc.com/', '59257a942816d.gif', '', '', '0', '1452503380', '1480225390', '1');
INSERT INTO `qq3479015851_link` VALUES ('12', 'F2Pool 挖矿鱼池', 'F2Pool 挖矿鱼池', 'https://www.f2pool.com/', '59257a898edf5.gif', '', '', '0', '1480225304', '1480225306', '1');
INSERT INTO `qq3479015851_link` VALUES ('13', '币行', '币行', 'https://www.okcoin.cn', '59257a79ecddd.gif', '', '', '0', '1452503422', '1480225269', '1');
INSERT INTO `qq3479015851_link` VALUES ('14', '比特时代', '比特时代', 'http://www.btc38.com/', '59257a6e76b3d.gif', '', '', '0', '1452503439', '1480225238', '1');
INSERT INTO `qq3479015851_link` VALUES ('15', '掌心游戏网', '掌心游戏网', 'https://www.btc123.com', '59257a076cefd.jpg', '', '', '0', '1455613129', '1480225206', '1');
INSERT INTO `qq3479015851_link` VALUES ('16', '手机娱乐', '手机娱乐', 'http://www.baidu.com', '59257a40f142d.jpg', '', '', '0', '1493568000', '1494172800', '1');

-- ----------------------------
-- Table structure for `qq3479015851_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_log`;
CREATE TABLE `qq3479015851_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `num` int(20) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `unlock` int(11) unsigned NOT NULL,
  `ci` int(11) unsigned NOT NULL,
  `recycle` int(11) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`),
  KEY `coinname` (`coinname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_log
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_market`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_market`;
CREATE TABLE `qq3479015851_market` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `round` varchar(255) NOT NULL,
  `fee_buy` varchar(255) NOT NULL,
  `fee_sell` varchar(255) NOT NULL,
  `buy_min` varchar(255) NOT NULL,
  `buy_max` varchar(255) NOT NULL,
  `sell_min` varchar(255) NOT NULL,
  `sell_max` varchar(255) NOT NULL,
  `trade_min` varchar(255) NOT NULL,
  `trade_max` varchar(255) NOT NULL,
  `invit_buy` varchar(50) NOT NULL,
  `invit_sell` varchar(50) NOT NULL,
  `invit_1` varchar(50) NOT NULL,
  `invit_2` varchar(50) NOT NULL,
  `invit_3` varchar(50) NOT NULL,
  `zhang` varchar(255) NOT NULL,
  `die` varchar(255) NOT NULL,
  `hou_price` varchar(255) NOT NULL,
  `tendency` varchar(1000) NOT NULL,
  `trade` int(11) unsigned NOT NULL,
  `new_price` decimal(20,8) unsigned NOT NULL,
  `buy_price` decimal(20,8) unsigned NOT NULL,
  `sell_price` decimal(20,8) unsigned NOT NULL,
  `min_price` decimal(20,8) unsigned NOT NULL,
  `max_price` decimal(20,8) unsigned NOT NULL,
  `volume` decimal(20,8) unsigned NOT NULL,
  `change` decimal(20,8) NOT NULL,
  `api_min` decimal(20,8) unsigned NOT NULL,
  `api_max` decimal(20,8) unsigned NOT NULL,
  `begintrade` varchar(20) NOT NULL,
  `endtrade` varchar(20) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `jiaoyiqu` tinyint(1) NOT NULL,
  `qq3479015851_faxingjia` float(8,2) NOT NULL DEFAULT '0.00' COMMENT '发行价格',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='行情配置表';

-- ----------------------------
-- Records of qq3479015851_market
-- ----------------------------
INSERT INTO `qq3479015851_market` VALUES ('1', 'ltc_cny', '6', '1', '1', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '332.66400000', '[[1497882504,0],[1497896904,0],[1497911304,0],[1497925704,0],[1497940104,0],[1497954504,0],[1497968904,0],[1497983304,0],[1497997704,0],[1498012104,0],[1498026504,0],[1498040904,0],[1498055304,0],[1498069704,0],[1498084104,0],[1498098504,0],[1498112904,0],[1498127304,\"334.11300000\"],[1498141704,0]]', '1', '334.11300000', '333.55000000', '333.88800000', '332.36500000', '334.11300000', '1936.66000000', '0.44000000', '0.00000000', '0.00000000', '00:00:00', '23:59:00', '0', '0', '0', '1', '0', '0.00');
INSERT INTO `qq3479015851_market` VALUES ('2', 'btc_cny', '1', '1', '1', '', '', '', '', '', '', '1', '1', '', '', '', '', '', '8000.00000000', '[[1497882504,0],[1497896904,0],[1497911304,0],[1497925704,0],[1497940104,0],[1497954504,0],[1497968904,0],[1497983304,0],[1497997704,0],[1498012104,0],[1498026504,0],[1498040904,0],[1498055304,0],[1498069704,0],[1498084104,0],[1498098504,0],[1498112904,0],[1498127304,\"8000.00000000\"],[1498141704,0]]', '1', '500.00000000', '500.00000000', '1000.00000000', '500.00000000', '8000.00000000', '15.00000000', '-93.75000000', '0.00000000', '0.00000000', '00:00:00', '23:59:00', '0', '0', '0', '1', '0', '0.00');

-- ----------------------------
-- Table structure for `qq3479015851_market_json`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_market_json`;
CREATE TABLE `qq3479015851_market_json` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of qq3479015851_market_json
-- ----------------------------
INSERT INTO `qq3479015851_market_json` VALUES ('3', 'btc_cny', '', '', '0', '1505145599', '0', '0');
INSERT INTO `qq3479015851_market_json` VALUES ('2', 'ltc_cny', '', '', '0', '16991999', '0', '0');

-- ----------------------------
-- Table structure for `qq3479015851_menu`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_menu`;
CREATE TABLE `qq3479015851_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  `ico_name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=452 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_menu
-- ----------------------------
INSERT INTO `qq3479015851_menu` VALUES ('1', '系统', '0', '1', 'Index/index', '0', '', '', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('2', '内容', '0', '1', 'Article/index', '0', '', '', '0', 'list-alt');
INSERT INTO `qq3479015851_menu` VALUES ('3', '用户', '0', '1', 'User/index', '0', '', '', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('4', '财务', '0', '1', 'Finance/index', '0', '', '', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('5', '交易', '0', '1', 'Trade/index', '0', '', '', '0', 'stats');
INSERT INTO `qq3479015851_menu` VALUES ('6', '应用', '0', '1', 'Game/index', '0', '', '', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('7', '设置', '0', '1', 'Config/index', '0', '', '', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('8', '运营', '0', '1', 'Operate/index', '0', '', '', '0', 'share');
INSERT INTO `qq3479015851_menu` VALUES ('9', '工具', '0', '1', 'Tools/index', '0', '', '', '0', 'wrench');
INSERT INTO `qq3479015851_menu` VALUES ('10', '扩展', '0', '1', 'Cloud/index', '0', '', '', '0', 'tasks');
INSERT INTO `qq3479015851_menu` VALUES ('11', '系统概览', '1', '1', 'Index/index', '0', '', '系统', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('12', '市场统计', '1', '3', 'Index/market', '0', '', '系统', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('13', '文章管理', '2', '1', 'Article/index', '0', '', '内容', '0', 'list-alt');
INSERT INTO `qq3479015851_menu` VALUES ('14', '编辑添加', '13', '1', 'Article/edit', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('15', '修改状态', '13', '100', 'Article/status', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('16', '上传图片', '13', '2', 'Article/images', '1', '', '内容管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('18', '编辑', '17', '2', 'Adver/edit', '1', '', '内容管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('19', '修改', '17', '2', 'Adver/status', '1', '', '内容管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('21', '编辑', '20', '3', 'Chat/edit', '1', '', '聊天管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('22', '修改', '20', '3', 'Chat/status', '1', '', '聊天管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('23', '提示文字', '2', '1', 'Text/index', '1', '', '提示管理', '0', 'exclamation-sign');
INSERT INTO `qq3479015851_menu` VALUES ('24', '编辑', '23', '1', 'Text/edit', '1', '', '提示管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('25', '修改', '23', '1', 'Text/status', '1', '', '提示管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('26', '用户管理', '3', '1', 'User/index', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('32', '确认转出', '26', '8', 'User/myzc_qr', '1', '', '用户管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('33', '用户配置', '3', '1', 'User/config', '1', '', '前台用户管理', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('34', '编辑', '33', '2', 'User/index_edit', '1', '', '用户管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('35', '修改', '33', '2', 'User/index_status', '1', '', '用户管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('37', '财产修改', '26', '3', 'Usercoin/edit', '1', '', '用户管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('39', '新增用户组', '38', '0', 'AuthManager/createGroup', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('40', '编辑用户组', '38', '0', 'AuthManager/editgroup', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('41', '更新用户组', '38', '0', 'AuthManager/writeGroup', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('42', '改变状态', '38', '0', 'AuthManager/changeStatus', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('43', '访问授权', '38', '0', 'AuthManager/access', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('44', '分类授权', '38', '0', 'AuthManager/category', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('45', '成员授权', '38', '0', 'AuthManager/user', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('46', '成员列表授权', '38', '0', 'AuthManager/tree', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('47', '用户组', '38', '0', 'AuthManager/group', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('48', '添加到用户组', '38', '0', 'AuthManager/addToGroup', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('49', '用户组移除', '38', '0', 'AuthManager/removeFromGroup', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('50', '分类添加到用户组', '38', '0', 'AuthManager/addToCategory', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('51', '模型添加到用户组', '38', '0', 'AuthManager/addToModel', '1', '', '权限管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('53', '配置', '52', '1', 'Finance/config', '1', '', '', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('55', '类型', '52', '1', 'Finance/type', '1', '', '', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('56', '状态修改', '52', '1', 'Finance/type_status', '1', '', '', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('60', '修改', '57', '3', 'Mycz/status', '1', '', '充值管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('61', '状态修改', '57', '3', 'Mycztype/status', '1', '', '充值管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('64', '状态修改', '62', '5', 'Mytx/status', '1', '', '提现管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('65', '取消', '62', '5', 'Mytx/excel', '1', '', '提现管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('66', '导入excel', '9', '5', 'Mytx/exportExcel', '1', '', '提现管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('68', '委托管理', '5', '1', 'Trade/index', '0', '', '交易', '0', 'stats');
INSERT INTO `qq3479015851_menu` VALUES ('69', '成交记录', '5', '2', 'Trade/log', '0', '', '交易', '0', 'stats');
INSERT INTO `qq3479015851_menu` VALUES ('70', '修改状态', '68', '0', 'Trade/status', '1', '', '交易管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('71', '撤销挂单', '68', '0', 'Trade/chexiao', '1', '', '交易管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('74', '认购编辑', '72', '2', 'Issue/edit', '1', '', '认购管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('75', '认购修改', '72', '2', 'Issue/status', '1', '', '认购管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('79', '基本配置', '7', '1', 'Config/index', '0', '', '设置', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('80', '短信配置', '7', '2', 'Config/moble', '0', '', '设置', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('81', '客服配置', '7', '3', 'Config/contact', '0', '', '设置', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('82', '银行配置', '79', '4', 'Config/bank', '0', '', '网站配置', '0', 'credit-card');
INSERT INTO `qq3479015851_menu` VALUES ('83', '编辑', '82', '4', 'Config/bank_edit', '1', '', '网站配置', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('85', '编辑', '84', '4', 'Coin/edit', '0', '', '网站配置', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('87', '状态修改', '84', '4', 'Coin/status', '1', '', '网站配置', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('89', '编辑市场', '88', '4', 'Market/edit', '0', '', '', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('91', '状态修改', '88', '4', 'Config/market_add', '1', '', '', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('92', '图形验证码', '95', '7', 'Verify/code', '1', '', '网站配置', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('93', '手机验证码', '95', '7', 'Verify/mobile', '1', '', '网站配置', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('94', '邮件验证码', '95', '7', 'Verify/email', '1', '', '网站配置', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('95', '其他配置', '7', '6', 'Config/qita', '0', '', '设置', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('97', '推广配置', '8', '2', 'Invit/config', '1', '', '推广管理', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('101', '其他模块调用', '9', '4', 'Tools/invoke', '1', '', '其他', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('102', '优化表', '9', '4', 'Tools/optimize', '1', '', '其他', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('103', '修复表', '9', '4', 'Tools/repair', '1', '', '其他', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('104', '删除备份文件', '9', '4', 'Tools/del', '1', '', '其他', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('105', '备份数据库', '9', '4', 'Tools/export', '1', '', '其他', '0', '');
INSERT INTO `qq3479015851_menu` VALUES ('106', '还原数据库', '9', '4', 'Tools/import', '1', '', '其他', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('107', '导出数据库', '9', '4', 'Tools/excel', '1', '', '其他', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('108', '导出Excel', '9', '4', 'Tools/exportExcel', '1', '', '其他', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('109', '导入Excel', '9', '4', 'Tools/importExecl', '1', '', '其他', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('115', '图片', '111', '0', 'Shop/images', '0', '', '云购商城', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('116', '菜单管理', '7', '5', 'Menu/index', '1', '', '开发组', '0', 'list');
INSERT INTO `qq3479015851_menu` VALUES ('117', '排序', '116', '5', 'Menu/sort', '0', '', '开发组', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('118', '添加', '116', '5', 'Menu/add', '0', '', '开发组', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('119', '编辑', '116', '5', 'Menu/edit', '0', '', '开发组', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('120', '删除', '116', '5', 'Menu/del', '0', '', '开发组', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('121', '是否隐藏', '116', '5', 'Menu/toogleHide', '0', '', '开发组', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('122', '是否开发', '116', '5', 'Menu/toogleDev', '0', '', '开发组', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('123', '导入文件', '7', '5', 'Menu/importFile', '1', '', '开发组', '0', 'log-in');
INSERT INTO `qq3479015851_menu` VALUES ('124', '导入', '7', '5', 'Menu/import', '1', '', '开发组', '0', 'log-in');
INSERT INTO `qq3479015851_menu` VALUES ('127', '用户登录', '3', '0', 'Login/index', '1', '', '用户配置', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('128', '用户退出', '3', '0', 'Login/loginout', '1', '', '用户配置', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('129', '修改管理员密码', '3', '0', 'User/setpwd', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('131', '用户详情', '3', '4', 'User/detail', '1', '', '前台用户管理', '0', 'time');
INSERT INTO `qq3479015851_menu` VALUES ('132', '后台用户详情', '3', '1', 'AdminUser/detail', '1', '', '后台用户管理', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('133', '后台用户状态', '3', '1', 'AdminUser/status', '1', '', '后台用户管理', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('134', '后台用户新增', '3', '1', 'AdminUser/add', '1', '', '后台用户管理', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('135', '后台用户编辑', '3', '1', 'AdminUser/edit', '1', '', '后台用户管理', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('138', '编辑', '2', '1', 'Articletype/edit', '1', '', '内容管理', '0', 'list-alt');
INSERT INTO `qq3479015851_menu` VALUES ('140', '编辑', '139', '2', 'Link/edit', '1', '', '内容管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('141', '修改', '139', '2', 'Link/status', '1', '', '内容管理', '0', '0');
INSERT INTO `qq3479015851_menu` VALUES ('155', '服务器队列', '9', '3', 'Tools/queue', '0', '', '工具', '0', 'wrench');
INSERT INTO `qq3479015851_menu` VALUES ('156', '钱包检查', '9', '3', 'Tools/qianbao', '1', '', '工具', '0', 'wrench');
INSERT INTO `qq3479015851_menu` VALUES ('157', '币种统计', '1', '2', 'Index/coin', '0', '', '系统', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('163', '提示文字', '7', '5', 'Config/text', '0', '', '设置', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('220', '币种评论', '5', '4', 'Trade/comment', '0', '', '交易', '0', 'stats');
INSERT INTO `qq3479015851_menu` VALUES ('278', '文章类型', '2', '2', 'Article/type', '0', '', '内容', '0', 'list-alt');
INSERT INTO `qq3479015851_menu` VALUES ('279', '广告管理', '2', '3', 'Article/adver', '0', '', '内容', '0', 'list-alt');
INSERT INTO `qq3479015851_menu` VALUES ('280', '友情链接', '2', '4', 'Article/link', '0', '', '内容', '0', 'list-alt');
INSERT INTO `qq3479015851_menu` VALUES ('282', '登陆日志', '3', '4', 'User/log', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('283', '用户钱包', '3', '5', 'User/qianbao', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('284', '提现地址', '3', '6', 'User/bank', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('285', '用户财产', '3', '7', 'User/coin', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('286', '联系地址', '3', '8', 'User/goods', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('287', '交易聊天', '5', '3', 'Trade/chat', '0', '', '交易', '0', 'stats');
INSERT INTO `qq3479015851_menu` VALUES ('288', '交易市场', '5', '5', 'Trade/market', '0', '', '交易', '0', 'stats');
INSERT INTO `qq3479015851_menu` VALUES ('289', '交易推荐', '5', '6', 'Trade/invit', '0', '', '交易', '0', 'stats');
INSERT INTO `qq3479015851_menu` VALUES ('290', '财务明细', '4', '1', 'Finance/index', '0', '', '财务', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('291', '人民币充值', '4', '2', 'Finance/mycz', '0', '', '财务', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('292', '人民币充值方式', '4', '3', 'Finance/myczType', '0', '', '财务', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('293', '人民币提现', '4', '4', 'Finance/mytx', '0', '', '财务', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('294', '人民币提现配置', '4', '5', 'Finance/mytxConfig', '0', '', '财务', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('295', '虚拟币转入', '4', '6', 'Finance/myzr', '0', '', '财务', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('296', '虚拟币转出', '4', '7', 'Finance/myzc', '0', '', '财务', '0', 'th-list');
INSERT INTO `qq3479015851_menu` VALUES ('297', '修改状态', '291', '100', 'Finance/myczStatus', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('298', '确认到账', '291', '100', 'Finance/myczQueren', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('299', '编辑添加', '292', '1', 'Finance/myczTypeEdit', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('300', '状态修改', '292', '2', 'Finance/myczTypeStatus', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('301', '上传图片', '292', '2', 'Finance/myczTypeImage', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('302', '修改状态', '293', '2', 'Finance/mytxStatus', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('303', '导出选中', '293', '3', 'Finance/mytxExcel', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('304', '正在处理', '293', '4', 'Finance/mytxChuli', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('305', '撤销提现', '293', '5', 'Finance/mytxChexiao', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('306', '确认提现', '293', '6', 'Finance/mytxQueren', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('307', '确认转出', '296', '6', 'Finance/myzcQueren', '1', '', '财务', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('309', '清理缓存', '9', '1', 'Tools/index', '0', '', '工具', '0', 'wrench');
INSERT INTO `qq3479015851_menu` VALUES ('310', '备份数据库', '9', '2', 'Tools/dataExport', '1', '', '工具', '0', 'wrench');
INSERT INTO `qq3479015851_menu` VALUES ('311', '还原数据库', '9', '2', 'Tools/dataImport', '1', '', '工具', '0', 'wrench');
INSERT INTO `qq3479015851_menu` VALUES ('312', '管理员管理', '3', '2', 'User/admin', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('313', '权限列表', '3', '3', 'User/auth', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('314', '编辑添加', '26', '1', 'User/edit', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('315', '修改状态', '26', '1', 'User/status', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('316', '编辑添加', '312', '1', 'User/adminEdit', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('317', '修改状态', '312', '1', 'User/adminStatus', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('318', '编辑添加', '313', '1', 'User/authEdit', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('319', '修改状态', '313', '1', 'User/authStatus', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('320', '重新初始化权限', '313', '1', 'User/authStart', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('321', '编辑添加', '282', '1', 'User/logEdit', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('322', '修改状态', '282', '1', 'User/logStatus', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('323', '编辑添加', '283', '1', 'User/qianbaoEdit', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('324', '修改状态', '283', '1', 'User/qianbaoStatus', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('325', '编辑添加', '284', '1', 'User/bankEdit', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('326', '修改状态', '284', '1', 'User/bankStatus', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('327', '编辑添加', '285', '1', 'User/coinEdit', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('328', '财产统计', '285', '1', 'User/coinLog', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('329', '编辑添加', '286', '1', 'User/goodsEdit', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('330', '修改状态', '286', '1', 'User/goodsStatus', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('331', '编辑添加', '278', '1', 'Article/typeEdit', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('332', '修改状态', '278', '100', 'Article/typeStatus', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('333', '编辑添加', '280', '1', 'Article/linkEdit', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('334', '修改状态', '280', '100', 'Article/linkStatus', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('335', '编辑添加', '279', '1', 'Article/adverEdit', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('336', '修改状态', '279', '100', 'Article/adverStatus', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('337', '上传图片', '279', '100', 'Article/adverImage', '1', '', '内容', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('375', '客服代码', '10', '5', 'Cloud/kefu', '1', '', '扩展', '0', 'tasks');
INSERT INTO `qq3479015851_menu` VALUES ('376', '使用', '375', '5', 'Cloud/kefuUp', '1', '', '扩展', '0', 'tasks');
INSERT INTO `qq3479015851_menu` VALUES ('377', '访问授权', '313', '1', 'User/authAccess', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('378', '访问授权修改', '313', '1', 'User/authAccessUp', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('379', '成员授权', '313', '1', 'User/authUser', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('380', '成员授权增加', '313', '1', 'User/authUserAdd', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('381', '成员授权解除', '313', '1', 'User/authUserRemove', '1', '', '用户', '0', 'home');
INSERT INTO `qq3479015851_menu` VALUES ('382', '币种配置', '7', '4', 'Config/coin', '0', '', '设置', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('383', '推广奖励', '8', '1', 'Operate/index', '0', '', '', '0', 'share');
INSERT INTO `qq3479015851_menu` VALUES ('384', 'APP配置', '8', '1', 'App/config', '1', '', 'APP管理', '0', 'time');
INSERT INTO `qq3479015851_menu` VALUES ('385', 'APP等级', '8', '2', 'App/vip_config_list', '1', '', 'APP管理', '0', 'time');
INSERT INTO `qq3479015851_menu` VALUES ('386', 'WAP广告板块', '8', '3', 'Admin/App/ads_list/block_id/1', '0', '', 'WAP管理', '0', 'time');
INSERT INTO `qq3479015851_menu` VALUES ('387', 'APP广告用户', '8', '4', 'App/ads_user', '1', '', 'APP管理', '0', 'time');
INSERT INTO `qq3479015851_menu` VALUES ('388', '导航配置', '7', '7', 'Config/daohang', '0', '', '设置', '0', 'cog');
INSERT INTO `qq3479015851_menu` VALUES ('418', '主题模板', '10', '4', 'Cloud/theme', '0', '', '扩展', '0', 'tasks');
INSERT INTO `qq3479015851_menu` VALUES ('425', '商品管理', '6', '1', 'Shop/index', '0', '', '商城管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('426', '商城配置', '6', '2', 'Shop/config', '0', '', '商城管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('427', '商品类型', '6', '3', 'Shop/type', '0', '', '商城管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('428', '付款方式', '6', '4', 'Shop/coin', '1', '', '商城管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('429', '购物记录', '6', '5', 'Shop/log', '0', '', '商城管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('430', '收货地址', '6', '6', 'Shop/goods', '0', '', '商城管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('433', '分红管理', '6', '3', 'Fenhong/index', '0', '', '分红管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('434', '分红记录', '6', '5', 'Fenhong/log', '0', '', '分红管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('435', '充值记录', '6', '1', 'Huafei/index', '1', '', '话费充值', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('436', '充值配置', '6', '1', 'Huafei/config', '1', '', '话费充值', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('437', '充值金额', '6', '3', 'Huafei/type', '1', '', '话费充值', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('438', '付款方式', '6', '4', 'Huafei/coin', '1', '', '话费充值', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('439', '投票记录', '6', '1', 'Vote/index', '0', '', '新币投票', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('440', '投票类型', '6', '1', 'Vote/type', '0', '', '新币投票', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('441', '理财管理', '6', '1', 'Money/index', '1', '', '理财管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('442', '理财日志', '6', '2', 'Money/log', '1', '', '理财管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('443', '理财明细', '6', '3', 'Money/fee', '1', '', '理财管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('448', '认购管理', '6', '1', 'Issue/index', '0', '', '认购管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('449', '认购记录', '6', '1', 'Issue/log', '0', '', '认购管理', '0', 'globe');
INSERT INTO `qq3479015851_menu` VALUES ('450', '中奖管理', '3', '1', 'User/award', '0', '', '用户', '0', 'user');
INSERT INTO `qq3479015851_menu` VALUES ('451', '应用管理', '10', '3', 'Cloud/game', '1', '', '扩展', '0', 'tasks');

-- ----------------------------
-- Table structure for `qq3479015851_message`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_message`;
CREATE TABLE `qq3479015851_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `addip` varchar(200) NOT NULL,
  `addr` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_message
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_message_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_message_log`;
CREATE TABLE `qq3479015851_message_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `addip` varchar(200) NOT NULL,
  `addr` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_message_log
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_money`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_money`;
CREATE TABLE `qq3479015851_money` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `num` bigint(20) unsigned NOT NULL DEFAULT '0',
  `deal` int(11) unsigned NOT NULL DEFAULT '0',
  `tian` int(11) unsigned NOT NULL,
  `fee` int(11) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='投资理财表';

-- ----------------------------
-- Records of qq3479015851_money
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_money_fee`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_money_fee`;
CREATE TABLE `qq3479015851_money_fee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `money_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `num` int(6) NOT NULL,
  `content` varchar(255) NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_money_fee
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_money_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_money_log`;
CREATE TABLE `qq3479015851_money_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `num` int(11) unsigned NOT NULL,
  `fee` decimal(20,8) unsigned NOT NULL,
  `feea` decimal(20,8) unsigned NOT NULL,
  `tian` int(11) unsigned NOT NULL,
  `tiana` int(11) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  `money_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='理财记录表';

-- ----------------------------
-- Records of qq3479015851_money_log
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_mycz`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_mycz`;
CREATE TABLE `qq3479015851_mycz` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `num` float(11,2) unsigned NOT NULL,
  `mum` float(11,2) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `tradeno` varchar(50) NOT NULL,
  `remark` varchar(250) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='充值记录表';

-- ----------------------------
-- Records of qq3479015851_mycz
-- ----------------------------
INSERT INTO `qq3479015851_mycz` VALUES ('1', '1', '100.00', '100.00', 'weixin', 'FB135824', '', '0', '1497986824', '1497986977', '2');
INSERT INTO `qq3479015851_mycz` VALUES ('2', '1', '10000.00', '10000.00', 'weixin', 'EX912956', '', '0', '1497987005', '1497987033', '2');
INSERT INTO `qq3479015851_mycz` VALUES ('3', '2', '10000.39', '0.00', 'alipay', 'CF835714', '', '0', '1498035109', '0', '3');
INSERT INTO `qq3479015851_mycz` VALUES ('4', '3', '10000.41', '0.00', 'alipay', 'HL614152', '', '0', '1498135177', '0', '0');
INSERT INTO `qq3479015851_mycz` VALUES ('5', '7', '100.00', '100.00', 'weixin', 'KX562912', '', '0', '1498137554', '1498137624', '2');
INSERT INTO `qq3479015851_mycz` VALUES ('6', '7', '200.00', '200.00', 'alipay', 'NG321828', '', '0', '1498137617', '1498137629', '2');

-- ----------------------------
-- Table structure for `qq3479015851_mycz_invit`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_mycz_invit`;
CREATE TABLE `qq3479015851_mycz_invit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) unsigned NOT NULL COMMENT '用户id',
  `invitid` int(11) unsigned NOT NULL COMMENT '推荐人id',
  `num` decimal(20,2) unsigned NOT NULL COMMENT '操作金额',
  `fee` decimal(20,8) unsigned NOT NULL COMMENT '赠送金额',
  `coinname` varchar(50) NOT NULL COMMENT '赠送币种',
  `mum` decimal(20,8) unsigned NOT NULL COMMENT '到账金额',
  `remark` varchar(250) NOT NULL COMMENT '备注',
  `sort` int(11) unsigned NOT NULL COMMENT '排序',
  `addtime` int(11) unsigned NOT NULL COMMENT '添加时间',
  `endtime` int(11) unsigned NOT NULL COMMENT '编辑时间',
  `status` tinyint(4) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='充值赠送';

-- ----------------------------
-- Records of qq3479015851_mycz_invit
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_mycz_type`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_mycz_type`;
CREATE TABLE `qq3479015851_mycz_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `max` varchar(200) NOT NULL COMMENT '名称',
  `min` varchar(200) NOT NULL COMMENT '名称',
  `kaihu` varchar(200) NOT NULL COMMENT '名称',
  `truename` varchar(200) NOT NULL COMMENT '名称',
  `name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `extra` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='充值类型';

-- ----------------------------
-- Records of qq3479015851_mycz_type
-- ----------------------------
INSERT INTO `qq3479015851_mycz_type` VALUES ('1', '100000', '100', '企业支付宝', '深圳市区链网络科技有限公司', 'alipay', '支付宝转账支付', '', 'thbtcvip@163.com', '', '58480cb735cbf.png', '', '需要在联系方式里面设置支付宝账号', '0', '0', '0', '1');
INSERT INTO `qq3479015851_mycz_type` VALUES ('2', '', '', '', '币创科技有限公司', 'weixin', '微信转账支付', '', 'weixinzhifu', '123456', '594976f435005.png', '', '需要在联系方式里面设置微信账号', '0', '0', '0', '1');
INSERT INTO `qq3479015851_mycz_type` VALUES ('3', '10000', '100', '', '', 'bank', '网银转账支付', '', '', '', '57de3a186ea05.jpg', '', '需要在联系方式里面按照格式天数收款银行账号', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_mytx`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_mytx`;
CREATE TABLE `qq3479015851_mytx` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `num` int(11) unsigned NOT NULL,
  `fee` decimal(20,2) unsigned NOT NULL,
  `mum` decimal(20,2) unsigned NOT NULL,
  `truename` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `bank` varchar(250) NOT NULL,
  `bankprov` varchar(50) NOT NULL,
  `bankcity` varchar(50) NOT NULL,
  `bankaddr` varchar(50) NOT NULL,
  `bankcard` varchar(200) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='提现记录表';

-- ----------------------------
-- Records of qq3479015851_mytx
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_myzc`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_myzc`;
CREATE TABLE `qq3479015851_myzc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `username` varchar(200) NOT NULL,
  `coinname` varchar(200) NOT NULL,
  `txid` varchar(200) NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `fee` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`),
  KEY `coinname` (`coinname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_myzc
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_myzc_fee`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_myzc_fee`;
CREATE TABLE `qq3479015851_myzc_fee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `coinname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `txid` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fee` decimal(20,8) NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of qq3479015851_myzc_fee
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_myzr`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_myzr`;
CREATE TABLE `qq3479015851_myzr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `username` varchar(200) NOT NULL,
  `coinname` varchar(200) NOT NULL,
  `txid` varchar(200) NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `fee` decimal(20,8) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`),
  KEY `coinname` (`coinname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_myzr
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_pool`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_pool`;
CREATE TABLE `qq3479015851_pool` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `ico` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `tian` int(11) unsigned NOT NULL,
  `limit` varchar(50) NOT NULL,
  `power` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='矿机类型表';

-- ----------------------------
-- Records of qq3479015851_pool
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_pool_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_pool_log`;
CREATE TABLE `qq3479015851_pool_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ico` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `tian` int(11) unsigned NOT NULL,
  `limit` varchar(50) NOT NULL,
  `power` varchar(50) NOT NULL,
  `num` int(11) unsigned NOT NULL,
  `use` int(11) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='矿机管理';

-- ----------------------------
-- Records of qq3479015851_pool_log
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_prompt`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_prompt`;
CREATE TABLE `qq3479015851_prompt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `mytx` varchar(200) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_prompt
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_shop`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_shop`;
CREATE TABLE `qq3479015851_shop` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `coinlist` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `buycoin` varchar(255) NOT NULL DEFAULT 'cny',
  `price` decimal(20,2) unsigned NOT NULL DEFAULT '0.00',
  `num` decimal(20,0) unsigned NOT NULL DEFAULT '0',
  `deal` decimal(20,0) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `max` varchar(255) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `market_price` decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `qq3479015851_awardcoinnum` int(4) NOT NULL DEFAULT '0',
  `qq3479015851_awardcoin` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `status` (`status`),
  KEY `deal` (`deal`),
  KEY `price` (`price`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商城商品表';

-- ----------------------------
-- Records of qq3479015851_shop
-- ----------------------------
INSERT INTO `qq3479015851_shop` VALUES ('1', '苹果（Apple）MacBook Pro MF839CH/A 13.3英寸宽屏笔记本电脑', '', '/Upload/shop/5822a937b9874.png', 'ryp', 'cny', '8888.00', '11110', '2', '<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:55px;text-align:center;\">\r\n		MacBook Pro\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:24px;text-align:center;\">\r\n		配备Retina 显示屏\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		每一像素颗粒，尽显澎湃动力。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150316172658167.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		绚丽夺目的 Retina 显示屏\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		领先于时代好几百万像素\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		15 英寸机型拥有超过 500 万像素，13 英寸机型拥有超过 400 万像素。因此，无论你是在润饰照片还是剪辑 HD高清家庭影片，都能获得令人震撼的清晰度。文字也锐利清晰，让浏览网页和修改文档这些日常之事都变得比以往更加赏心悦目。这样的显示屏方能配得上这款极为先进的笔记本电脑。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150316172704893.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		Force Touch 触控版\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		让相应式深入全新境界\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		13 英寸 MacBook Pro 带来你与 Mac 互动的全新方式。设计精巧的 Force Touch 触控板，让你无论点按表面的哪个位置，都能得到灵敏且效果一致的点击响应。在触控板下方，力度感应器能检测你的点按力度，为触控操作添加全新维度。你可以通过用力长按来启用一系列新功能，例如只需在触控板上增加按压力度，即可快速查看词语定义或预览文件。你还可以体验触觉反馈，触控板会发出触觉振动，因此你在屏幕上看到的一切，还能感觉到。所有这些先进功能，全可与深受 Mac 用户喜爱的 Multi-Touch 手势配合使用。轻轻松松间，你与 Mac 之间的沟通，迈入全新境界。仅限13英寸机型。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150316172711911.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		众多全新高性能技术\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		技术齐心协力，更快成就一切\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		拥有动力强劲的双核与四核 Intel 处理器、先进的图形处理器、基于 PCIe 的高速闪存、疾速内存和 Thunderbolt 2 端口，配备 Retina 显示屏的 MacBook Pro 带来全方位卓越性能，满足你对笔记本电脑的所有期待。无论你是浏览网站或构建网站，还是播放流媒体视频或剪辑视频，MacBook Pro 都能以超乎想象的动力和速度飞速处理极为复杂 (和不太复杂) 的任务。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150316172717994.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		纤薄、轻巧、强劲\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		毫厘之间，蕴藏无限创新\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		MacBook Pro 的设计精髓，就是在有限空间里满载强劲性能。因为我们相信，追求高性能不应该牺牲便携性。尽管全新 13 英寸 MacBook Pro 如此轻巧，却仍能提供长达 10 小时的电池使用时间，比前一代产品更长一个小时*。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150316172723576.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		配备一系列强大APP\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		工作事事顺手，娱乐即可上手\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		每台全新 Mac 均配备 iPhoto、iMovie、GarageBand、Pages、Numbers 和 Keynote。从开启它的那一刻起，你就可以运用照片、视频、音乐、文档、电子表格和演示文稿来尽情挥洒创意。为了配合 OS X Yosemite 的精美设计，这些 app 均已进行升级。同时，你还享有多款精彩 app，用以收发电子邮件、畅游网络、发送文本信息、进行 FaceTime 视频通话，甚至还有一款 app，可以帮你查找新的 app。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150316172730531.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#666666;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		OS X Yosemite\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		超前的电脑操作系统\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		OS X Yosemite 使用简易、优雅美观，更经过精心打造，使得 Mac 硬件的功能得到充分发挥，堪称超前的电脑操作系统。它配备一系列出众的 app，满足你的日常所需。此外，它还让你的 Mac 和 iOS 设备能以绝佳方式默契合作。\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#666666;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		Retina 显示屏\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		好几百万像素的好风景\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		<br />\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		13 英寸 MacBook Pro\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		13 英寸配备 Retina 显示屏的 MacBook Pro\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#666666;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		当你将如此多的像素纳入一个显示屏中：13 英寸机型达到 400 多万像素，15 英寸机型达到 500 多万像素，效果绝对绚丽夺目。其超高像素密度已超过人眼所能分辨的范围，使图像的逼真度提升至全新境界。13 英寸 MacBook Pro 具备惊人的 2560 x 1600 像素分辨率，而 15 英寸 MacBook Pro 拥有同样可观的 2880 x 1800 像素分辨率，可让你的高分辨率图像以像素级的精度纤毫毕现。而且文字如此锐利，让你竟有种在纸面上阅读电子邮件、网页和文档的感觉。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		Retina 显示屏在保持非凡色彩和画质的同时，减少了眩光的出现。它的高对比度令黑色更浓郁，白色更明亮，其他一切色彩也都显得更丰富，更鲜艳。IPS 技术让你能够以 178 度的宽广视角观赏屏幕上的一切，因此你几乎可以从任何角度感受到它的与众不同。你也一定会为自己所看到的一切而着迷。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;\">\r\n		13 英寸配备 Retina 显示屏的 MacBook Pro 比 HDTV 多了近 200 万像素，15 英寸机型则多了 300 万像素。\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#666666;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		先进的 Intel 移动处理器\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		双核、四核，强大不可小视\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		13 英寸配备 Retina 显示屏的 MacBook Pro，搭载第五代双核 Intel Core i5 或 Intel Core i7 处理器，可随时随地轻松满足那些对性能有较高要求的 app。这意味着，无论你带着相机去哪里，你的整个数字照片工作室将如影随行。每款机型均采用超线程技术，通过让每个内核同时处理多个任务来增强性能。快达 3.1GHz 的处理速度、高达 4MB 的共享三级缓存和高达3.4GHz 的 Turbo Boost 睿频加速技术，使这些处理器可随时应对任何任务。\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#666666;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		高性能图形处理器\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		荧屏表现，淋漓尽致\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		13 英寸配备 Retina 显示屏的 MacBook Pro 搭载 Intel Iris Graphics 6100 图形处理器，是执行日常任务和各种图形密集型创意 app 的理想选择。你可以轻松翻阅大型照片库，畅玩那些充满精彩细节的游戏，还能连接一或两台外部显示器，这是对 13 英寸 MacBook Pro 小巧身材和超凡性能的又一次精彩诠释。\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#666666;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		长效电池\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		续航长达 10 小时\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		13 英寸 MacBook Pro 充电一次可运行长达 10 小时，比上一代多了一小时。而 15 英寸机型可运行长达 8小时。对任何笔记本电脑而言，这样的电池使用时间都令人赞叹。但对于配备了超高分辨率显示屏、先进处理器和图形处理器，以及超薄设计的高性能笔记本电脑而言，这绝对是超乎想象的。内置电池能为你提供多达 1000 次的完全充电和放电循环。\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#666666;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		更快的全闪存\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		闪存之名，并非徒有虚名\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		基于 PCle 的闪存拥有惊人的读写速度，无论你做什么，都能感受到其中的差别：启动非常快速，app 开启迅捷，甚至连桌面操作也十分流畅，响应十分迅速。13 英寸机型的闪存比前一代产品快达 2 倍，令你能在瞬间导入海量图片库。而在 15 英寸机型上，闪存与四核处理器和高性能图形处理器相结合，令 Final Cut Pro X 中要求极高的剪辑任务也能快速完成。由于这些 MacBook Pro 机型均配备了高达 1TB 的闪存，因此你可以随身携带所有的重要文件3。此外，闪存没有任何活动部件，所以超级耐用且十分安静。\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:30px;text-align:center;\">\r\n		Mac 之妙\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:26px;text-align:center;\">\r\n		妙在它能帮你做到的一切\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;\">\r\n		每台 Mac 都配备了众多激发创意和提升效率的 app。同时，还拥有一系列出色的 app 来处理各种日常事务，包括浏览网页、发送邮件和信息，以及整理你的日历。甚至还有一款 app，可以帮你查找新的 app。所以，你的 Mac 不仅功能齐备，而且全副武装。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150316173058291.jpg\" />\r\n	</p>\r\n</div>', '', '1', '1478620800', '1478666634', '1', '8900.00', '0', '');
INSERT INTO `qq3479015851_shop` VALUES ('2', 'E能之芯 铝合金纳米微吸手机平板通用底座支架', '', '/Upload/shop/5822a9af793d6.png', 'ryp', 'cny', '4500.00', '9999', '0', '<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181046506.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181051106.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181058295.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181105146.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181111449.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181117691.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181125633.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181133337.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181140847.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181147149.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181155338.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181203553.jpg\" />\r\n</p>\r\n<p style=\"font-family:微软雅黑, Arial;color:#666666;text-align:center;background-color:#FFFFFF;\">\r\n	<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150723181209887.jpg\" />\r\n</p>', '', '2', '1478620800', '1478666734', '1', '5000.00', '0', '');
INSERT INTO `qq3479015851_shop` VALUES ('3', '捷视（JS）A1 商务家用手持高清无线微型投影仪', '', '/Upload/shop/5822a9ff1e0f6.png', 'ryp', 'cny', '3000.00', '999', '0', '<div style=\"margin:10px auto;padding:0px;font-family:微软雅黑;background-color:#FFFFFF;color:#333333;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:35px;text-align:center;\">\r\n		捷视 A1无线微型投影仪\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:20px;text-align:center;\">\r\n		全球首款基于DLP技术，LED光源技术微型投影仪\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;text-indent:28px;\">\r\n		A1是全球首款基于DLP技术，0.3英寸DMD芯片全功能自解码（最高支持1080P分辨率视频）LED光源技术微型投影仪，内置无线通讯互联技术模块，同各种数码产品相连接，无需外接繁琐的数据线及电源线，不受空间，地域环境限制。LED微型投影仪，又称口袋式投影机、便携式投影机、是把传统庞大的投影机精巧化、便携化、微小化，娱乐化、实用化、使投影更加贴近生活和娱乐。由于采用国际一流（OSRAM，欧司朗半导体公司）LED光源技术，鉴于LED的超强使用寿命，该机平均使用寿命超过3万小时。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416165527528.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:10px auto;padding:0px;font-family:微软雅黑;background-color:#FFFFFF;color:#333333;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:35px;text-align:center;\">\r\n		小投影，大画面\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:20px;text-align:center;\">\r\n		工作、娱乐一机到位，随时随地与他人分享\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;text-indent:28px;\">\r\n		业界首款内置无线高速Wi-Fi模块及1080P高清解码芯片，可解读及传输九城以上视频片源，让你的网络视频无处不在，小投影，大画面，随时随地同他人分享视频、图片等资源，采用直读TF卡或者机器内存的OFFICE文档，处理文档更加方便快捷。A1无线微型投影仪适用于移动商务（尤其是：IT、咨询、顾问、金融、保险、直销等行业）、产品展示，播放OFFICE文档，数码产品影视分享，电玩游戏、小型会议及教学、户外娱乐活动、PARTY等，儿童教育及娱乐。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416165536856.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:10px auto;padding:0px;font-family:微软雅黑;background-color:#FFFFFF;color:#333333;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:35px;text-align:center;\">\r\n		内置无线通讯模块\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:20px;text-align:center;\">\r\n		手机遥控器，有线无线连接电脑，一步到位\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;text-indent:28px;\">\r\n		支持手机遥控器，手机可当做是遥控器来操控投影。连接电脑，可有线、无线连接电脑。该产品不仅可以通过只读取TF卡或机器内存功能，还可以通过内置无线通讯模块同智能手机无线连接，将手机屏幕显示内容无线传输到投影仪，并投射出来，支持安卓同苹果系统手机，同时支持该系统的 iPad、PC等，并能够有线无线连接笔记本或台式电脑并同时镜像屏幕内容。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416165543271.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:10px auto;padding:0px;font-family:微软雅黑;background-color:#FFFFFF;color:#333333;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:35px;text-align:center;\">\r\n		全球首款人性化的操作界面\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:20px;text-align:center;\">\r\n		易读、易懂、易操作\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;text-align:center;text-indent:28px;\">\r\n		全球首款人性化的操作界面，易读易懂，与同类产品相比，首次接触该产品的使用者，能在更短的时间内掌握大部分功能操作，让使用者能以愉快的心情去欣赏所喜爱的视频画面中。手持投影产品中，这款亮度适中，画面对比度1000：1，854x480高分辨率，色彩艳丽通透，还原性好，图像清晰、锐利，播放文档等文字清晰高，细节良好。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416165550219.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#FFFFFF;color:#333333;\">\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416165559914.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:10px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#666666;\">\r\n	<p style=\"font-family:tahoma, &quot;font-size:20px;\">\r\n		与其他同类产品相比，具有如下特点及优点:\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		● 业界同功能的整机中体积最小，重量最轻，携带性更好。<br />\r\n● 能通过有线无线连接windows系统，苹果系统产品，安卓系统产品等。<br />\r\n● 同距离投影时，画面面积要比同类产品大10英寸左右，画面直观看起来更加舒服，流畅。<br />\r\n● 机器内置无线通讯模块，数据处理与接收稳定，不受外界环境因素，搬动，震动等造成无线通讯信号中断或者影响播放流畅度，整机批量供货时良品高。<br />\r\n● 由于使用的是聚合物锂电池，安全性要高于市场上同类机型所用电池，续航能力及使用寿命高于普通锂电池。<br />\r\n● 优化散热设计风道，噪音低，整机开孔率少，吸附灰尘几率小，外观工艺处理更好，整机故障返修率低。\r\n	</p>\r\n</div>\r\n<div style=\"margin:10px auto;padding:0px;font-family:微软雅黑, Arial;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416171738581.jpg\" />\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416171753458.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:10px auto;padding:0px;font-family:微软雅黑, Arial;color:#666666;background-color:#FFFFFF;\">\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416165629394.jpg\" />\r\n	</p>\r\n</div>\r\n<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#FFFFFF;color:#333333;\">\r\n	<p style=\"font-family:tahoma, &quot;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20150416165636135.jpg\" />\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		1、是否所有的手机都能与该微型投影仪无线连接？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：目前支持的手机操作系统为安卓4.0版本以上，苹果系统版本为5.1（含该版本）才能使用，暂不支持windowsphone系列操作系统手机。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		2、画面最大可以投影多大面积？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：40英寸左右/1米，在较暗的房间里投射面积更大，最大80英寸，视 环境及投射内容来决定投影面积大小。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		3、机器内部有自带内存吗？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：机器除去可以外接TF卡（最高支持32G）外，内部自带4G内存，可以存储用户想要存储的内容。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		4、可以遥控吗，为何没有遥控器？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：该产品的设计理念为手持产品，机器表面按键基本能满足遥控的功能，不是桌面大型投影，按键功能操作起来更方便，不存在遥控死角，携带方便 。其次我们设计的同智能手机可以无线通讯的，利用手机同无线Wi-fi连接，可以实现网上内容海量传输，同时手机也可以安装EZCONTROL这个APP软件，通过这个软件来操作投影整个功能。大部分遥控功能手机可以取代，通过手机触控操作更加方便。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		5、可以外接音箱吗？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：可以外接多媒体或者其他有线有源音箱。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		6、可以用移动电源对机器供电吗？选用怎样的移动电源供电？一般的移动电源可以用多长时间？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：可以使用，根据我们外接的供充电适配器供电参数，选用的移动电源是5V/2A的，使用Micro usb的插头即可，使用时间要看投影播放的内容及移动电源的电池容量。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		7、整机的使用寿命能用多久，售后怎样保证？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：整机使用的全球一流的LED光源技术，上面栏目已经提到，正常使用寿命是3万小时以上，按照每天使用8小时计算，8小时X365=2920小时，整机最低可以使用8年以上，微型投影结构设计难度在于散热及风道设计合理，本机不同于市场上某些产品，开孔率高，风道设计分散，容易吸进灰尘，造成机器电路板损坏及散热风扇停转；其次市场上某些机器由于散热设计不合理，发热量高，机器在工作的时候，明显感觉到机身发热，甚至超过使用者的耐热温度，给使用者不好的体验感。本机整机噪音亦低于同类产品，不会在你使用的时候听到恼人的噪音；本机已通过国家3C认证，安全性及品质有保证，不用担心使用安全及售后服务。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		8、亮度会衰减吗？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：使用3到5年以后，可能亮度衰减总体15%，电子产品本身是消耗品，长期使用后，亮度衰减是属于正常情况，但是整机不会停止工作，在投射画面亮度上略显偏低。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		9、这个投影仪为什么没有幕布？直接投在白色墙上效果会受影响吗？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答: 这个是便携式投影仪，设计思想是随时随地投影，所以没有必要配投影幕，投射到墙壁上是可以的，白色无污点的墙壁即可，投影效果没有影响。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		10、为什么机器在使用中，感觉机身有些热量？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：投影机内部光源在工作时会产生热量，通过内部的风路将热量散出，热量在行进过程中，部分会通过机器外壳，所以会感觉到机器外壳有些热量，属于正常现象，不会影响使用。\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:15px;font-weight:bold;\">\r\n		11、使用注意重点事项？\r\n	</p>\r\n	<p style=\"font-family:tahoma, &quot;font-size:14px;\">\r\n		答：严禁进、出空气口被异物阻档，或者机身被其他物体覆盖，导致机器工作时产生的热量将不能及时有效排出，造成机身发热明显，损坏整机；严禁在风沙环境中或者强酸强碱环境中使用；严禁机器进水等其他液体，以免损坏整机。\r\n	</p>\r\n</div>', '', '3', '1478620800', '1478666774', '1', '3300.00', '0', '');
INSERT INTO `qq3479015851_shop` VALUES ('4', '苹果（Apple）iPad Air 2 9.7英寸平板电脑 16G Wi', '', '/Upload/shop/5822aa3f7dbac.png', 'ryp', 'cny', '4444.00', '33321', '12', '<div class=\"__kindeditor_paste__\">\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;font-size:45px;text-align:center;\">\r\n		d折diPad Air 2\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;font-size:35px;text-align:center;\">\r\n		轻轻地，改变一切。\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20141024154812638.jpg\" />\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;\">\r\n		<br />\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;\">\r\n		<br />\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;font-size:30px;text-align:center;\">\r\n		多才多能，让你不想放手；<br />\r\n<br />\r\n又轻又薄，让你不觉在手。\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;font-size:14px;text-align:center;\">\r\n		对于 iPad，我们一直都有一个看似自相矛盾的目标：要创造一部功能极为强大，但又轻盈纤薄到你不觉在手的设备；一部让你能全力挥洒，但却毫不费力的设备。 iPad Air 2 不仅实现了这一切，甚至还超出了我们的预期。\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;\">\r\n		<br />\r\n	</p>\r\n	<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;background-color:#F8F8F8;color:#333333;\">\r\n		<p style=\"font-family:tahoma, \"font-size:35px;\">\r\n			<br />\r\n		</p>\r\n	</div>\r\n	<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#333333;background-color:#FFFFFF;\">\r\n		<p style=\"font-family:tahoma, \"text-align:center;\">\r\n			<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20141024154927978.jpg\" />\r\n		</p>\r\n	</div>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;\">\r\n		<br />\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;font-size:35px;text-align:center;\">\r\n		众多 App，为 iPad 量身打造，<br />\r\n<br />\r\n也为成就你想做的一切。\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;font-size:14px;text-align:center;\">\r\n		iPad Air 2 内置多款强大 app 来让你处理日常事务，比如浏览网络，查收电子邮件，编辑影片和照片，撰写报告和阅读图书。不仅如此，App Store 中还有成千上万款 app，专为 iPad 宽大的多点触控 Retina 显示屏而精心设计，绝不仅仅是手机 app 的简单放大。因此，无论你是爱好摄影，游戏，旅行，还是想管理自己的财务，总有一款 app 会让你做得更出色。\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;text-align:center;\">\r\n		<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20141024154934369.jpg\" />\r\n	</p>\r\n	<p style=\"font-family:tahoma, \"background-color:#F8F8F8;\">\r\n		<br />\r\n	</p>\r\n	<div style=\"margin:0px auto;padding:0px;font-family:微软雅黑;color:#333333;background-color:#FFFFFF;\">\r\n		<p style=\"font-family:tahoma, \"font-size:35px;text-align:center;\">\r\n			iOS 8 和 iPad Air 2，<br />\r\n强强联手。\r\n		</p>\r\n		<p style=\"font-family:tahoma, \"font-size:14px;text-align:center;\">\r\n			iOS 8 是超前的移动操作系统，其先进功能让 iPad Air 2 变得更不可或缺。连续互通功能可让你在这部设备上开始一个项目，然后在另一部设备上继续完成。家人共享功能让你与多达六人轻松共享图书和 app。而 iCloud Drive 可让你安全存储各种类型的文档，并从你的各种设备上访问。事实上，iOS 8 上的一切功能不仅是为了与 iPad Air 2 默契配合而设计，也是为了将强大的 A8X 芯片、超快的无线连接、以及绚丽 Retina 显示屏的优势发挥到淋漓尽致而打造。\r\n		</p>\r\n		<p style=\"font-family:tahoma, \"text-align:center;\">\r\n			<img src=\"http://goodsimg.1yyg.com/GoodsInfo/20141024154942167.jpg\" />\r\n		</p>\r\n	</div>\r\n</div>', '', '4', '1478666839', '1478666839', '1', '6666.00', '2', 'btc');

-- ----------------------------
-- Table structure for `qq3479015851_shop_addr`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_shop_addr`;
CREATE TABLE `qq3479015851_shop_addr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `truename` varchar(50) NOT NULL DEFAULT '0',
  `moble` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_shop_addr
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_shop_coin`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_shop_coin`;
CREATE TABLE `qq3479015851_shop_coin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `shopid` int(11) unsigned NOT NULL COMMENT '商品id',
  `cny` varchar(50) NOT NULL COMMENT '人民币',
  `ltc` varchar(200) NOT NULL,
  `btc` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shopid` (`shopid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品付款方式表';

-- ----------------------------
-- Records of qq3479015851_shop_coin
-- ----------------------------
INSERT INTO `qq3479015851_shop_coin` VALUES ('1', '1', '1', '', '');
INSERT INTO `qq3479015851_shop_coin` VALUES ('2', '2', '1', '', '');
INSERT INTO `qq3479015851_shop_coin` VALUES ('3', '3', '1', '', '');
INSERT INTO `qq3479015851_shop_coin` VALUES ('4', '4', '1', '', '');

-- ----------------------------
-- Table structure for `qq3479015851_shop_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_shop_log`;
CREATE TABLE `qq3479015851_shop_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `shopid` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL DEFAULT '0.00000000',
  `coinname` varchar(50) NOT NULL DEFAULT '0.00',
  `num` decimal(20,8) unsigned NOT NULL DEFAULT '0.00000000',
  `mum` decimal(20,8) unsigned NOT NULL DEFAULT '0.00000000',
  `addr` varchar(50) NOT NULL DEFAULT '0.0000',
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `xuyao` decimal(20,8) unsigned NOT NULL COMMENT '价',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物记录表';

-- ----------------------------
-- Records of qq3479015851_shop_log
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_shop_type`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_shop_type`;
CREATE TABLE `qq3479015851_shop_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品分类';

-- ----------------------------
-- Records of qq3479015851_shop_type
-- ----------------------------
INSERT INTO `qq3479015851_shop_type` VALUES ('1', 'bjp', '保健品', '保健品', '1', '1475942400', '1475942400', '1');
INSERT INTO `qq3479015851_shop_type` VALUES ('2', 'ryp', '日用品', '日用品', '2', '1476115200', '1476115200', '1');

-- ----------------------------
-- Table structure for `qq3479015851_text`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_text`;
CREATE TABLE `qq3479015851_text` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_text
-- ----------------------------
INSERT INTO `qq3479015851_text` VALUES ('1', 'game_vote', '37', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>37请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1469733741', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('2', 'finance_index', '36财务中心', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span><span style=\"color:#CC33E5;\">财务中心</span><span style=\"color:#CC33E5;\"></span></span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\"><span style=\"color:#EE33EE;\"></span></span>', '0', '1475325266', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('3', 'finance_myzr', '34币创币钱包地址', '<span style=\"color:#CC33E5;line-height:21px;background-color:#FFFFFF;\"><span style=\"color:#CC33E5;\"><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:normal;background-color:#FFFFFF;\">币创币钱包地址</span></span></span>', '0', '1475325312', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('4', 'finance_myzc', '33转出虚拟币', '<p>\r\n	<span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;\">转出说明：</span> \r\n</p>\r\n<p>\r\n	<span style=\"color:#333333;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:20px;line-height:21px;background-color:#FFFFFF;\"><span style=\"font-size:14px;color:#CC33E5;\">1：为了安全，转出是由人工</span><span style=\"font-size:14px;color:#CC33E5;\">处理，您提交后我们会在短时间内为你处理</span></span> \r\n</p>\r\n<p>\r\n	<span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;\">2：为了加快转币速度，我们会为每次转币支付网络费，但由于网络的不确定性，部分转币仍会较慢，请耐心等待</span> \r\n</p>\r\n<p>\r\n	<span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:12px;line-height:21px;background-color:#FFFFFF;\"><span style=\"font-size:14px;color:#CC33E5;\">3：转出的服务费为每次</span><span class=\"coin-feerate\" style=\"font-weight:700;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#CC33E5;line-height:24px;font-size:14px;background-color:#FFFFFF;\">1.00%</span></span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:12px;line-height:21px;background-color:#FFFFFF;\"><span class=\"coin-feerate\" style=\"font-weight:700;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#333333;line-height:24px;background-color:#FFFFFF;\"><span style=\"color:#333333;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:24px;background-color:#FFFFFF;\"><span style=\"font-size:14px;color:#CC33E5;\">4：转出</span></span></span></span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:24px;font-weight:700;font-size:14px;color:#CC33E5;background-color:#FFFFFF;\">虚拟币</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:24px;font-weight:700;color:#CC33E5;font-size:14px;background-color:#FFFFFF;\">的单次不低于</span><span class=\"coin-min\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:24px;font-weight:700;color:#CC33E5;font-size:14px;background-color:#FFFFFF;\">10</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:24px;font-weight:700;color:#CC33E5;font-size:14px;background-color:#FFFFFF;\">，不高于</span><span class=\"coin-limit\" style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:24px;font-weight:700;color:#CC33E5;font-size:14px;background-color:#FFFFFF;\">300000</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:24px;font-weight:700;font-size:14px;color:#CC33E5;background-color:#FFFFFF;\"></span>\r\n</p>', '0', '1475325321', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('5', 'finance_mywt', '32委托管理', '<span style=\"color:#CC33E5;\"><span style=\"line-height:21px;color:#CC33E5;background-color:#FFFFFF;\">请在此查询您的委托记录</span></span>', '0', '1475325496', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('6', 'finance_mycj', '30成交查询', '<span style=\"color:#9933E5;font-size:14px;\"><span style=\"line-height:21px;color:#9933E5;font-size:14px;background-color:#FFFFFF;\">查询全部买入卖出的成交记录</span></span>', '0', '1475325508', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('7', 'finance_mycz', '29人民币充值', '<span style=\"color:#9933E5;line-height:21px;\"><span style=\"color:#9933E5;\"><span style=\"color:#9933E5;font-family:\'Microsoft YaHei\';font-size:14px;line-height:34px;\">只允许使用本人的支付宝进行</span></span></span><span style=\"color:#0096E0;line-height:21px;\"><span><span style=\"color:#FF0D00;font-family:\'Microsoft YaHei\';font-size:14px;line-height:34px;\"><span style=\"color:#9933E5;\"></span><span style=\"color:#9933E5;\">转账充值，请确保汇款人姓名与帐号注册的身份证姓名一致</span></span></span></span><span style=\"color:#9933E5;font-family:\'Microsoft YaHei\';font-size:14px;line-height:34px;\">。充值限额100至50000，充值到账时间为每天早上：09点至11点 &nbsp;-下午16点至18点，请提前做好充值准备</span>', '0', '1475325515', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('8', 'user_index', '28安全中心', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span><span style=\"color:#CC33E5;line-height:21px;background-color:#FFFFFF;\">请在安全中心邦定您的手机跟支付宝等</span></span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\"><span style=\"color:#EE33EE;\"></span></span>', '0', '1475325658', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('9', 'finance_mytx', '27人民币提现', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span> \r\n<h3 style=\"font-family:\'Microsoft YaHei\';font-weight:500;font-size:24px;background-color:#FFFFFF;\">\r\n	<span style=\"color:#9933E5;\">提现须知</span> \r\n</h3>\r\n<p style=\"color:#999999;font-family:\'Microsoft YaHei\';font-size:14px;background-color:#FFFFFF;\">\r\n	1. 提现手续费率1％，每笔提现最低收费2元 。\r\n</p>\r\n<p style=\"color:#999999;font-family:\'Microsoft YaHei\';font-size:14px;background-color:#FFFFFF;\">\r\n	2. 单笔提现限额100元——50000元。\r\n</p>\r\n<p style=\"color:#999999;font-family:\'Microsoft YaHei\';font-size:14px;background-color:#FFFFFF;\">\r\n	3. 人民币提现12小时内到帐，在已汇出12小时后 仍未收到款项，请联系客服。\r\n</p>\r\n</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\"><span style=\"color:#EE33EE;\"></span></span>', '0', '1475325679', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('10', 'user_moble', '26手机绑定', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span> \r\n<h1 style=\"font-weight:normal;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:20px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"color:#9933E5;\">请绑定您的手机方便进行充值与提现</span> \r\n</h1>\r\n</span></span>', '0', '1475351892', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('11', 'finance_mytj', '25推荐用户', '<span style=\"color:#9933E5;line-height:21px;font-size:14px;background-color:#FFFFFF;\"><span style=\"color:#9933E5;font-size:14px;\"><span style=\"color:#9933E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30.8px;font-size:14px;background-color:#FFFFFF;\">这是您的专用邀请码：<span style=\"color:#666666;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:14px;line-height:normal;background-color:#FFFFFF;\">奖励下线金额三级分红:一代0.3% 二代0.2% 三代0.1</span></span></span></span>', '0', '1475352280', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('12', 'finance_mywd', '24我的推荐', '<span style=\"color:#CC33E5;\"><span style=\"line-height:21px;color:#CC33E5;background-color:#FFFFFF;\">查询自己下家推荐的人员信息</span></span>', '0', '1475352284', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('13', 'finance_myjp', '23我的奖品', '<span><span style=\"line-height:21px;color:#CC33E5;background-color:#FFFFFF;\">下级充值奖励查看</span></span><span style=\"color:#CC33E5;\"></span>', '0', '1475352285', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('14', 'game_issue', '22认购中心', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">币创币众筹时间：</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#CC33E5;line-height:30px;background-color:#FFFFFF;\">12</span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">月</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#CC33E5;line-height:30px;background-color:#FFFFFF;\">12</span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">日</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#CC33E5;line-height:30px;background-color:#FFFFFF;\">20:00</span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">至</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#CC33E5;line-height:30px;background-color:#FFFFFF;\">12</span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">月</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#CC33E5;line-height:30px;background-color:#FFFFFF;\">15</span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">日</span><span style=\"font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;color:#CC33E5;line-height:30px;background-color:#FFFFFF;\">22:00</span><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;background-color:#FFFFFF;\">共四天</span></span></span><span style=\"color:#0096E0;line-height:21px;\"><span><span style=\"color:#E53333;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:30px;\"><span style=\"font-size:16px;color:#E53333;\">（限购总量200W币）</span></span></span></span>', '0', '1475352288', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('15', 'game_issue_log', '21认购记录', '<span><span style=\"line-height:21px;background-color:#FFFFFF;\">查询您的认购数量记录</span></span>', '0', '1475352293', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('16', 'game_fenhong', '20', '<br />', '0', '1475352294', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('17', 'game_fenhong_log', '19分红记录', '<span><span style=\"font-size:14px;color:#9933E5;\">持有</span><span style=\"color:#9933E5;font-size:14px;\">分红币</span><span style=\"font-size:14px;color:#9933E5;\">（</span><span style=\"font-size:14px;color:#9933E5;\">THC</span><span style=\"font-size:14px;color:#9933E5;\">）每周六分红为：平台交易</span><span style=\"font-size:14px;color:#9933E5;\">THC</span><span style=\"font-size:14px;color:#9933E5;\">币成交额收入的</span><span style=\"font-size:14px;color:#9933E5;\">0.5%.</span><span style=\"font-size:14px;color:#9933E5;\">每天分红时间10：00至14：00官方会发放到个人</span></span><span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;\"></span><span style=\"font-size:14px;color:#9933E5;\"><span>账户</span></span></span>', '0', '1475352296', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('18', 'game_money', '18', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>18请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1475352297', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('19', 'game_money_log', '17', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>17请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1475352298', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('20', 'user_paypassword', '16修改交易密码', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span> \r\n<h1 style=\"font-weight:normal;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:20px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"color:#9933E5;\">请在下面修改您的交易密码</span> \r\n</h1>\r\n</span></span>', '0', '1475352694', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('21', 'user_password', '69', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1475352695', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('22', 'user_nameauth', '15实名认证', '<span style=\"color:#9933E5;\"><span style=\"line-height:21px;color:#9933E5;background-color:#FFFFFF;\">请您实名注册如有错误请联系客服进行修改</span></span>', '0', '1475352696', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('23', 'user_tpwdset', '交易密码输入设置', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>\r\n<h1 style=\"font-weight:normal;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:20px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"color:#CC33E5;\">请牢记您的交易密码</span>\r\n</h1>\r\n</span></span>', '0', '1475352698', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('24', 'game_shop', '13', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>13请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1475352702', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('25', 'game_issue_buy', '12', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>12请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1475352722', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('26', 'game_huafei', '11话费充值', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>\r\n<h1 style=\"font-weight:normal;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:20px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"color:#CC33E5;\">话费充值目前不开放</span>\r\n</h1>\r\n</span></span>', '0', '1475359119', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('27', 'user_bank', '支付宝管理', '<span style=\"font-size:14px;color:#CC33E5;\">请绑定您的的支付宝一但绑定不可修改</span>', '0', '1475359192', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('28', 'user_qianbao', '9钱包地址管理', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>\r\n<h1 style=\"font-weight:normal;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:20px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"color:#CC33E5;\">目前还不提供转入转出钱包</span>\r\n</h1>\r\n</span></span>', '0', '1475359195', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('29', 'user_log', '8', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>8请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1475359241', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('30', 'user_ga', '7', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>7请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1475395398', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('31', 'user_alipay', '6绑定支付宝', '<span style=\"color:#CC33E5;line-height:21px;background-color:#FFFFFF;\"><span style=\"color:#CC33E5;\"><span style=\"color:#CC33E5;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;line-height:34px;background-color:#FFFFFF;\">请绑定您的真实支付宝</span></span></span>', '0', '1475395410', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('32', 'user_goods', '5联系地址管理', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>\r\n<h1 style=\"font-weight:normal;font-family:tahoma, \'Microsoft YaHei\', Arial, Helvetica, sans-serif;font-size:20px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"color:#CC33E5;\">联系地址填写好后期会推出一元夺宝游戏以便收货</span>\r\n</h1>\r\n</span></span>', '0', '1475395413', '0', '1');
INSERT INTO `qq3479015851_text` VALUES ('33', 'game_shop_view', '3', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>3请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1476000366', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('34', 'game_shop_log', '2', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>2请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1476002906', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('35', 'game_shop_goods', '1', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>1请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1476002907', '0', '0');
INSERT INTO `qq3479015851_text` VALUES ('36', 'finance_myaward', '', '<span style=\"color:#0096E0;line-height:21px;background-color:#FFFFFF;\"><span>请在后台修改此处内容</span></span><span style=\"color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;\">,<span style=\"color:#EE33EE;\">详细信息</span></span>', '0', '1482927855', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_trade`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_trade`;
CREATE TABLE `qq3479015851_trade` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `market` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `deal` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `fee` decimal(20,8) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `market` (`market`,`type`,`status`),
  KEY `num` (`num`,`deal`),
  KEY `status` (`status`),
  KEY `market_2` (`market`)
) ENGINE=MyISAM AUTO_INCREMENT=159 DEFAULT CHARSET=utf8 COMMENT='交易下单表';

-- ----------------------------
-- Records of qq3479015851_trade
-- ----------------------------
INSERT INTO `qq3479015851_trade` VALUES ('1', '0', 'ltc_cny', '332.66400000', '89.03890000', '39.94000000', '29620.03660000', '0.00000000', '2', '0', '1498130000', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('2', '0', 'ltc_cny', '332.83600000', '33.20210000', '27.68000000', '11050.85420000', '0.00000000', '2', '0', '1498130129', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('3', '0', 'ltc_cny', '332.54000000', '93.83610000', '93.84000000', '31204.25670000', '0.00000000', '1', '0', '1498130219', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('4', '0', 'ltc_cny', '333.89700000', '83.67660000', '83.68000000', '27939.36570000', '0.00000000', '2', '0', '1498130310', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('5', '0', 'ltc_cny', '333.19700000', '31.88920000', '31.89000000', '10625.38580000', '0.00000000', '1', '0', '1498130401', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('6', '0', 'ltc_cny', '333.57300000', '69.39880000', '7.87000000', '23149.56590000', '0.00000000', '2', '0', '1498130492', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('7', '0', 'ltc_cny', '332.70200000', '21.86130000', '21.86000000', '7273.29820000', '0.00000000', '2', '0', '1498130583', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('8', '0', 'ltc_cny', '333.75700000', '38.38200000', '38.38000000', '12810.26120000', '0.00000000', '2', '0', '1498130673', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('9', '0', 'ltc_cny', '333.08600000', '85.38130000', '67.71000000', '28439.31570000', '0.00000000', '2', '0', '1498130764', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('10', '0', 'ltc_cny', '332.66400000', '8.05010000', '8.05000000', '2677.97850000', '0.00000000', '1', '0', '1498130855', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('11', '0', 'ltc_cny', '332.87400000', '77.18070000', '53.47000000', '25691.44830000', '0.00000000', '2', '0', '1498130945', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('12', '0', 'ltc_cny', '332.98900000', '61.12350000', '21.86000000', '20353.45310000', '0.00000000', '1', '0', '1498131036', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('13', '0', 'ltc_cny', '332.91000000', '24.33460000', '24.33000000', '8101.23170000', '0.00000000', '2', '0', '1498131127', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('14', '0', 'ltc_cny', '332.63100000', '20.35990000', '20.36000000', '6772.33390000', '0.00000000', '1', '0', '1498131217', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('15', '0', 'ltc_cny', '333.13000000', '88.00710000', '88.01000000', '29317.80520000', '0.00000000', '2', '0', '1498131308', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('16', '0', 'ltc_cny', '332.80800000', '41.95000000', '29.18000000', '13961.29560000', '0.00000000', '1', '0', '1498131398', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('17', '0', 'ltc_cny', '331.43600000', '29.18260000', '29.18000000', '9672.16420000', '0.00000000', '2', '0', '1498131489', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('18', '0', 'ltc_cny', '331.70300000', '98.52850000', '0.00000000', '32682.19900000', '0.00000000', '1', '0', '1498131579', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('19', '0', 'ltc_cny', '331.97700000', '63.52210000', '0.00000000', '21087.87620000', '0.00000000', '1', '0', '1498131670', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('20', '0', 'ltc_cny', '332.17000000', '51.34980000', '51.35000000', '17056.86310000', '0.00000000', '2', '0', '1498131761', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('21', '0', 'ltc_cny', '333.26300000', '31.54820000', '11.44000000', '10513.84780000', '0.00000000', '2', '0', '1498131851', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('22', '0', 'ltc_cny', '332.70400000', '60.34890000', '6.42000000', '20078.32040000', '0.00000000', '1', '0', '1498131942', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('23', '0', 'ltc_cny', '331.27000000', '40.32000000', '0.00000000', '13356.80640000', '0.00000000', '1', '0', '1498132033', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('24', '0', 'ltc_cny', '331.48400000', '6.42310000', '6.42000000', '2129.15490000', '0.00000000', '2', '0', '1498132124', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('25', '0', 'ltc_cny', '331.62800000', '15.27570000', '15.28000000', '5065.84980000', '0.00000000', '2', '0', '1498132215', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('26', '0', 'ltc_cny', '332.36500000', '62.01180000', '62.01000000', '20610.55190000', '0.00000000', '1', '0', '1498132306', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('27', '0', 'ltc_cny', '332.46600000', '76.70220000', '76.70000000', '25500.87360000', '0.00000000', '2', '0', '1498132396', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('28', '0', 'ltc_cny', '333.42500000', '72.51220000', '29.13000000', '24177.38030000', '0.00000000', '1', '0', '1498132487', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('29', '0', 'ltc_cny', '333.71400000', '10.54440000', '10.54000000', '3518.81390000', '0.00000000', '2', '0', '1498132578', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('30', '0', 'ltc_cny', '333.79800000', '32.51720000', '32.52000000', '10854.17630000', '0.00000000', '2', '0', '1498132669', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('31', '0', 'ltc_cny', '331.63100000', '96.37520000', '0.00000000', '31961.00400000', '0.00000000', '1', '0', '1498132760', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('32', '0', 'ltc_cny', '332.29000000', '4.76930000', '0.00000000', '1584.79070000', '0.00000000', '1', '0', '1498132851', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('33', '0', 'ltc_cny', '334.95300000', '27.68420000', '27.68000000', '9272.90580000', '0.00000000', '1', '0', '1498132948', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('34', '0', 'ltc_cny', '335.57900000', '6.25570000', '6.26000000', '2099.28160000', '0.00000000', '1', '0', '1498133041', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('35', '0', 'ltc_cny', '334.94800000', '21.88820000', '21.89000000', '7331.40880000', '0.00000000', '1', '0', '1498133132', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('36', '0', 'ltc_cny', '331.94900000', '53.74840000', '53.75000000', '17841.72760000', '0.00000000', '2', '0', '1498133224', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('37', '0', 'ltc_cny', '333.50200000', '25.32450000', '25.32000000', '8445.77140000', '0.00000000', '1', '0', '1498133316', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('38', '1', 'ltc_cny', '332.91000000', '3.03000000', '0.00000000', '1008.71730000', '0.00000000', '1', '0', '1498133378', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('39', '0', 'ltc_cny', '329.42600000', '20.07880000', '8.26000000', '6614.47880000', '0.00000000', '2', '0', '1498133407', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('40', '1', 'ltc_cny', '333.22000000', '2.73000000', '0.00000000', '909.69060000', '0.00000000', '1', '0', '1498133416', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('41', '0', 'ltc_cny', '332.00800000', '76.55570000', '0.00000000', '25417.10480000', '0.00000000', '1', '0', '1498133499', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('42', '0', 'ltc_cny', '332.59100000', '30.99790000', '31.00000000', '10309.62260000', '0.00000000', '1', '0', '1498133590', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('43', '0', 'ltc_cny', '332.37800000', '18.84960000', '18.85000000', '6265.19230000', '0.00000000', '2', '0', '1498133681', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('44', '0', 'ltc_cny', '331.69700000', '87.17270000', '0.00000000', '28914.92310000', '0.00000000', '1', '0', '1498133773', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('45', '0', 'ltc_cny', '333.27900000', '35.79210000', '35.79000000', '11928.75530000', '0.00000000', '2', '0', '1498133865', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('46', '0', 'ltc_cny', '333.22900000', '16.86380000', '6.03000000', '5619.50720000', '0.00000000', '2', '0', '1498133957', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('47', '0', 'ltc_cny', '335.25300000', '46.26560000', '0.00000000', '15510.68120000', '0.00000000', '2', '0', '1498134048', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('48', '0', 'ltc_cny', '335.30100000', '91.91000000', '24.33000000', '30817.51490000', '0.00000000', '1', '0', '1498134140', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('49', '0', 'ltc_cny', '333.90100000', '87.42990000', '87.43000000', '29192.93100000', '0.00000000', '2', '0', '1498134231', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('50', '0', 'ltc_cny', '332.93500000', '42.00680000', '41.92000000', '13985.53400000', '0.00000000', '1', '0', '1498134322', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('51', '0', 'ltc_cny', '333.15400000', '67.71210000', '67.71000000', '22558.55700000', '0.00000000', '1', '0', '1498134413', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('52', '0', 'ltc_cny', '334.25600000', '94.04240000', '94.04000000', '31434.23650000', '0.00000000', '1', '0', '1498134504', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('53', '0', 'ltc_cny', '332.35700000', '38.63920000', '0.00000000', '12842.00860000', '0.00000000', '1', '0', '1498134596', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('54', '0', 'ltc_cny', '333.24500000', '89.59820000', '89.60000000', '29858.15220000', '0.00000000', '2', '0', '1498134688', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('55', '0', 'ltc_cny', '333.62500000', '69.41680000', '20.06000000', '23159.17990000', '0.00000000', '2', '0', '1498134779', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('56', '0', 'ltc_cny', '333.56900000', '93.12430000', '25.76000000', '31063.37960000', '0.00000000', '2', '0', '1498134870', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('57', '0', 'ltc_cny', '332.81900000', '24.67550000', '24.68000000', '8212.47520000', '0.00000000', '1', '0', '1498134962', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('58', '0', 'ltc_cny', '334.28700000', '11.07670000', '11.08000000', '3702.79680000', '0.00000000', '1', '0', '1498135053', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('59', '3', 'ltc_cny', '333.24500000', '1.00000000', '0.00000000', '333.24500000', '0.00000000', '1', '0', '1498135127', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('60', '0', 'ltc_cny', '334.11300000', '46.02030000', '41.23000000', '15375.98050000', '0.00000000', '2', '0', '1498135144', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('61', '0', 'ltc_cny', '333.44700000', '56.71520000', '50.29000000', '18911.51330000', '0.00000000', '2', '0', '1498135235', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('62', '0', 'ltc_cny', '332.67400000', '3.87200000', '3.87000000', '1288.11370000', '0.00000000', '1', '0', '1498135326', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('63', '0', 'ltc_cny', '332.00500000', '10.59820000', '10.60000000', '3518.65540000', '0.00000000', '2', '0', '1498135417', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('64', '0', 'ltc_cny', '332.07300000', '31.32090000', '31.32000000', '10400.82520000', '0.00000000', '2', '0', '1498135508', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('65', '0', 'ltc_cny', '332.04600000', '10.88530000', '0.00000000', '3614.42030000', '0.00000000', '1', '0', '1498135601', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('66', '0', 'ltc_cny', '332.74100000', '14.46820000', '14.47000000', '4814.16330000', '0.00000000', '2', '0', '1498135692', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('67', '0', 'ltc_cny', '332.37700000', '62.84620000', '14.08000000', '20888.63140000', '0.00000000', '2', '0', '1498135783', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('68', '0', 'ltc_cny', '333.38500000', '89.96310000', '89.96000000', '29992.34810000', '0.00000000', '1', '0', '1498135874', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('69', '0', 'ltc_cny', '332.78900000', '56.73010000', '56.73000000', '18879.15320000', '0.00000000', '2', '0', '1498135966', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('70', '0', 'ltc_cny', '332.91200000', '28.87750000', '28.88000000', '9613.66630000', '0.00000000', '1', '0', '1498136058', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('71', '0', 'ltc_cny', '333.85200000', '65.60360000', '27.85000000', '21901.89310000', '0.00000000', '1', '0', '1498136149', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('72', '0', 'ltc_cny', '332.58500000', '48.03910000', '48.04000000', '15977.08410000', '0.00000000', '2', '0', '1498136240', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('73', '0', 'ltc_cny', '333.21700000', '99.61120000', '80.23000000', '33192.14520000', '0.00000000', '1', '0', '1498136331', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('74', '0', 'ltc_cny', '333.89300000', '17.59650000', '17.60000000', '5875.34820000', '0.00000000', '1', '0', '1498136421', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('75', '0', 'ltc_cny', '333.84500000', '19.37900000', '18.19000000', '6469.58230000', '0.00000000', '1', '0', '1498136512', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('76', '0', 'ltc_cny', '333.79500000', '50.29410000', '50.29000000', '16787.91910000', '0.00000000', '1', '0', '1498136603', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('77', '0', 'ltc_cny', '333.99100000', '25.76420000', '25.76000000', '8605.01090000', '0.00000000', '1', '0', '1498136696', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('78', '0', 'ltc_cny', '334.56700000', '7.87360000', '7.87000000', '2634.24670000', '0.00000000', '1', '0', '1498136788', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('79', '0', 'ltc_cny', '333.98100000', '20.06380000', '20.06000000', '6700.92800000', '0.00000000', '1', '0', '1498136879', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('80', '0', 'ltc_cny', '333.67500000', '89.23630000', '89.24000000', '29775.92240000', '0.00000000', '2', '0', '1498136970', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('81', '0', 'ltc_cny', '333.69900000', '48.01520000', '48.02000000', '16022.62420000', '0.00000000', '1', '0', '1498137061', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('82', '0', 'ltc_cny', '334.91000000', '69.07580000', '51.76000000', '23134.17620000', '0.00000000', '1', '0', '1498137152', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('83', '0', 'ltc_cny', '333.92200000', '61.68880000', '61.69000000', '20599.24750000', '0.00000000', '2', '0', '1498137243', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('84', '0', 'ltc_cny', '333.01500000', '14.74030000', '14.74000000', '4908.74100000', '0.00000000', '1', '0', '1498137333', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('85', '0', 'ltc_cny', '333.64300000', '2.39160000', '2.39000000', '797.94060000', '0.00000000', '2', '0', '1498137427', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('86', '0', 'ltc_cny', '334.98100000', '54.08030000', '0.00000000', '18115.87300000', '0.00000000', '2', '0', '1498137520', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('87', '0', 'ltc_cny', '333.95200000', '18.90040000', '5.27000000', '6311.82640000', '0.00000000', '2', '0', '1498137612', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('88', '0', 'ltc_cny', '333.14200000', '44.34250000', '44.34000000', '14772.34910000', '0.00000000', '2', '0', '1498137703', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('89', '0', 'ltc_cny', '333.72300000', '53.37750000', '2.39000000', '17813.29940000', '0.00000000', '1', '0', '1498137795', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('90', '0', 'ltc_cny', '332.39200000', '95.84580000', '57.87000000', '31858.37720000', '0.00000000', '1', '0', '1498137886', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('91', '7', 'ltc_cny', '1.00000000', '1.00000000', '0.00000000', '1.00000000', '0.00000000', '1', '0', '1498137901', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('92', '7', 'ltc_cny', '333.75700000', '0.10000000', '0.00000000', '33.37570000', '0.00000000', '1', '0', '1498137959', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('93', '0', 'ltc_cny', '331.56700000', '55.44410000', '0.00000000', '18383.43390000', '0.00000000', '1', '0', '1498137977', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('94', '7', 'ltc_cny', '2.00000000', '2.00000000', '0.00000000', '4.00000000', '0.00000000', '1', '0', '1498137984', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('95', '0', 'ltc_cny', '332.97400000', '63.02560000', '63.03000000', '20985.88610000', '0.00000000', '1', '0', '1498138069', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('96', '7', 'ltc_cny', '333.75700000', '0.30000000', '0.00000000', '100.12710000', '0.00000000', '1', '0', '1498138101', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('97', '0', 'ltc_cny', '332.45400000', '92.45730000', '14.74000000', '30737.79920000', '0.00000000', '2', '0', '1498138160', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('98', '0', 'ltc_cny', '333.45400000', '95.68130000', '20.94000000', '31905.31220000', '0.00000000', '2', '0', '1498138251', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('99', '0', 'ltc_cny', '332.27400000', '47.10900000', '47.11000000', '15653.09590000', '0.00000000', '2', '0', '1498138343', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('100', '0', 'ltc_cny', '333.81300000', '20.94010000', '20.94000000', '6990.07760000', '0.00000000', '1', '0', '1498138435', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('101', '0', 'ltc_cny', '332.73000000', '84.53490000', '84.53000000', '28127.29730000', '0.00000000', '2', '0', '1498138526', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('102', '0', 'ltc_cny', '332.36000000', '92.04760000', '0.00000000', '30592.94030000', '0.00000000', '1', '0', '1498138617', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('103', '0', 'ltc_cny', '332.13600000', '57.86960000', '57.87000000', '19220.57750000', '0.00000000', '2', '0', '1498138714', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('104', '7', 'ltc_cny', '1.00000000', '0.20000000', '0.00000000', '1.20000000', '1.00000000', '1', '0', '1498138741', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('105', '7', 'ltc_cny', '332.73000000', '0.20000000', '0.00000000', '67.54600000', '1.00000000', '1', '0', '1498138800', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('106', '0', 'ltc_cny', '332.90500000', '92.23300000', '6.61000000', '30704.82690000', '0.00000000', '2', '0', '1498138807', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('107', '7', 'ltc_cny', '332.73000000', '0.30000000', '0.00000000', '100.81900000', '1.00000000', '1', '0', '1498138810', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('108', '7', 'ltc_cny', '332.73000000', '0.40000000', '0.00000000', '134.42292000', '1.33092000', '1', '0', '1498138878', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('109', '0', 'ltc_cny', '332.80400000', '69.53040000', '68.61000000', '23139.99520000', '0.00000000', '1', '0', '1498138898', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('110', '7', 'ltc_cny', '332.90500000', '0.10000000', '0.00000000', '34.29050000', '1.00000000', '1', '0', '1498138982', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('111', '0', 'ltc_cny', '332.00400000', '38.58240000', '0.00000000', '12809.51110000', '0.00000000', '1', '0', '1498138989', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('112', '7', 'ltc_cny', '332.90500000', '0.20000000', '0.00000000', '67.58100000', '1.00000000', '1', '0', '1498138990', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('113', '7', 'ltc_cny', '332.90500000', '0.10000000', '0.00000000', '34.29050000', '1.00000000', '1', '0', '1498139072', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('114', '7', 'ltc_cny', '332.90500000', '0.20000000', '0.00000000', '67.58100000', '1.00000000', '1', '0', '1498139077', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('115', '0', 'ltc_cny', '332.44900000', '92.42150000', '92.42000000', '30725.43530000', '0.00000000', '2', '0', '1498139081', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('116', '7', 'ltc_cny', '332.90500000', '0.10000000', '0.00000000', '34.29050000', '1.00000000', '1', '0', '1498139110', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('117', '7', 'ltc_cny', '332.90500000', '0.20000000', '0.00000000', '67.58100000', '1.00000000', '1', '0', '1498139119', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('118', '0', 'ltc_cny', '332.08900000', '59.00010000', '0.00000000', '19593.28420000', '0.00000000', '1', '0', '1498139172', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('119', '0', 'ltc_cny', '332.48500000', '14.36050000', '14.36000000', '4774.65080000', '0.00000000', '2', '0', '1498139263', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('120', '0', 'ltc_cny', '332.00200000', '29.01810000', '0.00000000', '9634.06720000', '0.00000000', '1', '0', '1498139355', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('121', '7', 'ltc_cny', '333.24500000', '1.00000000', '0.10000000', '329.91255000', '3.33245000', '2', '0', '1498139403', '0', '2');
INSERT INTO `qq3479015851_trade` VALUES ('122', '3', 'btc_cny', '1.00000000', '1.00000000', '0.00000000', '2.00000000', '1.00000000', '1', '0', '1498139436', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('123', '7', 'ltc_cny', '333.24500000', '0.10000000', '0.10000000', '34.32450000', '1.00000000', '1', '0', '1498139436', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('124', '0', 'ltc_cny', '333.53100000', '86.11700000', '8.94000000', '28722.68910000', '0.00000000', '2', '0', '1498139446', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('125', '7', 'ltc_cny', '333.88800000', '0.90000000', '0.10000000', '297.49420800', '3.00499200', '2', '0', '1498139494', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('126', '7', 'ltc_cny', '333.88800000', '0.10000000', '0.10000000', '34.38880000', '1.00000000', '1', '0', '1498139523', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('127', '0', 'ltc_cny', '333.39900000', '59.97510000', '3.77000000', '19995.63840000', '0.00000000', '2', '0', '1498139539', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('128', '0', 'ltc_cny', '333.43800000', '83.59280000', '83.59000000', '27873.01600000', '0.00000000', '2', '0', '1498139630', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('129', '3', 'btc_cny', '10000.00000000', '10.00000000', '0.00000000', '99000.00000000', '1000.00000000', '2', '0', '1498139717', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('130', '0', 'ltc_cny', '333.20400000', '93.56990000', '92.42000000', '31177.86500000', '0.00000000', '1', '0', '1498139723', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('131', '3', 'btc_cny', '8000.00000000', '1.00000000', '1.00000000', '7920.00000000', '80.00000000', '2', '0', '1498139741', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('132', '3', 'btc_cny', '9000.00000000', '1.00000000', '1.00000000', '9090.00000000', '90.00000000', '1', '0', '1498139755', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('133', '3', 'btc_cny', '1000.00000000', '10.00000000', '2.00000000', '9900.00000000', '100.00000000', '2', '0', '1498139800', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('134', '0', 'ltc_cny', '334.21100000', '47.43790000', '14.36000000', '15854.26800000', '0.00000000', '1', '0', '1498139814', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('135', '3', 'btc_cny', '2000.00000000', '2.00000000', '2.00000000', '4040.00000000', '40.00000000', '1', '0', '1498139814', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('136', '3', 'btc_cny', '500.00000000', '10.00000000', '2.00000000', '5050.00000000', '50.00000000', '1', '0', '1498139846', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('137', '3', 'btc_cny', '700.00000000', '10.00000000', '10.00000000', '7070.00000000', '70.00000000', '1', '0', '1498139870', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('138', '0', 'ltc_cny', '334.03700000', '6.61150000', '6.61000000', '2208.48560000', '0.00000000', '1', '0', '1498139906', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('139', '3', 'btc_cny', '12.00000000', '12.00000000', '12.00000000', '142.56000000', '1.44000000', '2', '0', '1498139916', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('140', '0', 'ltc_cny', '334.72700000', '39.71290000', '0.00000000', '13292.97990000', '0.00000000', '2', '0', '1498139998', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('141', '0', 'ltc_cny', '334.98600000', '92.91490000', '0.00000000', '31125.19070000', '0.00000000', '2', '0', '1498140089', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('142', '0', 'ltc_cny', '334.86400000', '76.19980000', '0.00000000', '25516.56980000', '0.00000000', '2', '0', '1498140180', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('143', '0', 'ltc_cny', '334.60100000', '48.80770000', '0.00000000', '16331.10520000', '0.00000000', '2', '0', '1498140271', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('144', '0', 'ltc_cny', '334.84000000', '3.77340000', '3.77000000', '1263.48530000', '0.00000000', '1', '0', '1498140362', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('145', '0', 'ltc_cny', '335.25400000', '85.96150000', '83.59000000', '28818.93670000', '0.00000000', '1', '0', '1498140453', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('146', '0', 'ltc_cny', '333.03600000', '51.43060000', '0.00000000', '17128.24130000', '0.00000000', '1', '0', '1498140545', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('147', '0', 'ltc_cny', '334.61100000', '8.94130000', '8.94000000', '2991.85730000', '0.00000000', '1', '0', '1498140637', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('148', '0', 'ltc_cny', '333.55000000', '45.71530000', '0.00000000', '15248.33830000', '0.00000000', '1', '0', '1498140729', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('149', '0', 'ltc_cny', '336.08700000', '46.34030000', '0.00000000', '15574.37240000', '0.00000000', '2', '0', '1498140820', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('150', '0', 'ltc_cny', '339.68000000', '98.71990000', '38.38000000', '33533.17560000', '0.00000000', '1', '0', '1498140911', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('151', '0', 'ltc_cny', '339.84900000', '90.35190000', '0.00000000', '30706.00290000', '0.00000000', '2', '0', '1498141002', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('152', '0', 'ltc_cny', '339.90700000', '98.57940000', '98.58000000', '33507.82810000', '0.00000000', '1', '0', '1498141092', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('153', '0', 'ltc_cny', '339.76700000', '5.08630000', '5.09000000', '1728.15690000', '0.00000000', '1', '0', '1498141185', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('154', '0', 'ltc_cny', '339.91700000', '13.95680000', '0.00000000', '4744.15360000', '0.00000000', '2', '0', '1498141278', '0', '0');
INSERT INTO `qq3479015851_trade` VALUES ('155', '0', 'ltc_cny', '336.81800000', '80.83540000', '80.84000000', '27226.81780000', '0.00000000', '1', '0', '1498141370', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('156', '0', 'ltc_cny', '337.41700000', '86.08410000', '86.08000000', '29046.23880000', '0.00000000', '1', '0', '1498141461', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('157', '0', 'ltc_cny', '337.13000000', '41.23220000', '41.23000000', '13900.61160000', '0.00000000', '1', '0', '1498141554', '0', '1');
INSERT INTO `qq3479015851_trade` VALUES ('158', '0', 'ltc_cny', '338.98900000', '40.29610000', '0.00000000', '13659.93460000', '0.00000000', '2', '0', '1498141648', '0', '0');

-- ----------------------------
-- Table structure for `qq3479015851_trade_json`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_trade_json`;
CREATE TABLE `qq3479015851_trade_json` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `market` varchar(100) NOT NULL,
  `data` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `market` (`market`)
) ENGINE=MyISAM AUTO_INCREMENT=424 DEFAULT CHARSET=utf8 COMMENT='交易图表表';

-- ----------------------------
-- Records of qq3479015851_trade_json
-- ----------------------------
INSERT INTO `qq3479015851_trade_json` VALUES ('1', 'ltc_cny', '[1498130401,\"31.89000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '1', '0', '1498130401', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('2', 'ltc_cny', '[1498130280,\"31.89000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '3', '0', '1498130280', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('3', 'ltc_cny', '[1498130400,\"31.89000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '5', '0', '1498130400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('4', 'ltc_cny', '[1498130400,\"39.94000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '10', '0', '1498130400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('5', 'ltc_cny', '[1498130100,\"39.94000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '15', '0', '1498130100', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('6', 'ltc_cny', '[1498129200,\"39.94000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '30', '0', '1498129200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('7', 'ltc_cny', '[1498129200,\"240.73000000\",\"332.66400000\",\"332.80800000\",\"332.46600000\",\"332.46600000\"]', '60', '0', '1498129200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('8', 'ltc_cny', '[1498129200,\"865.10000000\",\"332.66400000\",\"333.26300000\",\"332.36500000\",\"332.58500000\"]', '120', '0', '1498129200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('9', 'ltc_cny', '[1498129200,\"1936.66000000\",\"332.66400000\",\"334.11300000\",\"332.36500000\",\"334.11300000\"]', '240', '0', '1498129200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('10', 'ltc_cny', '[1498129200,\"1936.66000000\",\"332.66400000\",\"334.11300000\",\"332.36500000\",\"334.11300000\"]', '360', '0', '1498129200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('11', 'ltc_cny', '[1498129200,\"1936.66000000\",\"332.66400000\",\"334.11300000\",\"332.36500000\",\"334.11300000\"]', '720', '0', '1498129200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('12', 'ltc_cny', '[1498129200,\"1936.66000000\",\"332.66400000\",\"334.11300000\",\"332.36500000\",\"334.11300000\"]', '1440', '0', '1498129200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('13', 'ltc_cny', '[1498129200,\"1936.66000000\",\"332.66400000\",\"334.11300000\",\"332.36500000\",\"334.11300000\"]', '10080', '0', '1498129200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('16', 'ltc_cny', '[1498130700,\"8.05000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '5', '0', '1498130700', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('26', 'ltc_cny', '[1498130820,\"8.05000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '3', '0', '1498130820', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('23', 'ltc_cny', '[1498130821,\"8.05000000\",\"332.66400000\",\"332.66400000\",\"332.66400000\",\"332.66400000\"]', '1', '0', '1498130821', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('31', 'ltc_cny', '[1498131000,\"21.86000000\",\"332.70200000\",\"332.70200000\",\"332.70200000\",\"332.70200000\"]', '3', '0', '1498131000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('30', 'ltc_cny', '[1498131001,\"21.86000000\",\"332.70200000\",\"332.70200000\",\"332.70200000\",\"332.70200000\"]', '1', '0', '1498131001', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('32', 'ltc_cny', '[1498131000,\"21.86000000\",\"332.70200000\",\"332.70200000\",\"332.70200000\",\"332.70200000\"]', '5', '0', '1498131000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('33', 'ltc_cny', '[1498131000,\"51.04000000\",\"332.70200000\",\"332.80800000\",\"332.70200000\",\"332.80800000\"]', '10', '0', '1498131000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('34', 'ltc_cny', '[1498131000,\"102.39000000\",\"332.70200000\",\"332.80800000\",\"332.54000000\",\"332.54000000\"]', '15', '0', '1498131000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('35', 'ltc_cny', '[1498131000,\"200.79000000\",\"332.70200000\",\"332.80800000\",\"332.46600000\",\"332.46600000\"]', '30', '0', '1498131000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('38', 'ltc_cny', '[1498131300,\"29.18000000\",\"332.80800000\",\"332.80800000\",\"332.80800000\",\"332.80800000\"]', '5', '0', '1498131300', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('48', 'ltc_cny', '[1498131360,\"29.18000000\",\"332.80800000\",\"332.80800000\",\"332.80800000\",\"332.80800000\"]', '3', '0', '1498131360', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('46', 'ltc_cny', '[1498131481,\"29.18000000\",\"332.80800000\",\"332.80800000\",\"332.80800000\",\"332.80800000\"]', '1', '0', '1498131481', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('51', 'ltc_cny', '[1498131600,\"51.35000000\",\"332.63100000\",\"332.63100000\",\"332.54000000\",\"332.54000000\"]', '5', '0', '1498131600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('52', 'ltc_cny', '[1498131600,\"57.77000000\",\"332.63100000\",\"332.70400000\",\"332.54000000\",\"332.70400000\"]', '10', '0', '1498131600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('59', 'ltc_cny', '[1498131720,\"51.35000000\",\"332.63100000\",\"332.63100000\",\"332.54000000\",\"332.54000000\"]', '3', '0', '1498131720', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('56', 'ltc_cny', '[1498131721,\"51.35000000\",\"332.63100000\",\"332.63100000\",\"332.54000000\",\"332.54000000\"]', '1', '0', '1498131721', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('61', 'ltc_cny', '[1498131900,\"6.42000000\",\"332.70400000\",\"332.70400000\",\"332.70400000\",\"332.70400000\"]', '5', '0', '1498131900', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('62', 'ltc_cny', '[1498131900,\"98.40000000\",\"332.70400000\",\"332.70400000\",\"332.46600000\",\"332.46600000\"]', '15', '0', '1498131900', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('71', 'ltc_cny', '[1498132080,\"21.70000000\",\"332.70400000\",\"332.70400000\",\"332.54000000\",\"332.54000000\"]', '3', '0', '1498132080', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('77', 'ltc_cny', '[1498132260,\"47.57000000\",\"332.54000000\",\"332.54000000\",\"332.54000000\",\"332.54000000\"]', '3', '0', '1498132260', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('68', 'ltc_cny', '[1498132081,\"6.42000000\",\"332.70400000\",\"332.70400000\",\"332.70400000\",\"332.70400000\"]', '1', '0', '1498132081', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('72', 'ltc_cny', '[1498132200,\"91.98000000\",\"332.54000000\",\"332.54000000\",\"332.46600000\",\"332.46600000\"]', '5', '0', '1498132200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('73', 'ltc_cny', '[1498132200,\"91.98000000\",\"332.54000000\",\"332.54000000\",\"332.46600000\",\"332.46600000\"]', '10', '0', '1498132200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('75', 'ltc_cny', '[1498132201,\"15.28000000\",\"332.54000000\",\"332.54000000\",\"332.54000000\",\"332.54000000\"]', '1', '0', '1498132201', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('81', 'ltc_cny', '[1498132441,\"29.13000000\",\"332.46600000\",\"332.46600000\",\"332.46600000\",\"332.46600000\"]', '1', '0', '1498132441', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('80', 'ltc_cny', '[1498132381,\"47.57000000\",\"332.54000000\",\"332.54000000\",\"332.54000000\",\"332.54000000\"]', '1', '0', '1498132381', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('82', 'ltc_cny', '[1498132440,\"29.13000000\",\"332.46600000\",\"332.46600000\",\"332.46600000\",\"332.46600000\"]', '3', '0', '1498132440', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('86', 'ltc_cny', '[1498132800,\"134.90000000\",\"332.83600000\",\"332.87400000\",\"332.36500000\",\"332.87400000\"]', '10', '0', '1498132800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('87', 'ltc_cny', '[1498132800,\"162.01000000\",\"332.83600000\",\"332.87400000\",\"332.36500000\",\"332.59100000\"]', '15', '0', '1498132800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('88', 'ltc_cny', '[1498132800,\"348.09000000\",\"332.83600000\",\"333.22900000\",\"332.36500000\",\"333.22900000\"]', '30', '0', '1498132800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('89', 'ltc_cny', '[1498132800,\"624.37000000\",\"332.83600000\",\"333.26300000\",\"332.36500000\",\"332.58500000\"]', '60', '0', '1498132800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('100', 'ltc_cny', '[1498132800,\"27.68000000\",\"332.83600000\",\"332.83600000\",\"332.83600000\",\"332.83600000\"]', '3', '0', '1498132800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('101', 'ltc_cny', '[1498132980,\"28.15000000\",\"332.87400000\",\"332.87400000\",\"332.87400000\",\"332.87400000\"]', '3', '0', '1498132980', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('97', 'ltc_cny', '[1498132921,\"27.68000000\",\"332.83600000\",\"332.83600000\",\"332.83600000\",\"332.83600000\"]', '1', '0', '1498132921', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('103', 'ltc_cny', '[1498132800,\"33.94000000\",\"332.83600000\",\"332.87400000\",\"332.83600000\",\"332.87400000\"]', '5', '0', '1498132800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('105', 'ltc_cny', '[1498133041,\"6.26000000\",\"332.87400000\",\"332.87400000\",\"332.87400000\",\"332.87400000\"]', '1', '0', '1498133041', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('106', 'ltc_cny', '[1498133101,\"21.89000000\",\"332.87400000\",\"332.87400000\",\"332.87400000\",\"332.87400000\"]', '1', '0', '1498133101', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('107', 'ltc_cny', '[1498133100,\"100.96000000\",\"332.87400000\",\"332.87400000\",\"332.36500000\",\"332.87400000\"]', '5', '0', '1498133100', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('109', 'ltc_cny', '[1498133160,\"79.07000000\",\"332.36500000\",\"332.87400000\",\"332.36500000\",\"332.87400000\"]', '3', '0', '1498133160', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('111', 'ltc_cny', '[1498133221,\"53.75000000\",\"332.36500000\",\"332.36500000\",\"332.36500000\",\"332.36500000\"]', '1', '0', '1498133221', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('112', 'ltc_cny', '[1498133281,\"25.32000000\",\"332.87400000\",\"332.87400000\",\"332.87400000\",\"332.87400000\"]', '1', '0', '1498133281', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('114', 'ltc_cny', '[1498133340,\"8.26000000\",\"332.36500000\",\"332.36500000\",\"332.36500000\",\"332.36500000\"]', '3', '0', '1498133340', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('116', 'ltc_cny', '[1498133401,\"8.26000000\",\"332.36500000\",\"332.36500000\",\"332.36500000\",\"332.36500000\"]', '1', '0', '1498133401', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('117', 'ltc_cny', '[1498133400,\"27.11000000\",\"332.36500000\",\"332.59100000\",\"332.36500000\",\"332.59100000\"]', '5', '0', '1498133400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('118', 'ltc_cny', '[1498133400,\"27.11000000\",\"332.36500000\",\"332.59100000\",\"332.36500000\",\"332.59100000\"]', '10', '0', '1498133400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('120', 'ltc_cny', '[1498133520,\"18.85000000\",\"332.59100000\",\"332.59100000\",\"332.59100000\",\"332.59100000\"]', '3', '0', '1498133520', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('124', 'ltc_cny', '[1498133641,\"18.85000000\",\"332.59100000\",\"332.59100000\",\"332.59100000\",\"332.59100000\"]', '1', '0', '1498133641', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('128', 'ltc_cny', '[1498133700,\"186.08000000\",\"332.91000000\",\"333.22900000\",\"332.91000000\",\"333.22900000\"]', '15', '0', '1498133700', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('129', 'ltc_cny', '[1498134000,\"186.08000000\",\"332.91000000\",\"333.22900000\",\"332.91000000\",\"333.22900000\"]', '10', '0', '1498134000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('140', 'ltc_cny', '[1498134060,\"24.33000000\",\"332.91000000\",\"332.91000000\",\"332.91000000\",\"332.91000000\"]', '3', '0', '1498134060', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('142', 'ltc_cny', '[1498134000,\"24.33000000\",\"332.91000000\",\"332.91000000\",\"332.91000000\",\"332.91000000\"]', '5', '0', '1498134000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('137', 'ltc_cny', '[1498134121,\"24.33000000\",\"332.91000000\",\"332.91000000\",\"332.91000000\",\"332.91000000\"]', '1', '0', '1498134121', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('144', 'ltc_cny', '[1498134240,\"67.71000000\",\"333.08600000\",\"333.08600000\",\"333.08600000\",\"333.08600000\"]', '3', '0', '1498134240', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('145', 'ltc_cny', '[1498134300,\"161.75000000\",\"333.08600000\",\"333.22900000\",\"333.08600000\",\"333.22900000\"]', '5', '0', '1498134300', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('149', 'ltc_cny', '[1498134361,\"67.71000000\",\"333.08600000\",\"333.08600000\",\"333.08600000\",\"333.08600000\"]', '1', '0', '1498134361', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('151', 'ltc_cny', '[1498134420,\"94.04000000\",\"333.13000000\",\"333.22900000\",\"333.13000000\",\"333.22900000\"]', '3', '0', '1498134420', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('153', 'ltc_cny', '[1498134481,\"94.04000000\",\"333.13000000\",\"333.22900000\",\"333.13000000\",\"333.22900000\"]', '1', '0', '1498134481', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('157', 'ltc_cny', '[1498134600,\"11.08000000\",\"333.24500000\",\"333.24500000\",\"333.24500000\",\"333.24500000\"]', '10', '0', '1498134600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('158', 'ltc_cny', '[1498134600,\"21.68000000\",\"333.24500000\",\"333.24500000\",\"332.93500000\",\"332.93500000\"]', '15', '0', '1498134600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('159', 'ltc_cny', '[1498134600,\"276.28000000\",\"333.24500000\",\"333.26300000\",\"332.58500000\",\"332.58500000\"]', '30', '0', '1498134600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('172', 'ltc_cny', '[1498134960,\"11.08000000\",\"333.24500000\",\"333.24500000\",\"333.24500000\",\"333.24500000\"]', '3', '0', '1498134960', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('174', 'ltc_cny', '[1498134900,\"11.08000000\",\"333.24500000\",\"333.24500000\",\"333.24500000\",\"333.24500000\"]', '5', '0', '1498134900', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('168', 'ltc_cny', '[1498135021,\"11.08000000\",\"333.24500000\",\"333.24500000\",\"333.24500000\",\"333.24500000\"]', '1', '0', '1498135021', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('176', 'ltc_cny', '[1498135200,\"10.60000000\",\"332.93500000\",\"332.93500000\",\"332.93500000\",\"332.93500000\"]', '5', '0', '1498135200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('177', 'ltc_cny', '[1498135200,\"70.47000000\",\"332.93500000\",\"332.93500000\",\"332.67400000\",\"332.67400000\"]', '10', '0', '1498135200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('186', 'ltc_cny', '[1498135320,\"10.60000000\",\"332.93500000\",\"332.93500000\",\"332.93500000\",\"332.93500000\"]', '3', '0', '1498135320', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('183', 'ltc_cny', '[1498135381,\"10.60000000\",\"332.93500000\",\"332.93500000\",\"332.93500000\",\"332.93500000\"]', '1', '0', '1498135381', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('189', 'ltc_cny', '[1498135500,\"31.32000000\",\"332.93500000\",\"332.93500000\",\"332.93500000\",\"332.93500000\"]', '3', '0', '1498135500', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('188', 'ltc_cny', '[1498135501,\"31.32000000\",\"332.93500000\",\"332.93500000\",\"332.93500000\",\"332.93500000\"]', '1', '0', '1498135501', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('190', 'ltc_cny', '[1498135500,\"59.87000000\",\"332.93500000\",\"332.93500000\",\"332.67400000\",\"332.67400000\"]', '5', '0', '1498135500', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('191', 'ltc_cny', '[1498135500,\"254.60000000\",\"332.93500000\",\"333.26300000\",\"332.58500000\",\"332.58500000\"]', '15', '0', '1498135500', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('196', 'ltc_cny', '[1498135680,\"28.55000000\",\"332.81900000\",\"332.81900000\",\"332.67400000\",\"332.67400000\"]', '3', '0', '1498135680', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('195', 'ltc_cny', '[1498135681,\"14.47000000\",\"332.81900000\",\"332.81900000\",\"332.81900000\",\"332.81900000\"]', '1', '0', '1498135681', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('197', 'ltc_cny', '[1498135741,\"14.08000000\",\"332.81900000\",\"332.81900000\",\"332.67400000\",\"332.67400000\"]', '1', '0', '1498135741', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('199', 'ltc_cny', '[1498135800,\"118.84000000\",\"333.24500000\",\"333.26300000\",\"332.78900000\",\"332.78900000\"]', '5', '0', '1498135800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('200', 'ltc_cny', '[1498135800,\"194.73000000\",\"333.24500000\",\"333.26300000\",\"332.58500000\",\"332.58500000\"]', '10', '0', '1498135800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('203', 'ltc_cny', '[1498135860,\"89.96000000\",\"333.24500000\",\"333.26300000\",\"333.24500000\",\"333.26300000\"]', '3', '0', '1498135860', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('202', 'ltc_cny', '[1498135861,\"89.96000000\",\"333.24500000\",\"333.26300000\",\"333.24500000\",\"333.26300000\"]', '1', '0', '1498135861', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('208', 'ltc_cny', '[1498136040,\"56.73000000\",\"332.78900000\",\"332.78900000\",\"332.78900000\",\"332.78900000\"]', '3', '0', '1498136040', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('207', 'ltc_cny', '[1498136041,\"28.88000000\",\"332.78900000\",\"332.78900000\",\"332.78900000\",\"332.78900000\"]', '1', '0', '1498136041', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('209', 'ltc_cny', '[1498136101,\"27.85000000\",\"332.78900000\",\"332.78900000\",\"332.78900000\",\"332.78900000\"]', '1', '0', '1498136101', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('210', 'ltc_cny', '[1498136100,\"75.89000000\",\"332.78900000\",\"332.78900000\",\"332.58500000\",\"332.58500000\"]', '5', '0', '1498136100', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('214', 'ltc_cny', '[1498136220,\"48.04000000\",\"332.59100000\",\"332.59100000\",\"332.58500000\",\"332.58500000\"]', '3', '0', '1498136220', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('213', 'ltc_cny', '[1498136221,\"12.15000000\",\"332.59100000\",\"332.59100000\",\"332.59100000\",\"332.59100000\"]', '1', '0', '1498136221', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('215', 'ltc_cny', '[1498136281,\"35.89000000\",\"332.58500000\",\"332.58500000\",\"332.58500000\",\"332.58500000\"]', '1', '0', '1498136281', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('219', 'ltc_cny', '[1498136400,\"35.79000000\",\"333.27900000\",\"333.27900000\",\"333.27900000\",\"333.27900000\"]', '3', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('218', 'ltc_cny', '[1498136401,\"17.60000000\",\"333.27900000\",\"333.27900000\",\"333.27900000\",\"333.27900000\"]', '1', '0', '1498136401', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('220', 'ltc_cny', '[1498136400,\"111.84000000\",\"333.27900000\",\"333.56900000\",\"333.27900000\",\"333.56900000\"]', '5', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('221', 'ltc_cny', '[1498136400,\"139.77000000\",\"333.27900000\",\"333.62500000\",\"333.27900000\",\"333.62500000\"]', '10', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('222', 'ltc_cny', '[1498136400,\"239.55000000\",\"333.27900000\",\"333.71400000\",\"333.27900000\",\"333.71400000\"]', '15', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('223', 'ltc_cny', '[1498136400,\"301.02000000\",\"333.27900000\",\"333.71400000\",\"333.01500000\",\"333.01500000\"]', '30', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('224', 'ltc_cny', '[1498136400,\"625.06000000\",\"333.27900000\",\"333.88800000\",\"332.39200000\",\"332.90500000\"]', '60', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('225', 'ltc_cny', '[1498136400,\"1071.56000000\",\"333.27900000\",\"334.11300000\",\"332.39200000\",\"334.11300000\"]', '120', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('226', 'ltc_cny', '[1498136461,\"18.19000000\",\"333.27900000\",\"333.27900000\",\"333.27900000\",\"333.27900000\"]', '1', '0', '1498136461', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('230', 'ltc_cny', '[1498136580,\"76.05000000\",\"333.44700000\",\"333.56900000\",\"333.44700000\",\"333.56900000\"]', '3', '0', '1498136580', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('229', 'ltc_cny', '[1498136581,\"50.29000000\",\"333.44700000\",\"333.44700000\",\"333.44700000\",\"333.44700000\"]', '1', '0', '1498136581', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('231', 'ltc_cny', '[1498136641,\"25.76000000\",\"333.56900000\",\"333.56900000\",\"333.56900000\",\"333.56900000\"]', '1', '0', '1498136641', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('233', 'ltc_cny', '[1498136700,\"27.93000000\",\"333.57300000\",\"333.62500000\",\"333.57300000\",\"333.62500000\"]', '5', '0', '1498136700', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('236', 'ltc_cny', '[1498136760,\"27.93000000\",\"333.57300000\",\"333.62500000\",\"333.57300000\",\"333.62500000\"]', '3', '0', '1498136760', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('235', 'ltc_cny', '[1498136761,\"7.87000000\",\"333.57300000\",\"333.57300000\",\"333.57300000\",\"333.57300000\"]', '1', '0', '1498136761', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('237', 'ltc_cny', '[1498136821,\"20.06000000\",\"333.62500000\",\"333.62500000\",\"333.62500000\",\"333.62500000\"]', '1', '0', '1498136821', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('239', 'ltc_cny', '[1498136940,\"48.02000000\",\"333.67500000\",\"333.67500000\",\"333.67500000\",\"333.67500000\"]', '3', '0', '1498136940', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('240', 'ltc_cny', '[1498137000,\"99.78000000\",\"333.67500000\",\"333.71400000\",\"333.67500000\",\"333.71400000\"]', '5', '0', '1498137000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('241', 'ltc_cny', '[1498137000,\"99.78000000\",\"333.67500000\",\"333.71400000\",\"333.67500000\",\"333.71400000\"]', '10', '0', '1498137000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('245', 'ltc_cny', '[1498137061,\"48.02000000\",\"333.67500000\",\"333.67500000\",\"333.67500000\",\"333.67500000\"]', '1', '0', '1498137061', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('246', 'ltc_cny', '[1498137121,\"51.76000000\",\"333.67500000\",\"333.71400000\",\"333.67500000\",\"333.71400000\"]', '1', '0', '1498137121', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('247', 'ltc_cny', '[1498137120,\"51.76000000\",\"333.67500000\",\"333.71400000\",\"333.67500000\",\"333.71400000\"]', '3', '0', '1498137120', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('251', 'ltc_cny', '[1498137300,\"61.47000000\",\"333.21700000\",\"333.64300000\",\"333.01500000\",\"333.01500000\"]', '15', '0', '1498137300', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('252', 'ltc_cny', '[1498137600,\"61.47000000\",\"333.21700000\",\"333.64300000\",\"333.01500000\",\"333.01500000\"]', '10', '0', '1498137600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('265', 'ltc_cny', '[1498137660,\"46.73000000\",\"333.21700000\",\"333.64300000\",\"333.21700000\",\"333.64300000\"]', '3', '0', '1498137660', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('267', 'ltc_cny', '[1498137600,\"46.73000000\",\"333.21700000\",\"333.64300000\",\"333.21700000\",\"333.64300000\"]', '5', '0', '1498137600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('261', 'ltc_cny', '[1498137661,\"44.34000000\",\"333.21700000\",\"333.21700000\",\"333.21700000\",\"333.21700000\"]', '1', '0', '1498137661', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('269', 'ltc_cny', '[1498137781,\"2.39000000\",\"333.64300000\",\"333.64300000\",\"333.64300000\",\"333.64300000\"]', '1', '0', '1498137781', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('272', 'ltc_cny', '[1498137900,\"14.74000000\",\"333.01500000\",\"333.01500000\",\"333.01500000\",\"333.01500000\"]', '5', '0', '1498137900', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('280', 'ltc_cny', '[1498138020,\"14.74000000\",\"333.01500000\",\"333.01500000\",\"333.01500000\",\"333.01500000\"]', '3', '0', '1498138020', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('278', 'ltc_cny', '[1498138141,\"14.74000000\",\"333.01500000\",\"333.01500000\",\"333.01500000\",\"333.01500000\"]', '1', '0', '1498138141', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('282', 'ltc_cny', '[1498138200,\"47.11000000\",\"332.97400000\",\"332.97400000\",\"332.97400000\",\"332.97400000\"]', '3', '0', '1498138200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('283', 'ltc_cny', '[1498138200,\"68.05000000\",\"332.97400000\",\"333.45400000\",\"332.97400000\",\"333.45400000\"]', '5', '0', '1498138200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('284', 'ltc_cny', '[1498138200,\"141.84000000\",\"332.97400000\",\"333.45400000\",\"332.39200000\",\"332.39200000\"]', '10', '0', '1498138200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('285', 'ltc_cny', '[1498138200,\"210.45000000\",\"332.97400000\",\"333.45400000\",\"332.39200000\",\"332.73000000\"]', '15', '0', '1498138200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('286', 'ltc_cny', '[1498138200,\"324.04000000\",\"332.97400000\",\"333.88800000\",\"332.39200000\",\"332.90500000\"]', '30', '0', '1498138200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('289', 'ltc_cny', '[1498138321,\"47.11000000\",\"332.97400000\",\"332.97400000\",\"332.97400000\",\"332.97400000\"]', '1', '0', '1498138321', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('290', 'ltc_cny', '[1498138381,\"20.94000000\",\"333.45400000\",\"333.45400000\",\"333.45400000\",\"333.45400000\"]', '1', '0', '1498138381', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('291', 'ltc_cny', '[1498138380,\"36.86000000\",\"333.45400000\",\"333.45400000\",\"332.97400000\",\"332.97400000\"]', '3', '0', '1498138380', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('295', 'ltc_cny', '[1498138500,\"73.79000000\",\"332.97400000\",\"332.97400000\",\"332.39200000\",\"332.39200000\"]', '5', '0', '1498138500', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('294', 'ltc_cny', '[1498138501,\"15.92000000\",\"332.97400000\",\"332.97400000\",\"332.97400000\",\"332.97400000\"]', '1', '0', '1498138501', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('297', 'ltc_cny', '[1498138560,\"57.87000000\",\"332.39200000\",\"332.39200000\",\"332.39200000\",\"332.39200000\"]', '3', '0', '1498138560', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('300', 'ltc_cny', '[1498138681,\"57.87000000\",\"332.39200000\",\"332.39200000\",\"332.39200000\",\"332.39200000\"]', '1', '0', '1498138681', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('302', 'ltc_cny', '[1498138740,\"68.61000000\",\"332.73000000\",\"332.73000000\",\"332.73000000\",\"332.73000000\"]', '3', '0', '1498138740', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('303', 'ltc_cny', '[1498138800,\"68.61000000\",\"332.73000000\",\"332.73000000\",\"332.73000000\",\"332.73000000\"]', '5', '0', '1498138800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('304', 'ltc_cny', '[1498138800,\"68.61000000\",\"332.73000000\",\"332.73000000\",\"332.73000000\",\"332.73000000\"]', '10', '0', '1498138800', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('307', 'ltc_cny', '[1498138861,\"68.61000000\",\"332.73000000\",\"332.73000000\",\"332.73000000\",\"332.73000000\"]', '1', '0', '1498138861', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('326', 'ltc_cny', '[1498139400,\"0.20000000\",\"333.24500000\",\"333.88800000\",\"333.24500000\",\"333.88800000\"]', '5', '0', '1498139400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('311', 'ltc_cny', '[1498139100,\"113.59000000\",\"333.24500000\",\"333.88800000\",\"332.44900000\",\"332.90500000\"]', '15', '0', '1498139100', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('323', 'ltc_cny', '[1498139280,\"0.10000000\",\"333.24500000\",\"333.24500000\",\"333.24500000\",\"333.24500000\"]', '3', '0', '1498139280', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('327', 'ltc_cny', '[1498139400,\"113.59000000\",\"333.24500000\",\"333.88800000\",\"332.44900000\",\"332.90500000\"]', '10', '0', '1498139400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('324', 'ltc_cny', '[1498139460,\"0.10000000\",\"333.88800000\",\"333.88800000\",\"333.88800000\",\"333.88800000\"]', '3', '0', '1498139460', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('320', 'ltc_cny', '[1498139401,\"0.10000000\",\"333.24500000\",\"333.24500000\",\"333.24500000\",\"333.24500000\"]', '1', '0', '1498139401', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('329', 'ltc_cny', '[1498139521,\"0.10000000\",\"333.88800000\",\"333.88800000\",\"333.88800000\",\"333.88800000\"]', '1', '0', '1498139521', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('331', 'ltc_cny', '[1498139640,\"106.78000000\",\"332.44900000\",\"332.48500000\",\"332.44900000\",\"332.48500000\"]', '3', '0', '1498139640', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('332', 'ltc_cny', '[1498139700,\"113.39000000\",\"332.44900000\",\"332.90500000\",\"332.44900000\",\"332.90500000\"]', '5', '0', '1498139700', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('336', 'ltc_cny', '[1498139761,\"14.36000000\",\"332.48500000\",\"332.48500000\",\"332.48500000\",\"332.48500000\"]', '1', '0', '1498139761', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('335', 'ltc_cny', '[1498139701,\"92.42000000\",\"332.44900000\",\"332.44900000\",\"332.44900000\",\"332.44900000\"]', '1', '0', '1498139701', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('337', 'btc_cny', '[1498139755,\"1.00000000\",\"8000.00000000\",\"8000.00000000\",\"8000.00000000\",\"8000.00000000\"]', '1', '0', '1498139755', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('338', 'btc_cny', '[1498139640,\"3.00000000\",\"8000.00000000\",\"8000.00000000\",\"1000.00000000\",\"1000.00000000\"]', '3', '0', '1498139640', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('339', 'btc_cny', '[1498139700,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '5', '0', '1498139700', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('340', 'btc_cny', '[1498139400,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '10', '0', '1498139400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('341', 'btc_cny', '[1498139100,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '15', '0', '1498139100', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('342', 'btc_cny', '[1498138200,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '30', '0', '1498138200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('343', 'btc_cny', '[1498136400,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '60', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('344', 'btc_cny', '[1498136400,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '120', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('345', 'btc_cny', '[1498136400,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '240', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('346', 'btc_cny', '[1498136400,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '360', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('347', 'btc_cny', '[1498136400,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '720', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('348', 'btc_cny', '[1498136400,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '1440', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('349', 'btc_cny', '[1498136400,\"15.00000000\",\"8000.00000000\",\"8000.00000000\",\"500.00000000\",\"500.00000000\"]', '10080', '0', '1498136400', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('351', 'ltc_cny', '[1498139820,\"6.61000000\",\"332.90500000\",\"332.90500000\",\"332.90500000\",\"332.90500000\"]', '3', '0', '1498139820', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('352', 'btc_cny', '[1498139815,\"2.00000000\",\"1000.00000000\",\"1000.00000000\",\"1000.00000000\",\"1000.00000000\"]', '1', '0', '1498139815', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('353', 'btc_cny', '[1498139820,\"12.00000000\",\"700.00000000\",\"700.00000000\",\"500.00000000\",\"500.00000000\"]', '3', '0', '1498139820', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('354', 'btc_cny', '[1498139875,\"12.00000000\",\"700.00000000\",\"700.00000000\",\"500.00000000\",\"500.00000000\"]', '1', '0', '1498139875', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('356', 'ltc_cny', '[1498139881,\"6.61000000\",\"332.90500000\",\"332.90500000\",\"332.90500000\",\"332.90500000\"]', '1', '0', '1498139881', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('358', 'btc_cny', '', '1', '0', '1498139935', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('361', 'ltc_cny', '[1498140000,\"87.36000000\",\"333.39900000\",\"333.43800000\",\"333.39900000\",\"333.43800000\"]', '10', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('362', 'ltc_cny', '[1498140000,\"96.30000000\",\"333.39900000\",\"333.53100000\",\"333.39900000\",\"333.53100000\"]', '15', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('363', 'ltc_cny', '[1498140000,\"446.50000000\",\"333.39900000\",\"334.11300000\",\"333.39900000\",\"334.11300000\"]', '30', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('364', 'ltc_cny', '[1498140000,\"446.50000000\",\"333.39900000\",\"334.11300000\",\"333.39900000\",\"334.11300000\"]', '60', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('365', 'btc_cny', '', '3', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('366', 'btc_cny', '', '5', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('367', 'btc_cny', '', '10', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('368', 'btc_cny', '', '15', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('369', 'btc_cny', '', '30', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('370', 'btc_cny', '', '60', '0', '1498140000', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('381', 'ltc_cny', '[1498140360,\"87.36000000\",\"333.39900000\",\"333.43800000\",\"333.39900000\",\"333.43800000\"]', '3', '0', '1498140360', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('383', 'ltc_cny', '[1498140300,\"87.36000000\",\"333.39900000\",\"333.43800000\",\"333.39900000\",\"333.43800000\"]', '5', '0', '1498140300', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('378', 'ltc_cny', '[1498140361,\"3.77000000\",\"333.39900000\",\"333.39900000\",\"333.39900000\",\"333.39900000\"]', '1', '0', '1498140361', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('384', 'ltc_cny', '[1498140421,\"83.59000000\",\"333.43800000\",\"333.43800000\",\"333.43800000\",\"333.43800000\"]', '1', '0', '1498140421', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('386', 'ltc_cny', '[1498140540,\"8.94000000\",\"333.53100000\",\"333.53100000\",\"333.53100000\",\"333.53100000\"]', '3', '0', '1498140540', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('387', 'ltc_cny', '[1498140600,\"8.94000000\",\"333.53100000\",\"333.53100000\",\"333.53100000\",\"333.53100000\"]', '5', '0', '1498140600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('388', 'ltc_cny', '[1498140600,\"150.99000000\",\"333.53100000\",\"333.89700000\",\"333.53100000\",\"333.89700000\"]', '10', '0', '1498140600', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('391', 'ltc_cny', '[1498140601,\"8.94000000\",\"333.53100000\",\"333.53100000\",\"333.53100000\",\"333.53100000\"]', '1', '0', '1498140601', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('400', 'ltc_cny', '[1498140900,\"38.38000000\",\"333.75700000\",\"333.75700000\",\"333.75700000\",\"333.75700000\"]', '3', '0', '1498140900', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('401', 'ltc_cny', '[1498140900,\"142.05000000\",\"333.75700000\",\"333.89700000\",\"333.75700000\",\"333.89700000\"]', '5', '0', '1498140900', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('398', 'ltc_cny', '[1498140901,\"38.38000000\",\"333.75700000\",\"333.75700000\",\"333.75700000\",\"333.75700000\"]', '1', '0', '1498140901', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('402', 'ltc_cny', '[1498140900,\"350.20000000\",\"333.75700000\",\"334.11300000\",\"333.75700000\",\"334.11300000\"]', '15', '0', '1498140900', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('407', 'ltc_cny', '[1498141080,\"103.67000000\",\"333.79800000\",\"333.89700000\",\"333.79800000\",\"333.89700000\"]', '3', '0', '1498141080', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('406', 'ltc_cny', '[1498141081,\"98.58000000\",\"333.79800000\",\"333.89700000\",\"333.79800000\",\"333.89700000\"]', '1', '0', '1498141081', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('408', 'ltc_cny', '[1498141141,\"5.09000000\",\"333.89700000\",\"333.89700000\",\"333.89700000\",\"333.89700000\"]', '1', '0', '1498141141', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('410', 'ltc_cny', '[1498141200,\"166.92000000\",\"333.89700000\",\"333.95200000\",\"333.89700000\",\"333.95200000\"]', '5', '0', '1498141200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('411', 'ltc_cny', '[1498141200,\"208.15000000\",\"333.89700000\",\"334.11300000\",\"333.89700000\",\"334.11300000\"]', '10', '0', '1498141200', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('412', 'ltc_cny', '[1498141260,\"80.84000000\",\"333.89700000\",\"333.90100000\",\"333.89700000\",\"333.90100000\"]', '3', '0', '1498141260', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('415', 'ltc_cny', '[1498141321,\"80.84000000\",\"333.89700000\",\"333.90100000\",\"333.89700000\",\"333.90100000\"]', '1', '0', '1498141321', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('419', 'ltc_cny', '[1498141440,\"127.31000000\",\"333.90100000\",\"334.11300000\",\"333.90100000\",\"334.11300000\"]', '3', '0', '1498141440', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('418', 'ltc_cny', '[1498141441,\"86.08000000\",\"333.90100000\",\"333.95200000\",\"333.90100000\",\"333.95200000\"]', '1', '0', '1498141441', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('420', 'ltc_cny', '[1498141501,\"41.23000000\",\"334.11300000\",\"334.11300000\",\"334.11300000\",\"334.11300000\"]', '1', '0', '1498141501', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('421', 'ltc_cny', '', '1', '0', '1498141561', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('422', 'ltc_cny', '[1498141500,\"41.23000000\",\"334.11300000\",\"334.11300000\",\"334.11300000\",\"334.11300000\"]', '5', '0', '1498141500', '0', '0');
INSERT INTO `qq3479015851_trade_json` VALUES ('423', 'ltc_cny', '', '3', '0', '1498141620', '0', '0');

-- ----------------------------
-- Table structure for `qq3479015851_trade_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_trade_log`;
CREATE TABLE `qq3479015851_trade_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `peerid` int(11) unsigned NOT NULL,
  `market` varchar(50) NOT NULL,
  `price` decimal(20,8) unsigned NOT NULL,
  `num` decimal(20,8) unsigned NOT NULL,
  `mum` decimal(20,8) unsigned NOT NULL,
  `fee_buy` decimal(20,8) unsigned NOT NULL,
  `fee_sell` decimal(20,8) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`),
  KEY `peerid` (`peerid`),
  KEY `main` (`market`,`status`,`addtime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_trade_log
-- ----------------------------
INSERT INTO `qq3479015851_trade_log` VALUES ('1', '0', '0', 'ltc_cny', '332.66400000', '31.89000000', '10608.65500000', '0.00000000', '0.00000000', '1', '0', '1498130401', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('2', '0', '0', 'ltc_cny', '332.66400000', '8.05000000', '2677.94520000', '0.00000000', '0.00000000', '1', '0', '1498130855', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('3', '0', '0', 'ltc_cny', '332.70200000', '21.86000000', '7272.86570000', '0.00000000', '0.00000000', '1', '0', '1498131036', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('4', '0', '0', 'ltc_cny', '332.80800000', '29.18000000', '9711.33740000', '0.00000000', '0.00000000', '2', '0', '1498131489', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('5', '0', '0', 'ltc_cny', '332.63100000', '20.36000000', '6772.36720000', '0.00000000', '0.00000000', '2', '0', '1498131761', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('6', '0', '0', 'ltc_cny', '332.54000000', '30.99000000', '10305.41460000', '0.00000000', '0.00000000', '2', '0', '1498131761', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('7', '0', '0', 'ltc_cny', '332.70400000', '6.42000000', '2135.95970000', '0.00000000', '0.00000000', '2', '0', '1498132124', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('8', '0', '0', 'ltc_cny', '332.54000000', '15.28000000', '5081.21120000', '0.00000000', '0.00000000', '2', '0', '1498132215', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('9', '0', '0', 'ltc_cny', '332.54000000', '47.57000000', '15818.92780000', '0.00000000', '0.00000000', '2', '0', '1498132397', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('10', '0', '0', 'ltc_cny', '332.46600000', '29.13000000', '9684.73460000', '0.00000000', '0.00000000', '1', '0', '1498132487', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('11', '0', '0', 'ltc_cny', '332.83600000', '27.68000000', '9212.90050000', '0.00000000', '0.00000000', '1', '0', '1498132949', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('12', '0', '0', 'ltc_cny', '332.87400000', '6.26000000', '2083.79120000', '0.00000000', '0.00000000', '1', '0', '1498133041', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('13', '0', '0', 'ltc_cny', '332.87400000', '21.89000000', '7286.61190000', '0.00000000', '0.00000000', '1', '0', '1498133132', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('14', '0', '0', 'ltc_cny', '332.36500000', '53.75000000', '17864.61880000', '0.00000000', '0.00000000', '2', '0', '1498133224', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('15', '0', '0', 'ltc_cny', '332.87400000', '25.32000000', '8428.36970000', '0.00000000', '0.00000000', '1', '0', '1498133316', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('16', '0', '0', 'ltc_cny', '332.36500000', '8.26000000', '2745.33490000', '0.00000000', '0.00000000', '2', '0', '1498133407', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('17', '0', '0', 'ltc_cny', '332.59100000', '18.85000000', '6269.34040000', '0.00000000', '0.00000000', '2', '0', '1498133682', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('18', '0', '0', 'ltc_cny', '332.91000000', '24.33000000', '8099.70030000', '0.00000000', '0.00000000', '1', '0', '1498134140', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('19', '0', '0', 'ltc_cny', '333.08600000', '67.71000000', '22553.25310000', '0.00000000', '0.00000000', '1', '0', '1498134413', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('20', '0', '0', 'ltc_cny', '333.13000000', '88.01000000', '29318.77130000', '0.00000000', '0.00000000', '1', '0', '1498134504', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('21', '0', '0', 'ltc_cny', '333.22900000', '6.03000000', '2009.37090000', '0.00000000', '0.00000000', '1', '0', '1498134504', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('22', '0', '0', 'ltc_cny', '333.24500000', '11.08000000', '3692.35460000', '0.00000000', '0.00000000', '1', '0', '1498135054', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('23', '0', '0', 'ltc_cny', '332.93500000', '10.60000000', '3529.11100000', '0.00000000', '0.00000000', '2', '0', '1498135417', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('24', '0', '0', 'ltc_cny', '332.93500000', '31.32000000', '10427.52420000', '0.00000000', '0.00000000', '2', '0', '1498135508', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('25', '0', '0', 'ltc_cny', '332.81900000', '14.47000000', '4815.89090000', '0.00000000', '0.00000000', '2', '0', '1498135692', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('26', '0', '0', 'ltc_cny', '332.81900000', '10.21000000', '3398.08200000', '0.00000000', '0.00000000', '2', '0', '1498135783', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('27', '0', '0', 'ltc_cny', '332.67400000', '3.87000000', '1287.44840000', '0.00000000', '0.00000000', '2', '0', '1498135783', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('28', '0', '0', 'ltc_cny', '333.24500000', '78.52000000', '26166.39740000', '0.00000000', '0.00000000', '1', '0', '1498135874', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('29', '0', '0', 'ltc_cny', '333.26300000', '11.44000000', '3812.52870000', '0.00000000', '0.00000000', '1', '0', '1498135874', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('30', '0', '0', 'ltc_cny', '332.78900000', '28.88000000', '9610.94630000', '0.00000000', '0.00000000', '1', '0', '1498136058', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('31', '0', '0', 'ltc_cny', '332.78900000', '27.85000000', '9268.17370000', '0.00000000', '0.00000000', '1', '0', '1498136149', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('32', '0', '0', 'ltc_cny', '332.59100000', '12.15000000', '4040.98070000', '0.00000000', '0.00000000', '2', '0', '1498136240', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('33', '0', '0', 'ltc_cny', '332.58500000', '35.89000000', '11936.47570000', '0.00000000', '0.00000000', '1', '0', '1498136331', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('34', '0', '0', 'ltc_cny', '333.27900000', '17.60000000', '5865.71040000', '0.00000000', '0.00000000', '1', '0', '1498136421', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('35', '0', '0', 'ltc_cny', '333.27900000', '18.19000000', '6062.34500000', '0.00000000', '0.00000000', '1', '0', '1498136512', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('36', '0', '0', 'ltc_cny', '333.44700000', '50.29000000', '16769.04960000', '0.00000000', '0.00000000', '1', '0', '1498136603', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('37', '0', '0', 'ltc_cny', '333.56900000', '25.76000000', '8592.73740000', '0.00000000', '0.00000000', '1', '0', '1498136696', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('38', '0', '0', 'ltc_cny', '333.57300000', '7.87000000', '2625.21950000', '0.00000000', '0.00000000', '1', '0', '1498136788', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('39', '0', '0', 'ltc_cny', '333.62500000', '20.06000000', '6692.51750000', '0.00000000', '0.00000000', '1', '0', '1498136879', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('40', '0', '0', 'ltc_cny', '333.67500000', '48.02000000', '16023.07350000', '0.00000000', '0.00000000', '1', '0', '1498137061', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('41', '0', '0', 'ltc_cny', '333.67500000', '41.22000000', '13754.08350000', '0.00000000', '0.00000000', '1', '0', '1498137152', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('42', '0', '0', 'ltc_cny', '333.71400000', '10.54000000', '3517.34560000', '0.00000000', '0.00000000', '1', '0', '1498137152', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('43', '0', '0', 'ltc_cny', '333.21700000', '44.34000000', '14774.84180000', '0.00000000', '0.00000000', '2', '0', '1498137703', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('44', '0', '0', 'ltc_cny', '333.64300000', '2.39000000', '797.40680000', '0.00000000', '0.00000000', '1', '0', '1498137795', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('45', '0', '0', 'ltc_cny', '333.01500000', '14.74000000', '4908.64110000', '0.00000000', '0.00000000', '2', '0', '1498138160', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('46', '0', '0', 'ltc_cny', '332.97400000', '47.11000000', '15686.40510000', '0.00000000', '0.00000000', '2', '0', '1498138344', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('47', '0', '0', 'ltc_cny', '333.45400000', '20.94000000', '6982.52680000', '0.00000000', '0.00000000', '1', '0', '1498138435', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('48', '0', '0', 'ltc_cny', '332.97400000', '15.92000000', '5300.94610000', '0.00000000', '0.00000000', '2', '0', '1498138526', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('49', '0', '0', 'ltc_cny', '332.39200000', '57.87000000', '19235.52500000', '0.00000000', '0.00000000', '2', '0', '1498138714', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('50', '0', '0', 'ltc_cny', '332.73000000', '68.61000000', '22828.60530000', '0.00000000', '0.00000000', '1', '0', '1498138898', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('51', '7', '7', 'ltc_cny', '333.24500000', '0.10000000', '33.32450000', '1.00000000', '1.00000000', '1', '0', '1498139436', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('52', '7', '7', 'ltc_cny', '333.88800000', '0.10000000', '33.38880000', '1.00000000', '1.00000000', '1', '0', '1498139523', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('53', '0', '0', 'ltc_cny', '332.44900000', '92.42000000', '30724.93660000', '0.00000000', '0.00000000', '1', '0', '1498139723', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('54', '3', '3', 'btc_cny', '8000.00000000', '1.00000000', '8000.00000000', '80.00000000', '80.00000000', '1', '0', '1498139755', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('55', '0', '0', 'ltc_cny', '332.48500000', '14.36000000', '4774.48460000', '0.00000000', '0.00000000', '1', '0', '1498139815', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('56', '3', '3', 'btc_cny', '1000.00000000', '2.00000000', '2000.00000000', '20.00000000', '20.00000000', '1', '0', '1498139815', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('57', '0', '0', 'ltc_cny', '332.90500000', '6.61000000', '2200.50210000', '0.00000000', '0.00000000', '1', '0', '1498139907', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('58', '3', '3', 'btc_cny', '700.00000000', '10.00000000', '7000.00000000', '70.00000000', '70.00000000', '2', '0', '1498139916', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('59', '3', '3', 'btc_cny', '500.00000000', '2.00000000', '1000.00000000', '10.00000000', '10.00000000', '2', '0', '1498139916', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('60', '0', '0', 'ltc_cny', '333.39900000', '3.77000000', '1256.91420000', '0.00000000', '0.00000000', '1', '0', '1498140362', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('61', '0', '0', 'ltc_cny', '333.43800000', '83.59000000', '27872.08240000', '0.00000000', '0.00000000', '1', '0', '1498140454', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('62', '0', '0', 'ltc_cny', '333.53100000', '8.94000000', '2981.76710000', '0.00000000', '0.00000000', '1', '0', '1498140637', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('63', '0', '0', 'ltc_cny', '333.75700000', '38.38000000', '12809.59370000', '0.00000000', '0.00000000', '1', '0', '1498140911', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('64', '0', '0', 'ltc_cny', '333.79800000', '32.52000000', '10855.11100000', '0.00000000', '0.00000000', '1', '0', '1498141093', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('65', '0', '0', 'ltc_cny', '333.89700000', '66.06000000', '22057.23580000', '0.00000000', '0.00000000', '1', '0', '1498141093', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('66', '0', '0', 'ltc_cny', '333.89700000', '5.09000000', '1699.53570000', '0.00000000', '0.00000000', '1', '0', '1498141185', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('67', '0', '0', 'ltc_cny', '333.89700000', '12.53000000', '4183.72940000', '0.00000000', '0.00000000', '1', '0', '1498141370', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('68', '0', '0', 'ltc_cny', '333.90100000', '68.31000000', '22808.77730000', '0.00000000', '0.00000000', '1', '0', '1498141370', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('69', '0', '0', 'ltc_cny', '333.90100000', '19.12000000', '6384.18710000', '0.00000000', '0.00000000', '1', '0', '1498141461', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('70', '0', '0', 'ltc_cny', '333.92200000', '61.69000000', '20599.64820000', '0.00000000', '0.00000000', '1', '0', '1498141462', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('71', '0', '0', 'ltc_cny', '333.95200000', '5.27000000', '1759.92700000', '0.00000000', '0.00000000', '1', '0', '1498141462', '0', '1');
INSERT INTO `qq3479015851_trade_log` VALUES ('72', '0', '0', 'ltc_cny', '334.11300000', '41.23000000', '13775.47900000', '0.00000000', '0.00000000', '1', '0', '1498141554', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_ucenter_member`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_ucenter_member`;
CREATE TABLE `qq3479015851_ucenter_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of qq3479015851_ucenter_member
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_user`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user`;
CREATE TABLE `qq3479015851_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `moble` varchar(50) NOT NULL,
  `mobletime` int(11) unsigned NOT NULL,
  `password` varchar(32) NOT NULL,
  `tpwdsetting` varchar(32) NOT NULL,
  `paypassword` varchar(32) ,
  `invit_1` varchar(50) NOT NULL,
  `invit_2` varchar(50) NOT NULL,
  `invit_3` varchar(50) NOT NULL,
  `truename` varchar(32),
  `idcard` varchar(32),
  `idcardauth` tinyint(1) NOT NULL DEFAULT '0',
  `idcardimg1` varchar(100) DEFAULT NULL,
  `idcardimg2` varchar(100) DEFAULT NULL,
  `idcardinfo` varchar(500) DEFAULT NULL,
  `logins` int(11) unsigned,
  `ga` varchar(50),
  `addip` varchar(50) NOT NULL,
  `addr` varchar(50) NOT NULL,
  `sort` int(11) unsigned,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned,
  `status` tinyint(4) NOT NULL,
  `email` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `alipay` varchar(200) DEFAULT NULL COMMENT '支付宝',
  `invit` varchar(50) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `awardid` int(2) NOT NULL DEFAULT '0',
  `awardstatus` smallint(1) NOT NULL DEFAULT '0',
  `awardname` varchar(100) DEFAULT NULL,
  `awardNumAll` int(10) NOT NULL DEFAULT '0',
  `awardNumToday` int(10) NOT NULL DEFAULT '0',
  `awardTotalToday` int(10) NOT NULL DEFAULT '0',
  `awardtime` int(11) NOT NULL DEFAULT '0',
  `regaward` tinyint(1) NOT NULL DEFAULT '0',
  `usertype` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Records of qq3479015851_user
-- ----------------------------
INSERT INTO `qq3479015851_user` VALUES ('1', 'cs12345678', '18281111111', '1497986471', 'e10adc3949ba59abbe56e057f20f883e', '1', 'd8578edf8458ce06fbc5bb76a58c5ca4', '0', '0', '0', '测试', '130302197806141411', '1', null, null, '', '2', '', '175.155.189.155', '未分配或者内网IP', '0', '1497986619', '0', '1', null, null, 'PVRWYX', 'cb053d86c525f01e273680177ad87c4f', '0', '0', '无奖品', '0', '0', '0', '0', '0', '1');
INSERT INTO `qq3479015851_user` VALUES ('2', '18005006617', '18005006617', '1498034757', 'e10adc3949ba59abbe56e057f20f883e', '1', '14c9c680b61b8aa0f591a51367eabf9b', '0', '0', '0', '修改', '131301988213512441', '0', null, null, null, '0', '', '61.131.87.21', '未分配或者内网IP', '0', '1498034757', '0', '1', null, null, 'JXKELQ', null, '0', '0', null, '0', '0', '0', '0', '1', '0');
INSERT INTO `qq3479015851_user` VALUES ('3', '13012345678', '13012345678', '1498134756', 'e99a18c428cb38d5f260853678922e03', '1', '0659c7992e268962384eb17fafe88364', '0', '0', '0', '上上', '220188198808080808', '0', null, null, null, '1', '', '175.170.248.42', '未分配或者内网IP', '0', '1498134756', '0', '1', null, null, 'RQIBGU', null, '0', '0', null, '0', '0', '0', '0', '1', '0');
INSERT INTO `qq3479015851_user` VALUES ('4', '13873819731', '13873819731', '1498136006', 'e10adc3949ba59abbe56e057f20f883e', '1', '4297f44b13955235245b2497399d7a93', '0', '0', '0', '平梦秋', '530121198207183746', '0', null, null, null, '5', '', '58.20.21.11', '未分配或者内网IP', '0', '1498136006', '0', '1', null, null, 'VMTLUX', '10a4170841b88c79a1591cfa996f2713', '0', '0', null, '0', '0', '0', '0', '1', '0');
INSERT INTO `qq3479015851_user` VALUES ('5', 'q542531', '13873819732', '1498136410', 'e10adc3949ba59abbe56e057f20f883e', '1', '4297f44b13955235245b2497399d7a93', '0', '0', '0', '经济', '530121198408214246', '0', null, null, null, '0', '', '58.20.21.11', '未分配或者内网IP', '0', '1498136410', '0', '1', null, null, 'LAQVRF', null, '0', '0', null, '0', '0', '0', '0', '0', '0');
INSERT INTO `qq3479015851_user` VALUES ('6', '13873819733', '13873819733', '1498137183', 'e10adc3949ba59abbe56e057f20f883e', '1', '4297f44b13955235245b2497399d7a93', '4', '0', '0', '安涵菡', '410482198804138128', '0', null, null, null, '0', '', '58.20.21.11', '未分配或者内网IP', '0', '1498137183', '0', '1', null, null, 'KZJFWH', null, '0', '0', null, '0', '0', '0', '0', '1', '0');
INSERT INTO `qq3479015851_user` VALUES ('7', 'qq123556', '13873819734', '1498137460', 'e10adc3949ba59abbe56e057f20f883e', '1', '4297f44b13955235245b2497399d7a93', '4', '0', '0', '吴挂钩', '411722197508214014', '0', '594bcc2f77832.jpg', null, null, '4', '', '58.20.21.11', '未分配或者内网IP', '0', '1498137460', '0', '1', null, null, 'IHVJUG', '8bd12bcec2fef7d73d3bc90e85085949', '0', '0', null, '0', '0', '0', '0', '0', '0');
INSERT INTO `qq3479015851_user` VALUES ('8', '15012345678', '15012345678', '1498140283', 'e10adc3949ba59abbe56e057f20f883e', '1', 'c33367701511b4f6020ec61ded352059', '0', '0', '0', '测试', '254512545124521255', '0', null, null, null, '0', '', '123.129.149.212', '未分配或者内网IP', '0', '1498140283', '0', '1', null, null, 'KRUBIS', null, '0', '0', null, '0', '0', '0', '0', '1', '0');

-- ----------------------------
-- Table structure for `qq3479015851_user_award`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user_award`;
CREATE TABLE `qq3479015851_user_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL DEFAULT '0',
  `awardname` varchar(100) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL DEFAULT '0',
  `dealtime` int(11) NOT NULL DEFAULT '0',
  `awardid` int(2) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_user_award
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_user_bank`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user_bank`;
CREATE TABLE `qq3479015851_user_bank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `bank` varchar(200) NOT NULL,
  `bankprov` varchar(200) NOT NULL,
  `bankcity` varchar(200) NOT NULL,
  `bankaddr` varchar(200) NOT NULL,
  `bankcard` varchar(200) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_user_bank
-- ----------------------------
INSERT INTO `qq3479015851_user_bank` VALUES ('1', '2', '测试', '平安银行', '浙江', '宁波', '测试支行', '2245122145454545', '0', '1494863694', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_user_bank_type`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user_bank_type`;
CREATE TABLE `qq3479015851_user_bank_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `mytx` varchar(200) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='常用银行地址';

-- ----------------------------
-- Records of qq3479015851_user_bank_type
-- ----------------------------
INSERT INTO `qq3479015851_user_bank_type` VALUES ('1', 'boc', '中国银行', 'http://www.boc.cn/', 'img_56937003683ce.jpg', '', '', '0', '1452503043', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('2', 'abc', '农业银行', 'http://www.abchina.com/cn/', 'img_569370458b18d.jpg', '', '', '0', '1452503109', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('3', 'bccb', '北京银行', 'http://www.bankofbeijing.com.cn/', 'img_569370588dcdc.jpg', '', '', '0', '1452503128', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('4', 'ccb', '建设银行', 'http://www.ccb.com/', 'img_5693709bbd20f.jpg', '', '', '0', '1452503195', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('5', 'ceb', '光大银行', 'http://www.bankofbeijing.com.cn/', 'img_569370b207cc8.jpg', '', '', '0', '1452503218', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('6', 'cib', '兴业银行', 'http://www.cib.com.cn/cn/index.html', 'img_569370d29bf59.jpg', '', '', '0', '1452503250', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('7', 'citic', '中信银行', 'http://www.ecitic.com/', 'img_569370fb7a1b3.jpg', '', '', '0', '1452503291', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('8', 'cmb', '招商银行', 'http://www.cmbchina.com/', 'img_5693710a9ac9c.jpg', '', '', '0', '1452503306', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('9', 'cmbc', '民生银行', 'http://www.cmbchina.com/', 'img_5693711f97a9d.jpg', '', '', '0', '1452503327', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('10', 'comm', '交通银行', 'http://www.bankcomm.com/BankCommSite/default.shtml', 'img_5693713076351.jpg', '', '', '0', '1452503344', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('11', 'gdb', '广发银行', 'http://www.cgbchina.com.cn/', 'img_56937154bebc5.jpg', '', '', '0', '1452503380', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('12', 'icbc', '工商银行', 'http://www.icbc.com.cn/icbc/', 'img_56937162db7f5.jpg', '', '', '0', '1452503394', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('13', 'psbc', '邮政银行', 'http://www.psbc.com/portal/zh_CN/index.html', 'img_5693717eefaa3.jpg', '', '', '0', '1452503422', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('14', 'spdb', '浦发银行', 'http://www.spdb.com.cn/chpage/c1/', 'img_5693718f1d70e.jpg', '', '', '0', '1452503439', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('15', 'szpab', '平安银行', 'http://bank.pingan.com/', '56c2e4c9aff85.jpg', '', '', '0', '1455613129', '0', '1');
INSERT INTO `qq3479015851_user_bank_type` VALUES ('16', 'alipay', '支付宝', 'http://www.alipay.com', '', '', '', '0', '1452503439', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_user_coin`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user_coin`;
CREATE TABLE `qq3479015851_user_coin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `cny` decimal(20,8) unsigned NOT NULL,
  `cnyd` decimal(20,8) unsigned NOT NULL,
  `ltc` decimal(20,8) unsigned NOT NULL,
  `ltcd` decimal(20,8) unsigned NOT NULL,
  `ltcb` varchar(200) NOT NULL,
  `btc` decimal(20,8) unsigned NOT NULL,
  `btcd` decimal(20,8) unsigned NOT NULL,
  `btcb` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户币种表';

-- ----------------------------
-- Records of qq3479015851_user_coin
-- ----------------------------
INSERT INTO `qq3479015851_user_coin` VALUES ('1', '1', '8181.59210000', '1918.40790000', '0.00000000', '0.00000000', '', '0.00000000', '0.00000000', '');
INSERT INTO `qq3479015851_user_coin` VALUES ('2', '2', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '0.00000000', '');
INSERT INTO `qq3479015851_user_coin` VALUES ('3', '3', '995598.00000000', '4375.24500000', '10000.00000000', '0.00000000', '', '82.00000000', '18.00000000', '');
INSERT INTO `qq3479015851_user_coin` VALUES ('4', '4', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '0.00000000', '');
INSERT INTO `qq3479015851_user_coin` VALUES ('5', '5', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '0.00000000', '');
INSERT INTO `qq3479015851_user_coin` VALUES ('6', '6', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '0.00000000', '');
INSERT INTO `qq3479015851_user_coin` VALUES ('7', '7', '189.90845200', '0.00000000', '0.20000000', '0.80000000', '', '0.00000000', '0.00000000', '');
INSERT INTO `qq3479015851_user_coin` VALUES ('8', '8', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '0.00000000', '');

-- ----------------------------
-- Table structure for `qq3479015851_user_goods`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user_goods`;
CREATE TABLE `qq3479015851_user_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `truename` varchar(200) NOT NULL,
  `idcard` varchar(200) NOT NULL,
  `moble` varchar(200) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_user_goods
-- ----------------------------
INSERT INTO `qq3479015851_user_goods` VALUES ('1', '2', '我家', '测试', '', '13012345678', '朝阳群众社区', '0', '1495089233', '0', '1', '北京', '东城区');

-- ----------------------------
-- Table structure for `qq3479015851_user_log`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user_log`;
CREATE TABLE `qq3479015851_user_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `type` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `addip` varchar(200) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='用户记录表';

-- ----------------------------
-- Records of qq3479015851_user_log
-- ----------------------------
INSERT INTO `qq3479015851_user_log` VALUES ('1', '1', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498133311', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('2', '1', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498133636', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('3', '4', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498136222', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('4', '4', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498136246', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('5', '4', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498136951', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('6', '4', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498137132', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('7', '4', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498137359', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('8', '7', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498137683', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('9', '7', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498137702', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('10', '7', '登录', '通过用户名登录', '58.20.21.11', '未分配或者内网IP', '0', '1498137826', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('11', '7', '登录', '通过手机号登录', '58.20.21.11', '未分配或者内网IP', '0', '1498137880', '0', '1');
INSERT INTO `qq3479015851_user_log` VALUES ('12', '3', '登录', '通过手机号登录', '175.170.248.42', '未分配或者内网IP', '0', '1498138343', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_user_qianbao`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user_qianbao`;
CREATE TABLE `qq3479015851_user_qianbao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `coinname` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`),
  KEY `coinname` (`coinname`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户钱包表';

-- ----------------------------
-- Records of qq3479015851_user_qianbao
-- ----------------------------
INSERT INTO `qq3479015851_user_qianbao` VALUES ('1', '3', 'ltc', 'abc', 'abc123', '0', '1498135205', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_user_shopaddr`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_user_shopaddr`;
CREATE TABLE `qq3479015851_user_shopaddr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `truename` varchar(200) NOT NULL DEFAULT '0',
  `moble` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq3479015851_user_shopaddr
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_version`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_version`;
CREATE TABLE `qq3479015851_version` (
  `name` varchar(50) NOT NULL COMMENT '版本号',
  `number` int(11) NOT NULL COMMENT '序列号，一般用日期数字标示',
  `title` varchar(50) NOT NULL COMMENT '版本名',
  `create_time` int(11) NOT NULL COMMENT '发布时间',
  `update_time` int(11) NOT NULL COMMENT '更新的时间',
  `log` text NOT NULL COMMENT '更新日志',
  `url` varchar(150) NOT NULL COMMENT '链接到的远程文章',
  `is_current` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `id` (`number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='自动更新表';

-- ----------------------------
-- Records of qq3479015851_version
-- ----------------------------

-- ----------------------------
-- Table structure for `qq3479015851_version_game`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_version_game`;
CREATE TABLE `qq3479015851_version_game` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `gongsi` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `shuoming` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `class` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `number` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='应用管理表';

-- ----------------------------
-- Records of qq3479015851_version_game
-- ----------------------------
INSERT INTO `qq3479015851_version_game` VALUES ('1', 'QQ3479015851', '网上商城', 'shop', 'shop', '网上商城', '1');

-- ----------------------------
-- Table structure for `qq3479015851_vote`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_vote`;
CREATE TABLE `qq3479015851_vote` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `coinname` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `type` int(20) unsigned NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `status` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_vote
-- ----------------------------
INSERT INTO `qq3479015851_vote` VALUES ('1', '7', 'ltc', '莱特币', '1', '0', '1498138633', '0', '1');

-- ----------------------------
-- Table structure for `qq3479015851_vote_type`
-- ----------------------------
DROP TABLE IF EXISTS `qq3479015851_vote_type`;
CREATE TABLE `qq3479015851_vote_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `coinname` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态',
  `img` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `zhichi` bigint(20) unsigned DEFAULT '0',
  `fandui` bigint(20) unsigned DEFAULT '0',
  `zongji` bigint(20) unsigned DEFAULT '0',
  `bili` float DEFAULT '0',
  `votecoin` varchar(50) NOT NULL,
  `assumnum` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qq3479015851_vote_type
-- ----------------------------
INSERT INTO `qq3479015851_vote_type` VALUES ('1', 'ltc', '莱特币', '1', null, '0', '0', '0', '0', 'cny', '1');
