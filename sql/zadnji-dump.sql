-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: trgovina
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Dumping data for table `aktivnosti`
--

LOCK TABLES `aktivnosti` WRITE;
/*!40000 ALTER TABLE `aktivnosti` DISABLE KEYS */;
INSERT INTO `aktivnosti` VALUES (1,'prijava'),(2,'odjava'),(3,'dodajanje prodajalca'),(4,'dodajanje stranke'),(5,'urejanje prodajalca'),(6,'urejanje stranke'),(7,'dodajanje artikla'),(8,'urejanje artikla');
/*!40000 ALTER TABLE `aktivnosti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `artikel`
--

LOCK TABLES `artikel` WRITE;
/*!40000 ALTER TABLE `artikel` DISABLE KEYS */;
INSERT INTO `artikel` VALUES (1,'Nogavice',4,0,'Zimske volnene nogavice'),(2,'majica',5,1,'Športna kratka majica z ovratnikom'),(3,'majica',10,1,'Rdeča kratka majica brez ovratnika'),(4,'Hlače',15,1,'Moške modre jeans hlače'),(5,'Pulover',30,0,'Volnen rdeč pulover'),(6,'Hlače',41,1,'Ženske modre jeans hlače');
/*!40000 ALTER TABLE `artikel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `dnevnik`
--

LOCK TABLES `dnevnik` WRITE;
/*!40000 ALTER TABLE `dnevnik` DISABLE KEYS */;
INSERT INTO `dnevnik` VALUES ('2017-01-21 17:55:52',1,4),('2017-01-21 17:56:43',8,4),('2017-01-21 17:56:51',7,4),('2017-01-21 17:57:03',5,4),('2017-01-21 17:57:35',4,4),('2017-01-21 17:57:43',2,4),('2017-01-21 18:00:33',1,3),('2017-01-21 18:01:29',3,3),('2017-01-21 18:01:32',2,3),('2017-01-21 18:02:35',1,3),('2017-01-21 18:02:47',5,3),('2017-01-21 18:03:07',2,3),('2017-01-22 12:09:54',1,4),('2017-01-22 14:43:01',1,4),('2017-01-22 16:15:50',2,4),('2017-01-22 16:23:28',1,4),('2017-01-22 16:23:52',6,4),('2017-01-22 16:23:57',2,4),('2017-01-22 17:05:07',1,4),('2017-01-22 19:50:12',8,4),('2017-01-22 19:54:24',8,4),('2017-01-22 19:54:32',8,4),('2017-01-22 19:54:37',8,4),('2017-01-22 20:37:05',1,4),('2017-01-22 20:37:21',8,4),('2017-01-22 20:39:04',8,4),('2017-01-22 20:44:30',8,4),('2017-01-22 22:29:11',8,4),('2017-01-22 22:29:32',8,4),('2017-01-22 23:16:17',2,4),('2017-01-22 23:39:19',1,4),('2017-01-22 23:40:05',8,4),('2017-01-22 23:46:44',2,4),('2017-01-22 23:46:48',1,4),('2017-01-22 23:49:47',8,4),('2017-01-22 23:49:53',8,4),('2017-01-22 23:49:59',8,4),('2017-01-23 00:42:46',1,4),('2017-01-23 00:43:17',8,4),('2017-01-23 00:43:23',8,4),('2017-01-23 00:43:41',8,4),('2017-01-23 00:43:46',8,4),('2017-01-23 00:43:50',2,4),('2017-01-23 00:47:55',1,3),('2017-01-23 00:48:06',2,3);
/*!40000 ALTER TABLE `dnevnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `narocilo`
--

LOCK TABLES `narocilo` WRITE;
/*!40000 ALTER TABLE `narocilo` DISABLE KEYS */;
INSERT INTO `narocilo` VALUES (8,6,0,0,1),(9,6,1,0,0),(10,6,0,1,0),(11,6,0,0,0);
/*!40000 ALTER TABLE `narocilo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `narocilo_artikel`
--

LOCK TABLES `narocilo_artikel` WRITE;
/*!40000 ALTER TABLE `narocilo_artikel` DISABLE KEYS */;
INSERT INTO `narocilo_artikel` VALUES (8,3,1),(8,4,1),(9,2,2),(9,6,1),(10,2,2),(10,3,2),(10,4,1),(10,6,1),(11,2,4);
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
-- Dumping data for table `stranka`
--

LOCK TABLES `stranka` WRITE;
/*!40000 ALTER TABLE `stranka` DISABLE KEYS */;
INSERT INTO `stranka` VALUES ('cevapov5pojed@gmail.com','Testa','Test','$2y$10$9NDpYe4Fxkb7FOrDJ9yjiuZdxwVhrsqe6KiiZoM7T.FlfPuMLjE6K',1,1,1,'brez naslova','123456789','71ad16ad2c4d81f348082ff6c4b20768',1),('zan.d.stebih@gmail.com','blabla','blabla','$2y$10$EHvZ3o3Tau8WvydCVfkxWeOePMHTTdbncw0GitDpO/CRjc3GqWgIC',1,2,1,'brez naslova drug uporabnik','123456789','a8abb4bb284b5b27aa7cb790dc20f80b',1),('cevapov5pojedu@gmail.com','cacac','cacac','$2y$10$x2Oyqr8.ijmG0fzXlDG7lu0EebOL.vbuPFp0xav8AWPXoJTix8/wW',0,5,1,'acac','123456789','1ff1de774005f8da13f42943881c655f',0),('roksilic.net@gmail.com','Micka','Kovaceva','$2y$10$sSzdkbpA2HB95e.ToKmzLey4R3qrVZjyTXe1BdgT.BLy2P0ZQ7YOe',1,6,1,'Bevkova ulica 4','030303303','e97ee2054defb209c35fe4dc94599061',0);
/*!40000 ALTER TABLE `stranka` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `zaposlenec`
--

LOCK TABLES `zaposlenec` WRITE;
/*!40000 ALTER TABLE `zaposlenec` DISABLE KEYS */;
INSERT INTO `zaposlenec` VALUES ('godfather@corleone.it','Don Vito','Corleone','$2y$10$2M2S7Cwa6Xo8sKtfnY114OdmE3MYwAzwX7sNsVl4FrTBDhH3yaj2G',1,1,1),('consigliere@corleone.it','Tom','Hagen','$2y$10$cUinHBcbc2qbpKiMT3MPMeYM2h3I82J.NLXx.tWezCgQlBkWRAz4m',2,1,0),('administrator@epca.si','Admin','Admin','$2y$10$jIAV48iCrkBO.RMAWCMs0uD0psdi2OZQY/A2i5LnByDAmeTygXqvS',3,1,1),('prodajalec@epca.si','Prodajalec','Prodajalec','$2y$10$I5tbXHgTQ6EtlbW/lrZoDuQKNjuen7js1eR0NLv3L5H6RYP5H0Fze',4,1,0);
/*!40000 ALTER TABLE `zaposlenec` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-23  0:52:07
