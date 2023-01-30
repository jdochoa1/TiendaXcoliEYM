-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2015 a las 21:33:37
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `julian2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feria_detal`
--

CREATE TABLE IF NOT EXISTS `feria_detal` (
  `id` int(11) NOT NULL,
  `cons` int(11) NOT NULL,
  `cliente` varchar(180) NOT NULL,
  `nombreC` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipoPago` varchar(30) NOT NULL,
  `codigoP` varchar(100) NOT NULL,
  `nombreP` varchar(200) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `valorU` int(12) NOT NULL,
  `valorT` int(15) NOT NULL,
  `obsv` varchar(350) NOT NULL,
  `bod` varchar(5) NOT NULL,
  `head` varchar(150) NOT NULL,
  `foot` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `feria_detal`
--

INSERT INTO `feria_detal` (`id`, `cons`, `cliente`, `nombreC`, `fecha`, `tipoPago`, `codigoP`, `nombreP`, `cantidad`, `valorU`, `valorT`, `obsv`, `bod`, `head`, `foot`) VALUES
(1, 1, 'JHGJHG', 'JUJHGG', '2015-11-04 10:38:59', 'Efectivo', '7702080500038', 'GUAYO CONTINENTAL ALEMANIA  7  1/2', 1, 69757, 69757, '', 'TFG  ', '', ''),
(2, 2, '74380194', 'JULIAN CAMARGOVB', '2015-11-04 10:45:19', 'Tarjeta', '7702080500038', 'GUAYO CONTINENTAL ALEMANIA  7  1/2', 2, 69757, 139514, '', 'TFG  ', '', ''),
(3, 3, 'JHGJHGKJH', 'JHFDGLSHG', '2015-11-04 11:02:32', 'Efectivo', '7702080500137', 'GUAYO CONTINENTAL ALEMANIA  8', 1, 69757, 69757, '', 'TFG  ', '', ''),
(4, 4, 'CAMARGO', 'RICARDO', '2015-11-04 11:09:30', 'Tarjeta', '7702080500335', 'GUAYO CONTINENTAL ALEMANIA  9  1/2', 1, 69757, 69757, '', 'TFG  ', '', ''),
(5, 4, 'CAMARGO', 'RICARDO', '2015-11-04 11:09:30', 'Tarjeta', '7702080500434', 'GUAYO CONTINENTAL ALEMANIA  10', 3, 69757, 209271, '', 'TFG  ', '', ''),
(6, 5, 'CEDULA DEL CLIENTE', 'NOMBRE DEL CLIENTE', '2015-11-05 09:07:59', 'Tarjeta', '7702080500632', 'GUAYO CONTINENTAL ALEMANIA  11  1/2', 1, 69757, 69757, '', 'TFG  ', '', ''),
(7, 5, 'CEDULA DEL CLIENTE', 'NOMBRE DEL CLIENTE', '2015-11-05 09:07:59', 'Tarjeta', '7702080500939', 'GUAYO  CONTINENTAL SUECIA   9', 1, 69757, 69757, '', 'TFG  ', '', ''),
(8, 5, 'CEDULA DEL CLIENTE', 'NOMBRE DEL CLIENTE', '2015-11-05 09:07:59', 'Tarjeta', '7702080500533', 'GUAYO CONTINENTAL ALEMANIA  11', 1, 69757, 69757, '', 'TFG  ', '', ''),
(9, 6, 'CEDULA PABLO', 'PABLO MILANES', '2015-11-05 09:13:26', 'Efectivo', '7702080504111', 'GUAYO SNIPER HX OUTDOOR KIDS VER/NG #30 ', 3, 19769, 44480, '', 'TFG  ', '', ''),
(10, 7, 'ID', 'NAME', '2015-11-05 09:34:41', 'Tarjeta', '7702080510839', 'ZAPAT LISA CONTINENTAL BRASIL 9  1/2', 1, 71936, 64742, '', 'TFG  ', '', ''),
(11, 8, 'PCONS CED', 'P CONSN', '2015-11-05 09:46:54', 'Efectivo', '7702080508430', 'ZAPAT LISA CONTINENTAL ALEMANIA 7', 8, 71936, 575488, '', 'TFG  ', '', ''),
(12, 9, '74380194', 'julian camargo', '2015-11-05 10:07:03', 'Tarjeta', '7702080660817', 'MICROFUTBOL COMPETITION LAMINADO        ', 1, 22500, 2250, '', 'TFGV ', '', ''),
(13, 10, 'de la cosa', 'juan', '2015-11-05 10:50:06', 'Efectivo', '7702080504739', 'ZAPAT TORRETIN CONTINENTAL ALEMANIA 11', 3, 69757, 209271, '', 'TFG  ', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `feria_detal`
--
ALTER TABLE `feria_detal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `feria_detal`
--
ALTER TABLE `feria_detal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
