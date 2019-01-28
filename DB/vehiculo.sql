-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2019 a las 00:26:46
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
  `id` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `id_tipo_vehiculo` int(10) NOT NULL,
  `year` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `kilometraje` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estilo_carroceria` varchar(100) COLLATE utf8_spanish_ci  NULL,
  `transmision` varchar(100) COLLATE utf8_spanish_ci  NULL,
  `tipo_manejo` varchar(100) COLLATE utf8_spanish_ci  NULL,
  `tipo_combustible` varchar(100) COLLATE utf8_spanish_ci  NULL,
  `color` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `vestiduras` varchar(100) COLLATE utf8_spanish_ci  NULL,
  `equipamento` varchar(500) COLLATE utf8_spanish_ci  NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
  -- `NIV` int(11) NOT NULL,
  -- `ultimo_digito_placa` int(11) DEFAULT NULL,
  -- `potencia` int(11) NOT NULL

  

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

-- INSERT INTO `vehiculos` (`id`, `id_marca`, `id_modelo`, `tipo_vehidulo`, `year`, `kilometraje`, `estilo_carroceria`, `transmision`, `tipo_manejo`, `tipo_combustible`, `color`, `vestiduras`, `equipamento`, `condicion`, `NIV`, `ultimo_digito_placa`, `potencia`) VALUES
-- (1, 1, 1, 1, '2017', '100', 'compacto', 'atuomatico', 'traccion deltantera', 'gasolina', 'verde', 'piel', 'ABS || AC', 'usado', 2147483, 8, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vehiculos`
--
  ALTER TABLE vehiculos ADD PRIMARY KEY (`id`);
  ALTER TABLE vehiculos ADD FOREIGN KEY (id_marca) REFERENCES marcas(id);
  ALTER TABLE vehiculos ADD FOREIGN KEY (id_modelo) REFERENCES modelos(id);
  ALTER TABLE vehiculos ADD FOREIGN KEY (id_tipo_vehiculo) REFERENCES tipo_vehiculo(id);
      
--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
