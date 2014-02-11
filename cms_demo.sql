-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2013 at 02:02 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(20) NOT NULL,
  `url` varchar(20) NOT NULL,
  `static` int(1) NOT NULL,
  `view` varchar(20) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `url`, `static`, `view`, `active`) VALUES
(2, 'List User', '/manage/index', 0, '0', 1),
(3, 'List Menu', '/managemenu/index', 0, '0', 1),
(6, 'About', '/site/page', 1, 'about', 1),
(7, 'Contact', '/site/contact', 0, '0', 1),
(9, 'Manage Previlige', '/usertype/index', 0, '0', 1),
(15, 'fancy_box', '/fancybox/index', 0, '0', 1),
(16, 'new', '/site/error', 0, '0', 0),
(17, 'db_relation', '/DBrelations/Index', 0, '0', 1),
(18, 'Ajax', '/Ajax/Index', 0, '0', 1),
(19, 'menu_sortable', '/Menu_sortable/Index', 0, '0', 1),
(20, 'Soap', '/Ajax/Soap', 0, '0', 1),
(21, 'Ajax Image Upload', '/Ajax/Imageupload', 0, '0', 1),
(22, 'Default Upload', '/Ajax/Defupload', 0, '0', 1),
(23, 'Files', '/Fileops/Index', 0, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `path`) VALUES
(30, 'HumanRightsLogo_CO.jpg'),
(31, 'header_repeat.jpg'),
(32, 'Grass-nature-86.jpg'),
(33, 'Grass-nature-86.jpg'),
(34, 'down-arrow-red.png'),
(35, 'angry-hi.jpg'),
(36, 'Grass-nature-86.jpg'),
(37, 'down-arrow-green.png'),
(38, 'Grass-nature-86.jpg'),
(39, 'header_repeat.jpg'),
(40, 'index.jpeg'),
(41, 'down-arrow-red.png'),
(42, 'Grass-nature-86.jpg'),
(43, 'HumanRightsLogo_CO.jpg'),
(44, 'header_repeat.jpg'),
(45, 'Grass-nature-86.jpg'),
(46, 'angry-hi.jpg'),
(47, 'HumanRightsLogo_CO.jpg'),
(48, 'index.jpeg'),
(49, 'Grass-nature-86.jpg'),
(50, 'down-arrow-red.png'),
(51, 'header_repeat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `userpass` varchar(20) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype_id` (`usertype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype_id`, `username`, `userpass`, `remarks`) VALUES
(2, 2, 'admin', 'admin', '-ok'),
(3, 3, 'user', 'user', '-'),
(5, 1, 'sadmin', 'sadmin', '-'),
(6, 2, 'test', 'test_pass', '-'),
(7, 2, 'another_admin', 'test_pass', '--');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  `actions` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `role`, `actions`) VALUES
(1, 'superadmin', '3,2,9,19,18,20,17,15,21,22,23'),
(2, 'admin', '7,3,2,6'),
(3, 'user', '7,6'),
(4, 'guest', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`usertype_id`) REFERENCES `usertype` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
