-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Сер 05 2016 р., 15:00
-- Версія сервера: 5.5.49-0ubuntu0.14.04.1
-- Версія PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `code`
--

-- --------------------------------------------------------

--
-- Структура таблиці `Department`
--

CREATE TABLE IF NOT EXISTS `Department` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Дамп даних таблиці `Department`
--

INSERT INTO `Department` (`Id`, `Name`) VALUES
(1, 'IT'),
(2, 'Sales');

-- --------------------------------------------------------

--
-- Структура таблиці `Employee`
--

CREATE TABLE IF NOT EXISTS `Employee` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Salary` varchar(255) NOT NULL,
  `DepartmentId` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Дамп даних таблиці `Employee`
--

INSERT INTO `Employee` (`Id`, `Name`, `Salary`, `DepartmentId`) VALUES
(1, 'Joe', '70000', '1'),
(2, 'Henry', '80000', '2'),
(3, 'Sam', '60000', '2'),
(4, 'Max', '90000', '1'),
(5, 'Janet', '69000', '1'),
(6, 'Randy', '85000', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
