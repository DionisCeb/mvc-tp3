-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 31, 2024 at 03:18 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `activity_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `page_visited` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `username`, `ip_address`, `activity_date`, `page_visited`) VALUES
(122, 'dionis', '127.0.0.1', '2024-08-31 09:07:09', '/booking/create'),
(121, 'dionis', '127.0.0.1', '2024-08-31 09:07:08', '/booking/create'),
(120, 'dionis', '127.0.0.1', '2024-08-31 09:07:07', '/booking/create'),
(119, 'dionis', '127.0.0.1', '2024-08-31 09:02:45', '/booking/create');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int NOT NULL,
  `client_id` int NOT NULL,
  `check_in_date` date NOT NULL,
  `check_in_time` time NOT NULL,
  `check_out_date` date NOT NULL,
  `check_out_time` time NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last time updated',
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `car_id`, `client_id`, `check_in_date`, `check_in_time`, `check_out_date`, `check_out_time`, `updated_at`) VALUES
(53, 2, 17, '2024-09-06', '05:48:00', '2024-09-27', '00:52:00', '2024-08-31 04:48:52'),
(54, 4, 17, '2024-09-26', '04:00:00', '2024-09-27', '01:04:00', '2024-08-31 05:00:26'),
(52, 54, 18, '2024-09-06', '04:17:00', '2024-09-19', '00:19:00', '2024-08-31 04:18:06'),
(49, 52, 16, '2024-08-31', '03:04:00', '2024-09-04', '11:09:00', '2024-08-30 15:04:23'),
(50, 54, 17, '2024-09-07', '04:12:00', '2024-09-27', '11:17:00', '2024-08-30 19:13:29'),
(51, 53, 17, '2024-09-07', '12:23:00', '2024-09-27', '15:23:00', '2024-08-30 16:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `type`, `make`, `model`, `color`) VALUES
(53, 'SUV', 'Mercedes', 'A-Class', 'Gris'),
(54, 'Coupé', 'Mercedes', 'A-Class', 'Gris'),
(52, 'Hatchback', 'Mercedes', 'A-Class', 'Gris'),
(10, 'Coupé', 'Mercedes', 'C-Class', 'Blanc'),
(9, 'SUV', 'Mercedes', 'GLC', 'Gris'),
(8, 'Hatchback', 'Mercedes', 'A-Class', 'Noir'),
(7, 'Sport', 'BMW', 'Z4', 'Blanc'),
(6, 'SUV', 'BMW', 'X5', 'Gris'),
(5, 'Coupé', 'BMW', 'M4', 'Blanc'),
(4, 'SUV', 'Audi', 'Q5', 'Gris'),
(3, 'Coupé', 'Audi', 'A5', 'Noir'),
(2, 'Sport', 'Audi', 'TT', 'Noir'),
(1, 'Hatchback', 'Audi', 'A1', 'Gris');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `surname`, `email`, `phone`) VALUES
(18, 'Mihail', 'Sidorenco', 'mihailsidorenco@mail.ru', '445885828848'),
(16, 'Cebanu', 'Dionis', 'dionis.cebanu003@gmail.com', '1234567890'),
(17, 'Cebanu', 'Dionis', 'luxurycarbookingg@gmail.com', '77777777777');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE IF NOT EXISTS `privilege` (
  `id` int NOT NULL AUTO_INCREMENT,
  `privilege` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `privilege`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Employee'),
(4, 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `privilege_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_privilege_id` (`privilege_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`, `privilege_id`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$IaBNsheKVXp77XlgBQFBguUGonCcdQndI3.nHCa/oRpiB2.PL0uy.', 'admin@gmail.com', 1, '2024-08-22 23:22:10'),
(6, 'dionis', 'dionis@gmail.com', '$2y$10$3/S10c7G5xBrBCqG69W9TeJXaNOdydokyNkKxtvZ.Cbg.SRm7.8eG', 'dionis@gmail.com', 1, '2024-08-23 00:18:00'),
(9, 'darii', 'darii@gmail.com', '$2y$10$KSh5Stm4xLjbEQyXF10CI.dEjGSD2jmau5jlXt9TwrxH8U/BIOZWi', 'darii@gmail.com', 2, '2024-08-23 19:02:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
