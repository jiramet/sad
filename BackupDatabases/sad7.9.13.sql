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
-- โครงสร้างตาราง `groupper`
--

CREATE TABLE IF NOT EXISTS `groupper` (
  `gp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสGroupper',
  `gp_name` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อ Grouppermission',
  `gp_remark` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT 'หมายเหตุ Permission',
  PRIMARY KEY (`gp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- dump ตาราง `groupper`
--

INSERT INTO `groupper` (`gp_id`, `gp_name`, `gp_remark`) VALUES
(1, 'IT Admin System', 'ผู้จัดการระบบทั้งหมด'),
(2, 'machine maintenance', 'แผนกซ่อมบำรุ่ง');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `g_id` varchar(20) NOT NULL COMMENT 'รหัสกลุ่ม',
  `g_monogram` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อย่อของGroup',
  `g_name` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อเต็มของGroups',
  `g_remark` varchar(300) CHARACTER SET utf8 NOT NULL COMMENT 'หมายเหตุ',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- dump ตาราง `groups`
--

INSERT INTO `groups` (`g_id`, `g_monogram`, `g_name`, `g_remark`) VALUES
('1', 'IT', 'information technology', 'แผนก กรู...'),
('2', 'MM', 'machine maintenance', 'แผนกซ่อมบำรุง');

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

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสมาชิก',
  `m_username` varchar(50) NOT NULL COMMENT 'ชื่อที่ใช้Login',
  `m_password` varchar(50) NOT NULL COMMENT 'password',
  `m_title` varchar(6) NOT NULL COMMENT 'เก็บ ID คำนำหน้าชื่อ',
  `m_name` varchar(100) NOT NULL COMMENT 'ชื่อสมาชิก',
  `m_surname` varchar(100) NOT NULL COMMENT 'นามสกุล',
  `m_email` varchar(100) NOT NULL COMMENT 'อีเมลล์',
  `m_group` varchar(11) NOT NULL COMMENT 'เก็บ ID Group',
  `m_gpid` int(11) NOT NULL,
  `m_tel` varchar(50) NOT NULL COMMENT 'เบอร์โทร',
  `m_address` varchar(250) NOT NULL COMMENT 'ที่อยู่',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

--
-- dump ตาราง `member`
--

INSERT INTO `member` (`m_id`, `m_username`, `m_password`, `m_title`, `m_name`, `m_surname`, `m_email`, `m_group`, `m_gpid`, `m_tel`, `m_address`) VALUES
(14, 'mandmod', 'l[kpfu', '1', 'ธีระชัย', 'เสือโป๋', 'mandmod', '1', 1, '0816882809', 'บ้านกรู'),
(41, 'goldhand', 'l[kpfu', '1', 'ITOnly', 'test', 'itstaff@g-tec.co.th', '1', 1, '391', 'PD'),
(103, 'too', 'too', '1', 'too', '44', 'too', '1', 2, '66', '774'),
(113, 'mod2', 'mod2', '1', 'นายมด', 'แดงดี', 'mandmod@gmail.com', '1', 2, 'g-tec', 'g-tec'),
(114, 'tomonfc', 'tomonfc', '1', 'tomonfc', 'tomonfc', 'tomonfc@hotmail.com', '1', 1, '391', 'asdf'),
(115, 'dell', 'dell', '1', 'dell', 'dell', 'mail@g-tec.co.th', '1', 1, '155', 'it');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `mmprocnt`
--

CREATE TABLE IF NOT EXISTS `mmprocnt` (
  `mm_no` int(10) NOT NULL,
  `mm_matname` varchar(30) NOT NULL,
  `mm_matnum` int(6) NOT NULL,
  PRIMARY KEY (`mm_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `mpermission`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=179 ;

--
-- dump ตาราง `mpermission`
--

INSERT INTO `mpermission` (`mp_id`, `mp_mid`, `mp_wid`, `mp_wper`, `mp_oper`, `mp_aper`, `mp_eper`, `mp_dper`, `mp_sper`) VALUES
(165, '1', 1, 1, 1, 1, 1, 1, 1),
(177, '2', 40, 0, 0, 0, 0, 0, 0),
(176, '2', 39, 0, 0, 0, 0, 0, 0),
(175, '2', 38, 0, 0, 0, 0, 0, 0),
(174, '2', 36, 0, 0, 0, 0, 0, 0),
(173, '2', 14, 1, 0, 0, 0, 0, 0),
(178, '2', 3, 1, 0, 0, 0, 0, 0),
(172, '2', 1, 1, 0, 0, 0, 0, 0),
(171, '', 36, 1, 0, 0, 0, 0, 0),
(170, '', 15, 1, 0, 0, 0, 0, 0),
(169, '', 14, 1, 0, 0, 0, 0, 0),
(168, '', 3, 1, 0, 0, 0, 0, 0),
(167, '', 1, 1, 0, 0, 0, 0, 0),
(166, '1', 40, 1, 1, 1, 1, 1, 1),
(159, '1', 3, 1, 1, 1, 1, 1, 1),
(160, '1', 14, 1, 1, 1, 1, 1, 1),
(161, '1', 15, 1, 1, 1, 1, 1, 1),
(162, '1', 36, 1, 1, 1, 1, 1, 1),
(163, '1', 38, 1, 1, 1, 1, 1, 1),
(164, '1', 39, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product`
--

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
-- dump ตาราง `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_price`, `p_all`, `p_save`, `p_dsave`, `p_note`) VALUES
(2, 'ปุ๋ย 24 0 0', 1000, 200, 0, '', 'สูตรมาตรฐาน'),
(3, 'น้ำหอมนำเข้า', 100000, 152, 0, '', 'สินค่าใหม่ล่าสุด');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'No.Title',
  `t_title` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'คำนำหน้านาม',
  `t_remark` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'หมายเหตุ',
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- dump ตาราง `title`
--

INSERT INTO `title` (`t_id`, `t_title`, `t_remark`) VALUES
(1, 'นาย', 'นาย'),
(2, 'นาง', 'นาง'),
(3, 'นางสาว', 'หญิงที่ยังไม่ได้แต่งงาน แต่ตอนนี้แต่งงาน ก็ใช้ได้ซะงั้น1'),
(14, 'กระเทย', 'กระเทย');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `wurl`
--

CREATE TABLE IF NOT EXISTS `wurl` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `w_nmenu` varchar(100) CHARACTER SET utf8 NOT NULL,
  `w_url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `w_urlfull` varchar(20) CHARACTER SET utf8 NOT NULL,
  `w_status` int(1) NOT NULL,
  `w_remark` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- dump ตาราง `wurl`
--

INSERT INTO `wurl` (`w_id`, `w_nmenu`, `w_url`, `w_urlfull`, `w_status`, `w_remark`) VALUES
(1, 'ระบบสมาชิค', 'member', 'member.php', 1, 'ระบบสมาชิค'),
(3, 'Menu', 'menu', 'menu.php', 1, 'จัดการ menu'),
(14, 'สิทธิในการเข้าถึง', 'permis', 'permission.php', 0, 'สิทธิในการเข้าถึง'),
(15, 'คำนำหน้าชื่อ', 'title', 'title.php', 0, 'คำนำหน้าชื่อ'),
(36, 'Group', 'gro', 'group.php', 0, 'กรุป'),
(40, 'ImportCSV', 'imcsv', 'imcsv.php', 1, 'นำเข้าFile CSV เข้า Database HardwareAsset'),
(38, 'สิทธิในการเข้าถึง Group', 'pergro', 'permissiongroup.php', 0, 'สิทธิในการเข้าถึง Group'),
(39, 'GroupPermission', 'pergroup', 'pergroup.php', 1, 'Group ในการเข้าถึง');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
