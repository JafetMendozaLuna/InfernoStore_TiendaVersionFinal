-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2025 a las 13:40:50
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
-- Base de datos: `comentarios_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `aprobado` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pendiente, 1=aprobado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `usuario_id`, `comentario`, `fecha`, `aprobado`) VALUES
(1, 6, 'hola', '2025-05-12 01:19:26', 1),
(2, 6, 'nose', '2025-05-12 01:20:05', 0),
(3, 6, 'venden pura mierda\r\n;D', '2025-05-12 01:23:19', 1),
(4, 8, 'esta vara', '2025-05-12 01:28:35', 1),
(5, 5, 'hola ya tiene estilo', '2025-05-13 02:38:09', 1),
(6, 5, 'no se', '2025-05-13 02:38:24', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
