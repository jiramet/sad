-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2012 at 02:24 PM
-- Server version: 5.1.50-community
-- PHP Version: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `school`
--
CREATE DATABASE `school` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `school`;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `surname` char(30) NOT NULL,
  `grade` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `student`
--

INSERT DELAYED IGNORE INTO `student` (`id`, `name`, `surname`, `grade`) VALUES
(1, '11', '22', '33'),
(2, '11', '22', '33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
