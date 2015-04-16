-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: material
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `zona_id` int(11) NOT NULL,
  `enlaceweb` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `desctecnica` text COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES (1,'Actividad de prueba',1,'http://www.uma.es','asdasd\r\nasdasd\r\nasdasd','0000-00-00 00:00:00','2015-04-15 20:00:23'),(2,'Actividad 2, de zona id3',3,'http://www.animacomic.es','','0000-00-00 00:00:00','2015-04-11 23:23:23'),(3,'2334234<b>NNNN</b>',1,'','234234234234\r\n234242\r\n42423423\r\n4234234234<<<>>>>><b>HOOOLAAA</b>','2015-03-24 20:50:18','2015-04-11 23:23:40'),(6,'Actividad con requisitos',5,'','','2015-03-25 20:24:16','2015-04-15 20:08:03'),(7,'Actividad con objetos',1,'','','2015-03-26 01:54:41','2015-04-07 04:37:30'),(8,'Actividad con sesiones',1,'','','2015-03-26 20:38:11','2015-04-15 20:24:38'),(9,'Horas2',1,'','','2015-03-26 20:49:01','2015-03-26 20:49:01'),(10,'Horas3',1,'','','2015-03-26 20:51:26','2015-03-26 20:51:26'),(11,'Horas4',1,'','','2015-03-26 20:53:09','2015-03-26 20:57:36'),(12,'123123',1,'','','2015-04-09 23:44:37','2015-04-09 23:44:37'),(13,'123123',1,'','','2015-04-09 23:49:16','2015-04-09 23:49:16'),(14,'123123',1,'','','2015-04-09 23:49:26','2015-04-09 23:49:26'),(15,'123123',1,'','','2015-04-09 23:51:39','2015-04-09 23:51:39'),(16,'123123',1,'','','2015-04-09 23:51:58','2015-04-09 23:51:58'),(17,'123123',1,'','','2015-04-09 23:57:43','2015-04-09 23:57:43'),(18,'123123',1,'','','2015-04-09 23:58:08','2015-04-09 23:58:08'),(19,'123123',1,'','','2015-04-09 23:58:18','2015-04-09 23:58:18'),(20,'123123',1,'','','2015-04-09 23:58:28','2015-04-09 23:58:28'),(21,'123123',1,'','','2015-04-09 23:58:33','2015-04-09 23:58:33'),(22,'123123',1,'','','2015-04-09 23:58:49','2015-04-09 23:58:49'),(23,'123123',1,'','','2015-04-10 00:02:57','2015-04-10 00:02:57'),(24,'123123',1,'','','2015-04-10 00:03:54','2015-04-10 00:03:54'),(25,'1212r1r212r12r',5,'','','2015-04-12 00:23:58','2015-04-12 00:23:58'),(26,'w2w2w2w2',5,'','','2015-04-12 00:24:48','2015-04-12 00:24:48'),(27,'e3e3e3e3e3',5,'','','2015-04-12 00:25:31','2015-04-12 00:25:31'),(28,'r1r1r1r1r1r',1,'','','2015-04-15 19:48:36','2015-04-15 19:48:36');
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario_1428886832`
--

DROP TABLE IF EXISTS `horario_1428886832`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario_1428886832` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad_id` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario_1428886832`
--

LOCK TABLES `horario_1428886832` WRITE;
/*!40000 ALTER TABLE `horario_1428886832` DISABLE KEYS */;
INSERT INTO `horario_1428886832` VALUES (35,6,'2015-05-11 23:24:00','2015-04-11 23:24:00','2015-04-11 23:24:22','2015-04-12 01:33:22'),(36,6,'2015-04-11 23:24:00','2015-05-11 23:24:00','2015-04-11 23:24:22','2015-04-12 01:33:22'),(37,25,'2015-04-12 00:23:00','2015-04-12 00:23:00','2015-04-12 00:23:58','2015-04-12 00:23:58'),(38,26,'2015-04-12 00:24:00','2015-04-12 00:24:00','2015-04-12 00:24:48','2015-04-12 00:24:48'),(39,27,'2015-04-12 00:25:00','2015-04-12 00:25:00','2015-04-12 00:25:31','2015-04-12 00:25:31'),(56,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 01:54:05','2015-04-13 01:54:05'),(57,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:02:51','2015-04-13 02:02:51'),(58,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:03:30','2015-04-13 02:03:30'),(59,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:05:25','2015-04-13 02:05:25'),(60,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:06:52','2015-04-13 02:06:52'),(61,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:07:15','2015-04-13 02:07:15'),(62,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:07:19','2015-04-13 02:07:19'),(63,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:41:26','2015-04-13 02:41:26'),(64,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:42:37','2015-04-13 02:42:37'),(65,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:42:51','2015-04-13 02:42:51'),(66,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:42:55','2015-04-13 02:42:55'),(67,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:43:16','2015-04-13 02:43:16'),(68,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:43:25','2015-04-13 02:43:25'),(69,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:43:30','2015-04-13 02:43:30'),(70,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:47:06','2015-04-13 02:47:06'),(71,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:47:27','2015-04-13 02:47:27'),(72,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:48:38','2015-04-13 02:48:38'),(73,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:48:54','2015-04-13 02:48:54'),(74,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:49:34','2015-04-13 02:49:34'),(75,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:49:39','2015-04-13 02:49:39'),(76,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:50:47','2015-04-13 02:50:47'),(77,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:51:26','2015-04-13 02:51:26'),(78,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:52:14','2015-04-13 02:52:14'),(79,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:52:20','2015-04-13 02:52:20'),(80,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:53:29','2015-04-13 02:53:29'),(81,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:54:19','2015-04-13 02:54:19'),(82,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:57:36','2015-04-13 02:57:36'),(83,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:58:51','2015-04-13 02:58:51'),(84,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-13 02:58:56','2015-04-13 02:58:56');
/*!40000 ALTER TABLE `horario_1428886832` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad_id` int(11) NOT NULL,
  `sesion` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,1,1,'2015-07-04 11:00:00','2015-07-04 12:00:00','2015-04-15 20:52:02','2015-04-15 20:52:02'),(2,8,1,'2015-07-04 13:00:00','2015-07-04 14:00:00','2015-04-15 20:52:02','2015-04-15 20:52:02'),(3,8,2,'2015-07-04 16:00:00','2015-07-04 17:00:00','2015-04-15 20:52:02','2015-04-15 20:52:02'),(4,6,3,'2015-05-11 23:24:00','2015-04-11 23:24:00','2015-04-11 23:24:22','2015-04-15 20:08:03'),(5,6,2,'1997-04-11 23:24:00','2015-05-11 23:24:00','2015-04-11 23:24:22','2015-04-15 20:08:03'),(6,25,0,'2015-04-12 00:23:00','2015-04-12 00:23:00','2015-04-12 00:23:58','2015-04-12 00:23:58'),(7,26,0,'2015-04-12 00:24:00','2015-04-12 00:24:00','2015-04-12 00:24:48','2015-04-12 00:24:48'),(8,27,0,'2015-04-12 00:25:00','2015-04-12 00:25:00','2015-04-12 00:25:31','2015-04-12 00:25:31'),(9,6,4,'2017-05-11 23:24:00','2015-04-11 23:24:00','2015-04-11 23:24:22','2015-04-15 20:08:03'),(10,6,5,'2035-04-11 23:24:00','2015-05-11 23:24:00','2015-04-11 23:24:22','2015-04-15 20:08:03'),(11,25,0,'2015-04-12 00:23:00','2015-04-12 00:23:00','2015-04-12 00:23:58','2015-04-12 00:23:58'),(12,26,0,'2015-04-12 00:24:00','2015-04-12 00:24:00','2015-04-12 00:24:48','2015-04-12 00:24:48'),(13,27,0,'2015-04-12 00:25:00','2015-04-12 00:25:00','2015-04-12 00:25:31','2015-04-12 00:25:31'),(14,6,1,'1996-04-11 23:24:00','2015-05-11 23:24:00','2015-04-14 21:01:37','2015-04-15 20:08:03');
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_fallidos`
--

DROP TABLE IF EXISTS `login_fallidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_fallidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `IP` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_fallidos`
--

LOCK TABLES `login_fallidos` WRITE;
/*!40000 ALTER TABLE `login_fallidos` DISABLE KEYS */;
INSERT INTO `login_fallidos` VALUES (1,'2015-03-20 23:10:06','127.0.0.1','root'),(2,'2015-03-23 20:51:27','127.0.0.1','root'),(3,'2015-03-23 20:51:30','127.0.0.1','root'),(4,'2015-04-11 23:09:14','127.0.0.1','root'),(5,'2015-04-14 20:38:32','127.0.0.1','admin');
/*!40000 ALTER TABLE `login_fallidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `necesidadactividades`
--

DROP TABLE IF EXISTS `necesidadactividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `necesidadactividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `sesion` int(11) NOT NULL,
  `objeto_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `necesidadactividades`
--

LOCK TABLES `necesidadactividades` WRITE;
/*!40000 ALTER TABLE `necesidadactividades` DISABLE KEYS */;
INSERT INTO `necesidadactividades` VALUES (1,'req1',1,6,1,9,'2015-03-25 20:24:16','2015-04-15 20:08:03'),(4,'req5',5,6,0,NULL,'2015-03-25 20:29:20','2015-04-15 20:08:03'),(5,'a1',1,7,0,2,'2015-03-26 01:54:41','2015-04-07 04:37:30'),(6,'s3',3,1,0,8,'2015-03-26 01:54:41','2015-04-07 04:37:30'),(7,'',0,11,0,NULL,'2015-03-26 20:57:36','2015-03-26 20:57:36'),(8,'',0,11,0,NULL,'2015-03-26 20:57:36','2015-03-26 20:57:36'),(9,'asd',1,8,0,NULL,'2015-03-26 21:02:43','2015-04-15 20:24:38'),(12,'asd',1,3,0,2,'2015-03-26 21:31:31','2015-04-11 23:23:40'),(13,'12',1,1,0,6,'2015-04-10 00:37:33','2015-04-15 20:00:23'),(14,'qqeqwe',1,25,2,3,'2015-04-12 00:23:58','2015-04-12 00:23:58'),(15,'123',1,26,3,NULL,'2015-04-12 00:24:48','2015-04-12 00:24:48'),(16,'123132',1,27,1,NULL,'2015-04-12 00:25:31','2015-04-12 00:25:31'),(17,'asd',1,28,1,NULL,'2015-04-15 19:48:36','2015-04-15 19:48:36');
/*!40000 ALTER TABLE `necesidadactividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `necesidadzonas`
--

DROP TABLE IF EXISTS `necesidadzonas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `necesidadzonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `objeto_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `necesidadzonas`
--

LOCK TABLES `necesidadzonas` WRITE;
/*!40000 ALTER TABLE `necesidadzonas` DISABLE KEYS */;
INSERT INTO `necesidadzonas` VALUES (1,'otra cosa',1,9,NULL,'2015-03-24 22:49:51','2015-03-24 22:49:51'),(2,'asdasd',1,10,NULL,'2015-03-24 22:50:57','2015-03-24 22:50:57'),(3,'asdasd',0,11,NULL,'2015-03-24 22:52:12','2015-03-24 22:52:12'),(4,'123123',1,12,6,'2015-03-24 22:52:43','2015-03-24 23:15:14'),(8,'CUARTA',23,12,6,'2015-03-24 23:15:14','2015-03-24 23:15:14'),(9,'nec1',1,16,NULL,'2015-03-25 20:17:23','2015-03-25 20:17:43'),(11,'nec4',1,16,NULL,'2015-03-25 20:17:43','2015-03-25 20:17:43'),(12,'necesisdad 1',1,1,2,'2015-03-26 01:17:50','2015-04-07 03:47:13'),(13,'cosa 1',1,22,2,'2015-03-26 01:26:51','2015-03-26 01:26:51'),(14,'cosa 1',1,23,2,'2015-03-26 01:31:56','2015-03-26 01:31:56'),(15,'cosa 2',2,23,9,'2015-03-26 01:31:56','2015-03-26 01:31:56'),(16,'necesisdad 1',2,1,3,'2015-03-26 01:49:19','2015-04-07 03:47:13');
/*!40000 ALTER TABLE `necesidadzonas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objetos`
--

DROP TABLE IF EXISTS `objetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objetos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion_id` int(11) NOT NULL,
  `fungible` tinyint(1) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaentrega` datetime NOT NULL,
  `comentariosentrega` text COLLATE utf8_spanish_ci NOT NULL,
  `fechadevolucion` datetime NOT NULL,
  `comentariosdevolucion` text COLLATE utf8_spanish_ci NOT NULL,
  `comentarios` text COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetos`
--

LOCK TABLES `objetos` WRITE;
/*!40000 ALTER TABLE `objetos` DISABLE KEYS */;
INSERT INTO `objetos` VALUES (1,'Primer objeto',1,1,10,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Está en 2 y es equipamiento.','2015-03-19 00:45:51','2015-03-23 22:07:08'),(2,'Objeto en ubicación 1, no fungible',1,0,1,'0000-00-00 00:00:00','','2015-04-23 22:25:00','Es de huelva','','2015-03-23 00:01:21','2015-03-23 22:25:40'),(3,'sec2',1,1,20,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-03-23 00:03:39','2015-03-23 22:24:00'),(4,'sec3',-1,0,1,'2015-03-23 00:04:00','','9999-12-31 23:59:59','','','2015-03-23 00:04:09','2015-03-23 22:24:03'),(5,'sec4',-1,0,1,'2015-03-23 00:10:00','lo mismo llega, lo mismo no y vete a saber donde','2015-03-25 21:43:00','sdfsdf','','2015-03-23 00:11:04','2015-03-25 21:43:08'),(6,'sec6',1,1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-03-23 00:28:28','2015-03-23 22:25:19'),(7,'sec7',-1,0,1,'2015-03-23 00:28:00','','9999-12-31 23:59:59','','','2015-03-23 00:28:35','2015-03-23 22:25:22'),(8,'sec9',1,0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-03-23 00:30:42','2015-03-23 22:25:25'),(9,'sec10',1,0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-03-23 00:30:52','2015-03-23 22:25:28');
/*!40000 ALTER TABLE `objetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicaciones`
--

LOCK TABLES `ubicaciones` WRITE;
/*!40000 ALTER TABLE `ubicaciones` DISABLE KEYS */;
INSERT INTO `ubicaciones` VALUES (1,'Ubicación 1','2015-03-19 00:12:25','2015-03-24 21:07:43'),(2,'Ubicación 2','2015-03-19 00:12:31','2015-03-19 00:12:31'),(4,'Ubicación 3','2015-03-19 00:12:48','2015-03-19 00:12:48'),(5,'<b>NNN</b>','2015-03-24 21:02:20','2015-03-24 21:15:36');
/*!40000 ALTER TABLE `ubicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rol` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `zonas` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Usuario','admin','admin','','6fb913c8c31f6db76281163a5a0de50e9d8ed128','pepe@jariza.net','2015-03-18 23:48:46','2015-03-22 23:05:44'),(2,'stage1','stage1','managerzona','3','ec9c306ef3cfd6d94c6730ba6891cbdac935d184','stage1@jariza.net','2015-03-22 00:50:03','2015-03-22 23:07:17'),(3,'stage2','stage2','admin','','fc0f0110bab743a784903446b4ca14f85019f466','stage2@jariza.net','2015-03-22 01:29:43','2015-03-22 23:06:06'),(4,'otromanager','otromanager','managerzona','1,3','ec9c306ef3cfd6d94c6730ba6891cbdac935d184','otromanager@jariza.net','2015-03-22 23:07:45','2015-03-22 23:07:45');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zonas`
--

DROP TABLE IF EXISTS `zonas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `desctecnica` text COLLATE utf8_spanish_ci NOT NULL,
  `calendarioext` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `sync_calext` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zonas`
--

LOCK TABLES `zonas` WRITE;
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `zonas` VALUES (1,'Zona 1','','k4m5dm13lfkdpk66qi02tui17o@group.calendar.google.com','2015-04-15 20:52:02','0000-00-00 00:00:00','2015-04-15 20:52:02'),(3,'Otra zona','','josejaimeariza@gmail.com','2015-04-15 20:52:03','0000-00-00 00:00:00','2015-04-15 20:52:03'),(4,'<b>asdasd<b/>','qwqeqwe\r\nqweqeqwe\r\nqweqeqweq\r\neqweqewqwe','0','0000-00-00 00:00:00','2015-03-24 20:52:13','2015-03-24 21:27:03'),(5,'Zona nueva','','0','0000-00-00 00:00:00','2015-03-24 22:47:01','2015-03-24 22:47:01'),(6,'Zona repetible','','0','0000-00-00 00:00:00','2015-03-24 22:48:32','2015-03-24 22:48:32'),(7,'Zona repetible','','0','0000-00-00 00:00:00','2015-03-24 22:49:21','2015-03-24 22:49:21'),(9,'Zona repetible','','0','0000-00-00 00:00:00','2015-03-24 22:49:51','2015-03-24 22:49:51'),(10,'La del fallo','','0','0000-00-00 00:00:00','2015-03-24 22:50:57','2015-03-24 22:50:57'),(11,'La del fallo 2','','0','0000-00-00 00:00:00','2015-03-24 22:52:12','2015-03-24 22:52:12'),(12,'La del fallo 3','','0','0000-00-00 00:00:00','2015-03-24 22:52:43','2015-03-24 23:15:14'),(15,'Vacía','','0','0000-00-00 00:00:00','2015-03-25 03:37:07','2015-03-25 03:37:07'),(16,'Otra más','','0','0000-00-00 00:00:00','2015-03-25 20:17:23','2015-03-25 20:17:43'),(17,'Relleno 1','','0','0000-00-00 00:00:00','2015-03-25 21:47:07','2015-03-25 21:47:07'),(18,'Relleno 2','','0','0000-00-00 00:00:00','2015-03-25 21:47:16','2015-03-25 21:47:16'),(19,'Relleno 3','','0','0000-00-00 00:00:00','2015-03-25 21:47:23','2015-03-25 21:47:23'),(20,'Relleno 4','','0','0000-00-00 00:00:00','2015-03-25 21:47:33','2015-03-25 21:47:33'),(21,'Relleno 5','','0','0000-00-00 00:00:00','2015-03-25 21:47:43','2015-03-25 21:47:43'),(22,'Nuevo objeto','','0','0000-00-00 00:00:00','2015-03-26 01:26:51','2015-03-26 01:26:51'),(23,'Con objeto','','0','0000-00-00 00:00:00','2015-03-26 01:31:56','2015-03-26 01:31:56'),(24,'Prueba sin calendari','','0','0000-00-00 00:00:00','2015-04-07 02:31:03','2015-04-09 23:20:11');
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-17  0:42:55
