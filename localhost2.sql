-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2012 at 04:48 PM
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
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `g_id` varchar(11) NOT NULL COMMENT 'รหัสกลุ่ม',
  `g_name` varchar(100) NOT NULL COMMENT 'ชื่อกรุป',
  `g_remark` varchar(200) NOT NULL COMMENT 'อธิบาย',
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `m_session` varchar(10) NOT NULL,
  `m_email` varchar(100) NOT NULL COMMENT 'อีเมลล์',
  `m_tel` varchar(50) NOT NULL COMMENT 'เบอร์โทร',
  `m_address` varchar(250) NOT NULL COMMENT 'ที่อยู่',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `member`
--

INSERT DELAYED IGNORE INTO `member` (`m_id`, `m_username`, `m_password`, `m_title`, `m_name`, `m_surname`, `m_session`, `m_email`, `m_tel`, `m_address`) VALUES
(1, '', '', '1', 'สมชาย เสงี่ยมศักดิ์', '', '', 'nu_sangaimsuk_t@mail.nu.ac.th', '0803480843', 'ม.นเรศวร'),
(3, '', '', '2', 'ichat', '', '', 'support@ichat.in.th', '0803480843', 'ม.นเรศวร'),
(14, 'mandmod', 'l[kpfu', '1', 'ธีระชัย', 'เสือโป๋', '', 'mandmod', '0816882809', 'บ้านกรู'),
(16, 'test', 'test', '1', 'test', 'test', '', 'test', 'test', 'test'),
(17, 'test2', 'test2', '2', 'test2', 'test2', '', 'teste2', 'test2', 'test2'),
(18, 'test3', 'l[kpfu', '1', 'therachai', 'sueapo', '', 'itstaff@g-tec.co.th', '0816882809', 'g-tekt eastern co., ltd.');

-- --------------------------------------------------------

--
-- Table structure for table `mpermission`
--

DROP TABLE IF EXISTS `mpermission`;
CREATE TABLE IF NOT EXISTS `mpermission` (
  `mp_id` int(11) NOT NULL COMMENT 'รหัสpermission',
  `mp_mid` int(10) NOT NULL COMMENT 'รหัสสมาชิค',
  `mp_wid` int(11) NOT NULL COMMENT 'รหัสหน้า web',
  `mp_wper` int(2) NOT NULL COMMENT 'อนุญาติให้เปิดดูหน้าwebได้',
  `mp_oper` int(2) NOT NULL COMMENT 'อนุญาติให้เปิดดูข้อมูลข้างในได้',
  `mp_aper` int(2) NOT NULL COMMENT 'อนุญาติืให้เพิ่มข้อมูลข้างในได้',
  `mp_eper` int(2) NOT NULL COMMENT 'อนุญาติืให้แก้ไขได้',
  `mp_dper` int(2) NOT NULL COMMENT 'อนุญาติให้ลบได้',
  `mp_sper` int(2) NOT NULL COMMENT 'อนุญาติให้ค้นหาได้',
  PRIMARY KEY (`mp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการ',
  `o_mid` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `o_pid` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `o_item` int(11) NOT NULL COMMENT 'จำนวนสินค้า',
  `o_price` int(11) NOT NULL COMMENT 'ราคาสินค้า',
  `o_day` tinyint(2) NOT NULL COMMENT 'วันที่ซื้อ',
  `o_month` tinyint(2) NOT NULL COMMENT 'เดือนที่ซื้อ',
  `o_year` int(4) NOT NULL COMMENT 'ปีที่ซื้อ',
  `o_status` tinyint(1) DEFAULT NULL COMMENT 'สถานะการชำระเงิน',
  `o_note` varchar(500) NOT NULL COMMENT 'หมายเหตุ',
  PRIMARY KEY (`o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `orders`
--

INSERT DELAYED IGNORE INTO `orders` (`o_id`, `o_mid`, `o_pid`, `o_item`, `o_price`, `o_day`, `o_month`, `o_year`, `o_status`, `o_note`) VALUES
(10, 14, 3, 1, 99980, 28, 1, 2555, NULL, 'ASD');

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

INSERT DELAYED IGNORE INTO `product` (`p_id`, `p_name`, `p_price`, `p_all`, `p_save`, `p_dsave`, `p_note`) VALUES
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `title`
--

INSERT DELAYED IGNORE INTO `title` (`t_id`, `t_title`, `t_remark`) VALUES
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
  `Status` int(1) NOT NULL,
  `w_remark` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `wurl`
--

INSERT DELAYED IGNORE INTO `wurl` (`w_id`, `w_nmenu`, `w_url`, `w_urlfull`, `Status`, `w_remark`) VALUES
(1, 'ระบบสมาชิค', 'member', 'member.php', 0, 'ระบบสมาชิค'),
(3, 'Menu', 'menu', 'menu.php', 0, 'จัดการ menu'),
(4, 'จัดการสินค้า', 'pro', 'products.php', 0, 'จัดการสินค้า'),
(5, 'บันทึกซื้อขาย', 'order', 'order.php', 0, 'บันทึกซื้อขาย'),
(6, 'ประวัติการซื้อขาย', 'data', 'data.php', 0, 'ประวัติการซื้อขาย'),
(7, 'รายการค้างชำระ', 'nocheng', 'nocheng.php', 0, 'รายการค้างชำระ'),
(14, 'สิทธิในการเข้าถึง', 'permis', 'permission', 0, 'สิทธิในการเข้าถึง');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
