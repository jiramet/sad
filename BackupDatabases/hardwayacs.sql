-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- เวอร์ชั่นของเซิร์ฟเวอร์: 5.5.23
-- รุ่นของ PHP: 5.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- ฐานข้อมูล: `sad`
--
CREATE DATABASE IF NOT EXISTS `sad` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sad`;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `hardwareasset`
--

CREATE TABLE IF NOT EXISTS `hardwareasset` (
  `devicetype` varchar(30) NOT NULL COMMENT 'ประเภท',
  `asset` varchar(30) NOT NULL,
  `devicename` varchar(80) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `convena` varchar(50) NOT NULL,
  `conda` varchar(30) NOT NULL,
  `assetstatus` varchar(30) NOT NULL,
  `pas` varchar(30) NOT NULL,
  `plandate` varchar(30) NOT NULL,
  `lasttrackeddate` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `username` varchar(80) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `account` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `os` varchar(100) NOT NULL,
  `msoff` varchar(70) NOT NULL,
  `msvisio` varchar(70) NOT NULL,
  `prokeywin` varchar(70) NOT NULL,
  `prokeyoff` varchar(70) NOT NULL,
  `prokeyvisio` varchar(70) NOT NULL,
  `serialdisplay` varchar(40) NOT NULL,
  `monitortype` varchar(100) NOT NULL,
  `monitorsize` varchar(100) NOT NULL,
  `rdt` varchar(30) NOT NULL,
  `lmd` varchar(30) NOT NULL,
  `model` varchar(50) NOT NULL,
  `serial` varchar(30) NOT NULL,
  `processor` varchar(100) NOT NULL,
  `totalmem` varchar(30) NOT NULL,
  `storage` varchar(30) NOT NULL,
  `freestorage` varchar(30) NOT NULL,
  `ipadd` varchar(30) NOT NULL,
  `submask` varchar(30) NOT NULL,
  `macaddress` varchar(30) NOT NULL,
  `hostname` varchar(50) NOT NULL,
  `opersys` varchar(130) NOT NULL,
  `displaytype` varchar(100) NOT NULL,
  `displaysize` varchar(100) NOT NULL,
  `displaygraphic` varchar(100) NOT NULL COMMENT 'กาดจอยี่ห้อ',
  `udid` varchar(50) NOT NULL COMMENT 'udid',
  `imei` varchar(50) NOT NULL COMMENT 'imei',
  `iccid` varchar(50) NOT NULL COMMENT 'iccid',
  `conphone` varchar(30) NOT NULL COMMENT 'conphone',
  PRIMARY KEY (`asset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
