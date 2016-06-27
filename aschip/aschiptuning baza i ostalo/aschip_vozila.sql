CREATE DATABASE  IF NOT EXISTS `aschip` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `aschip`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: aschip
-- ------------------------------------------------------
-- Server version	5.7.12-log

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
-- Table structure for table `vozila`
--

DROP TABLE IF EXISTS `vozila`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vozila` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(30) DEFAULT NULL,
  `tipVozila` varchar(15) DEFAULT NULL,
  `motor` varchar(20) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `kw` int(11) DEFAULT NULL,
  `snaga` int(11) DEFAULT NULL,
  `obrtaji` int(11) DEFAULT NULL,
  `cijena` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vozila`
--

LOCK TABLES `vozila` WRITE;
/*!40000 ALTER TABLE `vozila` DISABLE KEYS */;
INSERT INTO `vozila` VALUES (16,'audi','Auto','fsaafs',1,1,1,1,'151'),(17,'audi','Kamion','rgdgf',1,1,1,1,'5454'),(18,'fsfsd','Kamion','fdsf',4,5,4,8,'546'),(19,'fsfsd','Kamion','fdsf',4,5,4,8,'546');
/*!40000 ALTER TABLE `vozila` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-26 19:52:53
