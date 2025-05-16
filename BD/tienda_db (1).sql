-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2025 a las 13:43:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT 1,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `usuario_id`, `producto_id`, `cantidad`, `fecha_agregado`) VALUES
(31, 6, 38, 4, '2025-05-12 00:08:11'),
(35, 8, 38, 1, '2025-05-12 02:26:40'),
(36, 6, 23, 3, '2025-05-12 03:11:00'),
(37, 6, 37, 1, '2025-05-13 03:38:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `usuario_id`, `producto_id`, `fecha_agregado`) VALUES
(11, 8, 38, '2025-05-12 02:26:37'),
(13, 6, 37, '2025-05-12 03:34:30'),
(15, 6, 27, '2025-05-12 03:34:34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`producto_id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
