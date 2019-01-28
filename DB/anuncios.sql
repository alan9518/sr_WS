-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2019 a las 21:43:27
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

-- CREATE TABLE IF NOT EXISTS anuncios (
--     id INT AUTO_INCREMENT,
--     id_tipo_anuncio
--     title VARCHAR(255) NOT NULL,
--     start_date DATE,
--     due_date DATE,
--     status TINYINT NOT NULL,
--     priority TINYINT NOT NULL,
--     description TEXT,
--     PRIMARY KEY (id)
-- )  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE anuncios (
  id int(11) NOT NULL,
  
  id_tipo_anuncio int NOT NULL,
  
  id_vehiculo int NOT NULL,
  
  id_vendedor int NULL,
  
  id_agencia int  NULL,
  
  tipo_usuario VARCHAR(255)  NOT NULL,
  
  titulo VARCHAR(255)  NOT NULL,
  
  precio VARCHAR(255)  NOT NULL,
  
  fecha_creado datetime NOT NULL,
  
  condicion_vehiculo VARCHAR(255)   NOT NULL,
  
  ubicacion VARCHAR(255)   NOT NULL,
  
  propietarios VARCHAR(255)   NOT NULL,
  
  fecha_cierre datetime NOT NULL,
  
  estado_anuncio VARCHAR(255)  not null,
  
  anuncio_pagado VARCHAR(255)  not null,
  
  precio_anuncio_pagado VARCHAR(255)  not null,
  
  metodo_pago VARCHAR(255)  not null,
  
  created_at timestamp NULL DEFAULT NULL,
  
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

-- INSERT INTO `anuncios` (`id`, `id_tipo_anuncio`, `id_vendedor`, `titulo`, `precio`, `fecha_creado`, `condicion`, `ubicacion`, `fecha_cierre`, `id_vehiculo`) VALUES
-- (1, 1, 1, 'Mazda MDX', 100000, '2019-01-25 00:00:00', 'Gratuito', 'guadalajara', '2019-02-21 00:00:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
  ALTER TABLE `anuncios` ADD PRIMARY KEY (`id`);
  ALTER TABLE `anuncios` ADD FOREIGN KEY (`id_tipo_anuncio`) REFERENCES tipo_anuncio(`id`);
  ALTER TABLE `anuncios` ADD FOREIGN KEY (`id_vehiculo`) REFERENCES vehiculo(`id`);
  ALTER TABLE `anuncios` ADD FOREIGN KEY (`id_vendedor`) REFERENCES usuarios(`id`);
  ALTER TABLE `anuncios` ADD FOREIGN KEY (`id_agencia`) REFERENCES agencias(`id`);



--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
