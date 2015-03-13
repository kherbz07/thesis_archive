-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2015 at 08:46 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_thesis_archive`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_researchers`
--

CREATE TABLE IF NOT EXISTS `tbl_researchers` (
  `id` int(10) unsigned NOT NULL,
  `thesis_id` int(10) unsigned NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`,`year_id`),
  KEY `thesis_id` (`thesis_id`),
  KEY `year_id` (`year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thesis`
--

CREATE TABLE IF NOT EXISTS `tbl_thesis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `abstract` text NOT NULL,
  `scope` text NOT NULL,
  `year` varchar(20) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `pdf_path` varchar(100) NOT NULL,
  `system_path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `research_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_researchers`
--
ALTER TABLE `tbl_researchers`
  ADD CONSTRAINT `tbl_researchers_ibfk_4` FOREIGN KEY (`year_id`) REFERENCES `tbl_year` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_researchers_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_researchers_ibfk_3` FOREIGN KEY (`thesis_id`) REFERENCES `tbl_thesis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_thesis`
--
ALTER TABLE `tbl_thesis`
  ADD CONSTRAINT `tbl_thesis_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
