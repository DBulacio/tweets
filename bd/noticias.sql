-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-11-2022 a las 02:38:50
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
-- Base de datos: `noticias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlace`
--

DROP TABLE IF EXISTS `enlace`;
CREATE TABLE IF NOT EXISTS `enlace` (
  `enlaceID` int(11) NOT NULL AUTO_INCREMENT,
  `publicacionID` int(11) NOT NULL,
  `enlace` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`enlaceID`),
  KEY `publicacionID` (`publicacionID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `enlace`
--

INSERT INTO `enlace` (`enlaceID`, `publicacionID`, `enlace`) VALUES
(1, 1, 'https://SteticNews.com'),
(2, 1, 'https://NewDaily.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
CREATE TABLE IF NOT EXISTS `etiquetas` (
  `etiquetaID` int(11) NOT NULL AUTO_INCREMENT,
  `etiqueta` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`etiquetaID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`etiquetaID`, `etiqueta`) VALUES
(1, 'Lanzamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
CREATE TABLE IF NOT EXISTS `publicacion` (
  `publicacionID` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `hora` datetime NOT NULL,
  `empresa` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `website` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`publicacionID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`publicacionID`, `contenido`, `categoria`, `hora`, `empresa`, `website`) VALUES
(1, 'Nueva adquisicion: SteticABC acaba de anunciar un acuerdo para comprar SteticDEF con el objetivo de aumentar su presencia en el mercado aleman. El acuerdo se estima en alrededor de 2 millones de euros. Lea mas en SteticNews o NewsDaily', 'Lanzamiento de productos', '2022-11-21 20:16:02', '', '');

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
(1, 177);

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
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

DROP TABLE IF EXISTS `regiones`;
CREATE TABLE IF NOT EXISTS `regiones` (
  `regionID` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`regionID`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`regionID`, `region`) VALUES
(1, 'Afganistán'),
(2, 'Islas Gland'),
(3, 'Albania'),
(4, 'Alemania'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antártida'),
(9, 'Antigua y Barbuda'),
(10, 'Antillas Holandesas'),
(11, 'Arabia Saudí'),
(12, 'Argelia'),
(13, 'Argentina'),
(14, 'Armenia'),
(15, 'Aruba'),
(16, 'Australia'),
(17, 'Austria'),
(18, 'Azerbaiyán'),
(19, 'Bahamas'),
(20, 'Bahréin'),
(21, 'Bangladesh'),
(22, 'Barbados'),
(23, 'Bielorrusia'),
(24, 'Bélgica'),
(25, 'Belice'),
(26, 'Benin'),
(27, 'Bermudas'),
(28, 'Bhután'),
(29, 'Bolivia'),
(30, 'Bosnia y Herzegovina'),
(31, 'Botsuana'),
(32, 'Isla Bouvet'),
(33, 'Brasil'),
(34, 'Brunéi'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cabo Verde'),
(39, 'Islas Caimán'),
(40, 'Camboya'),
(41, 'Camerún'),
(42, 'Canadá'),
(43, 'República Centroafricana'),
(44, 'Chad'),
(45, 'República Checa'),
(46, 'Chile'),
(47, 'China'),
(48, 'Chipre'),
(49, 'Isla de Navidad'),
(50, 'Ciudad del Vaticano'),
(51, 'Islas Cocos'),
(52, 'Colombia'),
(53, 'Comoras'),
(54, 'República Democrática del Congo'),
(55, 'Congo'),
(56, 'Islas Cook'),
(57, 'Corea del Norte'),
(58, 'Corea del Sur'),
(59, 'Costa de Marfil'),
(60, 'Costa Rica'),
(61, 'Croacia'),
(62, 'Cuba'),
(63, 'Dinamarca'),
(64, 'Dominica'),
(65, 'República Dominicana'),
(66, 'Ecuador'),
(67, 'Egipto'),
(68, 'El Salvador'),
(69, 'Emiratos Árabes Unidos'),
(70, 'Eritrea'),
(71, 'Eslovaquia'),
(72, 'Eslovenia'),
(73, 'España'),
(74, 'Islas ultramarinas de Estados Unidos'),
(75, 'Estados Unidos'),
(76, 'Estonia'),
(77, 'Etiopía'),
(78, 'Islas Feroe'),
(79, 'Filipinas'),
(80, 'Finlandia'),
(81, 'Fiyi'),
(82, 'Francia'),
(83, 'Gabón'),
(84, 'Gambia'),
(85, 'Georgia'),
(86, 'Islas Georgias del Sur y Sandwich del Sur'),
(87, 'Ghana'),
(88, 'Gibraltar'),
(89, 'Granada'),
(90, 'Grecia'),
(91, 'Groenlandia'),
(92, 'Guadalupe'),
(93, 'Guam'),
(94, 'Guatemala'),
(95, 'Guayana Francesa'),
(96, 'Guinea'),
(97, 'Guinea Ecuatorial'),
(98, 'Guinea-Bissau'),
(99, 'Guyana'),
(100, 'Haití'),
(101, 'Islas Heard y McDonald'),
(102, 'Honduras'),
(103, 'Hong Kong'),
(104, 'Hungría'),
(105, 'India'),
(106, 'Indonesia'),
(107, 'Irán'),
(108, 'Iraq'),
(109, 'Irlanda'),
(110, 'Islandia'),
(111, 'Israel'),
(112, 'Italia'),
(113, 'Jamaica'),
(114, 'Japón'),
(115, 'Jordania'),
(116, 'Kazajstán'),
(117, 'Kenia'),
(118, 'Kirguistán'),
(119, 'Kiribati'),
(120, 'Kuwait'),
(121, 'Laos'),
(122, 'Lesotho'),
(123, 'Letonia'),
(124, 'Líbano'),
(125, 'Liberia'),
(126, 'Libia'),
(127, 'Liechtenstein'),
(128, 'Lituania'),
(129, 'Luxemburgo'),
(130, 'Macao'),
(131, 'ARY Macedonia'),
(132, 'Madagascar'),
(133, 'Malasia'),
(134, 'Malawi'),
(135, 'Maldivas'),
(136, 'Malí'),
(137, 'Malta'),
(138, 'Islas Malvinas'),
(139, 'Islas Marianas del Norte'),
(140, 'Marruecos'),
(141, 'Islas Marshall'),
(142, 'Martinica'),
(143, 'Mauricio'),
(144, 'Mauritania'),
(145, 'Mayotte'),
(146, 'México'),
(147, 'Micronesia'),
(148, 'Moldavia'),
(149, 'Mónaco'),
(150, 'Mongolia'),
(151, 'Montserrat'),
(152, 'Mozambique'),
(153, 'Myanmar'),
(154, 'Namibia'),
(155, 'Nauru'),
(156, 'Nepal'),
(157, 'Nicaragua'),
(158, 'Níger'),
(159, 'Nigeria'),
(160, 'Niue'),
(161, 'Isla Norfolk'),
(162, 'Noruega'),
(163, 'Nueva Caledonia'),
(164, 'Nueva Zelanda'),
(165, 'Omán'),
(166, 'Países Bajos'),
(167, 'Pakistán'),
(168, 'Palau'),
(169, 'Palestina'),
(170, 'Panamá'),
(171, 'Papúa Nueva Guinea'),
(172, 'Paraguay'),
(173, 'Perú'),
(174, 'Islas Pitcairn'),
(175, 'Polinesia Francesa'),
(176, 'Polonia'),
(177, 'Portugal'),
(178, 'Puerto Rico'),
(179, 'Qatar'),
(180, 'Reino Unido'),
(181, 'Reunión'),
(182, 'Ruanda'),
(183, 'Rumania'),
(184, 'Rusia'),
(185, 'Sahara Occidental'),
(186, 'Islas Salomón'),
(187, 'Samoa'),
(188, 'Samoa Americana'),
(189, 'San Cristóbal y Nevis'),
(190, 'San Marino'),
(191, 'San Pedro y Miquelón'),
(192, 'San Vicente y las Granadinas'),
(193, 'Santa Helena'),
(194, 'Santa Lucía'),
(195, 'Santo Tomé y Príncipe'),
(196, 'Senegal'),
(197, 'Serbia y Montenegro'),
(198, 'Seychelles'),
(199, 'Sierra Leona'),
(200, 'Singapur'),
(201, 'Siria'),
(202, 'Somalia'),
(203, 'Sri Lanka'),
(204, 'Suazilandia'),
(205, 'Sudáfrica'),
(206, 'Sudán'),
(207, 'Suecia'),
(208, 'Suiza'),
(209, 'Surinam'),
(210, 'Svalbard y Jan Mayen'),
(211, 'Tailandia'),
(212, 'Taiwán'),
(213, 'Tanzania'),
(214, 'Tayikistán'),
(215, 'Territorio Británico del Océano Índico'),
(216, 'Territorios Australes Franceses'),
(217, 'Timor Oriental'),
(218, 'Togo'),
(219, 'Tokelau'),
(220, 'Tonga'),
(221, 'Trinidad y Tobago'),
(222, 'Túnez'),
(223, 'Islas Turcas y Caicos'),
(224, 'Turkmenistán'),
(225, 'Turquía'),
(226, 'Tuvalu'),
(227, 'Ucrania'),
(228, 'Uganda'),
(229, 'Uruguay'),
(230, 'Uzbekistán'),
(231, 'Vanuatu'),
(232, 'Venezuela'),
(233, 'Vietnam'),
(234, 'Islas Vírgenes Británicas'),
(235, 'Islas Vírgenes de los Estados Unidos'),
(236, 'Wallis y Futuna'),
(237, 'Yemen'),
(238, 'Yibuti'),
(239, 'Zambia'),
(240, 'Zimbabue');

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
