-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2019 a las 23:42:15
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `id_tipo_anuncio` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `id_agencia` int(11) DEFAULT NULL,
  `tipo_usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `precio` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `condicion_vehiculo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `propietarios` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `estado_anuncio` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `anuncio_pagado` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `precio_anuncio_pagado` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `metodo_pago` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

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
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`id_tipo_anuncio`) REFERENCES `tipo_anuncio` (`id`),
  ADD CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`id_tipo_anuncio`) REFERENCES `tipo_anuncio` (`id`),
  ADD CONSTRAINT `anuncios_ibfk_3` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`),
  ADD CONSTRAINT `anuncios_ibfk_4` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `anuncios_ibfk_5` FOREIGN KEY (`id_agencia`) REFERENCES `agencias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
