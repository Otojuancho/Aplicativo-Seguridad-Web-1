-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-11-2021 a las 23:26:58
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parcial3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `Id` int(11) NOT NULL,
  `Destinatario` int(11) NOT NULL,
  `Mensaje` varchar(500) NOT NULL,
  `Remitente` int(11) NOT NULL,
  `Archivo` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Fecha_mensaje` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`Id`, `Destinatario`, `Mensaje`, `Remitente`, `Archivo`, `Fecha_mensaje`) VALUES
(1, 2, 'Hola Oscar', 1, '6a6b2e962e38db103a5a058b52a7ec87.jpg', '2021-11-11'),
(2, 1, 'Hola Juancho', 2, 'b53d2bccc89af17c84756fc58af47cf3.jpg', '2021-11-11'),
(3, 1, 'Hola Juancho', 4, '1b11baefabedbbe247e5d9ce816000a7.jpg', '2021-11-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `Id` int(11) NOT NULL,
  `Publicacion` varchar(500) NOT NULL,
  `Autor` int(11) NOT NULL,
  `Publico` tinyint(1) NOT NULL,
  `Fecha_publico` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`Id`, `Publicacion`, `Autor`, `Publico`, `Fecha_publico`) VALUES
(1, 'Mi primer articulo', 1, 1, '2021-11-11'),
(2, 'Mi segundo articulo', 1, 0, '2021-11-11'),
(3, 'Mi primer articulo', 2, 1, '2021-11-11'),
(4, 'Mi segundo articulo', 2, 0, NULL),
(5, 'Mi primer articulo', 4, 1, '2021-11-11'),
(6, 'Mi segundo articulo', 4, 0, '2021-11-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Num_Hijos` int(2) NOT NULL,
  `Estado_Civil` varchar(20) NOT NULL,
  `Foto` varchar(300) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Clave` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Nombres`, `Apellidos`, `Correo`, `Direccion`, `Num_Hijos`, `Estado_Civil`, `Foto`, `Usuario`, `Clave`) VALUES
(1, 'Juan Diego', 'Sotelo Romero', 'otojuancho@hotmail.com', 'Parque rio frio', 0, 'Comprometido', 'ed149bc337205f4fcd3f46bbe65540de.jpg', 'juancho', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Oscar Alejandro', 'Rodriguez Ardila', 'oscar123@hotmail.com', 'Cerca de piedra', 0, 'Comprometido', '9f2e9c4e4c7d4431463a6b751da84497.jpg', 'oscar', '202cb962ac59075b964b07152d234b70'),
(3, 'ZAP', 'Calle', 'zap@zap.com', 'Chia', 0, 'Soltero', '26695cf95223b42d5433d3298f9da3b8.jpg', 'ZAP', '903a98d709fa4683aaaa036b84c125a6'),
(4, 'Johan', 'Rodriguez Ardila', 'johan@ardila.com', 'Cerca de piedra', 0, 'Comprometido', '55c59ee5890aba241a0c45beac4977c7.jpg', 'johan', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Destinatario` (`Destinatario`),
  ADD KEY `Remitente` (`Remitente`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Autor` (`Autor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`Destinatario`) REFERENCES `usuarios` (`Id`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`Remitente`) REFERENCES `usuarios` (`Id`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`Autor`) REFERENCES `usuarios` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
