-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2018 at 07:45 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gotsctf`
--
CREATE DATABASE IF NOT EXISTS `gotsctf` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gotsctf`;

-- --------------------------------------------------------

--
-- Table structure for table `bb_blog`
--
DROP TABLE IF EXISTS `bb_blog`;
CREATE TABLE IF NOT EXISTS `bb_blog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ident` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `catalog_id` bigint(20) NOT NULL,
  `blog_content_id` bigint(20) NOT NULL,
  `blog_content_last_update` bigint(20) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `views` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ident` (`ident`),
  UNIQUE KEY `blog_content_id` (`blog_content_id`),
  KEY `bb_blog_catalog_id` (`catalog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bb_blog`
--

INSERT INTO `bb_blog` (`id`, `ident`, `title`, `keywords`, `catalog_id`, `blog_content_id`, `blog_content_last_update`, `type`, `status`, `views`, `created`) VALUES
(1, 'welcome', '欢迎！', 'blog', 1, 1, 1527737879, 0, 1, 0, '2018-05-30 14:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `bb_blog_content`
--

DROP TABLE IF EXISTS `bb_blog_content`;
CREATE TABLE IF NOT EXISTS `bb_blog_content` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bb_blog_content`
--

INSERT INTO `bb_blog_content` (`id`, `content`) VALUES
(1, '# RUA！欢迎来到<span style=\"color:#1273BD\">我的博客</span>！\n\n![Colored Logo-Blue-2.png](/static/uploads/usercontents/editor/1527669513.png)\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `bb_catalog`
--

DROP TABLE IF EXISTS `bb_catalog`;
CREATE TABLE IF NOT EXISTS `bb_catalog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ident` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ident` (`ident`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bb_catalog`
--

INSERT INTO `bb_catalog` (`id`, `ident`, `name`, `resume`, `display_order`, `img_url`) VALUES
(1, 'TSCTF', 'TSCTF', '天枢CTF2018', 99, '/static/uploads/usercontents/catalogs/TSCTF_1527662021.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
