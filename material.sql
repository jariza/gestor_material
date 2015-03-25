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
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `enlaceweb` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `desctecnica` text COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES (1,'asd',1,'2015-03-23 22:48:00','2015-03-23 22:48:00','http://www.uma.es','asdasd\r\nasdasd\r\nasdasd','0000-00-00 00:00:00','2015-03-24 20:49:53'),(2,'Actividad 2, de zona id3',3,'2015-03-23 23:16:00','2015-03-24 23:32:00','http://www.animacomic.es','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'2334234<b>NNNN</b>',1,'2015-03-24 20:50:00','2015-03-24 20:50:00','','234234234234\r\n234242\r\n42423423\r\n4234234234<<<>>>>><b>HOOOLAAA</b>','2015-03-24 20:50:18','2015-03-24 20:50:50');
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_fallidos`
--

LOCK TABLES `login_fallidos` WRITE;
/*!40000 ALTER TABLE `login_fallidos` DISABLE KEYS */;
INSERT INTO `login_fallidos` VALUES (1,'2015-03-20 23:10:06','127.0.0.1','root'),(2,'2015-03-23 20:51:27','127.0.0.1','root'),(3,'2015-03-23 20:51:30','127.0.0.1','root');
/*!40000 ALTER TABLE `login_fallidos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `necesidadzonas`
--

LOCK TABLES `necesidadzonas` WRITE;
/*!40000 ALTER TABLE `necesidadzonas` DISABLE KEYS */;
INSERT INTO `necesidadzonas` VALUES (1,'otra cosa',1,9,NULL,'2015-03-24 22:49:51','2015-03-24 22:49:51'),(2,'asdasd',1,10,NULL,'2015-03-24 22:50:57','2015-03-24 22:50:57'),(3,'asdasd',0,11,NULL,'2015-03-24 22:52:12','2015-03-24 22:52:12'),(4,'123123',1,12,NULL,'2015-03-24 22:52:43','2015-03-24 23:15:14'),(8,'CUARTA',23,12,NULL,'2015-03-24 23:15:14','2015-03-24 23:15:14');
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
INSERT INTO `objetos` VALUES (1,'Primer objeto',1,1,10,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Está en 2 y es equipamiento.','2015-03-19 00:45:51','2015-03-23 22:07:08'),(2,'Objeto en ubicación 1, no fungible',1,0,1,'0000-00-00 00:00:00','','2015-04-23 22:25:00','Es de huelva','','2015-03-23 00:01:21','2015-03-23 22:25:40'),(3,'sec2',1,0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-03-23 00:03:39','2015-03-23 22:24:00'),(4,'sec3',-1,0,1,'2015-03-23 00:04:00','','9999-12-31 23:59:59','','','2015-03-23 00:04:09','2015-03-23 22:24:03'),(5,'sec4',-1,0,1,'2015-03-23 00:10:00','lo mismo llega, lo mismo no y vete a saber donde','9999-12-31 23:59:59','','','2015-03-23 00:11:04','2015-03-23 22:25:15'),(6,'sec6',1,1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-03-23 00:28:28','2015-03-23 22:25:19'),(7,'sec7',-1,0,1,'2015-03-23 00:28:00','','9999-12-31 23:59:59','','','2015-03-23 00:28:35','2015-03-23 22:25:22'),(8,'sec9',1,0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-03-23 00:30:42','2015-03-23 22:25:25'),(9,'sec10',1,0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-03-23 00:30:52','2015-03-23 22:25:28');
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
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zonas`
--

LOCK TABLES `zonas` WRITE;
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `zonas` VALUES (1,'Zona 1','','0000-00-00 00:00:00','2015-03-25 03:39:53'),(3,'Otra zona','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'<b>asdasd<b/>','qwqeqwe\r\nqweqeqwe\r\nqweqeqweq\r\neqweqewqwe','2015-03-24 20:52:13','2015-03-24 21:27:03'),(5,'Zona nueva','','2015-03-24 22:47:01','2015-03-24 22:47:01'),(6,'Zona repetible','','2015-03-24 22:48:32','2015-03-24 22:48:32'),(7,'Zona repetible','','2015-03-24 22:49:21','2015-03-24 22:49:21'),(9,'Zona repetible','','2015-03-24 22:49:51','2015-03-24 22:49:51'),(10,'La del fallo','','2015-03-24 22:50:57','2015-03-24 22:50:57'),(11,'La del fallo 2','','2015-03-24 22:52:12','2015-03-24 22:52:12'),(12,'La del fallo 3','','2015-03-24 22:52:43','2015-03-24 23:15:14'),(15,'Vacía','','2015-03-25 03:37:07','2015-03-25 03:37:07');
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

-- Dump completed on 2015-03-25  3:42:01
