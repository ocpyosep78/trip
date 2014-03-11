-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 06:57 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trip_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category`
--


-- --------------------------------------------------------

--
-- Table structure for table `category_sub`
--

CREATE TABLE IF NOT EXISTS `category_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category_sub`
--


-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `alias` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `region_id`, `name`, `alias`) VALUES
(4, 4, 'Bekok', 'bekok'),
(5, 4, 'Batu Pahat', 'batu-pahat'),
(6, 5, 'Serawak 1', 'serawak-1'),
(8, 4, 'Ayer Baloi', 'ayer-baloi'),
(9, 4, 'Ayer Hitam', 'ayer-hitam'),
(10, 4, 'Bakri', 'bakri'),
(11, 4, 'Batu Anam', 'batu-anam'),
(12, 4, 'Batu Pahat', 'batu-pahat'),
(13, 4, 'Bekok-salah', 'bekok-salah'),
(14, 4, 'Benut', 'benut'),
(15, 4, 'Bukit Gambir', 'bukit-gambir'),
(16, 4, 'Bukit Pasir', 'bukit-pasir'),
(17, 4, 'Chaah', 'chaah'),
(18, 4, 'Endau', 'endau'),
(19, 4, 'Gelang Patah', 'gelang-patah'),
(20, 4, 'Gerisek', 'gerisek'),
(21, 4, 'Gugusan Taib Andak', 'gugusan-taib-andak'),
(22, 4, 'Jementah', 'jementah'),
(23, 4, 'Johor Bahru', 'johor-bahru'),
(24, 4, 'Kahang', 'kahang'),
(25, 4, 'Kampung Kenangan Tun Dr Ismail', 'kampung-kenangan-tun-dr-ismail'),
(26, 4, 'Kluang', 'kluang'),
(27, 4, 'Kota Tinggi', 'kota-tinggi'),
(28, 4, 'Kukup', 'kukup'),
(29, 4, 'Kulai', 'kulai'),
(30, 4, 'Labis', 'labis'),
(31, 4, 'Layang Layang', 'layang-layang'),
(32, 4, 'Masai', 'masai'),
(33, 4, 'Mersing', 'mersing'),
(34, 4, 'Muar', 'muar'),
(35, 4, 'Pagoh', 'pagoh'),
(36, 4, 'Paloh', 'paloh'),
(37, 4, 'Panchor', 'panchor'),
(38, 4, 'Parit Jawa', 'parit-jawa'),
(39, 4, 'Parit Raja', 'parit-raja'),
(40, 4, 'Parit Sulong', 'parit-sulong'),
(41, 4, 'Pasir Gudang', 'pasir-gudang'),
(42, 4, 'Pekan Nanas', 'pekan-nanas'),
(43, 4, 'Pengerang', 'pengerang'),
(44, 4, 'Plentong', 'plentong'),
(45, 4, 'Pontian', 'pontian'),
(46, 4, 'Rengam', 'rengam'),
(47, 4, 'Rengit', 'rengit'),
(48, 4, 'Segamat', 'segamat'),
(49, 4, 'Semerah', 'semerah'),
(50, 4, 'Senai', 'senai'),
(51, 4, 'Senggarang', 'senggarang'),
(52, 4, 'Seri Gadang', 'seri-gadang'),
(53, 4, 'Simpang Rengam', 'simpang-rengam'),
(54, 4, 'Skudai', 'skudai'),
(55, 4, 'Sungai Mati', 'sungai-mati'),
(56, 4, 'Tampoi', 'tampoi'),
(57, 4, 'Tangkak', 'tangkak'),
(58, 4, 'Ulu Tiram', 'ulu-tiram'),
(59, 4, 'Yong Peng', 'yong-peng');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(75) NOT NULL,
  `name` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `alias`, `name`) VALUES
(4, 'johor', 'Johor'),
(5, 'serawak', 'Serawak'),
(6, 'sabah', 'Sabah'),
(8, 'kedah', 'Kedah'),
(9, 'kelantan', 'Kelantan'),
(10, 'kuala-lumpur', 'Kuala Lumpur'),
(11, 'melaka', 'Melaka'),
(12, 'n-sembilan', 'N. Sembilan'),
(13, 'pahang', 'Pahang'),
(14, 'penang', 'Penang'),
(15, 'perak', 'Perak'),
(16, 'perlis', 'Perlis'),
(17, 'selangor', 'Selangor'),
(18, 'terengganu', 'Terengganu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alias` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `passwd_reset_key` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `bb_pin` varchar(50) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `user_about` varchar(255) NOT NULL,
  `user_info` varchar(255) NOT NULL,
  `advert_count` int(11) NOT NULL,
  `register_date` datetime NOT NULL,
  `membership_date` date NOT NULL,
  `reset_key` varchar(75) NOT NULL,
  `verify_profile` int(11) NOT NULL,
  `verify_email` int(11) NOT NULL,
  `verify_address` int(11) NOT NULL,
  `thumbnail_profile` varchar(75) NOT NULL,
  `thumbnail_banner` varchar(75) NOT NULL,
  `ic_number` varchar(50) NOT NULL,
  `is_ic_number` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `city_id`, `user_type_id`, `email`, `alias`, `first_name`, `last_name`, `passwd`, `passwd_reset_key`, `address`, `phone`, `bb_pin`, `postal_code`, `user_about`, `user_info`, `advert_count`, `register_date`, `membership_date`, `reset_key`, `verify_profile`, `verify_email`, `verify_address`, `thumbnail_profile`, `thumbnail_banner`, `ic_number`, `is_ic_number`, `is_active`, `is_delete`) VALUES
(2, 6, 1, 'her0satr@yahoo.com', 'her0satr', 'Herry', 'Satrio', 'fe30fa79056939db8cbe99c8d601de74', '', 'Malang', '56465465', '123456 2S', '55555', 'Artist 4', 'Ini user info saya :)', 10, '2013-10-17 03:17:56', '2014-11-23', '', 0, 1, 1, '2014/02/10/20140210_081800_3321.jpg', '2014/02/10/20140210_081712_7314.png', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `log_time` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `ip_remote` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `log_time`, `location`, `ip_remote`) VALUES
(1, 2, '2014-03-10 18:49:22', 'localhost', '::1'),
(2, 2, '2014-03-10 18:49:27', 'localhost', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Editor'),
(3, 'Member');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
