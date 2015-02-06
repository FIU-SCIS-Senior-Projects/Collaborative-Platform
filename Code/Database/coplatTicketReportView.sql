-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2015 at 01:24 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coplat`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `report_ticket`
--
DROP VIEW IF EXISTS `report_ticket`;
CREATE TABLE `report_ticket` (
`ticketID` int(11) unsigned
,`creatorID` int(11) unsigned
,`creatorFirstName` varchar(45)
,`creatorMiddleName` varchar(45)
,`creatorLastName` varchar(100)
,`creatorDisabled` tinyint(1)
,`creatorEmail` varchar(255)
,`ticketStatus` varchar(45)
,`ticketCratedDate` datetime
,`ticketSubject` varchar(45)
,`ticketDescription` varchar(500)
,`ticketAssignUserID` int(11) unsigned
,`assignedUserFirstName` varchar(45)
,`assignedUserLastName` varchar(100)
,`assignedUserMiddleName` varchar(45)
,`assignedUserDisabled` tinyint(1)
,`assignedUserEmail` varchar(255)
,`ticketDomainID` int(11) unsigned
,`ticketDomainName` varchar(45)
,`ticketSubDomticketainID` int(11) unsigned
,`ticketSubDomainName` varchar(45)
,`ticketPriority` int(11)
,`ticketPriorityDescription` varchar(45)
,`ticketAssignedDate` datetime
,`ticketClosedDate` datetime
,`ticketIsEscalated` tinyint(1)
);
-- --------------------------------------------------------

--
-- Structure for view `report_ticket`
--
DROP TABLE IF EXISTS `report_ticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_ticket` AS select `ticket`.`id` AS `ticketID`,`ticket`.`creator_user_id` AS `creatorID`,`ticketowner`.`fname` AS `creatorFirstName`,`ticketowner`.`mname` AS `creatorMiddleName`,`ticketowner`.`lname` AS `creatorLastName`,`ticketowner`.`disable` AS `creatorDisabled`,`ticketowner`.`email` AS `creatorEmail`,`ticket`.`status` AS `ticketStatus`,`ticket`.`created_date` AS `ticketCratedDate`,`ticket`.`subject` AS `ticketSubject`,`ticket`.`description` AS `ticketDescription`,`ticket`.`assign_user_id` AS `ticketAssignUserID`,`userassigned`.`fname` AS `assignedUserFirstName`,`userassigned`.`lname` AS `assignedUserLastName`,`userassigned`.`mname` AS `assignedUserMiddleName`,`userassigned`.`disable` AS `assignedUserDisabled`,`userassigned`.`email` AS `assignedUserEmail`,`ticket`.`domain_id` AS `ticketDomainID`,`ticketdomain`.`name` AS `ticketDomainName`,`ticket`.`subdomain_id` AS `ticketSubDomticketainID`,`ticketsubdomain`.`name` AS `ticketSubDomainName`,`ticket`.`priority_id` AS `ticketPriority`,`ticketpriority`.`description` AS `ticketPriorityDescription`,`ticket`.`assigned_date` AS `ticketAssignedDate`,`ticket`.`closed_date` AS `ticketClosedDate`,`ticket`.`isEscalated` AS `ticketIsEscalated` from (((((`ticket` join `user` `ticketowner` on((`ticketowner`.`id` = `ticket`.`creator_user_id`))) join `domain` `ticketdomain` on((`ticketdomain`.`id` = `ticket`.`domain_id`))) join `priority` `ticketpriority` on((`ticketpriority`.`id` = `ticket`.`priority_id`))) left join `user` `userassigned` on((`userassigned`.`id` = `ticket`.`assign_user_id`))) left join `subdomain` `ticketsubdomain` on((`ticketsubdomain`.`id` = `ticket`.`subdomain_id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
