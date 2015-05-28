-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: coplat
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_administrator_user1_idx` (`user_id`),
  CONSTRAINT `fk_administrator_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (5),(16);
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_closed`
--

DROP TABLE IF EXISTS `application_closed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_closed` (
  `app_domain_mentor_id` int(11) unsigned DEFAULT NULL,
  `app_personal_mentor_id` int(11) unsigned DEFAULT NULL,
  `app_project_mentor_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_domain_mentor_id` (`app_domain_mentor_id`),
  KEY `app_personal_mentor_id` (`app_personal_mentor_id`),
  KEY `app_project_mentor_id` (`app_project_mentor_id`),
  CONSTRAINT `application_closed_ibfk_1` FOREIGN KEY (`app_domain_mentor_id`) REFERENCES `application_domain_mentor` (`id`),
  CONSTRAINT `application_closed_ibfk_2` FOREIGN KEY (`app_personal_mentor_id`) REFERENCES `application_personal_mentor` (`id`),
  CONSTRAINT `application_closed_ibfk_3` FOREIGN KEY (`app_project_mentor_id`) REFERENCES `application_project_mentor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_closed`
--

LOCK TABLES `application_closed` WRITE;
/*!40000 ALTER TABLE `application_closed` DISABLE KEYS */;
INSERT INTO `application_closed` VALUES (NULL,12,NULL,'2015-03-16 22:32:10',1,0),(NULL,NULL,28,'2015-03-16 22:35:11',2,0),(7,13,NULL,'2015-03-16 22:54:34',3,0),(8,NULL,NULL,'2015-03-16 23:19:37',4,10),(NULL,14,NULL,'2015-03-16 23:29:18',5,10),(9,15,29,'2015-04-10 13:38:42',6,5);
/*!40000 ALTER TABLE `application_closed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_domain_mentor`
--

DROP TABLE IF EXISTS `application_domain_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_domain_mentor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `status` enum('Admin','Mentor','Closed') DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `max_amount` int(11) NOT NULL,
  `max_hours` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `application_domain_mentor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Application for Domain Mentor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_domain_mentor`
--

LOCK TABLES `application_domain_mentor` WRITE;
/*!40000 ALTER TABLE `application_domain_mentor` DISABLE KEYS */;
INSERT INTO `application_domain_mentor` VALUES (7,10,'Closed','2015-03-16 22:36:29',22,0),(8,10,'Closed','2015-03-16 23:19:12',3,0),(9,5,'Closed','2015-04-10 13:38:02',44,0);
/*!40000 ALTER TABLE `application_domain_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_domain_mentor_pick`
--

DROP TABLE IF EXISTS `application_domain_mentor_pick`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_domain_mentor_pick` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(11) unsigned NOT NULL,
  `domain_id` int(11) unsigned NOT NULL,
  `proficiency` int(2) unsigned NOT NULL,
  `approval_status` enum('Proposed by Admin','Proposed by Mentor','Approved','Rejected') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_id` (`app_id`),
  KEY `domain_id` (`domain_id`),
  CONSTRAINT `application_domain_mentor_pick_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application_domain_mentor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `application_domain_mentor_pick_ibfk_2` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='domain mentor picks for domain table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_domain_mentor_pick`
--

LOCK TABLES `application_domain_mentor_pick` WRITE;
/*!40000 ALTER TABLE `application_domain_mentor_pick` DISABLE KEYS */;
INSERT INTO `application_domain_mentor_pick` VALUES (8,7,8,1,'Rejected'),(9,7,9,1,'Rejected'),(10,8,8,3,'Approved'),(11,9,8,6,'Approved'),(12,9,9,8,'Approved');
/*!40000 ALTER TABLE `application_domain_mentor_pick` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_personal_mentor`
--

DROP TABLE IF EXISTS `application_personal_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_personal_mentor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `status` enum('Admin','Mentor','Closed') NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `max_amount` int(2) unsigned NOT NULL,
  `max_hours` int(2) unsigned NOT NULL,
  `system_pick_amount` int(1) unsigned DEFAULT NULL,
  `university_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `university_id` (`university_id`),
  CONSTRAINT `application_personal_mentor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `application_personal_mentor_ibfk_2` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='application for personal mentor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_personal_mentor`
--

LOCK TABLES `application_personal_mentor` WRITE;
/*!40000 ALTER TABLE `application_personal_mentor` DISABLE KEYS */;
INSERT INTO `application_personal_mentor` VALUES (12,10,'Closed','2015-03-16 22:30:55',0,0,6,NULL),(13,10,'Closed','2015-03-16 22:50:29',0,0,0,NULL),(14,10,'Closed','2015-03-16 23:28:51',0,0,0,NULL),(15,5,'Closed','2015-04-10 13:37:39',0,0,0,NULL);
/*!40000 ALTER TABLE `application_personal_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_personal_mentor_pick`
--

DROP TABLE IF EXISTS `application_personal_mentor_pick`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_personal_mentor_pick` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `approval_status` enum('Proposed by Admin','Proposed by Mentor','Approved','Rejected','Proposed by System') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_id` (`app_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `application_personal_mentor_pick_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application_personal_mentor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `application_personal_mentor_pick_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COMMENT='picks for the personal mentor from the user table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_personal_mentor_pick`
--

LOCK TABLES `application_personal_mentor_pick` WRITE;
/*!40000 ALTER TABLE `application_personal_mentor_pick` DISABLE KEYS */;
INSERT INTO `application_personal_mentor_pick` VALUES (14,12,8,'Rejected'),(15,12,9,'Rejected'),(16,12,10,'Rejected'),(17,12,11,'Rejected'),(18,12,21,'Rejected'),(19,12,1002,'Rejected'),(20,13,1018,'Approved'),(21,14,1018,'Approved'),(22,15,1018,'Approved'),(23,15,1017,'Approved');
/*!40000 ALTER TABLE `application_personal_mentor_pick` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_project_mentor`
--

DROP TABLE IF EXISTS `application_project_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_project_mentor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `status` enum('Admin','Mentor','Closed') NOT NULL,
  `date_created` datetime NOT NULL,
  `max_amount` int(2) unsigned NOT NULL,
  `max_hours` int(2) unsigned NOT NULL,
  `system_pick_amount` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `application_project_mentor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COMMENT='application for a project mentor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_project_mentor`
--

LOCK TABLES `application_project_mentor` WRITE;
/*!40000 ALTER TABLE `application_project_mentor` DISABLE KEYS */;
INSERT INTO `application_project_mentor` VALUES (28,10,'Closed','2015-03-16 22:33:52',0,0,0),(29,5,'Closed','2015-04-10 13:37:48',0,0,0);
/*!40000 ALTER TABLE `application_project_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_project_mentor_pick`
--

DROP TABLE IF EXISTS `application_project_mentor_pick`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_project_mentor_pick` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(11) unsigned NOT NULL,
  `project_id` int(11) unsigned NOT NULL,
  `approval_status` enum('Proposed by Mentor','Proposed by Admin','Approved','Rejected','Proposed by System') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `app_id` (`app_id`),
  CONSTRAINT `application_project_mentor_pick_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application_project_mentor` (`id`),
  CONSTRAINT `application_project_mentor_pick_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_project_mentor_pick`
--

LOCK TABLES `application_project_mentor_pick` WRITE;
/*!40000 ALTER TABLE `application_project_mentor_pick` DISABLE KEYS */;
INSERT INTO `application_project_mentor_pick` VALUES (45,28,133,'Rejected'),(46,28,125,'Approved'),(47,29,125,'Approved'),(48,29,121,'Approved');
/*!40000 ALTER TABLE `application_project_mentor_pick` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_recommended_domain`
--

DROP TABLE IF EXISTS `application_recommended_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_recommended_domain` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `appId` int(3) unsigned NOT NULL,
  `domain` varchar(20) NOT NULL,
  `subdomain` varchar(20) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `proficiency` int(2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `appId` (`appId`),
  CONSTRAINT `application_recommended_domain_ibfk_1` FOREIGN KEY (`appId`) REFERENCES `application_domain_mentor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_recommended_domain`
--

LOCK TABLES `application_recommended_domain` WRITE;
/*!40000 ALTER TABLE `application_recommended_domain` DISABLE KEYS */;
/*!40000 ALTER TABLE `application_recommended_domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_subdomain_mentor_pick`
--

DROP TABLE IF EXISTS `application_subdomain_mentor_pick`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_subdomain_mentor_pick` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(11) unsigned NOT NULL,
  `subdomain_id` int(11) unsigned NOT NULL,
  `proficiency` int(2) NOT NULL,
  `approval_status` enum('Proposed by Admin','Proposed by Mentor','Approved','Rejected') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_id` (`app_id`),
  KEY `subdomain_id` (`subdomain_id`),
  CONSTRAINT `application_subdomain_mentor_pick_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `application_domain_mentor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `application_subdomain_mentor_pick_ibfk_2` FOREIGN KEY (`subdomain_id`) REFERENCES `subdomain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='domain mentor picks for subdomain table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_subdomain_mentor_pick`
--

LOCK TABLES `application_subdomain_mentor_pick` WRITE;
/*!40000 ALTER TABLE `application_subdomain_mentor_pick` DISABLE KEYS */;
INSERT INTO `application_subdomain_mentor_pick` VALUES (5,7,1,1,'Approved');
/*!40000 ALTER TABLE `application_subdomain_mentor_pick` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL,
  `added_date` datetime NOT NULL,
  `ticket_id` int(11) unsigned NOT NULL,
  `user_added` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_ticket1_idx` (`ticket_id`),
  CONSTRAINT `fk_comment_ticket1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COMMENT='				';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (174,'Run time Error - The errors encountered during execution of the program, due to unexpected input or output are called run-time error.','2014-07-17 11:00:14',43,'Pedro Escandell'),(177,'You should read Chapter 12 of your textbook.','2014-07-18 13:47:01',42,'Jiali Lei'),(179,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',41,'System'),(180,' This ticket was automatically reassigned by the system from mentor Pedro Escandell to mentor Jiali Lei','2014-07-24 11:08:52',42,'System'),(181,'Shits closed','2014-09-07 14:34:24',43,'Masoud Sadjadi'),(182,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',50,'System'),(183,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',41,'System'),(184,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',50,'System'),(185,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',51,'System'),(186,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',51,'System'),(188,'Ticket 41 was escalated to ticket 51','2015-01-21 18:56:28',41,'System'),(189,'Ticket 41 was escalated to ticket 51','2015-01-21 18:56:28',51,'System'),(190,'this is a comment','2015-01-21 19:14:16',52,'Lorenzo Sanchez'),(191,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',53,'System'),(192,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',53,'System'),(193,'Ticket 41 was escalated to ticket 51','2015-01-21 18:56:28',53,'System'),(194,'Ticket 41 was escalated to ticket 53','2015-01-21 19:19:49',41,'System'),(195,'Ticket 41 was escalated to ticket 53','2015-01-21 19:19:49',53,'System'),(196,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',54,'System'),(197,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',54,'System'),(198,'Ticket 41 was escalated to ticket 51','2015-01-21 18:56:28',54,'System'),(199,'Ticket 41 was escalated to ticket 53','2015-01-21 19:19:49',54,'System'),(203,'Ticket 41 was escalated to ticket 54','2015-01-21 19:21:50',41,'System'),(204,'Ticket 41 was escalated to ticket 54','2015-01-21 19:21:50',54,'System'),(205,'my comment','2015-01-21 19:25:27',52,'Lorenzo Sanchez'),(206,'Ticket 46 was escalated to ticket 55','2015-01-24 15:21:46',46,'System'),(207,'Ticket 46 was escalated to ticket 55','2015-01-24 15:21:46',55,'System'),(208,'Ticket 46 was escalated to ticket 55','2015-01-24 15:21:46',56,'System'),(209,'Ticket 46 was escalated to ticket 56','2015-01-24 15:21:46',46,'System'),(210,'Ticket 46 was escalated to ticket 56','2015-01-24 15:21:46',56,'System'),(211,'Ticket 46 was escalated to ticket 55','2015-01-24 15:21:46',57,'System'),(212,'Ticket 46 was escalated to ticket 56','2015-01-24 15:21:46',57,'System'),(214,'Ticket 46 was escalated to ticket 57','2015-01-24 15:21:48',46,'System'),(215,'Ticket 46 was escalated to ticket 57','2015-01-24 15:21:48',57,'System'),(216,'The answer to your question is ..........','2015-01-24 15:24:27',41,'Pedro Escandell'),(217,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',58,'System'),(218,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',58,'System'),(220,'Ticket 50 was escalated to ticket 58','2015-01-26 22:56:09',50,'System'),(221,'Ticket 50 was escalated to ticket 58','2015-01-26 22:56:10',58,'System'),(222,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',59,'System'),(223,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',59,'System'),(224,'Ticket 50 was escalated to ticket 58','2015-01-26 22:56:09',59,'System'),(225,'Ticket 50 was escalated to ticket 59','2015-01-26 22:56:10',50,'System'),(226,'Ticket 50 was escalated to ticket 59','2015-01-26 22:56:10',59,'System'),(227,'ffg','2015-02-18 16:56:28',60,'Adrian Alfonso'),(228,'cvxdfs','2015-02-18 17:00:37',60,'Adrian Alfonso'),(231,'a new commented ticket','2015-02-24 21:49:50',61,'Adrian Alfonso'),(232,'interesting','2015-02-24 22:01:43',61,'Adrian Alfonso'),(233,'a new one','2015-02-24 22:02:43',61,'Adrian Alfonso'),(234,'','2015-02-24 22:35:42',60,'Adrian Alfonso'),(235,'a comment','2015-02-24 22:38:45',61,'Adrian Alfonso'),(236,'rejected comment','2015-02-24 22:41:50',62,'Adrian Alfonso'),(237,'Just a resigned comment','2015-02-25 19:16:48',63,'Masoud Sadj'),(238,'Just a resigned comment','2015-02-25 19:16:48',64,'Masoud Sadj'),(239,'Ticket 63 was escalated to ticket 64','2015-02-25 20:42:10',63,'System'),(240,'Ticket 63 was escalated to ticket 64','2015-02-25 20:42:10',64,'System'),(241,'a comment','2015-02-26 19:17:47',65,'Adrian Alfonso'),(242,'a comment','2015-02-26 19:17:58',65,'Adrian Alfonso'),(243,'another','2015-02-26 19:18:19',65,'Adrian Alfonso'),(244,'1 comment','2015-02-26 19:19:06',65,'Adrian Alfonso'),(245,'','2015-03-01 11:36:27',68,'Adrian Alfonso'),(246,'','2015-03-01 11:36:28',68,'Adrian Alfonso'),(247,'','2015-03-01 11:36:43',67,'Adrian Alfonso'),(248,'this is the answer','2015-03-24 15:34:06',75,'Masoud Sadj'),(249,'this is the answer','2015-03-24 15:34:41',75,'Masoud Sadj'),(250,'this is the answer','2015-03-24 15:34:41',75,'Masoud Sadj');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain`
--

DROP TABLE IF EXISTS `domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `validator` int(11) DEFAULT '5' COMMENT 'Integer that validates the domain Tier Level.',
  `need` varchar(7) NOT NULL DEFAULT 'Medium' COMMENT 'Need',
  `need_amount` int(3) NOT NULL DEFAULT '5' COMMENT 'members needed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES (8,'Programming Lanaguage','All programming languages',5,'Medium',5),(9,'Biology','Is a natural science concerned with the study of life and living organisms, including their structure, function, growth, evolution, distribution, and taxonomy.[1] Modern biology is a vast and eclectic field, composed of many branches and subdisciplines. ',5,'Medium',5),(10,'Software Engineering','General questions about the software engineering cycle.',5,'Medium',5);
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain_mentor`
--

DROP TABLE IF EXISTS `domain_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domain_mentor` (
  `user_id` int(11) unsigned NOT NULL,
  `max_tickets` int(11) DEFAULT NULL,
  `Tier` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `fk_domain_mentor_user1_idx` (`user_id`),
  CONSTRAINT `fk_domain_mentor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain_mentor`
--

LOCK TABLES `domain_mentor` WRITE;
/*!40000 ALTER TABLE `domain_mentor` DISABLE KEYS */;
INSERT INTO `domain_mentor` VALUES (5,44,1),(6,20,1),(7,20,1),(8,20,1),(10,22,1),(17,10,1),(19,20,1),(999,NULL,1);
/*!40000 ALTER TABLE `domain_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_type`
--

DROP TABLE IF EXISTS `event_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id of the event type.',
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Records events';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_type`
--

LOCK TABLES `event_type` WRITE;
/*!40000 ALTER TABLE `event_type` DISABLE KEYS */;
INSERT INTO `event_type` VALUES (3,'Assigned to user'),(5,'Commented by mentor'),(4,'Commented by owner'),(7,'Escalated from '),(6,'Escalated to '),(1,'New'),(9,'Opened by mentor '),(8,'Opened by owner '),(2,'Status changed');
/*!40000 ALTER TABLE `event_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitation`
--

DROP TABLE IF EXISTS `invitation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `administrator_user_id` int(11) unsigned NOT NULL,
  `date` datetime DEFAULT NULL,
  `administrator` tinyint(1) DEFAULT NULL,
  `mentor` tinyint(1) DEFAULT NULL,
  `mentee` tinyint(1) DEFAULT NULL,
  `employer` tinyint(1) DEFAULT NULL,
  `judge` tinyint(1) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `message` varchar(750) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invitation_administrator1_idx` (`administrator_user_id`),
  CONSTRAINT `fk_invitation_administrator1` FOREIGN KEY (`administrator_user_id`) REFERENCES `administrator` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitation`
--

LOCK TABLES `invitation` WRITE;
/*!40000 ALTER TABLE `invitation` DISABLE KEYS */;
INSERT INTO `invitation` VALUES (1,'test123@test.com',5,'2014-11-14 07:41:04',0,0,0,0,0,'Test 123',''),(2,'aalfo$4@fiu.edu',5,'2015-01-24 05:29:18',1,1,0,0,0,'Adrian','The Collaborative Platform system administrator, Masoud Sadjadi, through this email would like to invite you to participate on it as: <br/><b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/><b><u>Mentor</u></b><br/>&nbsp;&nbsp;<i>Domain Mentor: Provide solutions using his/her expertise in specific domains to questions within the platform.</i><br/>&nbsp;&nbsp;<i>Project Mentor: Guide the project development through the semester.</i><br/>&nbsp;&nbsp;<i>Personal Mentor: Provide assistance and guidance to his/her mentees.</i><br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(3,'adfs@tt.com',5,'2015-01-25 16:47:21',0,0,1,0,0,'dfsd','The Collaborative Platform system administrator, Masoud Sadjadi, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(4,'aalfo$4@fiu.edu',5,'2015-01-25 16:55:51',1,0,0,0,0,'sfsdf','The Collaborative Platform system administrator, Masoud Sadjadi, through this email would like to invite you to participate on it as: <br/><b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(5,'dfdf',5,'2015-02-18 03:49:03',1,0,0,1,0,'sdfds','The Collaborative Platform system administrator, Adrian Alfonso, through this email would like to invite you to participate on it as: <br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(6,'dfdf',5,'2015-02-18 02:40:00',0,0,1,0,0,'fdff','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(7,'sfsdf@tt.com',5,'2015-02-18 02:42:33',0,0,1,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(8,'aalfo$4@fiu.edu',5,'2015-02-18 03:01:58',1,0,0,0,0,'Adrian','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>System Administrator: Responsible, for users, invitations, projects, domains and sub-domains management.</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(9,'sfdsf',5,'2015-02-18 03:02:48',0,0,1,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(10,'sfdsd@tt.com',5,'2015-02-18 03:57:22',1,0,1,0,0,'sdfsdf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(11,'ff@tt.com',5,'2015-02-18 03:19:14',0,0,1,0,0,'sdfds','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(12,'333@tt.com',5,'2015-02-18 03:34:01',0,0,1,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(13,'333@tt.com',5,'2015-02-18 03:34:35',1,0,0,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(14,'333@tt.com',5,'2015-02-18 03:35:47',1,0,0,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(15,'sfsdf@tt.com',5,'2015-02-18 03:37:02',0,0,1,0,0,'xvxfds','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(16,'sfsdf@tt.com',5,'2015-02-18 03:37:51',0,0,1,0,0,'xvxfds','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\ncddfdf<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(17,'sfds@ttte.com',5,'2015-02-18 03:45:50',1,0,0,0,0,'dfdf','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>System Administrator: Responsible, for users, invitations, projects, domains and sub-domains management.</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(19,'xcvcxv',5,'2015-02-18 04:03:29',0,0,1,0,0,'xcvxv','<p>dddddd</p>\r\n'),(20,'sfsf@fffcom',5,'2015-02-22 21:22:53',0,0,1,0,0,'sfd@fsdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(21,'sfsdf@tt.com',5,'2015-02-22 21:31:17',0,0,1,0,0,'ssdfsdf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(22,'sfsdf@dfsfdsfsdfsdf',5,'2015-02-22 21:32:12',0,0,1,0,0,'sfsdf','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(23,'sdfdsfdsfdf@dfsfsd.com',5,'2015-02-22 21:34:54',1,0,0,0,0,'sfdfdsf','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>System Administrator: Responsible, for users, invitations, projects, domains and sub-domains management.</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(24,'dfdsf',5,'2015-03-02 23:26:14',0,0,0,0,0,'dsfdf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(25,'sdfsdf@tt.com',5,'2015-04-14 02:30:21',0,0,1,0,0,'sdfsdf@tt.com','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(29,'adrianlfns@yahoo.com',5,'2015-04-17 02:00:46',0,0,1,0,0,'Adrian Alfonso','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php/site/landing/29\">Click here</a> to access the platform.</p>\r\n\r\n<p><canvas :netbeans_generated=\"true\" height=\"200\" id=\"netbeans_glasspane\" style=\"position: fixed; top: 0px; left: 0px; z-index: 50000; pointer-events: none;\" width=\"890\"></canvas></p>\r\n');
/*!40000 ALTER TABLE `invitation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitation_resends`
--

DROP TABLE IF EXISTS `invitation_resends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitation_resends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invitation_id` int(11) unsigned NOT NULL,
  `send_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invitation_id` (`invitation_id`),
  CONSTRAINT `invitation_resends_ibfk_1` FOREIGN KEY (`invitation_id`) REFERENCES `invitation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitation_resends`
--

LOCK TABLES `invitation_resends` WRITE;
/*!40000 ALTER TABLE `invitation_resends` DISABLE KEYS */;
/*!40000 ALTER TABLE `invitation_resends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mentee`
--

DROP TABLE IF EXISTS `mentee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mentee` (
  `user_id` int(11) unsigned NOT NULL,
  `personal_mentor_user_id` int(11) unsigned DEFAULT NULL,
  `project_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_mentee_personal_mentor1_idx` (`personal_mentor_user_id`),
  KEY `fk_mentee_project1_idx` (`project_id`),
  CONSTRAINT `fk_mentee_personal_mentor1` FOREIGN KEY (`personal_mentor_user_id`) REFERENCES `personal_mentor` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mentee_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mentee_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mentee`
--

LOCK TABLES `mentee` WRITE;
/*!40000 ALTER TABLE `mentee` DISABLE KEYS */;
INSERT INTO `mentee` VALUES (10,17,2),(21,17,2),(1002,999,112),(1003,999,133),(1004,999,115),(1005,999,108),(1006,999,134),(1017,999,NULL),(1018,999,NULL),(1019,999,NULL),(1020,999,NULL),(1021,999,110),(1022,999,NULL),(1023,999,NULL);
/*!40000 ALTER TABLE `mentee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Message ID',
  `receiver` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'Receiver username',
  `sender` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'Sender username',
  `message` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Message Body',
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Message Subject',
  `created_date` datetime NOT NULL COMMENT 'Message Creation Date',
  `been_read` tinyint(1) DEFAULT '0' COMMENT '0: NO 1: YES',
  `been_deleted` tinyint(1) DEFAULT '0' COMMENT '0: NO 1: YES',
  `userImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_message_user1_idx` (`receiver`),
  KEY `fk_message_user2_idx` (`sender`),
  CONSTRAINT `fk_message_user1` FOREIGN KEY (`receiver`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_user2` FOREIGN KEY (`sender`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'admin','admin','stest','test','2015-01-23 04:03:55',1,1,'/coplat/images/profileimages/avatarsmall.gif');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `datetime` time NOT NULL,
  `been_read` tinyint(1) NOT NULL DEFAULT '0',
  `message` varchar(5000) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `importancy` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,0,6,'15:27:55',0,'You got a new message from admin','http://localhost/coplat/index.php/message',3),(2,0,6,'15:28:55',0,'You got a new message from admin','http://localhost/coplat/index.php/message',3),(3,0,6,'01:01:46',0,'You got a new message from hmuni006','http://localhost/coplat/index.php/message',3),(4,0,6,'01:20:10',0,'You got a new message from hmuni006','http://localhost/coplat/index.php/message',3),(5,0,7,'01:21:15',0,'You got a new message from lsanc104','http://localhost/coplat/index.php/message',3),(6,0,6,'01:21:43',0,'You got a new message from hmuni006','http://localhost/coplat/index.php/message',3),(7,0,5,'04:03:55',0,'You got a new message from admin','http://localhost/coplat/index.php/message',3);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_meeting`
--

DROP TABLE IF EXISTS `personal_meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mentee_user_id` int(11) unsigned NOT NULL,
  `personal_mentor_user_id` int(11) unsigned NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personal_meeting_mentee1_idx` (`mentee_user_id`),
  KEY `fk_personal_meeting_personal_mentor1_idx` (`personal_mentor_user_id`),
  CONSTRAINT `fk_personal_meeting_mentee1` FOREIGN KEY (`mentee_user_id`) REFERENCES `mentee` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_meeting_personal_mentor1` FOREIGN KEY (`personal_mentor_user_id`) REFERENCES `personal_mentor` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_meeting`
--

LOCK TABLES `personal_meeting` WRITE;
/*!40000 ALTER TABLE `personal_meeting` DISABLE KEYS */;
INSERT INTO `personal_meeting` VALUES (1,21,17,'2014-11-01','08:00:00');
/*!40000 ALTER TABLE `personal_meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_mentor`
--

DROP TABLE IF EXISTS `personal_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_mentor` (
  `user_id` int(11) unsigned NOT NULL,
  `max_hours` varchar(45) DEFAULT NULL,
  `max_mentees` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_personal_mentor_user1_idx` (`user_id`),
  CONSTRAINT `fk_personal_mentor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_mentor`
--

LOCK TABLES `personal_mentor` WRITE;
/*!40000 ALTER TABLE `personal_mentor` DISABLE KEYS */;
INSERT INTO `personal_mentor` VALUES (5,'0','0'),(6,'12','0'),(7,'2','3'),(10,'0','0'),(17,'10','2'),(18,'',''),(999,NULL,NULL),(1013,'0','0');
/*!40000 ALTER TABLE `personal_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_mentor_mentees`
--

DROP TABLE IF EXISTS `personal_mentor_mentees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_mentor_mentees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `personal_mentor_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `personal_mentor_id` (`personal_mentor_id`),
  KEY `personal_mentor_id_2` (`personal_mentor_id`),
  CONSTRAINT `personal_mentor_mentees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `personal_mentor_mentees_ibfk_2` FOREIGN KEY (`personal_mentor_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='this table  matches mentees to their personal mentors';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_mentor_mentees`
--

LOCK TABLES `personal_mentor_mentees` WRITE;
/*!40000 ALTER TABLE `personal_mentor_mentees` DISABLE KEYS */;
INSERT INTO `personal_mentor_mentees` VALUES (1,1005,1012),(2,10,1013),(3,8,1013),(4,9,1013),(5,11,1013),(6,1018,10),(7,1018,10),(8,1018,5),(9,1017,5);
/*!40000 ALTER TABLE `personal_mentor_mentees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `reassignHours` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priority`
--

LOCK TABLES `priority` WRITE;
/*!40000 ALTER TABLE `priority` DISABLE KEYS */;
INSERT INTO `priority` VALUES (1,'High',6),(2,'Medium',12),(3,'Low',72);
/*!40000 ALTER TABLE `priority` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `propose_by_user_id` int(11) unsigned NOT NULL COMMENT 'Propose By',
  `project_mentor_user_id` int(11) unsigned DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `customer_fname` varchar(20) NOT NULL,
  `customer_lname` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_user1_idx` (`propose_by_user_id`),
  KEY `fk_project_project_mentor1_idx` (`project_mentor_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Collaborative Platform','Collaborative software or groupware is an application software designed to help people involved in a common task achieve goals. One of the earliest definitions of collaborative software is \'intentional group processes plus software to support them.\n',5,1012,'2014-01-06','2014-04-25','',''),(2,'Senior Project Website','This project builds on its previous version and addresses its issues and shortcomings. Here is all the resources from the second revision: \n\n',5,6,'2014-01-06','2014-04-25','',''),(3,'project testing','project testing',5,6,NULL,NULL,'',''),(82,'Mobile Judge: Version 4','This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SU14/03-MobileJudgeV3.zip\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/4-MobileJudgeV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/7-MobileJudge/\n',999,1016,NULL,NULL,'Masoud','Sadjadi'),(83,'Senior Project Web Site: Version 5','This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\n... Ask your mentor to provide the link.\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/6-SeniorProjectWebSiteV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/4-SeniorProjectWebSite/\n',999,5,NULL,NULL,'Masoud','Sadjadi'),(84,'Virtual Job Fair: Version 4','This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SU14/04-VirtualJobFairV3.zip\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/7-VirtualJobFairV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/3-VirtualJobFair/\n',999,16,NULL,NULL,'Juan','Caraballo'),(108,'Collaborative Platform v2','This project',999,1000,NULL,NULL,'Juan','Caraballo'),(110,'History App','This app is a virtual history tour/walk through town.  Files (audio, documents and photos) are linked to a GPS coordinate, so that the user can listen to or read files pertaining to a specific location.  Eventually, it will provide a searchable database of location based historical resources.  \n1.   a front page, and then ability to use location services to pull up local stories, a map to pick a location and find stories, or a search box to find a specific location.  FIU has a project called Terrafly, which is (from my understanding) google maps with the ability to overlay historical maps, this sort of thing would be ideal. I want the user to be able to \"program\" a series of stories so they can make a \"virtual walking/driving tour\".  \n\n2.  Admin needs to be able to upload files of varying sizes and types.  I would like to have categories at some point, some that users can add to on their own, allowing the users to add to the historical database.  This could include their own audio files (from snippets to oral',999,999,NULL,NULL,'Tracy','Beeson'),(111,'Mission-critical Cloud Computing','This project will study how to deliver mission assurance to mission-critical applications in cloud computing systems. Students will develop a virtual machine based approach to run applications with good security and reliability in typical cloud computing systems.\n\nThis project build upon the previous senior project\'s results: 1) A VM management system that dynamically migrate VMs across hosts on a\nOpenStack-based cloud platform; 2) A P2P overlay network that interconnect the OpenStack VMs based on the IP-over-P2P (IPOP) framework.\n\nThis new senior project will focus on developing an extension to IPOP that allow the communications among the VMs to be routed by the overlay network in a OpenStack-based cloud system.\n\nStudents will learn state-of-the-art virtualization, cloud, and P2P technologies in this project, and get mentoring from researchers at FIU, UF, and Air Force. Students will also be exposed to career opportunities at the Department of Defense.\n\nStudents are required to have basic understanding of VM',999,999,NULL,NULL,'Ming','Zhao'),(112,'Test Case and Automation Management System','At Ultimate Software, the quality of our product is one of our highest priorities, and thus we invest heavily towards a strong testing foundation. Some of the biggest challenges in software testing are that of test case management and the proper linking of test automation to test cases. There are many different goals a software organization evaluates when deciding on a test case management solution. The proper solution must provide a centralized repository for all test cases leveraging Team Foundation Server, must allow us to store test cases in a hierarchical structure for clear organization, and must allow us to establish relationships between test cases, requirements, defects, and test automation. Furthermore, in order to reduce variance in test documentation patterns and standards, the ideal solution should enforce a documentation standard. The project team will be exposed to modern Web application development technologies such as ASP.NET MVC 5 and Web API, Team Foundation Server, SQL Server, AngularJS, J',999,999,NULL,NULL,'Tariq','King'),(113,'Web Dashboard for Addigy IT Management Softwa','With all the data that Addigy captures about each Mac computer, users want to see ever-growing dashboard data representation.  Building informative and intuitive dashboards for users to keep a pulse on their company is extremely important in any software products today.  Dashboards are currently displayed using Bootstrap and Bootswatch template objects.  While you will have access to many templates and existing dashboards, feel free to be creative in how you develop these new dashboards.  These Dashboards and reports have the potential to be highly advertised throughout the Addigy website and product-line.\n\nProject Objectives:  Create an extensible web based dashboard that displays core state of all mac machines managed by a particular customer/organization.  All core data is collected and stored in an online database and intended to show the current status of all systems.\n- Pie chart of type of assets: macbook, mac mini, mac server, etc\n- Pie chart of OS version: 10.8, 10.9, 10.10\n- Graphic of machines with ',999,999,NULL,NULL,'Jason','Dettbarn'),(114,'Big Data Mining and Correlation for Addigy IT','Big Data is often misused in the industry, and while Addigy collects tremendous system data that can also be easily extended with new auditing facts, we are not processing petabytes of data.  Like most companies, modeling and correlating data starts with more modest infrastructure (no hadoop required).  Addigy leverages Logstash to ElasticSearch to quickly model data with Kibana.  You will be able to correlate and build business intelligence at a very fast pace, and develop an extremely useful skill set valuable to any company.  Novel unique data correlation has the potential to be highly advertised throughout the Addigy website and product-line.\n\nProject Objectives:  The key objective is harvesting various system log files, to correlate very interesting sets of data for alerting & reporting.  The first objective is being able to report on historic Addigy Policy Updates applied to the machine.  Logs currently show elements of the machine that are out specification, and what changes were made on the machines. ',999,999,NULL,NULL,'Jason','Dettbarn'),(115,'Pinecrest People Mover Web and Mobile Tracker','The Pinecrest People Mover is a free transit bus service operated by the Village of Pinecrest connecting our neighborhoods and schools.  It is mostly used by middle and high school students who do not qualify for bus service from the school district.  We would like to design a Web tracker and a Mobile tracker to show residents routes, hours of operation, real-time trolley location (as a list and as an interactive map) and allow for automatic notifications for arrival at user’s favorite stops. The mobile tracker should work well on iPhone & android devices.',999,999,NULL,NULL,'Gabriela','Wilson'),(116,'Mobile and Web Platforms for Visualizing Wate','Data centers also not only energy hogs, but are also very \"thirsty\". A large data center may consume millions of gallons of cooling water each day; in addition, data centers also indirectly consume an enormous amount of water embedded in offsite electricity generation. As a result, water conservation is surfacing as a critical concern for data centers, amid the anticipation of surging water demand worldwide. Left unchecked, the growing water footprint of data centers can pose a severe threat to data center sustainability and may even handicap availability of services, especially for data centers in water-stressed areas. Existing mechanical solutions for conservation, such as using recycled/industry water and directly using outside cold air, are often costly and/or very limited by external factors such as locations, climate conditions, among others. As part of the integral efforts from both industry and academy to enable data center sustainability, this project uniquely integrates water footprint as an essenti',999,999,NULL,NULL,'Shaolei','Ren'),(117,'Power Management in Multi-Tenant Data Centers','Power-hungry data centers have been massively expanding in both number and scale, placing an increasing emphasis on optimizing data center power management. While the progress in data center energy efficiency is encouraging, the existing efforts have dominantly centered around owner-operated data centers (e.g., Microsoft). Another unique and integral segment of data center industry --- multi-tenant colocation data center, simply called “colocation”, which is the physical home to many Internet and cloud services --- has not been well investigated, which, if still left unchecked, would become a major hurdle for sustainable growth of the digital economy. In sharp contrast with owner-operated data centers where operators have full control over both computing resources and  facilities, colocation rents physical space to multiple tenants which individually control their own physical servers and power management, while the colocation operator is mainly responsible for facility support (e.g., providing reliable power',999,999,NULL,NULL,'Shaolei','Ren'),(118,'Virtual Colonoscopy System','Virtual colonoscopy system visualizes the digital colon surfaces and helps doctor check the interior structure and screen the cancerous polyp/abnormality. The main goal includes: 1) build the user-friendly interface using MFC or other GUI; 2) visualize exterior and interior surfaces of colon by 3D rendering (Computer Graphics) technique; 3) navigate the interior tunnel of the convoluted and folded colon along the central line; and 4) if time permits, build the interface for colon flattening and registration.  Colon data are provided. \n\nThis is an ongoing project; three undergraduates (2 senior, 1 junior) have been working on that from this summer. We hope to continue that as their senior project (for the 2 senior students). Other students who are interested can join the team. The output system would offer a great demo for visitors/students to understand the power of graphics/geometry in solving real problems in medical imaging.  \n\nProject Team Member: \nMaylem Gonzalez (senior), mgonz108@fiu.edu\nFrancisco Marc',999,999,NULL,NULL,'Wei','Zeng'),(119,'Geometric Search Engine','3D geometric data are ubiquitous today. Efficient processing and organizing these massive data is required. The main goal of this project includes: 1) build the geometric database; 2) build the management system; 3) view the 3D objects on webpage using 3D Computer Graphics and WebGL techniques. Server and 3D databases (e.g., human facial expressions, brains) are provided.\n\nProject Team Member: \nCarlos Morales (junior, will be involved), cmora062@fiu.edu',999,999,NULL,NULL,'Wei','Zeng'),(120,'OWASP Encoders in C','The OWASP Java Encoder Project helps people make safer web-based\napplications. It is only fully supported in Java. This project is to\nport the code to a C library so that it can be included in frameworks\nlike mod_perl, PHP, or ESI. A stellar project would not only create\nthe library, but also submit a patch to include it in one or more of\nthose frameworks.\n\nSee Also:\nhttps://www.owasp.org/index.php/OWASP_Java_Encoder_Project\nhttp://www.esi.org\nhttp://docs.oracle.com/cd/E17904_01/web.1111/e10143/esi.htm\n\n\nThis project could be completed by one to three students, depending on\nhow much they aim to achieve.\nI don\'t have a good grasp of what would be too much to ask of one of\nthese projects. The \"short\" version is just porting the library then\ncalling it using JNI. A more advanced project would be built as\nfollows:\n\nOne person could port the library from Java to C while the two others\nbuild foreign-function interface wrappers for python and php.\nThen the three could work to build simple web-apps in python and PHP\n',999,999,NULL,NULL,'Eric','Kobrin'),(121,'Assigning Content for Translation','We are a local translations company based in Coral Gables that is looking to give our clients a more convenient way of assigning content to us for translation. Currently, many of our clients manually export content from their CMS, usually in an XML format, and email it to us. We want to automate this process by exploring the possibility of developing a plugin to work with their CMS whereby they can assign files directly to us from within the application.\n\nWe are seeking a possible collaboration with your institution in developing this plugin. Our thinking is that this would be a great opportunity for a class project or beneficial to a student needing a real-life project to complete their thesis, etc. We would, on the other hand, benefit by getting our plugin developed.\n\n',999,5,NULL,NULL,'Jaime','Zuniga'),(122,'Open Source Intelligence Inference Engine','The students will build a web application providing a repository for\nstoring and searching OSINT data as well as internal cyberattack data\nusing semantic web techniques. The backing store should be one of the\nexisting semantic web triple- or quad-stores such as Mulgara or Jena\nand should be queryable directly using Sparql or Datalog. The\nstructure and interface should provide for storing\nintelligence-critical metadata such as assertion provenance and\nconfidence of assertions.\n\nSee Also:\nhttp://en.wikipedia.org/wiki/Open-source_intelligence\nhttp://www.mulgara.org/\nhttp://en.wikipedia.org/wiki/Jena_(framework)\nhttp://en.wikipedia.org/wiki/SPARQL\nhttp://en.wikipedia.org/wiki/Datalog\nhttp://en.wikipedia.org/wiki/Resource_Description_Framework',999,999,NULL,NULL,'Eric','Kobrin'),(123,'Redesign of Intimo\'s Merchant Website on New ','We currently have our Merchant web site with Yahoo Merchant Services. The platform we currently use is outdated and Yahoo has released a new platform. We would like to merge to the new platform and redesign our website.\n\nskills such as Dust; Nodes; Pearl.\n\nAgain, this is a new platform for Yahoo stores and eventually all customer will switch to it and Yahoo is allowing us to transfer our page to “partner up” with me on this project with your students. My Yahoo rep Maria Melo is very excited to learn more about the opportunities she can give to the students and definitely be a partner on this project.\n \nI will need a programmer, a designer and a data management “expert”\n \nProgrammer must be proficient in Dust.js; Nodes.js; SQL.\n \nDesigner must be proficient on UI to create the flow, web designer creating the layout, usability for the pages, etc\n \nData Management will need to set up items, set up navigation, database, etc.\n \nEssentially we have our web page www.intimo.com and we will create a brand new store on',999,999,NULL,NULL,'Sonia','Centeno'),(124,'Virtual Queue','The application is for theme parks and other businesses that have multiple rides or events for which patrons typically wait in line.  The idea is that both the theme park and the patron would benefit by the patrons walking around the park (and maybe spending money) rather than standing in line.  This application will keep static data such as ride time, capacity, etc., as well as dynamic data regarding the patrons and queues, and allow patrons to virtually queue for a ride via a mobile app.  The patron will be notified as their time approaches.  Geo-location will also be used to insure that patrons are in the park, and tell them how to get to the ride.\n\nProject Proposer Name: ... Bernard Parenteau\n\nProject Proposer Affiliation: ... Florida Logic www.floridalogic.com\n\nProject Proposer Position: ... Managing Partner\n?\nExpanded Project Description: \nThe project consists of a mobile app, scanner, maintenance site, and a server component.   The patron would download the mobile app in advance or at time of entry.  B',999,999,NULL,NULL,'Bernard','Parenteau'),(125,'Aggregate and create a charity Information “B','Aggregate and create a charity Information “Big Data” mart & create a transparency scoring algorithm. Use the power of technology to showcase and highlight honest and transparent charities.\n\nSeek out and identify multiple sources of charity information that is accessible and retrievable utilizing APIs or web-based content retrieval\nWrite processes to retrieve identified data at periodic intervals\nCreate a centralized system of record for storing and marking up data \nWrite algorithm(s) to process data; create scoring mechanisms and analytical models based on data\nPublish results and other metadata through a privately accessible API\n',999,5,NULL,NULL,'Andy','Hill'),(126,'Displaying social photos to a social wall/fee','Pull photos from a Facebook album, RSS feed and or Twitter hashtag and display them in a grid on a webpage.   This is a ‘social wall’ that can be projected onto a wall, shown on a monitor at an event, etc.  Incorporating Google Analytics and Facebook Insights and digesting that data could be another piece of the project.',999,999,NULL,NULL,'Cortney','Mills'),(128,'University Catalog Management System - Versio','This project has already been started. The current system has the database structure \nset and the user interface created for a normal user to view existing catalog information\nand an adviser to create/modify catalog information.\n\nThe project is a web-based application written in PHP using the Yii Model-View-Controller\nframework. The database is mysql. Students selecting this project will need to know PHP\nand mysql. With these skills, they should be able to learn the Yii framework quickly.\n\nThree roles exist in this project: user, adviser and administrator. The user view is almost\ncomplete. The adviser role needs  improvements. The administrator role needs major work. \nSome of the functions of the admin may require modifications to the existing database \nstructure.\n\nAdditional features to implement include creating a web service for accessing the catalog \ninformation, generating a graphical flow chart from a list of courses, creating versions\nof a catalog in alternate formats (eg, XML) for use in other program',999,999,NULL,NULL,'Tim','Downey'),(129,'Rote Practice Educational System','This is a new project. I have a simple example running that uses JSPs and Servlets, but\nthe students would be free to choose another web framework, as long as it is based\non MVC. The basic idea of the system is to allow for rote drills of material. The existing\nexample allows the user to unscramble the lines of code from a program file. Additional\ntasks need to be developed, such as matching terms to definitions and placing items \ninto categories.\n\nI envision three roles: user, faculty, admin. The exercises will be organized by class and\nfaculty. \n\nUser role: Run authorized examples and to import files of their own into existing types of \ntasks. Access statistics of how many tasks have been completed and how many times\neach task has been done.\n\nFaculty role: Create tasks, specifying how many times it must be completed before the\ntask is considered finished. Only students from a class will have access to the exercise,\nunless permission is granted by the faculty to other classes/students or made public. \nRetrie',999,999,NULL,NULL,'Tim','Downey'),(130,'Using Shipping Data to Aid in Fraud Detection','Internet fraudsters often use the shipment carrier as a means to camouflage their illicit activities. For example, a fraudster may claim a package never arrived, or the package arrived in a damaged state.\n \nIt is possible using a combination of shipping data and heuristic algorithms to complement existing fraud detection methods to increase the percentage of fraudulent activities detected.\n\nThis project would use shipping data to attempt to detect potential fraudulent activities by applying heuristic algorithms to the shipping data to highlight activities that fall out of the normal range of behavior, thus providing an additional data point to the overall fraud detection process.\n\nKen Smith\nken@71lbs.com',999,999,NULL,NULL,'Jose','Li'),(131,'MyExperiment: A Web-based Model Repository fo','The goal of the MyExperiment project is to develop a web-based solution that allows network researchers and experimenters to create, view, modify and manage network models (including network topologies, network traffic, and network configurations), which they use to conduct simulation and emulation experiments for validating design and evaluating performance. The target system will offer an  \"online store\" for users to create various models using existing model generators, as well as configure, inspect and visualize them. The created models can be saved in the online repository for private or public use. MyExperiment will become a common platform for network researchers to store, share and reuse models for network experimentation.\n\nStudents should have basic knowledge of computer network, and should have experience with web service design and development (such as HTML5, CSS, Javascript, PHP, JSP, ASP, MySQL/Postgres, etc.)\n',999,999,NULL,NULL,'Jason','Liu'),(132,'Smart Systems for Occupancy and Building Ener','The objective of this project is to develop a smart system for tracking and modeling occupancy behaviors in building energy analysis. Using robust sensor networks and computational algorithms, a smart system will be developed to capture, analyze, and predict occupancy behaviors and provide real-time feedback to occupants to eliminate energy waste. In this project students will build the sensor network and develop the algorithms and will test the system using experimentations in one of the campus buildings.\n\nProject objective and scope: The objective of this project is to develop a smart system for tracking and modeling occupancy behaviors in building energy analysis. The system will include two components. The first component include a non-invasive sensor network to capture the movements of building occupants and their behaviors as well as the information related to the lighting, indoor temperature, and the plug-loads. By utilizing small modules using Infrared sensors equipped with wireless networking technol',999,999,NULL,NULL,'Leonardo','Bobadilla'),(133,'(IBM) Track and keep score of and compute a g','Announcement \n\n\nDid you know... Recycling a four-foot stack of newspapers saves the equivalent of one 40-foot fir tree? \n\n\nDid you know.... Every glass bottle recycled saves enough energy to light a 100-watt light bulb for 4 hours? \n\n\nDid you know....Americans throw away enough aluminum to rebuild the entire commercial airline fleet every three months?\n\n\nWhat if just one individual did their part and saved a tree, conserved a little electricity or helped recycle materials?\n\n\nWhat if a small group of individuals banded together and tracked their collective progress?\n\n\nWhat if one of world\'s leading technology companies combined forces with a group of gifted computer science students from Florida International University to make a difference?\n\n\nThis is your chance to enable one of the world\'s leading companies to build a platform that will incent and measure their sustainability efforts and behaviors. \n\n\nWe\'re looking for a team of environmentally conscious computer science engineers to build a system that will',999,999,NULL,NULL,'Juan','Caraballo'),(134,'Binding the Java platform with the GlusterFS ','This project, glusterfs-java-filesystem, is an implementation of a Java 7 NIO.2 Filesystem Provider backed by GlusterFS through a JNI binding to the C library libgfapi.  It is used as a plug-in library in Java software to allow direct connection to GlusterFS storage volumes.\n\nhttps://github.com/semiosis/glusterfs-java-filesystem\n\nJava 7 introduced the Filesystem Provider API which allows developers to add support to the Java platform for new filesystems.  This allows a loose coupling between application and filesystem code.  The application is programmed against the NIO.2 API, so it does not depend on any particular filesystem implementation.  Then a provider library can be dropped in to the JVM and the application gets access to the new type of filesystem automatically.\n\nThis is a challenging project most suitable for adept & motivated students.  I could manage up to three students.\n\nStudents should be fluent in Java and comfortable working on Linux.  Ideally students will have worked previously on a Java pr',999,999,NULL,NULL,'Louis','Zuckerman'),(136,'iOS/Android Game','This project will consist of making a game for mobile platforms for a Software Dev company that I\'m starting.  It will be a tile board game dealing with adding numbers. The game will have a 2-player mode, with the option to play with an AI. The game will also have a timed single-player mode. It will be built using the cocos2d/cocos2d-x Framework. \n\nI will be handling the iOS side of the game, and also the front-end design, as well as other features that come up. I need a developer that handles the Android side (Java) and a developer that handles the multiplayer backend logic. As mentioned, creating the AI is also part of the project. There is also work to be done to create the leaderboards and achievements. \n\nWhen the game is finished, it will published in the App Store/Google Play store. \n\nContact me if you want to learn more about the game. ',999,999,NULL,NULL,'Wei','Zeng'),(137,'Liveness Detection in Video (Kairos Facial Re','We need the ability to make sure the face in front of the camera is a real person and not a photo or a video of a person for fraud and security reasons. We need this ability primarily for iOS cameras (iPhone, iPad, iPod Touch) and streaming video from security cameras (iOS is more important) We would love for you to use our API located at https://developer.kairos.com for our work. Try to fool it, and then figure out how to keep it safe. \n\nHere is a list of all of our capabilities, we can make any of these capabilities available to the team:\n\nhttp://www.kairos.com/technology/\n\nThere can be multiple ways to solve this problem. We look forward to many many ideas. Kairos will be providing a prize at the successful completion of this project. \n\n',999,999,NULL,NULL,'Brian','Brackeen');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_meeting`
--

DROP TABLE IF EXISTS `project_meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_meeting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_mentor_user_id` int(11) unsigned NOT NULL,
  `mentee_user_id` int(11) unsigned NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_meeting_project_mentor1_idx` (`project_mentor_user_id`),
  KEY `fk_project_meeting_mentee1_idx` (`mentee_user_id`),
  CONSTRAINT `fk_project_meeting_mentee1` FOREIGN KEY (`mentee_user_id`) REFERENCES `mentee` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_meeting_project_mentor1` FOREIGN KEY (`project_mentor_user_id`) REFERENCES `project_mentor` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_meeting`
--

LOCK TABLES `project_meeting` WRITE;
/*!40000 ALTER TABLE `project_meeting` DISABLE KEYS */;
INSERT INTO `project_meeting` VALUES (1,17,21,'2014-11-01','06:00:00'),(2,18,10,'2014-11-03','09:00:00'),(3,1000,1005,'2015-01-31','01:00:00');
/*!40000 ALTER TABLE `project_meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_mentor`
--

DROP TABLE IF EXISTS `project_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_mentor` (
  `user_id` int(11) unsigned NOT NULL,
  `max_hours` int(11) DEFAULT NULL,
  `max_projects` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_project_mentor_user1_idx` (`user_id`),
  CONSTRAINT `fk_project_mentor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_mentor`
--

LOCK TABLES `project_mentor` WRITE;
/*!40000 ALTER TABLE `project_mentor` DISABLE KEYS */;
INSERT INTO `project_mentor` VALUES (5,0,1),(6,20,2),(7,NULL,NULL),(10,0,0),(16,24,1),(17,10,1),(18,0,0),(999,NULL,NULL),(1000,2,1),(1012,NULL,NULL),(1016,0,0);
/*!40000 ALTER TABLE `project_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_mentor_projects`
--

DROP TABLE IF EXISTS `project_mentor_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_mentor_projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `project_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`project_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `project_mentor_projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `project_mentor_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Maps project mentors to projects';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_mentor_projects`
--

LOCK TABLES `project_mentor_projects` WRITE;
/*!40000 ALTER TABLE `project_mentor_projects` DISABLE KEYS */;
INSERT INTO `project_mentor_projects` VALUES (2,6,2),(3,6,3),(1,1012,1);
/*!40000 ALTER TABLE `project_mentor_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `report_mentee`
--

DROP TABLE IF EXISTS `report_mentee`;
/*!50001 DROP VIEW IF EXISTS `report_mentee`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `report_mentee` (
  `UserID` tinyint NOT NULL,
  `UserName` tinyint NOT NULL,
  `Email` tinyint NOT NULL,
  `Name` tinyint NOT NULL,
  `Disabled` tinyint NOT NULL,
  `UniversityID` tinyint NOT NULL,
  `UniversityName` tinyint NOT NULL,
  `PersonalMentorID` tinyint NOT NULL,
  `PersonalMentorEmail` tinyint NOT NULL,
  `PersonalMentorName` tinyint NOT NULL,
  `PersonalMentorDisabled` tinyint NOT NULL,
  `menteeProjectID` tinyint NOT NULL,
  `menteeProjectTitle` tinyint NOT NULL,
  `menteeProjectStartDate` tinyint NOT NULL,
  `menteeProjectDueDate` tinyint NOT NULL,
  `menteeProjectCustomerName` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `report_mentor`
--

DROP TABLE IF EXISTS `report_mentor`;
/*!50001 DROP VIEW IF EXISTS `report_mentor`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `report_mentor` (
  `userID` tinyint NOT NULL,
  `userName` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `disabled` tinyint NOT NULL,
  `isProjectMentor` tinyint NOT NULL,
  `isPersonalMentor` tinyint NOT NULL,
  `isDomainMentor` tinyint NOT NULL,
  `isJudge` tinyint NOT NULL,
  `isNew` tinyint NOT NULL,
  `isEmployer` tinyint NOT NULL,
  `employer` tinyint NOT NULL,
  `position` tinyint NOT NULL,
  `degree` tinyint NOT NULL,
  `fieldOfStudy` tinyint NOT NULL,
  `gradYear` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `report_ticket`
--

DROP TABLE IF EXISTS `report_ticket`;
/*!50001 DROP VIEW IF EXISTS `report_ticket`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `report_ticket` (
  `ticketID` tinyint NOT NULL,
  `creatorID` tinyint NOT NULL,
  `creatorName` tinyint NOT NULL,
  `creatorDisabled` tinyint NOT NULL,
  `creatorEmail` tinyint NOT NULL,
  `ticketStatus` tinyint NOT NULL,
  `ticketCreatedDate` tinyint NOT NULL,
  `ticketSubject` tinyint NOT NULL,
  `ticketDescription` tinyint NOT NULL,
  `ticketAssignUserID` tinyint NOT NULL,
  `assignedUserName` tinyint NOT NULL,
  `assignedUserDisabled` tinyint NOT NULL,
  `assignedUserEmail` tinyint NOT NULL,
  `ticketDomainID` tinyint NOT NULL,
  `ticketDomainName` tinyint NOT NULL,
  `ticketSubDomainID` tinyint NOT NULL,
  `ticketSubDomainName` tinyint NOT NULL,
  `ticketPriorityID` tinyint NOT NULL,
  `ticketPriorityDescription` tinyint NOT NULL,
  `ticketAssignedDate` tinyint NOT NULL,
  `ticketClosedDate` tinyint NOT NULL,
  `ticketIsEscalated` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `subdomain`
--

DROP TABLE IF EXISTS `subdomain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subdomain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `validator` int(11) DEFAULT '5' COMMENT 'Integer that validates the domain Tier Level.',
  `domain_id` int(11) unsigned NOT NULL,
  `need` varchar(7) NOT NULL DEFAULT 'Medium' COMMENT 'Need',
  `need_amount` int(3) NOT NULL DEFAULT '5' COMMENT 'members needed',
  PRIMARY KEY (`id`),
  KEY `fk_subdomain_domain1_idx` (`domain_id`),
  CONSTRAINT `fk_subdomain_domain1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subdomain`
--

LOCK TABLES `subdomain` WRITE;
/*!40000 ALTER TABLE `subdomain` DISABLE KEYS */;
INSERT INTO `subdomain` VALUES (1,'Java','jjajajajajaja',7,8,'Medium',5),(2,'C++','ccccc',6,8,'Medium',5),(3,'Mitosis','mmmmm',4,9,'Medium',5),(5,'C#','C# topics',5,8,'Medium',5),(7,'Cell division','cell division',5,9,'Medium',5),(8,'C','c',6,8,'Medium',5);
/*!40000 ALTER TABLE `subdomain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `Mentor2` int(11) DEFAULT NULL,
  `assigned_project_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ticket_user2_idx` (`creator_user_id`),
  KEY `fk_ticket_user1_idx` (`assign_user_id`),
  KEY `fk_ticket_domain1_idx` (`domain_id`),
  KEY `fk_ticket_subdomain1_idx` (`subdomain_id`),
  KEY `priority_id` (`priority_id`),
  KEY `fk_assigned_project_id_idx` (`assigned_project_id`),
  CONSTRAINT `fk_assigned_project_id` FOREIGN KEY (`assigned_project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_domain1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_subdomain1` FOREIGN KEY (`subdomain_id`) REFERENCES `subdomain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_user1` FOREIGN KEY (`assign_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_user2` FOREIGN KEY (`creator_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `priority_id` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (41,21,'Pending','2014-07-17 10:48:57','Explain different way of using thread?','Explain different way of using thread?',19,8,1,'',1,'2014-07-24 11:08:51',NULL,NULL,7,NULL,NULL),(42,21,'Pending','2014-07-17 10:52:45','What is a constructor?','What is a constructor?',17,8,2,'',2,'2014-07-24 11:08:52',NULL,NULL,19,NULL,NULL),(43,21,'Close','2014-07-17 10:59:08','Errors.','What is run-time error?',19,8,2,'',2,'2014-07-17 10:59:08',NULL,NULL,NULL,NULL,NULL),(46,5,'Pending','2014-10-25 17:01:47','adsfa','sdf',1000,8,2,'',3,'2014-10-25 17:01:47',NULL,NULL,NULL,NULL,NULL),(47,21,'Close','2014-07-17 10:59:08','Errors.','What is run-time error?',21,8,2,'',2,'2014-07-17 10:59:08',NULL,NULL,NULL,NULL,NULL),(48,5,'Pending','2014-11-11 00:59:57','test','test123',1000,8,NULL,'',3,'2014-11-11 00:59:57',NULL,NULL,NULL,NULL,NULL),(49,5,'Pending','2014-11-14 01:13:32','ddd','ddd',1000,10,NULL,'',3,'2014-11-14 01:13:32',NULL,NULL,NULL,NULL,NULL),(50,5,'Pending','2015-01-21 18:56:18','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-01-21 18:56:18',NULL,1,NULL,NULL,NULL),(51,5,'Pending','2015-01-21 18:56:28','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-01-21 18:56:28',NULL,1,NULL,NULL,NULL),(52,5,'Pending','2015-01-21 19:13:28','dfd','dfdf',6,8,1,'',1,'2015-01-21 19:13:28',NULL,NULL,NULL,NULL,NULL),(53,5,'Pending','2015-01-21 19:19:48','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-01-21 19:19:48',NULL,1,NULL,NULL,NULL),(54,5,'Pending','2015-01-21 19:21:49','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-01-21 19:21:49',NULL,1,NULL,NULL,NULL),(55,5,'Pending','2015-01-24 15:21:33','adsfa','sdf',6,8,2,'',3,'2015-01-24 15:21:33',NULL,1,NULL,NULL,NULL),(56,5,'Pending','2015-01-24 15:21:46','adsfa','sdf',6,8,2,'',3,'2015-01-24 15:21:46',NULL,1,NULL,NULL,NULL),(57,5,'Pending','2015-01-24 15:21:47','adsfa','sdf',6,8,2,'',3,'2015-01-24 15:21:47',NULL,1,NULL,NULL,NULL),(58,5,'Pending','2015-01-26 22:56:08','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-01-26 22:56:08',NULL,1,NULL,NULL,NULL),(59,5,'Pending','2015-01-26 22:56:10','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-01-26 22:56:10',NULL,1,NULL,NULL,NULL),(60,10,'Close','2015-02-18 16:41:32','ticket 1','ticket 1',7,8,NULL,'',1,'2015-02-18 16:41:32','2015-02-24 22:32:33',NULL,NULL,NULL,NULL),(61,10,'Close','2015-02-24 20:50:41','Subject','Description',7,8,NULL,'',1,'2015-02-24 20:50:41','2015-02-24 22:37:19',NULL,NULL,NULL,NULL),(62,10,'Reject','2015-02-24 21:04:16','ticket 2','desc',7,8,1,'',1,'2015-02-24 21:04:16',NULL,NULL,NULL,NULL,NULL),(63,10,'Pending','2015-02-25 18:28:30','A ticket for reasigment','A ticket for reasigment',19,8,1,'',1,'2015-02-25 19:15:32',NULL,NULL,NULL,NULL,NULL),(64,5,'Pending','2015-02-25 20:42:09','A ticket for reasigment','A ticket for reasigment',5,8,1,'',1,'2015-02-25 20:42:09',NULL,1,NULL,NULL,NULL),(65,10,'Pending','2015-02-25 21:27:01','Ticket for escalation','Ticket for escalation',7,8,1,'',2,'2015-02-25 21:27:01',NULL,NULL,NULL,NULL,NULL),(66,5,'Pending','2015-02-25 21:29:02','Ticket for escalation','Ticket for escalation',5,8,1,'',2,'2015-02-25 21:29:02',NULL,1,NULL,NULL,NULL),(67,10,'Close','2015-02-27 23:27:36','sdfs','sdfsf',8,10,NULL,'',2,'2015-02-27 23:27:36','2015-03-01 11:36:42',NULL,NULL,NULL,NULL),(68,10,'Close','2015-02-27 23:56:36','sdf','sdf',7,8,NULL,'',3,'2015-02-27 23:56:36','2015-03-01 11:36:21',NULL,NULL,NULL,NULL),(70,10,'Pending','2015-03-17 22:48:44','ticket without project','desc',7,8,NULL,'',1,'2015-03-17 22:48:44',NULL,NULL,NULL,NULL,2),(72,10,'Pending','2015-03-17 22:49:55','sdfsdf','ticket without project 2',5,9,NULL,'',1,'2015-03-17 22:49:55',NULL,NULL,NULL,NULL,2),(74,10,'Pending','2015-03-17 22:54:17','ticket without project 4','ticket without project 4',7,8,NULL,'',2,'2015-03-17 22:54:17',NULL,NULL,NULL,NULL,NULL),(75,10,'Pending','2015-03-17 22:55:04','ticket without project 6','ticket with project 6',17,10,NULL,'',1,'2015-03-17 22:55:04',NULL,NULL,NULL,NULL,2),(76,5,'Pending','2015-04-01 21:02:35','A C++ ticket','a C++ ticket',19,8,2,'',1,'2015-04-01 21:02:35',NULL,NULL,NULL,NULL,NULL),(77,5,'Pending','2015-04-01 21:03:42','a c#ticket','a C# ticket',5,8,5,'',1,'2015-04-01 21:03:42',NULL,NULL,NULL,NULL,NULL),(78,6,'Pending','2015-04-01 21:05:45','another java ticket','another java ticket',7,8,1,'',2,'2015-04-01 21:05:45',NULL,NULL,NULL,NULL,NULL),(79,19,'Pending','2015-04-01 21:07:13','another c++ ticket','another c++ ticket',19,8,2,'',1,'2015-04-01 21:07:13',NULL,NULL,NULL,NULL,NULL),(80,6,'Pending','2015-04-02 21:11:25','java question','javaquestion',7,8,NULL,'',1,'2015-04-02 21:11:25',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_events`
--

DROP TABLE IF EXISTS `ticket_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type_id` int(11) NOT NULL,
  `ticket_id` int(10) unsigned NOT NULL,
  `event_recorded_date` datetime NOT NULL COMMENT 'date of the event recorded',
  `old_value` varchar(200) DEFAULT NULL,
  `new_value` varchar(200) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `event_performed_by_user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `ticket_event_fk_idx` (`event_type_id`),
  KEY `ticket_fk_idx` (`ticket_id`),
  KEY `ticket_event_type_idx` (`event_type_id`,`ticket_id`),
  KEY `performed_by_fk_idx` (`event_performed_by_user_id`),
  CONSTRAINT `event_fk` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `performed_by_fk` FOREIGN KEY (`event_performed_by_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ticket_fk` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1 COMMENT='This table records changes in the tickets such as when is created, when is assigned by user, the status changes, when is escalated, when is commented by owner, escalated, etc';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_events`
--

LOCK TABLES `ticket_events` WRITE;
/*!40000 ALTER TABLE `ticket_events` DISABLE KEYS */;
INSERT INTO `ticket_events` VALUES (32,1,61,'2015-02-01 20:51:10',NULL,NULL,NULL,10),(33,1,62,'2015-02-24 21:04:16',NULL,NULL,NULL,10),(34,4,61,'2015-02-24 21:49:56',NULL,'231',NULL,10),(35,4,61,'2015-02-24 22:01:43',NULL,'232',NULL,10),(36,4,61,'2015-02-24 22:02:43',NULL,'233',NULL,10),(37,2,60,'2015-02-24 22:32:34','Pending','Close',NULL,10),(38,2,61,'2015-02-24 22:37:50','Pending','Close',NULL,10),(39,2,62,'2015-02-24 22:41:07','Pending','Reject',NULL,10),(40,1,63,'2015-02-25 18:28:31',NULL,NULL,NULL,10),(41,3,63,'2015-02-25 19:15:35','7','19',NULL,5),(42,1,65,'2015-02-25 21:27:01',NULL,NULL,NULL,10),(43,6,65,'2015-02-25 21:29:24',NULL,'66',NULL,5),(44,1,66,'2015-02-25 21:29:55',NULL,NULL,NULL,5),(45,7,66,'2015-02-25 21:30:17','65',NULL,NULL,5),(46,4,65,'2015-02-26 19:17:47',NULL,'241',NULL,10),(47,4,65,'2015-02-26 19:17:58',NULL,'242',NULL,10),(48,4,65,'2015-02-26 19:18:19',NULL,'243',NULL,10),(49,4,65,'2015-02-26 19:19:06',NULL,'244',NULL,10),(53,8,65,'2015-02-26 20:44:37',NULL,NULL,NULL,10),(54,8,65,'2015-02-26 20:45:46',NULL,NULL,NULL,10),(55,8,65,'2015-02-26 20:45:53',NULL,NULL,NULL,10),(56,8,65,'2015-02-26 20:46:46',NULL,NULL,NULL,10),(57,8,65,'2015-02-26 20:46:53',NULL,NULL,NULL,10),(58,8,65,'2015-02-26 20:46:59',NULL,NULL,NULL,10),(59,8,65,'2015-02-26 20:47:40',NULL,NULL,NULL,10),(60,8,65,'2015-02-26 21:18:25',NULL,NULL,NULL,10),(61,8,65,'2015-02-27 22:55:45',NULL,NULL,NULL,10),(62,8,63,'2015-02-27 22:57:25',NULL,NULL,NULL,10),(63,9,63,'2015-02-27 22:58:57',NULL,NULL,NULL,19),(64,8,65,'2015-02-27 23:03:48',NULL,NULL,NULL,10),(65,1,67,'2015-02-27 23:27:37',NULL,NULL,NULL,10),(66,8,67,'2015-02-27 23:27:54',NULL,NULL,NULL,10),(67,1,68,'2015-02-27 23:56:36',NULL,NULL,NULL,10),(68,8,68,'2015-02-27 23:56:37',NULL,NULL,NULL,10),(69,2,68,'2015-03-01 11:36:08','Pending','Close',NULL,10),(70,2,68,'2015-03-01 11:36:22','Close','Close',NULL,10),(71,8,68,'2015-03-01 11:36:24',NULL,NULL,NULL,10),(72,8,67,'2015-03-01 11:36:36',NULL,NULL,NULL,10),(73,2,67,'2015-03-01 11:36:42','Pending','Close',NULL,10),(74,8,52,'2015-03-01 12:13:08',NULL,NULL,NULL,5),(75,8,52,'2015-03-01 12:13:13',NULL,NULL,NULL,5),(76,8,65,'2015-03-02 17:24:28',NULL,NULL,NULL,10),(77,8,65,'2015-03-02 17:24:45',NULL,NULL,NULL,10),(78,8,66,'2015-03-02 17:32:29',NULL,NULL,NULL,5),(79,8,66,'2015-03-02 17:39:30',NULL,NULL,NULL,5),(80,9,41,'2015-03-02 18:21:33',NULL,NULL,NULL,5),(81,8,66,'2015-03-02 18:21:40',NULL,NULL,NULL,5),(82,8,66,'2015-03-02 18:21:53',NULL,NULL,NULL,5),(83,9,62,'2015-03-02 18:28:56',NULL,NULL,NULL,7),(84,9,65,'2015-03-02 18:29:04',NULL,NULL,NULL,7),(85,8,63,'2015-03-15 13:49:01',NULL,NULL,NULL,10),(86,1,70,'2015-03-17 22:48:44',NULL,NULL,NULL,10),(87,8,70,'2015-03-17 22:48:53',NULL,NULL,NULL,10),(88,1,72,'2015-03-17 22:49:55',NULL,NULL,NULL,10),(89,8,72,'2015-03-17 22:49:56',NULL,NULL,NULL,10),(90,1,74,'2015-03-17 22:54:17',NULL,NULL,NULL,10),(91,8,74,'2015-03-17 22:54:19',NULL,NULL,NULL,10),(92,1,75,'2015-03-17 22:55:04',NULL,NULL,NULL,10),(93,8,75,'2015-03-17 22:55:06',NULL,NULL,NULL,10),(94,8,75,'2015-03-24 15:33:05',NULL,NULL,NULL,10),(95,8,62,'2015-03-24 15:33:13',NULL,NULL,NULL,10),(96,8,65,'2015-03-24 15:33:20',NULL,NULL,NULL,10),(97,8,72,'2015-03-24 15:33:32',NULL,NULL,NULL,10),(98,9,75,'2015-03-24 15:33:55',NULL,NULL,NULL,5),(99,5,75,'2015-03-24 15:34:07',NULL,'248',NULL,5),(100,5,75,'2015-03-24 15:34:41',NULL,'249',NULL,5),(101,5,75,'2015-03-24 15:34:41',NULL,'250',NULL,5),(102,9,75,'2015-03-24 15:34:42',NULL,NULL,NULL,5),(103,9,75,'2015-03-24 15:34:43',NULL,NULL,NULL,5),(104,9,75,'2015-03-24 15:34:44',NULL,NULL,NULL,5),(105,9,75,'2015-03-24 15:35:42',NULL,NULL,NULL,5),(106,9,75,'2015-03-24 15:38:44',NULL,NULL,NULL,5),(107,9,75,'2015-03-24 15:38:50',NULL,NULL,NULL,5),(108,9,75,'2015-03-24 15:39:28',NULL,NULL,NULL,5),(109,1,76,'2015-04-01 21:02:36',NULL,NULL,NULL,5),(110,8,76,'2015-04-01 21:03:12',NULL,NULL,NULL,5),(111,1,77,'2015-04-01 21:03:42',NULL,NULL,NULL,5),(112,8,77,'2015-04-01 21:03:44',NULL,NULL,NULL,5),(113,1,78,'2015-04-01 21:05:45',NULL,NULL,NULL,6),(114,8,78,'2015-04-01 21:05:47',NULL,NULL,NULL,6),(115,1,79,'2015-04-01 21:07:13',NULL,NULL,NULL,19),(116,8,79,'2015-04-01 21:07:15',NULL,NULL,NULL,19),(117,1,80,'2015-04-02 21:11:27',NULL,NULL,NULL,6),(118,8,80,'2015-04-02 21:11:45',NULL,NULL,NULL,6);
/*!40000 ALTER TABLE `ticket_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `university` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `university`
--

LOCK TABLES `university` WRITE;
/*!40000 ALTER TABLE `university` DISABLE KEYS */;
INSERT INTO `university` VALUES (1,'Florida International University'),(2,'University of Miami'),(3,'Florida State University'),(4,'Florida Atlantic University');
/*!40000 ALTER TABLE `university` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User ID ',
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
  `isNew` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1026 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'admin','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','aalfo077@fiu.edu','Masoud','','Sadj','/coplat/images/profileimages/avatarsmall.gif',1,'z2vtszc43g',0,'I am the admin and professor, this is a test 2',NULL,NULL,NULL,NULL,1,1,1,0,0,0,0,0,0),(6,'lsanc104','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','lsanc104@fiu.edu','Lorenzo','Alexis','Sanchez','/coplat/images/profileimages/avatarsmall.gif',1,'au5n3h1mqd',0,'now u can edit the bio',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(7,'hmuni006','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','hmuni006@fiu.edu','Henry','Daniel','Muniz','/coplat/images/profileimages/avatarsmall.gif',1,'kf049x8q3q',0,'test',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(8,'jsant001','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jsant001@fiu.edu','Jonathan','Raul','Santiago','/coplat/images/profileimages/avatarsmall.gif',1,'5yq43kqdqx',0,NULL,1,NULL,NULL,NULL,0,0,0,1,0,1,0,0,0),(9,'jquiroz001','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jquiroz001@fiu.edu','Javier','','Quiroz','/coplat/images/profileimages/avatarsmall.gif',1,'9ilo03t2dw',0,NULL,2,NULL,NULL,NULL,0,0,0,1,0,1,0,0,0),(10,'aalfo077','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','aalfo077@fiu.edu','Adrian','','Alfonso','/coplat/images/profileimages/avatarsmall.gif',1,'bnq2lehy8p',0,'test',3,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(11,'ctope001','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','ctope001@fiu.edu','Cynthia','','Tope','/coplat/images/profileimages/avatarsmall.gif',1,'fp7obcosno',1,NULL,4,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(16,'Henry_16','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','henrydaniel25@gmail.com','Henry','D','Muniz Romero','/coplat/images/profileimages/avatarsmall.gif',1,'vat4dkf1th',0,NULL,NULL,NULL,NULL,NULL,0,1,0,0,0,0,0,0,0),(17,'jlei','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jlei@email.com','Jiali','','Lei','/coplat/images/profileimages/avatarsmall.gif',1,'imltjmdka7',1,'This is a test for Jiali Lei',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(18,'ssana002','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','ssana002@fiu.edu','Steven','','Sanabria','/coplat/images/profileimages/avatarsmall.gif',1,'qdad4orb2l',0,'',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(19,'pedro','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','default@fiu.edu','Pedro','','Escandell','/coplat/images/profileimages/default_pic.jpg',1,'rh7xn3ulba',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,1,0,0,0,0,0),(20,'mentee','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','default@fiu.edu','mentee','','mentee','/coplat/images/profileimages/default_pic.jpg',0,'lnn70dg960',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(21,'rgome020','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','rgome020@fiu.edu','Ramon','','Gomez','/coplat/images/profileimages/default_pic.jpg',1,'fvv6v1cb1a',1,'Tell us something about yourself...',2,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(22,'SYSTEM','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','','Automatically','','Reassignment','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,NULL,NULL,NULL,NULL,1,0,0,0,0,0,0,0,0),(999,'DEFAULT','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','default@fiu.edu','--','','--','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(1000,'nmada002','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','nmada002@fiu.edu','Nicholas','','Madariaga','/coplat/images/profileimages/default_pic.jpg',1,'yu49ebtkae',1,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,1,0,0,0,0,0,0,0),(1002,'jphil075','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jphil075@fiu.edu','Justin','','Phillips','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,3,NULL,'0108602',NULL,0,0,0,0,0,1,0,0,0),(1003,'jmcga005','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jmcga005@fiu.edu','Jorge','','Mcgarry','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,4,NULL,'1054101',NULL,0,0,0,0,0,1,0,0,0),(1004,'rmart071','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','rmart071@fiu.edu','Ricardo','','Martinez','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,1,NULL,'1676926',NULL,0,0,0,0,0,1,0,0,0),(1005,'jsanc090','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jsanc090@fiu.edu','Jonathan','','Sanchez','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,'This is a description',2,NULL,'2051994',NULL,0,0,0,0,0,1,0,0,0),(1006,'mgonz108','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','mgonz108@fiu.edu','Maylem','','Gonzalez','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,3,NULL,'2134900',NULL,0,0,0,0,0,1,0,0,0),(1012,'sbruh','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','sburh002@fiu.edu','Steve','','Bruhl','/coplat/images/profileimages/default_pic.jpg',1,'b691sno7l2',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1013,'demo','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','demo@gmail.com','Demo','','Demo','/coplat/images/profileimages/default_pic.jpg',1,'yw48etlu0r',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1015,'fmsdlkfjsldkfj','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jj@gmail.com','kfjabk','akfnal','flskdfal','/coplat/images/profileimages/default_pic.jpg',1,'43rzlarccv',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1016,'demo2','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','demo2@gmail.com','demo2','demo2','demo2','/coplat/images/profileimages/default_pic.jpg',1,'1ml7q3suo4',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1017,'aramo011','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','aramo011@fiu.edu','Alexander','','Ramos',NULL,1,NULL,0,NULL,NULL,NULL,'1375096',NULL,0,0,0,0,0,1,0,0,0),(1018,'ameri012','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','ameri012@fiu.edu','Adam','','Merille',NULL,1,NULL,0,NULL,NULL,NULL,'1711951',NULL,0,0,0,0,0,1,0,0,0),(1019,'jrian002','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jrian002@fiu.edu','Juan','','Riano',NULL,1,NULL,0,NULL,NULL,NULL,'1894364',NULL,0,0,0,0,0,1,0,0,0),(1020,'msant080','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','msant080@fiu.edu','Matthew','','Santiago',NULL,1,NULL,0,NULL,NULL,NULL,'2403179',NULL,0,0,0,0,0,1,0,0,0),(1021,'cmcan003','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','cmcan003@fiu.edu','Cory','','Mcan',NULL,1,NULL,0,NULL,NULL,NULL,'2458355',NULL,0,0,0,0,0,1,0,0,0),(1022,'mmach059','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','mmach059@fiu.edu','Michael','','Machin',NULL,1,NULL,0,NULL,NULL,NULL,'2584643',NULL,0,0,0,0,0,1,0,0,0),(1023,'mjord008','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','mjord008@fiu.edu','Maikel','','Jordan',NULL,1,NULL,0,NULL,NULL,NULL,'2643936',NULL,0,0,0,0,0,1,0,0,0),(1025,'adrianlfns1','$2a$08$zLea2.yCFIa7ZDceXj6HZO5fO6WbS1vY64WTn5f50WOLR/3zRlpq6','adrianlfns@yahoo.com','Adrian','','Alfonso','/coplat/images/profileimages/default_pic.jpg',1,'2oyg9hn7zy',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_domain`
--

DROP TABLE IF EXISTS `user_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_domain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `domain_id` int(11) unsigned NOT NULL,
  `subdomain_id` int(11) unsigned DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `tier_team` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_domain_has_user_user1_idx` (`user_id`),
  KEY `fk_domain_has_user_domain1_idx` (`domain_id`),
  KEY `fk_user_domain_subdomain1_idx` (`subdomain_id`),
  CONSTRAINT `fk_domain_has_user_domain1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_domain_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_domain_subdomain1` FOREIGN KEY (`subdomain_id`) REFERENCES `subdomain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_domain`
--

LOCK TABLES `user_domain` WRITE;
/*!40000 ALTER TABLE `user_domain` DISABLE KEYS */;
INSERT INTO `user_domain` VALUES (2,7,8,1,8,1,1),(4,8,10,NULL,10,1,1),(5,19,8,1,10,1,1),(99,17,8,1,8,1,1),(100,19,8,2,9,1,1),(101,17,8,2,9,1,1),(102,1012,8,NULL,5,1,1),(103,1012,8,1,5,1,1),(104,1013,8,NULL,5,1,1),(105,1013,8,2,2,1,1),(106,1013,8,8,3,1,1),(107,1013,8,NULL,5,1,1),(117,6,8,NULL,NULL,1,NULL),(118,6,8,1,2,1,2),(119,6,8,2,1,1,2),(120,10,8,1,1,1,1),(121,10,8,NULL,3,1,1),(122,10,8,NULL,3,1,1),(123,5,8,NULL,6,1,1),(124,5,9,NULL,8,1,1);
/*!40000 ALTER TABLE `user_domain` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS Away_Mentor;
CREATE TABLE away_mentor
(
userID int(10)unsigned
);
--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `user_id` int(10) unsigned NOT NULL,
  `employer` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `job_start` int(4) unsigned DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `field_of_study` varchar(50) DEFAULT NULL,
  `university` varchar(60) DEFAULT NULL,
  `grad_year` int(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_info` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (1013,'Demo','Demo',2014,'Bachelors','Demo','Demo',2014),(1016,'FIU','Professor',0,'PhD','CS','FIU',1999),(1025,'Adship','1',0,'Currently Pursuing Degree','wrwer','FIU',2015);
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vc_invitation`
--

DROP TABLE IF EXISTS `vc_invitation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vc_invitation` (
  `videoconference_id` int(11) unsigned NOT NULL,
  `invitee_id` int(11) unsigned NOT NULL,
  `status` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`videoconference_id`,`invitee_id`),
  KEY `fk_VC_Invitations` (`invitee_id`),
  CONSTRAINT `fk_VC_Invitations` FOREIGN KEY (`invitee_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vc_invitation`
--

LOCK TABLES `vc_invitation` WRITE;
/*!40000 ALTER TABLE `vc_invitation` DISABLE KEYS */;
INSERT INTO `vc_invitation` VALUES (1,22,'Unknown'),(2,22,'Unknown');
/*!40000 ALTER TABLE `vc_invitation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_conference`
--

DROP TABLE IF EXISTS `video_conference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_conference` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `moderator_id` int(11) unsigned NOT NULL,
  `scheduled_on` datetime NOT NULL,
  `scheduled_for` datetime DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'scheduled',
  PRIMARY KEY (`id`),
  KEY `fk_Moderator` (`moderator_id`),
  CONSTRAINT `fk_Moderator` FOREIGN KEY (`moderator_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_conference`
--

LOCK TABLES `video_conference` WRITE;
/*!40000 ALTER TABLE `video_conference` DISABLE KEYS */;
INSERT INTO `video_conference` VALUES (1,'tst',5,'2015-04-24 21:56:47','2015-04-24 21:56:47','sfsdf','scheduled'),(2,'mySubject',5,'2015-04-24 21:57:29','2015-04-24 21:57:29','sfsdf','cancelled');
/*!40000 ALTER TABLE `video_conference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'coplat'
--

--
-- Dumping routines for database 'coplat'
--
/*!50003 DROP PROCEDURE IF EXISTS `deleteUserByUserName` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUserByUserName`(userName varchar(100))
BEGIN

declare user_id int ;

SET user_id = (select  user.id
from user 
where user.username = userName);

delete from project_mentor
where project_mentor.user_id= user_id;

delete from mentee
where mentee.user_id = user_id;

delete from user
where id = user_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `report_mentee`
--

/*!50001 DROP TABLE IF EXISTS `report_mentee`*/;
/*!50001 DROP VIEW IF EXISTS `report_mentee`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `report_mentee` AS select `user`.`id` AS `UserID`,`user`.`username` AS `UserName`,`user`.`email` AS `Email`,concat_ws(' ',`user`.`fname`,`user`.`mname`,`user`.`lname`) AS `Name`,`user`.`disable` AS `Disabled`,`user`.`university_id` AS `UniversityID`,`menteeuniversity`.`name` AS `UniversityName`,`personalmentoruser`.`id` AS `PersonalMentorID`,`personalmentoruser`.`email` AS `PersonalMentorEmail`,concat_ws(' ',`personalmentoruser`.`fname`,`personalmentoruser`.`mname`,`personalmentoruser`.`lname`) AS `PersonalMentorName`,`personalmentoruser`.`disable` AS `PersonalMentorDisabled`,`menteeuser`.`project_id` AS `menteeProjectID`,`menteeproject`.`title` AS `menteeProjectTitle`,`menteeproject`.`start_date` AS `menteeProjectStartDate`,`menteeproject`.`due_date` AS `menteeProjectDueDate`,concat_ws(' ',`menteeproject`.`customer_fname`,`menteeproject`.`customer_lname`) AS `menteeProjectCustomerName` from (((((`user` left join `mentee` `menteeuser` on((`user`.`id` = `menteeuser`.`user_id`))) left join `university` `menteeuniversity` on((`menteeuniversity`.`id` = `user`.`university_id`))) left join `personal_mentor` `personalmentor` on((`personalmentor`.`user_id` = `menteeuser`.`personal_mentor_user_id`))) left join `user` `personalmentoruser` on((`personalmentoruser`.`id` = `personalmentor`.`user_id`))) left join `project` `menteeproject` on((`menteeproject`.`id` = `menteeuser`.`project_id`))) where (`user`.`isMentee` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `report_mentor`
--

/*!50001 DROP TABLE IF EXISTS `report_mentor`*/;
/*!50001 DROP VIEW IF EXISTS `report_mentor`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `report_mentor` AS select `user`.`id` AS `userID`,`user`.`username` AS `userName`,`user`.`email` AS `email`,concat_ws(' ',`user`.`fname`,`user`.`mname`,`user`.`lname`) AS `name`,`user`.`disable` AS `disabled`,`user`.`isProMentor` AS `isProjectMentor`,`user`.`isPerMentor` AS `isPersonalMentor`,`user`.`isDomMentor` AS `isDomainMentor`,`user`.`isJudge` AS `isJudge`,`user`.`isNew` AS `isNew`,`user`.`isEmployer` AS `isEmployer`,`mentorinfo`.`employer` AS `employer`,`mentorinfo`.`position` AS `position`,`mentorinfo`.`degree` AS `degree`,`mentorinfo`.`field_of_study` AS `fieldOfStudy`,`mentorinfo`.`grad_year` AS `gradYear` from (`user` left join `user_info` `mentorinfo` on((`user`.`id` = `mentorinfo`.`user_id`))) where ((`user`.`isPerMentor` = 1) or (`user`.`isProMentor` = 1) or (`user`.`isDomMentor` = 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `report_ticket`
--

/*!50001 DROP TABLE IF EXISTS `report_ticket`*/;
/*!50001 DROP VIEW IF EXISTS `report_ticket`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `report_ticket` AS select `ticket`.`id` AS `ticketID`,`ticket`.`creator_user_id` AS `creatorID`,concat_ws(' ',`ticketowner`.`fname`,`ticketowner`.`mname`,`ticketowner`.`lname`) AS `creatorName`,`ticketowner`.`disable` AS `creatorDisabled`,`ticketowner`.`email` AS `creatorEmail`,`ticket`.`status` AS `ticketStatus`,`ticket`.`created_date` AS `ticketCreatedDate`,`ticket`.`subject` AS `ticketSubject`,`ticket`.`description` AS `ticketDescription`,`ticket`.`assign_user_id` AS `ticketAssignUserID`,concat_ws(' ',`userassigned`.`fname`,`userassigned`.`mname`,`userassigned`.`lname`) AS `assignedUserName`,`userassigned`.`disable` AS `assignedUserDisabled`,`userassigned`.`email` AS `assignedUserEmail`,`ticket`.`domain_id` AS `ticketDomainID`,`ticketdomain`.`name` AS `ticketDomainName`,`ticket`.`subdomain_id` AS `ticketSubDomainID`,`ticketsubdomain`.`name` AS `ticketSubDomainName`,`ticket`.`priority_id` AS `ticketPriorityID`,`ticketpriority`.`description` AS `ticketPriorityDescription`,`ticket`.`assigned_date` AS `ticketAssignedDate`,`ticket`.`closed_date` AS `ticketClosedDate`,ifnull(`ticket`.`isEscalated`,0) AS `ticketIsEscalated` from (((((`ticket` join `user` `ticketowner` on((`ticketowner`.`id` = `ticket`.`creator_user_id`))) join `domain` `ticketdomain` on((`ticketdomain`.`id` = `ticket`.`domain_id`))) join `priority` `ticketpriority` on((`ticketpriority`.`id` = `ticket`.`priority_id`))) left join `user` `userassigned` on((`userassigned`.`id` = `ticket`.`assign_user_id`))) left join `subdomain` `ticketsubdomain` on((`ticketsubdomain`.`id` = `ticket`.`subdomain_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-26 14:32:23
