-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2015 at 07:20 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web_poth`
--
CREATE DATABASE IF NOT EXISTS `web_poth` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `web_poth`;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sex` enum('Male','Female','Other') COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` datetime NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `thana` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_profiles_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `from` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `from_bn` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `to_bn` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `departure_place` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `departure_time` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `rent` int(11) NOT NULL,
  `evidence` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT '0' COMMENT '0=not varified, 1=verified',
  `added` datetime NOT NULL,
  `added_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `is_verified` (`is_verified`),
  KEY `FK_routes_users` (`added_by`),
  KEY `from` (`from`),
  KEY `from_bn` (`from_bn`),
  KEY `to` (`to`),
  KEY `to_bn` (`to_bn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stoppages`
--

CREATE TABLE IF NOT EXISTS `stoppages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `place_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `rent` int(11) NOT NULL,
  `route_id` bigint(20) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_stopages_routes` (`route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_logged` datetime NOT NULL,
  `type` int(11) NOT NULL DEFAULT '2' COMMENT '1=admin, 2= user',
  `reputaion` int(11) NOT NULL,
  `avatar` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `mobile`, `reg_date`, `last_logged`, `type`, `reputaion`, `avatar`) VALUES
(2, 'rejoan', '81dc9bdb52d04dc20036dbd8313ed055', 'pappu@spinytel.com', '23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, '2cnh0et.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `FK_profiles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `FK_routes_users` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `stoppages`
--
ALTER TABLE `stoppages`
  ADD CONSTRAINT `FK_stopages_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
