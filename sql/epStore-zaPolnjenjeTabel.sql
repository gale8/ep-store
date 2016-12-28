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

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `artikel`
--

LOCK TABLES `artikel` WRITE;
/*!40000 ALTER TABLE `artikel` DISABLE KEYS */;
INSERT INTO `artikel` VALUES (1,'Nogavice',4,0,'st. 46'),(3,'majica',15.13,1,'XL'),(4,'majica',10,1,'L'),(5,'Test',15.2,1,'Test'),(7,'majica',15,1,'asd'),(8,'Pulover',30,0,'XL'),(9,'aaa',12,1,'sfd'),(10,'majica',41,1,'214'),(11,'sdgfdh',12,1,'sdg'),(12,'majica',12,1,'safsdg'),(13,'sdfds',12,1,'saf'),(14,'et',12,1,'sdgf'),(15,'adg',12,1,'esg'),(18,'k',4,1,'rez'),(19,'jlkz',34,1,'sdfdf'),(20,'qwer',12,1,'dfh'),(21,'wq',125,1,'dsgas'),(22,'človek ne jezi se',15,1,'družabna igra'),(23,'majica',15,1,'maijca'),(24,'majicaaa',15,1,'maijicaaa'),(25,'majica',15,1,'gh'),(26,'Banana',0.5,1,'njam'),(27,'neki',2,1,'blaba2222'),(28,'tw',1,1,'sdwe'),(29,'majicmajicmajicmajicmajicmajicmajicmajic',15,1,'majica');
/*!40000 ALTER TABLE `artikel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `narocilo`
--

LOCK TABLES `narocilo` WRITE;
/*!40000 ALTER TABLE `narocilo` DISABLE KEYS */;
/*!40000 ALTER TABLE `narocilo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `narocilo_artikel`
--

LOCK TABLES `narocilo_artikel` WRITE;
/*!40000 ALTER TABLE `narocilo_artikel` DISABLE KEYS */;
/*!40000 ALTER TABLE `narocilo_artikel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `posta`
--

LOCK TABLES `posta` WRITE;
/*!40000 ALTER TABLE `posta` DISABLE KEYS */;
INSERT INTO `posta` VALUES (1000,'Ljubljana',1),(2000,'Maribor',2),(3000,'Celje',3),(1360,'Vrhnika',4),(1120,'Šentvid',5),(1353,'Borovnica',6),(1370,'Logatec',7),(4000,'Kranj',8),(6000,'Koper',9);
/*!40000 ALTER TABLE `posta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `prodajalec`
--

LOCK TABLES `prodajalec` WRITE;
/*!40000 ALTER TABLE `prodajalec` DISABLE KEYS */;
/*!40000 ALTER TABLE `prodajalec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `stranka`
--

LOCK TABLES `stranka` WRITE;
/*!40000 ALTER TABLE `stranka` DISABLE KEYS */;
INSERT INTO `stranka` VALUES ('abc@neki.si','abc','neki','abc',1,2,1,'breg'),('abc@neki.si','abca','nekia','abc',1,3,1,'breg'),('ha@asd.si','tralala','blabla','Aa123456',1,4,6,'hrenova 6');
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

-- Dump completed on 2016-12-28 19:40:06
