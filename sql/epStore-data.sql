-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: trgovina
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

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
-- Dumping data for table `administrator`
--

-- LOCK TABLES `administrator` WRITE;
-- /*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
-- INSERT INTO `administrator` VALUES ('@admin','admin','a','admin');
-- /*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
-- UNLOCK TABLES;


--
-- Dumping data for table `artikel`
--

LOCK TABLES `artikel` WRITE;
/*!40000 ALTER TABLE `artikel` DISABLE KEYS */;
INSERT INTO `artikel` VALUES (1,'Nogavice',5,1,'st. 46'),(2,'Pulover',25,0,'XL'),(3,'Hlace',40,1,'36-32');
/*!40000 ALTER TABLE `artikel` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Dumping data for table `naslov`
--

LOCK TABLES `naslov` WRITE;
/*!40000 ALTER TABLE `naslov` DISABLE KEYS */;
INSERT INTO `naslov` VALUES ('Breg','1', 1, 1353);
/*!40000 ALTER TABLE `naslov` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `posta`
--

LOCK TABLES `posta` WRITE;
/*!40000 ALTER TABLE `posta` DISABLE KEYS */;
INSERT INTO `posta` VALUES (1000,'Ljubljana'),(1353,'Borovnica');
/*!40000 ALTER TABLE `posta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `prodajalec`
--

LOCK TABLES `prodajalec` WRITE;
/*!40000 ALTER TABLE `prodajalec` DISABLE KEYS */;
INSERT INTO `prodajalec` VALUES ('@seller1',1,'Til','g','seller'),('@seller2',0,'Boni','K','seller');
/*!40000 ALTER TABLE `prodajalec` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `stranka`
--

LOCK TABLES `stranka` WRITE;
/*!40000 ALTER TABLE `stranka` DISABLE KEYS */;
INSERT INTO `stranka` VALUES ('@user1',1,'Ti','Go','user',42321123,1),('@user2',1,'Boni','L','user',1233,0);
/*!40000 ALTER TABLE `stranka` ENABLE KEYS */;
UNLOCK TABLES;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-26 18:14:30
