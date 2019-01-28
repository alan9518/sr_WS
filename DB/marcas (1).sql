-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2019 a las 23:41:50
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
