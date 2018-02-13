-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-02-13 09:00:47
-- 伺服器版本: 10.1.28-MariaDB
-- PHP 版本： 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `clock-system`
--

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE `record` (
  `id` int(20) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo_path` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `geolocation` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `accuracy` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `record`
--

INSERT INTO `record` (`id`, `name`, `state`, `time`, `notes`, `ip`, `photo_path`, `geolocation`, `accuracy`) VALUES
(1, 'Gary', '上班', '2018-02-06 09:28:50', '', '168.140.11.2', '', '', 0),
(2, 'Gary', '上班', '2018-02-07 10:09:22', '', '168.190.12.1', '', '', 0),
(3, '星瑋', '上班', '2018-02-12 07:04:34', '', '::1', 'path', '(24.994446,121.4970294)', 2381),
(4, '星瑋', '上班', '2018-02-12 07:07:54', 'e04', '::1', 'upload_photo/alice/2018-02-12;15_07_54.jpg', '(24.994446,121.4970294)', 2381),
(5, '星瑋', '上班', '2018-02-12 07:17:25', 'e04', '::1', 'upload_photo/alice/2018-02-12;15_17_25.jpg', '(25.026158300000002,121.54270929999998)', 9591);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `eng_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0:admin ;1:user',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `name`, `eng_name`, `email`, `password`, `status`, `timestamp`) VALUES
(1, '徐大賢', 'Gary', '123@123', '1234', 1, '2018-02-07 07:33:28'),
(2, '星瑋', 'alice', 'test@123', '1234', 1, '2018-02-12 03:21:09'),
(3, 'John', '', 'ttt@123', '1234', 1, '2018-02-12 03:23:53');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `record`
--
ALTER TABLE `record`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
