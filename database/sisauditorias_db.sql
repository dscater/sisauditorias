-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-04-2024 a las 16:44:46
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisauditorias_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapa_archivos`
--

CREATE TABLE `etapa_archivos` (
  `id` bigint UNSIGNED NOT NULL,
  `etapa_nombre_id` bigint UNSIGNED NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapa_auditorias`
--

CREATE TABLE `etapa_auditorias` (
  `id` bigint UNSIGNED NOT NULL,
  `trabajo_auditoria_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapa_nombres`
--

CREATE TABLE `etapa_nombres` (
  `id` bigint UNSIGNED NOT NULL,
  `etapa_auditoria_id` bigint UNSIGNED NOT NULL,
  `nro_etapa` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_accions`
--

CREATE TABLE `historial_accions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `accion` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datos_original` text COLLATE utf8mb4_unicode_ci,
  `datos_nuevo` text COLLATE utf8mb4_unicode_ci,
  `modulo` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial_accions`
--

INSERT INTO `historial_accions` (`id`, `user_id`, `accion`, `descripcion`, `datos_original`, `datos_nuevo`, `modulo`, `fecha`, `hora`, `created_at`, `updated_at`) VALUES
(1, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA PUBLCIACION', 'id: 1<br/>titulo: TITULO #<br/>descripcion: DES<br/>created_at: 2024-04-15 12:21:40<br/>updated_at: 2024-04-15 12:21:40<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:21:40', '2024-04-15 16:21:40', '2024-04-15 16:21:40'),
(2, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 1<br/>titulo: TITULO #<br/>descripcion: DES<br/>created_at: 2024-04-15 12:21:40<br/>updated_at: 2024-04-15 12:21:40<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:22:26', '2024-04-15 16:22:26', '2024-04-15 16:22:26'),
(3, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA PUBLCIACION', 'id: 2<br/>titulo: <br/>descripcion: <br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:22:26<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:22:26', '2024-04-15 16:22:26', '2024-04-15 16:22:26'),
(4, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA PUBLCIACION', 'id: 3<br/>titulo: <br/>descripcion: <br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:22:26<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:22:26', '2024-04-15 16:22:26', '2024-04-15 16:22:26'),
(5, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA PUBLCIACION', 'id: 4<br/>titulo: <br/>descripcion: <br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:22:26<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:22:26', '2024-04-15 16:22:26', '2024-04-15 16:22:26'),
(6, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 1<br/>titulo: TITULO #<br/>descripcion: DES<br/>created_at: 2024-04-15 12:21:40<br/>updated_at: 2024-04-15 12:21:40<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:23:45', '2024-04-15 16:23:45', '2024-04-15 16:23:45'),
(7, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 2<br/>titulo: <br/>descripcion: <br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:22:26<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:23:45', '2024-04-15 16:23:45', '2024-04-15 16:23:45'),
(8, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 3<br/>titulo: <br/>descripcion: <br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:22:26<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:23:45', '2024-04-15 16:23:45', '2024-04-15 16:23:45'),
(9, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 4<br/>titulo: <br/>descripcion: <br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:22:26<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:23:45', '2024-04-15 16:23:45', '2024-04-15 16:23:45'),
(10, 1, 'CREACIÓN', 'EL USUARIO admin ELIMINO UNA PUBLCIACION', 'id: 3<br/>titulo: <br/>descripcion: <br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:22:26<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:23:56', '2024-04-15 16:23:56', '2024-04-15 16:23:56'),
(11, 1, 'CREACIÓN', 'EL USUARIO admin ELIMINO UNA PUBLCIACION', 'id: 4<br/>titulo: <br/>descripcion: <br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:22:26<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:23:56', '2024-04-15 16:23:56', '2024-04-15 16:23:56'),
(12, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 1<br/>titulo: TITULO #1<br/>descripcion: DES<br/>created_at: 2024-04-15 12:21:40<br/>updated_at: 2024-04-15 12:23:56<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:23:56', '2024-04-15 16:23:56', '2024-04-15 16:23:56'),
(13, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 2<br/>titulo: TITULO #2<br/>descripcion: DESC #2<br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:23:56<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '12:23:56', '2024-04-15 16:23:56', '2024-04-15 16:23:56'),
(14, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 1<br/>titulo: TITULO #1<br/>descripcion: DES<br/>created_at: 2024-04-15 12:21:40<br/>updated_at: 2024-04-15 12:23:56<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '14:13:56', '2024-04-15 18:13:56', '2024-04-15 18:13:56'),
(15, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA PUBLCIACION', 'id: 2<br/>titulo: TITULO #2<br/>descripcion: DESC #2<br/>created_at: 2024-04-15 12:22:26<br/>updated_at: 2024-04-15 12:23:56<br/>', NULL, 'PUBLCIACIONES', '2024-04-15', '14:13:56', '2024-04-15 18:13:56', '2024-04-15 18:13:56'),
(16, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA NOTICIA', 'id: 1<br/>titulo: NOTICIA #1<br/>descripcion: DESCRIPCION NOTICIA #1<br/>created_at: 2024-04-15 14:17:07<br/>updated_at: 2024-04-15 14:17:07<br/>', NULL, 'NOTICIAS', '2024-04-15', '14:17:07', '2024-04-15 18:17:07', '2024-04-15 18:17:07'),
(17, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA NOTICIA', 'id: 1<br/>titulo: NOTICIA #1<br/>descripcion: DESCRIPCION NOTICIA #1<br/>created_at: 2024-04-15 14:17:07<br/>updated_at: 2024-04-15 14:17:07<br/>', NULL, 'NOTICIAS', '2024-04-15', '14:17:30', '2024-04-15 18:17:30', '2024-04-15 18:17:30'),
(18, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA NOTICIA', 'id: 2<br/>titulo: NOTICIAS #2<br/>descripcion: DESC<br/>created_at: 2024-04-15 14:17:30<br/>updated_at: 2024-04-15 14:17:30<br/>', NULL, 'NOTICIAS', '2024-04-15', '14:17:30', '2024-04-15 18:17:30', '2024-04-15 18:17:30'),
(19, 1, 'CREACIÓN', 'EL USUARIO admin ELIMINO UNA NOTICIA', 'id: 2<br/>titulo: NOTICIAS #2<br/>descripcion: DESC<br/>created_at: 2024-04-15 14:17:30<br/>updated_at: 2024-04-15 14:17:30<br/>', NULL, 'NOTICIAS', '2024-04-15', '14:17:34', '2024-04-15 18:17:34', '2024-04-15 18:17:34'),
(20, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA NOTICIA', 'id: 1<br/>titulo: NOTICIA #1<br/>descripcion: DESCRIPCION NOTICIA #1<br/>created_at: 2024-04-15 14:17:07<br/>updated_at: 2024-04-15 14:17:07<br/>', NULL, 'NOTICIAS', '2024-04-15', '14:17:34', '2024-04-15 18:17:34', '2024-04-15 18:17:34'),
(21, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:32:45', '2024-04-15 18:32:45', '2024-04-15 18:32:45'),
(22, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:39:40', '2024-04-15 18:39:40', '2024-04-15 18:39:40'),
(23, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:40:45', '2024-04-15 18:40:45', '2024-04-15 18:40:45'),
(24, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:40:48', '2024-04-15 18:40:48', '2024-04-15 18:40:48'),
(25, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:40:53', '2024-04-15 18:40:53', '2024-04-15 18:40:53'),
(26, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:42:19', '2024-04-15 18:42:19', '2024-04-15 18:42:19'),
(27, 1, 'CREACIÓN', 'EL USUARIO admin ACTUALIZO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:43:45', '2024-04-15 18:43:45', '2024-04-15 18:43:45'),
(30, 1, 'CREACIÓN', 'EL USUARIO admin ELIMINO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:45:52', '2024-04-15 18:45:52', '2024-04-15 18:45:52'),
(31, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:47:11', '2024-04-15 18:47:11', '2024-04-15 18:47:11'),
(32, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UNA MULTIMEDIA', '', NULL, 'MULTIMEDIAS', '2024-04-15', '14:47:11', '2024-04-15 18:47:11', '2024-04-15 18:47:11'),
(33, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: TIPO TRABAJO #1<br/>descripcion: <br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 11:16:16<br/>updated_at: 2024-04-16 11:16:16<br/>', NULL, 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '11:16:16', '2024-04-16 15:16:16', '2024-04-16 15:16:16'),
(34, 1, 'MODIFICACIÓN', 'EL USUARIO  MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: TIPO TRABAJO #1<br/>descripcion: <br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 11:16:16<br/>updated_at: 2024-04-16 11:16:16<br/>', 'id: 1<br/>nombre: TIPO TRABAJO #1<br/>descripcion: <br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 11:16:16<br/>updated_at: 2024-04-16 11:16:16<br/>', 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '11:16:43', '2024-04-16 15:16:43', '2024-04-16 15:16:43'),
(35, 1, 'MODIFICACIÓN', 'EL USUARIO  MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: TIPO TRABAJO #1<br/>descripcion: <br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 11:16:16<br/>updated_at: 2024-04-16 11:16:16<br/>', 'id: 1<br/>nombre: TIPO TRABAJO #1<br/>descripcion: DESC<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 11:16:16<br/>updated_at: 2024-04-16 11:17:13<br/>', 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '11:17:13', '2024-04-16 15:17:13', '2024-04-16 15:17:13'),
(36, 1, 'ELIMINACIÓN', 'EL USUARIO  ELIMINÓ UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: TIPO TRABAJO #1<br/>descripcion: DESC<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 11:16:16<br/>updated_at: 2024-04-16 11:17:13<br/>', NULL, 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '11:17:19', '2024-04-16 15:17:19', '2024-04-16 15:17:19'),
(37, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UN USUARIO', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$EARK8LWd.ygATD9PKVz4oee14S2Vc79Igt8YmICRVomg93lDzL2Li<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: GA<br/>nivel: A<br/>tipo: GERENTE AUDITOR<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:11:41<br/>', NULL, 'USUARIOS', '2024-04-16', '12:11:41', '2024-04-16 16:11:41', '2024-04-16 16:11:41'),
(38, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$EARK8LWd.ygATD9PKVz4oee14S2Vc79Igt8YmICRVomg93lDzL2Li<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: GA<br/>nivel: A<br/>tipo: GERENTE AUDITOR<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:11:41<br/>', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$wBaDR8591F1t7EcBDJoSLuVRjv70Ea4FDCJA06vajTg3INNHr3JiW<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANOS<br/>dir: LOS OLIVOSS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: SU<br/>nivel: B<br/>tipo: SUPERVISOR DE AUDITORÍA<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:12:15<br/>', 'USUARIOS', '2024-04-16', '12:12:15', '2024-04-16 16:12:15', '2024-04-16 16:12:15'),
(39, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$wBaDR8591F1t7EcBDJoSLuVRjv70Ea4FDCJA06vajTg3INNHr3JiW<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANOS<br/>dir: LOS OLIVOSS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: SU<br/>nivel: B<br/>tipo: SUPERVISOR DE AUDITORÍA<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:12:15<br/>', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$5CRqsK8lOWyBTgmMTAhZR.WyidZ0CIfNDk.XL7B7Z3.vnNs0MzbbG<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: SU<br/>nivel: A<br/>tipo: GERENTE AUDITOR<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:12:27<br/>', 'USUARIOS', '2024-04-16', '12:12:27', '2024-04-16 16:12:27', '2024-04-16 16:12:27'),
(40, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$5CRqsK8lOWyBTgmMTAhZR.WyidZ0CIfNDk.XL7B7Z3.vnNs0MzbbG<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: SU<br/>nivel: A<br/>tipo: GERENTE AUDITOR<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:12:27<br/>', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$WuEMyQiB6flc4nYKVKx1R.kaQahftZRE/mWW68KnoesL8h4TOVm16<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: GA<br/>nivel: A<br/>tipo: GERENTE AUDITOR<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:12:31<br/>', 'USUARIOS', '2024-04-16', '12:12:31', '2024-04-16 16:12:31', '2024-04-16 16:12:31'),
(41, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$WuEMyQiB6flc4nYKVKx1R.kaQahftZRE/mWW68KnoesL8h4TOVm16<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: GA<br/>nivel: A<br/>tipo: GERENTE AUDITOR<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:12:31<br/>', 'id: 2<br/>usuario: JPERES<br/>password: $2y$12$JYf5tQfnyULpD0k49W5ejubQbDEFzY9V3ipapW4kCrCInSkaS9oGG<br/>nombre: JUAN<br/>paterno: PERES<br/>materno: MAMANI<br/>ci: 1111<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: JUAN@GMAIL.COM<br/>fono: 77777777<br/>profesion: PROFESION #1<br/>cargo: GA<br/>nivel: A<br/>tipo: GERENTE AUDITOR<br/>foto: 1713283901_JPERES.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:11:41<br/>updated_at: 2024-04-16 12:12:38<br/>', 'USUARIOS', '2024-04-16', '12:12:38', '2024-04-16 16:12:38', '2024-04-16 16:12:38'),
(42, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UN USUARIO', 'id: 3<br/>usuario: MCORTEZ<br/>password: $2y$12$dNoZ0MuPVbzNI9Bantnkv.i4TV8AQzzdYMQnlCWa1rZwKLUYOYlbq<br/>nombre: MARIO<br/>paterno: CORTEZ<br/>materno: <br/>ci: 2222<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: <br/>fono: 67676767<br/>profesion: PROFESION #2<br/>cargo: SU<br/>nivel: B<br/>tipo: AUDITOR<br/>foto: <br/>acceso: 0<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:13:07<br/>updated_at: 2024-04-16 12:13:07<br/>', NULL, 'USUARIOS', '2024-04-16', '12:13:07', '2024-04-16 16:13:07', '2024-04-16 16:13:07'),
(43, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'id: 3<br/>usuario: MCORTEZ<br/>password: $2y$12$dNoZ0MuPVbzNI9Bantnkv.i4TV8AQzzdYMQnlCWa1rZwKLUYOYlbq<br/>nombre: MARIO<br/>paterno: CORTEZ<br/>materno: <br/>ci: 2222<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: <br/>fono: 67676767<br/>profesion: PROFESION #2<br/>cargo: SU<br/>nivel: B<br/>tipo: AUDITOR<br/>foto: <br/>acceso: 0<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:13:07<br/>updated_at: 2024-04-16 12:13:07<br/>', 'id: 3<br/>usuario: MCORTEZ<br/>password: $2y$12$gvX82w1VAp/qO2aHy/KDou93YMMKrikjID675524JNW10E/gxJ7Aa<br/>nombre: MARIO<br/>paterno: CORTEZ<br/>materno: <br/>ci: 2222<br/>ci_exp: LP<br/>sexo: HOMBRE<br/>nacionalidad: BOLIVIANO<br/>dir: LOS OLIVOS<br/>email: <br/>fono: 67676767<br/>profesion: PROFESION #2<br/>cargo: SU<br/>nivel: B<br/>tipo: AUDITOR<br/>foto: <br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:13:07<br/>updated_at: 2024-04-16 12:13:12<br/>', 'USUARIOS', '2024-04-16', '12:13:12', '2024-04-16 16:13:12', '2024-04-16 16:13:12'),
(44, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UN USUARIO', 'id: 4<br/>usuario: MMAMANI<br/>password: $2y$12$3CvihElPmuNTt2puLSWaEeI9IUDOVB6s4Gfb8qUGJqYoUBzDKEEwW<br/>nombre: MARIA<br/>paterno: MAMANI<br/>materno: <br/>ci: 3333<br/>ci_exp: CB<br/>sexo: MUJER<br/>nacionalidad: BOLIVIANA<br/>dir: LOS OLIVOS<br/>email: MARIA@GMAIL.COM<br/>fono: 67676767<br/>profesion: PROFESION #3<br/>cargo: SU<br/>nivel: B<br/>tipo: AUDITOR<br/>foto: 1713284044_MMAMANI.jpg<br/>acceso: 1<br/>fecha_registro: 2024-04-16 00:00:00<br/>created_at: 2024-04-16 12:14:04<br/>updated_at: 2024-04-16 12:14:04<br/>', NULL, 'USUARIOS', '2024-04-16', '12:14:04', '2024-04-16 16:14:04', '2024-04-16 16:14:04'),
(45, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: TIPO TRABJO #1<br/>descripcion: DESC. TIPO TRABAJO 1<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:15:40<br/>updated_at: 2024-04-16 12:15:40<br/>', NULL, 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:15:40', '2024-04-16 16:15:40', '2024-04-16 16:15:40'),
(46, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 2<br/>nombre: TIPO TRABAJO #2<br/>descripcion: DESC. 2<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:15:46<br/>updated_at: 2024-04-16 12:15:46<br/>', NULL, 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:15:46', '2024-04-16 16:15:46', '2024-04-16 16:15:46'),
(47, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:39:37<br/>', NULL, 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:39:37', '2024-04-16 16:39:37', '2024-04-16 16:39:37'),
(48, 1, 'MODIFICACIÓN', 'EL USUARIO  MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:39:37<br/>', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:39:37<br/>', 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:43:22', '2024-04-16 16:43:22', '2024-04-16 16:43:22'),
(49, 1, 'MODIFICACIÓN', 'EL USUARIO  MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:39:37<br/>', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:39:37<br/>', 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:43:30', '2024-04-16 16:43:30', '2024-04-16 16:43:30'),
(50, 1, 'MODIFICACIÓN', 'EL USUARIO  MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:39:37<br/>', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:39:37<br/>', 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:43:35', '2024-04-16 16:43:35', '2024-04-16 16:43:35'),
(51, 1, 'MODIFICACIÓN', 'EL USUARIO  MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:39:37<br/>', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: CALENDARIO<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:43:42<br/>', 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:43:42', '2024-04-16 16:43:42', '2024-04-16 16:43:42'),
(52, 1, 'ELIMINACIÓN', 'EL USUARIO  ELIMINÓ UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-0001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO<br/>objetivo: OBJETIVO<br/>periodo: PERIODO 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: CALENDARIO<br/>fecha_entrega: 2024-06-06<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:39:37<br/>updated_at: 2024-04-16 12:43:42<br/>', NULL, 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:43:49', '2024-04-16 16:43:49', '2024-04-16 16:43:49'),
(53, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UN TIPO DE TRABAJOS DE AUDITORIA', 'id: 1<br/>nombre: AUDITORIA #1<br/>codigo: COD-001<br/>tipo_trabajo_id: 1<br/>empresa: EMPRESA #1<br/>responsable_id: 2<br/>objeto: OBJETO #1<br/>objetivo: OBJETIVO #1<br/>periodo: 1-2024<br/>fecha_ini: 2024-03-03<br/>duracion: HÁBILES<br/>fecha_entrega: 2024-06-01<br/>fecha_registro: 2024-04-16<br/>created_at: 2024-04-16 12:44:37<br/>updated_at: 2024-04-16 12:44:37<br/>', NULL, 'TIPO DE TRABAJOS DE AUDITORIAS', '2024-04-16', '12:44:37', '2024-04-16 16:44:37', '2024-04-16 16:44:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucions`
--

CREATE TABLE `institucions` (
  `id` bigint UNSIGNED NOT NULL,
  `institucion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_sistema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_organigrama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mision` text COLLATE utf8mb4_unicode_ci,
  `vision` text COLLATE utf8mb4_unicode_ci,
  `principios` text COLLATE utf8mb4_unicode_ci,
  `valores` text COLLATE utf8mb4_unicode_ci,
  `administracion` text COLLATE utf8mb4_unicode_ci,
  `codigo_etica` text COLLATE utf8mb4_unicode_ci,
  `informacion_financiera` text COLLATE utf8mb4_unicode_ci,
  `ubicacion_google` text COLLATE utf8mb4_unicode_ci,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `institucions`
--

INSERT INTO `institucions` (`id`, `institucion`, `nombre_sistema`, `nit`, `img_organigrama`, `mision`, `vision`, `principios`, `valores`, `administracion`, `codigo_etica`, `informacion_financiera`, `ubicacion_google`, `ciudad`, `dir`, `fonos`, `horario`, `correo`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'SISAUDITORIAS S.A.', 'SISAUDITORIAS', '10000001', 'ORGANIGRAMA.WEBP', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS.', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS.', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS.', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d12143.389812786238!2d-68.08918332465664!3d-16.52975316867156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e0!4m0!4m3!3m2!1d-16.527973505058714!2d-68.08870645756463!5e0!3m2!1ses-419!2sbo!4v1706929714970!5m2!1ses-419!2sbo\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'LA PAZS', 'LOS OLIVOSS', '7777777', '08:00AM A 18:00PM', 'SISAUDITORIAS@GMAIL.COM', 'logo.jpg', '2024-04-08 21:06:22', '2024-04-15 15:41:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_01_31_165641_create_institucions_table', 1),
(4, '2024_02_02_205431_create_historial_accions_table', 1),
(5, '2024_04_08_155732_create_publicacions_table', 1),
(6, '2024_04_08_155735_create_noticias_table', 1),
(7, '2024_04_08_155740_create_multimedia_table', 1),
(8, '2024_04_08_160013_create_tipo_trabajos_table', 1),
(9, '2024_04_08_160014_create_trabajo_auditorias_table', 1),
(10, '2024_04_08_160410_create_personal_trabajos_table', 1),
(11, '2024_04_08_164649_create_etapa_auditorias_table', 1),
(12, '2024_04_08_164926_create_etapa_nombres_table', 1),
(13, '2024_04_08_165031_create_etapa_archivos_table', 1),
(14, '2024_04_08_165138_create_papel_trabajos_table', 1),
(15, '2024_04_08_165239_create_papel_detalles_table', 1),
(16, '2024_04_08_165249_create_papel_archivos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `id` bigint UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `multimedia`
--

INSERT INTO `multimedia` (`id`, `titulo`, `archivo`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'MULTIMEDIA 1', '1713206831_1.mp4', 'video', '2024-04-15 18:47:11', '2024-04-15 18:47:11'),
(2, 'MUTLIMEDIA 2', '1713206831_2.jpg', 'imagen', '2024-04-15 18:47:11', '2024-04-15 18:47:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` bigint UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'NOTICIA #1', 'DESCRIPCION NOTICIA #1', '2024-04-15 18:17:07', '2024-04-15 18:17:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papel_archivos`
--

CREATE TABLE `papel_archivos` (
  `id` bigint UNSIGNED NOT NULL,
  `papel_detalle_id` bigint UNSIGNED NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papel_detalles`
--

CREATE TABLE `papel_detalles` (
  `id` bigint UNSIGNED NOT NULL,
  `papel_trabajo_id` bigint UNSIGNED NOT NULL,
  `nro_etapa` int NOT NULL,
  `nro_nombre` int NOT NULL,
  `aplicabilidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papel_trabajos`
--

CREATE TABLE `papel_trabajos` (
  `id` bigint UNSIGNED NOT NULL,
  `trabajo_auditoria_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_trabajos`
--

CREATE TABLE `personal_trabajos` (
  `id` bigint UNSIGNED NOT NULL,
  `trabajo_auditoria_id` bigint UNSIGNED NOT NULL,
  `personal_id` bigint UNSIGNED NOT NULL,
  `horas` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_trabajos`
--

INSERT INTO `personal_trabajos` (`id`, `trabajo_auditoria_id`, `personal_id`, `horas`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3, '2024-04-16 16:44:37', '2024-04-16 16:44:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacions`
--

CREATE TABLE `publicacions` (
  `id` bigint UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publicacions`
--

INSERT INTO `publicacions` (`id`, `titulo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'TITULO #1', 'DES', '2024-04-15 16:21:40', '2024-04-15 16:23:56'),
(2, 'TITULO #2', 'DESC #2', '2024-04-15 16:22:26', '2024-04-15 16:23:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_trabajos`
--

CREATE TABLE `tipo_trabajos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_trabajos`
--

INSERT INTO `tipo_trabajos` (`id`, `nombre`, `descripcion`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'TIPO TRABJO #1', 'DESC. TIPO TRABAJO 1', '2024-04-16', '2024-04-16 16:15:40', '2024-04-16 16:15:40'),
(2, 'TIPO TRABAJO #2', 'DESC. 2', '2024-04-16', '2024-04-16 16:15:46', '2024-04-16 16:15:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_auditorias`
--

CREATE TABLE `trabajo_auditorias` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_trabajo_id` bigint UNSIGNED NOT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable_id` bigint UNSIGNED NOT NULL,
  `objeto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objetivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_ini` date NOT NULL,
  `duracion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_entrega` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trabajo_auditorias`
--

INSERT INTO `trabajo_auditorias` (`id`, `nombre`, `codigo`, `tipo_trabajo_id`, `empresa`, `responsable_id`, `objeto`, `objetivo`, `periodo`, `fecha_ini`, `duracion`, `fecha_entrega`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'AUDITORIA #1', 'COD-001', 1, 'EMPRESA #1', 2, 'OBJETO #1', 'OBJETIVO #1', '1-2024', '2024-03-03', 'HÁBILES', '2024-06-01', '2024-04-16', '2024-04-16 16:44:37', '2024-04-16 16:44:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nacionalidad` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acceso` int NOT NULL DEFAULT '1',
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `sexo`, `nacionalidad`, `dir`, `email`, `fono`, `profesion`, `cargo`, `nivel`, `tipo`, `foto`, `acceso`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$tip597HRP5phPRM09dT/6OA2qgl3A8PoRzYswlhwiJ7SBCFhwS04i', 'admin', '', '', '0', '', '', '', '', 'admin@gmail.com', '', '', 'GERENTE', '', 'GERENTE AUDITOR', '', 1, '2024-04-08', '2024-04-08 21:10:09', '2024-04-08 21:10:09'),
(2, 'JPERES', '$2y$12$JYf5tQfnyULpD0k49W5ejubQbDEFzY9V3ipapW4kCrCInSkaS9oGG', 'JUAN', 'PERES', 'MAMANI', '1111', 'LP', 'HOMBRE', 'BOLIVIANO', 'LOS OLIVOS', 'JUAN@GMAIL.COM', '77777777', 'PROFESION #1', 'GA', 'A', 'GERENTE AUDITOR', '1713283901_JPERES.jpg', 1, '2024-04-16', '2024-04-16 16:11:41', '2024-04-16 16:12:38'),
(3, 'MCORTEZ', '$2y$12$gvX82w1VAp/qO2aHy/KDou93YMMKrikjID675524JNW10E/gxJ7Aa', 'MARIO', 'CORTEZ', '', '2222', 'LP', 'HOMBRE', 'BOLIVIANO', 'LOS OLIVOS', '', '67676767', 'PROFESION #2', 'SU', 'B', 'AUDITOR', NULL, 1, '2024-04-16', '2024-04-16 16:13:07', '2024-04-16 16:13:12'),
(4, 'MMAMANI', '$2y$12$3CvihElPmuNTt2puLSWaEeI9IUDOVB6s4Gfb8qUGJqYoUBzDKEEwW', 'MARIA', 'MAMANI', '', '3333', 'CB', 'MUJER', 'BOLIVIANA', 'LOS OLIVOS', 'MARIA@GMAIL.COM', '67676767', 'PROFESION #3', 'SU', 'B', 'AUDITOR', '1713284044_MMAMANI.jpg', 1, '2024-04-16', '2024-04-16 16:14:04', '2024-04-16 16:14:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `etapa_archivos`
--
ALTER TABLE `etapa_archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etapa_archivos_etapa_nombre_id_foreign` (`etapa_nombre_id`);

--
-- Indices de la tabla `etapa_auditorias`
--
ALTER TABLE `etapa_auditorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etapa_auditorias_trabajo_auditoria_id_foreign` (`trabajo_auditoria_id`);

--
-- Indices de la tabla `etapa_nombres`
--
ALTER TABLE `etapa_nombres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etapa_nombres_etapa_auditoria_id_foreign` (`etapa_auditoria_id`);

--
-- Indices de la tabla `historial_accions`
--
ALTER TABLE `historial_accions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `institucions`
--
ALTER TABLE `institucions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `papel_archivos`
--
ALTER TABLE `papel_archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `papel_archivos_papel_detalle_id_foreign` (`papel_detalle_id`);

--
-- Indices de la tabla `papel_detalles`
--
ALTER TABLE `papel_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `papel_detalles_papel_trabajo_id_foreign` (`papel_trabajo_id`);

--
-- Indices de la tabla `papel_trabajos`
--
ALTER TABLE `papel_trabajos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `papel_trabajos_trabajo_auditoria_id_foreign` (`trabajo_auditoria_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `personal_trabajos`
--
ALTER TABLE `personal_trabajos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_trabajos_trabajo_auditoria_id_foreign` (`trabajo_auditoria_id`),
  ADD KEY `personal_trabajos_personal_id_foreign` (`personal_id`);

--
-- Indices de la tabla `publicacions`
--
ALTER TABLE `publicacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_trabajos`
--
ALTER TABLE `tipo_trabajos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajo_auditorias`
--
ALTER TABLE `trabajo_auditorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trabajo_auditorias_tipo_trabajo_id_foreign` (`tipo_trabajo_id`),
  ADD KEY `trabajo_auditorias_responsable_id_foreign` (`responsable_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `etapa_archivos`
--
ALTER TABLE `etapa_archivos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etapa_auditorias`
--
ALTER TABLE `etapa_auditorias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etapa_nombres`
--
ALTER TABLE `etapa_nombres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_accions`
--
ALTER TABLE `historial_accions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `institucions`
--
ALTER TABLE `institucions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `papel_archivos`
--
ALTER TABLE `papel_archivos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `papel_detalles`
--
ALTER TABLE `papel_detalles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `papel_trabajos`
--
ALTER TABLE `papel_trabajos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_trabajos`
--
ALTER TABLE `personal_trabajos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `publicacions`
--
ALTER TABLE `publicacions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_trabajos`
--
ALTER TABLE `tipo_trabajos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajo_auditorias`
--
ALTER TABLE `trabajo_auditorias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `etapa_archivos`
--
ALTER TABLE `etapa_archivos`
  ADD CONSTRAINT `etapa_archivos_etapa_nombre_id_foreign` FOREIGN KEY (`etapa_nombre_id`) REFERENCES `etapa_nombres` (`id`);

--
-- Filtros para la tabla `etapa_auditorias`
--
ALTER TABLE `etapa_auditorias`
  ADD CONSTRAINT `etapa_auditorias_trabajo_auditoria_id_foreign` FOREIGN KEY (`trabajo_auditoria_id`) REFERENCES `trabajo_auditorias` (`id`);

--
-- Filtros para la tabla `etapa_nombres`
--
ALTER TABLE `etapa_nombres`
  ADD CONSTRAINT `etapa_nombres_etapa_auditoria_id_foreign` FOREIGN KEY (`etapa_auditoria_id`) REFERENCES `etapa_auditorias` (`id`);

--
-- Filtros para la tabla `papel_archivos`
--
ALTER TABLE `papel_archivos`
  ADD CONSTRAINT `papel_archivos_papel_detalle_id_foreign` FOREIGN KEY (`papel_detalle_id`) REFERENCES `papel_detalles` (`id`);

--
-- Filtros para la tabla `papel_detalles`
--
ALTER TABLE `papel_detalles`
  ADD CONSTRAINT `papel_detalles_papel_trabajo_id_foreign` FOREIGN KEY (`papel_trabajo_id`) REFERENCES `papel_trabajos` (`id`);

--
-- Filtros para la tabla `papel_trabajos`
--
ALTER TABLE `papel_trabajos`
  ADD CONSTRAINT `papel_trabajos_trabajo_auditoria_id_foreign` FOREIGN KEY (`trabajo_auditoria_id`) REFERENCES `trabajo_auditorias` (`id`);

--
-- Filtros para la tabla `personal_trabajos`
--
ALTER TABLE `personal_trabajos`
  ADD CONSTRAINT `personal_trabajos_personal_id_foreign` FOREIGN KEY (`personal_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `personal_trabajos_trabajo_auditoria_id_foreign` FOREIGN KEY (`trabajo_auditoria_id`) REFERENCES `trabajo_auditorias` (`id`);

--
-- Filtros para la tabla `trabajo_auditorias`
--
ALTER TABLE `trabajo_auditorias`
  ADD CONSTRAINT `trabajo_auditorias_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `trabajo_auditorias_tipo_trabajo_id_foreign` FOREIGN KEY (`tipo_trabajo_id`) REFERENCES `tipo_trabajos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
