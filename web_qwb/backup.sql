-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: edusoho
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.14.04.1

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
-- Table structure for table `activity`
--

create database edusoho;
use edusoho;

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `remark` text,
  `mediaId` int(10) unsigned DEFAULT '0' COMMENT '教学活动详细信息Id，如：视频id, 教室id',
  `mediaType` varchar(50) NOT NULL COMMENT '活动类型',
  `content` text COMMENT '活动描述',
  `length` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '若是视频类型，则表示时长；若是ppt，则表示页数；由具体的活动业务来定义',
  `fromCourseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属教学计划',
  `fromCourseSetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属的课程',
  `fromUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建者的ID',
  `startTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制来源activity的id',
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `migrateLessonIdAndType` (`migrateLessonId`,`mediaType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_audio`
--

DROP TABLE IF EXISTS `activity_audio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_audio` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `mediaId` int(10) DEFAULT NULL COMMENT '媒体文件ID',
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='音频活动扩展表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_audio`
--

LOCK TABLES `activity_audio` WRITE;
/*!40000 ALTER TABLE `activity_audio` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_audio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_doc`
--

DROP TABLE IF EXISTS `activity_doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_doc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mediaId` int(11) NOT NULL,
  `finishType` varchar(32) NOT NULL DEFAULT '' COMMENT 'click, detail',
  `finishDetail` varchar(32) DEFAULT '0' COMMENT '至少观看X分钟',
  `createdTime` int(10) NOT NULL,
  `createdUserId` int(11) NOT NULL,
  `updatedTime` int(11) DEFAULT NULL,
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_doc`
--

LOCK TABLES `activity_doc` WRITE;
/*!40000 ALTER TABLE `activity_doc` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_doc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_download`
--

DROP TABLE IF EXISTS `activity_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `mediaCount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料数',
  `createdTime` int(10) unsigned NOT NULL,
  `updatedTime` int(10) unsigned NOT NULL,
  `fileIds` varchar(1024) DEFAULT NULL COMMENT '下载资料Ids',
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_download`
--

LOCK TABLES `activity_download` WRITE;
/*!40000 ALTER TABLE `activity_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_flash`
--

DROP TABLE IF EXISTS `activity_flash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_flash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mediaId` int(11) NOT NULL,
  `finishType` varchar(32) NOT NULL DEFAULT '' COMMENT 'click, time',
  `finishDetail` varchar(32) DEFAULT '0' COMMENT '至少观看X分钟',
  `createdTime` int(10) NOT NULL,
  `createdUserId` int(11) NOT NULL,
  `updatedTime` int(11) DEFAULT NULL,
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_flash`
--

LOCK TABLES `activity_flash` WRITE;
/*!40000 ALTER TABLE `activity_flash` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_flash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_learn_log`
--

DROP TABLE IF EXISTS `activity_learn_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_learn_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `activityId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '教学活动id',
  `courseTaskId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '教学活动id',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `mediaType` varchar(32) NOT NULL COMMENT '活动类型',
  `event` varchar(32) NOT NULL COMMENT '事件类型',
  `data` text,
  `watchTime` int(10) unsigned NOT NULL DEFAULT '0',
  `learnedTime` int(11) DEFAULT '0',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `migrateTaskResultId` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activityid_userid_event` (`activityId`,`userId`,`event`(8))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_learn_log`
--

LOCK TABLES `activity_learn_log` WRITE;
/*!40000 ALTER TABLE `activity_learn_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_learn_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_live`
--

DROP TABLE IF EXISTS `activity_live`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_live` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `liveId` int(11) NOT NULL COMMENT '直播间ID',
  `liveProvider` int(11) NOT NULL COMMENT '直播供应商',
  `replayStatus` enum('ungenerated','generating','generated','videoGenerated') NOT NULL DEFAULT 'ungenerated' COMMENT '回放状态',
  `mediaId` int(11) unsigned DEFAULT '0' COMMENT '视频文件ID',
  `roomCreated` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '直播教室是否已创建',
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_live`
--

LOCK TABLES `activity_live` WRITE;
/*!40000 ALTER TABLE `activity_live` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_live` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_ppt`
--

DROP TABLE IF EXISTS `activity_ppt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_ppt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mediaId` int(11) NOT NULL,
  `finishType` varchar(32) NOT NULL DEFAULT '' COMMENT 'end, time',
  `finishDetail` varchar(32) DEFAULT '0' COMMENT '至少观看X分钟',
  `createdTime` int(11) unsigned NOT NULL DEFAULT '0',
  `createdUserId` int(11) NOT NULL,
  `updatedTime` int(11) unsigned NOT NULL DEFAULT '0',
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_ppt`
--

LOCK TABLES `activity_ppt` WRITE;
/*!40000 ALTER TABLE `activity_ppt` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_ppt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_testpaper`
--

DROP TABLE IF EXISTS `activity_testpaper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_testpaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '关联activity表的ID',
  `mediaId` int(10) NOT NULL DEFAULT '0' COMMENT '试卷ID',
  `doTimes` smallint(6) NOT NULL DEFAULT '0' COMMENT '考试次数',
  `redoInterval` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '重做时间间隔(小时)',
  `limitedTime` int(10) NOT NULL DEFAULT '0' COMMENT '考试时间',
  `checkType` text,
  `finishCondition` text,
  `requireCredit` int(10) NOT NULL DEFAULT '0' COMMENT '参加考试所需的学分',
  `testMode` varchar(50) NOT NULL DEFAULT 'normal' COMMENT '考试模式',
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_testpaper`
--

LOCK TABLES `activity_testpaper` WRITE;
/*!40000 ALTER TABLE `activity_testpaper` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_testpaper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_text`
--

DROP TABLE IF EXISTS `activity_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_text` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `finishType` varchar(32) NOT NULL DEFAULT '' COMMENT 'click, time',
  `finishDetail` varchar(32) DEFAULT '0' COMMENT '至少观看X分钟',
  `createdTime` int(10) NOT NULL,
  `createdUserId` int(11) NOT NULL,
  `updatedTime` int(11) DEFAULT NULL,
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_text`
--

LOCK TABLES `activity_text` WRITE;
/*!40000 ALTER TABLE `activity_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_video`
--

DROP TABLE IF EXISTS `activity_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_video` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `mediaSource` varchar(32) NOT NULL DEFAULT '' COMMENT '媒体文件来源(self:本站上传,youku:优酷)',
  `mediaId` int(10) NOT NULL DEFAULT '0' COMMENT '媒体文件ID',
  `mediaUri` text COMMENT '媒体文件资UR',
  `finishType` varchar(60) NOT NULL DEFAULT 'end' COMMENT '完成类型',
  `finishDetail` varchar(32) NOT NULL DEFAULT '0' COMMENT '完成条件',
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='视频活动扩展表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_video`
--

LOCK TABLES `activity_video` WRITE;
/*!40000 ALTER TABLE `activity_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcement` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '课程公告ID',
  `userId` int(10) NOT NULL COMMENT '公告发布人ID',
  `targetType` varchar(64) NOT NULL DEFAULT 'course' COMMENT '公告类型',
  `url` varchar(255) NOT NULL,
  `startTime` int(10) unsigned NOT NULL DEFAULT '0',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0',
  `targetId` int(10) unsigned NOT NULL COMMENT '所属ID',
  `content` text NOT NULL COMMENT '公告内容',
  `orgId` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'ID',
  `orgCode` varchar(255) NOT NULL DEFAULT '1.',
  `createdTime` int(10) NOT NULL COMMENT '公告创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公告最后更新时间',
  `copyId` int(11) NOT NULL DEFAULT '0' COMMENT '复制的公告ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '栏目',
  `tagIds` tinytext COMMENT 'tag标签',
  `source` varchar(1024) DEFAULT '' COMMENT '来源',
  `sourceUrl` varchar(1024) DEFAULT '' COMMENT '来源URL',
  `publishedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `body` text COMMENT '正文',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `originalThumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图原图',
  `picture` varchar(255) NOT NULL DEFAULT '' COMMENT '文章头图，文章编辑／添加时，自动取正文的第１张图',
  `status` enum('published','unpublished','trash') NOT NULL DEFAULT 'unpublished' COMMENT '状态',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否头条',
  `promoted` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '推荐',
  `sticky` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `postNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `upsNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章发布人的ID',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `orgId` int(10) unsigned DEFAULT '1',
  `orgCode` varchar(255) DEFAULT '1.' COMMENT '组织机构内部编码',
  PRIMARY KEY (`id`),
  KEY `updatedTime` (`updatedTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '栏目名称',
  `code` varchar(64) NOT NULL COMMENT 'URL目录名称',
  `weight` int(11) NOT NULL DEFAULT '0',
  `publishArticle` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否允许发布文章',
  `seoTitle` varchar(1024) NOT NULL DEFAULT '' COMMENT '栏目标题',
  `seoKeyword` varchar(1024) NOT NULL DEFAULT '' COMMENT 'SEO 关键字',
  `seoDesc` varchar(1024) NOT NULL DEFAULT '' COMMENT '栏目描述（SEO）',
  `published` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用（1：启用 0：停用)',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_category`
--

LOCK TABLES `article_category` WRITE;
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_like`
--

DROP TABLE IF EXISTS `article_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_like` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统id',
  `articleId` int(10) unsigned NOT NULL COMMENT '资讯id',
  `userId` int(10) unsigned NOT NULL COMMENT '用户id',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资讯点赞表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_like`
--

LOCK TABLES `article_like` WRITE;
/*!40000 ALTER TABLE `article_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batch_notification`
--

DROP TABLE IF EXISTS `batch_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batch_notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '群发通知id',
  `type` enum('text','image','video','audio') NOT NULL DEFAULT 'text' COMMENT '通知类型',
  `title` text NOT NULL COMMENT '通知标题',
  `fromId` int(10) unsigned NOT NULL COMMENT '发送人id',
  `content` text NOT NULL COMMENT '通知内容',
  `targetType` text NOT NULL COMMENT '通知发送对象group,global,course,classroom等',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '通知发送对象ID',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发送通知时间',
  `published` int(10) NOT NULL DEFAULT '0' COMMENT '是否已经发送',
  `sendedTime` int(10) NOT NULL DEFAULT '0' COMMENT '群发通知的发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='群发通知表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batch_notification`
--

LOCK TABLES `batch_notification` WRITE;
/*!40000 ALTER TABLE `batch_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `batch_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blacklist`
--

DROP TABLE IF EXISTS `blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blacklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userId` int(10) unsigned NOT NULL COMMENT '名单拥有者id',
  `blackId` int(10) unsigned NOT NULL COMMENT '黑名单用户id',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '加入黑名单时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='黑名单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blacklist`
--

LOCK TABLES `blacklist` WRITE;
/*!40000 ALTER TABLE `blacklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `blacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `block` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编辑区ID',
  `userId` int(11) NOT NULL COMMENT '编辑区创建人ID',
  `content` text COMMENT '编辑区内容',
  `code` varchar(255) NOT NULL DEFAULT '',
  `data` text COMMENT '编辑区内容',
  `createdTime` int(11) unsigned NOT NULL COMMENT '编辑区创建时间',
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '编辑区最后更新时间',
  `orgId` int(11) NOT NULL DEFAULT '1' COMMENT '组织机构Id',
  `blockTemplateId` int(11) NOT NULL COMMENT '模版ID',
  `meta` text,
  PRIMARY KEY (`id`),
  KEY `block_code_orgId_index` (`code`,`orgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block`
--

LOCK TABLES `block` WRITE;
/*!40000 ALTER TABLE `block` DISABLE KEYS */;
/*!40000 ALTER TABLE `block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `block_history`
--

DROP TABLE IF EXISTS `block_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `block_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编辑区历史记录ID',
  `blockId` int(11) NOT NULL COMMENT '编辑区ID',
  `templateData` text COMMENT '模板历史数据',
  `data` text COMMENT 'block元信息',
  `content` text COMMENT '编辑区历史内容',
  `userId` int(11) NOT NULL COMMENT '编辑区编辑人ID',
  `createdTime` int(11) unsigned NOT NULL COMMENT '编辑区历史记录创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='历史表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block_history`
--

LOCK TABLES `block_history` WRITE;
/*!40000 ALTER TABLE `block_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `block_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `block_template`
--

DROP TABLE IF EXISTS `block_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `block_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '模版ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `mode` enum('html','template') NOT NULL DEFAULT 'html' COMMENT '模式',
  `template` text COMMENT '模板',
  `templateName` varchar(255) DEFAULT NULL COMMENT '编辑区模板名字',
  `templateData` text COMMENT '模板数据',
  `content` text COMMENT '默认内容',
  `data` text COMMENT '编辑区内容',
  `code` varchar(255) NOT NULL DEFAULT '' COMMENT '编辑区编码',
  `meta` text COMMENT '编辑区元信息',
  `tips` varchar(255) DEFAULT NULL,
  `category` varchar(60) NOT NULL DEFAULT 'system' COMMENT '分类(系统/主题)',
  `createdTime` int(11) unsigned NOT NULL COMMENT '创建时间',
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='编辑区模板';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block_template`
--

LOCK TABLES `block_template` WRITE;
/*!40000 ALTER TABLE `block_template` DISABLE KEYS */;
INSERT INTO `block_template` VALUES (1,'直播频道 - 首页 - 头部轮播图','template',NULL,'block/live-top-banner.template.html.twig',NULL,'','{\"posters\":[{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a51\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a52\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a53\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a54\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a55\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"}]}','live_top_banner','{\"title\":\"\\u76f4\\u64ad\\u9891\\u9053 - \\u9996\\u9875 - \\u5934\\u90e8\\u8f6e\\u64ad\\u56fe\",\"category\":\"system\",\"templateName\":\"block\\/live-top-banner.template.html.twig\",\"items\":{\"posters\":{\"title\":\"\\u8f6e\\u64ad\\u56fe\",\"desc\":\"\\u5efa\\u8bae\\u4f7f\\u75281920x300\\u5927\\u5c0f\\u7684\\u56fe\\u7247\\uff0c\\u6700\\u591a\\u53ef\\u8bbe\\u7f6e\\uff15\\u5f20\\u56fe\\u7247\\u3002\",\"count\":5,\"type\":\"poster\",\"default\":[{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a51\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a52\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a53\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a54\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/live-slide-1.jpg\",\"alt\":\"\\u6d77\\u62a55\",\"layout\":\"limitWide\",\"background\":\"#1d75ed\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"}]}}}',NULL,'system',1506519316,1506519316),(2,'公开课频道 - 首页 - 头部轮播图','template',NULL,'block/open-course-top-banner.template.html.twig',NULL,'','{\"posters\":[{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a51\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a52\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a53\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a54\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a55\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"}]}','open_course_top_banner','{\"title\":\"\\u516c\\u5f00\\u8bfe\\u9891\\u9053 - \\u9996\\u9875 - \\u5934\\u90e8\\u8f6e\\u64ad\\u56fe\",\"category\":\"system\",\"templateName\":\"block\\/open-course-top-banner.template.html.twig\",\"items\":{\"posters\":{\"title\":\"\\u8f6e\\u64ad\\u56fe\",\"desc\":\"\\u5efa\\u8bae\\u4f7f\\u75281920x300\\u5927\\u5c0f\\u7684\\u56fe\\u7247\\uff0c\\u6700\\u591a\\u53ef\\u8bbe\\u7f6e\\uff15\\u5f20\\u56fe\\u7247\\u3002\",\"count\":5,\"type\":\"poster\",\"default\":[{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a51\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a52\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a53\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a54\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/assets\\/v2\\/img\\/open_channel.png\",\"alt\":\"\\u6d77\\u62a55\",\"layout\":\"limitWide\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"}]}}}',NULL,'system',1506519316,1506519316),(3,'云搜索背景图','template',NULL,'TopxiaWebBundle:Block:cloud_search_banner.template.html.twig',NULL,'','{\"posters\":[{\"src\":\"\\/assets\\/img\\/placeholder\\/banner_search.jpg\",\"alt\":\"\\u80cc\\u666f\\u56fe\",\"layout\":\"tile\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"}]}','cloud_search_banner','{\"title\":\"\\u4e91\\u641c\\u7d22\\u80cc\\u666f\\u56fe\",\"category\":\"system\",\"templateName\":\"TopxiaWebBundle:Block:cloud_search_banner.template.html.twig\",\"items\":{\"posters\":{\"title\":\"\\u80cc\\u666f\\u56fe\",\"type\":\"poster\",\"desc\":\"\\u5efa\\u8bae\\u56fe\\u7247\\u5927\\u5c0f\\u4e3a1440*200\\uff0c\\u6700\\u591a\\u53ef\\u8bbe\\u7f6e1\\u5f20\\u56fe\\u7247\\u3002\",\"count\":1,\"default\":[{\"src\":\"\\/assets\\/img\\/placeholder\\/banner_search.jpg\",\"alt\":\"\\u80cc\\u666f\\u56fe\",\"layout\":\"tile\",\"background\":\"#2b9cf0\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"}]}}}',NULL,'system',1506519316,1506519316),(4,'默认主题：首页头部图片轮播','template',NULL,'@theme/default/block/home_top_banner.template.html.twig',NULL,'','{\"carousel\":[{\"src\":\"\\/assets\\/img\\/placeholder\\/carousel-1200x256-1.png\",\"alt\":\"\\u8f6e\\u64ad\\u56fe1\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/carousel-1200x256-2.png\",\"alt\":\"\\u8f6e\\u64ad\\u56fe2\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/carousel-1200x256-3.png\",\"alt\":\"\\u8f6e\\u64ad\\u56fe3\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"}]}','default:home_top_banner','{\"title\":\"\\u9ed8\\u8ba4\\u4e3b\\u9898\\uff1a\\u9996\\u9875\\u5934\\u90e8\\u56fe\\u7247\\u8f6e\\u64ad\",\"category\":\"default\",\"templateName\":\"@theme\\/default\\/block\\/home_top_banner.template.html.twig\",\"items\":{\"carousel\":{\"title\":\"\\u8f6e\\u64ad\\u56fe\",\"desc\":\"\\u5efa\\u8bae\\u4f7f\\u75281200x256\\u5927\\u5c0f\\u7684\\u56fe\\u7247\\uff0c\\u6700\\u591a\\u53ef\\u6dfb\\u52a0\\uff15\\u5f20\\u56fe\\u7247\\u3002\",\"count\":5,\"type\":\"imglink\",\"default\":[{\"src\":\"\\/assets\\/img\\/placeholder\\/carousel-1200x256-1.png\",\"alt\":\"\\u8f6e\\u64ad\\u56fe1\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/carousel-1200x256-2.png\",\"alt\":\"\\u8f6e\\u64ad\\u56fe2\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"},{\"src\":\"\\/assets\\/img\\/placeholder\\/carousel-1200x256-3.png\",\"alt\":\"\\u8f6e\\u64ad\\u56fe3\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"}]}}}',NULL,'default',1506519316,1506519316),(5,'清秋主题：首页头部图片轮播','template',NULL,'@theme/autumn/block/carousel.template.html.twig',NULL,'','{\"carousel\":[{\"src\":\"\\/static-dist\\/autumntheme\\/img\\/slide-1.jpg\",\"alt\":\"\\u56fe\\u7247\\uff11\\u7684\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"},{\"src\":\"\\/static-dist\\/autumntheme\\/img\\/slide-2.jpg\",\"alt\":\"\\u56fe\\u7247\\uff12\\u7684\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_self\"},{\"src\":\"\\/static-dist\\/autumntheme\\/img\\/slide-3.jpg\",\"alt\":\"\\u56fe\\u7247\\uff13\\u7684\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"}]}','autumn:home_top_banner','{\"title\":\"\\u6e05\\u79cb\\u4e3b\\u9898\\uff1a\\u9996\\u9875\\u5934\\u90e8\\u56fe\\u7247\\u8f6e\\u64ad\",\"category\":\"autumn\",\"templateName\":\"@theme\\/autumn\\/block\\/carousel.template.html.twig\",\"items\":{\"carousel\":{\"title\":\"\\u8f6e\\u64ad\\u56fe\",\"desc\":\"\\u5efa\\u8bbe\\u4f7f\\u75281920x300\\u5927\\u5c0f\\u7684\\u56fe\\u7247\\uff0c\\u6700\\u591a\\u53ef\\u8bbe\\u7f6e\\uff15\\u5f20\\u56fe\\u7247\\u3002\",\"count\":5,\"type\":\"imglink\",\"default\":[{\"src\":\"\\/static-dist\\/autumntheme\\/img\\/slide-1.jpg\",\"alt\":\"\\u56fe\\u7247\\uff11\\u7684\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"},{\"src\":\"\\/static-dist\\/autumntheme\\/img\\/slide-2.jpg\",\"alt\":\"\\u56fe\\u7247\\uff12\\u7684\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_self\"},{\"src\":\"\\/static-dist\\/autumntheme\\/img\\/slide-3.jpg\",\"alt\":\"\\u56fe\\u7247\\uff13\\u7684\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"}]}}}',NULL,'autumn',1506519316,1506519316),(6,'简墨主题：首页顶部.轮播图 ','template',NULL,'@theme/jianmo/block/carousel.template.html.twig',NULL,'','{\"posters\":[{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a51\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_app.jpg\",\"alt\":\"\\u6d77\\u62a52\",\"layout\":\"limitWide\",\"background\":\"#0984f7\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_eweek.jpg\",\"alt\":\"\\u6d77\\u62a53\",\"layout\":\"limitWide\",\"background\":\"#3b4250\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a54\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a55\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a56\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a57\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a58\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"}]}','jianmo:home_top_banner','{\"title\":\"\\u7b80\\u58a8\\u4e3b\\u9898\\uff1a\\u9996\\u9875\\u9876\\u90e8.\\u8f6e\\u64ad\\u56fe \",\"category\":\"jianmo\",\"templateName\":\"@theme\\/jianmo\\/block\\/carousel.template.html.twig\",\"items\":{\"posters\":{\"title\":\"\\u6d77\\u62a5\",\"desc\":\"\\u9996\\u9875\\u6d77\\u62a5\",\"count\":1,\"type\":\"poster\",\"default\":[{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a51\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_app.jpg\",\"alt\":\"\\u6d77\\u62a52\",\"layout\":\"limitWide\",\"background\":\"#0984f7\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_eweek.jpg\",\"alt\":\"\\u6d77\\u62a53\",\"layout\":\"limitWide\",\"background\":\"#3b4250\",\"href\":\"\",\"html\":\"\",\"status\":\"1\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a54\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a55\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a56\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a57\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"},{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_net.jpg\",\"alt\":\"\\u6d77\\u62a58\",\"layout\":\"limitWide\",\"background\":\"#3ec768\",\"href\":\"\",\"html\":\"\",\"status\":\"0\",\"mode\":\"img\"}]}}}',NULL,'jianmo',1506519316,1506519316),(7,'简墨主题：首页中部.横幅','template',NULL,'@theme/jianmo/block/middle_banner.template.html.twig',NULL,'','{\"icon1\":[{\"src\":\"\\/assets\\/v2\\/img\\/icon_introduction_1.png\",\"alt\":\"\\u4e2d\\u90e8\\u6a2a\\u5e45\",\"href\":\"#\",\"target\":\"_blank\"}],\"icon1title\":[{\"value\":\"\\u7f51\\u6821\\u529f\\u80fd\\u5f3a\\u5927\"}],\"icon1introduction\":[{\"value\":\"\\u4e00\\u4e07\\u591a\\u5bb6\\u7f51\\u6821\\u5171\\u540c\\u9009\\u62e9\\uff0c\\u503c\\u5f97\\u4fe1\\u8d56\"}],\"icon2\":[{\"src\":\"\\/assets\\/v2\\/img\\/icon_introduction_2.png\",\"alt\":\"\\u4e2d\\u90e8\\u6a2a\\u5e45\",\"href\":\"#\",\"target\":\"_blank\"}],\"icon2title\":[{\"value\":\"\\u54cd\\u5e94\\u5f0f\\u9875\\u9762\\u6280\\u672f\"}],\"icon2introduction\":[{\"value\":\"\\u91c7\\u7528\\u54cd\\u5e94\\u5f0f\\u6280\\u672f\\uff0c\\u5b8c\\u7f8e\\u9002\\u914d\\u4efb\\u610f\\u7ec8\\u7aef\"}],\"icon3\":[{\"src\":\"\\/assets\\/v2\\/img\\/icon_introduction_3.png\",\"alt\":\"\\u4e2d\\u90e8\\u6a2a\\u5e45\",\"href\":\"#\",\"target\":\"_blank\"}],\"icon3title\":[{\"value\":\"\\u6559\\u80b2\\u4e91\\u670d\\u52a1\\u652f\\u6301\"}],\"icon3introduction\":[{\"value\":\"\\u5f3a\\u529b\\u6559\\u80b2\\u4e91\\u652f\\u6301\\uff0c\\u514d\\u9664\\u4f60\\u7684\\u540e\\u987e\\u4e4b\\u5fe7\"}]}','jianmo:middle_banner','{\"title\":\"\\u7b80\\u58a8\\u4e3b\\u9898\\uff1a\\u9996\\u9875\\u4e2d\\u90e8.\\u6a2a\\u5e45\",\"category\":\"jianmo\",\"templateName\":\"@theme\\/jianmo\\/block\\/middle_banner.template.html.twig\",\"items\":{\"icon1\":{\"title\":\"\\u4e2d\\u90e8\\u56fe\\u6807\\uff11\",\"desc\":\"\\u5efa\\u8bae\\u56fe\\u7247\\u5927\\u5c0f\\u4e3a130*130\",\"count\":1,\"type\":\"imglink\",\"default\":[{\"src\":\"\\/assets\\/v2\\/img\\/icon_introduction_1.png\",\"alt\":\"\\u4e2d\\u90e8\\u6a2a\\u5e45\",\"href\":\"#\",\"target\":\"_blank\"}]},\"icon1title\":{\"title\":\"\\u56fe\\u6807\\uff11\\u6807\\u9898\",\"desc\":\"\",\"count\":1,\"type\":\"text\",\"default\":[{\"value\":\"\\u7f51\\u6821\\u529f\\u80fd\\u5f3a\\u5927\"}]},\"icon1introduction\":{\"title\":\"\\u56fe\\u6807\\uff11\\u4ecb\\u7ecd\",\"desc\":\"\",\"count\":1,\"type\":\"textarea\",\"default\":[{\"value\":\"\\u4e00\\u4e07\\u591a\\u5bb6\\u7f51\\u6821\\u5171\\u540c\\u9009\\u62e9\\uff0c\\u503c\\u5f97\\u4fe1\\u8d56\"}]},\"icon2\":{\"title\":\"\\u4e2d\\u90e8\\u56fe\\u6807\\uff12\",\"desc\":\"\\u5efa\\u8bae\\u56fe\\u7247\\u5927\\u5c0f\\u4e3a130*130\",\"count\":1,\"type\":\"imglink\",\"default\":[{\"src\":\"\\/assets\\/v2\\/img\\/icon_introduction_2.png\",\"alt\":\"\\u4e2d\\u90e8\\u6a2a\\u5e45\",\"href\":\"#\",\"target\":\"_blank\"}]},\"icon2title\":{\"title\":\"\\u56fe\\u6807\\uff12\\u6807\\u9898\",\"desc\":\"\",\"count\":1,\"type\":\"text\",\"default\":[{\"value\":\"\\u54cd\\u5e94\\u5f0f\\u9875\\u9762\\u6280\\u672f\"}]},\"icon2introduction\":{\"title\":\"\\u56fe\\u6807\\uff12\\u4ecb\\u7ecd\",\"desc\":\"\",\"count\":1,\"type\":\"textarea\",\"default\":[{\"value\":\"\\u91c7\\u7528\\u54cd\\u5e94\\u5f0f\\u6280\\u672f\\uff0c\\u5b8c\\u7f8e\\u9002\\u914d\\u4efb\\u610f\\u7ec8\\u7aef\"}]},\"icon3\":{\"title\":\"\\u4e2d\\u90e8\\u56fe\\u6807\\uff13\",\"desc\":\"\\u5efa\\u8bae\\u56fe\\u7247\\u5927\\u5c0f\\u4e3a130*130\",\"count\":1,\"type\":\"imglink\",\"default\":[{\"src\":\"\\/assets\\/v2\\/img\\/icon_introduction_3.png\",\"alt\":\"\\u4e2d\\u90e8\\u6a2a\\u5e45\",\"href\":\"#\",\"target\":\"_blank\"}]},\"icon3title\":{\"title\":\"\\u56fe\\u6807\\uff13\\u6807\\u9898\",\"desc\":\"\",\"count\":1,\"type\":\"text\",\"default\":[{\"value\":\"\\u6559\\u80b2\\u4e91\\u670d\\u52a1\\u652f\\u6301\"}]},\"icon3introduction\":{\"title\":\"\\u56fe\\u6807\\uff13\\u4ecb\\u7ecd\",\"desc\":\"\",\"count\":1,\"type\":\"textarea\",\"default\":[{\"value\":\"\\u5f3a\\u529b\\u6559\\u80b2\\u4e91\\u652f\\u6301\\uff0c\\u514d\\u9664\\u4f60\\u7684\\u540e\\u987e\\u4e4b\\u5fe7\"}]}}}',NULL,'jianmo',1506519316,1506519316),(8,'简墨主题：中部广告','template',NULL,'@theme/jianmo/block/advertisement_banner.template.html.twig',NULL,'','{\"middleImg\":[{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_poster.jpg\",\"alt\":\"\\u56fe\\u7247\\uff11\\u7684\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"}],\"middleBackground\":[{\"value\":\"#e2133a\"}]}','jianmo:advertisement_banner','{\"title\":\"\\u7b80\\u58a8\\u4e3b\\u9898\\uff1a\\u4e2d\\u90e8\\u5e7f\\u544a\",\"category\":\"jianmo\",\"templateName\":\"@theme\\/jianmo\\/block\\/advertisement_banner.template.html.twig\",\"items\":{\"middleImg\":{\"title\":\"\\u5e7f\\u544a\\u56fe\\u7247\",\"desc\":\"\\u5efa\\u8bae\\u56fe\\u7247\\u5927\\u5c0f\\u4e3a\\u5bbd1920px\\u9ad8 400px\",\"count\":\"1\",\"type\":\"imglink\",\"default\":[{\"src\":\"\\/themes\\/jianmo\\/img\\/banner_poster.jpg\",\"alt\":\"\\u56fe\\u7247\\uff11\\u7684\\u63cf\\u8ff0\",\"href\":\"#\",\"target\":\"_blank\"}]},\"middleBackground\":{\"title\":\"\\u80cc\\u666f\\u586b\\u5145\\u8272\",\"desc\":\"\\u586b\\u5199\\u989c\\u8272\\u503c,\\u4f8b\\u5982#ffffff\",\"count\":\"1\",\"type\":\"text\",\"default\":[{\"value\":\"#e2133a\"}]}}}',NULL,'jianmo',1506519316,1506519316),(9,'简墨主题: 首页底部.链接区域','template',NULL,'@theme/jianmo/block/bottom_info.template.html.twig',NULL,'','{\"firstColumnText\":[{\"value\":\"\\u6211\\u662f\\u5b66\\u751f\"}],\"firstColumnLinks\":[{\"value\":\"\\u5982\\u4f55\\u6ce8\\u518c\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/347\\/learn#lesson\\/673\",\"target\":\"_blank\"},{\"value\":\"\\u5982\\u4f55\\u5b66\\u4e60\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/347\\/learn#lesson\\/705\",\"target\":\"_blank\"},{\"value\":\"\\u5982\\u4f55\\u4e92\\u52a8\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/347\\/learn#lesson\\/811\",\"target\":\"_blank\"}],\"secondColumnText\":[{\"value\":\"\\u6211\\u662f\\u8001\\u5e08\"}],\"secondColumnLinks\":[{\"value\":\"\\u53d1\\u5e03\\u8bfe\\u7a0b\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/22\",\"target\":\"_blank\"},{\"value\":\"\\u4f7f\\u7528\\u9898\\u5e93\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/147\",\"target\":\"_blank\"},{\"value\":\"\\u6559\\u5b66\\u8d44\\u6599\\u5e93\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/372\",\"target\":\"_blank\"}],\"thirdColumnText\":[{\"value\":\"\\u6211\\u662f\\u7ba1\\u7406\\u5458\"}],\"thirdColumnLinks\":[{\"value\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/340\",\"target\":\"_blank\"},{\"value\":\"\\u8bfe\\u7a0b\\u8bbe\\u7f6e\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/341\",\"target\":\"_blank\"},{\"value\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/343\",\"target\":\"_blank\"}],\"fourthColumnText\":[{\"value\":\"\\u5546\\u4e1a\\u5e94\\u7528\"}],\"fourthColumnLinks\":[{\"value\":\"\\u4f1a\\u5458\\u4e13\\u533a\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/232\\/learn#lesson\\/358\",\"target\":\"_blank\"},{\"value\":\"\\u9898\\u5e93\\u589e\\u5f3a\\u7248\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/232\\/learn#lesson\\/467\",\"target\":\"_blank\"},{\"value\":\"\\u7528\\u6237\\u5bfc\\u5165\\u5bfc\\u51fa\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/380\",\"target\":\"_blank\"}],\"fifthColumnText\":[{\"value\":\"\\u5173\\u4e8e\\u6211\\u4eec\"}],\"fifthColumnLinks\":[{\"value\":\"ES\\u5b98\\u7f51\",\"href\":\"http:\\/\\/www.edusoho.com\\/\",\"target\":\"_blank\"},{\"value\":\"\\u5b98\\u65b9\\u5fae\\u535a\",\"href\":\"http:\\/\\/weibo.com\\/qiqiuyu\\/profile?rightmod=1&wvr=6&mod=personinfo\",\"target\":\"_blank\"},{\"value\":\"\\u52a0\\u5165\\u6211\\u4eec\",\"href\":\"http:\\/\\/www.edusoho.com\\/abouts\\/joinus\",\"target\":\"_blank\"}],\"bottomLogo\":[{\"src\":\"\\/assets\\/v2\\/img\\/bottom_logo.png\",\"alt\":\"\\u5efa\\u8bae\\u56fe\\u7247\\u5927\\u5c0f\\u4e3a233*64\",\"href\":\"http:\\/\\/www.edusoho.com\",\"target\":\"_blank\"}],\"weibo\":[{\"value\":\"\\u5fae\\u535a\\u9996\\u9875\",\"href\":\"http:\\/\\/weibo.com\\/edusoho\",\"target\":\"_blank\"}],\"weixin\":[{\"src\":\"\\/assets\\/img\\/default\\/weixin.png\",\"alt\":\"\\u5fae\\u4fe1\\u516c\\u4f17\\u53f7\"}],\"apple\":[{\"src\":\"\\/assets\\/img\\/default\\/apple.png\",\"alt\":\"\\u7f51\\u6821\\u7684iOS\\u7248APP\"}],\"android\":[{\"src\":\"\\/assets\\/img\\/default\\/android.png\",\"alt\":\"\\u7f51\\u6821\\u7684Android\\u7248APP\"}]}','jianmo:bottom_info','{\"title\":\"\\u7b80\\u58a8\\u4e3b\\u9898: \\u9996\\u9875\\u5e95\\u90e8.\\u94fe\\u63a5\\u533a\\u57df\",\"category\":\"jianmo\",\"templateName\":\"@theme\\/jianmo\\/block\\/bottom_info.template.html.twig\",\"items\":{\"firstColumnText\":{\"title\":\"\\u7b2c\\uff11\\u5217\\u94fe\\u63a5\\u6807\\u9898\",\"desc\":\"\",\"count\":1,\"type\":\"text\",\"default\":[{\"value\":\"\\u6211\\u662f\\u5b66\\u751f\"}]},\"firstColumnLinks\":{\"title\":\"\\u7b2c\\uff11\\u5217\\u94fe\\u63a5\",\"desc\":\"\",\"count\":5,\"type\":\"link\",\"default\":[{\"value\":\"\\u5982\\u4f55\\u6ce8\\u518c\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/347\\/learn#lesson\\/673\",\"target\":\"_blank\"},{\"value\":\"\\u5982\\u4f55\\u5b66\\u4e60\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/347\\/learn#lesson\\/705\",\"target\":\"_blank\"},{\"value\":\"\\u5982\\u4f55\\u4e92\\u52a8\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/347\\/learn#lesson\\/811\",\"target\":\"_blank\"}]},\"secondColumnText\":{\"title\":\"\\u7b2c\\uff12\\u5217\\u94fe\\u63a5\\u6807\\u9898\",\"desc\":\"\",\"count\":1,\"type\":\"text\",\"default\":[{\"value\":\"\\u6211\\u662f\\u8001\\u5e08\"}]},\"secondColumnLinks\":{\"title\":\"\\u7b2c\\uff12\\u5217\\u94fe\\u63a5\",\"desc\":\"\",\"count\":5,\"type\":\"link\",\"default\":[{\"value\":\"\\u53d1\\u5e03\\u8bfe\\u7a0b\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/22\",\"target\":\"_blank\"},{\"value\":\"\\u4f7f\\u7528\\u9898\\u5e93\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/147\",\"target\":\"_blank\"},{\"value\":\"\\u6559\\u5b66\\u8d44\\u6599\\u5e93\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/372\",\"target\":\"_blank\"}]},\"thirdColumnText\":{\"title\":\"\\u7b2c\\uff13\\u5217\\u94fe\\u63a5\\u6807\\u9898\",\"desc\":\"\",\"count\":1,\"type\":\"text\",\"default\":[{\"value\":\"\\u6211\\u662f\\u7ba1\\u7406\\u5458\"}]},\"thirdColumnLinks\":{\"title\":\"\\u7b2c\\uff13\\u5217\\u94fe\\u63a5\",\"desc\":\"\",\"count\":5,\"type\":\"link\",\"default\":[{\"value\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/340\",\"target\":\"_blank\"},{\"value\":\"\\u8bfe\\u7a0b\\u8bbe\\u7f6e\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/341\",\"target\":\"_blank\"},{\"value\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/343\",\"target\":\"_blank\"}]},\"fourthColumnText\":{\"title\":\"\\u7b2c\\uff14\\u5217\\u94fe\\u63a5\\u6807\\u9898\",\"desc\":\"\",\"count\":1,\"type\":\"text\",\"default\":[{\"value\":\"\\u5546\\u4e1a\\u5e94\\u7528\"}]},\"fourthColumnLinks\":{\"title\":\"\\u7b2c\\uff14\\u5217\\u94fe\\u63a5\\u6807\\u9898\",\"desc\":\"\",\"count\":5,\"type\":\"link\",\"default\":[{\"value\":\"\\u4f1a\\u5458\\u4e13\\u533a\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/232\\/learn#lesson\\/358\",\"target\":\"_blank\"},{\"value\":\"\\u9898\\u5e93\\u589e\\u5f3a\\u7248\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/232\\/learn#lesson\\/467\",\"target\":\"_blank\"},{\"value\":\"\\u7528\\u6237\\u5bfc\\u5165\\u5bfc\\u51fa\",\"href\":\"http:\\/\\/www.qiqiuyu.com\\/course\\/380\",\"target\":\"_blank\"}]},\"fifthColumnText\":{\"title\":\"\\u7b2c\\uff15\\u5217\\u94fe\\u63a5\\u6807\\u9898\",\"desc\":\"\",\"count\":1,\"type\":\"text\",\"default\":[{\"value\":\"\\u5173\\u4e8e\\u6211\\u4eec\"}]},\"fifthColumnLinks\":{\"title\":\"\\u7b2c\\uff15\\u5217\\u94fe\\u63a5\\u6807\\u9898\",\"desc\":\"\",\"count\":5,\"type\":\"link\",\"default\":[{\"value\":\"ES\\u5b98\\u7f51\",\"href\":\"http:\\/\\/www.edusoho.com\\/\",\"target\":\"_blank\"},{\"value\":\"\\u5b98\\u65b9\\u5fae\\u535a\",\"href\":\"http:\\/\\/weibo.com\\/qiqiuyu\\/profile?rightmod=1&wvr=6&mod=personinfo\",\"target\":\"_blank\"},{\"value\":\"\\u52a0\\u5165\\u6211\\u4eec\",\"href\":\"http:\\/\\/www.edusoho.com\\/abouts\\/joinus\",\"target\":\"_blank\"}]},\"bottomLogo\":{\"title\":\"\\u5e95\\u90e8Logo\",\"desc\":\"\\u5efa\\u8bae\\u56fe\\u7247\\u5927\\u5c0f\\u4e3a233*64\",\"count\":1,\"type\":\"imglink\",\"default\":[{\"src\":\"\\/assets\\/v2\\/img\\/bottom_logo.png\",\"alt\":\"\\u5efa\\u8bae\\u56fe\\u7247\\u5927\\u5c0f\\u4e3a233*64\",\"href\":\"http:\\/\\/www.edusoho.com\",\"target\":\"_blank\"}]},\"weibo\":{\"title\":\"\\u5e95\\u90e8\\u5fae\\u535a\\u94fe\\u63a5\",\"desc\":\"\\u586b\\u5165\\u7f51\\u6821\\u7684\\u5fae\\u535a\\u9996\\u9875\\u5730\\u5740\",\"count\":1,\"type\":\"link\",\"default\":[{\"value\":\"\\u5fae\\u535a\\u9996\\u9875\",\"href\":\"http:\\/\\/weibo.com\\/edusoho\",\"target\":\"_blank\"}]},\"weixin\":{\"title\":\"\\u5e95\\u90e8\\u5fae\\u4fe1\\u516c\\u4f17\\u53f7\",\"desc\":\"\\u4e0a\\u4f20\\u7f51\\u6821\\u7684\\u5fae\\u4fe1\\u516c\\u4f17\\u53f7\\u7684\\u4e8c\\u7ef4\\u7801\",\"count\":1,\"type\":\"img\",\"default\":[{\"src\":\"\\/assets\\/img\\/default\\/weixin.png\",\"alt\":\"\\u5fae\\u4fe1\\u516c\\u4f17\\u53f7\"}]},\"apple\":{\"title\":\"\\u5e95\\u90e8iOS\\u7248APP\\u4e0b\\u8f7d\\u4e8c\\u7ef4\\u7801\",\"desc\":\"\\u4e0a\\u4f20\\u7f51\\u6821\\u7684iOS\\u7248APP\\u4e0b\\u8f7d\\u4e8c\\u7ef4\\u7801\",\"count\":1,\"type\":\"img\",\"default\":[{\"src\":\"\\/assets\\/img\\/default\\/apple.png\",\"alt\":\"\\u7f51\\u6821\\u7684iOS\\u7248APP\"}]},\"android\":{\"title\":\"\\u5e95\\u90e8Android\\u7248APP\\u4e0b\\u8f7d\\u4e8c\\u7ef4\\u7801\",\"desc\":\"\\u4e0a\\u4f20\\u7f51\\u6821\\u7684Android\\u7248APP\\u4e0b\\u8f7d\\u4e8c\\u7ef4\\u7801\",\"count\":1,\"type\":\"img\",\"default\":[{\"src\":\"\\/assets\\/img\\/default\\/android.png\",\"alt\":\"\\u7f51\\u6821\\u7684Android\\u7248APP\"}]}}}',NULL,'jianmo',1506519316,1506519316);
/*!40000 ALTER TABLE `block_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '缓存ID',
  `name` varchar(128) NOT NULL DEFAULT '' COMMENT '缓存名称',
  `data` longblob COMMENT '缓存数据',
  `serialized` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '缓存是否为序列化的标记位',
  `expiredTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '缓存过期时间',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '缓存创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `expiredTime` (`expiredTime`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES (35,'settings','a:18:{s:13:\"default-theme\";s:29:\"a:1:{s:3:\"uri\";s:6:\"jianmo\";}\";s:34:\"default-crontab_next_executed_time\";s:13:\"i:1506519316;\";s:15:\"default-contact\";s:326:\"a:8:{s:7:\"enabled\";i:0;s:8:\"worktime\";s:12:\"9:00 - 17:00\";s:2:\"qq\";a:1:{i:0;a:2:{s:4:\"name\";s:0:\"\";s:6:\"number\";s:0:\"\";}}s:7:\"qqgroup\";a:1:{i:0;a:2:{s:4:\"name\";s:0:\"\";s:6:\"number\";s:0:\"\";}}s:5:\"phone\";a:1:{i:0;a:2:{s:4:\"name\";s:0:\"\";s:6:\"number\";s:0:\"\";}}s:10:\"webchatURI\";s:0:\"\";s:5:\"email\";s:0:\"\";s:5:\"color\";s:7:\"default\";}\";s:14:\"default-refund\";s:417:\"a:4:{s:13:\"maxRefundDays\";i:10;s:17:\"applyNotification\";s:107:\"您好，您退款的{{item}}，管理员已收到您的退款申请，请耐心等待退款审核结果。\";s:19:\"successNotification\";s:82:\"您好，您申请退款的{{item}} 审核通过，将为您退款{{amount}}元。\";s:18:\"failedNotification\";s:93:\"您好，您申请退款的{{item}} 审核未通过，请与管理员再协商解决纠纷。\";}\";s:15:\"default-article\";s:57:\"a:2:{s:4:\"name\";s:12:\"资讯频道\";s:8:\"pageNums\";i:20;}\";s:12:\"default-site\";s:313:\"a:12:{s:4:\"name\";s:5:\"QWBXX\";s:6:\"slogan\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"logo\";s:0:\"\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";s:12:\"master_email\";s:17:\"admin@admin.admin\";s:3:\"icp\";s:0:\"\";s:9:\"analytics\";s:0:\"\";s:6:\"status\";s:4:\"open\";s:11:\"closed_note\";s:0:\"\";s:17:\"homepage_template\";s:4:\"less\";}\";s:17:\"default-developer\";s:36:\"a:1:{s:18:\"cloud_api_failover\";i:1;}\";s:12:\"default-auth\";s:833:\"a:8:{s:13:\"register_mode\";s:5:\"email\";s:22:\"email_activation_title\";s:33:\"请激活您的{{sitename}}账号\";s:21:\"email_activation_body\";s:366:\"Hi, {{nickname}}\n\n欢迎加入{{sitename}}!\n\n请点击下面的链接完成注册：\n\n{{verifyurl}}\n\n如果以上链接无法点击，请将上面的地址复制到你的浏览器(如IE)的地址栏中打开，该链接地址24小时内打开有效。\n\n感谢对{{sitename}}的支持！\n\n{{sitename}} {{siteurl}}\n\n(这是一封自动产生的email，请勿回复。)\";s:15:\"welcome_enabled\";s:6:\"opened\";s:14:\"welcome_sender\";s:5:\"admin\";s:15:\"welcome_methods\";a:0:{}s:13:\"welcome_title\";s:24:\"欢迎加入{{sitename}}\";s:12:\"welcome_body\";s:138:\"您好{{nickname}}，我是{{sitename}}的管理员，欢迎加入{{sitename}}，祝您学习愉快。如有问题，随时与我联系。\";}\";s:14:\"default-mailer\";s:198:\"a:7:{s:7:\"enabled\";i:0;s:4:\"host\";s:16:\"smtp.example.com\";s:4:\"port\";s:2:\"25\";s:8:\"username\";s:16:\"user@example.com\";s:8:\"password\";s:0:\"\";s:4:\"from\";s:16:\"user@example.com\";s:4:\"name\";s:5:\"QWBXX\";}\";s:15:\"default-payment\";s:134:\"a:5:{s:7:\"enabled\";i:0;s:12:\"bank_gateway\";s:4:\"none\";s:14:\"alipay_enabled\";i:0;s:10:\"alipay_key\";s:0:\"\";s:13:\"alipay_secret\";s:0:\"\";}\";s:22:\"default-post_num_rules\";s:211:\"a:1:{s:5:\"rules\";a:2:{s:6:\"thread\";a:1:{s:14:\"fiveMuniteRule\";a:2:{s:8:\"interval\";i:300;s:7:\"postNum\";i:100;}}s:17:\"threadLoginedUser\";a:1:{s:14:\"fiveMuniteRule\";a:2:{s:8:\"interval\";i:300;s:7:\"postNum\";i:50;}}}}\";s:15:\"default-default\";s:91:\"a:3:{s:12:\"chapter_name\";s:3:\"章\";s:9:\"user_name\";s:6:\"学员\";s:9:\"part_name\";s:3:\"节\";}\";s:12:\"default-coin\";s:332:\"a:11:{s:10:\"cash_model\";s:4:\"none\";s:9:\"cash_rate\";i:1;s:12:\"coin_enabled\";i:0;s:9:\"coin_name\";s:9:\"虚拟币\";s:12:\"coin_content\";s:0:\"\";s:12:\"coin_picture\";s:0:\"\";s:18:\"coin_picture_50_50\";s:0:\"\";s:18:\"coin_picture_30_30\";s:0:\"\";s:18:\"coin_picture_20_20\";s:0:\"\";s:18:\"coin_picture_10_10\";s:0:\"\";s:19:\"charge_coin_enabled\";s:0:\"\";}\";s:13:\"default-magic\";s:91:\"a:3:{s:18:\"export_allow_count\";i:100000;s:12:\"export_limit\";i:10000;s:10:\"enable_org\";i:0;}\";s:17:\"default-cloud_sms\";s:36:\"a:1:{s:13:\"system_remind\";s:2:\"on\";}\";s:15:\"default-storage\";s:281:\"a:6:{s:11:\"upload_mode\";s:5:\"local\";s:16:\"cloud_api_server\";s:22:\"http://api.edusoho.net\";s:16:\"cloud_access_key\";s:32:\"OmUyvz74WZtVfvV15PgnVrpNzjxocQn0\";s:16:\"cloud_secret_key\";s:32:\"WAut3U7c6WrITtQGZok6e11ldD1ipxCF\";s:21:\"enable_playback_rates\";i:0;s:17:\"cloud_key_applied\";i:1;}\";s:23:\"default-_app_last_check\";s:13:\"i:1506519400;\";s:19:\"default-sms_account\";s:96:\"a:3:{s:6:\"status\";s:7:\"uncheck\";s:9:\"checkTime\";i:1506566418;s:12:\"isOldSmsUser\";s:7:\"unknown\";}\";}',1,0,1506565818);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cardId` varchar(255) NOT NULL DEFAULT '' COMMENT '卡的ID',
  `cardType` varchar(255) NOT NULL DEFAULT '' COMMENT '卡的类型',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '到期时间',
  `useTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间',
  `status` enum('used','receive','invalid','deleted') NOT NULL DEFAULT 'receive' COMMENT '使用状态',
  `userId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '使用者',
  `createdTime` int(10) unsigned NOT NULL COMMENT '领取时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_account`
--

DROP TABLE IF EXISTS `cash_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `cash` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_account`
--

LOCK TABLES `cash_account` WRITE;
/*!40000 ALTER TABLE `cash_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_change`
--

DROP TABLE IF EXISTS `cash_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_change` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_change`
--

LOCK TABLES `cash_change` WRITE;
/*!40000 ALTER TABLE `cash_change` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_change` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_flow`
--

DROP TABLE IF EXISTS `cash_flow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL COMMENT '账号ID，即用户ID',
  `sn` bigint(20) unsigned NOT NULL COMMENT '账目流水号',
  `type` enum('inflow','outflow') NOT NULL COMMENT '流水类型',
  `amount` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `cashType` enum('RMB','Coin') NOT NULL DEFAULT 'Coin' COMMENT '账单类型',
  `cash` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '账单生成后的余额',
  `parentSn` bigint(20) DEFAULT NULL COMMENT '上一个账单的流水号',
  `name` varchar(1024) NOT NULL DEFAULT '' COMMENT '帐目名称',
  `orderSn` varchar(40) NOT NULL COMMENT '订单号',
  `category` varchar(128) NOT NULL DEFAULT '' COMMENT '帐目类目',
  `payment` varchar(32) DEFAULT '',
  `note` text COMMENT '备注',
  `createdTime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tradeNo` (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帐目流水';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_flow`
--

LOCK TABLES `cash_flow` WRITE;
/*!40000 ALTER TABLE `cash_flow` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_flow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_orders`
--

DROP TABLE IF EXISTS `cash_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sn` varchar(32) NOT NULL COMMENT '订单号',
  `status` enum('created','paid','cancelled') NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` float(10,2) unsigned NOT NULL DEFAULT '0.00',
  `payment` varchar(32) NOT NULL DEFAULT 'none',
  `paidTime` int(10) unsigned NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL DEFAULT '',
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `targetType` varchar(64) NOT NULL DEFAULT 'coin' COMMENT '订单类型',
  `token` varchar(50) DEFAULT NULL COMMENT '令牌',
  `data` text COMMENT '订单业务数据',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sn` (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_orders`
--

LOCK TABLES `cash_orders` WRITE;
/*!40000 ALTER TABLE `cash_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_orders_log`
--

DROP TABLE IF EXISTS `cash_orders_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_orders_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(10) unsigned NOT NULL,
  `message` text,
  `data` text,
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_orders_log`
--

LOCK TABLES `cash_orders_log` WRITE;
/*!40000 ALTER TABLE `cash_orders_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_orders_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `code` varchar(64) NOT NULL DEFAULT '' COMMENT '分类编码',
  `name` varchar(255) NOT NULL COMMENT '分类名称',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '图标',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '分类完整路径',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '分类权重',
  `groupId` int(10) unsigned NOT NULL COMMENT '分类组ID',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父分类ID',
  `description` text,
  `orgId` int(10) unsigned DEFAULT '1',
  `orgCode` varchar(255) DEFAULT '1.' COMMENT '组织机构内部编码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uri` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'default','默认分类','','',0,1,0,NULL,1,'1.'),(2,'classroomdefault','默认分类','','',0,2,0,NULL,1,'1.');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_group`
--

DROP TABLE IF EXISTS `category_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类组ID',
  `code` varchar(64) NOT NULL COMMENT '分类组编码',
  `name` varchar(255) NOT NULL COMMENT '分类组名称',
  `depth` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '该组下分类允许的最大层级数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_group`
--

LOCK TABLES `category_group` WRITE;
/*!40000 ALTER TABLE `category_group` DISABLE KEYS */;
INSERT INTO `category_group` VALUES (1,'course','课程分类',3),(2,'classroom','班级分类',3);
/*!40000 ALTER TABLE `category_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classroom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `status` enum('closed','draft','published') NOT NULL DEFAULT 'draft' COMMENT '状态关闭，未发布，发布',
  `about` text COMMENT '简介',
  `categoryId` int(10) NOT NULL DEFAULT '0' COMMENT '分类id',
  `description` text COMMENT '课程说明',
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '价格',
  `vipLevelId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支持的vip等级',
  `smallPicture` varchar(255) NOT NULL DEFAULT '' COMMENT '小图',
  `middlePicture` varchar(255) NOT NULL DEFAULT '' COMMENT '中图',
  `largePicture` varchar(255) NOT NULL DEFAULT '' COMMENT '大图',
  `headTeacherId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '班主任ID',
  `teacherIds` varchar(255) NOT NULL DEFAULT '' COMMENT '教师IDs',
  `assistantIds` text COMMENT '助教Ids',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `auditorNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '旁听生数',
  `studentNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学员数',
  `courseNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程数',
  `lessonNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时数',
  `threadNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题数',
  `noteNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '班级笔记数量',
  `postNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `rating` float unsigned NOT NULL DEFAULT '0' COMMENT '排行数值',
  `ratingNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '投票人数',
  `income` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '收入',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `service` varchar(255) DEFAULT NULL COMMENT '班级服务',
  `private` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否封闭班级',
  `recommended` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为推荐班级',
  `recommendedSeq` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '推荐序号',
  `recommendedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐时间',
  `maxRate` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '最大抵扣百分比',
  `showable` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开放展示',
  `buyable` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开放购买',
  `conversationId` varchar(255) NOT NULL DEFAULT '0',
  `orgId` int(10) unsigned DEFAULT '1',
  `orgCode` varchar(255) DEFAULT '1.' COMMENT '组织机构内部编码',
  `expiryMode` varchar(32) NOT NULL DEFAULT 'forever' COMMENT '学习有效期模式：date、days、forever',
  `expiryValue` int(10) NOT NULL DEFAULT '0' COMMENT '有效期',
  `creator` int(10) NOT NULL DEFAULT '0' COMMENT '班级创建者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom`
--

LOCK TABLES `classroom` WRITE;
/*!40000 ALTER TABLE `classroom` DISABLE KEYS */;
INSERT INTO `classroom` VALUES (1,'飞猪提高班','published',NULL,0,NULL,0.00,0,'','','',3,'[\"1\"]',NULL,0,0,4,0,0,0,0,0,0,0,0.00,1506564550,1506567866,NULL,0,0,100,0,100,1,1,'0',1,'1.','forever',0,1);
/*!40000 ALTER TABLE `classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom_courses`
--

DROP TABLE IF EXISTS `classroom_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classroom_courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classroomId` int(10) unsigned NOT NULL COMMENT '班级ID',
  `courseId` int(10) unsigned NOT NULL COMMENT '课程ID',
  `parentCourseId` int(10) unsigned NOT NULL COMMENT '父课程Id',
  `seq` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '班级课程顺序',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `courseSetId` int(10) NOT NULL DEFAULT '0' COMMENT '课程ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom_courses`
--

LOCK TABLES `classroom_courses` WRITE;
/*!40000 ALTER TABLE `classroom_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `classroom_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom_member`
--

DROP TABLE IF EXISTS `classroom_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classroom_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classroomId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '班级ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `orderId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `levelId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '等级',
  `noteNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '笔记数',
  `threadNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题数',
  `locked` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '学员是否被锁定',
  `remark` text COMMENT '备注',
  `role` varchar(255) NOT NULL DEFAULT 'auditor' COMMENT '角色',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `lastLearnTime` int(10) DEFAULT NULL COMMENT '最后学习时间',
  `learnedNum` int(10) DEFAULT NULL COMMENT '已学课时数',
  `updatedTime` int(10) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '到期时间',
  `deadlineNotified` int(10) NOT NULL DEFAULT '0' COMMENT '有效期通知',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom_member`
--

LOCK TABLES `classroom_member` WRITE;
/*!40000 ALTER TABLE `classroom_member` DISABLE KEYS */;
INSERT INTO `classroom_member` VALUES (1,1,1,0,0,0,0,0,'','|teacher|',1506564550,NULL,NULL,1506564550,0,0),(2,1,3,0,0,0,0,0,'','|headTeacher|',1506564566,NULL,NULL,1506564566,0,0),(3,1,12,6,0,0,0,0,'','|student|',1506566574,NULL,NULL,1506566574,0,0),(4,1,14,9,0,0,0,0,'','|student|',1506567345,NULL,NULL,1506567345,0,0),(5,1,16,11,0,0,0,0,'','|student|',1506567592,NULL,NULL,1506567592,0,0),(6,1,17,13,0,0,0,0,'','|student|',1506567866,NULL,NULL,1506567866,0,0);
/*!40000 ALTER TABLE `classroom_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom_review`
--

DROP TABLE IF EXISTS `classroom_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classroom_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `classroomId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '班级ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `rating` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评分0-5',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '回复ID',
  `updatedTime` int(10) DEFAULT NULL,
  `meta` text COMMENT '评价元信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom_review`
--

LOCK TABLES `classroom_review` WRITE;
/*!40000 ALTER TABLE `classroom_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `classroom_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cloud_app`
--

DROP TABLE IF EXISTS `cloud_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cloud_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '云应用ID',
  `name` varchar(255) NOT NULL COMMENT '云应用名称',
  `code` varchar(64) NOT NULL COMMENT '云应用编码',
  `type` enum('plugin','theme') NOT NULL DEFAULT 'plugin' COMMENT '应用类型(plugin插件应用, theme主题应用)',
  `protocol` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `description` text NOT NULL COMMENT '云应用描述',
  `icon` varchar(255) NOT NULL COMMENT '云应用图标',
  `version` varchar(32) NOT NULL COMMENT '云应用当前版本',
  `fromVersion` varchar(32) NOT NULL DEFAULT '0.0.0' COMMENT '云应用更新前版本',
  `developerId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '云应用开发者用户ID',
  `developerName` varchar(255) NOT NULL DEFAULT '' COMMENT '云应用开发者名称',
  `installedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '云应用安装时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '云应用最后更新时间',
  `edusohoMinVersion` varchar(32) NOT NULL DEFAULT '0.0.0' COMMENT '依赖Edusoho的最小版本',
  `edusohoMaxVersion` varchar(32) NOT NULL DEFAULT 'up' COMMENT '依赖Edusoho的最大版本',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='已安装的应用';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cloud_app`
--

LOCK TABLES `cloud_app` WRITE;
/*!40000 ALTER TABLE `cloud_app` DISABLE KEYS */;
INSERT INTO `cloud_app` VALUES (1,'EduSoho主系统','MAIN','plugin',2,'EduSoho主系统','','0.0.00','0.0.0',1,'EduSoho官方',1506519400,1506519400,'0.0.0','up');
/*!40000 ALTER TABLE `cloud_app` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cloud_app_logs`
--

DROP TABLE IF EXISTS `cloud_app_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cloud_app_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '云应用运行日志ID',
  `code` varchar(32) NOT NULL DEFAULT '' COMMENT '应用编码',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '应用名称',
  `fromVersion` varchar(32) DEFAULT NULL COMMENT '升级前版本',
  `toVersion` varchar(32) NOT NULL DEFAULT '' COMMENT '升级后版本',
  `type` enum('install','upgrade') NOT NULL DEFAULT 'install' COMMENT '升级类型',
  `dbBackupPath` varchar(255) NOT NULL DEFAULT '' COMMENT '数据库备份文件',
  `sourceBackupPath` varchar(255) NOT NULL DEFAULT '' COMMENT '源文件备份地址',
  `status` varchar(32) NOT NULL COMMENT '升级状态(ROLLBACK,ERROR,SUCCESS,RECOVERED)',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'IP',
  `message` text COMMENT '失败原因',
  `createdTime` int(10) unsigned NOT NULL COMMENT '日志记录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='应用升级日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cloud_app_logs`
--

LOCK TABLES `cloud_app_logs` WRITE;
/*!40000 ALTER TABLE `cloud_app_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `cloud_app_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cloud_data`
--

DROP TABLE IF EXISTS `cloud_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cloud_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `createdTime` int(10) unsigned NOT NULL,
  `updatedTime` int(10) unsigned NOT NULL,
  `createdUserId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cloud_data`
--

LOCK TABLES `cloud_data` WRITE;
/*!40000 ALTER TABLE `cloud_data` DISABLE KEYS */;
INSERT INTO `cloud_data` VALUES (1,'school.course.join','{\"id\":\"14\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"5\",\"orderId\":\"1\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506565129\",\"lastLearnTime\":null,\"updatedTime\":\"1506565129\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"0\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506520295\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"5\",\"nickname\":\"FPxfKpg\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506565129\",\"createdTime\":\"1506565089\"}}',1506565169,1506565209,1506565209,5),(2,'school.course.join','{\"id\":\"15\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"6\",\"orderId\":\"2\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506565648\",\"lastLearnTime\":null,\"updatedTime\":\"1506565648\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"1\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506565169\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"6\",\"nickname\":\"FPYNPiX\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506565648\",\"createdTime\":\"1506565608\"}}',1506565688,1506565728,1506565728,6),(3,'school.course.join','{\"id\":\"16\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"10\",\"orderId\":\"3\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506566115\",\"lastLearnTime\":null,\"updatedTime\":\"1506566115\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"2\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506565856\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"10\",\"nickname\":\"FPyGKZs\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506566115\",\"createdTime\":\"1506566075\"}}',1506566155,1506566195,1506566195,10),(4,'school.course.join','{\"id\":\"17\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"11\",\"orderId\":\"4\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506566318\",\"lastLearnTime\":null,\"updatedTime\":\"1506566318\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"3\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506566155\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"11\",\"nickname\":\"FPuCryc\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506566318\",\"createdTime\":\"1506566278\"}}',1506566358,1506566399,1506566399,11),(5,'school.course.join','{\"id\":\"18\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"12\",\"orderId\":\"5\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506566507\",\"lastLearnTime\":null,\"updatedTime\":\"1506566507\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"4\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506566358\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"12\",\"nickname\":\"FPompux\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506566507\",\"createdTime\":\"1506566466\"}}',1506566547,1506566572,1506566572,12),(6,'school.course.join','{\"id\":\"19\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"13\",\"orderId\":\"7\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506567183\",\"lastLearnTime\":null,\"updatedTime\":\"1506567183\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"5\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506566547\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"13\",\"nickname\":\"FPuTMbO\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506567183\",\"createdTime\":\"1506567142\"}}',1506567223,1506567263,1506567263,13),(7,'school.course.join','{\"id\":\"20\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"14\",\"orderId\":\"8\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506567252\",\"lastLearnTime\":null,\"updatedTime\":\"1506567252\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"5\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506566547\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"14\",\"nickname\":\"FPPiJkw\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506567252\",\"createdTime\":\"1506567212\"}}',1506567303,1506567343,1506567343,14),(8,'school.classroom.join','{\"id\":\"4\",\"classroomId\":\"1\",\"userId\":\"14\",\"orderId\":\"9\",\"levelId\":\"0\",\"noteNum\":\"0\",\"threadNum\":\"0\",\"locked\":\"0\",\"remark\":\"\",\"role\":[\"student\"],\"createdTime\":\"1506567345\",\"lastLearnTime\":null,\"learnedNum\":null,\"updatedTime\":\"1506567345\",\"deadline\":\"0\",\"deadlineNotified\":\"0\",\"classroom\":{\"id\":\"1\",\"title\":\"\\u98de\\u732a\\u63d0\\u9ad8\\u73ed\",\"status\":\"published\",\"about\":null,\"categoryId\":\"0\",\"description\":null,\"price\":\"0.00\",\"vipLevelId\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\",\"headTeacherId\":\"3\",\"teacherIds\":[\"1\"],\"assistantIds\":[],\"hitNum\":\"0\",\"auditorNum\":\"0\",\"studentNum\":\"1\",\"courseNum\":\"0\",\"lessonNum\":\"0\",\"threadNum\":\"0\",\"noteNum\":\"0\",\"postNum\":\"0\",\"rating\":\"0\",\"ratingNum\":\"0\",\"income\":\"0.00\",\"createdTime\":\"1506564550\",\"updatedTime\":\"1506566574\",\"service\":[],\"private\":\"0\",\"recommended\":\"0\",\"recommendedSeq\":\"100\",\"recommendedTime\":\"0\",\"maxRate\":\"100\",\"showable\":\"1\",\"buyable\":\"1\",\"conversationId\":\"0\",\"orgId\":\"1\",\"orgCode\":\"1.\",\"expiryMode\":\"forever\",\"expiryValue\":\"0\",\"creator\":\"1\"},\"user\":{\"id\":\"14\",\"nickname\":\"FPPiJkw\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506567345\",\"createdTime\":\"1506567212\"}}',1506567345,1506567385,1506567385,14),(9,'school.course.join','{\"id\":\"21\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"16\",\"orderId\":\"10\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506567510\",\"lastLearnTime\":null,\"updatedTime\":\"1506567510\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"6\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506567303\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"16\",\"nickname\":\"FPSlwOy\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506567510\",\"createdTime\":\"1506567470\"}}',1506567550,1506567590,1506567590,16),(10,'school.classroom.join','{\"id\":\"5\",\"classroomId\":\"1\",\"userId\":\"16\",\"orderId\":\"11\",\"levelId\":\"0\",\"noteNum\":\"0\",\"threadNum\":\"0\",\"locked\":\"0\",\"remark\":\"\",\"role\":[\"student\"],\"createdTime\":\"1506567592\",\"lastLearnTime\":null,\"learnedNum\":null,\"updatedTime\":\"1506567592\",\"deadline\":\"0\",\"deadlineNotified\":\"0\",\"classroom\":{\"id\":\"1\",\"title\":\"\\u98de\\u732a\\u63d0\\u9ad8\\u73ed\",\"status\":\"published\",\"about\":null,\"categoryId\":\"0\",\"description\":null,\"price\":\"0.00\",\"vipLevelId\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\",\"headTeacherId\":\"3\",\"teacherIds\":[\"1\"],\"assistantIds\":[],\"hitNum\":\"0\",\"auditorNum\":\"0\",\"studentNum\":\"2\",\"courseNum\":\"0\",\"lessonNum\":\"0\",\"threadNum\":\"0\",\"noteNum\":\"0\",\"postNum\":\"0\",\"rating\":\"0\",\"ratingNum\":\"0\",\"income\":\"0.00\",\"createdTime\":\"1506564550\",\"updatedTime\":\"1506567345\",\"service\":[],\"private\":\"0\",\"recommended\":\"0\",\"recommendedSeq\":\"100\",\"recommendedTime\":\"0\",\"maxRate\":\"100\",\"showable\":\"1\",\"buyable\":\"1\",\"conversationId\":\"0\",\"orgId\":\"1\",\"orgCode\":\"1.\",\"expiryMode\":\"forever\",\"expiryValue\":\"0\",\"creator\":\"1\"},\"user\":{\"id\":\"16\",\"nickname\":\"FPSlwOy\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506567592\",\"createdTime\":\"1506567470\"}}',1506567592,1506567632,1506567632,16),(11,'school.course.join','{\"id\":\"22\",\"courseId\":\"1\",\"classroomId\":\"0\",\"joinedType\":\"course\",\"userId\":\"17\",\"orderId\":\"12\",\"deadline\":\"0\",\"levelId\":\"0\",\"learnedNum\":\"0\",\"credit\":\"0\",\"noteNum\":\"0\",\"noteLastUpdateTime\":\"0\",\"isLearned\":\"0\",\"finishedTime\":\"0\",\"seq\":\"0\",\"remark\":\"\",\"isVisible\":\"1\",\"role\":\"student\",\"locked\":\"0\",\"deadlineNotified\":\"0\",\"createdTime\":\"1506567784\",\"lastLearnTime\":null,\"updatedTime\":\"1506567784\",\"lastViewTime\":\"0\",\"courseSetId\":\"1\",\"course\":{\"id\":\"1\",\"courseSetId\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"learnMode\":\"freeMode\",\"expiryMode\":\"forever\",\"expiryDays\":\"0\",\"expiryStartDate\":\"0\",\"expiryEndDate\":\"0\",\"summary\":null,\"goals\":[],\"audiences\":[],\"isDefault\":\"1\",\"maxStudentNum\":\"0\",\"status\":\"published\",\"creator\":\"1\",\"isFree\":\"1\",\"price\":\"0.00\",\"vipLevelId\":\"0\",\"buyable\":\"1\",\"tryLookable\":\"0\",\"tryLookLength\":\"0\",\"watchLimit\":\"0\",\"services\":[],\"taskNum\":\"0\",\"publishedTaskNum\":\"0\",\"studentNum\":\"8\",\"teacherIds\":[\"1\",\"3\"],\"parentId\":\"0\",\"createdTime\":\"1506519674\",\"updatedTime\":\"1506567550\",\"ratingNum\":\"0\",\"rating\":\"0\",\"noteNum\":\"0\",\"buyExpiryTime\":\"0\",\"threadNum\":\"0\",\"type\":\"normal\",\"approval\":\"0\",\"income\":\"0.00\",\"originPrice\":\"0.00\",\"coinPrice\":\"0.00\",\"originCoinPrice\":\"0.00\",\"showStudentNumType\":\"opened\",\"giveCredit\":\"0\",\"about\":\"\",\"locationId\":\"0\",\"address\":\"\",\"deadlineNotify\":\"none\",\"daysOfNotifyBeforeDeadline\":\"0\",\"useInClassroom\":\"single\",\"singleBuy\":\"1\",\"freeStartTime\":\"0\",\"freeEndTime\":\"0\",\"locked\":\"0\",\"cover\":null,\"enableFinish\":\"1\",\"materialNum\":\"0\",\"maxRate\":\"100\",\"serializeMode\":\"none\",\"showServices\":\"1\",\"recommended\":\"0\",\"recommendedSeq\":\"0\",\"recommendedTime\":\"0\",\"categoryId\":\"0\",\"hitNum\":\"0\",\"courseType\":\"default\",\"rewardPoint\":\"0\",\"taskRewardPoint\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\"},\"user\":{\"id\":\"17\",\"nickname\":\"FPqqBrl\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506567784\",\"createdTime\":\"1506567744\"}}',1506567825,1506567865,1506567865,17),(12,'school.classroom.join','{\"id\":\"6\",\"classroomId\":\"1\",\"userId\":\"17\",\"orderId\":\"13\",\"levelId\":\"0\",\"noteNum\":\"0\",\"threadNum\":\"0\",\"locked\":\"0\",\"remark\":\"\",\"role\":[\"student\"],\"createdTime\":\"1506567866\",\"lastLearnTime\":null,\"learnedNum\":null,\"updatedTime\":\"1506567866\",\"deadline\":\"0\",\"deadlineNotified\":\"0\",\"classroom\":{\"id\":\"1\",\"title\":\"\\u98de\\u732a\\u63d0\\u9ad8\\u73ed\",\"status\":\"published\",\"about\":null,\"categoryId\":\"0\",\"description\":null,\"price\":\"0.00\",\"vipLevelId\":\"0\",\"smallPicture\":\"\",\"middlePicture\":\"\",\"largePicture\":\"\",\"headTeacherId\":\"3\",\"teacherIds\":[\"1\"],\"assistantIds\":[],\"hitNum\":\"0\",\"auditorNum\":\"0\",\"studentNum\":\"3\",\"courseNum\":\"0\",\"lessonNum\":\"0\",\"threadNum\":\"0\",\"noteNum\":\"0\",\"postNum\":\"0\",\"rating\":\"0\",\"ratingNum\":\"0\",\"income\":\"0.00\",\"createdTime\":\"1506564550\",\"updatedTime\":\"1506567592\",\"service\":[],\"private\":\"0\",\"recommended\":\"0\",\"recommendedSeq\":\"100\",\"recommendedTime\":\"0\",\"maxRate\":\"100\",\"showable\":\"1\",\"buyable\":\"1\",\"conversationId\":\"0\",\"orgId\":\"1\",\"orgCode\":\"1.\",\"expiryMode\":\"forever\",\"expiryValue\":\"0\",\"creator\":\"1\"},\"user\":{\"id\":\"17\",\"nickname\":\"FPqqBrl\",\"title\":\"\",\"roles\":\"student\",\"point\":\"0\",\"avatar\":\"\",\"about\":\"\",\"updatedTime\":\"1506567866\",\"createdTime\":\"1506567744\"}}',1506567866,1506567906,1506567906,17);
/*!40000 ALTER TABLE `cloud_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `objectType` varchar(32) NOT NULL,
  `objectId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `createdTime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `objectType` (`objectType`,`objectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '内容ID',
  `title` varchar(255) NOT NULL COMMENT '内容标题',
  `editor` enum('richeditor','none') NOT NULL DEFAULT 'richeditor' COMMENT '编辑器选择类型字段',
  `type` varchar(255) NOT NULL COMMENT '内容类型',
  `alias` varchar(255) NOT NULL DEFAULT '' COMMENT '内容别名',
  `summary` text COMMENT '内容摘要',
  `body` text COMMENT '内容正文',
  `picture` varchar(255) NOT NULL DEFAULT '' COMMENT '内容头图',
  `template` varchar(255) NOT NULL DEFAULT '' COMMENT '内容模板',
  `status` enum('published','unpublished','trash') NOT NULL COMMENT '内容状态',
  `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '内容分类ID',
  `tagIds` tinytext COMMENT '内容标签ID',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '内容点击量',
  `featured` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否头条',
  `promoted` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否推荐',
  `sticky` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `userId` int(10) unsigned NOT NULL COMMENT '发布人ID',
  `field1` text COMMENT '扩展字段',
  `field2` text COMMENT '扩展字段',
  `field3` text COMMENT '扩展字段',
  `field4` text COMMENT '扩展字段',
  `field5` text COMMENT '扩展字段',
  `field6` text COMMENT '扩展字段',
  `field7` text COMMENT '扩展字段',
  `field8` text COMMENT '扩展字段',
  `field9` text COMMENT '扩展字段',
  `field10` text COMMENT '扩展字段',
  `publishedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `createdTime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'关于我们','richeditor','page','aboutus',NULL,'','','default','published',0,NULL,0,0,1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1506519316,1506519316),(2,'常见问题','richeditor','page','questions',NULL,'','','default','published',0,NULL,0,0,1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1506519316,1506519316);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL COMMENT '优惠码',
  `type` enum('minus','discount') NOT NULL COMMENT '优惠方式',
  `status` enum('used','unused','receive') NOT NULL COMMENT '使用状态',
  `rate` float(10,2) unsigned NOT NULL COMMENT '若优惠方式为打折，则为打折率，若为抵价，则为抵价金额',
  `batchId` int(10) unsigned DEFAULT NULL COMMENT '批次号',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用者',
  `deadline` int(10) unsigned NOT NULL COMMENT '失效时间',
  `targetType` varchar(64) DEFAULT NULL COMMENT '使用对象类型',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用对象',
  `orderId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订单号',
  `orderTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间',
  `createdTime` int(10) unsigned NOT NULL,
  `receiveTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '接收时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠码表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon`
--

LOCK TABLES `coupon` WRITE;
/*!40000 ALTER TABLE `coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程ID',
  `title` varchar(1024) NOT NULL COMMENT '课程标题',
  `subtitle` varchar(1024) NOT NULL DEFAULT '' COMMENT '课程副标题',
  `status` enum('draft','published','closed') NOT NULL DEFAULT 'draft' COMMENT '课程状态',
  `buyable` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开放购买',
  `buyExpiryTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '购买开放有效期',
  `type` varchar(255) NOT NULL DEFAULT 'normal' COMMENT '课程类型',
  `maxStudentNum` int(11) NOT NULL DEFAULT '0' COMMENT '直播课程最大学员数上线',
  `price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程价格',
  `originPrice` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程人民币原价',
  `coinPrice` float(10,2) NOT NULL DEFAULT '0.00',
  `originCoinPrice` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程虚拟币原价',
  `expiryMode` enum('date','days','none') NOT NULL DEFAULT 'none' COMMENT '有效期模式（截止日期|有效期天数|不设置）',
  `expiryDay` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程过期天数',
  `showStudentNumType` enum('opened','closed') NOT NULL DEFAULT 'opened' COMMENT '学员数显示模式',
  `serializeMode` enum('none','serialize','finished') NOT NULL DEFAULT 'none' COMMENT '连载模式',
  `income` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程销售总收入',
  `lessonNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时数',
  `giveCredit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学完课程所有课时，可获得的总学分',
  `rating` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排行分数',
  `ratingNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '投票人数',
  `vipLevelId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '可以免费看的，会员等级',
  `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `tags` text COMMENT '标签IDs',
  `smallPicture` varchar(255) NOT NULL DEFAULT '' COMMENT '小图',
  `middlePicture` varchar(255) NOT NULL DEFAULT '' COMMENT '中图',
  `largePicture` varchar(255) NOT NULL DEFAULT '' COMMENT '大图',
  `about` text COMMENT '简介',
  `teacherIds` text COMMENT '显示的课程教师IDs',
  `goals` text COMMENT '课程目标',
  `audiences` text COMMENT '适合人群',
  `recommended` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为推荐课程',
  `recommendedSeq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐序号',
  `recommendedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐时间',
  `locationId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上课地区ID',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程的父Id',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '上课地区地址',
  `studentNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学员数',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  `noteNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程笔记数量',
  `userId` int(10) unsigned NOT NULL COMMENT '课程发布人ID',
  `discountId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '折扣活动ID',
  `discount` float(10,2) NOT NULL DEFAULT '10.00' COMMENT '折扣',
  `deadlineNotify` enum('active','none') NOT NULL DEFAULT 'none' COMMENT '开启有效期通知',
  `daysOfNotifyBeforeDeadline` int(10) NOT NULL DEFAULT '0',
  `watchLimit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时观看次数限制',
  `useInClassroom` enum('single','more') NOT NULL DEFAULT 'single' COMMENT '课程能否用于多个班级',
  `singleBuy` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '加入班级后课程能否单独购买',
  `createdTime` int(10) unsigned NOT NULL COMMENT '课程创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `freeStartTime` int(10) NOT NULL DEFAULT '0',
  `freeEndTime` int(10) NOT NULL DEFAULT '0',
  `approval` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要实名认证',
  `locked` int(10) NOT NULL DEFAULT '0' COMMENT '是否上锁1上锁,0解锁',
  `maxRate` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '最大抵扣百分比',
  `tryLookable` tinyint(4) NOT NULL DEFAULT '0',
  `tryLookTime` int(11) NOT NULL DEFAULT '0',
  `conversationId` varchar(255) NOT NULL DEFAULT '0',
  `orgId` int(10) unsigned DEFAULT '1',
  `orgCode` varchar(255) DEFAULT '1.' COMMENT '组织机构内部编码',
  PRIMARY KEY (`id`),
  KEY `updatedTime` (`updatedTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_chapter`
--

DROP TABLE IF EXISTS `course_chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_chapter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程章节ID',
  `courseId` int(10) unsigned NOT NULL COMMENT '章节所属课程ID',
  `type` varchar(255) NOT NULL DEFAULT 'chapter' COMMENT '章节类型：chapter为章节，unit为单元，lesson为课时。',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'parentId大于０时为单元',
  `number` int(10) unsigned NOT NULL COMMENT '章节编号',
  `seq` int(10) unsigned NOT NULL COMMENT '章节序号',
  `title` varchar(255) NOT NULL COMMENT '章节名称',
  `createdTime` int(10) unsigned NOT NULL COMMENT '章节创建时间',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制章节的id',
  `migrateLessonId` int(10) DEFAULT '0',
  `migrateCopyCourseId` int(10) DEFAULT '0',
  `migrateRefTaskId` int(10) DEFAULT '0',
  `mgrateCopyTaskId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_chapter`
--

LOCK TABLES `course_chapter` WRITE;
/*!40000 ALTER TABLE `course_chapter` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_chapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_draft`
--

DROP TABLE IF EXISTS `course_draft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_draft` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `summary` text COMMENT '摘要',
  `courseId` int(10) unsigned NOT NULL COMMENT '课程ID',
  `content` text COMMENT '内容',
  `userId` int(10) unsigned NOT NULL COMMENT '用户ID',
  `activityId` int(10) unsigned NOT NULL COMMENT '教学活动ID',
  `createdTime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_draft`
--

LOCK TABLES `course_draft` WRITE;
/*!40000 ALTER TABLE `course_draft` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_draft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_favorite`
--

DROP TABLE IF EXISTS `course_favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_favorite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏ID',
  `courseId` int(10) unsigned NOT NULL COMMENT '教学计划ID',
  `userId` int(10) unsigned NOT NULL COMMENT '收藏人的ID',
  `createdTime` int(10) NOT NULL COMMENT '创建时间',
  `type` varchar(50) NOT NULL DEFAULT 'course' COMMENT '课程类型',
  `courseSetId` int(10) NOT NULL DEFAULT '0' COMMENT '课程ID',
  PRIMARY KEY (`id`),
  KEY `course_favorite_userId_courseId_type_index` (`userId`,`courseId`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户的收藏数据表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_favorite`
--

LOCK TABLES `course_favorite` WRITE;
/*!40000 ALTER TABLE `course_favorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_lesson`
--

DROP TABLE IF EXISTS `course_lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_lesson` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课时ID',
  `courseId` int(10) unsigned NOT NULL COMMENT '课时所属课程ID',
  `chapterId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时所属章节ID',
  `number` int(10) unsigned NOT NULL COMMENT '课时编号',
  `seq` int(10) unsigned NOT NULL COMMENT '课时在课程中的序号',
  `free` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为免费课时',
  `status` enum('unpublished','published') NOT NULL DEFAULT 'published' COMMENT '课时状态',
  `title` varchar(255) NOT NULL COMMENT '课时标题',
  `summary` text COMMENT '课时摘要',
  `tags` text COMMENT '课时标签',
  `type` varchar(64) NOT NULL DEFAULT 'text' COMMENT '课时类型',
  `content` text COMMENT '课时正文',
  `giveCredit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学完课时获得的学分',
  `requireCredit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学习课时前，需达到的学分',
  `mediaId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '媒体文件ID',
  `mediaSource` varchar(32) NOT NULL DEFAULT '' COMMENT '媒体文件来源(self:本站上传,youku:优酷)',
  `mediaName` varchar(255) NOT NULL DEFAULT '' COMMENT '媒体文件名称',
  `mediaUri` text COMMENT '媒体文件资源名',
  `homeworkId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '作业iD',
  `exerciseId` int(10) unsigned DEFAULT '0' COMMENT '练习ID',
  `length` int(11) unsigned DEFAULT NULL COMMENT '时长',
  `materialNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传的资料数量',
  `quizNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '测验题目数量',
  `learnedNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已学的学员数',
  `viewedNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看数',
  `startTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '直播课时开始时间',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '直播课时结束时间',
  `memberNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '直播课时加入人数',
  `replayStatus` enum('ungenerated','generating','generated','videoGenerated') NOT NULL DEFAULT 'ungenerated',
  `maxOnlineNum` int(11) DEFAULT '0' COMMENT '直播在线人数峰值',
  `liveProvider` int(10) unsigned NOT NULL DEFAULT '0',
  `userId` int(10) unsigned NOT NULL COMMENT '发布人ID',
  `createdTime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制课时id',
  `testMode` enum('normal','realTime') DEFAULT 'normal' COMMENT '考试模式',
  `testStartTime` int(10) DEFAULT '0' COMMENT '实时考试开始时间',
  PRIMARY KEY (`id`),
  KEY `updatedTime` (`updatedTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_lesson`
--

LOCK TABLES `course_lesson` WRITE;
/*!40000 ALTER TABLE `course_lesson` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_lesson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_lesson_extend`
--

DROP TABLE IF EXISTS `course_lesson_extend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_lesson_extend` (
  `id` int(10) NOT NULL COMMENT '课时ID',
  `courseId` int(10) NOT NULL DEFAULT '0' COMMENT '课程ID',
  `doTimes` int(10) NOT NULL DEFAULT '0' COMMENT '可考试次数',
  `redoInterval` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '重做时间间隔(小时)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='试卷课时扩展表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_lesson_extend`
--

LOCK TABLES `course_lesson_extend` WRITE;
/*!40000 ALTER TABLE `course_lesson_extend` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_lesson_extend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_lesson_learn`
--

DROP TABLE IF EXISTS `course_lesson_learn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_lesson_learn` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '学员课时学习记录ID',
  `userId` int(10) unsigned NOT NULL COMMENT '学员ID',
  `courseId` int(10) unsigned NOT NULL COMMENT '课程ID',
  `lessonId` int(10) unsigned NOT NULL COMMENT '课时ID',
  `status` enum('learning','finished') NOT NULL COMMENT '学习状态',
  `startTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学习开始时间',
  `finishedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学习完成时间',
  `learnTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学习时间',
  `watchTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学习观看时间',
  `watchNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时已观看次数',
  `videoStatus` enum('paused','playing') NOT NULL DEFAULT 'paused' COMMENT '学习观看时间',
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId_lessonId` (`userId`,`lessonId`),
  KEY `userId_courseId` (`userId`,`courseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_lesson_learn`
--

LOCK TABLES `course_lesson_learn` WRITE;
/*!40000 ALTER TABLE `course_lesson_learn` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_lesson_learn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_lesson_replay`
--

DROP TABLE IF EXISTS `course_lesson_replay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_lesson_replay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lessonId` int(10) unsigned NOT NULL COMMENT '所属课时',
  `courseId` int(10) unsigned NOT NULL COMMENT '所属课程',
  `title` varchar(255) NOT NULL COMMENT '名称',
  `replayId` text NOT NULL COMMENT '云直播中的回放id',
  `globalId` char(32) NOT NULL DEFAULT '' COMMENT '云资源ID',
  `userId` int(10) unsigned NOT NULL COMMENT '创建者',
  `createdTime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `hidden` tinyint(1) unsigned DEFAULT '0' COMMENT '观看状态',
  `type` varchar(50) NOT NULL DEFAULT 'live' COMMENT '课程类型',
  `copyId` int(10) DEFAULT '0' COMMENT '复制回放的ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_lesson_replay`
--

LOCK TABLES `course_lesson_replay` WRITE;
/*!40000 ALTER TABLE `course_lesson_replay` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_lesson_replay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_lesson_view`
--

DROP TABLE IF EXISTS `course_lesson_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_lesson_view` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `courseId` int(10) NOT NULL,
  `lessonId` int(10) NOT NULL,
  `fileId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `fileType` enum('document','video','audio','image','ppt','other','none') NOT NULL DEFAULT 'none',
  `fileStorage` enum('local','cloud','net','none') NOT NULL DEFAULT 'none',
  `fileSource` varchar(32) NOT NULL,
  `createdTime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_lesson_view`
--

LOCK TABLES `course_lesson_view` WRITE;
/*!40000 ALTER TABLE `course_lesson_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_lesson_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_material`
--

DROP TABLE IF EXISTS `course_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_material` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程资料ID',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料所属课程ID',
  `lessonId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料所属课时ID',
  `title` varchar(1024) NOT NULL COMMENT '资料标题',
  `description` text COMMENT '资料描述',
  `link` varchar(1024) NOT NULL DEFAULT '' COMMENT '外部链接地址',
  `fileId` int(10) unsigned NOT NULL COMMENT '资料文件ID',
  `fileUri` varchar(255) NOT NULL DEFAULT '' COMMENT '资料文件URI',
  `fileMime` varchar(255) NOT NULL DEFAULT '' COMMENT '资料文件MIME',
  `fileSize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料文件大小',
  `source` varchar(50) NOT NULL DEFAULT 'coursematerial',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料创建人ID',
  `createdTime` int(10) unsigned NOT NULL COMMENT '资料创建时间',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制的资料Id',
  `type` varchar(50) NOT NULL DEFAULT 'course' COMMENT '课程类型',
  `courseSetId` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_material`
--

LOCK TABLES `course_material` WRITE;
/*!40000 ALTER TABLE `course_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_material_v8`
--

DROP TABLE IF EXISTS `course_material_v8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_material_v8` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程资料ID',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料所属课程ID',
  `lessonId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料所属课时ID',
  `title` varchar(1024) NOT NULL COMMENT '资料标题',
  `description` text COMMENT '资料描述',
  `link` varchar(1024) NOT NULL DEFAULT '' COMMENT '外部链接地址',
  `fileId` int(10) unsigned NOT NULL COMMENT '资料文件ID',
  `fileUri` varchar(255) NOT NULL DEFAULT '' COMMENT '资料文件URI',
  `fileMime` varchar(255) NOT NULL DEFAULT '' COMMENT '资料文件MIME',
  `fileSize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料文件大小',
  `source` varchar(50) NOT NULL DEFAULT 'coursematerial',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料创建人ID',
  `createdTime` int(10) unsigned NOT NULL COMMENT '资料创建时间',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制的资料Id',
  `type` varchar(50) NOT NULL DEFAULT 'course' COMMENT '课程类型',
  `courseSetId` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_material_v8`
--

LOCK TABLES `course_material_v8` WRITE;
/*!40000 ALTER TABLE `course_material_v8` DISABLE KEYS */;
INSERT INTO `course_material_v8` VALUES (1,2,1,'a.mp4','','',1,'','',464255,'opencourselesson',1,1506521138,0,'openCourse',0),(3,1,2,'a.mp4','','',4,'','',464255,'opencourselesson',1,1506565850,0,'openCourse',0);
/*!40000 ALTER TABLE `course_material_v8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_member`
--

DROP TABLE IF EXISTS `course_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程学员记录ID',
  `courseId` int(10) unsigned NOT NULL COMMENT '教学计划ID',
  `classroomId` int(10) NOT NULL DEFAULT '0' COMMENT '班级ID',
  `joinedType` enum('course','classroom') NOT NULL DEFAULT 'course' COMMENT '购买班级或者课程加入学习',
  `userId` int(10) unsigned NOT NULL COMMENT '学员ID',
  `orderId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学员购买课程时的订单ID',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学习最后期限',
  `levelId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户以会员的方式加入课程学员时的会员ID',
  `learnedNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已学课时数',
  `credit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学员已获得的学分',
  `noteNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '笔记数目',
  `noteLastUpdateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最新的笔记更新时间',
  `isLearned` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否已学完',
  `finishedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '完成课程时间',
  `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序序号',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `isVisible` tinyint(2) NOT NULL DEFAULT '1' COMMENT '可见与否，默认为可见',
  `role` enum('student','teacher') NOT NULL DEFAULT 'student' COMMENT '课程会员角色',
  `locked` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '学员是否被锁定',
  `deadlineNotified` int(10) NOT NULL DEFAULT '0' COMMENT '有效期通知',
  `createdTime` int(10) unsigned NOT NULL COMMENT '学员加入课程时间',
  `lastLearnTime` int(10) DEFAULT NULL COMMENT '最后学习时间',
  `updatedTime` int(10) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `lastViewTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后查看时间',
  `courseSetId` int(10) unsigned NOT NULL COMMENT '课程ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `courseId` (`courseId`,`userId`),
  KEY `courseId_role_createdTime` (`courseId`,`role`,`createdTime`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_member`
--

LOCK TABLES `course_member` WRITE;
/*!40000 ALTER TABLE `course_member` DISABLE KEYS */;
INSERT INTO `course_member` VALUES (12,1,0,'course',1,0,0,0,0,0,0,0,0,0,0,'',1,'teacher',0,0,1506520295,NULL,1506520295,0,1),(13,1,0,'course',3,0,0,0,0,0,0,0,0,0,1,'',1,'teacher',0,0,1506520295,NULL,1506520295,0,1),(14,1,0,'course',5,1,0,0,0,0,0,1506565129,0,0,0,'',1,'student',0,0,1506565129,NULL,1506565129,0,1),(15,1,0,'course',6,2,0,0,0,0,0,1506565648,0,0,0,'',1,'student',0,0,1506565648,NULL,1506565648,0,1),(16,1,0,'course',10,3,0,0,0,0,0,1506566115,0,0,0,'',1,'student',0,0,1506566115,NULL,1506566115,0,1),(17,1,0,'course',11,4,0,0,0,0,0,1506566318,0,0,0,'',1,'student',0,0,1506566318,NULL,1506566318,0,1),(18,1,0,'course',12,5,0,0,0,0,0,1506566507,0,0,0,'',1,'student',0,0,1506566507,NULL,1506566507,0,1),(19,1,0,'course',13,7,0,0,0,0,0,1506567183,0,0,0,'',1,'student',0,0,1506567183,NULL,1506567183,0,1),(20,1,0,'course',14,8,0,0,0,0,0,1506567252,0,0,0,'',1,'student',0,0,1506567252,NULL,1506567252,0,1),(21,1,0,'course',16,10,0,0,0,0,0,1506567510,0,0,0,'',1,'student',0,0,1506567510,NULL,1506567510,0,1),(22,1,0,'course',17,12,0,0,0,0,0,1506567784,0,0,0,'',1,'student',0,0,1506567784,NULL,1506567784,0,1);
/*!40000 ALTER TABLE `course_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_note`
--

DROP TABLE IF EXISTS `course_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_note` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '笔记ID',
  `userId` int(10) NOT NULL COMMENT '笔记作者ID',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程ID',
  `taskId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务ID',
  `content` text NOT NULL COMMENT '笔记内容',
  `length` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '笔记内容的字数',
  `likeNum` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '点赞人数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '笔记状态：0:私有, 1:公开',
  `createdTime` int(10) NOT NULL COMMENT '笔记创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '笔记更新时间',
  `courseSetId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_note`
--

LOCK TABLES `course_note` WRITE;
/*!40000 ALTER TABLE `course_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_note_like`
--

DROP TABLE IF EXISTS `course_note_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_note_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noteId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdTime` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_note_like`
--

LOCK TABLES `course_note_like` WRITE;
/*!40000 ALTER TABLE `course_note_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_note_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_review`
--

DROP TABLE IF EXISTS `course_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程评价ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评价人ID',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被评价的课程ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '评价标题',
  `content` text NOT NULL COMMENT '评论内容',
  `rating` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评分',
  `private` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `createdTime` int(10) unsigned NOT NULL COMMENT '评价创建时间',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '回复ID',
  `updatedTime` int(10) DEFAULT NULL,
  `meta` text COMMENT '评价元信息',
  `courseSetId` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_review`
--

LOCK TABLES `course_review` WRITE;
/*!40000 ALTER TABLE `course_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_set_v8`
--

DROP TABLE IF EXISTS `course_set_v8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_set_v8` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL DEFAULT '',
  `title` varchar(1024) DEFAULT '',
  `subtitle` varchar(1024) DEFAULT '',
  `tags` text,
  `categoryId` int(10) NOT NULL DEFAULT '0',
  `summary` text,
  `goals` text,
  `audiences` text,
  `isVip` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是VIP课程',
  `cover` varchar(1024) DEFAULT NULL,
  `status` varchar(32) DEFAULT '0' COMMENT 'draft, published, closed',
  `creator` int(11) DEFAULT '0',
  `createdTime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedTime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `serializeMode` varchar(32) NOT NULL DEFAULT 'none' COMMENT 'none, serilized, finished',
  `ratingNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程评论数',
  `rating` float unsigned NOT NULL DEFAULT '0' COMMENT '课程评分',
  `noteNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程笔记数',
  `studentNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程学员数',
  `recommended` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为推荐课程',
  `recommendedSeq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐序号',
  `recommendedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐时间',
  `orgId` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '组织机构ID',
  `orgCode` varchar(255) NOT NULL DEFAULT '1.' COMMENT '组织机构内部编码',
  `discountId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '折扣活动ID',
  `discount` float(10,2) NOT NULL DEFAULT '10.00' COMMENT '折扣',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程点击数',
  `maxRate` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '最大抵扣百分比',
  `materialNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传的资料数量',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否班级课程',
  `locked` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁住',
  `minCoursePrice` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '已发布教学计划的最低价格',
  `maxCoursePrice` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '已发布教学计划的最高价格',
  `teacherIds` varchar(1024) DEFAULT NULL,
  `defaultCourseId` int(11) unsigned DEFAULT '0' COMMENT '默认的计划ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_set_v8`
--

LOCK TABLES `course_set_v8` WRITE;
/*!40000 ALTER TABLE `course_set_v8` DISABLE KEYS */;
INSERT INTO `course_set_v8` VALUES (1,'normal','飞猪普通课程','','',0,NULL,'','',0,'','published',1,1506519674,1506567784,'none',0,0,0,9,0,0,0,1,'1.',0,10.00,0,100,0,0,0,0.00,0.00,'|1|',1);
/*!40000 ALTER TABLE `course_set_v8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_task`
--

DROP TABLE IF EXISTS `course_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属课程的id',
  `fromCourseSetId` int(10) unsigned NOT NULL DEFAULT '0',
  `seq` int(10) unsigned NOT NULL,
  `categoryId` int(10) DEFAULT NULL,
  `activityId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '引用的教学活动',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `isFree` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否免费',
  `isOptional` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否必修',
  `startTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `status` varchar(255) NOT NULL DEFAULT 'create' COMMENT '发布状态 create|publish|unpublish',
  `createdUserId` int(10) unsigned NOT NULL COMMENT '创建者',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `mode` varchar(60) DEFAULT NULL COMMENT '任务模式',
  `number` varchar(32) NOT NULL DEFAULT '' COMMENT '任务编号',
  `type` varchar(50) NOT NULL COMMENT '任务类型',
  `mediaSource` varchar(32) NOT NULL DEFAULT '' COMMENT '媒体文件来源(self:本站上传,youku:优酷)',
  `length` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '若是视频类型，则表示时长；若是ppt，则表示页数；由具体的活动业务来定义',
  `maxOnlineNum` int(11) unsigned DEFAULT '0' COMMENT '任务最大可同时进行的人数，0为不限制',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制来源task的id',
  `migrateLessonId` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `seq` (`seq`),
  KEY `courseId` (`courseId`),
  KEY `migrateLessonIdAndType` (`migrateLessonId`,`type`),
  KEY `migrateLessonIdAndActivityId` (`migrateLessonId`,`activityId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_task`
--

LOCK TABLES `course_task` WRITE;
/*!40000 ALTER TABLE `course_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_task_result`
--

DROP TABLE IF EXISTS `course_task_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_task_result` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `activityId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动的id',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属课程的id',
  `courseTaskId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程的任务id',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `status` varchar(255) NOT NULL DEFAULT 'start' COMMENT '任务状态，start，finish',
  `finishedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '完成时间',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务进行时长（分钟）',
  `watchTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `courseTaskId_activityId` (`courseTaskId`,`activityId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_task_result`
--

LOCK TABLES `course_task_result` WRITE;
/*!40000 ALTER TABLE `course_task_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_task_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_task_view`
--

DROP TABLE IF EXISTS `course_task_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_task_view` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `courseSetId` int(10) NOT NULL,
  `courseId` int(10) NOT NULL,
  `taskId` int(10) NOT NULL,
  `fileId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `fileType` varchar(80) NOT NULL,
  `fileStorage` varchar(80) NOT NULL,
  `fileSource` varchar(32) NOT NULL,
  `createdTime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_task_view`
--

LOCK TABLES `course_task_view` WRITE;
/*!40000 ALTER TABLE `course_task_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_task_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_thread`
--

DROP TABLE IF EXISTS `course_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程话题ID',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题所属课程ID',
  `taskId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题发布人ID',
  `type` enum('discussion','question') NOT NULL DEFAULT 'discussion' COMMENT '话题类型',
  `isStick` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `isElite` tinyint(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否精华',
  `isClosed` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否关闭',
  `private` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `title` varchar(255) NOT NULL COMMENT '话题标题',
  `content` text COMMENT '话题内容',
  `postNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看数',
  `followNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关注数',
  `latestPostUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后回复人ID',
  `latestPostTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后回复时间',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `courseSetId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updatedTime` (`updatedTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_thread`
--

LOCK TABLES `course_thread` WRITE;
/*!40000 ALTER TABLE `course_thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_thread_post`
--

DROP TABLE IF EXISTS `course_thread_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_thread_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程话题回复ID',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复所属课程ID',
  `taskId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务ID',
  `threadId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复所属话题ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复人',
  `isElite` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否精华',
  `content` text NOT NULL COMMENT '正文',
  `createdTime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_thread_post`
--

LOCK TABLES `course_thread_post` WRITE;
/*!40000 ALTER TABLE `course_thread_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_thread_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_v8`
--

DROP TABLE IF EXISTS `course_v8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_v8` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `courseSetId` int(11) NOT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `learnMode` varchar(32) DEFAULT NULL COMMENT 'lockMode, freeMode',
  `expiryMode` varchar(32) DEFAULT NULL COMMENT 'days, date',
  `expiryDays` int(11) DEFAULT NULL,
  `expiryStartDate` int(10) unsigned DEFAULT NULL,
  `expiryEndDate` int(10) unsigned DEFAULT NULL,
  `summary` text,
  `goals` text,
  `audiences` text,
  `isDefault` tinyint(1) DEFAULT '0',
  `maxStudentNum` int(11) DEFAULT '0',
  `status` varchar(32) DEFAULT NULL COMMENT 'draft, published, closed',
  `creator` int(11) DEFAULT NULL,
  `isFree` tinyint(1) DEFAULT '0',
  `price` float(10,2) DEFAULT '0.00',
  `vipLevelId` int(11) DEFAULT '0',
  `buyable` tinyint(1) DEFAULT '1',
  `tryLookable` tinyint(1) DEFAULT '0',
  `tryLookLength` int(11) DEFAULT '0',
  `watchLimit` int(11) DEFAULT '0',
  `services` text,
  `taskNum` int(10) DEFAULT '0' COMMENT '任务数',
  `publishedTaskNum` int(10) DEFAULT '0' COMMENT '已发布的任务数',
  `studentNum` int(10) DEFAULT '0' COMMENT '学员数',
  `teacherIds` varchar(1024) DEFAULT '0' COMMENT '可见教师ID列表',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程的父Id',
  `createdTime` int(10) unsigned NOT NULL COMMENT '课程创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `ratingNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程计划评论数',
  `rating` float unsigned NOT NULL DEFAULT '0' COMMENT '课程计划评分',
  `noteNum` int(10) unsigned NOT NULL DEFAULT '0',
  `buyExpiryTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '购买开放有效期',
  `threadNum` int(10) DEFAULT '0' COMMENT '话题数',
  `type` varchar(32) NOT NULL DEFAULT 'normal' COMMENT '教学计划类型',
  `approval` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要实名才能购买',
  `income` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '总收入',
  `originPrice` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程人民币原价',
  `coinPrice` float(10,2) NOT NULL DEFAULT '0.00',
  `originCoinPrice` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '课程虚拟币原价',
  `showStudentNumType` enum('opened','closed') NOT NULL DEFAULT 'opened' COMMENT '学员数显示模式',
  `giveCredit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学完课程所有课时，可获得的总学分',
  `about` text COMMENT '简介',
  `locationId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上课地区ID',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '上课地区地址',
  `deadlineNotify` enum('active','none') NOT NULL DEFAULT 'none' COMMENT '开启有效期通知',
  `daysOfNotifyBeforeDeadline` int(10) NOT NULL DEFAULT '0',
  `useInClassroom` enum('single','more') NOT NULL DEFAULT 'single' COMMENT '课程能否用于多个班级',
  `singleBuy` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '加入班级后课程能否单独购买',
  `freeStartTime` int(10) NOT NULL DEFAULT '0',
  `freeEndTime` int(10) NOT NULL DEFAULT '0',
  `locked` int(10) NOT NULL DEFAULT '0' COMMENT '是否上锁1上锁,0解锁',
  `cover` varchar(1024) DEFAULT NULL,
  `enableFinish` int(1) NOT NULL DEFAULT '1' COMMENT '是否允许学院强制完成任务',
  `materialNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传的资料数量',
  `maxRate` tinyint(3) DEFAULT '0' COMMENT '最大抵扣百分比',
  `serializeMode` varchar(32) NOT NULL DEFAULT 'none' COMMENT 'none, serilized, finished',
  `showServices` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否在营销页展示服务承诺',
  `recommended` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为推荐课程',
  `recommendedSeq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐序号',
  `recommendedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐时间',
  `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `courseType` varchar(32) DEFAULT 'default' COMMENT 'default, normal, times,...',
  `rewardPoint` int(10) NOT NULL DEFAULT '0' COMMENT '课程积分',
  `taskRewardPoint` int(10) NOT NULL DEFAULT '0' COMMENT '任务积分',
  PRIMARY KEY (`id`),
  KEY `courseSetId` (`courseSetId`),
  KEY `courseSetId_status` (`courseSetId`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_v8`
--

LOCK TABLES `course_v8` WRITE;
/*!40000 ALTER TABLE `course_v8` DISABLE KEYS */;
INSERT INTO `course_v8` VALUES (1,1,'默认教学计划','freeMode','forever',0,0,0,NULL,NULL,NULL,1,0,'published',1,1,0.00,0,1,0,0,0,NULL,0,0,9,'|1|3|',0,1506519674,1506567824,0,0,0,0,0,'normal',0,0.00,0.00,0.00,0.00,'opened',0,NULL,0,'','none',0,'single',1,0,0,0,NULL,1,0,100,'none',1,0,0,0,0,0,'default',0,0);
/*!40000 ALTER TABLE `course_v8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crontab_job`
--

DROP TABLE IF EXISTS `crontab_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crontab_job` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(1024) NOT NULL COMMENT '任务名称',
  `cycle` enum('once','everyhour','everyday','everymonth') NOT NULL DEFAULT 'once' COMMENT '任务执行周期',
  `cycleTime` varchar(255) NOT NULL DEFAULT '0' COMMENT '任务执行时间',
  `jobClass` varchar(1024) NOT NULL COMMENT '任务的Class名称',
  `jobParams` text COMMENT '任务参数',
  `targetType` varchar(64) NOT NULL DEFAULT '',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0',
  `executing` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '任务执行状态',
  `nextExcutedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务下次执行的时间',
  `latestExecutedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务最后执行的时间',
  `creatorId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务创建人',
  `createdTime` int(10) unsigned NOT NULL COMMENT '任务创建时间',
  `enabled` tinyint(1) DEFAULT '1' COMMENT '是否启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crontab_job`
--

LOCK TABLES `crontab_job` WRITE;
/*!40000 ALTER TABLE `crontab_job` DISABLE KEYS */;
INSERT INTO `crontab_job` VALUES (1,'CancelOrderJob','everyhour','0','Biz\\Order\\Job\\CancelOrderJob','','',0,0,1506567809,1506564209,1,1506519316,1),(2,'DeleteExpiredTokenJob','everyhour','0','Biz\\User\\Job\\DeleteExpiredTokenJob','','',0,0,1506567889,1506564289,1,1506519316,1);
/*!40000 ALTER TABLE `crontab_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dictionary`
--

DROP TABLE IF EXISTS `dictionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dictionary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '字典名称',
  `type` varchar(255) NOT NULL COMMENT '字典类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dictionary`
--

LOCK TABLES `dictionary` WRITE;
/*!40000 ALTER TABLE `dictionary` DISABLE KEYS */;
INSERT INTO `dictionary` VALUES (1,'退学原因','refund_reason');
/*!40000 ALTER TABLE `dictionary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dictionary_item`
--

DROP TABLE IF EXISTS `dictionary_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dictionary_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL COMMENT '字典类型',
  `code` varchar(64) DEFAULT NULL COMMENT '编码',
  `name` varchar(255) NOT NULL COMMENT '字典内容名称',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '权重',
  `createdTime` int(10) unsigned NOT NULL,
  `updateTime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dictionary_item`
--

LOCK TABLES `dictionary_item` WRITE;
/*!40000 ALTER TABLE `dictionary_item` DISABLE KEYS */;
INSERT INTO `dictionary_item` VALUES (1,'refund_reason',NULL,'课程内容质量差',0,1506519316,1506519316),(2,'refund_reason',NULL,'老师服务态度不好',0,1506519316,1506519316);
/*!40000 ALTER TABLE `dictionary_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discovery_column`
--

DROP TABLE IF EXISTS `discovery_column`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discovery_column` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(32) NOT NULL COMMENT '栏目类型',
  `categoryId` int(10) NOT NULL DEFAULT '0' COMMENT '分类',
  `orderType` varchar(32) NOT NULL COMMENT '排序字段',
  `showCount` int(10) NOT NULL COMMENT '展示数量',
  `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `createdTime` int(10) unsigned NOT NULL,
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发现页栏目';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discovery_column`
--

LOCK TABLES `discovery_column` WRITE;
/*!40000 ALTER TABLE `discovery_column` DISABLE KEYS */;
/*!40000 ALTER TABLE `discovery_column` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `download_file_record`
--

DROP TABLE IF EXISTS `download_file_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `download_file_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `downloadActivityId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料所属活动ID',
  `materialId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资料文件ID',
  `fileId` varchar(1024) DEFAULT '' COMMENT '文件ID',
  `link` varchar(1024) DEFAULT '' COMMENT '链接地址',
  `createdTime` int(10) unsigned NOT NULL COMMENT '下载时间',
  `userId` int(10) unsigned NOT NULL COMMENT '下载用户ID',
  PRIMARY KEY (`id`),
  KEY `createdTime` (`createdTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download_file_record`
--

LOCK TABLES `download_file_record` WRITE;
/*!40000 ALTER TABLE `download_file_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `download_file_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '上传文件ID',
  `groupId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传文件组ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传人ID',
  `uri` varchar(255) NOT NULL COMMENT '文件URI',
  `mime` varchar(255) NOT NULL COMMENT '文件MIME',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件状态',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件上传时间',
  `uploadFileId` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (2,1,1,'public://default/2017/09-27/213740401c25733180.png','',82588,0,1506519460,NULL),(3,1,1,'public://default/2017/09-27/213740403024308615.png','',32631,0,1506519460,NULL),(4,1,1,'public://default/2017/09-27/21374040438b731443.png','',6067,0,1506519460,NULL);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_group`
--

DROP TABLE IF EXISTS `file_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '上传文件组ID',
  `name` varchar(255) NOT NULL COMMENT '上传文件组名称',
  `code` varchar(255) NOT NULL COMMENT '上传文件组编码',
  `public` tinyint(4) NOT NULL DEFAULT '1' COMMENT '文件组文件是否公开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_group`
--

LOCK TABLES `file_group` WRITE;
/*!40000 ALTER TABLE `file_group` DISABLE KEYS */;
INSERT INTO `file_group` VALUES (1,'默认文件组','default',1),(2,'缩略图','thumb',1),(3,'课程','course',1),(4,'用户','user',1),(5,'课程私有文件','course_private',0),(6,'资讯','article',1),(7,'临时目录','tmp',1),(8,'全局设置文件','system',1),(9,'小组','group',1),(10,'编辑区','block',1),(11,'班级','classroom',1);
/*!40000 ALTER TABLE `file_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_used`
--

DROP TABLE IF EXISTS `file_used`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `fileId` int(11) NOT NULL COMMENT 'upload_files id',
  `targetType` varchar(32) NOT NULL,
  `targetId` int(11) NOT NULL,
  `createdTime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_used_type_targetType_targetId_index` (`type`,`targetType`,`targetId`),
  KEY `file_used_type_targetType_targetId_fileId_index` (`type`,`targetType`,`targetId`,`fileId`),
  KEY `file_used_fileId_index` (`fileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_used`
--

LOCK TABLES `file_used` WRITE;
/*!40000 ALTER TABLE `file_used` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_used` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friend`
--

DROP TABLE IF EXISTS `friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '关注ID',
  `fromId` int(10) unsigned NOT NULL COMMENT '关注人ID',
  `toId` int(10) unsigned NOT NULL COMMENT '被关注人ID',
  `pair` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为互加好友',
  `createdTime` int(10) unsigned NOT NULL COMMENT '关注时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend`
--

LOCK TABLES `friend` WRITE;
/*!40000 ALTER TABLE `friend` DISABLE KEYS */;
/*!40000 ALTER TABLE `friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '小组id',
  `title` varchar(100) NOT NULL COMMENT '小组名称',
  `about` text COMMENT '小组介绍',
  `logo` varchar(100) NOT NULL DEFAULT '' COMMENT 'logo',
  `backgroundLogo` varchar(100) NOT NULL DEFAULT '',
  `status` enum('open','close') NOT NULL DEFAULT 'open',
  `memberNum` int(10) unsigned NOT NULL DEFAULT '0',
  `threadNum` int(10) unsigned NOT NULL DEFAULT '0',
  `postNum` int(10) unsigned NOT NULL DEFAULT '0',
  `ownerId` int(10) unsigned NOT NULL COMMENT '小组组长id',
  `createdTime` int(11) unsigned NOT NULL COMMENT '创建小组时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_member`
--

DROP TABLE IF EXISTS `groups_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '成员id主键',
  `groupId` int(10) unsigned NOT NULL COMMENT '小组id',
  `userId` int(10) unsigned NOT NULL COMMENT '用户id',
  `role` varchar(100) NOT NULL DEFAULT 'member',
  `postNum` int(10) unsigned NOT NULL DEFAULT '0',
  `threadNum` int(10) unsigned NOT NULL DEFAULT '0',
  `createdTime` int(11) unsigned NOT NULL COMMENT '加入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_member`
--

LOCK TABLES `groups_member` WRITE;
/*!40000 ALTER TABLE `groups_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_thread`
--

DROP TABLE IF EXISTS `groups_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '话题id',
  `title` varchar(1024) NOT NULL COMMENT '话题标题',
  `content` text COMMENT '话题内容',
  `isElite` int(11) unsigned NOT NULL DEFAULT '0',
  `isStick` int(11) unsigned NOT NULL DEFAULT '0',
  `lastPostMemberId` int(10) unsigned NOT NULL DEFAULT '0',
  `lastPostTime` int(10) unsigned NOT NULL DEFAULT '0',
  `groupId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `createdTime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `postNum` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('open','close') NOT NULL DEFAULT 'open',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0',
  `rewardCoin` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT 'default',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  KEY `updatedTime` (`updatedTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_thread`
--

LOCK TABLES `groups_thread` WRITE;
/*!40000 ALTER TABLE `groups_thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_thread_collect`
--

DROP TABLE IF EXISTS `groups_thread_collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_thread_collect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id主键',
  `threadId` int(11) unsigned NOT NULL COMMENT '收藏的话题id',
  `userId` int(10) unsigned NOT NULL COMMENT '收藏人id',
  `createdTime` int(10) unsigned NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_thread_collect`
--

LOCK TABLES `groups_thread_collect` WRITE;
/*!40000 ALTER TABLE `groups_thread_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_thread_collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_thread_goods`
--

DROP TABLE IF EXISTS `groups_thread_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_thread_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('content','attachment','postAttachment') NOT NULL,
  `threadId` int(10) unsigned NOT NULL,
  `postId` int(10) unsigned NOT NULL DEFAULT '0',
  `coin` int(10) unsigned NOT NULL,
  `fileId` int(10) unsigned NOT NULL DEFAULT '0',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_thread_goods`
--

LOCK TABLES `groups_thread_goods` WRITE;
/*!40000 ALTER TABLE `groups_thread_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_thread_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_thread_post`
--

DROP TABLE IF EXISTS `groups_thread_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_thread_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id主键',
  `threadId` int(11) unsigned NOT NULL COMMENT '话题id',
  `content` text NOT NULL COMMENT '回复内容',
  `userId` int(10) unsigned NOT NULL COMMENT '回复人id',
  `fromUserId` int(10) unsigned NOT NULL DEFAULT '0',
  `postId` int(10) unsigned DEFAULT '0',
  `createdTime` int(10) unsigned NOT NULL COMMENT '回复时间',
  `adopt` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_thread_post`
--

LOCK TABLES `groups_thread_post` WRITE;
/*!40000 ALTER TABLE `groups_thread_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_thread_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_thread_trade`
--

DROP TABLE IF EXISTS `groups_thread_trade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_thread_trade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `threadId` int(10) unsigned DEFAULT '0',
  `goodsId` int(10) DEFAULT '0',
  `userId` int(10) unsigned NOT NULL,
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_thread_trade`
--

LOCK TABLES `groups_thread_trade` WRITE;
/*!40000 ALTER TABLE `groups_thread_trade` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_thread_trade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `im_conversation`
--

DROP TABLE IF EXISTS `im_conversation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `im_conversation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(64) NOT NULL COMMENT 'IM云端返回的会话id',
  `targetType` varchar(16) NOT NULL DEFAULT '',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0',
  `memberIds` text NOT NULL COMMENT '会话中用户列表(用户id按照小到大排序，竖线隔开)',
  `memberHash` varchar(32) NOT NULL DEFAULT '' COMMENT 'memberIds字段的hash值，用于优化查询',
  `createdTime` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `targetId` (`targetId`),
  KEY `targetType` (`targetType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='IM云端会话记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `im_conversation`
--

LOCK TABLES `im_conversation` WRITE;
/*!40000 ALTER TABLE `im_conversation` DISABLE KEYS */;
/*!40000 ALTER TABLE `im_conversation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `im_member`
--

DROP TABLE IF EXISTS `im_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `im_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `convNo` varchar(32) NOT NULL COMMENT '会话ID',
  `targetId` int(10) NOT NULL,
  `targetType` varchar(15) NOT NULL,
  `userId` int(10) NOT NULL DEFAULT '0',
  `createdTime` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `convno_userId` (`convNo`,`userId`),
  KEY `userId_targetType` (`userId`,`targetType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会话用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `im_member`
--

LOCK TABLES `im_member` WRITE;
/*!40000 ALTER TABLE `im_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `im_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invite_record`
--

DROP TABLE IF EXISTS `invite_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invite_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inviteUserId` int(11) unsigned DEFAULT NULL COMMENT '邀请者',
  `invitedUserId` int(11) unsigned DEFAULT NULL COMMENT '被邀请者',
  `inviteTime` int(11) unsigned DEFAULT NULL COMMENT '邀请时间',
  `inviteUserCardId` int(11) unsigned DEFAULT NULL COMMENT '邀请者获得奖励的卡的ID',
  `invitedUserCardId` int(11) unsigned DEFAULT NULL COMMENT '被邀请者获得奖励的卡的ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='邀请记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invite_record`
--

LOCK TABLES `invite_record` WRITE;
/*!40000 ALTER TABLE `invite_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `invite_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip_blacklist`
--

DROP TABLE IF EXISTS `ip_blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ip_blacklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(32) NOT NULL,
  `type` enum('failed','banned') NOT NULL DEFAULT 'failed' COMMENT '禁用类型',
  `counter` int(10) unsigned NOT NULL DEFAULT '0',
  `expiredTime` int(10) unsigned NOT NULL DEFAULT '0',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_blacklist`
--

LOCK TABLES `ip_blacklist` WRITE;
/*!40000 ALTER TABLE `ip_blacklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `ip_blacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `state` enum('replaced','banned') NOT NULL DEFAULT 'replaced',
  `bannedNum` int(10) unsigned NOT NULL DEFAULT '0',
  `createdTime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword`
--

LOCK TABLES `keyword` WRITE;
/*!40000 ALTER TABLE `keyword` DISABLE KEYS */;
/*!40000 ALTER TABLE `keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword_banlog`
--

DROP TABLE IF EXISTS `keyword_banlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword_banlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keywordId` int(10) unsigned NOT NULL,
  `keywordName` varchar(64) NOT NULL DEFAULT '',
  `state` enum('replaced','banned') NOT NULL DEFAULT 'replaced',
  `text` text NOT NULL,
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(64) NOT NULL DEFAULT '',
  `createdTime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `keywordId` (`keywordId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword_banlog`
--

LOCK TABLES `keyword_banlog` WRITE;
/*!40000 ALTER TABLE `keyword_banlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `keyword_banlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `id` bigint(20) unsigned NOT NULL,
  `parentId` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `pinyin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统日志ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作人ID',
  `module` varchar(32) NOT NULL COMMENT '日志所属模块',
  `action` varchar(32) NOT NULL COMMENT '日志所属操作类型',
  `message` text NOT NULL COMMENT '日志内容',
  `data` text COMMENT '日志数据',
  `ip` varchar(255) NOT NULL COMMENT '日志记录IP',
  `createdTime` int(10) unsigned NOT NULL COMMENT '日志发生时间',
  `level` char(10) NOT NULL COMMENT '日志等级',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,1,'user','change_role','设置用户admin(#1)的角色为：ROLE_USER,ROLE_TEACHER,ROLE_SUPER_ADMIN','','127.0.0.1',1506519316,'info'),(2,1,'tag','create','添加标签默认标签(#1)','','127.0.0.1',1506519316,'info'),(3,1,'category','create','添加分类 默认分类(#1)','{\"id\":\"1\",\"code\":\"default\",\"name\":\"\\u9ed8\\u8ba4\\u5206\\u7c7b\",\"icon\":\"\",\"path\":\"\",\"weight\":\"0\",\"groupId\":\"1\",\"parentId\":\"0\",\"description\":null,\"orgId\":\"1\",\"orgCode\":\"1.\"}','127.0.0.1',1506519316,'info'),(4,1,'category','create','添加分类 默认分类(#2)','{\"id\":\"2\",\"code\":\"classroomdefault\",\"name\":\"\\u9ed8\\u8ba4\\u5206\\u7c7b\",\"icon\":\"\",\"path\":\"\",\"weight\":\"0\",\"groupId\":\"2\",\"parentId\":\"0\",\"description\":null,\"orgId\":\"1\",\"orgCode\":\"1.\"}','127.0.0.1',1506519316,'info'),(5,1,'content','create','创建内容《(关于我们)》(1)','{\"id\":\"1\",\"title\":\"\\u5173\\u4e8e\\u6211\\u4eec\",\"editor\":\"richeditor\",\"type\":\"page\",\"alias\":\"aboutus\",\"summary\":null,\"body\":\"\",\"picture\":\"\",\"template\":\"default\",\"status\":\"published\",\"categoryId\":\"0\",\"tagIds\":null,\"hits\":\"0\",\"featured\":\"0\",\"promoted\":\"1\",\"sticky\":\"0\",\"userId\":\"1\",\"field1\":null,\"field2\":null,\"field3\":null,\"field4\":null,\"field5\":null,\"field6\":null,\"field7\":null,\"field8\":null,\"field9\":null,\"field10\":null,\"publishedTime\":\"1506519316\",\"createdTime\":\"1506519316\"}','127.0.0.1',1506519316,'info'),(6,1,'content','create','创建内容《(常见问题)》(2)','{\"id\":\"2\",\"title\":\"\\u5e38\\u89c1\\u95ee\\u9898\",\"editor\":\"richeditor\",\"type\":\"page\",\"alias\":\"questions\",\"summary\":null,\"body\":\"\",\"picture\":\"\",\"template\":\"default\",\"status\":\"published\",\"categoryId\":\"0\",\"tagIds\":null,\"hits\":\"0\",\"featured\":\"0\",\"promoted\":\"1\",\"sticky\":\"0\",\"userId\":\"1\",\"field1\":null,\"field2\":null,\"field3\":null,\"field4\":null,\"field5\":null,\"field6\":null,\"field7\":null,\"field8\":null,\"field9\":null,\"field10\":null,\"publishedTime\":\"1506519316\",\"createdTime\":\"1506519316\"}','127.0.0.1',1506519316,'info'),(7,1,'info','navigation_create','创建导航师资力量','','127.0.0.1',1506519316,'info'),(8,1,'info','navigation_create','创建导航常见问题','','127.0.0.1',1506519316,'info'),(9,1,'info','navigation_create','创建导航关于我们','','127.0.0.1',1506519316,'info'),(10,1,'blockTemplate','update_block_template','更新编辑区模板#1','','127.0.0.1',1506519316,'info'),(11,1,'blockTemplate','update_block_template','更新编辑区模板#2','','127.0.0.1',1506519316,'info'),(12,1,'blockTemplate','update_block_template','更新编辑区模板#3','','127.0.0.1',1506519316,'info'),(13,1,'blockTemplate','update_block_template','更新编辑区模板#4','','127.0.0.1',1506519316,'info'),(14,1,'blockTemplate','update_block_template','更新编辑区模板#5','','127.0.0.1',1506519316,'info'),(15,1,'blockTemplate','update_block_template','更新编辑区模板#6','','127.0.0.1',1506519316,'info'),(16,1,'blockTemplate','update_block_template','更新编辑区模板#7','','127.0.0.1',1506519316,'info'),(17,1,'blockTemplate','update_block_template','更新编辑区模板#8','','127.0.0.1',1506519316,'info'),(18,1,'blockTemplate','update_block_template','更新编辑区模板#9','','127.0.0.1',1506519316,'info'),(19,1,'role','init_create_role','初始化四个角色\"学员\"','{\"name\":\"\\u5b66\\u5458\",\"code\":\"ROLE_USER\",\"data\":[],\"createdTime\":1506519316,\"createdUserId\":\"1\"}','127.0.0.1',1506519316,'info'),(20,1,'role','init_create_role','初始化四个角色\"教师\"','{\"name\":\"\\u6559\\u5e08\",\"code\":\"ROLE_TEACHER\",\"data\":[\"web\",\"course_manage\",\"course_manage_info\",\"course_manage_base\",\"course_manage_detail\",\"course_manage_picture\",\"course_manage_lesson\",\"live_course_manage_replay\",\"course_manage_files\",\"course_manage_setting\",\"course_manage_price\",\"course_manage_teachers\",\"course_manage_students\",\"course_manage_student_create\",\"course_manage_questions\",\"course_manage_question\",\"course_manage_testpaper\",\"course_manange_operate\",\"course_manage_data\",\"course_manage_order\",\"classroom_manage\",\"classroom_manage_settings\",\"classroom_manage_set_info\",\"classroom_manage_set_price\",\"classroom_manage_set_picture\",\"classroom_manage_service\",\"classroom_manage_headteacher\",\"classroom_manage_teachers\",\"classroom_manage_assistants\",\"classroom_manage_content\",\"classroom_manage_courses\",\"classroom_manage_students\",\"classroom_manage_testpaper\"],\"createdTime\":1506519316,\"createdUserId\":\"1\"}','127.0.0.1',1506519316,'info'),(21,1,'role','init_create_role','初始化四个角色\"管理员\"','{\"name\":\"\\u7ba1\\u7406\\u5458\",\"code\":\"ROLE_ADMIN\",\"data\":[\"admin\",\"admin_user\",\"admin_user_show\",\"admin_user_manage\",\"admin_user_create\",\"admin_user_edit\",\"admin_user_roles\",\"admin_user_send_passwordreset_email\",\"admin_user_send_emailverify_email\",\"admin_user_lock\",\"admin_user_unlock\",\"admin_user_org_update\",\"admin_login_record\",\"admin_teacher\",\"admin_teacher_manage\",\"admin_teacher_promote\",\"admin_teacher_promote_cancel\",\"admin_teacher_promote_list\",\"admin_approval_manage\",\"admin_approval_approvals\",\"admin_approval_cancel\",\"admin_message_manage\",\"admin_message\",\"admin_course\",\"admin_course_show\",\"admin_course_manage\",\"admin_course_content_manage\",\"admin_course_add\",\"admin_course_set_recommend\",\"admin_course_set_cancel_recommend\",\"admin_course_guest_member_preview\",\"admin_course_set_close\",\"admin_course_sms_prepare\",\"admin_course_set_publish\",\"admin_course_set_delete\",\"admin_course_set_recommend_list\",\"admin_course_set_data\",\"admin_classroom\",\"admin_classroom_manage\",\"admin_classroom_content_manage\",\"admin_classroom_create\",\"admin_classroom_cancel_recommend\",\"admin_classroom_set_recommend\",\"admin_classroom_close\",\"admin_sms_prepare\",\"admin_classroom_open\",\"admin_classroom_delete\",\"admin_classroom_recommend\",\"admin_open_course_manage\",\"admin_open_course\",\"admin_open_course_recommend_list\",\"admin_opencourse_analysis\",\"admin_live_course\",\"admin_live_course_manage\",\"admin_course_thread\",\"admin_course_thread_manage\",\"admin_classroom_thread_manage\",\"admin_course_question\",\"admin_course_question_manage\",\"admin_course_note\",\"admin_course_note_manage\",\"admin_course_review\",\"admin_course_review_tab\",\"admin_classroom_review_tab\",\"admin_course_category\",\"admin_course_category_manage\",\"admin_category_create\",\"admin_classroom_category_manage\",\"admin_classroom_category_create\",\"admin_course_tag\",\"admin_course_tag_manage\",\"admin_course_tag_add\",\"admin_course_tag_group_manage\",\"admin_course_tag_group_add\",\"admin_operation\",\"admin_operation_article\",\"admin_operation_article_manage\",\"admin_operation_article_create\",\"admin_operation_article_category\",\"admin_operation_category_create\",\"admin_operation_group\",\"admin_operation_group_manage\",\"admin_operation_group_create\",\"admin_operation_group_thread\",\"admin_operation_invite\",\"admin_operation_invite_manage\",\"admin_operation_invite_coupon\",\"admin_announcement\",\"admin_announcement_manage\",\"admin_announcement_create\",\"admin_operation_notification\",\"admin_batch_notification\",\"admin_batch_notification_create\",\"admin_block_manage\",\"admin_block\",\"admin_block_visual_edit\",\"admin_operation_content\",\"admin_content\",\"admin_operation_mobile\",\"admin_operation_mobile_banner_manage\",\"admin_operation_mobile_select_manage\",\"admin_discovery_column_index\",\"admin_discovery_column_create\",\"admin_operation_analysis_register\",\"admin_operation_analysis\",\"admin_operation_keyword\",\"admin_keyword\",\"admin_keyword_create\",\"admin_keyword_banlogs\",\"admin_order\",\"admin_course_order_manage\",\"admin_course_order\",\"admin_coin_order_manange\",\"admin_coin_orders\",\"admin_classroom_order_manage\",\"admin_classroom_order\",\"admin_finance\",\"admin_bills\",\"admin_bill\",\"admin_coin_records\",\"admin_coin_user\",\"admin_coin_user_records\",\"admin_course_refunds\",\"admin_course_refunds_manage\",\"admin_classroom_refunds\",\"admin_classroom_refunds_manage\",\"admin_app\",\"admin_cloud_edulive_setting\",\"admin_cloud_edulive_overview\",\"admin_setting_cloud_edulive\",\"admin_edu_cloud_email\",\"admin_edu_cloud_email_overview\",\"admin_edu_cloud_email_setting\",\"admin_app_im\",\"admin_app_im_setting\",\"admin_cloud_file_manage\",\"admin_cloud_file\",\"admin_app_center_show\",\"admin_app_center\",\"admin_app_installed\",\"admin_app_upgrades\",\"admin_app_logs\",\"admin_cloud_attachment_manage\",\"admin_cloud_attachment\",\"admin_cloud_consult\",\"admin_cloud_consult_setting\",\"web\",\"course_manage\",\"course_manage_info\",\"course_manage_base\",\"course_manage_detail\",\"course_manage_picture\",\"course_manage_lesson\",\"live_course_manage_replay\",\"course_manage_files\",\"course_manage_setting\",\"course_manage_price\",\"course_manage_teachers\",\"course_manage_students\",\"course_manage_student_create\",\"course_manage_questions\",\"course_manage_question\",\"course_manage_testpaper\",\"course_manange_operate\",\"course_manage_data\",\"course_manage_order\",\"classroom_manage\",\"classroom_manage_settings\",\"classroom_manage_set_info\",\"classroom_manage_set_price\",\"classroom_manage_set_picture\",\"classroom_manage_service\",\"classroom_manage_headteacher\",\"classroom_manage_teachers\",\"classroom_manage_assistants\",\"classroom_manage_content\",\"classroom_manage_courses\",\"classroom_manage_students\",\"classroom_manage_testpaper\"],\"createdTime\":1506519316,\"createdUserId\":\"1\"}','127.0.0.1',1506519316,'info'),(22,1,'role','init_create_role','初始化四个角色\"超级管理员\"','{\"name\":\"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\",\"code\":\"ROLE_SUPER_ADMIN\",\"data\":[\"admin\",\"admin_user\",\"admin_user_show\",\"admin_user_manage\",\"admin_user_create\",\"admin_user_edit\",\"admin_user_roles\",\"admin_user_avatar\",\"admin_user_change_password\",\"admin_user_send_passwordreset_email\",\"admin_user_send_emailverify_email\",\"admin_user_lock\",\"admin_user_unlock\",\"admin_user_org_update\",\"admin_login_record\",\"admin_teacher\",\"admin_teacher_manage\",\"admin_teacher_promote\",\"admin_teacher_promote_cancel\",\"admin_teacher_promote_list\",\"admin_approval_manage\",\"admin_approval_approvals\",\"admin_approval_cancel\",\"admin_message_manage\",\"admin_message\",\"admin_course\",\"admin_course_show\",\"admin_course_manage\",\"admin_course_content_manage\",\"admin_course_add\",\"admin_course_set_recommend\",\"admin_course_set_cancel_recommend\",\"admin_course_guest_member_preview\",\"admin_course_set_close\",\"admin_course_sms_prepare\",\"admin_course_set_publish\",\"admin_course_set_delete\",\"admin_course_set_recommend_list\",\"admin_course_set_data\",\"admin_classroom\",\"admin_classroom_manage\",\"admin_classroom_content_manage\",\"admin_classroom_create\",\"admin_classroom_cancel_recommend\",\"admin_classroom_set_recommend\",\"admin_classroom_close\",\"admin_sms_prepare\",\"admin_classroom_open\",\"admin_classroom_delete\",\"admin_classroom_recommend\",\"admin_open_course_manage\",\"admin_open_course\",\"admin_open_course_recommend_list\",\"admin_opencourse_analysis\",\"admin_live_course\",\"admin_live_course_manage\",\"admin_course_thread\",\"admin_course_thread_manage\",\"admin_classroom_thread_manage\",\"admin_course_question\",\"admin_course_question_manage\",\"admin_course_note\",\"admin_course_note_manage\",\"admin_course_review\",\"admin_course_review_tab\",\"admin_classroom_review_tab\",\"admin_course_category\",\"admin_course_category_manage\",\"admin_category_create\",\"admin_classroom_category_manage\",\"admin_classroom_category_create\",\"admin_course_tag\",\"admin_course_tag_manage\",\"admin_course_tag_add\",\"admin_course_tag_group_manage\",\"admin_course_tag_group_add\",\"admin_operation\",\"admin_operation_article\",\"admin_operation_article_manage\",\"admin_operation_article_create\",\"admin_operation_article_category\",\"admin_operation_category_create\",\"admin_operation_group\",\"admin_operation_group_manage\",\"admin_operation_group_create\",\"admin_operation_group_thread\",\"admin_operation_invite\",\"admin_operation_invite_manage\",\"admin_operation_invite_coupon\",\"admin_announcement\",\"admin_announcement_manage\",\"admin_announcement_create\",\"admin_operation_notification\",\"admin_batch_notification\",\"admin_batch_notification_create\",\"admin_block_manage\",\"admin_block\",\"admin_block_visual_edit\",\"admin_operation_content\",\"admin_content\",\"admin_operation_mobile\",\"admin_operation_mobile_banner_manage\",\"admin_operation_mobile_select_manage\",\"admin_discovery_column_index\",\"admin_discovery_column_create\",\"admin_operation_analysis_register\",\"admin_operation_analysis\",\"admin_operation_keyword\",\"admin_keyword\",\"admin_keyword_create\",\"admin_keyword_banlogs\",\"admin_order\",\"admin_course_order_manage\",\"admin_course_order\",\"admin_coin_order_manange\",\"admin_coin_orders\",\"admin_classroom_order_manage\",\"admin_classroom_order\",\"admin_finance\",\"admin_bills\",\"admin_bill\",\"admin_coin_records\",\"admin_coin_user\",\"admin_coin_user_records\",\"admin_course_refunds\",\"admin_course_refunds_manage\",\"admin_classroom_refunds\",\"admin_classroom_refunds_manage\",\"admin_app\",\"admin_my_cloud\",\"admin_my_cloud_overview\",\"admin_cloud_video_setting\",\"admin_cloud_video_overview\",\"admin_cloud_setting_video\",\"admin_cloud_edulive_setting\",\"admin_cloud_edulive_overview\",\"admin_setting_cloud_edulive\",\"admin_edu_cloud_sms\",\"admin_edu_cloud_sms_overview\",\"admin_edu_cloud_setting_sms\",\"admin_edu_cloud_email\",\"admin_edu_cloud_email_overview\",\"admin_edu_cloud_email_setting\",\"admin_edu_cloud_search_setting\",\"admin_edu_cloud_search_overview\",\"admin_edu_cloud_setting_search\",\"admin_app_im\",\"admin_app_im_setting\",\"admin_cloud_file_manage\",\"admin_cloud_file\",\"admin_setting_cloud_attachment\",\"admin_edu_cloud_attachment\",\"admin_app_center_show\",\"admin_app_center\",\"admin_app_installed\",\"admin_app_upgrades\",\"admin_app_logs\",\"admin_cloud_attachment_manage\",\"admin_cloud_attachment\",\"admin_cloud_consult\",\"admin_cloud_consult_setting\",\"admin_setting_cloud\",\"admin_setting_my_cloud\",\"admin_system\",\"admin_setting\",\"admin_setting_message\",\"admin_setting_theme\",\"admin_setting_mailer\",\"admin_top_navigation\",\"admin_foot_navigation\",\"admin_friendlyLink_navigation\",\"admin_setting_consult_setting\",\"admin_setting_es_bar\",\"admin_setting_share\",\"admin_setting_security\",\"admin_setting_user\",\"admin_user_auth\",\"admin_setting_login_bind\",\"admin_setting_user_center\",\"admin_setting_user_fields\",\"admin_setting_avatar\",\"admin_roles\",\"admin_role_manage\",\"admin_role_create\",\"admin_role_edit\",\"admin_role_delete\",\"admin_setting_course_setting\",\"admin_setting_course\",\"admin_setting_questions_setting\",\"admin_setting_course_avatar\",\"admin_classroom_setting\",\"admin_setting_operation\",\"admin_article_setting\",\"admin_group_set\",\"admin_invite_set\",\"admin_wap_set\",\"admin_setting_finance\",\"admin_payment\",\"admin_coin_settings\",\"admin_setting_refund\",\"admin_setting_mobile\",\"admin_setting_mobile_settings\",\"admin_setting_mobile_iap_product\",\"admin_setting_mobile_iap_product_list\",\"admin_optimize\",\"admin_optimize_settings\",\"admin_jobs\",\"admin_jobs_manage\",\"admin_setting_ip_blacklist\",\"admin_setting_ip_blacklist_manage\",\"admin_setting_post_num_rules\",\"admin_setting_post_num_rules_settings\",\"admin_report_status\",\"admin_report_status_list\",\"admin_logs\",\"admin_logs_query\",\"admin_logs_prod\",\"admin_org_manage\",\"admin_org\",\"web\",\"course_manage\",\"course_manage_info\",\"course_manage_base\",\"course_manage_detail\",\"course_manage_picture\",\"course_manage_lesson\",\"live_course_manage_replay\",\"course_manage_files\",\"course_manage_setting\",\"course_manage_price\",\"course_manage_teachers\",\"course_manage_students\",\"course_manage_student_create\",\"course_manage_questions\",\"course_manage_question\",\"course_manage_testpaper\",\"course_manange_operate\",\"course_manage_data\",\"course_manage_order\",\"classroom_manage\",\"classroom_manage_settings\",\"classroom_manage_set_info\",\"classroom_manage_set_price\",\"classroom_manage_set_picture\",\"classroom_manage_service\",\"classroom_manage_headteacher\",\"classroom_manage_teachers\",\"classroom_manage_assistants\",\"classroom_manage_content\",\"classroom_manage_courses\",\"classroom_manage_students\",\"classroom_manage_testpaper\"],\"createdTime\":1506519316,\"createdUserId\":\"1\"}','127.0.0.1',1506519316,'info'),(23,2,'crontab','job_start','定时任务(#1)开始执行！','{\"id\":\"1\",\"name\":\"CancelOrderJob\",\"cycle\":\"everyhour\",\"cycleTime\":\"0\",\"jobClass\":\"Biz\\\\Order\\\\Job\\\\CancelOrderJob\",\"jobParams\":[],\"targetType\":\"\",\"targetId\":\"0\",\"executing\":\"0\",\"nextExcutedTime\":\"1506519316\",\"latestExecutedTime\":\"0\",\"creatorId\":\"1\",\"createdTime\":\"1506519316\",\"enabled\":\"1\"}','172.17.0.1',1506519338,'info'),(24,2,'crontab','job_end','定时任务(#1)执行结束！','{\"id\":\"1\",\"name\":\"CancelOrderJob\",\"cycle\":\"everyhour\",\"cycleTime\":\"0\",\"jobClass\":\"Biz\\\\Order\\\\Job\\\\CancelOrderJob\",\"jobParams\":[],\"targetType\":\"\",\"targetId\":\"0\",\"executing\":\"0\",\"nextExcutedTime\":\"1506519316\",\"latestExecutedTime\":\"0\",\"creatorId\":\"1\",\"createdTime\":\"1506519316\",\"enabled\":\"1\"}','172.17.0.1',1506519338,'info'),(25,2,'crontab','job_start','定时任务(#2)开始执行！','{\"id\":\"2\",\"name\":\"DeleteExpiredTokenJob\",\"cycle\":\"everyhour\",\"cycleTime\":\"0\",\"jobClass\":\"Biz\\\\User\\\\Job\\\\DeleteExpiredTokenJob\",\"jobParams\":[],\"targetType\":\"\",\"targetId\":\"0\",\"executing\":\"0\",\"nextExcutedTime\":\"1506519316\",\"latestExecutedTime\":\"0\",\"creatorId\":\"1\",\"createdTime\":\"1506519316\",\"enabled\":\"1\"}','172.17.0.1',1506519341,'info'),(26,2,'crontab','job_end','定时任务(#2)执行结束！','{\"id\":\"2\",\"name\":\"DeleteExpiredTokenJob\",\"cycle\":\"everyhour\",\"cycleTime\":\"0\",\"jobClass\":\"Biz\\\\User\\\\Job\\\\DeleteExpiredTokenJob\",\"jobParams\":[],\"targetType\":\"\",\"targetId\":\"0\",\"executing\":\"0\",\"nextExcutedTime\":\"1506519316\",\"latestExecutedTime\":\"0\",\"creatorId\":\"1\",\"createdTime\":\"1506519316\",\"enabled\":\"1\"}','172.17.0.1',1506519341,'info'),(27,1,'user','login_success','登录成功','','172.17.0.1',1506519346,'info'),(28,1,'user','change_role','设置用户teacher(#3)的角色为：ROLE_TEACHER,ROLE_USER','','172.17.0.1',1506519440,'info'),(29,1,'user','add','管理员添加新用户 teacher (3)','','172.17.0.1',1506519440,'info'),(30,1,'cloud_data','push','school.user.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506519476,'error'),(31,1,'open_course','create_course','创建公开课《飞猪公开课》(#1)','','172.17.0.1',1506519591,'info'),(32,1,'course','update_teacher','更新教学计划#1的教师','[{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"1\",\"role\":\"teacher\",\"seq\":0,\"isVisible\":1,\"createdTime\":1506519674}]','172.17.0.1',1506519674,'info'),(33,1,'course','create','创建课程《飞猪普通课程》(#1)','','172.17.0.1',1506519680,'info'),(34,1,'cloud_data','push','school.course.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506519943,'error'),(35,1,'course','publish','发布课程《飞猪普通课程》(#1)','','172.17.0.1',1506519943,'info'),(36,1,'cloud_data','push','school.course.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506519958,'error'),(37,1,'course','publish','发布课程《飞猪普通课程》(#1)','','172.17.0.1',1506519958,'info'),(38,1,'course','update_teacher','更新教学计划#1的教师','[{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"1\",\"role\":\"teacher\",\"seq\":0,\"isVisible\":1,\"createdTime\":1506519958},{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"3\",\"role\":\"teacher\",\"seq\":1,\"isVisible\":1,\"createdTime\":1506519958}]','172.17.0.1',1506519958,'info'),(39,1,'open_course','create_course','创建公开课《飞猪公开课》(#2)','','172.17.0.1',1506519963,'info'),(40,1,'course','update_teacher','更新教学计划#1的教师','[{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"1\",\"role\":\"teacher\",\"seq\":0,\"isVisible\":1,\"createdTime\":1506519964},{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"3\",\"role\":\"teacher\",\"seq\":1,\"isVisible\":1,\"createdTime\":1506519964}]','172.17.0.1',1506519964,'info'),(41,1,'course','update_teacher','更新教学计划#1的教师','[{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"1\",\"role\":\"teacher\",\"seq\":0,\"isVisible\":1,\"createdTime\":1506519969},{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"3\",\"role\":\"teacher\",\"seq\":1,\"isVisible\":1,\"createdTime\":1506519969}]','172.17.0.1',1506519969,'info'),(42,1,'course','update_teacher','更新教学计划#1的教师','[{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"1\",\"role\":\"teacher\",\"seq\":0,\"isVisible\":1,\"createdTime\":1506519975},{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"3\",\"role\":\"teacher\",\"seq\":1,\"isVisible\":1,\"createdTime\":1506519975}]','172.17.0.1',1506519975,'info'),(43,1,'course','update_teacher','更新教学计划#1的教师','[{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"1\",\"role\":\"teacher\",\"seq\":0,\"isVisible\":1,\"createdTime\":1506519980},{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"3\",\"role\":\"teacher\",\"seq\":1,\"isVisible\":1,\"createdTime\":1506519980}]','172.17.0.1',1506519980,'info'),(44,1,'course','update_teacher','更新教学计划#1的教师','[{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"1\",\"role\":\"teacher\",\"seq\":0,\"isVisible\":1,\"createdTime\":1506520295},{\"courseId\":\"1\",\"courseSetId\":\"1\",\"userId\":\"3\",\"role\":\"teacher\",\"seq\":1,\"isVisible\":1,\"createdTime\":1506520295}]','172.17.0.1',1506520295,'info'),(45,1,'open_course','update_teacher','更新课程#2的教师','[{\"courseId\":\"2\",\"userId\":\"1\",\"role\":\"teacher\",\"seq\":0,\"isVisible\":1,\"createdTime\":1506520623},{\"courseId\":\"2\",\"userId\":\"3\",\"role\":\"teacher\",\"seq\":1,\"isVisible\":1,\"createdTime\":1506520623}]','172.17.0.1',1506520623,'info'),(46,1,'open_course','update_course','更新公开课《飞猪公开课》(#2)的信息','{\"teacherIds\":[\"1\",\"3\"]}','172.17.0.1',1506520623,'info'),(47,1,'upload_file','create','新增文件(#1)','{\"id\":\"1\",\"globalId\":\"0\",\"hashId\":\"opencourselesson\\/2\\/2017927100537-dgxbf9.mp4\",\"targetId\":\"2\",\"targetType\":\"opencourselesson\",\"useType\":null,\"filename\":\"a.mp4\",\"ext\":\"mp4\",\"fileSize\":\"464255\",\"etag\":\"\",\"length\":\"0\",\"description\":null,\"status\":\"ok\",\"convertHash\":\"ch-opencourselesson\\/2\\/2017927100537-dgxbf9.mp4\",\"convertStatus\":\"none\",\"convertParams\":[],\"metas\":null,\"metas2\":[],\"type\":\"video\",\"storage\":\"local\",\"isPublic\":\"0\",\"canDownload\":\"0\",\"usedCount\":\"0\",\"updatedUserId\":\"1\",\"updatedTime\":\"1506521137\",\"createdUserId\":\"1\",\"createdTime\":\"1506521137\"}','172.17.0.1',1506521138,'info'),(48,1,'open_course','add_lesson','添加公开课时《飞猪公开课》(1)','{\"id\":\"1\",\"courseId\":\"2\",\"chapterId\":\"0\",\"number\":\"1\",\"seq\":\"1\",\"free\":\"0\",\"status\":\"unpublished\",\"title\":\"\\u98de\\u732a\\u516c\\u5f00\\u8bfe\",\"summary\":null,\"tags\":null,\"type\":\"video\",\"content\":\"\",\"giveCredit\":\"0\",\"requireCredit\":\"0\",\"mediaId\":\"1\",\"mediaSource\":\"self\",\"mediaName\":\"a.mp4\",\"mediaUri\":\"\",\"homeworkId\":\"0\",\"exerciseId\":\"0\",\"length\":\"61\",\"materialNum\":\"0\",\"quizNum\":\"0\",\"learnedNum\":\"0\",\"viewedNum\":\"0\",\"startTime\":\"0\",\"endTime\":\"0\",\"memberNum\":\"0\",\"replayStatus\":\"ungenerated\",\"maxOnlineNum\":\"0\",\"liveProvider\":\"0\",\"userId\":\"1\",\"createdTime\":\"1506521142\",\"updatedTime\":\"0\",\"copyId\":\"0\",\"testMode\":\"normal\",\"testStartTime\":\"0\"}','172.17.0.1',1506521142,'info'),(49,1,'open_course','update_course','更新公开课《飞猪公开课》(#2)的信息','{\"lessonNum\":1}','172.17.0.1',1506521142,'info'),(50,1,'open_course','update_course','更新公开课《飞猪公开课》(#2)的信息','{\"status\":\"published\"}','172.17.0.1',1506521148,'info'),(51,1,'open_course','pulish_course','发布公开课《飞猪公开课》(#2)','','172.17.0.1',1506521148,'info'),(52,2,'crontab','job_start','定时任务(#1)开始执行！','{\"id\":\"1\",\"name\":\"CancelOrderJob\",\"cycle\":\"everyhour\",\"cycleTime\":\"0\",\"jobClass\":\"Biz\\\\Order\\\\Job\\\\CancelOrderJob\",\"jobParams\":[],\"targetType\":\"\",\"targetId\":\"0\",\"executing\":\"0\",\"nextExcutedTime\":\"1506522938\",\"latestExecutedTime\":\"1506519338\",\"creatorId\":\"1\",\"createdTime\":\"1506519316\",\"enabled\":\"1\"}','172.17.0.1',1506564209,'info'),(53,2,'crontab','job_end','定时任务(#1)执行结束！','{\"id\":\"1\",\"name\":\"CancelOrderJob\",\"cycle\":\"everyhour\",\"cycleTime\":\"0\",\"jobClass\":\"Biz\\\\Order\\\\Job\\\\CancelOrderJob\",\"jobParams\":[],\"targetType\":\"\",\"targetId\":\"0\",\"executing\":\"0\",\"nextExcutedTime\":\"1506522938\",\"latestExecutedTime\":\"1506519338\",\"creatorId\":\"1\",\"createdTime\":\"1506519316\",\"enabled\":\"1\"}','172.17.0.1',1506564209,'info'),(54,2,'crontab','job_start','定时任务(#2)开始执行！','{\"id\":\"2\",\"name\":\"DeleteExpiredTokenJob\",\"cycle\":\"everyhour\",\"cycleTime\":\"0\",\"jobClass\":\"Biz\\\\User\\\\Job\\\\DeleteExpiredTokenJob\",\"jobParams\":[],\"targetType\":\"\",\"targetId\":\"0\",\"executing\":\"0\",\"nextExcutedTime\":\"1506522941\",\"latestExecutedTime\":\"1506519341\",\"creatorId\":\"1\",\"createdTime\":\"1506519316\",\"enabled\":\"1\"}','172.17.0.1',1506564289,'info'),(55,2,'crontab','job_end','定时任务(#2)执行结束！','{\"id\":\"2\",\"name\":\"DeleteExpiredTokenJob\",\"cycle\":\"everyhour\",\"cycleTime\":\"0\",\"jobClass\":\"Biz\\\\User\\\\Job\\\\DeleteExpiredTokenJob\",\"jobParams\":[],\"targetType\":\"\",\"targetId\":\"0\",\"executing\":\"0\",\"nextExcutedTime\":\"1506522941\",\"latestExecutedTime\":\"1506519341\",\"creatorId\":\"1\",\"createdTime\":\"1506519316\",\"enabled\":\"1\"}','172.17.0.1',1506564289,'info'),(56,1,'classroom','create','创建班级《飞猪提高班》(#1)','','172.17.0.1',1506564550,'info'),(57,1,'classroom','update','更新班级《飞猪提高班》(#1)','','172.17.0.1',1506564566,'info'),(58,1,'classroom','update','更新班级《飞猪提高班》(#1)','','172.17.0.1',1506564573,'info'),(59,3,'user','login_success','登录成功','','172.17.0.1',1506564732,'info'),(60,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506564773,'error'),(61,4,'user','login_success','登录成功','','172.17.0.1',1506564773,'info'),(62,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565129,'error'),(63,5,'user','login_success','登录成功','','172.17.0.1',1506565129,'info'),(64,5,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565169,'error'),(65,5,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565209,'error'),(66,3,'user','login_success','登录成功','','172.17.0.1',1506565210,'info'),(67,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565648,'error'),(68,6,'user','login_success','登录成功','','172.17.0.1',1506565648,'info'),(70,6,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565688,'error'),(71,6,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565728,'error'),(72,3,'user','login_success','登录成功','','172.17.0.1',1506565728,'info'),(73,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565827,'error'),(74,1,'upload_file','create','新增文件(#4)','{\"id\":\"4\",\"globalId\":\"0\",\"hashId\":\"opencourselesson\\/1\\/2017928103050-6sjfg9.mp4\",\"targetId\":\"1\",\"targetType\":\"opencourselesson\",\"useType\":null,\"filename\":\"a.mp4\",\"ext\":\"mp4\",\"fileSize\":\"464255\",\"etag\":\"\",\"length\":\"0\",\"description\":null,\"status\":\"ok\",\"convertHash\":\"ch-opencourselesson\\/1\\/2017928103050-6sjfg9.mp4\",\"convertStatus\":\"none\",\"convertParams\":[],\"metas\":null,\"metas2\":[],\"type\":\"video\",\"storage\":\"local\",\"isPublic\":\"0\",\"canDownload\":\"0\",\"usedCount\":\"0\",\"updatedUserId\":\"1\",\"updatedTime\":\"1506565850\",\"createdUserId\":\"1\",\"createdTime\":\"1506565850\"}','172.17.0.1',1506565850,'info'),(75,1,'open_course','add_lesson','添加公开课时《飞猪公开课》(2)','{\"id\":\"2\",\"courseId\":\"1\",\"chapterId\":\"0\",\"number\":\"1\",\"seq\":\"1\",\"free\":\"0\",\"status\":\"unpublished\",\"title\":\"\\u98de\\u732a\\u516c\\u5f00\\u8bfe\",\"summary\":null,\"tags\":null,\"type\":\"video\",\"content\":\"\",\"giveCredit\":\"0\",\"requireCredit\":\"0\",\"mediaId\":\"4\",\"mediaSource\":\"self\",\"mediaName\":\"a.mp4\",\"mediaUri\":\"\",\"homeworkId\":\"0\",\"exerciseId\":\"0\",\"length\":\"61\",\"materialNum\":\"0\",\"quizNum\":\"0\",\"learnedNum\":\"0\",\"viewedNum\":\"0\",\"startTime\":\"0\",\"endTime\":\"0\",\"memberNum\":\"0\",\"replayStatus\":\"ungenerated\",\"maxOnlineNum\":\"0\",\"liveProvider\":\"0\",\"userId\":\"1\",\"createdTime\":\"1506565856\",\"updatedTime\":\"0\",\"copyId\":\"0\",\"testMode\":\"normal\",\"testStartTime\":\"0\"}','172.17.0.1',1506565856,'info'),(76,1,'open_course','update_course','更新公开课《飞猪公开课》(#1)的信息','{\"lessonNum\":1}','172.17.0.1',1506565856,'info'),(77,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565867,'error'),(78,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506565910,'error'),(79,9,'user','login_success','登录成功','','172.17.0.1',1506565911,'info'),(80,3,'user','login_success','登录成功','','172.17.0.1',1506565911,'info'),(81,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566115,'error'),(82,10,'user','login_success','登录成功','','172.17.0.1',1506566115,'info'),(83,10,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566155,'error'),(84,10,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566195,'error'),(85,3,'user','login_success','登录成功','','172.17.0.1',1506566195,'info'),(86,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566318,'error'),(87,11,'user','login_success','登录成功','','172.17.0.1',1506566318,'info'),(88,1,'user','login_success','登录成功','','172.17.0.1',1506566358,'info'),(89,11,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566358,'error'),(90,11,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566399,'error'),(91,3,'user','login_success','登录成功','','172.17.0.1',1506566399,'info'),(92,11,'user','login_success','登录成功','','172.17.0.1',1506566399,'info'),(93,11,'open_course','update_course','更新公开课《飞猪公开课》(#2)的信息','{\"studentNum\":3}','172.17.0.1',1506566399,'info'),(94,3,'user','login_success','登录成功','','172.17.0.1',1506566400,'info'),(95,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566506,'error'),(96,12,'user','login_success','登录成功','','172.17.0.1',1506566507,'info'),(97,12,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566547,'error'),(98,12,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506566572,'error'),(99,3,'user','login_success','登录成功','','172.17.0.1',1506566573,'info'),(100,12,'user','login_success','登录成功','','172.17.0.1',1506566573,'info'),(101,12,'open_course','update_course','更新公开课《飞猪公开课》(#2)的信息','{\"studentNum\":4}','172.17.0.1',1506566573,'info'),(102,3,'user','login_success','登录成功','','172.17.0.1',1506566573,'info'),(103,12,'user','login_success','登录成功','','172.17.0.1',1506566574,'info'),(104,3,'user','login_success','登录成功','','172.17.0.1',1506566575,'info'),(105,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567183,'error'),(106,13,'user','login_success','登录成功','','172.17.0.1',1506567183,'info'),(107,13,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567223,'error'),(108,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567252,'error'),(109,14,'user','login_success','登录成功','','172.17.0.1',1506567252,'info'),(110,13,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567263,'error'),(111,14,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567303,'error'),(112,14,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567343,'error'),(113,3,'user','login_success','登录成功','','172.17.0.1',1506567343,'info'),(114,14,'user','login_success','登录成功','','172.17.0.1',1506567344,'info'),(115,14,'open_course','update_course','更新公开课《飞猪公开课》(#2)的信息','{\"studentNum\":5}','172.17.0.1',1506567344,'info'),(116,3,'user','login_success','登录成功','','172.17.0.1',1506567344,'info'),(117,14,'user','login_success','登录成功','','172.17.0.1',1506567345,'info'),(118,14,'cloud_data','push','school.classroom.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567385,'error'),(119,3,'user','login_success','登录成功','','172.17.0.1',1506567385,'info'),(120,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567457,'error'),(121,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567510,'error'),(122,16,'user','login_success','登录成功','','172.17.0.1',1506567510,'info'),(123,16,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567550,'error'),(124,16,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567590,'error'),(125,3,'user','login_success','登录成功','','172.17.0.1',1506567591,'info'),(126,16,'user','login_success','登录成功','','172.17.0.1',1506567591,'info'),(127,16,'open_course','update_course','更新公开课《飞猪公开课》(#2)的信息','{\"studentNum\":6}','172.17.0.1',1506567591,'info'),(128,3,'user','login_success','登录成功','','172.17.0.1',1506567591,'info'),(129,16,'user','login_success','登录成功','','172.17.0.1',1506567592,'info'),(130,16,'cloud_data','push','school.classroom.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567632,'error'),(131,3,'user','login_success','登录成功','','172.17.0.1',1506567632,'info'),(132,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567784,'error'),(133,17,'user','login_success','登录成功','','172.17.0.1',1506567784,'info'),(134,17,'cloud_data','push','school.course.update 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567824,'error'),(135,17,'cloud_data','push','school.course.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567865,'error'),(136,3,'user','login_success','登录成功','','172.17.0.1',1506567865,'info'),(137,17,'user','login_success','登录成功','','172.17.0.1',1506567865,'info'),(138,17,'open_course','update_course','更新公开课《飞猪公开课》(#2)的信息','{\"studentNum\":7}','172.17.0.1',1506567865,'info'),(139,3,'user','login_success','登录成功','','172.17.0.1',1506567866,'info'),(140,17,'user','login_success','登录成功','','172.17.0.1',1506567866,'info'),(141,17,'cloud_data','push','school.classroom.join 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506567906,'error'),(142,3,'user','login_success','登录成功','','172.17.0.1',1506567907,'info'),(143,3,'user','login_success','登录成功','','172.17.0.1',1506567976,'info'),(144,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506568007,'error'),(145,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506568047,'error'),(146,19,'user','login_success','登录成功','','172.17.0.1',1506568047,'info'),(147,3,'user','login_success','登录成功','','172.17.0.1',1506568255,'info'),(148,0,'cloud_data','push','school.user.create 事件发送失败','{\"message\":\"Connect api server timeout (url: http:\\/\\/event.edusoho.net\\/events).\"}','172.17.0.1',1506568295,'error');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marker`
--

DROP TABLE IF EXISTS `marker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marker` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `second` int(10) unsigned NOT NULL COMMENT '驻点时间',
  `mediaId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '媒体文件ID',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='驻点';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marker`
--

LOCK TABLES `marker` WRITE;
/*!40000 ALTER TABLE `marker` DISABLE KEYS */;
/*!40000 ALTER TABLE `marker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '私信Id',
  `type` enum('text','image','video','audio') NOT NULL DEFAULT 'text' COMMENT '私信类型',
  `fromId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发信人Id',
  `toId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收信人Id',
  `content` text NOT NULL COMMENT '私信内容',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '私信发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'text',1,3,'您好teacher，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506519434),(2,'text',1,4,'您好FPEoQWL，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506564732),(3,'text',1,5,'您好FPxfKpg，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506565089),(4,'text',1,6,'您好FPYNPiX，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506565608),(5,'text',1,7,'您好FPfzxBI，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506565787),(6,'text',1,8,'您好FPkunfy，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506565803),(7,'text',1,9,'您好FPRouFD，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506565870),(8,'text',1,10,'您好FPyGKZs，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506566075),(9,'text',1,11,'您好FPuCryc，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506566278),(10,'text',1,12,'您好FPompux，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506566466),(11,'text',1,13,'您好FPuTMbO，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506567143),(12,'text',1,14,'您好FPPiJkw，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506567212),(13,'text',1,15,'您好FPzymNa，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506567417),(14,'text',1,16,'您好FPSlwOy，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506567470),(15,'text',1,17,'您好FPqqBrl，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506567744),(16,'text',1,18,'您好FPmTasA，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506567967),(17,'text',1,19,'您好FPzpxiI，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506567977),(18,'text',1,20,'您好FPiwdoI，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。',1506568255);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_conversation`
--

DROP TABLE IF EXISTS `message_conversation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_conversation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '会话Id',
  `fromId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发信人Id',
  `toId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收信人Id',
  `messageNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '此对话的信息条数',
  `latestMessageUserId` int(10) unsigned DEFAULT NULL COMMENT '最后发信人ID',
  `latestMessageTime` int(10) unsigned NOT NULL COMMENT '最后发信时间',
  `latestMessageContent` text NOT NULL COMMENT '最后发信内容',
  `latestMessageType` enum('text','image','video','audio') NOT NULL DEFAULT 'text' COMMENT '最后一条私信类型',
  `unreadNum` int(10) unsigned NOT NULL COMMENT '未读数量',
  `createdTime` int(10) unsigned NOT NULL COMMENT '会话创建时间',
  PRIMARY KEY (`id`),
  KEY `toId_fromId` (`toId`,`fromId`),
  KEY `toId_latestMessageTime` (`toId`,`latestMessageTime`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_conversation`
--

LOCK TABLES `message_conversation` WRITE;
/*!40000 ALTER TABLE `message_conversation` DISABLE KEYS */;
INSERT INTO `message_conversation` VALUES (2,1,3,1,1,1506519434,'您好teacher，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506519434),(4,1,4,1,1,1506564732,'您好FPEoQWL，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506564732),(6,1,5,1,1,1506565089,'您好FPxfKpg，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506565089),(8,1,6,1,1,1506565608,'您好FPYNPiX，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506565608),(10,1,7,1,1,1506565787,'您好FPfzxBI，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506565787),(12,1,8,1,1,1506565803,'您好FPkunfy，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506565803),(14,1,9,1,1,1506565870,'您好FPRouFD，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506565870),(16,1,10,1,1,1506566075,'您好FPyGKZs，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506566075),(18,1,11,1,1,1506566278,'您好FPuCryc，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506566278),(20,1,12,1,1,1506566466,'您好FPompux，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506566466),(22,1,13,1,1,1506567143,'您好FPuTMbO，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506567143),(24,1,14,1,1,1506567212,'您好FPPiJkw，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506567212),(26,1,15,1,1,1506567417,'您好FPzymNa，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506567417),(28,1,16,1,1,1506567470,'您好FPSlwOy，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506567470),(30,1,17,1,1,1506567744,'您好FPqqBrl，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506567744),(32,1,18,1,1,1506567967,'您好FPmTasA，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506567967),(34,1,19,1,1,1506567977,'您好FPzpxiI，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506567977),(36,1,20,1,1,1506568255,'您好FPiwdoI，我是QWBXX的管理员，欢迎加入QWBXX，祝您学习愉快。如有问题，随时与我联系。','text',1,1506568255);
/*!40000 ALTER TABLE `message_conversation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_relation`
--

DROP TABLE IF EXISTS `message_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_relation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '消息关联ID',
  `conversationId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联的会话ID',
  `messageId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联的消息ID',
  `isRead` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否已读',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_relation`
--

LOCK TABLES `message_relation` WRITE;
/*!40000 ALTER TABLE `message_relation` DISABLE KEYS */;
INSERT INTO `message_relation` VALUES (2,2,1,'0'),(4,4,2,'0'),(6,6,3,'0'),(8,8,4,'0'),(10,10,5,'0'),(12,12,6,'0'),(14,14,7,'0'),(16,16,8,'0'),(18,18,9,'0'),(20,20,10,'0'),(22,22,11,'0'),(24,24,12,'0'),(26,26,13,'0'),(28,28,14,'0'),(30,30,15,'0'),(32,32,16,'0'),(34,34,17,'0'),(36,36,18,'0');
/*!40000 ALTER TABLE `message_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobile_device`
--

DROP TABLE IF EXISTS `mobile_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobile_device` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '设备ID',
  `imei` varchar(255) NOT NULL COMMENT '串号',
  `platform` varchar(255) NOT NULL COMMENT '平台',
  `version` varchar(255) NOT NULL COMMENT '版本',
  `screenresolution` varchar(100) NOT NULL COMMENT '分辨率',
  `kernel` varchar(255) NOT NULL COMMENT '内核',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobile_device`
--

LOCK TABLES `mobile_device` WRITE;
/*!40000 ALTER TABLE `mobile_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `mobile_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navigation`
--

DROP TABLE IF EXISTS `navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `navigation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航ID',
  `name` varchar(255) NOT NULL COMMENT '导航名称',
  `url` varchar(300) NOT NULL COMMENT '链接地址',
  `sequence` tinyint(4) unsigned NOT NULL COMMENT '显示顺序',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父导航ID',
  `createdTime` int(11) NOT NULL COMMENT '创建时间',
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `type` varchar(30) NOT NULL COMMENT '类型',
  `isOpen` tinyint(2) NOT NULL DEFAULT '1' COMMENT '默认1，为开启',
  `isNewWin` tinyint(2) NOT NULL DEFAULT '1' COMMENT '默认为1,另开窗口',
  `orgId` int(10) unsigned DEFAULT '1',
  `orgCode` varchar(255) DEFAULT '1.' COMMENT '组织机构内部编码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='导航数据表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navigation`
--

LOCK TABLES `navigation` WRITE;
/*!40000 ALTER TABLE `navigation` DISABLE KEYS */;
INSERT INTO `navigation` VALUES (1,'师资力量','teacher',1,0,1506519316,1506519316,'top',1,0,1,'1.'),(2,'常见问题','page/questions',2,0,1506519316,1506519316,'top',1,0,1,'1.'),(3,'关于我们','page/aboutus',3,0,1506519316,1506519316,'top',1,0,1,'1.');
/*!40000 ALTER TABLE `navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '通知ID',
  `userId` int(10) unsigned NOT NULL COMMENT '被通知的用户ID',
  `type` varchar(64) NOT NULL DEFAULT 'default' COMMENT '通知类型',
  `content` text COMMENT '通知内容',
  `batchId` int(10) NOT NULL DEFAULT '0' COMMENT '群发通知表中的ID',
  `createdTime` int(10) unsigned NOT NULL COMMENT '通知时间',
  `isRead` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `open_course`
--

DROP TABLE IF EXISTS `open_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程ID',
  `title` varchar(1024) NOT NULL COMMENT '课程标题',
  `subtitle` varchar(1024) NOT NULL DEFAULT '' COMMENT '课程副标题',
  `status` enum('draft','published','closed') NOT NULL DEFAULT 'draft' COMMENT '课程状态',
  `type` varchar(255) NOT NULL DEFAULT 'normal' COMMENT '课程类型',
  `lessonNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时数',
  `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `tags` text COMMENT '标签IDs',
  `smallPicture` varchar(255) NOT NULL DEFAULT '' COMMENT '小图',
  `middlePicture` varchar(255) NOT NULL DEFAULT '' COMMENT '中图',
  `largePicture` varchar(255) NOT NULL DEFAULT '' COMMENT '大图',
  `about` text COMMENT '简介',
  `teacherIds` text COMMENT '显示的课程教师IDs',
  `studentNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学员数',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  `likeNum` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `postNum` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `userId` int(10) unsigned NOT NULL COMMENT '课程发布人ID',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程的父Id',
  `locked` int(10) NOT NULL DEFAULT '0' COMMENT '是否上锁1上锁,0解锁',
  `recommended` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为推荐课程',
  `recommendedSeq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐序号',
  `recommendedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐时间',
  `createdTime` int(10) unsigned NOT NULL COMMENT '课程创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  KEY `updatedTime` (`updatedTime`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `open_course`
--

LOCK TABLES `open_course` WRITE;
/*!40000 ALTER TABLE `open_course` DISABLE KEYS */;
INSERT INTO `open_course` VALUES (1,'飞猪公开课','','draft','open',1,0,NULL,'','','','','|1|',0,0,0,0,1,0,0,0,0,0,1506519591,0),(2,'飞猪公开课','','published','open',1,0,NULL,'','','','','|1|3|',7,5,0,0,1,0,0,0,0,0,1506519963,0);
/*!40000 ALTER TABLE `open_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `open_course_lesson`
--

DROP TABLE IF EXISTS `open_course_lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_course_lesson` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课时ID',
  `courseId` int(10) unsigned NOT NULL COMMENT '课时所属课程ID',
  `chapterId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时所属章节ID',
  `number` int(10) unsigned NOT NULL COMMENT '课时编号',
  `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时在课程中的序号',
  `free` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为免费课时',
  `status` enum('unpublished','published') NOT NULL DEFAULT 'published' COMMENT '课时状态',
  `title` varchar(255) NOT NULL COMMENT '课时标题',
  `summary` text COMMENT '课时摘要',
  `tags` text COMMENT '课时标签',
  `type` varchar(64) NOT NULL DEFAULT 'text' COMMENT '课时类型',
  `content` text COMMENT '课时正文',
  `giveCredit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学完课时获得的学分',
  `requireCredit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学习课时前，需达到的学分',
  `mediaId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '媒体文件ID',
  `mediaSource` varchar(32) NOT NULL DEFAULT '' COMMENT '媒体文件来源(self:本站上传,youku:优酷)',
  `mediaName` varchar(255) NOT NULL DEFAULT '' COMMENT '媒体文件名称',
  `mediaUri` text COMMENT '媒体文件资源名',
  `homeworkId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '作业iD',
  `exerciseId` int(10) unsigned DEFAULT '0' COMMENT '练习ID',
  `length` int(11) unsigned DEFAULT NULL COMMENT '时长',
  `materialNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传的资料数量',
  `quizNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '测验题目数量',
  `learnedNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已学的学员数',
  `viewedNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看数',
  `startTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '直播课时开始时间',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '直播课时结束时间',
  `memberNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '直播课时加入人数',
  `replayStatus` enum('ungenerated','generating','generated','videoGenerated') NOT NULL DEFAULT 'ungenerated',
  `maxOnlineNum` int(11) DEFAULT '0' COMMENT '直播在线人数峰值',
  `liveProvider` int(10) unsigned NOT NULL DEFAULT '0',
  `userId` int(10) unsigned NOT NULL COMMENT '发布人ID',
  `createdTime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制课时id',
  `testMode` enum('normal','realTime') DEFAULT 'normal' COMMENT '考试模式',
  `testStartTime` int(10) DEFAULT '0' COMMENT '实时考试开始时间',
  PRIMARY KEY (`id`),
  KEY `updatedTime` (`updatedTime`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `open_course_lesson`
--

LOCK TABLES `open_course_lesson` WRITE;
/*!40000 ALTER TABLE `open_course_lesson` DISABLE KEYS */;
INSERT INTO `open_course_lesson` VALUES (1,2,0,1,1,0,'published','飞猪公开课',NULL,NULL,'video','',0,0,1,'self','a.mp4','',0,0,61,0,0,0,0,0,0,0,'ungenerated',0,0,1,1506521142,0,0,'normal',0),(2,1,0,1,1,0,'published','飞猪公开课',NULL,NULL,'video','',0,0,4,'self','a.mp4','',0,0,61,0,0,0,0,0,0,0,'ungenerated',0,0,1,1506565856,0,0,'normal',0);
/*!40000 ALTER TABLE `open_course_lesson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `open_course_member`
--

DROP TABLE IF EXISTS `open_course_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_course_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程学员记录ID',
  `courseId` int(10) unsigned NOT NULL COMMENT '课程ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学员ID',
  `mobile` varchar(32) NOT NULL DEFAULT '' COMMENT '手机号码',
  `learnedNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已学课时数',
  `learnTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学习时间',
  `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序序号',
  `isVisible` tinyint(2) NOT NULL DEFAULT '1' COMMENT '可见与否，默认为可见',
  `role` enum('student','teacher') NOT NULL DEFAULT 'student' COMMENT '课程会员角色',
  `ip` varchar(64) DEFAULT NULL COMMENT 'IP地址',
  `lastEnterTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上次进入时间',
  `isNotified` int(10) NOT NULL DEFAULT '0' COMMENT '直播开始通知',
  `createdTime` int(10) unsigned NOT NULL COMMENT '学员加入课程时间',
  PRIMARY KEY (`id`),
  KEY `open_course_member_ip_courseId_index` (`ip`,`courseId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `open_course_member`
--

LOCK TABLES `open_course_member` WRITE;
/*!40000 ALTER TABLE `open_course_member` DISABLE KEYS */;
INSERT INTO `open_course_member` VALUES (1,1,1,'',0,0,0,1,'teacher',NULL,0,0,1506519591),(3,2,1,'',0,0,0,1,'teacher',NULL,0,0,1506520623),(4,2,3,'',0,0,1,1,'teacher',NULL,0,0,1506520623),(5,2,11,'',0,0,0,1,'student','172.17.0.1',1506566399,0,1506566399),(6,2,12,'',0,0,0,1,'student','172.17.0.1',1506566573,0,1506566573),(7,2,14,'',0,0,0,1,'student','172.17.0.1',1506567344,0,1506567344),(8,2,16,'',0,0,0,1,'student','172.17.0.1',1506567591,0,1506567591),(9,2,17,'',0,0,0,1,'student','172.17.0.1',1506567865,0,1506567865);
/*!40000 ALTER TABLE `open_course_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `open_course_recommend`
--

DROP TABLE IF EXISTS `open_course_recommend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_course_recommend` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openCourseId` int(10) NOT NULL COMMENT '公开课id',
  `recommendCourseId` int(10) NOT NULL DEFAULT '0' COMMENT '推荐课程id',
  `seq` int(10) NOT NULL DEFAULT '0' COMMENT '序列',
  `type` varchar(255) NOT NULL COMMENT '类型',
  `createdTime` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `open_course_recommend_openCourseId_index` (`openCourseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公开课推荐课程表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `open_course_recommend`
--

LOCK TABLES `open_course_recommend` WRITE;
/*!40000 ALTER TABLE `open_course_recommend` DISABLE KEYS */;
/*!40000 ALTER TABLE `open_course_recommend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_log`
--

DROP TABLE IF EXISTS `order_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单日志ID',
  `orderId` int(10) unsigned NOT NULL COMMENT '订单ID',
  `type` varchar(32) NOT NULL COMMENT '订单日志类型',
  `message` text COMMENT '订单日志内容',
  `data` text COMMENT '订单日志数据',
  `userId` int(10) unsigned NOT NULL COMMENT '订单操作人',
  `ip` varchar(255) NOT NULL COMMENT '订单操作IP',
  `createdTime` int(10) unsigned NOT NULL COMMENT '订单日志记录时间',
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_log`
--

LOCK TABLES `order_log` WRITE;
/*!40000 ALTER TABLE `order_log` DISABLE KEYS */;
INSERT INTO `order_log` VALUES (1,1,'created','创建订单','[]',5,'172.17.0.1',1506565129),(2,1,'pay_success','付款成功','{\"sn\":\"C2017092810184972300\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506565129}',5,'172.17.0.1',1506565129),(3,2,'created','创建订单','[]',6,'172.17.0.1',1506565648),(4,2,'pay_success','付款成功','{\"sn\":\"C2017092810272850160\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506565648}',6,'172.17.0.1',1506565648),(5,3,'created','创建订单','[]',10,'172.17.0.1',1506566115),(6,3,'pay_success','付款成功','{\"sn\":\"C2017092810351558733\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506566115}',10,'172.17.0.1',1506566115),(7,4,'created','创建订单','[]',11,'172.17.0.1',1506566318),(8,4,'pay_success','付款成功','{\"sn\":\"C2017092810383845192\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506566318}',11,'172.17.0.1',1506566318),(9,5,'created','创建订单','[]',12,'172.17.0.1',1506566507),(10,5,'pay_success','付款成功','{\"sn\":\"C2017092810414755308\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506566507}',12,'172.17.0.1',1506566507),(11,6,'created','创建订单','[]',12,'172.17.0.1',1506566574),(12,6,'pay_success','付款成功','{\"sn\":\"CR2017092810425476348\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506566574}',12,'172.17.0.1',1506566574),(13,7,'created','创建订单','[]',13,'172.17.0.1',1506567183),(14,7,'pay_success','付款成功','{\"sn\":\"C2017092810530337699\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506567183}',13,'172.17.0.1',1506567183),(15,8,'created','创建订单','[]',14,'172.17.0.1',1506567252),(16,8,'pay_success','付款成功','{\"sn\":\"C2017092810541212169\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506567252}',14,'172.17.0.1',1506567252),(17,9,'created','创建订单','[]',14,'172.17.0.1',1506567345),(18,9,'pay_success','付款成功','{\"sn\":\"CR2017092810554518222\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506567345}',14,'172.17.0.1',1506567345),(19,10,'created','创建订单','[]',16,'172.17.0.1',1506567510),(20,10,'pay_success','付款成功','{\"sn\":\"C2017092810583069979\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506567510}',16,'172.17.0.1',1506567510),(21,11,'created','创建订单','[]',16,'172.17.0.1',1506567592),(22,11,'pay_success','付款成功','{\"sn\":\"CR2017092810595236836\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506567592}',16,'172.17.0.1',1506567592),(23,12,'created','创建订单','[]',17,'172.17.0.1',1506567784),(24,12,'pay_success','付款成功','{\"sn\":\"C2017092811030484157\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506567784}',17,'172.17.0.1',1506567784),(25,13,'created','创建订单','[]',17,'172.17.0.1',1506567866),(26,13,'pay_success','付款成功','{\"sn\":\"CR2017092811042667461\",\"status\":\"success\",\"amount\":\"0.00\",\"paidTime\":1506567866}',17,'172.17.0.1',1506567866);
/*!40000 ALTER TABLE `order_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_referer`
--

DROP TABLE IF EXISTS `order_referer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_referer` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uv` varchar(64) NOT NULL,
  `data` text NOT NULL,
  `orderIds` text,
  `expiredTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间',
  PRIMARY KEY (`id`),
  KEY `order_referer_uv_expiredTime_index` (`uv`,`expiredTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户访问日志Token';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_referer`
--

LOCK TABLES `order_referer` WRITE;
/*!40000 ALTER TABLE `order_referer` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_referer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_referer_log`
--

DROP TABLE IF EXISTS `order_referer_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_referer_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `refererLogId` int(11) NOT NULL COMMENT '促成订单的访问日志ID',
  `orderId` int(10) unsigned DEFAULT '0' COMMENT '订单ID',
  `sourceTargetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '来源ID',
  `sourceTargetType` varchar(64) NOT NULL DEFAULT '' COMMENT '来源类型',
  `targetType` varchar(64) NOT NULL DEFAULT '' COMMENT '订单的对象类型',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单的对象ID',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单支付时间',
  `createdUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单支付者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单促成日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_referer_log`
--

LOCK TABLES `order_referer_log` WRITE;
/*!40000 ALTER TABLE `order_referer_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_referer_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_refund`
--

DROP TABLE IF EXISTS `order_refund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_refund` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单退款记录ID',
  `orderId` int(10) unsigned NOT NULL COMMENT '退款订单ID',
  `userId` int(10) unsigned NOT NULL COMMENT '退款人ID',
  `targetType` varchar(64) NOT NULL DEFAULT '' COMMENT '订单退款记录所属对象类型',
  `targetId` int(10) unsigned NOT NULL COMMENT '订单退款记录所属对象ID',
  `status` enum('created','success','failed','cancelled') NOT NULL DEFAULT 'created' COMMENT '退款状态',
  `expectedAmount` float(10,2) unsigned DEFAULT '0.00' COMMENT '期望退款的金额，NULL代表未知，0代表不需要退款',
  `actualAmount` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '实际退款金额，0代表无退款',
  `reasonType` varchar(64) NOT NULL DEFAULT '' COMMENT '退款理由类型',
  `reasonNote` varchar(1024) NOT NULL DEFAULT '' COMMENT '退款理由',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单退款记录最后更新时间',
  `createdTime` int(10) unsigned NOT NULL COMMENT '订单退款记录创建时间',
  `operator` int(11) unsigned NOT NULL COMMENT '操作人',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_refund`
--

LOCK TABLES `order_refund` WRITE;
/*!40000 ALTER TABLE `order_refund` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_refund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `sn` varchar(32) NOT NULL COMMENT '订单编号',
  `status` enum('created','paid','refunding','refunded','cancelled') NOT NULL COMMENT '订单状态',
  `title` varchar(255) NOT NULL COMMENT '订单标题',
  `targetType` varchar(64) NOT NULL DEFAULT '' COMMENT '订单所属对象类型',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单所属对象ID',
  `amount` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单实付金额',
  `totalPrice` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总价',
  `isGift` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为赠送礼物',
  `giftTo` varchar(64) NOT NULL DEFAULT '' COMMENT '赠送给用户ID',
  `discountId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '折扣活动ID',
  `discount` float(10,2) NOT NULL DEFAULT '10.00' COMMENT '折扣',
  `refundId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次退款操作记录的ID',
  `userId` int(10) unsigned NOT NULL COMMENT '订单创建人',
  `coupon` varchar(255) NOT NULL DEFAULT '' COMMENT '优惠码',
  `couponDiscount` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠码扣减金额',
  `payment` varchar(32) NOT NULL DEFAULT 'none' COMMENT '订单支付方式',
  `coinAmount` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '虚拟币支付额',
  `coinRate` float(10,2) NOT NULL DEFAULT '1.00' COMMENT '虚拟币汇率',
  `priceType` enum('RMB','Coin') NOT NULL DEFAULT 'RMB' COMMENT '创建订单时的标价类型',
  `bank` varchar(32) NOT NULL DEFAULT '' COMMENT '银行编号',
  `paidTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付时间',
  `cashSn` bigint(20) DEFAULT NULL COMMENT '支付流水号',
  `note` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `data` text COMMENT '订单业务数据',
  `createdTime` int(10) unsigned NOT NULL COMMENT '订单创建时间',
  `updatedTime` int(10) NOT NULL,
  `token` varchar(50) DEFAULT NULL COMMENT '令牌',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sn` (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'C2017092810184972300','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,5,'',0.00,'none',0.00,1.00,'RMB','',1506565129,NULL,'',NULL,1506565129,1506565129,'C2017092810184972300rpvJn'),(2,'C2017092810272850160','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,6,'',0.00,'none',0.00,1.00,'RMB','',1506565648,NULL,'',NULL,1506565648,1506565648,'C2017092810272850160dVRZQ'),(3,'C2017092810351558733','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,10,'',0.00,'none',0.00,1.00,'RMB','',1506566115,NULL,'',NULL,1506566115,1506566115,'C2017092810351558733ccrZW'),(4,'C2017092810383845192','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,11,'',0.00,'none',0.00,1.00,'RMB','',1506566318,NULL,'',NULL,1506566318,1506566318,'C20170928103838451926ZWQH'),(5,'C2017092810414755308','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,12,'',0.00,'none',0.00,1.00,'RMB','',1506566507,NULL,'',NULL,1506566507,1506566507,'C2017092810414755308Y8VnW'),(6,'CR2017092810425476348','paid','购买班级《飞猪提高班》','classroom',1,0.00,0.00,0,'',0,10.00,0,12,'',0.00,'none',0.00,1.00,'RMB','',1506566574,NULL,'',NULL,1506566574,1506566574,'CR2017092810425476348i3hyw'),(7,'C2017092810530337699','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,13,'',0.00,'none',0.00,1.00,'RMB','',1506567183,NULL,'',NULL,1506567183,1506567183,'C2017092810530337699istql'),(8,'C2017092810541212169','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,14,'',0.00,'none',0.00,1.00,'RMB','',1506567252,NULL,'',NULL,1506567252,1506567252,'C2017092810541212169FJ1xN'),(9,'CR2017092810554518222','paid','购买班级《飞猪提高班》','classroom',1,0.00,0.00,0,'',0,10.00,0,14,'',0.00,'none',0.00,1.00,'RMB','',1506567345,NULL,'',NULL,1506567345,1506567345,'CR2017092810554518222FSajV'),(10,'C2017092810583069979','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,16,'',0.00,'none',0.00,1.00,'RMB','',1506567510,NULL,'',NULL,1506567510,1506567510,'C2017092810583069979lkbnM'),(11,'CR2017092810595236836','paid','购买班级《飞猪提高班》','classroom',1,0.00,0.00,0,'',0,10.00,0,16,'',0.00,'none',0.00,1.00,'RMB','',1506567592,NULL,'',NULL,1506567592,1506567592,'CR2017092810595236836pr5Pm'),(12,'C2017092811030484157','paid','购买课程《飞猪普通课程》- 默认教学计划','course',1,0.00,0.00,0,'',0,10.00,0,17,'',0.00,'none',0.00,1.00,'RMB','',1506567784,NULL,'',NULL,1506567784,1506567784,'C2017092811030484157r5D52'),(13,'CR2017092811042667461','paid','购买班级《飞猪提高班》','classroom',1,0.00,0.00,0,'',0,10.00,0,17,'',0.00,'none',0.00,1.00,'RMB','',1506567866,NULL,'',NULL,1506567866,1506567866,'CR2017092811042667461JDuB6');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org`
--

DROP TABLE IF EXISTS `org`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '组织机构ID',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `parentId` int(11) NOT NULL DEFAULT '0' COMMENT '组织机构父ID',
  `childrenNum` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '辖下组织机构数量',
  `depth` int(11) NOT NULL DEFAULT '1' COMMENT '当前组织机构层级',
  `seq` int(11) NOT NULL DEFAULT '0' COMMENT '索引',
  `description` text COMMENT '备注',
  `code` varchar(255) NOT NULL DEFAULT '' COMMENT '机构编码',
  `orgCode` varchar(255) NOT NULL DEFAULT '0' COMMENT '内部编码',
  `createdUserId` int(11) NOT NULL COMMENT '创建用户ID',
  `createdTime` int(11) unsigned NOT NULL COMMENT '创建时间',
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `orgCode` (`orgCode`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='组织机构';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org`
--

LOCK TABLES `org` WRITE;
/*!40000 ALTER TABLE `org` DISABLE KEYS */;
INSERT INTO `org` VALUES (1,'全站',0,0,1,0,NULL,'FullSite','1.',1,1506519316,1506519316);
/*!40000 ALTER TABLE `org` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '题目ID',
  `type` varchar(64) NOT NULL DEFAULT '' COMMENT '题目类型',
  `stem` text COMMENT '题干',
  `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '分数',
  `answer` text COMMENT '参考答案',
  `analysis` text COMMENT '解析',
  `metas` text COMMENT '题目元信息',
  `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类别',
  `difficulty` varchar(64) NOT NULL DEFAULT 'normal' COMMENT '难度',
  `target` varchar(255) NOT NULL DEFAULT '' COMMENT '从属于',
  `courseSetId` int(10) NOT NULL DEFAULT '0',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0',
  `lessonId` int(10) unsigned NOT NULL DEFAULT '0',
  `parentId` int(10) unsigned DEFAULT '0' COMMENT '材料父ID',
  `subCount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '子题数量',
  `finishedTimes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '完成次数',
  `passedTimes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '成功次数',
  `createdUserId` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedUserId` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制问题对应Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_category`
--

DROP TABLE IF EXISTS `question_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '题目类别ID',
  `name` varchar(255) NOT NULL COMMENT '类别名称',
  `target` varchar(255) NOT NULL DEFAULT '' COMMENT '从属于',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作用户',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序序号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='题库类别表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_category`
--

LOCK TABLES `question_category` WRITE;
/*!40000 ALTER TABLE `question_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_favorite`
--

DROP TABLE IF EXISTS `question_favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_favorite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '题目收藏ID',
  `questionId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被收藏的题目ID',
  `targetType` varchar(50) NOT NULL DEFAULT '',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0',
  `target` varchar(255) NOT NULL DEFAULT '' COMMENT '题目所属对象',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏人ID',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_favorite`
--

LOCK TABLES `question_favorite` WRITE;
/*!40000 ALTER TABLE `question_favorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_marker`
--

DROP TABLE IF EXISTS `question_marker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_marker` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `markerId` int(10) unsigned NOT NULL COMMENT '驻点Id',
  `questionId` int(10) unsigned NOT NULL COMMENT '问题Id',
  `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `type` varchar(64) NOT NULL DEFAULT '' COMMENT '题目类型',
  `stem` text COMMENT '题干',
  `answer` text COMMENT '参考答案',
  `analysis` text COMMENT '解析',
  `metas` text COMMENT '题目元信息',
  `difficulty` varchar(64) NOT NULL DEFAULT 'normal' COMMENT '难度',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='弹题';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_marker`
--

LOCK TABLES `question_marker` WRITE;
/*!40000 ALTER TABLE `question_marker` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_marker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_marker_result`
--

DROP TABLE IF EXISTS `question_marker_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_marker_result` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `markerId` int(10) unsigned NOT NULL COMMENT '驻点Id',
  `questionMarkerId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '弹题ID',
  `taskId` int(10) unsigned NOT NULL DEFAULT '0',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '做题人ID',
  `status` enum('none','right','partRight','wrong','noAnswer') NOT NULL DEFAULT 'none' COMMENT '结果状态',
  `answer` text,
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_qmid_taskid_stats` (`questionMarkerId`,`taskId`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_marker_result`
--

LOCK TABLES `question_marker_result` WRITE;
/*!40000 ALTER TABLE `question_marker_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_marker_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratelimit`
--

DROP TABLE IF EXISTS `ratelimit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratelimit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `_key` varchar(64) NOT NULL,
  `data` varchar(32) NOT NULL,
  `deadline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `_key` (`_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratelimit`
--

LOCK TABLES `ratelimit` WRITE;
/*!40000 ALTER TABLE `ratelimit` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratelimit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recent_post_num`
--

DROP TABLE IF EXISTS `recent_post_num`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recent_post_num` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `ip` varchar(20) NOT NULL COMMENT 'IP',
  `type` varchar(255) NOT NULL COMMENT '类型',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'post次数',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次更新时间',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='黑名单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recent_post_num`
--

LOCK TABLES `recent_post_num` WRITE;
/*!40000 ALTER TABLE `recent_post_num` DISABLE KEYS */;
/*!40000 ALTER TABLE `recent_post_num` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referer_log`
--

DROP TABLE IF EXISTS `referer_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referer_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `targetId` varchar(64) DEFAULT NULL COMMENT '模块ID',
  `targetType` varchar(64) NOT NULL COMMENT '模块类型',
  `targetInnerType` varchar(64) DEFAULT NULL COMMENT '模块自身的类型',
  `refererUrl` varchar(1024) DEFAULT '' COMMENT '访问来源Url',
  `refererHost` varchar(1024) DEFAULT '' COMMENT '访问来源Url',
  `refererName` varchar(64) DEFAULT '' COMMENT '访问来源站点名称',
  `orderCount` int(10) unsigned DEFAULT '0' COMMENT '促成订单数',
  `ip` varchar(64) DEFAULT NULL COMMENT '访问者IP',
  `userAgent` text COMMENT '浏览器的标识',
  `uri` varchar(1024) DEFAULT '' COMMENT '访问Url',
  `createdUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访问者',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访问时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块(课程|班级|公开课|...)的访问来源日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referer_log`
--

LOCK TABLES `referer_log` WRITE;
/*!40000 ALTER TABLE `referer_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `referer_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reward_point_account`
--

DROP TABLE IF EXISTS `reward_point_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reward_point_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL COMMENT '用户Id',
  `balance` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分余额',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分账户';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reward_point_account`
--

LOCK TABLES `reward_point_account` WRITE;
/*!40000 ALTER TABLE `reward_point_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_point_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reward_point_account_flow`
--

DROP TABLE IF EXISTS `reward_point_account_flow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reward_point_account_flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL COMMENT '用户ID',
  `sn` bigint(20) unsigned NOT NULL COMMENT '账目流水号',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT 'inflow, outflow',
  `way` varchar(255) NOT NULL DEFAULT '' COMMENT '积分获取方式',
  `amount` int(10) NOT NULL DEFAULT '0' COMMENT '金额(积分)',
  `name` varchar(1024) NOT NULL DEFAULT '' COMMENT '帐目名称',
  `operator` int(10) unsigned NOT NULL COMMENT '操作员ID',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '流水所属对象ID',
  `targetType` varchar(64) NOT NULL DEFAULT '' COMMENT '流水所属对象类型',
  `note` varchar(255) NOT NULL DEFAULT '',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分帐目流水';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reward_point_account_flow`
--

LOCK TABLES `reward_point_account_flow` WRITE;
/*!40000 ALTER TABLE `reward_point_account_flow` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_point_account_flow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reward_point_product`
--

DROP TABLE IF EXISTS `reward_point_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reward_point_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '商品名称',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '兑换价格（积分）',
  `about` text COMMENT '简介',
  `requireConsignee` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '需要收货人',
  `requireTelephone` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '需要联系电话',
  `requireEmail` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '需要邮箱',
  `requireAddress` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '需要地址',
  `status` varchar(32) DEFAULT 'draft' COMMENT '商品状态  draft|published',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reward_point_product`
--

LOCK TABLES `reward_point_product` WRITE;
/*!40000 ALTER TABLE `reward_point_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_point_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reward_point_product_order`
--

DROP TABLE IF EXISTS `reward_point_product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reward_point_product_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sn` varchar(60) NOT NULL DEFAULT '' COMMENT '订单号',
  `productId` int(10) unsigned NOT NULL COMMENT '商品Id',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '订单名称',
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '兑换价格（积分）',
  `userId` int(10) unsigned NOT NULL COMMENT '用户Id',
  `consignee` varchar(128) NOT NULL DEFAULT '' COMMENT '收货人',
  `telephone` varchar(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '需要地址',
  `sendTime` int(10) unsigned NOT NULL DEFAULT '0',
  `message` varchar(100) NOT NULL DEFAULT '' COMMENT '发货留言',
  `status` varchar(32) DEFAULT 'created' COMMENT '发货状态  created|sending|finished',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reward_point_product_order`
--

LOCK TABLES `reward_point_product_order` WRITE;
/*!40000 ALTER TABLE `reward_point_product_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_point_product_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '权限名称',
  `code` varchar(32) NOT NULL COMMENT '权限代码',
  `data` text COMMENT '权限配置',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `createdUserId` int(10) unsigned NOT NULL COMMENT '创建用户ID',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'学员','ROLE_USER','',1506519316,1,0),(2,'教师','ROLE_TEACHER','[\"web\",\"course_manage\",\"course_manage_info\",\"course_manage_base\",\"course_manage_detail\",\"course_manage_picture\",\"course_manage_lesson\",\"live_course_manage_replay\",\"course_manage_files\",\"course_manage_setting\",\"course_manage_price\",\"course_manage_teachers\",\"course_manage_students\",\"course_manage_student_create\",\"course_manage_questions\",\"course_manage_question\",\"course_manage_testpaper\",\"course_manange_operate\",\"course_manage_data\",\"course_manage_order\",\"classroom_manage\",\"classroom_manage_settings\",\"classroom_manage_set_info\",\"classroom_manage_set_price\",\"classroom_manage_set_picture\",\"classroom_manage_service\",\"classroom_manage_headteacher\",\"classroom_manage_teachers\",\"classroom_manage_assistants\",\"classroom_manage_content\",\"classroom_manage_courses\",\"classroom_manage_students\",\"classroom_manage_testpaper\"]',1506519316,1,0),(3,'管理员','ROLE_ADMIN','[\"admin\",\"admin_user\",\"admin_user_show\",\"admin_user_manage\",\"admin_user_create\",\"admin_user_edit\",\"admin_user_roles\",\"admin_user_send_passwordreset_email\",\"admin_user_send_emailverify_email\",\"admin_user_lock\",\"admin_user_unlock\",\"admin_user_org_update\",\"admin_login_record\",\"admin_teacher\",\"admin_teacher_manage\",\"admin_teacher_promote\",\"admin_teacher_promote_cancel\",\"admin_teacher_promote_list\",\"admin_approval_manage\",\"admin_approval_approvals\",\"admin_approval_cancel\",\"admin_message_manage\",\"admin_message\",\"admin_course\",\"admin_course_show\",\"admin_course_manage\",\"admin_course_content_manage\",\"admin_course_add\",\"admin_course_set_recommend\",\"admin_course_set_cancel_recommend\",\"admin_course_guest_member_preview\",\"admin_course_set_close\",\"admin_course_sms_prepare\",\"admin_course_set_publish\",\"admin_course_set_delete\",\"admin_course_set_recommend_list\",\"admin_course_set_data\",\"admin_classroom\",\"admin_classroom_manage\",\"admin_classroom_content_manage\",\"admin_classroom_create\",\"admin_classroom_cancel_recommend\",\"admin_classroom_set_recommend\",\"admin_classroom_close\",\"admin_sms_prepare\",\"admin_classroom_open\",\"admin_classroom_delete\",\"admin_classroom_recommend\",\"admin_open_course_manage\",\"admin_open_course\",\"admin_open_course_recommend_list\",\"admin_opencourse_analysis\",\"admin_live_course\",\"admin_live_course_manage\",\"admin_course_thread\",\"admin_course_thread_manage\",\"admin_classroom_thread_manage\",\"admin_course_question\",\"admin_course_question_manage\",\"admin_course_note\",\"admin_course_note_manage\",\"admin_course_review\",\"admin_course_review_tab\",\"admin_classroom_review_tab\",\"admin_course_category\",\"admin_course_category_manage\",\"admin_category_create\",\"admin_classroom_category_manage\",\"admin_classroom_category_create\",\"admin_course_tag\",\"admin_course_tag_manage\",\"admin_course_tag_add\",\"admin_course_tag_group_manage\",\"admin_course_tag_group_add\",\"admin_operation\",\"admin_operation_article\",\"admin_operation_article_manage\",\"admin_operation_article_create\",\"admin_operation_article_category\",\"admin_operation_category_create\",\"admin_operation_group\",\"admin_operation_group_manage\",\"admin_operation_group_create\",\"admin_operation_group_thread\",\"admin_operation_invite\",\"admin_operation_invite_manage\",\"admin_operation_invite_coupon\",\"admin_announcement\",\"admin_announcement_manage\",\"admin_announcement_create\",\"admin_operation_notification\",\"admin_batch_notification\",\"admin_batch_notification_create\",\"admin_block_manage\",\"admin_block\",\"admin_block_visual_edit\",\"admin_operation_content\",\"admin_content\",\"admin_operation_mobile\",\"admin_operation_mobile_banner_manage\",\"admin_operation_mobile_select_manage\",\"admin_discovery_column_index\",\"admin_discovery_column_create\",\"admin_operation_analysis_register\",\"admin_operation_analysis\",\"admin_operation_keyword\",\"admin_keyword\",\"admin_keyword_create\",\"admin_keyword_banlogs\",\"admin_order\",\"admin_course_order_manage\",\"admin_course_order\",\"admin_coin_order_manange\",\"admin_coin_orders\",\"admin_classroom_order_manage\",\"admin_classroom_order\",\"admin_finance\",\"admin_bills\",\"admin_bill\",\"admin_coin_records\",\"admin_coin_user\",\"admin_coin_user_records\",\"admin_course_refunds\",\"admin_course_refunds_manage\",\"admin_classroom_refunds\",\"admin_classroom_refunds_manage\",\"admin_app\",\"admin_cloud_edulive_setting\",\"admin_cloud_edulive_overview\",\"admin_setting_cloud_edulive\",\"admin_edu_cloud_email\",\"admin_edu_cloud_email_overview\",\"admin_edu_cloud_email_setting\",\"admin_app_im\",\"admin_app_im_setting\",\"admin_cloud_file_manage\",\"admin_cloud_file\",\"admin_app_center_show\",\"admin_app_center\",\"admin_app_installed\",\"admin_app_upgrades\",\"admin_app_logs\",\"admin_cloud_attachment_manage\",\"admin_cloud_attachment\",\"admin_cloud_consult\",\"admin_cloud_consult_setting\",\"web\",\"course_manage\",\"course_manage_info\",\"course_manage_base\",\"course_manage_detail\",\"course_manage_picture\",\"course_manage_lesson\",\"live_course_manage_replay\",\"course_manage_files\",\"course_manage_setting\",\"course_manage_price\",\"course_manage_teachers\",\"course_manage_students\",\"course_manage_student_create\",\"course_manage_questions\",\"course_manage_question\",\"course_manage_testpaper\",\"course_manange_operate\",\"course_manage_data\",\"course_manage_order\",\"classroom_manage\",\"classroom_manage_settings\",\"classroom_manage_set_info\",\"classroom_manage_set_price\",\"classroom_manage_set_picture\",\"classroom_manage_service\",\"classroom_manage_headteacher\",\"classroom_manage_teachers\",\"classroom_manage_assistants\",\"classroom_manage_content\",\"classroom_manage_courses\",\"classroom_manage_students\",\"classroom_manage_testpaper\"]',1506519316,1,0),(4,'超级管理员','ROLE_SUPER_ADMIN','[\"admin\",\"admin_user\",\"admin_user_show\",\"admin_user_manage\",\"admin_user_create\",\"admin_user_edit\",\"admin_user_roles\",\"admin_user_avatar\",\"admin_user_change_password\",\"admin_user_send_passwordreset_email\",\"admin_user_send_emailverify_email\",\"admin_user_lock\",\"admin_user_unlock\",\"admin_user_org_update\",\"admin_login_record\",\"admin_teacher\",\"admin_teacher_manage\",\"admin_teacher_promote\",\"admin_teacher_promote_cancel\",\"admin_teacher_promote_list\",\"admin_approval_manage\",\"admin_approval_approvals\",\"admin_approval_cancel\",\"admin_message_manage\",\"admin_message\",\"admin_course\",\"admin_course_show\",\"admin_course_manage\",\"admin_course_content_manage\",\"admin_course_add\",\"admin_course_set_recommend\",\"admin_course_set_cancel_recommend\",\"admin_course_guest_member_preview\",\"admin_course_set_close\",\"admin_course_sms_prepare\",\"admin_course_set_publish\",\"admin_course_set_delete\",\"admin_course_set_recommend_list\",\"admin_course_set_data\",\"admin_classroom\",\"admin_classroom_manage\",\"admin_classroom_content_manage\",\"admin_classroom_create\",\"admin_classroom_cancel_recommend\",\"admin_classroom_set_recommend\",\"admin_classroom_close\",\"admin_sms_prepare\",\"admin_classroom_open\",\"admin_classroom_delete\",\"admin_classroom_recommend\",\"admin_open_course_manage\",\"admin_open_course\",\"admin_open_course_recommend_list\",\"admin_opencourse_analysis\",\"admin_live_course\",\"admin_live_course_manage\",\"admin_course_thread\",\"admin_course_thread_manage\",\"admin_classroom_thread_manage\",\"admin_course_question\",\"admin_course_question_manage\",\"admin_course_note\",\"admin_course_note_manage\",\"admin_course_review\",\"admin_course_review_tab\",\"admin_classroom_review_tab\",\"admin_course_category\",\"admin_course_category_manage\",\"admin_category_create\",\"admin_classroom_category_manage\",\"admin_classroom_category_create\",\"admin_course_tag\",\"admin_course_tag_manage\",\"admin_course_tag_add\",\"admin_course_tag_group_manage\",\"admin_course_tag_group_add\",\"admin_operation\",\"admin_operation_article\",\"admin_operation_article_manage\",\"admin_operation_article_create\",\"admin_operation_article_category\",\"admin_operation_category_create\",\"admin_operation_group\",\"admin_operation_group_manage\",\"admin_operation_group_create\",\"admin_operation_group_thread\",\"admin_operation_invite\",\"admin_operation_invite_manage\",\"admin_operation_invite_coupon\",\"admin_announcement\",\"admin_announcement_manage\",\"admin_announcement_create\",\"admin_operation_notification\",\"admin_batch_notification\",\"admin_batch_notification_create\",\"admin_block_manage\",\"admin_block\",\"admin_block_visual_edit\",\"admin_operation_content\",\"admin_content\",\"admin_operation_mobile\",\"admin_operation_mobile_banner_manage\",\"admin_operation_mobile_select_manage\",\"admin_discovery_column_index\",\"admin_discovery_column_create\",\"admin_operation_analysis_register\",\"admin_operation_analysis\",\"admin_operation_keyword\",\"admin_keyword\",\"admin_keyword_create\",\"admin_keyword_banlogs\",\"admin_order\",\"admin_course_order_manage\",\"admin_course_order\",\"admin_coin_order_manange\",\"admin_coin_orders\",\"admin_classroom_order_manage\",\"admin_classroom_order\",\"admin_finance\",\"admin_bills\",\"admin_bill\",\"admin_coin_records\",\"admin_coin_user\",\"admin_coin_user_records\",\"admin_course_refunds\",\"admin_course_refunds_manage\",\"admin_classroom_refunds\",\"admin_classroom_refunds_manage\",\"admin_app\",\"admin_my_cloud\",\"admin_my_cloud_overview\",\"admin_cloud_video_setting\",\"admin_cloud_video_overview\",\"admin_cloud_setting_video\",\"admin_cloud_edulive_setting\",\"admin_cloud_edulive_overview\",\"admin_setting_cloud_edulive\",\"admin_edu_cloud_sms\",\"admin_edu_cloud_sms_overview\",\"admin_edu_cloud_setting_sms\",\"admin_edu_cloud_email\",\"admin_edu_cloud_email_overview\",\"admin_edu_cloud_email_setting\",\"admin_edu_cloud_search_setting\",\"admin_edu_cloud_search_overview\",\"admin_edu_cloud_setting_search\",\"admin_app_im\",\"admin_app_im_setting\",\"admin_cloud_file_manage\",\"admin_cloud_file\",\"admin_setting_cloud_attachment\",\"admin_edu_cloud_attachment\",\"admin_app_center_show\",\"admin_app_center\",\"admin_app_installed\",\"admin_app_upgrades\",\"admin_app_logs\",\"admin_cloud_attachment_manage\",\"admin_cloud_attachment\",\"admin_cloud_consult\",\"admin_cloud_consult_setting\",\"admin_setting_cloud\",\"admin_setting_my_cloud\",\"admin_system\",\"admin_setting\",\"admin_setting_message\",\"admin_setting_theme\",\"admin_setting_mailer\",\"admin_top_navigation\",\"admin_foot_navigation\",\"admin_friendlyLink_navigation\",\"admin_setting_consult_setting\",\"admin_setting_es_bar\",\"admin_setting_share\",\"admin_setting_security\",\"admin_setting_user\",\"admin_user_auth\",\"admin_setting_login_bind\",\"admin_setting_user_center\",\"admin_setting_user_fields\",\"admin_setting_avatar\",\"admin_roles\",\"admin_role_manage\",\"admin_role_create\",\"admin_role_edit\",\"admin_role_delete\",\"admin_setting_course_setting\",\"admin_setting_course\",\"admin_setting_questions_setting\",\"admin_setting_course_avatar\",\"admin_classroom_setting\",\"admin_setting_operation\",\"admin_article_setting\",\"admin_group_set\",\"admin_invite_set\",\"admin_wap_set\",\"admin_setting_finance\",\"admin_payment\",\"admin_coin_settings\",\"admin_setting_refund\",\"admin_setting_mobile\",\"admin_setting_mobile_settings\",\"admin_setting_mobile_iap_product\",\"admin_setting_mobile_iap_product_list\",\"admin_optimize\",\"admin_optimize_settings\",\"admin_jobs\",\"admin_jobs_manage\",\"admin_setting_ip_blacklist\",\"admin_setting_ip_blacklist_manage\",\"admin_setting_post_num_rules\",\"admin_setting_post_num_rules_settings\",\"admin_report_status\",\"admin_report_status_list\",\"admin_logs\",\"admin_logs_query\",\"admin_logs_prod\",\"admin_org_manage\",\"admin_org\",\"web\",\"course_manage\",\"course_manage_info\",\"course_manage_base\",\"course_manage_detail\",\"course_manage_picture\",\"course_manage_lesson\",\"live_course_manage_replay\",\"course_manage_files\",\"course_manage_setting\",\"course_manage_price\",\"course_manage_teachers\",\"course_manage_students\",\"course_manage_student_create\",\"course_manage_questions\",\"course_manage_question\",\"course_manage_testpaper\",\"course_manange_operate\",\"course_manage_data\",\"course_manage_order\",\"classroom_manage\",\"classroom_manage_settings\",\"classroom_manage_set_info\",\"classroom_manage_set_price\",\"classroom_manage_set_picture\",\"classroom_manage_service\",\"classroom_manage_headteacher\",\"classroom_manage_teachers\",\"classroom_manage_assistants\",\"classroom_manage_content\",\"classroom_manage_courses\",\"classroom_manage_students\",\"classroom_manage_testpaper\"]',1506519316,1,0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `sess_id` varbinary(128) NOT NULL,
  `sess_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sess_data` blob NOT NULL,
  `sess_time` int(10) unsigned NOT NULL,
  `sess_lifetime` mediumint(9) NOT NULL,
  PRIMARY KEY (`sess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0kptc92aom6j5po0tlmn952121',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"T4nXcqiVvHF3VRYwUAC_TNlqBZl6gqFqlsBuMPOUSf0\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506565911\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"0kptc92aom6j5po0tlmn952121\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506565911\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506565911;s:1:\"c\";i:1506565911;s:1:\"l\";s:1:\"0\";}',1506565911,86400),('0p7j09mdjo1lkgc1oakse531a0',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"-WNh7CoXQMj2b8VndkRtVc3UYe6D2wNqzFtAmMfCtXU\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564671;s:1:\"c\";i:1506564671;s:1:\"l\";s:1:\"0\";}',1506564671,86400),('0q3lsc9clf9a4ogs40a5410m81',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"gG-Kdm1o7U1TaB1HptKt94sQXa-M0VIDDJKrluGWxcI\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506565210\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"0q3lsc9clf9a4ogs40a5410m81\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506565210\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506565210;s:1:\"c\";i:1506565210;s:1:\"l\";s:1:\"0\";}',1506565210,86400),('1bilokm5ips7lr53nrprlc91b7',0,'_sf2_attributes|a:1:{s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567737;s:1:\"c\";i:1506567737;s:1:\"l\";s:1:\"0\";}',1506567737,86400),('1mn68gj1mefdtosee7jmna6qu6',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"5t-7GauAjyGNNT30Nio4fliMLyM8nUz8fjI6c8KMnuM\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506565787;s:1:\"c\";i:1506565787;s:1:\"l\";s:1:\"0\";}',1506565827,86400),('1mpistmg6uq3nallcc7hmb95o5',0,'_sf2_attributes|a:1:{s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567713;s:1:\"c\";i:1506567713;s:1:\"l\";s:1:\"0\";}',1506567713,86400),('1nq2qt9anjgj9cme1mas0r9pn5',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"MVfhCM2nwMID1gv2fbtFqiTP13WwOlxq0y_QgMA8aoo\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564671;s:1:\"c\";i:1506564671;s:1:\"l\";s:1:\"0\";}',1506564671,86400),('2021btmrgqp9rto7e0997k1g67',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"tYTtZlm0QMjtLjRWc0LfaABivNnOunDw79HmD5veHgI\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567976;s:1:\"c\";i:1506567976;s:1:\"l\";s:1:\"0\";}',1506567976,86400),('2mmrd6j68j950ssf586fu65h90',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"NIqKXTpilQWPIECSniRK-6wRbuhIum9cy2EqYONHxGs\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506565728\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"2mmrd6j68j950ssf586fu65h90\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506565728\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506565729;s:1:\"c\";i:1506565728;s:1:\"l\";s:1:\"0\";}',1506565729,86400),('3mdq6r7i16tq6a3ktb1i9ntrt1',3,'_sf2_attributes|a:5:{s:10:\"_csrf/site\";s:43:\"XBV-kh7QdBW3LWiWoK-T5QeF4X76knnliJjeUPM45_A\";s:16:\"active_user_time\";i:1506528000;s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506567976\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"3mdq6r7i16tq6a3ktb1i9ntrt1\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506567976\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567976;s:1:\"c\";i:1506567976;s:1:\"l\";s:1:\"0\";}',1506567976,86400),('43vmu844mthr4jeavgllld6ol5',3,'_sf2_attributes|a:5:{s:10:\"_csrf/site\";s:43:\"rS-D9RX_c-q8WYSviWTQaiCth3nnboECa8H8LP-NKYY\";s:16:\"active_user_time\";i:1506528000;s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506568255\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"43vmu844mthr4jeavgllld6ol5\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506568255\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568255;s:1:\"c\";i:1506568255;s:1:\"l\";s:1:\"0\";}',1506568255,86400),('4qvi33ehi9a2oki480mn479c87',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"tZWWpEHAjaJXKaO3_rBqHMSVvsNcThZ5J_fCbgr0kz0\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506565803;s:1:\"c\";i:1506565803;s:1:\"l\";s:1:\"0\";}',1506565867,86400),('5625hrg3f77labopmef84u45u2',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"WwQzL1T2hQ7gynzbZjUfdsn-qCdRudKAmfW4C8wmc0g\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564671;s:1:\"c\";i:1506564671;s:1:\"l\";s:1:\"0\";}',1506564671,86400),('64hronujesc8m9bsv6j4v5bsp6',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"7zcqG-aoSdU1kHd-Oe-sYxOrzCmEwJFKjy5iSnBVT-E\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568255;s:1:\"c\";i:1506568255;s:1:\"l\";s:1:\"0\";}',1506568295,86400),('69r3v1cspj4d0fq310m6ljcgu4',0,'_sf2_attributes|a:1:{s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567728;s:1:\"c\";i:1506567728;s:1:\"l\";s:1:\"0\";}',1506567728,86400),('6hpidoqjs0cqnhfvmbdc91avq2',1,'_sf2_attributes|a:7:{s:10:\"_csrf/site\";s:43:\"CnmP7dw4OLc2pg4HGwYTga-DfaU-toL1OyrntNYa1cc\";s:16:\"active_user_time\";i:1506528000;s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:14:\"_security_main\";s:2397:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2308:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:2267:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1798:{a:44:{s:2:\"id\";s:1:\"1\";s:5:\"email\";s:17:\"admin@admin.admin\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ceVlajyMRMai5fZgMsVWONHqT1oo5yO/ZZUvPMMTs1A=\";s:4:\"salt\";s:31:\"34zq6f815g84ww44ww0wsckk44kok04\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:5:\"admin\";s:5:\"title\";s:5:\"admin\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:7:\"default\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:50:\"public://default/2017/09-27/21374040438b731443.png\";s:12:\"mediumAvatar\";s:50:\"public://default/2017/09-27/213740403024308615.png\";s:11:\"largeAvatar\";s:50:\"public://default/2017/09-27/213740401c25733180.png\";s:13:\"emailVerified\";s:1:\"1\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:3:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";i:2;s:16:\"ROLE_SUPER_ADMIN\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506566358\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"qc8phortur7geu00bpitu024o1\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"0\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:0:\"\";s:11:\"createdTime\";s:10:\"1506519316\";s:11:\"updatedTime\";s:10:\"1506566358\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:3:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}i:2;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:16:\"ROLE_SUPER_ADMIN\";}}i:3;a:0:{}}\";}}\";s:14:\"registed_email\";s:23:\"teacher@teacher.teacher\";s:6:\"fileId\";s:1:\"1\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567218;s:1:\"c\";i:1506519346;s:1:\"l\";s:1:\"0\";}',1506567258,86400),('81mbmpl8uhv184b1qg394m9nt4',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"GaB12R0Fhsx1GO4lcdzYIlh3_oXYc2BwRFG9gOswadw\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567976;s:1:\"c\";i:1506567976;s:1:\"l\";s:1:\"0\";}',1506567976,86400),('8f03g6acamtlfp5gn89hl3gna1',4,'_sf2_attributes|a:5:{s:10:\"_csrf/site\";s:43:\"i3iDBwbk41nq1eWgxHo_65Ys7uLyn40zQ9lEetwbG2g\";s:16:\"active_user_time\";i:1506528000;s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:1943:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":1854:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1813:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1612:{a:44:{s:2:\"id\";s:1:\"4\";s:5:\"email\";s:23:\"FPEoQWL@FPEoQWL.FPEoQWL\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"eBS13xVGtpN+glNHpo+/q76NzQPsSG7C9+PYJ5tGof0=\";s:4:\"salt\";s:31:\"fo442iqwy48w4ss4k0k4osskwcwcgwg\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"FPEoQWL\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:9:\"web_email\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:1:{i:0;s:9:\"ROLE_USER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506564773\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"8f03g6acamtlfp5gn89hl3gna1\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506564732\";s:11:\"updatedTime\";s:10:\"1506564773\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:3:\"web\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:1:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564773;s:1:\"c\";i:1506564773;s:1:\"l\";s:1:\"0\";}',1506564773,86400),('9ulhoqsm3sp9k9p0a5mp6ok192',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"Bq-pKoMKqaDM5gjW7ieSITy3T0Sf1aXVnzQS3anyBAc\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568255;s:1:\"c\";i:1506568255;s:1:\"l\";s:1:\"0\";}',1506568255,86400),('a4n5vrb0ltha3fb18a3f3jbdk2',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"Woc8DVl-0e6bVK2pARh0a6eXLRG7vH5RAtOQBOtBUvM\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568255;s:1:\"c\";i:1506568255;s:1:\"l\";s:1:\"0\";}',1506568255,86400),('broh4pcuts96qevr63jf6f7fh1',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"NjhDlr9rQPIeJ6jLzG3NvBI7yenB5u0hdpnPwPK-5M0\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568255;s:1:\"c\";i:1506568255;s:1:\"l\";s:1:\"0\";}',1506568255,86400),('bvt3usbatsilin452g091pclt0',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"MfPJbFWFg0NApEiGgZoyDnT7qCLvz-mQBz8PXUELeN8\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506566195\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"bvt3usbatsilin452g091pclt0\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506566195\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506566196;s:1:\"c\";i:1506566195;s:1:\"l\";s:1:\"0\";}',1506566196,86400),('cv44k38vp0qmue7gb3s4ebs2h2',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"d9FTX7ETLzbY7Kg2FQFpnUjRUn7MCemO48F_smMvCWk\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564732;s:1:\"c\";i:1506564732;s:1:\"l\";s:1:\"0\";}',1506564732,86400),('ea0mnsmvprgga4pn4q0neulre6',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"F3PeJt0QZkKUF0yqHJwo_znnbcce4srAANcFzpXJnbY\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567976;s:1:\"c\";i:1506567976;s:1:\"l\";s:1:\"0\";}',1506567976,86400),('euvc26t8r77l4d3jp7va1c2ej4',19,'_sf2_attributes|a:5:{s:10:\"_csrf/site\";s:43:\"GMC6Gg57OM54_XbbIwTWGl0IW3U9s3K_PZCS7ZiTf_Y\";s:16:\"active_user_time\";i:1506528000;s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:1944:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":1855:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1814:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1613:{a:44:{s:2:\"id\";s:2:\"19\";s:5:\"email\";s:23:\"FPzpxiI@FPzpxiI.FPzpxiI\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"pLc1ntrhvlsz/yusAQ90GzfWu4i9q4Zxa1vjssFdRS0=\";s:4:\"salt\";s:31:\"i7fgvgfxxe044go800gogkow80skoog\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"FPzpxiI\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:9:\"web_email\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:1:{i:0;s:9:\"ROLE_USER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506568047\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"euvc26t8r77l4d3jp7va1c2ej4\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506567976\";s:11:\"updatedTime\";s:10:\"1506568047\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:3:\"web\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:1:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568047;s:1:\"c\";i:1506568047;s:1:\"l\";s:1:\"0\";}',1506568047,86400),('fk66oahp2mfd21d0ubpdplj9l2',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"fFH6Fh2QBvnNjSJ7OVekAO5s4OznjeRtC73OfTbnRKI\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568255;s:1:\"c\";i:1506568255;s:1:\"l\";s:1:\"0\";}',1506568255,86400),('gkqsh10v4d5acda8bbdtq0ni87',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"a52m3ua7U968nvX0ntiBKruB2GfD14rFDFS9-MF1bWA\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564732;s:1:\"c\";i:1506564732;s:1:\"l\";s:1:\"0\";}',1506564732,86400),('h3jhck8mviercf87ou7ctr9nl4',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"ozHx_eYglw-Y_YOpWQlFdFAPxTPm3kn6eX_oPo-dkPc\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568255;s:1:\"c\";i:1506568255;s:1:\"l\";s:1:\"0\";}',1506568255,86400),('h6lb2peu6eq20riuj876jl3md6',3,'_sf2_attributes|a:5:{s:10:\"_csrf/site\";s:43:\"Wxtgamns7td3mTTTu1huZso4pjteSLzijpFRzIU7_RM\";s:16:\"active_user_time\";i:1506528000;s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506564732\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"h6lb2peu6eq20riuj876jl3md6\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506564732\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564732;s:1:\"c\";i:1506564732;s:1:\"l\";s:1:\"0\";}',1506564732,86400),('hpm6p7ljhrlcmvj0l2jgo22ib4',0,'_sf2_attributes|a:2:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"6nt0e-zFJx3BJslaVAVy_V0t7-9HzRt_eBDs6F3v-DA\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567457;s:1:\"c\";i:1506567417;s:1:\"l\";s:1:\"0\";}',1506567457,86400),('iv8biuoab25rrpar7fs0rooa77',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"QIczEM_-fYulqEMf_JbUsiDCYLZwNs0K5M7zkAZ1-D4\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564732;s:1:\"c\";i:1506564732;s:1:\"l\";s:1:\"0\";}',1506564732,86400),('ke8gnalerbpla03brgbnpvtst7',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"XlMZXzXk65PzzGcwuqKvuW6OtWNPBLwSQ5tkPwkBSSY\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506567632\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"ke8gnalerbpla03brgbnpvtst7\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506567632\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567633;s:1:\"c\";i:1506567632;s:1:\"l\";s:1:\"0\";}',1506567633,86400),('kv5pgoc08c1rlemsgkjjft5680',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"tG05mLPYwSIfpOofVpwZ-9zShJPJTFaZFdhgSgdKzxk\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564671;s:1:\"c\";i:1506564671;s:1:\"l\";s:1:\"0\";}',1506564671,86400),('lmusn52reanbqtf3dlvo7a56i5',0,'_sf2_attributes|a:2:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"UjW7cvC1T_1AAH9kiB1Q6AVRUOJnl2DX_dEwVxrQsH8\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568007;s:1:\"c\";i:1506567967;s:1:\"l\";s:1:\"0\";}',1506568007,86400),('mf45pnge614p94t7rlvgcqgkn7',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"6V9SfZea2o_NDqmbPK-Sng_sdVNYBko5RJTNZ1Lmhc0\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506566575\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"mf45pnge614p94t7rlvgcqgkn7\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506566575\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506566575;s:1:\"c\";i:1506566575;s:1:\"l\";s:1:\"0\";}',1506566575,86400),('ojibj3fcud2dbc3apmchqp7lg6',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"0GCVORWLz_PsTyTOFj53kYtjtdV5YjBuOnMIV7WE310\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506567385\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"ojibj3fcud2dbc3apmchqp7lg6\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506567385\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567385;s:1:\"c\";i:1506567385;s:1:\"l\";s:1:\"0\";}',1506567385,86400),('p1n2tqbm2spnrcvc4trcs5eqv6',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"w-w4NsjtIlU4QLSvmqFPoU-TH0O63r5cHB666RPRqsE\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506567907\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"p1n2tqbm2spnrcvc4trcs5eqv6\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506567907\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567907;s:1:\"c\";i:1506567907;s:1:\"l\";s:1:\"0\";}',1506567907,86400),('ptofv6efn61necje9ivtebrfv1',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"HWfOz6pThfde3u1h2Ll7-ypx4gQdNxOEgbLnXPlKUjc\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564671;s:1:\"c\";i:1506564671;s:1:\"l\";s:1:\"0\";}',1506564671,86400),('q0llh1vpoke6k8rojm81l3rt27',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"IJo27StYNiWMx-ilKwPgMkXyyfRGkqkQPNidjGU9Ke0\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567976;s:1:\"c\";i:1506567976;s:1:\"l\";s:1:\"0\";}',1506567976,86400),('qc8phortur7geu00bpitu024o1',1,'_sf2_attributes|a:5:{s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:10:\"_csrf/site\";s:43:\"AjG6mQzJdw8TxByuvN5eMaoMinzZorbxeF8cOsyR9iQ\";s:16:\"active_user_time\";i:1506528000;s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2397:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2308:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:2267:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1798:{a:44:{s:2:\"id\";s:1:\"1\";s:5:\"email\";s:17:\"admin@admin.admin\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ceVlajyMRMai5fZgMsVWONHqT1oo5yO/ZZUvPMMTs1A=\";s:4:\"salt\";s:31:\"34zq6f815g84ww44ww0wsckk44kok04\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:5:\"admin\";s:5:\"title\";s:5:\"admin\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:7:\"default\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:50:\"public://default/2017/09-27/21374040438b731443.png\";s:12:\"mediumAvatar\";s:50:\"public://default/2017/09-27/213740403024308615.png\";s:11:\"largeAvatar\";s:50:\"public://default/2017/09-27/213740401c25733180.png\";s:13:\"emailVerified\";s:1:\"1\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:3:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";i:2;s:16:\"ROLE_SUPER_ADMIN\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506566358\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"qc8phortur7geu00bpitu024o1\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"0\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:0:\"\";s:11:\"createdTime\";s:10:\"1506519316\";s:11:\"updatedTime\";s:10:\"1506566358\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:3:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}i:2;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:16:\"ROLE_SUPER_ADMIN\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567220;s:1:\"c\";i:1506566358;s:1:\"l\";s:1:\"0\";}',1506567260,86400),('s2umik8jqbmnkupt3rcr3gfj90',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"meHCNkWZEzoS5Z9vrGnV0HO-8UCNBR6mR0b8uZ4_6r0\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564732;s:1:\"c\";i:1506564732;s:1:\"l\";s:1:\"0\";}',1506564732,86400),('sajkmsthe70nbobou1irp2ejc1',3,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"H_l_4qW3j50fg_YYu-XXeBuePFShSLXEkUm-JGRB0zE\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:2093:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":2004:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1963:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1630:{a:44:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:23:\"teacher@teacher.teacher\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=\";s:4:\"salt\";s:31:\"sr6c1dqxx2s80000wogks40skwc888g\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"teacher\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:6:\"import\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_TEACHER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506566400\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"sajkmsthe70nbobou1irp2ejc1\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506519434\";s:11:\"updatedTime\";s:10:\"1506566400\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:0:\"\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:2:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}i:1;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:12:\"ROLE_TEACHER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506566400;s:1:\"c\";i:1506566400;s:1:\"l\";s:1:\"0\";}',1506566400,86400),('sigcf5090eupmcaeiq55nldcd5',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"p5GQXgDfnbiSEPc7ngkUdG3ihGY4P6DnEfdQ6d-2Csg\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567976;s:1:\"c\";i:1506567976;s:1:\"l\";s:1:\"0\";}',1506567976,86400),('t048t61n25ebvmfmquqraikej6',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"uR5tJi1STufjwOSJ4zkied2oLJXPC9nRjtDMDS4oY50\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506568255;s:1:\"c\";i:1506568255;s:1:\"l\";s:1:\"0\";}',1506568255,86400),('tehdm0nrmouibuflu4etltrd37',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"1SMR38xnyM6mT9xE2YGo2J8HXPBMU_M14E0iSkRww-Q\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567976;s:1:\"c\";i:1506567976;s:1:\"l\";s:1:\"0\";}',1506567976,86400),('tolbuqbe352ff3romsfjloa0d7',13,'_sf2_attributes|a:5:{s:16:\"active_user_time\";i:1506528000;s:10:\"_csrf/site\";s:43:\"RJvg9kdgTnKCQybD-4W_n-xiM2P2_8wu2cg-0yiNfFc\";s:14:\"currentUserOrg\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"_security_main\";s:1944:\"C:74:\"Symfony\\Component\\Security\\Core\\Authentication\\Token\\UsernamePasswordToken\":1855:{a:3:{i:0;N;i:1;s:4:\"main\";i:2;s:1814:\"a:4:{i:0;C:20:\"Biz\\User\\CurrentUser\":1613:{a:44:{s:2:\"id\";s:2:\"13\";s:5:\"email\";s:23:\"FPuTMbO@FPuTMbO.FPuTMbO\";s:14:\"verifiedMobile\";s:0:\"\";s:8:\"password\";s:44:\"FwBqH3LRQPSKaaWK6Yfd4DlcG1otipfHLkjzIzHu2xk=\";s:4:\"salt\";s:31:\"i0kej0k4b34gks4ogwco4ssk08c08c4\";s:11:\"payPassword\";s:0:\"\";s:15:\"payPasswordSalt\";s:0:\"\";s:6:\"locale\";N;s:3:\"uri\";s:0:\"\";s:8:\"nickname\";s:7:\"FPuTMbO\";s:5:\"title\";s:0:\"\";s:4:\"tags\";s:0:\"\";s:4:\"type\";s:9:\"web_email\";s:5:\"point\";s:1:\"0\";s:4:\"coin\";s:1:\"0\";s:11:\"smallAvatar\";s:0:\"\";s:12:\"mediumAvatar\";s:0:\"\";s:11:\"largeAvatar\";s:0:\"\";s:13:\"emailVerified\";s:1:\"0\";s:5:\"setup\";s:1:\"1\";s:5:\"roles\";a:1:{i:0;s:9:\"ROLE_USER\";}s:8:\"promoted\";s:1:\"0\";s:11:\"promotedSeq\";s:1:\"0\";s:12:\"promotedTime\";s:1:\"0\";s:6:\"locked\";s:1:\"0\";s:12:\"lockDeadline\";s:1:\"0\";s:29:\"consecutivePasswordErrorTimes\";s:1:\"0\";s:20:\"lastPasswordFailTime\";s:1:\"0\";s:9:\"loginTime\";s:10:\"1506567183\";s:7:\"loginIp\";s:10:\"172.17.0.1\";s:14:\"loginSessionId\";s:26:\"tolbuqbe352ff3romsfjloa0d7\";s:12:\"approvalTime\";s:1:\"0\";s:14:\"approvalStatus\";s:9:\"unapprove\";s:13:\"newMessageNum\";s:1:\"1\";s:18:\"newNotificationNum\";s:1:\"0\";s:9:\"createdIp\";s:10:\"172.17.0.1\";s:11:\"createdTime\";s:10:\"1506567142\";s:11:\"updatedTime\";s:10:\"1506567183\";s:10:\"inviteCode\";N;s:5:\"orgId\";s:1:\"1\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"registeredWay\";s:3:\"web\";s:9:\"currentIp\";s:10:\"172.17.0.1\";s:3:\"org\";a:12:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"全站\";s:8:\"parentId\";s:1:\"0\";s:11:\"childrenNum\";s:1:\"0\";s:5:\"depth\";s:1:\"1\";s:3:\"seq\";s:1:\"0\";s:11:\"description\";N;s:4:\"code\";s:8:\"FullSite\";s:7:\"orgCode\";s:2:\"1.\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506519316\";s:10:\"updateTime\";s:10:\"1506519316\";}}}i:1;b:1;i:2;a:1:{i:0;O:41:\"Symfony\\Component\\Security\\Core\\Role\\Role\":1:{s:47:\"\0Symfony\\Component\\Security\\Core\\Role\\Role\0role\";s:9:\"ROLE_USER\";}}i:3;a:0:{}}\";}}\";}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506567183;s:1:\"c\";i:1506567183;s:1:\"l\";s:1:\"0\";}',1506567263,86400),('vgvqgougsehgkkj1mqlc488aq2',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"wortv8jzN7QCHSUBbtSGu2csals-zoJ8D3-kmZQt9OI\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564732;s:1:\"c\";i:1506564732;s:1:\"l\";s:1:\"0\";}',1506564732,86400),('vs2vgd605i3vrueh3bfrn8len1',0,'_sf2_attributes|a:2:{s:10:\"_csrf/site\";s:43:\"a9AWN8yv93jyQpYE0QwK3QFcA6jOrHmEVMfZ4m1qDI8\";s:16:\"active_user_time\";i:1506528000;}_sf2_flashes|a:0:{}_sf2_meta|a:3:{s:1:\"u\";i:1506564732;s:1:\"c\";i:1506564732;s:1:\"l\";s:1:\"0\";}',1506564732,86400);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统设置ID',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '系统设置名',
  `value` longblob COMMENT '系统设置值',
  `namespace` varchar(255) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`namespace`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'theme','a:1:{s:3:\"uri\";s:6:\"jianmo\";}','default'),(3,'crontab_next_executed_time','i:1506519316;','default'),(9,'contact','a:8:{s:7:\"enabled\";i:0;s:8:\"worktime\";s:12:\"9:00 - 17:00\";s:2:\"qq\";a:1:{i:0;a:2:{s:4:\"name\";s:0:\"\";s:6:\"number\";s:0:\"\";}}s:7:\"qqgroup\";a:1:{i:0;a:2:{s:4:\"name\";s:0:\"\";s:6:\"number\";s:0:\"\";}}s:5:\"phone\";a:1:{i:0;a:2:{s:4:\"name\";s:0:\"\";s:6:\"number\";s:0:\"\";}}s:10:\"webchatURI\";s:0:\"\";s:5:\"email\";s:0:\"\";s:5:\"color\";s:7:\"default\";}','default'),(14,'refund','a:4:{s:13:\"maxRefundDays\";i:10;s:17:\"applyNotification\";s:107:\"您好，您退款的{{item}}，管理员已收到您的退款申请，请耐心等待退款审核结果。\";s:19:\"successNotification\";s:82:\"您好，您申请退款的{{item}} 审核通过，将为您退款{{amount}}元。\";s:18:\"failedNotification\";s:93:\"您好，您申请退款的{{item}} 审核未通过，请与管理员再协商解决纠纷。\";}','default'),(15,'article','a:2:{s:4:\"name\";s:12:\"资讯频道\";s:8:\"pageNums\";i:20;}','default'),(16,'site','a:12:{s:4:\"name\";s:5:\"QWBXX\";s:6:\"slogan\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"logo\";s:0:\"\";s:12:\"seo_keywords\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";s:12:\"master_email\";s:17:\"admin@admin.admin\";s:3:\"icp\";s:0:\"\";s:9:\"analytics\";s:0:\"\";s:6:\"status\";s:4:\"open\";s:11:\"closed_note\";s:0:\"\";s:17:\"homepage_template\";s:4:\"less\";}','default'),(17,'developer','a:1:{s:18:\"cloud_api_failover\";i:1;}','default'),(18,'auth','a:8:{s:13:\"register_mode\";s:5:\"email\";s:22:\"email_activation_title\";s:33:\"请激活您的{{sitename}}账号\";s:21:\"email_activation_body\";s:366:\"Hi, {{nickname}}\n\n欢迎加入{{sitename}}!\n\n请点击下面的链接完成注册：\n\n{{verifyurl}}\n\n如果以上链接无法点击，请将上面的地址复制到你的浏览器(如IE)的地址栏中打开，该链接地址24小时内打开有效。\n\n感谢对{{sitename}}的支持！\n\n{{sitename}} {{siteurl}}\n\n(这是一封自动产生的email，请勿回复。)\";s:15:\"welcome_enabled\";s:6:\"opened\";s:14:\"welcome_sender\";s:5:\"admin\";s:15:\"welcome_methods\";a:0:{}s:13:\"welcome_title\";s:24:\"欢迎加入{{sitename}}\";s:12:\"welcome_body\";s:138:\"您好{{nickname}}，我是{{sitename}}的管理员，欢迎加入{{sitename}}，祝您学习愉快。如有问题，随时与我联系。\";}','default'),(19,'mailer','a:7:{s:7:\"enabled\";i:0;s:4:\"host\";s:16:\"smtp.example.com\";s:4:\"port\";s:2:\"25\";s:8:\"username\";s:16:\"user@example.com\";s:8:\"password\";s:0:\"\";s:4:\"from\";s:16:\"user@example.com\";s:4:\"name\";s:5:\"QWBXX\";}','default'),(20,'payment','a:5:{s:7:\"enabled\";i:0;s:12:\"bank_gateway\";s:4:\"none\";s:14:\"alipay_enabled\";i:0;s:10:\"alipay_key\";s:0:\"\";s:13:\"alipay_secret\";s:0:\"\";}','default'),(22,'post_num_rules','a:1:{s:5:\"rules\";a:2:{s:6:\"thread\";a:1:{s:14:\"fiveMuniteRule\";a:2:{s:8:\"interval\";i:300;s:7:\"postNum\";i:100;}}s:17:\"threadLoginedUser\";a:1:{s:14:\"fiveMuniteRule\";a:2:{s:8:\"interval\";i:300;s:7:\"postNum\";i:50;}}}}','default'),(23,'default','a:3:{s:12:\"chapter_name\";s:3:\"章\";s:9:\"user_name\";s:6:\"学员\";s:9:\"part_name\";s:3:\"节\";}','default'),(24,'coin','a:11:{s:10:\"cash_model\";s:4:\"none\";s:9:\"cash_rate\";i:1;s:12:\"coin_enabled\";i:0;s:9:\"coin_name\";s:9:\"虚拟币\";s:12:\"coin_content\";s:0:\"\";s:12:\"coin_picture\";s:0:\"\";s:18:\"coin_picture_50_50\";s:0:\"\";s:18:\"coin_picture_30_30\";s:0:\"\";s:18:\"coin_picture_20_20\";s:0:\"\";s:18:\"coin_picture_10_10\";s:0:\"\";s:19:\"charge_coin_enabled\";s:0:\"\";}','default'),(25,'magic','a:3:{s:18:\"export_allow_count\";i:100000;s:12:\"export_limit\";i:10000;s:10:\"enable_org\";i:0;}','default'),(26,'cloud_sms','a:1:{s:13:\"system_remind\";s:2:\"on\";}','default'),(27,'storage','a:6:{s:11:\"upload_mode\";s:5:\"local\";s:16:\"cloud_api_server\";s:22:\"http://api.edusoho.net\";s:16:\"cloud_access_key\";s:32:\"OmUyvz74WZtVfvV15PgnVrpNzjxocQn0\";s:16:\"cloud_secret_key\";s:32:\"WAut3U7c6WrITtQGZok6e11ldD1ipxCF\";s:21:\"enable_playback_rates\";i:0;s:17:\"cloud_key_applied\";i:1;}','default'),(29,'_app_last_check','i:1506519400;','default'),(45,'sms_account','a:3:{s:6:\"status\";s:7:\"uncheck\";s:9:\"checkTime\";i:1506566418;s:12:\"isOldSmsUser\";s:7:\"unknown\";}','default');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shortcut`
--

DROP TABLE IF EXISTS `shortcut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shortcut` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shortcut`
--

LOCK TABLES `shortcut` WRITE;
/*!40000 ALTER TABLE `shortcut` DISABLE KEYS */;
/*!40000 ALTER TABLE `shortcut` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sign_card`
--

DROP TABLE IF EXISTS `sign_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sign_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `cardNum` int(10) unsigned NOT NULL DEFAULT '0',
  `useTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sign_card`
--

LOCK TABLES `sign_card` WRITE;
/*!40000 ALTER TABLE `sign_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `sign_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sign_target_statistics`
--

DROP TABLE IF EXISTS `sign_target_statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sign_target_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统id',
  `targetType` varchar(255) NOT NULL DEFAULT '' COMMENT '签到目标类型',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到目标id',
  `signedNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到人数',
  `date` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '统计日期',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sign_target_statistics`
--

LOCK TABLES `sign_target_statistics` WRITE;
/*!40000 ALTER TABLE `sign_target_statistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `sign_target_statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sign_user_log`
--

DROP TABLE IF EXISTS `sign_user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sign_user_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统id',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `targetType` varchar(255) NOT NULL DEFAULT '' COMMENT '签到目标类型',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到目标id',
  `rank` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到排名',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sign_user_log`
--

LOCK TABLES `sign_user_log` WRITE;
/*!40000 ALTER TABLE `sign_user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sign_user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sign_user_statistics`
--

DROP TABLE IF EXISTS `sign_user_statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sign_user_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统id',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `targetType` varchar(255) NOT NULL DEFAULT '' COMMENT '签到目标类型',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到目标id',
  `keepDays` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '连续签到天数',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sign_user_statistics`
--

LOCK TABLES `sign_user_statistics` WRITE;
/*!40000 ALTER TABLE `sign_user_statistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `sign_user_statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL COMMENT '动态发布的人',
  `courseId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程Id',
  `classroomId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '班级id',
  `type` varchar(64) NOT NULL COMMENT '动态类型',
  `objectType` varchar(64) NOT NULL DEFAULT '' COMMENT '动态对象的类型',
  `objectId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '动态对象ID',
  `message` text NOT NULL COMMENT '动态的消息体',
  `properties` text NOT NULL COMMENT '动态的属性',
  `commentNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `likeNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被赞的数量',
  `private` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '动态发布时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `createdTime` (`createdTime`),
  KEY `courseId_createdTime` (`courseId`,`createdTime`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,5,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506565169),(2,6,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506565688),(3,10,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506566155),(4,11,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506566358),(5,12,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506566547),(6,12,0,1,'become_student','classroom',1,'','{\"classroom\":{\"id\":\"1\",\"title\":\"\\u98de\\u732a\\u63d0\\u9ad8\\u73ed\",\"picture\":\"\",\"about\":\"\",\"price\":\"0.00\"}}',0,0,0,1506566574),(7,13,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506567223),(8,14,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506567303),(9,14,0,1,'become_student','classroom',1,'','{\"classroom\":{\"id\":\"1\",\"title\":\"\\u98de\\u732a\\u63d0\\u9ad8\\u73ed\",\"picture\":\"\",\"about\":\"\",\"price\":\"0.00\"}}',0,0,0,1506567345),(10,16,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506567550),(11,16,0,1,'become_student','classroom',1,'','{\"classroom\":{\"id\":\"1\",\"title\":\"\\u98de\\u732a\\u63d0\\u9ad8\\u73ed\",\"picture\":\"\",\"about\":\"\",\"price\":\"0.00\"}}',0,0,0,1506567592),(12,17,1,0,'become_student','course',1,'','{\"course\":{\"id\":\"1\",\"title\":\"\\u9ed8\\u8ba4\\u6559\\u5b66\\u8ba1\\u5212\",\"type\":\"normal\",\"rating\":\"0\",\"price\":\"0.00\"}}',0,0,0,1506567824),(13,17,0,1,'become_student','classroom',1,'','{\"classroom\":{\"id\":\"1\",\"title\":\"\\u98de\\u732a\\u63d0\\u9ad8\\u73ed\",\"picture\":\"\",\"about\":\"\",\"price\":\"0.00\"}}',0,0,0,1506567866);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subtitle`
--

DROP TABLE IF EXISTS `subtitle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subtitle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '字幕名称',
  `subtitleId` int(10) unsigned NOT NULL COMMENT 'subtitle的uploadFileId',
  `mediaId` int(10) unsigned NOT NULL COMMENT 'video/audio的uploadFileId',
  `ext` varchar(12) NOT NULL DEFAULT '' COMMENT '后缀',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='字幕关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subtitle`
--

LOCK TABLES `subtitle` WRITE;
/*!40000 ALTER TABLE `subtitle` DISABLE KEYS */;
/*!40000 ALTER TABLE `subtitle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `name` varchar(64) NOT NULL COMMENT '标签名称',
  `createdTime` int(10) unsigned NOT NULL COMMENT '标签创建时间',
  `orgId` int(10) unsigned DEFAULT '1',
  `orgCode` varchar(255) DEFAULT '1.' COMMENT '组织机构内部编码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'默认标签',1506519316,1,'1.');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_group`
--

DROP TABLE IF EXISTS `tag_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '标签组名字',
  `scope` varchar(255) NOT NULL DEFAULT '' COMMENT '标签组应用范围',
  `tagNum` int(10) NOT NULL DEFAULT '0' COMMENT '标签组里的标签数量',
  `updatedTime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `createdTime` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_group`
--

LOCK TABLES `tag_group` WRITE;
/*!40000 ALTER TABLE `tag_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_group_tag`
--

DROP TABLE IF EXISTS `tag_group_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_group_tag` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tagId` int(10) NOT NULL DEFAULT '0' COMMENT '标签ID',
  `groupId` int(10) NOT NULL DEFAULT '0' COMMENT '标签组ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签组跟标签的中间表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_group_tag`
--

LOCK TABLES `tag_group_tag` WRITE;
/*!40000 ALTER TABLE `tag_group_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_group_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_owner`
--

DROP TABLE IF EXISTS `tag_owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_owner` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `ownerType` varchar(255) NOT NULL DEFAULT '' COMMENT '标签拥有者类型',
  `ownerId` int(10) NOT NULL DEFAULT '0' COMMENT '标签拥有者id',
  `tagId` int(10) NOT NULL DEFAULT '0' COMMENT '标签id',
  `userId` int(10) NOT NULL DEFAULT '0' COMMENT '操作用户id',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签关系表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_owner`
--

LOCK TABLES `tag_owner` WRITE;
/*!40000 ALTER TABLE `tag_owner` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '任务标题',
  `description` text COMMENT '任务描述',
  `meta` text COMMENT '任务元信息',
  `userId` int(10) NOT NULL DEFAULT '0',
  `taskType` varchar(100) NOT NULL COMMENT '任务类型',
  `batchId` int(10) NOT NULL DEFAULT '0' COMMENT '批次Id',
  `targetId` int(10) NOT NULL DEFAULT '0' COMMENT '类型id,可以是课时id,作业id等',
  `targetType` varchar(100) DEFAULT NULL COMMENT '类型,可以是课时,作业等',
  `taskStartTime` int(10) NOT NULL DEFAULT '0' COMMENT '任务开始时间',
  `taskEndTime` int(10) NOT NULL DEFAULT '0' COMMENT '任务结束时间',
  `intervalDate` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '历时天数',
  `status` enum('active','completed') NOT NULL DEFAULT 'active',
  `required` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为必做任务,0否,1是',
  `completedTime` int(10) NOT NULL DEFAULT '0' COMMENT '任务完成时间',
  `createdTime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testpaper`
--

DROP TABLE IF EXISTS `testpaper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testpaper` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '试卷ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷名称',
  `description` text COMMENT '试卷说明',
  `limitedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '限时(单位：秒)',
  `pattern` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷生成/显示模式',
  `target` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷所属对象',
  `status` varchar(32) NOT NULL DEFAULT 'draft' COMMENT '试卷状态：draft,open,closed',
  `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '总分',
  `passedScore` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '通过考试的分数线',
  `itemCount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目数量',
  `createdUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改人',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `metas` text COMMENT '题型排序',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制试卷对应Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testpaper`
--

LOCK TABLES `testpaper` WRITE;
/*!40000 ALTER TABLE `testpaper` DISABLE KEYS */;
/*!40000 ALTER TABLE `testpaper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testpaper_item`
--

DROP TABLE IF EXISTS `testpaper_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testpaper_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '试卷条目ID',
  `testId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属试卷',
  `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目顺序',
  `questionId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目ID',
  `questionType` varchar(64) NOT NULL DEFAULT '' COMMENT '题目类别',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父题ID',
  `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '分值',
  `missScore` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '漏选得分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testpaper_item`
--

LOCK TABLES `testpaper_item` WRITE;
/*!40000 ALTER TABLE `testpaper_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `testpaper_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testpaper_item_result`
--

DROP TABLE IF EXISTS `testpaper_item_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testpaper_item_result` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '试卷题目做题结果ID',
  `itemId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷条目ID',
  `testId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷ID',
  `testPaperResultId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷结果ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '做题人ID',
  `questionId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目ID',
  `status` enum('none','right','partRight','wrong','noAnswer') NOT NULL DEFAULT 'none' COMMENT '结果状态',
  `score` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '得分',
  `answer` text COMMENT '回答',
  `teacherSay` text COMMENT '老师评价',
  `pId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '复制试卷题目Id',
  PRIMARY KEY (`id`),
  KEY `testPaperResultId` (`testPaperResultId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testpaper_item_result`
--

LOCK TABLES `testpaper_item_result` WRITE;
/*!40000 ALTER TABLE `testpaper_item_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `testpaper_item_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testpaper_item_result_v8`
--

DROP TABLE IF EXISTS `testpaper_item_result_v8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testpaper_item_result_v8` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷题目id',
  `testId` int(10) unsigned NOT NULL DEFAULT '0',
  `resultId` int(10) NOT NULL DEFAULT '0' COMMENT '试卷结果ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `questionId` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('none','right','partRight','wrong','noAnswer') NOT NULL DEFAULT 'none',
  `score` float(10,1) NOT NULL DEFAULT '0.0',
  `answer` text,
  `teacherSay` text,
  `pId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '复制试卷题目Id',
  `type` varchar(32) NOT NULL DEFAULT 'testpaper' COMMENT '测验类型',
  `migrateItemResultId` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `testPaperResultId` (`resultId`),
  KEY `resultId_type` (`resultId`,`type`),
  KEY `testId_type` (`testId`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testpaper_item_result_v8`
--

LOCK TABLES `testpaper_item_result_v8` WRITE;
/*!40000 ALTER TABLE `testpaper_item_result_v8` DISABLE KEYS */;
/*!40000 ALTER TABLE `testpaper_item_result_v8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testpaper_item_v8`
--

DROP TABLE IF EXISTS `testpaper_item_v8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testpaper_item_v8` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '题目',
  `testId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属试卷',
  `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目顺序',
  `questionId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目id',
  `questionType` varchar(64) NOT NULL DEFAULT '' COMMENT '题目类别',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0',
  `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '分值',
  `missScore` float(10,1) unsigned NOT NULL DEFAULT '0.0',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制来源testpaper_item的id',
  `type` varchar(32) NOT NULL DEFAULT 'testpaper' COMMENT '测验类型',
  `migrateItemId` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `testId` (`testId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testpaper_item_v8`
--

LOCK TABLES `testpaper_item_v8` WRITE;
/*!40000 ALTER TABLE `testpaper_item_v8` DISABLE KEYS */;
/*!40000 ALTER TABLE `testpaper_item_v8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testpaper_result`
--

DROP TABLE IF EXISTS `testpaper_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testpaper_result` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '试卷结果ID',
  `paperName` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷名称',
  `testId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷ID',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '做卷人ID',
  `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '总分',
  `objectiveScore` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '主观题得分',
  `subjectiveScore` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '客观题得分',
  `teacherSay` text COMMENT '老师评价',
  `rightItemCount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '正确题目数',
  `passedStatus` enum('none','excellent','good','passed','unpassed') NOT NULL DEFAULT 'none' COMMENT '考试通过状态，none表示该考试没有',
  `limitedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷限制时间(秒)',
  `beginTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` enum('doing','paused','reviewing','finished') NOT NULL COMMENT '状态',
  `target` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷结果所属对象',
  `checkTeacherId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '批卷老师ID',
  `checkedTime` int(11) NOT NULL DEFAULT '0' COMMENT '批卷时间',
  `usedTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testpaper_result`
--

LOCK TABLES `testpaper_result` WRITE;
/*!40000 ALTER TABLE `testpaper_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `testpaper_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testpaper_result_v8`
--

DROP TABLE IF EXISTS `testpaper_result_v8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testpaper_result_v8` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `paperName` varchar(255) NOT NULL DEFAULT '',
  `testId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'testId',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'UserId',
  `courseId` int(10) NOT NULL DEFAULT '0',
  `lessonId` int(10) NOT NULL DEFAULT '0',
  `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '分数',
  `objectiveScore` float(10,1) unsigned NOT NULL DEFAULT '0.0',
  `subjectiveScore` float(10,1) unsigned NOT NULL DEFAULT '0.0',
  `teacherSay` text,
  `rightItemCount` int(10) unsigned NOT NULL DEFAULT '0',
  `passedStatus` enum('none','excellent','good','passed','unpassed') NOT NULL DEFAULT 'none' COMMENT '考试通过状态，none表示该考试没有',
  `limitedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷限制时间(秒)',
  `beginTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` enum('doing','paused','reviewing','finished') NOT NULL COMMENT '状态',
  `target` varchar(255) NOT NULL DEFAULT '',
  `checkTeacherId` int(10) unsigned NOT NULL DEFAULT '0',
  `checkedTime` int(11) NOT NULL DEFAULT '0',
  `usedTime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(32) NOT NULL DEFAULT 'testpaper' COMMENT '测验类型',
  `courseSetId` int(11) unsigned NOT NULL DEFAULT '0',
  `migrateResultId` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `testId` (`testId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testpaper_result_v8`
--

LOCK TABLES `testpaper_result_v8` WRITE;
/*!40000 ALTER TABLE `testpaper_result_v8` DISABLE KEYS */;
/*!40000 ALTER TABLE `testpaper_result_v8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testpaper_v8`
--

DROP TABLE IF EXISTS `testpaper_v8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testpaper_v8` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷名称',
  `description` text COMMENT '试卷说明',
  `courseId` int(10) NOT NULL DEFAULT '0',
  `lessonId` int(10) NOT NULL DEFAULT '0',
  `limitedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '限时(单位：秒)',
  `pattern` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷生成/显示模式',
  `target` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(32) NOT NULL DEFAULT 'draft' COMMENT '试卷状态：draft,open,closed',
  `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '总分',
  `passedCondition` text,
  `itemCount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目数量',
  `createdUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改人',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `metas` text COMMENT '题型排序',
  `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制试卷对应Id',
  `type` varchar(32) NOT NULL DEFAULT 'testpaper' COMMENT '测验类型',
  `courseSetId` int(11) unsigned NOT NULL DEFAULT '0',
  `migrateTestId` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `courseSetId` (`courseSetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testpaper_v8`
--

LOCK TABLES `testpaper_v8` WRITE;
/*!40000 ALTER TABLE `testpaper_v8` DISABLE KEYS */;
/*!40000 ALTER TABLE `testpaper_v8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_config`
--

DROP TABLE IF EXISTS `theme_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `config` text,
  `confirmConfig` text,
  `allConfig` text,
  `updatedTime` int(11) NOT NULL DEFAULT '0',
  `createdTime` int(11) NOT NULL DEFAULT '0',
  `updatedUserId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_config`
--

LOCK TABLES `theme_config` WRITE;
/*!40000 ALTER TABLE `theme_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread`
--

DROP TABLE IF EXISTS `thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `targetType` varchar(255) NOT NULL DEFAULT 'classroom' COMMENT '所属 类型',
  `targetId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属类型 ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `ats` text COMMENT '@(提)到的人',
  `nice` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '加精',
  `sticky` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '置顶',
  `solved` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否有老师回答(已被解决)',
  `lastPostUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后回复人ID',
  `lastPostTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后回复时间',
  `location` varchar(1024) DEFAULT NULL COMMENT '地点',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` varchar(255) NOT NULL DEFAULT '' COMMENT '话题类型',
  `postNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `hitNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `memberNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '成员人数',
  `maxUsers` int(10) NOT NULL DEFAULT '0' COMMENT '最大人数',
  `actvityPicture` varchar(255) DEFAULT NULL COMMENT '活动图片',
  `status` enum('open','closed') NOT NULL DEFAULT 'open' COMMENT '状态',
  `startTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `relationId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '从属ID',
  `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题最后一次被编辑或回复时间',
  PRIMARY KEY (`id`),
  KEY `updateTime` (`updateTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread`
--

LOCK TABLES `thread` WRITE;
/*!40000 ALTER TABLE `thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_member`
--

DROP TABLE IF EXISTS `thread_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统Id',
  `threadId` int(10) unsigned NOT NULL COMMENT '话题Id',
  `userId` int(10) unsigned NOT NULL COMMENT '用户Id',
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `truename` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `mobile` varchar(32) DEFAULT NULL COMMENT '手机号码',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题成员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_member`
--

LOCK TABLES `thread_member` WRITE;
/*!40000 ALTER TABLE `thread_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_post`
--

DROP TABLE IF EXISTS `thread_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `threadId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题ID',
  `content` text NOT NULL COMMENT '内容',
  `adopted` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否被采纳(是老师回答)',
  `ats` text COMMENT '@(提)到的人',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `subposts` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '子话题数量',
  `ups` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '投票数',
  `targetType` varchar(255) NOT NULL DEFAULT 'classroom' COMMENT '所属 类型',
  `targetId` int(10) unsigned NOT NULL COMMENT '所属 类型ID',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_post`
--

LOCK TABLES `thread_post` WRITE;
/*!40000 ALTER TABLE `thread_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_vote`
--

DROP TABLE IF EXISTS `thread_vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_vote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `threadId` int(10) unsigned NOT NULL COMMENT '话题ID',
  `postId` int(10) unsigned NOT NULL COMMENT '回帖ID',
  `action` enum('up','down') NOT NULL COMMENT '投票类型',
  `userId` int(10) unsigned NOT NULL COMMENT '投票人ID',
  `createdTime` int(10) unsigned NOT NULL COMMENT '投票时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `postId` (`threadId`,`postId`,`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题投票表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_vote`
--

LOCK TABLES `thread_vote` WRITE;
/*!40000 ALTER TABLE `thread_vote` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_vote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upgrade_logs`
--

DROP TABLE IF EXISTS `upgrade_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upgrade_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remoteId` int(11) NOT NULL COMMENT 'packageId',
  `installedId` int(11) DEFAULT NULL COMMENT '本地已安装id',
  `ename` varchar(32) NOT NULL COMMENT '名称',
  `cname` varchar(32) NOT NULL COMMENT '中文名称',
  `fromv` varchar(32) DEFAULT NULL COMMENT '初始版本',
  `tov` varchar(32) NOT NULL COMMENT '目标版本',
  `type` smallint(6) NOT NULL COMMENT '升级类型',
  `dbBackPath` text COMMENT '数据库备份文件',
  `srcBackPath` text COMMENT '源文件备份地址',
  `status` varchar(32) NOT NULL COMMENT '状态(ROLLBACK,ERROR,SUCCESS,RECOVERED)',
  `logtime` int(11) NOT NULL COMMENT '升级时间',
  `uid` int(10) unsigned NOT NULL COMMENT 'uid',
  `ip` varchar(32) DEFAULT NULL COMMENT 'ip',
  `reason` text COMMENT '失败原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='本地升级日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upgrade_logs`
--

LOCK TABLES `upgrade_logs` WRITE;
/*!40000 ALTER TABLE `upgrade_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `upgrade_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upgrade_notice`
--

DROP TABLE IF EXISTS `upgrade_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upgrade_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `code` varchar(100) NOT NULL COMMENT '编码',
  `version` varchar(100) NOT NULL COMMENT '版本号',
  `createdTime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户升级提示查看';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upgrade_notice`
--

LOCK TABLES `upgrade_notice` WRITE;
/*!40000 ALTER TABLE `upgrade_notice` DISABLE KEYS */;
/*!40000 ALTER TABLE `upgrade_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_file_inits`
--

DROP TABLE IF EXISTS `upload_file_inits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_file_inits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `globalId` varchar(32) NOT NULL DEFAULT '0' COMMENT '云文件ID',
  `status` enum('uploading','ok') NOT NULL DEFAULT 'ok' COMMENT '文件上传状态',
  `hashId` varchar(128) NOT NULL DEFAULT '' COMMENT '文件的HashID',
  `targetId` int(11) NOT NULL COMMENT '所存目标id',
  `targetType` varchar(64) NOT NULL DEFAULT '' COMMENT '目标类型',
  `filename` varchar(1024) NOT NULL DEFAULT '',
  `ext` varchar(12) NOT NULL DEFAULT '' COMMENT '后缀',
  `fileSize` bigint(20) NOT NULL DEFAULT '0',
  `etag` varchar(256) NOT NULL DEFAULT '',
  `length` int(10) unsigned NOT NULL DEFAULT '0',
  `convertHash` varchar(256) NOT NULL DEFAULT '' COMMENT '文件转换时的查询转换进度用的Hash值',
  `convertStatus` enum('none','waiting','doing','success','error') NOT NULL DEFAULT 'none',
  `metas` text,
  `metas2` text,
  `type` enum('document','video','audio','image','ppt','other','flash','subtitle') NOT NULL DEFAULT 'other' COMMENT '文件类型',
  `storage` enum('local','cloud') NOT NULL,
  `convertParams` text COMMENT '文件转换参数',
  `updatedUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新用户名',
  `updatedTime` int(10) unsigned DEFAULT '0',
  `createdUserId` int(10) unsigned NOT NULL,
  `createdTime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hashId` (`hashId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_file_inits`
--

LOCK TABLES `upload_file_inits` WRITE;
/*!40000 ALTER TABLE `upload_file_inits` DISABLE KEYS */;
INSERT INTO `upload_file_inits` VALUES (1,'0','ok','opencourselesson/2/2017927100537-dgxbf9.mp4',2,'opencourselesson','a.mp4','mp4',464255,'',0,'ch-opencourselesson/2/2017927100537-dgxbf9.mp4','none',NULL,NULL,'video','local',NULL,1,1506521137,1,1506521137),(2,'0','uploading','opencourselesson/1/2017928102729-1d2597.mp4',1,'opencourselesson','a.mp4','mp4',464255,'',0,'ch-opencourselesson/1/2017928102729-1d2597.mp4','none',NULL,NULL,'video','local',NULL,1,1506565649,1,1506565649),(3,'0','uploading','opencourselesson/1/2017928102837-1i5wvc.mp4',1,'opencourselesson','a.mp4','mp4',464255,'',0,'ch-opencourselesson/1/2017928102837-1i5wvc.mp4','none',NULL,NULL,'video','local',NULL,1,1506565717,1,1506565717),(4,'0','ok','opencourselesson/1/2017928103050-6sjfg9.mp4',1,'opencourselesson','a.mp4','mp4',464255,'',0,'ch-opencourselesson/1/2017928103050-6sjfg9.mp4','none',NULL,NULL,'video','local',NULL,1,1506565850,1,1506565850);
/*!40000 ALTER TABLE `upload_file_inits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_files`
--

DROP TABLE IF EXISTS `upload_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_files` (
  `id` int(10) unsigned NOT NULL,
  `globalId` varchar(32) NOT NULL DEFAULT '0' COMMENT '云文件ID',
  `hashId` varchar(128) NOT NULL DEFAULT '' COMMENT '文件的HashID',
  `targetId` int(11) NOT NULL COMMENT '所存目标ID',
  `targetType` varchar(64) NOT NULL DEFAULT '' COMMENT '目标类型',
  `useType` varchar(64) DEFAULT NULL COMMENT '文件使用的模块类型',
  `filename` varchar(1024) NOT NULL DEFAULT '' COMMENT '文件名',
  `ext` varchar(12) NOT NULL DEFAULT '' COMMENT '后缀',
  `fileSize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `etag` varchar(256) NOT NULL DEFAULT '' COMMENT 'ETAG',
  `length` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '长度（音视频则为时长，PPT/文档为页数）',
  `description` text,
  `status` enum('uploading','ok') NOT NULL DEFAULT 'ok' COMMENT '文件上传状态',
  `convertHash` varchar(128) NOT NULL DEFAULT '' COMMENT '文件转换时的查询转换进度用的Hash值',
  `convertStatus` enum('none','waiting','doing','success','error') NOT NULL DEFAULT 'none' COMMENT '文件转换状态',
  `convertParams` text COMMENT '文件转换参数',
  `metas` text COMMENT '元信息',
  `metas2` text COMMENT '元信息',
  `type` enum('document','video','audio','image','ppt','other','flash','subtitle') NOT NULL DEFAULT 'other' COMMENT '文件类型',
  `storage` enum('local','cloud') NOT NULL COMMENT '文件存储方式',
  `isPublic` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否公开文件',
  `canDownload` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否可下载',
  `usedCount` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新用户名',
  `updatedTime` int(10) unsigned DEFAULT '0' COMMENT '文件最后更新时间',
  `createdUserId` int(10) unsigned NOT NULL COMMENT '文件上传人',
  `createdTime` int(10) unsigned NOT NULL COMMENT '文件上传时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `convertHash` (`convertHash`(64)),
  UNIQUE KEY `hashId` (`hashId`(120))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_files`
--

LOCK TABLES `upload_files` WRITE;
/*!40000 ALTER TABLE `upload_files` DISABLE KEYS */;
INSERT INTO `upload_files` VALUES (1,'0','opencourselesson/2/2017927100537-dgxbf9.mp4',2,'opencourselesson',NULL,'a.mp4','mp4',464255,'',0,NULL,'ok','ch-opencourselesson/2/2017927100537-dgxbf9.mp4','none','',NULL,'','video','local',0,0,3,1,1506521137,1,1506521137),(4,'0','opencourselesson/1/2017928103050-6sjfg9.mp4',1,'opencourselesson',NULL,'a.mp4','mp4',464255,'',0,NULL,'ok','ch-opencourselesson/1/2017928103050-6sjfg9.mp4','none','',NULL,'','video','local',0,0,3,1,1506565850,1,1506565850);
/*!40000 ALTER TABLE `upload_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_files_collection`
--

DROP TABLE IF EXISTS `upload_files_collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_files_collection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fileId` int(10) unsigned NOT NULL COMMENT '文件Id',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏者',
  `createdTime` int(10) unsigned NOT NULL,
  `updatedTime` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文件收藏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_files_collection`
--

LOCK TABLES `upload_files_collection` WRITE;
/*!40000 ALTER TABLE `upload_files_collection` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_files_collection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_files_share`
--

DROP TABLE IF EXISTS `upload_files_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_files_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sourceUserId` int(10) unsigned NOT NULL COMMENT '上传文件的用户ID',
  `targetUserId` int(10) unsigned NOT NULL COMMENT '文件分享目标用户ID',
  `isActive` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否有效',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_files_share`
--

LOCK TABLES `upload_files_share` WRITE;
/*!40000 ALTER TABLE `upload_files_share` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_files_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_files_share_history`
--

DROP TABLE IF EXISTS `upload_files_share_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_files_share_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统ID',
  `sourceUserId` int(10) NOT NULL COMMENT '分享用户的ID',
  `targetUserId` int(10) NOT NULL COMMENT '被分享的用户的ID',
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `createdTime` int(10) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_files_share_history`
--

LOCK TABLES `upload_files_share_history` WRITE;
/*!40000 ALTER TABLE `upload_files_share_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_files_share_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_files_tag`
--

DROP TABLE IF EXISTS `upload_files_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_files_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统ID',
  `fileId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件ID',
  `tagId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标签ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文件与标签的关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_files_tag`
--

LOCK TABLES `upload_files_tag` WRITE;
/*!40000 ALTER TABLE `upload_files_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_files_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `email` varchar(128) NOT NULL COMMENT '用户邮箱',
  `verifiedMobile` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL COMMENT '用户密码',
  `salt` varchar(32) NOT NULL COMMENT '密码SALT',
  `payPassword` varchar(64) NOT NULL DEFAULT '' COMMENT '支付密码',
  `payPasswordSalt` varchar(64) NOT NULL DEFAULT '' COMMENT '支付密码Salt',
  `locale` varchar(20) DEFAULT NULL,
  `uri` varchar(64) NOT NULL DEFAULT '' COMMENT '用户URI',
  `nickname` varchar(64) NOT NULL COMMENT '昵称',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `tags` varchar(255) NOT NULL DEFAULT '' COMMENT '标签',
  `type` varchar(32) NOT NULL COMMENT 'default默认为网站注册, weibo新浪微薄登录',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '金币',
  `smallAvatar` varchar(255) NOT NULL DEFAULT '' COMMENT '小头像',
  `mediumAvatar` varchar(255) NOT NULL DEFAULT '' COMMENT '中头像',
  `largeAvatar` varchar(255) NOT NULL DEFAULT '' COMMENT '大头像',
  `emailVerified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '邮箱是否为已验证',
  `setup` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否初始化设置的，未初始化的可以设置邮箱、昵称。',
  `roles` varchar(255) NOT NULL COMMENT '用户角色',
  `promoted` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为推荐',
  `promotedSeq` int(10) unsigned NOT NULL DEFAULT '0',
  `promotedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐时间',
  `locked` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否被禁止',
  `lockDeadline` int(10) NOT NULL DEFAULT '0' COMMENT '帐号锁定期限',
  `consecutivePasswordErrorTimes` int(11) NOT NULL DEFAULT '0' COMMENT '帐号密码错误次数',
  `lastPasswordFailTime` int(10) NOT NULL DEFAULT '0',
  `loginTime` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `loginIp` varchar(64) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `loginSessionId` varchar(255) NOT NULL DEFAULT '' COMMENT '最后登录会话ID',
  `approvalTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '实名认证时间',
  `approvalStatus` enum('unapprove','approving','approved','approve_fail') NOT NULL DEFAULT 'unapprove' COMMENT '实名认证状态',
  `newMessageNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '未读私信数',
  `newNotificationNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '未读消息数',
  `createdIp` varchar(64) NOT NULL DEFAULT '' COMMENT '注册IP',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `inviteCode` varchar(255) DEFAULT NULL COMMENT '邀请码',
  `orgId` int(10) unsigned DEFAULT '1',
  `orgCode` varchar(255) DEFAULT '1.' COMMENT '组织机构内部编码',
  `registeredWay` varchar(64) NOT NULL DEFAULT '' COMMENT '注册设备来源(web/ios/android)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nickname` (`nickname`),
  KEY `updatedTime` (`updatedTime`),
  KEY `user_type_index` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin@admin.admin','','ceVlajyMRMai5fZgMsVWONHqT1oo5yO/ZZUvPMMTs1A=','34zq6f815g84ww44ww0wsckk44kok04','','',NULL,'','admin','admin','','default',0,0,'public://default/2017/09-27/21374040438b731443.png','public://default/2017/09-27/213740403024308615.png','public://default/2017/09-27/213740401c25733180.png',1,1,'|ROLE_USER|ROLE_TEACHER|ROLE_SUPER_ADMIN|',0,0,0,0,0,0,0,1506566358,'172.17.0.1','qc8phortur7geu00bpitu024o1',0,'unapprove',0,0,'',1506519316,1506566358,NULL,1,'1.',''),(2,'user_seoadickk@edusoho.net','','+9tE6Xx7na+CK/NpolrRQEISKt7wYGpGQNcCimz9aME=','pr35kto2ilcgw4k008kgs4s8gwo0gc8','','',NULL,'','userm0zktb(系统用户)','','','system',0,0,'','','',1,1,'|ROLE_USER|ROLE_SUPER_ADMIN|',0,0,0,0,0,0,0,1506564289,'172.17.0.1','6hpidoqjs0cqnhfvmbdc91avq2',0,'unapprove',0,0,'',1506519316,1506564289,NULL,1,'1.',''),(3,'teacher@teacher.teacher','','ns+vr5Mxwmdtm37RzAE9OO5H6pDYzvMLw27daoQfDo0=','sr6c1dqxx2s80000wogks40skwc888g','','',NULL,'','teacher','','','import',0,0,'','','',0,1,'|ROLE_TEACHER|ROLE_USER|',0,0,0,0,0,0,0,1506568255,'172.17.0.1','43vmu844mthr4jeavgllld6ol5',0,'unapprove',1,0,'172.17.0.1',1506519434,1506568255,NULL,1,'1.',''),(4,'FPEoQWL@FPEoQWL.FPEoQWL','','eBS13xVGtpN+glNHpo+/q76NzQPsSG7C9+PYJ5tGof0=','fo442iqwy48w4ss4k0k4osskwcwcgwg','','',NULL,'','FPEoQWL','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506564773,'172.17.0.1','8f03g6acamtlfp5gn89hl3gna1',0,'unapprove',1,0,'172.17.0.1',1506564732,1506564773,NULL,1,'1.','web'),(5,'FPxfKpg@FPxfKpg.FPxfKpg','','/kJoRhbaYCxN3xRtnGxWDPpYyAkasy5MLPOy1DsWZ+M=','fftxn17b2j4884go44kk4oskcwgcc44','','',NULL,'','FPxfKpg','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506565129,'172.17.0.1','jgfidrqmmd2j7n2rr0a09c5q32',0,'unapprove',1,0,'172.17.0.1',1506565089,1506565129,NULL,1,'1.','web'),(6,'FPYNPiX@FPYNPiX.FPYNPiX','','IApKAafOVrTsR6tJHzVQjH0v7fCDpVWp/haBHsINZZs=','21lz7iun2k1wksgw4k00o888g0kc40o','','',NULL,'','FPYNPiX','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506565648,'172.17.0.1','1sp8v64lnnrm8cn2slu507ljf6',0,'unapprove',1,0,'172.17.0.1',1506565608,1506565648,NULL,1,'1.','web'),(7,'FPfzxBI@FPfzxBI.FPfzxBI','','bdvuPxgrQGY4JPAzciVW6hYMSl+qXctHolRCugBkNFc=','q0gvrujj3tw08k8so8oc0skwoccs04','','',NULL,'','FPfzxBI','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,0,'','',0,'unapprove',1,0,'172.17.0.1',1506565787,1506565787,NULL,1,'1.','web'),(8,'FPkunfy@FPkunfy.FPkunfy','','6v85QmGb4kl6U/2EEHxosYpEUwac5M8g/p5EP5SzmDY=','mbx3kiknsiog8c4gskokk8cs0wowkwg','','',NULL,'','FPkunfy','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,0,'','',0,'unapprove',1,0,'172.17.0.1',1506565803,1506565803,NULL,1,'1.','web'),(9,'FPRouFD@FPRouFD.FPRouFD','','cHuwgu5aNShVoLQM6dsK94xx6BTA5uoK9MbA6y5aafw=','mrcpyri3z6s488sk0c0c8ss8wow8sc0','','',NULL,'','FPRouFD','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506565911,'172.17.0.1','bhnvvdtf96edt5tj3ovblkd8s5',0,'unapprove',1,0,'172.17.0.1',1506565870,1506565911,NULL,1,'1.','web'),(10,'FPyGKZs@FPyGKZs.FPyGKZs','','RW3b8BuWw+tcxXrPpjCj9tjo476U0czMiY9rLoe/TFU=','41jmygif7huskck4w840owkcgk0wgow','','',NULL,'','FPyGKZs','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506566115,'172.17.0.1','k8m9pf8q2mq24bh074mnjgqdf6',0,'unapprove',1,0,'172.17.0.1',1506566075,1506566115,NULL,1,'1.','web'),(11,'FPuCryc@FPuCryc.FPuCryc','','ZqduaWTZR8lDQdbDB9xFe1Wd81SdB30tvxUMgJfmLjQ=','ctttgrjjd4ow0oo8swwwgg88k8o4wcs','','',NULL,'','FPuCryc','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506566399,'172.17.0.1','lj0o665rbrh3hemn1t4e4cvjj4',0,'unapprove',1,0,'172.17.0.1',1506566278,1506566399,NULL,1,'1.','web'),(12,'FPompux@FPompux.FPompux','','LPLEEw8wN8AXG0fpY/fm3u9DdEMoDe9EHTo1Z6WBBoo=','6yr4vdse7ssg88s44484so4s0kg8o0k','','',NULL,'','FPompux','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506566574,'172.17.0.1','8os4bsokdl2t677o0vbilgbk11',0,'unapprove',1,0,'172.17.0.1',1506566466,1506566574,NULL,1,'1.','web'),(13,'FPuTMbO@FPuTMbO.FPuTMbO','','FwBqH3LRQPSKaaWK6Yfd4DlcG1otipfHLkjzIzHu2xk=','i0kej0k4b34gks4ogwco4ssk08c08c4','','',NULL,'','FPuTMbO','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506567183,'172.17.0.1','tolbuqbe352ff3romsfjloa0d7',0,'unapprove',1,0,'172.17.0.1',1506567142,1506567183,NULL,1,'1.','web'),(14,'FPPiJkw@FPPiJkw.FPPiJkw','','e+gdrkDDMoAYBE+CC4lHUSho6zFlaWBCO0IsKdfl/e0=','6v1q553xxf8csook8owcgc4o8kcoo4c','','',NULL,'','FPPiJkw','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506567345,'172.17.0.1','694b2p24aisnjcqdglgu4l83q6',0,'unapprove',1,0,'172.17.0.1',1506567212,1506567345,NULL,1,'1.','web'),(15,'FPzymNa@FPzymNa.FPzymNa','','NdqMkYIXCV8qF0c8ixisEEppLQ68Vec9beufbTIWGBk=','b3mw37x3ciokko88w0kg8gksko4sws4','','',NULL,'','FPzymNa','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,0,'','',0,'unapprove',1,0,'172.17.0.1',1506567417,1506567417,NULL,1,'1.','web'),(16,'FPSlwOy@FPSlwOy.FPSlwOy','','3K9MS0ohYcootjoPZrNY4Fg8pNBhVPy284yyKhdFqBM=','51e4lw5cxg08gssk8o8ocg4okc88c8w','','',NULL,'','FPSlwOy','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506567592,'172.17.0.1','jqnjn6k375vbuvdujgqnfgt6j3',0,'unapprove',1,0,'172.17.0.1',1506567470,1506567592,NULL,1,'1.','web'),(17,'FPqqBrl@FPqqBrl.FPqqBrl','','SAAISvXmLPXMFEw8/LxaWKIcC92d/G9tX14YChVggtg=','a9p9jx0lclc0swg8kogkgw000owcwk0','','',NULL,'','FPqqBrl','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506567866,'172.17.0.1','7qqsagtsugfhiia4mdf2a9teq0',0,'unapprove',1,0,'172.17.0.1',1506567744,1506567866,NULL,1,'1.','web'),(18,'FPmTasA@FPmTasA.FPmTasA','','JaX3mBUZ5ttnfPvM77QBGW+zc/nRarsJCXWgK31xqSM=','h73b5mx588owg0kw4wk0og8wosockcw','','',NULL,'','FPmTasA','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,0,'','',0,'unapprove',1,0,'172.17.0.1',1506567967,1506567967,NULL,1,'1.','web'),(19,'FPzpxiI@FPzpxiI.FPzpxiI','','pLc1ntrhvlsz/yusAQ90GzfWu4i9q4Zxa1vjssFdRS0=','i7fgvgfxxe044go800gogkow80skoog','','',NULL,'','FPzpxiI','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,1506568047,'172.17.0.1','euvc26t8r77l4d3jp7va1c2ej4',0,'unapprove',1,0,'172.17.0.1',1506567976,1506568047,NULL,1,'1.','web'),(20,'FPiwdoI@FPiwdoI.FPiwdoI','','EhWdDLFED4a0NxD98poNAiFzPtxJU8oITCp4Ffpv8e4=','8weu0utojkkcok4s84cgcscg4os8o08','','',NULL,'','FPiwdoI','','','web_email',0,0,'','','',0,1,'|ROLE_USER|',0,0,0,0,0,0,0,0,'','',0,'unapprove',1,0,'172.17.0.1',1506568255,1506568255,NULL,1,'1.','web');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_active_log`
--

DROP TABLE IF EXISTS `user_active_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_active_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userId` int(11) NOT NULL COMMENT '用户Id',
  `activeTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '激活时间',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `createdTime` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='活跃用户记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_active_log`
--

LOCK TABLES `user_active_log` WRITE;
/*!40000 ALTER TABLE `user_active_log` DISABLE KEYS */;
INSERT INTO `user_active_log` VALUES (1,1,20170928,1506564208),(2,5,20170928,1506565210),(3,6,20170928,1506565728),(4,9,20170928,1506565911),(5,10,20170928,1506566195),(6,11,20170928,1506566399),(7,3,20170928,1506566399),(8,12,20170928,1506566572),(9,14,20170928,1506567343),(10,16,20170928,1506567591),(11,17,20170928,1506567865);
/*!40000 ALTER TABLE `user_active_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_approval`
--

DROP TABLE IF EXISTS `user_approval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_approval` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户认证ID',
  `userId` int(10) NOT NULL COMMENT '用户ID',
  `idcard` varchar(24) NOT NULL DEFAULT '' COMMENT '身份证号',
  `faceImg` varchar(500) NOT NULL DEFAULT '' COMMENT '认证正面图',
  `backImg` varchar(500) NOT NULL DEFAULT '' COMMENT '认证背面图',
  `truename` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `note` text COMMENT '认证信息',
  `status` enum('unapprove','approving','approved','approve_fail') NOT NULL COMMENT '是否通过：1是 0否',
  `operatorId` int(10) unsigned DEFAULT NULL COMMENT '审核人',
  `createdTime` int(10) NOT NULL DEFAULT '0' COMMENT '申请时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户认证表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_approval`
--

LOCK TABLES `user_approval` WRITE;
/*!40000 ALTER TABLE `user_approval` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_approval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_bind`
--

DROP TABLE IF EXISTS `user_bind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_bind` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户绑定ID',
  `type` varchar(64) NOT NULL COMMENT '用户绑定类型',
  `fromId` varchar(32) NOT NULL COMMENT '来源方用户ID',
  `toId` int(10) unsigned NOT NULL COMMENT '被绑定的用户ID',
  `token` varchar(255) NOT NULL DEFAULT '' COMMENT 'oauth token',
  `refreshToken` varchar(255) NOT NULL DEFAULT '' COMMENT 'oauth refresh token',
  `expiredTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'token过期时间',
  `createdTime` int(10) unsigned NOT NULL COMMENT '绑定时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`,`fromId`),
  UNIQUE KEY `type_2` (`type`,`toId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_bind`
--

LOCK TABLES `user_bind` WRITE;
/*!40000 ALTER TABLE `user_bind` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_bind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_field`
--

DROP TABLE IF EXISTS `user_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fieldName` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(1024) NOT NULL DEFAULT '',
  `seq` int(10) unsigned NOT NULL,
  `enabled` int(10) unsigned NOT NULL DEFAULT '0',
  `createdTime` int(100) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_field`
--

LOCK TABLES `user_field` WRITE;
/*!40000 ALTER TABLE `user_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_fortune_log`
--

DROP TABLE IF EXISTS `user_fortune_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_fortune_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `number` int(10) NOT NULL,
  `action` varchar(20) NOT NULL,
  `note` varchar(255) NOT NULL DEFAULT '',
  `createdTime` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_fortune_log`
--

LOCK TABLES `user_fortune_log` WRITE;
/*!40000 ALTER TABLE `user_fortune_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_fortune_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_pay_agreement`
--

DROP TABLE IF EXISTS `user_pay_agreement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_pay_agreement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户Id',
  `type` int(8) NOT NULL DEFAULT '0' COMMENT '0:储蓄卡1:信用卡',
  `bankName` varchar(255) NOT NULL COMMENT '银行名称',
  `bankNumber` int(8) NOT NULL COMMENT '银行卡号',
  `userAuth` varchar(225) DEFAULT NULL COMMENT '用户授权',
  `bankAuth` varchar(225) NOT NULL COMMENT '银行授权码',
  `bankId` int(8) NOT NULL COMMENT '对应的银行Id',
  `updatedTime` int(10) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `createdTime` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户授权银行';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_pay_agreement`
--

LOCK TABLES `user_pay_agreement` WRITE;
/*!40000 ALTER TABLE `user_pay_agreement` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_pay_agreement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile` (
  `id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `truename` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `idcard` varchar(24) NOT NULL DEFAULT '' COMMENT '身份证号码',
  `gender` enum('male','female','secret') NOT NULL DEFAULT 'secret' COMMENT '性别',
  `iam` varchar(255) NOT NULL DEFAULT '' COMMENT '我是谁',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `city` varchar(64) NOT NULL DEFAULT '' COMMENT '城市',
  `mobile` varchar(32) NOT NULL DEFAULT '' COMMENT '手机',
  `qq` varchar(32) NOT NULL DEFAULT '' COMMENT 'QQ',
  `signature` text COMMENT '签名',
  `about` text COMMENT '自我介绍',
  `company` varchar(255) NOT NULL DEFAULT '' COMMENT '公司',
  `job` varchar(255) NOT NULL DEFAULT '' COMMENT '工作',
  `school` varchar(255) NOT NULL DEFAULT '' COMMENT '学校',
  `class` varchar(255) NOT NULL DEFAULT '' COMMENT '班级',
  `weibo` varchar(255) NOT NULL DEFAULT '' COMMENT '微博',
  `weixin` varchar(255) NOT NULL DEFAULT '' COMMENT '微信',
  `isQQPublic` int(11) NOT NULL DEFAULT '0',
  `isWeixinPublic` int(11) NOT NULL DEFAULT '0',
  `isWeiboPublic` int(11) NOT NULL DEFAULT '0',
  `site` varchar(255) NOT NULL DEFAULT '' COMMENT '网站',
  `intField1` int(11) DEFAULT NULL,
  `intField2` int(11) DEFAULT NULL,
  `intField3` int(11) DEFAULT NULL,
  `intField4` int(11) DEFAULT NULL,
  `intField5` int(11) DEFAULT NULL,
  `dateField1` date DEFAULT NULL,
  `dateField2` date DEFAULT NULL,
  `dateField3` date DEFAULT NULL,
  `dateField4` date DEFAULT NULL,
  `dateField5` date DEFAULT NULL,
  `floatField1` float(10,2) DEFAULT NULL,
  `floatField2` float(10,2) DEFAULT NULL,
  `floatField3` float(10,2) DEFAULT NULL,
  `floatField4` float(10,2) DEFAULT NULL,
  `floatField5` float(10,2) DEFAULT NULL,
  `varcharField1` varchar(1024) DEFAULT NULL,
  `varcharField2` varchar(1024) DEFAULT NULL,
  `varcharField3` varchar(1024) DEFAULT NULL,
  `varcharField4` varchar(1024) DEFAULT NULL,
  `varcharField5` varchar(1024) DEFAULT NULL,
  `varcharField6` varchar(1024) DEFAULT NULL,
  `varcharField7` varchar(1024) DEFAULT NULL,
  `varcharField8` varchar(1024) DEFAULT NULL,
  `varcharField9` varchar(1024) DEFAULT NULL,
  `varcharField10` varchar(1024) DEFAULT NULL,
  `textField1` text,
  `textField2` text,
  `textField3` text,
  `textField4` text,
  `textField5` text,
  `textField6` text,
  `textField7` text,
  `textField8` text,
  `textField9` text,
  `textField10` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,'飞猪','','secret','',NULL,'','12312341234','123121234',NULL,'<p>admin</p>\n','','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(2,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(4,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(5,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(6,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(7,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(8,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(9,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(10,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(11,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(12,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(13,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(14,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(15,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(16,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(17,'','','secret','',NULL,'','','',NULL,NULL,'','just test','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(18,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(19,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','',''),(20,'','','secret','',NULL,'','','',NULL,NULL,'','','','','','',0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_secure_question`
--

DROP TABLE IF EXISTS `user_secure_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_secure_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `securityQuestionCode` varchar(64) NOT NULL DEFAULT '' COMMENT '问题的code',
  `securityAnswer` varchar(64) NOT NULL DEFAULT '' COMMENT '安全问题的答案',
  `securityAnswerSalt` varchar(64) NOT NULL DEFAULT '' COMMENT '安全问题的答案Salt',
  `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_secure_question`
--

LOCK TABLES `user_secure_question` WRITE;
/*!40000 ALTER TABLE `user_secure_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_secure_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'TOKEN编号',
  `token` varchar(64) NOT NULL COMMENT 'TOKEN值',
  `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'TOKEN关联的用户ID',
  `type` varchar(255) NOT NULL COMMENT 'TOKEN类型',
  `data` text NOT NULL COMMENT 'TOKEN数据',
  `times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'TOKEN的校验次数限制(0表示不限制)',
  `remainedTimes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'TOKE剩余校验次数',
  `expiredTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'TOKEN过期时间',
  `createdTime` int(10) unsigned NOT NULL COMMENT 'TOKEN创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`(60))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_token`
--

LOCK TABLES `user_token` WRITE;
/*!40000 ALTER TABLE `user_token` DISABLE KEYS */;
INSERT INTO `user_token` VALUES (2,'nz9g5zghuf4wg80k8o84ow8s44c8ow0',1,'fileupload','a:27:{s:8:\"fileName\";s:5:\"a.mp4\";s:8:\"fileSize\";s:6:\"464255\";s:4:\"hash\";s:37:\"cmd5|08ac0ae855642b18017b3aa6435a1125\";s:10:\"directives\";a:1:{s:6:\"output\";s:5:\"video\";}s:6:\"userId\";s:1:\"1\";s:10:\"targetType\";s:16:\"opencourselesson\";s:8:\"targetId\";s:1:\"1\";s:6:\"bucket\";s:7:\"private\";s:7:\"storage\";s:5:\"local\";s:2:\"id\";s:1:\"2\";s:8:\"globalId\";s:1:\"0\";s:6:\"status\";s:9:\"uploading\";s:6:\"hashId\";s:43:\"opencourselesson/1/2017928102729-1d2597.mp4\";s:8:\"filename\";s:5:\"a.mp4\";s:3:\"ext\";s:3:\"mp4\";s:4:\"etag\";s:0:\"\";s:6:\"length\";s:1:\"0\";s:11:\"convertHash\";s:46:\"ch-opencourselesson/1/2017928102729-1d2597.mp4\";s:13:\"convertStatus\";s:4:\"none\";s:5:\"metas\";N;s:6:\"metas2\";N;s:4:\"type\";s:5:\"video\";s:13:\"convertParams\";N;s:13:\"updatedUserId\";s:1:\"1\";s:11:\"updatedTime\";s:10:\"1506565649\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506565649\";}',0,0,1506572849,1506565649),(3,'ly4pdzjjgk08k4wo4kgsssokckg40cs',1,'fileupload','a:27:{s:8:\"fileName\";s:5:\"a.mp4\";s:8:\"fileSize\";s:6:\"464255\";s:4:\"hash\";s:37:\"cmd5|08ac0ae855642b18017b3aa6435a1125\";s:10:\"directives\";a:1:{s:6:\"output\";s:5:\"video\";}s:6:\"userId\";s:1:\"1\";s:10:\"targetType\";s:16:\"opencourselesson\";s:8:\"targetId\";s:1:\"1\";s:6:\"bucket\";s:7:\"private\";s:7:\"storage\";s:5:\"local\";s:2:\"id\";s:1:\"3\";s:8:\"globalId\";s:1:\"0\";s:6:\"status\";s:9:\"uploading\";s:6:\"hashId\";s:43:\"opencourselesson/1/2017928102837-1i5wvc.mp4\";s:8:\"filename\";s:5:\"a.mp4\";s:3:\"ext\";s:3:\"mp4\";s:4:\"etag\";s:0:\"\";s:6:\"length\";s:1:\"0\";s:11:\"convertHash\";s:46:\"ch-opencourselesson/1/2017928102837-1i5wvc.mp4\";s:13:\"convertStatus\";s:4:\"none\";s:5:\"metas\";N;s:6:\"metas2\";N;s:4:\"type\";s:5:\"video\";s:13:\"convertParams\";N;s:13:\"updatedUserId\";s:1:\"1\";s:11:\"updatedTime\";s:10:\"1506565717\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506565717\";}',0,0,1506572917,1506565717),(4,'2vmotfyl1cqo4gcgw4skoocckc48kgo',1,'fileupload','a:27:{s:8:\"fileName\";s:5:\"a.mp4\";s:8:\"fileSize\";s:6:\"464255\";s:4:\"hash\";s:37:\"cmd5|08ac0ae855642b18017b3aa6435a1125\";s:10:\"directives\";a:1:{s:6:\"output\";s:5:\"video\";}s:6:\"userId\";s:1:\"1\";s:10:\"targetType\";s:16:\"opencourselesson\";s:8:\"targetId\";s:1:\"1\";s:6:\"bucket\";s:7:\"private\";s:7:\"storage\";s:5:\"local\";s:2:\"id\";s:1:\"4\";s:8:\"globalId\";s:1:\"0\";s:6:\"status\";s:9:\"uploading\";s:6:\"hashId\";s:43:\"opencourselesson/1/2017928103050-6sjfg9.mp4\";s:8:\"filename\";s:5:\"a.mp4\";s:3:\"ext\";s:3:\"mp4\";s:4:\"etag\";s:0:\"\";s:6:\"length\";s:1:\"0\";s:11:\"convertHash\";s:46:\"ch-opencourselesson/1/2017928103050-6sjfg9.mp4\";s:13:\"convertStatus\";s:4:\"none\";s:5:\"metas\";N;s:6:\"metas2\";N;s:4:\"type\";s:5:\"video\";s:13:\"convertParams\";N;s:13:\"updatedUserId\";s:1:\"1\";s:11:\"updatedTime\";s:10:\"1506565850\";s:13:\"createdUserId\";s:1:\"1\";s:11:\"createdTime\";s:10:\"1506565850\";}',0,0,1506573050,1506565850);
/*!40000 ALTER TABLE `user_token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-28  3:17:42
