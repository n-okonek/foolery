-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: glazpmck_ics370
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `companyName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companyName_UNIQUE` (`companyName`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'Glazed Productions');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `couponDesc` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `distributingCo_idx` (`company`),
  CONSTRAINT `distributingCo` FOREIGN KEY (`company`) REFERENCES `company` (`companyName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'Test1234','This is a test coupon',NULL),(2,'test3','This is another test coupon','Glazed Productions'),(3,'test2','This is yet another test coupon','Glazed Productions');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pwdreset`
--

DROP TABLE IF EXISTS `pwdreset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pwdreset` (
  `pwdResetID` int NOT NULL AUTO_INCREMENT,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL,
  PRIMARY KEY (`pwdResetID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pwdreset`
--

LOCK TABLES `pwdreset` WRITE;
/*!40000 ALTER TABLE `pwdreset` DISABLE KEYS */;
/*!40000 ALTER TABLE `pwdreset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retailers`
--

DROP TABLE IF EXISTS `retailers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `retailers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(72) DEFAULT NULL,
  `Psword` varchar(45) DEFAULT NULL,
  `FName` varchar(24) DEFAULT NULL,
  `LName` varchar(24) DEFAULT NULL,
  `AccountCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `Company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_idx` (`Company`),
  CONSTRAINT `company` FOREIGN KEY (`Company`) REFERENCES `company` (`companyName`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailers`
--

LOCK TABLES `retailers` WRITE;
/*!40000 ALTER TABLE `retailers` DISABLE KEYS */;
INSERT INTO `retailers` VALUES (1,'nick@glazedproductions.com','436fa63a99242faee7cbaf566dbf14c3','Nick','Okonek','2020-10-13 20:33:24','Glazed Productions');
/*!40000 ALTER TABLE `retailers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitemap`
--

DROP TABLE IF EXISTS `sitemap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sitemap` (
  `pageID` int NOT NULL,
  `pageTitle` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pageName` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` blob,
  `url` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isNavItem` tinyint DEFAULT NULL,
  `bgImg` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgImgAlt` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitemap`
--

LOCK TABLES `sitemap` WRITE;
/*!40000 ALTER TABLE `sitemap` DISABLE KEYS */;
INSERT INTO `sitemap` VALUES (1,'Welcome to Project Foolery','Home',NULL,'index',1,'bghome.jpg','Happy Shopper'),(4,'Login to your account','Login',NULL,'login',1,'bghome.jpg','Happy Shopper'),(5,'New user registration','Register',NULL,'register',1,'bghome.jpg','Happy Shopper'),(6,'Welcome','My Account',NULL,'account',1,'bghome.jpg','Happy Shopper');
/*!40000 ALTER TABLE `sitemap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(72) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Psword` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FName` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LName` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `AccountCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'nicholas.okonek@my.metrostate.edu','436fa63a99242faee7cbaf566dbf14c3','Nick','Okonek','1984-08-06','2020-10-12 21:34:45'),(3,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','Test','123','1984-08-06','2020-10-28 22:54:16'),(4,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','Test','123','1984-08-06','2020-10-28 22:59:04'),(5,'newtest@somemail.com','098f6bcd4621d373cade4e832627b4f6','new test','123','1984-08-06','2020-10-28 23:01:53'),(6,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','test 3','last','2001-01-01','2020-10-29 19:54:20'),(7,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','test 4','last','2001-01-01','2020-10-29 19:56:37'),(8,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','test 5','last','2001-01-01','2020-10-29 19:58:03'),(9,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','test 6','last','2001-01-01','2020-10-29 19:59:33'),(10,'sometest@email.com','03d59e663c1af9ac33a9949d1193505a','test 7','last','2001-01-01','2020-10-29 20:00:30'),(11,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','test 11','last','2001-01-01','2020-10-29 20:04:49'),(12,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','test 12','last','2001-01-01','2020-10-29 20:05:57'),(13,'sometest@email.com','098f6bcd4621d373cade4e832627b4f6','test 13','last','2001-01-01','2020-10-29 20:07:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-03 23:38:58
