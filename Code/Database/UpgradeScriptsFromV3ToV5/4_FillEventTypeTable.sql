-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2015 at 03:01 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `coplat`
--

--
-- Dumping data for table `event_type`
--

INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(1, 'New ');
INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(2, 'Status changed ');
INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(3, 'Assigned to user ');
INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(4, 'Commented by owner ');
INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(5, 'Commented by mentor ');
INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(6, 'Escalated to ');
INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(7, 'Escalated from ');
INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(8, 'Opened by owner ');
INSERT IGNORE INTO `event_type` (`id`, `description`) VALUES(9, 'Opened by mentor ');

