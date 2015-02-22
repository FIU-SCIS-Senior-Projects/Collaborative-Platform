-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2015 at 09:14 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `coplat`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

DROP TABLE IF EXISTS `event_type`;
CREATE TABLE IF NOT EXISTS `event_type` (
`id` int(11) NOT NULL COMMENT 'Id of the event type.',
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Records events';

-- --------------------------------------------------------

--
-- Table structure for table `ticket_events`
--

DROP TABLE IF EXISTS `ticket_events`;
CREATE TABLE IF NOT EXISTS `ticket_events` (
`id` int(11) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `ticket_id` int(10) unsigned NOT NULL,
  `event_recorded_date` datetime NOT NULL COMMENT 'date of the event recorded',
  `old_value` varchar(200) DEFAULT NULL,
  `new_value` varchar(200) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `event_performed_by_user_id` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table records changes in the tickets such as when is created, when is assigned by user, the status changes, when is escalated, when is commented by owner, escalated, etc';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `description_UNIQUE` (`description`);

--
-- Indexes for table `ticket_events`
--
ALTER TABLE `ticket_events`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `ticket_event_fk_idx` (`event_type_id`), ADD KEY `ticket_fk_idx` (`ticket_id`), ADD KEY `ticket_event_type_idx` (`event_type_id`,`ticket_id`), ADD KEY `performed_by_fk_idx` (`event_performed_by_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id of the event type.',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ticket_events`
--
ALTER TABLE `ticket_events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket_events`
--
ALTER TABLE `ticket_events`
ADD CONSTRAINT `event_fk` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `performed_by_fk` FOREIGN KEY (`event_performed_by_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `ticket_fk` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
