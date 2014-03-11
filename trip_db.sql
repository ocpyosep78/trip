-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2014 at 10:06 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trip_db`
--
CREATE DATABASE IF NOT EXISTS `trip_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `trip_db`;

-- --------------------------------------------------------

--
-- Table structure for table `auto_complete`
--

CREATE TABLE IF NOT EXISTS `auto_complete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `category_facility`
--

CREATE TABLE IF NOT EXISTS `category_facility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `searchable` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `title` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `region_id`, `alias`, `title`) VALUES
(4, 4, 'bekok', 'Bekok'),
(5, 4, 'batu-pahat', 'Batu Pahat'),
(6, 5, 'serawak-1', 'Serawak 1'),
(8, 4, 'ayer-baloi', 'Ayer Baloi'),
(9, 4, 'ayer-hitam', 'Ayer Hitam'),
(10, 4, 'bakri', 'Bakri'),
(11, 4, 'batu-anam', 'Batu Anam'),
(12, 4, 'batu-pahat', 'Batu Pahat'),
(13, 4, 'bekok-salah', 'Bekok-salah'),
(14, 4, 'benut', 'Benut'),
(15, 4, 'bukit-gambir', 'Bukit Gambir'),
(16, 4, 'bukit-pasir', 'Bukit Pasir'),
(17, 4, 'chaah', 'Chaah'),
(18, 4, 'endau', 'Endau'),
(19, 4, 'gelang-patah', 'Gelang Patah'),
(20, 4, 'gerisek', 'Gerisek'),
(21, 4, 'gugusan-taib-andak', 'Gugusan Taib Andak'),
(22, 4, 'jementah', 'Jementah'),
(23, 4, 'johor-bahru', 'Johor Bahru'),
(24, 4, 'kahang', 'Kahang'),
(25, 4, 'kampung-kenangan-tun-dr-ismail', 'Kampung Kenangan Tun Dr Ismail'),
(26, 4, 'kluang', 'Kluang'),
(27, 4, 'kota-tinggi', 'Kota Tinggi'),
(28, 4, 'kukup', 'Kukup'),
(29, 4, 'kulai', 'Kulai'),
(30, 4, 'labis', 'Labis'),
(31, 4, 'layang-layang', 'Layang Layang'),
(32, 4, 'masai', 'Masai'),
(33, 4, 'mersing', 'Mersing'),
(34, 4, 'muar', 'Muar'),
(35, 4, 'pagoh', 'Pagoh'),
(36, 4, 'paloh', 'Paloh'),
(37, 4, 'panchor', 'Panchor'),
(38, 4, 'parit-jawa', 'Parit Jawa'),
(39, 4, 'parit-raja', 'Parit Raja'),
(40, 4, 'parit-sulong', 'Parit Sulong'),
(41, 4, 'pasir-gudang', 'Pasir Gudang'),
(42, 4, 'pekan-nanas', 'Pekan Nanas'),
(43, 4, 'pengerang', 'Pengerang'),
(44, 4, 'plentong', 'Plentong'),
(45, 4, 'pontian', 'Pontian'),
(46, 4, 'rengam', 'Rengam'),
(47, 4, 'rengit', 'Rengit'),
(48, 4, 'segamat', 'Segamat'),
(49, 4, 'semerah', 'Semerah'),
(50, 4, 'senai', 'Senai'),
(51, 4, 'senggarang', 'Senggarang'),
(52, 4, 'seri-gadang', 'Seri Gadang'),
(53, 4, 'simpang-rengam', 'Simpang Rengam'),
(54, 4, 'skudai', 'Skudai'),
(55, 4, 'sungai-mati', 'Sungai Mati'),
(56, 4, 'tampoi', 'Tampoi'),
(57, 4, 'tangkak', 'Tangkak'),
(58, 4, 'ulu-tiram', 'Ulu Tiram'),
(59, 4, 'yong-peng', 'Yong Peng');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE IF NOT EXISTS `facility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_booking`
--

CREATE TABLE IF NOT EXISTS `hotel_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_detail`
--

CREATE TABLE IF NOT EXISTS `hotel_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `booking` longtext NOT NULL,
  `rate_per_night` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_amenity`
--

CREATE TABLE IF NOT EXISTS `hotel_room_amenity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `room_amenity_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` longtext NOT NULL,
  `desc_01` longtext NOT NULL,
  `desc_02` longtext NOT NULL,
  `desc_03` longtext NOT NULL,
  `field_01` longtext NOT NULL,
  `map` float NOT NULL,
  `star` int(11) NOT NULL,
  `post_status` varchar(50) NOT NULL COMMENT 'pending / approve / reject',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_facility`
--

CREATE TABLE IF NOT EXISTS `post_facility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_gallery`
--

CREATE TABLE IF NOT EXISTS `post_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `post_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_traveler_photo`
--

CREATE TABLE IF NOT EXISTS `post_traveler_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `post_time` date NOT NULL,
  `post_status` varchar(50) NOT NULL COMMENT 'pending / approve / reject',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_traveler_review`
--

CREATE TABLE IF NOT EXISTS `post_traveler_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `post_date` date NOT NULL,
  `post_status` varchar(50) NOT NULL COMMENT 'pending / approve / reject',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `promo_duration_id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `keyword` longtext NOT NULL,
  `publish_date` date NOT NULL,
  `close_date` date NOT NULL,
  `promo_status` varchar(50) NOT NULL COMMENT 'pending / approve / reject',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `promo_duration`
--

CREATE TABLE IF NOT EXISTS `promo_duration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `cost` int(11) NOT NULL,
  `duration` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `alias` varchar(75) NOT NULL,
  `title` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `country_id`, `alias`, `title`) VALUES
(4, 0, 'johor', 'Johor'),
(5, 0, 'serawak', 'Serawak'),
(6, 0, 'sabah', 'Sabah'),
(8, 0, 'kedah', 'Kedah'),
(9, 0, 'kelantan', 'Kelantan'),
(10, 0, 'kuala-lumpur', 'Kuala Lumpur'),
(11, 0, 'melaka', 'Melaka'),
(12, 0, 'n-sembilan', 'N. Sembilan'),
(13, 0, 'pahang', 'Pahang'),
(14, 0, 'penang', 'Penang'),
(15, 0, 'perak', 'Perak'),
(16, 0, 'perlis', 'Perlis'),
(17, 0, 'selangor', 'Selangor'),
(18, 0, 'terengganu', 'Terengganu');

-- --------------------------------------------------------

--
-- Table structure for table `room_amenity`
--

CREATE TABLE IF NOT EXISTS `room_amenity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `log_time`, `location`, `ip_remote`) VALUES
(1, 2, '2014-03-10 18:49:22', 'localhost', '::1'),
(2, 2, '2014-03-10 18:49:27', 'localhost', '::1'),
(3, 2, '2014-03-11 08:20:42', 'localhost', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Editor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
