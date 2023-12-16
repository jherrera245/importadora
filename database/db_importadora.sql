-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-12-2023 a las 17:00:59
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_importadora`
--
CREATE DATABASE IF NOT EXISTS `db_importadora` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `db_importadora`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrador', '1', 1677807726),
('DemoRol', '2', 1677807737);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
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
-- Estructura de tabla para la tabla `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
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
-- Estructura de tabla para la tabla `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bitacora`
--

DROP TABLE IF EXISTS `tbl_bitacora`;
CREATE TABLE IF NOT EXISTS `tbl_bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro` int(11) NOT NULL,
  `controlador` varchar(25) NOT NULL,
  `accion` varchar(25) NOT NULL,
  `data_original` json DEFAULT NULL,
  `data_modificada` json DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

DROP TABLE IF EXISTS `tbl_categorias`;
CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `tbl_categoiras_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_categoiras_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

DROP TABLE IF EXISTS `tbl_clientes`;
CREATE TABLE IF NOT EXISTS `tbl_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `tbl_clientes_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_clientes_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras`
--

DROP TABLE IF EXISTS `tbl_compras`;
CREATE TABLE IF NOT EXISTS `tbl_compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `num_factura` int(8) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `tipo_compra` tinyint(4) NOT NULL,
  `fecha` date NOT NULL,
  `anulado` tinyint(4) NOT NULL DEFAULT '0',
  `comentarios` text COLLATE utf8_spanish2_ci,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `tbl_compras_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_compras_fk_id_usuario_mod` (`id_usuario_mod`),
  KEY `tbl_compras_fk_id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_departamentos`
--

DROP TABLE IF EXISTS `tbl_departamentos`;
CREATE TABLE IF NOT EXISTS `tbl_departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `codigo` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_departamentos`
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
-- Estructura de tabla para la tabla `tbl_det_compras`
--

DROP TABLE IF EXISTS `tbl_det_compras`;
CREATE TABLE IF NOT EXISTS `tbl_det_compras` (
  `id_det_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `uuid` varchar(36) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_compra`),
  KEY `tbl_det_compras_fk_id_compra` (`id_compra`),
  KEY `tbl_det_compras_fk_id_producto` (`id_producto`),
  KEY `tbl_det_compras_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_det_compras_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_det_ordenes`
--

DROP TABLE IF EXISTS `tbl_det_ordenes`;
CREATE TABLE IF NOT EXISTS `tbl_det_ordenes` (
  `id_det_orden` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `uuid` varchar(36) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_orden`),
  KEY `tbl_det_ordenes_fk_id_orden` (`id_orden`),
  KEY `tbl_det_ordenes_fk_id_producto` (`id_producto`),
  KEY `tbl_det_ordenes_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_det_ordenes_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direcciones`
--

DROP TABLE IF EXISTS `tbl_direcciones`;
CREATE TABLE IF NOT EXISTS `tbl_direcciones` (
  `id_direccion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `contacto` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_direccion`),
  KEY `tbl_direcciones_fk_id_cliente` (`id_cliente`),
  KEY `tbl_direcciones_fk_id_departamento` (`id_departamento`),
  KEY `tbl_direcciones_fk_id_municipio` (`id_municipio`),
  KEY `tbl_direcciones_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_direcciones_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_error_log`
--

DROP TABLE IF EXISTS `tbl_error_log`;
CREATE TABLE IF NOT EXISTS `tbl_error_log` (
  `id_error_log` int(11) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `mensaje` text NOT NULL,
  `us_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_error_log`),
  KEY `us_id` (`us_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

DROP TABLE IF EXISTS `tbl_inventario`;
CREATE TABLE IF NOT EXISTS `tbl_inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) COLLATE utf8_spanish2_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `existencia_original` int(11) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inventario`),
  KEY `tbl_inventario_id_producto` (`id_producto`),
  KEY `tbl_inventario_id_usuario_ing` (`id_usuario_ing`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_kardex`
--

DROP TABLE IF EXISTS `tbl_kardex`;
CREATE TABLE IF NOT EXISTS `tbl_kardex` (
  `id_kardex` int(11) NOT NULL AUTO_INCREMENT,
  `id_documento` int(11) NOT NULL,
  `cod_documento` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `num_documento` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_documento` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `uuid` varchar(36) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kardex`),
  KEY `tbl_kardex_id_producto` (`id_producto`),
  KEY `tbl_kardex_id_usuario_ing` (`id_usuario_ing`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_marcas`
--

DROP TABLE IF EXISTS `tbl_marcas`;
CREATE TABLE IF NOT EXISTS `tbl_marcas` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_marca`),
  KEY `tbl_marcas_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `fk_marcas_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_municipios`
--

DROP TABLE IF EXISTS `tbl_municipios`;
CREATE TABLE IF NOT EXISTS `tbl_municipios` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `id_departamento` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_municipios`
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
-- Estructura de tabla para la tabla `tbl_ordenes`
--

DROP TABLE IF EXISTS `tbl_ordenes`;
CREATE TABLE IF NOT EXISTS `tbl_ordenes` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `anulado` tinyint(4) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `tbl_ordenes_fk_id_cliente` (`id_cliente`),
  KEY `tbl_ordenes_fk_id_direccion` (`id_direccion`),
  KEY `tbl_ordenes_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_ordenes_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

DROP TABLE IF EXISTS `tbl_productos`;
CREATE TABLE IF NOT EXISTS `tbl_productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `sku` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `precio` decimal(10,2) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_sub_categoria` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `tbl_producto_fk_id_categoria` (`id_categoria`),
  KEY `tbl_producto_fk_id_sub_categoria` (`id_sub_categoria`),
  KEY `tbl_producto_fk_id_marca` (`id_marca`),
  KEY `tbl_producto_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_producto_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_imagenes`
--

DROP TABLE IF EXISTS `tbl_productos_imagenes`;
CREATE TABLE IF NOT EXISTS `tbl_productos_imagenes` (
  `id_producto_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `fecha_ing` datetime NOT NULL,
  `id_usuario_ing` int(11) NOT NULL,
  PRIMARY KEY (`id_producto_imagen`),
  KEY `tbl_productos_imagenes_fk_id_producto` (`id_producto`),
  KEY `tbl_productos_imagenes_fk_id_usuario_ing` (`id_usuario_ing`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedores`
--

DROP TABLE IF EXISTS `tbl_proveedores`;
CREATE TABLE IF NOT EXISTS `tbl_proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `id_departamento` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `fecha_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_proveedor`),
  KEY `tbl_proveedores_fk_id_departamento` (`id_departamento`),
  KEY `tbl_proveedores_fk_id_municipio` (`id_municipio`),
  KEY `tbl_proveedores_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_proveedores_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sub_categorias`
--

DROP TABLE IF EXISTS `tbl_sub_categorias`;
CREATE TABLE IF NOT EXISTS `tbl_sub_categorias` (
  `id_sub_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_sub_categoria`),
  KEY `tbl_sub_categorias_fk_id_categoria` (`id_categoria`),
  KEY `tbl_sub_categorias_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_sub_categorias_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `username`, `nombre`, `apellido`, `auth_key`, `password_hash`, `email`, `imagen`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', 'AxK42pI4nqEvIyBOBUJVfSR9oRTq-chL', '$2y$13$vfsku0ucja/nzCddYYjL3upKL9uDe/gUyNXK0gqTX0eJ7nFTRIrEu', 'admin@outlook.com', '/avatars/7A5_ev7RvHv5CzTWNZxOLeGpVGZM-ZZv.gif', 1, 1677203598, 1677203598),
(2, 'Demo', 'demo', 'Demo', '_LDZ2AUvtDDoy36zC6bJhNgJRM9rYO3D', '$2y$13$hGFn5B62kUT0kmTZtQS8We5sIj0vsg1mDH/dyf/j1tZVatVcD4khi', 'demo@outlook.com', '/avatars/default.png', 1, 1677203935, 1677203935);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ventas`
--

DROP TABLE IF EXISTS `tbl_ventas`;
CREATE TABLE IF NOT EXISTS `tbl_ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden` int(11) NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `num_factura` int(8) NOT NULL,
  `tipo_venta` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  `comentarios` text COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int(11) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `tbl_ventas_fk_id_orden` (`id_orden`),
  KEY `tbl_ventas_fk_id_usuario_ing` (`id_usuario_ing`),
  KEY `tbl_ventas_fk_id_usuario_mod` (`id_usuario_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Restricciones para tablas volcadas
--

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
-- Filtros para la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD CONSTRAINT `tbl_bitacora_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD CONSTRAINT `tbl_categoiras_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_categoiras_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD CONSTRAINT `tbl_clientes_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_clientes_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `tbl_compras_fk_id_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id_proveedor`),
  ADD CONSTRAINT `tbl_compras_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_compras_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_det_compras`
--
ALTER TABLE `tbl_det_compras`
  ADD CONSTRAINT `tbl_det_compras_fk_id_compra` FOREIGN KEY (`id_compra`) REFERENCES `tbl_compras` (`id_compra`),
  ADD CONSTRAINT `tbl_det_compras_fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_det_compras_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_det_compras_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_det_ordenes`
--
ALTER TABLE `tbl_det_ordenes`
  ADD CONSTRAINT `tbl_det_ordenes_fk_id_orden` FOREIGN KEY (`id_orden`) REFERENCES `tbl_ordenes` (`id_orden`),
  ADD CONSTRAINT `tbl_det_ordenes_fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_det_ordenes_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_det_ordenes_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  ADD CONSTRAINT `tbl_direcciones_fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`),
  ADD CONSTRAINT `tbl_direcciones_fk_id_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `tbl_departamentos` (`id_departamento`),
  ADD CONSTRAINT `tbl_direcciones_fk_id_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `tbl_municipios` (`id_municipio`),
  ADD CONSTRAINT `tbl_direcciones_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_direcciones_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_error_log`
--
ALTER TABLE `tbl_error_log`
  ADD CONSTRAINT `tbl_error_log_ibfk_1` FOREIGN KEY (`us_id`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD CONSTRAINT `tbl_inventario_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_inventario_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  ADD CONSTRAINT `tbl_kardex_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_kardex_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_marcas`
--
ALTER TABLE `tbl_marcas`
  ADD CONSTRAINT `fk_marcas_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_marcas_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  ADD CONSTRAINT `tbl_municipios_fk_id_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `tbl_departamentos` (`id_departamento`);

--
-- Filtros para la tabla `tbl_ordenes`
--
ALTER TABLE `tbl_ordenes`
  ADD CONSTRAINT `tbl_ordenes_fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`),
  ADD CONSTRAINT `tbl_ordenes_fk_id_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `tbl_direcciones` (`id_direccion`),
  ADD CONSTRAINT `tbl_ordenes_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_ordenes_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_producto_fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`),
  ADD CONSTRAINT `tbl_producto_fk_id_marca` FOREIGN KEY (`id_marca`) REFERENCES `tbl_marcas` (`id_marca`),
  ADD CONSTRAINT `tbl_producto_fk_id_sub_categoria` FOREIGN KEY (`id_sub_categoria`) REFERENCES `tbl_sub_categorias` (`id_sub_categoria`),
  ADD CONSTRAINT `tbl_producto_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_producto_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_productos_imagenes`
--
ALTER TABLE `tbl_productos_imagenes`
  ADD CONSTRAINT `tbl_productos_imagenes_fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`),
  ADD CONSTRAINT `tbl_productos_imagenes_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD CONSTRAINT `tbl_proveedores_fk_id_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `tbl_departamentos` (`id_departamento`),
  ADD CONSTRAINT `tbl_proveedores_fk_id_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `tbl_municipios` (`id_municipio`),
  ADD CONSTRAINT `tbl_proveedores_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_proveedores_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_sub_categorias`
--
ALTER TABLE `tbl_sub_categorias`
  ADD CONSTRAINT `tbl_sub_categorias_fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`),
  ADD CONSTRAINT `tbl_sub_categorias_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_sub_categorias_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD CONSTRAINT `tbl_ventas_fk_id_orden` FOREIGN KEY (`id_orden`) REFERENCES `tbl_ordenes` (`id_orden`),
  ADD CONSTRAINT `tbl_ventas_fk_id_usuario_ing` FOREIGN KEY (`id_usuario_ing`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_ventas_fk_id_usuario_mod` FOREIGN KEY (`id_usuario_mod`) REFERENCES `tbl_usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
