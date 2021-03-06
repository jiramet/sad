-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2012 at 09:39 PM
-- Server version: 5.1.50
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sad`
--
CREATE DATABASE `sad` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sad`;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `g_monogram` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อย่อของGroup',
  `g_name` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อเต็มของGroups',
  `g_remark` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT 'คำอธิบาย',
  PRIMARY KEY (`g_monogram`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`g_monogram`, `g_name`, `g_remark`) VALUES
('IT', 'Information Tecnology', 'แผนกกรูเอง.....'),
('mm', 'Matchine Maintenance', 'แผนกซ่อมบำรุง');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสมาชิก',
  `m_username` varchar(50) NOT NULL COMMENT 'ชื่อที่ใช้Login',
  `m_password` varchar(50) NOT NULL COMMENT 'password',
  `m_title` varchar(6) NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `m_name` varchar(100) NOT NULL COMMENT 'ชื่อสมาชิก',
  `m_surname` varchar(100) NOT NULL COMMENT 'นามสกุล',
  `m_email` varchar(100) NOT NULL COMMENT 'อีเมลล์',
  `m_tel` varchar(50) NOT NULL COMMENT 'เบอร์โทร',
  `m_address` varchar(250) NOT NULL COMMENT 'ที่อยู่',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`m_id`, `m_username`, `m_password`, `m_title`, `m_name`, `m_surname`, `m_email`, `m_tel`, `m_address`) VALUES
(1, '', '', '1', 'สมชาย เสงี่ยมศักดิ์', '', 'nu_sangaimsuk_t@mail.nu.ac.th', '0803480843', 'ม.นเรศวร'),
(3, '', '', '2', 'ichat', '', 'support@ichat.in.th', '0803480843', 'ม.นเรศวร'),
(14, 'mandmod', 'l[kpfu', '1', 'ธีระชัย', 'เสือโป๋', 'mandmod', '0816882809', 'บ้านกรู'),
(17, 'test2', 'test23', '1', 'test23', 'test23', 'teste23', 'test23', 'test23'),
(41, 'goldhand', 'l[kpfu', '1', 'ITOnly', 'test', 'itstaff@g-tec.co.th', '391', 'PD'),
(43, 'modtest', 'l[kpfu', '1', 'test', 'test', 'te', 'test', 'test'),
(44, 'katy', 'l[kpfu', '2', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf'),
(45, '123', '12345', '1', '12', '12', '12', '12', '12'),
(46, '123', '12', '1', '12', '12', 'df', 'zc', 'sdf'),
(47, 'jkl', 'hjlk', '1', 'hjkl', 'hjlk', 'hjlk', 'hjlk', 'hjkl'),
(48, 'tiu', 'tyiu', '1', 'tyui', 'tyui', 'tyi', 'tyi', 'tyui'),
(49, 'zxcv', 'zxcv', '1', 'zxcv', 'zxcv', 'zxcv', 'zxcv', 'zxcv'),
(50, '1234', '1234', '1', '1234', '1234', '1234', '1234435', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `mpermission`
--

DROP TABLE IF EXISTS `mpermission`;
CREATE TABLE IF NOT EXISTS `mpermission` (
  `mp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสpermission',
  `mp_mid` varchar(15) CHARACTER SET utf8 NOT NULL COMMENT 'รหัสสมาชิค',
  `mp_wid` int(11) NOT NULL COMMENT 'รหัสหน้า web',
  `mp_wper` int(2) NOT NULL DEFAULT '0' COMMENT 'อนุญาติให้เปิดดูหน้าwebได้',
  `mp_oper` int(2) NOT NULL DEFAULT '0' COMMENT 'อนุญาติให้เปิดดูข้อมูลข้างในได้',
  `mp_aper` int(2) NOT NULL DEFAULT '0' COMMENT 'อนุญาติืให้เพิ่มข้อมูลข้างในได้',
  `mp_eper` int(2) NOT NULL DEFAULT '0' COMMENT 'อนุญาติืให้แก้ไขได้',
  `mp_dper` int(2) NOT NULL DEFAULT '0' COMMENT 'อนุญาติให้ลบได้',
  `mp_sper` int(2) NOT NULL DEFAULT '0' COMMENT 'อนุญาติให้ค้นหาได้',
  PRIMARY KEY (`mp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mpermission`
--

INSERT INTO `mpermission` (`mp_id`, `mp_mid`, `mp_wid`, `mp_wper`, `mp_oper`, `mp_aper`, `mp_eper`, `mp_dper`, `mp_sper`) VALUES
(1, '14', 1, 1, 1, 1, 1, 1, 1),
(2, '14', 3, 1, 1, 1, 1, 1, 1),
(3, '14', 14, 1, 1, 1, 1, 1, 1),
(4, '14', 15, 1, 1, 1, 1, 1, 1),
(5, '1', 1, 1, 1, 1, 1, 1, 1),
(7, '14', 22, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า',
  `p_name` varchar(100) NOT NULL COMMENT 'ชื่อสินค้า',
  `p_price` int(11) NOT NULL COMMENT 'ราคาสินค้า',
  `p_all` int(11) NOT NULL COMMENT 'จำนวนสินค้า',
  `p_save` int(11) NOT NULL COMMENT 'ผู้บันทึก',
  `p_dsave` varchar(20) NOT NULL COMMENT 'วันที่บันทึก',
  `p_note` varchar(300) NOT NULL COMMENT 'ข้อมูลสินค้า',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_price`, `p_all`, `p_save`, `p_dsave`, `p_note`) VALUES
(2, 'ปุ๋ย 24 0 0', 1000, 200, 0, '', 'สูตรมาตรฐาน'),
(3, 'น้ำหอมนำเข้า', 100000, 152, 0, '', 'สินค่าใหม่ล่าสุด');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

DROP TABLE IF EXISTS `title`;
CREATE TABLE IF NOT EXISTS `title` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'No.Title',
  `t_title` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'คำนำหน้านาม',
  `t_remark` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'หมายเหตุ',
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`t_id`, `t_title`, `t_remark`) VALUES
(1, 'นาย', 'นาย'),
(2, 'นาง', 'นาง'),
(3, 'นางสาว', 'หญิงที่ยังไม่ได้แต่งงาน แต่ตอนนี้แต่งงาน ก็ใช้ได้ซะงั้น1'),
(6, 'จ.อ.', '123');

-- --------------------------------------------------------

--
-- Table structure for table `wurl`
--

DROP TABLE IF EXISTS `wurl`;
CREATE TABLE IF NOT EXISTS `wurl` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `w_nmenu` varchar(100) CHARACTER SET utf8 NOT NULL,
  `w_url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `w_urlfull` varchar(20) CHARACTER SET utf8 NOT NULL,
  `w_status` int(1) NOT NULL,
  `w_remark` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `wurl`
--

INSERT INTO `wurl` (`w_id`, `w_nmenu`, `w_url`, `w_urlfull`, `w_status`, `w_remark`) VALUES
(1, 'ระบบสมาชิค', 'member', 'member.php', 1, 'ระบบสมาชิค'),
(3, 'Menu', 'menu', 'menu.php', 1, 'จัดการ menu'),
(22, 'Group', 'gro', 'group.php', 1, 'กำหนดGroup'),
(14, 'สิทธิในการเข้าถึง', 'permis', 'permission', 0, 'สิทธิในการเข้าถึง'),
(15, 'คำนำหน้าชื่อ', 'title', 'title.php', 0, 'คำนำหน้าชื่อ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
