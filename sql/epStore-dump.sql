CREATE DATABASE  IF NOT EXISTS `trgovina` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci */;
USE `trgovina`;
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
INSERT INTO `artikel` VALUES (1,'Nogavice',4,0,'0W45pz4p'),(2,'majica',5,1,'0W45pz4p'),(3,'majica',10,1,'0W45pz4p'),(4,'majica',15,1,'0W45pz4p'),(5,'Pulover',30,0,'0W45pz4p'),(6,'majica',41,1,'0W45pz4p'),(7,'majica',12,1,'0W45pz4p'),(8,'majica',15,1,'0W45pz4p'),(9,'majica',15,1,'0W45pz4p'),(10,'Banana',0.5,1,'0W45pz4p'),(12,'Telefon',12.15,0,'0W45pz4p'),(13,'asadasdasfasdfsdaaaa',15,1,'asdasfsdgfdsgfd');
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
INSERT INTO `stranka` VALUES ('janez.novak@gmail.com','Janez','Novak','$2y$10$2B1oLdxaB/baKd./7in8XunWrPtEZGquFb1dmz3AMyZrliR0Ssz3W',1,10,1,'Hrenova ulica 6','040555555'),('franc.kosir@gmail.com','Franc','Košir','$2y$10$Im.V035a/.QNyvhLE5EOROq1vK77S34X26mVuwtBa6nalMzqkXejq',1,11,7,'Gozdna cesta 3','030888888'),('franc.kosir@gmail.com','Franc','Košir','$2y$10$w69FbIH77lOfoJOVuAt1seD4h9Tj0.2gtuied/gdLkdgAofwhsLte',1,12,1,'Gozdna cesta 3','030888888'),('francka@gmail.com','Francka','Košir','$2y$10$NSfDRnp/8NaUzA7ugT9bh.GmklY9s9DbTcg8KG.sZcgkDRFG1xgkq',1,13,1,'Bevška 10','040354345');
/*!40000 ALTER TABLE `stranka` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `zaposlenec`
--

LOCK TABLES `zaposlenec` WRITE;
/*!40000 ALTER TABLE `zaposlenec` DISABLE KEYS */;
INSERT INTO `zaposlenec` VALUES ('godfather@corleone.it','Don Vito','Corleone','$2y$10$2M2S7Cwa6Xo8sKtfnY114OdmE3MYwAzwX7sNsVl4FrTBDhH3yaj2G',1,1,1),('consigliere@corleone.it','Tom','Hagen','$2y$10$cUinHBcbc2qbpKiMT3MPMeYM2h3I82J.NLXx.tWezCgQlBkWRAz4m',2,1,0),('administrator@epca.si','Admin','Admin','$2y$10$BoNVZFX/205Fokd60Zsr/esNSZNPdDr6B2cj7zZsPPtwGsr5ffxs6',3,1,1),('prodajalec@epca.si','Prodajalec','Prodajalec','$2y$10$v7vpg5EkjmppT4mlXkd4OuJs3XpLlVEFdJk/zeCDojKxDozZ8dJLa',4,1,0),('rtjhj@kj.si','ztz','tztz','$2y$10$DY0uM7TN8lg83LZszkY4SOZqEZXd2EPLsOXaL56cybk6z28nnVrqi',5,1,0),('rtjhj@kj.si','as','as','$2y$10$R6liarciIQRavQ.6Ki1xgusatWDH.j8qFRFS1PwLNiSvLPYazugjy',6,1,0);
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

-- Dump completed on 2017-01-16 22:03:00
