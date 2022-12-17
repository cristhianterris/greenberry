-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla teranorp_greenberry.configuracion
CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entrada_recomendada` int NOT NULL DEFAULT '0',
  `contrasenia_predeterminada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Password',
  `correo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teranorp_greenberry.configuracion: ~26 rows (aproximadamente)
DELETE FROM `configuracion`;
INSERT INTO `configuracion` (`id`, `entrada_recomendada`, `contrasenia_predeterminada`, `correo`, `created_at`) VALUES
	(1, 0, 'Password', '', '2021-01-17 01:23:49'),
	(2, 3, 'Password1', '', '2021-01-17 03:43:04'),
	(3, 1, 'Password1', '', '2021-01-17 03:43:28'),
	(4, 0, 'Password2', '', '2021-01-17 03:44:08'),
	(5, 1, 'Password3', '', '2021-01-17 03:44:36'),
	(6, 3, 'Password4', '', '2021-01-17 03:46:03'),
	(7, 1, 'Password5', '', '2021-01-17 03:47:41'),
	(8, 0, 'Password5', '', '2021-01-17 03:56:01'),
	(9, 1, 'Password5', '', '2021-01-17 03:56:21'),
	(10, 1, 'Password5', '', '2021-01-17 04:06:28'),
	(11, 1, 'Password5', '', '2021-01-17 04:07:29'),
	(12, 0, 'Password6', '', '2021-01-17 04:08:09'),
	(13, 0, '123456', '', '2021-01-17 04:10:04'),
	(14, 0, 'Password', '', '2021-01-17 04:10:14'),
	(15, 0, 'Password', '', '2021-01-17 04:18:11'),
	(16, 1, 'Password', '', '2021-01-17 04:33:51'),
	(17, 0, 'Password', '', '2021-01-17 04:43:21'),
	(18, 1, 'Password', '', '2021-01-17 18:18:23'),
	(19, 0, 'Password', '', '2021-01-17 18:18:33'),
	(20, 5, 'Password', '', '2021-01-17 21:25:24'),
	(21, 5, 'Password', 'cristhianterris@gmail.com', '2021-01-20 02:37:33'),
	(22, 5, 'Password', 'cristhianterris@gmail.com', '2021-01-20 02:37:35'),
	(23, 5, 'Password', 'cristhianterris@gmail.com', '2021-01-20 02:37:47'),
	(24, 33, 'Password', 'cristhianterris@gmail.com', '2021-01-21 23:58:54'),
	(25, 0, 'Password', 'cristhianterris@gmail.com', '2021-01-21 23:59:29'),
	(26, 0, 'Password', 'jk.quispesol@gmail.com', '2021-02-05 01:07:27'),
	(27, 0, 'Password', 'cristhianterris@gmail.com', '2022-12-17 11:40:04');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
