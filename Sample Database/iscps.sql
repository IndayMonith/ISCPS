-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 05:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iscps`
--
CREATE DATABASE IF NOT EXISTS `iscps` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `iscps`;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `time_in` datetime DEFAULT current_timestamp(),
  `time_out` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `slot_id`, `time_in`, `time_out`, `created_at`) VALUES
(1, 1, '2024-10-16 22:43:38', '2024-10-16 22:44:27', '2024-10-16 22:43:38'),
(2, 2, '2024-10-16 22:44:17', '2024-10-16 22:44:32', '2024-10-16 22:44:17'),
(3, 1, '2024-10-16 22:56:13', '2024-10-16 22:56:41', '2024-10-16 22:56:13'),
(4, 2, '2024-10-16 22:56:25', '2024-10-16 22:56:51', '2024-10-16 22:56:25'),
(5, 3, '2024-10-16 22:56:29', '2024-10-16 22:56:57', '2024-10-16 22:56:29'),
(6, 4, '2024-10-16 22:56:33', '2024-10-16 22:57:01', '2024-10-16 22:56:33'),
(7, 1, '2024-10-16 22:57:32', '2024-10-16 22:57:34', '2024-10-16 22:57:32'),
(8, 4, '2024-10-16 22:58:28', '2024-10-16 22:58:32', '2024-10-16 22:58:28'),
(9, 1, '2024-10-16 22:58:43', '2024-10-16 22:58:50', '2024-10-16 22:58:43'),
(10, 1, '2024-10-16 22:58:59', '2024-10-16 22:59:03', '2024-10-16 22:58:59'),
(11, 1, '2024-10-16 22:59:49', '2024-10-16 22:59:51', '2024-10-16 22:59:49'),
(12, 1, '2024-10-16 23:00:24', '2024-10-16 23:00:34', '2024-10-16 23:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `id` int(11) NOT NULL,
  `sensor_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`id`, `sensor_name`, `created_at`) VALUES
(1, 'd1', '2024-10-16 22:10:02'),
(2, 'd2', '2024-10-16 22:10:02'),
(3, 'd3', '2024-10-16 22:10:10'),
(4, 'd4', '2024-10-16 22:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `sensor_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `sensor_id`, `name`, `created_at`) VALUES
(1, 1, 'p1', '2024-10-16 22:10:23'),
(2, 2, 'p2', '2024-10-16 22:10:23'),
(3, 3, 'p3', '2024-10-16 22:10:33'),
(4, 4, 'p4', '2024-10-16 22:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$WgL2d2fzi6IiGiTfXvdBluTLlMroU8zBtIcRut7SzOB6j9i/LbA4K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slot_id` (`slot_id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sensor_id` (`sensor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_ibfk_1` FOREIGN KEY (`sensor_id`) REFERENCES `sensors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
