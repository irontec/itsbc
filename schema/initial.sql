-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: opensips
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'admin','admin','admin@invalid.com','admin@invalid.com',1,NULL,'$2y$13$kFmdr6BGvhyHmkKWYh.R7uN3gnQYs5.AEkEzFaUGuyesCHcOorPva',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_ips`
--

DROP TABLE IF EXISTS `media_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advertisedIp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_ips`
--

LOCK TABLES `media_ips` WRITE;
/*!40000 ALTER TABLE `media_ips` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_ips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routing_registers`
--

DROP TABLE IF EXISTS `routing_registers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routing_registers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metrica` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ipEntrada` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ipSalida` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `protocoloEntrada` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `redOrigen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registrarServer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registrarTransport` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `registrarPort` int(11) NOT NULL,
  `portEntrada` int(11) NOT NULL,
  `portSalida` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routing_registers`
--

LOCK TABLES `routing_registers` WRITE;
/*!40000 ALTER TABLE `routing_registers` DISABLE KEYS */;
/*!40000 ALTER TABLE `routing_registers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routing_requests`
--

DROP TABLE IF EXISTS `routing_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routing_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metrica` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ipEntrada` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redOrigen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nextHop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nextHopTransport` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nextHopPort` int(11) NOT NULL,
  `ipSalida` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `portEntrada` int(11) NOT NULL,
  `portSalida` int(11) NOT NULL,
  `protocoloEntrada` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `handleRtp` tinyint(1) NOT NULL,
  `incomingRtpInterface_id` int(11) DEFAULT NULL,
  `outgoingRtpInterface_id` int(11) DEFAULT NULL,
  `rtpEngineRawOptions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8164E35A3E5BDED4` (`incomingRtpInterface_id`),
  KEY `IDX_8164E35A31312958` (`outgoingRtpInterface_id`),
  CONSTRAINT `FK_8164E35A31312958` FOREIGN KEY (`outgoingRtpInterface_id`) REFERENCES `media_ips` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_8164E35A3E5BDED4` FOREIGN KEY (`incomingRtpInterface_id`) REFERENCES `media_ips` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routing_requests`
--

LOCK TABLES `routing_requests` WRITE;
/*!40000 ALTER TABLE `routing_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `routing_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_listeners`
--

DROP TABLE IF EXISTS `sip_listeners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sip_listeners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocolo` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advertisedIp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `puerto` int(11) NOT NULL,
  `advertisedPort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_listeners`
--

LOCK TABLES `sip_listeners` WRITE;
/*!40000 ALTER TABLE `sip_listeners` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_listeners` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-30 13:52:12
