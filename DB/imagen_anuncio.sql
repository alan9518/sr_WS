-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2019 a las 23:41:58
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
-- Estructura de tabla para la tabla `imagen_anuncio`
--

CREATE TABLE `imagen_anuncio` (
  `id` int(11) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `ruta_imagen` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagen_anuncio`
--
ALTER TABLE `imagen_anuncio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anuncio` (`id_anuncio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagen_anuncio`
--
ALTER TABLE `imagen_anuncio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen_anuncio`
--
ALTER TABLE `imagen_anuncio`
  ADD CONSTRAINT `imagen_anuncio_ibfk_1` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
