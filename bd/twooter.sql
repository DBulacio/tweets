-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-11-2022 a las 23:34:54
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `twooter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlace`
--

DROP TABLE IF EXISTS `enlace`;
CREATE TABLE IF NOT EXISTS `enlace` (
  `enlaceID` int(11) NOT NULL AUTO_INCREMENT,
  `publicacionID` int(11) NOT NULL,
  `enlace` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`enlaceID`),
  KEY `publicacionID` (`publicacionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
CREATE TABLE IF NOT EXISTS `etiquetas` (
  `etiquetaID` int(11) NOT NULL AUTO_INCREMENT,
  `etiqueta` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`etiquetaID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`etiquetaID`, `etiqueta`) VALUES
(1, 'Lanueba'),
(2, 'Producto'),
(3, 'Tags'),
(4, 'Lags'),
(5, 'Frags'),
(6, 'Prags');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
CREATE TABLE IF NOT EXISTS `publicacion` (
  `publicacionID` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `hora` date NOT NULL,
  PRIMARY KEY (`publicacionID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`publicacionID`, `contenido`, `categoria`, `hora`) VALUES
(4, 'asdasd', 'sdadsa', '2022-11-18'),
(5, 'Otro tweet de prueba', 'prueba', '2022-11-18'),
(6, 'Tweet de prueba 2', 'prueba', '2022-11-18'),
(7, 'prueba 3ags', 'prueba', '2022-11-18'),
(8, ' 5', 'lala', '2022-11-18'),
(9, 'Test de tags', 'Tags', '2022-11-18'),
(10, 'Test tags 2', 'Tags', '2022-11-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publi_region`
--

DROP TABLE IF EXISTS `publi_region`;
CREATE TABLE IF NOT EXISTS `publi_region` (
  `publicacionID` int(11) NOT NULL,
  `regionID` int(11) NOT NULL,
  KEY `regionID` (`regionID`),
  KEY `publicacionID` (`publicacionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publi_region`
--

INSERT INTO `publi_region` (`publicacionID`, `regionID`) VALUES
(4, 3),
(8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publi_tags`
--

DROP TABLE IF EXISTS `publi_tags`;
CREATE TABLE IF NOT EXISTS `publi_tags` (
  `publicacionID` int(11) NOT NULL,
  `etiquetaID` int(11) NOT NULL,
  KEY `etiquetaID` (`etiquetaID`),
  KEY `publicacionID` (`publicacionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publi_tags`
--

INSERT INTO `publi_tags` (`publicacionID`, `etiquetaID`) VALUES
(6, 1),
(7, 2),
(8, 1),
(9, 3),
(9, 4),
(9, 5),
(10, 3),
(10, 4),
(10, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

DROP TABLE IF EXISTS `regiones`;
CREATE TABLE IF NOT EXISTS `regiones` (
  `regionID` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`regionID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`regionID`, `region`) VALUES
(1, 'Argentina'),
(2, 'Brasil'),
(3, 'Qatar'),
(4, 'Peru');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `enlace`
--
ALTER TABLE `enlace`
  ADD CONSTRAINT `enlace_ibfk_1` FOREIGN KEY (`publicacionID`) REFERENCES `publicacion` (`publicacionID`);

--
-- Filtros para la tabla `publi_region`
--
ALTER TABLE `publi_region`
  ADD CONSTRAINT `publi_region_ibfk_1` FOREIGN KEY (`publicacionID`) REFERENCES `publicacion` (`publicacionID`),
  ADD CONSTRAINT `publi_region_ibfk_2` FOREIGN KEY (`regionID`) REFERENCES `regiones` (`regionID`);

--
-- Filtros para la tabla `publi_tags`
--
ALTER TABLE `publi_tags`
  ADD CONSTRAINT `publi_tags_ibfk_1` FOREIGN KEY (`publicacionID`) REFERENCES `publicacion` (`publicacionID`),
  ADD CONSTRAINT `publi_tags_ibfk_2` FOREIGN KEY (`etiquetaID`) REFERENCES `etiquetas` (`etiquetaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
