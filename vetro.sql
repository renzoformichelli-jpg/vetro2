-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2025 a las 20:00:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vetro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `celular` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `dni`, `celular`, `email`, `nacimiento`, `created_at`, `updated_at`) VALUES
(1, 'Juanes', 'Pérez', '30111222', '1122334455', 'juan.perez@example.com', '1990-05-14', '2025-11-20 18:32:39', '2025-11-20 21:47:30'),
(2, 'María', 'Gómez', '28999888', '1133445566', 'maria.gomez@example.com', '1988-03-22', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(3, 'Pedro', 'López', '31222111', '1144556677', 'pedro.lopez@example.com', '1993-11-10', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(4, 'Lucía', 'Rodríguez', '27888777', '1155667788', 'lucia.rod@gmail.com', '1987-09-02', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(5, 'Diego', 'Martínez', '29999666', '1166778899', 'diego.martinez@hotmail.com', '1991-01-19', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(6, 'Sofía', 'Fernández', '30123456', '1177889900', 'sofia.fer@hotmail.com', '1995-07-30', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(7, 'Carlos', 'Alonso', '27555444', '1122998833', 'carlos.alonso@example.com', '1985-02-14', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(8, 'Ana', 'Ramírez', '28888777', '1177996655', 'ana.rami@example.com', '1990-06-25', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(9, 'Julián', 'Sosa', '32211333', '1133557799', 'julian.sosa@gmail.com', '1994-10-08', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(10, 'Valentina', 'Molina', '27776655', '1144668899', 'valen.molina@gmail.com', '1989-04-11', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(11, 'Franco', 'Silva', '31234567', '1122110099', 'franco.silva@hotmail.com', '1992-08-12', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(12, 'Daniela', 'Cruz', '29888777', '1133112277', 'daniela.cruz@gmail.com', '1996-03-29', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(13, 'Hernán', 'Castro', '30000999', '1144552233', 'hernan.castro@gmail.com', '1986-12-20', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(14, 'Melina', 'Vega', '28986745', '1177223344', 'mel.vega@example.com', '1993-09-18', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(15, 'Ezequiel', 'Acosta', '30555111', '1188997766', 'eze.acosta@gmail.com', '1991-11-23', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(16, 'Florencia', 'Benítez', '31002255', '1123445566', 'flor.benitez@gmail.com', '1997-05-03', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(17, 'Gustavo', 'Herrera', '29910022', '1133778899', 'gus.herrera@hotmail.com', '1984-01-27', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(18, 'Cintia', 'Campos', '28776611', '1144889900', 'cintia.campos@example.com', '1990-02-06', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(19, 'Maximiliano', 'Peralta', '32003344', '1166990022', 'max.peralta@gmail.com', '1995-07-15', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(20, 'Julieta', 'Arias', '27553344', '1188112244', 'julieta.arias@gmail.com', '1988-10-01', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(21, 'Martín', 'Paredes', '30118844', '1122558866', 'martin.paredes@example.com', '1992-04-19', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(22, 'Paula', 'Contreras', '28994433', '1133665588', 'paula.contreras@hotmail.com', '1989-06-30', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(23, 'Federico', 'Rivas', '31005577', '1144776699', 'fed.rivas@gmail.com', '1994-08-09', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(24, 'Eliana', 'Ortiz', '30099887', '1177001122', 'eli.ortiz@example.com', '1996-01-12', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(25, 'Nicolás', 'Ibáñez', '29922113', '1155990088', 'nico.ibanez@gmail.com', '1993-03-04', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(26, 'Brenda', 'Juárez', '27666112', '1188223344', 'brenda.juarez@example.com', '1988-10-21', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(27, 'Agustín', 'Paz', '28991234', '1122113344', 'agus.paz@example.com', '1991-07-27', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(28, 'Daiana', 'Villar', '30117892', '1133556677', 'dai.villar@gmail.com', '1995-12-17', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(29, 'Ramiro', 'Suárez', '31229988', '1144667799', 'rami.suarez@hotmail.com', '1985-08-02', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(30, 'Rocío', 'Montenegro', '27889900', '1155778899', 'rocio.monte@gmail.com', '1992-11-25', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(31, 'Sebastián', 'Luna', '30001122', '1166889900', 'seba.luna@example.com', '1990-03-19', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(32, 'Noelia', 'Vázquez', '28990011', '1177990011', 'noe.vazquez@gmail.com', '1994-09-05', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(33, 'Rodrigo', 'Quiroga', '31009988', '1122445566', 'rodri.quiroga@hotmail.com', '1987-05-14', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(34, 'Marina', 'Sánchez', '27881122', '1188334455', 'marina.sanchez@gmail.com', '1993-07-07', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(35, 'Facundo', 'Delgado', '30117766', '1144002211', 'facu.delgado@example.com', '1991-10-10', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(36, 'Camila', 'Aguirre', '29885566', '1133225544', 'cami.aguirre@gmail.com', '1996-03-31', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(37, 'Leandro', 'Bustamante', '31220011', '1155446688', 'lean.bustamante@gmail.com', '1989-09-28', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(38, 'Bianca', 'Soria', '30007788', '1166557799', 'bianca.soria@hotmail.com', '1992-02-03', '2025-11-20 18:32:39', '2025-11-20 18:32:39'),
(39, 'Tomás', 'García', '28991177', '1177665544', 'tomas.garcia@gmail.com', '1995-06-12', '2025-11-20 18:32:39', '2025-11-20 18:32:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `valor_venta` decimal(10,2) NOT NULL,
  `id_proveedores` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `costo`, `valor_venta`, `id_proveedores`, `created_at`, `updated_at`) VALUES
(40, 'Teclado Mecánico K200', 150.00, 225.00, 1, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(41, 'Monitor 24\" FullHD', 200.00, 300.00, 2, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(42, 'Mouse Óptico M50', 80.00, 120.00, 2, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(43, 'Webcam HD 1080p', 90.00, 135.00, 2, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(44, 'Auricular Inalámbrico A10', 110.00, 165.00, 3, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(45, 'Teclado Compacto T50', 130.00, 195.00, 3, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(46, 'Monitor 27\" 2K', 250.00, 375.00, 4, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(47, 'Mouse Gamer Razer', 95.00, 142.00, 4, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(48, 'Auricular Bluetooth B5', 100.00, 150.00, 5, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(49, 'Teclado RGB T70', 160.00, 240.00, 5, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(50, 'Monitor Curvo 32\"', 300.00, 450.00, 6, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(51, 'Mousepad XL Gaming', 40.00, 60.00, 6, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(52, 'Auricular Estéreo S20', 120.00, 180.00, 7, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(53, 'Teclado Multimedia T90', 140.00, 210.00, 8, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(54, 'Monitor LED 21.5\"', 180.00, 270.00, 8, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(55, 'Mouse Inalámbrico W1', 70.00, 105.00, 9, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(56, 'Auricular USB U5', 100.00, 150.00, 10, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(57, 'Teclado Mecánico K90', 150.00, 225.00, 10, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(58, 'Monitor 4K UHD', 350.00, 525.00, 11, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(59, 'Mouse Gamer M100', 120.00, 180.00, 11, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(60, 'Auricular Gaming Pro', 130.00, 195.00, 12, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(61, 'Teclado Ergonomico E50', 140.00, 210.00, 12, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(62, 'Monitor UltraWide 34\"', 400.00, 600.00, 13, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(63, 'Mouse Wireless W200', 90.00, 135.00, 13, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(64, 'Auricular Stereo X10', 110.00, 165.00, 14, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(65, 'Teclado Bluetooth B80', 130.00, 195.00, 15, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(66, 'Monitor 25\" QHD', 220.00, 330.00, 15, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(67, 'Mouse Pad XL Pro', 50.00, 75.00, 16, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(68, 'Auricular Inalámbrico Z1', 120.00, 180.00, 16, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(69, 'Teclado Gamer T120', 160.00, 240.00, 17, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(70, 'Monitor LED 28\" HDR', 300.00, 450.00, 17, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(71, 'Mouse Gamer RGB M250', 110.00, 165.00, 18, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(72, 'Auricular USB A30', 100.00, 150.00, 18, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(73, 'Teclado Mecánico K200 Pro', 180.00, 270.00, 19, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(74, 'Monitor 32\" 4K', 350.00, 525.00, 19, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(75, 'Mouse Óptico X100', 90.00, 135.00, 20, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(76, 'Auricular Gamer Z5', 130.00, 195.00, 20, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(77, 'Teclado Compacto T150', 150.00, 225.00, 20, '2025-11-20 17:49:27', '2025-11-20 17:49:27'),
(78, 'auricular gamer x1', 1200.00, 1800.00, 1, '2025-11-20 21:07:27', '2025-11-20 21:07:27'),
(79, 'monitor elote', 123124.00, 53456457.00, 21, '2025-11-20 21:09:06', '2025-11-20 21:09:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `persona_contacto` varchar(255) DEFAULT NULL,
  `sitio_web` varchar(255) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `persona_contacto`, `sitio_web`, `celular`, `email`, `created_at`, `updated_at`) VALUES
(1, 'TechSolutions SA', 'Carlos Gómez', 'https://techsolutions.com', '1134567890', 'carlos.gomez@techsolutions.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(2, 'Distribuidora Andina', 'Marta Rivas', 'https://andina.com.ar', '1145678901', 'mrivas@andina.com.ar', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(3, 'ElectroMundo', 'Luis Pereyra', 'https://electromundo.com', '1156789012', 'lpereyra@electromundo.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(4, 'GlobalParts', 'Sofía Aguirre', 'https://globalparts.com', '1167890123', 'saguirre@globalparts.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(5, 'ServiHard', 'Miguel Ortíz', 'https://servihard.net', '1178901234', 'mortiz@servihard.net', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(6, 'MaxComponents', 'Laura Benítez', 'https://maxcomponents.com', '1189012345', 'lbenitez@maxcomponents.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(7, 'Proveeduría Patagónica', 'Franco Díaz', 'https://patagonica.com', '1190123456', 'fdiaz@patagonica.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(8, 'Digital Center', 'Julieta Molina', 'https://digitalcenter.com', '1123456789', 'jmolina@digitalcenter.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(9, 'TransTec', 'Javier López', 'https://transteclatam.com', '1135678901', 'jlopez@transteclatam.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(10, 'Compusur', 'Diego Herrera', 'https://compusur.com.ar', '1146789012', 'dherrera@compusur.com.ar', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(11, 'RedLine Group', 'Andrea Sosa', 'https://redlinegroup.com', '1157890123', 'asosa@redlinegroup.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(12, 'Soluciones Norte', 'Marcos Medina', 'https://solnorte.com', '1168901234', 'mmedina@solnorte.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(13, 'Infinitron', 'Paula Frías', 'https://infinitron.net', '1179012345', 'pfrias@infinitron.net', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(14, 'GigaProveedores', 'Hugo Suárez', 'https://gigaproveedores.com', '1180123456', 'hsuarez@gigaproveedores.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(15, 'MicroServicios', 'Valeria Peña', 'https://microservicios.com.ar', '1191234567', 'vpena@microservicios.com.ar', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(16, 'TecnoImport', 'Ignacio Vargas', 'https://tecnoimport.com', '1122345678', 'ivargas@tecnoimport.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(17, 'MegaDistribución', 'Rocío Fernández', 'https://megadistribucion.com', '1133456789', 'rfernandez@megadistribucion.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(18, 'PuntoHardware', 'Cristian Barrios', 'https://puntohardware.com', '1144567890', 'cbarrios@puntohardware.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(19, 'AlphaTech', 'Fernanda Quiroga', 'https://alphatech.com', '1155678901', 'fquiroga@alphatech.com', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(20, 'NovaSupply', 'Matías Reynoso', 'https://novasupply.net', '1166789012', 'mreynoso@novasupply.net', '2025-11-20 15:33:39', '2025-11-20 15:33:39'),
(21, 'pepitotechtitanium', 'furgencio armando', 'www.pepitotech.com.ar', '12780369178263', 'pepito@gmial.com', '2025-11-20 19:39:54', '2025-11-20 19:54:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('F68g8tjs7QBjtxguAbk1ObLvVaXnRlsbRHzWJgCt', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHlVVGVhYWVCdVdnckppcTZEdVVuQXY3MjlHMDFncnNhQVI2Vkh0SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3QvdmV0cm8vcHVibGljL2NsaWVudGVzIjtzOjU6InJvdXRlIjtzOjE0OiJjbGllbnRlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763664652),
('mqQNCXq1wyfBbQEgdUaADCjWiiYF0KUn6IAKFhC5', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnN0NXVMaDVUN0Q4RTRRTHJBWkMzazQ5UWljM1hvQ3VyNVNWUEN3VSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvdmV0cm8vcHVibGljL3Byb3ZlZWRvcmVzIjtzOjU6InJvdXRlIjtzOjE3OiJwcm92ZWVkb3Jlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763650797),
('mwTjIIboHWeXtLOHeCTsQ4PIMzJkuY8wkXFpDBa4', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmpCaVlKeVcwR3NwWjVkamN4WjJOQ3VnYm9kYkR6WDdGaTBwSVN1TSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3QvdmV0cm8vcHVibGljIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763650519),
('VKIF2xOhmzi0JpzaAJFUjIbW2N4uUiNWk9Lngjca', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWE4bnZsdUpxYk9tU2hFMVU0dERPTzBhMnNZTWVpNXN6MUY5WDZIRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3QvdmV0cm8vcHVibGljIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763648551);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedores` (`id_proveedores`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_proveedores`) REFERENCES `proveedores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
