-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2023 a las 18:56:11
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `polarisinventory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_jefe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `descripcion`, `id_jefe`) VALUES
(1, 'Sistemas', 10),
(2, 'Comercial', 15),
(3, 'RRHH', 6),
(4, 'Marketing', 19),
(5, 'Administración', 7),
(6, 'CEO', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrador', '1', 1572301636),
('Administrador', '2', 1571746769);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/admin/*', 2, NULL, NULL, NULL, 1572301903, 1572301903),
('/area/*', 2, NULL, NULL, NULL, 1572309788, 1572309788),
('/area/cargar-cargos', 2, NULL, NULL, NULL, 1572309936, 1572309936),
('/area/create', 2, NULL, NULL, NULL, 1572309936, 1572309936),
('/area/delete', 2, NULL, NULL, NULL, 1572309936, 1572309936),
('/area/index', 2, NULL, NULL, NULL, 1572309935, 1572309935),
('/area/update', 2, NULL, NULL, NULL, 1572309936, 1572309936),
('/area/view', 2, NULL, NULL, NULL, 1572309935, 1572309935),
('/cargo/*', 2, NULL, NULL, NULL, 1572309789, 1572309789),
('/cargo/create', 2, NULL, NULL, NULL, 1572309945, 1572309945),
('/cargo/delete', 2, NULL, NULL, NULL, 1572309945, 1572309945),
('/cargo/index', 2, NULL, NULL, NULL, 1572309944, 1572309944),
('/cargo/update', 2, NULL, NULL, NULL, 1572309945, 1572309945),
('/cargo/view', 2, NULL, NULL, NULL, 1572309945, 1572309945),
('/empleado-objetivo/*', 2, NULL, NULL, NULL, 1572309958, 1572309958),
('/empleado-objetivo/create', 2, NULL, NULL, NULL, 1572309958, 1572309958),
('/empleado-objetivo/index', 2, NULL, NULL, NULL, 1572309958, 1572309958),
('/empleado-objetivo/request', 2, NULL, NULL, NULL, 1572309958, 1572309958),
('/empleado/*', 2, NULL, NULL, NULL, 1572309789, 1572309789),
('/empleado/by-area', 2, NULL, NULL, NULL, 1572309910, 1572309910),
('/empleado/create', 2, NULL, NULL, NULL, 1572309957, 1572309957),
('/empleado/delete', 2, NULL, NULL, NULL, 1572309957, 1572309957),
('/empleado/index', 2, NULL, NULL, NULL, 1572309957, 1572309957),
('/empleado/update', 2, NULL, NULL, NULL, 1572309957, 1572309957),
('/empleado/view', 2, NULL, NULL, NULL, 1572309957, 1572309957),
('/evaluacion/*', 2, NULL, NULL, NULL, 1572309789, 1572309789),
('/evaluacion/create', 2, NULL, NULL, NULL, 1572309973, 1572309973),
('/evaluacion/delete', 2, NULL, NULL, NULL, 1572309973, 1572309973),
('/evaluacion/index', 2, NULL, NULL, NULL, 1572309973, 1572309973),
('/evaluacion/update', 2, NULL, NULL, NULL, 1572309973, 1572309973),
('/evaluacion/view', 2, NULL, NULL, NULL, 1572309973, 1572309973),
('/funciones/*', 2, NULL, NULL, NULL, 1572309789, 1572309789),
('/funciones/create', 2, NULL, NULL, NULL, 1572309985, 1572309985),
('/funciones/delete', 2, NULL, NULL, NULL, 1572309986, 1572309986),
('/funciones/index', 2, NULL, NULL, NULL, 1572309985, 1572309985),
('/funciones/update', 2, NULL, NULL, NULL, 1572309985, 1572309985),
('/funciones/view', 2, NULL, NULL, NULL, 1572309985, 1572309985),
('/nivel/*', 2, NULL, NULL, NULL, 1572309789, 1572309789),
('/objetivo/by-empleado', 2, NULL, NULL, NULL, 1572309789, 1572309789),
('/objetivo/create', 2, NULL, NULL, NULL, 1572310054, 1572310054),
('/objetivo/delete', 2, NULL, NULL, NULL, 1572310054, 1572310054),
('/objetivo/index', 2, NULL, NULL, NULL, 1572310053, 1572310053),
('/objetivo/update', 2, NULL, NULL, NULL, 1572310054, 1572310054),
('/objetivo/view', 2, NULL, NULL, NULL, 1572310053, 1572310053),
('Administrador', 1, NULL, NULL, NULL, 1570125958, 1570125958);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Administrador', '/admin/*');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` longtext NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `nombre`, `descripcion`, `id_area`) VALUES
(1, 'Analista', '', 1),
(2, 'Responsable en Marketing', '', 4),
(3, 'Social Media Manager', '', 4),
(4, 'Community Manager', '', 4),
(5, 'Analista de Contenidos', '', 4),
(6, 'Diseño', '', 4),
(7, 'Investigación de Mercado', '', 4),
(8, 'Prensa', '', 4),
(9, 'Responsable Comercial', '', 2),
(10, 'Representante Comercial', '', 2),
(11, 'KAM Grandes Cuentas', '', 2),
(12, 'Comercial Transportista', '', 2),
(13, 'Responsable Administración y Finanzas', '<ul><li>Realización de facturación y gestión del proceso de cobranza. Administración de datos contables</li><li>Gestión del proceso de compras. Ejecución&nbsp; de altas y pagos a proveedores y servicios&nbsp;</li></ul>', 5),
(14, 'Analista de Planeamiento', '', 5),
(15, 'Generalista de RRHH', '', 3),
(17, 'Project Manager', '', 1),
(18, 'Líder Técnico', '', 1),
(19, 'Desarrollador', '', 1),
(20, 'Project Líder', '', 1),
(21, 'Back Office (soporte)', '', 1),
(22, 'Back Office (Comercial)', '', 1),
(23, 'Tester', '', 1),
(24, 'CEO', '', 6),
(27, 'Marketing Digital', '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'SPRAY PARA PELO'),
(2, 'PERFUMES ARABES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `nota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre_cliente`, `telefono`, `nota`) VALUES
(3, 'TRABAJO DE DAGNER', '551323974', 'trabaja en premio foods'),
(4, 'TRABAJO EMILY', '5512718486', 'CLIENTES DEL TRABAJO DE EMILY'),
(5, 'FAMILIA ALENA', '5513239707', '<ul><li>ELVIRA&nbsp;</li><li>TIO SIBO</li><li><br></li></ul>'),
(6, 'PELUQUERIA(RELVIS)', '5513239703', 'FRENTE A LA CASA'),
(7, 'ESCUELA EMILY', '5513239708', 'BERGUELINE'),
(8, 'ROSA(PANERA)', '5513239709', 'PANERA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrada`
--

CREATE TABLE `detalle_entrada` (
  `id` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_costo` decimal(5,2) NOT NULL,
  `importe` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_entrada`
--

INSERT INTO `detalle_entrada` (`id`, `id_entrada`, `id_producto`, `cantidad`, `precio_costo`, `importe`) VALUES
(5, 6, 1, 1, '20.00', '20.00'),
(6, 6, 2, 1, '24.00', '24.00'),
(7, 6, 3, 1, '20.00', '20.00'),
(8, 6, 4, 1, '20.00', '20.00'),
(9, 6, 5, 1, '20.00', '20.00'),
(10, 7, 6, 1, '20.00', '20.00'),
(11, 7, 7, 1, '20.00', '20.00'),
(12, 7, 8, 1, '20.00', '20.00'),
(13, 7, 9, 1, '20.00', '20.00'),
(14, 7, 10, 1, '20.00', '20.00'),
(15, 7, 11, 1, '20.00', '20.00'),
(16, 7, 12, 1, '20.00', '20.00'),
(17, 7, 13, 1, '20.00', '20.00'),
(18, 7, 14, 1, '22.00', '22.00'),
(19, 8, 15, 1, '20.00', '20.00'),
(20, 8, 16, 1, '20.00', '20.00'),
(21, 8, 17, 1, '20.00', '20.00'),
(22, 8, 20, 1, '20.00', '20.00'),
(23, 8, 2, 2, '26.00', '52.00'),
(24, 9, 23, 1, '17.00', '17.00'),
(25, 9, 22, 1, '17.00', '17.00'),
(26, 9, 24, 1, '17.00', '17.00'),
(27, 9, 25, 1, '17.00', '17.00'),
(28, 9, 26, 1, '17.00', '17.00'),
(29, 9, 27, 1, '17.00', '17.00'),
(30, 9, 28, 1, '17.00', '17.00'),
(31, 10, 29, 2, '17.99', '35.98'),
(32, 10, 30, 2, '17.99', '35.98'),
(33, 10, 31, 2, '17.99', '35.98'),
(34, 10, 32, 2, '17.99', '35.98'),
(35, 10, 33, 2, '17.99', '35.98'),
(36, 10, 34, 2, '17.99', '35.98'),
(37, 10, 35, 2, '17.99', '35.98'),
(38, 10, 36, 1, '17.99', '17.99'),
(39, 11, 35, 2, '19.99', '39.98'),
(40, 11, 37, 1, '19.99', '19.99'),
(41, 11, 38, 1, '19.99', '19.99'),
(42, 11, 32, 1, '19.99', '19.99'),
(43, 11, 39, 1, '19.99', '19.99'),
(44, 11, 40, 1, '19.99', '19.99'),
(45, 11, 41, 1, '19.99', '19.99'),
(46, 11, 42, 1, '19.99', '19.99'),
(47, 11, 43, 1, '19.99', '19.99'),
(48, 11, 44, 1, '19.99', '19.99'),
(49, 12, 41, 2, '20.00', '40.00'),
(50, 12, 45, 2, '20.00', '40.00'),
(51, 12, 46, 1, '20.00', '20.00'),
(52, 13, 47, 1, '16.99', '16.99'),
(53, 13, 48, 1, '16.99', '16.99'),
(54, 13, 49, 1, '16.99', '16.99'),
(55, 13, 50, 1, '16.99', '16.99'),
(56, 13, 51, 1, '16.99', '16.99'),
(57, 13, 52, 1, '16.99', '16.99'),
(58, 13, 53, 1, '9.99', '9.99'),
(59, 13, 54, 1, '9.99', '9.99'),
(60, 14, 2, 2, '24.00', '48.00'),
(61, 14, 55, 1, '20.00', '20.00'),
(62, 14, 4, 1, '20.00', '20.00'),
(63, 14, 56, 1, '20.00', '20.00'),
(64, 14, 57, 1, '20.00', '20.00'),
(65, 14, 58, 1, '22.00', '22.00'),
(66, 14, 59, 1, '20.00', '20.00'),
(67, 14, 60, 1, '20.00', '20.00'),
(68, 15, 61, 2, '21.99', '43.98'),
(69, 15, 62, 2, '21.99', '43.98'),
(70, 15, 63, 1, '21.99', '21.99'),
(71, 15, 64, 1, '21.99', '21.99'),
(72, 16, 32, 2, '40.00', '80.00'),
(73, 16, 66, 1, '20.00', '20.00'),
(74, 17, 59, 1, '19.99', '19.99'),
(75, 17, 67, 1, '17.99', '17.99'),
(76, 17, 68, 1, '17.99', '17.99'),
(77, 17, 69, 1, '17.99', '17.99'),
(78, 17, 32, 1, '17.99', '17.99'),
(79, 17, 49, 1, '17.99', '17.99'),
(80, 18, 2, 2, '22.50', '45.00'),
(81, 18, 70, 1, '22.50', '22.50'),
(82, 18, 71, 1, '22.50', '22.50'),
(83, 19, 58, 2, '20.00', '40.00'),
(84, 19, 72, 1, '20.00', '20.00'),
(85, 19, 37, 1, '20.00', '20.00'),
(86, 19, 73, 1, '28.00', '28.00'),
(87, 20, 28, 1, '20.00', '20.00'),
(88, 20, 67, 1, '20.00', '20.00'),
(89, 20, 74, 1, '14.99', '14.99'),
(90, 21, 78, 1, '17.99', '17.99'),
(91, 21, 76, 1, '17.99', '17.99'),
(92, 21, 45, 1, '17.99', '17.99'),
(93, 21, 41, 1, '17.99', '17.99'),
(94, 21, 30, 2, '17.99', '35.98'),
(95, 21, 77, 1, '19.99', '19.99'),
(96, 22, 79, 2, '20.00', '40.00'),
(97, 22, 80, 2, '20.00', '40.00'),
(98, 22, 81, 1, '20.00', '20.00'),
(99, 22, 77, 1, '22.00', '22.00'),
(100, 22, 82, 2, '20.00', '40.00'),
(101, 22, 31, 1, '20.00', '20.00'),
(102, 22, 83, 1, '20.00', '20.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `importe` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `producto_id`, `venta_id`, `precio`, `cantidad`, `importe`) VALUES
(1, 10, 1, '40', '1', '40.00'),
(2, 38, 2, '50', '1', '50.00'),
(3, 31, 3, '40', '1', '40.00'),
(4, 32, 3, '40', '1', '40.00'),
(5, 45, 4, '50', '1', '50.00'),
(6, 24, 5, '40', '1', '40.00'),
(7, 30, 5, '40', '1', '40.00'),
(8, 22, 6, '40', '1', '40.00'),
(9, 25, 6, '40', '1', '40.00'),
(10, 43, 7, '40', '1', '40.00'),
(11, 34, 7, '40', '1', '40.00'),
(12, 42, 7, '40', '1', '40.00'),
(13, 41, 7, '40', '1', '40.00'),
(14, 37, 7, '40', '1', '40.00'),
(15, 41, 8, '40', '1', '40.00'),
(16, 30, 8, '40', '1', '40.00'),
(17, 65, 8, '40', '1', '40.00'),
(18, 2, 9, '50', '1', '50.00'),
(19, 1, 9, '40', '1', '40.00'),
(20, 33, 9, '40', '1', '40.00'),
(21, 4, 9, '40', '1', '40.00'),
(22, 35, 9, '40', '2', '80.00'),
(23, 40, 9, '40', '2', '80.00'),
(24, 5, 10, '50', '1', '50.00'),
(25, 44, 10, '50', '1', '50.00'),
(33, 32, 12, '50', '2', '100.00'),
(34, 35, 12, '40', '1', '40.00'),
(35, 29, 12, '40', '1', '40.00'),
(36, 46, 12, '50', '1', '50.00'),
(37, 2, 12, '50', '1', '50.00'),
(38, 49, 12, '40', '1', '40.00'),
(39, 48, 12, '40', '1', '40.00'),
(40, 32, 13, '40', '1', '40.00'),
(41, 11, 13, '40', '1', '40.00'),
(42, 41, 13, '40', '1', '40.00'),
(43, 3, 13, '40', '1', '40.00'),
(44, 15, 13, '50', '1', '50.00'),
(55, 7, 16, '40', '1', '40.00'),
(56, 6, 16, '40', '1', '40.00'),
(57, 56, 17, '40', '1', '40.00'),
(58, 59, 17, '40', '1', '40.00'),
(59, 31, 17, '40', '1', '40.00'),
(60, 57, 17, '50', '1', '50.00'),
(61, 58, 17, '50', '1', '50.00'),
(62, 35, 18, '40', '1', '40.00'),
(63, 2, 18, '50', '2', '100.00'),
(64, 8, 18, '50', '1', '50.00'),
(65, 4, 19, '50', '1', '50.00'),
(66, 2, 20, '50', '1', '50.00'),
(67, 36, 21, '40', '1', '40.00'),
(68, 16, 18, '50', '1', '50.00'),
(69, 63, 22, '50', '1', '50.00'),
(70, 71, 23, '50', '1', '50.00'),
(71, 67, 24, '50', '1', '50.00'),
(72, 2, 25, '60', '1', '60.00'),
(73, 39, 26, '35', '1', '35.00'),
(74, 59, 27, '40', '1', '40.00'),
(75, 49, 28, '50', '1', '50.00'),
(76, 67, 29, '50', '1', '50.00'),
(77, 58, 30, '50', '1', '50.00'),
(78, 73, 31, '60', '1', '60.00'),
(79, 75, 31, '50', '1', '50.00'),
(80, 58, 31, '50', '1', '50.00'),
(81, 32, 32, '50', '1', '50.00'),
(82, 51, 32, '40', '1', '40.00'),
(83, 28, 33, '50', '1', '50.00'),
(84, 41, 33, '50', '1', '50.00'),
(85, 77, 34, '60', '1', '60.00'),
(86, 70, 35, '50', '1', '50.00'),
(87, 45, 36, '50', '1', '50.00'),
(88, 30, 37, '50', '1', '50.00'),
(89, 61, 38, '35', '1', '35.00'),
(90, 62, 38, '35', '1', '35.00'),
(91, 64, 38, '35', '1', '35.00'),
(92, 78, 38, '35', '1', '35.00'),
(93, 81, 39, '50', '1', '50.00'),
(94, 76, 39, '50', '1', '50.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dosificacion`
--

CREATE TABLE `dosificacion` (
  `id_dosif` int(11) NOT NULL,
  `no_order` int(250) NOT NULL,
  `no_inicial` int(250) NOT NULL,
  `no_final` int(250) NOT NULL,
  `no_actual` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dosificacion`
--

INSERT INTO `dosificacion` (`id_dosif`, `no_order`, `no_inicial`, `no_final`, `no_actual`) VALUES
(1, 39, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dni` int(10) NOT NULL,
  `es_jefe` tinyint(4) NOT NULL DEFAULT 0,
  `id_area` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `apellidos`, `dni`, `es_jefe`, `id_area`, `id_cargo`, `fecha_ingreso`) VALUES
(6, 'Emily Diaz', 'Navoni', 31718478, 0, 3, 15, '2018-05-30'),
(7, 'Giuliano', 'Bufarini', 39686554, 0, 5, 11, '0000-00-00'),
(8, 'Pedro', 'Malano', 40115339, 0, 1, 22, '0000-00-00'),
(10, 'Gaston', 'Joandet', 31653563, 0, 1, 17, '0000-00-00'),
(11, 'Rodolfo', 'Vazquez', 19078867, 0, 1, 18, '0000-00-00'),
(12, 'Emanuel ', 'Salinas', 34205672, 0, 1, 20, '2019-07-10'),
(14, 'Aldair', 'Sosa Vaccaro', 45835332, 0, 2, 12, '2019-08-15'),
(15, 'Agustin ', 'Pellegrini', 31565535, 0, 2, 10, '2019-04-30'),
(16, 'Leandro ', 'Bordigoni', 39501562, 0, 1, 22, '2019-06-01'),
(17, 'Dagner', 'Alena Guerra', 95563907, 0, 1, 19, '2019-04-22'),
(19, 'Baltazar', 'Juaniz', 26667891, 0, 4, 6, '2019-06-18'),
(20, 'Mariela', 'Vaquero', 21825425, 0, 4, 8, '2019-01-19'),
(21, 'Cristian ', 'Tonna', 29808510, 0, 2, 10, '2019-07-01'),
(23, 'Eloy', 'Vera', 27792176, 0, 6, 24, '0000-00-00'),
(24, 'Lianet', 'Lamela', 95675019, 0, 4, 27, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `invoice` varchar(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `doc_respaldo` text NOT NULL,
  `total` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id`, `fecha`, `invoice`, `id_proveedor`, `doc_respaldo`, `total`) VALUES
(6, '2022-11-02', '207', 2, 'Invoice_207_2022-11-02.pdf', '104.00'),
(7, '2022-11-15', '250', 2, 'Invoice_250_2022-11-15.pdf', '182.00'),
(8, '2022-11-22', '269', 2, 'Invoice_269_2022-11-22.pdf', '132.00'),
(9, '2022-09-20', '8521', 7, 'order_receipt_2302264983.pdf', '119.00'),
(10, '2022-10-05', '3126', 8, 'order_receipt_2343434350.pdf', '269.85'),
(11, '2022-10-20', '4034', 8, 'order_receipt_2397953198.pdf', '219.89'),
(12, '2022-10-31', '9265', 7, 'order_receipt_2430393885.pdf', '100.00'),
(13, '2022-11-12', '5052', 8, 'order_receipt_2475047289.pdf', '121.92'),
(14, '2022-12-08', '324', 2, 'Invoice_324_2022-12-08_(1).pdf', '190.00'),
(15, '2022-12-10', '18673', 9, 'order_receipt_2612836635.pdf', '119.59'),
(16, '2022-11-19', '5393', 8, 'order_receipt_2502668726.pdf', '100.00'),
(17, '2022-12-26', '7208', 8, 'order_receipt_2685005936-_N-7208.pdf', '109.94'),
(18, '2023-01-05', '11432', 7, 'order_receipt_2726992258_N-11432.pdf', '90.00'),
(19, '2023-01-18', '460', 2, 'Invoice_460_2023-01-18.pdf', '108.00'),
(20, '2023-01-20', '8290', 8, 'order_receipt_2782365122.pdf', '54.99'),
(21, '2023-02-21', '10071', 8, 'vivi-10071.pdf', '127.93'),
(22, '2023-04-14', '1104', 2, 'AG_RIVASCORP-1104.pdf', '202.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `concepto` text NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `concepto`, `fecha`, `monto`) VALUES
(2, 'HOSTING PLAN ANUAL', '2022-10-05', '175.00'),
(3, 'DOMINIO(POLARISFRAGANCE)', '2022-10-05', '15.00'),
(5, 'Snowfall Effect Plus', '2022-11-24', '2.00'),
(6, 'FRASCOS MUESTRAS PERFUMES', '2022-10-22', '17.00'),
(9, '(SHIPPING)(AGRIVASCORP)Invoice207', '2022-11-02', '16.59'),
(10, '(SHIPPING)(AGRIVASCORP)Invoice250', '2022-11-15', '21.40'),
(11, '(SHIPPING)(AGRIVASCORP)Invoice269', '2022-11-22', '18.46'),
(12, '(SHIPPING)(AGRIVASCORP)Invoice324', '2022-12-08', '21.79'),
(13, '(SHIPPING)(ViviFrangaces)Invoice5393', '2022-11-19', '9.99'),
(14, '(SHIPPING) (SAY YES)Invoice - 11432', '2023-01-05', '10.00'),
(15, ' Yoast SEO - SEO for everyone', '2023-01-01', '20.00'),
(16, '(SHIPPING) (AGRIVASCORP)Invoice - 460', '2023-01-18', '17.42'),
(17, '(SHIPPING) (ViviFrangaces)Invoice - 8290', '2023-01-20', '9.99'),
(18, 'Pago de ultima factura de YoaCEO', '2023-03-04', '20.49'),
(19, '(SHIPPING) (AGRIVASCORP)Invoice - 1104', '2023-04-14', '20.63');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1571150587),
('m191016_183729_alter_empleado_table', 1571324559),
('m191016_185022_alter_area_table', 1571324559),
('m191020_040637_create_funciones_table', 1571687400),
('m191021_120731_create_rol_table', 1571687400),
('m191021_120814_create_user_rol_table', 1571687400),
('m191021_121059_add_id_empleado_column_to_user_table', 1571687400),
('m191021_205408_create_empleado_objetivo_table', 1571693458),
('m191021_205430_alter_objetivo_table', 1571693458),
('m191028_223004_insert_auth_assignment_table', 1572527883),
('m191028_223424_insert_auth_item_table', 1572527883),
('m191028_223441_insert_auth_item_child_table', 1572527883),
('m191029_005711_insert_auth_item_table', 1572527883);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_tipo_nivel` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`id`, `descripcion`, `id_tipo_nivel`, `id_empleado`) VALUES
(4, 'MUVIN', 1, NULL),
(5, 'Desarrollo', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `description` text NOT NULL,
  `peso_neto` decimal(10,0) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `img` text NOT NULL DEFAULT 'no-image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre_producto`, `id_categoria`, `description`, `peso_neto`, `estado`, `genero`, `img`) VALUES
(1, 'EMPER ESPADA AL JAMAL ROSA', 2, 'WOMAN EDP 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(2, 'LATAFFA YARA', 2, 'WOMAN EDP 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(3, 'GRANDEUR LIBERTY', 2, 'WOMAN EDP 80 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(4, 'ALWA SULTAN AL LAIL', 2, 'MEN EDP 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(5, 'ALWA SABAH AL WARD', 2, 'WOMAN EDP 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(6, 'EMPER PRIVE ARABIAN ROSE', 2, 'WOMAN EDP 80 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(7, 'EMPER PRIVE MAGENTA', 2, 'WOMAN EDP 80 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(8, 'EMPER PRIVE ROUGE', 2, 'WOMAN EDP 80 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(9, 'EMPER PRIVE TURQUOISE', 2, 'MEN 100ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(10, 'KING ROBOTIC', 2, 'EXTRAIT DE PARFUM MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(11, 'ROBOTIC SILVER', 2, 'EXTRAIT DE PARFUM MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(12, 'MAISON AL THE CHANT', 2, 'WOMAN EDP 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(13, 'MAISON AL THE SERPENT', 2, 'MEN EDP 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(14, 'MAISON AL VERSENCIA ROUGE', 2, 'MEN EDP 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(15, 'RAVE MARCONI BLACK INTENSE', 2, 'MEN EDP 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(16, 'EMPER ARABIA BLACK AROMATO', 2, 'MEN EDP 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(17, 'MAISON AL AMBER AND LEATHER', 2, 'MEN EDP 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(18, 'EMPER ROCK STREET', 2, 'UNISEX EDP 100 ML', '1', 'activo', 'unisex', 'no-image.jpg'),
(19, 'EMPER HOT LIPS', 2, 'WOMAN EDP 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(20, 'EMPER AURIANO', 2, 'WOMAN EDP 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(22, 'GHALA(BARRAT)', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(23, 'MALAKI', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(24, 'MUMAYEZ', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(25, 'SAVVENTRIUS(SAVAGE ARABE)', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(26, 'VISION POOR HOMME', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(27, 'CERULEAN BLUE(CITRIC FRESH)', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(28, 'AMEERATI UNISEX( CITRIC FRESH)', 2, 'UNISEX 100 ML', '1', 'activo', 'unisex', 'no-image.jpg'),
(29, 'JEWEL ROUGE(BARAT ROUGE)', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(30, 'BLACK DIAMOND', 2, 'WOMAN 100 ML (Inspired by: Versace Cristal)', '1', 'activo', 'mujer', 'no-image.jpg'),
(31, 'INSTINCT NOIR', 2, 'UNISEX 100 ML', '1', 'activo', 'unisex', 'no-image.jpg'),
(32, 'THE MYTH', 2, 'UNISEX 100 ML', '1', 'activo', 'unisex', 'no-image.jpg'),
(33, 'SELINA', 1, '(Inspired by DELINA DE MARLY)', '1', 'activo', 'mujer', 'no-image.jpg'),
(34, 'ARABIA MADAME', 2, 'ELEGANTE CON JAZMIN ROSAS Y VAINILLA', '1', 'activo', 'mujer', 'no-image.jpg'),
(35, 'CRIKI ABSOLUTE', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(36, 'WOODY OJD', 2, 'INSPIRADO EN TOM FORFOD OUD&nbsp; WOOD', '1', 'activo', 'hombre', 'no-image.jpg'),
(37, 'ESPADA DE ORO', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(38, 'ATTAR AL WESAL', 2, 'MEN 100ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(39, 'QAED AL FUSAN', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(40, 'MUSK ROUGE', 2, 'women 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(41, 'SILLAGE OROS', 2, 'UNISEX', '1', 'activo', 'unisex', 'no-image.jpg'),
(42, 'ARIZONA ROUGE', 2, 'WOMEN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(43, 'VERSENCIA ORO', 2, 'EROS DE VERSACE', '1', 'activo', 'hombre', 'no-image.jpg'),
(44, 'PANORAMA OPIUM', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(45, 'IMPERIAL BLUE', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(46, 'IMPERIAL ROUGUE', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(47, 'DONNA POUR FEMME', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(48, 'ESAPADA  PRIME', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(49, 'ESPADA INTENSE', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(50, 'SWANO SALASIL', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(51, 'SWANO FOREVER', 2, 'WOMEN 80ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(52, 'SWANO WHITE', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(53, 'CHIFON BELLE', 1, '80 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(54, 'CHIFON ROUGE', 1, '80 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(55, 'ALWA NOOR AL SABAH', 2, 'WOMAN EDP 100 ML MAS BODY', '1', 'activo', 'mujer', 'no-image.jpg'),
(56, 'SUNSET GARDENIA', 2, 'WOMAN EDP 100 ML MAS BODY', '1', 'activo', 'hombre', 'no-image.jpg'),
(57, 'GRANDEUR UNBREAKABLE', 2, 'MEN EDP 100 ML MAS BODY', '1', 'activo', 'hombre', 'no-image.jpg'),
(58, 'EMPER LEGEND DUO', 2, 'MEN EDT 100 ML MAS SPRAY', '1', 'activo', 'hombre', 'no-image.jpg'),
(59, 'LA VOIE', 2, 'WOMAN EDP 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(60, 'MAISON AL BRIGHT PEACH', 2, 'UNISEX EDP 100', '1', 'activo', 'unisex', 'no-image.jpg'),
(61, 'LOVE', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(62, 'YARA MEI', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(63, 'BEAUTIFUL GIRL GOLDEN', 2, 'WOMAN 100 ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(64, 'FABULO INTENSE', 2, 'MEN 100 ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(65, 'ANA AL AWWAL', 2, 'FOR MEN 100ML', '1', 'activo', 'hombre', 'no-image.jpg'),
(66, 'THE CHANT', 2, 'WOMAN 100ML', '1', 'activo', 'mujer', 'no-image.jpg'),
(67, 'SAVEAGE ELIXIR', 2, 'FOR MEN 2.8 OZ', '1', 'activo', 'hombre', 'no-image.jpg'),
(68, 'CHANTS TENDRINA', 2, 'FOR WOMAN INSPIRADO EN CHANCE DE CHANEL', '1', 'activo', 'mujer', 'no-image.jpg'),
(69, 'LA VITA BELLA', 2, 'WOMAN', '1', 'activo', 'mujer', 'no-image.jpg'),
(70, 'MASTER PIECE', 2, 'unisex', '1', 'activo', 'unisex', 'no-image.jpg'),
(71, 'NIGTH PARTY', 2, 'Unisex', '1', 'activo', 'unisex', 'no-image.jpg'),
(72, 'ALWA THAHAANI', 2, 'woman 100 ml', '1', 'activo', 'mujer', 'no-image.jpg'),
(73, 'REIBL RENEGADE', 2, 'MEN SET 4 PIEZAS', '1', 'activo', 'hombre', 'no-image.jpg'),
(74, 'YELLOW DIAMON', 2, 'Versase', '1', 'activo', 'mujer', 'no-image.jpg'),
(75, 'NO.2 MEN', 2, 'FOR MEN', '1', 'activo', 'hombre', 'no-image.jpg'),
(76, 'MORELA MID WAY', 2, 'FOR HUMAN', '1', 'activo', 'mujer', 'no-image.jpg'),
(77, 'METROPOLIS GREEN ', 2, '', '1', 'activo', 'unisex', 'no-image.jpg'),
(78, 'PROFUMO INTENSITY', 2, '', '1', 'activo', 'hombre', 'no-image.jpg'),
(79, 'GRANDEUR PARADOX', 2, 'SIMILIAR AL VERSACHE EROS', '1', 'activo', 'hombre', 'no-image.jpg'),
(80, 'MAISON SALVO', 2, 'SIMILAR AL SAVAGE', '1', 'activo', 'hombre', 'no-image.jpg'),
(81, 'MAISON  LEYDEN', 2, 'FOR MEN', '1', 'activo', 'hombre', 'no-image.jpg'),
(82, 'EMPER ESPADA OUD INTENSE', 2, 'ME EDP', '1', 'activo', 'hombre', 'no-image.jpg'),
(83, 'MAISON PINK SHIMMER', 2, '', '1', 'activo', 'mujer', 'no-image.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_stock`
--

CREATE TABLE `productos_stock` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `stock` int(50) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_stock`
--

INSERT INTO `productos_stock` (`id`, `id_categoria`, `id_producto`, `stock`, `estado`) VALUES
(20, 2, 1, 0, 'activo'),
(21, 2, 2, 1, 'activo'),
(22, 2, 3, 0, 'activo'),
(23, 2, 4, 0, 'activo'),
(24, 2, 5, 0, 'activo'),
(25, 2, 6, 0, 'activo'),
(26, 2, 7, 0, 'activo'),
(27, 2, 8, 0, 'activo'),
(28, 2, 9, 1, 'activo'),
(29, 2, 10, 0, 'activo'),
(30, 2, 11, 0, 'activo'),
(31, 2, 12, 1, 'activo'),
(32, 2, 13, 1, 'activo'),
(33, 2, 14, 0, 'activo'),
(34, 2, 15, 0, 'activo'),
(35, 2, 16, 0, 'activo'),
(36, 2, 17, 1, 'activo'),
(37, 2, 20, 1, 'activo'),
(38, 2, 23, 0, 'activo'),
(39, 2, 22, 0, 'activo'),
(40, 2, 24, 0, 'activo'),
(41, 2, 25, 0, 'activo'),
(42, 2, 26, 0, 'activo'),
(43, 2, 27, 0, 'activo'),
(44, 2, 28, 0, 'activo'),
(45, 2, 29, 0, 'activo'),
(46, 2, 30, 1, 'activo'),
(47, 2, 31, 1, 'activo'),
(48, 2, 32, 1, 'activo'),
(49, 1, 33, 1, 'activo'),
(50, 2, 34, 1, 'activo'),
(51, 2, 35, 0, 'activo'),
(52, 2, 36, 0, 'activo'),
(53, 2, 37, 1, 'activo'),
(54, 2, 38, 0, 'activo'),
(55, 2, 39, 0, 'activo'),
(56, 2, 40, 0, 'activo'),
(57, 2, 41, 0, 'activo'),
(58, 2, 42, 0, 'activo'),
(59, 2, 43, 0, 'activo'),
(60, 2, 44, 0, 'activo'),
(61, 2, 45, 0, 'activo'),
(62, 2, 46, 0, 'activo'),
(63, 2, 47, 1, 'activo'),
(64, 2, 48, 0, 'activo'),
(65, 2, 49, 0, 'activo'),
(66, 2, 50, 1, 'activo'),
(67, 2, 51, 0, 'activo'),
(68, 2, 52, 1, 'activo'),
(69, 1, 53, 0, 'activo'),
(70, 1, 54, 0, 'activo'),
(71, 2, 55, 0, 'activo'),
(72, 2, 56, 0, 'activo'),
(73, 2, 57, 0, 'activo'),
(74, 2, 58, 0, 'activo'),
(75, 2, 59, 0, 'activo'),
(76, 2, 60, 1, 'activo'),
(77, 2, 61, 1, 'activo'),
(78, 2, 62, 1, 'activo'),
(79, 2, 63, 0, 'activo'),
(80, 2, 64, 0, 'activo'),
(81, 2, 66, 1, 'activo'),
(82, 2, 67, 0, 'activo'),
(83, 2, 68, 1, 'activo'),
(84, 2, 69, 1, 'activo'),
(85, 2, 70, 0, 'activo'),
(86, 2, 71, 0, 'activo'),
(87, 2, 72, 1, 'activo'),
(88, 2, 73, 0, 'activo'),
(89, 2, 74, 1, 'activo'),
(90, 2, 75, 0, 'activo'),
(91, 2, 78, 0, 'activo'),
(92, 2, 76, 0, 'activo'),
(93, 2, 77, 1, 'activo'),
(94, 2, 79, 2, 'activo'),
(95, 2, 80, 2, 'activo'),
(96, 2, 81, 0, 'activo'),
(97, 2, 82, 2, 'activo'),
(98, 2, 83, 1, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre_prove` varchar(50) NOT NULL,
  `direccion_prove` text NOT NULL,
  `telefono` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre_prove`, `direccion_prove`, `telefono`) VALUES
(2, 'AGRIVASCORP', '<div>DEERFIELD BEACH, Florida</div><div>United States</div>', '9542344093'),
(7, 'SAY YES', 'miami', '7865833049'),
(8, 'ViviFrangaces', 'Proveedora de miami&nbsp;', '5513239708'),
(9, 'EZENZIA', 'MIAMI', '5513239705');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(1, 'rh'),
(2, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_nivel`
--

CREATE TABLE `tipo_nivel` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `id_superior` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_nivel`
--

INSERT INTO `tipo_nivel` (`id`, `descripcion`, `id_superior`) VALUES
(1, 'Empresa', 0),
(2, 'Grupo', 3),
(3, 'Departamento', 4),
(4, 'Area', 1),
(5, 'Empleado', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `status`, `created_at`, `updated_at`, `id_empleado`, `id_rol`) VALUES
(5, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 10, 0, 0, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_rol`
--

CREATE TABLE `user_rol` (
  `id_user` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `numero_correlativo` varchar(20) NOT NULL,
  `serie` varchar(10) NOT NULL,
  `medio_pago` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `estado` varchar(11) NOT NULL DEFAULT 'exitosa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `id_cliente`, `numero_correlativo`, `serie`, `medio_pago`, `total`, `estado`) VALUES
(1, '2022-11-28', 3, '00000001', '', 'efectivo', '40.00', 'exitosa'),
(2, '2022-10-27', 3, '00000002', '', 'efectivo', '50.00', 'exitosa'),
(3, '2022-10-17', 3, '00000003', '', 'efectivo', '80.00', 'exitosa'),
(4, '2022-11-18', 3, '00000004', '', 'efectivo', '50.00', 'exitosa'),
(5, '2022-10-08', 6, '00000005', '', 'efectivo', '80.00', 'exitosa'),
(6, '2022-09-10', 5, '00000006', '', 'zelle', '80.00', 'exitosa'),
(7, '2022-10-22', 5, '00000008', '', 'efectivo', '200.00', 'exitosa'),
(8, '2022-10-23', 8, '00000009', '', 'efectivo', '120.00', 'exitosa'),
(9, '2022-10-15', 7, '00000010', '', 'efectivo', '330.00', 'exitosa'),
(10, '2022-11-14', 3, '00000011', '', 'efectivo', '100.00', 'exitosa'),
(12, '2022-12-09', 4, '00000002', '', 'efectivo', '360.00', 'exitosa'),
(13, '2022-11-21', 4, '00000013', '', 'efectivo', '210.00', 'exitosa'),
(16, '2022-12-09', 3, '00000016', '', 'efectivo', '80.00', 'exitosa'),
(17, '2022-12-22', 3, '00000017', '', 'efectivo', '220.00', 'exitosa'),
(18, '2022-12-22', 6, '00000018', '', 'efectivo', '240.00', 'exitosa'),
(19, '2022-12-24', 3, '00000019', '', 'zelle', '50.00', 'exitosa'),
(20, '2022-12-19', 4, '00000020', '', 'efectivo', '50.00', 'exitosa'),
(21, '2022-10-15', 7, '00000021', '', 'efectivo', '40.00', 'exitosa'),
(22, '2023-01-13', 3, '00000022', '', 'efectivo', '50.00', 'exitosa'),
(23, '2023-01-16', 3, '00000023', '', 'efectivo', '50.00', 'exitosa'),
(24, '2023-01-18', 3, '00000024', '', 'efectivo', '50.00', 'exitosa'),
(25, '2023-01-18', 3, '00000025', '', 'zelle', '60.00', 'exitosa'),
(26, '2023-01-23', 3, '00000026', '', 'efectivo', '35.00', 'exitosa'),
(27, '2023-01-21', 3, '00000027', '', 'zelle', '40.00', 'exitosa'),
(28, '2023-02-03', 3, '00000028', '', 'efectivo', '50.00', 'exitosa'),
(29, '2023-02-02', 3, '00000029', '', 'efectivo', '50.00', 'exitosa'),
(30, '2023-02-04', 7, '00000030', '', 'zelle', '50.00', 'exitosa'),
(31, '2023-02-07', 3, '00000031', '', 'efectivo', '160.00', 'exitosa'),
(32, '2023-02-13', 3, '00000032', '', 'efectivo', '90.00', 'exitosa'),
(33, '2023-03-01', 3, '00000033', '', 'efectivo', '100.00', 'exitosa'),
(34, '2023-03-03', 3, '00000034', '', 'efectivo', '60.00', 'exitosa'),
(35, '2023-03-13', 3, '00000035', '', 'efectivo', '50.00', 'exitosa'),
(36, '2023-03-21', 3, '00000036', '', 'zelle', '50.00', 'exitosa'),
(37, '2023-04-07', 3, '00000037', '', 'efectivo', '50.00', 'exitosa'),
(38, '2023-04-15', 5, '00000038', '', 'zelle', '140.00', 'exitosa'),
(39, '2023-05-01', 3, '00000039', '', 'efectivo', '100.00', 'exitosa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`),
  ADD KEY `id_jefe` (`id_jefe`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_entrada` (`id_entrada`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_venta_detalle_idx` (`venta_id`),
  ADD KEY `fk_producto_detalle_idx` (`producto_id`);

--
-- Indices de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  ADD PRIMARY KEY (`id_dosif`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_nivel` (`id_tipo_nivel`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_stock`
--
ALTER TABLE `productos_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_nivel`
--
ALTER TABLE `tipo_nivel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_superior` (`id_superior`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-user-empleado` (`id_empleado`),
  ADD KEY `fk-user-rol` (`id_rol`);

--
-- Indices de la tabla `user_rol`
--
ALTER TABLE `user_rol`
  ADD KEY `fk-user_rol-user` (`id_user`),
  ADD KEY `fk-user_rol-rol` (`id_rol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  MODIFY `id_dosif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `productos_stock`
--
ALTER TABLE `productos_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_nivel`
--
ALTER TABLE `tipo_nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`id_jefe`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  ADD CONSTRAINT `detalle_entrada_ibfk_1` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id`),
  ADD CONSTRAINT `detalle_entrada_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_entrada_ibfk_3` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD CONSTRAINT `id_tipo_nivel_pkx` FOREIGN KEY (`id_tipo_nivel`) REFERENCES `tipo_nivel` (`id`),
  ADD CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `productos_stock`
--
ALTER TABLE `productos_stock`
  ADD CONSTRAINT `productos_stock_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_stock_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk-user-empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-user-rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_rol`
--
ALTER TABLE `user_rol`
  ADD CONSTRAINT `fk-user_rol-rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-user_rol-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
