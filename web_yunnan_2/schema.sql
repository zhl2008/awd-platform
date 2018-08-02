-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: beescms
-- ------------------------------------------------------
-- Server version	5.7.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bees_admin`
--
drop database if exists `beescms`;
create database `beescms` default character set utf8 collate utf8_general_ci;

use beescms;


DROP TABLE IF EXISTS `bees_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_admin` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(60) NOT NULL,
  `admin_password` varchar(60) NOT NULL,
  `admin_nich` varchar(60) NOT NULL,
  `admin_purview` mediumint(8) NOT NULL,
  `admin_admin` varchar(60) DEFAULT NULL,
  `admin_mail` varchar(60) DEFAULT NULL,
  `admin_tel` varchar(60) DEFAULT NULL,
  `is_disable` mediumint(8) NOT NULL DEFAULT '0',
  `admin_ip` varchar(60) DEFAULT NULL,
  `admin_time` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_admin`
--

LOCK TABLES `bees_admin` WRITE;
/*!40000 ALTER TABLE `bees_admin` DISABLE KEYS */;
INSERT INTO `bees_admin` VALUES (9,'admin','21232f297a57a5a743894a0e4a801fc3','admin',1,NULL,'admin@qq.com',NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `bees_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_admin_group`
--

DROP TABLE IF EXISTS `bees_admin_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_admin_group` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `admin_group_name` varchar(60) NOT NULL,
  `admin_group_info` varchar(255) DEFAULT NULL,
  `admin_group_purview` text COMMENT '分组权限-字符串以,分割',
  `is_disable` mediumint(8) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_admin_group`
--

LOCK TABLES `bees_admin_group` WRITE;
/*!40000 ALTER TABLE `bees_admin_group` DISABLE KEYS */;
INSERT INTO `bees_admin_group` VALUES (1,'超级管理员','可以管理后台所有功能，没有任何限制','all_purview',0),(2,'信息发布员 ','发布信息内容的管理员','content_create,content_edit',0);
/*!40000 ALTER TABLE `bees_admin_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_alone`
--

DROP TABLE IF EXISTS `bees_alone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_alone` (
  `id` mediumint(8) NOT NULL,
  `content` text,
  `pics` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_alone`
--

LOCK TABLES `bees_alone` WRITE;
/*!40000 ALTER TABLE `bees_alone` DISABLE KEYS */;
INSERT INTO `bees_alone` VALUES (17,'<div class=\"arc_body\">\r\n	<div class=\"us\">\r\n		<p>\r\n			BEES企业网站管理系统（以下称BEES）是一个基于PHP+Mysql架构的企业网站管理系统。BEES 采用模块化方式开发，功能强大灵活易于扩展，并且完全开放源代码，多种语言分站，为企业网站建设和外贸提供解决方案。</p>\r\n		<p>\r\n			<br />\r\n			<strong>主要特性：</strong></p>\r\n		<p>\r\n			<br />\r\n			<span style=\"color: rgb(0, 0, 255);\">1、支持多种语言</span></p>\r\n		<p>\r\n			<br />\r\n			BEES支持多种语言，后台添加自动生成，可为每种语言分配网站风格。</p>\r\n		<p>\r\n			<br />\r\n			<span style=\"color: rgb(0, 0, 255);\">2、功能强大灵活</span></p>\r\n		<p>\r\n			<br />\r\n			BEES除内置的文章、产品等模型外，还可以自定义生成其它模型，满足不同的需求</p>\r\n		<p>\r\n			<br />\r\n			<span style=\"color: rgb(0, 0, 255);\">3、自定义表单系统</span></p>\r\n		<p>\r\n			<br />\r\n			BEES可自定义表单系统，后台按需要生成，将生成的标签加到模板中便可使用。</p>\r\n		<p>\r\n			<br />\r\n			<span style=\"color: rgb(0, 0, 255);\">4、模板制作方便</span></p>\r\n		<p>\r\n			<br />\r\n			采用MVC设计模式实现了程序与模板完全分离，使用原生php函数，后台可以对模板进行编辑，分别适合美工和程序员使用。</p>\r\n		<p>\r\n			<br />\r\n			<span style=\"color: rgb(0, 0, 255);\">5、用户体验好</span></p>\r\n		<p>\r\n			<br />\r\n			前台、后台、会员中心模板都采用 DIV+CSS，兼容 IE 和 Firefox 浏览器，访问速度快。</p>\r\n		<p>\r\n			<br />\r\n			<span style=\"color: rgb(0, 0, 255);\">6、支持用户反馈信息</span></p>\r\n		<p>\r\n			<br />\r\n			<span style=\"color: rgb(0, 0, 255);\">7、SEO优化</span></p>\r\n		<p>\r\n			可设置网站SEO参数及所有页面SEO信息，如关键词、页面描述等，可以自定义url生成；</p>\r\n		<p>\r\n			<span style=\"color: rgb(0, 0, 255);\">8、人性化后台操作</span></p>\r\n		<p>\r\n			维护管理更方便</p>\r\n		<p>\r\n			可全站生成静态html页面</p>\r\n		<p>\r\n			&nbsp;</p>\r\n		<p>\r\n			官方网站：http://www.beescms.com</p>\r\n		<p>\r\n			交流论坛：http://www.beescms.com/bbs</p>\r\n		<p>\r\n			在线帮助：http://www.beescms.com/help</p>\r\n	</div>\r\n</div>\r\n','22,21,20,18');
/*!40000 ALTER TABLE `bees_alone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_article`
--

DROP TABLE IF EXISTS `bees_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_article` (
  `id` mediumint(8) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_article`
--

LOCK TABLES `bees_article` WRITE;
/*!40000 ALTER TABLE `bees_article` DISABLE KEYS */;
INSERT INTO `bees_article` VALUES (1,'<p>在企业网站中会存在一些单页内容，主要通过栏目或是其他链接进入，单页内容直接显示内容，不经过内容列表页或是其它页面，大多数都是独立的一个页面，如关于我们、公司简介等独立的页面。</p>\r\n<p>BEES企业建站系统中通过单页内容模型添加这些页面。操作如下：</p>\r\n<p><strong>一、建立栏目。</strong></p>\r\n<p>进入后台》内容管理》栏目管理，添加栏目，<span style=\"color: rgb(255, 0, 0);\">内容模型选择单页模型</span>，如图：</p>\r\n<p><img height=\"35\" width=\"269\" src=\"/beescms3/upload/img/20110625/20110625120320.gif\" alt=\"\" /></p>\r\n<p>填写其它栏目信息，创建单页栏目。</p>\r\n<p><strong>二、添加内容</strong></p>\r\n<p>栏目创建后，进入后台》内容管理》添加单页内容，会看到刚才添加的栏目，如果添加了多个栏目会依次列出，选择相应的栏目就可以添加相应的单页内容。</p>\r\n<p>单页内容添加完后就可以显示</p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">进入后台》内容管理》单页内容管理可以对添加的单页内容进行修改和删除操作。</span></p>'),(2,'<p>一个企业网站中都会存在一些片段内容，如联系方式等，这些片段内容不是一个独立的页面，只是一个或几个页面中的一些内容，</p>\r\n<p>使用BEES企业建站系统添加这些片段内容主要使用标示内容。操作如下：</p>\r\n<p><strong>一、通过后台》内容管理》添加标示内容进入添加标示内容界面。</strong></p>\r\n<p><span style=\"color: rgb(0, 0, 255);\"><span class=\"help\" title=\"请使用汉字、数字、字母,填写后不可更改\">标示名称</span></span><span class=\"help\" title=\"请使用汉字、数字、字母,填写后不可更改\">&mdash;&mdash;使用英文，主要通过模板中的标签调用输出。如果使用的是默认模板，填写以下标示名称将会自动输出对应的标示内容。</span></p>\r\n<p><span style=\"color: rgb(255, 0, 0);\">contact_us输出中文联系方式；contact_us_en输出英文联系方式；about_us输出中文简介；about_us_en输出英文简介</span></p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">标示内容</span>&mdash;&mdash;主要的内容，如联系方式、公司简介等，可上传图片并对内容进行排版。</p>\r\n<p><strong>二、<a href=\"http://www.beescms.com/\">企业网站模板</a>中输出。</strong></p>\r\n<p>如果使用默认模板，填写上面的标示名称会自动输出内容，自己定义的标示名称在模板中要调用下才能输出内容。</p>\r\n<p>修改下面的函数：</p>\r\n<p><span style=\"color: rgb(255, 0, 0);\">get_block_content(\'<strong>标示名称</strong>\')</span></p>\r\n<p>如自定义标示名称为<span style=\"color: rgb(255, 0, 0);\">test</span>，调用为get_block_content(\'<span style=\"color: rgb(255, 0, 0);\">test\'</span>)</p>\r\n<p>函数的相关使用和调用可以查看在线帮助http://www.beescms.com/help</p>'),(3,'<p>BEES网站管理系统中的输出设置功能需要在动态页面访问下才能获取模板中的配置位置。操作流程如下：</p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">1、安装完程序后，动态访问首页或其它页面</span></p>\r\n<p>该过程程序会自动获取模板中使用了输出功能的标签（通过tpl_id标签属性获取）。</p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">2、进入后台输出设置就可以配置相关位置</span></p>\r\n<p>当动态访问网站后在输出设置地方就会列出可以配置的模板位置，根据标签的不同配置的内容也不同，有内容列表配置、标示内容配置、表单配置。</p>\r\n<p><span style=\"color: rgb(255, 0, 0);\"><strong>注意事项：</strong></span></p>\r\n<p><span style=\"color: rgb(255, 0, 0);\">在开启html静态生成功能下不会生成配置列表，需要动态访问后生成</span></p>\r\n<p><span style=\"color: rgb(255, 0, 0);\">更换模板的时候会清空以前模板的配置<br />\r\n</span></p>\r\n<p><span style=\"color: rgb(255, 0, 0);\">更换模板后要动态访问下网站重新生成配置，生成配置后再开启html功能。<br />\r\n</span></p>\r\n<p><span style=\"color: rgb(255, 0, 0);\">修改模板输出配置标签要动态访问后再开启html功能</span></p>'),(4,'<p>BEES<a href=\"http://www.beescms.com/\">企业网站管理系统</a>内置多种内容模型，并且可以自定义内容模型，内容模型分别对应使用的模板。如图：</p>\r\n<p><img height=\"233\" width=\"781\" alt=\"\" src=\"/beescms3/upload/img/20110625/20110625120451.gif\" /></p>\r\n<p>可以关闭开启内容模型，添加内容的时候也会显示开启的内容模型</p>\r\n<p>通过右边的管理字段可进入内容模型的地段列表，所有的信息都通过字段添加处理。如图：</p>\r\n<p><img height=\"305\" width=\"825\" alt=\"\" src=\"/beescms3/upload/img/20110625/20110625120453.gif\" /></p>\r\n<p>通过右边的修改进入字段修改，<span style=\"color: rgb(255, 0, 0);\">字段的修改会影响到数据的输入，请谨慎操作</span></p>\r\n<p>可以修改字段的相关内容及其默认值</p>'),(5,'<p>解决BEES<a href=\"http://www.beescms.com/\">企业网站管理系统</a>首页空白没有内容的方法：</p>\r\n<p><strong>1、首先要确保网站添加了栏目和内容</strong>，每个栏目至少有10篇内容，如果栏目和内容都没有那就没办法了。</p>\r\n<p><strong>2、栏目显示的设置</strong>，添加和修改栏目的时候，只要勾选&lsquo;导航位置&rsquo;一项就可以把栏目显示在网站中部和底部，如图：</p>\r\n<p><img height=\"33\" width=\"318\" alt=\"企业网站导航设置\" src=\"/beescms3/upload/img/20110625/20110625120511.gif\" /></p>\r\n<p><strong>3、联系方式、公司简介位置的显示</strong>，这些地方通过添加标示内容输出，1.7版本只要添加标示名为<span style=\"color: rgb(0, 0, 255);\">contact_us</span>，则自动输出联系方式。添加<span style=\"color: rgb(0, 0, 255);\">about_us</span>输出公司简介，如图：</p>\r\n<p><img height=\"170\" width=\"583\" alt=\"企业网站添加联系方式\" src=\"/beescms3/upload/img/20110625/20110625120512.gif\" /></p>\r\n<p><strong>4、使用后台输出设置功能</strong>，输出设置可以设置和输出网站中一些位置的内容，需要先动态访问网站才能生成设置列表（静态页面不能生成），找到列表中的位置设置输出的栏目就可以输出内容。</p>\r\n<p>BEES<a href=\"http://www.beescms.com/\">企业网站管理系统</a>模板制作和使用帮助：http://www.beescms.com/help</p>'),(6,'<p>BEES<a href=\"http://www.beescms.com/\">企业网站管理系统</a>是多语言系统，在支持多语言的情况下，可以选择一种语言作为进入网站的语言。</p>\r\n<p>如默认语言有简体中文和英文，新装程序进入网站默认是中文。</p>\r\n<p>可以通过后台设置进入网站的语言。</p>\r\n<p>在后台》网站设置》首页设置中设置语言，如图：</p>\r\n<p><img height=\"50\" width=\"356\" alt=\"BEES&lt;a href=\" src=\"/beescms3/upload/img/20110625/20110625122858.gif\" /></p>\r\n<p>通过下拉选择语言确定保存，如果开启HTML需要生成下html页面。</p>'),(7,'<p>在BEES<a href=\"http://www.beescms.com/\">企业网站管理系统</a>中添加了栏目后会跳转到栏目管理界面，在这里可以对添加的栏目进行各种操作，界面如下：</p>\r\n<p><img height=\"100\" width=\"600\" alt=\"BEES&lt;a href=\" src=\"/beescms3/upload/img/20110625/20110625122936.gif\" /></p>\r\n<p><strong>左边为添加的栏目信息，排序和是否在网站导航中显示。</strong></p>\r\n<p>&lsquo;+&rsquo;可以展开下级栏目。</p>\r\n<p><strong>右边为对栏目的操作。</strong></p>\r\n<p>增加下级栏目：增加当前栏目的下级栏目</p>\r\n<p>修改栏目：可以修改当前栏目的名称等信息。</p>\r\n<p>移动栏目：设置栏目为顶级栏目或是其它栏目的子栏目</p>\r\n<p>删除栏目：删除栏目会连同下级栏目和文章内容一起删除，请慎重操作</p>'),(8,'<p>BEES<a href=\"http://www.beescms.com/\">企业网站管理系统</a>是一套多语言系统，每种语言是一个独立的网站，拥有该语言的内容及其网站配置信息。</p>\r\n<p>后台操作的时候要切换到相应的语言对该语言添加内容和配置。</p>\r\n<p>语言切换位置在各项功能的顶部，如图：</p>\r\n<p><img height=\"30\" width=\"298\" alt=\"BEES&lt;a href=\" src=\"/beescms3/upload/img/20110625/20110625123017.gif\" />企业网站系统语言切换&quot; /&gt;</p>\r\n<p>当前语言位置会列出系统中使用的语言，当前语言会高亮选中，方便区分其它语言。</p>\r\n<p>切换到需要操作的语言后就可以对该语言进行功能操作了。</p>'),(9,'<p>\r\n	BEES<a href=\"http://www.beescms.com/\">企业网站管理系统</a>的模板放在template目录下，如图：</p>\r\n<p>\r\n	<img alt=\"BEES&lt;a  data-cke-saved-href=\" height=\"58\" src=\" href=\" width=\"122\" />企业网站管理系统模板目录&quot; /&gt;</p>\r\n<p>\r\n	默认模板有简体中文和英文，如图：</p>\r\n<p>\r\n	<img alt=\"BEES&lt;a  data-cke-saved-href=\" height=\"55\" src=\" href=\" width=\"314\" />企业网站管理系统默认模板&quot; /&gt;</p>\r\n<p>\r\n	将模板文件放在template目录下，进入后台》站点设置切换到修改的语言，找到&lsquo;模板默认风格&rsquo;一项填写模板目录名，如图：</p>\r\n<p>\r\n	<img alt=\"填写模板名\" height=\"31\" src=\"/beescms3/upload/img/20110625/20110625123058.gif\" width=\"495\" /></p>\r\n<p>\r\n	如简体中文填写&lsquo;default&rsquo;，英文模板&#39;default_en&#39;</p>\r\n<p>\r\n	确定保存就完成了模板安装。</p>\r\n'),(10,'<p><strong>1.企业网站需要灵魂</strong></p>\r\n<p>伴随互联网的飞速普及，及相关建站软件的日新月异，现如今建设一个企业网站已相当容易，即使是对技术一窍不通的小白也能依靠智能软件信手拈来，所以   说，科技很给力。通过观察不难发现，依靠上述这种简单粗暴方式建设网站的企业不再少数，尤其是中小企业，分析原因有三个：一是与其&ldquo;短平快&rdquo;的经营思路有  关；二是成本低廉；三是不重视。</p>\r\n<p>上周与国内某知名网站建设专家讨论企业网站建设话题，其中谈到的一点至今仍记忆犹新：企业网站需要灵魂。可以判断：依靠上述那种依靠智能软件或简单抄袭完成的网站一定是缺少灵魂的。</p>\r\n<p>那如何才能建立一个有灵魂的企业网站呢？在这之前，我们需要先知晓何为企业网站的灵魂？简单说来就是：<span style=\"color: rgb(0, 0, 255);\">逻辑，想用户之所想的逻辑，有效传递品牌价值的逻辑。</span></p>\r\n<p>如何才能做到想用户之所想，并有效传递品牌价值呢？</p>\r\n<p>乍一想，可能会感觉无从下手，其实就是缺少方法论。刚刚在最新一期《销售与市场》杂志上看到一句很贴切的形容&ldquo;模式&rdquo;的话，即：<span style=\"color: rgb(255, 0, 0);\">有地图者不迷路，有模式者不盲目</span>。没错，模式，或者说方法论其实就是做事情的指南针。</p>\r\n<p><strong>2.企业网站建设方法论</strong></p>\r\n<p>近期与Google、百度两位同学打交道比较多，以下是在两位童鞋帮助下，集思广益后总结整理出的一套有效的企业网站建设方法论，希望对各位热爱网站运营的朋友有所参考价值，也欢迎各位拍砖、发言。</p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">第一步：目标明确</span></p>\r\n<p>建站之前首先要明确企业网站的目的是什么，期待企业官网做什么？如：是在线销售？品牌信息传递？信息查询？</p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">第二步：策略分析</span></p>\r\n<p>明确网站目标后，要开始目标受众分析（来企业网站做什么，兴趣点是什么）、自身现状分析（品牌影响力如何，产品线如何、服务水平如何）及行业竞品调研（行业对手都在怎么做）；</p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">第三步：方案制定</span></p>\r\n<p>通过综合策略分析后，需要明确我们要做什么（定义需求），以及如何实现。</p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">第四步：项目执行</span></p>\r\n<p>明确实现方案后，需要制定网站架构，开始创意设计、内容组织、程序开发等工作。</p>\r\n<p><span style=\"color: rgb(0, 0, 255);\">第五步：维护和提高</span></p>\r\n<p>最后，网站上线后，还有更重要的工作：运营维护、数据监测、结果追踪。这样才能形成闭环，推动网站持续、稳定、向前发展。</p>\r\n<p>纯文字的介绍可能不太直观，绘制了一张示意图（如下），可以对上述一揽子方法论一目了然。按此思路执行，有血有肉有灵魂的企业网站将水到渠成。</p>'),(11,'<p><strong>一、上网站，看文章</strong><br />\r\n当您刚进入这个行业的时候，肯定感到很新奇、很兴奋，感觉这个行业即神秘又充满了魅力，恨不得马上做出一、两个大项目来。但是江礼坤在这里奉劝您，先把这些问题、想法都放到一边，静下心来，先将网络推广做个大概的了解后，再开始折腾：<br />\r\n先把推广领域的专业网站都放入收藏夹，没事的时候就多上去学习一下。特别是一些业内的专家、知名人士，您应该熟记他们的名字和博客，他们写出来的东西，都是非常有价值的。<br />\r\n再把相关品的行业网站也放入收藏夹，经常了解行业动态。推广的手段是固定的，但推广的具体内容却是根据具体的行业情况和用户需求来制订，所以一定要时刻了解相关产品行业动态，及时掌握用户需求。</p>\r\n<p><strong>二、加入行业QQ群</strong><br />\r\n通过几天的学习，相信您对网络推广已经有了一个大概的认识，也有了一些初步的想法和困惑，急于想找人帮你解惑。此时可以适当的加一些专业群，与同行和前辈们交流一下经验。加群时，注意以下几点:<br />\r\n1、群不在多在于精。前期不要加太多群，视自身精力而定。先加推广方面的经验交流群，因为这个阶段是学习期，应以学习为主。<br />\r\n2、进群先改群名片。个人建议群名片用真名+公司名的方式：一来可以推广自己，二来推广了公司。一定要保证自己的名字在群成员列表的前十名，这样才能加深别人对你的印象。<br />\r\n3、主动发言多交流。新人刚入行，大家都不认识你，而且咱们进群也主要是为了讨教学习；所以放低姿态，多多主动与人交流。将这些人发展成你的第一批人脉资源。<br />\r\n4、积极申请管理员。很多人懒得申请群管理，认为管群麻烦，其实不然。群管理员的好处是显而易见的，所有的群员都会记住他，而且印象深刻。在群里，管理员是权威的。所以对于新人来说，成为一个群的管理，是提升知名度、拓展网络人脉的最佳捷径。</p>\r\n<p>　　学习到一定阶段时，开始多加群。同时尝试加一些与推广目标人群有关的QQ群，比如要推女性产品，就可以加一些女性群。当群达到一定数量后，开始尝试做QQ群广告。方法和注意事项如下：<br />\r\n方法一：在群里直接发广告。最传统的方法。关键点是不要在加入群后，就近不及待的马上发广告。否则不但你的广告没人点，而且还会被人T掉。正确的方法是  加入群后，先花几天时间与大家聊天，交流一下感情，尤其是要和群主管理员混熟，然后再开始发广告。此时发的广告才会有人看，而且也不会被T。发广告的时  候，不要太频，一天最多发一条足矣，否则会引起大家反感。内容方面越人性化越好。<br />\r\n方法二：利用群邮件发广告。俺一直认为QQ推广中，这是最好的方法。关于具体邮件内容技巧不多说了。只说一个很白痴，但又很关键的问题：想利用群邮件做广告，一定要多加群邮件功能开放的群。因为这个功能是由群主和群管理员控制，很多群是关闭的。</p>\r\n<p><strong>三、加入论坛/SNS</strong><br />\r\n群影响范围毕竟有限，高级群也不过五百人。所以想与更多人交流、达到更好的推广效果，就需要寻求更大的平台，而这个平台的不二人选，就是论坛，其次就是当下最火的SNS。先选两个论坛，一个SNS。<br />\r\n第一个论坛选与推广有关的，比如推一把论坛，这里聚集了很多推广方面的人才和高手，是学习推广的最佳平台。第二个论坛选与目标用户群有关的。比如推广的  是与电脑有关的产品，就可以到爱好者论坛，这是国内最专业的电脑知识普及论坛之一，拥有近百万的会员。第三个SNS，还是选与推广有关的，这样的SNS很  多，比如5G、郭吉军的爱聚集、TW同学录等。当然，如果您精力和时间很充足，也可以多找一些论坛和SNS。<br />\r\n注册好这些论坛和SNS后，多多  的上去与人交流、提升自己的等级、增加在网站里面的知名度。多与人交流是为了获取知识与经验，当你在行业论坛里等级高了就会发现，自己已经不知不觉从一只   菜鸟成长成为一个老鸟了；增加知名度是为了积累人脉、提升影响力。当你在一个坛子里人尽皆知时就会发现，即使发广告贴，也会有一堆人来帮你顶。其实这就是  最简单的论坛营销了：）</p>\r\n<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>\r\n<p><strong>四、建立QQ群</strong><br />\r\n经过前面三步，您基本上已经脱离了菜鸟的行列，有了一定经验和人脉，现在可以尝试将这些资源整合。建群是整合人脉最佳的途径之一，所以赶紧建一个属于自己的群吧。除此之外，群还有两个最大的好处：<br />\r\n1、自己的群可以随便用，想怎么发广告，就怎么发广告。<br />\r\n2、群主是最权威的。当你与群里的活跃分子谈合作时，就会发现很容易谈成，原因就在于群主的权威性。其实权威性是影响别人的重要手段之一，关于这个问题，以后江礼坤会专门撰文说明。<br />\r\n小贴士：本文系推一把创始人、蓝色烽火成员江礼坤原创，想看更多文章请搜索推一把或江礼坤，或登陆江礼坤(拼音)点卡母。转载时请保留此版权信息。</p>\r\n<p><strong>五、参加线下聚会</strong><br />\r\n很多朋友认为，刚入行的新人应该多多参加线下聚会，其实不然。经常参加聚会的朋友  都知道：一般线下聚会，特别是大型的活动，基本上就是换换名片，没有什么实际效果。聚会参加的多了，也顶多混个脸熟，效果也不。所以我的建议是：先在线上   混个脸熟，有了一定的认知和了解后，再参加线下聚会。这时再参加聚会时，相互没有陌生感，情感会得到进一步的提升。同时在聚会中，他们还会为你介绍更多朋  友。而经过朋友介绍之后换的名片才是最有价值的。最重要的，一次见一群人，肯定比你一一上门拜访要节省好多成本。</p>\r\n<p><strong>六、建立博客网站</strong><br />\r\n有了前五步的沉淀，相信您的经验已经比较丰富了，应该也操作过几个项目了。此时应  该将您之前的知识，综合运用和整合一下。最好的方法就是实践，开博客是首选，如果有条件，也可以建个个人网站。此举的目的是为了全面的了解网站建设的过  程，提升自身的综合素质。如果操作得当，说不准一个名站就此诞生了。<br />\r\n对于具体的策划过程，可以到江礼坤的博客参看以前的文章。在这里只强调两点，这两点一定要完成：<br />\r\n1、把PR值做上去。想提高PR值，就需要你去交换很多的优质链接。这个过程，会极大的提升你的谈判能力，同时会让你对外链的建设有很深的了解。而外链是SEO最重要的组成部分之一。<br />\r\n2、优化至少一个关键字。选至少一个竞争不激烈的关键字，给他优化上去（比如你的名字）。当别人在搜索引擎搜索这个关键字，你的站可以排在第一位时，相当那时你对关键字的优化已经掌握的比较全面了。<br />\r\n以上两天如果执行的到位，那您已经是半个SEO高手了。</p>\r\n<p><strong>七、研究网站模式</strong><br />\r\n前面的这些方法，让您对网络推广、SEO、网站建设、营，都有了一定的了解，同时  也积累了很多人脉与经验，现在你绝对算是个老鸟了。但我们虽然取得了一点小小的成绩，绝不能沾沾自喜，踏步不前。我们要向更高的目标迈进，开拓自己的视  野，让自己从老鸟变成专家。在这个阶段，开始学习其它网站的先进经验，研究各种网站特点、模式，最终的效果要达到能够全面诊断网站、策划网站的水平。<br />\r\n当然了，这是一个漫长的过程，也与个人的环境及自身特点有关。只能靠时间和经验去慢慢的积累。在这里我给大家的建议是：多看文章，多实践；多多交流，多总结；多上网站，多分享，<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />\r\n<strong>八、开始写原创文章</strong><br />\r\n当你经验很丰富的时候，就可以试着将这些经验写出来。一来可以提升个人知名度，如果能把自己打造成名博或是业内的专家，是最理想的。二来，可以增加软文 写作经验，这也是推广的重点手段之一。关于软文方面，笔者曾撰写过多篇文章，大家如果有兴趣，可以到江礼坤的博客查看。</p>\r\n<p><strong>九、组织线下聚会</strong><br />\r\n当你人脉和经验都已经很丰富的时候，就可以尝试组织线下聚会。先从小聚会开始组织，先从FB聚会开始组织。一点一点延伸到上百人的行业聚会、行业沙龙。此举可以让你大大的扩展人脉、巩固人脉、提升自己的知名度。同时还会大大的提升你的组织能力与协调能力。</p>'),(12,'<p>企业网站可以起到如下作用：</p>\r\n<p><strong>宣传企业形象与品牌：</strong>企业文化往往是一个企业的灵魂。也是塑造一个企业形象与品牌的根本。通过互联网这个窗口，可以得到更好的传播与推广。</p>\r\n<p><strong>增加客户的忠诚度：</strong>通过网站可以及时反馈顾客使用产品后的意见，发现问题，及时解决问题。加强与客户的沟通，建立与客户交流的便捷渠道，不但可以倾听顾客的意见，了解顾客的心声，还可以加强企业与顾客间的联系，建立良好的关系。（留言本，在线调查，在线联系，E-mail等）</p>\r\n<p><strong>有利于改善售后服务：</strong>在线服务能够更加及时地掌握用户群体，通过网站的交互式服务实现售前、售后的全过程服务。   互联网的特点在于突破地域限制，可以服务于全国各地的用户。同时，网站是一天24小时都一直呈现在顾客面前的。而不像公司的咨询热线，服务电话，只有上班   时间才可以联系到。下班与节假日的时候，客户就无法取得联系，导致信息不能得到及时的反馈，也可能会错过网上订单（客户在节假日可以通过留言本之类的功能  与公司取得联系）。</p>\r\n<p><strong>公司产品在线推广：</strong>通过网站全面展示企业经营的所有产品。互联网足以令您的产品与品牌更加形象立体地呈现在用户面前，比传统的宣传模式更加的丰富多彩、更加全面，更易于发布与传播。</p>\r\n<p><strong>时代发展的潮流：</strong>假如一个企业连网站都没有，给客户的印象是：这是不是一个正规的企业，怎么连网站都没有。</p>\r\n<p><strong>信息的及时更新：</strong>网站内容可以随时更新，这点对于现代企业来说很重要。有的企业由于发生变故，甚至连地址、电话都变了，但是名片，传统的宣传海报上印的却是以前的电话与地址，这不能不说令人遗憾。而网站却可以随时更新，可以反映你企业的最新情况。还可以发布招聘信息，代理加盟信息等等。</p>\r\n<p><strong>开辟网络营销渠道：</strong>扩大产品的销售渠道，企业网站可以满足一部分客户网上查询产品信息与采购的需要，抓住互联网商机，开展电子商务。网络营销不但可以作为传统营销的补充；还可以拓展新的市场空间，接触更多潜在的消费群体。</p>\r\n<p><strong>推广成本大大降低：</strong>与传统销售行业相比，网络营销可以减少很多环节，产品通过网站由公司直接到达客户手中，省去了大中小批发商和零售商，以及中间过程中涉及到的广告宣传，物流与仓储等等。不但大大减少了人力物力，节约费用，降低成本，还有利于提高营销效率。</p>'),(13,'<p><strong>1、相关行业新闻</strong>，这是做为原创内容的资料来源，但必须认真修改资料内容，保证一定的原创性和新鲜感。避免简单复制。</p>\r\n<p><strong>2、公司企业新闻</strong>，如果是新企业，不妨多留意公司的事情，然后记录下来，形成文字，这就是原创，突出的关键词就是公司的品牌文化和公司的理念，增加了网站的收录数量，也会提升企业的网络形象！ 等同于企业发展一样，需要不断维护才有所成就的！</p>\r\n<p><strong>3、相关技术类文字</strong>，围绕公司的服务或产品，按对公司技术和产品的认知程序而定，可以请求公司各个部门，将他们最熟知的技术原创整理出来，然出关键词内容，这样就增加了技术类相关，产品相关、服务相关的内容。</p>\r\n<p><strong>4、员工的情感或者原创文章</strong>，发动企业每一个员工，愿意为企业的发展贡献一份力量。在网站上开辟员工情感、原创文章专栏，即获得了很好的原创内容来 源又提升了员工对公司的情感，访客对企业的情感认知，如此这样一个有血有肉的企业，谁能说它存在的虚幻性，由此，对网络营销、网站口碑推广大有帮助。<strong><br />\r\n</strong></p>'),(14,'<p>　　<strong>一、宣传为主，企业网站应有效提升形象</strong></p>\r\n<p>　　如果一个企业没有网站，一定就失去了在互联网上参与竞争的一次机会。很多公司做的网站的伊始目的也仅仅是，通过搜索引擎可以查询到自己公司的信   息即可。尤其为数众多的中小企业，甚至是十几二十人的微型企业，受制于成本预算在选择网站建设公司的时候，价格就成了关键的抉择因素。如此考虑选择可以理  解，毕竟对刚起步的小公司小企业来说，资金永远都是一个必须慎重考虑的问题。但是却忽视了更为重要的一个因素没有顾忌，那就是做网站的目的是什么?</p>\r\n<p>　　毋庸置疑，企业网站建设的目的绝对不仅是有网站那么简单，而网站更类似企业在互联网上的一张名片，承载着企业形象传达的的任务。一个设计精美细   节完美的网站，无疑的将给浏览者一个良好的印象。同样的，制作粗糙甚至打开速度满如老牛拉破车似的网站，会给用户留下不悦印象，在激烈的竞争中就处于劣势  地位了。网站设计精良能有效的传递包装企业形象，浏览者会在认可网站设计制作的同时，一同认企业。如果呈现给用户的是一个粗制滥造的网站，还不如不做网  站，与其给用户留下不良印象，还不如给其一个想象的空间。</p>\r\n<p>　　<strong>二、营销至上，搜索引擎优化不容被忽视</strong></p>\r\n<p>　　我们经常会听到用户问询，做网站会有什么效果，能否有效提升销售业绩?这个近似直白的问题，多少让从事网站建设的网络公司有些尴尬。企业既然投   入了一份费用，自然就想从中得到合理的回报，这种要求这种想法本身无可厚非。但是网站本身去了正常的展示宣传，本身是不会自动起到任何作用的。就想名片就   想产品宣传单页一样，不去散发它不去主动的宣传展示它，其意义无异于一张废纸。除去传统的宣传方式，比如将网址域名印刷在名片上印刷在宣传单页上，搜索引 擎所带来的效果更不能忽视。</p>\r\n<p>　　有调查数据表明，超过90%以上的网民习惯于通过搜索引擎寻找资源，在中文搜索市场，百度更是一路绝尘以    83%的市场占有率遥遥领先。搜索引擎极其所带来的互联网营销模式，已经慢慢得到用户的认可和接受。面向用户的企业网站建设，在有效传递和包装企业形象的   同时，一定不能忽视对搜索引擎的友好性。换句话说，就是网站建设制作一定要符合搜索引擎的检索抓取标准，而后通过不断丰富网站内容，不断提升网站质量和权  重，以获得搜索引擎的不断认可。面向搜索引擎的网站开发建设，不仅只是面对优化，还包括搜索竞价广告的投放等。</p>\r\n<p>　<strong>　三、用户向导，建设面向用户的企业网站</strong></p>\r\n<p>　　无论是基于提升企业现象，有效宣传展示包装企业，还是通过搜索引擎优化或投放竞价广告，有效辅助销售。网站最终是要给用户看的，只有得到用户认   可的网站，才是真正意义上的优质网站。良好的用户体验表现之一，就是网站可以快速稳定的加载运行，一般而言，一个网站超过10秒钟无法打开，就无疑的将会   失去一次参与竞争的机会。很多公司为了更炫目的展现企业形象，倾向于使用大幅动画导入页面，其实这不仅不利于搜索引擎抓取页面内容，不利于网站优化，同时  更不利于用户体验。动画需要加载到本地后才能播放执行的，而加载的过程同时是用户等待的过程。</p>\r\n<p>　　网站打开速度如何，或者能否稳定运行，不仅取决于程序是否规范简洁，网站主机的选择也至关重要。服务器配置高，托管的机房线路优越带宽充足，网   站的加载速度就会得意提升。在保证网站稳定快速运行的同时，内容更新也很关键。我们经常看到和很多公司网站建设制作完成后，经年累月的不更新，即使网站上   有新闻动态栏目，也只是很久以前的复制拷贝而已。甚至有些网站已经出现乱码错位等现象，一样持久不得解决处理。这样的网站，即使设计的在精美，在搜索引擎 上排名再靠前，投入再多的费用在竞价广告上又如何呢?一样不会得到用户的认可。</p>'),(34,'<p>\r\n	<img alt=\"\" src=\"../upload/img/20121208/201212082353104864.jpg\" style=\"width: 600px; height: 709px;\" /></p>\r\n<p>\r\n	应用案例详细内容</p>\r\n');
/*!40000 ALTER TABLE `bees_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_ask`
--

DROP TABLE IF EXISTS `bees_ask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_ask` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `addtime` varchar(60) NOT NULL,
  `reply` text,
  `member` mediumint(8) NOT NULL,
  `replytime` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_ask`
--

LOCK TABLES `bees_ask` WRITE;
/*!40000 ALTER TABLE `bees_ask` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_ask` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_auto_fields`
--

DROP TABLE IF EXISTS `bees_auto_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_auto_fields` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(60) NOT NULL,
  `use_name` varchar(60) NOT NULL COMMENT '表单提示文字',
  `field_type` varchar(60) NOT NULL,
  `field_value` varchar(255) DEFAULT NULL COMMENT '字段默认值',
  `field_length` mediumint(8) DEFAULT NULL,
  `channel_id` mediumint(8) NOT NULL COMMENT '所属频道id',
  `field_info` varchar(255) DEFAULT NULL COMMENT '字段提示信息',
  `is_disable` mediumint(8) NOT NULL,
  `check_value` varchar(60) DEFAULT NULL,
  `field_order` mediumint(8) NOT NULL DEFAULT '10',
  `is_del` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_auto_fields`
--

LOCK TABLES `bees_auto_fields` WRITE;
/*!40000 ALTER TABLE `bees_auto_fields` DISABLE KEYS */;
INSERT INTO `bees_auto_fields` VALUES (1,'content','内容','html','',255,2,'',0,'',1,1),(2,'model','型号','text','',255,3,'',1,'',1,1),(28,'content','详细内容','html','',255,5,'',0,'',16,1),(6,'down','下载地址','upload_file','',255,4,'',0,'',1,1),(27,'content','详细内容','html','',255,4,'',0,'',4,1),(10,'jobnum','招聘人数','text','',255,5,'',0,'',2,0),(12,'jopaddress','工作地点','text','',255,5,'',0,'',5,0),(16,'joblasttime','截止日期','text','2011-1-2',255,5,'',0,'',9,0),(26,'content','详细介绍','html','',255,3,'',0,'',4,1),(24,'content','详细内容','html','',255,1,'',0,'',1,1),(25,'pics','产品图片','upload_pic_more','',255,3,'',0,'',10,0),(29,'filesize','文件大小','text','',255,4,'单位为K',1,'',3,1),(30,'filetype','文件类型','select','.exe,.rar,其他',255,4,'',1,'',2,1),(36,'pics','图集','upload_pic_more','',255,1,'',0,'',10,0);
/*!40000 ALTER TABLE `bees_auto_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_block`
--

DROP TABLE IF EXISTS `bees_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_block` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `tag` varchar(60) NOT NULL,
  `content` text,
  `tag_name` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_block`
--

LOCK TABLES `bees_block` WRITE;
/*!40000 ALTER TABLE `bees_block` DISABLE KEYS */;
INSERT INTO `bees_block` VALUES (4,'contact_us','<p>联系电话：</p>\r\n<p>QQ：</p>\r\n<p>联系地址：</p>\r\n<p>网址：<a href=\"http://www.beescms.com\">http://www.beescms.com</a></p>\r\n<p>论坛：<a href=\"http://www.beescms.com/bbs\">http://www.beescms.com/bbs</a></p>\r\n<p>帮助：<a href=\"http://www.beescms.com/help\">http://www.beescms.com/help</a></p>','',''),(5,'about_us','<p><img alt=\"\" style=\"width: 96px; float: left; height: 122px;\" src=\"/beescms3/upload/fck/20110625030630_fck.png\" />BEES 企业网站管理系统拥有简单方便的模板标签，能够快速做出模板；自定义表单，自定义模型，内置新闻、下载、产品、招聘、单页模型；SEO功   能，每个页面都可以单独SEO优化，并且可以自定义URL生成；多语言，多风格，每种语言每个页面都可以定义风格；html静态页面生成功能；人性化后台 操作，不用太多知识就可以快速建好网站，维护管理方便。</p>','',''),(6,'about_us','\r\n	<img alt=\"\" src=\"upload/img/201403272032188727.jpg\" style=\"float: left; width: 150px; height: 130px;\" />BEES 企业网站管理系统拥有简单方便的模板标签，能够快速做出模板；自定义表单，自定义模型，内置新闻、下载、产品、招聘、单页模型；SEO功 能，每个页面都可以单独SEO优化，并且可以自定义URL生成；多语言，多风格，每种语言每个页面都可以定义风格；html静态页面生成功能；人性化后台 操作，不用太多知识就可以快速建好网站，维护管理方便。\r\n','公司简介','cn'),(7,'contact_us','<p>\r\n	空间域名QQ：2429256177</p>\r\n<p>\r\n	联系地址：</p>\r\n<p>\r\n	网址：<a _fcksavedurl=\"http://www.beescms.com\" href=\"http://www.beescms.com/\">http://www.beescms.com</a></p>\r\n<p>\r\n	帮助：<a _fcksavedurl=\"http://www.beescms.com/help\" href=\"http://www.beescms.com/help\">http://www.beescms.com/help</a></p>\r\n<br />\r\n','联系方式','cn');
/*!40000 ALTER TABLE `bees_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_book`
--

DROP TABLE IF EXISTS `bees_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_book` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(60) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `book_type` mediumint(8) NOT NULL DEFAULT '0' COMMENT '0-留言,1-投诉,2-询问,3-售后',
  `pr_id` mediumint(8) DEFAULT NULL COMMENT '产品',
  `book_title` varchar(60) NOT NULL,
  `book_content` text NOT NULL,
  `addtime` varchar(60) NOT NULL,
  `reply` text,
  `verify` mediumint(8) NOT NULL DEFAULT '0',
  `lang` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_book`
--

LOCK TABLES `bees_book` WRITE;
/*!40000 ALTER TABLE `bees_book` DISABLE KEYS */;
INSERT INTO `bees_book` VALUES (1,'测试名','test@163.com',2,23,'询问价格','问下这个产品的价格','1309053643','',1,'cn');
/*!40000 ALTER TABLE `bees_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_book_info`
--

DROP TABLE IF EXISTS `bees_book_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_book_info` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `is_book` varchar(60) DEFAULT NULL,
  `book_pos` varchar(60) DEFAULT NULL,
  `book_verify` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_book_info`
--

LOCK TABLES `bees_book_info` WRITE;
/*!40000 ALTER TABLE `bees_book_info` DISABLE KEYS */;
INSERT INTO `bees_book_info` VALUES (1,'1','2','0');
/*!40000 ALTER TABLE `bees_book_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_category`
--

DROP TABLE IF EXISTS `bees_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_category` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `custom_url` varchar(255) DEFAULT NULL,
  `cate_name` varchar(60) NOT NULL,
  `cate_mb_is` mediumint(8) NOT NULL,
  `cate_hide` mediumint(8) NOT NULL,
  `cate_channel` mediumint(8) NOT NULL,
  `cate_fold_name` varchar(60) NOT NULL,
  `cate_order` mediumint(8) NOT NULL,
  `cate_rank` mediumint(8) DEFAULT '0',
  `cate_tpl` mediumint(8) NOT NULL,
  `cate_tpl_index` varchar(60) DEFAULT NULL,
  `cate_tpl_list` varchar(60) DEFAULT NULL,
  `cate_tpl_content` varchar(60) DEFAULT NULL,
  `cate_title_seo` varchar(60) DEFAULT NULL,
  `cate_key_seo` varchar(60) DEFAULT NULL,
  `cate_info_seo` varchar(350) DEFAULT NULL,
  `lang` varchar(60) NOT NULL,
  `cate_parent` mediumint(8) NOT NULL,
  `cate_html` mediumint(8) NOT NULL DEFAULT '0',
  `cate_nav` varchar(60) NOT NULL DEFAULT '0',
  `is_content` mediumint(8) DEFAULT '0',
  `cate_url` varchar(60) DEFAULT NULL,
  `cate_is_open` mediumint(8) NOT NULL DEFAULT '0',
  `form_id` mediumint(8) DEFAULT NULL,
  `cate_pic1` varchar(255) DEFAULT NULL,
  `cate_pic2` varchar(255) DEFAULT NULL,
  `cate_pic3` varchar(255) DEFAULT NULL,
  `cate_content` text,
  `temp_id` mediumint(8) DEFAULT NULL,
  `list_num` mediumint(8) NOT NULL DEFAULT '20',
  `nav_show` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_category`
--

LOCK TABLES `bees_category` WRITE;
/*!40000 ALTER TABLE `bees_category` DISABLE KEYS */;
INSERT INTO `bees_category` VALUES (4,'','新闻动态',0,0,2,'xwzx',1,0,0,'','list_article.html','article_content.html','','','','cn',0,1,'2',0,'http://',0,0,'','','','',2,20,'0'),(5,'','产品中心',0,0,3,'cpzx',2,0,0,'','list_product.html','product_content.html','','','','cn',0,1,'2',0,'http://',0,8,'','','','',3,20,''),(8,'','关于我们',0,0,1,'gywm',5,0,3,'','list_alone.html','alone_content.html','','','','cn',0,1,'2',1,'http://',0,8,'','','','',0,20,''),(9,'','企业新闻',0,0,2,'qyxw',1,0,0,'','list_article.html','article_content.html','','','','cn',4,1,'',0,'http://',0,8,'','','','',0,20,''),(10,'','最新动态',0,0,2,'zxdt',2,0,0,'','list_article.html','article_content.html','','','','cn',4,1,'',0,'http://',0,0,'','','','',0,20,'0'),(11,'','手提包',0,0,3,'stb',1,0,0,'','list_product.html','product_content.html','','','','cn',5,1,'',0,'http://',0,8,'','','','',4,20,''),(12,'','产品订购',0,0,-9,'cpdg',6,0,0,'','order_content.html','order_content.html','','','','cn',8,1,'2',0,'http://',0,0,'','','','',0,20,'0'),(13,'','公文包',0,0,3,'gwb',2,0,0,'','list_product.html','product_content.html','','','','cn',5,1,'',0,'http://',0,8,'','','','',0,20,''),(14,'','真皮包',0,0,3,'zpb',3,0,0,'','list_product.html','product_content.html','','','','cn',5,1,'',0,'http://',0,8,'','','','',0,20,''),(15,'','办公设备',0,0,3,'bgsb',4,0,0,'','list_product.html','product_content.html','','','','cn',5,1,'',0,'http://',0,8,'','','','',0,20,''),(16,'','数码用品',0,0,3,'smyp',5,0,0,'','list_product.html','product_content.html','','','','cn',5,1,'',0,'http://',0,8,'','','','',0,20,''),(17,'','喷墨打印机',0,0,3,'pmdyj',10,0,0,'','list_product.html','product_content.html','','','','cn',15,1,'',0,'http://',0,8,'','','','',0,20,''),(18,'','News',0,0,2,'news',1,0,0,'','list_article.html','article_content.html','','','','en',0,1,'2',0,'http://',0,0,'','','','',0,20,'0'),(19,'','Product',0,0,3,'product',2,0,0,'','list_product.html','product_content.html','','','','en',0,1,'2',0,'http://',0,0,'','','','',4,20,'0'),(20,'','Down',0,0,4,'down',3,0,0,'','list_down.html','down_content.html','','','','en',0,1,'2',0,'http://',0,0,'','','','',0,20,'0'),(21,'','Job',0,0,5,'job',3,0,0,'','list_job.html','job_content.html','','','','en',0,1,'2',0,'http://',0,0,'','','','',0,20,'0'),(22,'','About Us',0,0,1,'about-us',5,0,3,'','list_alone.html','alone_content.html','','','','en',0,1,'2',0,'http://',0,0,'','','','',0,20,'0'),(23,'','企业文化',0,0,1,'qywh',2,0,3,'','list_alone.html','alone_content.html','','','','cn',8,1,'',0,'http://',0,0,'','','','',0,20,'0'),(24,'','企业荣誉',0,0,1,'qyry',3,0,3,'','list_alone.html','alone_content.html','','','','cn',8,1,'',0,'http://',0,0,'','','','',0,20,'0'),(25,'','联系我们',0,0,1,'lxwm',4,0,3,'','list_alone.html','alone_content.html','','','','cn',8,1,'2',0,'http://',0,0,'','','','',0,20,'0'),(26,'','应用案例',0,0,2,'yyal',3,0,0,'','list_product.html','article_content.html','','','','cn',0,1,'2',0,'http://',0,0,'','','','',0,20,'0'),(27,'','客户留言',0,0,-9,'khly',5,0,0,'','order_content_feed.html','order_content.html','','','','cn',8,1,'',0,'http://',0,0,'','','','',0,20,'0');
/*!40000 ALTER TABLE `bees_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_channel`
--

DROP TABLE IF EXISTS `bees_channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_channel` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `channel_name` varchar(60) NOT NULL,
  `channel_mark` varchar(60) NOT NULL,
  `channel_table` varchar(60) NOT NULL,
  `is_disable` mediumint(8) NOT NULL,
  `is_member` mediumint(8) DEFAULT NULL,
  `channel_mb_grade` mediumint(8) DEFAULT '0',
  `is_verify` mediumint(8) NOT NULL COMMENT '发布内容是否审核',
  `is_del` mediumint(8) NOT NULL DEFAULT '0',
  `channel_order` mediumint(8) NOT NULL DEFAULT '10',
  `is_alone` mediumint(8) NOT NULL DEFAULT '0',
  `list_php` varchar(150) DEFAULT NULL,
  `content_php` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_channel`
--

LOCK TABLES `bees_channel` WRITE;
/*!40000 ALTER TABLE `bees_channel` DISABLE KEYS */;
INSERT INTO `bees_channel` VALUES (1,'单页模型','alone','alone',0,0,2,0,1,5,1,'alone/alone.php','alone/show_alone.php'),(2,'文章模块','article','article',0,0,2,0,0,1,0,'article/article.php','article/show_article.php'),(3,'产品模块','product','product',0,0,2,0,0,2,0,'product/product.php','product/show_product.php'),(4,'下载模块','down','down',1,0,2,0,0,3,0,'down/down.php','down/show_down.php'),(5,'招聘模块','job','job',1,0,2,0,0,4,0,'job/job.php','job/show_job.php'),(-9,'表单模块','mx_form','mx_form',0,0,0,0,0,10,0,'mx_form/mx_form.php','mx_form/show_mx_form.php');
/*!40000 ALTER TABLE `bees_channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_cmsinfo`
--

DROP TABLE IF EXISTS `bees_cmsinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_cmsinfo` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `info_tag` varchar(60) DEFAULT NULL COMMENT '配置信息标识',
  `info_array` text COMMENT '配置信息内容',
  `info_name` varchar(60) DEFAULT NULL COMMENT '配置信息名',
  `lang_tag` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_cmsinfo`
--

LOCK TABLES `bees_cmsinfo` WRITE;
/*!40000 ALTER TABLE `bees_cmsinfo` DISABLE KEYS */;
INSERT INTO `bees_cmsinfo` VALUES (1,'sys','array (\n  \'web_upload_file\' => \'zip|gz|rar|iso|doc|xsl|ppt|wps|swf|mpg|mp3|rm|rmvb|wmv|wma|wav|mid|mov\',\n  \'thump_width\' => \'300\',\n  \'thump_height\' => \'200\',\n  \'upload_size\' => \'2024000\',\n  \'web_member\' => \n  array (\n    0 => \'1\',\n  ),\n  \'is_member\' => \n  array (\n    0 => \'1\',\n  ),\n  \'member_mail\' => \n  array (\n    0 => \'1\',\n  ),\n  \'member_no_name\' => \'admin|administrator|user|users\',\n  \'image_is\' => \n  array (\n    0 => \'0\',\n  ),\n  \'image_url_is\' => \n  array (\n    0 => \'1\',\n  ),\n  \'image_type\' => \n  array (\n    0 => \'1\',\n  ),\n  \'image_text\' => \'www.beescms.com\',\n  \'image_text_color\' => \'0,0,0\',\n  \'image_text_size\' => \'12\',\n  \'pic\' => \'mark_logo.gif\',\n  \'image_position\' => \n  array (\n    0 => \'9\',\n  ),\n  \'mail_type\' => \n  array (\n    0 => \'1\',\n  ),\n  \'mail_host\' => \'smtp.163.com\',\n  \'mail_pot\' => \'25\',\n  \'mail_mail\' => \'\',\n  \'mail_user\' => \'\',\n  \'mail_pw\' => \'\',\n  \'mail_js\' => \'\',\n  \'mail_jw\' => \'BEESCMS企业网站管理系统 http://www.beescms.com\',\n  \'safe_open\' => \n  array (\n    0 => \'1\',\n    1 => \'2\',\n    2 => \'3\',\n  ),\n  \'web_content_title\' => \'180\',\n  \'web_content_info\' => \'200\',\n  \'is_hits\' => \'1\',\n  \'fialt_words\' => \'她妈|它妈|他妈|你妈|去死|贱人|非典|艾滋病|阳痿\',\n  \'arc_html\' => \n  array (\n    0 => \'1\',\n  ),\n)','系统配置',''),(2,'index_info','array (\n  \'flash_is\' => \'0\',\n  \'index_lang\' => \'9\',\n)','首页配置',''),(6,'info','array (\n  \'web_name\' => \'BEES企业网站管理系统_企业建站系统_外贸网站建设_企业CMS_PHP营销企业网站模板_免费开源的PHP企业网站程序\',\n  \'web_index_name\' => \'BEES企业网站管理系统_企业建站系统_外贸网站建设_企业CMS_PHP营销企业网站模板_免费开源的PHP企业网站程序\',\n  \'web_html\' => \'0\',\n  \'is_cache\' => \'0\',\n  \'cache_time\' => \'30\',\n  \'web_logo\' => \'img/20121210/201212102144457490.gif\',\n  \'web_template\' => \'default\',\n  \'web_powerby\' => \'BEESCMS企业网站管理系统_企业网站制作更便利,企业网站建设和管理更方便<br>\r\n空间域名QQ：2429256177 <br>\',\n  \'web_keywords\' => \'\',\n  \'web_description\' => \'BEES企业网站管理系统，是一套模板程序完全分离，采用PHP+MYSQL技术开发，具备强大的SEO功能，简单操作的自助建站系统，只要会打字就能建设企业网站，更有免费营销企业网站模板提供下载，是建设外贸网站，公司企业网站的好助手\',\n  \'web_yinxiao\' => \'\',\n  \'hot_key\' => \'BEESCMS|教程|帮助|企业网站程序\',\n  \'all_key\' => \'企业网站|BEESCMS|程序|使用帮助\',\n  \'nav\' => \'websys\',\n  \'admin_p_nav\' => \'allsys\',\n)','网站配置','cn'),(7,'info','array (\n  \'web_name\' => \'BEESCMS\',\n  \'web_html\' => \'0\',\n  \'is_cache\' => \'1\',\n  \'cache_time\' => \'30\',\n  \'web_logo\' => \'img/20121210/201212102144457490.gif\',\n  \'web_template\' => \'default_en\',\n  \'web_powerby\' => \'\',\n  \'web_keywords\' => \'\',\n  \'web_description\' => \'BEESCMS企业网站管理系统\',\n  \'web_yinxiao\' => \'\',\n  \'hot_key\' => \'\',\n  \'all_key\' => \'\',\n)','网站配置','en');
/*!40000 ALTER TABLE `bees_cmsinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_collect`
--

DROP TABLE IF EXISTS `bees_collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_collect` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `member_id` mediumint(8) NOT NULL,
  `arc_id` mediumint(8) NOT NULL,
  `addtime` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_collect`
--

LOCK TABLES `bees_collect` WRITE;
/*!40000 ALTER TABLE `bees_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_down`
--

DROP TABLE IF EXISTS `bees_down`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_down` (
  `id` mediumint(8) NOT NULL,
  `down` varchar(255) DEFAULT NULL,
  `body` text,
  `content` text,
  `filesize` varchar(255) DEFAULT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_down`
--

LOCK TABLES `bees_down` WRITE;
/*!40000 ALTER TABLE `bees_down` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_down` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_feedform`
--

DROP TABLE IF EXISTS `bees_feedform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_feedform` (
  `id` mediumint(8) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `f_mail` varchar(255) DEFAULT NULL,
  `f_tel` varchar(255) DEFAULT NULL,
  `f_content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_feedform`
--

LOCK TABLES `bees_feedform` WRITE;
/*!40000 ALTER TABLE `bees_feedform` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_feedform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_flash_ad`
--

DROP TABLE IF EXISTS `bees_flash_ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_flash_ad` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `pic` varchar(255) DEFAULT NULL,
  `pic_url` varchar(255) DEFAULT NULL,
  `pic_text` varchar(255) DEFAULT NULL,
  `pic_order` mediumint(8) NOT NULL DEFAULT '10',
  `lang` varchar(60) CHARACTER SET latin1 NOT NULL,
  `cate_id` mediumint(8) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_flash_ad`
--

LOCK TABLES `bees_flash_ad` WRITE;
/*!40000 ALTER TABLE `bees_flash_ad` DISABLE KEYS */;
INSERT INTO `bees_flash_ad` VALUES (1,'img/20110625/201106251133539086.gif','http://www.beescms.com','',1,'cn',1),(2,'img/20110625/201106251134131106.gif','http://www.beescms.com','',10,'cn',1),(3,'img/20121208/201212082315546094.gif','http://www.beescms.com','',1,'en',1),(4,'img/20121208/201212082315531698.gif','http://www.beescms.com','',2,'en',1);
/*!40000 ALTER TABLE `bees_flash_ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_flash_ad_cate`
--

DROP TABLE IF EXISTS `bees_flash_ad_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_flash_ad_cate` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(60) NOT NULL,
  `cate_tpl_id` mediumint(8) DEFAULT '0',
  `is_disable` mediumint(8) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_flash_ad_cate`
--

LOCK TABLES `bees_flash_ad_cate` WRITE;
/*!40000 ALTER TABLE `bees_flash_ad_cate` DISABLE KEYS */;
INSERT INTO `bees_flash_ad_cate` VALUES (1,'默认',2,1),(2,'成功案例',1,0);
/*!40000 ALTER TABLE `bees_flash_ad_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_flash_info`
--

DROP TABLE IF EXISTS `bees_flash_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_flash_info` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `flash_width` varchar(60) DEFAULT NULL,
  `flash_height` varchar(60) DEFAULT NULL,
  `flash_style` mediumint(8) NOT NULL,
  `lang` varchar(60) NOT NULL,
  `cate_id` mediumint(8) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_flash_info`
--

LOCK TABLES `bees_flash_info` WRITE;
/*!40000 ALTER TABLE `bees_flash_info` DISABLE KEYS */;
INSERT INTO `bees_flash_info` VALUES (1,'1000','200',1,'cn',1);
/*!40000 ALTER TABLE `bees_flash_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_form`
--

DROP TABLE IF EXISTS `bees_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_form` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(60) NOT NULL,
  `form_mark` varchar(60) NOT NULL,
  `is_disable` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_form`
--

LOCK TABLES `bees_form` WRITE;
/*!40000 ALTER TABLE `bees_form` DISABLE KEYS */;
INSERT INTO `bees_form` VALUES (5,'产品购买','prinfo',0),(8,'在线应聘','webjob',0),(9,'留言反馈','feedform',0);
/*!40000 ALTER TABLE `bees_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_formfield`
--

DROP TABLE IF EXISTS `bees_formfield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_formfield` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(60) NOT NULL,
  `use_name` varchar(60) NOT NULL,
  `field_type` varchar(60) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  `field_length` mediumint(8) NOT NULL,
  `form_id` mediumint(8) NOT NULL,
  `field_info` varchar(60) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `is_disable` mediumint(8) NOT NULL,
  `form_order` mediumint(8) NOT NULL DEFAULT '0',
  `is_empty` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_formfield`
--

LOCK TABLES `bees_formfield` WRITE;
/*!40000 ALTER TABLE `bees_formfield` DISABLE KEYS */;
INSERT INTO `bees_formfield` VALUES (9,'username','姓名','text','',255,5,'',0,1,0),(32,'web_contact','QQ/MSN/旺旺','text','',255,5,'',0,4,0),(17,'address','公司地址','text','',255,5,'',0,5,0),(12,'mail','邮箱','text','',255,5,'',0,2,1),(13,'tel','电话/传真','text','',255,5,'',0,3,0),(14,'content','详细内容','textarea','',255,5,'',0,6,0),(19,'jobname','姓名','text','',255,8,'',0,1,0),(20,'jobsex','性别','select','男\r\n女',255,8,'',0,2,0),(21,'jobmoth','出生年月','text','',255,8,'',0,3,0),(22,'jobjg','籍贯','text','',255,8,'',0,4,0),(23,'jobxl','学历','text','',255,8,'',0,5,0),(24,'jobzy','专业','text','',255,8,'',0,6,0),(25,'jobbyyx','毕业院校','text','',255,8,'',0,7,0),(26,'jobphone','联系电话','text','',255,8,'',0,8,0),(27,'jobmail','E–mail','text','',255,8,'',0,9,0),(28,'jobhj','所获奖项','textarea','',255,8,'',0,10,0),(29,'jobgzjl','工作经历','textarea','',255,8,'',0,11,0),(30,'jobzyjn','专业技能','textarea','',255,8,'',0,12,0),(31,'jobyyah','业余爱好','textarea','',255,8,'',0,13,0),(33,'title','主题','text','',255,9,'',0,1,0),(34,'f_name','姓名','text','',255,9,'',0,2,0),(35,'f_mail','E-mail','text','',255,9,'',0,3,0),(36,'f_tel','电话','text','',255,9,'',0,4,0),(37,'f_content','内容','textarea','',255,9,'',0,5,0);
/*!40000 ALTER TABLE `bees_formfield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_formlist`
--

DROP TABLE IF EXISTS `bees_formlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_formlist` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) DEFAULT NULL,
  `form_time` varchar(60) DEFAULT NULL,
  `form_ip` varchar(60) DEFAULT NULL,
  `is_read` mediumint(8) NOT NULL DEFAULT '0',
  `member_id` mediumint(8) DEFAULT '0',
  `arc_id` mediumint(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_formlist`
--

LOCK TABLES `bees_formlist` WRITE;
/*!40000 ALTER TABLE `bees_formlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_formlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_job`
--

DROP TABLE IF EXISTS `bees_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_job` (
  `id` mediumint(8) NOT NULL,
  `jobnum` varchar(255) DEFAULT NULL,
  `jopaddress` varchar(255) DEFAULT NULL,
  `joblasttime` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_job`
--

LOCK TABLES `bees_job` WRITE;
/*!40000 ALTER TABLE `bees_job` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_keywords`
--

DROP TABLE IF EXISTS `bees_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_keywords` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(60) NOT NULL,
  `wordsurl` varchar(60) NOT NULL,
  `lang` varchar(60) CHARACTER SET ucs2 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_keywords`
--

LOCK TABLES `bees_keywords` WRITE;
/*!40000 ALTER TABLE `bees_keywords` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_lang`
--

DROP TABLE IF EXISTS `bees_lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_lang` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(60) NOT NULL,
  `lang_order` mediumint(8) NOT NULL,
  `lang_tag` varchar(60) NOT NULL,
  `lang_is_use` mediumint(8) NOT NULL DEFAULT '1',
  `lang_is_open` mediumint(8) NOT NULL,
  `lang_is_url` mediumint(8) NOT NULL,
  `lang_url` varchar(60) DEFAULT NULL,
  `lang_is_fix` mediumint(8) NOT NULL DEFAULT '0',
  `lang_main` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_lang`
--

LOCK TABLES `bees_lang` WRITE;
/*!40000 ALTER TABLE `bees_lang` DISABLE KEYS */;
INSERT INTO `bees_lang` VALUES (10,'English',9,'en',1,0,0,'http://',0,0),(9,'简体中文',10,'cn',1,0,0,'http://',1,1);
/*!40000 ALTER TABLE `bees_lang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_lang_cate`
--

DROP TABLE IF EXISTS `bees_lang_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_lang_cate` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `lang_cate` varchar(60) NOT NULL,
  `lang_info` text,
  `lang` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_lang_cate`
--

LOCK TABLES `bees_lang_cate` WRITE;
/*!40000 ALTER TABLE `bees_lang_cate` DISABLE KEYS */;
INSERT INTO `bees_lang_cate` VALUES (1,'模板语言','模板中使用到的语言，如栏目名等','cn'),(2,'全局语言','程序中使用的语言，为了程序运行正常，请勿删除','cn'),(3,'信息提示','前台一些反馈信息','cn'),(4,'会员中心','会员中心使用的导航等语言','cn'),(18,'会员中心','会员中心使用的导航等语言','en'),(17,'信息提示','前台一些反馈信息','en'),(16,'全局语言','程序中使用的语言，为了程序运行正常，请勿删除','en'),(15,'模板语言','模板中使用到的语言，如栏目名等','en');
/*!40000 ALTER TABLE `bees_lang_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_lang_lang`
--

DROP TABLE IF EXISTS `bees_lang_lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_lang_lang` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `lang_tag` varchar(60) NOT NULL,
  `lang_value` varchar(240) DEFAULT NULL,
  `lang` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=460 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_lang_lang`
--

LOCK TABLES `bees_lang_lang` WRITE;
/*!40000 ALTER TABLE `bees_lang_lang` DISABLE KEYS */;
INSERT INTO `bees_lang_lang` VALUES (5,'pages','共','cn'),(6,'pagesize','条记录','cn'),(7,'page','当前第','cn'),(8,'pagehome','首页','cn'),(9,'pageend','尾页','cn'),(10,'pagapre','上一页','cn'),(11,'pagenext','下一页','cn'),(12,'pagego','转到','cn'),(13,'previous','上一条','cn'),(14,'next','下一条','cn'),(15,'nonestr','没有了','cn'),(17,'sitemap','网站地图','cn'),(384,'order_msg4','表单已经处理，我们会及时和你联系！','cn'),(382,'order_msg3','发生错误,该表单已经停止使用,不能添加表单信息','cn'),(380,'order_msg2','表单不能为空','cn'),(376,'index','首页','cn'),(377,'book','留言本','cn'),(378,'order_msg1','发生错误，无法处理该表单，清重新操作！','cn'),(84,'member_msg','请先登录','cn'),(85,'member_msg2','验证码不正确','cn'),(86,'member_smg3','用户名或密码不能为空','cn'),(87,'member_msg3','用户名名或密码不正确','cn'),(88,'member_msg4','登录失败,该账号已被锁定','cn'),(89,'member_msg5','会员注册已经暂停','cn'),(90,'member_msg6','用户名只能是字母数字，4以上长度','cn'),(91,'member_msg7','昵称只能是字母数字，4以上长度','cn'),(92,'member_msg8','密码不能为空','cn'),(93,'member_msg9','两次密码不一样','cn'),(94,'member_msg10','邮箱不正确','cn'),(95,'member_msg11','该用户名不能注册','cn'),(96,'member_msg12','已经存在相同的用户名，请更换用户名','cn'),(97,'member_msg13','该邮箱已经被使用,请更换','cn'),(98,'member_msg14','用户注册成功','cn'),(99,'msg_info','不存在flash引导页模板','cn'),(100,'msg_info2','不存在【@】语言首页模板','cn'),(101,'msg_info3','找不到【@】语言模板文件','cn'),(102,'msg_info4','请先生成【@】语言首页','cn'),(103,'msg_info5','请先更新栏目缓存','cn'),(104,'msg_info6','请先更新频道缓存','cn'),(105,'msg_info7','你当前的会员权限不能浏览','cn'),(106,'msg_info8','该内容未审核,还不能浏览','cn'),(107,'msg_info9','还没有添加内容','cn'),(422,'msg_info4','Please generate【@】Language Home','en'),(421,'msg_info3','Unable to find【@】language template file','en'),(420,'msg_info2','Does not exist【@】Language Home template','en'),(419,'msg_info','Not flash boot Pages template','en'),(418,'member_msg14','Register success','en'),(417,'member_msg13','he mailbox is already in use, replace','en'),(439,'member_msg25','Deleted successfully','en'),(438,'member_msg24','Advisory modified successfully','en'),(437,'member_msg23','The content can not be empty','en'),(436,'member_msg22','The consultation has been processed, please re-add','en'),(435,'member_msg21','The consultation does not exist','en'),(434,'member_msg20','Consulting successfully added','en'),(433,'member_msg19','Title or content can not be empty','en'),(432,'msg_info10','Parameter passing errors','en'),(431,'member_msg18','Modified successfully','en'),(430,'member_msg17','From form submission','en'),(429,'member_msg16','Phone must be numeric','en'),(428,'member_msg15','QQ number is incorrect','en'),(427,'msg_info9','Has not yet added content','en'),(426,'msg_info8','The content is not audited, but also can not browse','en'),(425,'msg_info7','Your current membership privileges can not browse','en'),(424,'msg_info6','Please update the channel cache','en'),(423,'msg_info5','Please update section cache','en'),(416,'member_msg12','The same user name already exists, replace the user name','en'),(415,'member_msg11','The user name can not be registered','en'),(414,'member_msg10','E-mail is incorrect','en'),(413,'member_msg9','Not the same password twice','en'),(412,'member_msg8','Password can not be empty','en'),(411,'member_msg7','The nickname can only contain alphanumeric, length of 4 or more','en'),(410,'member_msg6','The user name can only be alphanumeric longer than 4','en'),(409,'member_msg5','Member registration has been suspended','en'),(408,'member_msg4','Login failed, the account has been locked','en'),(266,'member_msg15','QQ号码不正确','cn'),(267,'member_msg16','手机必须为数字','cn'),(268,'member_msg17','请从表单提交','cn'),(269,'member_msg18','修改成功','cn'),(407,'member_msg3','Username name or password is incorrect','en'),(406,'member_smg3','User name or password can not be empty','en'),(274,'msg_info10','参数传递错误,请重新操作','cn'),(276,'member_msg19','标题或内容不能为空','cn'),(277,'member_msg20','咨询添加成功','cn'),(278,'member_msg21','不存在该咨询','cn'),(279,'member_msg22','咨询已经处理,请重新添加','cn'),(280,'member_msg23','内容不能为空','cn'),(281,'member_msg24','咨询修改成功','cn'),(282,'member_msg25','删除成功','cn'),(283,'member_msg26','原始密码不正确','cn'),(284,'member_msg27','已经退出','cn'),(449,'member_msg28','User Center','en'),(450,'member_out','退出登陆','cn'),(451,'member_out','Logout','en'),(447,'member_wel','Welcome back!','en'),(448,'member_msg28','用户中心','cn'),(445,'book_msg4','Successfully added','en'),(444,'book_msg3','The message can not be empty','en'),(443,'book_msg2','Message title can not be empty','en'),(442,'book_msg1','The Guestbook can not use','en'),(441,'member_msg27','Has withdrawn from the','en'),(440,'member_msg26','Original password is incorrect','en'),(386,'pages','Common','en'),(387,'pagesize','Records','en'),(388,'page','Current','en'),(389,'pagehome','Home','en'),(390,'pageend','Last','en'),(391,'pagapre','Previous','en'),(392,'pagenext','Next','en'),(393,'pagego','Go to','en'),(405,'member_msg2','Incorrect verification code','en'),(404,'member_msg','Please login','en'),(350,'book_msg1','留言本不能使用','cn'),(351,'book_msg2','留言标题不能为空','cn'),(352,'book_msg3','留言内容不能为空','cn'),(353,'book_msg4','添加成功','cn'),(403,'order_msg1','An error occurs, can not process the form, clear!','en'),(402,'book','Guestbook','en'),(401,'index','Home','en'),(400,'order_msg2','The form can not be empty','en'),(399,'order_msg3','An error occurs, the form has to stop using, you can not add form','en'),(398,'order_msg4','The form has been processed, we will promptly contact you!','en'),(397,'sitemap','Site Map','en'),(396,'nonestr','No','en'),(395,'next','Next','en'),(446,'member_wel','欢迎你回来!','cn'),(394,'previous','Previous','en'),(452,'code','验证码：','cn'),(453,'code','Code:','en'),(454,'code_info','看不清？更换一张','cn'),(455,'code_info','See? Replacing a','en'),(456,'form_submit','提交','cn'),(457,'form_submit','submit','en'),(458,'form_reset','重置','cn'),(459,'form_reset','reset','en');
/*!40000 ALTER TABLE `bees_lang_lang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_link`
--

DROP TABLE IF EXISTS `bees_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_link` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `link_url` varchar(60) NOT NULL,
  `link_name` varchar(60) NOT NULL,
  `link_logo` varchar(60) DEFAULT NULL,
  `link_order` mediumint(8) NOT NULL DEFAULT '1',
  `link_info` varchar(255) DEFAULT NULL,
  `link_mail` varchar(60) DEFAULT NULL,
  `lang` varchar(60) NOT NULL,
  `addtime` varchar(60) DEFAULT NULL,
  `link_type` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_link`
--

LOCK TABLES `bees_link` WRITE;
/*!40000 ALTER TABLE `bees_link` DISABLE KEYS */;
INSERT INTO `bees_link` VALUES (1,'http://www.beescms.com','企业网站管理系统','http://',1,'','','cn','1309053704',0),(3,'http://www.beescms.com/help','在线帮助','http://',3,'','','cn','1309053749',0),(4,'http://www.beescms.com','BEES企业网站管理系统','img/20110812/201108121414162883.gif',1,'','','cn','1313129685',1),(7,'http://www.169host.com','高速免备案空间','',12,'','','cn','1432800279',0);
/*!40000 ALTER TABLE `bees_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_maintb`
--

DROP TABLE IF EXISTS `bees_maintb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_maintb` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `filter` varchar(60) DEFAULT NULL,
  `tbpic` varchar(60) DEFAULT NULL,
  `keywords` varchar(60) DEFAULT NULL,
  `info` text,
  `author` varchar(60) DEFAULT NULL,
  `source` varchar(60) DEFAULT NULL,
  `hits` mediumint(8) NOT NULL DEFAULT '0',
  `category` mediumint(8) NOT NULL,
  `channel` mediumint(9) NOT NULL,
  `addtime` varchar(60) NOT NULL,
  `updatetime` varchar(60) DEFAULT NULL,
  `top` mediumint(8) NOT NULL,
  `purview` mediumint(8) NOT NULL COMMENT '浏览权限',
  `is_html` mediumint(8) NOT NULL COMMENT '1为动态浏览,0为静态',
  `verify` mediumint(8) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `lang` varchar(60) DEFAULT NULL,
  `is_url` mediumint(8) NOT NULL DEFAULT '0',
  `url_add` varchar(60) DEFAULT NULL,
  `title_color` varchar(60) DEFAULT NULL,
  `title_style` mediumint(8) NOT NULL DEFAULT '0',
  `is_open` mediumint(8) NOT NULL DEFAULT '0',
  `cache_time` varchar(60) DEFAULT NULL,
  `custom_url` varchar(255) DEFAULT NULL,
  `c_order` mediumint(8) DEFAULT NULL,
  `content_key` varchar(200) DEFAULT NULL,
  `small_title` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_maintb`
--

LOCK TABLES `bees_maintb` WRITE;
/*!40000 ALTER TABLE `bees_maintb` DISABLE KEYS */;
INSERT INTO `bees_maintb` VALUES (1,'BEES企业建站系统如何添加公司简介等单页内容','','img/20110625/20110625120321_thumb.gif','','在企业网站中会存在一些单页内容，主要通过栏目或是其他链接进入，单页内容直接显示内容，不经过内容列表页或是其它页面，大多数都是独立的一个页面，如关于我们、公司简介等','未知','未知',8,9,2,'1308971167','1308971167',0,0,0,0,'htm/xwzx/qyxw/2011_0625_1.html','cn',0,'http://','',0,0,'30','',0,'',''),(2,'BEES企业建站系统如何添加联系方式关于我们等片段内容','','','','一个企业网站中都会存在一些片段内容，如联系方式等，这些片段内容不是一个独立的页面，只是一个或几个页面中的一些内容，\r\n使用BEES企业建站系统添加这些片段内容主要使用标示','未知','未知',380,9,2,'1308974794','1308974794',0,0,0,0,'htm/xwzx/qyxw/2011_0625_2.html','cn',0,'http://','',0,0,'30','',0,'',''),(3,'输出设置说明及其更换模板注意事项','','','','BEES网站管理系统中的输出设置功能需要在动态页面访问下才能获取模板中的配置位置。操作流程如下：\r\n1、安装完程序后，动态访问首页或其它页面\r\n该过程程序会自动获取模板中使用','未知','未知',28,9,2,'1308974781','1308974781',0,0,0,0,'htm/xwzx/qyxw/2011_0625_3.html','cn',0,'http://','',0,0,'30','',0,'',''),(4,'如何使用内容模型','','img/20110625/20110625120453_thumb.gif','','BEES企业网站管理系统内置多种内容模型，并且可以自定义内容模型，内容模型分别对应使用的模板。如图：\r\n\r\n可以关闭开启内容模型，添加内容的时候也会显示开启的内容模型\r\n通过右','未知','未知',495,9,2,'1308974793','1308974793',0,0,0,0,'htm/xwzx/qyxw/2011_0625_4.html','cn',0,'http://','',0,0,'30','',0,'',''),(5,'使用BEES企业网站管理系统首页空白没内容的解决','','img/20110625/20110625120512_thumb.gif','','解决BEES企业网站管理系统首页空白没有内容的方法：\r\n1、首先要确保网站添加了栏目和内容，每个栏目至少有10篇内容，如果栏目和内容都没有那就没办法了。\r\n2、栏目显示的设置，添','未知','未知',226,9,2,'1308974819','1308974819',0,0,0,0,'htm/xwzx/qyxw/2011_0625_5.html','cn',0,'http://','',0,0,'30','',0,'',''),(6,'如何设置进站语言','','img/20110625/20110625122859_thumb.gif','','BEES企业网站管理系统是多语言系统，在支持多语言的情况下，可以选择一种语言作为进入网站的语言。\r\n如默认语言有简体中文和英文，新装程序进入网站默认是中文。\r\n可以通过后台设','未知','未知',139,9,2,'1308974800','1308974800',0,0,0,0,'htm/xwzx/qyxw/2011_0625_6.html','cn',0,'http://','',0,0,'30','',0,'',''),(7,'BEES企业网站系统使用教程——管理栏目','','img/20110625/20110625122940_thumb.gif','','在BEES企业网站管理系统中添加了栏目后会跳转到栏目管理界面，在这里可以对添加的栏目进行各种操作，界面如下：\r\n\r\n左边为添加的栏目信息，排序和是否在网站导航中显示。\r\n&lsquo','未知','未知',9,9,2,'1308974761','1308974761',0,0,0,0,'htm/xwzx/qyxw/2011_0625_7.html','cn',0,'http://','',0,0,'30','',0,'',''),(8,'语言切换说明','','img/20110625/20110625123018_thumb.gif','','BEES企业网站管理系统是一套多语言系统，每种语言是一个独立的网站，拥有该语言的内容及其网站配置信息。\r\n后台操作的时候要切换到相应的语言对该语言添加内容和配置。\r\n语言切换','未知','未知',152,9,2,'1308974802','1308974802',0,0,0,0,'htm/xwzx/qyxw/2011_0625_8.html','cn',0,'http://','',0,0,'30','',0,'',''),(9,'如何安装和使用模板','','img/20110625/20110625123057_thumb.gif','','BEES企业网站管理系统的模板放在template目录下，如图：\r\n企业网站管理系统模板目录\" />\r\n默认模板有简体中文和英文，如图：\r\n企业网站管理系统默认模板\" />\r\n将模板文件放在','未知','未知',374,9,2,'1308974802','1354979538',0,0,0,0,'htm/qyxw/2011_0625_9.html','cn',0,'http://','',0,0,'30','',0,'',''),(10,'企业应该怎样建设企业网站','','','','1.企业网站需要灵魂\r\n伴随互联网的飞速普及，及相关建站软件的日新月异，现如今建设一个企业网站已相当容易，即使是对技术一窍不通的小白也能依靠智能软件信手拈来，所以   说，','未知','未知',95,10,2,'1308981978','1308981978',0,0,0,0,'htm/xwzx/sybz/2011_0625_10.html','cn',0,'http://','',0,0,'30','',0,'',''),(11,'企业网站推广的一些途径和方法','','','','一、上网站，看文章\r\n当您刚进入这个行业的时候，肯定感到很新奇、很兴奋，感觉这个行业即神秘又充满了魅力，恨不得马上做出一、两个大项目来。但是江礼坤在这里奉劝您，先把这','未知','未知',305,10,2,'1308982015','1308982015',0,0,0,0,'htm/xwzx/sybz/2011_0625_11.html','cn',0,'http://','',0,0,'30','',0,'',''),(12,'企业网站对公司企业的作用及其价值','','','','企业网站可以起到如下作用：\r\n宣传企业形象与品牌：企业文化往往是一个企业的灵魂。也是塑造一个企业形象与品牌的根本。通过互联网这个窗口，可以得到更好的传播与推广。\r\n增加','未知','未知',339,10,2,'1308981985','1308981985',0,0,0,0,'htm/xwzx/sybz/2011_0625_12.html','cn',0,'http://','',0,0,'30','',0,'',''),(13,'如何更新公司企业网站内容','','','','1、相关行业新闻，这是做为原创内容的资料来源，但必须认真修改资料内容，保证一定的原创性和新鲜感。避免简单复制。\r\n2、公司企业新闻，如果是新企业，不妨多留意公司的事情，','未知','未知',460,10,2,'1308982006','1308982006',0,0,0,0,'htm/xwzx/sybz/2011_0625_13.html','cn',0,'http://','',0,0,'30','',0,'',''),(14,'企业网站建设中如何做好宣传营销','','','','　　一、宣传为主，企业网站应有效提升形象\r\n　　如果一个企业没有网站，一定就失去了在互联网上参与竞争的一次机会。很多公司做的网站的伊始目的也仅仅是，通过搜索引擎可以查','未知','未知',41,10,2,'1308981960','1308981960',0,0,0,0,'htm/xwzx/sybz/2011_0625_14.html','cn',0,'http://','',0,0,'30','',0,'',''),(17,'BEES企业网站管理系统简介','','','','\r\nBEES企业网站管理系统（以下称BEES）是一个基于PHP+Mysql架构的企业网站管理系统。BEES 采用模块化方式开发，功能强大灵活易于扩展，并且完全开放源代码，多种语言分站，为企业网站...','未知','未知',117,8,1,'1308982008','1366376677',0,0,0,0,'','cn',0,'','',0,0,'30','',0,'',''),(18,'跃动情怀系列头层牛皮两用包','','img/20110625/20110625145753523.jpg','','产品内容','未知','未知',221,11,3,'1308982002','1308985588',0,0,0,0,'htm/cpzx/stb/2011_0625_18.html','cn',0,'http://','',0,0,'30','',0,'',''),(19,'经典牛仔系列时尚单肩包','','img/20110625/201106251458052470.jpg','','','未知','未知',314,11,3,'1308981998','1308985572',0,0,0,0,'htm/cpzx/stb/2011_0625_19.html','cn',0,'http://','',0,0,'30','',0,'',''),(20,'高档牛皮男士商务电脑包','','img/20110625/201106251459032990.jpg','','','未知','未知',238,11,3,'1308985574','1308985574',0,0,0,0,'htm/cpzx/stb/2011_0625_20.html','cn',0,'http://','',0,0,'30','',0,'',''),(21,'小资情调系列时尚牛皮两用包','','img/20110625/201106251458118388.JPG','','','未知','未知',17,11,3,'1308985618','1308985618',0,0,0,0,'htm/cpzx/stb/2011_0625_21.html','cn',0,'http://','',0,0,'30','',0,'',''),(22,'98分贝牛皮单肩包','','img/20110625/201106251458316084.jpg','','','未知','未知',17,11,3,'1308985615','1308985615',0,0,0,0,'htm/cpzx/stb/2011_0625_22.html','cn',0,'http://','',0,0,'30','',0,'',''),(23,'可爱圆桶系列头层牛皮斜挎包','','img/20110625/201106251458309992.jpg','','产品内容','未知','未知',400,11,3,'1308985564','1395921828',0,0,0,0,'htm/stb/2011_0625_23.html','cn',0,'http://','',0,0,'30','',0,'包|产品',''),(34,'应用案例','','img/20121208/201212082353104864.jpg','','\r\n	\r\n\r\n	应用案例详细内容\r\n','未知','未知',6,26,2,'1396152198','1396152198',0,0,0,0,'htm/yyal/2014_0330_34.html','cn',0,'http://','',0,0,'30','',0,'','应用案例'),(25,'VMC-1060L Vertical Machining hard-wire','','img/20121208/201212082345475149_thumb.jpeg','','\r\n	Type: Hard-wire a vertical machining center\r\n	10600 Model: VMC-1060L\r\n	Brand: Taiwan Yu-Seiki\r\n	Product precision: Positioning Accuracy &plusmn; 0.005/300mm\r\n	Control system: preparation with customer needs \r\n','未知','未知',2,19,3,'1354979535','1354979535',0,0,0,0,'htm/product/2012_1208_25.html','en',0,'http://','',0,0,'30','',0,'',''),(26,'VMC-1580 three-axis vertical machining hard track','','img/20121208/201212082346359518_thumb.jpeg','','\r\n	Type: Hard-axis vertical machining center rail\r\n	1580 Model: VMC-1580\r\n	Brand: Taiwan Yu-Seiki\r\n	Product precision: Positioning Accuracy &plusmn; 0.005/300mm\r\n	Control system: preparation with customer needs \r\n','未知','未知',3,19,3,'1354979577','1354979577',0,0,0,0,'htm/product/2012_1208_26.html','en',0,'http://','',0,0,'30','',0,'',''),(27,'TY-45L CNC lathe','','img/20121208/201212082347169606_thumb.jpeg','','\r\n	Name: CNC CNC lathe\r\n	Type: Inclined bed rail line\r\n	Model: TY-45L\r\n	Brand: Taiwan Yu-Seiki\r\n	Control system: preparation with customer needs\r\n','未知','未知',2,19,3,'1354979578','1354979578',0,0,0,0,'htm/product/2012_1208_27.html','en',0,'http://','',0,0,'30','',0,'',''),(28,'Two-tail axis automatic lathe tool','','img/20121208/20121208235124_thumb.gif','','\r\n	Hardware for the wholesale production:such as electronics,communications,computers,machinery,lighting,(cars,motorcycles)parts ,Stationery,clocks and watches,toys,plastics and other industries axle parts stamping,riveting Nut,nuts and all ...','未知','未知',2,19,3,'1354979571','1354979571',0,0,0,0,'htm/product/2012_1208_28.html','en',0,'http://','',0,0,'30','',0,'',''),(29,'RSF-7 Universal Knife grinder ','','img/20121208/201212082351546777_thumb.jpeg','','','未知','未知',1,19,3,'1354979547','1354979547',0,0,0,0,'htm/product/2012_1208_29.html','en',0,'http://','',0,0,'30','',0,'',''),(30,'RSF-3 Universal Knife grinder ','','img/20121208/201212082352344008_thumb.jpeg','','','未知','未知',2,19,3,'1354979542','1354979542',0,0,0,0,'htm/product/2012_1208_30.html','en',0,'http://','',0,0,'30','',0,'',''),(31,'Tai Ming Two-tail axis automatic lathe tool','','img/20121208/201212082353104864_thumb.jpeg','','\r\n	Taiwan&#39;s quality!!\r\n	Japan shinko tapping new clutch(patent) great torque!\r\n	spindle oil-free device!\r\n\r\n	Hardware for the wholesale production:such as electronics,communications,computers,machinery,lighting,(cars,motorcycles)parts,St...','未知','未知',2,19,3,'1354979560','1354979560',0,0,0,0,'htm/product/2012_1208_31.html','en',0,'http://','',0,0,'30','',0,'','');
/*!40000 ALTER TABLE `bees_maintb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_market`
--

DROP TABLE IF EXISTS `bees_market`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_market` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `market_name` varchar(60) DEFAULT NULL,
  `market_type` mediumint(8) NOT NULL DEFAULT '0',
  `market_num` varchar(60) NOT NULL,
  `market_order` varchar(60) NOT NULL DEFAULT '10',
  `market_is` mediumint(8) NOT NULL DEFAULT '1',
  `lang` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_market`
--

LOCK TABLES `bees_market` WRITE;
/*!40000 ALTER TABLE `bees_market` DISABLE KEYS */;
INSERT INTO `bees_market` VALUES (1,'空间域名',1,'2429256177','1',1,'cn'),(2,'销售客服',1,'2429256177','1',1,'en');
/*!40000 ALTER TABLE `bees_market` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_member`
--

DROP TABLE IF EXISTS `bees_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_member` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(60) DEFAULT NULL,
  `member_password` varchar(60) NOT NULL,
  `member_nich` varchar(60) NOT NULL,
  `member_purview` mediumint(8) NOT NULL DEFAULT '0',
  `member_user` varchar(60) NOT NULL,
  `member_mail` varchar(60) NOT NULL,
  `member_tel` varchar(60) DEFAULT NULL,
  `is_disable` mediumint(8) NOT NULL DEFAULT '0',
  `member_ip` varchar(60) DEFAULT NULL,
  `member_time` varchar(60) DEFAULT NULL,
  `member_count` mediumint(8) NOT NULL DEFAULT '0',
  `member_qq` varchar(60) DEFAULT NULL,
  `member_phone` varchar(60) DEFAULT NULL,
  `member_sex` mediumint(8) DEFAULT '0',
  `member_addtime` varchar(60) DEFAULT NULL,
  `member_birth` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_member`
--

LOCK TABLES `bees_member` WRITE;
/*!40000 ALTER TABLE `bees_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_member_group`
--

DROP TABLE IF EXISTS `bees_member_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_member_group` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `member_group_name` varchar(60) NOT NULL,
  `member_group_info` varchar(255) NOT NULL,
  `is_disable` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_member_group`
--

LOCK TABLES `bees_member_group` WRITE;
/*!40000 ALTER TABLE `bees_member_group` DISABLE KEYS */;
INSERT INTO `bees_member_group` VALUES (1,'注册会员','注册完成的所有会员都是这个级别',0),(2,'VIP会员','注册会员通过管理后台升级的级别',0);
/*!40000 ALTER TABLE `bees_member_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_mx_form`
--

DROP TABLE IF EXISTS `bees_mx_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_mx_form` (
  `id` mediumint(8) NOT NULL,
  `form_id` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_mx_form`
--

LOCK TABLES `bees_mx_form` WRITE;
/*!40000 ALTER TABLE `bees_mx_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_mx_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_prinfo`
--

DROP TABLE IF EXISTS `bees_prinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_prinfo` (
  `id` mediumint(8) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `web_contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_prinfo`
--

LOCK TABLES `bees_prinfo` WRITE;
/*!40000 ALTER TABLE `bees_prinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_prinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_product`
--

DROP TABLE IF EXISTS `bees_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_product` (
  `id` mediumint(8) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `pics` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_product`
--

LOCK TABLES `bees_product` WRITE;
/*!40000 ALTER TABLE `bees_product` DISABLE KEYS */;
INSERT INTO `bees_product` VALUES (18,'','2,1','<p>产品内容</p>'),(19,'','4',''),(20,'','10,',''),(21,'','6,5,',''),(22,'','8,',''),(23,'',',9,,8,,7,,6,,4,,3','<p>\r\n	产品内容</p>\r\n<p>\r\n	<img alt=\"\" src=\"../upload/img/20121208/201212082353104864.jpg\" style=\"width: 600px; height: 709px;\" /></p>\r\n'),(25,'','15,','<p>\r\n	<span style=\"font-family:Arial;\">Type: Hard-wire a vertical machining center<br />\r\n	10600 Model: VMC-1060L<br />\r\n	Brand: Taiwan Yu-Seiki<br />\r\n	Product precision: Positioning Accuracy &plusmn; 0.005/300mm<br />\r\n	Control system: preparation with customer needs </span></p>\r\n'),(26,'','16,','<p>\r\n	<span style=\"font-family:Arial;\">Type: Hard-axis vertical machining center rail<br />\r\n	1580 Model: VMC-1580<br />\r\n	Brand: Taiwan Yu-Seiki<br />\r\n	Product precision: Positioning Accuracy &plusmn; 0.005/300mm<br />\r\n	Control system: preparation with customer needs </span></p>\r\n'),(27,'','17,','<p>\r\n	<span style=\"font-family:Arial;\">Name: CNC CNC lathe<br />\r\n	Type: Inclined bed rail line<br />\r\n	Model: TY-45L<br />\r\n	Brand: Taiwan Yu-Seiki<br />\r\n	Control system: preparation with customer needs</span></p>\r\n'),(28,'','18,','<p>\r\n	<strong><font color=\"#ff0000\">Hardware for the wholesale production:such as electronics,communications,computers,machinery,lighting,(cars,motorcycles)parts ,Stationery,clocks and watches,toys,plastics and other industries axle parts stamping,riveting Nut,nuts and all kinds of operation of non-standard items Precision metal parts and easy-cut steel,medium carbon steel,stainless steel,stainless steel,copper,aluminum and other special-shaped materials processing.</font></strong><br />\r\n	<img border=\"0\" src=\"/beescms16/upload/img/20121208/20121208235121391.gif\" style=\"BORDER-LEFT-COLOR: #000000; BORDER-BOTTOM-COLOR: #000000; BORDER-TOP-COLOR: #000000; BORDER-RIGHT-COLOR: #000000\" /></p>\r\n'),(29,'','20,',''),(30,'','21,',''),(31,'','22,','<p>\r\n	<strong><font color=\"#ff0000\">Taiwan&#39;s quality!!<br />\r\n	Japan shinko tapping new clutch(patent) great torque!<br />\r\n	spindle oil-free device!</font></strong></p>\r\n<p>\r\n	<strong><font color=\"#ff0000\">Hardware for the wholesale production:such as electronics,communications,computers,machinery,lighting,(cars,motorcycles)parts,Stationery,clocks and watches,toys,plastics and other industries axle parts stamping,riveting Nut,nuts and all kinds of operation of non-standard items Precision metal parts and easy-cut steel,medium carbon steel,stainless steel,copper,aluminum and other special-shaped materials processing.</font></strong></p>\r\n');
/*!40000 ALTER TABLE `bees_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_upfiles`
--

DROP TABLE IF EXISTS `bees_upfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_upfiles` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `file_info` varchar(255) DEFAULT NULL,
  `file_ext` varchar(255) DEFAULT NULL,
  `file_size` mediumint(8) DEFAULT '0',
  `file_path` varchar(255) DEFAULT NULL,
  `file_time` varchar(255) DEFAULT NULL,
  `hits` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_upfiles`
--

LOCK TABLES `bees_upfiles` WRITE;
/*!40000 ALTER TABLE `bees_upfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_upfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_uppic_cate`
--

DROP TABLE IF EXISTS `bees_uppic_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_uppic_cate` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_uppic_cate`
--

LOCK TABLES `bees_uppic_cate` WRITE;
/*!40000 ALTER TABLE `bees_uppic_cate` DISABLE KEYS */;
INSERT INTO `bees_uppic_cate` VALUES (1,'产品图片'),(2,'下载图片'),(3,'其它图片');
/*!40000 ALTER TABLE `bees_uppic_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_uppics`
--

DROP TABLE IF EXISTS `bees_uppics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_uppics` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `pic_name` varchar(60) NOT NULL COMMENT '图片名称',
  `pic_url` varchar(255) DEFAULT NULL COMMENT '外部链接',
  `pic_ext` varchar(60) NOT NULL COMMENT '图片后缀',
  `pic_alt` varchar(255) DEFAULT NULL COMMENT '图片alt',
  `pic_size` varchar(60) DEFAULT NULL,
  `pic_path` varchar(60) DEFAULT NULL COMMENT '图片路径',
  `pic_time` varchar(60) DEFAULT NULL COMMENT '图片上传修改时间',
  `pic_thumb` varchar(60) DEFAULT NULL COMMENT '缩略图',
  `pic_cate` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_uppics`
--

LOCK TABLES `bees_uppics` WRITE;
/*!40000 ALTER TABLE `bees_uppics` DISABLE KEYS */;
INSERT INTO `bees_uppics` VALUES (1,'201106251457435418','','jpg','','91718','upload/img/20110625/','1308985063','img/20110625/201106251457435418_thumb.jpeg',0),(2,'20110625145753523','','jpg','','28173','upload/img/20110625/','1308985073','img/20110625/20110625145753523_thumb.jpeg',0),(3,'201106251457589343','','jpg','','213545','upload/img/20110625/','1308985078','img/20110625/201106251457589343_thumb.jpeg',0),(4,'201106251458052470','','jpg','','115786','upload/img/20110625/','1308985085','img/20110625/201106251458052470_thumb.jpeg',0),(5,'201106251458118388','','JPG','','203626','upload/img/20110625/','1308985091','img/20110625/201106251458118388_thumb.jpeg',0),(6,'201106251458309693','','jpg','','552104','upload/img/20110625/','1308985110','img/20110625/201106251458309693_thumb.jpeg',0),(7,'201106251458309992','','jpg','','626030','upload/img/20110625/','1308985110','img/20110625/201106251458309992_thumb.jpeg',0),(8,'201106251458316084','','jpg','','8738','upload/img/20110625/','1308985111','img/20110625/201106251458316084_thumb.jpeg',0),(9,'201106251459034996','','jpg','','30121','upload/img/20110625/','1308985143','img/20110625/201106251459034996_thumb.jpeg',0),(10,'201106251459032990','','jpg','','32967','upload/img/20110625/','1308985143','img/20110625/201106251459032990_thumb.jpeg',0),(12,'201108121414162883','','gif','','2393','upload/img/20110812/','1313129656','',3),(13,'201212082315531698','','gif','','21154','upload/img/20121208/','1354979753','img/20121208/201212082315531698_thumb.gif',3),(14,'201212082315546094','','gif','','38118','upload/img/20121208/','1354979754','img/20121208/201212082315546094_thumb.gif',3),(15,'201212082345475149','','jpg','','120013','upload/img/20121208/','1354981547','img/20121208/201212082345475149_thumb.jpeg',1),(16,'201212082346359518','','jpg','','77084','upload/img/20121208/','1354981595','img/20121208/201212082346359518_thumb.jpeg',1),(17,'201212082347169606','','jpg','','96231','upload/img/20121208/','1354981636','img/20121208/201212082347169606_thumb.jpeg',1),(18,'20121208235116515','','jpg','','94879','upload/img/20121208/','1354981876','img/20121208/20121208235116515_thumb.jpeg',1),(19,'20121208235121391','','gif','','','upload/img/20121208/','1354981883','',2),(20,'201212082351546777','','jpg','','18656','upload/img/20121208/','1354981914','img/20121208/201212082351546777_thumb.jpeg',1),(21,'201212082352344008','','jpg','','47247','upload/img/20121208/','1354981954','img/20121208/201212082352344008_thumb.jpeg',1),(22,'201212082353104864','','jpg','','95909','upload/img/20121208/','1354981990','img/20121208/201212082353104864_thumb.jpeg',1),(23,'201212102144457490','','gif','','4133','upload/img/20121210/','1355147085','img/20121210/201212102144457490_thumb.gif',3),(24,'201403272032188727','','jpg','','65253','upload/img/','1395923538','img/201403272032188727_thumb.jpeg',3);
/*!40000 ALTER TABLE `bees_uppics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bees_webjob`
--

DROP TABLE IF EXISTS `bees_webjob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bees_webjob` (
  `id` mediumint(8) NOT NULL,
  `jobname` varchar(255) DEFAULT NULL,
  `jobsex` varchar(255) DEFAULT NULL,
  `jobmoth` varchar(255) DEFAULT NULL,
  `jobjg` varchar(255) DEFAULT NULL,
  `jobxl` varchar(255) DEFAULT NULL,
  `jobzy` varchar(255) DEFAULT NULL,
  `jobbyyx` varchar(255) DEFAULT NULL,
  `jobphone` varchar(255) DEFAULT NULL,
  `jobmail` varchar(255) DEFAULT NULL,
  `jobhj` varchar(255) DEFAULT NULL,
  `jobgzjl` varchar(255) DEFAULT NULL,
  `jobzyjn` varchar(255) DEFAULT NULL,
  `jobyyah` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bees_webjob`
--

LOCK TABLES `bees_webjob` WRITE;
/*!40000 ALTER TABLE `bees_webjob` DISABLE KEYS */;
/*!40000 ALTER TABLE `bees_webjob` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-03  7:23:13
