-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2019 a las 23:35:37
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
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL ,
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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`) ,
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_tipo_vehiculo` (`id_tipo_vehiculo`),
  ADD KEY `id_modelo` (`id_modelo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculos_ibfk_3` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `vehiculos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
