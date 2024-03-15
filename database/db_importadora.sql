-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2024 at 06:06 AM
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
('/compras/duca/*', 2, NULL, NULL, NULL, 1707282156, 1707282156),
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
('PermisoAdmin', '/compras/duca/*'),
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

--
-- Dumping data for table `tbl_bitacora`
--

INSERT INTO `tbl_bitacora` (`id_bitacora`, `id_registro`, `controlador`, `accion`, `data_original`, `data_modificada`, `id_usuario`, `fecha`) VALUES
(1, 1, 'clientes', 'create', '\"{\\n    \\\"id_cliente\\\": 1,\\n    \\\"nombre\\\": \\\"Cesar Mauricio\\\",\\n    \\\"apellido\\\": \\\"Martinez Reyes\\\",\\n    \\\"telefono\\\": \\\"7241-9858\\\",\\n    \\\"email\\\": \\\"mauricio@gmail.com\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-04 23:28:42\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-04 23:28:42\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', NULL, 1, '2024-01-04 23:28:42'),
(2, 1, 'proveedores', 'create', '\"{\\n    \\\"id_proveedor\\\": 1,\\n    \\\"codigo\\\": \\\"Prove0001\\\",\\n    \\\"nombre\\\": \\\"COPART\\\",\\n    \\\"descripcion\\\": \\\"<p>Esta es una empresa que se dedica a la comercializacion de vehiculos<br><\\\\/p>\\\",\\n    \\\"id_departamento\\\": \\\"14\\\",\\n    \\\"id_municipio\\\": \\\"111\\\",\\n    \\\"telefono\\\": \\\"7878-8822\\\",\\n    \\\"email\\\": \\\"copart@gmail.com\\\",\\n    \\\"giro\\\": \\\"Venta de vehiculos\\\",\\n    \\\"nit\\\": \\\"0000-000000-000-1\\\",\\n    \\\"dui\\\": \\\"12234556-7\\\",\\n    \\\"nrc\\\": \\\"777777-7\\\",\\n    \\\"nacionalidad\\\": \\\"EEUU\\\",\\n    \\\"direccion_personal\\\": \\\"<p>Direccion personal 1<br><\\\\/p>\\\",\\n    \\\"direccion_comercial\\\": \\\"<p>Direccion comercial 1<br><\\\\/p>\\\",\\n    \\\"razon_social\\\": \\\"COPART AUTOS ESPA\\\\u00d1A, S.L.U.\\\",\\n    \\\"contribuyente\\\": \\\"1\\\",\\n    \\\"estado\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-04 23:35:11\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-04 23:35:11\\\"\\n}\"', NULL, 1, '2024-01-04 23:35:11'),
(3, 1, 'compras', 'create', '\"{\\n    \\\"id_compra\\\": 1,\\n    \\\"codigo\\\": \\\"CMPR-00001\\\",\\n    \\\"num_factura\\\": \\\"0000001\\\",\\n    \\\"id_proveedor\\\": \\\"1\\\",\\n    \\\"tipo_compra\\\": \\\"0\\\",\\n    \\\"fecha\\\": \\\"2024-1-04\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"Este es un comentario, puede agregar cualquier tipo de informacion en esta parte<br>\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-01-04 23:37:13\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-04 23:37:13\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-01-04 23:37:13'),
(4, 1, 'compras', 'update', '\"{\\n    \\\"id_compra\\\": 1,\\n    \\\"codigo\\\": \\\"CMPR-00001\\\",\\n    \\\"num_factura\\\": \\\"1\\\",\\n    \\\"id_proveedor\\\": \\\"1\\\",\\n    \\\"tipo_compra\\\": \\\"1\\\",\\n    \\\"fecha\\\": \\\"2024-01-04\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"Este es un comentario, puede agregar cualquier tipo de informacion en esta parte<br>\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-01-04 23:37:13\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-04 23:37:13\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"num_factura\\\": \\\"1\\\",\\n    \\\"id_proveedor\\\": \\\"1\\\",\\n    \\\"tipo_compra\\\": \\\"1\\\"\\n}\"', 1, '2024-01-05 09:08:53'),
(5, 1, 'marcas', 'create', '\"{\\n    \\\"id_marca\\\": 1,\\n    \\\"nombre\\\": \\\"Ford\\\",\\n    \\\"descripcion\\\": \\\"<p>Descripci\\\\u00f3n de la marca FORD<br><\\\\/p>\\\",\\n    \\\"imagen\\\": \\\"\\\\/importadora\\\\/web\\\\/marcas\\\\/W_4dY4WioYFagqdWh4YKDmt3bnXw3ROK.png\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 19:34:57\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 19:34:57\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": \\\"0\\\"\\n}\"', NULL, 1, '2024-01-05 19:34:57'),
(6, 1, 'categorias', 'create', '\"{\\n    \\\"id_categoria\\\": 1,\\n    \\\"nombre\\\": \\\"Veh\\\\u00edculo\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 19:36:28\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 19:36:28\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', NULL, 1, '2024-01-05 19:36:28'),
(7, 2, 'categorias', 'create', '\"{\\n    \\\"id_categoria\\\": 2,\\n    \\\"nombre\\\": \\\"Medio de transporte\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 19:37:22\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 19:37:22\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', NULL, 1, '2024-01-05 19:37:22'),
(8, 1, 'sub-categorias', 'create', '\"{\\n    \\\"id_sub_categoria\\\": 1,\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"nombre\\\": \\\"Tractor\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 19:37:38\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 19:37:38\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', NULL, 1, '2024-01-05 19:37:38'),
(9, 1, 'productos', 'create', '\"{\\n    \\\"id_producto\\\": 1,\\n    \\\"nombre\\\": \\\"Tractor ejemplo 1\\\",\\n    \\\"sku\\\": \\\"4225-776-3234\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"precio\\\": \\\"30000\\\",\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"vin\\\": \\\"\\\",\\n    \\\"pais_procedencia\\\": \\\"\\\",\\n    \\\"chasis_grabado\\\": \\\"\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"tipo_combustible\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"estado\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 20:17:31\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 20:17:31\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-01-05 20:17:31'),
(10, 1, 'productos', 'delete', '\"{\\n    \\\"id_producto\\\": 1,\\n    \\\"nombre\\\": \\\"Tractor ejemplo 1\\\",\\n    \\\"sku\\\": \\\"4225-776-3234\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"precio\\\": \\\"30000.00\\\",\\n    \\\"id_categoria\\\": 2,\\n    \\\"id_sub_categoria\\\": 1,\\n    \\\"id_marca\\\": 1,\\n    \\\"is_car\\\": 0,\\n    \\\"vin\\\": \\\"\\\",\\n    \\\"pais_procedencia\\\": \\\"\\\",\\n    \\\"chasis_grabado\\\": \\\"\\\",\\n    \\\"year\\\": null,\\n    \\\"tipo_combustible\\\": \\\"\\\",\\n    \\\"id_condicion\\\": null,\\n    \\\"iva\\\": 13,\\n    \\\"estado\\\": 1,\\n    \\\"fecha_ing\\\": \\\"2024-01-05 20:17:31\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 20:17:31\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"estado\\\": 0\\n}\"', 1, '2024-01-05 20:20:18'),
(11, 2, 'productos', 'create', '\"{\\n    \\\"id_producto\\\": 2,\\n    \\\"nombre\\\": \\\"Tractor ejemplo 1\\\",\\n    \\\"sku\\\": \\\"4225-776-3234\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"precio\\\": \\\"50000\\\",\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"vin\\\": \\\"\\\",\\n    \\\"pais_procedencia\\\": \\\"\\\",\\n    \\\"chasis_grabado\\\": \\\"\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"tipo_combustible\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"estado\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 20:20:47\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 20:20:47\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-01-05 20:20:47'),
(12, 1, 'compras', 'inventario', '\"{\\n    \\\"id_compra\\\": 1,\\n    \\\"codigo\\\": \\\"CMPR-00001\\\",\\n    \\\"num_factura\\\": 1,\\n    \\\"id_proveedor\\\": 1,\\n    \\\"tipo_compra\\\": 1,\\n    \\\"fecha\\\": \\\"2024-01-04\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"Este es un comentario, puede agregar cualquier tipo de informacion en esta parte<br>\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-01-04 23:37:13\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 09:08:53\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"estado\\\": 1\\n}\"', 1, '2024-01-06 20:25:01'),
(13, 2, 'compras', 'create', '\"{\\n    \\\"id_compra\\\": 2,\\n    \\\"codigo\\\": \\\"CMPR-00002\\\",\\n    \\\"num_factura\\\": \\\"2\\\",\\n    \\\"id_proveedor\\\": \\\"1\\\",\\n    \\\"tipo_compra\\\": \\\"1\\\",\\n    \\\"fecha\\\": \\\"2024-1-06\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-01-06 20:25:44\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-06 20:25:44\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-01-06 20:25:44'),
(14, 1, 'productos', 'update', '\"{\\n    \\\"id_producto\\\": 1,\\n    \\\"nombre\\\": \\\"Tractor ejemplo 2\\\",\\n    \\\"sku\\\": \\\"4225-776-3234\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"precio\\\": \\\"30000.00\\\",\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"vin\\\": \\\"\\\",\\n    \\\"pais_procedencia\\\": \\\"\\\",\\n    \\\"chasis_grabado\\\": \\\"\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"tipo_combustible\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"estado\\\": \\\"0\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 20:17:31\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-05 20:20:18\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"nombre\\\": \\\"Tractor ejemplo 2\\\",\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"estado\\\": \\\"0\\\"\\n}\"', 1, '2024-01-06 20:26:05'),
(15, 1, 'productos', 'update', '\"{\\n    \\\"id_producto\\\": 1,\\n    \\\"nombre\\\": \\\"Tractor ejemplo 2\\\",\\n    \\\"sku\\\": \\\"4225-776-3234\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"precio\\\": \\\"30000.00\\\",\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"vin\\\": \\\"\\\",\\n    \\\"pais_procedencia\\\": \\\"\\\",\\n    \\\"chasis_grabado\\\": \\\"\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"tipo_combustible\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"estado\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 20:17:31\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-06 20:26:05\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', 1, '2024-01-06 20:26:13'),
(16, 3, 'compras', 'create', '\"{\\n    \\\"id_compra\\\": 3,\\n    \\\"codigo\\\": \\\"CMPR-00003\\\",\\n    \\\"num_factura\\\": \\\"3\\\",\\n    \\\"id_proveedor\\\": \\\"1\\\",\\n    \\\"tipo_compra\\\": \\\"1\\\",\\n    \\\"fecha\\\": \\\"2024-1-07\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-01-07 18:46:16\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-07 18:46:16\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-01-07 18:46:16'),
(17, 2, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 2,\\n    \\\"id_compra\\\": \\\"3\\\",\\n    \\\"id_producto\\\": \\\"1\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"22000\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": null,\\n    \\\"otros_gastos\\\": null,\\n    \\\"detalle_otros_gastos\\\": null,\\n    \\\"valor_aduana\\\": null,\\n    \\\"dai\\\": null,\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"5278dc9f-169c-472f-b443-0d839efd258b\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-07 19:37:59\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-07 19:37:59\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-01-07 19:37:59'),
(18, 1, 'productos', 'update', '\"{\\n    \\\"id_producto\\\": 1,\\n    \\\"nombre\\\": \\\"Tractor ejemplo 2\\\",\\n    \\\"sku\\\": \\\"4225-776-3234\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"precio\\\": \\\"30000.00\\\",\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"vin\\\": \\\"\\\",\\n    \\\"pais_procedencia\\\": \\\"\\\",\\n    \\\"chasis_grabado\\\": \\\"\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"tipo_combustible\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"\\\",\\n    \\\"estado\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 20:17:31\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-06 20:26:13\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"\\\",\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', 1, '2024-01-07 19:38:26'),
(19, 1, 'productos', 'update', '\"{\\n    \\\"id_producto\\\": 1,\\n    \\\"nombre\\\": \\\"Tractor ejemplo 2\\\",\\n    \\\"sku\\\": \\\"4225-776-3234\\\",\\n    \\\"descripcion\\\": \\\"\\\",\\n    \\\"precio\\\": \\\"30000.00\\\",\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"vin\\\": \\\"\\\",\\n    \\\"pais_procedencia\\\": \\\"\\\",\\n    \\\"chasis_grabado\\\": \\\"\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"tipo_combustible\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"\\\",\\n    \\\"estado\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-05 20:17:31\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-07 19:38:26\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"\\\",\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', 1, '2024-01-07 19:38:50'),
(20, 3, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 3,\\n    \\\"id_compra\\\": \\\"2\\\",\\n    \\\"id_producto\\\": \\\"1\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"30000\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": null,\\n    \\\"otros_gastos\\\": null,\\n    \\\"detalle_otros_gastos\\\": null,\\n    \\\"valor_aduana\\\": null,\\n    \\\"dai\\\": null,\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"32ac0860-0dff-4575-b4eb-6a67095a2e14\\\",\\n    \\\"fecha_ing\\\": \\\"2024-01-07 19:41:31\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-07 19:41:31\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-01-07 19:41:31'),
(21, 3, 'compras', 'inventario', '\"{\\n    \\\"id_compra\\\": 3,\\n    \\\"codigo\\\": \\\"CMPR-00003\\\",\\n    \\\"num_factura\\\": 3,\\n    \\\"id_proveedor\\\": 1,\\n    \\\"tipo_compra\\\": 1,\\n    \\\"fecha\\\": \\\"2024-01-07\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-01-07 18:46:16\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-01-07 18:46:16\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"estado\\\": 1\\n}\"', 1, '2024-02-06 22:15:01'),
(22, 4, 'compras', 'create', '\"{\\n    \\\"id_compra\\\": 4,\\n    \\\"codigo\\\": \\\"CMPR-00004\\\",\\n    \\\"num_factura\\\": \\\"00002\\\",\\n    \\\"id_proveedor\\\": \\\"1\\\",\\n    \\\"tipo_compra\\\": \\\"1\\\",\\n    \\\"fecha\\\": \\\"2024-2-09\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-02-09 15:08:40\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-09 15:08:40\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-02-09 15:08:40'),
(23, 4, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 4,\\n    \\\"id_compra\\\": \\\"4\\\",\\n    \\\"id_producto\\\": \\\"2\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"20000\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": \\\"0.00\\\",\\n    \\\"otros_gastos\\\": \\\"0.00\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"\\\",\\n    \\\"valor_aduana\\\": \\\"0.00\\\",\\n    \\\"dai\\\": \\\"0.00\\\",\\n    \\\"apm\\\": \\\"0.00\\\",\\n    \\\"vts\\\": \\\"0.00\\\",\\n    \\\"its\\\": \\\"0.00\\\",\\n    \\\"aiv\\\": \\\"0.00\\\",\\n    \\\"opm\\\": \\\"0.00\\\",\\n    \\\"uuid\\\": \\\"52d68ef3-30f2-4f7c-868b-2e8df655cc06\\\",\\n    \\\"fecha_ing\\\": \\\"2024-02-09 15:18:01\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-09 15:18:01\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-02-09 15:18:01'),
(24, 4, 'compras', 'inventario', '\"{\\n    \\\"id_compra\\\": 4,\\n    \\\"codigo\\\": \\\"CMPR-00004\\\",\\n    \\\"num_factura\\\": 2,\\n    \\\"id_proveedor\\\": 1,\\n    \\\"tipo_compra\\\": 1,\\n    \\\"fecha\\\": \\\"2024-02-09\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-02-09 15:08:40\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-09 15:08:40\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', '\"{\\n    \\\"estado\\\": 1\\n}\"', 1, '2024-02-09 15:20:53'),
(25, 2, 'clientes', 'create', '\"{\\n    \\\"id_cliente\\\": 2,\\n    \\\"nombre\\\": \\\"Cliente 1\\\",\\n    \\\"apellido\\\": \\\"Apellido Cliente\\\",\\n    \\\"telefono\\\": \\\"7898-3669\\\",\\n    \\\"email\\\": \\\"sdf@gmail.com\\\",\\n    \\\"nit\\\": \\\"123456789-12\\\",\\n    \\\"nrc\\\": \\\"1252255-2\\\",\\n    \\\"fecha_ing\\\": \\\"2024-02-26 09:26:53\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-26 09:26:53\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', NULL, 1, '2024-02-26 09:26:53'),
(26, 1, 'direcciones', 'create', '\"{\\n    \\\"id_direccion\\\": 1,\\n    \\\"id_cliente\\\": \\\"1\\\",\\n    \\\"contacto\\\": \\\"German Osorto Reyes\\\",\\n    \\\"telefono\\\": \\\"7859-9668\\\",\\n    \\\"direccion\\\": \\\"<p>Colonia San Miguel<br><\\\\/p>\\\",\\n    \\\"id_departamento\\\": \\\"12\\\",\\n    \\\"id_municipio\\\": \\\"67\\\",\\n    \\\"principal\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-02-26 09:40:29\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-26 09:40:29\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', NULL, 1, '2024-02-26 09:40:29'),
(27, 1, 'ordenes', 'create', '\"{\\n    \\\"id_orden\\\": 1,\\n    \\\"codigo\\\": \\\"ORCL-00001\\\",\\n    \\\"id_cliente\\\": \\\"1\\\",\\n    \\\"id_direccion\\\": \\\"1\\\",\\n    \\\"fecha\\\": \\\"2024-2-26\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-02-26 09:46:41\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-26 09:46:41\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": 0\\n}\"', NULL, 1, '2024-02-26 09:46:41'),
(28, 3, 'clientes', 'create', '\"{\\n    \\\"id_cliente\\\": 3,\\n    \\\"nombre\\\": \\\"Cliente nuevo Contr\\\",\\n    \\\"apellido\\\": \\\"Apellido Contr\\\",\\n    \\\"telefono\\\": \\\"7248-6986\\\",\\n    \\\"email\\\": \\\"sj@gmail.com\\\",\\n    \\\"nit\\\": \\\"2233-9699-69\\\",\\n    \\\"nrc\\\": \\\"252229-66\\\",\\n    \\\"contribuyente\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-02-26 10:00:22\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-26 10:00:22\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": \\\"1\\\"\\n}\"', NULL, 1, '2024-02-26 10:00:22'),
(29, 2, 'ordenes', 'create', '\"{\\n    \\\"id_orden\\\": 2,\\n    \\\"codigo\\\": \\\"ORCL-00002\\\",\\n    \\\"id_cliente\\\": \\\"1\\\",\\n    \\\"id_direccion\\\": \\\"1\\\",\\n    \\\"fecha\\\": \\\"2024-2-26\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-02-26 11:13:39\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-26 11:13:39\\\",\\n    \\\"id_usuario_mod\\\": 1,\\n    \\\"estado\\\": 0\\n}\"', NULL, 1, '2024-02-26 11:13:39'),
(30, 1, 'det-ordenes', 'create', '\"{\\n    \\\"id_det_orden\\\": 1,\\n    \\\"id_orden\\\": \\\"1\\\",\\n    \\\"id_producto\\\": \\\"2\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"precio\\\": \\\"50000.00\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"uuid\\\": \\\"52d68ef3-30f2-4f7c-868b-2e8df655cc06\\\",\\n    \\\"credito_fiscal\\\": null,\\n    \\\"consumidor_final\\\": \\\"\\\",\\n    \\\"fecha_ing\\\": \\\"2024-02-26 11:52:44\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-02-26 11:52:44\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-02-26 11:52:44'),
(31, 5, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 5,\\n    \\\"id_compra\\\": \\\"2\\\",\\n    \\\"id_producto\\\": \\\"1\\\",\\n    \\\"cantidad\\\": \\\"2\\\",\\n    \\\"costo\\\": \\\"1222\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": \\\"200\\\",\\n    \\\"seguro\\\": \\\"199\\\",\\n    \\\"otros_gastos\\\": \\\"390\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"asdsdsd\\\",\\n    \\\"valor_aduana\\\": \\\"1234\\\",\\n    \\\"dai\\\": \\\"233\\\",\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"e33870c0-76fe-4d16-a276-25ad049c27eb\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 09:19:52\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 09:19:52\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 09:19:52'),
(32, 5, 'compras', 'create', '\"{\\n    \\\"id_compra\\\": 5,\\n    \\\"codigo\\\": \\\"CMPR-00005\\\",\\n    \\\"num_factura\\\": \\\"12\\\",\\n    \\\"id_proveedor\\\": \\\"1\\\",\\n    \\\"tipo_compra\\\": \\\"1\\\",\\n    \\\"fecha\\\": \\\"2024-3-14\\\",\\n    \\\"anulado\\\": 0,\\n    \\\"comentarios\\\": \\\"<p>adsadads<br><\\\\/p>\\\",\\n    \\\"estado\\\": 0,\\n    \\\"fecha_ing\\\": \\\"2024-03-14 09:39:53\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 09:39:53\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 09:39:53'),
(33, 6, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 6,\\n    \\\"id_compra\\\": \\\"5\\\",\\n    \\\"id_producto\\\": \\\"2\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"1222\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": \\\"123\\\",\\n    \\\"seguro\\\": \\\"123\\\",\\n    \\\"otros_gastos\\\": \\\"123\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"Otros gastos\\\",\\n    \\\"valor_aduana\\\": \\\"0\\\",\\n    \\\"dai\\\": \\\"0.00\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"f72039a6-a07b-4ce6-8f7c-d36c709f49d7\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 09:40:36\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 09:40:36\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 09:40:36'),
(34, 3, 'productos', 'create', '\"{\\n    \\\"id_producto\\\": 3,\\n    \\\"nombre\\\": \\\"Ford Mustang\\\",\\n    \\\"sku\\\": \\\"122233\\\",\\n    \\\"descripcion\\\": \\\"<p>asddd<br><\\\\/p>\\\",\\n    \\\"precio\\\": \\\"12222\\\",\\n    \\\"id_categoria\\\": \\\"2\\\",\\n    \\\"id_sub_categoria\\\": \\\"1\\\",\\n    \\\"id_marca\\\": \\\"1\\\",\\n    \\\"is_car\\\": \\\"0\\\",\\n    \\\"vin\\\": \\\"\\\",\\n    \\\"pais_procedencia\\\": \\\"\\\",\\n    \\\"chasis_grabado\\\": \\\"\\\",\\n    \\\"year\\\": \\\"\\\",\\n    \\\"tipo_combustible\\\": \\\"\\\",\\n    \\\"id_condicion\\\": \\\"\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"estado\\\": \\\"1\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 22:26:47\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 22:26:47\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 22:26:47'),
(35, 7, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 7,\\n    \\\"id_compra\\\": \\\"2\\\",\\n    \\\"id_producto\\\": \\\"3\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"3628\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": \\\"600\\\",\\n    \\\"seguro\\\": \\\"60\\\",\\n    \\\"otros_gastos\\\": \\\"31.80\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"\\\",\\n    \\\"valor_aduana\\\": \\\"4319.8\\\",\\n    \\\"dai\\\": \\\"863.96\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"7f0e72e6-9c15-40bd-bc6c-7eb69104206d\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 22:36:17\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 22:36:17\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 22:36:17'),
(36, 8, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 8,\\n    \\\"id_compra\\\": \\\"2\\\",\\n    \\\"id_producto\\\": \\\"3\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"3628\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": \\\"600\\\",\\n    \\\"seguro\\\": \\\"60\\\",\\n    \\\"otros_gastos\\\": \\\"31.80\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"Detalle de otros gastos\\\",\\n    \\\"valor_aduana\\\": \\\"4319.8\\\",\\n    \\\"dai\\\": \\\"863.96\\\",\\n    \\\"iva\\\": \\\"13\\\",\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"5bc32998-70d5-4b17-b973-21e70ca2999d\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 22:42:14\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 22:42:14\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 22:42:14'),
(37, 9, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 9,\\n    \\\"id_compra\\\": \\\"2\\\",\\n    \\\"id_producto\\\": \\\"3\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"3628\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": \\\"600\\\",\\n    \\\"seguro\\\": \\\"60\\\",\\n    \\\"otros_gastos\\\": \\\"31.80\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"\\\",\\n    \\\"valor_aduana\\\": \\\"4319.8\\\",\\n    \\\"dai\\\": \\\"863.96\\\",\\n    \\\"iva\\\": null,\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"51d18d88-bc08-48f3-8009-2a4be493b70a\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 23:23:21\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 23:23:21\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 23:23:21'),
(38, 10, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 10,\\n    \\\"id_compra\\\": \\\"2\\\",\\n    \\\"id_producto\\\": \\\"3\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"1000\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": \\\"100\\\",\\n    \\\"seguro\\\": \\\"100\\\",\\n    \\\"otros_gastos\\\": \\\"100\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"\\\",\\n    \\\"valor_aduana\\\": \\\"1300\\\",\\n    \\\"dai\\\": \\\"0.00\\\",\\n    \\\"iva\\\": \\\"169\\\",\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"9b9fe75c-f023-4149-b008-665d0f6dbc4b\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 23:37:26\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 23:37:26\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 23:37:26'),
(39, 11, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 11,\\n    \\\"id_compra\\\": \\\"2\\\",\\n    \\\"id_producto\\\": \\\"3\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"1000\\\",\\n    \\\"descuento\\\": \\\"0.00\\\",\\n    \\\"gastos_transporte\\\": \\\"100\\\",\\n    \\\"seguro\\\": \\\"100\\\",\\n    \\\"otros_gastos\\\": \\\"100\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"sdfsdf\\\",\\n    \\\"valor_aduana\\\": \\\"1300\\\",\\n    \\\"dai\\\": \\\"100\\\",\\n    \\\"iva\\\": \\\"182\\\",\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"7d25c73a-bf3b-4ddb-92cb-efe162f8d6f9\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 23:41:27\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 23:41:27\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 23:41:27'),
(40, 12, 'det-compras', 'create', '\"{\\n    \\\"id_det_compra\\\": 12,\\n    \\\"id_compra\\\": \\\"2\\\",\\n    \\\"id_producto\\\": \\\"2\\\",\\n    \\\"cantidad\\\": \\\"1\\\",\\n    \\\"costo\\\": \\\"1222\\\",\\n    \\\"descuento\\\": null,\\n    \\\"gastos_transporte\\\": \\\"122\\\",\\n    \\\"seguro\\\": \\\"122\\\",\\n    \\\"otros_gastos\\\": \\\"122\\\",\\n    \\\"detalle_otros_gastos\\\": \\\"sdadasda\\\",\\n    \\\"valor_aduana\\\": \\\"1588\\\",\\n    \\\"dai\\\": \\\"122\\\",\\n    \\\"iva\\\": \\\"222.3\\\",\\n    \\\"apm\\\": null,\\n    \\\"vts\\\": null,\\n    \\\"its\\\": null,\\n    \\\"aiv\\\": null,\\n    \\\"opm\\\": null,\\n    \\\"uuid\\\": \\\"17843c70-0bac-408c-b43b-a8530a187909\\\",\\n    \\\"fecha_ing\\\": \\\"2024-03-14 23:56:04\\\",\\n    \\\"id_usuario_ing\\\": 1,\\n    \\\"fecha_mod\\\": \\\"2024-03-14 23:56:04\\\",\\n    \\\"id_usuario_mod\\\": 1\\n}\"', NULL, 1, '2024-03-14 23:56:04');

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

--
-- Dumping data for table `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`id_categoria`, `nombre`, `descripcion`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`, `estado`) VALUES
(1, 'Vehículo', '', '2024-01-05 19:36:28', 1, '2024-01-05 19:36:28', 1, 1),
(2, 'Medio de transporte', '', '2024-01-05 19:37:22', 1, '2024-01-05 19:37:22', 1, 1);

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
  `nit` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nrc` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `contribuyente` tinyint(1) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Dumping data for table `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`id_cliente`, `nombre`, `apellido`, `telefono`, `email`, `nit`, `nrc`, `contribuyente`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`, `estado`) VALUES
(1, 'Cesar Mauricio', 'Martinez Reyes', '7241-9858', 'mauricio@gmail.com', '', '', 0, '2024-01-04 23:28:42', 1, '2024-01-04 23:28:42', 1, 1),
(2, 'Cliente 1', 'Apellido Cliente', '7898-3669', 'sdf@gmail.com', '123456789-12', '1252255-2', 0, '2024-02-26 09:26:53', 1, '2024-02-26 09:26:53', 1, 1),
(3, 'Cliente nuevo Contr', 'Apellido Contr', '7248-6986', 'sj@gmail.com', '2233-9699-69', '252229-66', 1, '2024-02-26 10:00:22', 1, '2024-02-26 10:00:22', 1, 1);

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

--
-- Dumping data for table `tbl_compras`
--

INSERT INTO `tbl_compras` (`id_compra`, `codigo`, `num_factura`, `id_proveedor`, `tipo_compra`, `fecha`, `anulado`, `comentarios`, `estado`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`) VALUES
(1, 'CMPR-00001', 1, 1, 1, '2024-01-04', 0, 'Este es un comentario, puede agregar cualquier tipo de informacion en esta parte<br>', 1, '2024-01-04 23:37:13', 1, '2024-01-06 20:25:01', 1),
(2, 'CMPR-00002', 2, 1, 1, '2024-01-06', 0, '', 0, '2024-01-06 20:25:44', 1, '2024-01-06 20:25:44', 1),
(3, 'CMPR-00003', 3, 1, 1, '2024-01-07', 0, '', 1, '2024-01-07 18:46:16', 1, '2024-02-06 22:15:01', 1),
(4, 'CMPR-00004', 2, 1, 1, '2024-02-09', 0, '', 1, '2024-02-09 15:08:40', 1, '2024-02-09 15:20:53', 1),
(5, 'CMPR-00005', 12, 1, 1, '2024-03-14', 0, '<p>adsadads<br></p>', 0, '2024-03-14 09:39:53', 1, '2024-03-14 09:39:53', 1);

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
  `descuento` decimal(10,2) DEFAULT NULL,
  `gastos_transporte` decimal(10,2) DEFAULT NULL,
  `seguro` decimal(10,2) DEFAULT NULL,
  `otros_gastos` decimal(10,2) DEFAULT NULL,
  `detalle_otros_gastos` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `valor_aduana` decimal(10,2) DEFAULT NULL,
  `dai` decimal(10,2) DEFAULT NULL,
  `iva` decimal(10,2) DEFAULT NULL,
  `apm` decimal(10,2) DEFAULT NULL,
  `vts` decimal(10,2) DEFAULT NULL,
  `its` decimal(10,2) DEFAULT NULL,
  `aiv` decimal(10,2) DEFAULT NULL,
  `opm` decimal(10,2) DEFAULT NULL,
  `uuid` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Dumping data for table `tbl_det_compras`
--

INSERT INTO `tbl_det_compras` (`id_det_compra`, `id_compra`, `id_producto`, `cantidad`, `costo`, `descuento`, `gastos_transporte`, `seguro`, `otros_gastos`, `detalle_otros_gastos`, `valor_aduana`, `dai`, `iva`, `apm`, `vts`, `its`, `aiv`, `opm`, `uuid`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`) VALUES
(2, 3, 1, 1, '22000.00', '0.00', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5278dc9f-169c-472f-b443-0d839efd258b', '2024-01-07 19:37:59', 1, '2024-01-07 19:37:59', 1),
(4, 4, 2, 1, '20000.00', '0.00', '0.00', '0.00', '0.00', '', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '52d68ef3-30f2-4f7c-868b-2e8df655cc06', '2024-02-09 15:18:01', 1, '2024-02-09 15:18:01', 1),
(6, 5, 2, 1, '1222.00', '0.00', '123.00', '123.00', '123.00', 'Otros gastos', '0.00', '0.00', '13.00', NULL, NULL, NULL, NULL, NULL, 'f72039a6-a07b-4ce6-8f7c-d36c709f49d7', '2024-03-14 09:40:36', 1, '2024-03-14 09:40:36', 1),
(11, 2, 3, 1, '1000.00', '0.00', '100.00', '100.00', '100.00', 'sdfsdf', '1300.00', '100.00', '182.00', NULL, NULL, NULL, NULL, NULL, '7d25c73a-bf3b-4ddb-92cb-efe162f8d6f9', '2024-03-14 23:41:27', 1, '2024-03-14 23:41:27', 1),
(12, 2, 2, 1, '1222.00', NULL, '122.00', '122.00', '122.00', 'sdadasda', '1588.00', '122.00', '222.30', NULL, NULL, NULL, NULL, NULL, '17843c70-0bac-408c-b43b-a8530a187909', '2024-03-14 23:56:04', 1, '2024-03-14 23:56:04', 1);

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
  `credito_fiscal` decimal(10,2) DEFAULT NULL,
  `consumidor_final` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
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

--
-- Dumping data for table `tbl_direcciones`
--

INSERT INTO `tbl_direcciones` (`id_direccion`, `id_cliente`, `contacto`, `telefono`, `direccion`, `id_departamento`, `id_municipio`, `principal`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`, `estado`) VALUES
(1, 1, 'German Osorto Reyes', '7859-9668', '<p>Colonia San Miguel<br></p>', 12, 67, 1, '2024-02-26 09:40:29', 1, '2024-02-26 09:40:29', 1, 1);

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
  `pais_procedencia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `pais_destino` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `pais_exportacion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_compra` int NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `tbl_duca`
--

INSERT INTO `tbl_duca` (`id_duca`, `no_correlativo`, `no_duca`, `fecha_aceptacion`, `nombre_transportista`, `modo_transporte`, `pais_procedencia`, `pais_destino`, `pais_exportacion`, `id_compra`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`, `estado`) VALUES
(2, 1233334, 13232, '2024-02-09 17:18:39', 'asdsd', 'dsds', 'dasds', 'dddds', 'asdads', 3, '2024-02-09 17:18:39', 1, '2024-02-09 17:18:39', 1, 1),
(3, 2, 2, '2024-02-09 00:00:00', 'Mauricio Reyes', 'Terrestres', '', '', '', 3, '2024-02-09 12:57:43', 1, '2024-02-09 12:57:43', 1, 1),
(4, 3, 3, '2024-02-09 00:00:00', '', '', '', '', '', 4, '2024-02-09 15:19:36', 1, '2024-02-09 15:19:36', 1, 1);

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

--
-- Dumping data for table `tbl_inventario`
--

INSERT INTO `tbl_inventario` (`id_inventario`, `uuid`, `id_producto`, `existencia`, `existencia_original`, `fecha_ing`, `id_usuario_ing`) VALUES
(1, '5278dc9f-169c-472f-b443-0d839efd258b', 1, 1, 1, '2024-02-06 22:15:01', 1),
(2, '52d68ef3-30f2-4f7c-868b-2e8df655cc06', 2, 1, 1, '2024-02-09 15:20:53', 1);

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

--
-- Dumping data for table `tbl_kardex`
--

INSERT INTO `tbl_kardex` (`id_kardex`, `id_documento`, `cod_documento`, `num_documento`, `tipo_documento`, `id_producto`, `cantidad`, `uuid`, `fecha_ing`, `id_usuario_ing`) VALUES
(1, 3, 'CMPR-00003', '3', 'COMPRA', 1, 1, '5278dc9f-169c-472f-b443-0d839efd258b', '2024-02-06 22:15:01', 1),
(2, 4, 'CMPR-00004', '2', 'COMPRA', 2, 1, '52d68ef3-30f2-4f7c-868b-2e8df655cc06', '2024-02-09 15:20:53', 1);

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

--
-- Dumping data for table `tbl_marcas`
--

INSERT INTO `tbl_marcas` (`id_marca`, `nombre`, `descripcion`, `imagen`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`, `estado`) VALUES
(1, 'Ford', '<p>Descripción de la marca FORD<br></p>', '/importadora/web/marcas/W_4dY4WioYFagqdWh4YKDmt3bnXw3ROK.png', '2024-01-05 19:34:57', 1, '2024-01-05 19:34:57', 1, 0);

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

--
-- Dumping data for table `tbl_ordenes`
--

INSERT INTO `tbl_ordenes` (`id_orden`, `codigo`, `id_cliente`, `id_direccion`, `fecha`, `anulado`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`, `estado`) VALUES
(1, 'ORCL-00001', 1, 1, '2024-02-26', 0, '2024-02-26 09:46:41', 1, '2024-02-26 09:46:41', 1, 0),
(2, 'ORCL-00002', 1, 1, '2024-02-26', 0, '2024-02-26 11:13:39', 1, '2024-02-26 11:13:39', 1, 0);

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
  `year` int DEFAULT NULL,
  `tipo_combustible` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `id_condicion` int DEFAULT NULL,
  `iva` float DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `id_usuario_ing` int DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `id_usuario_mod` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Dumping data for table `tbl_productos`
--

INSERT INTO `tbl_productos` (`id_producto`, `nombre`, `sku`, `descripcion`, `precio`, `id_categoria`, `id_sub_categoria`, `id_marca`, `is_car`, `vin`, `pais_procedencia`, `chasis_grabado`, `year`, `tipo_combustible`, `id_condicion`, `iva`, `estado`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`) VALUES
(1, 'Tractor ejemplo 2', '4225-776-3234', '', '30000.00', 2, 1, 1, 0, '', '', '', NULL, '', NULL, NULL, 1, '2024-01-05 20:17:31', 1, '2024-01-07 19:38:50', 1),
(2, 'Tractor ejemplo 1', '4225-776-3234', '', '50000.00', 2, 1, 1, 0, '', '', '', NULL, '', NULL, 13, 1, '2024-01-05 20:20:47', 1, '2024-01-05 20:20:47', 1),
(3, 'Ford Mustang', '122233', '<p>asddd<br></p>', '12222.00', 2, 1, 1, 0, '', '', '', NULL, '', NULL, 13, 1, '2024-03-14 22:26:47', 1, '2024-03-14 22:26:47', 1);

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

--
-- Dumping data for table `tbl_proveedores`
--

INSERT INTO `tbl_proveedores` (`id_proveedor`, `codigo`, `nombre`, `descripcion`, `id_departamento`, `id_municipio`, `telefono`, `email`, `giro`, `nit`, `dui`, `nrc`, `nacionalidad`, `direccion_personal`, `direccion_comercial`, `razon_social`, `contribuyente`, `estado`, `fecha_ing`, `id_usuario_ing`, `id_usuario_mod`, `fecha_mod`) VALUES
(1, 'Prove0001', 'COPART', '<p>Esta es una empresa que se dedica a la comercializacion de vehiculos<br></p>', 14, 111, '7878-8822', 'copart@gmail.com', 'Venta de vehiculos', '0000-000000-000-1', '12234556-7', '777777-7', 'EEUU', '<p>Direccion personal 1<br></p>', '<p>Direccion comercial 1<br></p>', 'COPART AUTOS ESPAÑA, S.L.U.', 1, 1, '2024-01-04 23:35:11', 1, 1, 2024);

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

--
-- Dumping data for table `tbl_sub_categorias`
--

INSERT INTO `tbl_sub_categorias` (`id_sub_categoria`, `id_categoria`, `nombre`, `descripcion`, `fecha_ing`, `id_usuario_ing`, `fecha_mod`, `id_usuario_mod`, `estado`) VALUES
(1, 2, 'Tractor', '', '2024-01-05 19:37:38', 1, '2024-01-05 19:37:38', 1, 1);

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
(1, 'admin', 'Admin', 'Admin', 'AxK42pI4nqEvIyBOBUJVfSR9oRTq-chL', '$2y$13$nV15ga15APLWl0K3S7B1h.8kd6twdrZektnAoK6YUZKLQ7b59Vyhe', 'admin@outlook.com', '/importadora/web/avatars/KWdR6NNOWW4FEYRvhPz4d2GPYh3x-Epo.png', 1, 1677203598, 1677203598),
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
  MODIFY `id_bitacora` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_compras`
--
ALTER TABLE `tbl_compras`
  MODIFY `id_compra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_det_compra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_det_ordenes`
--
ALTER TABLE `tbl_det_ordenes`
  MODIFY `id_det_orden` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_direcciones`
--
ALTER TABLE `tbl_direcciones`
  MODIFY `id_direccion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_duca`
--
ALTER TABLE `tbl_duca`
  MODIFY `id_duca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `id_inventario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  MODIFY `id_kardex` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_marcas`
--
ALTER TABLE `tbl_marcas`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  MODIFY `id_municipio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `tbl_ordenes`
--
ALTER TABLE `tbl_ordenes`
  MODIFY `id_orden` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_productos_imagenes`
--
ALTER TABLE `tbl_productos_imagenes`
  MODIFY `id_producto_imagen` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  MODIFY `id_proveedor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sub_categorias`
--
ALTER TABLE `tbl_sub_categorias`
  MODIFY `id_sub_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
