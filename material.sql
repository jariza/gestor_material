-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-04-2015 a las 04:42:00
-- Versión del servidor: 5.5.41-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `material`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `zona_id` int(11) NOT NULL,
  `enlaceweb` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `desctecnica` text COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `zona_id`, `enlaceweb`, `desctecnica`, `created`, `modified`) VALUES
(1, 'asd', 1, 'http://www.uma.es', 'asdasd\r\nasdasd\r\nasdasd', '0000-00-00 00:00:00', '2015-04-07 04:38:25'),
(2, 'Actividad 2, de zona id3', 3, 'http://www.animacomic.es', '', '0000-00-00 00:00:00', '2015-04-07 04:36:28'),
(3, '2334234<b>NNNN</b>', 1, '', '234234234234\r\n234242\r\n42423423\r\n4234234234<<<>>>>><b>HOOOLAAA</b>', '2015-03-24 20:50:18', '2015-03-26 21:33:32'),
(6, 'Actividad con requisitos', 1, '', '', '2015-03-25 20:24:16', '2015-03-25 20:30:15'),
(7, 'Actividad con objetos', 1, '', '', '2015-03-26 01:54:41', '2015-04-07 04:37:30'),
(8, 'Horas', 1, '', '', '2015-03-26 20:38:11', '2015-03-26 21:02:43'),
(9, 'Horas2', 1, '', '', '2015-03-26 20:49:01', '2015-03-26 20:49:01'),
(10, 'Horas3', 1, '', '', '2015-03-26 20:51:26', '2015-03-26 20:51:26'),
(11, 'Horas4', 1, '', '', '2015-03-26 20:53:09', '2015-03-26 20:57:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad_id` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `actividad_id`, `inicio`, `fin`, `created`, `modified`) VALUES
(1, 8, '2015-03-10 20:37:00', '2015-03-10 20:37:00', '2015-03-26 20:38:11', '2015-03-26 20:38:11'),
(2, 9, '2015-03-26 20:48:00', '2015-03-26 20:48:00', '2015-03-26 20:49:01', '2015-03-26 20:49:01'),
(3, 10, '2015-03-26 20:51:00', '2015-03-26 20:51:00', '2015-03-26 20:51:26', '2015-03-26 20:51:26'),
(4, 11, '2015-03-26 20:53:00', '2015-03-26 20:53:00', '2015-03-26 20:53:09', '2015-03-26 20:53:09'),
(5, 11, '2015-03-26 20:53:00', '2015-03-26 20:53:00', '2015-03-26 20:53:09', '2015-03-26 20:53:09'),
(6, 11, '2015-03-26 20:57:00', '2015-03-26 20:57:00', '2015-03-26 20:57:36', '2015-03-26 20:57:36'),
(7, 11, '2015-03-26 20:57:00', '2015-03-26 20:57:00', '2015-03-26 20:57:36', '2015-03-26 20:57:36'),
(8, 8, '2015-03-26 21:02:00', '2015-03-26 21:02:00', '2015-03-26 21:02:43', '2015-03-26 21:02:43'),
(9, 1, '2015-03-26 21:07:00', '2015-03-26 21:07:00', '2015-03-26 21:07:33', '2015-03-26 21:07:33'),
(10, 1, '2015-03-26 21:07:00', '2015-03-26 21:07:00', '2015-03-26 21:07:39', '2015-03-26 21:07:39'),
(11, 1, '2015-03-26 21:07:00', '2015-03-26 21:07:00', '2015-03-26 21:20:55', '2015-03-26 21:20:55'),
(12, 2, '2015-03-26 21:24:00', '2015-03-26 21:24:00', '2015-03-26 21:24:49', '2015-03-26 21:25:18'),
(13, 2, '2015-03-26 21:24:00', '2015-03-26 21:24:00', '2015-03-26 21:24:55', '2015-03-26 21:25:18'),
(14, 2, '2015-03-26 21:24:00', '2015-03-26 21:24:00', '2015-03-26 21:25:04', '2015-03-26 21:25:18'),
(19, 3, '2015-03-26 21:31:00', '2015-03-26 21:31:00', '2015-03-26 21:33:04', '2015-03-26 21:33:32'),
(21, 3, '2015-06-26 21:31:00', '2015-03-26 21:31:00', '2015-03-26 21:33:32', '2015-03-26 21:33:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_fallidos`
--

CREATE TABLE IF NOT EXISTS `login_fallidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `IP` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `login_fallidos`
--

INSERT INTO `login_fallidos` (`id`, `created`, `IP`, `username`) VALUES
(1, '2015-03-20 23:10:06', '127.0.0.1', 'root'),
(2, '2015-03-23 20:51:27', '127.0.0.1', 'root'),
(3, '2015-03-23 20:51:30', '127.0.0.1', 'root');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `necesidadactividades`
--

CREATE TABLE IF NOT EXISTS `necesidadactividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `objeto_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `necesidadactividades`
--

INSERT INTO `necesidadactividades` (`id`, `descripcion`, `cantidad`, `actividad_id`, `objeto_id`, `created`, `modified`) VALUES
(1, 'req1', 1, 6, NULL, '2015-03-25 20:24:16', '2015-03-25 20:30:15'),
(4, 'req5', 5, 6, NULL, '2015-03-25 20:29:20', '2015-03-25 20:30:15'),
(5, 'a1', 1, 7, 2, '2015-03-26 01:54:41', '2015-04-07 04:37:30'),
(6, 's3', 3, 7, 8, '2015-03-26 01:54:41', '2015-04-07 04:37:30'),
(7, '', 0, 11, NULL, '2015-03-26 20:57:36', '2015-03-26 20:57:36'),
(8, '', 0, 11, NULL, '2015-03-26 20:57:36', '2015-03-26 20:57:36'),
(9, '', 0, 8, NULL, '2015-03-26 21:02:43', '2015-03-26 21:02:43'),
(12, 'asd', 1, 3, 2, '2015-03-26 21:31:31', '2015-03-26 21:33:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `necesidadzonas`
--

CREATE TABLE IF NOT EXISTS `necesidadzonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `objeto_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `necesidadzonas`
--

INSERT INTO `necesidadzonas` (`id`, `descripcion`, `cantidad`, `zona_id`, `objeto_id`, `created`, `modified`) VALUES
(1, 'otra cosa', 1, 9, NULL, '2015-03-24 22:49:51', '2015-03-24 22:49:51'),
(2, 'asdasd', 1, 10, NULL, '2015-03-24 22:50:57', '2015-03-24 22:50:57'),
(3, 'asdasd', 0, 11, NULL, '2015-03-24 22:52:12', '2015-03-24 22:52:12'),
(4, '123123', 1, 12, NULL, '2015-03-24 22:52:43', '2015-03-24 23:15:14'),
(8, 'CUARTA', 23, 12, NULL, '2015-03-24 23:15:14', '2015-03-24 23:15:14'),
(9, 'nec1', 1, 16, NULL, '2015-03-25 20:17:23', '2015-03-25 20:17:43'),
(11, 'nec4', 1, 16, NULL, '2015-03-25 20:17:43', '2015-03-25 20:17:43'),
(12, 'necesisdad 1', 1, 1, 2, '2015-03-26 01:17:50', '2015-04-07 03:47:13'),
(13, 'cosa 1', 1, 22, 2, '2015-03-26 01:26:51', '2015-03-26 01:26:51'),
(14, 'cosa 1', 1, 23, 2, '2015-03-26 01:31:56', '2015-03-26 01:31:56'),
(15, 'cosa 2', 2, 23, 9, '2015-03-26 01:31:56', '2015-03-26 01:31:56'),
(16, 'necesisdad 1', 2, 1, 3, '2015-03-26 01:49:19', '2015-04-07 03:47:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetos`
--

CREATE TABLE IF NOT EXISTS `objetos` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `objetos`
--

INSERT INTO `objetos` (`id`, `descripcion`, `ubicacion_id`, `fungible`, `cantidad`, `fechaentrega`, `comentariosentrega`, `fechadevolucion`, `comentariosdevolucion`, `comentarios`, `created`, `modified`) VALUES
(1, 'Primer objeto', 1, 1, 10, '0000-00-00 00:00:00', '', '9999-12-31 23:59:59', '', 'Está en 2 y es equipamiento.', '2015-03-19 00:45:51', '2015-03-23 22:07:08'),
(2, 'Objeto en ubicación 1, no fungible', 1, 0, 1, '0000-00-00 00:00:00', '', '2015-04-23 22:25:00', 'Es de huelva', '', '2015-03-23 00:01:21', '2015-03-23 22:25:40'),
(3, 'sec2', 1, 0, 1, '0000-00-00 00:00:00', '', '9999-12-31 23:59:59', '', '', '2015-03-23 00:03:39', '2015-03-23 22:24:00'),
(4, 'sec3', -1, 0, 1, '2015-03-23 00:04:00', '', '9999-12-31 23:59:59', '', '', '2015-03-23 00:04:09', '2015-03-23 22:24:03'),
(5, 'sec4', -1, 0, 1, '2015-03-23 00:10:00', 'lo mismo llega, lo mismo no y vete a saber donde', '2015-03-25 21:43:00', 'sdfsdf', '', '2015-03-23 00:11:04', '2015-03-25 21:43:08'),
(6, 'sec6', 1, 1, 1, '0000-00-00 00:00:00', '', '9999-12-31 23:59:59', '', '', '2015-03-23 00:28:28', '2015-03-23 22:25:19'),
(7, 'sec7', -1, 0, 1, '2015-03-23 00:28:00', '', '9999-12-31 23:59:59', '', '', '2015-03-23 00:28:35', '2015-03-23 22:25:22'),
(8, 'sec9', 1, 0, 1, '0000-00-00 00:00:00', '', '9999-12-31 23:59:59', '', '', '2015-03-23 00:30:42', '2015-03-23 22:25:25'),
(9, 'sec10', 1, 0, 1, '0000-00-00 00:00:00', '', '9999-12-31 23:59:59', '', '', '2015-03-23 00:30:52', '2015-03-23 22:25:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `nombre`, `created`, `modified`) VALUES
(1, 'Ubicación 1', '2015-03-19 00:12:25', '2015-03-24 21:07:43'),
(2, 'Ubicación 2', '2015-03-19 00:12:31', '2015-03-19 00:12:31'),
(4, 'Ubicación 3', '2015-03-19 00:12:48', '2015-03-19 00:12:48'),
(5, '<b>NNN</b>', '2015-03-24 21:02:20', '2015-03-24 21:15:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `username`, `rol`, `zonas`, `password`, `email`, `created`, `modified`) VALUES
(1, 'Usuario', 'admin', 'admin', '', '6fb913c8c31f6db76281163a5a0de50e9d8ed128', 'pepe@jariza.net', '2015-03-18 23:48:46', '2015-03-22 23:05:44'),
(2, 'stage1', 'stage1', 'managerzona', '3', 'ec9c306ef3cfd6d94c6730ba6891cbdac935d184', 'stage1@jariza.net', '2015-03-22 00:50:03', '2015-03-22 23:07:17'),
(3, 'stage2', 'stage2', 'admin', '', 'fc0f0110bab743a784903446b4ca14f85019f466', 'stage2@jariza.net', '2015-03-22 01:29:43', '2015-03-22 23:06:06'),
(4, 'otromanager', 'otromanager', 'managerzona', '1,3', 'ec9c306ef3cfd6d94c6730ba6891cbdac935d184', 'otromanager@jariza.net', '2015-03-22 23:07:45', '2015-03-22 23:07:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE IF NOT EXISTS `zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `desctecnica` text COLLATE utf8_spanish_ci NOT NULL,
  `calendarioext` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `sync_calext` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `nombre`, `desctecnica`, `calendarioext`, `sync_calext`, `created`, `modified`) VALUES
(1, 'Zona 1', '', 'k4m5dm13lfkdpk66qi02tui17o@group.calendar.google.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-04-07 03:47:13'),
(3, 'Otra zona', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '<b>asdasd<b/>', 'qwqeqwe\r\nqweqeqwe\r\nqweqeqweq\r\neqweqewqwe', '', '0000-00-00 00:00:00', '2015-03-24 20:52:13', '2015-03-24 21:27:03'),
(5, 'Zona nueva', '', '', '0000-00-00 00:00:00', '2015-03-24 22:47:01', '2015-03-24 22:47:01'),
(6, 'Zona repetible', '', '', '0000-00-00 00:00:00', '2015-03-24 22:48:32', '2015-03-24 22:48:32'),
(7, 'Zona repetible', '', '', '0000-00-00 00:00:00', '2015-03-24 22:49:21', '2015-03-24 22:49:21'),
(9, 'Zona repetible', '', '', '0000-00-00 00:00:00', '2015-03-24 22:49:51', '2015-03-24 22:49:51'),
(10, 'La del fallo', '', '', '0000-00-00 00:00:00', '2015-03-24 22:50:57', '2015-03-24 22:50:57'),
(11, 'La del fallo 2', '', '', '0000-00-00 00:00:00', '2015-03-24 22:52:12', '2015-03-24 22:52:12'),
(12, 'La del fallo 3', '', '', '0000-00-00 00:00:00', '2015-03-24 22:52:43', '2015-03-24 23:15:14'),
(15, 'Vacía', '', '', '0000-00-00 00:00:00', '2015-03-25 03:37:07', '2015-03-25 03:37:07'),
(16, 'Otra más', '', '', '0000-00-00 00:00:00', '2015-03-25 20:17:23', '2015-03-25 20:17:43'),
(17, 'Relleno 1', '', '', '0000-00-00 00:00:00', '2015-03-25 21:47:07', '2015-03-25 21:47:07'),
(18, 'Relleno 2', '', '', '0000-00-00 00:00:00', '2015-03-25 21:47:16', '2015-03-25 21:47:16'),
(19, 'Relleno 3', '', '', '0000-00-00 00:00:00', '2015-03-25 21:47:23', '2015-03-25 21:47:23'),
(20, 'Relleno 4', '', '', '0000-00-00 00:00:00', '2015-03-25 21:47:33', '2015-03-25 21:47:33'),
(21, 'Relleno 5', '', '', '0000-00-00 00:00:00', '2015-03-25 21:47:43', '2015-03-25 21:47:43'),
(22, 'Nuevo objeto', '', '', '0000-00-00 00:00:00', '2015-03-26 01:26:51', '2015-03-26 01:26:51'),
(23, 'Con objeto', '', '', '0000-00-00 00:00:00', '2015-03-26 01:31:56', '2015-03-26 01:31:56'),
(24, 'Prueba sin calendari', '', '', '0000-00-00 00:00:00', '2015-04-07 02:31:03', '2015-04-07 02:31:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
