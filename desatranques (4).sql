-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2021 a las 03:26:34
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `desatranques`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `id_operario` varchar(45) NOT NULL,
  `nombre_contacto` varchar(45) NOT NULL,
  `apellidos_contacto` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `poblacion` varchar(45) NOT NULL,
  `codigo_postal` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fecha_creacion` varchar(45) NOT NULL,
  `fecha_realizacion` varchar(45) NOT NULL,
  `anotaciones_ANT` varchar(45) NOT NULL,
  `anotaciones_POST` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `id_operario`, `nombre_contacto`, `apellidos_contacto`, `telefono`, `descripcion`, `email`, `direccion`, `poblacion`, `codigo_postal`, `provincia`, `estado`, `fecha_creacion`, `fecha_realizacion`, `anotaciones_ANT`, `anotaciones_POST`) VALUES
(1, '4', 'loli', 'nunez', '123456789', 'desatranque oficina numero 3', 'lola@email.com', 'calle puebla 45', 'andujar', '12345', 'Jaen', 'Cancelada', '2020-11-27 09:18:42', '-', '-', 'destranqwue leve'),
(10, '00012', 'david', 'reyes', '6755555', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'P', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(12, '00014', 'gustavo', 'diaz', '6215555', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'P', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(13, '00015', 'fran', 'lopez', '6522225555', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'P', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(14, '4', 'pedro', 'sanchez', '356846784', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'Realizada', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(15, '00017', 'pablo', 'motos', '2456345', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'P', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(16, '00018', 'pablo', 'casado', '34563546', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'P', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(17, '00019', 'rodrigo', 'barcenas', '2456356', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'P', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(18, '00020', 'felipe', 'reyes', '456745674', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'P', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(19, '00021', 'pau', 'gasoñ', '456745674', 'descripcion', 'email@email', 'direccion', 'poblacion', 'codigopostal', 'provincia', 'P', 'fecha1', 'fecha2', 'anotaciones1', 'anotaciones2'),
(20, '4', 'pepe', 'lopez', '622123', 'la prueba definitva', 'email@mail.es', 'direccion de siempre', 'almonte', '21730', 'Granada', 'Realizada', '1/12/2020', '- - -', 'ninguna', '- - -'),
(21, '3000', 'marilo', 'vvvvv', '55555', 'ggggg', 'borjalb98@gmail.com', 'rrrr', 'rrrrr', '21730', 'Cadiz', 'Pendiente', '4/1/2021', '- - -', 'ffffff', '- - -');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id_trabajador` int(11) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id_trabajador`, `pass`, `nombre`, `apellidos`, `rol`) VALUES
(1, '1000', 'manuel', 'morales', 'administrador'),
(3, '3000', 'lucia', 'rufian', 'administrador'),
(4, '1234', 'maria', 'iglesias', 'operario'),
(5, '6000', 'rodrigo', 'rovira', 'operario'),
(6, '2000', 'leticia', 'luciano', 'administrador'),
(7, '2', 'sebas', 'ordo', 'administrador'),
(8, '4000', 'maria', 'rato', 'administrador'),
(9, '1000', 'manuel', 'loren', 'administrador'),
(10, '1000', 'manuel', 'morales', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id_trabajador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
