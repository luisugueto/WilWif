-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2016 at 03:49 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ap_wilwif`
--

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `id_category`, `code`, `name`, `description`, `title`, `status`, `country`, `city`, `findlost_address`, `create_date`, `last_mod_date`, `id_user`, `type`) VALUES
(14, 1, '2016-0629-bGUS-ikLe', 'prueba 3', 'prueba 2', 'prueba 2', 'Active', '', '', 'prueba 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Found'),
(15, 1, '2016-0629-HzuD-tbFu', 'prueba 3', 'prueba 2', 'prueba 2', 'Active', '', '', 'prueba 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Found'),
(16, 1, '2016-0629-TzED-XJHD', 'prueba 3', 'Germany\r\nAlado de mi casa', 'prueba 2', 'Deleted', 'VE', 'caracas 2', 'prueba 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Found'),
(17, 1, '2016-0629-VjvJ-UxWT', 'prueba 3', 'prueba 2', 'prueba 2', 'Active', '', '', 'prueba 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Found');

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `name`, `slug`) VALUES
(1, 'Document of International Identity', 'Passport'),
(2, 'Document of identity', 'ID');

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `description`) VALUES
(1, 'Active', 'is current active'),
(2, 'Deleted', 'borrado para el sistema');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `active`, `resetToken`, `resetComplete`, `name`, `lastname`, `rol_id`, `status`, `security_question`, `security_answer`, `blocked`, `login_attemps`, `create_date`, `last_mod_date`) VALUES
(1, 'omar', '7c26db9aa7fb3bed65d2bfbd3ca37dc5', 'omar.angelino@zuaru.com', '1', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'luis', '81dc9bdb52d04dc20036dbd8313ed055', 'blink242@outlook.com', '1', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'omar', 'omar', 'omar@omar.com', '', NULL, 'No', 'omar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'omar2', 'omar', 'omar2@omar.com', '', NULL, 'No', 'omar2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
