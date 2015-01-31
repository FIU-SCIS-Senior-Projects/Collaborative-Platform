-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2014 at 05:09 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`user_id`) VALUES
(5),
(16);

-- --------------------------------------------------------

--
-- Table structure for table `application_closed`
--

CREATE TABLE IF NOT EXISTS `application_closed` (
  `app_domain_mentor_id` int(11) unsigned DEFAULT NULL,
  `app_personal_mentor_id` int(11) unsigned DEFAULT NULL,
  `app_project_mentor_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
`id` int(11) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `application_domain_mentor`
--

CREATE TABLE IF NOT EXISTS `application_domain_mentor` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status` enum('Admin','Mentor','Closed') DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `max_amount` int(11) NOT NULL,
  `max_hours` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Application for Domain Mentor' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `application_domain_mentor`
--

INSERT INTO `application_domain_mentor` (`id`, `user_id`, `status`, `date_created`, `max_amount`, `max_hours`) VALUES
(1, 1012, 'Admin', '2014-11-05 17:25:21', 10, 2),
(2, 17, 'Admin', '2014-11-05 21:10:37', 6, 3),
(3, 999, 'Admin', '2014-11-08 19:45:26', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `application_domain_mentor_pick`
--

CREATE TABLE IF NOT EXISTS `application_domain_mentor_pick` (
`id` int(11) unsigned NOT NULL,
  `app_id` int(11) unsigned NOT NULL,
  `domain_id` int(11) unsigned NOT NULL,
  `proficiency` int(2) unsigned NOT NULL,
  `approval_status` enum('Proposed by Admin','Proposed by Mentor','Approved','Rejected') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='domain mentor picks for domain table' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `application_domain_mentor_pick`
--

INSERT INTO `application_domain_mentor_pick` (`id`, `app_id`, `domain_id`, `proficiency`, `approval_status`) VALUES
(1, 1, 8, 5, 'Rejected'),
(2, 1, 9, 4, 'Rejected'),
(3, 1, 10, 7, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `application_personal_mentor`
--

CREATE TABLE IF NOT EXISTS `application_personal_mentor` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status` enum('Admin','Mentor','Closed') NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `max_amount` int(2) unsigned NOT NULL,
  `max_hours` int(2) unsigned NOT NULL,
  `system_pick_amount` int(1) unsigned DEFAULT NULL,
  `university_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='application for personal mentor' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `application_personal_mentor`
--

INSERT INTO `application_personal_mentor` (`id`, `user_id`, `status`, `date_created`, `max_amount`, `max_hours`, `system_pick_amount`, `university_id`) VALUES
(1, 1012, 'Admin', '2014-11-05 17:28:46', 4, 4, NULL, NULL),
(3, 1013, 'Admin', '2014-12-09 18:04:24', 0, 0, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_personal_mentor_pick`
--

CREATE TABLE IF NOT EXISTS `application_personal_mentor_pick` (
`id` int(11) unsigned NOT NULL,
  `app_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `approval_status` enum('Proposed by Admin','Proposed by Mentor','Approved','Rejected','Proposed by System') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='picks for the personal mentor from the user table' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `application_personal_mentor_pick`
--

INSERT INTO `application_personal_mentor_pick` (`id`, `app_id`, `user_id`, `approval_status`) VALUES
(1, 1, 1005, 'Approved'),
(2, 1, 1006, 'Rejected'),
(3, 1, 1004, 'Rejected'),
(6, 3, 10, 'Proposed by Mentor'),
(7, 3, 8, 'Proposed by Mentor'),
(8, 3, 9, 'Proposed by System'),
(9, 3, 11, 'Proposed by System');

-- --------------------------------------------------------

--
-- Table structure for table `application_project_mentor`
--

CREATE TABLE IF NOT EXISTS `application_project_mentor` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status` enum('Admin','Mentor','Closed') NOT NULL,
  `date_created` datetime NOT NULL,
  `max_amount` int(2) unsigned NOT NULL,
  `max_hours` int(2) unsigned NOT NULL,
  `system_pick_amount` int(1) unsigned DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='application for a project mentor' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `application_project_mentor`
--

INSERT INTO `application_project_mentor` (`id`, `user_id`, `status`, `date_created`, `max_amount`, `max_hours`, `system_pick_amount`) VALUES
(1, 1012, 'Admin', '2014-11-05 17:31:29', 5, 5, NULL),
(2, 999, 'Admin', '2014-11-05 21:33:48', 5, 5, NULL),
(3, 17, 'Admin', '2014-11-08 19:46:03', 4, 4, NULL),
(12, 1016, 'Admin', '2014-12-09 19:59:12', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `application_project_mentor_pick`
--

CREATE TABLE IF NOT EXISTS `application_project_mentor_pick` (
`id` int(11) unsigned NOT NULL,
  `app_id` int(11) unsigned NOT NULL,
  `project_id` int(11) unsigned NOT NULL,
  `approval_status` enum('Proposed byMentor','Proposed by Admin','Approved','Rejected','Proposed by System') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `application_project_mentor_pick`
--

INSERT INTO `application_project_mentor_pick` (`id`, `app_id`, `project_id`, `approval_status`) VALUES
(5, 12, 82, 'Proposed by System');

-- --------------------------------------------------------

--
-- Table structure for table `application_recommended_domain`
--

CREATE TABLE IF NOT EXISTS `application_recommended_domain` (
`id` int(3) unsigned NOT NULL,
  `appId` int(3) unsigned NOT NULL,
  `domain` varchar(20) NOT NULL,
  `subdomain` varchar(20) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `proficiency` int(2) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `application_recommended_domain`
--

INSERT INTO `application_recommended_domain` (`id`, `appId`, `domain`, `subdomain`, `description`, `proficiency`) VALUES
(1, 1, 'Test', 'subtest', 'thi sis a subtest', 6),
(2, 1, 'Test', NULL, 'thi sis a test', 4);

-- --------------------------------------------------------

--
-- Table structure for table `application_subdomain_mentor_pick`
--

CREATE TABLE IF NOT EXISTS `application_subdomain_mentor_pick` (
`id` int(11) unsigned NOT NULL,
  `app_id` int(11) unsigned NOT NULL,
  `subdomain_id` int(11) unsigned NOT NULL,
  `proficiency` int(2) NOT NULL,
  `approval_status` enum('Proposed by Admin','Proposed by Mentor','Approved','Rejected') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='domain mentor picks for subdomain table' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `application_subdomain_mentor_pick`
--

INSERT INTO `application_subdomain_mentor_pick` (`id`, `app_id`, `subdomain_id`, `proficiency`, `approval_status`) VALUES
(1, 1, 1, 5, 'Approved'),
(2, 1, 2, 2, 'Approved'),
(3, 1, 3, 3, 'Rejected'),
(4, 1, 5, 7, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`id` int(11) unsigned NOT NULL,
  `description` varchar(500) NOT NULL,
  `added_date` datetime NOT NULL,
  `ticket_id` int(11) unsigned NOT NULL,
  `user_added` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='				' AUTO_INCREMENT=182 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `description`, `added_date`, `ticket_id`, `user_added`) VALUES
(174, 'Run time Error - The errors encountered during execution of the program, due to unexpected input or output are called run-time error.', '2014-07-17 11:00:14', 43, 'Pedro Escandell'),
(177, 'You should read Chapter 12 of your textbook.', '2014-07-18 13:47:01', 42, 'Jiali Lei'),
(179, ' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell', '2014-07-24 11:08:51', 41, 'System'),
(180, ' This ticket was automatically reassigned by the system from mentor Pedro Escandell to mentor Jiali Lei', '2014-07-24 11:08:52', 42, 'System'),
(181, 'Shits closed', '2014-09-07 14:34:24', 43, 'Masoud Sadjadi');

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `validator` int(11) DEFAULT '5' COMMENT 'Integer that validates the domain Tier Level.',
  `need` varchar(7) NOT NULL DEFAULT 'Medium' COMMENT 'Need',
  `need_amount` int(3) NOT NULL DEFAULT '5' COMMENT 'members needed'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `name`, `description`, `validator`, `need`, `need_amount`) VALUES
(8, 'Programming Lanaguage', 'All programming languages', 5, 'Medium', 5),
(9, 'Biology', 'Is a natural science concerned with the study of life and living organisms, including their structure, function, growth, evolution, distribution, and taxonomy.[1] Modern biology is a vast and eclectic field, composed of many branches and subdisciplines. ', 5, 'Medium', 5),
(10, 'Software Engineering', 'General questions about the software engineering cycle.', 5, 'Medium', 5);

-- --------------------------------------------------------

--
-- Table structure for table `domain_mentor`
--

CREATE TABLE IF NOT EXISTS `domain_mentor` (
  `user_id` int(11) unsigned NOT NULL,
  `max_tickets` int(11) DEFAULT NULL,
  `Tier` int(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `domain_mentor`
--

INSERT INTO `domain_mentor` (`user_id`, `max_tickets`, `Tier`) VALUES
(6, 20, 1),
(7, 20, 1),
(8, 20, 1),
(17, 10, 1),
(19, 20, 1),
(999, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE IF NOT EXISTS `invitation` (
`id` int(11) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  `administrator_user_id` int(11) unsigned NOT NULL,
  `date` datetime DEFAULT NULL,
  `administrator` tinyint(1) DEFAULT NULL,
  `mentor` tinyint(1) DEFAULT NULL,
  `mentee` tinyint(1) DEFAULT NULL,
  `employer` tinyint(1) DEFAULT NULL,
  `judge` tinyint(1) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `message` varchar(750) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`id`, `email`, `administrator_user_id`, `date`, `administrator`, `mentor`, `mentee`, `employer`, `judge`, `name`, `message`) VALUES
(1, 'test123@test.com', 5, '2014-11-14 07:41:04', 0, 0, 0, 0, 0, 'Test 123', '');

-- --------------------------------------------------------

--
-- Table structure for table `invitation_resends`
--

CREATE TABLE IF NOT EXISTS `invitation_resends` (
`id` int(11) unsigned NOT NULL,
  `invitation_id` int(11) unsigned NOT NULL,
  `send_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `mentee`
--

CREATE TABLE IF NOT EXISTS `mentee` (
  `user_id` int(11) unsigned NOT NULL,
  `personal_mentor_user_id` int(11) unsigned DEFAULT NULL,
  `project_id` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mentee`
--

INSERT INTO `mentee` (`user_id`, `personal_mentor_user_id`, `project_id`) VALUES
(10, 17, 2),
(21, 17, 2),
(1002, 999, 112),
(1003, 999, 133),
(1004, 999, 115),
(1005, 999, 108),
(1006, 999, 134);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`id` int(11) unsigned NOT NULL COMMENT 'Message ID',
  `receiver` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'Receiver username',
  `sender` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'Sender username',
  `message` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Message Body',
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Message Subject',
  `created_date` datetime NOT NULL COMMENT 'Message Creation Date',
  `been_read` tinyint(1) DEFAULT '0' COMMENT '0: NO 1: YES',
  `been_deleted` tinyint(1) DEFAULT '0' COMMENT '0: NO 1: YES',
  `userImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
`id` int(11) unsigned NOT NULL,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `datetime` time NOT NULL,
  `been_read` tinyint(1) NOT NULL DEFAULT '0',
  `message` varchar(5000) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `importancy` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `sender_id`, `receiver_id`, `datetime`, `been_read`, `message`, `link`, `importancy`) VALUES
(1, 0, 6, '15:27:55', 0, 'You got a new message from admin', 'http://localhost/coplat/index.php/message', 3),
(2, 0, 6, '15:28:55', 0, 'You got a new message from admin', 'http://localhost/coplat/index.php/message', 3),
(3, 0, 6, '01:01:46', 0, 'You got a new message from hmuni006', 'http://localhost/coplat/index.php/message', 3),
(4, 0, 6, '01:20:10', 0, 'You got a new message from hmuni006', 'http://localhost/coplat/index.php/message', 3),
(5, 0, 7, '01:21:15', 0, 'You got a new message from lsanc104', 'http://localhost/coplat/index.php/message', 3),
(6, 0, 6, '01:21:43', 0, 'You got a new message from hmuni006', 'http://localhost/coplat/index.php/message', 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_meeting`
--

CREATE TABLE IF NOT EXISTS `personal_meeting` (
`id` int(11) NOT NULL,
  `mentee_user_id` int(11) unsigned NOT NULL,
  `personal_mentor_user_id` int(11) unsigned NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `personal_meeting`
--

INSERT INTO `personal_meeting` (`id`, `mentee_user_id`, `personal_mentor_user_id`, `date`, `time`) VALUES
(1, 21, 17, '2014-11-01', '08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_mentor`
--

CREATE TABLE IF NOT EXISTS `personal_mentor` (
  `user_id` int(11) unsigned NOT NULL,
  `max_hours` varchar(45) DEFAULT NULL,
  `max_mentees` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personal_mentor`
--

INSERT INTO `personal_mentor` (`user_id`, `max_hours`, `max_mentees`) VALUES
(6, '12', '1'),
(7, '2', '3'),
(17, '10', '2'),
(18, '', ''),
(999, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_mentor_mentees`
--

CREATE TABLE IF NOT EXISTS `personal_mentor_mentees` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `personal_mentor_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='this table  matches mentees to their personal mentors' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `personal_mentor_mentees`
--

INSERT INTO `personal_mentor_mentees` (`id`, `user_id`, `personal_mentor_id`) VALUES
(1, 1005, 1012);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE IF NOT EXISTS `priority` (
`id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `reassignHours` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `description`, `reassignHours`) VALUES
(1, 'High', 6),
(2, 'Medium', 12),
(3, 'Low', 72);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `propose_by_user_id` int(11) unsigned NOT NULL COMMENT 'Propose By',
  `project_mentor_user_id` int(11) unsigned DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `customer_fname` varchar(20) NOT NULL,
  `customer_lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `title`, `description`, `propose_by_user_id`, `project_mentor_user_id`, `start_date`, `due_date`, `customer_fname`, `customer_lname`) VALUES
(1, 'Collaborative Platform', 'Collaborative software or groupware is an application software designed to help people involved in a common task achieve goals. One of the earliest definitions of collaborative software is ''intentional group processes plus software to support them.\n', 5, 1012, '2014-01-06', '2014-04-25', '', ''),
(2, 'Senior Project Website', 'This project builds on its previous version and addresses its issues and shortcomings. Here is all the resources from the second revision: \n\n', 5, 6, '2014-01-06', '2014-04-25', '', ''),
(3, 'project testing', 'project testing', 5, 6, NULL, NULL, '', ''),
(82, 'Mobile Judge: Version 4', 'This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SU14/03-MobileJudgeV3.zip\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/4-MobileJudgeV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/7-MobileJudge/\n', 999, 999, NULL, NULL, 'Masoud', 'Sadjadi'),
(83, 'Senior Project Web Site: Version 5', 'This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\n... Ask your mentor to provide the link.\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/6-SeniorProjectWebSiteV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/4-SeniorProjectWebSite/\n', 999, 999, NULL, NULL, 'Masoud', 'Sadjadi'),
(84, 'Virtual Job Fair: Version 4', 'This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SU14/04-VirtualJobFairV3.zip\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/7-VirtualJobFairV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/3-VirtualJobFair/\n', 999, 999, NULL, NULL, 'Juan', 'Caraballo'),
(108, 'Collaborative Platform v2', 'This project', 999, 1000, NULL, NULL, 'Juan', 'Caraballo'),
(110, 'History App', 'This app is a virtual history tour/walk through town.  Files (audio, documents and photos) are linked to a GPS coordinate, so that the user can listen to or read files pertaining to a specific location.  Eventually, it will provide a searchable database of location based historical resources.  \n1.   a front page, and then ability to use location services to pull up local stories, a map to pick a location and find stories, or a search box to find a specific location.  FIU has a project called Terrafly, which is (from my understanding) google maps with the ability to overlay historical maps, this sort of thing would be ideal. I want the user to be able to "program" a series of stories so they can make a "virtual walking/driving tour".  \n\n2.  Admin needs to be able to upload files of varying sizes and types.  I would like to have categories at some point, some that users can add to on their own, allowing the users to add to the historical database.  This could include their own audio files (from snippets to oral', 999, 999, NULL, NULL, 'Tracy', 'Beeson'),
(111, 'Mission-critical Cloud Computing', 'This project will study how to deliver mission assurance to mission-critical applications in cloud computing systems. Students will develop a virtual machine based approach to run applications with good security and reliability in typical cloud computing systems.\n\nThis project build upon the previous senior project''s results: 1) A VM management system that dynamically migrate VMs across hosts on a\nOpenStack-based cloud platform; 2) A P2P overlay network that interconnect the OpenStack VMs based on the IP-over-P2P (IPOP) framework.\n\nThis new senior project will focus on developing an extension to IPOP that allow the communications among the VMs to be routed by the overlay network in a OpenStack-based cloud system.\n\nStudents will learn state-of-the-art virtualization, cloud, and P2P technologies in this project, and get mentoring from researchers at FIU, UF, and Air Force. Students will also be exposed to career opportunities at the Department of Defense.\n\nStudents are required to have basic understanding of VM', 999, 999, NULL, NULL, 'Ming', 'Zhao'),
(112, 'Test Case and Automation Management System', 'At Ultimate Software, the quality of our product is one of our highest priorities, and thus we invest heavily towards a strong testing foundation. Some of the biggest challenges in software testing are that of test case management and the proper linking of test automation to test cases. There are many different goals a software organization evaluates when deciding on a test case management solution. The proper solution must provide a centralized repository for all test cases leveraging Team Foundation Server, must allow us to store test cases in a hierarchical structure for clear organization, and must allow us to establish relationships between test cases, requirements, defects, and test automation. Furthermore, in order to reduce variance in test documentation patterns and standards, the ideal solution should enforce a documentation standard. The project team will be exposed to modern Web application development technologies such as ASP.NET MVC 5 and Web API, Team Foundation Server, SQL Server, AngularJS, J', 999, 999, NULL, NULL, 'Tariq', 'King'),
(113, 'Web Dashboard for Addigy IT Management Softwa', 'With all the data that Addigy captures about each Mac computer, users want to see ever-growing dashboard data representation.  Building informative and intuitive dashboards for users to keep a pulse on their company is extremely important in any software products today.  Dashboards are currently displayed using Bootstrap and Bootswatch template objects.  While you will have access to many templates and existing dashboards, feel free to be creative in how you develop these new dashboards.  These Dashboards and reports have the potential to be highly advertised throughout the Addigy website and product-line.\n\nProject Objectives:  Create an extensible web based dashboard that displays core state of all mac machines managed by a particular customer/organization.  All core data is collected and stored in an online database and intended to show the current status of all systems.\n- Pie chart of type of assets: macbook, mac mini, mac server, etc\n- Pie chart of OS version: 10.8, 10.9, 10.10\n- Graphic of machines with ', 999, 999, NULL, NULL, 'Jason', 'Dettbarn'),
(114, 'Big Data Mining and Correlation for Addigy IT', 'Big Data is often misused in the industry, and while Addigy collects tremendous system data that can also be easily extended with new auditing facts, we are not processing petabytes of data.  Like most companies, modeling and correlating data starts with more modest infrastructure (no hadoop required).  Addigy leverages Logstash to ElasticSearch to quickly model data with Kibana.  You will be able to correlate and build business intelligence at a very fast pace, and develop an extremely useful skill set valuable to any company.  Novel unique data correlation has the potential to be highly advertised throughout the Addigy website and product-line.\n\nProject Objectives:  The key objective is harvesting various system log files, to correlate very interesting sets of data for alerting & reporting.  The first objective is being able to report on historic Addigy Policy Updates applied to the machine.  Logs currently show elements of the machine that are out specification, and what changes were made on the machines. ', 999, 999, NULL, NULL, 'Jason', 'Dettbarn'),
(115, 'Pinecrest People Mover Web and Mobile Tracker', 'The Pinecrest People Mover is a free transit bus service operated by the Village of Pinecrest connecting our neighborhoods and schools.  It is mostly used by middle and high school students who do not qualify for bus service from the school district.  We would like to design a Web tracker and a Mobile tracker to show residents routes, hours of operation, real-time trolley location (as a list and as an interactive map) and allow for automatic notifications for arrival at user’s favorite stops. The mobile tracker should work well on iPhone & android devices.', 999, 999, NULL, NULL, 'Gabriela', 'Wilson'),
(116, 'Mobile and Web Platforms for Visualizing Wate', 'Data centers also not only energy hogs, but are also very "thirsty". A large data center may consume millions of gallons of cooling water each day; in addition, data centers also indirectly consume an enormous amount of water embedded in offsite electricity generation. As a result, water conservation is surfacing as a critical concern for data centers, amid the anticipation of surging water demand worldwide. Left unchecked, the growing water footprint of data centers can pose a severe threat to data center sustainability and may even handicap availability of services, especially for data centers in water-stressed areas. Existing mechanical solutions for conservation, such as using recycled/industry water and directly using outside cold air, are often costly and/or very limited by external factors such as locations, climate conditions, among others. As part of the integral efforts from both industry and academy to enable data center sustainability, this project uniquely integrates water footprint as an essenti', 999, 999, NULL, NULL, 'Shaolei', 'Ren'),
(117, 'Power Management in Multi-Tenant Data Centers', 'Power-hungry data centers have been massively expanding in both number and scale, placing an increasing emphasis on optimizing data center power management. While the progress in data center energy efficiency is encouraging, the existing efforts have dominantly centered around owner-operated data centers (e.g., Microsoft). Another unique and integral segment of data center industry --- multi-tenant colocation data center, simply called “colocation”, which is the physical home to many Internet and cloud services --- has not been well investigated, which, if still left unchecked, would become a major hurdle for sustainable growth of the digital economy. In sharp contrast with owner-operated data centers where operators have full control over both computing resources and  facilities, colocation rents physical space to multiple tenants which individually control their own physical servers and power management, while the colocation operator is mainly responsible for facility support (e.g., providing reliable power', 999, 999, NULL, NULL, 'Shaolei', 'Ren'),
(118, 'Virtual Colonoscopy System', 'Virtual colonoscopy system visualizes the digital colon surfaces and helps doctor check the interior structure and screen the cancerous polyp/abnormality. The main goal includes: 1) build the user-friendly interface using MFC or other GUI; 2) visualize exterior and interior surfaces of colon by 3D rendering (Computer Graphics) technique; 3) navigate the interior tunnel of the convoluted and folded colon along the central line; and 4) if time permits, build the interface for colon flattening and registration.  Colon data are provided. \n\nThis is an ongoing project; three undergraduates (2 senior, 1 junior) have been working on that from this summer. We hope to continue that as their senior project (for the 2 senior students). Other students who are interested can join the team. The output system would offer a great demo for visitors/students to understand the power of graphics/geometry in solving real problems in medical imaging.  \n\nProject Team Member: \nMaylem Gonzalez (senior), mgonz108@fiu.edu\nFrancisco Marc', 999, 999, NULL, NULL, 'Wei', 'Zeng'),
(119, 'Geometric Search Engine', '3D geometric data are ubiquitous today. Efficient processing and organizing these massive data is required. The main goal of this project includes: 1) build the geometric database; 2) build the management system; 3) view the 3D objects on webpage using 3D Computer Graphics and WebGL techniques. Server and 3D databases (e.g., human facial expressions, brains) are provided.\n\nProject Team Member: \nCarlos Morales (junior, will be involved), cmora062@fiu.edu', 999, 999, NULL, NULL, 'Wei', 'Zeng'),
(120, 'OWASP Encoders in C', 'The OWASP Java Encoder Project helps people make safer web-based\napplications. It is only fully supported in Java. This project is to\nport the code to a C library so that it can be included in frameworks\nlike mod_perl, PHP, or ESI. A stellar project would not only create\nthe library, but also submit a patch to include it in one or more of\nthose frameworks.\n\nSee Also:\nhttps://www.owasp.org/index.php/OWASP_Java_Encoder_Project\nhttp://www.esi.org\nhttp://docs.oracle.com/cd/E17904_01/web.1111/e10143/esi.htm\n\n\nThis project could be completed by one to three students, depending on\nhow much they aim to achieve.\nI don''t have a good grasp of what would be too much to ask of one of\nthese projects. The "short" version is just porting the library then\ncalling it using JNI. A more advanced project would be built as\nfollows:\n\nOne person could port the library from Java to C while the two others\nbuild foreign-function interface wrappers for python and php.\nThen the three could work to build simple web-apps in python and PHP\n', 999, 999, NULL, NULL, 'Eric', 'Kobrin'),
(121, 'Assigning Content for Translation', 'We are a local translations company based in Coral Gables that is looking to give our clients a more convenient way of assigning content to us for translation. Currently, many of our clients manually export content from their CMS, usually in an XML format, and email it to us. We want to automate this process by exploring the possibility of developing a plugin to work with their CMS whereby they can assign files directly to us from within the application.\n\nWe are seeking a possible collaboration with your institution in developing this plugin. Our thinking is that this would be a great opportunity for a class project or beneficial to a student needing a real-life project to complete their thesis, etc. We would, on the other hand, benefit by getting our plugin developed.\n\n', 999, 999, NULL, NULL, 'Jaime', 'Zuniga'),
(122, 'Open Source Intelligence Inference Engine', 'The students will build a web application providing a repository for\nstoring and searching OSINT data as well as internal cyberattack data\nusing semantic web techniques. The backing store should be one of the\nexisting semantic web triple- or quad-stores such as Mulgara or Jena\nand should be queryable directly using Sparql or Datalog. The\nstructure and interface should provide for storing\nintelligence-critical metadata such as assertion provenance and\nconfidence of assertions.\n\nSee Also:\nhttp://en.wikipedia.org/wiki/Open-source_intelligence\nhttp://www.mulgara.org/\nhttp://en.wikipedia.org/wiki/Jena_(framework)\nhttp://en.wikipedia.org/wiki/SPARQL\nhttp://en.wikipedia.org/wiki/Datalog\nhttp://en.wikipedia.org/wiki/Resource_Description_Framework', 999, 999, NULL, NULL, 'Eric', 'Kobrin'),
(123, 'Redesign of Intimo''s Merchant Website on New ', 'We currently have our Merchant web site with Yahoo Merchant Services. The platform we currently use is outdated and Yahoo has released a new platform. We would like to merge to the new platform and redesign our website.\n\nskills such as Dust; Nodes; Pearl.\n\nAgain, this is a new platform for Yahoo stores and eventually all customer will switch to it and Yahoo is allowing us to transfer our page to “partner up” with me on this project with your students. My Yahoo rep Maria Melo is very excited to learn more about the opportunities she can give to the students and definitely be a partner on this project.\n \nI will need a programmer, a designer and a data management “expert”\n \nProgrammer must be proficient in Dust.js; Nodes.js; SQL.\n \nDesigner must be proficient on UI to create the flow, web designer creating the layout, usability for the pages, etc\n \nData Management will need to set up items, set up navigation, database, etc.\n \nEssentially we have our web page www.intimo.com and we will create a brand new store on', 999, 999, NULL, NULL, 'Sonia', 'Centeno'),
(124, 'Virtual Queue', 'The application is for theme parks and other businesses that have multiple rides or events for which patrons typically wait in line.  The idea is that both the theme park and the patron would benefit by the patrons walking around the park (and maybe spending money) rather than standing in line.  This application will keep static data such as ride time, capacity, etc., as well as dynamic data regarding the patrons and queues, and allow patrons to virtually queue for a ride via a mobile app.  The patron will be notified as their time approaches.  Geo-location will also be used to insure that patrons are in the park, and tell them how to get to the ride.\n\nProject Proposer Name: ... Bernard Parenteau\n\nProject Proposer Affiliation: ... Florida Logic www.floridalogic.com\n\nProject Proposer Position: ... Managing Partner\n?\nExpanded Project Description: \nThe project consists of a mobile app, scanner, maintenance site, and a server component.   The patron would download the mobile app in advance or at time of entry.  B', 999, 999, NULL, NULL, 'Bernard', 'Parenteau'),
(125, 'Aggregate and create a charity Information “B', 'Aggregate and create a charity Information “Big Data” mart & create a transparency scoring algorithm. Use the power of technology to showcase and highlight honest and transparent charities.\n\nSeek out and identify multiple sources of charity information that is accessible and retrievable utilizing APIs or web-based content retrieval\nWrite processes to retrieve identified data at periodic intervals\nCreate a centralized system of record for storing and marking up data \nWrite algorithm(s) to process data; create scoring mechanisms and analytical models based on data\nPublish results and other metadata through a privately accessible API\n', 999, 999, NULL, NULL, 'Andy', 'Hill'),
(126, 'Displaying social photos to a social wall/fee', 'Pull photos from a Facebook album, RSS feed and or Twitter hashtag and display them in a grid on a webpage.   This is a ‘social wall’ that can be projected onto a wall, shown on a monitor at an event, etc.  Incorporating Google Analytics and Facebook Insights and digesting that data could be another piece of the project.', 999, 999, NULL, NULL, 'Cortney', 'Mills'),
(128, 'University Catalog Management System - Versio', 'This project has already been started. The current system has the database structure \nset and the user interface created for a normal user to view existing catalog information\nand an adviser to create/modify catalog information.\n\nThe project is a web-based application written in PHP using the Yii Model-View-Controller\nframework. The database is mysql. Students selecting this project will need to know PHP\nand mysql. With these skills, they should be able to learn the Yii framework quickly.\n\nThree roles exist in this project: user, adviser and administrator. The user view is almost\ncomplete. The adviser role needs  improvements. The administrator role needs major work. \nSome of the functions of the admin may require modifications to the existing database \nstructure.\n\nAdditional features to implement include creating a web service for accessing the catalog \ninformation, generating a graphical flow chart from a list of courses, creating versions\nof a catalog in alternate formats (eg, XML) for use in other program', 999, 999, NULL, NULL, 'Tim', 'Downey'),
(129, 'Rote Practice Educational System', 'This is a new project. I have a simple example running that uses JSPs and Servlets, but\nthe students would be free to choose another web framework, as long as it is based\non MVC. The basic idea of the system is to allow for rote drills of material. The existing\nexample allows the user to unscramble the lines of code from a program file. Additional\ntasks need to be developed, such as matching terms to definitions and placing items \ninto categories.\n\nI envision three roles: user, faculty, admin. The exercises will be organized by class and\nfaculty. \n\nUser role: Run authorized examples and to import files of their own into existing types of \ntasks. Access statistics of how many tasks have been completed and how many times\neach task has been done.\n\nFaculty role: Create tasks, specifying how many times it must be completed before the\ntask is considered finished. Only students from a class will have access to the exercise,\nunless permission is granted by the faculty to other classes/students or made public. \nRetrie', 999, 999, NULL, NULL, 'Tim', 'Downey'),
(130, 'Using Shipping Data to Aid in Fraud Detection', 'Internet fraudsters often use the shipment carrier as a means to camouflage their illicit activities. For example, a fraudster may claim a package never arrived, or the package arrived in a damaged state.\n \nIt is possible using a combination of shipping data and heuristic algorithms to complement existing fraud detection methods to increase the percentage of fraudulent activities detected.\n\nThis project would use shipping data to attempt to detect potential fraudulent activities by applying heuristic algorithms to the shipping data to highlight activities that fall out of the normal range of behavior, thus providing an additional data point to the overall fraud detection process.\n\nKen Smith\nken@71lbs.com', 999, 999, NULL, NULL, 'Jose', 'Li'),
(131, 'MyExperiment: A Web-based Model Repository fo', 'The goal of the MyExperiment project is to develop a web-based solution that allows network researchers and experimenters to create, view, modify and manage network models (including network topologies, network traffic, and network configurations), which they use to conduct simulation and emulation experiments for validating design and evaluating performance. The target system will offer an  "online store" for users to create various models using existing model generators, as well as configure, inspect and visualize them. The created models can be saved in the online repository for private or public use. MyExperiment will become a common platform for network researchers to store, share and reuse models for network experimentation.\n\nStudents should have basic knowledge of computer network, and should have experience with web service design and development (such as HTML5, CSS, Javascript, PHP, JSP, ASP, MySQL/Postgres, etc.)\n', 999, 999, NULL, NULL, 'Jason', 'Liu'),
(132, 'Smart Systems for Occupancy and Building Ener', 'The objective of this project is to develop a smart system for tracking and modeling occupancy behaviors in building energy analysis. Using robust sensor networks and computational algorithms, a smart system will be developed to capture, analyze, and predict occupancy behaviors and provide real-time feedback to occupants to eliminate energy waste. In this project students will build the sensor network and develop the algorithms and will test the system using experimentations in one of the campus buildings.\n\nProject objective and scope: The objective of this project is to develop a smart system for tracking and modeling occupancy behaviors in building energy analysis. The system will include two components. The first component include a non-invasive sensor network to capture the movements of building occupants and their behaviors as well as the information related to the lighting, indoor temperature, and the plug-loads. By utilizing small modules using Infrared sensors equipped with wireless networking technol', 999, 999, NULL, NULL, 'Leonardo', 'Bobadilla'),
(133, '(IBM) Track and keep score of and compute a g', 'Announcement \n\n\nDid you know... Recycling a four-foot stack of newspapers saves the equivalent of one 40-foot fir tree? \n\n\nDid you know.... Every glass bottle recycled saves enough energy to light a 100-watt light bulb for 4 hours? \n\n\nDid you know....Americans throw away enough aluminum to rebuild the entire commercial airline fleet every three months?\n\n\nWhat if just one individual did their part and saved a tree, conserved a little electricity or helped recycle materials?\n\n\nWhat if a small group of individuals banded together and tracked their collective progress?\n\n\nWhat if one of world''s leading technology companies combined forces with a group of gifted computer science students from Florida International University to make a difference?\n\n\nThis is your chance to enable one of the world''s leading companies to build a platform that will incent and measure their sustainability efforts and behaviors. \n\n\nWe''re looking for a team of environmentally conscious computer science engineers to build a system that will', 999, 999, NULL, NULL, 'Juan', 'Caraballo'),
(134, 'Binding the Java platform with the GlusterFS ', 'This project, glusterfs-java-filesystem, is an implementation of a Java 7 NIO.2 Filesystem Provider backed by GlusterFS through a JNI binding to the C library libgfapi.  It is used as a plug-in library in Java software to allow direct connection to GlusterFS storage volumes.\n\nhttps://github.com/semiosis/glusterfs-java-filesystem\n\nJava 7 introduced the Filesystem Provider API which allows developers to add support to the Java platform for new filesystems.  This allows a loose coupling between application and filesystem code.  The application is programmed against the NIO.2 API, so it does not depend on any particular filesystem implementation.  Then a provider library can be dropped in to the JVM and the application gets access to the new type of filesystem automatically.\n\nThis is a challenging project most suitable for adept & motivated students.  I could manage up to three students.\n\nStudents should be fluent in Java and comfortable working on Linux.  Ideally students will have worked previously on a Java pr', 999, 999, NULL, NULL, 'Louis', 'Zuckerman'),
(136, 'iOS/Android Game', 'This project will consist of making a game for mobile platforms for a Software Dev company that I''m starting.  It will be a tile board game dealing with adding numbers. The game will have a 2-player mode, with the option to play with an AI. The game will also have a timed single-player mode. It will be built using the cocos2d/cocos2d-x Framework. \n\nI will be handling the iOS side of the game, and also the front-end design, as well as other features that come up. I need a developer that handles the Android side (Java) and a developer that handles the multiplayer backend logic. As mentioned, creating the AI is also part of the project. There is also work to be done to create the leaderboards and achievements. \n\nWhen the game is finished, it will published in the App Store/Google Play store. \n\nContact me if you want to learn more about the game. ', 999, 999, NULL, NULL, 'Wei', 'Zeng'),
(137, 'Liveness Detection in Video (Kairos Facial Re', 'We need the ability to make sure the face in front of the camera is a real person and not a photo or a video of a person for fraud and security reasons. We need this ability primarily for iOS cameras (iPhone, iPad, iPod Touch) and streaming video from security cameras (iOS is more important) We would love for you to use our API located at https://developer.kairos.com for our work. Try to fool it, and then figure out how to keep it safe. \n\nHere is a list of all of our capabilities, we can make any of these capabilities available to the team:\n\nhttp://www.kairos.com/technology/\n\nThere can be multiple ways to solve this problem. We look forward to many many ideas. Kairos will be providing a prize at the successful completion of this project. \n\n', 999, 999, NULL, NULL, 'Brian', 'Brackeen');

-- --------------------------------------------------------

--
-- Table structure for table `project_meeting`
--

CREATE TABLE IF NOT EXISTS `project_meeting` (
`id` int(11) unsigned NOT NULL,
  `project_mentor_user_id` int(11) unsigned NOT NULL,
  `mentee_user_id` int(11) unsigned NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project_meeting`
--

INSERT INTO `project_meeting` (`id`, `project_mentor_user_id`, `mentee_user_id`, `date`, `time`) VALUES
(1, 17, 21, '2014-11-01', '06:00:00'),
(2, 18, 10, '2014-11-03', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_mentor`
--

CREATE TABLE IF NOT EXISTS `project_mentor` (
  `user_id` int(11) unsigned NOT NULL,
  `max_hours` int(11) DEFAULT NULL,
  `max_projects` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `project_mentor`
--

INSERT INTO `project_mentor` (`user_id`, `max_hours`, `max_projects`) VALUES
(5, 7, 2),
(6, 20, 1),
(7, NULL, NULL),
(16, 24, 4),
(17, 10, 1),
(18, NULL, NULL),
(999, NULL, NULL),
(1000, 2, 1),
(1012, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_mentor_projects`
--

CREATE TABLE IF NOT EXISTS `project_mentor_projects` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `project_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Maps project mentors to projects' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project_mentor_projects`
--

INSERT INTO `project_mentor_projects` (`id`, `user_id`, `project_id`) VALUES
(2, 6, 2),
(3, 6, 3),
(1, 1012, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subdomain`
--

CREATE TABLE IF NOT EXISTS `subdomain` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `validator` int(11) DEFAULT '5' COMMENT 'Integer that validates the domain Tier Level.',
  `domain_id` int(11) unsigned NOT NULL,
  `need` varchar(7) NOT NULL DEFAULT 'Medium' COMMENT 'Need',
  `need_amount` int(3) NOT NULL DEFAULT '5' COMMENT 'members needed'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `subdomain`
--

INSERT INTO `subdomain` (`id`, `name`, `description`, `validator`, `domain_id`, `need`, `need_amount`) VALUES
(1, 'Java', 'jjajajajajaja', 7, 8, 'Medium', 5),
(2, 'C++', 'ccccc', 6, 8, 'Medium', 5),
(3, 'Mitosis', 'mmmmm', 4, 9, 'Medium', 5),
(5, 'C#', 'C# topics', 5, 8, 'Medium', 5),
(7, 'Cell division', 'cell division', 5, 9, 'Medium', 5),
(8, 'C', 'c', 6, 8, 'Medium', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
`id` int(11) unsigned NOT NULL,
  `creator_user_id` int(11) unsigned NOT NULL,
  `status` varchar(45) NOT NULL,
  `created_date` datetime NOT NULL,
  `subject` varchar(45) NOT NULL,
  `description` varchar(500) NOT NULL,
  `assign_user_id` int(11) unsigned DEFAULT NULL,
  `domain_id` int(11) unsigned NOT NULL,
  `subdomain_id` int(11) unsigned DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `priority_id` int(11) NOT NULL,
  `assigned_date` datetime DEFAULT NULL,
  `closed_date` datetime DEFAULT NULL,
  `isEscalated` tinyint(1) DEFAULT NULL,
  `Mentor1` int(11) DEFAULT NULL,
  `Mentor2` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `creator_user_id`, `status`, `created_date`, `subject`, `description`, `assign_user_id`, `domain_id`, `subdomain_id`, `file`, `priority_id`, `assigned_date`, `closed_date`, `isEscalated`, `Mentor1`, `Mentor2`) VALUES
(41, 21, 'Pending', '2014-07-17 10:48:57', 'Explain different way of using thread?', 'Explain different way of using thread?', 19, 8, 1, '', 1, '2014-07-24 11:08:51', NULL, NULL, 7, NULL),
(42, 21, 'Pending', '2014-07-17 10:52:45', 'What is a constructor?', 'What is a constructor?', 17, 8, 2, '', 2, '2014-07-24 11:08:52', NULL, NULL, 19, NULL),
(43, 21, 'Close', '2014-07-17 10:59:08', 'Errors.', 'What is run-time error?', 19, 8, 2, '', 2, '2014-07-17 10:59:08', NULL, NULL, NULL, NULL),
(46, 5, 'Pending', '2014-10-25 17:01:47', 'adsfa', 'sdf', 1000, 8, 2, '', 3, '2014-10-25 17:01:47', NULL, NULL, NULL, NULL),
(47, 21, 'Close', '2014-07-17 10:59:08', 'Errors.', 'What is run-time error?', 21, 8, 2, '', 2, '2014-07-17 10:59:08', NULL, NULL, NULL, NULL),
(48, 5, 'Pending', '2014-11-11 00:59:57', 'test', 'test123', 1000, 8, NULL, '', 3, '2014-11-11 00:59:57', NULL, NULL, NULL, NULL),
(49, 5, 'Pending', '2014-11-14 01:13:32', 'ddd', 'ddd', 1000, 10, NULL, '', 3, '2014-11-14 01:13:32', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`) VALUES
(1, 'Florida International University'),
(2, 'University of Miami'),
(3, 'Florida State University'),
(4, 'Florida Atlantic University');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) unsigned NOT NULL COMMENT 'User ID ',
  `username` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'User Name',
  `password` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'User Password',
  `email` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'User Email',
  `fname` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'User First Name',
  `mname` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'User Middle Name',
  `lname` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'User Last Name',
  `pic_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'User Picture Location',
  `activated` tinyint(1) DEFAULT '0' COMMENT '1: Yes 0: No',
  `activation_chain` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Activation String',
  `disable` tinyint(1) DEFAULT '0' COMMENT 'Profile Status 1: Enable 0: Disable',
  `biography` varchar(500) DEFAULT NULL,
  `university_id` int(11) unsigned DEFAULT NULL,
  `linkedin_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fiucs_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'FIU CS ID',
  `google_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Google ID',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The user is administrator',
  `isProMentor` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Project Mentor',
  `isPerMentor` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Personal Mentor',
  `isDomMentor` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Domain Mentor',
  `isStudent` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The use is student',
  `isMentee` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Mentee',
  `isJudge` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Judge',
  `isEmployer` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The user is an Employeer',
  `isNew` tinyint(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1017 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `fname`, `mname`, `lname`, `pic_url`, `activated`, `activation_chain`, `disable`, `biography`, `university_id`, `linkedin_id`, `fiucs_id`, `google_id`, `isAdmin`, `isProMentor`, `isPerMentor`, `isDomMentor`, `isStudent`, `isMentee`, `isJudge`, `isEmployer`, `isNew`) VALUES
(5, 'admin', '$2a$08$6pW5QFWe0pyvX/HA8bd.QeVmwl/bKV.FyHSokIDy1B8EJRFhU.rYO', 'admin@fiu.edu', 'Masoud', '', 'Sadjadi', '/coplat/images/profileimages/avatarsmall.gif', 1, 'z2vtszc43g', 0, 'I am the admin and professor, this is a test', NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(6, 'lsanc104', '$2a$08$6pW5QFWe0pyvX/HA8bd.QeVmwl/bKV.FyHSokIDy1B8EJRFhU.rYO', 'lsanc104@fiu.edu', 'Lorenzo', 'Alexis', 'Sanchez', '/coplat/images/profileimages/avatarsmall.gif', 1, 'au5n3h1mqd', 0, 'now u can edit the bio', NULL, NULL, NULL, NULL, 0, 1, 1, 1, 0, 0, 0, 0, 0),
(7, 'hmuni006', '$2a$08$6pW5QFWe0pyvX/HA8bd.QeVmwl/bKV.FyHSokIDy1B8EJRFhU.rYO', 'hmuni006@fiu.edu', 'Henry', 'Daniel', 'Muniz', '/coplat/images/profileimages/avatarsmall.gif', 1, 'kf049x8q3q', 0, 'test', NULL, NULL, NULL, NULL, 0, 1, 1, 1, 0, 0, 0, 0, 0),
(8, 'jsant001', '$2a$08$GWs3jgPEaTWe9TZLWpE/U.owu4794mtsbvfYYYPy1cDzKShKXShKG', 'jsant001@fiu.edu', 'Jonathan', 'Raul', 'Santiago', '/coplat/images/profileimages/avatarsmall.gif', 1, '5yq43kqdqx', 0, NULL, 1, NULL, NULL, NULL, 0, 0, 0, 1, 0, 1, 0, 0, 0),
(9, 'jquiroz001', '$2a$08$EygxbfziOouYIdcur3kCS.w/PGT4TazBLQfdx1o.MkWlTs.xzD/dO', 'jquiroz001@fiu.edu', 'Javier', '', 'Quiroz', '/coplat/images/profileimages/avatarsmall.gif', 1, '9ilo03t2dw', 0, NULL, 2, NULL, NULL, NULL, 0, 0, 0, 1, 0, 1, 0, 0, 0),
(10, 'itroche001', '$2a$08$Weql45c0PGqtZpoT3Dd0BOtuRmvfre4eCOSKs/U5j1bb/GQb9tMCu', 'itroche001@fiu.edu', 'Ingrid', '', 'Troche', '/coplat/images/profileimages/avatarsmall.gif', 1, 'bnq2lehy8p', 0, NULL, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(11, 'ctope001', '$2a$08$WAMVjWpFUjhvUiF93FN8aOei31hF3sDNFWPCacfJKDsI9xAc4YNfW', 'ctope001@fiu.edu', 'Cynthia', '', 'Tope', '/coplat/images/profileimages/avatarsmall.gif', 1, 'fp7obcosno', 0, NULL, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(12, 'ckerrut001', '$2a$08$.zjXSIhinaN2IF6R4uxocuVzHdy0LjL/4qWyjCJKpDECzPv9yjVmm', 'ckerrut001@fiu.edu', 'Christopher', '', 'Kerrut', '/coplat/images/profileimages/avatarsmall.gif', 1, 'ruf1f0d9wn', 0, NULL, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(16, 'Henry_16', '$2a$08$6pW5QFWe0pyvX/HA8bd.QeVmwl/bKV.FyHSokIDy1B8EJRFhU.rYO', 'henrydaniel25@gmail.com', 'Henry', 'D', 'Muniz Romero', '/coplat/images/profileimages/avatarsmall.gif', 1, 'vat4dkf1th', 0, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(17, 'jlei', '$2a$08$6pW5QFWe0pyvX/HA8bd.QeVmwl/bKV.FyHSokIDy1B8EJRFhU.rYO', 'jlei@email.com', 'Jiali', '', 'Lei', '/coplat/images/profileimages/avatarsmall.gif', 1, 'imltjmdka7', 1, 'This is a test for Jiali Lei', NULL, NULL, NULL, NULL, 0, 1, 1, 1, 0, 0, 0, 0, 0),
(18, 'ssana002', '$2a$08$yUNh7.16AKZcL10nuDIXFO/Ne7amgj4e43dZ9wiytVaz11SovleOm', 'ssana002@fiu.edu', 'Steven', '', 'Sanabria', '/coplat/images/profileimages/avatarsmall.gif', 1, 'qdad4orb2l', 0, '', NULL, NULL, NULL, NULL, 0, 1, 1, 1, 0, 0, 0, 0, 0),
(19, 'pedro', '$2a$08$qc4kFp6kj7NflPPJpT1I3O9GzqzIRV2hi9gJvZOFXXQawbZA7NmS2', 'default@fiu.edu', 'Pedro', '', 'Escandell', '/coplat/images/profileimages/default_pic.jpg', 1, 'rh7xn3ulba', 0, 'Tell us something about yourself...', NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(20, 'mentee', '$2a$08$OlubZyba0fTFu1tz8XV8h..tO31bjtq9RVxjoGzNZ8U7uk2Frm0Vm', 'default@fiu.edu', 'mentee', '', 'mentee', '/coplat/images/profileimages/default_pic.jpg', 0, 'lnn70dg960', 0, 'Tell us something about yourself...', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 'rgome020', '$2a$08$B5yfdg/E644y2STJJfEMjOR0bg/X7aH5gUtN8VIL1QABpxNI7KSCG', 'rgome020@fiu.edu', 'Ramon', '', 'Gomez', '/coplat/images/profileimages/default_pic.jpg', 1, 'fvv6v1cb1a', 0, 'Tell us something about yourself...', 2, NULL, NULL, NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(22, 'SYSTEM', '', '', 'Automatically', '', 'Reassignment', '/coplat/images/profileimages/default_pic.jpg', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(999, 'DEFAULT', '', 'default@fiu.edu', '--', '', '--', '/coplat/images/profileimages/default_pic.jpg', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, 0, 0, 0, 0, 0),
(1000, 'nmada002', '$2a$08$NXzB2/jCHviwH.xiqZRNuOBAmZgkZWbtdZoEydKTvmXZmWeHjMEAO', 'nmada002@fiu.edu', 'Nicholas', '', 'Madariaga', '/coplat/images/profileimages/default_pic.jpg', 1, 'yu49ebtkae', 1, 'Tell us something about yourself...', NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(1002, 'jphil075', '$2a$08$QyBxPLnyhChySQPT5VSdVeFXWBeHyCxSExN6yhfrVii.NqQOi3fDq', 'jphil075@fiu.edu', 'Justin', '', 'Phillips', '/coplat/images/profileimages/default_pic.jpg', 1, NULL, 0, NULL, 3, NULL, '0108602', NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(1003, 'jmcga005', '$2a$08$2kmV9t8tY3D43HCFt.U/aeyOc6laHt3Hm0WrleHGhHKvLuWkyXKfK', 'jmcga005@fiu.edu', 'Jorge', '', 'Mcgarry', '/coplat/images/profileimages/default_pic.jpg', 1, NULL, 0, NULL, 4, NULL, '1054101', NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(1004, 'rmart071', '$2a$08$bU7SlQ2iebVfYsQvPhf55O.6hX5gwGPnGHhRCcb776HZpuohN1Hti', 'rmart071@fiu.edu', 'Ricardo', '', 'Martinez', '/coplat/images/profileimages/default_pic.jpg', 1, NULL, 0, NULL, 1, NULL, '1676926', NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(1005, 'jsanc090', '$2a$08$6pW5QFWe0pyvX/HA8bd.QeVmwl/bKV.FyHSokIDy1B8EJRFhU.rYO', 'jsanc090@fiu.edu', 'Jonathan', '', 'Sanchez', '/coplat/images/profileimages/default_pic.jpg', 1, NULL, 0, 'This is a description', 2, NULL, '2051994', NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(1006, 'mgonz108', '$2a$08$APFkqCc0B2Mpl8c.tyUlVOlmDXhzCu9f9p8tczq5/QjUUVLNU3WcS', 'mgonz108@fiu.edu', 'Maylem', '', 'Gonzalez', '/coplat/images/profileimages/default_pic.jpg', 1, NULL, 0, NULL, 3, NULL, '2134900', NULL, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(1012, 'sbruh', '$2a$08$BXXhh0ZtHS9yaFApVP0eJeZEMcg/0.a2j88mcH4qgT3Axt61J.SKS', 'sburh002@fiu.edu', 'Steve', '', 'Bruhl', '/coplat/images/profileimages/default_pic.jpg', 1, 'b691sno7l2', 0, 'Tell us something about yourself...', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1013, 'demo', '$2a$08$Ox0j8A1gAujH10tyzyEUH.fTf68FHnNrMzpBEJGi8a1npROQPkzyq', 'demo@gmail.com', 'Demo', '', 'Demo', '/coplat/images/profileimages/default_pic.jpg', 1, 'yw48etlu0r', 0, 'Tell us something about yourself...', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1015, 'fmsdlkfjsldkfj', '$2a$08$Q72M.jpoHDaTYtZH59ucp.dD7V.eZoN/uY1t3FX8aMVPOVlw4K27S', 'jj@gmail.com', 'kfjabk', 'akfnal', 'flskdfal', '/coplat/images/profileimages/default_pic.jpg', 1, '43rzlarccv', 0, 'Tell us something about yourself...', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1016, 'demo2', '$2a$08$p.SUDqc3Jgf/Ag.qGLA8.uggRjGTafjmB15CpEfX.9Phc3akPDXOW', 'demo2@gmail.com', 'demo2', 'demo2', 'demo2', '/coplat/images/profileimages/default_pic.jpg', 1, '1ml7q3suo4', 0, 'Tell us something about yourself...', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_domain`
--

CREATE TABLE IF NOT EXISTS `user_domain` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `domain_id` int(11) unsigned NOT NULL,
  `subdomain_id` int(11) unsigned DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `tier_team` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `user_domain`
--

INSERT INTO `user_domain` (`id`, `user_id`, `domain_id`, `subdomain_id`, `rate`, `active`, `tier_team`) VALUES
(2, 7, 8, 1, 8, 1, 1),
(4, 8, 10, NULL, 10, 1, 1),
(5, 19, 8, 1, 10, 1, 1),
(96, 6, 8, 1, 2, 1, 2),
(97, 6, 8, 2, 9, 1, 2),
(99, 17, 8, 1, 8, 1, 1),
(100, 19, 8, 2, 9, 1, 1),
(101, 17, 8, 2, 9, 1, 1),
(102, 1012, 8, NULL, 5, 1, 1),
(103, 1012, 8, 1, 5, 1, 1),
(104, 1013, 8, NULL, 5, 1, 1),
(105, 1013, 8, 2, 2, 1, 1),
(106, 1013, 8, 8, 3, 1, 1),
(107, 1013, 8, NULL, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(10) unsigned NOT NULL,
  `employer` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `job_start` int(4) unsigned NOT NULL,
  `degree` varchar(50) NOT NULL,
  `field_of_study` varchar(50) NOT NULL,
  `university` varchar(60) NOT NULL,
  `grad_year` int(4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `employer`, `position`, `job_start`, `degree`, `field_of_study`, `university`, `grad_year`) VALUES
(1013, 'Demo', 'Demo', 2014, 'Bachelors', 'Demo', 'Demo', 2014),
(1016, 'FIU', 'Professor', 0, 'PhD', 'CS', 'FIU', 1999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
 ADD PRIMARY KEY (`user_id`), ADD KEY `fk_administrator_user1_idx` (`user_id`);

--
-- Indexes for table `application_closed`
--
ALTER TABLE `application_closed`
 ADD PRIMARY KEY (`id`), ADD KEY `app_domain_mentor_id` (`app_domain_mentor_id`), ADD KEY `app_personal_mentor_id` (`app_personal_mentor_id`), ADD KEY `app_project_mentor_id` (`app_project_mentor_id`);

--
-- Indexes for table `application_domain_mentor`
--
ALTER TABLE `application_domain_mentor`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `application_domain_mentor_pick`
--
ALTER TABLE `application_domain_mentor_pick`
 ADD PRIMARY KEY (`id`), ADD KEY `app_id` (`app_id`), ADD KEY `domain_id` (`domain_id`);

--
-- Indexes for table `application_personal_mentor`
--
ALTER TABLE `application_personal_mentor`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `university_id` (`university_id`);

--
-- Indexes for table `application_personal_mentor_pick`
--
ALTER TABLE `application_personal_mentor_pick`
 ADD PRIMARY KEY (`id`), ADD KEY `app_id` (`app_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `application_project_mentor`
--
ALTER TABLE `application_project_mentor`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `application_project_mentor_pick`
--
ALTER TABLE `application_project_mentor_pick`
 ADD PRIMARY KEY (`id`), ADD KEY `project_id` (`project_id`), ADD KEY `app_id` (`app_id`);

--
-- Indexes for table `application_recommended_domain`
--
ALTER TABLE `application_recommended_domain`
 ADD PRIMARY KEY (`id`), ADD KEY `appId` (`appId`);

--
-- Indexes for table `application_subdomain_mentor_pick`
--
ALTER TABLE `application_subdomain_mentor_pick`
 ADD PRIMARY KEY (`id`), ADD KEY `app_id` (`app_id`), ADD KEY `subdomain_id` (`subdomain_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_comment_ticket1_idx` (`ticket_id`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_mentor`
--
ALTER TABLE `domain_mentor`
 ADD PRIMARY KEY (`user_id`), ADD KEY `fk_domain_mentor_user1_idx` (`user_id`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_invitation_administrator1_idx` (`administrator_user_id`);

--
-- Indexes for table `invitation_resends`
--
ALTER TABLE `invitation_resends`
 ADD PRIMARY KEY (`id`), ADD KEY `invitation_id` (`invitation_id`);

--
-- Indexes for table `mentee`
--
ALTER TABLE `mentee`
 ADD PRIMARY KEY (`user_id`), ADD KEY `fk_mentee_personal_mentor1_idx` (`personal_mentor_user_id`), ADD KEY `fk_mentee_project1_idx` (`project_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_message_user1_idx` (`receiver`), ADD KEY `fk_message_user2_idx` (`sender`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_meeting`
--
ALTER TABLE `personal_meeting`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_personal_meeting_mentee1_idx` (`mentee_user_id`), ADD KEY `fk_personal_meeting_personal_mentor1_idx` (`personal_mentor_user_id`);

--
-- Indexes for table `personal_mentor`
--
ALTER TABLE `personal_mentor`
 ADD PRIMARY KEY (`user_id`), ADD KEY `fk_personal_mentor_user1_idx` (`user_id`);

--
-- Indexes for table `personal_mentor_mentees`
--
ALTER TABLE `personal_mentor_mentees`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `personal_mentor_id` (`personal_mentor_id`), ADD KEY `personal_mentor_id_2` (`personal_mentor_id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_project_user1_idx` (`propose_by_user_id`), ADD KEY `fk_project_project_mentor1_idx` (`project_mentor_user_id`);

--
-- Indexes for table `project_meeting`
--
ALTER TABLE `project_meeting`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_project_meeting_project_mentor1_idx` (`project_mentor_user_id`), ADD KEY `fk_project_meeting_mentee1_idx` (`mentee_user_id`);

--
-- Indexes for table `project_mentor`
--
ALTER TABLE `project_mentor`
 ADD PRIMARY KEY (`user_id`), ADD KEY `fk_project_mentor_user1_idx` (`user_id`);

--
-- Indexes for table `project_mentor_projects`
--
ALTER TABLE `project_mentor_projects`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`project_id`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `subdomain`
--
ALTER TABLE `subdomain`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_subdomain_domain1_idx` (`domain_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_ticket_user2_idx` (`creator_user_id`), ADD KEY `fk_ticket_user1_idx` (`assign_user_id`), ADD KEY `fk_ticket_domain1_idx` (`domain_id`), ADD KEY `fk_ticket_subdomain1_idx` (`subdomain_id`), ADD KEY `priority_id` (`priority_id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_domain`
--
ALTER TABLE `user_domain`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_domain_has_user_user1_idx` (`user_id`), ADD KEY `fk_domain_has_user_domain1_idx` (`domain_id`), ADD KEY `fk_user_domain_subdomain1_idx` (`subdomain_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_closed`
--
ALTER TABLE `application_closed`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `application_domain_mentor`
--
ALTER TABLE `application_domain_mentor`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `application_domain_mentor_pick`
--
ALTER TABLE `application_domain_mentor_pick`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `application_personal_mentor`
--
ALTER TABLE `application_personal_mentor`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `application_personal_mentor_pick`
--
ALTER TABLE `application_personal_mentor_pick`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `application_project_mentor`
--
ALTER TABLE `application_project_mentor`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `application_project_mentor_pick`
--
ALTER TABLE `application_project_mentor_pick`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `application_recommended_domain`
--
ALTER TABLE `application_recommended_domain`
MODIFY `id` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `application_subdomain_mentor_pick`
--
ALTER TABLE `application_subdomain_mentor_pick`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `invitation_resends`
--
ALTER TABLE `invitation_resends`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Message ID';
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `personal_meeting`
--
ALTER TABLE `personal_meeting`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `personal_mentor_mentees`
--
ALTER TABLE `personal_mentor_mentees`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `project_meeting`
--
ALTER TABLE `project_meeting`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project_mentor_projects`
--
ALTER TABLE `project_mentor_projects`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subdomain`
--
ALTER TABLE `subdomain`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User ID ',AUTO_INCREMENT=1017;
--
-- AUTO_INCREMENT for table `user_domain`
--
ALTER TABLE `user_domain`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
ADD CONSTRAINT `fk_administrator_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_closed`
--
ALTER TABLE `application_closed`
ADD CONSTRAINT `application_closed_ibfk_1` FOREIGN KEY (`app_domain_mentor_id`) REFERENCES `application_domain_mentor` (`id`),
ADD CONSTRAINT `application_closed_ibfk_2` FOREIGN KEY (`app_personal_mentor_id`) REFERENCES `application_personal_mentor` (`id`),
ADD CONSTRAINT `application_closed_ibfk_3` FOREIGN KEY (`app_project_mentor_id`) REFERENCES `application_project_mentor` (`id`);

--
-- Constraints for table `application_domain_mentor`
--
ALTER TABLE `application_domain_mentor`
ADD CONSTRAINT `application_domain_mentor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `application_domain_mentor_pick`
--
ALTER TABLE `application_domain_mentor_pick`
ADD CONSTRAINT `application_domain_mentor_pick_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application_domain_mentor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `application_domain_mentor_pick_ibfk_2` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_personal_mentor`
--
ALTER TABLE `application_personal_mentor`
ADD CONSTRAINT `application_personal_mentor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `application_personal_mentor_ibfk_2` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `application_personal_mentor_pick`
--
ALTER TABLE `application_personal_mentor_pick`
ADD CONSTRAINT `application_personal_mentor_pick_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application_personal_mentor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `application_personal_mentor_pick_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_project_mentor`
--
ALTER TABLE `application_project_mentor`
ADD CONSTRAINT `application_project_mentor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_project_mentor_pick`
--
ALTER TABLE `application_project_mentor_pick`
ADD CONSTRAINT `application_project_mentor_pick_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application_project_mentor` (`id`),
ADD CONSTRAINT `application_project_mentor_pick_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `application_recommended_domain`
--
ALTER TABLE `application_recommended_domain`
ADD CONSTRAINT `application_recommended_domain_ibfk_1` FOREIGN KEY (`appId`) REFERENCES `application_domain_mentor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_subdomain_mentor_pick`
--
ALTER TABLE `application_subdomain_mentor_pick`
ADD CONSTRAINT `application_subdomain_mentor_pick_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application_domain_mentor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `application_subdomain_mentor_pick_ibfk_2` FOREIGN KEY (`subdomain_id`) REFERENCES `subdomain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `fk_comment_ticket1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `domain_mentor`
--
ALTER TABLE `domain_mentor`
ADD CONSTRAINT `fk_domain_mentor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invitation`
--
ALTER TABLE `invitation`
ADD CONSTRAINT `fk_invitation_administrator1` FOREIGN KEY (`administrator_user_id`) REFERENCES `administrator` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invitation_resends`
--
ALTER TABLE `invitation_resends`
ADD CONSTRAINT `invitation_resends_ibfk_1` FOREIGN KEY (`invitation_id`) REFERENCES `invitation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mentee`
--
ALTER TABLE `mentee`
ADD CONSTRAINT `fk_mentee_personal_mentor1` FOREIGN KEY (`personal_mentor_user_id`) REFERENCES `personal_mentor` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_mentee_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_mentee_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
ADD CONSTRAINT `fk_message_user1` FOREIGN KEY (`receiver`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_message_user2` FOREIGN KEY (`sender`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `personal_meeting`
--
ALTER TABLE `personal_meeting`
ADD CONSTRAINT `fk_personal_meeting_mentee1` FOREIGN KEY (`mentee_user_id`) REFERENCES `mentee` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_personal_meeting_personal_mentor1` FOREIGN KEY (`personal_mentor_user_id`) REFERENCES `personal_mentor` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `personal_mentor`
--
ALTER TABLE `personal_mentor`
ADD CONSTRAINT `fk_personal_mentor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `personal_mentor_mentees`
--
ALTER TABLE `personal_mentor_mentees`
ADD CONSTRAINT `personal_mentor_mentees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `personal_mentor_mentees_ibfk_2` FOREIGN KEY (`personal_mentor_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_meeting`
--
ALTER TABLE `project_meeting`
ADD CONSTRAINT `fk_project_meeting_mentee1` FOREIGN KEY (`mentee_user_id`) REFERENCES `mentee` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_project_meeting_project_mentor1` FOREIGN KEY (`project_mentor_user_id`) REFERENCES `project_mentor` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_mentor`
--
ALTER TABLE `project_mentor`
ADD CONSTRAINT `fk_project_mentor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_mentor_projects`
--
ALTER TABLE `project_mentor_projects`
ADD CONSTRAINT `project_mentor_projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `project_mentor_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `subdomain`
--
ALTER TABLE `subdomain`
ADD CONSTRAINT `fk_subdomain_domain1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
ADD CONSTRAINT `fk_ticket_domain1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ticket_subdomain1` FOREIGN KEY (`subdomain_id`) REFERENCES `subdomain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ticket_user1` FOREIGN KEY (`assign_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_ticket_user2` FOREIGN KEY (`creator_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `priority_id` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_domain`
--
ALTER TABLE `user_domain`
ADD CONSTRAINT `fk_domain_has_user_domain1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_domain_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_user_domain_subdomain1` FOREIGN KEY (`subdomain_id`) REFERENCES `subdomain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
ADD CONSTRAINT `user_info` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
