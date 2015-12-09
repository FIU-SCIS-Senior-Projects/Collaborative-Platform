-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: coplat
-- ------------------------------------------------------
-- Server version	5.5.42

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_closed`
--

LOCK TABLES `application_closed` WRITE;
/*!40000 ALTER TABLE `application_closed` DISABLE KEYS */;
INSERT INTO `application_closed` VALUES (NULL,12,NULL,'2015-03-16 22:32:10',1,0),(NULL,NULL,28,'2015-03-16 22:35:11',2,0),(7,13,NULL,'2015-03-16 22:54:34',3,0),(8,NULL,NULL,'2015-03-16 23:19:37',4,10),(NULL,14,NULL,'2015-03-16 23:29:18',5,10),(9,15,29,'2015-04-10 13:38:42',6,5),(10,NULL,NULL,'2015-06-09 18:13:21',7,1026),(11,NULL,NULL,'2015-06-11 17:16:18',8,1022),(NULL,19,NULL,'2015-07-02 14:43:19',11,1033),(NULL,20,NULL,'2015-07-02 14:53:03',12,1033),(NULL,21,NULL,'2015-07-02 15:08:02',13,1033),(NULL,22,NULL,'2015-07-02 19:27:15',14,1033),(12,NULL,NULL,'2015-07-06 12:50:10',15,1038),(NULL,27,NULL,'2015-07-06 13:38:40',16,1040),(NULL,18,30,'2015-07-07 12:29:24',17,1032),(NULL,28,NULL,'2015-07-10 10:33:44',18,1040),(NULL,29,NULL,'2015-07-10 10:42:40',19,1039),(NULL,31,NULL,'2015-07-10 10:48:09',20,1040),(NULL,30,NULL,'2015-07-10 15:52:27',21,1039),(NULL,32,NULL,'2015-07-10 16:42:51',22,1039),(NULL,33,NULL,'2015-07-16 15:37:47',23,1039),(14,NULL,NULL,'2015-07-16 17:40:46',24,1040),(NULL,34,NULL,'2015-07-24 05:29:24',25,1022),(NULL,35,NULL,'2015-10-14 10:14:05',26,1052),(NULL,37,NULL,'2015-11-01 22:59:16',27,1052),(16,NULL,NULL,'2015-11-13 09:55:46',28,1052),(17,NULL,NULL,'2015-12-02 00:58:43',29,1089),(NULL,NULL,31,'2015-12-02 17:59:40',30,1029);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COMMENT='Application for Domain Mentor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_domain_mentor`
--

LOCK TABLES `application_domain_mentor` WRITE;
/*!40000 ALTER TABLE `application_domain_mentor` DISABLE KEYS */;
INSERT INTO `application_domain_mentor` VALUES (7,10,'Closed','2015-03-16 22:36:29',22,0),(8,10,'Closed','2015-03-16 23:19:12',3,0),(9,5,'Closed','2015-04-10 13:38:02',44,0),(10,1026,'Closed','2015-06-09 18:12:45',5,0),(11,1022,'Closed','2015-06-11 17:15:52',40,0),(12,1038,'Closed','2015-06-26 17:55:21',3,0),(13,1032,'Closed','2015-07-14 15:24:21',66,0),(14,1040,'Closed','2015-07-16 17:39:51',25,0),(15,5,'Admin','2015-10-14 09:37:01',10,0),(16,1052,'Closed','2015-11-13 09:54:24',0,0),(17,1089,'Closed','2015-12-02 00:57:51',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COMMENT='domain mentor picks for domain table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_domain_mentor_pick`
--

LOCK TABLES `application_domain_mentor_pick` WRITE;
/*!40000 ALTER TABLE `application_domain_mentor_pick` DISABLE KEYS */;
INSERT INTO `application_domain_mentor_pick` VALUES (8,7,8,1,'Rejected'),(9,7,9,1,'Rejected'),(10,8,8,3,'Approved'),(11,9,8,6,'Approved'),(12,9,9,8,'Approved'),(13,10,8,6,'Approved'),(14,11,8,10,'Approved'),(15,12,8,10,'Approved'),(16,12,10,10,'Approved'),(17,13,8,10,'Approved'),(18,14,10,10,'Approved'),(19,15,8,10,'Proposed by Mentor'),(20,16,8,3,'Approved'),(21,17,8,7,'Rejected');
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COMMENT='application for personal mentor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_personal_mentor`
--

LOCK TABLES `application_personal_mentor` WRITE;
/*!40000 ALTER TABLE `application_personal_mentor` DISABLE KEYS */;
INSERT INTO `application_personal_mentor` VALUES (12,10,'Closed','2015-03-16 22:30:55',0,0,6,NULL),(13,10,'Closed','2015-03-16 22:50:29',0,0,0,NULL),(14,10,'Closed','2015-03-16 23:28:51',0,0,0,NULL),(15,5,'Closed','2015-04-10 13:37:39',0,0,0,NULL),(16,1032,'Closed','2015-07-02 14:16:34',0,0,0,NULL),(17,1032,'Closed','2015-07-02 14:21:09',0,0,0,NULL),(18,1032,'Closed','2015-07-02 14:28:03',0,0,0,NULL),(19,1033,'Closed','2015-07-02 14:42:25',0,0,0,NULL),(20,1033,'Closed','2015-07-02 14:45:19',0,0,0,NULL),(21,1033,'Closed','2015-07-02 15:07:38',0,0,1,NULL),(22,1033,'Closed','2015-07-02 18:47:30',0,0,0,NULL),(23,5,'Admin','2015-07-02 19:25:52',0,0,30,NULL),(24,1033,'Admin','2015-07-06 12:44:56',0,0,0,NULL),(27,1040,'Closed','2015-07-06 13:38:14',0,0,0,NULL),(28,1040,'Closed','2015-07-10 10:33:09',0,0,0,NULL),(29,1039,'Closed','2015-07-10 10:41:56',0,0,0,NULL),(30,1039,'Closed','2015-07-10 10:43:50',0,0,0,NULL),(31,1040,'Closed','2015-07-10 10:47:45',0,0,0,NULL),(32,1039,'Closed','2015-07-10 16:42:30',0,0,0,NULL),(33,1039,'Closed','2015-07-16 15:37:03',0,0,0,NULL),(34,1022,'Closed','2015-07-24 05:25:25',0,0,0,NULL),(35,1052,'Closed','2015-10-14 10:12:32',0,0,3,1),(36,1030,'Admin','2015-11-01 22:56:52',0,0,10,1),(37,1052,'Closed','2015-11-01 22:58:50',0,0,0,NULL),(38,1029,'Admin','2015-12-02 18:01:43',0,0,0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1 COMMENT='picks for the personal mentor from the user table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_personal_mentor_pick`
--

LOCK TABLES `application_personal_mentor_pick` WRITE;
/*!40000 ALTER TABLE `application_personal_mentor_pick` DISABLE KEYS */;
INSERT INTO `application_personal_mentor_pick` VALUES (59,29,1022,'Approved'),(60,30,1023,'Rejected'),(61,31,1022,'Approved'),(62,32,1022,'Approved'),(63,33,1046,'Approved'),(64,34,1046,'Approved'),(65,35,10,'Approved'),(66,35,1017,'Approved'),(67,35,1021,'Approved'),(68,35,8,'Approved'),(69,35,1004,'Approved'),(70,35,9,'Approved'),(71,36,10,'Proposed by Mentor'),(72,36,8,'Proposed by System'),(73,36,1004,'Proposed by System'),(74,36,9,'Proposed by System'),(75,36,11,'Proposed by System'),(76,36,21,'Proposed by System'),(77,36,1002,'Proposed by System'),(78,36,1003,'Proposed by System'),(79,36,1005,'Proposed by System'),(80,36,1006,'Proposed by System'),(81,36,1017,'Proposed by System'),(82,36,1027,'Proposed by Admin'),(83,37,10,'Rejected'),(84,24,1023,'Proposed by Admin'),(85,36,1084,'Proposed by Admin'),(86,38,1052,'Proposed by Mentor');
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COMMENT='application for a project mentor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_project_mentor`
--

LOCK TABLES `application_project_mentor` WRITE;
/*!40000 ALTER TABLE `application_project_mentor` DISABLE KEYS */;
INSERT INTO `application_project_mentor` VALUES (28,10,'Closed','2015-03-16 22:33:52',0,0,0),(29,5,'Closed','2015-04-10 13:37:48',0,0,0),(30,1032,'Closed','2015-07-07 12:28:48',0,0,0),(31,1029,'Closed','2015-12-02 17:59:01',0,0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_project_mentor_pick`
--

LOCK TABLES `application_project_mentor_pick` WRITE;
/*!40000 ALTER TABLE `application_project_mentor_pick` DISABLE KEYS */;
INSERT INTO `application_project_mentor_pick` VALUES (45,28,133,'Rejected'),(46,28,125,'Approved'),(47,29,125,'Approved'),(48,29,121,'Approved'),(49,30,2,'Approved'),(50,31,112,'Approved');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='domain mentor picks for subdomain table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_subdomain_mentor_pick`
--

LOCK TABLES `application_subdomain_mentor_pick` WRITE;
/*!40000 ALTER TABLE `application_subdomain_mentor_pick` DISABLE KEYS */;
INSERT INTO `application_subdomain_mentor_pick` VALUES (5,7,1,1,'Approved'),(6,10,5,9,'Approved'),(7,11,5,10,'Approved'),(8,13,1,10,'Approved'),(9,14,9,10,'Approved');
/*!40000 ALTER TABLE `application_subdomain_mentor_pick` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `away_mentor`
--

DROP TABLE IF EXISTS `away_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `away_mentor` (
  `userID` int(10) unsigned NOT NULL DEFAULT '0',
  `tiStamp` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `away_mentor_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `away_mentor`
--

LOCK TABLES `away_mentor` WRITE;
/*!40000 ALTER TABLE `away_mentor` DISABLE KEYS */;
/*!40000 ALTER TABLE `away_mentor` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=297 DEFAULT CHARSET=utf8 COMMENT='				';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (174,'Run time Error - The errors encountered during execution of the program, due to unexpected input or output are called run-time error.','2014-07-17 11:00:14',43,'Pedro Escandell'),(177,'You should read Chapter 12 of your textbook.','2014-07-18 13:47:01',42,'Jiali Lei'),(179,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',41,'System'),(180,' This ticket was automatically reassigned by the system from mentor Pedro Escandell to mentor Jiali Lei','2014-07-24 11:08:52',42,'System'),(181,'Shits closed','2014-09-07 14:34:24',43,'Masoud Sadjadi'),(182,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',50,'System'),(183,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',41,'System'),(184,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',50,'System'),(185,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',51,'System'),(186,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',51,'System'),(188,'Ticket 41 was escalated to ticket 51','2015-01-21 18:56:28',41,'System'),(189,'Ticket 41 was escalated to ticket 51','2015-01-21 18:56:28',51,'System'),(190,'this is a comment','2015-01-21 19:14:16',52,'Lorenzo Sanchez'),(191,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',53,'System'),(192,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',53,'System'),(193,'Ticket 41 was escalated to ticket 51','2015-01-21 18:56:28',53,'System'),(194,'Ticket 41 was escalated to ticket 53','2015-01-21 19:19:49',41,'System'),(195,'Ticket 41 was escalated to ticket 53','2015-01-21 19:19:49',53,'System'),(196,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',54,'System'),(197,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',54,'System'),(198,'Ticket 41 was escalated to ticket 51','2015-01-21 18:56:28',54,'System'),(199,'Ticket 41 was escalated to ticket 53','2015-01-21 19:19:49',54,'System'),(203,'Ticket 41 was escalated to ticket 54','2015-01-21 19:21:50',41,'System'),(204,'Ticket 41 was escalated to ticket 54','2015-01-21 19:21:50',54,'System'),(205,'my comment','2015-01-21 19:25:27',52,'Lorenzo Sanchez'),(206,'Ticket 46 was escalated to ticket 55','2015-01-24 15:21:46',46,'System'),(207,'Ticket 46 was escalated to ticket 55','2015-01-24 15:21:46',55,'System'),(208,'Ticket 46 was escalated to ticket 55','2015-01-24 15:21:46',56,'System'),(209,'Ticket 46 was escalated to ticket 56','2015-01-24 15:21:46',46,'System'),(210,'Ticket 46 was escalated to ticket 56','2015-01-24 15:21:46',56,'System'),(211,'Ticket 46 was escalated to ticket 55','2015-01-24 15:21:46',57,'System'),(212,'Ticket 46 was escalated to ticket 56','2015-01-24 15:21:46',57,'System'),(214,'Ticket 46 was escalated to ticket 57','2015-01-24 15:21:48',46,'System'),(215,'Ticket 46 was escalated to ticket 57','2015-01-24 15:21:48',57,'System'),(216,'The answer to your question is ..........','2015-01-24 15:24:27',41,'Pedro Escandell'),(217,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',58,'System'),(218,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',58,'System'),(220,'Ticket 50 was escalated to ticket 58','2015-01-26 22:56:09',50,'System'),(221,'Ticket 50 was escalated to ticket 58','2015-01-26 22:56:10',58,'System'),(222,' This ticket was automatically reassigned by the system from mentor Henry Muniz to mentor Pedro Escandell','2014-07-24 11:08:51',59,'System'),(223,'Ticket 41 was escalated to ticket 50','2015-01-21 18:56:27',59,'System'),(224,'Ticket 50 was escalated to ticket 58','2015-01-26 22:56:09',59,'System'),(225,'Ticket 50 was escalated to ticket 59','2015-01-26 22:56:10',50,'System'),(226,'Ticket 50 was escalated to ticket 59','2015-01-26 22:56:10',59,'System'),(227,'ffg','2015-02-18 16:56:28',60,'Adrian Alfonso'),(228,'cvxdfs','2015-02-18 17:00:37',60,'Adrian Alfonso'),(231,'a new commented ticket','2015-02-24 21:49:50',61,'Adrian Alfonso'),(232,'interesting','2015-02-24 22:01:43',61,'Adrian Alfonso'),(233,'a new one','2015-02-24 22:02:43',61,'Adrian Alfonso'),(234,'','2015-02-24 22:35:42',60,'Adrian Alfonso'),(235,'a comment','2015-02-24 22:38:45',61,'Adrian Alfonso'),(236,'rejected comment','2015-02-24 22:41:50',62,'Adrian Alfonso'),(237,'Just a resigned comment','2015-02-25 19:16:48',63,'Masoud Sadj'),(238,'Just a resigned comment','2015-02-25 19:16:48',64,'Masoud Sadj'),(239,'Ticket 63 was escalated to ticket 64','2015-02-25 20:42:10',63,'System'),(240,'Ticket 63 was escalated to ticket 64','2015-02-25 20:42:10',64,'System'),(241,'a comment','2015-02-26 19:17:47',65,'Adrian Alfonso'),(242,'a comment','2015-02-26 19:17:58',65,'Adrian Alfonso'),(243,'another','2015-02-26 19:18:19',65,'Adrian Alfonso'),(244,'1 comment','2015-02-26 19:19:06',65,'Adrian Alfonso'),(245,'','2015-03-01 11:36:27',68,'Adrian Alfonso'),(246,'','2015-03-01 11:36:28',68,'Adrian Alfonso'),(247,'','2015-03-01 11:36:43',67,'Adrian Alfonso'),(248,'this is the answer','2015-03-24 15:34:06',75,'Masoud Sadj'),(249,'this is the answer','2015-03-24 15:34:41',75,'Masoud Sadj'),(250,'this is the answer','2015-03-24 15:34:41',75,'Masoud Sadj'),(251,'lets see what this registers\r\n','2015-06-12 00:22:24',96,'A test Mentor2'),(252,'fald;jfadf','2015-06-12 15:17:41',117,'A test Mentor2'),(253,'fald;jfadf','2015-06-12 15:17:42',117,'A test Mentor2'),(254,'fald;jfadf','2015-06-12 15:17:43',117,'A test Mentor2'),(255,'fald;jfadf','2015-06-12 15:17:44',117,'A test Mentor2'),(256,'fald;jfadf','2015-06-12 15:17:45',117,'A test Mentor2'),(257,'fald;jfadf','2015-06-12 15:17:47',117,'A test Mentor2'),(258,'fald;jfadf','2015-06-12 15:17:48',117,'A test Mentor2'),(259,'fald;jfadf','2015-06-12 15:17:49',117,'A test Mentor2'),(260,'fald;jfadf','2015-06-12 15:17:50',117,'A test Mentor2'),(261,'fald;jfadf','2015-06-12 15:17:51',117,'A test Mentor2'),(262,'fald;jfadf','2015-06-12 15:17:53',117,'A test Mentor2'),(263,'fald;jfadf','2015-06-12 15:17:54',117,'A test Mentor2'),(264,'fald;jfadf','2015-06-12 15:17:55',117,'A test Mentor2'),(265,'fald;jfadf','2015-06-12 15:17:56',117,'A test Mentor2'),(266,'do not reas','2015-06-16 17:58:11',131,'A test Mentor2'),(267,'do not reas','2015-06-16 17:58:29',130,'A test Mentor2'),(268,'','2015-06-18 18:49:44',144,'A test Mentor1'),(269,'I didn\'t like his work\r\n','2015-07-01 13:21:26',160,'Michael Machin'),(270,'I didnt like his work\r\n','2015-07-01 13:22:14',159,'Michael Machin'),(271,'Look here\r\n','2015-07-02 12:47:19',127,'Michael Machin'),(272,'New comment','2015-07-08 15:46:17',127,'A test Mentor1'),(273,'NEw comment\r\n','2015-07-08 15:54:13',127,'A test Mentor1'),(274,'Hey im working on this\r\n','2015-07-08 16:19:35',162,'A test Mentor1'),(275,'Hey look at that','2015-07-08 16:52:06',162,'Michael Machin'),(276,'A comment','2015-07-10 02:57:58',123,'Michael Machin'),(277,'Done here','2015-07-10 03:15:47',123,'Michael Machin'),(278,'Give me a new mentor','2015-07-10 16:46:58',169,'Michael Machin'),(279,'hey it looks like this','2015-07-13 13:44:54',170,'Testy PersonalM'),(280,'','2015-07-15 16:31:45',137,'Michael Machin'),(281,'','2015-07-24 16:21:46',87,'Michael Machin'),(282,'','2015-07-24 16:21:59',88,'Michael Machin'),(283,'','2015-07-24 16:22:11',124,'Michael Machin'),(284,'','2015-07-24 16:22:24',125,'Michael Machin'),(285,'','2015-07-24 16:22:45',126,'Michael Machin'),(286,'','2015-07-24 16:23:11',127,'Michael Machin'),(287,'this will disallow reassignment','2015-07-28 15:16:04',177,'A test Mentor2'),(288,'A comment','2015-07-28 17:34:36',176,'A test Mentor1'),(289,'stop reassigning\r\n','2015-07-31 11:32:27',183,'A test Mentor2'),(290,'Yes, you can.','2015-10-14 10:04:29',187,'Masoud Sadj'),(291,'Please answer his query.','2015-10-14 10:05:53',42,'Masoud Sadj'),(292,'','2015-10-29 22:55:09',188,'Masoud Sadj'),(293,'comment','2015-12-03 20:08:40',193,'user1 user'),(294,'comment\r\n','2015-12-03 20:09:26',193,'user1 user'),(295,'','2015-12-03 20:28:23',193,'Masoud Sadj'),(296,'','2015-12-03 20:28:58',193,'Masoud Sadj');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES (8,'Programming Lanaguage','All programming languages',5,'Medium',5),(9,'Biology','Is a natural science concerned with the study of life and living organisms, including their structure, function, growth, evolution, distribution, and taxonomy.[1] Modern biology is a vast and eclectic field, composed of many branches and subdisciplines. ',5,'Medium',5),(10,'Software Engineering','General questions about the software engineering cycle.',5,'Medium',5),(12,'UI Design','The study of UI design',5,'Medium',5),(14,'Electrical Engineering','The study of electrical engineering',5,'Medium',5);
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
INSERT INTO `domain_mentor` VALUES (5,44,1),(6,20,1),(7,20,1),(8,20,1),(10,22,1),(17,10,1),(19,20,1),(999,NULL,1),(1022,40,1),(1026,5,1),(1032,20,1),(1033,20,1),(1034,20,1),(1035,17,1),(1038,3,1),(1040,25,1),(1052,0,1),(1089,0,1);
/*!40000 ALTER TABLE `domain_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain_suggestion`
--

DROP TABLE IF EXISTS `domain_suggestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domain_suggestion` (
  `suggestion_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `status` varchar(10) DEFAULT 'Pending',
  `creator_user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`suggestion_id`),
  KEY `creator_idx` (`creator_user_id`),
  CONSTRAINT `creator_user` FOREIGN KEY (`creator_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain_suggestion`
--

LOCK TABLES `domain_suggestion` WRITE;
/*!40000 ALTER TABLE `domain_suggestion` DISABLE KEYS */;
INSERT INTO `domain_suggestion` VALUES (3,'MySql','SQL language','Accepted',1032),(4,'da;l','lkceaecaceace','Rejected',5),(5,'acedaef','aceeececaa','Rejected',5),(6,'PHP','the language php','Accepted',5),(7,'PHP','the language php','Accepted',5),(9,'F#','the f# language a predictive language','Accepted',5),(10,'UI Design','The study of UI design','Accepted',5),(11,'HTML','The html language. A really awesome thing!','Accepted',1022),(12,'Fortran','the language fortran','Accepted',1032),(13,'Evolution','biology','Accepted',1022),(15,'Javascript','The language of javascript','Accepted',1022),(16,'Electrical Engineering','The study of electrical engineering','Accepted',1022),(17,'Garbage','this is a garbage one to reject','Rejected',1022);
/*!40000 ALTER TABLE `domain_suggestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_listener`
--

DROP TABLE IF EXISTS `email_listener`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_listener` (
  `pid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_listener`
--

LOCK TABLES `email_listener` WRITE;
/*!40000 ALTER TABLE `email_listener` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_listener` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='Records events';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_type`
--

LOCK TABLES `event_type` WRITE;
/*!40000 ALTER TABLE `event_type` DISABLE KEYS */;
INSERT INTO `event_type` VALUES (3,'Assigned to user'),(5,'Commented by mentor'),(4,'Commented by owner'),(7,'Escalated from '),(6,'Escalated to '),(1,'New'),(9,'Opened by mentor '),(8,'Opened by owner '),(10,'Reassigned to new Mentor'),(2,'Status changed');
/*!40000 ALTER TABLE `event_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `subject` text,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (36,1052,'This is some feedback','Hello'),(37,1052,'create','feed'),(39,1052,'Giving test feed','Giving test feed'),(40,1029,'creating some','creating some'),(42,1030,'login page','improve usability'),(43,1052,'test','test test');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback_replies`
--

DROP TABLE IF EXISTS `feedback_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_replies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) unsigned NOT NULL,
  `reply` text,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_replies`
--

LOCK TABLES `feedback_replies` WRITE;
/*!40000 ALTER TABLE `feedback_replies` DISABLE KEYS */;
INSERT INTO `feedback_replies` VALUES (25,36,'this is a reply',5),(26,39,'Adding',1052),(27,39,'repliesss',5),(28,40,'adding some',1029),(29,41,'tea',1052),(30,42,'further info',1030),(31,42,'Ok, will work on this.',5),(32,36,'re',1052),(33,43,'reply',1052);
/*!40000 ALTER TABLE `feedback_replies` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitation`
--

LOCK TABLES `invitation` WRITE;
/*!40000 ALTER TABLE `invitation` DISABLE KEYS */;
INSERT INTO `invitation` VALUES (1,'test123@test.com',5,'2014-11-14 07:41:04',0,0,0,0,0,'Test 123',''),(2,'aalfo$4@fiu.edu',5,'2015-01-24 05:29:18',1,1,0,0,0,'Adrian','The Collaborative Platform system administrator, Masoud Sadjadi, through this email would like to invite you to participate on it as: <br/><b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/><b><u>Mentor</u></b><br/>&nbsp;&nbsp;<i>Domain Mentor: Provide solutions using his/her expertise in specific domains to questions within the platform.</i><br/>&nbsp;&nbsp;<i>Project Mentor: Guide the project development through the semester.</i><br/>&nbsp;&nbsp;<i>Personal Mentor: Provide assistance and guidance to his/her mentees.</i><br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(3,'adfs@tt.com',5,'2015-01-25 16:47:21',0,0,1,0,0,'dfsd','The Collaborative Platform system administrator, Masoud Sadjadi, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(4,'aalfo$4@fiu.edu',5,'2015-01-25 16:55:51',1,0,0,0,0,'sfsdf','The Collaborative Platform system administrator, Masoud Sadjadi, through this email would like to invite you to participate on it as: <br/><b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(5,'dfdf',5,'2015-02-18 03:49:03',1,0,0,1,0,'sdfds','The Collaborative Platform system administrator, Adrian Alfonso, through this email would like to invite you to participate on it as: <br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(6,'dfdf',5,'2015-02-18 02:40:00',0,0,1,0,0,'fdff','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(7,'sfsdf@tt.com',5,'2015-02-18 02:42:33',0,0,1,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(8,'aalfo$4@fiu.edu',5,'2015-02-18 03:01:58',1,0,0,0,0,'Adrian','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>System Administrator: Responsible, for users, invitations, projects, domains and sub-domains management.</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(9,'sfdsf',5,'2015-02-18 03:02:48',0,0,1,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(10,'sfdsd@tt.com',5,'2015-02-18 03:57:22',1,0,1,0,0,'sdfsdf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(11,'ff@tt.com',5,'2015-02-18 03:19:14',0,0,1,0,0,'sdfds','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(12,'333@tt.com',5,'2015-02-18 03:34:01',0,0,1,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(13,'333@tt.com',5,'2015-02-18 03:34:35',1,0,0,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(14,'333@tt.com',5,'2015-02-18 03:35:47',1,0,0,0,0,'sdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(15,'sfsdf@tt.com',5,'2015-02-18 03:37:02',0,0,1,0,0,'xvxfds','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(16,'sfsdf@tt.com',5,'2015-02-18 03:37:51',0,0,1,0,0,'xvxfds','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\ncddfdf<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(17,'sfds@ttte.com',5,'2015-02-18 03:45:50',1,0,0,0,0,'dfdf','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>System Administrator: Responsible, for users, invitations, projects, domains and sub-domains management.</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(19,'xcvcxv',5,'2015-02-18 04:03:29',0,0,1,0,0,'xcvxv','<p>dddddd</p>\r\n'),(20,'sfsf@fffcom',5,'2015-02-22 21:22:53',0,0,1,0,0,'sfd@fsdfdsf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(21,'sfsdf@tt.com',5,'2015-02-22 21:31:17',0,0,1,0,0,'ssdfsdf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(22,'sfsdf@dfsfdsfsdfsdf',5,'2015-02-22 21:32:12',0,0,1,0,0,'sfsdf','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(23,'sdfdsfdsfdf@dfsfsd.com',5,'2015-02-22 21:34:54',1,0,0,0,0,'sfdfdsf','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>System Administrator: Responsible, for users, invitations, projects, domains and sub-domains management.</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.</p>\r\n'),(24,'dfdsf',5,'2015-03-02 23:26:14',0,0,0,0,0,'dsfdf','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/></h2><br/><a href=\"http://localhost/coplat/index.php\">Click here</a> to access the platform.'),(25,'sdfsdf@tt.com',5,'2015-04-14 02:30:21',0,0,1,0,0,'sdfsdf@tt.com','The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as: <br/><b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/></h2><br/><a href=\"http://localhost/coplat/index.php/site/landing\">Click here</a> to access the platform.'),(29,'adrianlfns@yahoo.com',5,'2015-04-17 02:00:46',0,0,1,0,0,'Adrian Alfonso','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\n<br />\r\n<a href=\"http://localhost/coplat/index.php/site/landing/29\">Click here</a> to access the platform.</p>\r\n\r\n<p><canvas :netbeans_generated=\"true\" height=\"200\" id=\"netbeans_glasspane\" style=\"position: fixed; top: 0px; left: 0px; z-index: 50000; pointer-events: none;\" width=\"890\"></canvas></p>\r\n'),(30,'rdomi005@fiu.edu',5,'2015-12-03 20:36:06',0,0,1,0,0,'Ricky Dominguez','<p>The Collaborative Platform system administrator, Masoud Sadj, through this email would like to invite you to participate on it as:<br />\r\n<strong>Mentee: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</strong><br />\r\n<br />\r\n<a href=\"http://cp-dev.cis.fiu.edu/coplat/index.php/site/landing/30\">Click here</a> to access the platform.</p>\r\n');
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
INSERT INTO `mentee` VALUES (8,1052,NULL),(9,1052,NULL),(10,1052,2),(21,17,2),(1002,999,112),(1003,999,133),(1004,1052,115),(1005,999,108),(1006,999,134),(1017,1052,NULL),(1018,999,NULL),(1019,999,NULL),(1020,999,NULL),(1021,1052,110),(1022,1039,2),(1023,999,NULL),(1027,999,1),(1028,999,NULL),(1046,1022,NULL),(1052,1029,112),(1053,999,NULL),(1054,999,NULL),(1055,999,NULL),(1056,999,NULL),(1057,999,NULL),(1058,999,NULL),(1059,999,NULL),(1060,999,NULL),(1061,999,NULL),(1062,999,NULL),(1063,999,NULL),(1064,999,NULL),(1065,999,NULL),(1066,999,NULL),(1067,999,NULL),(1068,999,NULL),(1069,999,NULL),(1070,999,NULL),(1072,999,NULL),(1073,999,NULL),(1074,999,NULL),(1075,999,NULL),(1076,999,NULL),(1077,999,NULL),(1078,999,NULL),(1079,999,NULL),(1080,999,NULL),(1081,999,NULL),(1082,999,NULL),(1083,999,NULL),(1084,999,NULL),(1085,999,NULL),(1086,999,NULL),(1087,999,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'admin','admin','stest','test','2015-01-23 04:03:55',1,1,'/coplat/images/profileimages/avatarsmall.gif'),(2,'mlast004','mmach059','whats up','hey do you get this','2015-06-23 18:22:49',1,0,NULL),(3,'mmach059','mlast004','Nice\r\n\r\nOn 2015-06-23 18:22:49, Michael Machin wrote:\r\nwhats up','Re: hey do you get this','2015-06-23 18:26:31',1,0,'/coplat/images/profileimages/default_pic.jpg');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,0,6,'15:27:55',0,'You got a new message from admin','http://localhost/coplat/index.php/message',3),(2,0,6,'15:28:55',0,'You got a new message from admin','http://localhost/coplat/index.php/message',3),(3,0,6,'01:01:46',0,'You got a new message from hmuni006','http://localhost/coplat/index.php/message',3),(4,0,6,'01:20:10',0,'You got a new message from hmuni006','http://localhost/coplat/index.php/message',3),(5,0,7,'01:21:15',0,'You got a new message from lsanc104','http://localhost/coplat/index.php/message',3),(6,0,6,'01:21:43',0,'You got a new message from hmuni006','http://localhost/coplat/index.php/message',3),(7,0,5,'04:03:55',0,'You got a new message from admin','http://localhost/coplat/index.php/message',3),(8,0,1027,'18:22:49',0,'You got a new message from mmach059','http://cp-dev.cis.fiu.edu/coplat/index.php/message',3),(9,0,1022,'18:26:31',0,'You got a new message from mlast004','http://cp-dev.cis.fiu.edu/coplat/index.php/message',3);
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
INSERT INTO `personal_mentor` VALUES (5,'0','0'),(6,'12','0'),(7,'2','3'),(10,'0','0'),(17,'10','2'),(18,'',''),(999,NULL,NULL),(1013,'0','0'),(1022,'0','0'),(1029,'0','1'),(1032,'0','0'),(1033,'0','0'),(1039,'0','0'),(1040,'0','0'),(1052,'0','6');
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COMMENT='this table  matches mentees to their personal mentors';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_mentor_mentees`
--

LOCK TABLES `personal_mentor_mentees` WRITE;
/*!40000 ALTER TABLE `personal_mentor_mentees` DISABLE KEYS */;
INSERT INTO `personal_mentor_mentees` VALUES (1,1005,1012),(2,10,1013),(3,8,1013),(4,9,1013),(5,11,1013),(6,1018,10),(7,1018,10),(8,1018,5),(9,1017,5),(10,1022,1032),(11,1022,1032),(12,1022,1033),(13,1022,1033),(14,1022,1033),(15,8,1033),(16,1020,1033),(17,1027,1033),(18,10,1033),(19,1025,1033),(20,10,1033),(21,1025,1033),(22,1027,1022),(23,1020,1039),(24,1022,1040),(25,1022,1032),(26,1022,1040),(27,1022,1039),(28,1022,1040),(29,1022,1039),(30,1046,1039),(31,1046,1022),(32,10,1052),(33,1017,1052),(34,1021,1052),(35,8,1052),(36,1004,1052),(37,9,1052),(38,1052,1029);
/*!40000 ALTER TABLE `personal_mentor_mentees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `previous_mentors`
--

DROP TABLE IF EXISTS `previous_mentors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `previous_mentors` (
  `user_id` int(10) DEFAULT NULL,
  `ticket_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `previous_mentors`
--

LOCK TABLES `previous_mentors` WRITE;
/*!40000 ALTER TABLE `previous_mentors` DISABLE KEYS */;
INSERT INTO `previous_mentors` VALUES (19,41),(17,42),(19,43),(1000,46),(21,47),(1000,48),(1000,49),(5,50),(5,51),(6,52),(5,53),(5,54),(6,55),(6,56),(6,57),(5,58),(5,59),(7,60),(7,61),(7,62),(19,63),(5,64),(7,65),(5,66),(8,67),(7,68),(7,70),(5,72),(7,74),(19,76),(5,77),(7,78),(19,79),(7,80),(1033,81),(1032,82),(8,67),(5,72),(8,67),(5,72),(8,67),(5,72),(8,67),(5,72),(10,41),(1013,42),(10,50),(10,51),(10,52),(10,53),(10,54),(10,58),(10,59),(10,63),(10,64),(10,65),(10,66),(1033,70),(1033,74),(1013,76),(1033,77),(10,78),(1013,79),(1033,80),(1032,81),(1033,82),(1032,83),(1032,84),(1032,85),(1033,86),(1032,87),(1033,88),(1034,83),(1034,85),(1034,87),(7,41),(7,50),(7,51),(7,52),(7,53),(7,54),(7,58),(7,59),(7,63),(7,64),(19,70),(17,76),(17,79),(19,80),(1033,84),(1033,86),(1033,88),(1034,89),(1034,91),(1034,92),(1033,83),(1033,85),(1033,87),(1034,94),(1026,95),(19,42),(19,65),(7,66),(19,74),(19,78),(1026,84),(1034,86),(1026,88),(1032,94),(1033,95),(1034,98),(1033,99),(1034,100),(1026,101),(1032,102),(1033,94),(1034,95),(1026,98),(1033,100),(1034,101),(1026,102),(1034,99),(1033,98),(1026,100),(1033,101),(1034,102),(1026,99),(1013,48),(8,49),(1013,55),(1013,56),(1013,57),(1033,103),(1032,103),(1034,104),(1034,106),(7,107),(1013,107),(1022,112),(1022,106),(1022,111),(1022,113),(1022,114),(1022,115),(1033,96),(1013,46),(17,75),(10,107),(1022,96),(1022,116),(8,75),(1032,96),(1032,116),(1026,120),(1033,118),(1033,119),(1033,121),(1033,122);
/*!40000 ALTER TABLE `previous_mentors` ENABLE KEYS */;
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
INSERT INTO `priority` VALUES (1,'High',1),(2,'Medium',12),(3,'Low',72);
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
INSERT INTO `project` VALUES (1,'Collaborative Platform','Collaborative software or groupware is an application software designed to help people involved in a common task achieve goals. One of the earliest definitions of collaborative software is \'intentional group processes plus software to support them.\n',5,1012,'2014-01-06','2014-04-25','',''),(2,'Senior Project Website','This project builds on its previous version and addresses its issues and shortcomings. Here is all the resources from the second revision: \n\n',5,1032,'2014-01-06','2014-04-25','',''),(3,'project testing','project testing',5,6,NULL,NULL,'',''),(82,'Mobile Judge: Version 4','This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SU14/03-MobileJudgeV3.zip\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/4-MobileJudgeV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/7-MobileJudge/\n',999,1016,NULL,NULL,'Masoud','Sadjadi'),(83,'Senior Project Web Site: Version 5','This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\n... Ask your mentor to provide the link.\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/6-SeniorProjectWebSiteV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/4-SeniorProjectWebSite/\n',999,1052,NULL,NULL,'Masoud','Sadjadi'),(84,'Virtual Job Fair: Version 4','This project builds on its previous version and addresses its issues and shortcomings.\n\nHere is all the resources from the third revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SU14/04-VirtualJobFairV3.zip\n\nHere is all the resources from the second revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/FA13/7-VirtualJobFairV2/\n\nHere is all the resources from the first revision:\nhttp://users.cis.fiu.edu/~sadjadi/Teaching/SeniorProject/Deliverables/SP13/3-VirtualJobFair/\n',999,16,NULL,NULL,'Juan','Caraballo'),(108,'Collaborative Platform v2','This project',999,1000,NULL,NULL,'Juan','Caraballo'),(110,'History App','This app is a virtual history tour/walk through town.  Files (audio, documents and photos) are linked to a GPS coordinate, so that the user can listen to or read files pertaining to a specific location.  Eventually, it will provide a searchable database of location based historical resources.  \n1.   a front page, and then ability to use location services to pull up local stories, a map to pick a location and find stories, or a search box to find a specific location.  FIU has a project called Terrafly, which is (from my understanding) google maps with the ability to overlay historical maps, this sort of thing would be ideal. I want the user to be able to \"program\" a series of stories so they can make a \"virtual walking/driving tour\".  \n\n2.  Admin needs to be able to upload files of varying sizes and types.  I would like to have categories at some point, some that users can add to on their own, allowing the users to add to the historical database.  This could include their own audio files (from snippets to oral',999,999,NULL,NULL,'Tracy','Beeson'),(111,'Mission-critical Cloud Computing','This project will study how to deliver mission assurance to mission-critical applications in cloud computing systems. Students will develop a virtual machine based approach to run applications with good security and reliability in typical cloud computing systems.\n\nThis project build upon the previous senior project\'s results: 1) A VM management system that dynamically migrate VMs across hosts on a\nOpenStack-based cloud platform; 2) A P2P overlay network that interconnect the OpenStack VMs based on the IP-over-P2P (IPOP) framework.\n\nThis new senior project will focus on developing an extension to IPOP that allow the communications among the VMs to be routed by the overlay network in a OpenStack-based cloud system.\n\nStudents will learn state-of-the-art virtualization, cloud, and P2P technologies in this project, and get mentoring from researchers at FIU, UF, and Air Force. Students will also be exposed to career opportunities at the Department of Defense.\n\nStudents are required to have basic understanding of VM',999,999,NULL,NULL,'Ming','Zhao'),(112,'Test Case and Automation Management System','At Ultimate Software, the quality of our product is one of our highest priorities, and thus we invest heavily towards a strong testing foundation. Some of the biggest challenges in software testing are that of test case management and the proper linking of test automation to test cases. There are many different goals a software organization evaluates when deciding on a test case management solution. The proper solution must provide a centralized repository for all test cases leveraging Team Foundation Server, must allow us to store test cases in a hierarchical structure for clear organization, and must allow us to establish relationships between test cases, requirements, defects, and test automation. Furthermore, in order to reduce variance in test documentation patterns and standards, the ideal solution should enforce a documentation standard. The project team will be exposed to modern Web application development technologies such as ASP.NET MVC 5 and Web API, Team Foundation Server, SQL Server, AngularJS, J',999,1029,NULL,NULL,'Tariq','King'),(113,'Web Dashboard for Addigy IT Management Softwa','With all the data that Addigy captures about each Mac computer, users want to see ever-growing dashboard data representation.  Building informative and intuitive dashboards for users to keep a pulse on their company is extremely important in any software products today.  Dashboards are currently displayed using Bootstrap and Bootswatch template objects.  While you will have access to many templates and existing dashboards, feel free to be creative in how you develop these new dashboards.  These Dashboards and reports have the potential to be highly advertised throughout the Addigy website and product-line.\n\nProject Objectives:  Create an extensible web based dashboard that displays core state of all mac machines managed by a particular customer/organization.  All core data is collected and stored in an online database and intended to show the current status of all systems.\n- Pie chart of type of assets: macbook, mac mini, mac server, etc\n- Pie chart of OS version: 10.8, 10.9, 10.10\n- Graphic of machines with ',999,999,NULL,NULL,'Jason','Dettbarn'),(114,'Big Data Mining and Correlation for Addigy IT','Big Data is often misused in the industry, and while Addigy collects tremendous system data that can also be easily extended with new auditing facts, we are not processing petabytes of data.  Like most companies, modeling and correlating data starts with more modest infrastructure (no hadoop required).  Addigy leverages Logstash to ElasticSearch to quickly model data with Kibana.  You will be able to correlate and build business intelligence at a very fast pace, and develop an extremely useful skill set valuable to any company.  Novel unique data correlation has the potential to be highly advertised throughout the Addigy website and product-line.\n\nProject Objectives:  The key objective is harvesting various system log files, to correlate very interesting sets of data for alerting & reporting.  The first objective is being able to report on historic Addigy Policy Updates applied to the machine.  Logs currently show elements of the machine that are out specification, and what changes were made on the machines. ',999,999,NULL,NULL,'Jason','Dettbarn'),(115,'Pinecrest People Mover Web and Mobile Tracker','The Pinecrest People Mover is a free transit bus service operated by the Village of Pinecrest connecting our neighborhoods and schools.  It is mostly used by middle and high school students who do not qualify for bus service from the school district.  We would like to design a Web tracker and a Mobile tracker to show residents routes, hours of operation, real-time trolley location (as a list and as an interactive map) and allow for automatic notifications for arrival at user’s favorite stops. The mobile tracker should work well on iPhone & android devices.',999,999,NULL,NULL,'Gabriela','Wilson'),(116,'Mobile and Web Platforms for Visualizing Wate','Data centers also not only energy hogs, but are also very \"thirsty\". A large data center may consume millions of gallons of cooling water each day; in addition, data centers also indirectly consume an enormous amount of water embedded in offsite electricity generation. As a result, water conservation is surfacing as a critical concern for data centers, amid the anticipation of surging water demand worldwide. Left unchecked, the growing water footprint of data centers can pose a severe threat to data center sustainability and may even handicap availability of services, especially for data centers in water-stressed areas. Existing mechanical solutions for conservation, such as using recycled/industry water and directly using outside cold air, are often costly and/or very limited by external factors such as locations, climate conditions, among others. As part of the integral efforts from both industry and academy to enable data center sustainability, this project uniquely integrates water footprint as an essenti',999,999,NULL,NULL,'Shaolei','Ren'),(117,'Power Management in Multi-Tenant Data Centers','Power-hungry data centers have been massively expanding in both number and scale, placing an increasing emphasis on optimizing data center power management. While the progress in data center energy efficiency is encouraging, the existing efforts have dominantly centered around owner-operated data centers (e.g., Microsoft). Another unique and integral segment of data center industry --- multi-tenant colocation data center, simply called “colocation”, which is the physical home to many Internet and cloud services --- has not been well investigated, which, if still left unchecked, would become a major hurdle for sustainable growth of the digital economy. In sharp contrast with owner-operated data centers where operators have full control over both computing resources and  facilities, colocation rents physical space to multiple tenants which individually control their own physical servers and power management, while the colocation operator is mainly responsible for facility support (e.g., providing reliable power',999,999,NULL,NULL,'Shaolei','Ren'),(118,'Virtual Colonoscopy System','Virtual colonoscopy system visualizes the digital colon surfaces and helps doctor check the interior structure and screen the cancerous polyp/abnormality. The main goal includes: 1) build the user-friendly interface using MFC or other GUI; 2) visualize exterior and interior surfaces of colon by 3D rendering (Computer Graphics) technique; 3) navigate the interior tunnel of the convoluted and folded colon along the central line; and 4) if time permits, build the interface for colon flattening and registration.  Colon data are provided. \n\nThis is an ongoing project; three undergraduates (2 senior, 1 junior) have been working on that from this summer. We hope to continue that as their senior project (for the 2 senior students). Other students who are interested can join the team. The output system would offer a great demo for visitors/students to understand the power of graphics/geometry in solving real problems in medical imaging.  \n\nProject Team Member: \nMaylem Gonzalez (senior), mgonz108@fiu.edu\nFrancisco Marc',999,999,NULL,NULL,'Wei','Zeng'),(119,'Geometric Search Engine','3D geometric data are ubiquitous today. Efficient processing and organizing these massive data is required. The main goal of this project includes: 1) build the geometric database; 2) build the management system; 3) view the 3D objects on webpage using 3D Computer Graphics and WebGL techniques. Server and 3D databases (e.g., human facial expressions, brains) are provided.\n\nProject Team Member: \nCarlos Morales (junior, will be involved), cmora062@fiu.edu',999,999,NULL,NULL,'Wei','Zeng'),(120,'OWASP Encoders in C','The OWASP Java Encoder Project helps people make safer web-based\napplications. It is only fully supported in Java. This project is to\nport the code to a C library so that it can be included in frameworks\nlike mod_perl, PHP, or ESI. A stellar project would not only create\nthe library, but also submit a patch to include it in one or more of\nthose frameworks.\n\nSee Also:\nhttps://www.owasp.org/index.php/OWASP_Java_Encoder_Project\nhttp://www.esi.org\nhttp://docs.oracle.com/cd/E17904_01/web.1111/e10143/esi.htm\n\n\nThis project could be completed by one to three students, depending on\nhow much they aim to achieve.\nI don\'t have a good grasp of what would be too much to ask of one of\nthese projects. The \"short\" version is just porting the library then\ncalling it using JNI. A more advanced project would be built as\nfollows:\n\nOne person could port the library from Java to C while the two others\nbuild foreign-function interface wrappers for python and php.\nThen the three could work to build simple web-apps in python and PHP\n',999,999,NULL,NULL,'Eric','Kobrin'),(121,'Assigning Content for Translation','We are a local translations company based in Coral Gables that is looking to give our clients a more convenient way of assigning content to us for translation. Currently, many of our clients manually export content from their CMS, usually in an XML format, and email it to us. We want to automate this process by exploring the possibility of developing a plugin to work with their CMS whereby they can assign files directly to us from within the application.\n\nWe are seeking a possible collaboration with your institution in developing this plugin. Our thinking is that this would be a great opportunity for a class project or beneficial to a student needing a real-life project to complete their thesis, etc. We would, on the other hand, benefit by getting our plugin developed.\n\n',999,999,NULL,NULL,'Jaime','Zuniga'),(122,'Open Source Intelligence Inference Engine','The students will build a web application providing a repository for\nstoring and searching OSINT data as well as internal cyberattack data\nusing semantic web techniques. The backing store should be one of the\nexisting semantic web triple- or quad-stores such as Mulgara or Jena\nand should be queryable directly using Sparql or Datalog. The\nstructure and interface should provide for storing\nintelligence-critical metadata such as assertion provenance and\nconfidence of assertions.\n\nSee Also:\nhttp://en.wikipedia.org/wiki/Open-source_intelligence\nhttp://www.mulgara.org/\nhttp://en.wikipedia.org/wiki/Jena_(framework)\nhttp://en.wikipedia.org/wiki/SPARQL\nhttp://en.wikipedia.org/wiki/Datalog\nhttp://en.wikipedia.org/wiki/Resource_Description_Framework',999,999,NULL,NULL,'Eric','Kobrin'),(123,'Redesign of Intimo\'s Merchant Website on New ','We currently have our Merchant web site with Yahoo Merchant Services. The platform we currently use is outdated and Yahoo has released a new platform. We would like to merge to the new platform and redesign our website.\n\nskills such as Dust; Nodes; Pearl.\n\nAgain, this is a new platform for Yahoo stores and eventually all customer will switch to it and Yahoo is allowing us to transfer our page to “partner up” with me on this project with your students. My Yahoo rep Maria Melo is very excited to learn more about the opportunities she can give to the students and definitely be a partner on this project.\n \nI will need a programmer, a designer and a data management “expert”\n \nProgrammer must be proficient in Dust.js; Nodes.js; SQL.\n \nDesigner must be proficient on UI to create the flow, web designer creating the layout, usability for the pages, etc\n \nData Management will need to set up items, set up navigation, database, etc.\n \nEssentially we have our web page www.intimo.com and we will create a brand new store on',999,999,NULL,NULL,'Sonia','Centeno'),(124,'Virtual Queue','The application is for theme parks and other businesses that have multiple rides or events for which patrons typically wait in line.  The idea is that both the theme park and the patron would benefit by the patrons walking around the park (and maybe spending money) rather than standing in line.  This application will keep static data such as ride time, capacity, etc., as well as dynamic data regarding the patrons and queues, and allow patrons to virtually queue for a ride via a mobile app.  The patron will be notified as their time approaches.  Geo-location will also be used to insure that patrons are in the park, and tell them how to get to the ride.\n\nProject Proposer Name: ... Bernard Parenteau\n\nProject Proposer Affiliation: ... Florida Logic www.floridalogic.com\n\nProject Proposer Position: ... Managing Partner\n?\nExpanded Project Description: \nThe project consists of a mobile app, scanner, maintenance site, and a server component.   The patron would download the mobile app in advance or at time of entry.  B',999,999,NULL,NULL,'Bernard','Parenteau'),(125,'Aggregate and create a charity Information “B','Aggregate and create a charity Information “Big Data” mart & create a transparency scoring algorithm. Use the power of technology to showcase and highlight honest and transparent charities.\n\nSeek out and identify multiple sources of charity information that is accessible and retrievable utilizing APIs or web-based content retrieval\nWrite processes to retrieve identified data at periodic intervals\nCreate a centralized system of record for storing and marking up data \nWrite algorithm(s) to process data; create scoring mechanisms and analytical models based on data\nPublish results and other metadata through a privately accessible API\n',999,999,NULL,NULL,'Andy','Hill'),(126,'Displaying social photos to a social wall/fee','Pull photos from a Facebook album, RSS feed and or Twitter hashtag and display them in a grid on a webpage.   This is a ‘social wall’ that can be projected onto a wall, shown on a monitor at an event, etc.  Incorporating Google Analytics and Facebook Insights and digesting that data could be another piece of the project.',999,999,NULL,NULL,'Cortney','Mills'),(128,'University Catalog Management System - Versio','This project has already been started. The current system has the database structure \nset and the user interface created for a normal user to view existing catalog information\nand an adviser to create/modify catalog information.\n\nThe project is a web-based application written in PHP using the Yii Model-View-Controller\nframework. The database is mysql. Students selecting this project will need to know PHP\nand mysql. With these skills, they should be able to learn the Yii framework quickly.\n\nThree roles exist in this project: user, adviser and administrator. The user view is almost\ncomplete. The adviser role needs  improvements. The administrator role needs major work. \nSome of the functions of the admin may require modifications to the existing database \nstructure.\n\nAdditional features to implement include creating a web service for accessing the catalog \ninformation, generating a graphical flow chart from a list of courses, creating versions\nof a catalog in alternate formats (eg, XML) for use in other program',999,999,NULL,NULL,'Tim','Downey'),(129,'Rote Practice Educational System','This is a new project. I have a simple example running that uses JSPs and Servlets, but\nthe students would be free to choose another web framework, as long as it is based\non MVC. The basic idea of the system is to allow for rote drills of material. The existing\nexample allows the user to unscramble the lines of code from a program file. Additional\ntasks need to be developed, such as matching terms to definitions and placing items \ninto categories.\n\nI envision three roles: user, faculty, admin. The exercises will be organized by class and\nfaculty. \n\nUser role: Run authorized examples and to import files of their own into existing types of \ntasks. Access statistics of how many tasks have been completed and how many times\neach task has been done.\n\nFaculty role: Create tasks, specifying how many times it must be completed before the\ntask is considered finished. Only students from a class will have access to the exercise,\nunless permission is granted by the faculty to other classes/students or made public. \nRetrie',999,999,NULL,NULL,'Tim','Downey'),(130,'Using Shipping Data to Aid in Fraud Detection','Internet fraudsters often use the shipment carrier as a means to camouflage their illicit activities. For example, a fraudster may claim a package never arrived, or the package arrived in a damaged state.\n \nIt is possible using a combination of shipping data and heuristic algorithms to complement existing fraud detection methods to increase the percentage of fraudulent activities detected.\n\nThis project would use shipping data to attempt to detect potential fraudulent activities by applying heuristic algorithms to the shipping data to highlight activities that fall out of the normal range of behavior, thus providing an additional data point to the overall fraud detection process.\n\nKen Smith\nken@71lbs.com',999,999,NULL,NULL,'Jose','Li'),(131,'MyExperiment: A Web-based Model Repository fo','The goal of the MyExperiment project is to develop a web-based solution that allows network researchers and experimenters to create, view, modify and manage network models (including network topologies, network traffic, and network configurations), which they use to conduct simulation and emulation experiments for validating design and evaluating performance. The target system will offer an  \"online store\" for users to create various models using existing model generators, as well as configure, inspect and visualize them. The created models can be saved in the online repository for private or public use. MyExperiment will become a common platform for network researchers to store, share and reuse models for network experimentation.\n\nStudents should have basic knowledge of computer network, and should have experience with web service design and development (such as HTML5, CSS, Javascript, PHP, JSP, ASP, MySQL/Postgres, etc.)\n',999,999,NULL,NULL,'Jason','Liu'),(132,'Smart Systems for Occupancy and Building Ener','The objective of this project is to develop a smart system for tracking and modeling occupancy behaviors in building energy analysis. Using robust sensor networks and computational algorithms, a smart system will be developed to capture, analyze, and predict occupancy behaviors and provide real-time feedback to occupants to eliminate energy waste. In this project students will build the sensor network and develop the algorithms and will test the system using experimentations in one of the campus buildings.\n\nProject objective and scope: The objective of this project is to develop a smart system for tracking and modeling occupancy behaviors in building energy analysis. The system will include two components. The first component include a non-invasive sensor network to capture the movements of building occupants and their behaviors as well as the information related to the lighting, indoor temperature, and the plug-loads. By utilizing small modules using Infrared sensors equipped with wireless networking technol',999,999,NULL,NULL,'Leonardo','Bobadilla'),(133,'(IBM) Track and keep score of and compute a g','Announcement \n\n\nDid you know... Recycling a four-foot stack of newspapers saves the equivalent of one 40-foot fir tree? \n\n\nDid you know.... Every glass bottle recycled saves enough energy to light a 100-watt light bulb for 4 hours? \n\n\nDid you know....Americans throw away enough aluminum to rebuild the entire commercial airline fleet every three months?\n\n\nWhat if just one individual did their part and saved a tree, conserved a little electricity or helped recycle materials?\n\n\nWhat if a small group of individuals banded together and tracked their collective progress?\n\n\nWhat if one of world\'s leading technology companies combined forces with a group of gifted computer science students from Florida International University to make a difference?\n\n\nThis is your chance to enable one of the world\'s leading companies to build a platform that will incent and measure their sustainability efforts and behaviors. \n\n\nWe\'re looking for a team of environmentally conscious computer science engineers to build a system that will',999,999,NULL,NULL,'Juan','Caraballo'),(134,'Binding the Java platform with the GlusterFS ','This project, glusterfs-java-filesystem, is an implementation of a Java 7 NIO.2 Filesystem Provider backed by GlusterFS through a JNI binding to the C library libgfapi.  It is used as a plug-in library in Java software to allow direct connection to GlusterFS storage volumes.\n\nhttps://github.com/semiosis/glusterfs-java-filesystem\n\nJava 7 introduced the Filesystem Provider API which allows developers to add support to the Java platform for new filesystems.  This allows a loose coupling between application and filesystem code.  The application is programmed against the NIO.2 API, so it does not depend on any particular filesystem implementation.  Then a provider library can be dropped in to the JVM and the application gets access to the new type of filesystem automatically.\n\nThis is a challenging project most suitable for adept & motivated students.  I could manage up to three students.\n\nStudents should be fluent in Java and comfortable working on Linux.  Ideally students will have worked previously on a Java pr',999,999,NULL,NULL,'Louis','Zuckerman'),(136,'iOS/Android Game','This project will consist of making a game for mobile platforms for a Software Dev company that I\'m starting.  It will be a tile board game dealing with adding numbers. The game will have a 2-player mode, with the option to play with an AI. The game will also have a timed single-player mode. It will be built using the cocos2d/cocos2d-x Framework. \n\nI will be handling the iOS side of the game, and also the front-end design, as well as other features that come up. I need a developer that handles the Android side (Java) and a developer that handles the multiplayer backend logic. As mentioned, creating the AI is also part of the project. There is also work to be done to create the leaderboards and achievements. \n\nWhen the game is finished, it will published in the App Store/Google Play store. \n\nContact me if you want to learn more about the game. ',999,999,NULL,NULL,'Wei','Zeng'),(137,'Liveness Detection in Video (Kairos Facial Re','We need the ability to make sure the face in front of the camera is a real person and not a photo or a video of a person for fraud and security reasons. We need this ability primarily for iOS cameras (iPhone, iPad, iPod Touch) and streaming video from security cameras (iOS is more important) We would love for you to use our API located at https://developer.kairos.com for our work. Try to fool it, and then figure out how to keep it safe. \n\nHere is a list of all of our capabilities, we can make any of these capabilities available to the team:\n\nhttp://www.kairos.com/technology/\n\nThere can be multiple ways to solve this problem. We look forward to many many ideas. Kairos will be providing a prize at the successful completion of this project. \n\n',999,999,NULL,NULL,'Brian','Brackeen');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_meeting`
--

LOCK TABLES `project_meeting` WRITE;
/*!40000 ALTER TABLE `project_meeting` DISABLE KEYS */;
INSERT INTO `project_meeting` VALUES (1,17,21,'2014-11-01','06:00:00'),(2,18,10,'2014-11-03','09:00:00'),(3,1000,1005,'2015-01-31','01:00:00'),(4,1029,1052,'2015-12-02','06:10:00'),(5,1029,1052,'2015-12-02','18:14:00'),(6,1029,1052,'2015-12-03','08:00:00');
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
INSERT INTO `project_mentor` VALUES (5,0,0),(6,20,2),(7,NULL,NULL),(10,0,0),(16,24,1),(17,10,1),(18,0,0),(999,NULL,NULL),(1000,2,1),(1012,NULL,NULL),(1016,0,0),(1026,0,0),(1029,0,0),(1032,0,0),(1052,0,1);
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
-- Table structure for table `reassign_rules`
--

DROP TABLE IF EXISTS `reassign_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reassign_rules` (
  `rule_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule` varchar(255) NOT NULL,
  `setting` int(11) NOT NULL,
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='rules for reassignment so that the sys admin can adjust';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reassign_rules`
--

LOCK TABLES `reassign_rules` WRITE;
/*!40000 ALTER TABLE `reassign_rules` DISABLE KEYS */;
INSERT INTO `reassign_rules` VALUES (1,'Reassigns before given to admin',6),(2,'Days mentor is saved as \"away\"',5),(3,'Tickets assigned within last X hours will be reassigned from an away mentor',6);
/*!40000 ALTER TABLE `reassign_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `report_mentee`
--

DROP TABLE IF EXISTS `report_mentee`;
/*!50001 DROP VIEW IF EXISTS `report_mentee`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `report_mentee` AS SELECT 
 1 AS `UserID`,
 1 AS `UserName`,
 1 AS `Email`,
 1 AS `Name`,
 1 AS `Disabled`,
 1 AS `UniversityID`,
 1 AS `UniversityName`,
 1 AS `PersonalMentorID`,
 1 AS `PersonalMentorEmail`,
 1 AS `PersonalMentorName`,
 1 AS `PersonalMentorDisabled`,
 1 AS `menteeProjectID`,
 1 AS `menteeProjectTitle`,
 1 AS `menteeProjectStartDate`,
 1 AS `menteeProjectDueDate`,
 1 AS `menteeProjectCustomerName`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `report_mentor`
--

DROP TABLE IF EXISTS `report_mentor`;
/*!50001 DROP VIEW IF EXISTS `report_mentor`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `report_mentor` AS SELECT 
 1 AS `userID`,
 1 AS `userName`,
 1 AS `email`,
 1 AS `name`,
 1 AS `disabled`,
 1 AS `isProjectMentor`,
 1 AS `isPersonalMentor`,
 1 AS `isDomainMentor`,
 1 AS `isJudge`,
 1 AS `isNew`,
 1 AS `isEmployer`,
 1 AS `employer`,
 1 AS `position`,
 1 AS `degree`,
 1 AS `fieldOfStudy`,
 1 AS `gradYear`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `report_ticket`
--

DROP TABLE IF EXISTS `report_ticket`;
/*!50001 DROP VIEW IF EXISTS `report_ticket`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `report_ticket` AS SELECT 
 1 AS `ticketID`,
 1 AS `creatorID`,
 1 AS `creatorName`,
 1 AS `creatorDisabled`,
 1 AS `creatorEmail`,
 1 AS `ticketStatus`,
 1 AS `ticketCreatedDate`,
 1 AS `ticketSubject`,
 1 AS `ticketDescription`,
 1 AS `ticketAssignUserID`,
 1 AS `assignedUserName`,
 1 AS `assignedUserDisabled`,
 1 AS `assignedUserEmail`,
 1 AS `ticketDomainID`,
 1 AS `ticketDomainName`,
 1 AS `ticketSubDomainID`,
 1 AS `ticketSubDomainName`,
 1 AS `ticketPriorityID`,
 1 AS `ticketPriorityDescription`,
 1 AS `ticketAssignedDate`,
 1 AS `ticketClosedDate`,
 1 AS `ticketIsEscalated`*/;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subdomain`
--

LOCK TABLES `subdomain` WRITE;
/*!40000 ALTER TABLE `subdomain` DISABLE KEYS */;
INSERT INTO `subdomain` VALUES (1,'Java','jjajajajajaja',7,8,'Medium',5),(2,'C++','ccccc',6,8,'Medium',5),(3,'Mitosis','mmmmm',4,9,'Medium',5),(5,'C#','C# topics',5,8,'Medium',5),(7,'Cell division','cell division',5,9,'Medium',5),(8,'C','c',6,8,'Medium',5),(9,'UML Diagrams','The way to structure diagrams that convey the message of how the software works.',5,10,'Medium',23),(10,'PHP','the language php',5,8,'Medium',5),(11,'F#','the f# language a predictive language',5,8,'Medium',5),(12,'HTML','The html language. A really awesome thing!',5,8,'Medium',5),(13,'Fortran','the language fortran',5,8,'Medium',5),(14,'Evolution','biology',5,9,'Medium',5),(15,'Javascript','The language of javascript',5,8,'Medium',5);
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
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (41,21,'Pending','2014-07-17 10:48:57','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-06-10 18:53:39',NULL,NULL,7,NULL,NULL),(42,21,'Pending','2014-07-17 10:52:45','What is a constructor?','What is a constructor?',1052,8,2,'',2,'2015-10-14 10:05:51',NULL,NULL,19,NULL,NULL),(43,21,'Close','2014-07-17 10:59:08','Errors.','What is run-time error?',5,8,2,'',2,'2015-06-08 11:54:26',NULL,NULL,NULL,NULL,NULL),(46,5,'Pending','2014-10-25 17:01:47','adsfa','sdf',5,8,2,'',3,'2015-06-12 00:33:37',NULL,NULL,NULL,NULL,NULL),(47,21,'Close','2014-07-17 10:59:08','Errors.','What is run-time error?',5,8,2,'',2,'2015-06-08 11:54:34',NULL,NULL,NULL,NULL,NULL),(48,5,'Pending','2014-11-11 00:59:57','test','test123',5,8,NULL,'',3,'2015-06-11 12:00:02',NULL,NULL,NULL,NULL,NULL),(49,5,'Pending','2014-11-14 01:13:32','ddd','ddd',5,10,NULL,'',3,'2015-06-11 12:00:04',NULL,NULL,NULL,NULL,NULL),(50,5,'Pending','2015-01-21 18:56:18','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-06-10 18:53:40',NULL,1,NULL,NULL,NULL),(51,5,'Pending','2015-01-21 18:56:28','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-06-10 18:53:40',NULL,1,NULL,NULL,NULL),(52,5,'Pending','2015-01-21 19:13:28','dfd','dfdf',5,8,1,'',1,'2015-06-10 18:53:40',NULL,NULL,NULL,NULL,NULL),(53,5,'Pending','2015-01-21 19:19:48','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-06-10 18:53:40',NULL,1,NULL,NULL,NULL),(54,5,'Pending','2015-01-21 19:21:49','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-06-10 18:53:40',NULL,1,NULL,NULL,NULL),(55,5,'Pending','2015-01-24 15:21:33','adsfa','sdf',5,8,2,'',3,'2015-06-11 12:00:05',NULL,1,NULL,NULL,NULL),(56,5,'Pending','2015-01-24 15:21:46','adsfa','sdf',5,8,2,'',3,'2015-06-11 12:00:07',NULL,1,NULL,NULL,NULL),(57,5,'Pending','2015-01-24 15:21:47','adsfa','sdf',5,8,2,'',3,'2015-06-11 12:00:09',NULL,1,NULL,NULL,NULL),(58,5,'Pending','2015-01-26 22:56:08','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-06-10 18:53:40',NULL,1,NULL,NULL,NULL),(59,5,'Pending','2015-01-26 22:56:10','Explain different way of using thread?','Explain different way of using thread?',5,8,1,'',1,'2015-06-10 18:53:40',NULL,1,NULL,NULL,NULL),(60,10,'Close','2015-02-18 16:41:32','ticket 1','ticket 1',5,8,NULL,'',1,'2015-06-09 16:44:45','2015-02-24 22:32:33',NULL,NULL,NULL,NULL),(61,10,'Close','2015-02-24 20:50:41','Subject','Description',5,8,NULL,'',1,'2015-06-09 16:44:46','2015-02-24 22:37:19',NULL,NULL,NULL,NULL),(62,10,'Reject','2015-02-24 21:04:16','ticket 2','desc',5,8,1,'',1,'2015-06-08 11:58:20',NULL,NULL,NULL,NULL,NULL),(63,10,'Pending','2015-02-25 18:28:30','A ticket for reasigment','A ticket for reasigment',5,8,1,'',1,'2015-06-10 18:53:40',NULL,NULL,NULL,NULL,NULL),(64,5,'Pending','2015-02-25 20:42:09','A ticket for reasigment','A ticket for reasigment',5,8,1,'',1,'2015-06-10 18:53:40',NULL,1,NULL,NULL,NULL),(65,10,'Pending','2015-02-25 21:27:01','Ticket for escalation','Ticket for escalation',5,8,1,'',2,'2015-06-11 07:00:02',NULL,NULL,NULL,NULL,NULL),(66,5,'Pending','2015-02-25 21:29:02','Ticket for escalation','Ticket for escalation',5,8,1,'',2,'2015-06-11 07:00:02',NULL,1,NULL,NULL,NULL),(67,10,'Close','2015-02-27 23:27:36','sdfs','sdfsf',5,10,NULL,'',2,'2015-02-27 23:27:36','2015-03-01 11:36:42',NULL,NULL,NULL,NULL),(68,10,'Close','2015-02-27 23:56:36','sdf','sdf',5,8,NULL,'',3,'2015-06-09 16:44:47','2015-03-01 11:36:21',NULL,NULL,NULL,NULL),(70,10,'Pending','2015-03-17 22:48:44','ticket without project','desc',5,8,NULL,'',1,'2015-06-10 18:53:44',NULL,NULL,NULL,NULL,2),(72,10,'Pending','2015-03-17 22:49:55','sdfsdf','ticket without project 2',5,9,NULL,'',1,'2015-03-17 22:49:55',NULL,NULL,NULL,NULL,2),(74,10,'Pending','2015-03-17 22:54:17','ticket without project 4','ticket without project 4',5,8,NULL,'',2,'2015-06-11 07:00:02',NULL,NULL,NULL,NULL,NULL),(75,10,'Pending','2015-03-17 22:55:04','ticket without project 6','ticket with project 6',5,10,NULL,'',1,'2015-06-12 07:00:03',NULL,NULL,NULL,NULL,2),(76,5,'Pending','2015-04-01 21:02:35','A C++ ticket','a C++ ticket',5,8,2,'',1,'2015-06-10 10:45:29',NULL,NULL,NULL,NULL,NULL),(77,5,'Pending','2015-04-01 21:03:42','a c#ticket','a C# ticket',5,8,5,'',1,'2015-06-09 17:44:25',NULL,NULL,NULL,NULL,NULL),(78,6,'Pending','2015-04-01 21:05:45','another java ticket','another java ticket',5,8,1,'',2,'2015-06-11 07:00:02',NULL,NULL,NULL,NULL,NULL),(79,19,'Pending','2015-04-01 21:07:13','another c++ ticket','another c++ ticket',5,8,2,'',1,'2015-06-10 10:45:30',NULL,NULL,NULL,NULL,NULL),(80,6,'Pending','2015-04-02 21:11:25','java question','javaquestion',5,8,NULL,'',1,'2015-06-10 18:53:48',NULL,NULL,NULL,NULL,NULL),(81,5,'Pending','2015-06-05 12:32:54','A test ticket','see who this is assigned to',5,8,5,'',1,'2015-06-09 15:35:19',NULL,NULL,NULL,NULL,NULL),(82,5,'Pending','2015-06-05 16:06:23','a second test ticket','this ticket will be assigned to either atestmentor1 or atestmentor2, I have access to their email addresses i will send fiucoplat@gmail.com a email that will cause a sucess in the parser.  This ticket will then be reassigned to the other mentor.',5,8,5,'',1,'2015-06-09 15:35:19',NULL,NULL,NULL,NULL,NULL),(83,5,'Pending','2015-06-08 11:22:26','another test ticket 1','i like to test things',5,8,5,'',1,'2015-06-10 18:53:48',NULL,NULL,NULL,NULL,NULL),(84,5,'Pending','2015-06-08 11:22:58','another test ticket 2','i like to test more thhings',5,8,5,'',1,'2015-06-10 20:00:01',NULL,NULL,NULL,NULL,NULL),(85,5,'Pending','2015-06-08 11:26:24','this didnt seem to work','more tests to make sure this is working',5,8,5,'',1,'2015-06-10 16:00:01',NULL,NULL,NULL,NULL,NULL),(86,5,'Pending','2015-06-08 11:31:52','aother test ticket','look at this please assign to test mentor 2',5,8,5,'',1,'2015-06-10 20:00:01',NULL,NULL,NULL,NULL,NULL),(87,1022,'Close','2015-06-08 11:32:54','lets see from non admin','i like to create tests should be a test mentor 1',5,8,5,'',1,'2015-06-10 16:00:01','2015-07-24 16:21:45',NULL,NULL,NULL,NULL),(88,1022,'Close','2015-06-08 11:33:27','i like to create more tests','should be a test mentor 2',5,8,5,'',1,'2015-06-10 21:00:02','2015-07-24 16:21:58',NULL,NULL,NULL,NULL),(89,5,'Pending','2015-06-09 16:17:31','a ticket for mentor 3','this should go to mentor 3',5,8,5,'',3,'2015-06-10 10:45:40',NULL,NULL,NULL,NULL,NULL),(90,5,'Pending','2015-06-09 17:27:23','A test ticket78','look at this',5,8,5,'',3,'2015-06-09 17:27:23',NULL,NULL,NULL,NULL,NULL),(91,5,'Pending','2015-06-09 17:27:50','a test ticket 79','look at that',5,8,5,'',3,'2015-06-10 10:45:42',NULL,NULL,NULL,NULL,NULL),(92,5,'Pending','2015-06-09 17:28:13','a test ticket 80','look at me',5,8,5,'',3,'2015-06-10 15:00:04',NULL,NULL,NULL,NULL,NULL),(93,5,'Pending','2015-06-09 17:51:42','a test ticket 81','hey would you look at that',5,8,5,'',3,'2015-06-09 18:05:38',NULL,NULL,NULL,NULL,NULL),(94,5,'Pending','2015-06-09 18:20:25','test ticket whatever','this is a test ticket',5,8,5,'',1,'2015-06-10 21:00:02',NULL,NULL,NULL,NULL,NULL),(95,5,'Pending','2015-06-09 18:21:07','a nother test ticket thing','this is another test ticket',5,8,5,'',1,'2015-06-10 20:00:04',NULL,NULL,NULL,NULL,NULL),(96,5,'Pending','2015-06-09 18:26:42','yet another','here we go',5,8,5,'',1,'2015-06-12 13:00:03',NULL,NULL,NULL,NULL,NULL),(98,5,'Pending','2015-06-10 14:45:50','another test ticket 3','if this assigns to atestmentor1 i will send an away message from the email and then this should be reassigned to ~somebody',5,8,5,'',1,'2015-06-10 21:30:02',NULL,NULL,NULL,NULL,NULL),(99,5,'Pending','2015-06-10 14:46:26','hopefully this will assign to test mentor 1','lets see if this works',5,8,5,'',1,'2015-06-10 22:30:03',NULL,NULL,NULL,NULL,NULL),(100,5,'Pending','2015-06-10 16:39:52','NEed a ticket to go to a mentor','this is the description',5,8,5,'',1,'2015-06-10 21:30:03',NULL,NULL,NULL,NULL,NULL),(101,5,'Pending','2015-06-10 16:40:51','this is another ticket','i would like this to go to testmentor1 but i no longer have control over that. due to round robin',5,8,5,'',1,'2015-06-10 21:30:04',NULL,NULL,NULL,NULL,NULL),(102,5,'Pending','2015-06-10 16:41:38','let se who this is assigned to','this is another test ticket i would like to go to test mentor 1 for showcasing.',5,8,5,'',1,'2015-06-10 23:00:02',NULL,NULL,NULL,NULL,NULL),(103,5,'Pending','2015-06-11 14:17:39','a test ticket','Just testing to ensure this gets reassigned after an hour when i set priority to an hour.',5,8,5,'',1,'2015-06-11 16:30:03',NULL,NULL,NULL,NULL,NULL),(104,5,'Pending','2015-06-11 15:58:31','a new ticket for testing auto response','hopefully this assigns to testmentor1',5,8,5,'',1,'2015-06-11 17:00:02',NULL,NULL,NULL,NULL,NULL),(105,5,'Pending','2015-06-11 15:59:14','antoher test ticket assign to testmentor1','this should assign to testmentor1',5,8,5,'',1,'2015-06-11 16:49:58',NULL,NULL,NULL,NULL,NULL),(106,5,'Pending','2015-06-11 16:18:30','another test ticket 1','if this sends to aduro it should get an out of office response',5,8,5,'',1,'2015-06-11 19:20:47',NULL,NULL,NULL,NULL,NULL),(107,5,'Pending','2015-06-11 16:19:12','this will def assign to aduro','hopefully adding the return path makes a difference',5,8,NULL,'',1,'2015-06-12 00:33:41',NULL,NULL,NULL,NULL,NULL),(108,5,'Pending','2015-06-11 16:19:44','hopefully this will assign to test mentor 14','this should def assign to aduro',5,8,5,'',1,'2015-06-11 16:49:58',NULL,NULL,NULL,NULL,NULL),(109,5,'Pending','2015-06-11 16:23:50','test the email sender','hopefully this works',5,8,5,'',1,'2015-06-11 16:49:58',NULL,NULL,NULL,NULL,NULL),(110,5,'Pending','2015-06-11 16:28:30','a;lkdsjf;alkcnal;c','soadupam;caefsdf',5,8,5,'',1,'2015-06-11 16:49:58',NULL,NULL,NULL,NULL,NULL),(111,5,'Pending','2015-06-11 17:05:33','a thing with stuff','lets see what happens',5,8,5,'',1,'2015-06-11 19:20:48',NULL,NULL,NULL,NULL,NULL),(112,5,'Pending','2015-06-11 17:16:46','a thing with stuff well see who this is assin','adsfasdjkcaj;learf',5,8,5,'',1,'2015-06-11 18:21:49',NULL,NULL,NULL,NULL,NULL),(113,5,'Pending','2015-06-11 18:00:03','a thing to test','lets see if this wokrs',5,8,5,'',1,'2015-06-11 19:20:49',NULL,NULL,NULL,NULL,NULL),(114,5,'Pending','2015-06-11 18:00:25','hop a sdf','aeceaescae',5,8,5,'',1,'2015-06-11 19:20:50',NULL,NULL,NULL,NULL,NULL),(115,5,'Pending','2015-06-11 18:00:42','acdaeras','acaecerrrrr',5,8,5,'',1,'2015-06-11 19:20:51',NULL,NULL,NULL,NULL,NULL),(116,5,'Pending','2015-06-12 00:08:53','checking for emails','another test to ensure email listener is working as intended',5,8,5,'',1,'2015-06-12 13:00:04',NULL,NULL,NULL,NULL,NULL),(117,5,'Pending','2015-06-12 14:56:02','This should be passed back and forth to show','How the ticket reassignment works when it comes to a ticket being out of time.',5,8,5,'',1,'2015-06-26 13:51:58',NULL,NULL,NULL,NULL,NULL),(118,5,'Pending','2015-06-12 15:03:55','Another ticket to test the showcase','this should be one of the two tickets that bounce back and forth between testmentor1 and testmentor 2',5,8,5,'',1,'2015-06-16 14:05:51',NULL,NULL,NULL,NULL,NULL),(119,5,'Pending','2015-06-12 15:04:56','One more to test 1','send to test mentor 1',5,8,5,'',1,'2015-06-16 14:05:52',NULL,NULL,NULL,NULL,NULL),(120,5,'Pending','2015-06-12 15:28:56','if this sends to a test mentor 1','It will prompt the out of office response',5,8,5,'',1,'2015-06-16 17:02:07',NULL,NULL,NULL,NULL,NULL),(121,5,'Pending','2015-06-12 15:30:51','This should be sent to test mentor 1','and it will prompt the out of office response',5,8,5,'',1,'2015-06-16 17:02:08',NULL,NULL,NULL,NULL,NULL),(122,5,'Pending','2015-06-12 15:31:19','hopefully this will assign to test mentor 1','and prompt the out of office response',5,8,5,'',1,'2015-06-16 15:52:51',NULL,NULL,NULL,NULL,NULL),(123,1022,'Close','2015-06-12 17:15:21','This is a ticket','send to test 1',1033,8,5,'',1,'2015-07-10 02:57:57','2015-07-10 03:15:46',NULL,NULL,NULL,NULL),(124,1022,'Close','2015-06-12 17:15:42','another test ticket 1','asdfa',5,8,5,'',1,'2015-06-16 17:02:09','2015-07-24 16:22:10',NULL,NULL,NULL,NULL),(125,1022,'Close','2015-06-12 17:16:38','stuff and thigns','acdasdfa',5,8,5,'',1,'2015-06-17 01:00:03','2015-07-24 16:22:23',NULL,NULL,NULL,NULL),(126,1022,'Close','2015-06-12 17:17:00','aafcee','asdfsf 3',5,8,5,'',1,'2015-06-17 01:00:04','2015-07-24 16:22:44',NULL,NULL,NULL,NULL),(127,1022,'Close','2015-06-12 17:18:11','one more','adcaefa',1032,8,5,'',1,'2015-07-02 12:47:18','2015-07-24 16:23:10',NULL,NULL,NULL,NULL),(128,1022,'Close','2015-06-16 17:13:14','Message to be passed','a message to be passed between 1 and 2',5,8,5,'',1,'2015-06-17 01:00:05',NULL,NULL,NULL,NULL,NULL),(129,1022,'Close','2015-06-16 17:13:58','another message to be passed','a message to be passed between 1 and 2',5,8,5,'',1,'2015-06-17 01:00:06',NULL,NULL,NULL,NULL,NULL),(130,1022,'Close','2015-06-16 17:17:21','a ticket to spark out of office','thing with stuff',5,8,5,'',1,'2015-06-26 13:51:59',NULL,NULL,NULL,NULL,NULL),(131,1022,'Close','2015-06-16 17:18:19','the ticket will spark out of offce','a thing with stuff',5,8,5,'',1,'2015-06-26 13:52:00',NULL,NULL,NULL,NULL,NULL),(132,1022,'Close','2015-06-16 17:27:05','1 ticket to show','show juan this thing will be on mentor 1',5,8,5,'',1,'2015-06-17 01:00:07',NULL,NULL,NULL,NULL,NULL),(133,1022,'Close','2015-06-16 17:27:36','2 a ticket to show','this will go to mentor 2',5,8,5,'',1,'2015-06-17 01:00:08',NULL,NULL,NULL,NULL,NULL),(134,1022,'Close','2015-06-16 18:35:13','A ticket to spark the out of office','here is the description',5,8,5,'',1,'2015-06-17 07:30:03',NULL,NULL,NULL,NULL,NULL),(135,1022,'Close','2015-06-17 14:52:39','a test for emails ticket','look to see what happens',1022,8,5,'',3,'2015-06-26 01:44:16',NULL,NULL,NULL,NULL,NULL),(136,1022,'Close','2015-06-17 15:24:24','sadflkj','cadsfsacd',5,8,5,'',3,'2015-06-23 16:00:03',NULL,NULL,NULL,NULL,NULL),(137,1022,'Close','2015-06-17 15:28:48','stuff and things','look at that',5,8,5,'',3,'2015-06-23 16:00:04','2015-07-15 16:31:44',NULL,NULL,NULL,NULL),(138,1022,'Close','2015-06-17 16:02:14','s;adlfknciii','dasc sljafsdca',5,8,5,'',3,'2015-06-26 16:14:14',NULL,NULL,NULL,NULL,NULL),(139,1022,'Close','2015-06-17 16:04:04','suds','mef',5,8,5,'',3,'2015-06-23 17:00:03',NULL,NULL,NULL,NULL,NULL),(140,1022,'Close','2015-06-17 16:19:19','mef this thing','stuff and things',5,8,5,'',1,'2015-06-18 04:30:03',NULL,NULL,NULL,NULL,NULL),(141,1022,'Close','2015-06-17 16:22:13','stuff and thangssdfs','aceceacd',5,8,5,'',3,'2015-06-23 17:00:04',NULL,NULL,NULL,NULL,NULL),(142,1022,'Close','2015-06-18 16:18:55','a thing with stuff and what','Ok im goin to type out a long stuff here to see how long i can make my description and see how it looks on an email how is this going.  The quick red fox jumped over the lazy brown dog.  Dead rising three is an amazing game so far i had alot of fun with it last night and it works really well and is very addicting.  Fallout 4 looks absolutely amazing i cant wait tilll i get to play it it looks like so much fun wow i can keep typing for a while.',5,8,5,'',2,'2015-06-19 16:30:03',NULL,NULL,NULL,NULL,NULL),(143,1022,'Close','2015-06-18 16:29:22','what the what?','testing to see how this looks',1034,8,5,'',3,'2015-06-24 17:00:05',NULL,NULL,NULL,NULL,NULL),(144,1022,'Close','2015-06-18 18:43:47','ticket to show','I have a sever problem with C# and need help',5,8,5,'',2,'2015-06-19 19:30:02',NULL,NULL,NULL,NULL,NULL),(145,5,'Pending','2015-06-23 12:38:32','a test email thing','lets see what happens',5,8,5,'',3,'2015-06-26 16:13:34',NULL,NULL,NULL,NULL,NULL),(146,1022,'Close','2015-06-24 10:40:49','wouuld you look at that','hello there',1026,8,5,'',3,'2015-06-24 15:52:19',NULL,NULL,NULL,NULL,NULL),(147,1022,'Close','2015-06-24 15:48:33','Sorry','if this is spamming anyone need to send to adurocruor',5,8,5,'',1,'2015-06-26 13:52:01',NULL,NULL,NULL,NULL,NULL),(148,1022,'Close','2015-06-24 15:49:04','sorry again','if this is spamming anyone need to send to adurocruor',5,8,5,'',2,'2015-06-26 13:52:02',NULL,NULL,NULL,NULL,NULL),(149,1022,'Close','2015-06-24 15:50:03','one more time sorry','again if im spamming people sorry',5,8,5,'',1,'2015-06-26 13:52:03',NULL,NULL,NULL,NULL,NULL),(150,1022,'Close','2015-06-24 15:50:35','hopefully this time','woo maybe it will work',5,8,5,'',1,'2015-06-26 13:52:04',NULL,NULL,NULL,NULL,NULL),(151,1022,'Close','2015-06-24 15:51:02','maybe this will','actually it wil prob send to 2 well see',5,8,5,'',1,'2015-06-26 13:52:05',NULL,NULL,NULL,NULL,NULL),(152,1022,'Close','2015-06-24 15:51:26','this shoudl send to 1 now','and promt the out of office response',1035,8,5,'',3,'2015-06-24 17:00:02',NULL,NULL,NULL,NULL,NULL),(153,1022,'Close','2015-06-26 12:50:19','a  test scenario','lets see what happens',5,8,5,'',1,'2015-06-26 12:59:32',NULL,NULL,NULL,NULL,NULL),(154,1022,'Close','2015-06-26 13:50:36','showcase','look at that',5,8,5,'',1,'2015-06-26 13:51:56',NULL,NULL,NULL,NULL,NULL),(155,1022,'Close','2015-06-26 13:51:04','showcase 2','hey check this out',5,8,5,'',1,'2015-06-26 13:51:56',NULL,NULL,NULL,NULL,NULL),(156,1022,'Close','2015-06-26 16:36:41','test the reject link in email',' this is the description that now displays, in the mentors email.',5,8,5,'',1,'2015-06-26 16:55:56',NULL,NULL,NULL,NULL,NULL),(157,1022,'Close','2015-06-26 16:56:45','what the heck','why didn\'t that work',5,8,5,'',1,'2015-06-26 16:58:39',NULL,NULL,NULL,NULL,NULL),(158,1022,'Close','2015-07-01 12:39:30','i need to track down the upload file bug','hey look at me i need the error infor',1033,8,5,'/coplat/uploads/brevoy.png',1,'2015-07-01 12:39:30',NULL,NULL,NULL,NULL,NULL),(159,1022,'Close','2015-07-01 12:39:33','i need to track down the upload file bug','hey look at me i need the error infor',5,8,5,'/coplat/uploads/brevoy.png',1,'2015-07-01 13:22:13',NULL,NULL,NULL,NULL,NULL),(160,1022,'Close','2015-07-01 12:41:51','the addition file worked with a .png','lets try again with .txt that didnt work last time',17,8,NULL,'/coplat/uploads/DSC00004.JPG',1,'2015-07-01 13:21:24',NULL,NULL,NULL,NULL,NULL),(161,1022,'Close','2015-07-01 12:54:40','low','seeing the error for php',19,8,NULL,'/coplat/uploads/AutoBackend.php',3,'2015-07-01 12:54:40',NULL,NULL,NULL,NULL,NULL),(162,1022,'Close','2015-07-01 18:31:57','fast','lets see',1032,8,5,'',3,'2015-07-01 18:31:57',NULL,NULL,NULL,NULL,NULL),(163,1022,'Close','2015-07-02 14:18:55','This is if i can see it from test mentor','yerp',5,9,3,'',3,'2015-07-02 14:18:55',NULL,NULL,NULL,NULL,NULL),(164,1022,'Close','2015-07-07 18:20:46','YEah','looks at that',7,8,1,'',1,'2015-07-07 18:20:46',NULL,NULL,NULL,NULL,2),(165,1022,'Close','2015-07-10 10:19:58','Attach a file','this will upload a file',1032,8,5,'/coplat/uploads/CPv6-012 Out of Office Email Handler.jpg',1,'2015-07-10 10:19:58',NULL,NULL,NULL,NULL,2),(166,1022,'Close','2015-07-10 10:22:40','attach a new file','things',1033,8,5,'/coplat/uploads/CPv6-012 Out of Office Email Handler.jpg',1,'2015-07-10 10:22:40',NULL,NULL,NULL,NULL,2),(167,1022,'Close','2015-07-10 10:31:29','Upload a file','description',1038,8,NULL,'/coplat/uploads/CPv6-012 Out of Office Email Handler.jpg',1,'2015-07-10 10:31:29',NULL,NULL,NULL,NULL,2),(168,1022,'Close','2015-07-10 15:36:41','Showcase for upload','showcase the upload',19,8,NULL,'/coplat/uploads/CPv6-012 Out of Office Email Handler.jpg',1,'2015-07-10 15:36:41',NULL,NULL,NULL,NULL,2),(169,1022,'Close','2015-07-10 16:45:40','An upload showcase','A showcase to show that the system can now handle uploaded files',1038,8,NULL,'/coplat/uploads/domain.png',1,'2015-07-10 16:47:01',NULL,NULL,NULL,NULL,2),(170,1039,'Pending','2015-07-13 13:43:57','A ticket','hey i need help',5,8,5,'',1,'2015-07-28 16:34:12',NULL,NULL,NULL,NULL,NULL),(171,1046,'Pending','2015-07-24 05:31:50','asdf','ceaecfc',5,8,5,'',1,'2015-07-29 11:01:09',NULL,NULL,NULL,NULL,NULL),(172,1022,'Pending','2015-07-24 16:26:47','A ticket in ui design','a new domain',5,12,NULL,'',1,'2015-07-24 16:26:47',NULL,NULL,NULL,NULL,2),(173,1022,'Pending','2015-07-28 14:38:48','A showcase Ticket','This is a description',5,8,12,'',1,'2015-07-28 14:38:48',NULL,NULL,NULL,NULL,2),(174,1022,'Pending','2015-07-28 14:39:23','A showcase Ticket 1','A ticket to reassign',5,8,5,'',1,'2015-07-28 17:18:34',NULL,NULL,NULL,NULL,NULL),(175,1022,'Pending','2015-07-28 15:14:14','A showcase Ticket 2','populating lists',5,8,5,'',1,'2015-07-30 18:00:07',NULL,NULL,NULL,NULL,2),(176,1022,'Pending','2015-07-28 15:14:15','A showcase Ticket 2','populating lists',5,8,5,'',1,'2015-07-28 17:34:51',NULL,NULL,NULL,NULL,NULL),(177,1022,'Pending','2015-07-28 15:14:38','A showcase Ticket 3','Populating lists',1033,8,5,'',1,'2015-07-28 15:14:38',NULL,NULL,NULL,NULL,2),(178,1022,'Pending','2015-07-28 15:15:09','another test ticket 4','populating lists',5,8,5,'',1,'2015-07-30 18:00:08',NULL,NULL,NULL,NULL,2),(179,1033,'Pending','2015-07-28 16:47:27','stuff','things',5,10,9,'',1,'2015-07-29 11:01:10',NULL,NULL,NULL,NULL,NULL),(180,1027,'Pending','2015-07-28 21:21:46','Test','I need help...',5,8,1,'',1,'2015-07-30 22:30:02',NULL,NULL,NULL,NULL,1),(181,1038,'Pending','2015-07-28 21:28:45','test','I need help with...',5,8,1,'',1,'2015-07-30 21:00:04',NULL,NULL,NULL,NULL,NULL),(182,1022,'Pending','2015-07-31 10:03:37','This should generate a few reassigns','this is just to show priority reassign',5,8,5,'',1,'2015-07-31 14:00:03',NULL,NULL,NULL,NULL,NULL),(183,1022,'Pending','2015-07-31 10:04:45','an show of a email reassign','out of office reassign',1033,8,5,'',1,'2015-07-31 11:30:02',NULL,NULL,NULL,NULL,NULL),(184,5,'Pending','2015-09-19 15:19:43','What does an \'if\' do?','I just want to know.',5,8,1,'',1,'2015-09-20 01:30:02',NULL,NULL,NULL,NULL,NULL),(185,5,'Pending','2015-09-19 15:28:34','How do i program?','test',5,8,NULL,'',1,'2015-09-19 16:30:04',NULL,NULL,NULL,NULL,NULL),(186,1052,'Pending','2015-10-14 10:00:20','Can I do backend development with php?','I was just curious.',5,8,10,'',1,'2015-10-14 10:00:20',NULL,NULL,NULL,NULL,NULL),(187,5,'Pending','2015-10-14 10:03:57','Can I do backend development with php?','I was just curious.',5,8,10,'',1,'2015-10-14 10:03:57',NULL,1,NULL,NULL,NULL),(188,5,'Close','2015-10-29 22:54:43','Thing','Thing2',1052,8,NULL,'',1,'2015-10-29 22:54:43','2015-10-29 22:55:08',NULL,NULL,NULL,NULL),(189,1089,'Pending','2015-12-02 00:45:55','subject','desc',17,8,2,'',1,'2015-12-02 00:45:55',NULL,NULL,NULL,NULL,NULL),(190,1052,'Pending','2015-12-02 00:56:14','dfdf','sdfsdf',5,9,3,'',1,'2015-12-02 00:56:14',NULL,NULL,NULL,NULL,NULL),(191,1052,'Pending','2015-12-03 20:02:42','Subject','Description',1029,8,1,'',1,'2015-12-03 20:02:42',NULL,NULL,NULL,NULL,112),(192,1052,'Pending','2015-12-03 20:04:32','Subject','Description',1029,8,1,'',1,'2015-12-03 20:04:32',NULL,NULL,NULL,NULL,112),(193,1052,'Pending','2015-12-03 20:07:09','Subject','Description',1052,8,1,'',1,'2015-12-03 20:28:56',NULL,NULL,NULL,NULL,112);
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
) ENGINE=InnoDB AUTO_INCREMENT=1064 DEFAULT CHARSET=latin1 COMMENT='This table records changes in the tickets such as when is created, when is assigned by user, the status changes, when is escalated, when is commented by owner, escalated, etc';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_events`
--

LOCK TABLES `ticket_events` WRITE;
/*!40000 ALTER TABLE `ticket_events` DISABLE KEYS */;
INSERT INTO `ticket_events` VALUES (32,1,61,'2015-02-01 20:51:10',NULL,NULL,NULL,10),(33,1,62,'2015-02-24 21:04:16',NULL,NULL,NULL,10),(34,4,61,'2015-02-24 21:49:56',NULL,'231',NULL,10),(35,4,61,'2015-02-24 22:01:43',NULL,'232',NULL,10),(36,4,61,'2015-02-24 22:02:43',NULL,'233',NULL,10),(37,2,60,'2015-02-24 22:32:34','Pending','Close',NULL,10),(38,2,61,'2015-02-24 22:37:50','Pending','Close',NULL,10),(39,2,62,'2015-02-24 22:41:07','Pending','Reject',NULL,10),(40,1,63,'2015-02-25 18:28:31',NULL,NULL,NULL,10),(41,3,63,'2015-02-25 19:15:35','7','19',NULL,5),(42,1,65,'2015-02-25 21:27:01',NULL,NULL,NULL,10),(43,6,65,'2015-02-25 21:29:24',NULL,'66',NULL,5),(44,1,66,'2015-02-25 21:29:55',NULL,NULL,NULL,5),(45,7,66,'2015-02-25 21:30:17','65',NULL,NULL,5),(46,4,65,'2015-02-26 19:17:47',NULL,'241',NULL,10),(47,4,65,'2015-02-26 19:17:58',NULL,'242',NULL,10),(48,4,65,'2015-02-26 19:18:19',NULL,'243',NULL,10),(49,4,65,'2015-02-26 19:19:06',NULL,'244',NULL,10),(53,8,65,'2015-02-26 20:44:37',NULL,NULL,NULL,10),(54,8,65,'2015-02-26 20:45:46',NULL,NULL,NULL,10),(55,8,65,'2015-02-26 20:45:53',NULL,NULL,NULL,10),(56,8,65,'2015-02-26 20:46:46',NULL,NULL,NULL,10),(57,8,65,'2015-02-26 20:46:53',NULL,NULL,NULL,10),(58,8,65,'2015-02-26 20:46:59',NULL,NULL,NULL,10),(59,8,65,'2015-02-26 20:47:40',NULL,NULL,NULL,10),(60,8,65,'2015-02-26 21:18:25',NULL,NULL,NULL,10),(61,8,65,'2015-02-27 22:55:45',NULL,NULL,NULL,10),(62,8,63,'2015-02-27 22:57:25',NULL,NULL,NULL,10),(63,9,63,'2015-02-27 22:58:57',NULL,NULL,NULL,19),(64,8,65,'2015-02-27 23:03:48',NULL,NULL,NULL,10),(65,1,67,'2015-02-27 23:27:37',NULL,NULL,NULL,10),(66,8,67,'2015-02-27 23:27:54',NULL,NULL,NULL,10),(67,1,68,'2015-02-27 23:56:36',NULL,NULL,NULL,10),(68,8,68,'2015-02-27 23:56:37',NULL,NULL,NULL,10),(69,2,68,'2015-03-01 11:36:08','Pending','Close',NULL,10),(70,2,68,'2015-03-01 11:36:22','Close','Close',NULL,10),(71,8,68,'2015-03-01 11:36:24',NULL,NULL,NULL,10),(72,8,67,'2015-03-01 11:36:36',NULL,NULL,NULL,10),(73,2,67,'2015-03-01 11:36:42','Pending','Close',NULL,10),(74,8,52,'2015-03-01 12:13:08',NULL,NULL,NULL,5),(75,8,52,'2015-03-01 12:13:13',NULL,NULL,NULL,5),(76,8,65,'2015-03-02 17:24:28',NULL,NULL,NULL,10),(77,8,65,'2015-03-02 17:24:45',NULL,NULL,NULL,10),(78,8,66,'2015-03-02 17:32:29',NULL,NULL,NULL,5),(79,8,66,'2015-03-02 17:39:30',NULL,NULL,NULL,5),(80,9,41,'2015-03-02 18:21:33',NULL,NULL,NULL,5),(81,8,66,'2015-03-02 18:21:40',NULL,NULL,NULL,5),(82,8,66,'2015-03-02 18:21:53',NULL,NULL,NULL,5),(83,9,62,'2015-03-02 18:28:56',NULL,NULL,NULL,7),(84,9,65,'2015-03-02 18:29:04',NULL,NULL,NULL,7),(85,8,63,'2015-03-15 13:49:01',NULL,NULL,NULL,10),(86,1,70,'2015-03-17 22:48:44',NULL,NULL,NULL,10),(87,8,70,'2015-03-17 22:48:53',NULL,NULL,NULL,10),(88,1,72,'2015-03-17 22:49:55',NULL,NULL,NULL,10),(89,8,72,'2015-03-17 22:49:56',NULL,NULL,NULL,10),(90,1,74,'2015-03-17 22:54:17',NULL,NULL,NULL,10),(91,8,74,'2015-03-17 22:54:19',NULL,NULL,NULL,10),(92,1,75,'2015-03-17 22:55:04',NULL,NULL,NULL,10),(93,8,75,'2015-03-17 22:55:06',NULL,NULL,NULL,10),(94,8,75,'2015-03-24 15:33:05',NULL,NULL,NULL,10),(95,8,62,'2015-03-24 15:33:13',NULL,NULL,NULL,10),(96,8,65,'2015-03-24 15:33:20',NULL,NULL,NULL,10),(97,8,72,'2015-03-24 15:33:32',NULL,NULL,NULL,10),(98,9,75,'2015-03-24 15:33:55',NULL,NULL,NULL,5),(99,5,75,'2015-03-24 15:34:07',NULL,'248',NULL,5),(100,5,75,'2015-03-24 15:34:41',NULL,'249',NULL,5),(101,5,75,'2015-03-24 15:34:41',NULL,'250',NULL,5),(102,9,75,'2015-03-24 15:34:42',NULL,NULL,NULL,5),(103,9,75,'2015-03-24 15:34:43',NULL,NULL,NULL,5),(104,9,75,'2015-03-24 15:34:44',NULL,NULL,NULL,5),(105,9,75,'2015-03-24 15:35:42',NULL,NULL,NULL,5),(106,9,75,'2015-03-24 15:38:44',NULL,NULL,NULL,5),(107,9,75,'2015-03-24 15:38:50',NULL,NULL,NULL,5),(108,9,75,'2015-03-24 15:39:28',NULL,NULL,NULL,5),(109,1,76,'2015-04-01 21:02:36',NULL,NULL,NULL,5),(110,8,76,'2015-04-01 21:03:12',NULL,NULL,NULL,5),(111,1,77,'2015-04-01 21:03:42',NULL,NULL,NULL,5),(112,8,77,'2015-04-01 21:03:44',NULL,NULL,NULL,5),(113,1,78,'2015-04-01 21:05:45',NULL,NULL,NULL,6),(114,8,78,'2015-04-01 21:05:47',NULL,NULL,NULL,6),(115,1,79,'2015-04-01 21:07:13',NULL,NULL,NULL,19),(116,8,79,'2015-04-01 21:07:15',NULL,NULL,NULL,19),(117,1,80,'2015-04-02 21:11:27',NULL,NULL,NULL,6),(118,8,80,'2015-04-02 21:11:45',NULL,NULL,NULL,6),(119,1,81,'2015-06-05 12:32:54',NULL,NULL,NULL,5),(120,8,81,'2015-06-05 12:32:56',NULL,NULL,NULL,5),(121,1,82,'2015-06-05 16:06:23',NULL,NULL,NULL,5),(122,8,82,'2015-06-05 16:06:24',NULL,NULL,NULL,5),(123,1,83,'2015-06-08 11:22:26',NULL,NULL,NULL,5),(124,8,83,'2015-06-08 11:22:28',NULL,NULL,NULL,5),(125,1,84,'2015-06-08 11:22:58',NULL,NULL,NULL,5),(126,8,84,'2015-06-08 11:22:59',NULL,NULL,NULL,5),(127,1,85,'2015-06-08 11:26:24',NULL,NULL,NULL,5),(128,8,85,'2015-06-08 11:26:26',NULL,NULL,NULL,5),(129,1,86,'2015-06-08 11:31:52',NULL,NULL,NULL,5),(130,8,86,'2015-06-08 11:31:54',NULL,NULL,NULL,5),(131,1,87,'2015-06-08 11:32:54',NULL,NULL,NULL,1022),(132,8,87,'2015-06-08 11:32:56',NULL,NULL,NULL,1022),(133,1,88,'2015-06-08 11:33:27',NULL,NULL,NULL,1022),(134,8,88,'2015-06-08 11:33:29',NULL,NULL,NULL,1022),(135,8,87,'2015-06-08 17:53:16',NULL,NULL,NULL,1022),(136,8,88,'2015-06-08 17:53:22',NULL,NULL,NULL,1022),(137,9,81,'2015-06-08 19:41:55',NULL,NULL,NULL,1032),(138,1,89,'2015-06-09 16:17:31',NULL,NULL,NULL,5),(139,10,89,'2015-06-09 16:17:32',NULL,NULL,NULL,5),(140,8,89,'2015-06-09 16:17:33',NULL,NULL,NULL,5),(141,10,77,'2015-06-09 16:18:16',NULL,NULL,NULL,1032),(142,9,77,'2015-06-09 16:18:16',NULL,NULL,NULL,1032),(143,1,90,'2015-06-09 17:27:23',NULL,NULL,NULL,5),(144,10,90,'2015-06-09 17:27:24',NULL,NULL,NULL,5),(145,8,90,'2015-06-09 17:27:25',NULL,NULL,NULL,5),(146,1,91,'2015-06-09 17:27:50',NULL,NULL,NULL,5),(147,10,91,'2015-06-09 17:27:52',NULL,NULL,NULL,5),(148,8,91,'2015-06-09 17:27:53',NULL,NULL,NULL,5),(149,1,92,'2015-06-09 17:28:13',NULL,NULL,NULL,5),(150,10,92,'2015-06-09 17:28:14',NULL,NULL,NULL,5),(151,8,92,'2015-06-09 17:28:15',NULL,NULL,NULL,5),(152,1,93,'2015-06-09 17:51:42',NULL,NULL,NULL,5),(153,10,93,'2015-06-09 17:51:43',NULL,NULL,NULL,5),(154,8,93,'2015-06-09 17:51:43',NULL,NULL,NULL,5),(155,1,94,'2015-06-09 18:20:25',NULL,NULL,NULL,5),(156,10,94,'2015-06-09 18:20:26',NULL,NULL,NULL,5),(157,8,94,'2015-06-09 18:20:26',NULL,NULL,NULL,5),(158,1,95,'2015-06-09 18:21:07',NULL,NULL,NULL,5),(159,10,95,'2015-06-09 18:21:09',NULL,NULL,NULL,5),(160,8,95,'2015-06-09 18:21:09',NULL,NULL,NULL,5),(217,9,96,'2015-06-09 19:15:33',NULL,NULL,NULL,1033),(219,9,96,'2015-06-09 19:15:36',NULL,NULL,NULL,1033),(225,5,46,'2015-06-09 19:33:29',NULL,NULL,NULL,5),(226,8,46,'2015-06-09 19:33:29',NULL,NULL,NULL,5),(227,5,46,'2015-06-09 19:33:33',NULL,NULL,NULL,5),(228,8,46,'2015-06-09 19:33:33',NULL,NULL,NULL,5),(232,5,77,'2015-06-10 10:09:50',NULL,NULL,NULL,1033),(233,9,77,'2015-06-10 10:09:51',NULL,NULL,NULL,1033),(234,1,98,'2015-06-10 14:45:50',NULL,NULL,NULL,5),(235,8,98,'2015-06-10 14:45:51',NULL,NULL,NULL,5),(236,1,99,'2015-06-10 14:46:26',NULL,NULL,NULL,5),(237,8,99,'2015-06-10 14:46:27',NULL,NULL,NULL,5),(238,9,70,'2015-06-10 15:07:29',NULL,NULL,NULL,1032),(239,1,100,'2015-06-10 16:39:52',NULL,NULL,NULL,5),(240,8,100,'2015-06-10 16:39:55',NULL,NULL,NULL,5),(241,1,101,'2015-06-10 16:40:51',NULL,NULL,NULL,5),(242,8,101,'2015-06-10 16:40:55',NULL,NULL,NULL,5),(243,1,102,'2015-06-10 16:41:38',NULL,NULL,NULL,5),(244,8,102,'2015-06-10 16:41:39',NULL,NULL,NULL,5),(245,9,102,'2015-06-10 16:42:32',NULL,NULL,NULL,1032),(246,9,102,'2015-06-10 16:42:43',NULL,NULL,NULL,1032),(247,9,94,'2015-06-10 17:51:10',NULL,NULL,NULL,1032),(248,9,94,'2015-06-10 17:51:21',NULL,NULL,NULL,1032),(249,9,102,'2015-06-10 17:51:36',NULL,NULL,NULL,1032),(250,9,102,'2015-06-10 17:51:52',NULL,NULL,NULL,1032),(251,9,94,'2015-06-10 17:51:58',NULL,NULL,NULL,1032),(252,9,83,'2015-06-10 18:08:40',NULL,NULL,NULL,1026),(253,9,88,'2015-06-10 18:09:01',NULL,NULL,NULL,1026),(254,9,89,'2015-06-10 18:17:17',NULL,NULL,NULL,1033),(255,9,84,'2015-06-10 18:30:10',NULL,NULL,NULL,1026),(256,1,103,'2015-06-11 14:17:39',NULL,NULL,NULL,5),(257,8,103,'2015-06-11 14:17:40',NULL,NULL,NULL,5),(258,9,41,'2015-06-11 14:50:02',NULL,NULL,NULL,5),(259,9,41,'2015-06-11 14:50:19',NULL,NULL,NULL,5),(260,9,72,'2015-06-11 14:50:33',NULL,NULL,NULL,5),(261,8,65,'2015-06-11 15:15:24',NULL,NULL,NULL,10),(262,8,77,'2015-06-11 15:25:06',NULL,NULL,NULL,5),(263,8,89,'2015-06-11 15:25:32',NULL,NULL,NULL,5),(264,8,89,'2015-06-11 15:25:51',NULL,NULL,NULL,5),(265,9,103,'2015-06-11 15:26:21',NULL,NULL,NULL,1032),(266,9,90,'2015-06-11 15:26:44',NULL,NULL,NULL,1033),(267,9,77,'2015-06-11 15:26:48',NULL,NULL,NULL,1033),(268,9,90,'2015-06-11 15:26:55',NULL,NULL,NULL,1033),(269,9,96,'2015-06-11 15:27:00',NULL,NULL,NULL,1033),(271,1,104,'2015-06-11 15:58:31',NULL,NULL,NULL,5),(272,8,104,'2015-06-11 15:58:33',NULL,NULL,NULL,5),(273,1,105,'2015-06-11 15:59:14',NULL,NULL,NULL,5),(274,8,105,'2015-06-11 15:59:16',NULL,NULL,NULL,5),(275,9,103,'2015-06-11 16:17:06',NULL,NULL,NULL,1032),(276,9,105,'2015-06-11 16:17:14',NULL,NULL,NULL,1032),(277,1,106,'2015-06-11 16:18:30',NULL,NULL,NULL,5),(278,8,106,'2015-06-11 16:18:31',NULL,NULL,NULL,5),(279,1,107,'2015-06-11 16:19:12',NULL,NULL,NULL,5),(280,8,107,'2015-06-11 16:19:13',NULL,NULL,NULL,5),(281,1,108,'2015-06-11 16:19:44',NULL,NULL,NULL,5),(282,8,108,'2015-06-11 16:19:45',NULL,NULL,NULL,5),(283,1,109,'2015-06-11 16:23:50',NULL,NULL,NULL,5),(284,8,109,'2015-06-11 16:23:51',NULL,NULL,NULL,5),(285,1,110,'2015-06-11 16:28:30',NULL,NULL,NULL,5),(286,8,110,'2015-06-11 16:28:32',NULL,NULL,NULL,5),(287,10,103,'2015-06-11 16:30:03','1032','5',NULL,5),(288,10,105,'2015-06-11 16:49:58','1032','5',NULL,5),(289,10,108,'2015-06-11 16:49:58','1032','5',NULL,5),(290,10,109,'2015-06-11 16:49:58','1032','5',NULL,5),(291,10,110,'2015-06-11 16:49:58','1032','5',NULL,5),(292,10,104,'2015-06-11 17:00:02','1034','5',NULL,5),(293,1,111,'2015-06-11 17:05:33',NULL,NULL,NULL,5),(294,8,111,'2015-06-11 17:05:35',NULL,NULL,NULL,5),(295,1,112,'2015-06-11 17:16:46',NULL,NULL,NULL,5),(296,8,112,'2015-06-11 17:16:48',NULL,NULL,NULL,5),(297,10,106,'2015-06-11 17:20:02','1034','1032',NULL,5),(298,10,107,'2015-06-11 17:20:05','7','1013',NULL,5),(299,9,106,'2015-06-11 17:52:30',NULL,NULL,NULL,1032),(300,9,111,'2015-06-11 17:52:42',NULL,NULL,NULL,1032),(301,1,113,'2015-06-11 18:00:03',NULL,NULL,NULL,5),(302,8,113,'2015-06-11 18:00:05',NULL,NULL,NULL,5),(303,1,114,'2015-06-11 18:00:25',NULL,NULL,NULL,5),(304,8,114,'2015-06-11 18:00:26',NULL,NULL,NULL,5),(305,1,115,'2015-06-11 18:00:42',NULL,NULL,NULL,5),(306,8,115,'2015-06-11 18:00:43',NULL,NULL,NULL,5),(307,10,106,'2015-06-11 18:01:37','1032','1035',NULL,5),(308,10,111,'2015-06-11 18:01:38','1032','1022',NULL,5),(309,10,115,'2015-06-11 18:01:39','1032','1035',NULL,5),(310,10,106,'2015-06-11 18:14:03','1035','1022',NULL,5),(311,10,113,'2015-06-11 18:14:04','1035','1022',NULL,5),(312,10,115,'2015-06-11 18:14:05','1035','1022',NULL,5),(313,10,107,'2015-06-11 18:21:47','1013','10',NULL,5),(314,10,112,'2015-06-11 18:21:49','1022','5',NULL,5),(315,10,106,'2015-06-11 19:20:47','1022','5',NULL,5),(316,10,111,'2015-06-11 19:20:48','1022','5',NULL,5),(317,10,113,'2015-06-11 19:20:49','1022','5',NULL,5),(318,10,114,'2015-06-11 19:20:50','1022','5',NULL,5),(319,10,115,'2015-06-11 19:20:51','1022','5',NULL,5),(320,1,116,'2015-06-12 00:08:53',NULL,NULL,NULL,5),(321,8,116,'2015-06-12 00:08:55',NULL,NULL,NULL,5),(322,10,116,'2015-06-12 00:09:25','1032','1022',NULL,5),(323,9,96,'2015-06-12 00:11:17',NULL,NULL,NULL,1033),(324,9,96,'2015-06-12 00:12:31',NULL,NULL,NULL,1033),(325,9,77,'2015-06-12 00:12:50',NULL,NULL,NULL,1033),(326,9,96,'2015-06-12 00:13:02',NULL,NULL,NULL,1033),(327,10,96,'2015-06-12 00:14:13','1033','1022',NULL,5),(328,9,96,'2015-06-12 00:14:22',NULL,NULL,NULL,1033),(329,5,96,'2015-06-12 00:22:24',NULL,'251',NULL,1033),(330,9,96,'2015-06-12 00:22:26',NULL,NULL,NULL,1033),(331,9,96,'2015-06-12 00:22:31',NULL,NULL,NULL,1033),(332,8,46,'2015-06-12 00:26:43',NULL,NULL,NULL,5),(333,9,75,'2015-06-12 00:27:10',NULL,NULL,NULL,5),(334,8,107,'2015-06-12 00:28:00',NULL,NULL,NULL,5),(335,8,107,'2015-06-12 00:28:12',NULL,NULL,NULL,5),(336,10,46,'2015-06-12 00:33:37','1013','17',NULL,5),(337,10,75,'2015-06-12 00:33:39','17','8',NULL,5),(338,10,107,'2015-06-12 00:33:41','10','1032',NULL,5),(339,9,107,'2015-06-12 00:34:28',NULL,NULL,NULL,1032),(340,9,107,'2015-06-12 00:35:00',NULL,NULL,NULL,1032),(341,9,107,'2015-06-12 01:51:48',NULL,NULL,NULL,1032),(342,9,107,'2015-06-12 03:05:43',NULL,NULL,NULL,1032),(343,10,96,'2015-06-12 06:30:03','1022','1032',NULL,5),(344,10,116,'2015-06-12 06:30:05','1022','1032',NULL,5),(345,10,75,'2015-06-12 07:00:03','8','5',NULL,5),(346,10,96,'2015-06-12 13:00:03','1032','5',NULL,5),(347,10,116,'2015-06-12 13:00:04','1032','5',NULL,5),(349,1,117,'2015-06-12 14:56:02',NULL,NULL,NULL,5),(350,8,117,'2015-06-12 14:56:03',NULL,NULL,NULL,5),(351,8,117,'2015-06-12 14:56:50',NULL,NULL,NULL,5),(352,8,117,'2015-06-12 14:56:54',NULL,NULL,NULL,5),(353,8,117,'2015-06-12 14:56:58',NULL,NULL,NULL,5),(354,8,117,'2015-06-12 14:57:00',NULL,NULL,NULL,5),(355,8,117,'2015-06-12 14:57:02',NULL,NULL,NULL,5),(356,8,117,'2015-06-12 14:57:04',NULL,NULL,NULL,5),(357,8,117,'2015-06-12 14:57:13',NULL,NULL,NULL,5),(358,8,117,'2015-06-12 14:57:16',NULL,NULL,NULL,5),(359,8,117,'2015-06-12 14:57:38',NULL,NULL,NULL,5),(360,8,117,'2015-06-12 14:57:47',NULL,NULL,NULL,5),(361,8,117,'2015-06-12 14:58:16',NULL,NULL,NULL,5),(362,8,117,'2015-06-12 14:58:19',NULL,NULL,NULL,5),(363,10,117,'2015-06-12 14:58:50','1032','1033',NULL,5),(364,8,117,'2015-06-12 14:58:55',NULL,NULL,NULL,5),(365,8,117,'2015-06-12 15:00:35',NULL,NULL,NULL,5),(366,8,117,'2015-06-12 15:01:20',NULL,NULL,NULL,5),(367,8,117,'2015-06-12 15:01:22',NULL,NULL,NULL,5),(368,10,117,'2015-06-12 15:02:01','1033','1032',NULL,5),(369,8,117,'2015-06-12 15:02:25',NULL,NULL,NULL,5),(370,8,117,'2015-06-12 15:02:49',NULL,NULL,NULL,5),(371,1,118,'2015-06-12 15:03:55',NULL,NULL,NULL,5),(372,8,118,'2015-06-12 15:03:57',NULL,NULL,NULL,5),(373,10,117,'2015-06-12 15:04:01','1032','1033',NULL,5),(374,8,117,'2015-06-12 15:04:04',NULL,NULL,NULL,5),(375,8,117,'2015-06-12 15:04:06',NULL,NULL,NULL,5),(376,8,118,'2015-06-12 15:04:11',NULL,NULL,NULL,5),(377,8,118,'2015-06-12 15:04:13',NULL,NULL,NULL,5),(378,8,118,'2015-06-12 15:04:24',NULL,NULL,NULL,5),(379,1,119,'2015-06-12 15:04:56',NULL,NULL,NULL,5),(380,8,119,'2015-06-12 15:04:57',NULL,NULL,NULL,5),(381,8,118,'2015-06-12 15:05:11',NULL,NULL,NULL,5),(382,8,118,'2015-06-12 15:05:13',NULL,NULL,NULL,5),(383,8,118,'2015-06-12 15:05:15',NULL,NULL,NULL,5),(384,8,118,'2015-06-12 15:05:17',NULL,NULL,NULL,5),(385,8,118,'2015-06-12 15:05:19',NULL,NULL,NULL,5),(386,10,117,'2015-06-12 15:06:01','1033','1032',NULL,5),(387,10,118,'2015-06-12 15:06:01','1033','1032',NULL,5),(388,8,118,'2015-06-12 15:09:09',NULL,NULL,NULL,5),(389,8,118,'2015-06-12 15:09:53',NULL,NULL,NULL,5),(390,8,117,'2015-06-12 15:10:03',NULL,NULL,NULL,5),(391,10,117,'2015-06-12 15:12:01','1032','1033',NULL,5),(392,10,118,'2015-06-12 15:12:01','1032','1033',NULL,5),(393,10,119,'2015-06-12 15:12:01','1032','1033',NULL,5),(394,10,117,'2015-06-12 15:14:01','1033','1032',NULL,5),(395,10,118,'2015-06-12 15:14:01','1033','1032',NULL,5),(396,10,119,'2015-06-12 15:14:01','1033','1032',NULL,5),(397,10,117,'2015-06-12 15:16:01','1032','1033',NULL,5),(398,10,118,'2015-06-12 15:16:01','1032','1033',NULL,5),(399,10,119,'2015-06-12 15:16:01','1032','1033',NULL,5),(400,9,117,'2015-06-12 15:17:29',NULL,NULL,NULL,1033),(401,5,117,'2015-06-12 15:17:41',NULL,'252',NULL,1033),(402,5,117,'2015-06-12 15:17:42',NULL,'253',NULL,1033),(403,5,117,'2015-06-12 15:17:43',NULL,'254',NULL,1033),(404,5,117,'2015-06-12 15:17:44',NULL,'255',NULL,1033),(405,5,117,'2015-06-12 15:17:45',NULL,'256',NULL,1033),(406,9,117,'2015-06-12 15:17:47',NULL,NULL,NULL,1033),(407,5,117,'2015-06-12 15:17:47',NULL,'257',NULL,1033),(408,5,117,'2015-06-12 15:17:48',NULL,'258',NULL,1033),(409,5,117,'2015-06-12 15:17:49',NULL,'259',NULL,1033),(410,5,117,'2015-06-12 15:17:50',NULL,'260',NULL,1033),(411,5,117,'2015-06-12 15:17:51',NULL,'261',NULL,1033),(412,9,117,'2015-06-12 15:17:52',NULL,NULL,NULL,1033),(413,9,117,'2015-06-12 15:17:52',NULL,NULL,NULL,1033),(414,9,117,'2015-06-12 15:17:53',NULL,NULL,NULL,1033),(415,9,117,'2015-06-12 15:17:53',NULL,NULL,NULL,1033),(416,9,117,'2015-06-12 15:17:53',NULL,NULL,NULL,1033),(417,5,117,'2015-06-12 15:17:53',NULL,'262',NULL,1033),(418,5,117,'2015-06-12 15:17:54',NULL,'263',NULL,1033),(419,5,117,'2015-06-12 15:17:55',NULL,'264',NULL,1033),(420,5,117,'2015-06-12 15:17:56',NULL,'265',NULL,1033),(421,10,118,'2015-06-12 15:18:01','1033','1032',NULL,5),(422,10,119,'2015-06-12 15:18:01','1033','1032',NULL,5),(423,9,117,'2015-06-12 15:18:12',NULL,NULL,NULL,1033),(424,9,117,'2015-06-12 15:18:47',NULL,NULL,NULL,1033),(425,1,120,'2015-06-12 15:28:56',NULL,NULL,NULL,5),(426,8,120,'2015-06-12 15:28:57',NULL,NULL,NULL,5),(427,1,121,'2015-06-12 15:30:51',NULL,NULL,NULL,5),(428,8,121,'2015-06-12 15:30:52',NULL,NULL,NULL,5),(429,1,122,'2015-06-12 15:31:19',NULL,NULL,NULL,5),(430,8,122,'2015-06-12 15:31:20',NULL,NULL,NULL,5),(431,10,118,'2015-06-12 15:32:01','1032','1033',NULL,5),(432,10,119,'2015-06-12 15:32:02','1032','1033',NULL,5),(433,10,122,'2015-06-12 15:32:03','1032','1033',NULL,5),(434,9,117,'2015-06-12 16:27:01',NULL,NULL,NULL,1033),(435,9,118,'2015-06-12 16:27:11',NULL,NULL,NULL,1033),(436,8,117,'2015-06-12 16:32:19',NULL,NULL,NULL,5),(437,9,119,'2015-06-12 16:34:30',NULL,NULL,NULL,1033),(438,9,122,'2015-06-12 16:34:35',NULL,NULL,NULL,1033),(439,9,117,'2015-06-12 16:35:26',NULL,NULL,NULL,1033),(440,9,117,'2015-06-12 16:39:09',NULL,NULL,NULL,1033),(441,9,42,'2015-06-12 16:52:44',NULL,NULL,NULL,5),(442,9,41,'2015-06-12 16:52:49',NULL,NULL,NULL,5),(443,8,48,'2015-06-12 16:53:31',NULL,NULL,NULL,5),(444,8,52,'2015-06-12 16:53:35',NULL,NULL,NULL,5),(445,8,48,'2015-06-12 16:53:47',NULL,NULL,NULL,5),(446,1,123,'2015-06-12 17:15:21',NULL,NULL,NULL,1022),(447,8,123,'2015-06-12 17:15:22',NULL,NULL,NULL,1022),(448,1,124,'2015-06-12 17:15:42',NULL,NULL,NULL,1022),(449,8,124,'2015-06-12 17:15:44',NULL,NULL,NULL,1022),(450,1,125,'2015-06-12 17:16:38',NULL,NULL,NULL,1022),(451,8,125,'2015-06-12 17:16:40',NULL,NULL,NULL,1022),(452,1,126,'2015-06-12 17:17:00',NULL,NULL,NULL,1022),(453,8,126,'2015-06-12 17:17:01',NULL,NULL,NULL,1022),(454,1,127,'2015-06-12 17:18:11',NULL,NULL,NULL,1022),(455,8,127,'2015-06-12 17:18:12',NULL,NULL,NULL,1022),(456,10,124,'2015-06-12 17:20:01','1032','1033',NULL,5),(457,10,127,'2015-06-12 17:20:02','1032','1034',NULL,5),(458,8,127,'2015-06-12 17:20:39',NULL,NULL,NULL,1022),(459,9,125,'2015-06-12 17:22:53',NULL,NULL,NULL,1033),(460,9,117,'2015-06-12 17:23:00',NULL,NULL,NULL,1033),(461,9,119,'2015-06-12 17:23:14',NULL,NULL,NULL,1033),(462,10,120,'2015-06-12 17:24:03','1026','1033',NULL,5),(463,10,118,'2015-06-12 17:24:05','1033','1034',NULL,5),(464,10,119,'2015-06-12 17:24:07','1033','1034',NULL,5),(465,10,121,'2015-06-12 17:24:09','1033','1034',NULL,5),(466,10,122,'2015-06-12 17:24:11','1033','1034',NULL,5),(467,9,119,'2015-06-12 17:24:48',NULL,NULL,NULL,1033),(468,9,117,'2015-06-12 17:26:30',NULL,NULL,NULL,1033),(469,9,117,'2015-06-16 13:29:44',NULL,NULL,NULL,1033),(470,10,118,'2015-06-16 14:05:51','1034','5',NULL,5),(471,10,119,'2015-06-16 14:05:52','1034','5',NULL,5),(472,10,120,'2015-06-16 14:05:53','1033','1035',NULL,5),(473,10,121,'2015-06-16 14:05:56','1034','1032',NULL,5),(474,10,122,'2015-06-16 14:05:58','1034','1034',NULL,5),(475,10,123,'2015-06-16 14:06:00','1034','1033',NULL,5),(476,10,124,'2015-06-16 14:06:02','1033','1035',NULL,5),(477,10,125,'2015-06-16 14:06:04','1033','1032',NULL,5),(478,10,126,'2015-06-16 14:06:06','1034','1034',NULL,5),(479,10,127,'2015-06-16 14:06:08','1034','1033',NULL,5),(480,9,117,'2015-06-16 14:09:18',NULL,NULL,NULL,1033),(481,9,123,'2015-06-16 14:09:28',NULL,NULL,NULL,1033),(482,9,123,'2015-06-16 14:09:42',NULL,NULL,NULL,1033),(483,9,123,'2015-06-16 14:09:55',NULL,NULL,NULL,1033),(484,10,121,'2015-06-16 15:52:43','1032','1035',NULL,5),(485,10,125,'2015-06-16 15:52:45','1032','1032',NULL,5),(486,10,123,'2015-06-16 15:52:47','1033','1033',NULL,5),(487,10,127,'2015-06-16 15:52:49','1033','1035',NULL,5),(488,10,122,'2015-06-16 15:52:51','1034','5',NULL,5),(489,10,126,'2015-06-16 15:52:52','1034','1032',NULL,5),(490,10,120,'2015-06-16 15:52:55','1035','1034',NULL,5),(491,10,124,'2015-06-16 15:52:57','1035','1035',NULL,5),(492,8,87,'2015-06-16 16:12:50',NULL,NULL,NULL,1022),(493,8,88,'2015-06-16 16:13:13',NULL,NULL,NULL,1022),(494,8,88,'2015-06-16 16:13:19',NULL,NULL,NULL,1022),(495,8,123,'2015-06-16 16:13:29',NULL,NULL,NULL,1022),(496,8,123,'2015-06-16 16:13:39',NULL,NULL,NULL,1022),(497,8,125,'2015-06-16 16:13:46',NULL,NULL,NULL,1022),(498,8,124,'2015-06-16 16:13:53',NULL,NULL,NULL,1022),(499,8,127,'2015-06-16 16:49:05',NULL,NULL,NULL,1022),(500,8,126,'2015-06-16 16:49:10',NULL,NULL,NULL,1022),(501,8,125,'2015-06-16 16:49:14',NULL,NULL,NULL,1022),(502,8,87,'2015-06-16 16:58:53',NULL,NULL,NULL,1022),(503,8,88,'2015-06-16 16:59:04',NULL,NULL,NULL,1022),(504,8,123,'2015-06-16 16:59:16',NULL,NULL,NULL,1022),(505,8,124,'2015-06-16 16:59:53',NULL,NULL,NULL,1022),(506,8,125,'2015-06-16 17:00:11',NULL,NULL,NULL,1022),(507,8,126,'2015-06-16 17:00:26',NULL,NULL,NULL,1022),(508,8,127,'2015-06-16 17:00:40',NULL,NULL,NULL,1022),(509,10,125,'2015-06-16 17:02:01','1032',NULL,NULL,5),(510,10,126,'2015-06-16 17:02:03','1032',NULL,NULL,5),(511,10,123,'2015-06-16 17:02:05','1033',NULL,NULL,5),(512,10,120,'2015-06-16 17:02:07','1034','5',NULL,5),(513,10,121,'2015-06-16 17:02:08','1035','5',NULL,5),(514,10,124,'2015-06-16 17:02:09','1035','5',NULL,5),(515,10,127,'2015-06-16 17:02:10','1035','5',NULL,5),(516,8,123,'2015-06-16 17:02:26',NULL,NULL,NULL,1022),(517,8,88,'2015-06-16 17:02:35',NULL,NULL,NULL,1022),(518,8,124,'2015-06-16 17:02:38',NULL,NULL,NULL,1022),(519,8,125,'2015-06-16 17:02:47',NULL,NULL,NULL,1022),(520,8,126,'2015-06-16 17:03:00',NULL,NULL,NULL,1022),(521,8,127,'2015-06-16 17:03:07',NULL,NULL,NULL,1022),(522,1,128,'2015-06-16 17:13:14',NULL,NULL,NULL,1022),(523,8,128,'2015-06-16 17:13:15',NULL,NULL,NULL,1022),(524,1,129,'2015-06-16 17:13:58',NULL,NULL,NULL,1022),(525,8,129,'2015-06-16 17:14:00',NULL,NULL,NULL,1022),(526,8,128,'2015-06-16 17:14:06',NULL,NULL,NULL,1022),(527,8,129,'2015-06-16 17:14:09',NULL,NULL,NULL,1022),(528,8,128,'2015-06-16 17:16:09',NULL,NULL,NULL,1022),(529,8,128,'2015-06-16 17:16:33',NULL,NULL,NULL,1022),(530,1,130,'2015-06-16 17:17:21',NULL,NULL,NULL,1022),(531,8,130,'2015-06-16 17:17:23',NULL,NULL,NULL,1022),(532,1,131,'2015-06-16 17:18:19',NULL,NULL,NULL,1022),(533,8,131,'2015-06-16 17:18:20',NULL,NULL,NULL,1022),(534,9,131,'2015-06-16 17:19:22',NULL,NULL,NULL,1032),(535,1,132,'2015-06-16 17:27:05',NULL,NULL,NULL,1022),(536,8,132,'2015-06-16 17:27:07',NULL,NULL,NULL,1022),(537,1,133,'2015-06-16 17:27:36',NULL,NULL,NULL,1022),(538,8,133,'2015-06-16 17:27:37',NULL,NULL,NULL,1022),(539,8,132,'2015-06-16 17:27:53',NULL,NULL,NULL,1022),(540,8,133,'2015-06-16 17:28:10',NULL,NULL,NULL,1022),(541,9,131,'2015-06-16 17:58:00',NULL,NULL,NULL,1033),(542,5,131,'2015-06-16 17:58:11',NULL,'266',NULL,1033),(543,9,131,'2015-06-16 17:58:12',NULL,NULL,NULL,1033),(544,9,130,'2015-06-16 17:58:18',NULL,NULL,NULL,1033),(545,5,130,'2015-06-16 17:58:29',NULL,'267',NULL,1033),(546,9,130,'2015-06-16 17:58:31',NULL,NULL,NULL,1033),(547,9,128,'2015-06-16 17:59:06',NULL,NULL,NULL,1033),(548,9,133,'2015-06-16 17:59:13',NULL,NULL,NULL,1033),(549,8,133,'2015-06-16 18:15:44',NULL,NULL,NULL,1022),(550,8,133,'2015-06-16 18:16:00',NULL,NULL,NULL,1022),(551,8,132,'2015-06-16 18:16:09',NULL,NULL,NULL,1022),(552,10,132,'2015-06-16 18:32:01','1032','1033',NULL,5),(553,10,123,'2015-06-16 18:32:01','1033','1032',NULL,5),(554,10,126,'2015-06-16 18:32:01','1033','1032',NULL,5),(555,10,128,'2015-06-16 18:32:01','1033','1032',NULL,5),(556,10,129,'2015-06-16 18:32:01','1033','1032',NULL,5),(557,10,133,'2015-06-16 18:32:01','1033','1032',NULL,5),(558,10,125,'2015-06-16 18:32:01','1034','1032',NULL,5),(559,8,132,'2015-06-16 18:32:05',NULL,NULL,NULL,1022),(560,8,133,'2015-06-16 18:32:15',NULL,NULL,NULL,1022),(561,8,130,'2015-06-16 18:32:39',NULL,NULL,NULL,1022),(562,8,133,'2015-06-16 18:33:04',NULL,NULL,NULL,1022),(563,10,123,'2015-06-16 18:34:02','1032','1033',NULL,5),(564,10,125,'2015-06-16 18:34:02','1032','1033',NULL,5),(565,10,126,'2015-06-16 18:34:02','1032','1033',NULL,5),(566,10,128,'2015-06-16 18:34:02','1032','1033',NULL,5),(567,10,129,'2015-06-16 18:34:02','1032','1033',NULL,5),(568,10,133,'2015-06-16 18:34:02','1032','1033',NULL,5),(569,10,132,'2015-06-16 18:34:02','1033','1032',NULL,5),(570,1,134,'2015-06-16 18:35:13',NULL,NULL,NULL,1022),(571,8,134,'2015-06-16 18:35:14',NULL,NULL,NULL,1022),(572,9,133,'2015-06-16 18:36:22',NULL,NULL,NULL,1032),(573,10,123,'2015-06-17 01:00:02','1033','5',NULL,5),(574,10,125,'2015-06-17 01:00:03','1033','5',NULL,5),(575,10,126,'2015-06-17 01:00:04','1033','5',NULL,5),(576,10,128,'2015-06-17 01:00:05','1033',NULL,NULL,5),(577,10,129,'2015-06-17 01:00:06','1033',NULL,NULL,5),(578,10,132,'2015-06-17 01:00:07','1033',NULL,NULL,5),(579,10,133,'2015-06-17 01:00:08','1033',NULL,NULL,5),(580,10,134,'2015-06-17 01:00:09','1033',NULL,NULL,5),(581,10,134,'2015-06-17 07:30:03','1032',NULL,NULL,5),(582,9,130,'2015-06-17 14:43:27',NULL,NULL,NULL,1033),(583,1,135,'2015-06-17 14:52:39',NULL,NULL,NULL,1022),(584,8,135,'2015-06-17 14:52:40',NULL,NULL,NULL,1022),(585,8,135,'2015-06-17 14:53:14',NULL,NULL,NULL,1022),(586,9,135,'2015-06-17 14:53:29',NULL,NULL,NULL,1032),(587,9,135,'2015-06-17 14:53:33',NULL,NULL,NULL,1032),(588,8,87,'2015-06-17 15:20:09',NULL,NULL,NULL,1022),(589,1,136,'2015-06-17 15:24:24',NULL,NULL,NULL,1022),(590,8,136,'2015-06-17 15:24:25',NULL,NULL,NULL,1022),(591,8,135,'2015-06-17 15:25:26',NULL,NULL,NULL,1022),(592,8,130,'2015-06-17 15:28:09',NULL,NULL,NULL,1022),(593,8,124,'2015-06-17 15:28:16',NULL,NULL,NULL,1022),(594,1,137,'2015-06-17 15:28:48',NULL,NULL,NULL,1022),(595,8,137,'2015-06-17 15:28:49',NULL,NULL,NULL,1022),(596,8,137,'2015-06-17 15:29:34',NULL,NULL,NULL,1022),(597,8,137,'2015-06-17 15:29:36',NULL,NULL,NULL,1022),(598,8,87,'2015-06-17 15:36:02',NULL,NULL,NULL,1022),(599,8,87,'2015-06-17 15:56:57',NULL,NULL,NULL,1022),(600,1,138,'2015-06-17 16:02:14',NULL,NULL,NULL,1022),(601,8,138,'2015-06-17 16:02:15',NULL,NULL,NULL,1022),(602,8,138,'2015-06-17 16:02:51',NULL,NULL,NULL,1022),(603,8,138,'2015-06-17 16:03:04',NULL,NULL,NULL,1022),(604,1,139,'2015-06-17 16:04:04',NULL,NULL,NULL,1022),(605,8,139,'2015-06-17 16:04:06',NULL,NULL,NULL,1022),(606,8,139,'2015-06-17 16:04:45',NULL,NULL,NULL,1022),(607,1,140,'2015-06-17 16:19:19',NULL,NULL,NULL,1022),(608,8,140,'2015-06-17 16:19:20',NULL,NULL,NULL,1022),(609,1,141,'2015-06-17 16:22:13',NULL,NULL,NULL,1022),(610,8,141,'2015-06-17 16:22:14',NULL,NULL,NULL,1022),(611,8,141,'2015-06-17 16:22:26',NULL,NULL,NULL,1022),(612,10,140,'2015-06-17 22:30:02','1032',NULL,NULL,5),(613,10,140,'2015-06-18 04:30:03','1033',NULL,NULL,5),(614,1,142,'2015-06-18 16:18:55',NULL,NULL,NULL,1022),(615,8,142,'2015-06-18 16:18:56',NULL,NULL,NULL,1022),(616,8,142,'2015-06-18 16:19:18',NULL,NULL,NULL,1022),(617,3,142,'2015-06-18 16:24:42','1032','1033',NULL,1032),(618,8,142,'2015-06-18 16:25:04',NULL,NULL,NULL,1022),(619,1,143,'2015-06-18 16:29:22',NULL,NULL,NULL,1022),(620,8,143,'2015-06-18 16:29:24',NULL,NULL,NULL,1022),(621,1,144,'2015-06-18 18:43:47',NULL,NULL,NULL,1022),(622,8,144,'2015-06-18 18:43:48',NULL,NULL,NULL,1022),(623,8,144,'2015-06-18 18:45:45',NULL,NULL,NULL,1022),(624,8,144,'2015-06-18 18:47:27',NULL,NULL,NULL,1022),(625,3,144,'2015-06-18 18:48:31','1033','1032',NULL,1033),(626,9,144,'2015-06-18 18:48:44',NULL,NULL,NULL,1033),(627,9,144,'2015-06-18 18:49:15',NULL,NULL,NULL,1032),(628,3,144,'2015-06-18 18:49:43','1032','1033',NULL,1032),(629,9,144,'2015-06-18 18:49:58',NULL,NULL,NULL,1032),(630,10,142,'2015-06-19 04:30:02','1033',NULL,NULL,5),(631,10,144,'2015-06-19 07:00:02','1033',NULL,NULL,5),(632,10,142,'2015-06-19 16:30:03','1032',NULL,NULL,5),(633,10,144,'2015-06-19 19:30:02','1032',NULL,NULL,5),(634,10,135,'2015-06-20 15:30:03','1022',NULL,NULL,5),(635,10,137,'2015-06-20 15:30:05','1022',NULL,NULL,5),(636,10,136,'2015-06-20 15:30:08','1033',NULL,NULL,5),(637,10,138,'2015-06-20 16:30:03','1026',NULL,NULL,5),(638,10,139,'2015-06-20 16:30:05','1033',NULL,NULL,5),(639,10,141,'2015-06-20 16:30:07','1033',NULL,NULL,5),(640,10,143,'2015-06-21 16:30:03','1032',NULL,NULL,5),(641,1,145,'2015-06-23 12:38:32',NULL,NULL,NULL,5),(642,8,145,'2015-06-23 12:38:33',NULL,NULL,NULL,5),(643,10,136,'2015-06-23 16:00:03','1032',NULL,NULL,5),(644,10,137,'2015-06-23 16:00:04','1032',NULL,NULL,5),(645,10,135,'2015-06-23 16:00:05','1033',NULL,NULL,5),(646,10,139,'2015-06-23 17:00:03','1032',NULL,NULL,5),(647,10,141,'2015-06-23 17:00:04','1032',NULL,NULL,5),(648,10,138,'2015-06-23 17:00:05','1033',NULL,NULL,5),(649,1,146,'2015-06-24 10:40:49',NULL,NULL,NULL,1022),(650,8,146,'2015-06-24 10:40:50',NULL,NULL,NULL,1022),(651,1,147,'2015-06-24 15:48:33',NULL,NULL,NULL,1022),(652,8,147,'2015-06-24 15:48:34',NULL,NULL,NULL,1022),(653,1,148,'2015-06-24 15:49:04',NULL,NULL,NULL,1022),(654,8,148,'2015-06-24 15:49:06',NULL,NULL,NULL,1022),(655,1,149,'2015-06-24 15:50:03',NULL,NULL,NULL,1022),(656,8,149,'2015-06-24 15:50:04',NULL,NULL,NULL,1022),(657,1,150,'2015-06-24 15:50:35',NULL,NULL,NULL,1022),(658,8,150,'2015-06-24 15:50:37',NULL,NULL,NULL,1022),(659,1,151,'2015-06-24 15:51:02',NULL,NULL,NULL,1022),(660,8,151,'2015-06-24 15:51:03',NULL,NULL,NULL,1022),(661,1,152,'2015-06-24 15:51:26',NULL,NULL,NULL,1022),(662,8,152,'2015-06-24 15:51:28',NULL,NULL,NULL,1022),(663,8,152,'2015-06-24 15:53:20',NULL,NULL,NULL,1022),(664,10,143,'2015-06-24 17:00:05','1033',NULL,NULL,5),(665,10,147,'2015-06-24 22:00:02','1026',NULL,NULL,5),(666,10,151,'2015-06-24 22:00:04','1033',NULL,NULL,5),(667,10,150,'2015-06-24 22:00:06','1034',NULL,NULL,5),(668,10,149,'2015-06-24 22:00:08','1035',NULL,NULL,5),(669,10,147,'2015-06-25 04:30:02','1022',NULL,NULL,5),(670,10,151,'2015-06-25 04:30:05','1026',NULL,NULL,5),(671,10,150,'2015-06-25 04:30:07','1033',NULL,NULL,5),(672,10,149,'2015-06-25 04:30:09','1034',NULL,NULL,5),(673,10,148,'2015-06-25 05:00:02','1032',NULL,NULL,5),(674,3,151,'2015-06-26 01:01:47','1022','1035',NULL,5),(675,3,150,'2015-06-26 01:01:49','1026','1022',NULL,5),(676,3,149,'2015-06-26 01:01:51','1033','1026',NULL,5),(677,3,148,'2015-06-26 01:01:54','1034','1033',NULL,5),(678,3,147,'2015-06-26 01:01:56','1035','1034',NULL,5),(679,9,150,'2015-06-26 01:02:27',NULL,NULL,NULL,5),(680,9,150,'2015-06-26 01:02:58',NULL,NULL,NULL,5),(681,9,150,'2015-06-26 01:03:06',NULL,NULL,NULL,5),(682,3,150,'2015-06-26 01:03:18','1022','1035',NULL,1022),(683,9,148,'2015-06-26 01:06:38',NULL,NULL,NULL,1033),(684,3,148,'2015-06-26 01:06:45','1033','1022',NULL,1033),(685,8,150,'2015-06-26 01:08:52',NULL,NULL,NULL,1022),(686,9,130,'2015-06-26 01:09:16',NULL,NULL,NULL,1033),(687,3,130,'2015-06-26 01:09:24','1033','1026',NULL,1033),(688,9,130,'2015-06-26 01:09:33',NULL,NULL,NULL,1033),(689,9,117,'2015-06-26 01:09:36',NULL,NULL,NULL,1033),(690,3,117,'2015-06-26 01:09:41','1033','1034',NULL,1033),(691,9,150,'2015-06-26 01:12:32',NULL,NULL,NULL,1033),(692,9,131,'2015-06-26 01:12:35',NULL,NULL,NULL,1033),(693,3,131,'2015-06-26 01:12:56','1033','1035',NULL,1033),(694,9,131,'2015-06-26 01:13:04',NULL,NULL,NULL,1033),(695,8,87,'2015-06-26 01:13:25',NULL,NULL,NULL,1022),(696,8,152,'2015-06-26 01:13:28',NULL,NULL,NULL,1022),(697,8,151,'2015-06-26 01:13:33',NULL,NULL,NULL,1022),(698,8,150,'2015-06-26 01:13:36',NULL,NULL,NULL,1022),(699,8,149,'2015-06-26 01:13:40',NULL,NULL,NULL,1022),(700,8,149,'2015-06-26 01:13:44',NULL,NULL,NULL,1022),(701,8,148,'2015-06-26 01:13:47',NULL,NULL,NULL,1022),(702,3,148,'2015-06-26 01:14:05','1022','1033',NULL,1022),(703,8,148,'2015-06-26 01:14:08',NULL,NULL,NULL,1022),(704,8,148,'2015-06-26 01:14:11',NULL,NULL,NULL,1022),(705,9,148,'2015-06-26 01:14:21',NULL,NULL,NULL,1033),(706,3,148,'2015-06-26 01:14:56','1033','1022',NULL,1033),(707,9,148,'2015-06-26 01:14:59',NULL,NULL,NULL,1033),(708,8,147,'2015-06-26 01:19:50',NULL,NULL,NULL,1022),(709,8,148,'2015-06-26 01:19:54',NULL,NULL,NULL,1022),(710,3,148,'2015-06-26 01:23:17','1022','1033',NULL,1022),(711,8,148,'2015-06-26 01:23:20',NULL,NULL,NULL,1022),(712,9,148,'2015-06-26 01:33:57',NULL,NULL,NULL,1033),(713,3,148,'2015-06-26 01:34:04','1033','1026',NULL,1033),(714,9,148,'2015-06-26 01:34:07',NULL,NULL,NULL,1033),(715,9,148,'2015-06-26 01:34:20',NULL,NULL,NULL,1033),(716,8,146,'2015-06-26 01:34:32',NULL,NULL,NULL,1022),(717,8,144,'2015-06-26 01:34:36',NULL,NULL,NULL,1022),(718,9,146,'2015-06-26 01:34:55',NULL,NULL,NULL,5),(719,8,145,'2015-06-26 01:35:00',NULL,NULL,NULL,5),(720,9,145,'2015-06-26 01:35:13',NULL,NULL,NULL,1032),(721,3,145,'2015-06-26 01:35:43','1032','1033',NULL,1032),(722,9,145,'2015-06-26 01:35:46',NULL,NULL,NULL,1032),(723,9,135,'2015-06-26 01:44:09',NULL,NULL,NULL,1032),(724,3,135,'2015-06-26 01:44:16','1032','1022',NULL,1032),(725,9,135,'2015-06-26 01:44:27',NULL,NULL,NULL,1032),(726,9,135,'2015-06-26 01:44:50',NULL,NULL,NULL,1032),(727,8,135,'2015-06-26 01:45:04',NULL,NULL,NULL,1022),(728,8,135,'2015-06-26 01:45:24',NULL,NULL,NULL,1022),(729,1,153,'2015-06-26 12:50:19',NULL,NULL,NULL,1022),(730,8,153,'2015-06-26 12:50:21',NULL,NULL,NULL,1022),(731,9,153,'2015-06-26 12:50:29',NULL,NULL,NULL,1032),(732,9,153,'2015-06-26 12:54:37',NULL,NULL,NULL,1032),(733,9,153,'2015-06-26 12:54:39',NULL,NULL,NULL,1032),(734,9,153,'2015-06-26 12:58:08',NULL,NULL,NULL,1032),(735,9,153,'2015-06-26 12:58:10',NULL,NULL,NULL,1032),(736,3,153,'2015-06-26 12:58:16','1032','1033',NULL,1032),(737,9,153,'2015-06-26 12:58:21',NULL,NULL,NULL,1032),(738,9,153,'2015-06-26 12:59:26',NULL,NULL,NULL,1033),(739,3,153,'2015-06-26 12:59:32','1033','5',NULL,1033),(740,9,153,'2015-06-26 12:59:36',NULL,NULL,NULL,1033),(741,1,154,'2015-06-26 13:50:36',NULL,NULL,NULL,1022),(742,8,154,'2015-06-26 13:50:38',NULL,NULL,NULL,1022),(743,1,155,'2015-06-26 13:51:04',NULL,NULL,NULL,1022),(744,8,155,'2015-06-26 13:51:06',NULL,NULL,NULL,1022),(745,3,154,'2015-06-26 13:51:55','1032','1033',NULL,5),(746,3,154,'2015-06-26 13:51:56','1033','5',NULL,5),(747,3,155,'2015-06-26 13:51:56','1033','5',NULL,5),(748,3,148,'2015-06-26 13:52:02','1026','5',NULL,5),(749,9,138,'2015-06-26 15:57:11',NULL,NULL,NULL,1032),(750,9,41,'2015-06-26 15:57:24',NULL,NULL,NULL,5),(751,9,150,'2015-06-26 15:57:32',NULL,NULL,NULL,5),(752,9,145,'2015-06-26 16:12:53',NULL,NULL,NULL,1033),(753,9,145,'2015-06-26 16:13:01',NULL,NULL,NULL,1033),(754,3,145,'2015-06-26 16:13:34','1033','5',NULL,1033),(755,9,145,'2015-06-26 16:13:38',NULL,NULL,NULL,1033),(756,9,138,'2015-06-26 16:13:54',NULL,NULL,NULL,1032),(757,3,138,'2015-06-26 16:14:14','1032','5',NULL,1032),(758,1,156,'2015-06-26 16:36:41',NULL,NULL,NULL,1022),(759,8,156,'2015-06-26 16:36:42',NULL,NULL,NULL,1022),(760,8,153,'2015-06-26 16:37:13',NULL,NULL,NULL,1022),(761,9,156,'2015-06-26 16:37:23',NULL,NULL,NULL,1032),(762,9,156,'2015-06-26 16:37:54',NULL,NULL,NULL,1032),(763,9,156,'2015-06-26 16:41:58',NULL,NULL,NULL,1032),(764,3,156,'2015-06-26 16:44:17','1032','1033',NULL,1032),(765,9,156,'2015-06-26 16:44:25',NULL,NULL,NULL,1032),(766,3,156,'2015-06-26 16:55:56','1033','5',NULL,1033),(767,1,157,'2015-06-26 16:56:45',NULL,NULL,NULL,1022),(768,8,157,'2015-06-26 16:56:46',NULL,NULL,NULL,1022),(769,3,157,'2015-06-26 16:58:39','1033','5',NULL,1033),(770,8,87,'2015-07-01 12:38:19',NULL,NULL,NULL,1022),(771,8,156,'2015-07-01 12:38:44',NULL,NULL,NULL,1022),(772,1,158,'2015-07-01 12:39:30',NULL,NULL,NULL,1022),(773,1,159,'2015-07-01 12:39:33',NULL,NULL,NULL,1022),(774,8,159,'2015-07-01 12:39:35',NULL,NULL,NULL,1022),(775,8,159,'2015-07-01 12:39:47',NULL,NULL,NULL,1022),(776,1,160,'2015-07-01 12:41:51',NULL,NULL,NULL,1022),(777,8,160,'2015-07-01 12:41:53',NULL,NULL,NULL,1022),(778,8,159,'2015-07-01 12:43:48',NULL,NULL,NULL,1022),(779,8,159,'2015-07-01 12:44:08',NULL,NULL,NULL,1022),(780,8,158,'2015-07-01 12:45:13',NULL,NULL,NULL,1022),(781,8,158,'2015-07-01 12:49:36',NULL,NULL,NULL,1022),(782,8,158,'2015-07-01 12:54:05',NULL,NULL,NULL,1022),(783,8,158,'2015-07-01 12:54:34',NULL,NULL,NULL,1022),(784,1,161,'2015-07-01 12:54:40',NULL,NULL,NULL,1022),(785,8,161,'2015-07-01 12:54:41',NULL,NULL,NULL,1022),(786,8,158,'2015-07-01 13:12:08',NULL,NULL,NULL,1022),(787,8,160,'2015-07-01 13:16:36',NULL,NULL,NULL,1022),(788,8,160,'2015-07-01 13:17:20',NULL,NULL,NULL,1022),(789,3,160,'2015-07-01 13:21:24','7','17',NULL,1022),(790,8,161,'2015-07-01 13:21:33',NULL,NULL,NULL,1022),(791,8,160,'2015-07-01 13:21:42',NULL,NULL,NULL,1022),(792,8,159,'2015-07-01 13:21:53',NULL,NULL,NULL,1022),(793,3,159,'2015-07-01 13:22:13','1033','5',NULL,1022),(794,8,159,'2015-07-01 13:22:21',NULL,NULL,NULL,1022),(795,9,41,'2015-07-01 13:24:51',NULL,NULL,NULL,5),(796,1,162,'2015-07-01 18:31:57',NULL,NULL,NULL,1022),(797,8,162,'2015-07-01 18:31:59',NULL,NULL,NULL,1022),(798,8,127,'2015-07-02 12:47:04',NULL,NULL,NULL,1022),(799,3,127,'2015-07-02 12:47:18','5','1032',NULL,1022),(800,8,127,'2015-07-02 12:47:25',NULL,NULL,NULL,1022),(801,1,163,'2015-07-02 14:18:55',NULL,NULL,NULL,1022),(802,8,163,'2015-07-02 14:18:56',NULL,NULL,NULL,1022),(803,9,75,'2015-07-06 12:44:10',NULL,NULL,NULL,5),(804,9,60,'2015-07-07 12:29:43',NULL,NULL,NULL,1032),(805,9,42,'2015-07-07 12:29:57',NULL,NULL,NULL,1032),(806,9,87,'2015-07-07 12:37:02',NULL,NULL,NULL,1032),(807,1,164,'2015-07-07 18:20:46',NULL,NULL,NULL,1022),(808,8,164,'2015-07-07 18:20:47',NULL,NULL,NULL,1022),(809,9,162,'2015-07-08 15:45:00',NULL,NULL,NULL,1032),(810,9,127,'2015-07-08 15:45:07',NULL,NULL,NULL,1032),(811,9,127,'2015-07-08 15:45:56',NULL,NULL,NULL,1032),(812,9,127,'2015-07-08 15:46:09',NULL,NULL,NULL,1032),(813,5,127,'2015-07-08 15:46:17',NULL,'272',NULL,1032),(814,9,127,'2015-07-08 15:46:19',NULL,NULL,NULL,1032),(815,9,162,'2015-07-08 15:47:35',NULL,NULL,NULL,1032),(816,9,127,'2015-07-08 15:48:12',NULL,NULL,NULL,1032),(817,9,127,'2015-07-08 15:54:04',NULL,NULL,NULL,1032),(818,5,127,'2015-07-08 15:54:13',NULL,'273',NULL,1032),(819,9,127,'2015-07-08 15:54:15',NULL,NULL,NULL,1032),(820,9,127,'2015-07-08 15:54:23',NULL,NULL,NULL,1032),(821,9,127,'2015-07-08 15:54:38',NULL,NULL,NULL,1032),(822,8,164,'2015-07-08 15:56:54',NULL,NULL,NULL,1022),(823,8,123,'2015-07-08 15:57:12',NULL,NULL,NULL,1022),(824,8,123,'2015-07-08 15:57:20',NULL,NULL,NULL,1022),(825,8,127,'2015-07-08 16:08:39',NULL,NULL,NULL,1022),(826,8,162,'2015-07-08 16:08:48',NULL,NULL,NULL,1022),(827,8,87,'2015-07-08 16:08:54',NULL,NULL,NULL,1022),(828,8,157,'2015-07-08 16:09:02',NULL,NULL,NULL,1022),(829,8,127,'2015-07-08 16:18:31',NULL,NULL,NULL,1022),(830,8,132,'2015-07-08 16:18:40',NULL,NULL,NULL,1022),(831,8,132,'2015-07-08 16:18:43',NULL,NULL,NULL,1022),(832,9,162,'2015-07-08 16:19:04',NULL,NULL,NULL,1032),(833,9,162,'2015-07-08 16:19:07',NULL,NULL,NULL,1032),(834,9,162,'2015-07-08 16:19:24',NULL,NULL,NULL,1032),(835,5,162,'2015-07-08 16:19:35',NULL,'274',NULL,1032),(836,9,162,'2015-07-08 16:19:36',NULL,NULL,NULL,1032),(837,8,162,'2015-07-08 16:51:56',NULL,NULL,NULL,1022),(838,4,162,'2015-07-08 16:52:06',NULL,'275',NULL,1022),(839,8,162,'2015-07-08 16:52:07',NULL,NULL,NULL,1022),(840,8,127,'2015-07-08 17:20:26',NULL,NULL,NULL,1022),(841,8,157,'2015-07-08 17:20:43',NULL,NULL,NULL,1022),(842,8,157,'2015-07-08 17:20:54',NULL,NULL,NULL,1022),(843,8,156,'2015-07-08 17:21:04',NULL,NULL,NULL,1022),(844,8,123,'2015-07-10 02:49:49',NULL,NULL,NULL,1022),(845,3,123,'2015-07-10 02:57:57','5','1033',NULL,1022),(846,8,123,'2015-07-10 02:58:07',NULL,NULL,NULL,1022),(847,8,123,'2015-07-10 03:15:32',NULL,NULL,NULL,1022),(848,2,123,'2015-07-10 03:15:46','Pending','Close',NULL,1022),(849,1,165,'2015-07-10 10:19:58',NULL,NULL,NULL,1022),(850,8,165,'2015-07-10 10:20:00',NULL,NULL,NULL,1022),(851,1,166,'2015-07-10 10:22:40',NULL,NULL,NULL,1022),(852,8,166,'2015-07-10 10:22:41',NULL,NULL,NULL,1022),(853,1,167,'2015-07-10 10:31:29',NULL,NULL,NULL,1022),(854,8,167,'2015-07-10 10:31:30',NULL,NULL,NULL,1022),(855,1,168,'2015-07-10 15:36:41',NULL,NULL,NULL,1022),(856,8,168,'2015-07-10 15:36:43',NULL,NULL,NULL,1022),(857,9,167,'2015-07-10 16:19:15',NULL,NULL,NULL,1038),(858,1,169,'2015-07-10 16:45:40',NULL,NULL,NULL,1022),(859,8,169,'2015-07-10 16:45:41',NULL,NULL,NULL,1022),(860,3,169,'2015-07-10 16:46:57','17','1033',NULL,1022),(861,3,169,'2015-07-10 16:47:01','1033','1038',NULL,1022),(862,8,169,'2015-07-10 16:47:11',NULL,NULL,NULL,1022),(863,9,41,'2015-07-10 16:47:29',NULL,NULL,NULL,5),(864,1,170,'2015-07-13 13:43:57',NULL,NULL,NULL,1039),(865,8,170,'2015-07-13 13:43:58',NULL,NULL,NULL,1039),(866,8,170,'2015-07-13 13:44:10',NULL,NULL,NULL,1039),(867,4,170,'2015-07-13 13:44:54',NULL,'279',NULL,1039),(868,8,170,'2015-07-13 13:44:56',NULL,NULL,NULL,1039),(869,9,43,'2015-07-15 16:30:47',NULL,NULL,NULL,1032),(870,8,137,'2015-07-15 16:31:37',NULL,NULL,NULL,1022),(871,2,137,'2015-07-15 16:31:44','Pending','Close',NULL,1022),(872,8,137,'2015-07-15 16:31:53',NULL,NULL,NULL,1022),(873,8,127,'2015-07-15 16:32:17',NULL,NULL,NULL,1022),(874,9,137,'2015-07-15 16:32:43',NULL,NULL,NULL,1032),(875,9,43,'2015-07-15 16:33:20',NULL,NULL,NULL,1032),(876,9,43,'2015-07-15 16:33:39',NULL,NULL,NULL,1032),(877,9,47,'2015-07-15 18:14:21',NULL,NULL,NULL,1026),(878,9,60,'2015-07-16 12:40:54',NULL,NULL,NULL,5),(879,9,123,'2015-07-16 12:41:10',NULL,NULL,NULL,5),(880,9,167,'2015-07-23 22:24:40',NULL,NULL,NULL,1038),(881,9,167,'2015-07-23 22:28:15',NULL,NULL,NULL,1038),(882,8,88,'2015-07-24 03:01:55',NULL,NULL,NULL,1022),(883,8,46,'2015-07-24 05:20:13',NULL,NULL,NULL,5),(884,1,171,'2015-07-24 05:31:50',NULL,NULL,NULL,1046),(885,8,171,'2015-07-24 05:31:52',NULL,NULL,NULL,1046),(886,9,41,'2015-07-24 11:15:35',NULL,NULL,NULL,5),(887,8,87,'2015-07-24 16:21:38',NULL,NULL,NULL,1022),(888,2,87,'2015-07-24 16:21:45','Pending','Close',NULL,1022),(889,8,88,'2015-07-24 16:21:52',NULL,NULL,NULL,1022),(890,2,88,'2015-07-24 16:21:58','Pending','Close',NULL,1022),(891,8,124,'2015-07-24 16:22:03',NULL,NULL,NULL,1022),(892,2,124,'2015-07-24 16:22:10','Pending','Close',NULL,1022),(893,8,125,'2015-07-24 16:22:16',NULL,NULL,NULL,1022),(894,2,125,'2015-07-24 16:22:23','Pending','Close',NULL,1022),(895,8,126,'2015-07-24 16:22:38',NULL,NULL,NULL,1022),(896,2,126,'2015-07-24 16:22:44','Pending','Close',NULL,1022),(897,8,127,'2015-07-24 16:23:02',NULL,NULL,NULL,1022),(898,2,127,'2015-07-24 16:23:10','Pending','Close',NULL,1022),(899,1,172,'2015-07-24 16:26:47',NULL,NULL,NULL,1022),(900,8,172,'2015-07-24 16:26:49',NULL,NULL,NULL,1022),(901,9,171,'2015-07-28 01:06:29',NULL,NULL,NULL,5),(902,9,171,'2015-07-28 01:20:13',NULL,NULL,NULL,5),(903,1,173,'2015-07-28 14:38:48',NULL,NULL,NULL,1022),(904,8,173,'2015-07-28 14:38:50',NULL,NULL,NULL,1022),(905,1,174,'2015-07-28 14:39:23',NULL,NULL,NULL,1022),(906,8,174,'2015-07-28 14:39:24',NULL,NULL,NULL,1022),(907,9,171,'2015-07-28 14:40:07',NULL,NULL,NULL,1032),(908,3,170,'2015-07-28 14:44:10','1033','1026',NULL,5),(909,3,171,'2015-07-28 14:44:12','1032','1035',NULL,5),(910,1,175,'2015-07-28 15:14:14',NULL,NULL,NULL,1022),(911,1,176,'2015-07-28 15:14:15',NULL,NULL,NULL,1022),(912,8,176,'2015-07-28 15:14:16',NULL,NULL,NULL,1022),(913,1,177,'2015-07-28 15:14:38',NULL,NULL,NULL,1022),(914,8,177,'2015-07-28 15:14:40',NULL,NULL,NULL,1022),(915,1,178,'2015-07-28 15:15:09',NULL,NULL,NULL,1022),(916,8,178,'2015-07-28 15:15:10',NULL,NULL,NULL,1022),(917,9,174,'2015-07-28 15:15:40',NULL,NULL,NULL,1033),(918,9,177,'2015-07-28 15:15:47',NULL,NULL,NULL,1033),(919,5,177,'2015-07-28 15:16:04',NULL,'287',NULL,1033),(920,9,177,'2015-07-28 15:16:05',NULL,NULL,NULL,1033),(921,8,176,'2015-07-28 15:17:16',NULL,NULL,NULL,1022),(922,8,175,'2015-07-28 15:17:23',NULL,NULL,NULL,1022),(923,9,176,'2015-07-28 16:30:44',NULL,NULL,NULL,1032),(924,9,177,'2015-07-28 16:33:28',NULL,NULL,NULL,1033),(925,9,174,'2015-07-28 16:33:37',NULL,NULL,NULL,1033),(926,3,171,'2015-07-28 16:34:13','1035','1033',NULL,5),(927,9,174,'2015-07-28 16:34:28',NULL,NULL,NULL,1033),(928,9,176,'2015-07-28 16:36:18',NULL,NULL,NULL,1032),(929,9,176,'2015-07-28 16:37:34',NULL,NULL,NULL,1032),(930,9,176,'2015-07-28 16:43:02',NULL,NULL,NULL,1033),(931,9,174,'2015-07-28 16:43:41',NULL,NULL,NULL,1033),(932,9,174,'2015-07-28 16:45:15',NULL,NULL,NULL,1033),(933,3,174,'2015-07-28 16:45:31','1033','1032',NULL,5),(934,3,176,'2015-07-28 16:45:33','1033','1032',NULL,5),(935,9,174,'2015-07-28 16:45:37',NULL,NULL,NULL,1033),(936,9,177,'2015-07-28 16:46:24',NULL,NULL,NULL,1033),(937,1,179,'2015-07-28 16:47:27',NULL,NULL,NULL,1033),(938,8,179,'2015-07-28 16:47:28',NULL,NULL,NULL,1033),(939,8,174,'2015-07-28 17:16:58',NULL,NULL,NULL,1022),(940,8,174,'2015-07-28 17:18:09',NULL,NULL,NULL,1022),(941,3,174,'2015-07-28 17:18:34','1032','5',NULL,1032),(942,8,174,'2015-07-28 17:30:11',NULL,NULL,NULL,1022),(943,9,176,'2015-07-28 17:34:21',NULL,NULL,NULL,1032),(944,5,176,'2015-07-28 17:34:37',NULL,'288',NULL,1032),(945,9,176,'2015-07-28 17:34:38',NULL,NULL,NULL,1032),(946,3,176,'2015-07-28 17:34:51','1032','5',NULL,1032),(947,9,176,'2015-07-28 17:35:00',NULL,NULL,NULL,1032),(948,1,180,'2015-07-28 21:21:46',NULL,NULL,NULL,1027),(949,8,180,'2015-07-28 21:21:47',NULL,NULL,NULL,1027),(950,9,41,'2015-07-28 21:25:54',NULL,NULL,NULL,5),(951,1,181,'2015-07-28 21:28:45',NULL,NULL,NULL,1038),(952,8,181,'2015-07-28 21:28:48',NULL,NULL,NULL,1038),(953,8,181,'2015-07-28 21:29:06',NULL,NULL,NULL,1038),(954,8,181,'2015-07-28 21:32:13',NULL,NULL,NULL,1038),(955,8,180,'2015-07-29 08:13:14',NULL,NULL,NULL,1027),(956,3,181,'2015-07-29 11:01:11','7','1012',NULL,5),(957,3,180,'2015-07-30 15:00:02','17','10',NULL,5),(958,3,181,'2015-07-30 15:00:04','1012','17',NULL,5),(959,3,178,'2015-07-30 15:00:06','1026','1032',NULL,5),(960,3,175,'2015-07-30 15:00:08','1034','1033',NULL,5),(961,3,180,'2015-07-30 16:30:02','10','1012',NULL,5),(962,3,181,'2015-07-30 16:30:04','17','10',NULL,5),(963,3,178,'2015-07-30 16:30:06','1032','1033',NULL,5),(964,3,175,'2015-07-30 16:30:08','1033','1032',NULL,5),(965,3,181,'2015-07-30 18:00:02','10','19',NULL,5),(966,3,180,'2015-07-30 18:00:04','1012','7',NULL,5),(967,3,180,'2015-07-30 19:30:02','7','1032',NULL,5),(968,3,181,'2015-07-30 19:30:04','19','1032',NULL,5),(969,3,180,'2015-07-30 21:00:02','1032','19',NULL,5),(970,8,172,'2015-07-31 10:00:13',NULL,NULL,NULL,1022),(971,8,174,'2015-07-31 10:00:19',NULL,NULL,NULL,1022),(972,8,175,'2015-07-31 10:00:24',NULL,NULL,NULL,1022),(973,8,176,'2015-07-31 10:00:49',NULL,NULL,NULL,1022),(974,8,177,'2015-07-31 10:01:20',NULL,NULL,NULL,1022),(975,8,178,'2015-07-31 10:01:29',NULL,NULL,NULL,1022),(976,1,182,'2015-07-31 10:03:37',NULL,NULL,NULL,1022),(977,8,182,'2015-07-31 10:03:38',NULL,NULL,NULL,1022),(978,1,183,'2015-07-31 10:04:45',NULL,NULL,NULL,1022),(979,8,183,'2015-07-31 10:04:47',NULL,NULL,NULL,1022),(980,9,183,'2015-07-31 10:09:35',NULL,NULL,NULL,1032),(981,9,183,'2015-07-31 10:14:57',NULL,NULL,NULL,1032),(982,3,183,'2015-07-31 10:30:02','1032','1034',NULL,5),(983,3,183,'2015-07-31 11:30:02','1034','1033',NULL,5),(984,3,182,'2015-07-31 11:30:04','1035','1034',NULL,5),(985,8,183,'2015-07-31 11:30:18',NULL,NULL,NULL,1022),(986,9,183,'2015-07-31 11:32:16',NULL,NULL,NULL,1033),(987,5,183,'2015-07-31 11:32:27',NULL,'289',NULL,1033),(988,9,183,'2015-07-31 11:32:28',NULL,NULL,NULL,1033),(989,8,183,'2015-07-31 11:33:22',NULL,NULL,NULL,1022),(990,8,182,'2015-07-31 11:33:48',NULL,NULL,NULL,1022),(991,3,182,'2015-07-31 13:00:02','1034','1033',NULL,5),(992,8,175,'2015-07-31 14:29:09',NULL,NULL,NULL,1022),(993,8,173,'2015-07-31 14:44:08',NULL,NULL,NULL,1022),(994,8,183,'2015-07-31 14:44:22',NULL,NULL,NULL,1022),(995,8,183,'2015-07-31 14:44:42',NULL,NULL,NULL,1022),(996,8,62,'2015-08-11 14:24:48',NULL,NULL,NULL,10),(997,1,184,'2015-09-19 15:19:43',NULL,NULL,NULL,5),(998,8,184,'2015-09-19 15:19:44',NULL,NULL,NULL,5),(999,1,185,'2015-09-19 15:28:34',NULL,NULL,NULL,5),(1000,8,185,'2015-09-19 15:28:35',NULL,NULL,NULL,5),(1001,8,184,'2015-09-19 15:28:52',NULL,NULL,NULL,5),(1002,8,184,'2015-09-19 15:29:49',NULL,NULL,NULL,5),(1003,8,184,'2015-09-19 15:29:55',NULL,NULL,NULL,5),(1004,3,184,'2015-09-19 16:30:02','1052','1012',NULL,5),(1005,3,184,'2015-09-19 18:00:02','1012','10',NULL,5),(1006,3,184,'2015-09-19 19:30:02','10','17',NULL,5),(1007,3,184,'2015-09-19 21:00:02','17','7',NULL,5),(1008,3,184,'2015-09-19 22:30:02','7','1032',NULL,5),(1009,3,184,'2015-09-20 00:00:02','1032','19',NULL,5),(1010,3,184,'2015-09-20 01:30:02','19','5',NULL,5),(1011,9,43,'2015-10-14 09:19:48',NULL,NULL,NULL,1052),(1012,9,124,'2015-10-14 09:19:57',NULL,NULL,NULL,1052),(1013,9,43,'2015-10-14 09:58:19',NULL,NULL,NULL,1052),(1014,9,169,'2015-10-14 09:58:42',NULL,NULL,NULL,1052),(1015,9,123,'2015-10-14 09:58:53',NULL,NULL,NULL,1052),(1016,9,43,'2015-10-14 09:59:02',NULL,NULL,NULL,1052),(1017,1,186,'2015-10-14 10:00:20',NULL,NULL,NULL,1052),(1018,8,186,'2015-10-14 10:00:21',NULL,NULL,NULL,1052),(1019,9,41,'2015-10-14 10:01:33',NULL,NULL,NULL,5),(1020,9,186,'2015-10-14 10:02:13',NULL,NULL,NULL,5),(1021,6,186,'2015-10-14 10:03:57',NULL,'187',NULL,5),(1022,1,187,'2015-10-14 10:03:57',NULL,NULL,NULL,5),(1023,7,187,'2015-10-14 10:03:57','186',NULL,NULL,5),(1024,8,187,'2015-10-14 10:04:08',NULL,NULL,NULL,5),(1025,4,187,'2015-10-14 10:04:29',NULL,'290',NULL,5),(1026,8,187,'2015-10-14 10:04:30',NULL,NULL,NULL,5),(1027,9,42,'2015-10-14 10:05:35',NULL,NULL,NULL,5),(1028,3,42,'2015-10-14 10:05:51','5','1052',NULL,5),(1029,9,42,'2015-10-14 10:06:05',NULL,NULL,NULL,1052),(1030,9,87,'2015-10-14 11:24:58',NULL,NULL,NULL,1052),(1031,9,41,'2015-10-23 00:19:53',NULL,NULL,NULL,5),(1032,1,188,'2015-10-29 22:54:43',NULL,NULL,NULL,5),(1033,8,188,'2015-10-29 22:54:45',NULL,NULL,NULL,5),(1034,2,188,'2015-10-29 22:55:08','Pending','Close',NULL,5),(1035,8,186,'2015-10-30 11:46:14',NULL,NULL,NULL,1052),(1036,8,62,'2015-11-10 11:11:28',NULL,NULL,NULL,10),(1037,1,189,'2015-12-02 00:45:55',NULL,NULL,NULL,1089),(1038,8,189,'2015-12-02 00:45:57',NULL,NULL,NULL,1089),(1039,1,190,'2015-12-02 00:56:14',NULL,NULL,NULL,1052),(1040,8,190,'2015-12-02 00:56:15',NULL,NULL,NULL,1052),(1041,9,74,'2015-12-02 18:04:04',NULL,NULL,NULL,1052),(1042,8,186,'2015-12-02 19:42:08',NULL,NULL,NULL,1052),(1043,9,41,'2015-12-02 19:42:28',NULL,NULL,NULL,5),(1044,1,191,'2015-12-03 20:02:42',NULL,NULL,NULL,1052),(1045,8,191,'2015-12-03 20:02:43',NULL,NULL,NULL,1052),(1046,9,190,'2015-12-03 20:03:35',NULL,NULL,NULL,1029),(1047,1,192,'2015-12-03 20:04:32',NULL,NULL,NULL,1052),(1048,8,192,'2015-12-03 20:04:34',NULL,NULL,NULL,1052),(1049,1,193,'2015-12-03 20:07:09',NULL,NULL,NULL,1052),(1050,8,193,'2015-12-03 20:07:11',NULL,NULL,NULL,1052),(1051,9,193,'2015-12-03 20:08:02',NULL,NULL,NULL,1029),(1052,9,193,'2015-12-03 20:08:34',NULL,NULL,NULL,1029),(1053,5,193,'2015-12-03 20:08:40',NULL,'293',NULL,1029),(1054,9,193,'2015-12-03 20:08:41',NULL,NULL,NULL,1029),(1055,9,193,'2015-12-03 20:09:20',NULL,NULL,NULL,1029),(1056,5,193,'2015-12-03 20:09:26',NULL,'294',NULL,1029),(1057,9,193,'2015-12-03 20:09:27',NULL,NULL,NULL,1029),(1058,9,193,'2015-12-03 20:21:51',NULL,NULL,NULL,1029),(1059,9,193,'2015-12-03 20:25:25',NULL,NULL,NULL,5),(1060,9,193,'2015-12-03 20:28:03',NULL,NULL,NULL,5),(1061,3,193,'2015-12-03 20:28:22','7','1052',NULL,5),(1062,9,193,'2015-12-03 20:28:40',NULL,NULL,NULL,5),(1063,3,193,'2015-12-03 20:28:56','1052','1052',NULL,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=1090 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'admin','$2a$08$OzPJSdkZr7vT7rMxP5oB6OIwq2tYXfygovtGXdG9On6JX1bz6Nrhu','aalfo077@fiu.edu','Masoud','','Sadj','/coplat/images/profileimages/avatarsmall.gif',1,'z2vtszc43g',0,'I am the admin and professor, this is a test 2',NULL,NULL,NULL,NULL,1,1,1,0,0,0,0,0,0),(6,'lsanc104','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','lsanc104@fiu.edu','Lorenzo','Alexis','Sanchez','/coplat/images/profileimages/avatarsmall.gif',1,'au5n3h1mqd',0,'now u can edit the bio',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(7,'hmuni006','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','hmuni006@fiu.edu','Henry','Daniel','Muniz','/coplat/images/profileimages/avatarsmall.gif',1,'kf049x8q3q',0,'test',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(8,'jsant001','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jsant001@fiu.edu','Jonathan','Raul','Santiago','/coplat/images/profileimages/avatarsmall.gif',1,'5yq43kqdqx',0,NULL,1,NULL,NULL,NULL,0,0,0,1,0,1,0,0,0),(9,'jquiroz001','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jquiroz001@fiu.edu','Javier','','Quiroz','/coplat/images/profileimages/avatarsmall.gif',1,'9ilo03t2dw',0,NULL,2,NULL,NULL,NULL,0,0,0,1,0,1,0,0,0),(10,'aalfo077','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','aalfo077@fiu.edu','Adrian','','Alfonso','/coplat/images/profileimages/avatarsmall.gif',1,'bnq2lehy8p',0,'test',3,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(11,'ctope001','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','ctope001@fiu.edu','Cynthia','','Tope','/coplat/images/profileimages/avatarsmall.gif',1,'fp7obcosno',1,NULL,4,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(16,'Henry_16','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','henrydaniel25@gmail.com','Henry','D','Muniz Romero','/coplat/images/profileimages/avatarsmall.gif',1,'vat4dkf1th',0,NULL,NULL,NULL,NULL,NULL,0,1,0,0,0,0,0,0,0),(17,'jlei','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jlei@email.com','Jiali','','Lei','/coplat/images/profileimages/avatarsmall.gif',1,'imltjmdka7',1,'This is a test for Jiali Lei',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(18,'ssana002','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','ssana002@fiu.edu','Steven','','Sanabria','/coplat/images/profileimages/avatarsmall.gif',1,'qdad4orb2l',0,'',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(19,'pedro','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','default@fiu.edu','Pedro','','Escandell','/coplat/images/profileimages/default_pic.jpg',1,'rh7xn3ulba',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,1,0,0,0,0,0),(20,'mentee','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','default@fiu.edu','mentee','','mentee','/coplat/images/profileimages/default_pic.jpg',0,'lnn70dg960',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(21,'rgome020','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','rgome020@fiu.edu','Ramon','','Gomez','/coplat/images/profileimages/default_pic.jpg',1,'fvv6v1cb1a',1,'Tell us something about yourself...',2,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(22,'SYSTEM','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','','Automatically','','Reassignment','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,NULL,NULL,NULL,NULL,1,0,0,0,0,0,0,0,0),(999,'DEFAULT','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','default@fiu.edu','--','','--','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(1000,'nmada002','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','nmada002@fiu.edu','Nicholas','','Madariaga','/coplat/images/profileimages/default_pic.jpg',1,'yu49ebtkae',1,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,1,0,0,0,0,0,0,0),(1002,'jphil075','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jphil075@fiu.edu','Justin','','Phillips','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,3,NULL,'0108602',NULL,0,0,0,0,0,1,0,0,0),(1003,'jmcga005','$2a$08$SucdVG3yvg6W2HnfirQ68udLfTNEF.qj2AQNlSODW5Tw.L2AQcVuu','jmcga005@fiu.edu','Jorge','','Mcgarry','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,4,NULL,'1054101',NULL,0,0,0,0,0,1,0,0,0),(1004,'rmart071','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','rmart071@fiu.edu','Ricardo','','Martinez','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,1,NULL,'1676926',NULL,0,0,0,0,0,1,0,0,0),(1005,'jsanc090','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jsanc090@fiu.edu','Jonathan','','Sanchez','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,'This is a description',2,NULL,'2051994',NULL,0,0,0,0,0,1,0,0,0),(1006,'mgonz108','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','mgonz108@fiu.edu','Maylem','','Gonzalez','/coplat/images/profileimages/default_pic.jpg',1,NULL,0,NULL,3,NULL,'2134900',NULL,0,0,0,0,0,1,0,0,0),(1012,'sbruh','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','sburh002@fiu.edu','Steve','','Bruhl','/coplat/images/profileimages/default_pic.jpg',1,'b691sno7l2',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1013,'demo','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','demo@gmail.com','Demo','','Demo','/coplat/images/profileimages/default_pic.jpg',1,'yw48etlu0r',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1015,'fmsdlkfjsldkfj','$2a$08$obPM5bju9lbd/y2Dx8Koveppkh8FY.2Cmpm3AVuPGu1C6Den5arxi','jj@gmail.com','kfjabk','akfnal','flskdfal','/coplat/images/profileimages/default_pic.jpg',1,'43rzlarccv',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1016,'demo2','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','demo2@gmail.com','demo2','demo2','demo2','/coplat/images/profileimages/default_pic.jpg',1,'1ml7q3suo4',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1017,'aramo011','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','aramo011@fiu.edu','Alexander','','Ramos',NULL,1,NULL,0,NULL,NULL,NULL,'1375096',NULL,0,0,0,0,0,1,0,0,0),(1018,'ameri012','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','ameri012@fiu.edu','Adam','','Merille',NULL,1,NULL,0,NULL,NULL,NULL,'1711951',NULL,0,0,0,0,0,1,0,0,0),(1019,'jrian002','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','jrian002@fiu.edu','Juan','','Riano',NULL,1,NULL,0,NULL,NULL,NULL,'1894364',NULL,0,0,0,0,0,1,0,0,0),(1020,'msant080','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','msant080@fiu.edu','Matthew','','Santiago',NULL,1,NULL,0,NULL,NULL,NULL,'2403179',NULL,0,0,0,0,0,1,0,0,0),(1021,'cmcan003','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','cmcan003@fiu.edu','Cory','','Mcan',NULL,1,NULL,0,NULL,NULL,NULL,'2458355',NULL,0,0,0,0,0,1,0,0,0),(1022,'mmach059','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','mmach059@fiu.edu','Michael','','Machin',NULL,1,NULL,0,NULL,NULL,NULL,'2584643',NULL,0,0,1,0,0,1,0,0,0),(1023,'mjord008','$2a$08$4Ag4cvHEHZm07OKQ2CCR6egXEjpqZkImaVlnZSfghROPzH8CGmrgK','mjord008@fiu.edu','Maikel','','Jordan',NULL,1,NULL,0,NULL,NULL,NULL,'2643936',NULL,0,0,0,0,0,1,0,0,0),(1025,'adrianlfns1','$2a$08$zLea2.yCFIa7ZDceXj6HZO5fO6WbS1vY64WTn5f50WOLR/3zRlpq6','adrianlfns@yahoo.com','Adrian','','Alfonso','/coplat/images/profileimages/default_pic.jpg',1,'2oyg9hn7zy',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(1026,'jcaraballo','$2a$08$dcnHklEVpu0iVfhTX5wW/erVp9pz4V8njr/PZfeWBa8XAbxSipc8q','jfc@us.ibm.com','Juan','','Caraballo','/coplat/images/profileimages/default_pic.jpg',1,'lz9owyjpix',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,1,0,1,0,0,0,0,0),(1027,'mlast004','$2a$08$l5wlAjkxmvVLcuDTJRJaWelLxIcyvhP.uUfkAvj0XjTp7rGPKxUUu','mlast004@fiu.edu','Mandiel','','Lastra','/coplat/images/profileimages/default_pic.jpg',1,'8ndgyvxuf1',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(1028,'kkon001','$2a$08$pqjdSAIkDUit4Ub/MaOf5.AfdQNbibLQAkDfmGwpMDXJH6PI5eS6C','kkon001@fiu.edu','Kenneth','','Kon',NULL,1,NULL,0,NULL,NULL,NULL,'2734244',NULL,0,0,0,0,0,1,0,0,0),(1029,'user1','$2a$08$F9y5HWHZMelPwJdfxajMC.mzaRvLXnpXJVCB0kLTMnE9kuKYmhruy','user1@yahoo.com','user1','','user','/coplat/images/profileimages/default_pic.jpg',1,'vi18t3qt7m',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,1,0,0,0,0,0,0,0),(1030,'user2','$2a$08$nWc9992pElsM68.jWfAYleH6pI5s8NAylWxc8E.Ww8KdRoR6r6Ely','user2@yahoo.com','user2','','user','/coplat/images/profileimages/default_pic.jpg',1,'a89ywq3htq',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1031,'user3','$2a$08$19eVYBhvG80RQRLEVDCvIuggnKrbposjdOf8Vn1GzchmV0m.uj3Na','user3@yahoo.com','user3','','user','/coplat/images/profileimages/default_pic.jpg',1,'428uq6vr00',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1032,'atestmentor1','$2a$08$rHBUBVYP/yYZr6T.VxrRe.oxOYLQHoTQgPBg7kGtijPuG5TncicFe','adurocruor@gmail.com','A test','','Mentor1','/coplat/images/profileimages/default_pic.jpg',1,'qhgp6rmof0',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,1,1,1,0,0,0,0,0),(1033,'atestmentor2','$2a$08$V1L5fnVkiooI4rqklUPbkOe2OKseFeM13MaYs/fx/.To0I1G3Xvq6','kimora.hideki@gmail.com','A test','','Mentor2','/coplat/images/profileimages/default_pic.jpg',1,'y4u1aoq2pg',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,1,1,0,0,0,0,0),(1034,'atestmentor3','$2a$08$WeabsO605oiN0z4fXEjSRuMt93dPCJF5YgoYvkqm.knOqLgUFfC.a','slayer763@yahoo.com','A testm1','','Mentor3','/coplat/images/profileimages/default_pic.jpg',1,'ffiuczzmx3',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,1,0,0,0,0,0),(1035,'anothertestment','$2a$08$LafUmMh2YGS5HzE/KQZjgOfeuO15atf9oloqFulyPrtxxCkKndSSa','atestmentor7@gmail.com','another','','testment','/coplat/images/profileimages/default_pic.jpg',1,'5lglskfzbq',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,1,0,0,0,0,0),(1036,'professorAwesome','$2a$08$Jw4y1P57id/ACfwb8HGpC.Lay2lVSD9KE6rI6VIrtrsusxrRghEMO','anemia@acd.com','A professor','dr','mc awesome','/coplat/images/profileimages/default_pic.jpg',1,'c04z6ueg69',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1037,'user4','$2a$08$nYB9jVl..Xq.NISDDxUaaOmeBMc579FAlcIoQH9UcQ/dlC86wzLW.','coplatuser4@gmail.com','user','','four','/coplat/images/profileimages/default_pic.jpg',1,'w4bvas9k4e',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1038,'mandiellastra','$2a$08$BPTjyoblYhWFEq///YdFUuYmntblxmwF2Bzb.f1Bm7yUPANcM4Wa2','mandiel.lastra@fpl.com','Mandiel','','WorkAccount','/coplat/images/profileimages/default_pic.jpg',1,'whsaxwgmqp',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,1,0,0,0,0,0),(1039,'testypersonal','$2a$08$skpp6DkiTtyuqYyiK23MMeRmPxPsNW5Sl2lsLWt0W96em6sbuPVAC','bubkis@gmail.com','Testy','','PersonalM','/coplat/images/profileimages/default_pic.jpg',1,'jd16vytbxm',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,1,0,0,0,0,0,0),(1040,'testymentor2','$2a$08$FjVFYhBFwLMszMdYFu3geeByAgPd8gvdRiUKHpphdHKzoKdCsKMTG','dontsend@gmail.com','testy','','mentor2','/coplat/images/profileimages/default_pic.jpg',1,'03x66gjy5p',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,1,1,0,0,0,0,0),(1042,'user5','$2a$08$bia0wbaJH5knZmJc2QQpU.rUWpUaFJlWlfVka1WR6O/cru6aezFIy','sface@doesnmatter.com','auser','','user5','/coplat/images/profileimages/default_pic.jpg',1,'7s0ld95cxe',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1043,'user6','$2a$08$/FR78JBkcGF5hKfXyxY6AenDUA429Gi1jyP1px9jG7NTxmsVo67Ra','user6@gmail.com','auser','','user6','/coplat/images/profileimages/default_pic.jpg',1,'1o1a3kkggi',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1044,'user7','$2a$08$/zfptbelznCkDx3XfVCb5.l8sl9r8p3S/NmObVaf/DYcuWE9c6/Ey','user7@gmail.com','auser','','user7','/coplat/images/profileimages/default_pic.jpg',1,'dl3fehb6cp',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1045,'user8','$2a$08$ulOEspYydS4kHhCERaGYq.5Wgx6KD0/xXiv8hdVKckQhSIakBAb3C','user8@gmail.com','auser','','user8','/coplat/images/profileimages/default_pic.jpg',1,'r6exi0y1kk',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1046,'testmentee','$2a$08$ZTlM6ebbbtxrA9HwUKmO7.PN6.zB2uQ.lQITXfg.HYVdohiIUtgXa','mentee@gmail.com','Mentee','','testment','/coplat/images/profileimages/default_pic.jpg',1,'n1vvdhrtlt',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,1,0,0,0),(1047,'testroll','$2a$08$El9rzakiJgTgksPvgW3mAObgypkLM6/Lg.Rzz94tR6X3zu2zFM7/u','blanck@gmail.com','noroll','','mcgee','/coplat/images/profileimages/default_pic.jpg',1,'zcoea2pngs',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1048,'testuser','$2a$08$cIvtSOJtWTRDU9m1rRo8ouXM/hi0sTlBhsU45TXG5/vhHhTTMLTUC','mandylastra@gmail.com','Test','','User','/coplat/images/profileimages/default_pic.jpg',1,'dtnkwkhxjl',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1052,'rdomi005','$2a$08$RSlISA6JFTwdgkGpXJ1dh.ixJ47dED4DTU0lk02bJQ8vO8UeQsFK2','rdomi005@fiu.edu','Ricky','','Dominguez','/coplat/images/profileimages/default_pic.jpg',1,'90j3kdttr1',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,1,1,1,1,1,0,0,0),(1053,'jandr018','$2a$08$s0f1NMyie.AVYD5iSX6jged1TSKyozsmMRTELa3W8St08wb3RoFkO','jandr018@fiu.edu','Javier','','Andrial',NULL,1,NULL,0,NULL,NULL,NULL,'3578336',NULL,0,0,0,0,0,1,0,0,0),(1054,'rarci003','$2a$08$r.nQDlFdJ13Aa1gHD3B7X.nZzoXcyCulJP5AVtT1Rq382OS4l9e02','rarci003@fiu.edu','Roberto','','Arciniegas',NULL,1,NULL,0,NULL,NULL,NULL,'1385020',NULL,0,0,0,0,0,1,0,0,0),(1055,'aarri004','$2a$08$h5m/cgQhOmJA560QEUQ.ee1hUBYYjpixJgTF6P2/n03Z8MdbD7MnO','aarri004@fiu.edu','Antonio','','Arrieta',NULL,1,NULL,0,NULL,NULL,NULL,'3493688',NULL,0,0,0,0,0,1,0,0,0),(1056,'dbaez011','$2a$08$CnRWn1lKmw2/qfPltmtwNumWE/ixbCqbkm7JJWl4FkPJiY7fvdy2K','dbaez011@fiu.edu','David','','Baez',NULL,1,NULL,0,NULL,NULL,NULL,'2984534',NULL,0,0,0,0,0,1,0,0,0),(1057,'ecast040','$2a$08$2M7OII7SJOvXFL8.Rq/.luG6VoY/F3e875JPa8g6KOwutuU.oyiRu','ecast040@fiu.edu','Eduardo','','Castillo',NULL,1,NULL,0,NULL,NULL,NULL,'3282474',NULL,0,0,0,0,0,1,0,0,0),(1058,'lcast053','$2a$08$Oc95.4nO6/BU.Fl3pg55GuZwB5tCRvX7zQaBkf9C.H072YKb9a4Qi','lcast053@fiu.edu','Luis','','Castillo',NULL,1,NULL,0,NULL,NULL,NULL,'3607503',NULL,0,0,0,0,0,1,0,0,0),(1059,'mchiu002','$2a$08$4cZQg5e5vPqwmciqQxlKCeoHS3QYrXrmGpjOCyUKDGqaBtZINouQ.','mchiu002@fiu.edu','Amanda','','Chiu',NULL,1,NULL,0,NULL,NULL,NULL,'3325669',NULL,0,0,0,0,0,1,0,0,0),(1060,'cchoi003','$2a$08$dYuaW7osirhN7J6gsb4X4.vq5S9eE0TAehFeMq2nx9cJIi1ZBuQZm','cchoi003@fiu.edu','Christopher','','Choitz',NULL,1,NULL,0,NULL,NULL,NULL,'3634356',NULL,0,0,0,0,0,1,0,0,0),(1061,'jcorr091','$2a$08$o8XmBm55YTPLdLijLphKZ.8rioReahd9Bx9RAqQC0G9jI7DbRAKDq','jcorr091@fiu.edu','Juan','','Correa',NULL,1,NULL,0,NULL,NULL,NULL,'4267479',NULL,0,0,0,0,0,1,0,0,0),(1062,'rdelr011','$2a$08$h/XwQAPdMDgHq/Dkut0gUObCwsySUoqxT.SXW2mSBEcF/2LXqbcvC','rdelr011@fiu.edu','Ryan','','Rosario',NULL,1,NULL,0,NULL,NULL,NULL,'3784838',NULL,0,0,0,0,0,1,0,0,0),(1063,'efeld016','$2a$08$m6R18z4fwoJkKDAuLxpUvecIaZA.p0ZhQzmHAHtDU3lZsK12.lCAW','efeld016@fiu.edu','Eldar','','Feldbeine',NULL,1,NULL,0,NULL,NULL,NULL,'4958294',NULL,0,0,0,0,0,1,0,0,0),(1064,'sferr047','$2a$08$pN075D34XlhN9nxQlxBKi.xSN.ktpddDtNlf5/wNORz0EZuJHVKOW','sferr047@fiu.edu','Shadeh','','Ferris',NULL,1,NULL,0,NULL,NULL,NULL,'2289509',NULL,0,0,0,0,0,1,0,0,0),(1065,'jflet013','$2a$08$.CV..4FzZJNPgbkxresdSei6v5UZHq/JQ6Q3VRFaq/OsaNtuw11LO','jflet013@fiu.edu','Justin','','Fletcher',NULL,1,NULL,0,NULL,NULL,NULL,'1922275',NULL,0,0,0,0,0,1,0,0,0),(1066,'sfoo004','$2a$08$hNZACulnMAijPqqDTbpoFeHO3aMpgvdNn9L/.GqydulLXpkgPkpMi','sfoo004@fiu.edu','Steve','','Foo',NULL,1,NULL,0,NULL,NULL,NULL,'2284524',NULL,0,0,0,0,0,1,0,0,0),(1067,'mfuer004','$2a$08$RScduIZhE9JEIVZRCAOdSulDQK7zyTj2rO687sEVFc5P1uduECGWa','mfuer004@fiu.edu','Michael','','Fuertes',NULL,1,NULL,0,NULL,NULL,NULL,'3434142',NULL,0,0,0,0,0,1,0,0,0),(1068,'wgome015','$2a$08$ZuhId0FjHps3gdoeqWfS6ucRgp.c.aqhWWcd8SWBv9YigDUa6aDcS','wgome015@fiu.edu','Wilfredo','','Gomez',NULL,1,NULL,0,NULL,NULL,NULL,'4741772',NULL,0,0,0,0,0,1,0,0,0),(1069,'ahern379','$2a$08$BvhjSSye2ev9cHPrAdaWK.Kaz6vhqayE/HNegbfSrAHSH.uY6xVs.','ahern379@fiu.edu','Anais','','Hernandez',NULL,1,NULL,0,NULL,NULL,NULL,'3884585',NULL,0,0,0,0,0,1,0,0,0),(1070,'fhern087','$2a$08$y5WBwNpzugdgT34ztLPpdOgoJjh2ewSumI54XxP5LjNh6RT2wOhgq','fhern087@fiu.edu','Frank','','Hernandez',NULL,1,NULL,0,NULL,NULL,NULL,'2074519',NULL,0,0,0,0,0,1,0,0,0),(1072,'mkell008','$2a$08$5Dt3p2pUsHuf4iw0/fUO.ur4nVC94bK1E.a8Sc3D0fYUhMvaYZc6u','mkell008@fiu.edu','Marcine','','Kelly',NULL,1,NULL,0,NULL,NULL,NULL,'2628263',NULL,0,0,0,0,0,1,0,0,0),(1073,'vlope093','$2a$08$bm.dOfE5Dv9DzQa.IXFIaeyVVEkJfGcoUZc62Q2SvJapBxFWh4rqW','vlope093@fiu.edu','Valeria','','Lopez',NULL,1,NULL,0,NULL,NULL,NULL,'3875813',NULL,0,0,0,0,0,1,0,0,0),(1074,'jmach019','$2a$08$KmzRJjo582YvljSiaK7ZD.BNxjSTOsZYqyJTGMdECbKPGAgWIwiHS','jmach019@fiu.edu','Juan','','Machado',NULL,1,NULL,0,NULL,NULL,NULL,'3026305',NULL,0,0,0,0,0,1,0,0,0),(1075,'mmesq001','$2a$08$RlGW2xUV0n2PojJ/AELzfO.YalX9Y2vc5NnJVkKOjd5RURdG0J49e','mmesq001@fiu.edu','Mardoqueu','','Mesquita',NULL,1,NULL,0,NULL,NULL,NULL,'3323995',NULL,0,0,0,0,0,1,0,0,0),(1076,'pmont016','$2a$08$r76vzup0zWejo6QPOmHfE..yluSyZ6PHoFRX20z0x6eTeVEYaCLiS','pmont016@fiu.edu','Pedro','','Montero',NULL,1,NULL,0,NULL,NULL,NULL,'3315187',NULL,0,0,0,0,0,1,0,0,0),(1077,'preid009','$2a$08$86kIqJEQKXAIg6CY9yaP7OtGNH5QSJYS4aFz3rFYX.fUc5tCGuMGK','preid009@fiu.edu','Peter','','Reidy',NULL,1,NULL,0,NULL,NULL,NULL,'3867251',NULL,0,0,0,0,0,1,0,0,0),(1078,'wrodr032','$2a$08$Htt33TwxZaMxx0MTMux2l.07LdVxplxuRL3.cMlCY7m1nyWBE90hm','wrodr032@fiu.edu','Wilfrido','','Rodriguez',NULL,1,NULL,0,NULL,NULL,NULL,'3912254',NULL,0,0,0,0,0,1,0,0,0),(1079,'mroge009','$2a$08$NvMKp./.ikxQHYXwIbycceowYGSS1Kta6xxJ0uWL1.fI8iBdc5FSa','mroge009@fiu.edu','Marc-Antoine','','Roger',NULL,1,NULL,0,NULL,NULL,NULL,'2995664',NULL,0,0,0,0,0,1,0,0,0),(1080,'cruiz084','$2a$08$g4Rmc7yKrTcClsRsN5Q.rOsEKtgEdeIwLNoIeaRFZyAPjhDpbEStS','cruiz084@fiu.edu','Carlos','','Ruiz',NULL,1,NULL,0,NULL,NULL,NULL,'4556367',NULL,0,0,0,0,0,1,0,0,0),(1081,'gruiz044','$2a$08$0AMH2lTjb3eo7uh1xqnH0uFfKh77RQZw0mDNhWgC9sBI4kMKC16hy','gruiz044@fiu.edu','Guido','','Ruiz',NULL,1,NULL,0,NULL,NULL,NULL,'3912460',NULL,0,0,0,0,0,1,0,0,0),(1082,'rsanc172','$2a$08$DYjA8OYweWz2z.X/k7pmJ.ixAFZVNcy0KkEyAk5Qbe7pj0iyXL7iG','rsanc172@fiu.edu','Rodney','','Sanchez',NULL,1,NULL,0,NULL,NULL,NULL,'5063374',NULL,0,0,0,0,0,1,0,0,0),(1083,'ashah023','$2a$08$gJOd4t3i22itub3l3Bb6ZuwxtFZIsI6QKIjMef09XzJdUXJXxAukm','ashah023@fiu.edu','Aqib','','Shah',NULL,1,NULL,0,NULL,NULL,NULL,'3353447',NULL,0,0,0,0,0,1,0,0,0),(1084,'itroc001','$2a$08$smOPr4kGXPbeLhvRKVXUyOE00LMY8mD68cXxUPkSglC8wdKLwEfdC','itroc001@fiu.edu','Ingrid','','Troche',NULL,1,NULL,0,NULL,NULL,NULL,'2666916',NULL,0,0,0,0,0,1,0,0,0),(1085,'fvinc004','$2a$08$z4TXmTQo09tR/ric1VEbxe7hAoSkX1w5eWRVlAfPStdo.j4zeJY7i','fvinc004@fiu.edu','Frank','','Vincench',NULL,1,NULL,0,NULL,NULL,NULL,'3224720',NULL,0,0,0,0,0,1,0,0,0),(1086,'dyami004','$2a$08$sR0Mo.YySMCkxbcox9B23ORU49Mm2XasBsHBWNLGNWWkzGwpG2oCi','dyami004@fiu.edu','Dayan','','Yamin',NULL,1,NULL,0,NULL,NULL,NULL,'2670782',NULL,0,0,0,0,0,1,0,0,0),(1087,'dyoun007','$2a$08$1htuvI9ubheD9zyvIrC2D.TcAjSFHFZwxgvKMh68WvpNnbeAHBzlO','dyoun007@fiu.edu','Daniel','','Young',NULL,1,NULL,0,NULL,NULL,NULL,'3181545',NULL,0,0,0,0,0,1,0,0,0),(1088,'cjone089','$2a$08$5w.tozsy8HKkN2Wo1mZEjuzzi1MrmmT20YFyCmRF7dlbDylRlAFaK','cjone089@fiu.edu','Christopher','Roy','Jones','/coplat/images/profileimages/default_pic.jpg',1,'cqh5iqfxea',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0),(1089,'ftest','$2a$08$JeI9hNNLiSf8AtGXxQZMMuHy55cyDLLJb/iuDSX.exOrr3YTKTTO6','coplatftest@gmail.com','Test','','Test','/coplat/images/profileimages/default_pic.jpg',1,'c1k1x7zatg',0,'Tell us something about yourself...',NULL,NULL,NULL,NULL,0,0,0,1,0,0,0,0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_domain`
--

LOCK TABLES `user_domain` WRITE;
/*!40000 ALTER TABLE `user_domain` DISABLE KEYS */;
INSERT INTO `user_domain` VALUES (2,7,8,1,8,1,1),(4,8,10,NULL,10,1,1),(5,19,8,1,10,1,1),(99,17,8,1,8,1,1),(100,19,8,2,9,1,1),(101,17,8,2,9,1,1),(102,1012,8,NULL,5,1,1),(103,1012,8,1,5,1,1),(104,1013,8,NULL,5,1,1),(105,1013,8,2,2,1,1),(106,1013,8,8,3,1,1),(107,1013,8,NULL,5,1,1),(117,6,8,NULL,NULL,1,NULL),(118,6,8,1,2,1,2),(119,6,8,2,1,1,2),(120,10,8,1,1,1,1),(121,10,8,NULL,3,1,1),(122,10,8,NULL,3,1,1),(123,5,8,NULL,6,1,1),(124,5,9,NULL,8,1,1),(125,1032,8,NULL,NULL,1,NULL),(126,1032,8,5,10,1,1),(129,1033,8,NULL,NULL,1,NULL),(130,1033,8,5,8,1,1),(131,1034,8,NULL,NULL,1,NULL),(132,1034,8,5,10,1,1),(133,1026,8,NULL,6,1,1),(134,1026,8,5,9,1,1),(137,1035,8,NULL,NULL,1,NULL),(138,1035,8,5,10,1,1),(139,1038,8,NULL,10,1,1),(140,1038,10,NULL,10,1,1),(141,1032,8,NULL,10,1,1),(142,1032,8,1,10,1,1),(143,1040,10,NULL,10,1,1),(144,1040,10,9,10,1,1),(147,1052,8,NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `user_domain` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `user_info` VALUES (1013,'Demo','Demo',2014,'Bachelors','Demo','Demo',2014),(1016,'FIU','Professor',0,'PhD','CS','FIU',1999),(1025,'Adship','1',0,'Currently Pursuing Degree','wrwer','FIU',2015),(1029,'','',NULL,'Select','','',0),(1030,'','',NULL,'Select','','',0),(1031,'','',NULL,'Select','','',0),(1036,'FIU','professor',NULL,'PhD','Bio engineering','MIT',1987),(1037,'FPL','Information Security Admin',NULL,'Bachelors','Computer Science','Florida Int University',2015),(1038,'','',NULL,'Select','','',0),(1039,'','',NULL,'Select','','',0),(1040,'','',NULL,'Select','','',0),(1042,'','',NULL,'Select','','',0),(1043,'','',NULL,'Select','','',0),(1044,'','',NULL,'Select','','',0),(1045,'','',NULL,'Select','','',0),(1046,'','',NULL,'Select','','',0),(1047,'','',NULL,'Select','','',0),(1048,'','',NULL,'Select','','',0),(1088,'','',NULL,'Select','','',0),(1089,'','',NULL,'Select','','',0);
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
INSERT INTO `vc_invitation` VALUES (1,22,'Unknown'),(2,22,'Unknown'),(3,1022,'Unknown'),(3,1026,'Unknown'),(4,22,'Unknown'),(4,1027,'Unknown'),(5,1022,'Accepted'),(5,1026,'Unknown'),(6,5,'Rejected'),(7,5,'Rejected'),(7,1029,'Unknown'),(7,1030,'Unknown'),(7,1031,'Maybe'),(8,1022,'Unknown'),(8,1026,'Unknown'),(9,1029,'Unknown'),(10,1029,'Unknown'),(11,1022,'Unknown'),(11,1026,'Unknown'),(12,1029,'Unknown'),(13,1029,'Unknown'),(14,1022,'Accepted'),(14,1026,'Unknown'),(14,1029,'Maybe'),(14,1030,'Maybe'),(15,5,'Unknown'),(16,1033,'Unknown'),(17,1033,'Unknown'),(18,1033,'Unknown'),(19,1033,'Unknown'),(20,1033,'Unknown'),(21,1033,'Unknown'),(22,1033,'Unknown'),(23,1033,'Unknown'),(24,1033,'Unknown'),(25,1029,'Unknown'),(26,5,'Unknown'),(27,22,'Unknown'),(27,1029,'Unknown'),(27,1030,'Unknown'),(27,1031,'Unknown'),(28,5,'Unknown'),(29,22,'Unknown'),(29,1027,'Unknown'),(30,1027,'Unknown'),(31,1027,'Unknown'),(32,22,'Unknown'),(32,1027,'Unknown'),(33,1029,'Unknown'),(34,1029,'Unknown'),(35,1029,'Unknown'),(36,1027,'Rejected'),(37,1026,'Unknown'),(39,22,'Unknown'),(40,22,'Unknown'),(41,1029,'Unknown'),(41,1030,'Unknown'),(42,1029,'Unknown'),(42,1030,'Unknown'),(43,1029,'Unknown'),(43,1030,'Unknown'),(44,1029,'Unknown'),(44,1030,'Unknown'),(45,1029,'Unknown'),(45,1030,'Unknown'),(46,1029,'Unknown'),(46,1030,'Unknown'),(47,22,'Unknown'),(48,22,'Unknown'),(49,1027,'Unknown'),(51,1029,'Accepted'),(51,1030,'Unknown'),(52,1022,'Unknown'),(52,1027,'Unknown'),(52,1029,'Unknown'),(52,1030,'Unknown'),(52,1031,'Maybe'),(53,5,'Unknown'),(53,6,'Unknown'),(53,7,'Unknown'),(53,8,'Unknown'),(53,9,'Unknown'),(53,10,'Unknown'),(53,11,'Unknown'),(53,16,'Unknown'),(53,17,'Unknown'),(53,18,'Unknown'),(53,19,'Unknown'),(53,20,'Unknown'),(53,21,'Unknown'),(53,999,'Unknown'),(53,1000,'Unknown'),(53,1002,'Unknown'),(53,1003,'Unknown'),(53,1004,'Unknown'),(53,1005,'Unknown'),(53,1006,'Unknown'),(53,1012,'Unknown'),(53,1013,'Unknown'),(53,1015,'Unknown'),(53,1016,'Unknown'),(53,1017,'Unknown'),(53,1018,'Unknown'),(53,1019,'Unknown'),(53,1020,'Unknown'),(53,1021,'Unknown'),(53,1022,'Unknown'),(53,1023,'Unknown'),(53,1025,'Unknown'),(53,1026,'Unknown'),(53,1028,'Unknown'),(53,1029,'Unknown'),(53,1030,'Unknown'),(53,1031,'Unknown'),(53,1032,'Unknown'),(53,1033,'Unknown'),(53,1034,'Unknown'),(53,1035,'Unknown'),(53,1036,'Unknown'),(53,1037,'Unknown'),(53,1038,'Unknown'),(53,1039,'Unknown'),(53,1040,'Unknown'),(54,1035,'Unknown'),(55,5,'Unknown'),(55,6,'Unknown'),(55,7,'Unknown'),(55,8,'Unknown'),(55,9,'Unknown'),(55,10,'Unknown'),(55,11,'Unknown'),(55,16,'Unknown'),(55,17,'Unknown'),(55,18,'Unknown'),(55,19,'Unknown'),(55,20,'Unknown'),(55,21,'Unknown'),(55,999,'Unknown'),(55,1000,'Unknown'),(55,1002,'Unknown'),(55,1003,'Unknown'),(55,1004,'Unknown'),(55,1005,'Unknown'),(55,1006,'Unknown'),(55,1012,'Unknown'),(55,1013,'Unknown'),(55,1015,'Unknown'),(55,1016,'Unknown'),(55,1017,'Unknown'),(55,1018,'Unknown'),(55,1019,'Unknown'),(55,1020,'Unknown'),(55,1021,'Unknown'),(55,1022,'Unknown'),(55,1023,'Unknown'),(55,1025,'Unknown'),(55,1026,'Unknown'),(55,1028,'Unknown'),(55,1029,'Unknown'),(55,1030,'Unknown'),(55,1031,'Unknown'),(55,1032,'Unknown'),(55,1033,'Unknown'),(55,1034,'Unknown'),(55,1035,'Unknown'),(55,1036,'Unknown'),(55,1037,'Unknown'),(55,1038,'Unknown'),(55,1039,'Unknown'),(55,1040,'Unknown'),(56,5,'Unknown'),(56,6,'Unknown'),(56,7,'Unknown'),(56,8,'Unknown'),(56,9,'Unknown'),(56,10,'Unknown'),(56,11,'Unknown'),(56,16,'Unknown'),(56,17,'Unknown'),(56,18,'Unknown'),(56,19,'Unknown'),(56,20,'Unknown'),(56,21,'Unknown'),(56,999,'Unknown'),(56,1000,'Unknown'),(56,1002,'Unknown'),(56,1003,'Unknown'),(56,1004,'Unknown'),(56,1005,'Unknown'),(56,1006,'Unknown'),(56,1012,'Unknown'),(56,1013,'Unknown'),(56,1015,'Unknown'),(56,1016,'Unknown'),(56,1017,'Unknown'),(56,1018,'Unknown'),(56,1019,'Unknown'),(56,1020,'Unknown'),(56,1021,'Unknown'),(56,1022,'Unknown'),(56,1023,'Unknown'),(56,1025,'Unknown'),(56,1026,'Unknown'),(56,1028,'Unknown'),(56,1029,'Unknown'),(56,1030,'Unknown'),(56,1031,'Unknown'),(56,1032,'Unknown'),(56,1033,'Unknown'),(56,1034,'Unknown'),(56,1035,'Unknown'),(56,1036,'Unknown'),(56,1037,'Unknown'),(56,1038,'Unknown'),(56,1039,'Unknown'),(56,1040,'Unknown'),(57,5,'Unknown'),(57,6,'Unknown'),(57,7,'Unknown'),(57,8,'Unknown'),(57,9,'Unknown'),(57,10,'Unknown'),(57,11,'Unknown'),(57,16,'Unknown'),(57,17,'Unknown'),(57,18,'Unknown'),(57,19,'Unknown'),(57,20,'Unknown'),(57,21,'Unknown'),(57,999,'Unknown'),(57,1000,'Unknown'),(57,1002,'Unknown'),(57,1003,'Unknown'),(57,1004,'Unknown'),(57,1005,'Unknown'),(57,1006,'Unknown'),(57,1012,'Unknown'),(57,1013,'Unknown'),(57,1015,'Unknown'),(57,1016,'Unknown'),(57,1017,'Unknown'),(57,1018,'Unknown'),(57,1019,'Unknown'),(57,1020,'Unknown'),(57,1021,'Unknown'),(57,1022,'Unknown'),(57,1023,'Unknown'),(57,1025,'Unknown'),(57,1026,'Unknown'),(57,1028,'Unknown'),(57,1029,'Unknown'),(57,1030,'Unknown'),(57,1031,'Unknown'),(57,1032,'Unknown'),(57,1033,'Unknown'),(57,1034,'Unknown'),(57,1035,'Unknown'),(57,1036,'Unknown'),(57,1037,'Unknown'),(57,1038,'Unknown'),(57,1039,'Unknown'),(57,1040,'Unknown'),(58,5,'Unknown'),(58,6,'Unknown'),(58,7,'Unknown'),(58,8,'Unknown'),(58,9,'Unknown'),(58,10,'Unknown'),(58,11,'Unknown'),(58,16,'Unknown'),(58,17,'Unknown'),(58,18,'Unknown'),(58,19,'Unknown'),(58,20,'Unknown'),(58,21,'Unknown'),(58,999,'Unknown'),(58,1000,'Unknown'),(58,1002,'Unknown'),(58,1003,'Accepted'),(58,1004,'Unknown'),(58,1005,'Unknown'),(58,1006,'Unknown'),(58,1012,'Unknown'),(58,1013,'Unknown'),(58,1015,'Unknown'),(58,1016,'Unknown'),(58,1017,'Unknown'),(58,1018,'Unknown'),(58,1019,'Unknown'),(58,1020,'Unknown'),(58,1021,'Unknown'),(58,1022,'Unknown'),(58,1023,'Unknown'),(58,1025,'Unknown'),(58,1026,'Unknown'),(58,1028,'Unknown'),(58,1029,'Unknown'),(58,1030,'Unknown'),(58,1031,'Unknown'),(58,1032,'Unknown'),(58,1033,'Unknown'),(58,1034,'Unknown'),(58,1035,'Unknown'),(58,1036,'Unknown'),(58,1037,'Unknown'),(58,1038,'Unknown'),(58,1039,'Unknown'),(58,1040,'Unknown'),(61,1027,'Unknown'),(62,1027,'Unknown'),(62,1032,'Unknown'),(64,1027,'Unknown'),(66,1027,'Unknown'),(67,1027,'Unknown'),(71,1026,'Unknown'),(75,1038,'Unknown'),(76,1022,'Unknown'),(76,1029,'Maybe'),(77,1029,'Unknown'),(77,1030,'Rejected'),(77,1031,'Unknown'),(77,1042,'Unknown'),(77,1043,'Accepted'),(77,1044,'Unknown'),(77,1045,'Unknown'),(78,1026,'Unknown'),(78,1027,'Unknown'),(78,1029,'Unknown'),(78,1030,'Unknown'),(79,1026,'Unknown'),(79,1027,'Unknown'),(79,1029,'Unknown'),(79,1030,'Unknown'),(80,1026,'Unknown'),(80,1027,'Unknown'),(89,1022,'Unknown'),(89,1039,'Unknown'),(91,1029,'Maybe'),(92,1029,'Unknown'),(93,1048,'Unknown'),(94,1029,'Unknown'),(94,1030,'Unknown'),(94,1048,'Accepted'),(95,1032,'Unknown'),(95,1046,'Unknown'),(96,20,'Unknown'),(97,1026,'Unknown'),(99,1026,'Unknown'),(99,1027,'Unknown'),(100,5,'Unknown'),(100,1029,'Unknown'),(101,1026,'Unknown');
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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_conference`
--

LOCK TABLES `video_conference` WRITE;
/*!40000 ALTER TABLE `video_conference` DISABLE KEYS */;
INSERT INTO `video_conference` VALUES (1,'tst',5,'2015-04-24 21:56:47','2015-04-24 21:56:47','sfsdf','scheduled'),(2,'mySubject',5,'2015-04-24 21:57:29','2015-04-24 21:57:29','sfsdf','cancelled'),(14,'Daily Scrum',1027,'2015-06-08 18:01:47','2015-06-08 18:01:47','','cancelled'),(15,'A test ticket - Ticket #81',1032,'2015-06-08 19:42:11','2015-06-08 19:42:11','see who this is assigned to','scheduled'),(16,'yet another - Ticket #96',5,'2015-06-09 19:08:16','2015-06-09 19:08:16','here we go','scheduled'),(17,'yet another - Ticket #96',5,'2015-06-09 19:08:24','2015-06-09 19:08:24','here we go','scheduled'),(18,'yet another - Ticket #96',5,'2015-06-09 19:08:29','2015-06-09 19:08:29','here we go','scheduled'),(19,'yet another - Ticket #96',5,'2015-06-09 19:09:27','2015-06-09 19:09:27','here we gossf','scheduled'),(20,'yet another - Ticket #96',5,'2015-06-09 19:09:31','2015-06-09 19:09:31','here we gossf','scheduled'),(21,'yet another - Ticket #96',5,'2015-06-09 19:10:22','2015-06-09 19:10:22','here we go','scheduled'),(22,'yet another - Ticket #96',5,'2015-06-09 19:10:29','2015-06-09 19:10:29','here we go','scheduled'),(23,'yet another - Ticket #96',5,'2015-06-09 19:10:32','2015-06-09 19:10:32','here we go','scheduled'),(24,'yet another - Ticket #96',5,'2015-06-09 19:10:39','2015-06-09 19:10:39','here we go','scheduled'),(26,'a c#ticket - Ticket #77',1033,'2015-06-10 10:10:11','2015-06-10 10:10:11','a C# ticket','scheduled'),(28,'this will def assign to aduro - Ticket #107',1032,'2015-06-12 00:34:47','2015-06-12 00:34:47','hopefully adding the return path makes a difference','cancelled'),(37,'test',5,'2015-06-16 13:46:56','2015-06-16 13:46:56','','scheduled'),(46,'VideoTest',1027,'2015-07-24 14:06:02','2015-07-24 14:06:02','These are my notes','cancelled'),(49,'Test VC',5,'2015-07-08 00:33:56','2015-07-08 00:33:56','','scheduled'),(51,'bolo',1026,'2015-07-08 14:37:29','2015-07-08 14:37:29','','scheduled'),(52,'daily scrum',1026,'2015-07-08 18:07:05','2015-07-08 18:07:05','','scheduled'),(54,'a test conference',1022,'2015-07-08 22:49:49','2015-07-08 22:49:49','none','cancelled'),(61,'Test',1029,'2015-07-10 08:42:14','2015-07-10 08:42:14','','cancelled'),(62,'A test scenario',1022,'2015-07-10 09:35:57','2015-07-10 09:35:57','stuff and thigns','scheduled'),(76,'test',1027,'2015-07-13 14:24:35','2015-07-13 14:24:35','','cancelled'),(77,'bolo',1026,'2015-07-13 17:33:59','2015-07-13 17:33:59','','scheduled'),(78,'Daily Scrum',1022,'2015-07-14 15:56:02','2015-07-14 18:00:00','Hey check this out on your homepage','scheduled'),(79,'Daily scrum 3',1022,'2015-07-15 17:28:48','2015-07-15 18:00:00','to showcase late','scheduled'),(80,'daily scrum',1022,'2015-07-16 17:43:38','2015-07-16 18:00:00','check if link from howepage works','scheduled'),(81,'Testing',1027,'2015-07-16 18:14:13','2015-08-05 10:00:00','','cancelled'),(82,'test',1029,'2015-07-16 19:27:17','2015-07-16 19:27:17','','cancelled'),(83,'sfdaf',1029,'2015-07-16 22:39:35','2015-07-16 22:39:35','','cancelled'),(84,'sdfasdf',1029,'2015-07-16 22:39:56','2015-07-16 22:39:56','','cancelled'),(85,'asdf',1029,'2015-07-16 23:03:11','2015-07-16 23:03:11','','scheduled'),(86,'Testing',1027,'2015-07-20 19:28:46','2015-07-20 19:28:46','','scheduled'),(87,'Future',1027,'2015-07-20 19:29:07','2015-07-30 09:00:00','','cancelled'),(88,'ddd',1027,'2015-07-21 21:21:17','2015-07-21 21:21:17','','scheduled'),(89,'A showcase',1032,'2015-07-24 10:19:32','2015-07-24 10:19:32','nothing','scheduled'),(90,'A showcase video conferance',1022,'2015-07-24 16:27:43','2015-07-24 16:30:00','','scheduled'),(91,'Test',1027,'2015-07-24 16:34:15','2015-08-05 09:00:00','','scheduled'),(92,'Test',1027,'2015-07-28 00:05:23','2015-07-28 00:05:23','This is a demo','scheduled'),(93,'test',1027,'2015-07-28 01:02:19','2015-07-28 01:02:19','','cancelled'),(94,'Showcase',1027,'2015-07-28 01:12:02','2015-07-28 01:12:02','This is a meeting to go over...','cancelled'),(95,'asdf - Ticket #171',5,'2015-07-28 01:20:31','2015-07-28 01:20:31','ceaecfc','scheduled'),(96,'a showcase',1033,'2015-07-28 16:48:24','2015-07-28 16:48:24','test','scheduled'),(97,'A showcase',1022,'2015-07-28 17:11:47','2015-07-28 17:11:47','none','scheduled'),(98,'Showcase',1038,'2015-07-28 21:29:45','2015-07-28 21:29:45','This meeting is to...','scheduled'),(99,'a showcase',1022,'2015-07-31 14:21:36','2015-07-31 16:30:00','sldfjsf','scheduled'),(100,'test',1027,'2015-07-31 16:33:23','2015-07-31 16:33:23','notes','scheduled'),(101,'Meeting 11/13',1052,'2015-11-13 09:12:19','2015-11-13 09:12:19','','scheduled');
/*!40000 ALTER TABLE `video_conference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `report_mentee`
--

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

-- Dump completed on 2015-12-09 12:23:08
