-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2021 a las 07:06:15
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ciindicadores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicadores`
--

CREATE TABLE `indicadores` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `id_unidad_medida` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `indicadores`
--

INSERT INTO `indicadores` (`id`, `codigo`, `nombre`, `id_unidad_medida`, `fecha`, `valor`) VALUES
(1, 'ETH', 'Etherium', 1, '2021-08-03 00:00:00', 2200),
(3, 'ETH', 'Etherium', 2, '2021-08-07 00:00:00', 7000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id`, `nombre`) VALUES
(1, 'Dólar'),
(2, 'Porcentaje'),
(3, 'Peso');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`,`fecha`),
  ADD KEY `id_unidad_medida` (`id_unidad_medida`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD CONSTRAINT `indicadores_ibfk_1` FOREIGN KEY (`id_unidad_medida`) REFERENCES `unidad_medida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
