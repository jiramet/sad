-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `sad`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `member`
-- 

CREATE TABLE `member` (
  `m_id` int(11) NOT NULL auto_increment COMMENT 'รหัสสมาชิก',
  `m_name` varchar(100) NOT NULL COMMENT 'ชื่อสมาชิก',
  `m_email` varchar(100) NOT NULL COMMENT 'อีเมลล์',
  `m_tel` varchar(50) NOT NULL COMMENT 'เบอร์โทร',
  `m_address` varchar(250) NOT NULL COMMENT 'ที่อยู่',
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `member`
-- 

INSERT INTO `member` VALUES (1, 'สมชาย เสงี่ยมศักดิ์', 'nu_sangaimsuk_t@mail.nu.ac.th', '0803480843', 'ม.นเรศวร');
INSERT INTO `member` VALUES (3, 'ichat', 'support@ichat.in.th', '0803480843', 'ม.นเรศวร');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `orders`
-- 

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL auto_increment COMMENT 'รหัสรายการ',
  `o_mid` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `o_pid` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `o_item` int(11) NOT NULL COMMENT 'จำนวนสินค้า',
  `o_price` int(11) NOT NULL COMMENT 'ราคาสินค้า',
  `o_day` tinyint(2) NOT NULL COMMENT 'วันที่ซื้อ',
  `o_month` tinyint(2) NOT NULL COMMENT 'เดือนที่ซื้อ',
  `o_year` int(4) NOT NULL COMMENT 'ปีที่ซื้อ',
  `o_status` tinyint(1) default NULL COMMENT 'สถานะการชำระเงิน',
  `o_note` varchar(500) NOT NULL COMMENT 'หมายเหตุ',
  PRIMARY KEY  (`o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- dump ตาราง `orders`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `product`
-- 

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL auto_increment COMMENT 'รหัสสินค้า',
  `p_name` varchar(100) NOT NULL COMMENT 'ชื่อสินค้า',
  `p_price` int(11) NOT NULL COMMENT 'ราคาสินค้า',
  `p_all` int(11) NOT NULL COMMENT 'จำนวนสินค้า',
  `p_save` int(11) NOT NULL COMMENT 'ผู้บันทึก',
  `p_dsave` varchar(20) NOT NULL COMMENT 'วันที่บันทึก',
  `p_note` varchar(300) NOT NULL COMMENT 'ข้อมูลสินค้า',
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `product`
-- 

INSERT INTO `product` VALUES (2, 'ปุ๋ย 24 0 0', 1000, 200, 0, '', 'สูตรมาตรฐาน');
INSERT INTO `product` VALUES (3, 'น้ำหอมนำเข้า', 100000, 154, 0, '', 'สินค่าใหม่ล่าสุด');
