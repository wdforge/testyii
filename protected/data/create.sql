-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2016 at 03:58 PM
-- Server version: 5.5.48-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testyii`
--
CREATE DATABASE IF NOT EXISTS `testyii` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `testyii`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(45) DEFAULT NULL COMMENT 'Название автора',
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Авторы книг' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`) VALUES
(1, 'Иванов'),
(2, 'Петров'),
(3, 'Сидоров'),
(4, 'Васечкин'),
(5, 'Капустин'),
(6, 'Капустян'),
(7, 'Капустиненко'),
(8, 'Сидорчук'),
(9, 'Петренко'),
(10, 'Иваненко');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(45) DEFAULT NULL COMMENT 'Название книги',
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Книги' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`) VALUES
(1, 'Восстание ягнят'),
(2, 'Шашлык из ценных пород дерева'),
(3, 'Выращивание овощей на клумбе'),
(4, 'Полезные браконьеры'),
(5, 'Грядка как лекарство');

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `book_author_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL COMMENT 'Книга',
  `author_id` int(11) DEFAULT NULL COMMENT 'Автор',
  PRIMARY KEY (`book_author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Связь автор - [версия - книга]' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`book_author_id`, `book_id`, `author_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 3),
(6, 3, 3),
(7, 4, 4),
(8, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `book_version`
--

CREATE TABLE IF NOT EXISTS `book_version` (
  `book_version_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL COMMENT 'Книга',
  `provider_id` int(11) DEFAULT NULL COMMENT 'Поставщик',
  `book_date` date DEFAULT NULL COMMENT 'Дата (для наглядности)',
  PRIMARY KEY (`book_version_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Версии книг [издания]' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `book_version`
--

INSERT INTO `book_version` (`book_version_id`, `book_id`, `provider_id`, `book_date`) VALUES
(1, 1, 2, '2011-01-01'),
(2, 1, 3, '2005-01-01'),
(3, 2, 1, '2007-01-01'),
(4, 2, 2, '2008-01-01'),
(5, 3, 3, '2009-01-01'),
(6, 3, 1, '2010-01-01'),
(7, 4, 2, '2012-01-01'),
(8, 4, 4, '2013-01-01'),
(9, 5, 1, '2014-01-01'),
(10, 1, 1, '2015-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_fio` varchar(40) DEFAULT NULL COMMENT 'ФИО заказчика',
  `order_status_id` int(11) DEFAULT NULL COMMENT 'Статус заказа',
  `order_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Метка времени',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Клиентские заказы' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(45) DEFAULT NULL COMMENT 'Название статуса',
  PRIMARY KEY (`order_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Статусы заказа' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_status_name`) VALUES
(1, 'Новый'),
(2, 'Обработан');

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE IF NOT EXISTS `provider` (
  `provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`provider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`provider_id`, `provider_name`) VALUES
(1, 'Книжное дело'),
(2, 'Книга даром'),
(3, 'Книгой по голове'),
(4, 'Книга людям');

-- --------------------------------------------------------

--
-- Table structure for table `provider_order`
--

CREATE TABLE IF NOT EXISTS `provider_order` (
  `provider_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_version_id` int(11) DEFAULT NULL COMMENT 'Версия книги со стороны авторов',
  `provider_order_count` int(11) DEFAULT NULL COMMENT 'Количество в заказе',
  `order_id` int(11) DEFAULT NULL COMMENT 'Указатель на заказ клиента',
  `order_status_id` int(11) DEFAULT NULL COMMENT 'Статус заказа поставщика',
  PRIMARY KEY (`provider_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Связь поставщик - [версия - книга]' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1467963972);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
