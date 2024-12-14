-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2024 a las 05:37:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventarioweb`
--
CREATE DATABASE IF NOT EXISTS `inventarioweb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `inventarioweb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo`
--

CREATE TABLE `activo` (
  `activo_id` int(11) NOT NULL,
  `activo_codigo` varchar(50) NOT NULL,
  `activo_marca` varchar(50) NOT NULL,
  `activo_modelo` varchar(50) NOT NULL,
  `activo_serial` varchar(50) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `piso_id` int(11) NOT NULL,
  `posicion_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `estadoactivo_id` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `activo`
--

INSERT INTO `activo` (`activo_id`, `activo_codigo`, `activo_marca`, `activo_modelo`, `activo_serial`, `categoria_id`, `piso_id`, `posicion_id`, `area_id`, `sector_id`, `estadoactivo_id`, `fecha_ingreso`) VALUES
(1, '11163', 'ViewSonic', 'VG2233Smh', 'TBX153431018', 2, 1, 1, 1, 1, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `area_id` int(11) NOT NULL,
  `area_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`area_id`, `area_nombre`) VALUES
(1, 'Soporte'),
(2, 'Finanzas'),
(3, 'Redes'),
(4, 'Servidores'),
(5, 'Telefonía'),
(6, 'Infraestructura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`) VALUES
(1, 'CPU'),
(2, 'Monitor'),
(3, 'Notebook'),
(4, 'Impresora'),
(5, 'Avaya'),
(6, 'Pizarra'),
(7, 'Tablet'),
(8, 'Webcam');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoactivo`
--

CREATE TABLE `estadoactivo` (
  `estadoactivo_id` int(11) NOT NULL,
  `estadoactivo_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `estadoactivo`
--

INSERT INTO `estadoactivo` (`estadoactivo_id`, `estadoactivo_nombre`) VALUES
(1, 'Activo'),
(2, 'Desuso'),
(3, 'Dañado'),
(4, 'En transito'),
(5, 'En servicio técnico'),
(6, 'En garantía'),
(7, 'Baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piso`
--

CREATE TABLE `piso` (
  `piso_id` int(11) NOT NULL,
  `piso_numero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `piso`
--

INSERT INTO `piso` (`piso_id`, `piso_numero`) VALUES
(1, '-1'),
(2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE `posicion` (
  `posicion_id` int(11) NOT NULL,
  `posicion_posicion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `posicion`
--

INSERT INTO `posicion` (`posicion_id`, `posicion_posicion`) VALUES
(1, 'N-A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'admin'),
(2, 'encargado_area'),
(3, 'finanzas'),
(4, 'gerente_finanzas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `sector_id` int(11) NOT NULL,
  `sector_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`sector_id`, `sector_nombre`) VALUES
(1, 'Bodega'),
(2, 'Guardias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudbaja`
--

CREATE TABLE `solicitudbaja` (
  `solicitud_id` int(11) NOT NULL,
  `solicitadornom` varchar(50) NOT NULL,
  `solicitadorape` varchar(50) NOT NULL,
  `activo_id` int(11) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `solicitud_codigo` varchar(50) NOT NULL,
  `aprobadornom` varchar(50) NOT NULL,
  `aprobadorape` varchar(50) NOT NULL,
  `solicitud_estado` enum('Aprobada','Pendiente','Rechazada') NOT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `motivo` varchar(255) NOT NULL,
  `documento` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(50) NOT NULL,
  `usuario_apellido` varchar(50) NOT NULL,
  `usuario_usuario` varchar(50) NOT NULL,
  `usuario_correo` varchar(50) NOT NULL,
  `usuario_clave` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `usuario_estado` enum('Habilitado','Deshabilitado','Baja') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_correo`, `usuario_clave`, `rol_id`, `area_id`, `usuario_estado`) VALUES
(4, 'José', 'Avendaño', 'avendano.5@nlsa.teleperformance.com', 'jose.avendano@teleperformance.com', '$2y$10$WX8h8UQrX2HTRKoT6xuR0ubPOQRalBeZzRoTKvlItMGHF1.oUIVdq', 3, 2, 'Habilitado'),
(5, 'Admin', 'istrador', 'administrador', '', '$2y$10$EqR0G5YIxgPd2hrcdLpdtu2CPBBX7sZLnRNBl6swfaJFLSluwukFq', 1, 1, 'Habilitado'),
(6, 'Cristobal', 'Curimil', 'curimil.10@nlsa.teleperformance.com', 'cristobal.curimil@teleperformance.cl', '$2y$10$rH9s4VAqw99WdmMWMbfC5uJNOww4Ddg1s0QpKzCwFj9wyhmjeNNre', 2, 1, 'Habilitado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activo`
--
ALTER TABLE `activo`
  ADD PRIMARY KEY (`activo_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `piso_id` (`piso_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `sector_id` (`sector_id`),
  ADD KEY `posicion_id` (`posicion_id`) USING BTREE,
  ADD KEY `estadoactivo_id` (`estadoactivo_id`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `estadoactivo`
--
ALTER TABLE `estadoactivo`
  ADD PRIMARY KEY (`estadoactivo_id`);

--
-- Indices de la tabla `piso`
--
ALTER TABLE `piso`
  ADD PRIMARY KEY (`piso_id`);

--
-- Indices de la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD PRIMARY KEY (`posicion_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indices de la tabla `solicitudbaja`
--
ALTER TABLE `solicitudbaja`
  ADD PRIMARY KEY (`solicitud_id`),
  ADD KEY `activo_id` (`activo_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `area_id_2` (`area_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activo`
--
ALTER TABLE `activo`
  MODIFY `activo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estadoactivo`
--
ALTER TABLE `estadoactivo`
  MODIFY `estadoactivo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `piso`
--
ALTER TABLE `piso`
  MODIFY `piso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `posicion`
--
ALTER TABLE `posicion`
  MODIFY `posicion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudbaja`
--
ALTER TABLE `solicitudbaja`
  MODIFY `solicitud_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activo`
--
ALTER TABLE `activo`
  ADD CONSTRAINT `activo_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `activo_ibfk_3` FOREIGN KEY (`posicion_id`) REFERENCES `posicion` (`posicion_id`),
  ADD CONSTRAINT `activo_ibfk_4` FOREIGN KEY (`piso_id`) REFERENCES `piso` (`piso_id`),
  ADD CONSTRAINT `activo_ibfk_5` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`sector_id`),
  ADD CONSTRAINT `activo_ibfk_6` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`),
  ADD CONSTRAINT `activo_ibfk_7` FOREIGN KEY (`estadoactivo_id`) REFERENCES `estadoactivo` (`estadoactivo_id`);

--
-- Filtros para la tabla `solicitudbaja`
--
ALTER TABLE `solicitudbaja`
  ADD CONSTRAINT `solicitudbaja_ibfk_1` FOREIGN KEY (`activo_id`) REFERENCES `activo` (`activo_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
