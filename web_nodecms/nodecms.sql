/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : nodecms

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2015-10-19 11:45:49
*/

drop database if exists `nodecms`;

create database `nodecms`;

use nodecms;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(120) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `copyfrom` varchar(100) NOT NULL,
  `fromlink` varchar(200) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `color` char(7) NOT NULL,
  `isbold` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL,
  `recommends` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `realhits` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `puttime` int(10) unsigned NOT NULL DEFAULT '0',
  `tpl` varchar(20) NOT NULL,
  `listorder` int(10) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `lang` (`lang`),
  KEY `recommend` (`recommends`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('21', '2', '5.28百度大面积K站原因分析', '1', '百度5.28大面积K站', '自端午节以来，百度经过一次次的K站，今天又达到一个K站高峰。本站也被百度拉进黑名单？啥原因？', '<p>\r\n	自端午节以来，百度经过一次次的K站，今天又达到一个K站高峰。本站也被百度拉进黑名单？啥原因？X6CMS\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	本站最近一段时间操作：\r\n</p>\r\n<p>\r\n	1、文章不定期更新（不过时间比较长，因为比较忙，所以更新周期就被拉长了）\r\n</p>\r\n<p>\r\n	2、外链添加，主要在论坛\r\n</p>\r\n<p>\r\n	其他基本没什么操作了，而且文章也基本原创或伪原创，但是网站还是被K得找不到北了！\r\n</p>\r\n<p>\r\n	从这点看出来，百度这次K站的原因可能在于网站更新方面，没有新内容，百度可能认为这是一个死站，从而K掉！\r\n</p>', '小六', 'http://www.x6cms.com', '/uploads/2015-08-11/647690575181.jpg', '', '0', '31,5', '', '67', '58', '1347356349', '1359696635', '1444924800', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('20', '2', '网站SEO优化第一步-提交网站到搜索引擎', '1', '提交网站到搜索引擎', '做网站的目的，不管为了什么原因，都得吸引更多人浏览网站！网站SEO优化是必不可少的环节。而网站优化的第一步，就是提交网站地址到各大搜索引起，以吸引搜索引擎流量进入网站。', '做网站的目的，不管为了什么原因，都得吸引更多人浏览网站！网站SEO优化是必不可少的环节。而网站优化的第一步，就是提交网站地址到各大搜索引起，以吸引搜索引擎流量进入网站。\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 以下列出最主要的几个搜索引擎登录地址：\r\n</p>\r\n<hr class="ke-pagebreak" />\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 百度登陆提交地址：<a href="http://www.baidu.com/search/url_submit.html" target="_blank">http://www.baidu.com/search/url_submit.html</a> \r\n</p>\r\n<p>\r\n google网站登陆提价地址：<a href="http://www.google.com/intl/zh-TW_tw/addurl.html" target="_blank">http://www.google.com/intl/zh-TW_tw/addurl.html</a> \r\n</p>\r\n<p>\r\n SOSO网站登录提交地址：<a href="http://www.soso.com/help/usb/urlsubmit.shtml" target="_blank">http://www.soso.com/help/usb/urlsubmit.shtml</a> \r\n</p>\r\n<p>\r\n 雅虎网站登录提交地址：<a href="http://search.help.cn.yahoo.com/h4_4.html" target="_blank">http://search.help.cn.yahoo.com/h4_4.html</a> \r\n</p>\r\n<p>\r\n bing网站登录提交地址：<a href="http://cn.bing.com/webmaster/SubmitSitePage.aspx?mkt=zh-CN" target="_blank">http://cn.bing.com/webmaster/SubmitSitePage.aspx?mkt=zh-CN</a> \r\n</p>\r\n<p>\r\n sogou网站登录提交地址：<a href="http://www.sogou.com/feedback/urlfeedback.php" target="_blank">http://www.sogou.com/feedback/urlfeedback.php</a> \r\n</p>\r\n<p>\r\n .....\r\n</p>\r\n<p>\r\n 网站提交之后，一般如果网站没有什么大的问题，比如域名被K过之类的问题，搜索引擎一般会在一周左右的时间就会收录你的网站。当然，各个搜索引擎的收录时间不一样，而且并不一定会保证收录。\r\n</p>\r\n<p>\r\n 尤其注意一点：可以通过其他操作方式加快网站被收录的时间。\r\n</p>\r\n<p>\r\n 下面列出最重要的两种加快收录的方法\r\n</p>\r\n<p>\r\n 1、在高权重网站加上您的网站锚文本链接。\r\n</p>\r\n<p>\r\n 2、网站正常更新，每天首页有新的原创内容展示。\r\n</p>\r\n<p>\r\n 网站收录结果查询地址：<a href="http://indexed.webmasterhome.cn/" target="_blank">http://indexed.webmasterhome.cn/</a> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 扩展阅读：\r\n</p>\r\n<p>\r\n 1、什么是锚文本链接\r\n</p>\r\n<p>\r\n 2、什么是原创内容\r\n</p>', '小六', 'http://www.x6cms.com', '/uploads/2015-08-11/647690575181.jpg', '', '0', '31', '', '42', '42', '1347356283', '1358666559', '1346319435', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('19', '1', '最简单的留言板', '1', '简单留言板代码', '史上最简单留言板代码，这是最开始学习php的时候写的一段代码。如果没接触过php的，想学习php的朋友可以看看，老手路过，不要喷~', '史上最简单留言板代码，这是最开始学习php的时候写的一段代码。如果没接触过php的，想学习php的朋友可以看看，老手路过，不要喷~<br />\r\n<pre class="prettyprint lang-php">&lt;!--?php\r\nif($_POST[\'message\'])\r\n{\r\n$message="$_POST[\'name\'] --$_POST[\'message\']\r\n&lt;hr /&gt;\r\n";\r\n$fp=fopen&#40;"1.txt","a"&#41;;\r\nfwrite($fp,$_POST[\'message\']);\r\nfclose($fp);\r\n}\r\n@readfile&#40;"1.txt"&#41;\r\n?&gt;\r\n<table>\r\n \r\n <tbody>\r\n  \r\n  <tr>\r\n   \r\n   <td>\r\n    <b>昵称：</b> \r\n   </td>\r\n\r\n   <td>\r\n    \r\n   </td>\r\n\r\n  </tr>\r\n\r\n  <tr>\r\n   \r\n   <td>\r\n    <b>留言内容：</b> \r\n   </td>\r\n\r\n   <td>\r\n    \r\n   </td>\r\n\r\n  </tr>\r\n\r\n  <tr>\r\n   \r\n   <td>\r\n    \r\n   </td>\r\n\r\n  </tr>\r\n\r\n </tbody>\r\n\r\n</table>\r\n</pre>', '小六', 'http://www.x6cms.com', '', '#E53333', '0', '0', '', '39', '39', '1347356217', '1358513383', '1345800853', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('18', '13', 'jquery返回顶部代码3', '1', '返回顶部代码', '', '<p>\r\n 以下返回顶部代码在ie8、ie9、firefox下测试通过，ie6、ie7下未测试，只要做过程序的朋友都知道，ie6是个大麻烦，ie7是个半成品，小六科技以后发布的程序都将不支持ie6、ie7。敬请广大网友升级ie8、ie9浏览器\r\n</p>\r\n<p>\r\n CSS代码：\r\n</p>\r\n<pre class="prettyprint lang-css">.backToTop {\r\n    display: none;\r\n    width: 18px;\r\n    line-height: 1.2;\r\n    padding: 5px 0;\r\n    background-color: #000;\r\n    color: #fff;\r\n    font-size: 12px;\r\n    text-align: center;\r\n    position: fixed;\r\n    _position: absolute;\r\n    right: 10px;\r\n    bottom: 100px;\r\n    _bottom: "auto";\r\n    cursor: pointer;\r\n    opacity: .6;\r\n    filter: Alpha(opacity=60);\r\n}</pre>\r\n<p>\r\n JS代码：\r\n</p>\r\n<pre class="prettyprint lang-js">$(document).ready(function(){\r\n var $backToTopTxt = "返回顶部",$backToTopEle = $(\'\').appendTo($("body")).text($backToTopTxt).attr("title", $backToTopTxt).click(function() {\r\n  $("html, body").animate({ scrollTop: 0 }, 120);\r\n    }), $backToTopFun = function() {\r\n        var st = $(document).scrollTop(), winh = $(window).height();\r\n        (st &gt; 0)? $backToTopEle.show(): $backToTopEle.hide();    \r\n        if (!window.XMLHttpRequest) {\r\n            $backToTopEle.css("top", st + winh - 166);    \r\n        }\r\n    };\r\n    $(window).bind("scroll", $backToTopFun);\r\n    $backToTopFun();\r\n});\r\n</pre>\r\n<p>\r\n <span>注：页面中需要先加载jquery，返回顶部代码才能实现</span> \r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>', '小六', 'http://www.x6cms.com', '/uploads/2015-08-11/647690575181.jpg', '', '0', '', '', '10', '10', '1347356032', '1358221852', '1344504716', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('17', '1', '关于最近电脑时间自动倒退一年提示', '1', '电脑时间自动倒退一年', '最近国内大面积电脑时间倒退一年。具网络中流传，有可能是360相关软件引起的。以前一直以为电脑时间嘛，没什么大不了的，结果出现这个问题之后，才发现，问题很大，以下是几个今天碰到的问题。', '<p>\r\n 最近国内大面积电脑时间倒退一年。具网络中流传，有可能是360相关软件引起的。以前一直以为电脑时间嘛，没什么大不了的，结果出现这个问题之后，才发现，问题很大，以下是几个今天碰到的问题。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 电脑时间出现问题，引起的问题：\r\n</p>\r\n<p>\r\n 1、很多需要在线支付的网站，支付不了。比如淘宝，这些网站都需要安装证书，如果电脑时间错误，会提示证书过期，引起没法进行下一步操作。\r\n</p>\r\n<p>\r\n 2、discuz论坛，用户登录有可能出现需要激活的情况。引起这种情况是因为，你的电脑时间比当时注册帐号的时间还早，系统出现错误。\r\n</p>\r\n<p>\r\n 3、有的网站发布各种文章使用的本机时间，发布后发现文章跑到很早以前的文章一起去了，不在最新文章里边，收录不了。\r\n</p>\r\n<p>\r\n ......\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 该事件后续：\r\n</p>\r\n<p>\r\n 360已经发布公告：《360杀毒关于系统时间Bug的解决公告》<br />\r\nhttp://bbs.360.cn/4077772/254084394.html\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '31', '', '11', '11', '1347355854', '1358666539', '1338543007', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('10', '13', '虚拟主机、VPS、主机租用的区别？', '1', '虚拟主机、VPS、主机租用的区别', '什么网站需要虚拟主机、VPS、主机租用：虚拟主机：普通个人用户网站或访问量不大的企业网站；VPS：网站访问量大，需要管理者有一定的服务器软件方面操作技术。主机租用：网站访问量大，需要管理者有专业的服务器维护技术。', '<p>\r\n <span ><strong>虚拟主机</strong></span>指在同一台服务器、同一个操作系统上，运用虚拟主机管理软件划分的若干个空间，每个用户都占用一部分系统资源.但是功能限制较多，可管理性不高。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span ><strong>VPS</strong></span>（Virtual Private Server）是指在同一台服务器上，利用虚拟服务器软件创建多个相互隔离的小服务器。这些小服务器（VPS）本身就有自己操作系统，它的运行和管理与独立服务器完全相同。但是vps只能自主控制服务器软件，不能控制服务器硬件。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span ><strong>主机租用</strong></span>是指租用一台服务器，由服务器租用公司提供硬件，负责基本软件的安装、配置，负责服务器上基本服务功能的正常运行，让用户独享服务器的资源。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 什么网站需要虚拟主机、VPS、主机租用：\r\n</p>\r\n<p>\r\n 虚拟主机：普通个人用户网站或访问量不大的企业网站；\r\n</p>\r\n<p>\r\n VPS：网站访问量大，需要管理者有一定的服务器软件方面操作技术。\r\n</p>\r\n<p>\r\n 主机租用：网站访问量大，需要管理者有专业的服务器维护技术。\r\n</p>', '', 'http://www.x6cms.com', '', '', '0', '', '', '1', '1', '1347355327', '1358221807', '1340184007', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('12', '13', '什么是域名？域名级别区分', '1', '域名级别区分', '域名（Domain Name），是由一串用点分隔的名字组成的Internet上某一台计算机或计算机组的名称，用于在数据传输时标识计算机的电子方位（有时也指地理位置），目前域名已经成为互联网的品牌、网上商标保护必备的产品之一。', '<p>\r\n 域名（Domain Name），是由一串用点分隔的名字组成的Internet上某一台计算机或计算机组的名称，用于在数据传输时标识计算机的电子方位（有时也指地理位置），目前域名已经成为互联网的品牌、网上商标保护必备的产品之一。说明确点，域名的作用就是让人能够通过一个名字找到你的网站。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 域名的级别：\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 顶级域名（一级域名）：比如本站域名go1668.com即为顶级域名，通常做友情链接时，很多人将带www的域名（<a href="http://www.go1668.com/">www.go1668.com</a>）认为是顶级域名（一级域名）\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 二级域名：比如<a href="http://www.go1668.com/">www.go1668.com</a>就为二级域名，当然其他的字母也是二级域名，比如小六网络科技的淘宝店xian6.taobao.com就是一个二级域名。注：二级域名是不需要备案的。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 以此类推，后边还有三级、四级.......等级别的域名。理论上应该是无限的，但是现实中3级域名还有的网站应用，再往下应用的级别就很少了\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '16', '', '1', '1', '1347355500', '1358666247', '1341134658', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('13', '1', '几种不适合做SEO的人', '1', '不适合做SEO的人', '一、对SEO没有兴趣，学习SEO只为了公司需要的人。二、认为SEO没有技术含量，只想混口饭吃的人。三、缺乏思考与创新，只按常理出牌的人。四、心理素质相对来说较差的人。', '<p>\r\n 一、对SEO没有兴趣，学习SEO只为了公司需要的人：没有兴趣怎么能将一门技术发挥到极点？各行各业都是这个理。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n <strong>二、认为SEO没有技术含量，只想混口饭吃的人</strong>：SEO技术是一门高深技术，如果你觉得SEO就是增加链接就可以了，在链接权重占的比重越来越低的今天，你已经跟不上时代了。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n <strong>三、缺乏思考与创新，只按常理出牌的人</strong>：SEO的一些偏门比正规手法更有用，当然不是叫你作弊。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n <strong>四、心理素质相对来说较差的人</strong>：SEO重点就是做网站关键字排名，可能今天你的排名在第一，明天就找不见了，没有好的心里素质，请勿乱入。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n <strong>五、</strong><strong>不会上网的人</strong>：什么年代了，还不会上网，跟不上时代了。在SEO一天一个变化的时代，不知道关注新东西，肯定会落后的，只会越做越烂！\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '', '', '6', '6', '1347355567', '1358149291', '1341912323', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('15', '1', '301重定向是什么，为什么要做301重定向', '1', '301重定向', '301重定向说白了就是通过各种的方法将各种网络请求重新定个方向转到其它位置。', '301重定向说白了就是通过各种的方法将各种网络请求重新定个方向转到其它位置。\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n iis和apache服务器的重定向规则有些许不同，不过大同小异的！本文不介绍具体规则，稍后会写其他文章介绍一下吧\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 不同域名之间的重定向和同域名不同页面的重定向，其实都一样，就是将一个网络地址转到另外一个网络地址上。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 就比如本网站，如果你直接在浏览器中输入<a href="http://go1668.com/">http://go1668.com</a>就会跳转到http:/www.go1668.com，这就是在不同域名上跳转了。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 这样做的好处就是，不分散主页面的权重，对于搜索引擎来说，权重集中，排名相对来说，更靠前一些。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 另外又比如访问本站的1.html的时候，直接跳转到2.html，这就是在同域名下不同页面的跳转了。\r\n</p>\r\n<p>\r\n 做这个可能有几个原因，在这列两个常见的原因：\r\n</p>\r\n<p>\r\n 1、路径分级太多，为了迎合搜索引擎，将路径分级减少。\r\n</p>\r\n<p>\r\n 2、路径变动了，需要将老地址转到新地址上。(为了将老页面的权重转移到新页面上来)\r\n</p>\r\n<p>\r\n ......\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '5', '', '21', '21', '1347355708', '1358666280', '1343726857', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('16', '1', '.CN域名注册细则修订：个人首次获得申请资格', '1', '个人注册cn域名', '5月28日下午消息，中国互联网络信息中心（CNNIC）今日发布公告称，将从明日开始实施修订后的域名注册实施细则。新规执行后，自然人将首次获得.CN和.中国域名的申请资格。过去两年我国顶级域名注册量下降了近1000万。', '<p>\r\n 5月28日下午消息，中国互联网络信息中心（CNNIC）今日发布公告称，将从明日开始实施修订后的域名注册实施细则。新规执行后，自然人将首次获得.CN和.中国域名的申请资格。过去两年我国顶级域名注册量下降了近1000万。\r\n</p>\r\n<p>\r\n 据介绍此次修订，重点修改了原《实施细则》第十四条中关于域名注册主体的规定，并增加专门章节对域名注册信息的保护进行阐述，同时，针对域名注册、转移、续费等环节进行了修改完善。主要修改如下：\r\n</p>\r\n<p>\r\n 一、关于域名注册主体的增加。修订为“任何自然人或者能独立承担民事责任的组织均可在本细则规定的顶级域名下申请注册域名”，即域名注册的主体扩大至自然人。\r\n</p>\r\n<p>\r\n 二、关于域名注册信息的保护。为加强域名注册者信息的安全保护，修订后的《实施细则》通过对注册资料的传输、保存、销毁以及域名注册服务机构退出时域名注册信息、资料的处理等作出的详细规定，加强对用户信息的安全保护。\r\n</p>\r\n<p>\r\n 三、关于域名的续费确认期。《实施细则》规定“域名到期后自动进入30日的续费确认期，用户在此期限内确认是否续费，如书面表示不续费，域名注册服务机构有权注销该域名；如果用户在30日内未书面表示不续费，也未续费，域名注册服务机构有权30日后注销域名”。\r\n</p>\r\n<p>\r\n CNNIC表示，.CN和.中国域名向自然人开放后，并不会使恶意注册事件进一步扩大，同时指出相关争议已有相关的解决流程。而对于此前使用不实信息注册相关域名的个人用户，CNNIC表示正在进行相关核验，且向用户提供一次域名注册转移的机会。\r\n</p>\r\n<p>\r\n 由于实名制和定价回复等原因，.CN和.中国注册和持有情况持续低迷。官方披露的数据显示，过去两年中.CN和。中国域名数量下降了约1000万。\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '', '', '7', '7', '1347355782', '1358149303', '1338283741', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('9', '13', '网页常见错误代码列表', '1', '网站错误代码', '1  网址协议不支持的协议。 2  检测器内部错误。 3  网址格式不正确。5  无法连接到代理服务器。6  无法连接到服务器或找不到域名。', '<p>\r\n 1 &nbsp;网址协议不支持的协议。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 2 &nbsp;检测器内部错误。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 3 &nbsp;网址格式不正确。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 5 &nbsp;无法连接到代理服务器。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 6 &nbsp;无法连接到服务器或找不到域名。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 7 &nbsp;连接服务器失败。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 28 &nbsp;操作超时。可能原因：页面执行时间过长、服务器压力大。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 52 &nbsp;服务器未返回任何内容。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 100 &nbsp;Continue 初始的请求已经接受，客户应当继续发送请求的其余部分。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 101 &nbsp;Switching Protocols 服务器将遵从客户的请求转换到另外一种协议\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 200 &nbsp;OK 一切正常\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 201 &nbsp;Created 服务器已经创建了文档，Location头给出了它的URL。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 202 &nbsp;Accepted 已经接受请求，但处理尚未完成。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 203 &nbsp;Non-Authoritative Information 文档已经正常地返回，但一些应答头可能不正确，因为使用的是文档的拷贝。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 204 &nbsp; No Content 没有新文档，浏览器应该继续显示原来的文档。如果用户定期地刷新页面，而Servlet可以确定用户文档足够新，这个状态代码是很有用的。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 205 &nbsp; Reset Content 没有新的内容，但浏览器应该重置它所显示的内容。用来强制浏览器清除表单输入内容。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 206 &nbsp; Partial Content 客户发送了一个带有Range头的GET请求，服务器完成了它。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 300 &nbsp; Multiple Choices 客户请求的文档可以在多个位置找到，这些位置已经在返回的文档内列出。如果服务器要提出优先选择，则应该在Location应答头指明。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 301 &nbsp; Moved Permanently 客户请求的文档在其他地方，新的URL在Location头中给出，浏览器应该自动地访问新的URL。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 302 &nbsp; Found 类似于301，但新的URL应该被视为临时性的替代，而不是永久性的。注意，在HTTP1.0中对应的状态信息是“Moved Temporatily”。出现该状态代码时，浏览器能够自动访问新的URL，因此它是一个很有用的状态代码。注意这个状态代码有时候可以和301替换使用。例如，如果浏览器错误地请求http://host/~user（缺少了后面的斜杠），有的服务器返回301，有的则返回302。严格地说，我们只能假定只有当原来的请求是GET时浏览器才会自动重定向。请参见307。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 303 &nbsp; See Other 类似于301/302，不同之处在于，如果原来的请求是POST，Location头指定的重定向目标文档应该通过GET提取。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 304 &nbsp; Not Modified 客户端有缓冲的文档并发出了一个条件性的请求（一般是提供If-Modified-Since头表示客户只想比指定日期更新的文档）。服务器告诉客户，原来缓冲的文档还可以继续使用。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 305 &nbsp; Use Proxy 客户请求的文档应该通过Location头所指明的代理服务器提取。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 307 &nbsp; Temporary Redirect 和302（Found）相同。许多浏览器会错误地响应302应答进行重定向，即使原来的请求是POST，即使它实际上只能在POST请求的应答是303时才能重定向。由于这个原因，HTTP 1.1新增了307，以便更加清除地区分几个状态代码：当出现303应答时，浏览器可以跟随重定向的GET和POST请求；如果是307应答，则浏览器只能跟随对GET请求的重定向。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 400 &nbsp; Bad Request 请求出现语法错误。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 401 &nbsp; Unauthorized 客户试图未经授权访问受密码保护的页面。应答中会包含一个WWW-Authenticate头，浏览器据此显示用户名字/密码对话框，然后在填写合适的Authorization头后再次发出请求。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 403 &nbsp; Forbidden 资源不可用。服务器理解客户的请求，但拒绝处理它。通常由于服务器上文件或目录的权限设置导致。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 404 &nbsp; Not Found 无法找到指定位置的资源。这也是一个常用的应答。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 405 &nbsp; Method Not Allowed 请求方法（GET、POST、HEAD、Delete、PUT、TRACE等）对指定的资源不适用。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 406 &nbsp; Not Acceptable 指定的资源已经找到，但它的MIME类型和客户在Accpet头中所指定的不兼容。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 407 &nbsp; Proxy Authentication Required 类似于401，表示客户必须先经过代理服务器的授权。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 408 &nbsp; Request Timeout 在服务器许可的等待时间内，客户一直没有发出任何请求。客户可以在以后重复同一请求。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 409 &nbsp; Conflict 通常和PUT请求有关。由于请求和资源的当前状态相冲突，因此请求不能成功。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 410 &nbsp; Gone 所请求的文档已经不再可用，而且服务器不知道应该重定向到哪一个地址。它和404的不同在于，返回407表示文档永久地离开了指定的位置，而404表示由于未知的原因文档不可用。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 411 &nbsp; Length Required 服务器不能处理请求，除非客户发送一个Content-Length头。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 412 &nbsp; Precondition Failed 请求头中指定的一些前提条件失败。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 413 &nbsp; Request Entity Too Large 目标文档的大小超过服务器当前愿意处理的大小。如果服务器认为自己能够稍后再处理该请求，则应该提供一个Retry-After头。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 414 &nbsp; Request URI Too Long URI太长。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 416 &nbsp; Requested Range Not Satisfiable 服务器不能满足客户在请求中指定的Range头。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 500 &nbsp; Internal Server Error 服务器遇到了意料不到的情况，不能完成客户的请求。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 501 &nbsp; Not Implemented 服务器不支持实现请求所需要的功能。例如，客户发出了一个服务器不支持的PUT请求。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 502 &nbsp; Bad Gateway 服务器作为网关或者代理时，为了完成请求访问下一个服务器，但该服务器返回了非法的应答。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 503 &nbsp; Service Unavailable 服务器由于维护或者负载过重未能应答。例如，Servlet可能在数据库连接池已满的情况下返回503。服务器返回503时可以提供一个Retry-After头。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 504 &nbsp; Gateway Timeout 由作为代理或网关的服务器使用，表示不能及时地从远程服务器获得应答。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 505 &nbsp; HTTP Version Not Supported 服务器不支持请求中所指明的HTTP版本。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 10003 &nbsp;网址内容不是文本，无法执行文本检测\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 10002 网址内容不知是什么类型，无法执行文本检测\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 10000 &nbsp;网址内容未包含指定的文字\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 20000 &nbsp;内容被修改\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 30000 &nbsp;检测到木马、病毒\r\n</p>\r\n<p>\r\n <br />\r\n</p>', '网络', 'http://www.x6cms.com', '', '', '0', '', '', '2', '2', '1347355178', '1358221812', '1340183249', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('8', '12', '小六网站内容管理系统（X6CMS） 1.0发布', '1', 'X6CMS 1.0', 'X6CMS,全称：小六网站管理系统。是一款完全开源免费的PHP+MYSQL系统。系统核心采用了Codeigister框架、jquery框架等众多开源软件。目的是为了简化网站开发周期，最终实现只要稍微懂点编程即可快速建设网站。', '<p>\r\n X6CMS,全称：小六网站管理系统。是一款完全开源免费的PHP+MYSQL系统。系统核心采用了Codeigister框架、jquery框架等众多开源软件。目的是为了简化网站开发周期，最终实现只要稍微懂点编程即可快速建设网站。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 2012.6.10 版本1.0 功能包括：\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 系统管理：权限管理、用户组、用户管理\r\n</p>\r\n<p>\r\n 内容管理：栏目管理、文章管理、单页面管理、图片管理\r\n</p>\r\n<p>\r\n 模块管理：友情链接、碎片管理、导航设置\r\n</p>\r\n<p>\r\n 站点配置：站点配置、伪静态配置\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 下一步开发方向：\r\n</p>\r\n<p>\r\n 添加功能包括：留言管理、文章评论、产品管理、购物车。功能优化：前台除首页外实现模版选择，后台可编辑模版、css等文件，网站可实现不同语言后台切换，语言文件可编辑，logo等静态图片实现后台上传。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span >1.0版本因为是初始版本，还有许多不足之处，并不做为发布版本，后续功能完善之后再发布。</span> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 有需要的朋友可以直接发邮件至<a href="mailto:admin@go1668.com">admin@go1668.com</a>索要。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '', '', '15', '15', '1347353721', '1358221819', '1339317831', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('7', '13', '怎么查网站备案进度？', '1', '怎么查网站备案进度', '我应该怎么查网站备案进度？答：您可以登录工信部备案系统http://www.miitbeian.gov.cn公共查询进行备案进度的查询。', '<p>\r\n 经常听到很多客户想知道备案好了没？\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 其实，一般网站备案通过后，工信部备案系统会自动发邮件到您的邮箱，可以通过查看邮件看网站备案是否通过。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 另外，您可以登录工信部备案系统<a href="http://www.miitbeian.gov.cn">http://www.miitbeian.gov.cn</a>公共查询进行备案进度查询。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 不过，工信部的网站一般来说都比较慢，下面给你提供一个比较方便的方法。\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 直接进入<a href="http://tool.chinaz.com/beian.aspx">http://tool.chinaz.com/beian.aspx</a>查询，速度还挺快的。&nbsp;\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '', '', '2', '2', '1347352691', '1358221827', '1338885007', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('5', '12', '小六网络科技主机淘宝店开通', '1', '主机淘宝店', '小六网络科技淘宝店开通。淘宝店地址：http://xian6.taobao.com 。', '<p>\r\n 小六网络科技淘宝店开通\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 淘宝店地址：<a href="http://xian6.taobao.com/">http://xian6.taobao.com</a> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 为了更加方便客户快速支付，在线支付，特开此淘宝店！\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 淘宝店经营业务：主营各类型主机域名、及各种优惠网站套餐\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '', '', '2', '2', '1347351811', '1358221832', '1338452520', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('6', '1', '做SEO的目的是什么', '1', '做SEO的目的是什么', 'SEO的最主要的目的就是吸引搜索引擎上的潜在客户光顾你的站点，了解并购买他们搜索的产品。', '<p>\r\n <strong>SEO的目的是什么</strong>？以下列了几条做SEO的目的：\r\n</p>\r\n<p>\r\n 1、吸引搜索引擎上的潜在客户光顾你的站点，了解并购买他们搜索的产品。网店、销售型企业网站等。\r\n</p>\r\n<p>\r\n 2、希望获得来自搜索引擎的大量流量，向浏览者推介某一产品，而不是当场购买。生产型品牌企业网站、交友网站、会员模式站点等。\r\n</p>\r\n<p>\r\n 3、力图从搜索引擎引来充足的访问量，来扩大品牌的知名度，而不是某个具体的产品。如中国移动、国美电器等。\r\n</p>\r\n<p>\r\n 4、依靠搜索引擎的流量，并将这个流量作为产品吸引广告商来网站放广告。谷歌广告、阿里妈妈、百度推广等。\r\n</p>\r\n<p>\r\n 5、力图让搜索引擎给网站带来大量流量，以使网站的业绩指标攀升，吸引投资者或者收购。\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 确定自己的SEO目的是有必要的。特别是当自己要找一个专业的SEO顾问或SEO公司合作时，可以明确告诉他们你的需求，以让他们更好的实施SEO策划，同时你自己对SEO顾问或SEO公司也有一个考核标准。\r\n</p>', '小六', 'http://www.x6cms.com', '', '', '0', '', '', '5', '5', '1347352131', '1358149294', '1338539076', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('3', '13', 'icp备案是什么', '1', 'icp备案是什么', 'ICP备案是信息产业部对网站的一种管理，为了防止非法网站。就像是官方认可的网站，就好像开个小门面需要办营业执照一样。', '<h4>\r\n ICP备案简介\r\n</h4>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n ICP备案是信息产业部对网站的一种管理，为了防止非法网站。就像是官方认可的网站，就好像开个小门面需要办营业执照一样。\r\n</p>\r\n<h4>\r\n ICP备案流程\r\n</h4>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 　　接《中华人民共和国信息产业部第33号令》精神：为了规范网络安全化，维护网站经营者的合法权益，保障网民的合法利益，促进互联网行业健康发展，中华人民共和国信息产业部第十二次部务会议审议通过《非经营性互联网信息服务备案管理办法》将于2005年3月20日起施行。对国内各大小网站（包括企业及个人站点）的严格审查工作，对于没有合法备案的非经营性网站或没有取得ICP许可证的经营性网站， 根据网站性质，将予以罚款，严重的关闭网站，以此规范网络安全，打击一切利用网络资源进行不法活动的犯罪行为。\r\n</p>\r\n<h4>\r\n 备案的目的\r\n</h4>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n 备案的目的就是为了防止在网上从事非法的网站经营活动,打击不良互联网信息的传播,如果网站不备案的话,很有可能被查处以后关停.\r\n</p>\r\n<h4>\r\n 如何进行ICP备案\r\n</h4>\r\n<p>\r\n 一般网站ICP备案都需要通过主机商才能够备案，小六网络科技提供的主机和域名都是景安的，如果需要备案，需要照相（西安照相地点：云顶园）\r\n</p>\r\n<h4>\r\n <span></span>icp备案要多少钱<span></span><br />\r\n</h4>\r\n<p>\r\n 办理网上备案手续需要向通信管理局交纳费用吗？有两种情况\r\n</p>\r\n<p>\r\n 自己在网上办理的不需要向通信管理局交费。\r\n</p>\r\n<p>\r\n 通过接入服务提供单位代理办理的，代理单位是否向您收取代理服务通信管理局不介入（您与代理之间的关系应是民事委托服务关系。不属于政府的行政事业单位收费项目）\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n <span ><strong>注</strong></span><span ><strong>：西安小六网络科技所建设网站全程</strong></span><span ><strong>免费协助</strong></span><span ><strong>备案（需提供客户相关资料） </strong></span> \r\n</p>', '', 'http://www.x6cms.com', '', '', '0', '', '', '2', '2', '1345791536', '1358221837', '1337205517', '', '999', '1', 'zh_cn');
INSERT INTO `article` VALUES ('1', '12', '西安小六网络科技官方网站改版完成', '1', '西安小六网络科技官方网站', '2012.5.10 西安小六网络科技网站改版完成成功上线！\r\n改版后栏目：网站首页、新闻中心、产品服务、优惠套餐、经典案例、关于小六、联系我们', '<p>\r\n 2012.5.10 西安小六网络科技网站改版完成成功上线！\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 改版后栏目：\r\n</p>\r\n<p>\r\n 首页：网站首页\r\n</p>\r\n<p>\r\n 新闻中心：行业新闻、小六动态、及各种建站知识分享\r\n</p>\r\n<p>\r\n 产品服务：介绍小六的产品服务\r\n</p>\r\n<p>\r\n 优惠套餐：各种产品的优惠套餐介绍\r\n</p>\r\n<p>\r\n 经典案例：展示小六的一些客户经典案例\r\n</p>\r\n<p>\r\n 关于小六：西安小六网络科技简介\r\n</p>\r\n<p>\r\n 联系我们：西安小六网络科技联系方式\r\n</p>\r\n<p>\r\n &nbsp;\r\n</p>\r\n<p>\r\n 另外可通过顶部导航及底部导航查看一些常见问题解答\r\n</p>', '小六', 'http://www.x6cms.com', '/uploads/2015-08-11/647690575181.jpg', '', '0', '', '', '402', '72', '1336631274', '1358221842', '1336656923', '', '999', '1', 'zh_cn');

-- ----------------------------
-- Table structure for ask
-- ----------------------------
DROP TABLE IF EXISTS `ask`;
CREATE TABLE `ask` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(120) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `color` char(7) NOT NULL,
  `isbold` tinyint(1) NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL,
  `recommends` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `realhits` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `puttime` int(10) unsigned NOT NULL DEFAULT '0',
  `tpl` varchar(20) NOT NULL,
  `listorder` int(10) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `lang` (`lang`),
  KEY `recommend` (`recommends`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ask
-- ----------------------------
INSERT INTO `ask` VALUES ('7', '9', '后台功能中的真实量比访问量还高', '1', '访问量', '当你修改文章时，该文章正在被其他人或自己访问，当你修改完成之后，又将访问量数字修改了，这就造成真实量比访问量数字更大。', '<p>\r\n <span style="line-height:2;">以文章管理来举例：</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">当你修改文章时，该文章正在被其他人或自己访问，当你修改完成之后，又将访问量数字修改了，这就造成真实量比访问量数字更大。</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">真是量在系统中没法修改的，前台访问一次+1，只供后台查看。</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">这一点对系统使用没有影响。</span>\r\n</p>', '/demo/js/kindeditor/attached/image/20120913/20120913021316_64555.jpg', '', '0', '32', '', '11', '11', '1351061632', '1358497761', '1351061574', '', '999', '1', 'zh_cn');
INSERT INTO `ask` VALUES ('4', '9', '关于数据库密码为空不能安装系统的问题解释及解决方案', '1', '安装系统', '关于数据库密码为空不能安装系统的问题解释及解决方案', '<p>\r\n <p>\r\n  <span style="line-height:2;">问题描述：本机测试数据库没密码，可是安装系统时必须输入密码，否则不允许提交安装。</span>\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <span style="line-height:2;">问题解释：系统为了提升程序在服务器中运行的安全性，所以数据库密码默认必填！</span>\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <span style="line-height:2;">三种解决方案：</span>\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <span style="line-height:2;">1、给数据库添加一个设置有密码的新账户</span>\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <span style="line-height:2;">2、修改安装程序的js，将验证密码的功能去掉。</span>\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <span style="line-height:2;"> &nbsp; &nbsp;文件地址：/install/index.php</span>\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <strong><span style="line-height:2;">3、给该数据库帐号设置密码吧，如果不会的可以顺便学习一下如果给帐号修改密码！</span></strong>\r\n </p>\r\n</p>\r\n<p>\r\n <a href="http://news.baidu.com/ns?cl=2&rn=20&tn=news&word;"></a>\r\n</p>', '', '', '0', '30', '', '8', '8', '1345626586', '1358497561', '1345626582', '', '999', '1', 'zh_cn');
INSERT INTO `ask` VALUES ('5', '9', 'seo技术研究内容几大要点', '1', 'seo技术', '市场及竞争研究：关键词研究，分布，流量预估，竞争对手研究，网站诊断\r\n制定计划：设定目标，流量分析软件，指标基准，工作计划及预算', '<p>\r\n <span style="line-height:2;">市场及竞争研究：关键词研究，分布，流量预估，竞争对手研究，网站诊断</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">制定计划：设定目标，流量分析软件，指标基准，工作计划及预算</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">网站架构优化：内容设计，避免蜘蛛陷阱，导航设计，禁止收录，内部链接结构</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">页面优化：meta标签，正文写作，H标签，ALT文字，精简代码</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">外链建设：链接分析，高质量外链，外链原则，链接诱饵</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">监测和改进：收录，排名，外链，流量，转化，策略调整</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">其他：主机域名，作弊与惩罚，整合搜索，地理定位，多语种，项目管理，内容策略</span>\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <strong><span style="line-height:2;">本文转自百度站长平台社区，应该是 卢松松 整理发布</span></strong>\r\n</p>', '', '', '0', '31', '', '12', '12', '1348035566', '1358497620', '1348035559', '', '999', '1', 'zh_cn');
INSERT INTO `ask` VALUES ('6', '9', '后台管理菜单更新后，系统中没反映', '1', '系统安装', '最近已经有好几位用户问到，为什么权限管理中的标题改变之后，后台菜单却没有改变。', '<p style="font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif;background-color:#FFFFFF;color:#333333;">\r\n <p>\r\n  <span><span style="line-height:2;">最近已经有好几位用户</span><span style="line-height:2;">问到，为什么权限管理中的标题改变之后，后台菜单却没有改变。</span></span>\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <span style="line-height:2;">原因在于：为了系统使用的速度，减少数据库查询，将用户组权限通过session缓存，不会马上更新。</span>\r\n </p>\r\n <p>\r\n  <br />\r\n </p>\r\n <p>\r\n  <span style="line-height:2;">解决方法：如果你需要马上看到更新后的效果，请重新分配用户组权限！</span>\r\n </p>\r\n</p>', '', '', '0', '32', '', '10', '10', '1348035582', '1358497709', '1348035575', '', '999', '1', 'zh_cn');
INSERT INTO `ask` VALUES ('8', '9', '文章发布时间已经到了，前台不显示的原因', '1', '文章发布', '文章发布时间已经到了，前台不显示的原因有两种：\r\n1、首页缓存还未更新，一般不存在，如果网站做了cdn等可能会出现', '<p>\r\n <span style="line-height:2;">文章发布时间已经到了，前台不显示的原因有两种：</span> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">1、首页缓存还未更新，一般不存在，如果网站做了cdn等可能会出现</span> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">2、系统时区未设置，2.0版本未设置默认时区，可能会相差几个小时，2.1之后的版本都设置的为北京时间，如果需要将系统应用于相应地区，请修改时区设置。</span> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">设置方法：</span> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">在根目录下的index.php的&lt;?php的下一行加上以下代码，2.1之后不需要添加，直接修改即可</span> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">date_default_timezone_set ("Asia/Shanghai");</span> \r\n</p>\r\n<p>\r\n <span style="line-height:2;">其中Asia/Shanghai 为上海的时区，大陆还可使用：Asia/Chongqing &nbsp;重庆和Asia/Urumqi 乌鲁木齐</span> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">港台地区可使用：Asia/Macao 澳门 ，Asia/Hong_Kong 香港 ，Asia/Taipei 台北</span> \r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <span style="line-height:2;">新加坡：Asia/Singapore</span> \r\n</p>', '', '', '0', '33,34', '', '22', '22', '1358150992', '1358498069', '1358150980', '', '999', '1', 'zh_cn');
INSERT INTO `ask` VALUES ('10', '9', '1', '0', '1', '1', '1111', '', '', '0', '1', '', '10', '0', '0', '0', '1445270400', '', '999', '0', 'zh_cn');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lft` mediumint(9) unsigned NOT NULL,
  `rht` mediumint(9) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `isexternal` tinyint(1) NOT NULL DEFAULT '0',
  `externalurl` varchar(255) NOT NULL,
  `target` varchar(10) NOT NULL DEFAULT '_self',
  `dir` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `model` varchar(20) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `color` char(7) NOT NULL,
  `tpllist` varchar(20) NOT NULL,
  `tpldetail` varchar(20) NOT NULL,
  `pagesize` tinyint(4) unsigned NOT NULL,
  `isnavigation` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `isdisabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` tinyint(4) unsigned NOT NULL DEFAULT '99',
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `lang` (`lang`),
  KEY `dir` (`dir`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '0', '1', '10', '技术文章', '0', '', '_self', 'news', '', '', '0', 'article', '', '', '', '', '', '2', '1', '0', '2', 'zh_cn');
INSERT INTO `category` VALUES ('2', '1', '2', '3', '行业动态', '0', '', '_self', 'hangye', '', '', '', 'article', '', '', '', '', '', '0', '1', '0', '99', 'zh_cn');
INSERT INTO `category` VALUES ('3', '0', '11', '16', '案例', '0', '', '_self', 'product', '', '', '0', 'product', '', '', '', '', '', '0', '1', '1', '1', 'zh_cn');
INSERT INTO `category` VALUES ('4', '0', '17', '20', '下载', '0', '', '_self', 'down', '', '', '0', 'down', '', '', '', '', '', '0', '1', '1', '3', 'zh_cn');
INSERT INTO `category` VALUES ('6', '5', '22', '23', '技术类', '0', '', '_self', 'technology', '', '', '0', 'hr', '', '', '', '', '', '0', '1', '0', '99', 'zh_cn');
INSERT INTO `category` VALUES ('7', '0', '25', '26', '关于', '0', '', '_self', 'about', '管理系统简介', '管理系统简介', '', 'page', '', '<p>\r\n	<br />\r\n</p>', '', '', '', '0', '1', '0', '7', 'zh_cn');
INSERT INTO `category` VALUES ('10', '3', '12', '13', '优惠套餐', '0', '', '_self', 'youhui', '', '', '', 'product', '', '', '', '', '', '0', '1', '0', '99', 'zh_cn');
INSERT INTO `category` VALUES ('11', '3', '14', '15', '产品案例', '0', '', '_self', 'fuwu', '', '', '0', 'product', '', '', '', '', '', '0', '1', '0', '99', 'zh_cn');
INSERT INTO `category` VALUES ('13', '12', '5', '8', '帮助中心', '0', '', '_self', 'help', '', '', '', 'article', '', '', '', '', '', '0', '1', '0', '99', 'zh_cn');
INSERT INTO `category` VALUES ('14', '4', '18', '19', 'nodecms1.0', '0', '', '_self', 'kaiyuan', '', '', '', 'down', '', '', '', '', '', '0', '1', '0', '99', 'zh_cn');
INSERT INTO `category` VALUES ('15', '0', '1', '6', 'Product', '0', '', '_self', 'product', '', '', '', 'product', '', '', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('16', '15', '2', '3', 'Special Package', '0', '', '_self', 'youhui', '', '', '', 'product', '', '', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('17', '15', '4', '5', 'Products and service', '0', '', '_self', 'fuwu', '', '', '', 'product', '', '', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('18', '0', '7', '8', 'News', '0', '', '_self', 'news', '', '', '', 'article', '', '', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('19', '0', '9', '10', 'Down', '0', '', '_self', 'down', '', '', '', 'down', '', '', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('20', '0', '11', '12', 'Recruitment', '0', '', '_self', 'hr', '', '', '', 'hr', '', '', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('21', '0', '13', '14', 'Ask', '0', '', '_self', 'ask', '', '', '', 'ask', '', '', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('22', '0', '15', '16', 'Guestbook', '0', '', '_self', 'guestbook', '', '', '', 'guestbook', '', '', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('23', '0', '17', '18', 'About us', '0', '', '_self', 'aboutus', '', '', '', 'page', '', 'aboutus', '', '', '', '0', '1', '0', '99', 'en');
INSERT INTO `category` VALUES ('25', '1', '31', '32', '技术资讯', '1', 'http://bbs.x6cms.com', '_blank', 'bbs', '', '', '', 'article', '', '', '', '', '', '0', '1', '0', '99', 'zh_cn');
INSERT INTO `category` VALUES ('31', '0', '0', '0', '服务', '1', '', '_self', 'service', '服务', '服务', '服务', 'page', '', '服务', '', '', '', '0', '1', '1', '0', 'zh_cn');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `varname` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` char(10) NOT NULL,
  `value` text NOT NULL,
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `varname` (`varname`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'site_name', '', 'base', '', '1', 'zh_cn');
INSERT INTO `config` VALUES ('2', 'site_title', '', 'base', '', '1', 'zh_cn');
INSERT INTO `config` VALUES ('3', 'site_keywords', '', 'base', '', '1', 'zh_cn');
INSERT INTO `config` VALUES ('4', 'site_description', '', 'base', '', '1', 'zh_cn');
INSERT INTO `config` VALUES ('5', 'site_code', '', 'base', '', '1', 'zh_cn');
INSERT INTO `config` VALUES ('6', 'site_logo', '', 'base', '', '1', 'zh_cn');
INSERT INTO `config` VALUES ('7', 'site_template', '', 'base', '', '1', 'zh_cn');
INSERT INTO `config` VALUES ('8', 'site_beian', '备案号', 'base', '', '0', 'zh_cn');
INSERT INTO `config` VALUES ('9', 'site_name', '', 'base', 'Six network technology', '1', 'en');
INSERT INTO `config` VALUES ('10', 'site_title', '', 'base', 'X6CMS is a function of a sound marketing website content management platform', '1', 'en');
INSERT INTO `config` VALUES ('11', 'site_keywords', '', 'base', 'X6CMS, website management system', '1', 'en');
INSERT INTO `config` VALUES ('12', 'site_description', '', 'base', '', '1', 'en');
INSERT INTO `config` VALUES ('13', 'site_code', '', 'base', '', '1', 'en');
INSERT INTO `config` VALUES ('14', 'site_logo', '', 'base', 'images/logo.png', '1', 'en');
INSERT INTO `config` VALUES ('15', 'site_template', '', 'base', 'default', '1', 'en');
INSERT INTO `config` VALUES ('34', 'water_type', '', 'attr', '2', '1', '0');
INSERT INTO `config` VALUES ('33', 'attr_allowtype', '', 'attr', '', '1', '0');
INSERT INTO `config` VALUES ('32', 'attr_maxsize', '', 'attr', '200', '1', '0');
INSERT INTO `config` VALUES ('21', 'site_adminlang', '', 'lang', 'en', '1', '0');
INSERT INTO `config` VALUES ('22', 'site_frontlang', '', 'lang', 'en', '1', '0');
INSERT INTO `config` VALUES ('23', 'site_home', '', 'base', '', '1', 'en');
INSERT INTO `config` VALUES ('25', 'site_home', '', 'base', '', '1', 'zh_cn');
INSERT INTO `config` VALUES ('26', 'smtp_host', '', 'mail', '12', '1', '0');
INSERT INTO `config` VALUES ('27', 'smtp_user', '', 'mail', '12', '1', '0');
INSERT INTO `config` VALUES ('28', 'smtp_pass', '', 'mail', '12', '1', '0');
INSERT INTO `config` VALUES ('29', 'smtp_port', '', 'mail', '12', '1', '0');
INSERT INTO `config` VALUES ('30', 'smtp_sendmail', '', 'mail', '12', '1', '0');
INSERT INTO `config` VALUES ('31', 'mail_type', '', 'mail', 'smtp', '1', '0');
INSERT INTO `config` VALUES ('35', 'water_text_value', '', 'attr', 'Powered by X6CMS', '1', '0');
INSERT INTO `config` VALUES ('36', 'water_text_size', '', 'attr', '24', '1', '0');
INSERT INTO `config` VALUES ('37', 'water_text_color', '', 'attr', '#990000', '1', '0');
INSERT INTO `config` VALUES ('38', 'water_text_font', '', 'attr', '', '1', '0');
INSERT INTO `config` VALUES ('39', 'water_minwidth', '', 'attr', '200', '1', '0');
INSERT INTO `config` VALUES ('40', 'water_minheight', '', 'attr', '100', '1', '0');
INSERT INTO `config` VALUES ('41', 'water_padding', '', 'attr', '-20', '1', '0');
INSERT INTO `config` VALUES ('42', 'water_opacity', '', 'attr', '10', '1', '0');
INSERT INTO `config` VALUES ('43', 'water_quality', '', 'attr', '100', '1', '0');
INSERT INTO `config` VALUES ('44', 'water_position', '', 'attr', 'bottomright', '1', '0');
INSERT INTO `config` VALUES ('45', 'water_image_path', '', 'attr', 'data/attachment/image/20130131/638be3a673f86444ee7d48637cf015fa.png', '1', '0');

-- ----------------------------
-- Table structure for down
-- ----------------------------
DROP TABLE IF EXISTS `down`;
CREATE TABLE `down` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(120) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `color` char(7) NOT NULL,
  `attrurl` varchar(100) NOT NULL,
  `attrname` varchar(100) NOT NULL,
  `isbold` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL,
  `recommends` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `realhits` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `puttime` int(10) unsigned NOT NULL DEFAULT '0',
  `tpl` varchar(20) NOT NULL,
  `listorder` int(10) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `lang` (`lang`),
  KEY `recommend` (`recommends`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of down
-- ----------------------------
INSERT INTO `down` VALUES ('2', '14', 'X6CMS网站管理系统2.2', '1', 'X6CMS网站管理系统2.2', 'X6CMS网站管理系统2.2', 'X6CMS网站内容管理系统X6CMS网站内容管理系统X6CMS网站内容管理系统X6CMS网站内容管理系统', 'data/attachment/image/20130219/8c1c6c1b102039d8b68a863b586ce4a5.jpg', '', 'data/attachment/file/20130116/20130116084904_34694.rar', '测试文件', '0', '0', '', '38', '48', '1358239566', '1361284009', '1358239545', '', '1', '1', 'zh_cn');
INSERT INTO `down` VALUES ('3', '14', 'X6CMS网站管理系统1.0', '1', 'X6CMS网站管理系统1.0', 'X6CMS网站管理系统1.0', '', 'data/attachment/image/20130219/8c1c6c1b102039d8b68a863b586ce4a5.jpg', '', 'data/attachment/file/20130116/20130116084904_34694.rar', '', '0', '0', '', '4', '4', '1359698708', '1361284021', '1359698690', '', '4', '1', 'zh_cn');
INSERT INTO `down` VALUES ('4', '14', 'X6CMS网站管理系统2.0', '1', 'X6CMS网站管理系统2.0', 'X6CMS网站管理系统2.0', '', 'data/attachment/image/20130219/8c1c6c1b102039d8b68a863b586ce4a5.jpg', '', 'data/attachment/file/20130116/20130116084904_34694.rar', '', '0', '0', '', '1', '1', '1359698719', '1361284025', '1359698711', '', '3', '1', 'zh_cn');
INSERT INTO `down` VALUES ('5', '14', 'X6CMS网站管理系统2.1', '1', 'X6CMS网站管理系统2.1', 'X6CMS网站管理系统2.1', '<br />', 'data/attachment/image/20130219/8c1c6c1b102039d8b68a863b586ce4a5.jpg', '', 'data/attachment/file/20130116/20130116084904_34694.rar', '', '0', '0', '', '6', '6', '1359698727', '1361284030', '1359698722', '', '2', '1', 'zh_cn');
INSERT INTO `down` VALUES ('6', '4', '测试下载', '0', '测试下载', '测试下载', '测试下载测试下载测试下载', '', '', '测试下载', '测试下载', '0', '测试下载', '', '12', '0', '0', '0', '1446480000', '', '12', '0', 'zh_cn');

-- ----------------------------
-- Table structure for fragment
-- ----------------------------
DROP TABLE IF EXISTS `fragment`;
CREATE TABLE `fragment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `varname` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `remark` mediumtext NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fragment
-- ----------------------------
INSERT INTO `fragment` VALUES ('1', '首页-产品介绍', 'index_cpjs', '<h2>\r\n <a href="><img alt=" align="left" src="data/attachment/image/20121029/20121029091643_53887.png" width="108" height="150" /></a> \r\n</h2>\r\n<div>\r\n <a href="><span></span></a> \r\n</div>\r\n<div>\r\n <h2>\r\n  <span style="color:#006600;">X6CMS网站</span><span style="color:#006600;">内容管理系统 v2.0</span> \r\n </h2>\r\n<span style="line-height:2.5;color:#666666;">X6CMS：全称小六网站内容管理系统<span style="color:#666666;line-height:30px;">。X6CMS是一个功能完善的营销型网站管理平台，采用PHP+MYSQL架构，全站内置SEO优化机制，界面简介，操作方便。<span style="color:#666666;line-height:30px;">&nbsp;X6CMS系统核心采用Codeigniter框架，同时作为免费开源软件发布，集众多开源项目于一身，使X6CMS从安全、效率、易用及扩展性更</span><span style="color:#666666;line-height:30px;">加突出。<span style="color:#666666;line-height:30px;">&nbsp;X6CMS系统核心采用Codeigniter框架，同时作为免费开源软件发布，集众多开源项目于一身，使X6CMS从安全、效率、易用及扩展性更</span><span style="color:#666666;line-height:30px;">加突出。</span></span></span></span> \r\n</div>', '', '0', '1359699157', '1', 'zh_cn');
INSERT INTO `fragment` VALUES ('4', '联系我们', 'contact', '<p>\r\n <span style="line-height:24px;color:#003399;"><strong>联系我们</strong></span> \r\n</p>\r\n<p>\r\n <span style="line-height:2;color:#666666;">QQ：355997214</span><span id="__kindeditor_bookmark_start_22__"></span>\r\n</p>\r\n<p>\r\n <span style="line-height:2;color:#666666;">邮箱：admin@x6cms.com</span> \r\n</p>\r\n<p>\r\n <span style="line-height:2;color:#666666;">联系人：小六</span> \r\n</p>\r\n<p>\r\n <span style="line-height:2;color:#666666;">网址：<a href="http://www.x6cms.com" target="_blank">http://www.x6cms.com</a></span> \r\n</p>\r\n<p>\r\n <span style="line-height:2;color:#666666;">地址：西安市高新区唐延路1号旺座国际城B座9层</span> \r\n</p>', '', '0', '1361413566', '1', 'zh_cn');
INSERT INTO `fragment` VALUES ('5', '首页_介绍', 'home_intro', '<h1 style="font-weight:normal;font-size:4.1em;color:#555555;font-family:\'Open sans\', \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif;">\r\n	WEB DESIGN&nbsp;<br />\r\nWEB DEVELOPMENT&nbsp;<br />\r\nGRAPHIC DESIGN\r\n</h1>\r\n<p style="color:#555555;font-family:\'Open sans\', \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif;font-size:13px;">\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit amet enim. Suspendisse id velit vitae ligula volutpat condimentum. Aliquam erat volutpat. Sed quis velit.\r\n</p>\r\n<p style="color:#555555;font-family:\'Open sans\', \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif;font-size:13px;">\r\n	Vivamus pharetra posuere sapien. Nam consectetuer. Sed aliquam, nunc eget euismod ullamcorper, lectus nunc ullamcorper orci, fermentum bibendum enim nibh eget ipsum.\r\n</p>', '首页_介绍', '0', '0', '1', 'zh_cn');

-- ----------------------------
-- Table structure for guestbook
-- ----------------------------
DROP TABLE IF EXISTS `guestbook`;
CREATE TABLE `guestbook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `replyuid` int(10) unsigned NOT NULL DEFAULT '0',
  `author` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `replytime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` mediumint(9) NOT NULL DEFAULT '999',
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guestbook
-- ----------------------------
INSERT INTO `guestbook` VALUES ('39', '8', '测试留言', '1', '1', '小六', 'admin@x6cms.com', '', '', '测试留言测试留言测试留言测试留言测试留言测试留言测试留言', '0', '1361263087', '1', '999', 'zh_cn');
INSERT INTO `guestbook` VALUES ('40', '8', '33', '1', '1', '33', '33@33.com', '', '', '333', '1361264170', '1361264181', '1', '999', 'zh_cn');
INSERT INTO `guestbook` VALUES ('41', '8', '33', '1', '1', '333', '33@qq.com', '1361264204', '禁用禁用', '12341234', '2015', '2015', '0', '999', 'zh_cn');

-- ----------------------------
-- Table structure for hr
-- ----------------------------
DROP TABLE IF EXISTS `hr`;
CREATE TABLE `hr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(120) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `num` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `color` char(7) NOT NULL,
  `isbold` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL,
  `recommends` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `realhits` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `puttime` int(10) unsigned NOT NULL DEFAULT '0',
  `tpl` varchar(20) NOT NULL,
  `listorder` int(10) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `lang` (`lang`),
  KEY `recommend` (`recommends`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr
-- ----------------------------
INSERT INTO `hr` VALUES ('1', '30', 'php程序员', '1', 'php程序员', '', '没有要求！', '100', '西安', '2年以上', '', '', '0', '0', '', '17', '17', '1357710860', '1358514652', '1357710839', '', '999', '1', 'zh_cn');
INSERT INTO `hr` VALUES ('2', '30', '网页美工', '1', '网页美工', '', '没有要求', '99', '西安', '1年以上', '', '', '0', '0', '', '16', '16', '1358514682', '1358514682', '2015', '', '999', '1', 'zh_cn');

-- ----------------------------
-- Table structure for keywords
-- ----------------------------
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE `keywords` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `listorder` int(3) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keywords
-- ----------------------------
INSERT INTO `keywords` VALUES ('3', 'X6CMS', 'http://www.x6cms.com', '99', '1', 'zh_cn');

-- ----------------------------
-- Table structure for lang
-- ----------------------------
DROP TABLE IF EXISTS `lang`;
CREATE TABLE `lang` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `varname` varchar(20) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `listorder` tinyint(4) unsigned NOT NULL DEFAULT '99',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lang
-- ----------------------------
INSERT INTO `lang` VALUES ('1', '简体中文', 'zh_cn', 'data/language/zh_cn/zh_cn.gif', '1', '1');
INSERT INTO `lang` VALUES ('2', 'English', 'en', 'data/language/en/en.gif', '2', '1');

-- ----------------------------
-- Table structure for link
-- ----------------------------
DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` mediumint(8) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `url` varchar(150) NOT NULL,
  `remark` mediumtext NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` int(3) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`type`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of link
-- ----------------------------
INSERT INTO `link` VALUES ('1', '0', 'X6论坛', '网站建设知识分享社区', '', 'http://bbs.x6cms.com', '默认友情链接', '1336135102', '1336135390', '2', '1', 'zh_cn');
INSERT INTO `link` VALUES ('3', '0', '小六网络科技', '西安网站建设、西安做网站', '', 'http://soft.x6cms.com', '', '0', '0', '99', '1', 'zh_cn');
INSERT INTO `link` VALUES ('2', '0', '网站管理系统', 'X6CMS网站内容管理系统', '', 'http://www.x6cms.com', '默认友情链接', '0', '0', '1', '1', 'zh_cn');
INSERT INTO `link` VALUES ('4', '6', '百度', '百度', 'http://img6.dilisx.com/images/cms/10/26/ZGlsaTIvTTAwLzAxLzBFL3dLZ2NLRlM4bmR5QVpUWWdBQURMY0hKT280azM3', 'http://www.jinxibox.com/', '百度', '0', '0', '12', '1', 'zh_cn');

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of login
-- ----------------------------

-- ----------------------------
-- Table structure for model
-- ----------------------------
DROP TABLE IF EXISTS `model`;
CREATE TABLE `model` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `varname` varchar(20) NOT NULL,
  `listorder` tinyint(4) unsigned NOT NULL DEFAULT '99',
  `issearch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isrecommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of model
-- ----------------------------
INSERT INTO `model` VALUES ('1', 'article', '99', '1', '1', '1');
INSERT INTO `model` VALUES ('2', 'product', '99', '1', '1', '1');
INSERT INTO `model` VALUES ('3', 'down', '99', '1', '1', '1');
INSERT INTO `model` VALUES ('4', 'page', '99', '0', '0', '1');
INSERT INTO `model` VALUES ('5', 'hr', '99', '1', '1', '1');
INSERT INTO `model` VALUES ('6', 'ask', '99', '1', '1', '1');
INSERT INTO `model` VALUES ('7', 'guestbook', '99', '0', '0', '1');

-- ----------------------------
-- Table structure for navigation
-- ----------------------------
DROP TABLE IF EXISTS `navigation`;
CREATE TABLE `navigation` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` mediumint(8) unsigned NOT NULL,
  `title` varchar(20) NOT NULL,
  `url` varchar(200) NOT NULL,
  `color` char(7) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `rel` varchar(20) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `listorder` tinyint(4) unsigned NOT NULL DEFAULT '99',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of navigation
-- ----------------------------
INSERT INTO `navigation` VALUES ('21', '4', '网站地图', 'sitemap', '0', '', '', '', '2', '1', 'zh_cn');
INSERT INTO `navigation` VALUES ('25', '4', 'RSS订阅', 'rss', '0', '', '', '', '3', '1', 'zh_cn');
INSERT INTO `navigation` VALUES ('28', '4', '测试导航', 'hr', '', '测试导航', '', 'http://img6.dilisx.com/images/cms/10/26/ZGlsaTIvTTAwLzAxLzBFL3dLZ2NLRlM4bmR5QVpUWWdBQURMY0hKT280azM3', '12', '1', 'zh_cn');

-- ----------------------------
-- Table structure for online
-- ----------------------------
DROP TABLE IF EXISTS `online`;
CREATE TABLE `online` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `remark` mediumtext NOT NULL,
  `listorder` int(3) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`type`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of online
-- ----------------------------
INSERT INTO `online` VALUES ('1', 'qq', 'BUG提交', '355997214', '0', '2', '1', 'zh_cn');
INSERT INTO `online` VALUES ('4', 'qq', '授权咨询', '355997214', '0', '1', '1', 'zh_cn');
INSERT INTO `online` VALUES ('5', 'qq', '建站咨询', '355997214', '0', '3', '1', 'zh_cn');
INSERT INTO `online` VALUES ('6', 'code', '联系电话', '<font color="red"><b>13888888888</b></font>', '0', '6', '1', 'zh_cn');
INSERT INTO `online` VALUES ('7', 'email', '小六邮箱', 'admin@x6cms.com', '0', '5', '1', 'zh_cn');
INSERT INTO `online` VALUES ('10', 'wangwang', '旺旺客服', '120377843', '0', '4', '0', 'zh_cn');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of page
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(120) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `price` float(10,2) unsigned NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `color` char(7) NOT NULL,
  `isbold` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL,
  `recommends` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `realhits` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `puttime` int(10) unsigned NOT NULL DEFAULT '0',
  `tpl` varchar(20) NOT NULL,
  `listorder` int(10) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  `client` varchar(255) NOT NULL DEFAULT '',
  `details` varchar(255) NOT NULL DEFAULT '',
  `technology` varchar(255) NOT NULL DEFAULT '',
  `links` varchar(255) NOT NULL DEFAULT '',
  `testimonial` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `lang` (`lang`),
  KEY `recommend` (`recommends`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', '11', '网站建设', '1', '', '我们专注策划和理念，在您的企业网站中用色彩升华到极致！', '<p>\r\n	<strong>一、网站建设分类</strong> \r\n</p>\r\n<strong>企业形象类</strong> \r\n<p>\r\n	企业官网首要目的是要展示企业的形象，宣传企业文化扩大行业内的影响力。网站建设注重企业的稳定性和丰富的信息量，配合旗下的产品和主打系列进行联合推广，部分网站建设在此基础上添加了旗下产品的在线商城建设和交流平台建设。\r\n</p>\r\n<div>\r\n	<table class="ke-zeroborder" border="0">\r\n		<tbody>\r\n			<tr>\r\n				<td valign="top">\r\n					<span><span>类型特点</span></span> \r\n				</td>\r\n				<td valign="top">\r\n					企业形象官网强调的是展现企业的实力及企业的形象，宣传的角度和品牌展示有所差异。这种类型的网站强调对外介绍企业。因此企业的概况、企业的规模、企业的团队和业务服务等介绍是网站的主要任务。条件允许时也可以与OA等系统结合作为企业信息化的手段。<br />\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td valign="top" width="71">\r\n					<span><span>设计理念</span></span> \r\n				</td>\r\n				<td valign="top" width="637">\r\n					网站建设整体版面大气流畅，在配合行业特质的基础上进行构架设计，页面呈现过程当中少用flash提高首页的访问速度，系统架构稳定安全，在提高整个网站动态交互的同时，让内容更容易识别,扩展 VI系统，加强标志形象在目标群体中的认知与深入。<br />\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td valign="top">\r\n					<span><span>预选功能</span></span> \r\n				</td>\r\n				<td valign="top">\r\n					企业形象展示、新闻发布系统、企业信息系统、产品管理系统、人才招聘系统、下载管理系统、站内检索、留言管理系统、会员管理系统。\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<div>\r\n		<strong>学校官网类</strong> \r\n		<p>\r\n			建立完善的学校官网不仅能让地区内的人们了解学校,更可让世界了解你的学校. 学校网站能提供教学互动的全新方式使得教师与教师,教师与学生,学生与学生之间的交流有了全新的方式,它不再受到传统课堂的制约.\r\n		</p>\r\n	</div>\r\n	<div>\r\n		<table class="ke-zeroborder" border="0">\r\n			<tbody>\r\n				<tr>\r\n					<td valign="top">\r\n						<span><span>类型特点</span></span> \r\n					</td>\r\n					<td valign="top">\r\n						学校官网强调的是加强学校、家长、学生三者之间的互动，从网络角度出发丰富学生的课余活动。此外网站作为学校互联网对外窗口，能对校风的展示、校务的公开、招生招聘等信息的传播起到重要作用。另外互联网发达的今天，学校的网络中心以及各种资源共享都需要学校网站的支持。<br />\r\n					</td>\r\n				</tr>\r\n				<tr>\r\n					<td valign="top" width="71">\r\n						<span><span>设计理念</span></span> \r\n					</td>\r\n					<td valign="top" width="637">\r\n						大学的稳重踏实、中学的青春奋发、小学的活泼生动、幼儿园的童真志趣，根据不同学校的特色特点，设计上有很大的差别，相同的是都以凸显学校特色、加强学生和家长的互动性，提高访问者体验位目标。<br />\r\n					</td>\r\n				</tr>\r\n				<tr>\r\n					<td valign="top">\r\n						<span><span>预选功能</span></span> \r\n					</td>\r\n					<td valign="top">\r\n						新闻内容发布系统、图片管理系统、下载管理系统、招生招聘系统、班级管理、班级主页、科组主页、家长交流论坛、站内检索\r\n					</td>\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n	</div>\r\n	<p>\r\n		<br />\r\n	</p>\r\n	<div>\r\n		<strong>行业门户类</strong> \r\n		<p>\r\n			随着互联网络的发展，各行业企业对产品信息、价格行情、发展趋势等信息的需求愈益转向网络的表现和实现，而行业门户网站正好解决了以上问题。企业通过建立行业门户型网站，积极开展网络营销，网上采购、供需链管理和客户关系管理等，形成网上行业贸易区，而行业门户型网站建设方一方面可以树立行业的权威性，在促进各个企业之间贸易发展的同时可以获得一定的附加服务收益。\r\n		</p>\r\n		<p>\r\n			<br />\r\n		</p>\r\n		<p>\r\n			<span><strong>二、服务流程</strong></span> \r\n		</p>\r\n		<p>\r\n			<br />\r\n		</p>\r\n		<p>\r\n			<span><strong>三、建站技术优势</strong></span> \r\n		</p>\r\n		<p>\r\n			<span>一流的美工设计团队</span> \r\n		</p>\r\n		<div>\r\n			<span>企联的设计师均毕业于高等美术院校，具备二年以上商业设计的经验。员工进入公司后，接受过系统的WIS（网站视觉识别系统）的培训，善于与客户作良性的沟通，最终达至完美的美工设计效果。</span> \r\n		</div>\r\n		<div>\r\n			<div>\r\n				<span></span> \r\n			</div>\r\n			<div>\r\n				<div ;=" color:=" #221815"=" 微软雅黑?;font-size:18px;?="><span>采用国际新标准构建网站</span> \r\n			</div>\r\n			<div>\r\n				<span>采用国际新标准DIV+CSS构建网站，可使您的网站即刻具备以下优势：<br />\r\n<br />\r\n·搜索引擎优化效果更佳<br />\r\n·页面呈现速度快30%以上<br />\r\n·代码量直接精简40%以上<br />\r\n·多浏览器兼容性更好，有利于国际化<br />\r\n·直接提升并发访问性能<br />\r\n·有效节省服务器的带宽成本 </span> \r\n			</div>\r\n		</div>\r\n		<div>\r\n			<span></span> \r\n		</div>\r\n	</div>\r\n	<div>\r\n		<div>\r\n			<span></span> \r\n		</div>\r\n		<div>\r\n			<div ;=" color:=" #221815"=" 微软雅黑?;font-size:18px;?="><span>专职项目经理负责制</span> \r\n		</div>\r\n		<div>\r\n			<span>业精于专，企联拥有专门的项目管理部门项目中心；成熟的项目管理流程和专业的项目经理将是项目按质按量完成的最高保证。<br />\r\n<br />\r\n企联项目总监拥有互联网行业11年工作经验，每一个项目经理均具有计算机和网络的专业技术背景，受过专业的项目管理培训，项目实施经验丰富。因此能有效地与您良好沟通，为您把握项目的整体质量、进度和预算。为了让您省力、省时、省心，企联已全面推行一对一顾问式服务。 </span> \r\n		</div>\r\n	</div>\r\n</div>\r\n<div>\r\n	<div>\r\n		<span></span> \r\n	</div>\r\n	<div>\r\n		<div ;=" color:=" #221815"=" 微软雅黑?;font-size:18px;?="><span>强大的网站安全检测体系</span> \r\n	</div>\r\n	<div>\r\n		<span>企联研发中心安全测试团队多年深入研究当前各类流行Web攻击手段，积累了丰富的攻防经验，可对客户网站和服务器进行全面的、深入的、彻底的风险评估，找出安全隐患，彻底解决安全问题。<br />\r\n<br />\r\n企联每个上线项目均通安全测试团队进行web渗透测试、数据库渗透测试、操作系统渗透测试，并为项目客户免费提供应急响应服务：<br />\r\n·对服务器的安全性能进行全面检测，提供软件系统/网站程序的修复、补漏及防护措施等服务<br />\r\n·提供系统性能优化、安全防护加固服务<br />\r\n·对服务器提供日常的系统维护，不断更新安全防护技术及设置<br />\r\n·提供安全培训、安全顾问服务<br />\r\n·服务响应要求7×24小时 </span> \r\n	</div>\r\n</div>\r\n	</div>\r\n	<div>\r\n		<div>\r\n			<span></span> \r\n		</div>\r\n		<div>\r\n			<div ;=" color:=" #221815"=" 微软雅黑?;font-size:18px;?="><span>完善的售后服务体系</span> \r\n		</div>\r\n		<div>\r\n			<span>对于企联来说，一个网站的完成，绝不是服务的终点，而是服务的新起点。为了解决您的后顾之忧，我们提供了完善的服务体系。<br />\r\n<br />\r\n·完善的网站维护解决方案<br />\r\n·专业的售后服务团队<br />\r\n·开展主动式的客户回访与服务<br />\r\n·可提供长达2年的免费维护期*<br />\r\n·功能平台免费升级服务*</span> \r\n		</div>\r\n	</div>\r\n</div>\r\n<p>\r\n	<img src="/uploads/2015-08-11/647690575181.jpg" alt=" />\r\n</p>\r\n	</div>\r\n</div>\r\n<p>\r\n	<span></span> \r\n</p>', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '16', '', '19', '19', '1345188426', '1358514799', '1345188421', '', '1', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('7', '10', '速成型网站建设套餐', '1', '速成型网站建设套餐', '<b>速成型网站建设套餐</b>:适用于个人或企业预算较少、急需上线的客户群体，固定的网站设计风格。', '<p>\r\n	<strong></strong><strong>速成型网站建设套餐</strong> \r\n</p>\r\n<p>\r\n	<strong></strong> \r\n</p>\r\n<p>\r\n	<span>适 用 于：适用于个人或企业预算较少、急需上线的客户群体。<br />\r\n</span><span>网站设计：固定的网站设计风格<br />\r\n网站域名：国际顶级域名1个（.com/.net/.com.cn/.cn等）<br />\r\n网站主机：&nbsp;经济型标准空间100M</span><span><br />\r\n企业邮局企业邮局：50M（建议直接用QQ企业邮箱，可将邮箱绑定到QQ邮箱，自动提醒）<br />\r\n</span><span>制作周期：3个工作日<br />\r\n价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 格：<span><strong>1880.00</strong></span>元</span><span><br />\r\n售&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 后：免费培训网站使用技巧， 7*24小时客服服务。</span> \r\n</p>', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '29', '', '60', '60', '1347872719', '1358239331', '1347870328', '', '1', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('2', '11', '网络推广', '1', '网络推广', '我们专业的SEO优化技术让您网站在百度的搜索排名不断靠前！', '<p>\r\n	<span style="line-height:1.5;"> </span><b>-- 在网络中做生意，你首先得推广，这是前提的前提，没有推广万事皆空。推广的方式有很多，相比之下，SEO优化，效果显著，成本又低廉，易于控制。</b> \r\n</p>\r\n<p>\r\n	当今网站、网店、论坛等越来越多，已经远远超过了牛毛的数量。所以，制作网站、博客、论坛等，越来越易;推广起来，越来越难;推广不好，流量可想而知就上不去了。俗话说的好“打江山容易守江山难”，而站长们现在面临的是“做网站容易推广网站难” ，当我们推广了一段时间以后，有时候发现根本就没有找到好的推广方法和思路，就像一个没头的苍蝇一样到处乱飞，一通努力下来，就没有带来几个有效的IP。那么我们怎么样才能以最好的方式推广一个网站呢?...........<br />\r\n<br />\r\n<strong><span>什么是SEO？</span></strong> \r\n</p>\r\n<p>\r\n	SEO 是“Search Engine Optimization”（搜索引擎优化）的首字母缩略词。是一种搜索引擎排名技术。即在百度、谷歌、搜搜等搜索引擎中，当别人搜索指定内容（关键字）时，让你的网站结果出现在最前端。<br />\r\n在数百万的网络用户中，75%的用户用搜索引擎查询信息，而这些用户中80%都会成为您的目标客户，并且这一数值每年都在上涨。搜索引擎已然成为了现代的“黄页”，在中文领域中，百度成为了用户使用最多的搜索引擎。<b>如果您的网站在主要搜索引擎列表的前三页中没有取得排名，您很可能将销售额拱手想让给竞争对手。</b> \r\n</p>\r\n<p>\r\n	<br />\r\n<strong><span>SEO的作用？</span></strong> \r\n</p>\r\n<p>\r\n	通过对网站的优化，提高相关产品服务关键字在搜索引擎中的自然排名，尽可能让有力信息占据搜索结果第一页，将企业口碑、品牌、正面报道的信息提前，将负面信息挤出第一页。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<strong>SEO优化</strong>：通过对网站的优化，提高相关产品服务关键字在搜索引擎中的自然排名，尽可能让有力信息占据搜索结果第一页，将企业口碑、品牌、正面报道的信息提前，将负面信息挤出第一页。\r\n<p>\r\n	<strong>竞价排名</strong>：通过付费，在指定关键字搜索结果页前端显示网站推广内容。\r\n</p>\r\n<p>\r\n	<strong>SEO服务内容：</strong> \r\n</p>\r\n<br />\r\n<p>\r\n	<strong>SEO服务流程</strong> \r\n</p>\r\n<br />\r\n<p>\r\n	<br />\r\n</p>', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '0', '', '38', '38', '1345772402', '1358515867', '1345772397', '', '2', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('3', '11', '软件开发', '1', '软件开发', '我们超前的设计理念设计出的软件不断简化您们的工作流程！', '', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '', '', '9', '9', '1347449334', '1358152774', '1347449323', '', '3', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('4', '11', '主机域名', '1', '主机域名', '7*24小时快速、稳定、安全的虚拟主机服务，胜过同业国际级机房！', '', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '', '', '7', '7', '1347449353', '1358152789', '1347449337', '', '4', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('8', '10', '经济型网站建设套餐', '1', '经济型网站建设套餐', '<b>经济型网站建设套餐</b>:适用于第一次网站制作，预算较少的客户群体，商务定制网站风格设计一套。', '<p>\r\n	<strong></strong><strong>经济型网站建设套餐</strong> \r\n</p>\r\n<p>\r\n	<strong></strong> \r\n</p>\r\n<p>\r\n	<span>适 用 于：适用于第一次网站制作，预算较少的客户群体。<br />\r\n网站设计：商务定制网站风格设计一套<br />\r\n网站功能：基础的信息发布、图片上传系统，后台管理<br />\r\n网站域名：国际顶级域名1个（.com/.net/.com.cn/.cn等）<br />\r\n网站主机： 经济型标准空间500M<br />\r\n企业邮局企业邮局：250M（建议直接用QQ企业邮箱，可将邮箱绑定到QQ邮箱，自动提醒）<br />\r\n制作周期：3个工作日<br />\r\n价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 格：<span><strong>3500-5000</strong></span></span><span><span>元</span></span> \r\n</p>\r\n<p>\r\n	<span><span></span>售&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 后：一年之内免费售后服务（培训、网站的安全、速度、稳定性）。</span> \r\n</p>', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '29', '', '19', '19', '1347886611', '1358239336', '1347885829', '', '2', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('9', '10', '营销型网站建设套餐', '1', '营销型网站建设套餐', '<b>营销型网站建设套餐</b>:适用于对版面要求高、设计和营销类的客户群，商务定制网站风格设计一套。', '<p>\r\n	<strong>营销型网站建设套餐</strong> \r\n</p>\r\n<p>\r\n	<strong></strong> \r\n</p>\r\n<p>\r\n	适 用 于：适用于对版面要求高、设计和营销类的客户群<br />\r\n网站设计：商务定制网站风格设计一套<br />\r\n网站功能：SEO标准开发，符合各大搜索引擎的抓取标准，动态生成静态<br />\r\n网站域名：国际顶级域名1个（.com/.net/.com.cn/.cn等）<br />\r\n网站主机： 经济型标准空间500M<br />\r\n企业邮局企业邮局：250M（建议直接用QQ企业邮箱，可将邮箱绑定到QQ邮箱，自动提醒）<br />\r\n制作周期：30个工作日<br />\r\n价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 格：<span><strong>5000-6500</strong></span>元<br />\r\n售&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 后：一年之内免费售后服务（培训、网站的安全、速度、稳定性）。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '29', '', '12', '12', '1347887269', '1358239344', '1347887096', '', '3', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('10', '10', '商城型网站建设套餐', '1', '商城型网站建设套餐', '<b>商城型网站建设套餐</b>:适合开展网上营销、销售，商城B2C形式的客户群，自由定制设计网站风格。', '<p>\r\n <strong>商城型网站建设套餐</strong> \r\n</p>\r\n<p>\r\n 适 用 于：适合开展网上营销、销售，商城B2C形式的客户群<br />\r\n网站设计：自由定制设计网站风格<br />\r\n网站功能：信息发布系统、购物车电子商务、订单管理系统、产品发布系统、后台管理<br />\r\n网站域名：国际顶级域名1个（.com/.net/.com.cn/.cn等）<br />\r\n网站主机： 1-10G财富主机<br />\r\n企业邮局企业邮局：免费培训QQ企业邮箱<br />\r\n制作周期：30个工作日<br />\r\n价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 格：<span ><strong>6000-12000</strong></span>元<br />\r\n售&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 后：一年之内免费售后服务（培训、网站的安全、速度、稳定性）。\r\n</p>', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '', '', '27', '27', '1347887722', '1358152779', '1347887463', '', '4', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('11', '10', '门户型网站建设套餐', '1', '门户型网站建设套餐', '<b>门户型网站建设套餐</b>:地方、行业门户建设，自由定制设计网站风格。', '<p>\r\n <strong>门户型网站建设套餐</strong><strong></strong> \r\n</p>\r\n<p>\r\n 网站设计：自由定制设计网站风格<br />\r\n网站功能：整套电子商务购物网站系统，包含权限管理、商品管理、在线商品库管理、排行榜管理、商品推荐管理、商品导购管理、会员管理、订单管理、支付管理、配送管理、广告管理、留言管理、帐务管理、及时通信管理、数据统计分析以及其它相关的业务辅助系统个子系统进行全面介绍。<br />\r\n网站域名：国际顶级域名1个（.com/.net/.com.cn/.cn等）<br />\r\n网站主机： 10G财富主机<br />\r\n制作周期：50个工作日<br />\r\n价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 格：<strong><span>10000-50000</span></strong>元<br />\r\n售&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 后：一年之内免费售后服务（培训、网站的安全、速度、稳定性）。\r\n</p>', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '29', '', '320', '20', '1347887928', '1358239349', '1351095983', '', '5', '1', 'zh_cn', '', '', '', '', '');
INSERT INTO `product` VALUES ('14', '10', '测试产品', '0', '测试产品', '<p class="mbottom">\r\n	<span style="color:#111111;font-family:Helvetica, Arial, sans-serif;line-height:19.4400005340576px;background-color:#FFFFFF;">心不唤物，物不至</span> \r\n</p>', '测试产品', '0.00', '/uploads/2015-08-11/647690575181.jpg', '', '0', '果壳', '', '12', '0', '0', '0', '2015', '', '12', '1', 'zh_cn', '百度公司', '切图写页面,前端开发', 'html5,css3', 'http://baidu.com,http://google.com', '非常专业');

-- ----------------------------
-- Table structure for purview
-- ----------------------------
DROP TABLE IF EXISTS `purview`;
CREATE TABLE `purview` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `class` varchar(20) NOT NULL,
  `method` varchar(255) NOT NULL,
  `listorder` tinyint(4) unsigned NOT NULL DEFAULT '99',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purview
-- ----------------------------
INSERT INTO `purview` VALUES ('1', '0', 'system', '', '5', '1');
INSERT INTO `purview` VALUES ('2', '1', 'purview', 'add,edit,del,order', '1', '1');
INSERT INTO `purview` VALUES ('3', '1', 'usergroup', 'add,edit,del,order,grant', '2', '1');
INSERT INTO `purview` VALUES ('4', '1', 'user', 'add,edit,del,password,profile', '3', '1');
INSERT INTO `purview` VALUES ('5', '0', 'content', '', '2', '1');
INSERT INTO `purview` VALUES ('6', '0', 'module', '', '4', '1');
INSERT INTO `purview` VALUES ('7', '0', 'seo', '', '3', '1');
INSERT INTO `purview` VALUES ('20', '6', 'type', 'add,edit,del,order', '6', '1');
INSERT INTO `purview` VALUES ('9', '6', 'link', 'add,edit,del,order', '2', '1');
INSERT INTO `purview` VALUES ('19', '1', 'config', 'add,base,lang,mail,attr,del', '6', '1');
INSERT INTO `purview` VALUES ('11', '5', 'article', 'add,edit,del,order', '2', '1');
INSERT INTO `purview` VALUES ('14', '5', 'ask', 'add,edit,del,order', '4', '1');
INSERT INTO `purview` VALUES ('15', '6', 'slide', 'add,edit,del,order', '1', '1');
INSERT INTO `purview` VALUES ('21', '5', 'category', 'add,edit,del,order', '1', '1');
INSERT INTO `purview` VALUES ('22', '6', 'navigation', 'add,edit,del,order', '3', '1');
INSERT INTO `purview` VALUES ('23', '7', 'tags', 'add,edit,del,order', '1', '1');
INSERT INTO `purview` VALUES ('24', '5', 'hr', 'add,edit,del,order', '6', '1');
INSERT INTO `purview` VALUES ('25', '5', 'product', 'add,edit,del,order', '3', '1');
INSERT INTO `purview` VALUES ('32', '0', 'personal', '', '1', '1');
INSERT INTO `purview` VALUES ('29', '7', 'robots', 'save,restore', '4', '1');
INSERT INTO `purview` VALUES ('30', '7', 'htaccess', 'save,restore', '3', '1');
INSERT INTO `purview` VALUES ('33', '32', 'main', '', '1', '1');
INSERT INTO `purview` VALUES ('36', '6', 'fragment', 'add,edit,del', '5', '1');
INSERT INTO `purview` VALUES ('37', '1', 'clearcache', '', '12', '1');
INSERT INTO `purview` VALUES ('38', '6', 'online', 'add,edit,del,order', '4', '1');
INSERT INTO `purview` VALUES ('39', '5', 'down', 'add,edit,del,order', '5', '1');
INSERT INTO `purview` VALUES ('41', '5', 'guestbook', 'add,edit,del,order', '7', '1');

-- ----------------------------
-- Table structure for recommend
-- ----------------------------
DROP TABLE IF EXISTS `recommend`;
CREATE TABLE `recommend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `model` varchar(20) NOT NULL,
  `remark` mediumtext NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` tinyint(4) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `model` (`model`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recommend
-- ----------------------------
INSERT INTO `recommend` VALUES ('1', '推荐下载', 'down', '', '1358838665', '1359696910', '99', '1', 'zh_cn');

-- ----------------------------
-- Table structure for slide
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` mediumint(8) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `url` varchar(150) NOT NULL,
  `remark` mediumtext NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` int(3) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `category` (`type`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slide
-- ----------------------------
INSERT INTO `slide` VALUES ('1', '2', 'X6CMS 2.2 正式发布！', 'X6CMS 2.2 正式发布！', '/uploads/2015-08-11/647690575181.jpg', 'http://www.x6cms.com', '', '0', '1358671121', '1', '1', 'zh_cn');
INSERT INTO `slide` VALUES ('2', '2', 'X6CMS 2.2 正式发布！', 'X6CMS 2.2 正式发布！', '/uploads/2015-08-11/647690575181.jpg', 'http://www.x6cms.com', '', '0', '1358666593', '2', '1', 'zh_cn');
INSERT INTO `slide` VALUES ('3', '2', 'X6CMS 2.2 正式发布！', 'X6CMS 2.2 正式发布！', '/uploads/2015-08-11/647690575181.jpg', 'http://www.x6cms.com', '', '0', '1358666596', '3', '1', 'zh_cn');

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `listorder` mediumint(9) unsigned NOT NULL DEFAULT '999',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('4', '西安网站建设', '%E8%A5%BF%E5%AE%89%E7%BD%91%E7%AB%99%E5%BB%BA%E8%AE%BE', '999', '1', 'zh_cn');
INSERT INTO `tags` VALUES ('5', '西安网络推广', '%E8%A5%BF%E5%AE%89%E7%BD%91%E7%BB%9C%E6%8E%A8%E5%B9%BF', '999', '1', 'zh_cn');
INSERT INTO `tags` VALUES ('17', 'X6CMS', 'X6CMS', '99', '1', 'en');
INSERT INTO `tags` VALUES ('29', '优惠套餐', '%E4%BC%98%E6%83%A0%E5%A5%97%E9%A4%90', '99', '1', 'zh_cn');
INSERT INTO `tags` VALUES ('30', '系统安装', '%E7%B3%BB%E7%BB%9F%E5%AE%89%E8%A3%85', '0', '1', 'zh_cn');
INSERT INTO `tags` VALUES ('31', 'seo', 'seo', '0', '1', 'zh_cn');
INSERT INTO `tags` VALUES ('32', '系统使用', '%E7%B3%BB%E7%BB%9F%E4%BD%BF%E7%94%A8', '11', '0', 'zh_cn');

-- ----------------------------
-- Table structure for tpltags
-- ----------------------------
DROP TABLE IF EXISTS `tpltags`;
CREATE TABLE `tpltags` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `value` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `listorder` mediumint(9) unsigned NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tpltags
-- ----------------------------
INSERT INTO `tpltags` VALUES ('1', '基本配置标签', 'system', '<?=$config[\'site_name\'];?>', '站点名称。其中site_name为参数，默认参数有：site_name（站点名称）、site_title（站点标题）、site_keywords（站点关键词）、site_description（站点描述）、seo_title（当前页SEO标题）、seo_keywords（当前页SEO关键词）、seo_description（当前页SEO描述）、site_logo（站点logo）、site_template（站点模板文件夹）、site_templateurl（站点模板文件夹路径），这里的参数还包括您自定义的配置，在后台->系统管理->站点设置中查看', '99');
INSERT INTO `tpltags` VALUES ('2', '搜索标签', 'system', '<?=x6cms_search(\'article\',true);?>', '其中有两个参数：参数1：article(默认搜索模型)\r\n参数2:true或者false（是否有下拉选择模型搜索）\r\n其中参数1的模型，后台->系统管理->模型管理中的模型表名，注意，只能填写允许搜索的模型', '99');
INSERT INTO `tpltags` VALUES ('3', '文件路径标签', 'system', '<?=x6cms_path(\'logo.png\');?>', '得到文件的完整路径。其中 logo.png即为参数，相对于系统根目录。', '99');
INSERT INTO `tpltags` VALUES ('4', '网址URL标签', 'system', '<?=x6cms_url(\'news\');?>', '得到页面的完整路径，其中 news 为参数，会生成 http://www.anli.com/demo/index.php?/news', '99');
INSERT INTO `tpltags` VALUES ('5', '语言标签', 'system', '<?php $tmpData = x6cms_lang();?>\r\n<?php foreach($tmpData as $item):?>\r\n<li>\r\n <a href="<?=$item[\'url\']?>">\r\n  <img src="<?=$item[\'thumb\']?>" alt="<?=$item[\'title\']?>"/>\r\n </a>\r\n</li>\r\n<?php endforeach;?>\r\n<?php unset($tmpData,$item);?>', '<?php $tmpData = x6cms_lang();?>得到语言数组\r\n<?php foreach($tmpData as $item):?>\r\n循环数据：\r\n<?=$item[\'title\'];?>语言名称\r\n<?=$item[\'thumb\'];?>语言图标\r\n<?=$item[\'url\'];?>该语言首页地址\r\n<?php endforeach;?>', '99');
INSERT INTO `tpltags` VALUES ('6', '网站栏目', 'system', '<?=x6cms_category(0);?>', '其中0为参数，控制栏目显示多少级（0或不填即为显示所有栏目，1只显示顶级栏目2显示两级，以此类推）', '99');
INSERT INTO `tpltags` VALUES ('7', '加载模板', 'system', '<?php $this->load->view($config[\'site_template\'].\'/head\');?>', 'head 为参数，意思是加载head.php（头部）文件，如果为foot即，加载foot.php（底部）文件', '99');
INSERT INTO `tpltags` VALUES ('8', '幻灯标签', 'model', '<?php $tmpData = x6cms_slide(2);?>\r\n<?php foreach($tmpData as $item):?>\r\n<a href="<?=$item[\'url\']?>" target="_blank">\r\n<img src="<?=$item[\'thumb\']?>" alt="<?=$item[\'title\']?>" width="640" height="250" />\r\n</a>\r\n<?php endforeach;?>\r\n<?php unset($tmpData,$item);?>', '<?php $tmpData = x6cms_slide(2);?>\r\n取得后台系统管理->类别管理中幻灯分类id为2的所有幻灯数据\r\n<?=$item[\'url\']?> 链接\r\n<?=$item[\'thumb\']?> 图片\r\n<?=$item[\'title\']?> 标题\r\n<?=$item[\'description\']?> 描述', '99');
INSERT INTO `tpltags` VALUES ('9', '面包屑导航', 'seo', '<?=x6cms_location($category,\' > \');?>', '返回当前页面路径，用于除首页、RSS聚合、分类聚合、网站地图之外的其他页面。\r\n两个参数：$category，默认，一般不需要修改； \' > \'两个链接直接的连接符号。\r\n例：文章列表页会生成：首页 > 新闻中心 > 小六动态\r\n', '99');
INSERT INTO `tpltags` VALUES ('10', '导航标签', 'model', '<?php $tmpData = x6cms_navigation(4);?>\r\n<?php foreach($tmpData as $item):?>\r\n<li><a href="<?=$item[\'url\']?>" <?=$item[\'color\']?>><?=$item[\'title\']?></a></li>\r\n<?php endforeach;?>\r\n<?php unset($tmpData,$item);?>', '<?php $tmpData = x6cms_navigation(4);?>\r\n取回导航分类ID为4的所有链接导航\r\n<?=$item[\'url\']?>导航链接\r\n<?=$item[\'color\']?>导航颜色\r\n<?=$item[\'title\']?>导航文字\r\n<?=$item[\'thumb\']?>导航图片', '99');
INSERT INTO `tpltags` VALUES ('11', '内容数据标签', 'content', '<?php $tmpData = x6cms_modellist(\'article\',0,\'default\',7,0);?>\r\n<?php foreach($tmpData as $item):?>\r\n<li>\r\n[<a href="<?=$item[\'categoryurl\']?>"><?=$item[\'categoryname\']?></a>]\r\n<a href="<?=$item[\'url\']?>" style="<?=$item[\'color\']?><?=$item[\'isbold\']?>"><?=$item[\'title\']?></a>\r\n</li>\r\n<?php endforeach;?>\r\n<?php unset($tempData,$item);?>', '<?php $tmpData = x6cms_modellist(\'article\',0,\'default\',7,0);?>\r\n三个参数：1、article(模型，还包括product、ask、hr、down)。2、0（分类栏目ID），如果为0即该模型下所有栏目。3：default（默认排序），puttime(发布时间)、hits(点击量)、id。4：7（显示条数）5：0（包括所有推荐位的数据）或者1（不包含所有推荐位的数据）\r\n<?=$item[\'categoryurl\']?>该条数据的栏目链接\r\n<?=$item[\'categoryname\']?>该条数据的栏目名称\r\n<?=$item[\'url\']?>该条数据的链接\r\n<?=$item[\'title\']?>该条数据的标题\r\n<?=$item[\'color\']?>该条数据的显示颜色\r\n<?=$item[\'isbold\']?>加粗\r\n<?=$item[\'thumb\']?>缩略图\r\n<?=$item[\'puttime\']?>发布时间\r\n<?=$item[\'tagsstr\']?>标签\r\n<?=$item[\'tagsstr\']?>标签\r\n<?=$item[\'oldur\']?>下载链接（只有下载模块，oldurl，直接显示链接）\r\n<?=$item[\'downurl\']?>下载链接（只有下载模块，downurl，经过转义的链接）\r\n<?=$item[\'categorymodel\']?>该条数据所属模型\r\n<?=$item[\'categoryid\']?>该条数据栏目的id', '99');
INSERT INTO `tpltags` VALUES ('12', '推荐位标签', 'content', '<?php $tmpData = x6cms_recommend(1,\'default\',7);?>\r\n<?php foreach($tmpData as $item):?>\r\n<li>\r\n[<a href="<?=$item[\'categoryurl\']?>"><?=$item[\'categoryname\']?></a>]\r\n<a href="<?=$item[\'url\']?>" style="<?=$item[\'color\']?><?=$item[\'isbold\']?>"><?=$item[\'title\']?></a>\r\n</li>\r\n<?php endforeach;?>\r\n<?php unset($tempData,$item);?>', '<?php $tmpData = x6cms_recommend(1,\'default\',7);?>\r\n三个参数：1、1（推荐位ID）。2、default（默认排序），puttime(发布时间)、hits(点击量)、id。3：7（显示条数）\r\n<?=$item[\'categoryurl\']?>该条数据的栏目链接\r\n<?=$item[\'categoryname\']?>该条数据的栏目名称\r\n<?=$item[\'url\']?>该条数据的链接\r\n<?=$item[\'title\']?>该条数据的标题\r\n<?=$item[\'color\']?>该条数据的显示颜色\r\n<?=$item[\'isbold\']?>加粗\r\n<?=$item[\'thumb\']?>缩略图\r\n<?=$item[\'puttime\']?>发布时间\r\n<?=$item[\'tagsstr\']?>标签\r\n<?=$item[\'tagsstr\']?>标签\r\n<?=$item[\'oldur\']?>下载链接（只有下载模块，oldurl，直接显示链接）\r\n<?=$item[\'downurl\']?>下载链接（只有下载模块，downurl，经过转义的链接）\r\n<?=$item[\'categorymodel\']?>该条数据所属模型\r\n<?=$item[\'categoryid\']?>该条数据栏目的id', '99');
INSERT INTO `tpltags` VALUES ('13', '碎片标签', 'model', '<?=x6cms_fragment(\'index_cpjs\')?>', '参数：index_cpjs（碎片变量名称）\r\n显示：该变量名称的值', '99');
INSERT INTO `tpltags` VALUES ('14', '聚合标签', 'seo', '<?php $tmpData = x6cms_tags(5);?>\r\n<?php foreach($tmpData as $item):?>\r\n<a href="<?=$item[\'url\']?>" class="font<?=rand(1,10)?>"><?=$item[\'title\']?></a>\r\n<?php endforeach;?>\r\n<?php unset($tmpData,$item);?>', '<?php $tmpData = x6cms_tags(5);?>\r\n取得聚合标签的数据\r\n<?=$item[\'url\']?>标签链接\r\n<?=$item[\'title\']?>标签文字', '99');
INSERT INTO `tpltags` VALUES ('15', '聚合标签数据', 'seo', '<?php $tmpData = x6cms_tagsData(\'article\',$tags,5);?>\r\n<?php foreach($tmpData as $item):?>\r\n<li>[<a href="<?=$item[\'categoryurl\']?>"><?=$item[\'categoryname\']?></a>] \r\n<a href="<?=$item[\'url\']?>" target="_blank"><?=$item[\'title\']?></a>\r\n<span><?=$item[\'puttime\']?></span></li>\r\n<?php endforeach;?>\r\n<?php unset($tmpData,$item);?>', '<?php $tmpData = x6cms_tagsData(\'article\',$tags,5);?>\r\n三个参数：1、article（文章模型数据）2、$tags(标签文字，在标签页面，直接使用$tags,如果在其他页面使用，直接输入标签文字)。3、5（显示数据条数）\r\n数据显示，与x6cms_modellist的一样', '99');
INSERT INTO `tpltags` VALUES ('16', '友情链接', 'model', '<?php $tmpData = x6cms_link();?>\r\n<?php foreach($tmpData as $item):?>\r\n<a href="<?=$item[\'url\']?>" target="_blank" title="<?=$item[\'description\']?>"><?=$item[\'title\']?></a>\r\n<?php endforeach;?>\r\n<?php unset($tmpData,$item);?>', '<?php $tmpData = x6cms_link(0);?>\r\n取得友情链接数据，参数：0（友情链接分类ID，如果为0或空即显示所有链接）\r\n<?=$item[\'url\']?>链接\r\n<?=$item[\'description\']?>链接描述\r\n<?=$item[\'title\']?>链接文字', '99');
INSERT INTO `tpltags` VALUES ('17', '客服标签', 'model', '<?php $tmpData = x6cms_online();?>\r\n<?php foreach($tmpData as $item):?>\r\n<?=$item[\'type\']?>\r\n<?=$item[\'title\']?>\r\n<?=$item[\'description\']?>\r\n<?php endforeach;?>\r\n<?php unset($tmpData,$item);?>', 'type:客服类型（qq：qq客服、wangwang：旺旺客服、email：邮箱客服、code：纯代码）\r\ntitle：客服文字\r\ndescription：客服号码或者代码', '99');
INSERT INTO `tpltags` VALUES ('18', '栏目左侧分类', 'content', '<?php $tmpData = x6cms_thiscategory($category);?>\r\n<?php foreach ($tmpData as $item): ?>\r\n<li class="level<?=$item[\'level\']?><?php if($item[\'id\']==$category[\'id\']):?> active<?php endif;?>">\r\n<a href="<?=$item[\'url\']?>"><?=$item[\'name\']?></a>\r\n</li>\r\n<?php endforeach; ?>', '只应用于栏目列表页和详情页', '99');
INSERT INTO `tpltags` VALUES ('19', '栏目标签', 'seo', '<?php $tmpData = x6cms_allcategory();?>\r\n<?php foreach ($tmpData as $item): ?>\r\n<li class="level<?=$item[\'level\']?>">\r\n<a href="<?=$item[\'url\']?>"><?=$item[\'name\']?></a>\r\n</li>\r\n<?php endforeach;?>\r\n<?php unset($tmpData,$item);?>', '用于站点地图和rss，展示网站所有栏目的链接', '99');
INSERT INTO `tpltags` VALUES ('20', '内容相关标签', 'content', '<?php $tmpData = x6cms_related($detail);?>\r\n<?php foreach ($tmpData as $item): ?>\r\n<li><a href="<?=$item[\'url\']?>"><?=$item[\'title\']?></a></li>\r\n<?php endforeach; ?>\r\n<?php unset($tmpData,$item);?>', '用于各栏目详情页，展示当前文章（产品等）相关的信息', '99');

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `listorder` tinyint(4) unsigned NOT NULL DEFAULT '99',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `lang` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('1', '默认链接', 'link', '', '', '99', '1', 'zh_cn');
INSERT INTO `type` VALUES ('2', '首页幻灯', 'slide', '', '', '99', '1', 'zh_cn');
INSERT INTO `type` VALUES ('3', 'Home', 'slide', '', '', '99', '1', 'en');
INSERT INTO `type` VALUES ('4', '顶部导航', 'navigation', '', '', '99', '1', 'zh_cn');
INSERT INTO `type` VALUES ('5', '产品页面幻灯', 'slide', '产品页面幻灯', '', '12', '0', 'zh_cn');
INSERT INTO `type` VALUES ('6', '侧边友链', 'link', '', '', '255', '1', 'zh_cn');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `usergroup` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tel` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0',
  `regip` char(15) NOT NULL,
  `lastip` char(15) NOT NULL,
  `logincount` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `usergroup` (`usergroup`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '120377843@qq.com', '', '1', '', '13668193903', '', '', '1335922827', '1357439344', '1432267308', '127.0.0.1', '127.0.0.1', '304', '1');
INSERT INTO `user` VALUES ('7', '6', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '12031277843@qq.com', '编辑', '1', '13668', '1366', '', 'Cheng ', '1434373580', '1444793170', '1434373580', '::1', '::1', '0', '1');

-- ----------------------------
-- Table structure for usergroup
-- ----------------------------
DROP TABLE IF EXISTS `usergroup`;
CREATE TABLE `usergroup` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `varname` varchar(20) NOT NULL,
  `listorder` tinyint(4) unsigned NOT NULL DEFAULT '99',
  `purview` text NOT NULL,
  `isupdate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usergroup
-- json导入数据库可能出错，现在转成了给16进制
-- ----------------------------
INSERT INTO `usergroup` VALUES ('1', 'superadmin', '1', 0x7b2273797374656d223a7b22686173223a2231222c226964223a2231222c22636c617373223a2273797374656d222c226d6574686f64223a66616c73657d2c2270757276696577223a7b22686173223a2231222c226964223a2232222c22636c617373223a2270757276696577222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c227573657267726f7570223a7b22686173223a2231222c226964223a2233222c22636c617373223a227573657267726f7570222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572222c226772616e74225d7d2c2275736572223a7b22686173223a2231222c226964223a2234222c22636c617373223a2275736572222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c2270617373776f7264222c2270726f66696c65225d7d2c22636f6e666967223a7b22686173223a2231222c226964223a223139222c22636c617373223a22636f6e666967222c226d6574686f64223a5b22616464222c2262617365222c226c616e67222c226d61696c222c2261747472222c2264656c225d7d2c22636c6561726361636865223a7b22686173223a2231222c226964223a223337222c22636c617373223a22636c6561726361636865222c226d6574686f64223a66616c73657d2c226461746162617365223a7b22686173223a2231222c226964223a223430222c22636c617373223a226461746162617365222c226d6574686f64223a5b226261636b7570222c22646f776e6c6f6164222c2275706772616465222c226f7074696d697a65222c2264656c225d7d2c2274656d706c617465223a7b22686173223a2231222c226964223a223432222c22636c617373223a2274656d706c617465222c226d6574686f64223a5b2265646974225d7d2c226c616e67223a7b22686173223a2231222c226964223a223531222c22636c617373223a226c616e67222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c2274706c74616773223a7b22686173223a2231222c226964223a223534222c22636c617373223a2274706c74616773222c226d6574686f64223a66616c73657d2c22636f6e74656e74223a7b22686173223a2231222c226964223a2235222c22636c617373223a22636f6e74656e74222c226d6574686f64223a66616c73657d2c2261727469636c65223a7b22686173223a2231222c226964223a223131222c22636c617373223a2261727469636c65222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c2261736b223a7b22686173223a2231222c226964223a223134222c22636c617373223a2261736b222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c2263617465676f7279223a7b22686173223a2231222c226964223a223231222c22636c617373223a2263617465676f7279222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c226872223a7b22686173223a2231222c226964223a223234222c22636c617373223a226872222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c2270726f64756374223a7b22686173223a2231222c226964223a223235222c22636c617373223a2270726f64756374222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c22646f776e223a7b22686173223a2231222c226964223a223339222c22636c617373223a22646f776e222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c226775657374626f6f6b223a7b22686173223a2231222c226964223a223431222c22636c617373223a226775657374626f6f6b222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c226d6f64656c223a7b22686173223a2231222c226964223a223532222c22636c617373223a226d6f64656c222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c227265636f6d6d656e64223a7b22686173223a2231222c226964223a223533222c22636c617373223a227265636f6d6d656e64222c226d6574686f64223a5b22616464222c2265646974222c2264656c225d7d2c226d6f64756c65223a7b22686173223a2231222c226964223a2236222c22636c617373223a226d6f64756c65222c226d6574686f64223a66616c73657d2c2274797065223a7b22686173223a2231222c226964223a223230222c22636c617373223a2274797065222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c226c696e6b223a7b22686173223a2231222c226964223a2239222c22636c617373223a226c696e6b222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c22736c696465223a7b22686173223a2231222c226964223a223135222c22636c617373223a22736c696465222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c226e617669676174696f6e223a7b22686173223a2231222c226964223a223232222c22636c617373223a226e617669676174696f6e222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c22667261676d656e74223a7b22686173223a2231222c226964223a223336222c22636c617373223a22667261676d656e74222c226d6574686f64223a5b22616464222c2265646974222c2264656c225d7d2c226f6e6c696e65223a7b22686173223a2231222c226964223a223338222c22636c617373223a226f6e6c696e65222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c2273656f223a7b22686173223a2231222c226964223a2237222c22636c617373223a2273656f222c226d6574686f64223a66616c73657d2c2274616773223a7b22686173223a2231222c226964223a223233222c22636c617373223a2274616773222c226d6574686f64223a5b22616464222c2265646974222c2264656c222c226f72646572225d7d2c226b6579776f726473223a7b22686173223a2231222c226964223a223238222c22636c617373223a226b6579776f726473222c226d6574686f64223a5b22616464222c2265646974222c2264656c225d7d2c22726f626f7473223a7b22686173223a2231222c226964223a223239222c22636c617373223a22726f626f7473222c226d6574686f64223a5b2273617665222c22726573746f7265225d7d2c226874616363657373223a7b22686173223a2231222c226964223a223330222c22636c617373223a226874616363657373222c226d6574686f64223a5b2273617665222c22726573746f7265225d7d2c22736974656d6170223a7b22686173223a2231222c226964223a223433222c22636c617373223a22736974656d6170227d2c22706572736f6e616c223a7b22686173223a2231222c226964223a223332222c22636c617373223a22706572736f6e616c222c226d6574686f64223a66616c73657d2c226d61696e223a7b22686173223a2231222c226964223a223333222c22636c617373223a226d61696e222c226d6574686f64223a66616c73657d2c2270726f66696c65223a7b22686173223a2231222c226964223a223334222c22636c617373223a2270726f66696c65222c226d6574686f64223a5b2273617665225d7d2c2270726f70617373223a7b22686173223a2231222c226964223a223335222c22636c617373223a2270726f70617373222c226d6574686f64223a5b2273617665225d7d7d, '0', '1');
INSERT INTO `usergroup` VALUES ('6', 'generaladmin', '2', 0x7b22706572736f6e616c223a7b226964223a223332222c22636c617373223a22706572736f6e616c222c226d6574686f64223a66616c73657d2c2261646d696e696e646578223a7b226964223a223333222c22636c617373223a2261646d696e696e646578222c226d6574686f64223a66616c73657d2c2274616773223a7b226964223a223233222c22636c617373223a2274616773222c226d6574686f64223a66616c73657d2c2263617465676f7279223a7b226964223a223231222c22636c617373223a2263617465676f7279222c226d6574686f64223a66616c73657d2c22736c696465223a7b226964223a223135222c22636c617373223a22736c696465222c226d6574686f64223a66616c73657d2c2270757276696577223a7b226964223a2232222c22636c617373223a2270757276696577222c226d6574686f64223a66616c73657d2c2270726f70617373223a7b226964223a223335222c22636c617373223a2270726f70617373222c226d6574686f64223a66616c73657d2c226b6579776f726473223a7b226964223a223238222c22636c617373223a226b6579776f726473222c226d6574686f64223a66616c73657d2c227573657267726f7570223a7b226964223a2233222c22636c617373223a227573657267726f7570222c226d6574686f64223a66616c73657d2c22636f6e74656e74223a7b226964223a2235222c22636c617373223a22636f6e74656e74222c226d6574686f64223a66616c73657d2c2261727469636c65223a7b226964223a223131222c22636c617373223a2261727469636c65222c226d6574686f64223a66616c73657d2c226c696e6b223a7b226964223a2239222c22636c617373223a226c696e6b222c226d6574686f64223a66616c73657d2c2270726f66696c65223a7b226964223a223334222c22636c617373223a2270726f66696c65222c226d6574686f64223a66616c73657d2c2275736572223a7b226964223a2234222c22636c617373223a2275736572222c226d6574686f64223a66616c73657d2c226e617669676174696f6e223a7b226964223a223232222c22636c617373223a226e617669676174696f6e222c226d6574686f64223a66616c73657d2c2273656f223a7b226964223a2237222c22636c617373223a2273656f222c226d6574686f64223a66616c73657d2c2270726f64756374223a7b226964223a223235222c22636c617373223a2270726f64756374222c226d6574686f64223a66616c73657d2c226874616363657373223a7b226964223a223330222c22636c617373223a226874616363657373222c226d6574686f64223a66616c73657d2c2261736b223a7b226964223a223134222c22636c617373223a2261736b222c226d6574686f64223a66616c73657d2c22726f626f7473223a7b226964223a223239222c22636c617373223a22726f626f7473222c226d6574686f64223a66616c73657d2c226d6f64756c65223a7b226964223a2236222c22636c617373223a226d6f64756c65222c226d6574686f64223a66616c73657d2c226f6e6c696e65223a7b226964223a223338222c22636c617373223a226f6e6c696e65222c226d6574686f64223a66616c73657d2c22736974656d6170223a7b226964223a223433222c22636c617373223a22736974656d6170222c226d6574686f64223a66616c73657d2c22646f776e223a7b226964223a223339222c22636c617373223a22646f776e222c226d6574686f64223a66616c73657d2c22667261676d656e74223a7b226964223a223336222c22636c617373223a22667261676d656e74222c226d6574686f64223a66616c73657d2c2273797374656d223a7b226964223a2231222c22636c617373223a2273797374656d222c226d6574686f64223a66616c73657d2c2274797065223a7b226964223a223230222c22636c617373223a2274797065222c226d6574686f64223a66616c73657d2c226872223a7b226964223a223234222c22636c617373223a226872222c226d6574686f64223a66616c73657d2c22636f6e666967223a7b226964223a223139222c22636c617373223a22636f6e666967222c226d6574686f64223a66616c73657d2c2274706c74616773223a7b226964223a223534222c22636c617373223a2274706c74616773222c226d6574686f64223a66616c73657d2c226775657374626f6f6b223a7b226964223a223431222c22636c617373223a226775657374626f6f6b222c226d6574686f64223a66616c73657d2c227265636f6d6d656e64223a7b226964223a223533222c22636c617373223a227265636f6d6d656e64222c226d6574686f64223a66616c73657d2c226c616e67223a7b226964223a223531222c22636c617373223a226c616e67222c226d6574686f64223a66616c73657d2c226d6f64656c223a7b226964223a223532222c22636c617373223a226d6f64656c222c226d6574686f64223a66616c73657d2c226461746162617365223a7b226964223a223430222c22636c617373223a226461746162617365222c226d6574686f64223a66616c73657d2c2274656d706c617465223a7b226964223a223432222c22636c617373223a2274656d706c617465222c226d6574686f64223a66616c73657d2c22636c6561726361636865223a7b226964223a223337222c22636c617373223a22636c6561726361636865222c226d6574686f64223a66616c73657d7d, '0', '1');
