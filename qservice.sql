-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2020 at 04:34 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_img`
--

CREATE TABLE `tbl_category_img` (
  `cgimg_id` int(11) NOT NULL,
  `cgimg_name` varchar(20) NOT NULL COMMENT 'ชื่อไฟล์ภาพ',
  `cgimg_code` varchar(20) NOT NULL COMMENT 'โค้ดอ้างอิงหมวดหมู่หลักและหมวดหมู่ย่อย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บรูปภาพหมวดหมู่หลักและหมวดหมู่ย่อย';

--
-- Dumping data for table `tbl_category_img`
--

INSERT INTO `tbl_category_img` (`cgimg_id`, `cgimg_name`, `cgimg_code`) VALUES
(13, 'OCU3F.jpg', 'ZP7H2L0YW7O3GSMHNJ4H'),
(15, 'PLUKDG.jpg', 'ZP7H2L0YW7O3GSMHNJ4H'),
(16, 'VDVNLU.jpg', 'F9KJCCAWHKRI27YEU01P'),
(17, '0ANJO5.jpg', 'JJ0NWSEMJAT648OI3FJQ'),
(18, 'JVS50Y.jpg', 'MKTA17SQ8AKQYOV1K'),
(19, 'RKII4T.jpg', 'IXVY7LYMGYXE5J67HWW6'),
(20, '74Z41M.jpg', 'K8CQ7YZGQB23AGEQ25F'),
(23, 'W9M35F.jpg', 'MOTUS6AW1I409ITWO8'),
(25, 'QWY5B8.jpg', 'A6A6NWP0DG8CGCMEADUI'),
(26, '5OAX8O.jpg', 'JOHWDQPKIE0NP0VM4UUX');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_main`
--

CREATE TABLE `tbl_category_main` (
  `ctgm_id` int(11) NOT NULL,
  `ctgm_code` varchar(20) NOT NULL COMMENT 'โค้ด',
  `ctgm_name` varchar(70) NOT NULL COMMENT 'ชื่อหมวดหมู่หลัก',
  `ctgm_description` text NOT NULL COMMENT 'รายละเอียด',
  `ctgm_status` int(1) NOT NULL COMMENT 'ปิด-เปิด',
  `is_delete` int(1) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ',
  `crt_by` int(11) NOT NULL COMMENT 'สร้างโดย (user_id)	',
  `crt_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `upd_by` int(11) NOT NULL COMMENT 'แก้ไขโดย (user_id)	',
  `upd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไข',
  `cmn_code` varchar(20) NOT NULL COMMENT 'โค้ดข้อมูลบริษัท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางกลุ่มหลัก';

--
-- Dumping data for table `tbl_category_main`
--

INSERT INTO `tbl_category_main` (`ctgm_id`, `ctgm_code`, `ctgm_name`, `ctgm_description`, `ctgm_status`, `is_delete`, `crt_by`, `crt_date`, `upd_by`, `upd_date`, `cmn_code`) VALUES
(1, 'C6IVT6N91QKO5CS4FUM9', 'แผนกไอที', 'ไม่มี', 1, 0, 2, '2019-05-05 16:46:17', 0, '2019-05-24 13:16:59', '7L7AOXL7JI8JCCVKOZBE'),
(2, 'IQJBAN614ZIUQ4K4MV5J', 'การตลาด', '', 1, 1, 2, '2019-05-05 17:18:42', 2, '2019-05-24 13:16:59', '7L7AOXL7JI8JCCVKOZBE'),
(3, 'A6A6NWP0DG8CGCMEADUI', 'ไอที', '', 1, 1, 2, '2019-05-05 18:14:30', 2, '2019-06-03 07:55:43', '7L7AOXL7JI8JCCVKOZBE'),
(4, '7ZKFBGPRHYVKU3PYPDRE', 'บัญชี', '', 1, 1, 2, '2019-05-12 16:48:33', 2, '2019-06-03 07:55:39', '7L7AOXL7JI8JCCVKOZBE'),
(5, '', '', '', 0, 1, 0, '0000-00-00 00:00:00', 0, '2019-05-28 16:01:26', '84L1KUAAOQJL1RTA6PZ'),
(6, 'F9KJCCAWHKRI27YEU01P', 'วิจัย', '', 1, 1, 2, '2019-06-03 14:55:35', 0, '2019-10-16 04:23:50', '7L7AOXL7JI8JCCVKOZBE'),
(8, 'K8CQ7YZGQB23AGEQ25F', 'ขนส่ง', 'ไม่มีจร้า', 1, 1, 2, '2019-10-14 13:29:49', 2, '2019-10-14 06:33:32', '7L7AOXL7JI8JCCVKOZBE'),
(9, 'PW6M5L8MYV4GBKBDP5', 'ตรวจสอบสินค้า', '', 1, 1, 2, '2019-10-14 16:06:09', 2, '2019-10-14 09:06:09', '7L7AOXL7JI8JCCVKOZBE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_sub`
--

CREATE TABLE `tbl_category_sub` (
  `ctgs_id` int(11) NOT NULL,
  `ctgs_code` varchar(20) NOT NULL COMMENT 'โค้ด',
  `ctgs_name` varchar(70) NOT NULL COMMENT 'ชื่อหมวดหมู่ย่อย',
  `ctgs_description` text NOT NULL COMMENT 'รายละเอียด',
  `ctgs_status` int(11) NOT NULL COMMENT 'ปิด-เปิด',
  `is_delete` int(11) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ',
  `crt_by` int(11) NOT NULL COMMENT 'สร้างโดย (user_id)',
  `crt_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `upd_by` int(11) NOT NULL COMMENT 'แก้ไขโดย (user_id)',
  `upd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไข',
  `ctgm_code` varchar(20) NOT NULL COMMENT 'โค้ดหมวดหมู่หลัก',
  `cmn_code` varchar(20) NOT NULL COMMENT 'โค้ดข้อมูลบริษัท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางหมวดหมู่ย่อย';

--
-- Dumping data for table `tbl_category_sub`
--

INSERT INTO `tbl_category_sub` (`ctgs_id`, `ctgs_code`, `ctgs_name`, `ctgs_description`, `ctgs_status`, `is_delete`, `crt_by`, `crt_date`, `upd_by`, `upd_date`, `ctgm_code`, `cmn_code`) VALUES
(1, 'B4LORS336VXPSPIM0T2', 'โปรแกรมเมอรฺ์', '-', 1, 0, 2, '2019-05-05 19:15:16', 0, '2019-05-06 02:15:44', 'IQJBAN614ZIUQ4K4MV5J', '7L7AOXL7JI8JCCVKOZBE'),
(2, 'ZP7H2L0YW7O3GSMHNJ4H', 'ซัพพอต', '-', 1, 1, 2, '2019-05-05 19:35:24', 2, '2019-06-03 16:59:22', 'A6A6NWP0DG8CGCMEADUI', '7L7AOXL7JI8JCCVKOZBE'),
(3, '9IUOX4P69R0I1BBROGNI', 'โปรแกรมเมอร์', '', 1, 1, 2, '2019-05-06 12:54:36', 0, '2019-05-06 05:54:36', 'A6A6NWP0DG8CGCMEADUI', '7L7AOXL7JI8JCCVKOZBE'),
(4, 'X2CU1SD56GB2L8RFYKKN', 'ดิจิทัลการตลาด', '', 1, 1, 2, '2019-05-06 12:54:49', 0, '2019-05-06 05:54:49', 'IQJBAN614ZIUQ4K4MV5J', '7L7AOXL7JI8JCCVKOZBE'),
(5, 'FLPXB366RX2G0BITCX', 'นักวิชากรคอมพิวเตอร์', '', 1, 1, 2, '2019-05-12 16:49:07', 0, '2019-05-12 09:49:07', 'A6A6NWP0DG8CGCMEADUI', '7L7AOXL7JI8JCCVKOZBE'),
(6, '', '', '', 0, 1, 0, '0000-00-00 00:00:00', 0, '2019-05-28 16:01:26', '', '84L1KUAAOQJL1RTA6PZ'),
(7, 'JOHWDQPKIE0NP0VM4UUX', 'เดินสาย', '', 1, 1, 2, '2019-06-04 00:00:40', 2, '2019-10-14 07:06:44', '7ZKFBGPRHYVKU3PYPDRE', '7L7AOXL7JI8JCCVKOZBE'),
(8, 'MOTUS6AW1I409ITWO8', 'หาของกิน', 'ไม่มีจร้า', 1, 0, 2, '2019-10-14 14:13:29', 2, '2019-10-14 08:14:52', 'A6A6NWP0DG8CGCMEADUI', '7L7AOXL7JI8JCCVKOZBE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `cmn_id` int(11) NOT NULL,
  `cmn_code` varchar(20) NOT NULL COMMENT 'รหัสบริษัท',
  `cmn_logo` varchar(20) NOT NULL COMMENT 'Logo',
  `cmn_name` varchar(50) NOT NULL COMMENT 'ชื่อบริษัท /องค์กรณ์',
  `cmn_phone` varchar(15) NOT NULL COMMENT 'เบอร์โทร',
  `cms_address` text NOT NULL COMMENT 'ที่อยู่',
  `cmn_line` varchar(100) NOT NULL COMMENT 'line app',
  `cmn_mail` varchar(100) NOT NULL COMMENT 'อีเมล',
  `cmn_name_main` varchar(120) NOT NULL COMMENT 'หมวดหมู่หลัก',
  `cmn_name_sub` varchar(120) NOT NULL COMMENT 'หมวดหมู่ย่อย',
  `crt_by` int(11) NOT NULL COMMENT 'สร้างโดย (user_id)',
  `crt_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `upd_by` int(11) NOT NULL COMMENT 'แก้ไขโดย (user_id)',
  `upd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไข',
  `cmn_status` int(1) NOT NULL COMMENT 'เปิด-ปิดใช้งาน',
  `is_delete` int(1) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข้อมูลบริษัท';

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`cmn_id`, `cmn_code`, `cmn_logo`, `cmn_name`, `cmn_phone`, `cms_address`, `cmn_line`, `cmn_mail`, `cmn_name_main`, `cmn_name_sub`, `crt_by`, `crt_date`, `upd_by`, `upd_date`, `cmn_status`, `is_delete`) VALUES
(1, '7L7AOXL7JI8JCCVKOZBE', 'J2QQ2V.jpg', 'ไอดีไดรฟ์', '0943908077', '178 หมู่ 8', 'wnqw4IZbS7YEipYPv13sHEcFplqQpBr8cLxy8cXrr6n', '', 'แผนก55', 'ตำแหน่ง', 1, '2019-03-31 11:45:15', 2, '2019-10-16 04:41:47', 0, 1),
(2, 'RIW03ODSO2JTW4R0ZD5', 'II90BA.jpg', 'ฮอกวอต', '0943908055', '1478', '', '', '', '', 1, '2019-03-31 11:48:18', 1, '2019-05-10 03:42:32', 1, 1),
(3, '7S3LD7SEOEZ3P7J5MIXV', 'UGDZ34.jpg', 'ไอดีขอนแก่น', '084454154', '1723', '', '', '', '', 1, '2019-05-12 16:15:51', 1, '2019-05-12 09:17:03', 1, 1),
(4, '84L1KUAAOQJL1RTA6PZ', 'NZDQFI.jpg', 'โรงเรียนสอนขับรถศรีสะเกษ', '094390077', '1584', '', '', '', '', 1, '2019-05-12 16:28:33', 8, '2019-05-28 15:40:27', 1, 1),
(5, 'J599JDU7H5I09SPUV97K', '', '55555555555', 'fsafsa', 'fasfas', '', '', '', '', 1, '2019-09-18 10:52:47', 0, '2019-09-18 03:52:47', 1, 1),
(6, '8ID8SGGEGZA1OYYZYOGI', '', 'fasf', 'asfasf', 'asfasf', '', '', '', '', 1, '2019-09-18 11:06:54', 0, '2019-09-18 04:06:54', 1, 1),
(7, '2343243243', '', 'fsafsa', '0943908077', '128', '', '', '', '', 1, '2019-09-11 00:00:00', 1, '2019-09-10 17:00:00', 1, 1),
(8, '2343243243', '', 'fsafsa', '0943908077', '128', '', '', '', '', 1, '2019-09-11 00:00:00', 1, '2019-09-10 17:00:00', 1, 1),
(9, '2343243243', '', 'fsafsa', '0943908077', '128', '', '', '', '', 1, '2019-09-11 00:00:00', 1, '2019-09-10 17:00:00', 1, 1),
(10, 'E86HJPJ6JZK0KV9UYH5', '', 'sfasaf', 'asfasf', 'asfas', '', '', '', '', 1, '2019-09-18 12:01:18', 0, '2019-09-18 05:01:18', 1, 1),
(11, '4ZMZ6F41Y3RXM6F49YBI', '', 'rfafas', 'fasfas', 'fasfasf', '', '', '', '', 1, '2019-09-18 12:04:07', 0, '2019-09-18 05:04:07', 1, 1),
(12, 'DLURR0RKRQDZ4KNPFAQ5', '', 'sfasaf', 'asfasf', 'asfas', '', '', '', '', 1, '2019-09-18 13:12:16', 0, '2019-09-18 06:12:16', 1, 1),
(13, 'Q3A1MWTR3CMQESQEN2', '', 'fasfsa', 'fasfsafsafsafa', 'sfsaf', '', '', '', '', 1, '2019-09-21 11:02:49', 0, '2019-09-21 04:02:49', 1, 1),
(14, 'DS9ICSY1QK140VPTN56', '', 'test', '1213', '131', '', '', '', '', 1, '2019-09-21 11:03:11', 0, '2019-09-21 04:03:11', 1, 1),
(15, 'GAB2KL09YTP9VDDKL7N8', '', '1111', '2223', '1212', '', '', '', '', 1, '2019-09-21 11:21:36', 0, '2019-09-21 04:21:36', 1, 1),
(16, 'Z5P10E8ZR8P5J43RD1Z0', '', 'Test2', '0943908077', '178', '', '', '', '', 1, '2019-09-21 11:24:18', 0, '2019-09-21 04:24:18', 1, 1),
(17, 'AF91YNLDUJWKH85U41', '', 'อนันต์ปลาเผา', '0943908077', '178 หมู่ 8 ', '51fsd5afasfafasf5656', '', '', '', 1, '2019-10-15 10:50:38', 1, '2019-10-15 03:52:34', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config_general`
--

CREATE TABLE `tbl_config_general` (
  `cgr_id` int(11) NOT NULL,
  `cgr_name` varchar(75) NOT NULL COMMENT 'ชื่อการตั้งค่า',
  `cgr_value` varchar(75) NOT NULL COMMENT 'ค่าที่แสดง',
  `cgr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตั้งค่าทั่วไป';

--
-- Dumping data for table `tbl_config_general`
--

INSERT INTO `tbl_config_general` (`cgr_id`, `cgr_name`, `cgr_value`, `cgr_date`) VALUES
(1, 'E-mail', 'siwakorn167@gmail.com', '2019-10-14 12:19:39'),
(2, 'Line Notify  (รหัส Token)', '--', '2019-10-14 12:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_cach`
--

CREATE TABLE `tbl_evaluation_cach` (
  `evalc_id` int(11) NOT NULL,
  `evalc_value` int(1) NOT NULL COMMENT 'ตัวเลขการประเมิน',
  `evalc_comment` text NOT NULL COMMENT 'ความคิดเห็น',
  `eltda_id` int(11) NOT NULL COMMENT 'tbl_evaluation_data',
  `eltp_code` varchar(20) NOT NULL COMMENT 'โค้ดหัวข้อแบบประเมิน	',
  `evltp_code` varchar(20) NOT NULL COMMENT 'ใช้แทน user_code,ctgm_code,ctgs_code	',
  `cmn_code` varchar(20) NOT NULL COMMENT 'โค้ดข้อมูลบริษัท',
  `ip_device` varchar(25) NOT NULL COMMENT 'ip อุปกรณ์',
  `evalc_code` varchar(20) NOT NULL COMMENT 'รหัสสร้างตัวแปรโค้ดสาธารณะอ้างอิง	',
  `evalc_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'เวลาที่บันทึก',
  `evalc_status` int(1) NOT NULL COMMENT 'สถานะการทำเสร็จ 0 ยังไม่เสร็จ 1 เสร็จแล้ว',
  `evalc_index` int(3) NOT NULL COMMENT 'ข้อที่ทำ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลรายละเอียดในการประเมิน';

--
-- Dumping data for table `tbl_evaluation_cach`
--

INSERT INTO `tbl_evaluation_cach` (`evalc_id`, `evalc_value`, `evalc_comment`, `eltda_id`, `eltp_code`, `evltp_code`, `cmn_code`, `ip_device`, `evalc_code`, `evalc_date`, `evalc_status`, `evalc_index`) VALUES
(1, 5, '', 49, 'LC60Z2U0ROZANR4M1JZ9', '7ZKFBGPRHYVKU3PYPDRE', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '07EEZN6FCJDMQNJ78T72', '2019-10-16 09:27:04', 1, 1),
(2, 3, '01944545', 49, 'LC60Z2U0ROZANR4M1JZ9', 'F9KJCCAWHKRI27YEU01P', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'PI20BTV1FFIZBB98TCDW', '2019-10-16 09:27:26', 1, 1),
(3, 5, '09+1515', 49, 'LC60Z2U0ROZANR4M1JZ9', 'F9KJCCAWHKRI27YEU01P', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'WID2QWOXJM2KT2YR4R16', '2019-10-16 09:27:56', 1, 1),
(4, 1, '', 49, 'LC60Z2U0ROZANR4M1JZ9', '7ZKFBGPRHYVKU3PYPDRE', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'EUI9B3G35RJBYCN2GXK3', '2019-10-16 09:30:40', 1, 1),
(5, 1, 'จร้าๆ', 49, 'LC60Z2U0ROZANR4M1JZ9', 'F9KJCCAWHKRI27YEU01P', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'Q0OFVTZJNAX0YIRY9VD', '2019-10-16 09:31:10', 1, 1),
(6, 4, '', 43, '6FGHY3QYTZLIASBKROY5', '3EXHKMA2M3CNBFONCI', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '53DF26W0GKPQYJQM0M', '2019-10-17 07:19:20', 1, 1),
(7, 5, '', 44, '6FGHY3QYTZLIASBKROY5', '3EXHKMA2M3CNBFONCI', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '53DF26W0GKPQYJQM0M', '2019-10-17 07:19:20', 1, 2),
(8, 3, '', 45, '6FGHY3QYTZLIASBKROY5', '3EXHKMA2M3CNBFONCI', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '53DF26W0GKPQYJQM0M', '2019-10-17 07:19:20', 1, 3),
(9, 4, '', 46, '6FGHY3QYTZLIASBKROY5', '3EXHKMA2M3CNBFONCI', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '53DF26W0GKPQYJQM0M', '2019-10-17 07:19:20', 1, 4),
(10, 5, '', 47, '6FGHY3QYTZLIASBKROY5', '3EXHKMA2M3CNBFONCI', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '53DF26W0GKPQYJQM0M', '2019-10-17 07:19:20', 1, 5),
(11, 4, '', 48, '6FGHY3QYTZLIASBKROY5', '3EXHKMA2M3CNBFONCI', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '53DF26W0GKPQYJQM0M', '2019-10-17 07:19:20', 1, 6),
(12, 4, '', 20, 'UGII54ULUHP4XLCIQ5O0', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'YIR8CT7HD54UZ9U6A9DF', '2019-10-27 13:28:33', 1, 1),
(13, 3, '', 19, 'UGII54ULUHP4XLCIQ5O0', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'YIR8CT7HD54UZ9U6A9DF', '2019-10-27 13:28:33', 1, 2),
(14, 4, '', 21, 'UGII54ULUHP4XLCIQ5O0', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'YIR8CT7HD54UZ9U6A9DF', '2019-10-27 13:28:33', 1, 3),
(15, 5, '', 22, 'UGII54ULUHP4XLCIQ5O0', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'YIR8CT7HD54UZ9U6A9DF', '2019-10-27 13:28:33', 1, 4),
(16, 3, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'RDW4SVI3EA93CAULQ8GA', '2019-10-29 05:35:26', 1, 1),
(17, 4, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'RDW4SVI3EA93CAULQ8GA', '2019-10-29 05:35:26', 1, 2),
(18, 4, '', 49, 'LC60Z2U0ROZANR4M1JZ9', 'A6A6NWP0DG8CGCMEADUI', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '8AUSVU6AITXD4Y96T57', '2019-10-29 09:49:56', 1, 1),
(19, 4, '', 24, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'DPZNOTCBIAD38CF49JPC', '2019-10-29 10:37:48', 1, 1),
(20, 3, '', 23, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'DPZNOTCBIAD38CF49JPC', '2019-10-29 10:37:48', 1, 2),
(21, 4, '', 26, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'DPZNOTCBIAD38CF49JPC', '2019-10-29 10:37:48', 1, 3),
(22, 1, '', 25, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'DPZNOTCBIAD38CF49JPC', '2019-10-29 10:37:48', 1, 4),
(23, 2, '', 24, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'CJ2OO72QB6EEMZOB2TYK', '2019-10-29 11:39:46', 1, 1),
(24, 3, '', 23, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'CJ2OO72QB6EEMZOB2TYK', '2019-10-29 11:39:46', 1, 2),
(25, 4, '', 26, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'CJ2OO72QB6EEMZOB2TYK', '2019-10-29 11:39:46', 1, 3),
(26, 5, '', 25, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'CJ2OO72QB6EEMZOB2TYK', '2019-10-29 11:39:46', 1, 4),
(27, 3, '', 24, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '80FGVFX556DKFV6UIDNE', '2019-10-29 11:45:54', 1, 1),
(28, 3, '', 23, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '80FGVFX556DKFV6UIDNE', '2019-10-29 11:45:54', 1, 2),
(29, 4, '', 26, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '80FGVFX556DKFV6UIDNE', '2019-10-29 11:45:54', 1, 3),
(30, 3, '', 25, 'BBXZ52ZS8FBF8I7Q856K', 'i', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '80FGVFX556DKFV6UIDNE', '2019-10-29 11:45:54', 1, 4),
(31, 3, '', 34, '2YLIS73RR4LDZOQ1VZ', 'VBIVBZB2LIB49TGDVHU8', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'JFQWYBBW8UQHBEXAW8', '2019-10-29 11:46:53', 1, 1),
(32, 4, '', 35, '2YLIS73RR4LDZOQ1VZ', 'VBIVBZB2LIB49TGDVHU8', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'JFQWYBBW8UQHBEXAW8', '2019-10-29 11:46:53', 1, 2),
(33, 3, '', 36, '2YLIS73RR4LDZOQ1VZ', 'VBIVBZB2LIB49TGDVHU8', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'JFQWYBBW8UQHBEXAW8', '2019-10-29 11:46:53', 1, 3),
(34, 4, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'WIXHMTTOQ0QUQLO6UWPY', '2019-11-02 03:42:35', 1, 1),
(35, 5, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'WIXHMTTOQ0QUQLO6UWPY', '2019-11-02 03:42:42', 1, 2),
(36, 4, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '3XV0YJUKGKB6E535B95J', '2019-11-02 04:20:14', 1, 1),
(37, 3, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '3XV0YJUKGKB6E535B95J', '2019-11-02 04:19:36', 1, 2),
(38, 3, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'UK7N406W9JNRVOG4SMJ7', '2019-11-02 04:29:37', 1, 1),
(39, 4, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'UK7N406W9JNRVOG4SMJ7', '2019-11-02 04:29:37', 1, 2),
(40, 3, '', 0, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'UK7N406W9JNRVOG4SMJ7', '2019-11-02 04:29:37', 1, 3),
(41, 4, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'DV02MYSRV9E43QNWK13', '2019-11-02 04:32:21', 1, 1),
(42, 5, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'DV02MYSRV9E43QNWK13', '2019-11-02 04:32:21', 1, 2),
(43, 4, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'E8G6CL1UK9KL6NJ9VCH', '2019-11-02 04:47:13', 1, 1),
(44, 3, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'E8G6CL1UK9KL6NJ9VCH', '2019-11-02 04:47:13', 1, 2),
(45, 4, '', 0, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'E8G6CL1UK9KL6NJ9VCH', '2019-11-02 04:47:13', 1, 3),
(46, 4, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '2MI7TTO62QSAJME1T0KM', '2019-11-02 04:57:22', 1, 1),
(47, 3, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '2MI7TTO62QSAJME1T0KM', '2019-11-02 04:57:22', 1, 2),
(48, 3, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'F2T6ASSX46Q7DWBF3IIW', '2019-11-02 04:57:55', 1, 1),
(49, 3, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '9JGB59EKSEKHW15ZFC8B', '2019-11-02 05:05:44', 1, 1),
(50, 3, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', '9JGB59EKSEKHW15ZFC8B', '2019-11-02 05:05:44', 1, 2),
(51, 3, '', 56, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'QDGFKORU76CYRPTDFG', '2019-11-02 05:06:55', 1, 1),
(52, 4, '', 57, 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '7L7AOXL7JI8JCCVKOZBE', '127.0.0.1', 'QDGFKORU76CYRPTDFG', '2019-11-02 05:06:55', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_data`
--

CREATE TABLE `tbl_evaluation_data` (
  `eltda_id` int(11) NOT NULL,
  `eltda_name` text NOT NULL COMMENT 'ข้อมูลประเมิน',
  `eltda_index` int(3) NOT NULL COMMENT 'จัดเรียงลำดับ',
  `is_delete` int(1) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ',
  `eltp_code` varchar(20) NOT NULL COMMENT 'โค้ดหัวข้อแบบประเมิน',
  `cmn_code` varchar(20) NOT NULL COMMENT 'โค้ดข้อมูลบริษัท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข้อมูลแบบฟอร์มประเมิน';

--
-- Dumping data for table `tbl_evaluation_data`
--

INSERT INTO `tbl_evaluation_data` (`eltda_id`, `eltda_name`, `eltda_index`, `is_delete`, `eltp_code`, `cmn_code`) VALUES
(1, 'ความสะอาด', 2, 1, 'XNSELZL8L1POJCKRKD1Z', '7L7AOXL7JI8JCCVKOZBE'),
(2, 'การแต่งกาย', 1, 1, 'XNSELZL8L1POJCKRKD1Z', '7L7AOXL7JI8JCCVKOZBE'),
(3, 'การพูดจา', 6, 1, 'XNSELZL8L1POJCKRKD1Z', '7L7AOXL7JI8JCCVKOZBE'),
(4, 'ความพร้อมในการทำงาน', 3, 1, 'XNSELZL8L1POJCKRKD1Z', '7L7AOXL7JI8JCCVKOZBE'),
(5, 'ความขยัน', 4, 1, 'XNSELZL8L1POJCKRKD1Z', '7L7AOXL7JI8JCCVKOZBE'),
(6, 'ความตรงต่อเวลา', 5, 1, 'XNSELZL8L1POJCKRKD1Z', '7L7AOXL7JI8JCCVKOZBE'),
(7, 'มีแต่งานด่วน', 1, 1, 'KHB0QL1DQU0R1V799', '7L7AOXL7JI8JCCVKOZBE'),
(8, 'การพูดจา', 1, 1, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(9, 'จร้า', 1, 0, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(10, 'การแต่งกาย', 1, 1, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(11, 'การตรงต่อเวลา', 1, 1, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(12, 'ความรับผิดชอบงาน', 1, 1, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(13, 'ความสะอาด', 1, 1, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(14, 'ซัพพอตทำงานไม่ได้เรื่อง', 1, 1, 'KHB0QL1DQU0R1V799', '7L7AOXL7JI8JCCVKOZBE'),
(15, 'การไร้สาระ', 1, 1, 'KHB0QL1DQU0R1V799', '7L7AOXL7JI8JCCVKOZBE'),
(16, 'พนักงานทำตัวไม่น่ารัก', 1, 1, 'KHB0QL1DQU0R1V799', '7L7AOXL7JI8JCCVKOZBE'),
(17, 'อิอิ', 1, 1, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(18, 'น้องเฌอ', 4, 1, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(19, 'การบริการ', 2, 1, 'UGII54ULUHP4XLCIQ5O0', '7L7AOXL7JI8JCCVKOZBE'),
(20, 'การพูดจา', 1, 1, 'UGII54ULUHP4XLCIQ5O0', '7L7AOXL7JI8JCCVKOZBE'),
(21, 'การตรงต่อเวลา', 3, 1, 'UGII54ULUHP4XLCIQ5O0', '7L7AOXL7JI8JCCVKOZBE'),
(22, 'ความรัก', 4, 1, 'UGII54ULUHP4XLCIQ5O0', '7L7AOXL7JI8JCCVKOZBE'),
(23, 'การพูดจาของพนักงาน', 2, 1, 'BBXZ52ZS8FBF8I7Q856K', '7L7AOXL7JI8JCCVKOZBE'),
(24, 'การตรงต่อเวลาของพนัีกงาน', 1, 1, 'BBXZ52ZS8FBF8I7Q856K', '7L7AOXL7JI8JCCVKOZBE'),
(25, 'ความสามัคคี', 4, 1, 'BBXZ52ZS8FBF8I7Q856K', '7L7AOXL7JI8JCCVKOZBE'),
(26, 'ประหยัดอดออม', 3, 1, 'BBXZ52ZS8FBF8I7Q856K', '7L7AOXL7JI8JCCVKOZBE'),
(27, 'ความสามัคคี', 1, 1, '9YEOVUEU25VL67L65DA0', '7L7AOXL7JI8JCCVKOZBE'),
(28, 'ความรักในแผนก', 1, 1, '9YEOVUEU25VL67L65DA0', '7L7AOXL7JI8JCCVKOZBE'),
(29, 'การพูด', 1, 1, '9YEOVUEU25VL67L65DA0', '7L7AOXL7JI8JCCVKOZBE'),
(30, 'ความสามัคคี', 1, 1, 'XFZQRKW7UILV6W0QIZ0', '7L7AOXL7JI8JCCVKOZBE'),
(31, 'การตรงต่อเวลา', 1, 1, 'XFZQRKW7UILV6W0QIZ0', '7L7AOXL7JI8JCCVKOZBE'),
(32, 'การพูดจา', 1, 1, 'XFZQRKW7UILV6W0QIZ0', '7L7AOXL7JI8JCCVKOZBE'),
(33, 'พนักงานน่ารักหรือไม่', 1, 1, 'XFZQRKW7UILV6W0QIZ0', '7L7AOXL7JI8JCCVKOZBE'),
(34, 'ความสามัคคี', 1, 1, '2YLIS73RR4LDZOQ1VZ', '7L7AOXL7JI8JCCVKOZBE'),
(35, 'น่ารักหรือไม่', 1, 1, '2YLIS73RR4LDZOQ1VZ', '7L7AOXL7JI8JCCVKOZBE'),
(36, 'การตรงต่อเวลา', 1, 1, '2YLIS73RR4LDZOQ1VZ', '7L7AOXL7JI8JCCVKOZBE'),
(37, 'progress งาน', 1, 1, 'NBQ4A091LELNC84UCVG2', '7L7AOXL7JI8JCCVKOZBE'),
(38, 'รีวิว paper', 1, 1, 'NBQ4A091LELNC84UCVG2', '7L7AOXL7JI8JCCVKOZBE'),
(39, 'การอ้างอิง', 1, 1, 'NBQ4A091LELNC84UCVG2', '7L7AOXL7JI8JCCVKOZBE'),
(40, 'การ conference', 1, 1, 'NBQ4A091LELNC84UCVG2', '7L7AOXL7JI8JCCVKOZBE'),
(41, 'จริยธรรมในงานวิจัย', 1, 1, 'NBQ4A091LELNC84UCVG2', '7L7AOXL7JI8JCCVKOZBE'),
(42, 'การพูดจา', 1, 1, '3P7Y4QIN73NGTKVDMIK0', '7S3LD7SEOEZ3P7J5MIXV'),
(43, 'การเตรียมตัวและความพร้อมของวิทยากร', 1, 0, '6FGHY3QYTZLIASBKROY5', '7L7AOXL7JI8JCCVKOZBE'),
(44, 'การถ่ายทอดของวิทยากร', 1, 0, '6FGHY3QYTZLIASBKROY5', '7L7AOXL7JI8JCCVKOZBE'),
(45, 'สามารถอธิบายเนื้อหาได้ชัดเจนและตรงประเด็น', 1, 1, '6FGHY3QYTZLIASBKROY5', '7L7AOXL7JI8JCCVKOZBE'),
(46, 'ใช้ภาษาที่เหมาะสมและเข้าใจง่าย', 1, 1, '6FGHY3QYTZLIASBKROY5', '7L7AOXL7JI8JCCVKOZBE'),
(47, 'การตอบคาถามของวิทยากร', 1, 1, '6FGHY3QYTZLIASBKROY5', '7L7AOXL7JI8JCCVKOZBE'),
(48, 'เอกสารประกอบการบรรยายเหมาะสม', 1, 1, '6FGHY3QYTZLIASBKROY5', '7L7AOXL7JI8JCCVKOZBE'),
(49, 'การพูดจา', 1, 1, 'LC60Z2U0ROZANR4M1JZ9', '7L7AOXL7JI8JCCVKOZBE'),
(50, 'ทดสอบ', 2, 1, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(51, 'จร้า', 1, 0, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(52, 'เเเ', 1, 0, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(53, '444', 1, 0, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(54, '555', 3, 1, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(55, 'แก้ว', 9, 1, 'JRXLX3UBTOXVYZ8B5', '7L7AOXL7JI8JCCVKOZBE'),
(56, 'การวิ่ง', 1, 1, 'B2EBLEAUFIHYBETAZ54H', '7L7AOXL7JI8JCCVKOZBE'),
(57, 'การพูด', 2, 1, 'B2EBLEAUFIHYBETAZ54H', '7L7AOXL7JI8JCCVKOZBE'),
(58, 'addslashes', 2, 0, 'LC60Z2U0ROZANR4M1JZ9', '7L7AOXL7JI8JCCVKOZBE'),
(59, ' kinn\'s the buta', 3, 1, 'LC60Z2U0ROZANR4M1JZ9', '7L7AOXL7JI8JCCVKOZBE'),
(60, 'ตัวอย่างชื่อร้าน kinn\'s the buta ตัวอย่างคำถาม You\'ll eat again.', 4, 0, 'LC60Z2U0ROZANR4M1JZ9', '7L7AOXL7JI8JCCVKOZBE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_permission`
--

CREATE TABLE `tbl_evaluation_permission` (
  `evltp_id` int(11) NOT NULL,
  `cmn_code` varchar(20) NOT NULL COMMENT 'โค้ดบริษัท',
  `eltp_code` varchar(20) NOT NULL COMMENT 'โค้ดหัวข้อแบบประเมิน',
  `evltp_code` varchar(20) NOT NULL COMMENT 'ใช้แทน user_code,ctgm_code,ctgs_code'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางกำหนดสิทธิ์แบบประเมิน';

--
-- Dumping data for table `tbl_evaluation_permission`
--

INSERT INTO `tbl_evaluation_permission` (`evltp_id`, `cmn_code`, `eltp_code`, `evltp_code`) VALUES
(47, '7L7AOXL7JI8JCCVKOZBE', 'XNSELZL8L1POJCKRKD1Z', 'A6A6NWP0DG8CGCMEADUI'),
(48, '7L7AOXL7JI8JCCVKOZBE', 'XNSELZL8L1POJCKRKD1Z', 'IQJBAN614ZIUQ4K4MV5J'),
(49, '7L7AOXL7JI8JCCVKOZBE', 'KHB0QL1DQU0R1V799', 'X2CU1SD56GB2L8RFYKKN'),
(57, '7L7AOXL7JI8JCCVKOZBE', 'IJ64UFYVK75PSDDPJ7PJ', 'NAJ3RBIIIBTIY0M8SJ'),
(58, '7L7AOXL7JI8JCCVKOZBE', 'IJ64UFYVK75PSDDPJ7PJ', '3EXHKMA2M3CNBFONCI'),
(60, '7L7AOXL7JI8JCCVKOZBE', 'IJ64UFYVK75PSDDPJ7PJ', 'PJL6PVP6CD9O3ZI0MQ4D'),
(61, '7L7AOXL7JI8JCCVKOZBE', 'KHB0QL1DQU0R1V799', '9IUOX4P69R0I1BBROGNI'),
(62, '7L7AOXL7JI8JCCVKOZBE', 'KHB0QL1DQU0R1V799', 'ZP7H2L0YW7O3GSMHNJ4H'),
(64, '7L7AOXL7JI8JCCVKOZBE', '9YEOVUEU25VL67L65DA0', '7ZKFBGPRHYVKU3PYPDRE'),
(65, '7L7AOXL7JI8JCCVKOZBE', '9YEOVUEU25VL67L65DA0', 'A6A6NWP0DG8CGCMEADUI'),
(67, '7L7AOXL7JI8JCCVKOZBE', 'XFZQRKW7UILV6W0QIZ0', 'FLPXB366RX2G0BITCX'),
(68, '7L7AOXL7JI8JCCVKOZBE', 'XFZQRKW7UILV6W0QIZ0', '9IUOX4P69R0I1BBROGNI'),
(69, '7L7AOXL7JI8JCCVKOZBE', 'XFZQRKW7UILV6W0QIZ0', 'ZP7H2L0YW7O3GSMHNJ4H'),
(70, '7L7AOXL7JI8JCCVKOZBE', 'XFZQRKW7UILV6W0QIZ0', 'X2CU1SD56GB2L8RFYKKN'),
(73, '7L7AOXL7JI8JCCVKOZBE', '2YLIS73RR4LDZOQ1VZ', 'NAJ3RBIIIBTIY0M8SJ'),
(74, '7L7AOXL7JI8JCCVKOZBE', '2YLIS73RR4LDZOQ1VZ', '3EXHKMA2M3CNBFONCI'),
(75, '7L7AOXL7JI8JCCVKOZBE', '2YLIS73RR4LDZOQ1VZ', 'PJL6PVP6CD9O3ZI0MQ4D'),
(76, '7L7AOXL7JI8JCCVKOZBE', '2YLIS73RR4LDZOQ1VZ', 'MXQ3C99FDBGDBCMRXFNX'),
(77, '7L7AOXL7JI8JCCVKOZBE', 'NBQ4A091LELNC84UCVG2', '7ZKFBGPRHYVKU3PYPDRE'),
(78, '7L7AOXL7JI8JCCVKOZBE', '9YEOVUEU25VL67L65DA0', 'IQJBAN614ZIUQ4K4MV5J'),
(79, '7L7AOXL7JI8JCCVKOZBE', '9YEOVUEU25VL67L65DA0', 'F9KJCCAWHKRI27YEU01P'),
(80, '7L7AOXL7JI8JCCVKOZBE', '2YLIS73RR4LDZOQ1VZ', 'VBIVBZB2LIB49TGDVHU8'),
(176, '7L7AOXL7JI8JCCVKOZBE', '6FGHY3QYTZLIASBKROY5', '9GKNOEELJD2J12IK1OI8'),
(177, '7L7AOXL7JI8JCCVKOZBE', '6FGHY3QYTZLIASBKROY5', 'MXQ3C99FDBGDBCMRXFNX'),
(178, '7L7AOXL7JI8JCCVKOZBE', '6FGHY3QYTZLIASBKROY5', 'PJL6PVP6CD9O3ZI0MQ4D'),
(179, '7L7AOXL7JI8JCCVKOZBE', '6FGHY3QYTZLIASBKROY5', '3EXHKMA2M3CNBFONCI'),
(187, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', 'F9KJCCAWHKRI27YEU01P'),
(188, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', '7ZKFBGPRHYVKU3PYPDRE'),
(189, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', 'A6A6NWP0DG8CGCMEADUI'),
(194, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_result`
--

CREATE TABLE `tbl_evaluation_result` (
  `evltr_id` int(11) NOT NULL,
  `evltr_avg` double NOT NULL COMMENT 'เฉลียการประเมิน',
  `cmn_code` varchar(20) NOT NULL COMMENT 'รหัส /บริษัท/องค์กรณ์',
  `eltp_code` varchar(20) NOT NULL COMMENT 'รหัสหัวข้อประเมิน',
  `evltp_code` varchar(20) NOT NULL COMMENT 'ใช้แทน user_code,ctgm_code,ctgs_code',
  `evltp_phone` varchar(20) NOT NULL COMMENT 'เบอร์โทร',
  `evltp_remark` text NOT NULL COMMENT 'ข้อเสนอแนะเพิ่มเติม',
  `evltp_ip` varchar(25) NOT NULL COMMENT 'ip อุปกรณ์ของ User ที่ทำ',
  `evltp_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่ประเมิน',
  `evltp_user_agent` varchar(300) NOT NULL COMMENT 'อุปกรณ์',
  `evltp_user_code` varchar(100) NOT NULL COMMENT 'รหัสสร้างตัวแปรโค้ดสาธารณะอ้างอิง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางผลการประเมิน';

--
-- Dumping data for table `tbl_evaluation_result`
--

INSERT INTO `tbl_evaluation_result` (`evltr_id`, `evltr_avg`, `cmn_code`, `eltp_code`, `evltp_code`, `evltp_phone`, `evltp_remark`, `evltp_ip`, `evltp_date`, `evltp_user_agent`, `evltp_user_code`) VALUES
(1, 5, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', '7ZKFBGPRHYVKU3PYPDRE', '0943908077', '', '127.0.0.1', '2019-10-16 09:27:08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36 OPR/63.0.3368.107', '07EEZN6FCJDMQNJ78T72'),
(2, 3, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', 'F9KJCCAWHKRI27YEU01P', '0943908077', '', '127.0.0.1', '2019-10-16 09:27:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36 OPR/63.0.3368.107', 'PI20BTV1FFIZBB98TCDW'),
(3, 4, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', 'F9KJCCAWHKRI27YEU01P', '036464', '', '127.0.0.1', '2019-10-16 09:27:59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36 OPR/63.0.3368.107', 'WID2QWOXJM2KT2YR4R16'),
(4, 3, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', '7ZKFBGPRHYVKU3PYPDRE', '0943908077', '', '127.0.0.1', '2019-10-16 09:30:44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36 OPR/63.0.3368.107', 'EUI9B3G35RJBYCN2GXK3'),
(5, 3, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', 'F9KJCCAWHKRI27YEU01P', '094398041', '', '127.0.0.1', '2019-10-16 09:31:16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36 OPR/63.0.3368.107', 'Q0OFVTZJNAX0YIRY9VD'),
(6, 3, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', 'F9KJCCAWHKRI27YEU01P', '', '', '127.0.0.1', '2019-10-16 09:33:01', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'U2S1WS2LLBQ5FIFJFJWP'),
(7, 4.1667, '7L7AOXL7JI8JCCVKOZBE', '6FGHY3QYTZLIASBKROY5', '3EXHKMA2M3CNBFONCI', '0465454545', '', '127.0.0.1', '2019-10-17 07:19:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', '53DF26W0GKPQYJQM0M'),
(8, 4, '7L7AOXL7JI8JCCVKOZBE', 'UGII54ULUHP4XLCIQ5O0', 'i', '09469841212', '', '127.0.0.1', '2019-10-27 13:28:36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'YIR8CT7HD54UZ9U6A9DF'),
(9, 3.5, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '0943908077', 'รักนะ ', '127.0.0.1', '2019-10-29 05:35:38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'RDW4SVI3EA93CAULQ8GA'),
(10, 4, '7L7AOXL7JI8JCCVKOZBE', 'LC60Z2U0ROZANR4M1JZ9', 'A6A6NWP0DG8CGCMEADUI', '094195495496', 'รักน้อง', '127.0.0.1', '2019-10-29 09:52:20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', '8AUSVU6AITXD4Y96T57'),
(11, 3, '7L7AOXL7JI8JCCVKOZBE', 'BBXZ52ZS8FBF8I7Q856K', 'i', '0946121251', '', '127.0.0.1', '2019-10-29 10:37:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'DPZNOTCBIAD38CF49JPC'),
(12, 3.25, '7L7AOXL7JI8JCCVKOZBE', 'BBXZ52ZS8FBF8I7Q856K', 'i', '094344545524', '', '127.0.0.1', '2019-10-29 11:44:46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'CJ2OO72QB6EEMZOB2TYK'),
(13, 3.25, '7L7AOXL7JI8JCCVKOZBE', 'BBXZ52ZS8FBF8I7Q856K', 'i', '109484484', '', '127.0.0.1', '2019-10-29 11:45:57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', '80FGVFX556DKFV6UIDNE'),
(14, 3.3333, '7L7AOXL7JI8JCCVKOZBE', '2YLIS73RR4LDZOQ1VZ', 'VBIVBZB2LIB49TGDVHU8', '09598484', '', '127.0.0.1', '2019-10-29 11:46:56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'JFQWYBBW8UQHBEXAW8'),
(15, 3.5, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '0945454545', '', '127.0.0.1', '2019-11-02 03:54:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', 'WIXHMTTOQ0QUQLO6UWPY'),
(16, 4, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '094894848', '', '127.0.0.1', '2019-11-02 04:25:01', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', '3XV0YJUKGKB6E535B95J'),
(17, 3.6667, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '09445454', '', '127.0.0.1', '2019-11-02 04:29:37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', 'UK7N406W9JNRVOG4SMJ7'),
(18, 3.8182, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '0944154', '', '127.0.0.1', '2019-11-02 04:32:21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', 'DV02MYSRV9E43QNWK13'),
(19, 3.7692, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '09454545', '', '127.0.0.1', '2019-11-02 04:47:13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', 'E8G6CL1UK9KL6NJ9VCH'),
(20, 3.75, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '0945454', '', '127.0.0.1', '2019-11-02 04:57:22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', '2MI7TTO62QSAJME1T0KM'),
(21, 3.7059, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '06415454', '', '127.0.0.1', '2019-11-02 04:57:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', 'F2T6ASSX46Q7DWBF3IIW'),
(22, 3.6667, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '094844545', '', '127.0.0.1', '2019-11-02 05:05:44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', '9JGB59EKSEKHW15ZFC8B'),
(23, 3.6667, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '0944484569', '', '127.0.0.1', '2019-11-02 05:06:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', 'QDGFKORU76CYRPTDFG'),
(24, 3.5217, '7L7AOXL7JI8JCCVKOZBE', 'B2EBLEAUFIHYBETAZ54H', 'X2CU1SD56GB2L8RFYKKN', '', '', '127.0.0.1', '2019-11-02 05:08:03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36', 'V8TZH8A57ESI5WYS7YI7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_topic`
--

CREATE TABLE `tbl_evaluation_topic` (
  `eltp_id` int(11) NOT NULL,
  `eltp_code` varchar(20) NOT NULL COMMENT 'รหัสหัวข้อประเมิน',
  `eltp_name` varchar(70) NOT NULL,
  `eltp_description` text NOT NULL COMMENT 'รายละเอียดเพิ่มเติม',
  `eltp_status_topic` int(1) NOT NULL COMMENT '1=บริษัท / หน่วยงาน 2,=หมวดหมู่หลัก,3=หมวดหมู่ย่อย,4=ประเมินพนักงาน',
  `eltp_suggestion` int(1) NOT NULL COMMENT 'ข้อเสนอแนะ 1 =อนุญาต 0=ไม่อนุญาต',
  `eltp_remark` varchar(120) NOT NULL COMMENT 'คำกล่าวทักทาย',
  `crt_by` int(11) NOT NULL COMMENT 'สร้างโดย (user_id)',
  `crt_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `upd_by` int(11) NOT NULL COMMENT 'แก้ไขโดย (user_id)',
  `upd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไข',
  `eltp_status` int(1) NOT NULL COMMENT 'เปิด-ปิดใช้งาน',
  `is_delete` int(1) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ',
  `cmn_code` varchar(20) NOT NULL COMMENT 'โค้ดข้อมูลบริษัท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางหัวข้อประเมิน';

--
-- Dumping data for table `tbl_evaluation_topic`
--

INSERT INTO `tbl_evaluation_topic` (`eltp_id`, `eltp_code`, `eltp_name`, `eltp_description`, `eltp_status_topic`, `eltp_suggestion`, `eltp_remark`, `crt_by`, `crt_date`, `upd_by`, `upd_date`, `eltp_status`, `is_delete`, `cmn_code`) VALUES
(1, 'XNSELZL8L1POJCKRKD1Z', 'การใช้ห้องน้ำ', '', 2, 0, '', 2, '2019-05-06 11:45:33', 2, '2019-05-06 13:37:13', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(2, 'KHB0QL1DQU0R1V799', 'การอบรมครู', '', 3, 0, '', 2, '2019-05-06 19:50:34', 2, '2019-05-06 14:35:27', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(3, 'IJ64UFYVK75PSDDPJ7PJ', 'ประเมินพนักงานประจำปี22', '555+', 4, 1, 'ขอขอบพระคุณค่ะ', 2, '2019-05-06 21:38:13', 2, '2019-10-15 14:52:53', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(4, 'JRXLX3UBTOXVYZ8B5', 'การทำงานของพนักงาน', '', 1, 0, '555', 2, '2019-05-06 21:47:23', 2, '2019-10-17 08:54:13', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(5, 'UGII54ULUHP4XLCIQ5O0', 'การทำงานภายใน', '', 1, 0, '', 2, '2019-05-09 20:09:34', 2, '2019-05-09 13:12:25', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(6, 'BBXZ52ZS8FBF8I7Q856K', 'การทำงานบริษัท', '', 1, 0, 'ขอบคุณจร้า', 2, '2019-05-12 16:51:58', 2, '2019-10-29 11:45:14', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(7, '9YEOVUEU25VL67L65DA0', 'ประเมินการทำงานของแผนก', '', 2, 0, '', 2, '2019-05-12 16:54:20', 2, '2019-05-12 09:54:49', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(8, 'XFZQRKW7UILV6W0QIZ0', 'การประเมินภาพรวมของตำแหน่ง', '', 3, 0, 'ขอบคุณวะ', 2, '2019-05-12 16:57:13', 2, '2019-10-16 02:36:37', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(9, '2YLIS73RR4LDZOQ1VZ', 'ประเมินพนักงานประจำปี', '', 4, 0, '', 2, '2019-05-12 16:58:38', 2, '2019-05-22 13:36:50', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(10, 'NBQ4A091LELNC84UCVG2', 'งานวิจัยประจำปี', '', 2, 0, '', 2, '2019-05-22 20:49:00', 0, '2019-05-22 13:49:00', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(11, '3P7Y4QIN73NGTKVDMIK0', 'ทดสอล', 'ๅ', 1, 0, '', 7, '2019-09-24 20:33:52', 0, '2019-09-24 13:33:52', 1, 1, '7S3LD7SEOEZ3P7J5MIXV'),
(18, '6FGHY3QYTZLIASBKROY5', 'ทดสอบประเมิน1', '', 4, 0, 'ขอขอบคุณ', 2, '2019-10-14 15:57:52', 2, '2019-10-17 07:21:04', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(19, 'LC60Z2U0ROZANR4M1JZ9', 'ประเมินให้กับหอพอพักมีอนันต์', '', 2, 1, 'ขอขอบคุณที่แสดงความคิดเห็น', 2, '2019-10-14 20:18:01', 5, '2019-11-02 09:44:31', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(20, 'PAELXNJ8HDGGMCL1FY', 'fff', '', 1, 1, 'ขอขอบคุณที่แสดงความคิดเห็น', 2, '2019-10-16 23:32:28', 2, '2019-10-16 16:32:28', 1, 1, '7L7AOXL7JI8JCCVKOZBE'),
(21, 'B2EBLEAUFIHYBETAZ54H', 'ประเมิน Umpah Umpah', '', 3, 1, 'ขอขอบคุณที่แสดงความคิดเห็น', 2, '2019-10-27 18:20:15', 2, '2019-10-27 11:45:55', 1, 1, '7L7AOXL7JI8JCCVKOZBE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_topic_addon`
--

CREATE TABLE `tbl_evaluation_topic_addon` (
  `eta_id` int(11) NOT NULL,
  `eta_level` int(1) NOT NULL COMMENT 'ระดับประเมิน',
  `eta_addon` int(1) NOT NULL COMMENT 'ไฟล์  ../library/set_evaluation.php',
  `eltp_code` varchar(20) NOT NULL COMMENT 'tbl_evaluation_topic',
  `cmn_code` varchar(20) NOT NULL COMMENT 'tbl_company'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตั้งค่าแจ้งเตือนส่วนเสริมที่ใช้ในการประเมิน เช่น line ';

--
-- Dumping data for table `tbl_evaluation_topic_addon`
--

INSERT INTO `tbl_evaluation_topic_addon` (`eta_id`, `eta_level`, `eta_addon`, `eltp_code`, `cmn_code`) VALUES
(86, 1, 1, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(87, 1, 2, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(88, 2, 1, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(89, 2, 2, 'IJ64UFYVK75PSDDPJ7PJ', '7L7AOXL7JI8JCCVKOZBE'),
(106, 1, 2, 'XFZQRKW7UILV6W0QIZ0', '7L7AOXL7JI8JCCVKOZBE'),
(110, 3, 1, 'PAELXNJ8HDGGMCL1FY', '7L7AOXL7JI8JCCVKOZBE'),
(111, 4, 1, 'PAELXNJ8HDGGMCL1FY', '7L7AOXL7JI8JCCVKOZBE'),
(126, 1, 2, 'BBXZ52ZS8FBF8I7Q856K', '7L7AOXL7JI8JCCVKOZBE'),
(127, 1, 1, 'B2EBLEAUFIHYBETAZ54H', '7L7AOXL7JI8JCCVKOZBE'),
(128, 1, 2, 'B2EBLEAUFIHYBETAZ54H', '7L7AOXL7JI8JCCVKOZBE'),
(129, 1, 1, 'LC60Z2U0ROZANR4M1JZ9', '7L7AOXL7JI8JCCVKOZBE'),
(130, 1, 2, 'LC60Z2U0ROZANR4M1JZ9', '7L7AOXL7JI8JCCVKOZBE'),
(131, 2, 2, 'LC60Z2U0ROZANR4M1JZ9', '7L7AOXL7JI8JCCVKOZBE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_country`
--

CREATE TABLE `tbl_master_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(50) NOT NULL COMMENT 'ประเทศ',
  `country_flag` varchar(20) NOT NULL COMMENT 'ธงชาติ',
  `crt_by` int(11) NOT NULL COMMENT 'สร้างโดย (user_id)',
  `crt_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `upd_by` int(11) NOT NULL COMMENT 'แก้ไขโดย (user_id)',
  `upd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไข',
  `country_status` int(1) NOT NULL COMMENT 'เปิด-ปิดใช้งาน',
  `is_delete` int(1) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข้อมูลตั้งต้นประเทศ';

--
-- Dumping data for table `tbl_master_country`
--

INSERT INTO `tbl_master_country` (`country_id`, `country_name`, `country_flag`, `crt_by`, `crt_date`, `upd_by`, `upd_date`, `country_status`, `is_delete`) VALUES
(1, 'ไทย', 'RFNCGJ.PNG', 1, '2017-10-24 13:25:28', 1, '2019-10-27 04:47:09', 1, 1),
(2, 'อังกฤษ', '9DBUJ9.PNG', 1, '2017-10-24 13:25:28', 1, '2019-10-27 04:48:10', 1, 1),
(3, 'ลาว', '6R1TL.PNG', 1, '2017-10-24 13:47:32', 1, '2019-10-27 04:48:57', 1, 1),
(4, 'กัมพูชา', 'FRASMM.png', 1, '2019-10-27 11:41:01', 1, '2019-10-27 04:41:01', 1, 1),
(5, 'พม่า', 'III9PR.PNG', 1, '2019-10-29 19:08:53', 1, '2019-10-29 12:08:53', 1, 1),
(6, 'จีน', 'P8X2SL.PNG', 1, '2019-10-29 19:09:49', 1, '2019-10-29 12:09:49', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_nationality`
--

CREATE TABLE `tbl_master_nationality` (
  `nationality_id` int(11) NOT NULL,
  `nationality_name` varchar(50) NOT NULL COMMENT 'สัญชาติ',
  `crt_by` int(11) NOT NULL COMMENT 'สร้างโดย (user_id)',
  `crt_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `upd_by` int(11) NOT NULL COMMENT 'แก้ไขโดย (user_id)',
  `upd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไข',
  `nationality_status` int(1) NOT NULL COMMENT 'เปิด-ปิดใช้งาน',
  `is_delete` int(1) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข้อมูลตั้งต้นสัญชาติ';

--
-- Dumping data for table `tbl_master_nationality`
--

INSERT INTO `tbl_master_nationality` (`nationality_id`, `nationality_name`, `crt_by`, `crt_date`, `upd_by`, `upd_date`, `nationality_status`, `is_delete`) VALUES
(1, 'ไทย', 1, '2017-10-24 13:44:10', 1, '2019-05-04 01:58:45', 1, 1),
(2, ' อเมริกัน', 1, '2017-10-24 13:44:10', 1, '2017-10-24 06:54:31', 1, 1),
(3, 'ญี่ปุ่น', 1, '2017-10-24 13:44:10', 1, '2017-10-24 06:54:31', 1, 1),
(4, 'ปากีสถาน', 1, '2017-10-24 13:44:10', 1, '2017-10-24 06:54:31', 1, 1),
(5, 'ไอซ์แลนด์', 1, '2017-10-24 13:44:10', 1, '2017-10-24 06:54:31', 1, 1),
(6, ' Switzerland', 1, '2017-10-24 13:44:10', 1, '2017-10-24 06:54:31', 1, 1),
(7, ' เนเธอร์แลนด์', 1, '2017-10-24 13:44:10', 1, '2017-10-24 06:54:31', 1, 1),
(8, ' นอร์เวย์', 1, '2017-10-24 13:44:10', 1, '2017-10-24 06:54:31', 1, 1),
(9, 'อังกฤษ', 1, '2017-10-24 13:44:10', 1, '2017-10-24 06:54:31', 1, 1),
(10, 'ลาว', 1, '2017-10-24 13:44:10', 1, '2018-03-01 05:13:55', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_titlename`
--

CREATE TABLE `tbl_master_titlename` (
  `title_id` int(11) NOT NULL,
  `title_name` varchar(50) NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `language_status` int(1) NOT NULL COMMENT '1=ภาษาไทย ,2ภาษาต่างชาติ',
  `crt_by` int(11) NOT NULL COMMENT 'สร้างโดย (user_id)',
  `crt_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `upd_by` int(11) NOT NULL COMMENT 'แก้ไขโดย (user_id)',
  `upd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไข',
  `title_status` int(1) NOT NULL COMMENT 'เปิด-ปิดใช้งาน',
  `is_delete` int(1) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข้อมูลตั้งต้นคำนำหน้าชื่อ';

--
-- Dumping data for table `tbl_master_titlename`
--

INSERT INTO `tbl_master_titlename` (`title_id`, `title_name`, `language_status`, `crt_by`, `crt_date`, `upd_by`, `upd_date`, `title_status`, `is_delete`) VALUES
(1, 'นาย', 1, 1, '2017-10-24 10:22:25', 1, '2018-03-31 09:13:55', 1, 1),
(2, 'นาง', 1, 1, '2017-10-24 10:23:01', 1, '2017-10-24 03:43:29', 1, 1),
(3, 'นางสาว', 1, 1, '2017-10-24 10:23:09', 1, '2017-10-24 03:43:36', 1, 1),
(4, 'Mr.', 2, 1, '2017-10-24 10:23:17', 1, '2017-10-24 03:43:40', 1, 1),
(5, 'Mrs.', 1, 1, '2017-10-24 10:23:25', 1, '2019-05-04 02:52:25', 1, 1),
(6, '	Ms.', 2, 1, '2017-10-24 10:23:32', 1, '2017-10-24 03:43:47', 1, 1),
(7, 'Miss', 2, 1, '2017-10-24 10:23:41', 1, '2017-10-24 03:43:50', 1, 1),
(8, 'นาย', 2, 1, '2019-05-04 09:53:47', 1, '2019-05-04 02:55:57', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_language`
--

CREATE TABLE `tbl_system_language` (
  `stlg_id` int(11) NOT NULL,
  `stlg_text` text NOT NULL COMMENT 'ชื่อเมนู',
  `stlg_code` varchar(20) NOT NULL,
  `country_id` int(11) NOT NULL COMMENT 'tbl_master_country'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_system_language`
--

INSERT INTO `tbl_system_language` (`stlg_id`, `stlg_text`, `stlg_code`, `country_id`) VALUES
(1, 'สร้างแบบประเมิน', 'GFBYIE1K2D2W6AWAGXJX', 1),
(2, 'รายงาน', 'AA0I1POYCDIPWL5PVSU', 1),
(3, 'ประวัติการประเมิน', 'YIGVXMUW7S4CHJY0DMOT', 1),
(4, 'จำนวนแบบประเมิน', 'IR4547BW3M5UD06TUFLT', 1),
(5, 'จำนวนการทำแบบประเมิน', 'RPUGA18SPPII2RG5FQC', 1),
(6, 'ความคิดเห็น', 'ZDVME14A7RA7KCJ3G3RN', 1),
(7, 'บุคลากร', 'CIGMHC7MNZVJN7RNKF0D', 1),
(8, 'ผู้ดูแลระบบ', 'UIX6Z4DFL9CANJZIQF', 1),
(9, 'ออกจากระบบ', 'E9P2CWAOBGD39Y4RF53L', 1),
(10, 'หน้าหลัก', '9YUG6WTRXHO99SY5PAX3', 1),
(11, 'บุคลากร/เจ้าหน้าที่', '82BS90L39GV79H0CHXJ', 1),
(12, 'ภาพรวมบริษัท / องค์กร', '9WLI77ZZVAKPK4TXIS8X', 1),
(13, 'แบบฟอร์ม', 'QSSSELDILR7KC8J5DKM', 1),
(14, 'ข้อมูลแบบประเมิน', 'BB7A2P36J5V0Y95TVPA', 1),
(15, 'เกี่ยวกับ', 'UUUGA9M1X0QV1U04FEVR', 1),
(16, 'มกราคม', 'O37PYDPU0HPR4R534THL', 1),
(17, 'กุมภาพันธ์', 'JSAUA0OIY91GP2RDMTH', 1),
(18, 'มีนาคม', 'HDFNYWOS01H0QDLMQO', 1),
(19, 'เมษายน', 'DMNOM15JG4H74408X2', 1),
(20, 'พฤษภาคม', 'NMYYTF44NKYUPZT58BQM', 1),
(21, 'มิถุนายน', 'LOMR9CJX1XF6A0PUGMG', 1),
(22, 'กรกฎาคม', '1PIFNN3TWBY02WGH07N', 1),
(23, 'สิงหาคม', 'SSAEAHNJUX1GFTX7JOZF', 1),
(24, 'กันยายน', 'B9RT58OISU3KHFKKPZP', 1),
(25, 'ตุลาคม', 'R6C9HNIH5NMP0WLXTJ4W', 1),
(26, 'พฤศจิกายน', 'EO429OOHPY7O39K93I43', 1),
(27, 'ธันวาคม', 'L6CKBFFV4N5QNJ3JTAN', 1),
(28, 'ความคิดเห็น / วิจารณ์', 'OC6KMDPL4BSBAIAEI9X', 1),
(29, ' วันที่', 'L1GAS3FGYBXR3FAJYIMR', 1),
(30, 'คะแนน', '1P4XW0PEALXC62585AB', 1),
(31, 'กราฟภาพรวมการประเมินในแต่ละเดือน', 'P8AZQLANHR88KP26CPJ', 1),
(32, 'อัตราการประเมินในแต่ละเดือน', 'IRM93UNV89UL2GMTOIU', 1),
(33, 'ครั้ง', 'B06F85JUZPKUHOYQ3C', 1),
(34, 'ระดับที่', '5FTHPWPOAXR56VKTENN', 1),
(35, 'ทำรายการสำเร็จ', '6A7Z7PVA1S61PRNL3EDG', 1),
(36, 'ปิดหน้าต่างนี้', '0E0KJD8TVGULAQDZBPK', 1),
(37, 'เพิ่มข้อมูล', '7NFFJ34RJ2K9TQKMYYR8', 1),
(38, 'ค้นหา', 'IQBHEMEPFRKVMXWMWQLB', 1),
(39, 'สถานะ', 'ZIWW44Y5AGX96X0NNUR', 1),
(40, 'รายละเอียด', 'ZGURMBI4JPVS1ZE25DRM', 1),
(41, 'จัดการ', '45P3W32QRK9PLR67TQC', 1),
(42, 'แก้ไข', '4U9N0HPRKM852Y9B5II', 1),
(43, 'ลบ', '2UNYAQB1Q9W3FENTR11', 1),
(44, 'ใช่', '8K5I8PYX4GYZRH172V46', 1),
(45, 'ไม่ใช่', 'JVB8N1P7S5FGQNTK9ME', 1),
(46, 'ทำรายการเรียบร้อย', '2CDRDYXKYFKBVUSJZUZ', 1),
(47, 'ปิดหน้าต่างนี้เพื่อทำรายการใหม่', 'M5QUYH4ACMGV6FOVP2CS', 1),
(48, 'ยกเลิกการทำรายการ', '2GGETH683C8MNNCCZX05', 1),
(49, 'อัพโหลดรูป (อัพได้ทีละ 5 รูป)', 'FPB25T5TR3YPKJTJSEWR', 1),
(50, 'บันทึกข้อมูล', 'N7DNEI0JTJFKRRAT5F9', 1),
(51, 'เปิด', '1TIY9D1HPCVIDFOSHPH', 1),
(52, 'ปิด', 'W9911FENKYG5KP3G4YF', 1),
(53, 'ลบรูปนี้', 'S73FLCZD7NDXFSH9CGKQ', 1),
(54, 'User Name ซ้ำกัน !', '232SOA36V6QMWZ073O2E', 1),
(55, 'ชื่อ - นามสกุล', 'BZGTYZ2FJPVT4EXN42', 1),
(56, 'อัพโหลดได้เฉพาะไฟล์รูปภาพ !', 'XCYYNM6759UE95TLXG3K', 1),
(57, 'อัพโหลดรูป', '5NJRBSNPEG0WCJHYQKI', 1),
(58, 'คำนำหน้า', '382FT1K988YSM4AF2DGJ', 1),
(59, 'ชื่อ', '4E6P6I7TFWPKUT2IHL80', 1),
(60, 'นามสกุล', 'T87AB4ZTZXPR21E8D422', 1),
(61, 'อีเมล', '5FUF9OWQXK7GSBOFK51Z', 1),
(62, 'ขั้นตอนที่ 1 : กำหนด หัวข้อ / ชื่อแบบประเมิน', 'URC9PALSXATW6GOEUV12', 1),
(63, 'ขั้นตอนที่ 2 : กำหนดสิทธิ์', '8M8DOJ7P9N2XQTP3WU1V', 1),
(64, 'ขั้นตอนที่ 3 : สร้างเนื้อหาในแบบประเมิน', 'Y6ID3K217W7UWP3N5S', 1),
(65, 'หัวข้อ / ชื่อแบบประเมิน', '3YXM2DYJA0757V0Y2', 1),
(66, 'ส่วนการประเมิน', 'NYB10XVCMYCEB27SUG3', 1),
(67, 'บริษัท / หน่วยงาน', 'XSBMHS8Q0OJOT7VRTLNA', 1),
(68, 'ตั้งค่าส่วนเสริมแบบประเมิน', 'LVNQY3FPVBNRELIB02YN', 1),
(69, 'ระดับ', '0045YL4E8UFF54DTBD09', 1),
(70, 'คำกล่าวหลังประเมินเสร็จ', 'IW9P8F8U4U4QXUSF5GKM', 1),
(71, 'ขอขอบคุณที่แสดงความคิดเห็น', 'U0COE8XD302H99ZBW740', 1),
(72, 'ข้อเสนอแนะหลังการประเมิน', 'AT33LWQD5GDFZ89POCW6', 1),
(73, 'อนุญาต', '0DKRFMKST1C4FOYEUQXZ', 1),
(74, 'ไม่อนุญาต', '06EQD5NHZM3OH4J05R', 1),
(75, 'ขั้นตอนถัดไป', 'OHOLO47OQAO7CEXN5JMW', 1),
(76, 'ขั้นตอนที่ 2 : กำหนดสิทธิ์แบบประเมินหัวข้อ', 'I87BGAXL6XYC3K78WWRG', 1),
(77, 'กำหนดสิทธิ์ทั้งหมดอัตโนมัติ', 'F3LAM3S42TWX5UCRLCB', 1),
(78, 'ยกเลิกสิทธิ์ทั้งหมดอัตโนมัติ', 'ZVUF8SYSAA43P81MDJU', 1),
(79, 'กำหนดสิทธิ์', 'OSOPVUILPY8Y21BCWRQZ', 1),
(80, 'ยกเลิกข้อมูล', 'OYB3F05SHZ4ET89K0FU', 1),
(81, 'กรุณาทำรายการอย่างน้อย 1 รายการ', '06HQJ41B6CHPIDJXWP49', 1),
(82, 'ขั้นตอนที่ 3 : สร้างเนื้อหาแบบประเมินหัวข้อ', 'LT5FAVG8MA4WCDUIZGFX', 1),
(83, 'กรอกเนื้อหา', 'FKX34YOQ5LRTALKZJVYP', 1),
(84, 'กด Enter เพื่อบันทึกข้อมูล', '28UNC0YD7R8RER91PLM', 1),
(85, 'คุณต้องการลบข้อมูลใช่หรือไม่', 'PR9URT9UM3QB1ZJ62NK', 1),
(86, 'แบบประเมิน', 'WVA0K7KJQ0KR5O524AG', 1),
(87, 'ส่วนประเมิน', '4NM48ST6Y18XWHU7LK', 1),
(88, 'จำนวนเนื้อหา', '06B2D339GGZUOT5CB6AL', 1),
(89, 'วันและเวลาที่สร้าง', '7T7UZADUU8I4XOW0AWD', 1),
(90, 'วันและเวลาที่ปรับปรุง', 'ZPSDY8NUIJ7IQBMRJG3M', 1),
(91, 'เกี่ยวกับบริษัท /องค์กร', 'COUDXA6MOIM3GX69P4AA', 1),
(92, 'ชื่อบริษัท / องค์กร', 'FF8AVSCZMFT7R2J4M8SF', 1),
(93, ' ชื่อบริษัท / องค์กร', '1T39TK6ZCE0803DONX', 1),
(94, 'เบอร์โทร', 'G899PO8RRBZ819F3LVUP', 1),
(95, 'ที่อยู่', 'HTJRZDQRI1IR7ET68HL', 1),
(96, 'ไลน์ (รหัส Token)', 'KJTD8TCS5JMV2K0XLEL', 1),
(97, 'ตั้งค่าแบบเรียกหมวดหมู่', 'QTI8QNW9EBQTI4RQRAH6', 1),
(98, 'หมวดหมู่หลัก', '6LDBJKDD3SXFR29N14M', 1),
(99, 'หมวดหมู่ย่อย', '051CHXK74A55QJ8EJDZ', 1),
(100, 'ประสิทธิภาพโดยรวมทั้งบริษัท', '590GU5101795R2XF8LUQ', 1),
(101, 'ตัวเลขสีเขียว = ระดับประเมิน', 'I71M6P36PIROSK1U2KA', 1),
(102, 'ตัวเลขสีแดง = จำนวนครั้งในการประเมิน', '99G5U8WHDQZXS3BZ0Y', 1),
(103, 'ตัวเลขสีน้ำเงิน = ค่าเฉลี่ย', '0SAV04WWPN1FY6GVQJK4', 1),
(104, 'ภาพรวมแบบกราฟ', 'Y1SN1MPL4SZ77SV7GW0', 1),
(105, 'รายละเอียดเชิงลึก', '8971RSN3VC4CBQGTX0Q0', 1),
(106, 'คะแนนความพึงพอใจ', 'UE22RDKB7OW9501B09OA', 1),
(107, 'น้อยที่สุด', 'UEPGRXM9EBAPO9M44HGX', 1),
(108, 'น้อย', '2EEEX16HYXN7RIEWCJGB', 1),
(109, 'ปานกลาง', '3692QW5U4FOLJZ1UFQ6', 1),
(110, 'มาก', 'XS3EDYVT6DEV0EQFYNWT', 1),
(111, 'มากที่สุด', 'AXI81XOH5YH8MEPWO43', 1),
(112, 'ระดับความพึงพอใจประจำปี', 'Z2F6BIJA4PLXQKCC4N', 1),
(113, 'แบบประเมินทั่วไป', 'FTXBS8WL3L3QIJSSTH', 1),
(114, 'หัวข้อ', 'C337ZWNQ9GSC62UE5OT', 1),
(115, 'ประสิทธิภาพโดยรวม', 'R2VWXC3V4QES5BPGMVQZ', 1),
(116, 'ดูความคิดเห็น', 'WVMXC48AJK9WPPCRDMF', 1),
(117, 'ดูรายการ', 'J6KU1WV9GPNLTRG4VYO', 1),
(118, 'กราฟเฉลี่ยระดับความพึงพอในแต่ละเดือน ประจำปี', 'UV5GFNERRSJJ77I3SLQ', 1),
(119, 'ระดับคะแนนเฉลี่ย', 'VZWU2XHLZBJFEDCXP3TP', 1),
(120, 'คะแนนเฉลี่ย', 'CI7HB4AA31EAKSYBOS', 1),
(121, 'อัตราการประเมินในแต่ละระดับ ประจำปี', 'CM59NQWJRMD4HG4TZJB', 1),
(122, 'จำนวนการประเมินในแต่ละระดับ', 'BEP6O5G5B3L09XGGWMBN', 1),
(123, 'ปี', '0TQ1AOZP3ZMS1GDOV7WD', 1),
(124, 'ทำการประเมิน', 'F1THDXB73PEF3P8KJKGE', 1),
(125, 'สร้าง Qr-Code', 'UQRSAI70CIPXZG86JMKA', 1),
(126, 'พิมพ์ Qr-Code', '6M2DQFPDKPDWPPZX8S4X', 1),
(127, 'กลับไปยังหน้าหลัก', '4X1MKFGU9N9X9V1OJH8', 1),
(128, 'คัดลอกลิงก์', '78CANC0GZH9RFFEU1S43', 1),
(129, 'ไปยังลิงก์ประเมิน', '4Q1MN536L1THHY6GPUUP', 1),
(130, 'เลือกทั้งหมด', 'NKZAJPZ21NHY00ST25GJ', 1),
(131, 'เฉลี่ยรวมจากแบบประเมินทั้งหมด', '91HNOIAL3H20JVU6X3', 1),
(132, 'ประเมินทั้งหมด', 'VKBZXA7RI3TBF9IXRJ63', 1),
(133, 'ตอบแบบประเมิน', '5XB21J1I7WSCZPLD03ZM', 1),
(134, 'กลับไปยังก่อนหน้านี้', 'M9ASK4SSI2IEYYQC8FR', 1),
(135, 'พิมพ์', 'R7UA0L3KMNLJN0H73FPN', 1),
(136, 'ลำดับ', '5MEQHDSQR5O4KV7I1YUZ', 1),
(137, 'เนื้อหา', '93C5VPH8JVFI7F1HHU00', 1),
(138, 'ความถี่สะสม', 'E11N3PI0R1M9LQ37IN', 1),
(139, 'คะแนนที่ได้', 'FS3R6NVYJCPU9PU1PATW', 1),
(140, 'คะแนนรวม', '7GMJE4IXUW63GWJW82SW', 1),
(141, 'เกณฑ์การประเมินความพึงพอใจ', 'JHRFYPP40T87CCUB13T6', 1),
(142, 'ค่าเฉลี่ย', '9Y76I6R8IIBZIHGCYJX', 1),
(143, 'แปลความหมาย', '9HQJ6Q7ELN34OSMSNCW', 1),
(144, 'ประเมินให้กับ', 'V0MUNWY1006DJ6YC0ZA0', 1),
(145, 'ประเมินทั่วไป', 'KF9GC67GPXOEIJQYYZ43', 1),
(146, 'ประสิทธิภาพโดยรวม', 'G7DW6C3P4LFGQQ6PVH', 1),
(147, 'แบบประเมินทั้งหมด', '5PNAE6GIA1FHVNZCCE0', 1),
(148, 'เบอร์โทรผู้ประเมิน', '0L20HQ576Q0V5NOBXZD2', 1),
(149, 'ข้อเสนอแนะ', 'C1CYSHCU106Q3E6T33OP', 1),
(150, 'วันและเวลาที่ประเมิน', 'HDBE4D7IB9LX4FOREH5W', 1),
(151, 'แสดงความคิดเห็น เช่น บริการดี,ควรปรับปรุง', 'J0BKXPW97I49LILIXAV', 1),
(152, 'รูป', 'G1KL1UUGXY6N56F3I9Z', 1),
(153, 'คุณเคยทำแบบประเมินนี้แล้ว..', 'DRUXJ6B9R7A7O5MQ28', 1),
(154, 'ถัดไป', 'NACJ7UTDOXMIFJG', 1),
(155, 'กลับไปยังหน้าก่อนหน้า', '71EQUHC3AI40FMM6GKJE', 1),
(156, 'แสดงความคิดเห็น', '1SFC0YEI730XKEM7FZKF', 1),
(157, 'เบอร์ติดต่อ', 'VCI6ZNFHXRURL4L1FAWN', 1),
(158, 'กรอกเบอร์โทร', 'GP6O3BIAC2HIIDYAEQG6', 1),
(159, 'กลับ', '1C5CHZ3Z8KV5KWPQQH1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(10) DEFAULT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `user_password` varchar(60) DEFAULT NULL COMMENT 'รหัสผ่าน',
  `user_password_shows` varchar(20) NOT NULL COMMENT 'โชว์รหัสผ่าน',
  `user_prefix` varchar(70) DEFAULT NULL COMMENT 'คำนำหน้า',
  `user_firstname` varchar(50) DEFAULT NULL COMMENT 'ชื่อจริง',
  `user_lastname` varchar(50) DEFAULT NULL COMMENT 'นามสกุล',
  `user_email` varchar(70) NOT NULL COMMENT 'e-mail',
  `user_img` varchar(20) NOT NULL COMMENT 'รูปประจำตัว',
  `user_status` int(1) NOT NULL COMMENT 'สถานะผู้ใช้ 1= adminระบบ,2=adminโรงเรียน/บริษัท/องค์กรณ์ 3=user ทั่วไป',
  `user_code` varchar(20) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '1' COMMENT 'สถานะลบ '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_password`, `user_password_shows`, `user_prefix`, `user_firstname`, `user_lastname`, `user_email`, `user_img`, `user_status`, `user_code`, `is_delete`) VALUES
(1, 'admin', '$2y$10$wpNERxOJ9B8YsnCOIlE7zuRGcUwESkfdsyqCr0B8N1pqOw4hi9D5y', '1q2w3e4r', NULL, 'เจ้าหน้าที่', 'ดูแลระบบ', '', '', 1, '', 1),
(2, 'fhun', '$2y$10$7sim5KCnhZqTo5EErpeTtO.HAfj0/O7NOsboyP7mBVgGiEtr/EuTy', 'siw@k0rn', NULL, 'ศิวกร', 'บรรลือทรัพย์', 'siwakorn167@gmail.com', '', 2, '2N1462RD73LYVW7ABGBH', 1),
(3, 'test33', '$2y$10$xtPRS9.PJ1I.v1t/B3WMDuwXY06icURAFEyNDvCdEVbczaYfg0Tom', 'siw@k0rn', 'Mrs.', 'Jaenjira', 'Penmomhkol', 'jen@testmail.com', 'TVYUUK.jpg', 3, '1NVORINRCNTB47VMPRY', 0),
(4, 'test1', '$2y$10$/XjadFK9h03EuA41vgpFU.G23YWvgkpsRRkl9lGUiLR89MzcPIKJ6', '13123', 'นางสาว', 'เจนจิรา', 'เป็นมงคล', 'jenjira2039@gmail.com', 'XNG0W1.jpg', 3, 'NAJ3RBIIIBTIY0M8SJ', 0),
(5, 'a2vbIgX', '$2y$10$YACmmkpEqFTogT1tDebXeOqFQqlIwZ5YXQdmbjU2EMM5UnaznTB9O', 'GJkHVuV', 'นาย', 'ศิวกร', 'บรรลือทรัพย์', '', 'DE4DVW.jpg', 3, '3EXHKMA2M3CNBFONCI', 1),
(6, '1FAvvZu', '$2y$10$zAGgIfMucbhu6InbEEkuW.Zzxb/JyxQp516QIA1vuhMp2MtaCCQRK', 'WnQ8KhO', 'นาย', 'มานะ', 'ใจดี', '', '', 3, 'PJL6PVP6CD9O3ZI0MQ4D', 1),
(7, 'staffid', '$2y$10$jis8h2IUvJ5ex21/sPg89eApWXt7gUcOWHAZEkF0H3T/6oOcZqfx6', '1q2w3e4r', NULL, 'ผู้ดูแลระบบ', 'ไอดีไดรฟ์', '', '', 2, 'X7BOBXVO81KPBTE56QKT', 1),
(8, 'staffkk', '$2y$10$xx3048C/rftyCwAF3Ntrse6VSlXtQq4mbQw73/fDF/GrCBK0ous0q', '1q2w3e4r', NULL, 'ผู้ดูแลระบบ', 'โรงเรียน', '', '', 2, '8MAC361DPKA0N2WQ942', 1),
(9, '0VI', '$2y$10$pxqYKWvJtICGtxUILaw6yOeUfwMUEPrbk.rrnC2KGlyZHP6.OEXSe', '355PQM', 'นางสาว', 'จีซู', 'แบล๊กพิงค์', '', 'F8LSM3.jpg', 3, 'MXQ3C99FDBGDBCMRXFNX', 1),
(10, 'VKY9U1', '$2y$10$tNHA.l3PzSt3XlhLiZPhMujNuC5gsdFBSba8DhxTiNPNB1IVcHNw2', '1q2w3e4r', 'นางสาว', 'ลิซ่า', 'แบล๊กพิ๊ง', '-', 'Q8H2EV.jpg', 3, 'VBIVBZB2LIB49TGDVHU8', 1),
(11, 'QHAOLL', '$2y$10$UK7tPpRJ8QrqOQB9A1FCqeulwQJHy5tKo9Co3fE/7zgGmzYubgbeK', 'WWJWCK', 'Miss', 'Jisoo', 'Blackping', 'siwakorn167@gmail.com', 'X565YW.jpg', 3, 'AHTAVZ5VODAO295M77B', 1),
(12, 'H05C', '$2y$10$t/d7zk89mwKF0B3C3g6XTe7uhqeGHgb39RykyH3Cfg/xmrYyrYFHm', 'V1ZYEM', 'Miss', 'Jisoo', 'Blackpink', 'siwakorn@gmail.com', 'KR1GN.jpg', 3, '9GKNOEELJD2J12IK1OI8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_detail`
--

CREATE TABLE `tbl_user_detail` (
  `ud_id` int(11) NOT NULL,
  `user_code` varchar(20) NOT NULL COMMENT 'รหัส User',
  `cmn_code` varchar(20) NOT NULL COMMENT 'รหัส โรงเรียน/บริษัท/องค์กรณ์',
  `ctgm_code` varchar(20) NOT NULL COMMENT 'โค้ดหมวดหมู่หลัก',
  `ctgs_code` varchar(20) NOT NULL COMMENT 'โค้ดหมวดหมู่ย่อย',
  `country_id` int(11) NOT NULL DEFAULT '1' COMMENT 'tbl_master_country'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_detail`
--

INSERT INTO `tbl_user_detail` (`ud_id`, `user_code`, `cmn_code`, `ctgm_code`, `ctgs_code`, `country_id`) VALUES
(1, 'U09GBYLUH82WLWB8EGW', 'RIW03ODSO2JTW4R0ZD5', '', '', 1),
(2, '2N1462RD73LYVW7ABGBH', '7L7AOXL7JI8JCCVKOZBE', '', '', 1),
(3, '1NVORINRCNTB47VMPRY', '7L7AOXL7JI8JCCVKOZBE', 'A6A6NWP0DG8CGCMEADUI', 'ZP7H2L0YW7O3GSMHNJ4H', 1),
(4, 'NAJ3RBIIIBTIY0M8SJ', '7L7AOXL7JI8JCCVKOZBE', 'A6A6NWP0DG8CGCMEADUI', 'ZP7H2L0YW7O3GSMHNJ4H', 1),
(5, '3EXHKMA2M3CNBFONCI', '7L7AOXL7JI8JCCVKOZBE', 'IQJBAN614ZIUQ4K4MV5J', 'X2CU1SD56GB2L8RFYKKN', 1),
(6, 'PJL6PVP6CD9O3ZI0MQ4D', '7L7AOXL7JI8JCCVKOZBE', 'IQJBAN614ZIUQ4K4MV5J', 'X2CU1SD56GB2L8RFYKKN', 1),
(7, 'X7BOBXVO81KPBTE56QKT', '7S3LD7SEOEZ3P7J5MIXV', '', '', 1),
(8, '8MAC361DPKA0N2WQ942', '84L1KUAAOQJL1RTA6PZ', '', '', 1),
(9, 'MXQ3C99FDBGDBCMRXFNX', '7L7AOXL7JI8JCCVKOZBE', 'IQJBAN614ZIUQ4K4MV5J', 'X2CU1SD56GB2L8RFYKKN', 1),
(10, 'VBIVBZB2LIB49TGDVHU8', '7L7AOXL7JI8JCCVKOZBE', '7ZKFBGPRHYVKU3PYPDRE', 'JOHWDQPKIE0NP0VM4UUX', 1),
(11, '9GKNOEELJD2J12IK1OI8', '7L7AOXL7JI8JCCVKOZBE', 'A6A6NWP0DG8CGCMEADUI', 'ZP7H2L0YW7O3GSMHNJ4H', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category_img`
--
ALTER TABLE `tbl_category_img`
  ADD PRIMARY KEY (`cgimg_id`);

--
-- Indexes for table `tbl_category_main`
--
ALTER TABLE `tbl_category_main`
  ADD PRIMARY KEY (`ctgm_id`);

--
-- Indexes for table `tbl_category_sub`
--
ALTER TABLE `tbl_category_sub`
  ADD PRIMARY KEY (`ctgs_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`cmn_id`);

--
-- Indexes for table `tbl_config_general`
--
ALTER TABLE `tbl_config_general`
  ADD PRIMARY KEY (`cgr_id`);

--
-- Indexes for table `tbl_evaluation_cach`
--
ALTER TABLE `tbl_evaluation_cach`
  ADD PRIMARY KEY (`evalc_id`);

--
-- Indexes for table `tbl_evaluation_data`
--
ALTER TABLE `tbl_evaluation_data`
  ADD PRIMARY KEY (`eltda_id`);

--
-- Indexes for table `tbl_evaluation_permission`
--
ALTER TABLE `tbl_evaluation_permission`
  ADD PRIMARY KEY (`evltp_id`);

--
-- Indexes for table `tbl_evaluation_result`
--
ALTER TABLE `tbl_evaluation_result`
  ADD PRIMARY KEY (`evltr_id`);

--
-- Indexes for table `tbl_evaluation_topic`
--
ALTER TABLE `tbl_evaluation_topic`
  ADD PRIMARY KEY (`eltp_id`);

--
-- Indexes for table `tbl_evaluation_topic_addon`
--
ALTER TABLE `tbl_evaluation_topic_addon`
  ADD PRIMARY KEY (`eta_id`);

--
-- Indexes for table `tbl_master_country`
--
ALTER TABLE `tbl_master_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tbl_master_nationality`
--
ALTER TABLE `tbl_master_nationality`
  ADD PRIMARY KEY (`nationality_id`);

--
-- Indexes for table `tbl_master_titlename`
--
ALTER TABLE `tbl_master_titlename`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `tbl_system_language`
--
ALTER TABLE `tbl_system_language`
  ADD PRIMARY KEY (`stlg_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_detail`
--
ALTER TABLE `tbl_user_detail`
  ADD PRIMARY KEY (`ud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category_img`
--
ALTER TABLE `tbl_category_img`
  MODIFY `cgimg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_category_main`
--
ALTER TABLE `tbl_category_main`
  MODIFY `ctgm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_category_sub`
--
ALTER TABLE `tbl_category_sub`
  MODIFY `ctgs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `cmn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_config_general`
--
ALTER TABLE `tbl_config_general`
  MODIFY `cgr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_evaluation_cach`
--
ALTER TABLE `tbl_evaluation_cach`
  MODIFY `evalc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_evaluation_data`
--
ALTER TABLE `tbl_evaluation_data`
  MODIFY `eltda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_evaluation_permission`
--
ALTER TABLE `tbl_evaluation_permission`
  MODIFY `evltp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `tbl_evaluation_result`
--
ALTER TABLE `tbl_evaluation_result`
  MODIFY `evltr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_evaluation_topic`
--
ALTER TABLE `tbl_evaluation_topic`
  MODIFY `eltp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_evaluation_topic_addon`
--
ALTER TABLE `tbl_evaluation_topic_addon`
  MODIFY `eta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `tbl_master_country`
--
ALTER TABLE `tbl_master_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_master_nationality`
--
ALTER TABLE `tbl_master_nationality`
  MODIFY `nationality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_master_titlename`
--
ALTER TABLE `tbl_master_titlename`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_system_language`
--
ALTER TABLE `tbl_system_language`
  MODIFY `stlg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user_detail`
--
ALTER TABLE `tbl_user_detail`
  MODIFY `ud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
