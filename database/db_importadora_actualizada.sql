-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 31, 2023 at 06:54 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_importadora`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrador', '1', 1677807726),
('DemoRol', '2', 1677807737);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/clientes/clientes/*', 2, NULL, NULL, NULL, 1685116311, 1685116311),
('/clientes/direcciones/*', 2, NULL, NULL, NULL, 1685116303, 1685116303),
('/compras/compras/*', 2, NULL, NULL, NULL, 1685062067, 1685062067),
('/compras/det-compras/*', 2, NULL, NULL, NULL, 1685062168, 1685062168),
('/compras/proveedores/*', 2, NULL, NULL, NULL, 1683336636, 1683336636),
('/debug/*', 2, NULL, NULL, NULL, 1677807204, 1677807204),
('/gii/*', 2, NULL, NULL, NULL, 1677807211, 1677807211),
('/gridview/*', 2, NULL, NULL, NULL, 1677807174, 1677807174),
('/inventario/inventario/*', 2, NULL, NULL, NULL, 1686329297, 1686329297),
('/ordenes/det-ordenes/*', 2, NULL, NULL, NULL, 1685842823, 1685842823),
('/ordenes/ordenes/*', 2, NULL, NULL, NULL, 1685842813, 1685842813),
('/productos/categorias/*', 2, NULL, NULL, NULL, 1682216083, 1682216083),
('/productos/marcas/*', 2, NULL, NULL, NULL, 1681526290, 1681526290),
('/productos/productos/*', 2, NULL, NULL, NULL, 1682216107, 1682216107),
('/productos/sub-categorias/*', 2, NULL, NULL, NULL, 1682216092, 1682216092),
('/rbac/*', 2, NULL, NULL, NULL, 1677807195, 1677807195),
('/site/*', 2, NULL, NULL, NULL, 1677807256, 1677807256),
('/usuarios/*', 2, NULL, NULL, NULL, 1677807263, 1677807263),
('/ventas/ventas/*', 2, NULL, NULL, NULL, 1685842842, 1685842842),
('Administrador', 1, 'Rol de Administrador del sistema', NULL, NULL, 1677807604, 1677807684),
('DemoRol', 1, 'Rol para demosntacion', NULL, NULL, 1677807665, 1677807665),
('PermisoAdmin', 2, 'Este es el permiso para el administrador', NULL, NULL, 1677807368, 1677807368),
('PermisoDemo', 2, 'Este es un permiso para DEmostracion', NULL, NULL, 1677807505, 1677807505);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('PermisoAdmin', '/clientes/clientes/*'),
('PermisoAdmin', '/clientes/direcciones/*'),
('PermisoAdmin', '/compras/compras/*'),
('PermisoAdmin', '/compras/det-compras/*'),
('PermisoAdmin', '/compras/proveedores/*'),
('PermisoAdmin', '/debug/*'),
('PermisoAdmin', '/gii/*'),
('PermisoAdmin', '/gridview/*'),
('PermisoDemo', '/gridview/*'),
('PermisoAdmin', '/inventario/inventario/*'),
('PermisoAdmin', '/ordenes/det-ordenes/*'),
('PermisoAdmin', '/ordenes/ordenes/*'),
('PermisoAdmin', '/productos/categorias/*'),
('PermisoAdmin', '/productos/marcas/*'),
('PermisoDemo', '/productos/marcas/*'),
('PermisoAdmin', '/productos/productos/*'),
('PermisoAdmin', '/productos/sub-categorias/*'),
('PermisoAdmin', '/rbac/*'),
('PermisoAdmin', '/site/*'),
('PermisoDemo', '/site/*'),
('PermisoAdmin', '/usuarios/*'),
('PermisoAdmin', '/ventas/ventas/*'),
('Administrador', 'PermisoAdmin'),
('DemoRol', 'PermisoDemo');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bitacora`
--

CREATE TABLE `tbl_bitacora` (
  `id_bitacora` int NOT NULL,
  `id_registro` int NOT NULL,
  `controlador` varchar(25) NOT NULL,
  `accion` varchar(25) NOT NULL,
  `data_original` json DEFAULT NULL,
  `data_modificada` json DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `id_categoria` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `id_cliente` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compras`
--

CREATE TABLE `tbl_compras` (
  `id_compra` int NOT NULL,
  `codigo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `num_factura` int NOT NULL,
  `id_proveedor` int NOT NULL,
  `tipo_compra` tinyint NOT NULL,
  `fecha` date NOT NULL,
  `anulado` tinyint NOT NULL DEFAULT '0',
  `comentarios` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci,
  `estado` tinyint(1) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_condicion_producto`
--

CREATE TABLE `tbl_condicion_producto` (
  `id_condicion` int NOT NULL,
  `nombre_condicion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departamentos`
--

CREATE TABLE `tbl_departamentos` (
  `id_departamento` int NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `codigo` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_departamentos`
--

INSERT INTO `tbl_departamentos` (`id_departamento`, `nombre`, `codigo`) VALUES
(1, 'AHUACHAPAN', 'AH'),
(2, 'SANTA ANA', 'SA'),
(3, 'SONSONATE', 'SO'),
(4, 'CHALATENANGO', 'CH'),
(5, 'LA LIBERTAD', 'LL'),
(6, 'SAN SALVADOR', 'SS'),
(7, 'CUSCATLAN', 'CU'),
(8, 'LA PAZ', 'LP'),
(9, 'CABAÑAS', 'CA'),
(10, 'SAN VICENTE', 'SV'),
(11, 'USULUTAN', 'US'),
(12, 'SAN MIGUEL', 'SM'),
(13, 'MORAZAN', 'MO'),
(14, 'LA UNION', 'LU');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_det_compras`
--

CREATE TABLE `tbl_det_compras` (
  `id_det_compra` int NOT NULL,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `gastos_transporte` float DEFAULT NULL,
  `otros_gastos` float DEFAULT NULL,
  `detalle_otros_gastos` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `valor_aduana` float NOT NULL,
  `dai` float DEFAULT NULL,
  `apm` float DEFAULT NULL,
  `vts` float DEFAULT NULL,
  `its` float DEFAULT NULL,
  `aiv` float DEFAULT NULL,
  `opm` float DEFAULT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_det_ordenes`
--

CREATE TABLE `tbl_det_ordenes` (
  `id_det_orden` int NOT NULL,
  `id_orden` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_direcciones`
--

CREATE TABLE `tbl_direcciones` (
  `id_direccion` int NOT NULL,
  `id_cliente` int NOT NULL,
  `contacto` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `direccion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `id_departamento` int NOT NULL,
  `id_municipio` int NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_duca`
--

CREATE TABLE `tbl_duca` (
  `id_duca` int NOT NULL,
  `no_correlativo` int NOT NULL,
  `no_duca` int NOT NULL,
  `fecha_aceptacion` datetime NOT NULL,
  `nombre_transportista` varchar(150) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `modo_transporte` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `pais _procedencia` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `pais_destino` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `pais _exportacion` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_compra` int NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_error_log`
--

CREATE TABLE `tbl_error_log` (
  `id_error_log` int NOT NULL,
  `controller` varchar(50) NOT NULL,
  `mensaje` text NOT NULL,
  `us_id` int NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `id_inventario` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `id_producto` int NOT NULL,
  `existencia` int NOT NULL,
  `existencia_original` int NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kardex`
--

CREATE TABLE `tbl_kardex` (
  `id_kardex` int NOT NULL,
  `id_documento` int NOT NULL,
  `cod_documento` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `num_documento` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `tipo_documento` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marcas`
--

CREATE TABLE `tbl_marcas` (
  `id_marca` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_municipios`
--

CREATE TABLE `tbl_municipios` (
  `id_municipio` int NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `id_departamento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_municipios`
--

INSERT INTO `tbl_municipios` (`id_municipio`, `nombre`, `id_departamento`) VALUES
(1, 'Ahuachapán', 1),
(2, 'Jujutla', 1),
(3, 'Atiquizaya', 1),
(4, 'Concepción de Ataco', 1),
(5, 'El Refugio', 1),
(6, 'Guaymango', 1),
(7, 'Apaneca', 1),
(8, 'San Francisco Menéndez', 1),
(9, 'San Lorenzo', 1),
(10, 'San Pedro Puxtla', 1),
(11, 'Tacuba', 1),
(12, 'Turín', 1),
(13, 'Candelaria de la Frontera', 2),
(14, 'Chalchuapa', 2),
(15, 'Coatepeque', 2),
(16, 'El Congo', 2),
(17, 'El Porvenir', 2),
(18, 'Masahuat', 2),
(19, 'Metapán', 2),
(20, 'San Antonio Pajonal', 2),
(21, 'San Sebastián Salitrillo', 2),
(22, 'Santa Ana', 2),
(23, 'Santa Rosa Guachipilín', 2),
(24, 'Santiago de la Frontera', 2),
(25, 'Texistepeque', 2),
(26, 'Acajutla', 3),
(27, 'Armenia', 3),
(28, 'Caluco', 3),
(29, 'Cuisnahuat', 3),
(30, 'Izalco', 3),
(31, 'Juayúa', 3),
(32, 'Nahuizalco', 3),
(33, 'Nahulingo', 3),
(34, 'Salcoatitán', 3),
(35, 'San Antonio del Monte', 3),
(36, 'San Julián', 3),
(37, 'Santa Catarina Masahuat', 3),
(38, 'Santa Isabel Ishuatán', 3),
(39, 'Santo Domingo de Guzmán', 3),
(40, 'Sonsonate', 3),
(41, 'Sonzacate', 3),
(42, 'Alegría', 11),
(43, 'Berlín', 11),
(44, 'California', 11),
(45, 'Concepción Batres', 11),
(46, 'El Triunfo', 11),
(47, 'Ereguayquín', 11),
(48, 'Estanzuelas', 11),
(49, 'Jiquilisco', 11),
(50, 'Jucuapa', 11),
(51, 'Jucuarán', 11),
(52, 'Mercedes Umaña', 11),
(53, 'Nueva Granada', 11),
(54, 'Ozatlán', 11),
(55, 'Puerto El Triunfo', 11),
(56, 'San Agustín', 11),
(57, 'San Buenaventura', 11),
(58, 'San Dionisio', 11),
(59, 'San Francisco Javier', 11),
(60, 'Santa Elena', 11),
(61, 'Santa María', 11),
(62, 'Santiago de María', 11),
(63, 'Tecapán', 11),
(64, 'Usulután', 11),
(65, 'Carolina', 12),
(66, 'Chapeltique', 12),
(67, 'Chinameca', 12),
(68, 'Chirilagua', 12),
(69, 'Ciudad Barrios', 12),
(70, 'Comacarán', 12),
(71, 'El Tránsito', 12),
(72, 'Lolotique', 12),
(73, 'Moncagua', 12),
(74, 'Nueva Guadalupe', 12),
(75, 'Nuevo Edén de San Juan', 12),
(76, 'Quelepa', 12),
(77, 'San Antonio del Mosco', 12),
(78, 'San Gerardo', 12),
(79, 'San Jorge', 12),
(80, 'San Luis de la Reina', 12),
(81, 'San Miguel', 12),
(82, 'San Rafael Oriente', 12),
(83, 'Sesori', 12),
(84, 'Uluazapa', 12),
(85, 'Arambala', 13),
(86, 'Cacaopera', 13),
(87, 'Chilanga', 13),
(88, 'Corinto', 13),
(89, 'Delicias de Concepción', 13),
(90, 'El Divisadero', 13),
(91, 'El Rosario (Morazán)', 13),
(92, 'Gualococti', 13),
(93, 'Guatajiagua', 13),
(94, 'Joateca', 13),
(95, 'Jocoaitique', 13),
(96, 'Jocoro', 13),
(97, 'Lolotiquillo', 13),
(98, 'Meanguera', 13),
(99, 'Osicala', 13),
(100, 'Perquín', 13),
(101, 'San Carlos', 13),
(102, 'San Fernando (Morazán)', 13),
(103, 'San Francisco Gotera', 13),
(104, 'San Isidro (Morazán)', 13),
(105, 'San Simón', 13),
(106, 'Sensembra', 13),
(107, 'Sociedad', 13),
(108, 'Torola', 13),
(109, 'Yamabal', 13),
(110, 'Yoloaiquín', 13),
(111, 'La Unión', 14),
(112, 'San Alejo', 14),
(113, 'Yucuaiquín', 14),
(114, 'Conchagua', 14),
(115, 'Intipucá', 14),
(116, 'San José', 14),
(117, 'El Carmen (La Unión)', 14),
(118, 'Yayantique', 14),
(119, 'Bolívar', 14),
(120, 'Meanguera del Golfo', 14),
(121, 'Santa Rosa de Lima', 14),
(122, 'Pasaquina', 14),
(123, 'Anamoros', 14),
(124, 'Nueva Esparta', 14),
(125, 'El Sauce', 14),
(126, 'Concepción de Oriente', 14),
(127, 'Polorós', 14),
(128, 'Lislique', 14),
(129, 'Antiguo Cuscatlán', 5),
(130, 'Chiltiupán', 5),
(131, 'Ciudad Arce', 5),
(132, 'Colón', 5),
(133, 'Comasagua', 5),
(134, 'Huizúcar', 5),
(135, 'Jayaque', 5),
(136, 'Jicalapa', 5),
(137, 'La Libertad', 5),
(138, 'Santa Tecla', 5),
(139, 'Nuevo Cuscatlán', 5),
(140, 'San Juan Opico', 5),
(141, 'Quezaltepeque', 5),
(142, 'Sacacoyo', 5),
(143, 'San José Villanueva', 5),
(144, 'San Matías', 5),
(145, 'San Pablo Tacachico', 5),
(146, 'Talnique', 5),
(147, 'Tamanique', 5),
(148, 'Teotepeque', 5),
(149, 'Tepecoyo', 5),
(150, 'Zaragoza', 5),
(151, 'Agua Caliente', 4),
(152, 'Arcatao', 4),
(153, 'Azacualpa', 4),
(154, 'Cancasque', 4),
(155, 'Chalatenango', 4),
(156, 'Citalá', 4),
(157, 'Comapala', 4),
(158, 'Concepción Quezaltepeque', 4),
(159, 'Dulce Nombre de María', 4),
(160, 'El Carrizal', 4),
(161, 'El Paraíso', 4),
(162, 'La Laguna', 4),
(163, 'La Palma', 4),
(164, 'La Reina', 4),
(165, 'Las Vueltas', 4),
(166, 'Nueva Concepción', 4),
(167, 'Nueva Trinidad', 4),
(168, 'Nombre de Jesús', 4),
(169, 'Ojos de Agua', 4),
(170, 'Potonico', 4),
(171, 'San Antonio de la Cruz', 4),
(172, 'San Antonio Los Ranchos', 4),
(173, 'San Fernando', 4),
(174, 'San Francisco Lempa', 4),
(175, 'San Francisco Morazán', 4),
(176, 'San Ignacio', 4),
(177, 'San Isidro Labrador', 4),
(178, 'Las Flores', 4),
(179, 'San Luis del Carmen', 4),
(180, 'San Miguel de Mercedes', 4),
(181, 'San Rafael', 4),
(182, 'Santa Rita', 4),
(183, 'Tejutla', 4),
(184, 'Cojutepeque', 7),
(185, 'Candelaria', 7),
(186, 'El Carmen (Cuscatlán)', 7),
(187, 'El Rosario (Cuscatlán)', 7),
(188, 'Monte San Juan', 7),
(189, 'Oratorio de Concepción', 7),
(190, 'San Bartolomé Perulapía', 7),
(191, 'San Cristóbal', 7),
(192, 'San José Guayabal', 7),
(193, 'San Pedro Perulapán', 7),
(194, 'San Rafael Cedros', 7),
(195, 'San Ramón', 7),
(196, 'Santa Cruz Analquito', 7),
(197, 'Santa Cruz Michapa', 7),
(198, 'Suchitoto', 7),
(199, 'Tenancingo', 7),
(200, 'Aguilares', 6),
(201, 'Apopa', 6),
(202, 'Ayutuxtepeque', 6),
(203, 'Cuscatancingo', 6),
(204, 'Ciudad Delgado', 6),
(205, 'El Paisnal', 6),
(206, 'Guazapa', 6),
(207, 'Ilopango', 6),
(208, 'Mejicanos', 6),
(209, 'Nejapa', 6),
(210, 'Panchimalco', 6),
(211, 'Rosario de Mora', 6),
(212, 'San Marcos', 6),
(213, 'San Martín', 6),
(214, 'San Salvador', 6),
(215, 'Santiago Texacuangos', 6),
(216, 'Santo Tomás', 6),
(217, 'Soyapango', 6),
(218, 'Tonacatepeque', 6),
(219, 'Zacatecoluca', 8),
(220, 'Cuyultitán', 8),
(221, 'El Rosario (La Paz)', 8),
(222, 'Jerusalén', 8),
(223, 'Mercedes La Ceiba', 8),
(224, 'Olocuilta', 8),
(225, 'Paraíso de Osorio', 8),
(226, 'San Antonio Masahuat', 8),
(227, 'San Emigdio', 8),
(228, 'San Francisco Chinameca', 8),
(229, 'San Pedro Masahuat', 8),
(230, 'San Juan Nonualco', 8),
(231, 'San Juan Talpa', 8),
(232, 'San Juan Tepezontes', 8),
(233, 'San Luis La Herradura', 8),
(234, 'San Luis Talpa', 8),
(235, 'San Miguel Tepezontes', 8),
(236, 'San Pedro Nonualco', 8),
(237, 'San Rafael Obrajuelo', 8),
(238, 'Santa María Ostuma', 8),
(239, 'Santiago Nonualco', 8),
(240, 'Tapalhuaca', 8),
(241, 'Cinquera', 9),
(242, 'Dolores', 9),
(243, 'Guacotecti', 9),
(244, 'Ilobasco', 9),
(245, 'Jutiapa', 9),
(246, 'San Isidro (Cabañas)', 9),
(247, 'Sensuntepeque', 9),
(248, 'Tejutepeque', 9),
(249, 'Victoria', 9),
(250, 'Apastepeque', 10),
(251, 'Guadalupe', 10),
(252, 'San Cayetano Istepeque', 10),
(253, 'San Esteban Catarina', 10),
(254, 'San Ildefonso', 10),
(255, 'San Lorenzo', 10),
(256, 'San Sebastián', 10),
(257, 'San Vicente', 10),
(258, 'Santa Clara', 10),
(259, 'Santo Domingo', 10),
(260, 'Tecoluca', 10),
(261, 'Tepetitán', 10),
(262, 'Verapaz', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ordenes`
--

CREATE TABLE `tbl_ordenes` (
  `id_orden` int NOT NULL,
  `codigo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `id_cliente` int NOT NULL,
  `id_direccion` int NOT NULL,
  `fecha` date NOT NULL,
  `anulado` tinyint NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id_producto` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `sku` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci,
  `precio` decimal(10,2) NOT NULL,
  `id_categoria` int NOT NULL,
  `id_sub_categoria` int NOT NULL,
  `id_marca` int NOT NULL,
  `is_car` tinyint(1) NOT NULL,
  `vin` varchar(17) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `pais_procedencia` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `chasis_grabado` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `year` int NOT NULL,
  `tipo_combustible` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `id_condicion` int NOT NULL,
  `iva` float DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productos_imagenes`
--

CREATE TABLE `tbl_productos_imagenes` (
  `id_producto_imagen` int NOT NULL,
  `id_producto` int NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `fecha_ing` datetime NOT NULL,
  `id_usuario_ing` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proveedores`
--

CREATE TABLE `tbl_proveedores` (
  `id_proveedor` int NOT NULL,
  `codigo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci,
  `id_departamento` int NOT NULL,
  `id_municipio` int NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `giro` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `nit` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `dui` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nrc` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `nacionalidad` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `direccion_personal` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `direccion_comercial` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `razon_social` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `contribuyente` tinyint(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `fecha_mod` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_categorias`
--

CREATE TABLE `tbl_sub_categorias` (
  `id_sub_categoria` int NOT NULL,
  `id_categoria` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `username`, `nombre`, `apellido`, `auth_key`, `password_hash`, `email`, `imagen`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', 'AxK42pI4nqEvIyBOBUJVfSR9oRTq-chL', '$2y$13$vfsku0ucja/nzCddYYjL3upKL9uDe/gUyNXK0gqTX0eJ7nFTRIrEu', 'admin@outlook.com', '/avatars/7A5_ev7RvHv5CzTWNZxOLeGpVGZM-ZZv.gif', 1, 1677203598, 1677203598),
(2, 'Demo', 'demo', 'Demo', '_LDZ2AUvtDDoy36zC6bJhNgJRM9rYO3D', '$2y$13$hGFn5B62kUT0kmTZtQS8We5sIj0vsg1mDH/dyf/j1tZVatVcD4khi', 'demo@outlook.com', '/avatars/default.png', 1, 1677203935, 1677203935);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ventas`
--

CREATE TABLE `tbl_ventas` (
  `id_venta` int NOT NULL,
  `id_orden` int NOT NULL,
  `codigo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `num_factura` int NOT NULL,
  `tipo_venta` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  `comentarios` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `tbl_categoiras_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_categoiras_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `tbl_clientes_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_clientes_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `tbl_compras_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_compras_fk_id_usuario_mod` (`id_usuario_mod`),
  ADD KEY `tbl_compras_fk_id_proveedor` (`id_proveedor`);

--
-- Indexes for table `tbl_condicion_producto`
--
ALTER TABLE `tbl_condicion_producto`
  ADD PRIMARY KEY (`id_condicion`),
  ADD KEY `id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_departamentos`
--
ALTER TABLE `tbl_departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indexes for table `tbl_det_compras`
--
ALTER TABLE `tbl_det_compras`
  ADD PRIMARY KEY (`id_det_compra`),
  ADD KEY `tbl_det_compras_fk_id_compra` (`id_compra`),
  ADD KEY `tbl_det_compras_fk_id_producto` (`id_producto`),
  ADD KEY `tbl_det_compras_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_det_compras_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_det_ordenes`
--
ALTER TABLE `tbl_det_ordenes`
  ADD PRIMARY KEY (`id_det_orden`),
  ADD KEY `tbl_det_ordenes_fk_id_orden` (`id_orden`),
  ADD KEY `tbl_det_ordenes_fk_id_producto` (`id_producto`),
  ADD KEY `tbl_det_ordenes_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_det_ordenes_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `tbl_direcciones_fk_id_cliente` (`id_cliente`),
  ADD KEY `tbl_direcciones_fk_id_departamento` (`id_departamento`),
  ADD KEY `tbl_direcciones_fk_id_municipio` (`id_municipio`),
  ADD KEY `tbl_direcciones_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_direcciones_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_duca`
--
ALTER TABLE `tbl_duca`
  ADD PRIMARY KEY (`id_duca`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_error_log`
--
ALTER TABLE `tbl_error_log`
  ADD PRIMARY KEY (`id_error_log`),
  ADD KEY `us_id` (`us_id`);

--
-- Indexes for table `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `tbl_inventario_id_producto` (`id_producto`),
  ADD KEY `tbl_inventario_id_usuario_ing` (`id_usuario_ing`);

--
-- Indexes for table `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  ADD PRIMARY KEY (`id_kardex`),
  ADD KEY `tbl_kardex_id_producto` (`id_producto`),
  ADD KEY `tbl_kardex_id_usuario_ing` (`id_usuario_ing`);

--
-- Indexes for table `tbl_marcas`
--
ALTER TABLE `tbl_marcas`
  ADD PRIMARY KEY (`id_marca`),
  ADD KEY `tbl_marcas_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `fk_marcas_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indexes for table `tbl_ordenes`
--
ALTER TABLE `tbl_ordenes`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `tbl_ordenes_fk_id_cliente` (`id_cliente`),
  ADD KEY `tbl_ordenes_fk_id_direccion` (`id_direccion`),
  ADD KEY `tbl_ordenes_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_ordenes_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `tbl_producto_fk_id_categoria` (`id_categoria`),
  ADD KEY `tbl_producto_fk_id_sub_categoria` (`id_sub_categoria`),
  ADD KEY `tbl_producto_fk_id_marca` (`id_marca`),
  ADD KEY `tbl_producto_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_producto_fk_id_usuario_mod` (`id_usuario_mod`),
  ADD KEY `id_condicion` (`id_condicion`);

--
-- Indexes for table `tbl_productos_imagenes`
--
ALTER TABLE `tbl_productos_imagenes`
  ADD PRIMARY KEY (`id_producto_imagen`),
  ADD KEY `tbl_productos_imagenes_fk_id_producto` (`id_producto`),
  ADD KEY `tbl_productos_imagenes_fk_id_usuario_ing` (`id_usuario_ing`);

--
-- Indexes for table `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `tbl_proveedores_fk_id_departamento` (`id_departamento`),
  ADD KEY `tbl_proveedores_fk_id_municipio` (`id_municipio`),
  ADD KEY `tbl_proveedores_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_proveedores_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_sub_categorias`
--
ALTER TABLE `tbl_sub_categorias`
  ADD PRIMARY KEY (`id_sub_categoria`),
  ADD KEY `tbl_sub_categorias_fk_id_categoria` (`id_categoria`),
  ADD KEY `tbl_sub_categorias_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_sub_categorias_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- Indexes for table `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `tbl_ventas_fk_id_orden` (`id_orden`),
  ADD KEY `tbl_ventas_fk_id_usuario_ing` (`id_usuario_ing`),
  ADD KEY `tbl_ventas_fk_id_usuario_mod` (`id_usuario_mod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  MODIFY `id_bitacora` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_compras`
--
ALTER TABLE `tbl_compras`
  MODIFY `id_compra` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_condicion_producto`
--
ALTER TABLE `tbl_condicion_producto`
  MODIFY `id_condicion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_departamentos`
--
ALTER TABLE `tbl_departamentos`
  MODIFY `id_departamento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_det_compras`
--
ALTER TABLE `tbl_det_compras`
  MODIFY `id_det_compra` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_det_ordenes`
--
ALTER TABLE `tbl_det_ordenes`
  MODIFY `id_det_orden` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  MODIFY `id_direccion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_duca`
--
ALTER TABLE `tbl_duca`
  MODIFY `id_duca` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `id_inventario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  MODIFY `id_kardex` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_marcas`
--
ALTER TABLE `tbl_marcas`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  MODIFY `id_municipio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `tbl_ordenes`
--
ALTER TABLE `tbl_ordenes`
  MODIFY `id_orden` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_productos_imagenes`
--
ALTER TABLE `tbl_productos_imagenes`
  MODIFY `id_producto_imagen` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  MODIFY `id_proveedor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sub_categorias`
--
ALTER TABLE `tbl_sub_categorias`
  MODIFY `id_sub_categoria` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  MODIFY `id_venta` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD CONSTRAINT `tbl_bitacora_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD CONSTRAINT `tbl_categoiras_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_categoiras_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD CONSTRAINT `tbl_clientes_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_clientes_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `tbl_compras_fk_id_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id_proveedor`),
  ADD CONSTRAINT `tbl_compras_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_compras_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_condicion_producto`
--
ALTER TABLE `tbl_condicion_producto`
  ADD CONSTRAINT `tbl_condicion_producto_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_condicion_producto_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_det_compras`
--
ALTER TABLE `tbl_det_compras`
  ADD CONSTRAINT `tbl_det_compras_fk_id_compra` FOREIGN KEY (`id_compra`) REFERENCES `tbl_compras` (`id_compra`),
  ADD CONSTRAINT `tbl_det_compras_fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_det_compras_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_det_compras_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_det_ordenes`
--
ALTER TABLE `tbl_det_ordenes`
  ADD CONSTRAINT `tbl_det_ordenes_fk_id_orden` FOREIGN KEY (`id_orden`) REFERENCES `tbl_ordenes` (`id_orden`),
  ADD CONSTRAINT `tbl_det_ordenes_fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_det_ordenes_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_det_ordenes_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  ADD CONSTRAINT `tbl_direcciones_fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`),
  ADD CONSTRAINT `tbl_direcciones_fk_id_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `tbl_departamentos` (`id_departamento`),
  ADD CONSTRAINT `tbl_direcciones_fk_id_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `tbl_municipios` (`id_municipio`),
  ADD CONSTRAINT `tbl_direcciones_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_direcciones_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_duca`
--
ALTER TABLE `tbl_duca`
  ADD CONSTRAINT `tbl_duca_fk_id_compra` FOREIGN KEY (`id_compra`) REFERENCES `tbl_compras` (`id_compra`),
  ADD CONSTRAINT `tbl_duca_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_duca_ibfk_1` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_error_log`
--
ALTER TABLE `tbl_error_log`
  ADD CONSTRAINT `tbl_error_log_ibfk_1` FOREIGN KEY (`us_id`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD CONSTRAINT `tbl_inventario_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_inventario_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  ADD CONSTRAINT `tbl_kardex_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_kardex_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_marcas`
--
ALTER TABLE `tbl_marcas`
  ADD CONSTRAINT `fk_marcas_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_marcas_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  ADD CONSTRAINT `tbl_municipios_fk_id_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `tbl_departamentos` (`id_departamento`);

--
-- Constraints for table `tbl_ordenes`
--
ALTER TABLE `tbl_ordenes`
  ADD CONSTRAINT `tbl_ordenes_fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`),
  ADD CONSTRAINT `tbl_ordenes_fk_id_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `tbl_direcciones` (`id_direccion`),
  ADD CONSTRAINT `tbl_ordenes_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_ordenes_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_producto_fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`),
  ADD CONSTRAINT `tbl_producto_fk_id_condicion` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condicion_producto` (`id_condicion`),
  ADD CONSTRAINT `tbl_producto_fk_id_marca` FOREIGN KEY (`id_marca`) REFERENCES `tbl_marcas` (`id_marca`),
  ADD CONSTRAINT `tbl_producto_fk_id_sub_categoria` FOREIGN KEY (`id_sub_categoria`) REFERENCES `tbl_sub_categorias` (`id_sub_categoria`),
  ADD CONSTRAINT `tbl_producto_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_producto_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_productos_imagenes`
--
ALTER TABLE `tbl_productos_imagenes`
  ADD CONSTRAINT `tbl_productos_imagenes_fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_productos_imagenes_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD CONSTRAINT `tbl_proveedores_fk_id_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `tbl_departamentos` (`id_departamento`),
  ADD CONSTRAINT `tbl_proveedores_fk_id_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `tbl_municipios` (`id_municipio`),
  ADD CONSTRAINT `tbl_proveedores_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_proveedores_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_sub_categorias`
--
ALTER TABLE `tbl_sub_categorias`
  ADD CONSTRAINT `tbl_sub_categorias_fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`),
  ADD CONSTRAINT `tbl_sub_categorias_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_sub_categorias_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD CONSTRAINT `tbl_ventas_fk_id_orden` FOREIGN KEY (`id_orden`) REFERENCES `tbl_ordenes` (`id_orden`),
  ADD CONSTRAINT `tbl_ventas_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_ventas_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
