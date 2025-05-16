-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2025 a las 13:43:37
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
-- Base de datos: `usuarios_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` enum('cliente','empleado','admin') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `rol`) VALUES
(1, 'Sentry', '$2y$10$KjUtixepczq/bD/oSoJ.gerPZZ9QLSyAV18J9aqUiNT21nHxOIaQq', 'cliente'),
(2, 'Jafet', '123456', 'admin'),
(3, 'pepe', '7890', 'empleado'),
(4, 'pablo', '$2y$10$aC6vyr6Q1UcEJnvE1Eqames/BQJEpTTgYfOGNMc0hrM2QDiPoJoGy', 'cliente'),
(5, 'perico', '$2y$10$VOtW6remkx3AAF2sJHlFbu6SxkuwkvMQSyoUaKV8C38W4HF/Kr1wC', 'admin'),
(6, 'perez', '$2y$10$p8EIJjORyT/3ArmVYkNDteaPmGrWQ6P5zXX8t4hHYHm/VElUTDmOC', 'cliente'),
(7, 'juanito', '$2y$10$2as8x2Uy8XpnM/SFHSQw..aIgHDL1AKq/LynyTovg78IqoGT3EHEq', 'empleado'),
(8, 'meme', '$2y$10$YezyzKrF7koLr4QoV/wEKOC08K6KM4oLMsvi9Ngn6rk1sA0JxlD.6', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
