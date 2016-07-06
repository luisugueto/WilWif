-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2016 at 06:15 PM
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
CREATE DATABASE IF NOT EXISTS `ap_wilwif` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ap_wilwif`;

-- --------------------------------------------------------

--
-- Table structure for table `activation_code`
--

CREATE TABLE IF NOT EXISTS `activation_code` (
  `id` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `used` tinyint(1) DEFAULT NULL,
  `activation_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
`id` int(11) NOT NULL,
  `id_user_create` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `id_user_invited` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE IF NOT EXISTS `chat_message` (
`id` int(11) NOT NULL,
  `message` varchar(45) NOT NULL,
  `id_chat` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `received` tinyint(1) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
`id` int(11) NOT NULL,
  `option` varchar(45) NOT NULL,
  `value` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `action` varchar(45) NOT NULL,
  `data` varchar(45) DEFAULT NULL,
  `target` varchar(45) DEFAULT NULL,
  `id_target` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
`id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `findlost_address` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `last_mod_date` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE IF NOT EXISTS `item_category` (
`id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_photo`
--

CREATE TABLE IF NOT EXISTS `item_photo` (
`id` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `id_item` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`id` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `id_item` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `message` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `id_user_send` int(11) NOT NULL,
  `id_user_recived` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `last_mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
`id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permission_rol`
--

CREATE TABLE IF NOT EXISTS `permission_rol` (
  `id_permission` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
`id` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `security_question`
--

CREATE TABLE IF NOT EXISTS `security_question` (
`id` int(11) NOT NULL,
  `label` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `submit`
--

CREATE TABLE IF NOT EXISTS `submit` (
`id` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `message` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `id_user_send` int(11) NOT NULL,
  `id_user_recive` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `last_mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  `name` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `security_question` varchar(45) DEFAULT NULL,
  `security_answer` varchar(45) DEFAULT NULL,
  `blocked` tinyint(1) DEFAULT NULL,
  `login_attemps` int(3) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `last_mod_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_photo`
--

CREATE TABLE IF NOT EXISTS `user_photo` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_code`
--
ALTER TABLE `activation_code`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_activation_code_user_idx` (`id_user`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_chat_user_2_idx` (`id_user_invited`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_chat_message_chat_idx` (`id_chat`), ADD KEY `fk_chat_message_user_idx` (`id_user`), ADD KEY `fk_chat_message_status_idx` (`status`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_item_user_idx` (`id_user`), ADD KEY `fk_item_category_idx` (`id_category`), ADD KEY `fk_item_status_idx` (`status`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_photo`
--
ALTER TABLE `item_photo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_item_photo_item_idx` (`id_item`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_order_user_idx` (`id_user_send`), ADD KEY `fk_order_user_2_idx` (`id_user_recived`), ADD KEY `fk_order_item_idx` (`id_item`), ADD KEY `fk_order_status_idx` (`status`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_rol`
--
ALTER TABLE `permission_rol`
 ADD PRIMARY KEY (`id_permission`,`id_rol`), ADD KEY `fk_permission_rol_rol_idx` (`id_rol`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_question`
--
ALTER TABLE `security_question`
 ADD PRIMARY KEY (`id`), ADD KEY `index2` (`label`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`), ADD KEY `index2` (`status`);

--
-- Indexes for table `submit`
--
ALTER TABLE `submit`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_submit_user_idx` (`id_user_send`,`id_user_recive`), ADD KEY `fk_submit_item_idx` (`id_item`), ADD KEY `fk_status_item_idx` (`status`), ADD KEY `fk_submit_2_user_idx` (`id_user_recive`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_rol_idx` (`rol_id`), ADD KEY `fk_user_status_idx` (`status`), ADD KEY `fk_user_securty_question_idx` (`security_question`);

--
-- Indexes for table `user_photo`
--
ALTER TABLE `user_photo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_photo_user_idx` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item_photo`
--
ALTER TABLE `item_photo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `security_question`
--
ALTER TABLE `security_question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `submit`
--
ALTER TABLE `submit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_photo`
--
ALTER TABLE `user_photo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activation_code`
--
ALTER TABLE `activation_code`
ADD CONSTRAINT `fk_activation_code_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
ADD CONSTRAINT `fk_chat_user_2` FOREIGN KEY (`id_user_invited`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `chat_message`
--
ALTER TABLE `chat_message`
ADD CONSTRAINT `fk_chat_message_chat` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_chat_message_status` FOREIGN KEY (`status`) REFERENCES `status` (`status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_chat_message_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `fk_item_category` FOREIGN KEY (`id_category`) REFERENCES `item_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_item_status` FOREIGN KEY (`status`) REFERENCES `status` (`status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_item_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_photo`
--
ALTER TABLE `item_photo`
ADD CONSTRAINT `fk_item_photo_item_2` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
ADD CONSTRAINT `fk_order_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_order_status` FOREIGN KEY (`status`) REFERENCES `status` (`status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`id_user_send`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_order_user_2` FOREIGN KEY (`id_user_recived`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permission_rol`
--
ALTER TABLE `permission_rol`
ADD CONSTRAINT `fk_permission_rol_permission` FOREIGN KEY (`id_permission`) REFERENCES `permission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_permission_rol_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `submit`
--
ALTER TABLE `submit`
ADD CONSTRAINT `fk_submit_2_user` FOREIGN KEY (`id_user_recive`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_submit_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_submit_status` FOREIGN KEY (`status`) REFERENCES `status` (`status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_submit_user` FOREIGN KEY (`id_user_send`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `fk_user_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_user_securty_question` FOREIGN KEY (`security_question`) REFERENCES `security_question` (`label`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_user_status` FOREIGN KEY (`status`) REFERENCES `status` (`status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_photo`
--
ALTER TABLE `user_photo`
ADD CONSTRAINT `fk_user_photo_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
