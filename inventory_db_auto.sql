-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2013 at 03:08 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory_db`
--
CREATE DATABASE `inventory_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `inventory_db`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `alert_min_stok`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `alert_min_stok`()
BEGIN
SELECT brg_nama,brg_stok,brg_min_stok FROM tbl_barang WHERE brg_stok <= brg_min_stok;
END$$

DROP PROCEDURE IF EXISTS `create_user_member`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_user_member`(IN `i_fullname` VARCHAR(100), IN `i_name` VARCHAR(15), IN `i_pass` VARCHAR(255))
    MODIFIES SQL DATA
INSERT INTO user_member(user_fullname,user_name,user_pass,group_name,user_last_login) VALUES (i_fullname,i_name,i_pass,(SELECT default_group FROM app_config WHERE config_id = 1),'0000-00-00')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `app_config`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `app_config`;
CREATE TABLE IF NOT EXISTS `app_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_per_page` int(11) NOT NULL,
  `default_group` varchar(20) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `app_config`
--

INSERT INTO `app_config` (`config_id`, `data_per_page`, `default_group`, `company_name`) VALUES
(1, 10, 'tester', 'chraven-systems labs ,Inc');

-- --------------------------------------------------------

--
-- Table structure for table `i_widget`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `i_widget`;
CREATE TABLE IF NOT EXISTS `i_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `column_id` int(11) NOT NULL,
  `sort_no` int(11) NOT NULL,
  `collapsed` tinyint(4) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `i_widget`
--

INSERT INTO `i_widget` (`id`, `column_id`, `sort_no`, `collapsed`, `title`) VALUES
(1, 1, 0, 0, 'Aktifitas Barang'),
(2, 0, 0, 0, 'Login Info'),
(3, 0, 1, 0, 'Akses Cepat'),
(4, 1, 1, 0, 'Peringatan');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktifitas`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `log_aktifitas`;
CREATE TABLE IF NOT EXISTS `log_aktifitas` (
  `log_type` enum('+','-') NOT NULL,
  `log_content` varchar(50) NOT NULL,
  `log_time` varchar(32) NOT NULL,
  `brg_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_aktifitas`
--

INSERT INTO `log_aktifitas` (`log_type`, `log_content`, `log_time`, `brg_id`, `user_id`) VALUES
('+', 'Penambahan Stok Barang', '1355051397', 1, 1),
('-', 'Pengambilan Stok Barang', '1355059510', 1, 1),
('+', 'Penambahan Stok Barang', '1355185892', 7, 1),
('+', 'Penambahan Stok Barang', '1355185926', 2, 1),
('+', 'Penambahan Stok Barang', '1355185952', 3, 1),
('+', 'Penambahan Stok Barang', '1355185984', 8, 1),
('+', 'Penambahan Stok Barang', '1355186020', 10, 1),
('+', 'Penambahan Stok Barang', '1355186056', 4, 1),
('+', 'Penambahan Stok Barang', '1355186093', 6, 1),
('+', 'Penambahan Stok Barang', '1355399046', 1, 1),
('-', 'Pengambilan Stok Barang', '1355399458', 7, 1),
('+', 'Penambahan Stok Barang', '1355657868', 3, 1),
('+', 'Penambahan Stok Barang', '1355657908', 5, 1),
('+', 'Penambahan Stok Barang', '1355657946', 6, 1),
('+', 'Penambahan Stok Barang', '1355657985', 10, 1),
('+', 'Penambahan Stok Barang', '1355658018', 11, 1),
('+', 'Penambahan Stok Barang', '1355658056', 9, 1),
('-', 'Pengambilan Stok Barang', '1355659367', 10, 1),
('+', 'Penambahan Stok Barang', '1355659402', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `tbl_barang`;
CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `brg_id` int(11) NOT NULL AUTO_INCREMENT,
  `brg_nama` varchar(100) NOT NULL,
  `brg_kode` varchar(20) NOT NULL,
  `brg_deskripsi` tinytext NOT NULL,
  `brg_stok` int(10) NOT NULL DEFAULT '0',
  `brg_min_stok` int(10) NOT NULL DEFAULT '0',
  `brg_harga_satuan` double(15,2) NOT NULL,
  `brg_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `brg_vendor` varchar(100) NOT NULL,
  `jb_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`brg_id`),
  KEY `jb_id` (`jb_id`),
  KEY `sp_id` (`sp_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`brg_id`, `brg_nama`, `brg_kode`, `brg_deskripsi`, `brg_stok`, `brg_min_stok`, `brg_harga_satuan`, `brg_timestamp`, `brg_vendor`, `jb_id`, `sp_id`, `user_id`) VALUES
(1, 'ACER Iconia A101', 'a101', '<p>acer tablet 7 inci</p>', 13, 5, 4000000.00, '2012-12-08 13:26:39', 'Acer ,Inc', 1, 1, 1),
(2, 'ASUS transformer TF101G', 'tf101g', '<p>asus transfomer tablet</p>', 10, 5, 7000000.00, '2012-12-08 13:29:48', 'ASUSTeK Computer ,Inc', 1, 2, 1),
(3, 'AOC i2757fm', '12757', '<p>AOC LCD dengan panel jenis IPS, ukuran 27 inci</p>', 25, 20, 3400000.00, '2012-12-10 12:04:24', 'AOC Monitors', 20, 2, 1),
(4, 'PHILIPS 224CL2', '224cl2', '<p>philip monitor</p>', 15, 10, 1650000.00, '2012-12-10 12:09:01', 'Koninklijke philips Electronic N.V', 20, 6, 1),
(5, 'E-BLUE Astronaut', '3456eblue', '<p>wireless mouse</p>', 15, 10, 155000.00, '2012-12-10 12:13:05', 'e-blue ,Inc', 19, 7, 1),
(6, 'Logitech Touch Mouse M600', 'm600', '<p>mouse wireless</p>', 15, 10, 650000.00, '2012-12-10 12:17:14', 'Logitech', 19, 8, 1),
(7, 'Edifier M1385 FM', 'm1385fm', '<p>speaker edifier 2.1</p>', 15, 5, 250000.00, '2012-12-10 12:21:57', 'Edifier Intenational Limited', 14, 1, 1),
(8, 'SONY DR-GA200', 'dr-ga200', '<p>sony stereo headphone</p>', 10, 5, 900000.00, '2012-12-10 12:23:38', 'Sony Electronics ,Inc', 12, 2, 1),
(9, 'CLUB3D HD 7970', '3d7970', '<p>video card enthusiast AMD</p>', 10, 5, 5000000.00, '2012-12-10 12:25:33', 'Club3d', 2, 6, 1),
(10, 'DIGITAL ALLIANCE jetstream GTX 670', 'dagtx670', '<p>video card enthusiast nVIDIA</p>', 14, 5, 4200000.00, '2012-12-10 12:27:14', 'Gigital Alliance', 2, 2, 1),
(11, 'SAPPHIRE HD 7870 GHZ edition OC', 'shd7870ghzoc', '<p>Video card enthusiast AMD, Over Clock Edition</p>', 9, 5, 3700000.00, '2012-12-10 12:29:11', 'Sapphire', 2, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_keluar`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `tbl_barang_keluar`;
CREATE TABLE IF NOT EXISTS `tbl_barang_keluar` (
  `bk_id` int(11) NOT NULL AUTO_INCREMENT,
  `bk_kode` varchar(20) NOT NULL,
  `bk_jumlah` int(10) NOT NULL,
  `bk_keterangan` tinytext NOT NULL,
  `bk_tgl` date NOT NULL,
  `bk_time` varchar(32) NOT NULL,
  `brg_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`bk_id`),
  KEY `brg_id` (`brg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_barang_keluar`
--

INSERT INTO `tbl_barang_keluar` (`bk_id`, `bk_kode`, `bk_jumlah`, `bk_keterangan`, `bk_tgl`, `bk_time`, `brg_id`, `user_id`) VALUES
(2, 'saf3', 7, '<p>test</p>', '2012-12-09', '1355059510', 1, 1),
(3, 'fdnn76588', 5, '<p>test</p>', '2012-12-13', '1355399458', 7, 1),
(4, 'db588', 3, '<p>test</p>', '2012-12-16', '1355659367', 10, 1);

--
-- Triggers `tbl_barang_keluar`
--
DROP TRIGGER IF EXISTS `bk_delete`;
DELIMITER //
CREATE TRIGGER `bk_delete` BEFORE DELETE ON `tbl_barang_keluar`
 FOR EACH ROW BEGIN
UPDATE tbl_barang SET tbl_barang.brg_stok = tbl_barang.brg_stok + OLD.bk_jumlah WHERE tbl_barang.brg_id = OLD.brg_id;
DELETE FROM log_aktifitas WHERE log_time = OLD.bk_time;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bk_insert`;
DELIMITER //
CREATE TRIGGER `bk_insert` AFTER INSERT ON `tbl_barang_keluar`
 FOR EACH ROW BEGIN
UPDATE tbl_barang SET tbl_barang.brg_stok = tbl_barang.brg_stok - NEW.bk_jumlah WHERE tbl_barang.brg_id = NEW.brg_id;
INSERT INTO log_aktifitas (log_type,log_content,log_time,brg_id,user_id) VALUES('-','Pengambilan Stok Barang',NEW.bk_time,NEW.brg_id,NEW.user_id);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_masuk`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `tbl_barang_masuk`;
CREATE TABLE IF NOT EXISTS `tbl_barang_masuk` (
  `bm_id` int(11) NOT NULL AUTO_INCREMENT,
  `bm_kode` varchar(20) NOT NULL,
  `bm_jumlah` int(10) NOT NULL,
  `bm_keterangan` tinytext NOT NULL,
  `bm_tgl` date NOT NULL,
  `bm_time` varchar(32) NOT NULL,
  `brg_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`bm_id`),
  KEY `brg_id` (`brg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_barang_masuk`
--

INSERT INTO `tbl_barang_masuk` (`bm_id`, `bm_kode`, `bm_jumlah`, `bm_keterangan`, `bm_tgl`, `bm_time`, `brg_id`, `user_id`) VALUES
(1, 'es366', 10, '<p>test ok</p>', '2012-12-09', '1355051397', 1, 1),
(2, '234gtyu', 20, '<p>test ok</p>', '2012-12-11', '1355185892', 7, 1),
(3, 'db576nn7', 10, '<p>test ok</p>', '2012-12-11', '1355185926', 2, 1),
(4, 'sbe6eb', 5, '<p>test</p>', '2012-12-11', '1355185952', 3, 1),
(5, 'db6h5', 10, '<p>test</p>', '2012-12-11', '1355185984', 8, 1),
(6, 'w5g35', 5, '<p>ttest</p>', '2012-12-11', '1355186020', 10, 1),
(7, 'cb656n', 15, '<p>test</p>', '2012-12-11', '1355186056', 4, 1),
(8, 'sebdy5ted', 5, '<p>test</p>', '2012-12-11', '1355186093', 6, 1),
(9, 'dvxy758', 10, '<p>coba</p>', '2012-12-13', '1355399046', 1, 1),
(10, 'zv56346', 20, '<p>test ok</p>', '2012-12-16', '1355657868', 3, 1),
(11, 'sebb375', 15, '<p>test</p>', '2012-12-16', '1355657908', 5, 1),
(12, 'ebtt4e6', 10, '<p>test</p>', '2012-12-16', '1355657946', 6, 1),
(13, 'dbt5858', 2, '', '2012-12-16', '1355657985', 10, 1),
(14, 'db7457', 9, '<p>ngetest</p>', '2012-12-16', '1355658018', 11, 1),
(15, 'sbte75', 10, '', '2012-12-16', '1355658056', 9, 1),
(16, 'd bfbcdxfn', 10, '', '2012-12-16', '1355659402', 10, 1);

--
-- Triggers `tbl_barang_masuk`
--
DROP TRIGGER IF EXISTS `bm_delete`;
DELIMITER //
CREATE TRIGGER `bm_delete` BEFORE DELETE ON `tbl_barang_masuk`
 FOR EACH ROW BEGIN
UPDATE tbl_barang SET tbl_barang.brg_stok = tbl_barang.brg_stok - OLD.bm_jumlah WHERE tbl_barang.brg_id = OLD.brg_id;
DELETE FROM log_aktifitas WHERE log_time = OLD.bm_time;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bm_insert`;
DELIMITER //
CREATE TRIGGER `bm_insert` AFTER INSERT ON `tbl_barang_masuk`
 FOR EACH ROW BEGIN
UPDATE tbl_barang SET tbl_barang.brg_stok = tbl_barang.brg_stok + NEW.bm_jumlah WHERE tbl_barang.brg_id = NEW.brg_id;
INSERT INTO log_aktifitas (log_type,log_content,log_time,brg_id,user_id) VALUES('+','Penambahan Stok Barang',NEW.bm_time,NEW.brg_id,NEW.user_id);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_barang`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `tbl_jenis_barang`;
CREATE TABLE IF NOT EXISTS `tbl_jenis_barang` (
  `jb_id` int(11) NOT NULL AUTO_INCREMENT,
  `jb_nama` varchar(50) NOT NULL,
  `jb_deskripsi` tinytext NOT NULL,
  PRIMARY KEY (`jb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_jenis_barang`
--

INSERT INTO `tbl_jenis_barang` (`jb_id`, `jb_nama`, `jb_deskripsi`) VALUES
(1, 'Tablet dual core', 'tablet dual core processor'),
(2, 'VGA', 'video graphic accelerator'),
(4, 'SSD', '<p>Solid State Disk</p>'),
(5, 'Notebook', '<p>laptop / notebook</p>'),
(6, 'Desktop PC', '<p>desktop Personal Computer</p>'),
(7, 'Keyboard', 'keyboard'),
(8, 'Gateway', 'gateway'),
(9, 'Wireless router', '<p>wireless router</p>'),
(10, 'power adaptor', ''),
(11, 'PSU', '<p>Power Supply Unit</p>'),
(12, 'Stereo Headphone', 'Headphone'),
(13, 'portable speaker', '<p>portable speaker</p>'),
(14, 'Speaker 2.1', ''),
(15, 'PC Case', '<p>PC casing</p>'),
(16, 'UPS', '<p>back up power supply</p>'),
(17, 'Motheboard AM3', '<p>motherboard socket am3</p>'),
(18, 'Printer', '<p>printer</p>'),
(19, 'Mouse', '<p>tetikus</p>'),
(20, 'LCD Monitor', '<p>liquid crystal display monitor</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suplier`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `tbl_suplier`;
CREATE TABLE IF NOT EXISTS `tbl_suplier` (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_nama` varchar(100) NOT NULL,
  `sp_alamat` varchar(100) NOT NULL,
  `sp_kota` varchar(50) NOT NULL,
  `sp_telp` varchar(20) NOT NULL,
  `sp_fax` varchar(20) NOT NULL,
  `sp_email` varchar(50) NOT NULL,
  `sp_url` varchar(50) NOT NULL,
  `sp_keterangan` tinytext NOT NULL,
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`sp_id`, `sp_nama`, `sp_alamat`, `sp_kota`, `sp_telp`, `sp_fax`, `sp_email`, `sp_url`, `sp_keterangan`) VALUES
(1, 'ERAFONE', 'jl. dimana no.sekian', 'jakarta', '021 0987654', '', '', 'http://', '<p>suplier gadget</p>'),
(2, 'Metrodata', 'jl. entta', 'jakarta', '021 251455', '', '', 'http://id.asus.com', '<p>asus product suplier</p>'),
(3, 'Huawei device', 'jl. ntta', 'jakarta', '', '', '', 'http://www.huaweidevice.com', '<p>huawei suplier</p>'),
(4, 'LG Indonesia', 'jl. klewang', 'surabaya', '', '', '', 'http://www.lg.com/id', '<p>LG product suplier</p>'),
(5, 'Brother Indonesia', 'jl. antah berantah no.999', 'jakarta', '021 426 2873', '', '', 'http://brother.co.id', '<p>suplier printer brother indonesia</p>'),
(6, 'Mega Komputindo Lestari', 'jl. ngawur no.27', 'jakarta', '021 7077 7972', '021 7077 7972', 'info@megakmptindo.com', '', '<p>suplier monitor</p>'),
(7, 'Mirage Indonesia', 'jl. dimana no. brp', 'surabaya', '031-599-4355', '031-599-4355', '', 'http://', ''),
(8, 'Surya Candra', 'jl. jalan no.brp saja', 'jakarta', '021 641 3639', '', '', 'http://', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) NOT NULL,
  `group_description` tinytext NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `group_name` (`group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`group_id`, `group_name`, `group_description`) VALUES
(1, 'admin', 'root administator, group for developer root admin, owner '),
(2, 'user', 'daily user, group for daily use'),
(3, 'for tester', 'group for tester only');

-- --------------------------------------------------------

--
-- Table structure for table `user_member`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `user_member`;
CREATE TABLE IF NOT EXISTS `user_member` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(100) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  `user_photo` varchar(100) NOT NULL DEFAULT 'profile.png',
  `user_theme` varchar(20) NOT NULL DEFAULT 'default',
  `user_last_login` date NOT NULL,
  `user_status` enum('disable','enable') NOT NULL DEFAULT 'disable',
  PRIMARY KEY (`user_id`),
  KEY `group_name` (`group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_member`
--

INSERT INTO `user_member` (`user_id`, `user_fullname`, `user_name`, `user_pass`, `group_name`, `user_photo`, `user_theme`, `user_last_login`, `user_status`) VALUES
(1, 'mochammad chusnul chuluq', 'chuluq', '5a7b4f14a410c8d00fd40d0404a23e536b2629c0', 'admin', 'Gambar002.jpg', 'moonlight', '2013-01-03', 'enable'),
(2, 'zenryo no fuzoku', 'zenryo', '98f41a4a957c3cfa4d882e3ae7aaf4de01b382b3', 'user', 'einstein_devil_mode.JPG', 'moonlight', '2012-12-14', 'enable'),
(4, 'cedric wesmere', 'cedric', '98f41a4a957c3cfa4d882e3ae7aaf4de01b382b3', 'for tester', 'profile.png', 'default', '0000-00-00', 'disable');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_class_method` varchar(100) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`),
  KEY `group_name` (`group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `rule_class_method`, `group_name`) VALUES
(1, 'root.', 'admin'),
(2, 'jenis_barang.index', 'for tester'),
(4, 'barang.index', 'for tester'),
(5, 'jenis_barang.index', 'user'),
(6, 'suplier.index', 'user'),
(7, 'barang.index', 'user'),
(8, 'barang.view', 'user'),
(9, 'suplier.index', 'for tester'),
(10, 'aktifitas.index', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_rule`
--
-- Creation: Jan 01, 2013 at 01:47 PM
--

DROP TABLE IF EXISTS `user_rule`;
CREATE TABLE IF NOT EXISTS `user_rule` (
  `rule_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_class` varchar(50) NOT NULL,
  `rule_method` varchar(50) NOT NULL,
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `user_rule`
--

INSERT INTO `user_rule` (`rule_id`, `rule_class`, `rule_method`) VALUES
(1, 'root', ''),
(2, 'jenis_barang', 'index'),
(3, 'jenis_barang', 'create'),
(4, 'jenis_barang', 'update'),
(5, 'jenis_barang', 'delete'),
(6, 'suplier', 'index'),
(7, 'suplier', 'create'),
(8, 'suplier', 'update'),
(9, 'suplier', 'delete'),
(10, 'suplier', 'view'),
(11, 'barang', 'index'),
(12, 'barang', 'create'),
(13, 'barang', 'create'),
(14, 'barang', 'update'),
(15, 'barang', 'delete'),
(16, 'barang', 'view'),
(17, 'barang_masuk', 'index'),
(18, 'barang_masuk', 'create'),
(19, 'barang_masuk', 'delete'),
(20, 'barang_keluar', 'index'),
(21, 'barang_keluar', 'create'),
(22, 'barang_keluar', 'delete'),
(23, 'users', 'index'),
(24, 'users', 'update_user'),
(25, 'users', 'status_user'),
(26, 'users', 'delete_user'),
(27, 'users', 'create_group'),
(28, 'users', 'update_group'),
(29, 'users', 'delete_group'),
(30, 'users', 'add_role'),
(31, 'users', 'delete_role'),
(32, 'aktifitas', 'index'),
(33, 'config', 'index'),
(34, 'laporan', 'index'),
(35, 'laporan', 'create');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_barang`
--
DROP VIEW IF EXISTS `view_barang`;
CREATE TABLE IF NOT EXISTS `view_barang` (
`brg_id` int(11)
,`brg_nama` varchar(100)
,`brg_kode` varchar(20)
,`brg_deskripsi` tinytext
,`brg_stok` int(10)
,`brg_min_stok` int(10)
,`brg_harga_satuan` double(15,2)
,`brg_timestamp` timestamp
,`brg_vendor` varchar(100)
,`jb_nama` varchar(50)
,`sp_nama` varchar(100)
,`user_name` varchar(15)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_barang_keluar`
--
DROP VIEW IF EXISTS `view_barang_keluar`;
CREATE TABLE IF NOT EXISTS `view_barang_keluar` (
`bk_id` int(11)
,`bk_kode` varchar(20)
,`bk_jumlah` int(10)
,`bk_keterangan` tinytext
,`bk_tgl` date
,`bk_time` varchar(32)
,`brg_nama` varchar(100)
,`user_name` varchar(15)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_barang_masuk`
--
DROP VIEW IF EXISTS `view_barang_masuk`;
CREATE TABLE IF NOT EXISTS `view_barang_masuk` (
`bm_id` int(11)
,`bm_kode` varchar(20)
,`bm_jumlah` int(10)
,`bm_keterangan` tinytext
,`bm_tgl` date
,`bm_time` varchar(32)
,`brg_nama` varchar(100)
,`user_name` varchar(15)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_log`
--
DROP VIEW IF EXISTS `view_log`;
CREATE TABLE IF NOT EXISTS `view_log` (
`log_type` enum('+','-')
,`log_content` varchar(50)
,`log_time` varchar(32)
,`brg_nama` varchar(100)
,`user_name` varchar(15)
);
-- --------------------------------------------------------

--
-- Structure for view `view_barang`
--
DROP TABLE IF EXISTS `view_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang` AS select `a`.`brg_id` AS `brg_id`,`a`.`brg_nama` AS `brg_nama`,`a`.`brg_kode` AS `brg_kode`,`a`.`brg_deskripsi` AS `brg_deskripsi`,`a`.`brg_stok` AS `brg_stok`,`a`.`brg_min_stok` AS `brg_min_stok`,`a`.`brg_harga_satuan` AS `brg_harga_satuan`,`a`.`brg_timestamp` AS `brg_timestamp`,`a`.`brg_vendor` AS `brg_vendor`,`b`.`jb_nama` AS `jb_nama`,`c`.`sp_nama` AS `sp_nama`,`d`.`user_name` AS `user_name` from (((`tbl_barang` `a` join `tbl_jenis_barang` `b`) join `tbl_suplier` `c`) join `user_member` `d`) where ((`a`.`jb_id` = `b`.`jb_id`) and (`a`.`sp_id` = `c`.`sp_id`) and (`a`.`user_id` = `d`.`user_id`));

-- --------------------------------------------------------

--
-- Structure for view `view_barang_keluar`
--
DROP TABLE IF EXISTS `view_barang_keluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang_keluar` AS select `a`.`bk_id` AS `bk_id`,`a`.`bk_kode` AS `bk_kode`,`a`.`bk_jumlah` AS `bk_jumlah`,`a`.`bk_keterangan` AS `bk_keterangan`,`a`.`bk_tgl` AS `bk_tgl`,`a`.`bk_time` AS `bk_time`,`b`.`brg_nama` AS `brg_nama`,`c`.`user_name` AS `user_name` from ((`tbl_barang_keluar` `a` join `tbl_barang` `b`) join `user_member` `c`) where ((`a`.`brg_id` = `b`.`brg_id`) and (`a`.`user_id` = `c`.`user_id`));

-- --------------------------------------------------------

--
-- Structure for view `view_barang_masuk`
--
DROP TABLE IF EXISTS `view_barang_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang_masuk` AS select `a`.`bm_id` AS `bm_id`,`a`.`bm_kode` AS `bm_kode`,`a`.`bm_jumlah` AS `bm_jumlah`,`a`.`bm_keterangan` AS `bm_keterangan`,`a`.`bm_tgl` AS `bm_tgl`,`a`.`bm_time` AS `bm_time`,`b`.`brg_nama` AS `brg_nama`,`c`.`user_name` AS `user_name` from ((`tbl_barang_masuk` `a` join `tbl_barang` `b`) join `user_member` `c`) where ((`a`.`brg_id` = `b`.`brg_id`) and (`a`.`user_id` = `c`.`user_id`));

-- --------------------------------------------------------

--
-- Structure for view `view_log`
--
DROP TABLE IF EXISTS `view_log`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_log` AS select `a`.`log_type` AS `log_type`,`a`.`log_content` AS `log_content`,`a`.`log_time` AS `log_time`,`b`.`brg_nama` AS `brg_nama`,`c`.`user_name` AS `user_name` from ((`log_aktifitas` `a` join `tbl_barang` `b`) join `user_member` `c`) where ((`a`.`brg_id` = `b`.`brg_id`) and (`a`.`user_id` = `c`.`user_id`));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `fk_jb_id` FOREIGN KEY (`jb_id`) REFERENCES `tbl_jenis_barang` (`jb_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sp_id` FOREIGN KEY (`sp_id`) REFERENCES `tbl_suplier` (`sp_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_member` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_barang_keluar`
--
ALTER TABLE `tbl_barang_keluar`
  ADD CONSTRAINT `fk_bk_brg_id` FOREIGN KEY (`brg_id`) REFERENCES `tbl_barang` (`brg_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  ADD CONSTRAINT `fk_bm_brg_id` FOREIGN KEY (`brg_id`) REFERENCES `tbl_barang` (`brg_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_member`
--
ALTER TABLE `user_member`
  ADD CONSTRAINT `fk_group_name` FOREIGN KEY (`group_name`) REFERENCES `user_group` (`group_name`) ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `[OwnerName]_fk[num_for_dup]` FOREIGN KEY (`group_name`) REFERENCES `user_group` (`group_name`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
