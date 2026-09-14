-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2026 a las 23:28:55
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
-- Base de datos: `que_leo_hoy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `usuario_id`, `titulo`, `categoria`, `ciudad`, `descripcion`, `imagen`, `fecha_publicacion`) VALUES
(1, 1, 'El jilguero', 'Romance', 'Jaén', 'Me encato pero lo tengo repetido ', 'img/1778527105_Captura de pantalla 2026-05-09 181316.jpg', '2026-05-11 19:18:25'),
(2, 1, '1984', 'Ciencia ficción', 'Jaén', 'No me gusto', 'img/1778527224_1984.jpg', '2026-05-11 19:20:24'),
(3, 1, 'Anatomia de un instante', 'Historia', 'Jaén', 'No me gusto', 'img/1778527253_anatomia_de_un_instante.jpg', '2026-05-11 19:20:53'),
(4, 1, 'Enigmas de la iglesia', 'Misterio', 'Jaén', 'No me gusto', 'img/1778527297_Captura de pantalla 2026-05-09 182543.jpg', '2026-05-11 19:21:37'),
(5, 1, 'La tregua', 'Romance', 'Jaén', 'No me gusto', 'img/1778527452_Captura de pantalla 2026-05-09 192339.jpg', '2026-05-11 19:24:12'),
(6, 1, 'El corazon de las tinieblas ', 'Filosofia', 'Jaén', 'Se me hizo muy dificil ', 'img/1778527488_Captura de pantalla 2026-05-09 192410.jpg', '2026-05-11 19:24:48'),
(7, 1, 'Un verdor terrible ', 'Ensayo', 'Jaén', 'Se me hizo muy dificil ', 'img/1778527514_Captura de pantalla 2026-05-09 194352.jpg', '2026-05-11 19:25:14'),
(8, 1, 'El quijote', 'Novela', 'Jaén', 'Muy largo para mi ', 'img/1778527542_Captura de pantalla 2026-05-09 194422.jpg', '2026-05-11 19:25:42'),
(9, 1, 'El perfume ', 'Misterio', 'Jaén', 'Me encanto , pero lo tengo repetido ', 'img/1778527585_Captura de pantalla 2026-05-09 194511.jpg', '2026-05-11 19:26:25'),
(10, 1, 'SPQR', 'Ensayo', 'Jaén', 'Demasiado tecnico para mi ', 'img/1778527626_Captura de pantalla 2026-05-09 194557.jpg', '2026-05-11 19:27:06'),
(11, 2, 'La sombra del viento', 'Romance', 'Madrid', 'Me encanto pero ya tengo otra edicion  ', 'img/1778527826_Captura de pantalla 2026-05-09 194656.jpg', '2026-05-11 19:30:26'),
(12, 2, 'El ocho', 'Misterio', 'Madrid', 'Me encanto pero ya tengo otra edicion  ', 'img/1778527848_Captura de pantalla 2026-05-09 194726.jpg', '2026-05-11 19:30:48'),
(13, 2, 'El reino ', 'Ensayo', 'Madrid', 'Se me hizo muy dificil ', 'img/1778527875_Captura de pantalla 2026-05-09 194808.jpg', '2026-05-11 19:31:15'),
(14, 2, 'Trainspotting', 'Fantasía', 'Madrid', 'Me esperaba mas ', 'img/1778527896_Captura de pantalla 2026-05-09 194840.jpg', '2026-05-11 19:31:36'),
(15, 2, 'El extranjero ', 'Filosofia', 'Madrid', 'No lo entendi ', 'img/1778527930_Captura de pantalla 2026-05-09 194908.jpg', '2026-05-11 19:32:10'),
(16, 2, 'El mito de sisifo ', 'Ensayo', 'Madrid', 'No lo entendi ', 'img/1778528019_Captura de pantalla 2026-05-09 194947.jpg', '2026-05-11 19:33:39'),
(17, 2, 'Stonner', 'Romance', 'Madrid', 'Me encanto , pero ya tengo otra version ', 'img/1778528058_Captura de pantalla 2026-05-10 202752.jpg', '2026-05-11 19:34:18'),
(18, 2, 'Ensayo sobre la ceguera', 'Ensayo', 'Madrid', 'Se me hizo muy dificil ', 'img/1778528098_ceguera.jpg', '2026-05-11 19:34:58'),
(19, 2, 'El desierto de los tartaros', 'Filosofia', 'Madrid', 'Muy dificil para mi', 'img/1778528142_el desierto.jpg', '2026-05-11 19:35:42'),
(20, 2, 'El juego del angel ', 'Romance', 'Madrid', 'Me esperaba mas ', 'img/1778528188_el juego.jpg', '2026-05-11 19:36:28'),
(21, 3, 'El secreto ', 'Misterio', 'Málaga', 'Me encanto , pero no tengo espacio', 'img/1778528296_el secreto.jpg', '2026-05-11 19:38:16'),
(22, 3, 'El nombre de la rosa ', 'Misterio', 'Málaga', 'Me esperaba mas', 'img/1778528321_el_nomn.jpg', '2026-05-11 19:38:41'),
(23, 3, 'El retrato de dorian Grey', 'Novela', 'Málaga', 'Me encanto ', 'img/1778528349_el_retrato.jpg', '2026-05-11 19:39:09'),
(24, 3, 'El gran Gatsby', 'Novela', 'Málaga', 'M esperaba mas ', 'img/1778528380_gran_gastsby.jpg', '2026-05-11 19:39:40'),
(25, 3, 'Hamnet', 'Historia', 'Málaga', 'No es para mi ', 'img/1778528412_hammnet.jpg', '2026-05-11 19:40:12'),
(26, 3, 'Hojas de hierba', 'Poesia', 'Málaga', 'No lo entendi ', 'img/1778528433_hojas de hierba.jpg', '2026-05-11 19:40:33'),
(27, 3, 'Intermezzo', 'Romance', 'Málaga', 'Me encanto ', 'img/1778528460_Inter.jpg', '2026-05-11 19:41:00'),
(28, 3, 'La muerte del comendador', 'Fantasía', 'Málaga', 'Me encanto ', 'img/1778528531_la muerte.jpg', '2026-05-11 19:42:11'),
(29, 3, 'La verdad sobre el caso Harry Quebert', 'Misterio', 'Málaga', 'No me pareció para tanto ', 'img/1778528611_la verdad.jpg', '2026-05-11 19:43:31'),
(31, 4, 'Los asesinos del emperador ', 'Historia', 'Valladolid', 'No me gusto mucho ', 'img/1778528733_los asesinos del emperador.jpg', '2026-05-11 19:45:33'),
(32, 4, 'Los dectectives salvajes ', 'Novela', 'Valladolid', 'Me encanto ', 'img/1778528757_Los dectectives salvajes.jpg', '2026-05-11 19:45:57'),
(33, 4, 'Los hermanos Karamazov', 'Filosofia', 'Valladolid', 'Fue demasiado para mi ', 'img/1778528783_Los hermanos Kar.jpg', '2026-05-11 19:46:23'),
(34, 4, 'Meridiano de sangre ', 'Novela', 'Valladolid', 'No es mi estilo ', 'img/1778528847_Meridiano.jpg', '2026-05-11 19:47:27'),
(35, 4, 'Oppenhaimer', 'Historia', 'Valladolid', 'Muy largo ', 'img/1778528874_oppie.jpg', '2026-05-11 19:47:54'),
(36, 4, 'Poeta chileno ', 'Romance', 'Valladolid', 'Lo cambio por cualquiera del mismo autor', 'img/1778528913_poeta.jpg', '2026-05-11 19:48:33'),
(37, 4, 'Stonner', 'Romance', 'Valladolid', 'Lo cambio por cualquiera del mismo autor', 'img/1778528931_stonner.jpg', '2026-05-11 19:48:51'),
(38, 4, 'Un juego de niños', 'Fantasía', 'Valladolid', 'Lo cambio por cualquiera del mismo autor', 'img/1778528949_un juego.jpg', '2026-05-11 19:49:09'),
(39, 4, 'Walden ', 'Filosofia', 'Valladolid', 'Lo cambio por cualquiera del mismo autor', 'img/1778528971_walden.jpg', '2026-05-11 19:49:31'),
(40, 4, 'Z la ciudad perdida', 'Novela', 'Valladolid', 'Lo cambio por cualquiera del mismo autor', 'img/1778528998_z.jpg', '2026-05-11 19:49:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `emisor_id` int(11) NOT NULL,
  `receptor_id` int(11) NOT NULL,
  `libro_id` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `leido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `emisor_id`, `receptor_id`, `libro_id`, `mensaje`, `fecha`, `leido`) VALUES
(1, 1, 4, 32, 'Me interesa mucho tu libro', '2026-05-11 19:51:16', 1),
(2, 4, 1, 32, 'Vale , que libro me ofreces', '2026-05-11 19:51:52', 1),
(3, 4, 1, 32, 'Vale , que libro me ofreces', '2026-05-11 19:51:56', 1),
(4, 1, 4, 32, 'Anatomia de un instante', '2026-05-11 19:53:07', 1),
(5, 1, 4, 32, 'que te parece', '2026-05-11 19:54:08', 1),
(6, 1, 4, 32, 'Perfecto', '2026-05-11 19:59:44', 1),
(7, 1, 4, 32, 'Mañana', '2026-05-11 19:59:51', 1),
(8, 4, 1, 32, 'okey', '2026-05-11 20:00:51', 1),
(9, 4, 3, NULL, 'me gusta', '2026-05-11 20:01:07', 1),
(10, 3, 4, NULL, 'si', '2026-05-11 20:01:22', 0),
(11, 3, 4, NULL, 'si', '2026-05-11 20:37:05', 0),
(12, 3, 4, NULL, 'Mañana', '2026-05-11 20:43:54', 0),
(14, 3, 4, NULL, 'H', '2026-05-11 20:55:31', 0),
(15, 3, 4, NULL, 'porfa', '2026-05-11 21:06:21', 0),
(16, 3, 4, NULL, 'Mañana', '2026-05-11 21:06:49', 0),
(17, 3, 4, NULL, 'Mañana', '2026-05-11 21:07:32', 0),
(18, 3, 4, NULL, 'perfecto', '2026-05-11 21:07:44', 0),
(19, 3, 4, NULL, 'Okey', '2026-05-11 21:11:25', 0),
(20, 3, 4, 39, 'y este', '2026-05-11 21:11:43', 0),
(21, 1, 4, 32, 'Mañana', '2026-05-12 18:30:43', 1),
(22, 3, 4, 39, 'perfecto', '2026-05-12 19:04:07', 0),
(23, 3, 4, 36, 'Me interesa mucho', '2026-05-12 19:04:32', 1),
(24, 4, 3, 27, 'Lo tienes disponible', '2026-05-12 20:48:33', 0),
(25, 4, 3, 24, 'Me interesa', '2026-05-12 20:52:06', 1),
(26, 4, 3, 24, 'Hola', '2026-05-12 20:52:20', 1),
(27, 3, 4, 24, 'Mañana', '2026-05-12 21:20:38', 1),
(28, 1, 4, 32, 'perfecto', '2026-05-12 21:21:14', 1),
(29, 4, 3, 26, 'Me interesa', '2026-05-12 21:21:59', 1),
(30, 3, 2, 20, 'Me interesa', '2026-05-12 21:22:40', 1),
(31, 2, 3, 20, 'Hola', '2026-05-12 21:23:08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `verificado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `ciudad`, `pais`, `fecha_registro`, `token`, `verificado`) VALUES
(1, 'Ismael', 'zafra4.00@gmail.com', '$2y$10$XUP5s0VEjJ89u8wUJlvVH.YWq.cFBBWMFgYMdYLVV5e3WK0P/FrBK', 'Jaén', 'España', '2026-05-11 19:14:18', NULL, 1),
(2, 'David', 'davidzafracordoba@and.safanet.es', '$2y$10$BBZr/GKp3UJ6ikq3TN3H9.3Dp5.ZraHw9oaEjNy9blIwCgn.Vp0U6', 'Madrid', 'España', '2026-05-11 19:28:52', NULL, 1),
(3, 'Manolo', 'zafradelarosa@gmail.com', '$2y$10$e.ieNNWu6wY1E2te0rWWI.xh/GL1UVo0i5ulVPypvkCBIYgmg9iAy', 'Málaga', 'España', '2026-05-11 19:37:18', NULL, 1),
(4, 'Alvaro', 'davidzafra3d@gmail.com', '$2y$10$DuWfNtF4yPi7RCdLfwMrgeyLBrIvaVMmOIugwTm.8ivFpsWKyfCqm', 'Valladolid', 'España', '2026-05-11 19:44:32', NULL, 1),
(5, 'Jesus', 'david.siarjona@gmail.com', '$2y$10$4sKF4QQICOMYaUNzkDJjDekwBegFisV7aYilX7dBSN6MiVdDHAIPq', 'Asturias', 'España', '2026-05-12 21:17:42', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emisor_id` (`emisor_id`),
  ADD KEY `receptor_id` (`receptor_id`),
  ADD KEY `libro_id` (`libro_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`emisor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`receptor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_3` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
