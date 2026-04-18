-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-04-2026 a las 17:01:17
-- Versión del servidor: 11.4.10-MariaDB-cll-lve
-- Versión de PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uoixjzqtru_magestad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_payment_dates`
--

CREATE TABLE `customer_payment_dates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customer_payment_dates`
--

INSERT INTO `customer_payment_dates` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, '5', '', NULL, NULL),
(2, '10', '', NULL, NULL),
(3, '20', '', NULL, NULL),
(4, '30', '', NULL, NULL),
(5, '5 | 20', '', NULL, NULL),
(6, '10 | 25', '', NULL, NULL),
(7, '15 | 30', '', NULL, NULL),
(8, 'Semanal', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customer_payment_dates`
--
ALTER TABLE `customer_payment_dates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customer_payment_dates`
--
ALTER TABLE `customer_payment_dates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
