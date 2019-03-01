-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 12 月 07 日 14:49
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `biaodan20151207`
--

-- --------------------------------------------------------

--
-- 表的结构 `bd_images`
--

CREATE TABLE IF NOT EXISTS `bd_images` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(120) COLLATE utf8_bin DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  `addtime` datetime NOT NULL,
  `username` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `imagergb` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `small_src` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '小图路径',
  `mid_src` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '中图路径',
  `big_src` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '大图路径',
  `about` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '简要',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
