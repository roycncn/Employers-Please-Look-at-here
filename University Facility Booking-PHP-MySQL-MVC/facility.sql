-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2014 at 09:03 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `facility`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `adminName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `password`, `adminName`) VALUES
('12250000', '123456', 'admin0'),
('12250001', '123456', 'admin1'),
('12250002', '123456', 'admin2'),
('12250003', '123456', 'admin3');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE IF NOT EXISTS `facility` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT '0',
  `location` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numOfUser` int(11) DEFAULT NULL,
  `opentime` varchar(13) COLLATE utf8_unicode_ci DEFAULT '0000000000000',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`fid`, `fname`, `type`, `price`, `location`, `numOfUser`, `opentime`) VALUES
(27, 'AAB401', 'Studying Room', 10, 'AAB', 12, '1000000000000'),
(28, 'AAB402', 'Studying Room', 0, 'AAB', 10, '1000000000000'),
(29, 'AAB403', 'Studying Room', 10, 'AAB', 1, '1000000000000'),
(30, 'AAB404', 'Studying Room', 1, 'AAB', 1, '1000000000000'),
(31, 'Football', 'Sports', 0, 'Main Hall', 10, '1000000000000'),
(32, 'AAB701', 'Classroom', 0, 'AAB', 60, '1000000000000'),
(33, 'Pingpang', 'Sports', 0, 'SCC', 2, '1000000000000');

-- --------------------------------------------------------

--
-- Table structure for table `forder`
--

CREATE TABLE IF NOT EXISTS `forder` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `ssoid` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `phoneNumber` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bookTime` datetime DEFAULT NULL,
  `numOfUser` int(11) DEFAULT NULL,
  `purpose` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT '0',
  `isWithdraw` tinyint(2) NOT NULL DEFAULT '0',
  `isCheckIn` tinyint(2) NOT NULL DEFAULT '0',
  `useHour` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `useDate` date NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `forder`
--

INSERT INTO `forder` (`orderId`, `ssoid`, `fid`, `phoneNumber`, `bookTime`, `numOfUser`, `purpose`, `price`, `isPaid`, `isWithdraw`, `isCheckIn`, `useHour`, `useDate`) VALUES
(20, '12253333', 33, '888888', '2014-11-30 08:11:04', 2, 'pingpang', 0, 0, 0, 0, '1010000000000', '2014-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ssoid` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `sname` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  PRIMARY KEY (`ssoid`),
  UNIQUE KEY `user_name` (`sname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ssoid`, `sname`, `password`) VALUES
(12251111, 'Zhang Xiaoming', '123456'),
(12252222, 'Zhang Daming', '123456'),
(12253333, 'Wang Chuizi', '123456'),
(12254444, 'Zhang Lala', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
