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
-- Table structure for table `aktivnosti`
--

DROP TABLE IF EXISTS `aktivnosti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aktivnosti` (
  `id_aktivnosti` int(11) NOT NULL,
  `ime_aktivnosti` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id_aktivnosti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `artikel`
--

DROP TABLE IF EXISTS `artikel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artikel` (
  `id_artikla` int(11) NOT NULL AUTO_INCREMENT,
  `ime_artikla` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `cena` float NOT NULL,
  `artikel_aktiviran` tinyint(1) NOT NULL DEFAULT '1',
  `opis_artikla` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id_artikla`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dnevnik`
--

DROP TABLE IF EXISTS `dnevnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dnevnik` (
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dnevnik_id_aktivnosti` int(11) NOT NULL,
  `dnevnik_id_zaposlenca` int(11) NOT NULL,
  KEY `fk_dnevnik_zaposlenec1_idx` (`dnevnik_id_zaposlenca`),
  KEY `fk_dnevnik_aktivnosti` (`dnevnik_id_aktivnosti`),
  CONSTRAINT `fk_dnevnik_aktivnosti` FOREIGN KEY (`dnevnik_id_aktivnosti`) REFERENCES `aktivnosti` (`id_aktivnosti`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dnevnik_zaposlenec1` FOREIGN KEY (`dnevnik_id_zaposlenca`) REFERENCES `zaposlenec` (`id_zaposlenca`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `narocilo`
--

DROP TABLE IF EXISTS `narocilo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `narocilo` (
  `id_narocila` int(11) NOT NULL AUTO_INCREMENT,
  `id_stranke` int(11) NOT NULL,
  `narocilo_potrjeno` tinyint(1) DEFAULT '0',
  `narocilo_preklicano` tinyint(1) DEFAULT '0',
  `narocilo_stornirano` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_narocila`),
  KEY `FK_je_narocil` (`id_stranke`),
  CONSTRAINT `FK_je_narocil` FOREIGN KEY (`id_stranke`) REFERENCES `stranka` (`id_stranke`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `narocilo_artikel`
--

DROP TABLE IF EXISTS `narocilo_artikel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `narocilo_artikel` (
  `id_narocila` int(11) NOT NULL,
  `id_artikla` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  PRIMARY KEY (`id_narocila`,`id_artikla`),
  KEY `FK_narocilo_artikel2` (`id_artikla`),
  CONSTRAINT `FK_narocilo_artikel` FOREIGN KEY (`id_narocila`) REFERENCES `narocilo` (`id_narocila`),
  CONSTRAINT `FK_narocilo_artikel2` FOREIGN KEY (`id_artikla`) REFERENCES `artikel` (`id_artikla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `posta`
--

DROP TABLE IF EXISTS `posta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posta` (
  `postna_st` int(11) NOT NULL,
  `ime_poste` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `id_poste` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_poste`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stranka`
--

DROP TABLE IF EXISTS `stranka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stranka` (
  `email_stranke` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `ime_stranke` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `priimek_stranke` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `geslo_stranke` varchar(160) COLLATE utf8_slovenian_ci NOT NULL,
  `stranka_aktivirana` tinyint(1) NOT NULL DEFAULT '0',
  `id_stranke` int(11) NOT NULL AUTO_INCREMENT,
  `id_poste` int(11) DEFAULT NULL,
  `naslov_stevilka` varchar(80) COLLATE utf8_slovenian_ci NOT NULL,
  `tel_st` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `mailHash_stranke` varchar(60) COLLATE utf8_slovenian_ci NOT NULL,
  `mailHash_porabljen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_stranke`),
  KEY `FK_posta_stranka` (`id_poste`),
  CONSTRAINT `FK_posta_stranka` FOREIGN KEY (`id_poste`) REFERENCES `posta` (`id_poste`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zaposlenec`
--

DROP TABLE IF EXISTS `zaposlenec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zaposlenec` (
  `email_zaposlenca` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `ime_zaposlenca` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `priimek_zaposlenca` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `geslo_zaposlenca` varchar(160) COLLATE utf8_slovenian_ci NOT NULL,
  `id_zaposlenca` int(11) NOT NULL AUTO_INCREMENT,
  `zaposlenec_aktiviran` tinyint(1) NOT NULL DEFAULT '1',
  `je_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_zaposlenca`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-21 19:49:07
