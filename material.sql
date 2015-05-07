-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: material
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES (1,'234234',1,'','','2015-05-07 02:46:31','2015-05-07 02:46:31');
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_fallidos`
--

LOCK TABLES `login_fallidos` WRITE;
/*!40000 ALTER TABLE `login_fallidos` DISABLE KEYS */;
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
  `infraestructura` tinyint(1) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `sesion` int(11) NOT NULL,
  `objeto_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `necesidadactividades`
--

LOCK TABLES `necesidadactividades` WRITE;
/*!40000 ALTER TABLE `necesidadactividades` DISABLE KEYS */;
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
  `infraestructura` tinyint(1) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `objeto_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `necesidadzonas`
--

LOCK TABLES `necesidadzonas` WRITE;
/*!40000 ALTER TABLE `necesidadzonas` DISABLE KEYS */;
INSERT INTO `necesidadzonas` VALUES (1,'pulseras para acreditación',0,500,5,NULL,'2015-05-07 02:19:26','2015-05-07 02:19:26'),(2,'regleta 4 enchufes',0,1,2,NULL,'2015-05-07 02:20:59','2015-05-07 02:20:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetos`
--

LOCK TABLES `objetos` WRITE;
/*!40000 ALTER TABLE `objetos` DISABLE KEYS */;
INSERT INTO `objetos` VALUES (1,'Recortable superhéroe cartulina',1,353,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:25:33','2015-04-28 02:50:44'),(2,'Coloreable Peppa Pig en papel',1,23,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','2 sin logo','2015-04-25 23:27:16','2015-04-25 23:27:46'),(3,'Careta Iron Man en cartulina estropeada',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Con fixos pegados','2015-04-25 23:27:26','2015-04-25 23:35:39'),(4,'A4 color varios colores',1,400,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Dos tacos empezados, había 250 en cada uno','2015-04-25 23:27:38','2015-04-25 23:28:29'),(5,'Caja 24 colores cera Carioca',1,3,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','A una le faltan dos lápices','2015-04-25 23:28:52','2015-04-25 23:28:52'),(6,'Caja 12 colores madera Alpino',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:29:06','2015-04-25 23:29:06'),(7,'Caja 24 colores madera Carioca',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:29:36','2015-04-25 23:29:36'),(8,'Felpa negra',1,21,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:29:49','2015-04-25 23:29:49'),(9,'Trozo goma eva verde brillantina',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:30:03','2015-04-25 23:30:03'),(10,'Juego de recortes de papel de colores',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:30:15','2015-04-25 23:30:15'),(11,'Plantillas orejas de gato',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:30:26','2015-04-25 23:30:26'),(12,'Ovillo lana roja oscura',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:30:37','2015-04-25 23:47:21'),(13,'Juego de fichas de libros de la biblioteca Mima 2013',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:30:57','2015-04-25 23:30:57'),(14,'Kit de tizas (colores y blancas) y borrador',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Tizas usadas','2015-04-25 23:31:16','2015-04-25 23:32:04'),(15,'Tijera infantil',1,4,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:31:36','2015-04-25 23:31:36'),(16,'Caja 12 lápices de gel lavable',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:31:54','2015-04-25 23:31:54'),(17,'Cuentos \"Lichi el Panda Rojo\" sin encuadernar',1,15,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Comparten sobre con los encuadernados','2015-04-25 23:32:39','2015-04-25 23:32:39'),(18,'Cuentos \"Lichi el Panda Rojo\" encuadernados',1,12,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Uno sin atar, comparten sobre con los no encuadernados','2015-04-25 23:33:03','2015-04-25 23:33:03'),(19,'Careta Iron Man en cartulina',1,210,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','cantidad aprox','2015-04-25 23:36:01','2015-04-25 23:36:01'),(20,'Carte niña en cartulina',1,190,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','cantidad aprox','2015-04-25 23:36:19','2015-04-25 23:36:19'),(21,'Recortable shojo',1,190,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','cantidad aprox','2015-04-25 23:36:32','2015-04-25 23:36:32'),(22,'Panfleto \"Apadrina con Wedu\", Ayuda en Acción',1,122,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:36:52','2015-04-25 23:36:52'),(23,'Postal \"Dile al hambre que se meta con alguien de su tamaño\", Ayuda en Acción',1,78,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:37:18','2015-04-25 23:37:18'),(24,'Tríptico \"Comienza el cole con Wedu\", Ayuda en Acción',1,6,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:37:39','2015-04-25 23:37:39'),(25,'Pulsera Wedu, Ayuda en Acción',1,7,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En un sobre','2015-04-25 23:37:49','2015-04-25 23:38:30'),(26,'Chapa Wedu, Ayuda en Acción',1,9,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En un sobre','2015-04-25 23:38:20','2015-04-25 23:38:20'),(27,'Caja Ikea con tapa (A), azul transparente',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:39:25','2015-04-25 23:39:43'),(28,'Caja Ikea con tapa (B), azul transparente',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:39:34','2015-04-25 23:39:34'),(29,'Caja Ikea con tapa, verde transparente',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:39:54','2015-04-25 23:39:54'),(30,'Caja Ikea con tapa, blanco transparente',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:40:07','2015-04-25 23:40:07'),(31,'Kit de ceras de colores',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En caja Ikea con tapa, blanco transparente, ya inventariada','2015-04-25 23:40:33','2015-04-25 23:40:33'),(32,'Caja Ikea con tapa, blanco transparente, del kit de ceras',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Contiene kit de ceras de colores, ya inventariado','2015-04-25 23:41:08','2015-04-25 23:41:08'),(33,'Kit de lápices de madera de colores',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En caja Ikea con tapa, verde transparente, ya inventariada','2015-04-25 23:41:36','2015-04-25 23:41:36'),(34,'Caja Ikea con tapa, verde transparente, con kit de lápices de madera',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Contiene kit de lápices de madera de colores, ya inventariado','2015-04-25 23:42:06','2015-04-25 23:42:06'),(36,'Brida blanca nylon 2,5x100',1,50,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En una bolsa','2015-04-25 23:43:43','2015-04-25 23:44:24'),(37,'Brida blanca nylon 2,5x160',1,101,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En una bolsa y una suelta','2015-04-25 23:43:55','2015-04-25 23:44:34'),(38,'Cuerda nylon blanco 160cm',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:44:13','2015-04-25 23:44:13'),(39,'Grapadora para 24/6',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:44:45','2015-04-25 23:44:45'),(40,'Plástico de rulos para 25 monedas de 2€',1,29,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:44:59','2015-04-25 23:44:59'),(41,'Cuerda nylon blanco-azul 1140cm',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:45:15','2015-04-25 23:45:15'),(42,'Caja para tarjetas de visita',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Contiene chapas ya inventariadas','2015-04-25 23:45:40','2015-04-25 23:45:40'),(43,'Gancho en S 35mm alto, 25mm ancho, 5mm diámetro y 6,5mm abertura',1,24,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:46:20','2015-04-25 23:46:20'),(44,'Brida blanca nylon 3,6x295',1,100,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:46:40','2015-04-25 23:46:40'),(45,'Cuerda nylon blanco-azul 1230cm',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:46:51','2015-04-25 23:46:51'),(46,'Lápiz con goma',1,10,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usado, faltan algunas gomas','2015-04-25 23:47:00','2015-04-25 23:48:40'),(47,'Bolígrafo negro',1,6,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usados','2015-04-25 23:47:09','2015-04-25 23:48:45'),(48,'Bolígrafo rojo',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usado','2015-04-25 23:47:39','2015-04-25 23:48:51'),(49,'Bolígrafo azul',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usado','2015-04-25 23:47:46','2015-04-25 23:48:56'),(50,'Sacapuntas simple',1,6,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:47:58','2015-04-25 23:47:58'),(51,'Sacapuntas doble',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:48:07','2015-04-25 23:48:07'),(52,'Rotulador pizarra Velleda negro',1,3,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:49:16','2015-04-25 23:49:16'),(53,'Rotulador pizarra Velleda azul',1,3,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:49:29','2015-04-25 23:49:29'),(54,'Rotulador azul',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:49:36','2015-04-25 23:49:36'),(55,'Lápiz',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usado','2015-04-25 23:49:55','2015-04-25 23:50:03'),(56,'Rotulador naranja gordo',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:50:15','2015-04-25 23:50:15'),(57,'Portaminas',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','No tiene minas','2015-04-25 23:50:27','2015-04-25 23:50:27'),(58,'Imperdible grande',1,18,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:50:39','2015-04-25 23:50:39'),(59,'Sobre azul para A4',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:50:50','2015-04-25 23:50:50'),(60,'Pulsera azul',1,142,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:51:00','2015-04-25 23:51:00'),(61,'Gancho de alambre',1,131,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En cajita de plástico','2015-04-25 23:51:19','2015-04-25 23:51:19'),(62,'Grapa 24/6',1,91,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Cantidad aproximada','2015-04-25 23:51:34','2015-04-25 23:51:34'),(63,'Gomilla elástica 6cm diámetro aprox',1,6,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:51:49','2015-04-25 23:51:49'),(64,'Caja Ikea con tapa, blanco transparente, con recortes de cuerdas',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Además contiene recortes de cuerda ya inventariadas','2015-04-25 23:52:36','2015-04-26 00:22:28'),(65,'Recortes de cuerda nylon blanca, menos de 60cm',1,42,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En caja Ikea blanca ya inventariada','2015-04-25 23:53:14','2015-04-25 23:53:14'),(66,'Carpeta azul con gomillas',1,10,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:53:27','2015-04-25 23:53:27'),(67,'Bolígrafo Bic azul',1,70,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En caja Bic','2015-04-25 23:53:45','2015-04-25 23:53:45'),(68,'Lápiz azul-rojo Faber Castell',1,19,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usados, dos cajas','2015-04-25 23:54:05','2015-04-25 23:54:05'),(69,'Rotulador pilot negro',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:54:18','2015-04-25 23:54:18'),(70,'Lápiz negro Lyreco',1,24,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En dos cajas','2015-04-25 23:54:35','2015-04-25 23:54:35'),(71,'Ticket guardarropa 2013',1,200,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:54:47','2015-04-25 23:54:47'),(72,'Tampón tinta azul',1,3,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:55:02','2015-04-25 23:55:02'),(73,'Rollo cinta carrocero 36mm',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Empezado','2015-04-25 23:55:17','2015-04-25 23:55:17'),(74,'Trozo cinta roja 80cm, 24mm ancho',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:55:27','2015-04-25 23:55:27'),(75,'Goma Milan 430',1,20,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Algunas usadas, en caja Milan 430','2015-04-25 23:55:51','2015-04-25 23:56:23'),(76,'Goma Milan 412',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usada, en caja Milan 430','2015-04-25 23:55:59','2015-04-25 23:56:35'),(77,'Trozo goma borrar varia',1,6,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usada, en caja Milan 430','2015-04-25 23:56:55','2015-04-25 23:56:55'),(78,'Plastiquillo horizontal para acreditación',1,13,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:57:12','2015-04-25 23:57:12'),(79,'Acreditaciones 2012',1,136,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:57:39','2015-04-26 00:22:33'),(80,'Perforadora 1 agujero',1,4,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','2 nuevas','2015-04-25 23:57:55','2015-04-25 23:57:55'),(81,'Rotulador probador de billetes',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:58:04','2015-04-25 23:58:04'),(82,'Sobre A5',1,7,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:58:13','2015-04-25 23:58:13'),(83,'Plastiquillo vertical para acreditación',1,10,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','3 tienen cuerda','2015-04-25 23:58:40','2015-04-25 23:58:40'),(84,'Rollo hilo de pesca 100m',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Uno casi gastado','2015-04-25 23:58:58','2015-04-25 23:58:58'),(85,'Brida negra nylon 2,5x203',1,32,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:59:30','2015-04-25 23:59:30'),(86,'Brida blanca nylon 2,5x100 con cartelito',1,34,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:59:49','2015-04-25 23:59:49'),(87,'Cutter',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-25 23:59:57','2015-04-25 23:59:57'),(88,'Rollo cinta carrocero 50mm',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','mal estado','2015-04-26 00:00:11','2015-04-26 00:00:11'),(89,'Chapas Animacomic 2012, Wonder Woman',1,4,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En caja para tarjetas de visita ya inventariada','2015-04-26 00:00:34','2015-04-26 00:00:34'),(90,'Chapas Animacomic 2012, Superman',1,17,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En caja para tarjetas de visita ya inventariada','2015-04-26 00:00:50','2015-04-26 00:00:50'),(91,'Rotulador permanente negro gordo',1,4,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:01:04','2015-04-26 00:01:04'),(92,'Plastiquillo para A4',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usado','2015-04-26 00:01:17','2015-04-26 00:01:45'),(93,'Plastiquillo para carpetilla A4',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Usado, sin canutillo','2015-04-26 00:01:37','2015-04-26 00:01:37'),(94,'Rollo e cinta de embalar 47mm',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:01:57','2015-04-26 00:01:57'),(95,'Urna',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:03:10','2015-04-26 00:03:10'),(96,'Camiseta Animacomic 2012 M',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:03:24','2015-04-26 00:22:50'),(97,'Camiseta Animacomic 2014 XXL',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:03:34','2015-04-26 00:03:34'),(98,'Camiseta Animacomic 2014 L',1,3,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:03:44','2015-04-26 00:03:44'),(99,'Camiseta Animacomic 2014 S',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:03:51','2015-04-26 00:03:51'),(100,'Camiseta Animacomic 2014 XL',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:03:58','2015-04-26 00:03:58'),(101,'Retales de tela blanca con flores amarillas y azules',1,5,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:04:12','2015-04-26 00:04:12'),(102,'Tela blanca 227x147cm',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:04:25','2015-04-26 00:04:25'),(103,'Cartel A3 Animacomic 2012, papel',1,37,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:04:43','2015-04-26 00:04:43'),(104,'Cuadernillo \"Muestra Jóven Cómic MalagaCrea 2012\"',1,34,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:05:01','2015-04-26 00:05:01'),(105,'Cartel A3 Animacomic 2013, póster',1,5,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:05:57','2015-04-26 00:05:57'),(106,'Cartel Animacomic 2014, póster mayor que A3',1,190,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:06:12','2015-04-26 00:06:12'),(107,'Tattoo-Guante',1,17,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Dos modelos, en bolsa de SuperSkunk','2015-04-26 00:06:44','2015-04-26 00:06:44'),(108,'Bolsito-monedero',1,7,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En bolsa de SuperSkunk','2015-04-26 00:07:02','2015-04-26 00:07:02'),(109,'Reloj de pulsera Corpo Latino',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','En bolsa de SuperSkunk','2015-04-26 00:07:20','2015-04-26 00:07:20'),(110,'Vinilo \"Sweet Factory\"',1,3,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:07:34','2015-04-26 00:07:34'),(111,'Vinilo \"Animacine\"',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:07:43','2015-04-26 00:07:43'),(112,'Vinilo \"SIGA EL RUIDO\"',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:07:52','2015-04-26 00:07:52'),(113,'Vinilo \"SIGA EL\"',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:08:01','2015-04-26 00:08:01'),(114,'Vinilo \"RUIDO\"',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:08:14','2015-04-26 00:08:14'),(115,'Vinilo de una estrella',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:08:23','2015-04-26 00:08:23'),(116,'Retales de goma Eva',1,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:08:49','2015-04-26 00:08:49'),(117,'Kit de pósters varios',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Azpiri y JMV, algunos firmados','2015-04-26 00:09:28','2015-04-26 00:09:28'),(118,'Diario Sur 8/7/13',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:09:42','2015-04-26 00:09:42'),(119,'Diario Sur 9/7/13',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:09:51','2015-04-26 00:09:51'),(120,'Diario Sur 7/7/13',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:10:00','2015-04-26 00:10:00'),(121,'Diario Sur 6/7/13',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:10:10','2015-04-26 00:10:10'),(122,'Fixo con soporte, publicidad de Mycamine',1,32,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:10:34','2015-04-26 00:10:34'),(123,'Achuchable antistress con forma de casco, publicidad de Forsteo',1,4,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:11:03','2015-04-26 00:11:03'),(124,'Cuadernos de notas, publicidad de AlergoLiber',1,46,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:11:16','2015-04-26 00:11:16'),(125,'Taco folios rayados, publicidad de Lilly',1,15,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:11:35','2015-04-26 00:11:35'),(126,'Bloc de hojas lisas, publicidad de Pfizer',1,6,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:11:51','2015-04-26 00:11:51'),(127,'Tacos de notas, publicidad de Bayer',1,4,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:12:04','2015-04-26 00:12:04'),(128,'Kit de 5 figuras Invizimals',1,4,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:12:25','2015-04-26 00:12:25'),(129,'Kit de una figura Invizimals grande',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:12:41','2015-04-26 00:12:41'),(130,'Figura Invizimals',1,25,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:12:53','2015-04-26 00:12:53'),(131,'Carta Invizimals',1,24,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:13:05','2015-04-26 00:13:05'),(132,'Kit manuales HP Officejet 6500A',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:13:32','2015-04-26 00:13:32'),(133,'Kit embalajes HP Officejet 6500A',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:13:47','2015-04-26 00:13:47'),(134,'Ratón óptico USB',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:13:56','2015-04-26 00:13:56'),(135,'Cable alimentación Schuko macho - IEC320 hembra, 1.5m',1,3,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','No etiquetado, no probado','2015-04-26 00:14:31','2015-04-26 00:14:31'),(136,'Cable alimentación Schuko macho - IEC320 hembra, 1.8m',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Cogido con alambrillo, no etiquetado, no probado','2015-04-26 00:15:11','2015-04-26 00:15:11'),(137,'Regleta, cable de 2.9m, 4 enchufes Schuko con interruptor, max 3500W (16A@250x)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','No etiquetado, no probado','2015-04-26 00:15:42','2015-04-26 00:15:42'),(138,'Regleta, cable de 2.9m, 4 enchufes Schuko, max 3500W (16A@250x)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','No etiquetado, no probado','2015-04-26 00:16:05','2015-04-26 00:16:05'),(139,'Latiquillo RJ-11, 5.9m',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','No etiquetado, no probado','2015-04-26 00:16:28','2015-04-26 00:16:28'),(140,'Latiquillo RJ-11, 4.7m',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','No etiquetado, no probado','2015-04-26 00:16:48','2015-04-26 00:16:48'),(141,'Latiquillo RJ-11, 9.9m',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','No etiquetado, no probado','2015-04-26 00:17:11','2015-04-26 00:17:11'),(142,'Adaptador RJ-11 a F-01 (Francia) Ref: 234441-051',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','De la impresora HP Officejet 6500A\r\n','2015-04-26 00:18:17','2015-04-26 00:18:17'),(143,'Adaptador RJ-11 a TD1850 (Países Bajos) Ref: 234441-331',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','De la impresora HP Officejet 6500A\r\n','2015-04-26 00:18:28','2015-04-26 00:18:28'),(144,'Adaptador RJ-11 a Conector Tetrapolar (Bélgica) Ref: 234441-181',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','De la impresora HP Officejet 6500A\r\n','2015-04-26 00:18:40','2015-04-26 00:18:40'),(145,'Adaptador RJ-11 a Conector Tripolar (Italia) Ref: 234441-061',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','De la impresora HP Officejet 6500A\r\n','2015-04-26 00:18:51','2015-04-26 00:18:51'),(146,'Adaptador RJ-11 a TT83 (Suiza) Ref: 234441-112',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','De la impresora HP Officejet 6500A\r\n','2015-04-26 00:19:01','2015-04-26 00:19:01'),(147,'Switch Linksys SRW208P',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:19:09','2015-04-26 00:19:09'),(148,'Latiguillo RJ-45, longitud desconocida',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:19:18','2015-04-26 00:19:18'),(149,'Latiguillo RJ-45, amarillo, longitud desconocida',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:19:25','2015-04-26 00:19:25'),(150,'Cesto verde con cadenas',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:19:42','2015-04-26 00:19:42'),(151,'Cafetera Dolce gusto',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','\r\n','2015-04-26 00:19:53','2015-04-26 00:20:21'),(152,'Enfriador de agua',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:20:31','2015-04-26 00:20:31'),(153,'Cesto mimbre 16x16x5 (A)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:20:45','2015-04-26 00:20:45'),(154,'Cesto mimbre 16x16x5 (B)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:20:57','2015-04-26 00:20:57'),(155,'Cesto mimbre 14,5x26x5.5',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:21:07','2015-04-26 00:21:07'),(156,'Impresión sobre cartón pluma 42x30',1,24,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:21:25','2015-04-26 00:21:25'),(157,'Cepillo de escobón',1,2,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Sin palo\r\n','2015-04-26 00:21:41','2015-04-26 00:21:41'),(158,'Recogedor',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','Sin palo\r\n','2015-04-26 00:21:50','2015-04-26 00:21:50'),(159,'Biblioteca de Mima',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:22:01','2015-04-26 00:22:01'),(160,'Figura Ironman',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:51:32','2015-04-26 00:51:32'),(161,'Figura Luffy',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:51:41','2015-04-26 00:51:41'),(162,'Figura Spiderman',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:51:51','2015-04-26 00:51:51'),(163,'Figura Superman',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:51:59','2015-04-26 00:51:59'),(164,'Figura Wonder Woman',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:52:10','2015-04-26 00:52:10'),(165,'Figura Batman',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:52:18','2015-04-26 00:52:18'),(166,'Rulo de cartón de los usados para las flechas (A)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:52:39','2015-04-26 00:52:39'),(167,'Rulo de cartón de los usados para las flechas (B)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:52:48','2015-04-26 00:52:48'),(168,'Varias hojas hechas con moqueta verde',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:52:59','2015-04-26 00:52:59'),(169,'Cubo de plástico (A)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:53:15','2015-04-26 00:53:15'),(170,'Cubo de plástico (B)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:53:22','2015-04-26 00:53:22'),(171,'Kit de señales usadas en Animacomic 2014',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:53:44','2015-04-26 00:53:44'),(172,'Tela azul',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:53:54','2015-04-26 00:53:54'),(173,'Estructura de roll-up (A)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:54:16','2015-04-26 00:54:16'),(174,'Estructura de roll-up (B)',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:54:23','2015-04-26 00:54:23'),(175,'Botes de pinturas usados en 2014',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:54:33','2015-04-26 00:54:33'),(176,'Tela negra',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:54:44','2015-04-26 00:54:44'),(177,'Cajas pintadas usadas en Animacomic 2014, grandes y pequeñas.',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:54:57','2015-04-26 00:54:57'),(178,'Marcos para exposiciones',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:55:07','2015-04-26 00:55:07'),(179,'Bocadillos-pizarra',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:55:17','2015-04-26 00:55:17'),(180,'Varias lonas',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:56:10','2015-04-26 00:56:10'),(181,'Capa para figura Superman',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:56:39','2015-04-26 00:56:39'),(182,'Casita de cartón montable para colorear',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 00:57:30','2015-04-26 00:57:30'),(183,'Varios ejemplares de El Vosque, de Morán',0,1,'0000-00-00 00:00:00','','9999-12-31 23:59:59','','','2015-04-26 01:43:19','2015-04-26 01:43:19');
/*!40000 ALTER TABLE `objetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objetos_ubicaciones`
--

DROP TABLE IF EXISTS `objetos_ubicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objetos_ubicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objeto_id` int(11) NOT NULL,
  `ubicacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetos_ubicaciones`
--

LOCK TABLES `objetos_ubicaciones` WRITE;
/*!40000 ALTER TABLE `objetos_ubicaciones` DISABLE KEYS */;
INSERT INTO `objetos_ubicaciones` VALUES (2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,1),(11,11,1),(12,12,1),(13,13,1),(14,14,1),(15,15,1),(16,16,1),(17,17,1),(18,18,1),(19,19,2),(20,20,2),(21,21,2),(22,22,2),(23,23,2),(24,24,2),(25,25,2),(26,26,2),(27,27,3),(28,28,3),(29,29,3),(30,30,3),(31,31,3),(32,32,3),(33,33,3),(34,34,3),(36,36,4),(37,37,4),(38,38,4),(39,39,4),(40,40,4),(41,41,4),(42,42,4),(43,43,4),(44,44,4),(45,45,4),(46,46,4),(47,47,4),(48,48,4),(49,49,4),(50,50,4),(51,51,4),(52,52,4),(53,53,4),(54,54,4),(55,55,4),(56,56,4),(57,57,4),(58,58,4),(59,59,4),(60,60,4),(61,61,4),(62,62,4),(63,63,4),(64,64,4),(65,65,4),(66,66,4),(67,67,4),(68,68,4),(69,69,4),(70,70,4),(71,71,4),(72,72,4),(73,73,4),(74,74,4),(75,75,4),(76,76,4),(77,77,4),(78,78,4),(79,79,4),(80,80,4),(81,81,4),(82,82,4),(83,83,4),(84,84,4),(85,85,4),(86,86,4),(87,87,4),(88,88,4),(89,89,4),(90,90,4),(91,91,4),(92,92,4),(93,93,4),(94,94,4),(95,95,5),(96,96,5),(97,97,5),(98,98,5),(99,99,5),(100,100,5),(101,101,5),(102,102,5),(103,103,5),(104,104,5),(105,105,5),(106,106,5),(107,107,5),(108,108,5),(109,109,5),(110,110,5),(111,111,5),(112,112,5),(113,113,5),(114,114,5),(115,115,5),(116,116,6),(117,117,7),(118,118,7),(119,119,7),(120,120,7),(121,121,7),(122,122,8),(123,123,9),(124,124,9),(125,125,10),(126,126,10),(127,127,10),(128,128,11),(129,129,11),(130,130,11),(131,131,11),(132,132,12),(133,133,12),(134,134,12),(135,135,12),(136,136,12),(137,137,12),(138,138,12),(139,139,12),(140,140,12),(141,141,12),(142,142,12),(143,143,12),(144,144,12),(145,145,12),(146,146,12),(147,147,12),(148,148,12),(149,149,12),(150,150,13),(151,151,13),(152,152,13),(153,153,13),(154,154,13),(155,155,13),(156,156,13),(157,157,14),(158,158,14),(159,159,15),(160,160,16),(161,161,16),(162,162,16),(163,163,16),(164,164,16),(165,165,16),(166,166,16),(167,167,16),(168,168,16),(169,169,16),(170,170,16),(171,171,16),(172,172,16),(173,173,16),(174,174,16),(175,175,16),(176,176,16),(177,177,16),(178,178,16),(179,179,16),(180,180,16),(181,181,16),(182,182,16),(183,183,16),(261,1,1),(262,1,3);
/*!40000 ALTER TABLE `objetos_ubicaciones` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicaciones`
--

LOCK TABLES `ubicaciones` WRITE;
/*!40000 ALTER TABLE `ubicaciones` DISABLE KEYS */;
INSERT INTO `ubicaciones` VALUES (1,'Caja 1','2015-04-25 23:11:55','2015-04-25 23:11:55'),(2,'Caja 2','2015-04-25 23:12:01','2015-04-25 23:12:01'),(3,'Caja 3','2015-04-25 23:12:06','2015-04-25 23:12:06'),(4,'Caja 4','2015-04-25 23:12:36','2015-04-25 23:12:36'),(5,'Caja 5','2015-04-25 23:12:40','2015-04-25 23:12:40'),(6,'Bolsa 1','2015-04-25 23:13:16','2015-04-25 23:13:16'),(7,'Caja 6','2015-04-25 23:13:31','2015-04-25 23:13:31'),(8,'Caja A','2015-04-25 23:13:35','2015-04-25 23:13:35'),(9,'Caja B','2015-04-25 23:13:40','2015-04-25 23:13:40'),(10,'Caja C','2015-04-25 23:15:37','2015-04-25 23:15:37'),(11,'Caja Invizimals','2015-04-25 23:15:41','2015-04-25 23:15:41'),(12,'Caja Officejet 6500A','2015-04-25 23:15:55','2015-04-25 23:15:55'),(13,'Oficina de El Lapicero','2015-04-25 23:16:15','2015-04-25 23:16:15'),(14,'Bolsa negra','2015-04-25 23:16:23','2015-04-25 23:16:23'),(15,'Casa de Marian','2015-04-25 23:16:36','2015-04-25 23:16:36'),(16,'Casa de David','2015-04-26 00:51:11','2015-04-26 00:51:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Usuario','admin','admin','','6fb913c8c31f6db76281163a5a0de50e9d8ed128','pepe@jariza.net','2015-03-18 23:48:46','2015-03-22 23:05:44');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zonas`
--

LOCK TABLES `zonas` WRITE;
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `zonas` VALUES (1,'Auditorio','','0','0000-00-00 00:00:00','2015-05-07 02:13:35','2015-05-07 02:13:35'),(2,'Sala de conferencias','','0','0000-00-00 00:00:00','2015-05-07 02:13:45','2015-05-07 02:20:59'),(3,'Sala de talleres','','0','0000-00-00 00:00:00','2015-05-07 02:13:56','2015-05-07 02:13:56'),(4,'Escenario','','0','0000-00-00 00:00:00','2015-05-07 02:14:06','2015-05-07 02:14:06'),(5,'Stand Animacomic','','0','0000-00-00 00:00:00','2015-05-07 02:18:57','2015-05-07 02:19:26'),(6,'Puerta','','0','0000-00-00 00:00:00','2015-05-07 02:19:54','2015-05-07 02:19:54'),(7,'Taquillas','','0','0000-00-00 00:00:00','2015-05-07 02:20:04','2015-05-07 02:20:04'),(8,'Sala VIP','','0','0000-00-00 00:00:00','2015-05-07 02:20:13','2015-05-07 02:20:13');
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

-- Dump completed on 2015-05-07  2:51:44
