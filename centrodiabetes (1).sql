-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2025 a las 19:39:18
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
-- Base de datos: `centrodiabetes`
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
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `idDoctor` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `especialidad` varchar(45) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`idDoctor`, `user_id`, `especialidad`, `cedula`, `created_at`, `updated_at`) VALUES
(1, 10, 'Diabetologo', '12341234', '2025-09-09 21:40:01', '2025-09-09 21:40:01'),
(3, 14, 'Diabetologo', '12341234', '2025-09-15 04:54:59', '2025-09-15 04:54:59');

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
-- Estructura de tabla para la tabla `historial_medicos`
--

CREATE TABLE `historial_medicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `antecedentesFamiliares` text DEFAULT NULL,
  `alergias` text DEFAULT NULL,
  `enfermedades` text DEFAULT NULL,
  `notasMedicas` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial_medicos`
--

INSERT INTO `historial_medicos` (`id`, `patient_id`, `antecedentesFamiliares`, `alergias`, `enfermedades`, `notasMedicas`, `created_at`, `updated_at`) VALUES
(1, 18, 'Padre con diabetes tipo 2.\r\nAbuela materna con diabetes tipo 1.', 'Alergia a la penicilina (provoca erupción cutánea).\r\nAlergia al marisco (dificultad para respirar).\r\nAlergia al polen (rinitis estacional).', 'Hipertensión arterial controlada con enalapril.\r\nAsma leve persistente.\r\nColesterol alto (hipercolesterolemia).', 'Paciente bajo tratamiento con metformina 850 mg dos veces al día.\r\nSe recomienda control mensual de glucosa en ayunas.', '2025-09-29 12:52:41', '2025-09-30 05:24:06'),
(2, 19, NULL, NULL, NULL, NULL, '2025-09-29 12:53:30', '2025-09-29 12:53:30'),
(3, 5, 'Abuela con diabetes tipo 1', 'Camarón', 'Ninguna', 'Todo está en orden', '2025-09-30 05:22:10', '2025-10-12 04:22:35'),
(4, 12, NULL, NULL, NULL, NULL, '2025-09-30 05:22:28', '2025-09-30 05:22:28'),
(5, 20, 'Bisabuelo con diabetes tipo 1', 'Ninguna.', 'Ninguna.', 'Todo está bien.', '2025-09-30 05:46:04', '2025-09-30 05:47:24');

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
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `viaAdministracion` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nombre`, `descripcion`, `stock`, `viaAdministracion`, `created_at`, `updated_at`) VALUES
(1, 'Metformina', 'Ayuda a matener los niveles de glucosa en un nivel adecuado', 100, 'Oral', '2025-10-12 04:16:22', '2025-10-12 04:16:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediciones`
--

CREATE TABLE `mediciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `glucosa` double DEFAULT NULL,
  `presionSistolica` double DEFAULT NULL,
  `presionDiastolica` double DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `altura` double DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mediciones`
--

INSERT INTO `mediciones` (`id`, `patient_id`, `fecha`, `glucosa`, `presionSistolica`, `presionDiastolica`, `peso`, `altura`, `notas`, `created_at`, `updated_at`) VALUES
(1, 5, '2004-10-06', 105, 120, 80, 76, 177, 'Todo parece en orden', '2025-10-07 03:19:12', '2025-10-07 03:19:12'),
(2, 5, '2004-10-09', 103, 122, 81, 74, 177, 'Todo está en orden', '2025-10-07 03:19:55', '2025-10-07 03:19:55'),
(3, 5, '2025-10-05', 105, 120, 80, 77, 176, 'Todo en orden', '2025-10-12 03:54:42', '2025-10-12 03:54:42');

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_08_065406_create_pacientes_table', 1),
(5, '2025_09_09_212642_create_doctors_table', 2),
(6, '2025_09_21_042142_create_medicamentos_table', 3),
(7, '2025_09_21_045603_medicamentos', 4),
(8, '2025_09_21_050206_medicamentos', 5),
(16, '2025_09_29_023150_create_historial_medicos_table', 6),
(17, '2025_09_29_023151_create_mediciones_table', 6),
(18, '2025_09_29_023151_create_seguimiento_medicos_table', 6),
(19, '2025_10_06_215255_medicamentos', 7),
(20, '2025_10_06_225624_create_prescripcions_table', 7),
(21, '2025_10_11_235647_prescripciones', 8),
(23, '2025_10_11_235736_prescripciones', 9),
(24, '2025_10_12_003501_prescripciones', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fechaRegistro` date NOT NULL,
  `tipoDiabetes` varchar(255) NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `user_id`, `fechaRegistro`, `tipoDiabetes`, `sexo`, `fecha_nacimiento`, `created_at`, `updated_at`) VALUES
(5, 6, '2025-09-08', '1', 'Masculino', '2004-10-05', '2025-09-09 01:16:58', '2025-09-30 08:04:53'),
(12, 17, '2025-09-15', '1234', 'Masculino', '1234-03-12', '2025-09-15 07:49:10', '2025-09-15 07:49:10'),
(13, NULL, '2025-09-29', '1', 'Masculino', '2004-10-05', '2025-09-29 12:32:05', '2025-09-29 12:32:05'),
(14, NULL, '2025-09-29', '1', 'Masculino', '2004-10-05', '2025-09-29 12:34:30', '2025-09-29 12:34:30'),
(15, NULL, '2025-09-29', '1', 'Masculino', '2004-10-05', '2025-09-29 12:37:00', '2025-09-29 12:37:00'),
(16, NULL, '2025-09-29', '1', 'Masculino', '2004-10-05', '2025-09-29 12:37:56', '2025-09-29 12:37:56'),
(17, NULL, '2025-09-29', '1', 'Masculino', '2004-10-05', '2025-09-29 12:41:43', '2025-09-29 12:41:43'),
(18, 23, '2025-09-29', '1', 'Masculino', '2004-02-05', '2025-09-29 12:52:41', '2025-09-29 12:52:41'),
(19, 24, '2025-09-29', '1', 'Masculino', '2004-10-05', '2025-09-29 12:53:30', '2025-09-29 12:53:30'),
(20, 25, '2025-09-29', '0', 'Femenino', '2010-02-13', '2025-09-30 05:46:04', '2025-09-30 05:46:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('jesusantoniotorflor@gmail.com', '$2y$12$AXVByVpQrt8scvqSv3CAJu5duTeSq0WBvx2He72/KxMDC2i/.rDo.', '2025-09-23 03:23:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prescripciones`
--

CREATE TABLE `prescripciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `medicamento_id` bigint(20) UNSIGNED NOT NULL,
  `dosis` text NOT NULL,
  `indicaciones` text DEFAULT NULL,
  `fecha_prescripcion` date NOT NULL,
  `fecha_fin_consumo` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prescripciones`
--

INSERT INTO `prescripciones` (`id`, `paciente_id`, `doctor_id`, `medicamento_id`, `dosis`, `indicaciones`, `fecha_prescripcion`, `fecha_fin_consumo`, `created_at`, `updated_at`) VALUES
(1, 5, 10, 1, 'Una pastilla por día', 'Tomar una pastilla antes o después de la cena', '2025-10-12', '2025-12-15', '2025-10-12 06:42:37', '2025-10-12 06:42:37'),
(2, 5, 11, 1, 'pastilla por dia', NULL, '2025-10-01', '2025-10-05', '2025-10-12 11:23:36', '2025-10-12 11:23:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_medicos`
--

CREATE TABLE `seguimiento_medicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fechaSeguimiento` datetime NOT NULL,
  `motivoConsulta` text NOT NULL,
  `observaciones` text NOT NULL,
  `planTratamiento` text NOT NULL,
  `proximaCita` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('68xCKK7rBP5hBBxJtTtu82GtIWqVG62U5CkFw1uO', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVFdSdjBRbXNqRXJ1bExJOWU0UlFYc3ZWNE1kdnlmRXZuZFpHWUZReCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly9zaXN0ZW1hZGlhYmV0ZXMudGVzdC9kb2N0b3IvcGFjaWVudGVzLzYvcHJlc2NyaXBjaW9uIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1760322120),
('jgU8WX1MEGF5E13oPNqsHZiOoqf3y5WLqQQNukE0', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVWxjbEE1Y0k0T3BoSDhuaktKajYxMUY4U2RxQUpabEpqNUVyaWdnaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9zaXN0ZW1hZGlhYmV0ZXMudGVzdC9wYWNpZW50ZS9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1760246643),
('M8sbLSLRtXldd5ZuTlYACKBC3v1d6QGVObcbT3Nz', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOW9rUlVhaDRtZEtDTnFlMHcyV0o2WTFreHlkd09FVTJOTGx5YVNaMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9zaXN0ZW1hZGlhYmV0ZXMudGVzdC9wYWNpZW50ZS9wcmVzY3JpcGNpb25lcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1760232696);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','doctor','paciente') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `apellido`, `email`, `email_verified_at`, `password`, `rol`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Jesus Antonio', 'Torres', 'jesusantoniotorflor@gmail.com', NULL, '$2y$12$eS6qB4Kw0aUpj0mqfESH2O8GNPlPq7pnHh63B.Um.Gypoms88si.y', 'paciente', 'FAy3qLmxj78QZqI8XqmhuNJfbNHeBDm2d17l119TDgZQN3pBj4uEDiQr4heO', '2025-09-09 01:16:58', '2025-09-15 07:12:00'),
(10, 'Jesus D', 'Luffy', 'imacoolbread@gmail.com', NULL, '$2y$12$WwjCfNIo4ZuZETLRugfede4Dx85KHjWhxXhoFs6eXsDujrJ6Z7qDa', 'doctor', NULL, '2025-09-10 03:44:52', '2025-09-10 07:11:40'),
(11, 'Admin', 'Admin', 'jesusantoniotorflor@hotmail.com', NULL, '$2y$12$qBXUzCjJXema4DofOSqlYuXx4bw.OO/9oGP3pIOXHcTAgccWA7zoq', 'admin', NULL, '2025-09-14 05:25:37', '2025-09-14 05:25:37'),
(14, 'Luffy', 'Monkey D', 'tfjo220203@upemor.edu.mx', NULL, '$2y$12$uTdazoZbSv//TTUBMir.JuDBDg/vOqjVEUW0l74dRdr2k53ANzQh.', 'doctor', NULL, '2025-09-14 08:05:11', '2025-09-15 04:54:59'),
(17, '12341234', '12341234', '12341234@gmail.com', NULL, '$2y$12$9teS5J12ylmTnQeAqww9kOj6pP47T.PEvIbkqUq/gviXGVpuFQlUq', 'paciente', NULL, '2025-09-15 07:49:10', '2025-09-15 07:49:10'),
(23, 'prueba', 'prueba', 'prueba@gmail.com', NULL, '$2y$12$ER2AP4NwC9NQih6xP6su2Or3ReHaNP13RvLyX4UtL3oItaqOdSJhO', 'paciente', NULL, '2025-09-29 12:52:41', '2025-09-29 12:52:41'),
(24, 'prueba2q', 'prueba2', 'prueba2@gmail.com', NULL, '$2y$12$pKQukKNjk/Zc7dbpjzLsgOWcTod8HqG.d4hJaPmkKn7JWOlolkQs2', 'paciente', NULL, '2025-09-29 12:53:30', '2025-09-29 12:53:30'),
(25, 'Vale', 'Torres', 'valetorres@gmail.com', NULL, '$2y$12$6Xv.R1INMoGaSjxwCqjnNO0llr0UFCtBLq1ShaJoFPnJyesPsI24a', 'paciente', NULL, '2025-09-30 05:46:04', '2025-09-30 05:46:04');

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
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`idDoctor`),
  ADD KEY `doctores_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `historial_medicos`
--
ALTER TABLE `historial_medicos`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mediciones`
--
ALTER TABLE `mediciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mediciones_patient_id_foreign` (`patient_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacientes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `prescripciones`
--
ALTER TABLE `prescripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescripciones_paciente_id_foreign` (`paciente_id`),
  ADD KEY `prescripciones_doctor_id_foreign` (`doctor_id`),
  ADD KEY `prescripciones_medicamento_id_foreign` (`medicamento_id`);

--
-- Indices de la tabla `seguimiento_medicos`
--
ALTER TABLE `seguimiento_medicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seguimiento_medicos_patient_id_foreign` (`patient_id`);

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
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `idDoctor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_medicos`
--
ALTER TABLE `historial_medicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mediciones`
--
ALTER TABLE `mediciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `prescripciones`
--
ALTER TABLE `prescripciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `seguimiento_medicos`
--
ALTER TABLE `seguimiento_medicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD CONSTRAINT `doctores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `mediciones`
--
ALTER TABLE `mediciones`
  ADD CONSTRAINT `mediciones_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `pacientes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `prescripciones`
--
ALTER TABLE `prescripciones`
  ADD CONSTRAINT `prescripciones_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `prescripciones_medicamento_id_foreign` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamentos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescripciones_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `seguimiento_medicos`
--
ALTER TABLE `seguimiento_medicos`
  ADD CONSTRAINT `seguimiento_medicos_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `pacientes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
