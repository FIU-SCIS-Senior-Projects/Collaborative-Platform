-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2015 at 12:02 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coplat`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `report_mentee`
--
DROP VIEW IF EXISTS `report_mentee`;
CREATE TABLE `report_mentee` (
`menteeUserID` int(11) unsigned
,`menteeUserName` varchar(45)
,`menteeEmail` varchar(255)
,`menteeFirstName` varchar(45)
,`menteeMiddleName` varchar(45)
,`menteeLastName` varchar(100)
,`menteeDisabled` tinyint(1)
,`menteeUniversityID` int(11) unsigned
,`menteeUniversityNamementee` varchar(50)
,`menteePersonalMentorID` int(11) unsigned
,`menteePersonalMentorEmail` varchar(255)
,`menteePersonalMentorFirstName` varchar(45)
,`menteePersonalMentorMiddleName` varchar(45)
,`menteePersonalMentorLastName` varchar(100)
,`menteePersonalMentorDisabled` tinyint(1)
,`menteeProjectID` int(11) unsigned
,`menteeProjectTitle` varchar(45)
,`menteeProjectStartData` date
,`menteeProjectDueDate` date
,`menteeProjectCustomerFirstName` varchar(20)
,`menteeProjectCustomerLastname` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `report_mentor`
--
DROP VIEW IF EXISTS `report_mentor`;
CREATE TABLE `report_mentor` (
`MentorUserName` varchar(45)
,`MentorEmail` varchar(255)
,`MentorFirstName` varchar(45)
,`MentorLastName` varchar(100)
,`MentorMiddleName` varchar(45)
,`MentorDisabled` tinyint(1)
,`MentorEmployeuser_info` varchar(50)
,`MentorPosition` varchar(50)
,`MentorDegree` varchar(50)
,`MentorFieldOfStudy` varchar(50)
,`MentorGradYear` int(4) unsigned
);
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
-- Structure for view `report_mentee`
--
DROP TABLE IF EXISTS `report_mentee`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_mentee` AS select `user`.`id` AS `menteeUserID`,`user`.`username` AS `menteeUserName`,`user`.`email` AS `menteeEmail`,`user`.`fname` AS `menteeFirstName`,`user`.`mname` AS `menteeMiddleName`,`user`.`lname` AS `menteeLastName`,`user`.`disable` AS `menteeDisabled`,`user`.`university_id` AS `menteeUniversityID`,`menteeuniversity`.`name` AS `menteeUniversityNamementee`,`personalmentoruser`.`id` AS `menteePersonalMentorID`,`personalmentoruser`.`email` AS `menteePersonalMentorEmail`,`personalmentoruser`.`fname` AS `menteePersonalMentorFirstName`,`personalmentoruser`.`mname` AS `menteePersonalMentorMiddleName`,`personalmentoruser`.`lname` AS `menteePersonalMentorLastName`,`personalmentoruser`.`disable` AS `menteePersonalMentorDisabled`,`menteeuser`.`project_id` AS `menteeProjectID`,`menteeproject`.`title` AS `menteeProjectTitle`,`menteeproject`.`start_date` AS `menteeProjectStartData`,`menteeproject`.`due_date` AS `menteeProjectDueDate`,`menteeproject`.`customer_fname` AS `menteeProjectCustomerFirstName`,`menteeproject`.`customer_lname` AS `menteeProjectCustomerLastname` from (((((`user` left join `mentee` `menteeuser` on((`user`.`id` = `menteeuser`.`user_id`))) left join `university` `menteeuniversity` on((`menteeuniversity`.`id` = `user`.`university_id`))) left join `personal_mentor` `personalmentor` on((`personalmentor`.`user_id` = `menteeuser`.`personal_mentor_user_id`))) left join `user` `personalmentoruser` on((`personalmentoruser`.`id` = `personalmentor`.`user_id`))) left join `project` `menteeproject` on((`menteeproject`.`id` = `menteeuser`.`project_id`))) where (`user`.`isMentee` = 1);

-- --------------------------------------------------------

--
-- Structure for view `report_mentor`
--
DROP TABLE IF EXISTS `report_mentor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_mentor` AS select `user`.`username` AS `MentorUserName`,`user`.`email` AS `MentorEmail`,`user`.`fname` AS `MentorFirstName`,`user`.`lname` AS `MentorLastName`,`user`.`mname` AS `MentorMiddleName`,`user`.`disable` AS `MentorDisabled`,`mentorinfo`.`employer` AS `MentorEmployeuser_info`,`mentorinfo`.`position` AS `MentorPosition`,`mentorinfo`.`degree` AS `MentorDegree`,`mentorinfo`.`field_of_study` AS `MentorFieldOfStudy`,`mentorinfo`.`grad_year` AS `MentorGradYear` from (`user` left join `user_info` `mentorinfo` on((`user`.`id` = `mentorinfo`.`user_id`))) where ((`user`.`isPerMentor` = 1) or (`user`.`isProMentor` = 1) or (`user`.`isDomMentor` = 1));

-- --------------------------------------------------------

--
-- Structure for view `report_ticket`
--
DROP TABLE IF EXISTS `report_ticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_ticket` AS select `ticket`.`id` AS `ticketID`,`ticket`.`creator_user_id` AS `creatorID`,`ticketowner`.`fname` AS `creatorFirstName`,`ticketowner`.`mname` AS `creatorMiddleName`,`ticketowner`.`lname` AS `creatorLastName`,`ticketowner`.`disable` AS `creatorDisabled`,`ticketowner`.`email` AS `creatorEmail`,`ticket`.`status` AS `ticketStatus`,`ticket`.`created_date` AS `ticketCratedDate`,`ticket`.`subject` AS `ticketSubject`,`ticket`.`description` AS `ticketDescription`,`ticket`.`assign_user_id` AS `ticketAssignUserID`,`userassigned`.`fname` AS `assignedUserFirstName`,`userassigned`.`lname` AS `assignedUserLastName`,`userassigned`.`mname` AS `assignedUserMiddleName`,`userassigned`.`disable` AS `assignedUserDisabled`,`userassigned`.`email` AS `assignedUserEmail`,`ticket`.`domain_id` AS `ticketDomainID`,`ticketdomain`.`name` AS `ticketDomainName`,`ticket`.`subdomain_id` AS `ticketSubDomticketainID`,`ticketsubdomain`.`name` AS `ticketSubDomainName`,`ticket`.`priority_id` AS `ticketPriority`,`ticketpriority`.`description` AS `ticketPriorityDescription`,`ticket`.`assigned_date` AS `ticketAssignedDate`,`ticket`.`closed_date` AS `ticketClosedDate`,`ticket`.`isEscalated` AS `ticketIsEscalated` from (((((`ticket` join `user` `ticketowner` on((`ticketowner`.`id` = `ticket`.`creator_user_id`))) join `domain` `ticketdomain` on((`ticketdomain`.`id` = `ticket`.`domain_id`))) join `priority` `ticketpriority` on((`ticketpriority`.`id` = `ticket`.`priority_id`))) left join `user` `userassigned` on((`userassigned`.`id` = `ticket`.`assign_user_id`))) left join `subdomain` `ticketsubdomain` on((`ticketsubdomain`.`id` = `ticket`.`subdomain_id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
