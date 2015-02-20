-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2015 at 08:24 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `coplat`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `report_mentee`
--
DROP VIEW IF EXISTS `report_mentee`;
CREATE TABLE IF NOT EXISTS `report_mentee` (
`UserID` int(11) unsigned
,`UserName` varchar(45)
,`Email` varchar(255)
,`Name` varchar(192)
,`Disabled` tinyint(1)
,`UniversityID` int(11) unsigned
,`UniversityName` varchar(50)
,`PersonalMentorID` int(11) unsigned
,`PersonalMentorEmail` varchar(255)
,`PersonalMentorName` varchar(192)
,`PersonalMentorDisabled` tinyint(1)
,`menteeProjectID` int(11) unsigned
,`menteeProjectTitle` varchar(45)
,`menteeProjectStartDate` date
,`menteeProjectDueDate` date
,`menteeProjectCustomerName` varchar(41)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `report_mentor`
--
DROP VIEW IF EXISTS `report_mentor`;
CREATE TABLE IF NOT EXISTS `report_mentor` (
`userID` int(11) unsigned
,`userName` varchar(45)
,`email` varchar(255)
,`name` varchar(192)
,`disabled` tinyint(1)
,`isProjectMentor` tinyint(1)
,`isPersonalMentor` tinyint(1)
,`isDomainMentor` tinyint(1)
,`isJudge` tinyint(1)
,`isNew` tinyint(4)
,`isEmployer` tinyint(1)
,`employer` varchar(50)
,`position` varchar(50)
,`degree` varchar(50)
,`fieldOfStudy` varchar(50)
,`gradYear` int(4) unsigned
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `report_ticket`
--
DROP VIEW IF EXISTS `report_ticket`;
CREATE TABLE IF NOT EXISTS `report_ticket` (
`ticketID` int(11) unsigned
,`creatorID` int(11) unsigned
,`creatorName` varchar(192)
,`creatorDisabled` tinyint(1)
,`creatorEmail` varchar(255)
,`ticketStatus` varchar(45)
,`ticketCreatedDate` datetime
,`ticketSubject` varchar(45)
,`ticketDescription` varchar(500)
,`ticketAssignUserID` int(11) unsigned
,`assignedUserName` varchar(192)
,`assignedUserDisabled` tinyint(1)
,`assignedUserEmail` varchar(255)
,`ticketDomainID` int(11) unsigned
,`ticketDomainName` varchar(45)
,`ticketSubDomainID` int(11) unsigned
,`ticketSubDomainName` varchar(45)
,`ticketPriorityID` int(11)
,`ticketPriorityDescription` varchar(45)
,`ticketAssignedDate` datetime
,`ticketClosedDate` datetime
,`ticketIsEscalated` int(4)
);
-- --------------------------------------------------------

--
-- Structure for view `report_mentee`
--
DROP TABLE IF EXISTS `report_mentee`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_mentee` AS select `user`.`id` AS `UserID`,`user`.`username` AS `UserName`,`user`.`email` AS `Email`,concat_ws(' ',`user`.`fname`,`user`.`mname`,`user`.`lname`) AS `Name`,`user`.`disable` AS `Disabled`,`user`.`university_id` AS `UniversityID`,`menteeuniversity`.`name` AS `UniversityName`,`personalmentoruser`.`id` AS `PersonalMentorID`,`personalmentoruser`.`email` AS `PersonalMentorEmail`,concat_ws(' ',`personalmentoruser`.`fname`,`personalmentoruser`.`mname`,`personalmentoruser`.`lname`) AS `PersonalMentorName`,`personalmentoruser`.`disable` AS `PersonalMentorDisabled`,`menteeuser`.`project_id` AS `menteeProjectID`,`menteeproject`.`title` AS `menteeProjectTitle`,`menteeproject`.`start_date` AS `menteeProjectStartDate`,`menteeproject`.`due_date` AS `menteeProjectDueDate`,concat_ws(' ',`menteeproject`.`customer_fname`,`menteeproject`.`customer_lname`) AS `menteeProjectCustomerName` from (((((`user` left join `mentee` `menteeuser` on((`user`.`id` = `menteeuser`.`user_id`))) left join `university` `menteeuniversity` on((`menteeuniversity`.`id` = `user`.`university_id`))) left join `personal_mentor` `personalmentor` on((`personalmentor`.`user_id` = `menteeuser`.`personal_mentor_user_id`))) left join `user` `personalmentoruser` on((`personalmentoruser`.`id` = `personalmentor`.`user_id`))) left join `project` `menteeproject` on((`menteeproject`.`id` = `menteeuser`.`project_id`))) where (`user`.`isMentee` = 1);

-- --------------------------------------------------------

--
-- Structure for view `report_mentor`
--
DROP TABLE IF EXISTS `report_mentor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_mentor` AS select `user`.`id` AS `userID`,`user`.`username` AS `userName`,`user`.`email` AS `email`,concat_ws(' ',`user`.`fname`,`user`.`mname`,`user`.`lname`) AS `name`,`user`.`disable` AS `disabled`,`user`.`isProMentor` AS `isProjectMentor`,`user`.`isPerMentor` AS `isPersonalMentor`,`user`.`isDomMentor` AS `isDomainMentor`,`user`.`isJudge` AS `isJudge`,`user`.`isNew` AS `isNew`,`user`.`isEmployer` AS `isEmployer`,`mentorinfo`.`employer` AS `employer`,`mentorinfo`.`position` AS `position`,`mentorinfo`.`degree` AS `degree`,`mentorinfo`.`field_of_study` AS `fieldOfStudy`,`mentorinfo`.`grad_year` AS `gradYear` from (`user` left join `user_info` `mentorinfo` on((`user`.`id` = `mentorinfo`.`user_id`))) where ((`user`.`isPerMentor` = 1) or (`user`.`isProMentor` = 1) or (`user`.`isDomMentor` = 1));

-- --------------------------------------------------------

--
-- Structure for view `report_ticket`
--
DROP TABLE IF EXISTS `report_ticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_ticket` AS select `ticket`.`id` AS `ticketID`,`ticket`.`creator_user_id` AS `creatorID`,concat_ws(' ',`ticketowner`.`fname`,`ticketowner`.`mname`,`ticketowner`.`lname`) AS `creatorName`,`ticketowner`.`disable` AS `creatorDisabled`,`ticketowner`.`email` AS `creatorEmail`,`ticket`.`status` AS `ticketStatus`,`ticket`.`created_date` AS `ticketCreatedDate`,`ticket`.`subject` AS `ticketSubject`,`ticket`.`description` AS `ticketDescription`,`ticket`.`assign_user_id` AS `ticketAssignUserID`,concat_ws(' ',`userassigned`.`fname`,`userassigned`.`mname`,`userassigned`.`lname`) AS `assignedUserName`,`userassigned`.`disable` AS `assignedUserDisabled`,`userassigned`.`email` AS `assignedUserEmail`,`ticket`.`domain_id` AS `ticketDomainID`,`ticketdomain`.`name` AS `ticketDomainName`,`ticket`.`subdomain_id` AS `ticketSubDomainID`,`ticketsubdomain`.`name` AS `ticketSubDomainName`,`ticket`.`priority_id` AS `ticketPriorityID`,`ticketpriority`.`description` AS `ticketPriorityDescription`,`ticket`.`assigned_date` AS `ticketAssignedDate`,`ticket`.`closed_date` AS `ticketClosedDate`,ifnull(`ticket`.`isEscalated`,0) AS `ticketIsEscalated` from (((((`ticket` join `user` `ticketowner` on((`ticketowner`.`id` = `ticket`.`creator_user_id`))) join `domain` `ticketdomain` on((`ticketdomain`.`id` = `ticket`.`domain_id`))) join `priority` `ticketpriority` on((`ticketpriority`.`id` = `ticket`.`priority_id`))) left join `user` `userassigned` on((`userassigned`.`id` = `ticket`.`assign_user_id`))) left join `subdomain` `ticketsubdomain` on((`ticketsubdomain`.`id` = `ticket`.`subdomain_id`)));
