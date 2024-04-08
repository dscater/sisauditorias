-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-04-2024 a las 21:10:26
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
(1, 'SISAUDITORIAS S.A.', 'SISAUDITORIAS', '10000001', 'organigrama.jpg', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS,', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS,', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS,', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS,', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS,', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS,', 'LOREM IPSUM ES SIMPLEMENTE EL TEXTO DE RELLENO DE LAS IMPRENTAS Y ARCHIVOS DE TEXTO. LOREM IPSUM HA SIDO EL TEXTO DE RELLENO ESTÁNDAR DE LAS INDUSTRIAS DESDE EL AÑO 1500, CUANDO UN IMPRESOR (N. DEL T. PERSONA QUE SE DEDICA A LA IMPRENTA) DESCONOCIDO USÓ UNA GALERÍA DE TEXTOS Y LOS MEZCLÓ DE TAL MANERA QUE LOGRÓ HACER UN LIBRO DE TEXTOS ESPECIMEN. NO SÓLO SOBREVIVIÓ 500 AÑOS, SINO QUE TAMBIEN INGRESÓ COMO TEXTO DE RELLENO EN DOCUMENTOS ELECTRÓNICOS,', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d12143.389812786238!2d-68.08918332465664!3d-16.52975316867156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e0!4m0!4m3!3m2!1d-16.527973505058714!2d-68.08870645756463!5e0!3m2!1ses-419!2sbo!4v1706929714970!5m2!1ses-419!2sbo\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'LA PAZ', 'LOS OLIVOS', '7777777', '08:00am A 18:00pm', 'sisauditorias@gmail.com', 'logo.png', '2024-04-08 21:06:22', '2024-04-08 21:06:22');

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
(1, 'admin', '$2y$12$tip597HRP5phPRM09dT/6OA2qgl3A8PoRzYswlhwiJ7SBCFhwS04i', 'admin', '', '', '0', '', '', '', '', 'admin@gmail.com', '', '', 'GERENTE', '', 'GERENTE AUDITOR', '', 1, '2024-04-08', '2024-04-08 21:10:09', '2024-04-08 21:10:09');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicacions`
--
ALTER TABLE `publicacions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_trabajos`
--
ALTER TABLE `tipo_trabajos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trabajo_auditorias`
--
ALTER TABLE `trabajo_auditorias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
