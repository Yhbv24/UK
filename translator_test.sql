-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 08, 2017 at 05:26 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `translator_test`
--
CREATE DATABASE IF NOT EXISTS `translator_test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `translator_test`;

-- --------------------------------------------------------

--
-- Table structure for table `UK_US`
--

CREATE TABLE `UK_US` (
  `id` bigint(20) unsigned NOT NULL,
  `UK_id` int(11) DEFAULT NULL,
  `US_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UK_US`
--

INSERT INTO `UK_US` (`id`, `UK_id`, `US_id`) VALUES
(1, 149, 76),
(2, 155, 84),
(3, 161, 92),
(4, 167, 100),
(5, 173, 108),
(6, 179, 116),
(7, 185, 124),
(8, 191, 132),
(9, 197, 140),
(10, 203, 148),
(11, 209, 156),
(12, 215, 164),
(13, 221, 172),
(14, 227, 180),
(15, 233, 188),
(16, 239, 196),
(17, 245, 204),
(18, 251, 206),
(19, 257, 214),
(20, 263, 222),
(21, 269, 230),
(22, 275, 238),
(23, 281, 246),
(24, 287, 254),
(25, 293, 262),
(26, 299, 270),
(27, 12, 1),
(28, 18, 3),
(29, 19, 13),
(30, 25, 14),
(31, 32, 17),
(32, 34, 28),
(33, 40, 29),
(34, 42, 40),
(35, 48, 41),
(36, 50, 52),
(37, 56, 53),
(38, 58, 64),
(39, 64, 65),
(40, 66, 76),
(41, 72, 77),
(42, 74, 88),
(43, 80, 89),
(44, 82, 100),
(45, 88, 101),
(46, 90, 112),
(47, 96, 113),
(48, 99, 123),
(49, 105, 124),
(50, 108, 134);

-- --------------------------------------------------------

--
-- Table structure for table `UK_words`
--

CREATE TABLE `UK_words` (
  `id` bigint(20) unsigned NOT NULL,
  `word` varchar(255) DEFAULT NULL,
  `definition` text,
  `example` text,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `US_words`
--

CREATE TABLE `US_words` (
  `id` bigint(20) unsigned NOT NULL,
  `word` varchar(255) DEFAULT NULL,
  `definition` text,
  `example` text,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `UK_US`
--
ALTER TABLE `UK_US`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `UK_words`
--
ALTER TABLE `UK_words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `US_words`
--
ALTER TABLE `US_words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `UK_US`
--
ALTER TABLE `UK_US`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `UK_words`
--
ALTER TABLE `UK_words`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `US_words`
--
ALTER TABLE `US_words`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
