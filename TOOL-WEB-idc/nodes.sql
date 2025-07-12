-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2017-11-12 08:49:47
-- 服务器版本： 5.6.37
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s0386199`
--

-- --------------------------------------------------------

--
-- 表的结构 `nodes`
--

CREATE TABLE IF NOT EXISTS `nodes` (
  `module` varchar(255) NOT NULL,
  `name` varchar(32) NOT NULL,
  `host` varchar(64) NOT NULL,
  `port` int(11) NOT NULL,
  `user` varchar(32) DEFAULT NULL,
  `userpasswd` varchar(255) DEFAULT NULL,
  `max_count` int(11) NOT NULL DEFAULT '0',
  `create_count` int(11) NOT NULL DEFAULT '0',
  `passwd` varchar(32) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `intranet_host` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `nodes`
--

INSERT INTO `nodes` (`module`, `name`, `host`, `port`, `user`, `userpasswd`, `max_count`, `create_count`, `passwd`, `nickname`, `intranet_host`) VALUES
('easypanel', 'bj.hcbi.pw', '101.254.177.249', 3312, '', '', 0, 5, 'XDFZvvRuWFLfrd67', '', '101.254.177.249');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nodes`
--
ALTER TABLE `nodes`
  ADD PRIMARY KEY (`name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
