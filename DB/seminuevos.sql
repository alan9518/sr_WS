-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2019 a las 04:59:38
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seminuevos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addAgencia` (IN `nombre_agencia` VARCHAR(100), IN `nombre_usuario` VARCHAR(100), IN `correo` VARCHAR(100), IN `pass` TEXT, IN `telefono` VARCHAR(12))  NO SQL
INSERT INTO `agencias`(`nombre_agencia`, `nombre_vendedor`, `correo`, `pass`, `telefono`) VALUES (nombre_agencia, nombre_vendedor, correo, pass, telefono)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addUser` (IN `nombre` VARCHAR(100), IN `apellidos` VARCHAR(100), IN `correo` VARCHAR(100), IN `pass` TEXT, IN `telefono` VARCHAR(12))  NO SQL
INSERT INTO `usuarios`(`nombre`, `apellidos`, `correo`, `pass`, `telefono`) VALUES (nombre, apellidos, correo, pass, telefono)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAgenciaDetailsContact` (IN `id_agencia` INT(11))  NO SQL
SELECT `nombre_agencia`, `nombre_vendedor` , `correo` FROM `agencias`INNER JOIN anuncios ON anuncios.id_agencia =  agencias.id
WHERE agencias.id =  id_agencia$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAnuncioDetails` (IN `id` INT(11))  NO SQL
SELECT 	
 		anuncios.id, 
		anuncios.titulo, 
        anuncios.Descripcion as shortDescription,
        anuncios.imagen_destacada,
        anuncios.precio,
        anuncios.created_at,
        anuncios.id_vendedor,
        anuncios.id_agencia,
        anuncios.ubicacion,
        anuncios.propietarios,
        vehiculos.id,
        vehiculos.year,
        vehiculos.kilometraje,
        vehiculos.equipamento,
        vehiculos.transmision,
        vehiculos.estilo_carroceria,
        vehiculos.tipo_combustible,
        vehiculos.tipo_manejo,
        vehiculos.color,
        vehiculos.vestiduras
        
        
FROM `anuncios` 
INNER JOIN vehiculos 
ON vehiculos.id =  anuncios.id_vehiculo
WHERE anuncios.id =  id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getImagenesAnuncio` (IN `id` INT(11))  NO SQL
SELECT `id_anuncio`, `ruta_imagen`, `destacada` FROM `imagen_anuncio` WHERE id_anuncio = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getVendedorDetailsContact` (IN `id_usuario` INT(11))  NO SQL
SELECT `nombre`,`correo` FROM `usuarios` INNER JOIN anuncios ON anuncios.id_vendedor =  usuarios.id
WHERE usuarios.id =  1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listAnunciosAll` ()  NO SQL
SELECT 	anuncios.id, 
		anuncios.titulo, 
        anuncios.Descripcion as shortDescription,
        anuncios.imagen_destacada,
        anuncios.precio,
        vehiculos.id,
        vehiculos.year,
        vehiculos.kilometraje,
        vehiculos.equipamento,
        vehiculos.transmision,
        vehiculos.estilo_carroceria
FROM `anuncios` 
INNER JOIN vehiculos 
ON vehiculos.id =  anuncios.id_vehiculo
ORDER BY anuncios.created_at$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `loginAgencia` (IN `nombre_agencia` VARCHAR(100), IN `correo_usuario` VARCHAR(100), IN `pass_usuario` TEXT)  NO SQL
select `agencias`.`id`, `agencias`.`nombre_agencia`, `agencias`.`nombre_vendedor` FROM `agencias` WHERE `agencias`.`nombre_agencia` = nombre_agencia AND `agencias`.`correo` = correo_usuario AND `agencias`.`pass` = pass_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `loginUsuario` (IN `correo_usuario` VARCHAR(100), IN `pass_usuario` TEXT)  NO SQL
SELECT `usuarios`.`id`, `usuarios`.`nombre` FROM `usuarios` WHERE `usuarios`.`correo` =  correo_usuario AND `usuarios`.`pass` = pass_usuario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencias`
--

CREATE TABLE `agencias` (
  `id` int(11) NOT NULL,
  `nombre_agencia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_vendedor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pass` text COLLATE utf8_spanish_ci,
  `telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `agencias`
--

INSERT INTO `agencias` (`id`, `nombre_agencia`, `nombre_vendedor`, `correo`, `pass`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'agencia1', 'alan', 'agencia1@gmail.com', '0b2c94ff396625bdf68f024b85ea2ffa', '66666', '2019-01-30 03:37:45', '2019-01-30 03:22:55'),
(2, 'agencia2', '', 'agencia2@GMAIL.COM', 'pass', 'agencia2', '2019-01-30 03:58:04', '2019-01-30 03:58:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `id_tipo_anuncio` int(11) NOT NULL,
  `id_vehiculo` int(11) UNSIGNED NOT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `id_agencia` int(11) DEFAULT NULL,
  `tipo_usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `precio` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci,
  `imagen_destacada` longtext COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `condicion_vehiculo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `propietarios` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_cierre` datetime NOT NULL,
  `estado_anuncio` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `anuncio_pagado` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_anuncio_pagado` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `metodo_pago` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id`, `id_tipo_anuncio`, `id_vehiculo`, `id_vendedor`, `id_agencia`, `tipo_usuario`, `titulo`, `precio`, `Descripcion`, `imagen_destacada`, `fecha_creado`, `condicion_vehiculo`, `ubicacion`, `propietarios`, `fecha_cierre`, `estado_anuncio`, `anuncio_pagado`, `precio_anuncio_pagado`, `metodo_pago`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, NULL, 'cliente', 'Mazda ILX', '150000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy', 'http://carzone.dexignlab.com/xhtml/images/blog/grid/pic1.jpg', '2019-01-27 00:00:00', 'usado', 'guadaljara,jaslico', '1', '2019-02-16 00:00:00', 'en venta', 'false', '0', '-', '2019-01-28 01:14:11', '2019-01-28 01:14:11'),
(2, 3, 2, 2, NULL, 'cliente', 'Mazda ILX', '25000', '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy', 'http://carzone.dexignlab.com/xhtml/images/blog/grid/pic2.jpg', '2019-01-27 00:00:00', 'nuevo', 'zappan, jaslico', '2', '2019-02-16 00:00:00', 'nuevo', NULL, NULL, '', '2019-01-28 01:14:11', '2019-01-28 01:14:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Aguascalientes'),
(2, 'Baja California'),
(3, 'Baja California Sur'),
(4, 'Campeche'),
(5, 'Chihuahua'),
(6, 'Chiapas'),
(7, 'Coahuila'),
(8, 'Colima'),
(9, 'Durango'),
(10, 'Guanajuato'),
(11, 'Guerrero'),
(12, 'Hidalgo'),
(13, 'Jalisco'),
(14, 'México'),
(15, 'Michoacán'),
(16, 'Morelos'),
(17, 'Nayarit'),
(18, 'Nuevo León'),
(19, 'Oaxaca'),
(20, 'Puebla'),
(21, 'Querétaro'),
(22, 'Quintana Roo'),
(23, 'San Luis Potosí'),
(24, 'Sinaloa'),
(25, 'Sonora'),
(26, 'Tabasco'),
(27, 'Tamaulipas'),
(28, 'Tlaxcala'),
(29, 'Veracruz'),
(30, 'Yucatán'),
(31, 'Zacatecas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_anuncio`
--

CREATE TABLE `imagen_anuncio` (
  `id` int(11) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `ruta_imagen` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `destacada` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagen_anuncio`
--

INSERT INTO `imagen_anuncio` (`id`, `id_anuncio`, `ruta_imagen`, `destacada`) VALUES
(1, 1, 'http://carzone.dexignlab.com/xhtml/images/blog/grid/pic1.jpg', 'true'),
(2, 2, 'http://carzone.dexignlab.com/xhtml/images/blog/grid/pic1.jpg', 'true'),
(5, 1, 'http://carzone.dexignlab.com/xhtml/images/blog/grid/pic2.jpg', 'false'),
(6, 1, 'http://carzone.dexignlab.com/xhtml/images/blog/grid/pic3.jpg', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Acura', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(2, 'Alfa Romeo', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(3, 'Audi', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(4, 'Baic', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(5, 'BMW', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(6, 'Buick', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(7, 'Cadillac', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(8, 'Chevroleft', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(9, 'Chrysler', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(10, 'Dodge', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(11, 'FAW', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(12, 'FIAT', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(13, 'Ford', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(14, 'Giant', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(15, 'GMO', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(16, 'Honda', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(17, 'Hummer', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(18, 'Hyundai', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(19, 'Infiniti', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(20, 'Isuzu', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(21, 'Jaguar', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(22, 'JAC', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(23, 'JEEP', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(24, 'KIA', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(25, 'Land Rover', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(26, 'Lincoln', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(27, 'Mazda', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(28, 'Mercedes - Benza', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(29, 'Mercury', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(30, 'Mini', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(31, 'Mitsubishi', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(32, 'Nissan', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(33, 'Peugeot', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(34, 'Pontiac', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(35, 'Porsche', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(36, 'Renault', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(37, 'SAAB', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(38, 'SEAT', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(39, 'Smart', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(40, 'Subaru', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(41, 'Suzuki', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(42, 'Toyota', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(43, 'Volkswagen', '2019-01-21 06:00:00', '2019-01-21 06:00:00'),
(44, 'Volvo', '2019-01-21 06:00:00', '2019-01-21 06:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id` int(10) UNSIGNED NOT NULL,
  `marca_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `marca_id`, `nombre`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 'ILX', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(2, 1, 'ILX', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(3, 1, 'MDX', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(4, 1, 'MDX', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(5, 1, 'NSX', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(6, 1, 'RDX', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(7, 1, 'RDX', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(8, 1, 'TLX', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(9, 1, 'TLX', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(10, 2, 'MITO', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(11, 2, 'MITO', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(12, 2, 'GIULIETTA', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(13, 2, 'GIULIETTA', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(14, 2, 'GIULIA', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(15, 2, 'GIULIA', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(16, 2, 'STELVIO', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(17, 2, '4C', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(18, 2, '4C', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(19, 3, 'A1', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(20, 3, 'A1', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(21, 3, 'A3', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(22, 3, 'A3', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(23, 3, 'A4', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(24, 3, 'A4', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(25, 3, 'A5', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(26, 3, 'A5', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(27, 3, 'A6', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(28, 3, 'A6', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(29, 3, 'A7', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(30, 3, 'A7', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(31, 3, 'A8', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(32, 3, 'A8', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(33, 3, 'Q2', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(34, 3, 'Q3', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(35, 3, 'Q3', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(36, 3, 'Q5', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(37, 3, 'Q5', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(38, 3, 'Q7', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(39, 3, 'Q7', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(40, 3, 'R8', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(41, 3, 'R8', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(42, 3, 'TT', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(43, 3, 'TT', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(44, 4, 'BJ40', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(45, 4, 'D20', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(46, 4, 'D20', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(47, 4, 'D20', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(48, 4, 'D20', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(49, 4, 'x25', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(50, 4, 'x25', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(51, 4, 'x65', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(52, 5, 'i5', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(53, 5, 'i5', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(54, 5, 'i8', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(55, 5, 'i8', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(56, 5, 'SERIE 1', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(57, 5, 'SERIE 1', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(58, 5, 'SERIE 2', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(59, 5, 'SERIE 2', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(60, 5, 'SERIE 3', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(61, 5, 'SERIE 3', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(62, 5, 'SERIE 4', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(63, 5, 'SERIE 4', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(64, 5, 'SERIE 5', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(65, 5, 'SERIE 5', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(66, 5, 'SERIE 6', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(67, 5, 'SERIE 6', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(68, 5, 'SERIE 7', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(69, 5, 'SERIE 7', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(70, 5, 'SERIE 8', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(71, 5, 'Z4', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(72, 5, 'Z4', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(73, 5, 'Z4', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(74, 5, 'Z3', '2003', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(75, 5, 'Z3', '2002', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(76, 5, 'Z3', '2001', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(77, 5, 'Z3', '2000', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(78, 5, 'Z3', '1999', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(79, 5, 'Z3', '1998', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(80, 5, 'Z3', '1997', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(81, 5, 'X1', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(82, 5, 'X1', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(83, 5, 'X2', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(84, 5, 'X3', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(85, 5, 'X3', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(86, 5, 'X4', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(87, 5, 'X4', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(88, 5, 'X5', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(89, 5, 'X5', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(90, 5, 'X6', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(91, 5, 'X6', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(92, 6, 'ENCLAVE', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(93, 6, 'ENCLAVE', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(94, 6, 'ENCLAVE', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(95, 6, 'ENCORE', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(96, 6, 'ENCORE', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(97, 6, 'ENCORE', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(98, 6, 'ENVISION', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(99, 6, 'ENVISION', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(100, 6, 'REGAL', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(101, 7, 'ATS', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(102, 7, 'ATS', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(103, 7, 'CTS', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(104, 7, 'CTS', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(105, 7, 'ESCALADE', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(106, 7, 'ESCALADE', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(107, 7, 'ESCALADE', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(108, 7, 'XT5', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(109, 7, 'XT5', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(110, 7, 'XT5', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(111, 8, 'AVEO', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(112, 8, 'AVEO', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(113, 8, 'AVEO', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(114, 8, 'BEAT', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(115, 8, 'BEAT', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(116, 8, 'BOLT', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(117, 8, 'BOLT', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(118, 8, 'BOLT', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(119, 8, 'CAMARO', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(120, 8, 'CAMARO', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(121, 8, 'CAVALIER', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(122, 8, 'CAVALIER', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(123, 8, 'CHEVY', '2012', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(124, 8, 'CHEVY', '2011', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(125, 8, 'CHEVY', '2010', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(126, 8, 'CHEVY', '2009', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(127, 8, 'CHEVY', '2008', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(128, 8, 'CHEVY', '2007', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(129, 8, 'CHEYENNE', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(130, 8, 'CHEYENNE', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(131, 8, 'COLORADO', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(132, 8, 'COLORADO', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(133, 8, 'CORVETTE', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(134, 8, 'CORVETTE', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(135, 8, 'CORVETTE', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(136, 8, 'CRUZE', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(137, 8, 'CRUZE', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(138, 8, 'EQUINOX', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(139, 8, 'EQUINOX', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(140, 8, 'EQUINOX', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(141, 8, 'EXPRESS VAN', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(142, 8, 'EXPRESS VAN', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(143, 8, 'EXPRESS CARGO VAN', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(144, 8, 'EXPRESS CARGO VAN', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(145, 8, 'MALIBU', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(146, 8, 'MALIBU', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(147, 8, 'MALIBU', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(148, 8, 'MATIZ', '2015', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(149, 8, 'MATIZ', '2014', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(150, 8, 'MATIZ', '2013', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(151, 8, 'MATIZ', '2012', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(152, 8, 'MATIZ', '2011', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(153, 8, 'MATIZ', '2010', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(154, 8, 'MATIZ', '2009', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(155, 8, 'MATIZ', '2008', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(156, 8, 'MATIZ', '2007', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(157, 8, 'S10', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(158, 8, 'SONIC', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(159, 8, 'SPARK', '2018,2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(160, 8, 'SILVERADO 1500', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(161, 8, 'SILVERADO 1500', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(162, 8, 'SILVERADO 2500', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(163, 8, 'SILVERADO 2500', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(164, 8, 'SILVERADO 3500', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(165, 8, 'SILVERADO 3500', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(166, 8, 'SUBURBAN', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(167, 8, 'SUBURBAN', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(168, 8, 'SUBURBAN', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(169, 8, 'TAHOE', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(170, 8, 'TAHOE', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(171, 8, 'TAHOE', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(172, 8, 'TORNADO', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(173, 8, 'TORNADO', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(174, 8, 'TRAVERSE', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(175, 8, 'TRAVERSE', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(176, 8, 'TRAVERSE', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(177, 8, 'TRAX', '2019', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(178, 8, 'TRAX', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(179, 8, 'TRAX', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(180, 8, 'VOLT', '2018', '2019-01-21 12:00:00', '2019-01-21 12:00:00'),
(181, 8, 'VOLT', '2017', '2019-01-21 12:00:00', '2019-01-21 12:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_anuncio`
--

CREATE TABLE `tipo_anuncio` (
  `id` int(11) NOT NULL,
  `tipo_anuncio` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_anuncio`
--

INSERT INTO `tipo_anuncio` (`id`, `tipo_anuncio`) VALUES
(1, 'premium'),
(2, 'clasico'),
(3, 'estandar'),
(4, 'agencias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculo`
--

CREATE TABLE `tipo_vehiculo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_vehiculo`
--

INSERT INTO `tipo_vehiculo` (`id`, `tipo`) VALUES
(1, 'auto'),
(2, 'moto'),
(3, 'auto clásico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pass` text COLLATE utf8_spanish_ci,
  `telefono` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'alan', 'medina', 'alanmedina437@gmail.com', '9ee13a66f523e158a1c3f33e5b807f32', 'asdasdasd', '2019-01-30 03:15:34', '2019-01-27 23:33:46'),
(2, 'test', 'test', 'aaaalanmedina437@gmail.com', '9ee13a66f523e158a1c3f33e5b807f32', 'asdasdasd', '2019-01-30 03:54:10', '2019-01-30 03:54:10'),
(3, 'edo', 'edo', 'edo21', '9ee13a66f523e158a1c3f33e5b807f32', '6692505961', '2019-01-30 03:54:18', '2019-01-30 03:54:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_marca` int(10) UNSIGNED NOT NULL,
  `id_modelo` int(10) UNSIGNED NOT NULL,
  `id_tipo_vehiculo` int(11) NOT NULL,
  `year` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `kilometraje` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estilo_carroceria` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `transmision` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_manejo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_combustible` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `color` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `vestiduras` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `equipamento` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `id_marca`, `id_modelo`, `id_tipo_vehiculo`, `year`, `kilometraje`, `estilo_carroceria`, `transmision`, `tipo_manejo`, `tipo_combustible`, `color`, `vestiduras`, `equipamento`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2018', '1000', 'compacto', 'manual', 'tracción trasera', 'gasolina', 'rojo', 'piel', 'ABS', '2019-01-27 06:00:00', '2019-01-27 06:00:00'),
(2, 1, 1, 1, '2017', '2300', 'compacto', 'manual', 'tracción trasera', 'gasolina', 'rojo', 'piel', 'ABS', '2019-01-27 06:00:00', '2019-01-27 06:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agencias`
--
ALTER TABLE `agencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_anuncio` (`id_tipo_anuncio`),
  ADD KEY `id_vehiculo` (`id_vehiculo`),
  ADD KEY `id_vendedor` (`id_vendedor`),
  ADD KEY `id_agencia` (`id_agencia`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen_anuncio`
--
ALTER TABLE `imagen_anuncio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anuncio` (`id_anuncio`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modelos_marca_id_index` (`marca_id`);

--
-- Indices de la tabla `tipo_anuncio`
--
ALTER TABLE `tipo_anuncio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_vehiculo`
--
ALTER TABLE `tipo_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_tipo_vehiculo` (`id_tipo_vehiculo`),
  ADD KEY `id_modelo` (`id_modelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agencias`
--
ALTER TABLE `agencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `imagen_anuncio`
--
ALTER TABLE `imagen_anuncio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT de la tabla `tipo_anuncio`
--
ALTER TABLE `tipo_anuncio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_vehiculo`
--
ALTER TABLE `tipo_vehiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`id_tipo_anuncio`) REFERENCES `tipo_anuncio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`id_agencia`) REFERENCES `agencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anuncios_ibfk_3` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `anuncios_ibfk_4` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen_anuncio`
--
ALTER TABLE `imagen_anuncio`
  ADD CONSTRAINT `imagen_anuncio_ibfk_1` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_marca_id_foreign` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculos_ibfk_3` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
