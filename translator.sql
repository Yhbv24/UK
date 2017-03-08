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
-- Database: `translator`
--
CREATE DATABASE IF NOT EXISTS `translator` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `translator`;

-- --------------------------------------------------------

--
-- Table structure for table `UK_US`
--

CREATE TABLE `UK_US` (
  `id` bigint(20) unsigned NOT NULL,
  `UK_id` int(11) DEFAULT NULL,
  `US_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uk_words`
--

CREATE TABLE `uk_words` (
  `id` bigint(20) unsigned NOT NULL,
  `definition` text,
  `example` text,
  `region` varchar(255) DEFAULT NULL,
  `word` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_words`
--

CREATE TABLE `us_words` (
  `id` bigint(20) unsigned NOT NULL,
  `definition` text,
  `example` text,
  `region` varchar(255) DEFAULT NULL,
  `word` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL
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
-- Indexes for table `uk_words`
--
ALTER TABLE `uk_words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `word` (`word`);

--
-- Indexes for table `us_words`
--
ALTER TABLE `us_words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `word` (`word`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `UK_US`
--
ALTER TABLE `UK_US`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uk_words`
--
ALTER TABLE `uk_words`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `us_words`
--
ALTER TABLE `us_words`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
